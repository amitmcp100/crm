<?php

include("config.php");
//$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection


$id=$_GET['id'];
$store_id = $_SESSION['store_id']; 
if(!empty($id))
{
// Posted Values



$query="DELETE FROM `tbl_appoinment` WHERE  `id`='$id' and `store_id` = '$store_id'";
$stmt = $DB->prepare($query);
$stmt->execute();

if($stmt==true)
{
	
	header('Location: view-appoinment.php?data=update');
	exit;
}
else
{
header('Location: view-appoinment.php?data=error');
exit;
}
}

 ?>