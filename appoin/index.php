<?php   
$filename =  'config.php';
$file = file_exists($filename);
if($file){
	if(!filesize($filename) > 0){
		header('location:ct_install.php');
	}
	else{
		
		include("/home/loiretec/public_html/crm/demo/appoin/objects/class_connection.php");
		$cvars = new cleanto_myvariable();
		$host = trim($cvars->hostnames);
		$un = trim($cvars->username);
		$ps = trim($cvars->passwords); 
		$db = trim($cvars->database);

		$con = new cleanto_db();
		$conn = $con->connect();
		
		if(($conn->connect_errno=='0' && ($host=='' || $db=='')) || $conn->connect_errno!='0' ) {
			header('Location: ./config_index.php');
		}
	}
}else{
	echo "Config file does not exist";
}

session_start();
$service_array = array("method" => array());
$_SESSION['ct_cart'] = $service_array;
$_SESSION['freq_dis_amount'] = '';
$_SESSION['ct_details'] = '';
$_SESSION['staff_id_cal'] = '';
$_SESSION['time_duration'] = 0;

include('/home/loiretec/public_html/crm/demo/appoin/class_configure.php');
include("/home/loiretec/public_html/crm/demo/appoin/header.php");
include("/home/loiretec/public_html/crm/demo/appoin/objects/class_services.php");
include("/home/loiretec/public_html/crm/demo/appoin/objects/class_users.php");
include('/home/loiretec/public_html/crm/demo/appoin/objects/class_setting.php');
include('/home/loiretec/public_html/crm/demo/appoin/objects/class_frequently_discount.php');
include('/home/loiretec/public_html/crm/demo/appoin/objects/class_service_methods_design.php');
include("/home/loiretec/public_html/crm/demo/appoin/objects/class_version_update.php");
include("/home/loiretec/public_html/crm/demo/appoin/objects/class_payment_hook.php");
include("/home/loiretec/public_html/crm/demo/appoin/objects/class_promo_code.php");
include("/home/loiretec/public_html/crm/demo/appoin/objects/class_front_first_step.php");

$cvars = new cleanto_myvariable();
$host = trim($cvars->hostnames);
$un = trim($cvars->username);
$ps = trim($cvars->passwords); 
$db = trim($cvars->database);

$con = @new cleanto_db();
$conn = $con->connect();


$check_existing_tables_index = $con->check_existing_tables_index($conn);
if($check_existing_tables_index == 'table_not_exist' || $check_existing_tables_index == 'table_exist_but_no_data'){
	?>
		<script type="text/javascript">
			var AdminloginCredentialObj={'site_url':'https://crm.loiretechnologies.com/demo/appoin/'};
			var AdminloginCredential_url=AdminloginCredentialObj.site_url;
			window.location=AdminloginCredential_url+"config_index.php";
		</script>
	<?php  
}

$promo = new cleanto_promo_code();
$promo->conn = $conn;

$first_step=new cleanto_first_step();
$first_step->conn=$conn;


/* NAME */
$objservice = new cleanto_services();
$objservice->conn = $conn;
$user = new cleanto_users();
$user->conn = $conn;
$settings = new cleanto_setting();
$settings->conn = $conn;
$frequently_discount = new cleanto_frequently_discount();
$frequently_discount->conn = $conn;
$objservice_method_design = new cleanto_service_methods_design();
$objservice_method_design->conn = $conn;

$payment_hook = new cleanto_paymentHook();
$payment_hook->conn = $conn;
$payment_hook->payment_extenstions_exist();
$purchase_check = $payment_hook->payment_purchase_status();

$objcheckversion = new cleanto_version_update();
$objcheckversion->conn = $conn;

