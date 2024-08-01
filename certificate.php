<?php
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
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            width: 100%;
            height: auto;
            font-family: math;
            font-size: large;
            font-weight: 600;
        }
        page {
            background: white;
            display: block;
            margin: 0 auto;
            padding: 0;
            width: 21cm;
            height: 14.8cm;
        }
        @media print {
            body, page {
                margin: 0;
                padding: 0;
                box-shadow: none;
                width: 100%;
                height: 100%;
            }
            @page {
                margin: 0;
            }
        }
        .content-wrapper {
            text-align: center;
        }
        .content-wrapper img {
            width: 100%;
        }
        .text-wrapper {
            width: 96%;
            position: relative;
        }
        .text-wrapper h2 {
            text-align: center;
            color: #ffffff;
            font-size: 10vw;
        }
        h4 {
            text-align: left;
        }
        #myPhoto {
            width: 167px;
            height: 198px;
            margin-top: 5%;
            margin-right: 2.8%;
        }
        .content {
            margin-top: -33%;
            margin-left: 31%;
            text-align: left;
        }
        #sl {
            text-align: right;
            margin-right: 3%;
        }
        .box {
            margin-top: -1%;
        }
        tr td {
            text-align: center;
        }
        .text-wrapper > div, .text-wrapper > img, .text-wrapper > h1, .text-wrapper > h2, .text-wrapper > h3, .text-wrapper > h4, .text-wrapper > p {
            position: absolute;
        }
        p {
            font-size: 1em;
        }
    </style>
    
</head>
<body onload="window.print();">
<?php
$logo = $con->query("SELECT * FROM logo_setting where id = 1")->fetch_assoc();
$sub = $con->query("SELECT subject_name FROM subjects where course_id = '".$s['course_id']."'");
$subs = '';
while ($su = $sub->fetch_object()) {
    $subs .= "$su->subject_name,";
}
$subs = rtrim($subs, ',');
?>
print_r($certificate_no);exit;
<page size="A5" id="printableArea" layout="landscape">
    <div class="content-wrapper">
        <img src="<?=$bg?>">
        <div class="text-wrapper">
            <img src="<?=$photo?>" style="height: 7.1rem; width: 5.3rem; top: -48.2rem; left: 39rem; border: 1px solid black;">
            <p style="top: -42.5rem; left: 16rem;"><?=$name?></p>
            <p style="top: -48.9rem; left: 10.2rem;"><?=$certificate_no?></p>
            <p style="top: -35.7rem; left: 15rem; font-size: 15px;"><?=$center_name?></p>
            <p style="top: -40.4rem; left: 21rem;"><?=$father?></p>
            <p style="top: -18.5rem; left: 15.5rem; font-size: 1rem;"><?=$center_code?></p>
            <p style="top: -16.2rem; left: 15.3rem; font-size: 17px;"><?=date("d-m-Y", strtotime($issue_date))?></p>
            <p style="top: -22.3rem; left: 23.3rem; width: 6rem; font-size: 17px;"><?=$a['grade'];?></p>
            <p style="top: -38.4rem; left: 3.7rem; width: 8rem;"><?=$duration?></p>
            <p style="margin-top: -22.4rem; left: 9.7rem; width: 6.5rem; font-size: 17px;"><?=$enroll_no?></p>
            <p style="margin-top: -38.3rem; left: 17rem; font-size: medium;"><?=$course_name?></p>
            <p style="margin-top: -32.5rem; left: 3rem; font-size: 15px; width: 90%; text-align: center"><?=$subs?></p>
            <?php
            $data = "Enrollment No: " . $enroll_no . "\nName: " . $name . "\nFather's Name: " . $father . "\nMother's Name: " . $mother . "\nDate of Birth: " . $
;
            $data = BASE_URL . "view-certificate.php?certificate-no=$certificate_no";
            ob_start();
            QRcode::png($data, null, QR_ECLEVEL_L, 10, 1);
            $image_data = ob_get_contents();
            ob_end_clean();
            echo '<img src="data:image/png;base64,' . base64_encode($image_data) . '" alt="QR Code" style="height: 6rem; width: 6rem; top: -20.5rem; left: 3.2rem; border: 1px solid black;">';
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
