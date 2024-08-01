<?
require_once 'includes/header.php';
$get = $con->query("SELECT * FROM his_page where id = '".$_GET['page_id']."'")->fetch_assoc();
?>
<div class="container" align="left">
    <div class="row" align="center">
        <? if($get['page_header']!=''):?>
        <!--<img style="width:70%;height:450px" src="uploads/pages/<?=$get['page_header']?>">-->
        <? endif?>
    </div>
	<h1 align="center" style="text-decoration:underline;color:red"><strong><?=strtoupper($get['page_name'])?></strong></h1>
	<?
	    if($get['id'] == 9)
	    {
	        $course = $con->query("SELECT * FROM site_courses");
	            while($c = $course->fetch_assoc()){
	        ?>
	                <div class="single-item-wrapper">
                                    <div class="courses-content-wrapper">


                                        <h3 class="item-title"><a href="javascript:void(0)"><?=$c['title']?></a></h3>
                                        <ul class="courses-info">
                                            <li>Eligibility :<?=$c['eligibility']?></li>
                                            <li>Duration : <?=$c['duration']?></li>
                                        </ul>
                                        <div class="courses-fee"><a data-toggle="collapse" data-target="#<?=$c['id']?>" class="collapsed" aria-expanded="false">click to view topics</a></div>
                                        <div class="clear"></div>
                                        <div id="<?=$c['id']?>" class="collapse" aria-expanded="false" style="height: 0px;">
                                            <h4>Topics</h4>
                                                <?=$c['content']?>                             
                                            </div>
    
                                        </div>
    
    
    
                                    </div>
	        <?
	            }
	    }
	    else if($get['id'] == 12)
	    {
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
            echo '</div>';
	    }
	    else if($get['id'] == 13)
	    {
	       // $get = $con->query("SELECT * from contact_us where id = 1")->fetch_assoc();
	        ?>
	            	<div class="ContentHolder">
    	    <div class="container" style="width:100%">
    	        <div class="row" align="center">
    	            <!--<img style="width:80%;height:250px" src="uploads/downloads/product__1612505974WhatsApp Image 2021-02-04 at 4.02.07 PM.jpeg">-->
    	        </div>
    	        <br><br><br><br>
    	        <div class="col-lg-4 col-sm-12 col-xs-12" >
    	            
    	            <!--<iframe src="<?=$setting['gmap']?>" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"></iframe>-->
    	        </div>
    	        <div class="col-lg-6 col-sm-12 col-xs-12">
    	            	<!--<h1>Contact Us</h1>-->
    		  
    			<div class="box box-primary ">
    				<div class="box-header"><h3>Contact Query</h3></div>
    				<div class="box-body">
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
    						<div class="form-group"></div>
    						<div class="form-group">
    							<button class="btn btn-primary" type="submit" name="status" value="contact_query">Send</button>
    						</div> 
    					</form>
    				</div>
    			</div>
    	        </div>
    	    </div>
    	
    	
    		
    	</div> 
	        <?
	    }
	    else{
	       echo $get['content'];
	    }
	    
	?>


</div>
<?
include 'includes/footer.php';
?>