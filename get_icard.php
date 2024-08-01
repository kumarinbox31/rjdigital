<?
require_once 'admin/includes/config.php';
if(isset($_SESSION['student']['id'])){
    $id = $_SESSION['student']['id'];
    $login = $con->query("SELECT * FROM students where id = '".$id."'");
if($login->num_rows)
{
        $row = $login->fetch_assoc();
        $photo = 'uploads/students/'.$row['photo'];
        $name = $row['name'];
        $father = $row['father'];
        $dob = $row['dob'];
        $address = $row['distric'].' ('.$row['state'].')';
        $mobile = $row['mobile'];
        $course_id = $row['course_id'];
        $enrollment_no = $row['enrollment_no'];
        $course_name=$validity='N/A';
        $c = $con->query("SELECT * FROM courses where id = '".$course_id."'");
        if($c->num_rows){
            $cor = $c->fetch_assoc();
            $course_name = $cor['course_name'];
        }
        $dur_start = date('M Y',strtotime($row['dur_start']));
		$dur_ends = date('M Y',strtotime($row['dur_ends']));
		$validity = $dur_start.' to '.$dur_ends;
		$institute = $con->query("SELECT * FROM centers where id = '".$row['center_id']."'")->fetch_assoc();
		$center_name = isset($institute['institute_name'])?$institute['institute_name']:'N/A';
		$center_full_address = isset($institute['center_full_address'])?$institute['center_full_address']:'N/A';
		$center_logo = $institue['image'];
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
    <title>ID-Card | [<?=$enrollment_no?>]</title>
     <style>
        body {
  background: rgb(204,204,204); 
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
        }
        .content-wrapper{
            /*width:80%;*/
            /*margin:4% 10% 5% 10%;*/
            text-align:center;
        }
        .content-wrapper img{
            width:100%;
        }
        .text-wrapper{
                width: 96%;
    position: relative;
    margin-top: -62%;
    /*text-align: center;*/
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
               width: 88px;
                margin-top: 3.4%;
                margin-left: -86%;
                height: 104px;
            }
        .content{
            margin-top: -4%;
            width: 41%;
            margin-left: 31%;
        }
        *{
            color:darkblue;
        }
    </style>
  </head>
  <?
          $logo = $con->query("SELECT * FROM logo_setting where id = 1")->fetch_assoc();
      ?>
  <body id="printableArea">
            <page size="A4" >
                <!--<div class="text-center "><a onclick="printDiv('printableArea')" class="btn btn-danger m-4"><i class="fa fa-print"></i></a></div>-->
      <div class="content-wrapper" >
          <img src="format/i_card.jpg" >
          <div class="text-wrapper">
              <div class="box" >
                  <img src="../uploads/centers/<?=$logo['logo']?>" style="width: 5.2rem;margin-left: -42.8rem;margin-top: 14.2rem;">
                <div class="img" style=" width: 100%;height: 307px;">
                    <img src="<?=$photo?>" id="myPhoto" >
                </div>
                <p style="margin-top: -24rem;
    font-weight: bold;
    background: #eac8c7;
    width: 19.4rem;
    margin-left: 4.7rem;
    text-align: left;"><?=$center_name?></p>
              <div class="content">
                  
                 <h5 style="margin-top: 7.5rem;margin-left: -19rem;font-size: 1rem;"><?=$enrollment_no?></h5>
                 <div style="margin-top: -4%;margin-left: -21rem;"><?=$name?></div>
                 <div style="margin-top: -1%;margin-left:-3rem;text-align:left" ><?=$father?></div>
                 <div style="    margin-top: -1%;margin-left: -20rem;" ><?=date('d M Y',strtotime($dob));?></div>
                 <div style="margin-left: -19.8rem;line-height: 1rem;"><?=$mobile?></div>
                  <p style="margin-top: -12.5rem;margin-left: 18rem;width: 234px;height: 5.2rem;"><?=$address?></p>
                  <p style="margin-left: 18rem;width: 234px;height: 5.2rem;"><?=$center_full_address?></p>
              </div>
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


<?
}else{
    echo 'Nothing Found';
}
}

?>