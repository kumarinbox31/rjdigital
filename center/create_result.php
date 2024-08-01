<?php
require_once 'includes/header.php';

if ($_GET['action'] == 'changeStatus') {
    $val = $_GET['val'] ? 0 : 1;
    $id = $_GET['id'];
    $con->query("UPDATE `results` SET `status`= '$val' WHERE id = '$id'");
    echo '<script>alert("Changed Successfully.");window.location.href="create_result.php"</script>';
}

if ($_POST['status'] == 'create_result') {
    $chk = $con->query("SELECT * FROM results where roll_no = '" . $_POST['roll_no'] . "' OR enrollment_no = '" . $_POST['enrollment_no'] . "'");
    if (!($chk->num_rows)) {
        $res = $con->query("INSERT INTO `results` (`roll_no`,`session`,`serial_no`,`issue_date`, `course_id`, `enrollment_no`, `center_id`,`grade`,`result`) VALUES 
        ('" . $_POST['roll_no'] . "','".$_POST['session-year']."','".$_POST['serial_no']."','".$_POST['issue_date']."', '" . $_POST['course_id'] . "','" . $_POST['enrollment_no'] . "', '" . $_SESSION['center']['id'] . "','" . $_POST['grade'] . "','" . $_POST['result'] . "')");

        if ($res) {
            $result_id = $con->insert_id;  // Get the last inserted result_id

            // Insert marks data into marks_table
            if (isset($_POST['marks']) && is_array($_POST['marks'])) {
                
                // foreach ($_POST['marks'] as $subject_id => $marks) {
                //     $con->query("INSERT INTO `marks_table` (`result_id`, `marks`, `subject_id`) VALUES 
                //     ('$result_id', '$marks', '$subject_id')");
                    
                // }
                foreach($_POST['subject_id'] as $index => $sub_id){
                    $marks = $_POST['marks'][$index];
                    $con->query("INSERT INTO `marks_table` (`id`, `timestamp`, `result_id`, `marks`, `subject_id`) VALUES (NULL, CURRENT_TIMESTAMP, '$result_id', '$marks', '$sub_id')");
                }
                
                echo '<script>alert("marks submitted successfully");location.href="create_result.php";</script>';
            }

            echo '<script>alert("Result Created Successfully uploaded.");location.href="create_result.php";</script>';
        } else {
            print_r($con->error);
            exit;
        }
    } else {
        die('hi');
    }
}

if ($_GET['action'] == 'del') {
    $con->query("DELETE FROM results where id = '" . $_GET['id'] . "'");
    $con->query("DELETE FROM marks_table where result_id = '" . $_GET['id'] . "'");
    echo '<script>alert("Result Deleted.");location.href="create_result.php"</script>';
}
?>

<div class="box box-primary">
    <div class="box-header"><h3>Create Result</h3></div>
    <div class="box-body">

        <?php

        $student = $con->query("SELECT * FROM students WHERE `status` = '1' AND center_id = '" . $_SESSION['center']['id'] . "'");
        if ($student->num_rows) {
        ?>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group col-md-4">
                    <label>Enrollment No.</label>
                    <select class="form-control get_roll" name="enrollment_no" required="">
                        <option value="">--Select--</option>
                        <?
                        while ($stu = $student->fetch_assoc()) {
                            $chk = $con->query("SELECT * FROM results where enrollment_no = '" . $stu['enrollment_no'] . "'");
                            if ($chk->num_rows)
                                continue;
                            echo '<option value="' . $stu['enrollment_no'] . '">' . $stu['enrollment_no'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label>Roll No. &nbsp;<span id="load"></span></label>
                    <input id="roll" type="number" class="form-control" name="roll_no">
                </div>
                <div class="form-group col-md-4">
                    <label>Issue Date. &nbsp;<span id="load"></span></label>
                    <input  type="date"  class="form-control" name="issue_date">
                </div>
                <div class="form-group col-md-4">
                    <label>Serial No. &nbsp;<span id="load"></span></label>
                    <input  type="text"  class="form-control" name="serial_no">
                </div>
                <div class="form-group col-md-4">
                    <label>Session<span id="load"></span></label>
                    <input  type="text"  class="form-control" name="session-year">
                </div>
                <div class="form-group col-md-4">
                    <label> Course &nbsp;<span id="load"></span></label>
                    <input type="hidden" name="course_id" id="course_id" value="">
                    <input type="text" class="form-control get_subject" id="data" value="" readonly>
                </div>
                
                
                <?
                    if (isset($_POST['status']) && $_POST['status'] == 'subjects') {
                    // Get the course ID from the POST data
                    $course_id = $_POST['course_id'];
                
                    // Fetch subjects for the specific course
                    $subjectsQuery = $con->query("SELECT * FROM subjects WHERE course_id = '" . $course_id . "'");
                    
                    // Create a string to store the HTML
                    $subjectHTML = '';
                
                    // Fetch subjects and add them to the HTML string
                    while ($subject = $subjectsQuery->fetch_assoc()) {
                        $subjectHTML .= '<div class="form-group col-md-4">' .
                                        '<label>' . $subject['subject_name'] . '</label>' .
                                        '<input type="number" class="form-control" name="marks[' . $subject['id'] . ']" placeholder="Enter marks for ' . $subject['subject_name'] . '" required>' .
                                        '</div>';
                    }
                
                    // Return the HTML response
                    echo $subjectHTML;
                    exit;
    }
                ?>
                <div id="list"></div>
                <div class="form-group col-md-12">
                    <button type="submit" name="status" value="create_result" class="btn btn-sm btn-primary">Submit</button>
                </div>
            </form>
        <?
        } else {
            echo '<br><br><br><br><div class="alert alert-danger">Student Not Available.</div>';
        }

        ?>
    </div>
    <div class="box-footer">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Enrollment No.</th>
                    <th>Roll No.</th>
                    <th>Course Name</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?
                $get = $con->query("SELECT * FROM results");
                while ($g = $get->fetch_assoc()) {
                    $statusBtn = $g['status'] ? 'success' : 'danger';
                    $statusIcon = $g['status'] ? 'on' : 'off';
                    $c = $con->query("SELECT * FROM courses where id = '" . $g['course_id'] . "'")->fetch_assoc();
                    echo '<tr>
                                <td>' . $g['enrollment_no'] . '</td>
                                <td>' . $g['roll_no'] . '</td>
                                <td>' . $c['course_name'] . '</td>
                                <td><a href="?id=' . $g['id'] . '&action=del&center_id=' . $_GET['center_id'] . '" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                    </tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?
include 'includes/footer.php';
?>
<script type="text/javascript">
    $(document).ready(function() {
        $('.get_subject').on('change', function() {
            get_subject();
        });
    });

  function get_subject() {
    var dataString = 'course_id=' + $('#course_id').val() + '&status=subjects';
    $.ajax({
        url: "../admin/Ajax.php",
        type: "POST",
        data: dataString,
        beforeSend: function() {
            $('#list').html('<i class="text-danger"><i class="fa fa-spinner fa-spin"></i> Loading...</i>');
        },
        success: function(response) {
            // Append the HTML directly to the form
            $('#list').html(response);
        },
        complete: function() {}
    });
}


</script>
<script type="text/javascript">
    $('.get_roll').change(function() {
        var dataString = 'enrollment_no=' + $(this).val() + '&status=get_roll';
        $.ajax({
            url: "../admin/Ajax.php",
            type: "POST",
            data: dataString,
            beforeSend: function() {
                $('#load').html('<i class="text-danger"><i class="fa fa-spinner fa-spin"></i> Loading...</i>');
            },
            success: function(res) {
                var data = res.split('|');
                $('#roll').val(data[0]);
                $('#course_id').val(data[1]);
                $('#data').val(data[2]);
                return get_subject();
            },
            complete: function() {
                $('#load').html('<i class="text-success"><i class="fa fa-check-circle"></i> Complete</i>');
            }
        });
    })
</script>

