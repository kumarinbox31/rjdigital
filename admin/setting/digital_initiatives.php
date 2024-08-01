    
    <div class="col-md-6">
        <form class="extra_setting" action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="status" value="extra_setting">
            <div class="box box-primary">
                <div class="box-header">
                    <strong>Extra Setting</strong>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="digital_initiatives_title" class="form-control" value="<?=isset($setting['digital_initiatives_title'])?$setting['digital_initiatives_title']:'Digital Initiatives';?>">
                    </div>
                </div>
                <div class="box-footer">
                    <button class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </form>
        
    </div>
<?
    $type = 'digital_initiatives';
?>
<div class="col-md-12">
         <div class="box box-success">
    		<div class="box-header"><h3 class="text-green">Add Digital Initiatives</h3></div>
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