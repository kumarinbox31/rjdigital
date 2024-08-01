<?

if($_POST['status']=='all_documents')
{
    require_once 'includes/config.php';
	
	$admit = $con->query("SELECT * FROM admit_card where admit_card.enrollment_no = '".$_POST['enrollment_no']."'");
	
	$stu = $con->query("SELECT * FROM students where enrollment_no = '".$_POST['enrollment_no']."' AND dob = '".$_POST['dob']."'");
	$result = $con->query("SELECT * FROM results where results.enrollment_no = '".$_POST['enrollment_no']."'");
// 	print_r($result);
// 	exit;
// 	print_r($result);
	if($stu->num_rows>0 || $admit->num_rows>0)
	{
		$s = $stu->fetch_assoc();
		$a = $admit->fetch_assoc();
		$r = $result->fetch_assoc();
		$c = $con->query("SELECT * FROM centers where id = '".$s['center_id']."'")->fetch_assoc();
		$course = $con->query("SELECT * FROM courses where id = '".$s['course_id']."'")->fetch_assoc();
		
// 		$bg = '../format/admit_card.jpg';
		$enroll_no = $s['enrollment_no'];
		$photo = '../uploads/students/'.$s['photo'];
		$name = $s['name'];
		$father = $s['father'];
		$dob = $s['dob'];
// 		$roll_no = isset($a['roll_no']) ? $a['roll_no'] : 'N/A';
        $roll_no = $r['roll_no'];
		$sl = str_pad($a['id'], 4, '0', STR_PAD_LEFT);
		$course_name = $course['course_name'];
		$course_short_name = $course['short_name'];
		$exam_date = $a['exam_date'];
		$exam_time = $a['exam_time'];
		$exam_center = $a['exam_center'];
		$center_code = $c['center_number'];
		$center_name = $c['institute_name'];
// 		include '../admit_card.php';
// 		exit;
//         if ($_POST['status'] == 'get_certificate') {
//             include '../get_certificate.php';
//             exit;
//         } 
//         else if ($_POST['status'] == 'get_result') {
//              include '../result.php';
//             exit;
//         } else if ($_POST['status'] == 'get_id_card') {
//             include '../get_id_card.php';
//         } else if($_POST['status'] == 'get_admit_card'){
//             include '../admit_card.php';
// 		exit;
//         }
        include 'includes/header.php';
		?>

	<style>
        .all-forms {
            display: flex;
        }
        .all-forms form {
            margin-right: 10px;
        }
        .student-photo {
            max-width: 100px;
            max-height: 80px;
            border: 1px solid black;
        }
        .box-header h2 {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-header">
                    <h2>All Documents of Student</h2>
                </div>
                <div class="box-body" id="printableArea">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Enrollment No</th>
                                <th>Photo</th>
                                <th>Roll No</th>
                                <th>Student Name</th>
                                <th>Father Name</th>
                                <th>Mother Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?=$s['enrollment_no']?></td>
                                <td><img src="<?=$photo?>" alt="Student Photo" class="student-photo"></td>
                                <td><?=$a['roll_no']?></td>
                                <td><?=$s['name']?></td>
                                <td><?=$s['father']?></td>
                                <td><?=$s['mother']?></td>
                                <td>
                                    <div class="all-forms">
                                        <form action="<?=BASE_URL?>center/get_id_card.php" method="post" target="_blank">
                                            <input type="hidden" name="enrollment_no" value="<?=$enroll_no?>">
                                            <input type="hidden" name="dob" value="<?=$dob?>">
                                            <button class="btn btn-danger" type="submit" name="status" value="id_card">Id Card</button>
                                        </form>
                                        <form action="<?=BASE_URL?>center/get_result.php" method="post" target="_blank">
                                            <input type="hidden" name="roll_no" value="<?=$roll_no?>">
                                            <input type="hidden" name="dob" value="<?=$dob?>">
                                            <button type="submit" class="btn btn-danger" name="status" value="result">Get Result</button>
                                        </form>
                                        <form action="<?=BASE_URL?>center/get_fee_card.php" method="post" target="_blank">
                                            <input type="hidden" name="enrollment_no" value="<?=$enroll_no?>">
                                            <input type="hidden" name="dob" value="<?=$dob?>">
                                            <button type="submit" class="btn btn-danger" name="status" value="fee_card">Get Fee Card</button>
                                        </form>
                                        <form action="<?=BASE_URL?>center/get_certificate.php" method="post" target="_blank">
                                            <input type="hidden" name="enrollment_no" value="<?=$enroll_no?>">
                                            <input type="hidden" name="dob" value="<?=$dob?>">
                                            <button class="btn btn-danger" type="submit" name="status" value="get_certificate">Get Certificate</button>
                                        </form>
                                        <form action="<?=BASE_URL?>center/get_admit_card.php" method="post" target="_blank">
                                            <input type="hidden" name="enrollment_no" value="<?=$enroll_no?>">
                                            <input type="hidden" name="dob" value="<?=$dob?>">
                                            <button class="btn btn-danger" type="submit" name="status" value="admit_card">Admit Card</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    <button class="btn btn-default" onclick="printDiv('printableArea')">
                        <i class="fa fa-print"></i> Print
                    </button>
                </div>
            </div>
        </div>
    </div>
		<?
		include 'footer.php';
	}
	else
	{
		echo '<script>alert("Enrollment or date of birth not matched.");location.href="all_certificates.php"</script>';
	}
}
else
{
    require_once 'includes/header.php';
?>
<div class="col-md-6 col-md-offset-3">
	<div class="box box-danger">
		<div class="box-header"><h3>All Documents of Student</h3></div>
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
					<button class="btn btn-danger" type="submit" name="status" value="all_documents">Submit</button>
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