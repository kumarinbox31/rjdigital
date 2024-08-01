<?php
require_once 'includes/config.php';

$return = ['status' => false,'data' => []];

$post = $_POST;
$get = $_GET;
 $data = [];
if(isset($get['status'])){
    switch($get['status']){
        case 'students_exam_list':
            $records = $con->query("SELECT *,es.id as student_exam_id,s.name as student_name FROM exams_by_students as es,students as s,courses as c,exams as e WHERE es.student_id = s.id and es.exam_id = e.id and es.course_id = c.id");
            if($records->num_rows){
                    while($row = $records->fetch_assoc()){
                        $data[] = $row;
                    }
                }
                $return['data'] = $data;
            break;
        case 'exam_list':
                $records = $con->query("SELECT exams.*,courses.course_name FROM exams,courses WHERE courses.id = exams.course_id");
                if($records->num_rows){
                    while($row = $records->fetch_assoc()){
                        $data[] = $row;
                    }
                }
                $return['data'] = $data;
            break;
        case 'question_list':
                $records = $con->query("SELECT * FROM exam_questions WHERE exam_id = '".$get['exam_id']."'");
                if($records->num_rows){
                    while($row = $records->fetch_assoc()){
                        $data[] = $row;
                    }
                }
                $return['data'] = $data;
            break;
    }
}

if(isset($post['status'])){
    switch ($post['status']) {
        case 'set-exam-schedule':
                $con->query("UPDATE `exams` SET `start` = '".$post['start']."',end = '".$post['end']."' WHERE `exams`.`id` = '".$post['id']."' ");
                $return['status'] = true;
            break;
        case 'check_answers':
                $allAnswerSHeet = json_decode($_POST['ques_ans']);
                extract($_POST);
                if($ttl_attempts = sizeof($allAnswerSHeet)){
                    $ttl = 0;
                    $return['$allAnswerSHeet'] = $allAnswerSHeet;
                    foreach($allAnswerSHeet as $queAns){
                        $ans_id = $queAns[1];
                        $que_id = $queAns[0];
                        $query = $con->query("SELECT * FROM exam_question_answers_list where id = '$ans_id' and question_id = '$que_id' and is_right_answer = '1' ");
                        if($query->num_rows)
                            $ttl++;
                    }
                    $time = time();
                    $return['status'] = true;
                    $con->query("INSERT INTO `exams_by_students` (`id`, `time`, `exam_id`, `course_id`, `student_id`, `ttl_attempts`, `max_marks`, `total`,`nextTabsOpen`) VALUES (NULL, '$time', '$exam_id', '$course_id', '$student_id', '$ttl_attempts', '$max_marks', '$ttl','$nextTabsOpen')");
                    $return['url'] = BASE_URL.'view-result.php?result_id='.base64_encode($con->insert_id);
                    $return['ttl']  = $ttl;
                }
                else
                    $return['html'] = 'Please  Select Answers.';
                    $return['data'] = $post;
            break;
        case 'change-exam-status':
            $con->query("UPDATE `exams` SET `status` = '".$post['eStatus']."' WHERE `exams`.`id` = '".$post['exam_id']."'");
            $return['status'] = true;
            // $return['html'] = "UPDATE `exams` SET `status` = '".$post['eStatus']."' WHERE `exams`.`id` = '".$post['exam_id']."'";
            break;
        case 'delete_exam':
                $con->query("DELETE FROM exams WHERE id = '".$post['id']."' ");
                $con->query("DELETE FROM `exam_questions` WHERE `exam_questions`.`exam_id` = '".$post['id']."'");
                $con->query("DELETE FROM `exam_question_answers_list` WHERE `exam_question_answers_list`.`exam_id` = '".$post['id']."'");
                $return['status'] = true;
            break;
        case 'delete_question':
                $con->query("DELETE FROM `exam_questions` WHERE `exam_questions`.`id` = '".$post['question_id']."'");
                $con->query("DELETE FROM `exam_question_answers_list` WHERE `exam_question_answers_list`.`question_id` = '".$post['question_id']."'");
                $return['status'] = true;
            break;
        case 'get_answer':
            $question = $con->query("SELECT * FROM exam_question_answers_list WHERE question_id = '".$post['question_id']."' ");
            if($question->num_rows){
                $html = '';
                while($row = $question->fetch_assoc()){
                    $class = $row['is_right_answer'] ? 'green' : 'red';
                    $font = $row['is_right_answer'] ? 'up' : 'down';
                $html .= '<div class="info-box bg-'.$class.'" style="min-height:34px;">
                            <span class="info-box-icon" style="font-size:19px;height:34px;line-height:38px"><i class="fa fa-thumbs-o-'.$font.'"></i></span>
                                <div class="info-box-content">
                                
                                    <span class="info-box-number">'.$row['answer'].'</span>
                                
                                
                                </div>
                            
                            </div>';
                }
                $return['html'] = $html;
            }
            else
                $return['html'] = '<div class="alert alert-danger">Answer list not found.</div>';
            break;
        case 'create_exam';
    		$select = $con->query("SELECT * FROM exams WHERE course_id = '".$post['course_id']."' ");
            if($select->num_rows){
                $return = (['status' => false,'message' => 'Exam already Exists of Selected Course.']);
            }
            else{
                $status =  $con->query("INSERT INTO `exams` (`id`, `exam_name`, `max_questions`, `course_id`) VALUES (NULL, '".$post['exam_name']."', '".$post['max_questions']."', '".$post['course_id']."')");
                if($status){
                	// print_r($con->error);
                	$return = (['status' => $status,'data' => 'success']);
                }else{
					$return = (['status' => $status,'data'=>$con->error]);
                }
            	
            }
        break;
        
        case 'add_question':
            $question = $con->query("INSERT INTO `exam_questions` (`id`, `exam_id`, `question`) VALUES (NULL, '".$post['exam_id']."', '".$post['question']."')");
            $question_id = $con->insert_id;
            if(isset($post['answer'])){
                if(count($post['answer'])){
                    foreach($post['answer'] as $index => $answer){
                        $isRightAnswer = isset($post['right_answer'][$index]) ? 1 : 0;
                        $con->query("INSERT INTO `exam_question_answers_list` (`id`, `question_id`, `answer`, `is_right_answer`,`exam_id`) VALUES (NULL, '$question_id', '".$answer."', '$isRightAnswer','".$post['exam_id']."')");
                    }
                }
            }
            $return['status'] = true;
            break;
    }
}



echo json_encode($return);


