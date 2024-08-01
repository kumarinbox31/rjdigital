    
    <div class="col-md-6">
        <form class="extra_setting" action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="status" value="extra_setting">
            <div class="box box-primary">
                <div class="box-header">
                    <input type="text" name="director_msg_title" class="myInput" value="<?=getSetting('director_msg_title','From the Desk of Directors......')?>">
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label>Content</label>
                        <textarea name="director_msg_content" class="form-control ckeditor"><?=getSetting('director_msg_content')?></textarea>
                    </div>
                </div>
                <div class="box-footer">
                    <button class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </form>
    </div>
   <div class="col-md-6">
        <form class="extra_setting" action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="status" value="extra_setting">
            <div class="box box-primary">
                <div class="box-header">
                    <input type="text" name="why_msg_title" class="myInput" value="<?=getSetting('why_msg_title','Why Arcade ?.')?>">
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label>Content</label>
                        <textarea name="why_msg_content" class="form-control ckeditor"><?=getSetting('why_msg_content')?></textarea>
                    </div>
                </div>
                <div class="box-footer">
                    <button class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </form>
    </div>
   
   
   <div class="col-md-6">
        <?
        $type= 'news';
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="<?=$type?>">
            <div class="box box-primary">
                <div class="box-header">
                    <strong>Add News </strong>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <div class="row">
                            <!--<div class="col-md-6 col-sm-6">-->
                                <input type="hidden" name="label" >
                            <!--</div>-->
                            <div class="col-md-12 col-sm-12">
                                <input type="text" name="link" class="form-control" placeholder="Enter Text">
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
                    <strong>News</strong>
                </div>
                <div class="box-body">
                    <table class="table table-borderless table-data3">
                        <thead>
                            <tr>
                                <th>Text</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?
                        $get = $con->query("SELECT * FROM `links` WHERE `type` = '$type'");
                        if($get->num_rows){
                            while($row = $get->fetch_assoc()){
                                echo '<tr>
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
    
    
    