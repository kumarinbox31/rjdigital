<?php
require_once 'includes/header.php';
error_reporting(E_ALL); ini_set('display_errors', 1);

// Fetch the student details for the form
$id = $_GET['id'];
$stmt = $con->prepare("SELECT * FROM students WHERE id = ?");
$stmt->bind_param('s', $id);
$stmt->execute();
$row = $stmt->get_result()->fetch_assoc();

// Helper function for photo upload
function photo_uploads($file, $path) {
    $allowedExts = array("gif", "jpeg", "jpg", "png");
    $temp = explode(".", $_FILES[$file]["name"]);
    $extension = end($temp);
    $return = array('status' => 0); // Initialize status to 0 by default

    if ((($_FILES[$file]["type"] == "image/gif")
        || ($_FILES[$file]["type"] == "image/jpeg")
        || ($_FILES[$file]["type"] == "image/jpg")
        || ($_FILES[$file]["type"] == "image/pjpeg")
        || ($_FILES[$file]["type"] == "image/x-png")
        || ($_FILES[$file]["type"] == "image/png"))
        && in_array($extension, $allowedExts)) {
        if ($_FILES[$file]["error"] > 0) {
            $return['error'] = '<div class="alert alert-danger">Return Code: ' . $_FILES[$file]["error"] . '</div>';
        } else {
            $originalFilename = $_FILES[$file]["name"];
            $fileExtension = pathinfo($originalFilename, PATHINFO_EXTENSION);
            $uniqueIdentifier = uniqid();
            $newfilename = 'student__' . $uniqueIdentifier . '.' . $fileExtension;

            $uploadDir = '../uploads/' . $path . '/';
            $uploadPath = $uploadDir . $newfilename;
            if (file_exists($uploadPath)) {
                $return['error'] = '<div class="alert alert-danger">' . $_FILES[$file]["name"] . ' already exists</div>';
            } else {
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                if (!move_uploaded_file($_FILES[$file]["tmp_name"], $uploadPath)) {
                    $return['error'] = '<div class="alert alert-danger">Failed to move uploaded file.</div>';
                } else {
                    $return['file_name'] = $newfilename;
                    $return['status'] = 1;
                }
            }
        }
    } else {
        $return['error'] = '<div class="alert alert-danger">Invalid file type or extension.</div>';
    }
    return $return;
}


if (isset($_POST['student']) && $_POST['student'] == 'update') {
    $id = $_GET['id'];
    $reg_date = $_POST['reg_date'];
    $enrollment_no = $_POST['enrollment_no'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $father_name = $_POST['father'];
    $mother_name = $_POST['mother'];
    $dob = $_POST['dob'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $state_id = $_POST['state_id'];
    $city_id = $_POST['city_id'];
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];
    $address3 = $_POST['address3'];
    $year = $_POST['p_year'];
    $course_id = $_POST['course_id'];
    $center_id = $_POST['center_id'];
    $categary = $_POST['categary'];
    $pincode = $_POST['pincode'];
    $aadhar = $_POST['aadhar_no'];
    $session = $_POST['session'];
	$dur_start = $_POST['dur_start'];
	$dur_ends = $_POST['dur_ends'];
    $status = 0;  // Set status value as required
	$username  = $_POST['username'];
	$password = $_POST['password'];
	$qualification = $_POST['qualification'];
	// Handle file uploads
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $img = photo_uploads('photo', 'students');
        $image = $img['status'] ? $img['file_name'] : $row['photo'];
    } else {
        $image = $row['photo'];
    }
	
    if (isset($_FILES['sign']) && $_FILES['sign']['error'] == 0) {
        $signature = photo_uploads('sign', 'students');
        $sign = $signature['status'] ? $signature['file_name'] : $row['sign'];
    } else {
        $sign = $row['sign'];
    }

    if (isset($_FILES['thumb']) && $_FILES['thumb']['error'] == 0) {
        $thumb = photo_uploads('thumb', 'students');
        $th = $thumb['status'] ? $thumb['file_name'] : $row['thumb'];
    } else {
        $th = $row['thumb'];
    }

    // Update query
    $query = "UPDATE `students` SET 
        `reg_date`='$reg_date', 
        `enrollment_no`='$enrollment_no', 
        `name`='$name', 
        `gender`='$gender', 
        `father`='$father_name', 
        `mother`='$mother_name', 
        `dob`='$dob', 
        `mobile`='$mobile', 
        `email`='$email', 
        `state`='$state_id', 
        `distric`='$city_id', 
        `address1`='$address1', 
        `address2`='$address2', 
        `address3`='$address3', 
        `p_year`='$year', 
        `course_id`='$course_id', 
        `center_id`='$center_id', 
        `categary`='$categary', 
        `pincode`='$pincode', 
        `adhar`='$aadhar', 
        `session`='$session', 
        `status`='$status', 
        `photo`='$image', 
        `sign`='$sign', 
        `thumb`='$th', 
        `dur_ends` = '$dur_ends',
        `dur_start` = '$dur_start',
        `username` = '$username',
        `password` = '$password',
        `qualification` = '$qualification'
        WHERE `id`='$id'";
    $result = $con->query($query);
// print_r($result);exit;
    if ($result) {
        echo '<script>alert("Details are updated successfully."); location.href="edit_student.php?id=' . $id . '"</script>';
    } else {
        echo '<script>alert("Error updating details."); location.href="edit_student.php?id=' . $id . '"</script>';
    }
}
?>







