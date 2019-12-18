<?php 

include(dirname(dirname(dirname(__FILE__)))."/objects/class_connection.php");
include(dirname(dirname(dirname(__FILE__)))."/objects/class_dashboard.php");
include(dirname(dirname(dirname(__FILE__)))."/header.php");
include(dirname(dirname(dirname(__FILE__)))."/objects/class_setting.php");
include(dirname(dirname(dirname(__FILE__))).'/objects/class_booking.php');
include(dirname(dirname(dirname(__FILE__))).'/objects/class_general.php');
include(dirname(dirname(dirname(__FILE__))).'/objects/class.phpmailer.php');
include(dirname(dirname(dirname(__FILE__))).'/objects/class_adminprofile.php');
include(dirname(dirname(dirname(__FILE__))).'/objects/class_front_first_step.php');
include(dirname(dirname(dirname(__FILE__))).'/objects/plivo.php');
include(dirname(dirname(dirname(__FILE__))).'/objects/class_email_template.php');

include(dirname(dirname(dirname(__FILE__))).'/assets/twilio/Services/Twilio.php');
include(dirname(dirname(dirname(__FILE__)))."/objects/class_nexmo.php");
if ( is_file(dirname(dirname(dirname(__FILE__))).'/extension/GoogleCalendar/google-api-php-client/src/Google_Client.php')) 
{
	require_once dirname(dirname(dirname(__FILE__))).'/extension/GoogleCalendar/google-api-php-client/src/Google_Client.php';
}
include(dirname(dirname(dirname(__FILE__)))."/objects/class_gc_hook.php");

$con = new cleanto_db();
$conn = $con->connect();

$nexmo_admin = new cleanto_ct_nexmo();
$nexmo_client = new cleanto_ct_nexmo();

$first_step=new cleanto_first_step();
$first_step->conn=$conn;

$objdashboard = new cleanto_dashboard();
$objdashboard->conn = $conn;

$gc_hook = new cleanto_gcHook();
$gc_hook->conn = $conn;

$objadminprofile = new cleanto_adminprofile();
$objadminprofile->conn = $conn;

$objadmin = new cleanto_adminprofile();
$objadmin->conn = $conn;

$objbooking = new cleanto_booking();
$objbooking->conn = $conn;

$setting = new cleanto_setting();
$setting->conn = $conn;


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

$mail_s = new cleanto_phpmailer();
$mail_s->Host = $setting->get_option('ct_smtp_hostname');
$mail_s->Username = $setting->get_option('ct_smtp_username');
$mail_s->Password = $setting->get_option('ct_smtp_password');
$mail_s->Port = $setting->get_option('ct_smtp_port');
$mail_s->SMTPSecure = $setting->get_option('ct_smtp_encryption');
$mail_s->SMTPAuth = $mail_SMTPAuth;
$mail_s->CharSet = "UTF-8";

/*NEXMO SMS GATEWAY VARIABLES*/

$nexmo_admin->ct_nexmo_api_key = $setting->get_option('ct_nexmo_api_key');
$nexmo_admin->ct_nexmo_api_secret = $setting->get_option('ct_nexmo_api_secret');
$nexmo_admin->ct_nexmo_from = $setting->get_option('ct_nexmo_from');

$nexmo_client->ct_nexmo_api_key = $setting->get_option('ct_nexmo_api_key');
$nexmo_client->ct_nexmo_api_secret = $setting->get_option('ct_nexmo_api_secret');
$nexmo_client->ct_nexmo_from = $setting->get_option('ct_nexmo_from');

$general=new cleanto_general();
$general->conn=$conn;

$symbol_position=$setting->get_option('ct_currency_symbol_position');
$decimal=$setting->get_option('ct_price_format_decimal_places');

$emailtemplate=new cleanto_email_template();
$emailtemplate->conn=$conn;

$getcurrency_symbol_position=$setting->get_option('ct_currency_symbol_position');
$getdateformate = $setting->get_option('ct_date_picker_date_format');
$time_format = $setting->get_option('ct_time_format');

$booking = new cleanto_booking();
$booking->conn = $conn;
$lang = $setting->get_option("ct_language");
$label_language_values = array();
$language_label_arr = $setting->get_all_labelsbyid($lang);


/*SMS GATEWAY VARIABLES*/
$plivo_sender_number = $setting->get_option('ct_sms_plivo_sender_number');
$twilio_sender_number = $setting->get_option('ct_sms_twilio_sender_number');

/* textlocal gateway variables */
$textlocal_username =$setting->get_option('ct_sms_textlocal_account_username');
$textlocal_hash_id = $setting->get_option('ct_sms_textlocal_account_hash_id');

/*NEED VARIABLE FOR EMAIL*/
$company_city = $setting->get_option('ct_company_city'); $company_state = $setting->get_option('ct_company_state'); $company_zip = $setting->get_option('ct_company_zip_code'); $company_country = $setting->get_option('ct_company_country'); 
$company_phone = strlen($setting->get_option('ct_company_phone')) < 6 ? "" : $setting->get_option('ct_company_phone');
$company_email = $setting->get_option('ct_company_email');$company_address = $setting->get_option('ct_company_address'); 

