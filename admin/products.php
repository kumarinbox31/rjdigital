<?
require_once 'includes/header.php';
if($_POST['status'] == 'InsertProduct')
{
	$chk = $con->query("SELECT * FROM designing where name = '".$_POST['title']."'");
	if(!($chk->num_rows))
	{
		$image = photo_upload('image','designing');
		
		if($image['status'] == 1)
		{
			$con->query("INSERT INTO `designing` (`id`, `timestamp`, `title`, `image`, `description`) VALUES (NULL, CURRENT_TIMESTAMP, '".$_POST['title']."', '".$image['file_name']."', '".$_POST['description']."')");
			echo '<script>alert("Product SuccessFully Upload.");location.href="products.php"</script>';
		}
		else
		{
			echo '<script>alert("Error In Photo Uploading.");location.href="products.php"</script>';
		}
	}

	
}
?>
<div class="container" style="background: #fff;width:90%;padding: 15px;">
	<form action="" method="post" class="products row" enctype="multipart/form-data">
		<input type="hidden" name="status" value="InsertProduct">
		<div class="form-group col-md-6">
			<label>Title</label>
			<input type="text" class="form-control" name="title" placeholder="Enter Product Name">
		</div>
		<div class="form-group col-md-6">
			<label> Image</label>
			<input type="file" class="form-control" name="image">
		</div>
		
		<div class="form-group col-md-12">
			<label>Description</label>
			<textarea class="form-control ckeditor" name="description" placeholder="Enter Product Description"></textarea>
		</div>
		<div class="form-group col-md-12">
			<button class="btn btn-success" type="submit">Add</button>
		</div>
	</form>
</div>
<?
include 'includes/footer.php';
?>
