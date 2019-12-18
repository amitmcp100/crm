<?php

include("config.php");
//$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection

if(isset($_POST['submit']))
{
// Posted Values
$points=$_POST['usedpoints'];
$can_id=$_POST['canid'];

$availablepoints=$_POST['available_points'];

$sql = "SELECT *  FROM `tbl_loyality` WHERE  `c_id` ='$can_id'";
$stmt = $DB->prepare($sql);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
while ($row = $stmt->fetch()) {
//$result = array();
$pre_usedpoints=$row['used_points'];
}

$total_used_points=$pre_usedpoints+$points;


if($availablepoints>=$points)
{

	$remainning_points=$availablepoints-$points;

	$query2="UPDATE `tbl_loyality` SET `available_points` = '$remainning_points',`used_points`='$total_used_points' WHERE `c_id` = '$can_id'";
	$stmt = $DB->prepare($query2);
	$stmt->execute();

	if($stmt==true)
	{

	header('Location: loyalityview.php?data=update');
	exit;
	}
	else
	{
	header('Location: loyalityview.php?data=error');
	exit;
	}


	}else{
	
	header('Location: loyalityview.php?data=error');
	exit;

}

}

 ?>