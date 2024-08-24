<?php
   require_once 'admin/includes/config.php'; 
   
   function photo_upload($file,$path)
   {
   $allowedExts = array("gif","jpeg","jpg","png");
   $temp = explode(".",$_FILES[$file]["name"]);
   $extension = end($temp);
   $return = array();
   if((($_FILES[$file]["type"] == "image/gif")
   ||($_FILES[$file]["type"] == "image/jpeg")
   ||($_FILES[$file]["type"] == "image/jpg")
   ||($_FILES[$file]["type"] == "image/pjpeg")
   ||($_FILES[$file]["type"] == "image/x-png")
   ||($_FILES[$file]["type"] == "image/png"))
   && in_array($extension, $allowedExts))
   {
     if($_FILES[$file]["error"]>0)
     {
       echo '<div class="alert alert-danger">Return Code: '.$_FILES[$file]["error"].'</div>';
     }
     else
     {
       $_FILESName = $temp[0].".".$temp[1];
       $temp[0] = rand(0,3000);
   
       if(file_exists("<?=THEME_PATH?>/uploads/".$path.'/'.$_FILES[$file]["name"]))
       {
         $return['error'] = '<div class="alert alert-danger">'.$_FILES[$file]["name"].'Already Exists</div>';
       }
       else
       {
       //   $newfilename = time().end(explode('.',$_FILES[$file]["name"]));
         
         $originalFilename = $_FILES[$file]["name"];
           $fileExtension = pathinfo($originalFilename, PATHINFO_EXTENSION);
          $uniqueIdentifier = uniqid(); // Generates a unique identifier
           
         $newfilename = 'product__' . $uniqueIdentifier . '.' . $fileExtension;
   
         
         $aa = 'product__'.$newfilename;
         $a = 'uploads/'.$path.'/'.$aa;
         $photo_address = '../uploads/';
         $z = move_uploaded_file($_FILES[$file]["tmp_name"], $a);
         $return['file_name'] = $aa;
         $return['status'] = 1;
       }
     }
   }
   else
   {
     $return['status'] = 0;
   }
   return $return;
   }
   if(isset($_POST['status']) && $_POST['status']=='center_login')
   {
     $post = $_POST;
     $username = mysqli_real_escape_string($con,$post['username']);
     $password = mysqli_real_escape_string($con,$post['password']);
     $login = $con->query("SELECT * FROM centers where username = '".$username."' AND password = '".$password."' AND status = 1");
     if($login->num_rows)
     {
       $row = $login->fetch_assoc();
       $rand = rand(111111,999999);
       $_SESSION['center']['id'] = $row['id'];
       $_SESSION['center']['session_id'] = $rand;
       $_SESSION['center']['login'] = TRUE;
       $sess = $con->query("INSERT INTO `check_session` (`id`, `timestamp`, `user_id`, `session_id`) VALUES (NULL, CURRENT_TIMESTAMP, ' ".$row['id']."','".$rand."')");
       if($sess){
       echo '<script>location.href="center/"</script>';
       }
     }
     else
     {
       echo '<script>alert("Invalid Login");location.href="center_login.php"</script>';
     }
   }
   if(isset($_POST['status']) && $_POST['status']=='student_login')
   {
     $post = $_POST;
     $username = mysqli_real_escape_string($con,$post['username']);
     $password = mysqli_real_escape_string($con,$post['password']);
     $login = $con->query("SELECT * FROM students where username = '".$username."' AND password = '".$password."' AND status = 1");
     if($login->num_rows)
     {
       $row = $login->fetch_assoc();
       $rand = rand(111111,999999);
       $_SESSION['student']['id'] = $row['id'];
       $_SESSION['student']['session_id'] = $rand;
       $_SESSION['student']['login'] = TRUE;
       $con->query("INSERT INTO `check_session` (`id`, `timestamp`, `user_id`, `session_id`) VALUES (NULL, CURRENT_TIMESTAMP, '".$row['id']."', '".$rand."')");
       echo '<script>alert("Login Success.");location.href="/"</script>';
     }
     else
     {
       echo '<script>alert("Invalid Login");location.href="student_login.php"</script>';
     }
   }
   if(isset($_POST['status']) && $_POST['status']=='contact_query')
   {
   if($_SESSION['digit']==$_POST['captcha'])
   {
       $chk = $con->query("INSERT INTO `contact_query` (`id`, `timestamp`, `name`, `mobile`, `email`, `message`) VALUES (NULL, CURRENT_TIMESTAMP, '".$_POST['name']."', '".$_POST['mobile']."', '".$_POST['email']."', '".$_POST['message']."')");
       echo '<script>alert("Your query is sent.");location.href="/"</script>';
   }
   else
   {
        echo '<script>alert("Invalid Captcha!!");location.href="contact_us.php"</script>';
   }
   
   }
   $setting = [];
   $set = $con->query("SELECT * FROM setting");
   while($rr = $set->fetch_assoc())
   $setting[$rr['type']] = $setting[$rr['id']] = $rr['value'];
   $logo = $con->query("SELECT * FROM logo_setting where id = 1")->fetch_assoc();
   define('WEB_LOGO','uploads/logo/'.$logo['logo']);
   define('WEB_FAVICON','uploads/logo/'.$logo['favicon']);
   function getSetting($key,$res=''){
   global $setting;
   if(isset($setting[$key])){
       $res = $setting[$key];
   }
   return $res;
   }
   
   
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
   
  $logo = $con->query("SELECT  * FROM logo_setting where id = 1")->fetch_assoc(); 
   ?>
