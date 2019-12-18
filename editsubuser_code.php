<?php

include("config.php");
//$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection

if(isset($_POST['submit']))
{
// Posted Values

$userid=$_POST['userid'];
$store=$_POST['store_id'];
$username=$_POST['username'];
$pwd=$_POST['pwd1'];
$firstname=$_POST['firstname'];
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
$id=$_POST['id'];

$sql = "SELECT *  FROM `tbl_user_group` WHERE `child_id` = '$userid' and `store_id` = '$store'";
$stmt = $DB->prepare($sql);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
while ($row = $stmt->fetch()) {   

$sender_id=$row['sender_id'];
$parent_id=$row['parent_id'];

}

//mysqli_free_result($result);




$query1="UPDATE `system_users` SET `u_password` = '$pwd',`u_username` = '$username' WHERE `reguser_id` = '$id'");
 $stmt1 = $DB->prepare($query1;
 $stmt1->execute();
                  

$query3="UPDATE tbl_user_data SET first_name = '$firstname',last_name = '$lastname',username = '$username',business_name = '$buss_name',address = '$address',city = '$city',state = '$state',usergroup = '$user_group',email = '$email',website = '$website',contact = '$contact',bio = '$bio',roles_name='$roles' WHERE id ='$id'";

$stmt3 = $DB->prepare($query3);
$stmt3->execute();
                   
if($stmt3==true)
{
	
	header('Location: sub-users.php?data=update');
	exit;
}
else
{
header('Location: sub-users.php?data=error');
exit;
}

}

 ?>