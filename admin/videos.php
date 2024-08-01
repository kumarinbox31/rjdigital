<?
require_once 'includes/header.php';
if($_POST['status'] == 'Video')
{
    $sql = "UPDATE `videos` SET `video_url` = '".$_POST['video_url']."' WHERE `videos`.`id` = 1";
    $con->query($sql);
    echo '<script>alert("Video Uploaded.");location.href="videos.php"</script>';
}

if($_GET['action'] == 'del')
{
	$con->query("DELETE FROM `videos` WHERE `videos`.`id` = '".$_GET['id']."'");
	echo '<script>alert("Video Deleted.");location.href="videos.php"</script>';
}
?>
<div class="container" style="width: 100%;padding: 15px;">
	<div class="box box-success">
		<div class="box-header"><h3>Update Video</h3></div>
		<div class="box-body">
			<form action="" method="post" enctype="multipart/form-data">
				<input type="hidden" name="status" value="Video">
			
				<div class="form-group col-md-12">
					<label>Video URL</label>
					<input type="text" class="form-control" name="video_url" placeholder="Enter Video URL">
				</div>
				<div class="form-group col-md-12">
					<button class="btn btn-success" type="submit">Submit</button>
				</div>
			</form>
		</div>
	</div>
	<div class="box box-info">
		<div class="box-header">
			<h3>All Videos</h3>
		</div>
		<div class="box-body">
			<table class="table table-striped">
				<thead>
					<tr>
					
						<th>Video</th>
					
					</tr>
				</thead>
				<tbody>
					<?
						$video = $con->query("SELECT * FROM videos");
						$i=1;
						while($v = $video->fetch_assoc())
						{
							$url = str_replace('watch?v=','embed/', $v['video_url']);
							echo '
									<tr>
									
										<td>
										    <iframe width="100%" height="200" src="'.$url.'" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        
										</td>
									</tr>
							';
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?
include 'includes/footer.php';


?>
