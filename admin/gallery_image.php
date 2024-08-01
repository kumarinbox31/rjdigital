<?
require_once 'includes/header.php';
if($_POST['status']=='insert')
{
    $chk = $con->query("SELECT * FROM gallery where title = '".$_POST['title']."' AND category_id = '".$_POST['category_id']."'");
    if(!($chk->num_rows))
    {
        $img = photo_upload('image','gallery');
      
        if($img['status']){
            $con->query("INSERT INTO `gallery` (`id`, `timestamp`, `title`, `image`, `category_id`) VALUES (NULL, CURRENT_TIMESTAMP, '".$_POST['title']."', '".$img['file_name']."', '".$_POST['category_id']."')");
            echo '<script>alert("Image upload success");location.href="gallery_image.php"</script>';
        }else{
            echo '<script>alert("Error in Image uploading...");location.href="gallery_image.php"</script>';
        }
    }
}
if($_GET['action']=='del')
{
    if(file_exists("../uploads/gallery/".$_GET['file']))
        unlink("../uploads/gallery/".$_GET['file']);
    $con->query("DELETE FROM gallery where id = '".$_GET['id']."'");
    echo '<script>alert("Image deleted.");location.href="gallery_image.php"</script>';
}
?>
<div class="col-md-4">
<div class="box box-success">
    <div class="box-header"><h3>Add Image</h3></div>
    <div class="box-body">
        <form action="" method="post" enctype="multipart/form-data" class="">
            <div class="form-group">
                <select class="form-control" name="category_id" required>
                    <option value="">--Select Category</option>
                    <?
                        $get = $con->query("SELECT * FROM gallery_category order by seq asc");
                        while($g = $get->fetch_assoc()){
                            echo '<option value="'.$g['id'].'">'.ucwords($g['category_name']).'</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
              
                <input type="text" class="form-control" name="title" placeholder="Enter Image Title" required>
            </div>
             <div class="form-group">
                <label>Image</label>
                <input type="file" class="form-control" name="image" placeholder="Selecr Image " required>
            </div>
             <div class="form-group">
                <button class="btn btn-success" type="submit" name="status" value="insert"><i class="fa fa-plus"></i> Add</button>
            </div>
        </form>
    </div>
</div>
</div>
<div class="col-md-8">
    <div class="box box-primary">
        <div class="box-header"><h4>List</h4></div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Delete</th>
                    
                </tr>
            </thead>
            <tbody id="sortable">
                <?
                    $i=1;
                    $get = $con->query("SELECT * FROM gallery order by seq asc");
                    while($g = $get->fetch_assoc())
                    {
                        echo '<tr id="'.$g['id'].'">
                                <td>'.$i++.'</td>
                                <td>'.$g['title'].'</td>
                                <td><a href="../uploads/gallery/'.$g['image'].'" target="_blank"> <img style="width:60px;height:60px;" src="../uploads/gallery/'.$g['image'].'"></a></td>
                                <td><a href="?id='.$g['id'].'&action=del&file='.$g['image'].'" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                        </tr>';
                    }
                ?>
            </tbody>
        </table>
            </div>
        </div>
    </div>
</div>
<?
include 'includes/footer.php';
?>
<script>
$( "#sortable" ).sortable({
    opacity:0.9,
    update:function(event, ui){
        var order = $("#sortable").sortable("toArray");
        console.log(order);
        $.ajax({
            type:"POST",
            url:"Ajax.php",
            data:{status:"change_seq_of_gallery",order:order},
            dataType:"json",
            success:function(res){
                console.log(res);
                alert(res.text);
            },
            error:function(r,f,g){
                 $.alert({
                            type:"red",
                            title:"Error",
                            icon:"fa fa-times-circle",
                            content:r.responseText,
                });
            }
        });
    }
}).disableSelection();
</script>