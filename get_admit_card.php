<?
require_once 'admin/includes/config.php';
if($_POST['status']=='admit_card')

{
   
    

	$admit = $con->query("SELECT * FROM admit_card where admit_card.enrollment_no = '".$_POST['enrollment_no']."'");

	$stu = $con->query("SELECT * FROM students where enrollment_no = '".$_POST['enrollment_no']."' AND dob = '".$_POST['dob']."'");
	if($stu->num_rows>0 && $admit->num_rows>0)
	{
		$s = $stu->fetch_assoc();
		$a = $admit->fetch_assoc();
    // print_r($a);exit;
		$c = $con->query("SELECT * FROM centers where id = '".$s['center_id']."'")->fetch_assoc();
		$course = $con->query("SELECT * FROM courses where id = '".$s['course_id']."'")->fetch_assoc();
		
		$bg = 'format/admit.jpg';
		$enroll_no = $s['enrollment_no'];
		$photo = '../uploads/students/'.$s['photo'];
		$name = $s['name'];
		$father = $s['father'];
		$dob = $s['dob'];
		$roll_no =$a['roll_no'];
    // print_r($roll_no);exit;
		$sl = str_pad($a['id'], 4, '0', STR_PAD_LEFT);
		$course_name = $course['course_name'];
		$course_short_name = $course['short_name'];
		$exam_date = $a['exam_date'];
		$exam_time = $a['exam_time'];
		$exam_center = $a['exam_center'];
		$center_code = $c['center_number'];
		$center_name = $c['institute_name'];
		include 'admit_card.php';
		exit;
		?>
		<div class="col-md-6 col-md-offset-3">
			<div class="box box-default">
				<div class="box-header"><h5>Admit Card</h5></div>
				<div class="box-body" id="printableArea">
					<table class="table table-bordered">
						<tbody>
							<tr><th>Institute Name</th> <td><?=$c['institute_name']?></td></tr>
							<tr><th>Enrollment No.</th> <td><?=$s['enrollment_no']?></td></tr>
							<tr><th>Roll No.</th> <td><?=$a['roll_no']?></td></tr>
							<tr><th>Student Name</th> <td><?=$s['name']?></td></tr>
							<tr><th>Father Name</th> <td><?=$s['father']?></td></tr>
							<tr><th>Mother Name</th> <td><?=$s['mother']?></td></tr>
							<tr><th>Course</th> <td><?=$course['course_name']?></td></tr>
						</tbody>
					</table>
				</div>
				<div class="box-footer">
					<button class="btn btn-default" onclick="printDiv('printableArea')"><i class="fa fa-print"></i> Print</button>
				</div>
			</div>
		</div>
		<?
	}
	else
	{
		echo '<script>alert("Enrollment or date of birth not matched.");location.href="get_admit_card.php"</script>';
	}
}
else
{
    require_once 'includes/header.php';
    echo '<br><div class="ContentHolder"><div class="container">';
?>
<div class="container">
    <div class="">
        <div class="col-md-12 ">
    
	<div class="box box-danger col-md-6 col-md-offset-3">
		<h3 class="text_heading text-center">DOWNLOAD <span class="highlight_color">ADMIT CARD</span></h3>

		<div class="box-body">
			<form action="" method="post">
				<div class="form-group">
					<label>Enrollment No.</label>
					<input type="text" class="form-control" name="enrollment_no" placeholder="Enter Enrollment No.">
				</div>
				<div class="form-group">
					<label>Date of birth</label>
					<input type="date" class="form-control" name="dob" placeholder="Enter Enrollment No.">
				</div>
				<div class="form-group">
					<button class="btn btn-danger" type="submit" name="status" value="admit_card">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>
    </div>
</div>

<?
}
echo '</div></div>';
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