<?
require_once '../../admin/includes/config.php';
$settings = $con->query("SELECT * FROM payment_system where id = 1")->fetch_assoc();
$ammountTotal =  $settings['set_amount2']?$settings['set_amount2']:100;


	$chk = $con->query("SELECT * FROM students where mobile = '".$_POST['mobile']."' AND email = '".$_POST['email']."'");
	if(!($chk->num_rows))
	{
	    if(!isset($_POST['payment_provider'])){
    		$img = photo_upload('image','students');
    		if($img['status'])
    		{
    			$con->query("INSERT INTO `students` (`id`, `timestamp`, `enrollment_no`, `name`, `gender`, `father`, `mother`, `dob`, `mobile`, `email`, `state`, `distric`, `exam_pass`, `marks`, `board`, `year`, `username`, `password`, `course_id`, `center_id`, `photo`, `transection_id`, `status`) VALUES (NULL, CURRENT_TIMESTAMP, 'NYCLM00001".time()."', '".$_POST['name']."', '".$_POST['gender']."', '".$_POST['father']."', '".$_POST['mother']."', '".$_POST['dob']."', '".$_POST['mobile']."', '".$_POST['email']."', '".$_POST['state']."', '".$_POST['distric']."', '".$_POST['exam_pass']."', '".$_POST['marks']."', '".$_POST['board']."', '".$_POST['year']."', '".$_POST['username']."', '".$_POST['password']."', '".$_POST['course_id']."', '".$_SESSION['center']['id']."', '".$img['file_name']."', '', '')");
    // 			echo '<script>alert("Student Registration Success.");location.href="student_form.php"</script>';
                 $id = $con->insert_id;
    		}
    		else
    		{
    			echo '<script>alert("Error in photo uploading...");location.href="../student_form.php"</script>';
    		}
	    }
	}

