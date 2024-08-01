<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Admit Card | <?=$s['enrollment_no']?></title>
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
        margin: 10px;
    }
    body {
        // margin: 20mm;
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
      </style>
  <body onload="window.print();">
  <!--<body>-->
            <page size="A5" id="printableArea" layout="landscape">
      <div class="content-wrapper" >
          <img src="<?=$bg?>" >
          <div class="text-wrapper">
                <img src="<?=$photo?>" style="border: 1px solid;height: 10rem;width: 7rem;top: -57.3rem;left: 39.8rem;border-radius: 10px;">
               <p style="top: -51.7rem;left: 10rem;font-size: x-large;"><b><?=$roll_no?></b></p>
                <p style="top: -49.6rem;left: 28rem;font-size: x-large;"><b><?=$course_short_name?></b></p>
                <p style="top: -54rem;left: 12rem;font-size: x-large;"><b><?=$name?></b></p>
                <p style="top: -49.6rem;left: 11rem;font-size: x-large;"><b><?=$dob?></b></p>
                <p style="top: -40rem;left: 13rem;font-size: x-large;"><b><?=$exam_center?></b></p>
                <p style="font-size: x-large;top: -44rem;left: 8.2rem;"><b><?=$exam_date?></b></p>
                <p style="top: -42rem;left: 13rem;font-size: x-large;"><b><?=$exam_time?>AM</b></p>
                <p style="top: -16.5rem;left: -7rem;color: black;width: 35rem;text-align: center;"><b><?=$city?></b></p>
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