$label_language_values = array();
if(isset($_SESSION['current_lang'])){
	$lang = $_SESSION['current_lang'];
	$language_label_arr = $settings->get_all_labelsbyid($_SESSION['current_lang']);
}
else {
	$lang = $settings->get_option("ct_language");
	$language_label_arr = $settings->get_all_labelsbyid($lang);
}
if ($language_label_arr[1] != "" || $language_label_arr[3] != "" || $language_label_arr[4] != "" || $language_label_arr[5] != "" || $language_label_arr[6] != "")
{
	$default_language_arr = $settings->get_all_labelsbyid("en");
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
	if($language_label_arr[6] != ''){
		$label_decode_front_form_errors = base64_decode($language_label_arr[6]);
	}else{
		$label_decode_front_form_errors = base64_decode($default_language_arr[6]);
	}
    
	$label_decode_front_unserial = unserialize($label_decode_front);
	$label_decode_admin_unserial = unserialize($label_decode_admin);
	$label_decode_error_unserial = unserialize($label_decode_error);
	$label_decode_extra_unserial = unserialize($label_decode_extra);
	$label_decode_front_form_errors_unserial = unserialize($label_decode_front_form_errors);
    
	$label_language_arr = array_merge($label_decode_front_unserial,$label_decode_admin_unserial,$label_decode_error_unserial,$label_decode_extra_unserial,$label_decode_front_form_errors_unserial);
	foreach($label_language_arr as $key => $value){
		$label_language_values[$key] = urldecode($value);
	}
}
else
{
    $default_language_arr = $settings->get_all_labelsbyid("en");
    
	$label_decode_front = base64_decode($default_language_arr[1]);
	$label_decode_admin = base64_decode($default_language_arr[3]);
	$label_decode_error = base64_decode($default_language_arr[4]);
	$label_decode_extra = base64_decode($default_language_arr[5]);
	$label_decode_front_form_errors = base64_decode($default_language_arr[6]);
    
	
	$label_decode_front_unserial = unserialize($label_decode_front);
	$label_decode_admin_unserial = unserialize($label_decode_admin);
	$label_decode_error_unserial = unserialize($label_decode_error);
	$label_decode_extra_unserial = unserialize($label_decode_extra);
	$label_decode_front_form_errors_unserial = unserialize($label_decode_front_form_errors);
    
	$label_language_arr = array_merge($label_decode_front_unserial,$label_decode_admin_unserial,$label_decode_error_unserial,$label_decode_extra_unserial,$label_decode_front_form_errors_unserial);
	foreach($label_language_arr as $key => $value){
		$label_language_values[$key] = urldecode($value);
	}
}
$frontimage=$settings->get_option('ct_front_image');
if($frontimage!=''){
$imagepath="https://crm.loiretechnologies.com/demo/appoin/assets/images/backgrounds/".$frontimage;
}else{
$imagepath='';
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
	?>
<!Doctype html>

<head>
    <title><?php  echo $settings->get_option("ct_page_title"); ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/png" href="https://crm.loiretechnologies.com/demo/appoin/assets/images/backgrounds/<?php  echo $settings->get_option('ct_favicon_image');?>"/>
	
	<?php  
	if($settings->get_option('ct_google_analytics_code') != ''){
		?>
		 <script async src="https://www.googletagmanager.com/gtag/js?id=<?php  echo $settings->get_option('ct_google_analytics_code'); ?>"></script>
		 <script>
		   window.dataLayer = window.dataLayer || [];
			 function gtag(){dataLayer.push(arguments);}
			 gtag('js', new Date());
		   gtag('config', '<?php  echo $settings->get_option('ct_google_analytics_code'); ?>');
		 </script>
		<?php  
	}
	?>
	<link rel="stylesheet" href="https://crm.loiretechnologies.com/demo/appoin/assets/css/ct-main.css" type="text/css" media="all" />
    <link rel="stylesheet" href="https://crm.loiretechnologies.com/demo/appoin/assets/css/ct-common.css" type="text/css" media="all" />
	<link rel="stylesheet" href="https://crm.loiretechnologies.com/demo/appoin/assets/css/tooltipster.bundle.min.css" type="text/css" media="all" />
    <link rel="stylesheet" href="https://crm.loiretechnologies.com/demo/appoin/assets/css/tooltipster-sideTip-shadow.min.css" type="text/css" media="all" />
	<?php   
	if(in_array($lang,array('ary','ar','azb','fa_IR','haz'))){ ?>	
	<!-- Front RTL style -->
	<link rel="stylesheet" href="https://crm.loiretechnologies.com/demo/appoin/assets/css/cta-front-rtl.css" type="text/css" media="all" />
	<?php   }
		$check_zip_code = explode(",",$settings->get_option('ct_bf_zip_code'));
		$dateFormat = $settings->get_option('ct_date_picker_date_format');
function date_format_js($date_Format) {
	
	$chars = array(
		// Day
		'd' => 'DD',
		'j' => 'DD',
		// Month
		'm' => 'MM',
		'M' => 'MMM',
		'F' => 'MMMM',
		// Year
		'Y' => 'YYYY',
		'y' => 'YYYY',
	);
	return strtr( (string) $date_Format, $chars );
}
	?>
	<script>
	var ct_postalcode_statusObj = {'ct_postalcode_status': '<?php   echo $settings->get_option('ct_postalcode_status');?>','zip_show_status':'<?php    echo $check_zip_code[0]; ?>'};
	var date_format_for_js = '<?php  echo date_format_js($dateFormat); ?>';
	var scrollable_cartObj = {'scrollable_cart': '<?php   echo $settings->get_option('ct_cart_scrollable'); ?>'};
	</script>
	<?php  
	$ct_frontend_fonts_val = $settings->get_option('ct_frontend_fonts');
	if($ct_frontend_fonts_val == 'Molle'){
		?>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Molle:400i" />
		<?php  
	}elseif($ct_frontend_fonts_val == 'Coda Caption'){
		?>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Coda+Caption:800" />
		<?php  
	}else{
		?>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=<?php  echo $ct_frontend_fonts_val; ?>:300,400,700" />
		<?php  
	}
	?>
	<link rel="stylesheet" href="https://crm.loiretechnologies.com/demo/appoin/assets/css/login-style.css" type="text/css" media="all" />
    <link rel="stylesheet" href="https://crm.loiretechnologies.com/demo/appoin/assets/css/ct-responsive.css" type="text/css" media="all" />
    <link rel="stylesheet" href="https://crm.loiretechnologies.com/demo/appoin/assets/css/ct-reset.min.css" type="text/css" media="all" />
    <link rel="stylesheet" href="https://crm.loiretechnologies.com/demo/appoin/assets/css/jquery-ui.min.css" type="text/css" media="all" />
    <link rel="stylesheet" href="https://crm.loiretechnologies.com/demo/appoin/assets/css/intlTelInput.css" type="text/css" media="all" />
    <link rel="stylesheet" href="https://crm.loiretechnologies.com/demo/appoin/assets/css/jquery-ui.theme.min.css" type="text/css" media="all" />
	 <link rel="stylesheet" href="https://crm.loiretechnologies.com/demo/appoin/assets/css/font-awesome/css/font-awesome.min.css" type="text/css" media="all">
    <link rel="stylesheet" href="https://crm.loiretechnologies.com/demo/appoin/assets/css/line-icons/simple-line-icons.css" type="text/css" media="all" />
	<link rel="stylesheet" href="https://crm.loiretechnologies.com/demo/appoin/assets/css/daterangepicker.css" type="text/css" media="all" />
	<link rel="stylesheet" href="https://crm.loiretechnologies.com/demo/appoin/assets/css/bootstrap/bootstrap.css" type="text/css" media="all" />
	<link rel="stylesheet" href="https://crm.loiretechnologies.com/demo/appoin/assets/css/star_rating.min.css" type="text/css" media="all">
	
	<?php   if($settings->get_option('ct_stripe_payment_form_status') == 'on'){  ?>
	<script src="https://js.stripe.com/v2/" type="text/javascript"></script>	
	<?php   } ?>
	<?php   if($settings->get_option('ct_2checkout_status') == 'Y'){  ?>
	<script src="https://www.2checkout.com/checkout/api/2co.min.js" type="text/javascript"></script>	
	<?php   } ?>
    <script src="https://crm.loiretechnologies.com/demo/appoin/assets/js/jquery-2.1.4.min.js" type="text/javascript"></script>
	<script src="https://crm.loiretechnologies.com/demo/appoin/assets/js/jquery.mask.js" type="text/javascript"></script>
	<script src="https://crm.loiretechnologies.com/demo/appoin/assets/js/moment.min.js" type="text/javascript"></script>
	<script src="https://crm.loiretechnologies.com/demo/appoin/assets/js/daterangepicker.js" type="text/javascript"></script>
	<?php  
	include(dirname(__FILE__) . '/extension/ct-common-front-extension-js.php');
	?>
    <script src="https://crm.loiretechnologies.com/demo/appoin/assets/js/ct-common-jquery.js?<?php    echo time(); ?>" type="text/javascript"></script>
	
	<script src="https://crm.loiretechnologies.com/demo/appoin/assets/js/tooltipster.bundle.min.js" type="text/javascript"></script>
	
	
    <?php  
    include(dirname(__FILE__)."/admin/language_js_objects.php");
    ?>
    <script src="https://crm.loiretechnologies.com/demo/appoin/assets/js/jquery-ui.min.js" type="text/javascript"></script>
    <script src="https://crm.loiretechnologies.com/demo/appoin/assets/js/jquery.nicescroll.min.js" type="text/javascript"></script>
    <script src="https://crm.loiretechnologies.com/demo/appoin/assets/js/intlTelInput.js" type="text/javascript"></script>
    <script src="https://crm.loiretechnologies.com/demo/appoin/assets/js/jquery.payment.min.js" type="text/javascript"></script>
    <script src="https://crm.loiretechnologies.com/demo/appoin/assets/js/star_rating_min.js" type="text/javascript"></script>

    <!-- **Google - Fonts** -->
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,700,800" rel="stylesheet"> 
    <script src="https://crm.loiretechnologies.com/demo/appoin/assets/js/jquery.validate.min.js"></script>
	<style>
        .error {
            color: red;
        }
		#ct, a, h1, h2, h3, h4, h5, h6, span, p, div, label, li, ul{
			font-family: <?php   echo $settings->get_option('ct_frontend_fonts'); ?>  !important;
		}
    </style>
	<?php   if($imagepath != ''){ ?>
	<style>
		#ct .ct-fixed-background {
			background-image: url(<?php  echo $imagepath;?>) !important;
		}
	</style>
	<?php   }else{ ?>
	<style>
		#ct .ct-fixed-background {
			background: #F0F0F5 !important;
		}
	</style>
	<?php   } ?>
	<?php  
	if($settings->get_option('ct_cart_scrollable') == 'N'){
		$ct_cart_scrollable_position = 'relative !important';
		?>
		<style>#ct .not-scroll-custom{ margin-top: 0 !important; }</style>
		<?php  
	}else{
		$ct_cart_scrollable_position = 'relative';
	}
	?>
    <?php  
    echo "<style>
	/* primary color */
		.cleanto{
			color: " . $settings->get_option('ct_text_color') . " !important;
		}
		.cleanto .ct-link.ct-mybookings{
			color:" . $settings->get_option('ct_text_color_on_bg') . " !important;
			background:" . $settings->get_option('ct_secondary_color') . " !important;
		}
		.cleanto .ct-link.ct-mybookings:hover{
			color:" . $settings->get_option('ct_text_color_on_bg') . " !important;
			background:" . $settings->get_option('ct_primary_color') . " !important;
		}
		.cleanto .ct-main-left .ct-list-header .ct-logged-in-user a.ct-link,
		.cleanto .ct-complete-booking-main .ct-link,
		.cleanto .ct-discount-coupons a.ct-apply-coupon.ct-link{
			color: " . $settings->get_option('ct_primary_color') . " !important;
		}
		.cleanto .ct-link:hover,
		.cleanto .ct-main-left .ct-list-header .ct-logged-in-user a.ct-link:hover,
		.cleanto .ct-complete-booking-main .ct-link:hover,
		.cleanto .ct-discount-coupons a.ct-apply-coupon.ct-link:hover{
			color: " . $settings->get_option('ct_secondary_color') . " !important;
		}
		.cleanto a,
		.cleanto .ct-link,
		.cleanto .ct-addon-count .ct-btn-group .ct-btn-text{
			color: " . $settings->get_option('ct_text_color') . " !important;
		}
		.cleanto a.ct-back-to-top i.icon-arrow-up,
		.cleanto .calendar-wrapper .calendar-header a.next-date:hover .icon-arrow-right:before,
		.cleanto .calendar-wrapper .calendar-header a.previous-date:hover .icon-arrow-left:before{
			color: " . $settings->get_option('ct_text_color_on_bg') . " !important;
		}
		.cleanto .calendar-body .ct-week:hover a span,
		.cleanto .ct-extra-services-list ul.addon-service-list li .ct-addon-ser:hover .addon-price{
			color: " . $settings->get_option('ct_text_color_on_bg') . " !important;
		}
		.cleanto #ct-type-2 .service-selection-main .ct-services-dropdown .ct-service-list:hover,
		.cleanto #ct-type-method .ct-services-method-dropdown .ct-service-method-list:hover,
		.cleanto .common-selection-main .common-data-dropdown .data-list:hover{
			color: " . $settings->get_option('ct_text_color_on_bg') . " !important;
			background:" . $settings->get_option('ct_primary_color') . " !important;
		}
		.cleanto .selected-is:hover,
		.cleanto #ct-type-2 .service-is:hover,
		.cleanto #ct-type-method .service-method-is:hover{
			border-color:" . $settings->get_option('ct_primary_color') . " !important;
		}
		.cleanto .ct-extra-services-list ul.addon-service-list li .ct-addon-ser:hover span:before{
			border-top-color:" . $settings->get_option('ct_primary_color') . " !important;
		}
		
		.cleanto .calendar-wrapper .calendar-header a.next-date:hover,
		.cleanto .calendar-wrapper .calendar-header a.previous-date:hover,
		.cleanto .calendar-body .ct-week:hover{
			background:" . $settings->get_option('ct_secondary_color') . " !important;
		}
		
		.cleanto .calendar-body .dates .ct-week.by_default_today_selected.active_today span,
		.cleanto .calendar-body .ct-show-time .time-slot-container ul li.time-slot,
		.cleanto .calendar-body .dates .ct-week.active span {
			color:" . $settings->get_option('ct_text_color_on_bg') . " !important;
		}
		
		.cleanto .ct-custom-checkbox  ul.ct-checkbox-list label:hover span,
		.cleanto .ct-custom-radio ul.ct-radio-list label:hover span{
			border:1px solid " . $settings->get_option('ct_secondary_color') . " !important;
		}
		#ct-login .ct-main-forget-password .ct-info-btn,
		.cleanto button,
		.cleanto #ct-front-forget-password .ct-front-forget-password .ct-info-btn,	
		.cleanto .ct-button{
			color:" . $settings->get_option('ct_text_color_on_bg') . " !important;
			background:" . $settings->get_option('ct_primary_color') . " !important;
			border: 2px solid " . $settings->get_option('ct_primary_color') . " !important;
		}
		.cleanto .ct-display-coupon-code .ct-coupon-value{
			color: " . $settings->get_option('ct_text_color_on_bg') . " !important;
			background:" . $settings->get_option('ct_secondary_color') . " !important;
		}
		/* for front date legends */
		
		.cleanto .calendar-body .ct-show-time .time-slot-container .ct-slot-legends .ct-selected-new{
			background: " . $settings->get_option('ct_secondary_color') . " !important;
		}
		/* seconday color */
		.nicescroll-cursors{
			background-color: " . $settings->get_option('ct_secondary_color') . " !important;
		}
				
	    .cleanto .calendar-body .dates .ct-week.active{
	    	background: " . $settings->get_option('ct_secondary_color') . " !important;
	    }
	/* background color all css  HOVER */
		.ct-white-color a{
			color: #FFFFFF !important;
			background: #FFFFFF !important;
		}
		.cleanto .ct-discount-list ul.ct-discount-often li input[type='radio']:checked + .ct-btn-discount{
			border-color: " . $settings->get_option('ct_secondary_color') . " !important;
		}
		.cleanto .ct-selected,
		.cleanto .ct-selected-data,
		.cleanto .ct-provider-list ul.provders-list li input[type='radio']:checked + lable span,
		.cleanto .ct-list-services ul.services-list li input[type='radio']:checked + lable span,
		.cleanto .ct-extra-services-list ul.addon-service-list li input[type='checkbox']:checked label span,
		.cleanto #ct-tslots .ct-date-time-main .time-slot-selection-main .time-slot.ct-selected,
		.cleanto .ct-button:hover,
		.cleanto-login .ct-main-forget-password .ct-info-btn:hover,
		.cleanto #ct-front-forget-password .ct-front-forget-password .ct-info-btn:hover,
		.cleanto  input[type='submit']:hover,
		.cleanto  input[type='reset']:hover,
		.cleanto  input[type='button']:hover,
		.cleanto  button:hover{
			color: " . $settings->get_option('ct_text_color_on_bg') . " !important;
			background: " . $settings->get_option('ct_secondary_color') . " !important;
			border-color: " . $settings->get_option('ct_secondary_color') . " !important;
		}
		
		.cleanto .promocodes{
		   color: " . $settings->get_option('ct_text_color_on_bg') . " !important;
		   background: " . $settings->get_option('ct_secondary_color') . " !important;
		   border-color: " . $settings->get_option('ct_secondary_color') . " !important;
		  }
		.cleanto #ct-price-scroll{
			border-color: " . $settings->get_option('ct_primary_color') . " !important;
			box-shadow: 0 4px 4px #ccc !important;
			position: ".$ct_cart_scrollable_position.";
		}
		
		.cleanto .ct-cart-wrapper .ct-cart-label-total-amount,
		.cleanto .ct-cart-wrapper .ct-cart-total-amount{
			color: " . $settings->get_option('ct_secondary_color') . " !important;
		}
		
		.cleanto .ct-list-services ul.services-list li input[type='radio']:checked + .ct-service ,
		.cleanto .ct-provider-list ul.provders-list li input[type='radio']:checked + .ct-provider ,
		.cleanto .ct-extra-services-list ul.addon-service-list li input[type='checkbox']:checked + .ct-addon-ser {
			border-color: " . $settings->get_option('ct_secondary_color') . " !important;
			box-shadow: 0 0 5px 1px " . $settings->get_option('ct_secondary_color') . " !important;
		}
		.cleanto .ct-extra-services-list ul.addon-service-list li input[type='checkbox']:checked + .ct-addon-ser span:before{
			border-top-color: " . $settings->get_option('ct_secondary_color') . " !important;
		}
		.cleanto .ct-extra-services-list ul.addon-service-list li input[type='checkbox']:checked + .ct-addon-ser .addon-price{
			color: " . $settings->get_option('ct_primary_color') . " !important;
		}
		
		
		.cleanto .border-c:hover,
		.cleanto .ct-list-services ul.services-list li .ct-service:hover,
		.cleanto .ct-list-services ul.addon-service-list li .ct-addon-ser:hover,
		.cleanto #ct-meth-unit-type-2.ct-meth-unit-count .bedroom-box .ct-bedroom-btn:hover,
		.cleanto #ct-meth-unit-type-2.ct-meth-unit-count .bathroom-box .ct-bathroom-btn:hover,
		.cleanto #ct-duration-main.ct-service-duration .ct-duration-list .duration-box .ct-duration-btn:hover,
		.cleanto .ct-extra-services-list .ct-addon-extra-count .ct-common-addon-list .ct-addon-box .ct-addon-btn:hover,
		.cleanto .ct-discount-list ul.ct-discount-often li .ct-btn-discount:hover,
		.cleanto .ct-custom-radio ul.ct-radio-list label:hover span,
		.cleanto .ct-custom-checkbox  ul.ct-checkbox-list label:hover span{
			border-color: " . $settings->get_option('ct_primary_color') . " !important;
			
		}
		
		
		.cleanto .ct-custom-checkbox  ul.ct-checkbox-list input[type='checkbox']:checked + label span{
			border: 1px solid " . $settings->get_option('ct_secondary_color') . " !important;
			background: " . $settings->get_option('ct_secondary_color') . " !important;
		}
		.cleanto .ct-custom-radio ul.ct-radio-list input[type='radio']:checked + label span{
			border:5px solid " . $settings->get_option('ct_secondary_color') . " !important;
		}
		.cleanto #ct-meth-unit-type-2.ct-meth-unit-count .bedroom-box .ct-bedroom-btn.ct-bed-selected,
		.cleanto #ct-meth-unit-type-2.ct-meth-unit-count .bathroom-box .ct-bathroom-btn.ct-bath-selected,
		.cleanto #ct-duration-main.ct-service-duration .ct-duration-list .duration-box .ct-duration-btn.duration-box-selected,
		.cleanto .ct-extra-services-list .ct-addon-extra-count .ct-common-addon-list .ct-addon-box .ct-addon-selected{
			background: " . $settings->get_option('ct_secondary_color') . " !important;
			color: " . $settings->get_option('ct_text_color_on_bg') . " !important;
			border-color: " . $settings->get_option('ct_secondary_color') . " !important;
		}
		
		.cleanto .ct-button.ct-btn-abs,
		.cleanto .panel-login .panel-heading .col-xs-6,
		.cleanto a.ct-back-to-top {
			background-color: " . $settings->get_option('ct_primary_color') . " !important;
		}
		.cleanto a.ct-back-to-top:hover
		{
			background-color: " . $settings->get_option('ct_secondary_color') . " !important;
		}
		
		.cleanto .calendar-body .dates .ct-week.by_default_today_selected{
			background-color: " . $settings->get_option('ct_primary_color') . " !important;
		}
		.cleanto .calendar-body .dates .ct-week.by_default_today_selected a span{
			color: " . $settings->get_option('ct_text_color_on_bg') . " !important;
		}
		
		.cleanto .calendar-body .dates .ct-week.selected_date.active{
			background-color: " . $settings->get_option('ct_secondary_color') . " !important;
			border-bottom: thin solid " . $settings->get_option('ct_secondary_color') . " !important;
		}
		.cleanto .calendar-body .ct-show-time .time-slot-container ul li.time-slot:hover,
		.cleanto .calendar-body .ct-show-time .time-slot-container ul li.time-slot.ct-booked{
			background-color: " . $settings->get_option('ct_secondary_color') . " !important;
		}
		
		
		.cleanto #ct-meth-unit-type-2.ct-meth-unit-count .bedroom-box .ct-bedroom-btn.ct-bed-selected,
		.cleanto #ct-meth-unit-type-2.ct-meth-unit-count .bathroom-box .ct-bathroom-btn.ct-bath-selected,
		.cleanto #ct-duration-main.ct-service-duration .ct-duration-list .duration-box .ct-duration-btn.duration-box-selected,
		.cleanto .ct-extra-services-list .ct-addon-extra-count .ct-common-addon-list .ct-addon-box .ct-addon-selected{
			/* background: " . $settings->get_option('ct_secondary_color') . " !important; */
		}
		
		
		
		/* hover inputs */
		.cleanto input[type='text']:hover,
		.cleanto input[type='password']:hover,
		.cleanto input[type='email']:hover,
		.cleanto input[type='url']:hover,
		.cleanto input[type='tel']:hover,
		.cleanto input[type='number']:hover,
		.cleanto input[type='range']:hover,
		.cleanto input[type='date']:hover,
		.cleanto textarea:hover,
		.cleanto select:hover,
		.cleanto input[type='search']:hover,
		.cleanto input[type='submit']:hover,
		.cleanto input[type='button']:hover{
			border-color: " . $settings->get_option('ct_primary_color') . " !important;
		}
		
		/* Focus inputs */
		.cleanto input[type='text']:focus,
		.cleanto input[type='password']:focus,
		.cleanto input[type='email']:focus,
		.cleanto input[type='url']:focus,
		.cleanto input[type='tel']:focus,
		.cleanto input[type='number']:focus,
		.cleanto input[type='range']:focus,
		.cleanto input[type='date']:focus,
		.cleanto textarea:focus,
		.cleanto select:focus,
		.cleanto input[type='search']:focus,
		.cleanto input[type='submit']:focus,
		.cleanto input[type='button']:focus{
			border-color: " . $settings->get_option('ct_secondary_color') . " !important;
			/* box-shadow: 0 0 0 1.5px " . $settings->get_option('ct_secondary_color') . " inset !important; */
		}
		.cleanto .ct-tooltip-link {color: " . $settings->get_option('ct_secondary_color') . " !important;}
	    /* for custom css option */
		".$settings->get_option('ct_custom_css')."
		
		.cleanto .ct_method_tab-slider--nav .ct_method_tab-slider-tabs {
		  background: " . $settings->get_option('ct_primary_color') . " !important;
		}
		.cleanto .ct_method_tab-slider--nav .ct_method_tab-slider-tabs:after {
		  background: " . $settings->get_option('ct_secondary_color') . " !important;
		}
		.cleanto .ct_method_tab-slider--nav .ct_method_tab-slider-trigger {
		  color: " . $settings->get_option('ct_text_color_on_bg') . " !important;
		}
		.cleanto .ct_method_tab-slider--nav .ct_method_tab-slider-trigger.active {
		  color: " . $settings->get_option('ct_text_color_on_bg') . " !important;
		}
		.ct-list-services ul.services-list li input[type=\"radio\"]:checked + .ct-service::after{
			background-color: " . $settings->get_option('ct_secondary_color') . " !important;
		}
		.rating-md{
			font-size: 1.5em !important ;
			display: table;
			margin: auto;
		}
	</style>";
    ?>
    <script>
        jQuery(document).ready(function () {
            var $sidebar = jQuery("#ct-price-scroll"),
                $window = jQuery(window),
                offset = $sidebar.offset(),
                topPadding = 250;
            fulloffset = jQuery("#ct").offset();

            $window.scroll(function () {
                var color = jQuery('#color_box').val();
                jQuery("#ct-price-scroll").css({'box-shadow': '0px 0px 1px ' + color + '', 'position': 'absolute'});
            });
        });
    </script>
    <script type="text/javascript">
        function myFunction() {
            var input = document.getElementById('coupon_val')
            var div = document.getElementById('display_code');
            div.innerHTML = input.value;
        }
    </script>
	
