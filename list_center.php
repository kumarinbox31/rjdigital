<?
require_once 'includes/header.php';
?>
<br>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            
        <div class="card ">
            <h1 class="text_heading text-center">SEARCH  <span class="highlight_color">CENTER</span></h1>
            <div class="card-body">
                <form method="get" class="form-inline">
                    <div class="form-group col-md-5" >
                        <label>Select State</label>
                        <select class="form-control" name="state_id" required>
                            <option value="">--Select--</option>
                            <?
                                $state = $con->query("SELECT * FROM states");
                                while($s = $state->fetch_assoc())
                                {
                                    echo '<option value="'.$s['id'].'">'.ucwords($s['state_name']).'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    
                    <div class="form-group col-md-2">
                        <button class="btn btn-danger">Search</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
        
    </div>
    <?
        if(isset($_GET['state_id'])){
    ?>
    <div class="container-fluid" style="margin-top:30px">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Institute ID</th>
                    <th>Institute Name</th>
                    <th>Institute Address</th>
                    <th>State</th>
                    <th>Distric</th>
                    <th>Institute Owner Name</th>
                </tr>
            </thead>
            <tbody>
                <?  
                    $get = $con->query("SELECT * FROM centers where status = 1 AND state_id = '".$_GET['state_id']."' order by id desc");
                    
                    while($g = $get->fetch_assoc())
                    {
                        $s = $con->query("SELECT * FROM states where id = '".$g['state_id']."'")->fetch_assoc();
                        $c = $con->query("SELECT * FROM city where id = '".$g['city_id']."'")->fetch_assoc();
                        echo '
                                <tr>
                                    <td><a href="uploads/centers/'.$g['image'].'" target="_blank"><img src="uploads/centers/'.$g['image'].'" style="width:100px;height:100px;"></a></td>
                                    <td>'.$g['center_number'].'</td>
                                    <td>'.$g['institute_name'].'</td>
                                    <td>'.$g['center_full_address'].'</td>
                                    <td>'.$s['state_name'].'</td>
                                    <td>'.$c['city_name'].'</td>
                                    <td>'.$g['name'].'</td>
                                </tr>
                        ';
                    }
                ?>
            </tbody>
        </table>
    </div>
    <?
        }
    ?>
</div>
<?
include 'includes/footer.php';
?>