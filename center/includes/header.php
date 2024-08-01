<?
require_once 'config.php';
if(isset($_SESSION['center']['id']))
{
  //$get = $con->query("SELECT * FROM check_session where user_id = '".$_SESSION['center']['id']."' AND session_id = '".$_SESSION['center']['session_id']."'");
  //if(!($get->num_rows))
  //{
      
  }
else
  echo '<script>location.href="../center_login.php"</script>';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Center | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../admin/theme/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../admin/theme/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../admin/theme/bower_components/Ionicons/css/ionicons.min.css">
  <!-- ../admin/theme style -->
  <link rel="stylesheet" href="../admin/theme/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../admin/theme/dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="../admin/theme/bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../admin/theme/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="../admin/theme/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../admin/theme/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../admin/theme/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>C</b>TR</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Center</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        
      </a>
      <span style="font-size: xx-large;font-family: math;color: white;">Balance:<i class="fa fa-rupee"></i><?=wallet($_SESSION['center']['id']);?></span>
        
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
         
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="../admin/theme/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs">Center</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="../admin/theme/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                 Center
                  <small>Member since Feb. 2020</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../admin/theme/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Center</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active ">
          <a href="index.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
        </li>
        
        <!--<li class="">-->
        <!--  <a href="id_card.php">-->
        <!--    <i class="fa fa-dashboard"></i> <span>Generate Id card</span>-->
        <!--    </a>-->
        <!--</li>-->
     
        
       
               
        <li class="treeview">
         <a href="#">
            <i class="fa fa-gear"></i>
            <span>Students</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
         </a>
          <ul class="treeview-menu">
           <li><a href="student_form.php"><i class="fa fa-circle-o"></i> <span>Student Form</span></a></li>
           <li><a href="all_students.php"><i class="fa fa-circle-o"></i> <span>All Students</span></a></li>
            <!--<li><a href="all_students_failed.php"><i class="fa fa-circle-o"></i> <span>Student List Payment Failed</span></a></li>-->
          </ul>
        </li>
        <!--<li class="treeview">-->
        <!-- <a href="#">-->
        <!--    <i class="fa fa-gear"></i>-->
        <!--    <span>Id Card</span>-->
        <!--    <span class="pull-right-container">-->
        <!--      <i class="fa fa-angle-left pull-right"></i>-->
        <!--    </span>-->
        <!-- </a>-->
        <!--  <ul class="treeview-menu">-->
           <!--<li><a href="create_id_card.php"><i class="fa fa-circle-o"></i> <span>Generate Id Card</span></a></li>-->
        <!--   <li><a href="get_id_card.php"><i class="fa fa-circle-o"></i> <span>Get Id Card</span></a></li>-->
            <!--<li><a href="all_students_failed.php"><i class="fa fa-circle-o"></i> <span>Student List Payment Failed</span></a></li>-->
        <!--  </ul>-->
        <!--</li>-->
        <!--<li class="treeview">-->
        <!--    <a href="#">-->
        <!--        <i class="fa fa-gear"></i>-->
        <!--        <span>Fee Card</span>-->
        <!--        <span class="pull-right-container">-->
        <!--            <i class="fa fa-angle-left pull-right"></i>-->
        <!--        </span>-->
        <!--    </a>-->
        <!--    <ul class="treeview-menu">-->
        <!--        <li><a href="get_fee_card.php"><i class="fa fa-circle-o"></i><span>Get Fee Card</span></a></li>-->
        <!--    </ul>-->
        <!--</li>-->
        <li class="treeview">
         <a href="#">
            <i class="fa fa-gear"></i>
            <span>Admit Card</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
         </a>
          <ul class="treeview-menu">
            <li><a href="create_admit_card.php"><i class="fa fa-circle-o"></i> Generate Admit Card</a></li>
            <li><a href="get_admit_card.php"><i class="fa fa-circle-o"></i>Show Admit Card </a></li>
            
          </ul>
        </li>
        <!--<li class="treeview">
         <a href="#">
            <i class="fa fa-gear"></i>
            <span>Result</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
         </a>
          <ul class="treeview-menu">
            <li><a href="create_result.php"><i class="fa fa-circle-o"></i> Create Result</a></li>
            <li><a href="get_result.php"><i class="fa fa-circle-o"></i> Get Result</a></li>
            
          </ul>
        </li> -->
        <li class="treeview">
         <a href="#">
            <i class="fa fa-gear"></i>
            <span>Students Certificates</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
         </a>
          <ul class="treeview-menu">
            <!--<li><a href="create_certificate.php"><i class="fa fa-circle-o"></i> Create Certificate</a></li>-->
            <li><a href="get_certificate.php"><i class="fa fa-circle-o"></i> Get Certificate</a></li>
            
          </ul>
          
        </li>
        <!--<li class="treeview">-->
        <!-- <a href="#">-->
        <!--    <i class="fa fa-gear"></i>-->
        <!--    <span>Typing Certificates</span>-->
        <!--    <span class="pull-right-container">-->
        <!--      <i class="fa fa-angle-left pull-right"></i>-->
        <!--    </span>-->
        <!-- </a>-->
        <!--  <ul class="treeview-menu">-->
        <!--    <li><a href="create_typing_certificate.php"><i class="fa fa-circle-o"></i> Create Certificate</a></li>-->
        <!--    <li><a href="get_typing_certificate.php"><i class="fa fa-circle-o"></i> Get Certificate</a></li>-->
            
        <!--  </ul>-->
          
        </li>
        <li class="treeview">
         <a href="#">
            <i class="fa fa-gear"></i>
            <span>Center Certificates</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
         </a>
          <ul class="treeview-menu">
            <li><a href="get_center_certificate.php"><i class="fa fa-circle-o"></i> Get Certificate</a></li>
            
            
          </ul>
          
        </li>
        <li class="treeview">
         <a href="#">
            <i class="fa fa-gear"></i>
            <span>Study</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
         </a>
          <ul class="treeview-menu">
            <li><a href="download_material.php"><i class="fa fa-circle-o"></i> Download Study Material</a></li>
            <li><a href="download_course.php"><i class="fa fa-circle-o"></i> Course Details</a></li>
            <li><a href="download_software.php"><i class="fa fa-circle-o"></i> Download Software</a></li>
            <li><a href="download_video.php"><i class="fa fa-circle-o"></i> Video Training</a></li>
            
            
          </ul>
          
        </li>
         <li class="treeview">
         <a href="#">
            <i class="fa fa-gear"></i>
            <span>Assignment</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
         </a>
          <ul class="treeview-menu">
            <li><a href="assignment.php"><i class="fa fa-circle-o"></i>List Assignments</a></li>
            
            
          </ul>
          
        </li>
        <li class="treeview">
         <a href="#">
            <i class="fa fa-gear"></i>
            <span>All Document</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
         </a>
          <ul class="treeview-menu">
            <li><a href="all_certificates.php"><i class="fa fa-circle-o"></i> Download All Document</a></li>
            
            
          </ul>
          
        </li>
        <!--<li class="treeview">-->
        <!--    <a href="#">-->
        <!--        <i class="fa fa-gear"></i>-->
        <!--        <span>Get all Documents</span>-->
        <!--        <span class="pull-right-container">-->
        <!--            <i class="fa fa-angle-left pull-right"></i>-->
        <!--        </span>-->
        <!--    </a>-->
        <!--    <ul class="treeview-menu">-->
        <!--        <li><a href="get_all_document.php"><i class="fa fa-circle-o"></i>Download all document</a></li>-->
        <!--    </ul>-->
        <!--</li>-->
        <li><a href="show_notification.php"><i class="fa fa-envelope"></i> <span>All Notifications</span></a></li>
        <li><a href="change_password.php"><i class="fa fa-gear"></i> <span>Setting</span></a></li>
 <!--       <li><a href="wallet.php"><i class="fa fa-money"></i> <span>Wallet</span></a></li>-->
 <!--<li><a href="fee_collection.php"><i class="fa fa-money"></i> <span>Fee Collection</span></a></li>-->
