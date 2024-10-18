<?php
require_once 'includes/header.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['student']) && $_POST['student'] == 'insert') {
    $mobile = isset($_POST['mobile_no']) ? $_POST['mobile_no'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';

   //  $result = $con->query("SELECT * FROM students WHERE mobile = '$mobile' AND email = '$email'");

   //  if ($result->num_rows == 0) {
        // Handle photo upload
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
            $photoTmpPath = $_FILES['photo']['tmp_name'];
            $photoName = $_FILES['photo']['name'];
            $photoSize = $_FILES['photo']['size'];
            $photoType = $_FILES['photo']['type'];
            $photoExtension = pathinfo($photoName, PATHINFO_EXTENSION);
            $allowedExts = array("gif", "jpeg", "jpg", "png");

            if (in_array($photoExtension, $allowedExts)) {
                $uniquePhotoName = 'photo_' . uniqid() . '.' . $photoExtension;
                $photoUploadPath = '../uploads/students/' . $uniquePhotoName;

                if (!is_dir('../uploads/students/')) {
                    mkdir('../uploads/students/', 0777, true);
                }

                if (move_uploaded_file($photoTmpPath, $photoUploadPath)) {
                    $image = $uniquePhotoName;
                } else {
                    $image = '';
                }
            } else {
                $image = '';
            }
        } else {
            $image = '';
        }

        // Handle signature upload
        if (isset($_FILES['sign']) && $_FILES['sign']['error'] == 0) {
            $signTmpPath = $_FILES['sign']['tmp_name'];
            $signName = $_FILES['sign']['name'];
            $signSize = $_FILES['sign']['size'];
            $signType = $_FILES['sign']['type'];
            $signExtension = pathinfo($signName, PATHINFO_EXTENSION);
            $allowedExts = array("gif", "jpeg", "jpg", "png");

            if (in_array($signExtension, $allowedExts)) {
                $uniqueSignName = 'sign_' . uniqid() . '.' . $signExtension;
                $signUploadPath = '../uploads/students/' . $uniqueSignName;

                if (!is_dir('../uploads/students/')) {
                    mkdir('../uploads/students/', 0777, true);
                }

                if (move_uploaded_file($signTmpPath, $signUploadPath)) {
                    $sign = $uniqueSignName;
                } else {
                    $sign = '';
                }
            } else {
                $sign = '';
            }
        } else {
            $sign = '';
        }

        // Handle thumb upload
        if (isset($_FILES['thumb']) && $_FILES['thumb']['error'] == 0) {
            $thumbTmpPath = $_FILES['thumb']['tmp_name'];
            $thumbName = $_FILES['thumb']['name'];
            $thumbSize = $_FILES['thumb']['size'];
            $thumbType = $_FILES['thumb']['type'];
            $thumbExtension = pathinfo($thumbName, PATHINFO_EXTENSION);
            $allowedExts = array("gif", "jpeg", "jpg", "png");

            if (in_array($thumbExtension, $allowedExts)) {
                $uniqueThumbName = 'thumb_' . uniqid() . '.' . $thumbExtension;
                $thumbUploadPath = '../uploads/students/' . $uniqueThumbName;

                if (!is_dir('../uploads/students/')) {
                    mkdir('../uploads/students/', 0777, true);
                }

                if (move_uploaded_file($thumbTmpPath, $thumbUploadPath)) {
                    $th = $uniqueThumbName;
                } else {
                    $th = '';
                }
            } else {
                $th = '';
            }
        } else {
            $th = '';
        }

        // Collect all POST data into variables
        $enrollment_no = $_POST['enrollment_no'];
        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $father_name = $_POST['father_name'];
        $mother_name = $_POST['mother_name'];
        $dob = $_POST['dob'];
        $state_id = $_POST['state_id'];
        $city_id = $_POST['city_id'];
        $address1 = $_POST['address1'];
        $address2 = $_POST['address2'];
        $address3 = $_POST['address3'];
        $year = $_POST['year'];
        $course_id = $_POST['course_id'];
        $center_id = $_SESSION['center']['id'];
        $categary = $_POST['categary'];
        $pincode = $_POST['pincode'];
        $aadhar = $_POST['aadhar_no'];
        $session = $_POST['session'];
        $reg_date = $_POST['reg_date'];
        $status = 0;  // Set status value as required

        $query = "INSERT INTO students 
                    (enrollment_no, name, gender, father, mother, dob, mobile, email, state, distric, address1, address2, address3, year, course_id, center_id, photo, status, is_deleted, categary, sign, thumb, pincode, adhar, session, reg_date) 
                  VALUES 
                    ('$enrollment_no', '$name', '$gender', '$father_name', '$mother_name', '$dob', '$mobile', '$email', '$state_id', '$city_id', '$address1', '$address2', '$address3', '$year', '$course_id', '$center_id', '$image', '$status', '0', '$categary', '$sign', '$th', '$pincode', '$aadhar', '$session', '$reg_date')";

        if ($con->query($query)) {
            $id = $con->insert_id;
            echo '<script>alert("Student Registration Success."); location.href="' . BASE_URL . 'student_details.php?id=' . $id . '"</script>';
        } else {
            echo '<script>alert("Something Went Wrong."); location.href="' . BASE_URL . 'student_form.php"</script>';
        }
   //  } else {
   //      echo '<script>alert("Student already exists."); location.href="' . BASE_URL . 'student_form.php"</script>';
   //  }
}

