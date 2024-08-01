<?php
require_once 'includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['status']) && $_POST['status'] == 'extra_setting') {
    $webTitle = isset($_POST['web_title']) ? $_POST['web_title'] : 'Website';
    $metaTitle = isset($_POST['meta_title']) ? $_POST['meta_title'] : '';
    $metaDescription = isset($_POST['meta_description']) ? $_POST['meta_description'] : '';
    $metaKeywords = isset($_POST['meta_keywords']) ? $_POST['meta_keywords'] : '';
    $metaAuthor = isset($_POST['meta_author']) ? $_POST['meta_author'] : '';
    $metaOgTitle = isset($_POST['meta_og_title']) ? $_POST['meta_og_title'] : '';
    $metaOgDescription = isset($_POST['meta_og_description']) ? $_POST['meta_og_description'] : '';

    $query = "INSERT INTO `links` (`type`, `label`, `link`) VALUES ('$type', '$label', '$link')";

    if ($con->query($query)) {
        echo '<script>alert("Successfully saved");</script>';
    } else {
        echo '<script>alert("Error: ' . $con->error . '");</script>';
    }
}
?>




<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['status']) && $_POST['status'] == 'metaform') {
        // Handle SEO Settings Form
        $webTitle = isset($_POST['web_title']) ? $_POST['web_title'] : 'Website';
        $metaTitle = isset($_POST['meta_title']) ? $_POST['meta_title'] : '';
        $metaDescription = isset($_POST['meta_description']) ? $_POST['meta_description'] : '';
        $metaKeywords = isset($_POST['meta_keywords']) ? $_POST['meta_keywords'] : '';
        $metaAuthor = isset($_POST['meta_author']) ? $_POST['meta_author'] : '';
        $metaOgTitle = isset($_POST['meta_og_title']) ? $_POST['meta_og_title'] : '';
        $metaOgDescription = isset($_POST['meta_og_description']) ? $_POST['meta_og_description'] : '';

        $seoQuery = "UPDATE `seo_settings` SET 
                     `web_title` = '$webTitle',
                     `meta_title` = '$metaTitle',
                     `meta_description` = '$metaDescription',
                     `meta_keywords` = '$metaKeywords',
                     `meta_author` = '$metaAuthor',
                     `meta_og_title` = '$metaOgTitle',
                     `meta_og_description` = '$metaOgDescription'
                     WHERE id = 1";
        if ($con->query($seoQuery)) {
            echo '<script>alert("SEO Settings Successfully Saved");</script>';
        } else {
            echo '<script>alert("Error: ' . $con->error . '");</script>';
        }
    } elseif (isset($_POST['status']) && $_POST['status'] == 'social_links') {
        // Handle Social Links Form
        $headerMobile = isset($_POST['header_mobile']) ? $_POST['header_mobile'] : '';
        $headerEmail = isset($_POST['header_email']) ? $_POST['header_email'] : '';
        $headerFacebook = isset($_POST['header_facebook']) ? $_POST['header_facebook'] : '';
        $headerTwitter = isset($_POST['header_twitter']) ? $_POST['header_twitter'] : '';
        $headerInstagram = isset($_POST['header_instagram']) ? $_POST['header_instagram'] : '';
        $headerLinkedin = isset($_POST['header_linkedin']) ? $_POST['header_linkedin'] : '';
        $headerYoutube = isset($_POST['header_youtube']) ? $_POST['header_youtube'] : '';

        $socialLinksQuery ="UPDATE `social_links` SET 
                             `header_mobile` = '$headerMobile',
                             `header_email` = '$headerEmail',
                             `header_facebook` = '$headerFacebook',
                             `header_twitter` = '$headerTwitter',
                             `header_instagram` = '$headerInstagram',
                             `header_linkedin` = '$headerLinkedin',
                             `header_youtube` = '$headerYoutube'
                             WHERE id = 1";

        if ($con->query($socialLinksQuery)) {
            echo '<script>alert("Social Links Successfully Saved");</script>';
        } else {
            echo '<script>alert("Error: ' . $con->error . '");</script>';
        }
    }
}
?>


       <?php
// Fetch SEO settings from the database
$seoSettings = $con->query("SELECT * FROM seo_settings")->fetch_assoc();

