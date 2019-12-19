<?php

include("config.php");
//$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
//     // not logged in send to login page
//     redirect("index.php");
// }
if(isset($_POST['submit']))
{
	
// Posted Values

$username  = $_POST['username'];
$pwd       = $_POST['pwd1'];
$firstname = $_POST['name'];
$lastname  = "";
$email     = $_POST['email'];
$contact    = $_POST['mobile'];
$user_password = $_POST['user_password'];
$roles= "superadmin";
$create_date=date("Y-m-d");


if($username == ""  ||  $email == ""  ||  $contact == "" || $firstname == ""){
$_SESSION["errorType"] = "danger";
$_SESSION["errorMsg"] = "All fields are mandatory";
header('Location: register.php?data=error');
 exit;
}
// $sql = "SELECT *  FROM `tbl_user_group` WHERE `child_id` = '$userid' and `store_id` = '$store_id'";
// $stmt = $DB->prepare($sql);
// $stmt->execute();
// $stmt->setFetchMode(PDO::FETCH_ASSOC);
// while ($row = $stmt->fetch()) { 
// $sender_id=$row['sender_id'];
// //$parent_id=$row['parent_id'];
// }            
$parent_id = 0;
//mysqli_free_result($result);

$sqlstore = "INSERT INTO `tbl_store` (`store_name`,`email`, `contact`, `create_date`) VALUES
('$firstname','$email', '$contact','$create_date');";
$stmt = $DB->prepare($sqlstore);
$stmt->execute();
$store_id = $DB->lastInsertId();


$sql = "INSERT INTO `tbl_user_data` (`store_id`,`first_name`, `last_name`, `username`,`password`,`business_name`,  `email`,  `contact`,`roles_name`,`parent_id`,`create_date`) VALUES
('$store_id','$firstname', '$lastname', '$username','$user_password','$firstname', '$email', '$contact','$roles','0','$create_date')";
$stmt = $DB->prepare($sql);
$stmt->execute();
$last_id = $DB->lastInsertId();
echo "New record created successfully. Last inserted ID is: " . $last_id;


$query1="INSERT INTO `system_users` (`u_userid`,`store_id`,`u_username`, `u_password`, `u_rolecode`, `reguser_id`) VALUES
(NULL,'$store_id','$username', '$password', 'superadmin','$last_id');";
$stmt = $DB->prepare($query1);
$stmt->execute();


//test it out!
$new_url = 'https://tinyurl.com/y6ql3sen';

//returns http://tinyurl.com/65gqpp
echo $new_url;


echo $query3="INSERT INTO `tbl_user_group` (`id`,`store_id`,`parent_id`, `child_id`, `sender_id`,`tiny_url`) VALUES
(NULL,'$store_id','0', '$last_id','$firstname','$new_url');";
$stmt = $DB->prepare($query3);
$stmt->execute();
//exit;
/*
$query2=mysqli_query($con,"INSERT INTO `tbl_user_data` (`id`, `first_name`, `last_name`, `username`, `business_name`, `address`, `city`, `state`, `logo`, `usergroup`, `email`, `website`, `contact`, `bio`, `parent_id`, `store`, `userid`, `roles_name`) VALUES
(NULL, '$firstname', '$lastname', '$username', '$buss_name', '$address', '$city', '$state', '', '$user_group', '$email', '$website', '$contact', '$bio', '$userid', '$store', '1', '$roles');");
*/

if($stmt==true)
{
	$_SESSION["errorType"] = "success";
	$_SESSION["errorMsg"]  =  "Register successfully login with your username and password";
	header('Location: index.php?data=success');
	exit;
}
else
{
header('Location: register.php?data=error');
exit;
}



///end submit condition
}
 ?>