<?php
	if(isset($_GET['certificate-no'])){
	require_once 'admin/includes/config.php';
	
	$certificate_no = $_GET['certificate-no'];
	
	$admit 	= $con->query("SELECT * FROM certificates where certificate_no = '".$certificate_no."'");
	if(!$admit->num_rows){
    	echo '<script>alert("Certificate not found.");location.href="get_certificate.php"</script>';
    	return false;
    }
	$a = $admit->fetch_assoc();
	$enrollment_no = $a['enrollment_no'];
	$stu 	= $con->query("SELECT * FROM students where enrollment_no = '".$enrollment_no."' ");
	if($stu->num_rows>0 && $admit->num_rows>0)
	{
		$s = $stu->fetch_assoc();
		$r = $con->query("SELECT * FROM results WHERE enrollment_no = '".$s['enrollment_no']."'")->fetch_assoc();
		$c = $con->query("SELECT * FROM centers where id = '".$s['center_id']."'")->fetch_assoc();
	// print_r($r);exit;
		$course = $con->query("SELECT * FROM courses where id = '".$s['course_id']."'")->fetch_assoc();
        
		$bg = 'format/certificate.jpg';
		$enroll_no = $s['enrollment_no'];
		$photo = 'uploads/students/'.$s['photo'];
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
		include 'certificate-backup-12-07-24.php';
		// exit;
    
    }
    
    }
		?>