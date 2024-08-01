<?
require_once 'includes/header.php';
?>
<br>
<div class="container">
	<div class="">
		<div class="col-md-6 col-md-offset-3">
		    
				<div class="box box-success ">
			    	 <h1 class="text_heading text-center">CENTER <span class="highlight_color">LOGIN</span></h1>
				<div class="box-body">
					<form action="" method="post">
						<div class="form-group">
							<label>Username</label>
							<input type="text" class="form-control" name="username" placeholder="Enter Username" required="">
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" class="form-control" name="password" placeholder="Enter Password" required="">
						</div>
						<div class="form-group">
							<button class="btn btn-danger" type="submit" name="status" value="center_login">Login</button>
						</div>
						<a href="forgot.php">Forgot Password</a>
					</form>
				</div>
			</div>
		</div>
		
	</div>
</div>
<?
include 'includes/footer.php';
?>