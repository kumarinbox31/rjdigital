<?
require_once 'includes/header.php';
if($_POST['status']=='study_material')
{
   
          $filename = time().$_FILES['image']['name'];

            // destination of the file on the server
            $destination = '../uploads/study_material/' . $filename;
        
            // get the file extension
            $extension = pathinfo($filename, PATHINFO_EXTENSION);
       
            // the physical file on a temporary uploads directory on the server
            $file = $_FILES['image']['tmp_name'];
            $size = $_FILES['image']['size'];
        
            if (!in_array($extension, ['jpg', 'pdf', 'docx', 'jpeg', 'png'])) {
               
                echo '<script>alert("You file extension must be .png, .pdf, .docx, .jpg, .jpeg");location.href="material.php"</script>';
            } elseif ($_FILES['image']['size'] > 100000000) { // file shouldn't be larger than 1Megabyte
               
                echo '<script>alert("File too large!");location.href="material.php"</script>';
            } else {
                // move the uploaded (temporary) file to the specified destination
                if (move_uploaded_file($file, $destination)) {
                    $sql = "INSERT INTO `study_material` (`id`, `timestamp`, `description`, `file`) VALUES (NULL, CURRENT_TIMESTAMP, '".$_POST['title']."', '".$filename."')";
                    if (mysqli_query($con, $sql)) {
                  
                          echo '<script>alert("File uploaded successfully");location.href="material.php"</script>';
                    }
                } else {
                 
                     echo '<script>alert("Failed to upload file.");location.href="material.php"</script>';
                }
            }
    
}
if($_GET['action']=='del')
{
    if(file_exists("../uploads/study_material/".$_GET['file']))
        unlink("../uploads/study_material/".$_GET['file']);
    $con->query("DELETE FROM study_material where id = '".$_GET['id']."'");
    echo '<script>alert("File Delete Success");location.href="material.php"</script>';
}
?>
<div class="box box-success">
    <div class="box-header"><h3>Site Download Manager</h3></div>
    <div class="box-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Title</label>
                <input type="file" name="image" class="form-control" placeholder="Enter Title" required>
            </div>
            <div class="form-group">
                <label>Upload File</label>
                <input type="" name="title" class="form-control"  required>
            </div>
            <div class="form-group">
                <button class="btn btn-success" type="submit" name="status" value="study_material"><i class="fa fa-upload"></i> Upload</button>
            </div>
        </form>
    </div>
    <div class="box-footer">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>title</th>
                    <th>File</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?
                $i=1;
                    $get = $con->query("SELECT * FROM study_material");
                    while($g = $get->fetch_assoc())
                    {
                        echo '<tr>
                                <td>'.$i++.'</td>
                                <td>'.$g['title'].'</td>
                                <td><a href="download_file.php?file='.$g['file'].'" target="_blank" class="btn btn-success"><i class="fa fa-download"></i><a/></td>
                                <td><a href="?id='.$g['id'].'&action=del&file='.$g['file'].'" class="btn btn-danger"><i class="fa fa-trash"></i><a/></td>
                                
                        </tr>';
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?
include 'includes/footer.php';
?>