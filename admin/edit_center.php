<?php
require_once 'includes/header.php';

if ($_GET['action'] == 'del') {
    if (file_exists("../uploads/centers/" . $_GET['file']))
        unlink("../uploads/centers/" . $_GET['file']);
    $con->query("DELETE FROM `centers` WHERE id = '" . $_GET['id'] . "'");
    echo '<script>alert("Institute is deleted.");location.href="edit_center.php"</script>';
}
if ($_GET['btn'] == 'active') {
    $con->query("UPDATE `centers` SET `status` = '1' WHERE `centers`.`id` = '" . $_GET['id'] . "'");
    echo '<script>alert("Status is Active");location.href="edit_center.php"</script>';
}
if ($_GET['btn'] == 'deactive') {
    $con->query("UPDATE `centers` SET `status` = '0' WHERE `centers`.`id` = '" . $_GET['id'] . "'");
    echo '<script>alert("Status is Deactive");location.href="edit_center.php"</script>';
}

// Define date filters
$startDate = $_GET['start_date'];
$endDate = $_GET['end_date'];

// Build the SQL query for filtering by date range
$dateFilter = "";
if (!empty($startDate) && !empty($endDate)) {
    $dateFilter = "AND DATE(timestamp) BETWEEN '" . $startDate . "' AND '" . $endDate . "'";
}

$query = "SELECT * FROM centers WHERE 1 " . $dateFilter;
$get = $con->query($query);
?>

<!-- Include jQuery and DataTables CSS/JS here -->
<script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs/qrcode.min.js"></script>


<div id="qrcodeModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Download center Certificate</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="qrcode-container" style="margin-left: 30%;"></div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <form method="GET">
            <div class="box box-primary">
                <div class="box-header"><h3>Filter By date</h3></div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="start-date">Start Date:</label>
                        <input type="date" id="start-date" name="start_date" value="<?=$_GET['start_date']?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="end-date">End Date:</label>
                        <input type="date" id="end-date" name="end_date" value="<?=$_GET['end_date']?>" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!--<div id="qrcode-container"></div>-->

<div class="box box-success">
    <div class="box-header"><h3>All Center</h3></div>
    <div class="box-body" style="overflow-x:scroll">
        <table id="centerTable" class="table table-bordered data-table table-responsive">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Institute ID</th>
                    <th>Institute Name</th>
                    <th>Address</th>
                    <th>State</th>
                    <th>Distric</th>
                    <th>Head of institute</th>
                    <th>institute Owner</th>
                    <th>Mobile</th>
                    <th>Certificate</th>
                    <th>Action</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($g = $get->fetch_assoc()) {
                    $s = $con->query("SELECT * FROM states where id = '" . $g['state_id'] . "'")->fetch_assoc();
                    $c = $con->query("SELECT * FROM city where id = '" . $g['city_id'] . "'")->fetch_assoc();
                    echo '
                        <tr>
                            <td>' . date('d-M-y', strtotime($g['timestamp'])) . '</td>
                            <td>' . $g['center_number'] . '</td>
                            <td>' . $g['institute_name'] . '</td>
                            <td>' . $g['center_full_address'] . '</td>
                            <td>' . $s['state_name'] . '</td>
                            <td>' . $c['city_name'] . '</td>
                            <td>' . $g['name'] . '</td>
                            <td><img style="width:80px;height:100px;" src="../uploads/centers/'.$g['image'].'"></td>
                            <td>'.$g['contact_number'].'</td>
                            <td><a href="#" data-id="'.$g['center_number'].'" class="btn btn-sm btn-info show-qr" ><i class="fa fa-eye"></i></a></td>';
                    if ($g['status'] == 1)
                        echo '<td><a href="?btn=deactive&id=' . $g['id'] . '" class="btn btn-success btn-sm">Active</a></td>';
                    else
                        echo '<td><a href="?btn=active&id=' . $g['id'] . '" class="btn btn-danger btn-sm">Deactive</a></td>';
                    echo '<td>
                            <a href="wallet.php?center=' . $g['id'] . '" class="btn btn-warning btn-sm"><i class="fa fa-money"></i></a>
                            <a href="center_update.php?id=' . $g['id'] . '" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                            <a href="?action=del&id=' . $g['id'] . '" class="btn btn-danger btn-sm delete-button" onclick="return confirm(\'Are you sure you want to delete this item?\');" data-id="' . $g['id'] . '"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>


<script>
    var table = $('#centerTable').DataTable();

    $(document).ready(function() {
        // Add an event listener to the search input
        $('#table-search').on('keyup', function() {
            table.search(this.value).draw();
        });

        var qrcode = new QRCode("qrcode-container");

        // Handle click on the certificate link
        document.querySelectorAll('.show-qr').forEach(function(element) {
            element.addEventListener('click', function(event) {
                event.preventDefault();

                // Get the center number from the data-id attribute
                var centerNumber = this.getAttribute('data-id');

                // Generate the QR code
                qrcode.makeCode('https://sihsindia.com/admin/get_center_certificate.php?view=' + centerNumber);

                // Display the modal
                $('#qrcodeModal').modal('show');
            });
        });

        // Close the modal when the close button is clicked
        $('#qrcodeModal').on('hidden.bs.modal', function() {
            // Clear the QR code
            qrcode.clear();
        });
    });
</script>

<?php
include 'includes/footer.php';
?>
``
