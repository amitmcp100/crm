<?php

include("config.php");
//$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection

$store_id = $_SESSION['store_id'];

$id=$_GET['id'];
if(!empty($id))
{
// Posted Values

$query="DELETE FROM `tbl_employee` WHERE  `id`='$id'  and  `store_id` = '$store_id'";

$stmt = $DB->prepare($query);
$stmt->execute();

if($stmt==true)
{
	
	header('Location: employee-view.php?data=update');
	exit;
}
else
{
header('Location: employee-view.php?data=error');
exit;
}}

 ?>