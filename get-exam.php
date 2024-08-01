<?php
require_once 'includes/header.php';
if(isset($_GET['exam-id'])){
    $ttl_questions = 0;
    $exam_id = base64_decode($_GET['exam-id']);
    $check = $con->query("SELECT * FROM exams_by_students WHERE exam_id = '$exam_id' and student_id = '".$_SESSION['student']['id']."' ");
    if($check->num_rows){
       echo '<script>alert("You are already complete this exam. View Result");location.href="'.BASE_URL.'view-result.php?result_id='.base64_encode($check->fetch_assoc()['id']).'";</script>';   
    }
    else{
        $exam = $con->query("SELECT * FROM exams as e,courses as c WHERE e.course_id = c.id AND e.id = '".$exam_id."' and e.status = '1' ");
        if($exam->num_rows){
            // echo '<pre>';
            // print_r($_SESSION);
            $myExam = $exam->fetch_assoc();
          
            $student = $con->query("SELECT * FROM students WHERE id = '".$_SESSION['student']['id']."'");
      
            if($student->num_rows){
                    $student = $student->fetch_assoc();
                    $allQues = [];
                    $questions = $con->query("SELECT * FROM exam_questions WHERE exam_id = '".$exam_id."'");
                    if($questions->num_rows){
                        $i = 0;
                        while($row = $questions->fetch_assoc()){
                            $data = [
                                    'title' => $row['question'],
                                    'id' => $row['id']
                                ];
                            $answers = $con->query("SELECT * FROM exam_question_answers_list WHERE exam_id = '$exam_id' and question_id ='".$row['id']."' ");
                            if($answers->num_rows){
                                $ans = [];
                                while($ansRow = $answers->fetch_assoc()){
                                    $ans[$ansRow['id']] = $ansRow['answer']; 
                                }
                                $data['answer_list'] = $ans;
                            }
                            $allQues[] = $data;
                        }
                    }
                    shuffle($allQues);
    
                    // Take only the first 20 elements
                    $allQues = array_slice($allQues, 0,$ttl_questions = $myExam['max_questions']);
                    // echo ;
                    // echo '<pre>';
                    // print_r($allQues);
                    // exit;
        ?>
       <style>
        
        .danger.exam_over{
            background:red;
            color:white;
        }
        .no-select {
                user-select: none;
            }
            .exam_over{
                    padding: 10px;
                    position: fixed;
                    font-size: 24px;
                    font-weight: 900;
                    background: #ffca21;
                    z-index: 99999999;
                    top: 24px;
                    right: 0;
                    border-radius: 10px 0 0 10px;
                    border: 6px solid black;
                    border-right-width: 0;
                    width: 226px;
                    box-shadow: 0 0 10px red;
            }
        </style>
        <div class="exam_over"></div>
        <div class="container main-con">
    				<h1 class="text-center mb-2"><?=$myExam['exam_name']?></h1>
    				<div class="row">
    					<div class="col-md-6 p-3">
    						<div class="shadow-my p-4 rounded bg-primary text-white ">
    							<div class="row">
    								<div class="col-md-4">
    									<label class="text-white">Student Name</label>
    								</div>
    								<div class="col-md-8">
    									<label class="text-white"><?= $student['name'] ?> <input class="nextTabs" name="other_tabs" type="hidden"></label>
    								</div>
    							</div>
    							<hr class=" m-1">
    							<div class="row">
    								<div class="col-md-4">
    									<label class="text-white">Student Email Id</label>
    								</div>
    								<div class="col-md-8">
    									<label class="text-white"><?= $student['email'] ?></label>
    								</div>
    							</div>
    							<hr class=" m-1">
    							<div class="row">
    								<div class="col-md-4">
    									<label class="text-white">Student Mobile No.</label>
    								</div>
    								<div class="col-md-8">
    									<label class="text-white"><?= $student['mobile'] ?></label>
    								</div>
    							</div>
    						</div>
    						
    					</div>
    					<div class="col-md-6 p-3">
    						<div class="shadow-my p-4 rounded bg-danger text-white">
    							<div class="row">
    								<div class="col-md-4">
    									<label class="text-white">Course Name</label>
    								</div>
    								<div class="col-md-8">
    									<label class="text-white"><?= $myExam['course_name'] ?></label>
    								</div>
    							</div>
    							<hr class=" m-1">
    							<div class="row">
    								<div class="col-md-4">
    									<label class="text-white">Admission Date</label>
    								</div>
    								<div class="col-md-8">
    									<label class="text-white"><?=date('d-F-Y',strtotime($student['dur_start']))?></label>
    								</div>
    							</div>
    							<hr class=" m-1">
    							<div class="row">
    								<div class="col-md-4">
    									<label class="text-white">Exam Date</label>
    								</div>
    								<div class="col-md-8">
    									<label class="text-white"><?= date('d-F-Y',strtotime($myExam['start'])) ?></label>
    								</div>
    							</div>
    						</div>
    						
    					</div>
    					
    				</div>
    
    				<div class="row">
    					<div class="col-12">
    					    
    					    <?php
    					    if(sizeof($allQues)){
    					        $i = 1;
    					        foreach($allQues as $ques){
    					            echo '<div class="border no-select rounded shadow-sm my-3 p-4">
                								<h4 class="fs-5 text-gry"> Q<span class="q_no">'.$i.'</span>. '.$ques['title'].'</h4>
                								';
                								if(isset($ques['answer_list'])){
                								    foreach($ques['answer_list'] as $ans_id =>  $ans){
                								        echo '<label>
                								                    <input class="answer" type="radio" name="'.$ques['id'].'" value="'.$ans_id.'"> '.$ans.'
                								              </label><br/>';
                								    }
                								}
                								echo '
                						</div>	';
    					            $i++;
    					        }
    					        
    					    }
    					    
    					    ?>
    						
    						<div class="text-center">
    						    <button type="submit" data-max_marks="<?=$myExam['max_questions']?>" data-course_id="<?=$myExam['course_id']?>" data-student_id="<?=$student['id']?>" data-length="<?=$ttl_questions?>" data-exam_id="<?=$exam_id?>" class="btn btn-primary my-3 submit">Submit Your Exam</button>
    						</div>
    					</div>
    					
    				</div>
    			</div>
        
        <?php
            }
            else{
                echo '<script>location.href="'.BASE_URL.'student_login.php";</script>';
            }
        }
    }
    
}
require_once 'includes/footer.php';
?>

