    
    <div class="col-md-6">
        <form class="extra_setting" action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="status" value="extra_setting">
            <div class="box box-primary">
                <div class="box-header">
                    <strong>Extra Setting</strong>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" name="newslatter_phone" class="form-control" value="<?=isset($setting['newslatter_phone'])?$setting['newslatter_phone']:'';?>">
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="newslater_email" class="form-control" value="<?=isset($setting['newslater_email'])?$setting['newslater_email']:'';?>">
                    </div>
                </div>
                <div class="box-footer">
                    <button class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </form>
    </div>
    
   