<?
require_once '../admin/includes/config.php';
$pay = $con->query("SELECT * FROM payment_system WHERE id = 1")->fetch_assoc();

// $API_KEY = "test_d883b3a8d2bc1adc7a535506713";
// $AUTH_TOKEN = "test_dc229039d2232a260a2df3f7502";
$API_KEY = $pay['secret_key'];
$AUTH_TOKEN = $pay['salt_key'];
$URL = "https://www.instamojo.com/api/1.1/";
$redirect_url = "https://aiocomputerzone.org/instamojo/payment-success.php";
?>