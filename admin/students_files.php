<?
require_once 'includes/header.php';
if($_POST['submit'] == 'add'){
    $file = files_upload('file','downloads');
    if($file['status']==1)
	{
		$con->query("INSERT INTO `student_files` ( `title`, `type` , `description` ,`file`) VALUES ('".$_POST['title']."','".$_POST['type']."','".$_POST['description']."', '".$file['file_name']."')");
		echo '<script>alert("File Upload SuccessFully.");location.href="students_files.php"</script>';
	}
	else
	{
		echo '<script>alert("Error in file Uploading.");location.href="students_files.php"</script>';
	}
}
if($_GET['action']=='del'){
    $id = $_GET['id'];
    $con->query("DELETE FROM `student_files` WHERE `id` = '".$id."' ");
	echo '<script>alert("Deleted SuccessFully.");location.href="students_files.php"</script>';
}
?>
  
    <!-- Main content -->
    <section class="content">
    	<div class="box box-success">
    		<div class="box-header"><h3 class="text-green">Student Download Section</h3></div>
    		<div class="box-body">
    			<form action="" method="POST" class="" enctype="multipart/form-data">
    				<div class="form-group col-md-6">
    					<label>Type</label>
    					<select name="type" class="form-control">
    					    <?
    					        $arr = ['image','pdf','video'];
    					        foreach($arr as $val){
    					            echo '<option value="'.$val.'">'.ucwords($val).'</option>';
    					        }
    					    ?>
    					</select>
    				</div>
    				<div class="form-group col-md-6">
    					<label>Title</label>
    					<input type="text" name="title" class="form-control" placeholder="Enter Title">
    				</div>
    				<div class="form-group col-md-6">
    					<label>Description</label>
    					<textarea type="text" name="description" class="form-control" placeholder="Enter Description"></textarea>
    				</div>
    				<div class="form-group col-md-6">
    					<input type="file" name="file" class="form-control" placeholder="Enter Title">
    				</div>
    				<div class="form-group col-md-12">
    					<button class="btn btn-success" name="submit" value="add"  type="submit">Add</button>
    				</div>
    			</form>
    		</div>
    		<div class="box-footer">
    			<table class="table table-striped">
    				<thead>
    					<tr>
    						<th>Title</th>
    						<th>Type</th>
    						<th>Description</th>
    						<th>File</th>
    						<th>URL</th>
    						<th>Remove</th>
    					</tr>
    				</thead>
    				<tbody>
    					<?
    					
    						$get = $con->query("SELECT * FROM student_files");
    						while($m = $get->fetch_assoc())
    						{
    						    $arr = ['image','pdf','video'];
    						    if(in_array($m['type'],$arr)){
    							echo '
    									<tr>
    										<td>'.ucwords($m['title']).'</td>
    										<td>'.$m['type'].'</td>
    										<td>'.$m['description'].'</td>
    										<td><a href="../uploads/downloads/'.$m['file'].'" target="_blank" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a></td>
    										<td><button id="btn_'.$m['id'].'" class="btn btn-primary" onclick="myFunction('.$m['id'].')">Copy</button><input type="text" style="z-index:-7;position:absolute;opacity:1" name="image_text" value="http://localhost/service/uploads/downloads/'.$m['file'].'" id="myInput_'.$m['id'].'"></td>
    										<td><a href="?id='.$m['id'].'&action=del" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
    									</tr>
    							';
    						    }
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