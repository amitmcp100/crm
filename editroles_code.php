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
$id=$_POST['id'];
$store_id = $store_id['store_id'];

$sql1 = "SELECT *  FROM `tbl_feedbacksetting` WHERE `store_id` = '$store_id' ";
$stmt = $DB->prepare($sql1);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
while ($row1 = $stmt->fetch()) {

$feedback_value=$row1['feedback_value'];

}



$query="UPDATE `tbl_user_roles` SET `role_name` = '$role_name',`customer` = '$customer',`add_customer` = '$add_customer',`add_campaign` = '$add_campaign',`all_campaign` = '$all_campaign',`all_sub_user` = '$sub_users',`birthday` = '$birthday',`anniversary` = '$anniversary',`feedback` = '$feedback',`loyality` = '$loyality',`lost_business` = '$lost_business',`packages` = '$package' WHERE `id` = '$id' and `store_id` = '$store_id'";
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