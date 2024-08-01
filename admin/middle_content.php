<?php
    include 'includes/header.php';

    // Handle delete request
    if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $con->query("DELETE FROM `crousel` WHERE `id` = $id");
        echo '<script>alert("Success");location.href="middle_content.php"</script>';
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!empty($_FILES['image']['name'])) {
            $image = photo_upload('image', 'crousel');
            if ($image['status']) {
                $con->query("INSERT INTO `crousel` (`id`, `image`) 
                VALUES (NULL, '".$image['file_name']."')");
                echo '<script>alert("Success");location.href="middle_content.php"</script>';
            } else {
                echo '<script>alert("Error in image uploading...");location.href="middle_content.php"</script>';
            }
        }
    }

    // Fetch all news
    $query = "SELECT * FROM `crousel`";
    $result = $con->query($query);
?>

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <form method="post" enctype="multipart/form-data">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h5>Add Footer Crousel</h5>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Cruosel</label>
                            <input class="form-control" name="image" type="file">
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                    </div>
                </div>
            </form>
        </div>
        
   
        <div class="col-md-8">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while ($row = $result->fetch_assoc()) {
                            echo '<tr>
                                    <td><img src="../uploads/crousel/'.$row['image'].'" alt="News Image" width="50"></td>
                                    <td><a href="?action=delete&id='.$row['id'].'" class="btn btn-danger">Delete</a></td>
                                </tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
    include 'includes/footer.php';
?>
