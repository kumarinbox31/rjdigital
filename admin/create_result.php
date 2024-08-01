<?
require_once 'includes/header.php';
if($_GET['action'] == 'changeStatus'){
    $val = $_GET['val']?0:1;
    $id = $_GET['id'];
    $con->query("UPDATE `results` SET `status`= '$val' WHERE id = '$id'");
    echo '<script>alert("Changed Successfully.");window.location.href="create_result.php"</script>';
}
if($_POST['status']=='create_result')
{
	// print_r($_POST);
	$chk = $con->query("SELECT * FROM results where roll_no = '".$_POST['roll_no']."' OR enrollment_no = '".$_POST['enrollment_no']."'");
	if(!($chk->num_rows))
	{
	    
    		$res = $con->query("INSERT INTO `results` (`roll_no`, `course_id`, `enrollment_no`, `center_id`,`grade`) VALUES 
    		('".$_POST['roll_no']."', '".$_POST['course_id']."','".$_POST['enrollment_no']."', '".$_GET['center_id']."','".$_POST['grade']."')");
    		console.log($res);
    		if(!$res){
    		    print_r($con->error);exit;
    		}
    
     		else{
    	   echo '<script>alert("Result Created Successfully uploaded.");location.href="create_result.php";</script>';
    	}
	}else{
	    die('hi');
	}
}
if($_GET['action']=='del')
{
	$con->query("DELETE FROM results where id = '".$_GET['id']."'");
	$con->query("DELETE FROM marks_table where result_id = '".$_GET['id']."'");
	echo '<script>alert("Result Deleted.");location.href="create_result.php"</script>';
}
?>
<div class="box box-primary">
	<div class="box-header"><h3>Create Result</h3></div>
	<div class="box-body">
		
<?

	$student = $con->query("SELECT * FROM students WHERE `status` = '1'");
	if($student->num_rows)
	{
?>
		<form action="" method="post" enctype="multipart/form-data">
			<div class="form-group col-md-4">
				<label>Enrollment No.</label>
				<select class="form-control get_roll" name="enrollment_no" required="">
					<option value="">--Select--</option>
					<?
						while($stu = $student->fetch_assoc())
						{
						     $chk = $con->query("SELECT * FROM results where enrollment_no = '".$stu['enrollment_no']."'");
						    if($chk->num_rows)
						       continue;
							echo '<option value="'.$stu['enrollment_no'].'">'.$stu['enrollment_no'].'</option>';
						}
					?>
				</select>
			</div>
			<div class="form-group col-md-4">
				<label>Roll No. &nbsp;<span id="load"></span></label>
				
				<input id="roll" type="number" class="form-control" name="roll_no" >
			</div>
			<!--<div class="form-group col-md-4">-->
			<!--	<label>Result</label>-->
				
			<!--	<input type="file" class="form-control" name="file" >-->
			<!--</div>-->
			<div class="form-group col-md-4">
				<label> Course &nbsp;<span id="load"></span></label>
				<input type="hidden" name="course_id" id="course_id" value="">
				<input type="text" class="form-control get_subject" id="data" value="" readonly>
				<!--<select class="form-control get_subject" name="course_id" required="">-->
				<!--	<option value="">--Select--</option>-->
				<!--	 < ?-->
				<!--		$course = $con->query("SELECT * FROM courses");-->
				<!--		while($c = $course->fetch_assoc())-->
				<!--		{-->
				<!--			echo '<option value="'.$c['id'].'">'.ucwords($c['course_name']).'</option>';-->
				<!--		}-->
				<!--	?>-->
				<!--</select>-->
			</div>
			<div  class="form-group col-md-4">
			    <label>Enter Grade</label>
			    <input type="text" name="grade" class="form-control" value="">
			</div>
			<!--<div id="list"></div>-->
			<div class="form-group col-md-12">
			    <button type="submit" name="status" value="create_result" class="btn btn-sm btn-primary">Submit</button>
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
					<th>Roll No.</th>
					<th>Course Name</th>
					<!--<th>File</th>-->
					<!--<th>Status</th>-->
					<th>Delete</th>
					
				</tr>
			</thead>
			<tbody>
				<?
					$get = $con->query("SELECT * FROM results");
				    while($g = $get->fetch_assoc())
					{
					     $statusBtn = $g['status'] ? 'success' : 'danger';
					    $statusIcon = $g['status'] ? 'on' : 'off';
						$c = $con->query("SELECT * FROM courses where id = '".$g['course_id']."'")->fetch_assoc();
						echo '<tr>
									<td>'.$g['enrollment_no'].'</td>
									<td>'.$g['roll_no'].'</td>
									<td>'.$c['course_name'].'</td>
									<!--	<td>
									    <a href="?action=changeStatus&id='.$g['id'].'&val='.$g['status'].'" class="btn btn-sm btn-'.$statusBtn.'"><i class="fa fa-toggle-'.$statusIcon.'"></i></a>
									</td> --!>
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
// Assuming you have jQuery included in your project
$(document).ready(function() {
    $('.get_subject').on('change', function() {
        get_subject();
    });
});

function get_subject() {
    var dataString = 'course_id=' + $('#course_id').val() + '&status=subjects';
    $.ajax({
        url: "Ajax.php",
        type: "POST",
        data: dataString,
        beforeSend: function() {
            $('#list').html('<i class="text-danger"><i class="fa fa-spinner fa-spin"></i> Loading...</i>');
        },
        success: function($__res) {
            $('#list').html($__res);
        },
        complete: function() {}
    });
}

</script>
<script type="text/javascript">
	$('.get_roll').change(function(){
// 		 alert($(this).val());
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
				  
				    var data = res.split('|');
					$('#roll').val(data[0]);
					$('#course_id').val(data[1]);
					$('#data').val(data[2]);
					return get_subject();
				},
				complete:function()
				{
					$('#load').html('<i class="text-success"><i class="fa fa-check-circle"></i> Complete</i>');
				}
		});
	})
</script>