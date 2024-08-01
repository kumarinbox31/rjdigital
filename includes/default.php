<div class="container">
                <div class="col-md-12 xs-padding0">
                    <div id="blog-homepage" class="row">
                        
                        
                        <div class="col-sm-4">
                           <div class="post">
                              <blockquote>
                                 <h4 class="text-left">
                                     
                                    <?=getSetting('default_notices_title');?>
                                 </h4>
                              </blockquote>
                              <hr class="notice-boxHR">
                              <div class="scroll-marquee">
                                 <marquee direction="up" scrollamount="3" scrolldelay="200" behavior="scroll" onmouseover="this.stop();" onmouseout="this.start();" height="150">
                                    <?
                                         $get = $con->query("SELECT * FROM `links` WHERE `type` = 'default_notices'");
                                            if($get->num_rows){
                                                while($row = $get->fetch_assoc()){
                                                    echo '<panel id="fvNews_ctl00_pdfnews" style="font-weight: normal; font-size: 15px;">
                                         <panel class="text-justify"> 
										 <i class="fa fa-pencil-square-o orange-text" aria-hidden="true"></i> 
										 
										 <a href="javascript:void(window.open( \''.$row['link'].'\',\'_blank\',\'toolbar=no,status=no,menubar=no,scrollbars=yes,fullscreen=no,width=800,height=600,left=0,top=0\'))">
                                            <span id="fvNews_ctl00_Label3" style="color: #0A1A32;">'.$row['label'].'</span>
												</a>
										</panel>
                                    </panel>
                                    <h6>  <i class="fa fa-calendar orange-text" aria-hidden="true"></i> Published on
                                       <span id="fvNews_ctl2169_Label1">'.date('d/m/Y',strtotime($row['timestamp'])).'</span>
                                    </h6>';
                                                }
                                            }
                                    ?>
                                    
                                    
                                    
                                 </marquee>
                              </div>
                              <p class="read-more">
                                 <a href="<?=getSetting('notice_readmore_link');?>" class="btn btn-primary btn-xs">Read more</a>
                              </p>
                           </div>
                        </div>
                        <div class="col-sm-4">
                           <div class="post">
                              <blockquote style="background: #EA6A50; color: white;">
                                 <h4 class="text-left" style="color: white;">
                                    <?=getSetting('helpline_no_title');?>
                                 </h4>
                              </blockquote>
                              <hr class="notice-boxHR">
                              <div class="scroll-marquee">
                                 <marquee direction="up" scrollamount="3" scrolldelay="50" behavior="scroll" onmouseover="this.stop();" onmouseout="this.start();" height="150">
                                    <span>
                                        
                                        <?php
                                            $get = $con->query("SELECT * FROM centers where status = 1 ORDER BY id DESC LIMIT 10 ");
                                            // print_r($get);
                                            
                                            if ($get->num_rows) {
                                                while ($row = $get->fetch_assoc()) {
                                                    echo '
                                                        <div style="text-align:center;" >
                                                              <img style="width:100px;height:100px;border:1px solid black" src="uploads/centers/'.$row['image'].'"><br>
                                                              <h5 style="margin:0px"><span>'.$row['institute_name'].'</span></h5>
                                                              <h5 style="margin:0px;">Director Name- <span>'.$row['name'].'</span></h5><br>
                                                          </div>';
                                                }
                                            }
                                            ?>

                                        <!--< ?-->
                                        <!--    $get = $con->query("SELECT * FROM `links` WHERE `type` = 'helpline_nos'");-->
                                        <!--    if($get->num_rows){-->
                                        <!--        while($row = $get->fetch_assoc()){-->
                                        <!--            echo '<h5>'.$row['label'].'<br>-->
                                        <!--                  '.$row['link'].'-->
                                        <!--               </h5><hr>';-->
                                        <!--        }-->
                                        <!--    }-->
                                        <!--?>-->
                                       
                                       
                                    </span>
                                 </marquee>
                              </div>
                              <p class="read-more">
                                 <a href="<?=getSetting('helpline_readmore_link');?>" class="btn btn-primary btn-xs">Read more</a>
                              </p>
                           </div>
                        </div>
                        <div class="col-sm-4">
                           <div class="post">
                              <blockquote style="background: #e8ea50; color: white;">
                                 <h4 class="text-left" style="color: red;">
                                    <?=getSetting('history_title');?>
                                 </h4>
                              </blockquote>
                              <hr class="notice-boxHR">
                              <ul class="list-group" style="max-height: 172px; overflow-y: scroll; margin-bottom: 10px">
                                 <?
                                     $get = $con->query("SELECT * FROM `links` WHERE `type` = 'history_links'");
                                        if($get->num_rows){
                                            while($row = $get->fetch_assoc()){
                                                echo '<li class="list-group-item" style="display: table-row;"><i class="fa fa-caret-right dropdown_fa" aria-hidden="true"></i>
                                                <a href="'.$row['link'].'" target="_blank">
                                                            '.$row['label'].'
                                                        </a>
                                                     </li>';
                                            }
                                        }
                                 ?>
                              </ul>
                           </div>
                        </div> 
                        
                        
                    </div>
                </div>
            </div>
            <div class="container">
               <div class="same-height-row">
                  <div class="col-sm-6 col-md-3 clearfix-xs xs-padding0">
                     <h4 class="Minibox-title" style="background: #F2552C;"><?=getSetting('schemes_title');?></h4>
                     <div class="box box-links">
                        <ul style="min-height: 135px;">
                            <?
                                     $get = $con->query("SELECT * FROM `links` WHERE `type` = 'schemes_links'");
                                        if($get->num_rows){
                                            while($row = $get->fetch_assoc()){
                                              
                                                echo '<li><i class="fa fa-caret-right dropdown_fa" aria-hidden="true"></i><a href="'.$row['link'].'">
                                                       '.$row['label'].'</a>
                                                   </li>';
                                            }
                                        }
                                 ?>
                        </ul>
                        <div class="clearfix">
                        </div>
                        <!--<p class="read-more">
                           <a href="" class="btn btn-primary btn-xs pull-right">View all</a>
                           </p>-->
                     </div>
                  </div>
                  <div class="col-sm-6 col-md-3 clearfix-xs xs-padding0">
                     <h4 class="Minibox-title" style="background: #1F7DDA;"><?=getSetting('student_corner_title');?></h4>
                     <div class="box box-links">
                        <ul style="max-height: 135px; overflow-y: scroll;">
                           <?
                                     $get = $con->query("SELECT * FROM `links` WHERE `type` = 'student_corner_links'");
                                        if($get->num_rows){
                                            while($row = $get->fetch_assoc()){
                                              
                                                echo '<li><i class="fa fa-caret-right dropdown_fa" aria-hidden="true"></i><a href="'.$row['link'].'">
                                                       '.$row['label'].'</a>
                                                   </li>';
                                            }
                                        }
                                 ?>
                        </ul>
                        <div class="clearfix">
                        </div>
                        <!--<p class="read-more">
                           <a href="" class="btn btn-primary btn-xs pull-right">View all</a>
                           </p>-->
                     </div>
                  </div>
                  <div class="col-sm-6 col-md-3 clearfix-xs xs-padding0">
                     <h4 class="Minibox-title" style="background: #407F46;"><?=getSetting('faculty_corner_title');?></h4>
                     <div class="box box-links">
                        <ul style="max-height: 135px; overflow-y: scroll;">
                            <?
                                 $get = $con->query("SELECT * FROM `links` WHERE `type` = 'faculty_corner_links'");
                                    if($get->num_rows){
                                        while($row = $get->fetch_assoc()){
                                          
                                            echo '<li><i class="fa fa-caret-right dropdown_fa" aria-hidden="true"></i><a href="'.$row['link'].'">
                                                   '.$row['label'].'</a>
                                               </li>';
                                        }
                                    }
                             ?>
                        </ul>
                        <div class="clearfix">
                        </div>
                        <!-- <p class="read-more">
                           <a href="" class="btn btn-primary btn-xs pull-right">View all</a>
                           </p>-->
                     </div>
                  </div>
                  <div class="col-sm-6 col-md-3 clearfix-xs xs-padding0">
                     <h4 class="Minibox-title" style="background: #BF8D2C;"><?=getSetting('covid_info_title');?> </h4>
                     <div class="box box-links">
                        <!--<a href="https://www.ugc.ac.in/subpage/covid_helpdesk.aspx">-->
                        <!--<img src="https://www.ugc.ac.in/pdfnews/newcovid.jpg" width="200" height="100" alt="Helpline Number for COVID-19 Related Grievances: 1800111657 and Email id is: covid19help.ugc@gov.in">-->
                        <!--</a>-->
                        <br>
                        <?
                             $get = $con->query("SELECT * FROM `links` WHERE `type` = 'covid_info_links'");
                                if($get->num_rows){
                                    while($row = $get->fetch_assoc()){
                                        echo '<panel id="fvNews_ctl892_pdfnews" style="font-weight: normal;">
                                           <panel class="text-justify"> 
                                              <i class="fa fa-pencil-square-o orange-text" aria-hidden="true"></i> 
                                              <a href="'.$row['link'].'" target="blank" style="font-size: 20px;color:#f13c0c;">
                                              <span id="fvNews_ctl892_Label3" style="color: #f13c0c;size:20px;">'.$row['label'].'</span>
                                              </a>
                                           </panel>
                                        </panel>';
                                    }
                                }
                        ?>
                        
                     </div>
                  </div>
               </div>
               <div class="clearfix"></div>
               <div class="same-height-row">
                  <div class="col-sm-6 col-md-3 clearfix-xs xs-padding0">
                     <h4 class="Minibox-title" style="background: #F2552C;"><?=getSetting('scholarship_title');?></h4>
                     <div class="box box-links">
                        <ul style="max-height: 93px; overflow-y: scroll;">
                            <?
                                 $get = $con->query("SELECT * FROM `links` WHERE `type` = 'scholarship_links'");
                                    if($get->num_rows){
                                        while($row = $get->fetch_assoc()){
                                            echo '<li><i class="fa fa-caret-right dropdown_fa" aria-hidden="true"></i><a href="'.$row['link'].'">'.$row['label'].'</a></li>';
                                        }
                                    }
                            ?>
                        </ul>
                        <div class="clearfix">
                        </div>
                        <p class="read-more">
                           <a href="<?=getSetting('scholarship_view_link')?>" class="btn btn-primary btn-xs pull-right">View all</a>
                        </p>
                     </div>
                  </div>
                  <div class="col-sm-6 col-md-3 clearfix-xs xs-padding0">
                     <h4 class="Minibox-title" style="background: #1F7DDA;"><?=getSetting('international_title')?></h4>
                     <div class="box box-links">
                        <marquee direction="up" scrollamount="3" scrolldelay="200" behavior="scroll" onmouseover="this.stop();" onmouseout="this.start();" height="150" style="text-align: justify; max-height: 124px">
                           <?
                            $get = $con->query("SELECT * FROM `links` WHERE `type` = 'international_links'");
                                if($get->num_rows){
                                    while($row = $get->fetch_assoc()){
                                        
                                        echo '<panel id="rptic_ctl322_pdfnews1" style="font-weight: normal; font-size: 13px;">
                                              <panel class="text-justify"> 
                                                 <i id="rptic_ctl322_I11" class="fa fa-pencil-square-o orange-text" aria-hidden="true"></i> 
                                                 <a href="javascript:void(window.open( \''.$row['link'].'\',\'_blank\',\'toolbar=no,status=no,menubar=no,scrollbars=yes,fullscreen=no,width=800,height=600,left=0,top=0\'))">
                                                 <span id="rptic_ctl322_Label3" style="color: #0A1A32;">'.$row['label'].' </span>
                                                 </a>
                                              </panel>
                                           </panel>
                                           <h6>  <i class="fa fa-calendar orange-text" aria-hidden="true"></i> Published on
                                              <span id="rptic_ctl322_Label1">'.date('d/m/Y',strtotime($row['timestamp'])).'</span>
                                           </h6>';
                                    }
                                }
                               
                           ?>
                           
                           
                        </marquee>
                        <div class="clearfix">
                        </div>
                        <p class="read-more">
                           <a href="<?=getSetting('international_view_link')?>" class="btn btn-primary btn-xs pull-right">View all</a>
                        </p>
                     </div>
                  </div>
                  <div class="col-sm-6 col-md-3 clearfix-xs xs-padding0">
                     <h4 class="Minibox-title" style="background: #407F46;"><?=getSetting('governance_title')?></h4>
                     <div class="box box-links">
                        <ul style="max-height: 115px; overflow-y: scroll;">
                          <?
                             $get = $con->query("SELECT * FROM `links` WHERE `type` = 'governance_links'");
                                if($get->num_rows){
                                    while($row = $get->fetch_assoc()){
                                        echo '<li><i class="fa fa-caret-right dropdown_fa" aria-hidden="true"></i><a href="'.$row['link'].'" target="_blank">'.$row['label'].'</a></li>';
                                    }
                                }
                          ?>
                           
                           <div class="clearfix">
                           </div>
                           <!--<p class="read-more">
                              <a href="" class="btn btn-primary btn-xs pull-right">View all</a>
                              </p>-->
                        </ul>
                     </div>
                  </div>
                  <!--<div class="col-sm-6 col-md-3 clearfix-xs xs-padding0">-->
                  <!--   <h4 class="Minibox-title" style="background: #BF8D2C;">Grievance &amp; Anti-ragging</h4>-->
                  <!--   <div class="box box-links">-->
                  <!--      <div class="antiRagging">-->
                  <!--         <img src="<?=THEME_PATH?>img/anti-raging.png" class="img-responsive" alt="UGC Anti-ragging">-->
                  <!--         <h5>-->
                  <!--            <span>24x7 Helpline Number</span><br>-->
                  <!--            1800-180-5522 (Toll Free)-->
                  <!--         </h5>-->
                  <!--      </div>-->
                  <!--      <div class="grievance">-->
                  <!--         <a href="https://samadhaan.ugc.ac.in/Home/Index">-->
                              <!-- <img src="<?=THEME_PATH?>img/grievance.jpg" class="img-responsive" alt="UGC Student Grievance" />-->
                  <!--            <img src="https://samadhaan.ugc.ac.in/images/E-samadhan_Logo_New.png" class="img-responsive" alt="UGC Student Grievance">-->
                  <!--         </a>-->
                  <!--      </div>-->
                  <!--   </div>-->
                  <!--</div>-->
               </div>
               <!-- /.row -->
            </div>
            <div class="container">
                    <div class="col-md-12 xs-padding0">
                        <div id="Div3" class="row">
                            
                            <div class="col-sm-12">
                                <h3 class="text-left h3-title">
                                    <span><?=getSetting('digital_initiatives_title');?></span></h3>
                                <div class="bottombig-box" style="min-height: 260px;">
                                    <div id="myCarousel" class="carousel slide">
                                        <a class="btn btn-primary btn-xs pull-left mb5" href="#myCarousel" data-slide="prev"><i class="fa fa-angle-double-left"></i>PREV</a>
                                        <a class="btn btn-primary btn-xs pull-right mb5" href="#myCarousel" data-slide="next">NEXT <i class="fa fa-angle-double-right"></i></a>
                                        <!-- Carousel items -->
                                        <div class="carousel-inner">
                                            <div class="item active">
                                                <div class="row">
                                                    <?
                                                        $start = 0;
                                                        $end = 3;
                                                        $count = 0;
                                                        $get = $con->query("SELECT * FROM student_files WHERE `type` = 'digital_initiatives' LIMIT $start,$end");
                                						$ttl = $con->query("SELECT * FROM student_files WHERE `type` = 'digital_initiatives'")->num_rows;
                                						while($m = $get->fetch_assoc())
                                						{
                                						    echo '<div class="col-sm-4 allLogo-img mb10">
                                                                <a href="'.$m['description'].'" target="_blank">
                                                                    <img src="uploads/downloads/'.$m['file'].'" alt="'.$m['title'].'" class="img-responsive"></a>
                                                                <h5 class="text-center logo-title" style="background: #0172B9;">'.$m['title'].'</h5>
                                                            </div>';
                                						    $count++;
                                						}
                                						$start = $end+1;
                                						$end = $end+3;
                                                    ?>
                                                    
                                                </div>
                                            </div>
                                            <?
                                                $left = $ttl - $count;
                                                if(($left/3) > 0){
                                                    for ($x = 0; $x < round($left/3); $x++) {
                                            ?>
                                                        <div class="item">
                                                <div class="row">
                                                    <?
                                                        $get = $con->query("SELECT * FROM student_files WHERE `type` = 'digital_initiatives' LIMIT $start,$end");
                                                        while($m = $get->fetch_assoc())
                                						{
                                						    echo '<div class="col-sm-4 allLogo-img mb10">
                                                                <a href="'.$m['description'].'" target="_blank">
                                                                    <img src="uploads/downloads/'.$m['file'].'" alt="'.$m['title'].'" class="img-responsive"></a>
                                                                <h5 class="text-center logo-title" style="background: #0172B9;">'.$m['title'].'</h5>
                                                            </div>';
                                						    $count++;
                                						}
                                						$start = $end+1;
                                						$end = $end+3;
                                                    ?>
                                                    
                                                </div>
                                            </div>
                                            <?
                                                    }
                                                }
                                            ?>
                                        </div>

                                    </div>



                                </div>
                            </div>
                        </div>
                        <!-- /#blog-homepage -->
                    </div>
                </div>