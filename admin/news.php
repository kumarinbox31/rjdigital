<?php
    include 'includes/header.php';

    // Handle delete request
    if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $con->query("DELETE FROM `news` WHERE `id` = $id");
        echo '<script>alert("Success");location.href="news.php"</script>';
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!empty($_FILES['image']['name'])) {
            $image = photo_upload('image', 'news');
            if ($image['status']) {
                $con->query("INSERT INTO `news` (`id`, `timestamp`, `image`, `date`, `heading`, `description`) 
                VALUES (NULL, CURRENT_TIMESTAMP, '".$image['file_name']."','".$_POST['date']."','".$_POST['heading']."','".$_POST['description']."')");
                echo '<script>alert("Success");location.href="news.php"</script>';
            } else {
                echo '<script>alert("Error in image uploading...");location.href="news.php"</script>';
            }
        }
    }

    // Fetch all news
    $query = "SELECT * FROM `news`";
    $result = $con->query($query);
?>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <form method="post" enctype="multipart/form-data">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h2>Add Recently news</h2>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label>News</label>
                            <input class="form-control" name="image" type="file">
                        </div>
                        <div class="form-group">
                            <label>Date</label>
                            <input type="date" class="form-control" name="date">
                        </div>
                        <div class="form-group">
                            <label>Heading</label>
                            <input type="text" class="form-control" name="heading">
                        </div>
                        <div class="form-group">
                            <label>Description </label>
                            <input type="text" class="form-control" name="description">
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                    </div>
                </div>
            </form>
        </div>
        
    </div>
</div>
<div class="row mt-4">
        <div class="col-md-12">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Date</th>
                        <th>Heading</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while ($row = $result->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td><img src="../uploads/news/'.$row['image'].'" alt="News Image" width="50"></td>';
                            echo '<td>'.$row['date'].'</td>';
                            echo '<td>'.$row['heading'].'</td>';
                            echo '<td>'.$row['description'].'</td>';
                            echo '<td><a href="?action=delete&id='.$row['id'].'" class="btn btn-danger">Delete</a></td>';
                            echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>


<?php
    include 'includes/footer.php';
?>
