<?
require_once 'includes/header.php';
?>
<div class="box box-primary">
	<div class="box-header"><h3>All Students</h3></div>
	<div class="box-body">
		<form action="" method="get">
			<div class="form-group col-md-6">
				<label>Select Institute</label>
				<select class="form-control" name="center_id" required="" onchange="this.form.submit()">
					<option value="">--Select--</option>
					<?
						$center = $con->query("SELECT * FROM centers");
						while($c = $center->fetch_assoc())
						{
							echo '<option value="'.$c['id'].'">'.$c['institute_name'].'</option>';
						}
					?>
				</select>
			</div>
		</form>
		<br><br><br><br>
		<?
			if(isset($_GET['center_id']))
			{
				$get = $con->query("SELECT * FROM students where center_id = '".$_GET['center_id']."' AND status = 0");
				if($get->num_rows)
				{
				?>
					<table class="table table-bordered">
					<thead>
						<tr>
						    <th>Date</th>
							<th>Photo</th>
							<th>Enrollment No.</th>
							<th>Name</th>
							<th>Father's Name</th>
							<th>Center</th>
							<th>Course</th>
							<th>Transection</th>
							<th>Details</th>
						</tr>
					</thead>
					<tbody>
						<?
							
							while($g = $get->fetch_assoc())
							{
								$c = $con->query("SELECT * FROM courses where id = '".$g['course_id']."'")->fetch_assoc();
								$ce = $con->query("SELECT * FROM centers where id = '".$g['center_id']."'")->fetch_assoc();
								echo '
										<tr>
										<td>'.date('d-M-y',strtotime($g['timestamp'])).'</td>
											<td><img style="width:80px;height:100px;" src="../uploads/students/'.$g['photo'].'"></td>
											<td>'.$g['enrollment_no'].'</td>
											<td>'.$g['name'].'</td>
											<td>'.$g['father'].'</td>
											<td>'.$ce['institute_name'].'</td>
											<td>'.$c['course_name'].'</td>
											<td><a href="transection_student.php?id='.$g['transection_id'].'" class="btn btn-warning"><i class="fa fa-eye"></i></a></td>
											<td><a href="edit_student.php?id='.$g['id'].'" class="btn btn-info"><i class="fa fa-edit"></i></a></td>
											
										</tr>
								';
							}
						?>
					</tbody>
				</table>
				<?
			   }
			   else
			   {
			   		echo '<div class="alert alert-danger" align="">Record Not Found.</div>';
			   }
			}
		?>
	</div>
</div>
<?
include 'includes/footer.php';
?>