</head>
<body>
<div class="ct-wrapper cleanto" id="ct"> <!-- main wrapper -->
<div class="ct-fixed-background"></div>
	<!-- loader -->
	<?php   if($settings->get_option("ct_loader")== 'css' && $settings->get_option("ct_custom_css_loader") != ''){ ?>
		<div class="ct-loading-main" align="center">
			<?php   echo $settings->get_option("ct_custom_css_loader"); ?>
		</div>
	<?php   }elseif($settings->get_option("ct_loader")== 'gif' && $settings->get_option("ct_custom_gif_loader") != ''){ ?>
		<div class="ct-loading-main" align="center">
			<img style="margin-top:18%;" src="https://crm.loiretechnologies.com/demo/appoin/assets/images/gif-loader/<?php  echo $settings->get_option("ct_custom_gif_loader"); ?>"></img>
		</div>
	<?php   }else{ ?>
		<div class="ct-loading-main">
			<div class="loader">Loading...</div>
		</div>
	<?php   } ?>
	<?php  
	if($settings->get_option("ct_special_offer") == "Y"){
	?>
	<div class="promocodes" id="promocodes"><?php  echo $settings->get_option("ct_special_offer_text"); ?></div>
	<?php  
	}
	?>
    <div class="ct-main-wrapper">
	    <div class="ct_container">
		    <!-- left side main booking form -->

				<?php  
				/* added for display flags start */
				$langs_selects = $settings->count_lang();
				
				/* added for display flags end */
				?>
				<?php  
				/* added for display flags start */
				$langs_selects = $settings->count_lang();
				if($settings->get_option("ct_front_language_selection_dropdown") == "Y"  && $langs_selects > 1 ){
					?>
					<div class="ct-main-left ct-sm-7 ct-md-7 ct-xs-12 br-5 np mb-30">
					<?php  
				}else{ }
					?>
					
				<?php   if($settings->get_option("ct_postalcode_status") == 'Y'){ ?>
                <div class="ct-list-services ct-common-box">
                    <div class="ct-list-header">
                        <h3 class="header3"><?php  echo $label_language_values['where_would_you_like_us_to_provide_service']; ?></h3>
                        <!--<p class="ct-sub">Choose your service and property size</p>-->
                    </div>
                    <div class="ct-address-area-main">

                        <div class="ct-postal-code">
                            <h6 class="header6"><?php  echo $label_language_values['your_postal_code']; ?>
							<?php   if($settings->get_option("ct_front_tool_tips_status")=='on' && $settings->get_option("ct_front_tool_tips_postal_code")!=''){?>
								 <a class="ct-tooltip" href='#' title="<?php  echo $settings->get_option("ct_front_tool_tips_postal_code");?>"><i class="fa fa-info-circle fa-lg"></i></a>	
								<?php   } ?></h6>
                            <div class="ct-md-3 ct-sm-6 ct-xs-12 remove_show_error_class">
                                <?php  
                                $postalcode_placeholder = explode(',',$settings->get_option_postal("ct_postal_code"));
                                ?>
                                <input type="text" class="ct-postal-input" name="ct_postal_code" id="ct_postal_code" placeholder="<?php  echo $postalcode_placeholder[0]; ?>"/>
                                <label class="postal_code_error error"></label>
                                <label class="postal_code_available"></label>
                            </div>
                        </div>
                    </div>
                </div>
				<?php   } ?>
				
                <!-- end area based -->
                <div class="ct-list-services ct-common-box fl hide_allsss">
                    <div class="ct-list-header">
                        <h3 class="header3"><?php  echo $label_language_values['choose_service']; ?>
						 <?php   if($settings->get_option("ct_front_tool_tips_status")=='on' && $settings->get_option("ct_front_tool_tips_services")!=''){?>
						<a class="ct-tooltip" href="#" data-toggle="tooltip" title="<?php  echo $settings->get_option("ct_front_tool_tips_services");?>"><i class="fa fa-info-circle fa-lg"></i></a>	
						<?php   } ?>
						</h3>
						
                        <label class="service_not_selected_error" id="service_not_selected_error"></label>
                    </div>
                    <input id="total_cart_count" type="hidden" name="total_cart_count" value='1'/>
                    <!-- area based select cleaning -->
                    <?php  
                    if ($settings->get_option('ct_service_default_design') == 1) {
                        ?>
                        <!-- 1.box style services selection radio selection -->
                        <ul class="services-list">
                            <?php  
                            $services_data = $objservice->readall_for_frontend_services();
                            if (mysqli_num_rows($services_data) > 0) {
                                while ($s_arr = mysqli_fetch_array($services_data)) {
                                    ?>
                                    <li 
									<?php   if($settings->get_option('ct_company_service_desc_status') != "" &&  $settings->get_option('ct_company_service_desc_status') == "Y"){ ?>
									
									
									title='<?php  echo $s_arr['description'];?>' class="ct-sm-6 ct-md-4 ct-lg-3 ct-xs-12 remove_service_class ser_details ct-tooltip-services tooltipstered mb-20"
									<?php   } else {
										echo "class='ct-sm-6 ct-md-4 ct-lg-3 ct-xs-12 remove_service_class ser_details'";										
									}  ?>
                                        data-servicetitle="<?php  echo $s_arr['title']; ?>"
                                        data-id="<?php  echo $s_arr['id']; ?>">
                                        <input type="radio" name="service-radio"
                                               id="ct-service-<?php  echo $s_arr['id']; ?>"
                                               class="make_service_disable"/>
                                        <label class="ct-service ct-service-embed border-c" for="ct-service-<?php  echo $s_arr['id']; ?>">
                                            <?php  
                                            if ($s_arr['image'] == '') {
                                                $s_image = 'default_service.png';
                                            } else {
                                                $s_image = $s_arr['image'];
                                            }
                                            ?>
                                            <div class="ct-service-img"><img class="ct-image" src="<?php  echo SITE_URL; ?>assets/images/services/<?php  echo $s_image; ?>"/>
                                            </div>

                                            <div class="service-name fl ta-c"><?php  echo $s_arr['title']; ?></div>

                                        </label>
										
                                        
                                    </li>
                                <?php  
                                }?>
                           <?php    } else {
                                ?>
                                <li class="ct-sm-12 ct-md-12 ct-xs-12 ct-no-service-box"><?php  echo $label_language_values['please_configure_first_cleaning_services_and_settings_in_admin_panel']; ?>
                                </li>
                            <?php  
                            }
                            ?>
                        </ul>
                        <!--  1 end box style service selection -->
						<?php  
						if (mysqli_num_rows($services_data) === 1){
							$ser_arry = mysqli_fetch_array($services_data)
							?>
							<script>
							/** Make Service Selected **/
							jQuery(document).ready(function() {
								jQuery('.ser_details').trigger('click');
							});
							</script>
							<?php  
						}
                    } else {
                        ?>
						<input type="radio" style="display:none;" name="service-radio" id="ct-service-0" value='off' class="make_service_disable"/>
                        <!-- 2. sevice dropdown selection -->
					<?php  
                        $services_data = $objservice->readall_for_frontend_services();
                        if (mysqli_num_rows($services_data) > 0) {
                            ?>
                            <label class="service_not_selected_error_d2" id="service_not_selected_error_d2"><?php  echo $label_language_values['please_select_service']; ?></label>
                            <div class="services-list-dropdown fl" id="ct-type-2">
                            <div class="service-selection-main">
                                <div class="service-is" title="<?php  echo $label_language_values['choose_your_service'];?>">
                                    <div class="ct-service-list" id="ct_selected_service">
                                        <i class="icon-settings service-image icons"></i>

                                        <h3 class="service-name ser_name_for_error"><?php  echo $label_language_values['cleaning_service']; ?></h3>
                                    </div>
                                </div>
                                <div class="ct-services-dropdown remove_service_data"> <?php  
                                    while ($s_arr = mysqli_fetch_array($services_data)) { ?>
                                        <div class="ct-service-list select_service remove_service_class ser_details"
                                             data-servicetitle="<?php  echo $s_arr['title']; ?>"
                                             data-id="<?php  echo $s_arr['id']; ?>">
                                            <?php  
                                            if ($s_arr['image'] == '') {
                                                $s_image = 'default_service.png';
                                            } else {
                                                $s_image = $s_arr['image'];
                                            }
                                            ?>
                                            <img class="service-image"
                                                 src="<?php  echo SITE_URL; ?>assets/images/services/<?php  echo $s_image; ?>"
                                                 title="<?php  echo $label_language_values['service_image']; ?>"/>

                                            <h3 class="service-name"><?php  echo $s_arr['title']; ?></h3>
                                        </div>
                                    <?php   }
                                ?></div>
                            </div> </div><?php 
							if (mysqli_num_rows($services_data) === 1){
									$st_arry = mysqli_fetch_array($services_data)
									?>
									<script>
									/** Make Service Selected **/
									jQuery(document).ready(function() {
										jQuery('.select_service').trigger('click');
									});
									</script>
									<?php  
								}
                        } else {
                            ?>
                            <div class="ct-sm-12 ct-md-12 ct-xs-12 ct-no-service-box"><?php  echo $label_language_values['please_configure_first_cleaning_services_and_settings_in_admin_panel']; ?></div>
                        <?php  
                        }
                        ?>
                    <!-- 2. end service dropdown selection -->
                    <?php  
                    }
                    ?>
					<div class="ct-scroll-meth-unit"></div>

                    <div class="services-method-list-dropdown fl show_methods_after_service_selection show_single_service_method" id="ct-type-method">
                        <div class="service-method-selection-main">
                            <div class="ct-services-method-dropdown s_method_names">
                            </div>
                        </div>
                    </div>
                    <label class="empty_cart_error" id="empty_cart_error"></label>
					<label class="no_units_in_cart_error" id="no_units_in_cart_error"></label>
                    <input type='hidden' id="no_units_in_cart_err" value=''>
                    <input type='hidden' id="no_units_in_cart_err_count" value=''>
                    <!-- hrs selected  -->
                    <div class="ct-service-duration ct-md-12 ct-sm-12 s_m_units_design_1" id="ct-duration-main">
                        <div class="ct-inner-box border-c">

                            <div class="fl ct-md-12 mt-5 mb-15 np duration_hrs">
                            </div>
                            <!-- end duration hrs  -->
                        </div>
                    </div>
                    <!-- 1. bedroom and bathroom counting dropdown -->
                    <div class="ct-meth-unit-count ct-md-12 ct-sm-12 np ct_hidden fl s_m_units_design_2"
                         id="ct-meth-unit-type-1">
                        <div class="ct-inner-box border-c ser_design_2_units">

                        </div>
                    </div>
                    <!-- 1.end dropdown list bathroom bedroom -->
                    <!-- 2. boxed bathroom bedroom  -->
                    <div class="ct-meth-unit-count ct-md-12 ct-sm-12 np s_m_units_design_3" id="ct-meth-unit-type-2">
                        <div class="ct-inner-box border-c ser_design_3_units">

                        </div>
                    </div>
                    <!-- 2. end boxed bathroom bedroom -->

                    <div class="ct-meth-unit-count ct-md-12 ct-sm-12 s_m_units_design_4" id="ct-meth-unit-type-3">
                        <div class="ct-inner-box border-c ">
                            <div class="fl ct-bedrooms ct-btn-group ct-md-12 mt-5 mb-15 np">
                                <div class="ct-inner-box border-c ser_design_4_units">

                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <!-- end service list -->


                <!-- Module third area based -->
                <div class="ct-list-services ct-common-box s_m_units_design_5 ser_design_5_units">

                </div>
                <!-- end area based -->
                <!-- end module third area based -->

                <div class="ct-extra-services-list ct-common-box add_on_lists hide_allsss_addons mt-20">

                </div>

                <!-- how often discount -->
                <?php      
								if($settings->get_option("ct_recurrence_booking_status") == "Y"){
								$d_data = $frequently_discount->readall_front();
                if (mysqli_num_rows($d_data) > 0) {
                    ?>
                    <div class="ct-discount-list ct-common-box">
                        <div class="ct-list-header">
                          <h3 class="header3"><?php  echo $label_language_values['how_often_would_you_like_us_provide_service']; ?>
							 <?php   if($settings->get_option("ct_front_tool_tips_status")=='on' && $settings->get_option("ct_front_tool_tips_frequently_discount")!=''){?>
							<a class="ct-tooltip" href="#" data-toggle="tooltip" title="<?php  echo $settings->get_option("ct_front_tool_tips_frequently_discount");?>"><i class="fa fa-info-circle fa-lg"></i></a>	
							<?php   } ?>
													</h3>
                      <label class="freq_disc_empty_cart_error error" style="color:red"></label>
                        </div>
                        <ul class="ct-discount-often">
                            <?php  
                            while ($f_discount = mysqli_fetch_array($d_data)) {
                                ?>
                                <li class="ct-sm-6 ct-md-3 ct-xs-12 mb-10">
                                    <div class="discount-text f-l"><span class="discount-price"><?php  if ($f_discount['labels'] != '') { ?> <?php   echo ucwords($f_discount['labels']); } ?></span>
                                    </div>
                                    <input type="radio" name="frequently_discount_radio" checked data-id='<?php  echo $f_discount['id']; ?>' data-discount_type="<?php   echo $f_discount['d_type']; ?>" data-discount_value="<?php   echo $f_discount['rates']; ?>" class="cart_frequently_discount" id="discount-often-<?php  echo $f_discount['id']; ?>" data-name="<?php  echo ucwords($f_discount['discount_typename']); ?>"/>
                                    <label class="ct-btn-discount border-c" for="discount-often-<?php  echo $f_discount['id']; ?>">
																			<span class="float-left"><?php  echo ucwords($f_discount['discount_typename']); ?></span>
																			<span class="ct-discount-check float-right"></span>
                                    </label>
                                </li>
                            <?php  
                            }
                            ?>
                        </ul>
                    </div><!-- how often discount end -->
                <?php  
                } else {
									$d_data = $frequently_discount->readall_first_once();
									$f_discount = mysqli_fetch_assoc($d_data);
                    ?>
										<input type="radio" name="frequently_discount_radio" checked data-id='<?php  echo $f_discount['id']; ?>' data-discount_type="<?php   echo $f_discount['d_type']; ?>" data-discount_value="<?php   echo $f_discount['rates']; ?>" class="cart_frequently_discount" id="discount-often-<?php  echo $f_discount['id']; ?>" data-name="<?php  echo ucwords($f_discount['discount_typename']); ?>" style="display: none;"/>
									<?php    
                }
								}else{
									$d_data = $frequently_discount->readall_first_once();
									$f_discount = mysqli_fetch_assoc($d_data);
                    ?>
										<input type="radio" name="frequently_discount_radio" checked data-id='<?php  echo $f_discount['id']; ?>' data-discount_type="<?php   echo $f_discount['d_type']; ?>" data-discount_value="<?php   echo $f_discount['rates']; ?>" class="cart_frequently_discount" id="discount-often-<?php  echo $f_discount['id']; ?>" data-name="<?php  echo ucwords($f_discount['discount_typename']); ?>" style="display: none;" />
									<?php     
								}
                ?>
				
				<div class="ct-provider-list ct-common-box">
					<div class="ct-list-header">
					<h3 class="header3 show_select_staff_title" style="display:none;"><?php  echo $label_language_values['please_select_provider'];;?></h3>
						<ul class="provders-list"></ul>
					</div>
				</div>
				
                <!-- date time selection -->
                <div class="ct-date-time-main ct-common-box hide_allsss">
                    <div class="ct-list-header">
                        <h3 class="header3"><?php  echo $label_language_values['when_would_you_like_us_to_come']; ?>
						 <?php   if($settings->get_option("ct_front_tool_tips_status")=='on' && $settings->get_option("ct_front_tool_tips_time_slots")!=''){?>
						<a class="ct-tooltip" href="#" data-toggle="tooltip" title="<?php  echo $settings->get_option("ct_front_tool_tips_time_slots");?>"><i class="fa fa-info-circle fa-lg"></i></a>	
						<?php   } ?>
						</h3>
                    </div>

                    <div class="ct-md-12 ct-sm-12 ct-xs-12 ct-datetime-select-main">
                        <div class="ct-datetime-select">
                            <label class="date_time_error" id="date_time_error_id" for="complete_bookings"></label>

                            <div class="calendar-wrapper cal_info">

                            </div>
                            <!-- end calendar-wrapper -->
                        </div>
                    </div>
                </div>
                <!-- date and time slots end  -->
                <!-- personal details -->
				<div class="ct-user-info-main ct-common-box existing_user_details hide_allsss mt-30">
                    <div class="ct-list-header">
                        <h3 class="header3"><?php  echo $label_language_values['your_personal_details']; ?>
						 <?php   if($settings->get_option("ct_front_tool_tips_status")=='on' && $settings->get_option("ct_front_tool_tips_personal_details")!=''){?>
						<a class="ct-tooltip" href="#" data-toggle="tooltip" title="<?php  echo $settings->get_option("ct_front_tool_tips_personal_details");?>"><i class="fa fa-info-circle fa-lg"></i></a>	
						<?php   } ?>
						</h3>
						
                        <p class="ct-sub"><?php  echo $label_language_values['please_provide_your_address_and_contact_details']; ?></p>

						<div class="ct-logged-in-user client_logout">
                            <p class="welcome_msg_after_login pull-left"><?php  echo $label_language_values['you_are_logged_in_as']; ?> <span class='fname'></span> <span class='lname'></span></p>
                            <a href="javascript:void(0)" class="ct-link ml-10" id="logout" data-id="<?php  if (isset($_SESSION['ct_login_user_id'])) { echo $_SESSION['ct_login_user_id']; } ?>" title="<?php  echo $label_language_values['log_out']; ?>"><?php  echo $label_language_values['log_out']; ?></a>
                        </div>
                    </div>
				    <div class="ct-main-details">
                            <div class="ct-login-exist" id="ct-login">
                                <div class="ct-custom-radio">
                                    <ul class="ct-radio-list hide_radio_btn_after_login">
										<?php  
										if($settings->get_option('ct_existing_and_new_user_checkout') == 'on' && $settings->get_option('ct_guest_user_checkout') == 'on'){
										?>
										<li class="ct-exiting-user ct-md-4 ct-sm-6 ct-xs-12">
                                            <input id="existing-user" type="radio" class="input-radio existing-user user-selection" name="user-selection" value="Existing User"/>
                                            <label for="existing-user" class=""><span></span><?php  echo $label_language_values['existing_user']; ?></label>
                                        </li>
                                        <li class="ct-new-user ct-md-4 ct-sm-6 ct-xs-12">
                                            <input id="new-user" type="radio" checked="checked" class="input-radio new-user user-selection" name="user-selection" value="New-User"/>
                                            <label for="new-user" class=""><span></span><?php  echo $label_language_values['new_user']; ?>
                                            </label>
                                        </li>
										<li class="ct-guest-user ct-md-4 ct-sm-6 ct-xs-12">
                                            <input id="guest-user" type="radio" class="input-radio guest-user user-selection" name="user-selection" value="Guest-User"/>
                                            <label for="guest-user" class=""><span></span><?php  echo $label_language_values['guest_user']; ?></label>
                                        </li>
										<?php  
										}elseif($settings->get_option('ct_existing_and_new_user_checkout') == 'off' && $settings->get_option('ct_guest_user_checkout') == 'on'){
										?>
										<li class="ct-guest-user ct-md-4 ct-sm-6 ct-xs-12" style='display:none;'>
                                            <input id="guest-user" type="radio" class="input-radio guest-user user-selection" checked="checked"  name="user-selection" value="Guest-User"/>
                                            <label for="guest-user" class=""><span></span><?php  echo $label_language_values['guest_user']; ?></label>
                                        </li>						
										<?php  
										}elseif($settings->get_option('ct_existing_and_new_user_checkout') == 'on' && $settings->get_option('ct_guest_user_checkout') == 'off'){
										?>
										<li class="ct-exiting-user ct-md-4 ct-sm-6 ct-xs-12">
                                            <input id="existing-user" type="radio" class="input-radio existing-user user-selection" name="user-selection" value="Existing User"/>
                                            <label for="existing-user" class=""><span></span><?php  echo $label_language_values['existing_user']; ?></label>
                                        </li>
                                        <li class="ct-new-user ct-md-4 ct-sm-6 ct-xs-12">
                                            <input id="new-user" type="radio" checked="checked" class="input-radio new-user user-selection" name="user-selection" value="New-User"/>
                                            <label for="new-user" class=""><span></span><?php  echo $label_language_values['new_user']; ?>
                                            </label>
                                        </li>
										<?php  
										}
										?>
                                    </ul>
                                </div>

                                <div class="ct-login-existing ct_hidden">
                                    <form id="user_login_form" class="" method="POST">
                                        
                                        <div class="ct-md-6 ct-sm-6 ct-xs-12 ct-form-row hide_login_email fancy_input_wrap">
                                            
                                            <input type="text" class="add_show_error_class_for_login error fancy_input" name="ct_user_name" id="ct-user-name" onkeydown="if (event.keyCode == 13) document.getElementById('login_existing_user').click()"/>
                                            		<span class="highlight"></span>
													<span class="bar"></span>
                                            <label for="ct-user-name" class="fancy_label"><?php  echo $label_language_values['your_email']; ?></label>

                                        </div>

                                        <div class="ct-md-6 ct-sm-6 ct-xs-12 ct-form-row hide_password fancy_input_wrap">
                                            
                                            <input type="password" class="add_show_error_class_for_login error fancy_input" name="ct_user_pass" id="ct-user-pass" onkeydown="if (event.keyCode == 13) document.getElementById('login_existing_user').click()"/>
	                                            	<span class="highlight"></span>
													<span class="bar"></span>
                                            <label for="ct-user-pass" class="fancy_label"><?php  echo $label_language_values['your_password']; ?>
                                            </label>
                                        </div>

                                        <label class="login_unsuccessfull"></label>

                                        <div class="ct-md-12 ct-xs-12 mb-15 hide_login_btn">
											<input type="hidden" value='not' id="check_login_click" />
                                            <a href="javascript:void(0)" class="ct-button" id="login_existing_user" title="<?php  echo $label_language_values['log_in']; ?>"><?php  echo $label_language_values['log_in']; ?></a>
                                            <a href="javascript:void(0)" id="ct_forget_password" class="ct-link" title="<?php  echo $label_language_values['forget_password']; ?>?"><?php  echo $label_language_values['forget_password']; ?></a>
                                        </div>

                                    </form>
                                </div>
                            </div>                        
                        <input type="hidden" id="color_box" data-id="<?php  echo $settings->get_option('ct_secondary_color'); ?>" value="<?php  echo $settings->get_option('ct_secondary_color'); ?>"/>

                        <form id="user_details_form" class="" method="post">
								<div class="ct-new-user-details remove_preferred_password_and_preferred_email">
                                   
                                    <div class="ct-md-6 ct-sm-6 ct-xs-12 ct-form-row fancy_input_wrap">
                                        <input type="text" name="ct_email" id="ct-email" class="add_show_error_class error fancy_input"/>
                                        		<span class="highlight"></span>
												<span class="bar"></span>
                                        <label for="ct-email" class="fancy_label"><?php  echo $label_language_values['preferred_email']; ?></label>
                                    </div>

                                    <div class="ct-md-6 ct-sm-6 ct-xs-12 ct-form-row fancy_input_wrap">
                                        <input type="password" name="ct_preffered_pass" id="ct-preffered-pass" class="add_show_error_class error fancy_input"/>
                                        		<span class="highlight"></span>
												<span class="bar"></span>
                                        <label for="ct-preffered-pass" class="fancy_label"><?php  echo $label_language_values['preferred_password']; ?></label>
                                    </div>

                                </div>
                            <div class="ct-peronal-details">
								
								<div class="ct-md-6 ct-sm-6 ct-xs-12 ct-form-row remove_guest_user_preferred_email fancy_input_wrap">
									
									<input type="text" name="ct_email_guest" class="add_show_error_class error fancy_input" id="ct-email-guest" />
											<span class="highlight"></span>
											<span class="bar"></span>
									<label for="ct-email-guest" class="fancy_label"><?php  echo $label_language_values['preferred_email']; ?>
									</label>
								</div>

								<?php   $fn_check = explode(",",$settings->get_option("ct_bf_first_name"));if($fn_check[0] == 'on'){ ?>
                                <div class="ct-md-6 ct-sm-6 ct-xs-12 ct-form-row fancy_input_wrap">
                                    
                                    <input type="text" name="ct_first_name" class="add_show_error_class error fancy_input" id="ct-first-name" />
                                    		<span class="highlight"></span>
																				<span class="bar"></span>
                                    <label for="ct-first-name" class="fancy_label"><?php  echo $label_language_values['first_name']; ?></label>
                                </div>
								<?php   } else {
									?>
									<input type="hidden" name="ct_first_name" id="ct-first-name" class="add_show_error_class error" value=""/>
									<?php   
								} ?>
								<?php   $ln_check = explode(",",$settings->get_option("ct_bf_last_name"));if($ln_check[0] == 'on'){ ?>
                                <div class="ct-md-6 ct-sm-6 ct-xs-12 ct-form-row fancy_input_wrap">
                                    
                                    <input type="text" class="add_show_error_class error fancy_input" name="ct_last_name" id="ct-last-name"/>
                                    		<span class="highlight"></span>
																				<span class="bar"></span>
																		<label for="ct-last-pass" class="fancy_label"><?php  echo $label_language_values['last_name']; ?></label>
                                </div>
								<?php   } else {
									?>
									<input type="hidden" name="ct_last_name" id="ct-last-name" class="add_show_error_class error" value=""/>
									<?php   
								} ?>
								<?php   $phone_check = explode(",",$settings->get_option("ct_bf_phone")); if($phone_check[0] == 'on'){ ?>
                                <div class="ct-md-6 ct-sm-6 ct-xs-12 ct-form-row fancy_input_wrap phone_no_wrap">
                                   
                                    <input type="tel" value="" id="ct-user-phone" class="add_show_error_class error fancy_input" name="ct_user_phone"/>
                                    		<span class="highlight"></span>
																				<span class="bar"></span>
                                     <label for="ct-user-phone" class="fancy_label"><?php  echo $label_language_values['phone']; ?></label>
                                </div>
								<?php   } else {
									?>
									<input type="hidden" name="ct_user_phone" id="ct-user-phone" class="add_show_error_class error" value=""/>
									<?php   
								} ?>
								<?php   $address_check = explode(",",$settings->get_option("ct_bf_address"));if($address_check[0] == 'on'){ ?>
                                <div class="ct-md-6 ct-sm-6 ct-xs-12 ct-form-row fancy_input_wrap">
                                   
                                    <input type="text" name="ct_street_address" id="ct-street-address" class="add_show_error_class error fancy_input" />
                                    			<span class="highlight"></span>
																					<span class="bar"></span>
                                     <label for="ct-street-address" class="fancy_label"><?php  echo $label_language_values['street_address']; ?></label>
                                </div>
								<?php   } else {
									?>
									<input type="hidden" name="ct_street_address" id="ct-street-address" class="add_show_error_class error" value=""/>
									<?php   
								} ?>
								<?php   $zip_check = explode(",",$settings->get_option("ct_bf_zip_code"));if($zip_check[0] == 'on'){ ?>
								<div class="ct-md-6 ct-sm-6 ct-xs-12 ct-form-row remove_zip_code_class fancy_input_wrap">
                                    
                                    <input type="text" name="ct_zip_code" id="ct-zip-code" class="add_show_error_class error fancy_input" />
                                    			<span class="highlight"></span>
																					<span class="bar"></span>
                                    <label for="ct-zip-code" class="fancy_label"><?php  echo $label_language_values['zip_code']; ?></label>
                                </div>
								<?php   } else {
									?>
									<input type="hidden" name="ct_zip_code" id="ct-zip-code" class="add_show_error_class error" value=""/>
									<?php   
								} ?>
								<?php   $city_check = explode(",",$settings->get_option("ct_bf_city")); if($city_check[0] == 'on'){ ?>
                                <div class="ct-md-6 ct-sm-6 ct-xs-12 ct-form-row remove_city_class fancy_input_wrap">
                                    
                                    <input type="text" name="ct_city" id="ct-city" class="add_show_error_class error fancy_input" />
                                    			<span class="highlight"></span>
																					<span class="bar"></span>
                                    <label for="ct-city" class="fancy_label"><?php  echo $label_language_values['city']; ?></label>
                                </div>
								<?php   } else {
									?>
									<input type="hidden" name="ct_city" id="ct-city" class="add_show_error_class error" value=""/>
									<?php   
								} ?>
								<?php   $state_check = explode(",",$settings->get_option("ct_bf_state")); if($state_check[0] == 'on'){ ?>
                                <div class="ct-md-6 ct-sm-6 ct-xs-12 ct-form-row remove_state_class fancy_input_wrap">
                                    
                                    <input type="text" name="ct_state" id="ct-state" class="add_show_error_class error fancy_input" />
                                    			<span class="highlight"></span>
																					<span class="bar"></span>
                                    <label for="ct-state" class="fancy_label"><?php  echo $label_language_values['state']; ?></label>
                                </div>
								<?php   } else {
									?>
									<input type="hidden" name="ct_state" id="ct-state" class="add_show_error_class error" value=""/>
									<?php   
								} ?>
								<?php   $notes_check = explode(",",$settings->get_option("ct_bf_notes")); if($notes_check[0] == 'on'){ ?>
								<div class="ct-md-12 ct-xs-12 ct-form-row fancy_input_wrap">
                                   
                                    <textarea id="ct-notes" class="add_show_error_class error fancy_input" rows="10"></textarea>
                                    			<span class="highlight"></span>
																					<span class="bar"></span>
                                     <label for="ct-notes" class="fancy_label"><?php  echo $label_language_values['special_requests_notes']; ?></label>
                                </div>
								<?php   } else {
									?>
									<input type="hidden" id="ct-notes" class="add_show_error_class error" value=""/>
									<?php   
								} ?>
								

								<?php   
								if($settings->get_option('ct_vc_status')=="Y"){
									?>
                                <div class="ct-custom-radio ct-options-new ct-md-6 ct-sm-6 ct-xs-12 mb-15">
                                    <label><?php  echo $label_language_values['do_you_have_a_vaccum_cleaner']; ?></label>
                                    <ul class="ct-radio-list">
                                        <li>
                                            <input id="vaccum-yes" type="radio" checked="checked" class="input-radio vc_status" name="vacuum-cleaner" value="Vacuum-Yes"/>
                                            <label for="vaccum-yes"><span></span><?php  echo $label_language_values['yes']; ?></label>
                                        </li>
                                        <li>
                                            <input id="vaccum-no" type="radio" class="input-radio vc_status" name="vacuum-cleaner" value="Vacuum-No"/>
                                            <label for="vaccum-no"><span></span><?php  echo $label_language_values['no']; ?></label>
                                        </li>
                                    </ul>
                                </div>
								<?php   }?>
								<?php   
								if($settings->get_option('ct_p_status')=="Y"){
									?>
                                <div class="ct-custom-radio ct-options-new ct-md-6 ct-sm-6 ct-xs-12 mb-10">
                                    <label><?php  echo $label_language_values['do_you_have_parking']; ?></label>
                                    <ul class="ct-radio-list">
                                        <li>
                                            <input id="parking-yes" type="radio" checked="checked" class="input-radio p_status" name="parking" value="Parking-Yes"/>
                                            <label for="parking-yes"><span></span><?php  echo $label_language_values['yes']; ?></label>
                                        </li>
                                        <li>
                                            <input id="parking-no" type="radio" class="input-radio p_status"
                                                   name="parking" value="Parking-No"/>
                                            <label for="parking-no"><span></span><?php  echo $label_language_values['no']; ?></label>
                                        </li>

                                    </ul>
                                </div>
								<?php   }?>
								<?php   if($settings->get_option('ct_company_willwe_getin_status') != "" &&  $settings->get_option('ct_company_willwe_getin_status') == "Y"){?>
                                <div class="ct-options-new ct-md-12 ct-xs-12 mb-10 ct-form-row">
                                    <label><?php  echo $label_language_values['how_will_we_get_in']; ?></label>

                                    <div class="ct-option-select">
                                        <select class="ct-option-select" id="contact_status">
                                            <option value="I'll be at home"><?php  echo $label_language_values['i_will_be_at_home']; ?></option>
                                            <option value="Please call me"><?php  echo $label_language_values['please_call_me']; ?></option>
                                            <option value="The key is with the doorman"><?php  echo $label_language_values['the_key_is_with_the_doorman']; ?></option>
                                            <option value="Other"><?php  echo $label_language_values['other']; ?></option>
                                        </select>
                                    </div>
                                    <div class="ct-option-others pt-10 ct_hidden">
                                        <input type="text" name="other_contact_status" class="add_show_error_class error" id="other_contact_status" />
                                    </div>
                                </div>
								<?php   } ?>
