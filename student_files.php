<?
require_once 'includes/header.php';
?>

<style>
        .home_banner.contactus {
        background: url(theme/img/contactus-slide.jpg) no-repeat right top;
        background-size: cover;
    }
    .home_banner.inner .banner-info {
    right: 15px;
    left: 15px;
}
.home_banner.inner::before {
    content: "";
    z-index: 1;
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    right: 0;
    background-color: rgba(60,50,30,0.75);
}
.home_banner.inner {
    position: relative;
}

</style>
        
<div class="ContentHolder">
    <div class="container-fluid">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
    						<th>Type</th>
    						<th>Description</th>
    						<th>File</th>
                </tr>
            </thead>
            <tbody>
                	<?
    					    
    						$get = $con->query("SELECT * FROM student_files");
    						$type='';
    						if(isset($_GET['_type'])){
    						    $type = $_GET['_type'];
    						    $get = $con->query("SELECT * FROM student_files where `type` = '$type' ");
    						}
    						if($get->num_rows > 0){
    						while($m = $get->fetch_assoc())
    						{
    							echo '
    									<tr>
    										<td>'.ucwords($m['title']).'</td>
    										<td>'.$m['type'].'</td>
    										<td>'.$m['description'].'</td>
    										<td><a download href="../uploads/downloads/'.$m['file'].'" target="_blank" class="btn btn-info btn-sm"><i class="fa fa-download"></i></a></td>
                                        </tr>
    							';
    						}
    						}else{
    						    echo '<tr><td colspan="4" class="text-center text-danger">'.ucwords($type).' Not Available</td></tr>';
    						}
    					?>
            </tbody>
        </table>
    </div>
</div>
<?
include 'includes/footer.php';
?>