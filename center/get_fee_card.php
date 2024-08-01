<?php
if ($_POST['status'] == 'fee_card') {
    require_once 'includes/config.php';
    	
		
    $stu = $con->query("SELECT * FROM students where enrollment_no = '".$_POST['enrollment_no']."' AND dob = '".$_POST['dob']."'");
    if ($stu->num_rows > 0) {
        $s = $stu->fetch_assoc();
        $c = $con->query("SELECT * FROM centers where id = '".$s['center_id']."'")->fetch_assoc();
        $course = $con->query("SELECT * FROM courses where id = '".$s['course_id']."'")->fetch_assoc();
        
        $bg = '../format/fee_card.jpg';
        
        $name = $s['name'];
        $dob = date('d-m-Y', strtotime($s['dob']));

        $father = $s['father'];
        $center_name = $c['institute_name'];
        $enroll_no = $s['enrollment_no'];
        $photo = '../uploads/students/'.$s['photo'];
        $course_name = $course['short_name'];
        $mobile = $s['mobile'];
        $center_code = $c['center_number'];
        $center_contact_no = $c['contact_number'];
        $center_addresss = $c['center_full_address'];
        $address = $s['address'];
        $session_st = date('Y',strtotime($s['dur_start']));
        
        $session_end = date('Y',strtotime($s['dur_ends']));
        include '../get_fee_card.php';
        

        exit;
    } else {
        echo '<script>alert("Enrollment or date of birth not matched.");location.href="get_id_card.php"</script>';
    }
} else {
    require_once 'includes/header.php';
?>
<div class="col-md-6 col-md-offset-3">
    <div class="box box-danger">
        <div class="box-header"><h3>Fee Card</h3></div>
        <div class="box-body">
            <form action="" method="post">
                <div class="form-group">
                    <label>Enrollment No.</label>
                    <input type="text" class="form-control" name="enrollment_no" placeholder="Enter Enrollment No.">
                </div>
                <div class="form-group">
                    <label>Date of birth</label>
                    <input type="date" class="form-control" name="dob" placeholder="Enter Date of Birth">
                </div>
                <div class="form-group">
                    <button class="btn btn-danger" type="submit" name="status" value="fee_card">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
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

