<?
require_once 'includes/header.php';
?>
<div class="box box-success">
    <div class="box-header"><h3>All Notifications</h3></div>
    <div class="box-body">
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