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

$sql2 = "SELECT *  FROM `tbl_user_group` WHERE `store_id` = '$store_id'";
$stmt = $DB->prepare($sql2);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
while ($row2 = $stmt->fetch()) { 
//echo $sql2;
$sender_id=$row2['sender_id'];
}


if($available_sms>'1'){
$sql3 = "SELECT *  FROM `tbl_campaign` WHERE `id` = '$id' and `store_id` = '$store_id'";
$stmt = $DB->prepare($sql3);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$result = array();
while ($row3 = $stmt->fetch()) { 
$customer_group=$row3['customer_group'];
$campaign_sms=$row3['campaign_sms'];
}

if(!empty($customer_group)){
$sql4 = "SELECT *  FROM `tbl_customer_data` WHERE `store_id` = '$store_id' and `customer_group` = '$customer_group'";
//echo $sql4;
$stmt = $DB->prepare($sql4);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$result = array();
while ($row4 = $stmt->fetch()) { 
$mobile[]=$row4['mobile'];
}

}else{
$sql4 = "SELECT *  FROM `tbl_customer_data`  WHERE `store_id` = '$store_id' ";
//echo $sql4;
$stmt = $DB->prepare($sql4);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$result = array();
while ($row4 = $stmt->fetch()) { 
$mobile[]=$row4['mobile'];
}
}

$count_mobile=count($mobile);
$mobile = implode(",",$mobile);
$sms_text = $campaign_sms;
include("sms_code.php");

if($response=='sms sent successfully'){
	$update_sms=$available_sms-$count_mobile;
	$u_sms=$used_sms+$count_mobile;
	$query="UPDATE `creditsms` SET `used_sms` = '$u_sms',`available_sms` = '$update_sms' WHERE `store_id` = '$store_id'";
	$stmt = $DB->prepare($query);
	$stmt->execute();


	$query011="INSERT INTO `sms_report` (`id`, `store_id`, `message`,`mobile`,`from_date`, `to_date`, `state`,`operator`, `status`, `send`,`update_on`) VALUES (NULL,'$store_id','$campaign_sms','$mobiles','$create_date','$create_date', '1','operator','active','yes','on')";
	$stmt = $DB->prepare($query011);
	$stmt->execute();
	
	if($stmt==true)
	{

	header('Location: all-campaign.php?data=update');
	exit;
	}
	else
	{
	header('Location: all-campaign.php?data=error');
	exit;
	}
}else{
	header('Location: all-campaign.php?data=error');
	exit;
}
$err = curl_error($curl);

//exit;
}





 ?>