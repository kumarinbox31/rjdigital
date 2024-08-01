<?php
    include 'includes/header.php';
?>
<section class="about-content-section">
	<div class="container-fluid">
        <div class="container">
         <h1 class="text_heading text-center">Down<span class="highlight_color">load</span></h1>
         <div class="table-responsive pt_50">          
              <table class="table table-hover table-bordered">
                <thead class="thead_info">
                  <tr>
                  	<th>Sr. No.</th>
                  	<th>Date</th>
                    <th>Title</th>
                    <th>Download Document</th>                    
                  </tr>
                </thead>
               
                <tbody>
                   <?
							
							$get = $con->query("SELECT * FROM `assignment`");
							$i = 1;
							if($get->num_rows){
							    
							    while($row = $get->fetch_assoc()){
							        echo '<tr>
							                <td>'.$i++.'</td>
							                <td>'.$row['date'].'</td>
							                <td>'.$row['description'].'</td>
							                <td>
                                                <a href="admin/download_assignment.php?file='.$row['file'].'" target="_blank" class="btn btn-primary"><i class="fa fa-download"></i>Download<a/>
                                            </td>
							              </tr>';
							    }
							}
						?>
                </tbody>

              </table>
             </div>
          </div>
        </div>
	</section>
<?php
    include 'includes/footer.php';
?>