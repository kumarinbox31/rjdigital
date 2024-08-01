<?
require_once 'includes/header.php';
if($_POST['status'] == 'edit_page')
{
	$con->query("UPDATE `page_content` SET `page_name` = '".$_POST['page_name']."', `content` = '".$_POST['content']."' WHERE `page_content`.`id` = '".$_GET['page_id']."'");
	echo '<script>alert("page Updated.");location.href="list_page.php"</script>';
}


$get = $con->query("SELECT * FROM page_content where id = '".$_GET['page_id']."'")->fetch_assoc();
?>
 <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

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
                                
                           
                            </div></div>
<?
include 'includes/footer.php';
?>