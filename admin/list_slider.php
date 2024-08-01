<?
require_once 'includes/header.php';
if($_GET['action'] == 'del')
{
	$chk = $con->query("SELECT * FROM sliders where id = '".$_GET['id']."'")->fetch_assoc();
	if(file_exists("../uploads/".$chk['image']))
		unlink("../uploads/".$chk['image']);
	$con->query("DELETE FROM `sliders` WHERE `sliders`.`id` = '".$_GET['id']."'");
	echo '<script>alert("Slider Deleted.");location.href="list_slider.php"</script>';
}
?>
<div class="container">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Image</th>
				<th>Content</th>
				<th>Type</th>
				<th>Remove</th>
			</tr>
		</thead>
		<tbody>
			<?
				$slider = $con->query("SELECT * FROM sliders");
				while($s = $slider->fetch_assoc())
				{
					echo '<tr>
							<td><img src="../uploads/'.$s['image'].'" style="width:100px;height:100px;"></td><td>'.$s['content'].'</td><td>'.$s['type'].'</td>
							<td><a href="?id='.$s['id'].'&action=del" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
					</tr>';
				}
			?>
		</tbody>
	</table>
</div>
<?
include 'includes/footer.php';
?>