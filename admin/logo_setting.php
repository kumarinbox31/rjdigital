<?
require_once 'includes/header.php';
if(isset($_POST['status']) && $_POST['status'] == 'Upload')
{
    if(isset($_FILES['logo'])){
	$logo = photo_upload('logo','logo');
	if($logo['status']==1)
	{
		
		
		$con->query("UPDATE `logo_setting` SET `logo` = '".$logo['file_name']."' WHERE `logo_setting`.`id` = 1");
		echo '<script>alert("Logo Updated.");location.href="logo_setting.php"</script>';
	}
    }
    
    if(isset($_FILES['favicon'])){
	$logo = photo_upload('favicon','logo');
	if($logo['status']==1)
	{
		
		
		$con->query("UPDATE `logo_setting` SET `favicon` = '".$logo['file_name']."' WHERE `logo_setting`.`id` = 1");
		echo '<script>alert("Favicon Updated.");location.href="logo_setting.php"</script>';
	}
    }
}
?>
<br>
<div class="row">
<div class="col-md-6">
<div class="box box-danger">
	<div class="box-header"><h3>Logo Setting</h3></div>
	<div class="box-body">
		<form accept="" method="post" enctype="multipart/form-data">
			<input type="hidden" name="status" value="Upload">
			<div class="form-group col-md-4">
				<label>Logo</label>
				<input type="file" class="form-control" name="logo">
			</div>
			<div class="form-group col-md-12">
				<button class="btn btn-danger" type="submit">Upload</button>
			</div>
		</form>
	</div>
	<div class="box-footer">
		<? $logo = $con->query("SELECT  * FROM logo_setting where id = 1")->fetch_assoc(); ?>
		<img src="../uploads/logo/<?=$logo['logo']?>" style="width:100px;">
	</div>
</div>
</div>
<div class="col-md-6">
<div class="box box-warning">
	<div class="box-header"><h3>Favicon Setting</h3></div>
	<div class="box-body">
		<form accept="" method="post" enctype="multipart/form-data">
			<input type="hidden" name="status" value="Upload">
			<div class="form-group col-md-4">
				<label>Logo</label>
				<input type="file" class="form-control" name="favicon">
			</div>
			<div class="form-group col-md-12">
				<button class="btn btn-danger" type="submit">Upload</button>
			</div>
		</form>
	</div>
	<div class="box-footer">
		<img src="../uploads/logo/<?=$logo['favicon']?>" style="width:100px;">
	</div>
</div>
</div>
</div>
<?
include 'includes/footer.php';
?>