   <?
    if($_POST['status'] == 'Upload')
    {
    	$logo = photo_upload('logo','logo');
    	if($logo['status']==1)
    	{
    		
    		
    		$con->query("UPDATE `logo_setting` SET `take_test` = '".$logo['file_name']."' WHERE `logo_setting`.`id` = 1");
    		echo '<script>alert("Logo Updated.");"</script>';
    	}
    }
   ?> 
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
                        <input type="text" name="test_title" class="form-control" value="<?=isset($setting['test_title'])?$setting['test_title']:'Take FREE tests to revise your memory, or to prepare for an interview';?>">
                    </div>
                    <div class="form-group">
                        <label>Button Title</label>
                        <input type="text" name="test_btn_title" class="form-control" value="<?=isset($setting['test_btn_title'])?$setting['test_btn_title']:'Take Free Test';?>">
                    </div>
                    <div class="form-group">
                        <label>Button LInk</label>
                        <input type="text" name="test_btn_link" class="form-control" value="<?=isset($setting['test_btn_link'])?$setting['test_btn_link']:'#';?>">
                    </div>
                </div>
                <div class="box-footer">
                    <button class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-6">
        <div class="box box-danger">
	<div class="box-header"><h3>Image Setting</h3></div>
	<div class="box-body">
		<form accept="" method="post" enctype="multipart/form-data">
			<input type="hidden" name="status" value="Upload">
			<div class="form-group col-md-12">
				<label>Image</label>
				<input type="file" class="form-control" name="logo">
			</div>
			<div class="form-group col-md-12">
				<button class="btn btn-danger" type="submit">Upload</button>
			</div>
		</form>
	</div>
	<div class="box-footer">
		<? $logo = $con->query("SELECT  * FROM logo_setting where id = 1")->fetch_assoc(); ?>
		<img src="../uploads/logo/<?=$logo['take_test']?>" style="width:100%;">
	</div>
</div>
    </div>