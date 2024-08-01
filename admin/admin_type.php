<? require 'includes/header.php'?>
<?
if($_SERVER['REQUEST_METHOD'] === 'POST')
{
        if($_POST['action'] == 'add'){
            $ins = $con->query("INSERT INTO `login_permission` (`type`,`permissions`) VALUES ('".$_POST['type']."','".json_encode($_POST['permissions'])."')");
        }else{
            $up = $con->query("UPDATE `login_permission` SET `type`= '".$_POST['type']."',`permissions`= '".json_encode($_POST['permissions'])."' WHERE id = '".$_POST['id']."'");
            if(!$up){
                print_r($con->error);exit;
            }
        }
        echo '<script>alert("Success");location.href="admin_type.php"</script>';
}
$type = $permissions = $input = '';
$action = 'add';
if(isset($_GET['action']) && $_GET['action'] == 'edit'){
    $id = $_GET['id'];
    $get = $con->query("SELECT * FROM login_permission WHERE id = '$id'");
    if($get->num_rows){
        $row = $get->fetch_assoc();
        extract($row);
        $action = 'update';
        $input = '<input type="hidden" name="id" value="'.$id.'">';
    }
}
?>
<div class="row">
    
<div class="col-md-6">
<div class="box box-success">
    <div class="box-header"><h4>Admin Type</h4></div>
    <div class="box-body">
        <form class="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="action" value="<?=$action?>">
            <?=$input?>
            <div class="form-group">
                <label>Type</label>
                <input type="text" class="form-control" name="type" placeholder="Enter Type" required value="<?=$type?>">
            </div>
            <div class="form-group">
                <label>Permissions</label>
                <div class="form-check">
                    <?
                        $arr = ['page'];
                        foreach($arr as $key){
                            $chkd = '';
                            if($permissions != ''){
                                $per = json_decode($permissions);
                                $chkd = in_array($key,$per)?'checked':'';
                            }
                    ?>
                    <input type="checkbox" name="permissions[]" value="<?=$key?>" id="<?=$key?>" <?=$chkd?>> <label for="<?=$key?>"><?=ucwords(str_replace('_',' ',$key));?></label>
                    <?
                        }
                    ?>
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-success" >Submit</button>
            </div>
        </form>
    </div>
</div>
</div>
<div class="col-md-6">
<div class="box box-warning">
    <div class="box-header"><h4>Admin Type (s)</h4></div>
    <div class="box-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Type</th>
                    <th>Permissions</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?
                    $get = $con->query("SELECT * FROM login_permission");
                    $i = 1;
                    while($row = $get->fetch_assoc()){
                        echo '<tr>
                            <td>'.$i++.'</td>
                            <td>'.$row['type'].'</td>
                            <td>'.$row['permissions'].'</td>
                            <td>
                                <a href="?action=edit&id='.$row['id'].'" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                <a href="?action=delete&id='.$row['id'].'" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                            </td>
                            </tr>';
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
</div>

</div>

<? require 'includes/footer.php'?>