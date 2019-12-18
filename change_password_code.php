<?php

include("config.php");
//$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection

//print_r($_POST);
if(isset($_POST['submit']))
{
// Posted Values

$userid=$_POST['userid'];
$pwd=$_POST['pwd1'];

$query="UPDATE `system_users` SET `u_password` = '$pwd' WHERE `system_users`.`u_userid` = '$userid'";
$stmt = $DB->prepare($query);
$stmt->execute();
if($stmt==true)
{
	
	header('Location: profile.php?data=update');
	exit;
}
else
{
header('Location: profile.php?data=error');
exit;
}}

 ?>