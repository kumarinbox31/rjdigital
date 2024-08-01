<?
require_once 'includes/header.php';
if($_POST['status']=='update')
{
		
			$con->query("UPDATE `site_courses` SET `title` = '".$_POST['title']."', `eligibility` = '".$_POST['eligibility']."', `duration` = '".$_POST['duration']."', `content` = '".$_POST['content']."' WHERE `site_courses`.`id` = '".$_GET['id']."'");
			
			echo '<script>alert("Details are update success.");location.href="edit_site_course.php?id='.$_GET['id'].'"</script>';
}
$get = $con->query("SELECT * FROM site_courses where id = '".$_GET['id']."'")->fetch_assoc();
?>
<div class="box box-primary">
	<div class="box-header"><h3>Edit Site Courses</h3></div>
	<div class="box-body">
		<form action="" method="post" enctype="multipart/form-data">
			<div class="form-group col-md-12">
                <label>Course Title</label>
                <input type="text" class="form-control" name="title" placeholder="Enter Course Title" value="<?= $get['title'];?>" required>
            </div>
            <div class="form-group col-md-6">
                <label>Eligibility</label>
                <input type="text" class="form-control" name="eligibility" placeholder="Enter Eligibility" value="<?= $get['eligibility'];?>" required>
            </div>
            <div class="form-group col-md-6">
                <label>Duration</label>
                <input type="text" class="form-control" name="duration" placeholder="Enter Duration" value="<?= $get['duration'];?>" required>
            </div>
            <div class="form-group col-md-12">
                <label>Content</label>
                <textarea  class="form-control ckeditor" name="content" >
                    <?= $get['content'];?>
                </textarea>
            </div>
            
			<div class="form-group col-xs-12 col-md-12 col-lg-12">
				<button class="btn btn-primary" type="submit" name="status" value="update"><i class="fa fa-save"></i> Submit</button>
			</div>
		</form>
	</div>
</div>
<?
include 'includes/footer.php';
?>