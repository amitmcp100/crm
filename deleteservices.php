<?php

include("config.php");
//$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection

if(isset($_POST['submit']))
{
// Posted Values
$id=$_POST['id'];
$store_id = $_SESSION['store_id'];
$query="DELETE FROM `tbl_services` WHERE `id`='$id' AND `store_id` = '$store_id'";
$stmt = $DB->prepare($query);
$stmt->execute();

if($stmt==true)
{
	
	header('Location: all-services.php?data=update');
	exit;
}
else
{
header('Location: all-services.php?data=error');
exit;
}}

 ?>