<?php   
session_start();
include(dirname(dirname(dirname(__FILE__))).'/objects/class_connection.php');
include(dirname(dirname(dirname(__FILE__))).'/header.php');
include(dirname(dirname(dirname(__FILE__))).'/objects/class_setting.php');
include(dirname(dirname(dirname(__FILE__))).'/objects/class_userdetails.php');
include(dirname(dirname(dirname(__FILE__)))."/objects/class_booking.php");
include(dirname(dirname(dirname(__FILE__))).'/objects/class_front_first_step.php');
include(dirname(dirname(dirname(__FILE__))).'/objects/class_email_template.php');
include(dirname(dirname(dirname(__FILE__)))."/objects/class_dashboard.php");
include(dirname(dirname(dirname(__FILE__)))."/objects/class_adminprofile.php");
include(dirname(dirname(dirname(__FILE__))).'/objects/class_general.php');
include(dirname(dirname(dirname(__FILE__))).'/objects/class.phpmailer.php');
include(dirname(dirname(dirname(__FILE__))).'/objects/plivo.php');
include(dirname(dirname(dirname(__FILE__))).'/assets/twilio/Services/Twilio.php');
include(dirname(dirname(dirname(__FILE__)))."/objects/class_nexmo.php");
include(dirname(dirname(dirname(__FILE__)))."/objects/class_gc_hook.php");
include(dirname(dirname(dirname(__FILE__))).'/objects/class_users.php');
include(dirname(dirname(dirname(__FILE__)))."/objects/class_eml_sms.php");

$database= new cleanto_db();
$conn=$database->connect();
$database->conn=$conn;

$nexmo_admin = new cleanto_ct_nexmo();
$nexmo_client = new cleanto_ct_nexmo();

$gc_hook = new cleanto_gcHook();
$gc_hook->conn = $conn;

$objuserdetails = new cleanto_userdetails();
$objuserdetails->conn=$conn;

$emailtemplate=new cleanto_email_template();
$emailtemplate->conn=$conn;

$objdashboard = new cleanto_dashboard();
$objdashboard->conn = $conn;
$objadminprofile = new cleanto_adminprofile();$objadminprofile->conn = $conn;
$first_step=new cleanto_first_step();
$first_step->conn=$conn;

$emlsms=new eml_sms();
$emlsms->conn=$conn;

$booking = new cleanto_booking();
$booking->conn = $conn;

$setting = new cleanto_setting();
$setting->conn = $conn;

$general=new cleanto_general();
$general->conn=$conn;

$date_format=$setting->get_option('ct_date_picker_date_format');
$time_format = $setting->get_option('ct_time_format');
$getmaximumbooking = $setting->get_option('ct_max_advance_booking_time');

$symbol_position=$setting->get_option('ct_currency_symbol_position');
$decimal=$setting->get_option('ct_price_format_decimal_places');


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

/*NEED VARIABLE FOR EMAIL*/
$company_city = $setting->get_option('ct_company_city'); $company_state = $setting->get_option('ct_company_state'); $company_zip = $setting->get_option('ct_company_zip_code'); $company_country = $setting->get_option('ct_company_country'); 
$company_phone = strlen($setting->get_option('ct_company_phone')) < 6 ? "" : $setting->get_option('ct_company_phone'); 
$company_email = $setting->get_option('ct_company_email'); 
$company_address = $setting->get_option('ct_company_address');
$admin_phone_twilio = $setting->get_option('ct_sms_twilio_admin_phone_number');
$admin_phone_plivo = $setting->get_option('ct_sms_plivo_admin_phone_number');

/*  set admin name */
$get_admin_name_result = $objadminprofile->readone_adminname();
$get_admin_name = $get_admin_name_result[3];
if($get_admin_name == ""){
	$get_admin_name = "Admin";
}
$admin_email = $setting->get_option('ct_admin_optional_email');
/* set admin name */
/* set business logo and logo alt */
 if($setting->get_option('ct_company_logo') != null && $setting->get_option('ct_company_logo') != ""){
	$business_logo= SITE_URL.'assets/images/services/'.$setting->get_option('ct_company_logo');
	$business_logo_alt= $setting->get_option('ct_company_name');
}else{
	$business_logo= '';
	$business_logo_alt= $setting->get_option('ct_company_name');
}
$user=new cleanto_users();
$user->conn=$conn;
/* set business logo and logo alt */

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

include(dirname(dirname(dirname(__FILE__))).'/assets/lib/date_translate_array.php');

