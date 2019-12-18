<?php

 include("config.php");
//$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection
if(isset($_POST['submit']))
{
// Posted Values
$id=$_POST['id'];
$userid=$_POST['userid'];
$name=$_POST['name'];
$description=$_POST['description'];
$status=$_POST['status'];
$store=$_POST['store_id'];




$query="UPDATE tbl_customer_group SET name = '$name',description = '$description',status = '$status' WHERE `store` = '$store'  and `id` = '$id'";
$stmt = $DB->prepare($query);
$stmt->execute();
if($stmt==true)
{
	
	header('Location: customer-group.php?data=update');
	exit;
}
else
{
header('Location: customer-group.php?data=error');
exit;
}}

 ?>