<?
require_once 'includes/header.php';
if($_GET['action']=='del')
{
    if(file_exists("../uploads/students/".$_GET['file']))
        unlink("../uploads/students/".$_GET['file']);
    $con->query("DELETE FROM students where id = '".$_GET['id']."'");
    echo '<script>alert("Student successfully delete.");location.href="all_students_failed.php"</script>';
}
?>
<div class="box box-primary">
	<div class="box-header"><h3>All Students</h3></div>
	<div class="box-body">
		<table class="table table-bordered">
			<thead>
				<tr><th>Date</th>
					<th>Photo</th>
					<th>Enrollment No.</th>
					<th>Name</th>
					<th>Father's Name</th>
					<th>E-Mail ID</th>
					<th>Course</th>
					<th>Send Notification</th>
					<th>Details</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>
				<?
					$get = $con->query("SELECT * FROM students where center_id = '".$_SESSION['center']['id']."' AND status = 0");
					while($g = $get->fetch_assoc())
					{
						$c = $con->query("SELECT * FROM courses where id = '".$g['course_id']."'")->fetch_assoc();
						echo '
								<tr><td>'.date('d-M-y',strtotime($g['timestamp'])).'</td>
									<td><img style="width:80px;height:100px;" src="../uploads/students/'.$g['photo'].'"></td>
									<td>'.$g['enrollment_no'].'</td>
									<td>'.$g['name'].'</td>
									<td>'.$g['father'].'</td>
									<td>'.$g['email'].'</td>
									<td>'.$c['course_name'].'</td>
									<td><a href="notification.php?id='.$g['id'].'" class="btn btn-warning"><i class="fa fa-envelope"></i></a></td>
									<td><a href="edit_student.php?id='.$g['id'].'" class="btn btn-info"><i class="fa fa-edit"></i></a></td>
									<td><a href="?id='.$g['id'].'&action=del&file='.$g['photo'].'" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
								</tr>
						';
					}
				?>
			</tbody>
		</table>
	</div>
</div>
<?
include 'includes/footer.php';
?>