<?
require_once 'includes/header.php';
$get = $con->query("SELECT * FROM franchisee_transections where id = '".$_GET['id']."'")->fetch_assoc();
?>
<div class="box box-success">
	<div class="box-header"><h3>Center Transection</h3></div>
	<div class="box-body">
		<table class="table table-bordered">
			<tbody>
			    <tr><th>mihpayid</th> <td><?=$get['mihpayid']?></td></tr>
			    <tr><th>status</th> <td><?=$get['status']?></td></tr>
			    <tr><th>unmappedstatus</th> <td><?=$get['unmappedstatus']?></td></tr>
			    <tr><th>txnid</th> <td><?=$get['txnid']?></td></tr>
			    <tr><th>amount</th> <td><?=$get['amount']?></td></tr>
			    <tr><th>addedon</th> <td><?=$get['addedon']?></td></tr>
			    <tr><th>firstname</th> <td><?=$get['firstname']?></td></tr>
			    <tr><th>email</th> <td><?=$get['email']?></td></tr>
			    <tr><th>phone</th> <td><?=$get['phone']?></td></tr>
			    <tr><th>hash	</th> <td><?=$get['hash']?></td></tr>
			    <tr><th>PG_TYPE</th> <td><?=$get['PG_TYPE']?></td></tr>
			    <tr><th>bank_ref_num</th> <td><?=$get['bank_ref_num']?></td></tr>
			    <tr><th>bankcode</th> <td><?=$get['bankcode']?></td></tr>
			    
			     <tr><th>error_Message</th> <td><?=$get['error_Message']?></td></tr>
			      <tr><th>payuMoneyId</th> <td><?=$get['payuMoneyId']?></td></tr>
			       
			</tbody>
		</table>
	</div>
</div>
<?
include 'includes/footer.php';
?>