// Define default values in case settings are not found
$webTitle = isset($seoSettings['web_title']) ? $seoSettings['web_title'] : 'Website';
$metaTitle = isset($seoSettings['meta_title']) ? $seoSettings['meta_title'] : '';
$metaDescription = isset($seoSettings['meta_description']) ? $seoSettings['meta_description'] : '';
$metaKeywords = isset($seoSettings['meta_keywords']) ? $seoSettings['meta_keywords'] : '';
$metaAuthor = isset($seoSettings['meta_author']) ? $seoSettings['meta_author'] : '';
$metaOgTitle = isset($seoSettings['meta_og_title']) ? $seoSettings['meta_og_title'] : '';
$metaOgDescription = isset($seoSettings['meta_og_description']) ? $seoSettings['meta_og_description'] : '';
?> 
<?php
// Fetch existing social links from the database
$socialLinks = $con->query("SELECT * FROM social_links")->fetch_assoc();

// Define default values in case links are not found
$headerMobile = isset($socialLinks['header_mobile']) ? $socialLinks['header_mobile'] : '';
$headerEmail = isset($socialLinks['header_email']) ? $socialLinks['header_email'] : '';
$headerFacebook = isset($socialLinks['header_facebook']) ? $socialLinks['header_facebook'] : '';
$headerTwitter = isset($socialLinks['header_twitter']) ? $socialLinks['header_twitter'] : '';
$headerInstagram = isset($socialLinks['header_instagram']) ? $socialLinks['header_instagram'] : '';
$headerLinkedin = isset($socialLinks['header_linkedin']) ? $socialLinks['header_linkedin'] : '';
$headerYoutube = isset($socialLinks['header_youtube']) ? $socialLinks['header_youtube'] : '';
?>
        <div class="col-md-6">
            <form class="metaform" action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="status" value="metaform">
                <div class="box box-primary">
                    <div class="box-header">
                        <strong>SEO(Please fill the form tags change automatic)</strong>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text"  name="web_title" class="form-control" value="<?=$webTitle?>">
                        </div>
                        <div class="form-group">
                            <label>Meta Title</label>
                            <input type="text"  name="meta_title" class="form-control" value="<?=$metaTitle?>">
                        </div>
                        <div class="form-group">
                            <label>Meta Description</label>
                            <textarea  name="meta_description" class="form-control" ><?=$metaDescription?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Meta Keywords</label>
                            <input type="text"  name="meta_keywords" class="form-control" value="<?=$metaKeywords?>">
                        </div>
                        <div class="form-group">
                            <label>Meta Author</label>
                            <input type="text"  name="meta_author" class="form-control" value="<?=$metaAuthor?>">
                        </div>
                        <div class="form-group">
                            <label>Meta Og Title</label>
                            <input type="text"  name="meta_og_title" class="form-control" value="<?=$metaOgTitle?>">
                        </div>
                        <div class="form-group">
                            <label>Meta Og Description</label>
                            <textarea  name="meta_og_description" class="form-control" ><?=$metaOgDescription?></textarea>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                    </div>
                </div>
            </form>
            
        </div>
        <div class="col-md-6">
            <form class="social_links" action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="status" value="social_links">
                <div class="box box-primary">
                    <div class="box-header">
                        <strong>Social Links</strong>
                    </div>
                    <div class="box-body">
                        
                        <div class="form-group">
                            <label>Mobile</label>
                            <input type="text" min="1" name="header_mobile" class="form-control" value="<?=$headerMobile?>">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="header_email" class="form-control" value="<?=$headerEmail?>">
                        </div>
                        <div class="form-group">
                            <label>Facebook</label>
                            <input type="text" name="header_facebook" class="form-control" value="<?=$headerFacebook?>">
                        </div>
                        <div class="form-group">
                            <label>Twitter</label>
                            <input type="text" name="header_twitter" class="form-control" value="<?=$headerTwitter?>">
                        </div>
                        <div class="form-group">
                            <label>Instagram</label>
                            <input type="text" name="header_instagram" class="form-control" value="<?=$headerInstagram?>">
                        </div>
                        <div class="form-group">
                            <label>Linkedin</label>
                            <input type="text" name="header_linkedin" class="form-control" value="<?=$headerLinkedin?>">
                        </div>
                        <div class="form-group">
                            <label>Youtube</label>
                            <input type="text" name="header_youtube" class="form-control" value="<?=$headerYoutube?>">
                        </div>
                    </div>
                    <div class="box-footer">
                        <button class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                    </div>
                </div>
            </form>
            
        </div>
        
 



