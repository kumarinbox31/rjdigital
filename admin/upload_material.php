<?php
include 'includes/header.php';

if ($_POST['status'] == 'study_material') {
    $img = image_upload('image', 'study_material');
    if ($img['status']) {
        $image = $img['file_name'];
    } else {
        $image = $img['error'];
    }

     $linkUrl = $_POST['link_url'];
    $fileName = $_FILES['image']['name'];
    // $selecttype = $_POST['type'];
    
   
    if(!$fileName == '' || !$linkUrl == ''){
       
    $con->query("INSERT INTO `study_material` (file,link_url, description,type) VALUE ('$fileName','$linkUrl', '".$_POST['description']."','".$_POST['type']."')");

    // print_r($_POST);
    // exit;
    echo '<script>alert("Study material Uploaded Succesfully")</script>';
    }
    else{
        echo '<script>alert("Please upload the document")</script>';
    }
    
}
if ($_GET['action'] == 'delete') {
    $id = $_GET['id'];
    
    $con->query("Delete from `study_material` WHERE id = '$id'");
    echo '<script>alert("Document is deleted.");window.location.href="upload_material.php"</script>';
}



?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h5>UPLOAD Study Material</h5>
    </div>
    <form method="post" action="" enctype="multipart/form-data">
        <div class="panel-body">
            <div class="form-group">
                <label>Upload File (PDF, Word, or PowerPoint)</label>
                <input type="file" class="form-control" name="image" >
            </div>
            <div class="form-group">
                <label>Link URL</label>
                <input type="text" class="form-control" name="link_url" placeholder="https://example.com/study_material.pdf" >
            </div>

            <div class="form-group">
                <label>Description</label>
                <input type="text" class="form-control" name="description" required>
            </div>
             <div class="form-group">
                 <label>Select Type</label>
                <select name="type" class="form-control">
                    <option>-- Select Type --</option>
                    <option value="course">Course</option>
                    <option value="software">Software</option>
                    <option value="video_training">Video Training</option>
                </select>
            </div>
        </div>
        <div class="panel-footer">
            <button type="submit" class="btn btn-sm btn-success" name="status" value="study_material"><i class="fa fa-save"></i>Save</button>
        </div>
    </form>
</div>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h5>All Update Study Material</h5>
    </div>
    <div class="panel-body">
        <table id="centerTable" class="table table-bordered data-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Date</th>
            <th>Document Name / Link</th>
            <th>Description</th>
            <th>Type</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $get = $con->query("SELECT * FROM `study_material`");
        $i = 1;
        if ($get->num_rows) {
            while ($row = $get->fetch_assoc()) {
                echo '<tr>
                        <td>' . $i++ . '</td>
                        <td>' . $row['date'] . '</td>
                        <td>';
                if (!empty($row['link_url'])) {
                    // Display the link URL as a hyperlink
                    echo '<a href="' . $row['link_url'] . '" target="_blank">' . $row['link_url'] . '</a>';
                } else {
                    // Display the file name
                    echo $row['file'];
                }
                echo '</td>
                        <td>' . $row['description'] . '</td>
                        <td>'.$row['type'].'</td>
                        <td>
                            <a href="' . $row['link_url'] . '" target="_blank" class="btn btn-sm btn-success"><i class="fa fa-download"></i> Google Drive</a>
                            <a href="'.BASE_URL.'uploads/study_material/' . $row['file'] . '" target="_blank" class="btn btn-sm btn-success"><i class="fa fa-download"></i> Download</a>
                            <a href="?action=delete&id=' . $row['id'] . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Are You Sure You Want to Permanently Delete This Item?\')"><i class="fa fa-trash"></i></a>
                        </td>
                        
                      </tr>';
            }
        }
        ?>
    </tbody>
</table>

    </div>
</div>
<?php
include 'includes/footer.php';
?>
