<?php
include("config.php");
//$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection

if(isset($_POST['submit']))
{
// Posted Values
$id=$_POST['id'];
$store= $_SESSION['store_id'];
$mobile=$_POST['mobile'];
$name=$_POST['name'];
$email=$_POST['email'];
$address=$_POST['address'];
$anniversary=$_POST['anniversary'];
$dob=$_POST['dob'];
//$amount=$_POST['amount'];
$c_group=$_POST['c_group'];
$comment=$_POST['comment'];
$reminder=$_POST['reminder'];



$query="UPDATE `tbl_customer_data` SET `mobile` = '$mobile',`name` = '$name', `email` = '$email',`anniversary` = '$anniversary',`dob` = '$dob',`customer_group` = '$c_group',`comment` = '$comment',`reminder` = '$reminder',`reminder` = '$reminder',`address` = '$address' WHERE `id` = '$id' and `store_id` = '$store_id'";
$stmt = $DB->prepare($query);
$stmt->execute();
if($stmt==true)
{
	
	header('Location: customer-view.php?data=update');
	exit;
}
else
{
header('Location: customer-view.php?data=error');
exit;
}}

 ?>