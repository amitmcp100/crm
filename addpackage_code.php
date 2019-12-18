<?php

include("config.php");
//$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection
if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
    // not logged in send to login page
    redirect("index.php");
}
if(isset($_POST['submit']))
{
// Posted Values

$userid=$_POST['userid'];
$store_id = $_SESSION['store_id'];
$package_name=$_POST['package_name'];
$package_price=$_POST['package_price'];
$package_expiry=$_POST['package_expiry'];
$package_days=$_POST['package_days'];
$services=$_POST['car'];
$package_qty=$_POST['package_qty'];
$create_date=date("Y-m-d");
$service_date = serialize( $services );
$query="INSERT INTO `tbl_package` (`id`,`store_id`,`package_name`, `package_price`, `package_expiry`, `package_days`, `create_date`, `services`) VALUES (NULL,'$store_id','$package_name', '$package_price', '$package_expiry', '$package_days', '$create_date','$service_date')";

$stmt = $DB->prepare($query);
$stmt->execute();
if($stmt==true)

	{

	header('Location: all-packages.php?data=update');
	exit;
	}
	else
	{
	header('Location: all-packages.php?data=error');
	exit;
	}
}

 ?>