<?
require_once 'includes/header.php';
?>

<style>
    .notification-container {
    width: 100%;
    overflow: hidden;
    /*border: 1px solid black;*/
    height: 45px;
    font-size: 2em;
    background-color: #fffcfa;
    color: #8f2c2c;
    box-shadow:5px solid black;
    margin-bottom:30px;
}
a:hover {
  color: red;
}

.notification-container : hover{
    color:red;
}

.notification {
    display: inline-block;
    white-space: nowrap;
    margin-right: 20px; /* Adjust the spacing between notifications */
    animation: scrollLeft 30s linear infinite;
    width:100%;
    height:auto;/* Adjust the animation duration as needed */
}
 
@keyframes scrollLeft {
    0% {
        transform: translateX(100%); /* Start offscreen to the right */
    }
    100% {
        transform: translateX(-100%); /* Scroll to the left */
    }
}

</style>

<div class="row">
</div>
<?


$ab=0;    
$sql="SELECT * FROM `orders` ";
$row= mysqli_query($con,$sql);
while ($value=mysqli_fetch_assoc($row)) {
$amt=$value['amount'];
$amount1=$ab+=$amt;
// $amount=$_SESSION['amount'];
// $amounts=$amount-$amount1;
}
    ?>
    
    <div class="col-md-3">
        <div class="panel panel-danger">
            <div class="panel-heading"><h4>Total Amount</h4></div>
            <div class="panel-body">
                <h4  style ="color:red">Total :<? echo  $amount1; ?>
                </h4>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="panel panel-success">
            <div class="panel-heading"><h4>Add Fund</h4></div>
            <div class="panel-body">
        <form action="razorepay/pay.php" id="checkout-selection" method="POST">
        <input type="radio" name="checkout" value="automatic">Automatic Checkout Demo<br>
        <input type="radio" name="checkout" value="orders">Manual Checkout Demo<br>
        <label>Amount</label>
        <input type="text" name="amounts" class="form-control" placeholder="Enter Amount">
        
        <input type="submit" class="btn btn-sm btn-info mt-2" value="Submit">
    </form>
    
    
                <!--<form method="POST" action="query.php">-->
                <!--    <div class="form-group">-->
                <!--        <label>Amount</label>-->
                <!--        <input type="text" name="amount" class="form-control" placeholder="Enter Amount">-->
                <!--    </div>-->
                <!--    <button type="submit" class="btn btn-sm btn-info" name="adds">Add</button>-->
                <!--</form>-->
                
            </div>
        </div>
    </div>
   
    
</div>


    
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
        jQuery(document).ready(function($) 
        {
            var form = $('#checkout-selection');
            var radio = $('input[name="checkout"]');
            var choice = '';

            radio.change(function(e) 
            {
                choice = this.value;
                if (choice === 'orders') 
                {
                    form.attr('action', 'razorepay/pay.php?checkout=manual');
                } 
                else 
                {
                    form.attr('action', 'razorepay/pay.php?checkout=automatic');
                }
            });
        });
    </script>


<?
include 'includes/footer.php';
?>

