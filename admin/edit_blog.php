<?
require_once 'includes/header.php';
if($_POST['status'] == 'Update')
{
	$image = photo_upload('image','designing');
	if(empty($_FILES['image']['name']))
	{
		$con->query("UPDATE `designing` SET `title` = '".$_POST['title']."', `description` = '".$_POST['description']."' WHERE `designing`.`id` = '".$_GET['b_id']."'");
		echo '<script>alert("Blog SuccessFully Update.");</script>';
	}
	else
	{
		if($image['status']==1)
		{
			if(file_exists("../uploads/designing/".$_POST['image_name']))
			{
				unlink("../uploads/designing/".$_POST['image_name']);
			}
			$con->query("UPDATE `designing` SET `title` = '".$_POST['title']."', `image` = '".$image['file_name']."', `description` = '".$_POST['description']."' WHERE `designing`.`id` = '".$_GET['b_id']."'");
			echo '<script>alert("Blog SuccessFully Update.");</script>';
		}
	}
	
}
$b = $con->query("SELECT * FROM designing where id = '".$_GET['b_id']."'")->fetch_assoc();
?>
<section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
      <section class="content">
    	<div class="box box-success">
    		<div class="box-header"><h3>Edit Blog</h3></div>
    		<div class="box-body">
    			<form action="" method="post" enctype="multipart/form-data">
    				<input type="hidden" name="status" value="Update">
    				<input type="hidden" name="image_name" value="<?=$b['image']?>">
    				<div class="form-group col-md-4">
    					<label>Title</label>
    					<input type="text" name="title" class="form-control" value="<?=$b['title']?>">
    				</div>
    				<div class="form-group col-md-12">
    					<label>Image</label>
    					<div><img src="../uploads/designing/<?=$b['image']?>" style="width:150px;height:100px;border:1px solid black"></div>
    					<input type="file" name="image" class="form-control">

    				</div>
    				<div class="form-group">
    					<label>Description</label>
    					<textarea class="form-control ckeditor" name="description"><?=$b['description']?></textarea>
    				</div>
    				<div class="form-group">
    					<button class="btn btn-success" type="submit">Update</button>
    				</div>
    			</form>
    		</div>
    	</div>
    <!-- Main content -->
    <section class="content">
<?
include 'includes/footer.php';
?>