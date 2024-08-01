<?
require_once 'includes/header.php';
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="ContentHolder" align="left">
   <div class="container" style="width:100%;">
       <h1>Downloads</h1>
       <table class="table table-striped">
           <thead>
               <tr>
                   <th>Title</th>
                   <th>File</th>
               </tr>
           </thead>
           <tbody>
               <?
                    $get = $con->query("SELECT * FROM site_manager");
                    while($g = $get->fetch_assoc())
                    {
                        echo '<tr>
                            <td><a href="uploads/site_manager/'.$g['file'].'" target="_blank"><i class="fa fa-download"></i> '.ucwords($g['title']).'</a></td>
                            <td><a class="btn btn-success" href="download_file.php?file='.$g['file'].'" target="_blank"><i class="fa fa-download"></i></a></td>
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