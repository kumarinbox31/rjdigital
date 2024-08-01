<?php
define('environment','production');
include 'includes/header.php';
// if(isset($_POST['status'])){
//      $status =  $con->query("INSERT INTO `exams` (`id`, `exam_name`, `no_questions`, `course_id`) VALUES (NULL, '".$_POST['exam_name']."', '".$_POST['max_questions']."', '".$_POST['course_id']."')");
//           print_r($con);
//           exit;
//     echo '<script>alert("Exam create successfully..");location.href="'.BASE_URL.'admin/exam-area.php";</script>';
// }
// ?>
<div class="row">
    <div class="col-md-4">
        <form action="" id="exam-form" method="POST">
                <input type="hidden" name="status" value="create_exam">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-plus"></i> Add Exam</h3>
                </div>
                <div class="panel-body">
                    
                    <div class="form-group">
                        <label>Course</label>
                        <select name="course_id" required class="form-control select2 " data-placeholder="Select A Course">
                            <option value="">Select Course</option>
                            <?php
                            $courses = $con->query("SELECT * FROM courses");
                            while($row = $courses->fetch_assoc()){
                                echo '<option value="'.$row['id'].'">'.$row['course_name'].'</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Enter Exam Name</label>
                        <input type="text" name="exam_name" required class="form-control" placeholder="Enter Exam Name..">
                    </div>
                    <div class="form-group">
                        <label>Max Question List ON Paper</label>
                        <input type="number" name="max_questions" required class="form-control" placeholder="Enter Max Questions.." value="20">
                    </div>
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-success save-btn"><i class="fa fa-save"></i> Save Exam</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-8">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">
                    List Exam
                </h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="list-exams">
                        <thead>
                            <tr>
                                <th>#.</th>
                                <th>Course Name</th>
                                <th>Exam Title</th>
                                <th>Max Questions</th>
                                <th>Questions</th>
                                <th>Schedule</th>
                                <th>Status</th>
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
include 'includes/footer.php';
?>
<script>var base_url = '<?=BASE_URL?>';</script>
<link rel="stylesheet" href="theme/bower_components/select2/dist/css/select2.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.css" rel="stylesheet">
<script src="theme/bower_components/select2/dist/js/select2.full.min.js"></script>
<link rel="stylesheet" href="theme/plugins/iCheck/all.css">
<style>
    .flatpickr-calendar{
        z-index:99999999!important;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script src="theme/plugins/iCheck/icheck.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js"></script>
<script src="<?=BASE_URL?>admin/exam.js"></script>