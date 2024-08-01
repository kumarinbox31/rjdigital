$(document).ready(function(){
   
   const ajax_url = base_url + 'admin/ExamAjax.php';
   
    $('.select2').select2();
      
      

   
const SwalShowloading = (message = '') => {
    Swal.fire({
        title: 'Loading....',
        html: message,
        allowOutsideClick: false,
        showCancelButton: false,
        showConfirmButton: false
    });
    Swal.showLoading();
}
const SwalHideLoading = () => {
  Swal.hideLoading();
  Swal.close();
};
const SwalWarning = (message) => {
    Swal.fire({
        title: 'Notice',
        icon : 'warning',
        html: message,
        allowOutsideClick: false
    });
}   
   
   var sn = 1;
   const list_Exams = $('#list-exams').DataTable({
                   ajax: {
                        url: ajax_url,
                        data : {status : 'exam_list'},
                        success: function (d) {
                            // console.log(d);
                            if (d.data && d.data.length) {
                                list_Exams.clear();
                                list_Exams.rows.add(d.data).draw();
                                $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                                      checkboxClass: 'icheckbox_flat-green',
                                      radioClass   : 'iradio_flat-green'
                                })
                                   $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                                      checkboxClass: 'icheckbox_minimal-blue',
                                      radioClass   : 'iradio_minimal-blue'
                                    })
                                    //Red color scheme for iCheck
                                    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                                      checkboxClass: 'icheckbox_minimal-red',
                                      radioClass   : 'iradio_minimal-red'
                                    })
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
                        {'data' : 'id'},
                        {'data' : null},
                        {'data' : 'exam_name'},
                        {'data' : 'max_questions'},
                        {'data' : null},
                        {'data' : null},
                        {'data' : null},
                        {'data' : null}
                    ],
                    columnDefs: [
                            {
                              targets : 0,
                              render : function(data,type,row){
                                  return `${sn++}.`;
                              }
                            },
                            {
                              target : 1,
                              render : function(data,type,row){
                                  return `${row.course_name}`;
                              }
                            },
                            {
                              targets: 3,
                              render : function(data,typ,row){
                                  return `${data} Question(s)`;
                              }
                            },
                            {
                                targets : 4,
                                orderable: false,
                                render : function(data,type,row){
                                    return `<a href="${base_url}admin/exam-questions.php?exam_id=${row.id}" class="btn btn-primary btn-xs" data-toggle="tooltip" data-orginal-title="Go To Question Area"><i class="fa fa-plus"></i> Add</a>`;
                                }
                            },
                            {
                                targets : 5,
                                orderable: false,
                                render : function(data,type,row){
                                    return `<button class="btn btn-xs bg-maroon btn-flat set-schedual" data-id="${row.id}" data-start="${row.start}" data-end="${row.end}"><i class="fa fa-clock-o"></i> Set</button>`;
                                }
                            },
                            
                            {
                                targets : 6,
                                orderable: false,
                                render : function(data,type,row){
                                    return `<center>
                                            <label data-id="${row.id}">
                                            <select class="change-status">
                                                <option value="1" ${ row.status == '1' ? 'selected' : '' }>Active</option>
                                                <option value="0" ${ row.status == '0' ? 'selected' : '' }>In-Active</option>
                                            </select></center></label>`;
                                }
                            },
                            {
                                targets : -1,
                                data: null,
                                orderable: false,
                                className: 'text-end',
                                render : function(data,type,row){
                                    return `<buton class="btn btn-xs btn-danger delete-row" data-id="${row.id}"><i class="fa fa-trash"></i></button>`;
                                }
                            },
                    ]
               });
    $(document).on('click','.set-schedual',function(){
        var id = $(this).data('id'),
            start_date = $(this).data('start'),
            end_date = $(this).data('end'),
            btn = this;
        $.confirm({
            title : 'Set Schedule',
            icon : 'fa fa-clock-o',
            theme : 'bootstrap',
            content : `<form action="" class="form-schedule">
                            <div class="form-group">
                                <label>Exam Start</label>
                                <input type="text" name="start" class="form-control start" value="${start_date}">
                            </div>
                            
                            <div class="form-group">
                                <label>Exam End</label>
                                <input type="text" name="end" class="form-control end" value="${end_date}">
                            </div>
                        </form>`,
            buttons : {
                formSubmit : {
                    text : 'Save',
                    icon : 'fa fa-save',
                    btnClass : 'btn-success',
                    action : function(){
                        var start = this.$content.find('.start').val();
                        var end = this.$content.find('.end').val();
                        var status = 'set-exam-schedule';
                        if(!start || !end){
                            $.alert('provide valid Both dates');
                            return false;
                        }
                        
                        if(start > end){
                            $.alert('Select Valid dates');
                            return false;
                        }
                        
                        SwalShowloading();
                        // $.alert('Your name is ' + start + ',' + end);
                        $.post(ajax_url,{
                            id,start,end,status
                        },function(res){
                            res = JSON.parse(res);
                            //if(res.status){
                                $(btn).data('start',start);
                                $(btn).data('end',end);
                                toastr.success("Schedule Set Successfully..");
                                SwalHideLoading();
                            
                        });
                    }
                },
                cancel:function(){
                    
                }
            },
            onContentReady: function () {
                // bind to events
                var jc = this;
                this.$content.find('form').on('submit', function (e) {
                    // if the user submits the form by pressing enter in the field.
                    e.preventDefault();
                    jc.$$formSubmit.trigger('click'); // reference the button and click it
                });
                var options = {
                    enableTime: true,
                    dateFormat: "Y-m-d H:i", // Customize the date and time format as needed
                    theme: "material_green",
                    minDate : 'today'
                };
                this.$content.find('input[name="start"]').flatpickr(options);
                this.$content.find('input[name="end"]').flatpickr(options);
            }
        });
    })          
    //change-status
    $(document).on('change','.change-status',function(){
        var id = $(this).val();
        var exam_id = $(this).closest('label').data('id');
        // alert(id);
        $.post(ajax_url,{status:'change-exam-status',eStatus : id, exam_id : exam_id },function(r){
            console.log(r);
            toastr.success('Exam Activation Status Update Successfully...');
        });
    });
    
    $(document).on('click','.delete-row',function(){
        var id = $(this).data('id');
        var td = this,
            tdValue = $(td).html();
          Swal.fire({
                html: "Are you sure you want to delete?",
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
                    $.post(ajax_url,{status : 'delete_exam','id' : id},function(res){
                     // console.log(res); 
                        toastr.success('Exam and exam\'s Question and question of all answers Removed Successfully..');
                        location.reload();
                    })
                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: "Exam was not deleted.",
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
               
   $('#exam-form').bootstrapValidator({
                fields: {
                    'exam_name': {
                        validators: {
                            notEmpty: {
                                message: 'Please Enter Exam Name'
                            },
                            // Add other validators as needed
                        }
                    },
                    course_id : {
                        validators : {
                            notEmpty:{
                                message : 'Select A Course'
                            }
                        }
                    }
                }
            });
    var i = 1;
     $('#exam-form').on('submit',function(e){
                e.preventDefault();
                // alert(0);
                
                if($(this).find('.has-error').length == 0 && i){
                    i = 0;
                    console.log($(this).serialize());
                    var btn = $(this).find('.save-btn'),
                        btnHtml = $(btn).html();
                        
                        $(btn).html('<i class="fa fa-spiner fa-spin"></i> Please Wait..').prop('disabled',true);
                    $.ajax({
                        type : 'POST',
                        url : ajax_url,//'admin/Ajax.php',
                        data : $(this).serialize(),
                        dataType : 'json',
                        success : function(res){
                            console.log(res);
                            i =1;
                            if(res.status){
                                toastr.success('Exam created Successfully..');
                                document.getElementById('exam-form').reset();
                              location.reload();
                            }
                            else{
                                toastr.error(res.message);
                            }
                            $(btn).html(btnHtml).prop('disabled',false);
                        },
                        error: function(a,v,c){
                            i = 1;
                            console.warn(a.responseText);
                            $(btn).html(btnHtml).prop('disabled',false);
                        }
                    });
                }
            });
   
   

   
   
    
});