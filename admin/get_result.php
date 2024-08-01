<?
// require_once 'includes/config.php';
require_once 'includes/header.php';
if(isset($_POST['status']) && $_POST['status']=='result')
{
	$result = $con->query("SELECT * FROM results where roll_no = '".$_POST['roll_no']."' and status = 1");
	if($result->num_rows)
	{
		$__R = $result->fetch_assoc();
		$course = $con->query("SELECT * FROM courses where id = '".$__R['course_id']."'")->fetch_assoc();
		$stu = $con->query("SELECT * FROM students where dob = '".$_POST['dob']."' AND enrollment_no = '".$__R['enrollment_no']."' ");
		if($stu->num_rows)
		{
			$__S = $stu->fetch_assoc();
			$institute = $con->query("SELECT * FROM centers where id = '".$__S['center_id']."'")->fetch_assoc();
			
			 $bg = 'format/marksheet.jpg';
            $enroll_no = $__S['enrollment_no'];
            $name = ucwords($__S['name']);
            $father = ucwords($__S['father']);
            $course_name = ucwords($course['course_name']);
            $roll_no = $__R['roll_no'];
            $center_name = $institute['institute_name'];
            // include 'result.php';
            // exit;
			?>
				<div class="box box-default">
					<div class="box-header">
					    <h3>Result</h3>
					    <a download class="btn btn-sm btn-success" href="../uploads/files/<?=$__R['file']?>"><i class="fa fa-download"></i> Download</a>
					</div>
					<div class="box-body" id="printableArea">
						<table class="table table-bordered">
							<tbody>
								<tr><td rowspan="7"><img src="uploads/students/<?=$__S['photo']?>" style="width: 100%;height: 200px"></td></tr>
								<tr><th>Institute Name</th> <td> <?=$institute['institute_name']?></td></tr>
								<tr><th>Enrollment No.</th> <td><?=$__S['enrollment_no']?></td></tr>
								<tr><th>Roll No.</th> <td><?=$__R['roll_no']?></td></tr>
									<tr><th>Course</th> <td><?=$course['course_name']?></td></tr>
								<tr><th>Student Name</th> <td><?=ucwords($__S['name'])?></td></tr>
								<tr><th>Father Name</th> <td><?=ucwords($__S['father'])?></td></tr>
								<tr><th>Mother Name</th> <td><?=ucwords($__S['mother'])?></td></tr>
							</tbody>
						</table>
						<?/*<table class="table table-bordered">
							<tbody>
								<tr>
									<th>Subject Name</th>
									<th>Max Marks</th>
									<th>Min Marks</th>
									<th>Obtain Marks</th>
									<th>Result </th>
									<th>Grade</th>
								</tr>
								<?
									$marks = $con->query("SELECT * FROM marks_table where result_id = '".$__R['id']."'");
									$rows = $marks->num_rows+1;
									$i=1;
									$ttl=0;
									while($mm = $marks->fetch_assoc())
									{
										$sub = $con->query("SELECT * FROM subjects where id = '".$mm['subject_id']."'")->fetch_assoc();
										echo '
												<tr>
													<th>'.ucwords($sub['subject_name']).'</th>
													<td>'.$sub['max_marks'].'</td>
													<td>'.$sub['min_marks'].'</td>
													<td>'.$mm['marks'].'</td>';
													if($i==1){
														echo '<td rowspan="'.$rows.'"><b>'.ucwords($__R['result']).'</b></td>
														<td rowspan="'.$rows.'"><b>'.ucwords($__R['grade']).'</b></td>';
													    
													}
												echo '</tr>
										';
										$ttl+=$mm['marks'];
										$i++;
									}
									echo '<tr><th>Total</th><td></td><td></td><td><b>'.$ttl.'</b></td></tr>';
								?>
							</tbody>
						</table> */?>
						
					</div>
					<div class="box-footer">
						<button class="btn btn-default" onclick="printDiv('printableArea')"><i class="fa fa-print"></i> Print</button>
					</div>
				</div>
			<?
		}
		else
		{
			echo '<script>alert("Date of birth not matched.");location.href="get_result.php"</script>';
		}
	}
	else
	{
		echo '<script>alert("Roll no. not matched.");location.href="get_result.php"</script>';
	}
}
else
{
    
?>
<div class="col-md-6 col-md-offset-3">
	<div class="box box-warning">
		<div class="box-header"><h3>Download Result</h3></div>
		<div class="box-body">
			<form action="" method="post">
				<div class="form-group">
					<label>Roll No.</label>
					<input type="text" class="form-control" name="roll_no" placeholder="Enter Roll No.">
				</div>
				<div class="form-group">
					<label>Date of birth</label>
					<input type="date" class="form-control" name="dob" placeholder="Enter Enrollment No.">
				</div>
				<div class="form-group">
					<button class="btn btn-warning" type="submit" name="status" value="result">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?
}
include 'includes/footer.php';
?>
<script type="text/javascript">
	function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>