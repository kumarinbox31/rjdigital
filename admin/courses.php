<?
require_once 'includes/header.php';
if($_POST['status']=='course')
{
	$chk = $con->query("SELECT * FROM courses where course_name = '".$_POST['course_name']."' AND duration = '".$_POST['duration']."'");
	if($chk->num_rows)
	{
		echo '<script>alert("Course already exists.");location.href="courses.php"</script>';
	}
	else
	{
		$con->query("INSERT INTO `courses` (`id`, `timestamp`,`course_code`,`categary`, `course_name`, `duration`, `short_name`) VALUES (NULL, CURRENT_TIMESTAMP,'".$_POST['course_code']."','".$_POST['categary']."', '".$_POST['course_name']."', '".$_POST['duration']."', '".$_POST['short_name']."')");
		echo '<script>alert("Course successfully add.");location.href="courses.php"</script>';
	}
}

if ($_GET['action']=='del') {
	$con->query("DELETE FROM courses where id  = '".$_GET['id']."'");
	$con->query("DELETE FROM subjects where course_id = '".$_GET['id']."'");
	echo '<script>alert("Course successfully delete.");location.href="courses.php"</script>';
}

if($_POST['status']=='subjects')
{
// 	print_r($_POST);
	$chk = $con->query("SELECT * FROM subjects where course_id = '".$_POST['course_id']."' AND subject_name = '".$_POST['subject_name']."'");
	if(!($chk->num_rows))
	{
		$con->query("INSERT INTO `subjects` (`semester`,`id`, `timestamp`, `course_id`, `subject_name`, `max_marks`, `min_marks`) VALUES ('".$_POST['semester']."',NULL, CURRENT_TIMESTAMP, '".$_POST['course_id']."', '".$_POST['subject_name']."', '".$_POST['max_marks']."', '".$_POST['min_marks']."')");
		echo '<script>alert("Subject successfully add.");location.href="courses.php"</script>';
	}
}

if($_GET['action']=='sub_del')
{
	$con->query("DELETE FROM subjects where id = '".$_GET['sub_id']."'");
	echo '<script>alert("Subject Deleted.");location.href="courses.php"</script>';
}
if($_POST['status']=='course_update')
{
        $id = $_POST['id'];
        $course_name = $_POST['course_name'];
        $short_name  = $_POST['short_name'];
		$con->query("UPDATE `courses` SET `course_name`='$course_name',`short_name`='$short_name',`duration`=[value-5] WHERE $id");
		echo '<script>alert("Subject successfully saved.");location.href="courses.php"</script>';
}
?>
<div class="box box-success">
	<div class="box-header"><h3>Courses</h3></div>
	<div class="box-body">
	    <?
	    $status = 'course';
	     if($_GET['action'] == 'edit'){
	         $id = $_GET['id'];
	         	$chk = $con->query("SELECT * FROM courses where id = '".$id."'");
	         	$input = $name = $short_name = $duration = '';
            	if($chk->num_rows)
            	{
            	    $row = $chk->fetch_assoc();
            	    $id = $row['id'];
            	    $name =$row['course_name'];
            	    $short_name=$row['short_name'];
            	    $duration= $row['duration'];
            	    $input = '<input type="hidden" name="id" value="'.$id.'">';
            	    $status = 'course_update';
            	    
            	}
	
	     }
	    ?>
		<form action="" method="post" class="form-inline">
		    <?
		      echo $input
		    ?>
		    <div class="form-group">
				<label>Course Categary</label>
				<select class="form-control" name="categary" required="">
				    <option>--Select Categary Name--</option>
				    <?
				        $get = $con->query("SELECT * FROM site_courses ");
				        while($row = $get->fetch_assoc()){
				            echo '<option value="'.$row['id'].'">'.$row['title'].'</option>';
				        }
				    ?>
				</select>
			</div>
			<div class="form-group">
				<input type="text" name="course_code" class="form-control" placeholder="Enter Course code" required="" >
			</div>
			<div class="form-group">
				<input type="text" name="course_name" class="form-control" placeholder="Enter Course Name" required="" value="<?=$name?>">
			</div>
				<div class="form-group">
				<input type="text" name="short_name" class="form-control" placeholder="Enter Short Name" value="<?=$short_name?>">
			</div>
			<div class="form-group">
				<input type="text" name="duration" class="form-control" placeholder="Enter Course duration" required="" value="<?=$duration?>">
			</div>
		
			<div class="form-group">
				<button class="btn btn-success" type="submit" name="status" value="<?=$status?>"><i class="fa fa-save"></i> SAve</button>
			</div>
		</form>
	</div>
	<div class="box-footer">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Course Code</th>
					<th>Course Name</th>
					<th>Course categary</th>
					<th>Course Duration</th>
					<th>Short Name</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>
               <?php
                    $get = $con->query("SELECT * FROM courses");
                
                    while ($g = $get->fetch_assoc()) {
                        // Fetch additional data from site_courses for each row
                        $course = $con->query("SELECT * FROM site_courses WHERE id = '" . $g['categary'] . "'")->fetch_assoc();
                     
                        echo '
                            <tr>
                                <td>' . $g['course_code'] . '</td>
                                <td>' . ucwords($g['course_name']) . '</td>
                                <td>' . $course['title'] . '</td>
                                <td>' . $g['duration'] . ' </td>
                                <td>' . $g['short_name'] . '</td>
                                <td><a class="btn btn-info" href="?id=' . $g['id'] . '&action=edit"><i class="fa fa-edit"></i></a></td>
                                <td><a class="btn btn-danger" href="?id=' . $g['id'] . '&action=del"><i class="fa fa-trash"></i></a></td>									
                            </tr>
                        ';
                    }
                ?>

            </tbody>
		</table>
	</div>
