<?require_once 'includes/header.php';
$id = $_GET['id'];
$get = $con->query("SELECT * FROM students WHERE id = $id");
if($get->num_rows){
    $g = $get->fetch_assoc();
    $center = $con->query("SELECT * FROM centers where id = '".$g['center_id']."'")->fetch_assoc();
    $course = $con->query("SELECT * FROM courses where id = '".$g['course_id']."'")->fetch_assoc();
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
        .enrollment-verification h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        .enrollment-verification table {
            width: 100%;
        }
        .enrollment-verification td {
            padding: 8px;
            vertical-align: middle;
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
    
    <div class="container">
    <div class="enrollment-verification" id="printable">
        <h2>Enrollment Verification</h2>
        <table class="table table-bordered">
            <tr>
                <td><strong>Institute</strong></td>
                <td><?php echo $center['institute_name']; ?></td>
                <td rowspan="10" class="photo">
                    <img src="../uploads/students/<?php echo $g['photo']; ?>" alt="Student Photo">
                </td>
            </tr>
            <tr>
                <td><strong>Name</strong></td>
                <td><?php echo $g['name']; ?></td>
            </tr>
            <tr>
                <td><strong>Fathers Name</strong></td>
                <td><?php echo $g['father']; ?></td>
            </tr>
            <tr>
                <td><strong>Enrollment NO</strong></td>
                <td><?php echo $g['enrollment_no']; ?></td>
            </tr>
    		
            <tr>
                <td><strong>Session</strong></td>
                <td><?php echo $g['session']; ?></td>
            </tr>
            <tr>
                <td><strong>Course</strong></td>
                <td><?php echo $course['course_name']; ?></td>
            </tr>
            <tr>
                <td><strong>Mobile</strong></td>
                <td><?php echo $g['mobile']; ?></td>
            </tr>
            <tr>
                <td><strong>Email</strong></td>
                <td><?php echo $g['email']; ?></td>
            </tr>
            <tr>
                <td><strong>Aadhar No</strong></td>
                <td><?php echo $g['adhar']; ?></td>
            </tr>
        </table>
        <div class="btn-print">
            <a href="view_enrollment.php?enrollment_no=<?=$g['enrollment_no']?>"><button class="btn btn-default"><i class="fa fa-eye"></i>View</button>
           <button class="btn btn-default" onclick="printDiv('printable')">Print</button>

        </div>
    </div>
</div>
<?
}
?>

<?require_once 'includes/footer.php';?>
<script type="text/javascript">
	function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>