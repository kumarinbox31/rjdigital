<?
require_once 'includes/header.php';
if($_POST['status']=='details')
{
    $con->query("UPDATE `login` SET `name` = '".$_POST['name']."', `username` = '".$_POST['username']."', `email` = '".$_POST['email']."', `mobile` = '".$_POST['mobile']."' WHERE `login`.`id` = '".$_SESSION['admin']['id']."'");
    echo '<script>alert("Details are update success.");location.href="change_password.php"</script>';
}
$get = $con->query("SELECT * FROM login where id = '".$_SESSION['admin']['id']."'")->fetch_assoc();

if($_POST['status']=='password')
{
    $old_pass = $_POST['old_pass'];
    $new_pass = $_POST['new_pass'];
    $con_pass = $_POST['con_pass'];
    if($new_pass==$con_pass)
    {
        $chk = $con->query("SELECT * FROM login where password = '".md5($old_pass)."'");
        if($chk->num_rows)
        {
            $con->query("UPDATE `login` SET `password` = '".md5($new_pass)."' WHERE `login`.`id` = '".$_SESSION['admin']['id']."'");
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
?>
<div class="box box-success">
    <div class="box-header"><h3>Admin Details</h3></div>
    <div class="box-body">
        <form action="" method="post">
            <div class="form-group col-md-6">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="<?=$get['name']?>">
            </div>
             <div class="form-group col-md-6">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?=$get['username']?>">
            </div>
             <div class="form-group col-md-6">
                <label>E-Mail</label>
                <input type="text" name="email" class="form-control" value="<?=$get['email']?>">
            </div>
             <div class="form-group col-md-6">
                <label>Mobile No.</label>
                <input type="text" name="mobile" class="form-control" value="<?=$get['mobile']?>">
            </div>
             <div class="form-group col-md-12">
               <button class="btn btn-success" type="submit" name="status" value="details"><i class="fa fa-save"></i> Update</button>
            </div>
        </form>
    </div>
</div>
<div class="box box-primary">
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
                 <button class="btn btn-primary" type="submit" name="status" value="password"><i class="fa fa-save"></i> Change Password</button>
             </div>
        </form>
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