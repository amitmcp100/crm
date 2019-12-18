<?php

 include("config.php");
//$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection

if(isset($_POST['submit']))
{
// Posted Values
$imgtitle=$_POST['imagetitle'];
$imgfile=$_FILES["image"]["name"];

$userid   = $_POST['userid'];
$store_id = $_SESSION['store_id']; 
// get the image extension
$extension = substr($imgfile,strlen($imgfile)-4,strlen($imgfile));
// allowed extensions
$allowed_extensions = array(".jpg","jpeg",".png",".gif");
// Validation for allowed extensions .in_array() function searches an array for a specific value.
if(!in_array($extension,$allowed_extensions))
{
echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
}
else
{
//rename the image file
$imgnewfile=md5($imgfile).$extension;
// Code for move image into directory
move_uploaded_file($_FILES["image"]["tmp_name"],"users_img/".$imgnewfile);

// Query for insertion data into database
$query1 = "UPDATE tbl_store SET logo = '$imgnewfile'  WHERE `store_id` = '$store_id'";
$stmt   =  $DB->prepare($query1);
$stmt->execute();


$query="UPDATE tbl_user_data SET logo = '$imgnewfile' WHERE userid ='$userid' AND  `store_id` = '$store_id'";
$stmt = $DB->prepare($query);
$stmt->execute();
if($stmt==true)
{
	
	header('Location: profile.php?data=update');
	exit;
}
else
{
header('Location: profile.php?data=error');
exit;
}}
}
 ?>