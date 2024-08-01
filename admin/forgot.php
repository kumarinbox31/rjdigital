<?
require_once 'includes/config.php';
if($_POST['status']=='check_otp'){
    if($_SESSION['otp']==$_POST['my_otp'])
    {
        $_SESSION['pass_otp'] = 1;
        echo '<script>location.href="forgot_pass.php"</script>';
    }
    else
    {
        $_SESSION['pass_otp'] = 0;
        echo '<script>alert("OTP not match!!");location.href="forgot.php"</script>';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="theme/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="theme/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="theme/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="theme/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="theme/plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
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
				                $check = $con->query("SELECT * FROM login where email = '".$_POST['email']."'");
				               
				                if($check->num_rows)
				                {
				                    $db = $check->fetch_assoc();
				                    $_SESSION['pass']['center_id'] = $db['id'];
				                    $_SESSION['otp'] = rand(1111,9999);
				                    $to = $db['email'];
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
                                    echo $_SESSION['otp'];
                                    ?>
                                        <form action="" method="post">
                                            <div class="form-group">
                                                <label>Enter OTP</label>
                                                <input type="number" name="my_otp" placeholder="Enter OTP">
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-success" type="submit" name="status" value="check_otp">Submit</button>
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
							<button class="btn btn-success" type="submit" name="status" value="get_otp">Get OTP</button>
						</div>
						<a href="login.php">Login here</a>
					</form>
					<?
				        }
				        ?>
				</div>
			</div>
		</div>
		
	</div>
</div>
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="theme/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="theme/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="theme/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>