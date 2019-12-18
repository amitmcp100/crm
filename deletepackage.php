<?php
include("config.php");
//$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection
$id=$_GET['id'];
$store_id = $_SESSION['store_id'];
if(!empty($id))
{
// Posted Values
$query="DELETE FROM `tbl_package` WHERE  `id`='$id' AND `store_id` = '$store_id'";
$stmt = $DB->prepare($query);
$stmt->execute();

if($stmt==true)
{
	
	header('Location: all-packages.php?data=update');
	exit;
}
else
{
header('Location: all-packages.php?data=error');
exit;
}}

 ?>