<!-- <li><a href="manage_download.php"><i class="fa fa-download"></i> <span>Manage Download</span></a></li> -->
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside><div class="content-wrapper">
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
      <section class="content">
          
  <?
function photo_upload($file,$path)
{
  $allowedExts = array("gif","jpeg","jpg","png","pdf");
  $temp = explode(".",$_FILES[$file]["name"]);
  $extension = end($temp);
  $return = array();
  if((($_FILES[$file]["type"] == "image/gif")
  ||($_FILES[$file]["type"] == "image/jpeg")
  ||($_FILES[$file]["type"] == "image/jpg")
  ||($_FILES[$file]["type"] == "image/pjpeg")
  ||($_FILES[$file]["type"] == "image/x-png")
  ||($_FILES[$file]["type"] == "image/png")
  ||($_FILES[$file]["type"] == 'application/pdf'))
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

      if(file_exists("../uploads/".$path.'/'.$_FILES[$file]["name"]))
      {
        $return['error'] = '<div class="alert alert-danger">'.$_FILES[$file]["name"].'Already Exists</div>';
      }
      else
      {
        $newfilename = time().end(explode('..',$_FILES[$file]["name"]));
        $aa = 'product__'.$newfilename;
        $a = '../uploads/'.$path.'/'.$aa;
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
?>