</div>
<div class="box box-danger">
	<div class="box-header"><h3>Add Subjects</h3></div>
	<div class="box-body">
		<form action="" method="post">
			<div class="form-group col-md-6">
				<label>Select Course</label>
				<select class="form-control" name="course_id" required="">
					<option value="">--Select--</option>
					<?
						$course = $con->query("SELECT * FROM courses");
						while($c = $course->fetch_assoc())
						{
							echo '<option value="'.$c['id'].'">'.ucwords($c['course_name']).'</option>';
						}
					?>
				</select>
			</div>
			<div class="form-group col-md-6">
			    <input type="hidden" name="semester">
				<!--<label>Semesters</label>-->
			    <!--<select class="form-control" name="semester">-->
			    <!--    <option value="sem1">Semester 1</option>-->
			    <!--    <option value="sem2">Semester 2</option>-->
			    <!--</select>-->
			</div>
			<div class="form-group col-md-6">
				<label>Subject Name</label>
				<input type="text" class="form-control" name="subject_name" required="" placeholder="Enter Subject Name">
			</div>
			<div class="form-group col-md-6">
				<label>Subject Max Marks</label>
				<input type="numberr" min="0" class="form-control" name="max_marks" required="" placeholder="Enter Subject Max Marks">
			</div>
		
			<div class="form-group col-md-6">
				<label>Subject Min Marks</label>
				<input type="number" min="0" class="form-control" name="min_marks" required="" placeholder="Enter Subject Min Marks">
			</div>
			<div class="form-group col-md-12">
				<button class="btn btn-danger" type="submit" name="status" value="subjects"><i class="fa fa-plus"></i> Add</button>
			</div>
		</form>
		
	</div>
	<div class="box-footer">
		<h2>List Subjects</h2>
		<form>
			<div class="form-group col-md-6">
				<label>Select Course</label>
				<select class="form-control get_subject" name="course_id" required="">
					<option value="">--Select--</option>
					<?
							$course = $con->query("SELECT * FROM courses");
							while($c = $course->fetch_assoc())
							{
								echo '<option value="'.$c['id'].'">'.ucwords($c['course_name']).'</option>';
							}
						?>
				</select>
			</div>
		</form>
		
		<div id="data" class="form-group col-md-12 list"></div>
	</div>
</div>
<?
include 'includes/footer.php';
?>
<script type="text/javascript">
	$('.get_subject').change(function(){
		// alert($(this).val());
		var  dataString = 'course_id='+$(this).val()+'&status=get_subjects';
		$.ajax({
				url:"Ajax.php",
				type:"POST",
				data:dataString,
				beforeSend:function()
				{
					$('.list').html('<i class="text-danger"><i class="fa fa-spinner fa-spin"></i> Loading...</i>');
				},
				success:function($_res)
				{
					$('.list').html($_res);
				},
				complete:function()
				{

				}
		});
	})
</script>