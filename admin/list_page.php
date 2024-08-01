<?
require_once 'includes/header.php';
if($_GET['action'] == 'del')
{
   
    $con->query("DELETE FROM `his_page` WHERE `his_page`.`id` = '".$_GET['page_id']."'");
    echo '<script>alert("Slider Deleted.");location.href="list_page.php"</script>';
}
$page = $con->query("SELECT * FROM his_page");
?>

       

    <!-- Main content -->
    <section class="content">
<div class="container">
	<table class="table table-borderless table-data3">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Page Name</th>
                                                <th>Edit</th>
                                                <th>Remove</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <!--    <tr><td>1</td><td>Home</td><td><a class="btn btn-info" href="page_content.php?page_id=1"><i class="fa fa-edit"></i></a>-->
                                        <!--    </td>-->
                                        <!--        <td><button class="btn btn-danger" disabled="disabled"><i class="fa fa-trash"></i></button></td>-->
                                        <!--</tr>-->
                                            <?
                                                $i=1;
                                            	while($p = $page->fetch_assoc())
                                            	{
                                            		echo '<tr>
                                                            <td>'.$i++.'</td>
			                                                <td>'.ucwords($p['page_name']).'</td>
			                                                <td><a class="btn btn-info" href="edit_page.php?page_id='.$p['id'].'"><i class="fa fa-edit"></i></a></td>

			                                                <td><a class="btn btn-danger" href="?page_id='.$p['id'].'&action=del"><i class="fa fa-trash"></i></a></td>
			                                            </tr>
                                            ';
                                            	}
                                            ?>
                                        </tbody>
                                    </table>
</div>
<?
include 'includes/footer.php';
?>