<?php

include("config.php");
//$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection


// Posted Values

//print_r($_POST);
$store_id  =  $_SESSION['store_id'];

$id= $_POST['id'];
$sql = "SELECT *  FROM `tbl_package` WHERE  id='$id' AND `store_id` = '$store_id'";
$stmt = $DB->prepare($sql);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$result = array();
while ($row = $stmt->fetch()) {  
//echo $sql;
	
		$data['package_price']=$row['package_price'];
		$data['package_expiry']=$row['package_expiry']." ".$row['package_days'];
		$data_v=$row['services'];

		$data_val=unserialize($data_v);
		foreach($data_val as $datarow){
			$data_ser[]= $datarow['services'];
			$data_sty[]= $datarow['package_qty'];
		
		}

		$data['services']=implode(", ",$data_ser);
		$data['qty']=implode(", ",$data_sty);



	}
	
	echo json_encode($data);
	//echo "{'customer':{'first_name':'John','last_name':'Cena'}}"
	//mysqli_close($link);


 ?>