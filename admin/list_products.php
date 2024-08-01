<?
require_once 'includes/header.php';
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
<div class="container" style="width: 90%;padding: 15px;background: #fff">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>ID</th>
				<th>Title</th>
				<th> Image</th>
				<th>Description</th>
				<th>Edit</th>
			</tr>
		</thead>
		<tbody>
			<?
				$products = $con->query("SELECT * FROM designing");
				while($pro = $products->fetch_assoc())
				{
					echo '<tr>
								<td>'.$pro['id'].'</td>
								<td>'.$pro['title'].'</td>
								<td><img src="../uploads/designing/'.$pro['image'].'" id="Design"></td>
								<td>'.$pro['description'].'</td>
								<td><a href="edit_blog.php?b_id='.$pro['id'].'" class="btn btn-info"><i class="fa fa-eye"></i></a></td>
					</tr>';
				}
			?>
		</tbody>
	</table>
</div>
<?
include 'includes/footer.php';
?>
<style type="text/css">
	#Design{width: 100px;height: 100px;}
</style>