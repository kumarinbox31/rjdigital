<?
require_once 'includes/header.php';
?>

    
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>150</h3>

              <p>New Orders</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>53<sup style="font-size: 20px">%</sup></h3>

              <p>Bounce Rate</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>44</h3>

              <p>User Registrations</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>65</h3>

              <p>Unique Visitors</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <div class="col-md-6">
            <?
            if(isset($_FILES['gpay']['name']) || isset($_POST['gmap'])){
                if(!empty($_FILES['gpay']['name'])){
                    $file = photo_upload('gpay','setting')['file_name'];
                    $con->query("UPDATE `setting` SET `value` = '".$file."' WHERE `setting`.`id` = 1");
                }
                $con->query("UPDATE `setting` SET `value` = '".$_POST['gmap']."' WHERE `setting`.`id` = 3");
                header('location:index.php');
            }
            ?>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="box box-primary">
                    <div class="box-header">
                        <strong>Google Details</strong>
                    </div>
                    <div class="box-body">
                        
                        <div class="form-group">
                            <label>Select Gpay Image </label>
                            <input type="file" name="gpay" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label>View Gpay Image</label>
                            <?
                            //$gpay = $con->query("SELECT value FROM setting WHERE type = 'gpay' ")->fetch_assoc();
                            echo '<img src="../uploads/setting/'.$setting['gpay'].'" style="width:100%;height:200px">';
                            ?>
                        </div>
                        
                        <div class="form-group">
                            <label>Enter Google Map Url</label>
                            <input type="url" name="gmap" value="<?=$setting['gmap']?>" class="form-control" placeholder="Enter Google Map..">
                        </div>                        
                        <div class="box-footer">
                        <button class="btn btn-success"><i class="fa fa-save"></i> Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
        <div class="col-md-6">
            <?
            if(isset($_POST['type'])){
                $con->query("UPDATE `setting` SET `value` = '".$_POST['value']."' WHERE `setting`.`type` = '".$_POST['type']."' ");
                redirect();
            }
            ?>
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="type" value="why_join">
                <div class="box box-primary">
                    <div class="box-header">
                        <strong>Why Join</strong>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label>Content</label>
                            <textarea name="value" class="form-control ckeditor" required><?=$setting['why_join']?></textarea>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button class="btn btn-success"><i class="fa fa-save"></i> Update</button>
                    </div>
                </div>
            </form>
            
        </div>
        <div class="col-md-6">
            <?
            if(isset($_POST['type'])){
                $con->query("UPDATE `setting` SET `value` = '".$_POST['value']."' WHERE `setting`.`type` = '".$_POST['type']."' ");
                redirect();
            }
            ?>
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="type" value="home_page_gallery">
                <div class="box box-primary">
                    <div class="box-header">
                        <strong>Home Page Gallery</strong>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label>Galleries</label>
                            <select name="value" class="form-control" required>
                                <?
                                 $get = $con->query("SELECT * FROM gallery_category order by seq asc");
                                    while($g = $get->fetch_assoc()){
                                        $selected = $setting['home_page_gallery']==$g['id']?'selected':'';
                                        echo '<option value="'.$g['id'].'" '.$selected.'>'.ucwords($g['category_name']).'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button class="btn btn-success"><i class="fa fa-save"></i> Update</button>
                    </div>
                </div>
            </form>
            
        </div>
        <div class="col-md-12">
            <?
            /*
            if(isset($_FILES['gpay']['name'])){
                $file = photo_upload('gpay','setting')['file_name'];
                $con->query("UPDATE `setting` SET `value` = '".$file."' WHERE `setting`.`id` = 1");
                header('location:index.php');
            }*/
            if(isset($_POST['service'])){
                $con->query(" INSERT INTO `services` (`id`, `type`, `title`, `content`) VALUES (NULL, 'service', '".$_POST['title']."', '".$_POST['value']."') ");
                redirect();
            }
            ?>
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="service" value="service">
                <div class="box box-primary">
                    <div class="box-header">
                        <strong>Slide Content</strong>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label>Content</label>
                            <input name="title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Content</label>
                            <textarea name="value" class="form-control ckeditor" required>
                                <div class="row">

                                  <div class='text-center'>
                
                                    <h2>Become a Franchisee <br> for India's Fastest Growing Sector</h2>
                
                                  </div>
                
                                </div>            
                
                                <div class="row">
                
                                  <ul>
                
                                    <li><i class="icon-check"></i> Start NIRMAN Franchisee in your city</li>
                
                                    <li><i class="icon-check"></i> Small Investment</li>
                
                                    <li><i class="icon-check"></i> Existing or Minimum Infrastructure</li>
                
                                   </ul>
                
                                 </div> 
                            </textarea>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button class="btn btn-success"><i class="fa fa-save"></i> Update</button>
                    </div>
                </div>
            </form>
            
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>title</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?
                    if(isset($_GET['status'])){
                        
                        if($_GET['status'] == 'service_delete'){
                            
                            $con->query("DELETE FROM `services` WHERE `services`.`id` = '".$_GET['id']."' ");
                            redirect();
                        }
                        
                    }
                    
                    $service = $con->query("SELECT * FROM services WHERE type = 'service'");
                    $i = 1;
                    while($r = $service->fetch_assoc()){
                        echo '<tr>
                                
                                <td>'.$i++.'.</td>
                                <td>'.$r['title'].'</td>
                                <td><a href="?status=service_delete&id='.$r['id'].'" class="btn btn-success btn-xs btn-sm"><i class="fa fa-trash"></i></a></td>
                              </tr>';
                    }
                    ?>
                </tbody>
            </table>
            
        </div>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->
<?
include 'includes/footer.php';
?>