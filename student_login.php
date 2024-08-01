<?
require_once 'includes/header.php';
?>
<br>
<!--<div class="ContentHolder">-->
	<div class="container">
		<div class="col-lg-6 col-xs-12 col-sm-12 col-lg-offset-3">
		    <div class="box box-success ">
		    
			
				<h3 class="text_heading text-center">STUDENT <span class="highlight_color">LOGIN</span></h3>
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
							<button class="btn btn-danger" type="submit" name="status" value="student_login">Login</button>
						</div> 
					</form>
				</div>
			</div>
		</div>
		
	</div>
<!--</div>-->
<?
include 'includes/footer.php';
?>