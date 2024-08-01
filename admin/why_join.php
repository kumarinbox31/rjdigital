<? require 'includes/header.php'?>
<?
    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $image = photo_upload('image','logo');
        if($image['status'])
        {
            $con->query("INSERT INTO `why_join` (`id`, `timestamp`, `image`, `title`, `content`) VALUES (NULL, CURRENT_TIMESTAMP, '".$image['file_name']."', '".$_POST['title']."', '".$_POST['content']."')");
            echo '<script>alert("Data successfully add.");location.href="why_join.php"</script>';
        }
        else
        {
            echo '<script>alert("Error in image uploading...");location.href="why_join.php"</script>';
        }
    }
    if($_GET['type'] == 'delete')
    {
        $con->query("DELETE FROM why_join where id = '".$_GET['id']."'");
        echo '<script>alert("Deleted");location.href="why_join.php"</script>';
    }
?>
<div class="col-md-6">
    <div class="box box-success">
        <div class="box-header"><h4>Add </h4></div>
        <div class="box-body">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" name="title" placeholder="Enter Title" required>
                </div>
                <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control" required>
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="content" placeholder="Enter Description..."></textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="box box-primary">
        <div class="box-header"><h4>List </h4></div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?
                                $i=1;
                                $get = $con->query("SELECT * FROM  why_join");
                                while($g = $get->fetch_assoc())
                                {
                                    echo '<tr>
                                            <td>'.$i++.'</td>
                                            <td>
                                                <a href="../uploads/logo/'.$g['image'].'" target="_blank">'.ucwords($g['title']).'</a>
                                            </td>
                                            <td>'.$g['content'].'</td>
                                            <td>
                                                <a href="?id='.$g['id'].'&type=delete&file='.$g['image'].'" class="btn btn-danger fa fa-trash btn-xs"></a>
                                            </td>
                                    </tr>';
                                }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<? require 'includes/footer.php'?>