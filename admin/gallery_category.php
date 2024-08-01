<?
require_once 'includes/header.php';
if($_POST['status']=='add')
{
    $chk = $con->query("SELECT * FROM gallery_category where category_name = '".$_POST['category_name']."'")->num_rows;
    if(!$chk)
        $con->query("INSERT INTO `gallery_category` (`id`, `timestamp`, `category_name`) VALUES (NULL, CURRENT_TIMESTAMP, '".$_POST['category_name']."')");
    else
        echo '<script>alert("Category Already Exists.");location.href="gallery_category.php"</script>';
    echo '<script>alert("Category successfully add.");location.href="gallery_category.php"</script>';
}
if($_GET['type']=='delete')
{
    $temp = $con->query("SELECT * FROM gallery where category_id = '".$_GET['id']."'");
    while($t = $temp->fetch_assoc()){
        if(file_exists("../uploads/gallery/".$t['image']))
            unlink("../uploads/gallery/".$t['image']);
    }
    $con->query("DELETE FROM gallery where category_id = '".$_GET['id']."'");
    $con->query("DELETE FROM gallery_category where id = '".$_GET['id']."'");
    echo '<script>alert("Category & Category Data are deleted.");location.href="gallery_category.php"</script>';
}
?>
<div class="col-md-6">
    <div class="box box-success">
        <div class="box-header"><h4>Add Gallery Category</h4></div>
        <div class="box-body">
            <form action="" method="post" class="form-inline">
                <div class="form-group">
                    <input type="text" class="form-control" name="category_name" placeholder="Enter Category Name" required>
                </div>
                <div class="form-group">
                    <button class="btn btn-success" type="submit" name="status" value="add">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="box box-info">
        <div class="box-header"><h4>List</h4></div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Category Name</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody id="sortable">
                        <?
                            $i=1;
                            $get = $con->query("SELECT * FROM gallery_category order by seq asc");
                            while($g = $get->fetch_assoc())
                            {
                                echo '<tr id="'.$g['id'].'">
                                        <td>'.$i++.'</td>
                                        <td>'.ucwords($g['category_name']).'</td>
                                        <td>
                                            <a onclick="return confirm(\'Delete Gallery Category And All sub gallery image. Are you sure?\')" href="?id='.$g['id'].'&type=delete" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                                        </td>
                                </tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<? require_once 'includes/footer.php'?>
<script>
$( "#sortable" ).sortable({
    opacity:0.9,
    update:function(event, ui){
        var order = $("#sortable").sortable("toArray");
        console.log(order);
        $.ajax({
            type:"POST",
            url:"Ajax.php",
            data:{status:"change_seq_of_sliders",order:order},
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