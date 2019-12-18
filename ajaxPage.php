<?php

include("config.php");

// Posted Values

//print_r($_POST);
$points= $_POST['points'];
$sql = "SELECT *  FROM `loyality_setting`";
$stmt = $DB->prepare($sql);
$stmt->execute();

	
	$result = array();
	
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	while ($row = $stmt->fetch()) {  
		$data['loyalitypoints']=$row['loyality_points'];
	
    }
    $totalvalue=$data['loyalitypoints']*$points;
	echo json_encode($totalvalue);
	//echo "{'customer':{'first_name':'John','last_name':'Cena'}}"
	//mysqli_close($link);


 ?>