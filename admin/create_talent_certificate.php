<?php
require_once 'includes/header.php';
require_once 'includes/models/computer_talent_certificate.php';
$talent = new ComputerTalentCertificate($con);

if (isset($_POST['action']) && $_POST['action'] == 'save') {
    // Fetch the values from the POST data
    $center_id = intval($_POST['center_id']);
    $name = $_POST['name'];
    $class = $_POST['class'];
    $session = $_POST['session'];
    $college_name = $_POST['college_name'];

    // Assign values to the $talent object
    $talent->center_id = $center_id;
    $talent->name = $name;
    $talent->class = $class;
    $talent->session = $session;
    $talent->college_name = $college_name;

    // Attempt to save the object
    if ($talent->save()) {
        echo '<script>alert("Saved successfully.");window.location.href="create_talent_certificate.php";</script>';
    } else {
        echo '<script>alert("Something went wrong.");window.location.href="create_talent_certificate.php";</script>';
    }
}
if(isset($_GET['action'])){
    $action = htmlspecialchars($_GET['action']);
    switch($action){
        case 'chStatus':
            $id = intval($_GET['id']);
            $status = intval($_GET['status']);
            $talent->id = $id;
            $talent->getById();
            $talent->status = $status;
            if($talent->update()){
                echo '<script>alert("Changed successfully.");window.location.href="create_talent_certificate.php";</script>';
            } else {
                echo '<script>alert("Something went wrong.");window.location.href="create_talent_certificate.php";</script>';
            }
        break;
        case 'del':
            $id = intval($_GET['id']);
            $talent->id = $id;
            $talent->getById();
            if($talent->delete()){
                echo '<script>alert("Deleted successfully.");window.location.href="create_talent_certificate.php";</script>';
            } else {
                echo '<script>alert("Something went wrong.");window.location.href="create_talent_certificate.php";</script>';
            }
        break;
        default:
        break;
    }
}
?>
<style>
    .required::after{
        content:' *';
        color:red;
    }
</style>
<div class="">
    <h3 class="text-center text-success text-bold">Computer Tenant Certificate</h3>
    <hr>
    <div class="row">
        <div class="col-md-4">
            <form method="POST" action="">
                <div class="panel">
                    <div class="panel-heading bg-primary text-white">Create Certificate</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="required">Center</label>
                            <a target="_blank" href="create_center.php" class="btn btn-sm btn-primary" style="margin-top:-10px;float:right;">Add New</a>
                            <select class="form-control" name="center_id" required>
                                <option value="">Select Center</option>
                                <?php
                                $get = $con->query("SELECT * FROM centers");
                                while ($row = $get->fetch_assoc()) {
                                    echo '<option value="' . $row['id'] . '">' . $row['institute_name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="required">Name</label>
                            <input name="name" class="form-control" placeholder="Enter name" required>
                        </div>
                        <div class="form-group">
                            <label class="required">Class</label>
                            <input name="class" class="form-control" placeholder="Enter class" required>
                        </div>
                        <div class="form-group">
                            <label class="required">Session</label>
                            <input name="session" class="form-control" placeholder="Enter session" required>
                        </div>
                        <div class="form-group">
                            <label class="required">College Name</label>
                            <input name="college_name" class="form-control" placeholder="Enter college name" required>
                        </div>

                    </div>
                    <div class="panel-footer">
                        <button type="submit" name="action" value="save" class="btn btn-sm btn-success"><i
                                class="fa fa-save"></i> Generate</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-8">
            <form class="row">
                <div class="col-md-6">
                    <select class="form-control " name="center_id">
                        <option value="">All Centers</option>
                        <?php
                        $center_id = intval($_GET['center_id']);
                        $get = $con->query("SELECT * FROM centers");
                        while ($row = $get->fetch_assoc()) {
                            $selected = $row['id'] == $center_id ? 'selected' : '';
                            echo '<option value="' . $row['id'] . '" '.$selected.'>' . $row['institute_name'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                </div>
            </form>
            <div class="panel">
                <div class="panel-heading bg-info text-white">All Certificates</div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped datatable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Class</th>
                                <th>Session</th>
                                <th>College Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if($center_id == 0){
                                $get = $talent->getAll(); 
                            }else{
                                $talent->center_id = $center_id;
                                $get = $talent->getByCenterId();
                            }
                            
                            if (!empty($get)) {
                                foreach ($get as $record) {
                                    $status = '<a href="?action=chStatus&id='.intval($record['id']).'&status=1" class="btn btn-sm btn-warning">Approve</a>';
                                    if ($record['status']) {
                                        $status = '<a href="?action=chStatus&id='.intval($record['id']).'&status=0" class="btn btn-sm btn-success">Approved</a>';
                                    }
                                    echo '<tr>';
                                    echo '<td>' . htmlspecialchars($record['name']) . '</td>';
                                    echo '<td>' . htmlspecialchars($record['class']) . '</td>';
                                    echo '<td>' . htmlspecialchars($record['session']) . '</td>';
                                    echo '<td>' . htmlspecialchars($record['college_name']) . '</td>';
                                    echo '<td>' . $status. '</td>';
                                    echo '<td>
                                    <a target="_blank" href="../view-computer-talent-certificate.php?id=' . intval($record['id']) . '" class="btn btn-sm btn-info">View</a> | 
                                    <a href="?action=del&id=' . intval($record['id']) . '" 
                                    onclick="return confirm(\'Are you sure?\')" class="btn btn-danger btn-sm">Delete</a></td>';
                                    echo '</tr>';
                                }
                            } else {
                                echo '<tr><td colspan="6">No records found.</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once 'includes/footer.php'; ?>