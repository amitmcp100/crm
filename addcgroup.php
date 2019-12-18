<?php

include("config.php");
//$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
    // not logged in send to login page
    redirect("index.php");
}
// Check connection

if(isset($_POST['submit']))
{
// Posted Values

$userid=$_POST['userid'];
$name=$_POST['name'];
$description=$_POST['description'];
$status=$_POST['status'];
$store_id =$_POST['store_id'];


$query="INSERT INTO `tbl_customer_group` (`id`, `store_id`, `name`, `description`, `status`, `userid`) VALUES (NULL,'$store_id','$name', '$description', '$status', '$userid')";
$stmt = $DB->prepare($query);
$stmt->execute();
if($stmt==true)
{
	
	header('Location: addgroup.php?data=update');
	exit;
}
else
{
header('Location: addgroup.php?data=error');
exit;
}}

 ?>