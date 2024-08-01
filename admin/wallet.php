<?require_once 'includes/header.php';
$center_id = isset($_GET['center']) ? $_GET['center'] : $_SESSION['center']['id'];
if(!is_null($center_id)){
    if($_POST['status'] == 'addFund'){
        $amount = $_POST['amount'];
        $type = $_POST['type'];
        $con->query("INSERT INTO `tbl_wallet`(`type`, `amount`, `user_id`, `user_type`,`message`) VALUES 
        		        ('$type','$amount','$center_id','center','Action by Admin.')");
        echo '<script>alert("Added Successfully.");window.location.href="wallet.php?center='.$center_id.'"</script>';
    }
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
    <div class="col-md-4">
        <div class="panel panel-success">
            <div class="panel-heading"><h4>Add Fund</h4></div>
            <div class="panel-body">
                <form method="POST" action="" class="row">
                    <div class="form-group col-md-6">
                        <label>Amount</label>
                        <input type="number" min="10" name="amount" class="form-control" placeholder="Enter Amount" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Type</label>
                        <select name="type" class="form-control" required>
                            <option value="cr">CR</option>
                            <option value="dr">DR</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-sm btn-info" name="status" value="addFund">Pay</button>
                    </div>
                </form>
                
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