<?php  
include "includes.php";  
if (isset($_POST['action']) && $_POST['action'] == 'get_all_services') {
	verifyRequiredParams(array('api_key'));
	if (isset($_POST['api_key']) && $_POST['api_key'] == $objsettings -> get_option('ct_api_key')) {
		$readall = $objservices -> readall_for_frontend_services();
		$array = array();
		if (mysqli_num_rows($readall) > 0) {
			while ($data = mysqli_fetch_assoc($readall)) {
				foreach($data as $field => $value) {
					if ($data[$field] == '') {
						$data[$field] = null;
					}elseif($field == "image"){
						$image = $data[$field];
						$whole_url = SITE_URL."assets/images/services/".$image;
						$data[$field] = $whole_url;
					}
				}
				array_push($array, $data);
			}
			$valid = ['status' => "true", "statuscode" => 200, 'response' => $array];
			setResponse($valid);
		} else {
			$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values["no_services_found"]];
			setResponse($invalid);
		}
	} else {
		$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values['api_key_mismatch']];
		setResponse($invalid);
	}
}
elseif(isset($_POST['action']) && $_POST['action'] == 'check_postal_code') {
	verifyRequiredParams(array('api_key', 'postal_code'));
	if (isset($_POST['api_key']) && $_POST['api_key'] == $objsettings -> get_option('ct_api_key')) {
		$postal_code_list = $objsettings -> get_option_postal();
		if ($postal_code_list == '') {
			$response = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values["postal_code_not_found"]];
			setResponse($response);
		} else {
			$res = explode(',', strtolower($postal_code_list));
			$check = 1;
			$p_code = strtolower($_POST['postal_code']);
			for ($i = 0; $i <= (count((array)$res) - 1); $i++) {
				if ($res[$i] == $p_code) {
					$j = 10;
					$response = ['status' => "true", "statuscode" => 200, 'response' => $label_language_values["postal_code_found"]];
					setResponse($response);
					break;
				}
				elseif(substr($p_code, 0, strlen($res[$i])) === $res[$i]) {
					$j = 10;
					$response = ['status' => "true", "statuscode" => 200, 'response' => $label_language_values["postal_code_found"]];
					setResponse($response);
					break;
				} else {
					$j = 20;
				}
			}
			if ($j == 20) {
				$response = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values["postal_code_not_found"]];
				setResponse($response);
			}
		}
	} else {
		$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values['api_key_mismatch']];
		setResponse($invalid);
	}
}
elseif(isset($_POST['action']) && $_POST['action'] == 'get_methods_of_selected_service') {
	verifyRequiredParams(array('api_key', 'service_id'));
	if (isset($_POST['api_key']) && $_POST['api_key'] == $objsettings -> get_option('ct_api_key')) {
		$objservice_method -> service_id = $_POST['service_id'];
		$res = $objservice_method -> methodsbyserviceid_front();
		$total_count = mysqli_num_rows($res);
		if ($total_count == 0) {
			$response = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values["no_services_found"]];
			setResponse($response);
		}
		elseif($total_count == 1) {
			$i = 0;
			$array = array();
			$data = mysqli_fetch_assoc($res);
			$data['name'] = "method_".$i;
			array_push($array, $data);
			$response = ['status' => "true", "statuscode" => 200, 'response' => $array];
			setResponse($response);
		} else {
			$i = 0;
			$array = array();
			while ($data = mysqli_fetch_assoc($res)) {
				foreach($data as $field => $value) {
					if ($data[$field] == '') {
						$data[$field] = null;
					}
				}
				$data['name'] = "method_".$i;
				array_push($array, $data);
				$i++;
			}
			$response = ['status' => "true", "statuscode" => 200, 'response' => $array];
			setResponse($response);
		}
	} else {
		$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values['api_key_mismatch']];
		setResponse($invalid);
	}
}
elseif(isset($_POST['action']) && $_POST['action'] == 'get_addons_of_selected_service') {
	verifyRequiredParams(array('api_key', 'service_id'));
	if (isset($_POST['api_key']) && $_POST['api_key'] == $objsettings -> get_option('ct_api_key')) {
		$addons -> service_id = $_POST['service_id'];
		$addons_data = $addons -> readall_from_service();
		if (mysqli_num_rows($addons_data) > 0) {
			$array = array();
			$i = 0;
			while ($data = mysqli_fetch_assoc($addons_data)) {
				foreach($data as $field => $value) {
					if ($data[$field] == '') {
						$data[$field] = null;
					}elseif($field == "image"){						
						$image = $data[$field]; 
						$whole_url = SITE_URL."assets/images/services/".$image;
						$data[$field] = $whole_url;
					}
				}
				$data['checked'] = false;
				$data['name'] = "addon-".$i;
				$i++;
				array_push($array, $data);
			}
			$response = ['status' => "true", "statuscode" => 200, 'response' => $array];
			setResponse($response);
		} else {
			$response = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values["extra_services_not_available"]];
			setResponse($response);
		}
	} else {
		$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values['api_key_mismatch']];
		setResponse($invalid);
	}
}
elseif(isset($_POST['action']) && $_POST['action'] == 'get_units_of_selected_method') {
	verifyRequiredParams(array('api_key', 'service_id', 'method_id'));
	if (isset($_POST['api_key']) && $_POST['api_key'] == $objsettings -> get_option('ct_api_key')) {
		$calculation_policy = $objsettings -> get_option("ct_calculation_policy");
		$objservice_method_unit -> services_id = $_POST['service_id'];
		$objservice_method_unit -> methods_id = $_POST['method_id'];
		$unt_values = $objservice_method_unit -> getunits_by_service_methods_setdesign();
		if (mysqli_num_rows($unt_values) > 0) {
			$ind = 0;
			$array = array();
			while ($unit_value = mysqli_fetch_assoc($unt_values)) {
				$fe = 0;
				$fg = 0;
				$strate = 1;
				$hfsec = 0;
				if ($unit_value['half_section'] == "E") {
					$hfsec = 0.5;
				} else {
					$hfsec = 1;
				}
				$rate_and_qty_arr = array();
				for ($i = $hfsec; $i <= $unit_value['maxlimit']; $i += $hfsec) {
					$objservice_method_unit -> maxlimit = $i;
					$objservice_method_unit -> units_id = $unit_value['id'];
					$unt_ratess = $objservice_method_unit -> get_rate_by_service_methods_ids();
					if ($unt_ratess['rules'] == 'G') {
						$strate = $unt_ratess['rates'];
						$fg = 1;
						$fe = 0;
					}
					$qty = $i;
					if ($fg == 1) {
						if ($unt_ratess['rules'] == 'E') {
							$rate = ($calculation_policy == "M") ? $unt_ratess['rates'] * $i : $unt_ratess['rates'];
						} else {
							$rate = ($calculation_policy == "M") ? $strate * $i : $strate;
						}
					} elseif ($unt_ratess['rules'] == 'E') {
						$rate = ($calculation_policy == "M") ? $unt_ratess['rates'] * $i : $unt_ratess['rates'];
					} else {
						if ($calculation_policy == "M") {
							$base_rates = $unit_value['base_price'] * $i;
						} else {
							$base_rates = $unit_value['base_price'];
						}
						$rate = $base_rates;
					}
					$arr = array();
					$arr['qty'] = $qty;
					$arr['rate'] = $rate;
					array_push($rate_and_qty_arr, $arr);
				}
				foreach($unit_value as $field => $value) {
					if ($unit_value[$field] == '') {
						$unit_value[$field] = null;
					}
				}
				$unit_value['name'] = "unit".$ind;
				$unit_value['rate_and_qty'] = $rate_and_qty_arr;
				array_push($array, $unit_value);
				$ind++;
			}
			$response = ['status' => "true",'no_of_dropdown' => $ind, "statuscode" => 200, 'response' => $array];
			setResponse($response);
		} else {
			$response = ['status' => "false",'no_of_dropdown' => 0, "statuscode" => 404, 'response' => $label_language_values["no_units_available"]];
			setResponse($response);
		}
	} else {
		$invalid = ['status' => "false", 'no_of_dropdown' => 0, "statuscode" => 404, 'response' => $label_language_values['api_key_mismatch']];
		setResponse($invalid);
	}
}
elseif(isset($_POST['action']) && $_POST['action'] == 'get_all_frequently_discount') {
	verifyRequiredParams(array('api_key'));
	if (isset($_POST['api_key']) && $_POST['api_key'] == $objsettings -> get_option('ct_api_key')) {
		$readall = $frequently_discount -> readall_front();
		$array = array();
		if (mysqli_num_rows($readall) > 0) {
			while ($data = mysqli_fetch_assoc($readall)) {
				foreach($data as $field => $value) {
					if ($data[$field] == '') {
						$data[$field] = null;
					}
				}
				array_push($array, $data);
			}
			$valid = ['status' => "true", "statuscode" => 200, 'response' => $array];
			setResponse($valid);
		} else {
			$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values["no_frequently_discount_found"]];
			setResponse($invalid);
		}
	} else {
		$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values['api_key_mismatch']];
		setResponse($invalid);
	}
}
elseif(isset($_POST['action']) && $_POST['action'] == 'check_login') {
	verifyRequiredParams(array('api_key', 'email', 'password'));
	if (isset($_POST['api_key']) && $_POST['api_key'] == $objsettings -> get_option('ct_api_key')) {
		$user -> existing_username = trim(strip_tags(mysqli_real_escape_string($conn, $_POST['email'])));
		$user -> existing_password = md5($_POST['password']);
		$existing_login = $user -> check_login_process();
		$array = array();
		if (mysqli_num_rows($existing_login) == 0) {
			$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values["incorrect_email_address_or_password"]];
			setResponse($invalid);
		} else {
			$data = mysqli_fetch_assoc($existing_login);
			if (isset($data['usertype'])) {
				$res = unserialize($data['usertype']);
				$data['usertype'] = $res[0];
				$data['fullname'] = $data['first_name']." ".$data['last_name'];
			}
			if (isset($data['role'])) {
				$data['usertype'] = $data['role'];
				$data['user_email'] = $data['email'];
			}
			$valid = ['status' => "true", "statuscode" => 200, 'response' => $data];
			setResponse($valid);
		}
	} else {
		$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values['api_key_mismatch']];
		setResponse($invalid);
	}
}
elseif(isset($_POST['action']) && $_POST['action'] == 'get_user_appointments_list') {
	verifyRequiredParams(array('api_key', 'user_id', 'user_type'));
	if (isset($_POST['api_key']) && $_POST['api_key'] == $objsettings -> get_option('ct_api_key')) {
		if ($_POST['user_type'] == "client") {
			$limit = 5;
			$page = $_POST['page'];
			$offset = $limit * $page;
			$objuserdetails -> id = $_POST['user_id'];
			$objuserdetails -> limit = $limit;
			$objuserdetails -> offset = $offset;
			$details = $objuserdetails -> get_user_details_api();
			$array = array();
			if (mysqli_num_rows($details) == 0) {
				$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values["no_appointments_found"]];
				setResponse($invalid);
			} else {
				while ($data = mysqli_fetch_assoc($details)) {
					if ($data['staff_ids'] != '') {
						$staff_names = '';
						$exploded_staff_ids = explode(',', $data['staff_ids']);
						$i = 1;
						foreach($exploded_staff_ids as $id) {
							$objadmin -> id = $id;
							$staffdata = $objadmin -> readone();
							if ($i = 1) {
								$staff_names.= $staffdata['fullname'];
							} else {
								$staff_names.= ', '.$staffdata['fullname'];
							}
							$i++;
						}
						$data['staff_names'] = $staff_names;
					}
					foreach($data as $field => $value) {
						if ($data[$field] == '') {
							$data[$field] = null;
						}
					}
					$units = null;
					$methodname = null;
					$hh = $booking -> get_methods_ofbookings($data['order_id']);
					$count_methods = mysqli_num_rows($hh);
					$hh1 = $booking -> get_methods_ofbookings($data['order_id']);
					if ($count_methods > 0) {
						while ($jj = mysqli_fetch_array($hh1)) {
							if ($units == null) {
								$units = $jj['units_title']."-".$jj['qtys'];
							} else {
								$units = $units. ",".$jj['units_title']."-".$jj['qtys'];
							}
							$methodname = $jj['method_title'];
						}
					}
					$addons = null;
					$hh = $booking -> get_addons_ofbookings($data['order_id']);
					while ($jj = mysqli_fetch_array($hh)) {
						if ($addons == null) {
							$addons = $jj['addon_service_name']."-".$jj['addons_service_qty'];
						} else {
							$addons = $addons.",".$jj['addon_service_name']."-".$jj['addons_service_qty'];
						}
					}
					$data['method_name'] = $methodname;
					$data['units'] = $units;
					$data['addons'] = $addons;
					$booking_date_timestamp = strtotime($data['booking_date_time']);
					$data['appointment_date'] = str_replace($english_date_array,$selected_lang_label,date('l, d-M-Y', $booking_date_timestamp));
					$data['appointment_time'] = str_replace($english_date_array,$selected_lang_label,date('h:i A', $booking_date_timestamp));
					array_push($array, $data);
				}
				$valid = ['status' => "true", "statuscode" => 200, 'response' => $array];
				setResponse($valid);
			}
		}
		elseif($_POST['user_type'] == "staff") {
			$objuserdetails -> id = $_POST['user_id'];
			$details = $objuserdetails -> get_staff_details_api();
			$array = array();
			if (mysqli_num_rows($details) == 0) {
				$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values["no_appointments_found"]];
				setResponse($invalid);
			} else {
				while ($data = mysqli_fetch_assoc($details)) {
					if ($data['staff_ids'] != '') {
						$staff_names = '';
						$exploded_staff_ids = explode(',', $data['staff_ids']);
						$i = 1;
						foreach($exploded_staff_ids as $id) {
							$objadmin -> id = $id;
							$staffdata = $objadmin -> readone();
							if ($i = 1) {
								$staff_names.= $staffdata['fullname'];
							} else {
								$staff_names.= ', '.$staffdata['fullname'];
							}
							$i++;
						}
						$data['staff_names'] = $staff_names;
					}
					foreach($data as $field => $value) {
						if ($data[$field] == '') {
							$data[$field] = null;
						}
					}
					$units = null;
					$methodname = null;
					$hh = $booking -> get_methods_ofbookings($data['order_id']);
					$count_methods = mysqli_num_rows($hh);
					$hh1 = $booking -> get_methods_ofbookings($data['order_id']);
					if ($count_methods > 0) {
						while ($jj = mysqli_fetch_array($hh1)) {
							if ($units == null) {
								$units = $jj['units_title']."-".$jj['qtys'];
							} else {
								$units = $units.",".$jj['units_title']."-".$jj['qtys'];
							}
							$methodname = $jj['method_title'];
						}
					}
					$addons = null;
					$hh = $booking -> get_addons_ofbookings($data['order_id']);
					while ($jj = mysqli_fetch_array($hh)) {
						if ($addons == null) {
							$addons = $jj['addon_service_name']."-".$jj['addons_service_qty'];
						} else {
							$addons = $addons.",".$jj['addon_service_name']."-".$jj['addons_service_qty'];
						}
					}
					$data['method_name'] = $methodname;
					$data['units'] = $units;
					$data['addons'] = $addons;
					$booking_date_timestamp = strtotime($data['booking_date_time']);
					$data['appointment_date'] = str_replace($english_date_array,$selected_lang_label,date('l, d-M-Y', $booking_date_timestamp));
					$data['appointment_time'] = str_replace($english_date_array,$selected_lang_label,date('h:i A', $booking_date_timestamp));
					array_push($array, $data);
				}
				$valid = ['status' => "true", "statuscode" => 200, 'response' => $array];
				setResponse($valid);
			}
		}
	} else {
		$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values['api_key_mismatch']];
		setResponse($invalid);
	}
}
elseif(isset($_POST['action']) && $_POST['action'] == 'get_appointment_detail') {
	verifyRequiredParams(array('api_key', 'order_id'));
	if (isset($_POST['api_key']) && $_POST['api_key'] == $objsettings -> get_option('ct_api_key')) {
		$appointment_detail = array();
		$order_id = $_POST['order_id'];
		$book_detail = $booking -> get_booking_details_appt_api($order_id);
		$appointment_detail['id'] = $order_id;
		$appointment_detail['booking_price'] = $book_detail[2];
		$appointment_detail['start_date'] = date('d-m-Y', strtotime($book_detail[1]));
		$appointment_detail['start_time'] = date("H:i", strtotime($book_detail[1]));
		$appointment_detail['booking_date_time'] = $book_detail[1];
		$units = '';
		$methodname = '';
		$hh = $booking -> get_methods_ofbookings($order_id);
		$count_methods = mysqli_num_rows($hh);
		$hh1 = $booking -> get_methods_ofbookings($order_id);
		if ($count_methods > 0) {
			while ($jj = mysqli_fetch_array($hh1)) {
				if ($units == '') {
					$units = $jj['units_title']."-".$jj['qtys'];
				} else {
					$units = $units.",".$jj['units_title']."-".$jj['qtys'];
				}
				$methodname = $jj['method_title'];
			}
		}
		$addons = '';
		$hh = $booking -> get_addons_ofbookings($order_id);
		while ($jj = mysqli_fetch_array($hh)) {
			if ($addons == '') {
				$addons = $jj['addon_service_name']."-".$jj['addons_service_qty'];
			} else {
				$addons = $addons.",".$jj['addon_service_name']."-".$jj['addons_service_qty'];
			}
		}
		$appointment_detail['method_title'] = $methodname;
		$appointment_detail['unit_title'] = $units;
		$appointment_detail['addons_title'] = $addons;
		$appointment_detail['service_title'] = $book_detail[8];
		$appointment_detail['gc_event_id'] = $book_detail[9];
		$appointment_detail['gc_staff_event_id'] = $book_detail['gc_staff_event_id'];
		$staff_names = '';
		if ($book_detail['staff_ids'] != '') {
			$exploded_staff_ids = explode(',', $book_detail['staff_ids']);
			$i = 1;
			foreach($exploded_staff_ids as $id) {
				$objadmin -> id = $id;
				$staffdata = $objadmin -> readone();
				if ($i = 1) {
					$staff_names.= $staffdata['fullname'];
				} else {
					$staff_names.= ', '.$staffdata['fullname'];
				}
				$i++;
			}
		}
		$appointment_detail['staff_names'] = $staff_names;
		$appointment_detail['staff_ids'] = $book_detail['staff_ids'];
		$ccnames = explode(" ", $book_detail[3]);
		$cnamess = array_filter($ccnames);
		$client_name = array_values($cnamess);
		if (sizeof((array)$client_name) > 0) {
			if ($client_name[0] != "") {
				$client_first_name = $client_name[0];
			} else {
				$client_first_name = "";
			}
			if (isset($client_name[1]) && $client_name[1] != "") {
				$client_last_name = $client_name[1];
			} else {
				$client_last_name = "";
			}
		} else {
			$client_first_name = "";
			$client_last_name = "";
		}
		if ($client_first_name != "" || $client_last_name != "") {
			$appointment_detail['client_name'] = $client_first_name." ".$client_last_name;
		} else {
			$appointment_detail['client_name'] = "";
		}
		$fetch_phone = strlen($book_detail[7]);
		if ($fetch_phone >= 6) {
			$appointment_detail['client_phone'] = $book_detail[7];
		} else {
			$appointment_detail['client_phone'] = "";
		}
		$appointment_detail['client_email'] = $book_detail[4];
		$temppp = unserialize(base64_decode($book_detail[5]));
		$tem = str_replace('\\', '', $temppp);
		if ($tem['notes'] != "") {
			$finalnotes = $tem['notes'];
		} else {
			$finalnotes = "";
		}
		$vc_status = $tem['vc_status'];
		if ($vc_status == 'N') {
			$final_vc_status = 'no';
		}
		elseif($vc_status == 'Y') {
			$final_vc_status = 'yes';
		} else {
			$final_vc_status = "-";
		}
		$p_status = $tem['p_status'];
		if ($p_status == 'N') {
			$final_p_status = 'no';
		}
		elseif($p_status == 'Y') {
			$final_p_status = 'yes';
		} else {
			$final_p_status = "-";
		}
		if ($tem['address'] != "" || $tem['city'] != "" || $tem['zip'] != "" || $tem['state'] != "") {
			$app_address = "";
			$app_city = "";
			$app_zip = "";
			$app_state = "";
			if ($tem['address'] != "") {
				$app_address = $tem['address'].", ";
			}
			if ($tem['city'] != "") {
				$app_city = $tem['city'].", ";
			}
			if ($tem['zip'] != "") {
				$app_zip = $tem['zip'].", ";
			}
			if ($tem['state'] != "") {
				$app_state = $tem['state'];
			}
			$temper = $app_address.$app_city.$app_zip.$app_state;
			$temss = rtrim($temper, ", ");
			$appointment_detail['client_address'] = $temss;
		} else {
			$appointment_detail['client_address'] = "";
		}
		$appointment_detail['vaccum_cleaner'] = $final_vc_status;
		$appointment_detail['parking'] = $final_p_status;
		$appointment_detail['client_notes'] = $finalnotes;
		$appointment_detail['contact_status'] = $tem['contact_status'];
		$appointment_detail['global_vc_status'] = $global_vc_status;
		$appointment_detail['global_p_status'] = $global_p_status;
		$appointment_detail['payment_type'] = $book_detail[6];
		$appointment_detail['booking_status'] = $book_detail[0];
		$booking_day = date("Y-m-d", strtotime($book_detail[1]));
		$current_day = date("Y-m-d");
		if ($current_day > $booking_day) {
			$appointment_detail['past'] = 'yes';
		} else {
			$appointment_detail['past'] = 'no';
		}
		$get_staff_services = $objadmin -> readall_staff_booking();
		$booking -> order_id = $order_id;
		$get_staff_assignid = explode(",", $booking -> fetch_staff_of_booking());
		$array = array();
		foreach($appointment_detail as $field => $value) {
			if ($appointment_detail[$field] == '') {
				$appointment_detail[$field] = null;
			}
		}
		array_push($array, $appointment_detail);
		$valid = ['status' => "true", "statuscode" => 200, 'response' => $array];
		setResponse($valid);
	} else {
		$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values['api_key_mismatch']];
		setResponse($invalid);
	}
}
elseif(isset($_POST['action']) && $_POST['action'] == 'reschedule_appointment') {
	verifyRequiredParams(array('api_key', 'order_id', 'notes', 'date', 'time'));
	if (isset($_POST['api_key']) && $_POST['api_key'] == $objsettings -> get_option('ct_api_key')) {
		$id = $order = $_POST['order_id'];
		$notes = $_POST['notes'];
		$dates = $_POST['date'];
		$timess = $_POST['time'];
		$booking_status = "RS";
		$read_status = "U";
		$lastmodify = date('Y-m-d H:i:s');
		$datetime_withmaxtime = "";
		if ($getmaximumbooking != "") {
			$datetime_withmaxtime = strtotime('+'.$getmaximumbooking.' month', strtotime(date('Y-m-d')));
		}
		if (strtotime($dates) <= $datetime_withmaxtime || $datetime_withmaxtime == "") {
			$dat = $dates." ".$timess;
			$finaldate = date("Y-m-d H:i:s", strtotime($dat));
			$objuserdetails -> reschedule_booking($finaldate, $order, $booking_status, $read_status, $lastmodify);
			$serializedData = $objuserdetails -> get_user_notes($order);
			$data = unserialize(base64_decode($serializedData[0]));
			if (array_key_exists('notes', $data)) {
				$data['notes'] = $notes;
			}
			$serializedData = base64_encode(serialize($data));
			$objuserdetails -> update_notes($order, $serializedData); /* code for email and sms */
			$orderdetail = $objdashboard -> getclientorder_api($id);
			$clientdetail = $objdashboard -> clientemailsender($id);
			$admin_company_name = $objsettings -> get_option('ct_company_name');
			$setting_date_format = $objsettings -> get_option('ct_date_picker_date_format');
			$setting_time_format = $objsettings -> get_option('ct_choose_time_format');
			$booking_date = str_replace($english_date_array,$selected_lang_label,date($setting_date_format, strtotime($clientdetail['booking_date_time'])));
			if ($setting_time_format == 12) {
				$booking_time = str_replace($english_date_array,$selected_lang_label,date("h:i A", strtotime($clientdetail['booking_date_time'])));
			} else {
				$booking_time = date("H:i", strtotime($clientdetail['booking_date_time']));
			}
			$company_name = $objsettings -> get_option('ct_email_sender_name');
			$company_email = $objsettings -> get_option('ct_email_sender_address');
			$service_name = $clientdetail['title'];
			if ($admin_email == "") {
				$admin_email = $clientdetail['email'];
			}
			$price = $general -> ct_price_format($orderdetail[2], $symbol_position, $decimal); /* methods */
			$units = $label_language_values['none'];
			$methodname = $label_language_values['none'];
			$hh = $booking -> get_methods_ofbookings($orderdetail[4]);
			$count_methods = mysqli_num_rows($hh);
			$hh1 = $booking -> get_methods_ofbookings($orderdetail[4]);
			if ($count_methods > 0) {
				while ($jj = mysqli_fetch_array($hh1)) {
					if ($units == $label_language_values['none']) {
						$units = $jj['units_title']."-".$jj['qtys'];
					} else {
						$units = $units.",".$jj['units_title']."-".$jj['qtys'];
					}
					$methodname = $jj['method_title'];
				}
			} /* Add ons */
			$addons = $label_language_values['none'];
			$hh = $booking -> get_addons_ofbookings($orderdetail[4]);
			while ($jj = mysqli_fetch_array($hh)) {
				if ($addons == $label_language_values['none']) {
					$addons = $jj['addon_service_name']."-".$jj['addons_service_qty'];
				} else {
					$addons = $addons.",".$jj['addon_service_name']."-".$jj['addons_service_qty'];
				}
			} /* Guest user */
			if ($orderdetail[4] == 0) {
				$gc = $objdashboard -> getguestclient($orderdetail[4]);
				$temppp = unserialize(base64_decode($gc[5]));
				$temp = str_replace('\\', '', $temppp);
				$vc_status = $temp['vc_status'];
				if ($vc_status == 'N') {
					$final_vc_status = $label_language_values['no'];
				}
				elseif($vc_status == 'Y') {
					$final_vc_status = $label_language_values['yes'];
				} else {
					$final_vc_status = "N/A";
				}
				$p_status = $temp['p_status'];
				if ($p_status == 'N') {
					$final_p_status = $label_language_values['no'];
				}
				elseif($p_status == 'Y') {
					$final_p_status = $label_language_values['yes'];
				} else {
					$final_p_status = "N/A";
				}
				$client_name = $gc[2];
				$client_email = $gc[3];
				$client_phone = $gc[4];
				$firstname = $client_name;
				$lastname = '';
				$booking_status = $orderdetail[6];
				$final_vc_status;
				$final_p_status;
				$payment_status = $orderdetail[5];
				$client_address = $temp['address'];
				$client_notes = $temp['notes'];
				$client_status = $temp['contact_status'];
				$client_city = $temp['city'];
				$client_state = $temp['state'];
				$client_zip = $temp['zip'];
			} else /*Registered user */ {
				$c = $objdashboard -> getguestclient($orderdetail[4]);
				$temppp = unserialize(base64_decode($c[5]));
				$temp = str_replace('\\', '', $temppp);
				$vc_status = $temp['vc_status'];
				if ($vc_status == 'N') {
					$final_vc_status = $label_language_values['no'];
				}
				elseif($vc_status == 'Y') {
					$final_vc_status = $label_language_values['yes'];
				} else {
					$final_vc_status = "N/A";
				}
				$p_status = $temp['p_status'];
				if ($p_status == 'N') {
					$final_p_status = $label_language_values['no'];
				}
				elseif($p_status == 'Y') {
					$final_p_status = $label_language_values['yes'];
				} else {
					$final_p_status = "N/A";
				}
				$client_phone_no = $c[4];
				$client_phone_length = strlen($client_phone_no);
				if ($client_phone_length > 6) {
					$client_phone = $client_phone_no;
				} else {
					$client_phone = "N/A";
				}
				$client_namess = explode(" ", $c[2]);
				$cnamess = array_filter($client_namess);
				$ccnames = array_values($cnamess);
				if (sizeof((array)$ccnames) > 0) {
					$client_first_name = $ccnames[0];
					if (isset($ccnames[1])) {
						$client_last_name = $ccnames[1];
					} else {
						$client_last_name = '';
					}
				} else {
					$client_first_name = '';
					$client_last_name = '';
				}
				if ($client_first_name == "" && $client_last_name == "") {
					$firstname = "User";
					$lastname = "";
					$client_name = $firstname.' '.$lastname;
				}
				elseif($client_first_name != "" && $client_last_name != "") {
					$firstname = $client_first_name;
					$lastname = $client_last_name;
					$client_name = $firstname.' '.$lastname;
				}
				elseif($client_first_name != "") {
					$firstname = $client_first_name;
					$lastname = "";
					$client_name = $firstname.' '.$lastname;
				}
				elseif($client_last_name != "") {
					$firstname = "";
					$lastname = $client_last_name;
					$client_name = $firstname.' '.$lastname;
				}
				$client_notes = $temp['notes'];
				if ($client_notes == "") {
					$client_notes = "N/A";
				}
				$client_status = $temp['contact_status'];
				if ($client_status == "") {
					$client_status = "N/A";
				}
				$client_email = $c[3];
				$payment_status = $orderdetail[5];
				$final_vc_status;
				$final_p_status;
				$client_address = $temp['address'];
				$client_city = $temp['city'];
				$client_state = $temp['state'];
				$client_zip = $temp['zip'];
			}
			$searcharray = array('{{service_name}}', '{{booking_date}}', '{{business_logo}}', '{{business_logo_alt}}', '{{client_name}}', '{{methodname}}', '{{units}}', '{{addons}}', '{{client_email}}', '{{phone}}', '{{payment_method}}', '{{vaccum_cleaner_status}}', '{{parking_status}}', '{{notes}}', '{{contact_status}}', '{{address}}', '{{price}}', '{{admin_name}}', '{{firstname}}', '{{lastname}}', '{{app_remain_time}}', '{{reject_status}}', '{{company_name}}', '{{booking_time}}', '{{client_city}}', '{{client_state}}', '{{client_zip}}', '{{company_city}}', '{{company_state}}', '{{company_zip}}', '{{company_country}}', '{{company_phone}}', '{{company_email}}', '{{company_address}}', '{{admin_name}}');
			$replacearray = array($service_name, $booking_date, $business_logo, $business_logo_alt, $client_name, $methodname, $units, $addons, $client_email, $client_phone, $payment_status, $final_vc_status, $final_p_status, $client_notes, $client_status, $client_address, $price, $get_admin_name, $firstname, $lastname, '', '', $admin_company_name, $booking_time, $client_city, $client_state, $client_zip, $company_city, $company_state, $company_zip, $company_country, $company_phone, $company_email, $company_address, $get_admin_name);
			if ($gc_hook -> gc_purchase_status() == 'exist') {
				if ($_POST['gc_event_id'] != 'none' && $_POST['gc_staff_event_id'] != 'none' && $_POST['pid'] != 'none') {
					if ($objsettings -> get_option('ct_gc_status_configure') == 'Y' && $objsettings -> get_option('ct_gc_status') == 'Y') {
						echo $gc_hook -> gc_reschedule_booking_ajax_hook();
					}
				}
			} /* Client Email Template */
			$emailtemplate -> email_subject = "Appointment Rescheduled by you";
			$emailtemplate -> user_type = "C";
			$clientemailtemplate = $emailtemplate -> readone_client_email_template_body();
			if ($clientemailtemplate[2] != '') {
				$clienttemplate = base64_decode($clientemailtemplate[2]);
			} else {
				$clienttemplate = base64_decode($clientemailtemplate[3]);
			}
			$subject = $clientemailtemplate[1];
			if ($objsettings -> get_option('ct_client_email_notification_status') == 'Y' && $clientemailtemplate[4] == 'E') {
				$client_email_body = str_replace($searcharray, $replacearray, $clienttemplate);
				if ($objsettings -> get_option('ct_smtp_hostname') != '' && $objsettings -> get_option('ct_email_sender_name') != '' && $objsettings -> get_option('ct_email_sender_address') != '' && $objsettings -> get_option('ct_smtp_username') != '' && $objsettings -> get_option('ct_smtp_password') != '' && $objsettings -> get_option('ct_smtp_port') != '') {
					$mail -> IsSMTP();
				} else {
					$mail -> IsMail();
				}
				$mail -> SMTPDebug = 0;
				$mail -> IsHTML(true);
				$mail -> From = $company_email;
				$mail -> FromName = $company_name;
				$mail -> Sender = $company_email;
				$mail -> AddAddress($client_email, $client_name);
				$mail -> Subject = $subject;
				$mail -> Body = $client_email_body;
				$mail -> send();
				$mail -> ClearAllRecipients();
			} /* Admin Email Template */
			$emailtemplate -> email_subject = "Appointment Rescheduled By Customer";
			$emailtemplate -> user_type = "A";
			$adminemailtemplate = $emailtemplate -> readone_client_email_template_body();
			if ($adminemailtemplate[2] != '') {
				$admintemplate = base64_decode($adminemailtemplate[2]);
			} else {
				$admintemplate = base64_decode($adminemailtemplate[3]);
			}
			$adminsubject = $adminemailtemplate[1];
			if ($objsettings -> get_option('ct_admin_email_notification_status') == 'Y' && $adminemailtemplate[4] == 'E') {
				$admin_email_body = str_replace($searcharray, $replacearray, $admintemplate);
				if ($objsettings -> get_option('ct_smtp_hostname') != '' && $objsettings -> get_option('ct_email_sender_name') != '' && $objsettings -> get_option('ct_email_sender_address') != '' && $objsettings -> get_option('ct_smtp_username') != '' && $objsettings -> get_option('ct_smtp_password') != '' && $objsettings -> get_option('ct_smtp_port') != '') {
					$mail_a -> IsSMTP();
				} else {
					$mail_a -> IsMail();
				}
				$mail_a -> SMTPDebug = 0;
				$mail_a -> IsHTML(true);
				$mail_a -> From = $company_email;
				$mail_a -> FromName = $company_name;
				$mail_a -> Sender = $company_email;
				$mail_a -> AddAddress($admin_email, $get_admin_name);
				$mail_a -> Subject = $adminsubject;
				$mail_a -> Body = $admin_email_body;
				$mail_a -> send();
				$mail_a -> ClearAllRecipients();
			} /*SMS SENDING CODE*/ /*GET APPROVED SMS TEMPLATE*/ /* TEXTLOCAL CODE */
			if ($objsettings -> get_option('ct_sms_textlocal_status') == "Y") {
				if ($objsettings -> get_option('ct_sms_textlocal_send_sms_to_client_status') == "Y") {
					$template = $objdashboard -> gettemplate_sms("RS", 'C');
					$phone = $client_phone;
					if ($template[4] == "E") {
						if ($template[2] == "") {
							$message = base64_decode($template[3]);
						} else {
							$message = bas64_decode($template[2]);
						}
					}
					$message = str_replace($searcharray, $replacearray, $message);
					$data = "username=".$textlocal_username."&hash=".$textlocal_hash_id."&message=".$message."&numbers=".$phone."&test=0";
					$ch = curl_init('http://api.textlocal.in/send/?');
					curl_setopt($ch, CURLOPT_POST, true);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					$result = curl_exec($ch);
					curl_close($ch);
				}
				if ($objsettings -> get_option('ct_sms_textlocal_send_sms_to_admin_status') == "Y") {
					$template = $objdashboard -> gettemplate_sms("RS", 'A');
					$phone = $objsettings -> get_option('ct_sms_textlocal_admin_phone');
					if ($template[4] == "E") {
						if ($template[2] == "") {
							$message = base64_decode($template[3]);
						} else {
							$message = base64_decode($template[2]);
						}
					}
					$message = str_replace($searcharray, $replacearray, $message);
					$data = "username=".$textlocal_username."&hash=".$textlocal_hash_id."&message=".$message."&numbers=".$phone."&test=0";
					$ch = curl_init('http://api.textlocal.in/send/?');
					curl_setopt($ch, CURLOPT_POST, true);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					$result = curl_exec($ch);
					curl_close($ch);
				}
			} /*PLIVO CODE*/
			if ($objsettings -> get_option('ct_sms_plivo_status') == "Y") {
				if ($objsettings -> get_option('ct_sms_plivo_send_sms_to_client_status') == "Y") {
					$auth_id = $objsettings -> get_option('ct_sms_plivo_account_SID');
					$auth_token = $objsettings -> get_option('ct_sms_plivo_auth_token');
					$p_client = new Plivo\ RestAPI($auth_id, $auth_token, '', '');
					$template = $objdashboard -> gettemplate_sms("RS", 'C');
					$phone = $client_phone;
					if ($template[4] == "E") {
						if ($template[2] == "") {
							$message = base64_decode($template[3]);
						} else {
							$message = base64_decode($template[2]);
						}
						$client_sms_body = str_replace($searcharray, $replacearray, $message); /* MESSAGE SENDING CODE THROUGH PLIVO */
						$params = array('src' => $objsettings -> get_option('ct_sms_plivo_sender_number'), 'dst' => $phone, 'text' => $client_sms_body, 'method' => 'POST');
						$response = $p_client -> send_message($params); /* MESSAGE SENDING CODE ENDED HERE*/
					}
				}
				if ($objsettings -> get_option('ct_sms_plivo_send_sms_to_admin_status') == "Y") {
					$auth_id = $objsettings -> get_option('ct_sms_plivo_account_SID');
					$auth_token = $objsettings -> get_option('ct_sms_plivo_auth_token');
					$p_admin = new Plivo\ RestAPI($auth_id, $auth_token, '', '');
					$template = $objdashboard -> gettemplate_sms("RS", 'A');
					$phone = $admin_phone_plivo;
					if ($template[4] == "E") {
						if ($template[2] == "") {
							$message = base64_decode($template[3]);
						} else {
							$message = base64_decode($template[2]);
						}
						$client_sms_body = str_replace($searcharray, $replacearray, $message);
						$params = array('src' => $objsettings -> get_option('ct_sms_plivo_sender_number'), 'dst' => $phone, 'text' => $client_sms_body, 'method' => 'POST');
						$response = $p_admin -> send_message($params); /* MESSAGE SENDING CODE ENDED HERE*/
					}
				}
			}
			if ($objsettings -> get_option('ct_sms_twilio_status') == "Y") {
				if ($objsettings -> get_option('ct_sms_twilio_send_sms_to_client_status') == "Y") {
					$AccountSid = $objsettings -> get_option('ct_sms_twilio_account_SID');
					$AuthToken = $objsettings -> get_option('ct_sms_twilio_auth_token');
					$twilliosms_client = new Services_Twilio($AccountSid, $AuthToken);
					$template = $objdashboard -> gettemplate_sms("RS", 'C');
					$phone = $client_phone;
					if ($template[4] == "E") {
						if ($template[2] == "") {
							$message = base64_decode($template[3]);
						} else {
							$message = base64_decode($template[2]);
						}
						$client_sms_body = str_replace($searcharray, $replacearray, $message); /*TWILIO CODE*/
						$message = $twilliosms_client -> account -> messages -> create(array("From" => $company_phone, "To" => $phone, "Body" => $client_sms_body));
					}
				}
				if ($objsettings -> get_option('ct_sms_twilio_send_sms_to_admin_status') == "Y") {
					$AccountSid = $objsettings -> get_option('ct_sms_twilio_account_SID');
					$AuthToken = $objsettings -> get_option('ct_sms_twilio_auth_token');
					$twilliosms_admin = new Services_Twilio($AccountSid, $AuthToken);
					$template = $objdashboard -> gettemplate_sms("RS", 'A');
					$phone = $admin_phone_twilio;
					if ($template[4] == "E") {
						if ($template[2] == "") {
							$message = base64_decode($template[3]);
						} else {
							$message = base64_decode($template[2]);
						}
						$client_sms_body = str_replace($searcharray, $replacearray, $message); /*TWILIO CODE*/
						$message = $twilliosms_admin -> account -> messages -> create(array("From" => $company_phone, "To" => $phone, "Body" => $client_sms_body));
					}
				}
			}
			if ($objsettings -> get_option('ct_nexmo_status') == "Y") {
				if ($objsettings -> get_option('ct_sms_nexmo_send_sms_to_client_status') == "Y") {
					$template = $objdashboard -> gettemplate_sms("RS", 'C');
					$phone = $client_phone;
					if ($template[4] == "E") {
						if ($template[2] == "") {
							$message = base64_decode($template[3]);
						} else {
							$message = base64_decode($template[2]);
						}
						$ct_nexmo_text = str_replace($searcharray, $replacearray, $message);
						$res = $nexmo_client -> send_nexmo_sms($phone, $ct_nexmo_text);
					}
				}
				if ($objsettings -> get_option('ct_sms_nexmo_send_sms_to_admin_status') == "Y") {
					$template = $objdashboard -> gettemplate_sms("RS", 'A');
					$phone = $objsettings -> get_option('ct_sms_nexmo_admin_phone_number');
					if ($template[4] == "E") {
						if ($template[2] == "") {
							$message = base64_decode($template[3]);
						} else {
							$message = base64_decode($template[2]);
						}
						$ct_nexmo_text = str_replace($searcharray, $replacearray, $message);
						$res = $nexmo_admin -> send_nexmo_sms($phone, $ct_nexmo_text);
					}
				}
			} /*SMS SENDING CODE END*/ /* code for email and sms */
			$valid = ['status' => "true", "statuscode" => 200, 'response' => $label_language_values["your_appointment_rescheduled_successfully"]];
			setResponse($valid);
		} else {
				$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values["sorry_we_are_not_available"]];
				setResponse($invalid);
		}
	} else {
		$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values['api_key_mismatch']];
		setResponse($invalid);
	}
}
elseif(isset($_POST['action']) && $_POST['action'] == 'cancel_appointment') {
	verifyRequiredParams(array('api_key', 'order_id', 'cancel_reason'));
	if (isset($_POST['api_key']) && $_POST['api_key'] == $objsettings -> get_option('ct_api_key')) {
		$id = $order = $_POST['order_id'];
		$gc_event_id = $_POST['gc_event_id'];
		$gc_staff_event_id = $_POST['gc_staff_event_id'];
		$pid = $_POST['pid'];
		$lastmodify = date('Y-m-d H:i:s');
		$cancel_reson_book = $_POST['cancel_reason'];
		$objuserdetails -> update_booking_of_user($order, $cancel_reson_book, $lastmodify);
		$orderdetail = $objdashboard -> getclientorder_api($id);
		$clientdetail = $objdashboard -> clientemailsender($id); /* Delete in Google Calendar Start */
		if ($gc_hook -> gc_purchase_status() == 'exist') {
			if ($_POST['gc_event_id'] != 'none' && $_POST['gc_staff_event_id'] != 'none' && $_POST['pid'] != 'none') {
				echo $gc_hook -> gc_cancel_reject_booking_hook();
			}
		} /* Delete in Google Calendar End */ /*$booking_date = date("Y-m-d H:i", strtotime($clientdetail['booking_date_time']));*/
		$admin_company_name = $objsettings -> get_option('ct_company_name');
		$setting_date_format = $objsettings -> get_option('ct_date_picker_date_format');
		$setting_time_format = $objsettings -> get_option('ct_choose_time_format');
		$booking_date = str_replace($english_date_array,$selected_lang_label,date($setting_date_format, strtotime($clientdetail['booking_date_time'])));
		if ($setting_time_format == 12) {
			$booking_time = str_replace($english_date_array,$selected_lang_label,date("h:i A", strtotime($clientdetail['booking_date_time'])));
		} else {
			$booking_time = date("H:i", strtotime($clientdetail['booking_date_time']));
		}
		$company_name = $objsettings -> get_option('ct_email_sender_name');
		$company_email = $objsettings -> get_option('ct_email_sender_address');
		$service_name = $clientdetail['title'];
		if ($admin_email == "") {
			$admin_email = $clientdetail['email'];
		} /* $admin_name = $clientdetail['fullname']; */
		$price = $general -> ct_price_format($orderdetail[2], $symbol_position, $decimal); /* methods */
		$units = $label_language_values['none'];
		$methodname = $label_language_values['none'];
		$hh = $booking -> get_methods_ofbookings($orderdetail[4]);
		$count_methods = mysqli_num_rows($hh);
		$hh1 = $booking -> get_methods_ofbookings($orderdetail[4]);
		if ($count_methods > 0) {
			while ($jj = mysqli_fetch_array($hh1)) {
				if ($units == $label_language_values['none']) {
					$units = $jj['units_title']."-".$jj['qtys'];
				} else {
					$units = $units.",".$jj['units_title']."-".$jj['qtys'];
				}
				$methodname = $jj['method_title'];
			}
		} /* Add ons */
		$addons = $label_language_values['none'];
		$hh = $booking -> get_addons_ofbookings($orderdetail[4]);
		while ($jj = mysqli_fetch_array($hh)) {
			if ($addons == $label_language_values['none']) {
				$addons = $jj['addon_service_name']."-".$jj['addons_service_qty'];
			} else {
				$addons = $addons.",".$jj['addon_service_name']."-".$jj['addons_service_qty'];
			}
		} /*Guest User */
		if ($orderdetail[4] == 0) {
			$gc = $objdashboard -> getguestclient($orderdetail[4]);
			$temppp = unserialize(base64_decode($gc[5]));
			$temp = str_replace('\\', '', $temppp);
			$vc_status = $temp['vc_status'];
			if ($vc_status == 'N') {
				$final_vc_status = $label_language_values['no'];
			}
			elseif($vc_status == 'Y') {
				$final_vc_status = $label_language_values['yes'];
			} else {
				$final_vc_status = "N/A";
			}
			$p_status = $temp['p_status'];
			if ($p_status == 'N') {
				$final_p_status = $label_language_values['no'];
			}
			elseif($p_status == 'Y') {
				$final_p_status = $label_language_values['yes'];
			} else {
				$final_p_status = "N/A";
			}
			$client_name = $gc[2];
			$client_email = $gc[3];
			$client_phone = $gc[4];
			$firstname = $client_name;
			$lastname = '';
			$booking_status = $orderdetail[6];
			$final_vc_status;
			$final_p_status;
			$payment_status = $orderdetail[5];
			$client_address = $temp['address'];
			$client_notes = $temp['notes'];
			$client_status = $temp['contact_status'];
			$client_city = $temp['city'];
			$client_state = $temp['state'];
			$client_zip = $temp['zip'];
		} else /*Registered user */ {
			$c = $objdashboard -> getguestclient($orderdetail[4]);
			$temppp = unserialize(base64_decode($c[5]));
			$temp = str_replace('\\', '', $temppp);
			$vc_status = $temp['vc_status'];
			if ($vc_status == 'N') {
				$final_vc_status = $label_language_values['no'];
			}
			elseif($vc_status == 'Y') {
				$final_vc_status = $label_language_values['yes'];
			} else {
				$final_vc_status = "N/A";
			}
			$p_status = $temp['p_status'];
			if ($p_status == 'N') {
				$final_p_status = $label_language_values['no'];
			}
			elseif($p_status == 'Y') {
				$final_p_status = $label_language_values['yes'];
			} else {
				$final_p_status = "N/A";
			}
			$client_phone_no = $c[4];
			$client_phone_length = strlen($client_phone_no);
			if ($client_phone_length > 6) {
				$client_phone = $client_phone_no;
			} else {
				$client_phone = "N/A";
			}
			$client_namess = explode(" ", $c[2]);
			$cnamess = array_filter($client_namess);
			$ccnames = array_values($cnamess);
			if (sizeof((array)$ccnames) > 0) {
				$client_first_name = $ccnames[0];
				if (isset($ccnames[1])) {
						$client_last_name = $ccnames[1];
				} else {
						$client_last_name = '';
				}
			} else {
				$client_first_name = '';
				$client_last_name = '';
			}
			if ($client_first_name == "" && $client_last_name == "") {
				$firstname = "User";
				$lastname = "";
				$client_name = $firstname.' '.$lastname;
			}
			elseif($client_first_name != "" && $client_last_name != "") {
				$firstname = $client_first_name;
				$lastname = $client_last_name;
				$client_name = $firstname.' '.$lastname;
			}
			elseif($client_first_name != "") {
				$firstname = $client_first_name;
				$lastname = "";
				$client_name = $firstname.' '.$lastname;
			}
			elseif($client_last_name != "") {
				$firstname = "";
				$lastname = $client_last_name;
				$client_name = $firstname.' '.$lastname;
			}
			$client_notes = $temp['notes'];
			if ($client_notes == "") {
				$client_notes = "N/A";
			}
			$client_status = $temp['contact_status'];
			if ($client_status == "") {
				$client_status = "N/A";
			}
			$client_email = $c[3];
			$payment_status = $orderdetail[5];
			$final_vc_status;
			$final_p_status;
			$client_address = $temp['address'];
			$client_city = $temp['city'];
			$client_state = $temp['state'];
			$client_zip = $temp['zip'];
		}
		$searcharray = array('{{service_name}}', '{{booking_date}}', '{{business_logo}}', '{{business_logo_alt}}', '{{client_name}}', '{{methodname}}', '{{units}}', '{{addons}}', '{{client_email}}', '{{phone}}', '{{payment_method}}', '{{vaccum_cleaner_status}}', '{{parking_status}}', '{{notes}}', '{{contact_status}}', '{{address}}', '{{price}}', '{{admin_name}}', '{{firstname}}', '{{lastname}}', '{{app_remain_time}}', '{{reject_status}}', '{{company_name}}', '{{booking_time}}', '{{client_city}}', '{{client_state}}', '{{client_zip}}', '{{company_city}}', '{{company_state}}', '{{company_zip}}', '{{company_country}}', '{{company_phone}}', '{{company_email}}', '{{company_address}}', '{{admin_name}}');
		$replacearray = array($service_name, $booking_date, $business_logo, $business_logo_alt, $client_name, $methodname, $units, $addons, $client_email, $client_phone, $payment_status, $final_vc_status, $final_p_status, $client_notes, $client_status, $client_address, $price, $get_admin_name, $firstname, $lastname, '', '', $admin_company_name, $booking_time, $client_city, $client_state, $client_zip, $company_city, $company_state, $company_zip, $company_country, $company_phone, $company_email, $company_address, $get_admin_name); /* Client template */
		$emailtemplate -> email_subject = "Appointment Cancelled by you";
		$emailtemplate -> user_type = "C";
		$clientemailtemplate = $emailtemplate -> readone_client_email_template_body();
		if ($clientemailtemplate[2] != '') {
			$clienttemplate = base64_decode($clientemailtemplate[2]);
		} else {
			$clienttemplate = base64_decode($clientemailtemplate[3]);
		}
		$subject = $clientemailtemplate[1];
		if ($objsettings -> get_option('ct_client_email_notification_status') == 'Y' && $clientemailtemplate[4] == 'E') {
			$client_email_body = str_replace($searcharray, $replacearray, $clienttemplate);
			if ($objsettings -> get_option('ct_smtp_hostname') != '' && $objsettings -> get_option('ct_email_sender_name') != '' && $objsettings -> get_option('ct_email_sender_address') != '' && $objsettings -> get_option('ct_smtp_username') != '' && $objsettings -> get_option('ct_smtp_password') != '' && $objsettings -> get_option('ct_smtp_port') != '') {
				$mail -> IsSMTP();
			} else {
				$mail -> IsMail();
			}
			$mail -> SMTPDebug = 0;
			$mail -> IsHTML(true);
			$mail -> From = $company_email;
			$mail -> FromName = $company_name;
			$mail -> Sender = $company_email;
			$mail -> AddAddress($client_email, $client_name);
			$mail -> Subject = $subject;
			$mail -> Body = $client_email_body;
			$mail -> send();
			$mail -> ClearAllRecipients();
		} /* Admin Template */
		$emailtemplate -> email_subject = "Appointment Cancelled By Customer";
		$emailtemplate -> user_type = "A";
		$adminemailtemplate = $emailtemplate -> readone_client_email_template_body();
		if ($adminemailtemplate[2] != '') {
			$admintemplate = base64_decode($adminemailtemplate[2]);
		} else {
			$admintemplate = base64_decode($adminemailtemplate[3]);
		}
		$adminsubject = $adminemailtemplate[1];
		if ($objsettings -> get_option('ct_admin_email_notification_status') == 'Y' && $adminemailtemplate[4] == 'E') {
			$admin_email_body = str_replace($searcharray, $replacearray, $admintemplate);
			if ($objsettings -> get_option('ct_smtp_hostname') != '' && $objsettings -> get_option('ct_email_sender_name') != '' && $objsettings -> get_option('ct_email_sender_address') != '' && $objsettings -> get_option('ct_smtp_username') != '' && $objsettings -> get_option('ct_smtp_password') != '' && $objsettings -> get_option('ct_smtp_port') != '') {
				$mail_a -> IsSMTP();
			} else {
				$mail_a -> IsMail();
			}
			$mail_a -> SMTPDebug = 0;
			$mail_a -> IsHTML(true);
			$mail_a -> From = $company_email;
			$mail_a -> FromName = $company_name;
			$mail_a -> Sender = $company_email;
			$mail_a -> AddAddress($admin_email, $get_admin_name);
			$mail_a -> Subject = $adminsubject;
			$mail_a -> Body = $admin_email_body;
			$mail_a -> send();
			$mail -> ClearAllRecipients();
		} /*SMS SENDING CODE*/ /*GET APPROVED SMS TEMPLATE*/ /* TEXTLOCAL CODE */
		if ($objsettings -> get_option('ct_sms_textlocal_status') == "Y") {
			if ($objsettings -> get_option('ct_sms_textlocal_send_sms_to_client_status') == "Y") {
				$template = $objdashboard -> gettemplate_sms("CC", 'C');
				$phone = $client_phone;
				if ($template[4] == "E") {
					if ($template[2] == "") {
						$message = base64_decode($template[3]);
					} else {
						$message = base64_decode($template[2]);
					}
				}
				$message = str_replace($searcharray, $replacearray, $message);
				$data = "username=".$textlocal_username."&hash=".$textlocal_hash_id."&message=".$message."&numbers=".$phone."&test=0";
				$ch = curl_init('http://api.textlocal.in/send/?');
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$result = curl_exec($ch);
				curl_close($ch);
			}
			if ($objsettings -> get_option('ct_sms_textlocal_send_sms_to_admin_status') == "Y") {
				$template = $objdashboard -> gettemplate_sms("CC", 'A');
				$phone = $objsettings -> get_option('ct_sms_textlocal_admin_phone');
				if ($template[4] == "E") {
					if ($template[2] == "") {
						$message = base64_decode($template[3]);
					} else {
						$message = base64_decode($template[2]);
					}
				}
				$message = str_replace($searcharray, $replacearray, $message);
				$data = "username=".$textlocal_username."&hash=".$textlocal_hash_id."&message=".$message."&numbers=".$phone."&test=0";
				$ch = curl_init('http://api.textlocal.in/send/?');
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$result = curl_exec($ch);
				curl_close($ch);
			}
		} /*PLIVO CODE*/
		if ($objsettings -> get_option('ct_sms_plivo_status') == "Y") {
			$auth_id = $objsettings -> get_option('ct_sms_plivo_account_SID');
			$auth_token = $objsettings -> get_option('ct_sms_plivo_auth_token');
			$p = new Plivo\ RestAPI($auth_id, $auth_token, '', '');
			$plivo_sender_number = $objsettings -> get_option('ct_sms_plivo_sender_number');
			$twilio_sender_number = $objsettings -> get_option('ct_sms_twilio_sender_number');
			if ($objsettings -> get_option('ct_sms_plivo_send_sms_to_client_status') == "Y") {
				$template = $objdashboard -> gettemplate_sms("CC", 'C');
				$phone = $client_phone;
				if ($template[4] == "E") {
					if ($template[2] == "") {
						$message = base64_decode($template[3]);
					} else {
						$message = base64_decode($template[2]);
					}
					$client_sms_body = str_replace($searcharray, $replacearray, $message); /* MESSAGE SENDING CODE THROUGH PLIVO */
					$params = array('src' => $plivo_sender_number, 'dst' => $phone, 'text' => $client_sms_body, 'method' => 'POST');
					$response = $p -> send_message($params); /* MESSAGE SENDING CODE ENDED HERE*/
				}
			}
			if ($objsettings -> get_option('ct_sms_plivo_send_sms_to_admin_status') == "Y") {
				$template = $objdashboard -> gettemplate_sms("CC", 'A');
				$phone = $admin_phone_plivo;
				if ($template[4] == "E") {
					if ($template[2] == "") {
						$message = base64_decode($template[3]);
					} else {
						$message = base64_decode($template[2]);
					}
					$client_sms_body = str_replace($searcharray, $replacearray, $message);
					$params = array('src' => $plivo_sender_number, 'dst' => $phone, 'text' => $client_sms_body, 'method' => 'POST');
					$response = $p -> send_message($params); /* MESSAGE SENDING CODE ENDED HERE*/
				}
			}
		}
		if ($objsettings -> get_option('ct_sms_twilio_status') == "Y") {
			if ($objsettings -> get_option('ct_sms_twilio_send_sms_to_client_status') == "Y") {
				$template = $objdashboard -> gettemplate_sms("CC", 'C');
				$phone = $client_phone;
				if ($template[4] == "E") {
					if ($template[2] == "") {
						$message = base64_decode($template[3]);
					} else {
						$message = base64_decode($template[2]);
					}
					$client_sms_body = str_replace($searcharray, $replacearray, $message); /*TWILIO CODE*/
					$message = $twilliosms -> account -> messages -> create(array("From" => $twilio_sender_number, "To" => $phone, "Body" => $client_sms_body));
				}
			}
			if ($objsettings -> get_option('ct_sms_twilio_send_sms_to_admin_status') == "Y") {
				$template = $objdashboard -> gettemplate_sms("CC", 'A');
				$phone = $admin_phone_twilio;
				if ($template[4] == "E") {
					if ($template[2] == "") {
						$message = base64_decode($template[3]);
					} else {
						$message = base64_decode($template[2]);
					}
					$client_sms_body = str_replace($searcharray, $replacearray, $message); /*TWILIO CODE*/
					$message = $twilliosms -> account -> messages -> create(array("From" => $twilio_sender_number, "To" => $phone, "Body" => $client_sms_body));
				}
			}
		}
		if ($objsettings -> get_option('ct_nexmo_status') == "Y") {
			if ($objsettings -> get_option('ct_sms_nexmo_send_sms_to_client_status') == "Y") {
				$template = $objdashboard -> gettemplate_sms("CC", 'C');
				$phone = $client_phone;
				if ($template[4] == "E") {
					if ($template[2] == "") {
						$message = base64_decode($template[3]);
					} else {
						$message = base64_decode($template[2]);
					}
					$ct_nexmo_text = str_replace($searcharray, $replacearray, $message);
					$res = $nexmo_client -> send_nexmo_sms($phone, $ct_nexmo_text);
				}
			}
			if ($objsettings -> get_option('ct_sms_nexmo_send_sms_to_admin_status') == "Y") {
				$template = $objdashboard -> gettemplate_sms("CC", 'A');
				$phone = $objsettings -> get_option('ct_sms_nexmo_admin_phone_number');
				if ($template[4] == "E") {
					if ($template[2] == "") {
						$message = base64_decode($template[3]);
					} else {
						$message = base64_decode($template[2]);
					}
					$ct_nexmo_text = str_replace($searcharray, $replacearray, $message);
					$res = $nexmo_admin -> send_nexmo_sms($phone, $ct_nexmo_text);
				}
			}
		} /*SMS SENDING CODE END*/
		$valid = ['status' => "true", "statuscode" => 200, 'response' => $label_language_values["your_appointment_cancelled_successfully"]];
		setResponse($valid);
	} else {
			$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values['api_key_mismatch']];
			setResponse($invalid);
	}
}
elseif(isset($_POST['action']) && $_POST['action'] == 'check_couponcode') {
	verifyRequiredParams(array('api_key', 'coupon_code'));
	if (isset($_POST['api_key']) && $_POST['api_key'] == $objsettings -> get_option('ct_api_key')) {
		$coupon -> coupon_code = $_POST['coupon_code'];
		$result = $coupon -> checkcode();
		if ($result) {
			$coupon_exp_date = strtotime($result['coupon_expiry']);
			$today = date("Y-m-d");
			$curr_date = strtotime($today);
			if ($result['coupon_used'] < $result['coupon_limit'] && $curr_date <= $coupon_exp_date) {
				$array = array();
				foreach($result as $field => $value) {
					if (is_numeric($field)) {
						unset($result[$field]);
					} else {
						if ($result[$field] == '') {
							$result[$field] = null;
						}
					}
				}
				array_push($array, $result);
				$valid = ['status' => "true", "statuscode" => 200, 'response' => $array];
				setResponse($valid);
			} else {
				$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values["coupon_code_expired"]];
				setResponse($invalid);
			}
		} else {
			$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values["invalid_coupon_code"]];
			setResponse($invalid);
		}
	} else {
		$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values['api_key_mismatch']];
		setResponse($invalid);
	}
}
elseif(isset($_POST['action']) && $_POST['action'] == 'get_setting') {
	verifyRequiredParams(array('api_key', 'option_name'));
	if (isset($_POST['api_key']) && $_POST['api_key'] == $objsettings -> get_option('ct_api_key')) {
		$array = array();
		$arr = array();
		$arr['option_value'] = $objsettings -> get_option($_POST['option_name']);
		array_push($array, $arr);
		$valid = ['status' => "true", "statuscode" => 200, 'response' => $array];
		setResponse($valid);
	} else {
		$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values['api_key_mismatch']];
		setResponse($invalid);
	}
}
elseif(isset($_POST['action']) && $_POST['action'] == 'check_partialdeposit') {
	verifyRequiredParams(array('api_key'));
	if (isset($_POST['api_key']) && $_POST['api_key'] == $objsettings -> get_option('ct_api_key')) {
		if ($objsettings -> get_option('ct_partial_deposit_status') == 'Y') {
			$array = array();
			$pd_arr = array();
			$pd_arr['partial_deposit_status'] = $objsettings -> get_option('ct_partial_deposit_status');
			$pd_arr['partial_deposit_amount'] = $objsettings -> get_option('ct_partial_deposit_amount');
			$pd_arr['partial_deposit_type'] = $objsettings -> get_option('ct_partial_type');
			array_push($array, $pd_arr);
			$valid = ['status' => "true", "statuscode" => 200, 'response' => $array];
			setResponse($valid);
		} else {
			$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values["partial_deposit_is_disabled"]];
			setResponse($invalid);
		}
	} else {
		$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values['api_key_mismatch']];
		setResponse($invalid);
	}
}
elseif(isset($_POST['action']) && $_POST['action'] == 'get_slots') {
	verifyRequiredParams(array('api_key', 'selected_date', 'staff_id'));
	if (isset($_POST['api_key']) && $_POST['api_key'] == $objsettings -> get_option('ct_api_key')) {
		$selected_date = $_POST['selected_date'];
		$staff_id = $_POST['staff_id'];
		$t_zone_value = $objsettings -> get_option('ct_timezone');
		$server_timezone = date_default_timezone_get();
		if (isset($t_zone_value) && $t_zone_value != '') {
			$offset = $first_step -> get_timezone_offset($server_timezone, $t_zone_value);
			$timezonediff = $offset / 3600;
		} else {
			$timezonediff = 0;
		}
		if (is_numeric(strpos($timezonediff, '-'))) {
			$timediffmis = str_replace('-', '', $timezonediff) * 60;
			$currDateTime_withTZ = strtotime("-".$timediffmis." minutes", strtotime(date('Y-m-d H:i:s')));
		} else {
			$timediffmis = str_replace('+', '', $timezonediff) * 60;
			$currDateTime_withTZ = strtotime("+".$timediffmis." minutes", strtotime(date('Y-m-d H:i:s')));
		}
		$select_time = date('Y-m-d', strtotime($selected_date));
		$start_date = str_replace($english_date_array,$selected_lang_label,date($select_time, $currDateTime_withTZ)); /** Get Google Calendar Bookings **/
		$providerCalenderBooking = array();
		if ($gc_hook -> gc_purchase_status() == 'exist') {
			$gc_hook -> google_cal_TwoSync_hook();
		} /** Get Google Calendar Bookings **/
		$time_interval = $objsettings -> get_option('ct_time_interval');
		$time_slots_schedule_type = $objsettings -> get_option('ct_time_slots_schedule_type');
		$advance_bookingtime = $objsettings -> get_option('ct_min_advance_booking_time');
		$ct_service_padding_time_before = $objsettings -> get_option('ct_service_padding_time_before');
		$ct_service_padding_time_after = $objsettings -> get_option('ct_service_padding_time_after');
		$booking_padding_time = $objsettings -> get_option('ct_booking_padding_time');
		$time_schedule = $first_step -> get_day_time_slot_by_provider_id($time_slots_schedule_type, $start_date, $time_interval, $advance_bookingtime, $ct_service_padding_time_before, $ct_service_padding_time_after, $timezonediff, $booking_padding_time, $staff_id);
		$gc_slot_counter = 0;
		$allbreak_counter = 0;
		$allofftime_counter = 0;
		$slot_counter = 0;
		$arr_of_slots = array();
		$week_day_avail_count = $week_day_avail -> get_data_for_front_cal();
		if (mysqli_num_rows($week_day_avail_count) > 0) {
			if ($time_schedule['off_day'] != true && isset($time_schedule['slots']) && sizeof((array)$time_schedule['slots']) > 0 && $allbreak_counter != sizeof((array)$time_schedule['slots']) && $allofftime_counter != sizeof((array)$time_schedule['slots'])) {
				foreach($time_schedule['slots'] as $slot) { /* Checking in GC booked Slots START */
					$curreslotstr = strtotime(date(date('Y-m-d H:i:s', strtotime($select_time.' '.$slot)), $currDateTime_withTZ));
					$gccheck = 'N';
					if (sizeof((array)$providerCalenderBooking) > 0) {
						for ($i = 0; $i < sizeof((array)$providerCalenderBooking); $i++) {
							if ($curreslotstr >= $providerCalenderBooking[$i]['start'] && $curreslotstr < $providerCalenderBooking[$i]['end']) {
								$gccheck = 'Y';$gc_slot_counter++;
							}
						}
					} /* Checking in GC booked Slots END */
					$ifbreak = 'N'; /* Need to check if the appointment slot come under break time. */
					foreach($time_schedule['breaks'] as $daybreak) {
						if (strtotime($slot) >= strtotime($daybreak['break_start']) && strtotime($slot) < strtotime($daybreak['break_end'])) {
							$ifbreak = 'Y';
						}
					} /* if yes its break time then we will not show the time for booking  */
					if ($ifbreak == 'Y') {
						$allbreak_counter++;
						continue;
					}
					$ifofftime = 'N';
					foreach($time_schedule['offtimes'] as $offtime) {
						if (strtotime($selected_date.' '.$slot) >= strtotime($offtime['offtime_start']) && strtotime($selected_date.' '.$slot) < strtotime($offtime['offtime_end'])) {
							$ifofftime = 'Y';
						}
					} /* if yes its offtime time then we will not show the time for booking  */
					if ($ifofftime == 'Y') {
						$allofftime_counter++;
						continue;
					}
					$complete_time_slot = mktime(date('H', strtotime($slot)), date('i', strtotime($slot)), date('s', strtotime($slot)), date('n', strtotime($time_schedule['date'])), date('j', strtotime($time_schedule['date'])), date('Y', strtotime($time_schedule['date'])));
					if ($objsettings -> get_option('ct_hide_faded_already_booked_time_slots') == 'on' && (in_array($complete_time_slot, $time_schedule['booked'])) || $gccheck == 'Y') {
						continue;
					}
					if ((in_array($complete_time_slot, $time_schedule['booked']) || $gccheck == 'Y') && ($objsettings -> get_option('ct_allow_multiple_booking_for_same_timeslot_status') != 'Y')) {} else {
						if ($objsettings -> get_option('ct_time_format') == 24) {
							$slot_time = date("H:i", strtotime($slot));
							$slotdbb_time = date("H:i", strtotime($slot));
							$ct_time_selected = date("H:i", strtotime($slot));
						} else {
							$slot_time = str_replace($english_date_array,$selected_lang_label,date("h:i A", strtotime($slot)));
							$slotdbb_time = date("H:i", strtotime($slot));
							$ct_time_selected = str_replace($english_date_array,$selected_lang_label,date("h:iA", strtotime($slot)));
						}
						array_push($arr_of_slots, date("H:i", strtotime($slot)));
					}
					$slot_counter++;
				}
				if (sizeof((array)$arr_of_slots) > 0) {
					$array = array();
					array_push($array, $arr_of_slots);
					$valid = ['status' => "true", "statuscode" => 200, 'response' => $arr_of_slots];
					setResponse($valid);
				}
				if ($allbreak_counter != 0 && $allofftime_counter != 0) {
					$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values["none_of_time_slot_available_please_check_another_dates"]];
					setResponse($invalid);
				}
				if ($gc_slot_counter == sizeof((array)$time_schedule['slots']) && sizeof((array)$time_schedule['slots']) != 0) {
					$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values["none_of_time_slot_available_please_check_another_dates"]];
					setResponse($invalid);
				}
				if ($allbreak_counter == sizeof((array)$time_schedule['slots']) && sizeof((array)$time_schedule['slots']) != 0) {
					$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values["none_of_time_slot_available_please_check_another_dates"]];
					setResponse($invalid);
				}
				if ($allofftime_counter > sizeof((array)$time_schedule['offtimes']) && sizeof((array)$time_schedule['slots']) == $allofftime_counter) {
					$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values["none_of_time_slot_available_please_check_another_dates"]];
					setResponse($invalid);
				}
			} else {
				$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values["none_of_time_slot_available_please_check_another_dates"]];
				setResponse($invalid);
			}
		} else {
			$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values["availability_is_not_configured_from_admin_side"]];
			setResponse($invalid);
		}
	} else {
		$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values['api_key_mismatch']];
		setResponse($invalid);
	}
}
elseif(isset($_POST['action']) && $_POST['action'] == 'add_customer') {
	verifyRequiredParams(array('api_key', 'email', 'password', 'first_name', 'last_name'));
	if (isset($_POST['api_key']) && $_POST['api_key'] == $objsettings -> get_option('ct_api_key')) {
		$user -> existing_username = $_POST['email'];
		$user -> existing_password = md5($_POST['password']);
		$existing_login = $user -> check_login();
		if ($existing_login) {
			$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values["customer_already_exist"]];
			setResponse($invalid);
		} else {
			$phone = "";if(isset($_POST['phone'])){$phone = $_POST['phone'];}
			$address = "";if(isset($_POST['address'])){$address = $_POST['address'];}
			$zipcode = "";if(isset($_POST['zipcode'])){$zipcode = $_POST['zipcode'];}
			$city = "";if(isset($_POST['city'])){$city = $_POST['city'];}
			$state = "";if(isset($_POST['state'])){$state = $_POST['state'];}
			$user -> user_pwd = md5($_POST['password']);
			$user -> first_name = ucwords($_POST['first_name']);
			$user -> last_name = ucwords($_POST['last_name']);
			$user -> user_email = $_POST['email'];
			$user -> phone = $phone;
			$user -> address = $address;
			$user -> zip = $zipcode;
			$user -> city = ucwords($city);
			$user -> state = ucwords($state);
			$user -> notes = '';
			$user -> vc_status = 'N';
			$user -> p_status = 'N';
			$user -> status = 'E';
			$user -> usertype = serialize(array('client'));
			$user -> contact_status = '';
			$add_user = $user -> add_user();
			if ($add_user) {
				$valid = ['status' => "true", "statuscode" => 200, 'response' => $label_language_values["customer_created_successfully"]];
				setResponse($valid);
			} else {
				$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values["error_occurred_please_try_again"]];
				setResponse($invalid);
			}
		}
	} else {
		$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values['api_key_mismatch']];
		setResponse($invalid);
	}
}
elseif(isset($_POST['action']) && $_POST['action'] == 'book_appointment') { /* cart_detail */
	verifyRequiredParams(array('api_key', 'recurrence_id', 'user_id', 'staff_id', 'service_id', 'method_id', 'payment_method', 'sub_total', 'tax', 'discount', 'freq_discount_amount', 'net_amount', 'order_duration'));
	if (isset($_POST['api_key']) && $_POST['api_key'] == $objsettings -> get_option('ct_api_key')) {
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
		$current_time = date('Y-m-d H:i:s',$currDateTime_withTZ);
		$last_order_id=$booking->last_booking_id();
		if($last_order_id=='0' || $last_order_id==null){
			$orderid = 1000;
		}else{
			$orderid = $last_order_id+1;
		}
		$last_recurring_id=$order_client_info->last_recurring_id();
		if($last_recurring_id=='0' || $last_recurring_id==null){
			$rec_id = 1;
		}else{
			$rec_id = $last_recurring_id+1;
		}
		$appointment_auto_confirm=$settings->get_option("ct_appointment_auto_confirm_status");
		if($appointment_auto_confirm=="Y"){
			$booking_status="C";
		}else{
			$booking_status="A";
		}
		$email_order_id = $orderid;
		$client_id = $user->user_id = $_POST["user_id"];
		$staff_id = $_POST["staff_id"];
		$service_id = $_POST["service_id"];
		$service->id = $service_id;
		$service_name = $service->get_service_name_for_mail();
		$method_id = $_POST["method_id"];
		$mail_booking_date_time = $booking_date_time = date("Y-m-d H:i:s", strtotime($_POST["booking_date_time"]));
		$payment_method = $_POST["payment_method"];
		$sub_total = $_POST["sub_total"];
		$tax = $_POST["tax"];
		$partial_amount = 0;
		$discount = $_POST["discount"];
		$_SESSION['time_duration'] = $order_duration = $_POST["order_duration"];
		$recurrence_id = $_POST["recurrence_id"];
		$freq_discount_amount = $_POST["freq_discount_amount"];
		$net_amount = $_POST["net_amount"];
		$transaction_id = $_POST["transaction_id"];
		$one_user_detail = $user->readone();
		$first_name = ucwords($one_user_detail["first_name"]);
		$last_name = ucwords($one_user_detail["last_name"]);
		$client_name = ucwords($one_user_detail["first_name"])." ".ucwords($one_user_detail["last_name"]);
		$client_email = $one_user_detail["user_email"];
		$phone = $client_phone = $one_user_detail["phone"];
		$address = $one_user_detail["address"];
		$city = $one_user_detail["city"];
		$state = $one_user_detail["state"];
		$notes = $one_user_detail["notes"];
		$zip = $one_user_detail["zip"];
		$vc_status = $one_user_detail["vc_status"];
		$p_status = $one_user_detail["p_status"];
		$contact_status = $one_user_detail["contact_status"];
		$client_personal_info = base64_encode(serialize(array('zip'=>$one_user_detail["zip"],'address'=>$one_user_detail["address"],'city'=>$one_user_detail["city"],'state'=>$one_user_detail["state"],'notes'=>$one_user_detail["notes"],'vc_status'=>$one_user_detail["vc_status"],'p_status'=>$one_user_detail["p_status"],'contact_status'=>$one_user_detail["contact_status"])));
		$cart_detail = $_POST["cart_detail"];
		if($recurrence_id == "1"){
			if(count((array)$cart_detail) != 0) {
				for ($i = 0;$i < (count((array)$cart_detail));$i++){
					if ($cart_detail[$i]['type'] == 'unit'){
						$booking->order_id = $orderid;
						$booking->client_id = $client_id;
						$booking->order_date = $current_time;
						$booking->booking_date_time = $booking_date_time;
						$booking->service_id = $service_id;
						$booking->method_id = $method_id;
						$booking->method_unit_id = $cart_detail[$i]['unit_id'];
						$booking->method_unit_qty = $cart_detail[$i]['qty'];
						$booking->method_unit_qty_rate = $cart_detail[$i]['rate'];
						$booking->booking_status = $booking_status;
						$booking->reject_reason = "";
						$booking->lastmodify = $current_time;
						$booking->read_status = 'U';
						$booking->staff_id = $staff_id;
						$booking->add_booking();
					} else {
						$booking->order_id = $orderid;
						$booking->service_id = $service_id;
						$booking->addons_service_id = $cart_detail[$i]['unit_id'];
						$booking->addons_service_qty = $cart_detail[$i]['qty'];
						$booking->addons_service_rate = $cart_detail[$i]['rate'];
						$booking->add_addons_booking();
					}
				}
				$payment->order_id = $orderid;
				$payment->payment_method = ucwords($payment_method);
				if (isset($transaction_id) && $transaction_id != ''){
					$payment->transaction_id = $transaction_id;
					$payment->payment_status = 'Completed';
				} else {
					$payment->transaction_id = '';
					$payment->payment_status = 'Pending';
				}
				$payment->amount = $sub_total;
				$payment->discount = $discount;
				$payment->taxes = $tax;
				$payment->partial_amount = $partial_amount;
				$payment->payment_date = $current_time;
				$payment->lastmodify = $current_time;
				$payment->net_amount = $net_amount;
				$payment->frequently_discount = $recurrence_id;
				$payment->frequently_discount_amount = $freq_discount_amount;
				$payment->recurrence_status = 'N';
				$payment->add_payments();
				$order_client_info->order_id = $orderid;
				$order_client_info->client_name = $client_name;
				$order_client_info->client_email = $client_email;
				$order_client_info->client_phone = $client_phone;
				$order_client_info->client_personal_info = $client_personal_info;
				$order_client_info->order_duration = $order_duration;
				$order_client_info->recurring_id = $rec_id;
				$order_client_info->add_order_client();
				/* GC Code Start */
				if($gc_hook->gc_purchase_status() == 'exist'){
					$array_value = array('firstname' => $first_name,'lastname' => $last_name,'service_name' => $service_name,'email' => $client_email,'phone' => $client_phone,'staff_id' => "");
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
				$_SESSION['ct_details'] = array();
				$_SESSION['time_duration'] = 0;
				$valid = ['status' => "true", "statuscode" => 200, 'response' => $label_language_values["appointment_booked_successfully"]];
				setResponse($valid);
			}
		}else{
			$frequently_discount->id = $recurrence_id;
			$frequently_discount_detail = $frequently_discount->readone();
			$days = $frequently_discount_detail["days"];
			$cart_date_strtotime = strtotime($booking_date_time);
			$end_3_month_strtotime = strtotime("+3 months",$cart_date_strtotime);
			$cust_datediff = $end_3_month_strtotime - $cart_date_strtotime;
			$total_days = abs(floor($cust_datediff / (60 * 60 * 24)))+1;
			for($j=0;$j<$total_days;$j+=$days) {
				$booking_date_time = date("Y-m-d H:i:s",strtotime("+".$j." days",$cart_date_strtotime));
				$booking->order_id=$orderid;
				if(count((array)$_POST["cart_detail"]) != 0) {
					for ($i = 0;$i < (count((array)$cart_detail));$i++){
						if ($cart_detail[$i]['type'] == 'unit'){
							$booking->client_id = $client_id;
							$booking->order_date = $current_time;
							$booking->booking_date_time = $booking_date_time;
							$booking->service_id = $service_id;
							$booking->method_id = $method_id;
							$booking->method_unit_id = $cart_detail[$i]['unit_id'];
							$booking->method_unit_qty = $cart_detail[$i]['qty'];
							$booking->method_unit_qty_rate = $cart_detail[$i]['rate'];
							$booking->booking_status = $booking_status;
							$booking->reject_reason = "";
							$booking->lastmodify = $current_time;
							$booking->read_status = 'U';
							$booking->staff_id = $staff_id;
							$booking->add_booking();
						} else {
							$booking->service_id = $service_id;
							$booking->addons_service_id = $cart_detail[$i]['unit_id'];
							$booking->addons_service_qty = $cart_detail[$i]['qty'];
							$booking->addons_service_rate = $cart_detail[$i]['rate'];
							$booking->add_addons_booking();
						}
					}
				}
				$payment->order_id = $orderid;
				if($j == 0){
					if (isset($transaction_id) && $transaction_id != ''){
						$payment->transaction_id = $transaction_id;
						$payment->payment_status = 'Completed';
					} else {
						$payment->transaction_id = '';
						$payment->payment_status = 'Pending';
					}
					$payment->payment_method=$payment_method;
					$payment->payment_date=$current_time;
				}else{
					$payment->payment_method=ucwords('pay at venue');
					$payment->transaction_id="";
					$payment->payment_status="Pending";
					$payment->payment_date=$booking_date_time;
				}
				$payment->amount = $sub_total;
				$payment->discount = $discount;
				$payment->taxes = $tax;
				$payment->partial_amount = $partial_amount;
				$payment->payment_date = $current_time;
				$payment->lastmodify = $current_time;
				$payment->net_amount = $net_amount;
				$payment->frequently_discount = $recurrence_id;
				$payment->frequently_discount_amount = $freq_discount_amount;
				$payment->recurrence_status = 'N';
				$payment->add_payments();
				$order_client_info->order_id = $orderid;
				$order_client_info->client_name = $client_name;
				$order_client_info->client_email = $client_email;
				$order_client_info->client_phone = $client_phone;
				$order_client_info->client_personal_info = $client_personal_info;
				$order_client_info->order_duration = $order_duration;
				$order_client_info->recurring_id = $rec_id;
				$order_client_info->add_order_client();
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
				/* GC Code Start */
				if($gc_hook->gc_purchase_status() == 'exist'){
					$array_value = array('firstname' => $first_name,'lastname' => $last_name,'service_name' => $service_name,'email' => $client_email,'phone' => $client_phone,'staff_id' => "");
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
				$_SESSION['ct_details'] = array();
				$orderid++;
			}
			$_SESSION['time_duration'] = 0;
			$valid = ['status' => "true", "statuscode" => 200, 'response' => $label_language_values["appointment_booked_successfully"]];
			setResponse($valid);
		}
		send_email_and_sms($email_order_id, $mail_booking_date_time, $service_id, $address, $city, $state, $notes, $phone, $zip, $net_amount, $symbol_position, $decimal, $booking, $payment, $order_client_info, $service, $settings, $general, $client_email, $admin_email, $vc_status, $p_status, $appointment_auto_confirm, $email_template, $first_name, $last_name, $contact_status, $company_email, $company_name, $objdashboard, $textlocal_username, $textlocal_hash_id, $client_phone, $nexmo_admin, $nexmo_client, $business_logo, $business_logo_alt, $get_admin_name, $company_city, $company_state, $company_zip, $company_country, $company_phone, $company_address, $payment_method, $mail, $mail_a);
	} else {
		$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values['api_key_mismatch']];
		setResponse($invalid);
	}
}
elseif(isset($_POST['action']) && $_POST['action'] == 'get_staff_of_selected_service') {
	verifyRequiredParams(array('api_key', 'service_id'));
	if (isset($_POST['api_key']) && $_POST['api_key'] == $objsettings -> get_option('ct_api_key')) {
		$service_provider = $_POST['service_id'];
		$objadmin -> staff_select_according_service = $service_provider;
		$service_provider_list = $objadmin -> get_service_acc_provider_api();
		$provider_sec = "";
		$array = array();
		$i = 1;
		while ($row = mysqli_fetch_array($service_provider_list)) {
			array_push($array,$row);
		}
		if (empty($array)) {
			$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values["no_staff_found"]];
			setResponse($invalid);
		} else {
			$valid = ['status' => "true", "statuscode" => 200, 'response' => $array];
			setResponse($valid);
		}
	} else {
		$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values['api_key_mismatch']];
		setResponse($invalid);
	}
}
elseif(isset($_POST['action']) && $_POST['action'] == 'get_all_enabled_payment_gateways') {
	verifyRequiredParams(array('api_key'));
	if (isset($_POST['api_key']) && $_POST['api_key'] == $objsettings -> get_option('ct_api_key')) {
		$payment_array = array();
		if ($settings -> get_option('ct_pay_locally_status') == 'on') {
			array_push($payment_array, 'pay_locally');
		}
		if ($settings -> get_option('ct_bank_transfer_status') == 'Y' && ($settings -> get_option('ct_bank_name') != '' || $settings -> get_option('ct_account_name') != '' || $settings -> get_option('ct_account_number') != '' || $settings -> get_option('ct_branch_code') != '' || $settings -> get_option('ct_ifsc_code') != '' || $settings -> get_option('ct_bank_description') != '')) {
			array_push($payment_array, 'bank_transfer');
		}
		if ($settings -> get_option('ct_paypal_express_checkout_status') == 'on') {
			array_push($payment_array, 'paypal');
		}
		if ($settings -> get_option('ct_payumoney_status') == 'Y') {
			array_push($payment_array, 'payumoney');
		}
		if ($settings -> get_option('ct_authorizenet_status') == 'on' && $settings -> get_option('ct_stripe_payment_form_status') != 'on' && $settings -> get_option('ct_2checkout_status') != 'Y') {
			array_push($payment_array, 'authorizenet');
		}
		if ($settings -> get_option('ct_authorizenet_status') != 'on' && $settings -> get_option('ct_stripe_payment_form_status') == 'on' && $settings -> get_option('ct_2checkout_status') != 'Y') {
			array_push($payment_array, 'stripe');
		}
		if ($settings -> get_option('ct_authorizenet_status') != 'on' && $settings -> get_option('ct_stripe_payment_form_status') != 'on' && $settings -> get_option('ct_2checkout_status') == 'Y') {
			array_push($payment_array, '2checkout');
		}
		if (sizeof((array)$purchase_check) > 0) {
			foreach($purchase_check as $key => $val) {
				if ($val == 'Y') {
					array_push($payment_array, $key);
				}
			}
		}
		if (sizeof((array)$payment_array) > 0) {
			$valid = ['status' => "true", "statuscode" => 200, 'response' => $payment_array];
			setResponse($valid);
		} else {
			$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values["no_staff_found"]];
			setResponse($invalid);
		}
	} else {
		$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values['api_key_mismatch']];
		setResponse($invalid);
	}
}
elseif(isset($_POST['action']) && $_POST['action'] == 'get_profile_detail') {
	verifyRequiredParams(array('api_key', 'user_id', 'type'));
	if (isset($_POST['api_key']) && $_POST['api_key'] == $objsettings -> get_option('ct_api_key')) { /* objadmin  	user */
		$user_id = $_POST['user_id'];
		$new_array = array();
		if ($_POST['type'] == "staff") {
			$objadmin -> id = $user_id;
			$array = array();
			$staff_detail = $objadmin -> readone();
			if (!empty($staff_detail)) {
				$array['id'] = $staff_detail['id'];
				$array['password'] = $staff_detail['password'];
				$array['user_email'] = $staff_detail['email'];
				$array['fullname'] = $staff_detail['fullname'];
				$array['phone'] = $staff_detail['phone'];
				$array['address'] = $staff_detail['address'];
				$array['city'] = $staff_detail['city'];
				$array['state'] = $staff_detail['state'];
				$array['zip'] = $staff_detail['zip'];
				$array['country'] = $staff_detail['country'];
				$array['role'] = $staff_detail['role'];
				$array['description'] = $staff_detail['description'];
				$array['enable_booking'] = $staff_detail['enable_booking'];
				$array['service_commission'] = $staff_detail['service_commission'];
				$array['commision_value'] = $staff_detail['commision_value'];
				$array['schedule_type'] = $staff_detail['schedule_type'];
				$array['image'] = $staff_detail['image'];
				$array['service_ids'] = $staff_detail['service_ids'];
				foreach($array as $field => $value) {
					if ($array[$field] == '') {
						$array[$field] = null;
					} else {
						$array[$field] = $value;
					}
				}
				array_push($new_array, $array);
				$valid = ['status' => "true", "statuscode" => 200, 'response' => $new_array];
				setResponse($valid);
			} else {
				$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values["no_details_available"]];
				setResponse($invalid);
			}
		} elseif ($_POST['type'] == "user") {
			$user -> user_id = $user_id;
			$user_detail = $user -> readone();
			$array = array();
			if (!empty($user_detail)) {
				$array['id'] = $user_detail['id'];
				$array['user_email'] = $user_detail['user_email'];
				$array['user_pwd'] = $user_detail['user_pwd'];
				$array['fullname'] = $user_detail['first_name']." ".$user_detail['last_name'];
				$array['first_name'] = $user_detail['first_name'];
				$array['last_name'] =        $user_detail['last_name'];
				$array['phone'] = $user_detail['phone'];
				$array['zip'] = $user_detail['zip'];
				$array['address'] = $user_detail['address'];
				$array['city'] = $user_detail['city'];
				$array['state'] = $user_detail['state'];
				$array['notes'] = $user_detail['notes'];
				$array['vc_status'] = $user_detail['vc_status'];
				$array['p_status'] = $user_detail['p_status'];
				$array['contact_status'] = $user_detail['contact_status'];
				$array['status'] = $user_detail['status'];
				$array['usertype'] = $user_detail['usertype'];
				$array['cus_dt'] = $user_detail['cus_dt'];
				$user_date_timestamp = strtotime($user_detail['cus_dt']);
				$array['join_date'] = str_replace($english_date_array,$selected_lang_label,date('l, d-M-Y', $user_date_timestamp));
				$array['join_time'] = str_replace($english_date_array,$selected_lang_label,date('h:i A', $user_date_timestamp));
				foreach($array as $field => $value) {
					if ($array[$field] == '') {
						$array[$field] = null;
					} else {
						$array[$field] = $value;
					}
				}
				array_push($new_array, $array);
				$valid = ['status' => "true", "statuscode" => 200, 'response' => $new_array];
				setResponse($valid);
			} else {
				$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values["no_details_available"]];
				setResponse($invalid);
			}
		} else {
			$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values["type_is_mismatch"]];
			setResponse($invalid);
		}
	} else {
		$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values['api_key_mismatch']];
		setResponse($invalid);
	}
}
elseif(isset($_POST['action']) && $_POST['action'] == 'profile_detail_update') {
	verifyRequiredParams(array('api_key', 'user_id', 'type'));
	if (isset($_POST['api_key']) && $_POST['api_key'] == $objsettings -> get_option('ct_api_key')) {
		$user_id = $_POST['user_id'];
		if ($_POST['type'] == "staff") {
			verifyRequiredParams(array('fullname', 'email', 'phone', 'address', 'city', 'state', 'zip', 'country'));
			$objadmin -> id = $user_id;
			$staff_detail = $objadmin -> readone();
			if (!empty($staff_detail)) {
				$objadmin -> password = $staff_detail['password'];
				$objadmin -> fullname = ucwords($_POST['fullname']);
				$objadmin -> email = $_POST['email'];
				$objadmin -> phone = $_POST['phone'];
				$objadmin -> address = $_POST['address'];
				$objadmin -> city = $_POST['city'];
				$objadmin -> state = $_POST['state'];
				$objadmin -> zip = $_POST['zip'];
				$objadmin -> country = $_POST['country'];
				if ($objadmin -> update_profile()) {
					$valid = ['status' => "true", "statuscode" => 200, 'response' => $label_language_values["updated_successfully"]];
					setResponse($valid);
				} else {
					$valid = ['status' => "true", "statuscode" => 404, 'response' => $label_language_values["something_went_wrong"]];
					setResponse($valid);
				}
			} else {
				$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values["no_details_available"]];
				setResponse($invalid);
			}
		} elseif ($_POST['type'] == "user") {
			$user -> user_id = $user_id;
			$user_detail = $user -> readone();
			if (!empty($user_detail)) { /* objuserdetails */
				verifyRequiredParams(array('firstname', 'phone', 'lastname', 'address', 'city', 'state', 'zip'));
				$objuserdetails -> password = $user_detail['user_pwd'];
				$objuserdetails -> firstname = $_POST['firstname'];
				$objuserdetails -> phone = $_POST['phone'];
				$objuserdetails -> lastname = $_POST['lastname'];
				$objuserdetails -> address = $_POST['address'];
				$objuserdetails -> city = $_POST['city'];
				$objuserdetails -> state = $_POST['state'];
				$objuserdetails -> zip = $_POST['zip'];
				$objuserdetails -> id = $user_id;
				if ($objuserdetails -> update_profile()) {
					$valid = ['status' => "true", "statuscode" => 200, 'response' => $label_language_values["updated_successfully"]];
					setResponse($valid);
				} else {
					$valid = ['status' => "true", "statuscode" => 404, 'response' => $label_language_values["something_went_wrong"]];
					setResponse($valid);
				}
				$valid = ['status' => "true", "statuscode" => 200, 'response' => $user_detail];
				setResponse($valid);
			} else {
				$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values["no_details_available"]];
				setResponse($invalid);
			}
		} else {
			$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values["type_is_mismatch"]];
			setResponse($invalid);
		}
	} else {
		$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values['api_key_mismatch']];
		setResponse($invalid);
	}
}
elseif(isset($_POST['action']) && $_POST['action'] == 'change_password') {
	verifyRequiredParams(array('api_key', 'user_id', 'type', 'old_password', 'new_password', 'confirm_password'));
	if (isset($_POST['api_key']) && $_POST['api_key'] == $objsettings -> get_option('ct_api_key')) {
		$old_password = $_POST['old_password'];
		$new_password = $_POST['new_password'];
		$confirm_password = $_POST['confirm_password'];
		if ($new_password != $confirm_password) {
			$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values["please_check_your_confirmed_password"]];
			setResponse($invalid);
			die;
		} else {
			$old_password = md5($old_password);
		}
		$user_id = $_POST['user_id'];
		if ($_POST['type'] == "staff") {
			$objadmin -> id = $user_id;
			$staff_detail = $objadmin -> readone();
			if (!empty($staff_detail)) {
				$orignal_password = $staff_detail['password'];
				if ($orignal_password != $old_password) {
					$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values["your_password_not_match"]];
					setResponse($invalid);
				} else {
					$objadmin -> password = $new_password;
					$password_update = $objadmin -> update_password_api();
					if ($password_update) {
						$valid = ['status' => "true", "statuscode" => 200, 'response' => $label_language_values["updated_successfully"]];
						setResponse($valid);
					} else {
						$valid = ['status' => "true", "statuscode" => 404, 'response' => $label_language_values["something_went_wrong"]];
						setResponse($valid);
					}
				}
			} else {
				$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values["no_details_available"]];
				setResponse($invalid);
			}
		} elseif ($_POST['type'] == "user") {
			$user -> user_id = $user_id;
			$user_detail = $user -> readone();
			if (!empty($user_detail)) {
				$orignal_password = $user_detail['user_pwd'];
				if ($orignal_password != $old_password) {
					$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values["your_password_not_match"]];
					setResponse($invalid);
				} else {
					$user -> user_pwd = $new_password;
					$password_update = $user -> update_password();
					if ($password_update) {
						$valid = ['status' => "true", "statuscode" => 200, 'response' => $label_language_values["updated_successfully"]];
						setResponse($valid);
					} else {
						$valid = ['status' => "true", "statuscode" => 404, 'response' => $label_language_values["something_went_wrong"]];
						setResponse($valid);
					}
				}
			} else {
				$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values["no_details_available"]];
				setResponse($invalid);
			}
		} else {
			$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values["type_is_mismatch"]];
			setResponse($invalid);
		}
	} else {
		$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values['api_key_mismatch']];
		setResponse($invalid);
	}
}
elseif(isset($_POST['action']) && $_POST['action'] == 'get_all_past_appointment') {
	verifyRequiredParams(array('api_key','user_id','type'));
	if (isset($_POST['api_key']) && $_POST['api_key'] == $objsettings -> get_option('ct_api_key')) {
		$limit = 5;
		$page = $_POST['page'];
		$offset = $limit * $page;
		$booking -> booking_start_datetime = $today_date." 00:00:00";
		$type = $_POST['type'];
		$user_id = $_POST['user_id'];
		$booking -> limit = $limit;
		$booking -> offset = $offset;
		$all_upcomming_appointment = $booking -> get_all_past_bookings_api();
		$array = array();
		$pass_array = array();
		if (mysqli_num_rows($all_upcomming_appointment) > 0) {
			while ($row = mysqli_fetch_assoc($all_upcomming_appointment)) {
				$array['order_id'] = $row['order_id'];
				$client_id = $row['client_id'];
				$staff_ids = explode(",", $row['staff_ids']);
				if($type == 'user'){
					if($client_id != $user_id){
						continue;
					}
				}elseif($type == 'staff'){
					if(!in_array($user_id, $staff_ids)){
						continue;
					}
				}
				$order_detail = $booking -> get_detailsby_order_id($row['order_id']);
				$client_info = unserialize(base64_decode($order_detail['client_personal_info']));
				$array['booking_date_time'] = $order_detail['booking_date_time'];
				$array['booking_status'] = $order_detail['booking_status'];
				$array['reject_reason'] = $order_detail['reject_reason'];
				$array['title'] = $order_detail['service_title'];
				$array['total_payment'] = $order_detail['net_amount'];
				$array['gc_event_id'] = $order_detail['gc_event_id'];
				$array['gc_staff_event_id'] = $order_detail['gc_staff_event_id'];
				$array['staff_ids'] = $order_detail['staff_ids'];
				if ($order_detail['staff_ids'] != '') {
					$staff_names = '';
					$exploded_staff_ids = explode(',', $order_detail['staff_ids']);
					$i = 1;
					foreach($exploded_staff_ids as $id) {
						$objadmin -> id = $id;
						$staffdata = $objadmin -> readone();
						if ($i = 1) {
							$staff_names.= $staffdata['fullname'];
						} else {
							$staff_names.= ', '.$staffdata['fullname'];
						}
						$i++;
					}
					$array['staff_names'] = $staff_names;
				} else {
					$array['staff_names'] = null;
				}
				$units = null;
				$methodname = null;
				$hh = $booking -> get_methods_ofbookings($row['order_id']);
				$count_methods = mysqli_num_rows($hh);
				$hh1 = $booking -> get_methods_ofbookings($row['order_id']);
				if ($count_methods > 0) {
					while ($jj = mysqli_fetch_array($hh1)) {
						if ($units == null) {
							$units = $jj['units_title']."-".$jj['qtys'];
						} else {
							$units = $units.",".$jj['units_title']."-".$jj['qtys'];
						}
						$methodname = $jj['method_title'];
					}
				}
				$addons = null;
				$hh = $booking -> get_addons_ofbookings($row['order_id']);
				while ($jj = mysqli_fetch_array($hh)) {
					if ($addons == null) {
						$addons = $jj['addon_service_name']."-".$jj['addons_service_qty'];
					} else {
						$addons = $addons.",".$jj['addon_service_name']."-".$jj['addons_service_qty'];
					}
				}
				$array['method_name'] = $methodname;
				$array['units'] = $units;
				$array['addons'] = $addons;
				$booking_date_timestamp = strtotime($array['booking_date_time']);
				$array['appointment_date'] = str_replace($english_date_array,$selected_lang_label,date('l, d-M-Y', $booking_date_timestamp));
				$array['appointment_time'] = str_replace($english_date_array,$selected_lang_label,date('h:i A', $booking_date_timestamp));
				foreach($client_info as $field => $value) {
					if ($client_info[$field] == '') {
						$array[$field] = null;
					} else {
						$array[$field] = $value;
					}
				}
				foreach($array as $field => $value) {
					if ($array[$field] == '') {
						$array[$field] = null;
					} else {
						$array[$field] = $value;
					}
				}
				array_push($pass_array, $array);
			}
			$invalid = ['status' => "true", "statuscode" => 200, 'response' => $pass_array];
			setResponse($invalid);
		} else {
			$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values["no_upcomming_appointment"]];
			setResponse($invalid);
		}
	} else {
		$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values['api_key_mismatch']];
		setResponse($invalid);
	}
}
elseif(isset($_POST['action']) && $_POST['action'] == 'get_all_upcoming_appointment') {
	verifyRequiredParams(array('api_key','user_id','type'));
	if (isset($_POST['api_key']) && $_POST['api_key'] == $objsettings -> get_option('ct_api_key')) {
		$limit = 5;
		$page = $_POST['page'];
		$offset = $limit * $page;
		$type = $_POST['type'];
		$user_id = $_POST['user_id'];
		$booking -> limit = $limit;
		$booking -> offset = $offset;
		$booking -> booking_start_datetime = $today_date." 00:00:00";
		$all_upcomming_appointment = $booking -> get_all_upcoming_bookings_api();
		$array = array();
		$pass_array = array();
		if (mysqli_num_rows($all_upcomming_appointment) > 0) {
			while ($row = mysqli_fetch_assoc($all_upcomming_appointment)) {
				$array['order_id'] = $row['order_id'];
				$client_id = $row['client_id'];
				$staff_ids = explode(",", $row['staff_ids']);
				if($type == 'user'){
					if($client_id != $user_id){
						continue;
					}
				}elseif($type == 'staff'){
					if(!in_array($user_id, $staff_ids)){
						continue;
					}
				}
				$order_detail = $booking -> get_detailsby_order_id($row['order_id']);
				$client_info = unserialize(base64_decode($order_detail['client_personal_info']));
				$array['booking_date_time'] = $order_detail['booking_date_time'];
				$array['booking_status'] = $order_detail['booking_status'];
				$array['reject_reason'] = $order_detail['reject_reason'];
				$array['title'] = $order_detail['service_title'];
				$array['total_payment'] = $order_detail['net_amount'];
				$array['gc_event_id'] = $order_detail['gc_event_id'];
				$array['gc_staff_event_id'] = $order_detail['gc_staff_event_id'];
				$array['staff_ids'] = $order_detail['staff_ids'];
				if ($order_detail['staff_ids'] != '') {
					$staff_names = '';
					$exploded_staff_ids = explode(',', $order_detail['staff_ids']);
					$i = 1;
					foreach($exploded_staff_ids as $id) {
						$objadmin -> id = $id;
						$staffdata = $objadmin -> readone();
						if ($i = 1) {
							$staff_names.= $staffdata['fullname'];
						} else {
							$staff_names.= ', '.$staffdata['fullname'];
						}
						$i++;
					}
					$array['staff_names'] = $staff_names;
				} else {
					$array['staff_names'] = null;
				}
				$units = null;
				$methodname = null;
				$hh = $booking -> get_methods_ofbookings($row['order_id']);
				$count_methods = mysqli_num_rows($hh);
				$hh1 = $booking -> get_methods_ofbookings($row['order_id']);
				if ($count_methods > 0) {
					while ($jj = mysqli_fetch_array($hh1)) {
						if ($units == null) {
							$units = $jj['units_title']."-".$jj['qtys'];
						} else {
							$units = $units.",".$jj['units_title']."-".$jj['qtys'];
						}
						$methodname = $jj['method_title'];
					}
				}
				$addons = null;
				$hh = $booking -> get_addons_ofbookings($row['order_id']);
				while ($jj = mysqli_fetch_array($hh)) {
					if ($addons == null) {
						$addons = $jj['addon_service_name']."-".$jj['addons_service_qty'];
					} else {
						$addons = $addons.",".$jj['addon_service_name']."-".$jj['addons_service_qty'];
					}
				}
				$array['method_name'] = $methodname;
				$array['units'] = $units;
				$array['addons'] = $addons;
				$booking_date_timestamp = strtotime($array['booking_date_time']);
				$array['appointment_date'] = str_replace($english_date_array,$selected_lang_label,date('l, d-M-Y', $booking_date_timestamp));
				$array['appointment_time'] = str_replace($english_date_array,$selected_lang_label,date('h:i A', $booking_date_timestamp));
				foreach($client_info as $field => $value) {
					if ($client_info[$field] == '') {
						$array[$field] = null;
					} else {
						$array[$field] = $value;
					}
				}
				foreach($array as $field => $value) {
					if ($array[$field] == '') {
						$array[$field] = null;
					} else {
						$array[$field] = $value;
					}
				}
				array_push($pass_array, $array);
			}
			$invalid = ['status' => "true", "statuscode" => 200, 'response' => $pass_array];
			setResponse($invalid);
		} else {
			$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values["no_upcomming_appointment"]];
			setResponse($invalid);
		}
	} else {
		$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values['api_key_mismatch']];
		setResponse($invalid);
	}
}
elseif(isset($_POST['action']) && $_POST['action'] == 'otp') {
	verifyRequiredParams(array('api_key', 'email'));
	if (isset($_POST['api_key']) && $_POST['api_key'] == $objsettings -> get_option('ct_api_key')) {
		if (isset($_POST['email'])) {
			$user -> user_email = $_POST['email'];
			$res = $user -> check_customer_email_existing();
			if ($res == $_POST['email']) {
				$company_email = $objsettings -> get_option('ct_company_email');
				$company_name = $settings -> get_option('ct_company_name');
				$client_email = $_POST['email'];
				$client_name = 'cleaning';
				$subject = "Email Send for Otp";
				$otp_randome = rand(100000, 999999);
				$client_email_body = "Your Otp is :- ".$otp_randome;
				$mail -> SMTPDebug = 0;
				$mail -> IsHTML(true);
				$mail -> From = $company_email;
				$mail -> FromName = $company_name;
				$mail -> Sender = $company_email;
				$mail -> AddAddress($client_email, '');
				$mail -> Subject = $subject;
				$mail -> Body = $client_email_body;
				$mail -> send();
				$mail -> ClearAllRecipients();
				$user -> user_otp = $otp_randome;
				$user -> user_email = $client_email;
				$resadd = $user -> send_otp_using_mail();
				$valid = ['status' => "true", "statuscode" => 200, 'response' => $label_language_values["email_exist"]];
				setResponse($valid);
			} else {
				$email_error = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values["email_does_not_exist"]];
				setResponse($email_error);
			}
		}
	} else {
		$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values["invalid_credentials"]];
		setResponse($invalid);
	}
}
elseif(isset($_POST['action']) && $_POST['action'] == 'confirm_otp_email') {
	verifyRequiredParams(array('api_key', 'email', 'otp'));
	if (isset($_POST['api_key']) && $_POST['api_key'] == $objsettings -> get_option('ct_api_key')) {
		$user -> email = $_POST['email'];
		$optres = $user -> readall_opt();
		if ($optres == $_POST['otp']) {
			$valid = ['status' => "true", "statuscode" => 200, 'response' => $label_language_values["otp_match"]];
			$user -> otp = $_POST['otp'];
			$optresa = $user -> opt_update_status();
			setResponse($valid);
		} else {
			$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values["otp_not_match"]];
			setResponse($invalid);
		}
	}
}
elseif(isset($_POST['action']) && $_POST['action'] == 'forgot_password') {
	verifyRequiredParams(array('api_key', 'email', 'newpassword'));
	if (isset($_POST['api_key']) && $_POST['api_key'] == $objsettings -> get_option('ct_api_key')) {
		$user -> user_pwd = md5($_POST['newpassword']);
		$user -> user_email = $_POST['email'];
		$res = $user -> forgot_update_password();
		if ($res) {
			$valid = ['status' => "true", "statuscode" => 200, 'response' => $label_language_values["password_is_change"]];
			setResponse($valid);
		} else {
			$valid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values["password_not_change"]];
			setResponse($valid);
		}
	}
}elseif(isset($_POST['action']) && $_POST['action'] == 'feedback_email_send'){
	verifyRequiredParams(array('api_key','fullname','message'));
	if(isset($_POST['api_key']) && $_POST['api_key'] == $objsettings->get_option('ct_api_key')){
		$mess	  = $_POST['message'];
		$to       = 'anuj.sachdeva@broadviewinnovations.in';
		$subject  = 'Client Feedback';
		$message  = $mess;
		$headers  = 'From: anuj .sachdeva@broadviewinnovations.in' . "\r\n" .
					'MIME-Version: 1.0' . "\r\n" .
					'Content-type: text/html; charset=utf-8';
		if(mail($to, $subject, $message, $headers)){
			$valid = [ 'status' => "true", "statuscode"=> 200, 'response' => $label_language_values["email_send"]];
			setResponse($valid); 
		} else {
			$invalid = [ 'status' => "false", "statuscode"=> 404, 'response' => $label_language_values["email_sending_failed"]];
			setResponse($invalid);
		}
	}
}elseif(isset($_POST['action']) && $_POST['action'] == 'get_payment_order_rec') {
	verifyRequiredParams(array('api_key', 'user_id', 'type'));
	if (isset($_POST['api_key']) && $_POST['api_key'] == $objsettings -> get_option('ct_api_key')) {
		$limit = 5;
		$page = $_POST['page'];
		$offset = $limit * $page;
		if ($_POST['type'] == 'client') {
			$user -> user_id = $_POST['user_id'];
			$user -> limit = $limit;
			$user -> offset = $offset;
			$userdata = $user -> get_payment_order_record();
			$array = array();
			if (mysqli_num_rows($userdata) > 0) {
				while ($row = mysqli_fetch_assoc($userdata)) {
					$order_date = strtotime($row['order_date']);
					$row['order_date_format'] = str_replace($english_date_array,$selected_lang_label,date('l, d-M-Y', $order_date));
					$booking_date_time = strtotime($row['booking_date_time']);
					$row['appointment_date'] = str_replace($english_date_array,$selected_lang_label,date('l, d-M-Y', $booking_date_time));
					$row['appointment_time'] = str_replace($english_date_array,$selected_lang_label,date('h:i A', $booking_date_time));
					$payment_date = strtotime($row['payment_date']);
					$row['payment_date_format'] = str_replace($english_date_array,$selected_lang_label,date('l, d-M-Y', $payment_date));
					array_push($array, $row);
				}
				$valid = ['status' => "true", "statuscode" => 200, 'response' => $array];
				setResponse($valid);
			} else {
				$valid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values["no_orders_details"]];
				setResponse($valid);
			}
		} elseif ($_POST['type'] == 'staff') {
			$user -> user_id = $_POST['user_id'];
			$user -> limit = $limit;
			$user -> offset = $offset;
			$userdata = $user -> get_staff_payment_order_record();
			$array = array();
			if (mysqli_num_rows($userdata) > 0) {
				while ($row = mysqli_fetch_assoc($userdata)) {
					$order_date = strtotime($row['order_date']);
					$row['order_date_format'] = str_replace($english_date_array,$selected_lang_label,date('l, d-M-Y', $order_date));
					$booking_date_time = strtotime($row['booking_date_time']);
					$row['appointment_date'] = str_replace($english_date_array,$selected_lang_label,date('l, d-M-Y', $booking_date_time));
					$row['appointment_time'] = str_replace($english_date_array,$selected_lang_label,date('h:i A', $booking_date_time));
					$payment_date = strtotime($row['payment_date']);
					$row['payment_date_format'] = str_replace($english_date_array,$selected_lang_label,date('l, d-M-Y', $payment_date));
					array_push($array, $row);
				}
				$valid = ['status' => "true", "statuscode" => 200, 'response' => $array];
				setResponse($valid);
			} else {
				$valid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values["no_orders_details"]];
				setResponse($valid);
			}
		}
	}
}
elseif(isset($_POST['action']) && $_POST['action'] == 'stripe_payment_method') {
	verifyRequiredParams(array('api_key', 'full_name', 'email', 'card_number', 'card_month', 'card_year', 'card_cvv', 'amount'));
	if (isset($_POST['api_key']) && $_POST['api_key'] == $objsettings -> get_option('ct_api_key')) {
		if($objsettings -> get_option('ct_stripe_payment_form_status') != "off"){
			require_once(dirname(dirname(__FILE__)) . "/assets/stripe/stripe.php");
			$secret_key = $objsettings -> get_option('ct_stripe_secretkey');
			$currency = $objsettings -> get_option('ct_currency');
			\Stripe\Stripe::setApiKey($secret_key);
			$error = '';
			$success = '';
			try {
				$objtoken = new \Stripe\Token;
				$token = $objtoken::Create(array(
					"card" => array(
					"number" => $_POST['card_number'],
					"exp_month" => $_POST['card_month'],
					"exp_year" => $_POST['card_year'],
					"cvc" => $_POST['card_cvv']
					)
				));
				$token_id = $token->id;
				$objcharge = new \Stripe\Charge;
				$striperesponse = $objcharge::Create(array(
					"amount" => round($_POST['amount']*100),
					"currency" => $currency,
					"source" => $token_id,
					"description"=>$_POST['full_name']
				));
				$transaction_id = $striperesponse->id;
				$valid = ['status' => "true", "statuscode" => 200, 'response' => $transaction_id];
				setResponse($valid);
			}catch (Exception $e) {
				$error = $e->getMessage();
				$invalid = ['status' => "false", "statuscode" => 404, 'response' => "Message Is - ".$error];
				setResponse($invalid);
				die;
			}
		} else {
			$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values["please_enable_stripe"]];
			setResponse($invalid);
		}
	} else {
		$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values['api_key_mismatch']];
		setResponse($invalid);
	}
}
elseif(isset($_POST['action']) && $_POST['action'] == 'get_language_labels') {
	verifyRequiredParams(array('api_key'));
	if (isset($_POST['api_key']) && $_POST['api_key'] == $objsettings -> get_option('ct_api_key')) {
		echo $lang = $settings->get_option("ct_language");
		$label_language_values = array();
		$language_label_arr = $settings->get_all_labelsbyid($lang);
		if ($language_label_arr[8] != ""){
			$default_language_arr = $settings->get_all_labelsbyid("en");
			if($language_label_arr[8] != ''){
				$label_decode_front = base64_decode($language_label_arr[8]);
			} else {
				$label_decode_front = base64_decode($default_language_arr[8]);
			}
			$label_decode_front_unserial = unserialize($label_decode_front);
			$label_language_values = array_merge($label_decode_front_unserial);
			foreach($label_language_values as $key => $value){
				$label_language_values[$key] = urldecode($value);
			}
		} else {
			$default_language_arr = $settings->get_all_labelsbyid("en");
			$label_decode_front = base64_decode($default_language_arr[8]);
			$label_decode_front_unserial = unserialize($label_decode_front);
			$label_language_values = array_merge($label_decode_front_unserial);
			foreach($label_language_values as $key => $value){
				$label_language_values[$key] = urldecode($value);
			}
		}
		$array = array();
		array_push($array, $label_language_values);
		$valid = ['status' => "true", "statuscode" => 200, 'response' => $array];
		setResponse($valid);
	} else {
		$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values['api_key_mismatch']];
		setResponse($invalid);
	}
}
elseif(isset($_POST['action']) && $_POST['action'] == 'my_copy_action_for_other') {
	verifyRequiredParams(array('api_key', 'user_id'));
	if (isset($_POST['api_key']) && $_POST['api_key'] == $objsettings -> get_option('ct_api_key')) {} else {
		$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values['api_key_mismatch']];
		setResponse($invalid);
	}
}
else {
	$invalid = ['status' => "false", "statuscode" => 404, 'response' => $label_language_values["invalid_request"]];
	setResponse($invalid);
}
?>