$payment_id = rand(0000,100000);
$__call_back = 'http://nyclmindia.in';
			$MERCHANT_KEY = $settings['secret_key'];  // merchant key
             $SALT =  $settings['salt_key'];
             
            $__manageData = array();
            $__manageData['key']        = $MERCHANT_KEY;
            $__manageData['amount']     = $ammountTotal;
            $__manageData['firstname']	= $_POST['name'];
            $__manageData['email']   	= $_POST['email'];
            $__manageData['phone']   	= $_POST['mobile'];
            $__manageData['productinfo']= "reseller";
            $__manageData['surl']   	= $_call_back."http://nyclmindia.in/center/pay/payment_status.php";
            $__manageData['furl']   	= $_call_back."http://nyclmindia.in/center/pay/payment_status.php";
            $__manageData['udf1']   = $payment_id;
            $__manageData['udf2']    = $id;
            $__manageData['service_provider']   = "payu_paisa";            
            $PAYU_BASE_URL = "https://secure.payu.in";			
            
            $action = '';            
            $posted = array();
            $posted = $__manageData;
            $_POST['amount'] = $ammountTotal;
            //array_merge($__manageData,$posted);
            if(!empty($_POST)){
              foreach($_POST as $key => $value) {    
                $posted[$key] = $value;
               }
            }  
            $formError = 0;
            
            if(empty($posted['txnid'])) {
              $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
            } else {
              $txnid = $posted['txnid'];
            }
            $hash = '';
            $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
            if(empty($posted['hash']) && sizeof($posted) > 0) {
              if(
                      empty($posted['key'])
                      || empty($posted['txnid'])
                      || empty($posted['amount'])
                      || empty($posted['firstname'])
                      || empty($posted['email'])
                      || empty($posted['phone'])
                      || empty($posted['productinfo'])
                      || empty($posted['surl'])
                      || empty($posted['furl'])
            		  || empty($posted['service_provider'])
              ) {
                $formError = 1;
              } else {
            	$hashVarsSeq = explode('|', $hashSequence);
                $hash_string = '';	
            	foreach($hashVarsSeq as $hash_var) {
                  $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
                  $hash_string .= '|';
                }
            
                $hash_string .= $SALT;
            
                $hash = strtolower(hash('sha512', $hash_string));
            	
                $action = $PAYU_BASE_URL . '/_payment';
              }
            } elseif(!empty($posted['hash'])) {
              $hash = $posted['hash'];
              $action = $PAYU_BASE_URL . '/_payment';
            }
            ?>
            <html>
              <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
              <script>
                var hash = '<?php echo $hash ?>';
                function submitPayuForm() {
                  if(hash == '') {
                     // alert('0');
                   //return;
                  }
                  var payuForm = document.forms.payuForm;
                  payuForm.submit();
                }
              </script>
              </head>
              <body onload="submitPayuForm()">
                <h2 style="color:black"><i class="fa fa-spin fa-spinner"></i> Loading Payment Request</h2>
                <br/>
                <?php if($formError) { ?>
            	
                  <!--span style="color:red">Please fill all mandatory fields.</span-->
                  <br/>
                  <br/>
                <?php } ?>
                <form action="<?php echo $action; ?>" method="post" name="payuForm" style="display:none">

                  <input type="" name="payment_provider" value="payumoney">
                  <input type="" name="key" value="<?php echo $MERCHANT_KEY ?>" />
                  <input type="" name="hash" value="<?php echo $hash ?>"/>
                  <input type="" name="txnid" value="<?php echo $txnid ?>" />
                  <table>
                    <tr>
                      <td><b>Mandatory Parameters</b></td>
                    </tr>
                    <tr>
                      <td>Amount: </td>
                      <td><input name="amount" value="<?php echo (empty($posted['amount'])) ? '' : $posted['amount'] ?>" /></td>
                      <td>First Name: </td>
                      <td><input name="firstname" id="firstname" value="<?php echo (empty($posted['firstname'])) ? '' : $posted['firstname']; ?>" /></td>
                    </tr>
                    <tr>
                      <td>Email: </td>
                      <td><input name="email" id="email" value="<?php echo (empty($posted['email'])) ? '' : $posted['email']; ?>" /></td>
                      <td>Phone: </td>
                      <td><input name="phone" value="<?php echo (empty($posted['phone'])) ? '' : $posted['phone']; ?>" /></td>
                    </tr>
                    <tr>
                      <td>Product Info: </td>
                      <td colspan="3"><textarea name="productinfo"><?php echo (empty($posted['productinfo'])) ? '' : $posted['productinfo'] ?></textarea></td>
                    </tr>
                    <tr>
                      <td>Success URI: </td>
                      <td colspan="3"><input name="surl" value="<?php echo (empty($posted['surl'])) ? '' : $posted['surl'] ?>" size="64" /></td>
                    </tr>
                    <tr>
                      <td>Failure URI: </td>
                      <td colspan="3"><input name="furl" value="<?php echo (empty($posted['furl'])) ? '' : $posted['furl'] ?>" size="64" /></td>
                    </tr>
            
                    <tr>
                      <td colspan="3"><input type="hidden" name="service_provider" value="payu_paisa" size="64" /></td>
                    </tr>
            
                    <tr>
                      <td><b>Optional Parameters</b></td>
                    </tr>
                    <tr>
                      <td>Last Name: </td>
                      <td><input name="lastname" id="lastname" value="<?php echo (empty($posted['lastname'])) ? '' : $posted['lastname']; ?>" /></td>
                      <td>Cancel URI: </td>
                      <td><input name="curl" value="" /></td>
                    </tr>
                    <tr>
                      <td>Address1: </td>
                      <td><input name="address1" value="<?php echo (empty($posted['address1'])) ? '' : $posted['address1']; ?>" /></td>
                      <td>Address2: </td>
                      <td><input name="address2" value="<?php echo (empty($posted['address2'])) ? '' : $posted['address2']; ?>" /></td>
                    </tr>
                    <tr>
                      <td>City: </td>
                      <td><input name="city" value="<?php echo (empty($posted['city'])) ? '' : $posted['city']; ?>" /></td>
                      <td>State: </td>
                      <td><input name="state" value="<?php echo (empty($posted['state'])) ? '' : $posted['state']; ?>" /></td>
                    </tr>
                    <tr>
                      <td>Country: </td>
                      <td><input name="country" value="<?php echo (empty($posted['country'])) ? '' : $posted['country']; ?>" /></td>
                      <td>Zipcode: </td>
                      <td><input name="zipcode" value="<?php echo (empty($posted['zipcode'])) ? '' : $posted['zipcode']; ?>" /></td>
                    </tr>
                    <tr>
                      <td>UDF1: </td>
                      <td><input name="udf1" value="<?php echo (empty($posted['udf1'])) ? time() : $posted['udf1']; ?>" /></td>
                      <td>UDF2: </td>
                      <td><input name="udf2" value="<?php echo (empty($posted['udf2'])) ? '' : $posted['udf2']; ?>" /></td>
                    </tr>
                    <tr>
                      <td>UDF3: </td>
                      <td><input name="udf3" value="<?php echo (empty($posted['udf3'])) ? '' : $posted['udf3']; ?>" /></td>
                      <td>UDF4: </td>
                      <td><input name="udf4" value="<?php echo (empty($posted['udf4'])) ? '' : $posted['udf4']; ?>" /></td>
                    </tr>
                    <tr>
                      <td>UDF5: </td>
                      <td><input name="udf5" value="<?php echo (empty($posted['udf5'])) ? '' : $posted['udf5']; ?>" /></td>
                      <td>PG: </td>
                      <td><input name="pg" value="<?php echo (empty($posted['pg'])) ? '' : $posted['pg']; ?>" /></td>
                    </tr>
                    <tr>
                      <?php if(!$hash) { ?>
                        <td colspan="4"><input type="submit" value="Submit" /></td>
                      <?php } ?>
                    </tr>
                  </table>
                </form>
              </body>
            </html> 
  <?
function photo_upload($file,$path)
{
  $allowedExts = array("gif","jpeg","jpg","png");
  $temp = explode(".",strtolower($_FILES[$file]["name"]));
  $extension = end($temp);
  $return = array();
  if((($_FILES[$file]["type"] == "image/gif")
  ||($_FILES[$file]["type"] == "image/jpeg")
  ||($_FILES[$file]["type"] == "image/jpg")
  ||($_FILES[$file]["type"] == "image/pjpeg")
  ||($_FILES[$file]["type"] == "image/x-png")
  ||($_FILES[$file]["type"] == "image/png"))
  && in_array($extension, $allowedExts))
  {
    if($_FILES[$file]["error"]>0)
    {
      echo '<div class="alert alert-danger">Return Code: '.$_FILES[$file]["error"].'</div>';
    }
    else
    {
      $_FILESName = $temp[0].".".$temp[1];
      $temp[0] = rand(0,3000);

      if(file_exists("../../uploads/".$path.'/'.$_FILES[$file]["name"]))
      {
        $return['error'] = '<div class="alert alert-danger">'.$_FILES[$file]["name"].'Already Exists</div>';
      }
      else
      {
        $newfilename = time().end(explode('..',$_FILES[$file]["name"]));
        $aa = 'product__'.$newfilename;
        $a = '../../uploads/'.$path.'/'.$aa;
        $photo_address = '../uploads/';
        $z = move_uploaded_file($_FILES[$file]["tmp_name"], $a);
        $return['file_name'] = $aa;
        $return['status'] = 1;
      }
    }
  }
  else
  {
    $return['status'] = 0;
  }
  return $return;
}
?>