<?
require_once 'includes/header.php';
if($_POST['status']=='update')
{
    $con->query("UPDATE `payment_system` SET `certificate` = '".$_POST['certificate']."',`marksheet` = '".$_POST['marksheet']."',`online` = '".$_POST['online']."',`secret_key` = '".$_POST['secret_key']."', `salt_key` = '".$_POST['salt_key']."', `set_amount1` = '".$_POST['set_amount1']."', `set_amount2` = '".$_POST['set_amount2']."' WHERE `payment_system`.`id` = 1");
    echo '<script>alert("Details Update Success");location.href="payment_system.php"</script>';
}
$get = $con->query("SELECT * FROM payment_system where id = 1")->fetch_assoc();

?>
<div class="box box-success">
    <div class="box-header"><h3>Payment Settings(RazorPay)</h3></div>
    <div class="box-body">
        <form action="" method="post">
            <div class="form-group col-md-6">
                <label>API Key</label>
                <input type="text" class="form-control" name="secret_key" value="<?=$get['secret_key']?>">
            </div>
             <div class="form-group col-md-6">
                <label>AUTH TOKEN</label>
                <input type="text" class="form-control" name="salt_key" value="<?=$get['salt_key']?>">
            </div>
            <div class="form-group col-md-6">
                <label>Set Amout for Center</label>
                <input type="text" class="form-control" name="set_amount1" value="<?=$get['set_amount1']?>">
            </div>
             <div class="form-group col-md-6">
                <label>Set Amout for Student</label>
                <input type="text" class="form-control" name="set_amount2" value="<?=$get['set_amount2']?>">
            </div>
            <div class="form-group col-md-6">
                <label>Certificate</label>
                <input type="text" class="form-control" name="certificate" value="<?=$get['certificate']?>">
            </div>
             <div class="form-group col-md-6">
                <label>Result</label>
                <input type="text" class="form-control" name="marksheet" value="<?=$get['marksheet']?>">
            </div>
            <div class="form-group col-md-6">
                <label>Accept Payment Online</label>
                <select name="online" class="form-control">
                    <option value="1" <?=$get['online']?'selected':'';?>>Yes</option>
                    <option value="0" <?=$get['online']?'':'selected';?>>No</option>
                </select>
            </div>
            <div class="form-group col-md-12">
                <button class="btn btn-success" type="submit" name="status" value="update"><i class="fa fa-save"></i> Update</button>
            </div>
        </form>
    </div>
</div>
<?
include 'includes/footer.php';
?>