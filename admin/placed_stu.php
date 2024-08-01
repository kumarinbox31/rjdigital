<?php require 'includes/header.php'; ?>

<?php
// Handle delete request
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $con->query("DELETE FROM `placement` WHERE `id` = $id");
    echo '<script>alert("Success");location.href="placed_stu.php"</script>';
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_FILES['image']['name'])) {
        $image = photo_upload('image', 'placed_student');
        if ($image['status']) {
            $name = $_POST['name'];
            $job = $_POST['job'];

            $con->query("INSERT INTO `placement` (`id`, `timestamp`, `name`, `job`, `image`) VALUES (NULL, CURRENT_TIMESTAMP, '$name', '$job', '".$image['file_name']."')");
            echo '<script>alert("Success");location.href="placed_stu.php"</script>';
        } else {
            echo '<script>alert("Error in image uploading...");location.href="placed_stu.php"</script>';
        }
    }
}
?>
<div class="box box-success">
    <div class="box-header"><h4>Placed Student</h4></div>
    <div class="box-body">
        <form class="form-inline" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Enter Name</label>
                <input type="text" class="form-control" name="name">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="job" placeholder="Enter Job" required>
            </div>
            <div class="form-group">
                <input type="file" name="image" class="form-control" required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success" name="submit">Submit</button>
            </div>
        </form>
    </div>
</div>
<?php
// Handle delete request


// Fetch all placed students
$query = "SELECT * FROM placement";
$result = $con->query($query);
?>

<div class="box box-success">
    <div class="box-header">
        <h4>Placed Students</h4>
    </div>
    <div class="box-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Job</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Display each placed student
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . $row['job'] . '</td>';
                    echo '<td><img src="../uploads/placed_student/' . $row['image'] . '" alt="Placement student" width="50"></td>';
                    echo '<td><a href="?action=delete&id=' . $row['id'] . '" class="btn btn-danger">Delete</a></td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>



<?php require 'includes/footer.php'; ?>
