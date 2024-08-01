<?php
include 'includes/header.php';
$exam_id=0;
if(isset($_GET['exam_id'])){
    $exam_id = $_GET['exam_id'];
    $res = $con->query("SELECT * FROM exams WHERE id = '$exam_id'");
    if($res->num_rows){
        $exam_name = $res->fetch_assoc()['exam_name'];
?>
<div class="row">
    <div class="col-md-5">
        <form action="" method="POST" id="add-question">
            <input type="hidden" name="status" value="add_question">
            <input type="hidden" name="exam_id" value="<?=$exam_id?>">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-plus"></i> Add A Question of <b class="label label-info"><?=ucwords($exam_name)?></b></h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="form-label">Enter Question</label>
                        <textarea class="form-control" placeholder="Enter Question.." required name="question"></textarea>
                    </div>
                    <div class="answer-area">
                        
                    </div>
                    
                    <div class="form-group mt-3" style="margin-top:8px">
                        <button type="button" class="btn btn-xs btn-info add-a-new-answer"><i class="fa fa-plus"></i> Add A New Answer</button>
                    </div>
                    
                </div>
                <div class="panel-footer">
                    <button class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </form>
    </div>
    
    <div class="col-md-7">
        <div class="panel panel-priary">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-list"></i>List Questions of <b class="label label-info"><?=ucwords($exam_name)?></b></h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped" id="list_questions">
                        <thead>
                            <tr>
                                <th>#.</th>
                                <th>Question</th>
                                <th>Show Answer(s)</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    
    
</div>
<?php
    }
    else{
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger">Exam is not found..</div>
            </div>
        </div>
        <?php
    }
}
include 'includes/footer.php';

?>
<script>var base_url = '<?=BASE_URL?>';</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script>
    $(document).ready(function(){
        var index = 1;
        const table = $('#list_questions').DataTable({
                   ajax: {
                        url: base_url + 'admin/ExamAjax.php',
                        data : {status : 'question_list', exam_id : '<?=$exam_id?>'},
                        success: function (d) {
                            // console.log(d);
                            if (d.data && d.data.length) {
                                table.clear();
                                table.rows.add(d.data).draw();
                            }
                            else {
                                toastr.error('Table Data Not Found.');
                                // DataTableEmptyMessage(table);
                            }
                        },
                        error : function(a,b,v){
                            console.warn(a.responseText);
                        }
                    },
                    columns: [
                        {'data' : null},
                        {'data' : 'question'},
                        {'data' : null},
                        {'data' : null},
                    ],
                    columnDefs: [
                            {
                                targets : 0,
                                render : function(data,type,row){
                                    return `${index++}.`;
                                }
                            },
                            {
                                targets : 2,
                                render : function(data,type,row){
                                    return `<a href="javascript:;" class="btn btn-info btn-xs view-answer-list" data-question_id="${row.id}"><i class="fa fa-plus"></i> Answer List</a>`;
                                }
                            },
                            {
                                targets : 3,
                                data: null,
                                orderable: false,
                                className: 'text-end',
                                render : function(data,type,row){
                                    return `<buton class="btn btn-xs btn-danger delete-row" data-id="${row.id}"><i class="fa fa-trash"></i></button>`;
                                }
                            },
                    ]
                    
               });
        
        $(document).on('click','.view-answer-list',function(){
            var question_id = $(this).data('question_id');
            // alert(question_id);
            $.dialog({
                title : 'List Answers',
                icon : 'fa fa-file',
                theme : 'bootstrap',
                content :  function(){
                    var self = this;
                    return $.ajax({
                        type : 'POST',
                        url : base_url+'admin/ExamAjax.php',
                        data : {question_id : question_id,status : 'get_answer'},
                        dataType : 'json',
                        success : function(res){
                            self.setContent(res.html);
                        }
                    });
                }
            });
        })
        
         $(document).on('click','.delete-row',function(){
            var id = $(this).data('id');
            var td = this,
                tdValue = $(td).html();
              Swal.fire({
                    html: "Are you sure you want to delete? <br> If Delete Question, then Delete all answers of deleted Question",
                    icon: "warning",
                    showCancelButton: true, 
                    buttonsStyling: false,
                    confirmButtonText: "Yes, delete!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function (result) {
                    if (result.value) {
                        // alert('Please Wait,,'+ result.value);
                        $.post(base_url+'admin/ExamAjax.php',{status : 'delete_question','question_id' : id},function(res){
                          console.log(res); 
                            toastr.success('Question and question of all answers Removed Successfully..');
                            location.reload();
                        })
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: "Question was not deleted.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary",
                            }
                        });
                    }
                });
        })    
        
        // $('#exam-form')
        $(document).on('submit','#add-question',function(e){
            e.preventDefault();
            var right_answer = $(this).find('input[type="radio"]:checked');
            if($('.answer_in').length == 0){
                toastr.error('Please Enter An Answer....');
                return false;
            }
            else{
                 var values = []; // Array to store encountered values
    
                var hasDuplicates = false;
        
                // Iterate over each input element with the class "input"
                $(".answer_in").each(function () {
                    var value = $(this).val();
        
                    // Check if the value is already in the array
                    if (values.indexOf(value) !== -1) {
                        hasDuplicates = true;
                        return false; // Break out of the loop if a duplicate is found
                    }
        
                    // Add the value to the array
                    values.push(value);
                });
        
                if (hasDuplicates) {
                    toastr.error("Duplicates found in the answer values.");
                    return false;
                }
            }
        
        
        
            if(right_answer.length){
                // alert(0);
                $.ajax({
                    type : 'POST',
                    url : base_url + 'admin/ExamAjax.php',
                    data : $(this).serialize(),
                    dataType : 'json',
                    success : function(re){
                        if(re.status){
                            toastr.success('Question created Successfully..');
                            document.getElementById('add-question').reset();
                          location.reload();
                        }
                    },
                    error: function(a,v,c){
                        console.warn(a.responseText);
                    }
                });
            }
            else
                toastr.error('Please Choose A Right Answer.');
            
        })
        
        
        
        
        var i = 1;
        $('.add-a-new-answer').click(function(){
            var template = `
                            <div class="input-group" style="display:none">
                                <span class="input-group-addon">
                                    <input type="radio" name="right_answer[]">
                                </span>
                                <input type="text" class="form-control answer_in" name="answer[]" required autocomplete="off" placeholder="Enter Answer">
                                <span class="input-group-addon">
                                    <button type="button" class="btn btn-xs btn-danger remove-answer"><i class="fa fa-trash"></i></button>
                                </span>
                                    
                            </div>
                            `;
                            
            $('.answer-area').append(template).children(':last').fadeIn(1000).find('input[type="text"]').focus();
        })
        $(document).on('keyup','.answer_in',function(){
           var answer = $(this).val();
           $('.answer_in').removeClass('active');
           $(this).addClass('active');
           $('.answer_in').each(function(){
               if(!$(this).hasClass('active')){
                   if($(this).val() == answer){
                       toastr.error('This is same answer please put another answer..');
                   }
               }
           });
        });
        
    
        $(document).on('click','.remove-answer',function(){
            var div = $(this).closest('.input-group');
            Swal.fire({
                html: "Are you sure you want to Remove?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, delete!",
                cancelButtonText: "No, cancel",
                customClass: {
                    confirmButton: "btn fw-bold btn-danger",
                    cancelButton: "btn fw-bold btn-active-light-primary"
                }
            }).then(function (result) {
                if (result.value) {
                    div.remove();
                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: "Answer was not deleted.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn fw-bold btn-primary",
                        }
                    });
                }
            });
        })
    })
    
    
    
</script>