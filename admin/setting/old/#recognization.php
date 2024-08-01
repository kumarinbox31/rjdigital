    
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
                        <input type="text" name="recog_text" class="form-control" value="<?=isset($setting['recog_text'])?$setting['recog_text']:'Recognitions';?>">
                    </div>
                </div>
                <div class="box-footer">
                    <button class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </form>
    </div>
   
   <?
        $type = 'recog';
    ?>
   <div class="col-md-12">
         <div class="box box-success">
    		<div class="box-header"><h3 class="text-green">Add Recognization</h3></div>
    		<div class="box-body">
    			<form action="" method="POST" class="" enctype="multipart/form-data">
    				<input type="hidden" name="type" value="<?=$type?>">
    				<div class="form-group col-md-6">
    				    <label>Image</label>
    					<input type="file" name="file" class="form-control" placeholder="Enter Title">
    				</div>
    				<div class="form-group col-md-6">
    					<!--<label>Title</label>-->
    					<input type="hidden" name="title" class="form-control" placeholder="Enter Title">
    				</div>
    				<div class="form-group col-md-6">
    					<!--<label>Description</label>-->
    					<input type="hidden" name="description" class="form-control" placeholder="Enter Description">
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
    						<th>Image</th>
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

    										<td><img src="../uploads/downloads/'.$m['file'].'" style="width:100px;"></td>
    										<td><a href="?page='.$_GET['page'].'&id='.$m['id'].'&action=del" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
    									</tr>
    							';
    						}
    					?>
    				</tbody>
    			</table>
    		</div>
    	</div>
      </div>