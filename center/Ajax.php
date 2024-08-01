<? require_once 'includes/config.php';
if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $post = $_POST;
    $return = [];
    switch($post['status'])
    {
        case 'get_courses':
            $get = $con->query("SELECT * FROM students where enrollment_no = '".$post['enrollment_no']."'")->fetch_assoc();
            $course = $con->query("SELECT * FROM courses where id = '".$get['course_id']."'")->fetch_assoc();
            echo $course['course_name'].'|'.$course['id']; // Use $course instead of $c
        break;
        case 'get_roll':
            $get = $con->query("SELECT * FROM students where enrollment_no = '".$post['enrollment_no']."'")->fetch_assoc();
            $course = $con->query("SELECT * FROM courses where id = '".$get['course_id']."'")->fetch_assoc();
            echo $course['course_name'].'|'.$course['id']; // Use $course instead of $c
        break;
        //  case 'get_roll':
        //     $enrollmentNo = $post['enrollment_no'];
        //     $student = $con->query("SELECT * FROM students WHERE enrollment_no = '$enrollmentNo'")->fetch_assoc();
            
        //     if ($student) {
        //         $courseId = $student['course_id'];
        //         $course = $con->query("SELECT * FROM courses WHERE id = '$courseId'")->fetch_assoc();
                
        //         if ($course) {
        //             $return['course_name'] = $course['course_name'];
        //             $return['course_id'] = $course['id'];
        //         }
        //     }
        //     break;

    }
    echo json_encode($return);
}
?>