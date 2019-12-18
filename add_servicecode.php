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
$imgtitle=$_POST['imagetitle'];
$imgfile=$_FILES["image"]["name"];
$userid=$_POST['user'];

$store_id = $_SESSION['store_id'];
$service = addslashes($_POST['service']);
$date=date("Y-m-d");
$price=$_POST['price'];
$userid = $_SESSION["user_id"];
// get the image extension
$extension = substr($imgfile,strlen($imgfile)-4,strlen($imgfile));
// allowed extensions
$allowed_extensions = array(".jpg","jpeg",".png",".gif");
// Validation for allowed extensions .in_array() function searches an array for a specific value.

//rename the image file
$imgnewfile=md5($imgfile).$extension;
// Code for move image into directory
move_uploaded_file($_FILES["image"]["tmp_name"],"users_img/".$imgnewfile);
// Query for insertion data into database

$query1="INSERT INTO `tbl_services` (`id`,`store_id`,`service_name`,`added_date`,`modi_date`, `price`, `pic`) VALUES (NULL,'$store_id','$service', '$date', '$date','$price', '$imgnewfile')";
$stmt = $DB->prepare($query1);
$stmt->execute();
}

header('Location: all-services.php?data=update');
exit;
 ?>