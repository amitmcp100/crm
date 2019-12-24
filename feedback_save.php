<?php

include("config.php");
//$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection

if(isset($_POST['submit']))
{
// Posted Values

$mobile=$_POST['mobile'];
$name=$_POST['name'];
$store_id =$_POST['store_id'];
$str=$_POST['service'];
$mode=$_POST['mode'];
//$str=implode(',', $service);

$anniversary=$_POST['anniversary'];
$dob=$_POST['dob'];

$comment=$_POST['comment'];

$create_date=date("Y-m-d");
//echo "<pre>";print_r($_POST);exit;
$query4="INSERT INTO `tbl_feedback` (`id`,`store_id`,`mobile`, `name`, `mode`, `service`, `anniversary`, `dob`, `comment`, `date`, `read`) VALUES (NULL,'$store_id','$mobile', '$name', '$mode', '$str', '', '', '$comment', '$create_date','no')";
$stmt = $DB->prepare($query4);
$stmt->execute();
	header("Location: cus_feed.php?data=update");
	exit;
}

 ?>