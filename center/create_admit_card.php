<?
require_once 'includes/header.php';
if($_POST['status']=='admit_card')
{
	$chk = $con->query("SELECT * FROM admit_card where enrollment_no = '".$_POST['enrollment_no']."' OR roll_no = '".$_POST['roll_no']."'");
	if(!($chk->num_rows))
	{
		$con->query("INSERT INTO `admit_card` (`id`, `timestamp`, `enrollment_no`, `roll_no`, `course_id`, `center_id`, `exam_center`, `exam_date`, `exam_time`) VALUES (NULL, CURRENT_TIMESTAMP, '".$_POST['enrollment_no']."', '".$_POST['roll_no']."', '".$_POST['course_id']."', '".$_GET['center_id']."', '".$_POST['exam_center']."', '".$_POST['exam_date']."', '".$_POST['exam_time']."')");
		echo '<script>alert("Admit Card Generate Successfully.");location.href="create_admit_card.php"</script>';
	}
	else
	{
	    echo '<script>alert("Admit Card Already Exists.");location.href="create_admit_card.php"</script>';
	}
}
if($_GET['action']=='del')
{
	$con->query("DELETE FROM admit_card where id = '".$_GET['id']."'");
	echo '<script>alert("Admit Card Deleted.");location.href="create_admit_card.php"</script>';
}
$enrollment_no = $_POST['enrollment_no'];
error_log("Received enrollment_no: " . $enrollment_no);
?>
<div class="box box-success">
	<div class="box-header"><h3>Generate Admit Card</h3></div>
	<div class="box-body">
	
<?

	$student = $con->query("SELECT * FROM students WHERE status = '1' AND center_id = '".$_SESSION['center']['id']."'");
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
					    $chk = $con->query("SELECT * FROM students WHERE `enrollment_no` = '".$g['enrollment_no']."' AND center_id = '".$_SESSION['center']['id']."'");
					    if(!$chk->num_rows)
					        continue;
						$c = $con->query("SELECT * FROM courses where id = '".$g['course_id']."'")->fetch_assoc();
				// 		print_r($c['course_name']);
						echo '<tr>
								<td>'.$g['enrollment_no'].'</td>
								<td>'.$g['roll_no'].'</td>
								<td>'.$c['course_name'].'</td>
								
								<td><a href="?id='.$g['id'].'&action=del" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
						</tr>';
					}
				// 	print_r($c['course_name']);
				?>
				
			</tbody>
		</table>
	</div>
</div>
<?
include 'includes/footer.php';
?>

<script>
    $('.get_course').change(function(){
    var dataString = 'enrollment_no='+$(this).val()+'&status=get_courses';
    $.ajax({
        url: "Ajax.php",
        type: "POST",
        data: dataString,
        beforeSend: function() {
            $('#load').html('<i class="text-danger"><i class="fa fa-spinner fa-spin"></i> Loading...</i>');
        },
        success: function(res) {
            // Split the response into course name and course ID
            var data = res.split('|');
            var courseName = data[0];
            var courseId = data[1];
            
            // Set the value of the course input field and course_id hidden field
            $('#data').val(courseName);
            $('#course_id').val(courseId);
        },
        complete: function() {
            $('#load').html('<i class="text-success"><i class="fa fa-check-circle"></i> Complete</i>');
        }
    });
});

</script>