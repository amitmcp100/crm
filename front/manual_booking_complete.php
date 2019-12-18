<?php   

include(dirname(dirname(__FILE__))."/objects/class_gc_hook.php");

$gc_hook = new cleanto_gcHook();
$gc_hook->conn = $conn;

if($settings->get_option('ct_smtp_authetication') == 'true'){
	$mail_SMTPAuth = '1';
	if($settings->get_option('ct_smtp_hostname') == "smtp.gmail.com"){
		$mail_SMTPAuth = 'Yes';
	}
	
}else{
	$mail_SMTPAuth = '0';
	if($settings->get_option('ct_smtp_hostname') == "smtp.gmail.com"){
		$mail_SMTPAuth = 'No';
	}
}

$mail = new cleanto_phpmailer();
$mail->Host = $settings->get_option('ct_smtp_hostname');
$mail->Username = $settings->get_option('ct_smtp_username');
$mail->Password = $settings->get_option('ct_smtp_password');
$mail->Port = $settings->get_option('ct_smtp_port');
$mail->SMTPSecure = $settings->get_option('ct_smtp_encryption');
$mail->SMTPAuth = $mail_SMTPAuth;
$mail->CharSet = "UTF-8";

$mail_a = new cleanto_phpmailer();
$mail_a->Host = $settings->get_option('ct_smtp_hostname');
$mail_a->Username = $settings->get_option('ct_smtp_username');
$mail_a->Password = $settings->get_option('ct_smtp_password');
$mail_a->Port = $settings->get_option('ct_smtp_port');
$mail_a->SMTPSecure = $settings->get_option('ct_smtp_encryption');
$mail_a->SMTPAuth = $mail_SMTPAuth;
$mail_a->CharSet = "UTF-8";


/*NEXMO SMS GATEWAY VARIABLES*/

$nexmo_admin->ct_nexmo_api_key = $settings->get_option('ct_nexmo_api_key');
$nexmo_admin->ct_nexmo_api_secret = $settings->get_option('ct_nexmo_api_secret');
$nexmo_admin->ct_nexmo_from = $settings->get_option('ct_nexmo_from');

$nexmo_client->ct_nexmo_api_key = $settings->get_option('ct_nexmo_api_key');
$nexmo_client->ct_nexmo_api_secret = $settings->get_option('ct_nexmo_api_secret');
$nexmo_client->ct_nexmo_from = $settings->get_option('ct_nexmo_from');

/*SMS GATEWAY VARIABLES*/
$plivo_sender_number = $settings->get_option('ct_sms_plivo_sender_number');
$twilio_sender_number = $settings->get_option('ct_sms_twilio_sender_number');


/* textlocal gateway variables */
$textlocal_username =$settings->get_option('ct_sms_textlocal_account_username');
$textlocal_hash_id = $settings->get_option('ct_sms_textlocal_account_hash_id');


/*NEED VARIABLE FOR EMAIL*/
$company_city = $settings->get_option('ct_company_city');
$company_state = $settings->get_option('ct_company_state');
$company_zip = $settings->get_option('ct_company_zip_code');
$company_country = $settings->get_option('ct_company_country');
$company_phone = strlen($settings->get_option('ct_company_phone')) < 6 ? "" : $settings->get_option('ct_company_phone');
$company_address = $settings->get_option('ct_company_address'); 

/*** complete checkout code ***/

/*  set admin name */
$get_admin_name_result = $objadminprofile->readone_adminname();
$get_admin_name = $get_admin_name_result[3];
if($get_admin_name == ""){
	$get_admin_name = "Admin";
}
$admin_email = $settings->get_option('ct_admin_optional_email');
/* set admin name */
/* set business logo and logo alt */
 if($settings->get_option('ct_company_logo') != null && $settings->get_option('ct_company_logo') != ""){
	$business_logo= SITE_URL.'assets/images/services/'.$settings->get_option('ct_company_logo');
	$business_logo_alt= $settings->get_option('ct_company_name');
}else{
	$business_logo= '';
	$business_logo_alt= $settings->get_option('ct_company_name');
}
/* set business logo and logo alt */

$client_phone = "";
if(isset($_SESSION['recurrence_booking_status']) && $_SESSION['recurrence_booking_status'] != ''){
	$recurrence_booking_status = $_SESSION['recurrence_booking_status'];
}else{
	$recurrence_booking_status = '';
}

if(isset($_SESSION['recurrence_booking_type']) && $_SESSION['recurrence_booking_type'] != ''){
	$recurrence_booking_type = $_SESSION['recurrence_booking_type'];
}else{
	$recurrence_booking_type = '';
}

if(isset($_SESSION['recurrence_end_date']) && $_SESSION['recurrence_end_date'] != ''){
	$recurrence_end_date = $_SESSION['recurrence_end_date'];
}else{
	$recurrence_end_date = '';
}

$lang = $settings->get_option("ct_language");
$label_language_values = array();
$language_label_arr = $settings->get_all_labelsbyid($lang);
if ($language_label_arr[1] != "" || $language_label_arr[3] != "" || $language_label_arr[4] != "" || $language_label_arr[5] != "" || $language_label_arr[6] != "")
{
	$default_language_arr = $settings->get_all_labelsbyid("en");
	if($language_label_arr[1] != ''){
		$label_decode_front = base64_decode($language_label_arr[1]);
	}else{
		$label_decode_front = base64_decode($default_language_arr[1]);
	}
	
	$label_decode_front_unserial = unserialize($label_decode_front);
    
	$label_language_values = array_merge($label_decode_front_unserial);
	
	foreach($label_language_values as $key => $value){
		$label_language_values[$key] = urldecode($value);
	}
}
else
{
    $default_language_arr = $settings->get_all_labelsbyid("en");
    
	$label_decode_front = base64_decode($default_language_arr[1]);
    
	
	$label_decode_front_unserial = unserialize($label_decode_front);
    
	$label_language_values = array_merge($label_decode_front_unserial);
	foreach($label_language_values as $key => $value){
		$label_language_values[$key] = urldecode($value);
	}
}

