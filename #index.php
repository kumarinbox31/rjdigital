<?
require 'includes/header.php';
$page_id = isset($_GET['page_id'])?$_GET['page_id']:1;
$pages = $con->query("SELECT * FROM `his_page` WHERE `id` = '".$page_id."'")->fetch_assoc();
$content = $pages['content'];    
$page_id = $pages['id'];
define('DEFAULT_PAGE','1');

if(DEFAULT_PAGE == $page_id){
?>
    <div class="container-fluid ml-0 wow fadeInUp">
        <div class="row">
            <div class="col-sm-9 mt-1" style="margin-right: 0 !important; ">
                <div id="wowslider-container1" style="margin: 0 !important;">
                    <div class="ws_images">
                        <ul>
                            <?
                                $slider = $con->query("SELECT * FROM sliders WHERE type = 'main'");
                    				while($s = $slider->fetch_assoc())
                    				{
                    				    echo '<li><img style="height: 100%"
                                            src="'.BASE_URL.'uploads/'.$s['image'].'"
                                            alt="..."></li>';
                    				}
                            ?>
                        </ul>
                    </div>
                    <div class="ws_bullets">
                        <div>
                            <a href="#" title="download (1)"><span>1</span></a>
                            <a href="#" title="drithi-patel-photoshoot-jan2021-rps1"><span>2</span></a>
                        </div>
                    </div>
                    <div class="ws_script" style="position:absolute;left:-99%"><a href="/">image
                            slider</a></div>
                    <div class="ws_shadow"></div>
                </div>
                <script type="text/javascript" src="<?=THEME_PATH?>assets/root/engine1/wowslider.js"></script>
                <script type="text/javascript" src="<?=THEME_PATH?>assets/root/engine1/script.js"></script>
            </div>
            <div class="col-sm-3 mt-1">
                <div class="card shadow" style="border: none !important;">
                    <h2 class="section-header shadow">Arcade Family</h2>
                    <div id="newsup" class="input-group text-center">
                        <marquee behavior="scroll" direction="up" height="320" onMouseOver="this.stop();"
                            onMouseOut="this.start();" scrollamount="3">
                            <?
                                $slider = $con->query("SELECT * FROM sliders where type = 'secondary'");
                    				while($s = $slider->fetch_assoc())
                    				{
                                        echo '<p align="center">
                                                <img src="'.BASE_URL.'uploads/'.$s['image'].'"
                                                    alt="" style="width:125px;height:150px; margin-left:10px; margin-top:4px;  "
                                                    title="" id="wows1_1">\';
                                            </p>
                                            <p class="text-center">
                                                <b>
                                                    '.$s['content'].'</b>
                                            </p>
                                            ';
                    				}
                            ?>
                        </marquee>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?
}

define('CONTENT',$content);
$schema = $con->query("SELECT * FROM `web_schema` WHERE `page_id` = '$page_id' ORDER BY `sort` ASC  ");
while($s = $schema->fetch_assoc()){
    echo '<main id="main">';
    arrangePage($s['type'],$s['key_id']);
    echo '</main>';
}

function arrangePage($type,$key){
    switch($type){
        case 'content':
            echo '<div class="container">';
            echo CONTENT;
            echo '</div>';
        break;
        case $type:
            if(function_exists($type))
                $type();
        break;
    }
}

