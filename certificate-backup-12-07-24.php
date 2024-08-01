<?

$mother = $s['mother'];
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Certificate | <?=$s['enrollment_no']?></title>
     <style>
@media print {
            body, page {
                margin: 0;
                padding: 0;
                box-shadow: none;
                width: 100%;
                height: 100%;
            }
            @page {
                margin: 6px;
            }
        }
        
        body {
  // background: rgb(204,204,204);
}
page {
  background: white;
  display: block;
  margin: 0 auto;
  margin-bottom: 0.5cm;
  // box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
}
page[size="A4"] {  
  width: 21cm;
  height: 29.7cm; 
}
page[size="A4"][layout="landscape"] {
  width: 29.7cm;
  height: 21cm;  
}
page[size="A3"] {
  width: 29.7cm;
  height: 42cm;
}
page[size="A3"][layout="landscape"] {
  width: 42cm;
  height: 29.7cm;  
}
page[size="A5"] {
  width: 14.8cm;
  height: 21cm;
}
page[size="A5"][layout="landscape"] {
  width: 21cm;
  height: 14.8cm;  
}
@media print {
  body, page {
    margin: 0;
    box-shadow: 0;
  padding:0;
  }
}
    </style>
    <style>
        *{
            padding:0;
            margin:0;
        }
        body{
            width:100%;
            height:auto;
           font-family: math;
            font-size: large;
            font-weight: 600;
        }
        .content-wrapper{
            text-align:center;
        }
        .content-wrapper img{
            width:100%;
        }
        .text-wrapper{
                width: 96%;
                position: relative;
               margin-top: 0%;
        }
        .text-wraper h2{
            text-align:center;
            color:#ffffff;
            font-size:10vw;
            
        }
        h4{
            text-align:left;
        }
        #myPhoto{
            width: 167px;
            height: 198px;
            margin-top: 5%;
            margin-right: 2.8%;
        }
        .content{
               margin-top: -33%;
            margin-left: 31%;
            text-align: left;
        }
        #sl{
            text-align:right;
            margin-right: 3%;
        }
        .box{
            margin-top:-1%;
        }
        tr td{
            text-align:center;
        }
        .text-wrapper>div,.text-wrapper>img,.text-wrapper>h1,.text-wrapper>h2,.text-wrapper>h3,.text-wrapper>h4,.text-wrapper>p{
            position:absolute;
        }
        p{
            font-size:1em;
        }
    </style>
  </head>
        <?
          $logo = $con->query("SELECT * FROM logo_setting where id = 1")->fetch_assoc();
		  $sub = $con->query("SELECT subject_name FROM subjects where course_id = '".$s['course_id']."'");
		  $subs = '';
			while($su = $sub->fetch_object()){
				$subs .= "$su->subject_name,";
            }
		 $subs = rtrim($subs,',');
      ?>
  <body onload="window.print();">
  <!--<body>-->
            <page size="A5" id="printableArea" layout="landscape" >
      <div class="content-wrapper" >
          <img src="<?=$bg?>" >
          <div class="text-wrapper">
                    <!--<h2 style="position: absolute;top: -1rem;left: 1rem;width: 100%;"><?=$center_name?></h2>-->
                  <img src="<?=$photo?>" style="height: 7.1rem;width: 5.3rem;top: -48.2rem;left: 39rem;border: 1px solid black;/* border-radius: 10px; */">
      			
                    <p style="top: -42.5rem;left: 16rem;"><?=$name?></p>
      				<p style="top: -48.9rem;left: 10.2rem;"><?=$certificate_no?></p>
                    <p style="top: -35.7rem;left: 15rem;font-size: 15px;"><?=$center_name?></p>
                    <p style="top: -40.4rem;left: 21rem;"><?=$father?></p>
                    <p style="top: -18.5rem;left: 15.5rem;font-size:1rem;"><?=$center_code?></p>
                    <p style="top: -16.2rem;left: 15.3rem;font-size:17px;"><?=date("d-m-Y",strtotime($issue_date))?></p>
                    <p style="top: -22.3rem;left: 23.3rem;width: 6rem;font-size: 17px;"><?=$a['grade'];?></p>
                    <p style="top: -38.4rem;left: 3.7rem;width: 8rem;"><?=$duration?></p>
                    <p style="margin-top: -22.4rem;left: 9.7rem;width: 6.5rem;font-size: 17px;"><?=$enroll_no?></p>
                    <p style="margin-top: -38.3rem;left: 17rem;font-size: medium;"><?=$course_name?></p>
                    <!--<p style="top: -26rem;left: 44rem;">851080<?=$serial?></p>-->
      				<p style="margin-top: -32.5rem;left: 3rem;font-size: 15px;width: 90%;text-align:center"><?=$subs?></p>
                    
<?php
    // Data to encode in the QR code
    $data = "Enrollment No: " . $enroll_no ."\nName: " . $name . "\nFather's Name: " . $father . "\nMother's Name: " . $mother . "\nDate of Birth: " . $dob;
	$dob = date('Y-m-d',strtotime($s['dob']));
$data = BASE_URL."view-certificate.php?certificate-no=$certificate_no";
$data = BASE_URL."get_certificate.php?certificate-no=$certificate_no&dob=$dob";
    // Generate QR code and store it in a variable
    ob_start();
    QRcode::png($data, null, QR_ECLEVEL_L, 10, 1);
    $image_data = ob_get_contents();
    ob_end_clean();

    // Display the QR code image
    echo '<img src="data:image/png;base64,'.base64_encode($image_data).'" alt="QR Code" style="height: 6rem;width: 6rem;top: -20.5rem;left: 3.2rem;border: 1px solid black;" >';
?>
                    
                    <!--<img src="https://chart.googleapis.com/chart?cht=qr&chl=https://psdm.softguru.co.in/get_certificate.php&chs=160x160&chld=L|0" style="height: 6.9rem;width: 7rem;top: -27.3rem;left: 1.2rem;" class="qr-code img-thumbnail img-responsive" />                 -->
                 
          </div>
      </div>
      </page>
      




   <script>
    function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
