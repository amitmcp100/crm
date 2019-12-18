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
$feedbacksetting=$_POST['feedbacksetting'];
$store_id  =  $_SESSION['store_id'];

$sql1 = "SELECT *  FROM `tbl_feedbacksetting` WHERE `store_id` = '$store_id'";
$stmt = $DB->prepare($sql1);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
while ($row1 = $stmt->fetch()) {  
$feedback_value=$row1['feedback_value'];

}

if(!empty($feedback_value)){

	$query="UPDATE `tbl_feedbacksetting` SET `feedback_value` = '$feedbacksetting' WHERE `store_id` = '$store_id'";
	$stmt = $DB->prepare($query);
	$stmt->execute();

}
else{
	$query="INSERT INTO `tbl_feedbacksetting` (`id`,`store_id`,`feedback_value`) VALUES
(NULL,'$store_id','$feedbacksetting')";
$stmt = $DB->prepare($query);
$stmt->execute();

}


if($stmt==true)
	{

	header('Location: feedbacksetting.php?data=update');
	exit;
	}
	else
	{
	header('Location: feedbacksetting.php?data=error');
	exit;
	}


}
header('Location: feedbacksetting.php?data=update');
	exit;
 ?>