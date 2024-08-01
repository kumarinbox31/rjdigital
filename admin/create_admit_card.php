<?php
require_once 'includes/header.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['status']) && $_POST['status'] == 'admit_card') {
    $chk = $con->query("SELECT * FROM admit_card WHERE enrollment_no = '" . $_POST['enrollment_no'] . "' OR roll_no = '" . $_POST['roll_no'] . "'");

    if (!($chk->num_rows)) {
        $center_id = isset($_POST['center_id']) ? $_POST['center_id'] : ''; // Adjust this line based on your form data
        // var_dump($_POST);
        $data = $con->query("INSERT INTO `admit_card` (`id`, `timestamp`, `enrollment_no`, `roll_no`, `course_id`, `center_id`, `exam_center`, `exam_date`, `exam_time`) VALUES (NULL, CURRENT_TIMESTAMP, '" . $_POST['enrollment_no'] . "', '" . $_POST['roll_no'] . "', '" . $_POST['course_id'] . "', '" . $center_id . "', '" . $_POST['exam_center'] . "', '" . $_POST['exam_date'] . "', '" . $_POST['exam_time'] . "')");
        if (!$data) {
    die('Error: ' . $con->error);
}
        echo '<script>alert("Admit Card Generate Successfully.");location.href="create_admit_card.php"</script>';
        exit; // Exit after redirect
    } else {
        echo '<script>alert("Admit Card Already Exists.");location.href="create_admit_card.php"</script>';
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'del') {
    $con->query("DELETE FROM admit_card WHERE id = '" . $_GET['id'] . "'");
    echo '<script>alert("Admit Card Deleted.");location.href="create_admit_card.php"</script>';
}
?>

<div class="box box-success">
	<div class="box-header"><h3>Generate Admit Card</h3></div>
	<div class="box-body">
	
<?

	$student = $con->query("SELECT * FROM students WHERE status = '1'");
	if($student->num_rows)
	{
?>
		<form action="" method="post">
			<div class="form-group col-md-6">
				<label>Enrollment No.</label>
				<select class="form-control get_course" name="enrollment_no" required="">
					<option value="">--Select--</option>
					<?
						while($stu = $student->fetch_assoc())
						{
						    $chk = $con->query("SELECT * FROM admit_card where enrollment_no = '".$stu['enrollment_no']."' ");
						    if($chk->num_rows)
						       continue;
				 			echo '<option value="'.$stu['enrollment_no'].'">'.$stu['enrollment_no'].'</option>';
						}
					?>
				</select>
			</div>
			<div class="form-group col-md-6">
				<label>Roll No.</label>
				<input type="number" class="form-control" name="roll_no" placeholder="Enter Roll No." required="">
			</div>
			<div class="form-group col-md-6">
				<label> Course <span id="load"></span></label>
			    <input type="hidden" name="course_id" value="" id="course_id">
			     <input type="text" class="form-control"  value="" id="data" readonly>
			</div>
			<div class="form-group col-md-6">
				<label> Exam Center</label>
			      <input type="text" class="form-control" name="exam_center" placeholder="Exam Center Name"  required>
			</div>
			<div class="form-group col-md-6">
				<label> Exam Date</label>
			      <input type="date" class="form-control" name="exam_date"  required>
			</div>
			<div class="form-group col-md-6">
				<label> Exam Time</label>
			      <input type="time" class="form-control" name="exam_time"  required>
			</div>
			<div class="form-group col-md-12">
				<button class="btn btn-success" type="submit" name="status" value="admit_card"><i class="fa fa-save"></i> Submit</button>
			</div>
		</form>
<?
	}
	else
	{
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
					$get = $con->query("SELECT * FROM admit_card");
					while($g = $get->fetch_assoc())
					{
						$c = $g['course_id'] ? $con->query("SELECT * FROM courses where id = '".$g['course_id']."'")->fetch_assoc() : null;
					
                        echo '<tr>
                                <td>'.$g['enrollment_no'].'</td>
                                <td>'.$g['roll_no'].'</td>
                                <td>'.($c ? $c['course_name'] : '').'</td>
                                <td><a href="?id='.$g['id'].'&action=del" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
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
<script>
$('.get_course').change(function () {
    // alert($(this).val());
    var dataString = 'enrollment_no=' + $(this).val() + '&status=get_courses';
    $.ajax({
        url: "Ajax.php",
        type: "POST",
        data: dataString,
        dataType : 'json',
        beforeSend: function () {
            $('#load').html('<i class="text-danger"><i class="fa fa-spinner fa-spin"></i> Loading...</i>');
        },
        success: function (res) {
            console.log(res); // Log the response to the console for debugging
            // var data = JSON.parse(res);
            
            $('#data').val(res.course_name);
                $('#course_id').val(res.id);
            //BCA|12 |
            // try {
            //     // Attempt to parse the response as JSON
                // var data = res.split('|');//JSON.parse(res);
                // $('#data').val(data[0]);
                // $('#course_id').val(data[1]);
            // } catch (error) {
                // Log any parsing errors
                // console.error('Error parsing JSON:', error);
            // }
        },
        error: function (xhr, status, error) {
            // Log any AJAX errors
            console.error('AJAX Error:', status, error);
        },
        complete: function () {
            $('#load').html('<i class="text-success"><i class="fa fa-check-circle"></i> Complete</i>');
        }
    });
});

</script>