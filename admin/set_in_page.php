<?
require_once 'includes/header.php';
if($_GET['action'] == 'Set')
{
	$chk = $con->query("SELECT * FROM set_menu where page_id = '".$_GET['page_id']."' AND menu_id = '".$_GET['menu_id']."'");
	if(!($chk->num_rows))
	{
		$con->query("INSERT INTO `set_menu` (`id`, `timestamp`, `menu_id`, `page_id`) VALUES (NULL, CURRENT_TIMESTAMP, '".$_GET['menu_id']."', '".$_GET['page_id']."')");
	echo '<script>alert("Set Page in Menu");</script>';
	}
	
}

if($_GET['action'] == 'Unset')
{
	$con->query("DELETE FROM `set_menu` WHERE `set_menu`.`page_id` = '".$_GET['page_id']."'");
	echo '<script>alert("Unpage in Menu");</script>';
}
?>
<div class="container">
	<table class="table table-striped">
	<thead>
		<tr>
			<th>Page Name</th>
			<th>Action</th>
		</tr>
	</thead>
	<?
		$pages = $con->query("SELECT * FROM his_page");
		while($p = $pages->fetch_assoc())
		{
			$ch = $con->query("SELECT * FROM set_menu where page_id = '".$p['id']."' ");
			if($ch->num_rows)
			{
				echo '<tr>
					<td>'.ucwords($p['page_name']).'</td>
					<td><a href="?page_id='.$p['id'].'&action=Unset" class="btn btn-danger">Unset</a></td>
			</tr>';
			}
			else
			{
				echo '<tr>
					<td>'.ucwords($p['page_name']).'</td>
					<td><a href="?page_id='.$p['id'].'&menu_id='.$_GET['menu_id'].'&action=Set" class="btn btn-success">Set</a></td>
			</tr>';
			}
			
		}
	?>
</table>
</div>
<?
include 'includes/footer.php';
?>