/*CHECK FOR VC AND PARKING STATUS*/
$global_vc_status = $setting->get_option('ct_vc_status');
$global_p_status = $setting->get_option('ct_p_status');
$admin_phone_twilio = $setting->get_option('ct_sms_twilio_admin_phone_number');
$admin_phone_plivo = $setting->get_option('ct_sms_plivo_admin_phone_number');
/*CHECK FOR VC AND PARKING STATUS END*/

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
/* set business logo and logo alt */
		
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
function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
if(isset($_POST['getgc_event_detail'])){
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
	
	$event_id = $_POST["orderid"];
	
	/** Get Google Calendar Bookings **/
	$CalenderBooking = array();
	if($gc_hook->gc_purchase_status() == 'exist'){
		$gc_hook->google_cal_TwoSync_one_event_admin_hook();
	}
	/** Get Google Calendar Bookings **/
	$from_time=$CalenderBooking["start"]; 
	$to_time=$CalenderBooking["end"];
	$total_duration = round(abs($to_time - $from_time) / 60,2);
	include(dirname(dirname(dirname(__FILE__))).'/assets/lib/date_translate_array.php');
	?>
	<div class="vertical-alignment-helper">
		<div class="modal-dialog modal-md vertical-align-center">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close closesss" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title"><?php echo $label_language_values['booking_details'];?></h4>
				</div>
				<div class="modal-body mb-20">
          <ul class="list-unstyled ct-cal-booking-details mypopupul">
						<li class="gc_li">
							<label><?php echo "Event Title";/* $label_language_values['methods']; */?></label>
							<span class="calendar_providername span-scroll">: <?php  echo $CalenderBooking["title"];?></span>
						</li>
						<li class="gc_li">
							<label><?php echo "Event Description";/* $label_language_values['methods']; */?></label>
							<span class="calendar_providername span-scroll">: <?php  echo $CalenderBooking["description"];?></span>
						</li>
						<li class="gc_li">
							<label><?php echo "Event Start DateTime";/* $label_language_values['methods']; */?></label>
							<span class="calendar_providername span-scroll">: <?php    
							echo str_replace($english_date_array,$selected_lang_label,date($getdateformate, $CalenderBooking["start"]));
								if($time_format == 12){
									echo str_replace($english_date_array,$selected_lang_label,date("h:i A",$CalenderBooking["start"]));
								}else{
									echo date("H:i", $CalenderBooking["start"]);
								}
							?>
							</span>
						</li>
						<li class="gc_li">
							<label><?php echo "Event End DateTime";/* $label_language_values['methods']; */?></label>
							<span class="calendar_providername span-scroll">: <?php echo str_replace($english_date_array,$selected_lang_label,date($getdateformate, $CalenderBooking["end"]));
								if($time_format == 12){
									echo str_replace($english_date_array,$selected_lang_label,date("h:i A",$CalenderBooking["end"]));
								}else{
									echo date("H:i", $CalenderBooking["end"]);
								}
							?>
							</span>
						</li>
						<li class="gc_li">
							<label><?php echo "Event Duration";/* $label_language_values['methods']; */?></label>
							<span class="calendar_providername span-scroll">: <?php     echo $total_duration." ".$label_language_values['minutes']; ?>
							</span>
						</li>
						<li class="gc_li">
							<label><?php echo "Event Create DateTime";/* $label_language_values['methods']; */?></label>
							<span class="calendar_providername span-scroll">: <?php echo str_replace($english_date_array,$selected_lang_label,date($getdateformate, $CalenderBooking["created_date"]));
								if($time_format == 12){
									echo str_replace($english_date_array,$selected_lang_label,date("h:i A",$CalenderBooking["created_date"]));
								}else{
									echo date("H:i", $CalenderBooking["created_date"]);
								}
							?>
							</span>
						</li>
						<li class="gc_li">
							<label><?php echo "Event Updated DateTime";/* $label_language_values['methods']; */?></label>
							<span class="calendar_providername span-scroll">: <?php echo str_replace($english_date_array,$selected_lang_label,date($getdateformate, $CalenderBooking["update_date"]));
								if($time_format == 12){
									echo str_replace($english_date_array,$selected_lang_label,date("h:i A",$CalenderBooking["update_date"]));
								}else{
									echo date("H:i", $CalenderBooking["update_date"]);
								}
							?>
							</span>
						</li>
					</ul>
				</div>
				<div class="modal-footer">
          <div class="cta-col12 ct-footer-popup-btn text-center">
						<div class="fln-mrat-dib ">
						<?php           
						if($currDateTime_withTZ <= $CalenderBooking["start"]){
						?>
							<span class="col-xs-6 np ct-w-32 myconfirmclass">
								<a class="btn btn-link ct-small-btn ct-reschedual-calendar-appointment-cal" data-id="<?php    echo $_POST['orderid'];?>" data-duration="<?php    echo $total_duration;?>" title="<?php       echo $label_language_values['rescheduled']; ?>"><i class="fa fa-pencil-square-o fa-2x"></i><br><?php       echo $label_language_values['rescheduled']; ?></a>
							</span>
						<?php      } ?>
							<span class="col-xs-6 np ct-w-32">
								<a data-id="<?php echo $_POST['orderid'];?>" id="ct-delete-appointment-cal-popup" class="ct-delete-appointment-cal-popup btn btn-link ct-small-btn booking_deletess" rel="popover" data-placement='top' title="<?php echo $label_language_values['delete_this_appointment'];?>"><i class="fa fa-trash-o fa-2x"></i><br /> <?php  echo $label_language_values['delete'];?></a>
							</span>
							<div id="popover-delete-appointment-cal-popupss<?php  echo $_POST['orderid'];?>" style="display: none;">
								<div class="arrow"></div>
								<table class="form-horizontal" cellspacing="0">
									<tbody>
									<tr>
										<td>
											<button id="" data-id="<?php echo $_POST['orderid'];?>" value="Delete" class="btn btn-danger btn-sm mybtn_calendar_delete_booking" type="submit"><?php echo $label_language_values['delete'];?></button>
											<button id="ct-close-del-appointment-cal-popup" class="btn btn-default btn-sm" href="javascript:void(0)"><?php echo $label_language_values['cancel'];?></button>
										</td>
									</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php     
}
if(isset($_POST['getcleintdetailwith_updatereadstatus'])){
	/*new file include*/
	include(dirname(dirname(dirname(__FILE__))).'/assets/lib/date_translate_array.php');
    $orderdetail = $objdashboard->getclientorder($_POST['orderid']);
    $objdashboard->update_read_status($_POST['orderid']);
    ?>
    <div class="vertical-alignment-helper">
        <div class="modal-dialog modal-md vertical-align-center">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close closesss" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title"><?php echo $label_language_values['booking_details'];?></h4>
                </div>
                <div class="modal-body mb-20">
                    <ul class="list-unstyled ct-cal-booking-details mypopupul">
                        <li>
                            <label style="width: 120px; margin-right: 0;"><?php echo $label_language_values['booking_status'];?> : </label>
                            <div class="ct-booking-status">
                                <?php 
								$reject_reason = $orderdetail[7];
								$booking_duration = $orderdetail[8];
								$booking_duration_text = "";
								if($booking_duration != 0){
									$hours = intval($booking_duration/60);
									$minutes = fmod( $booking_duration ,60);

									$booking_duration_text = $hours." ".$label_language_values['hours']." ".$minutes." ".$label_language_values['minutes'];
								}else{
									$booking_duration_text = "";
								}
                                if($orderdetail[6]=='A')
                                {
                                    $booking_stats=$label_language_values['active'];
                                }
                                elseif($orderdetail[6]=='C')
                                {
                                    $booking_stats='<i class="fa fa-check txt-success">'.$label_language_values['confirmed'].'</i>';
                                }
                                elseif($orderdetail[6]=='R')
                                {
                                    $booking_stats='<i class="fa fa-ban txt-danger">'.$label_language_values['rejected'].'</i>';
                                }
                                elseif($orderdetail[6]=='RS')
                                {
                                    $booking_stats='<i class="fa fa-pencil-square-o txt-info">'.$label_language_values['rescheduled'].'</i>';
                                }
                                elseif($orderdetail[6]=='CC')
                                {
                                    $booking_stats='<i class="fa fa-times txt-primary">'.$label_language_values['cancelled_by_client'].'</i>';
                                }
                                elseif($orderdetail[6]=='CS')
                                {
                                    $booking_stats='<i class="fa fa-times-circle-o txt-info">'.$label_language_values['cancelled_by_service_provider'].'</i>';
                                }
                                elseif($orderdetail[6]=='CO')
                                {
                                    $booking_stats='<i class="fa fa-thumbs-o-up txt-success">'.$label_language_values['appointment_completed'].'</i>';
                                }
                                else
                                {
                                    $booking_stats='<i class="fa fa-thumbs-o-down txt-danger">'.$label_language_values['appointment_marked_as_no_show'].'</i>';
                                }
                                echo $booking_stats;
                                ?>
                            </div>
                        </li>
                        <li class="ct-second-child">
                            <span><i class="fa fa-calendar"></i><?php echo str_replace($english_date_array,$selected_lang_label,date($getdateformate, strtotime($orderdetail[0])));?>  <i class="fa fa-clock-o ml-10 mr-1"></i>
							<?php 
								if($time_format == 12){
								?>
								<?php  echo str_replace($english_date_array,$selected_lang_label,date("h:i A",strtotime($orderdetail[0])));?></span>
								<?php 
								}else{
								?>
								<?php  echo date("H:i", strtotime($orderdetail[0]));?></span>
								<?php 
								}
								?>
                            </span>
                        </li>

                        <li>
                            <label><?php echo $label_language_values['service'];?></label>
                            <span class="service-html span-scroll">: <?php  echo $orderdetail[1];?></span>
                        </li>


                        <?php 
                        /* metrhods */
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

                        ?>
                        <li>
                            <label><?php echo $label_language_values['methods'];?></label>
                            <span class="calendar_providername span-scroll">: <?php  echo $methodname;?></span>
                        </li>
                        <li>
                            <label><?php echo $label_language_values['units'];?></label>
                            <span class="calendar_providername span-scroll">: <?php  echo $units;?></span>
                        </li>
                        <li>
                            <label><?php echo $label_language_values['addons'];?></label>
                            <span class="calendar_providername span-scroll">: <?php  echo $addons;?></span>
                        </li>

                        <li>
                            <label><?php echo $label_language_values['price'];?></label>
                            <span class="span-scroll">: <?php  echo $general->ct_price_format($orderdetail[2],$symbol_position,$decimal);
                               ?> </span>
                        </li>
						
						<?php   if($booking_duration_text != ""){ ?>
						<li class="<?php   if ($setting->get_option('ct_show_time_duration') == 'N') {echo "force_hidden";} ?>">
                            <label><?php echo $label_language_values['duration'];?></label>
                            <span class="span-scroll">: <?php   echo $booking_duration_text; ?> </span>
                        </li>
						<?php    } ?>

                        <li><h6 class="ct-customer-details-hr"><?php echo $label_language_values['customer'];?></h6>
                        </li>
                        <?php 
                        if($orderdetail[4]==0)
                        {
                            $gc  = $objdashboard->getguestclient($orderdetail[4]);
                            ?>
                            <li>
                                <label><?php echo $label_language_values['name'];?></label>
                                <span class="client_name span-scroll">: <?php  echo $gc[2];?></span>
                            </li>
                            <li>
                                <label><?php echo $label_language_values['email'];?></label>
                                <span class="client_email span-scroll">: <?php  echo $gc[3];?></span>
                            </li>
                            <li>
                                <label><?php echo $label_language_values['phone'];?></label>
                                <span class="client_phone span-scroll">: <?php  echo $gc[4];?></span>
                            </li>
                            <li>
                                <label><?php echo $label_language_values['payment'];?></label>
                                <span class="client_payment span-scroll">: <?php  echo $orderdetail[6];?></span>
                            </li>
                            <?php 
							$temppp= unserialize(base64_decode($gc[5]));
							$temp = str_replace('\\','',$temppp);
							$vc_status = $temp['vc_status'];
                               if($vc_status == 'N'){
                                $final_vc_status = $label_language_values['no'];
                            }
                            elseif($vc_status == 'Y'){
								$final_vc_status = $label_language_values['yes'];
                            }else{
                                $final_vc_status = "-";
                            }
                            $p_status = $temp['p_status'];
                            if($p_status == 'N'){
                                $final_p_status = $label_language_values['no'];
                            }
                            elseif($p_status == 'Y'){
								$final_p_status = $label_language_values['yes'];
                            }else{
                                $final_p_status = "-";
                            }
                            ?>

                            <?php  
							if($global_vc_status == 'Y' && $final_vc_status != '-'){
								?>
								<li>
                                <label><?php echo $label_language_values['vaccum_cleaner'];?></label>
                                <span class="client_vc_status span-scroll">: <?php  echo $final_vc_status;?></span>
								</li>
								<?php  
							}
							if($global_p_status == 'Y'  && $final_p_status != "-"){
								?>
								<li>
                                <label><?php echo $label_language_values['parking'];?></label>
                                <span class="client_parking span-scroll">: <?php  echo $final_p_status;?></span>
								</li>
								<?php  
							}
							?>

                            <?php 
                                if($temp['notes']!=""){
                                    ?>
                                    <li>
                                        <label><?php echo $label_language_values['notes'];?></label>
                                        <span class="notes span-scroll">: <?php  echo $temp['notes'];?></span>
                                    </li>
                                <?php    
                                }
								if($reject_reason != ""){
									?>
                                    <li>
                                        <label><?php echo $label_language_values['reason'];?></label>
                                        <span class="reason span-scroll">: <?php  echo $reject_reason;?></span>
                                    </li>
									<?php    
								}
								if($setting->get_option("ct_company_willwe_getin_status") == "Y") { ?>
                            <li>
                                <label><?php echo $label_language_values['contact_status'];?></label>
                                <span class="notes span-scroll">: <?php  echo $temp['contact_status'];?></span>
                            </li>
							<?php  
							}
                        }
                        else
                        {
                            $c  = $objdashboard->getguestclient($orderdetail[4]);
							$client_name = explode(" ",$c[2]);
							$cnamess = array_filter($client_name);
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
							?>
							<?php  if($client_first_name !="" || $client_last_name !=""){ ?>
                            <li>
                                <label><?php echo $label_language_values['name'];?></label>
								
                                <span class="client_name span-scroll">: <?php  if($client_first_name !=""){ echo $client_first_name ." " ; }  if($client_last_name !=""){ echo $client_last_name ; } ?></span>
                            </li>
							<?php  } ?>
							<li>
                                <label><?php echo $label_language_values['email'];?></label>
                                <span class="client_email span-scroll">: <?php  echo $c[3];?></span>
                            </li>
							
						<?php 
							$fetch_phone =  strlen($c[4]);
							if($fetch_phone >= 6){
						?>
                            <li>
                                <label><?php echo $label_language_values['phone'];?></label>
                                <span class="client_phone span-scroll">: <?php  echo $c[4];?></span>
                            </li>
							<?php  }
							$payment_status = strtolower($orderdetail[5]);
							if($payment_status == "pay at venue"){
								$payment_status = ucwords($label_language_values['pay_locally']);
							}else{
								$payment_status = ucwords($payment_status);
							}
							?>
							 <li>
                                <label><?php echo $label_language_values['payment'];?></label>
                                <span class="client_payment span-scroll">: <?php  echo $payment_status;?></span>
                            </li>
                            <?php 
							$temppp= unserialize(base64_decode($c[5]));
							$temp = str_replace('\\','',$temppp);
                            $vc_status = $temp['vc_status'];
							
                            if($vc_status == 'N'){
                                $final_vc_status = $label_language_values['no'];
                            }
                            elseif($vc_status == 'Y'){
								$final_vc_status = $label_language_values['yes'];
                            }else{
                                $final_vc_status = "-";
                            }
                            $p_status = $temp['p_status'];
                            if($p_status == 'N'){
                                $final_p_status = $label_language_values['no'];
                            }
                            elseif($p_status == 'Y'){
								$final_p_status = $label_language_values['yes'];
                            }else{
                                $final_p_status = "-";
                            }
                            ?>
				<?php  if($temp['address']!="" || $temp['city']!="" || $temp['zip']!="" || $temp['state']!=""  ){ ?>			
							<li>
                                <label><?php echo $label_language_values['address'];?></label>
                                <span class="client_address span-scroll">: 
										<?php  if($temp['address']!=""){ echo $temp['address'].", " ; } ?> <?php  if($temp['city']!=""){ echo $temp['city'].", " ; } ?> <?php  if($temp['zip']!=""){ echo $temp['zip'].", " ; } ?><?php if($temp['state']!=""){ echo $temp['state'] ; } ?>
								</span>	
                            </li>
							
				<?php  } ?>		
                            <?php  
							if($global_vc_status == 'Y'&& $final_vc_status != '-'){
								?>
                            <li>
                                <label><?php echo $label_language_values['vaccum_cleaner'];?></label>
                                <span class="client_vc_status span-scroll">: <?php  echo $final_vc_status;?></span>
                            </li>
							
							<?php  }?>
							
							<?php  
							if($global_vc_status == 'Y' && $final_p_status != '-'){
								?>
                            <li>
                                <label><?php echo $label_language_values['parking'];?></label>
                                <span class="client_parking span-scroll">: <?php  echo $final_p_status;?></span>
                            </li>
							<?php  }?>
                            <?php 
                            if($temp['notes']!=""){
                                ?>
                                <li>
                                    <label><?php echo $label_language_values['notes'];?></label>
                                    <span class="notes span-scroll">: <?php  echo $temp['notes'];?></span>
                                </li>
                            <?php 
                            }
							if($reject_reason != ""){
								?>
								<li>
									<label><?php echo $label_language_values['reason'];?></label>
									<span class="reason span-scroll">: <?php  echo $reject_reason;?></span>
								</li>
								<?php    
							}
							if($setting->get_option("ct_company_willwe_getin_status") == "Y") { ?>
                            <li>
                                <label><?php echo $label_language_values['contact_status'];?></label>

                                <span class="notes span-scroll">: <?php  echo $temp['contact_status'];?></span>
                            </li>
                        <?php 
							}
                        }
                        ?>
						<hr>
						<li>
							<label class="assign-app-staff"><?php echo $label_language_values['assign_appointment_to_staff'];?></label>
							<span class="span-scroll-staff">
								<?php 
								$get_staff_services = $objadmin->readall_staff_booking();
								$booking->order_id = $_POST['orderid'];
								$get_staff_assignid = explode(",",$booking->fetch_staff_of_booking());
								
								$staff_html = "";
								$staff_html .= "<select id='staff_select' class='selectpicker col-md-10' data-live-search='true' multiple data-actions-box='true' data-orderid='".$_POST['orderid']."'>";
								
								$booking->booking_date_time = $orderdetail[0];
								$staff_status = $booking->booked_staff_status();
								$staff_status_arr = explode(",",$staff_status);
								
								foreach($get_staff_services as $staff_details)
								{
									$i = "no";
									$staffname = $staff_details['fullname'];
									$staffid = $staff_details['id'];
									$s_s = "";
									if(in_array($staffid,$staff_status_arr)){
										$s_s = "fa fa-calendar-check-o";
									}
									if(in_array($staffid,$get_staff_assignid)){
										$i = "yes";
									}
									if($i == "yes")
									{
										$staff_html .= "<option selected='selected' data-icon='".$s_s." booking-staff-assigned' value='$staffid'>$staffname</option>";
									}
									else{
										$staff_html .= "<option data-icon='".$s_s." booking-staff-assigned' value='$staffid'>$staffname</option>";
									}
								}

								$staff_html .= "</select><a data-orderid='".$_POST['orderid']."' class='save_staff_booking edit_staff btn btn-info'><i class='remove_add_fafa_class fa fa-pencil-square-o'></i></a>";
								echo $staff_html;
								?>
							</span>
						</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <div class="cta-col12 ct-footer-popup-btn text-center">
						<div class="fln-mrat-dib ">
                        <?php   
                        $booking_day = date("Y-m-d", strtotime($orderdetail[0]));
                        $past_day = "no";
                        $current_day = date("Y-m-d"); 

                        if ($current_day > $booking_day)
                        {
                            $past_day = "yes";
                        }
                        else
                        {
                            $past_day = "no";
                        }
                        if($orderdetail[6]=='C' || $orderdetail[6]=='R' || $orderdetail[6]=='CC' || $past_day == "yes"){
                            ?>
                            <span class="col-xs-4 pr-70 ct-w-32">
                                <a data-id="<?php echo $_POST['orderid'];?>" class="btn btn-link confirm_book ct-small-btn ct-complete-appointment" title="<?php echo $label_language_values['complete_appointment'];?>"><i class="fa fa-thumbs-up fa-2x"></i><br /><?php echo $label_language_values['complete'];?></a>
                            </span>
                                <?php 
                        }
                        else{?>
							
								<span class="col-xs-4 np ct-w-32">
									<a data-id="<?php echo $_POST['orderid'];?>" class="btn btn-link ct-small-btn ct-confirm-appointment" title="<?php echo $label_language_values['confirm_appointment'];?>"><i class="fa fa-check fa-2x"></i><br /><?php echo $label_language_values['confirm'];?></a>
								</span>
								<span class="col-xs-4 np ct-w-32">
									<a data-id="<?php echo $_POST['orderid'];?>" id="ct-reject-appointment-cal-popup" class="btn btn-link ct-small-btn book_rejectss" rel="popover" data-placement='top' title="<?php echo $label_language_values['reject_reason'];?>"><i class="fa fa-thumbs-o-down fa-2x"></i><br /><?php echo $label_language_values['reject'];?></a>

									<div id="popover-reject-appointment-cal-popupss<?php  echo $_POST['orderid'];?>" style="display: none;">
										<div class="arrow"></div>
										<table class="form-horizontal" cellspacing="0">
											<tbody>
											<tr>
												<td><textarea class="form-control" id="reason_reject<?php  echo $_POST['orderid'];?>" name="" placeholder="<?php echo $label_language_values['appointment_reject_reason'];?>" required="required" ></textarea></td>
											</tr>
											<tr>
												<td>
													<button data-id="<?php echo $_POST['orderid'];?>" id="" value="Delete" class="btn btn-danger btn-sm reject_bookings" type="submit"><?php echo $label_language_values['reject'];?></button>
													<button id="ct-close-reject-appointment-cal-popup" class="btn btn-default btn-sm" href="javascript:void(0)"><?php echo $label_language_values['cancel'];?></button>
												</td>
											</tr>
											</tbody>
										</table>
									</div><!-- end pop up -->
								</span>
						   <?php   }
							?>

							<span class="col-xs-4 np ct-w-32">
								<a data-id="<?php echo $_POST['orderid'];?>" id="ct-delete-appointment-cal-popup" class="ct-delete-appointment-cal-popup btn btn-link ct-small-btn booking_deletess" rel="popover" data-placement='top' title="<?php echo $label_language_values['delete_this_appointment'];?>"><i class="fa fa-trash-o fa-2x"></i><br /> <?php  echo $label_language_values['delete'];?></a>
							</span>
							<div id="popover-delete-appointment-cal-popupss<?php  echo $_POST['orderid'];?>" style="display: none;">
								<div class="arrow"></div>
								<table class="form-horizontal" cellspacing="0">
									<tbody>
									<tr>
										<td>
											<button id="" data-id="<?php echo $_POST['orderid'];?>" value="Delete" class="btn btn-danger btn-sm mybtndelete_booking" type="submit"><?php echo $label_language_values['delete'];?></button>
											<button id="ct-close-del-appointment-cal-popup" class="btn btn-default btn-sm" href="javascript:void(0)"><?php echo $label_language_values['cancel'];?></button>
										</td>
									</tr>
									</tbody>
								</table>
							</div>
							<!-- end pop up -->
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php 
}
elseif(isset($_POST['complete_booking'])){
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
	
	$lastmodify = date('Y-m-d H:i:s',$currDateTime_withTZ);
	$order_id = $_POST['order_id'];
	
	$objbooking->order_id = $order_id;
	$objbooking->lastmodify = $lastmodify;
	$objbooking->booking_status = "CO";
	
	$objbooking->complete_booking();
}
elseif(isset($_POST['confirm_booking'])){
    $id = $_POST['id']; /*here id ==order id*/
    $orderdetail = $objdashboard->getclientorder($id);
    $lastmodify = date('Y-m-d H:i:s');
    /* Update Confirm status in bookings */
    $objdashboard->confirm_bookings($id,$lastmodify);

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
		$booking_time = date("H:i",strtotime($clientdetail['booking_date_time']));
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
    $addons =  $label_language_values['none'];
    $hh = $booking->get_addons_ofbookings($orderdetail[4]);
    while($jj = mysqli_fetch_array($hh)){
        if($addons ==  $label_language_values['none']){
            $addons = $jj['addon_service_name']."-".$jj['addons_service_qty'];
        }
        else
        {
            $addons = $addons.",".$jj['addon_service_name']."-".$jj['addons_service_qty'];
        }
    }


    /* if this is guest user than */
    if($orderdetail[4]==0)
    {
        $gc  = $objdashboard->getguestclient($orderdetail[4]);
        $temppp= unserialize(base64_decode($gc[5]));
        $temp = str_replace('\\','',$temppp);
        $vc_status = $temp['vc_status'];
        if($vc_status == 'N'){
            $final_vc_status =  $label_language_values['no'];
        }
        elseif($vc_status == 'Y'){
            $final_vc_status =  $label_language_values['yes'];
        }else{
            $final_vc_status = "N/A";
        }
        $p_status = $temp['p_status'];
        if($p_status == 'N'){
            $final_p_status =  $label_language_values['no'];
        }
        elseif($p_status == 'Y'){
            $final_p_status =  $label_language_values['yes'];
        }else{
            $final_p_status = "N/A";
        }

        $client_name=$gc[2];
        $client_email=$gc[3];
		
        /* $client_phone=$gc[4]; */
        $phone_length = strlen($gc[4]);
			
			if($phone_length > 6){
				$client_phone = $gc[4];
			}else{
				$client_phone = "N/A";
			}
			
		
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
            $final_vc_status =  $label_language_values['no'];
        }
        elseif($vc_status == 'Y'){
            $final_vc_status =  $label_language_values['yes'];
        }else{
            $final_vc_status = "N/A";
        }
        $p_status = $temp['p_status'];
        if($p_status == 'N'){
            $final_p_status =  $label_language_values['no'];
        }
        elseif($p_status == 'Y'){
            $final_p_status =  $label_language_values['yes'];
        }else{
            $final_p_status = "N/A";
        }
        $client_name=$c[2];
        $client_email=$c[3];
        /* $client_phone=$c[4]; */
		
		 $phone_length = strlen($c[4]);
			
			if($phone_length > 6){
				$client_phone = $c[4];
			}else{
				$client_phone = "N/A";
			}
			
			
			
			$client_name_value="";
			$client_first_name="";
			$client_last_name="";
			
			$client_name_value= explode(" ",$client_name);
			$client_first_name = $client_name_value[0];
			$client_last_name =	$client_name_value[1];
	
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
			
		
	/* 	$firstname=$client_name;
        $lastname=''; */
		
		
        $payment_status=$orderdetail[5];
        $final_vc_status;
        $final_p_status;
        $client_address=$temp['address'];
        /* $client_notes=$temp['notes']; */
        /* $client_status=$temp['contact_status']; */
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
		
    $emailtemplate->email_subject="Appointment Approved";
    $emailtemplate->user_type="C";
    $clientemailtemplate=$emailtemplate->readone_client_email_template_body();

    if($clientemailtemplate[2] != ''){
        $clienttemplate = base64_decode($clientemailtemplate[2]);
    }else{
        $clienttemplate = base64_decode($clientemailtemplate[3]);
    }
	$subject=$label_language_values[strtolower(str_replace(" ","_",$clientemailtemplate[1]))];
   
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
    /*** Email Code End ***/

    /*** Email Code Start ***/
    $emailtemplate->email_subject="Appointment Approved";
    $emailtemplate->user_type="A";
    $adminemailtemplate=$emailtemplate->readone_client_email_template_body();

    if($adminemailtemplate[2] != ''){
        $admintemplate = base64_decode($adminemailtemplate[2]);
    }else{
        $admintemplate = base64_decode($adminemailtemplate[3]);
    }
	$adminsubject=$label_language_values[strtolower(str_replace(" ","_",$adminemailtemplate[1]))];

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
   
	$staff_ids = $booking->get_staff_ids_from_bookings($id);
	if($staff_ids != ''){
		$staff_idss = explode(',',$staff_ids);
		if(sizeof((array)$staff_idss) > 0){
			foreach($staff_idss as $sid){
				$staffdetails = $booking->get_staff_detail_for_email($sid);
				$staff_name = $staffdetails['fullname'];
				$staff_email = $staffdetails['email'];		
				$staff_phone = $staffdetails['phone'];		
						
				$staff_searcharray = array('{{service_name}}','{{booking_date}}','{{business_logo}}','{{business_logo_alt}}','{{client_name}}','{{methodname}}','{{units}}','{{addons}}','{{client_email}}','{{phone}}','{{payment_method}}','{{vaccum_cleaner_status}}','{{parking_status}}','{{notes}}','{{contact_status}}','{{address}}','{{price}}','{{admin_name}}','{{firstname}}','{{lastname}}','{{app_remain_time}}','{{reject_status}}','{{company_name}}','{{booking_time}}','{{client_city}}','{{client_state}}','{{client_zip}}','{{company_city}}','{{company_state}}','{{company_zip}}','{{company_country}}','{{company_phone}}','{{company_email}}','{{company_address}}','{{admin_name}}','{{staff_name}}','{{staff_email}}');
					
				$staff_replacearray = array($service_name, $booking_date , $business_logo, $business_logo_alt, $client_name,$methodname, $units, $addons,$client_email, $client_phone, $payment_status, $final_vc_status, $final_p_status, $client_notes, $client_status,$client_address,$price,$get_admin_name,$firstname,$lastname,'','',$admin_company_name,$booking_time,$client_city,$client_state,$client_zip,$company_city,$company_state,$company_zip,$company_country,$company_phone,$company_email,$company_address,$get_admin_name,$staff_name,$staff_email);
				
				$emailtemplate->email_subject="Appointment Approved";
				$emailtemplate->user_type="S";
				$staffemailtemplate=$emailtemplate->readone_client_email_template_body();
				
				if($staffemailtemplate[2] != ''){
					$stafftemplate = base64_decode($staffemailtemplate[2]);
				}else{
					$stafftemplate = base64_decode($staffemailtemplate[3]);
				}
				$subject=$label_language_values[strtolower(str_replace(" ","_",$staffemailtemplate[1]))];
			   
				if($setting->get_option('ct_staff_email_notification_status') == 'Y' && $staffemailtemplate[4]=='E' ){
					$client_email_body = str_replace($staff_searcharray,$staff_replacearray,$stafftemplate);
					if($setting->get_option('ct_smtp_hostname') != '' && $setting->get_option('ct_email_sender_name') != '' && $setting->get_option('ct_email_sender_address') != '' && $setting->get_option('ct_smtp_username') != '' && $setting->get_option('ct_smtp_password') != '' && $setting->get_option('ct_smtp_port') != ''){
						$mail_s->IsSMTP();
					}else{
						$mail_s->IsMail();
					}
					$mail_s->SMTPDebug  = 0;
					$mail_s->IsHTML(true);
					$mail_s->From = $company_email;
					$mail_s->FromName = $company_name;
					$mail_s->Sender = $company_email;
					$mail_s->AddAddress($staff_email, $staff_name);
					$mail_s->Subject = $subject;
					$mail_s->Body = $client_email_body;
					$mail_s->send();
					$mail_s->ClearAllRecipients();
				}
				
				/* TEXTLOCAL CODE */
				if($setting->get_option('ct_sms_textlocal_status') == "Y")
				{
					if($setting->get_option('ct_sms_textlocal_send_sms_to_staff_status') == "Y"){
						if(isset($staff_phone) && !empty($staff_phone))
						{
							$template = $objdashboard->gettemplate_sms("C",'S');
							$phone = $staff_phone;				
							if($template[4] == "E") {
								if($template[2] == ""){
									$message = base64_decode($template[3]);
								}
								else{
									$message = base64_decode($template[2]);
								}
							}
							$message = str_replace($staff_searcharray,$staff_replacearray,$message);
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

							$template = $objdashboard->gettemplate_sms("C",'S');
							$phone = $staff_phone;
							if($template[4] == "E"){
								if($template[2] == ""){
										$message = base64_decode($template[3]);
								}
								else{
										$message = base64_decode($template[2]);
								}
								$client_sms_body = str_replace($staff_searcharray,$staff_replacearray,$message);
								/* MESSAGE SENDING CODE THROUGH PLIVO */
								$params = array(
										'src' => $plivo_sender_number,
										'dst' => $phone,
										'text' => $client_sms_body,
										'method' => 'POST'
								);
								print_r($params);
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

							$template = $objdashboard->gettemplate_sms("C",'S');
							$phone = $staff_phone;
							if($template[4] == "E") {
									if($template[2] == ""){
											$message = base64_decode($template[3]);
									}
									else{
											$message = base64_decode($template[2]);
									}
									$client_sms_body = str_replace($staff_searcharray,$staff_replacearray,$message);
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
							$template = $objdashboard->gettemplate_sms("C",'S');
							$phone = $staff_phone;				
							if($template[4] == "E") {
								if($template[2] == ""){
									$message = base64_decode($template[3]);
								}
								else{
									$message = base64_decode($template[2]);
								}
								$ct_nexmo_text = str_replace($staff_searcharray,$staff_replacearray,$message);
								$res=$nexmo_client->send_nexmo_sms($phone,$ct_nexmo_text);
							}
						}
					}
				}
			}
		}
	}

    /*SMS SENDING CODE*/
    /*GET APPROVED SMS TEMPLATE*/
	/* TEXTLOCAL CODE */
	if($setting->get_option('ct_sms_textlocal_status') == "Y")
	{
		if($setting->get_option('ct_sms_textlocal_send_sms_to_client_status') == "Y"){
			$template = $objdashboard->gettemplate_sms("C",'C');
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
			$template = $objdashboard->gettemplate_sms("C",'A');
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
		
		if($setting->get_option('ct_sms_textlocal_send_sms_to_staff_status') == "Y"){
			if(isset($staff_phone) && !empty($staff_phone))
			{	
				$template = $objdashboard->gettemplate_sms("C",'S');
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
           
		   if($setting->get_option('ct_sms_plivo_send_sms_to_client_status') == "Y"){
                $auth_id = $setting->get_option('ct_sms_plivo_account_SID');
				$auth_token = $setting->get_option('ct_sms_plivo_auth_token');
				$p_client = new Plivo\RestAPI($auth_id, $auth_token, '', '');
				$template = $objdashboard->gettemplate_sms("C",'C');
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
                    /* MESSAGE SENDING CODE ENDED HERE*/
                }
            }
            if($setting->get_option('ct_sms_plivo_send_sms_to_admin_status') == "Y"){
                $auth_id = $setting->get_option('ct_sms_plivo_account_SID');
				$auth_token = $setting->get_option('ct_sms_plivo_auth_token');
				$p_admin = new Plivo\RestAPI($auth_id, $auth_token, '', '');
				$template = $objdashboard->gettemplate_sms("C",'A');
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
					$response = $p_admin->send_message($params);
                    /* MESSAGE SENDING CODE ENDED HERE*/
                }
            }
						
						if($setting->get_option('ct_sms_plivo_send_sms_to_staff_status') == "Y"){
							if(isset($staff_phone) && !empty($staff_phone))
							{
								$auth_id = $setting->get_option('ct_sms_plivo_account_SID');
								$auth_token = $setting->get_option('ct_sms_plivo_auth_token');
								$p_client = new Plivo\RestAPI($auth_id, $auth_token, '', '');
								$template = $objdashboard->gettemplate_sms("C",'S');
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
            if($setting->get_option('ct_sms_twilio_send_sms_to_client_status') == "Y"){
				$AccountSid = $setting->get_option('ct_sms_twilio_account_SID');
				$AuthToken =  $setting->get_option('ct_sms_twilio_auth_token'); 
				$twilliosms_client = new Services_Twilio($AccountSid, $AuthToken);

				$template = $objdashboard->gettemplate_sms("C",'C');
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

				$template = $objdashboard->gettemplate_sms("C",'A');
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
						
						if($setting->get_option('ct_sms_twilio_send_sms_to_staff_status') == "Y"){
							if(isset($staff_phone) && !empty($staff_phone))
							{	
								$AccountSid = $setting->get_option('ct_sms_twilio_account_SID');
								$AuthToken =  $setting->get_option('ct_sms_twilio_auth_token'); 
								$twilliosms_client = new Services_Twilio($AccountSid, $AuthToken);

								$template = $objdashboard->gettemplate_sms("C",'S');
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
			if($setting->get_option('ct_sms_nexmo_send_sms_to_client_status') == "Y"){
				$template = $objdashboard->gettemplate_sms("C",'C');
				$phone = $client_phone;				
				if($template[4] == "E") {
					if($template[2] == ""){
						$message = base64_decode($template[3]);
					}
					else{
						$message = base64_decode($template[2]);
					}
				}
				$ct_nexmo_text = str_replace($searcharray,$replacearray,$message);
				$res=$nexmo_client->send_nexmo_sms($phone,$ct_nexmo_text);
			}
			if($setting->get_option('ct_sms_nexmo_send_sms_to_admin_status') == "Y"){
				$template = $objdashboard->gettemplate_sms("C",'A');
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
			
			if($setting->get_option('ct_sms_nexmo_send_sms_to_staff_status') == "Y"){
				if(isset($staff_phone) && !empty($staff_phone))
				{
					$template = $objdashboard->gettemplate_sms("C",'S');
					$phone = $staff_phone;				
					if($template[4] == "E") {
						if($template[2] == ""){
							$message = base64_decode($template[3]);
						}
						else{
							$message = base64_decode($template[2]);
						}
					}
					$ct_nexmo_text = str_replace($searcharray,$replacearray,$message);
					$res=$nexmo_client->send_nexmo_sms($phone,$ct_nexmo_text);
				}
			}
		}
    /*SMS SENDING CODE END*/
}
elseif(isset($_POST['confirm_booking_cal'])){
    $id = $_POST['id']; /*here id ==order id*/
    $orderdetail = $objdashboard->getclientorder($id);
    $lastmodify = date('Y-m-d H:i:s');
    /* Update Confirm status in bookings */
    $objdashboard->confirm_bookings($id,$lastmodify);

    $clientdetail = $objdashboard->clientemailsender($id);
	
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
   
    $price=$general->ct_price_format($orderdetail[2],$symbol_position,$decimal);

    /* methods */
    $units =  $label_language_values['none'];
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


    /*if this is guest user than */
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
        /* $client_phone=$gc[4]; */
		
		
		$phone_length = strlen($gc[4]);
			
			if($phone_length > 6){
				$client_phone = $gc[4];
			}else{
				$client_phone = "N/A";
			}
			
        $firstname=$client_name;
        $lastname='';
        $booking_status=$orderdetail[6];
        $final_vc_status;
        $final_p_status;
        $payment_status=$orderdetail[5];
        $client_address=$temp['address'];
        $client_notes=$temp['notes'];
        $client_status=$temp['contact_status'];		$client_city = $temp['city'];		$client_state = $temp['state'];		$client_zip	= $temp['zip'];
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
        $client_name=$c[2];
       /*  $firstname=$client_name;
        $lastname=''; */
        $client_email=$c[3];
        /* $client_phone=$c[4]; */
		
		$phone_length = strlen($c[4]);
			
			if($phone_length > 6){
				$client_phone = $c[4];
			}else{
				$client_phone = "N/A";
			}
			
			
			$client_name_value="";
			$client_first_name="";
			$client_last_name="";
			
			$client_name_value= explode(" ",$client_name);
			$client_first_name = $client_name_value[0];
			$client_last_name =	$client_name_value[1];
	
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
			
			
			
			
        $payment_status=$orderdetail[5];
        $final_vc_status;
        $final_p_status;
        $client_address=$temp['address'];
       /*  $client_notes=$temp['notes']; */
       /*  $client_status=$temp['contact_status']; */		
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

    $emailtemplate->email_subject="Appointment Approved";
    $emailtemplate->user_type="C";
		
    $clientemailtemplate=$emailtemplate->readone_client_email_template_body();

    if($clientemailtemplate[2] != ''){
        $clienttemplate = base64_decode($clientemailtemplate[2]);
    }else{
        $clienttemplate = base64_decode($clientemailtemplate[3]);
    }
	$subject=$label_language_values[strtolower(str_replace(" ","_",$clientemailtemplate[1]))];
    
    /*$clienttemplate=$emailtemplate->readone_client_email_template_body();*/
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
	
    /*** Email Code End ***/

    /*** Email Code Start ***/
    $emailtemplate->email_subject="Appointment Approved";
    $emailtemplate->user_type="A";
    $adminemailtemplate=$emailtemplate->readone_client_email_template_body();

    if($adminemailtemplate[2] != ''){
        $admintemplate = base64_decode($adminemailtemplate[2]);
    }else{
        $admintemplate = base64_decode($adminemailtemplate[3]);
    }
	$adminsubject=$label_language_values[strtolower(str_replace(" ","_",$adminemailtemplate[1]))];

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
	$staff_ids = $booking->get_staff_ids_from_bookings($id);
	if($staff_ids != ''){
		$staff_idss = explode(',',$staff_ids);
		if(sizeof((array)$staff_idss) > 0){
			foreach($staff_idss as $sid){
				$staffdetails = $booking->get_staff_detail_for_email($sid);
				$staff_name = $staffdetails['fullname'];
				$staff_email = $staffdetails['email'];		
				$staff_phone = $staffdetails['phone'];			
				$staff_searcharray = array('{{service_name}}','{{booking_date}}','{{business_logo}}','{{business_logo_alt}}','{{client_name}}','{{methodname}}','{{units}}','{{addons}}','{{client_email}}','{{phone}}','{{payment_method}}','{{vaccum_cleaner_status}}','{{parking_status}}','{{notes}}','{{contact_status}}','{{address}}','{{price}}','{{admin_name}}','{{firstname}}','{{lastname}}','{{app_remain_time}}','{{reject_status}}','{{company_name}}','{{booking_time}}','{{client_city}}','{{client_state}}','{{client_zip}}','{{company_city}}','{{company_state}}','{{company_zip}}','{{company_country}}','{{company_phone}}','{{company_email}}','{{company_address}}','{{admin_name}}','{{staff_name}}','{{staff_email}}');
					
				$staff_replacearray = array($service_name, $booking_date , $business_logo, $business_logo_alt, $client_name,$methodname, $units, $addons,$client_email, $client_phone, $payment_status, $final_vc_status, $final_p_status, $client_notes, $client_status,$client_address,$price,$get_admin_name,$firstname,$lastname,'','',$admin_company_name,$booking_time,$client_city,$client_state,$client_zip,$company_city,$company_state,$company_zip,$company_country,$company_phone,$company_email,$company_address,$get_admin_name,$staff_name,$staff_email);
			
				$emailtemplate->email_subject="Appointment Approved";
				$emailtemplate->user_type="S";
				$staffemailtemplate=$emailtemplate->readone_client_email_template_body();
				if($staffemailtemplate[2] != ''){
					$stafftemplate = base64_decode($staffemailtemplate[2]);
				}else{
					$stafftemplate = base64_decode($staffemailtemplate[3]);
				}
				
				$subject=$label_language_values[strtolower(str_replace(" ","_",$staffemailtemplate[1]))];
			   
				if($setting->get_option('ct_staff_email_notification_status') == 'Y' && $staffemailtemplate[4]=='E' ){
					$client_email_body = str_replace($staff_searcharray,$staff_replacearray,$stafftemplate);
					if($setting->get_option('ct_smtp_hostname') != '' && $setting->get_option('ct_email_sender_name') != '' && $setting->get_option('ct_email_sender_address') != '' && $setting->get_option('ct_smtp_username') != '' && $setting->get_option('ct_smtp_password') != '' && $setting->get_option('ct_smtp_port') != ''){
						$mail_s->IsSMTP();
					}else{
						$mail_s->IsMail();
					}
					$mail_s->SMTPDebug  = 0;
					$mail_s->IsHTML(true);
					$mail_s->From = $company_email;
					$mail_s->FromName = $company_name;
					$mail_s->Sender = $company_email;
					$mail_s->AddAddress($staff_email, $staff_name);
					$mail_s->Subject = $subject;
					$mail_s->Body = $client_email_body;
					$mail_s->send();
					$mail_s->ClearAllRecipients();
				}
				
				/* TEXTLOCAL CODE */
				if($setting->get_option('ct_sms_textlocal_status') == "Y")
				{
					if($setting->get_option('ct_sms_textlocal_send_sms_to_staff_status') == "Y"){
						if(isset($staff_phone) && !empty($staff_phone))
						{
							$template = $objdashboard->gettemplate_sms("C",'S');
							$phone = $staff_phone;				
							if($template[4] == "E") {
								if($template[2] == ""){
									$message = base64_decode($template[3]);
								}
								else{
									$message = base64_decode($template[2]);
								}
							}
							$message = str_replace($staff_searcharray,$staff_replacearray,$message);
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

							$template = $objdashboard->gettemplate_sms("C",'S');
							$phone = $staff_phone;
							if($template[4] == "E"){
								if($template[2] == ""){
										$message = base64_decode($template[3]);
								}
								else{
										$message = base64_decode($template[2]);
								}
								$client_sms_body = str_replace($staff_searcharray,$staff_replacearray,$message);
								/* MESSAGE SENDING CODE THROUGH PLIVO */
								$params = array(
										'src' => $plivo_sender_number,
										'dst' => $phone,
										'text' => $client_sms_body,
										'method' => 'POST'
								);
								print_r($params);
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

							$template = $objdashboard->gettemplate_sms("C",'S');
							$phone = $staff_phone;
							if($template[4] == "E") {
									if($template[2] == ""){
											$message = base64_decode($template[3]);
									}
									else{
											$message = base64_decode($template[2]);
									}
									$client_sms_body = str_replace($staff_searcharray,$staff_replacearray,$message);
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
							$template = $objdashboard->gettemplate_sms("C",'S');
							$phone = $staff_phone;				
							if($template[4] == "E") {
								if($template[2] == ""){
									$message = base64_decode($template[3]);
								}
								else{
									$message = base64_decode($template[2]);
								}
								$ct_nexmo_text = str_replace($staff_searcharray,$staff_replacearray,$message);
								$res=$nexmo_client->send_nexmo_sms($phone,$ct_nexmo_text);
							}
						}
					}
				}
					/*SMS SENDING CODE END*/
			}
		}
	}
    /*** Email Code End ***/

    /*SMS SENDING CODE*/
    /*GET APPROVED SMS TEMPLATE*/
	/* TEXTLOCAL CODE */
	if($setting->get_option('ct_sms_textlocal_status') == "Y")
	{
		if($setting->get_option('ct_sms_textlocal_send_sms_to_client_status') == "Y"){
			$template = $objdashboard->gettemplate_sms("C",'C');
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
			$template = $objdashboard->gettemplate_sms("C",'A');
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

			$template = $objdashboard->gettemplate_sms("C",'C');
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
                print_r($params);
                $response = $p_client->send_message($params);
                /* MESSAGE SENDING CODE ENDED HERE*/
            }
        }
        if($setting->get_option('ct_sms_plivo_send_sms_to_admin_status') == "Y"){
            $auth_id = $setting->get_option('ct_sms_plivo_account_SID');
			$auth_token = $setting->get_option('ct_sms_plivo_auth_token');
			$p_admin = new Plivo\RestAPI($auth_id, $auth_token, '', '');

			$template = $objdashboard->gettemplate_sms("C",'A');
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

			$template = $objdashboard->gettemplate_sms("C",'C');
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

			$template = $objdashboard->gettemplate_sms("C",'A');
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
			$template = $objdashboard->gettemplate_sms("C",'C');
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
			$template = $objdashboard->gettemplate_sms("C",'A');
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
    /*SMS SENDING CODE END*/

}

elseif(isset($_POST['getallnotification'])){
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
	
	$ct_max_advance_booking_time = $setting->get_option('ct_max_advance_booking_time');
	$start_date = date("Y-m-d",$currDateTime_withTZ);
	$end_date = date("Y-m-d",strtotime("+".$ct_max_advance_booking_time." months",$currDateTime_withTZ));
	
	$my_booking = array();
	
	$all_db_gc_admin_ids = array();
	$all_db_gc_staff_ids = array();
	/** Get Google Calendar Bookings **/
	$CalenderBooking = array();
	if($gc_hook->gc_purchase_status() == 'exist'){
		$gc_hook->google_cal_TwoSync_admin_hook();
		$all_gc_ids_result = $booking->get_all_gc_from_db();
		if(mysqli_num_rows($all_gc_ids_result) > 0){
			while($row = mysqli_fetch_assoc($all_gc_ids_result)){
				$order_id = $row["order_id"];
				$gc_event_id = $row["gc_event_id"];
				$gc_staff_event_id = $row["gc_staff_event_id"];
				$all_db_gc_admin_ids[$order_id] = $gc_event_id;
				$all_db_gc_staff_ids[$order_id] = $gc_staff_event_id;
			}
		}
		if(!empty($CalenderBooking)){
			foreach($CalenderBooking as $cb){
				if(!in_array($cb["id"],$all_db_gc_admin_ids)){
					$new_array = array("read_status"=>"R","order_id"=>$cb["id"],"booking_status"=>"GC","booking_date_time"=>$cb["start"],"lastmodify"=>$cb["update_date"],"client_id"=>"0","title"=>$cb["title"]);
					$my_booking[$cb["update_date"]] = $new_array;
				}
			}
		}
	}
	/** Get Google Calendar Bookings **/
	
	$books = $objdashboard->getallbookings_notify();
	while($b = mysqli_fetch_assoc($books)){
		$last_strtotime = strtotime($b["lastmodify"]);
		$b["lastmodify"] = $last_strtotime;
		$b["booking_date_time"] = strtotime($b["booking_date_time"]);
		$my_booking[$last_strtotime] = $b;
	}
	krsort($my_booking);
	foreach($my_booking as $b){
		if($b['read_status'] =='U')
			$col = "#f8f8f8";
		else
			$col = "#fff";
		?>
		<li id="rec-noti-1" class="notificationli" data-orderid="<?php echo $b['order_id'];?>" data-booking_status="<?php     echo $b['booking_status']; ?>" style="background-color: <?php  echo $col;?>">
			<div class="list-inner">
				<?php 
				if($b['client_id']==0)
				{
					?>
					<?php 
					if($b['booking_status']=='A')
					{
						$booking_stats='<span class="ct-label bg-info br-2">'.$label_language_values['active'].'</span>';
					}
					elseif($b['booking_status']=='C')
					{
						$booking_stats='<span class="ct-label bg-success br-2">'.$label_language_values['confirmed'].'</span>';
					}
					elseif($b['booking_status']=='R')
					{
						$booking_stats='<span class="ct-label bg-danger br-2">'.$label_language_values['rejected'].'</span>';
					}
					elseif($b['booking_status']=='RS')
					{
						$booking_stats='<span class="ct-label bg-primary br-2">'.$label_language_values['rescheduled'].'</span>';
					}
					elseif($b['booking_status']=='CC')
					{
						$booking_stats='<span class="ct-label bg-warning br-2">'.$label_language_values['cancelled_by_client'].'</span>';
					}
					elseif($b['booking_status']=='CS')
					{

						$booking_stats='<span class="ct-label bg-danger br-2">'.$label_language_values['cancelled_by_service_provider'].'</span>';
					}
					elseif($b['booking_status']=='CO')
					{
						$booking_stats='<span class="ct-label bg-success br-2">'.$label_language_values['completed'].'</span>';
					}
					elseif($b['booking_status']=='GC')
					{
						$booking_stats='<span class="ct-label bg-google br-2">Google Event</span>';
					}
					else
					{
						$booking_stats='<span class="ct-label bg-default br-2">'.$label_language_values['mark_as_no_show'].'</span>';
					}
					if($b['booking_status']!='GC'){
						$gc  = $objdashboard->getguestclient($b['order_id']);   ?>
						<span class="booking-text"><?php echo $booking_stats;?> <?php  echo $gc[2]." ".$label_language_values['for_a']." ".$b['title']." ".$label_language_values['on']." ".str_replace($english_date_array,$selected_lang_label,date($getdateformate, $b['booking_date_time']));?> @ <?php     
						if($time_format == 12){
						?>
						<?php  echo str_replace($english_date_array,$selected_lang_label,date("h:i A",$b['booking_date_time']));?></span>
						<?php 
						}else{
						?>
						<?php  echo date("H:i", $b['booking_date_time']);?></span>
						<?php 
						}
						?></span>
						<span class="booking-time">
						<?php 
						echo time_elapsed_string(date("Y-m-d H:i:s",$b['lastmodify']));
						?>
						</span><?php    
					}else{   ?>
						<span class="booking-text"><?php echo $booking_stats;?> <?php  echo $b['title']." ".$label_language_values['on']." ".str_replace($english_date_array,$selected_lang_label,date($getdateformate, $b['booking_date_time']));?> @ <?php     
						if($time_format == 12){
						?>
						<?php  echo str_replace($english_date_array,$selected_lang_label,date("h:i A",$b['booking_date_time']));?></span>
						<?php 
						}else{
						?>
						<?php  echo date("H:i", $b['booking_date_time']);?></span>
						<?php 
						}
						?></span>
						<span class="booking-time">
						<?php 
						echo time_elapsed_string(date("Y-m-d H:i:s",$b['lastmodify']));
						?>
						</span><?php    
					}
				}
				else
				{
					?>
					<?php 
					if($b['booking_status']=='A')
					{
						$booking_stats='<span class="ct-label bg-info br-2">'.$label_language_values['active'].'</span>';
					}
					elseif($b['booking_status']=='C')
					{
						$booking_stats='<span class="ct-label bg-success br-2">'.$label_language_values['confirmed'].'</span>';
					}
					elseif($b['booking_status']=='R')
					{
						$booking_stats='<span class="ct-label bg-danger br-2">'.$label_language_values['rejected'].'</span>';
					}
					elseif($b['booking_status']=='RS')
					{
						$booking_stats='<span class="ct-label bg-primary br-2">'.$label_language_values['rescheduled'].'</span>';
					}
					elseif($b['booking_status']=='CC')
					{
						$booking_stats='<span class="ct-label bg-warning br-2">'.$label_language_values['cancelled_by_client'].'</span>';
					}
					elseif($b['booking_status']=='CS')
					{

						$booking_stats='<span class="ct-label bg-danger br-2">'.$label_language_values['cancelled_by_service_provider'].'</span>';
					}
					elseif($b['booking_status']=='CO')
					{
						$booking_stats='<span class="ct-label bg-success br-2">'.$label_language_values['completed'].'</span>';
					}
					elseif($b['booking_status']=='GC')
					{
						$booking_stats='<span class="ct-label bg-google br-2">Google Event</span>';
					}
					else
					{
						$booking_stats='<span class="ct-label bg-default br-2">'.$label_language_values['mark_as_no_show'].'</span>';
					}
					if($b['booking_status']!='GC'){
						$c  = $objdashboard->getclient($b['client_id']);   ?>
						<span class="booking-text"><?php echo $booking_stats;?> <?php  echo $c[3]." ".$c[4]." ".$label_language_values['for_a']." ".$b['title']." ".$label_language_values['on']." ".str_replace($english_date_array,$selected_lang_label,date($getdateformate, $b['booking_date_time']));?> @ <?php     
						if($time_format == 12){
						?>
						<?php  echo str_replace($english_date_array,$selected_lang_label,date("h:i A",$b['booking_date_time']));?></span>
						<?php 
						}else{
						?>
						<?php  echo date("H:i", $b['booking_date_time']);?></span>
						<?php 
						}
						?></span>
						<span class="booking-time">
						<?php 
						echo time_elapsed_string(date("Y-m-d H:i:s",$b['lastmodify']));
						?>
						</span><?php    
					}else{   ?>
						<span class="booking-text"><?php echo $booking_stats;?> <?php  echo $b['title']." ".$label_language_values['on']." ".str_replace($english_date_array,$selected_lang_label,date($getdateformate, $b['booking_date_time']));?> @ <?php     
						if($time_format == 12){
						?>
						<?php  echo str_replace($english_date_array,$selected_lang_label,date("h:i A",$b['booking_date_time']));?></span>
						<?php 
						}else{
						?>
						<?php  echo date("H:i", $b['booking_date_time']);?></span>
						<?php 
						}
						?></span>
						<span class="booking-time">
						<?php 
						echo time_elapsed_string(date("Y-m-d H:i:s",$b['lastmodify']));
						?>
						</span><?php    
					}
				} ?>
			</div>
		</li>
	<?php     
	}
}
elseif(isset($_POST['reject_booking'])){
    $id = $_POST['order_id'];
    $reason = $_POST['reject_reason_book'];
	$gc_event_id = $_POST['gc_event_id'];
    $lastmodify = date('Y-m-d H:i:s');
    $objdashboard->reject_bookings($id,$reason,$lastmodify);
	$client_name = "";
	
	$orderdetail = $objdashboard->getclientorder($id);
    $clientdetail = $objdashboard->clientemailsender($id);

	$pid = $_POST['pid'];
	$gc_staff_event_id = $_POST['gc_staff_event_id'];
	
	if($gc_hook->gc_purchase_status() == 'exist'){
		echo $gc_hook->gc_cancel_reject_booking_hook();
	}
	
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
																	
		/*if this is guest user than */									
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
				$client_city = $temp['city'];				$client_state = $temp['state'];				$client_zip	= $temp['zip'];
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
				$client_name=$c[2];
				/* $firstname=$client_name;
				$lastname=''; */
				$client_email=$c[3];
				
				/* $client_phone=$c[4]; */
				$phone_length = strlen($c[4]);
			
			if($phone_length > 6){
				$client_phone = $c[4];
			}else{
				$client_phone = "N/A";
			}
			
			
			
			
			
			$client_name_value="";
			$client_first_name="";
			$client_last_name="";
						
			/*$client_name_value= explode(" ",$client_name);
			$client_first_name = $client_name_value[0];
			$client_last_name =	$client_name_value[1];*/
			
			$client_namess= explode(" ",$client_name);
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
					
				$payment_status=$orderdetail[5];
				$final_vc_status;
				$final_p_status;
				$client_address=$temp['address'];
			/* 	$client_notes=$temp['notes']; */
				/* $client_status=$temp['contact_status'];	 */
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
		
		$replacearray = array($service_name, $booking_date , $business_logo, $business_logo_alt, $client_name,$methodname, $units, $addons,$client_email, $client_phone, $payment_status, $final_vc_status, $final_p_status, $client_notes, $client_status,$client_address,$price,$get_admin_name,$firstname,$lastname,'',$reason,$admin_company_name,$booking_time,$client_city,$client_state,$client_zip,$company_city,$company_state,$company_zip,$company_country,$company_phone,$company_email,$company_address,$get_admin_name);
		/* Client Email Template */
		
		/* $emailtemplate->email_subject=$label_language_values[strtolower(str_replace(" ","_","Appointment Rejected"))]; */
		$emailtemplate->email_subject="Appointment Rejected";
		$emailtemplate->user_type="C";
		$clientemailtemplate=$emailtemplate->readone_client_email_template_body();
		
		if($clientemailtemplate[2] != ''){
			$clienttemplate = base64_decode($clientemailtemplate[2]);
		}else{
			$clienttemplate = base64_decode($clientemailtemplate[3]);
		}
		$subject=$label_language_values[strtolower(str_replace(" ","_",$clientemailtemplate[1]))];
		
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
   /* Admin Email template */
		$emailtemplate->email_subject="Appointment Rejected";
		$emailtemplate->user_type="A";
		$adminemailtemplate=$emailtemplate->readone_client_email_template_body();
		
		if($adminemailtemplate[2] != ''){
			$admintemplate = base64_decode($adminemailtemplate[2]);
		}else{
			$admintemplate = base64_decode($adminemailtemplate[3]);
		}
		$adminsubject=$label_language_values[strtolower(str_replace(" ","_",$adminemailtemplate[1]))];
	
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
	
	$staff_ids = $orderdetail[9];
	if($staff_ids != ''){
		$staff_idss = explode(',',$staff_ids);
		if(sizeof((array)$staff_idss) > 0){
			foreach($staff_idss as $sid){
				$staffdetails = $booking->get_staff_detail_for_email($sid);
				$staff_name = $staffdetails['fullname'];
				$staff_email = $staffdetails['email'];		
				$staff_phone = $staffdetails['phone'];		
						
				$staff_searcharray = array('{{service_name}}','{{booking_date}}','{{business_logo}}','{{business_logo_alt}}','{{client_name}}','{{methodname}}','{{units}}','{{addons}}','{{client_email}}','{{phone}}','{{payment_method}}','{{vaccum_cleaner_status}}','{{parking_status}}','{{notes}}','{{contact_status}}','{{address}}','{{price}}','{{admin_name}}','{{firstname}}','{{lastname}}','{{app_remain_time}}','{{reject_status}}','{{company_name}}','{{booking_time}}','{{client_city}}','{{client_state}}','{{client_zip}}','{{company_city}}','{{company_state}}','{{company_zip}}','{{company_country}}','{{company_phone}}','{{company_email}}','{{company_address}}','{{admin_name}}','{{staff_name}}','{{staff_email}}');
					
				$staff_replacearray = array($service_name, $booking_date , $business_logo, $business_logo_alt, $client_name,$methodname, $units, $addons,$client_email, $client_phone, $payment_status, $final_vc_status, $final_p_status, $client_notes, $client_status,$client_address,$price,$get_admin_name,$firstname,$lastname,'','',$admin_company_name,$booking_time,$client_city,$client_state,$client_zip,$company_city,$company_state,$company_zip,$company_country,$company_phone,$company_email,$company_address,$get_admin_name,$staff_name,$staff_email);
				
				
				$emailtemplate->email_subject="Appointment Rejected";
				$emailtemplate->user_type="S";
				$staffemailtemplate=$emailtemplate->readone_client_email_template_body();
				
				if($staffemailtemplate[2] != ''){
					$stafftemplate = base64_decode($staffemailtemplate[2]);
				}else{
					$stafftemplate = base64_decode($staffemailtemplate[3]);
				}
				$subject=$label_language_values[strtolower(str_replace(" ","_",$staffemailtemplate[1]))];
			   
				if($setting->get_option('ct_staff_email_notification_status') == 'Y' && $staffemailtemplate[4]=='E' ){
					$client_email_body = str_replace($staff_searcharray,$staff_replacearray,$stafftemplate);
					if($setting->get_option('ct_smtp_hostname') != '' && $setting->get_option('ct_email_sender_name') != '' && $setting->get_option('ct_email_sender_address') != '' && $setting->get_option('ct_smtp_username') != '' && $setting->get_option('ct_smtp_password') != '' && $setting->get_option('ct_smtp_port') != ''){
						$mail_s->IsSMTP();
					}else{
						$mail_s->IsMail();
					}
					$mail_s->SMTPDebug  = 0;
					$mail_s->IsHTML(true);
					$mail_s->From = $company_email;
					$mail_s->FromName = $company_name;
					$mail_s->Sender = $company_email;
					$mail_s->AddAddress($staff_email, $staff_name);
					$mail_s->Subject = $subject;
					$mail_s->Body = $client_email_body;
					$mail_s->send();
					$mail_s->ClearAllRecipients();
				}
			}
		}
	}

    /*** Email Code End ***/
    /*SMS SENDING CODE*/
    /*GET APPROVED SMS TEMPLATE*/
	/* TEXTLOCAL CODE */
	if($setting->get_option('ct_sms_textlocal_status') == "Y")
	{
		if($setting->get_option('ct_sms_textlocal_send_sms_to_client_status') == "Y"){
			$template = $objdashboard->gettemplate_sms("R",'C');
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
			$template = $objdashboard->gettemplate_sms("R",'A');
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

			$template = $objdashboard->gettemplate_sms("R",'C');
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
                /* MESSAGE SENDING CODE ENDED HERE*/
            }
        }
        if($setting->get_option('ct_sms_plivo_send_sms_to_admin_status') == "Y"){
            $auth_id = $setting->get_option('ct_sms_plivo_account_SID');
			$auth_token = $setting->get_option('ct_sms_plivo_auth_token');
			$p_admin = new Plivo\RestAPI($auth_id, $auth_token, '', '');

			$template = $objdashboard->gettemplate_sms("R",'A');
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

			$template = $objdashboard->gettemplate_sms("R",'C');
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
			$phone = $admin_phone_twilio;
			$template = $objdashboard->gettemplate_sms("R",'A');
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
			$template = $objdashboard->gettemplate_sms("R",'C');
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
			$template = $objdashboard->gettemplate_sms("R",'A');
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
			
			/* TEXTLOCAL CODE */
			if($setting->get_option('ct_sms_textlocal_status') == "Y")
			{
				if($setting->get_option('ct_sms_textlocal_send_sms_to_staff_status') == "Y"){
					if(isset($staff_phone) && !empty($staff_phone))
					{	
						$template = $objdashboard->gettemplate_sms("R",'S');
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

								$template = $objdashboard->gettemplate_sms("R",'S');
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

								$template = $objdashboard->gettemplate_sms("R",'S');
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
						$template = $objdashboard->gettemplate_sms("R",'S');
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
elseif(isset($_POST['delete_booking'])){
  $id = $_POST['id'];
	$pid = $_POST['pid'];
	$gc_event_id = $_POST['gc_event_id'];
	$gc_staff_event_id = $_POST['gc_staff_event_id'];
	
	if($gc_hook->gc_purchase_status() == 'exist'){
		echo $gc_hook->gc_cancel_reject_booking_hook();
	}
  $objdashboard->delete_booking($id);
}

if(isset($_POST['reschedual_booking_admin'])){
  $order_id = $_POST['order_id'];
	$booking->order_id= $_POST['order_id'];
	$dd = $booking->readall_bookings_oid();
	$res_amt = $booking->read_net_amt();
	?>
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><?php echo $label_language_values['reschedule']; ?></h4>
			</div>
			<div class="modal-body">
				<div class="col-xs-12">
					<div class="form-group">
						<label class="cta-col2 ct-w-50"><?php echo $label_language_values['amount']; ?>:</label>
						<div class="cta-col6">
							<input class="form-control" readonly="readonly" type="text" id="amt" value="<?php echo "$".$res_amt['net_amount'];?>"/>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="col-xs-12">
					<div class="form-group">
						<label class="cta-col2 ct-w-50"><?php echo $label_language_values['date_and_time']; ?>:</label>
						<div class="cta-col4 ct-w-50">
							<?php 
							$dates = date("Y-m-d",strtotime($dd['booking_date_time']));
							$slot_timess = date('H:i',strtotime($dd['booking_date_time']));
							$get_staff_id = $booking->get_staff_ids_from_bookings($dd['order_id']);	
							if($get_staff_id==""){
								$staff_id=1;
							}else{
								$staff_id_array = explode(",",$get_staff_id);
								$staff_id = $staff_id_array[0];
							}
							?>
							<input class="exp_cp_date form-control" id="expiry_date<?php  echo $dd['order_id'];?>" data-staffid="<?php echo $staff_id; ?>" value=	"<?php echo $dates;?>" data-date-format="yyyy/mm/dd" data-provide="datepicker" />
						</div>
						<div class="cta-col6 ct-w-50 float-right mytime_slots_booking">
							<?php 
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
							$select_time=date('Y-m-d',strtotime($dates));
							$start_date = date($select_time,$currDateTime_withTZ);
							$time_interval = $setting->get_option('ct_time_interval');
							$time_slots_schedule_type = $setting->get_option('ct_time_slots_schedule_type');
							$advance_bookingtime = $setting->get_option('ct_min_advance_booking_time');
							$ct_service_padding_time_before = $setting->get_option('ct_service_padding_time_before');
							$ct_service_padding_time_after = $setting->get_option('ct_service_padding_time_after');
							$booking_padding_time = $setting->get_option('ct_booking_padding_time');
							$time_schedule = $first_step->get_day_time_slot_by_provider_id($time_slots_schedule_type,$start_date,$time_interval,$advance_bookingtime,$ct_service_padding_time_before,$ct_service_padding_time_after,$timezonediff,$booking_padding_time,$staff_id);
							$allbreak_counter = 0;
							$allofftime_counter = 0;
							$slot_counter = 0;
							?>
							<select class="selectpicker mydatepicker_appointment   form-control" id="myuser_reschedule_time" data-size="10" style="" >
								<?php 
								if($time_schedule['off_day']!=true && isset($time_schedule['slots']) && sizeof((array)$time_schedule['slots'])>0 && $allbreak_counter != sizeof((array)$time_schedule['slots']) && $allofftime_counter != sizeof((array)$time_schedule['slots'])){
									foreach($time_schedule['slots']  as $slot) {
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
											if(strtotime($dates.' '.$slot) >= strtotime($offtime['offtime_start']) && strtotime($dates.' '.$slot) < strtotime($offtime['offtime_end'])) {
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
												<option value="<?php echo date("H:i",strtotime($slot));?>" <?php  if(date("H:i",strtotime($slot)) == $slot_timess){ echo "selected";}?> class="time-slot br-2 ct-booked" >
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
											<option value="<?php echo date("H:i",strtotime($slot));?>" <?php  if(date("H:i",strtotime($slot)) == $slot_timess){ echo "selected";}?> class="time-slot br-2 <?php  if(in_array($complete_time_slot,$time_schedule['booked'])){ echo' ct-booked';}else{ echo ' time_slotss'; }?>" <?php  if(in_array($complete_time_slot,$time_schedule['booked'])){echo ''; }else{ echo 'data-slot_date_to_display="'.date($getdateformate,strtotime($dates)).'" data-slot_date="'.$dates.'" data-slot_time="'.$slot_time.'"'; } ?>><?php if($setting->get_option('ct_time_format')==24){echo date("H:i",strtotime($slot));}else{echo str_replace($english_date_array,$selected_lang_label,date("h:i A",strtotime($slot)));}?></option>
										<?php 
										} $slot_counter++;
									}
									if($allbreak_counter == sizeof((array)$time_schedule['slots']) && sizeof((array)$time_schedule['slots'])!=0){ ?>
										<option  class="time-slot"><?php echo "Sorry Not Available ";?></option>
									<?php  }
								} else { ?>
									<option class="time-slot"><?php echo "Sorry Not Available";?></option>
								<?php  } ?>
							</select>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="col-xs-12">
					<div class="form-group">
						<label class="cta-col2 ct-w-50"><?php echo $label_language_values['notes']; ?>:</label>
						<div class="cta-col8">
							<textarea class="form-control" id="rs_notes" class="rs_notes"></textarea>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>	
			</div>
			<div class="modal-footer">
				<a href="javascript:void(0);" class="pull-left btn btn-info" id="edit_reschedual" data-gc_event="<?php echo $dd['gc_event_id']; ?>" data-gc_staff_event="<?php echo $dd['gc_staff_event_id']; ?>" data-pid="<?php echo $dd['staff_ids']; ?>" data-order="<?php echo $dd['order_id'];?>"><?php echo $label_language_values['update_appointment']; ?></a>
			</div>
		</div>
	</div>
	<?php
}
?>