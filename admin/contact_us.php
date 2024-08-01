<?
require_once 'includes/header.php';
if($_POST['status']=='update')
{
    $con->query("UPDATE `contact_us` SET `registered_at` = '".$_POST['registered_at']."' WHERE `contact_us`.`id` = 1");
    echo '<script>alert("Content Update");location.href="contact_us.php"</script>';
}
$get = $con->query("SELECT * FROM contact_us where id = 1")->fetch_assoc();
?>
<div class="box box-success">
    <div class="box-header"><h3>Contact Us</h3></div>
    <div class="box-body">
        <form action="" method="post">
            <div class="form-group">
                <label>Content</label>
                <textarea class="ckeditor" name="registered_at"><?=$get['registered_at']?></textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-success" type="submit" name="status" value="update"><i class="fa fa-save"></i> Update</button>
            </div>
        </form>
    </div>
</div>
<?
include 'includes/footer.php';
?>