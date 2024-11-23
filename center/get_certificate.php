<?
// error_reporting(E_ALL);ini_set('display_errors',1);
if($_POST['status']=='get_certificate')
{
    
    require_once 'includes/config.php';
	// print_r($_POST);exit;
	$certificate_no = $_POST['certificate_no'];
	// $arr = explode('/',$certificate_no);
	// $certificate_id = $arr[2];
	$admit 	= $con->query("SELECT * FROM certificates where certificate_no = '".$certificate_no."'");
	if(!$admit->num_rows){
    	echo '<script>alert("Certificate not found.");location.href="get_certificate.php"</script>';
    	return false;
    }
	$a = $admit->fetch_assoc();
	$enrollment_no = $a['enrollment_no'];
	$stu 	= $con->query("SELECT * FROM students where enrollment_no = '".$enrollment_no."' and center_id = '".$_SESSION['center']['id']."'");
	if($stu->num_rows>0 && $admit->num_rows>0)
	{
		$s = $stu->fetch_assoc();
		$r = $con->query("SELECT * FROM results WHERE enrollment_no = '".$s['enrollment_no']."'")->fetch_assoc();
		$c = $con->query("SELECT * FROM centers where id = '".$_SESSION['center']['id']."'")->fetch_assoc();
		// print_r($r);exit;
		$course = $con->query("SELECT * FROM courses where id = '".$s['course_id']."'")->fetch_assoc();
        
		$bg = '../format/certificate.jpg';
		$enroll_no = $s['enrollment_no'];
		$photo = '../uploads/students/'.$s['photo'];
		$name = $s['name'];
		$father = $s['father'];
        $serial_no = $a['serial_no'];
		$duration = $course['duration'];
		$dob = date("m-d-Y",strtotime($s['dob']));
        $issue_date = $a['issue_date'];
        $certificate_number = $c['id'];
        $du_start = date("d-m-Y",strtotime($s['dur_start']));
        $serial = $a['id'];
        $du_end = date("d-m-Y",strtotime($s['dur_ends']));
        $grade = $r['grade'];
        $isu_date = date("d-m-Y", strtotime($issue_date));
		$course_name = $course['course_name'];
		$course_short_name = $course['short_name'];
		$center_code = $c['center_number'];
		$center_name = $c['institute_name'];
		$course = $course['course_name'];

		$session = $a['session'];
		include '../certificate-backup-12-07-24.php';
		exit;
		?>
		<div class="col-md-6 col-md-offset-3">
			<div class="box box-default">
				<div class="box-header"><h5>Certificate</h5></div>
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
		echo '<script>alert("Enrollment does not match, or the student is not aligned with your center.");location.href="get_certificate.php"</script>';
	}
}
else
{
    require_once 'includes/header.php';
    echo '<br><div class="ContentHolder"><div class="container">';
?>
<div class="col-md-6 col-md-offset-3">
	<div class="box box-danger">
		<div class="box-header"><h3>Certificate</h3></div>
		<div class="box-body">
			<form action="" method="post">
				<div class="form-group">
					<label>Certificate No.</label>
					<input type="text" class="form-control" name="certificate_no" placeholder="Enter Certificate No.">
				</div>
			
				<div class="form-group">
					<button class="btn btn-danger" type="submit" name="status" value="get_certificate">Submit</button>
				</div>
			</form>
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


