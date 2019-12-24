<?php
include("config.php");

if(isset($_POST['submit']))
{
// Posted Values
$id       = $_POST['id'];
$userid   = $_POST['userid'];
$store_id = $_SESSION['store_id'];
$senderid = $_POST['senderid'];
//$duration = $_POST['duration'];
//mysqli_free_result($result);
//echo $id;
//echo $store_id;die;
$sql = "SELECT  count(*) as cntstore   FROM `smstemplates` WHERE `store_id` = '$store_id'";
$stmt = $DB->prepare($sql);
$stmt->execute();
$rows =$stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows = $stmt->fetch();
 $storeCunt = $rows['cntstore'];

if(!empty($id)){
	$query="UPDATE `tbl_user_group` SET `sender_id` = '$senderid' WHERE `id` = '$id' AND `store_id` = '$store_id'";
	$stmt = $DB->prepare($query);
	$stmt->execute();
 if( $storeCunt <= 0){
	$sql = "INSERT INTO `smstemplates` (`store_id`,`message_type`,`message`) VALUES
	('$store_id','Add Customer','Dear customer_name , Thanks for visiting at retailer_name ,we value your visit Have a Great Day Ahead Thanks'),
	('$store_id','Enquiry','Dear customer_name , Dear customer_name , Thanks for Inquiring at retailer_name , we look forward to you Contact retailer_number Thanks'),
	('$store_id','Loyality','Dear customer_name ,Dear customer_name , Thanks for Inquiring at retailer_name , we look forward to you Thank'),
	('$store_id','Birthday','Dear customer_name , We vish you a very Happy Birthday from retailer_name Team Thanks'),
	('$store_id','Anniversary','Dear customer_name, we wish you a very Happy Anniversary. Best regards from retailer_name  !!!'),
	('$store_id','Lost','Dear customer_name , Thanks for Inquiring at retailer_name , we look forward to you Contact Us Thanks')
	";
	$stmt = $DB->prepare($sql);
	$stmt->execute();
  }
}else{
	$query1="INSERT INTO `tbl_user_group` (`store_id`,`sender_id`) VALUES
	('$store_id','$senderid')";
	$stmt = $DB->prepare($query1);
	$stmt->execute();

	}

if($stmt==true)
{
	
	header('Location: senderid.php?data=update');
	exit;
}
else
{
	header('Location: senderid.php?data=error');
	exit;
}
}
 ?>