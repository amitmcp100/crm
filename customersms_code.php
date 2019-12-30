<?php

include("config.php");
//$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection
//print_r($_POST);die;

if(isset($_POST['submit']))
{
// Posted Values
$store_id = $_SESSION['store_id'];
$id=$_POST['id'];
$userid=$_POST['user'];
$store=$_POST['store'];
$sms_text=$_POST['sms_text'];
$c_mobile=$_POST['c_mobile'];
$create_date=date("Y-m-d");

$sql1 = "SELECT *  FROM `creditsms` WHERE `store_id` = '$store_id'";
$stmt = $DB->prepare($sql1);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
while ($row1 = $stmt->fetch()) {
$available_sms=$row1['available_sms'];
$used_sms=$row1['used_sms'];

}

$sql2 = "SELECT *  FROM `tbl_user_group` WHERE `store_id` = '$store_id' AND `parent_id` = '0'";
$stmt = $DB->prepare($sql2);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
while ($row2 = $stmt->fetch()) {

$sender_id=$row2['sender_id'];

}
$mobile = $c_mobile;
//$sender_id='AKSHAY';
if($available_sms>'1'){
	
	include("sms_code.php");

if($response=='sms sent successfully'){
	$update_sms=$available_sms-1;
	$u_sms=$used_sms+1;
	$query="UPDATE `creditsms` SET `used_sms` = '$u_sms',`available_sms` = '$update_sms' WHERE `store` = '$store'";
	$stmt = $DB->prepare($query);
	$stmt->execute();

	$query011="INSERT INTO `sms_report` (`id`, `message`,`mobile`,`from_date`, `to_date`, `state`,`operator`, `status`, `send`,`update_on`) VALUES (NULL,'$sms_text','$c_mobile','$create_date','$create_date', '1','operator','active','yes','on')";
	$stmt = $DB->prepare($query011);
	$stmt->execute();


	if($stmt==true)
	{

	header('Location: customer-view.php?data=update');
	exit;
	}
	else
	{
	header('Location: customer-view.php?data=error');
	exit;
	}
}else{
	header('Location: customer-view.php?data=error');
	exit;
}
$err = curl_error($curl);

//exit;
}

}

 ?>