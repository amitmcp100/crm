<?php

include("config.php");
//$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection

// Posted Values
$id=$_GET['id'];
$store_id = $_SESSION['store_id'];
$create_date=date("Y-m-d");


$sql1 = "SELECT *  FROM `creditsms` WHERE `store_id` = '$store_id'";
$stmt = $DB->prepare($sql1);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
while ($row1 = $stmt->fetch()) {
$available_sms=$row1['available_sms'];
$used_sms=$row1['used_sms'];

}

$sql2 = "SELECT *  FROM `tbl_user_group` WHERE `store_id` = '$store_id'  and `parent_id`='0'";
//echo $sql2;
$stmt = $DB->prepare($sql2);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
while ($row2 = $stmt->fetch()) {

$sender_id=$row2['sender_id'];
}



if($available_sms>'1'){


$sql4 = "SELECT *  FROM `tbl_customer_data` WHERE `id` = '$id'  and  `store_id`= '$store_id'";
//echo $sql4;
$stmt = $DB->prepare($sql4);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
while ($row4 = $stmt->fetch()) {
$mobile=$row4['mobile'];
$name=$row4['name'];
}
//print_r($mobile);
//$count_mobile=count($mobile);
//$mobiles= implode(",",$mobile);
$sql12 = "SELECT *  FROM `tbl_store` WHERE `store_id` = '$store_id'";
$stmt = $DB->prepare($sql12);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
while ($row12 = $stmt->fetch()) {
$business_name=$row12['store_name'];
}

 $sql001 = "SELECT *  FROM `smstemplates` WHERE `message_type` = 'Anniversary' and `store_id` = '$store_id'";
 $stmt = $DB->prepare($sql001);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
while ($row001 = $stmt->fetch()) {
$mess=$row001['message'];

}

//echo "m".$mess;echo "</br>";
$sms_text=str_replace("customer_name",$name,$mess);
$sms_text=str_replace("retailer_name",$business_name,$sms_text);
include("sms_code.php");

if($response=='sms sent successfully'){
	$update_sms=$available_sms-1;
	$u_sms=$used_sms+1;
	$query="UPDATE `creditsms` SET `used_sms` = '$u_sms',`available_sms` = '$update_sms' WHERE `store_id` = '$store_id'";
	$stmt = $DB->prepare($query);
	$stmt->execute();

	$query011="INSERT INTO `sms_report` (`id`,`store_id`,`message`,`mobile`,`from_date`, `to_date`, `state`,`operator`, `status`, `send`,`update_on`) VALUES (NULL,'$store_id','$sms_text','$mobile','$create_date','$create_date', '1','operator','active','yes','on')";
	$stmt = $DB->prepare($query011);
	$stmt->execute();

	if($stmt==true)
	{

	header('Location: annivery-date.php?data=update');
	exit;
	}
	else
	{
	header('Location: annivery-date.php?data=error');
	exit;
	}
}else{
	header('Location: annivery-date.php?data=error');
	exit;
}
$err = curl_error($curl);

//exit;
}





 ?>