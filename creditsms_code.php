<?php

include("config.php");
//$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection
if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
    // not logged in send to login page
    redirect("index.php");
}
if(isset($_POST['submit']))
{
// Posted Values

$userid=$_POST['userid'];
$store_id = $_SESSION['store_id'];
$sms_credit = $_POST['sms'];

$sql = "SELECT *  FROM `creditsms` WHERE  `store_id` ='$store_id'";
$stmt = $DB->prepare($sql);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
while ($row = $stmt->fetch()) {
//$result = array();
$total_sms=$row['total_sms_purchased'];
$available_sms=$row['available_sms'];
$smsid = $row['id'];
}
$total = $sms_credit+$total_sms;
$available = $available_sms+$sms_credit;

if($smsid)
{
    $sql22 = "UPDATE `creditsms` SET `total_sms_purchased` = '$total',`available_sms`='$available' WHERE `store_id` = '$store_id'";
    $stmt = $DB->prepare($sql22);
	$stmt->execute();
    
}else{

    $query="INSERT INTO `creditsms` (`id`,`store_id`,`total_sms_purchased`, `available_sms`, `used_sms`, `buy_sms_credit`) VALUES (NULL,'$store_id','$sms_credit', '$sms_credit','0','$sms_credit')";
    $stmt = $DB->prepare($query);
    $stmt->execute();
}




if($stmt==true)

	{

	header('Location: all-packages.php?data=update');
	exit;
	}
	else
	{
	header('Location: all-packages.php?data=error');
	exit;
	}
}

 ?>