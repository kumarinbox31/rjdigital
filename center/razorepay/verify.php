<?php

require('config.php');

session_start();

require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$success = true;

$error = "Payment Failed";

if (empty($_POST['razorpay_payment_id']) === false)
{
    $api = new Api($keyId, $keySecret);

    try
    {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
    }
    catch(SignatureVerificationError $e)
    {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}

if ($success === true)
{
    $paymentId=$_SESSION['razorpay_order_id'];
    $orderId=$_POST['razorpay_payment_id'];
    $amount=$_SESSION['amount'];

    $sql="INSERT INTO `orders` (`id`,`paymentid`,`orderid`,`amount`) VALUES (NULL , '$paymentId','$orderId','$amount') ";
    $query  = $con->query("INSERT INTO `tbl_wallet`(`type`, `amount`, `user_id`, `user_type`,`message`) VALUES 
        		        ('cr','$amount','".(isset($_COOKIE['CENTER_ID'])?$_COOKIE['CENTER_ID']:$id)."','center','Added by self.')");
    
    
    mysqli_query($con,$sql);
    header("location:../../center/index.php");



    $html = "<p>Your payment was successful</p>
             <p>Payment ID: {$_POST['razorpay_payment_id']}</p>";
}
else
{
    $html = "<p>Your payment failed</p>
             <p>{$error}</p>";
}

echo $html;
