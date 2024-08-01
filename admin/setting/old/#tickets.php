    <?
        $type = 'tickets';
    ?>
   <div class="col-md-12">
         <div class="box box-success">
    		<div class="box-header"><h3 class="text-green">Add Ticket</h3></div>
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
    					<label>Description</label>
    					<textarea type="text" name="description" class="form-control" placeholder="Enter Description"></textarea>
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
    						<th>Description</th>
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
    										<td>'.ucwords($m['title']).'</td>
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