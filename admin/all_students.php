<?php
require_once 'includes/header.php';
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

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
				$get = $con->query("SELECT * FROM students where center_id = '".$_GET['center_id']."' AND status = 1");
			
				
				if($get->num_rows)
				{
				?>
					<table id="centerTable" class="table table-bordered data-table">
					<thead>
						<tr><th>Date</th>
							<th>Photo</th>
							<th>Enrollment No.</th>
							<th>Name</th>
							<th>Father's Name</th>
							<th>Center</th>
							<th>Course</th>
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
<script>
var table = $('#centerTable').DataTable();
var table = $('.data-table').DataTable();

    $(document).ready(function() {
        // Define the table variable
        var table = $('#centerTable').DataTable();

        // Add an event listener to the search input
        $('#table-search').on('keyup', function() {
            table.search(this.value).draw();
        });
    });
</script>
<?
include 'includes/footer.php';
?>
