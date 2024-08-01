<?php
    include 'includes/header.php';
?>
<section class="courses-listing">
  <h1 class="text_heading text-center">Institute  <span class="highlight_color">Course</span></h1>
      <div class="container pt_20">
        <div class="courses-table">
          <div class="courses-table-header bg-primary d-flex justify-content-between align-items-center flex-column flex-md-row">
            <div class="left">
              <ul class="list-inline mb-0">
                <li class="list-inline-item">Institute Courses</li>
              </ul>
            </div>
               <div class="right">
                <div class="btn-group bootstrap-select">
                   
                        
                <form method="post" action="">
    <div class="form-group" style="border:1px solid white">
        <select class="form-control" name="category" required="" id="category" style="border:1px solid white">
            <option>Select Course Categary</option>
            <?php
                $get = $con->query("SELECT * FROM site_courses ");
                while ($row = $get->fetch_assoc()) {
                    echo '<option value="'.$row['id'].'">'.$row['title'].'</option>';
                }
            ?>
        </select>
    </div>
    <!--<input type="submit" value="Filter Courses">-->
</form>

                      
                </div>
            </div>
          </div>
          
          
         
          
          
          <div class="courses-table-body">
            <table class="table table-hover table-responsive-xl"> 
              <thead >
                <tr>
                  <th>SL. No</th>
                  <th>Course Code</th>
                  <th>Course Name</th>
                  <th>Short Name</th>
                  <th>Eligibility</th>
                  <th>Duration</th>
                </tr>
              </thead>
              <tbody>
                 <?php
                    $get = $con->query("SELECT * FROM courses");
                    $i = 1;
                    while ($g = $get->fetch_assoc()) {
                        $course = $con->query("SELECT * FROM site_courses WHERE id = '" . $g['categary'] . "'")->fetch_assoc();
                        echo '
                            <tr data-category="' . $course['id'] . '">
                                <td>'.$i++.'</td>
                                <td>' . $g['course_code'] . '</td>
                                <td>' . ucwords($g['course_name']) . '</td>
                                <td>' . $g['short_name'] . '</td>
                                <td>'.$course['eligibility'].'</td>
                                 <td>' . $g['duration'] . ' </td>
                            </tr>
                        ';
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
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        $('#category').change(function () {
            var selectedCategory = $(this).val();

            $('.courses-table-body tr').hide();
            $('.courses-table-body tr[data-category="' + selectedCategory + '"]').show();
        });
    });
</script>
