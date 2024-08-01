<? require 'includes/header.php'?>
<?
if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    if(!empty($_FILES['image']['name']))
    {
        $image = photo_upload('image','site_manager');
        if($image['status'])
        {
            $con->query("INSERT INTO `logos` (`id`, `timestamp`, `image`) VALUES (NULL, CURRENT_TIMESTAMP, '".$image['file_name']."')");
            echo '<script>alert("Success");location.href="logos.php"</script>';
        }
        else
        {
            echo '<script>alert("Error in image uploading...");location.href="logos.php"</script>';
        }
    }
}
?>
<div class="box box-success">
    <div class="box-header"><h4>Our Certificates(Remove the (' ','.','-') from image name)</h4></div>
    <div class="box-body">
        <form class="form-inline" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <input type="text" class="form-control" name="status" placeholder="Enter Title" required>
            </div>
            <div class="form-group">
                <input type="file" name="image" class="form-control" required>
            </div>
            <div class="form-group">
                <button class="btn btn-success" >Submit</button>
            </div>
        </form>
    </div>
</div>

<? require 'includes/footer.php'?>