<?
include 'includes/header.php';

if(isset($_POST['type'])){
    extract($_POST);
        $con->query("INSERT INTO `links`(`type`, `label`, `link`) VALUES ('$type','$label','$link')");
        $actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
        ?>
        <script>
            alert('Successfully saved');
        </script>
        <?
    
    }
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Assuming you have a database connection
    // require_once 'db_connection.php';

    $primaryHeading = $_POST['primary_heading'];
    $secondaryHeading = $_POST['secondary_heading'];
    $mainHeading = $_POST['main_heading'];
    $description = $_POST['description'];

    // Insert data into the database
  $updateQuery = "UPDATE footer_about_us 
                SET primary_heading = '$primaryHeading', 
                    secondary_heading = '$secondaryHeading', 
                    main_heading = '$mainHeading', 
                    description = '$description'
                WHERE id = 1";

// Execute the update query
// $con->query($updateQuery);


    if ($con->query($updateQuery)) {
        echo '<script>alert("Data Successfully Saved!");</script>';
    } else {
        echo '<script>alert("Error: ' . $con->error . '");</script>';
    }

    // Close the database connection
    // $con->close();
}
?>

<div class="row">
    <!--<div class="col-md-6">-->
    <!--        < ?-->
    <!--        $type= 'usefull_links';-->
    <!--        ?>-->
    <!--        <form action="" method="POST" enctype="multipart/form-data">-->
    <!--            <input type="hidden" name="type" value="< ?=$type?>">-->
    <!--            <div class="box box-primary">-->
    <!--                <div class="box-header">-->
    <!--                    <strong>Usefull Links</strong>-->
    <!--                </div>-->
    <!--                <div class="box-body">-->
    <!--                    <div class="form-group">-->
    <!--                        <div class="row">-->
    <!--                            <div class="col-md-6 col-sm-6">-->
    <!--                                <input type="text" name="label" class="form-control" placeholder="Label">-->
    <!--                            </div>-->
    <!--                            <div class="col-md-6 col-sm-6">-->
    <!--                                <input type="text" name="link" class="form-control" placeholder="Link">-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--                <div class="box-footer">-->
    <!--                    <button class="btn btn-success"><i class="fa fa-save"></i> Save</button>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </form>-->
            
    <!--    </div>-->

    <!--    <div class="col-md-6">-->
    <!--            <div class="box box-primary">-->
    <!--                <div class="box-header">-->
    <!--                    <strong>Usefull Links</strong>-->
    <!--                </div>-->
    <!--                <div class="box-body">-->
    <!--                    <table class="table table-borderless table-data3">-->
    <!--                        <thead>-->
    <!--                            <tr>-->
    <!--                                <th>Label</th>-->
    <!--                                <th>Link</th>-->
    <!--                                <th>Action</th>-->
    <!--                            </tr>-->
    <!--                        </thead>-->
    <!--                        <tbody>-->
    <!--                        < ?-->
    <!--                        $get = $con->query("SELECT * FROM `links` WHERE `type` = '$type'");-->
    <!--                        if($get->num_rows){-->
    <!--                            while($row = $get->fetch_assoc()){-->
    <!--                                echo '<tr>-->
    <!--                                        <td>'.$row['label'].'</td>-->
    <!--                                        <td>'.$row['link'].'</td>-->
    <!--                                        <td>-->
    <!--                                            <a class="btn btn-danger deleteRow" data-id="'.$row['id'].'" data-table="links" ><i class="fa fa-trash"></i></a>-->
    <!--                                        </td>-->
    <!--                                    </tr>-->
    <!--                                ';-->
    <!--                            }-->
    <!--                        }-->
    <!--                        ?>-->
    <!--                        </tbody>-->
    <!--                    </table>-->
                        
    <!--                </div>-->
    <!--            </div>-->
    <!--    </div>-->
    <div class="col-md-6">
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="box box-primary">
            <div class="box-header">
                <strong>Footer About us</strong>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <label for="primary_heading">Primary Heading</label>
                            <input type="text" name="primary_heading" class="form-control" placeholder="Enter Primary Heading" required>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <label for="secondary_heading">Secondary Heading</label>
                            <input type="text" name="secondary_heading" class="form-control" placeholder="Enter Secondary Heading" required>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <label for="main_heading">Read More</label>
                            <input type="text" name="main_heading" class="form-control" placeholder="Enter Link" required>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" placeholder="Enter Description" rows="4" required></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>
    </form>
