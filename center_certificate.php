<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Certificate | <?=$center_number?></title>
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
    /* @page {
        size: A4;
        margin: 0;
    } */
    body {
        margin: 20mm;
    }
</style>

  </head>
        <?
          $logo = $con->query("SELECT * FROM logo_setting where id = 1")->fetch_assoc();
      ?>
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
              font-weight: bold;
              left:17rem;
              font-size:1rem;
            }
      </style>
      <?php
        // print_r($session);exit;
      ?>
  <body onload="window.print();" style="font-size: small;margin: 0mm;font-family: math;">
  <!--<body>-->
            <page size="A5" id="printableArea" layout="landscape">
      <div class="content-wrapper" >
          <img src="<?=$bg?>" >
          <div class="text-wrapper">
                  <!-- <img src="<?=$img?>" style="height: 6.4rem;width: 4.8rem;top: -18rem;left: 36.8rem;border-radius: 5px "> -->
                  
                    <p style="top: -22.3rem;"><?=$name?></p>
                    <p style="top: -20.5rem;"><?=$center_add?></p>
                  
                    <p style="top: -24.5rem;"><?=$center_number?></p>
                    <p style="top: -16.8rem"><?=date('d-m-Y',strtotime($isu_date));?> To <?=$valid?></p>
                    <p style="top: -18.6rem">All Computer Course</p>
                    <!-- <p style="top: -11.1rem;left: 13.1rem;"><?=$session?></p> -->
                     <!-- <p style="top: -24.5rem;left: 17rem;">SIHS (An ISO 9001 : 2015 Certified Institute)</p> -->
                     <!-- <p style="top: -10.1rem;left: 13.1rem;"></p> -->
                     <p title="aadhar" style="top:-14.7rem"><?php echo $a['aadhar_number']; ?></p>
                     <img style="width: 87px;
    top: -29rem;
    right: 2.5rem;
    height: 6.6rem;" src="../uploads/centers/<?php echo $a['image']; ?>" />
                     
                      <?php
    // Data to encode in the QR code
    $data = "Center  No: " . $center_number ."\nName: " . $name . "\nCenter Name: " . $center_name . "\nAddress: " . $center_add ;

    // Generate QR code and store it in a variable
    ob_start();
    QRcode::png($data, null, QR_ECLEVEL_L, 10, 1);
    $image_data = ob_get_contents();
    ob_end_clean();

    // Display the QR code image
    echo '<img src="data:image/png;base64,'.base64_encode($image_data).'" alt="QR Code" style="height: 5.3rem;
    width: 5.1rem;
    top: -11.5rem;
    left: 2.6rem;" >';
?> 
               
                    
    <!--               <img src="<?php echo $sign; ?>" style="top: -6.5rem;-->
    <!--left: 3rem;-->
    <!--max-width: 24%;-->
    <!--max-height: 2rem;width:auto:height:auto;" alt="Sign not found">-->
                   
                 
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