<!DOCTYPE html>
<html class="">
   <head>
      <title><?=$webTitle?></title>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <link rel="shortcut icon" href="uploads/logo/<?=$logo['favicon']?>">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
      <META HTTP-EQUIV="EXPIRES" CONTENT="0">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="<?=$metaDescription?>">
      <meta name="keywords" content="<?=$metaKeywords?>">
      <link rel="stylesheet" type="text/css" href="<?=THEME_PATH?>/css/bootstrap.css">
      <link rel="stylesheet" type="text/css" href="<?=THEME_PATH?>/css/revolution-slider.css">
      <link rel="stylesheet" type="text/css" href="<?=THEME_PATH?>/css/style.css">
      <link rel="stylesheet" type="text/css" href="<?=THEME_PATH?>/css/responsive.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
     
   </head>
   <body>
      <div class="page-wrapper">
         <!-- Main Header / Header Style One-->
         <header class="main-header header-style-one">
            <!-- Header Top -->
            <div class="header-top">
               <div class="auto-container clearfix">
                  <!--Top Left-->
                  <div class="column col-lg-8 col-md-8 col-sm-12 col-xs-12">
                     <center>
                        <style>
                           input[type="date"] {
    padding-bottom: 33px; /* Adjust the value as needed */
}

   							.text-white {
                           color: #fff !important;
                           }
                           .list-inline {
                           padding-left: 0;
                           margin-left: -5px;
                           list-style: none;
                           }
                           .list-inline>li {
                           display: inline-block;
                           margin-top: 5px;
                           margin-bottom: 5px;
                           padding-right: 10px;
                           margin-left:4px;
                           font-weight: 800;
                           background-color:#D9EEE1;
                           border-radius: 10px;
                           }
                           .pl-10 {
                           padding-left: 10px !important;
                           }
                           .text-black {
                           color: #000 !important;
                           }
                           .list-inline>li:hover {
                           background: #FFF4A3;
                           }
                        </style>
                        <ul class="list-inline sm-pull-none sm-text-center text-white mb-sm-20 mt-10" style="font-size:14px;padding-inline-start: 1px;">
                           <!--<li class=" pl-10"><a href="contact-us.html" class="text-black"> Enquiry Here</a></li>-->
                           <!-- <li class=" pl-10"><a href="<?=BASE_URL?>list_center.php" class="text-black">Franchise Details</a></li>
                           <li class=" pl-10"><a href="<?=BASE_URL?>franchisee_form.php" class="text-black">Apply Franchise</a></li>
                           <li class=" pl-10"><a href="<?=BASE_URL?>center_login.php" target="_blank" class="text-black">Franchise Login</a></li> -->
                           <!-- <li class=" pl-10"><a href="<?=BASE_URL?>admin" target="_blank" class="text-black"> Admin Login</a></li> -->
                           <!-- <li class="pl-10"><a href="<?=BASE_URL?>student_login.php" class="text-black">Student Login</a></li> -->
                           <!--<a href="<?=THEME_PATH?>/new" class="text-white m-0 pl-10 mt-0" target="_blank"><span class="btn btn-theme-colored2 btn-xs">Login</span></a>-->  
                        </ul>
                     </center>
                  </div>
                  <!--Top Right-->
                  <div class="column col-lg-4 col-md-4 col-sm-12 col-xs-12">
                     <center>
                        <ul class="links-nav clearfix" style="margin-top:10px;">
                           <li><a href="tell:<?=$headerMobile?>" target="_blank" style="color:#fff;"><span class=" fa fa-phone"></span><?=$headerMobile?></a></li>
                           <li><a href="<?=$headerFacebook?>" target="_blank"><span class=" fa fa-facebook"></span></a></li>
                           <li><a href="<?=$headerTwitter?>" target="_blank"><span class="fa fa-twitter"></span></a></li>
                           <li><a href="<?=$headerYoutube?>" target="_blank"><span class="fa fa-youtube"></span></a></li>
                           <li><a href="<?=$headerLinkdln?>" target="_blank"><span class="fa fa-linkedin"></span></a></li>
                        </ul>
                     </center>
                  </div>
               </div>
            </div>
            <!-- Header Top End -->
            <!--Header-Upper-->
            <div class="header-upper">
               <div class="auto-container">
                  <div class="clearfix">
                     <div class="pull-left logo-outer">
                        <div class="logo">
                           <a href="/">
                           <img src="uploads/logo/<?=$logo['logo']?>" alt="Digital Computer institute logo" 
                        style="margin-top:5px; margin-bottom:5px;">
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="header-lower">
               <div class="auto-container">
                  <div class="nav-outer clearfix">
                     <?/*<!-- Main Menu -->
                     <nav class="main-menu">
                        <div class="navbar-header">
                           <!-- Toggle Button -->
                           <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                           </button>
                        </div>
                        <div class="navbar-collapse collapse clearfix">
                           <ul class="navigation clearfix">
                              <li class="current"><a href="index.php">Home</a></li>
                              <li class="dropdown">
                                 <a href="javascript:return(0);">About Us</a>
                                 <ul>
                                    <li><a href="pageca5d.html?id=TVRnPQ==">Our Profile</a></li>
                                    <li><a href="pagef7db.html?id=TVRrPQ==">Chairman Message</a></li>
                                    <li><a href="page0f4f.html?id=TWpBPQ==">Our Vision & Mission</a></li>
                                 </ul>
                              </li>
                              <li class="dropdown">
                                 <a href="javascript:return(0);">Courses</a>
                                 <ul>
                                    <li><a href="courses52ef.html?cid=TVE9PQ==">Diploma Courses </a></li>
                                    <li><a href="coursesd64f.html?cid=TkE9PQ==">Vocational Courses</a></li>
                                    <li><a href="courses49d9.html?cid=TlE9PQ==">YOGA Courses</a></li>
                                    <li><a href="coursesf73a.html?cid=T1E9PQ==">University Courses</a></li>
                                 </ul>
                              </li>
                              <li class="dropdown">
                                 <a href="javascript:return(0);">Student Zone</a>
                                 <ul>
                                    <li><a href="registration_process.html">Registration Process</a></li>
                                    <li><a href="examination_process.html">Examination Process</a></li>
                                    <li><a href="registration.html">  Student Registration</a></li>
                                    <li><a href="download-admitcard.html">  Admit Card</a></li>
                                    <li><a href="marksheet-verification.html">Marksheet verification</a></li>
                                    <li><a href="certificate-verification.html">Certificate Verification</a></li>
                                    <li><a href="verification.html">Student Verification</a></li>
                                    <li><a href="login.html">Student Login</a></li>
                                    <li><a href="login.html">Online Exam</a></li>
                                    <li><a href="placement.html">Placement</a></li>
                                 </ul>
                              </li>
                              <li class="dropdown">
                                 <a href="javascript:return(0);">Franchise</a>
                                 <ul>
                                    <li><a href="franchise-enquiry.html">Apply Online</a></li>
                                    <li><a href="centre-verification.html">Centre Verification</a></li>
                                    <li><a href="franchise.php">Get Franchise</a></li>
                                 </ul>
                              </li>
                              <li><a href="publications.html">Our Publications</a></li>
                              <li class="dropdown">
                                 <a href="javascript:return(0);">Gallery</a>
                                 <ul>
                                    <li><a href="photos.html">Photos</a></li>
                                    <li><a href="videos.html">Videos</a></li>
                                 </ul>
                              </li>
                              <li class="dropdown">
                                 <a href="javascript:return(0);">Login</a>
                                 <ul>
                                    <li><a href="<?=THEME_PATH?>/new/index.html" target="_blank">Admin Login</a></li>
                                    <li><a href="<?=THEME_PATH?>/new/index.html" target="_blank">Franchise Login</a></li>
                                    <li><a href="<?=THEME_PATH?>/new/index.html" target="_blank">Employee Login</a></li>
                                    <li><a href="login.html" >Student Login</a></li>
                                    <li><a href="webmail.html" target="_blank">Webmail Login</a></li>
                                 </ul>
                              </li>
                              <li><a href="#"></a></li>
                              <li class="dropdown">
                                 <a href="javascript:return(0);">Contact</a>
                                 <ul>
                                    <li><a href="contact-us.html">Contact Us</a></li>
                                    <li><a href="find_branch.html">Find Branch</a></li>
                                 </ul>
                              </li>
                           </ul>
                        </div>
                     </nav>
                     <!-- Main Menu End-->
                     */
                    include 'navbar.php';
                    ?>
                     <!-- <div class="btn-outer"><a href="/franchisee_form.php" class="theme-btn quote-btn"><span class="fa fa-user"></span> Apply Franchise </a></div> -->
                  </div>
               </div>
            </div>
            <!--Header-Lower-->
            <!--// < ?php-->
            <!--//     include 'navbar.php';-->
            <!--// ? >-->
            <!--Sticky Header-->
            <div class="sticky-header">
               <div class="auto-container clearfix">
                  <!--Logo-->
                  <div class="logo pull-left">
                     <a href="/" class="img-responsive"><img src="uploads/logo/<?=$logo['logo']?>" 
                    width="300px" alt="Digital Computer institute"></a>
                  </div>
                  <!--Right Col-->
                  <div class="right-col pull-right">

                    <?
                    include 'navbar.php';
                    /* <!-- Main Menu -->
                     <nav class="main-menu">
                        <div class="navbar-header">
                           <!-- Toggle Button -->
                           <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                           </button>
                        </div>
                        <div class="navbar-collapse collapse clearfix">
                           <ul class="navigation clearfix">
                              <li class="current"><a href="index-2.html">Home</a></li>
                              <li class="dropdown">
                                 <a href="javascript:return(0);">About Us</a>
                                 <ul>
                                    <li><a href="pageca5d.html?id=TVRnPQ==">Our Profile</a></li>
                                    <li><a href="pagef7db.html?id=TVRrPQ==">Chairman Message</a></li>
                                    <li><a href="page0f4f.html?id=TWpBPQ==">Our Vision & Mission</a></li>
                                 </ul>
                              </li>
                              <li class="dropdown">
                                 <a href="javascript:return(0);">Courses</a>
                                 <ul>
                                    <li><a href="courses52ef.html?cid=TVE9PQ==">Diploma Courses </a></li>
                                    <li><a href="coursesd64f.html?cid=TkE9PQ==">Vocational Courses</a></li>
                                    <li><a href="courses49d9.html?cid=TlE9PQ==">YOGA Courses</a></li>
                                    <li><a href="coursesf73a.html?cid=T1E9PQ==">University Courses</a></li>
                                 </ul>
                              </li>
                              <li class="dropdown">
                                 <a href="javascript:return(0);">Student Zone</a>
                                 <ul>
                                    <li><a href="registration_process.html">Registration Process</a></li>
                                    <li><a href="examination_process.html">Examination Process</a></li>
                                    <li><a href="registration.html">  Student Registration</a></li>
                                    <li><a href="download-admitcard.html">  Admit Card</a></li>
                                    <li><a href="marksheet-verification.html">Marksheet verification</a></li>
                                    <li><a href="certificate-verification.html">Certificate Verification</a></li>
                                    <li><a href="verification.html">Student Verification</a></li>
                                    <li><a href="login.html">Student Login</a></li>
                                    <li><a href="login.html">Online Exam</a></li>
                                    <li><a href="placement.html">Placement</a></li>
                                 </ul>
                              </li>
                              <li class="dropdown">
                                 <a href="javascript:return(0);">Franchise</a>
                                 <ul>
                                    <li><a href="franchise-enquiry.html">Apply Online</a></li>
                                    <li><a href="centre-verification.html">Centre Verification</a></li>
                                    <li><a href="franchise.php">Get Franchise</a></li>
                                    <li><a href="why_gbge.html">Why GBGE</a></li>
                                 </ul>
                              </li>
                              <li><a href="publications.html">Our Publications</a></li>
                              <li class="dropdown">
                                 <a href="javascript:return(0);">Gallery</a>
                                 <ul>
                                    <li><a href="photos.html">Photos</a></li>
                                    <li><a href="videos.html">Videos</a></li>
                                 </ul>
                              </li>
                              <li class="dropdown">
                                 <a href="javascript:return(0);">Login</a>
                                 <ul>
                                    <li><a href="<?=THEME_PATH?>/new/index.html" target="_blank">Admin Login</a></li>
                                    <li><a href="<?=THEME_PATH?>/new/index.html" target="_blank">Franchise Login</a></li>
                                    <li><a href="<?=THEME_PATH?>/new/index.html" target="_blank">Employee Login</a></li>
                                    <li><a href="login.html" >Student Login</a></li>
                                    <li><a href="webmail.html" target="_blank">Webmail Login</a></li>
                                 </ul>
                              </li>
                              <li class="dropdown">
                                 <a href="javascript:return(0);">Contact</a>
                                 <ul>
                                    <li><a href="contact-us.html">Contact Us</a></li>
                                    <li><a href="find_branch.html">Find Branch</a></li>
                                 </ul>
                              </li>
                           </ul>
                        </div>
                     </nav>
                     <!-- Main Menu End-->
                     */?>
                  </div>
               </div>
            </div>
            <!--End Sticky Header-->
         </header>
         
         