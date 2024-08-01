<?
require_once 'includes/header.php';
if($_POST['status']=='update')
{
	if(empty($_FILES['image']['name']))
	{
		$con->query("UPDATE `students` SET  `payable_amount` = '".$_POST['payable_amount']."',`dur_start` = '".$_POST['dur_start']."',`dur_ends` = '".$_POST['dur_ends']."',`name` = '".$_POST['name']."', `gender` = '".$_POST['gender']."', `father` = '".$_POST['father']."', `mother` = '".$_POST['mother']."', `dob` = '".$_POST['dob']."', `mobile` = '".$_POST['mobile']."',`address` = '".$_POST['address']."', `email` = '".$_POST['email']."', `state` = '".$_POST['state']."', `distric` = '".$_POST['distric']."', `exam_pass` = '".$_POST['exam_pass']."', `marks` = '".$_POST['marks']."', `board` = '".$_POST['board']."', `year` = '".$_POST['year']."', `username` = '".$_POST['username']."', `password` = '".$_POST['password']."', `course_id` = '".$_POST['course_id']."' WHERE `students`.`id` = '".$_GET['id']."'");
		echo '<script>alert("Details are update success.");location.href="edit_student.php?id='.$_GET['id'].'"</script>';
	}
	else
	{
		$img = photo_upload('image','students');
		if($img['status'])
		{
			$con->query("UPDATE `students` SET  `payable_amount` = '".$_POST['payable_amount']."',`dur_start` = '".$_POST['dur_start']."',`dur_ends` = '".$_POST['dur_ends']."',`name` = '".$_POST['name']."', `gender` = '".$_POST['gender']."', `father` = '".$_POST['father']."', `mother` = '".$_POST['mother']."',`address` = '".$_POST['address']."', `dob` = '".$_POST['dob']."', `mobile` = '".$_POST['mobile']."', `email` = '".$_POST['email']."', `state` = '".$_POST['state']."', `distric` = '".$_POST['distric']."', `exam_pass` = '".$_POST['exam_pass']."', `marks` = '".$_POST['marks']."', `board` = '".$_POST['board']."', `year` = '".$_POST['year']."', `username` = '".$_POST['username']."', `password` = '".$_POST['password']."', `course_id` = '".$_POST['course_id']."', `photo` = '".$img['file_name']."' WHERE `students`.`id` = '".$_GET['id']."'");
			if(file_exists("../uploads/students/".$_POST['file']))
				unlink("../uploads/students/".$_POST['file']);
			echo '<script>alert("Details are update success.");location.href="edit_student.php?id='.$_GET['id'].'"</script>';
		}
		else
		{
			echo '<script>alert("Error in photo uploading...");location.href="edit_student.php?id='.$_GET['id'].'"</script>';
		}
	}
}
$get = $con->query("SELECT * FROM students where center_id = '".$_SESSION['center']['id']."' AND id = '".$_GET['id']."'")->fetch_assoc();
?>
<div class="box box-primary">
	<div class="box-header"><h3>Edit Students</h3></div>
	<div class="box-body">
		<form action="" method="post" enctype="multipart/form-data">
			<input type="hidden" name="file" value="<?=$get['photo']?>">
			<div class="form-group col-xs-12 col-md-12 col-lg-4">
				<label>Course Fee</label>
				<input type="text" class="form-control" name="payable_amount" value="<?=$get['payable_amount']?>" required="">
			</div>
			<div class="form-group col-xs-12 col-md-12 col-lg-12">
				<label>Enrollment No.</label>
				<input type="text" class="form-control" value="<?=$get['enrollment_no']?>" readonly>
			</div>
			
			<div class="form-group col-xs-12 col-md-12 col-lg-4">
				<label>Name</label>
				<input type="text" class="form-control" name="name" value="<?=$get['name']?>" required="">
			</div>
			<div class="form-group col-xs-12 col-md-12 col-lg-4">
				<label>Gender</label><br>
			<label>Male <input type="radio" name="gender" value="male" required="" <? if($get['gender']=='male'){echo 'checked';} ?>></label>
				<label>Female <input type="radio" name="gender" value="female" required="" <? if($get['gender']=='female'){echo 'checked';} ?>></label>
			</div>
			<div class="form-group col-xs-12 col-md-12 col-lg-4">
				<label>Father Name</label>
				<input type="text" class="form-control" name="father" value="<?=$get['father']?>" required="">
			</div>
			<div class="form-group col-xs-12 col-md-12 col-lg-4">
				<label>Mother Name</label>
				<input type="text" class="form-control" name="mother" value="<?=$get['mother']?>" required="">
			</div>
			<div class="form-group col-xs-12 col-md-12 col-lg-4">
				<label>Date of birth</label>
				<input type="date" class="form-control" name="dob" value="<?=$get['dob']?>">
			</div>
			<div class="form-group col-xs-12 col-md-12 col-lg-4">
				<label>Mobile No.</label>
				<input type="text" class="form-control" name="mobile" value="<?=$get['mobile']?>" required="">
			</div>
			<div class="form-group col-xs-12 col-md-12 col-lg-4">
			    <label>Address</label>
			    <input type="text" class="form-control" name="address" value="<?=$get['address']?>" required>
			</div>
			<div class="form-group col-xs-12 col-md-12 col-lg-4">
				<label>Email ID</label>
				<input type="email" class="form-control" name="email" value="<?=$get['email']?>" required="">
			</div>
			<div class="form-group col-xs-12 col-md-12 col-lg-4">
				<label>State</label>
				<input type="text" class="form-control" name="state" value="<?=$get['state']?>" required="">
			</div>
			<div class="form-group col-xs-12 col-md-12 col-lg-4">
				<label>Distric</label>
				<input type="text" class="form-control" name="distric" value="<?=$get['distric']?>" required="">
			</div>
			<div class="form-group col-xs-12 col-md-12 col-lg-4">
				<label>Exam Pass</label>
				<input type="text" class="form-control" name="exam_pass" value="<?=$get['exam_pass']?>" required="">
			</div>
			<div class="form-group col-xs-12 col-md-12 col-lg-4">
				<label>Marks</label>
				<input type="number" class="form-control" name="marks" value="<?=$get['marks']?>" required="">
			</div>
			<div class="form-group col-xs-12 col-md-12 col-lg-4">
				<label>Board</label>
				<input type="text" class="form-control" name="board" value="<?=$get['board']?>" required="">
			</div>
			<div class="form-group col-xs-12 col-md-12 col-lg-4">
				<label>Year</label>
				<input type="number" class="form-control" name="year" value="<?=$get['year']?>" required="">
			</div>
                <div class="form-group col-md-6 col-sm-12">
                  <label>Category / श्रेणी</label>
                     
                    <select name="category" class="form-control" required>
                     <option value="General" <?php if($get['categary']=='General'){ ?>selected<?php }?>>General</option>
                     <option value="OBC" <?php if($get['categary']=='OBC'){ ?>selected<?php }?>>OBC</option>
                     <option value="SC" <?php if($get['categary']=='SC'){ ?>selected<?php }?>>SC</option>
                     <option value="ST" <?php if($get['categary']=='ST'){ ?>selected<?php }?>>ST</option>
                     </select>
               </div>
			<div class="form-group col-xs-12 col-md-12 col-lg-4">
				<label>Username</label>
				<input type="text" class="form-control" name="username" value="<?=$get['username']?>" required="">
			</div>
			<div class="form-group col-xs-12 col-md-12 col-lg-4">
				<label>Password</label>
				<input type="text" class="form-control" name="password" value="<?=$get['password']?>" required="">
			</div>
			<div class="form-group col-xs-12 col-md-12 col-lg-4">
				<label>Select Course</label>
				<select class="form-control" name="course_id" required="">
					<option value="">--Select--</option>
					<?
						$course = $con->query("SELECT * FROM courses");
						while($c = $course->fetch_assoc())
						{
							$se = $c['id']==$get['course_id']?"selected":"";
							echo '<option value="'.$c['id'].'" '.$se.'>'.ucwords($c['course_name']).'</option>';
						}
					?>
				</select>
			</div>
			<div class="form-group col-xs-12 col-md-12 col-lg-4">
				<label>Session Start</label>
				<input type="date" name="dur_start" class="form-control" required value="<?=$get['dur_start']?>">
			</div>
				<div class="form-group col-xs-12 col-md-12 col-lg-4">
				<label>Session Ends</label>
				<input type="date" name="dur_ends" class="form-control" required value="<?=$get['dur_ends']?>">
			</div>
			<div class="form-group col-xs-12 col-md-12 col-lg-4">
				<label>Photo</label>
				<input type="file" class="form-control" name="image" >
			</div>
			<div class="form-group col-xs-12 col-md-12 col-lg-4">
			
				<img src="../uploads/students/<?=$get['photo']?>" style="width: 100px;height: 120px;border: 1px solid black">
			</div>
			
			<div class="form-group col-xs-12 col-md-12 col-lg-12">
				<button class="btn btn-primary" type="submit" name="status" value="update"><i class="fa fa-save"></i> Submit</button>
			</div>
		</form>
	</div>
</div>
<?
include 'includes/footer.php';
?>