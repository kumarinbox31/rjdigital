<?
require_once 'includes/header.php';

?>

   
               
<div class="container-fluid">
    <div class="container p_20">
        <h1 class="text_heading text-center">Our <span class="highlight_color">Gallery</span></h1>
        <div class="row pt_50">
            <?php
            $cat = $con->query("SELECT * FROM gallery_category order by seq asc");
            while ($c = $cat->fetch_assoc()) {
                 $get = $con->query("SELECT * FROM gallery where category_id = '".$c['id']."' order by id desc");
                    while ($g = $get->fetch_assoc()) {
            ?>
                <div class="col-md-4 col-sm-6 co-xs-12 gal-item">
                    <!--<h1 style="margin: 5px; font-size: 30px; border-bottom: 3px solid #2a1570"><b>< ?= ucwords($c['category_name']) ?></b></h1>-->
                   
                        <div class="box">
                            <a href="#" data-toggle="modal" data-target="#<?=$g['id']?>" title="Gallery">
                                <img src="uploads/gallery/<?=$g['image']?>" class="img-fluid">
                            </a>
                            <div class="modal fade" id="<?=$g['id']?>" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                        <div class="modal-body">
                                            <img src="uploads/gallery/<?=$g['image']?>" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                </div>
            <?php
            }
            }
            ?>
        </div>
    </div>
</div>



<?
include 'includes/footer.php';
?>