$english_date_array = array(
"January","Jan","February","Feb","March","Mar","April","Apr","May","June","Jun","July","Jul","August","Aug","September","Sep","October","Oct","November","Nov","December","Dec","Sun","Mon","Tue","Wed","Thu","Fri","Sat","su","mo","tu","we","th","fr","sa","AM","PM");
	$selected_lang_label = array(
ucfirst(strtolower($label_language_values['january'])),
ucfirst(strtolower($label_language_values['jan'])),
ucfirst(strtolower($label_language_values['february'])),
ucfirst(strtolower($label_language_values['feb'])),
ucfirst(strtolower($label_language_values['march'])),
ucfirst(strtolower($label_language_values['mar'])),
ucfirst(strtolower($label_language_values['april'])),
ucfirst(strtolower($label_language_values['apr'])),
ucfirst(strtolower($label_language_values['may'])),
ucfirst(strtolower($label_language_values['june'])),
ucfirst(strtolower($label_language_values['jun'])),
ucfirst(strtolower($label_language_values['july'])),
ucfirst(strtolower($label_language_values['jul'])),
ucfirst(strtolower($label_language_values['august'])),
ucfirst(strtolower($label_language_values['aug'])),
ucfirst(strtolower($label_language_values['september'])),
ucfirst(strtolower($label_language_values['sep'])),
ucfirst(strtolower($label_language_values['october'])),
ucfirst(strtolower($label_language_values['oct'])),
ucfirst(strtolower($label_language_values['november'])),
ucfirst(strtolower($label_language_values['nov'])),
ucfirst(strtolower($label_language_values['december'])),
ucfirst(strtolower($label_language_values['dec'])),
ucfirst(strtolower($label_language_values['sun'])),
ucfirst(strtolower($label_language_values['mon'])),
ucfirst(strtolower($label_language_values['tue'])),
ucfirst(strtolower($label_language_values['wed'])),
ucfirst(strtolower($label_language_values['thu'])),
ucfirst(strtolower($label_language_values['fri'])),
ucfirst(strtolower($label_language_values['sat'])),
ucfirst(strtolower($label_language_values['su'])),
ucfirst(strtolower($label_language_values['mo'])),
ucfirst(strtolower($label_language_values['tu'])),
ucfirst(strtolower($label_language_values['we'])),
ucfirst(strtolower($label_language_values['th'])),
ucfirst(strtolower($label_language_values['fr'])),
ucfirst(strtolower($label_language_values['sa'])),
strtoupper($label_language_values['am']),
strtoupper($label_language_values['pm']));

