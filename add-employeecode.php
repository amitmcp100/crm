<?php

require_once("config.php");
if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
    // not logged in send to login page
    redirect("index.php");
}
$store_id = $_SESSION['store_id'];

if(isset($_POST['submit']))
{
// Posted Values
$imgtitle=$_POST['imagetitle'];
$imgfile=$_FILES["image"]["name"];
$create_date=date("Y-m-d");
$name=$_POST['name'];
$des=$_POST['des'];
$checkBox=$_POST['timeslot'];
echo $employee_id = $_POST['employee_id'];
$userid=$_POST['userid'];
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
if($employee_id==''){
$query1="INSERT INTO `tbl_employee` (`id`, `store_id`, `name`, `designation`, `pic`, `e_date`) VALUES (NULL, '$store_id', '$name', '$des', '$imgnewfile', '$create_date')";
$stmt = $DB->prepare($query1);
$stmt->execute();
$lastid = $DB->lastInsertId();     

for ($i=0; $i<sizeof($checkBox); $i++)
{
$query12="INSERT INTO `tbl_timeslot` (`id`, `store_id`, `time_slot`,`emp_id`) VALUES (NULL,'$store_id','$checkBox[$i]','$lastid')";
$stmt = $DB->prepare($query12);
        $stmt->execute();

}
}else{
    echo $query13="DELETE   FROM `tbl_timeslot`  WHERE `emp_id` = '$employee_id' and  `store_id` = '$store_id'";
	$stmt = $DB->prepare($query13);
    $stmt->execute();

     

for ($i=0; $i<sizeof($checkBox); $i++)
{
$query12="INSERT INTO `tbl_timeslot` (`id`, `store_id`, `time_slot`,`emp_id`) VALUES (NULL,'$store_id','$checkBox[$i]','$employee_id')";
$stmt = $DB->prepare($query12);
        $stmt->execute();

}
}
}
header('Location: employee-view.php?data=update');
	exit;
 ?>