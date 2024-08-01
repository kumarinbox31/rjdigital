<?
require_once 'includes/header.php';
if(isset($_POST['status']) && $_POST['status'] == 'add_slider')
{
	$allowedExts = array("gif","jpeg","jpg","png");
						$temp = explode(".",$_FILES["file"]["name"]);
						$extension = end($temp);

						if((($_FILES["file"]["type"] == "image/gif")
						||($_FILES["file"]["type"] == "image/jpeg")
						||($_FILES["file"]["type"] == "image/jpg")
						||($_FILES["file"]["type"] == "image/pjpeg")
						||($_FILES["file"]["type"] == "image/x-png")
						||($_FILES["file"]["type"] == "image/png"))
						&& in_array($extension, $allowedExts))
						{
							if($_FILES["file"]["error"]>0)
							{
								echo '<div class="alert alert-danger">Return Code: '.$_FILES["file"]["error"].'</div>';
							}
							else
							{
								$fileName = $temp[0].".".$temp[1];
								$temp[0] = rand(0,3000);

								if(file_exists("../uploads/".$_FILES["file"]["name"]))
								{
									echo '<div class="alert alert-danger">'.$_FILES["file"]["name"].'Already Exists</div>';
								}
								else
								{
									$newfilename = time().rand(1000, 9999);
									$aa = 'slider__'.$newfilename;
									$a = '../uploads/'.$aa;
									$photo_address = '../uploads/';
									$z = move_uploaded_file($_FILES["file"]["tmp_name"], $a);
									$con->query("INSERT INTO `sliders` (`id`, `timestamp`, `image`, `content`,`type`) VALUES (NULL, CURRENT_TIMESTAMP, '".$aa."', '".$_POST['content']."', '".$_POST['type']."')");
									echo '<script>alert("Slider SuccessFully Upload.");location.href=""</script>';

								}
							}
						}
						else
						{
							echo '<script>alert("Error in Slider Uploading.");</script>';
						}
}
?>

        <div class="row d-flex">
            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header"><h3 class="text-center title-2">Add Secondary Slider</h3></div>
                    <div class="box-body">
                    	<div id="Alert" style="z-index: 99999"></div>
                        
                        <form action="" method="post" novalidate="novalidate" class="" enctype="multipart/form-data">
                            <input type="hidden" name="type" value="secondary">
                        	<input type="hidden" name="status" value="add_slider">
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Slider Image</label>
                                <input name="file" type="file" class="form-control" placeholder="Enter Page Name" required="">
                            </div>
                            <div class="form-group has-success">
                                <label for="cc-name" class="control-label mb-1">Slider Content</label>
                                <textarea  class="form-control ckeditor" name="content" placeholder="Enter Page Content" required=""></textarea>
                               
                            </div>
                            
                                <button id="btn" type="submit" class="btn btn-info">
                                    Add
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header"><h3 class="text-center title-2">Add Primary Slider</h3></div>
                    <div class="box-body">
                    	<div id="Alert" style="z-index: 99999"></div>
                        
                        <form action="" method="post" novalidate="novalidate" class="" enctype="multipart/form-data">
                            <input type="hidden" name="type" value="main">
                        	<input type="hidden" name="status" value="add_slider">
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Slider Image</label>
                                <input name="file" type="file" class="form-control" placeholder="Enter Page Name" required="">
                            </div>
                            <div class="form-group has-success" style="display:none;">
                                <label for="cc-name" class="control-label mb-1">Slider Content</label>
                                <textarea  class="form-control ckeditor" name="content" placeholder="Enter Page Content" required=""></textarea>
                               
                            </div>
                            
                                <button id="btn" type="submit" class="btn btn-info">
                                    Add
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
                            
<?
include 'includes/footer.php';
?>
