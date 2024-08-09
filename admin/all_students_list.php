<?php
require_once 'includes/header.php';

if ($_GET['action'] == 'del') {
    $id = $_GET['id'];
    $con->query("UPDATE students SET is_deleted = 1 WHERE id = '$id'");
    echo '<script>alert("Student is deleted.");window.location.href="all_students_list.php"</script>';
}

if ($_GET['action'] == 'changeStatus') {
    $val = $_GET['val'] ? 0 : 1;
    $id = $_GET['id'];
    $con->query("UPDATE students SET status = '$val' WHERE id = '$id'");
    echo '<script>alert("Changed Successfully.");window.location.href="all_students_list.php"</script>';
}

if ($_GET['action'] == 'recycle') {
    $id = $_GET['id'];
    $con->query("UPDATE students SET is_deleted = 0 WHERE id = '$id'");
    echo '<script>alert("Student is Recover.");window.location.href="all_students_list.php"</script>';
}

if ($_GET['action'] == 'delete') {
    $id = $_GET['id'];
    $con->query("DELETE FROM students WHERE id = '$id'");
    echo '<script>alert("Student is deleted.");window.location.href="all_students_list.php"</script>';
}

$get = $con->query("SELECT * FROM students WHERE is_deleted = 0 order by enrollment_no asc");
?>
<!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">-->
<!--<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>-->
<div class="box box-primary">
    <div class="box-header"><h3>All Students</h3></div>
    <div class="box-body">
        <table id="centerTable" class="table table-bordered data-table">
            <thead>
                <tr>
                    <th>Enrollment No.</th>
                    <th>Date</th>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Father's Name</th>
                    <th>Center</th>
                    <th>Course</th>
                    <th>Status</th>
                    <th>Details</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php while($g = $get->fetch_assoc()) {
                    $c = $con->query("SELECT * FROM courses WHERE id = '".$g['course_id']."'")->fetch_assoc();
                    $ce = $con->query("SELECT * FROM centers WHERE id = '".$g['center_id']."'")->fetch_assoc();
                    $statusBtn = $g['status'] ? 'success' : 'danger';
                    $statusIcon = $g['status'] ? 'on' : 'off';
                    $certificateLink = "https://rjdigitall.webfire.site/view_enrollment.php?enrollment_no=" . $g['enrollment_no'];
                    echo '
                        <tr>
                            <td>'.$g['enrollment_no'].'</td>
                            <td>'.date('d-M-y', strtotime($g['timestamp'])).'</td>
                            <td><img style="width:80px; height:100px;" src="../uploads/students/'.$g['photo'].'"></td>
                            <td>'.$g['name'].'</td>
                            <td>'.$g['father'].'</td>
                            <td>'.$ce['institute_name'].'</td>
                            <td>'.$c['course_name'].'</td>
                            <td>
                                <a href="?action=changeStatus&id='.$g['id'].'&val='.$g['status'].'" class="btn btn-sm btn-'.$statusBtn.'"><i class="fa fa-toggle-'.$statusIcon.'"></i></a>
                            </td>
                            <td>
                                <a href="/view_enrollment.php?enrollment_no='.$g['enrollment_no'].'" class="btn btn-warning"  style="color:white"><i class="fa fa-print"></i></a>
                                <a href="edit_student.php?id='.$g['id'].'" class="btn btn-info"><i class="fa fa-edit"></i></a>
                            </td>
                            <td>
                                <a href="?action=del&id='.$g['id'].'" class="btn btn-danger" onclick="return confirm(\'Are You Confirm to delete This student\')"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>';
                } ?>
            </tbody>
        </table>
    </div>
</div>
<div class="box box-primary">
    <div class="box-header"><h3>For Recycle Students</h3></div>
    <div class="box-body">
        <table id="recycleTable" class="table table-bordered data-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Photo</th>
                    <th>Enrollment No.</th>
                    <th>Name</th>
                    <th>Father's Name</th>
                    <th>Center</th>
                    <th>Course</th>
                    <th>Status</th>
                    <th>Details</th>
                    <th>Recycle</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $getRecycle = $con->query("SELECT * FROM students WHERE is_deleted = 1");
                while($g = $getRecycle->fetch_assoc()) {
                    $c = $con->query("SELECT * FROM courses WHERE id = '".$g['course_id']."'")->fetch_assoc();
                    $ce = $con->query("SELECT * FROM centers WHERE id = '".$g['center_id']."'")->fetch_assoc();
                    $statusBtn = $g['status'] ? 'success' : 'danger';
                    $statusIcon = $g['status'] ? 'on' : 'off';
                    echo '
                        <tr>
                            <td>'.date('d-M-y', strtotime($g['timestamp'])).'</td>
                            <td><img style="width:80px; height:100px;" src="../uploads/students/'.$g['photo'].'"></td>
                            <td>'.$g['enrollment_no'].'</td>
                            <td>'.$g['name'].'</td>
                            <td>'.$g['father'].'</td>
                            <td>'.$ce['institute_name'].'</td>
                            <td>'.$c['course_name'].'</td>
                            <td>
                                <a href="?action=changeStatus&id='.$g['id'].'&val='.$g['status'].'" class="btn btn-sm btn-'.$statusBtn.'"><i class="fa fa-toggle-'.$statusIcon.'"></i></a>
                            </td>
                            <td>
                                <a href="edit_student.php?id='.$g['id'].'" class="btn btn-info"><i class="fa fa-edit"></i></a>
                            </td>
                            <td>
                                <a href="?action=recycle&id='.$g['id'].'" class="btn btn-warning" onclick="return confirm(\'Are You Confirm to Recover This student\')"><i class="fa fa-recycle"></i></a>
                            </td>
                            <td>
                                <a href="?action=delete&id='.$g['id'].'" class="btn btn-danger" onclick="return confirm(\'Are You Confirm to permanently delete This student\')"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>';
                } ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function printCertificate(link) {
    var newWin = window.open(link, '_blank');
    newWin.onload = function() {
        newWin.print();
        newWin.onafterprint = function() {
            newWin.close();
        };
    };
}

$(document).ready(function() {
    $('#centerTable').DataTable();
    $('#recycleTable').DataTable();
});
</script>

<?php include 'includes/footer.php'; ?>
