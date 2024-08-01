<?
require_once 'includes/header.php';
if($_POST['status'] == 'edit_page')
{
	$con->query("UPDATE `his_page` SET `redirect` = '".$_POST['redirect']."',`link` = '".$_POST['link']."',`page_name` = '".$_POST['page_name']."', `content` = '".$_POST['content']."' WHERE `his_page`.`id` = '".$_GET['page_id']."'");
	echo '<script>alert("page Updated.");location.href="list_page.php"</script>';
}

if($_POST['status'] == 'header_page')
{
    $image = photo_upload('page_header','pages');
    if($image['status'])
    {
        $con->query("UPDATE `his_page` SET `page_header` = '".$image['file_name']."' WHERE `his_page`.`id` = '".$_GET['page_id']."'");
        echo '<script>alert("Page Header Updated.");location.href="list_page.php"</script>';
    }
    else
    {
        echo '<script>alert("Error in image upload.");location.href="list_page.php"</script>';
    }
    
}
$get = $con->query("SELECT * FROM his_page where id = '".$_GET['page_id']."'")->fetch_assoc();
?>
 
    <!-- Main content -->
    <section class="content">

                                <div class="box box-success">
                                    <div class="box-header"> <h3 class="text-center title-2">Edit Page</h3></div>
                                    <div class="box-body">
                                       
                                        <form action="" method="post" novalidate="novalidate" class="AddPage">
                                        	<input type="hidden" name="status" value="edit_page">
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Page Name</label>
                                                <input name="page_name" type="text" class="form-control" placeholder="Enter Page Name" required="" value="<?=$get['page_name']?>">
                                            </div>
                                             <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="cc-payment" class="control-label mb-1">Link</label>
                                                    <input name="link" type="text" class="form-control" placeholder="Enter Link" required="" value="<?=$get['link']?>">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="cc-payment" class="control-label mb-1">Redirect</label>
                                                    <div class="form-check">
                                                        <input type="radio" name="redirect" value="1" id="yes" <?=$get['redirect']?'checked':'';?>> <label for="yes">Yes</label>
                                                        <input type="radio" name="redirect" value="0" id="no" <?=$get['redirect']?'':'checked';?>> <label for="no">No</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group has-success">
                                                <label for="cc-name" class="control-label mb-1">Page Content</label>
                                                <textarea  class="form-control ckeditor " name="content" placeholder="Enter Page Content"><?=$get['content']?></textarea>
                                               
                                            </div>
                                            
                                                <button type="submit" class="btn btn-success">
                                                    Update
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                
                           
                           <div class="box box-primary">
    <div class="box-header"><h3>Page Header</h3></div>
    <div class="box-body">
        <form action="" method="post" enctype="multipart/form-data" id="headerForm">
            <input type="hidden" name="status" value="header_page">
            <div class="form-group">
                <label>Image</label>
                <input type="file" name="page_header" class="form-control" id="headerImageInput" onchange="previewImage()">
                <img style="width:300px;height:120px" src="../uploads/pages/<?=$get['page_header']?>" id="headerImagePreview">
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">Update</button>
            </div>
        </form>
    </div>
</div>


</div></div>
<script>
    function previewImage() {
        var input = document.getElementById('headerImageInput');
        var preview = document.getElementById('headerImagePreview');
        
        var reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
        };
        
        reader.readAsDataURL(input.files[0]);
    }
</script>
<?
include 'includes/footer.php';
?>