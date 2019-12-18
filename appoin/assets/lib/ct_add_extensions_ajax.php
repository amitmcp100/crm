<?php 
if (extension_loaded('zip')) {
	include(dirname(dirname(dirname(__FILE__))). '/objects/class_setting.php'); 
	include(dirname(dirname(dirname(__FILE__))). "/objects/class_connection.php");
	$cvars = new cleanto_myvariable();
	$host = trim($cvars->hostnames);
	$un = trim($cvars->username);
	$ps = trim($cvars->passwords); 
	$db = trim($cvars->database);

	$con = new cleanto_db();
	$conn = $con->connect();

	$settings = new cleanto_setting();
	$settings->conn = $conn;
	
	/* download zip */
	if(isset($_POST['action']) && $_POST['action'] == "add_extension")
	{
		$server_path = str_rot13("uggc://fxlzbbaynof.pbz/pyrnagb/rkgrafvbaf");
		$aV = $_POST['installed_version'];
		$version_file_name = $_POST['extension'].'-'.$_POST['update_version'];
		if (( ($aV != '' || $aV == '') && $aV < $_POST['update_version'] && (!file_exists(dirname(dirname(dirname(__FILE__))).'/extension/'.$version_file_name.'.zip') || !is_dir(dirname(dirname(dirname(__FILE__))).'/extension/'.$_POST['extension']))) || ($aV == $_POST['update_version'] && (!file_exists(dirname(dirname(dirname(__FILE__))).'/extension/'.$version_file_name.'.zip') || !is_dir(dirname(dirname(dirname(__FILE__))).'/extension/'.$_POST['extension']))))
		{
			$updated = false;
			/* Download The File If We Do Not Have It */
			if ( !is_file(dirname(dirname(dirname(__FILE__))).'/extension/'.$version_file_name.'.zip' )) 
			{
				$newUpdate = $settings->url_get_contents($server_path.'/'.$version_file_name.'.zip');
				if ( !is_dir( dirname(dirname(dirname(__FILE__))).'/extension/' ) ){ 
					mkdir ( dirname(dirname(dirname(__FILE__))).'/extension/' );
				}
				$dlHandler = fopen(dirname(dirname(dirname(__FILE__))).'/extension/'.$version_file_name.'.zip', 'w');
				if ( !fwrite($dlHandler, $newUpdate) ) { exit(); }
				fclose($dlHandler);
				unset($newUpdate);
			}
			/* Open The File And Do Stuff */
			$zipHandle = zip_open(dirname(dirname(dirname(__FILE__))).'/extension/'.$version_file_name.'.zip');
			while ($aF = zip_read($zipHandle) )
			{
				$thisFileName = zip_entry_name($aF);
				$thisFileDir = dirname($thisFileName);
			   
				/* Continue if its not a file */
				if ( substr($thisFileName,-1,1) == '/extension/'){ continue; }
				
				/* Make the directory if we need to... */
				if ( !is_dir ( dirname(dirname(dirname(__FILE__))).'/extension/'.$thisFileDir ) ) {
					 mkdir ( dirname(dirname(dirname(__FILE__))).'/extension/'.$thisFileDir );
				}
			   
				/* Overwrite the file */
				if ( !is_dir(dirname(dirname(dirname(__FILE__))).'/extension/'.$thisFileName) ) 
				{
					$contents = zip_entry_read($aF, zip_entry_filesize($aF));
					$updateThis = '';
					
					$updateThis = fopen(dirname(dirname(dirname(__FILE__))).'/extension/'.$thisFileName, 'w');
					fwrite($updateThis, $contents);
					fclose($updateThis);
					unset($contents);
				}
				$updated = true;
			}
			if($updated){
				$settings->set_option($_POST['purchase_option'],'Y');
				$settings->set_option($_POST['version_option'],$_POST['update_version']);
				if($_POST['payment_option'] != ''){
					$ct_payment_extensions = $settings->get_option('ct_payment_extensions');
					$unserialize_ct_payment_extensions = unserialize($ct_payment_extensions);
					$unserialize_payment_option = unserialize($_POST['payment_option']);
					$keySearch = $_POST['extension'];
					$counts = 0;
					foreach ($unserialize_ct_payment_extensions as $key => $item) {
						if ($key == $keySearch) {
						   $counts = $counts + 1;
						}
					}
					if($counts==0){
						$unserialize_ct_payment_extensions[$keySearch] = $unserialize_payment_option[$keySearch];
						$serialize_ct_payment_extensions = serialize($unserialize_ct_payment_extensions);
						$settings->set_option('ct_payment_extensions',$serialize_ct_payment_extensions);
						
						$option_array = unserialize($_POST['payment_add_option']);
						if(sizeof((array)$option_array)>0){
							foreach($option_array as $key=>$val){
								$settings->set_option_check($key,$val);
							}
						}
						if($_POST['payment_add_lable'] != ''){
							$alllang = $settings->get_all_languages();
							while($all = mysqli_fetch_array($alllang))
							{
								$language_label_arr = $settings->get_all_labelsbyid($all[2]);
								
								$label_decode_front = base64_decode($language_label_arr[1]);
								$label_decode_admin = base64_decode($language_label_arr[3]);
								$label_decode_error = base64_decode($language_label_arr[4]);
								$label_decode_extra = base64_decode($language_label_arr[5]);
								$label_decode_front_form_error = base64_decode($language_label_arr[6]);
								
								$label_decode_front_unserial = unserialize($label_decode_front);
								$label_decode_admin_unserial = unserialize($label_decode_admin);
								$label_decode_error_unserial = unserialize($label_decode_error);
								$label_decode_extra_unserial = unserialize($label_decode_extra);
								$label_decode_front_form_error_unserial = unserialize($label_decode_front_form_error);
								
								/* UPDATE ALL CODE WITH NEW URLENCODE PATTERN */
								foreach($label_decode_front_unserial as $key => $value){
									$label_decode_front_unserial[$key] = urldecode($value);
								}
								foreach($label_decode_admin_unserial as $key => $value){
									$label_decode_admin_unserial[$key] = urldecode($value);
								}
								foreach($label_decode_error_unserial as $key => $value){
									$label_decode_error_unserial[$key] = urldecode($value);
								}
								foreach($label_decode_extra_unserial as $key => $value){
									$label_decode_extra_unserial[$key] = urldecode($value);
								}
								
								foreach($label_decode_front_form_error_unserial as $key => $value){
									$label_decode_front_form_error_unserial[$key] = urldecode($value);
								}
								
								$unserialized_payment_add_lable = unserialize($_POST['payment_add_lable']);
								foreach($unserialized_payment_add_lable as $key=>$val){
									if($key == 'label_data'){
										if(sizeof((array)$val)>0){
											foreach($val as $keyy=>$vall){
												$label_decode_front_unserial[$keyy]=urlencode($vall);
											}
										}
									}elseif($key == 'admin_labels'){
										if(sizeof((array)$val)>0){
											foreach($val as $keyy=>$vall){
												$label_decode_admin_unserial[$keyy]=urlencode($vall);
											}
										}
									}elseif($key == 'error_labels'){
										if(sizeof((array)$val)>0){
											foreach($val as $keyy=>$vall){
												$label_decode_error_unserial[$keyy]=urlencode($vall);
											}
										}
									}elseif($key == 'extra_labels'){
										if(sizeof((array)$val)>0){
											foreach($val as $keyy=>$vall){
												$label_decode_extra_unserial[$keyy]=urlencode($vall);
											}
										}
									}elseif($key == 'front_error_labels'){
										if(sizeof((array)$val)>0){
											foreach($val as $keyy=>$vall){
												$label_decode_front_form_error_unserial[$keyy]=urlencode($vall);
											}
										}
									}
								}
								
								$language_front_arr = base64_encode(serialize($label_decode_front_unserial));
								$language_admin_arr = base64_encode(serialize($label_decode_admin_unserial));
								$language_error_arr = base64_encode(serialize($label_decode_error_unserial));
								$language_extra_arr = base64_encode(serialize($label_decode_extra_unserial));
								$language_form_error_arr = base64_encode(serialize($label_decode_front_form_error_unserial));
								
								$settings->update_languages($language_front_arr,$language_admin_arr,$language_error_arr,$language_extra_arr,$language_form_error_arr,$all[2]);
							}
						}
					}
				}
			}
		}
	}
	if(isset($_POST['action']) && $_POST['action'] == "activate_extensions_zip")
	{
		$server_path = str_rot13("uggc://fxlzbbaynof.pbz/pyrnagb/rkgrafvbaf");
		$aV = $_POST['installed_version'];
		$version_file_name = $_POST['extension'].'-'.$_POST['update_version'];
		if (( ($aV != '' || $aV == '') && $aV < $_POST['update_version'] && (!file_exists(dirname(dirname(dirname(__FILE__))).'/extension/'.$version_file_name.'.zip') || !is_dir(dirname(dirname(dirname(__FILE__))).'/extension/'.$_POST['extension']))) || ($aV == $_POST['update_version'] && (!file_exists(dirname(dirname(dirname(__FILE__))).'/extension/'.$version_file_name.'.zip') || !is_dir(dirname(dirname(dirname(__FILE__))).'/extension/'.$_POST['extension']))))
		{
			$updated = false;
			/* Download The File If We Do Not Have It */
			if ( !is_file(dirname(dirname(dirname(__FILE__))).'/extension/'.$version_file_name.'.zip' )) 
			{
				$newUpdate = $settings->url_get_contents($server_path.'/'.$version_file_name.'.zip');
				if ( !is_dir( dirname(dirname(dirname(__FILE__))).'/extension/' ) ){ 
					mkdir ( dirname(dirname(dirname(__FILE__))).'/extension/' );
				}
				$dlHandler = fopen(dirname(dirname(dirname(__FILE__))).'/extension/'.$version_file_name.'.zip', 'w');
				if ( !fwrite($dlHandler, $newUpdate) ) { exit(); }
				fclose($dlHandler);
				unset($newUpdate);
			}
			/* Open The File And Do Stuff */
			$zipHandle = zip_open(dirname(dirname(dirname(__FILE__))).'/extension/'.$version_file_name.'.zip');
			while ($aF = zip_read($zipHandle) )
			{
				$thisFileName = zip_entry_name($aF);
				$thisFileDir = dirname($thisFileName);
			   
				/* Continue if its not a file */
				if ( substr($thisFileName,-1,1) == '/extension/'){ continue; }
				
				/* Make the directory if we need to... */
				if ( !is_dir ( dirname(dirname(dirname(__FILE__))).'/extension/'.$thisFileDir ) ) {
					 mkdir ( dirname(dirname(dirname(__FILE__))).'/extension/'.$thisFileDir );
				}
			   
				/* Overwrite the file */
				if ( !is_dir(dirname(dirname(dirname(__FILE__))).'/extension/'.$thisFileName) ) 
				{
					$contents = zip_entry_read($aF, zip_entry_filesize($aF));
					$updateThis = '';
					
					$updateThis = fopen(dirname(dirname(dirname(__FILE__))).'/extension/'.$thisFileName, 'w');
					fwrite($updateThis, $contents);
					fclose($updateThis);
					unset($contents);
				}
				$updated = true;
			}
			if($updated){
				$settings->set_option($_POST['purchase_option'],'Y');
				$settings->set_option($_POST['version_option'],$_POST['update_version']);
				if($_POST['payment_option'] != ''){
					$ct_payment_extensions = $settings->get_option('ct_payment_extensions');
					$unserialize_ct_payment_extensions = unserialize($ct_payment_extensions);
					$unserialize_payment_option = unserialize($_POST['payment_option']);
					$keySearch = $_POST['extension'];
					$counts = 0;
					foreach ($unserialize_ct_payment_extensions as $key => $item) {
						if ($key == $keySearch) {
						   $counts = $counts + 1;
						}
					}
					if($counts==0){
						$unserialize_ct_payment_extensions[$keySearch] = $unserialize_payment_option[$keySearch];
						$serialize_ct_payment_extensions = serialize($unserialize_ct_payment_extensions);
						$settings->set_option('ct_payment_extensions',$serialize_ct_payment_extensions);
						
						$option_array = unserialize($_POST['payment_add_option']);
						if(sizeof((array)$option_array)>0){
							foreach($option_array as $key=>$val){
								$settings->set_option_check($key,$val);
							}
						}
						if($_POST['payment_add_lable'] != ''){
							$alllang = $settings->get_all_languages();
							while($all = mysqli_fetch_array($alllang))
							{
								$language_label_arr = $settings->get_all_labelsbyid($all[2]);
								
								$label_decode_front = base64_decode($language_label_arr[1]);
								$label_decode_admin = base64_decode($language_label_arr[3]);
								$label_decode_error = base64_decode($language_label_arr[4]);
								$label_decode_extra = base64_decode($language_label_arr[5]);
								$label_decode_front_form_error = base64_decode($language_label_arr[6]);
								
								$label_decode_front_unserial = unserialize($label_decode_front);
								$label_decode_admin_unserial = unserialize($label_decode_admin);
								$label_decode_error_unserial = unserialize($label_decode_error);
								$label_decode_extra_unserial = unserialize($label_decode_extra);
								$label_decode_front_form_error_unserial = unserialize($label_decode_front_form_error);
								
								/* UPDATE ALL CODE WITH NEW URLENCODE PATTERN */
								foreach($label_decode_front_unserial as $key => $value){
									$label_decode_front_unserial[$key] = urldecode($value);
								}
								foreach($label_decode_admin_unserial as $key => $value){
									$label_decode_admin_unserial[$key] = urldecode($value);
								}
								foreach($label_decode_error_unserial as $key => $value){
									$label_decode_error_unserial[$key] = urldecode($value);
								}
								foreach($label_decode_extra_unserial as $key => $value){
									$label_decode_extra_unserial[$key] = urldecode($value);
								}
								
								foreach($label_decode_front_form_error_unserial as $key => $value){
									$label_decode_front_form_error_unserial[$key] = urldecode($value);
								}
								
								$unserialized_payment_add_lable = unserialize($_POST['payment_add_lable']);
								foreach($unserialized_payment_add_lable as $key=>$val){
									if($key == 'label_data'){
										if(sizeof((array)$val)>0){
											foreach($val as $keyy=>$vall){
												$label_decode_front_unserial[$keyy]=urlencode($vall);
											}
										}
									}elseif($key == 'admin_labels'){
										if(sizeof((array)$val)>0){
											foreach($val as $keyy=>$vall){
												$label_decode_admin_unserial[$keyy]=urlencode($vall);
											}
										}
									}elseif($key == 'error_labels'){
										if(sizeof((array)$val)>0){
											foreach($val as $keyy=>$vall){
												$label_decode_error_unserial[$keyy]=urlencode($vall);
											}
										}
									}elseif($key == 'extra_labels'){
										if(sizeof((array)$val)>0){
											foreach($val as $keyy=>$vall){
												$label_decode_extra_unserial[$keyy]=urlencode($vall);
											}
										}
									}elseif($key == 'front_error_labels'){
										if(sizeof((array)$val)>0){
											foreach($val as $keyy=>$vall){
												$label_decode_front_form_error_unserial[$keyy]=urlencode($vall);
											}
										}
									}
								}
								
								$language_front_arr = base64_encode(serialize($label_decode_front_unserial));
								$language_admin_arr = base64_encode(serialize($label_decode_admin_unserial));
								$language_error_arr = base64_encode(serialize($label_decode_error_unserial));
								$language_extra_arr = base64_encode(serialize($label_decode_extra_unserial));
								$language_form_error_arr = base64_encode(serialize($label_decode_front_form_error_unserial));
								
								$settings->update_languages($language_front_arr,$language_admin_arr,$language_error_arr,$language_extra_arr,$language_form_error_arr,$all[2]);
							}
						}
					}
				}
			}
		}
	}
	if(isset($_POST['action']) && $_POST['action'] == "activate_extension") {
		if($_POST['payment_option'] != ''){
			$ct_payment_extensions = $settings->get_option('ct_payment_extensions');
			$unserialize_ct_payment_extensions = unserialize($ct_payment_extensions);
			$unserialize_payment_option = unserialize($_POST['payment_option']);
			$keySearch = $_POST['extension'];
			$counts = 0;
			foreach ($unserialize_ct_payment_extensions as $key => $item) {
				if ($key == $keySearch) {
				   $counts = $counts + 1;
				}
			}
			if($counts==0){
				$unserialize_ct_payment_extensions[$keySearch] = $unserialize_payment_option[$keySearch];
				$serialize_ct_payment_extensions = serialize($unserialize_ct_payment_extensions);
				$settings->set_option('ct_payment_extensions',$serialize_ct_payment_extensions);
				
				$option_array = unserialize($_POST['payment_add_option']);
				if(sizeof((array)$option_array)>0){
					foreach($option_array as $key=>$val){
						$settings->set_option_check($key,$val);
					}
				}
				if($_POST['payment_add_lable'] != ''){
					$alllang = $settings->get_all_languages();
					while($all = mysqli_fetch_array($alllang))
					{
						$language_label_arr = $settings->get_all_labelsbyid($all[2]);
						
						$label_decode_front = base64_decode($language_label_arr[1]);
						$label_decode_admin = base64_decode($language_label_arr[3]);
						$label_decode_error = base64_decode($language_label_arr[4]);
						$label_decode_extra = base64_decode($language_label_arr[5]);
						$label_decode_front_form_error = base64_decode($language_label_arr[6]);
						
						$label_decode_front_unserial = unserialize($label_decode_front);
						$label_decode_admin_unserial = unserialize($label_decode_admin);
						$label_decode_error_unserial = unserialize($label_decode_error);
						$label_decode_extra_unserial = unserialize($label_decode_extra);
						$label_decode_front_form_error_unserial = unserialize($label_decode_front_form_error);
						
						/* UPDATE ALL CODE WITH NEW URLENCODE PATTERN */
						foreach($label_decode_front_unserial as $key => $value){
							$label_decode_front_unserial[$key] = urldecode($value);
						}
						foreach($label_decode_admin_unserial as $key => $value){
							$label_decode_admin_unserial[$key] = urldecode($value);
						}
						foreach($label_decode_error_unserial as $key => $value){
							$label_decode_error_unserial[$key] = urldecode($value);
						}
						foreach($label_decode_extra_unserial as $key => $value){
							$label_decode_extra_unserial[$key] = urldecode($value);
						}
						
						foreach($label_decode_front_form_error_unserial as $key => $value){
							$label_decode_front_form_error_unserial[$key] = urldecode($value);
						}
						
						$unserialized_payment_add_lable = unserialize($_POST['payment_add_lable']);
						foreach($unserialized_payment_add_lable as $key=>$val){
							if($key == 'label_data'){
								if(sizeof((array)$val)>0){
									foreach($val as $keyy=>$vall){
										$label_decode_front_unserial[$keyy]=urlencode($vall);
									}
								}
							}elseif($key == 'admin_labels'){
								if(sizeof($val)>0){
									foreach($val as $keyy=>$vall){
										$label_decode_admin_unserial[$keyy]=urlencode($vall);
									}
								}
							}elseif($key == 'error_labels'){
								if(sizeof((array)$val)>0){
									foreach($val as $keyy=>$vall){
										$label_decode_error_unserial[$keyy]=urlencode($vall);
									}
								}
							}elseif($key == 'extra_labels'){
								if(sizeof((array)$val)>0){
									foreach($val as $keyy=>$vall){
										$label_decode_extra_unserial[$keyy]=urlencode($vall);
									}
								}
							}elseif($key == 'front_error_labels'){
								if(sizeof((array)$val)>0){
									foreach($val as $keyy=>$vall){
										$label_decode_front_form_error_unserial[$keyy]=urlencode($vall);
									}
								}
							}
						}
						
						$language_front_arr = base64_encode(serialize($label_decode_front_unserial));
						$language_admin_arr = base64_encode(serialize($label_decode_admin_unserial));
						$language_error_arr = base64_encode(serialize($label_decode_error_unserial));
						$language_extra_arr = base64_encode(serialize($label_decode_extra_unserial));
						$language_form_error_arr = base64_encode(serialize($label_decode_front_form_error_unserial));
						
						$settings->update_languages($language_front_arr,$language_admin_arr,$language_error_arr,$language_extra_arr,$language_form_error_arr,$all[2]);
					}
				}
			}
		}
	}
	if(isset($_POST['action']) && $_POST['action'] == "verify_purchase_code") {
		$settings->chk_epc($settings,$conn);
	}
}else{
    echo "Not installed - ZipArchive is required for importing content. Please contact your server administrator and ask them to enable it.";
}
?>