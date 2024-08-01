<?
require_once 'includes/header.php';
?>
<div class="box box-success">
	<div class="box-header"><h3>Center List</h3></div>
	<div class="box-body" style="overflow-x:scroll">
		<table class="table table-bordered" >
			<thead>
				<tr><th>Date</th>
					<th>ID</th>
					<th>Institute Name</th>
					<th>Institute Address</th>
					<th>Institute owner Name</th>
					<th>Contact Number</th>
					<th>E-Mail ID</th>
					<th>Send Notification</th>
					<th>Transection</th>
					<th>Edit</th>
					
					
				</tr>
			</thead>
			<tbody>
				<?
					$get = $con->query("SELECT * FROM centers where status = 1");
					while($g = $get->fetch_assoc())
					{
						echo '<tr>
						        <td>'.date('d-M-y',strtotime($g['timestamp'])).'</td>
								<td>'.$g['center_number'].'</td>
								<td>'.$g['institute_name'].'</td>
								<td>'.$g['center_full_address'].'</td>
								<td>'.$g['name'].'</td>
								<td>'.$g['contact_number'].'</td>
								<td>'.$g['email_id'].'</td>
								<td><a href="notification.php?id='.$g['id'].'" class="btn btn-primary"><i class="fa fa-envelope"></i></a></td>';
								if($g['transection_id']=='')
								    echo '<td><i class="text-danger">no transection</i></td>';
								else
								    echo '<td><a href="transection_details.php?id='.$g['transection_id'].'" class="btn btn-warning"><i class="fa fa-eye"></i></a></td>';
								echo '<td><a href="view_center.php?id='.$g['id'].'" class="btn btn-info"><i class="fa fa-edit"></i></a></td>
								
						</tr>';
					}
				?>
			</tbody>
		</table>
	</div>
</div>
<?
include 'includes/footer.php';
?>