<?php
if ($_POST['submit'] == 'update_course') {
    $courseFile = photo_upload('course', 'index_course');
    $authorFile = photo_upload('author', 'index_course');

    if ($courseFile && $authorFile) {
      $con->query("INSERT INTO `index_course` ( `course_image`, `author_image`, `course_name`, `course_detail`) 
      VALUES ('".$courseFile['file_name']."','".$authorFile['file_name']."','".$_POST['course_name']."','".$_POST['detail']."')");


        echo '<script>alert("File Update Successfully.");window.location.href="setting_header.php"</script>';
    } else {
        echo '<script>alert("Error in file Uploading.");window.location.href="setting_header.php"</script>';
    }
}

if ($_GET['action'] == 'del') {
    $id = $_GET['id'];
    $con->query("DELETE FROM `index_course` WHERE `id` = '".$id."' ");
    echo '<script>alert("Deleted Successfully.");window.location.href="setting_header.php"</script>';
}
?>


<?php
if ($_POST['submit'] == 'update') {
    $id = 1;//$_POST['intro_id'];
    $file = photo_upload('image', 'intro');
    // echo '<pre>';
    // print_r($file);
    // exit;
    $sql = "UPDATE intro SET ";
    
    if(!empty($_FILES['image']['name'])){
        $sql .= " image = '".$file['file_name']."', ";
    }
    
    $sql .= "heading = '".$_POST['heading']."' , `description` = '".mysqli_real_escape_string($con,$_POST['description'])."', `btn_link` = '".$_POST['btn_link']."' WHERE `id` = '".$id."'";
    // exit($sql);
    $con->query($sql);
    // echo '<pre>';
    // print_r($con);
    // exit;
    
    //if ($con->query("UPDATE `intro` SET `heading` = '".$_POST['heading']."', `image` = '".$file['file_name']."', `description` = '".$_POST['description']."', `btn_link` = '".$_POST['btn_link']."' WHERE `id` = '".$id."'")) {
    //   mysqli_query($con,$sql);
        echo '<script>alert("File Update Successfully.");window.location.href="setting_header.php"</script>';
    // } else {
    //     echo '<script>alert("Error in file Uploading: ' . $con->error . '");</script>';
    //     echo '<script>window.location.href="setting_header.php"</script>';
    // }

    // if ($file) {
    //     $res = $con->query("UPDATE `intro` SET `heading` = '".$_POST['heading']."', `image` = '".$file['file_name']."', `description` = '".$_POST['description']."', `btn_link` = '".$_POST['btn_link']."' WHERE `id` = '".$id."'");
    //     var_dump($res);
    //     exit;
    //     echo '<script>alert("File Update Successfully.");window.location.href="setting_header.php"</script>';
    // } else {
    //     echo '<script>alert("Error in file Uploading.");window.location.href="setting_header.php"</script>';
    // }
}


if ($_GET['action'] == 'del') {
    $id = $_GET['id'];
    $con->query("DELETE FROM `intro` WHERE `id` = '".$id."' ");
    echo '<script>alert("Deleted Successfully.");window.location.href="setting_header.php"</script>';
}

$intro = "select * from `intro`";
$result =  $con->query($intro);
$r = $result->fetch_assoc();
?>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <form action="" method="POST" enctype="multipart/form-data">
                    <!--<input type="hidden" name="type" value="< ?=$type?>">-->
                    <div class="box box-primary">
                        <div class="box-header">
                            <strong>Welcome Intro (Only UPDATES)</strong>
                        </div>
                        <div class="box-body">
                           
                            <div class="form-group">
                        
                                <label>Heading</label>
                                <input type="text" name="heading" class="form-control" value="<?=$r['heading']?>" placeholder="Enter Welcome Heading">
                            </div>
                             <div class="form-group">
                        
                                <label>Image</label>
                                <input type="file" name="image" class="form-control" placeholder="Enter Welcome Heading">
                                <img src="../uploads/intro/<?=$r['image']?>" width="400" height="150" style="margin-top:20px">
                            </div>
                            
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" class="form-control" ><?=$r['description']?></textarea>
                                <!--<textarea type="message" name="description" class="form-control" placeholder=" Enter Description"></-->
                            </div>
                             <div class="form-group">
                                <label>link</label>
                                <input type="text" name="btn_link" value="<?=$r['btn_link']?>" class="form-control" placeholder=" Enter Link">
                            </div>
                            
                        </div>
                        <div class="box-footer">
                            <button type="submit" name="submit" value="update" class="btn btn-success"><i class="fa fa-save"></i> Update</button>
    
                        </div>
                        
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <form action="" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="type" value="<?=$type?>">
                    <div class="box box-primary">
                        <div class="box-header">
                            <strong>Our Course</strong>
                        </div>
                        <div class="box-body">
                           
                                    <div class="form-group">
                                
                                        <label>Course Image</label>
                                        <input type="file" name="course" class="form-control" >
                                    </div>
                                     <div class="form-group">
                                
                                        <label>Author Image</label>
                                        <input type="file" name="author" class="form-control" >
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Course Name</label>
                                        <input type="text" name="course_name" class="form-control" placeholder=" Enter Course Name">
                                    </div>
                                     <div class="form-group">
                                        <label>Course Detail</label>
                                        <input type="text" name="detail" class="form-control" placeholder=" Enter Course Detail">
                                    </div>
                                   
                                </div>
                        <div class="box-footer">
                            <button type="submit" name="submit" value="update_course" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                        </div>
                    </div>
               
                </form>
                
            </div>      
        </div>
            
            
    </div>
       <?php

// Fetch the courses
$courses = $con->query("SELECT * FROM index_course");
?>

<div class="col-md-12">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
            <div class="box-header">
                <strong>Our Courses</strong>
            </div>
                <div class="box-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Course Image</th>
                                <th>Author Image</th>
                                <th>Course Name</th>
                                <th>Course Detail</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Loop through the courses
                            while ($course = $courses->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><img src="../uploads/index_course/<?=$course['course_image']; ?>" alt="Course Image" class="img-thumbnail" width="100"></td>
                                <td><img src="../uploads/index_course/<?=$course['author_image']; ?>" alt="Author Image" class="img-thumbnail" width="100"></td>
                                <td><?=$course['course_name']; ?></td>
                                <td><?=$course['course_detail']; ?></td>
                                <td>
                                    <a href="setting_header.php?action=del&id=<?=$course['id']; ?>" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
        </div>
        </div>
    </div>
</div>


    
        
        <!--<div class="col-md-6">-->
        <!--    <form action="" method="POST" enctype="multipart/form-data">-->
        <!--        <input type="hidden" name="type" value="<?=$type?>">-->
        <!--        <div class="box box-primary">-->
        <!--            <div class="box-header">-->
        <!--                <strong>Our Course</strong>-->
        <!--            </div>-->
        <!--            <div class="box-body">-->
                       
        <!--                        <div class="form-group">-->
                            
        <!--                            <label>Course Image</label>-->
        <!--                            <input type="file" name="course" class="form-control" >-->
        <!--                        </div>-->
        <!--                         <div class="form-group">-->
                            
        <!--                            <label>Author Image</label>-->
        <!--                            <input type="file" name="author" class="form-control" >-->
        <!--                        </div>-->
                                
        <!--                        <div class="form-group">-->
        <!--                            <label>Course Name</label>-->
        <!--                            <input type="text" name="course_name" class="form-control" placeholder=" Enter Course Name">-->
        <!--                        </div>-->
        <!--                         <div class="form-group">-->
        <!--                            <label>Course Detail</label>-->
        <!--                            <input type="text" name="detail" class="form-control" placeholder=" Enter Course Detail">-->
        <!--                        </div>-->
                               
        <!--                    </div>-->
        <!--                     <div class="box-footer">-->
        <!--                <button type="submit" name="submit" value="update_course" class="btn btn-success"><i class="fa fa-save"></i> Update</button>-->

        <!--            </div>-->
        <!--                </div>-->
        <!--            </div>-->
                   
        <!--        </div>-->
        <!--    </form>-->
            
        <!--</div>-->


<?
    include 'includes/footer.php';
?>