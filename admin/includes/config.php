<?php
include 'phpqrcode/qrlib.php';
date_default_timezone_set('Asia/Kolkata');
// if(session_status() == PHP_SESSION_NONE){
session_start();
// }
// if(defined('THEME_PATH'))
// session_start();
$config['environment'] = 'development';
    
switch($config['environment']){
    case 'production':
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    break;
    case 'development':
        // Add error reporting settings for development environment if needed
    break;
}

// define('APPPATH', $_SERVER['DOCUMENT_ROOT']);
// define('BASE_URL', 'https://test.aimitbgf.in/');
// define('THEME_PATH', BASE_URL . 'theme/');
define('ENROLLMENT_NO','RJ/S/'.date('Y').'00');

define('APPPATH', $_SERVER['DOCUMENT_ROOT']);
define('BASE_URL', 'https://rjdigitalcomputer.com/');
define('THEME_PATH', BASE_URL . 'theme/');

$con = mysqli_connect("localhost", "webfire", "k6vl4tD10hNxIqN", "rjdigitall_final");


require APPPATH . '/config/config.php';

function wallet($user_id, $type = 'ttl', $user_type = 'center'){
    global $con;
    $cr = $con->query("SELECT SUM(amount) as cr FROM `tbl_wallet` WHERE user_id = '$user_id' and user_type = '$user_type' and type = 'cr'")->fetch_assoc()['cr'];
    $dr = $con->query("SELECT SUM(amount) as dr FROM `tbl_wallet` WHERE user_id = '$user_id' and user_type = '$user_type' and type = 'dr'")->fetch_assoc()['dr'];

    $cr = is_null($cr) ? 0 : $cr;
    $dr = is_null($dr) ? 0 : $dr;

    switch($type){
        case 'ttl':
            return ($cr - $dr);
        break;
        case 'cr':
            return $cr;
        break;
        case 'dr':
            return $dr;
        break;
    }
}
function student_last_id(){
    global $con;
    $data = $con->query("SELECT id FROM students ORDER BY id DESC LIMIT 1");
    return ENROLLMENT_NO.( $data->num_rows ? ($data->fetch_assoc()['id'] + 1) : 1);
    
}
function paymentConfig($key, $center_id = ''){
    global $con;
    $res = 0;

    // individual payment;
    $center_id = $center_id == '' ? $_SESSION['center']['id'] : $center_id;
    $center = $con->query("SELECT * FROM centers WHERE id = '$center_id'");
    if ($center->num_rows) {
        $center = $center->fetch_assoc();
        $res = isset($center[$key]) ? $center[$key] : 0;
        echo "Center Configuration Value: $res (Key: $key, Center ID: $center_id)<br>";
    }

    if (!$res) {
        // default payment 
        $get = $con->query("SELECT * FROM payment_system where id = 1");
        if ($get->num_rows) {
            $row = $get->fetch_assoc();
            $res = isset($row[$key]) ? $row[$key] : 0;
            echo "Default Configuration Value: $res (Key: $key)<br>";
        }
    }
    // end default payment

    return $res;
}


?>
