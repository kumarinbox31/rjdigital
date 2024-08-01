<?php
include 'includes/header.php';

if (isset($_GET['enrollment_no']) && $_GET['enrollment_no']) {
    $enrollment_no = $_GET['enrollment_no'];
    $get = $con->query("SELECT * FROM students WHERE enrollment_no = '$enrollment_no' AND status = 1");

    if ($get->num_rows) {
        $g = $get->fetch_assoc();
        $center = $con->query("SELECT * FROM centers WHERE id = '" . $g['center_id'] . "'")->fetch_assoc();
        $course = $con->query("SELECT * FROM courses WHERE id = '" . $g['course_id'] . "'")->fetch_assoc();
?>

<style>
    .enrollment-verification {
        max-width: 700px;
        margin: 50px auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 4px;
        background-color: #fff;
    }

    .enrollment-verification h3 {
        text-align: center;
        margin-bottom: 30px;
    }

    .enrollment-verification table {
        width: 100%;
    }

    .enrollment-verification td {
        padding: 8px;
        vertical-align: top; /* Adjust vertical alignment as per your design */
        width: 50%; /* Make each column take up half of the table width */
    }

    .enrollment-verification .photo {
        text-align: center;
    }

    .enrollment-verification .photo img {
        max-width: 100px;
        border-radius: 4px;
    }

    .btn-print {
        text-align: center;
        margin-top: 20px;
    }
</style>

<div class="container enrollment-verification" id="printable">
    <h3><u>Enrollment Verification Details</u></h3>
    <table>
		<tr>
<td colspan="3" ><h2><b><?php echo $g['name']; ?></b></h2></td><td style="text-align:center">
<img src="../uploads/students/<?php echo $g['photo']; ?>" height="100px" width="100px">
            </td>
</tr>
        <tr>
            <td><strong>Registration Date</strong></td>
            <td><?php echo $g['reg_date']; ?></td>
            <td><strong>Enrollment No.</strong></td>
            <td><?php echo $g['enrollment_no']; ?></td>
        </tr>
        <tr>
			<td><strong>Registration Sought for</strong></td>
            <td><?php echo $g['session']; ?></td>
             <td><strong>Applied Through</strong></td>
            <td colspan="3">Through institute</td>
        </tr>
        <tr>
         </tr>
        <tr>
            <td><strong>Select Center</strong></td>
            <td colspan="3"><?php echo htmlspecialchars($center['institute_name'], ENT_QUOTES); ?></td>
        </tr>
        <tr>
            <td><strong>Course</strong></td>
            <td colspan="3"><?php echo htmlspecialchars($course['course_name'], ENT_QUOTES); ?></td>
        </tr>
        <tr>
            <td><strong>Father's Name</strong></td>
            <td colspan="3"><?php echo $g['father']; ?></td>
        </tr>
        <tr>
            <td><strong>Mother's Name</strong></td>
            <td><?php echo $g['mother']; ?></td>
            <td><strong>Gender</strong></td>
            <td><?php echo $g['gender']; ?></td>
        </tr>
        <tr>
            <td><strong>Date of Birth</strong></td>
            <td><?php echo $g['dob']; ?></td>
            <td><strong>State</strong></td>
            <td><?php echo htmlspecialchars($state['state_name'], ENT_QUOTES); ?></td>
        </tr>
        <tr>
            <td><strong>District</strong></td>
            <td colspan="3"><?php echo htmlspecialchars($city['city_name'], ENT_QUOTES); ?></td>            
        </tr>
         <tr><td><strong>Highest Education Qualification</strong></td>
            <td colspan="3"><?php echo $g['qualification']; ?></td>
        </tr>
         <tr>
            <td><strong>Address Line 1</strong></td>
            <td colspan="3"><?php echo $g['address1']; ?></td>
         </tr>
        <tr>
            <td><strong>Address Line 2</strong></td>
            <td colspan="3"><?php echo $g['address2']; ?></td>
        </tr>
        <tr>
            <td><strong>Address Line 3</strong></td>
            <td colspan="3"><?php echo $g['address3']; ?></td>
        
         </tr>
        <tr>
            <td><strong>Pin Code</strong></td>
            <td><?php echo $g['pincode']; ?></td>
            <td><strong>Mobile No.</strong></td>
            <td><?php echo $g['mobile']; ?></td>
        </tr>
        <tr>
            <td><strong>Email ID</strong></td>
            <td colspan="3"><?php echo $g['email']; ?></td>
           </tr>
         
        <tr>
            <td><strong>Duration Start</strong></td>
            <td><?php echo $g['dur_start']; ?></td>
            <td><strong>Duration Ends</strong></td>
            <td><?php echo $g['dur_ends']; ?></td>
        </tr>
        <tr>
            <td><strong>Aadhar No.</strong></td>
            <td><?php echo $g['adhar']; ?></td>
            <td><strong>Category</strong></td>
            <td><?php echo $g['categary']; ?></td>
        </tr>
        <tr>
            <td colspan="1">
            <center><img src="../uploads/students/<?php echo $g['sign']; ?>" height="100px"><br>
            <strong>Signature</strong>
            </center></td>
            <td colspan="2">
            <center><img src="../uploads/students/<?php echo $g['thumb']; ?>" height="100px"><br>
            <strong>Thumb</strong>
            </center></td>
        </tr>

    </table>
    <div class="btn-print">
        <button class="btn btn-default" onclick="printDiv('printable')">Print</button>
    </div>
</div>

<script type="text/javascript">
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>
<?php
    } else {
        echo '<div class="alert alert-danger">Invalid Enrollment No. or Date of Birth!</div>';
    }
} else {
    echo '<div class="alert alert-danger">Enrollment No. not provided!</div>';
}

include 'includes/footer.php';
?>
