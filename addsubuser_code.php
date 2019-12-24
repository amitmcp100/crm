<?php

include("config.php");
//$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
    // not logged in send to login page
    redirect("index.php");
}
if(isset($_POST['submit']))
{
// Posted Values
$store_id = $_SESSION['store_id'];
$userid   = $_POST['userid'];
$username = $_POST['username'];
$pwd      = $_POST['pwd1'];
$firstname= $_POST['firstname'];
$lastname=$_POST['lastname'];
$buss_name=$_POST['buss_name'];
$address=$_POST['address'];
$city=$_POST['city'];
$state=$_POST['state'];
$user_group=$_POST['user_group'];
$email=$_POST['email'];
$website=$_POST['website'];
$contact=$_POST['contact'];
$bio=$_POST['bio'];
$roles=$_POST['roles'];
$create_date=date("Y-m-d");


$sql = "SELECT *  FROM `tbl_user_group` WHERE `child_id` = '$userid' and `store_id` = '$store_id'";
$stmt = $DB->prepare($sql);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
while ($row = $stmt->fetch()) { 
$sender_id=$row['sender_id'];
//$parent_id=$row['parent_id'];

}
              
$parent_id = $_SESSION['user_id'];
//mysqli_free_result($result);
}

$sql = "INSERT INTO `tbl_user_data` (`id`,`store_id`,`first_name`, `last_name`, `username`,`password`,`business_name`, `address`, `city`, `state`, `logo`, `usergroup`, `email`, `website`, `contact`, `bio`, `parent_id`,`userid`, `roles_name`, `create_date`) VALUES
(NULL,'$store_id','$firstname', '$lastname', '$username','$pwd','$buss_name', '$address', '$city', '$state', '', '$user_group', '$email', '$website', '$contact', '$bio', '$parent_id','1', '$roles','$create_date')";
$stmt = $DB->prepare($sql);
$stmt->execute();
$last_id = $DB->lastInsertId();

    echo "New record created successfully. Last inserted ID is: " . $last_id;


$query1="INSERT INTO `system_users` (`u_userid`,`store_id`,`u_username`, `u_password`, `u_rolecode`, `reguser_id`) VALUES
(NULL,'$store_id','$username', '$pwd', 'ADMIN','$last_id');";
$stmt = $DB->prepare($query1);
$stmt->execute();


//test it out!
$new_url = 'https://tinyurl.com/y6ql3sen';

//returns http://tinyurl.com/65gqpp
echo $new_url;


echo $query3="INSERT INTO `tbl_user_group` (`id`,`store_id`,`parent_id`, `child_id`, `sender_id`,`tiny_url`) VALUES
(NULL,'$store_id','$parent_id', '$last_id','$sender_id','$new_url');";
$stmt = $DB->prepare($query3);
$stmt->execute();
//exit;
/*
$query2=mysqli_query($con,"INSERT INTO `tbl_user_data` (`id`, `first_name`, `last_name`, `username`, `business_name`, `address`, `city`, `state`, `logo`, `usergroup`, `email`, `website`, `contact`, `bio`, `parent_id`, `store`, `userid`, `roles_name`) VALUES
(NULL, '$firstname', '$lastname', '$username', '$buss_name', '$address', '$city', '$state', '', '$user_group', '$email', '$website', '$contact', '$bio', '$userid', '$store', '1', '$roles');");
*/

if($stmt==true)
{
	
	header('Location: sub-users.php?data=update');
	exit;
}
else
{
header('Location: sub-users.php?data=error');
exit;
}

 ?>