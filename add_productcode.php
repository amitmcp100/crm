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
// get the image extension
//$extension = substr($imgfile,strlen($imgfile)-4,strlen($imgfile));
// allowed extensions
//$allowed_extensions = array(".jpg","jpeg",".png",".gif");
// Validation for allowed extensions .in_array() function searches an array for a specific value.

//rename the image file
//$imgnewfile=md5($imgfile).$extension;
// Code for move image into directory
//move_uploaded_file($_FILES["image"]["tmp_name"],"users_img/".$imgnewfile);
// Query for insertion data into database
$data = [
    'product' => $_POST['product'],
    'store_id'=> $_SESSION['store_id'],
    'price'   => $_POST['price'],
    'sales_date'    => $date=date("Y-m-d")
    
];
$query1="INSERT INTO `tbl_product` (`store_id`,`product_name`, `price`,`sales_date`) VALUES (:store_id,:product, :price, :sales_date)";
$stmt = $DB->prepare($query1);
$stmt->execute($data);

}

header('Location: view-product.php?data=update');
exit;
 ?>