<?
    include 'includes/header.php';
    if(isset($_POST['type'])){
    extract($_POST);
        $con->query("INSERT INTO `links`(`type`, `label`, `link`) VALUES ('$type','$label','$link')");
        ?>
        <script>
            alert('Successfully saved');
            // window.location.reload();
        </script>
        <?
    
    }
?>
   
        <div class="col-md-4">
            <form class="extra_setting" action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="status" value="extra_setting">
                <div class="box box-primary">
                    <div class="box-header">
                        <strong>Main Slider Image</strong>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file"  name="main_slider_img" class="form-control" value="<?=isset($setting['main_slider_img'])?$setting['main_slider_img']:'';?>" required>
                            <img src="../uploads/files/<?=isset($setting['main_slider_img'])?$setting['main_slider_img']:'';?>" width="100px">
                        </div>
                    </div>
                    <div class="box-footer">
                        <button class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-4">
            <form class="extra_setting" action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="status" value="extra_setting">
                <div class="box box-primary">
                    <div class="box-header">
                        <strong>Main Slider Bg Image</strong>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file"  name="main_slider_bg" class="form-control" value="<?=isset($setting['main_slider_bg'])?$setting['main_slider_bg']:'';?>" required>
                            <img src="../uploads/files/<?=isset($setting['main_slider_bg'])?$setting['main_slider_bg']:'';?>" width="100px">
                        </div>
                    </div>
                    <div class="box-footer">
                        <button class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                    </div>
                </div>
            </form>
        </div>
        

<?
    include 'includes/footer.php';
?>