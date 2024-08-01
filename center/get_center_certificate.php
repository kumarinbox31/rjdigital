<?
if($_POST['status']=='center_certificate')

{
    
    require_once 'includes/config.php';

$admit = $con->query("SELECT * FROM centers where center_number  = '".$_POST['center_number']."'");


	if($admit->num_rows>0)
	{

		$a = $admit->fetch_assoc();

		 $c = $con->query("SELECT * FROM centers where id = '" . $s['center_id'] . "'")->fetch_assoc();
        
      
// print_r($a);exit;
		$course = $con->query("SELECT * FROM courses where id = '".$s['course_id']."'")->fetch_assoc();
		
		$bg = '../format/center_certificate.jpg';
		$img = '../uploads/centers/'.$a['image'];
		$photo = '../uploads/students/'.$s['photo'];
		$sign = '../uploads/centers/'.$a['sign'];
 		$name = $a['name'];
 		$center_number = $a['center_number'];
// 		$sl = str_pad($a['id'], 4, '0', STR_PAD_LEFT);
        $issue_date = $a['timestamp'];
        $isu_date = date("d-m-y", strtotime($issue_date));
        list($day, $month, $year) = explode('-', $isu_date);
		$center_code = $c['center_number'];
		$center_name = $a['institute_name'];
	    $city = $city['city'];
	    $state = $city['state'];
	    $session = $a['session'];
	    $valid = $a['valid_upto'];
	    
		$center_add = $a['center_full_address'];
		
// // $center_add = $a['center_full_address'];
// $address_parts = preg_split('/,/', $center_add, 3);

// // Now $address_parts is an array containing the three parts of the address
// $part1 = isset($address_parts[0]) ? trim($address_parts[0]) : '';
// $part2 = isset($address_parts[1]) ? trim($address_parts[1]) : '';
// $part3 = isset($address_parts[2]) ? trim($address_parts[2]) : '';

// You can use $part1, $part2, and $part3 as needed

// 		echo "Day: $day, Month: $month, Year: $year";
		$sign = '../uploads/centers/'.$c['sign'];
		include '../center_certificate.php';
		exit;
		?>
		<div class="col-md-6 col-md-offset-3">
			<div class="box box-default">
				<div class="box-header"><h5>Center Certificate</h5></div>
				<div class="box-body" id="printableArea">
					<table class="table table-bordered">
						<tbody>
							<tr><th>Institute Name</th> <td><?=$c['institute_name']?></td></tr>
							<tr><th>Enrollment No.</th> <td><?=$s['enrollment_no']?></td></tr>
							<tr><th>Roll No.</th> <td><?=$a['roll_no']?></td></tr>
							<tr><th>Student Name</th> <td><?=$s['name']?></td></tr>
							<tr><th>Father Name</th> <td><?=$s['father']?></td></tr>
							<tr><th>Mother Name</th> <td><?=$s['mother']?></td></tr>
							<tr><th>Course</th> <td><?=$course['course_name']?></td></tr>
						</tbody>
					</table>
				</div>
				<div class="box-footer">
					<button class="btn btn-default" onclick="printDiv('printableArea')"><i class="fa fa-print"></i> Print</button>
				</div>
			</div>
		</div>
		<?
	}
	else
	{
		echo '<script>alert("Enrollment or date of birth not matched.");location.href="get_franchise_certificate.php"</script>';
	}
}
else
{
    require_once 'includes/header.php';
    echo '<br><div class="ContentHolder"><div class="container">';
?>
<div class="col-md-6 col-md-offset-3">
	<div class="box box-danger">
		<div class="box-header"><h3>Center Certificate</h3></div>
		<div class="box-body">
			<form action="" method="post">
				<div class="form-group">
					<label>Center Number.</label>
					<input type="text" class="form-control" name="center_number" placeholder="Enter Center No.">
				</div>
			
				<div class="form-group">
					<button class="btn btn-danger" type="submit" name="status" value="center_certificate">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?
}
echo '</div></div>';
include 'includes/footer.php';
?>
<script type="text/javascript">
	function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>


