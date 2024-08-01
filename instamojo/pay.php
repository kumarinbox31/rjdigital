<?php
    error_reporting(E_ALL);
    ini_set('display_errors',1);
    
     $base_url = ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on' ? 'https' : 'http' ) . '://' .  $_SERVER['HTTP_HOST'];
    $url = $base_url . $_SERVER["REQUEST_URI"];
    
    require_once('vendor/autoload.php');
     require_once 'payment-config.php';
    $api = new Instamojo\Instamojo($API_KEY, $AUTH_TOKEN, $URL);

    try {
        $response = $api->paymentRequestCreate(array(
            "purpose" => $_GET['type'],
            "amount" => $_GET["amount"],
            "buyer_name" => $_GET["name"],
            // "send_email" => true,
            "email" => $_GET["email"],
            "phone" => $_GET['phone'],
            "redirect_url" => $redirect_url,
            "shipping_address" => $_GET['custom_id'],
            "shipping_city" => $url
            ));
            if(isset($_SESSION['center'])){
                $center_id = $_SESSION['center']['id'];
                $cookie_name = "CENTER_ID";
                $cookie_value = $center_id;
                setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); 
            }
            header('Location: ' . $response['longurl']);
            exit();
    }catch (Exception $e) {
        $error = $e->getMessage();
        $arr = ((array)json_decode($error));
        print_r($error);exit;
        echo '
        <div >
        <h1>Pease provide correct details to Pay</h1>
        <form method="GET" action="">';
        foreach($_GET as $key => $val){
            if(array_key_exists($key,$arr)){
                echo '
                <div class="form-group">
                    <label>'.ucwords(str_replace('_',' ',$key)).'</label>
                    <input type="text" class="form-control" name="'.$key.'" value="'.$val.'">
                </div>';
            }else{
                echo '<input type="hidden" name="'.$key.'" value="'.$val.'">';
            }
        }
        
        echo '
            <button type="submit" style="margin-top:10px;" >Update</button>
        </form>
        </div>';
        
    }

?>