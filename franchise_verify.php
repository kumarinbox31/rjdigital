<?
include 'includes/header.php';
if(isset($_POST['status'])){
     $get = $con->query("SELECT * FROM centers where center_number = '".$_POST['center_number']."' AND status = 1");
    if($get->num_rows)
    {
        $g = $get->fetch_assoc();
        ?>
        <div class="box box-default">
               <h3 class="text_heading text-center">FRANCHISE  <span class="highlight_color">VERIFICATION DETAILS</span></h3>
               <div class="box-body" id="printableArea">
                    <table class="table table-bordered">
                        <tbody>
                            <tr><th colspan="2">Franchise Verification</th></tr>
                             <tr><th>Institute Id</th><td><?=$g['center_number'];?></td></tr>
                             <tr><th>Name</th><td><?=$g['name'];?></td></tr>
                             <tr><th>Institute Name</th><td><?=$g['institute_name'];?></td></tr>
                             <!--<tr><th>DOB</th><td><?=$g['dob'];?></td></tr>-->
                             <!--<tr><th>Pan No</th><td><?=$g['pan_number'];?></td></tr>-->
                             <!--<tr><th>Aadhar No</th><td><?=$g['aadhar_number'];?></td></tr>-->
                             <tr><th>Address</th><td><?=$g['center_full_address'];?></td></tr>
                             <!--<tr><th>Name</th><td><?=$g['name'];?></td></tr>-->
                             <!--<tr><th>Name</th><td><?=$g['name'];?></td></tr>-->
                             <!--<tr><th>Name</th><td><?=$g['name'];?></td></tr>-->
                        </tbody>
                    </table>
               </div>
               <div class="box-footer">
                   	<button class="btn btn-default" onclick="printDiv('printableArea')"><i class="fa fa-print"></i> Print</button>
               </div>
           </div>
        
        <?
       
    }else{
        echo '<div class="alert alert-danger">Invalid  Institute Id!</div>';
    }
}
?>
<div class="container" >
    <div class="row">
        <div class="col-md-12">
           
            <div class="box box-danger col-md-6 col-md-offset-3">
                <h3 class="text_heading text-center">FRANCHISE <span class="highlight_color">VERIFICATION</span></h3>
                <div class="box-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label>Institute Id.</label>
                            <input type="text" class="form-control" name="center_number" placeholder="Enter Institute Id.">
                        </div>
                        <!--
                        <div class="form-group">
                            <label>Date of birth</label>
                            <input type="date" class="form-control" name="dob" placeholder="Enter Enrollment No.">
                        </div>
                        -->
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit" name="status" value="verify">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?
include 'includes/footer.php';
?>
<script type="text/javascript">
	function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>