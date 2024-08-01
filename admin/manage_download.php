<?
require_once 'includes/header.php';
if($_POST['status'] == 'Manage')
{
	$chk = $con->query("SELECT * FROM manage_downloads where title = '".$_POST['title']."'");
	if(!($chk->num_rows))
	{
		$image = photo_upload('image','downloads');
		if($image['status']==1)
		{
			$con->query("INSERT INTO `manage_downloads` (`id`, `timestamp`, `title`, `image`) VALUES (NULL, CURRENT_TIMESTAMP, '".$_POST['title']."', '".$image['file_name']."')");
			echo '<script>alert("Image Upload SuccessFully.");location.href="manage_download.php"</script>';
		}
		else
		{
			echo '<script>alert("Error in Image Uploading.");location.href="manage_download.php"</script>';
		}
		
	}
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

    <!-- Main content -->
    <section class="content">
    	<div class="box box-success">
    		<div class="box-header"><h3 class="text-green">Manage Download</h3></div>
    		<div class="box-body">
    			<form action="" method="POST" class="form-inline" enctype="multipart/form-data">
    				<input type="hidden" name="status" value="Manage">
    				<div class="form-group">
    					<label>Image Title</label>
    					<input type="text" name="title" class="form-control" placeholder="Enter Image Title">
    				</div>
    				<div class="form-group">
    					
    					<input type="file" name="image" class="form-control" placeholder="Enter Image Title">
    				</div>
    				<div class="form-group">
    					<button class="btn btn-success" type="submit">Add</button>
    				</div>
    			</form>
    		</div>
    		<div class="box-footer">
    			<table class="table table-striped">
    				<thead>
    					<tr>
    						<th>Image Title</th>
    						<th>Image</th>
    						<th>URL</th>
    						<th>Remove</th>
    					</tr>
    				</thead>
    				<tbody>
    					<?
    					
    						$get = $con->query("SELECT * FROM manage_downloads");
    						while($m = $get->fetch_assoc())
    						{
    							echo '
    									<tr>
    										<td>'.ucwords($m['title']).'</td>
    										<td><img src="../uploads/downloads/'.$m['image'].'" style="width:100px;height:100px;"></td>
    										<td><button id="btn_'.$m['id'].'" class="btn btn-primary" onclick="myFunction('.$m['id'].')">Copy</button><input type="text" style="z-index:-7;position:absolute;opacity:1" name="image_text" value="http://localhost/service/uploads/downloads/'.$m['image'].'" id="myInput_'.$m['id'].'"></td>
    										<td><a href="?id='.$m['id'].'&action=del" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
    									</tr>
    							';
    						}
    					?>
    				</tbody>
    			</table>
    		</div>
    	</div>
<?
include 'includes/footer.php';
?>
<script>
function myFunction(id) {
  /* Get the text field */
  var copyText = document.getElementById("myInput_"+id);

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /*For mobile devices*/

  /* Copy the text inside the text field */
  document.execCommand("copy");
    $('#btn_'+id).html("Copied");
  /* Alert the copied text */
//   alert("Copied the text: " + copyText.value);
}
</script>