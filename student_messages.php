<?
require_once 'includes/header.php';
if(isset($_SESSION['student']))
{
  $get = $con->query("SELECT * FROM check_session where user_id = '".$_SESSION['student']['id']."' AND session_id = '".$_SESSION['student']['session_id']."'");
  if(!($get->num_rows))
    echo '<script>location.href="student_login.php"</script>';
}
else
  echo '<script>location.href="student_login.php"</script>';
$get = $con->query("SELECT * FROM students where id = '".$_SESSION['student']['id']."'")->fetch_assoc();
if($_GET['action']=='del')
{
    $con->query("DELETE FROM student_messages where id = '".$_GET['message_id']."'");
   echo '<script>alert("Message deleted.");location.href="notification.php"</script>';
}
?>
<div class="ContentHolder">
    <div class="container">
        <div class="box box-warning">
            <div class="box-header"><h3>My Notifications</h3></div>
            <div class="box-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Message</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?
                            $mess = $con->query("SELECT * FROM student_messages where student_id = '".$_SESSION['student']['id']."' order by id desc");
                            while($m = $mess->fetch_assoc())
                            {
                                echo '<tr>
                                        <td>'.date('d-M-y',strtotime($m['timestamp'])).'</td>
                                        <td>'.$m['message'].'</td>
                                        <td><a href="?message_id='.$m['id'].'&action=del" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>
                                </tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
           
        </div>
    </div>
</div>

<?
include 'includes/footer.php';
?>