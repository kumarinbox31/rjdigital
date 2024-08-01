<?
require_once 'includes/header.php';
if($_POST['status']=='insert')
{
    $con->query("INSERT INTO `message_to_center` (`id`, `timestamp`, `center_id`, `message`) VALUES (NULL, CURRENT_TIMESTAMP, '".$_GET['id']."', '".$_POST['message']."')");
    echo '<script>location.href="notification.php?id='.$_GET['id'].'"</script>';
}
$get = $con->query("SELECT * FROM centers where id = '".$_GET['id']."'")->fetch_assoc();
if($_GET['action']=='del')
{
    $con->query("DELETE FROM message_to_center where id = '".$_GET['message_id']."'");
   echo '<script>alert("Message deleted.");location.href="notification.php?id='.$_GET['id'].'"</script>';
}
?>
<div class="box box-warning">
    <div class="box-header"><h3>Send Message for (<?=ucwords($get['institute_name'])?>)</h3></div>
    <div class="box-body">
        <form action="" method="post">
            <div class="form-group">
                <label>Message</label>
                <textarea class="ckeditor" name="message"></textarea>
            </div>
            <div class="form-gruop">
                <button class="btn btn-warning" type="submit" name="status" value="insert"><i class="fa fa-paper-plane"></i> Send</button>
            </div>
        </form>
    </div>
    <div class="box-footer">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Message</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?
                    $mess = $con->query("SELECT * FROM message_to_center where center_id = '".$_GET['id']."' order by id desc");
                    while($m = $mess->fetch_assoc())
                    {
                        echo '<tr>
                                <td>'.date('d-M-y',strtotime($m['timestamp'])).'</td>
                                <td>'.$m['message'].'</td>
                                <td><a href="?message_id='.$m['id'].'&action=del&id='.$_GET['id'].'" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>
                        </tr>';
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?
include 'includes/footer.php';
?>