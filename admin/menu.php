<?
require_once 'includes/header.php';
if($_GET['action']=='del')
{
	$con->query("DELETE FROM `menu` WHERE `menu`.`id` = '".$_GET['menu_id']."'");
	echo '<script>alert("Menu Deleted.");location.href="menu.php"</script>';
}
?>
<br>
<div class="container">
	<form action="" method="post" class="AddMenu form-inline">
		<input type="hidden" name="status" value="Add_Menu">
		<div class="form-group ">
			<label>Menu Name</label>
			<input type="text" class="form-control" name="name" placeholder="Enter Menu Name">
		</div>
		<div class="form-group">
			<button class="btn btn-success" type="submit">Add</button>
		</div>
	</form>
</div>
<div class="container">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Menu Name</th>
				<th>Set in Pages</th>
				<th>Remove</th>
			</tr>
		</thead>
		<tbody>
			<?
				$get_menu = $con->query("SELECT * FROM menu");
				while($m = $get_menu->fetch_assoc())
				{
					echo '<tr>
							<td>'.ucwords($m['name']).'</td>
							<td><a href="set_in_page.php?menu_id='.$m['id'].'" class="btn btn-info">Set in Page</a></td>
							<td><a href="?menu_id='.$m['id'].'&action=del" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
					</tr>';
				}
			?>
		</tbody>
	</table>
</div>
<?
include 'includes/footer.php';
?>
<script type="text/javascript">
	$('.AddMenu').submit(function(e){
		// alert($(this).serialize());
		e.preventDefault();
		$.ajax({
				url:"Ajax.php",
				type:"POST",
				data:$(this).serialize(),
				beforeSend:function()
				{

				},
				success:function(res)
				{
					 if(res==1)
					 	location.reload();
				},
				complete:function()
				{

				},
				error:function(q)
				{
					// alert(q);
				}
		});
	})
</script>