if(isset($_SESSION['ct_details']) && $_SESSION['ct_details']!=''){

	$t_zone_value = $settings->get_option('ct_timezone');
	$server_timezone = date_default_timezone_get();
	if(isset($t_zone_value) && $t_zone_value!=''){
		$offset= $first_step->get_timezone_offset($server_timezone,$t_zone_value);
		$timezonediff = $offset/3600;  
	}else{
		$timezonediff =0;
	}
	if(is_numeric(strpos($timezonediff,'-'))){
		$timediffmis = str_replace('-','',$timezonediff)*60;
		$currDateTime_withTZ= strtotime("-".$timediffmis." minutes",strtotime(date('Y-m-d H:i:s')));
	}else{
		$timediffmis = str_replace('+','',$timezonediff)*60;
		$currDateTime_withTZ = strtotime("+".$timediffmis." minutes",strtotime(date('Y-m-d H:i:s')));
	}
	
	$appointment_auto_confirm=$settings->get_option("ct_appointment_auto_confirm_status");
	if($appointment_auto_confirm=="Y"){
		$booking_status="C";
	}else{
		$booking_status="A";
	}
	
    $current_time = date('Y-m-d H:i:s',$currDateTime_withTZ);
    $coupon_code = $coupon->coupon_code=$_SESSION['ct_details']['coupon_code'];
    $result=$coupon->checkcode();

    if($result){
        $coupon->inc=$result['coupon_used']+1;
        $coupon_exp_date=strtotime($result['coupon_expiry']);
		$today = date("Y-m-d",$currDateTime_withTZ); 
        $curr_date=strtotime($today);

        if($result['coupon_used']<$result['coupon_limit'] && $curr_date<=$coupon_exp_date ){
            $coupon->update_coupon_limit();
        }
    }

    $freq_discount = '';
    if(isset($_SESSION['ct_details']['frequently_discount'])){
        $freq_discount = $_SESSION['ct_details']['frequently_discount'];
    }

    $zipcode='';
    if(isset($_SESSION['ct_details']['zipcode'])){
        $zipcode=$_SESSION['ct_details']['zipcode'];
    }
    $address='';
    if(isset($_SESSION['ct_details']['address'])){
        $address=$_SESSION['ct_details']['address'];
    }
    $city='';
    if(isset($_SESSION['ct_details']['city'])){
        $city=ucwords($_SESSION['ct_details']['city']);
    }

    $state='';
    if(isset($_SESSION['ct_details']['state'])){
        $state=ucwords($_SESSION['ct_details']['state']);
    }

    $notes='';
    if(isset($_SESSION['ct_details']['notes'])){
        $notes=$_SESSION['ct_details']['notes'];
    }

    $vc_status='';
    if(isset($_SESSION['ct_details']['vc_status'])){
        $vc_status=$_SESSION['ct_details']['vc_status'];
    }
	
	$staff_id='';
    if(isset($_SESSION['ct_details']['staff_id'])){
       $staff_id = $_SESSION['ct_details']['staff_id'];
    }
	
    $p_status='';
    if(isset($_SESSION['ct_details']['p_status'])){
        $p_status=$_SESSION['ct_details']['p_status'];
    }

    $contact_status='';
    if(isset($_SESSION['ct_details']['contact_status'])){
        $contact_status=mysqli_real_escape_string($conn,$_SESSION['ct_details']['contact_status']);
    }
	
	$contact_status_email=$_SESSION['ct_details']['contact_status'];

	if($last_order_id=='0' || $last_order_id==null){
			$orderid = 1000;
	}else{
			$orderid = $last_order_id+1;
	}
	$email_order_id = $orderid;
	
	$last_recurring_id=$order_client_info->last_recurring_id();
	if($last_recurring_id=='0' || $last_recurring_id==null){
		$rec_id = 1;
	}else{
		$rec_id = $last_recurring_id+1;
	}
  $booking_date_time = date("Y-m-d H:i:s", strtotime($_SESSION['ct_details']['booking_date_time']));
	
	$user->existing_username=$_SESSION['ct_details']['existing_username'];
	$user->existing_password=$_SESSION['ct_details']['existing_password'];
	$existing_login=$user->check_login();
	/** check and add booking for existing customer **/
	$client_id = 0;
	if($existing_login){
		$user->user_id=$existing_login[0];
		$user->user_pwd=$existing_login[2];
		$user->first_name=ucwords($_SESSION['ct_details']['firstname']);
		$user->last_name=ucwords($_SESSION['ct_details']['lastname']);
		$user->user_email=$existing_login[1];
		$user->phone=$_SESSION['ct_details']['phone'];
		$client_phone = $_SESSION['ct_details']['phone'];
		$user->address=$_SESSION['ct_details']['user_address'];
		$user->zip=$_SESSION['ct_details']['user_zipcode'];
		$user->city=ucwords($_SESSION['ct_details']['user_city']);
		$user->state=ucwords($_SESSION['ct_details']['user_state']);
		$user->notes=mysqli_real_escape_string($conn,$_SESSION['ct_details']['notes']);
		$user->vc_status=$_SESSION['ct_details']['vc_status'];
		$user->p_status=$_SESSION['ct_details']['p_status'];
		$user->status='E';
		$user->usertype=serialize(array('client'));
		$user->contact_status=mysqli_real_escape_string($conn,$_SESSION['ct_details']['contact_status']);
		$update_user=$user->update_user();
		if($update_user){
			$client_id = $user->user_id;
		}
	}
	else{
		/** check and add booking for new customer **/
		$user->user_pwd=md5($_SESSION['ct_details']['password']);
		$user->first_name=ucwords($_SESSION['ct_details']['firstname']);
		$user->last_name=ucwords($_SESSION['ct_details']['lastname']);
		$user->user_email=$_SESSION['ct_details']['email'];
		$user->phone=$_SESSION['ct_details']['phone'];
		$client_phone = $_SESSION['ct_details']['phone'];
		$user->address=$_SESSION['ct_details']['user_address'];
		$user->zip=$_SESSION['ct_details']['user_zipcode'];
		$user->city=ucwords($_SESSION['ct_details']['user_city']);
		$user->state=ucwords($_SESSION['ct_details']['user_state']);
		$user->notes=mysqli_real_escape_string($conn,$_SESSION['ct_details']['notes']);
		$user->vc_status=$_SESSION['ct_details']['vc_status'];
		$user->p_status=$_SESSION['ct_details']['p_status'];
		$user->status='E';
		$user->usertype=serialize(array('client'));
		$user->stripe_id="";
		$user->contact_status=mysqli_real_escape_string($conn,$_SESSION['ct_details']['contact_status']);
		$client_id = $add_user=$user->add_user();
	}
	
	if(count((array)$_SESSION["ct_cart"]) != 0) {
		if($_SESSION["ct_details"]["recurrence_booking_status"] == "Y"){
			$frequently_discount->id = $_SESSION["ct_details"]["frequently_discount"];
			$frequently_discount_detail = $frequently_discount->readone();
			$days = $frequently_discount_detail["days"];
			
			$cart_date_strtotime = strtotime($booking_date_time);
			$end_3_month_strtotime = strtotime("+3 months",$cart_date_strtotime);
			$cust_datediff = $end_3_month_strtotime - $cart_date_strtotime;
			$total_days = abs(floor($cust_datediff / (60 * 60 * 24)))+1;
			
			for($j=0;$j<$total_days;$j+=$days) {
				$booking_date_time = date("Y-m-d H:i:s",strtotime("+".$j." days",$cart_date_strtotime));
				$booking->order_id=$orderid;
				for($i=0;$i<(count((array)$_SESSION['ct_cart']['method']));$i++){
					$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
					if($_SESSION['ct_cart']["method"][$i]["type"] == "method_units"){
						$booking->client_id=$client_id;
						$booking->order_date=$current_time;
						$booking->booking_date_time=$booking_date_time;
						$booking->method_id=$_SESSION['ct_cart']['method'][$i]['method_id'];
						$booking->method_unit_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
						$booking->method_unit_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
						$booking->method_unit_qty_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
						$booking->booking_status=$booking_status;
						$booking->lastmodify=$current_time;
						$booking->read_status='U';
						$booking->staff_id= $staff_id;
						$add_booking=$booking->add_booking();
					}elseif($_SESSION['ct_cart']["method"][$i]["type"] == "addon"){
						$booking->addons_service_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
						$booking->addons_service_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
						$booking->addons_service_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
						$add_booking=$booking->add_addons_booking();
					}
				}
				
				$payment->order_id =$orderid;
				$payment->payment_method=$_SESSION['ct_details']['payment_method'];
				$payment->transaction_id=$transaction_id;
				$payment->payment_status ="Pending";
				$payment->amount=$_SESSION['ct_details']['amount'];
				$payment->discount=abs($_SESSION['ct_details']['coupon_discount']);
				$payment->taxes=$_SESSION['ct_details']['taxes'];
				$payment->partial_amount=$_SESSION['ct_details']['partial_amount'];
				if($j == 0){
					$payment->payment_date=$current_time;
				}else{
					$payment->payment_date=$booking_date_time;
				}
				$payment->lastmodify=$current_time;
				$payment->net_amount=$_SESSION['ct_details']['net_amount'];
				$payment->frequently_discount=$_SESSION['ct_details']['frequently_discount'];
				$payment->frequently_discount_amount=abs($_SESSION['ct_details']['frequent_discount_amount']);
				$payment->recurrence_status='Y';
				$add_payment=$payment->add_payments();
				
				$order_client_info->order_id=$orderid;
				$order_client_info->client_name=ucwords($_SESSION['ct_details']['firstname']).' '.ucwords($_SESSION['ct_details']['lastname']);
				$order_client_info->client_email=$_SESSION['ct_details']['email'];
				$order_client_info->client_phone=$_SESSION['ct_details']['phone'];
				$order_client_info->client_personal_info=base64_encode(serialize(array('zip'=>$zipcode,'address'=>$address,'city'=>$city,'state'=>$state,'notes'=>$notes,'vc_status'=>$vc_status,'p_status'=>$p_status,'contact_status'=>$contact_status)));
				$order_client_info->order_duration=$_SESSION['time_duration'];
				$order_client_info->recurring_id=$rec_id;
				$add_guest_user=$order_client_info->add_order_client();
				
				if($settings->get_option('ct_allow_multiple_booking_for_same_timeslot_status') == "N"){
					$count_j = $j+$days;
					$next_booking_date_time = date("Y-m-d H:i:s",strtotime("+".$count_j." days",$cart_date_strtotime));
					$check_for_booking_date_time = $booking->check_for_booking_date_time($next_booking_date_time,$staff_id);
					if(!$check_for_booking_date_time){
						$j+=$days;
						$booking_date_time = date("Y-m-d H:i:s",strtotime("+".$j." days",$cart_date_strtotime));
						$orderid++;
						continue;
					}
				}
				if($gc_hook->gc_purchase_status() == 'exist'){
					echo $gc_hook->gc_add_booking_ajax_hook();
					echo $gc_hook->gc_add_staff_booking_ajax_hook();
				}
				$orderid++;
			}
		}else{
			$booking->order_id=$orderid;
			for($i=0;$i<(count((array)$_SESSION['ct_cart']['method']));$i++){
				$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
				if($_SESSION['ct_cart']["method"][$i]["type"] == "method_units"){
					$booking->client_id=$client_id;
					$booking->order_date=$current_time;
					$booking->booking_date_time=$booking_date_time;
					$booking->method_id=$_SESSION['ct_cart']['method'][$i]['method_id'];
					$booking->method_unit_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
					$booking->method_unit_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
					$booking->method_unit_qty_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
					$booking->booking_status=$booking_status;
					$booking->lastmodify=$current_time;
					$booking->read_status='U';
					$booking->staff_id= $staff_id;
					$add_booking=$booking->add_booking();
				}elseif($_SESSION['ct_cart']["method"][$i]["type"] == "addon"){
					$booking->addons_service_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
					$booking->addons_service_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
					$booking->addons_service_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
					$add_booking=$booking->add_addons_booking();
				}
			}
			
			$payment->order_id =$orderid;
			$payment->payment_method=$_SESSION['ct_details']['payment_method'];
			$payment->transaction_id=$transaction_id;
			$payment->payment_status ="Pending";
			$payment->amount=$_SESSION['ct_details']['amount'];
			$payment->discount=abs($_SESSION['ct_details']['coupon_discount']);
			$payment->taxes=$_SESSION['ct_details']['taxes'];
			$payment->partial_amount=$_SESSION['ct_details']['partial_amount'];
			$payment->payment_date=$current_time;
			$payment->lastmodify=$current_time;
			$payment->net_amount=$_SESSION['ct_details']['net_amount'];
			$payment->frequently_discount=$_SESSION['ct_details']['frequently_discount'];
			$payment->frequently_discount_amount=abs($_SESSION['ct_details']['frequent_discount_amount']);
			$payment->recurrence_status='N';
			$add_payment=$payment->add_payments();
			
			$order_client_info->order_id=$orderid;
			$order_client_info->client_name=ucwords($_SESSION['ct_details']['firstname']).' '.ucwords($_SESSION['ct_details']['lastname']);
			$order_client_info->client_email=$_SESSION['ct_details']['email'];
			$order_client_info->client_phone=$_SESSION['ct_details']['phone'];
			$order_client_info->client_personal_info=base64_encode(serialize(array('zip'=>$zipcode,'address'=>$address,'city'=>$city,'state'=>$state,'notes'=>$notes,'vc_status'=>$vc_status,'p_status'=>$p_status,'contact_status'=>$contact_status)));
			$order_client_info->order_duration=$_SESSION['time_duration'];
			$order_client_info->recurring_id=$rec_id;
			$add_guest_user=$order_client_info->add_order_client();
			if($gc_hook->gc_purchase_status() == 'exist'){
				echo $gc_hook->gc_add_booking_ajax_hook();
				echo $gc_hook->gc_add_staff_booking_ajax_hook();
			}
		}
	}
	
	$orderid = $email_order_id;
    /*** Email Code Start ***/
    $admin_infoo = $order_client_info->readone_for_email();
    for($i=0;$i<(count((array)$_SESSION['ct_cart']['method']));$i++){
        $service->id = $_SESSION['ct_cart']['method'][$i]['service_id'];
        $service_name = $service->get_service_name_for_mail();
        /* methods */
        $units = "None";
        $methodname="None";
        $hh = $booking->get_methods_ofbookings($orderid);
        $count_methods = mysqli_num_rows($hh);
        $hh1 = $booking->get_methods_ofbookings($orderid);

        if($count_methods > 0){
            while($jj = mysqli_fetch_array($hh1)){
                if($units == "None"){
                    $units = $jj['units_title']."-".$jj['qtys'];
                }
                else
                {
                    $units = $units.",".$jj['units_title']."-".$jj['qtys'];
                }
                $methodname = $jj['method_title'];
            }
        }
		
		/* ADDONS */
        $addons = "None";
        $hh = $booking->get_addons_ofbookings($orderid);
        while($jj = mysqli_fetch_array($hh)){
            if($addons == "None"){
                $addons = $jj['addon_service_name']."-".$jj['addons_service_qty'];
            }
            else
            {
                $addons = $addons.",".$jj['addon_service_name']."-".$jj['addons_service_qty'];
            }
        }
    }
	if($company_name == ""){
		$company_name = $settings->get_option('ct_company_name');
	}
	$setting_date_format = $settings->get_option('ct_date_picker_date_format');
	$setting_time_format = $settings->get_option('ct_time_format');
	
	$booking_date = str_replace($english_date_array,$selected_lang_label,date($setting_date_format,strtotime($_SESSION['ct_details']['booking_date_time'])));
	if($setting_time_format == 12){
		$booking_time = str_replace($english_date_array,$selected_lang_label,date("h:i A",strtotime($_SESSION['ct_details']['booking_date_time'])));
	}
	else{
		$booking_time = date("H:i", strtotime($_SESSION['ct_details']['booking_date_time']));
	}
	$price = $general->ct_price_format($_SESSION['ct_details']['net_amount'],$symbol_position,$decimal);
	
	/* staff details */
	$get_staff_name = "";
	$get_staff_email = "";
	$staff_phone = "";
	if(isset($staff_id) && !empty($staff_id))
	{
		$objadminprofile->id = $staff_id;
		$staff_details = $objadminprofile->readone();
		$get_staff_name = $staff_details["fullname"];
		$get_staff_email = $staff_details["email"];
		$staff_phone = $staff_details["phone"];
	}
	
	$c_address = $_SESSION['ct_details']['address'];
	$client_city = $_SESSION['ct_details']['city'];
	$client_state = $_SESSION['ct_details']['state'];
	$client_zip = $_SESSION['ct_details']['zipcode'];
	
    $client_email = $_SESSION['ct_details']['email'];
	if(isset($_SESSION['ct_details']['email']) &&  $_SESSION['ct_details']['email']==''){		$client_email = $_SESSION['ct_details']['existing_username'];	}

    $subject = ucwords($service_name)." on ".$booking_date;
	if($admin_email == ""){
		$admin_email = $admin_infoo['email'];
    }
  
    if($vc_status == "Y"){
        $vc_status_v = "Yes";
    }
    elseif($vc_status == "N"){
        $vc_status_v = "No";
    }
    else{
        $vc_status_v = "N/A";
    }
    if($p_status == "Y"){
        $p_status_v = "Yes";
    }
    elseif($p_status == "N"){
        $p_status_v = "No";
    }
    else{
        $p_status_v = "N/A";
    }
    if($_SESSION['ct_details']['email'] != ""){
        $cemail = $_SESSION['ct_details']['email'];
    }
    elseif($_SESSION['ct_details']['existing_username'] != ""){
        $cemail = $_SESSION['ct_details']['existing_username'];
    }

    if($appointment_auto_confirm=="Y"){
		$email_template->email_template_type = 'C';
	}else{
		$email_template->email_template_type = 'A';
	}
    /* $email_template->email_template_type = 'A'; */ 
    $clientemailtemplate = $email_template->readone_client_email_template();

    if($clientemailtemplate['email_message'] != ''){
        $clienttemplate = base64_decode($clientemailtemplate['email_message']);
    }else{
        $clienttemplate = base64_decode($clientemailtemplate['default_message']);
    }

    if($appointment_auto_confirm=="Y"){
			$email_template->email_template_type = 'C';
		}else{
			$email_template->email_template_type = 'A';
		}
    $adminemailtemplate = $email_template->readone_admin_email_template();
    if($adminemailtemplate['email_message'] != ''){
        $admintemplate = base64_decode($adminemailtemplate['email_message']);
    }else{
        $admintemplate = base64_decode($adminemailtemplate['default_message']);
    }
	
		$staffemailtemplate = $email_template->readone_staff_email_template();

    if($staffemailtemplate['email_message'] != ''){
        $stafftemplate = base64_decode($staffemailtemplate['email_message']);
    }else{
        $stafftemplate = base64_decode($staffemailtemplate['default_message']);
    }	
	
	
	$client_phone_info="";
	$client_phone_no="";
	$client_phone_length="";
	$client_first_name="";
	$client_last_name="";
	$client_fname="";
	$client_lname="";
	$email_notes="";
	$client_notes="";



	$client_phone_no = $_SESSION['ct_details']['phone'];
	$client_phone_length = strlen($client_phone_no);
			
	if($client_phone_length > 6){
		$client_phone_info = $client_phone_no;
	}else{
		$client_phone_info = "N/A";
	}
	
	$client_first_name = ucwords(stripslashes($_SESSION['ct_details']['firstname']));
	$client_last_name =	ucwords(stripslashes($_SESSION['ct_details']['lastname']));
	
	if($client_first_name=="" && $client_last_name==""){
		$client_fname = "User";
		$client_lname = "";
		$client_name = $client_fname.' '.$client_lname;
	}elseif($client_first_name!="" && $client_last_name!=""){
		$client_fname = $client_first_name;
		$client_lname = $client_last_name;
		$client_name = $client_fname.' '.$client_lname;
	}elseif($client_first_name!=""){
		$client_fname = $client_first_name;
		$client_lname = "";
		$client_name = $client_fname.' '.$client_lname;
	}elseif($client_last_name!=""){
		$client_fname = "";
		$client_lname = $client_last_name;
		$client_name = $client_fname.' '.$client_lname;
	}
	$client_notes = stripslashes($notes);	
	if($client_notes==""){
		$client_notes = "N/A";
	}	
	
	$contact_status_cont = $contact_status_email;	
	if($contact_status_cont==""){
		$contact_status_cont = "N/A";
	}

	$payment_method = $_SESSION['ct_details']['payment_method'];
	if($payment_method == "pay at venue"){
		$payment_method = ucwords($label_language_values['pay_locally']);
	}else{
		$payment_method = ucwords($payment_method);
	}	
	
  $searcharray = array('{{service_name}}','{{booking_date}}','{{business_logo}}','{{business_logo_alt}}','{{client_name}}','{{methodname}}','{{units}}','{{addons}}','{{firstname}}','{{lastname}}','{{client_email}}','{{phone}}','{{payment_method}}','{{vaccum_cleaner_status}}','{{parking_status}}','{{notes}}','{{contact_status}}','{{admin_name}}','{{price}}','{{address}}','{{app_remain_time}}','{{reject_status}}','{{company_name}}','{{booking_time}}','{{client_city}}','{{client_state}}','{{client_zip}}','{{company_city}}','{{company_state}}','{{company_zip}}','{{company_country}}','{{company_phone}}','{{company_email}}','{{company_address}}','{{admin_name}}','{{staff_name}}','{{staff_email}}','{{client_promocode}}');

	$replacearray = array($service_name, $booking_date , $business_logo, $business_logo_alt, stripslashes($client_name), $methodname, $units, $addons,$client_fname ,$client_lname , $cemail,$client_phone_info, ucwords($_SESSION['ct_details']['payment_method']), $vc_status_v, $p_status_v,$client_notes, $contact_status_cont,$get_admin_name,$price,stripslashes($c_address),'','',$company_name,$booking_time,stripslashes($client_city),stripslashes($client_state),$client_zip,stripslashes($company_city),stripslashes($company_state),$company_zip,$company_country,$company_phone,$company_email,stripslashes($company_address),stripslashes($get_admin_name),stripslashes($get_staff_name),stripslashes($get_staff_email),stripslashes($coupon_code));

    if($settings->get_option('ct_client_email_notification_status') == 'Y' && $clientemailtemplate['email_template_status'] == 'E'){
       $client_email_body = str_replace($searcharray,$replacearray,$clienttemplate);
        if($settings->get_option('ct_smtp_hostname') != '' && $settings->get_option('ct_email_sender_name') != '' && $settings->get_option('ct_email_sender_address') != '' && $settings->get_option('ct_smtp_username') != '' && $settings->get_option('ct_smtp_password') != '' && $settings->get_option('ct_smtp_port') != ''){
            $mail->IsSMTP();
        }else{
            $mail->IsMail();
        }
        $mail->SMTPDebug  = 0;
        $mail->IsHTML(true);
        $mail->From = $company_email;
        $mail->FromName = $company_name;
        $mail->Sender = $company_email;
        $mail->AddAddress($client_email, $client_name);
        $mail->Subject = $subject;
        $mail->Body = $client_email_body;
        $mail->send();
		$mail->ClearAllRecipients();

    }		
    if($settings->get_option('ct_admin_email_notification_status') == 'Y' && $adminemailtemplate['email_template_status'] == 'E'){							
        $admin_email_body = str_replace($searcharray,$replacearray,$admintemplate);
        if($settings->get_option('ct_smtp_hostname') != '' && $settings->get_option('ct_email_sender_name') != '' && $settings->get_option('ct_email_sender_address') != '' && $settings->get_option('ct_smtp_username') != '' && $settings->get_option('ct_smtp_password') != '' && $settings->get_option('ct_smtp_port') != ''){
            $mail_a->IsSMTP();
        }else{
            $mail_a->IsMail();
        }
        $mail_a->SMTPDebug  = 0;
        $mail_a->IsHTML(true);
        $mail_a->From = $company_email;
        $mail_a->FromName = $company_name;
        $mail_a->Sender = $company_email;
        $mail_a->AddAddress($admin_email, $get_admin_name);
        $mail_a->Subject = $subject;
        $mail_a->Body = $admin_email_body;
        $mail_a->send();
				$mail_a->ClearAllRecipients();

    }
		
		if($settings->get_option('ct_staff_email_notification_status') == 'Y' && $adminemailtemplate['email_template_status'] == 'E'){							
        $staff_email_body = str_replace($searcharray,$replacearray,$stafftemplate);
        if($settings->get_option('ct_smtp_hostname') != '' && $settings->get_option('ct_email_sender_name') != '' && $settings->get_option('ct_email_sender_address') != '' && $settings->get_option('ct_smtp_username') != '' && $settings->get_option('ct_smtp_password') != '' && $settings->get_option('ct_smtp_port') != ''){
            $mail_a->IsSMTP();
        }else{
            $mail_a->IsMail();
        }
        $mail_a->SMTPDebug  = 0;
        $mail_a->IsHTML(true);
        $mail_a->From = $company_email;
        $mail_a->FromName = $company_name;
        $mail_a->Sender = $company_email;
        $mail_a->AddAddress($get_staff_email, $get_staff_name);
        $mail_a->Subject = $subject;
        $mail_a->Body = $staff_email_body;
        $mail_a->send();
				$mail_a->ClearAllRecipients();

    }

    /*** Email Code End ***/
	 /*SMS SENDING CODE*/
    /*GET APPROVED SMS TEMPLATE*/
	/* TEXTLOCAL CODE */
	if($settings->get_option('ct_sms_textlocal_status') == "Y")
	{
		if($settings->get_option('ct_sms_textlocal_send_sms_to_client_status') == "Y"){
			$template = $objdashboard->gettemplate_sms("A",'C');
			$phone = $client_phone;				
			if($template[4] == "E") {
				if($template[2] == ""){
					$message = base64_decode($template[3]);
				}
				else{
					$message = base64_decode($template[2]);
				}
			}
			$message = str_replace($searcharray,$replacearray,$message);
			$data = "username=".$textlocal_username."&hash=".$textlocal_hash_id."&message=".$message."&numbers=".$phone."&test=0";
			$ch = curl_init('http://api.textlocal.in/send/?');
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$result = curl_exec($ch);
			curl_close($ch);
		}
		if($settings->get_option('ct_sms_textlocal_send_sms_to_admin_status') == "Y"){
			$template = $objdashboard->gettemplate_sms("A",'A');
			$phone = $settings->get_option('ct_sms_textlocal_admin_phone');;				
			if($template[4] == "E") {
				if($template[2] == ""){
					$message = base64_decode($template[3]);
				}
				else{
					$message = base64_decode($template[2]);
				}
			}
			$message = str_replace($searcharray,$replacearray,$message);
			$data = "username=".$textlocal_username."&hash=".$textlocal_hash_id."&message=".$message."&numbers=".$phone."&test=0";
			$ch = curl_init('http://api.textlocal.in/send/?');
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$result = curl_exec($ch);
			curl_close($ch);
		}
		
		if($settings->get_option('ct_sms_textlocal_send_sms_to_staff_status') == "Y"){
			if(isset($staff_phone) && !empty($staff_phone))
			{
				$template = $objdashboard->gettemplate_sms("A",'S');
				$phone = $staff_phone;				
				if($template[4] == "E") {
					if($template[2] == ""){
						$message = base64_decode($template[3]);
					}
					else{
						$message = base64_decode($template[2]);
					}
				}
				$message = str_replace($searcharray,$replacearray,$message);
				$data = "username=".$textlocal_username."&hash=".$textlocal_hash_id."&message=".$message."&numbers=".$phone."&test=0";
				$ch = curl_init('http://api.textlocal.in/send/?');
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$result = curl_exec($ch);
				curl_close($ch);
			}
		}
	}
    /*PLIVO CODE*/
	if($settings->get_option('ct_sms_plivo_status')=="Y"){
	   
	   if($settings->get_option('ct_sms_plivo_send_sms_to_client_status') == "Y"){
			$auth_id = $settings->get_option('ct_sms_plivo_account_SID');
			$auth_token = $settings->get_option('ct_sms_plivo_auth_token');
			$p_client = new Plivo\RestAPI($auth_id, $auth_token, '', '');

			$template = $objdashboard->gettemplate_sms("A",'C');
			$phone = $client_phone;
			if($template[4] == "E"){
				if($template[2] == ""){
					$message = base64_decode($template[3]);
				}
				else{
					$message = base64_decode($template[2]);
				}
				$client_sms_body = str_replace($searcharray,$replacearray,$message);
				/* MESSAGE SENDING CODE THROUGH PLIVO */
				$params = array(
					'src' => $plivo_sender_number,
					'dst' => $phone,
					'text' => $client_sms_body,
					'method' => 'POST'
				);
				$response = $p_client->send_message($params);
				echo $response;
				/* MESSAGE SENDING CODE ENDED HERE*/
			}
		}
		if($settings->get_option('ct_sms_plivo_send_sms_to_admin_status') == "Y"){
			$auth_id = $settings->get_option('ct_sms_plivo_account_SID');
			$auth_token = $settings->get_option('ct_sms_plivo_auth_token');
			$p_admin = new Plivo\RestAPI($auth_id, $auth_token, '', '');
			$admin_phone = $settings->get_option('ct_sms_plivo_admin_phone_number');
			$template = $objdashboard->gettemplate_sms("A",'A');
			
			if($template[4] == "E") {
				if($template[2] == ""){
					$message = base64_decode($template[3]);
				}
				else{
					$message = base64_decode($template[2]);
				}
				$client_sms_body = str_replace($searcharray,$replacearray,$message);
				$params = array(
					'src' => $plivo_sender_number,
					'dst' => $admin_phone,
					'text' => $client_sms_body,
					'method' => 'POST'
				);
				$response = $p_admin->send_message($params);
				echo $response;
				/* MESSAGE SENDING CODE ENDED HERE*/
			}
		}
		
		if($settings->get_option('ct_sms_plivo_send_sms_to_staff_status') == "Y"){
			if(isset($staff_phone) && !empty($staff_phone))
			{	
				$auth_id = $settings->get_option('ct_sms_plivo_account_SID');
				$auth_token = $settings->get_option('ct_sms_plivo_auth_token');
				$p_client = new Plivo\RestAPI($auth_id, $auth_token, '', '');

				$template = $objdashboard->gettemplate_sms("A",'S');
				$phone = $staff_phone;
				if($template[4] == "E"){
					if($template[2] == ""){
						$message = base64_decode($template[3]);
					}
					else{
						$message = base64_decode($template[2]);
					}
					$client_sms_body = str_replace($searcharray,$replacearray,$message);
					/* MESSAGE SENDING CODE THROUGH PLIVO */
					$params = array(
						'src' => $plivo_sender_number,
						'dst' => $phone,
						'text' => $client_sms_body,
						'method' => 'POST'
					);
					$response = $p_client->send_message($params);
					echo $response;
					/* MESSAGE SENDING CODE ENDED HERE*/
				}
			}
		}
	}
	if($settings->get_option('ct_sms_twilio_status') == "Y"){
		if($settings->get_option('ct_sms_twilio_send_sms_to_client_status') == "Y"){
			$AccountSid = $settings->get_option('ct_sms_twilio_account_SID');
			$AuthToken =  $settings->get_option('ct_sms_twilio_auth_token'); 
			$twilliosms_client = new Services_Twilio($AccountSid, $AuthToken);

			$template = $objdashboard->gettemplate_sms("A",'C');
			$phone = $client_phone;
			if($template[4] == "E") {
				if($template[2] == ""){
					$message = base64_decode($template[3]);
				}
				else{
					$message = base64_decode($template[2]);
				}
				$client_sms_body = str_replace($searcharray,$replacearray,$message);
				/*TWILIO CODE*/
				$message = $twilliosms_client->account->messages->create(array(
					"From" => $twilio_sender_number,
					"To" => $phone,
					"Body" => $client_sms_body));
			}
		}
		if($settings->get_option('ct_sms_twilio_send_sms_to_admin_status') == "Y"){
			$AccountSid = $settings->get_option('ct_sms_twilio_account_SID');
			$AuthToken =  $settings->get_option('ct_sms_twilio_auth_token'); 
			$twilliosms_admin = new Services_Twilio($AccountSid, $AuthToken);
			$admin_phone = $settings->get_option('ct_sms_twilio_admin_phone_number');
			$template = $objdashboard->gettemplate_sms("A",'A');
			if($template[4] == "E") {
				if($template[2] == ""){
					$message = base64_decode($template[3]);
				}
				else{
					$message = base64_decode($template[2]);
				}
				$client_sms_body = str_replace($searcharray,$replacearray,$message);
				/*TWILIO CODE*/
				$message = $twilliosms_admin->account->messages->create(array(
					"From" => $twilio_sender_number,
					"To" => $admin_phone,
					"Body" => $client_sms_body));
			}
		}
		
		if($settings->get_option('ct_sms_twilio_send_sms_to_staff_status') == "Y"){
			if(isset($staff_phone) && !empty($staff_phone))
			{	
				$AccountSid = $settings->get_option('ct_sms_twilio_account_SID');
				$AuthToken =  $settings->get_option('ct_sms_twilio_auth_token'); 
				$twilliosms_client = new Services_Twilio($AccountSid, $AuthToken);

				$template = $objdashboard->gettemplate_sms("A",'S');
				$phone = $staff_phone;
				if($template[4] == "E") {
					if($template[2] == ""){
						$message = base64_decode($template[3]);
					}
					else{
						$message = base64_decode($template[2]);
					}
					$client_sms_body = str_replace($searcharray,$replacearray,$message);
					/*TWILIO CODE*/
					$message = $twilliosms_client->account->messages->create(array(
						"From" => $twilio_sender_number,
						"To" => $phone,
						"Body" => $client_sms_body));
				}
			}
		}
	}
	if($settings->get_option('ct_nexmo_status') == "Y"){
		if($settings->get_option('ct_sms_nexmo_send_sms_to_client_status') == "Y"){
			$template = $objdashboard->gettemplate_sms("A",'C');
			$phone = $client_phone;				
			if($template[4] == "E") {
				if($template[2] == ""){
					$message = base64_decode($template[3]);
				}
				else{
					$message = base64_decode($template[2]);
				}
				$ct_nexmo_text = str_replace($searcharray,$replacearray,$message);
				$res=$nexmo_client->send_nexmo_sms($phone,$ct_nexmo_text);
			}
			
		}
		if($settings->get_option('ct_sms_nexmo_send_sms_to_admin_status') == "Y"){
			$template = $objdashboard->gettemplate_sms("A",'A');
			$phone = $settings->get_option('ct_sms_nexmo_admin_phone_number');				
			if($template[4] == "E") {
				if($template[2] == ""){
					$message = base64_decode($template[3]);
				}
				else{
					$message = base64_decode($template[2]);
				}
				$ct_nexmo_text = str_replace($searcharray,$replacearray,$message);
				$res=$nexmo_admin->send_nexmo_sms($phone,$ct_nexmo_text);
			}
			
		}
		
		if($settings->get_option('ct_sms_nexmo_send_sms_to_staff_status') == "Y"){
			if(isset($staff_phone) && !empty($staff_phone))
			{
				$template = $objdashboard->gettemplate_sms("A",'S');
				$phone = $staff_phone;				
				if($template[4] == "E") {
					if($template[2] == ""){
						$message = base64_decode($template[3]);
					}
					else{
						$message = base64_decode($template[2]);
					}
					$ct_nexmo_text = str_replace($searcharray,$replacearray,$message);
					$res=$nexmo_client->send_nexmo_sms($phone,$ct_nexmo_text);
				}
			}
		}
	}
    /*SMS SENDING CODE END*/
   echo 'ok';
}
?>