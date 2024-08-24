<nav class="main-menu">
                        <div class="navbar-header">
                           <!-- Toggle Button -->
                           <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                           </button>
                        </div>
                        <div class="navbar-collapse collapse clearfix">
                           <ul class="navigation clearfix">
          <?
          $pages = $con->query("SELECT * FROM his_page WHERE status = 1 ORDER BY id ASC");
                while($p = $pages->fetch_assoc())
                {
                    if($p['id'] == 13)
                        continue;
                  $sub = $con->query("SELECT * FROM set_menu,menu where set_menu.page_id = '".$p['id']."' AND menu.id = set_menu.menu_id");
                  if(!$sub->num_rows)
                            {
                        if($p['default_page'] == 1){
                            echo '<li ><a href="/">'.ucwords($p['page_name']).'</a></li>';
                        }else{
                             $link = is_null($p['link']) || $p['link'] == ''?BASE_URL.'?page_id='.$p['id']:$p['link'];
                             $redirect = $p['redirect']?'target="_blank"':'';
                            echo '<li ><a  '.$redirect.' href="'.$link.'">'.ucwords($p['page_name']).'</a></li>';
                        }
                  }
                }

                  $menu = $con->query("SELECT * FROM menu");
                  if($menu->num_rows){
                      while($m = $menu->fetch_assoc())
                      {
                         echo ' <li class="dropdown" >
                         <a href="javascript:return(0);">
                         '.ucwords($m['name']).' 
                         </a>
                          <ul >';
                          $l = $con->query("SELECT *,his_page.id as _id FROM his_page,set_menu WHERE set_menu.menu_id = '".$m['id']."' and his_page.id = set_menu.page_id ");
                            while($mm = $l->fetch_assoc())
                          { 
                              $link = is_null($mm['link']) || $p['link'] == ''?BASE_URL.'?page_id='.$mm['_id']:$mm['link'];
                            $redirect = $mm['redirect']?'target="_blank"':'';
                            echo '<li ><a  '.$redirect.' href="'.$link.'">'.ucwords($mm['page_name']).'</a></li>';
                          } 
                          echo '</ul>
                        </li>';
                      }
                  }
                  $menuArr = array(
                                    
                                    'Franchise' => array(
                                    				array('label'=>'Get Franchise','link'=>'https://rjdigitalcomputer.com/?page_id=38'),
                                                    array('label'=>'Apply For Franchise','link'=>'franchisee_form.php'),
                                                    // array('label'=>'Franchise Registration Details','link'=>'franchise_details.php'),
                                                    array('label'=>'Franchise Verfication','link'=>'franchise_verify.php'),
                                                    array('label'=>'Study Center List','link'=>'list_center.php'),
                                                    array('label'=>'Center Login','link'=>'center_login.php'),
                                                    
                                                    // array('lable'=>'Franchise Plan & Faculty','link'=>'https://kickacademy.co.in/?page_id=26'),
                                                    // array('label'=>'Franchise Members','link' => 'franchise_member.php'),
                                                ),
                                    'Student Zone' => array(
                                                    array('label'=>'Registration Process','link'=>'https://rjdigitalcomputer.com/?page_id=39'),
                                    				
                                                	array('label'=>'Online Admission','link'=>'student_form.php'),
                                                    array('label'=>'Enrollment Verification','link'=>'enrollment_verification.php'),
                                                    // array('label'=>'Result Verification','link'=>'get_result.php'),
                                                    
                                    				array('label'=>'Examination Process','link'=>'https://rjdigitalcomputer.com/?page_id=40'),
                                                    array('label'=>'Admit Card','link'=>'get_admit_card.php'),
                                                    array('label'=>'Certificate Verification','link'=>'get_certificate.php'),
                                    				),
                                );
                                if(isset($_SESSION['student'])){
                                    $newStudent = array(
                                                    array('label'=>'Pdf Download','link'=>'student_files.php?_type=pdf'),
                                                    array('label'=>'Video Download','link'=>'student_files.php?_type=video'),
                                                    array('label'=>'Student Notifications','link'=>'student_messages.php'),
                                                    // array('label'=>'Id Card','link'=>'get_icard.php'),
                                                    array('label'=>'Logout','link'=>'student_logout.php'),
                                                    array('label'=>'My Exam','link'=>'my-course.php'),
                                                );
                                }else{
                                    $newStudent = array(
                                                    array('label'=>'Student Login','link'=>'student_login.php'),
                                                );
                                }
                                $menuArr['Student Zone'] = array_merge($menuArr['Student Zone'],$newStudent);
                           $menuArr = [];
                                foreach($menuArr as $key => $val){
                                echo '<li class="dropdown" >
                                     <a href="javascript:return(0);">
                                     '.ucwords($key).' 
                                     </a>
                                      <ul>';
                                      foreach($val as $data){
                                          echo '<li ><a  href="'.$data['link'].'">'.ucwords($data['label']).'</a></li>';
                                      }
                                echo '</ul>
                                    </li>';
                            }
                  
                ?>
                <li><a href="course.php">Courses</a></li>
                
                <li><a href="<?=BASE_URL?>contact_us.php">Contact Query</a></li>
                
         

      </ul>
                        </div>
                     </nav>

<script>
    $(document).ready(function () {
        $("#toggleButton").click(function () {
            $(this).find("i").toggleClass("fa-bars fa-times");
        });
    });
</script>
