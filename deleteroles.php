<?php

include("config.php");
//$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection

$id=$_GET['id'];
$store_id = $_SESSION['store_id'];
if(!empty($id))
{
// Posted Values



$query="DELETE FROM `tbl_user_roles` WHERE  `id`='$id' AND `store_id` = '$store_id'";
$stmt = $DB->prepare($query);
$stmt->execute();

if($stmt==true)
{
	
	header('Location: allroles.php?data=update');
	exit;
}
else
{
header('Location: allroles.php?data=error');
exit;
}}

 ?>