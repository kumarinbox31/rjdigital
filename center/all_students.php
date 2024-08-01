<?
require_once 'includes/header.php';
// print_r($_SESSION['center']['id']);exit;
    if ($_GET['action'] == 'del') {
        $id = $_GET['id'];
        $con->query("UPDATE students SET is_deleted = 1 WHERE id = '$id'");
        echo '<script>alert("Student is deleted.");window.location.href="all_students.php"</script>';
    }
    
    $get = $con->query("SELECT * FROM students WHERE center_id = '".$_SESSION['center']['id']."' AND status = 1 AND is_deleted = 0");
		

?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>


<div class="box box-primary">
    <div class="box-header"><h3>All Students</h3></div>
    <div class="box-body">
        <table id="centerTable" class="table table-bordered data-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Photo</th>
                    <th>Enrollment No.</th>
                    <th>Name</th>
                    <th>Father Name</th>
                    <th>E-Mail ID</th>
                    <th>Course</th>
                    <th>Send Notification</th>
                    <th>Details</th>
                  
                </tr>
            </thead>
            <tbody>
                <?php
                    while($g = $get->fetch_assoc()) {
                    // print_r($g);exit;
                        $c = $con->query("SELECT * FROM courses where id = '".$g['course_id']."'")->fetch_assoc();
                        echo '
                        <tr>
                            <td>'.date('d-M-y', strtotime($g['timestamp'])).'</td>
                            <td><img style="width:80px;height:100px;" src="../uploads/students/'.$g['photo'].'"></td>
                            <td>'.$g['enrollment_no'].'</td>
                            <td>'.$g['name'].'</td>
                            <td>'.$g['father'].'</td>
                            <td>'.$g['email'].'</td>
                            <td>'.$c['course_name'].'</td>
                            <td><a href="notification.php?id='.$g['id'].'" class="btn btn-warning"><i class="fa fa-envelope"></i></a></td>
                            <td>
                            <a href="/view_enrollment.php?enrollment_no='.$g['enrollment_no'].'" class="btn btn-primary"  style="color:white"><i class="fa fa-eye"></i></a></td>
                                                   </tr>';
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>


<div class="box box-primary">
    <div class="box-header"><h3>For Recycle Students</h3></div>
    <div class="box-body">
        <table id="recenterTable" class="table table-bordered data-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Photo</th>
                    <th>Enrollment No.</th>
                    <th>Name</th>
                    <th>Father Name</th>
                    <th>E-Mail ID</th>
                    <th>Course</th>
                    <th>Send Notification</th>
                    <th>Details</th>
                    <th>Recycle</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if ($_GET['action'] == 'delete') {
                        $id = $_GET['id'];
                        $con->query("DELETE FROM students  WHERE id = '$id'");
                        echo '<script>alert("student Permanently deleted");window.location.href="all_students.php"</script>';
                    }
                    
                    if ($_GET['action'] == 'recycle') {
                        $id = $_GET['id'];
                        $con->query("UPDATE students SET is_deleted = 0 WHERE id = '$id'");
                        echo '<script>alert("Restore student successfully.");window.location.href="all_students.php"</script>';
                    }
                    
                    $get = $con->query("SELECT * FROM students WHERE center_id = '".$_SESSION['center']['id']."' AND status = 1 AND is_deleted = 1");
    
                    while($g = $get->fetch_assoc()) {
                        $c = $con->query("SELECT * FROM courses where id = '".$g['course_id']."'")->fetch_assoc();
                        echo '
                        <tr>
                            <td>'.date('d-M-y', strtotime($g['timestamp'])).'</td>
                            <td><img style="width:80px;height:100px;" src="../uploads/students/'.$g['photo'].'"></td>
                            <td>'.$g['enrollment_no'].'</td>
                            <td>'.$g['name'].'</td>
                            <td>'.$g['father'].'</td>
                            <td>'.$g['email'].'</td>
                            <td>'.$c['course_name'].'</td>
                            <td><a href="notification.php?id='.$g['id'].'" class="btn btn-warning"><i class="fa fa-envelope"></i></a></td>
                            <td><a href="edit_student.php?id='.$g['id'].'" class="btn btn-info"><i class="fa fa-edit"></i></a></td>
                            <td><a href="?id='.$g['id'].'&action=recycle" class="btn btn-warning" onclick="return confirm(\'Are you sure you want to restore stundent\')"><i class="fa fa-recycle"></i></a></td>
                            <td><a href="?id='.$g['id'].'&action=delete&file='.$g['photo'].'" class="btn btn-danger" onclick="return confirm(\'Are you sure you want to delete this student permanently\')"><i class="fa fa-trash"></i></a></td>
                        </tr>';
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
var table = $('#centerTable').DataTable();
var table = $('.data-table').DataTable();

    $(document).ready(function() {
        // Define the table variable
       

        // Add an event listener to the search input
        $('#table-search').on('keyup', function() {
            table.search(this.value).draw();
        });
    });
</script>
<?php
include 'includes/footer.php';
?>
