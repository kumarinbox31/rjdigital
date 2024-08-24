<?php
// session_start();
require 'config.php';
date_default_timezone_set('Asia/Kolkata');
// die();
if(isset($_SESSION['admin']))
{
  $get = $con->query("SELECT * FROM check_session where user_id = '".$_SESSION['admin']['id']."' AND session_id = '".$_SESSION['admin']['session_id']."'");
 
  if(!($get->num_rows))
    header('location:login.php');
}
else
  header('location:login.php');
$setting = [];
$set = $con->query("SELECT * FROM setting");
while($rr = $set->fetch_assoc())
    $setting[$rr['type']] = $setting[$rr['id']] = $rr['value'];
    
   
function redirect($page = 'index.php'){
        echo '<script>
                location.href = "'.$page.'";
        </script>';
}

function getSetting($key,$res=''){
    global $setting;
    if(isset($setting[$key])){
        $res = $setting[$key];
    }
    return $res;
}
define('ADMIN_TYPE',$_SESSION['admin']['type']);
function permission($name,$type=ADMIN_TYPE){
    global $con;
    if($type=='Admin'){
        return true;
    }else{
        $chk = $con->query("Select * from login_permission WHERE type = '$type'");
        if($chk->num_rows){
            $row = $chk->fetch_assoc();
            $per = $row['permissions'];
            if($per != ''){
                $per = (array)json_decode($per);
                return in_array($name,$per);
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="theme/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="theme/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="theme/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="theme/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="theme/dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="theme/bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="theme/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="theme/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="theme/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="theme/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
  <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>-->
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.3/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.3/dist/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
    <style>
        .myInput,.myInput:active{
            border: none;
            font-weight: bold;
            width:100%;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <!-- end message -->
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        AdminLTE Design Team
                        <small><i class="fa fa-clock-o"></i> 2 hours</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Developers
                        <small><i class="fa fa-clock-o"></i> Today</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Sales Department
                        <small><i class="fa fa-clock-o"></i> Yesterday</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Reviewers
                        <small><i class="fa fa-clock-o"></i> 2 days</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                      page and may cause design problems
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-red"></i> 5 new members joined
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-user text-red"></i> You changed your username
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Create a nice theme
                        <small class="pull-right">40%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">40% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Some task I need to do
                        <small class="pull-right">60%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Make beautiful transitions
                        <small class="pull-right">80%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">80% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="theme/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs">Admin</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="theme/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                 Admin
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
          <img src="theme/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Admin</p>
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
        <li class="treeview">
         <a href="#">
            <i class="fa fa-file"></i>
            <span>Pages</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
         </a>
          <ul class="treeview-menu">
            <li><a href="pages.php"><i class="fa fa-circle-o"></i> Add Page</a></li>
            <li><a href="list_page.php"><i class="fa fa-circle-o"></i> List Page</a></li>
            
          </ul>
        </li>
        <li class="treeview">
         <a href="#">
            <i class="fa fa-file"></i>
            <span>Slider</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
         </a>
          <ul class="treeview-menu">
            <li><a href="slider.php"><i class="fa fa-circle-o"></i> Add Slider</a></li>
            <li><a href="list_slider.php"><i class="fa fa-circle-o"></i> List Slider</a></li>
            
          </ul>
        </li>
        <li class="treeview">
         <a href="#">
            <i class="fa fa-file"></i>
            <span>Menu</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
         </a>
          <ul class="treeview-menu">
            <li><a href="menu.php"><i class="fa fa-circle-o"></i> Add Menu</a></li>
           
            
          </ul>
        </li>
        <li><a href="site_course.php"><i class="fa fa-book"></i> <span>Course Category</span></a></li>
        <li><a href="courses.php"><i class="fa fa-book"></i> <span> Courses</span></a></li>
        <li><a href="create_talent_certificate.php"><i class="fa fa-book"></i> <span> Computer Talent Certificate</span></a></li>
         
        
      <?/*  
        <li class="treeview">
         <a href="#">
            <i class="fa fa-file"></i>
            <span>Exam Area</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
         </a>
          <ul class="treeview-menu">
              <li><a href="exam-area.php"><i class="fa fa-circle-o"></i>  Exam Section</a></li>
            <!--<li><a href="list_centers.php"><i class="fa fa-circle-o"></i> List Centers Payment Complete</a></li>-->
            <li><a href="student-exams.php"><i class="fa fa-circle-o"></i> Student's Exams</a></li>
            <!-- <li><a href="list_products.php"><i class="fa fa-circle-o"></i> List Designing</a></li> -->
            
            
          </ul>
        </li>
        */?>
        <li class="treeview">
         <a href="#">
            <i class="fa fa-file"></i>
            <span>Center</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
         </a>
          <ul class="treeview-menu">
              <li><a href="edit_center.php"><i class="fa fa-circle-o"></i> List Franchise</a></li>
            <!--<li><a href="list_centers.php"><i class="fa fa-circle-o"></i> List Centers Payment Complete</a></li>-->
            <li><a href="create_center.php"><i class="fa fa-circle-o"></i> Create Center</a></li>
            <!-- <li><a href="list_products.php"><i class="fa fa-circle-o"></i> List Designing</a></li> -->
            
            
          </ul>
        </li>
        
        <li><a href="gallery_category.php"><i class="fa fa-gear"></i> Gallery Category</a></li>
        <li><a href="gallery_image.php"><i class="fa fa-gear"></i> Image Gallery</a></li>
       
      <?/* 
       <li class="treeview">
         <a href="#">
            <i class="fa fa-file"></i>
            <span>Students</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
         </a>
          <ul class="treeview-menu">
              <li><a href="student_form.php"><i class="fa fa-circle-o"></i> <span>Add Student</span></a></li>
              <li><a href="all_students.php"><i class="fa fa-circle-o"></i> <span>  Students List By Center</span></a></li>
              <li><a href="all_students_list.php"><i class="fa fa-circle-o"></i> <span>All  Students</span></a></li>
              <!--<li><a href="all_students.php"><i class="fa fa-circle-o"></i> <span>All  Students Payment Success</span></a></li>-->
                <!--<li><a href="all_students_failed.php"><i class="fa fa-circle-o"></i> <span>All  Students Payment Failed</span></a></li>-->
            
          </ul>
        </li>
          <li class="treeview">
         <a href="#">
            <i class="fa fa-file"></i>
            <span>Placement & Staff</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
         </a>
          <ul class="treeview-menu">
              <li><a href="placed_stu.php"><i class="fa fa-circle-o"></i> <span>Add placed Student</span></a></li>
              <li><a href="our_team.php"><i class="fa fa-circle-o"></i> <span>Add Team Member</span></a></li>
             
              <!--<li><a href="all_students.php"><i class="fa fa-circle-o"></i> <span>All  Students Payment Success</span></a></li>-->
                <!--<li><a href="all_students_failed.php"><i class="fa fa-circle-o"></i> <span>All  Students Payment Failed</span></a></li>-->
            
          </ul>
        </li>
        
        <li class="treeview">
         <a href="#">
            <i class="fa fa-file"></i>
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
        */?>
        <!--<li class="treeview">-->
        <!-- <a href="#">-->
        <!--    <i class="fa fa-file"></i>-->
        <!--    <span>Result</span>-->
        <!--    <span class="pull-right-container">-->
        <!--      <i class="fa fa-angle-left pull-right"></i>-->
        <!--    </span>-->
        <!-- </a>-->
        <!--  <ul class="treeview-menu">-->
        <!--    <li><a href="create_result.php"><i class="fa fa-circle-o"></i> Create Result</a></li>-->
        <!--    <li><a href="get_result.php"><i class="fa fa-circle-o"></i> Get Result</a></li>-->
            
        <!--  </ul>-->
        <!--</li>-->
        <?/*
        <li class="treeview">
         <a href="#">
            <i class="fa fa-file"></i>
            <span>Students Certificates</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
         </a>
          <ul class="treeview-menu">
            <li><a href="create_certificate.php"><i class="fa fa-circle-o"></i> Create Certificate</a></li>
            <li><a href="get_certificate.php"><i class="fa fa-circle-o"></i> Get Certificate</a></li>
            
          </ul>
        </li>
        <li class="treeview">
         <a href="#">
            <i class="fa fa-file"></i>
            <span>Study Material</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
         </a>
          <ul class="treeview-menu">
            <li><a href="upload_material.php"><i class="fa fa-circle-o"></i> Upload Material</a></li>
            <li><a href="list_material.php"><i class="fa fa-circle-o"></i> List Material</a></li>
            
          </ul>
        </li>
        
        <li class="treeview">
         <a href="#">
            <i class="fa fa-file"></i>
            <span>Downloads</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
         </a>
          <ul class="treeview-menu">
            <li><a href="assignment.php"><i class="fa fa-circle-o"></i> Upload Downloads</a></li>
            
            
          </ul>
        </li>
        <li class="treeview">
         <a href="#">
            <i class="fa fa-file"></i>
            <span>News</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
         </a>
          <ul class="treeview-menu">
            <li><a href="news.php"><i class="fa fa-circle-o"></i> Upload News</a></li>
            
            
          </ul>
        </li>
         */?>
       
     <!--   <li class="treeview">
         <a href="#">
            <i class="fa fa-file"></i>
            <span>Designing</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
         </a>
          <ul class="treeview-menu">
            <li><a href="products.php"><i class="fa fa-circle-o"></i> Add Designing</a></li>
            <li><a href="list_products.php"><i class="fa fa-circle-o"></i> List Designing</a></li>
            
          </ul>
        </li>
        <li class="treeview">
         <a href="#">
            <i class="fa fa-file"></i>
            <span>Blogs</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
         </a> 
          <ul class="treeview-menu">
            <li><a href="add_blog.php"><i class="fa fa-circle-o"></i> Add Blog</a></li>
           <li><a href="list_products.php"><i class="fa fa-circle-o"></i> List Designing</a></li> 
             
          </ul>
        </li-->
<li><a href="videos.php"><i class="fa fa-book"></i> <span>Videos</span></a></li>>
<li><a href="logos.php"><i class="fa fa-users"></i> <span>Our Certificates</span></a></li>

<!--<li><a href="courses.php"><i class="fa fa-book"></i> <span> Courses</span></a></li>-->
<li><a href="contact_query.php"><i class="fa fa-gear"></i> <span> Contact Queries</span></a></li>
<!--<li><a href="contact_us.php"><i class="fa fa-gear"></i> <span>Contact Us</span></a></li>-->
<!-- <li><a href="manage_download.php"><i class="fa fa-download"></i> <span>Manage Download</span></a></li> -->
<!-- <li><a href="site_manager.php"><i class="fa fa-download"></i> <span>Site Manager</span></a></li> -->
<!-- <li><a href="students_files.php"><i class="fa fa-download"></i> <span>Student Download Files</span></a></li> -->
<li class="treeview">
     <a href="#">
        <i class="fa fa-gears"></i>
        <span>Settings</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
     </a>
      <ul class="treeview-menu">
          <li><a href="setting_header.php"><i class="fa fa-circle-o"></i> <span> Header </span></a></li>
          <li><a href="middle_content.php"><i class="fa fa-circle-o"></i><span>Middle</span></a></li>
          <li><a href="setting_footer.php"><i class="fa fa-circle-o"></i> <span> Footer </span></a></li>
          <li><a href="setting_footer_images.php"><i class="fa fa-circle-o"></i> <span> Footer Images </span></a></li>
          <li><a href="change_password.php"><i class="fa fa-circle-o"></i> <span> Change Password </span></a></li>
          <li><a href="logo_setting.php"><i class="fa fa-circle-o"></i> <span>Logo Setting</span></a></li>
          <!-- <li><a href="payment_system.php"><i class="fa fa-circle-o"></i> <span> Payment Settings</span></a></li> -->
          <li><a href="use_page_items.php"><i class="fa fa-circle-o"></i> <span> Use Page Items </span></a></li>
      </ul>
    </li>
<li class="treeview">
     <a href="#">
        <i class="fa fa-gears"></i>
        <span>Extra Settings</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
     </a>
      <ul class="treeview-menu">
          <?    
            $extra = ['contact_form','notices','helpline_numbers','history','schemes','student_corner','faculty_corner','covid_info','scholarship','international','governance','digital_initiatives'];
            foreach($extra as $row){
                echo '<li><a href="setting.php?page='.$row.'"><i class="fa fa-circle-o"></i> <span> '.ucwords(str_replace('_',' ',$row)).' </span></a></li>';
            }
          ?>
      </ul>
    </li>
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
  <?php
function photo_upload($file, $path)
{
    $allowedExts = array("gif", "jpeg", "jpg", "png", "pdf");
    $temp = explode(".", strtolower($_FILES[$file]["name"]));
    $extension = end($temp);
    $return = array();
    array('pdf', 'doc', 'docx', 'ppt', 'pptx');

    $return['status'] = 0;
    if ((($_FILES[$file]["type"] == "image/gif")
        || ($_FILES[$file]["type"] == "image/jpeg")
        || ($_FILES[$file]["type"] == "image/jpg")
        || ($_FILES[$file]["type"] == "image/pjpeg")
        || ($_FILES[$file]["type"] == "image/x-png")
        || ($_FILES[$file]["type"] == "image/png")
        || ($_FILES[$file]["type"] == 'application/pdf')
        || ($_FILES[$file]["type"] == 'application/doc')
        || ($_FILES[$file]["type"] == 'application/docx')
        || ($_FILES[$file]["type"] == 'application/ppt')
        || ($_FILES[$file]["type"] == 'application/pptx'))
        && in_array($extension, $allowedExts))
    {
        if ($_FILES[$file]["error"] > 0)
        {
            $return['error'] = '<div class="alert alert-danger">Return Code: ' . $_FILES[$file]["error"] . '</div>';
        }
        else
        {
            $_FILESName = $temp[0] . "." . $temp[1];
            $temp[0] = rand(0, 3000);

            if (file_exists("../uploads/" . $path . '/' . $_FILES[$file]["name"]))
            {
                $return['error'] = '<div class="alert alert-danger">' . $_FILES[$file]["name"] . 'Already Exists</div>';
            }
            else
            {
                $newfilename = time();
                $tempArray = explode('..', $_FILES[$file]["name"]);
                $aa = 'product__' . $newfilename . end($tempArray);

                $a = '../uploads/' . $path . '/' . $aa;
                $photo_address = '../uploads/';
                $z = move_uploaded_file($_FILES[$file]["tmp_name"], $a);

                $return['file_name'] = $aa;
                $return['status'] = 1;
            }
        }
    }
    return $return;
}

function files_upload($file, $path)
{
    ini_set("memory_limit", "-1");
    $allowedExts = array("jpg", "jpeg", "gif", "png", "mp3", "mp4", "wma");
    $temp = explode(".", strtolower($_FILES[$file]["name"]));
    $extension = end($temp);
    $return = array();

    $return['status'] = 0;
    if ((($_FILES["file"]["type"] == "video/mp4")
        || ($_FILES["file"]["type"] == "audio/mp3")
        || ($_FILES["file"]["type"] == "audio/wma")
        || ($_FILES["file"]["type"] == "image/pjpeg")
        || ($_FILES["file"]["type"] == "image/gif")
        || ($_FILES["file"]["type"] == "image/jpeg"))
        && in_array($extension, $allowedExts))
    {
        if ($_FILES[$file]["error"] > 0)
        {
            $return['error'] = '<div class="alert alert-danger">Return Code: ' . $_FILES[$file]["error"] . '</div>';
        }
        else
        {
            $_FILESName = $temp[0] . "." . $temp[1];
            $temp[0] = rand(0, 3000);

            if (file_exists("../uploads/" . $path . '/' . $_FILES[$file]["name"]))
            {
                $return['error'] = '<div class="alert alert-danger">' . $_FILES[$file]["name"] . 'Already Exists</div>';
            }
            else
            {
                $newfilename = time();
                $tempArray = explode('..', $_FILES[$file]["name"]);
                $aa = 'product__' . $newfilename . end($tempArray);

                $a = '../uploads/' . $path . '/' . $aa;
                $photo_address = '../uploads/';
                $z = move_uploaded_file($_FILES[$file]["tmp_name"], $a);

                $return['file_name'] = $aa;
                $return['status'] = 1;
            }
        }
    }
    return $return;
}


function image_upload($file, $path)
{
    $allowedExts = array("gif", "jpeg", "jpg", "png", "pdf");
    $return = array('status' => 0);
// print_r($_FILES[$file]);
//         exit;
    if (
        in_array($_FILES[$file]["type"], array(
            "image/gif",
            "image/jpeg",
            "image/jpg",
            "image/pjpeg",
            "image/x-png",
            "image/png",
            "application/pdf",
            "application/doc",
            "application/docx",
            "application/ppt",
            "application/pptx",
            "application/vnd.openxmlformats-officedocument.wordprocessingml.document"
        ))
    ) {
        if ($_FILES[$file]["error"] > 0) {
            $return['error'] = '<div class="alert alert-danger">Return Code: ' . $_FILES[$file]["error"] . '</div>';
        } else {
            $originalFilename = $_FILES[$file]["name"];
            $destination = '../uploads/' . $path . '/' . $originalFilename;

            if (move_uploaded_file($_FILES[$file]["tmp_name"], $destination)) {
    $return['file_name'] = $originalFilename;
    $return['status'] = 1;
} else {
    $return['error'] = '<div class="alert alert-danger">Failed to upload file. Check folder permissions and paths.</div>';
    error_log("File upload failed: " . $_FILES[$file]["error"]);
}

        }
    } else {
        $return['error'] = '<div class="alert alert-danger">Invalid file format.</div>';
    }
// print_r($return);
// exit;
    return $return;
}


?>