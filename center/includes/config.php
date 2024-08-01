<?
session_start();
require_once '../admin/includes/config.php';
$walletBalance = wallet($_SESSION['center']['id']);
define('WALLET_BALANCE',$walletBalance);
?>
