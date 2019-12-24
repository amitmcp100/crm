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
$sendsms=$_POST['sms'];
$userid= $_SESSION["user_id"];
$store_id=  $_SESSION['store_id'];
$mobile=$_POST['mobile'];
$paymentmode=$_POST['mode'];
$name=$_POST['name'];
$email=$_POST['email'];
$address=$_POST['address'];
$anniversary=$_POST['anniversary'];
$dob=$_POST['dob'];
$employee=$_POST['employee'];
$c_source=$_POST['c_source'];
$amount=$_POST['amount'];
$service=$_POST['service'];
$product=$_POST['product'];
$c_group=$_POST['c_group'];
$comment=$_POST['comment'];
$reminder=$_POST['reminder'];
$create_date=date("Y-m-d");

$sql99="SELECT *  FROM `loyality_setting` where `store_id` = '$store_id'";
$stmt = $DB->prepare($sql99);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
while ($row99 = $stmt->fetch()) {
$result = array();
$points=$row99['loyality_points'];
}
$available_point=(($amount)/($points));

$sql = "SELECT *  FROM `tbl_customer_data` WHERE  mobile='$mobile' and store_id ='$store_id'";
$stmt = $DB->prepare($sql);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
while ($row = $stmt->fetch()) {
$result = array();
$c_id=$row['id'];
}

if($c_id){


	$query29="UPDATE `tbl_customer_data` SET `mobile` = '$mobile',`name` = '$name',`email` = '$email',`anniversary` = '$anniversary',`dob` = '$dob',`employee`='$employee',`amount`='$amount',`customer_group` = '$c_group',`comment`='$comment',`reminder`='$reminder',`address`='$address',`c_source`='$c_source',`c_date`='$create_date' WHERE `id` = '$c_id' and store_id ='$store_id'";
	$stmt = $DB->prepare($query29);
	$stmt->execute();

	
	$query37="INSERT INTO `tbl_sales_report` (`id`, `store_id`, `name`,`employee`,`services`,`product`,`mobile`, `amount`, `payment_mode`, `sales_date`) VALUES (NULL, $store_id ,'$name','$employee','$service','$product','$mobile', '$amount','$paymentmode', '$create_date')";
	$stmt = $DB->prepare($query37);
	$stmt->execute();

	$query1="UPDATE `tbl_customer_purchase` SET `store_id` = '$store_id',`mobile` = '$mobile',`amount`='$amount',`services`='$services',`comment`='$comment',`date`='$create_date' WHERE `c_id` = '$c_id' and  store_id ='$store_id'";
	$stmt = $DB->prepare($query1);
	$stmt->execute();


	$query27="UPDATE `tbl_loyality` SET `amount`='$amount',`c_id`='$c_id',`available_points`='$available_point',`used_points`='0',`mobile`='$mobile' WHERE `c_id` = '$c_id' and  store_id ='$store_id'";
	$stmt = $DB->prepare($query27);
	$stmt->execute();
	
   }

  else{

	
	$query23="INSERT INTO `tbl_customer_data` (`id`, `store_id`, `mobile`, `name`, `email`, `anniversary`, `dob`,`employee`,`amount`, `customer_group`, `comment`, `reminder`, `store`, `userid`, `address`, `c_source`,`c_date`) VALUES (NULL, '$store_id','$mobile', '$name', '$email', '$anniversary', '$dob','$employee','$amount', '$c_group', '$comment', '$reminder', '$store', '$userid', '$address','$c_source','$create_date')";
	$stmt = $DB->prepare($query23);
	$stmt->execute();

	$query37="INSERT INTO `tbl_sales_report` (`id`, `store_id`, `name`,`employee`,`services`,`product`,`mobile`, `amount`, `payment_mode`, `sales_date`) VALUES (NULL, '$store_id', '$name','$employee','$service','$product','$mobile', '$amount','$paymentmode', '$create_date')";
	$stmt = $DB->prepare($query37);
	$stmt->execute();

	if($stmt==true){

		$sql25 = "SELECT *  FROM `tbl_customer_data` WHERE  mobile='$mobile' and store_id ='$store_id'";
		$stmt = $DB->prepare($sql25);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		while ($row25 = $stmt->fetch()) {
		$result = array();
		$c_id25=$row25['id'];
		}
	}
	
	$query24="INSERT INTO `tbl_customer_purchase` (`id`,`store_id`, `c_id`, `mobile`, `amount`,`services`,`comment`, `date`) VALUES (NULL,'$store_id','$c_id25','$mobile', '$amount','$service','$comment', '$create_date')";
	$stmt = $DB->prepare($query24);
	$stmt->execute();

	$query55="INSERT INTO `tbl_loyality` (`id`, `store_id`, `amount`,`c_id`, `available_points`, `used_points`,`mobile`) VALUES (NULL,'$store_id','$amount','$c_id25','$available_point','0','$mobile')";
	$stmt = $DB->prepare($query55);
	$stmt->execute();

}

