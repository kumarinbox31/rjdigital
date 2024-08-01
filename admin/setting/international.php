    
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
                        <input type="text" name="international_title" class="form-control" value="<?=isset($setting['international_title'])?$setting['international_title']:'International Cooperation';?>">
                    </div>
                    <div class="form-group">
                        <label>View all link</label>
                        <input type="text" name="international_view_link" class="form-control" value="<?=isset($setting['international_view_link'])?$setting['international_view_link']:'';?>">
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
        $type= 'international_links';
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="<?=$type?>">
            <div class="box box-primary">
                <div class="box-header">
                    <strong>Add international Item </strong>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <label>Title</label>
                                <input name="label" class="form-control" placeholder="Enter Label">
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <label>Link</label>
                                <input type="text" name="link" class="form-control" placeholder="Enter Link">
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
    <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <strong>international Items</strong>
                </div>
                <div class="box-body">
                    <table class="table table-borderless table-data3">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Link</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?
                        $get = $con->query("SELECT * FROM `links` WHERE `type` = '$type'");
                        if($get->num_rows){
                            while($row = $get->fetch_assoc()){
                                echo '<tr id="row_'.$row['id'].'">
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
    