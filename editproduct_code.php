<?php
include("config.php");
//$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection

if(isset($_POST['submit']))
{
// Posted Values
$id=$_POST['id'];
$userid=$_POST['user'];
$store_id= $_SESSION['store_id'];
$product=$_POST['product'];
//echo $product;
$price=$_POST['price'];
$date=date("Y-m-d");
 $query="UPDATE `tbl_product` SET   `product_name` = '$product', `sales_date` = '$date',`price`='$price'  WHERE  `id`='$id' and `store_id` ='$store_id'";
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