<?php
include("config.php");
//$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
    // not logged in send to login page
    redirect("index.php");
}
// Check connection

if(isset($_POST['submit']))
{
// Posted Values
$id       =$_POST['id'];
$userid   =$_POST['userid'];
$store_id =$_POST['store_id'];
$reminder =$_POST['reminder'];
$duration =$_POST['duration'];
//mysqli_free_result($result);

if(!empty($id)){
	$query="UPDATE `tbl_reminder` SET `reminder` = '$reminder',`duration` = '$duration' WHERE `id` = '$id'  AND  `store_id`='$store_id'";
	$stmt = $DB->prepare($query);
	$stmt->execute();

}else{
	$query1="INSERT INTO `tbl_reminder` (`store_id`,`reminder`,`duration`) VALUES
	('$store_id','$reminder','$duration')";
	$stmt = $DB->prepare($query1);
	$stmt->execute();
	}
if($stmt==true)
{
	
	header('Location: reminder-setting.php?data=update');
	exit;
}
else
{
header('Location: reminder-setting.php?data=error');
exit;
}
}
 ?>