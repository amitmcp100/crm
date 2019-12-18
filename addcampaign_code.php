<?php

include("config.php");
//$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection

if(isset($_POST['submit']))
{
// Posted Values

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


$query="INSERT INTO `tbl_campaign` (`id`, `store_id`, `campaign_category`, `campaign_name`, `campaign_sms`, `customer_category`, `customer_group`,`campaign_before`,`date_time`,`userid`,`create_date`,`last_run_date`, `status`) VALUES
(NULL, '$store_id', '$campaigns_category', '$campaign_name', '$sms_text', '$category', '$c_group', '$beforedays', '$datetime','$userid', '$create_date', '0000-00-00','$status')";
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