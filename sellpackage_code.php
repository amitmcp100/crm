<?php

 include("config.php");
//$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection
if(isset($_POST['submit']))
{
// Posted Values
$userid   =   $_POST['userid'];
$store_id = $_SESSION['store_id'];
$package_select = $_POST['package_select'];
$name = $_POST['package_name'];
$email=$_POST['package_email'];
$mobile=$_POST['package_mobile'];
$create_date=date("Y-m-d");

$query="INSERT INTO `tbl_sellpackage` (`id`,`store_id`,`package_id`, `name`, `email`, `mobile`, `create_date`, `userid`) VALUES (NULL,'$store_id','$package_select', '$name', '$email', '$mobile', '$create_date','$userid')";
$stmt = $DB->prepare($query);
$stmt->execute();
$sql1 = "SELECT *  FROM `creditsms` WHERE `store_id` = '$store_id'";
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
$sms_text="Dear ".$name." thanks for choosing our package !";
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
	$query="UPDATE `creditsms` SET `used_sms` = '$u_sms',`available_sms` = '$update_sms' WHERE `store_id` = '$store_id'";
	$stmt = $DB->prepare($query);
	$stmt->execute();

	$query011="INSERT INTO `sms_report` (`id`,`store_id`,`message`,`mobile`,`from_date`, `to_date`, `state`,`operator`, `status`, `send`,`update_on`) VALUES (NULL,'$store_id','$sms_text','$mobile','$date','$date', '1','operator','active','yes','on')";
 	 $stmt = $DB->prepare($query011);
 	 $stmt->execute();
	
	if($stmt==true)
	{

	header('Location: packagereport.php?data=update');
	exit;
	}
	else
	{
	header('Location: packagereport.php?data=error');
	exit;
	}
}else{
	header('Location: packagereport.php?data=error');
	exit;
}
$err = curl_error($curl);

	}
}

 ?>