<?
include 'includes/header.php';


    if($_POST['submit'] == 'add'){
            if(isset($_FILES['file']) && $_FILES['file']['name'] != ''){
                $file = files_upload('file','downloads');
            }
    //     if($file['status']==1)
    // 	{
            $filename = isset($file['status']) || $file['status']?$file['file_name']:'';
    	    $extra = isset($_POST['extra'])?$_POST['extra']:'';
    		$con->query("INSERT INTO `student_files` ( `extra`,`title`, `type` , `description` ,`file`) VALUES ('$extra','".$_POST['title']."','".$_POST['type']."','".$_POST['description']."', '".$filename."')");
    		echo '<script>alert("File Upload SuccessFully.");"</script>';
    // 	}
    // 	else
    // 	{
    // 		echo '<script>alert("Error in file Uploading.");"</script>';
    // 	}
    }
    if($_GET['action']=='del'){
        $id = $_GET['id'];
        $con->query("DELETE FROM `student_files` WHERE `id` = '".$id."' ");
    	echo '<script>alert("Deleted Successfully.");location.href="'.$_SERVER['HTTP_REFERER'].'";</script>';
    }

    if(isset($_POST['type'])){
    extract($_POST);
        $con->query("INSERT INTO `links`(`type`, `label`, `link`) VALUES ('$type','$label','$link')");
        $actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
        ?>
        <script>
            alert('Successfully saved');
        </script>
        <?
    
    }
    
    $page = $_GET['page'];

        echo '<div class="row">';
                echo '<div class="container"><h4 class="text-center alert alert-info"><b>'.ucwords(str_replace('_',' ',$page)).'</b></h4></div>';
            include 'setting/'.$page.'.php';
    
        echo '</div>';

include 'includes/footer.php';
?>
<script>
    $('.deleteRow').click(function(){
        var id = $(this).data('id');
        var table = $(this).data('table');
        $.ajax({
            url:'Ajax.php',
            type:'post',
            dataType:'json',
            data:{id:id,table:table,status:'deleteRow'},
            success:function(res){
                alert(res);
                $('#row_'+id).hide();
            //   window.location.reload();
                return false;
            }
        });
        
    });
    $('.extra_setting').submit(function(e){
        
        e.preventDefault();
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }
        $.ajax({
            url:'Ajax.php',
            type:'post',
            dataType:'json',
            data:$(this).serialize(),
            success:function(res){
                alert(res);
            }
        });
        
    });
</script>