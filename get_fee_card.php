<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Fee-Card | [<?=$s['enrollment_no']?>]</title>
     <style>
        body {
  /*background: rgb(204,204,204); */
}
page {
  background: white;
  display: block;
  margin: 0 auto;
  margin-bottom: 0.5px;
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
               margin-top: -59.8%;
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
        .content-wrapper {
    margin-top: 48px;
    width: 851px;
}
img{
    margin:0px;
    padding:0px;
}
    </style>
  </head>
        <?
          $logo = $con->query("SELECT * FROM logo_setting where id = 1")->fetch_assoc();
      ?>
  <body onload="window.print();">
  <!--<body>-->
  
            <page size="A4" id="printableArea" >
                
                <div class="content-wrapper" style="display: flex; justify-content: space-between;">
    <!-- Left content -->
    <div style="flex: 1; position: relative;margin-right:5px">
        <img src="<?=$bg?> ">
        <div class="text-wrapper">
            <div style="color:red;width: 94%;height: 37px;margin-left: 30px;top: -15px;border-radius: 18px;">
                <p style="position: absolute;top: -38rem;left: 1rem;width: 90%;align-item:center"><b><?=$center_name?></b></p>
            </div>
            
            <img src="<?=$photo?>" style="height: 7.2rem;width: 6.1rem;top: -35.3rem;left: 41.9rem;">
            <p style="top: -36rem;left: 16.2rem;"><?=$name?></p>
            <p style="top: -29.9rem;left: 16.2rem;"><?=$dob?></p>
            <p style="top: -34rem;left: 16.2rem;"><?=$father?></p>
            <p style="top: -32rem;left: 16.2rem;"><?=$enroll_no?></p>
            <p style="top: -27.9rem;left: 16.2rem;"><?=$course_name?></p>
            <p style="top: -25.9rem;left: 16.2rem;"><?=$session_st?>-<?=$session_end?></p>
            <p style="top: -23.9rem;left: 16.2rem;"><?=$center_code?></p>
            <p style="top: -21.9rem;left: 16.2rem;"><?=$address?></p>
        </div>
    </div>
    <!-- Right content -->
   
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
