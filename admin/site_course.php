<? require_once 'includes/header.php';
if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $con->query("INSERT INTO `site_courses` (`id`, `timestamp`,`title`, `eligibility`, `duration`, `content`) VALUES (NULL, CURRENT_TIMESTAMP, '".$_POST['title']."', '".$_POST['eligibility']."', '".$_POST['duration']."', '".$_POST['content']."')");
    echo '<script>alert("Course add successfully");location.href="site_course.php"</script>';
}
if($_GET['type'] == 'delete')
{
    $con->query("DELETE FROM site_courses where id = '".$_GET['id']."'");
    echo '<script>alert("Delete success");location.href="site_course.php"</script>';
}
?>
<div class="box box-success">
    <div class="box-header"><h4>Add Course Categary</h4></div>
    <div class="box-body">
        <form method="post">
            <!-- <div class="form-group col-md-6">-->
            <!--    <label>Course Code</label>-->
            <!--    <input type="number" class="form-control" name="course_code" placeholder="Enter Course code" required>-->
            <!--</div>-->
            <div class="form-group col-md-6">
                <label>Course Categary Title</label>
                <input type="text" class="form-control" name="title" placeholder="Enter Course Title" required>
            </div>
            <div class="form-group col-md-6">
                <label>Eligibility</label>
                <input type="text" class="form-control" name="eligibility" placeholder="Enter Eligibility" required>
            </div>
            <div class="form-group col-md-6">
                <label>Duration</label>
                <input type="text" class="form-control" name="duration" placeholder="Enter Duration" required>
            </div>
            <!--<div class="form-group col-md-12">-->
            <!--    <label>Content</label>-->
            <!--    <textarea  class="form-control ckeditor" name="content" ></textarea>-->
            <!--</div>-->
            <div class="form-group col-md-12">
                <button class="btn btn-success">Submit</button>
            </div>
        </form>
    </div>
</div>
<div class="box box-info">
    <div class="box-header"><h4>List</h4></div>
    <div class="box-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Eligibility</th>
                    <th>Duration</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?
                    $i=1;
                    $get = $con->query("SELECT * FROM site_courses");
                    while($g = $get->fetch_assoc())
                    {
                        echo '<tr>
                                <td>'.$i++.'</td>
                                <td>'.ucwords($g['title']).'</td>
                                <td>'.$g['eligibility'].'</td>
                                <td>'.$g['duration'].'</td>
                                <td>
                                    <a onclick="return confirm(\'Are you sure?\')" href="edit_site_course.php?id='.$g['id'].'&type=edit" class="btn btn-primary fa fa-edit"></a>
                                </td>
                                <td>
                                    <a onclick="return confirm(\'Are you sure?\')" href="?id='.$g['id'].'&type=delete" class="btn btn-danger fa fa-trash"></a>
                                </td>
                        </tr>';
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>

<? require_once 'includes/footer.php'?>