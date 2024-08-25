<?php
   die('Maintenance');
   include 'includes/header.php';
   
   $page_id = isset($_GET['page_id'])?$_GET['page_id']:1;
   $pages = $con->query("SELECT * FROM `his_page` WHERE `id` = '".$page_id."'")->fetch_assoc();
   $content = $pages['content'];    
   $page_id = $pages['id'];
   define('DEFAULT_PAGE','1');
	$page_header = $pages['page_header'];   
   ?>
<?php
   if (DEFAULT_PAGE == $page_id) {
      
           ?>
<section class="main-slider">
    <div class="tp-banner-container">
        <div class="tp-banner">
            <ul>
                <?php 
                $sliders = $con->query("SELECT * FROM sliders");
                while ($sl = $sliders->fetch_assoc()) {
                ?>
                    <li data-transition="fade" data-slotamount="1" 
                        data-masterspeed="1000" data-thumb="/uploads/<?php echo htmlspecialchars($sl['image']); ?>"  
                        data-saveperformance="off" data-title="">
                        <img src="/uploads/<?php echo htmlspecialchars($sl['image']); ?>" alt=""  
                            data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat">
                       
                        
                        
                    </li>
                <?php 
                }
                ?>
            </ul>
            <div class="tp-bannertimer"></div>
        </div>
    </div>
</section>
           <!--About Section-->
         <section class="about-section">
            <div class="auto-container">
               <div class="row clearfix">
                  <!--Column-->
                  <div class="column col-lg-7 col-md-8 col-sm-12">
                     <div class="about-content-box">
                        <div class="sec-title-one">
                           <h2>Welcome to RJ Digital Computer Institute</h2>
                        </div>
                        <div class="text text-justify">
                           <div>
                              <div style="background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><font face="Tahoma"><span style="font-size: 18.6667px;"><b>RJ Digital Computer Institute&nbsp;</b></span></font><span style="font-family: Tahoma;"><span style="font-size: 14pt;">RJ Digital Computer Institute is an ISO 9001:2015 Certified Institute. RJ Digital Computer Institute is providing - Vocational & professional education, Computer Education, Corporate & Govt trainings. It services Software, Hardware, financial & Inventory accounting, e- taxation, Retail, Telecom Courses. The Aim of this Institution was given a new meaning of vocational courses & was made available to all section of the society be it rich or poor, adult or children , no one was neglected.<b>,&nbsp;</b><strong><span style="background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><span style="font-weight: normal;">NCS &ndash; National career Service</span></span></strong><strong><span style="background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;">,</span></strong></span><strong><span style="background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;">&nbsp;</span></strong><span style="font-size: 14pt;">Ministry of Labour &amp; Employment and Ministry of AYUSH and is accredited to conduct the various fields of technical programs sponsored by both the Govt.</span></span></div>
                              <div style="background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin: 0in 0in 6.25pt;"><font face="Tahoma"><span style="font-size: 18.6667px;"><b>RJ Digital Computer Institute&nbsp;</b></span></font><span style="font-family: Tahoma;"><span style="font-size: 14pt;">The main function of the society is to provide higher technical education in nominal charges for every group of society of Urban &amp; Rural areas all over India and get success in computer revolution which is the main dream of Indian Govt..</span></span></div>
                           </div>
                           <p></p>
                           &nbsp;<a href="#" title="Read more about us">Read More..</a>
                        </div>
                     </div>
                  </div>
                  <!--Column-->
                  <div class="column col-lg-5 col-md-4 col-sm-6 col-xs-12">
                     <div class="image-box">
                        <figure class="image">
                           <img src="<?=THEME_PATH?>/new/product/category/1632892464871.jpg" alt="Digital Computer institute" title="Digital Computer institute" />
                        </figure>
                     </div>
                  </div>
               </div>
               <div class="auto-container">
                  <div style="background-color:#04AA6D; color:#fff; padding:5px; border-radius:10px;">
                     <style>
                        p {
                        position: relative;
                        line-height: 0.8em;
                        }
                        p {
                        margin: 0 0 0px;
                        }
                     </style>
                     <marquee onmouseover="this.stop();" onmouseout="this.start();">
                        <p>free government computer courses franchise* govt free computer education franchise* computer institute franchise* computer education franchise in village area* govt computer education franchise* computer center franchise* free franchise for computer center* govt schemes for computer education* ngo scheme for computer education* mputer training institute franchise* computer institute franchise absolutely free* free computer education scheme* govt project for computer education* computer training franchise* computer institute franchise* computer courses franchise* free computer center franchise* ngo franchise for computer education* government franchise for computer institute* most profitable computer education franchises* free computer education by ngo* franchise of educational institute* computer education institute franchise* study centre franchise* indian computer institute franchise form* computer education franchise in bangalore* central government computer courses franchise* government computer courses franchise* free govt computer courses* abacus franchise* free computer education* skill development institute franchise* computer education center registration* franchise for vocational courses* vocational training institute franchise* computer institute govt registration* youth computer training centre franchise* ngo computer education franchise* computer training centre affiliation* franchise opportunities in hyderabad* computer franchise* best computer institute franchise* franchise opportunities in pune* central government schemes for free computer education* government certified computer courses* govt approved computer courses* franchise opportunities in kerala* digital india franchise* franchise in hyderabad* government approved computer institute* online computer courses in india* govt recognised computer institute franchise* franchise opportunities in tamilnadu* education franchise opportunities* franchise opportunities in kolkata* free computer education project* govt computer course franchise* central government computer education scheme* education franchise in india* distance education franchise* govt affiliation for computer institute* computer training center business registration* institute of computer education* new business franchise* free computer education program* govt computer training center* franchise options in india* free franchise in india* central government project for computer education* top education franchises* computer saksharta mission* top franchise in india* central government free computer courses* free online computer courses in india* all india computer saksharta mission* government computer training institutes* franchise opportunities in andhra pradesh* government computer training scheme* govt approved computer institute* new computer institute registration* how to register computer training institute* registration of computer training institute* central govt scheme for computer education* computer franchise business* computer institute registration* franchise opportunities in gujarat* How to register computer center* emaxindia* sarvaindia* sarvaindia.com* emaxindia.in* gbindia* globalbrain* gbindia.in* computer center franchise in auraiya* how to register computer institute in auraiya*</p>
                     </marquee>
                  </div>
               </div>
            </div>
         </section>
         <!--Call To Action-->
         <section class="call-to-action" style="background-image:url(images/background/1.html);">
            <div class="auto-container">
               <div class="row">
                  <div class="col-sm-4">
                     <div class="panel panel-default">
                        <div style="background:#2b176e; color:#FFFFFF; padding:10px;">
                           <strong>Recently Join Centres</strong></a>
                        </div>
                        <div class="panel-body" style="background-color:#fffdf1;">
                           <div class="tab-content">
                              <div class="tab-pane fade in active" id="dlp2017" style="height:415px;">
                                 <marquee behavior="scroll" direction="up" scrollamount="3" onmouseover="this.stop();" onmouseout="this.start();" style="height:400px;">
                                    <ul class="lst">
                                       <!------------  ------------>
                                    </ul>
                                 </marquee>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-4">
                     <div class="panel panel-default">
                        <div style="background:#2b176e; color:#FFFFFF; padding:10px;">
                           <strong>Recently Join Student</strong></a>
                        </div>
                        <div class="panel-body" style="background-color:#fffdf1;">
                           <div class="tab-content">
                              <div class="tab-pane fade in active" id="dlp2017" style="height:415px;">
                                 <marquee behavior="scroll" direction="up" scrollamount="3" onmouseover="this.stop();" onmouseout="this.start();" style="height:400px;">
                                    <ul class="lst">
                                     <?php 
               // Corrected SQL Query
               $students  = $con->query("SELECT students.*, courses.course_name, courses.short_name, centers.institute_name 
                          FROM students 
                          LEFT JOIN courses ON students.course_id = courses.id 
                          LEFT JOIN centers ON students.center_id = centers.id 
                          WHERE students.status = 1 
                          ORDER BY students.dur_start DESC 
                          LIMIT 10");

while($stu = $students->fetch_assoc()){
?>
<li style="border-bottom: 1px dotted #000;">
    <center>
        <img class="alignnone size-full wp-image-4843" 
             src="/uploads/students/<?php echo htmlspecialchars($stu['photo']); ?>" alt="" 
             style="height:110px;width:120px;">
        <br/>
        <strong>Name : <?php echo htmlspecialchars($stu['name']); ?></strong><br/>
        <strong>Course : <?php echo htmlspecialchars($stu['course_name']); ?> </strong><br/>
        <strong>Branch : <?php echo htmlspecialchars($stu['institute_name']); ?></strong>
    </center>
</li>
<?php } ?>
        
                                     </ul>
                                 </marquee>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-4">
                     <style>
                        .panel {
                        margin-bottom: 10px;
                        background-color: #fff;
                        border: 1px solid #eee;
                        }
                        b, strong {
                        font-weight: 700;
                        }
                        .panel-body {
                        padding: 5px;
                        }
                        .tab-content>.active {
                        display: block;
                        }
                        .fade.in {
                        opacity: 1;
                        }
                        ul.lst li:last-child {
                        border-bottom: none;
                        }
                        ul.lst li {
                        line-height: 20px;
                        margin-bottom: 10px;
                        list-style: none;
                        border-bottom: 1px solid #000;
                        padding-bottom: 10px;
                        }
                     </style>
                     <div class="panel panel-default">
                        <div style="background:#2b176e; color:#FFFFFF; padding:10px;">
                           <strong>News &amp; Events</strong></a>
                        </div>
                        <div class="panel-body" style="background-color:#fffdf1;">
                           <div class="tab-content">
                              <div class="tab-pane fade in active" id="dlp2017" style="height:415px;">
                                 <marquee behavior="scroll" direction="up" scrollamount="3" onmouseover="this.stop();" onmouseout="this.start();" style="height:400px;">
                                    <ul class="lst">
                                       <!------------     -------------->
                                       <li style="border-bottom: 1px solid #000;">
                                          <h3><span style="font-family: &quot;Comic Sans MS&quot;;">
                                             <span style="background-color: black;"><strong>DCA,ADCA &amp; CCC&nbsp; &quot;ADMISSION OPEN&quot;</strong> - DIGITAL COMPUTER INSTITUTE BHATPAR</span></span><strong><br />
                                             </strong>
                                          </h3>
                                          <p></p>
                                       </li>
                                       <!------------     -------------->
                                       <li style="border-bottom: 1px solid #000;">
                                          <p style="text-align: justify;"></p>
                                          <p><span style="background-color: yellow;"> </span></p>
                                          <h3><span style="background-color: rgb(0, 0, 255);"><span style="font-family: &quot;Comic Sans MS&quot;;"><span style="font-size: large;">New Admission Open&nbsp; DCA, ADCA, CCC, ACCOUNTING, TALLY9, ERP-9.</span></span></span></h3>
                                          <p></p>
                                          <h3><span style="background-color: rgb(0, 0, 255);"><span style="font-family: &quot;Comic Sans MS&quot;;"><span style="font-size: large;">Join Today RJ Digital Computer Institute Neori</span></span></span></h3>
                                          <p></p>
                                          <p></p>
                                          <p></p>
                                          <p></p>
                                          <p></p>
                                          <p></p>
                                          <p></p>
                                          <h3></h3>
                                          <p><span style="font-size: large;"> </span></p>
                                          <h3><span style="font-family: &quot;Times New Roman&quot;;"><span style="background-color: yellow;"> </span></span></h3>
                                          <p></p>
                                          <h3></h3>
                                          <h3></h3>
                                          <h3></h3>
                                          <p></p>
                                       </li>
                                       <!------------  ------------>
                                    </ul>
                                 </marquee>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!--Training Programs-->
         <!--Choose Us-->
         <!--Latest News Section-->
         <section class="latest-news">
            <div class="auto-container">
               <div style="background-color:#232434; color:#fff; padding:5px; border-radius:10px;">
                  <style>
                     p {
                     position: relative;
                     line-height: 0.8em;
                     }
                     p {
                     margin: 0 0 0px;
                     }
                  </style>
                  <marquee onmouseover="this.stop();" onmouseout="this.start();">
                     <p>how to register a computer institute, new franchise, no franchise, how to register a computer institute, computer educational institute registration, how to start computer institute,how can I register my computer centre under Government of India, computer institute franchise,how to register computer training institute, business franchise, computer education franchise, computer education institute, udyog Aadhar registration without OTP, udyog Aadhar registration, online udyog Aadhar registration, how to online udyog Aadhar registration, MSMe registration ,how to online udyog Aadhar registration, computer education institute registration, how can I register my computer centre under Government of India, computer education franchise,howto Register vocational course, training franchise, institute franchise absolutely free, Education Franchise in India, Computer Institute Franchise Absolutely Free, Govt Affiliation For Computer Institute, how to register a yoga institute, SO certification for your training Center, vocational course franchise, Free Computer Center Franchise in India, ntt center registration, Yoga Franchise | Yoga Studio Franchise, no.1 Education Franchise in India, Best Education Franchise in India, how to get education franchise in india, Low Investment Franchise In India || Best Education Franchise Of India, Education Franchise Opportunities | Education Business Franchises in India, NTT, PTT, NPTT, Vocational Courses Centers Franchise in India, Nursery Teacher Training NTT Course Franchise Center Tag People also Search: Andhra Pradesh (Hyderabad) Arunachal Pradesh (Itanagar) Assam (Dispur) Bihar (Patna) Chhattisgarh (Raipur) Goa (Panaji) Gujarat (Gandhinagar) Haryana (Chandigarh) Himachal Pradesh (Shimla) Jammu & Kashmir (Srinagar-S*, Jammu-W*) Jharkhand (Ranchi) Karnataka (Bangalore) Kerala (Thiruvananthapuram) Madhya Pradesh (Bhopal) Maharashtra (Mumbai) Manipur (Imphal) Meghalaya (Shillong) Mizoram (Aizawl) Nagaland (Kohima) Odisha (Bhubaneshwar) Punjab (Chandigarh) Rajasthan (Jaipur) Sikkim (Gangtok) Tamil Nadu (Chennai) Telangana (Hyderabad) Tripura (Agartala) Uttarakhand (Dehradun) Uttar Pradesh (Lucknow) West Bengal (Kolkata).
                        Tags: computer education affiliation, computer education franchise, computer education center registration,EDUCATION MAXIMUM PRIVATE LIMITED start a computer training institute, computer education centre franchise, computer training center registration, computer education centre, computer education affiliation franchise india, franchise for computer institute, education franchise services, computer training franchise india, computer education institute registration, institute of computer education, computer saksharta mission, computer institute registration process, skill development programme, skill development training program, vocational and skill development training center,Computer education franchise,agreement,absolutely free,csc government,village area,affiliation, education centre , best in software training and a certification training. digital marketing training in jaipur govt free computer education in Rajasthan Punjab Bihar,free computer education franchise in village area, Computer education franchise offer in Andhra Pradesh, absolutely, free,franchise, agreement,franchise, courses,csc computer education franchise,skill development training franchise,free computer education franchise in village area,education franchise proposal,free government computer courses franchise,free franchise for computer center,free franchise for computer institute in institute affiliation, become our computer franchisee, computer training govt project, free computer centre franchise, computer training govt schemes, ndlm scheme, pmkvy scheme Andaman and Nicobar, Arunachal Pradesh, Assam, Bihar, Chandigarh, Chhattisgarh, Dadra and Nagar Haveli,HR Daman and Diu, National Capital Territory of Delhi, Goa, Gujarat, Haryana, Himachal Pradesh, Jammu and Kashmir,Rajasthan, Sikkim, Tamil Nadu, Telangana, Tripura, Uttar Pradesh, Uttarakhand, West Bengal, Jharkhand, Karnataka, Kerala, Lakshadweep, Madhya Pradesh, Maharashtra, Manipur, Meghalaya, Mizoram, Nagaland, Odisha, Puducherry, Punjab, how to get pmkvy franchise,pmkvy franchise in west bengal,pmkvy franchise in odisha,pmkvy franchise in rajasthan,pmkvy franchise in bihar,pmkvy franchise in up,pmkvy franchise in uttar pradesh,ndlm franchise,ndlm center registration process,ndlm project,ndlm project details,ndlm registration online,ndlm center login,ndlm registration process,ndlm registration form,ndlm student,pmkvy franchise,kaushal vikas mission,kaushal vikas yojana,kaushal vikas yojana up,kaushal vikas yojna,upsdm org online registration,kaushal vikas mission up,up kaushal vikas mission,kaushal vikas,upsdm online registration,upsdm registration,kaushal vikas yojana registration,kaushal vikas yojana in up,up skill development mission,up kaushal vikas yojana,upsdm online form,upsdm online,upsdm org online form,kaushal vikas yojana online,kosal vikas yojana kaushal vikas yojna online registration,kaushal vikas yojna up,up kaushal vikas online form,kaushal vikas online form,kaushal vikas yojana online registration,kaushal vikas yojana online form,kaushal vikas prashikshan up,skill development mission,upsdm registration online,lakme training academy,vlcc institute of beauty & nutrition,orane institute of beauty & wellness,vlcc institute fees,vlcc professional makeup course fees vlcc beautician course fees,orane beauty academy,institutes for beautician course,Beauty, Cosmetology, Hair Dressing ,Makeup institute training colleges in Jaipur,Vocational Training Franchise,govt beauty parlour course in jaipur,beauty parlour course fees in jaipur,vlcc institute of beauty & nutrition jaipur rajasthan,beauty institute jaipur, rajasthan,beauty parlour institute in jaipur,beauty institute in jaipur,orane beauty academy, institute of beauty and wellness jaipur, rajasthan,beauty parlor course in jaipur ' Hyderabad 'Itanagar 'Dispur' Patna 'Raipur ' Panjim ' Gandhinagar ' Chandigarh ' Shimla ' Srinagar ' Jammu ' Ranchi ' Bangalore ' Thiruvananthapuram ' Bhopal ' Mumbai ' Imphal ' Aizawl ' Kohima 'Bhubaneswar ' Chandigarh ' Jaipur ' Gangtok ' Chennai ' Agartala ' Lucknow ' Dehradun ' Kolkata,free government computer courses franchise,csc computer education franchise,computer institute franchise,computer center franchise,free franchise for computer center,govt computer education franchise,free computer education franchisecomputer institute franchise free,computer education franchise,free computer education scheme,govt recognised computer institute, free computer center franchise,webel computer training centre franchise,govt free computer education,free franchise for computer institute,computer center franchise in west bengal,government franchise for computer institute,digital marketing training in jaipur,nct registration for computer institute,free franchise computer education india,itrc indore,computer education center registration,institute franchise proposal,govt computer institute in delhi,free computer franchise Free computer, institute, franchise,upsdm registration online,lakme training academy,vlcc institute of beauty & nutrition,orane institute of beauty & wellness,vlcc institute fees,vlcc professional makeup course fees,vlcc beautician course fees,orane beauty academy,institutes for beautician course,Beauty, Cosmetology, Hair Dressing ,Makeup institute absolutely, free,franchise, agreement,franchise, courses,csc computer education franchise,free computer education franchise in village area,education franchise proposal,free government computer courses franchise,free franchise for computer center,free franchise for computer institute in institute affiliation, become our computer franchisee, computer training govt project, free computer centre franchise, computer training govt schemes, ndlm scheme, pmkvy scheme,how to open a computer institute,computer courses in chandigarh, karnataka,Orissa,tamil nadu,Bihar,bharat kaushal,sarkari yojnaye,berojgar registration,kaushal vikas mission,kaushal vikas yojna lucknow,kaushal vikas bhatta in himachal pradesh,kaushal yojna,kaushal vikas kendra mp, Beauty Training Institutes in Jaipur,Vocational Training Franchise,Hyderabad,Itanagar,Dispur,Patna,Raipur,Panaji, Gandhinagar,Chandigarh, Shimla, Srinagar, Jammu, Ranchi,Bangalore,Thiruvananthapuram, Bhopal,Mumbai,Imphal, Shillong, Aizawl, Kohima, Bhubaneswar, Chandigarh, Jaipur, Gangtok, Chennai, Agartala,Lucknow, Dehradun ,Kolkata,skill development training franchise,soft skills training topics,soft skills training pptsoft skills training material pdf,soft skills training courses,soft skills training modules,soft skill training institutes,soft skills training in chennai,soft skills training bangalore,Computer Education Institute Free Franchise Proposal | Free Computer Education Franchise in Village area | Computer institute Franchise Absolutely free | Free government computer courses franchise | csc computer education franchise | digital marketing course in Jaipur | Govt free computer education franchise | computer center franchise | computer education franchise | Digital marketing institute in jaipur | govt free computer education | free franchise for computer center | free computer education franchise | govt computer education franchise | computer institute govt registration | digital marketing course fees in jaipur | free computer education | free computer education franchise in india | digital marketing training in jaipur | beauty parlour training centre in chandigarh | get pmkvy franchise | pmkvy franchise in west bengal | orissa | rajasthan | bihar | uttar pradesh | up | ndlm franchise | Cosmetics and Beauty Institute Franchise | Cosmetic Franchise Opportunities | Institute Cosmetic Franchises for Sale Opportunity | Beauty Academy Cosmetology Institute | Makeup Salon Spa Hair | institutes for beautician course,Beauty, Cosmetology, Hair Dressing ,Makeup institute training colleges in Jaipur | Beauty Training Institutes in Jaipur |Beauty Parlour Training Institutes in Jaipur | Vocational Training Franchise | govt beauty parlour course in jaipur | beauty parlour course fees in jaipur |beauty institute jaipur, rajasthan | beauty parlour institute in jaipur |beauty institute in jaipur | orane beauty academy, institute of beauty and wellness jaipur, rajasthan |beauty parlor course in jaipur | Hyderabad | Itanagar | Dispur | Patna | Raipur | Panaji | Gandhinagar | Chandigarh | Shimla | Srinagar | Jammu | Ranchi | Bangalore | Thiruvananthapuram | Bhopal | Mumbai | Imphal | Aizawl | Kohima | Bhubaneswar | Chandigarh | Jaipur | Gangtok | Chennai | Agartala | Lucknow | Dehradun | Kolkata | skill development training franchise | Andhra Pradesh | Arunachal Pradesh | Assam | Bihar | Chhattisgarh | Goa | Gujarat | Haryana | Himachal Pradesh |Jammu and Kashmir | Jharkhand | Karnataka | Kerala | Madhya Pradesh | Maharashtra | Manipur | Meghalaya | Mizoram | Nagaland | Odisha(Orissa) | Punjab | Rajasthan | Sikkim | Tamil Nadu | Tripura | Uttar Pradesh | Uttarakhand | West Bengal | basic computer course syllabusbasic computer courses list | basic computer courses for beginners | basic computer course fees | computer course list | basic computer courses book download | Air Hostess Training in Jaipur, Courses, Institutes,digital marketing training,digital training institute,digital marketing training in hyderabad,training digital,digital marketing training in bangalore,digital training,digital training academy,digital marketing training in chennai,digital marketing training in mumbai,digital marketing training london,digital marketing training bangalore,digital marketing training mumbai, Banking & Finance Courses Diploma in banking and finance, post graduate diploma in banking and finance, pg diploma in banking and finance, diploma in finance and banking, diploma courses in banking and finance, diploma in banking and finance eligibility, diploma in international banking and finance Banking & Finance, school programs, trade school programs, technical school programs, free school programs, in school programs, school education programs, international school programs online high school courses, high school courses online, online courses high school, high school online courses online courses for high school, online courses for high school students,Skills Training India skill development training,skill training,training skills,training and development skills,training and skills development,skill development and training, communication skills training, skills training centre, training skill development, skills training and development,skill development training courses, skill courses, professional skills course, short courses skills development, skill training courses, writing skills course, course skills, research skills course, skills courses, Computer Education Franchise Opportunities in India, best computer franchise, franchise opportunities for computer education, best franchise for computer education, franchise for computer education, open your own registered computer institute, computer training franchise
                     </p>
                  </marquee>
               </div>
            </div>
         </section>
         <section class="latest-news">
            <div class="auto-container">
               <div class="sec-title-two">
                  <h2>Our Programmes</h2>
               </div>
               <div class="row clearfix">
                  <!--Column-->
                  <div class="column col-lg-12 col-md-12 col-sm-12">
                     <div class="row clearfix">
                        <!-- start project --> 
                        <div class="<?=THEME_PATH?>/news-block col-md-4 col-sm-4 col-xs-12">
                           <div class="inner-box wow fadeIn" data-wow-delay="300ms" data-wow-duration="1500ms">
                              <figure class="image-box">
                                 <img src="<?=THEME_PATH?>/new/images/user/1632892323385.png" alt="Diploma Courses " style="height:250px;">
                                 <div class="overlay-box"><a href="courses52ef.html?cid=TVE9PQ==" ><span class="flaticon-chain-links"></span></a></div>
                              </figure>
                              <div class="lower-content">
                                 <div class="outer-link" style="padding-left:0px;">
                                    <h3 style="text-align:center;"><a href="courses52ef.html?cid=TVE9PQ=="> Diploma Courses </a></h3>
                                    <!-- <div class="meta"><a href="javascript:return(0);">Content Writing</a></div>-->
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="<?=THEME_PATH?>/news-block col-md-4 col-sm-4 col-xs-12">
                           <div class="inner-box wow fadeIn" data-wow-delay="300ms" data-wow-duration="1500ms">
                              <figure class="image-box">
                                 <img src="<?=THEME_PATH?>/new/images/user/1632892517823.png" alt="Vocational Courses" style="height:250px;">
                                 <div class="overlay-box"><a href="coursesd64f.html?cid=TkE9PQ==" ><span class="flaticon-chain-links"></span></a></div>
                              </figure>
                              <div class="lower-content">
                                 <div class="outer-link" style="padding-left:0px;">
                                    <h3 style="text-align:center;"><a href="coursesd64f.html?cid=TkE9PQ=="> Vocational Courses</a></h3>
                                    <!-- <div class="meta"><a href="javascript:return(0);">Content Writing</a></div>-->
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="<?=THEME_PATH?>/news-block col-md-4 col-sm-4 col-xs-12">
                           <div class="inner-box wow fadeIn" data-wow-delay="300ms" data-wow-duration="1500ms">
                              <figure class="image-box">
                                 <img src="<?=THEME_PATH?>/new/images/user/1632892529663.jpg" alt="YOGA Courses" style="height:250px;">
                                 <div class="overlay-box"><a href="courses49d9.html?cid=TlE9PQ==" ><span class="flaticon-chain-links"></span></a></div>
                              </figure>
                              <div class="lower-content">
                                 <div class="outer-link" style="padding-left:0px;">
                                    <h3 style="text-align:center;"><a href="courses49d9.html?cid=TlE9PQ=="> YOGA Courses</a></h3>
                                    <!-- <div class="meta"><a href="javascript:return(0);">Content Writing</a></div>-->
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="<?=THEME_PATH?>/news-block col-md-4 col-sm-4 col-xs-12">
                           <div class="inner-box wow fadeIn" data-wow-delay="300ms" data-wow-duration="1500ms">
                              <figure class="image-box">
                                 <img src="<?=THEME_PATH?>/new/images/user/1632892542183.png" alt="University Courses" style="height:250px;">
                                 <div class="overlay-box"><a href="coursesf73a.html?cid=T1E9PQ==" ><span class="flaticon-chain-links"></span></a></div>
                              </figure>
                              <div class="lower-content">
                                 <div class="outer-link" style="padding-left:0px;">
                                    <h3 style="text-align:center;"><a href="coursesf73a.html?cid=T1E9PQ=="> University Courses</a></h3>
                                    <!-- <div class="meta"><a href="javascript:return(0);">Content Writing</a></div>-->
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- start project --> 
                     </div>
                  </div>
                  <!--Column-->
               </div>
               <div class="auto-container">
                  <div style="background-color:#7d4e92; color:#fff; padding:5px; border-radius:10px;">
                     <style>
                        p {
                        position: relative;
                        line-height: 0.8em;
                        }
                        p {
                        margin: 0 0 0px;
                        }
                     </style>
                     <marquee onmouseover="this.stop();" onmouseout="this.start();">
                        <p>Computer Education Franchise In Mp * Maharashtra* Up* Rajashtan* Hariyana* * Computer Education Franchise Franchise In West Bengal* Orrisa* Odisha* Dia* Himachal* Himachal Pradesh* North Dia* South Dia* East Dia* All Over Dia* Guideline Computer Education Franchise Training Centre Guidence* Uttar Pradesh Up Haryana Maharshtra Rajasthan Himachal Pradesh Manipur Sikkim * Jammu Jammu And Kashmir Meghalaya Tamilnadu Jharkhand Mizoram Tripura Nagaland Uttarakhand Goa Orissa Mp Punjab West Bengal * Ahmedabad* Anand* Dewas* Bhopal* Computer Education Franchise Franchise In* – Dore * Ujja * Ashta * Dhar * Mhow * Pithampur * Maksi * Sarangpur * Shajapur * Sehdol * Kotma * Ganganagar * Jaipur * Delhi * Mumbai * Udaypur * Udaipur * Allahabad * Surat * Lakhimpur Kheri * Lakhimpur * Lucknow * Sagar * Rai Bareli * East Ahmedabad * Guntur * Pipriya * Betul* Chhatarpur * S Grauli * Sidhi* Satna* Madhopur* Banswara * Jalore * Kota * Nagpur * Pali * Jhalawar * Jhunjhunu * Jodhpur * Karauli * Jangir Champa * Kanker * Korba * Mahasamund * Raigarh * Rajnandgaon * Sarguja * Bilaspur * Raipur * Dadra * * Nagar * Haveli * Daman * And * Diu * North * Goa * South * Goa * Ahmedabad * East * Ahmedabad * West * Anand * Bharuch * Chhotaudepur * Dahod * Gandh Agar * Amreli * Bhavnagar * Jamnagar * Kheda * Mehsana * Navsari * Junagadh * Rajkot * Shahjahanpur * Akbarpur * Etah * Kairana * Bansgaon * Almora * Hardwar * Na Ital Udhams Gh * Nagar * Tehri * Garhwal * Tehri * Garhwal * Alipurduars * Arambagh * Asansol * Baharampur * Bangaon * Bankura * Barasat * Bardhaman * Purba * Bardhaman Durgapur * Barrackpur * Basirhat * Bishnupur * Coochbehar * Darjeel G * Diamond * Harbour * Dum * Dum * Ghatal * Hooghly * Howrah * Jadavpur * Jalpaiguri * Jangipur * Jaynagar * Kanthi * Kolkata * Daksh * Kolkata * Uttar * Krishnanagar * Maldaha * Daksh * Mathurapur * Med Ipur * Murshidabad * Nadia * Purulia * Raiganj * Ranaghat * Serampore * Tamluk * Uluberia * Balurghat * Bolpur * Jhargram * Maldaha * Uttar * Nilgiris * Pollachi * Ramanathapuram * Salem * Sivaganga * Sriperumbudur * Tenkasi * Thanjavur * Theni * Thoothukudi * Tiruchirappalli * Tirunelveli * Tiruppur * Tiruvallur * Tiruvannamalai * Vellore * Viluppuram * Virudhunagar * Cuddalore * Perambalur * Adilabad * Bhongir * Chelvella * Hyderabad * Karimnagar * Khammam * Mahabubabad * Mahabubnagar * Malkajgiri * Medak * Nalgonda * Nizamabad * Secunderabad * Warangal * Zaheerabad * Nagarkurnool * Peddapalle * Shivpuri * Guna * Mirzapur * Misrikh * Mohanlal Ganj * Moradabad * Naga * Pratapgarh * Raebareli * Robartsganj * Saharanpur * Sambhal * Sant * Kabir * Nagar * Fatehpur * Shrawasti * Sitapur * Sultanpur * Unnao * Varanasi * Azamgarh * Badaun * Bahraich * Bhadohi * Deoria * Fatehpur * Sikri * Firozabad * Kaiserganj * Kannauj * Kheri * Lalganj * Maharajganj * Muzaffarnagar * Phulpur * Pilibhit * Rampur * Salempur * Ghazipur * Hardoi * Kush Agar * Gaya * Gopalganj * Jahanabad * Jamui * Katihar * Khagaria * Madhubani * Maharajganj * Mujaffarpur * Munger * Nalanda * Nawada * Pataliputra * Patna * Sahib * Purvi * Champaran * Samastipur * Saran * Sarasam * Sitamarhi * Siwan * Valmiki * Nagar * Paschim * Champaran * Aurangabad * Banka * Begusarai * Hajipur * Jhanjharpur * Karakat * Kishanganj * Madhepura * Purnia * Sheohar * Vaishali * Buxar * Darbhanga * Supaul * Ujiarpur * Arrah * Bhagalpur * Chandigarh * Bastar * Durg * Sabarkantha * Surat * Vadodara * Kachchh * Banaskantha * Bardoli * Patan * Porbandar * Surendranagar * Panchmahal * Valsad * Bhiwani * Faridabad * Gurgaon * Hisar * Gwalior * D Dori * Tikam * Garh * Davanagere * Hassan * Mandya * Tumkur * Uttara * Kannada * Chamrajanagar * Alapuzha * Alathur * Att Gal * Ernakulam * Kannur * Kasaragod * Kollam * Kottayam * Kozhikode * Palakkad * Pathanamthitta * Ponnani * Thiruvananthapuram * Hamirpur * Kangra * Mandi * Shimla * Anantnag * Baramullah * Jammu * Ladakh * Sr Agar * Udhampur * Chatra * Giridih * Godda * Hazaribagh * Jamshedpur * Palamu * Rajmahal * Dumka * Khunti * Ranchi * Dhanbad * S Ghbhum * Kodarama * Lohardagga * Bagalkot * Bangalore * Central * Bangalore * North * Bangalore * Rural * Bangalore * South * Belgaum * Bellary * Bidar * Bijapur * Chikkballapur * Dharwad * Gulbarga * Haveri * Kolar * Koppal * Mysore * Raichur * Shimoga * Udupi * Chikkodi * Chitradurga * Daksh A * Kannada * Thrissur * Vadakara * Chalakudy * Idukki * Malappuram * Mavelikkara * Wayanad * Lakshadwep * Balaghat * Bhopal * Chh Dwara * Dhar * Guna * Gwalior * Hosangabad * Dore * Betul * Damoh * Khandwa * Khandwa * Khargone * Mandsaur * Morena * Ratlam * Rewa * Sagar * Satna * Jabalpur * Tikamgarh * Khajuraho * Vidisha * Bh D * Sidhi * Shahdol * Ujja * Dewas * Rajgarh * Mandla * Akola * Amrawati * Aurangabad * Beed * Bhandara Gondiya * Bhiwandi * Buldhana * Dhule * Ahmednagar * Gadchiroli * H Goli * Jalgaon * Jalna * Kalyan * Kolhapur * Latur * Maval * Mumbai North Central * Mumbai Nwest * Mumbai South Central * Nagpur * Nanded * Nandurbar * Nashik * North * Mumbai * Palghar * Parbhani * Pune * Raigad * Ramtek * Ratnagiri * Chandrapur * S.Mumbai * Sangli * Satara * Shirdi * Shirur * Solapur * Thane * Wardha * Yavatmal Washim * Baramati * Hatkanangle * Madha * Mumbai North East * Osmanabad * D Dori * Raver * Ner * Manipur * Outer * Manipur * Shillong * Tura * Mizoram * Nagaland * Chandni * Chowk * East * Delhi * N.Delhi * North * East * North * West * South * Delhi * West * Delhi * Arani * Chennai * Central * Chennai * North * Chennai * South * Chidambaram * Coimbatore * Dharmapuri * D Digul * Erode * Kallakurichi * Kancheepuram * Kanniyakumari * Karur * Krishnagiri * Madurai * Mayiladuthurai * Nagapatt Am * Namakkal * East * Tripura * W.Tripura * Agra * Aligarh * Allahabad * Ambedkar * Nagar * Amethi * Amroha * Aonla * Baghpat * Ballia * Barabanki * Bareilly * Basti * Bulandshahr * Chandauli * Dhaurahra * Domriyaganj * Etawah * Faizabad * Gautam * Buddha * Nagar * Ghaziabad * Banda * Ghosi * Gonda * Gorakhpur * Hamirpur * Bijnor * Hathrus * Jalaun * Jaunpur * Jhansi * Kanpur * Kaushambi * Farrukhabad * Lucknow * Machhli * Shahar * Ma Puri * Mathura * Meerut * Andaman * * Nicobar * Amalapuram * Anaka * Pally * Anantapur * Araku * Chittoor * Eluru * Guntur * H Dupur * Kadapa * Kak Ada * Machilipatnam * Narasaraopet * Nellore * Rajahmundry * Srikakulam * Tirupathi * Vijayawada * Visakhapatnam * Vizianagaram * Nandyal * Rajampet * Kurnool * Ongole * Narsapuram * Bapatla * * East * * West * Barpeta * Dhubri * Dibrugarh * Gauhati * Jorhat * Kaliabor * Lakhimpur * Mangaldoi * Nawgong * Silchar * Tezpur * Autonomous * District * Kokrajhar * Karimganj * Araria * Karnal * Kurukshetra * Rohtak * Sirsa * Sonipat * Ambala * Aska * Balasore * Berhampur * Bhadrak * Bhubaneswar * Bolangir * Cuttack * Dhenkanal * Jagats Ghpur * Pithampur * Sanwer * Ujja * Kalahandi * Kandhmal * Kendrapara * Mayurbhanj * Nabarangpur * Puri * Sambalpur * Sundargarh * Bargarh * Koraput * Keonjhar * Jajpur * Puducherry * Amritsar * Anandpur * Sahib * Bhat Da * Faridkot * Ferozpur * Gurdaspur * Jalandhar * Ludhiana * Patiala * Sangrur * Fatehgarh * Sahib * Hoshiarpur * Khadoor * Sahib * Ajmer * Alwar * Barmer * Bharatpur * Bhilwara * Bikaner * Chittorgarh * Churu Hawai * * Anjaw * Hawa * Ichanglang * Dibang Valley * An I * East Kameng * Seppa * East Siang * Kra Daadi * Jam * Kurung Kumey * Koloriang * Tezu * Longd G * Longd G * Subansiri * Ziro * Namsai * Namsai * Yupia * Papum Pare * Yupia * Siang * Pang Siang * Siang * Pang * Tawang * Khonsa * Baksa * Mushalpur * Barpeta * Bishwanath * Cachar * Dhemaji * Sonari * Kajalgaon * Dhubri * Dibrugarh * Dima Hasao * Haflong * Golaghat * Hojai * Dibrugarh * Dhubri* Goalpara * Golaghat * Hailakandi * Hojai * Jorhat * Kamrup * Am Gaon * Guwahati * Karbi Anglong * Diphu * Karimganj * Kokrajhar * North * Lakhimpur * Garamur * Majuli * Morigaon * Nagaon * Nalbari * Sibsagar * Sivasagar * Hats Gimari * Sivasagar * Sonitpur * Tezpur * T Sukia * Udalguri * Anglong[10] * Hamren * West Karbi * * Araria * Arwal * Aurangabad * Banka * Begusarai * Bhagalpur * Arrah * Buxar * Darbhanga * Bhojpur * East * Champaran * Motihari * Gaya * Gopalganj * Jamui * Kaimur * Bhabua * K Nalanda Hagaria * Katihar * Kishanganj * Lakhisarai * Madhepura * Madhubani * Munger * Muzaffarpur * Sharif * Patna * Rohtas * Sasaram * Sasaram * Saharsa * Samastipur * Nawada * Chhapra * Sheikhpura * Sheikhpura * Sitamarhi * Siwan * Supaul * Vaishali * Hajipur * Bettiah * Champaran * * Balod* Baloda Bazar * Balrampur * Jagdalpur * Bemetara * Bijapur * Bilaspur * Dantewada * Bastar * Dhamtari * Durg * Gariaband * Naila Janjgir * Jashpur * Kawardha * Kabirdham * In Kabirdham * (Formerly Kawardha)* Kanker * Kondagaon * Korba * Baikunthpur * Mahasamund * Mungeli * Narayanpur * Raigarh * Raipur * Rajnandgaon * Sukma * Surajpur * Surguja * Delhi* In New Delhi * Connaught * Place * North Delhi * Sadar Bazaar North East * Shahdara * Delhi * Shahdara * Saket * Defence * South East * Delhi * Defence * Colony * South West Delhi * Vas Ant V Ihar * West Delh * South West Delhi * GOA * North Goa * Panaji * Margao * COMPUTER EDUCATION FRANCHISE Franchise In South Goa * * Ahmedabad * Amreli * Anand * Modasa * Banaskantha * Palanpur * Bharuch * Bhavnagar * Botad * Chhota Udaipur * Dahod * Ahwa * Devbhoomi Dwarka * Khambhalia * Gandh Agar * Gir Somnath * Veraval * Jamnagar * Junagadh * Kheda * Nadiad * Kutch * Bhuj * Lunavada * Mahisagar * Mehsana * Rajpipla * Morbi * Navsari * Panchmahal * Godhra * Patan * Porbandar * COMPUTER EDUCATION FRANCHISE Franchise In Rajkot * Sabarkantha * Himatnagar * Surat * Surendranagar * Tapi * Vyara * Vadodara * Valsad * Narmada * Ambala * Bhiwani * Charkhi Dadri * Faridabad * Fatehabad * Gurgaon * Hissar * Jhajjar * J D * Panipat Kaithal * Karnal * Kurukshetra * Mahendragarh * Narnaul * Nuh * Mewat * Palwal * Panchkula * Rewari * Rohtak * Sirsa * Sonipat * Yamuna Nagar* Bilaspur * Chamba * Hamirpur * Kangra * Dharamshala * K Naur * Reckong Peo * Kullu * Lahaul And Spiti * Keylong * Mandi * Shimla * Sirmaur * Nahan * Una * Solan * Jammu And Kashmir * Anantnag * Bandipore * Baramulla * Badgam * Doda * Ganderbal * Jammu * Kargil * Kathua * Kishtwar * Kulgam * Kupwara * Leh * Poonch * Pulwama * Rajouri * Ramban * Reasi * Samba * Shopian * Shupiyan * Sr Agar * Udhampur * Bokaro * Chatra * Deoghar * Dhanbad * Dumka * Jamshedpur * Garhwa * Giridih * Godda * Gumla * Hazaribag * Jamtara Khunti * Koderma * Latehar * Lohardaga * Pakur * Palamu * Daltonganj * Ramgarh * Ranchi * Sahibganj * Neraikela * Kharsawan * Simdega * Chaibasa * West S Ghbhum * Bagalkot * Ballari * Belagavi * Bengaluru Rura * Bengaluru * Urban * Bidar * Chamarajanagar * Franchise In Chikkaballapur * Chikmagalur * Chitradurga * Mangaluru * Davangere * Dharwad * Gadag * Gadag-Betageri * Hassan * Haveri * Kalaburagi * Madikeri * Kodagu * Koppal* Kolar * Mandya * Mysuru * Raichur * Ramanagara * Shivamogga * Tumakuru * Karwar * Udupi * Vijayapura * Yadgir * Uttara Kannada * Karwar * Vijayapura * Yadgir * * Alappuzha * Ernakulam * Kakkanad * Pa Avu * Kannur * Kasaragod * Kollam * Kottayam * Idukki * Kozhikode * Malappuram * Palakkad * Pathanamthitta * Thrissur * Pathanamthitta * Thrissur * Wayanad * Kalpetta * Thiruvananthapuram * * Agar Malwa * Anuppur * Alirajpur * Agar * Ashok Nagar * Balaghat * Barwani * Betul * Bh D * Bhopal * Burhanpur * Chhatarpur * Chh Dwara * Damoh * Datia * Dewas * Dhar * D Dori * Harda * Hoshangabad * Dore * Jabalpur * Jhabua * Katni * Khandwa * Khandwa (East Nimar) * Khargone (West Nimar) * Khargone * Mandla * Mandsaur * Morena * Nars Ghpur * Neemuch * Panna * Raisen * Rajgarh * Rewa * Ratlam * Sagar * Satna * Sehore * Seoni * Shahdol * Shajapur * Sheopur * Shivpuri * Sidhi * Tikamgarh * Waidhan * Tikamgarh * Ujja * Umaria * Vidisha . Maharashtra * Ahmednagar * Akola * Amravati * Aurangabad * Beed * Bhandara * Buldhana * Chandrapur * Dhule * Gadchiroli * Gondia * H Goli * Jalgaon * Jalna * Kolhapur * Latur * Mumbai * Mumbai City * Latur * Suburban * Suburban * Bandra (East) * Nanded * Nandurbar * Nagpur * Nashik * Osmanabad * Palghar * Parbhani * Pune * Alibag * Raigad * Ratnagiri * Sangli * Satara * S Dhudurg * Oros * Solapur * Thane * Wardha * Washim * Yavatmal * Manipur * Bishnupur * Churachandpur * Chandel * Imphal East * Porompat * Senapati * Tamenglong * Thoubal * Ukhrul * Imphal West * Lamphelpat * Meghalaya * East Garo Hills * Williamnagar * East Khasi Hills * Shillong * Khleihriat * North Garo Hills * East Ja Tia Hills * Resubelpara * Ri Bhoi * Nongpoh * South Garo Hills * Baghmara * Ampati * South West Khasi Hills * Mawkyrwat * South West Garo Hills * West Ja Tia Hills * Jowai * West Garo Hills * Tura * West Khasi Hills* Nongsto * Mizoram * Aizawl * Champhai * Kolasib * Lawngtlai * Lunglei * Mamit * Saiha * Serchhip * Nagaland * Dimapur * Kiphire * Kohima * Longleng * Mokokchung * Mon * Peren * Phek * Tuensang * Wokha * Zunheboto * Gangtok * Odisha * Angul * Boudh * Bhadrak * Balangir * Bargarh * Balasore * Cuttack * Balasore * Cuttack * Debagarh * Dhenkanal * Chhatrapur * Ganjam * Gajapati * Paralakhemundi * Jharsuguda * Jajpur * Panikoili * Jagats Ghpur * Khordha * Kendujhar * Kmayurbhanjalahandi * Bhawanipatna * Kandhamal * Phulbani * Koraput * Kendrapara * Malkangiri * Baripada * Nabarangpur * Nuapada * Nayagarh * Puri * Rayagada * Sambalpur * Subarnapur * Sundargarh * Puducherry * Karaikal * Mahé * Yanam * Pondicherry * Punjab * Amritsar * Bath Da * Firozpur * Faridkot * Fatehgarh Sahib * Fazilka* Gurdaspur * Hoshiarpur * COMPUTER EDUCATION FRANCHISE Franchise In Barnala * Jalandhar * Kapurthala * Ludhiana * Mansa * Sri Muktsar Sahib * Pathankot * Patiala * Moga * Sri Muktsar Sahib * Pathankot * Patiala * Rupnagar * Sahibzada Ajit S Gh Nagar * Ajitgarh * Sangrur * Nawanshahr * Shahid Bhagat S Gh Nagar * Nawanshahr * Tarn Taran Sahib * Tarn Taran * Rajasthan * Ajmer * Alwar * Bikaner * Barmer * Bharatpur * Baran * Bundi * Bhilwara * Churu * Chittorgarh * Banswara * Dausa * Dholpur * Dungarpur * Ganganagar * Hanumangarh * Jhunjhunu * Jodhpur * Karauli * Jhalawar * Kota * Nagaur * Pratapgarh * Rajsamand * Sikar * Pali * Sawai Madhopur * Tonk * Udaipur * Sikkim * East Sikkim * Gangtok * Mangan * North Sikkim * South Sikkim * Namchi * West Sikkim * Geyz G * Tamil NADU * Ariyalur * Coimbatore* Chennai * Cuddalore * D Digul* Erode * Kanchipuram * Dharmapuri * Karur * Kanyakumari * Nagercoil * Krishnagiri * Nagapatt Am * Madurai * Nilgiris * Namakkal * Perambalur * Pudukkottai * Salem * Sivaganga * Udagamandalam (Ootacamund/Ooty * Tiruchirappalli * Tirunelveli * Theni * Thanjavur * Thoothukudi * Tiruvallur * Ramanathapuramv * Tirupur * Tiruvarur * Tiruvannaamalai * Vellore * Viluppuram Virudhunagar * Vellore * Viluppuram * Tripura * Dhalai * Ambassa * Gomati * Udaipur* Tripura * Khowai * North Tripura* Dharmanagar * Sepahijala * South Tripura * Bishramganj * Belonia * Unokoti * Kailashahar * Agartala * West Tripura * Telangana * Adilabad* Komaram Bheem Asifabad * Asifabad * Bhadradri Kothagudem * Kothagudem * Hyderabad * Jagtial* Jangaon * Jayashankar Bhupalpally * Bhupalpalle * Jogulamba Gadwal* Kamareddy * Karimnagar * Khammam* Mahabubabad * Mahbubnagar * Medak * Medchal* Mancherial * Malkajgiri * Nalgonda * Nagarkurnool * Nirmal * Nizamabad * Rajanna Sircilla * Peddapalli * Sircilla* Sangareddy * Siddipet * Suryapet * Vikarabad * Wanaparthy * Bhongiri Hyderabad * Ranga Reddy * Warangal (Urban) * Warangal (Rural) * Yadadri Bhuvanagiri * Uttar Pradesh * Agra* Aligarh* Allahabad* Ambedkar Nagar * Akbarpur * Gauriganj * Amroha * Auraiya * Amethi (Chhatrapati Shahuji Maharaj Nagar) Amroha (Jyotiba Phule Nagar) * Azamgarh * Bagpat* Bahraich * Ballia* Balrampur * Banda* Barabanki * Bareilly * Basti * Budaun * Chandauli * Bijnor * Chitrakoot* Deoria * Etah * Etawah * Faizabad * Farrukhabad* Fatehgarh * Fatehpur * Firozabad * Gautam Buddh Nagar * Noida * Ghaziabad * Ghazipur * Gonda * Orai* Jaunpur * Gorakhpu * Hamirpur* Hapur* Hardoi* Hathras (Mahamaya Nagar) * Jalaun * Jhansi * Hapur (Panchsheel Nagar) * Kannauj * Akbarpur (Mati)* Kanpur Nagar * Manjhanpur * Kanpur Dehat (Ramabai Nagar)* Ram Nagar) * Kasganj* Kaushambi * Padrauna* Kasganj (Kanshi * Lakhimpur Kheri * Kush Agar * Lalitpur* Lucknow * Maharajganj * Mahoba * Ma Puri * Mathura * Mau* Meerut* Mirzapur * Moradabad * Muzaffarnagar* Pilibhit* Raebareli * Pratapgarh * Rampur * Saharanpur * Sambhal (Bheem Nagar)* Sant Kabir Nagar * Khalilabad * Sant Ravidas Nagar* Gyanpur* Shahjahanpur * Shamli * Shravasti * Siddharthnagar * Navgarh* Sitapur* Sonbhadra * Robertsganj * Unnao * Varanasi * Sultanpur * Uttarakhand * Almora* Bageshwar* Chamoli* Gopeshwar * Champawat * Dehradun * Haridwar * Na Ital * Pauri Garhwal * Pauri * Pithoragarh * Rudraprayag * Tehri Garhwal * New Tehri * Udham S Gh Nagar * Rudrapur * Uttarkashi * West Bengal * Alipurduar * Bankura * Bardhaman * Birbhum * Suri * Cooch Behar * Balurghat* Darjeel G * Daksh D Ajpur* Hooghly* Ch Surah* Howrah * Jalpaiguri * Kalimpong * Kolkata * Maldah* Jhargram * English Bazar * Baharampur * Krishnanagar * Nadia * Murshidabad * Nadia * North 24 Parganas * Barasat * Midnapore * Purba Med Ipur * Tamluk * Purulia * Paschim Med Ipur * Alipore* Raiganj * Uttar D Ajpur * South 24 Parganas * Raiganj</p>
                     </marquee>
                  </div>
               </div>
            </div>
         </section>
         <!--Testimonial Section-->
         <!--End Testimonial Section-->
         <!--Main Footer-->
         <section class="choose-us">
            <div class="auto-container">
               <div class="row clearfix">
                  <div class="column col-lg-12 col-md-12 col-sm-12 col-xs-12 pull-right">
                     <section class="sponsors-style-one">
                        <div class="sponsors-outer">
                           <!--Sponsors Carousel-->
                           <ul class="sponsors-carousel">
                              <li class="slide-item">
                                 <figure class="image-box"><img src="<?=THEME_PATH?>/upload/gallery/16276267471034650577.html" alt="" style="height:150px;"></figure>
                              </li>
                              <li class="slide-item">
                                 <figure class="image-box"><img src="<?=THEME_PATH?>/upload/gallery/16276267901822303391.html" alt="" style="height:150px;"></figure>
                              </li>
                              <li class="slide-item">
                                 <figure class="image-box"><img src="<?=THEME_PATH?>/upload/gallery/16276268041572406158.html" alt="" style="height:150px;"></figure>
                              </li>
                              <li class="slide-item">
                                 <figure class="image-box"><img src="<?=THEME_PATH?>/upload/gallery/1627626820362909136.html" alt="" style="height:150px;"></figure>
                              </li>
                              <li class="slide-item">
                                 <figure class="image-box"><img src="<?=THEME_PATH?>/upload/gallery/1627626835509677227.html" alt="" style="height:150px;"></figure>
                              </li>
                              <li class="slide-item">
                                 <figure class="image-box"><img src="<?=THEME_PATH?>/upload/gallery/16276268511441978413.html" alt="" style="height:150px;"></figure>
                              </li>
                              <li class="slide-item">
                                 <figure class="image-box"><img src="<?=THEME_PATH?>/upload/gallery/16276268781204677628.html" alt="" style="height:150px;"></figure>
                              </li>
                              <li class="slide-item">
                                 <figure class="image-box"><img src="<?=THEME_PATH?>/upload/gallery/16276268931936810359.html" alt="" style="height:150px;"></figure>
                              </li>
                              <li class="slide-item">
                                 <figure class="image-box"><img src="<?=THEME_PATH?>/upload/gallery/1627626912386503670.html" alt="" style="height:150px;"></figure>
                              </li>
                              <li class="slide-item">
                                 <figure class="image-box"><img src="<?=THEME_PATH?>/upload/gallery/16276269621217650392.html" alt="" style="height:150px;"></figure>
                              </li>
                              <li class="slide-item">
                                 <figure class="image-box"><img src="<?=THEME_PATH?>/upload/gallery/16276269771896632416.html" alt="" style="height:150px;"></figure>
                              </li>
                              <li class="slide-item">
                                 <figure class="image-box"><img src="<?=THEME_PATH?>/upload/gallery/16276270001428718320.html" alt="" style="height:150px;"></figure>
                              </li>
                              <li class="slide-item">
                                 <figure class="image-box"><img src="<?=THEME_PATH?>/upload/gallery/16276270141830269829.html" alt="" style="height:150px;"></figure>
                              </li>
                              <li class="slide-item">
                                 <figure class="image-box"><img src="<?=THEME_PATH?>/upload/gallery/16276270282124640587.html" alt="" style="height:150px;"></figure>
                              </li>
                              <li class="slide-item">
                                 <figure class="image-box"><img src="<?=THEME_PATH?>/upload/gallery/16276270431147106047.html" alt="" style="height:150px;"></figure>
                              </li>
                              <li class="slide-item">
                                 <figure class="image-box"><img src="<?=THEME_PATH?>/upload/gallery/16276270591660916516.html" alt="" style="height:150px;"></figure>
                              </li>
                              <li class="slide-item">
                                 <figure class="image-box"><img src="<?=THEME_PATH?>/upload/gallery/1627627073727272821.html" alt="" style="height:150px;"></figure>
                              </li>
                              <li class="slide-item">
                                 <figure class="image-box"><img src="<?=THEME_PATH?>/upload/gallery/16276270931597627968.html" alt="" style="height:150px;"></figure>
                              </li>
                              <li class="slide-item">
                                 <figure class="image-box"><img src="<?=THEME_PATH?>/upload/gallery/1627627107482648771.html" alt="" style="height:150px;"></figure>
                              </li>
                              <li class="slide-item">
                                 <figure class="image-box"><img src="<?=THEME_PATH?>/upload/gallery/16276271231439007269.html" alt="" style="height:150px;"></figure>
                              </li>
                              <li class="slide-item">
                                 <figure class="image-box"><img src="<?=THEME_PATH?>/upload/gallery/1627627137241616003.html" alt="" style="height:150px;"></figure>
                              </li>
                              <li class="slide-item">
                                 <figure class="image-box"><img src="<?=THEME_PATH?>/upload/gallery/1627627166860178916.html" alt="" style="height:150px;"></figure>
                              </li>
                              <li class="slide-item">
                                 <figure class="image-box"><img src="<?=THEME_PATH?>/upload/gallery/16276271851122481823.html" alt="" style="height:150px;"></figure>
                              </li>
                              <li class="slide-item">
                                 <figure class="image-box"><img src="<?=THEME_PATH?>/upload/gallery/1627627205669135746.html" alt="" style="height:150px;"></figure>
                              </li>
                           </ul>
                        </div>
                     </section>
                  </div>
               </div>
            </div>
         </section>
      </div>
      <!--End pagewrapper-->
      
<?php
   }
   
   ?>
<?
   if(DEFAULT_PAGE != $page_id){
       // include 'includes/default.php';
 		
   ?>
   <?php 
   	if($page_header != '' && $page_header != 'N/A'){
		echo "<img src='/uploads/pages/$page_header' style='width:100%;' />";
    }
   ?>
<div id="all" class="container-fluid">
   
   <div id="content" class="container container mt-md-5 mt-4 mb-md-5 mb-4">
      <?
   		// error_reporting(E_ALL);ini_set('display_errors',1);
   		 define('CONTENT',$content);
         echo $content;
   
   			function arrangePage($type,$key){
             switch($type){
                 case 'content':
                     echo '<div class="container">';
                     // echo CONTENT;
                     echo '</div>';
                 break;
                 case $type:
                     if(function_exists($type))
                         $type();
                 break;
             }
         }
         
         $schema = $con->query("SELECT * FROM `web_schema` WHERE `page_id` = '$page_id' ORDER BY `sort` ASC  ");
         while($s = $schema->fetch_assoc()){
             echo '<main id="main">';
             arrangePage($s['type'],$s['key_id']);
             echo '</main>';
         }
         
         
         function get_gallery(){
         global $con;
         echo '<section class="container">';
         $cat = $con->query("SELECT * FROM gallery_category order by seq asc");
         
         while($c = $cat->fetch_assoc()){
         var_dump($c);
         exit;
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
         global $con;
         ?>
      <div class="container">
         <div class="col-sm-12">
            <br>
         </div>
         <div class="col-sm-9">
            <div class="box">
               <h3 class="mb5"><i class="fa fa-building-o" aria-hidden="true"></i> Address</h3>
               <div class="contactDetail-box boder-none">
                  <ul>
                     <li style="margin-bottom: 2px;"><i class="fa fa-map-marker" aria-hidden="true"></i> <?=getSetting('contact_address');?> </li>
                     <li><i class="fa fa-phone"></i><?=getSetting("contact_mobile");?></li>
                     <li><i class="fa fa-envelope"></i> <a href="mailto:<?=getSetting('contact_email');?>" class="orange-text"><?=getSetting('contact_email');?></a></li>
                  </ul>
               </div>
               <div class="contact-map">
                  <?=getSetting('contact_map');?>
               </div>
            </div>
         </div>
         <!-- /#blog-post -->
         <div class="col-md-3 clearfix-xs clearfix-sm">
            <!-- *** BLOG MENU ***
               _________________________________________________________ -->
            <div class="panel panel-default sidebar-menu">
               <div class="panel-heading">
                  <h3 class="panel-title"><i class="fa fa-phone-square" aria-hidden="true"></i> Contact Us</h3>
               </div>
               <div class="panel-body">
                  <div class="panel-group" id="accordion">
                     <?
                        $get = $con->query("SELECT * FROM student_files WHERE `type` = 'contact_tabs' ");
                        $i=0;
                        while($m = $get->fetch_assoc())
                        {
                        echo '<div class="panel panel-default">
                                       <div class="panel-heading Footer-accordian-h4">
                                         <h4 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$i.'"> '.ucwords($m['title']).' </a> </h4>
                                       </div>
                                       <div id="collapse'.$i++.'" class="panel-collapse collapse">
                                         <div class="panel-body accordian-body">
                                           '.$m['description'].'
                                         </div>
                                       </div>
                                     </div>
                                     ';
                        }
                        ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <?
         }
         
         
         
                     ?>
   </div>
</div>
                     <?
                       }
                     ?>
<!--< ?require_once 'includes/footer.php';?>-->
 <?php
  include 'includes/footer.php';
  ?>
   <script>
       $(document).ready(function(){
    $('.customer-logos').slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1500,
        arrows: false,
        dots: false,
        pauseOnHover: false,
        responsive: [{
            breakpoint: 768,
            settings: {
                slidesToShow: 4
            }
        }, {
            breakpoint: 520,
            settings: {
                slidesToShow: 3
            }
        }]
    });
    $('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:3,
            nav:false
        },
        1000:{
            items:4,
              loop:true,
        }
    },
     autoplay:true,
            autoplayTimeout:3000, // Adjust the time in milliseconds
            autoplayHoverPause:true
})
});

   </script>
   <script>
       $(document).ready(function(){
           $('#ContactForm').submit(function(){
               event.preventDefault();
               var formData = $(this).serialize();
               console.log(formData);
               $.ajax({
                   type:'POST',
                   url:'admin/Ajax.php',
                   data:formData,
                   success:function(response){
                       console.log(response);
                       alert("Your Query submitted Successfully");
                       $('#contactform')[0].reset();
                   },
                error:function(error,b,c){
                    alert('Error submitting form. Please try again.');
                }
               });
           });
       });
   </script>