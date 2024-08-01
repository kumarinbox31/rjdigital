<?
require_once 'includes/header.php';
// print_r($_SESSION['center']['id']);
$get = $con->query("SELECT * FROM centers where id = '".$_SESSION['center']['id']."'")->fetch_assoc();
$s = $con->query("SELECT * FROM states where id = '".$get['state_id']."'")->fetch_assoc();
$c = $con->query("SELECT * FROM city where id = '".$get['city_id']."'")->fetch_assoc();
$t = $con->query("SELECT * FROM franchisee_transections where id = '".$get['transection_id']."'")->fetch_assoc();

$result = $con->query("SELECT count(*) as total_students FROM students WHERE center_id = '".$_SESSION['center']['id']."'");
$row = $result->fetch_assoc();
$totalStudents = $row['total_students'];

if($_POST['status'] == 'addFund'){
    
    $data =[
        'type' => 'Add Fund (Center)',
        'name' => $get['institute_name'],
        'phone' => $get['contact_number'],
        'email' =>$get['email_id'],
        'custom_id' => $get['id'],
        'amount' => $_POST['amount'],
    ];
    $link = BASE_URL.'instamojo/pay.php?'.http_build_query($data);
    echo "<script>window.location.href='$link'</script>";
}
?>

<style>
    .notification-container {
    width: 100%;
    overflow: hidden;
    /*border: 1px solid black;*/
    height: 45px;
    font-size: 2em;
    background-color: #fffcfa;
    color: #8f2c2c;
    box-shadow:5px solid black;
    margin-bottom:30px;
}
a:hover {
  color: red;
}

.notification-container : hover{
    color:red;
}

.notification {
    display: inline-block;
    white-space: nowrap;
    margin-right: 20px; /* Adjust the spacing between notifications */
    animation: scrollLeft 30s linear infinite;
    width:100%;
    height:auto;/* Adjust the animation duration as needed */
}
 
@keyframes scrollLeft {
    0% {
        transform: translateX(100%); /* Start offscreen to the right */
    }
    100% {
        transform: translateX(-100%); /* Scroll to the left */
    }
}

</style>



<?php
include 'includes/footer.php';
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        let isHovered = false;
        const notificationContainer = $(".notification-container");
        const notifications = $(".notification");

        notificationContainer.mouseenter(function() {
            isHovered = true;
            pauseAnimation();
        });

        notificationContainer.mouseleave(function() {
            isHovered = false;
            resumeAnimation();
        });

        function pauseAnimation() {
            if (!isHovered) return;
            notifications.each(function() {
                $(this).css("animation-play-state", "paused");
            });
        }

        function resumeAnimation() {
            if (isHovered) return;
            notifications.each(function() {
                $(this).css("animation-play-state", "running");
            });
        }
    });
</script>
