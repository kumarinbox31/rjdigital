<?
require_once '../../admin/includes/config.php';
print_r($_POST);
if($_POST['status']=='failure')
{
    $full_txt = serialize($_POST);
    $con->query("INSERT INTO `students_transections` (`id`, `timestamp`, `mihpayid`, `status`, `unmappedstatus`, `txnid`, `amount`, `addedon`, `firstname`, `email`, `phone`, `hash`, `PG_TYPE`, `bank_ref_num`, `bankcode`, `error_Message`, `payuMoneyId`, `full_txn`) VALUES (NULL, CURRENT_TIMESTAMP, '".$_POST['mihpayid']."', '".$_POST['status']."', '".$_POST['unmappedstatus']."', '".$_POST['txnid']."', '".$_POST['amount']."', '".$_POST['addedon']."', '".$_POST['firstname']."', '".$_POST['email']."', '".$_POST['phone']."', '".$_POST['hash']."', '".$_POST['PG_TYPE']."', '".$_POST['bank_ref_num']."', '".$_POST['bankcode']."', '".$_POST['error_Message']."', '".$_POST['payuMoneyId']."', '".$full_txt."')");
    $id = $con->insert_id;
    $con->query("UPDATE `students` SET `transection_id` = '".$id."', `status` = '0' WHERE `students`.`id` = '".$_POST['udf2']."'");
    echo '<script>alert("Registration success. login first");location.href="../student_form.php"</script>';
}
else
{
    $full_txt = serialize($_POST);
    $con->query("INSERT INTO `students_transections` (`id`, `timestamp`, `mihpayid`, `status`, `unmappedstatus`, `txnid`, `amount`, `addedon`, `firstname`, `email`, `phone`, `hash`, `PG_TYPE`, `bank_ref_num`, `bankcode`, `error_Message`, `payuMoneyId`, `full_txn`) VALUES (NULL, CURRENT_TIMESTAMP, '".$_POST['mihpayid']."', '".$_POST['status']."', '".$_POST['unmappedstatus']."', '".$_POST['txnid']."', '".$_POST['amount']."', '".$_POST['addedon']."', '".$_POST['firstname']."', '".$_POST['email']."', '".$_POST['phone']."', '".$_POST['hash']."', '".$_POST['PG_TYPE']."', '".$_POST['bank_ref_num']."', '".$_POST['bankcode']."', '".$_POST['error_Message']."', '".$_POST['payuMoneyId']."', '".$full_txt."')");
    $id = $con->insert_id;
    $con->query("UPDATE `students` SET `transection_id` = '".$id."', `status` = '1' WHERE `students`.`id` = '".$_POST['udf2']."'");
    echo '<script>alert("Registration success. login first");location.href="../student_form.php"</script>';
}
?>