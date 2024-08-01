<?
require_once 'includes/header.php';
if(isset($_POST['status']) && $_POST['status'] == 'addFee'){
    $res = $con->query("INSERT INTO `fee_collection`(`enrollment_no`, `amount`, `payment_details`, `date`) 
        VALUES ('".$_POST['enrollment_no']."','".$_POST['amount']."','".$_POST['payment_details']."','".$_POST['date']."')");
    if($res){
        echo '<script>alert("Entry Added Successfully.");window.location.href="fee_collection.php?enrollment_no='.$_POST['enrollment_no'].'"</script>';
    }else{
        echo '<script>alert("Something went wrong.");window.location.href="fee_collection.php?enrollment_no='.$_POST['enrollment_no'].'"</script>';
    }
}
if(isset($_GET['action']) && $_GET['action'] == 'remove'){
    $id = $_GET['id'];
    $con->query("DELETE FROM `fee_collection` WHERE `id` = '".$id."'");
    echo '<script>alert("Deleted Successfull.");window.location.href="fee_collection.php?enrollment_no='.$_GET['enrollment_no'].'"</script>';
}
?>
<section class="row">
        <div class="col-md-6">
            <div class="box box-success">
            <div class="box-header"><h3>Fee Collection</h3></div>
                <div class="box-body">
                    <form action="" method="get" class="">
                        <div class="form-group ">
                            <select name="enrollment_no" class="form-control" required>
                                <option value="">Select</option>
                                <?
                                    $st = $con->query("select * from students where center_id = '".$_SESSION['center']['id']."'");
                                    if($st->num_rows){
                                        while($s = $st->fetch_assoc()){
                                            echo "<option value='".$s['enrollment_no']."'>".$s['enrollment_no']."</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group ">
                           
                            <button class="btn btn-success" type="submit" >Submit</button>
                        </div>
                    </form>
                </div>
                <div class="box-footer">
                </div>
            </div>
        </div>
        <?
            if(isset($_GET['enrollment_no']) && !empty($_GET['enrollment_no'])){
                $enroll = $_GET['enrollment_no'];
        ?>
        <div class="col-md-6">
            <div class="box box-info">
            <div class="box-header"><h3>Add Entry</h3></div>
                <div class="box-body">
                    <form action="" method="POST" class="row">
                            <input type="hidden" class="form-control" name="enrollment_no" placeholder="Enter Enrollment No." value="<?=$enroll?>" readonly>
                        <div class="form-group col-md-12">
                            <input type="text" class="form-control" name="amount" placeholder="Enter Amount" required>
                        </div>
                        <div class="form-group col-md-12">
                            <input type="date" class="form-control" name="date" placeholder="Enter Date" >
                        </div>
                        <!--<div class="form-group col-md-6">-->
                        <!--    <input type="time" class="form-control" name="time" placeholder="Enter Time" >-->
                        <!--</div>-->
                        <div class="form-group col-md-12">
                            <textarea class="form-control" name="payment_details" placeholder="Enter Payment Details" ></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <button class="btn btn-success" type="submit" name="status" value="addFee">Submit</button>
                        </div>
                    </form>
                </div>
                <div class="box-footer">
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="box box-warning">
            <div class="box-header"><h3>All Entries</h3>
            <a target="_blank" href="../invoice.php?enroll=<?=$enroll?>" class="pull-right btn btn-sm btn-info"><i class="fa fa-print"></i> Invoice</a>
            </div>
                <div class="box-body">
                    <table class="table table-bordered table-responsive" id="myTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <!--<th>Time</th>-->
                                <th>Details</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    
                    <tbody>
                        <?
                            $get = $con->query("SELECT * FROM fee_collection WHERE enrollment_no = '$enroll'");
                            if($get->num_rows){
                                $i = 1;
                                while($row = $get->fetch_assoc()){
                                echo '<tr>
                                        <td>'.$i++.'</td>
                                        <td>'.$row['amount'].'</td>
                                        <td>'.date('d-m-Y',strtotime($row['date'])).'</td>
                                        <td>'.$row['payment_details'].'</td>
                                        <td>
                                            <a onclick="return cofirm('."'Are you confirm?'".');" href="fee_collection.php?enrollment_no='.$row['enrollment_no'].'&action=remove&id='.$row['id'].'" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                        </td>
                                      </tr>';
                                }
                            }
                        ?>
                    </tbody>
                    </table>
                </div>
                <div class="box-footer">
                </div>
            </div>
        </div>
        <?
            }
            else{
        ?>
        <div class="col-md-6">
            <div class="box box-warning">
            <div class="box-header"><h3>Check</h3></div>
                <div class="box-body">
                    <form action="" method="get" class="row">
                        <div class="form-group col-md-12">
                            <label>Enrollment No (Optional)</label>
                            <select name="enroll" class="form-control">
                                <option value="">Select</option>
                                <?
                                    $st = $con->query("select * from students where center_id = '".$_SESSION['center']['id']."'");
                                    if($st->num_rows){
                                        while($s = $st->fetch_assoc()){
                                            echo "<option value='".$s['enrollment_no']."'>".$s['enrollment_no']."</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Start Date</label>
                            <input type="date" class="form-control" name="start_date" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>End Date</label>
                            <input type="date" class="form-control" name="end_date" required>
                        </div>
                        <div class="form-group col-md-12">
                            <button class="btn btn-success" type="submit" name="getData" >Submit</button>
                        </div>
                    </form>
                </div>
                <div class="box-footer">
                </div>
            </div>
        </div>
        <?
            }
            if(isset($_GET['getData'])){
        ?>
        <div class="col-md-12">
            <div class="box box-warning">
            <div class="box-header"><h3>All Entries</h3></div>
                <div class="box-body">
                    <table class="table table-bordered table-responsive" id="myTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Enrollment No</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <!--<th>Time</th>-->
                                <th>Details</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    
                    <tbody>
                        <?
                            $enroll = $_GET['enroll'];
                            $start_date = $_GET['start_date'];
                            $end_date = $_GET['end_date'];
                            
                            $e_qeury = $enroll != ''?"enrollment_no = '$enroll' And":'';
                            $date_qeury = " date BETWEEN '$start_date' and '$end_date'";
                            $get = $con->query("SELECT * FROM fee_collection WHERE $e_qeury $date_qeury");
                            if($get->num_rows){
                                $i = 1;
                                while($row = $get->fetch_assoc()){
                                echo '<tr>
                                        <td>'.$i++.'</td>
                                        <td>'.$row['enrollment_no'].'</td>
                                        <td>'.$row['amount'].'</td>
                                        <td>'.date('d-m-Y',strtotime($row['date'])).'</td>
                                        <td>'.$row['payment_details'].'</td>
                                        <td>
                                            <a onclick="return cofirm('."'Are you confirm?'".');" href="fee_collection.php?enrollment_no='.$row['enrollment_no'].'&action=remove&id='.$row['id'].'" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                        </td>
                                      </tr>';
                                }
                            }
                        ?>
                    </tbody>
                    </table>
                </div>
                <div class="box-footer">
                </div>
            </div>
        </div>
        <?
            }
        ?>
        
</section>

<?
require_once 'includes/footer.php';
?>