<?php
include("config.php");

if(isset($_POST['submit']))
{
// Posted Values
$id       = $_POST['id'];
$userid   = $_POST['userid'];
$store_id = $_SESSION['store_id'];
$reminder = $_POST['reminder'];
$duration = $_POST['duration'];
//mysqli_free_result($result);
//echo $id;
//echo $store_id;die;
if(!empty($id)){
	$query="UPDATE `tbl_regain` SET `reminder` = '$reminder',`duration` = '$duration' WHERE `id` = '$id' AND `store_id` = '$store_id'";
	$stmt = $DB->prepare($query);
	$stmt->execute();

}else{
	$query1="INSERT INTO `tbl_regain` (`store_id`,`reminder`,`duration`) VALUES
	('$store_id','$reminder','$duration')";
	$stmt = $DB->prepare($query1);
	$stmt->execute();
	}

if($stmt==true)
{
	
	header('Location: regain_setting.php?data=update');
	exit;
}
else
{
	header('Location: regain_setting.php?data=error');
	exit;
}
}
 ?>