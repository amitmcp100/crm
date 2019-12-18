<?php

 include("config.php");
//$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection

if(isset($_POST['submit']))
{
// Posted Values

$userid=$_POST['user'];
$store=$_POST['store'];
$otpid=$_POST['otpid'];
$otp=$_POST['otp'];

$sql2 = "SELECT *  FROM `tbl_package_otp` WHERE `id` = '$otpid'";
$stmt = $DB->prepare($sql2);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
while ($row2 = $stmt->fetch()) { 
$realotp=$row2['otp'];
$mobile=$row2['mobile'];

}

if($realotp==$otp){
$query="UPDATE `tbl_package_otp` SET `status` = 'yes' WHERE `id` = '$otpid'";
$stmt = $DB->prepare($query);
$stmt->execute();
if($stmt==true)
{

header('Location: redeempackage.php?mobile='.$mobile);
exit;
}
else
{
	header('Location: redeempack_verify.php?data=error&id='.$otpid);
exit;
}


}else{
	header('Location: redeempack_verify.php?data=error&id='.$otpid);
exit;
}}

 ?>