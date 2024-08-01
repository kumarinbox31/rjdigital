<?
require_once 'includes/header.php';
if($_POST['status']=='password')
{
    $old_pass = $_POST['old_pass'];
    $new_pass = $_POST['new_pass'];
    $con_pass = $_POST['con_pass'];
    if($new_pass==$con_pass)
    {
        $chk = $con->query("SELECT * FROM centers where password = '".$old_pass."'");
        if($chk->num_rows)
        {
            $con->query("UPDATE `centers` SET `password` = '".$new_pass."' WHERE `centers`.`id` = '".$_SESSION['center']['id']."'");
            echo '<script>alert("Your Password is Changed.");location.href="change_password.php"</script>';
        }
        else
        {
            echo '<script>alert("Current Password not matched!!");location.href="change_password.php"</script>';
        }
    }
    else
    {
        echo '<script>alert("Confirm Password not matched!!");location.href="change_password.php"</script>';
    }
}
if(isset($_POST['action']) && $_POST['action'] == 'upload-sign'){
    $img = photo_upload('image','centers');
    if($img['status']){
    	$img = $img['status'] ? $img['file_name'] : '';
    	$con->query("UPDATE `centers` SET `sign` = '".$img."' WHERE `centers`.`id` = '".$_SESSION['center']['id']."'");
        echo '<script>alert("Uploading successfully.");location.href="change_password.php"</script>';
    }else{
        echo '<script>alert("File uploading error.");location.href="change_password.php"</script>';
    }
}
$get = $con->query("SELECT * FROM centers where id = '".$_SESSION['center']['id']."'")->fetch_assoc();
?>
<div class="box box-danger">
    <div class="box-header"><h3>Change Password</h3></div>
    <div class="box-body">
        <form action="" method="post">
            <div class="form-group col-md-4">
                <label>Current Password</label>
                <input type="password" id="old_pass" name="old_pass" class="form-control" placeholder="Enter Current Passoword" required> 
            </div>
            <div class="form-group col-md-4">
                <label>New Password</label>
                <input type="password" id="new_pass" name="new_pass" class="form-control" placeholder="Enter New Passoword" required> 
            </div>
            <div class="form-group col-md-4">
                <label>Confirm Password</label>
                <input type="password" id="con_pass" name="con_pass" onkeyup="check_pass(this.value)" class="form-control" placeholder="Enter Confirm Passoword" required> 
            </div>
             <div class="form-group col-md-12">
                 <button class="btn btn-danger" type="submit" name="status" value="password"><i class="fa fa-save"></i> Change Password</button>
             </div>
        </form>
    </div>
</div>
<div class="col-md-4">
<div class="box box-info ">
    <div class="box-header">Center Director Sign</div>
    <div class="box-body">
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label>Sign</label>
                <input type="file" name="image" class="form-control" required>
                <img src="../uploads/centers/<?php echo $get['sign']; ?>">
            </div>
            <div class="form-group">
                <button type="submit" name="action" value="upload-sign" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </form>
    </div>
</div>
</div>
<?
include 'includes/footer.php';
?>
<script>
    function check_pass(con_pass)
    {
        var new_pass = $('#new_pass').val();
        if(new_pass==con_pass)
        {
            document.getElementById("new_pass").style.border = "1px solid green";
            document.getElementById("con_pass").style.border = "1px solid green";
        }
        else
        {
            document.getElementById("new_pass").style.border = "1px solid red";
            document.getElementById("con_pass").style.border = "1px solid red";
        }
    }
</script>