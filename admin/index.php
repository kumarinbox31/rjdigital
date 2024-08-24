<?php
include 'includes/header.php';

if ($_POST['status'] == 'study_material') {
   

     $linkUrl = $_POST['link_url'];
   
   
    if(!$linkUrl == ''){
       
    $con->query("INSERT INTO `notification` (title,link_url, description) VALUE ('".$_POST['title']."','$linkUrl', '".$_POST['description']."')");

    // print_r($_POST);
    // exit;
    echo '<script>alert("Center Notification Uploaded Succesfully")</script>';
    }
    else{
        echo '<script>alert("Please Fill all Inputs")</script>';
    }
    
}
if ($_GET['action'] == 'delete') {
    $id = $_GET['id'];
    
    $con->query("Delete from `notification` WHERE id = '$id'");
    echo '<script>alert("Center Notification is deleted.");window.location.href="index.php"</script>';
}


/*
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h5>UPLOAD New Notification</h5>
    </div>
    <form method="post" action="" enctype="multipart/form-data">
        <div class="panel-body">
            
            <div class="form-group">
                <label>Title</label>
                <input type="text" class="form-control" name="title" placeholder="Enter the Title" required>
            </div>
            
            <div class="form-group">
                <label>Link URL</label>
                <input type="text" class="form-control" name="link_url" placeholder="https://example.com/study_material.pdf" >
            </div>

            <div class="form-group">
                <label>Description</label>
                <input type="text" class="form-control" name="description" required>
            </div>
             
        </div>
        <div class="panel-footer">
            <button type="submit" class="btn btn-sm btn-success" name="status" value="study_material"><i class="fa fa-save"></i>Save</button>
        </div>
    </form>
</div>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h5> Update New Notification</h5>
    </div>
    <div class="panel-body">
        <table id="centerTable" class="table table-bordered data-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Document Name / Link</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
         <?php
        $get = $con->query("SELECT * FROM `notification`");
        $i = 1;
        if ($get->num_rows) {
            while ($row = $get->fetch_assoc()) {
                echo '<tr>
                        <td>' . $i++ . '</td>
                        <td>' . $row['title'] . '</td>
                        <td><a href="'.$row['link_url'].'" target="_blank">'.$row['link_url'].'</a></td>
                        <td>'.$row['description'].'</td>
                        <td>
                           
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
*/
include 'includes/footer.php';
?>
