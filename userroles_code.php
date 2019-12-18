<?php

 include("config.php");
//$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection
//print_r($_POST);
//exit;

if(isset($_POST['submit']))
{
// Posted Values
$id=$_POST['id'];
$userid=$_POST['user'];
$role_name=$_POST['role_name'];
$customer=$_POST['customer'];
$add_customer=$_POST['add_customer'];
$add_campaign=$_POST['add_campaign'];
$all_campaign=$_POST['all_campaign'];
$sub_users=$_POST['sub_users'];
$birthday=$_POST['birthday'];
$anniversary=$_POST['anniversary'];
$feedback=$_POST['feedback'];
$loyality=$_POST['loyality'];
$lost_business=$_POST['lost_business'];
$package=$_POST['package'];
$create_date=date("Y-m-d");
$store_id = $_SESSION['store_id'];


$sql1 = "SELECT *  FROM `tbl_feedbacksetting` WHERE `store_id` = '$store_id'";
$stmt = $DB->prepare($sql1);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
while ($row1 = $stmt->fetch()) { 

$feedback_value=$row1['feedback_value'];

}


$query="INSERT INTO `tbl_user_roles` (`id`,`store_id`,`role_name`, `customer`, `add_customer`, `add_campaign`, `all_campaign`, `all_sub_user`, `birthday`, `anniversary`, `feedback`, `loyality`, `lost_business`, `packages`, `user_id`,`create_date`, `status`) VALUES (NULL,'$store_id','$role_name','$customer', '$add_customer', '$add_campaign', '$all_campaign', '$sub_users', '$birthday', '$anniversary', '$feedback', '$loyality', '$lost_business', '$package', '$userid','$create_date', 'enabled')";

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
	}


}

 ?>