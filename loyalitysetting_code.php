<?php

include("config.php");
//$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection

if(isset($_POST['submit']))
{
// Posted Values

$store_id  = $_SESSION['store_id'];
$status=$_POST['status'];
$loyality_expiry=$_POST['loyality_expiry'];
$min_points=$_POST['min_points'];
$max_points=$_POST['max_points'];
$rupee_value=$_POST['rupee_value'];
$loyality_point_earn=$_POST['loyality_point_earn'];
$t_sale=$_POST['t_sale'];
$loyality_points=$_POST['loyality_points'];


$sql = "SELECT *  FROM `loyality_setting` WHERE `store_id` = '$store_id'";
$stmt = $DB->prepare($sql);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$result = array();
while ($row = $stmt->fetch()) {  
$id=$row['id'];
}

if(!empty($id)){
	
	$query="UPDATE `loyality_setting` SET `status` = '$status',`loyality_expiry` = '$loyality_expiry',`min_points` = '$min_points',`max_points` = '$max_points',`rupee_value` = '$rupee_value',`loyality_points` = '$loyality_points',`loyality_point_earn` = '$loyality_point_earn',`t_sale` = '$t_sale' WHERE `store_id` = '$store_id'";
	$stmt = $DB->prepare($query);
	$stmt->execute();

}
else{
	$query="INSERT INTO `loyality_setting` (`id`, `store_id`, `status`, `loyality_expiry`, `min_points`, `max_points`, `rupee_value`,`loyality_points`, `loyality_point_earn`, `t_sale`) VALUES (NULL,'$store_id', '$status', '$loyality_expiry', '$min_points', '$max_points', '$rupee_value', '$loyality_points','$loyality_point_earn', '$t_sale')";
	$stmt = $DB->prepare($query);
	$stmt->execute();


}


if($query)
{
	
	header('Location: loyalitysetting.php?data=update');
	exit;
}
else
{
header('Location: all-campaign.php?data=error');
exit;
}}

 ?>