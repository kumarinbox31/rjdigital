<!DOCTYPE html>
<html>
<head>
<title>Instamojo Thank You</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>
<body class="">
	
	<br><br><br><br>
	<article class=" mb-3">  
	<div class="card-body text-center">
	<?php

		require_once('vendor/autoload.php');

        require_once 'payment-config.php';
        
		$api = new Instamojo\Instamojo($API_KEY, $AUTH_TOKEN,$URL);

		$payid = $_GET["payment_request_id"];

		try {
		$response = $api->paymentRequestStatus($payid);
		$id = isset($response['payments'][0]['shipping_address'])?$response['payments'][0]['shipping_address']:0;
		$status = $response['status'];
		$type = $response['purpose'];
		$name = $response['buyer_name'];
        $email = $response['buyer_email'];
        $amount = $response['amount'];
    		if($status == 'Completed'){
        		switch($type){
        		    case 'Franchise Registration':
        		        $con->query("UPDATE `centers` SET `transection_id`='$payid',`status`='1' WHERE id = '$id'");
        		    break;
        		    case 'Student Registration':
        		        $con->query("UPDATE `students` SET `transection_id`= '$payid' ,`status`= '1'WHERE id = '$id'");
        		    break;
        		    case 'Add Fund (Center)':
        		        $res = $con->query("INSERT INTO `tbl_wallet`(`type`, `amount`, `user_id`, `user_type`,`message`) VALUES 
        		        ('cr','$amount','".(isset($_COOKIE['CENTER_ID'])?$_COOKIE['CENTER_ID']:$id)."','center','Added by self.')");
        		        if(!$res){
        		            print_r($res->error);exit;
        		        }
        		    break;
        		    default:
        		    break;
        		}
        		echo '<h1 style="text-align:center;color:green;" >Payment Success</h1>';
        		$button = "<a class='btn btn-sm btn-info' href='/'>Back</a>";
        		
    		}else{
    		    echo '<h1 style="text-align:center;color:red;" >Payment Failed</h1>';
    		    $payment_url = $resonse['payments'][0]['shipping_city'];
        		$button = "<a class='btn btn-sm btn-info' href='$payment_url'>Pay Again</a>";
    		}
    		$chk = $con->query("SELECT * FROM txns WHERE payment_request_id = '$payid'");
    		if(!$chk->num_rows){
    		    $con->query("INSERT INTO `txns` (`type`, `name`, `email`, `custom_id`, `amount`, `payment_request_id`, `status`) VALUES 
    		    ('$type', '$name' , '$email', '$id', '$amount','$payid', '$status')");
    		}
    		echo "<h5>Payment ID: " . $response['payments'][0]['payment_id'] . "</h5>" ;
    		echo "<h5>Payment Name: " . $name . "</h5>" ;
    		echo "<h5>Payment Email: " . $email . "</h5>" ;
    		echo "<h5>Payment status: " . $status . "</h5>" ;
    		
            echo $button;
            
            if(isset($_COOKIE['CENTER_ID'])) {
                $center_id = $_COOKIE['CENTER_ID'];
                $login = $con->query("SELECT * FROM centers where id = '".$center_id."'");
                  if($login->num_rows)
                  {
                    $row = $login->fetch_assoc();
                    $rand = rand(111111,999999);
                    $_SESSION['center']['id'] = $row['id'];
                    $_SESSION['center']['session_id'] = $rand;
                    $_SESSION['center']['login'] = TRUE;
                    $sess = $con->query("INSERT INTO `check_session` (`id`, `timestamp`, `user_id`, `session_id`) VALUES (NULL, CURRENT_TIMESTAMP, ' ".$row['id']."','".$rand."')");
                    if($sess){
                    echo '<script>location.href="../center/"</script>';
                    }
                  }
            }
		}
		catch (Exception $e) {
		print('Error: ' . $e->getMessage());
		}
	?>
	<br>
	</div>
	<br><br><br>
	</article>

</body>
</html>
