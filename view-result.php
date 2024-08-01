<?php
require_once 'includes/header.php';
if(isset($_GET['result_id'])){
    $resultId = base64_decode($_GET['result_id']);
    $check  =   $con->query("SELECT * FROM exams_by_students WHERE id = '$resultId' ");
    if($check->num_rows){
        $row = $check->fetch_assoc();
        $student = $con->query("SELECT * FROM students WHERE id = '".$row['student_id']."'")->fetch_assoc();
         $course = $con->query("SELECT * FROM courses WHERE id = '".$row['course_id']."'")->fetch_assoc();
         $exam = $con->query("SELECT * FROM exams WHERE id = '".$row['exam_id']."'")->fetch_assoc();
        ?>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h3 class="card-title text-white"><?= $exam['exam_name'] ?></h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <tr>
                                <th>Name</th>
                                <td><?= $student['name'] ?></td>
                            </tr>
                            <tr>
                                <th>Course</th>
                                <td><?= $course['course_name'] ?></td>
                            </tr>
                            <tr>
                                <th>Total Questions</th>
                                <td><?= $row['max_marks']?></td>
                            </tr>
                            <tr>
                                <th>Result</th>
                                <td><?= round( ($row['total'] / $row['max_marks']) * 100  ) ?>%</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
require_once 'includes/footer.php';
?>