<?php
require_once 'includes/header.php';
error_reporting(E_ALL); ini_set('display_errors', 1);

// Fetch the student details for the form
$id = $_GET['enrollment_no'];
$stmt = $con->prepare("SELECT * FROM students WHERE enrollment_no = ?");
$stmt->bind_param('s', $id);
$stmt->execute();
$row = $stmt->get_result()->fetch_assoc();
$course = $con->query("SELECT * FROM courses WHERE id = '".$row['course_id']."' ")->fetch_assoc();
$center = $con->query("SELECT * FROM centers WHERE id = '".$row['center_id']."'")->fetch_assoc();
$state = $con->query("SELECT * FROM states WHERE id = '".$row['state']."'")->fetch_assoc();
$city = $con->query("SELECT * FROM city WHERE id = '".$row['distric']."'")->fetch_assoc();
?>







<div class="container" id="printable">
   <div class="box box-primary">
      <div class="box-header">
         <h3 class="text-center">Enrollment Verification Details</h3>
      </div>
      <div class="box-body">
         <form method="POST" enctype="multipart/form-data">
            <div class="box-body">
               <h5 class="box-title">1. Registration Details / पंजीयन का विवरण</h5>
               <div class="form-group col-md-6 col-sm-12">
                  <label>Registration Date</label>
                  <input readonly type="text" name="reg_date" class="form-control" value="<?php echo $row['reg_date']; ?>">
               </div>
               <div class="form-group col-md-6 col-sm-12">
                  <label for="registration-sought">Registration sought for / के लिए पंजीयन</label>
                  <input readonly class="form-control" value="<?php echo $row['session']; ?>">
                  
               </div>
               <div class="form-group col-md-6 col-sm-12">
                  <label>Enrollment_no</label>
                  <input readonly type="text" name="enrollment_no" class="form-control" placeholder="Enter Enrollment No" value="<?php echo $row['enrollment_no']; ?>">
               </div>
               <div class="form-group col-md-6 col-sm-12">
                  <label>Course </label>
                  <input readonly type="text" class="form-control" value="<?php echo $course['course_name']; ?>">
                  
               </div>
               <div class="col-md-12 col-sm-12">
                  <h5 class="mb-3">
                     2.मान्यता प्राप्त संस्थान के नाम का चयन करें
                  <h5>
               </div>
               <div class="form-group col-md-6 col-sm-12">
                  <label>Applied Through</label>
                  <input readonly type="text" class="form-control" value="Through institute" readonly>
               </div>
               <div class="form-group col-md-6 col-sm-12">
                  <label>Select Center</label>
                  <input readonly type="text" class="form-control" value="<?php echo $center['institute_name']; ?>">
                  
                  </div>
               <div class="col-md-12">
                  <h5 class="mb-3">3. Applicants Personal Details / आवेदक का व्यक्तिगत विवरण</h5>
               </div>
               <div class="form-group col-md-6 col-sm-12">
                  <label>Applicant name / आवेदक का पूरा नाम</label>
                  <input readonly type="text" name="name" class="form-control" placeholder="Enter Applicant name" value="<?php echo $row['name']; ?>">
               </div>
               <div class="form-group col-md-6 col-sm-12">
                  <label>Father name / पिता का नाम</label>
                  <input readonly type="text" name="father" class="form-control" placeholder="Enter Father Name" value="<?php echo $row['father']; ?>">
               </div>
               <div class="form-group col-md-6 col-sm-12">
                  <label>Mother name / माता का नाम</label>
                  <input readonly type="text" name="mother" class="form-control" placeholder="Enter Mother Name" value="<?php echo $row['mother']; ?>">
               </div>
               <div class="form-group col-md-6 col-sm-12">
                  <label>Gender / लिंग</label>
                  <input readonly type="text" class="form-control" value="<?php echo $row['gender']; ?>">
               </div>
               <div class="form-group col-md-6 col-sm-12">
                  <label>Date of Birth / जन्म की तारीख</label>
                  <input readonly type="text" name="dob" class="form-control" value="<?php echo $row['dob']; ?>">
               </div>
               <div class="form-group col-md-6 col-sm-12">
                  <label>State / राज्य</label>
                  <input readonly type="text" class="form-control" value="<?php echo $state['state_name']; ?>">
                  </div>
               <div class="form-group col-md-6 col-sm-12">
                  <label>District / जिला</label>
                  <input readonly type="text"  class="form-control" value="<?php echo @$city['city_name']; ?>">
               </div>
               <div class="form-group col-md-6 col-sm-12">
                  <label>Address Line 1 / पता पंक्ति 1</label>
                  <input readonly type="text" name="address1" class="form-control" placeholder="Enter address" value="<?php echo $row['address1']; ?>">
               </div>
                     <div class="form-group col-md-6 col-sm-12">
                  <label>Address Line 2 / पता पंक्ति 2</label>
                  <input readonly type="text" name="address2" class="form-control" placeholder="Enter address" value="<?php echo $row['address2']; ?>">
               </div>
                     <div class="form-group col-md-6 col-sm-12">
                  <label>Address Line 3 / पता पंक्ति 3</label>
                  <input readonly type="text" name="address3" class="form-control" placeholder="Enter address" value="<?php echo $row['address3']; ?>">
               </div>
               <div class="form-group col-md-6 col-sm-12">
                  <label>Pin Code / पिन कोड</label>
                  <input readonly type="text" name="pincode" class="form-control" placeholder="Enter pincode" value="<?php echo $row['pincode']; ?>">
               </div>
               <div class="form-group col-md-6 col-sm-12">
                  <label>Mobile No / मोबाइल नंबर</label>
                  <input readonly type="text" name="mobile" class="form-control" placeholder="Enter mobile no" value="<?php echo $row['mobile']; ?>">
               </div>
               <div class="form-group col-md-6 col-sm-12">
                  <label>Email Id / ईमेल आईडी</label>
                  <input readonly type="email" name="email" class="form-control" placeholder="Enter email" value="<?php echo $row['email']; ?>">
               </div>
               <div class="col-md-12">
                  <h5 class="mb-3">4. Details of Last Qualifying Examination Passed / अंतिम उत्तीर्ण परीक्षा का विवरण</h5>
                     
               </div>
              <div class="form-group col-md-6 col-sm-12">
            <label>Highest Education Qualification /उच्चतम शैक्षिक योग्यता</label>
            <input readonly class="form-control" value="<?php echo $row['qualification']; ?>">
                  
             </div>
         <div class="form-group col-md-6 col-sm-12">
            <label>Year Of Passing / उत्तीर्ण वर्ष</label>
            <input readonly type="text" name="year" placeholder="Enter Year Of Passing" class="form-control"  value="<?php echo $row['p_year']; ?>">
         </div>
               <div class="form-group col-md-6 col-sm-12">
                  <label>Duration Start</label>
                  <input readonly type="text" name="dur_start" class="form-control" value="<?php echo $row['dur_start']; ?>">
               </div>
               <div class="form-group col-md-6 col-sm-12">
                  <label>Duration Ends</label>
                  <input readonly type="text" name="dur_ends" class="form-control" value="<?php echo $row['dur_ends']; ?>">
               </div>
               <div class="form-group col-md-6 col-sm-12">
                  <label>Aadhar No / आधार नंबर</label>
                  <input readonly type="text" name="aadhar_no" class="form-control" placeholder="Enter aadhar no" value="<?php echo $row['adhar']; ?>">
               </div>
               <div class="form-group col-md-6 col-sm-12">
                  <label>Category / श्रेणी</label>
                  <input readonly class="form-control" value="<?php echo $row['categary']; ?>">
               </div>
              
               <div class="form-group col-md-6 col-sm-12">
                  <label>Photo</label>
                  <input readonly type="hidden" name="file" value="<?php echo $row['photo']; ?>">
                  <img src="../uploads/students/<?php echo $row['photo']; ?>" height="100px">
               </div>
               <div class="form-group col-md-6 col-sm-12">
                  <label>Sign</label>
                      <img src="../uploads/students/<?php echo $row['sign']; ?>" height="50px">
               </div>
               <div class="form-group col-md-6 col-sm-12">
                  <label>Thumb</label>
                      <img src="../uploads/students/<?php echo $row['thumb']; ?>" height="50px">
               </div>
                  <div class="col-md-12">
                  <center><a onclick="printDiv('printable')" class="btn  btn-primary"><i class="fa fa-print"></i> Print</a></center>
                  </div>
               
            </div>
                  
            
         </form>
      </div>
   </div>
</div>
<script>
    function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
<?php
require_once 'includes/footer.php';
?>
