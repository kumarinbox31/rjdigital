<?
require_once 'admin/includes/config.php';
echo '<h1>Please Wait...</h1>';
$con->query("DELETE FROM `check_session` WHERE `check_session`.`user_id` = '".$_SESSION['student']['id']."' AND `check_session`.`session_id` = '".$_SESSION['student']['session_id']."'");
unset($_SESSION['student']);
echo  '<script>location.href="../student_login.php"</script>';
?>