<?php
require_once 'includes/header.php';

if ($_POST['status'] == 'insert') {
    $chk = $con->query("SELECT * FROM centers where email_id = '" . $_POST['email_id'] . "' AND contact_number = '" . $_POST['contact_number'] . "'");
    
    if (!($chk->num_rows)) {
        $img = photo_upload('image', 'centers');
        
        if ($img['status']) {
            // Escape all the values using mysqli_real_escape_string to prevent SQL injection
            $name = mysqli_real_escape_string($con, $_POST['name']);
            $institute_name = mysqli_real_escape_string($con, $_POST['institute_name']);
            $dob = mysqli_real_escape_string($con, $_POST['dob']);
            $pan_number = mysqli_real_escape_string($con, $_POST['pan_number']);
            $aadhar_number = mysqli_real_escape_string($con, $_POST['aadhar_number']);
            $center_full_address = mysqli_real_escape_string($con, $_POST['center_full_address']);
            $pincode = mysqli_real_escape_string($con, $_POST['pincode']);
            $whatsapp_number = mysqli_real_escape_string($con, $_POST['whatsapp_number']);
            $email_id = mysqli_real_escape_string($con, $_POST['email_id']);
            $qualification_of_center_head = mysqli_real_escape_string($con, $_POST['qualification_of_center_head']);
            $reception = mysqli_real_escape_string($con, $_POST['reception']);
            $username = mysqli_real_escape_string($con, $_POST['username']);
            $password = mysqli_real_escape_string($con, $_POST['password']);
            
            $query = "INSERT INTO `centers` (`id`, `timestamp`, `center_number`, `name`, `institute_name`, `dob`, `pan_number`, `aadhar_number`, `center_full_address`,`pincode`, `state_id`, `city_id`, `no_of_computer_operator`, `no_of_class_room`, `total_computer`, `space_of_computer_center`, `whatsapp_number`, `contact_number`, `email_id`, `qualification_of_center_head`, `staff_room`, `water_supply`, `toilet`, `reception`, `username`, `password`, `transection_id`, `status`, `image`) VALUES (NULL, CURRENT_TIMESTAMP, '" . time() . "', '$name', '$institute_name', '$dob', '$pan_number', '$aadhar_number', '$center_full_address','$pincode', '" . $_POST['state_id'] . "', '" . $_POST['city_id'] . "', '" . $_POST['no_of_computer_operator'] . "', '" . $_POST['no_of_class_room'] . "', '" . $_POST['total_computer'] . "', '" . $_POST['space_of_computer_center'] . "', '$whatsapp_number', '" . $_POST['contact_number'] . "', '$email_id', '$qualification_of_center_head', '" . $_POST['staff_room'] . "', '" . $_POST['water_supply'] . "', '" . $_POST['toilet'] . "', '$reception', '$username', '$password', '', '1', '$img[file_name]')";

            $data = $con->query($query);

            if ($data) {
                echo '<script>alert("Registration Success.");location.href="create_center.php"</script>';
            } else {
                die('Error: ' . $con->error . '<br>Query: ' . $query);
            }
        } else {
            echo '<script>alert("Error in image uploading...");location.href="create_center.php"</script>';
        }
    } else {
        echo '<script>alert("Already exists.");location.href="create_center.php"</script>';
    }
}
$randomNumber = rand(1, 99);
$center_number = 'KICK01' . str_pad($randomNumber, 2, '0', STR_PAD_LEFT);
?>
<!-- Your HTML form goes here -->

<!-- Your HTML form goes here -->

