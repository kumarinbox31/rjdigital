<?
    $data =[
        'name' => 'Abhijeet Singh',
        'mobile' => '9955718214',
        'email' =>'kumarinbox31@gmail.com',
        'amount' => 100,
    ];
    $link = 'https://aiocomputerzone.org/instamojo/pay.php?'.http_build_query($data);
?>
<a href="<?=$link?>">Pay</a>