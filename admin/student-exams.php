<?php
require 'includes/header.php';
?>
<div class="row">
    <div class="col-md-12">
        <form>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">List Student Exam</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" id="students_exams">
                            <thead>
                                <tr>
                                    <th>#.</th>
                                    <th>Stuent Name</th>
                                    <th>Exam Name</th>
                                    <th>Questions</th>
                                    <th>Total Attempts</th>
                                    <th>Total Right</th>
                                    <th>Result</th>
                                    <th>Move Tabs</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php
require 'includes/footer.php';

?>

<script>
    var sn = 1;
    var base_url = '<?=BASE_URL?>';
    var table = $('#students_exams').DataTable({
                   ajax: {
                        url: '<?=BASE_URL?>admin/ExamAjax.php',
                        data : {status : 'students_exam_list'},
                        success: function (d) {
                            console.log(d);
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
                        {'data' : 'id'},
                        {'data' : 'student_name'},
                        {'data' : 'exam_name'},
                        {'data' : 'max_marks'},
                        {'data' :'ttl_attempts'},
                        {'data' : null},
                        {'data' : null},
                        {'data' : 'nextTabsOpen'},
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
                                  return `${data} <label class="label label-success">${row.enrollment_no}</label>`;
                              }
                            },
                            {
                              target : 2,
                              render : function(data,type,row){
                                  return `${data} <label class="label label-success">${row.course_name}</label>`;
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
                                    return `${data} Question(s)`;
                                }
                            },
                            {
                                targets : 5,
                                // orderable: false,
                                render : function(data,type,row){
                                    var per = (  (row.total / row.max_marks )) * 100;
                                    return `<b>${per} %</b>`;//`<button class="btn btn-xs bg-maroon btn-flat set-schedual" data-id="${row.id}" data-start="${row.start}" data-end="${row.end}"><i class="fa fa-clock-o"></i> Set</button>`;
                                }
                            },
                            
                            {
                                targets : 6,
                                orderable: false,
                                render : function(data,type,row){
                                    return `${row.total} Right Answer(S)`;
                                }
                            },
                            
                            {
                                targets : 7,
                                orderable: false,
                                render : function(data,type,row){ 
                                    return `<label class="label label-danger">${data} Times moved</label>`;
                                }
                            },
                            {
                                targets : -1,
                                data: null,
                                orderable: false,
                                className: 'text-end',
                                render : function(data,type,row){
                                    return `<buton class="btn btn-xs btn-danger delete-row" data-id="${row.student_exam_id}"><i class="fa fa-trash"></i></button>`;
                                }
                            },
                    ]
               });
</script>