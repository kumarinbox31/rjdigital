<?php
    include 'includes/header.php';

if ($_GET['action'] == 'delete') {
    $id = $_GET['id'];
    
    $con->query("Delete from `assignment` WHERE id = '$id'");
    echo '<script>alert("Document is deleted.");window.location.href="assignment.php"</script>';
}


// if($_POST['status']=='study_material')
// {
// 		$img = photo_upload('image','study_material');
// 		if($img['status']){
// 		    $image = $img['file_name'];
// 		}else{
// 		    $image= $img['error'];
		
// 		}
// 		print_r($img);
		
// // 		echo $image;
// // 		exit;
		
// 		$con->query("INSERT INTO `study_material` (file,description) VALUE ('".$_POST['image']."','".$_POST['description']."')");
// 		echo '<script>alert("Study material Uploaded Succesfully")</script>';
// // 			$con->query("INSERT INTO `students` (`dur_start`,`dur_ends`,`id`, `timestamp`, `enrollment_no`, `name`, `gender`, `father`, `mother`, `dob`, `mobile`, `email`,`address`, `state`, `distric`, `exam_pass`, `marks`, `board`, `year`, `username`, `password`, `course_id`, `center_id`, `photo`, `transection_id`, `status`) VALUES ('".$_POST['dur_start']."','".$_POST['dur_ends']."',NULL, CURRENT_TIMESTAMP, '".$_POST['enrollment_no']."', '".$_POST['name']."', '".$_POST['gender']."', '".$_POST['father']."', '".$_POST['mother']."', '".$_POST['dob']."', '".$_POST['mobile']."', '".$_POST['email']."', '".$_POST['address']."','".$_POST['state']."', '".$_POST['distric']."', '".$_POST['exam_pass']."', '".$_POST['marks']."', '".$_POST['board']."', '".$_POST['year']."', '".$_POST['username']."', '".$_POST['password']."', '".$_POST['course_id']."', '".$_POST['center_id']."', '".$image."', '', '0')");
// // 		   $id = mysqli_insert_id($con);
// // 			echo '<script>alert("Student Registration Success.");location.href="'.BASE_URL.'student_details.php?id='.$id.'"</script>';

// // 	}
// }
?>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h5></h5>
    </div>
    <div class="panel-body">
        <table id="centerTable" class="table table-bordered data-table">
					<thead>
						<tr><th>#</th>
							<th>Date</th>
							<th>Document Name</th>
							<th>Description</th>
							<th>Action</th>
						
						</tr>
					</thead>
					<tbody>
						<?
							
							$get = $con->query("SELECT * FROM `assignment`");
							$i = 1;
							if($get->num_rows){
							    
							    while($row = $get->fetch_assoc()){
							        echo '<tr>
							                <td>'.$i++.'</td>
							                <td>'.$row['date'].'</td>
							                <td>'.$row['file'].'</td>
							                <td>'.$row['description'].'</td>
							                <td>
                                                <a href="download_assignment.php?file='.$row['file'].'" target="_blank" class="btn btn-success"><i class="fa fa-download"></i><a/>                                            </td>
							              </tr>';
							    }
							}
						?>
					</tbody>
				</table>
    </div>
</div>
<?php
    include 'includes/footer.php';
?>