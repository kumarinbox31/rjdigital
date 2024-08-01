<?require_once 'includes/header.php';

if($_GET['action']=='del')
{
	$con->query("DELETE FROM tbl_wallet where id = '".$_GET['id']."'");
	echo '<script>alert("Wallet Detail Deleted Successfully.");location.href="wallet.php"</script>';
}
$center_id = isset($_GET['center']) ? $_GET['center'] : $_SESSION['center']['id'];
if(!is_null($center_id)){
?>

<div class="row">
    <div class="col-md-3">
        <div class="panel panel-warning">
            <div class="panel-heading"><h4>Wallet Balance</h4></div>
            <div class="panel-body">
                <h4>Rs. <?=wallet($center_id);?></h4>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading">Wallet History</div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Message</th>
                            <th>Timestamp</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?
                            $i = 1;
                            $get = $con->query("SELECT * FROM `tbl_wallet` WHERE user_id = '".$center_id."' AND user_type = 'center'");
                            while($row = $get->fetch_assoc()){
                                $class = $row['type'] == 'cr' ? 'bg-success' : 'bg-danger';
                                echo '<tr class="'.$class.'">
                                        <td>'.$i++.'</td>
                                        <td>'.strtoupper($row['type']).'</td>
                                        <td>'.$row['amount'].'</td>
                                        <td>'.$row['message'].'</td>
                                        <td>'.date('d-m-Y h:i:s',strtotime($row['timestamp'])).'</td>
                                        <td><a href="?id='.$row['id'].'&action=del" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>

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
}
require_once 'includes/footer.php';?>