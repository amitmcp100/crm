<?php

include("config.php");

// Check connection

if(isset($_POST['submit']))
{
// Posted Values
$id       = $_POST['id'];
$store_id = $_SESSION['store_id'];

$query="DELETE FROM `tbl_product` WHERE `id`='$id' and `store_id` = '$store_id'";
$stmt = $DB->prepare($query);
$stmt->execute();

if($stmt==true)
{
	
	header('Location: view-product.php?data=update');
	exit;
}
else
{
header('Location: view-product.php?data=error');
exit;
}}

 ?>