<?
include 'includes/header.php';
?>
<div class="row">
    <?
        $arr = ['get_form','get_gallery'];
        foreach($arr as $item){
    ?>
        <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-header">
                <strong><?=ucwords(str_replace('_',' ',$item));?></strong>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <div class="row">
                        <?
                            $pages = $con->query("SELECT * FROM `his_page`");
                            $page = 0;
                            while($p = $pages->fetch_assoc()){
                                $chk = $con->query("SELECT * FROM `web_schema` WHERE `page_id` = '".$p['id']."' AND `type` = '$item' ");
                                $checked = $chk->num_rows?'checked':'';
                        ?>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-check">
                                  <input class="form-check-input useItem" type="checkbox" value="<?=$p['id']?>" data-type="<?=$item?>" id="<?=$item.'_'.$page?>" <?=$checked?>>
                                  <label class="form-check-label" for="<?=$item.'_'.$page?>">
                                    <?=$p['page_name'];?>
                                  </label>
                                </div>
                            </div>
                        <?
                            $page++;}
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?
        }
    ?>
        
</div>
<?
include 'includes/footer.php';
?>
<script>
    $('.useItem').click(function(){
        var id = $(this).val();
        var type = $(this).data('type');
        $.ajax({
            url:'Ajax.php',
            type:'post',
            dataType:'json',
            data:{page_id:id,type:type,status:'useItems'},
            success:function(res){
                alert('Successfully Changed');
                // window.location.href="footer_settings.php";
            }
        });
        
    });
</script>