$max_id_query = $con->query("SELECT MAX(id) AS max_id FROM students");
$max_id_row = $max_id_query->fetch_assoc();
$new_id_no = $max_id_row['max_id'] + 1;
?>
<div class="container">
   <div class="box box-primary">
      <div class="box-header">
         <h3 class="text-center">REGISTRATION APPLICATION FORM</h3>
      </div>
      <form method="POST" enctype="multipart/form-data">
         <div class="box-body">
            <h5 class="box-title">1. Registration Details / पंजीयन का विवरण</h5>
   			<div class="form-group col-md-6 col-sm-12">
               <label>Registration Date</label>
               <input type="date" name="reg_date" class="form-control" value="" >
            </div>
            <div class="form-group col-md-6 col-sm-12" >
               <label for="registration-sought">Registration sought for / के लिए पंजीयन</label>
               <select class="form-control" name="session" id="registration-sought">
                  <option value="">Select Session</option>
                  <option value="2022">2022</option>
                  <option value="2022-2023">2022-2023</option>
                  <option value="2023">2023</option>
                  <option value="2023-2024">2023-2024</option>
                  <option value="2024">2024</option>
                  <option value="2024-2025">2024-2025</option>
                  <option value="2025">2025</option>
                  <option value="2025-2026">2025-2026</option>
                  <option value="2026">2026</option>
                  <option value="2026-2027">2026-2027</option>
                  <option value="2027">2027</option>
                  <option value="2027-2028">2027-2028</option>
                  <option value="2028">2028</option>
                  <option value="2028-2029">2028-2029</option>
                  <option value="2029">2029</option>
                  <option value="2029-2030">2029-2030</option>
               </select>
            </div>
            <div class="form-group col-md-6 col-sm-12">
               <label>Enrollment_no</label>
               <input type="text" name="enrollment_no" class="form-control" value="" placeholder="Enter Enrollment No">
            </div>
            <div class="form-group col-md-6 col-sm-12">
               <label>Course </label>
               <select name="course_id" class="form-control">
                  <option>--SELECT COURSE--</option>
                  <?php
                     $course = $con->query("SELECT * FROM `courses`");
                     if($course->num_rows > 0) {
                         while($c = $course->fetch_assoc()) {
                             echo '<option value='.$c['id'].'>'.$c['course_name'].'</option>';
                         }
                     }
                     ?>
               </select>
            </div>
            <div class="col-md-12 col-sm-12">
               <h5 class="mb-3">
               2.मान्यता प्राप्त संस्थान के नाम का चयन करें
               <h5>
            </div>
            <div class="form-group col-md-6 col-sm-12">
               <label>Applied Through</label>
               <input type="text" class="form-control" value="Through institute" readonly>
            </div>
            <div class="form-group col-md-6 col-sm-12">
               <label>Select Center</label>
               <select name="center_id" class="form-control">
                  <option>--SELECT CENTER--</option>
                  <?php
                     $center = $con->query("SELECT * FROM `centers`");
                     if($center->num_rows > 0) {
                         while($c = $center->fetch_assoc()) {
                             echo '<option value='.$c['id'].'>'.$c['institute_name'].'</option>';
                         }
                     }
                     ?>
               </select>
            </div>
            <div class="col-md-12">
               <h5 class="mb-3">3. Applicants Personal Details / आवेदक का व्यक्तिगत विवरण</h5>
            </div>
            <div class="form-group col-md-6 col-sm-12">
               <label>Applicant name / आवेदक का पूरा नाम</label>
               <input type="text" name="name" class="form-control" placeholder="Enter Applicant name">
            </div>
            <div class="form-group col-md-6 col-sm-12">
               <label>Father name / पिता का नाम</label>
               <input type="text" name="father_name" class="form-control" placeholder="Enter Father Name">
            </div>
            <div class="form-group col-md-6 col-sm-12">
               <label>Mother Name / माता का नाम</label>
               <input type="text" name="mother_name" class="form-control" placeholder="Enter Mother name">
            </div>
            <div class="form-group col-md-6 col-sm-12">
               <label>Gender /लिंग</label><br>
               <label>Male <input type="radio" name="gender" value="male"></label>
               <label>Female <input type="radio" name="gender" value="female"></label>
            </div>
            <div class="form-group col-md-6 col-sm-12">
               <label>Date of Birth / जन्म दिनांक (DD-MM-YYYY)</label>
               <input type="date" name="dob" class="form-control"  required>
            </div>
            <div class="form-group col-md-6 col-sm-12">
               <label>Category / वर्ग</label>
               <select name="categary" class="form-control">
                  <option value="">Select Category</option>
                  <option value="General">General</option>
                  <option value="OBC">OBC</option>
                  <option value="SC">SC</option>
                    <option value="ST">ST</option>
               </select>
            </div>
            <div class="col-md-12 col-sm-12">
               <h5 class="mb-3">
               4.Contact Details / संपर्क विवरण
               <h5>
            </div>
            <div class="form-group col-md-6 col-sm-12">
               <label>Mobile No / मोबाइल नंबर</label>
               <input type="text" name="mobile_no" class="form-control" placeholder="Enter Mobile No" required>
            </div>
            <div class="form-group col-md-6 col-sm-12">
               <label>Email Address / ईमेल पता</label>
               <input type="email" name="email" class="form-control" placeholder="Enter Email Address" required>
            </div>
            <div class="col-md-12">
               <h5 class="mb-3">
               5. Permanent Address Details /स्थाई पता विवरण
            </div>
            <div class="form-group col-md-6 col-sm-12">
               <label>Address Line 1./पता पंक्ति 1</label>
               <input type="text" name="address1" class="form-control" placeholder="Enter Address 1" required>
            </div>
            <div class="form-group col-md-6 col-sm-12">
               <label>Address Line 2/पता पंक्ति 2</label>
               <input type="text" name="address2" class="form-control" placeholder="Enter Address 2" required>
            </div>
            <div class="form-group col-md-6 col-sm-12">
               <label>Address Line 3 /पता पंक्ति 3</label>
               <input type="text" name="address3" class="form-control" placeholder="Enter Address 3" required>
            </div>
            <div class="form-group col-md-12 col-sm-12">
               <label>Select State / राज्य का नाम</label>
               <select class="form-control get_city" name="state_id" required="">
                  <option value="">--Select--</option>
                  <?php
                     $state = $con->query("SELECT * FROM states");
                     while($s = $state->fetch_assoc()) {
                         echo '<option value="'.$s['id'].'">'.ucwords($s['state_name']).'</option>';
                     }
                     ?>
               </select>
            </div>
            <div class="form-group col-md-6 col-sm-12">
               <label>Select District / शहर का नाम <span id="load"></span></label>
               <select class="form-control list" name="city_id"  required="">
                  <option value="">--Select--</option>
               </select>
            </div>
            <div class="form-group col-md-6 col-sm-12">
               <label>Pincode / पिन कोड</label>
               <input type="text" name="pincode" class="form-control" placeholder="Enter Pincode" required>
            </div>
            <divc class="col-md-12">
            <h5 class="mb-3">6 . Educational/ Qualification Details / शैक्षिक /योग्यता का विवरण</h5>
         
         <div class="form-group col-md-6 col-sm-12">
            <label>Highest Education Qualification /उच्चतम शैक्षिक योग्यता</label>
            <select class="form-control" name="qualification">
               <option value="">Select Qualification</option>
               <option value="High School Below">High School Below</option>
               <option value="High School ">High School </option>
               <option value="Intermediate">Intermediate</option>
               <option value="Graduate">Graduate</option>
               <option value="Post Graduate">Post Graduate</option>
               <option value="Other">Other</option>
            </select>
         </div>
         <div class="form-group col-md-6 col-sm-12">
            <label>Year Of Passing / उत्तीर्ण वर्ष</label>
            <input type="text" name="year" class="form-control" placeholder="Enter Passing Year" required>
         </div>
         <div class="col-md-12">
            <h5 class="mb-3">7 . Identification details / पहचान विवरण</h5>
         </div>
         <div class="form-group col-md-6 col-sm-12">
            <label>Upload Photo / फोटो अपलोड करें</label>
            <input type="file" name="photo" class="form-control" required>
         </div>
         <div class="form-group col-md-6 col-sm-12">
            <label>Upload Signature / हस्ताक्षर अपलोड करें</label>
            <input type="file" name="sign" class="form-control" required>
         </div>
         <div class="form-group col-md-6 col-sm-12">
            <label>Upload Thumb Impression / अंगूठे का निशान अपलोड करें</label>
            <input type="file" name="thumb" class="form-control" required>
         </div>
         <div class="form-group col-md-6 col-sm-12">
            <label>Aadhar No / आधार संख्या</label>
            <input type="text" name="aadhar_no" class="form-control" placeholder="Enter Aadhar No" required>
         </div>
         <div class="col-md-12">
            <h5>Declaration / घोषणा</h5>
         </div>
         <div class="form-group col-md-12">
            <input type="checkbox" class="form-check-input" id="declaration" required="">
            <label class="form-check-label" for="declaration">
            I certify that all the information submitted by me in this Online Registration Application Form is true and correct to the best of my knowledge and belief. If any information, furnished by me in this Online Registration Application Form, submitted by me is found to be incorrect, fake, misleading or illegal at any point of time, I will be solely responsible for any financial, social or legal action that may be taken against me by RJ DIGITAL COMPUTER EDUCATION at any point of time.
            </br>
            यह प्रमाणित किया जाता है कि मेरे द्वारा ऑनलाइन पंजीकरण आवेदन प्रपत्र में दी गई सूचना मेरे ज्ञान विश्वास से सत्य व सही है। ऑनलाइन पंजीकरण आवेदन प्रपत्र में यदि मेरे द्वारा प्रदत्त सूचना किसी भी समय त्रुटिपूर्ण, जाली, भ्रामक व अवैध पायी जाती है तो RJ DIGITAL COMPUTER INSTITUTE  द्वारा मेरे विरुद्ध किसी भी प्रकार की वित्तीय, सामाजिक व वैधानिक कार्यवाई की जा सकती है जिसके लिए मैं पूर्णरूप से उत्तरदाई रहूँगा।
            </label>
         </div>
         <div class="form-group col-md-6">
            <button type="submit" name="student" value="insert" class="btn btn-success"><i class="fa fa-save"></i>Submit</button>
         </div>
         </div>
   </div>
   </form>
</div>
</div>
<?php
   require_once 'includes/footer.php';
   ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script type="text/javascript">
   $('.get_city').change(function(){
    var dataString = 'state_id=' + $(this).find(':selected').val() + '&status=get_city';
    $.ajax({
        url: "Ajax.php",
        type: "POST",
        data: dataString,
        beforeSend: function() {
            $('#load').html('<i class="text-danger"><i class="fa fa-spinner fa-spin"></i> Loading...</i>');
        },
        success: function($res) {
            $('.list').html($res);
        },
        complete: function() {
            $('#load').html('<i class="text-success"> Complete <i class="fa fa-check-circle"></i></i>');
        }
    });
   });
</script>