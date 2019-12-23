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
if(!empty($id)){
	$query="UPDATE `tbl_user_group` SET `sender_id` = '$senderid' WHERE `id` = '$id' AND `store_id` = '$store_id'";
	$stmt = $DB->prepare($query);
	$stmt->execute();

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