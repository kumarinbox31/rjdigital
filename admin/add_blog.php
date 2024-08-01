<?
require_once 'includes/header.php';
if($_POST['status'] == 'Upload')
{
	$chk = $con->query("SELECT * FROM blogs where title = '".$_POST['title']."'");
	if(!($chk->num_rows))
	{
		$image = photo_upload('image','blogs');
		if($image['status']==1)
		{
			$con->query("INSERT INTO `blogs` (`id`, `timestamp`, `image`, `title`, `description`) VALUES (NULL, CURRENT_TIMESTAMP, '".$image['file_name']."', '".$_POST['title']."', '".$_POST['description']."')");
			echo '<script>alert("Blog Uploaded.");location.href="add_blog.php"</script>';
		}
	}
}

if($_GET['action']=='del')
{
    if(file_exists("../uploads/blogs".$_GET['file']))
        unlink("../uploads/blogs".$_GET['file']);
    $con->query("DELETE FROM blogs where id = '".$_GET['id']."'");
   	echo '<script>alert("Blog Deleted.");location.href="add_blog.php"</script>';
}
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
      	<div class="box box-warning">
      		<div class="box-header">
      			<h3>Add Blog</h3>
      		</div>
      		<div class="box-body">
      			<form action="" method="post" enctype="multipart/form-data">
      				<input type="hidden" name="status" value="Upload">
      				<div class="form-group col-md-6">
      					<label>Blog Title</label>
      					<input type="text" class="form-control" name="title" placeholder="Enter Blog Title" required="">
      				</div>  
      				<div class="form-group col-md-6">
      					<label>Blog Image</label>
      					<input type="file" name="image" class="form-control" required="">
      				</div>
      				<div class="form-group col-md-12">
      					<label>Blog Content</label>
      					<textarea class="form-control ckeditor" name="description" required=""></textarea>
      				</div>
      				<div class="form-group">
      					<button class="btn btn-warning" type="submit"><i class="fa fa-upload"></i> Upload</button>
      				</div>
      			</form>
      		</div>
      	</div>
        <div class="box box-success">
          <div class="box-header"><h3>List Blogs</h3></div>
          <div class="box-body">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Blog Title</th>
                  <th>Blog Image</th>
                  <th>Remove</th>
                </tr>
              </thead>
              <tbody>
                <?
                  $get = $con->query("SELECT * FROM blogs");
                  while($g = $get->fetch_assoc())
                  {
                    echo '<tr>
                              <td>'.ucwords($g['title']).'</td>
                              <td><img src="../uploads/blogs/'.$g['image'].'" style="width:100px;height:100px;"></td>
                              <td><a href="?id='.$g['id'].'&action=del&file='.$g['image'].'" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                    </tr>';
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
<?
include 'includes/footer.php';
?>