// tiny url....................!
/*
    function get_tiny_url($url)  {  
    $ch = curl_init();  
    $timeout = 5;  
    curl_setopt($ch,CURLOPT_URL,'http://tinyurl.com/api-create.php?url='.$url);  
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);  
    curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);  
    $data = curl_exec($ch);  
    curl_close($ch);  
    return $data;  
}

//test it out!
$new_url = get_tiny_url('https://www.codexworld.com/php-url-shortener-library-create-short-url');

//returns http://tinyurl.com/65gqpp
echo $new_url
*/
// end of tiny url....................!


$sql1 = "SELECT *  FROM `creditsms` WHERE `store_id` = '$store_id'";
$stmt = $DB->prepare($sql1);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
while ($row1 = $stmt->fetch()) {
$available_sms=$row1['available_sms'];
$used_sms=$row1['used_sms'];

}

$sql2 = "SELECT *  FROM `tbl_user_group` WHERE  `store_id` = '$store_id' and `parent_id`='0'";
$stmt = $DB->prepare($sql2);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
while ($row2 = $stmt->fetch()) {
$sender_id=$row2['sender_id'];

}


$sql12 = "SELECT *  FROM `tbl_store` WHERE  `store_id` = '$store_id'";
$stmt = $DB->prepare($sql12);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
while ($row12 = $stmt->fetch()) {
$business_name=$row12['store_name'];

}


$sql19 = "SELECT *  FROM `smstemplates` WHERE `message_type` = 'Add Customer' and `store_id` = '$store_id'";

$stmt = $DB->prepare($sql19);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
while ($row19 = $stmt->fetch()) {
$mess=$row19['message'];

}

if(!empty($name)){
	$name=$name;
}
else{
	$name='Customer';
}


// fetch tiny url..................!

// $sql010 = "SELECT *  FROM `tbl_user_group` WHERE  `child_id` = '$userid'  and `store_id` = '$store_id'";
// $stmt = $DB->prepare($sql010);
// $stmt->execute();
// $stmt->setFetchMode(PDO::FETCH_ASSOC);
// while ($row010 = $stmt->fetch()) {
// $tinyurl=$row010['tiny_url'];
// echo $tinyurl;	
// }

$tinyurl  = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']."?store_id=".$store_id;
// fetch tiny url...................!

$sql009 = "SELECT *  FROM `tbl_feedbacksetting` where `store_id` = '$store_id'";


$stmt = $DB->prepare($sql009);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
while ($row009 = $stmt->fetch()) {
$feedback_value=$row009['feedback_value'];

}
	
$sms_text=str_replace("customer_name",$name,$mess);
$sms_text=str_replace("retailer_name",$business_name,$sms_text);
 
if($feedback_value=='every'){
	$sms_msg_text= $sms_text." Please Give feedback" .$tinyurl."!";
}
else{
	$sms_msg_text=$sms_text;
}

if(($available_sms>'1')&&($sendsms=='yes')){
	$curl = curl_init();
/*if(!empty($amount)){
	$sms_text='Thank for shopping! with us';
}
else{
	$sms_text='Thank for enquiry! with us';
}*/
  curl_setopt_array($curl, array(
  CURLOPT_URL => "http://msg160.com/sendsms/send1_post",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"userid\"\r\n\r\nyogesh\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"pass\"\r\n\r\n12345678\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"sender\"\r\n\r\n".$sender_id."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"mobile\"\r\n\r\n".$mobile."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"message\"\r\n\r\n".$sms_msg_text."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"route\"\r\n\r\n5\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
    "postman-token: 2e642de6-bd3c-1d3f-b5ce-3acd25867c5b"
  ),
));

$response = curl_exec($curl);
// echo "sss".$sender_id;echo "</br>";
// echo $sender_id;echo "</br>";
// echo $mobile;echo "</br>";
// echo $response;
// exit;
if($response=='sms sent successfully'){
	$update_sms=$available_sms-1;
	$u_sms=$used_sms+1;

	$query="UPDATE `creditsms` SET `used_sms` = '$u_sms',`available_sms` = '$update_sms' WHERE `store_id` = '$store_id'";
	$stmt = $DB->prepare($query);
	$stmt->execute();


	$query011="INSERT INTO `sms_report` (`id`, `store_id`, `message`,`mobile`,`from_date`, `to_date`, `state`,`operator`, `status`, `send`,`update_on`) VALUES (NULL,'$store_id','$sms_msg_text','$mobile','$create_date','$create_date', '1','operator','active','yes','on')";
	$stmt = $DB->prepare($query011);
	$stmt->execute();

	if($stmt==True)
	{

	header('Location: customer-view.php?data=update');
	exit;
	}
	else
	{
	header('Location: customer-view.php?data=error');
	exit;
	}
}else{
	header('Location: customer-view.php?data=error');
	exit;
}
$err = curl_error($curl);

}
}header('Location: customer-view.php?data=update');
exit;

 ?>