if(isset($_POST['updatepass'])){
    $objuserdetails->firstname = $_POST['firstname'];
    $objuserdetails->lastname = $_POST['lastname'];
    $objuserdetails->address = $_POST['address'];
    $objuserdetails->city = $_POST['city'];
    $objuserdetails->zip = $_POST['zip'];
    $objuserdetails->state = $_POST['state'];
    $objuserdetails->phone = $_POST['phone'];
    $objuserdetails->id = $_POST['id'];

    $op=md5($_POST['oldpassword']);
    $dp=$_POST['dboldpassword'];
    $np=$_POST['newpassword'];
    $rp=$_POST['retypepassword'];

    $operation = 1;
    if ($_POST['oldpassword'] != "") {
        if ($op != $dp) {
            $operation = 2;
            echo "Your Old Password Incorrect...";
        }
        else {
            $operation = 3;
            if ($np == $rp) {
                $objuserdetails->password=md5($rp);
                $update=$objuserdetails->update_profile();
                if($update){
                }

            }
            else{
                echo "Please Retype Correct Password...";
            }
        }
    }
    if ($operation == 1) {
        $objuserdetails->password=$dp;
        $update=$objuserdetails->update_profile();
        if($update){
        }
    }
}
if(isset($_POST['getmytimeslots'])){
		$staff_id = "";
		if($_POST['staff_id'] != ""){
			$staff_id_array = explode(",",$_POST['staff_id']);
			$staff_id = $staff_id_array[0];
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

    $select_time=date('Y-m-d',strtotime($_POST['selected_dates']));
    $start_date = date($select_time,$currDateTime_withTZ);

		/** Get Google Calendar Bookings **/
		$providerCalenderBooking = array();
		if($gc_hook->gc_purchase_status() == 'exist'){
			$gc_hook->google_cal_TwoSync_hook();
		}
		/** Get Google Calendar Bookings **/
		
    $time_interval = $setting->get_option('ct_time_interval');
    $time_slots_schedule_type = $setting->get_option('ct_time_slots_schedule_type');
    $advance_bookingtime = $setting->get_option('ct_min_advance_booking_time');
    $ct_service_padding_time_before = $setting->get_option('ct_service_padding_time_before');
    $ct_service_padding_time_after = $setting->get_option('ct_service_padding_time_after');
    $booking_padding_time = $setting->get_option('ct_booking_padding_time');

    $time_schedule = $first_step->get_day_time_slot_by_provider_id($time_slots_schedule_type,$start_date,$time_interval,$advance_bookingtime,$ct_service_padding_time_before,$ct_service_padding_time_after,$timezonediff,$booking_padding_time,$staff_id);

		$google_slot_counter = 0;	
    $allbreak_counter = 0;
    $allbreak_counter = 0;
    $allofftime_counter = 0;
    $slot_counter = 0;
    ?>
    <script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery('.selectpicker').selectpicker();
		});
    </script>
    <select class="selectpicker mydatepicker_appointment form-control" id="myuser_reschedule_time" data-size="10" style="">
        <?php  
        if($time_schedule['off_day']!=true && isset($time_schedule['slots']) && sizeof((array)$time_schedule['slots'])>0 && $allbreak_counter != sizeof((array)$time_schedule['slots']) && $allofftime_counter != sizeof((array)$time_schedule['slots'])){
            foreach($time_schedule['slots']  as $slot) {
								$curreslotstr = strtotime(date(date('Y-m-d H:i:s',strtotime($select_time.' '.$slot)),$currDateTime_withTZ));
								$gccheck = 'N';
						
								if(sizeof((array)$providerCalenderBooking)>0){
									for($i = 0; $i < sizeof((array)$providerCalenderBooking); $i++) {
										if($curreslotstr >= $providerCalenderBooking[$i]['start'] && $curreslotstr < $providerCalenderBooking[$i]['end']){
											$gccheck = 'Y';
										}
									}
								}
								if($gccheck=='Y') { continue; $google_slot_counter;}
								
                $ifbreak = 'N';
                /* Need to check if the appointment slot come under break time. */
                foreach($time_schedule['breaks'] as $daybreak) {
                    if(strtotime($slot) >= strtotime($daybreak['break_start']) && strtotime($slot) < strtotime($daybreak['break_end'])) {
                        $ifbreak = 'Y';
                    }
                }
                /* if yes its break time then we will not show the time for booking  */
                if($ifbreak=='Y') { $allbreak_counter++; continue; }

                $ifofftime = 'N';

                foreach($time_schedule['offtimes'] as $offtime) {
                    if(strtotime($_POST['selected_dates'].' '.$slot) >= strtotime($offtime['offtime_start']) && strtotime($_POST['selected_dates'].' '.$slot) < strtotime($offtime['offtime_end'])) {
                        $ifofftime = 'Y';
                    }
                }
                /* if yes its offtime time then we will not show the time for booking  */
                if($ifofftime=='Y') { $allofftime_counter++; continue; }

                $complete_time_slot = mktime(date('H',strtotime($slot)),date('i',strtotime($slot)),date('s',strtotime($slot)),date('n',strtotime($time_schedule['date'])),date('j',strtotime($time_schedule['date'])),date('Y',strtotime($time_schedule['date'])));

                if($setting->get_option('ct_hide_faded_already_booked_time_slots')=='on' && in_array($complete_time_slot,$time_schedule['booked'])) {
                    continue;
                }
                if( in_array($complete_time_slot,$time_schedule['booked']) && ($setting->get_option('ct_allow_multiple_booking_for_same_timeslot_status')!='Y') ) { ?>
                    <?php  
                    if($setting->get_option('ct_hide_faded_already_booked_time_slots')=="on"){
                        ?>
                        <option value="<?php echo date("H:i",strtotime($slot));?>" class="time-slot br-2 ct-booked" >
                            <?php  
                            if($setting->get_option('ct_time_format')==24){
                                echo date("H:i",strtotime($slot));
                            }else{
                                echo str_replace($english_date_array,$selected_lang_label,date("h:i A",strtotime($slot)));
                            }?>
                        </option>
                    <?php  
                    }
                    ?>
                <?php  
                } else {
                    if($setting->get_option('ct_time_format')==24){
                        $slot_time = date("H:i",strtotime($slot));
                    }else{
                        $slot_time = str_replace($english_date_array,$selected_lang_label,date("h:i A",strtotime($slot)));
                    }
                    ?>
                    <option value="<?php echo date("H:i",strtotime($slot));?>" class="time-slot br-2 <?php   if(in_array($complete_time_slot,$time_schedule['booked'])){ echo' ct-booked';}else{ echo ' time_slotss'; }?>" <?php   if(in_array($complete_time_slot,$time_schedule['booked'])){echo ''; }else{ echo 'data-slot_date_to_display="'.date($date_format,strtotime($_POST["selected_dates"])).'" data-slot_date="'.$_POST["selected_dates"].'" data-slot_time="'.$slot_time.'"'; } ?>><?php if($setting->get_option('ct_time_format')==24){echo date("H:i",strtotime($slot));}else{echo str_replace($english_date_array,$selected_lang_label,date("h:i A",strtotime($slot)));}?></option>
                <?php  
                } $slot_counter++;
            }
            if($allbreak_counter == sizeof((array)$time_schedule['slots']) && sizeof((array)$time_schedule['slots'])!=0){ ?>
                <option  class="time-slot"><?php echo $label_language_values['sorry_not_available'];?></option>
            <?php   }
						if($google_slot_counter == sizeof((array)$time_schedule['slots']) && sizeof((array)$time_schedule['slots'])!=0){ ?>
                <option  class="time-slot"><?php echo $label_language_values['sorry_not_available'];?></option>
            <?php   }
        } else {?>
            <option class="time-slot"><?php echo $label_language_values['sorry_not_available'];?></option>
        <?php   } ?>
    </select>
