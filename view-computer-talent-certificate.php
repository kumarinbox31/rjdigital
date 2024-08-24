<?php
require_once 'admin/includes/config.php';
require_once 'admin/includes/models/computer_talent_certificate.php';
$talent = new ComputerTalentCertificate($con);
$id = intval($_GET['id']);
$talent->id = $id;
if ($talent->getById() == null) {
    echo '<script>alert("Certificate not found.");window.location.href="admin/create_talent_certificate.php";</script>';
}
if($talent->status == 0){
    echo '<script>alert("Certificate not Approved yet.");window.location.href="admin/create_talent_certificate.php";</script>';
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Computer Talent Certificate | <?= $id ?></title>
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

            body,
            page {
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

        .text-wrapper>div,
        .text-wrapper>img,
        .text-wrapper>h1,
        .text-wrapper>h2,
        .text-wrapper>h3,
        .text-wrapper>h4,
        .text-wrapper>p {
            position: absolute;
        }

        p {
            font-size: 1em;
        }
        
    </style>
    <style>
        *{
            font-family: serif;
        }
        #name {
            top: -42.5rem;
            width: 100%;
        }

        #class {
            top: -38.3rem;
            left: 18rem;
            width: 6rem;
            text-align: center;
        }

        #session {
            top: -38.3rem;
            left: 31rem;
            width: 6rem;
            text-align: center;
        }

        #college_name {
            top: -35rem;
            left: 13rem;
            width: 31rem;
            text-align: center;
        }
    </style>
</head>

<body onload="window.print();">
    <page size="A5" id="printableArea" layout="landscape">
        <div class="content-wrapper">
            <img src="format/computer_talent_certificate.jpg">
            <div class="text-wrapper">
                <h3 id="name"><?php echo $talent->name; ?></h3>
                <h4 id="class"><?php echo $talent->class; ?></h4>
                <h4 id="session"><?php echo $talent->session; ?></h4>
                <h4 id="college_name"><?php echo $talent->college_name; ?></h4>
                <?php
                // $data = "Enrollment No: " . $enroll_no . "\nName: " . $name . "\nFather's Name: " . $father . "\nMother's Name: " . $mother . "\nDate of Birth: " ;
                // $data = BASE_URL . "view-certificate.php?certificate-no=$certificate_no";
                // ob_start();
                // QRcode::png($data, null, QR_ECLEVEL_L, 10, 1);
                // $image_data = ob_get_contents();
                // ob_end_clean();
                // echo '<img src="data:image/png;base64,' . base64_encode($image_data) . '" alt="QR Code" style="height: 6rem; width: 6rem; top: -20.5rem; left: 3.2rem; border: 1px solid black;">';
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>

</html>