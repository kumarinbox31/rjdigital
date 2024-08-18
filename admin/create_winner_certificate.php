<?php

require_once 'includes/header.php';
require_once 'helpers/winner_certificate.php';
$winner = new Winner_certificate($con);
if (isset($_GET['action']) && $_GET['action'] == 'changeStatus'){
    $id = intval($_GET['id']);
    $val = htmlspecialchars($_GET['val']);
    $winner->id = $id;
    $winner->getById();
    $winner->status = $val == 'active' ? 'draft' : 'active';
    if($winner->update()){
        echo '<script>alert("Status changed successfully!");window.location.href="create_winner_certificate.php"</script>';
    } else {
        echo '<script>alert("Error: Unable to change status.");window.location.href="create_winner_certificate.php"</script>';
    }
}
if (isset($_GET['action']) && $_GET['action'] == 'del'){
    $id = intval($_GET['id']);
    $winner->id = $id;
    $winner->getById();
    if($winner->delete()){
        echo '<script>alert("deleted successfully!");window.location.href="create_winner_certificate.php"</script>';
    } else {
        echo '<script>alert("Error: Unable to delete.");window.location.href="create_winner_certificate.php"</script>';
    }
}
if (isset($_POST['action']) && $_POST['action'] == 'save') {

    // Assign form data to object properties
    $winner->name = $_POST['name'];
    $winner->father = $_POST['father'];
    $winner->center_id = $_POST['center_id'];
    $winner->enrollment_no = $_POST['enrollment_no'];
    $winner->grade = $_POST['grade'];
    $winner->issue_date = $_POST['issue_date'];
    $winner->status = $_POST['status'];

    // Handle file upload for image
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = photo_upload('image', 'winner');
        if ($image['status']) {
            $winner->image = $image['file_name'];
        } else {
            echo '<script>alert("Image not uploaded");window.location.href="create_winner_certificate.php"</script>';
            exit; // Stop further execution if image upload fails
        }
    } else {
        echo '<script>alert("Image not uploaded");window.location.href="create_winner_certificate.php"</script>';
        exit; // Stop further execution if no image was uploaded
    }

    // Add the winner certificate to the database
    if ($winner->save()) {
        echo '<script>alert("Winner certificate created successfully!");window.location.href="create_winner_certificate.php"</script>';
    } else {
        echo '<script>alert("Error: Unable to create winner certificate.");window.location.href="create_winner_certificate.php"</script>';
    }
}
?>

<div class="box box-primary">
    <div class="box-header">
        <h3>Create Winner Certificate</h3>
    </div>
    <div class="box-body">
        <form method="POST" action="" enctype="multipart/form-data" class="row">

            <!-- Name Field -->
            <div class="col-md-4 form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <!-- Father's Name Field -->
            <div class="col-md-4 form-group">
                <label for="father">Father's Name</label>
                <input type="text" class="form-control" id="father" name="father" required>
            </div>

            <!-- Center ID Field -->
            <div class="col-md-4 form-group">
                <label for="center_id">Center ID</label>
                <select name="center_id" class="form-control" required>
                    <?php
                    $get = $con->query("SELECT * FROM centers ");
                    while ($row = $get->fetch_assoc()) {
                        echo '<option value="' . $row['id'] . '">' . $row['institute_name'] . '</option>';
                    }
                    ?>
                </select>
            </div>

            <!-- Enrollment No Field -->
            <div class="col-md-4 form-group">
                <label for="enrollment_no">Enrollment No</label>
                <input type="text" class="form-control" id="enrollment_no" name="enrollment_no" required>
            </div>

            <!-- Grade Field -->
            <div class="col-md-4 form-group">
                <label for="grade">Grade</label>
                <input type="text" class="form-control" id="grade" name="grade" required>
            </div>

            <!-- Issue Date Field -->
            <div class="col-md-4 form-group">
                <label for="issue_date">Issue Date</label>
                <input type="date" class="form-control" id="issue_date" name="issue_date" required>
            </div>

            <!-- Image Upload Field -->
            <div class="col-md-4 form-group">
                <label for="image">Upload Image</label>
                <input type="file" class="form-control" id="image" name="image" required>
            </div>

            <!-- Status Field -->
            <div class="col-md-4 form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="active">Draft</option>
                    <option value="active">Active</option>
                </select>
            </div>

            <!-- Submit Button -->
            <div class="col-md-12 form-group">
                <button type="submit" name="action" value="save" class="btn btn-primary">Create Certificate</button>
            </div>

        </form>
    </div>

    <div class="box-footer">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Certificate No.</th>
                    <th>Name</th>
                    <th>Enrollment No.</th>
                    <th>Grade</th>
                    <th>Issue Date</th>
                    <th>Status</th>
                    <th>View</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $winner->getAll();
                foreach ($result as $g) {
                    // Convert status to button style
                    $statusBtn = $g['status'] == 'active' ? 'success' : 'danger';
                    $statusIcon = $g['status'] == 'active' ? 'check' : 'times';

                    echo '<tr>
                        <td>' . htmlspecialchars($g['id']) . '</td>
                        <td>' . htmlspecialchars($g['name']) . '</td>
                        <td>' . htmlspecialchars($g['enrollment_no']) . '</td>
                        <td>' . htmlspecialchars($g['grade']) . '</td>
                        <td>' . htmlspecialchars($g['issue_date']) . '</td>
                        <td>
                            <a href="?action=changeStatus&id=' . htmlspecialchars($g['id']) . '&val=' . htmlspecialchars($g['status']) . '" class="btn btn-sm btn-' . $statusBtn . '">
                                <i class="fa fa-' . $statusIcon . '"></i>
                            </a>
                        </td>
                        <td>
                            <a target="_blank" href="/rjdigital/winner-certificate.php?enrollment_no='.htmlspecialchars($g['enrollment_no']).'" class="btn btn-sm btn-info" >
                                <i class="fa fa-eye"></i>
                            </a>
                        </td>
                        <td>
                            <a href="?action=del&id=' . htmlspecialchars($g['id']) . '" class="btn btn-danger">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                      </tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
include 'includes/footer.php';
?>