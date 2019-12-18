<?php
include(dirname(dirname(dirname(__FILE__))).'/objects/class_connection.php');
include(dirname(dirname(dirname(__FILE__))).'/objects/class_booking.php');
include(dirname(dirname(dirname(__FILE__)))."/header.php");	
$con = new cleanto_db();
$conn = $con->connect();
$booking= new cleanto_booking();
$booking->conn=$conn;
if(isset($_GET['id'])){
	$booking->id=$_GET['id'];
	$booking->status=$_GET['status'];
	if($_GET['status'] == "A"){
	$result=$booking->update_staff_status();
	if($result){
			?>
			<script>window.close();</script>
			<?php
		}
	}
	 // Closes the new window
	 if($_GET['status'] == "D"){
		$result1=$booking->update_staff_status();
		$result=$booking->readone_bookings_sid_staff();
		/* $result=$booking->readone_bookings_sid_staff(); */
		$s_idd=$result['staff_id'];
		$booking->order_id=$result['order_id'];
		$result=$booking->readone_bookings_details_by_order_id();	
	    $data=$result['staff_ids'];
		$array_val=explode(',',$data);
		$x=array();
		foreach($array_val as $kk)
		{
			if($kk != $s_idd){
				array_push($x,$kk);
			}
		}
		$ord_id=$result['order_id'];
	    $s_id=implode(',',$x);
		$booking->booking_id=$result['order_id'];
		$booking->staff_id=$s_id;
		$result=$booking->update_staff_id_bookings_details_by_order_id();
		if($result){
			?>
			<script>window.close();</script>
			<?php
		}
	 }
 }
 
if(isset($_POST['action']) && $_POST['action']=='accept_appointment_staff'){
	$booking->id=$_POST['idd'];
	$booking->status=$_POST['staff_status'];
	$result=$booking->update_staff_status();
}
if(isset($_POST['action']) && $_POST['action']=='decline_appointmentt_staff'){
	$booking->id=$_POST['idd'];
	$booking->status=$_POST['staff_status'];
	$result1=$booking->update_staff_status();
	$result=$booking->readone_bookings_sid_staff();
	$s_idd=$result['staff_id'];
	$booking->order_id=$result['order_id'];
	$result=$booking->readone_bookings_details_by_order_id();	
    $data=$result['staff_ids'];
	$array_val=explode(',',$data);
	$x=array();
	foreach($array_val as $kk)
	{
		if($kk != $s_idd){
			array_push($x,$kk);
		}
	}	
	$ord_id=$result['order_id'];
	$s_id=implode(',',$x);
	$booking->booking_id=$result['order_id'];
	$booking->staff_id=$s_id;
	$result=$booking->update_staff_id_bookings_details_by_order_id();
}
?>