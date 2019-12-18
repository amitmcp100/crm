<?php

include("config.php");
//$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection


// Posted Values

//print_r($_POST);
$date     =  $_POST['date'];
$emp      =  $_POST['emp'];
$store_id =  $_POST['store_id'];
$timeslot[]='';
$sql = "SELECT *  FROM `tbl_appoinment` WHERE  `date`='$date' and `emp_id`='$emp' and `store_id`='$store_id'";
$stmt = $DB->prepare($sql);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
while ($row = $stmt->fetch()) {  
$result = array();
$timeslot[]= $row['time_slot'];
	}
//print_r($timeslot);

$sql1 = "SELECT *  FROM `tbl_timeslot` where emp_id='$emp' and  `store_id`='$store_id'";
$stmt = $DB->prepare($sql1);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
while ($row1 = $stmt->fetch()) {  

    $t_time=$row1['time_slot']; 
	if (in_array($t_time, $timeslot))
	{ 
	echo '<fieldset class="radio"  style="width:105px; float:left; padding:5px;"><label style="padding:5px;border:1px #333 solid;background-color: #333;color: #fff;" id="disb">'.$t_time.'</label></fieldset>';
	} 

	else
	{ 
	echo '<fieldset class="radio"  style="width:105px; float:left; padding:5px;"><label style="padding:5px;border:1px #333 solid;"><input type="checkbox" name="radio[]" value="'.$t_time.'">'.$t_time.'</label></fieldset>';
	} 

		
		
			//echo '<fieldset class="radio"  style="width:105px; float:left; padding:5px;"><label style="padding:5px;border:1px #333 solid;" id="disb">'.$t_time.'</label></fieldset>';
		}	

	
	//echo json_encode($data);
	//echo "{'customer':{'first_name':'John','last_name':'Cena'}}"
	//mysqli_close($link);


 ?>