<?php
require_once 'includes/header.php';
require_once 'admin/includes/config.php';

if ($_POST['status'] == 'get_certificate' || isset($_GET['certificate-no'])) {
    if (isset($_GET['certificate-no'])) {
        $certificate_no = $_GET['certificate-no'];
    } else {
        $certificate_no = $_POST['certificate_no'];
    }
    
    $dob = isset($_GET['dob']) ?  $_GET['dob'] :$_POST['dob'];
	// $dob = date('Y-d-m',strtotime($dob));
 	// print_r($dob);exit;
    // Prepare the statement to fetch certificate details
    $stmt = $con->prepare("SELECT * FROM certificates WHERE certificate_no = ? AND dob = ?");
    $stmt->bind_param("ss", $certificate_no, $dob);
    $stmt->execute();
    $admit = $stmt->get_result();

    if (!$admit->num_rows) {
        echo '<script>alert("Certificate not found.");location.href="get_certificate.php"</script>';
        return false;
    }

    $a = $admit->fetch_assoc();
    $enrollment_no = $a['enrollment_no'];
    $total_marks = $a['total_marks'];
    $obtain_marks = $a['obtain_marks'];
    $percentage = $a['percentage'];

    // Prepare the statement to fetch student details
    $stmt = $con->prepare("SELECT * FROM students WHERE enrollment_no = ?");
    $stmt->bind_param("s", $enrollment_no);
    $stmt->execute();
    $stu = $stmt->get_result();

    if ($stu->num_rows > 0) {
        $s = $stu->fetch_assoc();

        // Prepare the statement to fetch result details
        $stmt = $con->prepare("SELECT * FROM results WHERE enrollment_no = ?");
        $stmt->bind_param("s", $s['enrollment_no']);
        $stmt->execute();
        $r = $stmt->get_result()->fetch_assoc();

        // Prepare the statement to fetch center details
        $stmt = $con->prepare("SELECT * FROM centers WHERE id = ?");
        $stmt->bind_param("s", $s['center_id']);
        $stmt->execute();
        $c = $stmt->get_result()->fetch_assoc();

        // Prepare the statement to fetch course details
        $stmt = $con->prepare("SELECT * FROM courses WHERE id = ?");
        $stmt->bind_param("s", $s['course_id']);
        $stmt->execute();
        $course = $stmt->get_result()->fetch_assoc();

        $bg = 'format/certificate.jpg';
        $photo = 'uploads/students/' . $s['photo'];
        $name = $s['name'];
        $father = $s['father'];
        $serial_no = $a['serial_no'];
        $duration = $course['duration'];
        $dob = date("m-d-Y", strtotime($s['dob']));
        $issue_date = $a['issue_date'];
        $du_start = date("d-m-Y", strtotime($s['dur_start']));
        $serial = $a['id'];
        $du_end = date("d-m-Y", strtotime($s['dur_ends']));
        $grade = $a['grade'];
        $isu_date = date("d-m-Y", strtotime($issue_date));
        $course_name = $course['course_name'];
        $course_short_name = $course['short_name'];
        $center_code = $c['center_number'];
        $center_name = $c['institute_name'];
        $session = $a['session'];
    // print_r($_POST);EXIT;
?>

        <div class="container">
            <div class="col-md-6 col-md-offset-3">
                <div class="box box-default">
                    <div class="box-header">
                        <h5 class="text-center">Certificate Verification</h5>
                    </div>
                    <div class="box-body" id="printableArea">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Name</th>
                                    <td><?php echo htmlspecialchars($s['name']); ?></td>
                                </tr>
                                <tr>
                                    <th>Father Name</th>
                                    <td><?php echo htmlspecialchars($s['father']); ?></td>
                                </tr>
                                <tr>
                                    <th>Enrollment NO</th>
                                    <td><?php echo htmlspecialchars($s['enrollment_no']); ?></td>
                                </tr>
                                <tr>
                                    <th>Certificate No</th>
                                    <td><?php echo htmlspecialchars($certificate_no); ?></td>
                                </tr>
                                <tr>
                                    <th>Issue Date</th>
                                    <td><?php echo htmlspecialchars($isu_date); ?></td>
                                </tr>
                                <tr>
                                    <th>Course</th>
                                    <td><?php echo htmlspecialchars($course['course_name']); ?></td>
                                </tr>
                                <tr>
                                    <th>Session</th>
                                    <td><?php echo htmlspecialchars($du_start); ?> to <?php echo htmlspecialchars($du_end)?></td>
                                </tr>
                                <tr>
                                    <th>Course Duration</th>
                                    <td><?php echo htmlspecialchars($course['duration']); ?></td>
                                </tr>
                                <tr>
                                    <th>Total Marks</th>
                                    <td><?php echo htmlspecialchars($total_marks); ?></td>
                                </tr>
                                <tr>
                                    <th>Obtain Marks</th>
                                    <td><?php echo htmlspecialchars($obtain_marks); ?></td>
                                </tr>
                                <tr>
                                    <th>Total Percentage</th>
                                    <td><?php echo htmlspecialchars($percentage); ?>%</td>
                                </tr>
                                <tr>
                                    <th>Grade</th>
                                    <td><?php echo htmlspecialchars($grade); ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <center><a target="_blank" href="/view-certificate.php?certificate-no=<?php echo htmlspecialchars($certificate_no); ?>">View Certificate</a></center>
                    </div>
                    <div class="box-footer">
                        <button class="btn btn-default" onclick="printDiv('printableArea')"><i class="fa fa-print"></i> Print</button>
                    </div>
                </div>
            </div>
        </div>
<?php
    } else {
        echo '<script>alert("Enrollment or date of birth not matched.");location.href="get_certificate.php"</script>';
    }
} else {
?>
    <div class="container">
        <div class="col-md-6 col-md-offset-3">
            <div class="box box-danger">
                <div class="box-header">
                    <h3>Certificate</h3>
                </div>
                <div class="box-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label>Certificate No.</label>
                            <input type="text" class="form-control" name="certificate_no" placeholder="Enter Certificate No." required/>
                        </div>
                        <div class="form-group">
                            <label>Date of Birth</label>
                            <input type="date" class="form-control" name="dob" required />
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit" name="status" value="get_certificate">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
}
require_once 'includes/footer.php';
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
