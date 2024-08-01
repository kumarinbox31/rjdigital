
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
<div class="login-box">
  <div class="login-logo">
    <a href="theme/index2.html"><b>Admin</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
    <div id="Alert"></div>
    <form action="" method="post" class="Login">
      <input type="hidden" name="status" value="Check_Login">
      <div class="form-group has-feedback">
        <input type="text" name="username" class="form-control" placeholder="Username">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-6">
            <img src="../captcha.php" style="border:1px solid black;">
        </div>
        <div class="col-xs-6">
            <input type="number" min="0" name="digit" class="form-control" required>
        </div>
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button id="btn" type="submit" class="btn btn-primary btn-block btn-flat m-4" style="margin-top:4px;">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    
    <!-- /.social-auth-links -->

    <!--<a href="forgot.php">I forgot my password</a><br>-->
   
  </div>
  <!-- /.login-box-body -->
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
<script type="text/javascript">
  $('.Login').submit(function(e){
    e.preventDefault();
    // alert($(this).serialize());
    $.ajax({
            url:"Ajax.php",
            type:"POST",
            data:$(this).serialize(),
            dataType:"json",
            beforeSend:function()
            {
                $('#btn').html('<i class="fa fa-spinner fa-spin"></i> Wait...').prop('disabled',true);
                $('#Alert').html('<div class="alert alert-info"><b><i class="fa fa-spinner fa-spin"></i></b> Authenticating.</div>');
            },
            success:function(res)
            {
                if(res == 2){
                    $('#Alert').html('<div class="alert alert-warning"><b><i class="fa fa-danger"></i></b> Captcha Failed.</div>');
                    return false;
                }
              
                if(res)
                {
                    $('#Alert').html('<div class="alert alert-success"><b><i class="fa fa-check"></i></b> Login Success.</div>');
                    	
                    location.href="../admin/";
                }
                else
                {
                    $('#Alert').html('<div class="alert alert-danger"><b><i class="fa fa-times"></i></b> Login Failed.</div>');
                }
            },
            complete:function()
            {
              $('#btn').html('Sign In').prop('disabled',false);
            },
            error:function(q,e,r)
            {
              alert(r);
            }
    });
  })
</script>
