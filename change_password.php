<?
require_once 'includes/header.php';
if($_SESSION['pass_otp']){
    if($_POST['status']=='submit'){
        if($_POST['pass']==$_POST['con_pass']){
            $con->query("UPDATE `centers` SET `password` = '".$_POST['pass']."' WHERE `centers`.`id` = '".$_SESSION['pass']['center_id']."'");
             echo '<script>alert("Your Password is Changed.");location.href="center_login.php"</script>';
        }else{
            echo '<script>alert("Confirm Password is not matched!!");</script>';
        }
    }
?>
<br>
<div class="ContentHolder">
	<div class="container">
		<div class="col-lg-6 col-xs-12 col-sm-12 col-lg-offset-3">
			<div class="box box-success ">
				<div class="box-header"><h3>Change Password</h3></div>
				<div class="box-body">
				  <form action="" method="post">
				      <div class="form-group">
				          <label>Create New Password</label>
				          <input type="password" name="pass" class="form-control" placeholder="Create New Password" required>
				      </div>
				      <div class="form-group">
				          <label>Confirm Password</label>
				          <input type="password" name="con_pass" class="form-control" placeholder="Confirm Password" required>
				      </div>
				      <div class="form-group">
				          <button class="btn btn-danger" type="submit" name="status" value="submit">Update Now</button>
				      </div>
				  </form>
				</div>
			</div>
		</div>
		
	</div>
</div>
<?
}
else
{
    echo '<script>location.href="forgot.php"</script>';
}
include 'includes/footer.php';
?>