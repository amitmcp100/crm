<?php 
include("config.php");
//$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection


$store_id =  $_SESSION['store_id'];
$service=$_POST['services'];
$servivearry=array();
foreach ($service as $ser){
	$serviceqty = preg_replace('/\s*/', '', $ser);
	$serviceqty = strtolower($serviceqty);
	$servivearry[]= $ser."|".$_POST[$serviceqty];
}


$servicedata= serialize($servivearry);
$employee=$_POST['employee'];
$time_slot1=$_POST['radio'];
$cname=$_POST['cname'];
$cmobile=$_POST['cmobile'];
$cemail=$_POST['cemail'];
$caddress=$_POST['caddress'];
$create_date=date("Y-m-d");


foreach ($time_slot1 as $time_slot){ 
   
$query="INSERT INTO `tbl_appoinment` (`id`, `store_id`, `services`, `emp_id`, `time_slot`, `c_name`, `c_mobile`, `c_email`, `c_address`, `date`) VALUES (NULL,'$store_id', '$servicedata', '$employee', '$time_slot', '$cname', '$cmobile', '$cemail', '$caddress', '$create_date')";

$stmt = $DB->prepare($query);
$stmt->execute();
}

header('Location: view-appoinment.php?data=update');
exit;





?>