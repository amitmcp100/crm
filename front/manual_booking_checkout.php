<?php  
if(isset($_POST['action']) && $_POST['action']=='complete_booking'){
	ob_start();
	session_start();
	include(dirname(dirname(__FILE__)).'/header.php');
	include(dirname(dirname(__FILE__)).'/objects/class_connection.php');
	include(dirname(dirname(__FILE__)).'/objects/class_setting.php');
	include(dirname(dirname(__FILE__)).'/objects/class_booking.php');
	include(dirname(dirname(__FILE__)).'/objects/class_services.php');
	include(dirname(dirname(__FILE__)).'/objects/class_front_first_step.php');
	include(dirname(dirname(__FILE__)).'/objects/class_users.php');
	include(dirname(dirname(__FILE__)).'/objects/class_order_client_info.php');
	include(dirname(dirname(__FILE__)).'/objects/class_coupon.php');
	include(dirname(dirname(__FILE__)).'/objects/class_frequently_discount.php');
	include(dirname(dirname(__FILE__)).'/objects/class_payments.php');
	include(dirname(dirname(__FILE__)).'/objects/class.phpmailer.php');
	include(dirname(dirname(__FILE__)).'/objects/class_general.php');
	include(dirname(dirname(__FILE__)).'/objects/class_email_template.php');
	include(dirname(dirname(__FILE__)).'/objects/class_adminprofile.php');
	include(dirname(dirname(__FILE__)).'/objects/plivo.php');
	include(dirname(dirname(__FILE__)).'/assets/twilio/Services/Twilio.php');
	include(dirname(dirname(__FILE__))."/objects/class_dashboard.php");
	include(dirname(dirname(__FILE__))."/objects/class_nexmo.php");
	
	$con = new cleanto_db();
	$conn = $con->connect();
	
	$setting = new cleanto_setting();
	$setting->conn = $conn;

	$booking=new cleanto_booking();
	$booking->conn=$conn;
	
	$objdashboard = new cleanto_dashboard();
	$objdashboard->conn = $conn;

	$objadminprofile = new cleanto_adminprofile();
	$objadminprofile->conn = $conn;

	$nexmo_admin = new cleanto_ct_nexmo();
	$nexmo_client = new cleanto_ct_nexmo();

	$first_step=new cleanto_first_step();
	$first_step->conn=$conn;

	$email_template = new cleanto_email_template();
	$email_template->conn=$conn;

	$general=new cleanto_general();
	$general->conn=$conn;

	$user=new cleanto_users();
	$order_client_info=new cleanto_order_client_info();
	$settings=new cleanto_setting();
	$coupon=new cleanto_coupon();
	$frequently_discount = new cleanto_frequently_discount();
	$payment = new cleanto_payments();
	$service = new cleanto_services();

	$frequently_discount->conn = $conn;
	$user->conn=$conn;
	$order_client_info->conn=$conn;
	$settings->conn=$conn;
	$coupon->conn=$conn;
	$payment->conn=$conn;
	$service->conn=$conn;

	$last_order_id=$booking->last_booking_id();

	$symbol_position=$settings->get_option('ct_currency_symbol_position');
	$decimal=$settings->get_option('ct_price_format_decimal_places');

	$company_email=$settings->get_option('ct_email_sender_address');
	$company_name=$settings->get_option('ct_email_sender_name');
	
	if(isset($_POST['recurrence_booking'])){
		$recurrence_booking_status = $_POST['recurrence_booking'];
	}else{
		$recurrence_booking_status = '';
	}
	
	$total_discount =  @number_format($_POST['frequent_discount_amount'],2,".",',') + @number_format($_POST['discount'],2,".",',');

    $phone = "";
    if (substr($_POST['phone'], 0, 1) === '+')
    {
        $phone = $_POST['phone'];
    }
    else
    {
        $country_codes = explode(',',$setting->get_option("ct_company_country_code"));
        $phone = $country_codes[0].$_POST['phone'];
    }
	if($setting->get_option("ct_tax_vat_status") == 'N'){
		$tax = 0;
	}else{
		$tax = $_POST['taxes'];
	}
	
	$service->id = $_SESSION['ct_cart']['method'][0]['service_id'];
    $service_name = $service->get_service_name_for_mail();
	
	$email = addslashes($_POST['email']);
	$firstname = addslashes($_POST['firstname']);
	$lastname = addslashes($_POST['lastname']);
	$address = addslashes($_POST['address']);
	$zipcode = addslashes($_POST['zipcode']);
	$city = addslashes($_POST['city']);
	$state = addslashes($_POST['state']);
	$user_address = addslashes($_POST['user_address']);
	$user_zipcode = addslashes($_POST['user_zipcode']);
	$user_city = addslashes($_POST['user_city']);
	$user_state = addslashes($_POST['user_state']);
	$notes = addslashes($_POST['notes']);
	$staff_id = $_POST['staff_id'];
	$coupon_code = addslashes($_POST['coupon_code']);
	
	$array_value = array('existing_username' => $_POST['existing_username'], 'existing_password' => $_POST['existing_password'], 'password' => $_POST['password'], 'firstname' => $firstname, 'lastname' => $lastname, 'email' => $email, 'phone' => $phone, 'user_address' => $user_address, 'user_zipcode' => $user_zipcode, 'user_city' => $user_city, 'user_state' => $user_state, 'address' => $address, 'zipcode' => $zipcode, 'city' => $city, 'state' => $state, 'notes' => $notes, 'vc_status' => $_POST['vc_status'],'staff_id' => $staff_id, 'p_status' => $_POST['p_status'], 'contact_status' => $_POST['contact_status'], 'payment_method' => $_POST['payment_method'], 'amount' => $_POST['amount'], 'discount' => number_format($total_discount, 2, ".", ','), 'taxes' => $tax, 'partial_amount' => '', 'net_amount' => $_POST['net_amount'], 'booking_date_time' => $_POST['booking_date_time'], 'frequently_discount' => $_POST['frequently_discount'], 'frequent_discount_amount' => $_POST['frequent_discount_amount'], 'action' => "complete_booking", 'coupon_discount' => $_POST['discount'], 'cc_card_num' => '','cc_exp_month' => '','cc_exp_year' => '','cc_card_code' => '','guest_user_status' => $_POST['guest_user_status'],'service_name' => $service_name,'coupon_code'=> $coupon_code,'recurrence_booking_status'=> $recurrence_booking_status);

	$_SESSION['ct_details']=$array_value;
	
	$transaction_id ='';
	include('manual_booking_complete.php');
}
?>