<?php  
}
if(isset($_POST['delete_gc_booking'])){
	$gc_event_id = $_POST['gc_event_id'];
	$gc_staff_event_id = "";
	$pid = "";
	if($gc_hook->gc_purchase_status() == 'exist'){
		if($setting->get_option('ct_gc_status_configure') == 'Y' && $setting->get_option('ct_gc_status') == 'Y') {
			echo $gc_hook->gc_cancel_reject_booking_hook();
		}
	}
}
if(isset($_POST['reschedule_gc_booking'])){
	$dates = $_POST['dates'];
  $timess = $_POST['timess'];
	$order_duration = $_POST['duration'];
	if($gc_hook->gc_purchase_status() == 'exist'){
		if($setting->get_option('ct_gc_status_configure') == 'Y' && $setting->get_option('ct_gc_status') == 'Y') {
			echo $gc_hook->gc_reschedule_booking_ajax_hook();
		}
	}
}
if(isset($_POST['reschedulebooking'])){
    $id=$order = $_POST['orderid'];
    $notes = $_POST['notes'];
    $dates = $_POST['dates'];
    $timess = $_POST['timess'];
    $booking_status = "RS";
    $read_status = "U";
    $lastmodify = date('Y-m-d H:i:s');
    $datetime_withmaxtime = "";
    if($getmaximumbooking != ""){
      $datetime_withmaxtime = strtotime('+'.$getmaximumbooking.' month',strtotime(date('Y-m-d')));
    }
    if(strtotime($dates) <= $datetime_withmaxtime || $datetime_withmaxtime == ""){
			$dat = $dates."".$timess;
			$finaldate = date("Y-m-d H:i:s", strtotime($dat));
			$objuserdetails->reschedule_booking($finaldate,$order,$booking_status,$read_status,$lastmodify);
			$serializedData = $objuserdetails->get_user_notes($order);
			$data   = unserialize(base64_decode($serializedData[0]));
			if(array_key_exists('notes', $data)) {
					$data['notes'] = $notes;
			}
			$serializedData = base64_encode(serialize($data));
			$objuserdetails->update_notes($order,$serializedData);
			$orderdetail = $objdashboard->getclientorder($id);
			$order_duration = $orderdetail[8];
			if($gc_hook->gc_purchase_status() == 'exist'){
				if($setting->get_option('ct_gc_status_configure') == 'Y' && $setting->get_option('ct_gc_status') == 'Y') {
					echo $gc_hook->gc_reschedule_booking_ajax_hook();
				}
			}
			echo "1";

			$clientdetail = $objdashboard->clientemailsender($id);

			/*$booking_date = date("Y-m-d H:i", strtotime($clientdetail['booking_date_time']));*/
		
		$admin_company_name = $setting->get_option('ct_company_name');
		$setting_date_format = $setting->get_option('ct_date_picker_date_format');
		$setting_time_format = $setting->get_option('ct_time_format');
		$booking_date = str_replace($english_date_array,$selected_lang_label,date($setting_date_format,strtotime($clientdetail['booking_date_time'])));
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
		
		/* $admin_name = $clientdetail['fullname']; */
		$price=$general->ct_price_format($orderdetail[2],$symbol_position,$decimal);

        /* methods */
        $units = $label_language_values['none'];
        $methodname=$label_language_values['none'];
        $hh = $booking->get_methods_ofbookings($orderdetail[4]);
        $count_methods = mysqli_num_rows($hh);
        $hh1 = $booking->get_methods_ofbookings($orderdetail[4]);

        if($count_methods > 0){
            while($jj = mysqli_fetch_array($hh1)){
                if($units == $label_language_values['none']){
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
        $addons = $label_language_values['none'];
        $hh = $booking->get_addons_ofbookings($orderdetail[4]);
        while($jj = mysqli_fetch_array($hh)){
            if($addons == $label_language_values['none']){
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
                $final_vc_status = $label_language_values['no'];
            }
            elseif($vc_status == 'Y'){
                $final_vc_status = $label_language_values['yes'];
            }else{
                $final_vc_status = "N/A";
            }
            $p_status = $temp['p_status'];
            if($p_status == 'N'){
                $final_p_status = $label_language_values['no'];
            }
            elseif($p_status == 'Y'){
                $final_p_status = $label_language_values['yes'];
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
            /*Registered user */
        {
            $c  = $objdashboard->getguestclient($orderdetail[4]);

            $temppp= unserialize(base64_decode($c[5]));
            $temp = str_replace('\\','',$temppp);
            $vc_status = $temp['vc_status'];
            if($vc_status == 'N'){
                $final_vc_status = $label_language_values['no'];
            }
            elseif($vc_status == 'Y'){
                $final_vc_status = $label_language_values['yes'];
            }else{
                $final_vc_status = "N/A";
            }
            $p_status = $temp['p_status'];
            if($p_status == 'N'){
                $final_p_status = $label_language_values['no'];
            }
            elseif($p_status == 'Y'){
                $final_p_status = $label_language_values['yes'];
            }else{
                $final_p_status = "N/A";
            }
			
			
			
			
			$client_phone_no = $c[4];
	$client_phone_length = strlen($client_phone_no);
			
			if($client_phone_length > 6){
				$client_phone = $client_phone_no;
			}else{
				$client_phone = "N/A";
			}
			
/* 		$client_name_value= explode(" ",$c[2]);
			$client_first_name = $client_name_value[0];
			$client_last_name =	$client_name_value[1]; */
			
			$client_namess= explode(" ",$c[2]);
			$cnamess = array_filter($client_namess);
			$ccnames = array_values($cnamess);
			if(sizeof((array)$ccnames)>0){
				$client_first_name =  $ccnames[0]; 
				if(isset($ccnames[1])){
					$client_last_name =  $ccnames[1];
				}else{
					$client_last_name =  '';
				}
			}else{
				$client_first_name =  ''; 
				$client_last_name =  ''; 
			}
	
					if($client_first_name=="" && $client_last_name==""){
						$firstname = "User";
						$lastname = "";
						$client_name = $firstname.' '.$lastname;
					}elseif($client_first_name!="" && $client_last_name!=""){
						$firstname = $client_first_name;
						$lastname = $client_last_name;
						$client_name = $firstname.' '.$lastname;
					}elseif($client_first_name!=""){
						$firstname = $client_first_name;
						$lastname = "";
						$client_name = $firstname.' '.$lastname;
					}elseif($client_last_name!=""){
						$firstname = "";
						$lastname = $client_last_name;
						$client_name = $firstname.' '.$lastname;
					}
					
			$client_notes = $temp['notes'];	
					if($client_notes==""){
						$client_notes = "N/A";
					}		
			
			$client_status = $temp['contact_status'];	
					if($client_status==""){
						$client_status = "N/A";
					}		
			
            $client_email=$c[3];
            $payment_status=$orderdetail[5];
            $final_vc_status;
            $final_p_status;
            $client_address=$temp['address'];
			$client_city = $temp['city'];	
			$client_state = $temp['state'];		
			$client_zip	= $temp['zip'];
        }
		$payment_status = strtolower($payment_status);
		if($payment_status == "pay at venue"){
			$payment_status = ucwords($label_language_values['pay_locally']);
		}else{
			$payment_status = ucwords($payment_status);
		}
        $searcharray = array('{{service_name}}','{{booking_date}}','{{business_logo}}','{{business_logo_alt}}','{{client_name}}','{{methodname}}','{{units}}','{{addons}}','{{client_email}}','{{phone}}','{{payment_method}}','{{vaccum_cleaner_status}}','{{parking_status}}','{{notes}}','{{contact_status}}','{{address}}','{{price}}','{{admin_name}}','{{firstname}}','{{lastname}}','{{app_remain_time}}','{{reject_status}}','{{company_name}}','{{booking_time}}','{{client_city}}','{{client_state}}','{{client_zip}}','{{company_city}}','{{company_state}}','{{company_zip}}','{{company_country}}','{{company_phone}}','{{company_email}}','{{company_address}}','{{admin_name}}');

        $replacearray = array($service_name, $booking_date , $business_logo, $business_logo_alt, $client_name,$methodname, $units, $addons,$client_email, $client_phone, $payment_status, $final_vc_status, $final_p_status, $client_notes, $client_status,$client_address,$price,$get_admin_name,$firstname,$lastname,'','',$admin_company_name,$booking_time,$client_city,$client_state,$client_zip,$company_city,$company_state,$company_zip,$company_country,$company_phone,$company_email,$company_address,$get_admin_name);
		
        /* Client Email Template */
        $emailtemplate->email_subject="Appointment Rescheduled by you";
        $emailtemplate->user_type="C";
        $clientemailtemplate=$emailtemplate->readone_client_email_template_body();
        if($clientemailtemplate[2] != ''){
            $clienttemplate = base64_decode($clientemailtemplate[2]);
        }else{
            $clienttemplate = base64_decode($clientemailtemplate[3]);
        }
        $subject = "";
        if($_POST['user'] == "customer"){
            $subject = $label_language_values[strtolower(str_replace(" ","_",$clientemailtemplate[1]))];
        }else{
            $subject = $label_language_values['appointment_rescheduled_by_service_provider'];
        }

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
        $adminsubject = "";
        if($_POST['user'] == "customer"){
            $adminsubject = $label_language_values[strtolower(str_replace(" ","_",$adminemailtemplate[1]))];
        }else{
            $adminsubject = $label_language_values['appointment_rescheduled_by_you'];
        }

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
				$phone = $setting->get_option('ct_sms_textlocal_admin_phone');				
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
                        'src' => $setting->get_option('ct_sms_plivo_sender_number'),
                        'dst' => $phone,
                        'text' => $client_sms_body,
                        'method' => 'POST'
                    );
                    $response = $p_client->send_message($params);
                    /* MESSAGE SENDING CODE ENDED HERE*/
                }
            }
            if($setting->get_option('ct_sms_plivo_send_sms_to_admin_status') == "Y"){
                $auth_id = $setting->get_option('ct_sms_plivo_account_SID');
				$auth_token = $setting->get_option('ct_sms_plivo_auth_token');
				$p_admin = new Plivo\RestAPI($auth_id, $auth_token, '', '');

				$template = $objdashboard->gettemplate_sms("RS",'A');
                $phone = $admin_phone_plivo;
                if($template[4] == "E") {
                    if($template[2] == ""){
                        $message = base64_decode($template[3]);
                    }
                    else{
                        $message = base64_decode($template[2]);
                    }
                    $client_sms_body = str_replace($searcharray,$replacearray,$message);
                    $params = array(
                        'src' => $setting->get_option('ct_sms_plivo_sender_number'),
                        'dst' => $phone,
                        'text' => $client_sms_body,
                        'method' => 'POST'
                    );
                    $response = $p_admin->send_message($params);
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

				$template = $objdashboard->gettemplate_sms("RS",'A');
                $phone = $admin_phone_twilio;
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
                        "To" => $phone,
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
				
				
				 $emailtemplate->email_subject="Appointment Rescheduled By Customer";
				$emailtemplate->user_type="S";
				$staffemailtemplate=$emailtemplate->readone_client_email_template_body();
				
				if($staffemailtemplate[2] != ''){
					$stafftemplate = base64_decode($staffemailtemplate[2]);
				}else{
					$stafftemplate = base64_decode($staffemailtemplate[3]);
				}
				$subject=$label_language_values[strtolower(str_replace(" ","_",$staffemailtemplate[1]))];
			   
				if($setting->get_option('ct_staff_email_notification_status') == 'Y' && $staffemailtemplate[4]=='E' ){
					$client_email_body = str_replace($searcharray,$replacearray,$stafftemplate);
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
					$mail_a->AddAddress($get_staff_email, $get_staff_name);
					$mail_a->Subject = $subject;
					$mail_a->Body = $client_email_body;
					$mail_a->send();
					$mail_a->ClearAllRecipients();
				}
				
				
				/* TEXTLOCAL CODE */
				if($setting->get_option('ct_sms_textlocal_status') == "Y")
				{				
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
														'src' => $setting->get_option('ct_sms_plivo_sender_number'),
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
    else{
        echo "2";
    }
}
if(isset($_POST['update_booking_users'])){
  $id=$order = $_POST['id'];
	$gc_event_id = $_POST['gc_event_id'];
	$gc_staff_event_id = $_POST['gc_staff_event_id'];
	$pid = $_POST['pid'];
	$lastmodify = date('Y-m-d H:i:s');
    $cancel_reson_book = $_POST['cancel_reson_book'];

    $objuserdetails->update_booking_of_user($order,$cancel_reson_book,$lastmodify);

    $orderdetail = $objdashboard->getclientorder($id);
    $clientdetail = $objdashboard->clientemailsender($id);
	
	/* Delete in Google Calendar Start */
	if($gc_hook->gc_purchase_status() == 'exist'){
		echo $gc_hook->gc_cancel_reject_booking_hook();
	}
	/* Delete in Google Calendar End */
	
    /*$booking_date = date("Y-m-d H:i", strtotime($clientdetail['booking_date_time']));*/
	
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
    /* $admin_name = $clientdetail['fullname']; */


    $price=$general->ct_price_format($orderdetail[2],$symbol_position,$decimal);

    /* methods */
    $units = $label_language_values['none'];
    $methodname=$label_language_values['none'];
    $hh = $booking->get_methods_ofbookings($orderdetail[4]);
    $count_methods = mysqli_num_rows($hh);
    $hh1 = $booking->get_methods_ofbookings($orderdetail[4]);

    if($count_methods > 0){
        while($jj = mysqli_fetch_array($hh1)){
            if($units == $label_language_values['none']){
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
    $addons = $label_language_values['none'];
    $hh = $booking->get_addons_ofbookings($orderdetail[4]);
    while($jj = mysqli_fetch_array($hh)){
        if($addons == $label_language_values['none']){
            $addons = $jj['addon_service_name']."-".$jj['addons_service_qty'];
        }
        else
        {
            $addons = $addons.",".$jj['addon_service_name']."-".$jj['addons_service_qty'];
        }
    }


    /*Guest User */
    if($orderdetail[4]==0)
    {
        $gc  = $objdashboard->getguestclient($orderdetail[4]);
        $temppp= unserialize(base64_decode($gc[5]));
        $temp = str_replace('\\','',$temppp);
        $vc_status = $temp['vc_status'];
        if($vc_status == 'N'){
            $final_vc_status = $label_language_values['no'];
        }
        elseif($vc_status == 'Y'){
            $final_vc_status = $label_language_values['yes'];
        }else{
            $final_vc_status = "N/A";
        }
        $p_status = $temp['p_status'];
        if($p_status == 'N'){
            $final_p_status = $label_language_values['no'];
        }
        elseif($p_status == 'Y'){
            $final_p_status = $label_language_values['yes'];
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
		$client_city = $temp['city'];		$client_state = $temp['state'];		$client_zip	= $temp['zip'];

    }
    else
        /*Registered user */
    {
        $c  = $objdashboard->getguestclient($orderdetail[4]);


        $temppp= unserialize(base64_decode($c[5]));
        $temp = str_replace('\\','',$temppp);
        $vc_status = $temp['vc_status'];
        if($vc_status == 'N'){
            $final_vc_status = $label_language_values['no'];
        }
        elseif($vc_status == 'Y'){
            $final_vc_status = $label_language_values['yes'];
        }else{
            $final_vc_status = "N/A";
        }
        $p_status = $temp['p_status'];
        if($p_status == 'N'){
            $final_p_status = $label_language_values['no'];
        }
        elseif($p_status == 'Y'){
            $final_p_status = $label_language_values['yes'];
        }else{
            $final_p_status = "N/A";
        }
		
		$client_phone_no = $c[4];
	$client_phone_length = strlen($client_phone_no);
			
			if($client_phone_length > 6){
				$client_phone = $client_phone_no;
			}else{
				$client_phone = "N/A";
			}
			
		/* $client_name_value= explode(" ",$c[2]);
			$client_first_name = $client_name_value[0];
			$client_last_name =	$client_name_value[1]; */
			
			$client_namess= explode(" ",$c[2]);
			$cnamess = array_filter($client_namess);
			$ccnames = array_values($cnamess);
			if(sizeof((array)$ccnames)>0){
				$client_first_name =  $ccnames[0]; 
				if(isset($ccnames[1])){
					$client_last_name =  $ccnames[1];
				}else{
					$client_last_name =  '';
				}
			}else{
				$client_first_name =  ''; 
				$client_last_name =  ''; 
			}
			
					if($client_first_name=="" && $client_last_name==""){
						$firstname = "User";
						$lastname = "";
						$client_name = $firstname.' '.$lastname;
					}elseif($client_first_name!="" && $client_last_name!=""){
						$firstname = $client_first_name;
						$lastname = $client_last_name;
						$client_name = $firstname.' '.$lastname;
					}elseif($client_first_name!=""){
						$firstname = $client_first_name;
						$lastname = "";
						$client_name = $firstname.' '.$lastname;
					}elseif($client_last_name!=""){
						$firstname = "";
						$lastname = $client_last_name;
						$client_name = $firstname.' '.$lastname;
					}
					
			$client_notes = $temp['notes'];	
					if($client_notes==""){
						$client_notes = "N/A";
					}		
			
			$client_status = $temp['contact_status'];	
					if($client_status==""){
						$client_status = "N/A";
					}		
			
        /* $client_name=$c[2];
        $firstname=$client_name;
        $lastname=''; */
        $client_email=$c[3];
       /*  $client_phone=$c[4]; */
        $payment_status=$orderdetail[5];
        $final_vc_status;
        $final_p_status;
        $client_address=$temp['address'];
      /*   $client_notes=$temp['notes'];
        $client_status=$temp['contact_status'];	 */
		$client_city = $temp['city'];	
		$client_state = $temp['state'];	
		$client_zip	= $temp['zip'];
    }
	$payment_status = strtolower($payment_status);
	if($payment_status == "pay at venue"){
		$payment_status = ucwords($label_language_values['pay_locally']);
	}else{
		$payment_status = ucwords($payment_status);
	}
    $searcharray = array('{{service_name}}','{{booking_date}}','{{business_logo}}','{{business_logo_alt}}','{{client_name}}','{{methodname}}','{{units}}','{{addons}}','{{client_email}}','{{phone}}','{{payment_method}}','{{vaccum_cleaner_status}}','{{parking_status}}','{{notes}}','{{contact_status}}','{{address}}','{{price}}','{{admin_name}}','{{firstname}}','{{lastname}}','{{app_remain_time}}','{{reject_status}}','{{company_name}}','{{booking_time}}','{{client_city}}','{{client_state}}','{{client_zip}}','{{company_city}}','{{company_state}}','{{company_zip}}','{{company_country}}','{{company_phone}}','{{company_email}}','{{company_address}}','{{admin_name}}');

    $replacearray = array($service_name, $booking_date , $business_logo, $business_logo_alt, $client_name,$methodname, $units, $addons,$client_email, $client_phone, $payment_status, $final_vc_status, $final_p_status, $client_notes, $client_status,$client_address,$price,$get_admin_name,$firstname,$lastname,'','',$admin_company_name,$booking_time,$client_city,$client_state,$client_zip,$company_city,$company_state,$company_zip,$company_country,$company_phone,$company_email,$company_address,$get_admin_name);

    /* Client template */
    $emailtemplate->email_subject="Appointment Cancelled by you";
    $emailtemplate->user_type="C";
    $clientemailtemplate=$emailtemplate->readone_client_email_template_body();

    if($clientemailtemplate[2] != ''){
        $clienttemplate = base64_decode($clientemailtemplate[2]);
    }else{
        $clienttemplate = base64_decode($clientemailtemplate[3]);
    }
		$subject=$label_language_values[strtolower(str_replace(" ","_",$clientemailtemplate[1]))];

    if($setting->get_option('ct_client_email_notification_status') == 'Y' && $clientemailtemplate[4]=='E' ){

        echo $client_email_body = str_replace($searcharray,$replacearray,$clienttemplate);
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
    /* Admin Template */
    $emailtemplate->email_subject="Appointment Cancelled By Customer";
    $emailtemplate->user_type="A";
    $adminemailtemplate=$emailtemplate->readone_client_email_template_body();

    if($adminemailtemplate[2] != ''){
        $admintemplate = base64_decode($adminemailtemplate[2]);
    }else{
        $admintemplate = base64_decode($adminemailtemplate[3]);
    }
		$adminsubject=$label_language_values[strtolower(str_replace(" ","_",$adminemailtemplate[1]))];

    if($setting->get_option('ct_admin_email_notification_status')=='Y' && $adminemailtemplate[4]=='E'){
        echo $admin_email_body = str_replace($searcharray,$replacearray,$admintemplate);

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
			$template = $objdashboard->gettemplate_sms("CC",'C');
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
			$template = $objdashboard->gettemplate_sms("CC",'A');
			$phone = $setting->get_option('ct_sms_textlocal_admin_phone');				
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
        $auth_id = $setting->get_option('ct_sms_plivo_account_SID');
        $auth_token = $setting->get_option('ct_sms_plivo_auth_token');
        $p = new Plivo\RestAPI($auth_id, $auth_token, '', '');
		$plivo_sender_number = $setting->get_option('ct_sms_plivo_sender_number');
		$twilio_sender_number = $setting->get_option('ct_sms_twilio_sender_number');
		
        if($setting->get_option('ct_sms_plivo_send_sms_to_client_status') == "Y"){
            $template = $objdashboard->gettemplate_sms("CC",'C');
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
                $response = $p->send_message($params);
                /* MESSAGE SENDING CODE ENDED HERE*/
            }
        }
        if($setting->get_option('ct_sms_plivo_send_sms_to_admin_status') == "Y"){
            $template = $objdashboard->gettemplate_sms("CC",'A');
            $phone = $admin_phone_plivo;
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
                    'dst' => $phone,
                    'text' => $client_sms_body,
                    'method' => 'POST'
                );
                $response = $p->send_message($params);
                /* MESSAGE SENDING CODE ENDED HERE*/
            }
        }
    }
    if($setting->get_option('ct_sms_twilio_status') == "Y"){
        if($setting->get_option('ct_sms_twilio_send_sms_to_client_status') == "Y"){
			$AccountSid = $setting->get_option('ct_sms_twilio_account_SID');
			$AuthToken = $setting->get_option('ct_sms_twilio_auth_token'); 
			$twilliosms_client = new Services_Twilio($AccountSid, $AuthToken);
            $template = $objdashboard->gettemplate_sms("CC",'C');
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
			$AuthToken = $setting->get_option('ct_sms_twilio_auth_token'); 
			$twilliosms_admin = new Services_Twilio($AccountSid, $AuthToken);
            $template = $objdashboard->gettemplate_sms("CC",'A');
            $phone = $admin_phone_twilio;
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
                    "To" => $phone,
                    "Body" => $client_sms_body));
            }
        }
    }
	if($setting->get_option('ct_nexmo_status') == "Y"){
		if($setting->get_option('ct_sms_nexmo_send_sms_to_client_status') == "Y"){
			$template = $objdashboard->gettemplate_sms("CC",'C');
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
			$template = $objdashboard->gettemplate_sms("CC",'A');
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
				
				/* Client template */
				$emailtemplate->email_subject="Appointment Cancelled By Customer";
				$emailtemplate->user_type="S";
				$clientemailtemplate=$emailtemplate->readone_client_email_template_body();

				if($clientemailtemplate[2] != ''){
						$clienttemplate = base64_decode($clientemailtemplate[2]);
				}else{
						$clienttemplate = base64_decode($clientemailtemplate[3]);
				}
				$subject=$label_language_values[strtolower(str_replace(" ","_",$clientemailtemplate[1]))];

				if($setting->get_option('ct_staff_email_notification_status') == 'Y' && $clientemailtemplate[4]=='E' ){
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
				if($setting->get_option('ct_sms_textlocal_status') == "Y")
				{				
					if($setting->get_option('ct_sms_textlocal_send_sms_to_staff_status') == "Y"){
						if(isset($staff_phone) && !empty($staff_phone))
						{	
							$template = $objdashboard->gettemplate_sms("CC",'S');
							$phone = $staff_phone;		
							$message = "";	
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
						if($setting->get_option('ct_sms_plivo_status')=="Y"){								
							if($setting->get_option('ct_sms_plivo_send_sms_to_staff_status') == "Y"){
								if(isset($staff_phone) && !empty($staff_phone))
								{  
									$template = $objdashboard->gettemplate_sms("CC",'S');
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
											$response = $p->send_message($params);
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
									$AuthToken = $setting->get_option('ct_sms_twilio_auth_token'); 
									$twilliosms_client = new Services_Twilio($AccountSid, $AuthToken);
									$template = $objdashboard->gettemplate_sms("CC",'S');
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
							$template = $objdashboard->gettemplate_sms("CC",'S');
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

if(isset($_POST['insert_crm_user_detail'])){
	/** new customer add **/
	$user->user_pwd=md5($_POST['admin_cus_pwd']);
	$pass=$_POST['admin_cus_pwd'];
	$user->first_name=ucfirst($_POST['admin_cus_fstnm']);
	$fnm=$_POST['admin_cus_fstnm'];
	$user->last_name=ucfirst($_POST['admin_cus_lstnm']);
	$lnm=$_POST['admin_cus_lstnm'];
	$user->user_email=$_POST['admin_cus_email'];
	$eml=$_POST['admin_cus_email'];
	$user->phone=$_POST['admin_cus_phno'];
	$client_phone = $_POST['admin_cus_phno'];
	$user->address=$_POST['admin_cus_str_addr'];
	$user->zip=$_POST['admin_cus_zipcode'];
	$user->city=$_POST['admin_cus_city'];
	$user->state=$_POST['admin_cus_state'];
	$user->notes=$_POST['admin_cus_note'];
	$user->vc_status="-";
	$user->p_status="-";
	$user->status='E';
	$user->contact_status="";
	$user->usertype=serialize(array('client'));
	$user->stripe_id = "";
	if($setting->get_option('ct_stripe_payment_form_status') == "on" && $setting->get_option('ct_stripe_create_plan') == "Y"){
		include(dirname(dirname(dirname(__FILE__))).'/assets/stripe/stripe.php');
		$secret_key = $setting->get_option('ct_stripe_secretkey');
		try{
			\Stripe\Stripe::setApiKey($secret_key);
			$objcustomer = new \Stripe\Customer;
			$create_customer = $objcustomer::Create(array(
				"email"    => $_POST['admin_cus_email'],
				"description" => $_POST['admin_cus_email']." This id name is ".$user->first_name." ".$user->last_name
			));
			$user->stripe_id = $create_customer->id;
		}	catch (Exception $e) {
			$error = $e->getMessage();
	  }
	}
	$add_user=$user->add_user();
	if($add_user){
		echo "Okkk";
		die();
	}else{
		echo "NoData";
		die();
	}
}


if(isset($_POST['getallcus'])){
	$emlsms->eml_sms_id=$_POST['eml_id'];
	$cusdata=$emlsms->eml_read_one();
	$cusids=$cusdata[1];
	/* echo $cusids; */
	$cus_all_data="";
	$splt=explode(",",$cusids);
	for($i=0;$i<sizeof((array)$splt);$i++){
		$objuserdetails->id=$splt[$i];
		$usrdt=$objuserdetails->readone();
		/* print_r($usrdt); */
		/* $cus_all_data = $usrdt[3]." ".$usrdt[4].", "; */
		$okkk = "<button type=\"button\" class=\"btn btn-info fc btn-xs of-h mr-10 mb-15\">".$usrdt[3]." ".$usrdt[4]."</button>";
		$cus_all_data .= $okkk;
	}
	/* $cus_all_data = chop($cus_all_data,", "); */
	echo $cus_all_data;
}

if(isset($_POST['getallcussms'])){
	$emlsms->eml_sms_id=$_POST['eml_id'];
	$cusdata=$emlsms->sms_read_one();
	$cusids=$cusdata[1];
	/* echo $cusids; */
	$cus_all_data="";
	$splt=explode(",",$cusids);
	for($i=0;$i<sizeof((array)$splt);$i++){
		$objuserdetails->id=$splt[$i];
		$usrdt=$objuserdetails->readone();
		/* print_r($usrdt); */
		/* $cus_all_data = $usrdt[3]." ".$usrdt[4].", "; */
		$okkk = "<button type=\"button\" class=\"btn btn-info fc btn-xs of-h mr-10 mb-15\">".$usrdt[3]." ".$usrdt[4]."</button>";
		$cus_all_data .= $okkk;
	}
	/* $cus_all_data = chop($cus_all_data,", "); */
	echo $cus_all_data;
}
?>