<?php 
session_start();
include_once(dirname(dirname(dirname(__FILE__))).'/header.php');	
include(dirname(dirname(dirname(__FILE__))).'/objects/class_connection.php');
include(dirname(dirname(dirname(__FILE__))).'/objects/class_booking.php');
include(dirname(dirname(dirname(__FILE__))).'/objects/class_services.php');
include(dirname(dirname(dirname(__FILE__))).'/objects/class_users.php');
include(dirname(dirname(dirname(__FILE__))).'/objects/class_setting.php');
include(dirname(dirname(dirname(__FILE__))).'/objects/class.phpmailer.php');
include(dirname(dirname(dirname(__FILE__))).'/objects/class_front_first_step.php');
include(dirname(dirname(dirname(__FILE__)))."/objects/class_adminprofile.php");
include(dirname(dirname(dirname(__FILE__))).'/objects/class_userdetails.php');
include(dirname(dirname(dirname(__FILE__))).'/objects/class_email_template.php');
include(dirname(dirname(dirname(__FILE__)))."/objects/class_dashboard.php");
include(dirname(dirname(dirname(__FILE__))).'/objects/class_general.php');
include(dirname(dirname(dirname(__FILE__))).'/objects/class_payments.php');
include(dirname(dirname(dirname(__FILE__))).'/objects/class_order_client_info.php');
include(dirname(dirname(dirname(__FILE__))).'/objects/class_nexmo.php');
include(dirname(dirname(dirname(__FILE__)))."/objects/class_gc_hook.php");
include(dirname(dirname(dirname(__FILE__)))."/objects/class_frequently_discount.php");

$con = new cleanto_db();
$conn = $con->connect();
	
$first_step=new cleanto_first_step();
$first_step->conn=$conn;

$bookings=new cleanto_booking();
$bookings->conn=$conn;

$booking=new cleanto_booking();
$booking->conn=$conn;

$service=new cleanto_services();
$service->conn=$conn;

$setting=new cleanto_setting();
$setting->conn=$conn;

$settings=new cleanto_setting();
$settings->conn=$conn;

$user=new cleanto_users();
$user->conn=$conn;

$gc_hook = new cleanto_gcHook();
$gc_hook->conn = $conn;

$nexmo_admin = new cleanto_ct_nexmo();
$nexmo_client = new cleanto_ct_nexmo();

$objadminprofile = new cleanto_adminprofile();
$objadminprofile->conn = $conn;

$objuserdetails = new cleanto_userdetails();
$objuserdetails->conn=$conn;

$emailtemplate=new cleanto_email_template();
$emailtemplate->conn=$conn;

$objdashboard = new cleanto_dashboard();
$objdashboard->conn = $conn;

$general=new cleanto_general();
$general->conn=$conn;

$objpayment = new cleanto_payments();
$objpayment->conn = $conn;

$objocinfo = new cleanto_order_client_info();
$objocinfo->conn = $conn;

$objfreqdis = new cleanto_frequently_discount();
$objfreqdis->conn = $conn;

$lang = $setting->get_option("ct_language");
$label_language_values = array();
$language_label_arr = $setting->get_all_labelsbyid($lang);

if ($language_label_arr[1] != "" || $language_label_arr[3] != "" || $language_label_arr[4] != "" || $language_label_arr[5] != "")
{
	$default_language_arr = $setting->get_all_labelsbyid("en");
	if($language_label_arr[1] != ''){
		$label_decode_front = base64_decode($language_label_arr[1]);
	}else{
		$label_decode_front = base64_decode($default_language_arr[1]);
	}
	if($language_label_arr[3] != ''){
		$label_decode_admin = base64_decode($language_label_arr[3]);
	}else{
		$label_decode_admin = base64_decode($default_language_arr[3]);
	}
	if($language_label_arr[4] != ''){
		$label_decode_error = base64_decode($language_label_arr[4]);
	}else{
		$label_decode_error = base64_decode($default_language_arr[4]);
	}
	if($language_label_arr[5] != ''){
		$label_decode_extra = base64_decode($language_label_arr[5]);
	}else{
		$label_decode_extra = base64_decode($default_language_arr[5]);
	}
	
  $label_decode_front_unserial = unserialize($label_decode_front);
	$label_decode_admin_unserial = unserialize($label_decode_admin);
	$label_decode_error_unserial = unserialize($label_decode_error);
	$label_decode_extra_unserial = unserialize($label_decode_extra);
    
	$label_language_arr = array_merge($label_decode_front_unserial,$label_decode_admin_unserial,$label_decode_error_unserial,$label_decode_extra_unserial);
	foreach($label_language_arr as $key => $value){
		$label_language_values[$key] = urldecode($value);
	}
}
else
{
  $default_language_arr = $setting->get_all_labelsbyid("en");
	
	$label_decode_front = base64_decode($default_language_arr[1]);
	$label_decode_admin = base64_decode($default_language_arr[3]);
	$label_decode_error = base64_decode($default_language_arr[4]);
	$label_decode_extra = base64_decode($default_language_arr[5]);
	
	$label_decode_front_unserial = unserialize($label_decode_front);
	$label_decode_admin_unserial = unserialize($label_decode_admin);
	$label_decode_error_unserial = unserialize($label_decode_error);   
	$label_decode_extra_unserial = unserialize($label_decode_extra);   
	
	$label_language_arr = array_merge($label_decode_front_unserial,$label_decode_admin_unserial,$label_decode_error_unserial,$label_decode_extra_unserial);
	foreach($label_language_arr as $key => $value){
		$label_language_values[$key] = urldecode($value);
	}
}
/*new file include*/
include(dirname(dirname(dirname(__FILE__))).'/assets/lib/date_translate_array.php');

if($setting->get_option('ct_smtp_authetication') == 'true'){
	$mail_SMTPAuth = '1';
	if($setting->get_option('ct_smtp_hostname') == "smtp.gmail.com"){
		$mail_SMTPAuth = 'Yes';
	}
	
}else{
	$mail_SMTPAuth = '0';
	if($setting->get_option('ct_smtp_hostname') == "smtp.gmail.com"){
		$mail_SMTPAuth = 'No';
	}
}

$mail = new cleanto_phpmailer();
$mail->Host = $setting->get_option('ct_smtp_hostname');
$mail->Username = $setting->get_option('ct_smtp_username');
$mail->Password = $setting->get_option('ct_smtp_password');
$mail->Port = $setting->get_option('ct_smtp_port');
$mail->SMTPSecure = $setting->get_option('ct_smtp_encryption');
$mail->SMTPAuth = $mail_SMTPAuth;
$mail->CharSet = "UTF-8";

$mail_a = new cleanto_phpmailer();
$mail_a->Host = $setting->get_option('ct_smtp_hostname');
$mail_a->Username = $setting->get_option('ct_smtp_username');
$mail_a->Password = $setting->get_option('ct_smtp_password');
$mail_a->Port = $setting->get_option('ct_smtp_port');
$mail_a->SMTPSecure = $setting->get_option('ct_smtp_encryption');
$mail_a->SMTPAuth = $mail_SMTPAuth;
$mail_a->CharSet = "UTF-8";

/*NEXMO SMS GATEWAY VARIABLES*/

$nexmo_admin->ct_nexmo_api_key = $setting->get_option('ct_nexmo_api_key');
$nexmo_admin->ct_nexmo_api_secret = $setting->get_option('ct_nexmo_api_secret');
$nexmo_admin->ct_nexmo_from = $setting->get_option('ct_nexmo_from');

