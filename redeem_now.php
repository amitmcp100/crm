<?php

include("config.php");
//$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection

if(isset($_GET['mobile']))
{
// Posted Values
$userid=$_GET['userid'];
$store=$_GET['store'];
$service=$_GET['service'];
$mobile=$_GET['mobile'];
$sellid=$_GET['sellid'];
$pack=$_GET['pack'];
$create_date=date("Y-m-d");

$query="INSERT INTO `tbl_redeem_package` (`id`, `sell_pack_id`, `mobile`, `package`, `redeem_qty`, `store_id`, `create_date`) VALUES (NULL, '$sellid', '$mobile', '$service', '1', '$store', '$create_date')";
$stmt = $DB->prepare($query);
$stmt->execute();
$sql1 = "SELECT *  FROM `creditsms` WHERE `store` = '$store'";
$stmt = $DB->prepare($sql1);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
while ($row1 = $stmt->fetch()) { 
$available_sms=$row1['available_sms'];
$used_sms=$row1['used_sms'];

}

$sql2 = "SELECT *  FROM `tbl_user_group` WHERE `child_id` = '$userid'";
$stmt = $DB->prepare($sql2);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
while ($row2 = $stmt->fetch()) { 
$sender_id=$row2['sender_id'];

}


if($available_sms>'1'){
$curl = curl_init();
$sms_text="thanks for redeem service ".$service;
curl_setopt_array($curl, array(
  CURLOPT_URL => "http://msg160.com/sendsms/send1_post",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"userid\"\r\n\r\nyogesh\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"pass\"\r\n\r\n12345678\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"sender\"\r\n\r\n".$sender_id."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"mobile\"\r\n\r\n".$mobile."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"message\"\r\n\r\n".$sms_text."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"route\"\r\n\r\n5\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
    "postman-token: 2e642de6-bd3c-1d3f-b5ce-3acd25867c5b"
  ),
));

$response = curl_exec($curl);
if($response=='sms sent successfully'){
	$update_sms=$available_sms-1;
	$u_sms=$used_sms+1;
	$query="UPDATE `creditsms` SET `used_sms` = '$u_sms',`available_sms` = '$update_sms' WHERE `store` = '$store'";
	$stmt = $DB->prepare($query);
    $stmt->execute();

    $query011="INSERT INTO `sms_report` (`id`, `message`,`mobile`,`from_date`, `to_date`, `state`,`operator`, `status`, `send`,`update_on`) VALUES (NULL,'$sms_text','$mobile','$create_date','$create_date', '1','operator','active','yes','on')";
 	 $stmt = $DB->prepare($query011);
 	 $stmt->execute();
                                                   
	if($stmt==true)
	{

	header('Location: redeempackage.php?data=update&mobile='.$mobile);
	exit;
	}
	else
	{
	header('Location: redeempackage.php?data=error&mobile='.$mobile);
	exit;
	}
}else{
	header('Location: redeempackage.php?data=error&mobile='.$mobile);
	exit;
}
$err = curl_error($curl);

	}
}

 ?>