<?php

include("config.php");
//$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection

if(isset($_POST['submit']))
{
// Posted Values

$userid=$_POST['userid'];
$firstname=$_POST['firstname'];
$lastname=$_POST['lastname'];
$buss_name=$_POST['buss_name'];
$address=$_POST['address'];
$city=$_POST['city'];
$state=$_POST['state'];
$user_group=$_POST['user_group'];
$email=$_POST['email'];
$website=$_POST['website'];
$contact=$_POST['contact'];
$bio=$_POST['bio'];

$store_id = $_SESSION['store_id'];
$query="UPDATE tbl_user_data SET first_name = '$firstname',last_name = '$lastname',business_name = '$buss_name',address = '$address',city = '$city',state = '$state',usergroup = '$user_group',email = '$email',website = '$website',contact = '$contact',bio = '$bio' WHERE userid ='$userid' AND `store_id` ='$store_id'";
$stmt = $DB->prepare($query);
$stmt->execute(); 
if($query)
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