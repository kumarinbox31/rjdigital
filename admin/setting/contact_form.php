    
    <div class="col-md-12">
        <form class="extra_setting" action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="status" value="extra_setting">
            <div class="box box-primary">
                <div class="box-header">
                    <strong>Contact Details</strong>
                </div>
                <div class="box-body row">
                    <div class="form-group col-md-6">
                        <label>Address</label>
                        <textarea name="contact_address" class="form-control " ><?=getSetting('contact_address');?></textarea>
                    </div>
            
                     <div class="form-group col-md-6">
                        <label>Mobile</label>
                        <textarea name="contact_mobile" class="form-control" ><?=getSetting("contact_mobile");?></textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Email</label>
                        <textarea name="contact_email" class="form-control" ><?=getSetting('contact_email');?></textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Map</label>
                        <textarea name="contact_map" class="form-control" ><?=getSetting('contact_map');?></textarea>
                    </div>
                </div>
                <div class="box-footer">
                    <button class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </form>
    </div>
    
        <?
        $type = 'contact_tabs';
    ?>
   <div class="col-md-12">
         <div class="box box-success">
    		<div class="box-header"><h3 class="text-green">Add Contacts</h3></div>
    		<div class="box-body">
    			<form action="" method="POST" class="" enctype="multipart/form-data">
    				<input type="hidden" name="type" value="<?=$type?>">
    				<!--<div class="form-group col-md-6">-->
    				    <!--<label>Image</label>-->
    					<!--<input type="file" name="file" class="form-control" placeholder="Enter Title">-->
    				<!--</div>-->
    				<div class="form-group col-md-6">
    					<label>Title</label>
    					<input type="text" name="title" class="form-control" placeholder="Enter Title">
    				</div>
    				<div class="form-group col-md-6">
    					<label>Description</label>
    					<textarea type="text" name="description" class="form-control ckeditor" placeholder="Enter Description"></textarea>
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