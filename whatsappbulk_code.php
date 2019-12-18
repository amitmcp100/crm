<?php

include("config.php");
//$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection
//print_r($_POST);

if(isset($_POST['submit']))
{
// Posted Values
$id=$_POST['id'];
$userid=$_POST['user'];
$store=$_POST['store'];
$sms_text=urlencode($_POST['sms_text']);

$sql1 = "SELECT *  FROM `tbl_customer_data` WHERE `store` = '$store'";
$stmt = $DB->prepare($sql1);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
while ($row1 = $stmt->fetch()) { 
	$c_mobile=$row1['mobile'];


$a="https://panel.apiwha.com/send_message.php?apikey=XOUGCPS4G7J8C2MA39O0&number=91".$c_mobile."&text=".$sms_text;
//echo $a;
$curl = curl_init();;
curl_setopt_array($curl, array(
  CURLOPT_URL => $a,
  CURLOPT_RETURNTRANSFER => true,
  curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, false),
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);



}
header('Location: whats-msg.php?data=update');
  exit;
}

 

 ?>