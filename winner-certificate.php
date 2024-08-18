<?php 
require_once 'admin/includes/config.php';
require_once 'admin/helpers/winner_certificate.php';
$winner = new Winner_certificate($con);
$enroll = htmlspecialchars($_GET['enrollment_no']);
$winner->enrollment_no = $enroll;
$winner->getByEnrollmentNo();
$winner->getCenter();
if(empty($winner->name)){
  echo '<script>alert("Certificate not found.");location.history();</script>';
}
function convertToThreeDigits($number) {
  return str_pad($number, 3, '0', STR_PAD_LEFT);
}
// echo '<pre>';
// print_r($winner);
// exit;
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Winner Certificate | <?php echo $winner->enrollment_no; ?></title>
     <style>
        body {
  /*background: rgb(204,204,204); */
}
page {
  background: white;
  display: block;
  margin: 0 auto;
  margin-bottom: 0.5cm;
  /*box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);*/
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
            /*overflow:hidden;*/
            /*background-color:#c4a1a2;*/
            font-family: emoji;
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
        
    </style>
    <style>
    @page {
        size: A4;
        margin: 0;
    }
    body {
        margin: 20mm;
    }
</style>
  </head>
      <style>
          .address{
              width: 17rem;
                margin-top: -14.2rem;
                left: 36em;
                font-size: 11px;
                word-wrap: break-word;
          }
          .address::first-line{
              margin-left:0;
          }
            .text-wrapper > p{
              /* font-weight: bold;
              left:17rem; */
              font-size: 20px;
            }
      </style>
      <!-- element css -->
       <style>
        #enrollment_no{
          top: -14.2rem;
          left: 9.2rem;
        }
        #certificate_no{
          top: -25.2rem;
          left: 10.5rem;
        }
        #name{
          top: -22.7rem;
          width: 17rem;
          left: 23rem;
        }
        #father{
          top: -21rem;
          font-size: 20px;
          width: 18rem;
          left: 16rem;
        }
        #exam{
          top: -19rem;
          font-size: 20px;
          width: 32rem;
          left: 2.5rem;
        }
        #center_name{
          top: -17.2rem;
          font-size: 20px;
          width: 42rem;
          left: 2.5rem;
        }
        #grade{
          top: -14.1rem;
          left: 24.2rem;
          width: 7rem;
        }
        #branch_code{
          top: -11.8rem;
    left: 9rem;
    font-size: 16px;
    width: 8rem;
        }
        #issue_date{
          top: -11.6rem;
    left: 24rem;
    font-size: 16px;
    width: 6.5rem;
        }
        #image{
          width: 76px;
    top: -28rem;
    right: 1.3rem;
    height: 5.1rem;
        }
       </style>
  <!-- <body onload="window.print();" style="font-size: small;margin: 0mm;font-family: math;"> -->
  <body style="font-size: small;margin: 0mm;font-family: math;">
            <page size="A5" id="printableArea" layout="landscape">
      <div class="content-wrapper" >
          <img src="format/winner_certificate.jpg" >
          <div class="text-wrapper">
            <p id="certificate_no">RJDCI/WIN/<?php echo convertToThreeDigits($winner->id); ?></p>
            <p id="name"><?php echo @$winner->name; ?></p>
            <p id="enrollment_no"><?php echo @$winner->enrollment_no; ?></p>
            <p id="father"><?php echo @$winner->father; ?></p>
            <p id="center_name"><?php echo @$winner->center->institute_name; ?></p>
            <p id="exam">TOP 10 WINNER COMPETITION EXAMINATION</p>
            <p id="grade"><?php echo @$winner->grade; ?></p>
            <p id="branch_code"><?php echo @$winner->center->center_number; ?></p>
            <p id="issue_date"><?php echo date('d-m-Y',strtotime($winner->issue_date)); ?></p>
            <img src="uploads/winner/<?php echo @$winner->image; ?>" id="image" />
                     
                      <?php
    // Data to encode in the QR code
    $data = BASE_URL."winner-certificate.php?enrollment_no=".$winner->enrollment_no ;
    // Generate QR code and store it in a variable
    ob_start();
    QRcode::png($data, null, QR_ECLEVEL_L, 10, 1);
    $image_data = ob_get_contents();
    ob_end_clean();

    // Display the QR code image
    echo '<img src="data:image/png;base64,'.base64_encode($image_data).'" alt="QR Code" style="height: 4.5rem;
    width: 4.3rem;
    top: -8.8rem;
    left: 2.7rem;" >';
?> 
               
                 
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
