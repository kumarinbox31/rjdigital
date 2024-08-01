    
    <div class="col-md-6">
        <form class="extra_setting" action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="status" value="extra_setting">
            <div class="box box-primary">
                <div class="box-header">
                    <strong>Setting</strong>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label>Student </label>
                        <input type="text" name="student_counter" class="form-control" value="<?=getSetting('student_counter',200);?>">
                    </div>
                    <div class="form-group">
                        <label>Center </label>
                        <input type="text" name="student_center" class="form-control" value="<?=getSetting('student_center',200);?>">
                    </div>
                </div>
                <div class="box-footer">
                    <button class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </form>
    </div>