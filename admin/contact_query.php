<?
require_once 'includes/header.php';
if($_GET['action']=='del')
{
    $con->query("DELETE FROM contact_query where id = '".$_GET['id']."'");
    echo '<script>alert("Row Deleted Success");location.href="contact_query.php"</script>';
}
?>

        <div class="box box-success">
            <div class="box-header"><h3>Contact Queries</h3></div>
            <div class="box-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Name</th>
                            <th>E-Mail</th>
                            <th>Mobile No.</th>
                            <th>Message</th>
                            <th>Delete</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?
                            $i=1;
                            $get = $con->query("SELECT * FROM contact_query");
                            while($g = $get->fetch_assoc())
                            {
                                echo '<tr>
                                        <td>'.date('d-M-y',strtotime($g['timestamp'])).'</td>
                                        <td>'.ucwords($g['name']).'</td>
                                        <td>'.$g['email'].'</td>
                                        <td>'.$g['mobile'].'</td>
                                        <td>'.$g['message'].'</td>
                                        <td><a class="btn btn-danger" href="?id='.$g['id'].'&action=del"><i class="fa fa-trash"></i></a></td>
                                        
                                </tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
<?
include 'includes/footer.php';
?>