function get_verification(){
?>
<div class="container-lg mt-3 bg-white d-none d-md-block">
        <div class="row g-0">
            <div class="col-12 col-md-6">
            <div class="card border-0 w-100 bg-warning text-dark">
              <div class="card-body">
                <h5 class="card-title">Student Login</h5>
                <form method="POST" action="">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control bg-white" name="username"  placeholder="Username" required autocomplete="off">
                    <label class="text-dark" for="username">Username</label>
                  </div>
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control bg-white" name="password"  placeholder="Password" required autocomplete="off">
                    <label class="text-dark" for="password">Password</label>
                  </div>
                  <button type="submit" name="status" value="student_login" class="btn btn-dark"><i class="bi bi-person-check-fill"></i> | Submit</button>
                </form>
              </div>
            </div>
          </div>

          <div class="col-12 col-md-6">
            <div class="card border-0 w-100">
              <div class="card-body">
                <h5 class="card-title">Center Login</h5>
                <form method="POST" action="">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control bg-white" name="username"  placeholder="Username" required autocomplete="off">
                    <label class="text-dark" for="username">Username</label>
                  </div>
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control bg-white" name="password"  placeholder="Password" required autocomplete="off">
                    <label class="text-dark" for="password">Password</label>
                  </div>
                  <button type="submit" name="status" value="center_login" class="btn btn-primary"><i class="bi bi-patch-check-fill"></i> | Submit</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
<div class="container-lg bg-white mt-3 d-block d-md-none">
        <div class="row g-0">
            <div class="col-3 ">
              <div class="d-flex align-items-start">
                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                  <button class="nav-link active p-1" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true"><small>Center Verification</small></button>
                  <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false"><small>Student Verification</small></button>
                  <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false"><small>Certificate Verification</small></button>
                </div>
              </div>
            </div>

            <div class="col-9 bg-white p-2">
              <div class="tab-content w-100" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                  <br>
                  <form method="POST" action="https://www.sedmskill.in/verify.php">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control bg-white" name="center_uid" id="center_id" placeholder="Center No." required autocomplete="off">
                      <label for="center_id">Center No.</label>
                    </div>
                    <input type="hidden" name="type" value="center">
                    <button type="submit" class="btn btn-sm btn-warning"><i class="bi bi-bank2"></i> | Submit</button>
                  </form>
                </div>
                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                  <br>
                  <form method="POST" action="https://www.sedmskill.in/verify.php">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control bg-white" name="student_uid" id="student_id" placeholder="Student ID." required autocomplete="off">
                      <label class="text-dark" for="student_id">Student ID.</label>
                    </div>
                    <input type="hidden" name="type" value="student">
                    <button type="submit" class="btn btn-sm btn-warning"><i class="bi bi-person-check-fill"></i> | Submit</button>
                  </form>
                </div>
                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                  <br>
                  <form method="POST" action="https://www.sedmskill.in/verify.php">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control bg-white" name="cert_no" id="student_cert" placeholder="Certificate No." required autocomplete="off">
                      <label for="student_cert">Certificate No.</label>
                    </div>
                    <input type="hidden" name="type" value="certificate">
                    <button type="submit" class="btn btn-sm btn-warning"><i class="bi bi-patch-check-fill"></i> | Submit</button>
                  </form>
                </div>
              </div>
            </div>
        </div>
      </div>
<?
}
function get_features(){
    global $setting;
    global $con;
?>
    <div class="container-lg mt-3 bg-white p-4">
        <div class="row">
          <div class="col-12">
            <h4 class="text-dark"><?=isset($setting['features_title'])?$setting['features_title']:'';?></h4>
            <div class="w-25 bg-warning hrline"></div>
            <br>
          </div>
          <div class="row">
              <?
                $get = $con->query("SELECT * FROM `links` WHERE `type` = 'features'");
                        if($get->num_rows){
                            while($row = $get->fetch_assoc()){
                                echo '<div class="col-md-4 d-block shadow-sm border-4 border-start border-'.$row['label'].' p-2 mb-2">'.$row['link'].'</div>';
                            }
                        }
              ?>
            
          </div>
        </div>
    </div>
<?
}
function get_features_courses(){
    global $setting;
    global $con;
?>
<section id="speakers" class="wow fadeInUp pt-3" style="visibility: visible; animation-name: fadeInUp;">
            <div class="container">

                <h2 class="section-header"><?=getSetting('feature_coures_text','Our Courses');?></h2>
                <div class="row">
                    <?
                    	$get = $con->query("SELECT * FROM student_files WHERE `type` = 'courses' ");
    						while($m = $get->fetch_assoc())
    						{
                    echo '<div class="col-lg-4 col-md-6">
                            <style>
                                .img-fluid {
                                    transition: all ease-in-out 0.4s !important;
                                }
    
                                .img-fluid:hover {
                                    transform: scale(1.1) !important;
                                    transition: 1s;
                                }
                            </style>
                        
        						    <div class="speaker">
                                        <img src="uploads/downloads/'.$m['file'].'" alt="Speaker 1" class="img-fluid ">
                                        <div class="details">
                                            <h3>'.$m['title'].'</h3>
                                            <p>'.$m['description'].'</p>
                                        </div>
                            </div>
        					
                        </div>';
    						}
    			    ?>
                        
                    
                </div>
            </div>

        </section>
<?
}
function get_centers(){
    global $setting;
    global $con;
?>     
<section id="speakers" class="wow fadeInUp pt-3" style="visibility: visible; animation-name: fadeInUp;">
            <div class="container">

                <h2 class="section-header"><?=getSetting('feature_centers_text','Recent Joined Centers');?></h2>
                <div class="row">
                    <?
                    $centers = $con->query('SELECT * FROM `centers`');
                        while($c = $centers->fetch_assoc()){
                    echo '<div class="col-lg-4 col-md-6">
                            <style>
                                .img-fluid {
                                    transition: all ease-in-out 0.4s !important;
                                }
    
                                .img-fluid:hover {
                                    transform: scale(1.1) !important;
                                    transition: 1s;
                                }
                            </style>
                        
        						    <div class="speaker" style="height:14rem;">
                                        <img src="uploads/centers/'.$c['image'].'" alt="Speaker 1" class="img-fluid " style="height:inherit">
                                        <div class="details">
                                            <h3>'.$c['name'].'</h3>
                                            <p>'.$c['institute_name'].'</p>
                                        </div>
                            </div>
        					
                        </div>';
    						}
    			    ?>
                        
                    
                </div>
            </div>

        </section>
<?
}
function get_recognization(){
    global $setting;
    global $con;
?>
<section id="gallery" class="wow fadeInUp pt-0">

            <div class="container">
                <h2 class="section-header shadow"><?=getSetting('recog_text','Recognitions');?></h2>
            </div>

            <div class="owl-carousel gallery-carousel">
                <?
                     $get = $con->query("SELECT * FROM student_files WHERE `type` = 'recog' ");
						while($m = $get->fetch_assoc())
						{
			                echo '<a href="uploads/downloads/'.$m['file'].'" class="venobox" data-gall="gallery-carousel"><img
                            src="uploads/downloads/'.$m['file'].'"></a>';
						}
                ?>

            </div>

        </section><!-- End Gallery Section -->

<?
}
function get_gallery(){
    global $con;
    echo '<section class="container">';
         $cat = $con->query("SELECT * FROM gallery_category order by seq asc");
        while($c = $cat->fetch_assoc()){
            echo ' <h1 style="margin:5px;font-size:30px;border-bottom:3px solid #2a1570"><b>'.ucwords($c['category_name']).'</b></h1>';
            echo '<div class="row">';
            $get = $con->query("SELECT * FROM gallery where category_id = '".$c['id']."' order by id desc");
            while($g = $get->fetch_assoc())
            {
                echo '
                     <div class="col-md-3 col-lg-3" style="margin-bottom:5px;">
                            <a href="uploads/gallery/'.$g['image'].'" target="_blank"><img style="width:100%;height:150px;border:1px solid black;" src="uploads/gallery/'.$g['image'].'" title="'.$g['title'].'"></a>
                     </div>
                ';
            }
            echo '</div>';
        }
    echo '</div></section>';
}
function get_form(){
    ?>
    <section class="mt-4 mb-5">
    <div class="container-fluid wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">

        <div class="row">
           <div class="col-sm-6 mt-2">
               <div class="card shadow">
                   <h2 class="section-header">Enquiry/Feedback</h2>
                   <div class="card-body">
                       <p class="description">
                           
                       </p>

                       <form action="" method="post">
                           <div class="form-group">
    							<label>Name</label>
    							<input type="text" class="form-control" name="name" placeholder="Enter Name" required="">
    						</div>
    						<div class="form-group">
    							<label>E-Mail ID</label>
    							<input type="email" class="form-control" name="email" placeholder="Enter E-Mail ID" required="">
    						</div>
    						<div class="form-group">
    							<label>Mobile No.</label>
    							<input type="text" class="form-control" name="mobile" placeholder="Enter Mobile No." required="">
    						</div>
    						<div class="form-group">
    							<label>Message</label>
    							<textarea class="form-control" name="message" placeholder="Enter Your Message..."></textarea>
    						</div>
    						<div class="form-group">
    							<div class="col-md-6">
    								<p><img src="captcha.php" width="120" height="30" border="1" alt="CAPTCHA"></p>
    							</div>
    							
    								<label>Enter Captcha Code</label>
    								<input class="form-control" type="text" size="6" maxlength="5" name="captcha" value="">
    							
    						</div>
                           <div class="footer text-center mb-4 mt-3">
                               <button class="btn btn-primary" type="submit" name="status" value="contact_query">Send</button>
                           </div>
                       </form>
                   </div>
               </div>
           </div>

            <div class="col-sm-6 mt-2">
                <div class="card shadow">
                    <h2 class="section-header shadow">Registered address</h2>
                    <div class="card-body pt-0">
                       <?=getSetting('contact_address');?>
                    </div>
                </div>
                <div class="card shadow mt-2">
                    <h2 class="section-header">Corporate address</h2>
                    <div class="card-body pt-0 pb-0">
                        <p>
                          <?=getSetting('contact_corporate_address');?>
                        </p>
                    </div>
                </div>
                <div class="card shadow mt-2">
                    <h4 class="section-header">Franchise &amp; Student Enquiry</h4>
                    <div class="card-body  pt-0 pb-0">
                        <p>
                            <?=getSetting('contact_no1');?>
                        </p>
                    </div>
                </div>
                <div class="card shadow mt-2">
                    <h4 class="section-header">Franchise Enquiry</h4>
                    <div class="card-body  pt-0 pb-0">
                        <p>
                           <?=getSetting('contact_no2');?>
                        </p>
                    </div>
                </div>
            </div>
       </div>
    </div>
</section>
    <section class="mb-4">
    <div class="container-fluid wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
        <div class="row">
            <div class="col-sm-12 ">
                <div class="card shadow">
                    <h2 class="section-header">Our Location</h2>
                    <div class="card-body">
                        <iframe src="<?=getSetting('contact_map');?>" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen=""></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    
    <?
}
function speakers(){
    global $con;
    ?>
    <section id="speakers" class="wow fadeInUp pt-1">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-9 mt-2">
                        <div class="card shadow" style="border: none !important;">
                            <h2 class="section-header shadow"><?=getSetting('director_msg_title','From the Desk of Directors......')?></h2>
                            <div class="card-body">
                                <p style="text-align: justify">
                                   <?=getSetting('director_msg_content')?>
                                </p>
                                <div style="height: 125px">

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3 pl-0 pr-0">
                        <div class="col-sm-12 mt-2">
                            <div class="card shadow" style="border: none !important; padding: 0 !important;">
                                <h2 class="section-header shadow" style="">News</h2>
                                <div class="card-body">
                                    <div id="newsup" class="input-group">
                                        <marquee behavior="scroll" scrollamount="3" direction="up" height="300"
                                            onMouseOver="this.stop();" onMouseOut="this.start();">
                                            <ul style="font-size:18px; color: #0033CC">
                                                <?
                                                      $get = $con->query("SELECT * FROM `links` WHERE `type` = 'news'");
                                                        if($get->num_rows){
                                                            while($row = $get->fetch_assoc()){
                                                                echo '<li><b>'.$row['link'].'</b></li>';
                                                            }
                                                        }
                        
                                                ?>
                                            </ul>
                                        </marquee>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 mt-2">
                            <div class="card shadow" style="border: none !important;">
                                <h2 class="section-header shadow mb-0"><?=getSetting('why_msg_title','Why Arcade ?.')?></h2>
                                <div class="card-body mt-0 pt-2">
                                    <p style="text-align: justify">
                                      <?=getSetting('why_msg_content')?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

    <?
}
function tickets(){
    ?>
    <section id="buy-tickets" class="section-with-bg wow fadeInUp pt-2 pb-2">
            <div class="container">
                <div class="row">
                    <?
                        global $con;
                        $type = 'tickets';
                    	$get = $con->query("SELECT * FROM student_files WHERE `type` = '$type' ");
						while($m = $get->fetch_assoc())
						{
						    echo '<div class="col-lg-4">
                                    <div class="card mb-5 mb-lg-0 bg-danger">
                                        <div class="card-body">
                                            <h5 class="card-title text-muted text-uppercase text-center"
                                                style="color: white  !important;">'.ucwords($m['title']).'</h5>
                                            <h6 class="card-price text-center text-white">
                                                <img src="uploads/downloads/'.$m['file'].'" style="width:100px;">
                                            </h6>
                                            <hr>
                                            <p style="text-align: center !important; color: white">
                                               '.$m['description'].'
                                            </p>
                                            <hr>
            
                                        </div>
                                    </div>
                                </div>';
						}
                    ?>
                </div>

            </div>
        </section>

    
    <?
}
function counters(){
 ?>
 <section id="about" class="wow fadeInUp">
            <div class="container">
                <div class="row">
                    <div class="row contact-info">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-4">
                            <div class="contact-phone text-center">
                                <i class="fa fa-group text-warning" style="font-size: 50px"></i>
                                <h3 style="color: yellow; font-family: Cambria">Total Students</h3>
                                <input type="text" value="149139" id="totalstu" hidden>
                                <div style="font-size: 30px; padding: 2px; font-weight: bolder">
                                    <span id="student_counter"><?=getSetting('student_counter',200);?></span> +
                                </div>
                                <script>

                                </script>
                            </div>
                        </div>

                        <div class="col-md-4" style="border-left: 2px solid grey">
                            <div class="contact-email text-center">
                                <i class="fa fa-university text-warning" style="font-size: 50px"></i>
                                <h3 style="color: yellow; font-family: Cambria">Total Center</h3>
                                <div id="" style="font-size: 30px; padding: 2px; font-weight: bolder"><span
                                        id="centercounter"><?=getSetting('student_center',200);?> </span> +</div>
                            </div>
                        </div>
                        
                       

                    </div>
                </div>
            </div>
        </section>

 <?
}
?>


    
    <main id="main">
        
        


        





        <!--<section id="subscribe" style="padding-top: 10px !important;">-->
        <!--    <div class="container-fluid wow fadeInUp">-->
        <!--        <div class="section-header" style="background-color: transparent; border: none">-->
        <!--            <h2>Contact Us</h2>-->
        <!--        </div>-->

        <!--        <div class="row contact-info">-->

        <!--            <div class="col-md-4">-->
        <!--                <div class="contact-address text-center">-->
        <!--                    <img src='assets/root/cal.jpg' style="width: 100%">-->
        <!--                </div>-->
        <!--            </div>-->

        <!--            <div class="col-md-4">-->
        <!--                <div class="contact-phone text-center">-->
        <!--                    <i class="fa fa-map-marker text-warning" style="font-size: 50px"></i>-->

        <!--                    <h3 style="color: yellow; font-family: Cambria">Address</h3>-->
        <!--                    <address class="text-white">-->
        <!--                        <label for="" class="text-warning" style="font-weight: bolder"> ARCADE COMPUTER ACADEMY-->
        <!--                            PRIVATE LIMITED</label> <br>-->
        <!--                        A.N.Sinha Road,(Near Bol Baby Bol School)<br>Kadam Kuan-->
        <!--                        Patna - 800003,-->
        <!--                        Bihar, INDIA-->
        <!--                    </address>-->

        <!--                    <i class="fa fa-phone text-warning" style="font-size: 50px"></i>-->
        <!--                    <h3 style="color: yellow; font-family: Cambria">Contact No.</h3>-->
        <!--                    <p class="text-white">-->
        <!--                        <a href="tel:9576248610" class="text-white">+91 9576248610</a> <br>-->
        <!--                        <a href="tel:9555964323" class="text-white">+91 9555964323</a> <br>-->
        <!--                        <a href="tel:6203677960" class="text-white">+91 6203677960</a>-->
        <!--                    </p>-->

        <!--                    <i class="fa fa-envelope text-warning" style="font-size: 50px"></i>-->
        <!--                    <h3 style="color: yellow; font-family: Cambria">Email</h3>-->
        <!--                    <p>-->
        <!--                        <a href="mailto:info@arcadecomputer.com" target="_blank"-->
        <!--                            class="text-white">info@arcadecomputer.com</a> <br>-->
        <!--                        <a href="mailto:aca2india@gmail.com" target="_blank"-->
        <!--                            class="text-white">aca2india@gmail.com</a>-->
        <!--                    </p>-->
        <!--                </div>-->
        <!--            </div>-->

        <!--            <div class="col-md-4">-->
        <!--                <div class="contact-email text-center">-->
        <!--                    <img src='assets/root/cal2.jpg' style="width: 100%">-->
        <!--                </div>-->
        <!--            </div>-->

        <!--        </div>-->

        <!--    </div>-->
        <!--</section>-->


        <!--<div class="footer-top pt-3 pb-0 bg-dark">-->
        <!--    <div class="container-fluid">-->
        <!--        <div class="row">-->

        <!--            <div class="col-sm-9 footer-info">-->
        <!--                <iframe-->
        <!--                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d899.4666344449302!2d85.15094580062346!3d25.609350752135164!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39ed58f4f7d8322f%3A0x227fd1f65cccfe4!2sArcade+Computer+Academy!5e0!3m2!1sen!2sin!4v1520858246000"-->
        <!--                    width="100%" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>-->

        <!--            </div>-->

        <!--            <div class="col-lg-3 col-md-6 footer-contact text-warning">-->
        <!--                <h4 class="text-white"><b>Opening Time</b></h4>-->
        <!--                <table>-->
        <!--                    <tr>-->
        <!--                        <td>Sunday </td>-->
        <!--                        <td> 10:30 AM – 12:30 PM</td>-->
        <!--                    </tr>-->
        <!--                    <tr>-->
        <!--                        <td>Monday </td>-->
        <!--                        <td> 10:00 AM – 06:00 PM</td>-->
        <!--                    </tr>-->
        <!--                    <tr>-->
        <!--                        <td>Tuesday </td>-->
        <!--                        <td> 10:00 AM – 06:00 PM</td>-->
        <!--                    </tr>-->
        <!--                    <tr>-->
        <!--                        <td>Wednesday &nbsp;&nbsp;&nbsp;</td>-->
        <!--                        <td> 10:00 AM – 06:00 PM</td>-->
        <!--                    </tr>-->
        <!--                    <tr>-->
        <!--                        <td>Thursday </td>-->
        <!--                        <td> 10:00 AM – 06:00 PM</td>-->
        <!--                    </tr>-->
        <!--                    <tr>-->
        <!--                        <td>Friday </td>-->
        <!--                        <td> 10:00 AM – 06:00 PM</td>-->
        <!--                    </tr>-->
        <!--                    <tr>-->
        <!--                        <td>Saturday </td>-->
        <!--                        <td> 10:00 AM – 06:00 PM</td>-->
        <!--                    </tr>-->
        <!--                </table>-->

        <!--            </div>-->

        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->

    </main>



    
<?
require 'includes/footer.php';
?>