<?
require_once '../admin/includes/config.php';
if (isset($_POST['adds'])) {
	$amount=$_POST['amount'];
	$sql="INSERT INTO `amount` (`id`,`amount`) VALUES (NULL, '$amount') ";
	mysqli_query($con,$sql);
	header("location:index1.php");
	

}
?>