    
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
                        <input type="text" name="helpline_no_title" class="form-control" value="<?=isset($setting['helpline_no_title'])?$setting['helpline_no_title']:'Helpline Numbers @ UGC';?>">
                    </div>
                    <div class="form-group">
                        <label>Read More Link</label>
                        <input type="text" name="helpline_readmore_link" class="form-control" value="<?=isset($setting['helpline_readmore_link'])?$setting['helpline_readmore_link']:'';?>">
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
        $type= 'helpline_nos';
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="<?=$type?>">
            <div class="box box-primary">
                <div class="box-header">
                    <strong>Add Helpline Number </strong>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <label>First Line</label>
                                <input name="label" class="form-control" value="Covid -19 Helpline: 1800-111-657">
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <label>Second Line</label>
                                <input type="text" name="link" class="form-control" placeholder="Enter Text" value="Email: covid19help.ugc@gov.in">
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
                    <strong>Helpline Numbers</strong>
                </div>
                <div class="box-body">
                    <table class="table table-borderless table-data3">
                        <thead>
                            <tr>
                                <th>First line</th>
                                <th>Second Line</th>
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
    