$nexmo_client->ct_nexmo_api_key = $setting->get_option('ct_nexmo_api_key');
$nexmo_client->ct_nexmo_api_secret = $setting->get_option('ct_nexmo_api_secret');
$nexmo_client->ct_nexmo_from = $setting->get_option('ct_nexmo_from');

/*SMS GATEWAY VARIABLES*/
$plivo_sender_number = $setting->get_option('ct_sms_plivo_sender_number');
$twilio_sender_number = $setting->get_option('ct_sms_twilio_sender_number');


/* textlocal gateway variables */
$textlocal_username =$setting->get_option('ct_sms_textlocal_account_username');
$textlocal_hash_id = $setting->get_option('ct_sms_textlocal_account_hash_id');

$company_city = $setting->get_option('ct_company_city');
$company_state = $setting->get_option('ct_company_state');
$company_zip = $setting->get_option('ct_company_zip_code');
$company_country = $setting->get_option('ct_company_country');
$company_phone = strlen($setting->get_option('ct_company_phone')) < 6 ? "" : $setting->get_option('ct_company_phone'); 
$company_email = $setting->get_option('ct_company_email'); 
$company_address = $setting->get_option('ct_company_address');

$date_format=$setting->get_option('ct_date_picker_date_format');
$time_format = $setting->get_option('ct_time_format');

$symbol_position=$setting->get_option('ct_currency_symbol_position');
$decimal=$setting->get_option('ct_price_format_decimal_places');

$admin_email = $setting->get_option('ct_admin_optional_email');

if($setting->get_option('ct_company_logo') != null && $setting->get_option('ct_company_logo') != ""){
	$business_logo= SITE_URL.'assets/images/services/'.$setting->get_option('ct_company_logo');
	$business_logo_alt= $setting->get_option('ct_company_name');
}else{
	$business_logo= '';
	$business_logo_alt= $setting->get_option('ct_company_name');
}
	
$t_zone_value = $setting->get_option('ct_timezone');
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
$current_time = date("Y-m-d H:i:s",$currDateTime_withTZ);

$book_details=$bookings->email_reminder();