<div class="container">
   <div class="box box-primary">
      <div class="box-header">
         <h3 class="text-center">UPDATE REGISTRATION APPLICATION FORM</h3>
      </div>
      <div class="box-body">
         <form method="POST" enctype="multipart/form-data">
            <div class="box-body">
               <h5 class="box-title">1. Registration Details / पंजीयन का विवरण</h5>
               <div class="form-group col-md-6 col-sm-12">
                  <label>Registration Date</label>
                  <input type="date" name="reg_date" class="form-control" value="<?php echo $row['reg_date']; ?>">
               </div>
               <div class="form-group col-md-6 col-sm-12">
                  <label for="registration-sought">Registration sought for / के लिए पंजीयन</label>
                  <select class="form-control" name="session" id="registration-sought">
                     <option value="">Select Session</option>
                     <?php 
                        $arr = ['2022','2022-2023','2023','2023-2024','2024','2024-2025','2025','2025-2026','2026','2026-2027','2027','2027-2028','2028','2028-2029','2029','2029-2030'];
                        foreach($arr as $y){
                            $selected = $y == $row['session'] ? 'selected' : '';
                            echo "<option value='$y' $selected>$y</option>";
                        }
                     ?>
                  </select>
               </div>
               <div class="form-group col-md-6 col-sm-12">
                  <label>Enrollment_no</label>
                  <input type="text" name="enrollment_no" class="form-control" placeholder="Enter Enrollment No" value="<?php echo $row['enrollment_no']; ?>">
               </div>
               <div class="form-group col-md-6 col-sm-12">
                  <label>Course </label>
                  <select name="course_id" class="form-control">
                     <option>--SELECT COURSE--</option>
                     <?php
                        $course = $con->query("SELECT * FROM `courses`");
                        if($course->num_rows > 0) {
                            while($c = $course->fetch_assoc()) {
                                $selected = $row['course_id'] == $c['id'] ? 'selected' : '';
                                echo '<option value='.$c['id'].' '.$selected.' >'.$c['course_name'].'</option>';
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
                                $selected = $c['id'] == $row['center_id'] ? 'selected' : '';
                                echo '<option value='.$c['id'].'  '.$selected.'>'.$c['institute_name'].'</option>';
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
                  <input type="text" name="name" class="form-control" placeholder="Enter Applicant name" value="<?php echo $row['name']; ?>">
               </div>
               <div class="form-group col-md-6 col-sm-12">
                  <label>Father name / पिता का नाम</label>
                  <input type="text" name="father" class="form-control" placeholder="Enter Father Name" value="<?php echo $row['father']; ?>">
               </div>
               <div class="form-group col-md-6 col-sm-12">
                  <label>Mother name / माता का नाम</label>
                  <input type="text" name="mother" class="form-control" placeholder="Enter Mother Name" value="<?php echo $row['mother']; ?>">
               </div>
               <div class="form-group col-md-6 col-sm-12">
                  <label>Gender / लिंग</label>
                  <select class="form-control" name="gender">
                     <option value="Male" <?php echo $row['gender'] == 'Male' ? 'selected' : ''; ?>>Male</option>
                     <option value="Female" <?php echo $row['gender'] == 'Female' ? 'selected' : ''; ?>>Female</option>
                  </select>
               </div>
               <div class="form-group col-md-6 col-sm-12">
                  <label>Date of Birth / जन्म की तारीख</label>
                  <input type="date" name="dob" class="form-control" value="<?php echo $row['dob']; ?>">
               </div>
               <div class="form-group col-md-6 col-sm-12">
                  <label>State / राज्य</label>
                  <select name="state_id" class="form-control">
                     <option>--SELECT STATE--</option>
                     <?php
                        $state = $con->query("SELECT * FROM `states`");
                        if($state->num_rows > 0) {
                            while($s = $state->fetch_assoc()) {
                                $selected = $s['id'] == $row['state'] ? 'selected' : '';
                                echo '<option value='.$s['id'].'  '.$selected.'>'.$s['state_name'].'</option>';
                            }
                        }
                     ?>
                  </select>
               </div>
               <div class="form-group col-md-6 col-sm-12">
                  <label>District / जिला</label>
                  <select name="city_id" class="form-control">
                     <option>--SELECT DISTRICT--</option>
                     <?php
                        $city = $con->query("SELECT * FROM `city`");
                        if($city->num_rows > 0) {
                            while($c = $city->fetch_assoc()) {
                                $selected = $c['id'] == $row['distric'] ? 'selected' : '';
                                echo '<option value='.$c['id'].'  '.$selected.'>'.$c['city_name'].'</option>';
                            }
                        }
                     ?>
                  </select>
               </div>
               <div class="form-group col-md-6 col-sm-12">
                  <label>Address Line 1 / पता पंक्ति 1</label>
                  <input type="text" name="address1" class="form-control" placeholder="Enter address" value="<?php echo $row['address1']; ?>">
               </div>
                     <div class="form-group col-md-6 col-sm-12">
                  <label>Address Line 2 / पता पंक्ति 2</label>
                  <input type="text" name="address2" class="form-control" placeholder="Enter address" value="<?php echo $row['address2']; ?>">
               </div>
                     <div class="form-group col-md-6 col-sm-12">
                  <label>Address Line 3 / पता पंक्ति 3</label>
                  <input type="text" name="address3" class="form-control" placeholder="Enter address" value="<?php echo $row['address3']; ?>">
               </div>
               <div class="form-group col-md-6 col-sm-12">
                  <label>Pin Code / पिन कोड</label>
                  <input type="text" name="pincode" class="form-control" placeholder="Enter pincode" value="<?php echo $row['pincode']; ?>">
               </div>
               <div class="form-group col-md-6 col-sm-12">
                  <label>Mobile No / मोबाइल नंबर</label>
                  <input type="text" name="mobile" class="form-control" placeholder="Enter mobile no" value="<?php echo $row['mobile']; ?>">
               </div>
               <div class="form-group col-md-6 col-sm-12">
                  <label>Email Id / ईमेल आईडी</label>
                  <input type="email" name="email" class="form-control" placeholder="Enter email" value="<?php echo $row['email']; ?>">
               </div>
               <div class="col-md-12">
                  <h5 class="mb-3">4. Details of Last Qualifying Examination Passed / अंतिम उत्तीर्ण परीक्षा का विवरण</h5>
                     
               </div>
              <div class="form-group col-md-6 col-sm-12">
            <label>Highest Education Qualification /उच्चतम शैक्षिक योग्यता</label>
             <select class="form-control" name="qualification">
                                <option value="">Select Qualification</option>
                                <option value="High School Below" <?php echo $row['qualification'] == 'High School Below' ? 'selected' :'';?>>High School Below</option>
             					<option value="High School " <?php echo $row['qualification'] == 'High School ' ? 'selected' :'';?>>High School </option>
             					<option value="Intermediate" <?php echo $row['qualification'] == 'Intermediate' ? 'selected' :'';?>>Intermediate</option>
             					<option value="Graduate" <?php echo $row['qualification'] == 'Graduate' ? 'selected' :'';?>>Graduate</option>
             					<option value="Post Graduate" <?php echo $row['qualification'] == 'Post Graduate' ? 'selected' :'';?>>Post Graduate</option>
             					<option value="Other" <?php echo $row['qualification'] == 'Other' ? 'selected' :'';?>>Other</option>
                            	
                            
                                
                            </select>
         </div>
                     <div class="form-group col-md-6 col-sm-12">
            <label>Year Of Passing / उत्तीर्ण वर्ष</label>
            <input type="text" name="p_year" placeholder="Enter Year Of Passing" class="form-control"  value="<?=$row['p_year']?>">
         </div>
               <div class="form-group col-md-6 col-sm-12">
                  <label>Duration Start</label>
                  <input type="date" name="dur_start" class="form-control" value="<?php echo $row['dur_start']; ?>">
               </div>
               <div class="form-group col-md-6 col-sm-12">
                  <label>Duration Ends</label>
                  <input type="date" name="dur_ends" class="form-control" value="<?php echo $row['dur_ends']; ?>">
               </div>
               <div class="form-group col-md-6 col-sm-12">
                  <label>Aadhar No / आधार नंबर</label>
                  <input type="text" name="aadhar_no" class="form-control" placeholder="Enter aadhar no" value="<?php echo $row['adhar']; ?>">
               </div>
               <div class="form-group col-md-6 col-sm-12">
                  <label>Category / श्रेणी</label>
                     
                   <select name="categary" class="form-control" required>
                     
                     <option value="General" <?php if($row['categary']=='General'){ ?>selected<?php }?>>General</option>
                     <option value="OBC" <?php if($row['categary']=='OBC'){ ?>selected<?php }?>>OBC</option>
                     <option value="SC" <?php if($row['categary']=='SC'){ ?>selected<?php }?>>SC</option>
                     <option value="ST" <?php if($row['categary']=='ST'){ ?>selected<?php }?>>ST</option>
                     </select>
               </div>
              
               <div class="form-group col-md-6 col-sm-12">
                  <label>Photo</label>
                  <input type="file" name="photo" class="form-control">
                  <input type="hidden" name="file" value="<?php echo $row['photo']; ?>">
                  <img src="../uploads/students/<?php echo $row['photo']; ?>" height="100px">
               </div>
               <div class="form-group col-md-6 col-sm-12">
                  <label>Sign</label>
                  <input type="file" name="sign" class="form-control">
                      <img src="../uploads/students/<?php echo $row['sign']; ?>" height="100px">
               </div>
               <div class="form-group col-md-6 col-sm-12">
                  <label>Thumb</label>
                  <input type="file" name="thumb" class="form-control">
                      <img src="../uploads/students/<?php echo $row['thumb']; ?>" height="100px">
               </div>
               <div class="form-group col-md-6 col-sm-12">
                  <label>Username / उपयोगकर्ता नाम</label>
                  <input type="text" name="username" class="form-control" placeholder="Enter Username" value="<?php echo $row['username']; ?>">
               </div>
               <div class="form-group col-md-6 col-sm-12">
                  <label>Password / पासवर्ड</label>
                  <input type="text" name="password" class="form-control" placeholder="Enter Password" value="<?php echo $row['password']; ?>">
               </div> 
            </div>
            <input type="hidden" name="student" value="update">
            <div class="box-footer text-center">
               <button type="submit" class="btn btn-primary">Update</button>
            </div>
         </form>
      </div>
   </div>
</div>

<?php
require_once 'includes/footer.php';
?>