<br>
<div class="container">
    
	<div class="panel panel-info">
		<div class="panel-heading"><h3>Franchisee Form</h3></div>
		<div class="panel-body">
			<form action="" method="post" enctype="multipart/form-data" class="row">
			    <input type="hidden" name="center_number" value="<? echo $center_number?>">
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Institute Owner Name</label>
					<input type="text" name="name" class="form-control" placeholder="Enter Institute Owner Name" required>
				</div>
				<div class="form-group col-lg-8 col-xs-12 col-sm-12">
					<label>Institute Name</label>
					<input type="text" name="institute_name" class="form-control" placeholder="Enter Institute Name" required>
				</div>
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Date of birth</label>
					<input type="date" name="dob" class="form-control" placeholder="Enter Center Owner Name" required>
				</div>
				
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Pan Number</label>
					<input type="text" name="pan_number" class="form-control" placeholder="Enter Pan Number" required>
				</div>
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Aadhar Number</label>
					<input type="number" name="aadhar_number" class="form-control" placeholder="Enter Aadhar Number" required>
				</div>
				<div class="form-group col-lg-12 col-xs-12 col-sm-12">
					<label>Institite Full Address</label>
					<textarea class="form-control" name="center_full_address" placeholder="Institite Full Address" required></textarea>
				</div>
				<div class="form-group col-lg-12 col-xs-12 col-sm-12">
					<label>Pincode</label>
					<input class="form-control" name="pincode" placeholder="Enter Pincode" required>
				</div>
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Upload Image of franchise Owner</label>
					<input type="file" name="image" class="form-control" required>
				</div>
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Select State </label>
					<select class="form-control get_city" name="state_id" required="">
						<option value="">--Select--</option>
						<?
							$state = $con->query("SELECT * FROM states");
							while($s = $state->fetch_assoc())
							{
								echo '<option value="'.$s['id'].'">'.ucwords($s['state_name']).'</option>';
							}
						?>
					</select>
				</div>
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Select Distric <span id="load"></span></label>
					<select class="form-control list" name="city_id" required="">
						<option value="">--Select--</option>
						
					</select>
				</div>
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label> Number of computer operators</label>
					<input type="number" name="no_of_computer_operator" class="form-control" placeholder="Enter Number of computer operators" required>
				</div>
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Number of class rooms</label>
					<input type="number" name="no_of_class_room" class="form-control" placeholder="Enter Number of class rooms" required>
				</div>
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Total Computers</label>
					<input type="number" name="total_computer" class="form-control" placeholder="Enter Total Computers" required>
				</div>
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Space of  Computer Center</label>
					<input type="number" name="space_of_computer_center" class="form-control" placeholder="Enter Space of  Computer Center" required>
				</div>
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Whatsapp Number</label>
					<input type="number" name="whatsapp_number" class="form-control" placeholder="Enter Whatsapp Number" required>
				</div>
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Contact Number</label>
					<input type="number" name="contact_number" class="form-control" placeholder="Enter Contact Number" required>
				</div>
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>E-Mail ID</label>
					<input type="email" name="email_id" class="form-control" placeholder="Enter E-Mail ID" required>
				</div>
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Qualification of institute head</label>
					<input type="text" name="qualification_of_center_head" class="form-control" placeholder="Enter Qualification of institute head" required>
				</div>
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Reception</label>
					<input type="text" name="reception" class="form-control" placeholder="Enter Reception" required>
				</div>
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Staff Room</label>
					<label>Yes <input type="radio" name="staff_room" value="yes" required=""></label>
					<label>No <input type="radio" name="staff_room" value="no" required=""></label>
				</div>
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Water Supply</label>
					<label>Yes <input type="radio" name="water_supply" value="yes" required=""></label>
					<label>No <input type="radio" name="water_supply" value="no" required=""></label>
					
				</div>
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Toilet</label>
					<label>Yes <input type="radio" name="toilet" value="yes" required=""></label>
					<label>No <input type="radio" name="toilet" value="no" required=""></label>
				</div>
				<div class="form-group col-lg-6 col-xs-12 col-sm-12">
					<label>Username</label>
					<input type="text" name="username" class="form-control" placeholder="Enter" required>
				</div>
				<div class="form-group col-lg-6 col-xs-12 col-sm-12">
					<label>Password</label>
					<input type="text" name="password" class="form-control" placeholder="Enter" required>
				</div>
		
    			<div class="form-group col-lg-12 col-xs-12 col-sm-12 m-4 text-center">
                    <input type="hidden" name="status" value="insert">
                    <button class="btn btn-info" type="submit">Submit</button>
                </div>

			</form>
		</div>
	</div>
</div>
<?
include 'includes/footer.php';
?>

<script type="text/javascript">
    $(document).ready(function() {
        $('.get_city').change(function() {
            var stateId = $(this).val();
            var dataString = 'state_id=' + stateId + '&status=get_city';

            $.ajax({
                url: "Ajax.php", // Update with the correct URL
                type: "POST",
                data: dataString,
                beforeSend: function() {
                    $('#load').html('<i class="text-danger"><i class="fa fa-spinner fa-spin"></i> Loading...</i>');
                },
                success: function(response) {
                    $('.list').html(response);
                },
                complete: function() {
                    $('#load').html('<i class="text-success"> Complete <i class="fa fa-check-circle"></i></i>');
                }
            });
        });
    });
</script>
