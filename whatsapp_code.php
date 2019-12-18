<?php
include("config.php");
//$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection


$tab1=$_POST['tab1'];
$c_mobile=$_POST['c_mobile'];
$tab=$_POST['tab'];
$sms_text=$_POST['sms_text'];
$pdf=$_POST['pdf'];
$image=$_POST['image'];
//echo "<pre>";
//print_r($_POST);

if($tab1=='all'){

$sql1 = "SELECT *  FROM `tbl_customer_data` ";
$stmt = $DB->prepare($sql1);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
while ($row1 = $stmt->fetch()) { 
$mobile[]="91".$row1['mobile'];
//$used_sms=$row1['used_sms'];

}

$c_mobile=implode(',', $mobile);

}
else{
	$c_mobile=$c_mobile;
}
//echo $sms_text;
if(($tab=='text')&&($tab1=='manual')){
		$message = $sms_text; // text message to be sent
		
		$key = "thBbjNMOlKDwnKLc"; // your api key 
		$number = $c_mobile; // target mobile number, including country code

		$fields = [
		'message' => $message,
		'key' => $key,
		'number' => $number,
		];

		$url = "http://send.wabapi.com/posttext.php";

		//url-ify the data for the POST
		$fields_string = http_build_query($fields);

		//open connection
		$ch = curl_init();

		//set the url, number of POST vars, POST data
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_POST, count($fields));
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

		//So that curl_exec returns the contents of the cURL; rather than echoing it
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 

		//execute post
		$result = curl_exec($ch);
		//echo $result;
	}

if(($tab=='image')&&($tab1=='manual')){
//echo "hhh";		

	$imgtitle=$_POST['imagetitle'];
	$imgfile=$_FILES["image"]["name"];

	$userid=$_POST['userid'];
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
	move_uploaded_file($_FILES["image"]["tmp_name"],"whatsappimage/".$imgnewfile);
	// Query for insertion data into database
	}


	
	$filepath = "https://crm.loiretechnologies.com/demo/whatsappimage/".$imgnewfile;
	//echo $filepath;
	 // absolute path of file on local drive
	 $key = "thBbjNMOlKDwnKLc"; // your api key
	 $number = $c_mobile; // target mobile number, including country code
//echo $number;
	//The url you wish to send the POST request to
	$img = file_get_contents($filepath);
	$data = base64_encode($img);
	$filename = basename($filepath);

	$url = "http://send.wabapi.com/postimage.php";
	//The data you want to send via POST
	$fields = [
	    'data' => $data,
	    'filename' => $filename, 
	    'key' => $key,
	    'number' => $number,
	];

	//url-ify the data for the POST
	$fields_string = http_build_query($fields);

	//open connection
	$ch = curl_init();

	//set the url, number of POST vars, POST data
	curl_setopt($ch,CURLOPT_URL, $url);
	curl_setopt($ch,CURLOPT_POST, count($fields));
	curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

	//So that curl_exec returns the contents of the cURL; rather than echoing it
	curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 

	//execute post
	$result = curl_exec($ch);
	//echo "data".$result;
}


if(($tab=='pdf')&&($tab1=='manual')) {
//echo "hhh";		
 //$targetfolder = "whatsappimage/";
//define ("whatsappimage","./");
$file = rand(1000,100000)."-".$_FILES['file']['name'];
 $file_loc = $_FILES['file']['tmp_name'];
 $file_size = $_FILES['file']['size'];
 $file_type = $_FILES['file']['type'];
 $folder="whatsappimage/";
 //echo $file;
 move_uploaded_file($file_loc,$folder.$file);
  $filepath = "https://crm.loiretechnologies.com/demo/whatsappimage/".$file;// absolute path of file on local drive
//echo $filepath;exit;
  $key = "thBbjNMOlKDwnKLc"; // your api key
	 $number = $c_mobile; 

//The url you wish to send the POST request to
 // Get the image and convert into string 
$pdf = file_get_contents($filepath);
$data = base64_encode($pdf);
$filename = basename($filepath);

$url = "http://send.wabapi.com/postpdf.php";

//The data you want to send via POST
$fields = [
    'data' => $data,
    'filename' => $filename,
    'key' => $key,
    'number' => $number,
];

//url-ify the data for the POST
$fields_string = http_build_query($fields);

//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POST, count($fields));
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

//So that curl_exec returns the contents of the cURL; rather than echoing it
curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 

//execute post
$result = curl_exec($ch);
echo $result;
}
$create_date=date("Y-m-d");

if(($tab=='text')&&($tab1=='all')){
$query1="INSERT INTO `whatsapp_report` (`id`, `message`, `mes_type`, `date`) VALUES (NULL, '$sms_text', 'text', '$create_date')";
$stmt = $DB->prepare($query1);
$stmt->execute();
}


if(($tab=='image')&&($tab1=='all')){
$imgtitle=$_POST['imagetitle'];
	$imgfile=$_FILES["image"]["name"];

	$userid=$_POST['userid'];
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
	move_uploaded_file($_FILES["image"]["tmp_name"],"whatsappimage/".$imgnewfile);
	// Query for insertion data into database
	}


	
	$filepath = "https://crm.loiretechnologies.com/demo/whatsappimage/".$imgnewfile;
	
$query2="INSERT INTO `whatsapp_report` (`id`, `message`, `mes_type`, `date`) VALUES (NULL, '$filepath', 'image', '$create_date')";
$stmt = $DB->prepare($query2);
$stmt->execute();

}

if(($tab=='pdf')&&($tab1=='all')){
$file = rand(1000,100000)."-".$_FILES['file']['name'];
 $file_loc = $_FILES['file']['tmp_name'];
 $file_size = $_FILES['file']['size'];
 $file_type = $_FILES['file']['type'];
 $folder="whatsappimage/";
 //echo $file;
 move_uploaded_file($file_loc,$folder.$file);
  $filepath = "https://crm.loiretechnologies.com/demo/whatsappimage/".$file;
$query2="INSERT INTO `whatsapp_report` (`id`, `message`, `mes_type`, `date`) VALUES (NULL, '$filepath', 'pdf', '$create_date')";
$stmt = $DB->prepare($query2);
$stmt->execute();
}
//exit;
header('Location: whats-msg.php?data=update');
exit;

 ?>