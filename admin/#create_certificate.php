<?
require_once 'includes/header.php';
if($_POST['status']=='certificate')
{
	$chk  = $con->query("SELECT * FROM certificates where enrollment_no = '".$_POST['enrollment_no']."'");
	if(!($chk->num_rows))
	{
	       // print_r($_FILES);exit;
	        $filename = $_FILES['myfile']['name'];

            // destination of the file on the server
            $destination = '../uploads/site_manager/' . $filename;
        
            // get the file extension
            $extension = pathinfo($filename, PATHINFO_EXTENSION);
        
            // the physical file on a temporary uploads directory on the server
            $file = $_FILES['myfile']['tmp_name'];
            $size = $_FILES['myfile']['size'];
        
            if (!in_array($extension, ['jpg', 'pdf', 'jpeg', 'png'])) {
                echo '<script>alert("Error in file upload.");location.href="create_certificate.php"</script>';
            } else {
                // move the uploaded (temporary) file to the specified destination
                if (move_uploaded_file($file, $destination)) {
                    $sql = "INSERT INTO `certificates` (`id`, `timestamp`, `enrollment_no`, `dob`, `file`, `content`, `center_id`) VALUES (NULL, CURRENT_TIMESTAMP, '".$_POST['enrollment_no']."', '', '".$filename."', '', '".$_SESSION['center']['id']."')";
                    mysqli_query($con, $sql);
                    echo '<script>alert("Certificate Create success.");location.href="create_certificate.php"</script>';
                }
            }
	    
    
	}
}
if($_GET['action']=='del')
{
	$con->query("DELETE FROM certificates where id = '".$_GET['id']."'");

	echo '<script>alert("Certificate Deleted.");location.href="create_certificate.php"</script>';
}
?>
<div class="box box-primary">
	<div class="box-header"><h3>Create Certificate</h3></div>
	<div class="box-body">

<?
	$student = $con->query("SELECT * FROM students");
	if($student->num_rows)
	{
?>
		<form action="" method="post" enctype="multipart/form-data">
			<div class="form-group col-md-4">
				<label>Enrollment No.</label>
				<select class="form-control " name="enrollment_no" required="">
					<option value="">--Select--</option>
					<?
						while($stu = $student->fetch_assoc())
						{
						     $chk = $con->query("SELECT * FROM certificates where enrollment_no = '".$stu['enrollment_no']."'");
						    if($chk->num_rows)
						       continue;
							echo '<option value="'.$stu['enrollment_no'].'">'.$stu['enrollment_no'].'</option>';
						}
					?>
				</select>
			</div>
		
			<div class="form-group col-md-12">
				<label>File</label>
			    <input type="file" class="form-control" name="myfile" required>
			</div>
		    <div class="form-group col-md-12">
			    <button class="btn btn-primary" type="submit" name="status" value="certificate"><i class="fa fa-save"></i> Submit</button>
			</div>
		</form>
<?
	}
	else
	{
		echo '<br><br><br><br><div class="alert alert-danger">Student Not Available.</div>';
	}

?>
	</div>
	<div class="box-footer">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Enrollment No.</th>
				
				
					<th>File</th>
					<th>Delete</th>
					
				</tr>
			</thead>
			<tbody>
				<?
					$get = $con->query("SELECT * FROM certificates");
					while($g = $get->fetch_assoc())
					{
						$c = $con->query("SELECT * FROM courses where id = '".$g['course_id']."'")->fetch_assoc();
						echo '<tr>
									<td>'.$g['enrollment_no'].'</td>
									
								
									<td>';if($g['file']==''){echo '<i>Empty</i>';}else{echo '<a href="download_file.php?file='.$g['file'].'" target="_blank" class="btn btn-success"><i class="fa fa-download"></i></a>';} echo '</td>
									<td><a href="?id='.$g['id'].'&action=del&center_id='.$_GET['center_id'].'" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
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
<script type="text/javascript">
	$('.get_subject').change(function(){
		// alert($(this).val());
		var dataString = 'course_id='+$(this).val()+'&status=subjects';
		$.ajax({
				url:"Ajax.php",
				type:"POST",
				data:dataString,
				beforeSend:function()
				{
					$('#list').html('<i class="text-danger"><i class="fa fa-spinner fa-spin"></i> Loading...</i>');
				},
				success:function($__res)
				{
					$('#list').html($__res);
				},
				complete:function()
				{

				}
		});
	})
</script>
<script type="text/javascript">
	$('.get_roll').change(function(){
		// alert($(this).val());
		var dataString = 'enrollment_no='+$(this).val()+'&status=get_roll';
		$.ajax({
				url:"Ajax.php",
				type:"POST",
				data:dataString,
				beforeSend:function()
				{
					$('#load').html('<i class="text-danger"><i class="fa fa-spinner fa-spin"></i> Loading...</i>');
				},
				success:function(res)
				{
					$('#roll').val(res);
				},
				complete:function()
				{
					$('#load').html('<i class="text-success"><i class="fa fa-check-circle"></i> Complete</i>');
				}
		});
	})
</script>