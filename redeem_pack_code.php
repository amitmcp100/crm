<?php

include("config.php");
//$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection

if(isset($_POST['submit']))
{
// Posted Values

$userid    = $_POST['user'];
$store_id  = $_SESSION['store_id'];

$mobile    = $_POST['mobile'];
$date=date("Y-m-d");
$otp= str_pad(rand(0,999999), 6);

$sql = "INSERT INTO `tbl_package_otp` (`id`,`store_id`,`mobile`, `otp`, `create_date`, `status`) VALUES (NULL,'store_id','$mobile', '$otp', '$date', '0')";
$stmt = $DB->prepare($sql);
$stmt->execute();
if($stmt==true){
$last_id = $DB->lastInsertId();

    //echo "New record created successfully. Last inserted ID is: " . $last_id;
} else {
    //echo "Error: " . $sql . "<br>" . $con->error;
}
$sql1 = "SELECT *  FROM `creditsms` WHERE `store_id` = '$store_id'";
$stmt = $DB->prepare($sql1);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
while ($row1 = $stmt->fetch()) { 

$available_sms=$row1['available_sms'];
$used_sms=$row1['used_sms'];

}


$sql2 = "SELECT *  FROM `tbl_user_group` WHERE  `store_id` = '$store_id' and `parent_id` ='0'";
$stmt = $DB->prepare($sql2);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
while ($row2 = $stmt->fetch()) { 
$sender_id=$row2['sender_id'];

}

$sms_text='OTP for redeem package '.$otp;

if($available_sms>'1'){
include("sms_code.php");
if($response=='sms sent successfully'){
	$update_sms=$available_sms-1;
	$u_sms=$used_sms+1;
	$query="UPDATE `creditsms` SET `used_sms` = '$u_sms',`available_sms` = '$update_sms' WHERE `store_id` = '$store_id'";
	$stmt = $DB->prepare($query);
	$stmt->execute();


	$query011="INSERT INTO `sms_report` (`id`,`store_id`,`message`,`mobile`,`from_date`, `to_date`, `state`,`operator`, `status`, `send`,`update_on`) VALUES (NULL,'$store_id','$sms_text','$mobile','$date','$date', '1','operator','active','yes','on')";
 	 $stmt = $DB->prepare($query011);
 	 $stmt->execute();

	if($stmt==true)
	{

	header('Location: redeempack_verify.php?id='.$last_id);
	exit;
	}
	else
	{
	header('Location: redeempack_verify.php?data=error');
	exit;
	}
}else{
	header('Location: redeempack_verify.php?data=error');
	exit;
}
$err = curl_error($curl);

	}
}
header('Location: redeempack_verify.php?id='.$last_id);
	exit;

 ?>