<?php

 include("config.php");
//$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection


// Posted Values
$id=$_GET['id'];

$store_id = $_SESSION['store_id'];

$query="UPDATE `tbl_feedback` SET `read` = 'yes' WHERE  `id` = '$id'  AND  `store_id`='$store_id'";
$stmt = $DB->prepare($query);
$stmt->execute();
if($stmt==true)
{
	
	header('Location: feedback.php?data=update');
	exit;
}
else
{
header('Location: feedback.php?data=error');
exit;
}

 ?>