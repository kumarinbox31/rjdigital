<?
require_once 'includes/config.php';
if($_SESSION['pass_otp']){
    if($_POST['status']=='submit'){
        if($_POST['pass']==$_POST['con_pass']){
            $con->query("UPDATE `login` SET `password` = '".$_POST['pass']."' WHERE `login`.`id` = 1");
             echo '<script>alert("Your Password is Changed.");location.href="login.php"</script>';
        }else{
            echo '<script>alert("Confirm Password is not matched!!");</script>';
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin | Dashboard</title>
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
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="theme/dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="theme/bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="theme/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="theme/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="theme/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="theme/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
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
				          <button class="btn btn-success" type="submit" name="status" value="submit">Update Now</button>
				      </div>
				  </form>
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
<?
}
else
{
    echo '<script>location.href="forgot.php"</script>';
}

?>