<?php

include("config.php");
//$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection

if(isset($_POST['submit']))
{
// Posted Values
$id=$_POST['id'];
$userid=$_POST['userid'];
$store_id = $_SESSION['store_id'];
$campaigns_category=$_POST['campaigns_category'];
$campaign_name=$_POST['campaign_name'];
$c_group=$_POST['c_group'];
$category=$_POST['category'];
$beforedays=$_POST['beforedays'];
$datetime=$_POST['datetime'];
$sms_text=$_POST['sms_text'];
$status=$_POST['status'];
$create_date=date("Y-m-d");

$query="UPDATE `tbl_campaign` SET `campaign_category` = '$campaigns_category',`campaign_name` = '$campaign_name',`campaign_sms` = '$sms_text',`customer_category` = '$category',`customer_group` = '$c_group',`campaign_before` = '$beforedays',`date_time` = '$datetime',`status` = '$status' WHERE `id` = '$id' and `store_id` = '$store_id'";
$stmt = $DB->prepare($query);
$stmt->execute();
                                                   
if($stmt==true)
{
	
	header('Location: all-campaign.php?data=update');
	exit;
}
else
{
header('Location: all-campaign.php?data=error');
exit;
}}

 ?>