<script>
    var timeOut = false;
    function startTimer(duration, display) {
        var start = Date.now(),
            diff,
            minutes,
            seconds;
        function timer() {
            // get the number of seconds that have elapsed since 
            // startTimer() was called
            diff = duration - (((Date.now() - start) / 1000) | 0);
    
            // does the same job as parseInt truncates the float
            minutes = (diff / 60) | 0;
            seconds = (diff % 60) | 0;
    
            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;
            if(minutes < 2){
                display.classList.add('danger');
            }
            display.textContent = minutes + ":" + seconds+" Time Left"; 
            if(minutes == 0 && seconds == 0){
                // alert('Time up');
                timeOut = true;
                $(".submit").trigger('click');
                return;
            }
            if (diff <= 0) {
                // add one second so that the count down starts at the full duration
                // example 05:00 not 04:59
                start = Date.now() + 1000;
            }
        };
        // we don't want to wait a full second before the timer starts
        timer();
        setInterval(timer, 1000);
    }
    
    window.onload = function () {
        var onehour = 60 * 60,
            display = document.querySelector('.exam_over');
        startTimer(onehour, display);
    };
    
    window.alert("Exam Note \n 1.) Exam देते समय New Tab Open ना करे। \n 2.) Exam देते समय Screen को बंद या Minimize ना करे। \n 3.) पेज को Reload ना करे। \n 4.) Internet Dis-Connect होने पर Exam Cut कर के Exam दोबारा Start करे। ");
		
			function s(selector)
			{
				return document.querySelector(selector);
			}
			
