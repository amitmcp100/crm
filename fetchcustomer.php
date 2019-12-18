<?php

include("config.php");

// Posted Values

//print_r($_POST);
	$mobile= $_POST['mobile'];
	$sql = "SELECT *  FROM `tbl_customer_data` WHERE  mobile='$mobile'";
	$stmt = $DB->prepare($sql);
	$stmt->execute();

	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	while ($row = $stmt->fetch()) {  
		$data['name']=$row['name'];
		$data['email']=$row['email'];
		$data['address']=$row['address'];
		$data['anniversary']=$row['anniversary'];
		$data['dob']=$row['dob'];
		$data['customer_group']=$row['customer_group'];
		$data['comment']=$row['comment'];
		$data['reminder']=$row['reminder'];
		$data['employee']=$row['employee'];
		
	}

	$sql22 = "SELECT *  FROM `tbl_loyality` WHERE  mobile='$mobile'";
	$stmt = $DB->prepare($sql22);
	$stmt->execute();
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	while ($row22 = $stmt->fetch()) {  
		$data['loyalitypoints']=$row22['available_points'];
	}
	
	echo json_encode($data);
	//echo "{'customer':{'first_name':'John','last_name':'Cena'}}"
	//mysqli_close($link);


 ?>