<?php   

ob_start();
session_start();
include(dirname(dirname(__FILE__)).'/header.php');
include(dirname(dirname(__FILE__)).'/objects/class_connection.php');
include(dirname(dirname(__FILE__)).'/objects/class_setting.php');
include(dirname(dirname(__FILE__)).'/objects/class_booking.php');
include(dirname(dirname(__FILE__)).'/objects/class_payment_hook.php');
include(dirname(dirname(__FILE__)).'/objects/class_services.php');

$con = new cleanto_db();
$conn = $con->connect();

$setting = new cleanto_setting();
$setting->conn = $conn;

$booking=new cleanto_booking();
$booking->conn=$conn;

$service=new cleanto_services();
$service->conn=$conn;

$payment_hook = new cleanto_paymentHook();
$payment_hook->conn = $conn;
$payment_hook->payment_extenstions_exist();
$purchase_check = $payment_hook->payment_purchase_status();

$stripe_trans_id = '';
$twocheckout_trans_id = '';
if(isset($_POST['action']) && $_POST['action']=='complete_booking'){
	$recurrence_booking_status = $_POST['recurrence_booking'];
	if(isset($_POST['st_token']) && $_POST['st_token']!='' && $_POST['net_amount']!=0 && ($setting->get_option('ct_stripe_create_plan') == "N" || $_POST["guest_user_status"] == "on" || $recurrence_booking_status == "N")) {
		require_once(dirname(dirname(__FILE__)).'/assets/stripe/stripe.php');
		$partialdeposite_status = $setting->get_option('ct_partial_deposit_status');
		if($partialdeposite_status=='Y'){
			$stripe_amt = number_format($_POST['partial_amount'],2,".",',');
		}else{
			$stripe_amt = number_format($_POST['net_amount'],2,".",',');
		}
		if($_POST['existing_username']!=''){ 
			$emails=$_POST['existing_username']; 
		}else{ 
			$emails=$_POST['email']; 
		}
		\Stripe\Stripe::setApiKey($setting->get_option("ct_stripe_secretkey"));
		$error = '';
		$success = '';
	 try {
		$objcharge = new \Stripe\Charge;
			$striperesponse = $objcharge::Create(array(
				"amount" => round(((double)$stripe_amt)*100),
				"currency" => $setting->get_option('ct_currency'),
				"source" => $_POST['st_token'],
				"description"=>$_POST['firstname'].' , '.$emails
			));
			$stripe_trans_id = $striperesponse->id;
		}
		catch (Exception $e) {
			$error = $e->getMessage();				
			echo $error;die;
		}
	}elseif (isset($_POST['twoctoken']) && $_POST['twoctoken']!='' && $_POST['net_amount']!=0) {			
			require_once('../assets/twocheckout/Twocheckout.php');
			$twocc_private_key = $setting->get_option("ct_2checkout_privatekey");
			$twocc_sellerId = $setting->get_option("ct_2checkout_sellerid");
			$twocc_sandbox_mode = $setting->get_option("ct_2checkout_sandbox_mode");
			if($twocc_sandbox_mode == 'Y'){
				$twocc_sandbox = true;
			}else{
				$twocc_sandbox = false;
			}
			Twocheckout::privateKey($twocc_private_key); 
			Twocheckout::sellerId($twocc_sellerId); 
			Twocheckout::sandbox($twocc_sandbox);
			Twocheckout::verifySSL(false);
			if($_POST['existing_username']!=''){
				$emails=$_POST['existing_username'];
			}else{
				$emails=$_POST['email'];
			}
			$last_order_id=$booking->last_booking_id();
			if($last_order_id=='0' || $last_order_id==null){
				$orderid = 1000;
			}else{
				$orderid = $last_order_id+1;
			}
			$partialdeposite_status = $setting->get_option('ct_partial_deposit_status');
			if($partialdeposite_status=='Y'){
				$twocheckout_amt = number_format($_POST['partial_amount'],2,".",',');
			}else{
				$twocheckout_amt = number_format($_POST['net_amount'],2,".",',');
			}
			try {
				$charge = Twocheckout_Charge::auth(array(
					"merchantOrderId" => $orderid,
					"token"      => $_REQUEST['twoctoken'],
					"currency"   => $setting->get_option('ct_currency'),
					"total"      => $twocheckout_amt,
					"billingAddr" => array(
						"name" => $_POST['firstname'].' '.$_POST['lastname'],
						"addrLine1" => $_POST['address'],
						"city" => $_POST['city'],
						"state" => $_POST['state'],
						"zipCode" => $_POST['zipcode'],
						"country" => $setting->get_option('ct_company_country'),
						"email" => $emails,
						"phoneNumber" => $_POST['phone']
					)
				));
				
				if ($charge['response']['responseCode'] == 'APPROVED') {
					$twocheckout_trans_id = $charge['response']['transactionId'];
				}
			} catch (Twocheckout_Error $e) {
				$error = $e->getMessage();
				echo $error;die;
			}
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
	$coupon_code = addslashes($_POST['coupon_code']);
	$user_city = addslashes($_POST['user_city']);
	$user_state = addslashes($_POST['user_state']);
	$notes = addslashes($_POST['notes']);
	$staff_id = $_POST['staff_id'];

	$array_value = array('existing_username' => $_POST['existing_username'], 'existing_password' => $_POST['existing_password'], 'password' => $_POST['password'], 'firstname' => $firstname, 'lastname' => $lastname, 'email' => $email, 'phone' => $phone, 'user_address' => $user_address, 'user_zipcode' => $user_zipcode, 'user_city' => $user_city, 'user_state' => $user_state, 'address' => $address, 'zipcode' => $zipcode, 'city' => $city, 'state' => $state, 'notes' => $notes, 'vc_status' => $_POST['vc_status'],'staff_id' => $staff_id, 'p_status' => $_POST['p_status'], 'contact_status' => $_POST['contact_status'], 'payment_method' => $_POST['payment_method'], 'amount' => $_POST['amount'], 'discount' => abs(number_format($total_discount, 2, ".", ',')), 'taxes' => $tax, 'partial_amount' => $_POST['partial_amount'], 'net_amount' => $_POST['net_amount'], 'booking_date_time' => $_POST['booking_date_time'], 'frequently_discount' => $_POST['frequently_discount'], 'frequent_discount_amount' => abs($_POST['frequent_discount_amount']), 'action' => "complete_booking", 'coupon_discount' => $_POST['discount'], 'cc_card_num' => $_POST['cc_card_num'],'cc_exp_month' => $_POST['cc_exp_month'],'cc_exp_year' => $_POST['cc_exp_year'],'cc_card_code' => $_POST['cc_card_code'],'guest_user_status' => $_POST['guest_user_status'],'is_login_user' => $_POST['is_login_user'],'service_name' => $service_name,'coupon_code'=> $coupon_code,'recurrence_booking_status'=> $recurrence_booking_status);
	
	$_SESSION['ct_details']=$array_value;
	
	/* payumoney payment method*/
	if($_POST['payment_method'] == 'payumoney'){
		header('location:'.FRONT_URL.'payumoney_payment_process.php');
		exit(0);
	}	
	
	/*paypal payment method*/
	if($_POST['payment_method'] == 'paypal'){
		header('location:'.FRONT_URL.'pp_payment_process.php');
		exit(0);
	}
	/*Stripe payment method single*/
	if($_POST['payment_method'] == 'stripe-payment' && ($setting->get_option('ct_stripe_create_plan') == "N" || $_POST["guest_user_status"] == "on" || $recurrence_booking_status == "N")){
		$_SESSION['ct_details']['stripe_trans_id'] = $stripe_trans_id;
		header('location:'.FRONT_URL.'booking_complete.php');
		exit(0);
	}
	if($_POST['payment_method'] == 'stripe-payment' && ($setting->get_option('ct_stripe_create_plan') == "Y" || $_POST["guest_user_status"] == "off" || $recurrence_booking_status == "Y")){
		$_SESSION['ct_details']['stripe_token'] = $_POST["st_token"];
		header('location:'.FRONT_URL.'booking_complete.php');
		exit(0);
	}
	/*2checkout payment method*/
	if($_POST['payment_method'] == '2checkout-payment'){
		$_SESSION['ct_details']['twocheckout_trans_id'] = 	$twocheckout_trans_id;
		header('location:'.FRONT_URL.'booking_complete.php');
		exit(0);
	}	
	/*pay locally payment method*/
	if($_POST['payment_method'] == 'pay at venue'){
		$transaction_id ='';
		header('location:'.FRONT_URL.'booking_complete.php');
		exit(0);
	}	
	/*bank transfer payment method*/
	if($_POST['payment_method'] == 'bank transfer'){
		$transaction_id ='';
		header('location:'.FRONT_URL.'booking_complete.php');
		exit(0);
	}
	/*card payment method*/
	if($_POST['payment_method'] == 'card-payment'){
		$transaction_id ='';
		header('location:'.FRONT_URL.'authorizenet_payment_process.php');
		exit(0);
	}
	
	/* Payment Extension method */
	
	if(sizeof((array)$purchase_check)>0){
		$payment_status = "off";
		$check_pay = 'N';
		foreach($purchase_check as $key=>$val){
			if($val == 'Y'){
				echo $payment_hook->payment_checkout_hook($key);
			}
		}
	}
} ?>