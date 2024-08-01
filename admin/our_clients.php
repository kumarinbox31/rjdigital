<?
require_once 'includes/header.php';
if($_POST['status'] == 'AddClient')
{
	$chk = $con->query("SELECT * FROM our_client where title = '".$_POST['title']."'");
	if(!($chk->num_rows))
	{
		$our = photo_upload('client','our_client');
		if($our['status'] == 1)
		{
			$con->query("INSERT INTO `our_client` (`id`, `timestamp`, `title`, `image`) VALUES (NULL, CURRENT_TIMESTAMP, '".$_POST['title']."', '".$our['file_name']."')");
			echo '<script>alert("Client Added.");location.href="our_clients.php"</script>';
		}
		else
		{
			echo '<script>alert("Error");<script>';
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
    		<div class="box-header">
    			<h3>Add Client Logo</h3>
    		</div>
    		<div class="box-body">
    			<form action="" method="post" enctype="multipart/form-data">
    				<input type="hidden" name="status" value="AddClient">
    				<div class="form-group">
    					<label>Client Title</label>
    					<input type="text" name="title" class="form-control" placeholder="Enter Title">
    				</div>
    				<div class="form-group">
    					<label>Client Logo</label>
    					<input type="file" name="client" class="form-control">
    				</div>
    				<div class="form-group">
    					<button class="btn btn-success" type="submit">Add</button>
    				</div>
    			</form>
    		</div>
    	</div>
    	<div class="box box-danger">
    		<div class="box-header">
    			<h3>All Client</h3>
    		</div>
    		<div class="box-body">
    			<table class="table table-striped">
    				<thead>
    					<tr>
    						<th>Client Title</th>
    						<th>Logo</th>
    					</tr>
    				</thead>
    				<tbody>
    					<?
    						$get = $con->query("SELECT * FROM our_client");
    						while($g = $get->fetch_assoc())
    						{
    							echo '<tr>
    									<td>'.ucwords($g['title']).'</td>
    									<td><img src="../uploads/our_client/'.$g['image'].'" style="width:100px;height:100px"></td>
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