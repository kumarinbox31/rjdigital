<?require_once 'includes/header.php';
if($_POST['submit'] == 'add'){
        $file = files_upload('file','downloads');
        if($file['status']==1)
    	{
    		$con->query("INSERT INTO `student_files` ( `title`, `type` , `description` ,`file`) VALUES ('".$_POST['title']."','".$_POST['type']."','".$_POST['description']."', '".$file['file_name']."')");
    		echo '<script>alert("File Upload SuccessFully.");window.location.href='."'setting_footer_images.php'".'"</script>';
    	}
    	else
    	{
    		echo '<script>alert("Error in file Uploading.");window.location.href='."'setting_footer_images.php'".'"</script>';
    	}
    }
    if($_GET['action']=='del'){
        $id = $_GET['id'];
        $con->query("DELETE FROM `student_files` WHERE `id` = '".$id."' ");
    	echo '<script>alert("Deleted SuccessFully.");window.location.href='."'setting_footer_images.php'".'"</script>';
    }

?>

    <?
        $type = 'footer_brands';
    ?>
   <div class="col-md-12">
         <div class="box box-success">
    		<div class="box-header"><h3 class="text-green">Add Brands</h3></div>
    		<div class="box-body">
    			<form action="" method="POST" class="" enctype="multipart/form-data">
    				<input type="hidden" name="type" value="<?=$type?>">
    				<div class="form-group col-md-6">
    				    <label>Image</label>
    					<input type="file" name="file" class="form-control" placeholder="Enter Title">
    				</div>
    				<div class="form-group col-md-6">
    					<label>Title</label>
    					<input type="text" name="title" class="form-control" placeholder="Enter Title">
    				</div>
    				<div class="form-group col-md-6">
    					<label>Link</label>
    					<input type="text" name="description" class="form-control" placeholder="Enter Link">
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
    					    <th>Link</th>
    						<th>File</th>
    						<th>Remove</th>
    					</tr>
    				</thead>
    				<tbody>
    					<?
    					
    						$get = $con->query("SELECT * FROM student_files WHERE `type` = '$type' ");
    						while($m = $get->fetch_assoc())
    						{
    							echo '
    									<tr>
    									    <td>'.$m['title'].'</td>
    									    <td>'.$m['description'].'</td>
    										<td><img src="../uploads/downloads/'.$m['file'].'" style="width:100px;"></td>
    										<td><a href="?id='.$m['id'].'&action=del" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
    									</tr>
    							';
    						}
    					?>
    				</tbody>
    			</table>
    		</div>
    	</div>
      </div>
<?require_once 'includes/footer.php';?>
<script>
    $('.deleteRow').click(function(){
        var id = $(this).data('id');
        var table = $(this).data('table');
        $.ajax({
            url:'Ajax.php',
            type:'post',
            dataType:'json',
            data:{id:id,table:table,status:'deleteRow'},
            success:function(res){
                alert(res);
               window.location.reload();
            }
        });
        
    });
    $('.extra_setting').submit(function(e){
        
        e.preventDefault();
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }
        $.ajax({
            url:'Ajax.php',
            type:'post',
            dataType:'json',
            data:$(this).serialize(),
            success:function(res){
                alert(res);
            }
        });
        
    });
</script>