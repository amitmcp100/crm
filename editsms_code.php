<?php

include("config.php");
//$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection
//print_r($_POST);

if(isset($_POST['submit']))
{
// Posted Values
$id=$_POST['id'];
$userid=$_POST['user'];
$sms_text=$_POST['sms_text'];
$store_id = $_SESSION['store_id'];

$sql1 = "SELECT *  FROM `smstemplates` WHERE  `id` = '$id' AND `store_id` = '$store_id'";
$stmt = $DB->prepare($sql1);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
while ($row1 = $stmt->fetch()) {
$message_type=$row1['message_type'];

}

$sql2 = "SELECT *  FROM `smstemplates` WHERE  `message_type` = '$message_type' AND `store_id` = '$store_id'";
$stmt = $DB->prepare($sql2);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
while ($row2 = $stmt->fetch()) {

$message_type2=$row2['message_type'];

}


if(!empty($message_type2)){

$query="UPDATE `smstemplates` SET `message` = '$sms_text' WHERE  `message_type` = '$message_type' AND 'store_id' = '$store_id'";


$stmt = $DB->prepare($query);
$stmt->execute();
                                                           
}
else{
	$query="INSERT INTO `smstemplates` (`id`,`store_id`,`message_type`, `message`) VALUES
(NULL,'$store_id','$message_type', '$sms_text')";
$stmt = $DB->prepare($query);
$stmt->execute();
                                                           
}


if($stmt==true)
	{

	header('Location: settingsms.php?data=update');
	exit;
	}
	else
	{
	header('Location: settingsms.php?data=error');
	exit;
	}


}

 ?>