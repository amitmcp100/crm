<?php

include("config.php");
//$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection

$id=$_GET['id'];
if(!empty($id))
{
// Posted Values



$query1="DELETE FROM `tbl_user_data` WHERE  `id`='$id'";
$stmt1 = $DB->prepare($query1);
$stmt1->execute();

$query2="DELETE FROM `system_users` WHERE  `reguser_id`='$id'";
$stmt2 = $DB->prepare($query2);
$stmt2->execute();

$query3="DELETE FROM `tbl_user_group` WHERE  `child_id`='$id'";
$stmt3 = $DB->prepare($query3);
$stmt3->execute();

if($stmt3==true)
{
	
	header('Location: sub-users.php?data=update');
	exit;
}
else
{
header('Location: sub-users.php?data=error');
exit;
}}

 ?>