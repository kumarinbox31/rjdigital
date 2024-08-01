<?
require_once 'includes/config.php';
echo '<h1>Please Wait...</h1>';
$con->query("DELETE FROM `check_session` WHERE `check_session`.`user_id` = '".$_SESSION['admin']['id']."' AND `check_session`.`session_id` = '".$_SESSION['admin']['session_id']."'");
unset($_SESSION['admin']);
echo '<script>location.href="login.php"</script>';
?>