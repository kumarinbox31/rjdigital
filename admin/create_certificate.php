<?php

require_once 'includes/header.php';

if ($_GET['action'] == 'changeStatus') {
    $val = $_GET['val'] ? 0 : 1;
    $id = $_GET['id'];
    $con->query("UPDATE `certificates` SET `status`= '$val' WHERE id = '$id'");
    echo '<script>alert("Changed Successfully.");window.location.href="create_certificate.php"</script>';
}

if ($_POST['status'] == 'certificate') {
    $chk = $con->query("SELECT * FROM certificates where enrollment_no = '".$_POST['enrollment_no']."'");
    if (!($chk->num_rows)) {   
        $id = $_POST['enrollment_no'];
        $st = $con->query("SELECT * FROM students WHERE enrollment_no = '$id'");
        if ($st->num_rows) {
            $st = $st->fetch_assoc();
            $dob = $st['dob'];
            $sql = "INSERT INTO `certificates` (`certificate_no`,`grade`, `enrollment_no`, `session`, `dob`, `issue_date`, `serial_no`, `total_marks`, `obtain_marks`, `percentage`) VALUES
                    ('".$_POST['certificate_no']."','".$_POST['grade']."', '$id', '".$_POST['session_y']."', '$dob', '".$_POST['issue_date']."', '".$_POST['serial_no']."', '".$_POST['total_marks']."', '".$_POST['obtain_marks']."', '".$_POST['percentage']."')";
            $ins = $con->query($sql);
            if (!$ins) {
                print_r($con->error);
                exit;
            }
            echo '<script>alert("Certificate Create success.");location.href="create_certificate.php"</script>';
        } else {
            echo '<script>alert("Something went wrong.");location.href="create_certificate.php"</script>';
        }
    } else {
        die('bye');
    }
}

if ($_GET['action'] == 'del') {
    $con->query("DELETE FROM certificates where id = '".$_GET['id']."'");
    echo '<script>alert("Certificate Deleted.");location.href="create_certificate.php"</script>';
}
?>

<script>
function calculatePercentage() {
    // Get the values from the input fields
    var totalMarks = document.getElementById("totalMarks").value;
    var obtainedMarks = document.getElementById("obtainedMarks").value;
    
    // Check if the values are numbers and not empty
    if (totalMarks && obtainedMarks && !isNaN(totalMarks) && !isNaN(obtainedMarks)) {
        // Calculate the percentage
        var percentage = (obtainedMarks / totalMarks) * 100;
        
        // Set the percentage field with the calculated value
        document.getElementById("percentage").value = percentage.toFixed(2);
    	calGrade();
    } else {
        // If the values are not valid, clear the percentage field
        document.getElementById("percentage").value = "";
    }
}
</script>

<div class="box box-primary">
    <div class="box-header"><h3>Create Certificate</h3></div>
    <div class="box-body">

        <?php
        $student = $con->query("SELECT * FROM students");
        if ($student->num_rows) {
        ?>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group col-md-4">
                    <label>Enrollment No.</label>
                    <select class="form-control" name="enrollment_no" required>
                        <option value="">--Select--</option>
                        <?php
                        while ($stu = $student->fetch_assoc()) {
                            $chk = $con->query("SELECT * FROM certificates where enrollment_no = '".$stu['enrollment_no']."'");
                            if ($chk->num_rows) continue;
                            echo '<option value="'.$stu['enrollment_no'].'">'.$stu['enrollment_no'].'</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label>Certificate No</label>
                    <input type="text" name="certificate_no" class="form-control">
                </div>
                
                <div class="form-group col-md-4">
                    <label>Issue Date</label>
                    <input type="date" name="issue_date" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <label>Total Marks</label>
                    <input type="text" id="totalMarks" name="total_marks" class="form-control" oninput="calculatePercentage()">
                </div>
                <div class="form-group col-md-4">
                    <label>Obtained Marks</label>
                    <input type="text" id="obtainedMarks" name="obtain_marks" class="form-control" oninput="calculatePercentage()">
                </div>
                <div class="form-group col-md-4">
                    <label>Percentage</label>
                    <input type="text" id="percentage" name="percentage" class="form-control" readonly>
                </div>
                <div class="form-group col-md-4">
                    <label>Grade</label>
                    <input type="text" name="grade" class="form-control" readonly>
                </div>
                <div class="form-group col-md-12">
                    <button class="btn btn-primary" type="submit" name="status" value="certificate"><i class="fa fa-save"></i> Submit</button>
                </div>
            </form>
        <?php
        } else {
            echo '<br><br><br><br><div class="alert alert-danger">Student Not Available.</div>';
        }
        ?>
    </div>
    <div class="box-footer">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Certificate No.</th>
                    <th>Enrollment No.</th>
                    <th>DOB</th>
                    
                    <!--<th>Status</th>-->
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $get = $con->query("SELECT * FROM `certificates`");
                while ($g = $get->fetch_assoc()) {
                    $statusBtn = $g['status'] ? 'success' : 'danger';
                    $statusIcon = $g['status'] ? 'on' : 'off';
                    echo '<tr>
                            <td>'.$g['certificate_no'].'</td>
                            <td>'.$g['enrollment_no'].'</td>
                            <td>'.$g['dob'].'</td>
                            
                            <!--<td>
                                <a href="?action=changeStatus&id='.$g['id'].'&val='.$g['status'].'" class="btn btn-sm btn-'.$statusBtn.'"><i class="fa fa-toggle-'.$statusIcon.'"></i></a>
                            </td>-->
                            <td><a href="?action=del&id='.$g['id'].'" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                          </tr>';
                }

                function convertToThreeDigits($number) {
                    return str_pad($number, 3, '0', STR_PAD_LEFT);
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
include 'includes/footer.php';
?>

<script type="text/javascript">
$('.get_subject').change(function(){
    var dataString = 'course_id=' + $(this).val() + '&status=subjects';
    $.ajax({
        url: "Ajax.php",
        type: "POST",
        data: dataString,
        beforeSend: function() {
            $('#list').html('<i class="text-danger"><i class="fa fa-spinner fa-spin"></i> Loading...</i>');
        },
        success: function($__res) {
            $('#list').html($__res);
        }
    });
})

$('.get_roll').change(function(){
    var dataString = 'enrollment_no=' + $(this).val() + '&status=get_roll';
    $.ajax({
        url: "Ajax.php",
        type: "POST",
        data: dataString,
        beforeSend: function() {
            $('#load').html('<i class="text-danger"><i class="fa fa-spinner fa-spin"></i> Loading...</i>');
        },
        success: function(res) {
            $('#roll').val(res);
        },
        complete: function() {
            $('#load').html('<i class="text-success"><i class="fa fa-check-circle"></i> Complete</i>');
        }
    });
})
function calGrade() {
    var grade = '';
    var per = $('#percentage').val();

    if (per > 75) {
        grade = 'A';
    } else if (per >= 65 && per <= 75) {
        grade = 'B';
    } else if (per >= 55 && per < 65) {
        grade = 'C';
    } else if (per >= 50 && per < 55) {
        grade = 'D';
    } else {
        grade = 'F'; // Handle percentages less than 50 if needed
    }

    $('input[name="grade"]').val(grade);
}

</script>
