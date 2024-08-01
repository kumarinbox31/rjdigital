    
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
                        <input type="text" name="features_title" class="form-control" value="<?=isset($setting['features_title'])?$setting['features_title']:'';?>">
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
        $type= 'features';
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="<?=$type?>">
            <div class="box box-primary">
                <div class="box-header">
                    <strong>Add Features </strong>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <select class="form-control" name="label">
                                    <option value="primary">Primary</option>
                                    <option value="danger">Danger</option>
                                     <option value="warning">Warning</option>
                                      <option value="info">Info</option>
                                </select>
                            </div>
                            <div class="col-md-6 col-sm-6">
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
                    <strong>Features</strong>
                </div>
                <div class="box-body">
                    <table class="table table-borderless table-data3">
                        <thead>
                            <tr>
                                <th>Bg Color</th>
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
    
    
    
    