<?php   
if( $settings->get_option('ct_appointment_details_display') == 'on' && ($address_check[0] == 'on' || $zip_check[0] == 'on' || $city_check[0] == 'on' || $state_check[0] == 'on'))
{ ?>					  
								<div class="ct-md-12 ct-xs-12 ct-form-row np">
									<div class="row ct-xs-12 mbi-30">
										<h3 class="header3 pull-left mt-10 pl-5"><?php  echo $label_language_values['appointment_details']; ?></h3>
										<div class="pull-left ml-10">
										<div class="ct-custom-checkbox">
											<ul class="ct-checkbox-list">
												<li>
													<input type="checkbox" id="retype_status" /> 
													<label for="retype_status" class="">
														(<?php  echo $label_language_values['same_as_above']; ?>) &nbsp;<span></span>
													</label>
												</li>
											</ul>
										</div>
										</div>
									</div>
									<div class="cb"></div>
									
									
									
									<?php   
									if($address_check[0] == 'on')
									{ ?>
										<div class="ct-md-12 ct-xs-12 ct-form-row fancy_input_wrap">
											
											<input type="text" id="app-street-address" name="app_street_address" class="add_show_error_class error fancy_input" >
													<span class="highlight"></span>
													<span class="bar"></span>
											<label for="app-notes" class="fancy_label"><?php  echo $label_language_values['appointment_address']; ?></label>
										</div>
							<?php     } else {
									?>
									<input type="hidden" name="app_street_address" id="app-street-address" class="add_show_error_class error" value=""/>
									<?php   } ?>
									
									
									
									<?php   
									if($zip_check[0] == 'on')
									{ ?>
										<div class="ct-md-4 ct-sm-6 ct-xs-12 ct-form-row fancy_input_wrap">
											
											<input type="text" name="app_zip_code" id="app-zip-code" class="add_show_error_class error fancy_input"  <?php   if($settings->get_option('ct_postalcode_status') == 'Y'){echo "readonly";} ?>/>
													<span class="highlight"></span>
													<span class="bar"></span>
											<label for="app-zip-code" class="fancy_label"><?php  echo $label_language_values['appointment_zip']; ?></label>
										</div>
							<?php     } else {
									?>
									<input type="hidden" name="app_zip_code" id="app-zip-code" class="add_show_error_class error" value=""/>
									<?php   
									} ?>
									
									<?php    
									if($city_check[0] == 'on')
									{ ?>
										<div class="ct-md-4 ct-sm-6 ct-xs-12 ct-form-row fancy_input_wrap">
											
											<input type="text" name="app_city" id="app-city" class="add_show_error_class error fancy_input" />
													<span class="highlight"></span>
													<span class="bar"></span>
											<label for="app-city" class="fancy_label"><?php  echo $label_language_values['appointment_city']; ?></label>
										</div>
							<?php     } else {
									?>
									<input type="hidden" name="app_city" id="app-city" class="add_show_error_class error" value=""/>
									<?php   
								} ?>
								
									<?php   
									if($state_check[0] == 'on')
									{ ?>										  
			   
										<div class="ct-md-4 ct-sm-6 ct-xs-12 ct-form-row fancy_input_wrap">
											
											<input type="text" name="app_state" id="app-state" class="add_show_error_class error fancy_input" />
													<span class="highlight"></span>
													<span class="bar"></span>
											<label for="app-state" class="fancy_label"><?php  echo $label_language_values['appointment_state']; ?></label>
										</div>
							<?php     } else {
									?>
									<input type="hidden" name="app_state" id="app-state" class="add_show_error_class error" value=""/>
									<?php   
								} ?>
									
								</div>
<?php    } ?>	
                            </div>
                    </div>
                    <!-- main details end -->
                </div>
                <!-- end personal details -->
                <!-- payment details -->

                <div class="ct-common-box hide_allsss">
                    <!-- Promocodes -->
                    <?php  
                    if ($settings->get_option('ct_show_coupons_input_on_checkout') == 'on') {
                        ?>
                        <div class="ct-discount-coupons ct-md-12 mb-20">
                            <div class="ct-form-rown">
                                <div class="ct-coupon-input ct-md-6 ct-sm-12 ct-xs-12 mt-10 mb-15 np fancy_input_wrap">
                                    <input id="coupon_val" type="text" name="coupon_apply"
                                           class="ct-coupon-input-text hide_coupon_textbox fancy_input"
                                           placeholder="<?php  echo $label_language_values['have_a_promocode']; ?>" maxlength="22" onchange="myFunction()"/>
                                    			<span class="highlight"></span>
																					<span class="bar"></span>
																					<label for="ct-user-name" class="fancy_label"></label>
                                    <a href="javascript:void(0);" class="ct-apply-coupon ct-link hide_coupon_textbox"
                                       name="apply-coupon" id="apply_coupon"><?php  echo $label_language_values['apply']; ?></a>
									      <?php   if($settings->get_option("ct_front_tool_tips_status")=='on' && $settings->get_option("ct_front_tool_tips_promocode")!=''){?>
										<a class="ct-tooltip" href="#" data-toggle="tooltip" title="<?php  echo $settings->get_option("ct_front_tool_tips_promocode");?>"><i class="fa fa-info-circle fa-lg"></i></a>	
										<?php   } ?>
                                    <label class="ct-error ofh coupon_invalid_error"></label>
                                    <!-- display coupon -->
                                    <div class="ct-display-coupon-code">
                                        <div class="ct-form-rown">
                                            <div class="ct-column ct-md-7 ct-xs-12 ofh">
                                                <label><?php  echo $label_language_values['applied_promocode']; ?></label>
                                            </div>
                                            <div class="ct-coupon-value-main ct-md-5 ct-xs-12">
                                                <span class="ct-coupon-value border-2" id="display_code"></span>
                                                <img id="ct-remove-applied-coupon"
                                                     src="<?php  echo SITE_URL; ?>/assets/images/ct-close.png"
                                                     class="reverse_coupon" title="<?php  echo $label_language_values['remove_applied_coupon']; ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php  
                    }
                    ?>
							<div class="ct-list-header mt-10">
                                <h3 class="header3"><?php  echo $label_language_values['preferred_payment_method']; ?>
								  <?php   if($settings->get_option("ct_front_tool_tips_status")=='on' && $settings->get_option("ct_front_tool_payment_method")!=''){?>
								<a class="ct-tooltip" href="#" data-toggle="tooltip" title="<?php  echo $settings->get_option("ct_front_tool_payment_method");?>"><i class="fa fa-info-circle fa-lg"></i></a>	
								<?php   } ?>
								</h3>
								
                            </div>
                       
                        <div class="ct-main-payments fl padding10">
                            <div class="payments-container f-l" id="ct-payments">
                                <label class="ct-error-msg"><?php  echo $label_language_values['please_select_one_payment_method']; ?></label>
                                <label class="ct-error-msg ct-paypal-error" id="paypal_error"></label>

                                <div class="ct-custom-radio ct-payment-methods f-l">
                                    <ul class="ct-radio-list ct-all-pay-methods">
										<?php    if ($settings->get_option('ct_pay_locally_status') == 'on') { ?>
										<li class="ct-md-3 ct-sm-6 ct-xs-12" id="pay-at-venue">
											<input type="radio" name="payment-methods" value="pay at venue" class="input-radio payment_gateway" id="pay-cash"  checked="checked"/>
											<label for="pay-cash" class="locally-radio"><span></span><?php  echo $label_language_values['pay_locally']; ?></label>
                                        </li>
										
										<?php   } ?>	
										
										<!-- bank transfer -->
										<?php    if ($settings->get_option('ct_bank_transfer_status') == 'Y' && ($settings->get_option('ct_bank_name') != '' || $settings->get_option('ct_account_name') != ''  || $settings->get_option('ct_account_number') != '' || $settings->get_option('ct_branch_code') != '' || $settings->get_option('ct_ifsc_code') != '' || $settings->get_option('ct_bank_description') != '')) { ?>
										<li class="ct-md-3 ct-sm-6 ct-xs-12" id="ct-bank-transer">
											<input type="radio" name="payment-methods" value="bank transfer" class="input-radio bank_transfer payment_gateway" id="bank-transer"  />
											<label for="bank-transer" class="locally-radio"><span></span><?php  echo $label_language_values['bank_transfer']; ?></label>
                                        </li>
										<?php   }?>
								
                                        <?php  
                                        if ($settings->get_option('ct_paypal_express_checkout_status') == 'on') {
                                            ?>
                                           
                                            <li class="ct-md-3 ct-sm-6 ct-xs-12" id="pay-at-venue">
                                                <input type="radio" name="payment-methods" value="paypal"
                                                       class="input-radio payment_gateway" id="pay-paypal" checked="checked" />
                                                <label for="pay-paypal"  class="locally-radio"><span></span><?php  echo $label_language_values['paypal']; ?><img src="<?php  echo SITE_URL; ?>/assets/images/cards/paypal.png" class="ct-paypal-image" alt="PayPal"></label>
                                            </li>
                                        <?php  
                                        } ?>
										
										<?php  
										if ($settings->get_option('ct_payumoney_status') == 'Y') {
                                            ?>
                                           
                                            <li class="ct-md-3 ct-sm-6 ct-xs-12" id="pay-at-venue">
                                                <input type="radio" name="payment-methods" value="payumoney"
                                                       class="input-radio payment_gateway" id="payumoney" checked="checked" />
                                                <label for="payumoney"  class="locally-radio"><span></span> <?php   echo $label_language_values['payumoney']; ?></label>
                                            </li>
                                        <?php  
                                        } ?>
										 <?php   if($settings->get_option('ct_authorizenet_status') == 'on' && $settings->get_option('ct_stripe_payment_form_status') != 'on' && $settings->get_option('ct_2checkout_status') != 'Y'){  ?>
										<!-- new added -->
										<li class="ct-md-3 ct-sm-6 ct-xs-12" id="card-payment">
											<input type="radio" name="payment-methods" value="card-payment" class="input-radio payment_gateway cccard" id="pay-card" checked="checked"/>
											<label for="pay-card" class="card-radio"><span></span><?php  echo $label_language_values['card_payment']; ?></label>
										</li>
										<?php    }  ?>
										<?php   if ($settings->get_option('ct_authorizenet_status') != 'on' && $settings->get_option('ct_stripe_payment_form_status') == 'on' && $settings->get_option('ct_2checkout_status') != 'Y'){  ?>
										<!-- new added -->
										<li class="ct-md-3 ct-sm-6 ct-xs-12" id="card-payment">
											<input type="radio" name="payment-methods" value="stripe-payment" class="input-radio payment_gateway cccard" id="pay-card" checked="checked"/>
											<label for="pay-card" class="card-radio"><span></span><?php  echo $label_language_values['card_payment']; ?></label>
										</li>
										<?php    }  ?>
										<?php   if ($settings->get_option('ct_authorizenet_status') != 'on' && $settings->get_option('ct_stripe_payment_form_status') != 'on' && $settings->get_option('ct_2checkout_status') == 'Y'){  ?>
										<!-- new added -->
										<li class="ct-md-3 ct-sm-6 ct-xs-12" id="card-payment">
											<input type="radio" name="payment-methods" value="2checkout-payment" class="input-radio payment_gateway cccard" id="pay-card" checked="checked"/>
											<label for="pay-card" class="card-radio"><span></span><?php  echo $label_language_values['card_payment']; ?></label>
										</li>
										<?php    } ?>
										<!-- Payment Start -->
										<?php  
										if(sizeof((array)$purchase_check)>0){
											foreach($purchase_check as $key=>$val){
												if($val == 'Y'){
													echo $payment_hook->payment_payment_selection_hook($key);
												}
											}
										}
										?>
										<!-- Payment End -->
	                                  </ul>
                                </div>
                            </div>
							
							
						  
							<div id="ct-pay-methods" class="payment-method-container f-l">

                                <div class="card-type-center f-l">
                                    <div class="common-payment-style ct_hidden" <?php   
										if ($settings->get_option('ct_authorizenet_status') == 'on' || $settings->get_option('ct_stripe_payment_form_status') == 'on' || $settings->get_option('ct_2checkout_status') == 'Y') {
											echo " style='display:block;' ";
										}
										elseif(sizeof((array)$purchase_check)>0){
											$check_pay = 'N';
											$display_check = '';
											foreach($purchase_check as $key=>$val){
												if($val == 'Y'){
													if($payment_hook->payment_display_cardbox_condition_hook($key) == true){
														if($display_check == ''){
															$display_check = " style='display:block;' ";
															$check_pay = 'Y';
														}elseif($display_check == " style='display:none;' "){
															$display_check = " style='display:block;' ";
															$check_pay = 'Y';
														}
													}else{
														if($display_check == ''){
															$display_check = " style='display:none;' ";
															$check_pay = 'Y';
														}elseif($display_check == " style='display:block;' "){
															$display_check = " style='display:none;' ";
															$check_pay = 'Y';
														}
													}
												}
											}
											echo $display_check;
										} ?> >
                                        <div class="payment-inner">
											<?php   if($settings->get_option('ct_2checkout_status') == 'Y'){ ?>
											<input id="token" name="token" type="hidden" value="">
											<?php   } ?>
                                            <div id="card-payment-fields" class="ct-md-12 ct-sm-12">
                                                <div class="ct-md-12 ct-xs-12 ct-header-bg">
                                                    <h4 class="header4"><?php  echo $label_language_values['card_details']; ?></h4>
                                                    
                                                </div>
                                                <div class="ct-md-12">
                                                    <label id="ct-card-payment-error" class="ct-error-msg ct-payment-error"><?php  echo $label_language_values['invalid_card_number']; ?><?php  echo $label_language_values['expiry_date_or_csv']; ?></label>  
												</div>
                                                <div class="ct-md-12 ct-sm-12 ct-xs-12 ct-card-details">
                                                    <div class="ct-form-row ct-md-12 ct-xs-12">
                                                        <label><?php  echo $label_language_values['card_number']; ?></label>
                                                        <i class="icon-credit-card icons"></i>
                                                        <input class="cc-number ct-card-number" maxlength="20" size="20" data-stripe="number" type="tel">
                                                        <span class="card" aria-hidden="true"></span>

                                                    </div>

                                                    <div class="ct-form-row ct-md-8 ct-sm-8 ct-xs-12 ct-exp-mnyr">
                                                        <label><?php  echo $label_language_values['expiry']; ?><?php  echo $label_language_values['mm_yyyy']; ?></label>
                                                        <i class="icon-calendar icons"></i>
                                                        <input data-stripe="exp-month" class="cc-exp-month ct-exp-month" maxlength="2" type="tel" placeholder="<?php    echo date('m'); ?>" />/

                                                        <input data-stripe="exp-year" class="cc-exp-year ct-exp-year" maxlength="4" type="tel" placeholder="<?php    echo date('Y'); ?>" />
                                                    </div>
                                                    <div class="ct-form-row ct-md-4 ct-sm-4 ct-xs-12 ct-stripe-cvc">
                                                        <label><?php  echo $label_language_values['cvc']; ?></label>
                                                        <i class="icon-lock icons"></i>
                                                        <input type="password" placeholder="●●●" maxlength="4" size="4" data-stripe="cvc" class="cc-cvc ct-cvc-code" type="tel"/>

                                                    </div>
                                                </div>
                                                <div class="ct-lock-image">
                                                	<div class="float-left">
                                                		<img src="<?php  echo SITE_URL; ?>/assets/images/cards/card-images.png" class="ct-stripe-image" alt="Stripe" />
                                                	</div>
                                                	<div class="float-left">
	                                                	<div class="ct-lock-img"></div>
	                                                	<div class="debit-lock-text">SAFE AND SECURE 256-BIT<br/> SSL ENCRYPTED PAYMENT</div>
                                                	</div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
							</div> 	
							<!--  bank details popup -->
							<div id="ct-bank-transfer-box" class="payment-method-container f-l">
								<div class="card-type-center f-l">
                                    <div class="common-payment-style-bank-transfer ct_hidden">
                                        <div class="payment-inner">
											<div id="card-payment-fields" style="">
                                                <div class="ct-md-12 ct-xs-12 ct-header-bg">
                                                    <h4 class="header4"><?php  echo $label_language_values['bank_details']; ?></h4>
                                                </div>
                                                <div class="ct-md-12">
                                                    <table>
														<tbody>
															<?php   if($settings->get_option('ct_bank_name') != "")
                {?>
                <tr class="dc_acc_name">
                 <th><strong><?php  echo $label_language_values['bank_name']; ?></strong></th>
                 <td><span class="amount"><?php  echo $settings->get_option('ct_bank_name');?></span></td>
                </tr>
               <?php   } 
               if($settings->get_option('ct_account_name') != "")
                {?>
                <tr class="dc_acc_name">
                 <th><strong><?php  echo $label_language_values['account_name']; ?></strong></th>
                 <td><span class="amount"><?php  echo $settings->get_option('ct_account_name');?></span></td>
                </tr>
               <?php   }
               if($settings->get_option('ct_account_number') != "")
                {?>
                <tr class="dc_acc_number">
                 <th><strong><?php  echo $label_language_values['account_number']; ?></strong></th>
                 <td><span class="amount"><?php  echo $settings->get_option('ct_account_number');?></span></td>
                </tr>
               <?php   } 
               if($settings->get_option('ct_branch_code') != "")
                {?>
                <tr class="dc_branch_code">
                 <th><strong><?php  echo $label_language_values['branch_code']; ?></strong></th>
                 <td><span class="amount"><?php  echo $settings->get_option('ct_branch_code');?></span></td>
                </tr>
               <?php   }
               if($settings->get_option('ct_ifsc_code') != "")
                {?>
                <tr class="dc_ifc_code">
                 <th><strong><?php  echo $label_language_values['ifsc_code']; ?></strong></th>
                 <td><span class="amount"><?php  echo $settings->get_option('ct_ifsc_code');?></span></td>
                </tr>
               <?php   }
               if($settings->get_option('ct_bank_description') != "")
                {?>
                <tr class="dc_ifc_code">
                 <th><strong><?php  echo $label_language_values['bank_description']; ?></strong></th>
                 <td><span class="amount"><?php  echo $settings->get_option('ct_bank_description');?></span></td>
                </tr>
                <?php   } ?>				
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>	
								</div>
							</div>	
                         
                        </div>
                  
                </div>
                <!-- end payment detials -->
				<div class="ct-list-header">
                    <p class="ct-sub-complete-booking"></p>
                </div>
				<?php   if ($settings->get_option('ct_cancelation_policy_status') == 'Y') { ?>

                <div class="ct-complete-booking ct-md-12 cb">
                    <h5 class="ct-cancel-booking"><?php  echo $label_language_values['cancellation_policy']; ?></h5>

                    <div class="ct-cancel-policy">
                        <p><?php  echo $settings->get_option('ct_cancel_policy_header'); ?></p>
                        <span class="show-more-toggler ct-link"><?php  echo $label_language_values['show_more']; ?></span>
                        <ul class="bullet-more">
                            <li><?php  echo $settings->get_option('ct_cancel_policy_textarea'); ?></li>
                        </ul>
                    </div>
                </div>
				<?php   } ?>

                <?php   if ($settings->get_option('ct_allow_terms_and_conditions') == 'Y' || $settings->get_option('ct_allow_privacy_policy') == 'Y') { ?>
                    <div class="bi-terms-agree ct-md-12">
                        <div class="ct-custom-checkbox">
                            <ul class="ct-checkbox-list">
                                <li>
                                    <input type="checkbox" name="accept-conditions" class="input-radio"
                                           id="accept-conditions"/>
                                    <label for="accept-conditions" class="">
                                        <span></span>
                                        <?php   echo $label_language_values['i_have_read_and_accepted_the']; ?>
                                        <?php   if ($settings->get_option('ct_allow_terms_and_conditions') == 'Y' && $settings->get_option('ct_allow_privacy_policy') == 'N') { ?>
                                            <a href="<?php  if ($settings->get_option('ct_terms_condition_link') != '') { echo $settings->get_option('ct_terms_condition_link'); }else{ echo 'javascript:void(0)'; } ?>" <?php   if ($settings->get_option('ct_terms_condition_link') != ''){ ?> target="-BLANK" <?php   } ?> class="ct-link">
                                                <?php   echo $label_language_values['terms_and_condition']; ?>
                                            </a>.
                                        <?php   } elseif ($settings->get_option('ct_allow_terms_and_conditions') == 'N' && $settings->get_option('ct_allow_privacy_policy') == 'Y') { ?>
                                            <a href="<?php  if ($settings->get_option('ct_privacy_policy_link') != ''){ echo $settings->get_option('ct_privacy_policy_link'); }else{ echo 'javascript:void(0)'; } ?>" <?php   if ($settings->get_option('ct_privacy_policy_link') != ''){ ?> target="-BLANK" <?php   } ?> class="ct-link"><?php  echo $label_language_values['privacy_policy']; ?></a>.
                                        <?php   } else { ?>
                                            <a href="<?php  if ($settings->get_option('ct_terms_condition_link') != ''){ echo $settings->get_option('ct_terms_condition_link'); }else{ echo 'javascript:void(0)'; } ?>" <?php   if ($settings->get_option('ct_terms_condition_link') != ''){ ?> target="-BLANK" <?php   } ?> class="ct-link"><?php  echo $label_language_values['terms_and_condition']; ?></a>
                                            <?php   echo $label_language_values['and']; ?>
                                            <a href="<?php  if ($settings->get_option('ct_privacy_policy_link') != '') { echo $settings->get_option('ct_privacy_policy_link'); }else{ echo 'javascript:void(0)'; } ?>" <?php   if ($settings->get_option('ct_privacy_policy_link') != ''){ ?> target="-BLANK" <?php   } ?> class="ct-link"><?php  echo $label_language_values['privacy_policy']; ?></a>.
                                        <?php   } ?>
                                    </label>
                                </li>
                            </ul>
                        </div>
                        <label class="terms_and_condition"></label>
                    </div>
                <?php   } ?>
				
                <div class="ta-center fl">
					<?php   if($settings->get_option("ct_loader")== 'css' && $settings->get_option("ct_custom_css_loader") != ''){ ?>
						<div class="ct-loading-main-complete_booking" align="center">
							<?php   echo $settings->get_option("ct_custom_css_loader"); ?>
						</div>
					<?php   }elseif($settings->get_option("ct_loader")== 'gif' && $settings->get_option("ct_custom_gif_loader") != ''){ ?>
						<div class="ct-loading-main-complete_booking" align="center">
							<img style="margin-top:18%;" src="https://crm.loiretechnologies.com/demo/appoin/assets/images/gif-loader/<?php  echo $settings->get_option("ct_custom_gif_loader"); ?>"></img>
						</div>
					<?php   }else{ ?>
						<div class="ct-loading-main-complete_booking">
							<div class="loader">Loading...</div>
						</div>
					<?php   } ?>					
					
                  <a href="javascript:void(0)" type='submit' data-currency_symbol="<?php  echo $settings->get_option('ct_currency_symbol'); ?>" id='complete_bookings' class="ct-button scroll_top_complete ct-btn-big ct_remove_id"><?php  echo $label_language_values['complete_booking'];?></a>
                </div>
				<center class="ct-white-color"><a href="https://codecanyon.net/item/appointment-booking-software-for-cleaning-maintenance-businesses-cleanto/18397969">Powered by </a><a href="http://www.cleanto.net/">Cleanto</a></center>
            </div>
            <!-- left side end -->
			


            <!-- right side card end -->

            </form>
            <a href="javascript:void(0)" class="ct-back-to-top br-2"><i class="icon-arrow-up icons"></i></a>
            <?php  
			if($settings->get_option('ct_payumoney_status') == 'Y'){
			?>
			<!--form action="https://sandboxsecure.payu.in/_payment" method="post" name="payuForm" id="payuForm"-->
      <form action="https://secure.payu.in/_payment" method="post" name="payuForm" id="payuForm">
				<input type="hidden" name="key" id="payu_key" value="" />
				<input type="hidden" name="hash" id="payu_hash" value=""/>
				<input type="hidden" name="txnid" id="payu_txnid" value="" />
				<input type="hidden" name="amount" id="payu_amount" value="" />
				<input type="hidden" name="firstname" id="payu_fname" value="" />
				<input type="hidden" name="email" id="payu_email" value="" />
				<input type="hidden" name="phone" id="payu_phone" value="" />
				<input type="hidden" name="productinfo" id="payu_productinfo" value="" />
				<input type="hidden" name="surl" id="payu_surl" value="" />
				<input type="hidden" name="furl" id="payu_furl" value="" />
				<input type="hidden" name="service_provider" id="payu_service_provider" value="" />
			</form>
			<?php  
			}
			?>
        </div>
        <!-- end container -->
    </div>
    
    <!-- forget password -->
    <div class="main">
        <div id="ct-front-forget-password">

            <div class="vertical-alignment-helper">
                <div class="vertical-align-center">
                    <div class="ct-front-forget-password visible">
                        <div class="form-container">
                            <div class="tab-content">
                                <form id="forget_pass" name="" method="POST">
                                    <h1 class="forget-password"><?php  echo $label_language_values['reset_password']; ?></h1>
                                    <h4><?php  echo $label_language_values['enter_your_email_and_we_send_you_instructions_on_resetting_your_password']; ?></h4>

                                    <div class="form-group fl mt-15">
                                        <label for="userEmail"><i class="icon-envelope-alt"></i><?php  echo $label_language_values['email']; ?></label>
                                        <input type="email" class="add_show_error_class error" id="rp_user_email" name="rp_user_email" placeholder="<?php  echo $label_language_values['registered_email']; ?>">
                                    </div>
                                    <label class="forget_pass_correct"></label>
                                    <label class="forget_pass_incorrect"></label>

                                    <div class="clearfix">
                                        <a class="btn ct-info-btn btn-lg ct-xs-12" href="javascript:void(0)"
                                           id="reset_pass"><?php  echo $label_language_values['send_mail']; ?></a>
                                    </div>
                                    <div class="clearfix">
                                        <a class="btn btn-link ct-xs-12" id="ct_login_user" href="javascript:void(0)"><?php  echo $label_language_values['back_to_login']; ?></a>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
	
    var baseurlObj = {'base_url': '<?php  echo BASE_URL;?>','stripe_publishkey':'<?php  echo $settings->get_option('ct_stripe_publishablekey');?>','stripe_status':'<?php  echo $settings->get_option('ct_stripe_payment_form_status');?>'};
    var siteurlObj = {'site_url': '<?php  echo SITE_URL;?>'};
    var ajaxurlObj = {'ajax_url': '<?php  echo AJAX_URL;?>'};
    var fronturlObj = {'front_url': '<?php  echo FRONT_URL;?>'};
    var termsconditionObj = {'terms_condition': '<?php  echo $settings->get_option('ct_allow_terms_and_conditions');?>'};
    var privacypolicyObj = {'privacy_policy': '<?php  echo $settings->get_option('ct_allow_privacy_policy');?>'};
    <?php  
    
	if($settings->get_option('ct_thankyou_page_url') == ''){
        $thankyou_page_url = 'https://crm.loiretechnologies.com/demo/appoin/front/thankyou.php';
    }else{
        $thankyou_page_url = $settings->get_option('ct_thankyou_page_url');
    }
	$phone = explode(",",$settings->get_option('ct_bf_phone'));
	$check_password = explode(",",$settings->get_option('ct_bf_password'));
	$check_fn = explode(",",$settings->get_option('ct_bf_first_name'));
	$check_ln = explode(",",$settings->get_option('ct_bf_last_name'));
	$check_addresss = explode(",",$settings->get_option('ct_bf_address'));
	$check_zip_code = explode(",",$settings->get_option('ct_bf_zip_code'));
	$check_city = explode(",",$settings->get_option('ct_bf_city'));
	$check_state = explode(",",$settings->get_option('ct_bf_state'));
	$check_notes = explode(",",$settings->get_option('ct_bf_notes'));
	$check_notes = explode(",",$settings->get_option('ct_bf_notes'));

	$ct_currency_symbol = $settings->get_option('ct_currency_symbol');
	$ct_currency_symbol_position = $settings->get_option('ct_currency_symbol_position');
	$ct_price_format_decimal_places = $settings->get_option('ct_price_format_decimal_places');
	$ct_partial_deposit_status = $settings->get_option('ct_partial_deposit_status');
	$ct_partial_deposit_amount = $settings->get_option('ct_partial_deposit_amount');
	$ct_partial_type = $settings->get_option('ct_partial_type');
  ?>

	var currency_symbol = '<?php   echo $ct_currency_symbol; ?>';
	var currency_symbol_position = '<?php   echo $ct_currency_symbol_position; ?>';
	var price_format_decimal_places = '<?php   echo $ct_price_format_decimal_places; ?>';
	var thankyoupageObj = {'thankyou_page': '<?php  echo $thankyou_page_url;?>'};
	var partial_deposit = {'partial_deposit_status' : '<?php  echo $ct_partial_deposit_status;?>','partial_deposit_amount' : '<?php  echo $ct_partial_deposit_amount;?>','partial_deposit_type' : '<?php  echo $ct_partial_type;?>'};
	var phone_status = {'statuss' : '<?php  echo $phone[0];?>','required' : '<?php  echo $phone[1];?>','min' : '<?php  echo $phone[2];?>','max' : '<?php  echo $phone[3];?>'};
  var check_password = {'statuss' : '<?php  echo $check_password[0];?>','required' : '<?php  echo $check_password[1];?>','min' : '<?php  echo $check_password[2];?>','max' : '<?php  echo $check_password[3];?>'};
	var check_fn = {'statuss' : '<?php  echo $check_fn[0];?>','required' : '<?php  echo $check_fn[1];?>','min' : '<?php  echo $check_fn[2];?>','max' : '<?php  echo $check_fn[3];?>'};
	var check_ln = {'statuss' : '<?php  echo $check_ln[0];?>','required' : '<?php  echo $check_ln[1];?>','min' : '<?php  echo $check_ln[2];?>','max' : '<?php  echo $check_ln[3];?>'};
	var check_addresss = {'statuss' : '<?php  echo $check_addresss[0];?>','required' : '<?php  echo $check_addresss[1];?>','min' : '<?php  echo $check_addresss[2];?>','max' : '<?php  echo $check_addresss[3];?>'};
	var check_zip_code = {'statuss' : '<?php  echo $check_zip_code[0];?>','required' : '<?php  echo $check_zip_code[1];?>','min' : '<?php  echo $check_zip_code[2];?>','max' : '<?php  echo $check_zip_code[3];?>'};
	var check_city = {'statuss' : '<?php  echo $check_city[0];?>','required' : '<?php  echo $check_city[1];?>','min' : '<?php  echo $check_city[2];?>','max' : '<?php  echo $check_city[3];?>'};
	var check_state = {'statuss' : '<?php  echo $check_state[0];?>','required' : '<?php  echo $check_state[1];?>','min' : '<?php  echo $check_state[2];?>','max' : '<?php  echo $check_state[3];?>'};
	var check_notes = {'statuss' : '<?php  echo $check_notes[0];?>','required' : '<?php  echo $check_notes[1];?>','min' : '<?php  echo $check_notes[2];?>','max' : '<?php  echo $check_notes[3];?>'}; 
  <?php  
	$nacode = explode(',',$settings->get_option("ct_company_country_code"));
	$allowed = $settings->get_option("ct_phone_display_country_code");
	?>
	var countrycodeObj = {'numbercode': '<?php  echo $nacode[0];?>', 'alphacode': '<?php  echo $nacode[1];?>', 'countrytitle': '<?php  echo $nacode[2];?>', 'allowed': '<?php  echo $allowed;?>'};
	var subheaderObj = {'subheader_status': '<?php  echo $settings->get_option('ct_subheaders');?>'};
	var twocheckout_Obj = {'sellerId': '<?php  echo $settings->get_option('ct_2checkout_sellerid');?>', 'publishKey': '<?php  echo $settings->get_option('ct_2checkout_publishkey');?>', 'twocheckout_status': '<?php  echo $settings->get_option('ct_2checkout_status'); ?>'};
	var appoint_details = {'status':'<?php  echo $settings->get_option('ct_appointment_details_display');?>'};
	<?php   $is_login_user = "N"; if(isset($_SESSION['ct_login_user_id'])){$is_login_user = "Y";} ?>
	var is_login_user = '<?php   echo $is_login_user; ?>';
</script>
</body>
</html>