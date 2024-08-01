<?
require_once 'includes/config.php';
$post = $_POST;
switch ($post['status']) {
        case 'useItems':
            $page_id =$post['page_id'];
            $type = $post['type'];
             $chk = $con->query("SELECT * FROM `web_schema` WHERE `page_id` = '".$post['page_id']."' AND `type` = '".$post['type']."' ");
             if($chk->num_rows){
                 $con->query("DELETE FROM `web_schema` WHERE `page_id` = '$page_id' AND `type` = '$type'");
             }else{
                 $query = $con->query("INSERT INTO `web_schema` (`type`,  `page_id`) VALUES ('$type','$page_id')");
                 if(!$query){
                     print_r($con->error);exit;
                 }
             }
             echo 1;
        break;
	    case 'extra_setting':
	        unset($post['status']);
	        foreach($post as $key => $val){
	            $chk = $con->query("SELECT * FROM `setting` WHERE `type` = '$key' ")->num_rows;
	            if($chk){
		            $query = $con->query("UPDATE `setting` SET `value`= '$val' WHERE `type` = '$key' ");
	            }else{
	                $query = $con->query("INSERT INTO `setting`(`type`, `value`) VALUES ('$key','$val')");
	            }
	        }
	        if(isset($_FILES)){
	            foreach($_FILES as $key => $file){
	                $logo = photo_upload($key,'files');
	                $val = $logo['file_name'];
	                $chk = $con->query("SELECT * FROM `setting` WHERE `type` = '$key' ")->num_rows;
    	            if($chk){
    		            $query = $con->query("UPDATE `setting` SET `value`= '$val' WHERE `type` = '$key' ");
    	            }else{
    	                $query = $con->query("INSERT INTO `setting`(`type`, `value`) VALUES ('$key','$val')");
    	            }
	            }
	        }
		    if($query){
		        $res = 'Successfully Saved';
		    }else{
		        $res = 'Something went wrong';
		    }
		    echo json_encode($res);
	    break;
		case 'Add_Menu':
			$chk = $con->query("SELECT * FROM menu where name = '".$post['name']."'");
			if(!($chk->num_rows))
			{
				$con->query("INSERT INTO `menu` (`id`, `timestamp`, `name`) VALUES (NULL, CURRENT_TIMESTAMP, '".$post['name']."')");
				echo '1';
			}
			else
			{
				echo '0';
			}
			
		break;
		case 'deleteRow':
		    $id = $post['id'];
		    $table = $post['table'];
		    $query = $con->query("DELETE FROM $table WHERE `id` = '$id'");
		    if($query){
		        $res = 'Successfully Deleted';
		    }else{
		        $res = 'Something went wrong';
		    }
		    echo json_encode($res);
		 break;
         case 'change_seq_of_sliders':
    		        $return['status'] = true;
    		        foreach($post['order'] as $k => $id)
    		            $con->query("UPDATE `gallery_category` SET `seq` = ($k+1) WHERE `gallery_category`.`id` = '".$id."'");
    		        $return['text'] = 'Order successfully Change.';
    		        $return['class_name'] = 'success';
    		        echo json_encode($return);
    		     break;
    	case 'change_seq_of_gallery':
    		        $return['status'] = true;
    		        foreach($post['order'] as $k => $id)
    		            $con->query("UPDATE `gallery` SET `seq` = ($k+1) WHERE `gallery`.`id` = '".$id."'");
    		        $return['text'] = 'Order successfully Change.';
    		        $return['class_name'] = 'success';
    		        echo json_encode($return);
    		     break;
    		  //   case 'Check_Login':
        //             $post = $_POST;
                
        //             if ($_SESSION['digit'] == $post['digit']) {
        //                 $search = [" ", ",", "/", "#", "^", "*", "!", "'"];
        //                 $username = str_replace($search, '', $post['username']);
        //                 $password = str_replace($search, '', $post['password']);
                
        //                 $login = $con->prepare("SELECT * FROM login WHERE username = $username AND password = $password");
        //                 $login->bind_param("ss", $username, md5($password));
        //                 $login->execute();
        //                 $login->store_result();
                
        //                 if ($login->num_rows > 0) {
        //                     $login->bind_result($id, $type);
        //                     $login->fetch();
                
        //                     $rand = rand(111111, 999999);
        //                     $_SESSION['admin']['id'] = $id;
        //                     $_SESSION['admin']['session_id'] = $rand;
        //                     $_SESSION['admin']['login'] = true;
        //                     $_SESSION['admin']['type'] = $type;
                
        //                     $con->query("INSERT INTO `check_session` (`id`, `timestamp`, `user_id`, `session_id`) VALUES (NULL, CURRENT_TIMESTAMP, '$id', '$rand')");
        //                     session_regenerate_id(true);
                
        //                     echo json_encode(1);
        //                 } else {
        //                     echo json_encode(0);
        //                 }
        //             } else {
        //                 echo json_encode(2);
        //             }
        //             break;

		case 'Check_Login':
    $post = $_POST;
    if ($_SESSION['digit'] == $post['digit']) {
        $search = '';//[" ", ",", "/", "#", "^", "*", "!", "'"];
        // $username = str_replace($search, '', $post['username']);
        // $password = str_replace($search, '', $post['password']);
        
        $username = mysqli_real_escape_string( $con, $_POST['username']);
     $password = mysqli_real_escape_string( $con, $_POST['password']);

        // Use prepared statement to prevent SQL injection
        $stmt = $con->prepare("SELECT id, type FROM login WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, md5($password));
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $type);
            $stmt->fetch();

            $rand = rand(111111, 999999);
            $_SESSION['admin']['id'] = $id;
            $_SESSION['admin']['session_id'] = $rand;
            $_SESSION['admin']['login'] = true;
            $_SESSION['admin']['type'] = $type;

            $con->query("INSERT INTO `check_session` (`id`, `timestamp`, `user_id`, `session_id`) VALUES (NULL, CURRENT_TIMESTAMP, '$id', '$rand')");
            session_regenerate_id(true);

            echo json_encode(1);
        } else {
            echo json_encode(0);
        }

        $stmt->close(); // Close the prepared statement
    } else {
        echo json_encode(2);
    }
    break;


		case 'get_city':
			$get = $con->query("SELECT * FROM city where state_id = '".$post['state_id']."'");
			while($g = $get->fetch_assoc())
			{
				echo '<option value="'.$g['id'].'">'.ucwords($g['city_name']).'</option>';
			}
		break;
		
			case 'get_city2':
			$get = $con->query("SELECT * FROM city where state_id = '".$post['state_id']."'");
			while($g = $get->fetch_assoc())
			{
				echo '<option>'.ucwords($g['city_name']).'</option>';
			}
		break;
		case 'get_subjects':
			echo '<table class="table table-bordered">
				<thead>
					<tr>
						<th>#</th>
						<th>Subject Name</th>
						<th>Remove</th>
					</tr>
				</thead>
				<tbody>';
					$i=1;
					$get = $con->query("SELECT * FROM subjects where course_id = '".$post['course_id']."'");
					while($g = $get->fetch_assoc())
					{
						echo '
								<tr>
									<td>'.$i++.'</td>
									<td>'.ucwords($g['subject_name']).'</td>
									<td><a href="?sub_id='.$g['id'].'&action=sub_del" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
								</tr>
						';
					}
				echo '</tbody>
			</table>';
		break;
		case 'subjects':
			$get = $con->query("SELECT * FROM subjects where course_id = '".$post['course_id']."'");
			while($g = $get->fetch_assoc())
			{
				echo '
				        <input type="hidden" name="subject_id[]" value="'.$g['id'].'">
						<div class="form-group col-md-4">
							<label>'.ucwords($g['subject_name']).'&nbsp; </label><br> <span class="text-danger">[Max Marks: '.$g['max_marks'].'] | [Min Marks: '.$g['min_marks'].']</span>
							<input type="text" class="form-control" min="0" name="marks[]" placeholder="(Theory,Practical,Grade) Like: 45,20,A" required>
						</div>
				';
			}
			echo '
			    <div class="form-group col-md-3">
				<label>Grade</label>
				<input type="text" class="form-control" name="grade" placeholder="Grade (A/B/C)">
			</div>
			
			<div class="form-group col-md-3">
				<label>Result</label>
				<input type="text" class="form-control" id="result" name="result" placeholder="Enter Result" value="" >
			</div>
			<div class="form-group col-md-12">
				<button class="btn btn-primary" type="submit" name="status" value="create_result">Submit</button>
			</div>
			';
		break;
        case 'fetch_student_details':
    $enrollmentNo = $_POST['enrollment_no'];
    // Assuming you have a function to fetch student details based on enrollment number
    $studentDetails = fetchStudentDetails($enrollmentNo);
    echo $studentDetails;
    break;
		case 'get_roll':
			$get = $con->query("SELECT * FROM admit_card where enrollment_no = '".$post['enrollment_no']."'")->fetch_assoc();
			$c = $con->query("SELECT * FROM courses where id = '".$get['course_id']."'")->fetch_assoc();
			
			echo $get['roll_no'].'|'.$c['id'].'|'.$c['course_name'];
		break;
		
		case 'course_fee':
		   $get = $con->query("SELECT * FROM courses where id = '".$post['course_id']."'")->fetch_assoc();
		   echo $get['fee'];
		break;
		
		case 'get_courses':
		    $get = $con->query("SELECT * FROM students where enrollment_no = '".$post['enrollment_no']."'")->fetch_assoc();
		    $c = $con->query("SELECT * FROM courses where id = '".$get['course_id']."'")->fetch_assoc();
		  //  echo $c['course_name'].'|'.$c['id'];
		  // echo json_encode($c);
		  echo json_encode(['course_name' => $c['course_name'],'id' => $c['id'], 'student_id' => $get['id'],'status' => true]);
		break;
		case 'contact_us':
		    ///alert("hii");
            $get = $con->query("INSERT INTO `contact_query` (`id`, `timestamp`, `name`, `mobile`, `email`, `message`) VALUES (NULL, current_timestamp(),'".$_POST['name']."', '".$_POST['mobile']."', '".$_POST['email']."', '".$_POST['message']."') ");
        echo json_encode($con);//'Contact form submitted successfully';
        break;


}
function photo_upload($file,$path)
{
  $allowedExts = array("gif","jpeg","jpg","png");
  $temp = explode(".",strtolower($_FILES[$file]["name"]));
  $extension = end($temp);
  $return = array();
  
    $return['status'] = 0;
  if((($_FILES[$file]["type"] == "image/gif")
  ||($_FILES[$file]["type"] == "image/jpeg")
  ||($_FILES[$file]["type"] == "image/jpg")
  ||($_FILES[$file]["type"] == "image/pjpeg")
  ||($_FILES[$file]["type"] == "image/x-png")
  ||($_FILES[$file]["type"] == "image/png"))
  && in_array($extension, $allowedExts))
  {
    if($_FILES[$file]["error"]>0)
    {
      $return['error'] = '<div class="alert alert-danger">Return Code: '.$_FILES[$file]["error"].'</div>';
    }
    else
    {
      $_FILESName = $temp[0].".".$temp[1];
      $temp[0] = rand(0,3000);

      if(file_exists("../uploads/".$path.'/'.$_FILES[$file]["name"]))
      {
        $return['error'] = '<div class="alert alert-danger">'.$_FILES[$file]["name"].'Already Exists</div>';
      }
      else
      {
        									$newfilename = time().rand(1000, 9999);

        $aa = 'product__'.$newfilename;
        $a = '../uploads/'.$path.'/'.$aa;
        $photo_address = '../uploads/';
        $z = move_uploaded_file($_FILES[$file]["tmp_name"], $a);
        $return['file_name'] = $aa;
        $return['status'] = 1;
      }
    }
  }
  return $return;
}
?>