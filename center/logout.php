<?
require_once 'includes/config.php';
echo '<h1>Please Wait...</h1>';
$con->query("DELETE FROM `check_session` WHERE `check_session`.`user_id` = '".$_SESSION['center']['id']."' AND `check_session`.`session_id` = '".$_SESSION['center']['session_id']."'");
unset($_SESSION['center']);
echo  '<script>location.href="../center_login.php"</script>';
?>