<?
require_once 'includes/header.php';
if($_POST['status']=='check_otp'){
    if($_SESSION['otp']==$_POST['my_otp'])
    {
        $_SESSION['pass_otp'] = 1;
        echo '<script>location.href="change_password.php"</script>';
    }
    else
    {
        $_SESSION['pass_otp'] = 0;
        echo '<script>alert("OTP not match!!");location.href="forgot.php"</script>';
    }
}
?>
<br>
<div class="ContentHolder">
	<div class="container">
		<div class="col-lg-6 col-xs-12 col-sm-12 col-lg-offset-3">
			<div class="box box-success ">
				<div class="box-header"><h3>Forgot Password</h3></div>
				<div class="box-body">
				    <?
				        if($_POST['status']=='get_otp')
				        {
				                $check = $con->query("SELECT * FROM centers where email_id = '".$_POST['email']."'");
				               
				                if($check->num_rows)
				                {
				                    $db = $check->fetch_assoc();
				                    $_SESSION['pass']['center_id'] = $db['id'];
				                    $_SESSION['otp'] = rand(1111,9999);
				                    $to = $db['email_id'];
                                    $subject = 'Forgot Password';
                                    $from = 'noreply@'.$_SERVER['HTTP_HOST'];
                                     
                                    // To send HTML mail, the Content-type header must be set
                                    $headers  = 'MIME-Version: 1.0' . "\r\n";
                                    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                                     
                                    // Create email headers
                                    $headers .= 'From: '.$from."\r\n".
                                        'Reply-To: '.$from."\r\n" .
                                        'X-Mailer: PHP/' . phpversion();
                                     
                                    // Compose a simple HTML email message
                                    $message = '<html><body>';
                                    $message .= '<h1 style="color:#f40;">Hi Dear!</h1>';
                                    $message .= '<p style="color:#080;font-size:18px;">Your Password Forgetten key is '.$_SESSION['otp'].'</p>';
                                    $message .= '</body></html>';
                                    //  echo $message;
                                    // Sending email
                                    if(mail($to, $subject, $message, $headers)){
                                        echo 'Your mail has been sent successfully.';
                                    } else{
                                        echo 'Unable to send email. Please try again.';
                                    }
                                    ?>
                                        <form action="" method="post">
                                            <div class="form-group">
                                                <label>Enter OTP</label>
                                                <input type="number" name="my_otp" placeholder="Enter OTP">
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-primary" type="submit" name="status" value="check_otp">Submit</button>
                                            </div>
                                        </form>
                                    <?
				                }
				                else
				                {
				                    echo '<script>alert("E-Mail not matched!!");location.href="forgot.php"</script>';
				                }
				            ?>
				                
				            <?
				        }
				        else
				        {
				    ?>
					<form action="" method="post">
					    
						<div class="form-group">
							<label>Your E-Mail</label>
							<input type="email" class="form-control" name="email" placeholder="Enter E-Mail" required="">
						</div>
						
						<div class="form-group">
							<button class="btn btn-danger" type="submit" name="status" value="get_otp">Get OTP</button>
						</div>
						<a href="center_login.php">Login here</a>
					</form>
					<?
				        }
				        ?>
				</div>
			</div>
		</div>
		
	</div>
</div>
<?
include 'includes/footer.php';
?>