<?
require_once 'includes/header.php';
if($_POST['status']=='insert')
{
	if(empty($_FILES['image']['name']))
	{
	    $con->query("UPDATE `centers` SET `session` = '".$_POST['session']."' ,`valid_upto` = '".$_POST['valid_upto']."' ,`center_number` = '".$_POST['center_number']."' ,`name` = '".$_POST['name']."', `institute_name` = '".$_POST['institute_name']."', `dob` = '".$_POST['dob']."', `pan_number` = '".$_POST['pan_number']."', `aadhar_number` = '".$_POST['aadhar_number']."', `center_full_address` = '".$_POST['center_full_address']."', `state_id` = '".$_POST['state_id']."', `city_id` = '".$_POST['city_id']."', `no_of_computer_operator` = '".$_POST['no_of_computer_operator']."', `no_of_class_room` = '".$_POST['no_of_class_room']."', `total_computer` = '".$_POST['total_computer']."', `space_of_computer_center` = '".$_POST['space_of_computer_center']."', `whatsapp_number` = '".$_POST['whatsapp_number']."', `contact_number` = '".$_POST['contact_number']."', `email_id` = '".$_POST['email_id']."', `qualification_of_center_head` = '".$_POST['qualification_of_center_head']."', `staff_room` = '".$_POST['staff_room']."', `water_supply` = '".$_POST['water_supply']."', `toilet` = '".$_POST['toilet']."', `reception` = '".$_POST['reception']."', `username` = '".$_POST['username']."', `password` = '".$_POST['password']."' WHERE `centers`.`id` = '".$_GET['id']."'");
	    echo '<script>alert("Institute update Success.");location.href="center_update.php?id='.$_GET['id'].'"</script>';
	}
	else
	{
	    $img = photo_upload('image','centers');
    	if($img['status'])
    	{
    	    
    		$con->query("UPDATE `centers` SET `session` = '".$_POST['session']."' ,`valid_upto` = '".$_POST['valid_upto']."' ,`center_number` = '".$_POST['center_number']."' , `name` = '".$_POST['name']."', `institute_name` = '".$_POST['institute_name']."', `dob` = '".$_POST['dob']."', `pan_number` = '".$_POST['pan_number']."', `aadhar_number` = '".$_POST['aadhar_number']."', `center_full_address` = '".$_POST['center_full_address']."', `state_id` = '".$_POST['state_id']."', `city_id` = '".$_POST['city_id']."', `no_of_computer_operator` = '".$_POST['no_of_computer_operator']."', `no_of_class_room` = '".$_POST['no_of_class_room']."', `total_computer` = '".$_POST['total_computer']."', `space_of_computer_center` = '".$_POST['space_of_computer_center']."', `whatsapp_number` = '".$_POST['whatsapp_number']."', `contact_number` = '".$_POST['contact_number']."', `email_id` = '".$_POST['email_id']."', `qualification_of_center_head` = '".$_POST['qualification_of_center_head']."', `staff_room` = '".$_POST['staff_room']."', `water_supply` = '".$_POST['water_supply']."', `toilet` = '".$_POST['toilet']."', `reception` = '".$_POST['reception']."', `username` = '".$_POST['username']."', `password` = '".$_POST['password']."', `image` = '".$img['file_name']."' WHERE `centers`.`id` = '".$_GET['id']."'");
    		if(file_exists("../uploads/centers/".$_GET['file']))
    		    unlink("../uploads/centers/".$_GET['file']);
    		echo '<script>alert("Institute update Success.");location.href="center_update.php?id='.$_GET['id'].'"</script>';
    	}
    	else
    	{
    		echo '<script>alert("Error in image uploading...");location.href="center_update.php?id='.$_GET['id'].'"</script>';
    	}
	}
}
$get = $con->query("SELECT * FROM centers where id = '".$_GET['id']."'")->fetch_assoc();
?>


	<div class="box box-info">
		<div class="box-header"><h3>Franchisee Form</h3></div>
		<div class="box-body">
			<form action="" method="post" enctype="multipart/form-data">
			    <input type="hidden" name="file" value="<?=$get['image']?>">
			    <div class="form-group col-lg-12 col-xs-12 col-sm-12">
					<label>Institute ID</label>
					<input type="text" name="center_number" class="form-control" value="<?=$get['center_number']?>" >
				</div>
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Institute Owner Name</label>
					<input type="text" name="name" class="form-control" value="<?=$get['name']?>">
				</div>
				<div class="form-group col-lg-8 col-xs-12 col-sm-12">
					<label>Institute Name</label>
					<input type="text" name="institute_name" class="form-control" value="<?=$get['institute_name']?>">
				</div>
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Date of birth</label>
					<input type="date" name="dob" class="form-control" value="<?=$get['dob']?>">
				</div>
				
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Pan Number</label>
					<input type="text" name="pan_number" class="form-control" value="<?=$get['pan_number']?>">
				</div>
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Aadhar Number</label>
					<input type="number" name="aadhar_number" class="form-control" value="<?=$get['aadhar_number']?>">
				</div>
				<div class="form-group col-lg-12 col-xs-12 col-sm-12">
					<label>Institite Full Address</label>
					<textarea class="form-control" name="center_full_address" ><?=$get['center_full_address']?></textarea>
				</div>
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Image</label>
					<input type="file" name="image" class="form-control" >
				</div>
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Select State </label>
					<select class="form-control get_city" name="state_id" required="">
						<option value="">--Select--</option>
						<?
							$state = $con->query("SELECT * FROM states");
							while($s = $state->fetch_assoc())
							{
							    $sel = $s['id']==$get['state_id']?"selected":"";
								echo '<option value="'.$s['id'].'" '.$sel.'>'.ucwords($s['state_name']).'</option>';
							}
						?>
					</select>
				</div>
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Select Distric <span id="load"></span></label>
					<select class="form-control list" name="city_id" required="">
						<option value="">--Select--</option>
						<?
							$city = $con->query("SELECT * FROM city");
							while($c = $city->fetch_assoc())
							{
							    $sel = $c['id']==$get['city_id']?"selected":"";
								echo '<option value="'.$c['id'].'" '.$sel.'>'.ucwords($c['city_name']).'</option>';
							}
						?>
					</select>
				</div>
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label> Number of computer operators</label>
					<input type="number" name="no_of_computer_operator" class="form-control" value="<?=$get['no_of_computer_operator']?>">
				</div>
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Number of class rooms</label>
					<input type="number" name="no_of_class_room" class="form-control" value="<?=$get['no_of_class_room']?>">
				</div>
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Total Computers</label>
					<input type="number" name="total_computer" class="form-control" value="<?=$get['total_computer']?>">
				</div>
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Space of  Computer Center</label>
					<input type="number" name="space_of_computer_center" class="form-control" value="<?=$get['space_of_computer_center']?>">
				</div>
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Whatsapp Number</label>
					<input type="number" name="whatsapp_number" class="form-control" value="<?=$get['whatsapp_number']?>">
				</div>
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Contact Number</label>
					<input type="number" name="contact_number" class="form-control" value="<?=$get['contact_number']?>">
				</div>
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>E-Mail ID</label>
					<input type="email" name="email_id" class="form-control" value="<?=$get['email_id']?>">
				</div>
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Qualification of institute head</label>
					<input type="text" name="qualification_of_center_head" class="form-control" value="<?=$get['qualification_of_center_head']?>">
				</div>
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Reception</label>
					<input type="text" name="reception" class="form-control" value="<?=$get['reception']?>">
				</div>
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Staff Room</label>
					<label>Yes <input type="radio" name="staff_room" value="yes" required="" <? if($get['staff_room']=='yes'){echo 'checked';} ?>></label>
					<label>No <input type="radio" name="staff_room" value="no" required="" <? if($get['staff_room']=='no'){echo 'checked';} ?>></label>
				</div>
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Water Supply</label>
					
					<label>Yes <input type="radio" name="water_supply" value="yes" required="" <? if($get['water_supply']=='yes'){echo 'checked';} ?>></label>
					<label>No <input type="radio" name="water_supply" value="no" required="" <? if($get['water_supply']=='no'){echo 'checked';} ?>></label>
					
				</div>
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Toilet</label>
					<label>Yes <input type="radio" name="toilet" value="yes" required="" <? if($get['toilet']=='yes'){echo 'checked';} ?>></label>
					<label>No <input type="radio" name="toilet" value="no" required="" <? if($get['toilet']=='no'){echo 'checked';} ?>></label>
				</div>
				
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Username</label>
					<input type="text" name="username" class="form-control" value="<?=$get['username']?>">
				</div>
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Password</label>
					<input type="text" name="password" class="form-control" value="<?=$get['password']?>">
				</div>
					<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					    <label>Image</label>
					<img style="width:100%; height:170px;" src="../uploads/centers/<?=$get['image']?>">
				</div>
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Session</label>
					<input type="text"  name="session" class="form-control" value="<?=$get['session']?>">
				</div>
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Valid Upto</label>
					<input type="text"  name="valid_upto" class="form-control" value="<?=$get['valid_upto']?>">
				</div>
				<div class="form-group col-lg-12 col-xs-12 col-sm-12">
					<button class="btn btn-info col-lg-12 col-xs-12 col-sm-12" type="submit" name="status" value="insert">Submit</button>
				</div>
			</form>
		</div>
	</div>

<?
include 'includes/footer.php';
?>
<script type="text/javascript">
	$('.get_city').change(function(){
		// alert($(this).val());
		var dataString = 'state_id='+$(this).val()+'&status=get_city';
		$.ajax({
				url:"Ajax.php",
				type:"POST",
				data:dataString,
				beforeSend:function()
				{
					$('#load').html('<i class="text-danger"><i class="fa fa-spinner fa-spin"></i> Loading...</i>');
				},
				success:function($res)
				{
					$('.list').html($res);
				},
				complete:function()
				{
					$('#load').html('<i class="text-success"> Complete <i class="fa fa-check-circle"></i></i>');
				}
		});
	})
</script>