</div>

    <div class="col-md-6">
            <?
            $type= 'legal_links';
            ?>
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="type" value="<?=$type?>">
                <div class="box box-primary">
                    <div class="box-header">
                        <strong>Quick Links</strong>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <input type="text" name="label" class="form-control" placeholder="Label">
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <input type="text" name="link" class="form-control" placeholder="Link">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                    </div>
                </div>
            </form>
            
        </div>

        <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header">
                        <strong>Quick Links</strong>
                    </div>
                    <div class="box-body">
                        <table class="table table-borderless table-data3">
                            <thead>
                                <tr>
                                    <th>Label</th>
                                    <th>Link</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?
                            $get = $con->query("SELECT * FROM `links` WHERE `type` = '$type'");
                            if($get->num_rows){
                                while($row = $get->fetch_assoc()){
                                    echo '<tr>
                                            <td>'.$row['label'].'</td>
                                            <td>'.$row['link'].'</td>
                                            <td>
                                                <a class="btn btn-danger deleteRow" data-id="'.$row['id'].'" data-table="links" ><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    ';
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                        
                    </div>
                </div>
        </div>
        
        
        
        
        <!--<div class="col-md-6">-->
        <!--    <form class="extra_setting" action="" method="POST" enctype="multipart/form-data">-->
        <!--        <input type="hidden" name="status" value="extra_setting">-->
        <!--        <div class="box box-primary">-->
        <!--            <div class="box-header">-->
        <!--                <strong>Social Links</strong>-->
        <!--            </div>-->
        <!--            <div class="box-body">-->
        <!--                <div class="form-group">-->
        <!--                    <label>Facebook</label>-->
        <!--                    <input type="text" name="footer_facebook" class="form-control" value="<?=isset($setting['footer_facebook'])?$setting['footer_facebook']:'';?>">-->
        <!--                </div>-->
        <!--                 <div class="form-group">-->
        <!--                    <label>Twitter</label>-->
        <!--                    <input type="text" name="footer_twitter"class="form-control" value="<?=isset($setting['footer_twitter'])?$setting['footer_twitter']:'';?>">-->
        <!--                </div>-->
        <!--                 <div class="form-group">-->
        <!--                    <label>Youtube</label>-->
        <!--                    <input type="text" name="footer_youtube" class="form-control" value="<?=isset($setting['footer_youtube'])?$setting['footer_youtube']:'';?>">-->
        <!--                </div>-->
        <!--            </div>-->
        <!--            <div class="box-footer">-->
        <!--                <button class="btn btn-success"><i class="fa fa-save"></i> Save</button>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </form>-->
            
        <!--</div>-->
        <!--<div class="col-md-6">-->
        <!--    <form class="extra_setting" action="" method="POST" enctype="multipart/form-data">-->
        <!--        <input type="hidden" name="status" value="extra_setting">-->
        <!--        <div class="box box-primary">-->
        <!--            <div class="box-header">-->
        <!--                <strong>Contact Details</strong>-->
        <!--            </div>-->
        <!--            <div class="box-body">-->
        <!--                <div class="form-group">-->
        <!--                    <label>Telephone</label>-->
        <!--                    <input type="text" name="footer_telephone" class="form-control" value="<?=isset($setting['footer_telephone'])?$setting['footer_telephone']:'';?>">-->
        <!--                </div>-->
        <!--                 <div class="form-group">-->
        <!--                    <label>Address</label>-->
        <!--                    <input type="text" name="footer_address" class="form-control" value="<?=isset($setting['footer_address'])?$setting['footer_address']:'';?>">-->
        <!--                </div>-->
        <!--                <div class="form-group">-->
        <!--                    <label>Email</label>-->
        <!--                    <input type="text" name="footer_email" class="form-control" value="<?=isset($setting['footer_email'])?$setting['footer_email']:'';?>">-->
        <!--                </div>-->
        <!--                <div class="form-group">-->
        <!--                    <label>Button Link</label>-->
        <!--                    <input type="text" name="footer_btn_link" class="form-control" value="<?=isset($setting['footer_btn_link'])?$setting['footer_email']:'';?>">-->
        <!--                </div>-->
        <!--            </div>-->
        <!--            <div class="box-footer">-->
        <!--                <button class="btn btn-success"><i class="fa fa-save"></i> Save</button>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </form>-->
            
        <!--</div>-->
        <!--<div class="col-md-6">-->
        <!--    <form class="extra_setting" action="" method="POST" enctype="multipart/form-data">-->
        <!--        <input type="hidden" name="status" value="extra_setting">-->
        <!--        <div class="box box-primary">-->
        <!--            <div class="box-header">-->
        <!--                <strong>Copyright</strong>-->
        <!--            </div>-->
        <!--            <div class="box-body">-->
        <!--                <div class="form-group">-->
        <!--                    <label>Content</label>-->
        <!--                    <textarea  name="footer_copyright" class="form-control ckeditor"><?=isset($setting['footer_copyright'])?$setting['footer_copyright']:'<b>&copy; :: 2021 - SEDM Pvt Ltd</b> | <a class="text-white" href="https://www.nxrtech.com/" target="_blank"><b>Powered by : NXR Technologies</b>';?></textarea>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--            <div class="box-footer">-->
        <!--                <button class="btn btn-success"><i class="fa fa-save"></i> Save</button>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </form>-->
            
        <!--</div>-->
        <!--<div class="col-md-6">-->
        <!--    <form class="extra_setting" action="" method="POST" enctype="multipart/form-data">-->
        <!--        <input type="hidden" name="status" value="extra_setting">-->
        <!--        <div class="box box-primary">-->
        <!--            <div class="box-header">-->
        <!--                <strong>Important Links</strong>-->
        <!--            </div>-->
        <!--            <div class="box-body">-->
        <!--                <div class="form-group">-->
        <!--                    <label>Disclaimer</label>-->
        <!--                    <input type="text" name="footer_disclaimer" class="form-control" value="<?=isset($setting['footer_disclaimer'])?$setting['footer_disclaimer']:'';?>">-->
        <!--                </div>-->
        <!--                 <div class="form-group">-->
        <!--                    <label>Privacy Policy</label>-->
        <!--                    <input type="text" name="footer_privacy_policy" class="form-control" value="<?=isset($setting['footer_privacy_policy'])?$setting['footer_privacy_policy']:'';?>">-->
        <!--                </div>-->
        <!--                <div class="form-group">-->
        <!--                    <label>Contact</label>-->
        <!--                    <input type="text" name="footer_contact" class="form-control" value="<?=isset($setting['footer_contact'])?$setting['footer_contact']:'';?>">-->
        <!--                </div>-->
        <!--            </div>-->
        <!--            <div class="box-footer">-->
        <!--                <button class="btn btn-success"><i class="fa fa-save"></i> Save</button>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </form>-->
            
        <!--</div>-->
        
</div>
<?
include 'includes/footer.php';
?>
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
                window.location.href="setting_footer.php";
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
                window.location.href="setting_footer.php";
            }
        });
        
    });
</script>