// 			var all_questions = document.getElementsByClassName('answer');
// 			var i;
// 			for(i=0;i<all_questions.length;i++)
// 			{
// 				all_questions[i].onclick = function()
// 				{
// 					var all_radio = this.parentElement.getElementsByTagName("input");
// 					var j;
// 					for(j=0;j<all_radio.length;j++)
// 					{
// 						all_radio[j].classList.remove("active");
// 					}
// 					this.classList.add("active");
// 				}
// 			}

var exam_in_running = true;
 $("html,body").on("contextmenu", function (e) {
            e.preventDefault();
        });
            $('.answer').on('click',function(){
                var ques = $(this).closest('div');
                $(ques).find('input').removeClass('active');
                $(this).addClass('active');
            })


			$(".submit").on('click',function(e){
				e.preventDefault();
				
				var that = this,
				    max_ques = $(this).data('length'),
				    exam_id = $(this).data('exam_id'),
				    student_id = $(this).data('student_id'),
				    course_id = $(this).data('course_id'),
				    status = 'check_answers',
				    max_marks = $(this).data('max_marks'),
				    nextTabsOpen = $('.nextTabs').val();
			
				var all_answers = $('.answer.active');
				var data = [];
				all_answers.each(function(i,v){
                    data.push([$(this).attr('name'),$(this).val()]);				    
				});
				var ques_ans = JSON.stringify(data);
				$.ajax({
				    type : 'POST',
				    url : '<?=BASE_URL?>admin/ExamAjax.php',
				    data : {status,exam_id,student_id,course_id,ques_ans,nextTabsOpen,max_marks},
				    dataType : 'json',
				    success : function(rs){
				        console.log(rs);
				        if(rs.status){
				            exam_in_running = false;
				            location.href=rs.url;
				        }
				    }
				});
				
				// console.log(data);
				
				
				
				/*
				var all_answer = document.getElementsByClassName("active");
				
				var i;
				var data = [];
				for(i=0;i<all_answer.length;i++)
				{
					var no = all_answer[i].parentElement.getElementsByClassName("q_no")[0].innerHTML;
					var ans = all_answer[i].value;
					var exam_c = "html_exam";
					var q = [no,ans,exam_c];
					data.push(q);					
				}
				
				alert(data.length);
            
    			if(data.length== <?=$ttl_questions?>)
    			{
    			    alert('ok');
    			    console.log(s(".submit"));
    				    
    			}
    			else
    			{
    				alert("You Only Attempt "+data.length+" Questions \nPlease Attempt All the Questions");
    			}*/
			
			
			});

    var nexT = 0;
    document.addEventListener("visibilitychange", function () {
       if (document.visibilityState === "hidden") {
           $('.nextTabs').val(++nexT);
       }
       else
            alert("Don't open the second Tab then everything is running under the supervision of administrator. ");
       return false;
    });
</script>


 <script>
    // $(document).ready(function() {
    //   // Click event handler for the button
    //   $('.answer').on('change', function() {
    //     // Get the height of the product container
    //     // var productContainerHeight = $('#productContainer').height();
    //     var currentPosition = $(window).scrollTop();
    //     var additionalHeight = $(this).closest('div').next().outerHeight(true);
    //     console.log(additionalHeight);
    //     // Scroll to the product container with animation
    //     $('html, body').animate({
    //       scrollTop: currentPosition + additionalHeight
    //     }, 800); // 800 milliseconds for the animation duration
    //   });
    // });
     $(window).on("beforeunload", function (event) {
               if (exam_in_running) {
                    var confirmationMessage = "Changes you made may not be saved.";
                    (event || window.event).returnValue = confirmationMessage; // Standard
                    return confirmationMessage; // IE/Edge
                }
            });
            
            $(window).on("unload", function () {
            // This is optional and can be used for additional cleanup or actions before the page is unloaded
            console.log("Page is being unloaded");
        });
  </script>