while($e_reminder = mysqli_fetch_array($book_details)){
	$bookings->booking_id=$e_reminder['id'];
	$binfo = $bookings->readone();
	$booking_start_datetime=strtotime(date('Y-m-d H:i:s',strtotime($e_reminder['booking_date_time'])));
	$email_reminder_time=$setting->get_option('ct_email_appointment_reminder_buffer');
	
	$current_times = date('Y-m-d H:i:s',$currDateTime_withTZ);
	$current_time = strtotime($current_times);
	$remain_times=$booking_start_datetime - $current_time;
	$time_in_min=round($remain_times / 60 );
	
	$orderdetail = $objdashboard->getclientorder($binfo[1]);
	$clientdetail = $objdashboard->clientemailsender($binfo[1]);
	
	$admin_company_name = $setting->get_option('ct_company_name');
	$setting_date_format = $setting->get_option('ct_date_picker_date_format');
	$setting_time_format = $setting->get_option('ct_time_format');
	$booking_date = date($setting_date_format, strtotime($clientdetail['booking_date_time']));
	if($setting_time_format == 12){
		$booking_time = str_replace($english_date_array,$selected_lang_label,date("h:i A",strtotime($clientdetail['booking_date_time'])));
	}
	else{
		$booking_time = date("H:i", strtotime($clientdetail['booking_date_time']));
	}
	$company_name = $setting->get_option('ct_email_sender_name');
	$company_email = $setting->get_option('ct_email_sender_address');
	$service_name = $clientdetail['title'];
	
	if($admin_email == ""){
		$admin_email = $clientdetail['email'];	
	}
	
	$get_admin_name_result = $objadminprofile->readone_adminname();
	$get_admin_name = $get_admin_name_result[3];
	if($get_admin_name == ""){
		$get_admin_name = "Admin";
	}
	$price=$general->ct_price_format($orderdetail[2],$symbol_position,$decimal);

	/* methods */
	$units = 'none';
	$methodname='none';
	$hh = $booking->get_methods_ofbookings($orderdetail[4]);
	$count_methods = mysqli_num_rows($hh);
	$hh1 = $booking->get_methods_ofbookings($orderdetail[4]);

	if($count_methods > 0){
		while($jj = mysqli_fetch_array($hh1)){
			if($units == 'none'){
				$units = $jj['units_title']."-".$jj['qtys'];
			}
			else
			{
				$units = $units.",".$jj['units_title']."-".$jj['qtys'];
			}
			$methodname = $jj['method_title'];
		}
	}

	/* Add ons */
	$addons = 'none';
	$hh = $booking->get_addons_ofbookings($orderdetail[4]);
	while($jj = mysqli_fetch_array($hh)){
		if($addons == 'none'){
			$addons = $jj['addon_service_name']."-".$jj['addons_service_qty'];
		}
		else
		{
			$addons = $addons.",".$jj['addon_service_name']."-".$jj['addons_service_qty'];
		}
	}
	
	/* Guest user */
	if($orderdetail[4]==0)
	{
		$gc  = $objdashboard->getguestclient($orderdetail[4]);
		$temppp= unserialize(base64_decode($gc[5]));
		$temp = str_replace('\\','',$temppp);
		$vc_status = $temp['vc_status'];
		if($vc_status == 'N'){
			$final_vc_status = 'no';
		}
		elseif($vc_status == 'Y'){
			$final_vc_status = 'yes';
		}else{
			$final_vc_status = "N/A";
		}
		$p_status = $temp['p_status'];
		if($p_status == 'N'){
			$final_p_status = 'no';
		}
		elseif($p_status == 'Y'){
			$final_p_status = 'yes';
		}else{
			$final_p_status = "N/A";
		}

		$client_name=$gc[2];
		$client_email=$gc[3];
		$client_phone=$gc[4];
		$firstname=$client_name;
		$lastname='';
		$booking_status=$orderdetail[6];
		$final_vc_status;
		$final_p_status;
		$payment_status=$orderdetail[5];
		$client_address=$temp['address'];
		$client_notes=$temp['notes'];
		$client_status=$temp['contact_status'];			
		$client_city = $temp['city'];		
		$client_state = $temp['state'];		
		$client_zip	= $temp['zip'];

	}
	else
	{
		/*Registered user */
		$c  = $objdashboard->getguestclient($orderdetail[4]);

		$temppp= unserialize(base64_decode($c[5]));
		$temp = str_replace('\\','',$temppp);
		$vc_status = $temp['vc_status'];
		if($vc_status == 'N'){
			$final_vc_status = 'no';
		}
		elseif($vc_status == 'Y'){
			$final_vc_status = 'yes';
		}else{
			$final_vc_status = "N/A";
		}
		$p_status = $temp['p_status'];
		if($p_status == 'N'){
			$final_p_status = 'no';
		}
		elseif($p_status == 'Y'){
			$final_p_status = 'yes';
		}else{
			$final_p_status = "N/A";
		}
		$client_name=$c[2];
		$firstname=$client_name;
		$lastname='';
		$client_email=$c[3];
		$client_phone=$c[4];
		$payment_status=$orderdetail[5];
		$final_vc_status;
		$final_p_status;
		$client_address=$temp['address'];
		$client_notes=$temp['notes'];
		$client_status=$temp['contact_status'];			$client_city = $temp['city'];		$client_state = $temp['state'];		$client_zip	= $temp['zip'];
	}
	
	if($email_reminder_time == 60){
		$cust_email_reminder_time = "1";
	}elseif($email_reminder_time == 1440){
		$cust_email_reminder_time = "1";
	}else{
		$result= $email_reminder_time /60;
		$value=explode('.',$result);
		$min=$email_reminder_time%60;
		if($min < 10){
			$cust_email_reminder_time = $value[0];
		}
	}
	$get_staff_name = "";
	
	$searcharray = array('{{service_name}}','{{booking_date}}','{{business_logo}}','{{business_logo_alt}}','{{client_name}}','{{methodname}}','{{units}}','{{addons}}','{{client_email}}','{{phone}}','{{payment_method}}','{{vaccum_cleaner_status}}','{{parking_status}}','{{notes}}','{{contact_status}}','{{address}}','{{price}}','{{admin_name}}','{{firstname}}','{{lastname}}','{{app_remain_time}}','{{reject_status}}','{{company_name}}','{{booking_time}}','{{client_city}}','{{client_state}}','{{client_zip}}','{{company_city}}','{{company_state}}','{{company_zip}}','{{company_country}}','{{company_phone}}','{{company_email}}','{{company_address}}','{{admin_name}}','{{staff_name}}','{{staff_email}}');

	$replacearray = array($service_name, $booking_date , $business_logo, $business_logo_alt, $client_name,$methodname, $units, $addons,$client_email, $client_phone, $payment_status, $final_vc_status, $final_p_status, $client_notes, $client_status,$client_address,$price,$get_admin_name,$firstname,$lastname,$cust_email_reminder_time,'',$admin_company_name,$booking_time,$client_city,$client_state,$client_zip,$company_city,$company_state,$company_zip,$company_country,$company_phone,$company_email,$company_address,$get_admin_name,stripslashes($get_staff_name),stripslashes($get_staff_email));
	
	if($email_reminder_time >= $time_in_min && $binfo[12]!=1){
		$bookings->update_reminder_booking($e_reminder['id']);
		/* Client Email Template */
		$emailtemplate->email_subject="Client Appointment Reminder";
		$emailtemplate->user_type="C";
		$clientemailtemplate=$emailtemplate->readone_client_email_template_body();

		if($clientemailtemplate[2] != ''){
			$clienttemplate = base64_decode($clientemailtemplate[2]);
		}else{
			$clienttemplate = base64_decode($clientemailtemplate[3]);
		}
		$subject=$clientemailtemplate[1];

		if($setting->get_option('ct_client_email_notification_status') == 'Y' && $clientemailtemplate[4]=='E' ){
			$client_email_body = str_replace($searcharray,$replacearray,$clienttemplate);

			if($setting->get_option('ct_smtp_hostname') != '' && $setting->get_option('ct_email_sender_name') != '' && $setting->get_option('ct_email_sender_address') != '' && $setting->get_option('ct_smtp_username') != '' && $setting->get_option('ct_smtp_password') != '' && $setting->get_option('ct_smtp_port') != ''){
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

		/* Admin Email Template */
		$emailtemplate->email_subject="Admin Appointment Reminder";
		$emailtemplate->user_type="A";
		$adminemailtemplate=$emailtemplate->readone_client_email_template_body();

		if($adminemailtemplate[2] != ''){
			$admintemplate = base64_decode($adminemailtemplate[2]);
		}else{
			$admintemplate = base64_decode($adminemailtemplate[3]);
		}
		$adminsubject=$adminemailtemplate[1];

		if($setting->get_option('ct_admin_email_notification_status')=='Y' && $adminemailtemplate[4]=='E'){
			$admin_email_body = str_replace($searcharray,$replacearray,$admintemplate);

			if($setting->get_option('ct_smtp_hostname') != '' && $setting->get_option('ct_email_sender_name') != '' && $setting->get_option('ct_email_sender_address') != '' && $setting->get_option('ct_smtp_username') != '' && $setting->get_option('ct_smtp_password') != '' && $setting->get_option('ct_smtp_port') != ''){
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
			$mail_a->Subject = $adminsubject;
			$mail_a->Body = $admin_email_body;
			$mail_a->send();
			$mail_a->ClearAllRecipients();
		}
		
		/*SMS SENDING CODE*/
		/*GET APPROVED SMS TEMPLATE*/
		/* TEXTLOCAL CODE */
		if($setting->get_option('ct_sms_textlocal_status') == "Y")
		{
			if($setting->get_option('ct_sms_textlocal_send_sms_to_client_status') == "Y"){
				$template = $objdashboard->gettemplate_sms("RM",'C');
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
			if($setting->get_option('ct_sms_textlocal_send_sms_to_admin_status') == "Y"){
				$template = $objdashboard->gettemplate_sms("RM",'A');
				$phone = $setting->get_option('ct_sms_textlocal_admin_phone');;				
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
		/*PLIVO CODE*/
		if($setting->get_option('ct_sms_plivo_status')=="Y"){
			 
			 if($setting->get_option('ct_sms_plivo_send_sms_to_client_status') == "Y"){
				$auth_id = $setting->get_option('ct_sms_plivo_account_SID');
				$auth_token = $setting->get_option('ct_sms_plivo_auth_token');
				$p_client = new Plivo\RestAPI($auth_id, $auth_token, '', '');

				$template = $objdashboard->gettemplate_sms("RM",'C');
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
			if($setting->get_option('ct_sms_plivo_send_sms_to_admin_status') == "Y"){
				$auth_id = $setting->get_option('ct_sms_plivo_account_SID');
				$auth_token = $setting->get_option('ct_sms_plivo_auth_token');
				$p_admin = new Plivo\RestAPI($auth_id, $auth_token, '', '');
				$admin_phone = $setting->get_option('ct_sms_plivo_admin_phone_number');
				$template = $objdashboard->gettemplate_sms("RM",'A');
				
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
		}
		if($setting->get_option('ct_sms_twilio_status') == "Y"){
			if($setting->get_option('ct_sms_twilio_send_sms_to_client_status') == "Y"){
				$AccountSid = $setting->get_option('ct_sms_twilio_account_SID');
				$AuthToken =  $setting->get_option('ct_sms_twilio_auth_token'); 
				$twilliosms_client = new Services_Twilio($AccountSid, $AuthToken);

				$template = $objdashboard->gettemplate_sms("RM",'C');
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
			if($setting->get_option('ct_sms_twilio_send_sms_to_admin_status') == "Y"){
				$AccountSid = $setting->get_option('ct_sms_twilio_account_SID');
				$AuthToken =  $setting->get_option('ct_sms_twilio_auth_token'); 
				$twilliosms_admin = new Services_Twilio($AccountSid, $AuthToken);
				$admin_phone = $setting->get_option('ct_sms_twilio_admin_phone_number');
				$template = $objdashboard->gettemplate_sms("RM",'A');
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
		}
		if($setting->get_option('ct_nexmo_status') == "Y"){
			if($setting->get_option('ct_sms_nexmo_send_sms_to_client_status') == "Y"){
				$template = $objdashboard->gettemplate_sms("RM",'C');
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
			if($setting->get_option('ct_sms_nexmo_send_sms_to_admin_status') == "Y"){
				$template = $objdashboard->gettemplate_sms("RM",'A');
			$phone = $setting->get_option('ct_sms_nexmo_admin_phone_number');				
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
		}
		
		/* staff sms sending code */

		/* staff details */
		$staff_ids = $orderdetail[9];
		if(isset($staff_ids) && !empty($staff_ids))
		{
			$staff_id = array();
			$staff_id = explode(",",$staff_ids);
			foreach($staff_id as $stfid)
			{
				$objadminprofile->id = $stfid;
				$staff_details = $objadminprofile->readone();
				$get_staff_name = "";
				$get_staff_email = "";
				$staff_phone = "";
				if(isset($staff_details) && !empty($staff_details))
				{
					$get_staff_name = $staff_details["fullname"];
					$get_staff_email = $staff_details["email"];
					$staff_phone = $staff_details["phone"];
				}
				
				$searcharray = array('{{service_name}}','{{booking_date}}','{{business_logo}}','{{business_logo_alt}}','{{client_name}}','{{methodname}}','{{units}}','{{addons}}','{{client_email}}','{{phone}}','{{payment_method}}','{{vaccum_cleaner_status}}','{{parking_status}}','{{notes}}','{{contact_status}}','{{address}}','{{price}}','{{admin_name}}','{{firstname}}','{{lastname}}','{{app_remain_time}}','{{reject_status}}','{{company_name}}','{{booking_time}}','{{client_city}}','{{client_state}}','{{client_zip}}','{{company_city}}','{{company_state}}','{{company_zip}}','{{company_country}}','{{company_phone}}','{{company_email}}','{{company_address}}','{{admin_name}}','{{staff_name}}','{{staff_email}}');

				$replacearray = array($service_name, $booking_date , $business_logo, $business_logo_alt, $client_name,$methodname, $units, $addons,$client_email, $client_phone, $payment_status, $final_vc_status, $final_p_status, $client_notes, $client_status,$client_address,$price,$get_admin_name,$firstname,$lastname,'','',$admin_company_name,$booking_time,$client_city,$client_state,$client_zip,$company_city,$company_state,$company_zip,$company_country,$company_phone,$company_email,$company_address,$get_admin_name,stripslashes($get_staff_name),stripslashes($get_staff_email));
				
				
				/* Client Email Template */
				$emailtemplate->email_subject="Staff Appointment Reminder";
				$emailtemplate->user_type="S";
				$clientemailtemplate=$emailtemplate->readone_client_email_template_body();

				if($clientemailtemplate[2] != ''){
					$clienttemplate = base64_decode($clientemailtemplate[2]);
				}else{
					$clienttemplate = base64_decode($clientemailtemplate[3]);
				}
				$subject=$clientemailtemplate[1];

				if($setting->get_option('ct_client_email_notification_status') == 'Y' && $clientemailtemplate[4]=='E' ){
					$client_email_body = str_replace($searcharray,$replacearray,$clienttemplate);

					if($setting->get_option('ct_smtp_hostname') != '' && $setting->get_option('ct_email_sender_name') != '' && $setting->get_option('ct_email_sender_address') != '' && $setting->get_option('ct_smtp_username') != '' && $setting->get_option('ct_smtp_password') != '' && $setting->get_option('ct_smtp_port') != ''){
						$mail->IsSMTP();
					}else{
						$mail->IsMail();
					}
					$mail->SMTPDebug  = 0;
					$mail->IsHTML(true);
					$mail->From = $company_email;
					$mail->FromName = $company_name;
					$mail->Sender = $company_email;
					$mail->AddAddress($get_staff_email, $get_staff_name);
					$mail->Subject = $subject;
					$mail->Body = $client_email_body;
					$mail->send();
					$mail->ClearAllRecipients();

				}
				
				
				/* TEXTLOCAL CODE */
				if($setting->get_option('ct_sms_textlocal_send_sms_to_staff_status') == "Y"){
					if(isset($staff_phone) && !empty($staff_phone))
					{
						$template = $objdashboard->gettemplate_sms("RM",'S');
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
						/*PLIVO CODE*/
						if($setting->get_option('ct_sms_plivo_status')=="Y"){								
							if($setting->get_option('ct_sms_plivo_send_sms_to_staff_status') == "Y"){
								if(isset($staff_phone) && !empty($staff_phone))
								{	
									$auth_id = $setting->get_option('ct_sms_plivo_account_SID');
									$auth_token = $setting->get_option('ct_sms_plivo_auth_token');
									$p_client = new Plivo\RestAPI($auth_id, $auth_token, '', '');

									$template = $objdashboard->gettemplate_sms("RM",'S');
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
						if($setting->get_option('ct_sms_twilio_status') == "Y"){
							if($setting->get_option('ct_sms_twilio_send_sms_to_staff_status') == "Y"){
								if(isset($staff_phone) && !empty($staff_phone))
								{
									$AccountSid = $setting->get_option('ct_sms_twilio_account_SID');
									$AuthToken =  $setting->get_option('ct_sms_twilio_auth_token'); 
									$twilliosms_client = new Services_Twilio($AccountSid, $AuthToken);

									$template = $objdashboard->gettemplate_sms("RM",'S');
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
				if($setting->get_option('ct_nexmo_status') == "Y"){
					if($setting->get_option('ct_sms_nexmo_send_sms_to_staff_status') == "Y"){
						if(isset($staff_phone) && !empty($staff_phone))
						{	
							$template = $objdashboard->gettemplate_sms("RM",'S');
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
				
			}
		}
		/*SMS SENDING CODE END*/
	}
}

$appointment_auto_confirm=$setting->get_option("ct_appointment_auto_confirm_status");
$booking_status="A";
if($appointment_auto_confirm=="Y"){
	$booking_status="C";
}

$add_new_book_bool = true;
$secret_key = $setting->get_option('ct_stripe_secretkey');
if($setting->get_option('ct_stripe_payment_form_status') == "on" && $secret_key != ""){
	require_once(dirname(dirname(dirname(__FILE__))).'/assets/stripe/stripe.php');
	try{
		\Stripe\Stripe::setApiKey($secret_key);
		$objinvoice = new \Stripe\Invoice;
		$objplan = new \Stripe\Plan;
		$payment_detail = $objpayment->get_stripe_reccurence_orders();
		if(mysqli_num_rows($payment_detail) > 0){
			while($p_row = mysqli_fetch_assoc($payment_detail)){
				$order_id = $p_row["order_id"];
				$payment_date = $p_row["payment_date"];
				$transaction_id = $p_row["transaction_id"];
				
				$get_sub_invoice = $objinvoice::All(array("subscription" => $p_row["transaction_id"],"limit" => "1"));
				$last_invoice_info = $get_sub_invoice->data[0];
				if($last_invoice_info->charge != ""){
					$stripe_date = date('Y-m-d',  $last_invoice_info->date);
					if($stripe_date == $payment_date){
						
						$objpayment->transaction_id = $transaction_id;
						$last_transaction_order_id = $objpayment->get_last_order_from_transaction_id();
						$bookings->booking_id = $last_transaction_order_id;
						$last_booking_date_time = $bookings->readone_order_date_time();
						
						$stripe_plan_id = $last_invoice_info->lines->data[0]->plan->id;
						$one_plan_info = $objplan::Retrieve($stripe_plan_id);
						$plan_days = $one_plan_info->interval_count;
						$new_booking_date_time = date("Y-m-d H:i:s",strtotime("+".$plan_days." days",strtotime($last_booking_date_time)));
						$booking_date_time = $new_booking_date_time;
						
						/* Clone order Start */						
						$objocinfo->order_id = $order_id;
						$one_order_info = $objocinfo->readone_order_client();
						$recurring_id = $one_order_info["recurring_id"];
						$objocinfo->recurring_id = $recurring_id;
						$get_clone_order_id = $objocinfo->get_clone_order_id();
						
						$bookings->order_id = $get_clone_order_id;
						$order_booking_detail = $bookings->clone_booking_order_detail();
						$order_addon_detail = $bookings->clone_addon_order_detail();
						$order_client_detail = $bookings->clone_order_client_detail();
						$order_payment_detail = $bookings->clone_payment_order_detail();
						
						$book_last_order_id = $bookings->last_booking_id();
						$book_last_order_id++;
						
						$staff_id = "";
						$service_name = "";
						while($b_row = mysqli_fetch_assoc($order_booking_detail)){
							$booking->order_id=$book_last_order_id;
							$booking->client_id=$b_row["client_id"];
							$booking->order_date=$current_time;
							$booking->booking_date_time=$new_booking_date_time;
							$booking->service_id=$b_row["service_id"];
							$service->id = $b_row["service_id"];
							$service_name = $service->get_service_name_for_mail();
							$booking->method_id=$b_row["method_id"];
							$booking->method_unit_id=$b_row["method_unit_id"];
							$booking->method_unit_qty=$b_row["method_unit_qty"];
							$booking->method_unit_qty_rate=$b_row["method_unit_qty_rate"];
							$booking->booking_status=$booking_status;
							$booking->reject_reason="";
							$booking->read_status="U";
							$booking->staff_ids="";
							$booking->lastmodify=$current_time;
							$staff_id = $b_row["staff_ids"];
							$booking->add_booking();
						}
						
						if(mysqli_num_rows($order_addon_detail) > 0){
							while($a_row = mysqli_fetch_assoc($order_addon_detail)){
								$booking->order_id=$book_last_order_id;
								$booking->service_id=$a_row["service_id"];
								$booking->addons_service_id=$a_row["addons_service_id"];
								$booking->addons_service_qty=$a_row["addons_service_qty"];
								$booking->addons_service_rate=$a_row["addons_service_rate"];
								$booking->add_addons_booking();
							}
						}
						
						$_SESSION['time_duration'] = 0;
						$first_name = "";
						$last_name = "";
						$email = "";
						$phone = "";
						while($oc_row = mysqli_fetch_assoc($order_client_detail)){
							$objocinfo->order_id = $book_last_order_id;
							$objocinfo->client_name=$oc_row["client_name"];
							$email = $oc_row["client_name"];
							$full_name_array = explode(" ",$oc_row["client_name"]);
							$first_name = $full_name_array[0];
							$last_name = $full_name_array[1];
							$objocinfo->client_email=$oc_row["client_email"];
							$objocinfo->client_phone=$oc_row["client_phone"];
							$phone = $oc_row["client_phone"];
							$objocinfo->client_personal_info=$oc_row["client_personal_info"];
							$objocinfo->order_duration=$oc_row["order_duration"];
							$_SESSION['time_duration'] = $oc_row["order_duration"];
							$objocinfo->recurring_id=$oc_row["recurring_id"];
							$objocinfo->add_order_client();
						}
						
						while($py_row = mysqli_fetch_assoc($order_payment_detail)){
							$objpayment->order_id = $book_last_order_id;
							$objpayment->payment_method="Stripe-Reccurance";
							$objpayment->transaction_id=$transaction_id;
							$objpayment->payment_status="Pending";
							$objpayment->payment_date=$new_booking_date_time;
							$objpayment->amount=$py_row["amount"];
							$objpayment->discount=$py_row["discount"];
							$objpayment->taxes=$py_row["taxes"];
							$objpayment->partial_amount=$py_row["partial_amount"];
							$objpayment->lastmodify=$current_time;
							$objpayment->net_amount=$py_row["net_amount"];
							$objpayment->frequently_discount=$py_row["frequently_discount"];
							$objpayment->frequently_discount_amount=$py_row["frequently_discount_amount"];
							$objpayment->recurrence_status='Y';
							$objpayment->add_payments();
						}
						/* Clone order End */
						
						/* GC Code Start */
						if($gc_hook->gc_purchase_status() == 'exist'){
							$array_value = array('firstname' => $first_name,'lastname' => $last_name,'service_name' => $service_name,'email' => $email,'phone' => $phone,'staff_id' => "");
						
							$_SESSION['ct_details']=$array_value;
							echo $gc_hook->gc_add_booking_ajax_hook();
							if($staff_id != ""){
								$staff_id_array = explode(",",$staff_id);
								foreach($staff_id_array as $key => $value){
									$_SESSION['ct_details']['staff_id'] = $value;
									echo $gc_hook->gc_add_staff_booking_ajax_hook();
								}
							}
						}
						/* GC Code End */
						
						/* Update Charge Id to current date match */
						$charge_id = $last_invoice_info->charge;
						$objpayment->order_id = $order_id;
						$objpayment->transaction_id = $charge_id;
						$objpayment->payment_method = "Stripe-payment";
						$objpayment->lastmodify = $current_time;
						$objpayment->update_payment_transaction_id();
						$add_new_book_bool = false;
					}
				}
			}
		}
	}	catch (Exception $e) {
		$error = $e->getMessage();
	}
}
if($add_new_book_bool){
	$all_rec_ids = $objocinfo->get_all_recurring_ids();
	if(count((array)$all_rec_ids) > 0){
		foreach($all_rec_ids as $val){
			$objocinfo->recurring_id = $val;
			$all_order_ids = $objocinfo->read_all_by_rec_id();
			$order_id = 0;
			$count_order = 0;
			while($order = mysqli_fetch_assoc($all_order_ids)){
				$booking->booking_id = $order_id = $order["order_id"];
				$booking_date_time = $booking->readone_order_date_time();
				$str_booking_date_time = strtotime($booking_date_time);
				if($currDateTime_withTZ <= $str_booking_date_time){
					$count_order++;
				}
			}
			$objpayment->order_id = $order_id;
			$objfreqdis->id = $objpayment->get_frequently_discount_id();
			$one_rec_detail = $objfreqdis->readone();
			$rec_day = $one_rec_detail["days"];
			$rec_count = $one_rec_detail["booking_count"];
			if($rec_count >= $count_order){
				$bookings->booking_id = $order_id;
				$old_booking_date_time = $bookings->readone_order_date_time();
				$new_booking_date_time = date("Y-m-d H:i:s",strtotime("+".$rec_day." days",strtotime($old_booking_date_time)));
				$booking_date_time = $new_booking_date_time;
				
				$objocinfo->recurring_id = $val;
				$get_clone_order_id = $objocinfo->get_clone_order_id();
				
				$bookings->order_id = $get_clone_order_id;
				$order_booking_detail = $bookings->clone_booking_order_detail();
				$order_addon_detail = $bookings->clone_addon_order_detail();
				$order_client_detail = $bookings->clone_order_client_detail();
				$order_payment_detail = $bookings->clone_payment_order_detail();
				
				$book_last_order_id = $bookings->last_booking_id();
				$book_last_order_id++;
				
				$staff_id = "";
				$service_name = "";
				while($b_row = mysqli_fetch_assoc($order_booking_detail)){
					$booking->order_id=$book_last_order_id;
					$booking->client_id=$b_row["client_id"];
					$booking->order_date=$current_time;
					$booking->booking_date_time=$new_booking_date_time;
					$booking->service_id=$b_row["service_id"];
					$service->id = $b_row["service_id"];
					$service_name = $service->get_service_name_for_mail();
					$booking->method_id=$b_row["method_id"];
					$booking->method_unit_id=$b_row["method_unit_id"];
					$booking->method_unit_qty=$b_row["method_unit_qty"];
					$booking->method_unit_qty_rate=$b_row["method_unit_qty_rate"];
					$booking->booking_status=$booking_status;
					$booking->reject_reason="";
					$booking->read_status="U";
					$booking->staff_ids="";
					$booking->lastmodify=$current_time;
					$staff_id = $b_row["staff_ids"];
					$booking->add_booking();
				}
				
				if(mysqli_num_rows($order_addon_detail) > 0){
					while($a_row = mysqli_fetch_assoc($order_addon_detail)){
						$booking->order_id=$book_last_order_id;
						$booking->service_id=$a_row["service_id"];
						$booking->addons_service_id=$a_row["addons_service_id"];
						$booking->addons_service_qty=$a_row["addons_service_qty"];
						$booking->addons_service_rate=$a_row["addons_service_rate"];
						$booking->add_addons_booking();
					}
				}
				
				$_SESSION['time_duration'] = 0;
				$first_name = "";
				$last_name = "";
				$email = "";
				$phone = "";
				while($oc_row = mysqli_fetch_assoc($order_client_detail)){
					$objocinfo->order_id = $book_last_order_id;
					$objocinfo->client_name=$oc_row["client_name"];
					$email = $oc_row["client_name"];
					$full_name_array = explode(" ",$oc_row["client_name"]);
					$first_name = $full_name_array[0];
					$last_name = $full_name_array[1];
					$objocinfo->client_email=$oc_row["client_email"];
					$objocinfo->client_phone=$oc_row["client_phone"];
					$phone = $oc_row["client_phone"];
					$objocinfo->client_personal_info=$oc_row["client_personal_info"];
					$objocinfo->order_duration=$oc_row["order_duration"];
					$_SESSION['time_duration'] = $oc_row["order_duration"];
					$objocinfo->recurring_id=$oc_row["recurring_id"];
					$objocinfo->add_order_client();
				}
				
				while($py_row = mysqli_fetch_assoc($order_payment_detail)){
					$objpayment->order_id = $book_last_order_id;
					$objpayment->payment_method=ucwords('pay at venue');
					$objpayment->transaction_id="";
					$objpayment->payment_status="Pending";
					$objpayment->payment_date=$new_booking_date_time;
					$objpayment->amount=$py_row["amount"];
					$objpayment->discount=$py_row["discount"];
					$objpayment->taxes=$py_row["taxes"];
					$objpayment->partial_amount=$py_row["partial_amount"];
					$objpayment->lastmodify=$current_time;
					$objpayment->net_amount=$py_row["net_amount"];
					$objpayment->frequently_discount=$py_row["frequently_discount"];
					$objpayment->frequently_discount_amount=$py_row["frequently_discount_amount"];
					$objpayment->recurrence_status='Y';
					$objpayment->add_payments();
				}
				/* Clone order End */
				
				/* GC Code Start */
				if($gc_hook->gc_purchase_status() == 'exist'){
					$array_value = array('firstname' => $first_name,'lastname' => $last_name,'service_name' => $service_name,'email' => $email,'phone' => $phone,'staff_id' => "");
					$_SESSION['ct_details']=$array_value;
					echo $gc_hook->gc_add_booking_ajax_hook();
					if($staff_id != ""){
						$staff_id_array = explode(",",$staff_id);
						foreach($staff_id_array as $key => $value){
							$_SESSION['ct_details']['staff_id'] = $value;
							echo $gc_hook->gc_add_staff_booking_ajax_hook();
						}
					}
				}
				/* GC Code End */
			}
		}
	}
}
$_SESSION['ct_details'] = array();
$_SESSION['time_duration'] = 0;

$ct_max_advance_booking_time = $setting->get_option('ct_max_advance_booking_time');
$start_date = date("Y-m-d",$currDateTime_withTZ);
$end_date = date("Y-m-d",strtotime("+".$ct_max_advance_booking_time." months",$currDateTime_withTZ));

$CalenderBooking = array();
$all_gc_ids_array = array();
/** Get Google Calendar Bookings **/
$CalenderBooking = array();
if($gc_hook->gc_purchase_status() == 'exist'){
	$gc_hook->google_cal_TwoSync_admin_hook();
	if(!empty($CalenderBooking)){
		foreach($CalenderBooking as $cb){
			$get_booking_detail = $booking->check_booking_by_gc_id($cb["id"]);
			$all_gc_ids_array[] = $cb["id"];
			if(mysqli_num_rows($get_booking_detail) > 0){
				$row = mysqli_fetch_assoc($get_booking_detail);
				$booking_strtotime = strtotime($row["booking_date_time"]);
				if($cb["start"] != $booking_strtotime){
					$order = $row["order_id"];
					$booking_status = "RS";
					$read_status = "U";
					$update_date_time = date("Y-m-d H:i:s",$cb["start"]);
					
					$dates = date("Y-m-d",$cb["start"]);
					$timess = date("H:i:s",$cb["start"]);
					$gcevent_id = "";
					$gc_staff_event_id = $row["gc_staff_event_id"];
					
					$objuserdetails->reschedule_booking($update_date_time,$order,$booking_status,$read_status,$current_time);
					
					$orderdetail = $objdashboard->getclientorder($order);
					$clientdetail = $objdashboard->clientemailsender($order);
					
					$admin_company_name = $setting->get_option('ct_company_name');
					$setting_date_format = $setting->get_option('ct_date_picker_date_format');
					$setting_time_format = $setting->get_option('ct_time_format');
					$booking_date = date($setting_date_format, strtotime($clientdetail['booking_date_time']));
					if($setting_time_format == 12){
						$booking_time = str_replace($english_date_array,$selected_lang_label,date("h:i A",strtotime($clientdetail['booking_date_time'])));
					}
					else{
						$booking_time = date("H:i", strtotime($clientdetail['booking_date_time']));
					}
					$company_name = $setting->get_option('ct_email_sender_name');
					$company_email = $setting->get_option('ct_email_sender_address');
					$service_name = $clientdetail['title'];
					
					if($admin_email == ""){
						$admin_email = $clientdetail['email'];	
					}
					
					$get_admin_name_result = $objadminprofile->readone_adminname();
					$get_admin_name = $get_admin_name_result[3];
					if($get_admin_name == ""){
						$get_admin_name = "Admin";
					}
					$price=$general->ct_price_format($orderdetail[2],$symbol_position,$decimal);

					/* methods */
					$units = 'none';
					$methodname='none';
					$hh = $booking->get_methods_ofbookings($orderdetail[4]);
					$count_methods = mysqli_num_rows($hh);
					$hh1 = $booking->get_methods_ofbookings($orderdetail[4]);

					if($count_methods > 0){
						while($jj = mysqli_fetch_array($hh1)){
							if($units == 'none'){
								$units = $jj['units_title']."-".$jj['qtys'];
							}
							else
							{
								$units = $units.",".$jj['units_title']."-".$jj['qtys'];
							}
							$methodname = $jj['method_title'];
						}
					}

					/* Add ons */
					$addons = 'none';
					$hh = $booking->get_addons_ofbookings($orderdetail[4]);
					while($jj = mysqli_fetch_array($hh)){
						if($addons == 'none'){
							$addons = $jj['addon_service_name']."-".$jj['addons_service_qty'];
						}
						else
						{
							$addons = $addons.",".$jj['addon_service_name']."-".$jj['addons_service_qty'];
						}
					}
					
					/* Guest user */
					if($orderdetail[4]==0)
					{
						$gc  = $objdashboard->getguestclient($orderdetail[4]);
						$temppp= unserialize(base64_decode($gc[5]));
						$temp = str_replace('\\','',$temppp);
						$vc_status = $temp['vc_status'];
						if($vc_status == 'N'){
							$final_vc_status = 'no';
						}
						elseif($vc_status == 'Y'){
							$final_vc_status = 'yes';
						}else{
							$final_vc_status = "N/A";
						}
						$p_status = $temp['p_status'];
						if($p_status == 'N'){
							$final_p_status = 'no';
						}
						elseif($p_status == 'Y'){
							$final_p_status = 'yes';
						}else{
							$final_p_status = "N/A";
						}

						$client_name=$gc[2];
						$client_email=$gc[3];
						$client_phone=$gc[4];
						$firstname=$client_name;
						$lastname='';
						$booking_status=$orderdetail[6];
						$final_vc_status;
						$final_p_status;
						$payment_status=$orderdetail[5];
						$client_address=$temp['address'];
						$client_notes=$temp['notes'];
						$client_status=$temp['contact_status'];			
						$client_city = $temp['city'];		
						$client_state = $temp['state'];		
						$client_zip	= $temp['zip'];

					}
					else
					{
						/*Registered user */
						$c  = $objdashboard->getguestclient($orderdetail[4]);

						$temppp= unserialize(base64_decode($c[5]));
						$temp = str_replace('\\','',$temppp);
						$vc_status = $temp['vc_status'];
						if($vc_status == 'N'){
							$final_vc_status = 'no';
						}
						elseif($vc_status == 'Y'){
							$final_vc_status = 'yes';
						}else{
							$final_vc_status = "N/A";
						}
						$p_status = $temp['p_status'];
						if($p_status == 'N'){
							$final_p_status = 'no';
						}
						elseif($p_status == 'Y'){
							$final_p_status = 'yes';
						}else{
							$final_p_status = "N/A";
						}
						$client_name=$c[2];
						$firstname=$client_name;
						$lastname='';
						$client_email=$c[3];
						$client_phone=$c[4];
						$payment_status=$orderdetail[5];
						$final_vc_status;
						$final_p_status;
						$client_address=$temp['address'];
						$client_notes=$temp['notes'];
						$client_status=$temp['contact_status'];			$client_city = $temp['city'];		$client_state = $temp['state'];		$client_zip	= $temp['zip'];
					}
					$get_staff_name = "";
					$get_staff_email = "";
					
					$searcharray = array('{{service_name}}','{{booking_date}}','{{business_logo}}','{{business_logo_alt}}','{{client_name}}','{{methodname}}','{{units}}','{{addons}}','{{client_email}}','{{phone}}','{{payment_method}}','{{vaccum_cleaner_status}}','{{parking_status}}','{{notes}}','{{contact_status}}','{{address}}','{{price}}','{{admin_name}}','{{firstname}}','{{lastname}}','{{app_remain_time}}','{{reject_status}}','{{company_name}}','{{booking_time}}','{{client_city}}','{{client_state}}','{{client_zip}}','{{company_city}}','{{company_state}}','{{company_zip}}','{{company_country}}','{{company_phone}}','{{company_email}}','{{company_address}}','{{admin_name}}','{{staff_name}}','{{staff_email}}');

					$replacearray = array($service_name, $booking_date , $business_logo, $business_logo_alt, $client_name,$methodname, $units, $addons,$client_email, $client_phone, $payment_status, $final_vc_status, $final_p_status, $client_notes, $client_status,$client_address,$price,$get_admin_name,$firstname,$lastname,'','',$admin_company_name,$booking_time,$client_city,$client_state,$client_zip,$company_city,$company_state,$company_zip,$company_country,$company_phone,$company_email,$company_address,$get_admin_name,stripslashes($get_staff_name),stripslashes($get_staff_email));
				
					$emailtemplate->email_subject="Appointment Rescheduled by you";
					$emailtemplate->user_type="C";
					$clientemailtemplate=$emailtemplate->readone_client_email_template_body();

					if($clientemailtemplate[2] != ''){
						$clienttemplate = base64_decode($clientemailtemplate[2]);
					}else{
						$clienttemplate = base64_decode($clientemailtemplate[3]);
					}
					$subject=$clientemailtemplate[1];

					if($setting->get_option('ct_client_email_notification_status') == 'Y' && $clientemailtemplate[4]=='E' ){
						$client_email_body = str_replace($searcharray,$replacearray,$clienttemplate);

						if($setting->get_option('ct_smtp_hostname') != '' && $setting->get_option('ct_email_sender_name') != '' && $setting->get_option('ct_email_sender_address') != '' && $setting->get_option('ct_smtp_username') != '' && $setting->get_option('ct_smtp_password') != '' && $setting->get_option('ct_smtp_port') != ''){
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

					/* Admin Email Template */
					$emailtemplate->email_subject="Appointment Rescheduled By Customer";
					$emailtemplate->user_type="A";
					$adminemailtemplate=$emailtemplate->readone_client_email_template_body();

					if($adminemailtemplate[2] != ''){
						$admintemplate = base64_decode($adminemailtemplate[2]);
					}else{
						$admintemplate = base64_decode($adminemailtemplate[3]);
					}
					$adminsubject=$adminemailtemplate[1];

					if($setting->get_option('ct_admin_email_notification_status')=='Y' && $adminemailtemplate[4]=='E'){
						$admin_email_body = str_replace($searcharray,$replacearray,$admintemplate);

						if($setting->get_option('ct_smtp_hostname') != '' && $setting->get_option('ct_email_sender_name') != '' && $setting->get_option('ct_email_sender_address') != '' && $setting->get_option('ct_smtp_username') != '' && $setting->get_option('ct_smtp_password') != '' && $setting->get_option('ct_smtp_port') != ''){
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
						$mail_a->Subject = $adminsubject;
						$mail_a->Body = $admin_email_body;
						$mail_a->send();
						$mail_a->ClearAllRecipients();
					}
					
					/*SMS SENDING CODE*/
					/*GET APPROVED SMS TEMPLATE*/
					/* TEXTLOCAL CODE */
					if($setting->get_option('ct_sms_textlocal_status') == "Y")
					{
						if($setting->get_option('ct_sms_textlocal_send_sms_to_client_status') == "Y"){
							$template = $objdashboard->gettemplate_sms("RS",'C');
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
						if($setting->get_option('ct_sms_textlocal_send_sms_to_admin_status') == "Y"){
							$template = $objdashboard->gettemplate_sms("RS",'A');
							$phone = $setting->get_option('ct_sms_textlocal_admin_phone');;				
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
					/*PLIVO CODE*/
					if($setting->get_option('ct_sms_plivo_status')=="Y"){
						 
						 if($setting->get_option('ct_sms_plivo_send_sms_to_client_status') == "Y"){
							$auth_id = $setting->get_option('ct_sms_plivo_account_SID');
							$auth_token = $setting->get_option('ct_sms_plivo_auth_token');
							$p_client = new Plivo\RestAPI($auth_id, $auth_token, '', '');

							$template = $objdashboard->gettemplate_sms("RS",'C');
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
						if($setting->get_option('ct_sms_plivo_send_sms_to_admin_status') == "Y"){
							$auth_id = $setting->get_option('ct_sms_plivo_account_SID');
							$auth_token = $setting->get_option('ct_sms_plivo_auth_token');
							$p_admin = new Plivo\RestAPI($auth_id, $auth_token, '', '');
							$admin_phone = $setting->get_option('ct_sms_plivo_admin_phone_number');
							$template = $objdashboard->gettemplate_sms("RS",'A');
							
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
					}
					if($setting->get_option('ct_sms_twilio_status') == "Y"){
						if($setting->get_option('ct_sms_twilio_send_sms_to_client_status') == "Y"){
							$AccountSid = $setting->get_option('ct_sms_twilio_account_SID');
							$AuthToken =  $setting->get_option('ct_sms_twilio_auth_token'); 
							$twilliosms_client = new Services_Twilio($AccountSid, $AuthToken);

							$template = $objdashboard->gettemplate_sms("RS",'C');
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
						if($setting->get_option('ct_sms_twilio_send_sms_to_admin_status') == "Y"){
							$AccountSid = $setting->get_option('ct_sms_twilio_account_SID');
							$AuthToken =  $setting->get_option('ct_sms_twilio_auth_token'); 
							$twilliosms_admin = new Services_Twilio($AccountSid, $AuthToken);
							$admin_phone = $setting->get_option('ct_sms_twilio_admin_phone_number');
							$template = $objdashboard->gettemplate_sms("RS",'A');
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
					}
					if($setting->get_option('ct_nexmo_status') == "Y"){
						if($setting->get_option('ct_sms_nexmo_send_sms_to_client_status') == "Y"){
							$template = $objdashboard->gettemplate_sms("RS",'C');
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
						if($setting->get_option('ct_sms_nexmo_send_sms_to_admin_status') == "Y"){
							$template = $objdashboard->gettemplate_sms("RS",'A');
							$phone = $setting->get_option('ct_sms_nexmo_admin_phone_number');				
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
					}
					/* staff sms sending code */

					/* staff details */
					$staff_ids = $orderdetail[9];
					if(isset($staff_ids) && !empty($staff_ids))
					{
						$count_check = 0;
						$staff_id = array();
						$staff_id = explode(",",$staff_ids);
						foreach($staff_id as $stfid)
						{
							if($count_check == 0){
								$pid = $stfid;
								/** Rescheduled Google Calendar Booking **/
								echo $gc_hook->gc_reschedule_booking_by_reminder_ajax_hook();
								/** Rescheduled Google Calendar Booking **/
								$count_check++;
							}
							
							$objadminprofile->id = $stfid;
							$staff_details = $objadminprofile->readone();
							$get_staff_name = "";
							$get_staff_email = "";
							$staff_phone = "";
							if(isset($staff_details) && !empty($staff_details))
							{
								$get_staff_name = $staff_details["fullname"];
								$get_staff_email = $staff_details["email"];
								$staff_phone = $staff_details["phone"];
							}
							
							$searcharray = array('{{service_name}}','{{booking_date}}','{{business_logo}}','{{business_logo_alt}}','{{client_name}}','{{methodname}}','{{units}}','{{addons}}','{{client_email}}','{{phone}}','{{payment_method}}','{{vaccum_cleaner_status}}','{{parking_status}}','{{notes}}','{{contact_status}}','{{address}}','{{price}}','{{admin_name}}','{{firstname}}','{{lastname}}','{{app_remain_time}}','{{reject_status}}','{{company_name}}','{{booking_time}}','{{client_city}}','{{client_state}}','{{client_zip}}','{{company_city}}','{{company_state}}','{{company_zip}}','{{company_country}}','{{company_phone}}','{{company_email}}','{{company_address}}','{{admin_name}}','{{staff_name}}','{{staff_email}}');

							$replacearray = array($service_name, $booking_date , $business_logo, $business_logo_alt, $client_name,$methodname, $units, $addons,$client_email, $client_phone, $payment_status, $final_vc_status, $final_p_status, $client_notes, $client_status,$client_address,$price,$get_admin_name,$firstname,$lastname,'','',$admin_company_name,$booking_time,$client_city,$client_state,$client_zip,$company_city,$company_state,$company_zip,$company_country,$company_phone,$company_email,$company_address,$get_admin_name,stripslashes($get_staff_name),stripslashes($get_staff_email));
							
							/* Client Email Template */
							$emailtemplate->email_subject="Appointment Rescheduled By Customer";
							$emailtemplate->user_type="S";
							$clientemailtemplate=$emailtemplate->readone_client_email_template_body();

							if($clientemailtemplate[2] != ''){
								$clienttemplate = base64_decode($clientemailtemplate[2]);
							}else{
								$clienttemplate = base64_decode($clientemailtemplate[3]);
							}
							$subject=$clientemailtemplate[1];

							if($setting->get_option('ct_client_email_notification_status') == 'Y' && $clientemailtemplate[4]=='E' ){
								$client_email_body = str_replace($searcharray,$replacearray,$clienttemplate);

								if($setting->get_option('ct_smtp_hostname') != '' && $setting->get_option('ct_email_sender_name') != '' && $setting->get_option('ct_email_sender_address') != '' && $setting->get_option('ct_smtp_username') != '' && $setting->get_option('ct_smtp_password') != '' && $setting->get_option('ct_smtp_port') != ''){
									$mail->IsSMTP();
								}else{
									$mail->IsMail();
								}
								$mail->SMTPDebug  = 0;
								$mail->IsHTML(true);
								$mail->From = $company_email;
								$mail->FromName = $company_name;
								$mail->Sender = $company_email;
								$mail->AddAddress($get_staff_email, $get_staff_name);
								$mail->Subject = $subject;
								$mail->Body = $client_email_body;
								$mail->send();
								$mail->ClearAllRecipients();

							}
							
							/* TEXTLOCAL CODE */
							if($setting->get_option('ct_sms_textlocal_send_sms_to_staff_status') == "Y"){
								if(isset($staff_phone) && !empty($staff_phone))
								{
									$template = $objdashboard->gettemplate_sms("RS",'S');
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
									/*PLIVO CODE*/
									if($setting->get_option('ct_sms_plivo_status')=="Y"){								
										if($setting->get_option('ct_sms_plivo_send_sms_to_staff_status') == "Y"){
											if(isset($staff_phone) && !empty($staff_phone))
											{	
												$auth_id = $setting->get_option('ct_sms_plivo_account_SID');
												$auth_token = $setting->get_option('ct_sms_plivo_auth_token');
												$p_client = new Plivo\RestAPI($auth_id, $auth_token, '', '');

												$template = $objdashboard->gettemplate_sms("RS",'S');
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
													/* MESSAGE SENDING CODE ENDED HERE*/
												}
											}	
										}
									}
									if($setting->get_option('ct_sms_twilio_status') == "Y"){
										if($setting->get_option('ct_sms_twilio_send_sms_to_staff_status') == "Y"){
											if(isset($staff_phone) && !empty($staff_phone))
											{
												$AccountSid = $setting->get_option('ct_sms_twilio_account_SID');
												$AuthToken =  $setting->get_option('ct_sms_twilio_auth_token'); 
												$twilliosms_client = new Services_Twilio($AccountSid, $AuthToken);

												$template = $objdashboard->gettemplate_sms("RS",'S');
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
							if($setting->get_option('ct_nexmo_status') == "Y"){
								if($setting->get_option('ct_sms_nexmo_send_sms_to_staff_status') == "Y"){
									if(isset($staff_phone) && !empty($staff_phone))
									{	
										$template = $objdashboard->gettemplate_sms("RS",'S');
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
							
						}
					}
					/*SMS SENDING CODE END*/
				}
			}
		}
	}
	/* all_gc_ids_array */
	$all_db_bookings = $booking->get_all_gc_from_db();
	if(mysqli_num_rows($all_db_bookings) > 0){
		while($row = mysqli_fetch_assoc($all_db_bookings)){
			if($row["gc_event_id"] != ""){
				if(!in_array($row["gc_event_id"],$all_gc_ids_array)){
					$order_id = $row["order_id"];
					$objdashboard->delete_booking($order_id);
				}
				/* $staff_ids = $row["staff_ids"];
				if(isset($staff_ids) && !empty($staff_ids)){
					
					
				} */
			}
		}
	}
}
?>