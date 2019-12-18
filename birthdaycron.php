<?php
include("config.php");
//$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);


$create_date=date("Y-m-d");

$sql1 = "SELECT *  FROM `creditsms` ";
$stmt = $DB->prepare($sql1);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
while ($row1 = $stmt->fetch()) {
$available_sms=$row1['available_sms'];
$used_sms=$row1['used_sms'];

}


$sql2 = "SELECT *  FROM `tbl_user_group` WHERE `store_id` = '1'";
//echo $sql2;
$stmt = $DB->prepare($sql2);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
while ($row2 = $stmt->fetch()) {

$sender_id=$row2['sender_id'];
}



$cu_date=date("m-d");

//Birthday
$birthday_mobile=array();
$sqlbirthday = "SELECT mobile as bid FROM `tbl_customer_data` WHERE `dob` LIKE '%$cu_date%'";
$stmt = $DB->prepare($sqlbirthday);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
while ($birth = $stmt->fetch()) {
$birthday_mobile[]=$bith['bid'];
}


$birth_mobilenumber=implode(",",$birthday_mobile);
$birthsmscount= count($birthday_mobile);
if($available_sms>'1'){



//print_r($mobile);
//$count_mobile=count($mobile);
//$mobiles= implode(",",$mobile);
$sql12 = "SELECT *  FROM `tbl_user_data` WHERE `store` = '1' and `roles_name` = 'superadmin'";
$stmt = $DB->prepare($sql12);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
while ($row12 = $stmt->fetch()) {
$business_name=$row12['business_name'];

}

$sql001 = "SELECT *  FROM `smstemplates` WHERE `message_type` = 'Birthday' and `store` = '0'";
$stmt = $DB->prepare($sql001);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
while ($row001 = $stmt->fetch()) {
$mess=$row001['message'];

}



$sql4 = "SELECT *  FROM `tbl_customer_data` WHERE `mobile` IN (".implode(',',$birthday_mobile).")";
echo $sql4;
$stmt = $DB->prepare($sql4);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
while ($row4 = $stmt->fetch()) {
$mobile=$row4['mobile'];
$name=$row4['name'];
//echo "m".$mess;echo "</br>";
$sms_text=str_replace("customer_name",$name,$mess);
$sms_text=str_replace("retailer_name",$business_name,$sms_text);

$curl = curl_init();
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
//echo "sss".$sender_id;echo "</br>";
//echo $sender_id;echo "</br>";
echo $response;
//exit;
if($response=='sms sent successfully'){
	$update_sms=$available_sms-1;
	$u_sms=$used_sms+1;
	$query="UPDATE `creditsms` SET `used_sms` = '$u_sms',`available_sms` = '$update_sms' WHERE `store` = '1'";
	$stmt = $DB->prepare($query);
  $stmt->execute();

  $query011="INSERT INTO `sms_report` (`id`, `message`,`mobile`,`from_date`, `to_date`, `state`,`operator`, `status`, `send`,`update_on`) VALUES (NULL,'$sms_text','$mobile','$create_date','$create_date', '1','operator','active','yes','on')";
  $stmt = $DB->prepare($query011);
  $stmt->execute();

}
$err = curl_error($curl);
}
//exit;
}





 ?>