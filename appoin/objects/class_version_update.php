<?php   
class cleanto_version_update{

	/* 
	Open a connect to the database.
	Make sure this is called on every page that needs to use the database.
	*/
	public $version="6.3";
	public $conn;

	public function update1_1(){

        /* insert new table */
		$languages = "CREATE TABLE IF NOT EXISTS `ct_languages` (
					  `id` int(11) NOT NULL AUTO_INCREMENT,
					  `label_data` longtext NOT NULL,
					  `language` varchar(5) NOT NULL,
					  PRIMARY KEY (`id`)
					 ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
        mysqli_query($this->conn,$languages);

        /* Insert new options in settings */
        $add_options = "INSERT INTO `ct_settings` (`id`, `option_name`, `option_value`,`postalcode`) VALUES (NULL, 'ct_company_country_code', '+1,us,United States: +1','');";
         mysqli_query($this->conn,$add_options);

		/* Update the oprion in settings*/
		/* $add_options = "UPDATE ct_settings SET option_value = '+1,us,United States: +1' WHERE option_name = 'ct_company_country_code';";
        mysqli_query($this->conn,$add_options);
		*/
        $add_options = "INSERT INTO `ct_settings` (`id`, `option_name`, `option_value`, `postalcode`) VALUES (NULL, 'ct_language', 'en','');";
        mysqli_query($this->conn,$add_options);

        /* alter table add new field in addons */
        $add_options = "ALTER TABLE `ct_services_addon` ADD `predefine_image` TEXT NOT NULL";
        mysqli_query($this->conn,$add_options);

		 $add_options = "INSERT INTO `ct_settings` (`id`, `option_name`, `option_value`, `postalcode`) VALUES (NULL, 'ct_custom_css', '','');";
        mysqli_query($this->conn,$add_options);


		$this->insert_option('ct_authorizenet_status','');
		$this->insert_option('ct_authorizenet_API_login_ID','');
		$this->insert_option('ct_authorizenet_transaction_key','');
		$this->insert_option('ct_authorize_sandbox_mode','');

        $errors = array(
            "Atleast one payment method should be enable"=>"atleast_one_payment_method_should_be_enable",
            "Appointment booking confirm"=>"appointment_booking_confirm",
            "Appointment booking rejected"=>"appointment_booking_rejected",
            "Boooking Cancelled"=>"booking_cancel",
            "Appointment marked as no show"=>"appointment_marked_as_no_show",
            "Appointment Reschedules successfully"=>"appointment_reschedules_successfully",
            "Booking Deleted"=>"booking_deleted",
            "Break End Time should be greater than Start time"=>"break_end_time_should_be_greater_than_start_time",
            "Cancel by client"=>"cancel_by_client",
            "Cancelled by service provider"=>"cancelled_by_service_provider",
            "Confirmed"=>"confirmed",
            "Design set successfully"=>"design_set_successfully",
            "End break time updated"=>"end_break_time_updated",
            "Enter alphabets only"=>"enter_alphabets_only",
            "Enter only alphabets"=>"enter_only_alphabets",
            "Enter only Alphabets/Numbers"=>"enter_only_alphabets_numbers",
            "Enter only Digits"=>"enter_only_digits",
            "Enter valid Url"=>"enter_valid_url",
            "Enter only numeric"=>"enter_only_numeric",
            "Enter proper country code"=>"enter_proper_country_code",
            "Frequently discount status updated"=>"frequently_discount_status_updated",
            "Frequently discount updated"=>"frequently_discount_updated",
            "Manage addons service"=>"manage_addons_service",
            "Maximum file upload size 2 MB"=>"maximum_file_upload_size_2_mb",
            "Method deleted successfully"=>"method_deleted_successfully",
            "Method inserted successfully"=>"method_inserted_successfully",
            "Minimum file upload size 10 KB"=>"minimum_file_upload_size_10_kb",
            "Off time added successfully"=>"off_time_added_successfully",
            "Only jpeg, png and gif images Allowed"=>"only_jpeg_png_and_gif_images_allowed",
            "Password must be 8 character long"=>"password_must_be_8_character_long",
            "Password should not exist more then 20 characters"=>"password_should_not_exist_more_then_20_characters",
            "Pending"=>"pending",
            "Please assign base price for unit"=>"please_assign_base_price_for_unit",
            "Please assign price"=>"please_assign_price",
            "Please assign quantity"=>"please_assign_qty",
            "Please enter API Password"=>"please_enter_api_password",
            "Please enter API Username"=>"please_enter_api_username",
            "Please enter Color Code"=>"please_enter_color_code",
            "Please enter country"=>"please_enter_country",
            "Please enter coupon limit"=>"please_enter_coupon_limit",
            "Please enter coupon value"=>"please_enter_coupon_value",
            "Please enter coupon code"=>"please_enter_coupon_code",
            "Please enter email"=>"please_enter_email",
            "Please enter Fullname"=>"please_enter_fullname",
            "Please enter maxLimit"=>"please_enter_maxlimit",
            "Please enter method title"=>"please_enter_method_title",
            "Please enter name"=>"please_enter_name",
            "Please enter only numeric"=>"please_enter_only_numeric",
            "Please enter proper base price"=>"please_enter_proper_base_price",
            "Please enter proper name"=>"please_enter_proper_name",
            "Please enter proper title"=>"please_enter_proper_title",
            "Please enter publishable key"=>"please_enter_publishable_key",
            "Please enter secret key"=>"please_enter_secret_key",
            "Please enter service Title"=>"please_enter_service_title",
            "Please enter signature"=>"please_enter_signature",
            "Please enter some quantity"=>"please_enter_some_qty",
            "Please enter title"=>"please_enter_title",
            "Please enter unit title"=>"please_enter_unit_title",
            "Please enter valid country code"=>"please_enter_valid_country_code",
            "Please enter valid service title"=>"please_enter_valid_service_title",
            "Please enter valid price"=>"please_enter_valid_price",
            "Please enter zipcode"=>"please_enter_zipcode",
            "Please enter state"=>"please_enter_state",
            "Please retype correct password"=>"please_retype_correct_password",
            "Please select porper time slots"=>"please_select_porper_time_slots",
            "Please select time between day availability time"=>"please_select_time_between_day_availability_time",
            "Please enter valid value for discount"=>"please_enter_valid_value_for_discount",
            "Please enter confirm password"=>"please_enter_confirm_password",
            "Please enter new password"=>"please_enter_new_password",
            "Please enter old password"=>"please_enter_old_password",
            "Please enter only numeric"=>"please_enter_only_numeric",
            "Please enter valid number"=>"please_enter_valid_number",
            "Please enter valid number with country code"=>"please_enter_valid_number_with_country_code",
            "Please select end time greater than start time"=>"please_select_end_time_greater_than_start_time",
            "Please select end time less than start time"=>"please_select_end_time_less_than_start_time",
            "Please select a crop region and then press upload"=>"please_select_a_crop_region_and_then_press_upload",
            "Please select a valid image file jpg and png are allowed"=>"please_select_a_valid_image_file_jpg_and_png_are_allowed",
            "Profile updated successfully"=>"profile_updated_successfully",
            "Quantity rule deleted"=>"qty_rule_deleted",
            "Record deleted successfully"=>"record_deleted_successfully",
            "Record updated successfully"=>"record_updated_successfully",
            "Rejected"=>"rejected",
            "Rescheduled"=>"rescheduled",
            "Schedule updated to Monthly"=>"schedule_updated_to_monthly",
            "Schedule updated to Weekly"=>"schedule_updated_to_weekly",
            "Sorry method already exist"=>"sorry_method_already_exist",
            "Sorry no notification"=>"sorry_no_notification",
            "Sorry promocode already exist"=>"sorry_promocode_already_exist",
            "Sorry unit already exist"=>"sorry_unit_already_exist",
            "Sorry we are not available"=>"sorry_we_are_not_available",
            "Start break time updated"=>"start_break_time_updated",
            "Status updated"=>"status_updated",
            "Time slots updated successfully"=>"time_slots_updated_successfully",
            "Unit inserted successfully"=>"unit_inserted_successfully",
            "Units status updated"=>"units_status_updated",
            "Updated appearance aettings"=>"updated_appearance_settings",
            "Updated company details"=>"updated_company_details",
            "Updated E-mail settings"=>"updated_email_settings",
            "Updated general settings"=>"updated_general_settings",
            "Updated payments settings"=>"updated_payments_settings",
            "Old password incorrect"=>"your_old_password_incorrect",
            "Please enter minimum 5 chars"=>"please_enter_minimum_5_chars",
            "Please enter maximum 10 chars"=>"please_enter_maximum_10_chars",
            "Please enter postal code" => 'please_enter_postal_code',
            "Please select a service" => 'please_select_a_service',
            "Please select units or addons" => 'please_select_units_or_addons',
            "Please select appointment date" => 'please_select_appointment_date',
            "Please accept terms and conditions" => 'please_accept_terms_and_conditions',
            "Incorrect email address or password" => 'incorrect_email_address_or_password',
            "Please enter valid email address" => 'please_enter_valid_email_address',
            "Please enter email address" => 'please_enter_email_address',
            "Please enter password" => 'please_enter_password',
            "Please enter minimum 8 characters" => 'please_enter_minimum_8_characters',
            "Please enter maximum 15 characters" => 'please_enter_maximum_15_characters',
            "Please enter first name" => 'please_enter_first_name',
            "Please enter only alphabets" => 'please_enter_only_alphabets',
            "Please enter minimum 2 characters" => 'please_enter_minimum_2_characters',
            "Please enter last name" => 'please_enter_last_name',
            "Email already exists" => 'email_already_exists',
            "Please enter phone number" => 'please_enter_phone_number',
            "Please enter only numerics" => 'please_enter_only_numerics',
            "Please enter minimum 10 digits" => 'please_enter_minimum_10_digits',
            "Please enter maximum 14 digits" => 'please_enter_maximum_14_digits',
            "Please enter address" => 'please_enter_address',
            "Please enter zip code" => 'please_enter_zip_code',
            "Please enter proper zip code" => 'please_enter_proper_zip_code',
            "Please enter minimum 5 digits" => 'please_enter_minimum_5_digits',
            "Please enter maximum 7 digits" => 'please_enter_maximum_7_digits',
            "Please enter city" => 'please_enter_city',
            "Please enter proper city" => 'please_enter_proper_city',
            "Please enter maximum 48 characters" => 'please_enter_maximum_48_characters',
            "Please enter state" => 'please_enter_state',
            "Please enter proper state" => 'please_enter_proper_state',
            "Please enter contact status" => 'please_enter_contact_status',
            "Please enter maximum 100 characters" => 'please_enter_maximum_100_characters',
            "Your cart is empty please add cleaning services" => 'your_cart_is_empty_please_add_cleaning_services',
            "Please enter Coupon code" => 'please_enter_coupon_code',
            "Coupon expired" => 'coupon_expired',
            "Invalid coupon" => 'invalid_coupon',
            "Our service not available at your location" => 'our_service_not_available_at_your_location',
            "Please enter proper postal code" => 'please_enter_proper_postal_code',
            "Invalid Email ID please register first" => 'invalid_email_id_please_register_first',
            "Your password send successfully at your registered Email ID" => 'your_password_send_successfully_at_your_registered_email_id',
            "Your password reset successfully please login" => 'your_password_reset_successfully_please_login',
            "New password and retype new password mismatch" => 'new_password_and_retype_new_password_mismatch',
            "New"=>'new',
            "for a"=>"for_a",
            "on"=>"on",
            "Your reset password link expired"=>'your_reset_password_link_expired',
            "Front display language changed"=>'front_display_language_changed',
            "Updated front display language and update labels"=>'updated_front_display_language_and_update_labels',
            "Please enter only 7 chars maximum"=>'please_enter_only_7_chars_maximum',
            "Please enter maximum 20 characters"=>'please_enter_maximum_20_chars',
            "Record Inserted Successfully"=>'record_inserted_successfully',
        );

        $admin_labels = array("API Password" => 'api_password',
			"API Username" => 'api_username',
            "APPEARANCE" => 'appearance',
            "Action" => 'action',
            "Actions" => 'actions',
            "Add Break" => 'add_break',
            "Add Breaks" => 'add_breaks',
            "Add Cleaning Service" => 'add_cleaning_service',
            "Add Method" => 'add_method',
            "Add New" => 'add_new',
            "Add Sample Data" => 'add_sample_data',
            "Add Unit" => 'add_unit',
            "Add Your Off Times" => 'add_your_off_times',
            "Add new off time" => 'add_new_off_time',
            "Add-ons" => 'add_ons',
            "AddOns Bookings" => 'addons_bookings',
            "Addon-Service Front View" => 'addon_service_front_view',
            "Addons" => 'addons',
            "Address" => 'address',
            "Admin Email Notifications" => 'admin_email_notifications',
            "All Payment Gateways" => 'all_payment_gateways',
            "All Services" => 'all_services',
            "Allow multiple booking for same timeslot" => 'allow_multiple_booking_for_same_timeslot',
            "Amount" => 'amount',
            "App. Date" => 'app_date',
            "Appearance Settings" => 'appearance_settings',
            "Appointment Completed" => 'appointment_completed',
            "Appointment Details" => 'appointment_details',
            "Appointment Marked As No Show" => 'appointment_marked_as_no_show',
            "Mark As No Show"=>'mark_as_no_show',
            "Appointment Reminder Buffer" => 'appointment_reminder_buffer',
            "Appointment auto confirm" => 'appointment_auto_confirm',
            "Appointments" => 'appointments',
            "Admin Area Color Scheme"=>'admin_area_color_scheme',
            "Thank you page"=>'thankyou_page_url',
            "Addon Title"=>'addon_title',
            "Availabilty" => 'availabilty',
            "Background color" => 'background_color',
            "Behaviour on click of button" => 'behaviour_on_click_of_button',
            "Book Now" => 'book_now',
            "Booking Date & Time" => 'booking_date_and_time',
            "Booking Details" => 'booking_details',
            "Booking Information" => 'booking_information',
            "Booking Serve Date" => 'booking_serve_date',
            "Booking Status" => 'booking_status',
            "Booking notifications" => 'booking_notifications',
            "Bookings" => 'bookings',
            "Button Position" => 'button_position',
            "Button Text" => 'button_text',
            "COMPANY" => 'company',
            "Cannot Cancel Now" => 'cannot_cancel_now',
            "Cannot Reschedule Now" => 'cannot_reschedule_now',
            "Cancel" => 'cancel',
            "Cancellation Buffer Time" => 'cancellation_buffer_time',
            "Cancelled by client" => 'cancelled_by_client',
            "Cancelled by service provider" => 'cancelled_by_service_provider',
            "Change password" => 'change_password',
            "City" => 'city',
            "Cleaning Service" => 'cleaning_service',
            "Client" => 'client',
            "Client Email Notifications" => 'client_email_notifications',
            "Client Name" => 'client_name',
            "Color Scheme" => 'color_scheme',
            "Color Tag" => 'color_tag',
            "Company Address" => 'company_address',
            "Company Email" => 'company_email',
            "Company Logo" => 'company_logo',
            "Company Name" => 'company_name',
            "Company Settings " => 'company_settings',
            "Completed" => 'completed',
            "Confirm" => 'confirm',
            "Confirmed" => 'confirmed',
            "Contact Status" => 'contact_status',
            "Country" => 'country',
            "Country Code (phone)" => 'country_code_phone',
            "Coupon" => 'coupon',
            "Coupon Code" => 'coupon_code',
            "Coupon Limit" => 'coupon_limit',
            "Coupon Type" => 'coupon_type',
            "Coupon Used" => 'coupon_used',
            "Coupon Value" => 'coupon_value',
            "Create Addon Service" => 'create_addon_service',
            "Crop & Save" => 'crop_and_save',
            "Currency" => 'currency',
            "Currency symbol position" => 'currency_symbol_position',
            "Customer" => 'customer',
            "Customer Information" => 'customer_information',
            "Customers" => 'customers',
            "Date & Time" => 'date_and_time',
            "Date-Picker Date Format" => 'date_picker_date_format',
            "Default Design For Addons" => 'default_design_for_addons',
            "Default Design For Methods With Multiple units" => 'default_design_for_methods_with_multiple_units',
            "Default Design For Services" => 'default_design_for_services',
            "Default Setting" => 'default_setting',
            "Delete" => 'delete',
            "Description" => 'description',
            "Discount" => 'discount',
            "Download Invoice" => 'download_invoice',
            "EMAIL NOTIFICATION" => 'email_notification',
            "Email" => 'email',
            "Email Settings" => 'email_settings',
            "Embed Code" => 'embed_code',
            "Enter your email and we will send you instructions on resetting your password." => 'enter_your_email_and_we_will_send_you_instructions_on_resetting_your_password',
            "Expiry Date" => 'expiry_date',
            "Export" => 'export',
            "Export Your Details" => 'export_your_details',
            "FREQUENTLY DISCOUNT" => 'frequently_discount',
            "Frequently Discount" => 'frequently_discount_header',
            "Field is required" => 'field_is_required',
            "File size" => 'file_size',
            "Flat Fee" => 'flat_fee',
            "Flat"=>'flat',
            "Forget Password" => 'forget_password',
            "Freq-Discount" => 'freq_discount',
            "Frequently Discount Label" => 'frequently_discount_label',
            "Frequently Discount Type" => 'frequently_discount_type',
            "Frequently Discount Value" => 'frequently_discount_value',
            "Front Service Box View" => 'front_service_box_view',
            "Front Service Dropdown View" => 'front_service_dropdown_view',
            "Front View Options" => 'front_view_options',
            "Full name" => 'full_name',
            "GENERAL" => 'general',
            "General Settings" => 'general_settings',
            "Get embed code to show booking widget on your website" => 'get_embed_code_to_show_booking_widget_on_your_website',
            "Get the Embeded Code" => 'get_the_embeded_code',
            "Guest Customers" => 'guest_customers',
            "Guest user checkout" => 'guest_user_checkout',
            "Hide faded already booked time slots" => 'hide_faded_already_booked_time_slots',
            "Hostname" => 'hostname',
            "LABELS" => 'labels',
            "Legends" => 'legends',
            "Login" => 'login',
            "Maximum advance booking time" => 'maximum_advance_booking_time',
            "Method" => 'method',
            "Method Name"=>'method_name',
            "Method Title" => 'method_title',
            "Method Unit Quantity" => 'method_unit_quantity',
            "Method Unit Quantity Rate" => 'method_unit_quantity_rate',
            "Method Unit Title" => 'method_unit_title',
            "Method Units Front View " => 'method_units_front_view',
            "Methods" => 'methods',
            "Methods Booking" => 'methods_booking',
            "Methods Bookings" => 'methods_bookings',
            "Minimum advance booking time" => 'minimum_advance_booking_time',
            "More" => 'more',
            "More Details" => 'more_details',
            "My Appointments" => 'my_appointments',
            "Name" => 'name',
            "Net Total" => 'net_total',
            "New Password" => 'new_password',
            "Notes" => 'notes',
            "Off Days" => 'off_days',
            "Off Time" => 'off_time',
            "Old Password" => 'old_password',
            "Online booking Button Style" => 'online_booking_button_style',
            "Open widget in a new page" => 'open_widget_in_a_new_page',
            "Order" => 'order',
            "Order Date" => 'order_date',
            "Order Time" => 'order_time',
            "PAYMENT" => 'payments_setting',
            "PROMOCODE" => 'promocode',
            "Promocode" => 'promocode_header',
            "Padding Time Before" => 'padding_time_before',
            "Parking" => 'parking',
            "Partial Amount" => 'partial_amount',
            "Partial Deposit" => 'partial_deposit',
            "Partial Deposit Amount" => 'partial_deposit_amount',
            "Partial Deposit Message" => 'partial_deposit_message',
            "Password" => 'password',
            "Pay locally" => 'pay_locally',
            "Payment" => 'payment',
            "Payment Date" => 'payment_date',
            "Payment Gateways" => 'payment_gateways',
            "Payment Method" => 'payment_method',
            "Payments" => 'payments',
            "Payments History Details" => 'payments_history_details',
            "Paypal Express Checkout" => 'paypal_express_checkout',
            "Paypal guest payment" => 'paypal_guest_payment',
            "Pending" => 'pending',
            "Percentage" => 'percentage',
            "Personal Information" => 'personal_information',
            "Phone" => 'phone',
            "Please Copy above code and paste in your website." => 'please_copy_above_code_and_paste_in_your_website',
            "Please Enable Payment Gateway" => 'please_enable_payment_gateway',
            "Please Set Below Values" => 'please_set_below_values',
            "Port" => 'port',
            "Postal Codes" => 'postal_codes',
            "Price" => 'price',
            "Price calculation method" => 'price_calculation_method',
            "Price format decimal Places" => 'price_format_decimal_places',
            "Pricing" => 'pricing',
            "Primary Color" => 'primary_color',
            "Privacy Policy" => 'privacy_policy',
            "Profile" => 'profile',
            "Promocodes" => 'promocodes',
            "Promocodes list" => 'promocodes_list',
            "Registered Customers" => 'registered_customers',
            "Registered Customers Bookings" => 'registered_customers_bookings',
            "Reject" => 'reject',
            "Rejected" => 'rejected',
            "Remember Me" => 'remember_me',
            "Remove Sample Data" => 'remove_sample_data',
            "Reschedule" => 'reschedule',
            "Rescheduled" => 'rescheduled',
            "Reset" => 'reset',
            "Reset Password" => 'reset_password',
            "Reshedule Buffer Time" => 'reshedule_buffer_time',
            "Retype New Password" => 'retype_new_password',
            "Right Side Description" => 'right_side_description',
            "Save" => 'save',
            "Save Availability" => 'save_availability',
            "Save Setting" => 'save_setting',
            "Save Labels Setting"=>'save_labels_setting',
            "Schedule" => 'schedule',
            "Schedule Type" => 'schedule_type',
            "Secondary color" => 'secondary_color',
            "Select Language for update" => 'select_language_for_update',
            "Select language to change label" => 'select_language_to_change_label',
            "Select language to display" => 'select_language_to_display',
            "Display Sub_Headers Below Headers"=>'display_sub_headers_below_headers',
            "Select payment option export details" => 'select_payment_option_export_details',
            "Send Mail" => 'send_mail',
            "Sender Email Address (Cleanto Admin Email)" => 'sender_email_address_cleanto_admin_email',
            "Sender Name" => 'sender_name',
            "Service" => 'service',
            "Service Add-ons Front Block View" => 'service_add_ons_front_block_view',
            "Service Add-ons Front Increase/Decrease View" => 'service_add_ons_front_increase_decrease_view',
            "Service Description" => 'service_description',
            "Service Front View" => 'service_front_view',
            "Service Image" => 'service_image',
            "Service Methods" => 'service_methods',
            "Service Padding Time After" => 'service_padding_time_after',
            "Padding Time After"=>'padding_time_after',
            "Service Padding Time Before" => 'service_padding_time_before',
            "Service Quantity" => 'service_quantity',
            "Service Rate" => 'service_rate',
            "Service Title" => 'service_title',
            "ServiceAddOns Name" => 'serviceaddons_name',
            "Services" => 'services',
            "Services Information" => 'services_information',
            "Set Email Reminder Buffer" => 'set_email_reminder_buffer',
            "Set Language" => 'set_language',
            "Settings" => 'settings',
            "Show All Bookings" => 'show_all_bookings',
            "Show button on given embeded position" => 'show_button_on_given_embeded_position',
            "Show coupons input on checkout" => 'show_coupons_input_on_checkout',
            "Show on a button click" => 'show_on_a_button_click',
            "Show on page load" => 'show_on_page_load',
            "Signature" => 'signature',
            "Sorry Wrong Email Or Password" => 'sorry_wrong_email_or_password',
            "Start Date" => 'start_date',
            "State" => 'state',
            "Status" => 'status',
            "Submit" => 'submit',
            "Tax" => 'tax',
            "Test Mode" => 'test_mode',
            "Text color" => 'text_color',
            "Text Color on bg"=>'text_color_on_bg',
            "Terms & Condition Link"=>'terms_and_condition_link',
            "This Week Breaks" => 'this_week_breaks',
            "This Week Time Scheduling" => 'this_week_time_scheduling',
            "Time Format" => 'time_format',
            "Time Interval" => 'time_interval',
            "TimeZone" => 'timezone',
            "Units" => 'units',
            "Unit Name"=>'unit_name',
            "Units Of Methods" => 'units_of_methods',
            "Update" => 'update',
            "Update Appointment" => 'update_appointment',
            "Update Promocode" => 'update_promocode',
            "Username" => 'username',
            "Vaccum-Cleaner" => 'vaccum_cleaner',
            "View Slots By?" => 'view_slots_by',
            "Week" => 'week',
            "Week Breaks" => 'week_breaks',
            "Week Time Scheduling" => 'week_time_scheduling',
            "Widget Loading style" => 'widget_loading_style',
            "Yes" => 'yes',
            "Zip" => 'zip',
            "logout" => 'logout',
            "to" => 'to',
            "Add New Promocode" => 'add_new_promocode',
            "Create" => 'create',
            "End Date" => 'end_date',
            "End Time" => 'end_time',
            "Expiry Date" => 'expiry_date',
            "Labels Settings" => 'labels_settings',
            "Limit" => 'limit',
            "Max Limit"=>"max_limit",
            "Start Time" => 'start_time',
            "Value" => 'value',
            "Active"=>'active');

        $front_labels = array("My Bookings" => 'my_bookings',
            "Your Postal Code" => 'your_postal_code',
            "Where would you like us to provide service?" => 'where_would_you_like_us_to_provide_service',
            "Choose service" => 'choose_service',
            "How often would you like us provide service?" => 'how_often_would_you_like_us_provide_service',
            "When would you like us to come?" => 'when_would_you_like_us_to_come',
            "TODAY" => 'today',
            "Your Personal Details" => 'your_personal_details',
            "Existing User" => 'existing_user',
            "New User" => 'new_user',
            "Preferred Email" => 'preferred_email',
            "Preferred Password" => 'preferred_password',
            "Your valid email address" => 'your_valid_email_address',
            "Password" => 'password',
            "First Name" => 'first_name',
            "Your First Name" => 'your_first_name',
            "Last Name" => 'last_name',
            "Your Last Name " => 'your_last_name',
            "Phone" => 'phone',
            "Street Address" => 'street_address',
            "Cleaning Service" => 'cleaning_service',
            "Please Select Method" => 'please_select_method',
            "Zip Code" => 'zip_code',
            "City" => 'city',
            "State" => 'state',
            "Special requests ( Notes )" => 'special_requests_notes',
            "Do you have a vacuum cleaner?" => 'do_you_have_a_vaccum_cleaner',
            "Yes" => 'yes',
            "No" => 'no',
            "Preferred Payment Method" => 'preferred_payment_method',
            "Please select one payment method" => 'please_select_one_payment_method',
            "Pay Locally" => 'pay_locally',
            "Partial Deposit" => 'partial_deposit',
            "Remaining Amount" => 'remaining_amount',
            "Please read our terms and conditions carefully" => 'please_read_our_terms_and_conditions_carefully',
            "Do you have parking?" => 'do_you_have_parking',
            "How will we get in?" => 'how_will_we_get_in',
            "I'll be at home" => 'i_will_be_at_home',
            "Please call me" => 'please_call_me',
            "Recurring discounts apply from the second cleaning onward." => 'recurring_discounts_apply_from_the_second_cleaning_onward',
            "Please provide your address and contact details" => 'please_provide_your_address_and_contact_details',
            "You are logged in as" => 'you_are_logged_in_as',
            "The key is with the doorman" => 'the_key_is_with_the_doorman',
            "Other" => 'other',
            "Have a promocode?" => 'have_a_promocode',
            "Apply" => 'apply',
            "Applied Promocode" => 'applied_promocode',
            "Complete Booking" => 'complete_booking',
            "CANCELLATION POLICY" => 'cancellation_policy',
            "Cancellation Policy Header"=>"cancellation_policy_header",
            "Cancellation Policy Textarea"=>"cancellation_policy_textarea",
            "Free cancellation before redemption" => 'free_cancellation_before_redemption',
            "Show More" => 'show_more',
            "Please Select Service" => 'please_select_service',
            "Choose your service and property size" => 'choose_your_service_and_property_size',
            "Please configure first Cleaning Services and settings in admin panel" => 'please_configure_first_cleaning_services_and_settings_in_admin_panel',
            "I have read and accepted the " => 'i_have_read_and_accepted_the',
            "Terms & Conditions" => 'terms_conditions',
            "Terms & Conditions" => 'terms_and_condition',
            "and" => 'and',
            'Updated labels'=>'updated_labels',
            "Privacy Policy" => 'privacy_policy',
            "Please Fill all the Company Informations and add some Services and Addons"=>'please_fill_all_the_company_informations_and_add_some_services_and_addons',
            "Booking Summary" => 'booking_summary',
            "Your Email" => 'your_email',
            "Enter Email to Login" => 'enter_email_to_login',
            "Your Password" => 'your_password',
            "Enter your Password" => 'enter_your_password',
            "Forget Password?" => 'forget_password',
            "Reset Password" => 'reset_password',
            "Enter your email and we'll send you instructions on resetting your password." => 'enter_your_email_and_we_send_you_instructions_on_resetting_your_password',
            "Registered Email" => 'registered_email',
            "Send Mail" => 'send_mail',
            "Back to Login" => 'back_to_login',
            "Your" => 'your',
            "Your clean items" => 'your_clean_items',
            "Your cart is empty" => 'your_cart_is_empty',
            "Sub TotalTax" => 'sub_totaltax',
            "Sub Total"=>"sub_total",
            "No data available in table"=>'no_data_available_in_table',
            "Total" => 'total',
            "Or"=>'or',
            "Select addon image"=>"select_addon_image",
            "Inside Fridge"=>'inside_fridge',
            "Inside Oven"=>"inside_oven",
            "Inside Windows"=>"inside_windows",
            "Carpet Cleaning"=>"carpet_cleaning",
            "Green Cleaning"=>"green_cleaning",
            "Pets Care"=>"pets_care",
            "Tiles Cleaning"=>"tiles_cleaning",
            "Wall Cleaning"=>"wall_cleaning",
            "Laundry"=>"laundry",
            "Basement Cleaning"=>"basement_cleaning",
            "Basic Price"=>'basic_price',
            "Max Qty"=>'max_qty',
            "Multiple Qty"=>'multiple_qty',
            "Base Price"=>'base_price',
            "Unit Pricing"=>'unit_pricing',
            "Method is booked"=>'method_is_booked',
            "Service Addons price rules"=>'service_addons_price_rules',
            "Service Unit Front DropDown View"=>'service_unit_front_dropdown_view',
            "Service Unit Front Block View"=>'service_unit_front_block_view',
            "Service Unit Front Increase/Decrease View"=>'service_unit_front_increase_decrease_view',
            "Are You Sure"=>'are_you_sure',
            "Service Unit price rules"=>'service_unit_price_rules',
            "Close"=>'close',
            "Closed"=>'closed',
            "Service Addons"=>'service_addons',
            "Service Enable"=>'service_enable',
            "Service Disable"=>'service_disable',
            "Method Enable"=>'method_enable',
            "Off Time Deleted"=>'off_time_deleted',
            "Error in Delete of Off Time"=>"error_in_delete_of_off_time",
            "Method Disable"=>'method_disable',
            "Extra Services" => 'extra_services',
            "For initial cleaning only. Contact us to apply to recurrings." => 'for_initial_cleaning_only_contact_us_to_apply_to_recurrings',
            "Number of" => 'number_of',
            "Extra Services Not Available" => 'extra_services_not_available',
            "Available"=>"available",
            "Selected"=>"selected",
            "Not Available"=>"not_available",
            "None"=>'none',
            "None of time slot available Please check another dates"=>"none_of_time_slot_available_please_check_another_dates",
            "Availability is not configured from admin side"=>"availability_is_not_configured_from_admin_side",
            "How many Intensive" => 'how_many_intensive',
            "No Intensive" => 'no_intensive',
            "Frequently Discount" => 'frequently_discount',
            "Coupon Discount" => 'coupon_discount',
            "How many" => 'how_many',
            "Enter your Other option" => 'enter_your_other_option',
            "Log Out" => 'log_out',
            "Your Added Off Times"=>'your_added_off_times',
            "Log In" => 'log_in',
            "Custom Css"=>'custom_css',
            "Success"=>'success',
            "Failure"=>'failure',
            "You can only use valid zipcode"=>'you_can_only_use_valid_zipcode',
            "Minutes"=>"minutes",
            "Hours"=>'hours',
            "Days"=>"days",
            "Months"=>"months",
            "Year"=>"year",
            "Default url is"=>"default_url_is",
            "Card payment"=>"card_payment",
            "Card details"=>"card_details",
            "Card number"=>"card_number",
            "Invalid card number"=>"invalid_card_number",
            "Expiry"=>"expiry",
            "Button Preview"=>"button_preview",
            "Thankyou"=>"thankyou",
            "Thankyou! for booking appointment"=>"thankyou_for_booking_appointment",
            "You will be notified by email with details of appointment"=>"you_will_be_notified_by_email_with_details_of_appointment",
			"Please enter firstname"=>"please_enter_firstname",
			"Please enter lastname"=>"please_enter_lastname",
			"Choose Your Service"=>"choose_your_service",
			"Choose Your"=>"choose_your");

        $language = array();


        foreach ($front_labels as $key => $value) {
            $language[$value] = $key;
        }
        foreach ($errors as $key => $value) {
            $language[$value] = $key;
        }
        foreach ($admin_labels as $key => $value) {
            $language[$value] = $key;
        }
        foreach ($admin_labels as $key => $value) {
            $language[$value] = $key;
        }

        $languagearr = base64_encode(serialize($language));

        $insert_default_lang = "insert into `ct_languages` (`id`,`label_data`,`language`) values(NULL,'" . $languagearr . "','en')";
        mysqli_query($this->conn, $insert_default_lang);
    }
    public function update1_2()
	{

		/*  new version update */
		$remove_fk_constraints_ct_services_addon = "ALTER TABLE `ct_services_addon`
DROP FOREIGN KEY `services_addon_ibfk_1`;";
		$remove_fk_constraints_ct_services_addon_rate = "ALTER TABLE `ct_addon_service_rate`
DROP FOREIGN KEY `addon_service_rate_ibfk_1`;";
		$remove_fk_constraints_ct_services_method = "ALTER TABLE `ct_services_method`
DROP FOREIGN KEY `services_method_ibfk_1`;";
		$remove_fk_constraints_ct_service_methods_units = "ALTER TABLE `ct_service_methods_units`
DROP FOREIGN KEY `service_methods_units_ibfk_1`;";
		$remove_fk_constraints_ct_service_methods_units_2 = "ALTER TABLE `ct_service_methods_units`
DROP FOREIGN KEY `service_methods_units_ibfk_2`;";
		$remove_fk_constraints_ct_services_methods_units_rate = "ALTER TABLE `ct_services_methods_units_rate`
DROP FOREIGN KEY `services_methods_units_rate_ibfk_1`;";
		$remove_fk_constraints_ct_service_methods_design = "ALTER TABLE `ct_service_methods_design`
DROP FOREIGN KEY `service_methods_design_ibfk_1`;";
		mysqli_query($this->conn,$remove_fk_constraints_ct_services_addon);
        mysqli_query($this->conn,$remove_fk_constraints_ct_services_addon_rate);
		mysqli_query($this->conn,$remove_fk_constraints_ct_services_method);
		mysqli_query($this->conn,$remove_fk_constraints_ct_service_methods_units);
        mysqli_query($this->conn,$remove_fk_constraints_ct_service_methods_units_2);
        mysqli_query($this->conn,$remove_fk_constraints_ct_services_methods_units_rate);
        mysqli_query($this->conn,$remove_fk_constraints_ct_service_methods_design);
		
		/* Update the oprion in settings */
		 $add_options = "UPDATE `ct_settings` SET `option_value` = '+1,us,United States: +1' WHERE `option_name` = 'ct_company_country_code';";
        mysqli_query($this->conn,$add_options);
		
		
		 /* alter table add new field in addons */
        $add_options = "ALTER TABLE `ct_services_addon` ADD `predefine_image_title` TEXT NOT NULL";
        mysqli_query($this->conn,$add_options);

        $errors = array(
            "Atleast one payment method should be enable"=>"atleast_one_payment_method_should_be_enable",
            "Appointment booking confirm"=>"appointment_booking_confirm",
            "Appointment booking rejected"=>"appointment_booking_rejected",
            "Boooking Cancelled"=>"booking_cancel",
            "Appointment marked as no show"=>"appointment_marked_as_no_show",
            "Appointment Reschedules successfully"=>"appointment_reschedules_successfully",
            "Booking Deleted"=>"booking_deleted",
            "Break End Time should be greater than Start time"=>"break_end_time_should_be_greater_than_start_time",
            "Cancel by client"=>"cancel_by_client",
            "Cancelled by service provider"=>"cancelled_by_service_provider",
            "Confirmed"=>"confirmed",
            "Design set successfully"=>"design_set_successfully",
            "End break time updated"=>"end_break_time_updated",
            "Enter alphabets only"=>"enter_alphabets_only",
            "Enter only alphabets"=>"enter_only_alphabets",
            "Enter only Alphabets/Numbers"=>"enter_only_alphabets_numbers",
            "Enter only Digits"=>"enter_only_digits",
            "Enter valid Url"=>"enter_valid_url",
            "Enter only numeric"=>"enter_only_numeric",
            "Enter proper country code"=>"enter_proper_country_code",
            "Frequently discount status updated"=>"frequently_discount_status_updated",
            "Frequently discount updated"=>"frequently_discount_updated",
            "Manage addons service"=>"manage_addons_service",
            "Maximum file upload size 2 MB"=>"maximum_file_upload_size_2_mb",
            "Method deleted successfully"=>"method_deleted_successfully",
            "Method inserted successfully"=>"method_inserted_successfully",
            "Minimum file upload size 10 KB"=>"minimum_file_upload_size_10_kb",
            "Off time added successfully"=>"off_time_added_successfully",
            "Only jpeg, png and gif images Allowed"=>"only_jpeg_png_and_gif_images_allowed",
            "Password must be 8 character long"=>"password_must_be_8_character_long",
            "Password should not exist more then 20 characters"=>"password_should_not_exist_more_then_20_characters",
            "Pending"=>"pending",
            "Please assign base price for unit"=>"please_assign_base_price_for_unit",
            "Please assign price"=>"please_assign_price",
            "Please assign quantity"=>"please_assign_qty",
            "Please enter API Password"=>"please_enter_api_password",
            "Please enter API Username"=>"please_enter_api_username",
            "Please enter Color Code"=>"please_enter_color_code",
            "Please enter country"=>"please_enter_country",
            "Please enter coupon limit"=>"please_enter_coupon_limit",
            "Please enter coupon value"=>"please_enter_coupon_value",
            "Please enter coupon code"=>"please_enter_coupon_code",
            "Please enter email"=>"please_enter_email",
            "Please enter Fullname"=>"please_enter_fullname",
            "Please enter maxLimit"=>"please_enter_maxlimit",
            "Please enter method title"=>"please_enter_method_title",
            "Please enter name"=>"please_enter_name",
            "Please enter only numeric"=>"please_enter_only_numeric",
            "Please enter proper base price"=>"please_enter_proper_base_price",
            "Please enter proper name"=>"please_enter_proper_name",
            "Please enter proper title"=>"please_enter_proper_title",
            "Please enter publishable key"=>"please_enter_publishable_key",
            "Please enter secret key"=>"please_enter_secret_key",
            "Please enter service Title"=>"please_enter_service_title",
            "Please enter signature"=>"please_enter_signature",
            "Please enter some quantity"=>"please_enter_some_qty",
            "Please enter title"=>"please_enter_title",
            "Please enter unit title"=>"please_enter_unit_title",
            "Please enter valid country code"=>"please_enter_valid_country_code",
            "Please enter valid service title"=>"please_enter_valid_service_title",
            "Please enter valid price"=>"please_enter_valid_price",
            "Please enter zipcode"=>"please_enter_zipcode",
            "Please enter state"=>"please_enter_state",
            "Please retype correct password"=>"please_retype_correct_password",
            "Please select porper time slots"=>"please_select_porper_time_slots",
            "Please select time between day availability time"=>"please_select_time_between_day_availability_time",
            "Please valid value for discount"=>"please_valid_value_for_discount",
            "Please enter confirm password"=>"please_enter_confirm_password",
            "Please enter new password"=>"please_enter_new_password",
            "Please enter old password"=>"please_enter_old_password",
            "Please enter only numeric"=>"please_enter_only_numeric",
            "Please enter valid number"=>"please_enter_valid_number",
            "Please enter valid number with country code"=>"please_enter_valid_number_with_country_code",
            "Please select end time greater than start time"=>"please_select_end_time_greater_than_start_time",
            "Please select end time less than start time"=>"please_select_end_time_less_than_start_time",
            "Please select a crop region and then press upload"=>"please_select_a_crop_region_and_then_press_upload",
            "Please select a valid image file jpg and png are allowed"=>"please_select_a_valid_image_file_jpg_and_png_are_allowed",
            "Profile updated successfully"=>"profile_updated_successfully",
            "Quantity rule deleted"=>"qty_rule_deleted",
            "Record deleted successfully"=>"record_deleted_successfully",
            "Record updated successfully"=>"record_updated_successfully",
            "Rejected"=>"rejected",
            "Rescheduled"=>"rescheduled",
            "Schedule updated to Monthly"=>"schedule_updated_to_monthly",
            "Schedule updated to Weekly"=>"schedule_updated_to_weekly",
            "Sorry method already exist"=>"sorry_method_already_exist",
            "Sorry no notification"=>"sorry_no_notification",
            "Sorry promocode already exist"=>"sorry_promocode_already_exist",
            "Sorry unit already exist"=>"sorry_unit_already_exist",
            "Sorry we are not available"=>"sorry_we_are_not_available",
            "Start break time updated"=>"start_break_time_updated",
            "Status updated"=>"status_updated",
            "Time slots updated successfully"=>"time_slots_updated_successfully",
            "Unit inserted successfully"=>"unit_inserted_successfully",
            "Units status updated"=>"units_status_updated",
            "Updated appearance aettings"=>"updated_appearance_settings",
            "Updated company details"=>"updated_company_details",
            "Updated E-mail settings"=>"updated_email_settings",
            "Updated general settings"=>"updated_general_settings",
            "Updated payments settings"=>"updated_payments_settings",
            "Old password incorrect"=>"your_old_password_incorrect",
            "Please enter minimum 5 chars"=>"please_enter_minimum_5_chars",
            "Please enter maximum 10 chars"=>"please_enter_maximum_10_chars",
            "Please enter postal code" => 'please_enter_postal_code',

            "Please select a service" => 'please_select_a_service',
            "Please select units or addons" => 'please_select_units_or_addons',
            "Please select units and addons" => 'please_select_units_and_addons',
            "Please select appointment date" => 'please_select_appointment_date',
            "Please accept terms and conditions" => 'please_accept_terms_and_conditions',
            "Incorrect email address or password" => 'incorrect_email_address_or_password',
            "Please enter valid email address" => 'please_enter_valid_email_address',
            "Please enter email address" => 'please_enter_email_address',
            "Please enter password" => 'please_enter_password',
            "Please enter minimum 8 characters" => 'please_enter_minimum_8_characters',
            "Please enter maximum 15 characters" => 'please_enter_maximum_15_characters',
            "Please enter first name" => 'please_enter_first_name',
            "Please enter only alphabets" => 'please_enter_only_alphabets',
            "Please enter minimum 2 characters" => 'please_enter_minimum_2_characters',
            "Please enter last name" => 'please_enter_last_name',
            "Email already exists" => 'email_already_exists',
            "Please enter phone number" => 'please_enter_phone_number',
            "Please enter only numerics" => 'please_enter_only_numerics',
            "Please enter minimum 10 digits" => 'please_enter_minimum_10_digits',
            "Please enter maximum 14 digits" => 'please_enter_maximum_14_digits',
            "Please enter address" => 'please_enter_address',
            "Please enter zip code" => 'please_enter_zip_code',
            "Please enter proper zip code" => 'please_enter_proper_zip_code',
            "Please enter minimum 5 digits" => 'please_enter_minimum_5_digits',
            "Please enter maximum 7 digits" => 'please_enter_maximum_7_digits',
            "Please enter city" => 'please_enter_city',
            "Please enter proper city" => 'please_enter_proper_city',
            "Please enter maximum 48 characters" => 'please_enter_maximum_48_characters',
            "Please enter state" => 'please_enter_state',
            "Please enter proper state" => 'please_enter_proper_state',
            "Please enter contact status" => 'please_enter_contact_status',
            "Please enter maximum 100 characters" => 'please_enter_maximum_100_characters',
            "Your cart is empty please add cleaning services" => 'your_cart_is_empty_please_add_cleaning_services',
            "Please enter Coupon code" => 'please_enter_coupon_code',
            "Coupon expired" => 'coupon_expired',
            "Invalid coupon" => 'invalid_coupon',
            "Our service not available at your location" => 'our_service_not_available_at_your_location',
            "Please enter proper postal code" => 'please_enter_proper_postal_code',
            "Invalid Email ID please register first" => 'invalid_email_id_please_register_first',
            "Your password send successfully at your registered Email ID" => 'your_password_send_successfully_at_your_registered_email_id',
            "Your password reset successfully please login" => 'your_password_reset_successfully_please_login',
            "New password and retype new password mismatch" => 'new_password_and_retype_new_password_mismatch',
            "New"=>'new',
            "for a"=>"for_a",
            "on"=>"on",
            "Your reset password link expired"=>'your_reset_password_link_expired',
            "Front display language changed"=>'front_display_language_changed',
            "Updated front display language and update labels"=>'updated_front_display_language_and_update_labels',
            "Please enter only 7 chars maximum"=>'please_enter_only_7_chars_maximum',
            "Please enter maximum 20 characters"=>'please_enter_maximum_20_chars',
            "Record Inserted Successfully"=>'record_inserted_successfully',
        );

        $admin_labels = array(
            "Frontend Labels"=>"frontend_labels",
            "Admin Labels"=>"admin_labels",
            "Errors"=>"errors",
            "Extra Labels"=>"extra_labels",
            "API Password" => 'api_password',
            "API Username" => 'api_username',
            "APPEARANCE" => 'appearance',
            "Action" => 'action',
            "Actions" => 'actions',
            "Add Break" => 'add_break',
            "Add Breaks" => 'add_breaks',
            "Add Cleaning Service" => 'add_cleaning_service',
            "Add Method" => 'add_method',
            "Add New" => 'add_new',
            "Add Sample Data" => 'add_sample_data',
            "Add Unit" => 'add_unit',
            "Add Your Off Times" => 'add_your_off_times',
            "Add new off time" => 'add_new_off_time',
            "Add-ons" => 'add_ons',
            "AddOns Bookings" => 'addons_bookings',
            "Addon-Service Front View" => 'addon_service_front_view',
            "Addons" => 'addons',
            "Address" => 'address',
            "Admin Email Notifications" => 'admin_email_notifications',
            "All Payment Gateways" => 'all_payment_gateways',
            "All Services" => 'all_services',
            "Allow Multiple Booking For Same Timeslot" => 'allow_multiple_booking_for_same_timeslot',
            "Amount" => 'amount',
            "App. Date" => 'app_date',
            "Appearance Settings" => 'appearance_settings',
            "Appointment Completed" => 'appointment_completed',
            "Appointment Details" => 'appointment_details',
            "Appointment Marked As No Show" => 'appointment_marked_as_no_show',
            "Mark As No Show"=>'mark_as_no_show',
            "Appointment Reminder Buffer" => 'appointment_reminder_buffer',
            "Appointment auto confirm" => 'appointment_auto_confirm',
            "Appointments" => 'appointments',
            "Admin Area Color Scheme"=>'admin_area_color_scheme',
            "Thankyou Page URL"=>'thankyou_page_url',
            "Addon Title"=>'addon_title',
            "Availabilty" => 'availabilty',
            "Background color" => 'background_color',
            "Behaviour on click of button" => 'behaviour_on_click_of_button',
            "Book Now" => 'book_now',
            "Booking Date & Time" => 'booking_date_and_time',
            "Booking Details" => 'booking_details',
            "Booking Information" => 'booking_information',
            "Booking Serve Date" => 'booking_serve_date',
            "Booking Status" => 'booking_status',
            "Booking notifications" => 'booking_notifications',
            "Bookings" => 'bookings',
            "Button Position" => 'button_position',
            "Button Text" => 'button_text',
            "COMPANY" => 'company',
            "Cannot Cancel Now" => 'cannot_cancel_now',
            "Cannot Reschedule Now" => 'cannot_reschedule_now',
            "Cancel" => 'cancel',
            "Cancellation Buffer Time" => 'cancellation_buffer_time',
            "Cancelled by client" => 'cancelled_by_client',
            "Cancelled by service provider" => 'cancelled_by_service_provider',
            "Change password" => 'change_password',
            "City" => 'city',
            "Cleaning Service" => 'cleaning_service',
            "Client" => 'client',
            "Client Email Notifications" => 'client_email_notifications',
            "Client Name" => 'client_name',
            "Color Scheme" => 'color_scheme',
            "Color Tag" => 'color_tag',
            "Address" => 'company_address',
            "Email" => 'company_email',
            "Company Logo" => 'company_logo',
            "Business Name" => 'company_name',
            "Business Info Settings " => 'company_settings',
            "Completed" => 'completed',
            "Confirm" => 'confirm',
            "Confirmed" => 'confirmed',
            "Contact Status" => 'contact_status',
            "Country" => 'country',
            "Country Code (phone)" => 'country_code_phone',
            "Coupon" => 'coupon',
            "Coupon Code" => 'coupon_code',
            "Coupon Limit" => 'coupon_limit',
            "Coupon Type" => 'coupon_type',
            "Coupon Used" => 'coupon_used',
            "Coupon Value" => 'coupon_value',
            "Create Addon Service" => 'create_addon_service',
            "Crop & Save" => 'crop_and_save',
            "Currency" => 'currency',
            "Currency Symbol Position" => 'currency_symbol_position',
            "Customer" => 'customer',
            "Customer Information" => 'customer_information',
            "Customers" => 'customers',
            "Date & Time" => 'date_and_time',
            "Date-Picker Date Format" => 'date_picker_date_format',
            "Default Design For Addons" => 'default_design_for_addons',
            "Default Design For Methods With Multiple units" => 'default_design_for_methods_with_multiple_units',
            "Default Design For Services" => 'default_design_for_services',
            "Default Setting" => 'default_setting',
            "Delete" => 'delete',
            "Description" => 'description',
            "Discount" => 'discount',
            "Download Invoice" => 'download_invoice',
            "EMAIL NOTIFICATION" => 'email_notification',
            "Email" => 'email',
            "Email Settings" => 'email_settings',
            "Embed Code" => 'embed_code',
            "Enter your email and we will send you instructions on resetting your password." => 'enter_your_email_and_we_will_send_you_instructions_on_resetting_your_password',
            "Expiry Date" => 'expiry_date',
            "Export" => 'export',
            "Export Your Details" => 'export_your_details',
            "FREQUENTLY DISCOUNT" => 'frequently_discount',
            "Frequently Discount" => 'frequently_discount_header',
            "Field is required" => 'field_is_required',
            "File size" => 'file_size',
            "Flat Fee" => 'flat_fee',
            "Flat"=>'flat',
            "Forget Password" => 'forget_password',
            "Freq-Discount" => 'freq_discount',
            "Frequently Discount Label" => 'frequently_discount_label',
            "Frequently Discount Type" => 'frequently_discount_type',
            "Frequently Discount Value" => 'frequently_discount_value',
            "Front Service Box View" => 'front_service_box_view',
            "Front Service Dropdown View" => 'front_service_dropdown_view',
            "Front View Options" => 'front_view_options',
            "Full name" => 'full_name',
            "GENERAL" => 'general',
            "General Settings" => 'general_settings',
            "Get embed code to show booking widget on your website" => 'get_embed_code_to_show_booking_widget_on_your_website',
            "Get the Embeded Code" => 'get_the_embeded_code',
            "Guest Customers" => 'guest_customers',
            "Guest user checkout" => 'guest_user_checkout',
            "Hide faded already booked time slots" => 'hide_faded_already_booked_time_slots',
            "Hostname" => 'hostname',
            "LABELS" => 'labels',
            "Legends" => 'legends',
            "Login" => 'login',
            "Maximum advance booking time" => 'maximum_advance_booking_time',
            "Method" => 'method',
            "Method Name"=>'method_name',
            "Method Title" => 'method_title',
            "Method Unit Quantity" => 'method_unit_quantity',
            "Method Unit Quantity Rate" => 'method_unit_quantity_rate',
            "Method Unit Title" => 'method_unit_title',
            "Method Units Front View " => 'method_units_front_view',
            "Methods" => 'methods',
            "Methods Booking" => 'methods_booking',
            "Methods Bookings" => 'methods_bookings',
            "Minimum advance booking time" => 'minimum_advance_booking_time',
            "More" => 'more',
            "More Details" => 'more_details',
            "My Appointments" => 'my_appointments',
            "Name" => 'name',
            "Net Total" => 'net_total',
            "New Password" => 'new_password',
            "Notes" => 'notes',
            "Off Days" => 'off_days',
            "Off Time" => 'off_time',
            "Old Password" => 'old_password',
            "Online booking Button Style" => 'online_booking_button_style',
            "Open widget in a new page" => 'open_widget_in_a_new_page',
            "Order" => 'order',
            "Order Date" => 'order_date',
            "Order Time" => 'order_time',
            "PAYMENT" => 'payments_setting',
            "PROMOCODE" => 'promocode',
            "Promocode" => 'promocode_header',
            "Padding Time Before" => 'padding_time_before',
            "Parking" => 'parking',
            "Partial Amount" => 'partial_amount',
            "Partial Deposit" => 'partial_deposit',
            "Partial Deposit Amount" => 'partial_deposit_amount',
            "Partial Deposit Message" => 'partial_deposit_message',
            "Password" => 'password',
            "Pay locally" => 'pay_locally',
            "Payment" => 'payment',
            "Payment Date" => 'payment_date',
            "Payment Gateways" => 'payment_gateways',
            "Payment Method" => 'payment_method',
            "Payments" => 'payments',
            "Payments History Details" => 'payments_history_details',
            "Paypal Express Checkout" => 'paypal_express_checkout',
            "Paypal guest payment" => 'paypal_guest_payment',
            "Pending" => 'pending',
            "Percentage" => 'percentage',
            "Personal Information" => 'personal_information',
            "Phone" => 'phone',
            "Please Copy above code and paste in your website." => 'please_copy_above_code_and_paste_in_your_website',
            "Please Enable Payment Gateway" => 'please_enable_payment_gateway',
            "Please Set Below Values" => 'please_set_below_values',
            "Port" => 'port',
            "Postal Codes" => 'postal_codes',
            "Price" => 'price',
            "Price calculation method" => 'price_calculation_method',
            "Price format" => 'price_format_decimal_places',
            "Pricing" => 'pricing',
            "Primary Color" => 'primary_color',
            "Privacy Policy Link" => 'privacy_policy',
            "Profile" => 'profile',
            "Promocodes" => 'promocodes',
            "Promocodes list" => 'promocodes_list',
            "Registered Customers" => 'registered_customers',
            "Registered Customers Bookings" => 'registered_customers_bookings',
            "Reject" => 'reject',
            "Rejected" => 'rejected',
            "Remember Me" => 'remember_me',
            "Remove Sample Data" => 'remove_sample_data',
            "Reschedule" => 'reschedule',
            "Rescheduled" => 'rescheduled',
            "Reset" => 'reset',
            "Reset Password" => 'reset_password',
            "Reshedule Buffer Time" => 'reshedule_buffer_time',
            "Retype New Password" => 'retype_new_password',
            "Booking Page Rightside Description" => 'right_side_description',
            "Save" => 'save',
            "Save Availability" => 'save_availability',
            "Save Setting" => 'save_setting',
            "Save Labels Setting"=>'save_labels_setting',
            "Schedule" => 'schedule',
            "Schedule Type" => 'schedule_type',
            "Secondary color" => 'secondary_color',
            "Select Language for update" => 'select_language_for_update',
            "Select language to change label" => 'select_language_to_change_label',
            "Language" => 'select_language_to_display',
            "Sub Headings on Booking page "=>'display_sub_headers_below_headers',
            "Select payment option export details" => 'select_payment_option_export_details',
            "Send Mail" => 'send_mail',
            "Sender Email" => 'sender_email_address_cleanto_admin_email',
            "Sender Name" => 'sender_name',
            "Service" => 'service',
            "Service Add-ons Front Block View" => 'service_add_ons_front_block_view',
            "Service Add-ons Front Increase/Decrease View" => 'service_add_ons_front_increase_decrease_view',
            "Service Description" => 'service_description',
            "Service Front View" => 'service_front_view',
            "Service Image" => 'service_image',
            "Service Methods" => 'service_methods',
            "Service Padding Time After" => 'service_padding_time_after',
            "Padding Time After"=>'padding_time_after',
            "Service Padding Time Before" => 'service_padding_time_before',
            "Service Quantity" => 'service_quantity',
            "Service Rate" => 'service_rate',
            "Service Title" => 'service_title',
            "ServiceAddOns Name" => 'serviceaddons_name',
            "Services" => 'services',
            "Services Information" => 'services_information',
            "Set Email Reminder Buffer" => 'set_email_reminder_buffer',
            "Set Language" => 'set_language',
            "Settings" => 'settings',
            "Show All Bookings" => 'show_all_bookings',
            "Show button on given embeded position" => 'show_button_on_given_embeded_position',
            "Show coupons input on checkout" => 'show_coupons_input_on_checkout',
            "Show on a button click" => 'show_on_a_button_click',
            "Show on page load" => 'show_on_page_load',
            "Signature" => 'signature',
            "Sorry Wrong Email Or Password" => 'sorry_wrong_email_or_password',
            "Start Date" => 'start_date',
            "State" => 'state',
            "Status" => 'status',
            "Submit" => 'submit',
            "Tax" => 'tax',
            "Test Mode" => 'test_mode',
            "Text color" => 'text_color',
            "Text Color on bg"=>'text_color_on_bg',
            "Terms & Condition Link"=>'terms_and_condition_link',
            "This Week Breaks" => 'this_week_breaks',
            "This Week Time Scheduling" => 'this_week_time_scheduling',
            "Time Format" => 'time_format',
            "Time Interval" => 'time_interval',
            "TimeZone" => 'timezone',
            "Units" => 'units',
            "Unit Name"=>'unit_name',
            "Units Of Methods" => 'units_of_methods',
            "Update" => 'update',
            "Update Appointment" => 'update_appointment',
            "Update Promocode" => 'update_promocode',
            "Username" => 'username',
            "Vaccum-Cleaner" => 'vaccum_cleaner',
            "View Slots By?" => 'view_slots_by',
            "Week" => 'week',
            "Week Breaks" => 'week_breaks',
            "Week Time Scheduling" => 'week_time_scheduling',
            "Widget Loading style" => 'widget_loading_style',
            "Yes" => 'yes',
            "Zip" => 'zip',
            "logout" => 'logout',
            "to" => 'to',
            "Add New Promocode" => 'add_new_promocode',
            "Create" => 'create',
            "End Date" => 'end_date',
            "End Time" => 'end_time',
            "Expiry Date" => 'expiry_date',
            "Labels Settings" => 'labels_settings',
            "Limit" => 'limit',
            "Max Limit"=>"max_limit",
            "Start Time" => 'start_time',
            "Value" => 'value',
            "Active"=>'active',
            "Appointment Reject Reason"=>"appointment_reject_reason",
            "Search"=>"search",
            "Custom Thankyou Page Url"=>"custom_thankyou_page_url",
            "Coupon Limit"=>"coupon_limit",
            "Price Per unit"=>"price_per_unit",
            "Confirm Appointment"=>"confirm_appointment",
            "Reject Reason"=>"reject_reason",
            "Delete this appointment"=>"delete_this_appointment",
            "Close Notifications"=>"close_notifications",
            "Booking Cancel reason"=>"booking_cancel_reason",
            "Service color badge"=>"service_color_badge",
            "Manage price calculation methods"=>"manage_price_calculation_methods",
            "Manage addons of this service"=>"manage_addons_of_this_service",
            "Service is booked"=>"service_is_booked",
            "Delete this service"=>"delete_this_service",
            "Delete Service"=>"delete_service",
            "Remove Image"=>"remove_image",
            "Remove service image"=>"remove_service_image",
            "Company name is used for invoice purpose"=>"company_name_is_used_for_invoice_purpose",
            "Remove Company Logo"=>"remove_company_logo",
            "Time interval is helpful to show time difference between availability time slots"=>"time_interval_is_helpful_to_show_time_difference_between_availability_time_slots",
            "Minimum advance booking time restrict client to book last minute booking, so that you should have sufficient time before appointment"=>"minimum_advance_booking_time_restrict_client_to_book_last_minute_booking_so_that_you_should_have_sufficient_time_before_appointment",
            "Cancellation buffer helps service providers to avoid last minute cancellation by their clients"=>"cancellation_buffer_helps_service_providers_to_avoid_last_minute_cancellation_by_their_clients",
            "Partial payment option will help you to charge partial payment of total amount from client and remaining you can collect locally"=>"partial_payment_option_will_help_you_to_charge_partial_payment_of_total_amount_from_client_and_remaining_you_can_collect_locally",
            "Allow multiple appointment booking at same time slot, will allow you to show availability time slot even you have booking already for that time"=>"allow_multiple_appointment_booking_at_same_time_slot_will_allow_you_to_show_availability_time_slot_even_you_have_booking_already_for_that_time",
            "With Enable of this feature, Appointment request from clients will be auto confirmed"=>"with_Enable_of_this_feature_Appointment_request_from_clients_will_be_auto_confirmed",
            "Write HTML code for the right side panel"=>"write_html_code_for_the_right_side_panel",
            "Do you want to show subheaders below the headers"=>"do_you_want_to_show_subheaders_below_the_headers",
            "You can show/hide coupon input on checkout form"=>"you_can_show_hide_coupon_input_on_checkout_form",
            "With this feature you can allow a visitor to book appointment without registration"=>"with_this_feature_you_can_allow_a_visitor_to_book_appointment_without_registration",
            "Paypal API username can get easily from developer.paypal.com account"=>"paypal_api_username_can_get_easily_from_developer_paypal_com_account",
            "Paypal API password can get easily from developer.paypal.com account"=>"paypal_api_password_can_get_easily_from_developer_paypal_com_account",
            "Paypal API Signature can get easily from developer.paypal.com account"=>"paypal_api_signature_can_get_easily_from_developer_paypal_com_account",
            "Let user pay through credit card without having Paypal account"=>"let_user_pay_through_credit_card_without_having_paypal_account",
            "You can enable Paypal test mode for sandbox account testing"=>"you_can_enable_paypal_test_mode_for_sandbox_account_testing",
            "You can enable Authorize.Net test mode for sandbox account testing"=>"you_can_enable_authorize_net_test_mode_for_sandbox_account_testing",
            "Edit coupon code"=>"edit_coupon_code",
            "Delete Promocode?"=>"delete_promocode",
            "Coupon code will work for such limit"=>"coupon_code_will_work_for_such_limit",
            "Coupon code will work for such date"=>"coupon_code_will_work_for_such_date",
            "Coupon Value would be consider as percentage in percentage mode and in flat mode it will be consider as amount.No need to add percentage sign it will auto added."=>"coupon_value_would_be_consider_as_percentage_in_percentage_mode_and_in_flat_mode_it_will_be_consider_as_amount_no_need_to_add_percentage_sign_it_will_auto_added",
            "Unit is Booked"=>"unit_is_booked",
            "Delete this service unit?"=>"delete_this_service_unit",
            "Delete Service Unit"=>"delete_service_unit",
            "Manage Unit Price"=>"manage_unit_price",
            "Extra Service Title"=>"extra_service_title",
            "Addon is Booked"=>"addon_is_booked",
            "Delete this addon service?"=>"delete_this_addon_service",
            "Choose your addon image"=>"choose_your_addon_image",
            "Addon Image"=>"addon_image");

        $front_labels = array("My Bookings" => 'my_bookings',
            "Your Postal Code" => 'your_postal_code',
            "Where would you like us to provide service?" => 'where_would_you_like_us_to_provide_service',
            "Choose service" => 'choose_service',
            "How often would you like us provide service?" => 'how_often_would_you_like_us_provide_service',
            "When would you like us to come?" => 'when_would_you_like_us_to_come',
            "TODAY" => 'today',
            "Your Personal Details" => 'your_personal_details',
            "Existing User" => 'existing_user',
            "New User" => 'new_user',
            "Preferred Email" => 'preferred_email',
            "Preferred Password" => 'preferred_password',
            "Your valid email address" => 'your_valid_email_address',
            "Password" => 'password',
            "First Name" => 'first_name',
            "Your First Name" => 'your_first_name',
            "Last Name" => 'last_name',
            "Your Last Name " => 'your_last_name',
            "Phone" => 'phone',
            "Street Address" => 'street_address',
            "Cleaning Service" => 'cleaning_service',
            "Please Select Method" => 'please_select_method',
            "Zip Code" => 'zip_code',
            "City" => 'city',
            "State" => 'state',
            "Special requests ( Notes )" => 'special_requests_notes',
            "Do you have a vacuum cleaner?" => 'do_you_have_a_vaccum_cleaner',
            "Yes" => 'yes',
            "No" => 'no',
            "Preferred Payment Method" => 'preferred_payment_method',
            "Please select one payment method" => 'please_select_one_payment_method',
            "Pay Locally" => 'pay_locally',
            "Partial Deposit" => 'partial_deposit',
            "Remaining Amount" => 'remaining_amount',
            "Please read our terms and conditions carefully" => 'please_read_our_terms_and_conditions_carefully',
            "Do you have parking?" => 'do_you_have_parking',
            "How will we get in?" => 'how_will_we_get_in',
            "I'll be at home" => 'i_will_be_at_home',
            "Please call me" => 'please_call_me',
            "Recurring discounts apply from the second cleaning onward." => 'recurring_discounts_apply_from_the_second_cleaning_onward',
            "Please provide your address and contact details" => 'please_provide_your_address_and_contact_details',
            "You are logged in as" => 'you_are_logged_in_as',
            "The key is with the doorman" => 'the_key_is_with_the_doorman',
            "Other" => 'other',
            "Have a promocode?" => 'have_a_promocode',
            "Apply" => 'apply',
            "Applied Promocode" => 'applied_promocode',
            "Complete Booking" => 'complete_booking',
            "Cancellation Policy" => 'cancellation_policy',
            "Cancellation Policy Header"=>"cancellation_policy_header",
            "Cancellation Policy Textarea"=>"cancellation_policy_textarea",
            "Free cancellation before redemption" => 'free_cancellation_before_redemption',
            "Show More" => 'show_more',
            "Please Select Service" => 'please_select_service',
            "Choose your service and property size" => 'choose_your_service_and_property_size',
            "Choose Your Service"=>"choose_your_service",
            "Please configure first Cleaning Services and settings in admin panel" => 'please_configure_first_cleaning_services_and_settings_in_admin_panel',
            "I have read and accepted the " => 'i_have_read_and_accepted_the',
            "Terms & Conditions" => 'terms_and_condition',
            "and" => 'and',
            'Updated labels'=>'updated_labels',

            "Privacy Policy" => 'privacy_policy',
            "Please Fill all the Company Informations and add some Services and Addons."=>'please_fill_all_the_company_informations_and_add_some_services_and_addons',
            "Booking Summary" => 'booking_summary',
            "Your Email" => 'your_email',
            "Enter Email to Login" => 'enter_email_to_login',
            "Your Password" => 'your_password',
            "Enter your Password" => 'enter_your_password',
            "Forget Password?" => 'forget_password',
            "Reset Password" => 'reset_password',
            "Enter your email and we'll send you instructions on resetting your password." => 'enter_your_email_and_we_send_you_instructions_on_resetting_your_password',
            "Registered Email" => 'registered_email',
            "Send Mail" => 'send_mail',
            "Back to Login" => 'back_to_login',
            "Your" => 'your',
            "Your clean items" => 'your_clean_items',
            "Your cart is empty" => 'your_cart_is_empty',
            "Sub TotalTax" => 'sub_totaltax',
            "Sub Total"=>"sub_total",
            "No data available in table"=>'no_data_available_in_table',
            "Total" => 'total',
            "Or"=>'or',
            "Select addon image"=>"select_addon_image",
            "Inside Fridge"=>'inside_fridge',
            "Inside Oven"=>"inside_oven",
            "Inside Windows"=>"inside_windows",
            "Carpet Cleaning"=>"carpet_cleaning",
            "Green Cleaning"=>"green_cleaning",
            "Pets Care"=>"pets_care",
            "Tiles Cleaning"=>"tiles_cleaning",
            "Wall Cleaning"=>"wall_cleaning",
            "Laundry"=>"laundry",
            "Basement Cleaning"=>"basement_cleaning",
            "Basic Price"=>'basic_price',
            "Max Qty"=>'max_qty',
            "Multiple Qty"=>'multiple_qty',
            "Base Price"=>'base_price',
            "Unit Pricing"=>'unit_pricing',
            "Method is booked"=>'method_is_booked',
            "Service Addons price rules"=>'service_addons_price_rules',
            "Service Unit Front DropDown View"=>'service_unit_front_dropdown_view',
            "Service Unit Front Block View"=>'service_unit_front_block_view',
            "Service Unit Front Increase/Decrease View"=>'service_unit_front_increase_decrease_view',
            "Are You Sure"=>'are_you_sure',
            "Service Unit price rules"=>'service_unit_price_rules',
            "Close"=>'close',
            "Closed"=>'closed',
            "Service Addons"=>'service_addons',
            "Service Enable"=>'service_enable',
            "Service Disable"=>'service_disable',
            "Method Enable"=>'method_enable',
            "Off Time Deleted"=>'off_time_deleted',
            "Error in Delete of Off Time"=>"error_in_delete_of_off_time",
            "Method Disable"=>'method_disable',
            "Extra Services" => 'extra_services',
            "For initial cleaning only. Contact us to apply to recurrings." => 'for_initial_cleaning_only_contact_us_to_apply_to_recurrings',
            "Number of" => 'number_of',
            "Extra Services Not Available" => 'extra_services_not_available',
            "Available"=>"available",
            "Selected"=>"selected",
            "Not Available"=>"not_available",
            "None"=>'none',
            "None of time slot available Please check another dates"=>"none_of_time_slot_available_please_check_another_dates",
            "Availability is not configured from admin side"=>"availability_is_not_configured_from_admin_side",
            "How many Intensive" => 'how_many_intensive',
            "No Intensive" => 'no_intensive',
            "Frequently Discount" => 'frequently_discount',
            "Coupon Discount" => 'coupon_discount',
            "How many" => 'how_many',
            "Enter your Other option" => 'enter_your_other_option',
            "Log Out" => 'log_out',
            "Your Added Off Times"=>'your_added_off_times',
            "Log In" => 'log_in',
            "Custom Css"=>'custom_css',
            "Success"=>'success',
            "Failure"=>'failure',
            "You can only use valid zipcode"=>'you_can_only_use_valid_zipcode',
            "Minutes"=>"minutes",
            "Hours"=>'hours',
            "Days"=>"days",
            "Months"=>"months",
            "Year"=>"year",
            "Default url is"=>"default_url_is",
            "Card payment"=>"card_payment",
            "Card details"=>"card_details",
            "Card number"=>"card_number",
            "Invalid card number"=>"invalid_card_number",
            "Expiry"=>"expiry",
            "Button Preview"=>"button_preview",
            "Thankyou"=>"thankyou",
            "Thankyou! for booking appointment"=>"thankyou_for_booking_appointment",
            "You will be notified by email with details of appointment"=>"you_will_be_notified_by_email_with_details_of_appointment",
            "Please enter firstname"=>"please_enter_firstname",
            "Please enter lastname"=>"please_enter_lastname",
            "Remove applied coupon"=>"remove_applied_coupon");

        $extra_labels = array(
            "Please enter minimum 3 Characters"=>"please_enter_minimum_3_chars",
            "INVOICE"=>"invoice",
            "INVOICE TO"=>"invoice_to",
            "Invoice Date"=>"invoice_date",
            "CASH"=>"cash",
            "Service Name"=>"service_name",
            "Qty"=>"qty",
            "Booked On"=>"booked_on");
		
		$language_error = array();
		$language_front = array();
		$language_admin = array();
		$language_extra = array();
		
        foreach ($front_labels as $key => $value) {
            $language_front[$value] = $key;
        }
        foreach ($errors as $key => $value) {
            $language_error[$value] = $key;
        }
        foreach ($admin_labels as $key => $value) {
            $language_admin[$value] = $key;
        }
		foreach ($extra_labels as $key => $value) {
            $language_extra[$value] = $key;
        }
		
		$language_front_arr = base64_encode(serialize($language_front));
		$language_admin_arr = base64_encode(serialize($language_admin));
		$language_error_arr = base64_encode(serialize($language_error));
		$language_extra_arr = base64_encode(serialize($language_extra));
				
        $languagearr = $language_front_arr."###".$language_admin_arr."###".$language_error_arr."###".$language_extra_arr;
		
        $delete_default_lang = "TRUNCATE TABLE  `ct_languages`;";
        mysqli_query($this->conn, $delete_default_lang);
		
        $insert_default_lang = "insert into `ct_languages` (`id`,`label_data`,`language`) values(NULL,'" . $languagearr . "','en')";
        mysqli_query($this->conn, $insert_default_lang);
    }
    public function insert_option($option,$value){
        $add_options = "INSERT INTO `ct_settings` (`id`, `option_name`, `option_value`,`postalcode`) VALUES (NULL, '".$option."', '".$value."','');";
        mysqli_query($this->conn,$add_options);
    }
    public function update1_3()
    {
	    $this->insert_option('ct_vc_status','Y');
        $this->insert_option('ct_p_status','Y');	
        $this->insert_option('ct_sms_plivo_account_SID', '');
        $this->insert_option('ct_sms_plivo_auth_token', '');
        $this->insert_option('ct_sms_plivo_sender_number', '');
        $this->insert_option('ct_sms_plivo_send_sms_to_service_provider_status', 'N');
        $this->insert_option('ct_sms_plivo_send_sms_to_client_status', 'N');
        $this->insert_option('ct_sms_plivo_send_sms_to_admin_status', 'N');
        $this->insert_option('ct_sms_plivo_admin_phone_number', '');
        $this->insert_option('ct_sms_twilio_status', 'N');
        $this->insert_option('ct_sms_plivo_status', 'N');
        $this->insert_option('ct_company_phone', '');
		$this->insert_option('ct_admin_optional_email', '');
        $sms_template = "CREATE TABLE IF NOT EXISTS `ct_sms_templates` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `sms_subject` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
		  `sms_message` text COLLATE utf8_unicode_ci NOT NULL,
		  `default_message` text COLLATE utf8_unicode_ci NOT NULL,
		  `sms_template_status` enum('E','D') COLLATE utf8_unicode_ci NOT NULL,
		  `sms_template_type` enum('A','C','R','CC','RS','RM') COLLATE utf8_unicode_ci NOT NULL COMMENT 'A=active, C=confirm, R=Reject, CC=Cancel by Client, RS=Reschedule, RM=Reminder',
		  `user_type` enum('A','C') COLLATE utf8_unicode_ci NOT NULL COMMENT 'A=Admin,C=client',
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=30 ;";
		mysqli_query($this->conn,$sms_template);
		
		$sms_template_insert = "INSERT INTO `ct_sms_templates` (`id`, `sms_subject`, `sms_message`, `default_message`, `sms_template_status`, `sms_template_type`, `user_type`) VALUES
(1, 'Appointment Request', '', 'RGVhciB7e2NsaWVudF9uYW1lfX0sCllvdSBoYXZlIGFuIGFwcG9pbnRtZW50IG9uIHt7Ym9va2luZ19kYXRlfX0gZm9yIHt7c2VydmljZV9uYW1lfX0=', 'E', 'A', 'C'),
(2, 'New Appointment Request Requires Approval', '', 'RGVhciB7e2FkbWluX25hbWV9fSwKWW91IGhhdmUgYW4gYXBwb2ludG1lbnQgb24ge3tib29raW5nX2RhdGV9fSBmb3Ige3tzZXJ2aWNlX25hbWV9fQ==', 'E', 'A', 'A'),
(3, 'Appointment Approved', '', 'RGVhciB7e2NsaWVudF9uYW1lfX0sDQpZb3VyIGFwcG9pbnRtZW50IG9uIHt7Ym9va2luZ19kYXRlfX0gZm9yIHt7c2VydmljZV9uYW1lfX0gaGFzIGJlZW4gY29uZmlybWVkLg', 'E', 'C', 'C'),
(4, 'Appointment Approved', '', 'RGVhciB7e2FkbWluX25hbWV9fSwNCllvdXIgYXBwb2ludG1lbnQgd2l0aCB7e2NsaWVudF9uYW1lfX0gb24ge3tib29raW5nX2RhdGV9fSBmb3Ige3tzZXJ2aWNlX25hbWV9fSBoYXMgYmVlbiBjb25maXJtZWQu', 'E', 'C', 'A'),
(5, 'Appointment Rejected', '', 'RGVhciB7e2NsaWVudF9uYW1lfX0sDQpZb3VyIGFwcG9pbnRtZW50IG9uIHt7Ym9va2luZ19kYXRlfX0gZm9yIHt7c2VydmljZV9uYW1lfX0gaGFzIGJlZW4gcmVqZWN0ZWQu', 'E', 'R', 'C'),
(6, 'Appointment Rejected', '', 'RGVhciB7e2FkbWluX25hbWV9fSwNCllvdXIgYXBwb2ludG1lbnQgd2l0aCB7e2NsaWVudF9uYW1lfX0gb24ge3tib29raW5nX2RhdGV9fSBmb3Ige3tzZXJ2aWNlX25hbWV9fSBoYXMgYmVlbiByZWplY3RlZC4=', 'E', 'R', 'A'),
(7, 'Appointment Cancelled by you', '', 'RGVhciB7e2NsaWVudF9uYW1lfX0sDQpZb3VyIGFwcG9pbnRtZW50IG9uIHt7Ym9va2luZ19kYXRlfX0gZm9yIHt7c2VydmljZV9uYW1lfX0gaGFzIGJlZW4gY2FuY2VsbGVkLg==', 'E', 'CC', 'C'),
(8, 'Appointment Cancelled By Customer', '', 'RGVhciB7e2FkbWluX25hbWV9fSwNCllvdXIgYXBwb2ludG1lbnQgd2l0aCB7e2NsaWVudF9uYW1lfX0gb24ge3tib29raW5nX2RhdGV9fSBmb3Ige3tzZXJ2aWNlX25hbWV9fSBoYXMgYmVlbiBjYW5jZWxsZWQu', 'E', 'CC', 'A'),
(9, 'Appointment Rescheduled by you', '', 'RGVhciB7e2NsaWVudF9uYW1lfX0sDQpZb3VyIGFwcG9pbnRtZW50IG9uIHt7Ym9va2luZ19kYXRlfX0gZm9yIHt7c2VydmljZV9uYW1lfX0gaGFzIGJlZW4gcmVzY2hlZHVsZWQu', 'E', 'RS', 'C'),
(10, 'Appointment Rescheduled By Customer', '', 'RGVhciB7e2FkbWluX25hbWV9fSwNCllvdXIgYXBwb2ludG1lbnQgd2l0aCB7e2NsaWVudF9uYW1lfX0gb24ge3tib29raW5nX2RhdGV9fSBmb3Ige3tzZXJ2aWNlX25hbWV9fSBoYXMgYmVlbiByZXNjaGVkdWxlZC4=', 'E', 'RS', 'A'),
(11, 'Client Appointment Reminder', '', 'RGVhciB7e2NsaWVudF9uYW1lfX0sCllvdXIgYXBwb2ludG1lbnQgd2l0aCB7e2FkbWluX25hbWV9fSBpcyBzY2hlZHVsZWQgaW4ge3thcHBfcmVtYWluX3RpbWV9fSBob3Vycy4=', 'E', 'RM', 'C'),
(12, 'Admin Appointment Reminder', '', 'RGVhciB7e2FkbWluX25hbWV9fSwKWW91ciBhcHBvaW50bWVudCB3aXRoIHt7Y2xpZW50X25hbWV9fSBpcyBzY2hlZHVsZWQgaW4ge3thcHBfcmVtYWluX3RpbWV9fSBob3Vycy4=', 'E', 'RM', 'A');";
		mysqli_query($this->conn,$sms_template_insert);
		
		$email_template = "CREATE TABLE IF NOT EXISTS `ct_email_templates` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `email_subject` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
		  `email_message` text COLLATE utf8_unicode_ci NOT NULL,
		  `default_message` text COLLATE utf8_unicode_ci NOT NULL,
		  `email_template_status` enum('E','D') COLLATE utf8_unicode_ci NOT NULL,
		  `email_template_type` enum('A','C','R','CC','RS','RM') COLLATE utf8_unicode_ci NOT NULL COMMENT 'A=active, C=confirm, R=Reject, CC=Cancel by Client, RS=Reschedule, RM=Reminder',
		  `user_type` enum('A','C') COLLATE utf8_unicode_ci NOT NULL COMMENT 'A=Admin,C=client',
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=30 ;";
		mysqli_query($this->conn,$email_template);
		
		$email_template_insert = "INSERT INTO `ct_email_templates` (`id`, `email_subject`, `email_message`, `default_message`, `email_template_status`, `email_template_type`, `user_type`) VALUES
(1, 'Appointment Request', '', 'PGh0bWw+DQo8aGVhZD4NCgk8bWV0YSBuYW1lPSJ2aWV3cG9ydCIgY29udGVudD0id2lkdGg9ZGV2aWNlLXdpZHRoLCBpbml0aWFsLXNjYWxlPTEuMCIvPg0KCTxtZXRhIGh0dHAtZXF1aXY9IkNvbnRlbnQtVHlwZSIgY29udGVudD0idGV4dC9odG1sOyBjaGFyc2V0PVVURi04IiAvPg0KCTx0aXRsZT5TdWJqZWN0OiB7e3NlcnZpY2VfbmFtZX19IG9uIHt7Ym9va2luZ19kYXRlfX08L3RpdGxlPg0KCTxsaW5rIGhyZWY9Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1Nb250c2VycmF0IiByZWw9InN0eWxlc2hlZXQiPg0KPC9oZWFkPg0KPGJvZHk+CQkNCgk8ZGl2IHN0eWxlPSJtYXJnaW46IDA7cGFkZGluZzogMDtmb250LWZhbWlseTogSGVsdmV0aWNhIE5ldWUsIEhlbHZldGljYSwgSGVsdmV0aWNhLCBBcmlhbCwgc2Fucy1zZXJpZjtmb250LXNpemU6IDEwMCU7bGluZS1oZWlnaHQ6IDEuNjtib3gtc2l6aW5nOiBib3JkZXItYm94OyI+CQ0KCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O21heC13aWR0aDogNjAwcHggIWltcG9ydGFudDttYXJnaW46IDAgYXV0byAhaW1wb3J0YW50O2NsZWFyOiBib3RoICFpbXBvcnRhbnQ7Ij4NCgkJCTx0YWJsZSBzdHlsZT0iYm9yZGVyOiAxcHggc29saWQgI2MyYzJjMjt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDttYXJnaW46IDMwcHggMHB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czogNXB4Oy1tb3otYm9yZGVyLXJhZGl1czogNXB4Oy1vLWJvcmRlci1yYWRpdXM6IDVweDtib3JkZXItcmFkaXVzOiA1cHg7Ij4NCgkJCQk8dGJvZHk+DQoJCQkJCTx0ciBzdHlsZT0iYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7Ij4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDU5JTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7dGV4dC1hbGlnbjogbGVmdDtmb250LWZhbWlseTogTW9udHNlcnJhdCwgc2Fucy1zZXJpZjsiPg0KCQkJCQkJCQl7e2NvbXBhbnlfbmFtZX19PGJyIC8+e3tjb21wYW55X2FkZHJlc3N9fTxiciAvPnt7Y29tcGFueV9jaXR5fX0sIHt7Y29tcGFueV9zdGF0ZX19LCB7e2NvbXBhbnlfemlwfX08YnIgLz57e2NvbXBhbnlfY291bnRyeX19PGJyIC8+e3tjb21wYW55X3Bob25lfX08YnIgLz57e2NvbXBhbnlfZW1haWx9fQ0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDQwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7Ij4NCgkJCQkJCQkJPGRpdiBzdHlsZT0id2lkdGg6IDEzMHB4O2hlaWdodDogMTAwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO21hcmdpbjogMHB4IGF1dG87Ij4NCgkJCQkJCQkJCTxpbWcgc3R5bGU9IndpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0O2Rpc3BsYXk6IGlubGluZS1ibG9jaztoZWlnaHQ6IDEwMCU7IiBzcmM9Int7YnVzaW5lc3NfbG9nb319IiAvPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQk8L2Rpdj4NCgkJCQkJCTwvdGQ+DQoJCQkJCQkNCgkJCQkJCQ0KCQkJCQk8L3RyPg0KCQkJCQk8dHI+DQoJCQkJCQk8dGQ+DQoJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMjVweCAzMHB4O2JhY2tncm91bmQ6ICNmZmY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDkwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQkJPGg2IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bWFyZ2luOiAxMHB4IDBweCAxMHB4O2ZvbnQtd2VpZ2h0OiA2MDA7Ij5EZWFyIHt7Y2xpZW50X25hbWV9fSw8L2g2Pg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDttYXJnaW46IDEwcHggMHB4IDE1cHg7Ij5Zb3UndmUgc2V0IGEgbmV3IGFwcG9pbnRtZW50IHdpdGggZm9sbG93aW5nIGRldGFpbHM6PC9wPgkJCQkJCQkNCgkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTxkaXYgc3R5bGU9ImZsb2F0OiBsZWZ0O3dpZHRoOiAxMDAlO2Rpc3BsYXk6IGJsb2NrO3BhZGRpbmc6IDEwcHggMHB4OyI+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5XaGVuOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Ym9va2luZ19kYXRlfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkZvcjogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3NlcnZpY2VfbmFtZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5NZXRob2RzIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e21ldGhvZG5hbWV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+VW5pdHMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7dW5pdHN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+QWRkLW9ucyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3thZGRvbnN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UHJpY2UgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7cHJpY2V9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJDQoJCQkJCQkJCQkNCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPk5hbWUgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Zmlyc3RuYW1lfX0ge3tsYXN0bmFtZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5FbWFpbCA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tjbGllbnRfZW1haWx9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UGhvbmUgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7cGhvbmV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UGF5bWVudCA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twYXltZW50X21ldGhvZH19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5WYWNjdW0gQ2xlYW5lciA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3t2YWNjdW1fY2xlYW5lcl9zdGF0dXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UGFya2luZyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twYXJraW5nX3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5BZGRyZXNzIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2FkZHJlc3N9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+Tm90ZXMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7bm90ZXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+Q29udGFjdCBTdGF0dXMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Y29udGFjdF9zdGF0dXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMTVweCAwcHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7Ym9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7Ij4NCgkJCQkJCQkJCTxwIHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bGluZS1oZWlnaHQ6IDIycHg7bWFyZ2luOiAxMHB4IDBweCAxNXB4O2Zsb2F0OiBsZWZ0OyI+WW91ciBhcHBvaW50bWVudCBpcyB0ZW50YXRpdmUgYW5kIHlvdSB3aWxsIGJlIG5vdGlmaWVkIGFzIHdlIHdpbGwgY29uZmlybSB0aGlzIGJvb2tpbmcuPC9wPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMTBweCAwcHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7dGV4dC1hbGlnbjogY2VudGVyOyI+DQoJCQkJCQkJCQk8aDUgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTNweDttYXJnaW46IDBweCAwcHggNXB4OyI+VGhhbmsgeW91PC9oNT4NCgkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJPC9kaXY+DQoJCQkJCQk8L3RkPgkJCQkJDQoJCQkJCTwvdHI+CQkJCQ0KCQkJCTwvdGJvZHk+DQoJCQk8L3RhYmxlPgkNCgkJPC9kaXY+DQoJPC9kaXY+CQ0KPC9ib2R5Pg0KPC9odG1sPg==', 'E', 'A', 'C'),
(2, 'New Appointment Request Requires Approval', '', 'PGh0bWw+DQo8aGVhZD4NCgk8bWV0YSBuYW1lPSJ2aWV3cG9ydCIgY29udGVudD0id2lkdGg9ZGV2aWNlLXdpZHRoLCBpbml0aWFsLXNjYWxlPTEuMCIvPg0KCTxtZXRhIGh0dHAtZXF1aXY9IkNvbnRlbnQtVHlwZSIgY29udGVudD0idGV4dC9odG1sOyBjaGFyc2V0PVVURi04IiAvPg0KCTx0aXRsZT5TdWJqZWN0OiB7e3NlcnZpY2VfbmFtZX19IG9uIHt7Ym9va2luZ19kYXRlfX08L3RpdGxlPg0KCTxsaW5rIGhyZWY9Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1Nb250c2VycmF0IiByZWw9InN0eWxlc2hlZXQiPg0KPC9oZWFkPg0KPGJvZHk+CQkNCgk8ZGl2IHN0eWxlPSJtYXJnaW46IDA7cGFkZGluZzogMDtmb250LWZhbWlseTogSGVsdmV0aWNhIE5ldWUsIEhlbHZldGljYSwgSGVsdmV0aWNhLCBBcmlhbCwgc2Fucy1zZXJpZjtmb250LXNpemU6IDEwMCU7bGluZS1oZWlnaHQ6IDEuNjtib3gtc2l6aW5nOiBib3JkZXItYm94OyI+CQ0KCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O21heC13aWR0aDogNjAwcHggIWltcG9ydGFudDttYXJnaW46IDAgYXV0byAhaW1wb3J0YW50O2NsZWFyOiBib3RoICFpbXBvcnRhbnQ7Ij4NCgkJCTx0YWJsZSBzdHlsZT0iYm9yZGVyOiAxcHggc29saWQgI2MyYzJjMjt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDttYXJnaW46IDMwcHggMHB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czogNXB4Oy1tb3otYm9yZGVyLXJhZGl1czogNXB4Oy1vLWJvcmRlci1yYWRpdXM6IDVweDtib3JkZXItcmFkaXVzOiA1cHg7Ij4NCgkJCQk8dGJvZHk+DQoJCQkJCTx0ciBzdHlsZT0iYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7Ij4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDU5JTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7dGV4dC1hbGlnbjogbGVmdDtmb250LWZhbWlseTogTW9udHNlcnJhdCwgc2Fucy1zZXJpZjsiPg0KCQkJCQkJCQl7e2NvbXBhbnlfbmFtZX19PGJyIC8+e3tjb21wYW55X2FkZHJlc3N9fTxiciAvPnt7Y29tcGFueV9jaXR5fX0sIHt7Y29tcGFueV9zdGF0ZX19LCB7e2NvbXBhbnlfemlwfX08YnIgLz57e2NvbXBhbnlfY291bnRyeX19PGJyIC8+e3tjb21wYW55X3Bob25lfX08YnIgLz57e2NvbXBhbnlfZW1haWx9fQ0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDQwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7Ij4NCgkJCQkJCQkJPGRpdiBzdHlsZT0id2lkdGg6IDEzMHB4O2hlaWdodDogMTAwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO21hcmdpbjogMHB4IGF1dG87Ij4NCgkJCQkJCQkJCTxpbWcgc3R5bGU9IndpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0O2Rpc3BsYXk6IGlubGluZS1ibG9jaztoZWlnaHQ6IDEwMCU7IiBzcmM9Int7YnVzaW5lc3NfbG9nb319IiAvPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQk8L2Rpdj4NCgkJCQkJCTwvdGQ+DQoJCQkJCQkNCgkJCQkJCQ0KCQkJCQk8L3RyPg0KCQkJCQk8dHI+DQoJCQkJCQk8dGQ+DQoJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMjVweCAzMHB4O2JhY2tncm91bmQ6ICNmZmY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDkwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQkJPGg2IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bWFyZ2luOiAxMHB4IDBweCAxMHB4O2ZvbnQtd2VpZ2h0OiA2MDA7Ij5EZWFyIHt7YWRtaW5fbmFtZX19LCA8L2g2Pg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDttYXJnaW46IDEwcHggMHB4IDE1cHg7Ij5Zb3UndmUgbmV3IGFwcG9pbnRtZW50IHdpdGgge3tjbGllbnRfbmFtZX19IHdpdGggZm9sbG93aW5nIGRldGFpbHM6PC9wPgkJCQkJCQkNCgkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTxkaXYgc3R5bGU9ImZsb2F0OiBsZWZ0O3dpZHRoOiAxMDAlO2Rpc3BsYXk6IGJsb2NrO3BhZGRpbmc6IDEwcHggMHB4OyI+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5XaGVuOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Ym9va2luZ19kYXRlfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkZvcjogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3NlcnZpY2VfbmFtZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5NZXRob2RzIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e21ldGhvZG5hbWV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+VW5pdHMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7dW5pdHN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+QWRkLW9ucyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3thZGRvbnN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UHJpY2UgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7cHJpY2V9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJDQoJCQkJCQkJCQkNCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPk5hbWUgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Zmlyc3RuYW1lfX0ge3tsYXN0bmFtZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5FbWFpbCA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tjbGllbnRfZW1haWx9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UGhvbmUgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7cGhvbmV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UGF5bWVudCA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twYXltZW50X21ldGhvZH19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5WYWNjdW0gQ2xlYW5lciA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3t2YWNjdW1fY2xlYW5lcl9zdGF0dXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UGFya2luZyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twYXJraW5nX3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5BZGRyZXNzIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2FkZHJlc3N9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+Tm90ZXMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7bm90ZXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+Q29udGFjdCBTdGF0dXMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Y29udGFjdF9zdGF0dXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMTVweCAwcHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7Ym9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7Ij4NCgkJCQkJCQkJCTxwIHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bGluZS1oZWlnaHQ6IDIycHg7bWFyZ2luOiAxMHB4IDBweCAxNXB4O2Zsb2F0OiBsZWZ0OyI+VGhpcyBhcHBvaW50bWVudCBpcyBpbiBwZW5kaW5nLjwvcD4NCgkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTxkaXYgc3R5bGU9InBhZGRpbmc6IDEwcHggMHB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiAxMDAlO2Rpc3BsYXk6IGJsb2NrO3RleHQtYWxpZ246IGNlbnRlcjsiPg0KCQkJCQkJCQkJPGg1IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDEzcHg7bWFyZ2luOiAwcHggMHB4IDVweDsiPlRoYW5rIHlvdTwvaDU+DQoJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4JCQkJCQ0KCQkJCQk8L3RyPgkJCQkNCgkJCQk8L3Rib2R5Pg0KCQkJPC90YWJsZT4JDQoJCTwvZGl2Pg0KCTwvZGl2PgkNCjwvYm9keT4NCjwvaHRtbD4=', 'E', 'A', 'A'),
(3, 'Appointment Approved', '', 'PGh0bWw+DQo8aGVhZD4NCgk8bWV0YSBuYW1lPSJ2aWV3cG9ydCIgY29udGVudD0id2lkdGg9ZGV2aWNlLXdpZHRoLCBpbml0aWFsLXNjYWxlPTEuMCIvPg0KCTxtZXRhIGh0dHAtZXF1aXY9IkNvbnRlbnQtVHlwZSIgY29udGVudD0idGV4dC9odG1sOyBjaGFyc2V0PVVURi04IiAvPg0KCTx0aXRsZT5TdWJqZWN0OiB7e3NlcnZpY2VfbmFtZX19IG9uIHt7Ym9va2luZ19kYXRlfX08L3RpdGxlPg0KCTxsaW5rIGhyZWY9Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1Nb250c2VycmF0IiByZWw9InN0eWxlc2hlZXQiPg0KPC9oZWFkPg0KPGJvZHk+CQkNCgk8ZGl2IHN0eWxlPSJtYXJnaW46IDA7cGFkZGluZzogMDtmb250LWZhbWlseTogSGVsdmV0aWNhIE5ldWUsIEhlbHZldGljYSwgSGVsdmV0aWNhLCBBcmlhbCwgc2Fucy1zZXJpZjtmb250LXNpemU6IDEwMCU7bGluZS1oZWlnaHQ6IDEuNjtib3gtc2l6aW5nOiBib3JkZXItYm94OyI+CQ0KCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O21heC13aWR0aDogNjAwcHggIWltcG9ydGFudDttYXJnaW46IDAgYXV0byAhaW1wb3J0YW50O2NsZWFyOiBib3RoICFpbXBvcnRhbnQ7Ij4NCgkJCTx0YWJsZSBzdHlsZT0iYm9yZGVyOiAxcHggc29saWQgI2MyYzJjMjt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDttYXJnaW46IDMwcHggMHB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czogNXB4Oy1tb3otYm9yZGVyLXJhZGl1czogNXB4Oy1vLWJvcmRlci1yYWRpdXM6IDVweDtib3JkZXItcmFkaXVzOiA1cHg7Ij4NCgkJCQk8dGJvZHk+DQoJCQkJCTx0ciBzdHlsZT0iYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7Ij4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDU5JTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7dGV4dC1hbGlnbjogbGVmdDtmb250LWZhbWlseTogTW9udHNlcnJhdCwgc2Fucy1zZXJpZjsiPg0KCQkJCQkJCQl7e2NvbXBhbnlfbmFtZX19PGJyIC8+e3tjb21wYW55X2FkZHJlc3N9fTxiciAvPnt7Y29tcGFueV9jaXR5fX0sIHt7Y29tcGFueV9zdGF0ZX19LCB7e2NvbXBhbnlfemlwfX08YnIgLz57e2NvbXBhbnlfY291bnRyeX19PGJyIC8+e3tjb21wYW55X3Bob25lfX08YnIgLz57e2NvbXBhbnlfZW1haWx9fQ0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDQwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7Ij4NCgkJCQkJCQkJPGRpdiBzdHlsZT0id2lkdGg6IDEzMHB4O2hlaWdodDogMTAwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO21hcmdpbjogMHB4IGF1dG87Ij4NCgkJCQkJCQkJCTxpbWcgc3R5bGU9IndpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0O2Rpc3BsYXk6IGlubGluZS1ibG9jaztoZWlnaHQ6IDEwMCU7IiBzcmM9Int7YnVzaW5lc3NfbG9nb319IiAvPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQk8L2Rpdj4NCgkJCQkJCTwvdGQ+DQoJCQkJCQkNCgkJCQkJCQ0KCQkJCQk8L3RyPg0KCQkJCQk8dHI+DQoJCQkJCQk8dGQ+DQoJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMjVweCAzMHB4O2JhY2tncm91bmQ6ICNmZmY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDkwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQkJPGg2IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bWFyZ2luOiAxMHB4IDBweCAxMHB4O2ZvbnQtd2VpZ2h0OiA2MDA7Ij5EZWFyIHt7Y2xpZW50X25hbWV9fSw8L2g2Pg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDttYXJnaW46IDEwcHggMHB4IDE1cHg7Ij5Zb3VyIGFwcG9pbnRtZW50IHdpdGggZm9sbG93aW5nIGRldGFpbHM6PC9wPgkJCQkJCQkNCgkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTxkaXYgc3R5bGU9ImZsb2F0OiBsZWZ0O3dpZHRoOiAxMDAlO2Rpc3BsYXk6IGJsb2NrO3BhZGRpbmc6IDEwcHggMHB4OyI+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5XaGVuOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Ym9va2luZ19kYXRlfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkZvcjogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3NlcnZpY2VfbmFtZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5NZXRob2RzIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e21ldGhvZG5hbWV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+VW5pdHMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7dW5pdHN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+QWRkLW9ucyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3thZGRvbnN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UHJpY2UgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7cHJpY2V9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJDQoJCQkJCQkJCQkNCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPk5hbWUgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Zmlyc3RuYW1lfX0ge3tsYXN0bmFtZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5FbWFpbCA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tjbGllbnRfZW1haWx9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UGhvbmUgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7cGhvbmV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UGF5bWVudCA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twYXltZW50X21ldGhvZH19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5WYWNjdW0gQ2xlYW5lciA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3t2YWNjdW1fY2xlYW5lcl9zdGF0dXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UGFya2luZyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twYXJraW5nX3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5BZGRyZXNzIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2FkZHJlc3N9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+Tm90ZXMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7bm90ZXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+Q29udGFjdCBTdGF0dXMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Y29udGFjdF9zdGF0dXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMTVweCAwcHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7Ym9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7Ij4NCgkJCQkJCQkJCTxwIHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bGluZS1oZWlnaHQ6IDIycHg7bWFyZ2luOiAxMHB4IDBweCAxNXB4O2Zsb2F0OiBsZWZ0OyI+aGFzIGJlZW4gY29uZmlybWVkLjwvcD4NCgkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTxkaXYgc3R5bGU9InBhZGRpbmc6IDEwcHggMHB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiAxMDAlO2Rpc3BsYXk6IGJsb2NrO3RleHQtYWxpZ246IGNlbnRlcjsiPg0KCQkJCQkJCQkJPGg1IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDEzcHg7bWFyZ2luOiAwcHggMHB4IDVweDsiPlRoYW5rIHlvdTwvaDU+DQoJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4JCQkJCQ0KCQkJCQk8L3RyPgkJCQkNCgkJCQk8L3Rib2R5Pg0KCQkJPC90YWJsZT4JDQoJCTwvZGl2Pg0KCTwvZGl2PgkNCjwvYm9keT4NCjwvaHRtbD4=', 'E', 'C', 'C'),
(4, 'Appointment Approved', '', 'PGh0bWw+DQo8aGVhZD4NCgk8bWV0YSBuYW1lPSJ2aWV3cG9ydCIgY29udGVudD0id2lkdGg9ZGV2aWNlLXdpZHRoLCBpbml0aWFsLXNjYWxlPTEuMCIvPg0KCTxtZXRhIGh0dHAtZXF1aXY9IkNvbnRlbnQtVHlwZSIgY29udGVudD0idGV4dC9odG1sOyBjaGFyc2V0PVVURi04IiAvPg0KCTx0aXRsZT5TdWJqZWN0OiB7e3NlcnZpY2VfbmFtZX19IG9uIHt7Ym9va2luZ19kYXRlfX08L3RpdGxlPg0KCTxsaW5rIGhyZWY9Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1Nb250c2VycmF0IiByZWw9InN0eWxlc2hlZXQiPg0KPC9oZWFkPg0KPGJvZHk+CQkNCgk8ZGl2IHN0eWxlPSJtYXJnaW46IDA7cGFkZGluZzogMDtmb250LWZhbWlseTogSGVsdmV0aWNhIE5ldWUsIEhlbHZldGljYSwgSGVsdmV0aWNhLCBBcmlhbCwgc2Fucy1zZXJpZjtmb250LXNpemU6IDEwMCU7bGluZS1oZWlnaHQ6IDEuNjtib3gtc2l6aW5nOiBib3JkZXItYm94OyI+CQ0KCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O21heC13aWR0aDogNjAwcHggIWltcG9ydGFudDttYXJnaW46IDAgYXV0byAhaW1wb3J0YW50O2NsZWFyOiBib3RoICFpbXBvcnRhbnQ7Ij4NCgkJCTx0YWJsZSBzdHlsZT0iYm9yZGVyOiAxcHggc29saWQgI2MyYzJjMjt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDttYXJnaW46IDMwcHggMHB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czogNXB4Oy1tb3otYm9yZGVyLXJhZGl1czogNXB4Oy1vLWJvcmRlci1yYWRpdXM6IDVweDtib3JkZXItcmFkaXVzOiA1cHg7Ij4NCgkJCQk8dGJvZHk+DQoJCQkJCTx0ciBzdHlsZT0iYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7Ij4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDU5JTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7dGV4dC1hbGlnbjogbGVmdDtmb250LWZhbWlseTogTW9udHNlcnJhdCwgc2Fucy1zZXJpZjsiPg0KCQkJCQkJCQl7e2NvbXBhbnlfbmFtZX19PGJyIC8+e3tjb21wYW55X2FkZHJlc3N9fTxiciAvPnt7Y29tcGFueV9jaXR5fX0sIHt7Y29tcGFueV9zdGF0ZX19LCB7e2NvbXBhbnlfemlwfX08YnIgLz57e2NvbXBhbnlfY291bnRyeX19PGJyIC8+e3tjb21wYW55X3Bob25lfX08YnIgLz57e2NvbXBhbnlfZW1haWx9fQ0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDQwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7Ij4NCgkJCQkJCQkJPGRpdiBzdHlsZT0id2lkdGg6IDEzMHB4O2hlaWdodDogMTAwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO21hcmdpbjogMHB4IGF1dG87Ij4NCgkJCQkJCQkJCTxpbWcgc3R5bGU9IndpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0O2Rpc3BsYXk6IGlubGluZS1ibG9jaztoZWlnaHQ6IDEwMCU7IiBzcmM9Int7YnVzaW5lc3NfbG9nb319IiAvPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQk8L2Rpdj4NCgkJCQkJCTwvdGQ+DQoJCQkJCQkNCgkJCQkJCQ0KCQkJCQk8L3RyPg0KCQkJCQk8dHI+DQoJCQkJCQk8dGQ+DQoJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMjVweCAzMHB4O2JhY2tncm91bmQ6ICNmZmY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDkwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQkJPGg2IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bWFyZ2luOiAxMHB4IDBweCAxMHB4O2ZvbnQtd2VpZ2h0OiA2MDA7Ij5EZWFyIHt7YWRtaW5fbmFtZX19LCA8L2g2Pg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDttYXJnaW46IDEwcHggMHB4IDE1cHg7Ij5UaGUgYXBwb2ludG1lbnQgd2l0aCB7e2NsaWVudF9uYW1lfX0gd2l0aCBmb2xsb3dpbmcgZGV0YWlsczo8L3A+CQkJCQkJCQ0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPGRpdiBzdHlsZT0iZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7cGFkZGluZzogMTBweCAwcHg7Ij4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPldoZW46IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tib29raW5nX2RhdGV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+Rm9yOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7c2VydmljZV9uYW1lfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPk1ldGhvZHMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7bWV0aG9kbmFtZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Vbml0cyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3t1bml0c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5BZGQtb25zIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2FkZG9uc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QcmljZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twcmljZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQkNCgkJCQkJCQkJCQ0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+TmFtZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tmaXJzdG5hbWV9fSB7e2xhc3RuYW1lfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkVtYWlsIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2NsaWVudF9lbWFpbH19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QaG9uZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twaG9uZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QYXltZW50IDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3BheW1lbnRfbWV0aG9kfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPlZhY2N1bSBDbGVhbmVyIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3ZhY2N1bV9jbGVhbmVyX3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QYXJraW5nIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3Bhcmtpbmdfc3RhdHVzfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkFkZHJlc3MgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7YWRkcmVzc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Ob3RlcyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tub3Rlc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Db250YWN0IFN0YXR1cyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tjb250YWN0X3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJwYWRkaW5nOiAxNXB4IDBweDtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjsiPg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDtsaW5lLWhlaWdodDogMjJweDttYXJnaW46IDEwcHggMHB4IDE1cHg7ZmxvYXQ6IGxlZnQ7Ij5oYXMgYmVlbiBjb25maXJtZWQuPC9wPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMTBweCAwcHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7dGV4dC1hbGlnbjogY2VudGVyOyI+DQoJCQkJCQkJCQk8aDUgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTNweDttYXJnaW46IDBweCAwcHggNXB4OyI+VGhhbmsgeW91PC9oNT4NCgkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJPC9kaXY+DQoJCQkJCQk8L3RkPgkJCQkJDQoJCQkJCTwvdHI+CQkJCQ0KCQkJCTwvdGJvZHk+DQoJCQk8L3RhYmxlPgkNCgkJPC9kaXY+DQoJPC9kaXY+CQ0KPC9ib2R5Pg0KPC9odG1sPg==', 'E', 'C', 'A'),
(5, 'Appointment Rejected', '', 'PGh0bWw+DQo8aGVhZD4NCgk8bWV0YSBuYW1lPSJ2aWV3cG9ydCIgY29udGVudD0id2lkdGg9ZGV2aWNlLXdpZHRoLCBpbml0aWFsLXNjYWxlPTEuMCIvPg0KCTxtZXRhIGh0dHAtZXF1aXY9IkNvbnRlbnQtVHlwZSIgY29udGVudD0idGV4dC9odG1sOyBjaGFyc2V0PVVURi04IiAvPg0KCTx0aXRsZT5TdWJqZWN0OiB7e3NlcnZpY2VfbmFtZX19IG9uIHt7Ym9va2luZ19kYXRlfX08L3RpdGxlPg0KCTxsaW5rIGhyZWY9Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1Nb250c2VycmF0IiByZWw9InN0eWxlc2hlZXQiPg0KPC9oZWFkPg0KPGJvZHk+CQkNCgk8ZGl2IHN0eWxlPSJtYXJnaW46IDA7cGFkZGluZzogMDtmb250LWZhbWlseTogSGVsdmV0aWNhIE5ldWUsIEhlbHZldGljYSwgSGVsdmV0aWNhLCBBcmlhbCwgc2Fucy1zZXJpZjtmb250LXNpemU6IDEwMCU7bGluZS1oZWlnaHQ6IDEuNjtib3gtc2l6aW5nOiBib3JkZXItYm94OyI+CQ0KCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O21heC13aWR0aDogNjAwcHggIWltcG9ydGFudDttYXJnaW46IDAgYXV0byAhaW1wb3J0YW50O2NsZWFyOiBib3RoICFpbXBvcnRhbnQ7Ij4NCgkJCTx0YWJsZSBzdHlsZT0iYm9yZGVyOiAxcHggc29saWQgI2MyYzJjMjt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDttYXJnaW46IDMwcHggMHB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czogNXB4Oy1tb3otYm9yZGVyLXJhZGl1czogNXB4Oy1vLWJvcmRlci1yYWRpdXM6IDVweDtib3JkZXItcmFkaXVzOiA1cHg7Ij4NCgkJCQk8dGJvZHk+DQoJCQkJCTx0ciBzdHlsZT0iYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7Ij4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDU5JTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7dGV4dC1hbGlnbjogbGVmdDtmb250LWZhbWlseTogTW9udHNlcnJhdCwgc2Fucy1zZXJpZjsiPg0KCQkJCQkJCQl7e2NvbXBhbnlfbmFtZX19PGJyIC8+e3tjb21wYW55X2FkZHJlc3N9fTxiciAvPnt7Y29tcGFueV9jaXR5fX0sIHt7Y29tcGFueV9zdGF0ZX19LCB7e2NvbXBhbnlfemlwfX08YnIgLz57e2NvbXBhbnlfY291bnRyeX19PGJyIC8+e3tjb21wYW55X3Bob25lfX08YnIgLz57e2NvbXBhbnlfZW1haWx9fQ0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDQwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7Ij4NCgkJCQkJCQkJPGRpdiBzdHlsZT0id2lkdGg6IDEzMHB4O2hlaWdodDogMTAwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO21hcmdpbjogMHB4IGF1dG87Ij4NCgkJCQkJCQkJCTxpbWcgc3R5bGU9IndpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0O2Rpc3BsYXk6IGlubGluZS1ibG9jaztoZWlnaHQ6IDEwMCU7IiBzcmM9Int7YnVzaW5lc3NfbG9nb319IiAvPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQk8L2Rpdj4NCgkJCQkJCTwvdGQ+DQoJCQkJCQkNCgkJCQkJCQ0KCQkJCQk8L3RyPg0KCQkJCQk8dHI+DQoJCQkJCQk8dGQ+DQoJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMjVweCAzMHB4O2JhY2tncm91bmQ6ICNmZmY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDkwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQkJPGg2IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bWFyZ2luOiAxMHB4IDBweCAxMHB4O2ZvbnQtd2VpZ2h0OiA2MDA7Ij5EZWFyIHt7Y2xpZW50X25hbWV9fSw8L2g2Pg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDttYXJnaW46IDEwcHggMHB4IDE1cHg7Ij5Zb3VyIGFwcG9pbnRtZW50IHdpdGggZm9sbG93aW5nIGRldGFpbHM6PC9wPgkJCQkJCQkNCgkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTxkaXYgc3R5bGU9ImZsb2F0OiBsZWZ0O3dpZHRoOiAxMDAlO2Rpc3BsYXk6IGJsb2NrO3BhZGRpbmc6IDEwcHggMHB4OyI+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5XaGVuOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Ym9va2luZ19kYXRlfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkZvcjogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3NlcnZpY2VfbmFtZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5NZXRob2RzIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e21ldGhvZG5hbWV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+VW5pdHMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7dW5pdHN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+QWRkLW9ucyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3thZGRvbnN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UHJpY2UgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7cHJpY2V9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJDQoJCQkJCQkJCQkNCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPk5hbWUgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Zmlyc3RuYW1lfX0ge3tsYXN0bmFtZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5FbWFpbCA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tjbGllbnRfZW1haWx9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UGhvbmUgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7cGhvbmV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UGF5bWVudCA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twYXltZW50X21ldGhvZH19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5WYWNjdW0gQ2xlYW5lciA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3t2YWNjdW1fY2xlYW5lcl9zdGF0dXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UGFya2luZyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twYXJraW5nX3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5BZGRyZXNzIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2FkZHJlc3N9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+Tm90ZXMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7bm90ZXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+Q29udGFjdCBTdGF0dXMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Y29udGFjdF9zdGF0dXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMTVweCAwcHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7Ym9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7Ij4NCgkJCQkJCQkJCTxwIHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bGluZS1oZWlnaHQ6IDIycHg7bWFyZ2luOiAxMHB4IDBweCAxNXB4O2Zsb2F0OiBsZWZ0OyI+aGFzIGJlZW4gcmVqZWN0ZWQuPC9wPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMTBweCAwcHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7dGV4dC1hbGlnbjogY2VudGVyOyI+DQoJCQkJCQkJCQk8aDUgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTNweDttYXJnaW46IDBweCAwcHggNXB4OyI+VGhhbmsgeW91PC9oNT4NCgkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJPC9kaXY+DQoJCQkJCQk8L3RkPgkJCQkJDQoJCQkJCTwvdHI+CQkJCQ0KCQkJCTwvdGJvZHk+DQoJCQk8L3RhYmxlPgkNCgkJPC9kaXY+DQoJPC9kaXY+CQ0KPC9ib2R5Pg0KPC9odG1sPg==', 'E', 'R', 'C'),
(6, 'Appointment Rejected', '', 'PGh0bWw+DQo8aGVhZD4NCgk8bWV0YSBuYW1lPSJ2aWV3cG9ydCIgY29udGVudD0id2lkdGg9ZGV2aWNlLXdpZHRoLCBpbml0aWFsLXNjYWxlPTEuMCIvPg0KCTxtZXRhIGh0dHAtZXF1aXY9IkNvbnRlbnQtVHlwZSIgY29udGVudD0idGV4dC9odG1sOyBjaGFyc2V0PVVURi04IiAvPg0KCTx0aXRsZT5TdWJqZWN0OiB7e3NlcnZpY2VfbmFtZX19IG9uIHt7Ym9va2luZ19kYXRlfX08L3RpdGxlPg0KCTxsaW5rIGhyZWY9Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1Nb250c2VycmF0IiByZWw9InN0eWxlc2hlZXQiPg0KPC9oZWFkPg0KPGJvZHk+CQkNCgk8ZGl2IHN0eWxlPSJtYXJnaW46IDA7cGFkZGluZzogMDtmb250LWZhbWlseTogSGVsdmV0aWNhIE5ldWUsIEhlbHZldGljYSwgSGVsdmV0aWNhLCBBcmlhbCwgc2Fucy1zZXJpZjtmb250LXNpemU6IDEwMCU7bGluZS1oZWlnaHQ6IDEuNjtib3gtc2l6aW5nOiBib3JkZXItYm94OyI+CQ0KCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O21heC13aWR0aDogNjAwcHggIWltcG9ydGFudDttYXJnaW46IDAgYXV0byAhaW1wb3J0YW50O2NsZWFyOiBib3RoICFpbXBvcnRhbnQ7Ij4NCgkJCTx0YWJsZSBzdHlsZT0iYm9yZGVyOiAxcHggc29saWQgI2MyYzJjMjt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDttYXJnaW46IDMwcHggMHB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czogNXB4Oy1tb3otYm9yZGVyLXJhZGl1czogNXB4Oy1vLWJvcmRlci1yYWRpdXM6IDVweDtib3JkZXItcmFkaXVzOiA1cHg7Ij4NCgkJCQk8dGJvZHk+DQoJCQkJCTx0ciBzdHlsZT0iYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7Ij4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDU5JTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7dGV4dC1hbGlnbjogbGVmdDtmb250LWZhbWlseTogTW9udHNlcnJhdCwgc2Fucy1zZXJpZjsiPg0KCQkJCQkJCQl7e2NvbXBhbnlfbmFtZX19PGJyIC8+e3tjb21wYW55X2FkZHJlc3N9fTxiciAvPnt7Y29tcGFueV9jaXR5fX0sIHt7Y29tcGFueV9zdGF0ZX19LCB7e2NvbXBhbnlfemlwfX08YnIgLz57e2NvbXBhbnlfY291bnRyeX19PGJyIC8+e3tjb21wYW55X3Bob25lfX08YnIgLz57e2NvbXBhbnlfZW1haWx9fQ0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDQwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7Ij4NCgkJCQkJCQkJPGRpdiBzdHlsZT0id2lkdGg6IDEzMHB4O2hlaWdodDogMTAwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO21hcmdpbjogMHB4IGF1dG87Ij4NCgkJCQkJCQkJCTxpbWcgc3R5bGU9IndpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0O2Rpc3BsYXk6IGlubGluZS1ibG9jaztoZWlnaHQ6IDEwMCU7IiBzcmM9Int7YnVzaW5lc3NfbG9nb319IiAvPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQk8L2Rpdj4NCgkJCQkJCTwvdGQ+DQoJCQkJCQkNCgkJCQkJCQ0KCQkJCQk8L3RyPg0KCQkJCQk8dHI+DQoJCQkJCQk8dGQ+DQoJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMjVweCAzMHB4O2JhY2tncm91bmQ6ICNmZmY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDkwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQkJPGg2IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bWFyZ2luOiAxMHB4IDBweCAxMHB4O2ZvbnQtd2VpZ2h0OiA2MDA7Ij5EZWFyIHt7YWRtaW5fbmFtZX19LCA8L2g2Pg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDttYXJnaW46IDEwcHggMHB4IDE1cHg7Ij5UaGUgYXBwb2ludG1lbnQgd2l0aCB7e2NsaWVudF9uYW1lfX0gd2l0aCBmb2xsb3dpbmcgZGV0YWlsczo8L3A+CQkJCQkJCQ0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPGRpdiBzdHlsZT0iZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7cGFkZGluZzogMTBweCAwcHg7Ij4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPldoZW46IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tib29raW5nX2RhdGV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+Rm9yOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7c2VydmljZV9uYW1lfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPk1ldGhvZHMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7bWV0aG9kbmFtZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Vbml0cyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3t1bml0c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5BZGQtb25zIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2FkZG9uc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QcmljZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twcmljZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQkNCgkJCQkJCQkJCQ0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+TmFtZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tmaXJzdG5hbWV9fSB7e2xhc3RuYW1lfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkVtYWlsIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2NsaWVudF9lbWFpbH19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QaG9uZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twaG9uZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QYXltZW50IDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3BheW1lbnRfbWV0aG9kfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPlZhY2N1bSBDbGVhbmVyIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3ZhY2N1bV9jbGVhbmVyX3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QYXJraW5nIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3Bhcmtpbmdfc3RhdHVzfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkFkZHJlc3MgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7YWRkcmVzc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Ob3RlcyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tub3Rlc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Db250YWN0IFN0YXR1cyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tjb250YWN0X3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJwYWRkaW5nOiAxNXB4IDBweDtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjsiPg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDtsaW5lLWhlaWdodDogMjJweDttYXJnaW46IDEwcHggMHB4IDE1cHg7ZmxvYXQ6IGxlZnQ7Ij5oYXMgYmVlbiByZWplY3RlZC48L3A+DQoJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJwYWRkaW5nOiAxMHB4IDBweDtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jazt0ZXh0LWFsaWduOiBjZW50ZXI7Ij4NCgkJCQkJCQkJCTxoNSBzdHlsZT0iY29sb3I6ICM2MDYwNjA7Zm9udC1zaXplOiAxM3B4O21hcmdpbjogMHB4IDBweCA1cHg7Ij5UaGFuayB5b3U8L2g1Pg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQk8L2Rpdj4NCgkJCQkJCTwvdGQ+CQkJCQkNCgkJCQkJPC90cj4JCQkJDQoJCQkJPC90Ym9keT4NCgkJCTwvdGFibGU+CQ0KCQk8L2Rpdj4NCgk8L2Rpdj4JDQo8L2JvZHk+DQo8L2h0bWw+', 'E', 'R', 'A'),
(7, 'Appointment Cancelled by you', '', 'PGh0bWw+DQo8aGVhZD4NCgk8bWV0YSBuYW1lPSJ2aWV3cG9ydCIgY29udGVudD0id2lkdGg9ZGV2aWNlLXdpZHRoLCBpbml0aWFsLXNjYWxlPTEuMCIvPg0KCTxtZXRhIGh0dHAtZXF1aXY9IkNvbnRlbnQtVHlwZSIgY29udGVudD0idGV4dC9odG1sOyBjaGFyc2V0PVVURi04IiAvPg0KCTx0aXRsZT5TdWJqZWN0OiB7e3NlcnZpY2VfbmFtZX19IG9uIHt7Ym9va2luZ19kYXRlfX08L3RpdGxlPg0KCTxsaW5rIGhyZWY9Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1Nb250c2VycmF0IiByZWw9InN0eWxlc2hlZXQiPg0KPC9oZWFkPg0KPGJvZHk+CQkNCgk8ZGl2IHN0eWxlPSJtYXJnaW46IDA7cGFkZGluZzogMDtmb250LWZhbWlseTogSGVsdmV0aWNhIE5ldWUsIEhlbHZldGljYSwgSGVsdmV0aWNhLCBBcmlhbCwgc2Fucy1zZXJpZjtmb250LXNpemU6IDEwMCU7bGluZS1oZWlnaHQ6IDEuNjtib3gtc2l6aW5nOiBib3JkZXItYm94OyI+CQ0KCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O21heC13aWR0aDogNjAwcHggIWltcG9ydGFudDttYXJnaW46IDAgYXV0byAhaW1wb3J0YW50O2NsZWFyOiBib3RoICFpbXBvcnRhbnQ7Ij4NCgkJCTx0YWJsZSBzdHlsZT0iYm9yZGVyOiAxcHggc29saWQgI2MyYzJjMjt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDttYXJnaW46IDMwcHggMHB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czogNXB4Oy1tb3otYm9yZGVyLXJhZGl1czogNXB4Oy1vLWJvcmRlci1yYWRpdXM6IDVweDtib3JkZXItcmFkaXVzOiA1cHg7Ij4NCgkJCQk8dGJvZHk+DQoJCQkJCTx0ciBzdHlsZT0iYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7Ij4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDU5JTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7dGV4dC1hbGlnbjogbGVmdDtmb250LWZhbWlseTogTW9udHNlcnJhdCwgc2Fucy1zZXJpZjsiPg0KCQkJCQkJCQl7e2NvbXBhbnlfbmFtZX19PGJyIC8+e3tjb21wYW55X2FkZHJlc3N9fTxiciAvPnt7Y29tcGFueV9jaXR5fX0sIHt7Y29tcGFueV9zdGF0ZX19LCB7e2NvbXBhbnlfemlwfX08YnIgLz57e2NvbXBhbnlfY291bnRyeX19PGJyIC8+e3tjb21wYW55X3Bob25lfX08YnIgLz57e2NvbXBhbnlfZW1haWx9fQ0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDQwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7Ij4NCgkJCQkJCQkJPGRpdiBzdHlsZT0id2lkdGg6IDEzMHB4O2hlaWdodDogMTAwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO21hcmdpbjogMHB4IGF1dG87Ij4NCgkJCQkJCQkJCTxpbWcgc3R5bGU9IndpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0O2Rpc3BsYXk6IGlubGluZS1ibG9jaztoZWlnaHQ6IDEwMCU7IiBzcmM9Int7YnVzaW5lc3NfbG9nb319IiAvPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQk8L2Rpdj4NCgkJCQkJCTwvdGQ+DQoJCQkJCQkNCgkJCQkJCQ0KCQkJCQk8L3RyPg0KCQkJCQk8dHI+DQoJCQkJCQk8dGQ+DQoJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMjVweCAzMHB4O2JhY2tncm91bmQ6ICNmZmY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDkwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQkJPGg2IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bWFyZ2luOiAxMHB4IDBweCAxMHB4O2ZvbnQtd2VpZ2h0OiA2MDA7Ij5EZWFyIHt7Y2xpZW50X25hbWV9fSw8L2g2Pg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDttYXJnaW46IDEwcHggMHB4IDE1cHg7Ij5Zb3VyIGFwcG9pbnRtZW50IHdpdGggZm9sbG93aW5nIGRldGFpbHM6PC9wPgkJCQkJCQkNCgkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTxkaXYgc3R5bGU9ImZsb2F0OiBsZWZ0O3dpZHRoOiAxMDAlO2Rpc3BsYXk6IGJsb2NrO3BhZGRpbmc6IDEwcHggMHB4OyI+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5XaGVuOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Ym9va2luZ19kYXRlfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkZvcjogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3NlcnZpY2VfbmFtZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5NZXRob2RzIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e21ldGhvZG5hbWV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+VW5pdHMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7dW5pdHN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+QWRkLW9ucyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3thZGRvbnN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UHJpY2UgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7cHJpY2V9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJDQoJCQkJCQkJCQkNCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPk5hbWUgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Zmlyc3RuYW1lfX0ge3tsYXN0bmFtZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5FbWFpbCA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tjbGllbnRfZW1haWx9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UGhvbmUgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7cGhvbmV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UGF5bWVudCA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twYXltZW50X21ldGhvZH19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5WYWNjdW0gQ2xlYW5lciA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3t2YWNjdW1fY2xlYW5lcl9zdGF0dXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UGFya2luZyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twYXJraW5nX3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5BZGRyZXNzIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2FkZHJlc3N9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+Tm90ZXMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7bm90ZXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+Q29udGFjdCBTdGF0dXMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Y29udGFjdF9zdGF0dXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMTVweCAwcHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7Ym9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7Ij4NCgkJCQkJCQkJCTxwIHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bGluZS1oZWlnaHQ6IDIycHg7bWFyZ2luOiAxMHB4IDBweCAxNXB4O2Zsb2F0OiBsZWZ0OyI+aGFzIGJlZW4gY2FuY2VsbGVkLjwvcD4NCgkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTxkaXYgc3R5bGU9InBhZGRpbmc6IDEwcHggMHB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiAxMDAlO2Rpc3BsYXk6IGJsb2NrO3RleHQtYWxpZ246IGNlbnRlcjsiPg0KCQkJCQkJCQkJPGg1IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDEzcHg7bWFyZ2luOiAwcHggMHB4IDVweDsiPlRoYW5rIHlvdTwvaDU+DQoJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4JCQkJCQ0KCQkJCQk8L3RyPgkJCQkNCgkJCQk8L3Rib2R5Pg0KCQkJPC90YWJsZT4JDQoJCTwvZGl2Pg0KCTwvZGl2PgkNCjwvYm9keT4NCjwvaHRtbD4=', 'E', 'CC', 'C'),
(8, 'Appointment Cancelled By Customer', '', 'PGh0bWw+DQo8aGVhZD4NCgk8bWV0YSBuYW1lPSJ2aWV3cG9ydCIgY29udGVudD0id2lkdGg9ZGV2aWNlLXdpZHRoLCBpbml0aWFsLXNjYWxlPTEuMCIvPg0KCTxtZXRhIGh0dHAtZXF1aXY9IkNvbnRlbnQtVHlwZSIgY29udGVudD0idGV4dC9odG1sOyBjaGFyc2V0PVVURi04IiAvPg0KCTx0aXRsZT5TdWJqZWN0OiB7e3NlcnZpY2VfbmFtZX19IG9uIHt7Ym9va2luZ19kYXRlfX08L3RpdGxlPg0KCTxsaW5rIGhyZWY9Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1Nb250c2VycmF0IiByZWw9InN0eWxlc2hlZXQiPg0KPC9oZWFkPg0KPGJvZHk+CQkNCgk8ZGl2IHN0eWxlPSJtYXJnaW46IDA7cGFkZGluZzogMDtmb250LWZhbWlseTogSGVsdmV0aWNhIE5ldWUsIEhlbHZldGljYSwgSGVsdmV0aWNhLCBBcmlhbCwgc2Fucy1zZXJpZjtmb250LXNpemU6IDEwMCU7bGluZS1oZWlnaHQ6IDEuNjtib3gtc2l6aW5nOiBib3JkZXItYm94OyI+CQ0KCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O21heC13aWR0aDogNjAwcHggIWltcG9ydGFudDttYXJnaW46IDAgYXV0byAhaW1wb3J0YW50O2NsZWFyOiBib3RoICFpbXBvcnRhbnQ7Ij4NCgkJCTx0YWJsZSBzdHlsZT0iYm9yZGVyOiAxcHggc29saWQgI2MyYzJjMjt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDttYXJnaW46IDMwcHggMHB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czogNXB4Oy1tb3otYm9yZGVyLXJhZGl1czogNXB4Oy1vLWJvcmRlci1yYWRpdXM6IDVweDtib3JkZXItcmFkaXVzOiA1cHg7Ij4NCgkJCQk8dGJvZHk+DQoJCQkJCTx0ciBzdHlsZT0iYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7Ij4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDU5JTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7dGV4dC1hbGlnbjogbGVmdDtmb250LWZhbWlseTogTW9udHNlcnJhdCwgc2Fucy1zZXJpZjsiPg0KCQkJCQkJCQl7e2NvbXBhbnlfbmFtZX19PGJyIC8+e3tjb21wYW55X2FkZHJlc3N9fTxiciAvPnt7Y29tcGFueV9jaXR5fX0sIHt7Y29tcGFueV9zdGF0ZX19LCB7e2NvbXBhbnlfemlwfX08YnIgLz57e2NvbXBhbnlfY291bnRyeX19PGJyIC8+e3tjb21wYW55X3Bob25lfX08YnIgLz57e2NvbXBhbnlfZW1haWx9fQ0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDQwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7Ij4NCgkJCQkJCQkJPGRpdiBzdHlsZT0id2lkdGg6IDEzMHB4O2hlaWdodDogMTAwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO21hcmdpbjogMHB4IGF1dG87Ij4NCgkJCQkJCQkJCTxpbWcgc3R5bGU9IndpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0O2Rpc3BsYXk6IGlubGluZS1ibG9jaztoZWlnaHQ6IDEwMCU7IiBzcmM9Int7YnVzaW5lc3NfbG9nb319IiAvPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQk8L2Rpdj4NCgkJCQkJCTwvdGQ+DQoJCQkJCQkNCgkJCQkJCQ0KCQkJCQk8L3RyPg0KCQkJCQk8dHI+DQoJCQkJCQk8dGQ+DQoJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMjVweCAzMHB4O2JhY2tncm91bmQ6ICNmZmY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDkwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQkJPGg2IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bWFyZ2luOiAxMHB4IDBweCAxMHB4O2ZvbnQtd2VpZ2h0OiA2MDA7Ij5EZWFyIHt7YWRtaW5fbmFtZX19LCA8L2g2Pg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDttYXJnaW46IDEwcHggMHB4IDE1cHg7Ij5UaGUgYXBwb2ludG1lbnQgd2l0aCB7e2NsaWVudF9uYW1lfX0gd2l0aCBmb2xsb3dpbmcgZGV0YWlsczo8L3A+CQkJCQkJCQ0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPGRpdiBzdHlsZT0iZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7cGFkZGluZzogMTBweCAwcHg7Ij4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPldoZW46IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tib29raW5nX2RhdGV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+Rm9yOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7c2VydmljZV9uYW1lfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPk1ldGhvZHMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7bWV0aG9kbmFtZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Vbml0cyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3t1bml0c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5BZGQtb25zIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2FkZG9uc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QcmljZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twcmljZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQkNCgkJCQkJCQkJCQ0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+TmFtZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tmaXJzdG5hbWV9fSB7e2xhc3RuYW1lfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkVtYWlsIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2NsaWVudF9lbWFpbH19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QaG9uZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twaG9uZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QYXltZW50IDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3BheW1lbnRfbWV0aG9kfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPlZhY2N1bSBDbGVhbmVyIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3ZhY2N1bV9jbGVhbmVyX3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QYXJraW5nIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3Bhcmtpbmdfc3RhdHVzfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkFkZHJlc3MgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7YWRkcmVzc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Ob3RlcyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tub3Rlc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Db250YWN0IFN0YXR1cyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tjb250YWN0X3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJwYWRkaW5nOiAxNXB4IDBweDtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjsiPg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDtsaW5lLWhlaWdodDogMjJweDttYXJnaW46IDEwcHggMHB4IDE1cHg7ZmxvYXQ6IGxlZnQ7Ij5oYXMgYmVlbiBjYW5jZWxsZWQuPC9wPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMTBweCAwcHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7dGV4dC1hbGlnbjogY2VudGVyOyI+DQoJCQkJCQkJCQk8aDUgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTNweDttYXJnaW46IDBweCAwcHggNXB4OyI+VGhhbmsgeW91PC9oNT4NCgkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJPC9kaXY+DQoJCQkJCQk8L3RkPgkJCQkJDQoJCQkJCTwvdHI+CQkJCQ0KCQkJCTwvdGJvZHk+DQoJCQk8L3RhYmxlPgkNCgkJPC9kaXY+DQoJPC9kaXY+CQ0KPC9ib2R5Pg0KPC9odG1sPg==', 'E', 'CC', 'A'),
(9, 'Appointment Rescheduled by you', '', 'PGh0bWw+DQo8aGVhZD4NCgk8bWV0YSBuYW1lPSJ2aWV3cG9ydCIgY29udGVudD0id2lkdGg9ZGV2aWNlLXdpZHRoLCBpbml0aWFsLXNjYWxlPTEuMCIvPg0KCTxtZXRhIGh0dHAtZXF1aXY9IkNvbnRlbnQtVHlwZSIgY29udGVudD0idGV4dC9odG1sOyBjaGFyc2V0PVVURi04IiAvPg0KCTx0aXRsZT5TdWJqZWN0OiB7e3NlcnZpY2VfbmFtZX19IG9uIHt7Ym9va2luZ19kYXRlfX08L3RpdGxlPg0KCTxsaW5rIGhyZWY9Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1Nb250c2VycmF0IiByZWw9InN0eWxlc2hlZXQiPg0KPC9oZWFkPg0KPGJvZHk+CQkNCgk8ZGl2IHN0eWxlPSJtYXJnaW46IDA7cGFkZGluZzogMDtmb250LWZhbWlseTogSGVsdmV0aWNhIE5ldWUsIEhlbHZldGljYSwgSGVsdmV0aWNhLCBBcmlhbCwgc2Fucy1zZXJpZjtmb250LXNpemU6IDEwMCU7bGluZS1oZWlnaHQ6IDEuNjtib3gtc2l6aW5nOiBib3JkZXItYm94OyI+CQ0KCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O21heC13aWR0aDogNjAwcHggIWltcG9ydGFudDttYXJnaW46IDAgYXV0byAhaW1wb3J0YW50O2NsZWFyOiBib3RoICFpbXBvcnRhbnQ7Ij4NCgkJCTx0YWJsZSBzdHlsZT0iYm9yZGVyOiAxcHggc29saWQgI2MyYzJjMjt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDttYXJnaW46IDMwcHggMHB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czogNXB4Oy1tb3otYm9yZGVyLXJhZGl1czogNXB4Oy1vLWJvcmRlci1yYWRpdXM6IDVweDtib3JkZXItcmFkaXVzOiA1cHg7Ij4NCgkJCQk8dGJvZHk+DQoJCQkJCTx0ciBzdHlsZT0iYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7Ij4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDU5JTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7dGV4dC1hbGlnbjogbGVmdDtmb250LWZhbWlseTogTW9udHNlcnJhdCwgc2Fucy1zZXJpZjsiPg0KCQkJCQkJCQl7e2NvbXBhbnlfbmFtZX19PGJyIC8+e3tjb21wYW55X2FkZHJlc3N9fTxiciAvPnt7Y29tcGFueV9jaXR5fX0sIHt7Y29tcGFueV9zdGF0ZX19LCB7e2NvbXBhbnlfemlwfX08YnIgLz57e2NvbXBhbnlfY291bnRyeX19PGJyIC8+e3tjb21wYW55X3Bob25lfX08YnIgLz57e2NvbXBhbnlfZW1haWx9fQ0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDQwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7Ij4NCgkJCQkJCQkJPGRpdiBzdHlsZT0id2lkdGg6IDEzMHB4O2hlaWdodDogMTAwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO21hcmdpbjogMHB4IGF1dG87Ij4NCgkJCQkJCQkJCTxpbWcgc3R5bGU9IndpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0O2Rpc3BsYXk6IGlubGluZS1ibG9jaztoZWlnaHQ6IDEwMCU7IiBzcmM9Int7YnVzaW5lc3NfbG9nb319IiAvPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQk8L2Rpdj4NCgkJCQkJCTwvdGQ+DQoJCQkJCQkNCgkJCQkJCQ0KCQkJCQk8L3RyPg0KCQkJCQk8dHI+DQoJCQkJCQk8dGQ+DQoJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMjVweCAzMHB4O2JhY2tncm91bmQ6ICNmZmY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDkwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQkJPGg2IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bWFyZ2luOiAxMHB4IDBweCAxMHB4O2ZvbnQtd2VpZ2h0OiA2MDA7Ij5EZWFyIHt7Y2xpZW50X25hbWV9fSw8L2g2Pg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDttYXJnaW46IDEwcHggMHB4IDE1cHg7Ij5Zb3VyIGFwcG9pbnRtZW50IHdpdGggZm9sbG93aW5nIGRldGFpbHM6PC9wPgkJCQkJCQkNCgkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTxkaXYgc3R5bGU9ImZsb2F0OiBsZWZ0O3dpZHRoOiAxMDAlO2Rpc3BsYXk6IGJsb2NrO3BhZGRpbmc6IDEwcHggMHB4OyI+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5XaGVuOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Ym9va2luZ19kYXRlfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkZvcjogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3NlcnZpY2VfbmFtZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5NZXRob2RzIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e21ldGhvZG5hbWV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+VW5pdHMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7dW5pdHN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+QWRkLW9ucyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3thZGRvbnN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UHJpY2UgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7cHJpY2V9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJDQoJCQkJCQkJCQkNCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPk5hbWUgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Zmlyc3RuYW1lfX0ge3tsYXN0bmFtZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5FbWFpbCA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tjbGllbnRfZW1haWx9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UGhvbmUgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7cGhvbmV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UGF5bWVudCA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twYXltZW50X21ldGhvZH19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5WYWNjdW0gQ2xlYW5lciA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3t2YWNjdW1fY2xlYW5lcl9zdGF0dXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UGFya2luZyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twYXJraW5nX3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5BZGRyZXNzIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2FkZHJlc3N9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+Tm90ZXMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7bm90ZXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+Q29udGFjdCBTdGF0dXMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Y29udGFjdF9zdGF0dXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMTVweCAwcHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7Ym9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7Ij4NCgkJCQkJCQkJCTxwIHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bGluZS1oZWlnaHQ6IDIycHg7bWFyZ2luOiAxMHB4IDBweCAxNXB4O2Zsb2F0OiBsZWZ0OyI+aGFzIGJlZW4gcmVzY2hlZHVsZWQuPC9wPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMTBweCAwcHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7dGV4dC1hbGlnbjogY2VudGVyOyI+DQoJCQkJCQkJCQk8aDUgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTNweDttYXJnaW46IDBweCAwcHggNXB4OyI+VGhhbmsgeW91PC9oNT4NCgkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJPC9kaXY+DQoJCQkJCQk8L3RkPgkJCQkJDQoJCQkJCTwvdHI+CQkJCQ0KCQkJCTwvdGJvZHk+DQoJCQk8L3RhYmxlPgkNCgkJPC9kaXY+DQoJPC9kaXY+CQ0KPC9ib2R5Pg0KPC9odG1sPg==', 'E', 'RS', 'C'),
(10, 'Appointment Rescheduled By Customer', '', 'PGh0bWw+DQo8aGVhZD4NCgk8bWV0YSBuYW1lPSJ2aWV3cG9ydCIgY29udGVudD0id2lkdGg9ZGV2aWNlLXdpZHRoLCBpbml0aWFsLXNjYWxlPTEuMCIvPg0KCTxtZXRhIGh0dHAtZXF1aXY9IkNvbnRlbnQtVHlwZSIgY29udGVudD0idGV4dC9odG1sOyBjaGFyc2V0PVVURi04IiAvPg0KCTx0aXRsZT5TdWJqZWN0OiB7e3NlcnZpY2VfbmFtZX19IG9uIHt7Ym9va2luZ19kYXRlfX08L3RpdGxlPg0KCTxsaW5rIGhyZWY9Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1Nb250c2VycmF0IiByZWw9InN0eWxlc2hlZXQiPg0KPC9oZWFkPg0KPGJvZHk+CQkNCgk8ZGl2IHN0eWxlPSJtYXJnaW46IDA7cGFkZGluZzogMDtmb250LWZhbWlseTogSGVsdmV0aWNhIE5ldWUsIEhlbHZldGljYSwgSGVsdmV0aWNhLCBBcmlhbCwgc2Fucy1zZXJpZjtmb250LXNpemU6IDEwMCU7bGluZS1oZWlnaHQ6IDEuNjtib3gtc2l6aW5nOiBib3JkZXItYm94OyI+CQ0KCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O21heC13aWR0aDogNjAwcHggIWltcG9ydGFudDttYXJnaW46IDAgYXV0byAhaW1wb3J0YW50O2NsZWFyOiBib3RoICFpbXBvcnRhbnQ7Ij4NCgkJCTx0YWJsZSBzdHlsZT0iYm9yZGVyOiAxcHggc29saWQgI2MyYzJjMjt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDttYXJnaW46IDMwcHggMHB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czogNXB4Oy1tb3otYm9yZGVyLXJhZGl1czogNXB4Oy1vLWJvcmRlci1yYWRpdXM6IDVweDtib3JkZXItcmFkaXVzOiA1cHg7Ij4NCgkJCQk8dGJvZHk+DQoJCQkJCTx0ciBzdHlsZT0iYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7Ij4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDU5JTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7dGV4dC1hbGlnbjogbGVmdDtmb250LWZhbWlseTogTW9udHNlcnJhdCwgc2Fucy1zZXJpZjsiPg0KCQkJCQkJCQl7e2NvbXBhbnlfbmFtZX19PGJyIC8+e3tjb21wYW55X2FkZHJlc3N9fTxiciAvPnt7Y29tcGFueV9jaXR5fX0sIHt7Y29tcGFueV9zdGF0ZX19LCB7e2NvbXBhbnlfemlwfX08YnIgLz57e2NvbXBhbnlfY291bnRyeX19PGJyIC8+e3tjb21wYW55X3Bob25lfX08YnIgLz57e2NvbXBhbnlfZW1haWx9fQ0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDQwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7Ij4NCgkJCQkJCQkJPGRpdiBzdHlsZT0id2lkdGg6IDEzMHB4O2hlaWdodDogMTAwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO21hcmdpbjogMHB4IGF1dG87Ij4NCgkJCQkJCQkJCTxpbWcgc3R5bGU9IndpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0O2Rpc3BsYXk6IGlubGluZS1ibG9jaztoZWlnaHQ6IDEwMCU7IiBzcmM9Int7YnVzaW5lc3NfbG9nb319IiAvPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQk8L2Rpdj4NCgkJCQkJCTwvdGQ+DQoJCQkJCQkNCgkJCQkJCQ0KCQkJCQk8L3RyPg0KCQkJCQk8dHI+DQoJCQkJCQk8dGQ+DQoJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMjVweCAzMHB4O2JhY2tncm91bmQ6ICNmZmY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDkwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQkJPGg2IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bWFyZ2luOiAxMHB4IDBweCAxMHB4O2ZvbnQtd2VpZ2h0OiA2MDA7Ij5EZWFyIHt7YWRtaW5fbmFtZX19LCA8L2g2Pg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDttYXJnaW46IDEwcHggMHB4IDE1cHg7Ij5UaGUgYXBwb2ludG1lbnQgd2l0aCB7e2NsaWVudF9uYW1lfX0gd2l0aCBmb2xsb3dpbmcgZGV0YWlsczo8L3A+CQkJCQkJCQ0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPGRpdiBzdHlsZT0iZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7cGFkZGluZzogMTBweCAwcHg7Ij4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPldoZW46IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tib29raW5nX2RhdGV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+Rm9yOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7c2VydmljZV9uYW1lfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPk1ldGhvZHMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7bWV0aG9kbmFtZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Vbml0cyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3t1bml0c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5BZGQtb25zIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2FkZG9uc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QcmljZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twcmljZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQkNCgkJCQkJCQkJCQ0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+TmFtZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tmaXJzdG5hbWV9fSB7e2xhc3RuYW1lfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkVtYWlsIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2NsaWVudF9lbWFpbH19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QaG9uZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twaG9uZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QYXltZW50IDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3BheW1lbnRfbWV0aG9kfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPlZhY2N1bSBDbGVhbmVyIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3ZhY2N1bV9jbGVhbmVyX3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QYXJraW5nIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3Bhcmtpbmdfc3RhdHVzfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkFkZHJlc3MgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7YWRkcmVzc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Ob3RlcyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tub3Rlc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Db250YWN0IFN0YXR1cyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tjb250YWN0X3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJwYWRkaW5nOiAxNXB4IDBweDtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjsiPg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDtsaW5lLWhlaWdodDogMjJweDttYXJnaW46IDEwcHggMHB4IDE1cHg7ZmxvYXQ6IGxlZnQ7Ij5oYXMgYmVlbiByZXNjaGVkdWxlZC48L3A+DQoJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJwYWRkaW5nOiAxMHB4IDBweDtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jazt0ZXh0LWFsaWduOiBjZW50ZXI7Ij4NCgkJCQkJCQkJCTxoNSBzdHlsZT0iY29sb3I6ICM2MDYwNjA7Zm9udC1zaXplOiAxM3B4O21hcmdpbjogMHB4IDBweCA1cHg7Ij5UaGFuayB5b3U8L2g1Pg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQk8L2Rpdj4NCgkJCQkJCTwvdGQ+CQkJCQkNCgkJCQkJPC90cj4JCQkJDQoJCQkJPC90Ym9keT4NCgkJCTwvdGFibGU+CQ0KCQk8L2Rpdj4NCgk8L2Rpdj4JDQo8L2JvZHk+DQo8L2h0bWw+', 'E', 'RS', 'A'),
(11, 'Client Appointment Reminder', '', 'PGh0bWw+DQo8aGVhZD4NCgk8bWV0YSBuYW1lPSJ2aWV3cG9ydCIgY29udGVudD0id2lkdGg9ZGV2aWNlLXdpZHRoLCBpbml0aWFsLXNjYWxlPTEuMCIvPg0KCTxtZXRhIGh0dHAtZXF1aXY9IkNvbnRlbnQtVHlwZSIgY29udGVudD0idGV4dC9odG1sOyBjaGFyc2V0PVVURi04IiAvPg0KCTx0aXRsZT5TdWJqZWN0OiB7e3NlcnZpY2VfbmFtZX19IG9uIHt7Ym9va2luZ19kYXRlfX08L3RpdGxlPg0KCTxsaW5rIGhyZWY9Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1Nb250c2VycmF0IiByZWw9InN0eWxlc2hlZXQiPg0KPC9oZWFkPg0KPGJvZHk+CQkNCgk8ZGl2IHN0eWxlPSJtYXJnaW46IDA7cGFkZGluZzogMDtmb250LWZhbWlseTogSGVsdmV0aWNhIE5ldWUsIEhlbHZldGljYSwgSGVsdmV0aWNhLCBBcmlhbCwgc2Fucy1zZXJpZjtmb250LXNpemU6IDEwMCU7bGluZS1oZWlnaHQ6IDEuNjtib3gtc2l6aW5nOiBib3JkZXItYm94OyI+CQ0KCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O21heC13aWR0aDogNjAwcHggIWltcG9ydGFudDttYXJnaW46IDAgYXV0byAhaW1wb3J0YW50O2NsZWFyOiBib3RoICFpbXBvcnRhbnQ7Ij4NCgkJCTx0YWJsZSBzdHlsZT0iYm9yZGVyOiAxcHggc29saWQgI2MyYzJjMjt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDttYXJnaW46IDMwcHggMHB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czogNXB4Oy1tb3otYm9yZGVyLXJhZGl1czogNXB4Oy1vLWJvcmRlci1yYWRpdXM6IDVweDtib3JkZXItcmFkaXVzOiA1cHg7Ij4NCgkJCQk8dGJvZHk+DQoJCQkJCTx0ciBzdHlsZT0iYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7Ij4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDU5JTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7dGV4dC1hbGlnbjogbGVmdDtmb250LWZhbWlseTogTW9udHNlcnJhdCwgc2Fucy1zZXJpZjsiPg0KCQkJCQkJCQl7e2NvbXBhbnlfbmFtZX19PGJyIC8+e3tjb21wYW55X2FkZHJlc3N9fTxiciAvPnt7Y29tcGFueV9jaXR5fX0sIHt7Y29tcGFueV9zdGF0ZX19LCB7e2NvbXBhbnlfemlwfX08YnIgLz57e2NvbXBhbnlfY291bnRyeX19PGJyIC8+e3tjb21wYW55X3Bob25lfX08YnIgLz57e2NvbXBhbnlfZW1haWx9fQ0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDQwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7Ij4NCgkJCQkJCQkJPGRpdiBzdHlsZT0id2lkdGg6IDEzMHB4O2hlaWdodDogMTAwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO21hcmdpbjogMHB4IGF1dG87Ij4NCgkJCQkJCQkJCTxpbWcgc3R5bGU9IndpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0O2Rpc3BsYXk6IGlubGluZS1ibG9jaztoZWlnaHQ6IDEwMCU7IiBzcmM9Int7YnVzaW5lc3NfbG9nb319IiAvPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQk8L2Rpdj4NCgkJCQkJCTwvdGQ+DQoJCQkJCQkNCgkJCQkJCQ0KCQkJCQk8L3RyPg0KCQkJCQk8dHI+DQoJCQkJCQk8dGQ+DQoJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMjVweCAzMHB4O2JhY2tncm91bmQ6ICNmZmY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDkwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQkJPGg2IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bWFyZ2luOiAxMHB4IDBweCAxMHB4O2ZvbnQtd2VpZ2h0OiA2MDA7Ij5EZWFyIHt7Y2xpZW50X25hbWV9fSw8L2g2Pg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDttYXJnaW46IDEwcHggMHB4IDE1cHg7Ij5XZSBqdXN0IHdhbnRlZCB0byByZW1pbmQgeW91IHRoYXQgeW91ciBhcHBvaW50bWVudCB3aXRoIHt7YWRtaW5fbmFtZX19IGlzIHNjaGVkdWxlZCBpbiA8Yj57e2FwcF9yZW1haW5fdGltZX19PC9iPiBob3Vycy48L3A+CQkJCQkJCQ0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPGRpdiBzdHlsZT0iZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7cGFkZGluZzogMTBweCAwcHg7Ij4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPldoZW46IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tib29raW5nX2RhdGV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+Rm9yOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7c2VydmljZV9uYW1lfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPk1ldGhvZHMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7bWV0aG9kbmFtZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Vbml0cyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3t1bml0c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5BZGQtb25zIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2FkZG9uc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QcmljZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twcmljZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQkNCgkJCQkJCQkJCQ0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+TmFtZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tmaXJzdG5hbWV9fSB7e2xhc3RuYW1lfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkVtYWlsIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2NsaWVudF9lbWFpbH19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QaG9uZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twaG9uZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QYXltZW50IDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3BheW1lbnRfbWV0aG9kfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPlZhY2N1bSBDbGVhbmVyIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3ZhY2N1bV9jbGVhbmVyX3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QYXJraW5nIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3Bhcmtpbmdfc3RhdHVzfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkFkZHJlc3MgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7YWRkcmVzc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Ob3RlcyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tub3Rlc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Db250YWN0IFN0YXR1cyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tjb250YWN0X3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJwYWRkaW5nOiAxNXB4IDBweDtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjsiPg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDtsaW5lLWhlaWdodDogMjJweDttYXJnaW46IDEwcHggMHB4IDE1cHg7ZmxvYXQ6IGxlZnQ7Ij48L3A+DQoJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJwYWRkaW5nOiAxMHB4IDBweDtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jazt0ZXh0LWFsaWduOiBjZW50ZXI7Ij4NCgkJCQkJCQkJCTxoNSBzdHlsZT0iY29sb3I6ICM2MDYwNjA7Zm9udC1zaXplOiAxM3B4O21hcmdpbjogMHB4IDBweCA1cHg7Ij5UaGFuayB5b3U8L2g1Pg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQk8L2Rpdj4NCgkJCQkJCTwvdGQ+CQkJCQkNCgkJCQkJPC90cj4JCQkJDQoJCQkJPC90Ym9keT4NCgkJCTwvdGFibGU+CQ0KCQk8L2Rpdj4NCgk8L2Rpdj4JDQo8L2JvZHk+DQo8L2h0bWw+', 'E', 'RM', 'C'),
(12, 'Admin Appointment Reminder', '', 'PGh0bWw+DQo8aGVhZD4NCgk8bWV0YSBuYW1lPSJ2aWV3cG9ydCIgY29udGVudD0id2lkdGg9ZGV2aWNlLXdpZHRoLCBpbml0aWFsLXNjYWxlPTEuMCIvPg0KCTxtZXRhIGh0dHAtZXF1aXY9IkNvbnRlbnQtVHlwZSIgY29udGVudD0idGV4dC9odG1sOyBjaGFyc2V0PVVURi04IiAvPg0KCTx0aXRsZT5TdWJqZWN0OiB7e3NlcnZpY2VfbmFtZX19IG9uIHt7Ym9va2luZ19kYXRlfX08L3RpdGxlPg0KCTxsaW5rIGhyZWY9Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1Nb250c2VycmF0IiByZWw9InN0eWxlc2hlZXQiPg0KPC9oZWFkPg0KPGJvZHk+CQkNCgk8ZGl2IHN0eWxlPSJtYXJnaW46IDA7cGFkZGluZzogMDtmb250LWZhbWlseTogSGVsdmV0aWNhIE5ldWUsIEhlbHZldGljYSwgSGVsdmV0aWNhLCBBcmlhbCwgc2Fucy1zZXJpZjtmb250LXNpemU6IDEwMCU7bGluZS1oZWlnaHQ6IDEuNjtib3gtc2l6aW5nOiBib3JkZXItYm94OyI+CQ0KCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O21heC13aWR0aDogNjAwcHggIWltcG9ydGFudDttYXJnaW46IDAgYXV0byAhaW1wb3J0YW50O2NsZWFyOiBib3RoICFpbXBvcnRhbnQ7Ij4NCgkJCTx0YWJsZSBzdHlsZT0iYm9yZGVyOiAxcHggc29saWQgI2MyYzJjMjt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDttYXJnaW46IDMwcHggMHB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czogNXB4Oy1tb3otYm9yZGVyLXJhZGl1czogNXB4Oy1vLWJvcmRlci1yYWRpdXM6IDVweDtib3JkZXItcmFkaXVzOiA1cHg7Ij4NCgkJCQk8dGJvZHk+DQoJCQkJCTx0ciBzdHlsZT0iYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7Ij4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDU5JTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7dGV4dC1hbGlnbjogbGVmdDtmb250LWZhbWlseTogTW9udHNlcnJhdCwgc2Fucy1zZXJpZjsiPg0KCQkJCQkJCQl7e2NvbXBhbnlfbmFtZX19PGJyIC8+e3tjb21wYW55X2FkZHJlc3N9fTxiciAvPnt7Y29tcGFueV9jaXR5fX0sIHt7Y29tcGFueV9zdGF0ZX19LCB7e2NvbXBhbnlfemlwfX08YnIgLz57e2NvbXBhbnlfY291bnRyeX19PGJyIC8+e3tjb21wYW55X3Bob25lfX08YnIgLz57e2NvbXBhbnlfZW1haWx9fQ0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDQwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7Ij4NCgkJCQkJCQkJPGRpdiBzdHlsZT0id2lkdGg6IDEzMHB4O2hlaWdodDogMTAwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO21hcmdpbjogMHB4IGF1dG87Ij4NCgkJCQkJCQkJCTxpbWcgc3R5bGU9IndpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0O2Rpc3BsYXk6IGlubGluZS1ibG9jaztoZWlnaHQ6IDEwMCU7IiBzcmM9Int7YnVzaW5lc3NfbG9nb319IiAvPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQk8L2Rpdj4NCgkJCQkJCTwvdGQ+DQoJCQkJCQkNCgkJCQkJCQ0KCQkJCQk8L3RyPg0KCQkJCQk8dHI+DQoJCQkJCQk8dGQ+DQoJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMjVweCAzMHB4O2JhY2tncm91bmQ6ICNmZmY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDkwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQkJPGg2IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bWFyZ2luOiAxMHB4IDBweCAxMHB4O2ZvbnQtd2VpZ2h0OiA2MDA7Ij5EZWFyIHt7YWRtaW5fbmFtZX19LCA8L2g2Pg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDttYXJnaW46IDEwcHggMHB4IDE1cHg7Ij5XZSBqdXN0IHdhbnRlZCB0byByZW1pbmQgeW91IHRoYXQgeW91IGhhdmUgYXBwb2ludG1lbnQgd2l0aCB7e2NsaWVudF9uYW1lfX0gaXMgc2NoZWR1bGVkIGluIDxiPnt7YXBwX3JlbWFpbl90aW1lfX08L2I+IGhvdXJzLjwvcD4JCQkJCQkJDQoJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jaztwYWRkaW5nOiAxMHB4IDBweDsiPg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+V2hlbjogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2Jvb2tpbmdfZGF0ZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Gb3I6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tzZXJ2aWNlX25hbWV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+TWV0aG9kcyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3ttZXRob2RuYW1lfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPlVuaXRzIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3VuaXRzfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkFkZC1vbnMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7YWRkb25zfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPlByaWNlIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3ByaWNlfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCQ0KCQkJCQkJCQkJDQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5OYW1lIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2ZpcnN0bmFtZX19IHt7bGFzdG5hbWV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+RW1haWwgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Y2xpZW50X2VtYWlsfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPlBob25lIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3Bob25lfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPlBheW1lbnQgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7cGF5bWVudF9tZXRob2R9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+VmFjY3VtIENsZWFuZXIgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7dmFjY3VtX2NsZWFuZXJfc3RhdHVzfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPlBhcmtpbmcgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7cGFya2luZ19zdGF0dXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+QWRkcmVzcyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3thZGRyZXNzfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPk5vdGVzIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e25vdGVzfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkNvbnRhY3QgU3RhdHVzIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2NvbnRhY3Rfc3RhdHVzfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTxkaXYgc3R5bGU9InBhZGRpbmc6IDE1cHggMHB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiAxMDAlO2JvcmRlci1ib3R0b206IDFweCBzb2xpZCAjZTZlNmU2OyI+DQoJCQkJCQkJCQk8cCBzdHlsZT0iY29sb3I6ICM2MDYwNjA7Zm9udC1zaXplOiAxNXB4O2xpbmUtaGVpZ2h0OiAyMnB4O21hcmdpbjogMTBweCAwcHggMTVweDtmbG9hdDogbGVmdDsiPjwvcD4NCgkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTxkaXYgc3R5bGU9InBhZGRpbmc6IDEwcHggMHB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiAxMDAlO2Rpc3BsYXk6IGJsb2NrO3RleHQtYWxpZ246IGNlbnRlcjsiPg0KCQkJCQkJCQkJPGg1IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDEzcHg7bWFyZ2luOiAwcHggMHB4IDVweDsiPlRoYW5rIHlvdTwvaDU+DQoJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4JCQkJCQ0KCQkJCQk8L3RyPgkJCQkNCgkJCQk8L3Rib2R5Pg0KCQkJPC90YWJsZT4JDQoJCTwvZGl2Pg0KCTwvZGl2PgkNCjwvYm9keT4NCjwvaHRtbD4=', 'E', 'RM', 'A');";
		mysqli_query($this->conn,$email_template_insert);
		
        $alllang = $this->get_all_languages();
        while($all = mysqli_fetch_array($alllang))
        {
            $language_label_arr = $this->get_all_labelsbyid($all[2]);
            $label_language_arr_first = $language_label_arr[1];
            $label_explode = explode("###",$label_language_arr_first);

            $label_decode_front = base64_decode($label_explode[0]);
            $label_decode_admin = base64_decode($label_explode[1]);
            $label_decode_error = base64_decode($label_explode[2]);
            $label_decode_extra = base64_decode($label_explode[3]);

            $label_decode_front_unserial = unserialize($label_decode_front);
            $label_decode_admin_unserial = unserialize($label_decode_admin);
            $label_decode_error_unserial = unserialize($label_decode_error);
            $label_decode_extra_unserial = unserialize($label_decode_extra);

            /* Add all labels which you want to add in new version from here */
            /* DEMO FOR ADDING LABEL */
			
			$label_decode_admin_unserial['company_settings'] = "Business Info Settings";	
			$label_decode_admin_unserial['select_language_to_display'] = "Language";	
			$label_decode_admin_unserial['company_name'] = "Business Name";
			$label_decode_admin_unserial['company_email'] = "Email";
			$label_decode_admin_unserial['default_country_code'] = "Country Code";
			$label_decode_admin_unserial['company_address'] = "Address";
			$label_decode_admin_unserial['currency_symbol_position'] = "Currency Symbol Position";		
			$label_decode_admin_unserial['price_format_decimal_places'] = "Price Format";		
			$label_decode_admin_unserial['cancellation_policy'] = "Cancellation Policy";
			$label_decode_admin_unserial['allow_multiple_booking_for_same_timeslot'] = "Allow Multiple Booking For Same Timeslot";	
			$label_decode_admin_unserial['privacy_policy'] = "Privacy Policy Link";	
			$label_decode_admin_unserial['right_side_description'] = "Booking Page Rightside Description";	
			$label_decode_admin_unserial['display_sub_headers_below_headers'] = "Sub Headings on Booking page ";	
			$label_decode_admin_unserial['sender_email_address_cleanto_admin_email'] = "Sender Email";
			$label_decode_admin_unserial['admin_profile_address'] = "Address";
			
            $label_decode_front_unserial= $this->array_push_assoc($label_decode_front_unserial, 'eg_799_e_dragram_suite_5a', 'eg. 799 E DRAGRAM SUITE 5A');
            $label_decode_front_unserial= $this->array_push_assoc($label_decode_front_unserial, 'eg_14114', 'eg. 14114');
            $label_decode_front_unserial= $this->array_push_assoc($label_decode_front_unserial, 'eg_tucson', 'eg. TUCSON');
            $label_decode_front_unserial= $this->array_push_assoc($label_decode_front_unserial, 'eg_az', 'eg. AZ');
			$label_decode_front_unserial= $this->array_push_assoc($label_decode_front_unserial, 'choose_your_service', 'Choose Your Service');
			

            $label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'transaction_id', 'Transaction ID');
			
            $label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'sms_reminder', 'SMS Reminder');
            $label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'save_sms_settings', 'Save SMS Settings');
            $label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'sms_service', 'SMS Service');
            $label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'it_will_send_sms_to_service_provider_and_client_for_appointment_booking', 'It will send sms to service provider and client for appointment booking');
            $label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'twilio_account_settings', 'Twilio Account Settings');
            $label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'plivo_account_settings', 'Plivo Account Settings');
            $label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'account_sid', 'Account SID');
            $label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'auth_token', 'Auth Token');
            $label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'twilio_sender_number', 'Twilio Sender Number');
            $label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'plivo_sender_number', 'Plivo Sender Number');
            $label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'twilio_sms_settings', 'Twilio SMS Settings');
            $label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'plivo_sms_settings', 'Plivo SMS Settings');
            $label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'twilio_sms_gateway', 'Twilio SMS Gateway');
            $label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'plivo_sms_gateway', 'Plivo SMS Gateway');
            $label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'send_sms_to_client', 'Send SMS To Client');
            $label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'send_sms_to_admin', 'Send SMS To Admin');
            $label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'admin_phone_number', 'Admin Phone Number');
            $label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'available_from_within_your_twilio_account', 'Available from within your Twilio Account.');
            $label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'must_be_a_valid_number_associated_with_your_twilio_account', 'Must be a valid number associated with your Twilio account.');
            $label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'enable_or_disable_send_sms_to_client_for_appointment_booking_info', 'Enable or Disable, Send SMS to client for appointment booking info.');
            $label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'enable_or_disable_send_sms_to_admin_for_appointment_booking_info', 'Enable or Disable, Send SMS to admin for appointment booking info.');
			
            $label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'updated_sms_settings', 'Updated SMS Settings');
            
			$label_decode_error_unserial= $this->array_push_assoc($label_decode_error_unserial, 'please_enter_account_sid', 'Please enter Accout SID');
            $label_decode_error_unserial= $this->array_push_assoc($label_decode_error_unserial, 'please_enter_auth_token', 'Please enter Auth Token');
            $label_decode_error_unserial= $this->array_push_assoc($label_decode_error_unserial, 'please_enter_sender_number', 'Please enter Sender Number');
            $label_decode_error_unserial= $this->array_push_assoc($label_decode_error_unserial, 'please_enter_admin_number', 'Please enter Admin Number');
			
			$label_decode_error_unserial= $this->array_push_assoc($label_decode_error_unserial, 'sorry_service_already_exist', 'Sorry service already exist');
			/*MAINTAINANCE PAGE STRINGS*/
			$label_decode_front_unserial= $this->array_push_assoc($label_decode_front_unserial,'warning','Warning');
			$label_decode_front_unserial= $this->array_push_assoc($label_decode_front_unserial,'try_later','Try Later');
			/*FRONT LABEL*/
			$label_decode_front_unserial= $this->array_push_assoc($label_decode_front_unserial,'choose_your','Choose Your');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'parking_availability_frontend_option_display_status','Parking');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'vaccum_cleaner_frontend_option_display_status','Vaccum Cleaner');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'o_n','On');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'off','Off');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'enable','Enable');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'disable','Disable');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'monthly','Monthly');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'weekly','Weekly');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'email_template','EMAIL TEMPLATE');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'sms_notification','SMS NOTIFICATION');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'sms_template','SMS TEMPLATE');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'email_template_settings','Email Template Settings');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'client_email_templates','Client Email Template');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'client_sms_templates','Client SMS Template');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'admin_email_template','Admin Email Template');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'admin_sms_template','Admin SMS Template');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'tags','Tags');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'booking_date','booking_date');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'service_name','service_name');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'business_logo','business_logo');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'business_logo_alt','business_logo_alt');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'admin_name','admin_name');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'client_name','client_name');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'methodname','method_name');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'firstname','firstname');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'lastname','lastname');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'client_email','client_email');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'vaccum_cleaner_status','vaccum_cleaner_status');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'parking_status','parking_status');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'app_remain_time','app_remain_time');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'reject_status','reject_status');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'save_template','Save Template');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'default_template','Default Template');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'sms_template_settings','SMS Template Settings');
			
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'secret_key','Secret Key');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'publishable_key','Publishable Key');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'payment_form','Payment Form');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'api_login_id','API Login ID');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'transaction_key','Transaction Key');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'sandbox_mode','Sandbox Mode');
			
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'available_from_within_your_plivo_account', 'Available from within your Plivo Account.');
            $label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'must_be_a_valid_number_associated_with_your_plivo_account', 'Must be a valid number associated with your Plivo account.');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'whats_new', "What's new?");
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'company_phone', 'Company Phone');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'default_country_code', 'Default Country Code');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'company__name', 'company_name');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'booking_time', 'booking_time');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'company__address','company_address');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'company__zip','company_zip');			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'company__email','company_email');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'company__phone','company_phone');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'company__state','company_state');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'company__country','company_country');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'company__city','company_city');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'client__zip','client_zip');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'client_promocode','client_promocode');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'client__state','client_state');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'client__city','client_city');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'client__address','client_address');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'client__phone','client_phone');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'administrator_email','Administrator Email');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'company_logo_is_used_for_invoice_purpose','Company logo is used for invoice purpose');
			

			$language_front_arr = base64_encode(serialize($label_decode_front_unserial));
            $language_admin_arr = base64_encode(serialize($label_decode_admin_unserial));
            $language_error_arr = base64_encode(serialize($label_decode_error_unserial));
            $language_extra_arr = base64_encode(serialize($label_decode_extra_unserial));

            $languagearr = $language_front_arr."###".$language_admin_arr."###".$language_error_arr."###".$language_extra_arr;

            $update_default_lang = "UPDATE `ct_languages` SET `label_data` = '".$languagearr."' WHERE `language` = '".$all[2]."'";
            mysqli_query($this->conn, $update_default_lang);
        }
    }
	public function update1_4()
	{
		$this->insert_option('ct_2checkout_sandbox_mode','Y');
		$this->insert_option('ct_2checkout_privatekey','');
		$this->insert_option('ct_2checkout_publishkey','');
		$this->insert_option('ct_2checkout_sellerid','');
		$this->insert_option('ct_2checkout_status','N');
		$this->insert_option('ct_postalcode_status','Y');
		$delete_option_partial = "delete from `ct_settings` where `option_name` = 'ct_partial_deposit_type'";
		$result_delete_option_partial =  mysqli_query($this->conn, $delete_option_partial);
        $alllang = $this->get_all_languages();
        while($all = mysqli_fetch_array($alllang)) {
            $language_label_arr = $this->get_all_labelsbyid($all[2]);
            $label_language_arr_first = $language_label_arr[1];
            $label_explode = explode("###", $label_language_arr_first);

            $label_decode_front = base64_decode($label_explode[0]);
            $label_decode_admin = base64_decode($label_explode[1]);
            $label_decode_error = base64_decode($label_explode[2]);
            $label_decode_extra = base64_decode($label_explode[3]);

            $label_decode_front_unserial = unserialize($label_decode_front);
            $label_decode_admin_unserial = unserialize($label_decode_admin);
            $label_decode_error_unserial = unserialize($label_decode_error);
            $label_decode_extra_unserial = unserialize($label_decode_extra);

            /* Add all labels which you want to add in new version from here */
            /* DEMO FOR ADDING LABEL */
           
            $label_decode_error_unserial['please_enter_api_login_id'] = "Please Enter API Login ID";
            $label_decode_error_unserial['please_enter_transaction_key'] = "Please Enter Transaction Key";
            $label_decode_error_unserial['please_enter_secret_key'] = "Please Enter Secret Key";
            $label_decode_error_unserial['please_enter_publishable_key'] = "Please Enter Publishable Key";
            $label_decode_error_unserial['please_enter_sms_message'] = "Please enter sms message";
            $label_decode_error_unserial['please_enter_email_message'] = "Please enter email message";
            $label_decode_error_unserial['please_enter_some_qty'] = "Please Enter Some Qty";
            $label_decode_error_unserial['please_enter_private_key'] = "Please Enter Private Key";
            $label_decode_error_unserial['please_enter_seller_id'] = "Please Enter Seller ID";
            $label_decode_error_unserial['please_enter_valid_value_for_discount'] = "Please enter valid value for discount";
            
            $label_decode_admin_unserial['private_key'] = "Private Key";
            $label_decode_admin_unserial['seller_id'] = "Seller ID";
			
			$label_decode_admin_unserial["postal_codes_ed"] = "You can Enable or Disable Postal or Zip codes feature as per your country requirements, as some countries like UAE has not postal code.";
			
			$label_decode_admin_unserial["postal_codes_info"] = "You can mention postal codes in two ways:
#1. You can mention full post codes for match like K1A232,L2A334,C3A4C4.
#2. You can use partial postal codes for wild card match entries,e.g. K1A,L2A,C3 ,system will match those starting letters of postal code on front and it will avoid you to write so many postal codes.";
			
			
			$label_decode_front_unserial['your_postal_code'] = "Zip or Postal Code";
			$label_decode_front_unserial["configure_now_new"] = "Configure Now";
			
			 
            $language_front_arr = base64_encode(serialize($label_decode_front_unserial));
            $language_admin_arr = base64_encode(serialize($label_decode_admin_unserial));
            $language_error_arr = base64_encode(serialize($label_decode_error_unserial));
            $language_extra_arr = base64_encode(serialize($label_decode_extra_unserial));

            $languagearr = $language_front_arr."###".$language_admin_arr."###".$language_error_arr."###".$language_extra_arr;

            $update_default_lang = "UPDATE `ct_languages` SET `label_data` = '".$languagearr."' WHERE `language` = '".$all[2]."'";
            mysqli_query($this->conn, $update_default_lang);
        }
    }
	
	
	public function update1_5()
	{
		/* $update_label_field = "ALTER TABLE  `ct_languages` CHANGE  `label_data`  `label_data` MEDIUMTEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL"; */
		$update_label_field = "ALTER TABLE `ct_languages` CHANGE `label_data` `label_data` LONGTEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;";
        mysqli_query($this->conn, $update_label_field);
		
		$update_settings_table = "ALTER TABLE  `ct_settings` ADD  `postalcode` MEDIUMTEXT NOT NULL;";
        mysqli_query($this->conn, $update_settings_table);
		
		
		$this->insert_option('ct_front_image', '');
		$this->insert_option('ct_company_logo_display', 'N');
		$this->insert_option('ct_user_zip_code','Y');
		$this->insert_option('ct_login_image', '');
		$this->insert_option('ct_company_header_address', 'Y');
		$this->insert_option('ct_front_tool_tips_status',"");
		$this->insert_option('ct_front_tool_tips_my_bookings',"");
		$this->insert_option('ct_front_tool_tips_postal_code',"");
		$this->insert_option('ct_front_tool_tips_services',"");
		$this->insert_option('ct_front_tool_tips_addons_services',"");
		$this->insert_option('ct_front_tool_tips_frequently_discount',"");
		$this->insert_option('ct_front_tool_tips_time_slots',"");
		$this->insert_option('ct_front_tool_tips_personal_details',"");
		$this->insert_option('ct_front_tool_tips_promocode',"");
		$this->insert_option('ct_front_tool_payment_method',"");
		$this->insert_option('ct_sms_nexmo_status',"");
		$this->insert_option('ct_nexmo_api_key',"");
		$this->insert_option('ct_nexmo_api_secret',"");
		$this->insert_option('ct_nexmo_from',"");
		$this->insert_option('ct_nexmo_status',"");
		$this->insert_option('ct_sms_nexmo_send_sms_to_client_status',"");
		$this->insert_option('ct_sms_nexmo_send_sms_to_admin_status',"");
		$this->insert_option('ct_sms_nexmo_admin_phone_number',"");
		$this->insert_option('ct_existing_and_new_user_checkout',"on");
		$this->insert_option('ct_payumoney_salt',"");
		$this->insert_option('ct_payumoney_merchant_key',"");
		$this->insert_option('ct_payumoney_status',"N");
		$this->insert_option('ct_sms_textlocal_account_username','');
		$this->insert_option('ct_sms_textlocal_account_hash_id','');
		$this->insert_option('ct_sms_textlocal_send_sms_to_client_status','N');
		$this->insert_option('ct_sms_textlocal_send_sms_to_admin_status','N');
		$this->insert_option('ct_sms_textlocal_status','N');
		$this->insert_option('ct_sms_textlocal_admin_phone','');
		
		$check_option_of_cart_scrollable_query = "SELECT * FROM `ct_settings` WHERE `option_name` = 'ct_cart_scrollable'";
		$check_option_of_cart_scrollable = mysqli_query($this->conn, $check_option_of_cart_scrollable_query);
		
		if(mysqli_num_rows($check_option_of_cart_scrollable) == 0){
			$this->insert_option('ct_cart_scrollable',"Y");
		}
		
        mysqli_query($this->conn, $update_label_field);
		$alllang = $this->get_all_languages();
        while($all = mysqli_fetch_array($alllang))
        {
            $language_label_arr = $this->get_all_labelsbyid($all[2]);
            $label_language_arr_first = $language_label_arr[1];
            $label_explode = explode("###",$label_language_arr_first);

            $label_decode_front = base64_decode($label_explode[0]);
            $label_decode_admin = base64_decode($label_explode[1]);
            $label_decode_error = base64_decode($label_explode[2]);
            $label_decode_extra = base64_decode($label_explode[3]);

            $label_decode_front_unserial = unserialize($label_decode_front);
            $label_decode_admin_unserial = unserialize($label_decode_admin);
            $label_decode_error_unserial = unserialize($label_decode_error);
            $label_decode_extra_unserial = unserialize($label_decode_extra);
			
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
			
            /* Add all labels which you want to add in new version from here */
            /* DEMO FOR ADDING LABEL */
			
			$label_decode_front_unserial['sun'] = urlencode("Sun");
			$label_decode_front_unserial['mon'] = urlencode("Mon");
			$label_decode_front_unserial['tue'] = urlencode("Tue");
			$label_decode_front_unserial['wed'] = urlencode("Wed");
			$label_decode_front_unserial['thu'] = urlencode("Thu");
			$label_decode_front_unserial['fri'] = urlencode("Fri");
			$label_decode_front_unserial['sat'] = urlencode("Sat");
			$label_decode_front_unserial['su'] = urlencode("Su");
			$label_decode_front_unserial['mo'] = urlencode("Mo");
			$label_decode_front_unserial['tu'] = urlencode("Tu");
			$label_decode_front_unserial['we'] = urlencode("We");
			$label_decode_front_unserial['th'] = urlencode("Th");
			$label_decode_front_unserial['fr'] = urlencode("Fr");
			$label_decode_front_unserial['sa'] = urlencode("Sa");
			$label_decode_front_unserial['none_available'] = urlencode("None Available");
			
			
			$label_decode_front_unserial['january'] = urlencode("JANUARY");
			$label_decode_front_unserial['february'] = urlencode("FEBRUARY");
			$label_decode_front_unserial['march'] = urlencode("MARCH");
			$label_decode_front_unserial['april'] = urlencode("APRIL");
			$label_decode_front_unserial['may'] = urlencode("MAY");
			$label_decode_front_unserial['june'] = urlencode("JUNE");
			$label_decode_front_unserial['july'] = urlencode("JULY");
			$label_decode_front_unserial['august'] = urlencode("AUGUST");
			$label_decode_front_unserial['september']= urlencode("SEPTEMBER");	
			$label_decode_front_unserial['october'] = urlencode("OCTOBER");
			$label_decode_front_unserial['november'] = urlencode("NOVEMBER");
			$label_decode_front_unserial['december'] = urlencode("DECEMBER");
			$label_decode_front_unserial['please_fill_all_the_company_informations_and_add_some_services_and_addons'] = urlencode("Please Fill all the Company Informations and add some Services, Addons and also make check with your time scheduling.");
			
			$label_decode_front_unserial['street_address_placeholder'] = urlencode("e.g. Central Ave");
			$label_decode_front_unserial['zip_code_placeholder'] = urlencode("e.g. 90001");
			$label_decode_front_unserial['city_placeholder'] = urlencode("eg. Los Angeles");			$label_decode_front_unserial['state_placeholder'] = urlencode("eg. CA");
			$label_decode_front_unserial['payumoney'] = urlencode("PayUmoney");
			
			$label_decode_admin_unserial['merchant_key'] = urlencode("Merchant Key");
			$label_decode_admin_unserial['salt_key'] = urlencode("Salt Key");
			$label_decode_admin_unserial['company_logo_is_used_for_invoice_purpose'] = urlencode("Company Logo get used in email and booking page");
			$label_decode_admin_unserial['first'] = urlencode("First");
			$label_decode_admin_unserial["second"] = urlencode("Second");
			$label_decode_admin_unserial["third"] = urlencode("Third");
			$label_decode_admin_unserial["fourth"] = urlencode("Fourth");
			$label_decode_admin_unserial["fifth"] = urlencode("Fifth");
			$label_decode_admin_unserial["first_week"] = urlencode("First-Week");
			$label_decode_admin_unserial["second_week"] = urlencode("Second-Week");
			$label_decode_admin_unserial["third_week"] = urlencode("Third-Week");
			$label_decode_admin_unserial["fourth_week"] = urlencode("Fourth-Week");
			$label_decode_admin_unserial["fifth_week"] = urlencode("Fifth-Week");
			$label_decode_admin_unserial["this_week"] = urlencode("This Week");
			$label_decode_admin_unserial["calendar_today"] = urlencode("Today");
			$label_decode_admin_unserial["calendar_month"] = urlencode("Month");
			$label_decode_admin_unserial["calendar_week"] = urlencode("Week");
			$label_decode_admin_unserial["calendar_day"] = urlencode("Day");
			$label_decode_admin_unserial["guest_user"]=urlencode("Guest User");
			$label_decode_admin_unserial["existing_and_new_user_checkout"]=urlencode("Existing & new user checkout");
			$label_decode_admin_unserial["it_will_allow_option_for_user_to_get_booking_with_new_user_or_existing_user"]=urlencode("It will allow option for user to get booking with new user or existing user");
			$label_decode_admin_unserial["show_company_logo"]=urlencode("Show company logo");
			

			$label_decode_admin_unserial["restore_default"]=urlencode("Restore Default");
			$label_decode_admin_unserial[
"recommended_image_type_jpg_jpeg_png_gif"]=urlencode("(Recommended image type jpg,jpeg,png,gif)");
									
			$label_decode_admin_unserial["monday"]=urlencode("Monday");
			$label_decode_admin_unserial["tuesday"]=urlencode("Tuesday");
			$label_decode_admin_unserial["wednesday"]=urlencode("Wednesday");			$label_decode_admin_unserial["thursday"]=urlencode("Thursday");
			$label_decode_admin_unserial["friday"]=urlencode("Friday");
			$label_decode_admin_unserial["saturday"]=urlencode("Saturday");
			$label_decode_admin_unserial["sunday"]=urlencode("Sunday");
			
			$label_decode_admin_unserial["off_days_added_successfully"]=urlencode("Off Days added successfully");
			$label_decode_admin_unserial["off_days_deleted_successfully"]=urlencode("Off Days deleted successfully");
			$label_decode_admin_unserial["sorry_not_available"]=urlencode("Sorry Not Available");
			$label_decode_admin_unserial["success"]=urlencode("Sussess!");
			$label_decode_admin_unserial["failed"]=urlencode("Failed!");
			$label_decode_admin_unserial["once"]=urlencode("Once");
			$label_decode_admin_unserial["weekly"]=urlencode("Weekly");
			$label_decode_admin_unserial["bi_weekly"]=urlencode("Bi-Weekly");
			$label_decode_admin_unserial["monthly"]=urlencode("Monthly");
			$label_decode_admin_unserial["none"]=urlencode("None");
			$label_decode_admin_unserial["scrollable_cart"]=urlencode("Scrollable Cart");
			$label_decode_error_unserial["please_enter_account_username"]=urlencode("Please enter account username");
			$label_decode_error_unserial["please_enter_account_hash_id"]=urlencode("Please enter account hash id");
			
			$label_decode_admin_unserial["textlocal_sms_gateway"]=urlencode("Textlocal SMS Gateway");
			$label_decode_admin_unserial["textlocal_sms_settings"]=urlencode("Textlocal SMS Settings");
			$label_decode_admin_unserial["textlocal_account_settings"]=urlencode("Textlocal Account Settings");
			$label_decode_admin_unserial["account_username"]=urlencode("Account Username");
			$label_decode_admin_unserial["account_hash_id"]=urlencode("Account Hash ID");
			$label_decode_admin_unserial["email_id_registered_with_you_textlocal"]=urlencode("Provide your email registered with textlocal");
			$label_decode_admin_unserial["hash_id_provided_by_textlocal"]=urlencode("Hash id provided by textlocal");
			$label_decode_error_unserial["password_must_be_only_10_characters"]=urlencode("Password Must Be Only 10 Characters");
			$label_decode_error_unserial["customer_deleted_successfully"]=urlencode("Customer deleted successfully");
			$label_decode_error_unserial["sorry_no_notification"]=urlencode("Sorry, you have not any upcoming appointment");
			$label_decode_error_unserial["are_you_sure_you_want_to_delete_client"]=urlencode("Are You Sure You Want To Delete Client?");
			$label_decode_error_unserial["password_at_least_have_8_characters"]=urlencode("Password At Least Have 8 Characters");
			$label_decode_error_unserial["please_select_atleast_one_checkout_method"]=urlencode("Please select atleast one checkout method");
			$label_decode_error_unserial["please_enter_retype_new_password"]=urlencode("Please Enter Retype New Password");
			$label_decode_error_unserial["please_select_units_and_addons"]=urlencode("Please select units and addons");
			$label_decode_error_unserial["please_login_to_complete_booking"]=urlencode("Please login to complete booking");
			$label_decode_error_unserial["your_password_send_successfully_at_your_email_id"]=urlencode("Your Password Send Successfully At Your Email ID");
			$label_decode_error_unserial["invalid_email_id_please_register_first"]=urlencode("Invalid Email ID please register first");		
			$label_decode_error_unserial["please_select_expiry_date"]=urlencode("Please select expiry date");		
			$label_decode_error_unserial["please_enter_merchant_key"]=urlencode("Please enter Merchant Key");		
			$label_decode_error_unserial["please_enter_salt_key"]=urlencode("Please enter Salt Key");		
			
			$label_decode_admin_unserial["appointment request"]=urlencode("Appointment Request");
			$label_decode_admin_unserial["frequently_discount_setting_tabs"]=urlencode("FREQUENTLY DISCOUNT");
			$label_decode_admin_unserial["appointment_approved"]=urlencode("Appointment Approved");
			$label_decode_admin_unserial["appointment_rejected"]=urlencode("Appointment Rejected");
			$label_decode_admin_unserial["appointment_cancelled_by_you"]=urlencode("Appointment Cancelled by you");
			$label_decode_admin_unserial["appointment_rescheduled_by_you"]=urlencode("Appointment Rescheduled by you");
			$label_decode_admin_unserial["client_appointment_reminder"]=urlencode("Client Appointment Reminder");
			$label_decode_admin_unserial["new_appointment_request_requires_approval"]=urlencode("New Appointment Request Requires Approval");
			$label_decode_admin_unserial["appointment_cancelled_by_customer"]=urlencode("Appointment Cancelled By Customer");
			$label_decode_admin_unserial["appointment_rescheduled_by_customer"]=urlencode("Appointment Rescheduled By Customer");
			$label_decode_admin_unserial["guest_customers_bookings"]=urlencode("Guest Customers Bookings");
			$label_decode_admin_unserial["0_1"]=urlencode("01");
			$label_decode_admin_unserial["user_zip_code"]=urlencode("Zip Code");
			$label_decode_admin_unserial["delete_this_method"]=urlencode("Delete this method?");
			$label_decode_admin_unserial["1_1"]=urlencode("1.1");
			$label_decode_admin_unserial["1_2"]=urlencode("1.2");
			$label_decode_admin_unserial["0_2"]=urlencode("02");
			$label_decode_admin_unserial["wrong_url"]=urlencode("Wrong URL");
			$label_decode_admin_unserial["free"]=urlencode("Free");
			$label_decode_admin_unserial["o_n"]=urlencode("On");
			$label_decode_admin_unserial["show_company_address_in_header"]=urlencode("Show company address in header");
			$label_decode_admin_unserial["tax_vat"]=urlencode("Tax/Vat");
			$label_decode_admin_unserial["before_e_g_100"]=urlencode("Before(e.g.$100)");
			$label_decode_admin_unserial["after_e_g_100"]=urlencode("After(e.g.100$)");
			$label_decode_admin_unserial["dropdown_design"]=urlencode("DropDown Design");
			$label_decode_admin_unserial["blocks_as_button_design"]=urlencode("Blocks As Button Design");
			$label_decode_admin_unserial["qty_control_design"]=urlencode("Qty Control Design");
			$label_decode_admin_unserial["dropdowns"]=urlencode("DropDowns");
			$label_decode_admin_unserial["big_images_radio"]=urlencode("Big Images Radio");
			$label_decode_admin_unserial["login_page"]=urlencode("Login Page");
			$label_decode_admin_unserial["front_page"]=urlencode("Front Page");
			$label_decode_admin_unserial["choose_file"]=urlencode("Choose File");
			$label_decode_admin_unserial["authorize_net"]=urlencode("Authorize.Net");
			$label_decode_admin_unserial["stripe"]=urlencode("Stripe");
			$label_decode_admin_unserial["checkout_title"]=urlencode("2Checkout");
			$label_decode_admin_unserial["nexmo_sms_gateway"]=urlencode("Nexmo SMS Gateway");
			$label_decode_admin_unserial["nexmo_sms_setting"]=urlencode("Nexmo SMS Setting");
			$label_decode_admin_unserial["nexmo_api_key"]=urlencode("Nexmo API Key");
			$label_decode_admin_unserial["nexmo_api_secret"]=urlencode("Nexmo API Secret");
			$label_decode_admin_unserial["nexmo_from"]=urlencode("Nexmo From");
			$label_decode_admin_unserial["nexmo_status"]=urlencode("Nexmo Status");
			$label_decode_admin_unserial["nexmo_send_sms_to_client_status"]=urlencode("Nexmo Send Sms To Client Status");
			$label_decode_admin_unserial["nexmo_send_sms_to_admin_status"]=urlencode("Nexmo Send Sms To admin Status");
			$label_decode_admin_unserial["nexmo_admin_phone_number"]=urlencode("Nexmo Admin Phone Number");
			$label_decode_admin_unserial["save_12_5"]=urlencode("save 12.5 %");
			$label_decode_admin_unserial["front_tool_tips"]=urlencode("FRONT TOOL TIPS");
			$label_decode_admin_unserial["front_tool_tips_lower"]=urlencode("Front Tool Tips");
			$label_decode_admin_unserial["tool_tip_my_bookings"]=urlencode("My Bookings");
			$label_decode_admin_unserial["tool_tip_postal_code"]=urlencode("Postal Code");
			$label_decode_admin_unserial["tool_tip_services"]=urlencode("Services");
			$label_decode_admin_unserial["tool_tip_extra_service"]=urlencode("Extra service");
			$label_decode_admin_unserial["tool_tip_frequently_discount"]=urlencode("Frequently discount");
			$label_decode_admin_unserial["tool_tip_when_would_you_like_us_to_come"]=urlencode("When would you like us to come?");
			$label_decode_admin_unserial["tool_tip_your_personal_details"]=urlencode("Your Personal Details");
			$label_decode_admin_unserial["tool_tip_have_a_promocode"]=urlencode("Have A Promocode");
			$label_decode_admin_unserial["tool_tip_preferred_payment_method"]=urlencode("Preferred Payment Method");
			$label_decode_admin_unserial["admin_appointment_reminder"]=urlencode("Admin Appointment Reminder");
			$label_decode_front_unserial["pay_locally"] =urlencode("Pay Locally");
			$label_decode_front_unserial["expiry_date_or_csv"] =urlencode("Expiry date or CSV");
			$label_decode_front_unserial["mm_yyyy"] =urlencode("(MM/YYYY)");
			$label_decode_front_unserial["cvc"] =urlencode("CVC");
			$label_decode_front_unserial["paypal"] =urlencode("Paypal");
			$label_decode_front_unserial["service_usage_methods"] =urlencode("Service Usage Methods");
			$label_decode_error_unserial["please_select_atleast_one_unit"] =urlencode("Please select atleast one unit");
			

			$language_front_arr = base64_encode(serialize($label_decode_front_unserial));
            $language_admin_arr = base64_encode(serialize($label_decode_admin_unserial));
            $language_error_arr = base64_encode(serialize($label_decode_error_unserial));
            $language_extra_arr = base64_encode(serialize($label_decode_extra_unserial));

            $languagearr = $language_front_arr."###".$language_admin_arr."###".$language_error_arr."###".$language_extra_arr;

            $update_default_lang = "UPDATE `ct_languages` SET `label_data` = '".$languagearr."' WHERE `language` = '".$all[2]."'";
            mysqli_query($this->conn, $update_default_lang);
		}
	}
	
	public function update1_6()
	{
		$this->insert_option('ct_payumoney_salt',"");
		$this->insert_option('ct_payumoney_merchant_key',"");
		$this->insert_option('ct_payumoney_status',"N");
		$this->insert_option('ct_sms_textlocal_account_username','');
		$this->insert_option('ct_sms_textlocal_account_hash_id','');
		$this->insert_option('ct_sms_textlocal_send_sms_to_client_status','N');
		$this->insert_option('ct_sms_textlocal_send_sms_to_admin_status','N');
		$this->insert_option('ct_sms_textlocal_status','N');
		$this->insert_option('ct_sms_textlocal_admin_phone','');
		$this->insert_option('ct_company_service_desc_status','N');
		$this->insert_option('ct_company_willwe_getin_status','N');
		$this->insert_option('ct_bank_name','');
		$this->insert_option('ct_account_name','');
		$this->insert_option('ct_account_number','');
		$this->insert_option('ct_branch_code','');
		$this->insert_option('ct_ifsc_code','');
		$this->insert_option('ct_bank_description','');
		$this->insert_option('ct_bank_transfer_status','N');
		$this->insert_option('ct_phone_display_country_code','');
		$this->insert_option('ct_smtp_encryption','');
		$this->insert_option('ct_smtp_authetication','false');
		
		$alllang = $this->get_all_languages();
        while($all = mysqli_fetch_array($alllang))
        {
            $language_label_arr = $this->get_all_labelsbyid($all[2]);
            $label_language_arr_first = $language_label_arr[1];
            $label_explode = explode("###",$label_language_arr_first);

            $label_decode_front = base64_decode($label_explode[0]);
            $label_decode_admin = base64_decode($label_explode[1]);
            $label_decode_error = base64_decode($label_explode[2]);
            $label_decode_extra = base64_decode($label_explode[3]);

            $label_decode_front_unserial = unserialize($label_decode_front);
            $label_decode_admin_unserial = unserialize($label_decode_admin);
            $label_decode_error_unserial = unserialize($label_decode_error);
            $label_decode_extra_unserial = unserialize($label_decode_extra);
			
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
			
            /* Add all labels which you want to add in new version from here */
            /* DEMO FOR ADDING LABEL */
			
			$label_decode_front_unserial['payumoney']=urlencode("PayUmoney");
			$label_decode_error_unserial['please_enter_minimum_20_characters']=urlencode("Please Enter Minimum 20 Characters");
			
			$label_decode_admin_unserial['merchant_key'] = urlencode("Merchant Key");
			$label_decode_admin_unserial['salt_key'] = urlencode("Salt Key");
			
			$label_decode_error_unserial["please_enter_account_username"]=urlencode("Please enter account username");
			$label_decode_error_unserial["please_enter_account_hash_id"]=urlencode("Please enter account hash id");
			
			$label_decode_admin_unserial["authetication"]=urlencode("Authentication");
			$label_decode_admin_unserial["encryption_type"]=urlencode("Encryption Type");
			$label_decode_admin_unserial["plain"]=urlencode("Plain");
			$label_decode_admin_unserial["true"]=urlencode("True");
			$label_decode_admin_unserial["false"]=urlencode("False");
			
			
			
			$label_decode_admin_unserial["textlocal_sms_gateway"]=urlencode("Textlocal SMS Gateway");
			$label_decode_admin_unserial["textlocal_sms_settings"]=urlencode("Textlocal SMS Settings");
			$label_decode_admin_unserial["textlocal_account_settings"]=urlencode("Textlocal Account Settings");
			$label_decode_admin_unserial["account_username"]=urlencode("Account Username");
			
			$label_decode_admin_unserial["account_hash_id"]=urlencode("Account Hash ID");
			
			$label_decode_admin_unserial["bank_transfer"]=urlencode("Bank Transfer");
			$label_decode_admin_unserial["bank_name"]=urlencode("Bank Name");
			$label_decode_admin_unserial["account_name"]=urlencode("Account Name");
			$label_decode_admin_unserial["account_number"]=urlencode("Account Number");
			$label_decode_admin_unserial["branch_code"]=urlencode("Branch Code");
			$label_decode_admin_unserial["ifsc_code"]=urlencode("IFSC Code");
			$label_decode_admin_unserial["bank_description"]=urlencode("Bank Description");
			$label_decode_admin_unserial["your_cart_items"]=urlencode("Your Cart Items");
			$label_decode_admin_unserial["show_how_will_we_get_in"]=urlencode("Show How will we get in");
			$label_decode_admin_unserial["bank_details"]=urlencode("Bank Details");
			$label_decode_admin_unserial["show_description"]=urlencode("Show Description");
			$label_decode_admin_unserial["remove_sample_data_message"]=urlencode("You are trying to remove sample data. If you remove sample data your booking related with sample services will be permanently deleted. To proceed please click on 'OK'");
			$label_decode_admin_unserial["ok_remove_sample_data"]=urlencode("Ok");
			$label_decode_admin_unserial["email_id_registered_with_you_textlocal"]=urlencode("Provide your email registered with textlocal");
			$label_decode_admin_unserial["hash_id_provided_by_textlocal"]=urlencode("Hash id provided by textlocal");
			
			
			$label_decode_admin_unserial["jan"]=urlencode("JAN");
			$label_decode_admin_unserial["feb"]=urlencode("FEB");
			$label_decode_admin_unserial["mar"]=urlencode("MAR");
			$label_decode_admin_unserial["apr"]=urlencode("APR");
			$label_decode_admin_unserial["may"]=urlencode("MAY");
			$label_decode_admin_unserial["jun"]=urlencode("JUN");
			$label_decode_admin_unserial["jul"]=urlencode("JUL");
			$label_decode_admin_unserial["aug"]=urlencode("AUG");
			$label_decode_admin_unserial["sep"]=urlencode("SEP");	
			$label_decode_admin_unserial["oct"]=urlencode("OCT");
			$label_decode_admin_unserial["nov"]=urlencode("NOV");
			$label_decode_admin_unserial["dec"]=urlencode("DEC");
			$label_decode_admin_unserial["book_appointment"]=urlencode("Book Appointment");
			
			$label_decode_error_unserial["please_enter_merchant_key"]=urlencode("Please enter Merchant Key");	
$label_decode_error_unserial["minimum_file_upload_size_1_kb"]=urlencode("Minimum file upload size 1 KB");			
			$label_decode_error_unserial["please_enter_salt_key"]=urlencode("Please enter Salt Key");		
			
			$language_front_arr = base64_encode(serialize($label_decode_front_unserial));
            $language_admin_arr = base64_encode(serialize($label_decode_admin_unserial));
            $language_error_arr = base64_encode(serialize($label_decode_error_unserial));
            $language_extra_arr = base64_encode(serialize($label_decode_extra_unserial));

            $languagearr = $language_front_arr."###".$language_admin_arr."###".$language_error_arr."###".$language_extra_arr;

            $update_default_lang = "UPDATE `ct_languages` SET `label_data` = '".$languagearr."' WHERE `language` = '".$all[2]."'";
            mysqli_query($this->conn, $update_default_lang);
		}
	}
	
	public function update2_0()
	{
		$position_methods = "ALTER TABLE  `ct_services_method` ADD  `position` INT NOT NULL";
		$position_units = "ALTER TABLE  `ct_service_methods_units` ADD  `position` INT NOT NULL";
		$add_staff1 = "ALTER TABLE  `ct_admin_info` ADD  `schedule_type` ENUM(  'M',  'W' ) NOT NULL";
		$add_staff2 = "ALTER TABLE  `ct_admin_info` ADD  `role` VARCHAR( 20 ) NOT NULL ,
ADD  `description` VARCHAR( 320 ) NOT NULL ,
ADD  `enable_booking` ENUM(  'Y',  'N' ) NOT NULL ,
ADD  `service_commission` ENUM(  'F',  'P' ) NOT NULL ,
ADD  `commision_value` DOUBLE NOT NULL";
		$query = "ALTER TABLE  `ct_bookings` ADD  `staff_ids` VARCHAR( 160 ) NOT NULL";
		
		
		$query_admin_role = "Update `ct_admin_info` set `role`='admin' where `id`=1";
		mysqli_query($this->conn,$query_admin_role);
		
		/* newly added in 2.0 */
		$query_staff_payment = "CREATE TABLE `ct_staff_commission` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `order_id` int(11) NOT NULL,
		  `staff_id` int(11) NOT NULL,
		  `amt_payable` double NOT NULL,
		  `advance_paid` double NOT NULL,
		  `net_total` double NOT NULL,
		  `payment_method` varchar(50) NOT NULL,
		  `transaction_id` varchar(100) NOT NULL,
		  `payment_date` date NOT NULL,
		  PRIMARY KEY (`id`)
		)ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
		mysqli_query($this->conn,$query_staff_payment);
		/* newly added in 2.0 */
		
		$ct_front_desc_change = "update `ct_settings` set `option_value`='<div class=\"features\">\n	<img class=\"feature-img\" src=\"<?php echo BASE_URL ?>/assets/images/icon21.png\" alt=\"\">\n	<h4 class=\"feature-tittle\">Safety</h4>\n	<p class=\"feature-text\">Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>\n</div>\n<div class=\"features\">\n	<img class=\"feature-img\" src=\"<?php echo BASE_URL ?>/assets/images/icon31.png\" alt=\"\">\n	<h4 class=\"feature-tittle\">Best in Quality</h4>\n	<p class=\"feature-text\">Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>\n</div>\n<div class=\"features\">\n	<img class=\"feature-img\" src=\"<?php echo BASE_URL ?>/assets/images/icon51.png\" alt=\"\">\n	<h4 class=\"feature-tittle\">Communication</h4>\n	<p class=\"feature-text\">Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>\n</div>\n<div class=\"features\">\n	<img class=\"feature-img\" src=\"<?php echo BASE_URL ?>/assets/images/icon17.png\" alt=\"\">\n	<h4 class=\"feature-tittle\">Saves You Time</h4>\n	<p class=\"feature-text\">Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>\n</div>\n<div class=\"features\">\n	<img class=\"feature-img\" src=\"<?php echo BASE_URL ?>/assets/images/icon61.png\" alt=\"\">\n	<h4 class=\"feature-tittle\">Card Payment</h4>\n	<p class=\"feature-text\"> Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>\n</div>' where `option_name`='ct_front_desc'";
		mysqli_query($this->conn, $ct_front_desc_change);
		mysqli_query($this->conn, $query);
		mysqli_query($this->conn, $add_staff1);
		mysqli_query($this->conn, $add_staff2);
		mysqli_query($this->conn, $position_methods);
		mysqli_query($this->conn, $position_units);
		
		$qq1 = "ALTER TABLE `ct_users` CHANGE `user_pwd` `user_pwd` VARCHAR(40) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '';";
		$qq2 = "ALTER TABLE `ct_users` CHANGE `user_email` `user_email` VARCHAR(96) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '';";
		$qq3 = "ALTER TABLE `ct_users` CHANGE `first_name` `first_name` VARCHAR(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '';";
		$qq4 = "ALTER TABLE `ct_users` CHANGE `last_name` `last_name` VARCHAR(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '';";
		$qq5 = "ALTER TABLE `ct_users` CHANGE `phone` `phone` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '';";
		$qq6 = "ALTER TABLE `ct_users` CHANGE `zip` `zip` VARCHAR(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '';";
		$qq7 = "ALTER TABLE `ct_users` CHANGE `address` `address` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '';";
		$qq8 = "ALTER TABLE `ct_users` CHANGE `city` `city` VARCHAR(48) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '';";
		$qq9 = "ALTER TABLE `ct_users` CHANGE `state` `state` VARCHAR(48) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '';";
		$qq10 = "ALTER TABLE `ct_users` CHANGE `notes` `notes` VARCHAR(800) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '';";
		$qq11 = "ALTER TABLE `ct_users` CHANGE `vc_status` `vc_status` ENUM('Y','N') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'N';";
		$qq12 = "ALTER TABLE `ct_users` CHANGE `p_status` `p_status` ENUM('Y','N') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'N';";
		$qq13 = "ALTER TABLE `ct_users` CHANGE `contact_status` `contact_status` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '';";
		$qq14 = "ALTER TABLE `ct_users` CHANGE `status` `status` ENUM('E','D') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'D';";
		$qq15 = "ALTER TABLE `ct_users` CHANGE `usertype` `usertype` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '';";
		
		mysqli_query($this->conn, $qq1);
		mysqli_query($this->conn, $qq2);
		mysqli_query($this->conn, $qq3);
		mysqli_query($this->conn, $qq4);
		mysqli_query($this->conn, $qq5);
		mysqli_query($this->conn, $qq6);
		mysqli_query($this->conn, $qq7);
		mysqli_query($this->conn, $qq8);
		mysqli_query($this->conn, $qq9);
		mysqli_query($this->conn, $qq10);
		mysqli_query($this->conn, $qq11);
		mysqli_query($this->conn, $qq12);
		mysqli_query($this->conn, $qq13);
		mysqli_query($this->conn, $qq14);
		mysqli_query($this->conn, $qq15);
		
		$query_email_template = "ALTER TABLE  `ct_email_templates` CHANGE  `user_type`  `user_type` ENUM(  'A',  'C',  'S' ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT  'A=Admin,C=client,S=Staff' ";
		mysqli_query($this->conn,$query_email_template);
		
		$query = "ALTER TABLE  `ct_admin_info` ADD  `image` VARCHAR( 250 ) NOT NULL";
		mysqli_query($this->conn,$query);
		
		$email_template_insert_staff = "INSERT INTO `ct_email_templates` (`id`, `email_subject`, `email_message`, `default_message`, `email_template_status`, `email_template_type`, `user_type`) VALUES
		(NULL, 'Admin Appointment Reminder', '', 'PGh0bWw+DQo8aGVhZD4NCgk8bWV0YSBuYW1lPSJ2aWV3cG9ydCIgY29udGVudD0id2lkdGg9ZGV2aWNlLXdpZHRoLCBpbml0aWFsLXNjYWxlPTEuMCIvPg0KCTxtZXRhIGh0dHAtZXF1aXY9IkNvbnRlbnQtVHlwZSIgY29udGVudD0idGV4dC9odG1sOyBjaGFyc2V0PVVURi04IiAvPg0KCTx0aXRsZT5TdWJqZWN0OiB7e3NlcnZpY2VfbmFtZX19IG9uIHt7Ym9va2luZ19kYXRlfX08L3RpdGxlPg0KCTxsaW5rIGhyZWY9Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1Nb250c2VycmF0IiByZWw9InN0eWxlc2hlZXQiPg0KPC9oZWFkPg0KPGJvZHk+CQkNCgk8ZGl2IHN0eWxlPSJtYXJnaW46IDA7cGFkZGluZzogMDtmb250LWZhbWlseTogSGVsdmV0aWNhIE5ldWUsIEhlbHZldGljYSwgSGVsdmV0aWNhLCBBcmlhbCwgc2Fucy1zZXJpZjtmb250LXNpemU6IDEwMCU7bGluZS1oZWlnaHQ6IDEuNjtib3gtc2l6aW5nOiBib3JkZXItYm94OyI+CQ0KCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O21heC13aWR0aDogNjAwcHggIWltcG9ydGFudDttYXJnaW46IDAgYXV0byAhaW1wb3J0YW50O2NsZWFyOiBib3RoICFpbXBvcnRhbnQ7Ij4NCgkJCTx0YWJsZSBzdHlsZT0iYm9yZGVyOiAxcHggc29saWQgI2MyYzJjMjt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDttYXJnaW46IDMwcHggMHB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czogNXB4Oy1tb3otYm9yZGVyLXJhZGl1czogNXB4Oy1vLWJvcmRlci1yYWRpdXM6IDVweDtib3JkZXItcmFkaXVzOiA1cHg7Ij4NCgkJCQk8dGJvZHk+DQoJCQkJCTx0ciBzdHlsZT0iYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7Ij4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDU5JTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7dGV4dC1hbGlnbjogbGVmdDtmb250LWZhbWlseTogTW9udHNlcnJhdCwgc2Fucy1zZXJpZjsiPg0KCQkJCQkJCQl7e2NvbXBhbnlfbmFtZX19PGJyIC8+e3tjb21wYW55X2FkZHJlc3N9fTxiciAvPnt7Y29tcGFueV9jaXR5fX0sIHt7Y29tcGFueV9zdGF0ZX19LCB7e2NvbXBhbnlfemlwfX08YnIgLz57e2NvbXBhbnlfY291bnRyeX19PGJyIC8+e3tjb21wYW55X3Bob25lfX08YnIgLz57e2NvbXBhbnlfZW1haWx9fQ0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDQwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7Ij4NCgkJCQkJCQkJPGRpdiBzdHlsZT0id2lkdGg6IDEzMHB4O2hlaWdodDogMTAwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO21hcmdpbjogMHB4IGF1dG87Ij4NCgkJCQkJCQkJCTxpbWcgc3R5bGU9IndpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0O2Rpc3BsYXk6IGlubGluZS1ibG9jaztoZWlnaHQ6IDEwMCU7IiBzcmM9Int7YnVzaW5lc3NfbG9nb319IiAvPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQk8L2Rpdj4NCgkJCQkJCTwvdGQ+DQoJCQkJCQkNCgkJCQkJCQ0KCQkJCQk8L3RyPg0KCQkJCQk8dHI+DQoJCQkJCQk8dGQ+DQoJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMjVweCAzMHB4O2JhY2tncm91bmQ6ICNmZmY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDkwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQkJPGg2IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bWFyZ2luOiAxMHB4IDBweCAxMHB4O2ZvbnQtd2VpZ2h0OiA2MDA7Ij5EZWFyIHt7YWRtaW5fbmFtZX19LCA8L2g2Pg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDttYXJnaW46IDEwcHggMHB4IDE1cHg7Ij5XZSBqdXN0IHdhbnRlZCB0byByZW1pbmQgeW91IHRoYXQgeW91IGhhdmUgYXBwb2ludG1lbnQgd2l0aCB7e2NsaWVudF9uYW1lfX0gaXMgc2NoZWR1bGVkIGluIDxiPnt7YXBwX3JlbWFpbl90aW1lfX08L2I+IGhvdXJzLjwvcD4JCQkJCQkJDQoJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jaztwYWRkaW5nOiAxMHB4IDBweDsiPg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+V2hlbjogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2Jvb2tpbmdfZGF0ZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Gb3I6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tzZXJ2aWNlX25hbWV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+TWV0aG9kcyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3ttZXRob2RuYW1lfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPlVuaXRzIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3VuaXRzfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkFkZC1vbnMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7YWRkb25zfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPlByaWNlIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3ByaWNlfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCQ0KCQkJCQkJCQkJDQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5OYW1lIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2ZpcnN0bmFtZX19IHt7bGFzdG5hbWV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+RW1haWwgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Y2xpZW50X2VtYWlsfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPlBob25lIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3Bob25lfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPlBheW1lbnQgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7cGF5bWVudF9tZXRob2R9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+VmFjY3VtIENsZWFuZXIgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7dmFjY3VtX2NsZWFuZXJfc3RhdHVzfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPlBhcmtpbmcgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7cGFya2luZ19zdGF0dXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+QWRkcmVzcyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3thZGRyZXNzfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPk5vdGVzIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e25vdGVzfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkNvbnRhY3QgU3RhdHVzIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2NvbnRhY3Rfc3RhdHVzfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTxkaXYgc3R5bGU9InBhZGRpbmc6IDE1cHggMHB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiAxMDAlO2JvcmRlci1ib3R0b206IDFweCBzb2xpZCAjZTZlNmU2OyI+DQoJCQkJCQkJCQk8cCBzdHlsZT0iY29sb3I6ICM2MDYwNjA7Zm9udC1zaXplOiAxNXB4O2xpbmUtaGVpZ2h0OiAyMnB4O21hcmdpbjogMTBweCAwcHggMTVweDtmbG9hdDogbGVmdDsiPjwvcD4NCgkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTxkaXYgc3R5bGU9InBhZGRpbmc6IDEwcHggMHB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiAxMDAlO2Rpc3BsYXk6IGJsb2NrO3RleHQtYWxpZ246IGNlbnRlcjsiPg0KCQkJCQkJCQkJPGg1IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDEzcHg7bWFyZ2luOiAwcHggMHB4IDVweDsiPlRoYW5rIHlvdTwvaDU+DQoJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4JCQkJCQ0KCQkJCQk8L3RyPgkJCQkNCgkJCQk8L3Rib2R5Pg0KCQkJPC90YWJsZT4JDQoJCTwvZGl2Pg0KCTwvZGl2PgkNCjwvYm9keT4NCjwvaHRtbD4=', 'E', 'RM', 'S'),
		(NULL, 'Appointment Rescheduled By Customer', '', 'PGh0bWw+DQo8aGVhZD4NCgk8bWV0YSBuYW1lPSJ2aWV3cG9ydCIgY29udGVudD0id2lkdGg9ZGV2aWNlLXdpZHRoLCBpbml0aWFsLXNjYWxlPTEuMCIvPg0KCTxtZXRhIGh0dHAtZXF1aXY9IkNvbnRlbnQtVHlwZSIgY29udGVudD0idGV4dC9odG1sOyBjaGFyc2V0PVVURi04IiAvPg0KCTx0aXRsZT5TdWJqZWN0OiB7e3NlcnZpY2VfbmFtZX19IG9uIHt7Ym9va2luZ19kYXRlfX08L3RpdGxlPg0KCTxsaW5rIGhyZWY9Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1Nb250c2VycmF0IiByZWw9InN0eWxlc2hlZXQiPg0KPC9oZWFkPg0KPGJvZHk+CQkNCgk8ZGl2IHN0eWxlPSJtYXJnaW46IDA7cGFkZGluZzogMDtmb250LWZhbWlseTogSGVsdmV0aWNhIE5ldWUsIEhlbHZldGljYSwgSGVsdmV0aWNhLCBBcmlhbCwgc2Fucy1zZXJpZjtmb250LXNpemU6IDEwMCU7bGluZS1oZWlnaHQ6IDEuNjtib3gtc2l6aW5nOiBib3JkZXItYm94OyI+CQ0KCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O21heC13aWR0aDogNjAwcHggIWltcG9ydGFudDttYXJnaW46IDAgYXV0byAhaW1wb3J0YW50O2NsZWFyOiBib3RoICFpbXBvcnRhbnQ7Ij4NCgkJCTx0YWJsZSBzdHlsZT0iYm9yZGVyOiAxcHggc29saWQgI2MyYzJjMjt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDttYXJnaW46IDMwcHggMHB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czogNXB4Oy1tb3otYm9yZGVyLXJhZGl1czogNXB4Oy1vLWJvcmRlci1yYWRpdXM6IDVweDtib3JkZXItcmFkaXVzOiA1cHg7Ij4NCgkJCQk8dGJvZHk+DQoJCQkJCTx0ciBzdHlsZT0iYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7Ij4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDU5JTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7dGV4dC1hbGlnbjogbGVmdDtmb250LWZhbWlseTogTW9udHNlcnJhdCwgc2Fucy1zZXJpZjsiPg0KCQkJCQkJCQl7e2NvbXBhbnlfbmFtZX19PGJyIC8+e3tjb21wYW55X2FkZHJlc3N9fTxiciAvPnt7Y29tcGFueV9jaXR5fX0sIHt7Y29tcGFueV9zdGF0ZX19LCB7e2NvbXBhbnlfemlwfX08YnIgLz57e2NvbXBhbnlfY291bnRyeX19PGJyIC8+e3tjb21wYW55X3Bob25lfX08YnIgLz57e2NvbXBhbnlfZW1haWx9fQ0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDQwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7Ij4NCgkJCQkJCQkJPGRpdiBzdHlsZT0id2lkdGg6IDEzMHB4O2hlaWdodDogMTAwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO21hcmdpbjogMHB4IGF1dG87Ij4NCgkJCQkJCQkJCTxpbWcgc3R5bGU9IndpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0O2Rpc3BsYXk6IGlubGluZS1ibG9jaztoZWlnaHQ6IDEwMCU7IiBzcmM9Int7YnVzaW5lc3NfbG9nb319IiAvPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQk8L2Rpdj4NCgkJCQkJCTwvdGQ+DQoJCQkJCQkNCgkJCQkJCQ0KCQkJCQk8L3RyPg0KCQkJCQk8dHI+DQoJCQkJCQk8dGQ+DQoJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMjVweCAzMHB4O2JhY2tncm91bmQ6ICNmZmY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDkwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQkJPGg2IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bWFyZ2luOiAxMHB4IDBweCAxMHB4O2ZvbnQtd2VpZ2h0OiA2MDA7Ij5EZWFyIHt7YWRtaW5fbmFtZX19LCA8L2g2Pg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDttYXJnaW46IDEwcHggMHB4IDE1cHg7Ij5UaGUgYXBwb2ludG1lbnQgd2l0aCB7e2NsaWVudF9uYW1lfX0gd2l0aCBmb2xsb3dpbmcgZGV0YWlsczo8L3A+CQkJCQkJCQ0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPGRpdiBzdHlsZT0iZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7cGFkZGluZzogMTBweCAwcHg7Ij4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPldoZW46IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tib29raW5nX2RhdGV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+Rm9yOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7c2VydmljZV9uYW1lfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPk1ldGhvZHMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7bWV0aG9kbmFtZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Vbml0cyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3t1bml0c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5BZGQtb25zIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2FkZG9uc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QcmljZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twcmljZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQkNCgkJCQkJCQkJCQ0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+TmFtZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tmaXJzdG5hbWV9fSB7e2xhc3RuYW1lfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkVtYWlsIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2NsaWVudF9lbWFpbH19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QaG9uZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twaG9uZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QYXltZW50IDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3BheW1lbnRfbWV0aG9kfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPlZhY2N1bSBDbGVhbmVyIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3ZhY2N1bV9jbGVhbmVyX3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QYXJraW5nIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3Bhcmtpbmdfc3RhdHVzfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkFkZHJlc3MgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7YWRkcmVzc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Ob3RlcyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tub3Rlc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Db250YWN0IFN0YXR1cyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tjb250YWN0X3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJwYWRkaW5nOiAxNXB4IDBweDtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjsiPg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDtsaW5lLWhlaWdodDogMjJweDttYXJnaW46IDEwcHggMHB4IDE1cHg7ZmxvYXQ6IGxlZnQ7Ij5oYXMgYmVlbiByZXNjaGVkdWxlZC48L3A+DQoJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJwYWRkaW5nOiAxMHB4IDBweDtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jazt0ZXh0LWFsaWduOiBjZW50ZXI7Ij4NCgkJCQkJCQkJCTxoNSBzdHlsZT0iY29sb3I6ICM2MDYwNjA7Zm9udC1zaXplOiAxM3B4O21hcmdpbjogMHB4IDBweCA1cHg7Ij5UaGFuayB5b3U8L2g1Pg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQk8L2Rpdj4NCgkJCQkJCTwvdGQ+CQkJCQkNCgkJCQkJPC90cj4JCQkJDQoJCQkJPC90Ym9keT4NCgkJCTwvdGFibGU+CQ0KCQk8L2Rpdj4NCgk8L2Rpdj4JDQo8L2JvZHk+DQo8L2h0bWw+', 'E', 'RS', 'S'),
		(NULL, 'Appointment Cancelled By Customer', '', 'PGh0bWw+DQo8aGVhZD4NCgk8bWV0YSBuYW1lPSJ2aWV3cG9ydCIgY29udGVudD0id2lkdGg9ZGV2aWNlLXdpZHRoLCBpbml0aWFsLXNjYWxlPTEuMCIvPg0KCTxtZXRhIGh0dHAtZXF1aXY9IkNvbnRlbnQtVHlwZSIgY29udGVudD0idGV4dC9odG1sOyBjaGFyc2V0PVVURi04IiAvPg0KCTx0aXRsZT5TdWJqZWN0OiB7e3NlcnZpY2VfbmFtZX19IG9uIHt7Ym9va2luZ19kYXRlfX08L3RpdGxlPg0KCTxsaW5rIGhyZWY9Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1Nb250c2VycmF0IiByZWw9InN0eWxlc2hlZXQiPg0KPC9oZWFkPg0KPGJvZHk+CQkNCgk8ZGl2IHN0eWxlPSJtYXJnaW46IDA7cGFkZGluZzogMDtmb250LWZhbWlseTogSGVsdmV0aWNhIE5ldWUsIEhlbHZldGljYSwgSGVsdmV0aWNhLCBBcmlhbCwgc2Fucy1zZXJpZjtmb250LXNpemU6IDEwMCU7bGluZS1oZWlnaHQ6IDEuNjtib3gtc2l6aW5nOiBib3JkZXItYm94OyI+CQ0KCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O21heC13aWR0aDogNjAwcHggIWltcG9ydGFudDttYXJnaW46IDAgYXV0byAhaW1wb3J0YW50O2NsZWFyOiBib3RoICFpbXBvcnRhbnQ7Ij4NCgkJCTx0YWJsZSBzdHlsZT0iYm9yZGVyOiAxcHggc29saWQgI2MyYzJjMjt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDttYXJnaW46IDMwcHggMHB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czogNXB4Oy1tb3otYm9yZGVyLXJhZGl1czogNXB4Oy1vLWJvcmRlci1yYWRpdXM6IDVweDtib3JkZXItcmFkaXVzOiA1cHg7Ij4NCgkJCQk8dGJvZHk+DQoJCQkJCTx0ciBzdHlsZT0iYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7Ij4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDU5JTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7dGV4dC1hbGlnbjogbGVmdDtmb250LWZhbWlseTogTW9udHNlcnJhdCwgc2Fucy1zZXJpZjsiPg0KCQkJCQkJCQl7e2NvbXBhbnlfbmFtZX19PGJyIC8+e3tjb21wYW55X2FkZHJlc3N9fTxiciAvPnt7Y29tcGFueV9jaXR5fX0sIHt7Y29tcGFueV9zdGF0ZX19LCB7e2NvbXBhbnlfemlwfX08YnIgLz57e2NvbXBhbnlfY291bnRyeX19PGJyIC8+e3tjb21wYW55X3Bob25lfX08YnIgLz57e2NvbXBhbnlfZW1haWx9fQ0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDQwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7Ij4NCgkJCQkJCQkJPGRpdiBzdHlsZT0id2lkdGg6IDEzMHB4O2hlaWdodDogMTAwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO21hcmdpbjogMHB4IGF1dG87Ij4NCgkJCQkJCQkJCTxpbWcgc3R5bGU9IndpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0O2Rpc3BsYXk6IGlubGluZS1ibG9jaztoZWlnaHQ6IDEwMCU7IiBzcmM9Int7YnVzaW5lc3NfbG9nb319IiAvPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQk8L2Rpdj4NCgkJCQkJCTwvdGQ+DQoJCQkJCQkNCgkJCQkJCQ0KCQkJCQk8L3RyPg0KCQkJCQk8dHI+DQoJCQkJCQk8dGQ+DQoJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMjVweCAzMHB4O2JhY2tncm91bmQ6ICNmZmY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDkwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQkJPGg2IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bWFyZ2luOiAxMHB4IDBweCAxMHB4O2ZvbnQtd2VpZ2h0OiA2MDA7Ij5EZWFyIHt7YWRtaW5fbmFtZX19LCA8L2g2Pg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDttYXJnaW46IDEwcHggMHB4IDE1cHg7Ij5UaGUgYXBwb2ludG1lbnQgd2l0aCB7e2NsaWVudF9uYW1lfX0gd2l0aCBmb2xsb3dpbmcgZGV0YWlsczo8L3A+CQkJCQkJCQ0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPGRpdiBzdHlsZT0iZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7cGFkZGluZzogMTBweCAwcHg7Ij4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPldoZW46IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tib29raW5nX2RhdGV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+Rm9yOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7c2VydmljZV9uYW1lfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPk1ldGhvZHMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7bWV0aG9kbmFtZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Vbml0cyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3t1bml0c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5BZGQtb25zIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2FkZG9uc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QcmljZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twcmljZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQkNCgkJCQkJCQkJCQ0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+TmFtZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tmaXJzdG5hbWV9fSB7e2xhc3RuYW1lfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkVtYWlsIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2NsaWVudF9lbWFpbH19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QaG9uZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twaG9uZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QYXltZW50IDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3BheW1lbnRfbWV0aG9kfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPlZhY2N1bSBDbGVhbmVyIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3ZhY2N1bV9jbGVhbmVyX3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QYXJraW5nIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3Bhcmtpbmdfc3RhdHVzfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkFkZHJlc3MgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7YWRkcmVzc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Ob3RlcyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tub3Rlc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Db250YWN0IFN0YXR1cyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tjb250YWN0X3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJwYWRkaW5nOiAxNXB4IDBweDtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjsiPg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDtsaW5lLWhlaWdodDogMjJweDttYXJnaW46IDEwcHggMHB4IDE1cHg7ZmxvYXQ6IGxlZnQ7Ij5oYXMgYmVlbiBjYW5jZWxsZWQuPC9wPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMTBweCAwcHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7dGV4dC1hbGlnbjogY2VudGVyOyI+DQoJCQkJCQkJCQk8aDUgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTNweDttYXJnaW46IDBweCAwcHggNXB4OyI+VGhhbmsgeW91PC9oNT4NCgkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJPC9kaXY+DQoJCQkJCQk8L3RkPgkJCQkJDQoJCQkJCTwvdHI+CQkJCQ0KCQkJCTwvdGJvZHk+DQoJCQk8L3RhYmxlPgkNCgkJPC9kaXY+DQoJPC9kaXY+CQ0KPC9ib2R5Pg0KPC9odG1sPg==', 'E', 'CC', 'S'),
		(NULL, 'Appointment Rejected', '', 'PGh0bWw+DQo8aGVhZD4NCgk8bWV0YSBuYW1lPSJ2aWV3cG9ydCIgY29udGVudD0id2lkdGg9ZGV2aWNlLXdpZHRoLCBpbml0aWFsLXNjYWxlPTEuMCIvPg0KCTxtZXRhIGh0dHAtZXF1aXY9IkNvbnRlbnQtVHlwZSIgY29udGVudD0idGV4dC9odG1sOyBjaGFyc2V0PVVURi04IiAvPg0KCTx0aXRsZT5TdWJqZWN0OiB7e3NlcnZpY2VfbmFtZX19IG9uIHt7Ym9va2luZ19kYXRlfX08L3RpdGxlPg0KCTxsaW5rIGhyZWY9Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1Nb250c2VycmF0IiByZWw9InN0eWxlc2hlZXQiPg0KPC9oZWFkPg0KPGJvZHk+CQkNCgk8ZGl2IHN0eWxlPSJtYXJnaW46IDA7cGFkZGluZzogMDtmb250LWZhbWlseTogSGVsdmV0aWNhIE5ldWUsIEhlbHZldGljYSwgSGVsdmV0aWNhLCBBcmlhbCwgc2Fucy1zZXJpZjtmb250LXNpemU6IDEwMCU7bGluZS1oZWlnaHQ6IDEuNjtib3gtc2l6aW5nOiBib3JkZXItYm94OyI+CQ0KCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O21heC13aWR0aDogNjAwcHggIWltcG9ydGFudDttYXJnaW46IDAgYXV0byAhaW1wb3J0YW50O2NsZWFyOiBib3RoICFpbXBvcnRhbnQ7Ij4NCgkJCTx0YWJsZSBzdHlsZT0iYm9yZGVyOiAxcHggc29saWQgI2MyYzJjMjt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDttYXJnaW46IDMwcHggMHB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czogNXB4Oy1tb3otYm9yZGVyLXJhZGl1czogNXB4Oy1vLWJvcmRlci1yYWRpdXM6IDVweDtib3JkZXItcmFkaXVzOiA1cHg7Ij4NCgkJCQk8dGJvZHk+DQoJCQkJCTx0ciBzdHlsZT0iYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7Ij4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDU5JTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7dGV4dC1hbGlnbjogbGVmdDtmb250LWZhbWlseTogTW9udHNlcnJhdCwgc2Fucy1zZXJpZjsiPg0KCQkJCQkJCQl7e2NvbXBhbnlfbmFtZX19PGJyIC8+e3tjb21wYW55X2FkZHJlc3N9fTxiciAvPnt7Y29tcGFueV9jaXR5fX0sIHt7Y29tcGFueV9zdGF0ZX19LCB7e2NvbXBhbnlfemlwfX08YnIgLz57e2NvbXBhbnlfY291bnRyeX19PGJyIC8+e3tjb21wYW55X3Bob25lfX08YnIgLz57e2NvbXBhbnlfZW1haWx9fQ0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDQwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7Ij4NCgkJCQkJCQkJPGRpdiBzdHlsZT0id2lkdGg6IDEzMHB4O2hlaWdodDogMTAwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO21hcmdpbjogMHB4IGF1dG87Ij4NCgkJCQkJCQkJCTxpbWcgc3R5bGU9IndpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0O2Rpc3BsYXk6IGlubGluZS1ibG9jaztoZWlnaHQ6IDEwMCU7IiBzcmM9Int7YnVzaW5lc3NfbG9nb319IiAvPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQk8L2Rpdj4NCgkJCQkJCTwvdGQ+DQoJCQkJCQkNCgkJCQkJCQ0KCQkJCQk8L3RyPg0KCQkJCQk8dHI+DQoJCQkJCQk8dGQ+DQoJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMjVweCAzMHB4O2JhY2tncm91bmQ6ICNmZmY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDkwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQkJPGg2IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bWFyZ2luOiAxMHB4IDBweCAxMHB4O2ZvbnQtd2VpZ2h0OiA2MDA7Ij5EZWFyIHt7YWRtaW5fbmFtZX19LCA8L2g2Pg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDttYXJnaW46IDEwcHggMHB4IDE1cHg7Ij5UaGUgYXBwb2ludG1lbnQgd2l0aCB7e2NsaWVudF9uYW1lfX0gd2l0aCBmb2xsb3dpbmcgZGV0YWlsczo8L3A+CQkJCQkJCQ0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPGRpdiBzdHlsZT0iZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7cGFkZGluZzogMTBweCAwcHg7Ij4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPldoZW46IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tib29raW5nX2RhdGV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+Rm9yOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7c2VydmljZV9uYW1lfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPk1ldGhvZHMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7bWV0aG9kbmFtZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Vbml0cyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3t1bml0c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5BZGQtb25zIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2FkZG9uc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QcmljZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twcmljZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQkNCgkJCQkJCQkJCQ0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+TmFtZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tmaXJzdG5hbWV9fSB7e2xhc3RuYW1lfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkVtYWlsIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2NsaWVudF9lbWFpbH19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QaG9uZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twaG9uZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QYXltZW50IDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3BheW1lbnRfbWV0aG9kfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPlZhY2N1bSBDbGVhbmVyIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3ZhY2N1bV9jbGVhbmVyX3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QYXJraW5nIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3Bhcmtpbmdfc3RhdHVzfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkFkZHJlc3MgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7YWRkcmVzc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Ob3RlcyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tub3Rlc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Db250YWN0IFN0YXR1cyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tjb250YWN0X3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJwYWRkaW5nOiAxNXB4IDBweDtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjsiPg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDtsaW5lLWhlaWdodDogMjJweDttYXJnaW46IDEwcHggMHB4IDE1cHg7ZmxvYXQ6IGxlZnQ7Ij5oYXMgYmVlbiByZWplY3RlZC48L3A+DQoJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJwYWRkaW5nOiAxMHB4IDBweDtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jazt0ZXh0LWFsaWduOiBjZW50ZXI7Ij4NCgkJCQkJCQkJCTxoNSBzdHlsZT0iY29sb3I6ICM2MDYwNjA7Zm9udC1zaXplOiAxM3B4O21hcmdpbjogMHB4IDBweCA1cHg7Ij5UaGFuayB5b3U8L2g1Pg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQk8L2Rpdj4NCgkJCQkJCTwvdGQ+CQkJCQkNCgkJCQkJPC90cj4JCQkJDQoJCQkJPC90Ym9keT4NCgkJCTwvdGFibGU+CQ0KCQk8L2Rpdj4NCgk8L2Rpdj4JDQo8L2JvZHk+DQo8L2h0bWw+', 'E', 'R', 'S'),
		(NULL, 'Appointment Approved', '', 'PGh0bWw+DQo8aGVhZD4NCgk8bWV0YSBuYW1lPSJ2aWV3cG9ydCIgY29udGVudD0id2lkdGg9ZGV2aWNlLXdpZHRoLCBpbml0aWFsLXNjYWxlPTEuMCIvPg0KCTxtZXRhIGh0dHAtZXF1aXY9IkNvbnRlbnQtVHlwZSIgY29udGVudD0idGV4dC9odG1sOyBjaGFyc2V0PVVURi04IiAvPg0KCTx0aXRsZT5TdWJqZWN0OiB7e3NlcnZpY2VfbmFtZX19IG9uIHt7Ym9va2luZ19kYXRlfX08L3RpdGxlPg0KCTxsaW5rIGhyZWY9Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1Nb250c2VycmF0IiByZWw9InN0eWxlc2hlZXQiPg0KPC9oZWFkPg0KPGJvZHk+CQkNCgk8ZGl2IHN0eWxlPSJtYXJnaW46IDA7cGFkZGluZzogMDtmb250LWZhbWlseTogSGVsdmV0aWNhIE5ldWUsIEhlbHZldGljYSwgSGVsdmV0aWNhLCBBcmlhbCwgc2Fucy1zZXJpZjtmb250LXNpemU6IDEwMCU7bGluZS1oZWlnaHQ6IDEuNjtib3gtc2l6aW5nOiBib3JkZXItYm94OyI+CQ0KCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O21heC13aWR0aDogNjAwcHggIWltcG9ydGFudDttYXJnaW46IDAgYXV0byAhaW1wb3J0YW50O2NsZWFyOiBib3RoICFpbXBvcnRhbnQ7Ij4NCgkJCTx0YWJsZSBzdHlsZT0iYm9yZGVyOiAxcHggc29saWQgI2MyYzJjMjt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDttYXJnaW46IDMwcHggMHB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czogNXB4Oy1tb3otYm9yZGVyLXJhZGl1czogNXB4Oy1vLWJvcmRlci1yYWRpdXM6IDVweDtib3JkZXItcmFkaXVzOiA1cHg7Ij4NCgkJCQk8dGJvZHk+DQoJCQkJCTx0ciBzdHlsZT0iYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7Ij4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDU5JTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7dGV4dC1hbGlnbjogbGVmdDtmb250LWZhbWlseTogTW9udHNlcnJhdCwgc2Fucy1zZXJpZjsiPg0KCQkJCQkJCQl7e2NvbXBhbnlfbmFtZX19PGJyIC8+e3tjb21wYW55X2FkZHJlc3N9fTxiciAvPnt7Y29tcGFueV9jaXR5fX0sIHt7Y29tcGFueV9zdGF0ZX19LCB7e2NvbXBhbnlfemlwfX08YnIgLz57e2NvbXBhbnlfY291bnRyeX19PGJyIC8+e3tjb21wYW55X3Bob25lfX08YnIgLz57e2NvbXBhbnlfZW1haWx9fQ0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDQwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7Ij4NCgkJCQkJCQkJPGRpdiBzdHlsZT0id2lkdGg6IDEzMHB4O2hlaWdodDogMTAwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO21hcmdpbjogMHB4IGF1dG87Ij4NCgkJCQkJCQkJCTxpbWcgc3R5bGU9IndpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0O2Rpc3BsYXk6IGlubGluZS1ibG9jaztoZWlnaHQ6IDEwMCU7IiBzcmM9Int7YnVzaW5lc3NfbG9nb319IiAvPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQk8L2Rpdj4NCgkJCQkJCTwvdGQ+DQoJCQkJCQkNCgkJCQkJCQ0KCQkJCQk8L3RyPg0KCQkJCQk8dHI+DQoJCQkJCQk8dGQ+DQoJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMjVweCAzMHB4O2JhY2tncm91bmQ6ICNmZmY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDkwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQkJPGg2IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bWFyZ2luOiAxMHB4IDBweCAxMHB4O2ZvbnQtd2VpZ2h0OiA2MDA7Ij5EZWFyIHt7YWRtaW5fbmFtZX19LCA8L2g2Pg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDttYXJnaW46IDEwcHggMHB4IDE1cHg7Ij5UaGUgYXBwb2ludG1lbnQgd2l0aCB7e2NsaWVudF9uYW1lfX0gd2l0aCBmb2xsb3dpbmcgZGV0YWlsczo8L3A+CQkJCQkJCQ0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPGRpdiBzdHlsZT0iZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7cGFkZGluZzogMTBweCAwcHg7Ij4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPldoZW46IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tib29raW5nX2RhdGV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+Rm9yOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7c2VydmljZV9uYW1lfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPk1ldGhvZHMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7bWV0aG9kbmFtZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Vbml0cyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3t1bml0c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5BZGQtb25zIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2FkZG9uc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QcmljZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twcmljZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQkNCgkJCQkJCQkJCQ0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+TmFtZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tmaXJzdG5hbWV9fSB7e2xhc3RuYW1lfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkVtYWlsIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2NsaWVudF9lbWFpbH19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QaG9uZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twaG9uZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QYXltZW50IDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3BheW1lbnRfbWV0aG9kfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPlZhY2N1bSBDbGVhbmVyIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3ZhY2N1bV9jbGVhbmVyX3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QYXJraW5nIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3Bhcmtpbmdfc3RhdHVzfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkFkZHJlc3MgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7YWRkcmVzc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Ob3RlcyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tub3Rlc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Db250YWN0IFN0YXR1cyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tjb250YWN0X3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJwYWRkaW5nOiAxNXB4IDBweDtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjsiPg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDtsaW5lLWhlaWdodDogMjJweDttYXJnaW46IDEwcHggMHB4IDE1cHg7ZmxvYXQ6IGxlZnQ7Ij5oYXMgYmVlbiBjb25maXJtZWQuPC9wPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMTBweCAwcHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7dGV4dC1hbGlnbjogY2VudGVyOyI+DQoJCQkJCQkJCQk8aDUgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTNweDttYXJnaW46IDBweCAwcHggNXB4OyI+VGhhbmsgeW91PC9oNT4NCgkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJPC9kaXY+DQoJCQkJCQk8L3RkPgkJCQkJDQoJCQkJCTwvdHI+CQkJCQ0KCQkJCTwvdGJvZHk+DQoJCQk8L3RhYmxlPgkNCgkJPC9kaXY+DQoJPC9kaXY+CQ0KPC9ib2R5Pg0KPC9odG1sPg==', 'E', 'C', 'S'),
		(NULL, 'New Appointment Assigned', '', 'PGh0bWw+DQo8aGVhZD4NCgk8bWV0YSBuYW1lPSJ2aWV3cG9ydCIgY29udGVudD0id2lkdGg9ZGV2aWNlLXdpZHRoLCBpbml0aWFsLXNjYWxlPTEuMCIvPg0KCTxtZXRhIGh0dHAtZXF1aXY9IkNvbnRlbnQtVHlwZSIgY29udGVudD0idGV4dC9odG1sOyBjaGFyc2V0PVVURi04IiAvPg0KCTx0aXRsZT5TdWJqZWN0OiB7e3NlcnZpY2VfbmFtZX19IG9uIHt7Ym9va2luZ19kYXRlfX08L3RpdGxlPg0KCTxsaW5rIGhyZWY9Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1Nb250c2VycmF0IiByZWw9InN0eWxlc2hlZXQiPg0KPC9oZWFkPg0KPGJvZHk+CQkNCgk8ZGl2IHN0eWxlPSJtYXJnaW46IDA7cGFkZGluZzogMDtmb250LWZhbWlseTogSGVsdmV0aWNhIE5ldWUsIEhlbHZldGljYSwgSGVsdmV0aWNhLCBBcmlhbCwgc2Fucy1zZXJpZjtmb250LXNpemU6IDEwMCU7bGluZS1oZWlnaHQ6IDEuNjtib3gtc2l6aW5nOiBib3JkZXItYm94OyI+CQ0KCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O21heC13aWR0aDogNjAwcHggIWltcG9ydGFudDttYXJnaW46IDAgYXV0byAhaW1wb3J0YW50O2NsZWFyOiBib3RoICFpbXBvcnRhbnQ7Ij4NCgkJCTx0YWJsZSBzdHlsZT0iYm9yZGVyOiAxcHggc29saWQgI2MyYzJjMjt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDttYXJnaW46IDMwcHggMHB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czogNXB4Oy1tb3otYm9yZGVyLXJhZGl1czogNXB4Oy1vLWJvcmRlci1yYWRpdXM6IDVweDtib3JkZXItcmFkaXVzOiA1cHg7Ij4NCgkJCQk8dGJvZHk+DQoJCQkJCTx0ciBzdHlsZT0iYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7Ij4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDU5JTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7dGV4dC1hbGlnbjogbGVmdDtmb250LWZhbWlseTogTW9udHNlcnJhdCwgc2Fucy1zZXJpZjsiPg0KCQkJCQkJCQl7e2NvbXBhbnlfbmFtZX19PGJyIC8+e3tjb21wYW55X2FkZHJlc3N9fTxiciAvPnt7Y29tcGFueV9jaXR5fX0sIHt7Y29tcGFueV9zdGF0ZX19LCB7e2NvbXBhbnlfemlwfX08YnIgLz57e2NvbXBhbnlfY291bnRyeX19PGJyIC8+e3tjb21wYW55X3Bob25lfX08YnIgLz57e2NvbXBhbnlfZW1haWx9fQ0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDQwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7Ij4NCgkJCQkJCQkJPGRpdiBzdHlsZT0id2lkdGg6IDEzMHB4O2hlaWdodDogMTAwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO21hcmdpbjogMHB4IGF1dG87Ij4NCgkJCQkJCQkJCTxpbWcgc3R5bGU9IndpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0O2Rpc3BsYXk6IGlubGluZS1ibG9jaztoZWlnaHQ6IDEwMCU7IiBzcmM9Int7YnVzaW5lc3NfbG9nb319IiAvPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQk8L2Rpdj4NCgkJCQkJCTwvdGQ+DQoJCQkJCQkNCgkJCQkJCQ0KCQkJCQk8L3RyPg0KCQkJCQk8dHI+DQoJCQkJCQk8dGQ+DQoJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMjVweCAzMHB4O2JhY2tncm91bmQ6ICNmZmY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDkwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQkJPGg2IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bWFyZ2luOiAxMHB4IDBweCAxMHB4O2ZvbnQtd2VpZ2h0OiA2MDA7Ij5EZWFyIHt7YWRtaW5fbmFtZX19LCA8L2g2Pg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDttYXJnaW46IDEwcHggMHB4IDE1cHg7Ij5Zb3UndmUgbmV3IGFwcG9pbnRtZW50IHdpdGgge3tjbGllbnRfbmFtZX19IHdpdGggZm9sbG93aW5nIGRldGFpbHM6PC9wPgkJCQkJCQkNCgkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTxkaXYgc3R5bGU9ImZsb2F0OiBsZWZ0O3dpZHRoOiAxMDAlO2Rpc3BsYXk6IGJsb2NrO3BhZGRpbmc6IDEwcHggMHB4OyI+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5XaGVuOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Ym9va2luZ19kYXRlfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkZvcjogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3NlcnZpY2VfbmFtZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5NZXRob2RzIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e21ldGhvZG5hbWV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+VW5pdHMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7dW5pdHN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+QWRkLW9ucyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3thZGRvbnN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UHJpY2UgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7cHJpY2V9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJDQoJCQkJCQkJCQkNCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPk5hbWUgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Zmlyc3RuYW1lfX0ge3tsYXN0bmFtZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5FbWFpbCA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tjbGllbnRfZW1haWx9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UGhvbmUgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7cGhvbmV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UGF5bWVudCA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twYXltZW50X21ldGhvZH19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5WYWNjdW0gQ2xlYW5lciA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3t2YWNjdW1fY2xlYW5lcl9zdGF0dXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UGFya2luZyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twYXJraW5nX3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5BZGRyZXNzIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2FkZHJlc3N9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+Tm90ZXMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7bm90ZXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+Q29udGFjdCBTdGF0dXMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Y29udGFjdF9zdGF0dXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMTVweCAwcHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7Ym9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7Ij4NCgkJCQkJCQkJCTxwIHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bGluZS1oZWlnaHQ6IDIycHg7bWFyZ2luOiAxMHB4IDBweCAxNXB4O2Zsb2F0OiBsZWZ0OyI+VGhpcyBhcHBvaW50bWVudCBpcyBpbiBwZW5kaW5nLjwvcD4NCgkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTxkaXYgc3R5bGU9InBhZGRpbmc6IDEwcHggMHB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiAxMDAlO2Rpc3BsYXk6IGJsb2NrO3RleHQtYWxpZ246IGNlbnRlcjsiPg0KCQkJCQkJCQkJPGg1IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDEzcHg7bWFyZ2luOiAwcHggMHB4IDVweDsiPlRoYW5rIHlvdTwvaDU+DQoJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4JCQkJCQ0KCQkJCQk8L3RyPgkJCQkNCgkJCQk8L3Rib2R5Pg0KCQkJPC90YWJsZT4JDQoJCTwvZGl2Pg0KCTwvZGl2PgkNCjwvYm9keT4NCjwvaHRtbD4=', 'E', 'A', 'S');";
		 mysqli_query($this->conn,$email_template_insert_staff);
		
		
		$this->insert_option('ct_bf_first_name','on,Y,3,15');
		$this->insert_option('ct_bf_last_name','on,Y,3,15');
		$this->insert_option('ct_bf_email','on,Y,5,30');
		$this->insert_option('ct_bf_password','on,Y,8,10');
		$this->insert_option('ct_bf_phone','on,Y,9,12');
		$this->insert_option('ct_bf_address','on,Y,10,40');
		$this->insert_option('ct_bf_zip_code','on,Y,3,7');
		$this->insert_option('ct_bf_city','on,Y,3,15');
		$this->insert_option('ct_bf_state','on,Y,3,15');
		$this->insert_option('ct_bf_notes','on,Y,10,70');
		$this->insert_option('ct_front_language_selection_dropdown','Y');
		$this->insert_option('ct_calculation_policy','M');
		$this->insert_option('ct_staff_email_notification_status','N');
		$this->insert_option('ct_favicon_image','fevicon.png');
		$this->insert_option('ct_frontend_fonts','Raleway');
		
		
		$alllang = $this->get_all_languages();
        while($all = mysqli_fetch_array($alllang))
        {
            $language_label_arr = $this->get_all_labelsbyid($all[2]);
            $label_language_arr_first = $language_label_arr[1];
            $label_explode = explode("###",$label_language_arr_first);

            $label_decode_front = base64_decode($label_explode[0]);
            $label_decode_admin = base64_decode($label_explode[1]);
            $label_decode_error = base64_decode($label_explode[2]);
            $label_decode_extra = base64_decode($label_explode[3]);

            $label_decode_front_unserial = unserialize($label_decode_front);
            $label_decode_admin_unserial = unserialize($label_decode_admin);
            $label_decode_error_unserial = unserialize($label_decode_error);
            $label_decode_extra_unserial = unserialize($label_decode_extra);
			
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
			
            /* Add all labels which you want to add in new version from here */
            /* DEMO FOR ADDING LABEL */
			$label_decode_error_unserial["please_enter_below_36_characters"] = urlencode("Please enter below 36 characters");
			
			$label_decode_front_unserial["appointment_zip"] = urlencode("Appointment Zip");
			$label_decode_front_unserial["appointment_city"] = urlencode("Appointment City");
			$label_decode_front_unserial["appointment_state"] = urlencode("Appointment State");
			$label_decode_front_unserial["appointment_address"] = urlencode("Appointment Address");
			
			
			$label_decode_admin_unserial["pay_at_venue"]=urlencode("Pay At Venue");
			$label_decode_admin_unserial["jan"]=urlencode("JAN");
			$label_decode_admin_unserial["new_appointment_assigned"]=urlencode("New Appointment Assigned");
			$label_decode_admin_unserial["client_payments"] = urlencode("Client Payments");
			$label_decode_admin_unserial["staff_payments"] = urlencode("Staff Payments");
			$label_decode_admin_unserial["staff_payments_details"] = urlencode("Staff Payments Details");
			$label_decode_admin_unserial["advance_paid"] = urlencode("Advance Paid");
			$label_decode_admin_unserial["change_calculation_policyy"] = urlencode("Change Calculation Policy");
			$label_decode_admin_unserial["frontend_fonts"] = urlencode("Frontend fonts");
			$label_decode_admin_unserial["favicon_image"] = urlencode("Favicon Image");
			$label_decode_admin_unserial["staff_email_template"] = urlencode("Staff Email Template");
			$label_decode_admin_unserial["staff_details_add_new_and_manage_staff_payments"] = urlencode("Staff Details, Add new and manage staff payments");
			$label_decode_admin_unserial["add_staff"] = urlencode("Add staff");
			$label_decode_admin_unserial["staff_bookings_and_payments"] = urlencode("Staff Bookings & Payments");
			$label_decode_admin_unserial["staff_booking_details_and_payment"] = urlencode("Staff Booking Details and Payment");
			$label_decode_admin_unserial["select_option_to_show_bookings"] = urlencode("Select option to show bookings");
			$label_decode_admin_unserial["select_service"] = urlencode("Select Service");
			$label_decode_admin_unserial["staff_name"] = urlencode("Staff Name");
			$label_decode_admin_unserial["staff_payment"] = urlencode("Staff Payment");
			$label_decode_admin_unserial["add_payment_to_staff_account"] = urlencode("Add Payment to staff account");
			$label_decode_admin_unserial["amount_payable"] = urlencode("Amount Payable");
			$label_decode_admin_unserial["advance_paid"] = urlencode("Advance Paid");
			$label_decode_admin_unserial["save_changes"] = urlencode("Save changes");
			$label_decode_admin_unserial["front_error_labels"] = urlencode("Front Error Labels");			
			$label_decode_admin_unserial["service_commission"]=urlencode("Service Commission");
			$label_decode_admin_unserial["commission_total"]=urlencode("Commission Total");			
			$label_decode_admin_unserial["front_tool_tips"]=urlencode("FRONT TOOL TIPS");
			$label_decode_admin_unserial["staff_email_notification"]=urlencode("Staff Email Notification");
			$label_decode_admin_unserial["change_calculation_policy"]=urlencode("Change Calculation"); 
			$label_decode_admin_unserial["multiply"]=urlencode("Multiply");
			$label_decode_admin_unserial["equal"]=urlencode("Equal");
			$label_decode_admin_unserial["warning"]=urlencode("Warning!");
			$label_decode_admin_unserial["field_name"]=urlencode("Field Name");
			$label_decode_admin_unserial["enable_disable"]=urlencode("Enable/Disable");
			$label_decode_admin_unserial["required"]=urlencode("Required");
			$label_decode_admin_unserial["min_length"]=urlencode("Min Length");
			$label_decode_admin_unserial["max_length"]=urlencode("Max Length");
			$label_decode_admin_unserial["front_language_dropdown"]=urlencode("Front Language Dropdown");
			$label_decode_admin_unserial["enabled"]=urlencode("Enabled");
			$label_decode_admin_unserial["vaccume_cleaner"]=urlencode("Vaccume Cleaner");
			$label_decode_admin_unserial["parking"]=urlencode("Parking");
			$label_decode_admin_unserial["staff_members"]=urlencode("Staff Members");
			$label_decode_admin_unserial["add_new_staff_member"]=urlencode("Add new staff member");
			$label_decode_admin_unserial["role"]=urlencode("Role");
			$label_decode_admin_unserial["staff"]=urlencode("Staff");
			$label_decode_admin_unserial["admin"]=urlencode("Admin");
			$label_decode_admin_unserial["create"]=urlencode("Create");
			$label_decode_admin_unserial["service_details"]=urlencode("Service Details");
			$label_decode_admin_unserial["technical_admin"]=urlencode("Technical Admin");
			$label_decode_admin_unserial["enable_booking"]=urlencode("Enable Booking");
			$label_decode_admin_unserial["service_commission"]=urlencode("Service Commission");
			$label_decode_admin_unserial["percentage"]=urlencode("Percentage");
			$label_decode_admin_unserial["flat_commission"]=urlencode("Flat Commission");
			$label_decode_admin_unserial["save"]=urlencode("Save");
			$label_decode_admin_unserial["staff_details"]=urlencode("STAFF DETAILS");
			$label_decode_admin_unserial["assign_appointment_to_staff"]=urlencode("Assign Appointment to Staff");
			$label_decode_admin_unserial["delete_member"]=urlencode("Delete Member?");
			$label_decode_admin_unserial["manageable_form_fields_front_booking_form"]=urlencode("Manageable Form Fields For Front Booking Form");
			$label_decode_admin_unserial["manageable_form_fields"]=urlencode("Manageable Form Fields");
			
			$label_decode_error_unserial["invalid_values"]=urlencode("Invalid values");
			
			$front_form_error_labels = array(
		"min_ff_ps"=>urlencode("Please enter minimum 8 characters"),
		"max_ff_ps"=>urlencode("Please enter maximum 10 characters"),
		"req_ff_fn"=>urlencode("Please enter first name"),
		"min_ff_fn"=>urlencode("Please enter minimum 3 characters"),
		"max_ff_fn"=>urlencode("Please enter maximum 15 characters"),
		"req_ff_ln"=>urlencode("Please enter last name"),
		"min_ff_ln"=>urlencode("Please enter minimum 3 characters"),
		"max_ff_ln"=>urlencode("Please enter maximum 15 characters"),
		"req_ff_ph"=>urlencode("Please enter phone number"),
		"min_ff_ph"=>urlencode("Please enter minimum 9 characters"),
		"max_ff_ph"=>urlencode("Please enter maximum 12 characters"),
		"req_ff_sa"=>urlencode("Please enter street address"),
		"min_ff_sa"=>urlencode("Please enter minimum 10 characters"),
		"max_ff_sa"=>urlencode("Please enter maximum 40 characters"),
		"req_ff_zp"=>urlencode("Please enter zip code"),
		"min_ff_zp"=>urlencode("Please enter minimum 3 characters"),
		"max_ff_zp"=>urlencode("Please enter maximum 7 characters"),
		"req_ff_ct"=>urlencode("Please enter city"),
		"min_ff_ct"=>urlencode("Please enter minimum 3 characters"),
		"max_ff_ct"=>urlencode("Please enter maximum 15 characters"),
		"req_ff_st"=>urlencode("Please enter state"),
		"min_ff_st"=>urlencode("Please enter minimum 3 characters"),
		"max_ff_st"=>urlencode("Please enter maximum 15 characters"),
		"req_ff_srn"=>urlencode("Please enter notes"),
		"min_ff_srn"=>urlencode("Please enter minimum 10 characters"),
		"max_ff_srn"=>urlencode("Please enter maximum 70 characters"));
			$language_front_arr = base64_encode(serialize($label_decode_front_unserial));
            $language_admin_arr = base64_encode(serialize($label_decode_admin_unserial));
            $language_error_arr = base64_encode(serialize($label_decode_error_unserial));
            $language_extra_arr = base64_encode(serialize($label_decode_extra_unserial));
            $language_form_error_arr = base64_encode(serialize($front_form_error_labels));
			
            $languagearr = $language_front_arr."###".$language_admin_arr."###".$language_error_arr."###".$language_extra_arr."###".$language_form_error_arr;

            $update_default_lang = "UPDATE `ct_languages` SET `label_data` = '".$languagearr."' WHERE `language` = '".$all[2]."'";
            mysqli_query($this->conn, $update_default_lang);
		}
	}
    public function array_push_assoc($array, $key, $value){
        $array[$key] = $value;
        return $array;
    }
    public function get_all_languages()
    {
        $query = "select * from `ct_languages`";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }
    public function get_all_labelsbyid($lang)
    {
        $query = "select * from `ct_languages` where `language`='" . $lang . "'";
        $result = mysqli_query($this->conn, $query);
        $ress = @mysqli_fetch_array($result);
        return $ress;
    }
	public function update2_2()
	{
		$this->insert_option('ct_appointment_details_display','on');
		$alllang = $this->get_all_languages();
        while($all = mysqli_fetch_array($alllang))
        {
            $language_label_arr = $this->get_all_labelsbyid($all[2]);
            $label_language_arr_first = $language_label_arr[1];
            $label_explode = explode("###",$label_language_arr_first);

            $label_decode_front = base64_decode($label_explode[0]);
            $label_decode_admin = base64_decode($label_explode[1]);
            $label_decode_error = base64_decode($label_explode[2]);
            $label_decode_extra = base64_decode($label_explode[3]);
            $label_decode_front_form_error = base64_decode($label_explode[4]);

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
			
			
            /* Add all labels which you want to add in new version from here */
            /* DEMO FOR ADDING LABEL */
			/*$label_decode_admin_unserial["pay_at_venue"]=urlencode("Pay At Venue");*/
			$label_decode_admin_unserial["appointment_details_section"]=urlencode("Appointment Details Section");
$label_decode_admin_unserial["if_you_are_having_booking_system_which_need_the_booking_address_then_please_make_this_field_enable_or_else_it_will_not_able_to_take_the_booking_address_and_display_blank_address_in_the_booking"]=urlencode("If you are having booking system which need the booking address then please make this field enable or else it will not able to take the booking address and display blank address in the booking");
		$label_decode_front_unserial["please_check_for_the_below_missing_information"]=urlencode("Please check for the below missing information.");
		
		$label_decode_front_unserial["same_as_above"]=urlencode("Same As Above");
		$label_decode_admin_unserial["manageable_form_fields_front_booking_form"]=urlencode("Manageable Form Fields For Front Booking Form");
		
		$label_decode_front_unserial["please_provide_company_details_from_the_admin_panel"]=urlencode("Please provide company details from the admin panel.");
		$label_decode_front_unserial["please_add_some_services_methods_units_addons_from_the_admin_panel"]=urlencode("Please add some services, methods, units, addons from the admin panel.");
		$label_decode_front_unserial["please_add_time_scheduling_from_the_admin_panel"]=urlencode("Please add time scheduling from the admin panel.");
		$label_decode_front_unserial["please_complete_configurations_before_you_created_website_embed_code"]=urlencode("Please complete configurations before you created website embed code.");
		
			
			$language_front_arr = base64_encode(serialize($label_decode_front_unserial));
            $language_admin_arr = base64_encode(serialize($label_decode_admin_unserial));
            $language_error_arr = base64_encode(serialize($label_decode_error_unserial));
            $language_extra_arr = base64_encode(serialize($label_decode_extra_unserial));
            $language_form_error_arr = base64_encode(serialize($label_decode_front_form_error_unserial));
			
            $languagearr = $language_front_arr."###".$language_admin_arr."###".$language_error_arr."###".$language_extra_arr."###".$language_form_error_arr;

            $update_default_lang = "UPDATE `ct_languages` SET `label_data` = '".$languagearr."' WHERE `language` = '".$all[2]."'";
            mysqli_query($this->conn, $update_default_lang);
		}
	}
	
	public function update2_3(){
		$query1 = "ALTER TABLE `ct_payments` CHANGE `lastmodify` `lastmodify` TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP;";
		mysqli_query($this->conn,$query1);
		$query2 = "ALTER TABLE `ct_off_days` CHANGE `user_id` `user_id` INT(11) NULL;";
		mysqli_query($this->conn,$query2);
		$query3 = "ALTER TABLE `ct_off_days` CHANGE `status` `status` INT(1) NULL;";
		mysqli_query($this->conn,$query3);
		$query4 = "ALTER TABLE `ct_bookings` CHANGE `staff_ids` `staff_ids` VARCHAR(160) CHARACTER SET utf8 COLLATE utf8_general_ci NULL;";
		mysqli_query($this->conn,$query4);
		$query5 = "ALTER TABLE `ct_payments` CHANGE `lastmodify` `lastmodify` TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP;";
		mysqli_query($this->conn,$query5);
		$query6 = "ALTER TABLE `ct_users` CHANGE `vc_status` `vc_status` ENUM('Y','N','-') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'N';";
		mysqli_query($this->conn,$query6);
		$query7 = "ALTER TABLE `ct_users` CHANGE `p_status` `p_status` ENUM('Y','N','-') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'N';";
		mysqli_query($this->conn,$query7);
	}

	public function update2_4()
	{
		$this->insert_option('ct_recurrence_booking_status','N');
		$this->insert_option('ct_loader','default');
		$alllang = $this->get_all_languages();

		$add_paymentsss = "ALTER TABLE  `ct_payments` ADD  `recurrence_status` ENUM(  'Y',  'N' ) NOT NULL ,
		ADD  `payment_status` VARCHAR( 255 ) NOT NULL";
		mysqli_query($this->conn, $add_paymentsss);

        $q1s = "ALTER TABLE `ct_admin_info` ADD  `service_ids` VARCHAR( 255 ) NOT NULL";
		mysqli_query($this->conn, $q1s);

        $q2s = "ALTER TABLE `ct_week_days_available` ADD  `provider_schedule_type` VARCHAR( 30 ) DEFAULT ''";
		mysqli_query($this->conn, $q2s);

        while($all = mysqli_fetch_array($alllang))
        {
            $language_label_arr = $this->get_all_labelsbyid($all[2]);
            $label_language_arr_first = $language_label_arr[1];
            $label_explode = explode("###",$label_language_arr_first);

            $label_decode_front = base64_decode($label_explode[0]);
            $label_decode_admin = base64_decode($label_explode[1]);
            $label_decode_error = base64_decode($label_explode[2]);
            $label_decode_extra = base64_decode($label_explode[3]);
            $label_decode_front_form_error = base64_decode($label_explode[4]);

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
			
			
            /* Add all labels which you want to add in new version from here */
            /* DEMO FOR ADDING LABEL */
			/*$label_decode_admin_unserial["pay_at_venue"]=urlencode("Pay At Venue");*/
			$label_decode_admin_unserial["Recurrence_booking"]=urlencode("Recurrence Booking");
			$label_decode_admin_unserial["Reset_Color"]=urlencode("Reset Color");
			$label_decode_admin_unserial["Loader"]=urlencode("Loader");
			$label_decode_admin_unserial["CSS_Loader"]=urlencode("CSS Loader");
			$label_decode_admin_unserial["GIF_Loader"]=urlencode("GIF Loader");
			$label_decode_admin_unserial["Default_Loader"]=urlencode("Default Loader");
			$label_decode_admin_unserial["Bi_Monthly"]=urlencode("Bi-Monthly");
			$label_decode_admin_unserial["Recurrence_Type"]=urlencode("Recurrence Type");
			$label_decode_admin_unserial["Send_Invoice"]=urlencode("Send Invoice");
			$label_decode_admin_unserial["Recurrence"]=urlencode("Recurrence");
			$label_decode_admin_unserial["Fortnightly"]=urlencode("Fortnightly");
			$label_decode_front_unserial["please_select_provider"]=urlencode("Please select provider");
			$label_decode_front_unserial["Daily"]=urlencode("Daily");
			
			
			$language_front_arr = base64_encode(serialize($label_decode_front_unserial));
            $language_admin_arr = base64_encode(serialize($label_decode_admin_unserial));
            $language_error_arr = base64_encode(serialize($label_decode_error_unserial));
            $language_extra_arr = base64_encode(serialize($label_decode_extra_unserial));
            $language_form_error_arr = base64_encode(serialize($label_decode_front_form_error_unserial));
			
            $languagearr = $language_front_arr."###".$language_admin_arr."###".$language_error_arr."###".$language_extra_arr."###".$language_form_error_arr;

            $update_default_lang = "UPDATE `ct_languages` SET `label_data` = '".$languagearr."' WHERE `language` = '".$all[2]."'";
            mysqli_query($this->conn, $update_default_lang);
		}
	}
	public function update2_5()
	{
		$this->insert_option('ct_page_title','Cleanto Booking');
		
		$q1s = "ALTER TABLE `ct_languages` ADD `admin_labels` LONGTEXT NOT NULL AFTER `language`, ADD `error_labels` LONGTEXT NOT NULL AFTER `admin_labels`, ADD `extra_labels` LONGTEXT NOT NULL AFTER `error_labels`, ADD `front_error_labels` LONGTEXT NOT NULL AFTER `extra_labels`";
		mysqli_query($this->conn, $q1s);
		
		$alllang = $this->get_all_languages();

        while($all = mysqli_fetch_array($alllang))
        {
            $language_label_arr = $this->get_all_labelsbyid($all[2]);
			
			if($language_label_arr[3] == '' && $language_label_arr[4] == '' && $language_label_arr[5] == '' && $language_label_arr[6] == ''){
				$label_language_arr_first = $language_label_arr[1];
				$label_explode = explode("###",$label_language_arr_first);

				$label_decode_front = base64_decode($label_explode[0]);
				$label_decode_admin = base64_decode($label_explode[1]);
				$label_decode_error = base64_decode($label_explode[2]);
				$label_decode_extra = base64_decode($label_explode[3]);
				$label_decode_front_form_error = base64_decode($label_explode[4]);

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
				
				
				/* Add all labels which you want to add in new version from here */
				/* DEMO FOR ADDING LABEL */
				/*$label_decode_admin_unserial["pay_at_venue"]=urlencode("Pay At Venue");*/
				$label_decode_admin_unserial["page_title"]=urlencode("Page Title");
				
				$language_front_arr = base64_encode(serialize($label_decode_front_unserial));
				$language_admin_arr = base64_encode(serialize($label_decode_admin_unserial));
				$language_error_arr = base64_encode(serialize($label_decode_error_unserial));
				$language_extra_arr = base64_encode(serialize($label_decode_extra_unserial));
				$language_form_error_arr = base64_encode(serialize($label_decode_front_form_error_unserial));
				
				$update_default_lang = "UPDATE `ct_languages` set `label_data` = '".$language_front_arr."', `admin_labels` = '".$language_admin_arr."', `error_labels` = '".$language_error_arr."', `extra_labels` = '".$language_extra_arr."', `front_error_labels` = '".$language_form_error_arr."' where `language` = '".$all[2]."'";
				mysqli_query($this->conn, $update_default_lang);
			}else{

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
				
				
				/* Add all labels which you want to add in new version from here */
				/* DEMO FOR ADDING LABEL */
				/*$label_decode_admin_unserial["pay_at_venue"]=urlencode("Pay At Venue");*/
				$label_decode_admin_unserial["page_title"]=urlencode("Page Title");
				
				$language_front_arr = base64_encode(serialize($label_decode_front_unserial));
				$language_admin_arr = base64_encode(serialize($label_decode_admin_unserial));
				$language_error_arr = base64_encode(serialize($label_decode_error_unserial));
				$language_extra_arr = base64_encode(serialize($label_decode_extra_unserial));
				$language_form_error_arr = base64_encode(serialize($label_decode_front_form_error_unserial));
				
				$update_default_lang = "UPDATE `ct_languages` set `label_data` = '".$language_front_arr."', `admin_labels` = '".$language_admin_arr."', `error_labels` = '".$language_error_arr."', `extra_labels` = '".$language_extra_arr."', `front_error_labels` = '".$language_form_error_arr."' where `language` = '".$all[2]."'";
				mysqli_query($this->conn, $update_default_lang);
			}
		}
	}
	
	public function update2_6()
	{
		$alllang = $this->get_all_languages();

        while($all = mysqli_fetch_array($alllang))
        {
            $language_label_arr = $this->get_all_labelsbyid($all[2]);
			
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
				
				
			/* Add all labels which you want to add in new version from here */
			/* DEMO FOR ADDING LABEL */
			/*$label_decode_admin_unserial["pay_at_venue"]=urlencode("Pay At Venue");*/
			$label_decode_admin_unserial["company_info_settings"]=urlencode("Company Info Settings");
			$label_decode_admin_unserial["companyname"]=urlencode("Company Name");
			$label_decode_admin_unserial["Quantity"]=urlencode("Quantity");
			
			$language_front_arr = base64_encode(serialize($label_decode_front_unserial));
			$language_admin_arr = base64_encode(serialize($label_decode_admin_unserial));
			$language_error_arr = base64_encode(serialize($label_decode_error_unserial));
			$language_extra_arr = base64_encode(serialize($label_decode_extra_unserial));
			$language_form_error_arr = base64_encode(serialize($label_decode_front_form_error_unserial));
			
			$update_default_lang = "UPDATE `ct_languages` set `label_data` = '".$language_front_arr."', `admin_labels` = '".$language_admin_arr."', `error_labels` = '".$language_error_arr."', `extra_labels` = '".$language_extra_arr."', `front_error_labels` = '".$language_form_error_arr."' where `language` = '".$all[2]."'";
			mysqli_query($this->conn, $update_default_lang);
		}
	}
	
	public function update2_7()
	{
		$this->insert_option('ct_google_analytics_code','');
		$this->insert_option('ct_seo_meta_description','');
		$this->insert_option('ct_seo_og_title','');
		$this->insert_option('ct_seo_og_type','');
		$this->insert_option('ct_seo_og_url','');
		$this->insert_option('ct_seo_og_image','');
		
		$alllang = $this->get_all_languages();

        while($all = mysqli_fetch_array($alllang))
        {
            $language_label_arr = $this->get_all_labelsbyid($all[2]);
			
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
				
				
			/* Add all labels which you want to add in new version from here */
			/* DEMO FOR ADDING LABEL */
			/*$label_decode_admin_unserial["pay_at_venue"]=urlencode("Pay At Venue");*/
			$label_decode_error_unserial["Invalid_Image_Type"]=urlencode("Invalid_Image_Type");
			$label_decode_error_unserial["seo_settings_updated_successfully"]=urlencode("SEO settings updated successfully");

			$label_decode_admin_unserial["front_language_flags_list"]=urlencode("Front languages flag list");
			$label_decode_admin_unserial["Google_Analytics_Code"]=urlencode("Google Analytics Code");
			$label_decode_admin_unserial["Page_Meta_Tag"]=urlencode("Page/Meta Tag");
			$label_decode_admin_unserial["SEO_Settings"]=urlencode("SEO Settings");
			$label_decode_admin_unserial["Meta_Description"]=urlencode("Meta Description");
			$label_decode_admin_unserial["SEO"]=urlencode("SEO");
			$label_decode_admin_unserial["og_tag_image"]=urlencode("og Tag Image");
			$label_decode_admin_unserial["og_tag_url"]=urlencode("og Tag URL");
			$label_decode_admin_unserial["og_tag_type"]=urlencode("og Tag Type");
			$label_decode_admin_unserial["og_tag_title"]=urlencode("og Tag Title");
			
			$language_front_arr = base64_encode(serialize($label_decode_front_unserial));
			$language_admin_arr = base64_encode(serialize($label_decode_admin_unserial));
			$language_error_arr = base64_encode(serialize($label_decode_error_unserial));
			$language_extra_arr = base64_encode(serialize($label_decode_extra_unserial));
			$language_form_error_arr = base64_encode(serialize($label_decode_front_form_error_unserial));
			
			$update_default_lang = "UPDATE `ct_languages` set `label_data` = '".$language_front_arr."', `admin_labels` = '".$language_admin_arr."', `error_labels` = '".$language_error_arr."', `extra_labels` = '".$language_extra_arr."', `front_error_labels` = '".$language_form_error_arr."' where `language` = '".$all[2]."'";
			mysqli_query($this->conn, $update_default_lang);
		}
	}
	public function update2_8()
	{
		$this->insert_option('ct_company_title_display','Y');
		$this->insert_option('ct_custom_gif_loader','');
		$this->insert_option('ct_custom_css_loader','');
		
		$query_admin_role = "Update `ct_admin_info` set `role`='admin' where `id`=1";
		mysqli_query($this->conn,$query_admin_role);
		
		$alllang = $this->get_all_languages();

        while($all = mysqli_fetch_array($alllang))
        {
            $language_label_arr = $this->get_all_labelsbyid($all[2]);
			
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
				
				
			/* Add all labels which you want to add in new version from here */
			/* DEMO FOR ADDING LABEL */
			/*$label_decode_admin_unserial["pay_at_venue"]=urlencode("Pay At Venue");*/
			
			$label_decode_admin_unserial["Show_company_title"]=urlencode("Show company title");
			
			$language_front_arr = base64_encode(serialize($label_decode_front_unserial));
			$language_admin_arr = base64_encode(serialize($label_decode_admin_unserial));
			$language_error_arr = base64_encode(serialize($label_decode_error_unserial));
			$language_extra_arr = base64_encode(serialize($label_decode_extra_unserial));
			$language_form_error_arr = base64_encode(serialize($label_decode_front_form_error_unserial));
			
			$update_default_lang = "UPDATE `ct_languages` set `label_data` = '".$language_front_arr."', `admin_labels` = '".$language_admin_arr."', `error_labels` = '".$language_error_arr."', `extra_labels` = '".$language_extra_arr."', `front_error_labels` = '".$language_form_error_arr."' where `language` = '".$all[2]."'";
			mysqli_query($this->conn, $update_default_lang);
		}
	}
	
	public function update3_0()
	{
		mysqli_query($this->conn, "UPDATE `ct_week_days_available` SET `provider_id` = '1' WHERE `provider_id` = '0';");
		
		$get_time_slots_schedule_type = mysqli_query($this->conn, "SELECT * FROM `ct_settings` WHERE `option_name` = 'ct_time_slots_schedule_type'");
		$ct_time_slots_schedule_type = mysqli_fetch_array($get_time_slots_schedule_type);
		
		if($ct_time_slots_schedule_type['option_value'] == 'monthly'){
			mysqli_query($this->conn,"UPDATE `ct_week_days_available` SET `provider_schedule_type` = 'monthly' WHERE `provider_id` = '1';");
		}else{
			mysqli_query($this->conn,"UPDATE `ct_week_days_available` SET `provider_schedule_type` = 'weekly' WHERE `provider_id` = '1';");
		}		
		
		$this->insert_option('ct_calendar_defaultView','month');
		$this->insert_option('ct_calendar_firstDay','1');
		$alllang = $this->get_all_languages();

        while($all = mysqli_fetch_array($alllang))
        {
            $language_label_arr = $this->get_all_labelsbyid($all[2]);
			
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
				
				
			/* Add all labels which you want to add in new version from here */
			/* DEMO FOR ADDING LABEL */
			/*$label_decode_admin_unserial["pay_at_venue"]=urlencode("Pay At Venue");*/
			
			$label_decode_admin_unserial["Calendar_Fisrt_Day"]=urlencode("Calendar First Day");
			$label_decode_admin_unserial["Calendar_Default_View"]=urlencode("Calendar Default View");
			$label_decode_admin_unserial["Add_Manual_booking"]=urlencode("Add Manual Booking");
			
			$label_decode_error_unserial["you_cannot_book_on_past_date"]=urlencode("You cannot book on past date");
			
			$language_front_arr = base64_encode(serialize($label_decode_front_unserial));
			$language_admin_arr = base64_encode(serialize($label_decode_admin_unserial));
			$language_error_arr = base64_encode(serialize($label_decode_error_unserial));
			$language_extra_arr = base64_encode(serialize($label_decode_extra_unserial));
			$language_form_error_arr = base64_encode(serialize($label_decode_front_form_error_unserial));
			
			$update_default_lang = "UPDATE `ct_languages` set `label_data` = '".$language_front_arr."', `admin_labels` = '".$language_admin_arr."', `error_labels` = '".$language_error_arr."', `extra_labels` = '".$language_extra_arr."', `front_error_labels` = '".$language_form_error_arr."' where `language` = '".$all[2]."'";
			mysqli_query($this->conn, $update_default_lang);
		}
	}
	public function update3_2()
	{
		$add_options = "ALTER TABLE `ct_bookings` ADD `gc_event_id` VARCHAR(255) NOT NULL AFTER `staff_ids`, ADD `gc_staff_event_id` VARCHAR(255) NOT NULL AFTER `gc_event_id`;";
        mysqli_query($this->conn,$add_options);
		
		$this->insert_option('ct_gc_status','N');
		$this->insert_option('ct_gc_id','');
		$this->insert_option('ct_gc_client_id','');
		$this->insert_option('ct_gc_client_secret','');
		$this->insert_option('ct_gc_status_configure','');
		$this->insert_option('ct_gc_status_sync_configure','');
		$this->insert_option('ct_gc_token','');
		$this->insert_option('ct_gc_purchase_status','N');
		$this->insert_option('ct_gc_frontend_url','');
		$this->insert_option('ct_gc_admin_url','');
		$this->insert_option('ct_gc_version','');
		
		$this->insert_option('ct_payway_purchase_status','N');
		$this->insert_option('ct_payway_status','N');
		$this->insert_option('ct_payway_publishable_key','');
		$this->insert_option('ct_payway_secure_key','');
		$this->insert_option('ct_payway_version','');
		$this->insert_option('ct_payway_merchant_ID','');
		
		$this->insert_option('ct_eway_purchase_status','N');
		$this->insert_option('ct_eway_test_mode_status','N');
		$this->insert_option('ct_eway_api_username','');
		$this->insert_option('ct_eway_api_password','');
		$this->insert_option('ct_eway_status','N');
		$this->insert_option('ct_eway_version','');
		
		$serialized_arr = serialize(array('payway' => array('method' => 'indirect', 'include_path' => '/extension/payway/payway.php', 'option_name' => 'ct_payway_purchase_status'), 'eway' => array('method' => 'direct', 'include_path' => '/extension/eway/eway.php', 'option_name' => 'ct_eway_purchase_status')));
		$this->insert_option('ct_payment_extensions',$serialized_arr);
		
		$alllang = $this->get_all_languages();

        while($all = mysqli_fetch_array($alllang))
        {
            $language_label_arr = $this->get_all_labelsbyid($all[2]);
			
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
				
				
			/* Add all labels which you want to add in new version from here */
			/* DEMO FOR ADDING LABEL */
			/*$label_decode_admin_unserial["pay_at_venue"]=urlencode("Pay At Venue");*/
			$label_decode_admin_unserial["Your_currency_should_be_AUD_to_enable_payway_payment_gateway"]=urlencode("Your currency should be Australia Dollar to enable payway payment gateway");
		    $label_decode_admin_unserial["merchant_ID"]=urlencode("Merchant ID");
		    $label_decode_admin_unserial["secure_key"]=urlencode("Secure Key");
		    $label_decode_admin_unserial["payway"]=urlencode("Payway");
		    $label_decode_admin_unserial["Its_your_Cleanto_Google_Settings_page_url"]=urlencode("Its your Cleanto Google Settings page url");
		    $label_decode_admin_unserial["its_your_Cleanto_booking_form_page_url"]=urlencode("its your Cleanto booking form page url");
		    $label_decode_admin_unserial["You_can_get_your_client_secret_from_your_Google_Calendar_Console"]= urlencode("You can get your client secret from your Google Calendar Console");
		    $label_decode_admin_unserial["You_can_get_your_client_ID_from_your_Google_Calendar_Console"]=urlencode ("You can get your client ID from your Google Calendar Console");
		    $label_decode_admin_unserial[ "Your_Google_calendar_id_where_you_need_to_get_alerts_its_normaly_your_Gmail_ID"]=urlencode("Your  Google calendar id, where you need to get alerts, its normaly your Gmail ID. e.g.johndoe@example.com" );
			$label_decode_admin_unserial["Google_Calender_Settings"]=urlencode("Google Calender Settings");
			$label_decode_admin_unserial["Add_Appointments_To_Google_Calender"]=urlencode("Add Appointments To Google Calender");
			$label_decode_admin_unserial["Google_Calender_Id"]=urlencode("Google Calender ID");
			$label_decode_admin_unserial["Google_Calender_Client_Id"]=urlencode("Google Calender Client ID");
			$label_decode_admin_unserial["Google_Calender_Client_Secret"]=urlencode("Google Calender Client Secret");
			$label_decode_admin_unserial["Google_Calender_Frontend_URL"]=urlencode("Google Calender Frontend URL");
			$label_decode_admin_unserial["Google_Calender_Admin_URL"]=urlencode("Google Calender Admin URL");
			$label_decode_admin_unserial["Google_Calender_Configuration"]=urlencode("Google Calender Configuration");
			$label_decode_admin_unserial["How_it_works"]=urlencode("How it works?");
			$label_decode_admin_unserial["Two_Way_Sync"]=urlencode("Two Way Sync");
			$label_decode_admin_unserial["Verify_Account"]=urlencode("Verify Account");
			$label_decode_admin_unserial["Select_Calendar"]=urlencode("Select Calendar");
			$label_decode_admin_unserial["Disconnect"]=urlencode("Disconnect");
			$label_decode_admin_unserial["eway"]=urlencode("Eway");
			
			$label_decode_error_unserial["please_enter_merchant_ID"]=urlencode("Please enter merchant ID");
			$label_decode_error_unserial["please_enter_secure_key"]=urlencode("Please enter secure key");
			$label_decode_error_unserial["please_enter_google_calender_admin_url"]=urlencode("Please enter google calender admin url");
			$label_decode_error_unserial["please_enter_google_calender_frontend_url"]=urlencode("Please enter google calender frontend url");
			$label_decode_error_unserial["please_enter_google_calender_client_secret"]=urlencode("Please enter google calender client secret");
			$label_decode_error_unserial["please_enter_google_calender_client_ID"]=urlencode("Please enter google calender client ID");
			$label_decode_error_unserial["please_enter_google_calender_ID"]=urlencode("Please enter google calender ID");
			
			$label_decode_front_form_error_unserial["Transaction_failed_please_try_again"]=urlencode("Transaction failed please try again");
			$label_decode_front_form_error_unserial["Please_Enter_valid_card_detail"]=urlencode("Please Enter valid card detail");
			
			$language_front_arr = base64_encode(serialize($label_decode_front_unserial));
			$language_admin_arr = base64_encode(serialize($label_decode_admin_unserial));
			$language_error_arr = base64_encode(serialize($label_decode_error_unserial));
			$language_extra_arr = base64_encode(serialize($label_decode_extra_unserial));
			$language_form_error_arr = base64_encode(serialize($label_decode_front_form_error_unserial));
			
			$update_default_lang = "UPDATE `ct_languages` set `label_data` = '".$language_front_arr."', `admin_labels` = '".$language_admin_arr."', `error_labels` = '".$language_error_arr."', `extra_labels` = '".$language_extra_arr."', `front_error_labels` = '".$language_form_error_arr."' where `language` = '".$all[2]."'";
			mysqli_query($this->conn, $update_default_lang);
		}
	}
	
	public function update3_3()
	{
		$q1s = "ALTER TABLE `ct_service_methods_units` ADD  `limit_title` VARCHAR( 255 ) NOT NULL";
		mysqli_query($this->conn, $q1s);

		
		$alllang = $this->get_all_languages();

        while($all = mysqli_fetch_array($alllang))
        {
            $language_label_arr = $this->get_all_labelsbyid($all[2]);
			
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
				
				
			/* Add all labels which you want to add in new version from here */
			/* DEMO FOR ADDING LABEL */
			/*$label_decode_admin_unserial["pay_at_venue"]=urlencode("Pay At Venue");*/
			
			$label_decode_admin_unserial["option_title"]=urlencode("Option Title");
			
			$language_front_arr = base64_encode(serialize($label_decode_front_unserial));
			$language_admin_arr = base64_encode(serialize($label_decode_admin_unserial));
			$language_error_arr = base64_encode(serialize($label_decode_error_unserial));
			$language_extra_arr = base64_encode(serialize($label_decode_extra_unserial));
			$language_form_error_arr = base64_encode(serialize($label_decode_front_form_error_unserial));
			
			$update_default_lang = "UPDATE `ct_languages` set `label_data` = '".$language_front_arr."', `admin_labels` = '".$language_admin_arr."', `error_labels` = '".$language_error_arr."', `extra_labels` = '".$language_extra_arr."', `front_error_labels` = '".$language_form_error_arr."' where `language` = '".$all[2]."'";
			mysqli_query($this->conn, $update_default_lang);
		}
	}
	
	
	public function update4_0()
	{
		$q1s = "ALTER TABLE `ct_service_methods_units` ADD  `half_section` enum('D','E') COLLATE utf8_unicode_ci NOT NULL COMMENT 'D=Disable,E=Enable'";
		mysqli_query($this->conn, $q1s);
		
		$q1s1 = "ALTER TABLE `ct_users` ADD `cus_dt` TIMESTAMP NOT NULL";
		mysqli_query($this->conn, $q1s1);

		$email_user = "CREATE TABLE IF NOT EXISTS `ct_email_user` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `cus_ids` text NOT NULL,
        `cus_sub` varchar(100) NOT NULL,
        `cus_msg` text NOT NULL,
        `cus_img` text NOT NULL,
        `cus_dt` TIMESTAMP,
        PRIMARY KEY (`id`)
       ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
		mysqli_query($this->conn,$email_user);
		
		$email_user = "CREATE TABLE IF NOT EXISTS `ct_sms_user` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `cus_ids` text NOT NULL,
        `cus_msg` text NOT NULL,
        `cus_dt` TIMESTAMP,
        PRIMARY KEY (`id`)
       ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
		mysqli_query($this->conn,$email_user);
		
		$this->insert_option('ct_special_offer','N');
		$this->insert_option('ct_special_offer_text','');
		
		$alllang = $this->get_all_languages();

        while($all = mysqli_fetch_array($alllang))
        {
            $language_label_arr = $this->get_all_labelsbyid($all[2]);
			
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
				
				
			/* Add all labels which you want to add in new version from here */
			/* DEMO FOR ADDING LABEL */
			/*$label_decode_admin_unserial["pay_at_venue"]=urlencode("Pay At Venue");*/
			
			$label_decode_admin_unserial["half_section"]=urlencode("Half Section");
			$label_decode_admin_unserial["crm"]=urlencode("CRM");
			$label_decode_admin_unserial["message"]=urlencode("Message");
			$label_decode_admin_unserial["send_message"]=urlencode("Send Message");
			$label_decode_admin_unserial["all_messages"]=urlencode("All Messages");
			$label_decode_admin_unserial["subject"]=urlencode("Subject");
			$label_decode_admin_unserial["add_attachment"]=urlencode("Add Attachment");
			$label_decode_admin_unserial["send"]=urlencode("Send");
			$label_decode_admin_unserial["close"]=urlencode("Close");
			$label_decode_admin_unserial["delete_this_customer?"]=urlencode("Delete This Customer?");
			$label_decode_admin_unserial["attachment"]=urlencode("attachment");
			$label_decode_admin_unserial["date"]=urlencode("date");
			$label_decode_admin_unserial["see_attachment"]=urlencode("See Attachment");
			$label_decode_admin_unserial["yes"]=urlencode("Yes");
			$label_decode_admin_unserial["add_new_customer"]=urlencode("Add New Customer");
			$label_decode_admin_unserial["no_attachment"]=urlencode("No Attachment");
			$label_decode_admin_unserial["sms"]=urlencode("SMS");
			$label_decode_admin_unserial["ct_special_offer"]=urlencode("Special Offer");
			$label_decode_admin_unserial["ct_special_offer_text"]=urlencode("Special offer Text");
			
			$label_decode_error_unserial["only_jpeg_png_gif_zip_and_pdf_allowed"]=urlencode("Only jpeg, png, gif, zip and pdf Allowed");
			$label_decode_error_unserial["please_wait_while_we_send_all_your_message"]=urlencode("Please Wait While We Send All Your Messages");
			$label_decode_error_unserial["please_enable_email_to_client"]=urlencode("Please Enable Emails To Client.");
			$label_decode_error_unserial["please_enable_sms_gateway"]=urlencode("Please Enable SMS Gateway.");
			$label_decode_error_unserial["please_enable_client_notification"]=urlencode("Please Enable Client Notification.");
			
			$language_front_arr = base64_encode(serialize($label_decode_front_unserial));
			$language_admin_arr = base64_encode(serialize($label_decode_admin_unserial));
			$language_error_arr = base64_encode(serialize($label_decode_error_unserial));
			$language_extra_arr = base64_encode(serialize($label_decode_extra_unserial));
			$language_form_error_arr = base64_encode(serialize($label_decode_front_form_error_unserial));
			
			$update_default_lang = "UPDATE `ct_languages` set `label_data` = '".$language_front_arr."', `admin_labels` = '".$language_admin_arr."', `error_labels` = '".$language_error_arr."', `extra_labels` = '".$language_extra_arr."', `front_error_labels` = '".$language_form_error_arr."' where `language` = '".$all[2]."'";
			mysqli_query($this->conn, $update_default_lang);
		}
	}

      public function update4_2()
      {     

            $query = "CREATE TABLE IF NOT EXISTS `ct_staff_status` (
              `id` int(50) NOT NULL AUTO_INCREMENT,
              `staff_id` int(50) NOT NULL,
              `order_id` int(50) NOT NULL,
              `status` enum('A','D') NOT NULL DEFAULT 'D',
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=200;" ;
                  
            mysqli_query($this->conn, $query);
      
            $q1s = "ALTER TABLE `ct_languages` ADD `language_status` ENUM('Y','N') NOT NULL AFTER `front_error_labels`";
            mysqli_query($this->conn, $q1s);
      
            $alllang = $this->get_all_languages();

            while($all = mysqli_fetch_assoc($alllang))
            {   
                  $language_name = $all['language'];
                  $language_label_arr = $this->get_all_labelsbyid($all['language']);
                  
                  $label_decode_front = base64_decode($language_label_arr['label_data']);
                  $label_decode_admin = base64_decode($language_label_arr['admin_labels']);
                  $label_decode_error = base64_decode($language_label_arr['error_labels']);
                  $label_decode_extra = base64_decode($language_label_arr['extra_labels']);
                  $label_decode_front_form_error = base64_decode($language_label_arr['front_error_labels']);
                  
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
                        
                  /* Add all labels which you want to add in new version from here */
                  /* DEMO FOR ADDING LABEL */
                  if($language_name == "en"){
                        
                        $label_decode_front_unserial["am"]=urlencode("AM");
                        $label_decode_front_unserial["pm"]=urlencode("PM");
                        
                        $label_decode_admin_unserial["accept"]=urlencode("Accept");
                        $label_decode_admin_unserial["decline"]=urlencode("Decline");
                        $label_decode_admin_unserial["paid"]=urlencode("Paid");
                        $label_decode_admin_unserial["accepted"]=urlencode("Accepted");
                        $label_decode_admin_unserial["payment_status"]=urlencode("Payment Status");
                        $label_decode_admin_unserial["staff_booking_status"]=urlencode("Staff Booking Status");
                        
                        $label_decode_error_unserial["language_status_change_successfully"]=urlencode("Language Status Change Successfully");
                        $label_decode_error_unserial["commission_amount_should_not_be_greater_then_order_amount"]=urlencode("Commission Amount should not be Greater then Order Amount");
                  }elseif($language_name == "de_DE"){
                        $label_decode_front_unserial["am"]=urlencode("AM");
                        $label_decode_front_unserial["pm"]=urlencode("P.M");
                        
                        $label_decode_admin_unserial["accept"]=urlencode("Aanvaarden");
                        $label_decode_admin_unserial["decline"]=urlencode("Afwijzen");
                        $label_decode_admin_unserial["paid"]=urlencode("Betaald");
                        $label_decode_admin_unserial["accepted"]=urlencode("Aanvaard");
                        $label_decode_admin_unserial["payment_status"]=urlencode("Betalingsstatus");
                        $label_decode_admin_unserial["staff_booking_status"]=urlencode("Boekingstatus personeel");
                        
                        $label_decode_error_unserial["language_status_change_successfully"]=urlencode("Taal Status is succesvol gewijzigd");
                        $label_decode_error_unserial["commission_amount_should_not_be_greater_then_order_amount"]=urlencode("Bedragen van de Commissie mogen niet groter zijn dan het bestellingsbedrag");
                  }elseif($language_name == "es_ES"){
                        $label_decode_front_unserial["am"]=urlencode("A.M");
                        $label_decode_front_unserial["pm"]=urlencode("PM");
                        
                        $label_decode_admin_unserial["accept"]=urlencode("Aceptar");
                        $label_decode_admin_unserial["decline"]=urlencode("Disminución");
                        $label_decode_admin_unserial["paid"]=urlencode("Pagado");
                        $label_decode_admin_unserial["accepted"]=urlencode("Aceptado");
                        $label_decode_admin_unserial["payment_status"]=urlencode("Estado de pago");
                        $label_decode_admin_unserial["staff_booking_status"]=urlencode("Estado de la reserva del personal");
                        
                        $label_decode_error_unserial["language_status_change_successfully"]=urlencode("Cambio de estado del idioma con éxito");
                        $label_decode_error_unserial["commission_amount_should_not_be_greater_then_order_amount"]=urlencode("La cantidad de la comisión no debe ser mayor que el monto de la orden");
                  }elseif($language_name == "fr_FR"){
                        $label_decode_front_unserial["am"]=urlencode("UN M");
                        $label_decode_front_unserial["pm"]=urlencode("PM");
                        
                        $label_decode_admin_unserial["accept"]=urlencode("Acceptez");
                        $label_decode_admin_unserial["decline"]=urlencode("Déclin");
                        $label_decode_admin_unserial["paid"]=urlencode("Payé");
                        $label_decode_admin_unserial["accepted"]=urlencode("Accepté");
                        $label_decode_admin_unserial["payment_status"]=urlencode("Statut de paiement");
                        $label_decode_admin_unserial["staff_booking_status"]=urlencode("Statut de réservation du personnel");
                        
                        $label_decode_error_unserial["language_status_change_successfully"]=urlencode("Changement de statut de langue avec succès");
                        $label_decode_error_unserial["commission_amount_should_not_be_greater_then_order_amount"]=urlencode("Le montant de la commission ne doit pas être supérieur au montant de la commande");
                  }elseif($language_name == "pt_PT"){
                        $label_decode_front_unserial["am"]=urlencode("SOU");
                        $label_decode_front_unserial["pm"]=urlencode("PM");
                        
                        $label_decode_admin_unserial["accept"]=urlencode("Aceitar");
                        $label_decode_admin_unserial["decline"]=urlencode("Declínio");
                        $label_decode_admin_unserial["paid"]=urlencode("Pago");
                        $label_decode_admin_unserial["accepted"]=urlencode("Aceitaram");
                        $label_decode_admin_unserial["payment_status"]=urlencode("Status do pagamento");
                        $label_decode_admin_unserial["staff_booking_status"]=urlencode("Status de reserva de pessoal");
                        
                        $label_decode_error_unserial["language_status_change_successfully"]=urlencode("Mudança de Status de Idioma com Sucesso");
                        $label_decode_error_unserial["commission_amount_should_not_be_greater_then_order_amount"]=urlencode("O valor da comissão não deve ser maior que o valor do pedido");
                  }elseif($language_name == "ru_RU"){
                        $label_decode_front_unserial["am"]=urlencode("AM");
                        $label_decode_front_unserial["pm"]=urlencode("ВЕЧЕРА");
                        
                        $label_decode_admin_unserial["accept"]=urlencode("принимать");
                        $label_decode_admin_unserial["decline"]=urlencode("снижение");
                        $label_decode_admin_unserial["paid"]=urlencode("оплаченный");
                        $label_decode_admin_unserial["accepted"]=urlencode("Принято");
                        $label_decode_admin_unserial["payment_status"]=urlencode("Статус платежа");
                        $label_decode_admin_unserial["staff_booking_status"]=urlencode("Статус бронирования персонала");
                        
                        $label_decode_error_unserial["language_status_change_successfully"]=urlencode("Изменение статуса языка успешно");
                        $label_decode_error_unserial["commission_amount_should_not_be_greater_then_order_amount"]=urlencode("Сумма комиссии не должна превышать сумму заказа");
                  }elseif($language_name == "ar"){
                        $label_decode_front_unserial["am"]=urlencode("صباحا");
                        $label_decode_front_unserial["pm"]=urlencode("مساء");
                        
                        $label_decode_admin_unserial["accept"]=urlencode("قبول");
                        $label_decode_admin_unserial["decline"]=urlencode("انخفاض");
                        $label_decode_admin_unserial["paid"]=urlencode("دفع");
                        $label_decode_admin_unserial["accepted"]=urlencode("قبلت");
                        $label_decode_admin_unserial["payment_status"]=urlencode("حالة السداد");
                        $label_decode_admin_unserial["staff_booking_status"]=urlencode("حالة حجز الموظفين");
                        
                        $label_decode_error_unserial["language_status_change_successfully"]=urlencode("تغيير حالة اللغة بنجاح");
                        $label_decode_error_unserial["commission_amount_should_not_be_greater_then_order_amount"]=urlencode("يجب ألا يكون مبلغ العمولة أكبر من مبلغ الطلب");
                  }elseif($language_name == "zh_CN"){
                        $label_decode_front_unserial["am"]=urlencode("上午");
                        $label_decode_front_unserial["pm"]=urlencode("下午");
                        
                        $label_decode_admin_unserial["accept"]=urlencode("接受");
                        $label_decode_admin_unserial["decline"]=urlencode("下降");
                        $label_decode_admin_unserial["paid"]=urlencode("付费");
                        $label_decode_admin_unserial["accepted"]=urlencode("公认");
                        $label_decode_admin_unserial["payment_status"]=urlencode("支付状态");
                        $label_decode_admin_unserial["staff_booking_status"]=urlencode("员工预订状态");
                        
                        $label_decode_error_unserial["language_status_change_successfully"]=urlencode("语言状态变化成功");
                        $label_decode_error_unserial["commission_amount_should_not_be_greater_then_order_amount"]=urlencode("佣金金额不应大于订单金额");
                  }
                  
                  $language_front_arr = base64_encode(serialize($label_decode_front_unserial));
                  $language_admin_arr = base64_encode(serialize($label_decode_admin_unserial));
                  $language_error_arr = base64_encode(serialize($label_decode_error_unserial));
                  $language_extra_arr = base64_encode(serialize($label_decode_extra_unserial));
                  $language_form_error_arr = base64_encode(serialize($label_decode_front_form_error_unserial));
                  
                  $update_default_lang = "UPDATE `ct_languages` set `label_data` = '".$language_front_arr."', `admin_labels` = '".$language_admin_arr."', `error_labels` = '".$language_error_arr."', `extra_labels` = '".$language_extra_arr."', `front_error_labels` = '".$language_form_error_arr."' where `language` = '".$all['language']."'";
                  mysqli_query($this->conn, $update_default_lang);
            }
      }

      public function update4_3()
      {
            $alllang = $this->get_all_languages();

            while($all = mysqli_fetch_assoc($alllang))
            {   
                  $language_name = $all['language'];
                  $language_label_arr = $this->get_all_labelsbyid($all['language']);
                  
                  $label_decode_front = base64_decode($language_label_arr['label_data']);
                  $label_decode_admin = base64_decode($language_label_arr['admin_labels']);
                  $label_decode_error = base64_decode($language_label_arr['error_labels']);
                  $label_decode_extra = base64_decode($language_label_arr['extra_labels']);
                  $label_decode_front_form_error = base64_decode($language_label_arr['front_error_labels']);
                  
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
                        
                  /* Add all labels which you want to add in new version from here */
                  /* DEMO FOR ADDING LABEL */
                  if($language_name == "en"){
                        if(!array_key_exists("am",$label_decode_front_unserial)){
                              $label_decode_front_unserial["am"]=urlencode("AM");
                              $label_decode_front_unserial["pm"]=urlencode("PM");
                        }
                        $label_decode_admin_unserial["appointment_rescheduled_by_service_provider"]=urlencode("Appointment Rescheduled by Service Provider");
                        $label_decode_error_unserial["maximum_advance_booking_time_is_over"]=urlencode("Maximum Advance Booking Time is Over");
                  }elseif($language_name == "de_DE"){
                        if(!array_key_exists("am",$label_decode_front_unserial)){
                              $label_decode_front_unserial["am"]=urlencode("AM");
                              $label_decode_front_unserial["pm"]=urlencode("P.M");
                        }
                        $label_decode_admin_unserial["appointment_rescheduled_by_service_provider"]=urlencode("Afspraak opnieuw gepland door serviceprovider");
                        $label_decode_error_unserial["maximum_advance_booking_time_is_over"]=urlencode("Maximale Advance-boekingstijd is voorbij");
                  }elseif($language_name == "es_ES"){
                        if(!array_key_exists("am",$label_decode_front_unserial)){
                              $label_decode_front_unserial["am"]=urlencode("A.M");
                              $label_decode_front_unserial["pm"]=urlencode("PM");
                        }
                        $label_decode_admin_unserial["appointment_rescheduled_by_service_provider"]=urlencode("Cita reprogramada por el proveedor de servicios");
                        $label_decode_error_unserial["maximum_advance_booking_time_is_over"]=urlencode("El tiempo máximo de reserva anticipada ha terminado");
                  }elseif($language_name == "fr_FR"){
                        if(!array_key_exists("am",$label_decode_front_unserial)){
                              $label_decode_front_unserial["am"]=urlencode("UN M");
                              $label_decode_front_unserial["pm"]=urlencode("PM");
                        }
                        $label_decode_admin_unserial["appointment_rescheduled_by_service_provider"]=urlencode("Rendez-vous reporté par le fournisseur de services");
                        $label_decode_error_unserial["maximum_advance_booking_time_is_over"]=urlencode("Le délai maximum de réservation à l'avance est écoulé");
                  }elseif($language_name == "pt_PT"){
                        if(!array_key_exists("am",$label_decode_front_unserial)){
                              $label_decode_front_unserial["am"]=urlencode("SOU");
                              $label_decode_front_unserial["pm"]=urlencode("PM");
                        }
                        $label_decode_admin_unserial["appointment_rescheduled_by_service_provider"]=urlencode("Nomeação reprogramada pelo provedor de serviços");
                        $label_decode_error_unserial["maximum_advance_booking_time_is_over"]=urlencode("O tempo máximo de reserva antecipada acabou");
                  }elseif($language_name == "ru_RU"){
                        if(!array_key_exists("am",$label_decode_front_unserial)){
                              $label_decode_front_unserial["am"]=urlencode("AM");
                              $label_decode_front_unserial["pm"]=urlencode("ВЕЧЕРА");
                        }
                        $label_decode_admin_unserial["appointment_rescheduled_by_service_provider"]=urlencode("Назначение, перенесенное поставщиком услуг");
                        $label_decode_error_unserial["maximum_advance_booking_time_is_over"]=urlencode("Максимальное время предварительного бронирования");
                  }elseif($language_name == "ar"){
                        if(!array_key_exists("am",$label_decode_front_unserial)){
                              $label_decode_front_unserial["am"]=urlencode("صباحا");
                              $label_decode_front_unserial["pm"]=urlencode("مساء");
                        }
                        $label_decode_admin_unserial["appointment_rescheduled_by_service_provider"]=urlencode("موعد جدولة من قبل مقدم الخدمة");
                        $label_decode_error_unserial["maximum_advance_booking_time_is_over"]=urlencode("الحد الأقصى للحجز مسبقا هو أكثر من اللازم");
                  }elseif($language_name == "zh_CN"){
                        if(!array_key_exists("am",$label_decode_front_unserial)){
                              $label_decode_front_unserial["am"]=urlencode("上午");
                              $label_decode_front_unserial["pm"]=urlencode("下午");
                        }
                        $label_decode_admin_unserial["appointment_rescheduled_by_service_provider"]=urlencode("由服务提供商重新安排的预约");
                        $label_decode_error_unserial["maximum_advance_booking_time_is_over"]=urlencode("最长提前预订时间结束");
                  }else{
                        if(!array_key_exists("am",$label_decode_front_unserial)){
                              $label_decode_front_unserial["am"]=urlencode("AM");
                              $label_decode_front_unserial["pm"]=urlencode("PM");
                        }
                        $label_decode_admin_unserial["appointment_rescheduled_by_service_provider"]=urlencode("Appointment Rescheduled by Service Provider");
                        $label_decode_error_unserial["maximum_advance_booking_time_is_over"]=urlencode("Maximum Advance Booking Time is Over");
                  }
                  
                  $language_front_arr = base64_encode(serialize($label_decode_front_unserial));
                  $language_admin_arr = base64_encode(serialize($label_decode_admin_unserial));
                  $language_error_arr = base64_encode(serialize($label_decode_error_unserial));
                  $language_extra_arr = base64_encode(serialize($label_decode_extra_unserial));
                  $language_form_error_arr = base64_encode(serialize($label_decode_front_form_error_unserial));
                  
                  $update_default_lang = "UPDATE `ct_languages` set `label_data` = '".$language_front_arr."', `admin_labels` = '".$language_admin_arr."', `error_labels` = '".$language_error_arr."', `extra_labels` = '".$language_extra_arr."', `front_error_labels` = '".$language_form_error_arr."' where `language` = '".$all['language']."'";
                  mysqli_query($this->conn, $update_default_lang);
            }
      }
	  
	public function update4_4()
	{

	    $this->insert_option('ct_star_show_on_front','N');
	
		$query = "CREATE TABLE IF NOT EXISTS `ct_rating_review` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
                `staff_id` int(11) NOT NULL,
                `order_id` bigint(11) NOT NULL,
                `rating` double NOT NULL,
                `review` text NOT NULL,
                PRIMARY KEY (`id`)
		) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1";
			  
		mysqli_query($this->conn, $query);

		$alllang = $this->get_all_languages();

		while($all = mysqli_fetch_assoc($alllang))
		{   
			$language_name = $all['language'];
			$language_label_arr = $this->get_all_labelsbyid($all['language']);

			$label_decode_front = base64_decode($language_label_arr['label_data']);
			$label_decode_admin = base64_decode($language_label_arr['admin_labels']);
			$label_decode_error = base64_decode($language_label_arr['error_labels']);
			$label_decode_extra = base64_decode($language_label_arr['extra_labels']);
			$label_decode_front_form_error = base64_decode($language_label_arr['front_error_labels']);

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
				if($key != "your_cart_items" || $key != "your_cart_is_empty"){
					$label_decode_admin_unserial[$key] = urldecode($value);
				}
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
			/* Add all labels which you want to add in new version from here */
			if($language_name == "de_DE"){
				$label_decode_admin_unserial["cart_items"] = urlencode("Winkelwagen Items");
				$label_decode_admin_unserial["cart_is_empty"] = urlencode("Winkelwagen is leeg");
				$label_decode_admin_unserial["rating_and_review"] = urlencode("Beoordeling en beoordeling");
				$label_decode_admin_unserial["review"] = urlencode("beoordeling");
				$label_decode_admin_unserial["show_frontend_staff_rating"] = urlencode("Toon personeelsleden van Frontend");
				$label_decode_admin_unserial["with_enable_of_this_feature_shows_staff_rating_on_front_side"] = urlencode("Met de functie Inschakelen van deze functie, wordt de personeelsclassificatie op de voorkant getoond");
				$label_decode_admin_unserial["complete_appointment"] = urlencode("Afspraak maken");
				$label_decode_admin_unserial["complete"] = urlencode("Compleet");
				
				$label_decode_error_unserial["appointment_booking_completed"] = urlencode("Afspraak boeking voltooid");
			}elseif($language_name == "es_ES"){
				$label_decode_admin_unserial["cart_items"] = urlencode("Artículos del carrito");
				$label_decode_admin_unserial["cart_is_empty"] = urlencode("El carrito esta vacío");
				$label_decode_admin_unserial["rating_and_review"] = urlencode("Calificación y revisión");
				$label_decode_admin_unserial["review"] = urlencode("Revisión");
				$label_decode_admin_unserial["show_frontend_staff_rating"] = urlencode("Mostrar Clasificación de Personal de Frontend");
				$label_decode_admin_unserial["with_enable_of_this_feature_shows_staff_rating_on_front_side"] = urlencode("Con la habilitación de esta función, muestra la calificación del personal en la parte frontal");
				$label_decode_admin_unserial["complete_appointment"] = urlencode("Cita completa");
				$label_decode_admin_unserial["complete"] = urlencode("Completar");
				
				$label_decode_error_unserial["appointment_booking_completed"] = urlencode("Reserva de cita completada");
			}elseif($language_name == "fr_FR"){
				$label_decode_admin_unserial["cart_items"] = urlencode("Articles du panier");
				$label_decode_admin_unserial["cart_is_empty"] = urlencode("Le panier est vide");
				$label_decode_admin_unserial["rating_and_review"] = urlencode("Notation et révision");
				$label_decode_admin_unserial["review"] = urlencode("La revue");
				$label_decode_admin_unserial["show_frontend_staff_rating"] = urlencode("Afficher les notes du personnel");
				$label_decode_admin_unserial["with_enable_of_this_feature_shows_staff_rating_on_front_side"] = urlencode("Avec l’activation de cette fonctionnalité, affiche l’évaluation du personnel sur le recto");
				$label_decode_admin_unserial["complete_appointment"] = urlencode("Rendez-vous complet");
				$label_decode_admin_unserial["complete"] = urlencode("Achevée");
				
				$label_decode_error_unserial["appointment_booking_completed"] = urlencode("Rendez-vous terminé");
			}elseif($language_name == "pt_PT"){
				$label_decode_admin_unserial["cart_items"] = urlencode("Itens do carrinho");
				$label_decode_admin_unserial["cart_is_empty"] = urlencode("carrinho esta vazio");
				$label_decode_admin_unserial["rating_and_review"] = urlencode("Avaliação e Revisão");
				$label_decode_admin_unserial["review"] = urlencode("Reveja");
				$label_decode_admin_unserial["show_frontend_staff_rating"] = urlencode("Mostrar Classificação do Pessoal Frontend");
				$label_decode_admin_unserial["with_enable_of_this_feature_shows_staff_rating_on_front_side"] = urlencode("Com a opção Habilitar este recurso, mostra a classificação da equipe na frente");
				$label_decode_admin_unserial["complete_appointment"] = urlencode("Compromisso completo");
				$label_decode_admin_unserial["complete"] = urlencode("Completo");
				
				$label_decode_error_unserial["appointment_booking_completed"] = urlencode("Marcação de compromisso concluída");
			}elseif($language_name == "ru_RU"){
				$label_decode_admin_unserial["cart_items"] = urlencode("Элементы корзины");
				$label_decode_admin_unserial["cart_is_empty"] = urlencode("Корзина пуста");
				$label_decode_admin_unserial["rating_and_review"] = urlencode("Рейтинг и обзор");
				$label_decode_admin_unserial["review"] = urlencode("обзор");
				$label_decode_admin_unserial["show_frontend_staff_rating"] = urlencode("Показать рейтинг персонала Frontend");
				$label_decode_admin_unserial["with_enable_of_this_feature_shows_staff_rating_on_front_side"] = urlencode("Включить эту функцию, Показывает рейтинг персонала на лицевой стороне");
				$label_decode_admin_unserial["complete_appointment"] = urlencode("Полное назначение");
				$label_decode_admin_unserial["complete"] = urlencode("полный");
				
				$label_decode_error_unserial["appointment_booking_completed"] = urlencode("Запланировано бронирование");
			}elseif($language_name == "ar"){
				$label_decode_admin_unserial["cart_items"] = urlencode("عناصر السلة");
				$label_decode_admin_unserial["cart_is_empty"] = urlencode("السلة فارغة");
				$label_decode_admin_unserial["rating_and_review"] = urlencode("التقييم والمراجعة");
				$label_decode_admin_unserial["review"] = urlencode("إعادة النظر");
				$label_decode_admin_unserial["show_frontend_staff_rating"] = urlencode("إظهار تصنيف الموظفين المواجهين");
				$label_decode_admin_unserial["with_enable_of_this_feature_shows_staff_rating_on_front_side"] = urlencode("مع تمكين هذه الميزة ، يعرض تصنيف الموظفين على الجانب الأمامي");
				$label_decode_admin_unserial["complete_appointment"] = urlencode("الموعد الكامل");
				$label_decode_admin_unserial["complete"] = urlencode("اكتمال");
				
				$label_decode_error_unserial["appointment_booking_completed"] = urlencode("اكتمال حجز موعد");
			}elseif($language_name == "zh_CN"){
				$label_decode_admin_unserial["cart_items"] = urlencode("购物车项目");
				$label_decode_admin_unserial["cart_is_empty"] = urlencode("购物车是空的");
				$label_decode_admin_unserial["rating_and_review"] = urlencode("评级和评论");
				$label_decode_admin_unserial["review"] = urlencode("评论");
				$label_decode_admin_unserial["show_frontend_staff_rating"] = urlencode("显示前端员工评级");
				$label_decode_admin_unserial["with_enable_of_this_feature_shows_staff_rating_on_front_side"] = urlencode("启用此功能后，在正面显示员工评级");
				$label_decode_admin_unserial["complete_appointment"] = urlencode("完成任命");
				$label_decode_admin_unserial["complete"] = urlencode("完成");
				
				$label_decode_error_unserial["appointment_booking_completed"] = urlencode("预约完成预约");
			}else{
				$label_decode_admin_unserial["cart_items"] = urlencode("Cart Items");
				$label_decode_admin_unserial["cart_is_empty"] = urlencode("Cart is empty");
				$label_decode_admin_unserial["rating_and_review"] = urlencode("Rating & Review");
				$label_decode_admin_unserial["review"] = urlencode("Review");
				$label_decode_admin_unserial["show_frontend_staff_rating"] = urlencode("Show Frontend Staff Rating");
				$label_decode_admin_unserial["with_enable_of_this_feature_shows_staff_rating_on_front_side"] = urlencode("With Enable of this feature, Shows staff rating on front side");
				$label_decode_admin_unserial["complete_appointment"] = urlencode("Complete Appointment");
				$label_decode_admin_unserial["complete"] = urlencode("Complete");
				
				$label_decode_error_unserial["appointment_booking_completed"] = urlencode("Appointment booking completed");
			}

			$language_front_arr = base64_encode(serialize($label_decode_front_unserial));
			$language_admin_arr = base64_encode(serialize($label_decode_admin_unserial));
			$language_error_arr = base64_encode(serialize($label_decode_error_unserial));
			$language_extra_arr = base64_encode(serialize($label_decode_extra_unserial));
			$language_form_error_arr = base64_encode(serialize($label_decode_front_form_error_unserial));

			$update_default_lang = "UPDATE `ct_languages` set `label_data` = '".$language_front_arr."', `admin_labels` = '".$language_admin_arr."', `error_labels` = '".$language_error_arr."', `extra_labels` = '".$language_extra_arr."', `front_error_labels` = '".$language_form_error_arr."' where `language` = '".$all['language']."'";
			mysqli_query($this->conn, $update_default_lang);
		}
	}
	
	public function update5_0()
	{
	  $this->insert_option('ct_show_time_duration','N');
		
		$q1s = "ALTER TABLE `ct_service_methods_units` ADD `unit_symbol` VARCHAR(50) NOT NULL AFTER `limit_title`";
		mysqli_query($this->conn, $q1s);
		
		$q1s = "ALTER TABLE `ct_services_addon` ADD `aduration` INT(5) NOT NULL DEFAULT '0'";
		mysqli_query($this->conn, $q1s);
		
		$q1s = "ALTER TABLE `ct_service_methods_units` ADD `uduration` INT(5) NOT NULL DEFAULT '0'";
		mysqli_query($this->conn, $q1s);
		
		$q1s = "ALTER TABLE `ct_order_client_info` ADD `order_duration` BIGINT(10) NOT NULL DEFAULT '0'";
		mysqli_query($this->conn, $q1s);
		
		$q1s = "ALTER TABLE `ct_languages` CHANGE `language` `language` VARCHAR(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL";
		mysqli_query($this->conn, $q1s);
		
		$alllang = $this->get_all_languages();

		while($all = mysqli_fetch_assoc($alllang))
		{
			$language_name = $all['language'];
			$language_label_arr = $this->get_all_labelsbyid($all['language']);

			$label_decode_front = base64_decode($language_label_arr['label_data']);
			$label_decode_admin = base64_decode($language_label_arr['admin_labels']);
			$label_decode_error = base64_decode($language_label_arr['error_labels']);
			$label_decode_extra = base64_decode($language_label_arr['extra_labels']);
			$label_decode_front_form_error = base64_decode($language_label_arr['front_error_labels']);

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
			/* Add all labels which you want to add in new version from here */
			if($language_name == "de_DE"){
				$label_decode_front_unserial["duration"] = urlencode("Looptijd");
				
				$label_decode_admin_unserial["display_time_duration_on_summary"] = urlencode("Weergaveduur Duur op samenvatting");
				$label_decode_admin_unserial["reason"] = urlencode("Reden");
				$label_decode_admin_unserial["optional_label"] = urlencode("Optioneel label");
				$label_decode_admin_unserial["optional_unit_symbol"] = urlencode("Optioneel eenheidsymbool");
				$label_decode_admin_unserial["sqft"] = urlencode("sq. ft.");
				
				$label_decode_error_unserial["please_enter_hours"] = urlencode("Voer uren in");
				$label_decode_error_unserial["please_enter_minutes"] = urlencode("Voer alstublieft minuten in");
				$label_decode_error_unserial["please_enter_minimum_5_minutes_maximum_59_minutes"] = urlencode("Voer minimaal 5 minuten en maximaal 59 minuten in");
				$label_decode_error_unserial["invalid"] = urlencode("Ongeldig");
				$label_decode_error_unserial["max_limit_reached"] = urlencode("Max. Limiet bereikt");
			}elseif($language_name == "es_ES"){
				$label_decode_front_unserial["duration"] = urlencode("Duración");
				
				$label_decode_admin_unserial["display_time_duration_on_summary"] = urlencode("Mostrar la duración del tiempo en el resumen");
				$label_decode_admin_unserial["reason"] = urlencode("Razón");
				$label_decode_admin_unserial["optional_label"] = urlencode("Etiqueta opcional");
				$label_decode_admin_unserial["optional_unit_symbol"] = urlencode("Símbolo de unidad opcional");
				$label_decode_admin_unserial["sqft"] = urlencode("pies cuadrados");
				
				$label_decode_error_unserial["please_enter_hours"] = urlencode("Por favor ingrese las horas");
				$label_decode_error_unserial["please_enter_minutes"] = urlencode("Por favor ingrese los minutos");
				$label_decode_error_unserial["please_enter_minimum_5_minutes_maximum_59_minutes"] = urlencode("Por favor ingrese un mínimo de 5 minutos Máximo de 59 minutos");
				$label_decode_error_unserial["invalid"] = urlencode("Inválido");
				$label_decode_error_unserial["max_limit_reached"] = urlencode("Límite máximo alcanzado");
			}elseif($language_name == "fr_FR"){
				$label_decode_front_unserial["duration"] = urlencode("Durée");
				
				$label_decode_admin_unserial["display_time_duration_on_summary"] = urlencode("Durée d'affichage sur le résumé");
				$label_decode_admin_unserial["reason"] = urlencode("Raison");
				$label_decode_admin_unserial["optional_label"] = urlencode("Étiquette facultative");
				$label_decode_admin_unserial["optional_unit_symbol"] = urlencode("Symbole d'unité en option");
				$label_decode_admin_unserial["sqft"] = urlencode("pi2");
				
				$label_decode_error_unserial["please_enter_hours"] = urlencode("S'il vous plaît entrer les heures");
				$label_decode_error_unserial["please_enter_minutes"] = urlencode("Veuillez entrer les minutes");
				$label_decode_error_unserial["please_enter_minimum_5_minutes_maximum_59_minutes"] = urlencode("S'il vous plaît entrer minimum 5 minutes maximum 59 minutes");
				$label_decode_error_unserial["invalid"] = urlencode("Invalide");
				$label_decode_error_unserial["max_limit_reached"] = urlencode("Limite maximale atteinte");
			}elseif($language_name == "pt_PT"){
				$label_decode_front_unserial["duration"] = urlencode("Duração");
				
				$label_decode_admin_unserial["display_time_duration_on_summary"] = urlencode("Duração do tempo de exibição no resumo");
				$label_decode_admin_unserial["reason"] = urlencode("Razão");
				$label_decode_admin_unserial["optional_label"] = urlencode("Rótulo Opcional");
				$label_decode_admin_unserial["optional_unit_symbol"] = urlencode("Símbolo opcional da unidade");
				$label_decode_admin_unserial["sqft"] = urlencode("pés quadrados");
				
				$label_decode_error_unserial["please_enter_hours"] = urlencode("Por favor, insira horas");
				$label_decode_error_unserial["please_enter_minutes"] = urlencode("Por favor, digite minutos");
				$label_decode_error_unserial["please_enter_minimum_5_minutes_maximum_59_minutes"] = urlencode("Por favor, insira o mínimo de 5 minutos no máximo 59 minutos");
				$label_decode_error_unserial["invalid"] = urlencode("Inválido");
				$label_decode_error_unserial["max_limit_reached"] = urlencode("Limite Máximo Alcançado");
			}elseif($language_name == "ru_RU"){
				$label_decode_front_unserial["duration"] = urlencode("продолжительность");
				
				$label_decode_admin_unserial["display_time_duration_on_summary"] = urlencode("Отображение продолжительности времени в сводке");
				$label_decode_admin_unserial["reason"] = urlencode("причина");
				$label_decode_admin_unserial["optional_label"] = urlencode("Дополнительный ярлык");
				$label_decode_admin_unserial["optional_unit_symbol"] = urlencode("Дополнительный символ");
				$label_decode_admin_unserial["sqft"] = urlencode("кв. футы");
				
				$label_decode_error_unserial["please_enter_hours"] = urlencode("Пожалуйста, введите часы");
				$label_decode_error_unserial["please_enter_minutes"] = urlencode("Введите минуты");
				$label_decode_error_unserial["please_enter_minimum_5_minutes_maximum_59_minutes"] = urlencode("Пожалуйста, введите минимум 5 минут максимум 59 минут");
				$label_decode_error_unserial["invalid"] = urlencode("Недействительным");
				$label_decode_error_unserial["max_limit_reached"] = urlencode("Максимальный предел достигнут");
			}elseif($language_name == "ar"){
				$label_decode_front_unserial["duration"] = urlencode("المدة الزمنية");
				
				$label_decode_admin_unserial["display_time_duration_on_summary"] = urlencode("مدة العرض في الملخص");
				$label_decode_admin_unserial["reason"] = urlencode("السبب");
				$label_decode_admin_unserial["optional_label"] = urlencode("تسمية اختيارية");
				$label_decode_admin_unserial["optional_unit_symbol"] = urlencode("رمز الوحدة الاختياري");
				$label_decode_admin_unserial["sqft"] = urlencode("قدم مربع.");
				
				$label_decode_error_unserial["please_enter_hours"] = urlencode("يرجى إدخال ساعات");
				$label_decode_error_unserial["please_enter_minutes"] = urlencode("يرجى إدخال دقائق");
				$label_decode_error_unserial["please_enter_minimum_5_minutes_maximum_59_minutes"] = urlencode("الرجاء إدخال الحد الأدنى لمدة 5 دقائق كحد أقصى 59 دقيقة");
				$label_decode_error_unserial["invalid"] = urlencode("غير صالحة");
				$label_decode_error_unserial["max_limit_reached"] = urlencode("أقصى حد تم الوصول إليه");
			}elseif($language_name == "zh_CN"){
				$label_decode_front_unserial["duration"] = urlencode("持续时间");
				
				$label_decode_admin_unserial["display_time_duration_on_summary"] = urlencode("显示汇总时间");
				$label_decode_admin_unserial["reason"] = urlencode("原因");
				$label_decode_admin_unserial["optional_label"] = urlencode("可选标签");
				$label_decode_admin_unserial["optional_unit_symbol"] = urlencode("可选单位符号");
				$label_decode_admin_unserial["sqft"] = urlencode("平方英尺");
				
				$label_decode_error_unserial["please_enter_hours"] = urlencode("请输入营业时间");
				$label_decode_error_unserial["please_enter_minutes"] = urlencode("请输入分钟");
				$label_decode_error_unserial["please_enter_minimum_5_minutes_maximum_59_minutes"] = urlencode("请输入最少5分钟最多59分钟");
				$label_decode_error_unserial["invalid"] = urlencode("无效");
				$label_decode_error_unserial["max_limit_reached"] = urlencode("达到最大限度");
			}else{
				$label_decode_front_unserial["duration"] = urlencode("Duration");
				
				$label_decode_admin_unserial["display_time_duration_on_summary"] = urlencode("Display Time Duration on Summary");
				$label_decode_admin_unserial["reason"] = urlencode("Reason");
				$label_decode_admin_unserial["optional_label"] = urlencode("Optional Label");
				$label_decode_admin_unserial["optional_unit_symbol"] = urlencode("Optional Unit Symbol");
				$label_decode_admin_unserial["sqft"] = urlencode("sq. ft.");
				
				$label_decode_error_unserial["please_enter_hours"] = urlencode("Please Enter Hours");
				$label_decode_error_unserial["please_enter_minutes"] = urlencode("Please Enter Minutes");
				$label_decode_error_unserial["please_enter_minimum_5_minutes_maximum_59_minutes"] = urlencode("Please Enter Minimum 5 Minutes Maximum 59 Minutes");
				$label_decode_error_unserial["invalid"] = urlencode("Invalid");
				$label_decode_error_unserial["max_limit_reached"] = urlencode("Max Limit Reached");
			}

			$language_front_arr = base64_encode(serialize($label_decode_front_unserial));
			$language_admin_arr = base64_encode(serialize($label_decode_admin_unserial));
			$language_error_arr = base64_encode(serialize($label_decode_error_unserial));
			$language_extra_arr = base64_encode(serialize($label_decode_extra_unserial));
			$language_form_error_arr = base64_encode(serialize($label_decode_front_form_error_unserial));

			$update_default_lang = "UPDATE `ct_languages` set `label_data` = '".$language_front_arr."', `admin_labels` = '".$language_admin_arr."', `error_labels` = '".$language_error_arr."', `extra_labels` = '".$language_extra_arr."', `front_error_labels` = '".$language_form_error_arr."' where `language` = '".$all['language']."'";
			mysqli_query($this->conn, $update_default_lang);
		}
	}
	
	public function update5_2(){
	  $this->insert_option('ct_api_key','1');
		
		$query = "ALTER TABLE `ct_service_methods_units` ADD `minlimit` INT(11) NOT NULL DEFAULT '1' AFTER `base_price`;";
		mysqli_query($this->conn, $query);
	
		$query = "CREATE TABLE IF NOT EXISTS `ct_otp` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
                `email` varchar(50) NOT NULL,
                `otp` bigint(11) NOT NULL,
                `status` enum('NV','V') COLLATE utf8_unicode_ci NOT NULL,
                PRIMARY KEY (`id`)
		) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
			  
		mysqli_query($this->conn, $query);
		
		$alllang = $this->get_all_languages();
		
		$language_label_arr_check = $this->get_all_labelsbyid("en");
		$en_label_decode_front = $language_label_arr_check["label_data"];
		$en_label_decode_admin = $language_label_arr_check["admin_labels"];
		$en_label_decode_error = $language_label_arr_check["error_labels"];
		$en_label_decode_extra = $language_label_arr_check["extra_labels"];
		$en_label_decode_front_form_error = $language_label_arr_check["front_error_labels"];

		while($all = mysqli_fetch_assoc($alllang)){   
			$language_name = $all['language'];
			$language_label_arr = $this->get_all_labelsbyid($all['language']);
			
			$label_data = $language_label_arr['label_data'];
			$admin_labels = $language_label_arr['admin_labels'];
			$error_labels = $language_label_arr['error_labels'];
			$extra_labels = $language_label_arr['extra_labels'];
			$front_error_labels = $language_label_arr['front_error_labels'];
			
			if($label_data == ""){
				$label_data = $en_label_decode_front;
			}if($admin_labels == ""){
				$admin_labels = $en_label_decode_admin;
			}if($error_labels == ""){
				$error_labels = $en_label_decode_error;
			}if($extra_labels == ""){
				$extra_labels = $en_label_decode_extra;
			}if($front_error_labels == ""){
				$front_error_labels = $en_label_decode_front_form_error;
			}
			
			$label_decode_front = base64_decode($label_data);
			$label_decode_admin = base64_decode($admin_labels);
			$label_decode_error = base64_decode($error_labels);
			$label_decode_extra = base64_decode($extra_labels);
			$label_decode_front_form_error = base64_decode($front_error_labels);
			
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
						
			/* Add all labels which you want to add in new version from here */
			/* DEMO FOR ADDING LABEL */
			if($language_name == "de_DE"){
				if(!array_key_exists("invalid",$label_decode_error_unserial)){
					$label_decode_error_unserial["invalid"]=urlencode("Ongeldig");
					$label_decode_error_unserial["max_limit_reached"]=urlencode("Max. Limiet bereikt");
					$label_decode_admin_unserial["sqft"] = urlencode("sq. ft.");
				}
				
				$label_decode_admin_unserial["min_limit"] = urlencode("Mijn limiet");
				
				$label_decode_error_unserial["please_enter_minlimit"]=urlencode("Voer alstublieft Minlimit in");
				$label_decode_error_unserial["please_enter_value_greater_than_minlimit"]=urlencode("Voer een waarde in die groter is dan minimiet");
				$label_decode_error_unserial["you_can_set_area_of_cleaning_minimum_limit_"]=urlencode("U kunt de minimale minimumlimiet voor reiniging instellen ");
			}elseif($language_name == "es_ES"){
				if(!array_key_exists("invalid",$label_decode_error_unserial)){
					$label_decode_error_unserial["invalid"]=urlencode("Inválido");
					$label_decode_error_unserial["max_limit_reached"]=urlencode("Límite máximo alcanzado");
					$label_decode_admin_unserial["sqft"] = urlencode("pies cuadrados");
				}
				
				$label_decode_admin_unserial["min_limit"] = urlencode("Mi limite");
				
				$label_decode_error_unserial["please_enter_minlimit"]=urlencode("Por favor ingrese minlimit");
				$label_decode_error_unserial["please_enter_value_greater_than_minlimit"]=urlencode("Por favor ingrese un valor mayor que minlimit");
				$label_decode_error_unserial["you_can_set_area_of_cleaning_minimum_limit_"]=urlencode("Puede configurar el área de limpieza límite mínimo ");
			}elseif($language_name == "fr_FR"){
				if(!array_key_exists("invalid",$label_decode_error_unserial)){
					$label_decode_error_unserial["invalid"]=urlencode("Invalide");
					$label_decode_error_unserial["max_limit_reached"]=urlencode("Limite maximale atteinte");
					$label_decode_admin_unserial["sqft"] = urlencode("pi2");
				}
				
				$label_decode_admin_unserial["min_limit"] = urlencode("Ma limite");
				
				$label_decode_error_unserial["please_enter_minlimit"]=urlencode("S'il vous plaît entrer minlimit");
				$label_decode_error_unserial["please_enter_value_greater_than_minlimit"]=urlencode("Veuillez entrer une valeur supérieure à minlimit");
				$label_decode_error_unserial["you_can_set_area_of_cleaning_minimum_limit_"]=urlencode("Vous pouvez définir une zone de nettoyage minimum limite ");
			}elseif($language_name == "pt_PT"){
				if(!array_key_exists("invalid",$label_decode_error_unserial)){
					$label_decode_error_unserial["invalid"]=urlencode("Inválido");
					$label_decode_error_unserial["max_limit_reached"]=urlencode("Limite Máximo Alcançado");
					$label_decode_admin_unserial["sqft"] = urlencode("pés quadrados");
				}
				
				$label_decode_admin_unserial["min_limit"] = urlencode("Meu limite");
				
				$label_decode_error_unserial["please_enter_minlimit"]=urlencode("Por favor insira minlimit");
				$label_decode_error_unserial["please_enter_value_greater_than_minlimit"]=urlencode("Por favor insira um valor maior que minlimit");
				$label_decode_error_unserial["you_can_set_area_of_cleaning_minimum_limit_"]=urlencode("Você pode definir a área de limpeza do limite mínimo ");
			}elseif($language_name == "ru_RU"){
				if(!array_key_exists("invalid",$label_decode_error_unserial)){
					$label_decode_error_unserial["invalid"]=urlencode("Недействительным");
					$label_decode_error_unserial["max_limit_reached"]=urlencode("Максимальный предел достигнут");
					$label_decode_admin_unserial["sqft"] = urlencode("кв. футы");
				}
				
				$label_decode_admin_unserial["min_limit"] = urlencode("Мой предел");
				
				$label_decode_error_unserial["please_enter_minlimit"]=urlencode("Пожалуйста, введите minlimit");
				$label_decode_error_unserial["please_enter_value_greater_than_minlimit"]=urlencode("Пожалуйста, введите значение больше, чем minlimit");
				$label_decode_error_unserial["you_can_set_area_of_cleaning_minimum_limit_"]=urlencode("Вы можете установить область очистки минимального предела ");
			}elseif($language_name == "ar"){
				if(!array_key_exists("invalid",$label_decode_error_unserial)){
					$label_decode_error_unserial["invalid"]=urlencode("غير صالحة");
					$label_decode_error_unserial["max_limit_reached"]=urlencode("أقصى حد تم الوصول إليه");
					$label_decode_admin_unserial["sqft"] = urlencode("قدم مربع.");
				}
				
				$label_decode_admin_unserial["min_limit"] = urlencode("الحد الخاص بي");
				
				$label_decode_error_unserial["please_enter_minlimit"]=urlencode("الرجاء إدخال الحد الأدنى");
				$label_decode_error_unserial["please_enter_value_greater_than_minlimit"]=urlencode("الرجاء إدخال قيمة أكبر من الحد الأدنى");
				$label_decode_error_unserial["you_can_set_area_of_cleaning_minimum_limit_"]=urlencode(" يمكنك تعيين مساحة الحد الأدنى للتنظيف");
			}elseif($language_name == "zh_CN"){
				if(!array_key_exists("invalid",$label_decode_error_unserial)){
					$label_decode_error_unserial["invalid"]=urlencode("无效");
					$label_decode_error_unserial["max_limit_reached"]=urlencode("达到最大限度");
					$label_decode_admin_unserial["sqft"] = urlencode("平方英尺");
				}
				
				$label_decode_admin_unserial["min_limit"] = urlencode("我的极限");
				
				$label_decode_error_unserial["please_enter_minlimit"]=urlencode("请输入最低限额");
				$label_decode_error_unserial["please_enter_value_greater_than_minlimit"]=urlencode("请输入大于最小限度的值");
				$label_decode_error_unserial["you_can_set_area_of_cleaning_minimum_limit_"]=urlencode("您可以设置清洁最低限度区域");
			}else{
				if(!array_key_exists("invalid",$label_decode_error_unserial)){
					$label_decode_error_unserial["invalid"]=urlencode("Invalid");
					$label_decode_error_unserial["max_limit_reached"]=urlencode("Max Limit Reached");
					$label_decode_admin_unserial["sqft"] = urlencode("sq. ft.");
				}
				
				$label_decode_admin_unserial["min_limit"] = urlencode("Min Limit");
				
				$label_decode_error_unserial["please_enter_minlimit"]=urlencode("Please Enter Minlimit");
				$label_decode_error_unserial["please_enter_value_greater_than_minlimit"]=urlencode("Please Enter Value Greater Than Minlimit");
				$label_decode_error_unserial["you_can_set_area_of_cleaning_minimum_limit_"]=urlencode("You Can Set Area of Cleaning Minimum Limit ");
			}
			
			$language_front_arr = base64_encode(serialize($label_decode_front_unserial));
			$language_admin_arr = base64_encode(serialize($label_decode_admin_unserial));
			$language_error_arr = base64_encode(serialize($label_decode_error_unserial));
			$language_extra_arr = base64_encode(serialize($label_decode_extra_unserial));
			$language_form_error_arr = base64_encode(serialize($label_decode_front_form_error_unserial));
			
			$update_default_lang = "UPDATE `ct_languages` set `label_data` = '".$language_front_arr."', `admin_labels` = '".$language_admin_arr."', `error_labels` = '".$language_error_arr."', `extra_labels` = '".$language_extra_arr."', `front_error_labels` = '".$language_form_error_arr."' where `language` = '".$all['language']."'";
			mysqli_query($this->conn, $update_default_lang);
		}
	}
	
	public function update6_0(){
		$this->insert_option('ct_stripe_create_plan','N');
		
		$query = "ALTER TABLE `ct_frequently_discount` ADD `days` INT(5) NOT NULL DEFAULT '0' AFTER `discount_typename`;";
		mysqli_query($this->conn, $query);
		
		$query = "ALTER TABLE `ct_frequently_discount` ADD `booking_count` INT(5) NOT NULL DEFAULT '0' AFTER `labels`, ADD `stripe_plan_id` VARCHAR(30) NULL AFTER `booking_count`;";
		mysqli_query($this->conn, $query);
		
		$query="update `ct_frequently_discount` set `days`='0',`booking_count`='0' where `id`='1'";
		mysqli_query($this->conn,$query);
		
		$query="update `ct_frequently_discount` set `days`='7',`booking_count`='14' where `id`='2'";
		mysqli_query($this->conn,$query);
		
		$query="update `ct_frequently_discount` set `days`='3',`booking_count`='31' where `id`='3'";
		mysqli_query($this->conn,$query);
		
		$query="update `ct_frequently_discount` set `days`='30',`booking_count`='4' where `id`='4'";
		mysqli_query($this->conn,$query);
		
		$query = "ALTER TABLE `ct_order_client_info` ADD `recurring_id` BIGINT(11) NOT NULL DEFAULT '0' AFTER `order_duration`;";
		mysqli_query($this->conn, $query);
		
		$query = "select * from `ct_order_client_info`";
		$result = mysqli_query($this->conn, $query);
		$count = 0;
		while($row = mysqli_fetch_assoc($result)){
			$order_id = $row["order_id"];
			$qq="update `ct_order_client_info` set `recurring_id`='".$count."' where `order_id`='".$order_id."'";
			mysqli_query($this->conn,$qq);
			$count++;
		}
		
		$query = "ALTER TABLE `ct_payments` CHANGE `frequently_discount` `frequently_discount` VARCHAR(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;";
		mysqli_query($this->conn, $query);
		
		$query = "select * from `ct_payments`";
		$result = mysqli_query($this->conn, $query);
		while($row = mysqli_fetch_assoc($result)){
			$order_id = $row["order_id"];
			$frequently_discount = $row["frequently_discount"];
			$frequently_discount_id = 1;
			if($frequently_discount == "O"){
				$frequently_discount_id = 1;
			}elseif($frequently_discount == "W"){
				$frequently_discount_id = 2;
			}elseif($frequently_discount == "B"){
				$frequently_discount_id = 3;
			}elseif($frequently_discount == "M"){
				$frequently_discount_id = 4;
			}
			$qq="update `ct_payments` set `frequently_discount`='".$frequently_discount_id."' where `order_id`='".$order_id."'";
			mysqli_query($this->conn,$qq);
		}
		
		$query = "ALTER TABLE `ct_payments` CHANGE `frequently_discount` `frequently_discount` BIGINT(11) NOT NULL DEFAULT '0';";
		mysqli_query($this->conn, $query);
		
		$query = "ALTER TABLE `ct_users` ADD `stripe_id` VARCHAR(30) NULL AFTER `cus_dt`;";
		mysqli_query($this->conn, $query);
		
		$query = "CREATE TABLE IF NOT EXISTS `ct_recurring_status` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`recurring_id` int(11) NOT NULL,
			`status` enum('P','A','D') NOT NULL,
			PRIMARY KEY (`id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
	
		mysqli_query($this->conn, $query);
		
		$alllang = $this->get_all_languages();
		
		$language_label_arr_check = $this->get_all_labelsbyid("en");
		$en_label_decode_front = $language_label_arr_check["label_data"];
		$en_label_decode_admin = $language_label_arr_check["admin_labels"];
		$en_label_decode_error = $language_label_arr_check["error_labels"];
		$en_label_decode_extra = $language_label_arr_check["extra_labels"];
		$en_label_decode_front_form_error = $language_label_arr_check["front_error_labels"];

		while($all = mysqli_fetch_assoc($alllang)){   
			$language_name = $all['language'];
			$language_label_arr = $this->get_all_labelsbyid($all['language']);
			
			$label_data = $language_label_arr['label_data'];
			$admin_labels = $language_label_arr['admin_labels'];
			$error_labels = $language_label_arr['error_labels'];
			$extra_labels = $language_label_arr['extra_labels'];
			$front_error_labels = $language_label_arr['front_error_labels'];
			
			if($label_data == ""){
				$label_data = $en_label_decode_front;
			}if($admin_labels == ""){
				$admin_labels = $en_label_decode_admin;
			}if($error_labels == ""){
				$error_labels = $en_label_decode_error;
			}if($extra_labels == ""){
				$extra_labels = $en_label_decode_extra;
			}if($front_error_labels == ""){
				$front_error_labels = $en_label_decode_front_form_error;
			}
			
			$label_decode_front = base64_decode($label_data);
			$label_decode_admin = base64_decode($admin_labels);
			$label_decode_error = base64_decode($error_labels);
			$label_decode_extra = base64_decode($extra_labels);
			$label_decode_front_form_error = base64_decode($front_error_labels);
			
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
			/* Add all labels which you want to add in new version from here */
			/* DEMO FOR ADDING LABEL */
			if($language_name == "de_DE"){
				$label_decode_front_unserial["on"] = urlencode("Op");
				
				$label_decode_admin_unserial["plans_on_stripe"] = urlencode("Wilt u plannen op streep maken?");
				$label_decode_admin_unserial["add_recurrence"] = urlencode("Herhaling toevoegen");
				$label_decode_admin_unserial["recurrence_name"] = urlencode("Herhalingsnaam");
				$label_decode_admin_unserial["recurrence_label"] = urlencode("Herhalingslabel");
				$label_decode_admin_unserial["recurrence_days"] = urlencode("Herhalingsdagen");
				$label_decode_admin_unserial["recurrence_discount_type"] = urlencode("Recurrence Discount Type");
				$label_decode_admin_unserial["recurrence_discount_value"] = urlencode("Herhaling kortingswaarde");
				$label_decode_admin_unserial["delete_this_recurrence"] = urlencode("Deze herhaling verwijderen?");
				
				$label_decode_admin_unserial["recurrence_details"] = urlencode("Herhalingsdetails");
				$label_decode_admin_unserial["recurrence_plan_details"] = urlencode("Terugkeerplan details");
				$label_decode_admin_unserial["recurrence_type"] = urlencode("Type herhaling");
				$label_decode_admin_unserial["cancel_recurrence"] = urlencode("Terugkeer annuleren?");
				
				$label_decode_error_unserial["please_enter_maximum_2_digits"] = urlencode("Voer alstublieft maximaal 2 cijfers in");
			}elseif($language_name == "es_ES"){
				$label_decode_front_unserial["on"] = urlencode("En");
				
				$label_decode_admin_unserial["plans_on_stripe"] = urlencode("¿Quieres crear planos en raya?");
				$label_decode_admin_unserial["add_recurrence"] = urlencode("Añadir Recurrencia");
				$label_decode_admin_unserial["recurrence_name"] = urlencode("Nombre de recurrencia");
				$label_decode_admin_unserial["recurrence_label"] = urlencode("Etiqueta de recurrencia");
				$label_decode_admin_unserial["recurrence_days"] = urlencode("Días de recurrencia");
				$label_decode_admin_unserial["recurrence_discount_type"] = urlencode("Tipo de descuento por recurrencia");
				$label_decode_admin_unserial["recurrence_discount_value"] = urlencode("Valor de descuento por recurrencia");
				$label_decode_admin_unserial["delete_this_recurrence"] = urlencode("¿Eliminar esta repetición?");
				
				$label_decode_admin_unserial["recurrence_details"] = urlencode("Detalles de recurrencia");
				$label_decode_admin_unserial["recurrence_plan_details"] = urlencode("Detalles del Plan de Recurrencia");
				$label_decode_admin_unserial["recurrence_type"] = urlencode("Tipo de recurrencia");
				$label_decode_admin_unserial["cancel_recurrence"] = urlencode("¿Cancelar recurrencia?");
				
				$label_decode_error_unserial["please_enter_maximum_2_digits"] = urlencode("Por favor ingrese un máximo de 2 dígitos");
			}elseif($language_name == "fr_FR"){
				$label_decode_front_unserial["on"] = urlencode("Sur");
				
				$label_decode_admin_unserial["plans_on_stripe"] = urlencode("Voulez-vous créer des plans sur bande?");
				$label_decode_admin_unserial["add_recurrence"] = urlencode("Ajouter une récurrence");
				$label_decode_admin_unserial["recurrence_name"] = urlencode("Nom de récurrence");
				$label_decode_admin_unserial["recurrence_label"] = urlencode("Étiquette de récurrence");
				$label_decode_admin_unserial["recurrence_days"] = urlencode("Jours de récurrence");
				$label_decode_admin_unserial["recurrence_discount_type"] = urlencode("Type d'escompte de récurrence");
				$label_decode_admin_unserial["recurrence_discount_value"] = urlencode("Valeur de remise de récurrence");
				$label_decode_admin_unserial["delete_this_recurrence"] = urlencode("Supprimer cette récurrence?");
				
				$label_decode_admin_unserial["recurrence_details"] = urlencode("Détails de récurrence");
				$label_decode_admin_unserial["recurrence_plan_details"] = urlencode("Détails du plan de récurrence");
				$label_decode_admin_unserial["recurrence_type"] = urlencode("Type de récurrence");
				$label_decode_admin_unserial["cancel_recurrence"] = urlencode("Annuler la récurrence?");
				
				$label_decode_error_unserial["please_enter_maximum_2_digits"] = urlencode("S'il vous plaît entrer maximum 2 chiffres");
			}elseif($language_name == "pt_PT"){
				$label_decode_front_unserial["on"] = urlencode("Em");
				
				$label_decode_admin_unserial["plans_on_stripe"] = urlencode("Você quer criar planos na faixa?");
				$label_decode_admin_unserial["add_recurrence"] = urlencode("Adicionar recorrência");
				$label_decode_admin_unserial["recurrence_name"] = urlencode("Nome da Recorrência");
				$label_decode_admin_unserial["recurrence_label"] = urlencode("Rótulo de Recorrência");
				$label_decode_admin_unserial["recurrence_days"] = urlencode("Dias de Recorrência");
				$label_decode_admin_unserial["recurrence_discount_type"] = urlencode("Tipo de Desconto de Recorrência");
				$label_decode_admin_unserial["recurrence_discount_value"] = urlencode("Valor de Desconto de Recorrência");
				$label_decode_admin_unserial["delete_this_recurrence"] = urlencode("Excluir esta recorrência?");
				
				$label_decode_admin_unserial["recurrence_details"] = urlencode("Detalhes de recorrência");
				$label_decode_admin_unserial["recurrence_plan_details"] = urlencode("Detalhes do plano de recorrência");
				$label_decode_admin_unserial["recurrence_type"] = urlencode("Tipo de recorrência");
				$label_decode_admin_unserial["cancel_recurrence"] = urlencode("Cancelar recorrência?");
				
				$label_decode_error_unserial["please_enter_maximum_2_digits"] = urlencode("Por favor digite no máximo 2 dígitos");
			}elseif($language_name == "ru_RU"){
				$label_decode_front_unserial["on"] = urlencode("На");
				
				$label_decode_admin_unserial["plans_on_stripe"] = urlencode("Хотите создавать планы на полосе?");
				$label_decode_admin_unserial["add_recurrence"] = urlencode("Добавить повторение");
				$label_decode_admin_unserial["recurrence_name"] = urlencode("Название повторения");
				$label_decode_admin_unserial["recurrence_label"] = urlencode("Метка повторения");
				$label_decode_admin_unserial["recurrence_days"] = urlencode("Дни повторения");
				$label_decode_admin_unserial["recurrence_discount_type"] = urlencode("Тип скидки на повторение");
				$label_decode_admin_unserial["recurrence_discount_value"] = urlencode("Периодичность скидки");
				$label_decode_admin_unserial["delete_this_recurrence"] = urlencode("Удалить это повторение?");
				
				$label_decode_admin_unserial["recurrence_details"] = urlencode("Подробности повторения");
				$label_decode_admin_unserial["recurrence_plan_details"] = urlencode("Подробности плана повторения");
				$label_decode_admin_unserial["recurrence_type"] = urlencode("Тип повторения");
				$label_decode_admin_unserial["cancel_recurrence"] = urlencode("Отменить повторение?");
				
				$label_decode_error_unserial["please_enter_maximum_2_digits"] = urlencode("Пожалуйста, введите максимум 2 цифры");
			}elseif($language_name == "ar"){
				$label_decode_front_unserial["on"] = urlencode("على");
				
				$label_decode_admin_unserial["plans_on_stripe"] = urlencode("هل تريد إنشاء خطط على الشريط؟");
				$label_decode_admin_unserial["add_recurrence"] = urlencode("إضافة تكرار");
				$label_decode_admin_unserial["recurrence_name"] = urlencode("تكرار الاسم");
				$label_decode_admin_unserial["recurrence_label"] = urlencode("تكرار التسمية");
				$label_decode_admin_unserial["recurrence_days"] = urlencode("أيام التكرار");
				$label_decode_admin_unserial["recurrence_discount_type"] = urlencode("تكرار نوع الخصم");
				$label_decode_admin_unserial["recurrence_discount_value"] = urlencode("تكرار قيمة الخصم");
				$label_decode_admin_unserial["delete_this_recurrence"] = urlencode("حذف هذا التكرار؟");
				
				$label_decode_admin_unserial["recurrence_details"] = urlencode("تفاصيل التكرار");
				$label_decode_admin_unserial["recurrence_plan_details"] = urlencode("تفاصيل خطة التكرار");
				$label_decode_admin_unserial["recurrence_type"] = urlencode("تكرار نوع");
				$label_decode_admin_unserial["cancel_recurrence"] = urlencode("إلغاء التكرار؟");
				
				$label_decode_error_unserial["please_enter_maximum_2_digits"] = urlencode("الرجاء إدخال 2 رقم كحد أقصى");
			}elseif($language_name == "zh_CN"){
				$label_decode_front_unserial["on"] = urlencode("上");
				
				$label_decode_admin_unserial["plans_on_stripe"] = urlencode("你想在条纹上创建计划吗？");
				$label_decode_admin_unserial["add_recurrence"] = urlencode("添加重复");
				$label_decode_admin_unserial["recurrence_name"] = urlencode("重复名称");
				$label_decode_admin_unserial["recurrence_label"] = urlencode("重复标签");
				$label_decode_admin_unserial["recurrence_days"] = urlencode("复发天数");
				$label_decode_admin_unserial["recurrence_discount_type"] = urlencode("重复折扣类型");
				$label_decode_admin_unserial["recurrence_discount_value"] = urlencode("递延折扣价值");
				$label_decode_admin_unserial["delete_this_recurrence"] = urlencode("删除此重复？");
				
				$label_decode_admin_unserial["recurrence_details"] = urlencode("重复详情");
				$label_decode_admin_unserial["recurrence_plan_details"] = urlencode("重复计划详细信息");
				$label_decode_admin_unserial["recurrence_type"] = urlencode("复发类型");
				$label_decode_admin_unserial["cancel_recurrence"] = urlencode("取消重复发生？");
				
				$label_decode_error_unserial["please_enter_maximum_2_digits"] = urlencode("请输入最多2位数");
			}else{
				$label_decode_front_unserial["on"] = urlencode("On");
				
				$label_decode_admin_unserial["plans_on_stripe"] = urlencode("Do you want to create plans on stripe?");
				$label_decode_admin_unserial["add_recurrence"] = urlencode("Add Reccurence");
				$label_decode_admin_unserial["recurrence_name"] = urlencode("Reccurence Name");
				$label_decode_admin_unserial["recurrence_label"] = urlencode("Reccurence Label");
				$label_decode_admin_unserial["recurrence_days"] = urlencode("Reccurence Days");
				$label_decode_admin_unserial["recurrence_discount_type"] = urlencode("Reccurence Discount Type");
				$label_decode_admin_unserial["recurrence_discount_value"] = urlencode("Reccurence Discount Value");
				$label_decode_admin_unserial["delete_this_recurrence"] = urlencode("Delete this reccurence?");
				
				$label_decode_admin_unserial["recurrence_details"] = urlencode("Recurrence Details");
				$label_decode_admin_unserial["recurrence_plan_details"] = urlencode("Recurrence Plan Details");
				$label_decode_admin_unserial["recurrence_type"] = urlencode("Recurrence Type");
				$label_decode_admin_unserial["cancel_recurrence"] = urlencode("Cancel Recurrence?");
				
				$label_decode_error_unserial["please_enter_maximum_2_digits"] = urlencode("Please Enter Maximum 2 Digits");
			}
			
			$language_front_arr = base64_encode(serialize($label_decode_front_unserial));
			$language_admin_arr = base64_encode(serialize($label_decode_admin_unserial));
			$language_error_arr = base64_encode(serialize($label_decode_error_unserial));
			$language_extra_arr = base64_encode(serialize($label_decode_extra_unserial));
			$language_form_error_arr = base64_encode(serialize($label_decode_front_form_error_unserial));
			
			$update_default_lang = "UPDATE `ct_languages` set `label_data` = '".$language_front_arr."', `admin_labels` = '".$language_admin_arr."', `error_labels` = '".$language_error_arr."', `extra_labels` = '".$language_extra_arr."', `front_error_labels` = '".$language_form_error_arr."' where `language` = '".$all['language']."'";
			mysqli_query($this->conn, $update_default_lang);
		}
	}
	
	public function update6_2(){
		$query = "ALTER TABLE `ct_languages` ADD `app_labels` LONGTEXT NOT NULL AFTER `language_status`;";
		mysqli_query($this->conn, $query);
		
		$update_app_en_lang = "UPDATE `ct_languages` SET `app_labels`='YToxNzg6e3M6Nzoid2VsY29tZSI7czo3OiJXZWxjb21lIjtzOjI4OiJtYWtlX3lvdXJfb25saW5lX2FwcG9pbnRtZW50IjtzOjI4OiJNYWtlK3lvdXIrb25saW5lK2FwcG9pbnRtZW50IjtzOjQ6InNraXAiO3M6NDoiU0tJUCI7czoxMDoic2NoZWR1bGluZyI7czoxMDoiU2NoZWR1bGluZyI7czo1MDoibWFrZV95b3VyX29ubGluZV9hcHBvaW50bWVudF9zY2hlZHVsaW5nX3N1cGVyX2Vhc3kiO3M6NTA6Ik1ha2UreW91citvbmxpbmUrYXBwb2ludG1lbnQrc2NoZWR1bGluZytzdXBlcitlYXN5IjtzOjExOiJnZXRfc3RhcnRlZCI7czoxMToiR2V0K1N0YXJ0ZWQiO3M6NDI6ImdldF9zdGFydGVkX2J5X2xvZ2dpbmdfaW5fb3JfYnlfc2lnbmluZ191cCI7czo0MjoiR2V0K3N0YXJ0ZWQrYnkrbG9nZ2luZytpbitvcitieStzaWduaW5nK3VwIjtzOjc6InNpZ25faW4iO3M6NzoiU2lnbitJbiI7czoxNjoiZW50ZXJfeW91cl9lbWFpbCI7czoxNjoiRW50ZXIrWW91citFbWFpbCI7czoxNDoiZW50ZXJfcGFzc3dvcmQiO3M6MTQ6IkVudGVyK1Bhc3N3b3JkIjtzOjE1OiJmb3Jnb3RfcGFzc3dvcmQiO3M6MTg6IkZvcmdvdCtQYXNzd29yZCUzRiI7czo1OiJsb2dpbiI7czo1OiJMb2dpbiI7czoyNToiZG9udF9oYXZlX2FjY291bnRfc2lnbl91cCI7czozNzoiRG9uJUUyJTgwJTk5dCtIYXZlK0FjY291bnQlM0YrU2lnbitVcCI7czoyNDoiZW50ZXJfZW1haWxfYW5kX3Bhc3N3b3JkIjtzOjI0OiJFbnRlcitlbWFpbCthbmQrcGFzc3dvcmQiO3M6NzE6InBsZWFzZV9lbnRlcl95b3VyX3JlZ2lzdGVyZWRfZW1haWxfaWRfd2Vfd2lsbF9zZW5kX290cF90b195b3VyX2VtYWlsX2lkIjtzOjczOiJQbGVhc2UrZW50ZXIreW91cityZWdpc3RlcmVkK2VtYWlsK0lELit3ZSt3aWxsK3NlbmQrT1RQK3RvK3lvdXIrRW1haWwrSUQuIjtzOjE0OiJlbnRlcl95b3VyX290cCI7czoxNDoiRW50ZXIreW91citPVFAiO3M6ODoic2VuZF9vdHAiO3M6ODoiU2VuZCtPVFAiO3M6MTY6ImN1cnJlbnRfcGFzc3dvcmQiO3M6MTY6IkN1cnJlbnQrUGFzc3dvcmQiO3M6MTI6Im5ld19wYXNzd29yZCI7czoxMjoiTmV3K1Bhc3N3b3JkIjtzOjE2OiJjb25maXJtX3Bhc3N3b3JkIjtzOjE2OiJDb25maXJtK1Bhc3N3b3JkIjtzOjExOiJzZXJ2ZXJfZG93biI7czoxMToiU2VydmVyK2Rvd24iO3M6MTA6InZlcmlmeV9vdHAiO3M6MTA6IlZlcmlmeStPVFAiO3M6NjoiY2xpZW50IjtzOjY6IkNsaWVudCI7czoxNzoidXBkYXRpbmdfcGFzc3dvcmQiO3M6MTc6IlVwZGF0aW5nK3Bhc3N3b3JkIjtzOjI5OiJwYXNzd29yZF91cGRhdGVkX3N1Y2Nlc3NmdWxseSI7czoyOToiUGFzc3dvcmQrdXBkYXRlZCtzdWNjZXNzZnVsbHkiO3M6MTc6InBhc3N3b3JkX21pc21hdGNoIjtzOjE3OiJQYXNzd29yZCttaXNtYXRjaCI7czoyMjoiaW5jb3JyZWN0X29sZF9wYXNzd29yZCI7czoyMjoiSW5jb3JyZWN0K29sZCtwYXNzd29yZCI7czoyMjoicGxlYXNlX2ZpbGxfYWxsX2ZpZWxkcyI7czoyMjoiUGxlYXNlK2ZpbGwrYWxsK2ZpZWxkcyI7czo2OiJzdWJtaXQiO3M6NjoiU3VibWl0IjtzOjEwOiJmaXJzdF9uYW1lIjtzOjEwOiJGaXJzdCtOYW1lIjtzOjk6Imxhc3RfbmFtZSI7czo5OiJMYXN0K05hbWUiO3M6NToiZW1haWwiO3M6NToiRW1haWwiO3M6NToicGhvbmUiO3M6NToiUGhvbmUiO3M6NzoiYWRkcmVzcyI7czo3OiJBZGRyZXNzIjtzOjQ6ImNpdHkiO3M6NDoiQ2l0eSI7czo3OiJjb3VudHJ5IjtzOjc6IkNvdW50cnkiO3M6ODoicG9zdGNvZGUiO3M6ODoiUG9zdGNvZGUiO3M6ODoicGFzc3dvcmQiO3M6ODoiUGFzc3dvcmQiO3M6Nzoic2lnbl91cCI7czo3OiJTaWduK1VwIjtzOjIzOiJhbHJlYWR5X2hhdmVfYW5fYWNjb3VudCI7czoyNjoiQWxyZWFkeStIYXZlK2FuK0FjY291bnQlM0YiO3M6NDoiaG9tZSI7czo0OiJIb21lIjtzOjEwOiJ3ZWxjb21lX3RvIjtzOjEwOiJXZWxjb21lK3RvIjtzOjExOiJuZXdfYm9va2luZyI7czoxMToiTmV3K2Jvb2tpbmciO3M6MTE6Im15X2Jvb2tpbmdzIjtzOjExOiJNeStCb29raW5ncyI7czoxNToibXlfdHJhbnNhY3Rpb25zIjtzOjE1OiJNeStUcmFuc2FjdGlvbnMiO3M6MTE6Im15X3NldHRpbmdzIjtzOjExOiJNeStTZXR0aW5ncyI7czo0Mjoid2hlcmVfd291bGRfeW91X2xpa2VfdXNfdG9fcHJvdmlkZV9zZXJ2aWNlIjtzOjQ1OiJXaGVyZSt3b3VsZCt5b3UrbGlrZSt1cyt0bytwcm92aWRlK3NlcnZpY2UlM0YiO3M6MjE6InBsZWFzZV9jaG9vc2Vfc2VydmljZSI7czoyMToiUGxlYXNlK0Nob29zZStTZXJ2aWNlIjtzOjg6InByZXZpb3VzIjtzOjg6IlByZXZpb3VzIjtzOjQ6Im5leHQiO3M6NDoiTmV4dCI7czo3OiJzZXJ2aWNlIjtzOjc6IlNlcnZpY2UiO3M6NDoiY29zdCI7czo0OiJDb3N0IjtzOjIwOiJwbGVhc2Vfc2VsZWN0X21ldGhvZCI7czoyMDoiUGxlYXNlK1NlbGVjdCtNZXRob2QiO3M6MjA6InBsZWFzZV9zZWxlY3Rfb2ZmZXJzIjtzOjIwOiJQbGVhc2UrU2VsZWN0K09mZmVycyI7czoxODoicGxlYXNlX3NlbGVjdF90aW1lIjtzOjE4OiJQbGVhc2UrU2VsZWN0K1RpbWUiO3M6MjA6InBsZWFzZV9zZWxlY3RfYWRkb25zIjtzOjIwOiJQbGVhc2UrU2VsZWN0K0FkZG9ucyI7czo3OiJtb250aGx5IjtzOjc6Ik1vbnRobHkiO3M6OToiYmlfd2Vla2x5IjtzOjk6IkJpK1dlZWtseSI7czo2OiJ3ZWVrbHkiO3M6NjoiV2Vla2x5IjtzOjQ6Im9uY2UiO3M6NDoiT25jZSI7czoxODoicGxlYXNlX3NlbGVjdF9kYXRlIjtzOjE4OiJQbGVhc2UrU2VsZWN0K0RhdGUiO3M6NDoiZGF0ZSI7czo0OiJEYXRlIjtzOjIyOiJwbGVhc2Vfc2VsZWN0X3Byb3ZpZGVyIjtzOjIyOiJQbGVhc2UrU2VsZWN0K1Byb3ZpZGVyIjtzOjQ6InRpbWUiO3M6NDoiVGltZSI7czoxMzoiaW5jbHVkaW5nX3RheCI7czoxMzoiSW5jbHVkaW5nK1RheCI7czoyNDoicHJlZmVycmVkX3BheW1lbnRfbWV0aG9kIjtzOjI0OiJQcmVmZXJyZWQrUGF5bWVudCtNZXRob2QiO3M6MTE6ImxvY2FsbHlfcGF5IjtzOjExOiJMb2NhbGx5K1BheSI7czoyNToiY3JlZGl0X2RlYml0X2NhcmRfcGF5bWVudCI7czoyNzoiQ3JlZGl0JTJGRGViaXQrQ2FyZCtQYXltZW50IjtzOjY6ImNhbmNlbCI7czo2OiJDYW5jZWwiO3M6MjU6ImNyZWRpdF9kZWJpdF9jYXJkX2RldGFpbHMiO3M6Mjc6IkNyZWRpdCUyRkRlYml0K0NhcmQrRGV0YWlscyI7czoxMjoic2VydmljZV9uYW1lIjtzOjEyOiJTZXJ2aWNlK05hbWUiO3M6MTI6ImJvb2tpbmdfZGF0ZSI7czoxMjoiQm9va2luZytEYXRlIjtzOjExOiJjYXJ0X2Ftb3VudCI7czoxMToiQ2FydCtBbW91bnQiO3M6MTY6ImJvb2tfYXBwb2ludG1lbnQiO3M6MTY6IkJvb2srQXBwb2ludG1lbnQiO3M6MTE6ImNhcmRfbnVtYmVyIjtzOjExOiJDYXJkK051bWJlciI7czoxMjoiZXhwaXJ5X21vbnRoIjtzOjEyOiJFeHBpcnkrTW9udGgiO3M6MTE6ImV4cGlyeV95ZWFyIjtzOjExOiJFeHBpcnkrWWVhciI7czoxNToiYm9va2luZ19zdW1tYXJ5IjtzOjE1OiJCb29raW5nK1N1bW1hcnkiO3M6ODoiY2FyZF9jdmMiO3M6ODoiQ2FyZCtDVkMiO3M6MzoiYWxsIjtzOjM6IkFsbCI7czo0OiJwYXN0IjtzOjQ6IlBhc3QiO3M6ODoidXBjb21pbmciO3M6ODoiVXBjb21pbmciO3M6MTc6Im5vX2RhdGFfYXZhaWxhYmxlIjtzOjE3OiJObytEYXRhK0F2YWlsYWJsZSI7czo5OiJjb25maXJtZWQiO3M6OToiQ29uZmlybWVkIjtzOjg6InJlamVjdGVkIjtzOjg6IlJlamVjdGVkIjtzOjc6InBlbmRpbmciO3M6NzoiUGVuZGluZyI7czo5OiJjYW5jZWxsZWQiO3M6OToiQ2FuY2VsbGVkIjtzOjEwOiJyZXNjaGVkdWxlIjtzOjEwOiJSZXNjaGVkdWxlIjtzOjc6Im5vX3Nob3ciO3M6NzoiTm8rU2hvdyI7czo3OiJkZXRhaWxzIjtzOjc6IkRldGFpbHMiO3M6MTc6ImxvYWRpbmdfbW9yZV9kYXRhIjtzOjE3OiJMb2FkaW5nK01vcmUrRGF0YSI7czo5OiJkYXNoYm9hcmQiO3M6OToiRGFzaGJvYXJkIjtzOjU6InByaWNlIjtzOjU6IlByaWNlIjtzOjg6Im9yZGVyX2lkIjtzOjg6Ik9yZGVyK2lkIjtzOjQ6InVuaXQiO3M6NDoiVW5pdCI7czo2OiJhZGRfb24iO3M6NjoiQWRkLW9uIjtzOjY6Im1ldGhvZCI7czo2OiJNZXRob2QiO3M6MTI6InBheW1lbnRfdHlwZSI7czoxMjoiUGF5bWVudCt0eXBlIjtzOjE0OiJib29raW5nX3N0YXR1cyI7czoxNDoiQm9va2luZytzdGF0dXMiO3M6MzA6ImFwcG9pbnRtZW50X21hcmtlZF9hc19ub19zaG93biI7czozMDoiQXBwb2ludG1lbnQrTWFya2VkK2FzK05vK1Nob3duIjtzOjI5OiJjYW5jZWxsZWRfYnlfc2VydmljZV9wcm92aWRlciI7czoyOToiQ2FuY2VsbGVkK2J5K1NlcnZpY2UrUHJvdmlkZXIiO3M6MjE6ImNhbmNlbGxlZF9ieV9jdXN0b21lciI7czoyMToiQ2FuY2VsbGVkK2J5K0N1c3RvbWVyIjtzOjEwOiJzdGFydF9kYXRlIjtzOjEwOiJTdGFydCtEYXRlIjtzOjEwOiJzdGFydF90aW1lIjtzOjEwOiJTdGFydCtUaW1lIjtzOjIwOiJwYXltZW50X3RyYW5zYWN0aW9ucyI7czoyMDoiUGF5bWVudCtUcmFuc2FjdGlvbnMiO3M6MTA6Im15X2FjY291bnQiO3M6MTA6Ik15K0FjY291bnQiO3M6NDoibmFtZSI7czo0OiJOYW1lIjtzOjY6InVwZGF0ZSI7czo2OiJVcGRhdGUiO3M6ODoiY3VzdG9tZXIiO3M6ODoiQ3VzdG9tZXIiO3M6NToic3RhZmYiO3M6NToiU3RhZmYiO3M6MjA6InNjaGVkdWxlX2FwcG9pbnRtZW50IjtzOjIwOiJTY2hlZHVsZStBcHBvaW50bWVudCI7czoxMDoiY29udGFjdF91cyI7czoxMDoiQ29udGFjdCtVcyI7czo4OiJmZWVkYmFjayI7czo4OiJGZWVkYmFjayI7czo2OiJsb2dvdXQiO3M6NjoiTG9nb3V0IjtzOjE0OiJlbnRlcl9mZWVkYmFjayI7czoxNDoiRW50ZXIrZmVlZGJhY2siO3M6MTY6ImZldGNoaW5nX21ldGhvZHMiO3M6MTY6IkZldGNoaW5nK21ldGhvZHMiO3M6MzY6InRoYW5rX3lvdV9mb3JfeW91cl92YWx1YWJsZV9mZWVkYmFjayI7czozNjoiVGhhbmsreW91K2Zvcit5b3VyK3ZhbHVhYmxlK2ZlZWRiYWNrIjtzOjI1OiJ1bmFibGVfdG9fc3VibWl0X2ZlZWRiYWNrIjtzOjI1OiJVbmFibGUrdG8rc3VibWl0K2ZlZWRiYWNrIjtzOjIxOiJwbGVhc2VfZW50ZXJfZmVlZGJhY2siO3M6MjE6IlBsZWFzZStlbnRlcitmZWVkYmFjayI7czoxMzoibm90aWZpY2F0aW9ucyI7czoxMzoiTm90aWZpY2F0aW9ucyI7czoxOToibmV3X2Jvb2tpbmdfc3VjY2VzcyI7czoxOToiTmV3K0Jvb2tpbmcrU3VjY2VzcyI7czoyMDoiYWN0aXZpdHlfcmVzY2hlZHVsZWQiO3M6MjA6IkFjdGl2aXR5K1Jlc2NoZWR1bGVkIjtzOjE3OiJub19zZXJ2aWNlc19mb3VuZCI7czoxNzoiTm8rU2VydmljZXMrRm91bmQiO3M6MTY6ImFwaV9rZXlfbWlzbWF0Y2giO3M6MTY6IkFQSStrZXkrbWlzbWF0Y2giO3M6MjE6InBvc3RhbF9jb2RlX25vdF9mb3VuZCI7czoyMToiUG9zdGFsK2NvZGUrbm90K2ZvdW5kIjtzOjE3OiJwb3N0YWxfY29kZV9mb3VuZCI7czoxNzoiUG9zdGFsK2NvZGUrZm91bmQiO3M6Mjg6ImV4dHJhX3NlcnZpY2VzX25vdF9hdmFpbGFibGUiO3M6Mjg6IkV4dHJhK1NlcnZpY2VzK05vdCtBdmFpbGFibGUiO3M6MTg6Im5vX3VuaXRzX2F2YWlsYWJsZSI7czoxODoiTm8rdW5pdHMrYXZhaWxhYmxlIjtzOjI4OiJub19mcmVxdWVudGx5X2Rpc2NvdW50X2ZvdW5kIjtzOjI4OiJObytmcmVxdWVudGx5K2Rpc2NvdW50K2ZvdW5kIjtzOjM1OiJpbmNvcnJlY3RfZW1haWxfYWRkcmVzc19vcl9wYXNzd29yZCI7czozNToiSW5jb3JyZWN0K0VtYWlsK0FkZHJlc3Mrb3IrUGFzc3dvcmQiO3M6MjE6Im5vX2FwcG9pbnRtZW50c19mb3VuZCI7czoyMToiTm8rYXBwb2ludG1lbnRzK2ZvdW5kIjtzOjQxOiJ5b3VyX2FwcG9pbnRtZW50X3Jlc2NoZWR1bGVkX3N1Y2Nlc3NmdWxseSI7czo0MToiWW91cithcHBvaW50bWVudCtyZXNjaGVkdWxlZCtzdWNjZXNzZnVsbHkiO3M6MjY6InNvcnJ5X3dlX2FyZV9ub3RfYXZhaWxhYmxlIjtzOjMwOiJTb3JyeSUyQytXZSthcmUrbm90K2F2YWlsYWJsZS4iO3M6Mzk6InlvdXJfYXBwb2ludG1lbnRfY2FuY2VsbGVkX3N1Y2Nlc3NmdWxseSI7czozOToiWW91cithcHBvaW50bWVudCtjYW5jZWxsZWQrc3VjY2Vzc2Z1bGx5IjtzOjE5OiJjb3Vwb25fY29kZV9leHBpcmVkIjtzOjE5OiJDb3Vwb24rY29kZStleHBpcmVkIjtzOjE5OiJpbnZhbGlkX2NvdXBvbl9jb2RlIjtzOjE5OiJJbnZhbGlkK2NvdXBvbitjb2RlIjtzOjI3OiJwYXJ0aWFsX2RlcG9zaXRfaXNfZGlzYWJsZWQiO3M6Mjc6IlBhcnRpYWwrZGVwb3NpdCtpcytkaXNhYmxlZCI7czo1NDoibm9uZV9vZl90aW1lX3Nsb3RfYXZhaWxhYmxlX3BsZWFzZV9jaGVja19hbm90aGVyX2RhdGVzIjtzOjU0OiJOb25lK29mK3RpbWUrc2xvdCthdmFpbGFibGUrcGxlYXNlK2NoZWNrK2Fub3RoZXIrZGF0ZXMiO3M6NDY6ImF2YWlsYWJpbGl0eV9pc19ub3RfY29uZmlndXJlZF9mcm9tX2FkbWluX3NpZGUiO3M6NDY6IkF2YWlsYWJpbGl0eStpcytub3QrY29uZmlndXJlZCtmcm9tK2FkbWluK3NpZGUiO3M6Mjk6ImN1c3RvbWVyX2NyZWF0ZWRfc3VjY2Vzc2Z1bGx5IjtzOjI5OiJDdXN0b21lcitjcmVhdGVkK3N1Y2Nlc3NmdWxseSI7czozMToiZXJyb3Jfb2NjdXJyZWRfcGxlYXNlX3RyeV9hZ2FpbiI7czozMToiRXJyb3Irb2NjdXJyZWQrcGxlYXNlK3RyeSthZ2FpbiI7czozMToiYXBwb2ludG1lbnRfYm9va2VkX3N1Y2Nlc3NmdWxseSI7czozMToiQXBwb2ludG1lbnQrYm9va2VkK3N1Y2Nlc3NmdWxseSI7czoyNDoidXNlcl9kZXRhaWxzX25vdF91cGRhdGVkIjtzOjI0OiJVc2VyK2RldGFpbHMrbm90K3VwZGF0ZWQiO3M6MzY6InVzZXJfbm90X2V4aXN0X3BsZWFzZV9yZWdpc3Rlcl9maXJzdCI7czozNjoiVXNlcitub3QrZXhpc3QrcGxlYXNlK3JlZ2lzdGVyK2ZpcnN0IjtzOjE4OiJ1c2VyX2FscmVhZHlfZXhpc3QiO3M6MTg6IlVzZXIrQWxyZWFkeStFeGlzdCI7czoxNzoiaW52YWxpZF91c2VyX3R5cGUiO3M6MTc6IkludmFsaWQrdXNlcit0eXBlIjtzOjE0OiJub19zdGFmZl9mb3VuZCI7czoxNDoiTm8rc3RhZmYrZm91bmQiO3M6MjA6Im5vX2RldGFpbHNfYXZhaWxhYmxlIjtzOjIwOiJObytEZXRhaWxzK0F2YWlsYWJsZSI7czoxNjoidHlwZV9pc19taXNtYXRjaCI7czoxNjoiVHlwZStpcyttaXNtYXRjaCI7czoyMDoidXBkYXRlZF9zdWNjZXNzZnVsbHkiO3M6MjA6IlVwZGF0ZWQrU3VjY2Vzc2Z1bGx5IjtzOjIwOiJzb21ldGhpbmdfd2VudF93cm9uZyI7czoyMDoiU29tZXRoaW5nK1dlbnQrV3JvbmciO3M6MzY6InBsZWFzZV9jaGVja195b3VyX2NvbmZpcm1lZF9wYXNzd29yZCI7czozOToiUGxlYXNlK2NoZWNrK3lvdXIrY29uZmlybWVkK3Bhc3N3b3JkJTIxIjtzOjIzOiJ5b3VyX3Bhc3N3b3JkX25vdF9tYXRjaCI7czoyMzoiWW91citQYXNzd29yZCtOb3QrTWF0Y2giO3M6MjQ6Im5vX3VwY29tbWluZ19hcHBvaW50bWVudCI7czoyNDoiTm8rVXBjb21taW5nK0FwcG9pbnRtZW50IjtzOjExOiJlbWFpbF9leGlzdCI7czoxMToiRW1haWwrZXhpc3QiO3M6MjA6ImVtYWlsX2RvZXNfbm90X2V4aXN0IjtzOjIwOiJFbWFpbCtkb2VzK25vdCtleGlzdCI7czoxOToiaW52YWxpZF9jcmVkZW50aWFscyI7czoxOToiSW52YWxpZCtjcmVkZW50aWFscyI7czoxMDoiZW1haWxfc2VuZCI7czoxMDoiRW1haWwrc2VuZCI7czoyMDoiZW1haWxfc2VuZGluZ19mYWlsZWQiO3M6MjA6IkVtYWlsK3NlbmRpbmcrZmFpbGVkIjtzOjE3OiJub19vcmRlcnNfZGV0YWlscyI7czoxNzoiTm8rT3JkZXJzK0RldGFpbHMiO3M6MTA6Im1lc3NhZ2VfaXMiO3M6MTA6Ik1lc3NhZ2UrSXMiO3M6MjA6InBsZWFzZV9lbmFibGVfc3RyaXBlIjtzOjIwOiJQbGVhc2UrRW5hYmxlK1N0cmlwZSI7czoxNToiaW52YWxpZF9yZXF1ZXN0IjtzOjE1OiJJbnZhbGlkK3JlcXVlc3QiO3M6OToib3RwX21hdGNoIjtzOjk6Ik90cCttYXRjaCI7czoxMzoib3RwX25vdF9tYXRjaCI7czoxMzoiT3RwK25vdCttYXRjaCI7czoxODoicGFzc3dvcmRfaXNfY2hhbmdlIjtzOjE4OiJQYXNzd29yZCtpcytjaGFuZ2UiO3M6MTk6InBhc3N3b3JkX25vdF9jaGFuZ2UiO3M6MTk6IlBhc3N3b3JkK05vdCtjaGFuZ2UiO3M6NTY6ImFyZV95b3Vfc3VyZV95b3Vfd2FudF90b19jYW5jZWxfdGhpc19ib29raW5nX2FwcG9pbnRtZW50IjtzOjU5OiJBcmUreW91K3N1cmUreW91K3dhbnQrdG8rY2FuY2VsK3RoaXMrYm9va2luZythcHBvaW50bWVudCUzRiI7czo1OiJhbGVydCI7czo1OiJBbGVydCI7czoyOiJubyI7czoyOiJObyI7czoxNToidmVyaWZ5X3ppcF9jb2RlIjtzOjE1OiJWZXJpZnkremlwK2NvZGUiO3M6MTE6InBvc3RhbF9jb2RlIjtzOjExOiJQb3N0YWwrQ29kZSI7czozMDoibm9fbWV0aG9kX2Zvcl9zZWxlY3RlZF9zZXJ2aWNlIjtzOjMwOiJObyttZXRob2QrZm9yK3NlbGVjdGVkK3NlcnZpY2UiO3M6MjQ6InBsZWFzZV9lbnRlcl9wb3N0YWxfY29kZSI7czoyNDoiUGxlYXNlK2VudGVyK3Bvc3RhbCtjb2RlIjtzOjI5OiJub19hZGRvbnNfZm9yX3NlbGVjdGVkX21ldGhvZCI7czoyOToiTm8rYWRkb25zK2ZvcitzZWxlY3RlZCttZXRob2QiO3M6MjM6InNlbGVjdF9hdGxlYXN0X29uZV91bml0IjtzOjIzOiJTZWxlY3QrYXRsZWFzdCtvbmUrdW5pdCI7czoxODoic2VsZWN0X2FueV9wYWNrYWdlIjtzOjE4OiJTZWxlY3QrYW55K3BhY2thZ2UiO3M6MTE6InBsZWFzZV93YWl0IjtzOjExOiJQbGVhc2UrV2FpdCI7fQ==' WHERE `language`='en'";
		mysqli_query($this->conn, $update_app_en_lang);
		$update_app_de_DE_lang = "UPDATE `ct_languages` SET `app_labels`='YToxNzg6e3M6Nzoid2VsY29tZSI7czo2OiJXZWxrb20iO3M6Mjg6Im1ha2VfeW91cl9vbmxpbmVfYXBwb2ludG1lbnQiO3M6MjM6Ik1hYWsrdXcrb25saW5lK2Fmc3ByYWFrIjtzOjQ6InNraXAiO3M6MTI6Ik9WRVJTUFJJTkdFTiI7czoxMDoic2NoZWR1bGluZyI7czoxMDoic2NoZWR1bGluZyI7czo1MDoibWFrZV95b3VyX29ubGluZV9hcHBvaW50bWVudF9zY2hlZHVsaW5nX3N1cGVyX2Vhc3kiO3M6NDg6Ik1hYWsrdXcrb25saW5lK2Fmc3ByYWFrcGxhbm5pbmcrc3VwZXJnZW1ha2tlbGlqayI7czoxMToiZ2V0X3N0YXJ0ZWQiO3M6NToiQmVnaW4iO3M6NDI6ImdldF9zdGFydGVkX2J5X2xvZ2dpbmdfaW5fb3JfYnlfc2lnbmluZ191cCI7czo1OToiR2ErYWFuK2RlK3NsYWcrZG9vcit1K2Fhbit0ZSttZWxkZW4rb2YrZG9vcit1K2Fhbit0ZSttZWxkZW4iO3M6Nzoic2lnbl9pbiI7czo5OiJBYW5tZWxkZW4iO3M6MTY6ImVudGVyX3lvdXJfZW1haWwiO3M6MjI6IlZvZXIramUrZS1tYWlsYWRyZXMraW4iO3M6MTQ6ImVudGVyX3Bhc3N3b3JkIjtzOjE4OiJWb2VyK3dhY2h0d29vcmQraW4iO3M6MTU6ImZvcmdvdF9wYXNzd29yZCI7czoyMjoiV2FjaHR3b29yZCt2ZXJnZXRlbiUzRiI7czo1OiJsb2dpbiI7czo2OiJMb2craW4iO3M6MjU6ImRvbnRfaGF2ZV9hY2NvdW50X3NpZ25fdXAiO3M6MzQ6IkhlYitqZStnZWVuK2FjY291bnQlM0YrSW5zY2hyaWp2ZW4iO3M6MjQ6ImVudGVyX2VtYWlsX2FuZF9wYXNzd29yZCI7czozMzoiVm9lcitlLW1haWxhZHJlcytlbit3YWNodHdvb3JkK2luIjtzOjcxOiJwbGVhc2VfZW50ZXJfeW91cl9yZWdpc3RlcmVkX2VtYWlsX2lkX3dlX3dpbGxfc2VuZF9vdHBfdG9feW91cl9lbWFpbF9pZCI7czo3MToiVm9lcit1dytnZXJlZ2lzdHJlZXJkZStlLW1haWxhZHJlcytpbi4rd2Urc3R1cmVuK09UUCtuYWFyK3V3K2UtbWFpbC1JRC4iO3M6MTQ6ImVudGVyX3lvdXJfb3RwIjtzOjE0OiJWb2VyK2plK09UUCtpbiI7czo4OiJzZW5kX290cCI7czo5OiJTdHV1citPVFAiO3M6MTY6ImN1cnJlbnRfcGFzc3dvcmQiO3M6MzU6Imh1aWRpZyslRTIlODAlOEIlRTIlODAlOEJ3YWNodHdvb3JkIjtzOjEyOiJuZXdfcGFzc3dvcmQiO3M6MTQ6Im5pZXV3K3Bhc3dvb3JkIjtzOjE2OiJjb25maXJtX3Bhc3N3b3JkIjtzOjE5OiJiZXZlc3RpZyt3YWNodHdvb3JkIjtzOjExOiJzZXJ2ZXJfZG93biI7czoxMToiU2VydmVyK25lZXIiO3M6MTA6InZlcmlmeV9vdHAiO3M6MTQ6IkNvbnRyb2xlZXIrT1RQIjtzOjY6ImNsaWVudCI7czoxMToiQ2xpJUMzJUFCbnQiO3M6MTc6InVwZGF0aW5nX3Bhc3N3b3JkIjtzOjIwOiJXYWNodHdvb3JkK2JpandlcmtlbiI7czoyOToicGFzc3dvcmRfdXBkYXRlZF9zdWNjZXNzZnVsbHkiO3M6MzE6IldhY2h0d29vcmQrc3VjY2Vzdm9sK2Jpamdld2Vya3QiO3M6MTc6InBhc3N3b3JkX21pc21hdGNoIjtzOjI4OiJXYWNodHdvb3JkK2tvbXQrbmlldCtvdmVyZWVuIjtzOjIyOiJpbmNvcnJlY3Rfb2xkX3Bhc3N3b3JkIjtzOjIyOiJPbmp1aXN0K291ZCt3YWNodHdvb3JkIjtzOjIyOiJwbGVhc2VfZmlsbF9hbGxfZmllbGRzIjtzOjMwOiJWdWwrYWxzdHVibGllZnQrYWxsZSt2ZWxkZW4raW4iO3M6Njoic3VibWl0IjtzOjEwOiJ2b29ybGVnZ2VuIjtzOjEwOiJmaXJzdF9uYW1lIjtzOjg6IlZvb3JuYWFtIjtzOjk6Imxhc3RfbmFtZSI7czoxMDoiQWNodGVybmFhbSI7czo1OiJlbWFpbCI7czo2OiJFLW1haWwiO3M6NToicGhvbmUiO3M6ODoiVGVsZWZvb24iO3M6NzoiYWRkcmVzcyI7czo1OiJBZHJlcyI7czo0OiJjaXR5IjtzOjQ6InN0YWQiO3M6NzoiY291bnRyeSI7czo0OiJsYW5kIjtzOjg6InBvc3Rjb2RlIjtzOjg6IlBvc3Rjb2RlIjtzOjg6InBhc3N3b3JkIjtzOjEwOiJXYWNodHdvb3JkIjtzOjc6InNpZ25fdXAiO3M6MTE6Ikluc2NocmlqdmVuIjtzOjIzOiJhbHJlYWR5X2hhdmVfYW5fYWNjb3VudCI7czoyNDoiSGViK2plK2FsK2VlbithY2NvdW50JTNGIjtzOjQ6ImhvbWUiO3M6NDoiSHVpcyI7czoxMDoid2VsY29tZV90byI7czoxMDoiV2Vsa29tK2JpaiI7czoxMToibmV3X2Jvb2tpbmciO3M6MTQ6Ik5pZXV3ZStib2VraW5nIjtzOjExOiJteV9ib29raW5ncyI7czoxNDoiTWlqbitib2VraW5nZW4iO3M6MTU6Im15X3RyYW5zYWN0aW9ucyI7czoxNjoiTWlqbit0cmFuc2FjdGllcyI7czoxMToibXlfc2V0dGluZ3MiO3M6MTc6Ik1pam4raW5zdGVsbGluZ2VuIjtzOjQyOiJ3aGVyZV93b3VsZF95b3VfbGlrZV91c190b19wcm92aWRlX3NlcnZpY2UiO3M6Mzg6IldhYXIrd2lsdCt1K2RhdCt3ZStzZXJ2aWNlK3ZlcmxlbmVuJTNGIjtzOjIxOiJwbGVhc2VfY2hvb3NlX3NlcnZpY2UiO3M6MjQ6IktpZXMrYWxzdHVibGllZnQrU2VydmljZSI7czo4OiJwcmV2aW91cyI7czo5OiJ2b29yZ2FhbmQiO3M6NDoibmV4dCI7czo4OiJ2b2xnZW5kZSI7czo3OiJzZXJ2aWNlIjtzOjc6IlNlcnZpY2UiO3M6NDoiY29zdCI7czo2OiJLb3N0ZW4iO3M6MjA6InBsZWFzZV9zZWxlY3RfbWV0aG9kIjtzOjE3OiJTZWxlY3RlZXIrbWV0aG9kZSI7czoyMDoicGxlYXNlX3NlbGVjdF9vZmZlcnMiO3M6MjI6IlNlbGVjdGVlcithYW5iaWVkaW5nZW4iO3M6MTg6InBsZWFzZV9zZWxlY3RfdGltZSI7czoyNjoiU2VsZWN0ZWVyK2Fsc3R1YmxpZWZ0K1RpamQiO3M6MjA6InBsZWFzZV9zZWxlY3RfYWRkb25zIjtzOjI5OiJTZWxlY3RlZXIrYWxzdHVibGllZnQrQWRkLW9ucyI7czo3OiJtb250aGx5IjtzOjExOiJNYWFuZGVsaWprcyI7czo5OiJiaV93ZWVrbHkiO3M6OToiQmkrV2Vla2x5IjtzOjY6IndlZWtseSI7czo5OiJXZWtlbGlqa3MiO3M6NDoib25jZSI7czo4OiJFZW4ra2VlciI7czoxODoicGxlYXNlX3NlbGVjdF9kYXRlIjtzOjE1OiJTZWxlY3RlZXIrRGF0dW0iO3M6NDoiZGF0ZSI7czo1OiJEYXR1bSI7czoyMjoicGxlYXNlX3NlbGVjdF9wcm92aWRlciI7czoyMjoiU2VsZWN0ZWVyK2Vlbitwcm92aWRlciI7czo0OiJ0aW1lIjtzOjQ6IlRpamQiO3M6MTM6ImluY2x1ZGluZ190YXgiO3M6MTk6IkluY2x1c2llZitiZWxhc3RpbmciO3M6MjQ6InByZWZlcnJlZF9wYXltZW50X21ldGhvZCI7czoyMjoiR2V3ZW5zdGUrYmV0YWFsbWV0aG9kZSI7czoxMToibG9jYWxseV9wYXkiO3M6MTQ6Ikxva2FhbCtiZXRhbGVuIjtzOjI1OiJjcmVkaXRfZGViaXRfY2FyZF9wYXltZW50IjtzOjMwOiJDcmVkaXQrJTJGK0RlYml0K0NhcmQrQmV0YWxpbmciO3M6NjoiY2FuY2VsIjtzOjk6ImFubnVsZXJlbiI7czoyNToiY3JlZGl0X2RlYml0X2NhcmRfZGV0YWlscyI7czoyOToiQ3JlZGl0KyUyRitEZWJpdCtDYXJkK0RldGFpbHMiO3M6MTI6InNlcnZpY2VfbmFtZSI7czoxMToiU2VydmljZW5hYW0iO3M6MTI6ImJvb2tpbmdfZGF0ZSI7czoxMzoiQm9la2luZ3NkYXR1bSI7czoxMToiY2FydF9hbW91bnQiO3M6MTc6IldpbmtlbHdhZ2VuYmVkcmFnIjtzOjE2OiJib29rX2FwcG9pbnRtZW50IjtzOjE1OiJBZnNwcmFhaytib2VrZW4iO3M6MTE6ImNhcmRfbnVtYmVyIjtzOjExOiJLYWFydG51bW1lciI7czoxMjoiZXhwaXJ5X21vbnRoIjtzOjExOiJWZXJ2YWxtYWFuZCI7czoxMToiZXhwaXJ5X3llYXIiO3M6MTA6IlZlcnZhbGphYXIiO3M6MTU6ImJvb2tpbmdfc3VtbWFyeSI7czoyMDoiQm9la2luZytTYW1lbnZhdHRpbmciO3M6ODoiY2FyZF9jdmMiO3M6OToiS2FhcnQrQ1ZDIjtzOjM6ImFsbCI7czo4OiJBbGxlbWFhbCI7czo0OiJwYXN0IjtzOjg6IlZlcmxlZGVuIjtzOjg6InVwY29taW5nIjtzOjEwOiJBYW5rb21lbmRlIjtzOjE3OiJub19kYXRhX2F2YWlsYWJsZSI7czoyNToiR2VlbitnZWdldmVucytiZXNjaGlrYmFhciI7czo5OiJjb25maXJtZWQiO3M6OToiYmV2ZXN0aWdkIjtzOjg6InJlamVjdGVkIjtzOjk6IlZlcndvcnBlbiI7czo3OiJwZW5kaW5nIjtzOjEzOiJJbithZndhY2h0aW5nIjtzOjk6ImNhbmNlbGxlZCI7czoxMToiR2Vhbm51bGVlcmQiO3M6MTA6InJlc2NoZWR1bGUiO3M6MTg6IkFmc3ByYWFrK3ZlcnpldHRlbiI7czo3OiJub19zaG93IjtzOjE3OiJHZWVuK3Zvb3JzdGVsbGluZyI7czo3OiJkZXRhaWxzIjtzOjc6IkRldGFpbHMiO3M6MTc6ImxvYWRpbmdfbW9yZV9kYXRhIjtzOjE5OiJNZWVyK2dlZ2V2ZW5zK2xhZGVuIjtzOjk6ImRhc2hib2FyZCI7czo5OiJEYXNoYm9hcmQiO3M6NToicHJpY2UiO3M6NToiUHJpanMiO3M6ODoib3JkZXJfaWQiO3M6ODoiT3JkZXIrSUQiO3M6NDoidW5pdCI7czo3OiJFZW5oZWlkIjtzOjY6ImFkZF9vbiI7czoxMDoiVG9ldm9lZ2luZyI7czo2OiJtZXRob2QiO3M6NzoiTWV0aG9kZSI7czoxMjoicGF5bWVudF90eXBlIjtzOjE0OiJCZXRhbGluZ3N3aWp6ZSI7czoxNDoiYm9va2luZ19zdGF0dXMiO3M6MTQ6IkJvZWtpbmdzc3RhdHVzIjtzOjMwOiJhcHBvaW50bWVudF9tYXJrZWRfYXNfbm9fc2hvd24iO3M6NDA6IkFmc3ByYWFrK2dlbWFya2VlcmQrYWxzK25pZXQrd2VlcmdlZ2V2ZW4iO3M6Mjk6ImNhbmNlbGxlZF9ieV9zZXJ2aWNlX3Byb3ZpZGVyIjtzOjMyOiJHZWFubnVsZWVyZCtkb29yK3NlcnZpY2Vwcm92aWRlciI7czoyMToiY2FuY2VsbGVkX2J5X2N1c3RvbWVyIjtzOjIyOiJHZWFubnVsZWVyZCtkb29yK2tsYW50IjtzOjEwOiJzdGFydF9kYXRlIjtzOjExOiJCZWdpbitkYXR1bSI7czoxMDoic3RhcnRfdGltZSI7czo5OiJTdGFydHRpamQiO3M6MjA6InBheW1lbnRfdHJhbnNhY3Rpb25zIjtzOjIwOiJCZXRhbGluZ3N0cmFuc2FjdGllcyI7czoxMDoibXlfYWNjb3VudCI7czoxMzoiTWlqbityZWtlbmluZyI7czo0OiJuYW1lIjtzOjQ6Ik5hYW0iO3M6NjoidXBkYXRlIjtzOjk6IkJpandlcmtlbiI7czo4OiJjdXN0b21lciI7czo1OiJLbGFudCI7czo1OiJzdGFmZiI7czo5OiJQZXJzb25lZWwiO3M6MjA6InNjaGVkdWxlX2FwcG9pbnRtZW50IjtzOjE2OiJBZnNwcmFhaytwbGFubmVuIjtzOjEwOiJjb250YWN0X3VzIjtzOjIzOiJOZWVtK2NvbnRhY3QrbWV0K29ucytvcCI7czo4OiJmZWVkYmFjayI7czoxNDoidGVydWdrb3BwZWxpbmciO3M6NjoibG9nb3V0IjtzOjk6IlVpdGxvZ2dlbiI7czoxNDoiZW50ZXJfZmVlZGJhY2siO3M6MTY6IlZvZXIrZmVlZGJhY2sraW4iO3M6MTY6ImZldGNoaW5nX21ldGhvZHMiO3M6MTY6Ik1ldGhvZGVuK29waGFsZW4iO3M6MzY6InRoYW5rX3lvdV9mb3JfeW91cl92YWx1YWJsZV9mZWVkYmFjayI7czozNjoiQmVkYW5rdCt2b29yK2plK3dhYXJkZXZvbGxlK2ZlZWRiYWNrIjtzOjI1OiJ1bmFibGVfdG9fc3VibWl0X2ZlZWRiYWNrIjtzOjI3OiJLYW4rZ2VlbitmZWVkYmFjayt2ZXJ6ZW5kZW4iO3M6MjE6InBsZWFzZV9lbnRlcl9mZWVkYmFjayI7czoyODoiVm9lcithbHN0dWJsaWVmdCtmZWVkYmFjaytpbiI7czoxMzoibm90aWZpY2F0aW9ucyI7czo5OiJtZWxkaW5nZW4iO3M6MTk6Im5ld19ib29raW5nX3N1Y2Nlc3MiO3M6MjA6Ik5pZXV3K2JvZWtpbmdzc3VjY2VzIjtzOjIwOiJhY3Rpdml0eV9yZXNjaGVkdWxlZCI7czoyNjoiQWN0aXZpdGVpdCtvcG5pZXV3K2dlcGxhbmQiO3M6MTc6Im5vX3NlcnZpY2VzX2ZvdW5kIjtzOjIyOiJHZWVuK3NlcnZpY2VzK2dldm9uZGVuIjtzOjE2OiJhcGlfa2V5X21pc21hdGNoIjtzOjI5OiJBUEktc2xldXRlbCtrb210K25pZXQrb3ZlcmVlbiI7czoyMToicG9zdGFsX2NvZGVfbm90X2ZvdW5kIjtzOjIyOiJQb3N0Y29kZStuaWV0K2dldm9uZGVuIjtzOjE3OiJwb3N0YWxfY29kZV9mb3VuZCI7czoxNzoiUG9zdGNvZGUrZ2V2b25kZW4iO3M6Mjg6ImV4dHJhX3NlcnZpY2VzX25vdF9hdmFpbGFibGUiO3M6MzE6IkV4dHJhK2RpZW5zdGVuK25pZXQrYmVzY2hpa2JhYXIiO3M6MTg6Im5vX3VuaXRzX2F2YWlsYWJsZSI7czoyNToiR2VlbitlZW5oZWRlbitiZXNjaGlrYmFhciI7czoyODoibm9fZnJlcXVlbnRseV9kaXNjb3VudF9mb3VuZCI7czozMjoiRXIraXMrbmlldCt2YWFrK2tvcnRpbmcrZ2V2b25kZW4iO3M6MzU6ImluY29ycmVjdF9lbWFpbF9hZGRyZXNzX29yX3Bhc3N3b3JkIjtzOjMzOiJPbmp1aXN0K2UtbWFpbGFkcmVzK29mK3dhY2h0d29vcmQiO3M6MjE6Im5vX2FwcG9pbnRtZW50c19mb3VuZCI7czoyMzoiR2VlbithZnNwcmFrZW4rZ2V2b25kZW4iO3M6NDE6InlvdXJfYXBwb2ludG1lbnRfcmVzY2hlZHVsZWRfc3VjY2Vzc2Z1bGx5IjtzOjQxOiJKZSthZnNwcmFhaytpcyttZXQrc3VjY2VzK29wbmlldXcrZ2VwbGFuZCI7czoyNjoic29ycnlfd2VfYXJlX25vdF9hdmFpbGFibGUiO3M6MzQ6IlNvcnJ5JTJDK3dlK3ppam4rbmlldCtiZXNjaGlrYmFhci4iO3M6Mzk6InlvdXJfYXBwb2ludG1lbnRfY2FuY2VsbGVkX3N1Y2Nlc3NmdWxseSI7czoyNjoiSmUrYWZzcHJhYWsraXMrZ2Vhbm51bGVlcmQiO3M6MTk6ImNvdXBvbl9jb2RlX2V4cGlyZWQiO3M6MTk6IkNvdXBvbmNvZGUrdmVybG9wZW4iO3M6MTk6ImludmFsaWRfY291cG9uX2NvZGUiO3M6MjI6Ik9uZ2VsZGlnZStrb3J0aW5nc2NvZGUiO3M6Mjc6InBhcnRpYWxfZGVwb3NpdF9pc19kaXNhYmxlZCI7czo0MjoiR2VkZWVsdGVsaWprZSthYW5iZXRhbGluZytpcyt1aXRnZXNjaGFrZWxkIjtzOjU0OiJub25lX29mX3RpbWVfc2xvdF9hdmFpbGFibGVfcGxlYXNlX2NoZWNrX2Fub3RoZXJfZGF0ZXMiO3M6NjE6IkdlZW4rdmFuK2hldCtiZXNjaGlrYmFyZSt0aWpkc2xvdCtjb250cm9sZWVyK2RlK2FuZGVyZStkYXR1bXMiO3M6NDY6ImF2YWlsYWJpbGl0eV9pc19ub3RfY29uZmlndXJlZF9mcm9tX2FkbWluX3NpZGUiO3M6NjI6IkRlK2Jlc2NoaWtiYWFyaGVpZCtpcytuaWV0K2dlY29uZmlndXJlZXJkK3ZhbmFmK2RlK2JlaGVlcnppamRlIjtzOjI5OiJjdXN0b21lcl9jcmVhdGVkX3N1Y2Nlc3NmdWxseSI7czoyNjoiS2xhbnQraXMrc3VjY2Vzdm9sK2dlbWFha3QiO3M6MzE6ImVycm9yX29jY3VycmVkX3BsZWFzZV90cnlfYWdhaW4iO3M6MzE6IkZvdXQrb3BnZXRyZWRlbitwcm9iZWVyK29wbmlldXciO3M6MzE6ImFwcG9pbnRtZW50X2Jvb2tlZF9zdWNjZXNzZnVsbHkiO3M6Mjc6IkFmc3ByYWFrK21ldCtzdWNjZXMrZ2Vib2VrdCI7czoyNDoidXNlcl9kZXRhaWxzX25vdF91cGRhdGVkIjtzOjM0OiJHZWJydWlrZXJzZ2VnZXZlbnMrbmlldCtiaWpnZXdlcmt0IjtzOjM2OiJ1c2VyX25vdF9leGlzdF9wbGVhc2VfcmVnaXN0ZXJfZmlyc3QiO3M6NDI6IkdlYnJ1aWtlcitiZXN0YWF0K25pZXQlMkMrcmVnaXN0cmVlcitlZXJzdCI7czoxODoidXNlcl9hbHJlYWR5X2V4aXN0IjtzOjIwOiJHZWJydWlrZXIrYmVzdGFhdCthbCI7czoxNzoiaW52YWxpZF91c2VyX3R5cGUiO3M6MjM6Ik9uZ2VsZGlnK2dlYnJ1aWtlcnN0eXBlIjtzOjE0OiJub19zdGFmZl9mb3VuZCI7czoyMzoiR2VlbitwZXJzb25lZWwrZ2V2b25kZW4iO3M6MjA6Im5vX2RldGFpbHNfYXZhaWxhYmxlIjtzOjI0OiJHZWVuK2RldGFpbHMrYmVzY2hpa2JhYXIiO3M6MTY6InR5cGVfaXNfbWlzbWF0Y2giO3M6MjI6IlR5cGUra29tdCtuaWV0K292ZXJlZW4iO3M6MjA6InVwZGF0ZWRfc3VjY2Vzc2Z1bGx5IjtzOjE5OiJzdWNjZXN2b2wrZ2V1cGRhdGV0IjtzOjIwOiJzb21ldGhpbmdfd2VudF93cm9uZyI7czoyMjoiRXIraXMraWV0cytmb3V0K2dlZ2FhbiI7czozNjoicGxlYXNlX2NoZWNrX3lvdXJfY29uZmlybWVkX3Bhc3N3b3JkIjtzOjUwOiJDb250cm9sZWVyK2Fsc3R1YmxpZWZ0K3V3K2JldmVzdGlnZGUrd2FjaHR3b29yZCUyMSI7czoyMzoieW91cl9wYXNzd29yZF9ub3RfbWF0Y2giO3M6Mjk6IlV3K1BhYXN3b3JkK2tvbXQrbmlldCtvdmVyZWVuIjtzOjI0OiJub191cGNvbW1pbmdfYXBwb2ludG1lbnQiO3M6MjQ6IkdlZW4rYWFuc3RhYW5kZSthZnNwcmFhayI7czoxMToiZW1haWxfZXhpc3QiO3M6MTQ6IkUtbWFpbCtiZXN0YWF0IjtzOjIwOiJlbWFpbF9kb2VzX25vdF9leGlzdCI7czoxOToiRS1tYWlsK2Jlc3RhYXQrbmlldCI7czoxOToiaW52YWxpZF9jcmVkZW50aWFscyI7czoyMzoiT25nZWxkaWdlK2lubG9nZ2VnZXZlbnMiO3M6MTA6ImVtYWlsX3NlbmQiO3M6MTY6IkUtbWFpbCt2ZXJ6b25kZW4iO3M6MjA6ImVtYWlsX3NlbmRpbmdfZmFpbGVkIjtzOjI0OiJFLW1haWwrdmVyemVuZGVuK21pc2x1a3QiO3M6MTc6Im5vX29yZGVyc19kZXRhaWxzIjtzOjI1OiJHZWVuK2Jlc3RlbGxpbmdlbitkZXRhaWxzIjtzOjEwOiJtZXNzYWdlX2lzIjtzOjEwOiJCZXJpY2h0K2lzIjtzOjIwOiJwbGVhc2VfZW5hYmxlX3N0cmlwZSI7czoyNzoiQWN0aXZlZXIrYWxzdHVibGllZnQrU3RyaXBlIjtzOjE1OiJpbnZhbGlkX3JlcXVlc3QiO3M6MTY6Ik9uZ2VsZGlnK3ZlcnpvZWsiO3M6OToib3RwX21hdGNoIjtzOjk6Ik90cC1tYXRjaCI7czoxMzoib3RwX25vdF9tYXRjaCI7czoyMToiT3RwK2tvbXQrbmlldCtvdmVyZWVuIjtzOjE4OiJwYXNzd29yZF9pc19jaGFuZ2UiO3M6MjU6IldhY2h0d29vcmQraXMrdmVyYW5kZXJpbmciO3M6MTk6InBhc3N3b3JkX25vdF9jaGFuZ2UiO3M6MjU6IldhY2h0d29vcmQrdmVyYW5kZXJ0K25pZXQiO3M6NTY6ImFyZV95b3Vfc3VyZV95b3Vfd2FudF90b19jYW5jZWxfdGhpc19ib29raW5nX2FwcG9pbnRtZW50IjtzOjYwOiJXZWV0K2plK3pla2VyK2RhdCtqZStkZXplK2JvZWtpbmdzYWZzcHJhYWsrd2lsdCthbm51bGVyZW4lM0YiO3M6NToiYWxlcnQiO3M6NToiYWxhcm0iO3M6Mjoibm8iO3M6MzoiTmVlIjtzOjE1OiJ2ZXJpZnlfemlwX2NvZGUiO3M6MjI6IkNvbnRyb2xlZXIrZGUrcG9zdGNvZGUiO3M6MTE6InBvc3RhbF9jb2RlIjtzOjg6IlBvc3Rjb2RlIjtzOjMwOiJub19tZXRob2RfZm9yX3NlbGVjdGVkX3NlcnZpY2UiO3M6Mzk6IkdlZW4rbWV0aG9kZSt2b29yK2dlc2VsZWN0ZWVyZGUrc2VydmljZSI7czoyNDoicGxlYXNlX2VudGVyX3Bvc3RhbF9jb2RlIjtzOjE5OiJWb2VyK2RlK3Bvc3Rjb2RlK2luIjtzOjI5OiJub19hZGRvbnNfZm9yX3NlbGVjdGVkX21ldGhvZCI7czo0MToiR2VlbithZGQtb24rdm9vcitkZStnZXNlbGVjdGVlcmRlK21ldGhvZGUiO3M6MjM6InNlbGVjdF9hdGxlYXN0X29uZV91bml0IjtzOjQyOiJTZWxlY3RlZXIrdGVuK21pbnN0ZSslQzMlQTklQzMlQTluK2VlbmhlaWQiO3M6MTg6InNlbGVjdF9hbnlfcGFja2FnZSI7czoyMDoiU2VsZWN0ZWVyK2VlbitwYWtrZXQiO3M6MTE6InBsZWFzZV93YWl0IjtzOjE1OiJFdmVuK2dlZHVsZCthdWIiO30=' WHERE `language`='de_DE'";
		mysqli_query($this->conn, $update_app_de_DE_lang);
		$update_app_es_ES_lang = "UPDATE `ct_languages` SET `app_labels`='YToxNzg6e3M6Nzoid2VsY29tZSI7czoxMDoiQmllbnZlbmlkbyI7czoyODoibWFrZV95b3VyX29ubGluZV9hcHBvaW50bWVudCI7czoxODoiSGF6K3R1K2NpdGErb25saW5lIjtzOjQ6InNraXAiO3M6NjoiT01JVElSIjtzOjEwOiJzY2hlZHVsaW5nIjtzOjE3OiJQcm9ncmFtYWNpJUMzJUIzbiI7czo1MDoibWFrZV95b3VyX29ubGluZV9hcHBvaW50bWVudF9zY2hlZHVsaW5nX3N1cGVyX2Vhc3kiO3M6NjU6IkhhZ2Erc3UrcHJvZ3JhbWFjaSVDMyVCM24rZGUrY2l0YXMrZW4rbCVDMyVBRG5lYStzdXBlcitmJUMzJUExY2lsIjtzOjExOiJnZXRfc3RhcnRlZCI7czo3OiJFbXBlemFyIjtzOjQyOiJnZXRfc3RhcnRlZF9ieV9sb2dnaW5nX2luX29yX2J5X3NpZ25pbmdfdXAiO3M6NTE6IkNvbWllbnphK2luaWNpYW5kbytzZXNpJUMzJUIzbitvK3JlZ2lzdHIlQzMlQTFuZG90ZSI7czo3OiJzaWduX2luIjtzOjExOiJSZWdpc3RyYXJzZSI7czoxNjoiZW50ZXJfeW91cl9lbWFpbCI7czozNjoiSW50cm9kdWNlK3R1K2NvcnJlbytlbGVjdHIlQzMlQjNuaWNvIjtzOjE0OiJlbnRlcl9wYXNzd29yZCI7czoyOToiSW50cm9kdWNpcitsYStjb250cmFzZSVDMyVCMWEiO3M6MTU6ImZvcmdvdF9wYXNzd29yZCI7czo0NToiJUMyJUJGU2UrdGUrb2x2aWQlQzMlQjMrdHUrY29udHJhc2UlQzMlQjFhJTNGIjtzOjU6ImxvZ2luIjtzOjE5OiJJbmljaWFyK3Nlc2klQzMlQjNuIjtzOjI1OiJkb250X2hhdmVfYWNjb3VudF9zaWduX3VwIjtzOjQxOiIlQzIlQkZObyt0aWVuZXMrY3VlbnRhJTNGK1JlZyVDMyVBRHN0cmF0ZSI7czoyNDoiZW50ZXJfZW1haWxfYW5kX3Bhc3N3b3JkIjtzOjU4OiJJbnRyb2R1emNhK2VsK2NvcnJlbytlbGVjdHIlQzMlQjNuaWNvK3krbGErY29udHJhc2UlQzMlQjFhIjtzOjcxOiJwbGVhc2VfZW50ZXJfeW91cl9yZWdpc3RlcmVkX2VtYWlsX2lkX3dlX3dpbGxfc2VuZF9vdHBfdG9feW91cl9lbWFpbF9pZCI7czoxMTk6IlBvcitmYXZvciUyQytpbnRyb2R1emNhK3N1K0lEK2RlK2NvcnJlbytlbGVjdHIlQzMlQjNuaWNvK3JlZ2lzdHJhZG8uK0VudmlhcmVtb3MrT1RQK2Erc3UrSUQrZGUrY29ycmVvK2VsZWN0ciVDMyVCM25pY28uIjtzOjE0OiJlbnRlcl95b3VyX290cCI7czoxNDoiSW5ncmVzZStzdStPVFAiO3M6ODoic2VuZF9vdHAiO3M6MTA6IkVudmlhcitPVFAiO3M6MTY6ImN1cnJlbnRfcGFzc3dvcmQiO3M6MjI6ImNvbnRyYXNlJUMzJUIxYSthY3R1YWwiO3M6MTI6Im5ld19wYXNzd29yZCI7czoyMToiTnVldmErY29udHJhc2UlQzMlQjFhIjtzOjE2OiJjb25maXJtX3Bhc3N3b3JkIjtzOjI1OiJDb25maXJtYXIrY29udHJhc2UlQzMlQjFhIjtzOjExOiJzZXJ2ZXJfZG93biI7czoxNDoiU2Vydmlkb3IrY2FpZG8iO3M6MTA6InZlcmlmeV9vdHAiO3M6MTM6IlZlcmlmaWNhcitPVFAiO3M6NjoiY2xpZW50IjtzOjc6IkNsaWVudGUiO3M6MTc6InVwZGF0aW5nX3Bhc3N3b3JkIjtzOjI4OiJBY3R1YWxpemFuZG8rY29udHJhc2UlQzMlQjFhIjtzOjI5OiJwYXNzd29yZF91cGRhdGVkX3N1Y2Nlc3NmdWxseSI7czo0MDoiQ29udHJhc2UlQzMlQjFhK2FjdHVhbGl6YWRhK2V4aXRvc2FtZW50ZSI7czoxNzoicGFzc3dvcmRfbWlzbWF0Y2giO3M6Mjc6IkNvbnRyYXNlJUMzJUIxYStubytjb2luY2lkZSI7czoyMjoiaW5jb3JyZWN0X29sZF9wYXNzd29yZCI7czozNDoiQ29udHJhc2UlQzMlQjFhK2FudGlndWEraW5jb3JyZWN0YSI7czoyMjoicGxlYXNlX2ZpbGxfYWxsX2ZpZWxkcyI7czozNDoiUG9yK2Zhdm9yK2xsZW5hK3RvZG9zK2xvcytlc3BhY2lvcyI7czo2OiJzdWJtaXQiO3M6MzQ6IlBvcitmYXZvcitsbGVuYSt0b2Rvcytsb3MrZXNwYWNpb3MiO3M6MTA6ImZpcnN0X25hbWUiO3M6MTQ6Ik5vbWJyZStkZStwaWxhIjtzOjk6Imxhc3RfbmFtZSI7czo4OiJBcGVsbGlkbyI7czo1OiJlbWFpbCI7czo1OiJFbWFpbCI7czo1OiJwaG9uZSI7czoxMzoiVGVsJUMzJUE5Zm9ubyI7czo3OiJhZGRyZXNzIjtzOjE0OiJEaXJlY2NpJUMzJUIzbiI7czo0OiJjaXR5IjtzOjY6IkNpdWRhZCI7czo3OiJjb3VudHJ5IjtzOjk6IlBhJUMzJUFEcyI7czo4OiJwb3N0Y29kZSI7czoxODoiQyVDMyVCM2RpZ28rcG9zdGFsIjtzOjg6InBhc3N3b3JkIjtzOjE1OiJDb250cmFzZSVDMyVCMWEiO3M6Nzoic2lnbl91cCI7czoxNToiUmVnJUMzJUFEc3RyYXRlIjtzOjIzOiJhbHJlYWR5X2hhdmVfYW5fYWNjb3VudCI7czoyOToiJUMyJUJGWWErdGllbmVzK3VuYStjdWVudGElM0YiO3M6NDoiaG9tZSI7czo0OiJDYXNhIjtzOjEwOiJ3ZWxjb21lX3RvIjtzOjEyOiJCaWVudmVuaWRvK2EiO3M6MTE6Im5ld19ib29raW5nIjtzOjEzOiJOdWV2YStyZXNlcnZhIjtzOjExOiJteV9ib29raW5ncyI7czoxMjoiTWlzK3Jlc2VydmFzIjtzOjE1OiJteV90cmFuc2FjdGlvbnMiO3M6MTc6Ik1pcyt0cmFuc2FjY2lvbmVzIjtzOjExOiJteV9zZXR0aW5ncyI7czoyMToiTWkrY29uZmlndXJhY2klQzMlQjNuIjtzOjQyOiJ3aGVyZV93b3VsZF95b3VfbGlrZV91c190b19wcm92aWRlX3NlcnZpY2UiO3M6NjI6IiVDMiVCRkQlQzMlQjNuZGUrbGUrZ3VzdGFyJUMzJUFEYStxdWUrbGUrcHJlc3RlbW9zK3NlcnZpY2lvJTNGIjtzOjIxOiJwbGVhc2VfY2hvb3NlX3NlcnZpY2UiO3M6Mjc6IlBvcitmYXZvcitlbGlqYStlbCtzZXJ2aWNpbyI7czo4OiJwcmV2aW91cyI7czo4OiJBbnRlcmlvciI7czo0OiJuZXh0IjtzOjk6IlNpZ3VpZW50ZSI7czo3OiJzZXJ2aWNlIjtzOjg6IlNlcnZpY2lvIjtzOjQ6ImNvc3QiO3M6NToiQ29zdG8iO3M6MjA6InBsZWFzZV9zZWxlY3RfbWV0aG9kIjtzOjM1OiJQb3IrZmF2b3Irc2VsZWNjaW9uZStlbCttJUMzJUE5dG9kbyI7czoyMDoicGxlYXNlX3NlbGVjdF9vZmZlcnMiO3M6MTg6IlNlbGVjY2lvbmUrT2ZlcnRhcyI7czoxODoicGxlYXNlX3NlbGVjdF90aW1lIjtzOjI3OiJQb3IrZmF2b3Irc2VsZWNjaW9uZStUaWVtcG8iO3M6MjA6InBsZWFzZV9zZWxlY3RfYWRkb25zIjtzOjMzOiJQb3IrZmF2b3Irc2VsZWNjaW9uZStDb21wbGVtZW50b3MiO3M6NzoibW9udGhseSI7czo3OiJNZW5zdWFsIjtzOjk6ImJpX3dlZWtseSI7czo5OiJCaStXZWVrbHkiO3M6Njoid2Vla2x5IjtzOjc6IlNlbWFuYWwiO3M6NDoib25jZSI7czo3OiJVbmErdmV6IjtzOjE4OiJwbGVhc2Vfc2VsZWN0X2RhdGUiO3M6MjY6IlBvcitmYXZvcitzZWxlY2Npb25lK2ZlY2hhIjtzOjQ6ImRhdGUiO3M6NToiRmVjaGEiO3M6MjI6InBsZWFzZV9zZWxlY3RfcHJvdmlkZXIiO3M6MzA6IlBvcitmYXZvcitzZWxlY2Npb25lK3Byb3ZlZWRvciI7czo0OiJ0aW1lIjtzOjQ6IkhvcmEiO3M6MTM6ImluY2x1ZGluZ190YXgiO3M6MTk6IkluY2x1eWVuZG8raW1wdWVzdG8iO3M6MjQ6InByZWZlcnJlZF9wYXltZW50X21ldGhvZCI7czoyOToiTSVDMyVBOXRvZG8rZGUrcGFnbytwcmVmZXJpZG8iO3M6MTE6ImxvY2FsbHlfcGF5IjtzOjE2OiJQYWdhcitsb2NhbG1lbnRlIjtzOjI1OiJjcmVkaXRfZGViaXRfY2FyZF9wYXltZW50IjtzOjQ4OiJQYWdvK2Nvbit0YXJqZXRhK2RlK2NyJUMzJUE5ZGl0byslMkYrZCVDMyVBOWJpdG8iO3M6NjoiY2FuY2VsIjtzOjg6IkNhbmNlbGFyIjtzOjI1OiJjcmVkaXRfZGViaXRfY2FyZF9kZXRhaWxzIjtzOjU0OiJEZXRhbGxlcytkZStsYSt0YXJqZXRhK2RlK2NyJUMzJUE5ZGl0byslMkYrZCVDMyVBOWJpdG8iO3M6MTI6InNlcnZpY2VfbmFtZSI7czoxOToiTm9tYnJlK2RlbCtTZXJ2aWNpbyI7czoxMjoiYm9va2luZ19kYXRlIjtzOjIyOiJGZWNoYStwYXJhK3JlZ2lzdHJhcnNlIjtzOjExOiJjYXJ0X2Ftb3VudCI7czoxNzoiQ2FudGlkYWQrZGUrY2Fycm8iO3M6MTY6ImJvb2tfYXBwb2ludG1lbnQiO3M6MTc6IlJlc2VydmFyK3VuYStjaXRhIjtzOjExOiJjYXJkX251bWJlciI7czoyMjoiTiVDMyVCQW1lcm8rZGUrdGFyamV0YSI7czoxMjoiZXhwaXJ5X21vbnRoIjtzOjIwOiJNZXNlcytkZSt2ZW5jaW1pZW50byI7czoxMToiZXhwaXJ5X3llYXIiO3M6Mjc6IkElQzMlQjFvK2RlK2V4cGlyYWNpJUMzJUIzbiI7czoxNToiYm9va2luZ19zdW1tYXJ5IjtzOjIxOiJSZXN1bWVuK2RlK2xhK3Jlc2VydmEiO3M6ODoiY2FyZF9jdmMiO3M6MTE6IlRhcmpldGErQ1ZDIjtzOjM6ImFsbCI7czo1OiJUb2RvcyI7czo0OiJwYXN0IjtzOjY6IlBhc2FkbyI7czo4OiJ1cGNvbWluZyI7czoxMjoiUHIlQzMlQjN4aW1vIjtzOjE3OiJub19kYXRhX2F2YWlsYWJsZSI7czoyMDoiRGF0b3Mrbm8rZGlzcG9uaWJsZXMiO3M6OToiY29uZmlybWVkIjtzOjEwOiJDb25maXJtYWRvIjtzOjg6InJlamVjdGVkIjtzOjk6IlJlY2hhemFkbyI7czo3OiJwZW5kaW5nIjtzOjk6IlBlbmRpZW50ZSI7czo5OiJjYW5jZWxsZWQiO3M6OToiQ2FuY2VsYWRvIjtzOjEwOiJyZXNjaGVkdWxlIjtzOjExOiJSZXByb2dyYW1hciI7czo3OiJub19zaG93IjtzOjc6Ik5vK3Nob3ciO3M6NzoiZGV0YWlscyI7czo4OiJEZXRhbGxlcyI7czoxNzoibG9hZGluZ19tb3JlX2RhdGEiO3M6MjM6IkNhcmdhbmRvK20lQzMlQTFzK2RhdG9zIjtzOjk6ImRhc2hib2FyZCI7czo3OiJUYWJsZXJvIjtzOjU6InByaWNlIjtzOjY6IlByZWNpbyI7czo4OiJvcmRlcl9pZCI7czoxMjoiU29saWNpdGFyK0lEIjtzOjQ6InVuaXQiO3M6NjoiVW5pZGFkIjtzOjY6ImFkZF9vbiI7czoxMToiQSVDMyVCMWFkaXIiO3M6NjoibWV0aG9kIjtzOjExOiJNJUMzJUE5dG9kbyI7czoxMjoicGF5bWVudF90eXBlIjtzOjEyOiJUaXBvK2RlK3BhZ28iO3M6MTQ6ImJvb2tpbmdfc3RhdHVzIjtzOjI5OiJFc3RhZG8rZGUrbGErcmVzZXJ2YWNpJUMzJUIzbiI7czozMDoiYXBwb2ludG1lbnRfbWFya2VkX2FzX25vX3Nob3duIjtzOjMxOiJDaXRhK21hcmNhZGErY29tbytubytzZSttdWVzdHJhIjtzOjI5OiJjYW5jZWxsZWRfYnlfc2VydmljZV9wcm92aWRlciI7czozOToiQ2FuY2VsYWRvK3BvcitlbCtwcm92ZWVkb3IrZGUrc2VydmljaW9zIjtzOjIxOiJjYW5jZWxsZWRfYnlfY3VzdG9tZXIiO3M6MjQ6IkNhbmNlbGFkbytwb3IrZWwrY2xpZW50ZSI7czoxMDoic3RhcnRfZGF0ZSI7czoxNToiRmVjaGErZGUraW5pY2lvIjtzOjEwOiJzdGFydF90aW1lIjtzOjE0OiJIb3JhK2RlK2luaWNpbyI7czoyMDoicGF5bWVudF90cmFuc2FjdGlvbnMiO3M6MjE6IlRyYW5zYWNjaW9uZXMrZGUrcGFnbyI7czoxMDoibXlfYWNjb3VudCI7czo5OiJNaStjdWVudGEiO3M6NDoibmFtZSI7czo2OiJOb21icmUiO3M6NjoidXBkYXRlIjtzOjEwOiJBY3R1YWxpemFyIjtzOjg6ImN1c3RvbWVyIjtzOjc6IkNsaWVudGUiO3M6NToic3RhZmYiO3M6ODoiUGVyc29uYWwiO3M6MjA6InNjaGVkdWxlX2FwcG9pbnRtZW50IjtzOjE4OiJQcm9ncmFtYXIrdW5hK2NpdGEiO3M6MTA6ImNvbnRhY3RfdXMiO3M6MTY6IkNvbnQlQzMlQTFjdGVub3MiO3M6ODoiZmVlZGJhY2siO3M6MTk6IlJlYWxpbWVudGFjaSVDMyVCM24iO3M6NjoibG9nb3V0IjtzOjE4OiJDZXJyYXIrc2VzaSVDMyVCM24iO3M6MTQ6ImVudGVyX2ZlZWRiYWNrIjtzOjMwOiJJbmdyZXNlK3JldHJvYWxpbWVudGFjaSVDMyVCM24iO3M6MTY6ImZldGNoaW5nX21ldGhvZHMiO3M6MjA6Ik1ldG9kb3MrZGUrY2FwdGFjaW9uIjtzOjM2OiJ0aGFua195b3VfZm9yX3lvdXJfdmFsdWFibGVfZmVlZGJhY2siO3M6MzY6IkdyYWNpYXMrcG9yK3N1cyt2YWxpb3Nvcytjb21lbnRhcmlvcyI7czoyNToidW5hYmxlX3RvX3N1Ym1pdF9mZWVkYmFjayI7czozMDoiTm8rc2UrcHVlZGUrZW52aWFyK2NvbWVudGFyaW9zIjtzOjIxOiJwbGVhc2VfZW50ZXJfZmVlZGJhY2siO3M6MzM6IlBvcitmYXZvcitpbmdyZXNlK3N1cytjb21lbnRhcmlvcyI7czoxMzoibm90aWZpY2F0aW9ucyI7czoxNDoiTm90aWZpY2FjaW9uZXMiO3M6MTk6Im5ld19ib29raW5nX3N1Y2Nlc3MiO3M6Mjc6Ik51ZXZvKyVDMyVBOXhpdG8rZGUrcmVzZXJ2YSI7czoyMDoiYWN0aXZpdHlfcmVzY2hlZHVsZWQiO3M6MjI6IkFjdGl2aWRhZCtyZXByb2dyYW1hZGEiO3M6MTc6Im5vX3NlcnZpY2VzX2ZvdW5kIjtzOjI3OiJObytzZStlbmNvbnRyYXJvbitzZXJ2aWNpb3MiO3M6MTY6ImFwaV9rZXlfbWlzbWF0Y2giO3M6MjI6IkRlc2FqdXN0ZStkZStjbGF2ZStBUEkiO3M6MjE6InBvc3RhbF9jb2RlX25vdF9mb3VuZCI7czozMjoiQyVDMyVCM2RpZ28rcG9zdGFsK25vK2VuY29udHJhZG8iO3M6MTc6InBvc3RhbF9jb2RlX2ZvdW5kIjtzOjI5OiJDJUMzJUIzZGlnbytwb3N0YWwrZW5jb250cmFkbyI7czoyODoiZXh0cmFfc2VydmljZXNfbm90X2F2YWlsYWJsZSI7czozNjoiU2VydmljaW9zK2FkaWNpb25hbGVzK25vK2Rpc3BvbmlibGVzIjtzOjE4OiJub191bml0c19hdmFpbGFibGUiO3M6Mjc6Ik5vK2hheSt1bmlkYWRlcytkaXNwb25pYmxlcyI7czoyODoibm9fZnJlcXVlbnRseV9kaXNjb3VudF9mb3VuZCI7czo0MzoiTm8rc2UrZW5jdWVudHJhK2ZyZWN1ZW50ZW1lbnRlK2VsK2Rlc2N1ZW50byI7czozNToiaW5jb3JyZWN0X2VtYWlsX2FkZHJlc3Nfb3JfcGFzc3dvcmQiO3M6NzA6IkRpcmVjY2klQzMlQjNuK2RlK2NvcnJlbytlbGVjdHIlQzMlQjNuaWNvK28rY29udHJhc2UlQzMlQjFhK2luY29ycmVjdGEiO3M6MjE6Im5vX2FwcG9pbnRtZW50c19mb3VuZCI7czoyMzoiTm8rc2UrZW5jb250cmFyb24rY2l0YXMiO3M6NDE6InlvdXJfYXBwb2ludG1lbnRfcmVzY2hlZHVsZWRfc3VjY2Vzc2Z1bGx5IjtzOjMzOiJUdStjaXRhK3JlcHJvZ3JhbWFkYStleGl0b3NhbWVudGUiO3M6MjY6InNvcnJ5X3dlX2FyZV9ub3RfYXZhaWxhYmxlIjtzOjM4OiJMbytzZW50aW1vcyUyQytubytlc3RhbW9zK2Rpc3BvbmlibGVzLiI7czozOToieW91cl9hcHBvaW50bWVudF9jYW5jZWxsZWRfc3VjY2Vzc2Z1bGx5IjtzOjMwOiJUdStjaXRhK2NhbmNlbGFkYStleGl0b3NhbWVudGUiO3M6MTk6ImNvdXBvbl9jb2RlX2V4cGlyZWQiO3M6MzQ6IkMlQzMlQjNkaWdvK2RlK2N1cCVDMyVCM24rY2FkdWNhZG8iO3M6MTk6ImludmFsaWRfY291cG9uX2NvZGUiO3M6Mzk6IkMlQzMlQjNkaWdvK2RlK2N1cCVDMyVCM24raW52JUMzJUExbGlkbyI7czoyNzoicGFydGlhbF9kZXBvc2l0X2lzX2Rpc2FibGVkIjtzOjQ4OiJFbCtkZXAlQzMlQjNzaXRvK3BhcmNpYWwrZXN0JUMzJUExK2Rlc2hhYmlsaXRhZG8iO3M6NTQ6Im5vbmVfb2ZfdGltZV9zbG90X2F2YWlsYWJsZV9wbGVhc2VfY2hlY2tfYW5vdGhlcl9kYXRlcyI7czo2NToiTmluZ3VubytkZStsb3MraG9yYXJpb3MrZGlzcG9uaWJsZXMrcG9yK2Zhdm9yK3JldmlzZStvdHJhcytmZWNoYXMiO3M6NDY6ImF2YWlsYWJpbGl0eV9pc19ub3RfY29uZmlndXJlZF9mcm9tX2FkbWluX3NpZGUiO3M6NzQ6IkxhK2Rpc3BvbmliaWxpZGFkK25vK2VzdCVDMyVBMStjb25maWd1cmFkYStkZXNkZStlbCtsYWRvK2RlbCthZG1pbmlzdHJhZG9yIjtzOjI5OiJjdXN0b21lcl9jcmVhdGVkX3N1Y2Nlc3NmdWxseSI7czoyNzoiQ2xpZW50ZStjcmVhZG8rZXhpdG9zYW1lbnRlIjtzOjMxOiJlcnJvcl9vY2N1cnJlZF9wbGVhc2VfdHJ5X2FnYWluIjtzOjQ4OiJPY3VycmklQzMlQjMrdW4rZXJyb3IrcG9yK2Zhdm9yK2ludGVudGUrZGUrbnVldm8iO3M6MzE6ImFwcG9pbnRtZW50X2Jvb2tlZF9zdWNjZXNzZnVsbHkiO3M6Mjc6IkNpdGErcmVzZXJ2YWRhK2V4aXRvc2FtZW50ZSI7czoyNDoidXNlcl9kZXRhaWxzX25vdF91cGRhdGVkIjtzOjM1OiJEZXRhbGxlcytkZSt1c3VhcmlvK25vK2FjdHVhbGl6YWRvcyI7czozNjoidXNlcl9ub3RfZXhpc3RfcGxlYXNlX3JlZ2lzdGVyX2ZpcnN0IjtzOjU3OiJFbCt1c3VhcmlvK25vK2V4aXN0ZSUyQytwb3IrZmF2b3IrcmVnJUMzJUFEc3RyZXNlK3ByaW1lcm8iO3M6MTg6InVzZXJfYWxyZWFkeV9leGlzdCI7czoyMDoiVXN1YXJpbyt5YStleGlzdGVudGUiO3M6MTc6ImludmFsaWRfdXNlcl90eXBlIjtzOjMwOiJUaXBvK2RlK3VzdWFyaW8rbm8rdiVDMyVBMWxpZG8iO3M6MTQ6Im5vX3N0YWZmX2ZvdW5kIjtzOjI4OiJObytzZStlbmNvbnRyJUMzJUIzK3BlcnNvbmFsIjtzOjIwOiJub19kZXRhaWxzX2F2YWlsYWJsZSI7czoyNzoiTm8raGF5K2RldGFsbGVzK2Rpc3BvbmlibGVzIjtzOjE2OiJ0eXBlX2lzX21pc21hdGNoIjtzOjE3OiJUaXBvK2VzK2Rlc2FqdXN0ZSI7czoyMDoidXBkYXRlZF9zdWNjZXNzZnVsbHkiO3M6MjQ6IkFjdHVhbGl6YWRvK2V4aXRvc2FtZW50ZSI7czoyMDoic29tZXRoaW5nX3dlbnRfd3JvbmciO3M6MTk6IkFsZ28rc2FsaSVDMyVCMyttYWwiO3M6MzY6InBsZWFzZV9jaGVja195b3VyX2NvbmZpcm1lZF9wYXNzd29yZCI7czo1NToiUG9yK2Zhdm9yJTJDK2NvbXBydWViZStzdStjb250cmFzZSVDMyVCMWErY29uZmlybWFkYSUyMSI7czoyMzoieW91cl9wYXNzd29yZF9ub3RfbWF0Y2giO3M6MzA6IlR1K2NvbnRyYXNlJUMzJUIxYStubytjb2luY2lkZSI7czoyNDoibm9fdXBjb21taW5nX2FwcG9pbnRtZW50IjtzOjE1OiJTaW4rY2l0YStwcmV2aWEiO3M6MTE6ImVtYWlsX2V4aXN0IjtzOjMwOiJDb3JyZW8rZWxlY3RyJUMzJUIzbmljbytleGlzdGUiO3M6MjA6ImVtYWlsX2RvZXNfbm90X2V4aXN0IjtzOjM2OiJFbCtjb3JyZW8rZWxlY3RyJUMzJUIzbmljbytubytleGlzdGUiO3M6MTk6ImludmFsaWRfY3JlZGVudGlhbHMiO3M6Mjg6IkNyZWRlbmNpYWxlcytubyt2JUMzJUExbGlkYXMiO3M6MTA6ImVtYWlsX3NlbmQiO3M6MzA6IkVudmlhcitjb3JyZW8rZWxlY3RyJUMzJUIzbmljbyI7czoyMDoiZW1haWxfc2VuZGluZ19mYWlsZWQiO3M6NTE6IkVsK2VudiVDMyVBRG8rZGUrY29ycmVvK2VsZWN0ciVDMyVCM25pY28rZmFsbCVDMyVCMyI7czoxNzoibm9fb3JkZXJzX2RldGFpbHMiO3M6MjY6Ik5vK2hheStkZXRhbGxlcytkZStwZWRpZG9zIjtzOjEwOiJtZXNzYWdlX2lzIjtzOjEzOiJFbCttZW5zYWplK2VzIjtzOjIwOiJwbGVhc2VfZW5hYmxlX3N0cmlwZSI7czoyNzoiUG9yK2Zhdm9yJTJDK2FjdGl2ZStsYStyYXlhIjtzOjE1OiJpbnZhbGlkX3JlcXVlc3QiO3M6MjQ6IlNvbGljaXR1ZCtubyt2JUMzJUExbGlkYSI7czo5OiJvdHBfbWF0Y2giO3M6MTE6IlBhcnRpZG8rb3RwIjtzOjEzOiJvdHBfbm90X21hdGNoIjtzOjE1OiJPdHArbm8rY29pbmNpZGUiO3M6MTg6InBhc3N3b3JkX2lzX2NoYW5nZSI7czoyODoiTGErY29udHJhc2UlQzMlQjFhK2VzK2NhbWJpbyI7czoxOToicGFzc3dvcmRfbm90X2NoYW5nZSI7czoyNjoiQ29udHJhc2UlQzMlQjFhK25vK2NhbWJpYXIiO3M6NTY6ImFyZV95b3Vfc3VyZV95b3Vfd2FudF90b19jYW5jZWxfdGhpc19ib29raW5nX2FwcG9pbnRtZW50IjtzOjU3OiIlQzIlQkZTZWd1cm8rcXVlK3F1aWVyZXMrY2FuY2VsYXIrZXN0YStjaXRhK2RlK3Jlc2VydmElM0YiO3M6NToiYWxlcnQiO3M6NjoiQWxlcnRhIjtzOjI6Im5vIjtzOjI6Ik5vIjtzOjE1OiJ2ZXJpZnlfemlwX2NvZGUiO3M6MzE6IlZlcmlmaWNhcitlbCtjJUMzJUIzZGlnbytwb3N0YWwiO3M6MTE6InBvc3RhbF9jb2RlIjtzOjE4OiJDJUMzJUIzZGlnbytwb3N0YWwiO3M6MzA6Im5vX21ldGhvZF9mb3Jfc2VsZWN0ZWRfc2VydmljZSI7czo0ODoiTm8raGF5K20lQzMlQTl0b2RvK3BhcmErZWwrc2VydmljaW8rc2VsZWNjaW9uYWRvIjtzOjI0OiJwbGVhc2VfZW50ZXJfcG9zdGFsX2NvZGUiO3M6Mzk6IlBvcitmYXZvcitpbmdyZXNlK2VsK2MlQzMlQjNkaWdvK3Bvc3RhbCI7czoyOToibm9fYWRkb25zX2Zvcl9zZWxlY3RlZF9tZXRob2QiO3M6NTI6Ik5vK2hheStjb21wbGVtZW50b3MrcGFyYStlbCttJUMzJUE5dG9kbytzZWxlY2Npb25hZG8iO3M6MjM6InNlbGVjdF9hdGxlYXN0X29uZV91bml0IjtzOjMwOiJTZWxlY2Npb25lK2FsK21lbm9zK3VuYSt1bmlkYWQiO3M6MTg6InNlbGVjdF9hbnlfcGFja2FnZSI7czoyODoiU2VsZWNjaW9uZStjdWFscXVpZXIrcGFxdWV0ZSI7czoxMToicGxlYXNlX3dhaXQiO3M6MTY6IlBvcitmYXZvcitlc3BlcmEiO30=' WHERE `language`='es_ES'";
		mysqli_query($this->conn, $update_app_es_ES_lang);
		$update_app_fr_FR_lang = "UPDATE `ct_languages` SET `app_labels`='YToxNzg6e3M6Nzoid2VsY29tZSI7czo5OiJCaWVudmVudWUiO3M6Mjg6Im1ha2VfeW91cl9vbmxpbmVfYXBwb2ludG1lbnQiO3M6MzM6IlByZW5leit2b3RyZStyZW5kZXotdm91cytlbitsaWduZSI7czo0OiJza2lwIjtzOjY6IlNBVVRFUiI7czoxMDoic2NoZWR1bGluZyI7czoxMDoiQ2FsZW5kcmllciI7czo1MDoibWFrZV95b3VyX29ubGluZV9hcHBvaW50bWVudF9zY2hlZHVsaW5nX3N1cGVyX2Vhc3kiO3M6NDY6IlJlbmRleit2b3RyZStyZW5kZXotdm91cytlbitsaWduZStzdXBlcitmYWNpbGUiO3M6MTE6ImdldF9zdGFydGVkIjtzOjk6IkNvbW1lbmNlciI7czo0MjoiZ2V0X3N0YXJ0ZWRfYnlfbG9nZ2luZ19pbl9vcl9ieV9zaWduaW5nX3VwIjtzOjUwOiJDb21tZW5jZXorZW4rdm91cytjb25uZWN0YW50K291K2VuK3ZvdXMraW5zY3JpdmFudCI7czo3OiJzaWduX2luIjtzOjEyOiJTZStjb25uZWN0ZXIiO3M6MTY6ImVudGVyX3lvdXJfZW1haWwiO3M6MTg6IkVudHJlcit2b3RyZStFbWFpbCI7czoxNDoiZW50ZXJfcGFzc3dvcmQiO3M6MjI6IkVudHJlcitsZSttb3QrZGUrcGFzc2UiO3M6MTU6ImZvcmdvdF9wYXNzd29yZCI7czoyNzoiTW90K2RlK3Bhc3NlK291YmxpJUMzJUE5JTNGIjtzOjU6ImxvZ2luIjtzOjE0OiJTJTI3aWRlbnRpZmllciI7czoyNToiZG9udF9oYXZlX2FjY291bnRfc2lnbl91cCI7czo0MzoiVm91cytuJTI3YXZleitwYXMrZGUrY29tcHRlJTNGK1MlMjdpbnNjcmlyZSI7czoyNDoiZW50ZXJfZW1haWxfYW5kX3Bhc3N3b3JkIjtzOjI4OiJFbnRyZXIrZW1haWwrZXQrbW90K2RlK3Bhc3NlIjtzOjcxOiJwbGVhc2VfZW50ZXJfeW91cl9yZWdpc3RlcmVkX2VtYWlsX2lkX3dlX3dpbGxfc2VuZF9vdHBfdG9feW91cl9lbWFpbF9pZCI7czoxMTU6IlZldWlsbGV6K2VudHJlcit2b3RyZStpZGVudGlmaWFudCtlbWFpbCtlbnJlZ2lzdHIlQzMlQTkuK25vdXMrZW52ZXJyb25zK09UUCslQzMlQTArdm90cmUrYWRyZXNzZSslQzMlQTlsZWN0cm9uaXF1ZS4iO3M6MTQ6ImVudGVyX3lvdXJfb3RwIjtzOjE2OiJFbnRyZXordm90cmUrT1RQIjtzOjg6InNlbmRfb3RwIjtzOjExOiJFbnZveWVyK09UUCI7czoxNjoiY3VycmVudF9wYXNzd29yZCI7czoxOToiTW90K2RlK3Bhc3NlK2FjdHVlbCI7czoxMjoibmV3X3Bhc3N3b3JkIjtzOjIwOiJub3V2ZWF1K21vdCtkZStwYXNzZSI7czoxNjoiY29uZmlybV9wYXNzd29yZCI7czoyNToiQ29uZmlybWV6K2xlK21vdCtkZStwYXNzZSI7czoxMToic2VydmVyX2Rvd24iO3M6MjA6IlNlcnZldXIraG9ycy1zZXJ2aWNlIjtzOjEwOiJ2ZXJpZnlfb3RwIjtzOjE3OiJWJUMzJUE5cmlmaWVyK09UUCI7czo2OiJjbGllbnQiO3M6NjoiQ2xpZW50IjtzOjE3OiJ1cGRhdGluZ19wYXNzd29yZCI7czozMjoiTWlzZSslQzMlQTAram91citkdSttb3QrZGUrcGFzc2UiO3M6Mjk6InBhc3N3b3JkX3VwZGF0ZWRfc3VjY2Vzc2Z1bGx5IjtzOjQ1OiJNb3QrZGUrcGFzc2UrbWlzKyVDMyVBMCtqb3VyK2F2ZWMrc3VjYyVDMyVBOHMiO3M6MTc6InBhc3N3b3JkX21pc21hdGNoIjtzOjMzOiJOb24rY29uY29yZGFuY2UrZGVzK21vdHMrZGUrcGFzc2UiO3M6MjI6ImluY29ycmVjdF9vbGRfcGFzc3dvcmQiO3M6Mjk6IkFuY2llbittb3QrZGUrcGFzc2UraW5jb3JyZWN0IjtzOjIyOiJwbGVhc2VfZmlsbF9hbGxfZmllbGRzIjtzOjM5OiJNZXJjaStkZStjb21wbCVDMyVBOXRlcit0b3VzK2xlcytjaGFtcHMiO3M6Njoic3VibWl0IjtzOjk6InNvdW1ldHRyZSI7czoxMDoiZmlyc3RfbmFtZSI7czoxMToiUHIlQzMlQTlub20iO3M6OToibGFzdF9uYW1lIjtzOjE0OiJOb20rZGUrZmFtaWxsZSI7czo1OiJlbWFpbCI7czo1OiJFbWFpbCI7czo1OiJwaG9uZSI7czoxOToiVCVDMyVBOWwlQzMlQTlwaG9uZSI7czo3OiJhZGRyZXNzIjtzOjc6IkFkcmVzc2UiO3M6NDoiY2l0eSI7czo1OiJWaWxsZSI7czo3OiJjb3VudHJ5IjtzOjQ6IlBheXMiO3M6ODoicG9zdGNvZGUiO3M6MTE6IkNvZGUrcG9zdGFsIjtzOjg6InBhc3N3b3JkIjtzOjEyOiJNb3QrZGUrcGFzc2UiO3M6Nzoic2lnbl91cCI7czoxMjoiUyUyN2luc2NyaXJlIjtzOjIzOiJhbHJlYWR5X2hhdmVfYW5fYWNjb3VudCI7czozNzoiVm91cythdmV6K2QlQzMlQTlqJUMzJUEwK3VuK2NvbXB0ZSUzRiI7czo0OiJob21lIjtzOjc6IkFjY3VlaWwiO3M6MTA6IndlbGNvbWVfdG8iO3M6MTY6IkJpZW52ZW51ZSslQzMlQTAiO3M6MTE6Im5ld19ib29raW5nIjtzOjI1OiJOb3V2ZWxsZStyJUMzJUE5c2VydmF0aW9uIjtzOjExOiJteV9ib29raW5ncyI7czoyMToiTWVzK3IlQzMlQTlzZXJ2YXRpb25zIjtzOjE1OiJteV90cmFuc2FjdGlvbnMiO3M6MTY6Ik1lcyt0cmFuc2FjdGlvbnMiO3M6MTE6Im15X3NldHRpbmdzIjtzOjE5OiJNZXMrcGFyYW0lQzMlQTh0cmVzIjtzOjQyOiJ3aGVyZV93b3VsZF95b3VfbGlrZV91c190b19wcm92aWRlX3NlcnZpY2UiO3M6NTc6Ik8lQzMlQjkrYWltZXJpZXotdm91cytxdWUrbm91cytmb3Vybmlzc2lvbnMrdW4rc2VydmljZSUzRiI7czoyMToicGxlYXNlX2Nob29zZV9zZXJ2aWNlIjtzOjI3OiJWZXVpbGxleitjaG9pc2lyK3VuK3NlcnZpY2UiO3M6ODoicHJldmlvdXMiO3M6MTk6InByJUMzJUE5YyVDMyVBOWRlbnQiO3M6NDoibmV4dCI7czo3OiJTdWl2YW50IjtzOjc6InNlcnZpY2UiO3M6MTA6IlVuK3NlcnZpY2UiO3M6NDoiY29zdCI7czo5OiJDbyVDMyVCQnQiO3M6MjA6InBsZWFzZV9zZWxlY3RfbWV0aG9kIjtzOjQzOiJWZXVpbGxleitzJUMzJUE5bGVjdGlvbm5lcit1bmUrbSVDMyVBOXRob2RlIjtzOjIwOiJwbGVhc2Vfc2VsZWN0X29mZmVycyI7czozNzoiVmV1aWxsZXorcyVDMyVBOWxlY3Rpb25uZXIrZGVzK29mZnJlcyI7czoxODoicGxlYXNlX3NlbGVjdF90aW1lIjtzOjQ5OiJTJTI3aWwrdm91cytwbGElQzMlQUV0K3MlQzMlQTlsZWN0aW9ubmVyK2xlK3RlbXBzIjtzOjIwOiJwbGVhc2Vfc2VsZWN0X2FkZG9ucyI7czozNzoiVmV1aWxsZXorcyVDMyVBOWxlY3Rpb25uZXIrZGVzK2FkZG9ucyI7czo3OiJtb250aGx5IjtzOjc6Ik1lbnN1ZWwiO3M6OToiYmlfd2Vla2x5IjtzOjE1OiJCaStoZWJkb21hZGFpcmUiO3M6Njoid2Vla2x5IjtzOjEyOiJIZWJkb21hZGFpcmUiO3M6NDoib25jZSI7czoxMjoiVW5lK2ZvaXMrcXVlIjtzOjE4OiJwbGVhc2Vfc2VsZWN0X2RhdGUiO3M6MjQ6IlZldWlsbGV6K2Nob2lzaXIrbGErZGF0ZSI7czo0OiJkYXRlIjtzOjIwOiJSZW5kZXotdm91cythbW91cmV1eCI7czoyMjoicGxlYXNlX3NlbGVjdF9wcm92aWRlciI7czozMToiVmV1aWxsZXorY2hvaXNpcit1bitmb3Vybmlzc2V1ciI7czo0OiJ0aW1lIjtzOjU6IlRlbXBzIjtzOjEzOiJpbmNsdWRpbmdfdGF4IjtzOjIxOiIlMjhUYXhlcytjb21wcmlzZXMlMjkiO3M6MjQ6InByZWZlcnJlZF9wYXltZW50X21ldGhvZCI7czo0ODoiTSVDMyVBOXRob2RlK2RlK3BhaWVtZW50K3ByJUMzJUE5ZiVDMyVBOXIlQzMlQTllIjtzOjExOiJsb2NhbGx5X3BheSI7czoxNjoiUGF5ZXIrbG9jYWxlbWVudCI7czoyNToiY3JlZGl0X2RlYml0X2NhcmRfcGF5bWVudCI7czo0ODoiUGFpZW1lbnQrcGFyK2NhcnRlK2RlK2NyJUMzJUE5ZGl0KyUyRitkJUMzJUE5Yml0IjtzOjY6ImNhbmNlbCI7czo3OiJBbm51bGVyIjtzOjI1OiJjcmVkaXRfZGViaXRfY2FyZF9kZXRhaWxzIjtzOjU0OiJEJUMzJUE5dGFpbHMrZGUrbGErY2FydGUrZGUrY3IlQzMlQTlkaXQrJTJGK2QlQzMlQTliaXQiO3M6MTI6InNlcnZpY2VfbmFtZSI7czoxNDoiTm9tK2R1K3NlcnZpY2UiO3M6MTI6ImJvb2tpbmdfZGF0ZSI7czoyNDoiRGF0ZStkZStyJUMzJUE5c2VydmF0aW9uIjtzOjExOiJjYXJ0X2Ftb3VudCI7czoxNzoiTW9udGFudCtkdStwYW5pZXIiO3M6MTY6ImJvb2tfYXBwb2ludG1lbnQiO3M6MjA6IlJlbmRlei12b3VzK2R1K2xpdnJlIjtzOjExOiJjYXJkX251bWJlciI7czoyMDoiTnVtJUMzJUE5cm8rZGUrY2FydGUiO3M6MTI6ImV4cGlyeV9tb250aCI7czoxOToiTW9pcytkJTI3ZXhwaXJhdGlvbiI7czoxMToiZXhwaXJ5X3llYXIiO3M6MjU6IkFubiVDMyVBOWUrZCUyN2V4cGlyYXRpb24iO3M6MTU6ImJvb2tpbmdfc3VtbWFyeSI7czozOToiUiVDMyVBOXN1bSVDMyVBOStkZStsYStyJUMzJUE5c2VydmF0aW9uIjtzOjg6ImNhcmRfY3ZjIjtzOjk6IkNhcnRlK0NWQyI7czozOiJhbGwiO3M6NDoiVG91dCI7czo0OiJwYXN0IjtzOjEwOiJQYXNzJUMzJUE5IjtzOjg6InVwY29taW5nIjtzOjg6IlByb2NoYWluIjtzOjE3OiJub19kYXRhX2F2YWlsYWJsZSI7czozMToiUGFzK2RlK2Rvbm4lQzMlQTllcytkaXNwb25pYmxlcyI7czo5OiJjb25maXJtZWQiO3M6MTM6IkNvbmZpcm0lQzMlQTkiO3M6ODoicmVqZWN0ZWQiO3M6MTE6IlJlamV0JUMzJUE5IjtzOjc6InBlbmRpbmciO3M6MTI6ImVuK2F0dGVuZGFudCI7czo5OiJjYW5jZWxsZWQiO3M6MTE6IkFubnVsJUMzJUE5IjtzOjEwOiJyZXNjaGVkdWxlIjtzOjExOiJSZXBsYW5pZmllciI7czo3OiJub19zaG93IjtzOjc6Ik5vK1Nob3ciO3M6NzoiZGV0YWlscyI7czoxMjoiRCVDMyVBOXRhaWxzIjtzOjE3OiJsb2FkaW5nX21vcmVfZGF0YSI7czo0NzoiQ2hhcmdlbWVudCtkZStkb25uJUMzJUE5ZXMrc3VwcGwlQzMlQTltZW50YWlyZXMiO3M6OToiZGFzaGJvYXJkIjtzOjE1OiJUYWJsZWF1K2RlK2JvcmQiO3M6NToicHJpY2UiO3M6NDoiUHJpeCI7czo4OiJvcmRlcl9pZCI7czoyMzoiTnVtJUMzJUE5cm8rZGUrY29tbWFuZGUiO3M6NDoidW5pdCI7czoxMDoiVW5pdCVDMyVBOSI7czo2OiJhZGRfb24iO3M6NzoiQWpvdXRlciI7czo2OiJtZXRob2QiO3M6MTI6Ik0lQzMlQTl0aG9kZSI7czoxMjoicGF5bWVudF90eXBlIjtzOjE2OiJUeXBlK2RlK3BhaWVtZW50IjtzOjE0OiJib29raW5nX3N0YXR1cyI7czoyNjoiU3RhdHV0K2RlK3IlQzMlQTlzZXJ2YXRpb24iO3M6MzA6ImFwcG9pbnRtZW50X21hcmtlZF9hc19ub19zaG93biI7czo0NjoiUmVuZGV6LXZvdXMrbWFycXUlQzMlQTkrY29tbWUrbm9uK2luZGlxdSVDMyVBOSI7czoyOToiY2FuY2VsbGVkX2J5X3NlcnZpY2VfcHJvdmlkZXIiO3M6NDI6IkFubnVsJUMzJUE5K3BhcitsZStmb3Vybmlzc2V1citkZStzZXJ2aWNlcyI7czoyMToiY2FuY2VsbGVkX2J5X2N1c3RvbWVyIjtzOjI1OiJBbm51bCVDMyVBOStwYXIrbGUrY2xpZW50IjtzOjEwOiJzdGFydF9kYXRlIjtzOjE4OiJEYXRlK2RlK2QlQzMlQTlidXQiO3M6MTA6InN0YXJ0X3RpbWUiO3M6MTk6IkhldXJlK2RlK2QlQzMlQTlidXQiO3M6MjA6InBheW1lbnRfdHJhbnNhY3Rpb25zIjtzOjI0OiJUcmFuc2FjdGlvbnMrZGUrcGFpZW1lbnQiO3M6MTA6Im15X2FjY291bnQiO3M6MTA6Ik1vbitjb21wdGUiO3M6NDoibmFtZSI7czoxMToicHIlQzMlQTlub20iO3M6NjoidXBkYXRlIjtzOjE4OiJNZXR0cmUrJUMzJUEwK2pvdXIiO3M6ODoiY3VzdG9tZXIiO3M6NjoiQ2xpZW50IjtzOjU6InN0YWZmIjtzOjk6IlBlcnNvbm5lbCI7czoyMDoic2NoZWR1bGVfYXBwb2ludG1lbnQiO3M6MTE6IlJlbmRlei12b3VzIjtzOjEwOiJjb250YWN0X3VzIjtzOjE0OiJDb250YWN0ZXorbm91cyI7czo4OiJmZWVkYmFjayI7czoyMjoiUmV0b3VyK2QlMjdpbmZvcm1hdGlvbiI7czo2OiJsb2dvdXQiO3M6MTU6IkNvbm5lY3RleistK091dCI7czoxNDoiZW50ZXJfZmVlZGJhY2siO3M6MjM6IkVudHJleitsZXMrY29tbWVudGFpcmVzIjtzOjE2OiJmZXRjaGluZ19tZXRob2RzIjtzOjM5OiJNJUMzJUE5dGhvZGVzK2RlK3IlQzMlQTljdXAlQzMlQTlyYXRpb24iO3M6MzY6InRoYW5rX3lvdV9mb3JfeW91cl92YWx1YWJsZV9mZWVkYmFjayI7czo0MToiTWVyY2krcG91cit2b3MrcHIlQzMlQTljaWV1eCtjb21tZW50YWlyZXMiO3M6MjU6InVuYWJsZV90b19zdWJtaXRfZmVlZGJhY2siO3M6NDA6IkltcG9zc2libGUrZGUrc291bWV0dHJlK2Rlcytjb21tZW50YWlyZXMiO3M6MjE6InBsZWFzZV9lbnRlcl9mZWVkYmFjayI7czo0NjoiUyUyN2lsK3ZvdXMrcGxhJUMzJUFFdCtlbnRyZXIrZGVzK2NvbW1lbnRhaXJlcyI7czoxMzoibm90aWZpY2F0aW9ucyI7czoxNzoiTGVzK25vdGlmaWNhdGlvbnMiO3M6MTk6Im5ld19ib29raW5nX3N1Y2Nlc3MiO3M6Mzk6Ik5vdXZlYXUrc3VjYyVDMyVBOHMrZGUrciVDMyVBOXNlcnZhdGlvbiI7czoyMDoiYWN0aXZpdHlfcmVzY2hlZHVsZWQiO3M6Mjc6IkFjdGl2aXQlQzMlQTkrcmVwb3J0JUMzJUE5ZSI7czoxNzoibm9fc2VydmljZXNfZm91bmQiO3M6MjU6IkF1Y3VuK3NlcnZpY2UrdHJvdXYlQzMlQTkiO3M6MTY6ImFwaV9rZXlfbWlzbWF0Y2giO3M6MzQ6Ik5vbitjb25jb3JkYW5jZStkZStsYStjbCVDMyVBOStBUEkiO3M6MjE6InBvc3RhbF9jb2RlX25vdF9mb3VuZCI7czoyNzoiQ29kZStwb3N0YWwrbm9uK3Ryb3V2JUMzJUE5IjtzOjE3OiJwb3N0YWxfY29kZV9mb3VuZCI7czoyMzoiQ29kZStwb3N0YWwrdHJvdXYlQzMlQTkiO3M6Mjg6ImV4dHJhX3NlcnZpY2VzX25vdF9hdmFpbGFibGUiO3M6NDU6IlNlcnZpY2VzK3N1cHBsJUMzJUE5bWVudGFpcmVzK25vbitkaXNwb25pYmxlcyI7czoxODoibm9fdW5pdHNfYXZhaWxhYmxlIjtzOjI4OiJBdWN1bmUrdW5pdCVDMyVBOStkaXNwb25pYmxlIjtzOjI4OiJub19mcmVxdWVudGx5X2Rpc2NvdW50X2ZvdW5kIjtzOjQxOiJBdWN1bityYWJhaXMrZnIlQzMlQTlxdWVtbWVudCt0cm91diVDMyVBOSI7czozNToiaW5jb3JyZWN0X2VtYWlsX2FkZHJlc3Nfb3JfcGFzc3dvcmQiO3M6Mzk6IkFkcmVzc2UrZW1haWwrb3UrbW90K2RlK3Bhc3NlK2luY29ycmVjdCI7czoyMToibm9fYXBwb2ludG1lbnRzX2ZvdW5kIjtzOjI5OiJBdWN1bityZW5kZXotdm91cyt0cm91diVDMyVBOSI7czo0MToieW91cl9hcHBvaW50bWVudF9yZXNjaGVkdWxlZF9zdWNjZXNzZnVsbHkiO3M6NDc6IlZvdHJlK3JlbmRlei12b3VzK3JlcG9ydCVDMyVBOSthdmVjK3N1Y2MlQzMlQThzIjtzOjI2OiJzb3JyeV93ZV9hcmVfbm90X2F2YWlsYWJsZSI7czo1MToiRCVDMyVBOXNvbCVDMyVBOSUyQytub3VzK25lK3NvbW1lcytwYXMrZGlzcG9uaWJsZXMuIjtzOjM5OiJ5b3VyX2FwcG9pbnRtZW50X2NhbmNlbGxlZF9zdWNjZXNzZnVsbHkiO3M6NjI6IlZvdHJlK3JlbmRlei12b3VzK2ErJUMzJUE5dCVDMyVBOSthbm51bCVDMyVBOSthdmVjK3N1Y2MlQzMlQThzIjtzOjE5OiJjb3Vwb25fY29kZV9leHBpcmVkIjtzOjMxOiJMZStjb2RlK2RlK2NvdXBvbithK2V4cGlyJUMzJUE5IjtzOjE5OiJpbnZhbGlkX2NvdXBvbl9jb2RlIjtzOjIzOiJDb2RlK2RlK0NvdXBvbitJbnZhbGlkZSI7czoyNzoicGFydGlhbF9kZXBvc2l0X2lzX2Rpc2FibGVkIjtzOjUwOiJMZStkJUMzJUE5cCVDMyVCNHQrcGFydGllbCtlc3QrZCVDMyVBOXNhY3RpdiVDMyVBOSI7czo1NDoibm9uZV9vZl90aW1lX3Nsb3RfYXZhaWxhYmxlX3BsZWFzZV9jaGVja19hbm90aGVyX2RhdGVzIjtzOjc5OiJBdWN1bitjciVDMyVBOW5lYXUraG9yYWlyZStkaXNwb25pYmxlJTJDK3ZldWlsbGV6K3YlQzMlQTlyaWZpZXIrdW5lK2F1dHJlK2RhdGUuIjtzOjQ2OiJhdmFpbGFiaWxpdHlfaXNfbm90X2NvbmZpZ3VyZWRfZnJvbV9hZG1pbl9zaWRlIjtzOjg1OiJMYStkaXNwb25pYmlsaXQlQzMlQTkrbiUyN2VzdCtwYXMrY29uZmlndXIlQzMlQTllKyVDMyVBMCtwYXJ0aXIrZGUrbCUyN2FkbWluaXN0cmF0ZXVyIjtzOjI5OiJjdXN0b21lcl9jcmVhdGVkX3N1Y2Nlc3NmdWxseSI7czozODoiQ2xpZW50K2NyJUMzJUE5JUMzJUE5K2F2ZWMrc3VjYyVDMyVBOHMiO3M6MzE6ImVycm9yX29jY3VycmVkX3BsZWFzZV90cnlfYWdhaW4iO3M6NTU6IlVuZStlcnJldXIrcyUyN2VzdCtwcm9kdWl0ZSUyQyt2ZXVpbGxleityJUMzJUE5ZXNzYXllci4iO3M6MzE6ImFwcG9pbnRtZW50X2Jvb2tlZF9zdWNjZXNzZnVsbHkiO3M6NDY6IlJlbmRlei12b3VzK3IlQzMlQTlzZXJ2JUMzJUE5K2F2ZWMrc3VjYyVDMyVBOHMiO3M6MjQ6InVzZXJfZGV0YWlsc19ub3RfdXBkYXRlZCI7czo1MToiRCVDMyVBOXRhaWxzK2RlK2wlMjd1dGlsaXNhdGV1citub24rbWlzKyVDMyVBMCtqb3VyIjtzOjM2OiJ1c2VyX25vdF9leGlzdF9wbGVhc2VfcmVnaXN0ZXJfZmlyc3QiO3M6Nzg6IkwlMjd1dGlsaXNhdGV1cituJTI3ZXhpc3RlK3BhcytzJTI3aWwrdm91cytwbGElQzMlQUV0K2luc2NyaXZlei12b3VzK2QlMjdhYm9yZCI7czoxODoidXNlcl9hbHJlYWR5X2V4aXN0IjtzOjM3OiJMJTI3dXRpbGlzYXRldXIrZXhpc3RlK2QlQzMlQTlqJUMzJUEwIjtzOjE3OiJpbnZhbGlkX3VzZXJfdHlwZSI7czoyOToiVHlwZStkJTI3dXRpbGlzYXRldXIraW52YWxpZGUiO3M6MTQ6Im5vX3N0YWZmX2ZvdW5kIjtzOjM3OiJBdWN1bittZW1icmUrZHUrcGVyc29ubmVsK3Ryb3V2JUMzJUE5IjtzOjIwOiJub19kZXRhaWxzX2F2YWlsYWJsZSI7czozMToiUGFzK2RlK2QlQzMlQTl0YWlscytkaXNwb25pYmxlcyI7czoxNjoidHlwZV9pc19taXNtYXRjaCI7czoyNDoiTGUrdHlwZStlc3QraW5jb21wYXRpYmxlIjtzOjIwOiJ1cGRhdGVkX3N1Y2Nlc3NmdWxseSI7czozMjoiTWlzKyVDMyVBMCtqb3VyK2F2ZWMrc3VjYyVDMyVBOXMiO3M6MjA6InNvbWV0aGluZ193ZW50X3dyb25nIjtzOjM2OiJRdWVscXVlK2Nob3NlK3MlMjdlc3QrbWFsK3Bhc3MlQzMlQTkiO3M6MzY6InBsZWFzZV9jaGVja195b3VyX2NvbmZpcm1lZF9wYXNzd29yZCI7czo1ODoiVmV1aWxsZXordiVDMyVBOXJpZmllcit2b3RyZSttb3QrZGUrcGFzc2UrY29uZmlybSVDMyVBOSUyMSI7czoyMzoieW91cl9wYXNzd29yZF9ub3RfbWF0Y2giO3M6MjQ6IlZvdHJlK1BhYXN3b3JkK1BhcytNYXRjaCI7czoyNDoibm9fdXBjb21taW5nX2FwcG9pbnRtZW50IjtzOjMwOiJBdWN1bityZW5kZXotdm91cyslQzMlQTArdmVuaXIiO3M6MTE6ImVtYWlsX2V4aXN0IjtzOjEyOiJFbWFpbCtleGlzdGUiO3M6MjA6ImVtYWlsX2RvZXNfbm90X2V4aXN0IjtzOjIwOiJFbWFpbCtuJTI3ZXhpc3RlK3BhcyI7czoxOToiaW52YWxpZF9jcmVkZW50aWFscyI7czo0NToibGVzK2luZm9ybWF0aW9ucytkJTI3aWRlbnRpZmljYXRpb24raW52YWxpZGVzIjtzOjEwOiJlbWFpbF9zZW5kIjtzOjE3OiJFbWFpbCtlbnZveSVDMyVBOSI7czoyMDoiZW1haWxfc2VuZGluZ19mYWlsZWQiO3M6Mzg6IkwlMjdlbnZvaStkJTI3ZW1haWwrYSslQzMlQTljaG91JUMzJUE5IjtzOjE3OiJub19vcmRlcnNfZGV0YWlscyI7czoyODoiUGFzK2RlK2NvbW1hbmRlK0QlQzMlQTl0YWlscyI7czoxMDoibWVzc2FnZV9pcyI7czoxNDoiTGUrbWVzc2FnZStlc3QiO3M6MjA6InBsZWFzZV9lbmFibGVfc3RyaXBlIjtzOjM3OiJTJTI3aWwrdm91cytwbGElQzMlQUV0K2FjdGl2ZXIrU3RyaXBlIjtzOjE1OiJpbnZhbGlkX3JlcXVlc3QiO3M6MjE6IlJlcXUlQzMlQUF0ZStpbnZhbGlkZSI7czo5OiJvdHBfbWF0Y2giO3M6OToiTWF0Y2grT3RwIjtzOjEzOiJvdHBfbm90X21hdGNoIjtzOjIxOiJPdHArbmUrY29ycmVzcG9uZCtwYXMiO3M6MTg6InBhc3N3b3JkX2lzX2NoYW5nZSI7czozMzoiTGUrbW90K2RlK3Bhc3NlK2VzdCtsZStjaGFuZ2VtZW50IjtzOjE5OiJwYXNzd29yZF9ub3RfY2hhbmdlIjtzOjI5OiJNb3QrZGUrcGFzc2Urbm9uK21vZGlmaSVDMyVBOSI7czo1NjoiYXJlX3lvdV9zdXJlX3lvdV93YW50X3RvX2NhbmNlbF90aGlzX2Jvb2tpbmdfYXBwb2ludG1lbnQiO3M6NjA6IiVDMyU4QXRlcy12b3VzK3MlQzMlQkJyK2RlK3ZvdWxvaXIrYW5udWxlcitjZStyZW5kZXotdm91cyUzRiI7czo1OiJhbGVydCI7czo2OiJBbGVydGUiO3M6Mjoibm8iO3M6MzoiTm9uIjtzOjE1OiJ2ZXJpZnlfemlwX2NvZGUiO3M6Mjg6IlYlQzMlQTlyaWZpZXIrbGUrY29kZStwb3N0YWwiO3M6MTE6InBvc3RhbF9jb2RlIjtzOjExOiJjb2RlK3Bvc3RhbCI7czozMDoibm9fbWV0aG9kX2Zvcl9zZWxlY3RlZF9zZXJ2aWNlIjtzOjU3OiJBdWN1bmUrbSVDMyVBOXRob2RlK3BvdXIrbGUrc2VydmljZStzJUMzJUE5bGVjdGlvbm4lQzMlQTkiO3M6MjQ6InBsZWFzZV9lbnRlcl9wb3N0YWxfY29kZSI7czo0NDoiUyUyN2lsK3ZvdXMrcGxhJUMzJUFFdCtlbnRyZXIrbGUrY29kZStwb3N0YWwiO3M6Mjk6Im5vX2FkZG9uc19mb3Jfc2VsZWN0ZWRfbWV0aG9kIjtzOjU1OiJBdWN1bithZGRvbitwb3VyK2xhK20lQzMlQTl0aG9kZStzJUMzJUE5bGVjdGlvbm4lQzMlQTllIjtzOjIzOiJzZWxlY3RfYXRsZWFzdF9vbmVfdW5pdCI7czo0MToiUyVDMyVBOWxlY3Rpb25uZXorYXUrbW9pbnMrdW5lK3VuaXQlQzMlQTkiO3M6MTg6InNlbGVjdF9hbnlfcGFja2FnZSI7czo0MjoiUyVDMyVBOWxlY3Rpb25uZXorbiUyN2ltcG9ydGUrcXVlbCtmb3JmYWl0IjtzOjExOiJwbGVhc2Vfd2FpdCI7czozNDoiUyUyN2lsK3ZvdXMrcGxhJUMzJUFFdCUyQythdHRlbmRleiI7fQ==' WHERE `language`='fr_FR'";
		mysqli_query($this->conn, $update_app_fr_FR_lang);
		$update_app_pt_PT_lang = "UPDATE `ct_languages` SET `app_labels`='YToxNzg6e3M6Nzoid2VsY29tZSI7czo5OiJCZW0rdmluZGEiO3M6Mjg6Im1ha2VfeW91cl9vbmxpbmVfYXBwb2ludG1lbnQiO3M6Mjk6IkZhJUMzJUE3YStzdWErY29uc3VsdGErb25saW5lIjtzOjQ6InNraXAiO3M6NToiUFVMQVIiO3M6MTA6InNjaGVkdWxpbmciO3M6MTE6IkFnZW5kYW1lbnRvIjtzOjUwOiJtYWtlX3lvdXJfb25saW5lX2FwcG9pbnRtZW50X3NjaGVkdWxpbmdfc3VwZXJfZWFzeSI7czo2NToiRmElQzMlQTdhK28rc2V1K2FnZW5kYW1lbnRvK2RlK2NvbnN1bHRhcytvbi1saW5lK3N1cGVyK2YlQzMlQTFjaWwiO3M6MTE6ImdldF9zdGFydGVkIjtzOjc6IkluaWNpYXIiO3M6NDI6ImdldF9zdGFydGVkX2J5X2xvZ2dpbmdfaW5fb3JfYnlfc2lnbmluZ191cCI7czozNzoiQ29tZWNlK3BvcitmYXplcitsb2dpbitvdStpbnNjcmV2YS1zZSI7czo3OiJzaWduX2luIjtzOjEwOiJBc3NpbmFyK2VtIjtzOjE2OiJlbnRlcl95b3VyX2VtYWlsIjtzOjE2OiJJbnNpcmErc2V1K2VtYWlsIjtzOjE0OiJlbnRlcl9wYXNzd29yZCI7czoxNDoiRGlnaXRlK2Erc2VuaGEiO3M6MTU6ImZvcmdvdF9wYXNzd29yZCI7czoxOToiRXNxdWVjZXUrYStzZW5oYSUzRiI7czo1OiJsb2dpbiI7czo2OiJFbnRyYXIiO3M6MjU6ImRvbnRfaGF2ZV9hY2NvdW50X3NpZ25fdXAiO3M6MzQ6Ik4lQzMlQTNvK3RlbStjb250YSUzRitJbnNjcmV2ZXItc2UiO3M6MjQ6ImVudGVyX2VtYWlsX2FuZF9wYXNzd29yZCI7czoyMDoiRGlnaXRlK2VtYWlsK2Urc2VuaGEiO3M6NzE6InBsZWFzZV9lbnRlcl95b3VyX3JlZ2lzdGVyZWRfZW1haWxfaWRfd2Vfd2lsbF9zZW5kX290cF90b195b3VyX2VtYWlsX2lkIjtzOjk2OiJQb3IrZmF2b3IraW5zaXJhK28rc2V1K0lEK2RlK2VtYWlsK3JlZ2lzdGFkby4rbiVDMyVCM3MrZW52aWFyZW1vcytvK09UUCtwYXJhK28rc2V1K0lEK2RlK2UtbWFpbC4iO3M6MTQ6ImVudGVyX3lvdXJfb3RwIjtzOjE0OiJEaWdpdGUrc2V1K09UUCI7czo4OiJzZW5kX290cCI7czoxMDoiRW52aWFyK09UUCI7czoxNjoiY3VycmVudF9wYXNzd29yZCI7czoxMToic2VuaGErYXR1YWwiO3M6MTI6Im5ld19wYXNzd29yZCI7czoxMDoiTm92YStzZW5oYSI7czoxNjoiY29uZmlybV9wYXNzd29yZCI7czoxNjoiQ29uZmlybWUrYStTZW5oYSI7czoxMToic2VydmVyX2Rvd24iO3M6MTM6IlNlcnZpZG9yK2NhaXUiO3M6MTA6InZlcmlmeV9vdHAiO3M6MTM6IlZlcmlmaXF1ZStPVFAiO3M6NjoiY2xpZW50IjtzOjc6IkNsaWVudGUiO3M6MTc6InVwZGF0aW5nX3Bhc3N3b3JkIjtzOjE3OiJBdHVhbGl6YW5kbytTZW5oYSI7czoyOToicGFzc3dvcmRfdXBkYXRlZF9zdWNjZXNzZnVsbHkiO3M6Mjg6IlNlbmhhK2F0dWFsaXphZGErY29tK3N1Y2Vzc28iO3M6MTc6InBhc3N3b3JkX21pc21hdGNoIjtzOjE1OiJTZW5oYStpbmNvcnJldGEiO3M6MjI6ImluY29ycmVjdF9vbGRfcGFzc3dvcmQiO3M6MjI6IlNlbmhhK2FudGlnYStpbmNvcnJldGEiO3M6MjI6InBsZWFzZV9maWxsX2FsbF9maWVsZHMiO3M6MzQ6IlBvcitmYXZvcitwcmVlbmNoYSt0b2RvcytvcytjYW1wb3MiO3M6Njoic3VibWl0IjtzOjY6ImVudmlhciI7czoxMDoiZmlyc3RfbmFtZSI7czoxMzoiUHJpbWVpcm8rbm9tZSI7czo5OiJsYXN0X25hbWUiO3M6MTY6IiVDMyU5QWx0aW1vK25vbWUiO3M6NToiZW1haWwiO3M6NzoiTytlbWFpbCI7czo1OiJwaG9uZSI7czo4OiJ0ZWxlZm9uZSI7czo3OiJhZGRyZXNzIjtzOjEzOiJFbmRlcmUlQzMlQTdvIjtzOjQ6ImNpdHkiO3M6NjoiQ2lkYWRlIjtzOjc6ImNvdW50cnkiO3M6OToiUGElQzMlQURzIjtzOjg6InBvc3Rjb2RlIjtzOjM6IkNFUCI7czo4OiJwYXNzd29yZCI7czo1OiJTZW5oYSI7czo3OiJzaWduX3VwIjtzOjEyOiJJbnNjcmV2ZXItc2UiO3M6MjM6ImFscmVhZHlfaGF2ZV9hbl9hY2NvdW50IjtzOjI0OiJKJUMzJUExK3RlbSt1bWErY29udGElM0YiO3M6NDoiaG9tZSI7czo0OiJDYXNhIjtzOjEwOiJ3ZWxjb21lX3RvIjtzOjEyOiJCZW0tdmluZG8rYW8iO3M6MTE6Im5ld19ib29raW5nIjtzOjEyOiJOb3ZhK3Jlc2VydmEiO3M6MTE6Im15X2Jvb2tpbmdzIjtzOjE1OiJNaW5oYXMrcmVzZXJ2YXMiO3M6MTU6Im15X3RyYW5zYWN0aW9ucyI7czoyNzoiTWluaGFzK1RyYW5zYSVDMyVBNyVDMyVCNWVzIjtzOjExOiJteV9zZXR0aW5ncyI7czozMDoiTWluaGFzK2NvbmZpZ3VyYSVDMyVBNyVDMyVCNWVzIjtzOjQyOiJ3aGVyZV93b3VsZF95b3VfbGlrZV91c190b19wcm92aWRlX3NlcnZpY2UiO3M6NzA6Ik9uZGUrdm9jJUMzJUFBK2dvc3RhcmlhK3F1ZStuJUMzJUIzcytwcmVzdCVDMyVBMXNzZW1vcytzZXJ2aSVDMyVBN28lM0YiO3M6MjE6InBsZWFzZV9jaG9vc2Vfc2VydmljZSI7czozMjoiUG9yK2Zhdm9yK2VzY29saGErbytzZXJ2aSVDMyVBN28iO3M6ODoicHJldmlvdXMiO3M6ODoiQW50ZXJpb3IiO3M6NDoibmV4dCI7czoxMjoiUHIlQzMlQjN4aW1vIjtzOjc6InNlcnZpY2UiO3M6MTI6IlNlcnZpJUMzJUE3byI7czo0OiJjb3N0IjtzOjU6IkN1c3RvIjtzOjIwOiJwbGVhc2Vfc2VsZWN0X21ldGhvZCI7czozNjoiUG9yK2Zhdm9yJTJDK3NlbGVjaW9uZStvK20lQzMlQTl0b2RvIjtzOjIwOiJwbGVhc2Vfc2VsZWN0X29mZmVycyI7czoyNzoiUG9yK2Zhdm9yK3NlbGVjaW9uZStPZmVydGFzIjtzOjE4OiJwbGVhc2Vfc2VsZWN0X3RpbWUiO3M6MjU6IlBvcitmYXZvcitzZWxlY2lvbmUrVGVtcG8iO3M6MjA6InBsZWFzZV9zZWxlY3RfYWRkb25zIjtzOjI2OiJQb3IrZmF2b3Irc2VsZWNpb25lK0FkZG9ucyI7czo3OiJtb250aGx5IjtzOjEyOiJQb3IrbSVDMyVBQXMiO3M6OToiYmlfd2Vla2x5IjtzOjk6IkJpK1dlZWtseSI7czo2OiJ3ZWVrbHkiO3M6NzoiU2VtYW5hbCI7czo0OiJvbmNlIjtzOjc6IlVtYSt2ZXoiO3M6MTg6InBsZWFzZV9zZWxlY3RfZGF0ZSI7czoyNDoiUG9yK2Zhdm9yK3NlbGVjaW9uZStEYXRhIjtzOjQ6ImRhdGUiO3M6ODoiRW5jb250cm8iO3M6MjI6InBsZWFzZV9zZWxlY3RfcHJvdmlkZXIiO3M6Mjg6IlBvcitmYXZvcitzZWxlY2lvbmUrcHJvdmVkb3IiO3M6NDoidGltZSI7czo1OiJUZW1wbyI7czoxMzoiaW5jbHVkaW5nX3RheCI7czoyMToiJTI4SW5jbHVpbmRvK3RheGFzJTI5IjtzOjI0OiJwcmVmZXJyZWRfcGF5bWVudF9tZXRob2QiO3M6MzQ6Ik0lQzMlQTl0b2RvK2RlK3BhZ2FtZW50bytwcmVmZXJpZG8iO3M6MTE6ImxvY2FsbHlfcGF5IjtzOjE2OiJQYWdhcitsb2NhbG1lbnRlIjtzOjI1OiJjcmVkaXRfZGViaXRfY2FyZF9wYXltZW50IjtzOjU3OiJQYWdhbWVudG8rY29tK2NhcnQlQzMlQTNvK2RlK2NyJUMzJUE5ZGl0byslMkYrZCVDMyVBOWJpdG8iO3M6NjoiY2FuY2VsIjtzOjg6IkNhbmNlbGFyIjtzOjI1OiJjcmVkaXRfZGViaXRfY2FyZF9kZXRhaWxzIjtzOjU1OiJEZXRhbGhlcytkbytjYXJ0JUMzJUEzbytkZStjciVDMyVBOWRpdG8rJTJGK2QlQzMlQTliaXRvIjtzOjEyOiJzZXJ2aWNlX25hbWUiO3M6MjA6Ik5vbWUrZG8rU2VydmklQzMlQTdvIjtzOjEyOiJib29raW5nX2RhdGUiO3M6MTU6IkRhdGErZGUrcmVzZXJ2YSI7czoxMToiY2FydF9hbW91bnQiO3M6MjA6Ik1vbnRhbnRlK2RvK2NhcnJpbmhvIjtzOjE2OiJib29rX2FwcG9pbnRtZW50IjtzOjI3OiJBbm90YSVDMyVBNyVDMyVBM28rZGUrbGl2cm8iO3M6MTE6ImNhcmRfbnVtYmVyIjtzOjI2OiJOJUMzJUJBbWVybytkbytjYXJ0JUMzJUEzbyI7czoxMjoiZXhwaXJ5X21vbnRoIjtzOjIyOiJNJUMzJUFBcytkZSt2ZW5jaW1lbnRvIjtzOjExOiJleHBpcnlfeWVhciI7czoyNjoiQW5vK2RlK2V4cGlyYSVDMyVBNyVDMyVBM28iO3M6MTU6ImJvb2tpbmdfc3VtbWFyeSI7czoxMjoiU3VtJUMzJUExcmlvIjtzOjg6ImNhcmRfY3ZjIjtzOjE1OiJDYXJ0JUMzJUEzbytDVkMiO3M6MzoiYWxsIjtzOjU6IlRvZG9zIjtzOjQ6InBhc3QiO3M6NzoiUGFzc2FkbyI7czo4OiJ1cGNvbWluZyI7czoxMzoicHIlQzMlQjN4aW1vcyI7czoxNzoibm9fZGF0YV9hdmFpbGFibGUiO3M6Mjc6Ik5lbmh1bStkYWRvK2Rpc3BvbiVDMyVBRHZlbCI7czo5OiJjb25maXJtZWQiO3M6MTA6IkNvbmZpcm1hZG8iO3M6ODoicmVqZWN0ZWQiO3M6OToiUmVqZWl0YWRvIjtzOjc6InBlbmRpbmciO3M6ODoiUGVuZGVudGUiO3M6OToiY2FuY2VsbGVkIjtzOjk6IkNhbmNlbGFkbyI7czoxMDoicmVzY2hlZHVsZSI7czoxMToiUmVwcm9ncmFtYXIiO3M6Nzoibm9fc2hvdyI7czoxNjoiTiVDMyVBM28rbW9zdHJhciI7czo3OiJkZXRhaWxzIjtzOjg6IkRldGFsaGVzIjtzOjE3OiJsb2FkaW5nX21vcmVfZGF0YSI7czoyMToiQ2FycmVnYW5kbyttYWlzK2RhZG9zIjtzOjk6ImRhc2hib2FyZCI7czoxODoicGFpbmVsK2RlK2NvbnRyb2xlIjtzOjU6InByaWNlIjtzOjEwOiJQcmUlQzMlQTdvIjtzOjg6Im9yZGVyX2lkIjtzOjE1OiJJRCtkYStlbmNvbWVuZGEiO3M6NDoidW5pdCI7czo3OiJVbmlkYWRlIjtzOjY6ImFkZF9vbiI7czo5OiJBZGljaW9uYXIiO3M6NjoibWV0aG9kIjtzOjExOiJNJUMzJUE5dG9kbyI7czoxMjoicGF5bWVudF90eXBlIjtzOjE3OiJUaXBvK2RlK3BhZ2FtZW50byI7czoxNDoiYm9va2luZ19zdGF0dXMiO3M6MTc6IlN0YXR1cytkYStyZXNlcnZhIjtzOjMwOiJhcHBvaW50bWVudF9tYXJrZWRfYXNfbm9fc2hvd24iO3M6NDk6Ik5vbWVhJUMzJUE3JUMzJUEzbyttYXJjYWRhK2NvbW8rbiVDMyVBM28rbW9zdHJhZGEiO3M6Mjk6ImNhbmNlbGxlZF9ieV9zZXJ2aWNlX3Byb3ZpZGVyIjtzOjQwOiJDYW5jZWxhZG8rcGVsbytwcm92ZWRvcitkZStzZXJ2aSVDMyVBN29zIjtzOjIxOiJjYW5jZWxsZWRfYnlfY3VzdG9tZXIiO3M6MjI6IkNhbmNlbGFkbytwZWxvK2NsaWVudGUiO3M6MTA6InN0YXJ0X2RhdGUiO3M6MTk6IkRhdGErZGUraW4lQzMlQURjaW8iO3M6MTA6InN0YXJ0X3RpbWUiO3M6MTk6IkhvcmErZGUraW4lQzMlQURjaW8iO3M6MjA6InBheW1lbnRfdHJhbnNhY3Rpb25zIjtzOjMzOiJUcmFuc2ElQzMlQTclQzMlQjVlcytkZStQYWdhbWVudG8iO3M6MTA6Im15X2FjY291bnQiO3M6MTE6Ik1pbmhhK2NvbnRhIjtzOjQ6Im5hbWUiO3M6NDoiTm9tZSI7czo2OiJ1cGRhdGUiO3M6OToiQXR1YWxpemFyIjtzOjg6ImN1c3RvbWVyIjtzOjc6IkNsaWVudGUiO3M6NToic3RhZmYiO3M6MTc6IkZ1bmNpb24lQzMlQTFyaW9zIjtzOjIwOiJzY2hlZHVsZV9hcHBvaW50bWVudCI7czoxOToiQWdlbmRhcitjb21wcm9taXNzbyI7czoxMDoiY29udGFjdF91cyI7czoxMToiQ29udGF0ZS1Ob3MiO3M6ODoiZmVlZGJhY2siO3M6MTY6IkNvbWVudCVDMyVBMXJpb3MiO3M6NjoibG9nb3V0IjtzOjQ6IlNhaXIiO3M6MTQ6ImVudGVyX2ZlZWRiYWNrIjtzOjE3OiJJbnNpcmErbytmZWVkYmFjayI7czoxNjoiZmV0Y2hpbmdfbWV0aG9kcyI7czoyMToiTSVDMyVBOXRvZG9zK2RlK2J1c2NhIjtzOjM2OiJ0aGFua195b3VfZm9yX3lvdXJfdmFsdWFibGVfZmVlZGJhY2siO3M6MzQ6Ik9icmlnYWRvK3BlbG8rc2V1K2ZlZWRiYWNrK3ZhbGlvc28iO3M6MjU6InVuYWJsZV90b19zdWJtaXRfZmVlZGJhY2siO3M6NDU6Ik4lQzMlQTNvKyVDMyVBOStwb3NzJUMzJUFEdmVsK2VudmlhcitmZWVkYmFjayI7czoyMToicGxlYXNlX2VudGVyX2ZlZWRiYWNrIjtzOjI3OiJQb3IrZmF2b3IraW5zaXJhK28rZmVlZGJhY2siO3M6MTM6Im5vdGlmaWNhdGlvbnMiO3M6MjI6Ik5vdGlmaWNhJUMzJUE3JUMzJUI1ZXMiO3M6MTk6Im5ld19ib29raW5nX3N1Y2Nlc3MiO3M6MjM6Ik5vdm8rc3VjZXNzbytkZStyZXNlcnZhIjtzOjIwOiJhY3Rpdml0eV9yZXNjaGVkdWxlZCI7czoyMjoiQXRpdmlkYWRlK3JlcHJvZ3JhbWFkYSI7czoxNzoibm9fc2VydmljZXNfZm91bmQiO3M6MzA6Ik5lbmh1bStzZXJ2aSVDMyVBN28rZW5jb250cmFkbyI7czoxNjoiYXBpX2tleV9taXNtYXRjaCI7czozMzoiSW5jb21wYXRpYmlsaWRhZGUrZGUrY2hhdmUrZGUrQVBJIjtzOjIxOiJwb3N0YWxfY29kZV9ub3RfZm91bmQiO3M6Mzg6IkMlQzMlQjNkaWdvK3Bvc3RhbCtuJUMzJUEzbytlbmNvbnRyYWRvIjtzOjE3OiJwb3N0YWxfY29kZV9mb3VuZCI7czoyOToiQyVDMyVCM2RpZ28rcG9zdGFsK2VuY29udHJhZG8iO3M6Mjg6ImV4dHJhX3NlcnZpY2VzX25vdF9hdmFpbGFibGUiO3M6NDY6IlNlcnZpJUMzJUE3b3MrZXh0cmFzK24lQzMlQTNvK2Rpc3BvbiVDMyVBRHZlaXMiO3M6MTg6Im5vX3VuaXRzX2F2YWlsYWJsZSI7czo0MjoiTiVDMyVBM28raCVDMyVBMSt1bmlkYWRlcytkaXNwb24lQzMlQUR2ZWlzIjtzOjI4OiJub19mcmVxdWVudGx5X2Rpc2NvdW50X2ZvdW5kIjtzOjUyOiJOJUMzJUEzbytmb2krZW5jb250cmFkbytjb20rZnJlcXUlQzMlQUFuY2lhK2Rlc2NvbnRvIjtzOjM1OiJpbmNvcnJlY3RfZW1haWxfYWRkcmVzc19vcl9wYXNzd29yZCI7czo0MzoiRW5kZXJlJUMzJUE3bytkZStFLW1haWwrb3UrU2VuaGErSW5jb3JyZXRvcyI7czoyMToibm9fYXBwb2ludG1lbnRzX2ZvdW5kIjtzOjI5OiJOZW5odW0rY29tcHJvbWlzc28rZW5jb250cmFkbyI7czo0MToieW91cl9hcHBvaW50bWVudF9yZXNjaGVkdWxlZF9zdWNjZXNzZnVsbHkiO3M6NDA6IlNldStjb21wcm9taXNzbytyZXByb2dyYW1hZG8rY29tK3N1Y2Vzc28iO3M6MjY6InNvcnJ5X3dlX2FyZV9ub3RfYXZhaWxhYmxlIjtzOjQ2OiJEZXNjdWxwZSUyQytuJUMzJUEzbytlc3RhbW9zK2Rpc3BvbiVDMyVBRHZlaXMuIjtzOjM5OiJ5b3VyX2FwcG9pbnRtZW50X2NhbmNlbGxlZF9zdWNjZXNzZnVsbHkiO3M6MzQ6IlN1YStjb25zdWx0YStjYW5jZWxhZGErY29tK3N1Y2Vzc28iO3M6MTk6ImNvdXBvbl9jb2RlX2V4cGlyZWQiO3M6Mjk6IkMlQzMlQjNkaWdvK2RlK2N1cG9tK2V4cGlyYWRvIjtzOjE5OiJpbnZhbGlkX2NvdXBvbl9jb2RlIjtzOjM0OiJDJUMzJUIzZGlnbytkZStjdXBvbStpbnYlQzMlQTFsaWRvIjtzOjI3OiJwYXJ0aWFsX2RlcG9zaXRfaXNfZGlzYWJsZWQiO3M6MzI6IkRlcCVDMyVCM3NpdG8rcGFyY2lhbCtkZXNhdGl2YWRvIjtzOjU0OiJub25lX29mX3RpbWVfc2xvdF9hdmFpbGFibGVfcGxlYXNlX2NoZWNrX2Fub3RoZXJfZGF0ZXMiO3M6ODA6Ik5lbmh1bStkb3MraG9yJUMzJUExcmlvcytkaXNwb24lQzMlQUR2ZWlzJTJDK3BvcitmYXZvciUyQyt2ZXJpZmlxdWUrb3V0cmFzK2RhdGFzIjtzOjQ2OiJhdmFpbGFiaWxpdHlfaXNfbm90X2NvbmZpZ3VyZWRfZnJvbV9hZG1pbl9zaWRlIjtzOjczOiJBK2Rpc3BvbmliaWxpZGFkZStuJUMzJUEzbytlc3QlQzMlQTErY29uZmlndXJhZGErZG8rbGFkbytkbythZG1pbmlzdHJhZG9yIjtzOjI5OiJjdXN0b21lcl9jcmVhdGVkX3N1Y2Nlc3NmdWxseSI7czoyNjoiQ2xpZW50ZStjcmlhZG8rY29tK3N1Y2Vzc28iO3M6MzE6ImVycm9yX29jY3VycmVkX3BsZWFzZV90cnlfYWdhaW4iO3M6NDE6Ik9jb3JyZXUrdW0rZXJybytwb3IrZmF2b3IrdGVudGUrbm92YW1lbnRlIjtzOjMxOiJhcHBvaW50bWVudF9ib29rZWRfc3VjY2Vzc2Z1bGx5IjtzOjMzOiJDb21wcm9taXNzbytyZXNlcnZhZG8rY29tK3N1Y2Vzc28iO3M6MjQ6InVzZXJfZGV0YWlsc19ub3RfdXBkYXRlZCI7czo0NToiRGV0YWxoZXMrZG8rdXN1JUMzJUExcmlvK24lQzMlQTNvK2F0dWFsaXphZG9zIjtzOjM2OiJ1c2VyX25vdF9leGlzdF9wbGVhc2VfcmVnaXN0ZXJfZmlyc3QiO3M6NTg6IlVzdSVDMyVBMXJpbytpbmV4aXN0ZW50ZSUyQytwb3IrZmF2b3IrcmVnaXN0cmUtc2UrcHJpbWVpcm8iO3M6MTg6InVzZXJfYWxyZWFkeV9leGlzdCI7czoyNzoiTyt1dGlsaXphZG9yK2olQzMlQTErZXhpc3RlIjtzOjE3OiJpbnZhbGlkX3VzZXJfdHlwZSI7czozNDoiVGlwbytkZSt1c3UlQzMlQTFyaW8raW52JUMzJUExbGlkbyI7czoxNDoibm9fc3RhZmZfZm91bmQiO3M6MjU6Ik5lbmh1bWErZXF1aXBlK2VuY29udHJhZGEiO3M6MjA6Im5vX2RldGFpbHNfYXZhaWxhYmxlIjtzOjMwOiJOZW5odW0rZGV0YWxoZStkaXNwb24lQzMlQUR2ZWwiO3M6MTY6InR5cGVfaXNfbWlzbWF0Y2giO3M6Mjk6IlRpcG8rJUMzJUE5K2luY29tcGF0aWJpbGlkYWRlIjtzOjIwOiJ1cGRhdGVkX3N1Y2Nlc3NmdWxseSI7czoyMjoiQXR1YWxpemFkbytjb20rc3VjZXNzbyI7czoyMDoic29tZXRoaW5nX3dlbnRfd3JvbmciO3M6MTU6IkFsZ28rZGV1K2VycmFkbyI7czozNjoicGxlYXNlX2NoZWNrX3lvdXJfY29uZmlybWVkX3Bhc3N3b3JkIjtzOjQ2OiJQb3IrZmF2b3IlMkMrdmVyaWZpcXVlK3N1YStzZW5oYStjb25maXJtYWRhJTIxIjtzOjIzOiJ5b3VyX3Bhc3N3b3JkX25vdF9tYXRjaCI7czoyOToiU3VhK1BhYXN3b3JkK24lQzMlQTNvK2NvbWJpbmEiO3M6MjQ6Im5vX3VwY29tbWluZ19hcHBvaW50bWVudCI7czo0MToiTiVDMyVBM28raCVDMyVBMStjb21wcm9taXNzbytkZSt1cGNvbW1pbmciO3M6MTE6ImVtYWlsX2V4aXN0IjtzOjEyOiJFbWFpbCtleGlzdGUiO3M6MjA6ImVtYWlsX2RvZXNfbm90X2V4aXN0IjtzOjIyOiJFLW1haWwrbiVDMyVBM28rZXhpc3RlIjtzOjE5OiJpbnZhbGlkX2NyZWRlbnRpYWxzIjtzOjI2OiJDcmVkZW5jaWFpcytpbnYlQzMlQTFsaWRhcyI7czoxMDoiZW1haWxfc2VuZCI7czoxNToiRW52aW8rZGUrZS1tYWlsIjtzOjIwOiJlbWFpbF9zZW5kaW5nX2ZhaWxlZCI7czoyMzoiTytlbnZpbytkZStlbWFpbCtmYWxob3UiO3M6MTc6Im5vX29yZGVyc19kZXRhaWxzIjtzOjI1OiJOZW5odW0rZGV0YWxoZStkZStwZWRpZG9zIjtzOjEwOiJtZXNzYWdlX2lzIjtzOjE1OiJNZW5zYWdlbSslQzMlQTkiO3M6MjA6InBsZWFzZV9lbmFibGVfc3RyaXBlIjtzOjI2OiJQb3IrZmF2b3IlMkMrYXRpdmUrYSt0YXJqYSI7czoxNToiaW52YWxpZF9yZXF1ZXN0IjtzOjIwOiJQZWRpZG8raW52JUMzJUExbGlkbyI7czo5OiJvdHBfbWF0Y2giO3M6ODoiT3RwK2pvZ28iO3M6MTM6Im90cF9ub3RfbWF0Y2giO3M6MjQ6Ik90cCtuJUMzJUEzbytjb3JyZXNwb25kZSI7czoxODoicGFzc3dvcmRfaXNfY2hhbmdlIjtzOjI1OiJTZW5oYSslQzMlQTkrbXVkYW4lQzMlQTdhIjtzOjE5OiJwYXNzd29yZF9ub3RfY2hhbmdlIjtzOjE5OiJTZW5oYStuJUMzJUEzbyttdWRhIjtzOjU2OiJhcmVfeW91X3N1cmVfeW91X3dhbnRfdG9fY2FuY2VsX3RoaXNfYm9va2luZ19hcHBvaW50bWVudCI7czo2NToiVGVtK2NlcnRlemErZGUrcXVlK2Rlc2VqYStjYW5jZWxhcitlc3RlK2NvbXByb21pc3NvK2RlK3Jlc2VydmElM0YiO3M6NToiYWxlcnQiO3M6NjoiQWxlcnRhIjtzOjI6Im5vIjtzOjg6Ik4lQzMlQTNvIjtzOjE1OiJ2ZXJpZnlfemlwX2NvZGUiO3M6MzA6IlZlcmlmaWNhcitvK2MlQzMlQjNkaWdvK3Bvc3RhbCI7czoxMToicG9zdGFsX2NvZGUiO3M6MTg6IkMlQzMlQjNkaWdvK3Bvc3RhbCI7czozMDoibm9fbWV0aG9kX2Zvcl9zZWxlY3RlZF9zZXJ2aWNlIjtzOjQ4OiJOZW5odW0rbSVDMyVBOXRvZG8rcGFyYStzZXJ2aSVDMyVBN28rc2VsZWNpb25hZG8iO3M6MjQ6InBsZWFzZV9lbnRlcl9wb3N0YWxfY29kZSI7czozNzoiUG9yK2Zhdm9yK2luc2lyYStvK2MlQzMlQjNkaWdvK3Bvc3RhbCI7czoyOToibm9fYWRkb25zX2Zvcl9zZWxlY3RlZF9tZXRob2QiO3M6NDM6Ik5lbmh1bSthZGRvbitwYXJhK28rbSVDMyVBOXRvZG8rc2VsZWNpb25hZG8iO3M6MjM6InNlbGVjdF9hdGxlYXN0X29uZV91bml0IjtzOjMyOiJTZWxlY2lvbmUrcGVsbyttZW5vcyt1bWErdW5pZGFkZSI7czoxODoic2VsZWN0X2FueV9wYWNrYWdlIjtzOjI1OiJTZWxlY2lvbmUrcXVhbHF1ZXIrcGFjb3RlIjtzOjExOiJwbGVhc2Vfd2FpdCI7czoxOToiUG9yK2Zhdm9yJTJDK2VzcGVyZSI7fQ==' WHERE `language`='pt_PT'";
		mysqli_query($this->conn, $update_app_pt_PT_lang);
		$update_app_ru_RU_lang = "UPDATE `ct_languages` SET `app_labels`='YToxNzg6e3M6Nzoid2VsY29tZSI7czo0ODoiJUQwJUI2JUQwJUI1JUQwJUJCJUQwJUIwJUQwJUJEJUQwJUJEJUQxJThCJUQwJUI5IjtzOjI4OiJtYWtlX3lvdXJfb25saW5lX2FwcG9pbnRtZW50IjtzOjEwNDoiJUQwJTk3JUQwJUIwJUQwJUJGJUQwJUI4JUQxJTgxJUQwJUIwJUQxJTgyJUQxJThDJUQxJTgxJUQxJThGKyVEMCVCRCVEMCVCMCslRDAlQkYlRDElODAlRDAlQjglRDAlQjUlRDAlQkMiO3M6NDoic2tpcCI7czo2MDoiJUQwJTlGJUQwJUEwJUQwJTlFJUQwJTlGJUQwJUEzJUQwJUExJUQwJTlBJUQwJTkwJUQwJUEyJUQwJUFDIjtzOjEwOiJzY2hlZHVsaW5nIjtzOjcyOiIlRDAlQkYlRDAlQkIlRDAlQjAlRDAlQkQlRDAlQjglRDElODAlRDAlQkUlRDAlQjIlRDAlQjAlRDAlQkQlRDAlQjglRDAlQjUiO3M6NTA6Im1ha2VfeW91cl9vbmxpbmVfYXBwb2ludG1lbnRfc2NoZWR1bGluZ19zdXBlcl9lYXN5IjtzOjI4ODoiJUQwJUExJUQwJUI0JUQwJUI1JUQwJUJCJUQwJUIwJUQwJUI5JUQxJTgyJUQwJUI1KyVEMSU4MSVEMCVCMiVEMCVCRSVEMCVCNSslRDAlQkUlRDAlQkQlRDAlQkIlRDAlQjAlRDAlQjklRDAlQkQrJUQwJUJGJUQwJUJCJUQwJUIwJUQwJUJEJUQwJUI4JUQxJTgwJUQwJUJFJUQwJUIyJUQwJUIwJUQwJUJEJUQwJUI4JUQwJUI1KyVEMCVCMiVEMSU4MSVEMSU4MiVEMSU4MCVEMCVCNSVEMSU4NyslRDElODElRDElODMlRDAlQkYlRDAlQjUlRDElODArJUQwJUJCJUQwJUI1JUQwJUIzJUQwJUJBJUQwJUI4JUQwJUJDIjtzOjExOiJnZXRfc3RhcnRlZCI7czozNjoiJUQwJTlEJUQwJUIwJUQxJTg3JUQwJUIwJUQxJTgyJUQxJThDIjtzOjQyOiJnZXRfc3RhcnRlZF9ieV9sb2dnaW5nX2luX29yX2J5X3NpZ25pbmdfdXAiO3M6MjYwOiIlRDAlOUQlRDAlQjAlRDElODclRDAlQkQlRDAlQjglRDElODIlRDAlQjUlMkMrJUQwJUIyJUQwJUJFJUQwJUI5JUQwJUI0JUQxJThGKyVEMCVCMislRDElODElRDAlQjglRDElODElRDElODIlRDAlQjUlRDAlQkMlRDElODMrJUQwJUI4JUQwJUJCJUQwJUI4KyVEMCVCNyVEMCVCMCVEMSU4MCVEMCVCNSVEMCVCMyVEMCVCOCVEMSU4MSVEMSU4MiVEMSU4MCVEMCVCOCVEMSU4MCVEMCVCRSVEMCVCMiVEMCVCMCVEMCVCMiVEMSU4OCVEMCVCOCVEMSU4MSVEMSU4QyI7czo3OiJzaWduX2luIjtzOjgwOiIlRDAlOTIlRDAlQkUlRDAlQjklRDElODIlRDAlQjgrJUQwJUIyKyVEMSU4MSVEMCVCOCVEMSU4MSVEMSU4MiVEMCVCNSVEMCVCQyVEMSU4MyI7czoxNjoiZW50ZXJfeW91cl9lbWFpbCI7czoxNzE6IiVEMCU5MiVEMCVCMiVEMCVCNSVEMCVCNCVEMCVCOCVEMSU4MiVEMCVCNSslRDAlQjAlRDAlQjQlRDElODAlRDAlQjUlRDElODErJUQxJThEJUQwJUJCJUQwJUI1JUQwJUJBJUQxJTgyJUQxJTgwJUQwJUJFJUQwJUJEJUQwJUJEJUQwJUJFJUQwJUI5KyVEMCVCRiVEMCVCRSVEMSU4NyVEMSU4MiVEMSU4QiI7czoxNDoiZW50ZXJfcGFzc3dvcmQiO3M6Nzk6IiVEMCU5MiVEMCVCMiVEMCVCNSVEMCVCNCVEMCVCOCVEMSU4MiVEMCVCNSslRDAlQkYlRDAlQjAlRDElODAlRDAlQkUlRDAlQkIlRDElOEMiO3M6MTU6ImZvcmdvdF9wYXNzd29yZCI7czo3MzoiJUQwJTk3JUQwJUIwJUQwJUIxJUQxJThCJUQwJUJCJUQwJUI4KyVEMCVCRiVEMCVCMCVEMSU4MCVEMCVCRSVEMCVCQiVEMSU4QyI7czo1OiJsb2dpbiI7czo4NDoiJUQwJTkwJUQwJUIyJUQxJTgyJUQwJUJFJUQxJTgwJUQwJUI4JUQwJUI3JUQwJUJFJUQwJUIyJUQwJUIwJUQxJTgyJUQxJThDJUQxJTgxJUQxJThGIjtzOjI1OiJkb250X2hhdmVfYWNjb3VudF9zaWduX3VwIjtzOjE2MzoiJUQwJUEzKyVEMCVCMiVEMCVCMCVEMSU4MSslRDAlQkQlRDAlQjUlRDElODIrJUQwJUIwJUQwJUJBJUQwJUJBJUQwJUIwJUQxJTgzJUQwJUJEJUQxJTgyJUQwJUIwJTNGKyVEMCU5RiVEMCVCRSVEMCVCNCVEMCVCRiVEMCVCOCVEMSU4MSVEMCVCMCVEMSU4MiVEMSU4QyVEMSU4MSVEMSU4RiI7czoyNDoiZW50ZXJfZW1haWxfYW5kX3Bhc3N3b3JkIjtzOjIxNToiJUQwJTkyJUQwJUIyJUQwJUI1JUQwJUI0JUQwJUI4JUQxJTgyJUQwJUI1KyVEMCVCMCVEMCVCNCVEMSU4MCVEMCVCNSVEMSU4MSslRDElOEQlRDAlQkIlRDAlQjUlRDAlQkElRDElODIlRDElODAlRDAlQkUlRDAlQkQlRDAlQkQlRDAlQkUlRDAlQjkrJUQwJUJGJUQwJUJFJUQxJTg3JUQxJTgyJUQxJThCKyVEMCVCOCslRDAlQkYlRDAlQjAlRDElODAlRDAlQkUlRDAlQkIlRDElOEMiO3M6NzE6InBsZWFzZV9lbnRlcl95b3VyX3JlZ2lzdGVyZWRfZW1haWxfaWRfd2Vfd2lsbF9zZW5kX290cF90b195b3VyX2VtYWlsX2lkIjtzOjU0OToiJUQwJTlGJUQwJUJFJUQwJUI2JUQwJUIwJUQwJUJCJUQxJTgzJUQwJUI5JUQxJTgxJUQxJTgyJUQwJUIwJTJDKyVEMCVCMiVEMCVCMiVEMCVCNSVEMCVCNCVEMCVCOCVEMSU4MiVEMCVCNSslRDAlQjIlRDAlQjAlRDElODgrJUQwJUI3JUQwJUIwJUQxJTgwJUQwJUI1JUQwJUIzJUQwJUI4JUQxJTgxJUQxJTgyJUQxJTgwJUQwJUI4JUQxJTgwJUQwJUJFJUQwJUIyJUQwJUIwJUQwJUJEJUQwJUJEJUQxJThCJUQwJUI5KyVEMCVCMCVEMCVCNCVEMSU4MCVEMCVCNSVEMSU4MSslRDElOEQlRDAlQkIlRDAlQjUlRDAlQkElRDElODIlRDElODAlRDAlQkUlRDAlQkQlRDAlQkQlRDAlQkUlRDAlQjkrJUQwJUJGJUQwJUJFJUQxJTg3JUQxJTgyJUQxJThCLislRDAlQkMlRDElOEIrJUQwJUIyJUQxJThCJUQxJTg4JUQwJUJCJUQwJUI1JUQwJUJDK09UUCslRDAlQkQlRDAlQjArJUQwJUIyJUQwJUIwJUQxJTg4KyVEMSU4RCVEMCVCQiVEMCVCNSVEMCVCQSVEMSU4MiVEMSU4MCVEMCVCRSVEMCVCRCVEMCVCRCVEMSU4QiVEMCVCOSslRDAlQjAlRDAlQjQlRDElODAlRDAlQjUlRDElODEuIjtzOjE0OiJlbnRlcl95b3VyX290cCI7czo2NToiJUQwJTkyJUQwJUIyJUQwJUI1JUQwJUI0JUQwJUI4JUQxJTgyJUQwJUI1KyVEMCVCMiVEMCVCMCVEMSU4OCtPVFAiO3M6ODoic2VuZF9vdHAiO3M6NTg6IiVEMCU5RSVEMSU4MiVEMCVCRiVEMSU4MCVEMCVCMCVEMCVCMiVEMCVCOCVEMSU4MiVEMSU4QytPVFAiO3M6MTY6ImN1cnJlbnRfcGFzc3dvcmQiO3M6Nzk6IiVEMCVBMiVEMCVCNSVEMCVCQSVEMSU4MyVEMSU4OSVEMCVCOCVEMCVCOSslRDAlQkYlRDAlQjAlRDElODAlRDAlQkUlRDAlQkIlRDElOEMiO3M6MTI6Im5ld19wYXNzd29yZCI7czo2NzoiJUQwJUJEJUQwJUJFJUQwJUIyJUQxJThCJUQwJUI5KyVEMCVCRiVEMCVCMCVEMSU4MCVEMCVCRSVEMCVCQiVEMSU4QyI7czoxNjoiY29uZmlybV9wYXNzd29yZCI7czoxMDM6IiVEMCU5RiVEMCVCRSVEMCVCNCVEMSU4MiVEMCVCMiVEMCVCNSVEMSU4MCVEMCVCNCVEMCVCOCVEMSU4MiVEMCVCNSslRDAlOUYlRDAlQjAlRDElODAlRDAlQkUlRDAlQkIlRDElOEMiO3M6MTE6InNlcnZlcl9kb3duIjtzOjk4OiIlRDAlQTElRDAlQjUlRDElODAlRDAlQjIlRDAlQjUlRDElODArJUQwJUJEJUQwJUI1KyVEMSU4MCVEMCVCMCVEMCVCMSVEMCVCRSVEMSU4MiVEMCVCMCVEMCVCNSVEMSU4MiI7czoxMDoidmVyaWZ5X290cCI7czo1ODoiJUQwJTlGJUQxJTgwJUQwJUJFJUQwJUIyJUQwJUI1JUQxJTgwJUQxJThDJUQxJTgyJUQwJUI1K09UUCI7czo2OiJjbGllbnQiO3M6MzY6IiVEMCVCQSVEMCVCQiVEMCVCOCVEMCVCNSVEMCVCRCVEMSU4MiI7czoxNzoidXBkYXRpbmdfcGFzc3dvcmQiO3M6OTc6IiVEMCU5RSVEMCVCMSVEMCVCRCVEMCVCRSVEMCVCMiVEMCVCQiVEMCVCNSVEMCVCRCVEMCVCOCVEMCVCNSslRDAlQkYlRDAlQjAlRDElODAlRDAlQkUlRDAlQkIlRDElOEYiO3M6Mjk6InBhc3N3b3JkX3VwZGF0ZWRfc3VjY2Vzc2Z1bGx5IjtzOjEyODoiJUQwJTlGJUQwJUIwJUQxJTgwJUQwJUJFJUQwJUJCJUQxJThDKyVEMSU4MyVEMSU4MSVEMCVCRiVEMCVCNSVEMSU4OCVEMCVCRCVEMCVCRSslRDAlQkUlRDAlQjElRDAlQkQlRDAlQkUlRDAlQjIlRDAlQkIlRDAlQjUlRDAlQkQiO3M6MTc6InBhc3N3b3JkX21pc21hdGNoIjtzOjEwNDoiJUQwJTlGJUQwJUIwJUQxJTgwJUQwJUJFJUQwJUJCJUQwJUI4KyVEMCVCRCVEMCVCNSslRDElODElRDAlQkUlRDAlQjIlRDAlQkYlRDAlQjAlRDAlQjQlRDAlQjAlRDElOEUlRDElODIiO3M6MjI6ImluY29ycmVjdF9vbGRfcGFzc3dvcmQiO3M6MTIyOiIlRDAlOUQlRDAlQjUlRDAlQjIlRDAlQjUlRDElODAlRDAlQkQlRDElOEIlRDAlQjkrJUQxJTgxJUQxJTgyJUQwJUIwJUQxJTgwJUQxJThCJUQwJUI5KyVEMCVCRiVEMCVCMCVEMSU4MCVEMCVCRSVEMCVCQiVEMSU4QyI7czoyMjoicGxlYXNlX2ZpbGxfYWxsX2ZpZWxkcyI7czoxNTk6IiVEMCU5RiVEMCVCRSVEMCVCNiVEMCVCMCVEMCVCQiVEMSU4MyVEMCVCOSVEMSU4MSVEMSU4MiVEMCVCMCslRDAlQjclRDAlQjAlRDAlQkYlRDAlQkUlRDAlQkIlRDAlQkQlRDAlQjglRDElODIlRDAlQjUrJUQwJUIyJUQxJTgxJUQwJUI1KyVEMCVCRiVEMCVCRSVEMCVCQiVEMSU4RiI7czo2OiJzdWJtaXQiO3M6NTQ6IiVEMCU5RSVEMSU4MiVEMCVCRiVEMSU4MCVEMCVCMCVEMCVCMiVEMCVCOCVEMSU4MiVEMSU4QyI7czoxMDoiZmlyc3RfbmFtZSI7czoxODoiJUQwJTk4JUQwJUJDJUQxJThGIjtzOjk6Imxhc3RfbmFtZSI7czo0MjoiJUQwJUE0JUQwJUIwJUQwJUJDJUQwJUI4JUQwJUJCJUQwJUI4JUQxJThGIjtzOjU6ImVtYWlsIjtzOjQ0OiIlRDAlQUQlRDAlQkIuKyVEMCVCMCVEMCVCNCVEMSU4MCVEMCVCNSVEMSU4MSI7czo1OiJwaG9uZSI7czo0MjoiJUQwJUEyJUQwJUI1JUQwJUJCJUQwJUI1JUQxJTg0JUQwJUJFJUQwJUJEIjtzOjc6ImFkZHJlc3MiO3M6MzA6IiVEMCU5MCVEMCVCNCVEMSU4MCVEMCVCNSVEMSU4MSI7czo0OiJjaXR5IjtzOjMwOiIlRDAlQjMlRDAlQkUlRDElODAlRDAlQkUlRDAlQjQiO3M6NzoiY291bnRyeSI7czozNjoiJUQwJUExJUQxJTgyJUQxJTgwJUQwJUIwJUQwJUJEJUQwJUIwIjtzOjg6InBvc3Rjb2RlIjtzOjg1OiIlRDAlQkYlRDAlQkUlRDElODclRDElODIlRDAlQkUlRDAlQjIlRDElOEIlRDAlQjkrJUQwJUI4JUQwJUJEJUQwJUI0JUQwJUI1JUQwJUJBJUQxJTgxIjtzOjg6InBhc3N3b3JkIjtzOjM2OiIlRDAlQkYlRDAlQjAlRDElODAlRDAlQkUlRDAlQkIlRDElOEMiO3M6Nzoic2lnbl91cCI7czo2NjoiJUQwJTlGJUQwJUJFJUQwJUI0JUQwJUJGJUQwJUI4JUQxJTgxJUQwJUIwJUQxJTgyJUQxJThDJUQxJTgxJUQxJThGIjtzOjIzOiJhbHJlYWR5X2hhdmVfYW5fYWNjb3VudCI7czo4OToiJUQwJUEzJUQwJUI2JUQwJUI1KyVEMCVCNSVEMSU4MSVEMSU4MiVEMSU4QyslRDAlQjAlRDAlQkElRDAlQkElRDAlQjAlRDElODMlRDAlQkQlRDElODIlM0YiO3M6NDoiaG9tZSI7czo0MjoiJUQwJTkzJUQwJUJCJUQwJUIwJUQwJUIyJUQwJUJEJUQwJUIwJUQxJThGIjtzOjEwOiJ3ZWxjb21lX3RvIjtzOjk4OiIlRDAlOTQlRDAlQkUlRDAlQjElRDElODAlRDAlQkUrJUQwJUJGJUQwJUJFJUQwJUI2JUQwJUIwJUQwJUJCJUQwJUJFJUQwJUIyJUQwJUIwJUQxJTgyJUQxJThDKyVEMCVCMiI7czoxMToibmV3X2Jvb2tpbmciO3M6MTAzOiIlRDAlOUQlRDAlQkUlRDAlQjIlRDAlQkUlRDAlQjUrJUQwJUIxJUQxJTgwJUQwJUJFJUQwJUJEJUQwJUI4JUQxJTgwJUQwJUJFJUQwJUIyJUQwJUIwJUQwJUJEJUQwJUI4JUQwJUI1IjtzOjExOiJteV9ib29raW5ncyI7czo1NToiJUQwJTlDJUQwJUJFJUQwJUI4KyVEMCVCNyVEMCVCMCVEMCVCQSVEMCVCMCVEMCVCNyVEMSU4QiI7czoxNToibXlfdHJhbnNhY3Rpb25zIjtzOjc5OiIlRDAlOUMlRDAlQkUlRDAlQjgrJUQxJTgyJUQxJTgwJUQwJUIwJUQwJUJEJUQwJUI3JUQwJUIwJUQwJUJBJUQxJTg2JUQwJUI4JUQwJUI4IjtzOjExOiJteV9zZXR0aW5ncyI7czo3MzoiJUQwJTlDJUQwJUJFJUQwJUI4KyVEMCVCRCVEMCVCMCVEMSU4MSVEMSU4MiVEMSU4MCVEMCVCRSVEMCVCOSVEMCVCQSVEMCVCOCI7czo0Mjoid2hlcmVfd291bGRfeW91X2xpa2VfdXNfdG9fcHJvdmlkZV9zZXJ2aWNlIjtzOjI0NzoiJUQwJTkzJUQwJUI0JUQwJUI1KyVEMCVCMSVEMSU4QislRDAlQjIlRDElOEIrJUQxJTg1JUQwJUJFJUQxJTgyJUQwJUI1JUQwJUJCJUQwJUI4JTJDKyVEMSU4NyVEMSU4MiVEMCVCRSVEMCVCMSVEMSU4QislRDAlQkMlRDElOEIrJUQwJUJGJUQxJTgwJUQwJUI1JUQwJUI0JUQwJUJFJUQxJTgxJUQxJTgyJUQwJUIwJUQwJUIyJUQwJUJCJUQxJThGJUQwJUJCJUQwJUI4KyVEMSU4MyVEMSU4MSVEMCVCQiVEMSU4MyVEMCVCMyVEMCVCOCUzRiI7czoyMToicGxlYXNlX2Nob29zZV9zZXJ2aWNlIjtzOjE0OToiJUQwJTlGJUQwJUJFJUQwJUI2JUQwJUIwJUQwJUJCJUQxJTgzJUQwJUI5JUQxJTgxJUQxJTgyJUQwJUIwJTJDKyVEMCVCMiVEMSU4QiVEMCVCMSVEMCVCNSVEMSU4MCVEMCVCOCVEMSU4MiVEMCVCNSslRDElODElRDAlQjUlRDElODAlRDAlQjIlRDAlQjglRDElODEiO3M6ODoicHJldmlvdXMiO3M6NjA6IiVEMCVCRiVEMSU4MCVEMCVCNSVEMCVCNCVEMSU4QiVEMCVCNCVEMSU4MyVEMSU4OSVEMCVCOCVEMCVCOSI7czo0OiJuZXh0IjtzOjU0OiIlRDElODElRDAlQkIlRDAlQjUlRDAlQjQlRDElODMlRDElOEUlRDElODklRDAlQjglRDAlQjkiO3M6Nzoic2VydmljZSI7czo3MjoiJUQwJUJFJUQwJUIxJUQxJTgxJUQwJUJCJUQxJTgzJUQwJUI2JUQwJUI4JUQwJUIyJUQwJUIwJUQwJUJEJUQwJUI4JUQwJUI1IjtzOjQ6ImNvc3QiO3M6NTQ6IiVEMCVBMSVEMSU4MiVEMCVCRSVEMCVCOCVEMCVCQyVEMCVCRSVEMSU4MSVEMSU4MiVEMSU4QyI7czoyMDoicGxlYXNlX3NlbGVjdF9tZXRob2QiO3M6MTQzOiIlRDAlOUYlRDAlQkUlRDAlQjYlRDAlQjAlRDAlQkIlRDElODMlRDAlQjklRDElODElRDElODIlRDAlQjAlMkMrJUQwJUIyJUQxJThCJUQwJUIxJUQwJUI1JUQxJTgwJUQwJUI4JUQxJTgyJUQwJUI1KyVEMCVCQyVEMCVCNSVEMSU4MiVEMCVCRSVEMCVCNCI7czoyMDoicGxlYXNlX3NlbGVjdF9vZmZlcnMiO3M6MTc5OiIlRDAlOUYlRDAlQkUlRDAlQjYlRDAlQjAlRDAlQkIlRDElODMlRDAlQjklRDElODElRDElODIlRDAlQjAlMkMrJUQwJUIyJUQxJThCJUQwJUIxJUQwJUI1JUQxJTgwJUQwJUI4JUQxJTgyJUQwJUI1KyVEMCVCRiVEMSU4MCVEMCVCNSVEMCVCNCVEMCVCQiVEMCVCRSVEMCVCNiVEMCVCNSVEMCVCRCVEMCVCOCVEMSU4RiI7czoxODoicGxlYXNlX3NlbGVjdF90aW1lIjtzOjE0MzoiJUQwJTlGJUQwJUJFJUQwJUI2JUQwJUIwJUQwJUJCJUQxJTgzJUQwJUI5JUQxJTgxJUQxJTgyJUQwJUIwJTJDKyVEMCVCMiVEMSU4QiVEMCVCMSVEMCVCNSVEMSU4MCVEMCVCOCVEMSU4MiVEMCVCNSslRDAlOTIlRDElODAlRDAlQjUlRDAlQkMlRDElOEYiO3M6MjA6InBsZWFzZV9zZWxlY3RfYWRkb25zIjtzOjE0OToiJUQwJTlGJUQwJUJFJUQwJUI2JUQwJUIwJUQwJUJCJUQxJTgzJUQwJUI5JUQxJTgxJUQxJTgyJUQwJUIwJTJDKyVEMCVCMiVEMSU4QiVEMCVCMSVEMCVCNSVEMSU4MCVEMCVCOCVEMSU4MiVEMCVCNSslRDAlOTAlRDAlQjQlRDAlQjQlRDAlQkUlRDAlQkQlRDElOEIiO3M6NzoibW9udGhseSI7czo2MDoiJUQwJUI1JUQwJUI2JUQwJUI1JUQwJUJDJUQwJUI1JUQxJTgxJUQxJThGJUQxJTg3JUQwJUJEJUQwJUJFIjtzOjk6ImJpX3dlZWtseSI7czo3OToiJUQwJTkxJUQwJUI4KyVEMCU5NSVEMCVCNiVEMCVCNSVEMCVCRCVEMCVCNSVEMCVCNCVEMCVCNSVEMCVCQiVEMSU4QyVEMCVCRCVEMCVCRSI7czo2OiJ3ZWVrbHkiO3M6NjY6IiVEMCVCNSVEMCVCNiVEMCVCNSVEMCVCRCVEMCVCNSVEMCVCNCVEMCVCNSVEMCVCQiVEMSU4QyVEMCVCRCVEMCVCRSI7czo0OiJvbmNlIjtzOjQyOiIlRDAlQkUlRDAlQjQlRDAlQkQlRDAlQjAlRDAlQjYlRDAlQjQlRDElOEIiO3M6MTg6InBsZWFzZV9zZWxlY3RfZGF0ZSI7czoxMzc6IiVEMCU5RiVEMCVCRSVEMCVCNiVEMCVCMCVEMCVCQiVEMSU4MyVEMCVCOSVEMSU4MSVEMSU4MiVEMCVCMCUyQyslRDAlQjIlRDElOEIlRDAlQjElRDAlQjUlRDElODAlRDAlQjglRDElODIlRDAlQjUrJUQwJTk0JUQwJUIwJUQxJTgyJUQwJUIwIjtzOjQ6ImRhdGUiO3M6MjQ6IiVEMCU5NCVEMCVCMCVEMSU4MiVEMCVCMCI7czoyMjoicGxlYXNlX3NlbGVjdF9wcm92aWRlciI7czoxNzM6IiVEMCU5RiVEMCVCRSVEMCVCNiVEMCVCMCVEMCVCQiVEMSU4MyVEMCVCOSVEMSU4MSVEMSU4MiVEMCVCMCUyQyslRDAlQjIlRDElOEIlRDAlQjElRDAlQjUlRDElODAlRDAlQjglRDElODIlRDAlQjUrJUQwJUJGJUQxJTgwJUQwJUJFJUQwJUIyJUQwJUIwJUQwJUI5JUQwJUI0JUQwJUI1JUQxJTgwJUQwJUIwIjtzOjQ6InRpbWUiO3M6MzA6IiVEMCU5MiVEMSU4MCVEMCVCNSVEMCVCQyVEMSU4RiI7czoxMzoiaW5jbHVkaW5nX3RheCI7czo4NzoiJUQwJTkyKyVEMSU4MiVEMCVCRSVEMCVCQyslRDElODclRDAlQjglRDElODElRDAlQkIlRDAlQjUrJUQwJUJEJUQwJUIwJUQwJUJCJUQwJUJFJUQwJUIzIjtzOjI0OiJwcmVmZXJyZWRfcGF5bWVudF9tZXRob2QiO3M6MTcwOiIlRDAlOUYlRDElODAlRDAlQjUlRDAlQjQlRDAlQkYlRDAlQkUlRDElODclRDElODIlRDAlQjglRDElODIlRDAlQjUlRDAlQkIlRDElOEMlRDAlQkQlRDElOEIlRDAlQjkrJUQxJTgxJUQwJUJGJUQwJUJFJUQxJTgxJUQwJUJFJUQwJUIxKyVEMCVCRSVEMCVCRiVEMCVCQiVEMCVCMCVEMSU4MiVEMSU4QiI7czoxMToibG9jYWxseV9wYXkiO3M6OTE6IiVEMCU5QiVEMCVCRSVEMCVCQSVEMCVCMCVEMCVCQiVEMSU4QyVEMCVCRCVEMCVCRSslRDAlQkYlRDAlQkIlRDAlQjAlRDElODIlRDAlQjglRDElODIlRDElOEMiO3M6MjU6ImNyZWRpdF9kZWJpdF9jYXJkX3BheW1lbnQiO3M6MTg3OiIlRDAlOUUlRDAlQkYlRDAlQkIlRDAlQjAlRDElODIlRDAlQjArJUQwJUJBJUQxJTgwJUQwJUI1JUQwJUI0JUQwJUI4JUQxJTgyJUQwJUJEJUQwJUJFJUQwJUI5KyUyRislRDAlQjQlRDAlQjUlRDAlQjElRDAlQjUlRDElODIlRDAlQkUlRDAlQjIlRDAlQkUlRDAlQjkrJUQwJUJBJUQwJUIwJUQxJTgwJUQxJTgyJUQwJUJFJUQwJUI5IjtzOjY6ImNhbmNlbCI7czo0ODoiJUQwJUJFJUQxJTgyJUQwJUJDJUQwJUI1JUQwJUJEJUQwJUI4JUQxJTgyJUQxJThDIjtzOjI1OiJjcmVkaXRfZGViaXRfY2FyZF9kZXRhaWxzIjtzOjE4MToiJUQwJTk0JUQwJUIwJUQwJUJEJUQwJUJEJUQxJThCJUQwJUI1KyVEMCVCQSVEMSU4MCVEMCVCNSVEMCVCNCVEMCVCOCVEMSU4MiVEMCVCRCVEMCVCRSVEMCVCOSslMkYrJUQwJUI0JUQwJUI1JUQwJUIxJUQwJUI1JUQxJTgyJUQwJUJFJUQwJUIyJUQwJUJFJUQwJUI5KyVEMCVCQSVEMCVCMCVEMSU4MCVEMSU4MiVEMSU4QiI7czoxMjoic2VydmljZV9uYW1lIjtzOjEwOToiJUQwJUJEJUQwJUIwJUQwJUI4JUQwJUJDJUQwJUI1JUQwJUJEJUQwJUJFJUQwJUIyJUQwJUIwJUQwJUJEJUQwJUI4JUQwJUI1KyVEMSU4MyVEMSU4MSVEMCVCQiVEMSU4MyVEMCVCMyVEMCVCOCI7czoxMjoiYm9va2luZ19kYXRlIjtzOjk3OiIlRDAlOTQlRDAlQjAlRDElODIlRDAlQjArJUQwJUIxJUQxJTgwJUQwJUJFJUQwJUJEJUQwJUI4JUQxJTgwJUQwJUJFJUQwJUIyJUQwJUIwJUQwJUJEJUQwJUI4JUQxJThGIjtzOjExOiJjYXJ0X2Ftb3VudCI7czo4MDoiJUQwJUExJUQxJTgzJUQwJUJDJUQwJUJDJUQwJUIwKyVEMCVCMislRDAlQkElRDAlQkUlRDElODAlRDAlQjclRDAlQjglRDAlQkQlRDAlQjUiO3M6MTY6ImJvb2tfYXBwb2ludG1lbnQiO3M6OTE6IiVEMCU5RCVEMCVCMCVEMCVCNyVEMCVCRCVEMCVCMCVEMSU4NyVEMCVCNSVEMCVCRCVEMCVCOCVEMCVCNSslRDAlQkElRDAlQkQlRDAlQjglRDAlQjMlRDAlQjgiO3M6MTE6ImNhcmRfbnVtYmVyIjtzOjYxOiIlRDAlOUQlRDAlQkUlRDAlQkMlRDAlQjUlRDElODArJUQwJUJBJUQwJUIwJUQxJTgwJUQxJTgyJUQxJThCIjtzOjEyOiJleHBpcnlfbW9udGgiO3M6ODU6IiVEMCU5QyVEMCVCNSVEMSU4MSVEMSU4RiVEMSU4NislRDAlQjglRDElODElRDElODIlRDAlQjUlRDElODclRDAlQjUlRDAlQkQlRDAlQjglRDElOEYiO3M6MTE6ImV4cGlyeV95ZWFyIjtzOjczOiIlRDAlOTMlRDAlQkUlRDAlQjQrJUQwJUI4JUQxJTgxJUQxJTgyJUQwJUI1JUQxJTg3JUQwJUI1JUQwJUJEJUQwJUI4JUQxJThGIjtzOjE1OiJib29raW5nX3N1bW1hcnkiO3M6MTA5OiIlRDAlQTElRDAlQjIlRDAlQkUlRDAlQjQlRDAlQkElRDAlQjArJUQwJUIxJUQxJTgwJUQwJUJFJUQwJUJEJUQwJUI4JUQxJTgwJUQwJUJFJUQwJUIyJUQwJUIwJUQwJUJEJUQwJUI4JUQxJThGIjtzOjg6ImNhcmRfY3ZjIjtzOjM0OiIlRDAlOUElRDAlQjAlRDElODAlRDElODIlRDAlQjArQ1ZDIjtzOjM6ImFsbCI7czoxODoiJUQwJTkyJUQxJTgxJUQwJUI1IjtzOjQ6InBhc3QiO3M6NDI6IiVEMCVCRiVEMSU4MCVEMCVCRSVEMSU4OCVEMCVCQiVEMCVCRSVEMCVCNSI7czo4OiJ1cGNvbWluZyI7czo2NjoiJUQwJUJGJUQxJTgwJUQwJUI1JUQwJUI0JUQxJTgxJUQxJTgyJUQwJUJFJUQxJThGJUQxJTg5JUQwJUI4JUQwJUI5IjtzOjE3OiJub19kYXRhX2F2YWlsYWJsZSI7czo5NzoiJUQwJTk0JUQwJUIwJUQwJUJEJUQwJUJEJUQxJThCJUQwJUI1KyVEMCVCRCVEMCVCNSVEMCVCNCVEMCVCRSVEMSU4MSVEMSU4MiVEMSU4MyVEMCVCRiVEMCVCRCVEMSU4QiI7czo5OiJjb25maXJtZWQiO3M6NjA6IiVEMCVCRiVEMCVCRSVEMCVCNCVEMSU4MiVEMCVCMiVEMCVCNSVEMSU4MCVEMCVCNCVEMCVCOCVEMCVCQiI7czo4OiJyZWplY3RlZCI7czo1NDoiJUQwJTlFJUQxJTgyJUQwJUJBJUQwJUJCJUQwJUJFJUQwJUJEJUQwJUI1JUQwJUJEJUQwJUJFIjtzOjc6InBlbmRpbmciO3M6NTU6IiVEMCVCMislRDAlQkUlRDAlQjYlRDAlQjglRDAlQjQlRDAlQjAlRDAlQkQlRDAlQjglRDAlQjgiO3M6OToiY2FuY2VsbGVkIjtzOjQyOiIlRDAlQkUlRDElODIlRDAlQkMlRDAlQjUlRDAlQkQlRDAlQjUlRDAlQkQiO3M6MTA6InJlc2NoZWR1bGUiO3M6OTY6IiVEMCU5RiVEMCVCNSVEMSU4MCVEMCVCNSVEMCVCRiVEMCVCQiVEMCVCMCVEMCVCRCVEMCVCOCVEMSU4MCVEMCVCRSVEMCVCMiVEMCVCMCVEMCVCRCVEMCVCOCVEMCVCNSI7czo3OiJub19zaG93IjtzOjczOiIlRDAlOUQlRDAlQjUrJUQwJUJGJUQwJUJFJUQwJUJBJUQwJUIwJUQwJUI3JUQxJThCJUQwJUIyJUQwJUIwJUQxJTgyJUQxJThDIjtzOjc6ImRldGFpbHMiO3M6NjY6IiVEMCVCRiVEMCVCRSVEMCVCNCVEMSU4MCVEMCVCRSVEMCVCMSVEMCVCRCVEMCVCRSVEMSU4MSVEMSU4MiVEMCVCOCI7czoxNzoibG9hZGluZ19tb3JlX2RhdGEiO3M6MTcwOiIlRDAlOTclRDAlQjAlRDAlQjMlRDElODAlRDElODMlRDAlQjclRDAlQkElRDAlQjArJUQwJUI0JUQwJUJFJUQwJUJGJUQwJUJFJUQwJUJCJUQwJUJEJUQwJUI4JUQxJTgyJUQwJUI1JUQwJUJCJUQxJThDJUQwJUJEJUQxJThCJUQxJTg1KyVEMCVCNCVEMCVCMCVEMCVCRCVEMCVCRCVEMSU4QiVEMSU4NSI7czo5OiJkYXNoYm9hcmQiO3M6ODU6IiVEMCU5RiVEMSU4MCVEMCVCOCVEMCVCMSVEMCVCRSVEMSU4MCVEMCVCRCVEMCVCMCVEMSU4RislRDAlQjQlRDAlQkUlRDElODElRDAlQkElRDAlQjAiO3M6NToicHJpY2UiO3M6MjQ6IiVEMCVBNiVEMCVCNSVEMCVCRCVEMCVCMCI7czo4OiJvcmRlcl9pZCI7czo2NzoiJUQwJTlEJUQwJUJFJUQwJUJDJUQwJUI1JUQxJTgwKyVEMCVCNyVEMCVCMCVEMCVCQSVEMCVCMCVEMCVCNyVEMCVCMCI7czo0OiJ1bml0IjtzOjk3OiIlRDAlOTUlRDAlQjQlRDAlQjglRDAlQkQlRDAlQjglRDElODYlRDAlQjArJUQwJUI4JUQwJUI3JUQwJUJDJUQwJUI1JUQxJTgwJUQwJUI1JUQwJUJEJUQwJUI4JUQxJThGIjtzOjY6ImFkZF9vbiI7czo0ODoiJUQwJTk0JUQwJUJFJUQwJUIxJUQwJUIwJUQwJUIyJUQwJUI4JUQxJTgyJUQxJThDIjtzOjY6Im1ldGhvZCI7czozMDoiJUQwJUJDJUQwJUI1JUQxJTgyJUQwJUJFJUQwJUI0IjtzOjEyOiJwYXltZW50X3R5cGUiO3M6NzM6IiVEMCVBMSVEMCVCRiVEMCVCRSVEMSU4MSVEMCVCRSVEMCVCMSslRDAlQkUlRDAlQkYlRDAlQkIlRDAlQjAlRDElODIlRDElOEIiO3M6MTQ6ImJvb2tpbmdfc3RhdHVzIjtzOjEwOToiJUQwJUExJUQxJTgyJUQwJUIwJUQxJTgyJUQxJTgzJUQxJTgxKyVEMCVCMSVEMSU4MCVEMCVCRSVEMCVCRCVEMCVCOCVEMSU4MCVEMCVCRSVEMCVCMiVEMCVCMCVEMCVCRCVEMCVCOCVEMSU4RiI7czozMDoiYXBwb2ludG1lbnRfbWFya2VkX2FzX25vX3Nob3duIjtzOjE5MDoiJUQwJTlEJUQwJUIwJUQwJUI3JUQwJUJEJUQwJUIwJUQxJTg3JUQwJUI1JUQwJUJEJUQwJUI4JUQwJUI1KyVEMCVCRiVEMCVCRSVEMCVCQyVEMCVCNSVEMSU4NyVEMCVCNSVEMCVCRCVEMCVCRSslRDAlQkElRDAlQjAlRDAlQkErJUQwJUJEJUQwJUI1KyVEMCVCRiVEMCVCRSVEMCVCQSVEMCVCMCVEMCVCNyVEMCVCMCVEMCVCRCVEMCVCRSI7czoyOToiY2FuY2VsbGVkX2J5X3NlcnZpY2VfcHJvdmlkZXIiO3M6MTQ2OiIlRDAlOUUlRDElODIlRDAlQkMlRDAlQjUlRDAlQkQlRDAlQjUlRDAlQkQlRDAlQkUrJUQwJUJGJUQwJUJFJUQxJTgxJUQxJTgyJUQwJUIwJUQwJUIyJUQxJTg5JUQwJUI4JUQwJUJBJUQwJUJFJUQwJUJDKyVEMSU4MyVEMSU4MSVEMCVCQiVEMSU4MyVEMCVCMyI7czoyMToiY2FuY2VsbGVkX2J5X2N1c3RvbWVyIjtzOjk3OiIlRDAlOUUlRDElODIlRDAlQkMlRDAlQjUlRDAlQkQlRDAlQjUlRDAlQkQlRDAlQkUrJUQwJUJBJUQwJUJCJUQwJUI4JUQwJUI1JUQwJUJEJUQxJTgyJUQwJUJFJUQwJUJDIjtzOjEwOiJzdGFydF9kYXRlIjtzOjYxOiIlRDAlOTQlRDAlQjAlRDElODIlRDAlQjArJUQwJUJEJUQwJUIwJUQxJTg3JUQwJUIwJUQwJUJCJUQwJUIwIjtzOjEwOiJzdGFydF90aW1lIjtzOjg1OiIlRDAlOUQlRDAlQjAlRDElODclRDAlQjAlRDAlQkIlRDElOEMlRDAlQkQlRDAlQkUlRDAlQjUrJUQwJUIyJUQxJTgwJUQwJUI1JUQwJUJDJUQxJThGIjtzOjIwOiJwYXltZW50X3RyYW5zYWN0aW9ucyI7czoxMDM6IiVEMCU5RiVEMCVCQiVEMCVCMCVEMSU4MiVEMCVCNSVEMCVCNiVEMCVCRCVEMSU4QiVEMCVCNSslRDAlQkUlRDAlQkYlRDAlQjUlRDElODAlRDAlQjAlRDElODYlRDAlQjglRDAlQjgiO3M6MTA6Im15X2FjY291bnQiO3M6NjE6IiVEMCU5QyVEMCVCRSVEMCVCOSslRDAlQjAlRDAlQkElRDAlQkElRDAlQjAlRDElODMlRDAlQkQlRDElODIiO3M6NDoibmFtZSI7czo0ODoiJUQwJUJEJUQwJUIwJUQwJUI3JUQwJUIyJUQwJUIwJUQwJUJEJUQwJUI4JUQwJUI1IjtzOjY6InVwZGF0ZSI7czo0ODoiJUQwJTlFJUQwJUIxJUQwJUJEJUQwJUJFJUQwJUIyJUQwJUI4JUQxJTgyJUQxJThDIjtzOjg6ImN1c3RvbWVyIjtzOjYwOiIlRDAlOUYlRDAlQkUlRDAlQkElRDElODMlRDAlQkYlRDAlQjAlRDElODIlRDAlQjUlRDAlQkIlRDElOEMiO3M6NToic3RhZmYiO3M6OTE6IiVEMCVBOCVEMSU4MiVEMCVCMCVEMSU4MislRDElODElRDAlQkUlRDElODIlRDElODAlRDElODMlRDAlQjQlRDAlQkQlRDAlQjglRDAlQkElRDAlQkUlRDAlQjIiO3M6MjA6InNjaGVkdWxlX2FwcG9pbnRtZW50IjtzOjk3OiIlRDAlOUQlRDAlQjAlRDAlQjclRDAlQkQlRDAlQjAlRDElODclRDAlQjglRDElODIlRDElOEMrJUQwJUIyJUQxJTgxJUQxJTgyJUQxJTgwJUQwJUI1JUQxJTg3JUQxJTgzIjtzOjEwOiJjb250YWN0X3VzIjtzOjg2OiIlRDAlQTElRDAlQjIlRDElOEYlRDAlQjclRDAlQjAlRDElODIlRDElOEMlRDElODElRDElOEYrJUQxJTgxKyVEMCVCRCVEMCVCMCVEMCVCQyVEMCVCOCI7czo4OiJmZWVkYmFjayI7czo3OToiJUQwJTlFJUQwJUIxJUQxJTgwJUQwJUIwJUQxJTgyJUQwJUJEJUQwJUIwJUQxJThGKyVEMSU4MSVEMCVCMiVEMSU4RiVEMCVCNyVEMSU4QyI7czo2OiJsb2dvdXQiO3M6MzA6IiVEMCU5MiVEMSU4QiVEMCVCOSVEMSU4MiVEMCVCOCI7czoxNDoiZW50ZXJfZmVlZGJhY2siO3M6NzM6IiVEMCU5MiVEMCVCMiVEMCVCNSVEMCVCNCVEMCVCOCVEMSU4MiVEMCVCNSslRDAlQkUlRDElODIlRDAlQjclRDElOEIlRDAlQjIiO3M6MTY6ImZldGNoaW5nX21ldGhvZHMiO3M6Nzk6IiVEMCU5QyVEMCVCNSVEMSU4MiVEMCVCRSVEMCVCNCVEMSU4QislRDAlQjIlRDElOEIlRDAlQjElRDAlQkUlRDElODAlRDAlQkElRDAlQjgiO3M6MzY6InRoYW5rX3lvdV9mb3JfeW91cl92YWx1YWJsZV9mZWVkYmFjayI7czoxNDI6IiVEMCVBMSVEMCVCRiVEMCVCMCVEMSU4MSVEMCVCOCVEMCVCMSVEMCVCRSslRDAlQjclRDAlQjArJUQwJTkyJUQwJUIwJUQxJTg4KyVEMSU4NiVEMCVCNSVEMCVCRCVEMCVCRCVEMSU4QiVEMCVCOSslRDAlQkUlRDElODIlRDAlQjclRDElOEIlRDAlQjIiO3M6MjU6InVuYWJsZV90b19zdWJtaXRfZmVlZGJhY2siO3M6MTQ2OiIlRDAlOUQlRDAlQjUlRDAlQjIlRDAlQkUlRDAlQjclRDAlQkMlRDAlQkUlRDAlQjYlRDAlQkQlRDAlQkUrJUQwJUJFJUQxJTgyJUQwJUJGJUQxJTgwJUQwJUIwJUQwJUIyJUQwJUI4JUQxJTgyJUQxJThDKyVEMCVCRSVEMSU4MiVEMCVCNyVEMSU4QiVEMCVCMiI7czoyMToicGxlYXNlX2VudGVyX2ZlZWRiYWNrIjtzOjEzNzoiJUQwJTlGJUQwJUJFJUQwJUI2JUQwJUIwJUQwJUJCJUQxJTgzJUQwJUI5JUQxJTgxJUQxJTgyJUQwJUIwJTJDKyVEMCVCMiVEMCVCMiVEMCVCNSVEMCVCNCVEMCVCOCVEMSU4MiVEMCVCNSslRDAlQkUlRDElODIlRDAlQjclRDElOEIlRDAlQjIiO3M6MTM6Im5vdGlmaWNhdGlvbnMiO3M6NjY6IiVEMCVBMyVEMCVCMiVEMCVCNSVEMCVCNCVEMCVCRSVEMCVCQyVEMCVCQiVEMCVCNSVEMCVCRCVEMCVCOCVEMSU4RiI7czoxOToibmV3X2Jvb2tpbmdfc3VjY2VzcyI7czoxMzQ6IiVEMCU5RCVEMCVCRSVEMCVCMiVEMSU4QiVEMCVCOSslRDElODMlRDElODElRDAlQkYlRDAlQjUlRDElODUrJUQwJUIxJUQxJTgwJUQwJUJFJUQwJUJEJUQwJUI4JUQxJTgwJUQwJUJFJUQwJUIyJUQwJUIwJUQwJUJEJUQwJUI4JUQxJThGIjtzOjIwOiJhY3Rpdml0eV9yZXNjaGVkdWxlZCI7czoxMzM6IiVEMCU5NCVEMCVCNSVEMSU4RiVEMSU4MiVEMCVCNSVEMCVCQiVEMSU4QyVEMCVCRCVEMCVCRSVEMSU4MSVEMSU4MiVEMSU4QyslRDAlQkYlRDAlQjUlRDElODAlRDAlQjUlRDAlQkQlRDAlQjUlRDElODElRDAlQjUlRDAlQkQlRDAlQjAiO3M6MTc6Im5vX3NlcnZpY2VzX2ZvdW5kIjtzOjkyOiIlRDAlQTMlRDElODElRDAlQkIlRDElODMlRDAlQjMlRDAlQjgrJUQwJUJEJUQwJUI1KyVEMCVCRCVEMCVCMCVEMCVCOSVEMCVCNCVEMCVCNSVEMCVCRCVEMSU4QiI7czoxNjoiYXBpX2tleV9taXNtYXRjaCI7czoxMTk6IiVEMCU5RCVEMCVCNSVEMSU4MSVEMCVCRSVEMCVCRSVEMSU4MiVEMCVCMiVEMCVCNSVEMSU4MiVEMSU4MSVEMSU4MiVEMCVCMiVEMCVCOCVEMCVCNSslRDAlQkElRDAlQkIlRDElOEUlRDElODclRDAlQjArQVBJIjtzOjIxOiJwb3N0YWxfY29kZV9ub3RfZm91bmQiO3M6MTM1OiIlRDAlOUYlRDAlQkUlRDElODclRDElODIlRDAlQkUlRDAlQjIlRDElOEIlRDAlQjkrJUQwJUI4JUQwJUJEJUQwJUI0JUQwJUI1JUQwJUJBJUQxJTgxKyVEMCVCRCVEMCVCNSslRDAlQkQlRDAlQjAlRDAlQjklRDAlQjQlRDAlQjUlRDAlQkQiO3M6MTc6InBvc3RhbF9jb2RlX2ZvdW5kIjtzOjEyMjoiJUQwJTlGJUQwJUJFJUQxJTg3JUQxJTgyJUQwJUJFJUQwJUIyJUQxJThCJUQwJUI5KyVEMCVCOCVEMCVCRCVEMCVCNCVEMCVCNSVEMCVCQSVEMSU4MSslRDAlQkQlRDAlQjAlRDAlQjklRDAlQjQlRDAlQjUlRDAlQkQiO3M6Mjg6ImV4dHJhX3NlcnZpY2VzX25vdF9hdmFpbGFibGUiO3M6MTgyOiIlRDAlOTQlRDAlQkUlRDAlQkYlRDAlQkUlRDAlQkIlRDAlQkQlRDAlQjglRDElODIlRDAlQjUlRDAlQkIlRDElOEMlRDAlQkQlRDElOEIlRDAlQjUrJUQxJTgzJUQxJTgxJUQwJUJCJUQxJTgzJUQwJUIzJUQwJUI4KyVEMCVCRCVEMCVCNSVEMCVCNCVEMCVCRSVEMSU4MSVEMSU4MiVEMSU4MyVEMCVCRiVEMCVCRCVEMSU4QiI7czoxODoibm9fdW5pdHNfYXZhaWxhYmxlIjtzOjExMDoiJUQwJTlEJUQwJUI1JUQxJTgyKyVEMCVCNCVEMCVCRSVEMSU4MSVEMSU4MiVEMSU4MyVEMCVCRiVEMCVCRCVEMSU4QiVEMSU4NSslRDAlQjUlRDAlQjQlRDAlQjglRDAlQkQlRDAlQjglRDElODYiO3M6Mjg6Im5vX2ZyZXF1ZW50bHlfZGlzY291bnRfZm91bmQiO3M6OTI6IiVEMCVBMSVEMCVCQSVEMCVCOCVEMCVCNCVEMCVCQSVEMCVCOCslRDAlQkQlRDAlQjUrJUQwJUJEJUQwJUIwJUQwJUI5JUQwJUI0JUQwJUI1JUQwJUJEJUQxJThCIjtzOjM1OiJpbmNvcnJlY3RfZW1haWxfYWRkcmVzc19vcl9wYXNzd29yZCI7czoyMzM6IiVEMCU5RCVEMCVCNSVEMCVCMiVEMCVCNSVEMSU4MCVEMCVCRCVEMSU4QiVEMCVCOSslRDAlQjAlRDAlQjQlRDElODAlRDAlQjUlRDElODErJUQxJThEJUQwJUJCJUQwJUI1JUQwJUJBJUQxJTgyJUQxJTgwJUQwJUJFJUQwJUJEJUQwJUJEJUQwJUJFJUQwJUI5KyVEMCVCRiVEMCVCRSVEMSU4NyVEMSU4MiVEMSU4QislRDAlQjglRDAlQkIlRDAlQjgrJUQwJUJGJUQwJUIwJUQxJTgwJUQwJUJFJUQwJUJCJUQxJThDIjtzOjIxOiJub19hcHBvaW50bWVudHNfZm91bmQiO3M6OTg6IiVEMCU5MiVEMSU4MSVEMSU4MiVEMSU4MCVEMCVCNSVEMSU4NyVEMCVCOCslRDAlQkQlRDAlQjUrJUQwJUJEJUQwJUIwJUQwJUI5JUQwJUI0JUQwJUI1JUQwJUJEJUQxJThCIjtzOjQxOiJ5b3VyX2FwcG9pbnRtZW50X3Jlc2NoZWR1bGVkX3N1Y2Nlc3NmdWxseSI7czoxNzE6IiVEMCU5MiVEMCVCMCVEMSU4OCVEMCVCMCslRDAlQjIlRDElODElRDElODIlRDElODAlRDAlQjUlRDElODclRDAlQjArJUQwJUJGJUQwJUI1JUQxJTgwJUQwJUI1JUQwJUJEJUQwJUI1JUQxJTgxJUQwJUI1JUQwJUJEJUQwJUIwKyVEMSU4MyVEMSU4MSVEMCVCRiVEMCVCNSVEMSU4OCVEMCVCRCVEMCVCRSI7czoyNjoic29ycnlfd2VfYXJlX25vdF9hdmFpbGFibGUiO3M6MTQwOiIlRDAlOUErJUQxJTgxJUQwJUJFJUQwJUI2JUQwJUIwJUQwJUJCJUQwJUI1JUQwJUJEJUQwJUI4JUQxJThFJTJDKyVEMCVCQyVEMSU4QislRDAlQkQlRDAlQjUrJUQwJUI0JUQwJUJFJUQxJTgxJUQxJTgyJUQxJTgzJUQwJUJGJUQwJUJEJUQxJThCLiI7czozOToieW91cl9hcHBvaW50bWVudF9jYW5jZWxsZWRfc3VjY2Vzc2Z1bGx5IjtzOjE1OToiJUQwJTkyJUQwJUIwJUQxJTg4JUQwJUIwKyVEMCVCMiVEMSU4MSVEMSU4MiVEMSU4MCVEMCVCNSVEMSU4NyVEMCVCMCslRDElODMlRDElODElRDAlQkYlRDAlQjUlRDElODglRDAlQkQlRDAlQkUrJUQwJUJFJUQxJTgyJUQwJUJDJUQwJUI1JUQwJUJEJUQwJUI1JUQwJUJEJUQwJUIwIjtzOjE5OiJjb3Vwb25fY29kZV9leHBpcmVkIjtzOjg2OiIlRDAlOUElRDAlQkUlRDAlQjQrJUQwJUJBJUQxJTgzJUQwJUJGJUQwJUJFJUQwJUJEJUQwJUIwKyVEMCVCOCVEMSU4MSVEMSU4MiVEMCVCNSVEMCVCQSI7czoxOToiaW52YWxpZF9jb3Vwb25fY29kZSI7czoxMDQ6IiVEMCU5RCVEMCVCNSVEMCVCMiVEMCVCNSVEMSU4MCVEMCVCRCVEMSU4QiVEMCVCOSslRDAlQkElRDAlQkUlRDAlQjQrJUQwJUJBJUQxJTgzJUQwJUJGJUQwJUJFJUQwJUJEJUQwJUIwIjtzOjI3OiJwYXJ0aWFsX2RlcG9zaXRfaXNfZGlzYWJsZWQiO3M6MTA0OiIlRDAlOUQlRDAlQjUlRDAlQjIlRDAlQjUlRDElODAlRDAlQkQlRDElOEIlRDAlQjkrJUQwJUJBJUQwJUJFJUQwJUI0KyVEMCVCQSVEMSU4MyVEMCVCRiVEMCVCRSVEMCVCRCVEMCVCMCI7czo1NDoibm9uZV9vZl90aW1lX3Nsb3RfYXZhaWxhYmxlX3BsZWFzZV9jaGVja19hbm90aGVyX2RhdGVzIjtzOjM3MzoiJUQwJTlEJUQwJUI1JUQxJTgyKyVEMCVCNCVEMCVCRSVEMSU4MSVEMSU4MiVEMSU4MyVEMCVCRiVEMCVCRCVEMSU4QiVEMSU4NSslRDAlQjIlRDElODAlRDAlQjUlRDAlQkMlRDAlQjUlRDAlQkQlRDAlQkQlRDElOEIlRDElODUrJUQwJUI4JUQwJUJEJUQxJTgyJUQwJUI1JUQxJTgwJUQwJUIyJUQwJUIwJUQwJUJCJUQwJUJFJUQwJUIyJTJDKyVEMCVCRiVEMCVCRSVEMCVCNiVEMCVCMCVEMCVCQiVEMSU4MyVEMCVCOSVEMSU4MSVEMSU4MiVEMCVCMCUyQyslRDAlQkYlRDElODAlRDAlQkUlRDAlQjIlRDAlQjUlRDElODAlRDElOEMlRDElODIlRDAlQjUrJUQwJUI0JUQxJTgwJUQxJTgzJUQwJUIzJUQwJUI4JUQwJUI1KyVEMCVCNCVEMCVCMCVEMSU4MiVEMSU4QiI7czo0NjoiYXZhaWxhYmlsaXR5X2lzX25vdF9jb25maWd1cmVkX2Zyb21fYWRtaW5fc2lkZSI7czoyOTk6IiVEMCU5NCVEMCVCRSVEMSU4MSVEMSU4MiVEMSU4MyVEMCVCRiVEMCVCRCVEMCVCRSVEMSU4MSVEMSU4MiVEMSU4QyslRDAlQkQlRDAlQjUrJUQwJUJEJUQwJUIwJUQxJTgxJUQxJTgyJUQxJTgwJUQwJUIwJUQwJUI4JUQwJUIyJUQwJUIwJUQwJUI1JUQxJTgyJUQxJTgxJUQxJThGKyVEMSU4MSVEMCVCRSslRDElODElRDElODIlRDAlQkUlRDElODAlRDAlQkUlRDAlQkQlRDElOEIrJUQwJUIwJUQwJUI0JUQwJUJDJUQwJUI4JUQwJUJEJUQwJUI4JUQxJTgxJUQxJTgyJUQxJTgwJUQwJUIwJUQxJTgyJUQwJUJFJUQxJTgwJUQwJUIwIjtzOjI5OiJjdXN0b21lcl9jcmVhdGVkX3N1Y2Nlc3NmdWxseSI7czoxMTY6IiVEMCU5QSVEMCVCQiVEMCVCOCVEMCVCNSVEMCVCRCVEMSU4MislRDElODMlRDElODElRDAlQkYlRDAlQjUlRDElODglRDAlQkQlRDAlQkUrJUQxJTgxJUQwJUJFJUQwJUI3JUQwJUI0JUQwJUIwJUQwJUJEIjtzOjMxOiJlcnJvcl9vY2N1cnJlZF9wbGVhc2VfdHJ5X2FnYWluIjtzOjE5MzoiJUQwJTlGJUQxJTgwJUQwJUJFJUQwJUI4JUQwJUI3JUQwJUJFJUQxJTg4JUQwJUJCJUQwJUIwKyVEMCVCRSVEMSU4OCVEMCVCOCVEMCVCMSVEMCVCQSVEMCVCMCUyQyslRDAlQkYlRDAlQkUlRDAlQkYlRDElODAlRDAlQkUlRDAlQjElRDElODMlRDAlQjklRDElODIlRDAlQjUrJUQwJUI1JUQxJTg5JUQwJUI1KyVEMSU4MCVEMCVCMCVEMCVCNyI7czozMToiYXBwb2ludG1lbnRfYm9va2VkX3N1Y2Nlc3NmdWxseSI7czoxODI6IiVEMCU5RCVEMCVCMCVEMCVCNyVEMCVCRCVEMCVCMCVEMSU4NyVEMCVCNSVEMCVCRCVEMCVCOCVEMCVCNSslRDAlQjclRDAlQjAlRDAlQjElRDElODAlRDAlQkUlRDAlQkQlRDAlQjglRDElODAlRDAlQkUlRDAlQjIlRDAlQjAlRDAlQkQlRDAlQkUrJUQxJTgzJUQxJTgxJUQwJUJGJUQwJUI1JUQxJTg4JUQwJUJEJUQwJUJFIjtzOjI0OiJ1c2VyX2RldGFpbHNfbm90X3VwZGF0ZWQiO3M6MTc3OiIlRDAlOTQlRDAlQjAlRDAlQkQlRDAlQkQlRDElOEIlRDAlQjUrJUQwJUJGJUQwJUJFJUQwJUJCJUQxJThDJUQwJUI3JUQwJUJFJUQwJUIyJUQwJUIwJUQxJTgyJUQwJUI1JUQwJUJCJUQxJThGKyVEMCVCRCVEMCVCNSslRDAlQkUlRDAlQjElRDAlQkQlRDAlQkUlRDAlQjIlRDAlQkIlRDAlQjUlRDAlQkQlRDElOEIiO3M6MzY6InVzZXJfbm90X2V4aXN0X3BsZWFzZV9yZWdpc3Rlcl9maXJzdCI7czozMTY6IiVEMCU5RiVEMCVCRSVEMCVCQiVEMSU4QyVEMCVCNyVEMCVCRSVEMCVCMiVEMCVCMCVEMSU4MiVEMCVCNSVEMCVCQiVEMSU4QyslRDAlQkQlRDAlQjUrJUQxJTgxJUQxJTgzJUQxJTg5JUQwJUI1JUQxJTgxJUQxJTgyJUQwJUIyJUQxJTgzJUQwJUI1JUQxJTgyJTJDKyVEMCVCRiVEMCVCRSVEMCVCNiVEMCVCMCVEMCVCQiVEMSU4MyVEMCVCOSVEMSU4MSVEMSU4MiVEMCVCMCUyQyslRDAlQjclRDAlQjAlRDElODAlRDAlQjUlRDAlQjMlRDAlQjglRDElODElRDElODIlRDElODAlRDAlQjglRDElODAlRDElODMlRDAlQjklRDElODIlRDAlQjUlRDElODElRDElOEMiO3M6MTg6InVzZXJfYWxyZWFkeV9leGlzdCI7czoxNTI6IiVEMCU5RiVEMCVCRSVEMCVCQiVEMSU4QyVEMCVCNyVEMCVCRSVEMCVCMiVEMCVCMCVEMSU4MiVEMCVCNSVEMCVCQiVEMSU4QyslRDElODMlRDAlQjYlRDAlQjUrJUQxJTgxJUQxJTgzJUQxJTg5JUQwJUI1JUQxJTgxJUQxJTgyJUQwJUIyJUQxJTgzJUQwJUI1JUQxJTgyIjtzOjE3OiJpbnZhbGlkX3VzZXJfdHlwZSI7czoxNDA6IiVEMCU5RCVEMCVCNSVEMCVCMiVEMCVCNSVEMSU4MCVEMCVCRCVEMSU4QiVEMCVCOSslRDElODIlRDAlQjglRDAlQkYrJUQwJUJGJUQwJUJFJUQwJUJCJUQxJThDJUQwJUI3JUQwJUJFJUQwJUIyJUQwJUIwJUQxJTgyJUQwJUI1JUQwJUJCJUQxJThGIjtzOjE0OiJub19zdGFmZl9mb3VuZCI7czoxMTY6IiVEMCVBMSVEMCVCRSVEMSU4MiVEMSU4MCVEMSU4MyVEMCVCNCVEMCVCRCVEMCVCOCVEMCVCQSVEMCVCOCslRDAlQkQlRDAlQjUrJUQwJUJEJUQwJUIwJUQwJUI5JUQwJUI0JUQwJUI1JUQwJUJEJUQxJThCIjtzOjIwOiJub19kZXRhaWxzX2F2YWlsYWJsZSI7czoxMTA6IiVEMCU5RCVEMCVCNSVEMSU4MislRDAlQjQlRDAlQkUlRDElODElRDElODIlRDElODMlRDAlQkYlRDAlQkQlRDElOEIlRDElODUrJUQwJUI0JUQwJUIwJUQwJUJEJUQwJUJEJUQxJThCJUQxJTg1IjtzOjE2OiJ0eXBlX2lzX21pc21hdGNoIjtzOjExMDoiJUQwJUEyJUQwJUI4JUQwJUJGKyVEMCVCRCVEMCVCNSslRDElODElRDAlQkUlRDAlQkUlRDElODIlRDAlQjIlRDAlQjUlRDElODIlRDElODElRDElODIlRDAlQjIlRDElODMlRDAlQjUlRDElODIiO3M6MjA6InVwZGF0ZWRfc3VjY2Vzc2Z1bGx5IjtzOjk3OiIlRDAlQTMlRDElODElRDAlQkYlRDAlQjUlRDElODglRDAlQkQlRDAlQkUrJUQwJTlFJUQwJUIxJUQwJUJEJUQwJUJFJUQwJUIyJUQwJUJCJUQwJUI1JUQwJUJEJUQwJUJFIjtzOjIwOiJzb21ldGhpbmdfd2VudF93cm9uZyI7czo5NDoiJUQwJUE3JUQxJTgyJUQwJUJFLSVEMSU4MiVEMCVCRSslRDAlQkYlRDAlQkUlRDElODglRDAlQkIlRDAlQkUrJUQwJUJEJUQwJUI1KyVEMSU4MiVEMCVCMCVEMCVCQSI7czozNjoicGxlYXNlX2NoZWNrX3lvdXJfY29uZmlybWVkX3Bhc3N3b3JkIjtzOjI2MjoiJUQwJTlGJUQwJUJFJUQwJUI2JUQwJUIwJUQwJUJCJUQxJTgzJUQwJUI5JUQxJTgxJUQxJTgyJUQwJUIwJTJDKyVEMCVCRiVEMSU4MCVEMCVCRSVEMCVCMiVEMCVCNSVEMSU4MCVEMSU4QyVEMSU4MiVEMCVCNSslRDAlQjIlRDAlQjAlRDElODgrJUQwJUJGJUQwJUJFJUQwJUI0JUQxJTgyJUQwJUIyJUQwJUI1JUQxJTgwJUQwJUI2JUQwJUI0JUQwJUI1JUQwJUJEJUQwJUJEJUQxJThCJUQwJUI5KyVEMCVCRiVEMCVCMCVEMSU4MCVEMCVCRSVEMCVCQiVEMSU4QyUyMSI7czoyMzoieW91cl9wYXNzd29yZF9ub3RfbWF0Y2giO3M6OTU6IiVEMCU5MiVEMCVCMCVEMSU4OCtQYWFzd29yZCslRDAlQkQlRDAlQjUrJUQxJTgxJUQwJUJFJUQwJUIyJUQwJUJGJUQwJUIwJUQwJUI0JUQwJUIwJUQwJUI1JUQxJTgyIjtzOjI0OiJub191cGNvbW1pbmdfYXBwb2ludG1lbnQiO3M6MTI4OiIlRDAlOUQlRDAlQjUlRDElODIrJUQwJUJGJUQxJTgwJUQwJUI1JUQwJUI0JUQxJTgxJUQxJTgyJUQwJUJFJUQxJThGJUQxJTg5JUQwJUI1JUQwJUI5KyVEMCVCMiVEMSU4MSVEMSU4MiVEMSU4MCVEMCVCNSVEMSU4NyVEMCVCOCI7czoxMToiZW1haWxfZXhpc3QiO3M6MTU4OiIlRDAlQUQlRDAlQkIlRDAlQjUlRDAlQkElRDElODIlRDElODAlRDAlQkUlRDAlQkQlRDAlQkQlRDAlQjAlRDElOEYrJUQwJUJGJUQwJUJFJUQxJTg3JUQxJTgyJUQwJUIwKyVEMSU4MSVEMSU4MyVEMSU4OSVEMCVCNSVEMSU4MSVEMSU4MiVEMCVCMiVEMSU4MyVEMCVCNSVEMSU4MiI7czoyMDoiZW1haWxfZG9lc19ub3RfZXhpc3QiO3M6MTcxOiIlRDAlQUQlRDAlQkIlRDAlQjUlRDAlQkElRDElODIlRDElODAlRDAlQkUlRDAlQkQlRDAlQkQlRDAlQjAlRDElOEYrJUQwJUJGJUQwJUJFJUQxJTg3JUQxJTgyJUQwJUIwKyVEMCVCRCVEMCVCNSslRDElODElRDElODMlRDElODklRDAlQjUlRDElODElRDElODIlRDAlQjIlRDElODMlRDAlQjUlRDElODIiO3M6MTk6ImludmFsaWRfY3JlZGVudGlhbHMiO3M6MTI4OiIlRDAlOUQlRDAlQjUlRDAlQjIlRDAlQjUlRDElODAlRDAlQkQlRDElOEIlRDAlQjUrJUQxJTgzJUQxJTg3JUQwJUI1JUQxJTgyJUQwJUJEJUQxJThCJUQwJUI1KyVEMCVCNCVEMCVCMCVEMCVCRCVEMCVCRCVEMSU4QiVEMCVCNSI7czoxMDoiZW1haWxfc2VuZCI7czoxNjU6IiVEMCU5RSVEMSU4MiVEMCVCRiVEMSU4MCVEMCVCMCVEMCVCMiVEMCVCOCVEMSU4MiVEMSU4QyslRDAlQkYlRDAlQkUrJUQxJThEJUQwJUJCJUQwJUI1JUQwJUJBJUQxJTgyJUQxJTgwJUQwJUJFJUQwJUJEJUQwJUJEJUQwJUJFJUQwJUI5KyVEMCVCRiVEMCVCRSVEMSU4NyVEMSU4MiVEMCVCNSI7czoyMDoiZW1haWxfc2VuZGluZ19mYWlsZWQiO3M6MTQ3OiIlRDAlOUQlRDAlQjUrJUQxJTgzJUQwJUI0JUQwJUIwJUQwJUJCJUQwJUJFJUQxJTgxJUQxJThDKyVEMCVCRSVEMSU4MiVEMCVCRiVEMSU4MCVEMCVCMCVEMCVCMiVEMCVCOCVEMSU4MiVEMSU4QyslRDAlQkYlRDAlQjglRDElODElRDElOEMlRDAlQkMlRDAlQkUiO3M6MTc6Im5vX29yZGVyc19kZXRhaWxzIjtzOjk4OiIlRDAlOUQlRDAlQjUlRDElODIrJUQwJUI3JUQwJUIwJUQwJUJBJUQwJUIwJUQwJUI3JUQwJUJFJUQwJUIyKyVEMCVCNCVEMCVCNSVEMSU4MiVEMCVCMCVEMCVCQiVEMCVCOCI7czoxMDoibWVzc2FnZV9pcyI7czoxNDk6IiVEMCU5RiVEMCVCRSVEMCVCNiVEMCVCMCVEMCVCQiVEMSU4MyVEMCVCOSVEMSU4MSVEMSU4MiVEMCVCMCUyQyslRDAlQjIlRDAlQkElRDAlQkIlRDElOEUlRDElODclRDAlQjglRDElODIlRDAlQjUrJUQwJUJGJUQwJUJFJUQwJUJCJUQwJUJFJUQxJTgxJUQxJTgzIjtzOjIwOiJwbGVhc2VfZW5hYmxlX3N0cmlwZSI7czoxNDk6IiVEMCU5RiVEMCVCRSVEMCVCNiVEMCVCMCVEMCVCQiVEMSU4MyVEMCVCOSVEMSU4MSVEMSU4MiVEMCVCMCUyQyslRDAlQjIlRDAlQkElRDAlQkIlRDElOEUlRDElODclRDAlQjglRDElODIlRDAlQjUrJUQwJUJGJUQwJUJFJUQwJUJCJUQwJUJFJUQxJTgxJUQxJTgzIjtzOjE1OiJpbnZhbGlkX3JlcXVlc3QiO3M6ODU6IiVEMCU5RCVEMCVCNSVEMCVCMiVEMCVCNSVEMSU4MCVEMCVCRCVEMSU4QiVEMCVCOSslRDAlQjclRDAlQjAlRDAlQkYlRDElODAlRDAlQkUlRDElODEiO3M6OToib3RwX21hdGNoIjtzOjQzOiIlRDAlOUUlRDElODIlRDAlQkYrJUQwJUJDJUQwJUIwJUQxJTgyJUQxJTg3IjtzOjEzOiJvdHBfbm90X21hdGNoIjtzOjg2OiIlRDAlOUUlRDElODIlRDAlQkYrJUQwJUJEJUQwJUI1KyVEMSU4MSVEMCVCRSVEMCVCMiVEMCVCRiVEMCVCMCVEMCVCNCVEMCVCMCVEMCVCNSVEMSU4MiI7czoxODoicGFzc3dvcmRfaXNfY2hhbmdlIjtzOjkxOiIlRDAlOUYlRDAlQjAlRDElODAlRDAlQkUlRDAlQkIlRDElOEMrJUQwJUI4JUQwJUI3JUQwJUJDJUQwJUI1JUQwJUJEJUQwJUI4JUQwJUJCJUQxJTgxJUQxJThGIjtzOjE5OiJwYXNzd29yZF9ub3RfY2hhbmdlIjtzOjk4OiIlRDAlOUYlRDAlQjAlRDElODAlRDAlQkUlRDAlQkIlRDElOEMrJUQwJUJEJUQwJUI1KyVEMCVCQyVEMCVCNSVEMCVCRCVEMSU4RiVEMCVCNSVEMSU4MiVEMSU4MSVEMSU4RiI7czo1NjoiYXJlX3lvdV9zdXJlX3lvdV93YW50X3RvX2NhbmNlbF90aGlzX2Jvb2tpbmdfYXBwb2ludG1lbnQiO3M6MjU4OiIlRDAlOTIlRDElOEIrJUQxJTgzJUQwJUIyJUQwJUI1JUQxJTgwJUQwJUI1JUQwJUJEJUQxJThCJTJDKyVEMSU4NyVEMSU4MiVEMCVCRSslRDElODUlRDAlQkUlRDElODIlRDAlQjglRDElODIlRDAlQjUrJUQwJUJFJUQxJTgyJUQwJUJDJUQwJUI1JUQwJUJEJUQwJUI4JUQxJTgyJUQxJThDKyVEMSU4RCVEMSU4MiVEMCVCRSslRDAlQjElRDElODAlRDAlQkUlRDAlQkQlRDAlQjglRDElODAlRDAlQkUlRDAlQjIlRDAlQjAlRDAlQkQlRDAlQjglRDAlQjUlM0YiO3M6NToiYWxlcnQiO3M6NjA6IiVEMCVCMSVEMCVCNCVEMCVCOCVEMSU4MiVEMCVCNSVEMCVCQiVEMSU4QyVEMCVCRCVEMSU4QiVEMCVCOSI7czoyOiJubyI7czoxODoiJUQwJUJEJUQwJUI1JUQxJTgyIjtzOjE1OiJ2ZXJpZnlfemlwX2NvZGUiO3M6MTQwOiIlRDAlOUYlRDElODAlRDAlQkUlRDAlQjIlRDAlQjUlRDElODAlRDElOEMlRDElODIlRDAlQjUrJUQwJUJGJUQwJUJFJUQxJTg3JUQxJTgyJUQwJUJFJUQwJUIyJUQxJThCJUQwJUI5KyVEMCVCOCVEMCVCRCVEMCVCNCVEMCVCNSVEMCVCQSVEMSU4MSI7czoxMToicG9zdGFsX2NvZGUiO3M6ODU6IiVEMCU5RiVEMCVCRSVEMSU4NyVEMSU4MiVEMCVCRSVEMCVCMiVEMSU4QiVEMCVCOSslRDAlQjglRDAlQkQlRDAlQjQlRDAlQjUlRDAlQkElRDElODEiO3M6MzA6Im5vX21ldGhvZF9mb3Jfc2VsZWN0ZWRfc2VydmljZSI7czoxNjY6IiVEMCU5RCVEMCVCNSVEMSU4MislRDAlQkMlRDAlQjUlRDElODIlRDAlQkUlRDAlQjQlRDAlQjArJUQwJUI0JUQwJUJCJUQxJThGKyVEMCVCMiVEMSU4QiVEMCVCMSVEMSU4MCVEMCVCMCVEMCVCRCVEMCVCRCVEMCVCRSVEMCVCOSslRDElODMlRDElODElRDAlQkIlRDElODMlRDAlQjMlRDAlQjgiO3M6MjQ6InBsZWFzZV9lbnRlcl9wb3N0YWxfY29kZSI7czoxOTI6IiVEMCU5RiVEMCVCRSVEMCVCNiVEMCVCMCVEMCVCQiVEMSU4MyVEMCVCOSVEMSU4MSVEMSU4MiVEMCVCMCUyQyslRDAlQjIlRDAlQjIlRDAlQjUlRDAlQjQlRDAlQjglRDElODIlRDAlQjUrJUQwJUJGJUQwJUJFJUQxJTg3JUQxJTgyJUQwJUJFJUQwJUIyJUQxJThCJUQwJUI5KyVEMCVCOCVEMCVCRCVEMCVCNCVEMCVCNSVEMCVCQSVEMSU4MSI7czoyOToibm9fYWRkb25zX2Zvcl9zZWxlY3RlZF9tZXRob2QiO3M6MTk2OiIlRDAlOUQlRDAlQjUlRDElODIrJUQwJUI0JUQwJUJFJUQwJUJGJUQwJUJFJUQwJUJCJUQwJUJEJUQwJUI1JUQwJUJEJUQwJUI4JUQwJUI5KyVEMCVCNCVEMCVCQiVEMSU4RislRDAlQjIlRDElOEIlRDAlQjElRDElODAlRDAlQjAlRDAlQkQlRDAlQkQlRDAlQkUlRDAlQjMlRDAlQkUrJUQwJUJDJUQwJUI1JUQxJTgyJUQwJUJFJUQwJUI0JUQwJUIwIjtzOjIzOiJzZWxlY3RfYXRsZWFzdF9vbmVfdW5pdCI7czoxNTQ6IiVEMCU5MiVEMSU4QiVEMCVCMSVEMCVCNSVEMSU4MCVEMCVCOCVEMSU4MiVEMCVCNSslRDElODUlRDAlQkUlRDElODIlRDElOEYrJUQwJUIxJUQxJThCKyVEMCVCRSVEMCVCNCVEMCVCRCVEMSU4MyslRDAlQjUlRDAlQjQlRDAlQjglRDAlQkQlRDAlQjglRDElODYlRDElODMiO3M6MTg6InNlbGVjdF9hbnlfcGFja2FnZSI7czoxMTA6IiVEMCU5MiVEMSU4QiVEMCVCMSVEMCVCNSVEMSU4MCVEMCVCOCVEMSU4MiVEMCVCNSslRDAlQkIlRDElOEUlRDAlQjElRDAlQkUlRDAlQjkrJUQwJUJGJUQwJUIwJUQwJUJBJUQwJUI1JUQxJTgyIjtzOjExOiJwbGVhc2Vfd2FpdCI7czoxMTU6IiVEMCU5RiVEMCVCRSVEMCVCNCVEMCVCRSVEMCVCNiVEMCVCNCVEMCVCOCVEMSU4MiVEMCVCNSslRDAlQkYlRDAlQkUlRDAlQjYlRDAlQjAlRDAlQkIlRDElODMlRDAlQjklRDElODElRDElODIlRDAlQjAiO30=' WHERE `language`='ru_RU'";
		mysqli_query($this->conn, $update_app_ru_RU_lang);
		$update_app_ar_lang = "UPDATE `ct_languages` SET `app_labels`='YToxNzg6e3M6Nzoid2VsY29tZSI7czozNzoiJUQ4JUEzJUQ5JTg3JUQ5JTg0JUQ4JUE3KyVEOCVBOCVEOSU4MyI7czoyODoibWFrZV95b3VyX29ubGluZV9hcHBvaW50bWVudCI7czoxMTc6IiVEOCVBRCVEOCVBRiVEOCVBRislRDklODUlRDklODglRDglQjklRDglQUYlRDklODMrJUQ4JUI5JUQ4JUE4JUQ4JUIxKyVEOCVBNyVEOSU4NCVEOCVBNSVEOSU4NiVEOCVBQSVEOCVCMSVEOSU4NiVEOCVBQSI7czo0OiJza2lwIjtzOjI0OiIlRDglQUElRDglQUUlRDglQjclRDklODkiO3M6MTA6InNjaGVkdWxpbmciO3M6MzA6IiVEOCVBQyVEOCVBRiVEOSU4OCVEOSU4NCVEOCVBOSI7czo1MDoibWFrZV95b3VyX29ubGluZV9hcHBvaW50bWVudF9zY2hlZHVsaW5nX3N1cGVyX2Vhc3kiO3M6MjEwOiIlRDglQUMlRDglQjklRDklODQrJUQ4JUFDJUQ4JUFGJUQ5JTg4JUQ5JTg0JUQ4JUE5KyVEOSU4NSVEOSU4OCVEOCVCOSVEOCVBRiVEOSU4MyslRDglQjklRDglQTglRDglQjErJUQ4JUE3JUQ5JTg0JUQ4JUE1JUQ5JTg2JUQ4JUFBJUQ4JUIxJUQ5JTg2JUQ4JUFBKyVEOCVCMyVEOSU4NyVEOSU4NCVEOCVBOSslRDklODQlRDklODQlRDglQkElRDglQTclRDklOEElRDglQTkiO3M6MTE6ImdldF9zdGFydGVkIjtzOjMwOiIlRDglQTclRDklODQlRDglQTglRDglQUYlRDglQTEiO3M6NDI6ImdldF9zdGFydGVkX2J5X2xvZ2dpbmdfaW5fb3JfYnlfc2lnbmluZ191cCI7czoyMzY6IiVEOCVBNyVEOSU4NCVEOCVBOCVEOCVBRiVEOCVBMSslRDklODUlRDklODYrJUQ4JUFFJUQ5JTg0JUQ4JUE3JUQ5JTg0KyVEOCVBQSVEOCVCMyVEOCVBQyVEOSU4QSVEOSU4NCslRDglQTclRDklODQlRDglQUYlRDglQUUlRDklODglRDklODQrJUQ4JUEzJUQ5JTg4KyVEOCVCOSVEOSU4NislRDglQjclRDglQjElRDklOEElRDklODIrJUQ4JUE3JUQ5JTg0JUQ4JUE3JUQ4JUI0JUQ4JUFBJUQ4JUIxJUQ4JUE3JUQ5JTgzIjtzOjc6InNpZ25faW4iO3M6Njc6IiVEOCVBQSVEOCVCMyVEOCVBQyVEOSU4QSVEOSU4NCslRDglQTclRDklODQlRDglQUYlRDglQUUlRDklODglRDklODQiO3M6MTY6ImVudGVyX3lvdXJfZW1haWwiO3M6MTE2OiIlRDglQTMlRDglQUYlRDglQUUlRDklODQrJUQ4JUE4JUQ4JUIxJUQ5JThBJUQ4JUFGJUQ5JTgzKyVEOCVBNyVEOSU4NCVEOCVBNyVEOSU4NCVEOSU4MyVEOCVBQSVEOCVCMSVEOSU4OCVEOSU4NiVEOSU4QSI7czoxNDoiZW50ZXJfcGFzc3dvcmQiO3M6ODY6IiVEOCVBMyVEOCVBRiVEOCVBRSVEOSU4NCslRDklODMlRDklODQlRDklODUlRDglQTkrJUQ4JUE3JUQ5JTg0JUQ5JTg1JUQ4JUIxJUQ5JTg4JUQ4JUIxIjtzOjE1OiJmb3Jnb3RfcGFzc3dvcmQiO3M6MTA1OiIlRDklODclRDklODQrJUQ5JTg2JUQ4JUIzJUQ5JThBJUQ4JUFBKyVEOSU4MyVEOSU4NCVEOSU4NSVEOCVBOSslRDglQTclRDklODQlRDklODUlRDglQjElRDklODglRDglQjElRDglOUYiO3M6NToibG9naW4iO3M6Njc6IiVEOCVBQSVEOCVCMyVEOCVBQyVEOSU4QSVEOSU4NCslRDglQTclRDklODQlRDglQUYlRDglQUUlRDklODglRDklODQiO3M6MjU6ImRvbnRfaGF2ZV9hY2NvdW50X3NpZ25fdXAiO3M6OTM6IiVEOSU4NCVEOSU4QSVEOCVCMyslRDklODQlRDglQUYlRDklOEElRDklODMrJUQ4JUFEJUQ4JUIzJUQ4JUE3JUQ4JUE4JUQ4JTlGKyVEOCVCMyVEOCVBQyVEOSU4NCI7czoyNDoiZW50ZXJfZW1haWxfYW5kX3Bhc3N3b3JkIjtzOjE5MDoiJUQ4JUEzJUQ4JUFGJUQ4JUFFJUQ5JTg0KyVEOCVBNyVEOSU4NCVEOCVBOCVEOCVCMSVEOSU4QSVEOCVBRislRDglQTclRDklODQlRDglQTUlRDklODQlRDklODMlRDglQUElRDglQjElRDklODglRDklODYlRDklOEErJUQ5JTg4JUQ5JTgzJUQ5JTg0JUQ5JTg1JUQ4JUE5KyVEOCVBNyVEOSU4NCVEOSU4NSVEOCVCMSVEOSU4OCVEOCVCMSI7czo3MToicGxlYXNlX2VudGVyX3lvdXJfcmVnaXN0ZXJlZF9lbWFpbF9pZF93ZV93aWxsX3NlbmRfb3RwX3RvX3lvdXJfZW1haWxfaWQiO3M6NDYzOiIlRDglQTclRDklODQlRDglQjElRDglQUMlRDglQTclRDglQTErJUQ4JUE1JUQ4JUFGJUQ4JUFFJUQ4JUE3JUQ5JTg0KyVEOSU4NSVEOCVCOSVEOCVCMSVEOSU4MSslRDglQTclRDklODQlRDglQTglRDglQjElRDklOEElRDglQUYrJUQ4JUE3JUQ5JTg0JUQ4JUE1JUQ5JTg0JUQ5JTgzJUQ4JUFBJUQ4JUIxJUQ5JTg4JUQ5JTg2JUQ5JThBKyVEOCVBNyVEOSU4NCVEOSU4NSVEOCVCMyVEOCVBQyVEOSU4NC4rJUQ4JUIzJUQ5JTg4JUQ5JTgxKyVEOSU4NiVEOCVCMSVEOCVCMyVEOSU4NCtPVFArJUQ4JUE1JUQ5JTg0JUQ5JTg5KyVEOSU4NSVEOCVCOSVEOCVCMSVEOSU4MSslRDglQTclRDklODQlRDglQTglRDglQjElRDklOEElRDglQUYrJUQ4JUE3JUQ5JTg0JUQ4JUE1JUQ5JTg0JUQ5JTgzJUQ4JUFBJUQ4JUIxJUQ5JTg4JUQ5JTg2JUQ5JThBKyVEOCVBNyVEOSU4NCVEOCVBRSVEOCVBNyVEOCVCNSslRDglQTglRDklODMuIjtzOjE0OiJlbnRlcl95b3VyX290cCI7czo3MjoiJUQ4JUEzJUQ4JUFGJUQ4JUFFJUQ5JTg0K09UUCslRDglQTclRDklODQlRDglQUUlRDglQTclRDglQjUrJUQ4JUE4JUQ5JTgzIjtzOjg6InNlbmRfb3RwIjtzOjM0OiIlRDglQTUlRDglQjElRDglQjMlRDglQTclRDklODQrT1RQIjtzOjE2OiJjdXJyZW50X3Bhc3N3b3JkIjtzOjk4OiIlRDklODMlRDklODQlRDklODUlRDglQTkrJUQ4JUE3JUQ5JTg0JUQ5JTg1JUQ4JUIxJUQ5JTg4JUQ4JUIxKyVEOCVBNyVEOSU4NCVEOCVBRCVEOCVBNyVEOSU4NCVEOSU4QSI7czoxMjoibmV3X3Bhc3N3b3JkIjtzOjkyOiIlRDklODMlRDklODQlRDklODUlRDglQTkrJUQ4JUE3JUQ5JTg0JUQ4JUIzJUQ4JUIxKyVEOCVBNyVEOSU4NCVEOCVBQyVEOCVBRiVEOSU4QSVEOCVBRiVEOCVBOSI7czoxNjoiY29uZmlybV9wYXNzd29yZCI7czo5MjoiJUQ4JUFBJUQ4JUEzJUQ5JTgzJUQ5JThBJUQ4JUFGKyVEOSU4MyVEOSU4NCVEOSU4NSVEOCVBOSslRDglQTclRDklODQlRDklODUlRDglQjElRDklODglRDglQjEiO3M6MTE6InNlcnZlcl9kb3duIjtzOjYxOiIlRDglQUElRDglQjklRDglQjclRDklODQrJUQ4JUE3JUQ5JTg0JUQ4JUFFJUQ4JUE3JUQ4JUFGJUQ5JTg1IjtzOjEwOiJ2ZXJpZnlfb3RwIjtzOjQxOiIlRDglQUElRDglQUQlRDklODIlRDklODIrJUQ5JTg1JUQ5JTg2K09UUCI7czo2OiJjbGllbnQiO3M6MjQ6IiVEOCVCOSVEOSU4NSVEOSU4QSVEOSU4NCI7czoxNzoidXBkYXRpbmdfcGFzc3dvcmQiO3M6OTI6IiVEOCVBQSVEOCVBRCVEOCVBRiVEOSU4QSVEOCVBQislRDklODMlRDklODQlRDklODUlRDglQTkrJUQ4JUE3JUQ5JTg0JUQ5JTg1JUQ4JUIxJUQ5JTg4JUQ4JUIxIjtzOjI5OiJwYXNzd29yZF91cGRhdGVkX3N1Y2Nlc3NmdWxseSI7czoxMjQ6IiVEOCVBQSVEOSU4NSslRDglQUElRDglQUQlRDglQUYlRDklOEElRDglQUIrJUQ5JTgzJUQ5JTg0JUQ5JTg1JUQ4JUE5KyVEOCVBNyVEOSU4NCVEOCVCMyVEOCVCMSslRDglQTglRDklODYlRDglQUMlRDglQTclRDglQUQiO3M6MTc6InBhc3N3b3JkX21pc21hdGNoIjtzOjExMToiJUQ4JUI5JUQ4JUFGJUQ5JTg1KyVEOCVBQSVEOCVCNyVEOCVBNyVEOCVBOCVEOSU4MislRDklODMlRDklODQlRDklODUlRDglQTkrJUQ4JUE3JUQ5JTg0JUQ5JTg1JUQ4JUIxJUQ5JTg4JUQ4JUIxIjtzOjIyOiJpbmNvcnJlY3Rfb2xkX3Bhc3N3b3JkIjtzOjE0MjoiJUQ5JTgzJUQ5JTg0JUQ5JTg1JUQ4JUE5KyVEOCVBNyVEOSU4NCVEOCVCMyVEOCVCMSslRDglQTclRDklODQlRDklODIlRDglQUYlRDklOEElRDklODUlRDglQTkrJUQ4JUJBJUQ5JThBJUQ4JUIxKyVEOCVCNSVEOCVBRCVEOSU4QSVEOCVBRCVEOCVBOSI7czoyMjoicGxlYXNlX2ZpbGxfYWxsX2ZpZWxkcyI7czoxMTI6IiVEOSU4NCVEOSU4OCslRDglQjMlRDklODUlRDglQUQlRDglQUErJUQ4JUEzJUQ5JTg1JUQ5JTg0JUQ4JUEzKyVEOSU4MyVEOSU4NCslRDglQTclRDklODQlRDglQUQlRDklODIlRDklODglRDklODQiO3M6Njoic3VibWl0IjtzOjE4OiIlRDglQUUlRDglQjYlRDglQjkiO3M6MTA6ImZpcnN0X25hbWUiO3M6NjE6IiVEOCVBNyVEOSU4NCVEOCVBNyVEOCVCMyVEOSU4NSslRDglQTclRDklODQlRDglQTclRDklODglRDklODQiO3M6OToibGFzdF9uYW1lIjtzOjM2OiIlRDglQTclRDklODQlRDklODMlRDklODYlRDklOEElRDglQTkiO3M6NToiZW1haWwiO3M6OTc6IiVEOCVBNyVEOSU4NCVEOCVBOCVEOCVCMSVEOSU4QSVEOCVBRislRDglQTclRDklODQlRDglQTUlRDklODQlRDklODMlRDglQUElRDglQjElRDklODglRDklODYlRDklOEEiO3M6NToicGhvbmUiO3M6MjQ6IiVEOSU4NyVEOCVBNyVEOCVBQSVEOSU4MSI7czo3OiJhZGRyZXNzIjtzOjMwOiIlRDglQjklRDklODYlRDklODglRDglQTclRDklODYiO3M6NDoiY2l0eSI7czozMDoiJUQ5JTg1JUQ4JUFGJUQ5JThBJUQ5JTg2JUQ4JUE5IjtzOjc6ImNvdW50cnkiO3M6MTg6IiVEOCVBOCVEOSU4NCVEOCVBRiI7czo4OiJwb3N0Y29kZSI7czo3MzoiJUQ4JUE3JUQ5JTg0JUQ4JUIxJUQ5JTg1JUQ4JUIyKyVEOCVBNyVEOSU4NCVEOCVBOCVEOCVCMSVEOSU4QSVEOCVBRiVEOSU4QSI7czo4OiJwYXNzd29yZCI7czo0OToiJUQ5JTgzJUQ5JTg0JUQ5JTg1JUQ5JTg3KyVEOCVBNyVEOSU4NCVEOCVCMyVEOCVCMSI7czo3OiJzaWduX3VwIjtzOjE4OiIlRDglQjMlRDglQUMlRDklODQiO3M6MjM6ImFscmVhZHlfaGF2ZV9hbl9hY2NvdW50IjtzOjY4OiIlRDklODclRDklODQrJUQ5JTg0JUQ4JUFGJUQ5JThBJUQ5JTgzKyVEOCVBRCVEOCVCMyVEOCVBNyVEOCVBOCVEOCU5RiI7czo0OiJob21lIjtzOjg1OiIlRDglQTclRDklODQlRDglQjUlRDklODElRDglQUQlRDglQTkrJUQ4JUE3JUQ5JTg0JUQ4JUIxJUQ4JUE2JUQ5JThBJUQ4JUIzJUQ5JThBJUQ4JUE5IjtzOjEwOiJ3ZWxjb21lX3RvIjtzOjU2OiIlRDklODUlRDglQjElRDglQUQlRDglQTglRDglQTcrJUQ4JUE4JUQ5JTgzKyVEOSU4MSVEOSU4QSI7czoxMToibmV3X2Jvb2tpbmciO3M6Njc6IiVEOCVBNyVEOSU4NCVEOCVBRCVEOCVBQyVEOCVCMislRDglQTclRDklODQlRDglQUMlRDglQUYlRDklOEElRDglQUYiO3M6MTE6Im15X2Jvb2tpbmdzIjtzOjQyOiIlRDglQUQlRDglQUMlRDklODglRDglQjIlRDglQTclRDglQUElRDklOEEiO3M6MTU6Im15X3RyYW5zYWN0aW9ucyI7czo0ODoiJUQ5JTg1JUQ4JUI5JUQ4JUE3JUQ5JTg1JUQ5JTg0JUQ4JUE3JUQ4JUFBJUQ5JThBIjtzOjExOiJteV9zZXR0aW5ncyI7czo0ODoiJUQ4JUE3JUQ4JUI5JUQ4JUFGJUQ4JUE3JUQ4JUFGJUQ4JUE3JUQ4JUFBJUQ5JThBIjtzOjQyOiJ3aGVyZV93b3VsZF95b3VfbGlrZV91c190b19wcm92aWRlX3NlcnZpY2UiO3M6MTM2OiIlRDglQTMlRDklOEElRDklODYrJUQ4JUFBJUQ4JUIxJUQ5JThBJUQ4JUFGKyVEOSU4NSVEOSU4NiVEOCVBNyslRDglQUElRDklODIlRDglQUYlRDklOEElRDklODUrJUQ4JUE3JUQ5JTg0JUQ4JUFFJUQ4JUFGJUQ5JTg1JUQ4JUE5JUQ4JTlGIjtzOjIxOiJwbGVhc2VfY2hvb3NlX3NlcnZpY2UiO3M6OTg6IiVEOSU4QSVEOCVCMSVEOCVBQyVEOSU4OSslRDglQTclRDglQUUlRDglQUElRDklOEElRDglQTclRDglQjErJUQ4JUE3JUQ5JTg0JUQ4JUFFJUQ4JUFGJUQ5JTg1JUQ4JUE5IjtzOjg6InByZXZpb3VzIjtzOjI0OiIlRDglQjMlRDglQTclRDglQTglRDklODIiO3M6NDoibmV4dCI7czozNjoiJUQ4JUE3JUQ5JTg0JUQ4JUFBJUQ4JUE3JUQ5JTg0JUQ5JTg5IjtzOjc6InNlcnZpY2UiO3M6NDI6IiVEOCVBNyVEOSU4NCVEOCVBRSVEOCVBRiVEOSU4NSVEOCVBNyVEOCVBQSI7czo0OiJjb3N0IjtzOjI0OiIlRDklODMlRDklODQlRDklODElRDglQTkiO3M6MjA6InBsZWFzZV9zZWxlY3RfbWV0aG9kIjtzOjEwNDoiJUQ5JThBJUQ4JUIxJUQ4JUFDJUQ5JTg5KyVEOCVBNyVEOCVBRSVEOCVBQSVEOSU4QSVEOCVBNyVEOCVCMSslRDglQTclRDklODQlRDglQjclRDglQjElRDklOEElRDklODIlRDglQTkiO3M6MjA6InBsZWFzZV9zZWxlY3Rfb2ZmZXJzIjtzOjk4OiIlRDklOEElRDglQjElRDglQUMlRDklODkrJUQ4JUE3JUQ4JUFFJUQ4JUFBJUQ5JThBJUQ4JUE3JUQ4JUIxKyVEOCVBNyVEOSU4NCVEOCVCOSVEOCVCMSVEOSU4OCVEOCVCNiI7czoxODoicGxlYXNlX3NlbGVjdF90aW1lIjtzOjkyOiIlRDklOEElRDglQjElRDglQUMlRDklODkrJUQ4JUE3JUQ4JUFFJUQ4JUFBJUQ5JThBJUQ4JUE3JUQ4JUIxKyVEOCVBNyVEOSU4NCVEOSU4OCVEOSU4MiVEOCVBQSI7czoyMDoicGxlYXNlX3NlbGVjdF9hZGRvbnMiO3M6OTg6IiVEOSU4QSVEOCVCMSVEOCVBQyVEOSU4OSslRDglQTclRDglQUUlRDglQUElRDklOEElRDglQTclRDglQjErJUQ4JUE1JUQ4JUI2JUQ4JUE3JUQ5JTgxJUQ4JUE3JUQ4JUFBIjtzOjc6Im1vbnRobHkiO3M6MzA6IiVEOCVCNCVEOSU4NyVEOCVCMSVEOSU4QSVEOCVBNyI7czo5OiJiaV93ZWVrbHkiO3M6NDM6IiVEOCVBOCVEOSU4QSslRDklODglRDklOEElRDklODMlRDklODQlRDklOEEiO3M6Njoid2Vla2x5IjtzOjM2OiIlRDglQTMlRDglQjMlRDglQTglRDklODglRDglQjklRDklOEEiO3M6NDoib25jZSI7czozNzoiJUQ4JUIwJUQ4JUE3JUQ4JUFBKyVEOSU4NSVEOCVCMSVEOCVBOSI7czoxODoicGxlYXNlX3NlbGVjdF9kYXRlIjtzOjEwNDoiJUQ5JThBJUQ4JUIxJUQ4JUFDJUQ5JTg5KyVEOCVBNyVEOCVBRSVEOCVBQSVEOSU4QSVEOCVBNyVEOCVCMSslRDglQTclRDklODQlRDglQUElRDglQTclRDglQjElRDklOEElRDglQUUiO3M6NDoiZGF0ZSI7czozMDoiJUQ4JUFBJUQ4JUE3JUQ4JUIxJUQ5JThBJUQ4JUFFIjtzOjIyOiJwbGVhc2Vfc2VsZWN0X3Byb3ZpZGVyIjtzOjg2OiIlRDklOEElRDglQjElRDglQUMlRDklODkrJUQ4JUE3JUQ4JUFFJUQ4JUFBJUQ5JThBJUQ4JUE3JUQ4JUIxKyVEOSU4NSVEOCVCMiVEOSU4OCVEOCVBRiI7czo0OiJ0aW1lIjtzOjE4OiIlRDglQjIlRDklODUlRDklODYiO3M6MTM6ImluY2x1ZGluZ190YXgiO3M6Nzk6IiUyOCVEOSU4NSVEOCVBQSVEOCVCNiVEOSU4NSVEOSU4NislRDklODQlRDklODQlRDglQjYlRDglQjElRDklOEElRDglQTglRDglQTklMjkiO3M6MjQ6InByZWZlcnJlZF9wYXltZW50X21ldGhvZCI7czo4NjoiJUQ5JThBJUQ5JTgxJUQ4JUI2JUQ5JTg0KyVEOCVCNyVEOCVCMSVEOSU4QSVEOSU4MiVEOCVBOSslRDglQTclRDklODQlRDglQUYlRDklODElRDglQjkiO3M6MTE6ImxvY2FsbHlfcGF5IjtzOjYxOiIlRDglQTclRDklODQlRDglQUYlRDklODElRDglQjkrJUQ5JTg1JUQ4JUFEJUQ5JTg0JUQ5JThBJUQ4JUE3IjtzOjI1OiJjcmVkaXRfZGViaXRfY2FyZF9wYXltZW50IjtzOjE1NzoiJUQ4JUE3JUQ5JTg0JUQ4JUFGJUQ5JTgxJUQ4JUI5KyVEOCVBOCVEOCVBOCVEOCVCNyVEOCVBNyVEOSU4MiVEOCVBNyVEOCVBQSslRDglQTclRDklODQlRDglQTclRDglQTYlRDglQUElRDklODUlRDglQTclRDklODYrJTJGKyVEOCVBNyVEOSU4NCVEOCVBRSVEOCVCNSVEOSU4NSI7czo2OiJjYW5jZWwiO3M6MzA6IiVEOCVBNSVEOSU4NCVEOCVCQSVEOCVBNyVEOCVBMSI7czoyNToiY3JlZGl0X2RlYml0X2NhcmRfZGV0YWlscyI7czoxNTE6IiVEOCVBQSVEOSU4MSVEOCVBNyVEOCVCNSVEOSU4QSVEOSU4NCslRDglQTglRDglQjclRDglQTclRDklODIlRDglQTkrJUQ4JUE3JUQ5JTg0JUQ4JUE3JUQ4JUE2JUQ4JUFBJUQ5JTg1JUQ4JUE3JUQ5JTg2KyUyRislRDglQTclRDklODQlRDglQUUlRDglQjUlRDklODUiO3M6MTI6InNlcnZpY2VfbmFtZSI7czo1NToiJUQ4JUE3JUQ4JUIzJUQ5JTg1KyVEOCVBNyVEOSU4NCVEOCVBRSVEOCVBRiVEOSU4NSVEOCVBOSI7czoxMjoiYm9va2luZ19kYXRlIjtzOjYxOiIlRDglQUElRDglQTclRDglQjElRDklOEElRDglQUUrJUQ4JUE3JUQ5JTg0JUQ4JUFEJUQ4JUFDJUQ4JUIyIjtzOjExOiJjYXJ0X2Ftb3VudCI7czo2MToiJUQ5JTgzJUQ5JTg1JUQ5JThBJUQ4JUE5KyVEOCVBNyVEOSU4NCVEOCVCOSVEOCVCMSVEOCVBOCVEOCVBOSI7czoxNjoiYm9va19hcHBvaW50bWVudCI7czo2MToiJUQ5JTg1JUQ5JTg4JUQ4JUI5JUQ4JUFGKyVEOCVBNyVEOSU4NCVEOSU4MyVEOCVBQSVEOCVBNyVEOCVBOCI7czoxMToiY2FyZF9udW1iZXIiO3M6NjE6IiVEOCVCMSVEOSU4MiVEOSU4NSslRDglQTclRDklODQlRDglQTglRDglQjclRDglQTclRDklODIlRDglQTkiO3M6MTI6ImV4cGlyeV9tb250aCI7czoxMDQ6IiVEOCVCNCVEOSU4NyVEOCVCMSslRDglQTclRDklODYlRDglQUElRDklODclRDglQTclRDglQTErJUQ4JUE3JUQ5JTg0JUQ4JUI1JUQ5JTg0JUQ4JUE3JUQ4JUFEJUQ5JThBJUQ4JUE5IjtzOjExOiJleHBpcnlfeWVhciI7czo2NzoiJUQ4JUIzJUQ5JTg2JUQ4JUE5KyVEOCVBNyVEOSU4NCVEOCVBNyVEOSU4NiVEOCVBQSVEOSU4NyVEOCVBNyVEOCVBMSI7czoxNToiYm9va2luZ19zdW1tYXJ5IjtzOjYxOiIlRDklODUlRDklODQlRDglQUUlRDglQjUrJUQ4JUE3JUQ5JTg0JUQ5JTgzJUQ4JUFBJUQ4JUE3JUQ4JUE4IjtzOjg6ImNhcmRfY3ZjIjtzOjM0OiIlRDglQTglRDglQjclRDglQTclRDklODIlRDglQTkrQ1ZDIjtzOjM6ImFsbCI7czoyNDoiJUQ4JUE3JUQ5JTg0JUQ5JTgzJUQ5JTg0IjtzOjQ6InBhc3QiO3M6MzY6IiVEOCVBNyVEOSU4NCVEOSU4NSVEOCVBNyVEOCVCNiVEOSU4QSI7czo4OiJ1cGNvbWluZyI7czo0MjoiJUQ4JUE3JUQ5JTg0JUQ5JTgyJUQ4JUE3JUQ4JUFGJUQ5JTg1JUQ4JUE5IjtzOjE3OiJub19kYXRhX2F2YWlsYWJsZSI7czo4NjoiJUQ5JTg0JUQ4JUE3KyVEOCVBQSVEOCVBQSVEOSU4OCVEOCVBNyVEOSU4MSVEOCVCMSslRDglQTglRDklOEElRDglQTclRDklODYlRDglQTclRDglQUEiO3M6OToiY29uZmlybWVkIjtzOjQzOiIlRDglQUElRDklODUrJUQ4JUFBJUQ4JUEzJUQ5JTgzJUQ5JThBJUQ4JUFGIjtzOjg6InJlamVjdGVkIjtzOjMwOiIlRDklODUlRDglQjElRDklODElRDklODglRDglQjYiO3M6NzoicGVuZGluZyI7czo2NzoiJUQ5JTgyJUQ5JThBJUQ4JUFGKyVEOCVBNyVEOSU4NCVEOCVBNyVEOSU4NiVEOCVBQSVEOCVCOCVEOCVBNyVEOCVCMSI7czo5OiJjYW5jZWxsZWQiO3M6MzA6IiVEOCVBMyVEOSU4NCVEOCVCQSVEOSU4QSVEOCVBQSI7czoxMDoicmVzY2hlZHVsZSI7czo2MToiJUQ4JUE1JUQ4JUI5JUQ4JUE3JUQ4JUFGJUQ4JUE5KyVEOCVBQyVEOCVBRiVEOSU4OCVEOSU4NCVEOCVBOSI7czo3OiJub19zaG93IjtzOjM3OiIlRDklODQlRDglQTcrJUQ4JUFBJUQ4JUI4JUQ5JTg3JUQ4JUIxIjtzOjc6ImRldGFpbHMiO3M6MzY6IiVEOCVBQSVEOSU4MSVEOCVBNyVEOCVCNSVEOSU4QSVEOSU4NCI7czoxNzoibG9hZGluZ19tb3JlX2RhdGEiO3M6MTI5OiIlRDglQUElRDglQUQlRDklODUlRDklOEElRDklODQrJUQ4JUE3JUQ5JTg0JUQ5JTg1JUQ4JUIyJUQ5JThBJUQ4JUFGKyVEOSU4NSVEOSU4NislRDglQTclRDklODQlRDglQTglRDklOEElRDglQTclRDklODYlRDglQTclRDglQUEiO3M6OToiZGFzaGJvYXJkIjtzOjY3OiIlRDklODQlRDklODglRDglQUQlRDglQTkrJUQ4JUE3JUQ5JTg0JUQ5JTgyJUQ5JThBJUQ4JUE3JUQ4JUFGJUQ4JUE5IjtzOjU6InByaWNlIjtzOjMwOiIlRDglQTclRDklODQlRDglQjMlRDglQjklRDglQjEiO3M6ODoib3JkZXJfaWQiO3M6MTI5OiIlRDglQjElRDklODIlRDklODUrJUQ4JUE3JUQ5JTg0JUQ4JUFBJUQ4JUI5JUQ4JUIxJUQ5JThBJUQ5JTgxKyVEOCVBNyVEOSU4NCVEOCVBRSVEOCVBNyVEOCVCNSslRDglQTglRDglQTclRDklODQlRDglQjclRDklODQlRDglQTgiO3M6NDoidW5pdCI7czoyNDoiJUQ5JTg4JUQ4JUFEJUQ4JUFGJUQ4JUE5IjtzOjY6ImFkZF9vbiI7czozMDoiJUQ4JUE3JUQ4JUI2JUQ4JUE3JUQ5JTgxJUQ5JTg3IjtzOjY6Im1ldGhvZCI7czozMDoiJUQ4JUI3JUQ4JUIxJUQ5JThBJUQ5JTgyJUQ4JUE5IjtzOjEyOiJwYXltZW50X3R5cGUiO3M6NDk6IiVEOSU4NiVEOSU4OCVEOCVCOSslRDglQTclRDklODQlRDglQUYlRDklODElRDglQjkiO3M6MTQ6ImJvb2tpbmdfc3RhdHVzIjtzOjQ5OiIlRDklODglRDglQjYlRDglQjkrJUQ4JUE3JUQ5JTg0JUQ4JUFEJUQ4JUFDJUQ4JUIyIjtzOjMwOiJhcHBvaW50bWVudF9tYXJrZWRfYXNfbm9fc2hvd24iO3M6MTI0OiIlRDglQUElRDklODUrJUQ4JUFBJUQ4JUFEJUQ4JUFGJUQ5JThBJUQ4JUFGKyVEOCVBNyVEOSU4NCVEOSU4NSVEOSU4OCVEOCVCOSVEOCVBRislRDglQTglRDglQUYlRDklODglRDklODYrJUQ4JUI5JUQ4JUIxJUQ4JUI2IjtzOjI5OiJjYW5jZWxsZWRfYnlfc2VydmljZV9wcm92aWRlciI7czoxNTQ6IiVEOCVBQSVEOSU4NSslRDglQTclRDklODQlRDglQTUlRDklODQlRDglQkElRDglQTclRDglQTErJUQ4JUE4JUQ5JTg4JUQ4JUE3JUQ4JUIzJUQ4JUI3JUQ4JUE5KyVEOSU4NSVEOCVCMiVEOSU4OCVEOCVBRislRDglQTclRDklODQlRDglQUUlRDglQUYlRDklODUlRDglQTkiO3M6MjE6ImNhbmNlbGxlZF9ieV9jdXN0b21lciI7czoxMjk6IiVEOCVBQSVEOSU4NSslRDglQTclRDklODQlRDglQTUlRDklODQlRDglQkElRDglQTclRDglQTErJUQ4JUE4JUQ5JTg4JUQ4JUE3JUQ4JUIzJUQ4JUI3JUQ4JUE5KyVEOCVBNyVEOSU4NCVEOCVCOSVEOSU4NSVEOSU4QSVEOSU4NCI7czoxMDoic3RhcnRfZGF0ZSI7czo2MToiJUQ4JUFBJUQ4JUE3JUQ4JUIxJUQ5JThBJUQ4JUFFKyVEOCVBNyVEOSU4NCVEOCVBOCVEOCVBRiVEOCVBMSI7czoxMDoic3RhcnRfdGltZSI7czo0OToiJUQ5JTg4JUQ5JTgyJUQ4JUFBKyVEOCVBNyVEOSU4NCVEOCVBOCVEOCVBRiVEOCVBMSI7czoyMDoicGF5bWVudF90cmFuc2FjdGlvbnMiO3M6NzM6IiVEOSU4NSVEOCVCOSVEOCVBNyVEOSU4NSVEOSU4NCVEOCVBNyVEOCVBQSslRDglQTclRDklODQlRDglQUYlRDklODElRDglQjkiO3M6MTA6Im15X2FjY291bnQiO3M6MzA6IiVEOCVBRCVEOCVCMyVEOCVBNyVEOCVBOCVEOSU4QSI7czo0OiJuYW1lIjtzOjE4OiIlRDglQTclRDglQjMlRDklODUiO3M6NjoidXBkYXRlIjtzOjMwOiIlRDglQUElRDglQUQlRDglQUYlRDklOEElRDglQUIiO3M6ODoiY3VzdG9tZXIiO3M6MjQ6IiVEOCVCMiVEOCVBOCVEOSU4OCVEOSU4NiI7czo1OiJzdGFmZiI7czo0ODoiJUQ4JUE3JUQ5JTg0JUQ4JUI5JUQ4JUE3JUQ5JTg1JUQ5JTg0JUQ5JThBJUQ5JTg2IjtzOjIwOiJzY2hlZHVsZV9hcHBvaW50bWVudCI7czo0OToiJUQ4JUFDJUQ4JUFGJUQ5JTg4JUQ5JTg0KyVEOSU4NSVEOSU4OCVEOCVCOSVEOCVBRiI7czoxMDoiY29udGFjdF91cyI7czo0MzoiJUQ4JUE3JUQ4JUFBJUQ4JUI1JUQ5JTg0KyVEOCVBOCVEOSU4NiVEOCVBNyI7czo4OiJmZWVkYmFjayI7czo1NToiJUQ4JUIxJUQ4JUFGJUQ5JTg4JUQ4JUFGKyVEOCVBNyVEOSU4NCVEOSU4MSVEOCVCOSVEOSU4NCI7czo2OiJsb2dvdXQiO3M6MzY6IiVEOCVBNyVEOSU4NCVEOCVBRSVEOCVCMSVEOSU4OCVEOCVBQyI7czoxNDoiZW50ZXJfZmVlZGJhY2siO3M6Njc6IiVEOCVBMyVEOCVBRiVEOCVBRSVEOSU4NCslRDglQTclRDklODQlRDglQUElRDglQjklRDklODQlRDklOEElRDklODIiO3M6MTY6ImZldGNoaW5nX21ldGhvZHMiO3M6Njc6IiVEOCVBQyVEOSU4NCVEOCVBOCslRDglQTclRDklODQlRDglQTMlRDglQjMlRDglQTclRDklODQlRDklOEElRDglQTgiO3M6MzY6InRoYW5rX3lvdV9mb3JfeW91cl92YWx1YWJsZV9mZWVkYmFjayI7czoxMTY6IiVEOCVCNCVEOSU4MyVEOCVCMSVEOCVBNyslRDklODQlRDglQUElRDglQjklRDklODQlRDklOEElRDklODIlRDglQTclRDglQUElRDklODMrJUQ4JUE3JUQ5JTg0JUQ5JTgyJUQ5JThBJUQ5JTg1JUQ4JUE5IjtzOjI1OiJ1bmFibGVfdG9fc3VibWl0X2ZlZWRiYWNrIjtzOjEzNjoiJUQ4JUJBJUQ5JThBJUQ4JUIxKyVEOSU4MiVEOCVBNyVEOCVBRiVEOCVCMSslRDglQjklRDklODQlRDklODkrJUQ4JUFBJUQ5JTgyJUQ4JUFGJUQ5JThBJUQ5JTg1KyVEOSU4NSVEOSU4NCVEOCVBNyVEOCVBRCVEOCVCOCVEOCVBNyVEOCVBQSI7czoyMToicGxlYXNlX2VudGVyX2ZlZWRiYWNrIjtzOjEyMjoiJUQ4JUE3JUQ5JTg0JUQ4JUIxJUQ4JUFDJUQ4JUE3JUQ4JUExKyVEOCVBNSVEOCVBRiVEOCVBRSVEOCVBNyVEOSU4NCslRDglQTclRDklODQlRDklODUlRDklODQlRDglQTclRDglQUQlRDglQjglRDglQTclRDglQUEiO3M6MTM6Im5vdGlmaWNhdGlvbnMiO3M6NDI6IiVEOCVBNSVEOCVBRSVEOCVCNyVEOCVBNyVEOCVCMSVEOCVBNyVEOCVBQSI7czoxOToibmV3X2Jvb2tpbmdfc3VjY2VzcyI7czo5MjoiJUQ5JTg2JUQ4JUFDJUQ4JUE3JUQ4JUFEKyVEOCVBNyVEOSU4NCVEOCVBRCVEOCVBQyVEOCVCMislRDglQTclRDklODQlRDglQUMlRDglQUYlRDklOEElRDglQUYiO3M6MjA6ImFjdGl2aXR5X3Jlc2NoZWR1bGVkIjtzOjExMToiJUQ4JUFBJUQ5JTg1KyVEOCVBNSVEOCVCOSVEOCVBNyVEOCVBRiVEOCVBOSslRDglQUMlRDglQUYlRDklODglRDklODQlRDglQTkrJUQ4JUE3JUQ5JTg0JUQ5JTg2JUQ4JUI0JUQ4JUE3JUQ4JUI3IjtzOjE3OiJub19zZXJ2aWNlc19mb3VuZCI7czo2ODoiJUQ5JTg0JUQ4JUE3KyVEOCVBQSVEOSU4OCVEOCVBQyVEOCVBRislRDglQUUlRDglQUYlRDklODUlRDglQTclRDglQUEiO3M6MTY6ImFwaV9rZXlfbWlzbWF0Y2giO3M6ODQ6IiVEOCVCOSVEOCVBRiVEOSU4NSslRDglQUElRDglQjclRDglQTclRDglQTglRDklODIrJUQ5JTg1JUQ5JTgxJUQ4JUFBJUQ4JUE3JUQ4JUFEK0FQSSI7czoyMToicG9zdGFsX2NvZGVfbm90X2ZvdW5kIjtzOjEyMzoiJUQ4JUE3JUQ5JTg0JUQ4JUIxJUQ5JTg1JUQ4JUIyKyVEOCVBNyVEOSU4NCVEOCVBOCVEOCVCMSVEOSU4QSVEOCVBRiVEOSU4QSslRDglQkElRDklOEElRDglQjErJUQ5JTg1JUQ5JTg4JUQ4JUFDJUQ5JTg4JUQ4JUFGIjtzOjE3OiJwb3N0YWxfY29kZV9mb3VuZCI7czoxNDI6IiVEOCVBQSVEOSU4NSslRDglQTclRDklODQlRDglQjklRDglQUIlRDklODglRDglQjErJUQ4JUI5JUQ5JTg0JUQ5JTg5KyVEOCVBNyVEOSU4NCVEOCVCMSVEOSU4NSVEOCVCMislRDglQTclRDklODQlRDglQTglRDglQjElRDklOEElRDglQUYlRDklOEEiO3M6Mjg6ImV4dHJhX3NlcnZpY2VzX25vdF9hdmFpbGFibGUiO3M6MTIzOiIlRDglQUUlRDglQUYlRDklODUlRDglQTclRDglQUErJUQ4JUE1JUQ4JUI2JUQ4JUE3JUQ5JTgxJUQ5JThBJUQ4JUE5KyVEOCVCQSVEOSU4QSVEOCVCMSslRDklODUlRDglQUElRDklODglRDklODElRDglQjElRDglQTkiO3M6MTg6Im5vX3VuaXRzX2F2YWlsYWJsZSI7czo5OToiJUQ5JTg0JUQ4JUE3KyVEOCVBQSVEOSU4OCVEOCVBQyVEOCVBRislRDklODglRDglQUQlRDglQUYlRDglQTclRDglQUErJUQ5JTg1JUQ4JUFBJUQ4JUE3JUQ4JUFEJUQ4JUE5IjtzOjI4OiJub19mcmVxdWVudGx5X2Rpc2NvdW50X2ZvdW5kIjtzOjIxMjoiJUQ5JTg0JUQ5JTg1KyVEOSU4QSVEOCVBQSVEOSU4NSslRDglQTclRDklODQlRDglQjklRDglQUIlRDklODglRDglQjErJUQ4JUI5JUQ5JTg0JUQ5JTg5KyVEOCVBNyVEOSU4NCVEOCVBRSVEOCVCNSVEOSU4NSslRDklODElRDklOEErJUQ5JTgzJUQ4JUFCJUQ5JThBJUQ4JUIxKyVEOSU4NSVEOSU4NislRDglQTclRDklODQlRDglQTMlRDglQUQlRDklOEElRDglQTclRDklODYiO3M6MzU6ImluY29ycmVjdF9lbWFpbF9hZGRyZXNzX29yX3Bhc3N3b3JkIjtzOjI1MzoiJUQ4JUI5JUQ5JTg2JUQ5JTg4JUQ4JUE3JUQ5JTg2KyVEOCVBNyVEOSU4NCVEOCVBOCVEOCVCMSVEOSU4QSVEOCVBRislRDglQTclRDklODQlRDglQTUlRDklODQlRDklODMlRDglQUElRDglQjElRDklODglRDklODYlRDklOEErJUQ4JUEzJUQ5JTg4KyVEOSU4MyVEOSU4NCVEOSU4NSVEOCVBOSslRDglQTclRDklODQlRDklODUlRDglQjElRDklODglRDglQjErJUQ4JUJBJUQ5JThBJUQ4JUIxKyVEOCVCNSVEOCVBRCVEOSU4QSVEOCVBRCVEOCVBOSI7czoyMToibm9fYXBwb2ludG1lbnRzX2ZvdW5kIjtzOjEyNDoiJUQ5JTg0JUQ5JTg1KyVEOSU4QSVEOCVBQSVEOSU4NSslRDglQTclRDklODQlRDglQjklRDglQUIlRDklODglRDglQjErJUQ4JUI5JUQ5JTg0JUQ5JTg5KyVEOSU4NSVEOSU4OCVEOCVBNyVEOCVCOSVEOSU4QSVEOCVBRiI7czo0MToieW91cl9hcHBvaW50bWVudF9yZXNjaGVkdWxlZF9zdWNjZXNzZnVsbHkiO3M6MTM2OiIlRDglQUElRDklODUrJUQ4JUE1JUQ4JUI5JUQ4JUE3JUQ4JUFGJUQ4JUE5KyVEOCVBQyVEOCVBRiVEOSU4OCVEOSU4NCVEOCVBOSslRDklODUlRDklODglRDglQjklRDglQUYlRDklODMrJUQ4JUE4JUQ5JTg2JUQ4JUFDJUQ4JUE3JUQ4JUFEIjtzOjI2OiJzb3JyeV93ZV9hcmVfbm90X2F2YWlsYWJsZSI7czoxMDc6IiVEOCVBMiVEOCVCMyVEOSU4MSslRDglOEMrJUQ5JTg2JUQ4JUFEJUQ5JTg2KyVEOSU4NCVEOCVCMyVEOSU4NiVEOCVBNyslRDklODUlRDglQUElRDglQTclRDglQUQlRDklOEElRDklODYuIjtzOjM5OiJ5b3VyX2FwcG9pbnRtZW50X2NhbmNlbGxlZF9zdWNjZXNzZnVsbHkiO3M6MTA1OiIlRDglQUElRDklODUrJUQ4JUE1JUQ5JTg0JUQ4JUJBJUQ4JUE3JUQ4JUExKyVEOSU4NSVEOSU4OCVEOCVCOSVEOCVBRiVEOSU4MyslRDglQTglRDklODYlRDglQUMlRDglQTclRDglQUQiO3M6MTk6ImNvdXBvbl9jb2RlX2V4cGlyZWQiO3M6MTI5OiIlRDglQTclRDklODYlRDglQUElRDklODclRDglQUErJUQ4JUI1JUQ5JTg0JUQ4JUE3JUQ4JUFEJUQ5JThBJUQ4JUE5KyVEOCVCMSVEOSU4NSVEOCVCMislRDglQTclRDklODQlRDklODIlRDglQjMlRDklOEElRDklODUlRDglQTkiO3M6MTk6ImludmFsaWRfY291cG9uX2NvZGUiO3M6OTM6IiVEOCVCMSVEOSU4MiVEOSU4NSslRDklODIlRDglQjMlRDklOEElRDklODUlRDklODcrJUQ4JUJBJUQ5JThBJUQ4JUIxKyVEOCVCNSVEOCVBNyVEOSU4NCVEOCVBRCI7czoyNzoicGFydGlhbF9kZXBvc2l0X2lzX2Rpc2FibGVkIjtzOjEyMzoiJUQ4JUFBJUQ5JTg1KyVEOCVBQSVEOCVCOSVEOCVCNyVEOSU4QSVEOSU4NCslRDglQTclRDklODQlRDglQTUlRDklOEElRDglQUYlRDglQTclRDglQjkrJUQ4JUE3JUQ5JTg0JUQ4JUFDJUQ4JUIyJUQ4JUE2JUQ5JThBIjtzOjU0OiJub25lX29mX3RpbWVfc2xvdF9hdmFpbGFibGVfcGxlYXNlX2NoZWNrX2Fub3RoZXJfZGF0ZXMiO3M6MjUwOiIlRDklODQlRDglQTcrJUQ5JThBJUQ5JTg4JUQ4JUFDJUQ4JUFGKyVEOSU4OCVEOSU4MiVEOCVBQSslRDklODElRDglQUElRDglQUQlRDglQTkrJUQ5JTg1JUQ4JUFBJUQ4JUE3JUQ4JUFEKyVEOCU4QyslRDklOEElRDglQjElRDglQUMlRDklODkrJUQ4JUE3JUQ5JTg0JUQ4JUFBJUQ4JUFEJUQ5JTgyJUQ5JTgyKyVEOSU4NSVEOSU4NislRDglQUElRDklODglRDglQTclRDglQjElRDklOEElRDglQUUrJUQ4JUEzJUQ4JUFFJUQ4JUIxJUQ5JTg5IjtzOjQ2OiJhdmFpbGFiaWxpdHlfaXNfbm90X2NvbmZpZ3VyZWRfZnJvbV9hZG1pbl9zaWRlIjtzOjE4MDoiJUQ5JTg0JUQ5JTg1KyVEOSU4QSVEOCVBQSVEOSU4NSslRDglQUElRDklODMlRDklODglRDklOEElRDklODYrJUQ4JUE3JUQ5JTg0JUQ4JUFBJUQ5JTg4JUQ5JTgxJUQ4JUIxKyVEOSU4NSVEOSU4NislRDglQUMlRDglQTclRDklODYlRDglQTgrJUQ4JUE3JUQ5JTg0JUQ5JTg1JUQ4JUIzJUQ4JUE0JUQ5JTg4JUQ5JTg0IjtzOjI5OiJjdXN0b21lcl9jcmVhdGVkX3N1Y2Nlc3NmdWxseSI7czoxMTE6IiVEOCVBQSVEOSU4NSslRDglQTUlRDklODYlRDglQjQlRDglQTclRDglQTErJUQ4JUE3JUQ5JTg0JUQ4JUI5JUQ5JTg1JUQ5JThBJUQ5JTg0KyVEOCVBOCVEOSU4NiVEOCVBQyVEOCVBNyVEOCVBRCI7czozMToiZXJyb3Jfb2NjdXJyZWRfcGxlYXNlX3RyeV9hZ2FpbiI7czoxNjI6IiVEOCVBRCVEOCVBRiVEOCVBQislRDglQUUlRDglQjclRDglQTMrJUQ4JThDKyVEOSU4QSVEOCVCMSVEOCVBQyVEOSU4OSslRDglQTclRDklODQlRDklODUlRDglQUQlRDglQTclRDklODglRDklODQlRDglQTkrJUQ5JTg1JUQ4JUIxJUQ4JUE5KyVEOCVBMyVEOCVBRSVEOCVCMSVEOSU4OSI7czozMToiYXBwb2ludG1lbnRfYm9va2VkX3N1Y2Nlc3NmdWxseSI7czo3NDoiJUQ4JUFEJUQ4JUFDJUQ4JUIyKyVEOSU4NSVEOSU4OCVEOCVCOSVEOCVBRislRDglQTglRDklODYlRDglQUMlRDglQTclRDglQUQiO3M6MjQ6InVzZXJfZGV0YWlsc19ub3RfdXBkYXRlZCI7czoxMzU6IiVEOCVBQSVEOSU4MSVEOCVBNyVEOCVCNSVEOSU4QSVEOSU4NCslRDglQTclRDklODQlRDklODUlRDglQjMlRDglQUElRDglQUUlRDglQUYlRDklODUrJUQ4JUJBJUQ5JThBJUQ4JUIxKyVEOSU4NSVEOCVBRCVEOCVBRiVEOCVBQiVEOCVBOSI7czozNjoidXNlcl9ub3RfZXhpc3RfcGxlYXNlX3JlZ2lzdGVyX2ZpcnN0IjtzOjIwOToiJUQ4JUE3JUQ5JTg0JUQ5JTg1JUQ4JUIzJUQ4JUFBJUQ4JUFFJUQ4JUFGJUQ5JTg1KyVEOCVCQSVEOSU4QSVEOCVCMSslRDklODUlRDklODglRDglQUMlRDklODglRDglQUYrJUQ4JUE3JUQ5JTg0JUQ4JUIxJUQ4JUFDJUQ4JUE3JUQ4JUExKyVEOCVBNyVEOSU4NCVEOCVBQSVEOCVCMyVEOCVBQyVEOSU4QSVEOSU4NCslRDglQTMlRDklODglRDklODQlRDglQTclRDklOEIiO3M6MTg6InVzZXJfYWxyZWFkeV9leGlzdCI7czoxMTY6IiVEOCVBNyVEOSU4NCVEOSU4NSVEOCVCMyVEOCVBQSVEOCVBRSVEOCVBRiVEOSU4NSslRDklODUlRDklODglRDglQUMlRDklODglRDglQUYrJUQ4JUE4JUQ4JUE3JUQ5JTg0JUQ5JTgxJUQ4JUI5JUQ5JTg0IjtzOjE3OiJpbnZhbGlkX3VzZXJfdHlwZSI7czoxMTE6IiVEOSU4NiVEOSU4OCVEOCVCOSslRDglQTclRDklODQlRDklODUlRDglQjMlRDglQUElRDglQUUlRDglQUYlRDklODUrJUQ4JUJBJUQ5JThBJUQ4JUIxKyVEOCVCNSVEOCVBNyVEOSU4NCVEOCVBRCI7czoxNDoibm9fc3RhZmZfZm91bmQiO3M6MTM2OiIlRDklODQlRDklODUrJUQ5JThBJUQ4JUFBJUQ5JTg1KyVEOCVBNyVEOSU4NCVEOCVCOSVEOCVBQiVEOSU4OCVEOCVCMSslRDglQjklRDklODQlRDklODkrJUQ4JUE3JUQ5JTg0JUQ5JTg1JUQ5JTg4JUQ4JUI4JUQ5JTgxJUQ5JThBJUQ5JTg2IjtzOjIwOiJub19kZXRhaWxzX2F2YWlsYWJsZSI7czoxMDU6IiVEOSU4NCVEOCVBNyslRDglQUElRDklODglRDglQUMlRDglQUYrJUQ4JUFBJUQ5JTgxJUQ4JUE3JUQ4JUI1JUQ5JThBJUQ5JTg0KyVEOSU4NSVEOCVBQSVEOCVBNyVEOCVBRCVEOCVBOSI7czoxNjoidHlwZV9pc19taXNtYXRjaCI7czo4NjoiJUQ4JUE3JUQ5JTg0JUQ5JTg2JUQ5JTg4JUQ4JUI5KyVEOCVCQSVEOSU4QSVEOCVCMSslRDklODUlRDglQUElRDglQjclRDglQTclRDglQTglRDklODIiO3M6MjA6InVwZGF0ZWRfc3VjY2Vzc2Z1bGx5IjtzOjg2OiIlRDglQUElRDklODUrJUQ4JUE3JUQ5JTg0JUQ4JUFBJUQ4JUFEJUQ4JUFGJUQ5JThBJUQ4JUFCKyVEOCVBOCVEOSU4NiVEOCVBQyVEOCVBNyVEOCVBRCI7czoyMDoic29tZXRoaW5nX3dlbnRfd3JvbmciO3M6NTY6IiVEOSU4NyVEOSU4NiVEOCVBNyVEOSU4MyslRDglQUUlRDglQjclRDglQTMrJUQ5JTg1JUQ4JUE3IjtzOjM2OiJwbGVhc2VfY2hlY2tfeW91cl9jb25maXJtZWRfcGFzc3dvcmQiO3M6MTgyOiIlRDklOEElRDglQjElRDglQUMlRDklODkrJUQ4JUE3JUQ5JTg0JUQ4JUFBJUQ4JUFEJUQ5JTgyJUQ5JTgyKyVEOSU4NSVEOSU4NislRDklODMlRDklODQlRDklODUlRDglQTkrJUQ4JUE3JUQ5JTg0JUQ5JTg1JUQ4JUIxJUQ5JTg4JUQ4JUIxKyVEOCVBNyVEOSU4NCVEOSU4NSVEOCVBNCVEOSU4MyVEOCVBRiVEOCVBOSUyMSI7czoyMzoieW91cl9wYXNzd29yZF9ub3RfbWF0Y2giO3M6MTIzOiIlRDklODMlRDklODQlRDklODUlRDglQTkrJUQ4JUE3JUQ5JTg0JUQ5JTg1JUQ4JUIxJUQ5JTg4JUQ4JUIxKyVEOCVCQSVEOSU4QSVEOCVCMSslRDklODUlRDglQUElRDglQjclRDglQTclRDglQTglRDklODIlRDglQTkiO3M6MjQ6Im5vX3VwY29tbWluZ19hcHBvaW50bWVudCI7czo4MDoiJUQ5JTg0JUQ4JUE3KyVEOCVBNyVEOSU4NCVEOCVBQSVEOCVCOSVEOSU4QSVEOSU4QSVEOSU4NislRDklODUlRDklODglRDglQjklRDglQUYiO3M6MTE6ImVtYWlsX2V4aXN0IjtzOjEyODoiJUQ4JUE3JUQ5JTg0JUQ4JUE4JUQ4JUIxJUQ5JThBJUQ4JUFGKyVEOCVBNyVEOSU4NCVEOCVBNSVEOSU4NCVEOSU4MyVEOCVBQSVEOCVCMSVEOSU4OCVEOSU4NiVEOSU4QSslRDklODUlRDklODglRDglQUMlRDklODglRDglQUYiO3M6MjA6ImVtYWlsX2RvZXNfbm90X2V4aXN0IjtzOjE0NzoiJUQ4JUE3JUQ5JTg0JUQ4JUE4JUQ4JUIxJUQ5JThBJUQ4JUFGKyVEOCVBNyVEOSU4NCVEOCVBNSVEOSU4NCVEOSU4MyVEOCVBQSVEOCVCMSVEOSU4OCVEOSU4NiVEOSU4QSslRDglQkElRDklOEElRDglQjErJUQ5JTg1JUQ5JTg4JUQ4JUFDJUQ5JTg4JUQ4JUFGIjtzOjE5OiJpbnZhbGlkX2NyZWRlbnRpYWxzIjtzOjEzNToiJUQ4JUE4JUQ5JThBJUQ4JUE3JUQ5JTg2JUQ4JUE3JUQ4JUFBKyVEOCVBNyVEOSU4NCVEOCVBNyVEOCVCOSVEOCVBQSVEOSU4NSVEOCVBNyVEOCVBRislRDglQkElRDklOEElRDglQjErJUQ4JUI1JUQ4JUE3JUQ5JTg0JUQ4JUFEJUQ4JUE5IjtzOjEwOiJlbWFpbF9zZW5kIjtzOjEyODoiJUQ4JUE1JUQ4JUIxJUQ4JUIzJUQ4JUE3JUQ5JTg0KyVEOCVBNyVEOSU4NCVEOCVBOCVEOCVCMSVEOSU4QSVEOCVBRislRDglQTclRDklODQlRDglQTUlRDklODQlRDklODMlRDglQUElRDglQjElRDklODglRDklODYlRDklOEEiO3M6MjA6ImVtYWlsX3NlbmRpbmdfZmFpbGVkIjtzOjE0NzoiJUQ5JTgxJUQ4JUI0JUQ5JTg0KyVEOCVBNSVEOCVCMSVEOCVCMyVEOCVBNyVEOSU4NCslRDglQTclRDklODQlRDglQTglRDglQjElRDklOEElRDglQUYrJUQ4JUE3JUQ5JTg0JUQ4JUE1JUQ5JTg0JUQ5JTgzJUQ4JUFBJUQ4JUIxJUQ5JTg4JUQ5JTg2JUQ5JThBIjtzOjE3OiJub19vcmRlcnNfZGV0YWlscyI7czoxMDU6IiVEOSU4NCVEOCVBNyslRDglQUElRDklODglRDglQUMlRDglQUYrJUQ4JUFBJUQ5JTgxJUQ4JUE3JUQ4JUI1JUQ5JThBJUQ5JTg0KyVEOCVBMyVEOSU4OCVEOCVBNyVEOSU4NSVEOCVCMSI7czoxMDoibWVzc2FnZV9pcyI7czo1NToiJUQ4JUE3JUQ5JTg0JUQ4JUIxJUQ4JUIzJUQ4JUE3JUQ5JTg0JUQ4JUE5KyVEOSU4NyVEOSU4QSI7czoyMDoicGxlYXNlX2VuYWJsZV9zdHJpcGUiO3M6OTI6IiVEOSU4QSVEOCVCMSVEOCVBQyVEOSU4OSslRDglQUElRDklODUlRDklODMlRDklOEElRDklODYrJUQ4JUE3JUQ5JTg0JUQ4JUI0JUQ4JUIxJUQ5JThBJUQ4JUI3IjtzOjE1OiJpbnZhbGlkX3JlcXVlc3QiO3M6NjI6IiVEOCVCNyVEOSU4NCVEOCVBOCslRDglQkElRDklOEElRDglQjErJUQ4JUI1JUQ4JUE3JUQ5JTg0JUQ4JUFEIjtzOjk6Im90cF9tYXRjaCI7czo0MDoiJUQ5JTg1JUQ4JUE4JUQ4JUE3JUQ4JUIxJUQ4JUE3JUQ4JUE5K090cCI7czoxMzoib3RwX25vdF9tYXRjaCI7czo1OToiT3RwKyVEOCVCQSVEOSU4QSVEOCVCMSslRDklODUlRDglQUElRDglQjclRDglQTclRDglQTglRDklODIiO3M6MTg6InBhc3N3b3JkX2lzX2NoYW5nZSI7czoxMTc6IiVEOSU4MyVEOSU4NCVEOSU4NSVEOCVBOSslRDglQTclRDklODQlRDklODUlRDglQjElRDklODglRDglQjErJUQ5JTg3JUQ5JThBKyVEOCVBNyVEOSU4NCVEOCVBQSVEOCVCQSVEOSU4QSVEOSU4QSVEOCVCMSI7czoxOToicGFzc3dvcmRfbm90X2NoYW5nZSI7czoxMDU6IiVEOSU4MyVEOSU4NCVEOSU4NSVEOCVBOSslRDglQTclRDklODQlRDklODUlRDglQjElRDklODglRDglQjErJUQ5JTg0JUQ4JUE3KyVEOCVBQSVEOCVBQSVEOCVCQSVEOSU4QSVEOCVCMSI7czo1NjoiYXJlX3lvdV9zdXJlX3lvdV93YW50X3RvX2NhbmNlbF90aGlzX2Jvb2tpbmdfYXBwb2ludG1lbnQiO3M6MTk4OiIlRDklODclRDklODQrJUQ4JUFBJUQ4JUIxJUQ5JThBJUQ4JUFGKyVEOCVBOCVEOCVBNyVEOSU4NCVEOCVBQSVEOCVBMyVEOSU4MyVEOSU4QSVEOCVBRislRDglQTUlRDklODQlRDglQkElRDglQTclRDglQTErJUQ5JTg1JUQ5JTg4JUQ4JUI5JUQ4JUFGKyVEOCVBNyVEOSU4NCVEOCVBRCVEOCVBQyVEOCVCMislRDklODclRDglQjAlRDglQTclRDglOUYiO3M6NToiYWxlcnQiO3M6MjQ6IiVEOSU4NSVEOCVBRCVEOCVCMiVEOCVCMSI7czoyOiJubyI7czoxMjoiJUQ5JTg0JUQ4JUE3IjtzOjE1OiJ2ZXJpZnlfemlwX2NvZGUiO3M6MTExOiIlRDglQUElRDglQUQlRDklODIlRDklODIrJUQ5JTg1JUQ5JTg2KyVEOCVBNyVEOSU4NCVEOCVCMSVEOSU4NSVEOCVCMislRDglQTclRDklODQlRDglQTglRDglQjElRDklOEElRDglQUYlRDklOEEiO3M6MTE6InBvc3RhbF9jb2RlIjtzOjczOiIlRDglQTclRDklODQlRDglQjElRDklODUlRDglQjIrJUQ4JUE3JUQ5JTg0JUQ4JUE4JUQ4JUIxJUQ5JThBJUQ4JUFGJUQ5JThBIjtzOjMwOiJub19tZXRob2RfZm9yX3NlbGVjdGVkX3NlcnZpY2UiO3M6MTQ4OiIlRDklODQlRDglQTcrJUQ4JUFBJUQ5JTg4JUQ4JUFDJUQ4JUFGKyVEOCVCNyVEOCVCMSVEOSU4QSVEOSU4MiVEOCVBOSslRDklODQlRDklODQlRDglQUUlRDglQUYlRDklODUlRDglQTkrJUQ4JUE3JUQ5JTg0JUQ5JTg1JUQ4JUFEJUQ4JUFGJUQ4JUFGJUQ4JUE5IjtzOjI0OiJwbGVhc2VfZW50ZXJfcG9zdGFsX2NvZGUiO3M6MTQxOiIlRDglQTclRDklODQlRDglQjElRDglQUMlRDglQTclRDglQTErJUQ4JUE1JUQ4JUFGJUQ4JUFFJUQ4JUE3JUQ5JTg0KyVEOCVBNyVEOSU4NCVEOCVCMSVEOSU4NSVEOCVCMislRDglQTclRDklODQlRDglQTglRDglQjElRDklOEElRDglQUYlRDklOEEiO3M6Mjk6Im5vX2FkZG9uc19mb3Jfc2VsZWN0ZWRfbWV0aG9kIjtzOjEzNToiJUQ5JTg0JUQ4JUE3KyVEOCVBNSVEOCVCNiVEOCVBNyVEOSU4MSVEOCVBNyVEOCVBQSslRDklODQlRDklODQlRDglQjclRDglQjElRDklOEElRDklODIlRDglQTkrJUQ4JUE3JUQ5JTg0JUQ5JTg1JUQ4JUFEJUQ4JUFGJUQ4JUFGJUQ4JUE5IjtzOjIzOiJzZWxlY3RfYXRsZWFzdF9vbmVfdW5pdCI7czoxMjQ6IiVEOCVBRCVEOCVBRiVEOCVBRislRDklODglRDglQUQlRDglQUYlRDglQTkrJUQ5JTg4JUQ4JUE3JUQ4JUFEJUQ4JUFGJUQ4JUE5KyVEOCVCOSVEOSU4NCVEOSU4OSslRDglQTclRDklODQlRDglQTMlRDklODIlRDklODQiO3M6MTg6InNlbGVjdF9hbnlfcGFja2FnZSI7czo1NjoiJUQ4JUFEJUQ4JUFGJUQ4JUFGKyVEOCVBMyVEOSU4QSslRDglQUQlRDglQjIlRDklODUlRDglQTkiO3M6MTE6InBsZWFzZV93YWl0IjtzOjYxOiIlRDglQTclRDglQjElRDglQUMlRDklODglRDklODMrJUQ4JUE3JUQ5JTg2JUQ4JUFBJUQ4JUI4JUQ4JUIxIjt9' WHERE `language`='ar'";
		mysqli_query($this->conn, $update_app_ar_lang);
		$update_app_zh_CN_lang = "UPDATE `ct_languages` SET `app_labels`='YToxNzg6e3M6Nzoid2VsY29tZSI7czoxODoiJUU2JUFDJUEyJUU4JUJGJThFIjtzOjI4OiJtYWtlX3lvdXJfb25saW5lX2FwcG9pbnRtZW50IjtzOjU0OiIlRTglQkYlOUIlRTglQTElOEMlRTUlOUMlQTglRTclQkElQkYlRTklQTIlODQlRTclQkElQTYiO3M6NDoic2tpcCI7czoxODoiJUU4JUI3JUIzJUU4JUI3JTgzIjtzOjEwOiJzY2hlZHVsaW5nIjtzOjE4OiIlRTglQjAlODMlRTUlQkElQTYiO3M6NTA6Im1ha2VfeW91cl9vbmxpbmVfYXBwb2ludG1lbnRfc2NoZWR1bGluZ19zdXBlcl9lYXN5IjtzOjEzNToiJUU4JUFFJUE5JUU2JTgyJUE4JUU3JTlBJTg0JUU1JTlDJUE4JUU3JUJBJUJGJUU5JUEyJTg0JUU3JUJBJUE2JUU1JUFFJTg5JUU2JThFJTkyJUU1JThGJTk4JUU1JUJFJTk3JUU5JTlEJTlFJUU1JUI4JUI4JUU4JUJEJUJCJUU2JTlEJUJFIjtzOjExOiJnZXRfc3RhcnRlZCI7czoxODoiJUU1JTg1JUE1JUU5JTk3JUE4IjtzOjQyOiJnZXRfc3RhcnRlZF9ieV9sb2dnaW5nX2luX29yX2J5X3NpZ25pbmdfdXAiO3M6OTk6IiVFNyU5OSVCQiVFNSVCRCU5NSVFNiU4OCU5NiVFNiVCMyVBOCVFNSU4NiU4QyVFNSU4RCVCMyVFNSU4RiVBRiVFNSVCQyU4MCVFNSVBNyU4QiVFNCVCRCVCRiVFNyU5NCVBOCI7czo3OiJzaWduX2luIjtzOjE4OiIlRTclOTklQkIlRTUlODUlQTUiO3M6MTY6ImVudGVyX3lvdXJfZW1haWwiO3M6NzI6IiVFOCVCRSU5MyVFNSU4NSVBNSVFNCVCRCVBMCVFNyU5QSU4NCVFNyU5NCVCNSVFNSVBRCU5MCVFOSU4MiVBRSVFNyVBRSVCMSI7czoxNDoiZW50ZXJfcGFzc3dvcmQiO3M6MzY6IiVFOCVCRSU5MyVFNSU4NSVBNSVFNSVBRiU4NiVFNyVBMCU4MSI7czoxNToiZm9yZ290X3Bhc3N3b3JkIjtzOjQ1OiIlRTUlQkYlOTglRTglQUUlQjAlRTUlQUYlODYlRTclQTAlODElRUYlQkMlOUYiO3M6NToibG9naW4iO3M6MTg6IiVFNyU5OSVCQiVFNSVCRCU5NSI7czoyNToiZG9udF9oYXZlX2FjY291bnRfc2lnbl91cCI7czo2MzoiJUU2JUIyJUExJUU2JTlDJTg5JUU1JUI4JTkwJUU2JTg4JUI3JUVGJUJDJTlGJUU2JUIzJUE4JUU1JTg2JThDIjtzOjI0OiJlbnRlcl9lbWFpbF9hbmRfcGFzc3dvcmQiO3M6ODE6IiVFOCVCRSU5MyVFNSU4NSVBNSVFNyU5NCVCNSVFNSVBRCU5MCVFOSU4MiVBRSVFNCVCQiVCNiVFNSU5MiU4QyVFNSVBRiU4NiVFNyVBMCU4MSI7czo3MToicGxlYXNlX2VudGVyX3lvdXJfcmVnaXN0ZXJlZF9lbWFpbF9pZF93ZV93aWxsX3NlbmRfb3RwX3RvX3lvdXJfZW1haWxfaWQiO3M6MjQxOiIlRTglQUYlQjclRTglQkUlOTMlRTUlODUlQTUlRTYlODIlQTglRTclOUElODQlRTYlQjMlQTglRTUlODYlOEMlRTclOTQlQjUlRTUlQUQlOTAlRTklODIlQUUlRTQlQkIlQjZJRCVFMyU4MCU4MiVFNiU4OCU5MSVFNCVCQiVBQyVFNCVCQyU5QSVFNSVCMCU4Nk9UUCVFNSU4RiU5MSVFOSU4MCU4MSVFNSU4OCVCMCVFNiU4MiVBOCVFNyU5QSU4NCVFNyU5NCVCNSVFNSVBRCU5MCVFOSU4MiVBRSVFNCVCQiVCNklEJUUzJTgwJTgyIjtzOjE0OiJlbnRlcl95b3VyX290cCI7czozOToiJUU4JUJFJTkzJUU1JTg1JUE1JUU2JTgyJUE4JUU3JTlBJTg0T1RQIjtzOjg6InNlbmRfb3RwIjtzOjIxOiIlRTUlOEYlOTElRTklODAlODFPVFAiO3M6MTY6ImN1cnJlbnRfcGFzc3dvcmQiO3M6MzY6IiVFNSVCRCU5MyVFNSU4OSU4RCVFNSVBRiU4NiVFNyVBMCU4MSI7czoxMjoibmV3X3Bhc3N3b3JkIjtzOjI3OiIlRTYlOTYlQjAlRTUlQUYlODYlRTclQTAlODEiO3M6MTY6ImNvbmZpcm1fcGFzc3dvcmQiO3M6MzY6IiVFNyVBMSVBRSVFOCVBRSVBNCVFNSVBRiU4NiVFNyVBMCU4MSI7czoxMToic2VydmVyX2Rvd24iO3M6NDU6IiVFNiU5QyU4RCVFNSU4QSVBMSVFNSU5OSVBOCVFNSU4NSVCMyVFOSU5NyVBRCI7czoxMDoidmVyaWZ5X290cCI7czoyMToiJUU5JUFBJThDJUU4JUFGJTgxT1RQIjtzOjY6ImNsaWVudCI7czoxODoiJUU1JUFFJUEyJUU2JTg4JUI3IjtzOjE3OiJ1cGRhdGluZ19wYXNzd29yZCI7czozNjoiJUU2JTlCJUI0JUU2JTk2JUIwJUU1JUFGJTg2JUU3JUEwJTgxIjtzOjI5OiJwYXNzd29yZF91cGRhdGVkX3N1Y2Nlc3NmdWxseSI7czo2MzoiJUU1JUFGJTg2JUU3JUEwJTgxJUU1JUI3JUIyJUU2JTg4JTkwJUU1JThBJTlGJUU2JTlCJUI0JUU2JTk2JUIwIjtzOjE3OiJwYXNzd29yZF9taXNtYXRjaCI7czozNjoiJUU1JUFGJTg2JUU3JUEwJTgxJUU2JTlDJTg5JUU4JUFGJUFGIjtzOjIyOiJpbmNvcnJlY3Rfb2xkX3Bhc3N3b3JkIjtzOjU0OiIlRTYlOTclQTclRTUlQUYlODYlRTclQTAlODElRTQlQjglOEQlRTYlQUQlQTMlRTclQTElQUUiO3M6MjI6InBsZWFzZV9maWxsX2FsbF9maWVsZHMiO3M6NjM6IiVFOCVBRiVCNyVFNSVBMSVBQiVFNSU4NiU5OSVFNiU4OSU4MCVFNiU5QyU4OSVFNSVBRCU5NyVFNiVBRSVCNSI7czo2OiJzdWJtaXQiO3M6MTg6IiVFNiU4RiU5MCVFNCVCQSVBNCI7czoxMDoiZmlyc3RfbmFtZSI7czoxODoiJUU1JTkwJThEJUU1JUFEJTk3IjtzOjk6Imxhc3RfbmFtZSI7czo5OiIlRTUlQTclOTMiO3M6NToiZW1haWwiO3M6MzY6IiVFNyU5NCVCNSVFNSVBRCU5MCVFOSU4MiVBRSVFNCVCQiVCNiI7czo1OiJwaG9uZSI7czoxODoiJUU3JTk0JUI1JUU4JUFGJTlEIjtzOjc6ImFkZHJlc3MiO3M6MTg6IiVFNSU5QyVCMCVFNSU5RCU4MCI7czo0OiJjaXR5IjtzOjk6IiVFNSVCOCU4MiI7czo3OiJjb3VudHJ5IjtzOjE4OiIlRTUlOUIlQkQlRTUlQUUlQjYiO3M6ODoicG9zdGNvZGUiO3M6MTg6IiVFOSU4MiVBRSVFNyVCQyU5NiI7czo4OiJwYXNzd29yZCI7czoxODoiJUU1JUFGJTg2JUU3JUEwJTgxIjtzOjc6InNpZ25fdXAiO3M6MTg6IiVFNiVCMyVBOCVFNSU4NiU4QyI7czoyMzoiYWxyZWFkeV9oYXZlX2FuX2FjY291bnQiO3M6NjM6IiVFNSVCNyVCMiVFNyVCQiU4RiVFNiU4QiVBNSVFNiU5QyU4OSVFOCVCNCVBNiVFNiU4OCVCNyVFRiVCQyU5RiI7czo0OiJob21lIjtzOjk6IiVFNSVBRSVCNiI7czoxMDoid2VsY29tZV90byI7czozNjoiJUU2JUFDJUEyJUU4JUJGJThFJUU2JTlEJUE1JUU1JTg4JUIwIjtzOjExOiJuZXdfYm9va2luZyI7czoyNzoiJUU2JTk2JUIwJUU5JUEyJTg0JUU4JUFFJUEyIjtzOjExOiJteV9ib29raW5ncyI7czozNjoiJUU2JTg4JTkxJUU3JTlBJTg0JUU5JUEyJTg0JUU4JUFFJUEyIjtzOjE1OiJteV90cmFuc2FjdGlvbnMiO3M6MzY6IiVFNiU4OCU5MSVFNyU5QSU4NCVFNCVCQSVBNCVFNiU5OCU5MyI7czoxMToibXlfc2V0dGluZ3MiO3M6MzY6IiVFNiU4OCU5MSVFNyU5QSU4NCVFOCVBRSVCRSVFNyVCRCVBRSI7czo0Mjoid2hlcmVfd291bGRfeW91X2xpa2VfdXNfdG9fcHJvdmlkZV9zZXJ2aWNlIjtzOjExNzoiJUU2JTgyJUE4JUU1JUI4JThDJUU2JTlDJTlCJUU2JTg4JTkxJUU0JUJCJUFDJUU1JTlDJUE4JUU1JTkzJUFBJUU5JTg3JThDJUU2JThGJTkwJUU0JUJFJTlCJUU2JTlDJThEJUU1JThBJUExJUVGJUJDJTlGIjtzOjIxOiJwbGVhc2VfY2hvb3NlX3NlcnZpY2UiO3M6NDU6IiVFOCVBRiVCNyVFOSU4MCU4OSVFNiU4QiVBOSVFNiU5QyU4RCVFNSU4QSVBMSI7czo4OiJwcmV2aW91cyI7czoxODoiJUU0JUJCJUE1JUU1JTg5JThEIjtzOjQ6Im5leHQiO3M6Mjc6IiVFNCVCOCU4QiVFNCVCOCU4MCVFNCVCOCVBQSI7czo3OiJzZXJ2aWNlIjtzOjE4OiIlRTYlOUMlOEQlRTUlOEElQTEiO3M6NDoiY29zdCI7czoxODoiJUU2JTg4JTkwJUU2JTlDJUFDIjtzOjIwOiJwbGVhc2Vfc2VsZWN0X21ldGhvZCI7czo0NToiJUU4JUFGJUI3JUU5JTgwJTg5JUU2JThCJUE5JUU2JTk2JUI5JUU2JUIzJTk1IjtzOjIwOiJwbGVhc2Vfc2VsZWN0X29mZmVycyI7czo0NToiJUU4JUFGJUI3JUU5JTgwJTg5JUU2JThCJUE5JUU0JUJDJTk4JUU2JTgzJUEwIjtzOjE4OiJwbGVhc2Vfc2VsZWN0X3RpbWUiO3M6NDU6IiVFOCVBRiVCNyVFOSU4MCU4OSVFNiU4QiVBOSVFNiU5NyVCNiVFOSU5NyVCNCI7czoyMDoicGxlYXNlX3NlbGVjdF9hZGRvbnMiO3M6NDU6IiVFOCVBRiVCNyVFOSU4MCU4OSVFNiU4QiVBOSVFNiU4RiU5MiVFNCVCQiVCNiI7czo3OiJtb250aGx5IjtzOjM2OiIlRTYlQUYlOEYlRTYlOUMlODglRTQlQjglODAlRTYlQUMlQTEiO3M6OToiYmlfd2Vla2x5IjtzOjI3OiIlRTYlQUYlOTUlRTUlOTElQTglRTUlODglOEEiO3M6Njoid2Vla2x5IjtzOjE4OiIlRTYlQUYlOEYlRTUlOTElQTgiO3M6NDoib25jZSI7czoxODoiJUU0JUI4JTgwJUU2JTk3JUE2IjtzOjE4OiJwbGVhc2Vfc2VsZWN0X2RhdGUiO3M6NDU6IiVFOCVBRiVCNyVFOSU4MCU4OSVFNiU4QiVBOSVFNiU5NyVBNSVFNiU5QyU5RiI7czo0OiJkYXRlIjtzOjE4OiIlRTYlOTclQTUlRTYlOUMlOUYiO3M6MjI6InBsZWFzZV9zZWxlY3RfcHJvdmlkZXIiO3M6NTQ6IiVFOCVBRiVCNyVFOSU4MCU4OSVFNiU4QiVBOSVFNiU4RiU5MCVFNCVCRSU5QiVFNSU5NSU4NiI7czo0OiJ0aW1lIjtzOjE4OiIlRTYlOTclQjYlRTklOTclQjQiO3M6MTM6ImluY2x1ZGluZ190YXgiO3M6MTg6IiVFNSU5MCVBQiVFNyVBOCU4RSI7czoyNDoicHJlZmVycmVkX3BheW1lbnRfbWV0aG9kIjtzOjU0OiIlRTklQTYlOTYlRTklODAlODklRTQlQkIlOTglRTYlQUMlQkUlRTYlOTYlQjklRTUlQkMlOEYiO3M6MTE6ImxvY2FsbHlfcGF5IjtzOjM2OiIlRTYlOUMlQUMlRTUlOUMlQjAlRTQlQkIlOTglRTYlQUMlQkUiO3M6MjU6ImNyZWRpdF9kZWJpdF9jYXJkX3BheW1lbnQiO3M6NzU6IiVFNCVCRiVBMSVFNyU5NCVBOCVFNSU4RCVBMSUyRiVFNSU4MCU5RiVFOCVBRSVCMCVFNSU4RCVBMSVFNCVCQiU5OCVFNiVBQyVCRSI7czo2OiJjYW5jZWwiO3M6MTg6IiVFNSU4RiU5NiVFNiVCNiU4OCI7czoyNToiY3JlZGl0X2RlYml0X2NhcmRfZGV0YWlscyI7czo5MzoiJUU0JUJGJUExJUU3JTk0JUE4JUU1JThEJUExJTJGJUU1JTgwJTlGJUU4JUFFJUIwJUU1JThEJUExJUU4JUFGJUE2JUU3JUJCJTg2JUU0JUJGJUExJUU2JTgxJUFGIjtzOjEyOiJzZXJ2aWNlX25hbWUiO3M6MzY6IiVFNiU5QyU4RCVFNSU4QSVBMSVFNSU5MCU4RCVFNyVBNyVCMCI7czoxMjoiYm9va2luZ19kYXRlIjtzOjM2OiIlRTklQTIlODQlRTUlQUUlOUElRTYlOTclQTUlRTYlOUMlOUYiO3M6MTE6ImNhcnRfYW1vdW50IjtzOjQ1OiIlRTglQjQlQUQlRTclODklQTklRTglQkQlQTYlRTklODclOTElRTklQTIlOUQiO3M6MTY6ImJvb2tfYXBwb2ludG1lbnQiO3M6MzY6IiVFOSVBMiU4NCVFNyVCQSVBNiVFNyVCQSVBNiVFNCVCQyU5QSI7czoxMToiY2FyZF9udW1iZXIiO3M6MTg6IiVFNSU4RCVBMSVFNSU4RiVCNyI7czoxMjoiZXhwaXJ5X21vbnRoIjtzOjI3OiIlRTUlODglQjAlRTYlOUMlOUYlRTYlOUMlODgiO3M6MTE6ImV4cGlyeV95ZWFyIjtzOjM2OiIlRTUlODglQjAlRTYlOUMlOUYlRTUlQjklQjQlRTQlQkIlQkQiO3M6MTU6ImJvb2tpbmdfc3VtbWFyeSI7czozNjoiJUU5JUEyJTg0JUU4JUFFJUEyJUU2JTkxJTk4JUU4JUE2JTgxIjtzOjg6ImNhcmRfY3ZjIjtzOjEyOiIlRTUlOEQlQTFDVkMiO3M6MzoiYWxsIjtzOjE4OiIlRTYlODklODAlRTYlOUMlODkiO3M6NDoicGFzdCI7czoxODoiJUU4JUJGJTg3JUU1JThFJUJCIjtzOjg6InVwY29taW5nIjtzOjM2OiIlRTUlOEQlQjMlRTUlQjAlODYlRTUlODglQjAlRTYlOUQlQTUiO3M6MTc6Im5vX2RhdGFfYXZhaWxhYmxlIjtzOjU0OiIlRTYlQjIlQTElRTYlOUMlODklRTUlOEYlQUYlRTclOTQlQTglRTYlOTUlQjAlRTYlOEQlQUUiO3M6OToiY29uZmlybWVkIjtzOjE4OiIlRTclQTElQUUlRTglQUUlQTQiO3M6ODoicmVqZWN0ZWQiO3M6Mjc6IiVFOCVBMiVBQiVFNiU4QiU5MiVFNyVCQiU5RCI7czo3OiJwZW5kaW5nIjtzOjE4OiIlRTYlOUMlODklRTUlQkUlODUiO3M6OToiY2FuY2VsbGVkIjtzOjE4OiIlRTUlOEYlOTYlRTYlQjYlODgiO3M6MTA6InJlc2NoZWR1bGUiO3M6MTg6IiVFNiU5NCVCOSVFNiU5QyU5RiI7czo3OiJub19zaG93IjtzOjM2OiIlRTYlQjIlQTElRTYlOUMlODklRTUlODclQkElRTclOEUlQjAiO3M6NzoiZGV0YWlscyI7czoxODoiJUU3JUJCJTg2JUU4JThBJTgyIjtzOjE3OiJsb2FkaW5nX21vcmVfZGF0YSI7czo1NDoiJUU1JThBJUEwJUU4JUJEJUJEJUU2JTlCJUI0JUU1JUE0JTlBJUU2JTk1JUIwJUU2JThEJUFFIjtzOjk6ImRhc2hib2FyZCI7czoyNzoiJUU0JUJCJUFBJUU4JUExJUE4JUU2JTlEJUJGIjtzOjU6InByaWNlIjtzOjE4OiIlRTQlQkIlQjclRTklOTIlQjEiO3M6ODoib3JkZXJfaWQiO3M6MjA6IiVFOCVBRSVBMiVFNSU4RCU5NUlEIjtzOjQ6InVuaXQiO3M6MTg6IiVFNSU4RCU5NSVFNSU4NSU4MyI7czo2OiJhZGRfb24iO3M6Mjc6IiVFNiVCNyVCQiVFNSU4QSVBMCVFNSU5QyVBOCI7czo2OiJtZXRob2QiO3M6MTg6IiVFNiU5NiVCOSVFNiVCMyU5NSI7czoxMjoicGF5bWVudF90eXBlIjtzOjM2OiIlRTYlOTQlQUYlRTQlQkIlOTglRTYlOTYlQjklRTUlQkMlOEYiO3M6MTQ6ImJvb2tpbmdfc3RhdHVzIjtzOjM2OiIlRTklQTIlODQlRTglQUUlQTIlRTclOEElQjYlRTYlODAlODEiO3M6MzA6ImFwcG9pbnRtZW50X21hcmtlZF9hc19ub19zaG93biI7czo3MjoiJUU0JUJCJUJCJUU1JTkxJUJEJUU2JUEwJTg3JUU4JUFFJUIwJUU0JUI4JUJBJUU2JTlDJUFBJUU2JTk4JUJFJUU3JUE0JUJBIjtzOjI5OiJjYW5jZWxsZWRfYnlfc2VydmljZV9wcm92aWRlciI7czo3MjoiJUU3JTk0JUIxJUU2JTlDJThEJUU1JThBJUExJUU2JThGJTkwJUU0JUJFJTlCJUU1JTk1JTg2JUU1JThGJTk2JUU2JUI2JTg4IjtzOjIxOiJjYW5jZWxsZWRfYnlfY3VzdG9tZXIiO3M6MzY6IiVFNSVBRSVBMiVFNiU4OCVCNyVFNSU4RiU5NiVFNiVCNiU4OCI7czoxMDoic3RhcnRfZGF0ZSI7czozNjoiJUU1JUJDJTgwJUU1JUE3JThCJUU2JTk3JUE1JUU2JTlDJTlGIjtzOjEwOiJzdGFydF90aW1lIjtzOjM2OiIlRTUlQkMlODAlRTUlQTclOEIlRTYlOTclQjYlRTklOTclQjQiO3M6MjA6InBheW1lbnRfdHJhbnNhY3Rpb25zIjtzOjM2OiIlRTQlQkIlOTglRTYlQUMlQkUlRTQlQkElQTQlRTYlOTglOTMiO3M6MTA6Im15X2FjY291bnQiO3M6MzY6IiVFNiU4OCU5MSVFNyU5QSU4NCVFNSVCOCU5MCVFNiU4OCVCNyI7czo0OiJuYW1lIjtzOjE4OiIlRTUlOTAlOEQlRTclQTclQjAiO3M6NjoidXBkYXRlIjtzOjE4OiIlRTYlOUIlQjQlRTYlOTYlQjAiO3M6ODoiY3VzdG9tZXIiO3M6MTg6IiVFOSVBMSVCRSVFNSVBRSVBMiI7czo1OiJzdGFmZiI7czoxODoiJUU1JTkxJTk4JUU1JUI3JUE1IjtzOjIwOiJzY2hlZHVsZV9hcHBvaW50bWVudCI7czozNjoiJUU1JUFFJTg5JUU2JThFJTkyJUU0JUJDJTlBJUU5JTlEJUEyIjtzOjEwOiJjb250YWN0X3VzIjtzOjM2OiIlRTglODElOTQlRTclQjMlQkIlRTYlODglOTElRTQlQkIlQUMiO3M6ODoiZmVlZGJhY2siO3M6MTg6IiVFNSU4RiU4RCVFOSVBNiU4OCI7czo2OiJsb2dvdXQiO3M6MTg6IiVFNyU5OSVCQiVFNSU4NyVCQSI7czoxNDoiZW50ZXJfZmVlZGJhY2siO3M6MzY6IiVFOCVCRSU5MyVFNSU4NSVBNSVFNSU4RiU4RCVFOSVBNiU4OCI7czoxNjoiZmV0Y2hpbmdfbWV0aG9kcyI7czozNjoiJUU4JThFJUI3JUU1JThGJTk2JUU2JTk2JUI5JUU2JUIzJTk1IjtzOjM2OiJ0aGFua195b3VfZm9yX3lvdXJfdmFsdWFibGVfZmVlZGJhY2siO3M6NzI6IiVFNiU4NCU5RiVFOCVCMCVBMiVFNiU4MiVBOCVFNyU5QSU4NCVFNSVBRSU5RCVFOCVCNCVCNSVFNiU4NCU4RiVFOCVBNyU4MSI7czoyNToidW5hYmxlX3RvX3N1Ym1pdF9mZWVkYmFjayI7czo1NDoiJUU2JTk3JUEwJUU2JUIzJTk1JUU2JThGJTkwJUU0JUJBJUE0JUU1JThGJThEJUU5JUE2JTg4IjtzOjIxOiJwbGVhc2VfZW50ZXJfZmVlZGJhY2siO3M6NDU6IiVFOCVBRiVCNyVFOCVCRSU5MyVFNSU4NSVBNSVFNSU4RiU4RCVFOSVBNiU4OCI7czoxMzoibm90aWZpY2F0aW9ucyI7czoxODoiJUU5JTgwJTlBJUU3JTlGJUE1IjtzOjE5OiJuZXdfYm9va2luZ19zdWNjZXNzIjtzOjU0OiIlRTYlOTYlQjAlRTclOUElODQlRTklQTIlODQlRTglQUUlQTIlRTYlODglOTAlRTUlOEElOUYiO3M6MjA6ImFjdGl2aXR5X3Jlc2NoZWR1bGVkIjtzOjYzOiIlRTYlQjQlQkIlRTUlOEElQTglRTUlQjclQjIlRTklODclOEQlRTYlOTYlQjAlRTUlQUUlODklRTYlOEUlOTIiO3M6MTc6Im5vX3NlcnZpY2VzX2ZvdW5kIjtzOjQ1OiIlRTYlODklQkUlRTQlQjglOEQlRTUlODglQjAlRTYlOUMlOEQlRTUlOEElQTEiO3M6MTY6ImFwaV9rZXlfbWlzbWF0Y2giO3M6NDg6IkFQSSVFNSVBRiU4NiVFOSU5MiVBNSVFNCVCOCU4RCVFNSU4QyVCOSVFOSU4NSU4RCI7czoyMToicG9zdGFsX2NvZGVfbm90X2ZvdW5kIjtzOjYzOiIlRTYlODklQkUlRTQlQjglOEQlRTUlODglQjAlRTklODIlQUUlRTYlOTQlQkYlRTclQkMlOTYlRTclQTAlODEiO3M6MTc6InBvc3RhbF9jb2RlX2ZvdW5kIjtzOjU0OiIlRTYlODklQkUlRTUlODglQjAlRTklODIlQUUlRTYlOTQlQkYlRTclQkMlOTYlRTclQTAlODEiO3M6Mjg6ImV4dHJhX3NlcnZpY2VzX25vdF9hdmFpbGFibGUiO3M6NjM6IiVFOSVBMiU5RCVFNSVBNCU5NiVFNiU5QyU4RCVFNSU4QSVBMSVFNCVCOCU4RCVFNSU4RiVBRiVFNyU5NCVBOCI7czoxODoibm9fdW5pdHNfYXZhaWxhYmxlIjtzOjM2OiIlRTYlQjIlQTElRTYlOUMlODklRTUlOEQlOTUlRTQlQkQlOEQiO3M6Mjg6Im5vX2ZyZXF1ZW50bHlfZGlzY291bnRfZm91bmQiO3M6NzI6IiVFNiVCMiVBMSVFNiU5QyU4OSVFNyVCQiU4RiVFNSVCOCVCOCVFNiU4OSVCRSVFNSU4OCVCMCVFNiU4QSU5OCVFNiU4OSVBMyI7czozNToiaW5jb3JyZWN0X2VtYWlsX2FkZHJlc3Nfb3JfcGFzc3dvcmQiO3M6MTA4OiIlRTclOTQlQjUlRTUlQUQlOTAlRTklODIlQUUlRTQlQkIlQjYlRTUlOUMlQjAlRTUlOUQlODAlRTYlODglOTYlRTUlQUYlODYlRTclQTAlODElRTQlQjglOEQlRTYlQUQlQTMlRTclQTElQUUiO3M6MjE6Im5vX2FwcG9pbnRtZW50c19mb3VuZCI7czo1NDoiJUU2JUIyJUExJUU2JTlDJTg5JUU2JTg5JUJFJUU1JTg4JUIwJUU3JUJBJUE2JUU0JUJDJTlBIjtzOjQxOiJ5b3VyX2FwcG9pbnRtZW50X3Jlc2NoZWR1bGVkX3N1Y2Nlc3NmdWxseSI7czo5OToiJUU2JTgyJUE4JUU3JTlBJTg0JUU5JUEyJTg0JUU3JUJBJUE2JUU1JUI3JUIyJUU2JTg4JTkwJUU1JThBJTlGJUU5JTg3JThEJUU2JTk2JUIwJUU1JUFFJTg5JUU2JThFJTkyIjtzOjI2OiJzb3JyeV93ZV9hcmVfbm90X2F2YWlsYWJsZSI7czo4MToiJUU1JUFGJUI5JUU0JUI4JThEJUU4JUI1JUI3JUVGJUJDJThDJUU2JTg4JTkxJUU0JUJCJUFDJUU0JUI4JThEJUU1JTlDJUE4JUUzJTgwJTgyIjtzOjM5OiJ5b3VyX2FwcG9pbnRtZW50X2NhbmNlbGxlZF9zdWNjZXNzZnVsbHkiO3M6ODE6IiVFNiU4MiVBOCVFNyU5QSU4NCVFNyVCQSVBNiVFNCVCQyU5QSVFNSVCNyVCMiVFNiU4OCU5MCVFNSU4QSU5RiVFNSU4RiU5NiVFNiVCNiU4OCI7czoxOToiY291cG9uX2NvZGVfZXhwaXJlZCI7czo3MjoiJUU0JUJDJTk4JUU2JTgzJUEwJUU1JTg4JUI4JUU0JUJCJUEzJUU3JUEwJTgxJUU1JUI3JUIyJUU4JUJGJTg3JUU2JTlDJTlGIjtzOjE5OiJpbnZhbGlkX2NvdXBvbl9jb2RlIjtzOjYzOiIlRTQlQkMlOTglRTYlODMlQTAlRTUlODglQjglRTQlQkIlQTMlRTclQTAlODElRTYlOTclQTAlRTYlOTUlODgiO3M6Mjc6InBhcnRpYWxfZGVwb3NpdF9pc19kaXNhYmxlZCI7czo2MzoiJUU5JTgzJUE4JUU1JTg4JTg2JUU1JUFEJTk4JUU2JUFDJUJFJUU4JUEyJUFCJUU3JUE2JTgxJUU3JTk0JUE4IjtzOjU0OiJub25lX29mX3RpbWVfc2xvdF9hdmFpbGFibGVfcGxlYXNlX2NoZWNrX2Fub3RoZXJfZGF0ZXMiO3M6MTI2OiIlRTYlQjIlQTElRTYlOUMlODklRTUlOEYlQUYlRTclOTQlQTglRTclOUElODQlRTYlOTclQjYlRTYlQUUlQjUlRTglQUYlQjclRTYlOUYlQTUlRTclOUMlOEIlRTUlODUlQjYlRTQlQkIlOTYlRTYlOTclQTUlRTYlOUMlOUYiO3M6NDY6ImF2YWlsYWJpbGl0eV9pc19ub3RfY29uZmlndXJlZF9mcm9tX2FkbWluX3NpZGUiO3M6OTA6IiVFNyVBRSVBMSVFNyU5MCU4NiVFNSU5MSU5OCVFNyVBQiVBRiVFNiU5QyVBQSVFOSU4NSU4RCVFNyVCRCVBRSVFNSU4RiVBRiVFNyU5NCVBOCVFNiU4MCVBNyI7czoyOToiY3VzdG9tZXJfY3JlYXRlZF9zdWNjZXNzZnVsbHkiO3M6NTQ6IiVFNSVBRSVBMiVFNiU4OCVCNyVFNSU4OCU5QiVFNSVCQiVCQSVFNiU4OCU5MCVFNSU4QSU5RiI7czozMToiZXJyb3Jfb2NjdXJyZWRfcGxlYXNlX3RyeV9hZ2FpbiI7czo4MToiJUU1JThGJTkxJUU3JTk0JTlGJUU5JTk0JTk5JUU4JUFGJUFGJUU4JUFGJUI3JUU1JTg2JThEJUU4JUFGJTk1JUU0JUI4JTgwJUU2JUFDJUExIjtzOjMxOiJhcHBvaW50bWVudF9ib29rZWRfc3VjY2Vzc2Z1bGx5IjtzOjU0OiIlRTklQTIlODQlRTclQkElQTYlRTYlODglOTAlRTUlOEElOUYlRTklQTIlODQlRTclQkElQTYiO3M6MjQ6InVzZXJfZGV0YWlsc19ub3RfdXBkYXRlZCI7czo4MToiJUU3JTk0JUE4JUU2JTg4JUI3JUU4JUFGJUE2JUU3JUJCJTg2JUU0JUJGJUExJUU2JTgxJUFGJUU2JTlDJUFBJUU2JTlCJUI0JUU2JTk2JUIwIjtzOjM2OiJ1c2VyX25vdF9leGlzdF9wbGVhc2VfcmVnaXN0ZXJfZmlyc3QiO3M6ODE6IiVFNyU5NCVBOCVFNiU4OCVCNyVFNCVCOCU4RCVFNSVBRCU5OCVFNSU5QyVBOCVFOCVBRiVCNyVFNSU4NSU4OCVFNiVCMyVBOCVFNSU4NiU4QyI7czoxODoidXNlcl9hbHJlYWR5X2V4aXN0IjtzOjQ1OiIlRTclOTQlQTglRTYlODglQjclRTUlQjclQjIlRTUlQUQlOTglRTUlOUMlQTgiO3M6MTc6ImludmFsaWRfdXNlcl90eXBlIjtzOjU0OiIlRTclOTQlQTglRTYlODglQjclRTclQjElQkIlRTUlOUUlOEIlRTYlOTclQTAlRTYlOTUlODgiO3M6MTQ6Im5vX3N0YWZmX2ZvdW5kIjtzOjYzOiIlRTYlODklQkUlRTQlQjglOEQlRTUlODglQjAlRTUlQjclQTUlRTQlQkQlOUMlRTQlQkElQkElRTUlOTElOTgiO3M6MjA6Im5vX2RldGFpbHNfYXZhaWxhYmxlIjtzOjU0OiIlRTYlQjIlQTElRTYlOUMlODklRTglQUYlQTYlRTclQkIlODYlRTQlQkYlQTElRTYlODElQUYiO3M6MTY6InR5cGVfaXNfbWlzbWF0Y2giO3M6NDU6IiVFNyVCMSVCQiVFNSU5RSU4QiVFNCVCOCU4RCVFNSU4QyVCOSVFOSU4NSU4RCI7czoyMDoidXBkYXRlZF9zdWNjZXNzZnVsbHkiO3M6MzY6IiVFNiU5QiVCNCVFNiU5NiVCMCVFNiU4OCU5MCVFNSU4QSU5RiI7czoyMDoic29tZXRoaW5nX3dlbnRfd3JvbmciO3M6NDU6IiVFNiU5QyU4OSVFNCVCQSU5QiVFNCVCOCU4RCVFNSVBRiVCOSVFNSU4QSVCMiI7czozNjoicGxlYXNlX2NoZWNrX3lvdXJfY29uZmlybWVkX3Bhc3N3b3JkIjtzOjkwOiIlRTglQUYlQjclRTYlQTMlODAlRTYlOUYlQTUlRTYlODIlQTglRTclQTElQUUlRTglQUUlQTQlRTclOUElODQlRTUlQUYlODYlRTclQTAlODElRUYlQkMlODEiO3M6MjM6InlvdXJfcGFzc3dvcmRfbm90X21hdGNoIjtzOjYzOiIlRTYlODIlQTglRTclOUElODQlRTUlQUYlODYlRTclQTAlODElRTQlQjglOEQlRTUlOEMlQjklRTklODUlOEQiO3M6MjQ6Im5vX3VwY29tbWluZ19hcHBvaW50bWVudCI7czo1NDoiJUU2JUIyJUExJUU2JTlDJTg5JUU4JUI1JUI3JUU2JTlEJUE1JUU5JUEyJTg0JUU3JUJBJUE2IjtzOjExOiJlbWFpbF9leGlzdCI7czo1NDoiJUU1JUFEJTk4JUU1JTlDJUE4JUU3JTk0JUI1JUU1JUFEJTkwJUU5JTgyJUFFJUU0JUJCJUI2IjtzOjIwOiJlbWFpbF9kb2VzX25vdF9leGlzdCI7czo2MzoiJUU3JTk0JUI1JUU1JUFEJTkwJUU5JTgyJUFFJUU0JUJCJUI2JUU0JUI4JThEJUU1JUFEJTk4JUU1JTlDJUE4IjtzOjE5OiJpbnZhbGlkX2NyZWRlbnRpYWxzIjtzOjM2OiIlRTclOTQlQjUlRTklODIlQUUlRTUlOEYlOTElRTklODAlODEiO3M6MTA6ImVtYWlsX3NlbmQiO3M6MzY6IiVFNyU5NCVCNSVFOSU4MiVBRSVFNSU4RiU5MSVFOSU4MCU4MSI7czoyMDoiZW1haWxfc2VuZGluZ19mYWlsZWQiO3M6NzI6IiVFNyU5NCVCNSVFNSVBRCU5MCVFOSU4MiVBRSVFNCVCQiVCNiVFNSU4RiU5MSVFOSU4MCU4MSVFNSVBNCVCMSVFOCVCNCVBNSI7czoxNzoibm9fb3JkZXJzX2RldGFpbHMiO3M6NTQ6IiVFNiVCMiVBMSVFNiU5QyU4OSVFOCVBRSVBMiVFNSU4RCU5NSVFOCVBRiVBNiVFNiU4MyU4NSI7czoxMDoibWVzc2FnZV9pcyI7czoyNzoiJUU2JUI2JTg4JUU2JTgxJUFGJUU2JTk4JUFGIjtzOjIwOiJwbGVhc2VfZW5hYmxlX3N0cmlwZSI7czo0NToiJUU4JUFGJUI3JUU1JTkwJUFGJUU3JTk0JUE4JUU2JTlEJUExJUU3JUJBJUI5IjtzOjE1OiJpbnZhbGlkX3JlcXVlc3QiO3M6MzY6IiVFOSU5RCU5RSVFNiVCMyU5NSVFOCVBRiVCNyVFNiVCMSU4MiI7czo5OiJvdHBfbWF0Y2giO3M6MjE6Ik90cCVFNiVBRiU5NCVFOCVCNSU5QiI7czoxMzoib3RwX25vdF9tYXRjaCI7czozMDoiT3RwJUU0JUI4JThEJUU1JThDJUI5JUU5JTg1JThEIjtzOjE4OiJwYXNzd29yZF9pc19jaGFuZ2UiO3M6NTQ6IiVFNSVBRiU4NiVFNyVBMCU4MSVFNiU5OCVBRiVFNSU4RiU5OCVFNSU4QyU5NiVFNyU5QSU4NCI7czoxOToicGFzc3dvcmRfbm90X2NoYW5nZSI7czozNjoiJUU1JUFGJTg2JUU3JUEwJTgxJUU0JUI4JThEJUU1JThGJTk4IjtzOjU2OiJhcmVfeW91X3N1cmVfeW91X3dhbnRfdG9fY2FuY2VsX3RoaXNfYm9va2luZ19hcHBvaW50bWVudCI7czo5OToiJUU2JTgyJUE4JUU3JUExJUFFJUU1JUFFJTlBJUU4JUE2JTgxJUU1JThGJTk2JUU2JUI2JTg4JUU2JUFEJUE0JUU5JUEyJTg0JUU3JUJBJUE2JUU1JTkwJTk3JUVGJUJDJTlGIjtzOjU6ImFsZXJ0IjtzOjE4OiIlRTglQUQlQTYlRTYlOEElQTUiO3M6Mjoibm8iO3M6MTg6IiVFNiVCMiVBMSVFNiU5QyU4OSI7czoxNToidmVyaWZ5X3ppcF9jb2RlIjtzOjU0OiIlRTklQUElOEMlRTglQUYlODElRTklODIlQUUlRTYlOTQlQkYlRTclQkMlOTYlRTclQTAlODEiO3M6MTE6InBvc3RhbF9jb2RlIjtzOjM2OiIlRTklODIlQUUlRTYlOTQlQkYlRTclQkMlOTYlRTclQTAlODEiO3M6MzA6Im5vX21ldGhvZF9mb3Jfc2VsZWN0ZWRfc2VydmljZSI7czo4MToiJUU2JUIyJUExJUU2JTlDJTg5JUU5JTgwJTg5JUU1JUFFJTlBJUU2JTlDJThEJUU1JThBJUExJUU3JTlBJTg0JUU2JTk2JUI5JUU2JUIzJTk1IjtzOjI0OiJwbGVhc2VfZW50ZXJfcG9zdGFsX2NvZGUiO3M6NjM6IiVFOCVBRiVCNyVFOCVCRSU5MyVFNSU4NSVBNSVFOSU4MiVBRSVFNiU5NCVCRiVFNyVCQyU5NiVFNyVBMCU4MSI7czoyOToibm9fYWRkb25zX2Zvcl9zZWxlY3RlZF9tZXRob2QiO3M6NzI6IiVFNiU4OSU4MCVFOSU4MCU4OSVFNiU5NiVCOSVFNiVCMyU5NSVFNiVCMiVBMSVFNiU5QyU4OSVFNiU4RiU5MiVFNCVCQiVCNiI7czoyMzoic2VsZWN0X2F0bGVhc3Rfb25lX3VuaXQiO3M6NzI6IiVFOSU4MCU4OSVFNiU4QiVBOSVFOCU4NyVCMyVFNSVCMCU5MSVFNCVCOCU4MCVFNCVCOCVBQSVFNSU4RCU5NSVFNCVCRCU4RCI7czoxODoic2VsZWN0X2FueV9wYWNrYWdlIjtzOjU0OiIlRTklODAlODklRTYlOEIlQTklRTQlQkIlQkIlRTQlQkQlOTUlRTUlOEMlODUlRTglQTMlQjkiO3M6MTE6InBsZWFzZV93YWl0IjtzOjQ1OiIlRTglQUYlQjclRTglODAlOTAlRTUlQkYlODMlRTclQUQlODklRTUlQkUlODUiO30=' WHERE `language`='zh_CN'";
		mysqli_query($this->conn, $update_app_zh_CN_lang);
		
		$alllang = $this->get_all_languages();
		
		$language_label_arr_check = $this->get_all_labelsbyid("en");
		$en_label_decode_front = $language_label_arr_check["label_data"];
		$en_label_decode_admin = $language_label_arr_check["admin_labels"];
		$en_label_decode_error = $language_label_arr_check["error_labels"];
		$en_label_decode_extra = $language_label_arr_check["extra_labels"];
		$en_label_decode_front_form_error = $language_label_arr_check["front_error_labels"];
		$en_label_decode_app = $language_label_arr_check["app_labels"];
		
		while($all = mysqli_fetch_assoc($alllang)){
			$language_name = $all['language'];
			$language_label_arr = $this->get_all_labelsbyid($all['language']);
			
			$label_data = $language_label_arr['label_data'];
			$admin_labels = $language_label_arr['admin_labels'];
			$error_labels = $language_label_arr['error_labels'];
			$extra_labels = $language_label_arr['extra_labels'];
			$front_error_labels = $language_label_arr['front_error_labels'];
			$app_labels = $language_label_arr['app_labels'];
			
			if($label_data == ""){
				$label_data = $en_label_decode_front;
			}if($admin_labels == ""){
				$admin_labels = $en_label_decode_admin;
			}if($error_labels == ""){
				$error_labels = $en_label_decode_error;
			}if($extra_labels == ""){
				$extra_labels = $en_label_decode_extra;
			}if($front_error_labels == ""){
				$front_error_labels = $en_label_decode_front_form_error;
			}if($app_labels == ""){
				$app_labels = $en_label_decode_app;
			}
			
			$label_decode_front = base64_decode($label_data);
			$label_decode_admin = base64_decode($admin_labels);
			$label_decode_error = base64_decode($error_labels);
			$label_decode_extra = base64_decode($extra_labels);
			$label_decode_front_form_error = base64_decode($front_error_labels);
			$label_decode_app = base64_decode($app_labels);
			
			$label_decode_front_unserial = unserialize($label_decode_front);
			$label_decode_admin_unserial = unserialize($label_decode_admin);
			$label_decode_error_unserial = unserialize($label_decode_error);
			$label_decode_extra_unserial = unserialize($label_decode_extra);
			$label_decode_front_form_error_unserial = unserialize($label_decode_front_form_error);
			$label_decode_app_unserial = unserialize($label_decode_app);
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
			foreach($label_decode_app_unserial as $key => $value){
				$label_decode_app_unserial[$key] = urldecode($value);
			}
			/* Add all labels which you want to add in new version from here */
			/* DEMO FOR ADDING LABEL */
			if($language_name == "de_DE"){
				$label_decode_admin_unserial["app_labels"] = urlencode("App-labels");
				$label_decode_admin_unserial["google_event"] = urlencode("Google Event");
				$label_decode_admin_unserial["event_title"] = urlencode("Titel van het evenement");
				$label_decode_admin_unserial["event_description"] = urlencode("beschrijving van het evenement");
				$label_decode_admin_unserial["event_start_datetime"] = urlencode("Begindatum van het evenement");
				$label_decode_admin_unserial["event_end_datetime"] = urlencode("Gebeurtenis Einddatum Tijd");
				$label_decode_admin_unserial["event_duration"] = urlencode("Duur van het evenement");
				$label_decode_admin_unserial["event_create_datetime"] = urlencode("Evenement Datum tijd creëren");
				$label_decode_admin_unserial["event_updated_datetime"] = urlencode("Evenement bijgewerkte datum tijd");
			}elseif($language_name == "es_ES"){
				$label_decode_admin_unserial["app_labels"] = urlencode("Etiquetas de administrador");
				$label_decode_admin_unserial["google_event"] = urlencode("Evento de Google");
				$label_decode_admin_unserial["event_title"] = urlencode("Título del evento");
				$label_decode_admin_unserial["event_description"] = urlencode("descripción del evento");
				$label_decode_admin_unserial["event_start_datetime"] = urlencode("Fecha de inicio del evento");
				$label_decode_admin_unserial["event_end_datetime"] = urlencode("Fecha de finalización del evento");
				$label_decode_admin_unserial["event_duration"] = urlencode("Duración del evento");
				$label_decode_admin_unserial["event_create_datetime"] = urlencode("Evento crear fecha hora");
				$label_decode_admin_unserial["event_updated_datetime"] = urlencode("Fecha de actualización del evento Hora");
			}elseif($language_name == "fr_FR"){
				$label_decode_admin_unserial["app_labels"] = urlencode("Étiquettes d'application");
				$label_decode_admin_unserial["google_event"] = urlencode("Google Event");
				$label_decode_admin_unserial["event_title"] = urlencode("Titre de l'événement");
				$label_decode_admin_unserial["event_description"] = urlencode("description de l'évenement");
				$label_decode_admin_unserial["event_start_datetime"] = urlencode("Date de début de l'événement");
				$label_decode_admin_unserial["event_end_datetime"] = urlencode("Date de fin de l'événement");
				$label_decode_admin_unserial["event_duration"] = urlencode("Durée de l'événement");
				$label_decode_admin_unserial["event_create_datetime"] = urlencode("Date de création de l'événement");
				$label_decode_admin_unserial["event_updated_datetime"] = urlencode("Date de mise à jour de l'événement");
			}elseif($language_name == "pt_PT"){
				$label_decode_admin_unserial["app_labels"] = urlencode("Etiqueta do aplicativo");
				$label_decode_admin_unserial["google_event"] = urlencode("Google Event");
				$label_decode_admin_unserial["event_title"] = urlencode("Título do evento");
				$label_decode_admin_unserial["event_description"] = urlencode("Descrição do Evento");
				$label_decode_admin_unserial["event_start_datetime"] = urlencode("Data de início do evento");
				$label_decode_admin_unserial["event_end_datetime"] = urlencode("Data de término do evento");
				$label_decode_admin_unserial["event_duration"] = urlencode("Duração do evento");
				$label_decode_admin_unserial["event_create_datetime"] = urlencode("Data de criação do evento");
				$label_decode_admin_unserial["event_updated_datetime"] = urlencode("Hora da data atualizada do evento");
			}elseif($language_name == "ru_RU"){
				$label_decode_admin_unserial["app_labels"] = urlencode("Ярлыки администратора");
				$label_decode_admin_unserial["google_event"] = urlencode("Google Event");
				$label_decode_admin_unserial["event_title"] = urlencode("Название мероприятия");
				$label_decode_admin_unserial["event_description"] = urlencode("Описание события");
				$label_decode_admin_unserial["event_start_datetime"] = urlencode("Дата начала события");
				$label_decode_admin_unserial["event_end_datetime"] = urlencode("Дата окончания события Время");
				$label_decode_admin_unserial["event_duration"] = urlencode("Продолжительность мероприятия");
				$label_decode_admin_unserial["event_create_datetime"] = urlencode("Событие Создать Дата Время");
				$label_decode_admin_unserial["event_updated_datetime"] = urlencode("Событие обновлено Дата Время");
			}elseif($language_name == "ar"){
				$label_decode_admin_unserial["app_labels"] = urlencode("تسميات المسؤول");
				$label_decode_admin_unserial["google_event"] = urlencode("حدث جوجل");
				$label_decode_admin_unserial["event_title"] = urlencode("عنوان الحدث");
				$label_decode_admin_unserial["event_description"] = urlencode("وصف الحدث");
				$label_decode_admin_unserial["event_start_datetime"] = urlencode("تاريخ بدء الحدث");
				$label_decode_admin_unserial["event_end_datetime"] = urlencode("تاريخ انتهاء الحدث");
				$label_decode_admin_unserial["event_duration"] = urlencode("مدة الحدث");
				$label_decode_admin_unserial["event_create_datetime"] = urlencode("حدث إنشاء تاريخ الوقت");
				$label_decode_admin_unserial["event_updated_datetime"] = urlencode("حدث تحديث تاريخ الوقت");
			}elseif($language_name == "zh_CN"){
				$label_decode_admin_unserial["app_labels"] = urlencode("应用标签");
				$label_decode_admin_unserial["google_event"] = urlencode("Google事件");
				$label_decode_admin_unserial["event_title"] = urlencode("活动标题");
				$label_decode_admin_unserial["event_description"] = urlencode("事件描述");
				$label_decode_admin_unserial["event_start_datetime"] = urlencode("事件开始日期时间");
				$label_decode_admin_unserial["event_end_datetime"] = urlencode("事件结束日期时间");
				$label_decode_admin_unserial["event_duration"] = urlencode("活动持续时间");
				$label_decode_admin_unserial["event_create_datetime"] = urlencode("事件创建日期时间");
				$label_decode_admin_unserial["event_updated_datetime"] = urlencode("事件更新日期时间");
			}else{
				$label_decode_admin_unserial["app_labels"] = urlencode("App Labels");
				$label_decode_admin_unserial["google_event"] = urlencode("Google Event");
				$label_decode_admin_unserial["event_title"] = urlencode("Event Title");
				$label_decode_admin_unserial["event_description"] = urlencode("Event Description");
				$label_decode_admin_unserial["event_start_datetime"] = urlencode("Event Start DateTime");
				$label_decode_admin_unserial["event_end_datetime"] = urlencode("Event End DateTime");
				$label_decode_admin_unserial["event_duration"] = urlencode("Event Duration");
				$label_decode_admin_unserial["event_create_datetime"] = urlencode("Event Create DateTime");
				$label_decode_admin_unserial["event_updated_datetime"] = urlencode("Event Updated DateTime");
			}
			
			$language_front_arr = base64_encode(serialize($label_decode_front_unserial));
			$language_admin_arr = base64_encode(serialize($label_decode_admin_unserial));
			$language_error_arr = base64_encode(serialize($label_decode_error_unserial));
			$language_extra_arr = base64_encode(serialize($label_decode_extra_unserial));
			$language_form_error_arr = base64_encode(serialize($label_decode_front_form_error_unserial));
			$language_app_arr = base64_encode(serialize($label_decode_app_unserial));
			
			$update_default_lang = "UPDATE `ct_languages` set `label_data` = '".$language_front_arr."', `admin_labels` = '".$language_admin_arr."', `error_labels` = '".$language_error_arr."', `extra_labels` = '".$language_extra_arr."', `front_error_labels` = '".$language_form_error_arr."', `app_labels` = '".$language_app_arr."' where `language` = '".$all['language']."'";
			mysqli_query($this->conn, $update_default_lang);
		}
	}
	
	public function update6_3(){
		$alllang = $this->get_all_languages();
		
		$language_label_arr_check = $this->get_all_labelsbyid("en");
		$en_label_decode_front = $language_label_arr_check["label_data"];
		$en_label_decode_admin = $language_label_arr_check["admin_labels"];
		$en_label_decode_error = $language_label_arr_check["error_labels"];
		$en_label_decode_extra = $language_label_arr_check["extra_labels"];
		$en_label_decode_front_form_error = $language_label_arr_check["front_error_labels"];
		$en_label_decode_app = $language_label_arr_check["app_labels"];
		
		while($all = mysqli_fetch_assoc($alllang)){
			$language_name = $all['language'];
			$language_label_arr = $this->get_all_labelsbyid($all['language']);
			
			$label_data = $language_label_arr['label_data'];
			$admin_labels = $language_label_arr['admin_labels'];
			$error_labels = $language_label_arr['error_labels'];
			$extra_labels = $language_label_arr['extra_labels'];
			$front_error_labels = $language_label_arr['front_error_labels'];
			$app_labels = $language_label_arr['app_labels'];
			
			if($label_data == ""){
				$label_data = $en_label_decode_front;
			}if($admin_labels == ""){
				$admin_labels = $en_label_decode_admin;
			}if($error_labels == ""){
				$error_labels = $en_label_decode_error;
			}if($extra_labels == ""){
				$extra_labels = $en_label_decode_extra;
			}if($front_error_labels == ""){
				$front_error_labels = $en_label_decode_front_form_error;
			}if($app_labels == ""){
				$app_labels = $en_label_decode_app;
			}
			
			$label_decode_front = base64_decode($label_data);
			$label_decode_admin = base64_decode($admin_labels);
			$label_decode_error = base64_decode($error_labels);
			$label_decode_extra = base64_decode($extra_labels);
			$label_decode_front_form_error = base64_decode($front_error_labels);
			$label_decode_app = base64_decode($app_labels);
			
			$label_decode_front_unserial = unserialize($label_decode_front);
			$label_decode_admin_unserial = unserialize($label_decode_admin);
			$label_decode_error_unserial = unserialize($label_decode_error);
			$label_decode_extra_unserial = unserialize($label_decode_extra);
			$label_decode_front_form_error_unserial = unserialize($label_decode_front_form_error);
			$label_decode_app_unserial = unserialize($label_decode_app);
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
			foreach($label_decode_app_unserial as $key => $value){
				$label_decode_app_unserial[$key] = urldecode($value);
			}
			/* Add all labels which you want to add in new version from here */
			/* DEMO FOR ADDING LABEL */
			if($language_name == "de_DE"){
				$label_decode_app_unserial["yes"] = urlencode("Ja");
				$label_decode_app_unserial["details_not_found"] = urlencode("Details niet gevonden");
				$label_decode_app_unserial["call_us"] = urlencode("Bel ons");
				$label_decode_app_unserial["email_us"] = urlencode("Email ons");
				$label_decode_app_unserial["reach_us"] = urlencode("Bereik ons");
				$label_decode_app_unserial["complete"] = urlencode("Compleet");
				$label_decode_app_unserial["pay_at_venue"] = urlencode("Betaal ter plaatse");
				$label_decode_app_unserial["otp_sent_to_email"] = urlencode("OTP verzonden naar e-mail");
				$label_decode_app_unserial["otp_not_sent"] = urlencode("OTP niet verzonden");
				$label_decode_app_unserial["please_enter_email"] = urlencode("Voer alstublieft e-mailadres in");
				$label_decode_app_unserial["incorrect_otp"] = urlencode("Onjuiste OTP");
				$label_decode_app_unserial["please_enter_otp"] = urlencode("Voer alstublieft OTP in");
				$label_decode_app_unserial["unable_to_update_password"] = urlencode("Kan wachtwoord niet bijwerken");
				$label_decode_app_unserial["please_fill_password_fields"] = urlencode("Vul alstublieft de wachtwoordvelden in");
				$label_decode_app_unserial["account_created_successfully"] = urlencode("Account is succesvol aangemaakt");
				$label_decode_app_unserial["email_already_exists"] = urlencode("E-mail bestaat al");
				$label_decode_app_unserial["customer_already_exist"] = urlencode("Klant bestaat al");
			}elseif($language_name == "es_ES"){
				$label_decode_app_unserial["yes"] = urlencode("Sí");
				$label_decode_app_unserial["details_not_found"] = urlencode("Detalles no encontrados");
				$label_decode_app_unserial["call_us"] = urlencode("Llamanos");
				$label_decode_app_unserial["email_us"] = urlencode("Envíenos un correo electrónico");
				$label_decode_app_unserial["reach_us"] = urlencode("Llegar a nosotros");
				$label_decode_app_unserial["complete"] = urlencode("Completar");
				$label_decode_app_unserial["pay_at_venue"] = urlencode("Pagar en el lugar");
				$label_decode_app_unserial["otp_sent_to_email"] = urlencode("OTP enviado al correo electrónico");
				$label_decode_app_unserial["otp_not_sent"] = urlencode("OTP no enviado");
				$label_decode_app_unserial["please_enter_email"] = urlencode("Por favor ingrese su email");
				$label_decode_app_unserial["incorrect_otp"] = urlencode("OTP incorrecta");
				$label_decode_app_unserial["please_enter_otp"] = urlencode("Por favor ingrese OTP");
				$label_decode_app_unserial["unable_to_update_password"] = urlencode("No se puede actualizar la contraseña");
				$label_decode_app_unserial["please_fill_password_fields"] = urlencode("Por favor, rellene los campos de contraseña");
				$label_decode_app_unserial["account_created_successfully"] = urlencode("Cuenta creada exitosamente");
				$label_decode_app_unserial["email_already_exists"] = urlencode("el Email ya existe");
				$label_decode_app_unserial["customer_already_exist"] = urlencode("El cliente ya existe");
			}elseif($language_name == "fr_FR"){
				$label_decode_app_unserial["yes"] = urlencode("Oui");
				$label_decode_app_unserial["details_not_found"] = urlencode("Détails non trouvés");
				$label_decode_app_unserial["call_us"] = urlencode("Appelez nous");
				$label_decode_app_unserial["email_us"] = urlencode("Envoyez-nous un email");
				$label_decode_app_unserial["reach_us"] = urlencode("Rejoins-nous");
				$label_decode_app_unserial["complete"] = urlencode("Achevée");
				$label_decode_app_unserial["pay_at_venue"] = urlencode("Payer sur place");
				$label_decode_app_unserial["otp_sent_to_email"] = urlencode("OTP envoyé à l'email");
				$label_decode_app_unserial["otp_not_sent"] = urlencode("OTP non envoyé");
				$label_decode_app_unserial["please_enter_email"] = urlencode("S'il vous plaît entrer email");
				$label_decode_app_unserial["incorrect_otp"] = urlencode("OTP incorrect");
				$label_decode_app_unserial["please_enter_otp"] = urlencode("S'il vous plaît entrer OTP");
				$label_decode_app_unserial["unable_to_update_password"] = urlencode("Impossible de mettre à jour le mot de passe");
				$label_decode_app_unserial["please_fill_password_fields"] = urlencode("Veuillez remplir les champs de mot de passe");
				$label_decode_app_unserial["account_created_successfully"] = urlencode("Compte créé avec succès");
				$label_decode_app_unserial["email_already_exists"] = urlencode("l'email existe déjà");
				$label_decode_app_unserial["customer_already_exist"] = urlencode("Le client existe déjà");
			}elseif($language_name == "pt_PT"){
				$label_decode_app_unserial["yes"] = urlencode("sim");
				$label_decode_app_unserial["details_not_found"] = urlencode("Detalhes não encontrados");
				$label_decode_app_unserial["call_us"] = urlencode("Ligue para nós");
				$label_decode_app_unserial["email_us"] = urlencode("Envia-nos um email");
				$label_decode_app_unserial["reach_us"] = urlencode("Nos alcance");
				$label_decode_app_unserial["complete"] = urlencode("Completa");
				$label_decode_app_unserial["pay_at_venue"] = urlencode("Pague no local");
				$label_decode_app_unserial["otp_sent_to_email"] = urlencode("OTP enviado para email");
				$label_decode_app_unserial["otp_not_sent"] = urlencode("OTP não enviado");
				$label_decode_app_unserial["please_enter_email"] = urlencode("Por favor insira o email");
				$label_decode_app_unserial["incorrect_otp"] = urlencode("OTP incorreto");
				$label_decode_app_unserial["please_enter_otp"] = urlencode("Por favor digite OTP");
				$label_decode_app_unserial["unable_to_update_password"] = urlencode("Não é possível atualizar a senha");
				$label_decode_app_unserial["please_fill_password_fields"] = urlencode("Por favor, preencha os campos de senha");
				$label_decode_app_unserial["account_created_successfully"] = urlencode("Conta criada com sucesso");
				$label_decode_app_unserial["email_already_exists"] = urlencode("e-mail já existe");
				$label_decode_app_unserial["customer_already_exist"] = urlencode("Cliente já existe");
			}elseif($language_name == "ru_RU"){
				$label_decode_app_unserial["yes"] = urlencode("да");
				$label_decode_app_unserial["details_not_found"] = urlencode("Детали не найдены");
				$label_decode_app_unserial["call_us"] = urlencode("Позвоните нам");
				$label_decode_app_unserial["email_us"] = urlencode("Свяжитесь с нами по электронной почте");
				$label_decode_app_unserial["reach_us"] = urlencode("Связаться с нами");
				$label_decode_app_unserial["complete"] = urlencode("полный");
				$label_decode_app_unserial["pay_at_venue"] = urlencode("Оплата на месте");
				$label_decode_app_unserial["otp_sent_to_email"] = urlencode("ОТП отправлено на почту");
				$label_decode_app_unserial["otp_not_sent"] = urlencode("ОТП не отправлено");
				$label_decode_app_unserial["please_enter_email"] = urlencode("Пожалуйста, введите адрес электронной почты");
				$label_decode_app_unserial["incorrect_otp"] = urlencode("Неверный OTP");
				$label_decode_app_unserial["please_enter_otp"] = urlencode("Пожалуйста, введите OTP");
				$label_decode_app_unserial["unable_to_update_password"] = urlencode("Невозможно обновить пароль");
				$label_decode_app_unserial["please_fill_password_fields"] = urlencode("Пожалуйста, заполните поля пароля");
				$label_decode_app_unserial["account_created_successfully"] = urlencode("Аккаунт успешно создан");
				$label_decode_app_unserial["email_already_exists"] = urlencode("адрес электронной почты уже существует");
				$label_decode_app_unserial["customer_already_exist"] = urlencode("Клиент уже существует");
			}elseif($language_name == "ar"){
				$label_decode_app_unserial["yes"] = urlencode("نعم فعلا");
				$label_decode_app_unserial["details_not_found"] = urlencode("التفاصيل غير موجودة");
				$label_decode_app_unserial["call_us"] = urlencode("اتصل بنا");
				$label_decode_app_unserial["email_us"] = urlencode("مراسلتنا عبر البريد الإلكتروني");
				$label_decode_app_unserial["reach_us"] = urlencode("الوصول إلينا");
				$label_decode_app_unserial["complete"] = urlencode("اكتمال");
				$label_decode_app_unserial["pay_at_venue"] = urlencode("الدفع في المكان");
				$label_decode_app_unserial["otp_sent_to_email"] = urlencode("إرسال OTP إلى البريد الإلكتروني");
				$label_decode_app_unserial["otp_not_sent"] = urlencode("لم ترسل OTP");
				$label_decode_app_unserial["please_enter_email"] = urlencode("الرجاء إدخال البريد الإلكتروني");
				$label_decode_app_unserial["incorrect_otp"] = urlencode("مكتب المدعي العام غير صحيح");
				$label_decode_app_unserial["please_enter_otp"] = urlencode("يرجى إدخال OTP");
				$label_decode_app_unserial["unable_to_update_password"] = urlencode("غير قادر على تحديث كلمة المرور");
				$label_decode_app_unserial["please_fill_password_fields"] = urlencode("يرجى ملء حقول كلمة المرور");
				$label_decode_app_unserial["account_created_successfully"] = urlencode("الحساب اقيم بنجاح");
				$label_decode_app_unserial["email_already_exists"] = urlencode("البريد الالكتروني موجود بالفعل");
				$label_decode_app_unserial["customer_already_exist"] = urlencode("العميل موجود بالفعل");
			}elseif($language_name == "zh_CN"){
				$label_decode_app_unserial["yes"] = urlencode("是");
				$label_decode_app_unserial["details_not_found"] = urlencode("未找到详细信息");
				$label_decode_app_unserial["call_us"] = urlencode("打电话给我们");
				$label_decode_app_unserial["email_us"] = urlencode("电邮我们");
				$label_decode_app_unserial["reach_us"] = urlencode("联系我们");
				$label_decode_app_unserial["complete"] = urlencode("完成");
				$label_decode_app_unserial["pay_at_venue"] = urlencode("在地点付款");
				$label_decode_app_unserial["otp_sent_to_email"] = urlencode("OTP发送到电子邮件");
				$label_decode_app_unserial["otp_not_sent"] = urlencode("OTP没有发送");
				$label_decode_app_unserial["please_enter_email"] = urlencode("请输入电子邮件");
				$label_decode_app_unserial["incorrect_otp"] = urlencode("OTP不正确");
				$label_decode_app_unserial["please_enter_otp"] = urlencode("请输入OTP");
				$label_decode_app_unserial["unable_to_update_password"] = urlencode("无法更新密码");
				$label_decode_app_unserial["please_fill_password_fields"] = urlencode("请填写密码字段");
				$label_decode_app_unserial["account_created_successfully"] = urlencode("帐户创建成功");
				$label_decode_app_unserial["email_already_exists"] = urlencode("电子邮件已经存在");
				$label_decode_app_unserial["customer_already_exist"] = urlencode("客户已存在");
			}else{
				$label_decode_app_unserial["yes"] = urlencode("Yes");
				$label_decode_app_unserial["details_not_found"] = urlencode("Details not found");
				$label_decode_app_unserial["call_us"] = urlencode("Call us");
				$label_decode_app_unserial["email_us"] = urlencode("Email us");
				$label_decode_app_unserial["reach_us"] = urlencode("Reach us");
				$label_decode_app_unserial["complete"] = urlencode("Complete");
				$label_decode_app_unserial["pay_at_venue"] = urlencode("Pay At Venue");
				$label_decode_app_unserial["otp_sent_to_email"] = urlencode("OTP sent to email");
				$label_decode_app_unserial["otp_not_sent"] = urlencode("OTP not sent");
				$label_decode_app_unserial["please_enter_email"] = urlencode("Please enter email");
				$label_decode_app_unserial["incorrect_otp"] = urlencode("Incorrect OTP");
				$label_decode_app_unserial["please_enter_otp"] = urlencode("Please enter OTP");
				$label_decode_app_unserial["unable_to_update_password"] = urlencode("Unable to update password");
				$label_decode_app_unserial["please_fill_password_fields"] = urlencode("Please fill password fields");
				$label_decode_app_unserial["account_created_successfully"] = urlencode("Account created successfully");
				$label_decode_app_unserial["email_already_exists"] = urlencode("Email already exists");
				$label_decode_app_unserial["customer_already_exist"] = urlencode("Customer already exist");
			}
			
			$language_front_arr = base64_encode(serialize($label_decode_front_unserial));
			$language_admin_arr = base64_encode(serialize($label_decode_admin_unserial));
			$language_error_arr = base64_encode(serialize($label_decode_error_unserial));
			$language_extra_arr = base64_encode(serialize($label_decode_extra_unserial));
			$language_form_error_arr = base64_encode(serialize($label_decode_front_form_error_unserial));
			$language_app_arr = base64_encode(serialize($label_decode_app_unserial));
			
			$update_default_lang = "UPDATE `ct_languages` set `label_data` = '".$language_front_arr."', `admin_labels` = '".$language_admin_arr."', `error_labels` = '".$language_error_arr."', `extra_labels` = '".$language_extra_arr."', `front_error_labels` = '".$language_form_error_arr."', `app_labels` = '".$language_app_arr."' where `language` = '".$all['language']."'";
			mysqli_query($this->conn, $update_default_lang);
		}
	}
	
	public function update5_3(){
		$this->insert_option('ct_sms_twilio_send_sms_to_staff_status','N');
		$this->insert_option('ct_sms_plivo_send_sms_to_staff_status','N');
		$this->insert_option('ct_sms_nexmo_send_sms_to_staff_status','N');
		$this->insert_option('ct_sms_textlocal_send_sms_to_staff_status','N');
		
		$query = "ALTER TABLE `ct_sms_templates` CHANGE `sms_template_type` `sms_template_type` ENUM('A','C','R','CC','RS','RM','CS') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'A=active, C=confirm, R=Reject, CC=Cancel by Client,CS=Cancel by Staff, RS=Reschedule, RM=Reminder';";
		mysqli_query($this->conn, $query);
		
		$query = "ALTER TABLE `ct_sms_templates` CHANGE `user_type` `user_type` ENUM('A','C','S') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'A=Admin,C=client,S=Staff';";
		mysqli_query($this->conn, $query);
		
		mysqli_query($this->conn, "INSERT INTO `ct_sms_templates` (`id`, `sms_subject`, `sms_message`, `default_message`, `sms_template_status`, `sms_template_type`, `user_type`) VALUES
		(NULL, 'New Appointment Request Requires Approval', '', 'RGVhciB7e3N0YWZmX25hbWV9fSwKWW91IGhhdmUgYW4gYXBwb2ludG1lbnQgb24ge3tib29raW5nX2RhdGV9fSBmb3Ige3tzZXJ2aWNlX25hbWV9fQ===', 'E', 'A', 'S'),
		(NULL, 'Appointment Approved', '', 'RGVhciB7e3N0YWZmX25hbWV9fSwKWW91ciBhcHBvaW50bWVudCB3aXRoIHt7Y2xpZW50X25hbWV9fSBvbiB7e2Jvb2tpbmdfZGF0ZX19IGZvciB7e3NlcnZpY2VfbmFtZX19IGhhcyBiZWVuIGNvbmZpcm1lZC4=', 'E', 'C', 'S'),
		(NULL, 'Appointment Rejected', '', 'RGVhciB7e3N0YWZmX25hbWV9fSwKWW91ciBhcHBvaW50bWVudCB3aXRoIHt7Y2xpZW50X25hbWV9fSBvbiB7e2Jvb2tpbmdfZGF0ZX19IGZvciB7e3NlcnZpY2VfbmFtZX19IGhhcyBiZWVuIHJlamVjdGVkLg==', 'E', 'R', 'S'),
		(NULL, 'Appointment Cancelled By Customer', '', 'RGVhciB7e3N0YWZmX25hbWV9fSwKWW91ciBhcHBvaW50bWVudCB3aXRoIHt7Y2xpZW50X25hbWV9fSBvbiB7e2Jvb2tpbmdfZGF0ZX19IGZvciB7e3NlcnZpY2VfbmFtZX19IGhhcyBiZWVuIGNhbmNlbGxlZC4=', 'E', 'CC', 'S'),
		(NULL, 'Appointment Rescheduled By Staff', '', 'RGVhciB7e3N0YWZmX25hbWV9fSwKWW91ciBhcHBvaW50bWVudCB3aXRoIHt7Y2xpZW50X25hbWV9fSBvbiB7e2Jvb2tpbmdfZGF0ZX19IGZvciB7e3NlcnZpY2VfbmFtZX19IGhhcyBiZWVuIHJlc2NoZWR1bGVkLg==', 'E', 'RS', 'S'),
		(NULL, 'Staff Appointment Reminder', '', 'RGVhciB7e3N0YWZmX25hbWV9fSwKWW91ciBhcHBvaW50bWVudCB3aXRoIHt7Y2xpZW50X25hbWV9fSBpcyBzY2hlZHVsZWQgaW4ge3thcHBfcmVtYWluX3RpbWV9fSBob3Vycy4=', 'E', 'RM', 'S');");
		
		/* A Staff Email Templet Update */
		$query = "UPDATE `ct_email_templates` SET `default_message`='PGh0bWw+DQo8aGVhZD4NCgk8bWV0YSBuYW1lPSJ2aWV3cG9ydCIgY29udGVudD0id2lkdGg9ZGV2aWNlLXdpZHRoLCBpbml0aWFsLXNjYWxlPTEuMCIvPg0KCTxtZXRhIGh0dHAtZXF1aXY9IkNvbnRlbnQtVHlwZSIgY29udGVudD0idGV4dC9odG1sOyBjaGFyc2V0PVVURi04IiAvPg0KCTx0aXRsZT5TdWJqZWN0OiB7e3NlcnZpY2VfbmFtZX19IG9uIHt7Ym9va2luZ19kYXRlfX08L3RpdGxlPg0KCTxsaW5rIGhyZWY9Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1Nb250c2VycmF0IiByZWw9InN0eWxlc2hlZXQiPg0KPC9oZWFkPg0KPGJvZHk+CQkNCgk8ZGl2IHN0eWxlPSJtYXJnaW46IDA7cGFkZGluZzogMDtmb250LWZhbWlseTogSGVsdmV0aWNhIE5ldWUsIEhlbHZldGljYSwgSGVsdmV0aWNhLCBBcmlhbCwgc2Fucy1zZXJpZjtmb250LXNpemU6IDEwMCU7bGluZS1oZWlnaHQ6IDEuNjtib3gtc2l6aW5nOiBib3JkZXItYm94OyI+CQ0KCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O21heC13aWR0aDogNjAwcHggIWltcG9ydGFudDttYXJnaW46IDAgYXV0byAhaW1wb3J0YW50O2NsZWFyOiBib3RoICFpbXBvcnRhbnQ7Ij4NCgkJCTx0YWJsZSBzdHlsZT0iYm9yZGVyOiAxcHggc29saWQgI2MyYzJjMjt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDttYXJnaW46IDMwcHggMHB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czogNXB4Oy1tb3otYm9yZGVyLXJhZGl1czogNXB4Oy1vLWJvcmRlci1yYWRpdXM6IDVweDtib3JkZXItcmFkaXVzOiA1cHg7Ij4NCgkJCQk8dGJvZHk+DQoJCQkJCTx0ciBzdHlsZT0iYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7Ij4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDU5JTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7dGV4dC1hbGlnbjogbGVmdDtmb250LWZhbWlseTogTW9udHNlcnJhdCwgc2Fucy1zZXJpZjsiPg0KCQkJCQkJCQl7e2NvbXBhbnlfbmFtZX19PGJyIC8+e3tjb21wYW55X2FkZHJlc3N9fTxiciAvPnt7Y29tcGFueV9jaXR5fX0sIHt7Y29tcGFueV9zdGF0ZX19LCB7e2NvbXBhbnlfemlwfX08YnIgLz57e2NvbXBhbnlfY291bnRyeX19PGJyIC8+e3tjb21wYW55X3Bob25lfX08YnIgLz57e2NvbXBhbnlfZW1haWx9fQ0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDQwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7Ij4NCgkJCQkJCQkJPGRpdiBzdHlsZT0id2lkdGg6IDEzMHB4O2hlaWdodDogMTAwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO21hcmdpbjogMHB4IGF1dG87Ij4NCgkJCQkJCQkJCTxpbWcgc3R5bGU9IndpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0O2Rpc3BsYXk6IGlubGluZS1ibG9jaztoZWlnaHQ6IDEwMCU7IiBzcmM9Int7YnVzaW5lc3NfbG9nb319IiAvPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQk8L2Rpdj4NCgkJCQkJCTwvdGQ+DQoJCQkJCQkNCgkJCQkJCQ0KCQkJCQk8L3RyPg0KCQkJCQk8dHI+DQoJCQkJCQk8dGQ+DQoJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMjVweCAzMHB4O2JhY2tncm91bmQ6ICNmZmY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDkwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQkJPGg2IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bWFyZ2luOiAxMHB4IDBweCAxMHB4O2ZvbnQtd2VpZ2h0OiA2MDA7Ij5EZWFyIHt7c3RhZmZfbmFtZX19LCA8L2g2Pg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDttYXJnaW46IDEwcHggMHB4IDE1cHg7Ij5Zb3UndmUgbmV3IGFwcG9pbnRtZW50IHdpdGgge3tjbGllbnRfbmFtZX19IHdpdGggZm9sbG93aW5nIGRldGFpbHM6PC9wPgkJCQkJCQkNCgkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTxkaXYgc3R5bGU9ImZsb2F0OiBsZWZ0O3dpZHRoOiAxMDAlO2Rpc3BsYXk6IGJsb2NrO3BhZGRpbmc6IDEwcHggMHB4OyI+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5XaGVuOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Ym9va2luZ19kYXRlfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkZvcjogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3NlcnZpY2VfbmFtZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5NZXRob2RzIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e21ldGhvZG5hbWV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+VW5pdHMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7dW5pdHN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+QWRkLW9ucyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3thZGRvbnN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UHJpY2UgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7cHJpY2V9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJDQoJCQkJCQkJCQkNCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPk5hbWUgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Zmlyc3RuYW1lfX0ge3tsYXN0bmFtZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5FbWFpbCA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tjbGllbnRfZW1haWx9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UGhvbmUgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7cGhvbmV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UGF5bWVudCA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twYXltZW50X21ldGhvZH19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5WYWNjdW0gQ2xlYW5lciA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3t2YWNjdW1fY2xlYW5lcl9zdGF0dXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UGFya2luZyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twYXJraW5nX3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5BZGRyZXNzIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2FkZHJlc3N9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+Tm90ZXMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7bm90ZXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+Q29udGFjdCBTdGF0dXMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Y29udGFjdF9zdGF0dXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMTVweCAwcHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7Ym9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7Ij4NCgkJCQkJCQkJCTxwIHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bGluZS1oZWlnaHQ6IDIycHg7bWFyZ2luOiAxMHB4IDBweCAxNXB4O2Zsb2F0OiBsZWZ0OyI+VGhpcyBhcHBvaW50bWVudCBpcyBwZW5kaW5nLjwvcD4NCgkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTxkaXYgc3R5bGU9InBhZGRpbmc6IDEwcHggMHB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiAxMDAlO2Rpc3BsYXk6IGJsb2NrO3RleHQtYWxpZ246IGNlbnRlcjsiPg0KCQkJCQkJCQkJPGg1IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDEzcHg7bWFyZ2luOiAwcHggMHB4IDVweDsiPlRoYW5rIHlvdTwvaDU+DQoJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4JCQkJCQ0KCQkJCQk8L3RyPgkJCQkNCgkJCQk8L3Rib2R5Pg0KCQkJPC90YWJsZT4JDQoJCTwvZGl2Pg0KCTwvZGl2PgkNCjwvYm9keT4NCjwvaHRtbD4=' WHERE `user_type`='S' AND `email_template_type`='A'";
		mysqli_query($this->conn, $query);
		
		/* C Staff Email Templet Update */
		$query = "UPDATE `ct_email_templates` SET `default_message`='PGh0bWw+DQo8aGVhZD4NCgk8bWV0YSBuYW1lPSJ2aWV3cG9ydCIgY29udGVudD0id2lkdGg9ZGV2aWNlLXdpZHRoLCBpbml0aWFsLXNjYWxlPTEuMCIvPg0KCTxtZXRhIGh0dHAtZXF1aXY9IkNvbnRlbnQtVHlwZSIgY29udGVudD0idGV4dC9odG1sOyBjaGFyc2V0PVVURi04IiAvPg0KCTx0aXRsZT5TdWJqZWN0OiB7e3NlcnZpY2VfbmFtZX19IG9uIHt7Ym9va2luZ19kYXRlfX08L3RpdGxlPg0KCTxsaW5rIGhyZWY9Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1Nb250c2VycmF0IiByZWw9InN0eWxlc2hlZXQiPg0KPC9oZWFkPg0KPGJvZHk+CQkNCgk8ZGl2IHN0eWxlPSJtYXJnaW46IDA7cGFkZGluZzogMDtmb250LWZhbWlseTogSGVsdmV0aWNhIE5ldWUsIEhlbHZldGljYSwgSGVsdmV0aWNhLCBBcmlhbCwgc2Fucy1zZXJpZjtmb250LXNpemU6IDEwMCU7bGluZS1oZWlnaHQ6IDEuNjtib3gtc2l6aW5nOiBib3JkZXItYm94OyI+CQ0KCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O21heC13aWR0aDogNjAwcHggIWltcG9ydGFudDttYXJnaW46IDAgYXV0byAhaW1wb3J0YW50O2NsZWFyOiBib3RoICFpbXBvcnRhbnQ7Ij4NCgkJCTx0YWJsZSBzdHlsZT0iYm9yZGVyOiAxcHggc29saWQgI2MyYzJjMjt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDttYXJnaW46IDMwcHggMHB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czogNXB4Oy1tb3otYm9yZGVyLXJhZGl1czogNXB4Oy1vLWJvcmRlci1yYWRpdXM6IDVweDtib3JkZXItcmFkaXVzOiA1cHg7Ij4NCgkJCQk8dGJvZHk+DQoJCQkJCTx0ciBzdHlsZT0iYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7Ij4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDU5JTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7dGV4dC1hbGlnbjogbGVmdDtmb250LWZhbWlseTogTW9udHNlcnJhdCwgc2Fucy1zZXJpZjsiPg0KCQkJCQkJCQl7e2NvbXBhbnlfbmFtZX19PGJyIC8+e3tjb21wYW55X2FkZHJlc3N9fTxiciAvPnt7Y29tcGFueV9jaXR5fX0sIHt7Y29tcGFueV9zdGF0ZX19LCB7e2NvbXBhbnlfemlwfX08YnIgLz57e2NvbXBhbnlfY291bnRyeX19PGJyIC8+e3tjb21wYW55X3Bob25lfX08YnIgLz57e2NvbXBhbnlfZW1haWx9fQ0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDQwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7Ij4NCgkJCQkJCQkJPGRpdiBzdHlsZT0id2lkdGg6IDEzMHB4O2hlaWdodDogMTAwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO21hcmdpbjogMHB4IGF1dG87Ij4NCgkJCQkJCQkJCTxpbWcgc3R5bGU9IndpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0O2Rpc3BsYXk6IGlubGluZS1ibG9jaztoZWlnaHQ6IDEwMCU7IiBzcmM9Int7YnVzaW5lc3NfbG9nb319IiAvPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQk8L2Rpdj4NCgkJCQkJCTwvdGQ+DQoJCQkJCQkNCgkJCQkJCQ0KCQkJCQk8L3RyPg0KCQkJCQk8dHI+DQoJCQkJCQk8dGQ+DQoJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMjVweCAzMHB4O2JhY2tncm91bmQ6ICNmZmY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDkwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQkJPGg2IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bWFyZ2luOiAxMHB4IDBweCAxMHB4O2ZvbnQtd2VpZ2h0OiA2MDA7Ij5EZWFyIHt7c3RhZmZfbmFtZX19LCA8L2g2Pg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDttYXJnaW46IDEwcHggMHB4IDE1cHg7Ij5Zb3UndmUgbmV3IGFwcG9pbnRtZW50IHdpdGgge3tjbGllbnRfbmFtZX19IHdpdGggZm9sbG93aW5nIGRldGFpbHM6PC9wPgkJCQkJCQkNCgkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTxkaXYgc3R5bGU9ImZsb2F0OiBsZWZ0O3dpZHRoOiAxMDAlO2Rpc3BsYXk6IGJsb2NrO3BhZGRpbmc6IDEwcHggMHB4OyI+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5XaGVuOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Ym9va2luZ19kYXRlfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkZvcjogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3NlcnZpY2VfbmFtZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5NZXRob2RzIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e21ldGhvZG5hbWV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+VW5pdHMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7dW5pdHN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+QWRkLW9ucyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3thZGRvbnN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UHJpY2UgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7cHJpY2V9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJDQoJCQkJCQkJCQkNCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPk5hbWUgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Zmlyc3RuYW1lfX0ge3tsYXN0bmFtZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5FbWFpbCA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tjbGllbnRfZW1haWx9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UGhvbmUgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7cGhvbmV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UGF5bWVudCA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twYXltZW50X21ldGhvZH19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5WYWNjdW0gQ2xlYW5lciA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3t2YWNjdW1fY2xlYW5lcl9zdGF0dXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UGFya2luZyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twYXJraW5nX3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5BZGRyZXNzIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2FkZHJlc3N9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+Tm90ZXMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7bm90ZXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+Q29udGFjdCBTdGF0dXMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Y29udGFjdF9zdGF0dXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMTVweCAwcHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7Ym9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7Ij4NCgkJCQkJCQkJCTxwIHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bGluZS1oZWlnaHQ6IDIycHg7bWFyZ2luOiAxMHB4IDBweCAxNXB4O2Zsb2F0OiBsZWZ0OyI+VGhpcyBhcHBvaW50bWVudCBpcyBwZW5kaW5nLjwvcD4NCgkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTxkaXYgc3R5bGU9InBhZGRpbmc6IDEwcHggMHB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiAxMDAlO2Rpc3BsYXk6IGJsb2NrO3RleHQtYWxpZ246IGNlbnRlcjsiPg0KCQkJCQkJCQkJPGg1IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDEzcHg7bWFyZ2luOiAwcHggMHB4IDVweDsiPlRoYW5rIHlvdTwvaDU+DQoJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4JCQkJCQ0KCQkJCQk8L3RyPgkJCQkNCgkJCQk8L3Rib2R5Pg0KCQkJPC90YWJsZT4JDQoJCTwvZGl2Pg0KCTwvZGl2PgkNCjwvYm9keT4NCjwvaHRtbD4=' WHERE `user_type`='S' AND `email_template_type`='C'";
		mysqli_query($this->conn, $query);
		
		/* R Staff Email Templet Update */
		$query = "UPDATE `ct_email_templates` SET `default_message`='PGh0bWw+DQo8aGVhZD4NCgk8bWV0YSBuYW1lPSJ2aWV3cG9ydCIgY29udGVudD0id2lkdGg9ZGV2aWNlLXdpZHRoLCBpbml0aWFsLXNjYWxlPTEuMCIvPg0KCTxtZXRhIGh0dHAtZXF1aXY9IkNvbnRlbnQtVHlwZSIgY29udGVudD0idGV4dC9odG1sOyBjaGFyc2V0PVVURi04IiAvPg0KCTx0aXRsZT5TdWJqZWN0OiB7e3NlcnZpY2VfbmFtZX19IG9uIHt7Ym9va2luZ19kYXRlfX08L3RpdGxlPg0KCTxsaW5rIGhyZWY9Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1Nb250c2VycmF0IiByZWw9InN0eWxlc2hlZXQiPg0KPC9oZWFkPg0KPGJvZHk+CQkNCgk8ZGl2IHN0eWxlPSJtYXJnaW46IDA7cGFkZGluZzogMDtmb250LWZhbWlseTogSGVsdmV0aWNhIE5ldWUsIEhlbHZldGljYSwgSGVsdmV0aWNhLCBBcmlhbCwgc2Fucy1zZXJpZjtmb250LXNpemU6IDEwMCU7bGluZS1oZWlnaHQ6IDEuNjtib3gtc2l6aW5nOiBib3JkZXItYm94OyI+CQ0KCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O21heC13aWR0aDogNjAwcHggIWltcG9ydGFudDttYXJnaW46IDAgYXV0byAhaW1wb3J0YW50O2NsZWFyOiBib3RoICFpbXBvcnRhbnQ7Ij4NCgkJCTx0YWJsZSBzdHlsZT0iYm9yZGVyOiAxcHggc29saWQgI2MyYzJjMjt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDttYXJnaW46IDMwcHggMHB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czogNXB4Oy1tb3otYm9yZGVyLXJhZGl1czogNXB4Oy1vLWJvcmRlci1yYWRpdXM6IDVweDtib3JkZXItcmFkaXVzOiA1cHg7Ij4NCgkJCQk8dGJvZHk+DQoJCQkJCTx0ciBzdHlsZT0iYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7Ij4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDU5JTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7dGV4dC1hbGlnbjogbGVmdDtmb250LWZhbWlseTogTW9udHNlcnJhdCwgc2Fucy1zZXJpZjsiPg0KCQkJCQkJCQl7e2NvbXBhbnlfbmFtZX19PGJyIC8+e3tjb21wYW55X2FkZHJlc3N9fTxiciAvPnt7Y29tcGFueV9jaXR5fX0sIHt7Y29tcGFueV9zdGF0ZX19LCB7e2NvbXBhbnlfemlwfX08YnIgLz57e2NvbXBhbnlfY291bnRyeX19PGJyIC8+e3tjb21wYW55X3Bob25lfX08YnIgLz57e2NvbXBhbnlfZW1haWx9fQ0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDQwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7Ij4NCgkJCQkJCQkJPGRpdiBzdHlsZT0id2lkdGg6IDEzMHB4O2hlaWdodDogMTAwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO21hcmdpbjogMHB4IGF1dG87Ij4NCgkJCQkJCQkJCTxpbWcgc3R5bGU9IndpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0O2Rpc3BsYXk6IGlubGluZS1ibG9jaztoZWlnaHQ6IDEwMCU7IiBzcmM9Int7YnVzaW5lc3NfbG9nb319IiAvPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQk8L2Rpdj4NCgkJCQkJCTwvdGQ+DQoJCQkJCQkNCgkJCQkJCQ0KCQkJCQk8L3RyPg0KCQkJCQk8dHI+DQoJCQkJCQk8dGQ+DQoJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMjVweCAzMHB4O2JhY2tncm91bmQ6ICNmZmY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDkwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQkJPGg2IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bWFyZ2luOiAxMHB4IDBweCAxMHB4O2ZvbnQtd2VpZ2h0OiA2MDA7Ij5EZWFyIHt7c3RhZmZfbmFtZX19LCA8L2g2Pg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDttYXJnaW46IDEwcHggMHB4IDE1cHg7Ij5Zb3UndmUgbmV3IGFwcG9pbnRtZW50IHdpdGgge3tjbGllbnRfbmFtZX19IHdpdGggZm9sbG93aW5nIGRldGFpbHM6PC9wPgkJCQkJCQkNCgkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTxkaXYgc3R5bGU9ImZsb2F0OiBsZWZ0O3dpZHRoOiAxMDAlO2Rpc3BsYXk6IGJsb2NrO3BhZGRpbmc6IDEwcHggMHB4OyI+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5XaGVuOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Ym9va2luZ19kYXRlfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkZvcjogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3NlcnZpY2VfbmFtZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5NZXRob2RzIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e21ldGhvZG5hbWV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+VW5pdHMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7dW5pdHN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+QWRkLW9ucyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3thZGRvbnN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UHJpY2UgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7cHJpY2V9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJDQoJCQkJCQkJCQkNCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPk5hbWUgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Zmlyc3RuYW1lfX0ge3tsYXN0bmFtZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5FbWFpbCA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tjbGllbnRfZW1haWx9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UGhvbmUgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7cGhvbmV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UGF5bWVudCA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twYXltZW50X21ldGhvZH19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5WYWNjdW0gQ2xlYW5lciA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3t2YWNjdW1fY2xlYW5lcl9zdGF0dXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UGFya2luZyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twYXJraW5nX3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5BZGRyZXNzIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2FkZHJlc3N9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+Tm90ZXMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7bm90ZXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+Q29udGFjdCBTdGF0dXMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Y29udGFjdF9zdGF0dXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMTVweCAwcHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7Ym9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7Ij4NCgkJCQkJCQkJCTxwIHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bGluZS1oZWlnaHQ6IDIycHg7bWFyZ2luOiAxMHB4IDBweCAxNXB4O2Zsb2F0OiBsZWZ0OyI+VGhpcyBhcHBvaW50bWVudCBpcyBwZW5kaW5nLjwvcD4NCgkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTxkaXYgc3R5bGU9InBhZGRpbmc6IDEwcHggMHB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiAxMDAlO2Rpc3BsYXk6IGJsb2NrO3RleHQtYWxpZ246IGNlbnRlcjsiPg0KCQkJCQkJCQkJPGg1IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDEzcHg7bWFyZ2luOiAwcHggMHB4IDVweDsiPlRoYW5rIHlvdTwvaDU+DQoJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4JCQkJCQ0KCQkJCQk8L3RyPgkJCQkNCgkJCQk8L3Rib2R5Pg0KCQkJPC90YWJsZT4JDQoJCTwvZGl2Pg0KCTwvZGl2PgkNCjwvYm9keT4NCjwvaHRtbD4=' WHERE `user_type`='S' AND `email_template_type`='R'";
		mysqli_query($this->conn, $query);
		
		/* CC Staff Email Templet Update */
		$query = "UPDATE `ct_email_templates` SET `default_message`='PGh0bWw+DQo8aGVhZD4NCgk8bWV0YSBuYW1lPSJ2aWV3cG9ydCIgY29udGVudD0id2lkdGg9ZGV2aWNlLXdpZHRoLCBpbml0aWFsLXNjYWxlPTEuMCIvPg0KCTxtZXRhIGh0dHAtZXF1aXY9IkNvbnRlbnQtVHlwZSIgY29udGVudD0idGV4dC9odG1sOyBjaGFyc2V0PVVURi04IiAvPg0KCTx0aXRsZT5TdWJqZWN0OiB7e3NlcnZpY2VfbmFtZX19IG9uIHt7Ym9va2luZ19kYXRlfX08L3RpdGxlPg0KCTxsaW5rIGhyZWY9Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1Nb250c2VycmF0IiByZWw9InN0eWxlc2hlZXQiPg0KPC9oZWFkPg0KPGJvZHk+CQkNCgk8ZGl2IHN0eWxlPSJtYXJnaW46IDA7cGFkZGluZzogMDtmb250LWZhbWlseTogSGVsdmV0aWNhIE5ldWUsIEhlbHZldGljYSwgSGVsdmV0aWNhLCBBcmlhbCwgc2Fucy1zZXJpZjtmb250LXNpemU6IDEwMCU7bGluZS1oZWlnaHQ6IDEuNjtib3gtc2l6aW5nOiBib3JkZXItYm94OyI+CQ0KCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O21heC13aWR0aDogNjAwcHggIWltcG9ydGFudDttYXJnaW46IDAgYXV0byAhaW1wb3J0YW50O2NsZWFyOiBib3RoICFpbXBvcnRhbnQ7Ij4NCgkJCTx0YWJsZSBzdHlsZT0iYm9yZGVyOiAxcHggc29saWQgI2MyYzJjMjt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDttYXJnaW46IDMwcHggMHB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czogNXB4Oy1tb3otYm9yZGVyLXJhZGl1czogNXB4Oy1vLWJvcmRlci1yYWRpdXM6IDVweDtib3JkZXItcmFkaXVzOiA1cHg7Ij4NCgkJCQk8dGJvZHk+DQoJCQkJCTx0ciBzdHlsZT0iYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7Ij4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDU5JTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7dGV4dC1hbGlnbjogbGVmdDtmb250LWZhbWlseTogTW9udHNlcnJhdCwgc2Fucy1zZXJpZjsiPg0KCQkJCQkJCQl7e2NvbXBhbnlfbmFtZX19PGJyIC8+e3tjb21wYW55X2FkZHJlc3N9fTxiciAvPnt7Y29tcGFueV9jaXR5fX0sIHt7Y29tcGFueV9zdGF0ZX19LCB7e2NvbXBhbnlfemlwfX08YnIgLz57e2NvbXBhbnlfY291bnRyeX19PGJyIC8+e3tjb21wYW55X3Bob25lfX08YnIgLz57e2NvbXBhbnlfZW1haWx9fQ0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDQwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7Ij4NCgkJCQkJCQkJPGRpdiBzdHlsZT0id2lkdGg6IDEzMHB4O2hlaWdodDogMTAwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO21hcmdpbjogMHB4IGF1dG87Ij4NCgkJCQkJCQkJCTxpbWcgc3R5bGU9IndpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0O2Rpc3BsYXk6IGlubGluZS1ibG9jaztoZWlnaHQ6IDEwMCU7IiBzcmM9Int7YnVzaW5lc3NfbG9nb319IiAvPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQk8L2Rpdj4NCgkJCQkJCTwvdGQ+DQoJCQkJCQkNCgkJCQkJCQ0KCQkJCQk8L3RyPg0KCQkJCQk8dHI+DQoJCQkJCQk8dGQ+DQoJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMjVweCAzMHB4O2JhY2tncm91bmQ6ICNmZmY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDkwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQkJPGg2IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bWFyZ2luOiAxMHB4IDBweCAxMHB4O2ZvbnQtd2VpZ2h0OiA2MDA7Ij5EZWFyIHt7c3RhZmZfbmFtZX19LCA8L2g2Pg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDttYXJnaW46IDEwcHggMHB4IDE1cHg7Ij5UaGUgYXBwb2ludG1lbnQgd2l0aCB7e2NsaWVudF9uYW1lfX0gd2l0aCBmb2xsb3dpbmcgZGV0YWlsczo8L3A+CQkJCQkJCQ0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPGRpdiBzdHlsZT0iZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7cGFkZGluZzogMTBweCAwcHg7Ij4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPldoZW46IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tib29raW5nX2RhdGV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+Rm9yOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7c2VydmljZV9uYW1lfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPk1ldGhvZHMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7bWV0aG9kbmFtZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Vbml0cyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3t1bml0c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5BZGQtb25zIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2FkZG9uc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QcmljZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twcmljZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQkNCgkJCQkJCQkJCQ0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+TmFtZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tmaXJzdG5hbWV9fSB7e2xhc3RuYW1lfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkVtYWlsIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2NsaWVudF9lbWFpbH19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QaG9uZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twaG9uZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QYXltZW50IDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3BheW1lbnRfbWV0aG9kfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPlZhY2N1bSBDbGVhbmVyIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3ZhY2N1bV9jbGVhbmVyX3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QYXJraW5nIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3Bhcmtpbmdfc3RhdHVzfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkFkZHJlc3MgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7YWRkcmVzc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Ob3RlcyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tub3Rlc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Db250YWN0IFN0YXR1cyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tjb250YWN0X3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJwYWRkaW5nOiAxNXB4IDBweDtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjsiPg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDtsaW5lLWhlaWdodDogMjJweDttYXJnaW46IDEwcHggMHB4IDE1cHg7ZmxvYXQ6IGxlZnQ7Ij5oYXMgYmVlbiBjYW5jZWxsZWQuPC9wPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMTBweCAwcHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7dGV4dC1hbGlnbjogY2VudGVyOyI+DQoJCQkJCQkJCQk8aDUgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTNweDttYXJnaW46IDBweCAwcHggNXB4OyI+VGhhbmsgeW91PC9oNT4NCgkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJPC9kaXY+DQoJCQkJCQk8L3RkPgkJCQkJDQoJCQkJCTwvdHI+CQkJCQ0KCQkJCTwvdGJvZHk+DQoJCQk8L3RhYmxlPgkNCgkJPC9kaXY+DQoJPC9kaXY+CQ0KPC9ib2R5Pg0KPC9odG1sPg==' WHERE `user_type`='S' AND `email_template_type`='CC'";
		mysqli_query($this->conn, $query);
		
		/* RS Staff Email Templet Update */
		$query = "UPDATE `ct_email_templates` SET `default_message`='PGh0bWw+DQo8aGVhZD4NCgk8bWV0YSBuYW1lPSJ2aWV3cG9ydCIgY29udGVudD0id2lkdGg9ZGV2aWNlLXdpZHRoLCBpbml0aWFsLXNjYWxlPTEuMCIvPg0KCTxtZXRhIGh0dHAtZXF1aXY9IkNvbnRlbnQtVHlwZSIgY29udGVudD0idGV4dC9odG1sOyBjaGFyc2V0PVVURi04IiAvPg0KCTx0aXRsZT5TdWJqZWN0OiB7e3NlcnZpY2VfbmFtZX19IG9uIHt7Ym9va2luZ19kYXRlfX08L3RpdGxlPg0KCTxsaW5rIGhyZWY9Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1Nb250c2VycmF0IiByZWw9InN0eWxlc2hlZXQiPg0KPC9oZWFkPg0KPGJvZHk+CQkNCgk8ZGl2IHN0eWxlPSJtYXJnaW46IDA7cGFkZGluZzogMDtmb250LWZhbWlseTogSGVsdmV0aWNhIE5ldWUsIEhlbHZldGljYSwgSGVsdmV0aWNhLCBBcmlhbCwgc2Fucy1zZXJpZjtmb250LXNpemU6IDEwMCU7bGluZS1oZWlnaHQ6IDEuNjtib3gtc2l6aW5nOiBib3JkZXItYm94OyI+CQ0KCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O21heC13aWR0aDogNjAwcHggIWltcG9ydGFudDttYXJnaW46IDAgYXV0byAhaW1wb3J0YW50O2NsZWFyOiBib3RoICFpbXBvcnRhbnQ7Ij4NCgkJCTx0YWJsZSBzdHlsZT0iYm9yZGVyOiAxcHggc29saWQgI2MyYzJjMjt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDttYXJnaW46IDMwcHggMHB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czogNXB4Oy1tb3otYm9yZGVyLXJhZGl1czogNXB4Oy1vLWJvcmRlci1yYWRpdXM6IDVweDtib3JkZXItcmFkaXVzOiA1cHg7Ij4NCgkJCQk8dGJvZHk+DQoJCQkJCTx0ciBzdHlsZT0iYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7Ij4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDU5JTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7dGV4dC1hbGlnbjogbGVmdDtmb250LWZhbWlseTogTW9udHNlcnJhdCwgc2Fucy1zZXJpZjsiPg0KCQkJCQkJCQl7e2NvbXBhbnlfbmFtZX19PGJyIC8+e3tjb21wYW55X2FkZHJlc3N9fTxiciAvPnt7Y29tcGFueV9jaXR5fX0sIHt7Y29tcGFueV9zdGF0ZX19LCB7e2NvbXBhbnlfemlwfX08YnIgLz57e2NvbXBhbnlfY291bnRyeX19PGJyIC8+e3tjb21wYW55X3Bob25lfX08YnIgLz57e2NvbXBhbnlfZW1haWx9fQ0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDQwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7Ij4NCgkJCQkJCQkJPGRpdiBzdHlsZT0id2lkdGg6IDEzMHB4O2hlaWdodDogMTAwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO21hcmdpbjogMHB4IGF1dG87Ij4NCgkJCQkJCQkJCTxpbWcgc3R5bGU9IndpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0O2Rpc3BsYXk6IGlubGluZS1ibG9jaztoZWlnaHQ6IDEwMCU7IiBzcmM9Int7YnVzaW5lc3NfbG9nb319IiAvPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQk8L2Rpdj4NCgkJCQkJCTwvdGQ+DQoJCQkJCQkNCgkJCQkJCQ0KCQkJCQk8L3RyPg0KCQkJCQk8dHI+DQoJCQkJCQk8dGQ+DQoJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMjVweCAzMHB4O2JhY2tncm91bmQ6ICNmZmY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDkwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQkJPGg2IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bWFyZ2luOiAxMHB4IDBweCAxMHB4O2ZvbnQtd2VpZ2h0OiA2MDA7Ij5EZWFyIHt7c3RhZmZfbmFtZX19LCA8L2g2Pg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDttYXJnaW46IDEwcHggMHB4IDE1cHg7Ij5UaGUgYXBwb2ludG1lbnQgd2l0aCB7e2NsaWVudF9uYW1lfX0gd2l0aCBmb2xsb3dpbmcgZGV0YWlsczo8L3A+CQkJCQkJCQ0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPGRpdiBzdHlsZT0iZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7cGFkZGluZzogMTBweCAwcHg7Ij4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPldoZW46IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tib29raW5nX2RhdGV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+Rm9yOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7c2VydmljZV9uYW1lfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPk1ldGhvZHMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7bWV0aG9kbmFtZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Vbml0cyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3t1bml0c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5BZGQtb25zIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2FkZG9uc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QcmljZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twcmljZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQkNCgkJCQkJCQkJCQ0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+TmFtZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tmaXJzdG5hbWV9fSB7e2xhc3RuYW1lfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkVtYWlsIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2NsaWVudF9lbWFpbH19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QaG9uZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twaG9uZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QYXltZW50IDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3BheW1lbnRfbWV0aG9kfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPlZhY2N1bSBDbGVhbmVyIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3ZhY2N1bV9jbGVhbmVyX3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QYXJraW5nIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3Bhcmtpbmdfc3RhdHVzfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkFkZHJlc3MgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7YWRkcmVzc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Ob3RlcyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tub3Rlc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Db250YWN0IFN0YXR1cyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tjb250YWN0X3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJwYWRkaW5nOiAxNXB4IDBweDtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjsiPg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDtsaW5lLWhlaWdodDogMjJweDttYXJnaW46IDEwcHggMHB4IDE1cHg7ZmxvYXQ6IGxlZnQ7Ij5oYXMgYmVlbiByZXNjaGVkdWxlZC48L3A+DQoJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJwYWRkaW5nOiAxMHB4IDBweDtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jazt0ZXh0LWFsaWduOiBjZW50ZXI7Ij4NCgkJCQkJCQkJCTxoNSBzdHlsZT0iY29sb3I6ICM2MDYwNjA7Zm9udC1zaXplOiAxM3B4O21hcmdpbjogMHB4IDBweCA1cHg7Ij5UaGFuayB5b3U8L2g1Pg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQk8L2Rpdj4NCgkJCQkJCTwvdGQ+CQkJCQkNCgkJCQkJPC90cj4JCQkJDQoJCQkJPC90Ym9keT4NCgkJCTwvdGFibGU+CQ0KCQk8L2Rpdj4NCgk8L2Rpdj4JDQo8L2JvZHk+DQo8L2h0bWw+' WHERE `user_type`='S' AND `email_template_type`='RS'";
		mysqli_query($this->conn, $query);
		
		/* RM Staff Email Templet Update */
		$query = "UPDATE `ct_email_templates` SET `default_message`='PGh0bWw+DQo8aGVhZD4NCgk8bWV0YSBuYW1lPSJ2aWV3cG9ydCIgY29udGVudD0id2lkdGg9ZGV2aWNlLXdpZHRoLCBpbml0aWFsLXNjYWxlPTEuMCIvPg0KCTxtZXRhIGh0dHAtZXF1aXY9IkNvbnRlbnQtVHlwZSIgY29udGVudD0idGV4dC9odG1sOyBjaGFyc2V0PVVURi04IiAvPg0KCTx0aXRsZT5TdWJqZWN0OiB7e3NlcnZpY2VfbmFtZX19IG9uIHt7Ym9va2luZ19kYXRlfX08L3RpdGxlPg0KCTxsaW5rIGhyZWY9Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1Nb250c2VycmF0IiByZWw9InN0eWxlc2hlZXQiPg0KPC9oZWFkPg0KPGJvZHk+CQkNCgk8ZGl2IHN0eWxlPSJtYXJnaW46IDA7cGFkZGluZzogMDtmb250LWZhbWlseTogSGVsdmV0aWNhIE5ldWUsIEhlbHZldGljYSwgSGVsdmV0aWNhLCBBcmlhbCwgc2Fucy1zZXJpZjtmb250LXNpemU6IDEwMCU7bGluZS1oZWlnaHQ6IDEuNjtib3gtc2l6aW5nOiBib3JkZXItYm94OyI+CQ0KCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O21heC13aWR0aDogNjAwcHggIWltcG9ydGFudDttYXJnaW46IDAgYXV0byAhaW1wb3J0YW50O2NsZWFyOiBib3RoICFpbXBvcnRhbnQ7Ij4NCgkJCTx0YWJsZSBzdHlsZT0iYm9yZGVyOiAxcHggc29saWQgI2MyYzJjMjt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDttYXJnaW46IDMwcHggMHB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czogNXB4Oy1tb3otYm9yZGVyLXJhZGl1czogNXB4Oy1vLWJvcmRlci1yYWRpdXM6IDVweDtib3JkZXItcmFkaXVzOiA1cHg7Ij4NCgkJCQk8dGJvZHk+DQoJCQkJCTx0ciBzdHlsZT0iYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7Ij4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDU5JTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7dGV4dC1hbGlnbjogbGVmdDtmb250LWZhbWlseTogTW9udHNlcnJhdCwgc2Fucy1zZXJpZjsiPg0KCQkJCQkJCQl7e2NvbXBhbnlfbmFtZX19PGJyIC8+e3tjb21wYW55X2FkZHJlc3N9fTxiciAvPnt7Y29tcGFueV9jaXR5fX0sIHt7Y29tcGFueV9zdGF0ZX19LCB7e2NvbXBhbnlfemlwfX08YnIgLz57e2NvbXBhbnlfY291bnRyeX19PGJyIC8+e3tjb21wYW55X3Bob25lfX08YnIgLz57e2NvbXBhbnlfZW1haWx9fQ0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDQwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7Ij4NCgkJCQkJCQkJPGRpdiBzdHlsZT0id2lkdGg6IDEzMHB4O2hlaWdodDogMTAwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO21hcmdpbjogMHB4IGF1dG87Ij4NCgkJCQkJCQkJCTxpbWcgc3R5bGU9IndpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0O2Rpc3BsYXk6IGlubGluZS1ibG9jaztoZWlnaHQ6IDEwMCU7IiBzcmM9Int7YnVzaW5lc3NfbG9nb319IiAvPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQk8L2Rpdj4NCgkJCQkJCTwvdGQ+DQoJCQkJCQkNCgkJCQkJCQ0KCQkJCQk8L3RyPg0KCQkJCQk8dHI+DQoJCQkJCQk8dGQ+DQoJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMjVweCAzMHB4O2JhY2tncm91bmQ6ICNmZmY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDkwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQkJPGg2IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bWFyZ2luOiAxMHB4IDBweCAxMHB4O2ZvbnQtd2VpZ2h0OiA2MDA7Ij5EZWFyIHt7c3RhZmZfbmFtZX19LCA8L2g2Pg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDttYXJnaW46IDEwcHggMHB4IDE1cHg7Ij5XZSBqdXN0IHdhbnRlZCB0byByZW1pbmQgeW91IHRoYXQgeW91IGhhdmUgYXBwb2ludG1lbnQgd2l0aCB7e2NsaWVudF9uYW1lfX0gaXMgc2NoZWR1bGVkIGluIDxiPnt7YXBwX3JlbWFpbl90aW1lfX08L2I+IGhvdXJzLjwvcD4JCQkJCQkJDQoJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jaztwYWRkaW5nOiAxMHB4IDBweDsiPg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+V2hlbjogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2Jvb2tpbmdfZGF0ZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Gb3I6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tzZXJ2aWNlX25hbWV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+TWV0aG9kcyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3ttZXRob2RuYW1lfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPlVuaXRzIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3VuaXRzfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkFkZC1vbnMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7YWRkb25zfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPlByaWNlIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3ByaWNlfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCQ0KCQkJCQkJCQkJDQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5OYW1lIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2ZpcnN0bmFtZX19IHt7bGFzdG5hbWV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+RW1haWwgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Y2xpZW50X2VtYWlsfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPlBob25lIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3Bob25lfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPlBheW1lbnQgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7cGF5bWVudF9tZXRob2R9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+VmFjY3VtIENsZWFuZXIgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7dmFjY3VtX2NsZWFuZXJfc3RhdHVzfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPlBhcmtpbmcgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7cGFya2luZ19zdGF0dXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+QWRkcmVzcyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3thZGRyZXNzfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPk5vdGVzIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e25vdGVzfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkNvbnRhY3QgU3RhdHVzIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2NvbnRhY3Rfc3RhdHVzfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTxkaXYgc3R5bGU9InBhZGRpbmc6IDE1cHggMHB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiAxMDAlO2JvcmRlci1ib3R0b206IDFweCBzb2xpZCAjZTZlNmU2OyI+DQoJCQkJCQkJCQk8cCBzdHlsZT0iY29sb3I6ICM2MDYwNjA7Zm9udC1zaXplOiAxNXB4O2xpbmUtaGVpZ2h0OiAyMnB4O21hcmdpbjogMTBweCAwcHggMTVweDtmbG9hdDogbGVmdDsiPjwvcD4NCgkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTxkaXYgc3R5bGU9InBhZGRpbmc6IDEwcHggMHB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiAxMDAlO2Rpc3BsYXk6IGJsb2NrO3RleHQtYWxpZ246IGNlbnRlcjsiPg0KCQkJCQkJCQkJPGg1IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDEzcHg7bWFyZ2luOiAwcHggMHB4IDVweDsiPlRoYW5rIHlvdTwvaDU+DQoJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4JCQkJCQ0KCQkJCQk8L3RyPgkJCQkNCgkJCQk8L3Rib2R5Pg0KCQkJPC90YWJsZT4JDQoJCTwvZGl2Pg0KCTwvZGl2PgkNCjwvYm9keT4NCjwvaHRtbD4=' WHERE `user_type`='S' AND `email_template_type`='RM'";
		mysqli_query($this->conn, $query);
		
		$alllang = $this->get_all_languages();
		
		$language_label_arr_check = $this->get_all_labelsbyid("en");
		$en_label_decode_front = $language_label_arr_check["label_data"];
		$en_label_decode_admin = $language_label_arr_check["admin_labels"];
		$en_label_decode_error = $language_label_arr_check["error_labels"];
		$en_label_decode_extra = $language_label_arr_check["extra_labels"];
		$en_label_decode_front_form_error = $language_label_arr_check["front_error_labels"];

		while($all = mysqli_fetch_assoc($alllang)){   
			$language_name = $all['language'];
			$language_label_arr = $this->get_all_labelsbyid($all['language']);
			
			$label_data = $language_label_arr['label_data'];
			$admin_labels = $language_label_arr['admin_labels'];
			$error_labels = $language_label_arr['error_labels'];
			$extra_labels = $language_label_arr['extra_labels'];
			$front_error_labels = $language_label_arr['front_error_labels'];
			
			if($label_data == ""){
				$label_data = $en_label_decode_front;
			}if($admin_labels == ""){
				$admin_labels = $en_label_decode_admin;
			}if($error_labels == ""){
				$error_labels = $en_label_decode_error;
			}if($extra_labels == ""){
				$extra_labels = $en_label_decode_extra;
			}if($front_error_labels == ""){
				$front_error_labels = $en_label_decode_front_form_error;
			}
			
			$label_decode_front = base64_decode($label_data);
			$label_decode_admin = base64_decode($admin_labels);
			$label_decode_error = base64_decode($error_labels);
			$label_decode_extra = base64_decode($extra_labels);
			$label_decode_front_form_error = base64_decode($front_error_labels);
			
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
						
			/* Add all labels which you want to add in new version from here */
			/* DEMO FOR ADDING LABEL */
			if($language_name == "de_DE"){
				$label_decode_admin_unserial["send_sms_to_staff"] = urlencode("Stuur een SMS naar het personeel");
				$label_decode_admin_unserial["staff_sms_template"] = urlencode("SMS-sjabloon personeel");
				$label_decode_admin_unserial["preview_template"] = urlencode("Voorbeeldsjabloon");
				$label_decode_admin_unserial["client__promocode"] = urlencode("client_promocode");
				$label_decode_admin_unserial["staff__email"] = urlencode("staff_email");
				$label_decode_admin_unserial["staff__name"] = urlencode("staff_name");
				$label_decode_admin_unserial["enable_or_disable_send_sms_to_staff_for_appointment_booking_info"] = urlencode("Inschakelen of Uitschakelen, Stuur SMS naar personeel voor afspraak boekingsinformatie.");
			}elseif($language_name == "es_ES"){
				$label_decode_admin_unserial["send_sms_to_staff"] = urlencode("Enviar SMS al personal");
				$label_decode_admin_unserial["staff_sms_template"] = urlencode("Plantilla SMS para el personal");
				$label_decode_admin_unserial["preview_template"] = urlencode("Plantilla de vista previa");
				$label_decode_admin_unserial["client__promocode"] = urlencode("client_promocode");
				$label_decode_admin_unserial["staff__email"] = urlencode("staff_email");
				$label_decode_admin_unserial["staff__name"] = urlencode("Nombre del personal");
				$label_decode_admin_unserial["enable_or_disable_send_sms_to_staff_for_appointment_booking_info"] = urlencode("Habilitar o deshabilitar, enviar SMS al personal para obtener información de reserva de cita.");
			}elseif($language_name == "fr_FR"){
				$label_decode_admin_unserial["send_sms_to_staff"] = urlencode("Envoyer un SMS au personnel");
				$label_decode_admin_unserial["staff_sms_template"] = urlencode("Modèle SMS du personnel");
				$label_decode_admin_unserial["preview_template"] = urlencode("Modèle de prévisualisation");
				$label_decode_admin_unserial["client__promocode"] = urlencode("client_promocode");
				$label_decode_admin_unserial["staff__email"] = urlencode("staff_email");
				$label_decode_admin_unserial["staff__name"] = urlencode("staff_name");
				$label_decode_admin_unserial["enable_or_disable_send_sms_to_staff_for_appointment_booking_info"] = urlencode("Activer ou désactiver, envoyer un SMS au personnel pour obtenir des informations sur la réservation d'un rendez-vous.");
			}elseif($language_name == "pt_PT"){
				$label_decode_admin_unserial["send_sms_to_staff"] = urlencode("Envie SMS para o pessoal");
				$label_decode_admin_unserial["staff_sms_template"] = urlencode("Modelo de equipe SMS");
				$label_decode_admin_unserial["preview_template"] = urlencode("Modelo de pré-visualização");
				$label_decode_admin_unserial["client__promocode"] = urlencode("client_promocode");
				$label_decode_admin_unserial["staff__email"] = urlencode("staff_email");
				$label_decode_admin_unserial["staff__name"] = urlencode("staff_name");
				$label_decode_admin_unserial["enable_or_disable_send_sms_to_staff_for_appointment_booking_info"] = urlencode("Habilitar ou desabilitar, enviar SMS para a equipe para informações de reserva de compromisso.");
			}elseif($language_name == "ru_RU"){
				$label_decode_admin_unserial["send_sms_to_staff"] = urlencode("Отправить смс персоналу");
				$label_decode_admin_unserial["staff_sms_template"] = urlencode("Шаблон SMS для персонала");
				$label_decode_admin_unserial["preview_template"] = urlencode("Шаблон предварительного просмотра");
				$label_decode_admin_unserial["client__promocode"] = urlencode("client_promocode");
				$label_decode_admin_unserial["staff__email"] = urlencode("staff_email");
				$label_decode_admin_unserial["staff__name"] = urlencode("staff_name");
				$label_decode_admin_unserial["enable_or_disable_send_sms_to_staff_for_appointment_booking_info"] = urlencode("Включить или отключить, отправить SMS сотрудникам для информации о бронировании встречи.");
			}elseif($language_name == "ar"){
				$label_decode_admin_unserial["send_sms_to_staff"] = urlencode("إرسال الرسائل القصيرة للموظفين");
				$label_decode_admin_unserial["staff_sms_template"] = urlencode("قالب رسائل الموظفين");
				$label_decode_admin_unserial["preview_template"] = urlencode("معاينة القالب");
				$label_decode_admin_unserial["client__promocode"] = urlencode("client_promocode");
				$label_decode_admin_unserial["staff__email"] = urlencode("staff_email");
				$label_decode_admin_unserial["staff__name"] = urlencode("اسم الموظفين");
				$label_decode_admin_unserial["enable_or_disable_send_sms_to_staff_for_appointment_booking_info"] = urlencode("تمكين أو تعطيل ، إرسال الرسائل القصيرة للموظفين للحصول على معلومات الحجز الموعد.");
			}elseif($language_name == "zh_CN"){
				$label_decode_admin_unserial["send_sms_to_staff"] = urlencode("发送短信给员工");
				$label_decode_admin_unserial["staff_sms_template"] = urlencode("员工短信模板");
				$label_decode_admin_unserial["preview_template"] = urlencode("预览模板");
				$label_decode_admin_unserial["client__promocode"] = urlencode("client_promocode");
				$label_decode_admin_unserial["staff__email"] = urlencode("staff_email");
				$label_decode_admin_unserial["staff__name"] = urlencode("staff_name");
				$label_decode_admin_unserial["enable_or_disable_send_sms_to_staff_for_appointment_booking_info"] = urlencode("启用或禁用，向员工发送短信以获取预约信息。");
			}else{
				$label_decode_admin_unserial["send_sms_to_staff"] = urlencode("Send SMS To Staff");
				$label_decode_admin_unserial["staff_sms_template"] = urlencode("Staff SMS Template");
				$label_decode_admin_unserial["preview_template"] = urlencode("Preview Template");
				$label_decode_admin_unserial["client__promocode"] = urlencode("client_promocode");
				$label_decode_admin_unserial["staff__email"] = urlencode("staff_email");
				$label_decode_admin_unserial["staff__name"] = urlencode("staff_name");
				$label_decode_admin_unserial["enable_or_disable_send_sms_to_staff_for_appointment_booking_info"] = urlencode("Enable or Disable, Send SMS to staff for appointment booking info.");
			}
			
			$language_front_arr = base64_encode(serialize($label_decode_front_unserial));
			$language_admin_arr = base64_encode(serialize($label_decode_admin_unserial));
			$language_error_arr = base64_encode(serialize($label_decode_error_unserial));
			$language_extra_arr = base64_encode(serialize($label_decode_extra_unserial));
			$language_form_error_arr = base64_encode(serialize($label_decode_front_form_error_unserial));
			
			$update_default_lang = "UPDATE `ct_languages` set `label_data` = '".$language_front_arr."', `admin_labels` = '".$language_admin_arr."', `error_labels` = '".$language_error_arr."', `extra_labels` = '".$language_extra_arr."', `front_error_labels` = '".$language_form_error_arr."' where `language` = '".$all['language']."'";
			mysqli_query($this->conn, $update_default_lang);
		}
	}
	
	public function update4_1()
	{
		$q1s = "ALTER TABLE `ct_bookings` CHANGE `method_unit_qty` `method_unit_qty` DOUBLE NOT NULL;";
		mysqli_query($this->conn, $q1s);
		
		mysqli_query($this->conn, "INSERT INTO `ct_languages` (`id`, `label_data`, `language`, `admin_labels`, `error_labels`, `extra_labels`, `front_error_labels`) VALUES
(NULL, 'YToyMjQ6e3M6MTQ6Im5vbmVfYXZhaWxhYmxlIjtzOjE3OiIrQXVjdW4rZGlzcG9uaWJsZSI7czoxNToiYXBwb2ludG1lbnRfemlwIjtzOjE2OiIrUmVuZGV6LXZvdXMrWmlwIjtzOjE2OiJhcHBvaW50bWVudF9jaXR5IjtzOjIwOiJWaWxsZStkZStyZW5kZXotdm91cyI7czoxNzoiYXBwb2ludG1lbnRfc3RhdGUiO3M6MjU6IislQzMlODl0YXQrZGUrcmVuZGV6LXZvdXMiO3M6MTk6ImFwcG9pbnRtZW50X2FkZHJlc3MiO3M6MjI6IkFkcmVzc2UrZGUrcmVuZGV6LXZvdXMiO3M6MTA6Imd1ZXN0X3VzZXIiO3M6MjM6IlV0aWxpc2F0ZXVyK2ludml0JUMzJUE5IjtzOjIxOiJzZXJ2aWNlX3VzYWdlX21ldGhvZHMiO3M6NDA6Ik0lQzMlQTl0aG9kZXMrZCUyN3V0aWxpc2F0aW9uK2R1K3NlcnZpY2UiO3M6NjoicGF5cGFsIjtzOjg6IitQYXkrUGFsIjtzOjQ2OiJwbGVhc2VfY2hlY2tfZm9yX3RoZV9iZWxvd19taXNzaW5nX2luZm9ybWF0aW9uIjtzOjYzOiIrVmV1aWxsZXordiVDMyVBOXJpZmllcitsZXMraW5mb3JtYXRpb25zK21hbnF1YW50ZXMrY2ktZGVzc291cy4iO3M6NTE6InBsZWFzZV9wcm92aWRlX2NvbXBhbnlfZGV0YWlsc19mcm9tX3RoZV9hZG1pbl9wYW5lbCI7czo5NjoiK1ZldWlsbGV6K2ZvdXJuaXIrbGVzK2QlQzMlQTl0YWlscytkZStsYStzb2NpJUMzJUE5dCVDMyVBOStkZXB1aXMrbGUrcGFubmVhdStkJTI3YWRtaW5pc3RyYXRpb24uIjtzOjY2OiJwbGVhc2VfYWRkX3NvbWVfc2VydmljZXNfbWV0aG9kc191bml0c19hZGRvbnNfZnJvbV90aGVfYWRtaW5fcGFuZWwiO3M6MTM1OiJTJTI3aWwrdm91cytwbGElQzMlQUV0K2Fqb3V0ZXIrcXVlbHF1ZXMrc2VydmljZXMlMkMrbSVDMyVBOXRob2RlcyUyQyt1bml0JUMzJUE5cyUyQythZGRvbnMrJUMzJUEwK3BhcnRpcitkdStwYW5uZWF1K2QlMjdhZG1pbmlzdHJhdGlvbi4iO3M6NDc6InBsZWFzZV9hZGRfdGltZV9zY2hlZHVsaW5nX2Zyb21fdGhlX2FkbWluX3BhbmVsIjtzOjEwMToiUyUyN2lsK3ZvdXMrcGxhJUMzJUFFdCtham91dGVyK2xhK3BsYW5pZmljYXRpb24rZHUrdGVtcHMrJUMzJUEwK3BhcnRpcitkdStwYW5uZWF1K2QlMjdhZG1pbmlzdHJhdGlvbi4iO3M6Njg6InBsZWFzZV9jb21wbGV0ZV9jb25maWd1cmF0aW9uc19iZWZvcmVfeW91X2NyZWF0ZWRfd2Vic2l0ZV9lbWJlZF9jb2RlIjtzOjEwNDoiVmV1aWxsZXorY29tcGwlQzMlQTl0ZXIrbGVzK2NvbmZpZ3VyYXRpb25zK2F2YW50K2RlK2NyJUMzJUE5ZXIrbGUrY29kZStkJTI3aW50JUMzJUE5Z3JhdGlvbitkdStzaXRlK1dlYi4iO3M6MzoiY3ZjIjtzOjM6IkNWQyI7czo3OiJtbV95eXl5IjtzOjE4OiIrJTI4TU0rJTJGK0FBQUElMjkiO3M6MTg6ImV4cGlyeV9kYXRlX29yX2NzdiI7czoyNjoiRGF0ZStkJTI3ZXhwaXJhdGlvbitvdStDU1YiO3M6MjY6InN0cmVldF9hZGRyZXNzX3BsYWNlaG9sZGVyIjtzOjI0OiJwYXIrZXhlbXBsZS4rQ2VudHJhbCtBdmUiO3M6MjA6InppcF9jb2RlX3BsYWNlaG9sZGVyIjtzOjEyOiIrZ3QlM0IrOTAwMDEiO3M6MTY6ImNpdHlfcGxhY2Vob2xkZXIiO3M6MjU6IitwYXIrZXhlbXBsZS4rTG9zK0FuZ2VsZXMiO3M6MTc6InN0YXRlX3BsYWNlaG9sZGVyIjtzOjIzOiJwYXIrZXhlbXBsZS4rQ2FsaWZvcm5pZSI7czo5OiJwYXl1bW9uZXkiO3M6MTA6IitQYXlVbW9uZXkiO3M6MTM6InNhbWVfYXNfYWJvdmUiO3M6MTU6IkNvbW1lK2NpLWRlc3N1cyI7czozOiJzdW4iO3M6NjoiU29sZWlsIjtzOjM6Im1vbiI7czozOiJMdW4iO3M6MzoidHVlIjtzOjM6Ik1hciI7czozOiJ3ZWQiO3M6MzoiTWVyIjtzOjM6InRodSI7czozOiJKZXUiO3M6MzoiZnJpIjtzOjM6IlZlbiI7czozOiJzYXQiO3M6MzoiU2FtIjtzOjI6InN1IjtzOjU6IlZvdHJlIjtzOjI6Im1vIjtzOjQ6IlZvdXMiO3M6MjoidHUiO3M6NDoiVm91cyI7czoyOiJ3ZSI7czo0OiJub3VzIjtzOjI6InRoIjtzOjI6IlRoIjtzOjI6ImZyIjtzOjM6IitGciI7czoyOiJzYSI7czo0OiJlbGxlIjtzOjExOiJteV9ib29raW5ncyI7czoyMToiTWVzK3IlQzMlQTlzZXJ2YXRpb25zIjtzOjE2OiJ5b3VyX3Bvc3RhbF9jb2RlIjtzOjExOiJDb2RlK1Bvc3RhbCI7czo0Mjoid2hlcmVfd291bGRfeW91X2xpa2VfdXNfdG9fcHJvdmlkZV9zZXJ2aWNlIjtzOjU3OiJPJUMzJUI5K2FpbWVyaWV6LXZvdXMrcXVlK25vdXMrZm91cm5pc3Npb25zK2xlK3NlcnZpY2UlM0YiO3M6MTQ6ImNob29zZV9zZXJ2aWNlIjtzOjIxOiJDaG9pc2lzc2V6K2xlK3NlcnZpY2UiO3M6NDM6Imhvd19vZnRlbl93b3VsZF95b3VfbGlrZV91c19wcm92aWRlX3NlcnZpY2UiO3M6ODA6IislQzMlODArcXVlbGxlK2ZyJUMzJUE5cXVlbmNlK3NvdWhhaXRlei12b3VzK3F1ZStub3VzK2ZvdXJuaXNzaW9ucyt1bitzZXJ2aWNlJTNGIjtzOjMwOiJ3aGVuX3dvdWxkX3lvdV9saWtlX3VzX3RvX2NvbWUiO3M6Mzk6IlF1YW5kK3ZvdWRyaWV6LXZvdXMrcXVlK25vdXMrdmVuaW9ucyUzRiI7czo1OiJ0b2RheSI7czoxMzoiQVVKT1VSRCUyN0hVSSI7czoyMToieW91cl9wZXJzb25hbF9kZXRhaWxzIjtzOjMwOiIrVm9zK2luZm9ybWF0aW9ucytwZXJzb25uZWxsZXMiO3M6MTM6ImV4aXN0aW5nX3VzZXIiO3M6MjA6IlV0aWxpc2F0ZXVyK2V4aXN0YW50IjtzOjg6Im5ld191c2VyIjtzOjE4OiJOb3V2ZWwrdXRpbGlzYXRldXIiO3M6MTU6InByZWZlcnJlZF9lbWFpbCI7czoyODoiRW1haWwrcHIlQzMlQTlmJUMzJUE5ciVDMyVBOSI7czoxODoicHJlZmVycmVkX3Bhc3N3b3JkIjtzOjM1OiJNb3QrZGUrcGFzc2UrcHIlQzMlQTlmJUMzJUE5ciVDMyVBOSI7czoyNDoieW91cl92YWxpZF9lbWFpbF9hZGRyZXNzIjtzOjI2OiJWb3RyZSthZHJlc3NlK2VtYWlsK3ZhbGlkZSI7czoxMDoiZmlyc3RfbmFtZSI7czoxMToiUHIlQzMlQTlub20iO3M6MTU6InlvdXJfZmlyc3RfbmFtZSI7czoxNjoiK1RvbitwciVDMyVBOW5vbSI7czo5OiJsYXN0X25hbWUiO3M6MTQ6Ik5vbStkZStmYW1pbGxlIjtzOjE0OiJ5b3VyX2xhc3RfbmFtZSI7czoyMDoiVm90cmUrbm9tK2RlK2ZhbWlsbGUiO3M6MTQ6InN0cmVldF9hZGRyZXNzIjtzOjE0OiJBZHJlc3NlK2RlK3J1ZSI7czoxNjoiY2xlYW5pbmdfc2VydmljZSI7czoyMToiK1NlcnZpY2UrZGUrbmV0dG95YWdlIjtzOjIwOiJwbGVhc2Vfc2VsZWN0X21ldGhvZCI7czo0MzoiVmV1aWxsZXorcyVDMyVBOWxlY3Rpb25uZXIrdW5lK20lQzMlQTl0aG9kZSI7czo4OiJ6aXBfY29kZSI7czoxMToiQ29kZStwb3N0YWwiO3M6NDoiY2l0eSI7czo1OiJWaWxsZSI7czo1OiJzdGF0ZSI7czo0OiJFdGF0IjtzOjIyOiJzcGVjaWFsX3JlcXVlc3RzX25vdGVzIjtzOjM2OiIrRGVtYW5kZXMrc3AlQzMlQTljaWFsZXMrJTI4Tm90ZXMlMjkiO3M6Mjg6ImRvX3lvdV9oYXZlX2FfdmFjY3VtX2NsZWFuZXIiO3M6Mjc6IitBdmV6LXZvdXMrdW4rYXNwaXJhdGV1ciUzRiI7czoyNzoiYXNzaWduX2FwcG9pbnRtZW50X3RvX3N0YWZmIjtzOjM4OiIrQXR0cmlidWVyK3VuK3JlbmRlei12b3VzK2F1K3BlcnNvbm5lbCI7czoxMzoiZGVsZXRlX21lbWJlciI7czoyMzoiK1N1cHByaW1lcit1bittZW1icmUlM0YiO3M6MzoieWVzIjtzOjQ6IitPdWkiO3M6Mjoibm8iO3M6MzoiTm9uIjtzOjI0OiJwcmVmZXJyZWRfcGF5bWVudF9tZXRob2QiO3M6NDg6Ik0lQzMlQTl0aG9kZStkZStwYWllbWVudCtwciVDMyVBOWYlQzMlQTlyJUMzJUE5ZSI7czozMjoicGxlYXNlX3NlbGVjdF9vbmVfcGF5bWVudF9tZXRob2QiO3M6NDc6IitWZXVpbGxleitzJUMzJUE5bGVjdGlvbm5lcit1bittb2RlK2RlK3BhaWVtZW50IjtzOjE1OiJwYXJ0aWFsX2RlcG9zaXQiO3M6MjM6IkQlQzMlQTlwJUMzJUI0dCtwYXJ0aWVsIjtzOjE2OiJyZW1haW5pbmdfYW1vdW50IjtzOjE1OiJNb250YW50K3Jlc3RhbnQiO3M6NDY6InBsZWFzZV9yZWFkX291cl90ZXJtc19hbmRfY29uZGl0aW9uc19jYXJlZnVsbHkiO3M6Njc6IitTJTI3aWwrdm91cytwbGElQzMlQUV0K2xpcmUrYXR0ZW50aXZlbWVudCtub3MrdGVybWVzK2V0K2NvbmRpdGlvbnMiO3M6MTk6ImRvX3lvdV9oYXZlX3BhcmtpbmciO3M6MjQ6IitBdmV6LXZvdXMrdW4rcGFya2luZyUzRiI7czoxODoiaG93X3dpbGxfd2VfZ2V0X2luIjtzOjMwOiIrQ29tbWVudCthbGxvbnMtbm91cytlbnRyZXIlM0YiO3M6MTc6Imlfd2lsbF9iZV9hdF9ob21lIjtzOjI2OiIrSmUrc2VyYWkrJUMzJUEwK2xhK21haXNvbiI7czoxNDoicGxlYXNlX2NhbGxfbWUiO3M6Mjc6IlMlMjdpbCt0ZStwbGFpdCthcHBlbGxlK21vaSI7czo1NzoicmVjdXJyaW5nX2Rpc2NvdW50c19hcHBseV9mcm9tX3RoZV9zZWNvbmRfY2xlYW5pbmdfb253YXJkIjtzOjg5OiIrRGVzK3IlQzMlQTlkdWN0aW9ucytyJUMzJUE5Y3VycmVudGVzK3MlMjdhcHBsaXF1ZW50K2QlQzMlQThzK2xlK2RldXhpJUMzJUE4bWUrbmV0dG95YWdlLiI7czo0NzoicGxlYXNlX3Byb3ZpZGVfeW91cl9hZGRyZXNzX2FuZF9jb250YWN0X2RldGFpbHMiO3M6NTU6IlZldWlsbGV6K2luZGlxdWVyK3ZvdHJlK2FkcmVzc2UrZXQrdm9zK2Nvb3Jkb25uJUMzJUE5ZXMiO3M6MjA6InlvdV9hcmVfbG9nZ2VkX2luX2FzIjtzOjQwOiJWb3VzKyVDMyVBQXRlcytjb25uZWN0JUMzJUE5K2VuK3RhbnQrcXVlIjtzOjI3OiJ0aGVfa2V5X2lzX3dpdGhfdGhlX2Rvb3JtYW4iO3M6MzE6IkxhK2NsJUMzJUE5K2VzdCthdmVjK2xlK3BvcnRpZXIiO3M6NToib3RoZXIiO3M6NToiQXV0cmUiO3M6MTY6ImhhdmVfYV9wcm9tb2NvZGUiO3M6Mzk6IitBdmV6K3ZvdXMrdW4rY29kZStkZStyJUMzJUE5ZHVjdGlvbiUzRiI7czo1OiJhcHBseSI7czoxMDoiK0FwcGxpcXVlciI7czoxNzoiYXBwbGllZF9wcm9tb2NvZGUiO3M6MjQ6IitQcm9tb2NvZGUrYXBwbGlxdSVDMyVBOSI7czoxNjoiY29tcGxldGVfYm9va2luZyI7czozMToiK1IlQzMlQTlzZXJ2YXRpb24rY29tcGwlQzMlQTh0ZSI7czoxOToiY2FuY2VsbGF0aW9uX3BvbGljeSI7czoyNToiK1BvbGl0aXF1ZStkJTI3YW5udWxhdGlvbiI7czoyNjoiY2FuY2VsbGF0aW9uX3BvbGljeV9oZWFkZXIiO3M6NDM6IkVuLXQlQzMlQUF0ZStkZStsYStwb2xpdGlxdWUrZCUyN2FubnVsYXRpb24iO3M6Mjg6ImNhbmNlbGxhdGlvbl9wb2xpY3lfdGV4dGFyZWEiO3M6MzM6IlBvbGl0aXF1ZStkJTI3YW5udWxhdGlvbitUZXh0YXJlYSI7czozNToiZnJlZV9jYW5jZWxsYXRpb25fYmVmb3JlX3JlZGVtcHRpb24iO3M6NDM6IitBbm51bGF0aW9uK2dyYXR1aXRlK2F2YW50K2xlK3JlbWJvdXJzZW1lbnQiO3M6OToic2hvd19tb3JlIjtzOjExOiJNb250cmUrcGx1cyI7czoyMToicGxlYXNlX3NlbGVjdF9zZXJ2aWNlIjtzOjM3OiJWZXVpbGxleitzJUMzJUE5bGVjdGlvbm5lcit1bitzZXJ2aWNlIjtzOjM3OiJjaG9vc2VfeW91cl9zZXJ2aWNlX2FuZF9wcm9wZXJ0eV9zaXplIjtzOjYzOiJDaG9pc2lzc2V6K3ZvdHJlK3NlcnZpY2UrZXQrbGErdGFpbGxlK2RlK2xhK3Byb3ByaSVDMyVBOXQlQzMlQTkiO3M6MTk6ImNob29zZV95b3VyX3NlcnZpY2UiO3M6MjQ6IkNob2lzaXNzZXordm90cmUrc2VydmljZSI7czo2ODoicGxlYXNlX2NvbmZpZ3VyZV9maXJzdF9jbGVhbmluZ19zZXJ2aWNlc19hbmRfc2V0dGluZ3NfaW5fYWRtaW5fcGFuZWwiO3M6MTEzOiJWZXVpbGxleitjb25maWd1cmVyK2QlMjdhYm9yZCtsZXMrc2VydmljZXMrZGUrbmV0dG95YWdlK2V0K2xlcytwYXJhbSVDMyVBOHRyZXMrZGFucytsZStwYW5uZWF1K2QlMjdhZG1pbmlzdHJhdGlvbiI7czoyODoiaV9oYXZlX3JlYWRfYW5kX2FjY2VwdGVkX3RoZSI7czoyOToiK0olMjdhaStsdStldCthY2NlcHQlQzMlQTkrbGUiO3M6MTk6InRlcm1zX2FuZF9jb25kaXRpb24iO3M6MjE6Iit0ZXJtZXMrZXQrY29uZGl0aW9ucyI7czozOiJhbmQiO3M6MzoiK2V0IjtzOjE0OiJ1cGRhdGVkX2xhYmVscyI7czozMzoiJUMzJTg5dGlxdWV0dGVzK21pc2VzKyVDMyVBMCtqb3VyIjtzOjE0OiJwcml2YWN5X3BvbGljeSI7czozMzoiUG9saXRpcXVlK2RlK2NvbmZpZGVudGlhbGl0JUMzJUE5IjtzOjczOiJwbGVhc2VfZmlsbF9hbGxfdGhlX2NvbXBhbnlfaW5mb3JtYXRpb25zX2FuZF9hZGRfc29tZV9zZXJ2aWNlc19hbmRfYWRkb25zIjtzOjU2OiIrTGVzK2NvbmZpZ3VyYXRpb25zK3JlcXVpc2VzK25lK3NvbnQrcGFzK3Rlcm1pbiVDMyVBOWVzLiI7czoxNToiYm9va2luZ19zdW1tYXJ5IjtzOjM5OiJSJUMzJUE5c3VtJUMzJUE5K2RlK2xhK3IlQzMlQTlzZXJ2YXRpb24iO3M6MTA6InlvdXJfZW1haWwiO3M6MTE6IlZvdHJlK0VtYWlsIjtzOjIwOiJlbnRlcl9lbWFpbF90b19sb2dpbiI7czozNzoiK0VudHJleit1bitlLW1haWwrcG91cit2b3VzK2Nvbm5lY3RlciI7czoxMzoieW91cl9wYXNzd29yZCI7czoxOToiK1ZvdHJlK21vdCtkZStwYXNzZSI7czoxOToiZW50ZXJfeW91cl9wYXNzd29yZCI7czoyNToiK1RhcGV6K3ZvdHJlK21vdCtkZStwYXNzZSI7czoxNToiZm9yZ2V0X3Bhc3N3b3JkIjtzOjI4OiIrTW90K2RlK3Bhc3NlK291YmxpJUMzJUE5JTNGIjtzOjE0OiJyZXNldF9wYXNzd29yZCI7czozNDoiciVDMyVBOWluaXRpYWxpc2VyK2xlK21vdCtkZStwYXNzZSI7czo3MjoiZW50ZXJfeW91cl9lbWFpbF9hbmRfd2Vfc2VuZF95b3VfaW5zdHJ1Y3Rpb25zX29uX3Jlc2V0dGluZ195b3VyX3Bhc3N3b3JkIjtzOjEwMzoiK0VudHJleit2b3RyZStlbWFpbCtldCtub3VzK3ZvdXMrZW52ZXJyb25zK2RlcytpbnN0cnVjdGlvbnMrcG91cityJUMzJUE5aW5pdGlhbGlzZXIrdm90cmUrbW90K2RlK3Bhc3NlLiI7czoxNjoicmVnaXN0ZXJlZF9lbWFpbCI7czoyMjoiK0VtYWlsK2VucmVnaXN0ciVDMyVBOSI7czo5OiJzZW5kX21haWwiO3M6MTY6IitFbnZveWVyK3VuK21haWwiO3M6MTM6ImJhY2tfdG9fbG9naW4iO3M6MTY6IlJldG91citjb25uZXhpb24iO3M6NDoieW91ciI7czo1OiJWb3RyZSI7czoxNjoieW91cl9jbGVhbl9pdGVtcyI7czoyMToiK1ZvcythcnRpY2xlcytwcm9wcmVzIjtzOjE4OiJ5b3VyX2NhcnRfaXNfZW1wdHkiO3M6MjI6IitWb3RyZStwYW5pZXIrZXN0K3ZpZGUiO3M6MTI6InN1Yl90b3RhbHRheCI7czoxNDoiK1RvdGFsK3BhcnRpZWwiO3M6OToic3ViX3RvdGFsIjtzOjEwOiJTb3VzK3RvdGFsIjtzOjI2OiJub19kYXRhX2F2YWlsYWJsZV9pbl90YWJsZSI7czozMDoiK2F1Y3VuZStkb25uJUMzJUE5ZStkaXNwb25pYmxlIjtzOjU6InRvdGFsIjtzOjY6IitUb3RhbCI7czoyOiJvciI7czoyOiJPdSI7czoxODoic2VsZWN0X2FkZG9uX2ltYWdlIjtzOjM0OiIrUyVDMyVBOWxlY3Rpb25uZXorbCUyN2ltYWdlK2FkZG9uIjtzOjEzOiJpbnNpZGVfZnJpZGdlIjtzOjM5OiIrUiVDMyVBOWZyaWclQzMlQTlyYXRldXIraW50JUMzJUE5cmlldXIiO3M6MTE6Imluc2lkZV9vdmVuIjtzOjIwOiIrRm91citpbnQlQzMlQTlyaWV1ciI7czoxNDoiaW5zaWRlX3dpbmRvd3MiO3M6MTM6IitEYW5zK1dpbmRvd3MiO3M6MTU6ImNhcnBldF9jbGVhbmluZyI7czoxOToiK05ldHRveWFnZStkZSt0YXBpcyI7czoxNDoiZ3JlZW5fY2xlYW5pbmciO3M6MTU6IitOZXR0b3lhZ2UrdmVydCI7czo5OiJwZXRzX2NhcmUiO3M6MjE6IitBbmltYXV4K2RlK2NvbXBhZ25pZSI7czoxNDoidGlsZXNfY2xlYW5pbmciO3M6MjE6Ik5ldHRveWFnZStkZStjYXJyZWF1eCI7czoxMzoid2FsbF9jbGVhbmluZyI7czoxODoiTmV0dG95YWdlK2RlcyttdXJzIjtzOjc6ImxhdW5kcnkiO3M6MTM6IkJsYW5jaGlzc2VyaWUiO3M6MTc6ImJhc2VtZW50X2NsZWFuaW5nIjtzOjIyOiIrTmV0dG95YWdlK2RlK3NvdXMtc29sIjtzOjExOiJiYXNpY19wcmljZSI7czozMDoiUHJpeCslRTIlODAlOEIlRTIlODAlOEJkZStiYXNlIjtzOjc6Im1heF9xdHkiO3M6MjE6IlF1YW50aXQlQzMlQTkrbWF4aW11bSI7czoxMjoibXVsdGlwbGVfcXR5IjtzOjIyOiJRdWFudGl0JUMzJUE5K211bHRpcGxlIjtzOjEwOiJiYXNlX3ByaWNlIjtzOjMwOiJQcml4KyVFMiU4MCU4QiVFMiU4MCU4QmRlK2Jhc2UiO3M6MTI6InVuaXRfcHJpY2luZyI7czozMjoiK1ByaXgrJUUyJTgwJThCJUUyJTgwJThCdW5pdGFpcmUiO3M6MTY6Im1ldGhvZF9pc19ib29rZWQiO3M6Mzk6IitMYSttJUMzJUE5dGhvZGUrZXN0K3IlQzMlQTlzZXJ2JUMzJUE5ZSI7czoyNjoic2VydmljZV9hZGRvbnNfcHJpY2VfcnVsZXMiO3M6MzU6IitSJUMzJUE4Z2xlcytkZStwcml4K1NlcnZpY2UrQWRkb25zIjtzOjMyOiJzZXJ2aWNlX3VuaXRfZnJvbnRfZHJvcGRvd25fdmlldyI7czo0MToiVW5pdCVDMyVBOStkZStzZXJ2aWNlK0Zyb250K0Ryb3BEb3duK1ZpZXciO3M6Mjk6InNlcnZpY2VfdW5pdF9mcm9udF9ibG9ja192aWV3IjtzOjM5OiIrVnVlK2F2YW50K2RlK2wlMjd1bml0JUMzJUE5K2RlK3NlcnZpY2UiO3M6NDE6InNlcnZpY2VfdW5pdF9mcm9udF9pbmNyZWFzZV9kZWNyZWFzZV92aWV3IjtzOjcyOiJBdWdtZW50YXRpb24rJTJGK2RpbWludXRpb24rZGUrbGErdnVlK2F2YW50K2RlK2wlMjd1bml0JUMzJUE5K2RlK3NlcnZpY2UiO3M6MTI6ImFyZV95b3Vfc3VyZSI7czoyNDoiKyVDMyU4QXRlcy12b3VzK3MlQzMlQkJyIjtzOjI0OiJzZXJ2aWNlX3VuaXRfcHJpY2VfcnVsZXMiO3M6NDE6IitSJUMzJUE4Z2xlcytkZStwcml4K3VuaXRhaXJlcytkZStzZXJ2aWNlIjtzOjU6ImNsb3NlIjtzOjY6IkZlcm1lciI7czo2OiJjbG9zZWQiO3M6MTE6IitGZXJtJUMzJUE5IjtzOjE0OiJzZXJ2aWNlX2FkZG9ucyI7czoxNzoiQWRkb25zK2RlK3NlcnZpY2UiO3M6MTQ6InNlcnZpY2VfZW5hYmxlIjtzOjIwOiIrU2VydmljZSthY3RpdiVDMyVBOSI7czoxNToic2VydmljZV9kaXNhYmxlIjtzOjI2OiJEJUMzJUE5c2FjdGl2ZXIrbGUrc2VydmljZSI7czoxMzoibWV0aG9kX2VuYWJsZSI7czoyMToiK00lQzMlQTl0aG9kZStBY3RpdmVyIjtzOjE2OiJvZmZfdGltZV9kZWxldGVkIjtzOjM1OiJIZXVyZStkJTI3YXJyJUMzJUFBdCtzdXBwcmltJUMzJUE5ZSI7czoyNzoiZXJyb3JfaW5fZGVsZXRlX29mX29mZl90aW1lIjtzOjU4OiIrRXJyZXVyK2xvcnMrZGUrbGErc3VwcHJlc3Npb24rZGUrbCUyN2hldXJlK2QlMjdhcnIlQzMlQUF0IjtzOjE0OiJtZXRob2RfZGlzYWJsZSI7czoyODoiTSVDMyVBOXRob2RlK0QlQzMlQTlzYWN0aXZlciI7czoxNDoiZXh0cmFfc2VydmljZXMiO3M6MzA6IitTZXJ2aWNlcytzdXBwbCVDMyVBOW1lbnRhaXJlcyI7czo1OToiZm9yX2luaXRpYWxfY2xlYW5pbmdfb25seV9jb250YWN0X3VzX3RvX2FwcGx5X3RvX3JlY3VycmluZ3MiO3M6ODg6IitQb3VyK2xlK25ldHRveWFnZStpbml0aWFsK3NldWxlbWVudC4rQ29udGFjdGV6LW5vdXMrcG91citwb3N0dWxlcithdXgrciVDMyVBOWN1cnJlbmNlcy4iO3M6OToibnVtYmVyX29mIjtzOjk6Ik5vbWJyZStkZSI7czoyODoiZXh0cmFfc2VydmljZXNfbm90X2F2YWlsYWJsZSI7czo0NToiU2VydmljZXMrc3VwcGwlQzMlQTltZW50YWlyZXMrbm9uK2Rpc3BvbmlibGVzIjtzOjk6ImF2YWlsYWJsZSI7czoxMDoiRGlzcG9uaWJsZSI7czo4OiJzZWxlY3RlZCI7czo2OiJDaG9pc2kiO3M6MTM6Im5vdF9hdmFpbGFibGUiO3M6MTI6IkluZGlzcG9uaWJsZSI7czo0OiJub25lIjtzOjU6IkF1Y3VuIjtzOjU0OiJub25lX29mX3RpbWVfc2xvdF9hdmFpbGFibGVfcGxlYXNlX2NoZWNrX2Fub3RoZXJfZGF0ZXMiO3M6NzE6IitBdWN1bitjciVDMyVBOW5lYXUraG9yYWlyZStkaXNwb25pYmxlK1ZldWlsbGV6K2NvY2hlcitkJTI3YXV0cmVzK2RhdGVzIjtzOjQ2OiJhdmFpbGFiaWxpdHlfaXNfbm90X2NvbmZpZ3VyZWRfZnJvbV9hZG1pbl9zaWRlIjtzOjc0OiIrTGErZGlzcG9uaWJpbGl0JUMzJUE5K24lMjdlc3QrcGFzK2NvbmZpZ3VyJUMzJUE5ZStkdStjJUMzJUI0dCVDMyVBOSthZG1pbiI7czoxODoiaG93X21hbnlfaW50ZW5zaXZlIjtzOjE3OiIrQ29tYmllbitJbnRlbnNpZiI7czoxMjoibm9faW50ZW5zaXZlIjtzOjEyOiJOb24rSW50ZW5zaWYiO3M6MTk6ImZyZXF1ZW50bHlfZGlzY291bnQiO3M6MTQ6IkZvaXJlK2VzY29tcHRlIjtzOjE1OiJjb3Vwb25fZGlzY291bnQiO3M6MTM6IkNvdXBvbitSYWJhaXMiO3M6ODoiaG93X21hbnkiO3M6NzoiQ29tYmllbiI7czoyMzoiZW50ZXJfeW91cl9vdGhlcl9vcHRpb24iO3M6MjU6IkVudHJleit2b3RyZSthdXRyZStvcHRpb24iO3M6NzoibG9nX291dCI7czoxNToiQ29ubmVjdGV6Ky0rT3V0IjtzOjIwOiJ5b3VyX2FkZGVkX29mZl90aW1lcyI7czozNzoiVm9zK3RlbXBzK2QlMjdhcnIlQzMlQUF0K2Fqb3V0JUMzJUE5cyI7czo2OiJsb2dfaW4iO3M6MTQ6InMlMjdpZGVudGlmaWVyIjtzOjEwOiJjdXN0b21fY3NzIjtzOjIxOiJDU1MrcGVyc29ubmFsaXMlQzMlQTkiO3M6Nzoic3VjY2VzcyI7czoxMToiU3VjYyVDMyVBOHMiO3M6NzoiZmFpbHVyZSI7czoxMDoiJUMzJTg5Y2hlYyI7czozMDoieW91X2Nhbl9vbmx5X3VzZV92YWxpZF96aXBjb2RlIjtzOjUzOiJWb3VzK3BvdXZleit1bmlxdWVtZW50K3V0aWxpc2VyK3VuK2NvZGUrcG9zdGFsK3ZhbGlkZSI7czo3OiJtaW51dGVzIjtzOjc6Ik1pbnV0ZXMiO3M6NToiaG91cnMiO3M6NjoiSGV1cmVzIjtzOjQ6ImRheXMiO3M6MTM6IkpvdXJuJUMzJUE5ZXMiO3M6NjoibW9udGhzIjtzOjQ6Ik1vaXMiO3M6NDoieWVhciI7czoyOiJBbiI7czoxNDoiZGVmYXVsdF91cmxfaXMiO3M6Mjg6IitMJTI3VVJMK3BhcitkJUMzJUE5ZmF1dCtlc3QiO3M6MTI6ImNhcmRfcGF5bWVudCI7czoxODoiUGFpZW1lbnQrcGFyK2NhcnRlIjtzOjEyOiJwYXlfYXRfdmVudWUiO3M6MTU6IlBheWVyK3N1citwbGFjZSI7czoxMjoiY2FyZF9kZXRhaWxzIjtzOjI0OiJEJUMzJUE5dGFpbHMrZGUrbGErY2FydGUiO3M6MTE6ImNhcmRfbnVtYmVyIjtzOjIwOiJOdW0lQzMlQTlybytkZStjYXJ0ZSI7czoxOToiaW52YWxpZF9jYXJkX251bWJlciI7czozMDoiK251bSVDMyVBOXJvK2RlK2NhcnRlK2ludmFsaWRlIjtzOjY6ImV4cGlyeSI7czoxMDoiRXhwaXJhdGlvbiI7czoxNDoiYnV0dG9uX3ByZXZpZXciO3M6MjE6IkFwZXIlQzMlQTd1K2R1K2JvdXRvbiI7czo4OiJ0aGFua3lvdSI7czoxNjoiSmUrdm91cytyZW1lcmNpZSI7czozMjoidGhhbmt5b3VfZm9yX2Jvb2tpbmdfYXBwb2ludG1lbnQiO3M6NDQ6IkplK3ZvdXMrcmVtZXJjaWUlMjErcG91citwcmVuZHJlK3JlbmRlei12b3VzIjtzOjU3OiJ5b3Vfd2lsbF9iZV9ub3RpZmllZF9ieV9lbWFpbF93aXRoX2RldGFpbHNfb2ZfYXBwb2ludG1lbnQiO3M6NjQ6IlZvdXMrc2VyZXorYXZlcnRpK3BhcitlbWFpbCthdmVjK2xlcytkJUMzJUE5dGFpbHMrZHUrcmVuZGV6LXZvdXMiO3M6MjI6InBsZWFzZV9lbnRlcl9maXJzdG5hbWUiO3M6NDU6IitTJTI3aWwrdm91cytwbGElQzMlQUV0K2VudHJlcitsZStwciVDMyVBOW5vbSI7czoyMToicGxlYXNlX2VudGVyX2xhc3RuYW1lIjtzOjMzOiJWZXVpbGxleitlbnRyZXIrbGUrbm9tK2RlK2ZhbWlsbGUiO3M6MjE6InJlbW92ZV9hcHBsaWVkX2NvdXBvbiI7czozMzoiU3VwcHJpbWVyK2xlK2NvdXBvbithcHBsaXF1JUMzJUE5IjtzOjI1OiJlZ183OTlfZV9kcmFncmFtX3N1aXRlXzVhIjtzOjM1OiIrcGFyK2V4ZW1wbGUrNzk5K0UrRFJBR1JBTStTVUlURSs1QSI7czo4OiJlZ18xNDExNCI7czoxOToiK3BhcitleGVtcGxlLisxNDExNCI7czo5OiJlZ190dWNzb24iO3M6MjA6IitwYXIrZXhlbXBsZS4rVFVDU09OIjtzOjU6ImVnX2F6IjtzOjE1OiJwYXIrZXhlbXBsZS4rTEEiO3M6Nzoid2FybmluZyI7czoxMDoiK0F0dGVudGlvbiI7czo5OiJ0cnlfbGF0ZXIiO3M6MTg6IitFc3NheWVyK3BsdXMrdGFyZCI7czoxMToiY2hvb3NlX3lvdXIiO3M6MTA6IkNob2lzaSt0b24iO3M6MTc6ImNvbmZpZ3VyZV9ub3dfbmV3IjtzOjIxOiJDb25maWd1cmVyK21haW50ZW5hbnQiO3M6NzoiamFudWFyeSI7czo3OiJKQU5WSUVSIjtzOjg6ImZlYnJ1YXJ5IjtzOjEyOiJGJUMzJTg5VlJJRVIiO3M6NToibWFyY2giO3M6NDoiTUFSUyI7czo1OiJhcHJpbCI7czo1OiJBVlJJTCI7czozOiJtYXkiO3M6NDoiK01BSSI7czo0OiJqdW5lIjtzOjQ6IkpVSU4iO3M6NDoianVseSI7czo3OiJKVUlMTEVUIjtzOjY6ImF1Z3VzdCI7czo5OiJBTyVDMyU5QlQiO3M6OToic2VwdGVtYmVyIjtzOjk6IlNFUFRFTUJSRSI7czo3OiJvY3RvYmVyIjtzOjc6Ik9DVE9CUkUiO3M6ODoibm92ZW1iZXIiO3M6ODoiTk9WRU1CUkUiO3M6ODoiZGVjZW1iZXIiO3M6MTM6IkQlQzMlODlDRU1CUkUiO3M6MzoiamFuIjtzOjM6IkpBTiI7czozOiJmZWIiO3M6ODoiRiVDMyU4OVYiO3M6MzoibWFyIjtzOjM6Ik1BUiI7czozOiJhcHIiO3M6MzoiQVZSIjtzOjM6Imp1biI7czozOiJKVU4iO3M6MzoianVsIjtzOjQ6IkpVSUwiO3M6MzoiYXVnIjtzOjM6IkFVRyI7czozOiJzZXAiO3M6MzoiU0VQIjtzOjM6Im9jdCI7czozOiJPQ1QiO3M6Mzoibm92IjtzOjM6Ik5PViI7czozOiJkZWMiO3M6ODoiRCVDMyU4OUMiO3M6MTE6InBheV9sb2NhbGx5IjtzOjE2OiJQYXllcitsb2NhbGVtZW50IjtzOjIyOiJwbGVhc2Vfc2VsZWN0X3Byb3ZpZGVyIjtzOjQxOiJWZXVpbGxleitzJUMzJUE5bGVjdGlvbm5lcit1bitmb3Vybmlzc2V1ciI7fQ==', 'fr_FR', 'YTo2NzA6e3M6NDoiZXdheSI7czo0OiJFd2F5IjtzOjEyOiJoYWxmX3NlY3Rpb24iO3M6MTM6IitEZW1pLXNlY3Rpb24iO3M6MTI6Im9wdGlvbl90aXRsZSI7czoyMDoiK1RpdHJlK2RlK2wlMjdvcHRpb24iO3M6MTE6Im1lcmNoYW50X0lEIjtzOjE0OiJJRCtkdSttYXJjaGFuZCI7czoxMjoiSG93X2l0X3dvcmtzIjtzOjI1OiJDb21tZW50KyVDMyVBN2ErbWFyY2hlJTNGIjtzOjYwOiJZb3VyX2N1cnJlbmN5X3Nob3VsZF9iZV9BVURfdG9fZW5hYmxlX3BheXdheV9wYXltZW50X2dhdGV3YXkiO3M6OTE6IlZvdHJlK2RldmlzZStkb2l0KyVDMyVBQXRyZStEb2xsYXIrQXVzdHJhbGllbitwb3VyK2FjdGl2ZXIrbGErcGFzc2VyZWxsZStkZStwYWllbWVudCtQYXl3YXkiO3M6MTA6InNlY3VyZV9rZXkiO3M6Mjg6IkNsJUMzJUE5K3MlQzMlQTljdXJpcyVDMyVBOWUiO3M6NjoicGF5d2F5IjtzOjc6IitQYXl3YXkiO3M6Nzg6IllvdXJfR29vZ2xlX2NhbGVuZGFyX2lkX3doZXJlX3lvdV9uZWVkX3RvX2dldF9hbGVydHNfaXRzX25vcm1hbHlfeW91cl9HbWFpbF9JRCI7czoxNjI6IitWb3RyZStpZGVudGlmaWFudCtkJTI3YWdlbmRhK0dvb2dsZSUyQytvJUMzJUI5K3ZvdXMrZGV2ZXorcmVjZXZvaXIrZGVzK2FsZXJ0ZXMlMkMrYyUyN2VzdCtub3JtYWxlbWVudCt2b3RyZStpZGVudGlmaWFudCtHbWFpbC4rcGFyK2V4ZW1wbGUuK2pvaG5kb2UlNDBleGFtcGxlLmNvbSI7czo2MDoiWW91X2Nhbl9nZXRfeW91cl9jbGllbnRfSURfZnJvbV95b3VyX0dvb2dsZV9DYWxlbmRhcl9Db25zb2xlIjtzOjcwOiJWb3VzK3BvdXZleitvYnRlbmlyK3ZvdHJlK0lEK2NsaWVudCtkZXB1aXMrdm90cmUrY29uc29sZStHb29nbGUrQWdlbmRhIjtzOjY0OiJZb3VfY2FuX2dldF95b3VyX2NsaWVudF9zZWNyZXRfZnJvbV95b3VyX0dvb2dsZV9DYWxlbmRhcl9Db25zb2xlIjtzOjkxOiIrVm91cytwb3V2ZXorb2J0ZW5pcitsZStzZWNyZXQrZGUrdm90cmUrY2xpZW50KyVDMyVBMCtwYXJ0aXIrZGUrdm90cmUrY29uc29sZStHb29nbGUrQWdlbmRhIjtzOjM4OiJpdHNfeW91cl9DbGVhbnRvX2Jvb2tpbmdfZm9ybV9wYWdlX3VybCI7czoxMTQ6IitzYStwYWdlK2RlK2Zvcm11bGFpcmUrZGUrciVDMyVBOXNlcnZhdGlvbitDbGVhbnRvK3VybGl0cyt2b3RyZStwYWdlK2RlK2Zvcm11bGFpcmUrZGUrciVDMyVBOXNlcnZhdGlvbitDbGVhbnRvK3VybCI7czo0MToiSXRzX3lvdXJfQ2xlYW50b19Hb29nbGVfU2V0dGluZ3NfcGFnZV91cmwiO3M6MzA6IkMlMjdlc3QrbCUyN1VSTCtkZSt2b3RyZStwYWdlKyI7czoxODoiQWRkX01hbnVhbF9ib29raW5nIjtzOjM4OiIrQWpvdXRlcit1bmUrciVDMyVBOXNlcnZhdGlvbittYW51ZWxsZSI7czoyNDoiR29vZ2xlX0NhbGVuZGVyX1NldHRpbmdzIjtzOjMyOiIrUGFyYW0lQzMlQTh0cmVzK0dvb2dsZStDYWxlbmRlciI7czozNToiQWRkX0FwcG9pbnRtZW50c19Ub19Hb29nbGVfQ2FsZW5kZXIiO3M6NDQ6IkFqb3V0ZXIrZGVzK3JlbmRlei12b3VzKyVDMyVBMCtHb29nbGUrQWdlbmRhIjtzOjE4OiJHb29nbGVfQ2FsZW5kZXJfSWQiO3M6Mjg6IitJZGVudGlmaWFudCtHb29nbGUrQ2FsZW5kZXIiO3M6MjU6Ikdvb2dsZV9DYWxlbmRlcl9DbGllbnRfSWQiO3M6NDI6IitDbGllbnQrZCUyN2lkZW50aWZpY2F0aW9uK0dvb2dsZStDYWxlbmRlciI7czoyOToiR29vZ2xlX0NhbGVuZGVyX0NsaWVudF9TZWNyZXQiO3M6MzA6IitTZWNyZXQrY2xpZW50K0dvb2dsZStDYWxlbmRlciI7czoyODoiR29vZ2xlX0NhbGVuZGVyX0Zyb250ZW5kX1VSTCI7czozMToiVVJMK0Zyb250ZW5kK2RlK0dvb2dsZStDYWxlbmRlciI7czoyNToiR29vZ2xlX0NhbGVuZGVyX0FkbWluX1VSTCI7czo0NToiK1VSTCtkZStsJTI3YWRtaW5pc3RyYXRldXIrZGUrR29vZ2xlK0NhbGVuZGVyIjtzOjI5OiJHb29nbGVfQ2FsZW5kZXJfQ29uZmlndXJhdGlvbiI7czozMToiK0NvbmZpZ3VyYXRpb24rZGUrR29vZ2xlK0FnZW5kYSI7czoxMjoiVHdvX1dheV9TeW5jIjtzOjMyOiJTeW5jaHJvbmlzYXRpb24rYmlkaXJlY3Rpb25uZWxsZSI7czoxNDoiVmVyaWZ5X0FjY291bnQiO3M6MjM6InYlQzMlQTlyaWZpZXIrbGUrY29tcHRlIjtzOjE1OiJTZWxlY3RfQ2FsZW5kYXIiO3M6MzE6IlMlQzMlQTlsZWN0aW9ubmV6K2xlK2NhbGVuZHJpZXIiO3M6MTA6IkRpc2Nvbm5lY3QiO3M6MTY6IkQlQzMlQTljb25uZWN0ZXIiO3M6MTg6IkNhbGVuZGFyX0Zpc3J0X0RheSI7czoyMzoiQ2FsZW5kcmllcitQcmVtaWVyK0pvdXIiO3M6MjE6IkNhbGVuZGFyX0RlZmF1bHRfVmlldyI7czoyNzoiK0NhbGVuZHJpZXIrcGFyK2QlQzMlQTlmYXV0IjtzOjE4OiJTaG93X2NvbXBhbnlfdGl0bGUiO3M6MzU6IkFmZmljaGVyK2xlK3RpdHJlK2RlK2wlMjdlbnRyZXByaXNlIjtzOjI1OiJmcm9udF9sYW5ndWFnZV9mbGFnc19saXN0IjtzOjM2OiJMaXN0ZStkZXMrZHJhcGVhdXgrZGVzK2xhbmd1ZXMrYXZhbnQiO3M6MjE6Ikdvb2dsZV9BbmFseXRpY3NfQ29kZSI7czoyMToiQ29kZStHb29nbGUrQW5hbHl0aWNzIjtzOjEzOiJQYWdlX01ldGFfVGFnIjtzOjIxOiIrUGFnZSslMkYrQmFsaXNlK01ldGEiO3M6MTI6IlNFT19TZXR0aW5ncyI7czo0MzoiK1BhcmFtJUMzJUE4dHJlcytkZStyJUMzJUE5ZiVDMyVBOXJlbmNlbWVudCI7czoxNjoiTWV0YV9EZXNjcmlwdGlvbiI7czoxNjoiTWV0YStEZXNjcmlwdGlvbiI7czozOiJTRU8iO3M6MzoiU0VPIjtzOjEyOiJvZ190YWdfaW1hZ2UiO3M6MjA6ImV0K3ByZW5kcmUrbCUyN2ltYWdlIjtzOjEwOiJvZ190YWdfdXJsIjtzOjEwOiJldCt0YWcrVVJMIjtzOjExOiJvZ190YWdfdHlwZSI7czoxNzoiZXQrbGUrdHlwZStkZSt0YWciO3M6MTI6Im9nX3RhZ190aXRsZSI7czoxOToiK2V0K2xlK3RpdHJlK2R1K3RhZyI7czo4OiJRdWFudGl0eSI7czoxMzoiUXVhbnRpdCVDMyVBOSI7czoxMjoiU2VuZF9JbnZvaWNlIjtzOjE5OiJFbnZveWVyK3VuZStmYWN0dXJlIjtzOjEwOiJSZWN1cnJlbmNlIjtzOjE2OiIrUiVDMyVBOWN1cnJlbmNlIjtzOjE4OiJSZWN1cnJlbmNlX2Jvb2tpbmciO3M6MzM6IitSJUMzJUE5Y3VycmVuY2UrUiVDMyVBOXNlcnZhdGlvbiI7czoxMToiUmVzZXRfQ29sb3IiO3M6Mjk6IlIlQzMlQTlpbml0aWFsaXNlcitsYStjb3VsZXVyIjtzOjY6IkxvYWRlciI7czo4OiJDaGFyZ2V1ciI7czoxMDoiQ1NTX0xvYWRlciI7czoxMDoiQ1NTK0xvYWRlciI7czoxMDoiR0lGX0xvYWRlciI7czoxMDoiR0lGK0xvYWRlciI7czoxNDoiRGVmYXVsdF9Mb2FkZXIiO3M6MjQ6IkNoYXJnZXVyK3BhcitkJUMzJUE5ZmF1dCI7czo1OiJmb3JfYSI7czo3OiJwb3VyK3VuIjtzOjE3OiJzaG93X2NvbXBhbnlfbG9nbyI7czozNDoiQWZmaWNoZXIrbGUrbG9nbytkZStsJTI3ZW50cmVwcmlzZSI7czoyOiJvbiI7czozOiJzdXIiO3M6MTM6InVzZXJfemlwX2NvZGUiO3M6MTI6Iitjb2RlK3Bvc3RhbCI7czoxODoiZGVsZXRlX3RoaXNfbWV0aG9kIjtzOjMyOiIrU3VwcHJpbWVyK2NldHRlK20lQzMlQTl0aG9kZSUzRiI7czoxMzoiYXV0aG9yaXplX25ldCI7czoxMzoiQXV0aG9yaXplLk5ldCI7czoxMzoic3RhZmZfZGV0YWlscyI7czoyNToiRCVDMyU4OVRBSUxTK0RVK1BFUlNPTk5FTCI7czoxNToiY2xpZW50X3BheW1lbnRzIjtzOjIyOiIrUGFpZW1lbnRzK2F1eCtjbGllbnRzIjtzOjE0OiJzdGFmZl9wYXltZW50cyI7czoyMjoiUGFpZW1lbnRzK2R1K3BlcnNvbm5lbCI7czoyMjoic3RhZmZfcGF5bWVudHNfZGV0YWlscyI7czo0MDoiK0QlQzMlQTl0YWlscytkZXMrcGFpZW1lbnRzK2R1K3BlcnNvbm5lbCI7czoxMjoiYWR2YW5jZV9wYWlkIjtzOjE4OiIrQXZhbmNlK3BheSVDMyVBOWUiO3M6MjY6ImNoYW5nZV9jYWxjdWxhdGlvbl9wb2xpY3l5IjtzOjMyOiIrTW9kaWZpZXIrbGErcG9saXRpcXVlK2RlK2NhbGN1bCI7czoxNDoiZnJvbnRlbmRfZm9udHMiO3M6MTg6IitQb2xpY2VzK2Zyb250YWxlcyI7czoxMzoiZmF2aWNvbl9pbWFnZSI7czoxMzoiRmF2aWNvbitJbWFnZSI7czoyMDoic3RhZmZfZW1haWxfdGVtcGxhdGUiO3M6MzE6Ik1vZCVDMyVBOGxlK2QlMjdlbWFpbCtwZXJzb25uZWwiO3M6NDc6InN0YWZmX2RldGFpbHNfYWRkX25ld19hbmRfbWFuYWdlX3N0YWZmX3BheW1lbnRzIjtzOjg4OiJEJUMzJUE5dGFpbHMrZHUrcGVyc29ubmVsJTJDK2Fqb3V0ZXIrZHUrbm91dmVhdStldCtnJUMzJUE5cmVyK2xlcytwYWllbWVudHMrZHUrcGVyc29ubmVsIjtzOjk6ImFkZF9zdGFmZiI7czoyMDoiQWpvdXRlcitkdStwZXJzb25uZWwiO3M6Mjc6InN0YWZmX2Jvb2tpbmdzX2FuZF9wYXltZW50cyI7czo0NDoiK1IlQzMlQTlzZXJ2YXRpb25zK2RlK3BlcnNvbm5lbCtldCtwYWllbWVudHMiO3M6MzM6InN0YWZmX2Jvb2tpbmdfZGV0YWlsc19hbmRfcGF5bWVudCI7czo0MToiQ29vcmRvbm4lQzMlQTllcytkdStwZXJzb25uZWwrZXQrcGFpZW1lbnQiO3M6MzA6InNlbGVjdF9vcHRpb25fdG9fc2hvd19ib29raW5ncyI7czo2NDoiUyVDMyVBOWxlY3Rpb25uZXorbCUyN29wdGlvbitwb3VyK2FmZmljaGVyK2xlcytyJUMzJUE5c2VydmF0aW9ucyI7czoxNDoic2VsZWN0X3NlcnZpY2UiO3M6Mjg6IlMlQzMlQTlsZWN0aW9ubmV6K2xlK3NlcnZpY2UiO3M6MTA6InN0YWZmX25hbWUiO3M6MTY6Ik5vbStkdStwZXJzb25uZWwiO3M6MTM6InN0YWZmX3BheW1lbnQiO3M6MjI6IitQYWllbWVudCtkdStwZXJzb25uZWwiO3M6Mjg6ImFkZF9wYXltZW50X3RvX3N0YWZmX2FjY291bnQiO3M6NDA6IitBam91dGVyK3VuK3BhaWVtZW50K2F1K2NvbXB0ZStwZXJzb25uZWwiO3M6MTQ6ImFtb3VudF9wYXlhYmxlIjtzOjE1OiJNb250YW50K3BheWFibGUiO3M6MTI6InNhdmVfY2hhbmdlcyI7czoyOToiU2F1dmVnYXJkZXIrbGVzK21vZGlmaWNhdGlvbnMiO3M6MTg6ImZyb250X2Vycm9yX2xhYmVscyI7czozMjoiJUMzJTg5dGlxdWV0dGVzK2QlMjdlcnJldXIrYXZhbnQiO3M6Njoic3RyaXBlIjtzOjU6IkJhbmRlIjtzOjE0OiJjaGVja291dF90aXRsZSI7czo5OiIyQ2hlY2tvdXQiO3M6MTc6Im5leG1vX3Ntc19nYXRld2F5IjtzOjIxOiIrUGFzc2VyZWxsZStTTVMrTmV4bW8iO3M6MTc6Im5leG1vX3Ntc19zZXR0aW5nIjtzOjI0OiJQYXJhbSVDMyVBOHRyZStTTVMrTmV4bW8iO3M6MTM6Im5leG1vX2FwaV9rZXkiO3M6MjU6IkNsJUMzJUE5K2RlK2wlMjdBUEkrTmV4bW8iO3M6MTY6Im5leG1vX2FwaV9zZWNyZXQiO3M6MjM6IlNlY3JldCtkZStsJTI3QVBJK05leG1vIjtzOjEwOiJuZXhtb19mcm9tIjtzOjIzOiIrTmV4bW8rJUMzJUEwK3BhcnRpcitkZSI7czoxMjoibmV4bW9fc3RhdHVzIjtzOjEyOiJTdGF0dXQrTmV4bW8iO3M6MzE6Im5leG1vX3NlbmRfc21zX3RvX2NsaWVudF9zdGF0dXMiO3M6NDk6IitOZXhtbytFbnZveWVyK1NNUyslQzMlQTArbCUyNyVDMyVBOXRhdCtkdStjbGllbnQiO3M6MzA6Im5leG1vX3NlbmRfc21zX3RvX2FkbWluX3N0YXR1cyI7czozNzoiTmV4bW8rRW52b3llcitTbXMrJUMzJUEwK2FkbWluK3N0YXR1dCI7czoyNDoibmV4bW9fYWRtaW5fcGhvbmVfbnVtYmVyIjtzOjYyOiJOdW0lQzMlQTlybytkZSt0JUMzJUE5bCVDMyVBOXBob25lK2RlK2wlMjdhZG1pbmlzdHJhdGV1citOZXhtbyI7czo5OiJzYXZlXzEyXzUiO3M6MjM6IiVDMyVBOWNvbm9taXNleisxMi41JTI1IjtzOjE1OiJmcm9udF90b29sX3RpcHMiO3M6MjQ6IkNPTlNFSUxTK0QlMjdPVVRJTCtBVkFOVCI7czoyMToiZnJvbnRfdG9vbF90aXBzX2xvd2VyIjtzOjI0OiJDb25zZWlscytkJTI3b3V0aWwrYXZhbnQiO3M6MjA6InRvb2xfdGlwX215X2Jvb2tpbmdzIjtzOjIxOiJNZXMrciVDMyVBOXNlcnZhdGlvbnMiO3M6MjA6InRvb2xfdGlwX3Bvc3RhbF9jb2RlIjtzOjExOiJjb2RlK3Bvc3RhbCI7czoxNzoidG9vbF90aXBfc2VydmljZXMiO3M6MjI6IlByZXN0YXRpb25zK2RlK3NlcnZpY2UiO3M6MjI6InRvb2xfdGlwX2V4dHJhX3NlcnZpY2UiO3M6Mjg6IitTZXJ2aWNlK3N1cHBsJUMzJUE5bWVudGFpcmUiO3M6Mjg6InRvb2xfdGlwX2ZyZXF1ZW50bHlfZGlzY291bnQiO3M6MjA6IkZvaXJlK3IlQzMlQTlkdWN0aW9uIjtzOjM5OiJ0b29sX3RpcF93aGVuX3dvdWxkX3lvdV9saWtlX3VzX3RvX2NvbWUiO3M6Mzk6IlF1YW5kK3ZvdWRyaWV6LXZvdXMrcXVlK25vdXMrdmVuaW9ucyUzRiI7czozMDoidG9vbF90aXBfeW91cl9wZXJzb25hbF9kZXRhaWxzIjtzOjI5OiJWb3MraW5mb3JtYXRpb25zK3BlcnNvbm5lbGxlcyI7czoyNToidG9vbF90aXBfaGF2ZV9hX3Byb21vY29kZSI7czozNToiQXZleit2b3VzK3VuK2NvZGUrZGUrciVDMyVBOWR1Y3Rpb24iO3M6MzM6InRvb2xfdGlwX3ByZWZlcnJlZF9wYXltZW50X21ldGhvZCI7czo0ODoiTSVDMyVBOXRob2RlK2RlK3BhaWVtZW50K3ByJUMzJUE5ZiVDMyVBOXIlQzMlQTllIjtzOjEwOiJsb2dpbl9wYWdlIjtzOjE3OiJQYWdlK2RlK2Nvbm5leGlvbiI7czoxMDoiZnJvbnRfcGFnZSI7czoxMzoiUGFnZStkZStnYXJkZSI7czoxNDoiYmVmb3JlX2VfZ18xMDAiO3M6MzE6IkF2YW50KyUyOHBhcitleGVtcGxlKzEwMCslMjQlMjkiO3M6MTM6ImFmdGVyX2VfZ18xMDAiO3M6Mzk6IkFwciVDMyVBOHMrJTI4cGFyK2V4ZW1wbGUlMkMrMTAwKyUyNCUyOSI7czo3OiJ0YXhfdmF0IjtzOjEyOiJUYXhlKyUyRitUVkEiO3M6OToid3JvbmdfdXJsIjtzOjE0OiJVUkwraW5jb3JyZWN0ZSI7czoxMToiY2hvb3NlX2ZpbGUiO3M6MTg6IkNob2lzaXIrbGUrZmljaGllciI7czoxNToiZnJvbnRlbmRfbGFiZWxzIjtzOjI0OiIlQzMlODl0aXF1ZXR0ZXMrRnJvbnRlbmQiO3M6MTI6ImFkbWluX2xhYmVscyI7czoyMjoiKyVDMyU4OXRpcXVldHRlcytBZG1pbiI7czoxNToiZHJvcGRvd25fZGVzaWduIjtzOjE1OiJEcm9wRG93bitEZXNpZ24iO3M6MjM6ImJsb2Nrc19hc19idXR0b25fZGVzaWduIjtzOjMzOiIrQmxvY3MrY29tbWUrY29uY2VwdGlvbitkZStib3V0b24iO3M6MTg6InF0eV9jb250cm9sX2Rlc2lnbiI7czoxODoiUXR5K0NvbnRyb2wrRGVzaWduIjtzOjk6ImRyb3Bkb3ducyI7czo5OiJEcm9wRG93bnMiO3M6MTY6ImJpZ19pbWFnZXNfcmFkaW8iO3M6MTY6IkJpZytJbWFnZXMrUmFkaW8iO3M6NjoiZXJyb3JzIjtzOjEyOiIrbGVzK2VycmV1cnMiO3M6MTI6ImV4dHJhX2xhYmVscyI7czozNzoiKyVDMyU4OXRpcXVldHRlcytzdXBwbCVDMyVBOW1lbnRhaXJlcyI7czoxMjoiYXBpX3Bhc3N3b3JkIjtzOjE2OiJNb3QrZGUrcGFzc2UrQVBJIjtzOjEyOiJhcGlfdXNlcm5hbWUiO3M6MzE6IitOb20rZCUyN3V0aWxpc2F0ZXVyK2RlK2wlMjdBUEkiO3M6MTA6ImFwcGVhcmFuY2UiO3M6OToiQVBQQVJFTkNFIjtzOjY6ImFjdGlvbiI7czo2OiJhY3Rpb24iO3M6NzoiYWN0aW9ucyI7czo1OiJhY3RlcyI7czo5OiJhZGRfYnJlYWsiO3M6MTg6IitBam91dGVyK3VuZStwYXVzZSI7czoxMDoiYWRkX2JyZWFrcyI7czoxODoiQWpvdXRlcitkZXMrcGF1c2VzIjtzOjIwOiJhZGRfY2xlYW5pbmdfc2VydmljZSI7czozMToiQWpvdXRlcit1bitzZXJ2aWNlK2RlK25ldHRveWFnZSI7czoxMDoiYWRkX21ldGhvZCI7czoyNDoiQWpvdXRlcit1bmUrbSVDMyVBOXRob2RlIjtzOjc6ImFkZF9uZXciO3M6MTg6IkFqb3V0ZXIrdW4rbm91dmVhdSI7czoxNToiYWRkX3NhbXBsZV9kYXRhIjtzOjM2OiJBam91dGVyK2RlcytleGVtcGxlcytkZStkb25uJUMzJUE5ZXMiO3M6ODoiYWRkX3VuaXQiO3M6MjI6IkFqb3V0ZXIrdW5lK3VuaXQlQzMlQTkiO3M6MTg6ImFkZF95b3VyX29mZl90aW1lcyI7czoyNDoiQWpvdXRleit2b3MrdGVtcHMrbGlicmVzIjtzOjE2OiJhZGRfbmV3X29mZl90aW1lIjtzOjM5OiJBam91dGVyK3VuK25vdXZlYXUrdGVtcHMrZCUyN2FyciVDMyVBQXQiO3M6NzoiYWRkX29ucyI7czo3OiJBZGQtb25zIjtzOjE1OiJhZGRvbnNfYm9va2luZ3MiO3M6MjQ6IlIlQzMlQTlzZXJ2YXRpb25zK0FkZE9ucyI7czoyNDoiYWRkb25fc2VydmljZV9mcm9udF92aWV3IjtzOjMwOiJWdWUrYXZhbnQrZGUrbCUyN2FkZG9uLXNlcnZpY2UiO3M6NjoiYWRkb25zIjtzOjY6IkFkZG9ucyI7czoxODoic2VydmljZV9jb21taXNzaW9uIjtzOjIxOiJDb21taXNzaW9uK2RlK3NlcnZpY2UiO3M6MTY6ImNvbW1pc3Npb25fdG90YWwiO3M6MjI6IlRvdGFsK2RlK2xhK0NvbW1pc3Npb24iO3M6NzoiYWRkcmVzcyI7czo3OiJBZHJlc3NlIjtzOjI0OiJuZXdfYXBwb2ludG1lbnRfYXNzaWduZWQiO3M6MzM6Ik5vdXZlbGxlK25vbWluYXRpb24rYXNzaWduJUMzJUE5ZSI7czoyNToiYWRtaW5fZW1haWxfbm90aWZpY2F0aW9ucyI7czo0NToiTm90aWZpY2F0aW9ucytwYXIrZW1haWwrZGUrbCUyN2FkbWluaXN0cmF0ZXVyIjtzOjIwOiJhbGxfcGF5bWVudF9nYXRld2F5cyI7czozNDoiVG91dGVzK2xlcytwYXNzZXJlbGxlcytkZStwYWllbWVudCI7czoxMjoiYWxsX3NlcnZpY2VzIjtzOjE3OiJUb3VzK2xlcytzZXJ2aWNlcyI7czo0MDoiYWxsb3dfbXVsdGlwbGVfYm9va2luZ19mb3Jfc2FtZV90aW1lc2xvdCI7czo2ODoiQXV0b3Jpc2VyK3BsdXNpZXVycytyJUMzJUE5c2VydmF0aW9ucytwb3VyK3VuK20lQzMlQUFtZStjciVDMyVBOW5lYXUiO3M6NjoiYW1vdW50IjtzOjg6IitNb250YW50IjtzOjg6ImFwcF9kYXRlIjtzOjI1OiJBcHAuK1JlbmRlei12b3VzK2Ftb3VyZXV4IjtzOjE5OiJhcHBlYXJhbmNlX3NldHRpbmdzIjtzOjMwOiIrUGFyYW0lQzMlQTh0cmVzK2QlMjdhcHBhcmVuY2UiO3M6MjE6ImFwcG9pbnRtZW50X2NvbXBsZXRlZCI7czozMToiK1JlbmRlei12b3VzK2NvbXBsJUMzJUE5dCVDMyVBOSI7czoxOToiYXBwb2ludG1lbnRfZGV0YWlscyI7czoyNzoiRCVDMyVBOXRhaWxzK2RlK3JlbmRlei12b3VzIjtzOjI5OiJhcHBvaW50bWVudF9tYXJrZWRfYXNfbm9fc2hvdyI7czo1MjoiK1JlbmRlei12b3VzK21hcnF1JUMzJUE5K2NvbW1lK25vbi1wciVDMyVBOXNlbnRhdGlvbiI7czoxNToibWFya19hc19ub19zaG93IjtzOjI3OiIrTWFycXVlcitjb21tZStub24rQWZmaWNoZXIiO3M6Mjc6ImFwcG9pbnRtZW50X3JlbWluZGVyX2J1ZmZlciI7czozMjoiK1RhbXBvbitkZStyYXBwZWwrZGUrcmVuZGV6LXZvdXMiO3M6MjQ6ImFwcG9pbnRtZW50X2F1dG9fY29uZmlybSI7czoyNjoiUmVuZGV6LXZvdXMrYXV0bytjb25maXJtZXIiO3M6MTI6ImFwcG9pbnRtZW50cyI7czoxMjoiK1JlbmRlei12b3VzIjtzOjIzOiJhZG1pbl9hcmVhX2NvbG9yX3NjaGVtZSI7czo1MjoiU2NoJUMzJUE5bWErZGUrY291bGV1citkZStsYSt6b25lK2QlMjdhZG1pbmlzdHJhdGlvbiI7czoxNzoidGhhbmt5b3VfcGFnZV91cmwiO3M6MjE6IitNZXJjaStVUkwrZGUrbGErcGFnZSI7czoxMToiYWRkb25fdGl0bGUiO3M6MTg6IlRpdHJlK2RlK2wlMjdhZGRvbiI7czoxMToiYXZhaWxhYmlsdHkiO3M6MTg6IkRpc3BvbmliaWxpdCVDMyVBOSI7czoxNjoiYmFja2dyb3VuZF9jb2xvciI7czoxNToiQ291bGV1citkZStmb25kIjtzOjI4OiJiZWhhdmlvdXJfb25fY2xpY2tfb2ZfYnV0dG9uIjtzOjMwOiJDb21wb3J0ZW1lbnQrYXUrY2xpYytkdStib3V0b24iO3M6ODoiYm9va19ub3ciO3M6MTk6IitSZXNlcnZlK21haW50ZW5hbnQiO3M6MjE6ImJvb2tpbmdfZGF0ZV9hbmRfdGltZSI7czozNDoiK0RhdGUrZXQraGV1cmUrZGUrciVDMyVBOXNlcnZhdGlvbiI7czoxNToiYm9va2luZ19kZXRhaWxzIjtzOjM2OiJMZXMrZCVDMyVBOXRhaWxzK2RlK3IlQzMlQTlzZXJ2YXRpb24iO3M6MTk6ImJvb2tpbmdfaW5mb3JtYXRpb24iO3M6MzI6IkluZm9ybWF0aW9ucytkZStyJUMzJUE5c2VydmF0aW9uIjtzOjE4OiJib29raW5nX3NlcnZlX2RhdGUiO3M6Mjg6IlIlQzMlQTlzZXJ2YXRpb24rU2VydmlyK0RhdGUiO3M6MTQ6ImJvb2tpbmdfc3RhdHVzIjtzOjI2OiJTdGF0dXQrZGUrciVDMyVBOXNlcnZhdGlvbiI7czoyMToiYm9va2luZ19ub3RpZmljYXRpb25zIjtzOjMzOiJOb3RpZmljYXRpb25zK2RlK3IlQzMlQTlzZXJ2YXRpb24iO3M6ODoiYm9va2luZ3MiO3M6MTc6IlIlQzMlQTlzZXJ2YXRpb25zIjtzOjE1OiJidXR0b25fcG9zaXRpb24iO3M6MTg6IlBvc2l0aW9uK2R1K2JvdXRvbiI7czoxMToiYnV0dG9uX3RleHQiO3M6MTU6IlRleHRlK2R1K2JvdXRvbiI7czo3OiJjb21wYW55IjtzOjk6IkNPTVBBR05JRSI7czoxNzoiY2Fubm90X2NhbmNlbF9ub3ciO3M6MzM6IkltcG9zc2libGUrZCUyN2FubnVsZXIrbWFpbnRlbmFudCI7czoyMToiY2Fubm90X3Jlc2NoZWR1bGVfbm93IjtzOjQzOiIrSW1wb3NzaWJsZStkZStyZXBvcnRlcislQzMlQTArcHIlQzMlQTlzZW50IjtzOjY6ImNhbmNlbCI7czo3OiJBbm51bGVyIjtzOjI0OiJjYW5jZWxsYXRpb25fYnVmZmVyX3RpbWUiO3M6Mjc6IkhldXJlK3RhbXBvbitkJTI3YW5udWxhdGlvbiI7czoxOToiY2FuY2VsbGVkX2J5X2NsaWVudCI7czoyNToiQW5udWwlQzMlQTkrcGFyK2xlK2NsaWVudCI7czoyOToiY2FuY2VsbGVkX2J5X3NlcnZpY2VfcHJvdmlkZXIiO3M6NDM6IitBbm51bCVDMyVBOStwYXIrbGUrZm91cm5pc3NldXIrZGUrc2VydmljZXMiO3M6MTU6ImNoYW5nZV9wYXNzd29yZCI7czoyMzoiQ2hhbmdlcitsZSttb3QrZGUrcGFzc2UiO3M6MTY6ImNsZWFuaW5nX3NlcnZpY2UiO3M6MjA6IlNlcnZpY2UrZGUrbmV0dG95YWdlIjtzOjY6ImNsaWVudCI7czo2OiJDbGllbnQiO3M6MjY6ImNsaWVudF9lbWFpbF9ub3RpZmljYXRpb25zIjtzOjMxOiJOb3RpZmljYXRpb25zK3BhcitlLW1haWwrY2xpZW50IjtzOjExOiJjbGllbnRfbmFtZSI7czoxMzoiTm9tK2R1K2NsaWVudCI7czoxMjoiY29sb3Jfc2NoZW1lIjtzOjIyOiJTY2glQzMlQTltYStkZStjb3VsZXVyIjtzOjk6ImNvbG9yX3RhZyI7czo3OiJDb3VsZXVyIjtzOjE1OiJjb21wYW55X2FkZHJlc3MiO3M6NzoiQWRyZXNzZSI7czoxMzoiY29tcGFueV9lbWFpbCI7czo2OiIrRW1haWwiO3M6MTI6ImNvbXBhbnlfbG9nbyI7czoyMDoiK0xvZ28rZCUyN2VudHJlcHJpc2UiO3M6MTI6ImNvbXBhbnlfbmFtZSI7czoyMToiTm9tK2RlK2wlMjdlbnRyZXByaXNlIjtzOjE2OiJjb21wYW55X3NldHRpbmdzIjtzOjUxOiJQYXJhbSVDMyVBOHRyZXMrZCUyN2luZm9ybWF0aW9ucytzdXIrbCUyN2VudHJlcHJpc2UiO3M6MTE6ImNvbXBhbnluYW1lIjtzOjIwOiIrTm9tK2RlK2xhK2NvbXBhZ25pZSI7czoyMToiY29tcGFueV9pbmZvX3NldHRpbmdzIjtzOjMzOiJQYXJhbSVDMyVBOHRyZXMrZGUrbCUyN2VudHJlcHJpc2UiO3M6OToiY29tcGxldGVkIjtzOjEzOiIrVGVybWluJUMzJUE5IjtzOjc6ImNvbmZpcm0iO3M6MTA6IitDb25maXJtZXIiO3M6OToiY29uZmlybWVkIjtzOjEzOiJDb25maXJtJUMzJUE5IjtzOjE0OiJjb250YWN0X3N0YXR1cyI7czoxNzoiU3RhdHV0K2R1K2NvbnRhY3QiO3M6NzoiY291bnRyeSI7czo0OiJQYXlzIjtzOjE4OiJjb3VudHJ5X2NvZGVfcGhvbmUiO3M6Mzg6IkNvZGUrZGUrcGF5cyslMjh0JUMzJUE5bCVDMyVBOXBob25lJTI5IjtzOjY6ImNvdXBvbiI7czo2OiJDb3Vwb24iO3M6MTE6ImNvdXBvbl9jb2RlIjtzOjE0OiJDb2RlK2RlK2NvdXBvbiI7czoxMjoiY291cG9uX2xpbWl0IjtzOjE2OiJMaW1pdGUrZHUrY291cG9uIjtzOjExOiJjb3Vwb25fdHlwZSI7czoxNDoiVHlwZStkZStjb3Vwb24iO3M6MTE6ImNvdXBvbl91c2VkIjtzOjE5OiJDb3Vwb24rdXRpbGlzJUMzJUE5IjtzOjEyOiJjb3Vwb25fdmFsdWUiO3M6MTc6IitWYWxldXIrZHUrY291cG9uIjtzOjIwOiJjcmVhdGVfYWRkb25fc2VydmljZSI7czozMjoiK0NyJUMzJUE5ZXIrdW4rc2VydmljZStkJTI3YWpvdXQiO3M6MTM6ImNyb3BfYW5kX3NhdmUiO3M6MjU6IitDdWx0dXJlK2V0KyVDMyVBOWNvbm9taWUiO3M6ODoiY3VycmVuY3kiO3M6NzoiK0RldmlzZSI7czoyNDoiY3VycmVuY3lfc3ltYm9sX3Bvc2l0aW9uIjtzOjM1OiIrUG9zaXRpb24rZHUrc3ltYm9sZSttb24lQzMlQTl0YWlyZSI7czo4OiJjdXN0b21lciI7czo3OiIrQ2xpZW50IjtzOjIwOiJjdXN0b21lcl9pbmZvcm1hdGlvbiI7czoyMDoiK0luZm9ybWF0aW9ucytjbGllbnQiO3M6OToiY3VzdG9tZXJzIjtzOjExOiJMZXMrY2xpZW50cyI7czoxMzoiZGF0ZV9hbmRfdGltZSI7czoxNDoiK0RhdGUrZXQraGV1cmUiO3M6MjM6ImRhdGVfcGlja2VyX2RhdGVfZm9ybWF0IjtzOjM0OiJEYXRlLVMlQzMlQTlsZWN0ZXVyK0Zvcm1hdCtkZStkYXRlIjtzOjI1OiJkZWZhdWx0X2Rlc2lnbl9mb3JfYWRkb25zIjtzOjQyOiJDb25jZXB0aW9uK3BhcitkJUMzJUE5ZmF1dCtwb3VyK2xlcythZGRvbnMiO3M6NDY6ImRlZmF1bHRfZGVzaWduX2Zvcl9tZXRob2RzX3dpdGhfbXVsdGlwbGVfdW5pdHMiO3M6Nzc6IitDb25jZXB0aW9uK3BhcitkJUMzJUE5ZmF1dCtwb3VyK2xlcyttJUMzJUE5dGhvZGVzK2F2ZWMrcGx1c2lldXJzK3VuaXQlQzMlQTlzIjtzOjI3OiJkZWZhdWx0X2Rlc2lnbl9mb3Jfc2VydmljZXMiO3M6NDU6IitDb25jZXB0aW9uK3BhcitkJUMzJUE5ZmF1dCtwb3VyK2xlcytzZXJ2aWNlcyI7czoxNToiZGVmYXVsdF9zZXR0aW5nIjtzOjMyOiIrUGFyYW0lQzMlQTh0cmVzK3BhcitkJUMzJUE5ZmF1dCI7czo2OiJkZWxldGUiO3M6ODoiK0VmZmFjZXIiO3M6MTE6ImRlc2NyaXB0aW9uIjtzOjE0OiJMYStkZXNjcmlwdGlvbiI7czo4OiJkaXNjb3VudCI7czo2OiJSZW1pc2UiO3M6MTY6ImRvd25sb2FkX2ludm9pY2UiO3M6MzM6IitUJUMzJUE5bCVDMyVBOWNoYXJnZXIrbGErZmFjdHVyZSI7czoxODoiZW1haWxfbm90aWZpY2F0aW9uIjtzOjIyOiJOT1RJRklDQVRJT04rUEFSK0VNQUlMIjtzOjU6ImVtYWlsIjtzOjU6IkVtYWlsIjtzOjE0OiJlbWFpbF9zZXR0aW5ncyI7czozMDoiK1BhcmFtJUMzJUE4dHJlcytkZSttZXNzYWdlcmllIjtzOjEwOiJlbWJlZF9jb2RlIjtzOjIzOiIrQ29kZStpbnQlQzMlQTlnciVDMyVBOSI7czo3NzoiZW50ZXJfeW91cl9lbWFpbF9hbmRfd2Vfd2lsbF9zZW5kX3lvdV9pbnN0cnVjdGlvbnNfb25fcmVzZXR0aW5nX3lvdXJfcGFzc3dvcmQiO3M6MTExOiIrRW50cmV6K3ZvdHJlK2VtYWlsK2V0K25vdXMrdm91cytlbnZlcnJvbnMrZGVzK2luc3RydWN0aW9ucytzdXIrbGErciVDMyVBOWluaXRpYWxpc2F0aW9uK2RlK3ZvdHJlK21vdCtkZStwYXNzZS4iO3M6MTE6ImV4cGlyeV9kYXRlIjtzOjE5OiJEYXRlK2QlMjdleHBpcmF0aW9uIjtzOjY6ImV4cG9ydCI7czoxMToiRXhwb3J0YXRpb24iO3M6MTk6ImV4cG9ydF95b3VyX2RldGFpbHMiO3M6MjU6IkV4cG9ydGVyK3ZvcytkJUMzJUE5dGFpbHMiO3M6MzI6ImZyZXF1ZW50bHlfZGlzY291bnRfc2V0dGluZ190YWJzIjtzOjI2OiIrRlIlQzMlODlRVUVNTUVOVCtESVNDT1VOVCI7czoyNjoiZnJlcXVlbnRseV9kaXNjb3VudF9oZWFkZXIiO3M6MTU6IitGb2lyZStlc2NvbXB0ZSI7czoxNzoiZmllbGRfaXNfcmVxdWlyZWQiO3M6MTI6IkNoYW1wK3JlcXVpcyI7czo5OiJmaWxlX3NpemUiO3M6MTc6IlRhaWxsZStkdStmaWNoaWVyIjtzOjg6ImZsYXRfZmVlIjtzOjEyOiIrRnJhaXMrZml4ZXMiO3M6NDoiZmxhdCI7czoxMToiQXBwYXJ0ZW1lbnQiO3M6MTM6ImZyZXFfZGlzY291bnQiO3M6MTM6IkZyZXEtRGlzY291bnQiO3M6MjU6ImZyZXF1ZW50bHlfZGlzY291bnRfbGFiZWwiO3M6Mzg6IiVDMyU4OXRpcXVldHRlK2ZyJUMzJUE5cXVlbW1lbnQrcmVtaXNlIjtzOjI0OiJmcmVxdWVudGx5X2Rpc2NvdW50X3R5cGUiO3M6MjA6IkZvaXJlK1R5cGUrZGUrcmVtaXNlIjtzOjI1OiJmcmVxdWVudGx5X2Rpc2NvdW50X3ZhbHVlIjtzOjM5OiJGYWN0ZXVyK2RlK3IlQzMlQTlkdWN0aW9uK2ZyJUMzJUE5cXVlbnQiO3M6MjI6ImZyb250X3NlcnZpY2VfYm94X3ZpZXciO3M6Mzg6IitWdWUrZGUrbGErYm8lQzMlQUV0ZStkZStzZXJ2aWNlK2F2YW50IjtzOjI3OiJmcm9udF9zZXJ2aWNlX2Ryb3Bkb3duX3ZpZXciO3M6NDU6IlZ1ZStkZStsYStsaXN0ZStkJUMzJUE5cm91bGFudGUrU2VydmljZSthdmFudCI7czoxODoiZnJvbnRfdmlld19vcHRpb25zIjtzOjIxOiIrT3B0aW9ucytkZSt2dWUrYXZhbnQiO3M6OToiZnVsbF9uYW1lIjtzOjEyOiIrTm9tK2NvbXBsZXQiO3M6NzoiZ2VuZXJhbCI7czoxNzoiRyVDMyU4OU4lQzMlODlSQUwiO3M6MTY6ImdlbmVyYWxfc2V0dGluZ3MiO3M6MzM6IityJUMzJUE5Z2xhZ2VzK2clQzMlQTluJUMzJUE5cmF1eCI7czo1MzoiZ2V0X2VtYmVkX2NvZGVfdG9fc2hvd19ib29raW5nX3dpZGdldF9vbl95b3VyX3dlYnNpdGUiO3M6OTc6IitPYnRlbmV6K2xlK2NvZGUraW50JUMzJUE5Z3IlQzMlQTkrcG91cithZmZpY2hlcitsZSt3aWRnZXQrZGUrciVDMyVBOXNlcnZhdGlvbitzdXIrdm90cmUrc2l0ZStXZWIiO3M6MjA6ImdldF90aGVfZW1iZWRlZF9jb2RlIjtzOjMwOiJPYnRlbmlyK2xlK2NvZGUraW5jb3Jwb3IlQzMlQTkiO3M6MTU6Imd1ZXN0X2N1c3RvbWVycyI7czoyMToiK0NsaWVudHMraW52aXQlQzMlQTlzIjtzOjE5OiJndWVzdF91c2VyX2NoZWNrb3V0IjtzOjQ5OiIrViVDMyVBOXJpZmljYXRpb24rZGUrbCUyN3V0aWxpc2F0ZXVyK2ludml0JUMzJUE5IjtzOjM2OiJoaWRlX2ZhZGVkX2FscmVhZHlfYm9va2VkX3RpbWVfc2xvdHMiO3M6Njg6IitDYWNoZXIrbGVzK2NyJUMzJUE5bmVhdXgraG9yYWlyZXMrZCVDMyVBOWolQzMlQTArciVDMyVBOXNlcnYlQzMlQTlzIjtzOjg6Imhvc3RuYW1lIjtzOjE4OiIrTm9tK2QlMjdoJUMzJUI0dGUiO3M6NjoibGFiZWxzIjtzOjE1OiIlQzMlODlUSVFVRVRURVMiO3M6NzoibGVnZW5kcyI7czoxMzoiTCVDMyVBOWdlbmRlcyI7czo1OiJsb2dpbiI7czoxNDoiUyUyN2lkZW50aWZpZXIiO3M6Mjg6Im1heGltdW1fYWR2YW5jZV9ib29raW5nX3RpbWUiO3M6NDc6IlRlbXBzK2RlK3IlQzMlQTlzZXJ2YXRpb24rYW50aWNpcCVDMyVBOSttYXhpbXVtIjtzOjY6Im1ldGhvZCI7czoxMzoiK00lQzMlQTl0aG9kZSI7czoxMToibWV0aG9kX25hbWUiO3M6MjI6Ik5vbStkZStsYSttJUMzJUE5dGhvZGUiO3M6MTI6Im1ldGhvZF90aXRsZSI7czoyNToiK1RpdHJlK2RlK2xhK20lQzMlQTl0aG9kZSI7czoyMDoibWV0aG9kX3VuaXRfcXVhbnRpdHkiO3M6Mzc6Ik0lQzMlQTl0aG9kZStVbml0JUMzJUE5K1F1YW50aXQlQzMlQTkiO3M6MjU6Im1ldGhvZF91bml0X3F1YW50aXR5X3JhdGUiO3M6NDI6Ik0lQzMlQTl0aG9kZStVbml0JUMzJUE5K1F1YW50aXQlQzMlQTkrVGF1eCI7czoxNzoibWV0aG9kX3VuaXRfdGl0bGUiO3M6Mzk6IlRpdHJlK2RlK2wlMjd1bml0JUMzJUE5K2RlK20lQzMlQTl0aG9kZSI7czoyMzoibWV0aG9kX3VuaXRzX2Zyb250X3ZpZXciO3M6Mzk6IlVuaXQlQzMlQTlzK2RlK20lQzMlQTl0aG9kZStWdWUrZGUrZmFjZSI7czo3OiJtZXRob2RzIjtzOjE0OiIrTSVDMyVBOXRob2RlcyI7czoxNToibWV0aG9kc19ib29raW5nIjtzOjM0OiIrTSVDMyVBOXRob2RlcytkZStyJUMzJUE5c2VydmF0aW9uIjtzOjE2OiJtZXRob2RzX2Jvb2tpbmdzIjtzOjM0OiJSJUMzJUE5c2VydmF0aW9ucytkZSttJUMzJUE5dGhvZGVzIjtzOjI4OiJtaW5pbXVtX2FkdmFuY2VfYm9va2luZ190aW1lIjtzOjUxOiJUZW1wcytkZStyJUMzJUE5c2VydmF0aW9uK21pbmltdW0rJUMzJUEwK2wlMjdhdmFuY2UiO3M6NDoibW9yZSI7czo1OiIrUGx1cyI7czoxMjoibW9yZV9kZXRhaWxzIjtzOjIxOiIrUGx1cytkZStkJUMzJUE5dGFpbHMiO3M6MTU6Im15X2FwcG9pbnRtZW50cyI7czoxNToiTWVzK3JlbmRlei12b3VzIjtzOjQ6Im5hbWUiO3M6MTE6InByJUMzJUE5bm9tIjtzOjk6Im5ldF90b3RhbCI7czo5OiJUb3RhbCtuZXQiO3M6MTI6Im5ld19wYXNzd29yZCI7czoyMToiK25vdXZlYXUrbW90K2RlK3Bhc3NlIjtzOjU6Im5vdGVzIjtzOjk6IlJlbWFycXVlcyI7czo4OiJvZmZfZGF5cyI7czoxOToiSm91cnMrZGUrY29uZyVDMyVBOSI7czo4OiJvZmZfdGltZSI7czoyODoiRCVDMyVBOWxhaStkJUMzJUE5cGFzcyVDMyVBOSI7czoxMjoib2xkX3Bhc3N3b3JkIjtzOjIwOiIrYW5jaWVuK21vdCtkZStwYXNzZSI7czoyNzoib25saW5lX2Jvb2tpbmdfYnV0dG9uX3N0eWxlIjtzOjQ0OiJTdHlsZStkZStib3V0b24rZGUrciVDMyVBOXNlcnZhdGlvbitlbitsaWduZSI7czoyNToib3Blbl93aWRnZXRfaW5fYV9uZXdfcGFnZSI7czozOToiT3V2cmlyK3VuK3dpZGdldCtkYW5zK3VuZStub3V2ZWxsZStwYWdlIjtzOjU6Im9yZGVyIjtzOjk6IitDb21tYW5kZSI7czoxMDoib3JkZXJfZGF0ZSI7czoxNzoiK0RhdGUrZGUrY29tbWFuZGUiO3M6MTA6Im9yZGVyX3RpbWUiO3M6MTc6IlRlbXBzK2RlK2NvbW1hbmRlIjtzOjE2OiJwYXltZW50c19zZXR0aW5nIjtzOjg6IlBBSUVNRU5UIjtzOjk6InByb21vY29kZSI7czoxMToiK0NPREUrUFJPTU8iO3M6MTY6InByb21vY29kZV9oZWFkZXIiO3M6MTE6IitDb2RlK3Byb21vIjtzOjE5OiJwYWRkaW5nX3RpbWVfYmVmb3JlIjtzOjIzOiJSZW1ib3VycmFnZStUZW1wcythdmFudCI7czo3OiJwYXJraW5nIjtzOjg6IitQYXJraW5nIjtzOjE0OiJwYXJ0aWFsX2Ftb3VudCI7czoxNToiTW9udGFudCtwYXJ0aWVsIjtzOjE1OiJwYXJ0aWFsX2RlcG9zaXQiO3M6MjM6IkQlQzMlQTlwJUMzJUI0dCtwYXJ0aWVsIjtzOjIyOiJwYXJ0aWFsX2RlcG9zaXRfYW1vdW50IjtzOjM1OiIrTW9udGFudCtkdStkJUMzJUE5cCVDMyVCNHQrcGFydGllbCI7czoyMzoicGFydGlhbF9kZXBvc2l0X21lc3NhZ2UiO3M6MzU6IitNZXNzYWdlK2RlK2QlQzMlQTlwJUMzJUI0dCtwYXJ0aWVsIjtzOjg6InBhc3N3b3JkIjtzOjEzOiIrTW90K2RlK3Bhc3NlIjtzOjc6InBheW1lbnQiO3M6OToiK1BhaWVtZW50IjtzOjEyOiJwYXltZW50X2RhdGUiO3M6MTY6IkRhdGUrZGUrcGFpZW1lbnQiO3M6MTY6InBheW1lbnRfZ2F0ZXdheXMiO3M6MjQ6IitQYXNzZXJlbGxlcytkZStwYWllbWVudCI7czoxNDoicGF5bWVudF9tZXRob2QiO3M6MTY6Ik1vZGUrZGUrcGFpZW1lbnQiO3M6ODoicGF5bWVudHMiO3M6OToiUGFpZW1lbnRzIjtzOjI0OiJwYXltZW50c19oaXN0b3J5X2RldGFpbHMiO3M6NDU6IitEJUMzJUE5dGFpbHMrZGUrbCUyN2hpc3RvcmlxdWUrZGVzK3BhaWVtZW50cyI7czoyMzoicGF5cGFsX2V4cHJlc3NfY2hlY2tvdXQiO3M6MjM6IlBheVBhbCtFeHByZXNzK0NoZWNrb3V0IjtzOjIwOiJwYXlwYWxfZ3Vlc3RfcGF5bWVudCI7czoyNzoiUGFpZW1lbnQrUGF5cGFsK2ludml0JUMzJUE5IjtzOjc6InBlbmRpbmciO3M6MTM6IitlbithdHRlbmRhbnQiO3M6MTA6InBlcmNlbnRhZ2UiO3M6MTE6IlBvdXJjZW50YWdlIjtzOjIwOiJwZXJzb25hbF9pbmZvcm1hdGlvbiI7czoyNToiSW5mb3JtYXRpb25zK3BlcnNvbm5lbGxlcyI7czo1OiJwaG9uZSI7czoxOToiVCVDMyVBOWwlQzMlQTlwaG9uZSI7czo0ODoicGxlYXNlX2NvcHlfYWJvdmVfY29kZV9hbmRfcGFzdGVfaW5feW91cl93ZWJzaXRlIjtzOjY4OiIrVmV1aWxsZXorY29waWVyK2xlK2NvZGUrY2ktZGVzc3VzK2V0K2NvbGxlei1sZStkYW5zK3ZvdHJlK3NpdGUrV2ViLiI7czoyOToicGxlYXNlX2VuYWJsZV9wYXltZW50X2dhdGV3YXkiO3M6NDI6IlZldWlsbGV6K2FjdGl2ZXIrbGErcGFzc2VyZWxsZStkZStwYWllbWVudCI7czoyMzoicGxlYXNlX3NldF9iZWxvd192YWx1ZXMiO3M6NDU6IitWZXVpbGxleitkJUMzJUE5ZmluaXIrbGVzK3ZhbGV1cnMrY2ktZGVzc291cyI7czo0OiJwb3J0IjtzOjQ6IlBvcnQiO3M6MTI6InBvc3RhbF9jb2RlcyI7czoxMzoiK1Bvc3RhbCtDb2RlcyI7czo1OiJwcmljZSI7czo1OiIrUHJpeCI7czoyNDoicHJpY2VfY2FsY3VsYXRpb25fbWV0aG9kIjtzOjMxOiIrTSVDMyVBOXRob2RlK2RlK2NhbGN1bCtkdStwcml4IjtzOjI3OiJwcmljZV9mb3JtYXRfZGVjaW1hbF9wbGFjZXMiO3M6MTU6IkZvcm1hdCtkZXMrcHJpeCI7czo3OiJwcmljaW5nIjtzOjEyOiJUYXJpZmljYXRpb24iO3M6MTM6InByaW1hcnlfY29sb3IiO3M6MTY6IkNvdWxldXIrcHJpbWFpcmUiO3M6MTk6InByaXZhY3lfcG9saWN5X2xpbmsiO3M6Mzg6IlBvbGl0aXF1ZStkZStjb25maWRlbnRpYWxpdCVDMyVBOStMaW5rIjtzOjc6InByb2ZpbGUiO3M6NzoiK1Byb2ZpbCI7czoxMDoicHJvbW9jb2RlcyI7czoxMToiY29kZXMrcHJvbW8iO3M6MTU6InByb21vY29kZXNfbGlzdCI7czoyMToiK0xpc3RlK2Rlcytwcm9tb2NvZGVzIjtzOjIwOiJyZWdpc3RlcmVkX2N1c3RvbWVycyI7czoyNDoiQ2xpZW50cytlbnJlZ2lzdHIlQzMlQTlzIjtzOjI5OiJyZWdpc3RlcmVkX2N1c3RvbWVyc19ib29raW5ncyI7czo0NToiUiVDMyVBOXNlcnZhdGlvbnMrZGUrY2xpZW50cytlbnJlZ2lzdHIlQzMlQTlzIjtzOjY6InJlamVjdCI7czo3OiJSZWpldGVyIjtzOjg6InJlamVjdGVkIjtzOjExOiJSZWpldCVDMyVBOSI7czoxMToicmVtZW1iZXJfbWUiO3M6MTk6IlNvdXZpZW5zLXRvaStkZSttb2kiO3M6MTg6InJlbW92ZV9zYW1wbGVfZGF0YSI7czozODoiU3VwcHJpbWVyK2RlcytleGVtcGxlcytkZStkb25uJUMzJUE5ZXMiO3M6MTA6InJlc2NoZWR1bGUiO3M6ODoiUmVwb3J0ZXIiO3M6NToicmVzZXQiO3M6MTg6IlIlQzMlQTlpbml0aWFsaXNlciI7czoxNDoicmVzZXRfcGFzc3dvcmQiO3M6MzQ6InIlQzMlQTlpbml0aWFsaXNlcitsZSttb3QrZGUrcGFzc2UiO3M6MjE6InJlc2hlZHVsZV9idWZmZXJfdGltZSI7czoyMToiUmVzaGVkdWxlK0J1ZmZlcitUaW1lIjtzOjE5OiJyZXR5cGVfbmV3X3Bhc3N3b3JkIjtzOjMzOiIrUmUtdGFwZXIrbGUrbm91dmVhdSttb3QrZGUrcGFzc2UiO3M6MjI6InJpZ2h0X3NpZGVfZGVzY3JpcHRpb24iO3M6NTA6IitQYWdlK2RlK3IlQzMlQTlzZXJ2YXRpb24rRGVzY3JpcHRpb24rZGUrUmlnaHRzaWRlIjtzOjQ6InNhdmUiO3M6MTI6IitzYXV2ZWdhcmRlciI7czoxNzoic2F2ZV9hdmFpbGFiaWxpdHkiO3M6MzM6IkVucmVnaXN0cmVyK2xhK2Rpc3BvbmliaWxpdCVDMyVBOSI7czoxMjoic2F2ZV9zZXR0aW5nIjtzOjMxOiJTYXV2ZWdhcmRlcitsZXMrcGFyYW0lQzMlQTh0cmVzIjtzOjE5OiJzYXZlX2xhYmVsc19zZXR0aW5nIjtzOjQ5OiJFbnJlZ2lzdHJlcitsZStwYXJhbSVDMyVBOHRyZStkZXMrJUMzJUE5dGlxdWV0dGVzIjtzOjg6InNjaGVkdWxlIjtzOjk6IlByb2dyYW1tZSI7czoxMzoic2NoZWR1bGVfdHlwZSI7czoxNzoiVHlwZStkZStwcm9ncmFtbWUiO3M6MTU6InNlY29uZGFyeV9jb2xvciI7czoxODoiQ291bGV1citzZWNvbmRhaXJlIjtzOjI2OiJzZWxlY3RfbGFuZ3VhZ2VfZm9yX3VwZGF0ZSI7czo1MzoiK1MlQzMlQTlsZWN0aW9ubmV6K2xhK2xhbmd1ZStwb3VyK2xhK21pc2UrJUMzJUEwK2pvdXIiO3M6MzE6InNlbGVjdF9sYW5ndWFnZV90b19jaGFuZ2VfbGFiZWwiO3M6NjA6IitTJUMzJUE5bGVjdGlvbm5leitsYStsYW5ndWUrcG91citjaGFuZ2VyK2QlMjclQzMlQTl0aXF1ZXR0ZSI7czoyNjoic2VsZWN0X2xhbmd1YWdlX3RvX2Rpc3BsYXkiO3M6MTA6IitMYStsYW5ndWUiO3M6MzM6ImRpc3BsYXlfc3ViX2hlYWRlcnNfYmVsb3dfaGVhZGVycyI7czo0MDoiU291cy10aXRyZXMrc3VyK2xhK3BhZ2UrUiVDMyVBOXNlcnZhdGlvbiI7czozNjoic2VsZWN0X3BheW1lbnRfb3B0aW9uX2V4cG9ydF9kZXRhaWxzIjtzOjcwOiIrUyVDMyVBOWxlY3Rpb25uZXorbCUyN29wdGlvbitkZStwYWllbWVudCtkJUMzJUE5dGFpbHMrZCUyN2V4cG9ydGF0aW9uIjtzOjk6InNlbmRfbWFpbCI7czoxNToiRW52b3llcit1bittYWlsIjtzOjQwOiJzZW5kZXJfZW1haWxfYWRkcmVzc19jbGVhbnRvX2FkbWluX2VtYWlsIjtzOjI4OiJFbWFpbCtkZStsJTI3ZXhwJUMzJUE5ZGl0ZXVyIjtzOjExOiJzZW5kZXJfbmFtZSI7czoyNzoiK05vbStkZStsJTI3ZXhwJUMzJUE5ZGl0ZXVyIjtzOjc6InNlcnZpY2UiO3M6MTA6IlVuK3NlcnZpY2UiO3M6MzI6InNlcnZpY2VfYWRkX29uc19mcm9udF9ibG9ja192aWV3IjtzOjM1OiJNb2R1bGVzK2RlK3NlcnZpY2UrRnJvbnQrQmxvY2srVmlldyI7czo0NDoic2VydmljZV9hZGRfb25zX2Zyb250X2luY3JlYXNlX2RlY3JlYXNlX3ZpZXciO3M6NTQ6Ik1vZHVsZXMrZGUrc2VydmljZStBdWdtZW50ZXIrJTJGK2RpbWludWVyK2xhK3Z1ZSthdmFudCI7czoxOToic2VydmljZV9kZXNjcmlwdGlvbiI7czoyMzoiK0Rlc2NyaXB0aW9uK2R1K3NlcnZpY2UiO3M6MTg6InNlcnZpY2VfZnJvbnRfdmlldyI7czoxODoiU2VydmljZStGcm9udCtWaWV3IjtzOjEzOiJzZXJ2aWNlX2ltYWdlIjtzOjE3OiIrSW1hZ2UrZGUrc2VydmljZSI7czoxNToic2VydmljZV9tZXRob2RzIjtzOjI1OiIrTSVDMyVBOXRob2RlcytkZStzZXJ2aWNlIjtzOjI2OiJzZXJ2aWNlX3BhZGRpbmdfdGltZV9hZnRlciI7czozMzoiUmVtYm91cnJhZ2UrZGUrc2VydmljZSthcHIlQzMlQThzIjtzOjE4OiJwYWRkaW5nX3RpbWVfYWZ0ZXIiO3M6MjI6IlJlbWJvdXJyYWdlK2FwciVDMyVBOHMiO3M6Mjc6InNlcnZpY2VfcGFkZGluZ190aW1lX2JlZm9yZSI7czozNDoiUmVtYm91cnJhZ2UrZGUrc2VydmljZStUZW1wcythdmFudCI7czoxNjoic2VydmljZV9xdWFudGl0eSI7czoyNDoiUXVhbnRpdCVDMyVBOStkZStzZXJ2aWNlIjtzOjEyOiJzZXJ2aWNlX3JhdGUiO3M6MTU6IlRhdXgrZGUrc2VydmljZSI7czoxMzoic2VydmljZV90aXRsZSI7czoxNzoiK1RpdHJlK2R1K3NlcnZpY2UiO3M6MTg6InNlcnZpY2VhZGRvbnNfbmFtZSI7czoyMDoiTm9tK2RlK1NlcnZpY2VBZGRPbnMiO3M6ODoic2VydmljZXMiO3M6MjI6IlByZXN0YXRpb25zK2RlK3NlcnZpY2UiO3M6MjA6InNlcnZpY2VzX2luZm9ybWF0aW9uIjtzOjI5OiJJbmZvcm1hdGlvbnMrc3VyK2xlcytzZXJ2aWNlcyI7czoyNToic2V0X2VtYWlsX3JlbWluZGVyX2J1ZmZlciI7czo0MzoiRCVDMyVBOWZpbmlyK3VuK3RhbXBvbitkZStyYXBwZWwrZCUyN2UtbWFpbCI7czoxMjoic2V0X2xhbmd1YWdlIjtzOjIyOiJEJUMzJUE5ZmluaXIrbGErbGFuZ3VlIjtzOjg6InNldHRpbmdzIjtzOjE1OiJQYXJhbSVDMyVBOHRyZXMiO3M6MTc6InNob3dfYWxsX2Jvb2tpbmdzIjtzOjM3OiJBZmZpY2hlcit0b3V0ZXMrbGVzK3IlQzMlQTlzZXJ2YXRpb25zIjtzOjM3OiJzaG93X2J1dHRvbl9vbl9naXZlbl9lbWJlZGVkX3Bvc2l0aW9uIjtzOjYzOiJBZmZpY2hlcitsZStib3V0b24rc3VyK3VuZStwb3NpdGlvbitpbmNvcnBvciVDMyVBOWUrZG9ubiVDMyVBOWUiO3M6MzA6InNob3dfY291cG9uc19pbnB1dF9vbl9jaGVja291dCI7czo1NDoiK0FmZmljaGVyK2xlcytlbnRyJUMzJUE5ZXMrZGUrY291cG9ucyslQzMlQTArbGErY2Fpc3NlIjtzOjIyOiJzaG93X29uX2FfYnV0dG9uX2NsaWNrIjtzOjMwOiJBZmZpY2hlcitzdXIrdW4rYm91dG9uK2NsaXF1ZXIiO3M6MTc6InNob3dfb25fcGFnZV9sb2FkIjtzOjM3OiJBZmZpY2hlcitzdXIrbGUrY2hhcmdlbWVudCtkZStsYStwYWdlIjtzOjk6InNpZ25hdHVyZSI7czoxMDoiK1NpZ25hdHVyZSI7czoyOToic29ycnlfd3JvbmdfZW1haWxfb3JfcGFzc3dvcmQiO3M6NTA6IitEJUMzJUE5c29sJUMzJUE5K21hdXZhaXMrY291cnJpZWwrb3UrbW90K2RlK3Bhc3NlIjtzOjEwOiJzdGFydF9kYXRlIjtzOjE4OiJEYXRlK2RlK2QlQzMlQTlidXQiO3M6Njoic3RhdHVzIjtzOjc6IitTdGF0dXQiO3M6Njoic3VibWl0IjtzOjk6IlNvdW1ldHRyZSI7czoyNDoic3RhZmZfZW1haWxfbm90aWZpY2F0aW9uIjtzOjM5OiIrTm90aWZpY2F0aW9uK3Bhcitjb3VycmllbCtkdStwZXJzb25uZWwiO3M6MzoidGF4IjtzOjEwOiJJbXAlQzMlQjR0IjtzOjk6InRlc3RfbW9kZSI7czoxNDoiTW9kZStkJTI3ZXNzYWkiO3M6MTA6InRleHRfY29sb3IiO3M6MTY6IkNvdWxldXIrZHUrdGV4dGUiO3M6MTY6InRleHRfY29sb3Jfb25fYmciO3M6MjM6IkNvdWxldXIrZHUrdGV4dGUrc3VyK2JnIjtzOjI0OiJ0ZXJtc19hbmRfY29uZGl0aW9uX2xpbmsiO3M6MzA6IkNvbmRpdGlvbnMrZyVDMyVBOW4lQzMlQTlyYWxlcyI7czoxNjoidGhpc193ZWVrX2JyZWFrcyI7czoyMzoiK0NldHRlK3NlbWFpbmUrc2UrYnJpc2UiO3M6MjU6InRoaXNfd2Vla190aW1lX3NjaGVkdWxpbmciO3M6MzY6IkNldHRlK3NlbWFpbmUrcGxhbmlmaWNhdGlvbitkdSt0ZW1wcyI7czoxMToidGltZV9mb3JtYXQiO3M6MjA6IitGb3JtYXQrZGUrbCUyN2hldXJlIjtzOjEzOiJ0aW1lX2ludGVydmFsIjtzOjIwOiIrSW50ZXJ2YWxsZStkZSt0ZW1wcyI7czo4OiJ0aW1lem9uZSI7czoxNToiK0Z1c2VhdStob3JhaXJlIjtzOjU6InVuaXRzIjtzOjExOiJVbml0JUMzJUE5cyI7czo5OiJ1bml0X25hbWUiO3M6MjE6Ik5vbStkZStsJTI3dW5pdCVDMyVBOSI7czoxNjoidW5pdHNfb2ZfbWV0aG9kcyI7czoyOToiK1VuaXQlQzMlQTlzK2RlK20lQzMlQTl0aG9kZXMiO3M6NjoidXBkYXRlIjtzOjE4OiJNZXR0cmUrJUMzJUEwK2pvdXIiO3M6MTg6InVwZGF0ZV9hcHBvaW50bWVudCI7czozMjoiK01pc2UrJUMzJUEwK2pvdXIrZGUrcmVuZGV6LXZvdXMiO3M6MTY6InVwZGF0ZV9wcm9tb2NvZGUiO3M6Mjk6IitNZXR0cmUrJUMzJUEwK2pvdXIrUHJvbW9jb2RlIjtzOjg6InVzZXJuYW1lIjtzOjIwOiIrTm9tK2QlMjd1dGlsaXNhdGV1ciI7czoxNDoidmFjY3VtX2NsZWFuZXIiO3M6MTE6IitBc3BpcmF0ZXVyIjtzOjEzOiJ2aWV3X3Nsb3RzX2J5IjtzOjM2OiJWb2lyK2xlcyttYWNoaW5lcyslQzMlQTArc291cytwYXIlM0YiO3M6NDoid2VlayI7czoxMToiK0xhK3NlbWFpbmUiO3M6MTE6IndlZWtfYnJlYWtzIjtzOjI2OiJTJUMzJUE5am91cnMrZGUrbGErc2VtYWluZSI7czoyMDoid2Vla190aW1lX3NjaGVkdWxpbmciO3M6Mjg6IitQbGFuaWZpY2F0aW9uK2RlK2xhK3NlbWFpbmUiO3M6MjA6IndpZGdldF9sb2FkaW5nX3N0eWxlIjtzOjIzOiJXaWRnZXQrQ2hhcmdlbWVudCtzdHlsZSI7czozOiJ6aXAiO3M6MzoiWmlwIjtzOjY6ImxvZ291dCI7czoxNToiQ29ubmVjdGV6Ky0rT3V0IjtzOjI6InRvIjtzOjc6IislQzMlQTAiO3M6MTc6ImFkZF9uZXdfcHJvbW9jb2RlIjtzOjMwOiIrQWpvdXRlcit1bitub3V2ZWF1K2NvZGUrcHJvbW8iO3M6NjoiY3JlYXRlIjtzOjExOiIrQ3IlQzMlQTllciI7czo4OiJlbmRfZGF0ZSI7czoxMjoiK0RhdGUrZGUrZmluIjtzOjg6ImVuZF90aW1lIjtzOjEzOiIrSGV1cmUrZGUrZmluIjtzOjE1OiJsYWJlbHNfc2V0dGluZ3MiO3M6MzY6IitQYXJhbSVDMyVBOHRyZXMrZGVzKyVDMyVBOXRpcXVldHRlcyI7czo1OiJsaW1pdCI7czo3OiIrTGltaXRlIjtzOjk6Im1heF9saW1pdCI7czoxNDoiTGltaXRlK21heGltdW0iO3M6MTA6InN0YXJ0X3RpbWUiO3M6MjA6IitIZXVyZStkZStkJUMzJUE5YnV0IjtzOjU6InZhbHVlIjtzOjc6IitWYWxldXIiO3M6NjoiYWN0aXZlIjtzOjY6IithY3RpZiI7czoyNToiYXBwb2ludG1lbnRfcmVqZWN0X3JlYXNvbiI7czoyMToiK1JlbmRlei12b3VzK2RlK3JlZnVzIjtzOjY6InNlYXJjaCI7czo5OiIrQ2hlcmNoZXIiO3M6MjQ6ImN1c3RvbV90aGFua3lvdV9wYWdlX3VybCI7czo0MDoiK1VSTCtkZStwYWdlK3BlcnNvbm5hbGlzJUMzJUE5ZStUaGFua3lvdSI7czoxNDoicHJpY2VfcGVyX3VuaXQiO3M6Mzg6IitQcml4KyVFMiU4MCU4QiVFMiU4MCU4QnBhcit1bml0JUMzJUE5IjtzOjE5OiJjb25maXJtX2FwcG9pbnRtZW50IjtzOjI1OiIrQ29uZmlybWVyK2xlK3JlbmRlei12b3VzIjtzOjEzOiJyZWplY3RfcmVhc29uIjtzOjE4OiIrUmVqZXRlcitsYStyYWlzb24iO3M6MjM6ImRlbGV0ZV90aGlzX2FwcG9pbnRtZW50IjtzOjI1OiIrU3VwcHJpbWVyK2NlK3JlbmRlei12b3VzIjtzOjE5OiJjbG9zZV9ub3RpZmljYXRpb25zIjtzOjI1OiIrRmVybWVyK2xlcytub3RpZmljYXRpb25zIjtzOjIxOiJib29raW5nX2NhbmNlbF9yZWFzb24iO3M6MzQ6IlIlQzMlQTlzZXJ2YXRpb24rQW5udWxlcitsYStyYWlzb24iO3M6MTk6InNlcnZpY2VfY29sb3JfYmFkZ2UiO3M6Mjg6IitCYWRnZStkZStjb3VsZXVyK2RlK3NlcnZpY2UiO3M6MzI6Im1hbmFnZV9wcmljZV9jYWxjdWxhdGlvbl9tZXRob2RzIjtzOjQ4OiIrRyVDMyVBOXJlcitsZXMrbSVDMyVBOXRob2RlcytkZStjYWxjdWwrZGVzK3ByaXgiO3M6Mjk6Im1hbmFnZV9hZGRvbnNfb2ZfdGhpc19zZXJ2aWNlIjtzOjM2OiIrRyVDMyVBOXJlcitsZXMrYWRkb25zK2RlK2NlK3NlcnZpY2UiO3M6MTc6InNlcnZpY2VfaXNfYm9va2VkIjtzOjMzOiIrTGUrc2VydmljZStlc3QrciVDMyVBOXNlcnYlQzMlQTkiO3M6MTk6ImRlbGV0ZV90aGlzX3NlcnZpY2UiO3M6MjA6IlN1cHByaW1lcitjZStzZXJ2aWNlIjtzOjE0OiJkZWxldGVfc2VydmljZSI7czoyMDoiU3VwcHJpbWVyK2xlK3NlcnZpY2UiO3M6MTI6InJlbW92ZV9pbWFnZSI7czoyMDoiK1N1cHByaW1lcitsJTI3aW1hZ2UiO3M6MjA6InJlbW92ZV9zZXJ2aWNlX2ltYWdlIjtzOjMxOiIrU3VwcHJpbWVyK2wlMjdpbWFnZStkdStzZXJ2aWNlIjtzOjQwOiJjb21wYW55X25hbWVfaXNfdXNlZF9mb3JfaW52b2ljZV9wdXJwb3NlIjtzOjczOiIrTGUrbm9tK2RlK2wlMjdlbnRyZXByaXNlK2VzdCt1dGlsaXMlQzMlQTkrJUMzJUEwK2RlcytmaW5zK2RlK2ZhY3R1cmF0aW9uIjtzOjE5OiJyZW1vdmVfY29tcGFueV9sb2dvIjtzOjM1OiJTdXBwcmltZXIrbGUrbG9nbytkZStsJTI3ZW50cmVwcmlzZSI7czo4MDoidGltZV9pbnRlcnZhbF9pc19oZWxwZnVsX3RvX3Nob3dfdGltZV9kaWZmZXJlbmNlX2JldHdlZW5fYXZhaWxhYmlsaXR5X3RpbWVfc2xvdHMiO3M6MTI4OiIrTCUyN2ludGVydmFsbGUrZGUrdGVtcHMrZXN0K3V0aWxlK3BvdXIrYWZmaWNoZXIrbGUrZCVDMyVBOWNhbGFnZStob3JhaXJlK2VudHJlK2xlcytjciVDMyVBOW5lYXV4K2hvcmFpcmVzK2RlK2Rpc3BvbmliaWxpdCVDMyVBOSI7czoxMzE6Im1pbmltdW1fYWR2YW5jZV9ib29raW5nX3RpbWVfcmVzdHJpY3RfY2xpZW50X3RvX2Jvb2tfbGFzdF9taW51dGVfYm9va2luZ19zb190aGF0X3lvdV9zaG91bGRfaGF2ZV9zdWZmaWNpZW50X3RpbWVfYmVmb3JlX2FwcG9pbnRtZW50IjtzOjIwMToiK0xlK3RlbXBzK21pbmltdW0rZGUrciVDMyVBOXNlcnZhdGlvbislQzMlQTArbCUyN2F2YW5jZStsaW1pdGUrbGUrY2xpZW50KyVDMyVBMCtsYStyJUMzJUE5c2VydmF0aW9uK2RlK2Rlcm5pJUMzJUE4cmUrbWludXRlJTJDK2RlK3NvcnRlK3F1ZSt2b3VzK2RldnJpZXorYXZvaXIrc3VmZmlzYW1tZW50K2RlK3RlbXBzK2F2YW50K2xlK3JlbmRlei12b3VzIjtzOjk0OiJjYW5jZWxsYXRpb25fYnVmZmVyX2hlbHBzX3NlcnZpY2VfcHJvdmlkZXJzX3RvX2F2b2lkX2xhc3RfbWludXRlX2NhbmNlbGxhdGlvbl9ieV90aGVpcl9jbGllbnRzIjtzOjEzNToiK1VuK3RhbXBvbitkJTI3YW5udWxhdGlvbithaWRlK2xlcytmb3Vybmlzc2V1cnMrZGUrc2VydmljZXMrJUMzJUEwKyVDMyVBOXZpdGVyK2wlMjdhbm51bGF0aW9uK2RlK2Rlcm5pJUMzJUE4cmUrbWludXRlK3BhcitsZXVycytjbGllbnRzIjtzOjEyODoicGFydGlhbF9wYXltZW50X29wdGlvbl93aWxsX2hlbHBfeW91X3RvX2NoYXJnZV9wYXJ0aWFsX3BheW1lbnRfb2ZfdG90YWxfYW1vdW50X2Zyb21fY2xpZW50X2FuZF9yZW1haW5pbmdfeW91X2Nhbl9jb2xsZWN0X2xvY2FsbHkiO3M6MTQ2OiIrT3B0aW9uK2RlK3BhaWVtZW50K3BhcnRpZWwrdm91cythaWRlcmErJUMzJUEwK2ZhY3R1cmVyK2xlK3BhaWVtZW50K3BhcnRpZWwrZHUrbW9udGFudCt0b3RhbCtkdStjbGllbnQrZXQrcmVzdGFudCt2b3VzK3BvdXZleitjb2xsZWN0ZXIrbG9jYWxlbWVudCI7czoxNDI6ImFsbG93X211bHRpcGxlX2FwcG9pbnRtZW50X2Jvb2tpbmdfYXRfc2FtZV90aW1lX3Nsb3Rfd2lsbF9hbGxvd195b3VfdG9fc2hvd19hdmFpbGFiaWxpdHlfdGltZV9zbG90X2V2ZW5feW91X2hhdmVfYm9va2luZ19hbHJlYWR5X2Zvcl90aGF0X3RpbWUiO3M6MjI1OiJBdXRvcmlzZXIrbGErciVDMyVBOXNlcnZhdGlvbitkZStwbHVzaWV1cnMrcmVuZGV6LXZvdXMrJUMzJUEwK2xhK20lQzMlQUFtZStoZXVyZSUyQyt2b3VzK3Blcm1ldHRyYStkJTI3YWZmaWNoZXIrbGErcGxhZ2UrZGUrZGlzcG9uaWJpbGl0JUMzJUE5JTJDK20lQzMlQUFtZStzaSt2b3VzK2F2ZXorZCVDMyVBOWolQzMlQTArciVDMyVBOXNlcnYlQzMlQTkrcG91citjZXR0ZStwJUMzJUE5cmlvZGUiO3M6ODM6IndpdGhfRW5hYmxlX29mX3RoaXNfZmVhdHVyZV9BcHBvaW50bWVudF9yZXF1ZXN0X2Zyb21fY2xpZW50c193aWxsX2JlX2F1dG9fY29uZmlybWVkIjtzOjExNToiQXZlYytBY3RpdmVyK2NldHRlK2ZvbmN0aW9ubmFsaXQlQzMlQTklMkMrbGErZGVtYW5kZStkZStyZW5kZXotdm91cytkZXMrY2xpZW50cytzZXJhK2NvbmZpcm0lQzMlQTllK2F1dG9tYXRpcXVlbWVudCI7czo0MDoid3JpdGVfaHRtbF9jb2RlX2Zvcl90aGVfcmlnaHRfc2lkZV9wYW5lbCI7czo0NToiRWNyaXJlK2R1K2NvZGUrSFRNTCtwb3VyK2xlK3Bhbm5lYXUrZGUrZHJvaXRlIjtzOjQ4OiJkb195b3Vfd2FudF90b19zaG93X3N1YmhlYWRlcnNfYmVsb3dfdGhlX2hlYWRlcnMiO3M6Njc6IitWb3VsZXotdm91cythZmZpY2hlcitsZXMrc291cy1lbi10JUMzJUFBdGVzK3NvdXMrbGVzK2VuLXQlQzMlQUF0ZXMiO3M6NDc6InlvdV9jYW5fc2hvd19oaWRlX2NvdXBvbl9pbnB1dF9vbl9jaGVja291dF9mb3JtIjtzOjkwOiIrVm91cytwb3V2ZXorYWZmaWNoZXIrJTJGK21hc3F1ZXIrbGVzK2VudHIlQzMlQTllcytkZStjb3Vwb24rc3VyK2xlK2Zvcm11bGFpcmUrZGUrcGFpZW1lbnQiO3M6ODI6IndpdGhfdGhpc19mZWF0dXJlX3lvdV9jYW5fYWxsb3dfYV92aXNpdG9yX3RvX2Jvb2tfYXBwb2ludG1lbnRfd2l0aG91dF9yZWdpc3RyYXRpb24iO3M6MTIxOiIrQXZlYytjZXR0ZStmb25jdGlvbm5hbGl0JUMzJUE5JTJDK3ZvdXMrcG91dmV6K2F1dG9yaXNlcit1bit2aXNpdGV1cislQzMlQTArciVDMyVBOXNlcnZlcit1bityZW5kZXotdm91cytzYW5zK2luc2NyaXB0aW9uIjtzOjY4OiJwYXlwYWxfYXBpX3VzZXJuYW1lX2Nhbl9nZXRfZWFzaWx5X2Zyb21fZGV2ZWxvcGVyX3BheXBhbF9jb21fYWNjb3VudCI7czoxMzE6IitMZStub20rZCUyN3V0aWxpc2F0ZXVyK2RlK2wlMjdBUEkrUGF5cGFsK3BldXQrJUMzJUFBdHJlK2ZhY2lsZW1lbnQrdCVDMyVBOWwlQzMlQTljaGFyZyVDMyVBOStkZXB1aXMrbGUrY29tcHRlK2RldmVsb3Blci5wYXlwYWwuY29tIjtzOjY4OiJwYXlwYWxfYXBpX3Bhc3N3b3JkX2Nhbl9nZXRfZWFzaWx5X2Zyb21fZGV2ZWxvcGVyX3BheXBhbF9jb21fYWNjb3VudCI7czoxMTE6IkxlK21vdCtkZStwYXNzZStkZStsJTI3QVBJK1BheXBhbCtwZXV0KyVDMyVBQXRyZStmYWNpbGVtZW50K29idGVudSslQzMlQTArcGFydGlyK2R1K2NvbXB0ZStkZXZlbG9wZXIucGF5cGFsLmNvbSI7czo2OToicGF5cGFsX2FwaV9zaWduYXR1cmVfY2FuX2dldF9lYXNpbHlfZnJvbV9kZXZlbG9wZXJfcGF5cGFsX2NvbV9hY2NvdW50IjtzOjExMDoiK0xhK3NpZ25hdHVyZStkZStsJTI3QVBJK1BheXBhbCtwZXV0KyVDMyVBQXRyZStmYWNpbGVtZW50K29idGVudWUrJUMzJUEwK3BhcnRpcitkdStjb21wdGUrZGV2ZWxvcGVyLnBheXBhbC5jb20iO3M6NjI6ImxldF91c2VyX3BheV90aHJvdWdoX2NyZWRpdF9jYXJkX3dpdGhvdXRfaGF2aW5nX3BheXBhbF9hY2NvdW50IjtzOjgzOiIrTGFpc3NlcitsJTI3dXRpbGlzYXRldXIrcGF5ZXIrcGFyK2NhcnRlK2RlK2NyJUMzJUE5ZGl0K3NhbnMrYXZvaXIrZGUrY29tcHRlK1BheXBhbCI7czo1OToieW91X2Nhbl9lbmFibGVfcGF5cGFsX3Rlc3RfbW9kZV9mb3Jfc2FuZGJveF9hY2NvdW50X3Rlc3RpbmciO3M6NzU6IlZvdXMrcG91dmV6K2FjdGl2ZXIrbGUrbW9kZStkZSt0ZXN0K1BheXBhbCtwb3VyK2xlcyt0ZXN0cytkZStjb21wdGUrc2FuZGJveCI7czo2NjoieW91X2Nhbl9lbmFibGVfYXV0aG9yaXplX25ldF90ZXN0X21vZGVfZm9yX3NhbmRib3hfYWNjb3VudF90ZXN0aW5nIjtzOjgzOiIrVm91cytwb3V2ZXorYWN0aXZlcitsZSttb2RlK2RlK3Rlc3QrQXV0aG9yaXplLk5ldCtwb3VyK2xlcyt0ZXN0cytkZStjb21wdGUrc2FuZGJveCI7czoxNjoiZWRpdF9jb3Vwb25fY29kZSI7czoyMzoiK01vZGlmaWVyK2xlK2NvZGUrcHJvbW8iO3M6MTY6ImRlbGV0ZV9wcm9tb2NvZGUiO3M6MjI6IlN1cHByaW1lcitQcm9tb2NvZGUlM0YiO3M6MzY6ImNvdXBvbl9jb2RlX3dpbGxfd29ya19mb3Jfc3VjaF9saW1pdCI7czo1MzoiK0xlK2NvZGUrZGUrY291cG9uK2ZvbmN0aW9ubmVyYStwb3VyK3VuZSt0ZWxsZStsaW1pdGUiO3M6MzU6ImNvdXBvbl9jb2RlX3dpbGxfd29ya19mb3Jfc3VjaF9kYXRlIjtzOjQ3OiIrTGUrY29kZStkdStjb3Vwb24rZm9uY3Rpb25uZXJhK3BvdXIrY2V0dGUrZGF0ZSI7czoxNjA6ImNvdXBvbl92YWx1ZV93b3VsZF9iZV9jb25zaWRlcl9hc19wZXJjZW50YWdlX2luX3BlcmNlbnRhZ2VfbW9kZV9hbmRfaW5fZmxhdF9tb2RlX2l0X3dpbGxfYmVfY29uc2lkZXJfYXNfYW1vdW50X25vX25lZWRfdG9fYWRkX3BlcmNlbnRhZ2Vfc2lnbl9pdF93aWxsX2F1dG9fYWRkZWQiO3M6MjY5OiIrTGErdmFsZXVyK2R1K2NvdXBvbitzZXJhK2NvbnNpZCVDMyVBOXIlQzMlQTllK2NvbW1lK3VuK3BvdXJjZW50YWdlK2VuK21vZGUrcG91cmNlbnRhZ2UrZXQrZW4rbW9kZStwbGF0JTJDK2VsbGUrc2VyYStjb25zaWQlQzMlQTlyJUMzJUE5ZStjb21tZSt1bittb250YW50LitJbCtuJTI3ZXN0K3BhcytuJUMzJUE5Y2Vzc2FpcmUrZCUyN2Fqb3V0ZXIrdW4rc2lnbmUrZGUrcG91cmNlbnRhZ2UrcG91citxdSUyN2lsK3NvaXQrYXV0b21hdGlxdWVtZW50K2Fqb3V0JUMzJUE5LiI7czoxNDoidW5pdF9pc19ib29rZWQiO3M6Mzc6IkwlMjd1bml0JUMzJUE5K2VzdCtyJUMzJUE5c2VydiVDMyVBOWUiO3M6MjQ6ImRlbGV0ZV90aGlzX3NlcnZpY2VfdW5pdCI7czo0MDoiU3VwcHJpbWVyK2NldHRlK3VuaXQlQzMlQTkrZGUrc2VydmljZSUzRiI7czoxOToiZGVsZXRlX3NlcnZpY2VfdW5pdCI7czozNToiU3VwcHJpbWVyK2wlMjd1bml0JUMzJUE5K2RlK3NlcnZpY2UiO3M6MTc6Im1hbmFnZV91bml0X3ByaWNlIjtzOjI4OiIrRyVDMyVBOXJlcitsZStwcml4K3VuaXRhaXJlIjtzOjE5OiJleHRyYV9zZXJ2aWNlX3RpdGxlIjtzOjM2OiJUaXRyZStkZStzZXJ2aWNlK3N1cHBsJUMzJUE5bWVudGFpcmUiO3M6MTU6ImFkZG9uX2lzX2Jvb2tlZCI7czoyNzoiQWRkb24rZXN0K3IlQzMlQTlzZXJ2JUMzJUE5IjtzOjI1OiJkZWxldGVfdGhpc19hZGRvbl9zZXJ2aWNlIjtzOjMzOiJTdXBwcmltZXIrY2Urc2VydmljZStkJTI3YWRkb24lM0YiO3M6MjM6ImNob29zZV95b3VyX2FkZG9uX2ltYWdlIjtzOjI4OiJDaG9pc2lzc2V6K3ZvdHJlK2ltYWdlK2FkZG9uIjtzOjExOiJhZGRvbl9pbWFnZSI7czoxNjoiK0ltYWdlK2QlMjdhZGRvbiI7czoxOToiYWRtaW5pc3RyYXRvcl9lbWFpbCI7czoyNzoiRW1haWwrZGUrbCUyN2FkbWluaXN0cmF0ZXVyIjtzOjIxOiJhZG1pbl9wcm9maWxlX2FkZHJlc3MiO3M6ODoiK0FkcmVzc2UiO3M6MjA6ImRlZmF1bHRfY291bnRyeV9jb2RlIjtzOjExOiJDb2RlK3Bvc3RhbCI7czoxOToiY2FuY2VsbGF0aW9uX3BvbGljeSI7czoyNToiK1BvbGl0aXF1ZStkJTI3YW5udWxhdGlvbiI7czoxNDoidHJhbnNhY3Rpb25faWQiO3M6Mjc6IitpZGVudGlmaWFudCtkZSt0cmFuc2FjdGlvbiI7czoxMjoic21zX3JlbWluZGVyIjtzOjEzOiJTTVMrZGUrcmFwcGVsIjtzOjE3OiJzYXZlX3Ntc19zZXR0aW5ncyI7czozNjoiK0VucmVnaXN0cmVyK2xlcytwYXJhbSVDMyVBOHRyZXMrU01TIjtzOjExOiJzbXNfc2VydmljZSI7czoxMToiU2VydmljZStTTVMiO3M6NzE6Iml0X3dpbGxfc2VuZF9zbXNfdG9fc2VydmljZV9wcm92aWRlcl9hbmRfY2xpZW50X2Zvcl9hcHBvaW50bWVudF9ib29raW5nIjtzOjk4OiIrSWwrZW52ZXJyYStkZXMrc21zK2F1K2ZvdXJuaXNzZXVyK2RlK3NlcnZpY2UrZXQrYXUrY2xpZW50K3BvdXIrbGErciVDMyVBOXNlcnZhdGlvbitkZStyZW5kZXotdm91cyI7czoyMzoidHdpbGlvX2FjY291bnRfc2V0dGluZ3MiO3M6MzM6IitUd2lsaW8rUGFyYW0lQzMlQTh0cmVzK2R1K2NvbXB0ZSI7czoyMjoicGxpdm9fYWNjb3VudF9zZXR0aW5ncyI7czozMToiUGFyYW0lQzMlQTh0cmVzK2R1K2NvbXB0ZStQbGl2byI7czoxMToiYWNjb3VudF9zaWQiO3M6MTA6IkNvbXB0ZStTSUQiO3M6MTA6ImF1dGhfdG9rZW4iO3M6Mjc6IitKZXRvbitkJTI3YXV0aGVudGlmaWNhdGlvbiI7czoyMDoidHdpbGlvX3NlbmRlcl9udW1iZXIiO3M6Mzk6IitOdW0lQzMlQTlybytkJTI3ZXhwJUMzJUE5ZGl0ZXVyK1R3aWxpbyI7czoxOToicGxpdm9fc2VuZGVyX251bWJlciI7czo0MDoiTnVtJUMzJUE5cm8rZCUyN2V4cCVDMyVBOWRpdGV1citkZStQbGl2byI7czoxOToidHdpbGlvX3Ntc19zZXR0aW5ncyI7czoyNjoiVHdpbGlvK1BhcmFtJUMzJUE4dHJlcytTTVMiO3M6MTg6InBsaXZvX3Ntc19zZXR0aW5ncyI7czoyNjoiK1BhcmFtJUMzJUE4dHJlcytTTVMrUGxpdm8iO3M6MTg6InR3aWxpb19zbXNfZ2F0ZXdheSI7czoxODoiVHdpbGlvK1NNUytHYXRld2F5IjtzOjE3OiJwbGl2b19zbXNfZ2F0ZXdheSI7czoyMToiK1Bhc3NlcmVsbGUrU01TK1BsaXZvIjtzOjE4OiJzZW5kX3Ntc190b19jbGllbnQiO3M6MjQ6IkVudm95ZXIrdW4rU01TK2F1K2NsaWVudCI7czoxNzoic2VuZF9zbXNfdG9fYWRtaW4iO3M6NDA6IkVudm95ZXIrdW4rU01TKyVDMyVBMCtsJTI3YWRtaW5pc3RyYXRldXIiO3M6MTg6ImFkbWluX3Bob25lX251bWJlciI7czo1NjoiTnVtJUMzJUE5cm8rZGUrdCVDMyVBOWwlQzMlQTlwaG9uZStkZStsJTI3YWRtaW5pc3RyYXRldXIiO3M6NDE6ImF2YWlsYWJsZV9mcm9tX3dpdGhpbl95b3VyX3R3aWxpb19hY2NvdW50IjtzOjM5OiIrRGlzcG9uaWJsZStkZXB1aXMrdm90cmUrY29tcHRlK1R3aWxpby4iO3M6NTg6Im11c3RfYmVfYV92YWxpZF9udW1iZXJfYXNzb2NpYXRlZF93aXRoX3lvdXJfdHdpbGlvX2FjY291bnQiO3M6NzM6IitEb2l0KyVDMyVBQXRyZSt1bitub21icmUrdmFsaWRlK2Fzc29jaSVDMyVBOSslQzMlQTArdm90cmUrY29tcHRlK1R3aWxpby4iO3M6NjU6ImVuYWJsZV9vcl9kaXNhYmxlX3NlbmRfc21zX3RvX2NsaWVudF9mb3JfYXBwb2ludG1lbnRfYm9va2luZ19pbmZvIjtzOjExMzoiK0FjdGl2ZXIrb3UrZCVDMyVBOXNhY3RpdmVyJTJDK0Vudm95ZXIrdW4rU01TK2F1K2NsaWVudCtwb3VyK2xlcytpbmZvcm1hdGlvbnMrZGUrciVDMyVBOXNlcnZhdGlvbitkZStyZW5kZXotdm91cy4iO3M6NjQ6ImVuYWJsZV9vcl9kaXNhYmxlX3NlbmRfc21zX3RvX2FkbWluX2Zvcl9hcHBvaW50bWVudF9ib29raW5nX2luZm8iO3M6MTI4OiJBY3RpdmVyK291K2QlQzMlQTlzYWN0aXZlciUyQytFbnZveWVyK3VuK1NNUyslQzMlQTArbCUyN2FkbWluaXN0cmF0ZXVyK3BvdXIrbGVzK2luZm9ybWF0aW9ucytkZStyJUMzJUE5c2VydmF0aW9uK2RlK3JlbmRlei12b3VzLiI7czoyMDoidXBkYXRlZF9zbXNfc2V0dGluZ3MiO3M6MzU6IlBhcmFtJUMzJUE4dHJlcytTTVMrbWlzKyVDMyVBMCtqb3VyIjtzOjUxOiJwYXJraW5nX2F2YWlsYWJpbGl0eV9mcm9udGVuZF9vcHRpb25fZGlzcGxheV9zdGF0dXMiO3M6ODoiK1BhcmtpbmciO3M6NDU6InZhY2N1bV9jbGVhbmVyX2Zyb250ZW5kX29wdGlvbl9kaXNwbGF5X3N0YXR1cyI7czoxMToiK0FzcGlyYXRldXIiO3M6Mzoib19uIjtzOjQ6IitTdXIiO3M6Mzoib2ZmIjtzOjI6IkRlIjtzOjY6ImVuYWJsZSI7czo4OiIrQWN0aXZlciI7czo3OiJkaXNhYmxlIjtzOjE1OiJEJUMzJUE5c2FjdGl2ZXIiO3M6NzoibW9udGhseSI7czo3OiJNZW5zdWVsIjtzOjY6IndlZWtseSI7czoxMzoiK0hlYmRvbWFkYWlyZSI7czoxNDoiZW1haWxfdGVtcGxhdGUiO3M6MjQ6IitNT0QlQzMlODhMRStERStDT1VSUklFTCI7czoxNjoic21zX25vdGlmaWNhdGlvbiI7czoxNzoiK05PVElGSUNBVElPTitTTVMiO3M6MTI6InNtc190ZW1wbGF0ZSI7czoxNToiU01TK01PRCVDMyU4OExFIjtzOjIzOiJlbWFpbF90ZW1wbGF0ZV9zZXR0aW5ncyI7czo2MDoiUGFyYW0lQzMlQTh0cmVzK2R1K21vZCVDMyVBOGxlK2RlK2NvdXJyaWVyKyVDMyVBOWxlY3Ryb25pcXVlIjtzOjIyOiJjbGllbnRfZW1haWxfdGVtcGxhdGVzIjtzOjI4OiJNb2QlQzMlQThsZStkJTI3ZW1haWwrY2xpZW50IjtzOjIwOiJjbGllbnRfc21zX3RlbXBsYXRlcyI7czoyNjoiK01vZCVDMyVBOGxlK2RlK1NNUytjbGllbnQiO3M6MjA6ImFkbWluX2VtYWlsX3RlbXBsYXRlIjtzOjQzOiJNb2QlQzMlQThsZStkJTI3ZW1haWwrZGUrbCUyN2FkbWluaXN0cmF0ZXVyIjtzOjE4OiJhZG1pbl9zbXNfdGVtcGxhdGUiO3M6MjQ6Ik1vZCVDMyVBOGxlK2RlK1NNUytBZG1pbiI7czo0OiJ0YWdzIjtzOjE1OiIrTW90cytjbCVDMyVBOXMiO3M6MTI6ImJvb2tpbmdfZGF0ZSI7czoyNDoiZGF0ZStkZStyJUMzJUE5c2VydmF0aW9uIjtzOjEyOiJzZXJ2aWNlX25hbWUiO3M6MTU6IitOb20rZHUrc2VydmljZSI7czoxMzoiYnVzaW5lc3NfbG9nbyI7czoxNDoiK2J1c2luZXNzX2xvZ28iO3M6MTc6ImJ1c2luZXNzX2xvZ29fYWx0IjtzOjE4OiIrYnVzaW5lc3NfbG9nb19hbHQiO3M6MTA6ImFkbWluX25hbWUiO3M6MTE6IithZG1pbl9uYW1lIjtzOjEwOiJtZXRob2RuYW1lIjtzOjE2OiJub21fbSVDMyVBOXRob2RlIjtzOjk6ImZpcnN0bmFtZSI7czoxMjoiK1ByJUMzJUE5bm9tIjtzOjg6Imxhc3RuYW1lIjtzOjE1OiIrbm9tK2RlK2ZhbWlsbGUiO3M6MTI6ImNsaWVudF9lbWFpbCI7czoxMjoiY2xpZW50X2VtYWlsIjtzOjIxOiJ2YWNjdW1fY2xlYW5lcl9zdGF0dXMiO3M6MjI6Iit2YWNjdW1fY2xlYW5lcl9zdGF0dXMiO3M6MTQ6InBhcmtpbmdfc3RhdHVzIjtzOjE0OiJwYXJraW5nX3N0YXR1cyI7czoxNToiYXBwX3JlbWFpbl90aW1lIjtzOjE1OiJhcHBfcmVtYWluX3RpbWUiO3M6MTM6InJlamVjdF9zdGF0dXMiO3M6MTM6InJlamVjdF9zdGF0dXMiO3M6MTM6InNhdmVfdGVtcGxhdGUiO3M6MjY6IkVucmVnaXN0cmVyK2xlK21vZCVDMyVBOGxlIjtzOjE2OiJkZWZhdWx0X3RlbXBsYXRlIjtzOjI3OiJNb2QlQzMlQThsZStwYXIrZCVDMyVBOWZhdXQiO3M6MjE6InNtc190ZW1wbGF0ZV9zZXR0aW5ncyI7czozNToiK1BhcmFtJUMzJUE4dHJlcytkdSttb2QlQzMlQThsZStTTVMiO3M6MTA6InNlY3JldF9rZXkiO3M6MTg6IitDbGVmK3NlY3IlQzMlQTh0ZSI7czoxNToicHVibGlzaGFibGVfa2V5IjtzOjE5OiIrQ2wlQzMlQTkrcHVibGlhYmxlIjtzOjEyOiJwYXltZW50X2Zvcm0iO3M6MjI6IkZvcm11bGFpcmUrZGUrcGFpZW1lbnQiO3M6MTI6ImFwaV9sb2dpbl9pZCI7czoxOToiSUQrZGUrY29ubmV4aW9uK0FQSSI7czoxNToidHJhbnNhY3Rpb25fa2V5IjtzOjI0OiIrQ2wlQzMlQTkrZGUrdHJhbnNhY3Rpb24iO3M6MTI6InNhbmRib3hfbW9kZSI7czoyMToiTW9kZStiYWMrJUMzJUEwK3NhYmxlIjtzOjQwOiJhdmFpbGFibGVfZnJvbV93aXRoaW5feW91cl9wbGl2b19hY2NvdW50IjtzOjM4OiIrRGlzcG9uaWJsZStkZXB1aXMrdm90cmUrY29tcHRlK1BsaXZvLiI7czo1NzoibXVzdF9iZV9hX3ZhbGlkX251bWJlcl9hc3NvY2lhdGVkX3dpdGhfeW91cl9wbGl2b19hY2NvdW50IjtzOjcxOiJEb2l0KyVDMyVBQXRyZSt1bitub21icmUrdmFsaWRlK2Fzc29jaSVDMyVBOSslQzMlQTArdm90cmUrY29tcHRlK1BsaXZvLiI7czo5OiJ3aGF0c19uZXciO3M6MTY6IitRdW9pK2RlK25ldWYlM0YiO3M6MTM6ImNvbXBhbnlfcGhvbmUiO3M6MTk6IlQlQzMlQTlsJUMzJUE5cGhvbmUiO3M6MTM6ImNvbXBhbnlfX25hbWUiO3M6MjA6IitOb20rZGUrbGErY29tcGFnbmllIjtzOjEyOiJib29raW5nX3RpbWUiO3M6MTI6ImJvb2tpbmdfdGltZSI7czoxNDoiY29tcGFueV9fZW1haWwiO3M6MTM6ImNvbXBhbnlfZW1haWwiO3M6MTY6ImNvbXBhbnlfX2FkZHJlc3MiO3M6MzI6IitBZHJlc3NlK2RlK2xhK3NvY2klQzMlQTl0JUMzJUE5IjtzOjEyOiJjb21wYW55X196aXAiO3M6MTI6Iitjb21wYW55X3ppcCI7czoxNDoiY29tcGFueV9fcGhvbmUiO3M6MTM6ImNvbXBhbnlfcGhvbmUiO3M6MTQ6ImNvbXBhbnlfX3N0YXRlIjtzOjE0OiIrY29tcGFueV9zdGF0ZSI7czoxNjoiY29tcGFueV9fY291bnRyeSI7czoxNjoiK2NvbXBhbnlfY291bnRyeSI7czoxMzoiY29tcGFueV9fY2l0eSI7czoxMjoiY29tcGFueV9jaXR5IjtzOjEwOiJwYWdlX3RpdGxlIjtzOjE3OiIrVGl0cmUrZGUrbGErcGFnZSI7czoxMToiY2xpZW50X196aXAiO3M6MTA6ImNsaWVudF96aXAiO3M6MTM6ImNsaWVudF9fc3RhdGUiO3M6MTc6IislQzMlODl0YXQrY2xpZW50IjtzOjEyOiJjbGllbnRfX2NpdHkiO3M6MTE6ImNsaWVudF9jaXR5IjtzOjE1OiJjbGllbnRfX2FkZHJlc3MiO3M6MTU6IithZHJlc3NlX2NsaWVudCI7czoxMzoiY2xpZW50X19waG9uZSI7czoxMzoiK2NsaWVudF9waG9uZSI7czo0MDoiY29tcGFueV9sb2dvX2lzX3VzZWRfZm9yX2ludm9pY2VfcHVycG9zZSI7czo4NDoiK0xlK2xvZ28rZGUrbCUyN2VudHJlcHJpc2UrcyUyN3V0aWxpc2UrZGFucytsJTI3ZW1haWwrZXQrbGErcGFnZStkZStyJUMzJUE5c2VydmF0aW9uIjtzOjExOiJwcml2YXRlX2tleSI7czoyMToiK0NsJUMzJUE5K3ByaXYlQzMlQTllIjtzOjk6InNlbGxlcl9pZCI7czoyMjoiSWRlbnRpZmlhbnQrZHUrdmVuZGV1ciI7czoxNToicG9zdGFsX2NvZGVzX2VkIjtzOjE3NDoiVm91cytwb3V2ZXorYWN0aXZlcitvdStkJUMzJUE5c2FjdGl2ZXIrbGVzK2NvZGVzK3Bvc3RhdXgrb3UrbGVzK2NvZGVzK3Bvc3RhdXgrc2Vsb24rbGVzK2V4aWdlbmNlcytkZSt2b3RyZStwYXlzJTJDK2NhcitjZXJ0YWlucytwYXlzK2NvbW1lK2xlcytFQVUrbiUyN29udCtwYXMrZGUrY29kZStwb3N0YWwuIjtzOjE3OiJwb3N0YWxfY29kZXNfaW5mbyI7czo0OTY6IitWb3VzK3BvdXZleittZW50aW9ubmVyK2xlcytjb2Rlcytwb3N0YXV4K2RlK2RldXgrZmElQzMlQTdvbnMlM0ErJTIzKzEuK1ZvdXMrcG91dmV6K21lbnRpb25uZXIrbGVzK2NvZGVzK3Bvc3RhdXgrY29tcGxldHMrcG91citsZSttYXRjaCtjb21tZStLMUEyMzIlMkMrTDJBMzM0JTJDK0MzQTRDNC4rJTIzKzIuK1ZvdXMrcG91dmV6K3V0aWxpc2VyK2Rlcytjb2Rlcytwb3N0YXV4K3BhcnRpZWxzK3BvdXIrbGVzK2VudHIlQzMlQTllcytkZStjb3JyZXNwb25kYW5jZStkZStjYXJhY3QlQzMlQThyZXMrZyVDMyVBOW4lQzMlQTlyaXF1ZXMlMkMrcGFyK2V4ZW1wbGUuK0sxQSUyQytMMkElMkMrQzMlMkMrbGUrc3lzdCVDMyVBOG1lK2NvcnJlc3BvbmRyYSslQzMlQTArY2VzK2xldHRyZXMrZGUrZCVDMyVBOWJ1dCtkZStjb2RlK3Bvc3RhbCtzdXIrbGUrZGV2YW50K2V0K2lsK3ZvdXMrJUMzJUE5dml0ZXJhK2QlMjclQzMlQTljcmlyZSthdXRhbnQrZGUrY29kZXMrcG9zdGF1eC4iO3M6NToiZmlyc3QiO3M6ODoiK1ByZW1pZXIiO3M6Njoic2Vjb25kIjtzOjg6IitTZWNvbmRlIjtzOjU6InRoaXJkIjtzOjE0OiJUcm9pc2klQzMlQThtZSI7czo2OiJmb3VydGgiO3M6MTQ6IlF1YXRyaSVDMyVBOG1lIjtzOjU6ImZpZnRoIjtzOjE1OiIrQ2lucXVpJUMzJUE4bWUiO3M6MTA6ImZpcnN0X3dlZWsiO3M6MjI6IitQcmVtaSVDMyVBOHJlK3NlbWFpbmUiO3M6MTE6InNlY29uZF93ZWVrIjtzOjIyOiIrRGV1eGklQzMlQThtZStzZW1haW5lIjtzOjEwOiJ0aGlyZF93ZWVrIjtzOjIzOiIrVHJvaXNpJUMzJUE4bWUrc2VtYWluZSI7czoxMToiZm91cnRoX3dlZWsiO3M6MjM6IitRdWF0cmklQzMlQThtZStzZW1haW5lIjtzOjEwOiJmaWZ0aF93ZWVrIjtzOjIzOiIrQ2lucXVpJUMzJUE4bWUrc2VtYWluZSI7czo5OiJ0aGlzX3dlZWsiO3M6MTQ6IitDZXR0ZStzZW1haW5lIjtzOjY6Im1vbmRheSI7czo1OiJMdW5kaSI7czo3OiJ0dWVzZGF5IjtzOjY6IitNYXJkaSI7czo5OiJ3ZWRuZXNkYXkiO3M6OToiK01lcmNyZWRpIjtzOjg6InRodXJzZGF5IjtzOjY6IitKZXVkaSI7czo2OiJmcmlkYXkiO3M6OToiK1ZlbmRyZWRpIjtzOjg6InNhdHVyZGF5IjtzOjY6InNhbWVkaSI7czo2OiJzdW5kYXkiO3M6ODoiZGltYW5jaGUiO3M6MTk6ImFwcG9pbnRtZW50X3JlcXVlc3QiO3M6MjM6IitEZW1hbmRlK2RlK3JlbmRlei12b3VzIjtzOjIwOiJhcHBvaW50bWVudF9hcHByb3ZlZCI7czoyNjoiK1JlbmRlei12b3VzK2FwcHJvdXYlQzMlQTkiO3M6MjA6ImFwcG9pbnRtZW50X3JlamVjdGVkIjtzOjI0OiIrUmVuZGV6LXZvdXMrcmVqZXQlQzMlQTkiO3M6Mjg6ImFwcG9pbnRtZW50X2NhbmNlbGxlZF9ieV95b3UiO3M6MzI6IlJlbmRlei12b3VzK2FubnVsJUMzJUE5K3Bhcit2b3VzIjtzOjMwOiJhcHBvaW50bWVudF9yZXNjaGVkdWxlZF9ieV95b3UiO3M6MzQ6IitSZW5kZXotdm91cytyZXBvcnQlQzMlQTkrcGFyK3ZvdXMiO3M6Mjc6ImNsaWVudF9hcHBvaW50bWVudF9yZW1pbmRlciI7czoyODoiUmFwcGVsK2RlK3JlbmRlei12b3VzK2NsaWVudCI7czo0MToibmV3X2FwcG9pbnRtZW50X3JlcXVlc3RfcmVxdWlyZXNfYXBwcm92YWwiO3M6NjM6IitOb3V2ZWxsZStkZW1hbmRlK2RlK3JlbmRlei12b3VzK24lQzMlQTljZXNzaXRlK3VuZSthcHByb2JhdGlvbiI7czozMzoiYXBwb2ludG1lbnRfY2FuY2VsbGVkX2J5X2N1c3RvbWVyIjtzOjM4OiIrUmVuZGV6LXZvdXMrYW5udWwlQzMlQTkrcGFyK2xlK2NsaWVudCI7czozNToiYXBwb2ludG1lbnRfcmVzY2hlZHVsZWRfYnlfY3VzdG9tZXIiO3M6NDM6IitSZW5kZXotdm91cytyZXByb2dyYW1tJUMzJUE5K3BhcitsZStjbGllbnQiO3M6MjY6ImFkbWluX2FwcG9pbnRtZW50X3JlbWluZGVyIjtzOjQxOiIrUmFwcGVsK2RlK3JlbmRlei12b3VzK2QlMjdhZG1pbmlzdHJhdGlvbiI7czoyNzoib2ZmX2RheXNfYWRkZWRfc3VjY2Vzc2Z1bGx5IjtzOjUzOiJMZXMram91cnMrZGUrY29uZyVDMyVBOStham91dCVDMyVBOXMrYXZlYytzdWNjJUMzJUE4cyI7czoyOToib2ZmX2RheXNfZGVsZXRlZF9zdWNjZXNzZnVsbHkiO3M6NTY6IitMZXMram91cnMrZGUrY29uZyVDMyVBOStzdXBwcmltJUMzJUE5cythdmVjK3N1Y2MlQzMlQThzIjtzOjE5OiJzb3JyeV9ub3RfYXZhaWxhYmxlIjtzOjMyOiIrRCVDMyVBOXNvbCVDMyVBOStub24rZGlzcG9uaWJsZSI7czo3OiJzdWNjZXNzIjtzOjExOiJTdWNjJUMzJUE4cyI7czo2OiJmYWlsZWQiO3M6MTc6IislQzMlODljaG91JUMzJUE5IjtzOjQ6Im9uY2UiO3M6MTI6IlVuZStmb2lzK3F1ZSI7czoxMDoiQmlfTW9udGhseSI7czo5OiJCaW1lbnN1ZWwiO3M6MTE6IkZvcnRuaWdodGx5IjtzOjEwOiIrQmltZW5zdWVsIjtzOjE1OiJSZWN1cnJlbmNlX1R5cGUiO3M6MjQ6IitUeXBlK2RlK3IlQzMlQTljdXJyZW5jZSI7czo5OiJiaV93ZWVrbHkiO3M6MTU6IitCaWhlYmRvbWFkYWlyZSI7czo1OiJEYWlseSI7czoxMzoiK2R1K3F1b3RpZGllbiI7czoyNDoiZ3Vlc3RfY3VzdG9tZXJzX2Jvb2tpbmdzIjtzOjI5OiIrUiVDMyVBOXNlcnZhdGlvbnMrZGUrY2xpZW50cyI7czozMDoiZXhpc3RpbmdfYW5kX25ld191c2VyX2NoZWNrb3V0IjtzOjU2OiJWJUMzJUE5cmlmaWNhdGlvbitkZStsJTI3dXRpbGlzYXRldXIrZXhpc3RhbnQrZXQrbm91dmVhdSI7czo3NToiaXRfd2lsbF9hbGxvd19vcHRpb25fZm9yX3VzZXJfdG9fZ2V0X2Jvb2tpbmdfd2l0aF9uZXdfdXNlcl9vcl9leGlzdGluZ191c2VyIjtzOjEyMzoiK0lsK3Blcm1ldHRyYSslQzMlQTArbCUyN3V0aWxpc2F0ZXVyK2QlMjdvYnRlbmlyK3VuZStyJUMzJUE5c2VydmF0aW9uK2F2ZWMrdW4rbm91dmVsK3V0aWxpc2F0ZXVyK291K3VuK3V0aWxpc2F0ZXVyK2V4aXN0YW50IjtzOjM6IjBfMSI7czoyOiIwMSI7czozOiIxXzEiO3M6MzoiMS4xIjtzOjM6IjFfMiI7czozOiIxLjIiO3M6MzoiMF8yIjtzOjI6IjAyIjtzOjQ6ImZyZWUiO3M6NzoiR3JhdHVpdCI7czozMDoic2hvd19jb21wYW55X2FkZHJlc3NfaW5faGVhZGVyIjtzOjU0OiJBZmZpY2hlcitsJTI3YWRyZXNzZStkZStsJTI3ZW50cmVwcmlzZStlbitlbi10JUMzJUFBdGUiO3M6MTM6ImNhbGVuZGFyX3dlZWsiO3M6MTE6IitMYStzZW1haW5lIjtzOjE0OiJjYWxlbmRhcl9tb250aCI7czo0OiJNb2lzIjtzOjEyOiJjYWxlbmRhcl9kYXkiO3M6MTI6ImpvdXJuJUMzJUE5ZSI7czoxNDoiY2FsZW5kYXJfdG9kYXkiO3M6MTQ6IitBdWpvdXJkJTI3aHVpIjtzOjE1OiJyZXN0b3JlX2RlZmF1bHQiO3M6MjY6IitSZXN0YXVyZXIrcGFyK2QlQzMlQTlmYXV0IjtzOjE1OiJzY3JvbGxhYmxlX2NhcnQiO3M6MjI6IkNoYXJpb3QrZCVDMyVBOWZpbGFibGUiO3M6MTI6Im1lcmNoYW50X2tleSI7czoyMToiK0NsJUMzJUE5K2R1K21hcmNoYW5kIjtzOjg6InNhbHRfa2V5IjtzOjE1OiJDbCVDMyVBOStkZStzZWwiO3M6MjE6InRleHRsb2NhbF9zbXNfZ2F0ZXdheSI7czoyNToiK1Bhc3NlcmVsbGUrU01TK1RleHRsb2NhbCI7czoyMjoidGV4dGxvY2FsX3Ntc19zZXR0aW5ncyI7czoyOToiUGFyYW0lQzMlQTh0cmVzK1NNUytUZXh0bG9jYWwiO3M6MjY6InRleHRsb2NhbF9hY2NvdW50X3NldHRpbmdzIjtzOjM2OiIrUGFyYW0lQzMlQTh0cmVzK2R1K2NvbXB0ZStUZXh0bG9jYWwiO3M6MTY6ImFjY291bnRfdXNlcm5hbWUiO3M6MzA6IitOb20rZCUyN3V0aWxpc2F0ZXVyK2R1K2NvbXB0ZSI7czoxNToiYWNjb3VudF9oYXNoX2lkIjtzOjI0OiIrSUQrZGUraGFjaGFnZStkdStjb21wdGUiO3M6Mzg6ImVtYWlsX2lkX3JlZ2lzdGVyZWRfd2l0aF95b3VfdGV4dGxvY2FsIjtzOjU0OiIrRm91cm5pc3Nleit2b3RyZStlbWFpbCtlbnJlZ2lzdHIlQzMlQTkrYXZlYyt0ZXh0bG9jYWwiO3M6Mjk6Imhhc2hfaWRfcHJvdmlkZWRfYnlfdGV4dGxvY2FsIjtzOjI5OiIrSGFzaCtpZCtmb3VybmkrcGFyK3RleHRsb2NhbCI7czoxMzoiYmFua190cmFuc2ZlciI7czo5OiIrVmlyZW1lbnQiO3M6OToiYmFua19uYW1lIjtzOjE0OiIrTm9tK2RlK2JhbnF1ZSI7czoxMjoiYWNjb3VudF9uYW1lIjtzOjE0OiIrTm9tK2R1K2NvbXB0ZSI7czoxNDoiYWNjb3VudF9udW1iZXIiO3M6MjI6IitOdW0lQzMlQTlybytkZStjb21wdGUiO3M6MTE6ImJyYW5jaF9jb2RlIjtzOjE5OiIrQ29kZStkZStzdWNjdXJzYWxlIjtzOjk6Imlmc2NfY29kZSI7czo5OiJDb2RlK0lGU0MiO3M6MTY6ImJhbmtfZGVzY3JpcHRpb24iO3M6MjU6IitEZXNjcmlwdGlvbitkZStsYStiYW5xdWUiO3M6MTU6InlvdXJfY2FydF9pdGVtcyI7czoyODoiTGVzK2FydGljbGVzK2RlK3ZvdHJlK3BhbmllciI7czoyMzoic2hvd19ob3dfd2lsbF93ZV9nZXRfaW4iO3M6MzE6IlNob3crQ29tbWVudCthbGxvbnMtbm91cytlbnRyZXIiO3M6MTY6InNob3dfZGVzY3JpcHRpb24iO3M6MjM6IitNb250cmVyK2xhK2Rlc2NyaXB0aW9uIjtzOjEyOiJiYW5rX2RldGFpbHMiO3M6MjY6IkNvb3Jkb25uJUMzJUE5ZXMrYmFuY2FpcmVzIjtzOjIxOiJva19yZW1vdmVfc2FtcGxlX2RhdGEiO3M6MTA6IkQlMjdhY2NvcmQiO3M6MTY6ImJvb2tfYXBwb2ludG1lbnQiO3M6MjA6IlJlbmRlei12b3VzK2F1K2xpdnJlIjtzOjI2OiJyZW1vdmVfc2FtcGxlX2RhdGFfbWVzc2FnZSI7czoyNjk6IitWb3VzK2Vzc2F5ZXorZGUrc3VwcHJpbWVyK2Rlcytkb25uJUMzJUE5ZXMrZCUyNyVDMyVBOWNoYW50aWxsb24uK1NpK3ZvdXMrc3VwcHJpbWV6K2Rlcytkb25uJUMzJUE5ZXMrZCUyNyVDMyVBOWNoYW50aWxsb24lMkMrdm90cmUrciVDMyVBOXNlcnZhdGlvbitsaSVDMyVBOWUrJUMzJUEwK2RlcytleGVtcGxlcytkZStzZXJ2aWNlcytzZXJhK2QlQzMlQTlmaW5pdGl2ZW1lbnQrc3VwcHJpbSVDMyVBOWUuK1BvdXIrY29udGludWVyJTJDK2NsaXF1ZXorc3VyKyUyN09LJTI3IjtzOjM5OiJyZWNvbW1lbmRlZF9pbWFnZV90eXBlX2pwZ19qcGVnX3BuZ19naWYiO3M6NjM6IiUyOFR5cGUrZCUyN2ltYWdlK3JlY29tbWFuZCVDMyVBOWUranBnJTJDK2pwZWclMkMrcG5nJTJDK2dpZiUyOSI7czoxMzoiYXV0aGV0aWNhdGlvbiI7czoxNjoiQXV0aGVudGlmaWNhdGlvbiI7czoxNToiZW5jcnlwdGlvbl90eXBlIjtzOjIwOiIrVHlwZStkZStjaGlmZnJlbWVudCI7czo1OiJwbGFpbiI7czo3OiIrUGxhaW5lIjtzOjQ6InRydWUiO3M6NToiK1ZyYWkiO3M6NToiZmFsc2UiO3M6NToiK0ZhdXgiO3M6MjU6ImNoYW5nZV9jYWxjdWxhdGlvbl9wb2xpY3kiO3M6MTg6Ik1vZGlmaWVyK2xlK2NhbGN1bCI7czo4OiJtdWx0aXBseSI7czoxMDoiTXVsdGlwbGllciI7czo1OiJlcXVhbCI7czoxMDoiKyVDMyU4OWdhbCI7czo3OiJ3YXJuaW5nIjtzOjEzOiIrQXR0ZW50aW9uJTIxIjtzOjEwOiJmaWVsZF9uYW1lIjtzOjE1OiIrTm9tK2RlK2RvbWFpbmUiO3M6MTQ6ImVuYWJsZV9kaXNhYmxlIjtzOjI0OiIrQWN0aXZlcitkJUMzJUE5c2FjdGl2ZXIiO3M6ODoicmVxdWlyZWQiO3M6MTk6IkNoYW1wcytvYmxpZ2F0b2lyZXMiO3M6MTA6Im1pbl9sZW5ndGgiO3M6MTc6Ikxvbmd1ZXVyK21pbmltYWxlIjtzOjEwOiJtYXhfbGVuZ3RoIjtzOjE3OiJMb25ndWV1cittYXhpbWFsZSI7czoyNzoiYXBwb2ludG1lbnRfZGV0YWlsc19zZWN0aW9uIjtzOjMyOiJEJUMzJUE5dGFpbHMrc3VyK2xlcytyZW5kZXotdm91cyI7czoxOTI6ImlmX3lvdV9hcmVfaGF2aW5nX2Jvb2tpbmdfc3lzdGVtX3doaWNoX25lZWRfdGhlX2Jvb2tpbmdfYWRkcmVzc190aGVuX3BsZWFzZV9tYWtlX3RoaXNfZmllbGRfZW5hYmxlX29yX2Vsc2VfaXRfd2lsbF9ub3RfYWJsZV90b190YWtlX3RoZV9ib29raW5nX2FkZHJlc3NfYW5kX2Rpc3BsYXlfYmxhbmtfYWRkcmVzc19pbl90aGVfYm9va2luZyI7czoyNDI6IlNpK3ZvdXMrYXZleit1bitzeXN0JUMzJUE4bWUrZGUrciVDMyVBOXNlcnZhdGlvbitxdWkrYStiZXNvaW4rZGUrbCUyN2FkcmVzc2UrZGUrciVDMyVBOXNlcnZhdGlvbiUyQyt2ZXVpbGxleithY3RpdmVyK2NlK2NoYW1wK3Npbm9uK2lsK25lK3BvdXJyYStwYXMrcHJlbmRyZStsJTI3YWRyZXNzZStkZStyJUMzJUE5c2VydmF0aW9uK2V0K2FmZmljaGVyK3VuZSthZHJlc3NlK3ZpZGUrZGFucytsYStyJUMzJUE5c2VydmF0aW9uIjtzOjIzOiJmcm9udF9sYW5ndWFnZV9kcm9wZG93biI7czoyMjoiK0Zyb250K0Ryb3Bkb3duK0xhbmd1ZSI7czo3OiJlbmFibGVkIjtzOjEyOiJBY3RpdiVDMyVBOWUiO3M6MTU6InZhY2N1bWVfY2xlYW5lciI7czoxMToiK0FzcGlyYXRldXIiO3M6MTM6InN0YWZmX21lbWJlcnMiO3M6MjU6IitMZXMrbWVtYnJlcytkdStwZXJzb25uZWwiO3M6MjA6ImFkZF9uZXdfc3RhZmZfbWVtYmVyIjtzOjM5OiIrQWpvdXRlcit1bitub3V2ZWF1K21lbWJyZStkdStwZXJzb25uZWwiO3M6NDoicm9sZSI7czoxMDoiK1IlQzMlQjRsZSI7czo1OiJzdGFmZiI7czo5OiJQZXJzb25uZWwiO3M6NToiYWRtaW4iO3M6NjoiK0FkbWluIjtzOjE1OiJzZXJ2aWNlX2RldGFpbHMiO3M6MjM6IkQlQzMlQTl0YWlscytkdStzZXJ2aWNlIjtzOjE1OiJ0ZWNobmljYWxfYWRtaW4iO3M6MTU6IkFkbWluK3RlY2huaXF1ZSI7czoxNDoiZW5hYmxlX2Jvb2tpbmciO3M6Mjg6IitBY3RpdmVyK2xhK3IlQzMlQTlzZXJ2YXRpb24iO3M6MTU6ImZsYXRfY29tbWlzc2lvbiI7czoyMzoiK0NvbW1pc3Npb24rJUMzJUEwK3BsYXQiO3M6NDE6Im1hbmFnZWFibGVfZm9ybV9maWVsZHNfZnJvbnRfYm9va2luZ19mb3JtIjtzOjcwOiIrQ2hhbXBzK2RlK2Zvcm11bGFpcmUrbWFuaWFibGVzK3BvdXIrbGUrZm9ybXVsYWlyZStkZStyJUMzJUE5c2VydmF0aW9uIjtzOjIyOiJtYW5hZ2VhYmxlX2Zvcm1fZmllbGRzIjtzOjMxOiIrQ2hhbXBzK2RlK2Zvcm11bGFpcmUrbWFuaWFibGVzIjtzOjM6InNtcyI7czozOiJTTVMiO3M6MzoiY3JtIjtzOjM6IkNSTSI7czo3OiJtZXNzYWdlIjtzOjc6Ik1lc3NhZ2UiO3M6MTI6InNlbmRfbWVzc2FnZSI7czoxOToiK0Vudm95ZXIrbGUrbWVzc2FnZSI7czoxMjoiYWxsX21lc3NhZ2VzIjtzOjE3OiJUb3VzK2xlcyttZXNzYWdlcyI7czo3OiJzdWJqZWN0IjtzOjExOiIrQXNzdWpldHRpciI7czoxNDoiYWRkX2F0dGFjaG1lbnQiO3M6MzA6IitBam91dGVyK3VuZStwaSVDMyVBOGNlK2pvaW50ZSI7czo0OiJzZW5kIjtzOjc6IkVudm95ZXIiO3M6NToiY2xvc2UiO3M6NjoiRmVybWVyIjtzOjIxOiJkZWxldGVfdGhpc19jdXN0b21lcj8iO3M6MjM6IitTdXBwcmltZXIrY2UrY2xpZW50JTNGIjtzOjM6InllcyI7czozOiJPdWkiO3M6MTY6ImFkZF9uZXdfY3VzdG9tZXIiO3M6MjY6IitBam91dGVyK3VuK25vdXZlYXUrY2xpZW50IjtzOjEwOiJhdHRhY2htZW50IjtzOjExOiJhdHRhY2hlbWVudCI7czo0OiJkYXRlIjtzOjIwOiJyZW5kZXotdm91cythbW91cmV1eCI7czoxNDoic2VlX2F0dGFjaG1lbnQiO3M6MjM6IitWb2lyK3BpJUMzJUE4Y2Uram9pbnRlIjtzOjEzOiJub19hdHRhY2htZW50IjtzOjIwOiIrUGFzK2QlMjdhdHRhY2hlbWVudCI7czoxNjoiY3Rfc3BlY2lhbF9vZmZlciI7czoyMDoiK09mZnJlK3NwJUMzJUE5Y2lhbGUiO3M6MjE6ImN0X3NwZWNpYWxfb2ZmZXJfdGV4dCI7czoyNjoiK09mZnJlK3NwJUMzJUE5Y2lhbGUrVGV4dGUiO30=', 'YToxOTE6e3M6MjQ6InBsZWFzZV9lbnRlcl9tZXJjaGFudF9JRCI7czo1MDoiVmV1aWxsZXorZW50cmVyK2wlMjdpZGVudGlmaWFudCtkdStjb21tZXIlQzMlQTdhbnQiO3M6MjM6InBsZWFzZV9lbnRlcl9zZWN1cmVfa2V5IjtzOjQ3OiJWZXVpbGxleitlbnRyZXIrbGErY2wlQzMlQTkrcyVDMyVBOWN1cmlzJUMzJUE5ZSI7czozODoicGxlYXNlX2VudGVyX2dvb2dsZV9jYWxlbmRlcl9hZG1pbl91cmwiO3M6NjQ6IitWZXVpbGxleitlbnRyZXIrbCUyN1VSTCtkJTI3YWRtaW5pc3RyYXRpb24rZHUrY2FsZW5kcmllcitHb29nbGUiO3M6NDE6InBsZWFzZV9lbnRlcl9nb29nbGVfY2FsZW5kZXJfZnJvbnRlbmRfdXJsIjtzOjUzOiJWZXVpbGxleitlbnRyZXIrbCUyN1VSTCtmcm9udGVuZCtkdStjYWxlbmRyaWVyK0dvb2dsZSI7czo0MjoicGxlYXNlX2VudGVyX2dvb2dsZV9jYWxlbmRlcl9jbGllbnRfc2VjcmV0IjtzOjQyOiJFbnRyZXorbGUrc2VjcmV0K2R1K2NsaWVudCtnb29nbGUrY2FsZW5kZXIiO3M6Mzg6InBsZWFzZV9lbnRlcl9nb29nbGVfY2FsZW5kZXJfY2xpZW50X0lEIjtzOjUwOiJWZXVpbGxleitlbnRyZXIrbCUyN0lEK2NsaWVudCtkdStjYWxlbmRyaWVyK0dvb2dsZSI7czozMToicGxlYXNlX2VudGVyX2dvb2dsZV9jYWxlbmRlcl9JRCI7czo1MzoiK1ZldWlsbGV6K2VudHJlcitsJTI3aWRlbnRpZmlhbnQrZHUrY2FsZW5kcmllcitHb29nbGUiO3M6Mjg6InlvdV9jYW5ub3RfYm9va19vbl9wYXN0X2RhdGUiO3M6NjQ6IlZvdXMrbmUrcG91dmV6K3BhcytyJUMzJUE5c2VydmVyKyVDMyVBMCt1bmUrZGF0ZSthbnQlQzMlQTlyaWV1cmUiO3M6MTg6IkludmFsaWRfSW1hZ2VfVHlwZSI7czoyNDoiK1R5cGUrZCUyN2ltYWdlK2ludmFsaWRlIjtzOjMzOiJzZW9fc2V0dGluZ3NfdXBkYXRlZF9zdWNjZXNzZnVsbHkiO3M6NTI6IlBhcmFtJUMzJUE4dHJlcytTRU8rbWlzKyVDMyVBMCtqb3VyK2F2ZWMrc3VjYyVDMyVBOHMiO3M6Mjk6ImN1c3RvbWVyX2RlbGV0ZWRfc3VjY2Vzc2Z1bGx5IjtzOjM4OiIrQ2xpZW50K3N1cHByaW0lQzMlQTkrYXZlYytzdWNjJUMzJUE4cyI7czozMjoicGxlYXNlX2VudGVyX2JlbG93XzM2X2NoYXJhY3RlcnMiO3M6NDU6IlZldWlsbGV6K2VudHJlcitjaS1kZXNzb3VzKzM2K2NhcmFjdCVDMyVBOHJlcyI7czozODoiYXJlX3lvdV9zdXJlX3lvdV93YW50X3RvX2RlbGV0ZV9jbGllbnQiO3M6NTg6IislQzMlOEF0ZXMtdm91cytzJUMzJUJCcitkZSt2b3Vsb2lyK3N1cHByaW1lcitsZStjbGllbnQlM0YiO3M6MzA6InBsZWFzZV9zZWxlY3RfYXRsZWFzdF9vbmVfdW5pdCI7czo1MDoiVmV1aWxsZXorcyVDMyVBOWxlY3Rpb25uZXIrYXUrbW9pbnMrdW5lK3VuaXQlQzMlQTkiO3M6NDM6ImF0bGVhc3Rfb25lX3BheW1lbnRfbWV0aG9kX3Nob3VsZF9iZV9lbmFibGUiO3M6NjU6IkF1K21vaW5zK3VuZSttJUMzJUE5dGhvZGUrZGUrcGFpZW1lbnQrZG9pdCslQzMlQUF0cmUrYWN0aXYlQzMlQTllIjtzOjI3OiJhcHBvaW50bWVudF9ib29raW5nX2NvbmZpcm0iO3M6NDQ6IitMYStyJUMzJUE5c2VydmF0aW9uK2RlK3JlbmRlei12b3VzK2NvbmZpcm1lIjtzOjI4OiJhcHBvaW50bWVudF9ib29raW5nX3JlamVjdGVkIjtzOjQ1OiIrUiVDMyVBOXNlcnZhdGlvbitkZStyZW5kZXotdm91cytyZWpldCVDMyVBOWUiO3M6MTQ6ImJvb2tpbmdfY2FuY2VsIjtzOjIxOiIrQm9vb2tpbmcrYW5udWwlQzMlQTkiO3M6Mjk6ImFwcG9pbnRtZW50X21hcmtlZF9hc19ub19zaG93IjtzOjUxOiJSZW5kZXotdm91cyttYXJxdSVDMyVBOStjb21tZStub24tcHIlQzMlQTlzZW50YXRpb24iO3M6MzY6ImFwcG9pbnRtZW50X3Jlc2NoZWR1bGVzX3N1Y2Nlc3NmdWxseSI7czoyODoiUmVuZGV6LXZvdXMrYXZlYytzdWNjJUMzJUE4cyI7czoxNToiYm9va2luZ19kZWxldGVkIjtzOjMyOiIrUiVDMyVBOXNlcnZhdGlvbitzdXBwcmltJUMzJUE5ZSI7czo0ODoiYnJlYWtfZW5kX3RpbWVfc2hvdWxkX2JlX2dyZWF0ZXJfdGhhbl9zdGFydF90aW1lIjtzOjkxOiIrTCUyN2hldXJlK2RlK2ZpbitkZStsYStwYXVzZStkb2l0KyVDMyVBQXRyZStzdXAlQzMlQTlyaWV1cmUrJUMzJUEwK2wlMjdoZXVyZStkZStkJUMzJUE5YnV0IjtzOjE2OiJjYW5jZWxfYnlfY2xpZW50IjtzOjIyOiIrQW5udWxlcitwYXIrbGUrY2xpZW50IjtzOjI5OiJjYW5jZWxsZWRfYnlfc2VydmljZV9wcm92aWRlciI7czo0MzoiK0FubnVsJUMzJUE5K3BhcitsZStmb3Vybmlzc2V1citkZStzZXJ2aWNlcyI7czoyMzoiZGVzaWduX3NldF9zdWNjZXNzZnVsbHkiO3M6NDE6IitDb25jZXB0aW9uK2QlQzMlQTlmaW5pZSthdmVjK3N1Y2MlQzMlQThzIjtzOjIyOiJlbmRfYnJlYWtfdGltZV91cGRhdGVkIjtzOjM4OiIrRmluK2R1K3RlbXBzK2RlK3BhdXNlK21pcyslQzMlQTAram91ciI7czoyMDoiZW50ZXJfYWxwaGFiZXRzX29ubHkiO3M6MzI6IitFbnRyZXIrdW5pcXVlbWVudCtsZXMrYWxwaGFiZXRzIjtzOjIwOiJlbnRlcl9vbmx5X2FscGhhYmV0cyI7czozMToiK0VudHJlcitzZXVsZW1lbnQrbGVzK2FscGhhYmV0cyI7czoyODoiZW50ZXJfb25seV9hbHBoYWJldHNfbnVtYmVycyI7czo0MzoiK0VudHJlcitzZXVsZW1lbnQrbGVzK2FscGhhYmV0cyslMkYrbm9tYnJlcyI7czoxNzoiZW50ZXJfb25seV9kaWdpdHMiO3M6Mjk6IkVudHJlcitzZXVsZW1lbnQrbGVzK2NoaWZmcmVzIjtzOjE1OiJlbnRlcl92YWxpZF91cmwiO3M6MjE6IkVudHJleit1bmUrVVJMK3ZhbGlkZSI7czoxODoiZW50ZXJfb25seV9udW1lcmljIjtzOjMyOiIrRW50cmVyK3NldWxlbWVudCtudW0lQzMlQTlyaXF1ZSI7czoyNToiZW50ZXJfcHJvcGVyX2NvdW50cnlfY29kZSI7czozODoiK0VudHJleitsZStjb2RlK2RlK3BheXMrYXBwcm9wcmklQzMlQTkiO3M6MzQ6ImZyZXF1ZW50bHlfZGlzY291bnRfc3RhdHVzX3VwZGF0ZWQiO3M6NTQ6IitGb2lyZSslQzMlQTl0YXQrZGUrcmVtaXNlKyVDMyVBMCtqb3VyK21pcyslQzMlQTAram91ciI7czoyNzoiZnJlcXVlbnRseV9kaXNjb3VudF91cGRhdGVkIjtzOjI1OiIrRm9pcmUrcmVtaXNlKyVDMyVBMCtqb3VyIjtzOjIxOiJtYW5hZ2VfYWRkb25zX3NlcnZpY2UiO3M6MzI6IkclQzMlQTlyZXIrbGUrc2VydmljZStkZXMrYWRkb25zIjtzOjI5OiJtYXhpbXVtX2ZpbGVfdXBsb2FkX3NpemVfMl9tYiI7czo2MDoiK1RhaWxsZSttYXhpbWFsZStkdSt0JUMzJUE5bCVDMyVBOWNoYXJnZW1lbnQrZGUrZmljaGllcisyK01vIjtzOjI3OiJtZXRob2RfZGVsZXRlZF9zdWNjZXNzZnVsbHkiO3M6NDU6IitNJUMzJUE5dGhvZGUrc3VwcHJpbSVDMyVBOWUrYXZlYytzdWNjJUMzJUE4cyI7czoyODoibWV0aG9kX2luc2VydGVkX3N1Y2Nlc3NmdWxseSI7czo0ODoiK00lQzMlQTl0aG9kZStpbnMlQzMlQTlyJUMzJUE5ZSthdmVjK3N1Y2MlQzMlQThzIjtzOjI5OiJtaW5pbXVtX2ZpbGVfdXBsb2FkX3NpemVfMV9rYiI7czo2MDoiK1RhaWxsZSttaW5pbWFsZStkdSt0JUMzJUE5bCVDMyVBOWNoYXJnZW1lbnQrZGUrZmljaGllcisxK0tvIjtzOjI3OiJvZmZfdGltZV9hZGRlZF9zdWNjZXNzZnVsbHkiO3M6NTE6IitIZXVyZStkJTI3YXJyJUMzJUFBdCtham91dCVDMyVBOWUrYXZlYytzdWNjJUMzJUE4cyI7czozNjoib25seV9qcGVnX3BuZ19hbmRfZ2lmX2ltYWdlc19hbGxvd2VkIjtzOjU4OiIrU2V1bGVzK2xlcytpbWFnZXMranBlZyUyQytwbmcrZXQrZ2lmK3NvbnQrYXV0b3JpcyVDMyVBOWVzIjtzOjM3OiJvbmx5X2pwZWdfcG5nX2dpZl96aXBfYW5kX3BkZl9hbGxvd2VkIjtzOjYyOiJTZXVscytsZXMranBlZyUyQytwbmclMkMrZ2lmJTJDK3ppcCtldCtwZGYrc29udCthdXRvcmlzJUMzJUE5cyI7czo0MjoicGxlYXNlX3dhaXRfd2hpbGVfd2Vfc2VuZF9hbGxfeW91cl9tZXNzYWdlIjtzOjYzOiIrVmV1aWxsZXorcGF0aWVudGVyK3BlbmRhbnQrcXVlK25vdXMrZW52b3lvbnMrdG91cyt2b3MrbWVzc2FnZXMiO3M6Mjk6InBsZWFzZV9lbmFibGVfZW1haWxfdG9fY2xpZW50IjtzOjM5OiJWZXVpbGxleithY3RpdmVyK2xlcytlLW1haWxzK2F1K2NsaWVudC4iO3M6MjU6InBsZWFzZV9lbmFibGVfc21zX2dhdGV3YXkiO3M6MzY6IitWZXVpbGxleithY3RpdmVyK2xhK3Bhc3NlcmVsbGUrU01TLiI7czozMzoicGxlYXNlX2VuYWJsZV9jbGllbnRfbm90aWZpY2F0aW9uIjtzOjQ0OiIrVmV1aWxsZXorYWN0aXZlcitsYStub3RpZmljYXRpb24rZHUrY2xpZW50LiI7czozMzoicGFzc3dvcmRfbXVzdF9iZV84X2NoYXJhY3Rlcl9sb25nIjtzOjQ5OiIrTGUrbW90K2RlK3Bhc3NlK2RvaXQrY29tcG9ydGVyKzgrY2FyYWN0JUMzJUE4cmVzIjtzOjQ5OiJwYXNzd29yZF9zaG91bGRfbm90X2V4aXN0X21vcmVfdGhlbl8yMF9jaGFyYWN0ZXJzIjtzOjY2OiIrTGUrbW90K2RlK3Bhc3NlK25lK2RldnJhaXQrcGFzK2V4aXN0ZXIrcGx1cytkZSsyMCtjYXJhY3QlQzMlQThyZXMiO3M6MzM6InBsZWFzZV9hc3NpZ25fYmFzZV9wcmljZV9mb3JfdW5pdCI7czo1MzoiVmV1aWxsZXorYXNzaWduZXIrbGUrcHJpeCtkZStiYXNlK3BvdXIrbCUyN3VuaXQlQzMlQTkiO3M6MTk6InBsZWFzZV9hc3NpZ25fcHJpY2UiO3M6NDA6IlMlMjdpbCt2b3VzK3BsYSVDMyVBRXQrYXR0cmlidWVyK2xlK3ByaXgiO3M6MTc6InBsZWFzZV9hc3NpZ25fcXR5IjtzOjQ5OiJTJTI3aWwrdm91cytwbGElQzMlQUV0K2F0dHJpYnVlcitsYStxdWFudGl0JUMzJUE5IjtzOjI1OiJwbGVhc2VfZW50ZXJfYXBpX3Bhc3N3b3JkIjtzOjMzOiJFbnRyZXorbGUrbW90K2RlK3Bhc3NlK2RlK2wlMjdBUEkiO3M6MjU6InBsZWFzZV9lbnRlcl9hcGlfdXNlcm5hbWUiO3M6NTA6IitWZXVpbGxleitlbnRyZXIrbGUrbm9tK2QlMjd1dGlsaXNhdGV1citkZStsJTI3QVBJIjtzOjIzOiJwbGVhc2VfZW50ZXJfY29sb3JfY29kZSI7czozNToiK1ZldWlsbGV6K2VudHJlcitsZStjb2RlK2RlK2NvdWxldXIiO3M6MjA6InBsZWFzZV9lbnRlcl9jb3VudHJ5IjtzOjM4OiIrUyUyN2lsK3ZvdXMrcGxhJUMzJUFFdCtlbnRyZXIrbGUrcGF5cyI7czoyNToicGxlYXNlX2VudGVyX2NvdXBvbl9saW1pdCI7czo1MDoiK1MlMjdpbCt2b3VzK3BsYSVDMyVBRXQrZW50cmVyK2xhK2xpbWl0ZStkZStjb3Vwb24iO3M6MjU6InBsZWFzZV9lbnRlcl9jb3Vwb25fdmFsdWUiO3M6MzY6IitWZXVpbGxleitlbnRyZXIrbGErdmFsZXVyK2R1K2NvdXBvbiI7czoyNDoicGxlYXNlX2VudGVyX2NvdXBvbl9jb2RlIjtzOjMzOiJWZXVpbGxleitlbnRyZXIrbGUrY29kZStkdStjb3Vwb24iO3M6MTg6InBsZWFzZV9lbnRlcl9lbWFpbCI7czozNjoiK1MlMjdpbCt2b3VzK3BsYSVDMyVBRXQrZW50cmVyK2VtYWlsIjtzOjIxOiJwbGVhc2VfZW50ZXJfZnVsbG5hbWUiO3M6MzE6IitWZXVpbGxleitlbnRyZXIrbGUrbm9tK2NvbXBsZXQiO3M6MjE6InBsZWFzZV9lbnRlcl9tYXhsaW1pdCI7czoyNToiK1ZldWlsbGV6K2VudHJlcittYXhMaW1pdCI7czoyNToicGxlYXNlX2VudGVyX21ldGhvZF90aXRsZSI7czo0NDoiK1ZldWlsbGV6K2VudHJlcitsZSt0aXRyZStkZStsYSttJUMzJUE5dGhvZGUiO3M6MTc6InBsZWFzZV9lbnRlcl9uYW1lIjtzOjM3OiIrUyUyN2lsK3ZvdXMrcGxhJUMzJUFFdCtlbnRyZXIrbGUrbm9tIjtzOjI1OiJwbGVhc2VfZW50ZXJfb25seV9udW1lcmljIjtzOjU1OiIrUyUyN2lsK3ZvdXMrcGxhJUMzJUFFdCtlbnRyZXIrc2V1bGVtZW50K251bSVDMyVBOXJpcXVlIjtzOjMwOiJwbGVhc2VfZW50ZXJfcHJvcGVyX2Jhc2VfcHJpY2UiO3M6NDc6IitWZXVpbGxleitlbnRyZXIrbGUrcHJpeCtkZStiYXNlK2FwcHJvcHJpJUMzJUE5IjtzOjI0OiJwbGVhc2VfZW50ZXJfcHJvcGVyX25hbWUiO3M6NDU6IitTJTI3aWwrdm91cytwbGElQzMlQUV0K2VudHJlcitsZStub20rY29ycmVjdCI7czoyNToicGxlYXNlX2VudGVyX3Byb3Blcl90aXRsZSI7czozOToiVmV1aWxsZXorZW50cmVyK2xlK3RpdHJlK2FwcHJvcHJpJUMzJUE5IjtzOjI4OiJwbGVhc2VfZW50ZXJfcHVibGlzaGFibGVfa2V5IjtzOjM3OiIrVmV1aWxsZXorZW50cmVyK2xhK2NsJUMzJUE5K3B1YmxpcXVlIjtzOjIzOiJwbGVhc2VfZW50ZXJfc2VjcmV0X2tleSI7czo0MjoiK1ZldWlsbGV6K2VudHJlcit1bmUrY2wlQzMlQTkrc2VjciVDMyVBOHRlIjtzOjI2OiJwbGVhc2VfZW50ZXJfc2VydmljZV90aXRsZSI7czo0NzoiK1MlMjdpbCt2b3VzK3BsYSVDMyVBRXQrZW50cmVyK2xlK3NlcnZpY2UrVGl0cmUiO3M6MjI6InBsZWFzZV9lbnRlcl9zaWduYXR1cmUiO3M6NDM6IitTJTI3aWwrdm91cytwbGElQzMlQUV0K2VudHJlcitsYStzaWduYXR1cmUiO3M6MjE6InBsZWFzZV9lbnRlcl9zb21lX3F0eSI7czo0ODoiK1MlMjdpbCt2b3VzK3BsYSVDMyVBRXQrZW50cmVyK3VuZStxdWFudGl0JUMzJUE5IjtzOjE4OiJwbGVhc2VfZW50ZXJfdGl0bGUiO3M6Mzg6IlMlMjdpbCt2b3VzK3BsYSVDMyVBRXQrZW50cmVyK2xlK3RpdHJlIjtzOjIzOiJwbGVhc2VfZW50ZXJfdW5pdF90aXRsZSI7czo0MzoiK1ZldWlsbGV6K2VudHJlcitsZSt0aXRyZStkZStsJTI3dW5pdCVDMyVBOSI7czozMToicGxlYXNlX2VudGVyX3ZhbGlkX2NvdW50cnlfY29kZSI7czozOToiK1ZldWlsbGV6K2VudHJlcit1bitjb2RlK2RlK3BheXMrdmFsaWRlIjtzOjMyOiJwbGVhc2VfZW50ZXJfdmFsaWRfc2VydmljZV90aXRsZSI7czo0MzoiK1ZldWlsbGV6K2VudHJlcit1bit0aXRyZStkZStzZXJ2aWNlK3ZhbGlkZSI7czoyNDoicGxlYXNlX2VudGVyX3ZhbGlkX3ByaWNlIjtzOjMwOiJWZXVpbGxleitlbnRyZXIrdW4rcHJpeCt2YWxpZGUiO3M6MjA6InBsZWFzZV9lbnRlcl96aXBjb2RlIjtzOjMxOiIrVmV1aWxsZXorZW50cmVyK2xlK2NvZGUrcG9zdGFsIjtzOjE4OiJwbGVhc2VfZW50ZXJfc3RhdGUiO3M6Mjk6IlZldWlsbGV6K2VudHJlcitsJTI3JUMzJUE5dGF0IjtzOjMwOiJwbGVhc2VfcmV0eXBlX2NvcnJlY3RfcGFzc3dvcmQiO3M6NDA6IlZldWlsbGV6K3JldGFwZXIrbGUrbW90K2RlK3Bhc3NlK2NvcnJlY3QiO3M6MzE6InBsZWFzZV9zZWxlY3RfcG9ycGVyX3RpbWVfc2xvdHMiO3M6NjA6IlZldWlsbGV6K3MlQzMlQTlsZWN0aW9ubmVyK2xlcytjciVDMyVBOW5lYXV4K2hvcmFpcmVzK3BvcnBlciI7czo0ODoicGxlYXNlX3NlbGVjdF90aW1lX2JldHdlZW5fZGF5X2F2YWlsYWJpbGl0eV90aW1lIjtzOjg2OiJTJTI3aWwrdm91cytwbGElQzMlQUV0K3MlQzMlQTlsZWN0aW9ubmVyK2wlMjdoZXVyZStlbnRyZStsYStkaXNwb25pYmlsaXQlQzMlQTkrZHUram91ciI7czozMToicGxlYXNlX3ZhbGlkX3ZhbHVlX2Zvcl9kaXNjb3VudCI7czo2MzoiK1MlMjdpbCt2b3VzK3BsYSVDMyVBRXQrdmFsaWRlK2xhK3ZhbGV1citwb3VyK2xhK3IlQzMlQTlkdWN0aW9uIjtzOjI5OiJwbGVhc2VfZW50ZXJfY29uZmlybV9wYXNzd29yZCI7czo0NzoiVmV1aWxsZXorZW50cmVyK2xlK21vdCtkZStwYXNzZStkZStjb25maXJtYXRpb24iO3M6MjU6InBsZWFzZV9lbnRlcl9uZXdfcGFzc3dvcmQiO3M6NDA6IitWZXVpbGxleitlbnRyZXIrdW4rbm91dmVhdSttb3QrZGUrcGFzc2UiO3M6MjU6InBsZWFzZV9lbnRlcl9vbGRfcGFzc3dvcmQiO3M6NDA6IitWZXVpbGxleitlbnRyZXIrbCUyN2FuY2llbittb3QrZGUrcGFzc2UiO3M6MjU6InBsZWFzZV9lbnRlcl92YWxpZF9udW1iZXIiO3M6MzI6IlZldWlsbGV6K2VudHJlcit1bitub21icmUrdmFsaWRlIjtzOjQzOiJwbGVhc2VfZW50ZXJfdmFsaWRfbnVtYmVyX3dpdGhfY291bnRyeV9jb2RlIjtzOjU4OiJWZXVpbGxleitlbnRyZXIrdW4rbnVtJUMzJUE5cm8rdmFsaWRlK2F2ZWMrbGUrY29kZStkdStwYXlzIjtzOjQ2OiJwbGVhc2Vfc2VsZWN0X2VuZF90aW1lX2dyZWF0ZXJfdGhhbl9zdGFydF90aW1lIjtzOjkxOiIrVmV1aWxsZXorcyVDMyVBOWxlY3Rpb25uZXIrbCUyN2hldXJlK2RlK2ZpbitzdXAlQzMlQTlyaWV1cmUrJUMzJUEwK2wlMjdoZXVyZStkZStkJUMzJUE5YnV0IjtzOjQzOiJwbGVhc2Vfc2VsZWN0X2VuZF90aW1lX2xlc3NfdGhhbl9zdGFydF90aW1lIjtzOjc3OiJWZXVpbGxleitzJUMzJUE5bGVjdGlvbm5lcitsJTI3aGV1cmUrZGUrZmluK21vaW5zK3F1ZStsJTI3aGV1cmUrZGUrZCVDMyVBOWJ1dCI7czo0OToicGxlYXNlX3NlbGVjdF9hX2Nyb3BfcmVnaW9uX2FuZF90aGVuX3ByZXNzX3VwbG9hZCI7czoxMDM6IitTJUMzJUE5bGVjdGlvbm5leit1bmUrciVDMyVBOWdpb24rZGUrY3VsdHVyZSUyQytwdWlzK2FwcHV5ZXorc3VyK2xlK2JvdXRvbitkZSt0JUMzJUE5bCVDMyVBOWNoYXJnZW1lbnQiO3M6NTY6InBsZWFzZV9zZWxlY3RfYV92YWxpZF9pbWFnZV9maWxlX2pwZ19hbmRfcG5nX2FyZV9hbGxvd2VkIjtzOjgyOiIrVmV1aWxsZXorcyVDMyVBOWxlY3Rpb25uZXIrdW4rZmljaGllcitpbWFnZSt2YWxpZGUranBnK2V0K3BuZytzb250K2F1dG9yaXMlQzMlQTlzIjtzOjI4OiJwcm9maWxlX3VwZGF0ZWRfc3VjY2Vzc2Z1bGx5IjtzOjQwOiIrTWlzZSslQzMlQTAram91citkdStwcm9maWwrciVDMyVBOXVzc2llIjtzOjE2OiJxdHlfcnVsZV9kZWxldGVkIjtzOjQzOiIrUXVhbnRpdCVDMyVBOStkZStyJUMzJUE4Z2xlK3N1cHByaW0lQzMlQTllIjtzOjI3OiJyZWNvcmRfZGVsZXRlZF9zdWNjZXNzZnVsbHkiO3M6NDY6IitFbnJlZ2lzdHJlbWVudCtzdXBwcmltJUMzJUE5K2F2ZWMrc3VjYyVDMyVBOHMiO3M6Mjc6InJlY29yZF91cGRhdGVkX3N1Y2Nlc3NmdWxseSI7czo0ODoiK0VucmVnaXN0cmVtZW50K21pcyslQzMlQTAram91cithdmVjK3N1Y2MlQzMlQThzIjtzOjExOiJyZXNjaGVkdWxlZCI7czoxNjoiUmVwcm9ncmFtbSVDMyVBOSI7czoyNzoic2NoZWR1bGVfdXBkYXRlZF90b19tb250aGx5IjtzOjQwOiJDYWxlbmRyaWVyK21pcyslQzMlQTAram91cittZW5zdWVsbGVtZW50IjtzOjI2OiJzY2hlZHVsZV91cGRhdGVkX3RvX3dlZWtseSI7czo0NzoiK0NhbGVuZHJpZXIrbWlzKyVDMyVBMCtqb3VyKyVDMyVBMCtIZWJkb21hZGFpcmUiO3M6MjY6InNvcnJ5X21ldGhvZF9hbHJlYWR5X2V4aXN0IjtzOjU1OiIrTGErbSVDMyVBOXRob2RlK0QlQzMlQTlzb2wlQzMlQTkrZXhpc3RlK2QlQzMlQTlqJUMzJUEwIjtzOjIxOiJzb3JyeV9ub19ub3RpZmljYXRpb24iO3M6NjU6IitEJUMzJUE5c29sJUMzJUE5JTJDK3ZvdXMrbiUyN2F2ZXorYXVjdW4rcmVuZGV6LXZvdXMrJUMzJUEwK3ZlbmlyIjtzOjI5OiJzb3JyeV9wcm9tb2NvZGVfYWxyZWFkeV9leGlzdCI7czo0OToiK1Byb21vY29kZStEJUMzJUE5c29sJUMzJUE5K2V4aXN0ZStkJUMzJUE5aiVDMyVBMCI7czoyNDoic29ycnlfdW5pdF9hbHJlYWR5X2V4aXN0IjtzOjU1OiIrVW5lK3VuaXQlQzMlQTkrZCVDMyVBOXNvbCVDMyVBOWUrZXhpc3RlK2QlQzMlQTlqJUMzJUEwIjtzOjI2OiJzb3JyeV93ZV9hcmVfbm90X2F2YWlsYWJsZSI7czo1MToiK0QlQzMlQTlzb2wlQzMlQTklMkMrbm91cytuZStzb21tZXMrcGFzK2Rpc3BvbmlibGVzIjtzOjI0OiJzdGFydF9icmVha190aW1lX3VwZGF0ZWQiO3M6NDU6IitEJUMzJUE5YnV0K2R1K3RlbXBzK2RlK3BhdXNlK21pcyslQzMlQTAram91ciI7czoxNDoic3RhdHVzX3VwZGF0ZWQiO3M6MjM6IitTdGF0dXQrbWlzKyVDMyVBMCtqb3VyIjtzOjMxOiJ0aW1lX3Nsb3RzX3VwZGF0ZWRfc3VjY2Vzc2Z1bGx5IjtzOjQyOiJMZXMrY3IlQzMlQTluZWF1eCtob3JhaXJlcyttaXMrJUMzJUEwK2pvdXIiO3M6MjY6InVuaXRfaW5zZXJ0ZWRfc3VjY2Vzc2Z1bGx5IjtzOjQ2OiIrVW5pdCVDMyVBOStpbnMlQzMlQTlyJUMzJUE5ZSthdmVjK3N1Y2MlQzMlQThzIjtzOjIwOiJ1bml0c19zdGF0dXNfdXBkYXRlZCI7czozODoiU3RhdHV0K2Rlcyt1bml0JUMzJUE5cyttaXMrJUMzJUEwK2pvdXIiO3M6Mjc6InVwZGF0ZWRfYXBwZWFyYW5jZV9zZXR0aW5ncyI7czozODoiK0FldGluZ3MrZCUyN2FwcGFyZW5jZSttaXMrJUMzJUEwK2pvdXIiO3M6MjM6InVwZGF0ZWRfY29tcGFueV9kZXRhaWxzIjtzOjMxOiIrSW5mb3JtYXRpb25zK21pc2VzKyVDMyVBMCtqb3VyIjtzOjIyOiJ1cGRhdGVkX2VtYWlsX3NldHRpbmdzIjtzOjQ2OiIrUGFyYW0lQzMlQTh0cmVzK2RlK21lc3NhZ2VyaWUrbWlzKyVDMyVBMCtqb3VyIjtzOjI0OiJ1cGRhdGVkX2dlbmVyYWxfc2V0dGluZ3MiO3M6NTA6IlBhcmFtJUMzJUE4dHJlcytnJUMzJUE5biVDMyVBOXJhdXgrbWlzKyVDMyVBMCtqb3VyIjtzOjI1OiJ1cGRhdGVkX3BheW1lbnRzX3NldHRpbmdzIjtzOjQ0OiIrUGFyYW0lQzMlQTh0cmVzK2RlK3BhaWVtZW50K21pcyslQzMlQTAram91ciI7czoyNzoieW91cl9vbGRfcGFzc3dvcmRfaW5jb3JyZWN0IjtzOjMwOiIrQW5jaWVuK21vdCtkZStwYXNzZStpbmNvcnJlY3QiO3M6Mjg6InBsZWFzZV9lbnRlcl9taW5pbXVtXzVfY2hhcnMiO3M6NDI6IlZldWlsbGV6K2VudHJlcithdSttb2lucys1K2NhcmFjdCVDMyVBOHJlcyI7czoyOToicGxlYXNlX2VudGVyX21heGltdW1fMTBfY2hhcnMiO3M6NDI6IlZldWlsbGV6K2VudHJlcisxMCtjYXJhY3QlQzMlQThyZXMrbWF4aW11bSI7czoyNDoicGxlYXNlX2VudGVyX3Bvc3RhbF9jb2RlIjtzOjMxOiIrVmV1aWxsZXorZW50cmVyK2xlK2NvZGUrcG9zdGFsIjtzOjIzOiJwbGVhc2Vfc2VsZWN0X2Ffc2VydmljZSI7czozODoiK1ZldWlsbGV6K3MlQzMlQTlsZWN0aW9ubmVyK3VuK3NlcnZpY2UiO3M6MzA6InBsZWFzZV9zZWxlY3RfdW5pdHNfYW5kX2FkZG9ucyI7czo1NzoiK1ZldWlsbGV6K3MlQzMlQTlsZWN0aW9ubmVyK2xlcyt1bml0JUMzJUE5cytldCtsZXMrYWRkb25zIjtzOjI5OiJwbGVhc2Vfc2VsZWN0X3VuaXRzX29yX2FkZG9ucyI7czo1NzoiK1ZldWlsbGV6K3MlQzMlQTlsZWN0aW9ubmVyK2Rlcyt1bml0JUMzJUE5cytvdStkZXMrYWRkb25zIjtzOjMyOiJwbGVhc2VfbG9naW5fdG9fY29tcGxldGVfYm9va2luZyI7czo2MzoiVmV1aWxsZXordm91cytjb25uZWN0ZXIrcG91citjb21wbCVDMyVBOXRlcitsYStyJUMzJUE5c2VydmF0aW9uIjtzOjMwOiJwbGVhc2Vfc2VsZWN0X2FwcG9pbnRtZW50X2RhdGUiO3M6NTA6IlZldWlsbGV6K3MlQzMlQTlsZWN0aW9ubmVyK3VuZStkYXRlK2RlK3JlbmRlei12b3VzIjtzOjM0OiJwbGVhc2VfYWNjZXB0X3Rlcm1zX2FuZF9jb25kaXRpb25zIjtzOjQzOiIrVmV1aWxsZXorYWNjZXB0ZXIrbGVzK3Rlcm1lcytldCtjb25kaXRpb25zIjtzOjM1OiJpbmNvcnJlY3RfZW1haWxfYWRkcmVzc19vcl9wYXNzd29yZCI7czo0MToiK0FkcmVzc2UrZS1tYWlsK291K21vdCtkZStwYXNzZStpbmNvcnJlY3QiO3M6MzI6InBsZWFzZV9lbnRlcl92YWxpZF9lbWFpbF9hZGRyZXNzIjtzOjQxOiIrVmV1aWxsZXorZW50cmVyK3VuZSthZHJlc3NlK2VtYWlsK3ZhbGlkZSI7czoyNjoicGxlYXNlX2VudGVyX2VtYWlsX2FkZHJlc3MiO3M6Mzc6IitWZXVpbGxleitlbnRyZXIrdm90cmUrYWRyZXNzZStlLW1haWwiO3M6MjE6InBsZWFzZV9lbnRlcl9wYXNzd29yZCI7czozMjoiK1ZldWlsbGV6K2VudHJlcitsZSttb3QrZGUrcGFzc2UiO3M6MzM6InBsZWFzZV9lbnRlcl9taW5pbXVtXzhfY2hhcmFjdGVycyI7czo0MjoiVmV1aWxsZXorZW50cmVyK2F1K21vaW5zKzgrY2FyYWN0JUMzJUE4cmVzIjtzOjM0OiJwbGVhc2VfZW50ZXJfbWF4aW11bV8xNV9jaGFyYWN0ZXJzIjtzOjQzOiIrVmV1aWxsZXorZW50cmVyKzE1K2NhcmFjdCVDMyVBOHJlcyttYXhpbXVtIjtzOjIzOiJwbGVhc2VfZW50ZXJfZmlyc3RfbmFtZSI7czo0NToiK1MlMjdpbCt2b3VzK3BsYSVDMyVBRXQrZW50cmVyK2xlK3ByJUMzJUE5bm9tIjtzOjI3OiJwbGVhc2VfZW50ZXJfb25seV9hbHBoYWJldHMiO3M6NTQ6IitTJTI3aWwrdm91cytwbGElQzMlQUV0K2VudHJlcitzZXVsZW1lbnQrZGVzK2FscGhhYmV0cyI7czozMzoicGxlYXNlX2VudGVyX21pbmltdW1fMl9jaGFyYWN0ZXJzIjtzOjQzOiIrVmV1aWxsZXorZW50cmVyK2F1K21vaW5zKzIrY2FyYWN0JUMzJUE4cmVzIjtzOjIyOiJwbGVhc2VfZW50ZXJfbGFzdF9uYW1lIjtzOjM0OiIrVmV1aWxsZXorZW50cmVyK2xlK25vbStkZStmYW1pbGxlIjtzOjIwOiJlbWFpbF9hbHJlYWR5X2V4aXN0cyI7czozMjoiK2wlMjdlbWFpbCtleGlzdGUrZCVDMyVBOWolQzMlQTAiO3M6MjU6InBsZWFzZV9lbnRlcl9waG9uZV9udW1iZXIiO3M6Njg6IitTJTI3aWwrdm91cytwbGElQzMlQUV0K2VudHJlcitsZStudW0lQzMlQTlybytkZSt0JUMzJUE5bCVDMyVBOXBob25lIjtzOjI2OiJwbGVhc2VfZW50ZXJfb25seV9udW1lcmljcyI7czozOToiK1ZldWlsbGV6K2VudHJlcitzZXVsZW1lbnQrbGVzK2NoaWZmcmVzIjtzOjMwOiJwbGVhc2VfZW50ZXJfbWluaW11bV8xMF9kaWdpdHMiO3M6MzY6IlZldWlsbGV6K2VudHJlcithdSttb2lucysxMCtjaGlmZnJlcyI7czozMDoicGxlYXNlX2VudGVyX21heGltdW1fMTRfZGlnaXRzIjtzOjM4OiJWZXVpbGxleitlbnRyZXIrYXUrbWF4aW11bSsxNCtjaGlmZnJlcyI7czoyMDoicGxlYXNlX2VudGVyX2FkZHJlc3MiO3M6NDI6IitTJTI3aWwrdm91cytwbGElQzMlQUV0K2VudHJlcitsJTI3YWRyZXNzZSI7czozNDoicGxlYXNlX2VudGVyX21pbmltdW1fMjBfY2hhcmFjdGVycyI7czo0MzoiVmV1aWxsZXorZW50cmVyK2F1K21vaW5zKzIwK2NhcmFjdCVDMyVBOHJlcyI7czoyMToicGxlYXNlX2VudGVyX3ppcF9jb2RlIjtzOjMwOiJWZXVpbGxleitlbnRyZXIrbGUrY29kZStwb3N0YWwiO3M6Mjg6InBsZWFzZV9lbnRlcl9wcm9wZXJfemlwX2NvZGUiO3M6MzU6IitWZXVpbGxleitlbnRyZXIrbGUrYm9uK2NvZGUrcG9zdGFsIjtzOjI5OiJwbGVhc2VfZW50ZXJfbWluaW11bV81X2RpZ2l0cyI7czozNjoiK1ZldWlsbGV6K2VudHJlcithdSttb2lucys1K2NoaWZmcmVzIjtzOjI5OiJwbGVhc2VfZW50ZXJfbWF4aW11bV83X2RpZ2l0cyI7czozNToiK1ZldWlsbGV6K2VudHJlcis3K2NoaWZmcmVzK21heGltdW0iO3M6MTc6InBsZWFzZV9lbnRlcl9jaXR5IjtzOjM5OiIrUyUyN2lsK3ZvdXMrcGxhJUMzJUFFdCtlbnRyZXIrbGErdmlsbGUiO3M6MjQ6InBsZWFzZV9lbnRlcl9wcm9wZXJfY2l0eSI7czo1NToiK1MlMjdpbCt2b3VzK3BsYSVDMyVBRXQrZW50cmVyK2xhK3ZpbGxlK2FwcHJvcHJpJUMzJUE5ZSI7czozNDoicGxlYXNlX2VudGVyX21heGltdW1fNDhfY2hhcmFjdGVycyI7czo0NjoiK1ZldWlsbGV6K2VudHJlcithdSttYXhpbXVtKzQ4K2NhcmFjdCVDMyVBOHJlcyI7czoyNToicGxlYXNlX2VudGVyX3Byb3Blcl9zdGF0ZSI7czozODoiK1ZldWlsbGV6K2VudHJlcitsJTI3JUMzJUE5dGF0K2NvcnJlY3QiO3M6Mjc6InBsZWFzZV9lbnRlcl9jb250YWN0X3N0YXR1cyI7czozNzoiK1ZldWlsbGV6K2VudHJlcitsZStzdGF0dXQrZHUrY29udGFjdCI7czozNToicGxlYXNlX2VudGVyX21heGltdW1fMTAwX2NoYXJhY3RlcnMiO3M6NDc6IitWZXVpbGxleitlbnRyZXIrYXUrbWF4aW11bSsxMDArY2FyYWN0JUMzJUE4cmVzIjtzOjQ3OiJ5b3VyX2NhcnRfaXNfZW1wdHlfcGxlYXNlX2FkZF9jbGVhbmluZ19zZXJ2aWNlcyI7czo3OToiK1ZvdHJlK3Bhbmllcitlc3QrdmlkZStzJTI3aWwrdm91cytwbGElQzMlQUV0K2Fqb3V0ZXIrZGVzK3NlcnZpY2VzK2RlK25ldHRveWFnZSI7czoxNDoiY291cG9uX2V4cGlyZWQiO3M6MjQ6IitMZStjb3Vwb24rYStleHBpciVDMyVBOSI7czoxNDoiaW52YWxpZF9jb3Vwb24iO3M6MTY6IitDb3Vwb24raW52YWxpZGUiO3M6NDI6Im91cl9zZXJ2aWNlX25vdF9hdmFpbGFibGVfYXRfeW91cl9sb2NhdGlvbiI7czo0NzoiK05vdHJlK3NlcnZpY2UrbiUyN2VzdCtwYXMrZGlzcG9uaWJsZStjaGV6K3ZvdXMiO3M6MzE6InBsZWFzZV9lbnRlcl9wcm9wZXJfcG9zdGFsX2NvZGUiO3M6NDY6IitWZXVpbGxleitlbnRyZXIrbGUrY29kZStwb3N0YWwrYXBwcm9wcmklQzMlQTkiO3M6Mzg6ImludmFsaWRfZW1haWxfaWRfcGxlYXNlX3JlZ2lzdGVyX2ZpcnN0IjtzOjc5OiIrSWRlbnRpZmlhbnQrZCUyN2VtYWlsK2ludmFsaWRlK3MlMjdpbCt2b3VzK3BsYSVDMyVBRXQraW5zY3JpdmV6LXZvdXMrZCUyN2Fib3JkIjtzOjU5OiJ5b3VyX3Bhc3N3b3JkX3NlbmRfc3VjY2Vzc2Z1bGx5X2F0X3lvdXJfcmVnaXN0ZXJlZF9lbWFpbF9pZCI7czo5MzoiK1ZvdHJlK21vdCtkZStwYXNzZStlbnZveSVDMyVBOSthdmVjK3N1Y2MlQzMlQThzKyVDMyVBMCt2b3RyZSthZHJlc3NlK2UtbWFpbCtlbnJlZ2lzdHIlQzMlQTllIjtzOjQ1OiJ5b3VyX3Bhc3N3b3JkX3Jlc2V0X3N1Y2Nlc3NmdWxseV9wbGVhc2VfbG9naW4iO3M6ODQ6IitWb3RyZSttb3QrZGUrcGFzc2UrciVDMyVBOWluaXRpYWxpcyVDMyVBOSthdmVjK3N1Y2MlQzMlQThzK3ZldWlsbGV6K3ZvdXMraWRlbnRpZmllciI7czo0NToibmV3X3Bhc3N3b3JkX2FuZF9yZXR5cGVfbmV3X3Bhc3N3b3JkX21pc21hdGNoIjtzOjc3OiIrTm91dmVhdSttb3QrZGUrcGFzc2UrZXQrcmV0YXBlcitsYStub3V2ZWxsZStpbmNvaCVDMyVBOXJlbmNlK2RlK21vdCtkZStwYXNzZSI7czozOiJuZXciO3M6NzoiTm91dmVhdSI7czozMjoieW91cl9yZXNldF9wYXNzd29yZF9saW5rX2V4cGlyZWQiO3M6NjY6IitWb3RyZStsaWVuK2RlK3IlQzMlQTlpbml0aWFsaXNhdGlvbitkdSttb3QrZGUrcGFzc2UrYStleHBpciVDMyVBOSI7czozMDoiZnJvbnRfZGlzcGxheV9sYW5ndWFnZV9jaGFuZ2VkIjtzOjQ1OiIrTGUrbGFuZ2FnZStkJTI3YWZmaWNoYWdlK2F2YW50K2ErY2hhbmclQzMlQTkiO3M6NDg6InVwZGF0ZWRfZnJvbnRfZGlzcGxheV9sYW5ndWFnZV9hbmRfdXBkYXRlX2xhYmVscyI7czo4ODoiK01pc2UrJUMzJUEwK2pvdXIrZHUrbGFuZ2FnZStkJTI3YWZmaWNoYWdlK2F2YW50K2V0K21pc2UrJUMzJUEwK2pvdXIrZGVzKyVDMyVBOXRpcXVldHRlcyI7czozMzoicGxlYXNlX2VudGVyX29ubHlfN19jaGFyc19tYXhpbXVtIjtzOjUyOiIrVmV1aWxsZXorZW50cmVyK3NldWxlbWVudCs3K2NhcmFjdCVDMyVBOHJlcyttYXhpbXVtIjtzOjI5OiJwbGVhc2VfZW50ZXJfbWF4aW11bV8yMF9jaGFycyI7czo0MzoiK1ZldWlsbGV6K2VudHJlcisyMCtjYXJhY3QlQzMlQThyZXMrbWF4aW11bSI7czoyODoicmVjb3JkX2luc2VydGVkX3N1Y2Nlc3NmdWxseSI7czo0OToiK0VucmVnaXN0cmVtZW50K2lucyVDMyVBOXIlQzMlQTkrYXZlYytzdWNjJUMzJUE4cyI7czoyNDoicGxlYXNlX2VudGVyX2FjY291bnRfc2lkIjtzOjI3OiIrVmV1aWxsZXorZW50cmVyK0FjY291dCtTSUQiO3M6MjM6InBsZWFzZV9lbnRlcl9hdXRoX3Rva2VuIjtzOjQxOiIrUyUyN2lsK3ZvdXMrcGxhJUMzJUFFdCtlbnRyZXIrQXV0aCtUb2tlbiI7czoyNjoicGxlYXNlX2VudGVyX3NlbmRlcl9udW1iZXIiO3M6NTM6IlZldWlsbGV6K2VudHJlcitsZStudW0lQzMlQTlybytkZStsJTI3ZXhwJUMzJUE5ZGl0ZXVyIjtzOjI1OiJwbGVhc2VfZW50ZXJfYWRtaW5fbnVtYmVyIjtzOjUwOiIrVmV1aWxsZXorZW50cmVyK2xlK251bSVDMyVBOXJvK2QlMjdhZG1pbmlzdHJhdGV1ciI7czoyNzoic29ycnlfc2VydmljZV9hbHJlYWR5X2V4aXN0IjtzOjUwOiIrTGUrc2VydmljZStEJUMzJUE5c29sJUMzJUE5K2V4aXN0ZStkJUMzJUE5aiVDMyVBMCI7czoyNToicGxlYXNlX2VudGVyX2FwaV9sb2dpbl9pZCI7czo0NzoiK0VudHJleitsJTI3aWRlbnRpZmlhbnQrZGUrY29ubmV4aW9uK2RlK2wlMjdBUEkiO3M6Mjg6InBsZWFzZV9lbnRlcl90cmFuc2FjdGlvbl9rZXkiO3M6NDQ6IitWZXVpbGxleitlbnRyZXIrdW5lK2NsJUMzJUE5K2RlK3RyYW5zYWN0aW9uIjtzOjI0OiJwbGVhc2VfZW50ZXJfc21zX21lc3NhZ2UiO3M6NDQ6IlMlMjdpbCt2b3VzK3BsYSVDMyVBRXQrZW50cmVyK3VuK21lc3NhZ2UrU01TIjtzOjI2OiJwbGVhc2VfZW50ZXJfZW1haWxfbWVzc2FnZSI7czo0NToiK1ZldWlsbGV6K2VudHJlcit1bittZXNzYWdlKyVDMyVBOWxlY3Ryb25pcXVlIjtzOjI0OiJwbGVhc2VfZW50ZXJfcHJpdmF0ZV9rZXkiO3M6NDE6IitWZXVpbGxleitlbnRyZXIrdW5lK2NsJUMzJUE5K3ByaXYlQzMlQTllIjtzOjIyOiJwbGVhc2VfZW50ZXJfc2VsbGVyX2lkIjtzOjQzOiIrVmV1aWxsZXorZW50cmVyK2wlMjdpZGVudGlmaWFudCtkdSt2ZW5kZXVyIjtzOjM3OiJwbGVhc2VfZW50ZXJfdmFsaWRfdmFsdWVfZm9yX2Rpc2NvdW50IjtzOjQ5OiJWZXVpbGxleitlbnRyZXIrdW5lK3ZhbGV1cit2YWxpZGUrcG91cit1bmUrcmVtaXNlIjtzOjM1OiJwYXNzd29yZF9tdXN0X2JlX29ubHlfMTBfY2hhcmFjdGVycyI7czo1NjoiK0xlK21vdCtkZStwYXNzZStuZStkb2l0K2NvbnRlbmlyK3F1ZSsxMCtjYXJhY3QlQzMlQThyZXMiO3M6MzU6InBhc3N3b3JkX2F0X2xlYXN0X2hhdmVfOF9jaGFyYWN0ZXJzIjtzOjQ0OiIrTW90K2RlK3Bhc3NlK2F1K21vaW5zK29udCs4K2NhcmFjdCVDMyVBOHJlcyI7czozMjoicGxlYXNlX2VudGVyX3JldHlwZV9uZXdfcGFzc3dvcmQiO3M6NDA6IitWZXVpbGxleitlbnRyZXIrbGUrbm91dmVhdSttb3QrZGUrcGFzc2UiO3M6NDg6InlvdXJfcGFzc3dvcmRfc2VuZF9zdWNjZXNzZnVsbHlfYXRfeW91cl9lbWFpbF9pZCI7czo3NjoiK1ZvdHJlK21vdCtkZStwYXNzZStlbnZveSVDMyVBOSthdmVjK3N1Y2MlQzMlQThzKyVDMyVBMCt2b3RyZSthZHJlc3NlK2UtbWFpbCI7czoyNToicGxlYXNlX3NlbGVjdF9leHBpcnlfZGF0ZSI7czo1MDoiK1ZldWlsbGV6K3MlQzMlQTlsZWN0aW9ubmVyK2xhK2RhdGUrZCUyN2V4cGlyYXRpb24iO3M6MjU6InBsZWFzZV9lbnRlcl9tZXJjaGFudF9rZXkiO3M6NDA6IitWZXVpbGxleitlbnRyZXIrbGErY2wlQzMlQTkrZHUrbWFyY2hhbmQiO3M6MjE6InBsZWFzZV9lbnRlcl9zYWx0X2tleSI7czoyNToiK1ZldWlsbGV6K2VudHJlcitTYWx0K0tleSI7czoyOToicGxlYXNlX2VudGVyX2FjY291bnRfdXNlcm5hbWUiO3M6NDg6IlZldWlsbGV6K2VudHJlcitsZStub20rZCUyN3V0aWxpc2F0ZXVyK2R1K2NvbXB0ZSI7czoyODoicGxlYXNlX2VudGVyX2FjY291bnRfaGFzaF9pZCI7czo1MzoiK1ZldWlsbGV6K2VudHJlcitsJTI3aWRlbnRpZmlhbnQrZGUraGFjaGFnZStkdStjb21wdGUiO3M6MTQ6ImludmFsaWRfdmFsdWVzIjtzOjE4OiIrVmFsZXVycytpbnZhbGlkZXMiO3M6NDE6InBsZWFzZV9zZWxlY3RfYXRsZWFzdF9vbmVfY2hlY2tvdXRfbWV0aG9kIjtzOjY1OiIrVmV1aWxsZXorcyVDMyVBOWxlY3Rpb25uZXIrYXUrbW9pbnMrdW5lK20lQzMlQTl0aG9kZStkZStwYWllbWVudCI7fQ==', 'YTo4OntzOjI4OiJwbGVhc2VfZW50ZXJfbWluaW11bV8zX2NoYXJzIjtzOjQzOiIrVmV1aWxsZXorZW50cmVyK2F1K21vaW5zKzMrY2FyYWN0JUMzJUE4cmVzIjtzOjc6Imludm9pY2UiO3M6MTg6IitGQUNUVVJFK0QlMjdBQ0hBVCI7czoxMDoiaW52b2ljZV90byI7czoxNToiK0ZBQ1RVUkUrJUMzJTgwIjtzOjEyOiJpbnZvaWNlX2RhdGUiO3M6MjA6IitEYXRlK2RlK2ZhY3R1cmF0aW9uIjtzOjQ6ImNhc2giO3M6MTY6IitFTitFU1AlQzMlODhDRVMiO3M6MTI6InNlcnZpY2VfbmFtZSI7czoxNToiK05vbStkdStzZXJ2aWNlIjtzOjM6InF0eSI7czo5OiIrUXQlQzMlQTkiO3M6OToiYm9va2VkX29uIjtzOjIwOiJSJUMzJUE5c2VydiVDMyVBOStsZSI7fQ==', 'YToyODp7czo5OiJtaW5fZmZfcHMiO3M6NDI6IlZldWlsbGV6K2VudHJlcithdSttb2lucys4K2NhcmFjdCVDMyVBOHJlcyI7czo5OiJtYXhfZmZfcHMiO3M6NDI6IlZldWlsbGV6K2VudHJlcisxMCtjYXJhY3QlQzMlQThyZXMrbWF4aW11bSI7czo5OiJyZXFfZmZfZm4iO3M6NDU6IitTJTI3aWwrdm91cytwbGElQzMlQUV0K2VudHJlcitsZStwciVDMyVBOW5vbSI7czo5OiJtaW5fZmZfZm4iO3M6NDI6IlZldWlsbGV6K2VudHJlcithdSttb2lucyszK2NhcmFjdCVDMyVBOHJlcyI7czo5OiJtYXhfZmZfZm4iO3M6NDM6IitWZXVpbGxleitlbnRyZXIrMTUrY2FyYWN0JUMzJUE4cmVzK21heGltdW0iO3M6OToicmVxX2ZmX2xuIjtzOjMzOiJWZXVpbGxleitlbnRyZXIrbGUrbm9tK2RlK2ZhbWlsbGUiO3M6OToibWluX2ZmX2xuIjtzOjQyOiJWZXVpbGxleitlbnRyZXIrYXUrbW9pbnMrMytjYXJhY3QlQzMlQThyZXMiO3M6OToibWF4X2ZmX2xuIjtzOjQyOiJWZXVpbGxleitlbnRyZXIrMTUrY2FyYWN0JUMzJUE4cmVzK21heGltdW0iO3M6OToicmVxX2ZmX3BoIjtzOjY4OiIrUyUyN2lsK3ZvdXMrcGxhJUMzJUFFdCtlbnRyZXIrbGUrbnVtJUMzJUE5cm8rZGUrdCVDMyVBOWwlQzMlQTlwaG9uZSI7czo5OiJtaW5fZmZfcGgiO3M6NDM6IitWZXVpbGxleitlbnRyZXIrYXUrbW9pbnMrOStjYXJhY3QlQzMlQThyZXMiO3M6OToibWF4X2ZmX3BoIjtzOjQzOiIrVmV1aWxsZXorZW50cmVyKzE1K2NhcmFjdCVDMyVBOHJlcyttYXhpbXVtIjtzOjk6InJlcV9mZl9zYSI7czo0MToiUyUyN2lsK3ZvdXMrcGxhJUMzJUFFdCtlbnRyZXIrbCUyN2FkcmVzc2UiO3M6OToibWluX2ZmX3NhIjtzOjQzOiJWZXVpbGxleitlbnRyZXIrYXUrbW9pbnMrMTArY2FyYWN0JUMzJUE4cmVzIjtzOjk6Im1heF9mZl9zYSI7czo0NjoiK1ZldWlsbGV6K2VudHJlcithdSttYXhpbXVtKzQwK2NhcmFjdCVDMyVBOHJlcyI7czo5OiJyZXFfZmZfenAiO3M6MzE6IitWZXVpbGxleitlbnRyZXIrbGUrY29kZStwb3N0YWwiO3M6OToibWluX2ZmX3pwIjtzOjQyOiJWZXVpbGxleitlbnRyZXIrYXUrbW9pbnMrMytjYXJhY3QlQzMlQThyZXMiO3M6OToibWF4X2ZmX3pwIjtzOjQxOiJWZXVpbGxleitlbnRyZXIrNytjYXJhY3QlQzMlQThyZXMrbWF4aW11bSI7czo5OiJyZXFfZmZfY3QiO3M6Mzk6IitTJTI3aWwrdm91cytwbGElQzMlQUV0K2VudHJlcitsYSt2aWxsZSI7czo5OiJtaW5fZmZfY3QiO3M6NDM6IitWZXVpbGxleitlbnRyZXIrYXUrbW9pbnMrMytjYXJhY3QlQzMlQThyZXMiO3M6OToibWF4X2ZmX2N0IjtzOjQzOiIrVmV1aWxsZXorZW50cmVyKzE1K2NhcmFjdCVDMyVBOHJlcyttYXhpbXVtIjtzOjk6InJlcV9mZl9zdCI7czozMDoiK1ZldWlsbGV6K2VudHJlcitsJTI3JUMzJUE5dGF0IjtzOjk6Im1pbl9mZl9zdCI7czo0MjoiVmV1aWxsZXorZW50cmVyK2F1K21vaW5zKzMrY2FyYWN0JUMzJUE4cmVzIjtzOjk6Im1heF9mZl9zdCI7czo0MzoiK1ZldWlsbGV6K2VudHJlcisxNStjYXJhY3QlQzMlQThyZXMrbWF4aW11bSI7czoxMDoicmVxX2ZmX3NybiI7czo0MDoiK1MlMjdpbCt2b3VzK3BsYSVDMyVBRXQrZW50cmVyK2Rlcytub3RlcyI7czoxMDoibWluX2ZmX3NybiI7czo0NDoiK1ZldWlsbGV6K2VudHJlcithdSttb2lucysxMCtjYXJhY3QlQzMlQThyZXMiO3M6MTA6Im1heF9mZl9zcm4iO3M6NDY6IitWZXVpbGxleitlbnRyZXIrYXUrbWF4aW11bSs3MCtjYXJhY3QlQzMlQThyZXMiO3M6MzU6IlRyYW5zYWN0aW9uX2ZhaWxlZF9wbGVhc2VfdHJ5X2FnYWluIjtzOjYwOiIrTGErdHJhbnNhY3Rpb24rYSslQzMlQTljaG91JUMzJUE5LitWZXVpbGxleityJUMzJUE5ZXNzYXllci4iO3M6MzA6IlBsZWFzZV9FbnRlcl92YWxpZF9jYXJkX2RldGFpbCI7czo0NzoiK1ZldWlsbGV6K2VudHJlcit1bitkJUMzJUE5dGFpbCtkZStjYXJ0ZSt2YWxpZGUiO30=');");
mysqli_query($this->conn, "INSERT INTO `ct_languages` (`id`, `label_data`, `language`, `admin_labels`, `error_labels`, `extra_labels`, `front_error_labels`) VALUES
(NULL, 'YToyMjQ6e3M6MTQ6Im5vbmVfYXZhaWxhYmxlIjtzOjIwOiJLZWluZSt2ZXJmJUMzJUJDZ2JhciI7czoxNToiYXBwb2ludG1lbnRfemlwIjtzOjExOiIrVGVybWluK1ppcCI7czoxNjoiYXBwb2ludG1lbnRfY2l0eSI7czoxNzoiVmVyYWJyZWR1bmcrU3RhZHQiO3M6MTc6ImFwcG9pbnRtZW50X3N0YXRlIjtzOjE1OiJFcm5lbm51bmcrU3RhYXQiO3M6MTk6ImFwcG9pbnRtZW50X2FkZHJlc3MiO3M6MTM6IlRlcm1pbmFkcmVzc2UiO3M6MTA6Imd1ZXN0X3VzZXIiO3M6MTI6Ikdhc3RiZW51dHplciI7czoyMToic2VydmljZV91c2FnZV9tZXRob2RzIjtzOjI2OiIrRGllbnN0dmVyd2VuZHVuZ3NtZXRob2RlbiI7czo2OiJwYXlwYWwiO3M6NjoiUGF5cGFsIjtzOjQ2OiJwbGVhc2VfY2hlY2tfZm9yX3RoZV9iZWxvd19taXNzaW5nX2luZm9ybWF0aW9uIjtzOjY5OiJCaXR0ZSslQzMlQkNiZXJwciVDMyVCQ2ZlbitTaWUrZGllK2ZvbGdlbmRlbitmZWhsZW5kZW4rSW5mb3JtYXRpb25lbi4iO3M6NTE6InBsZWFzZV9wcm92aWRlX2NvbXBhbnlfZGV0YWlsc19mcm9tX3RoZV9hZG1pbl9wYW5lbCI7czo2MToiQml0dGUrZ2ViZW4rU2llK2RpZStGaXJtZW5kYXRlbislQzMlQkNiZXIrZGFzK0FkbWluLVBhbmVsK2FuLiI7czo2NjoicGxlYXNlX2FkZF9zb21lX3NlcnZpY2VzX21ldGhvZHNfdW5pdHNfYWRkb25zX2Zyb21fdGhlX2FkbWluX3BhbmVsIjtzOjk3OiJCaXR0ZStmJUMzJUJDZ2VuK1NpZStlaW5pZ2UrRGllbnN0ZSUyQytNZXRob2RlbiUyQytFaW5oZWl0ZW4lMkMrQWRkb25zK2F1cytkZW0rQWRtaW4tUGFuZWwraGluenUuIjtzOjQ3OiJwbGVhc2VfYWRkX3RpbWVfc2NoZWR1bGluZ19mcm9tX3RoZV9hZG1pbl9wYW5lbCI7czo2OToiQml0dGUrZiVDMyVCQ2dlbitTaWUrZGllK1plaXRwbGFudW5nKyVDMyVCQ2JlcitkYXMrQWRtaW4tUGFuZWwraGluenUuIjtzOjY4OiJwbGVhc2VfY29tcGxldGVfY29uZmlndXJhdGlvbnNfYmVmb3JlX3lvdV9jcmVhdGVkX3dlYnNpdGVfZW1iZWRfY29kZSI7czoxMTI6IitCaXR0ZStzY2hsaWUlQzMlOUZlbitTaWUrZGllK0tvbmZpZ3VyYXRpb25lbithYiUyQytiZXZvcitTaWUrZGVuK0NvZGUrenVtK0VpbmJldHRlbitkZXIrV2Vic2l0ZStlcnN0ZWxsdCtoYWJlbi4iO3M6MzoiY3ZjIjtzOjM6IkNWQyI7czo3OiJtbV95eXl5IjtzOjE3OiIlMjhNTSslMkYrSkpKSiUyOSI7czoxODoiZXhwaXJ5X2RhdGVfb3JfY3N2IjtzOjIxOiIrQWJsYXVmZGF0dW0rb2RlcitDU1YiO3M6MjY6InN0cmVldF9hZGRyZXNzX3BsYWNlaG9sZGVyIjtzOjE3OiJ6LkIuK1plbnRyYWxlK0F2ZSI7czoyMDoiemlwX2NvZGVfcGxhY2Vob2xkZXIiO3M6MTE6Imd0JTNCKzkwMDAxIjtzOjE2OiJjaXR5X3BsYWNlaG9sZGVyIjtzOjE2OiJ6LkIuK0xvcytBbmdlbGVzIjtzOjE3OiJzdGF0ZV9wbGFjZWhvbGRlciI7czo2OiJ6Qi4rQ0EiO3M6OToicGF5dW1vbmV5IjtzOjk6IlBheVVtb25leSI7czoxMzoic2FtZV9hc19hYm92ZSI7czoyMDoiRGFzK2dsZWljaGUrd2llK29iZW4iO3M6Mzoic3VuIjtzOjY6IitTb25uZSI7czozOiJtb24iO3M6NjoiTW9udGFnIjtzOjM6InR1ZSI7czoyOiJEaSI7czozOiJ3ZWQiO3M6ODoiSGVpcmF0ZW4iO3M6MzoidGh1IjtzOjI6IkRvIjtzOjM6ImZyaSI7czoyOiJGciI7czozOiJzYXQiO3M6MzoiU2EuIjtzOjI6InN1IjtzOjQ6IkRlaW4iO3M6MjoibW8iO3M6MzoiK0R1IjtzOjI6InR1IjtzOjI6IkR1IjtzOjI6IndlIjtzOjM6IldpciI7czoyOiJ0aCI7czoyOiJUaCI7czoyOiJmciI7czozOiIrRnIiO3M6Mjoic2EiO3M6NDoiK3NpZSI7czoxMToibXlfYm9va2luZ3MiO3M6MTU6Ik1laW5lK0J1Y2h1bmdlbiI7czoxNjoieW91cl9wb3N0YWxfY29kZSI7czoxMjoiUG9zdGxlaXR6YWhsIjtzOjQyOiJ3aGVyZV93b3VsZF95b3VfbGlrZV91c190b19wcm92aWRlX3NlcnZpY2UiO3M6NDQ6IldvK20lQzMlQjZjaHRlbitTaWUrdW5zK3VudGVyc3QlQzMlQkN0emVuJTNGIjtzOjE0OiJjaG9vc2Vfc2VydmljZSI7czoyNzoiVyVDMyVBNGhsZW4rU2llK2RlbitTZXJ2aWNlIjtzOjQzOiJob3dfb2Z0ZW5fd291bGRfeW91X2xpa2VfdXNfcHJvdmlkZV9zZXJ2aWNlIjtzOjY2OiJXaWUrb2Z0K20lQzMlQjZjaHRlbitTaWUlMkMrZGFzcyt3aXIrSWhuZW4rZWluZW4rU2VydmljZStiaWV0ZW4lM0YiO3M6MzA6IndoZW5fd291bGRfeW91X2xpa2VfdXNfdG9fY29tZSI7czo0MzoiV2FubittJUMzJUI2Y2h0ZW4rU2llJTJDK2Rhc3Mrd2lyK2tvbW1lbiUzRiI7czo1OiJ0b2RheSI7czo2OiIrSEVVVEUiO3M6MjE6InlvdXJfcGVyc29uYWxfZGV0YWlscyI7czozMToiRGVpbmUrUGVycyVDMyVCNm5saWNoZW4rRGV0YWlscyI7czoxMzoiZXhpc3RpbmdfdXNlciI7czoyMjoiRXhpc3RpZXJlbmRlcitCZW51dHplciI7czo4OiJuZXdfdXNlciI7czoxNDoiTmV1ZXIrQmVudXR6ZXIiO3M6MTU6InByZWZlcnJlZF9lbWFpbCI7czoyNToiQmV2b3J6dWd0ZStFLU1haWwtQWRyZXNzZSI7czoxODoicHJlZmVycmVkX3Bhc3N3b3JkIjtzOjIwOiJCZXZvcnp1Z3RlcytQYXNzd29ydCI7czoyNDoieW91cl92YWxpZF9lbWFpbF9hZGRyZXNzIjtzOjMzOiIrSWhyZStnJUMzJUJDbHRpZ2UrRS1NYWlsLUFkcmVzc2UiO3M6MTA6ImZpcnN0X25hbWUiO3M6NzoiVm9ybmFtZSI7czoxNToieW91cl9maXJzdF9uYW1lIjtzOjExOiJJaHIrVm9ybmFtZSI7czo5OiJsYXN0X25hbWUiO3M6MjQ6IkZhbWlsaWVubmFtZSUyQytOYWNobmFtZSI7czoxNDoieW91cl9sYXN0X25hbWUiO3M6MTI6IklocitOYWNobmFtZSI7czoxNDoic3RyZWV0X2FkZHJlc3MiO3M6NzoiQWRyZXNzZSI7czoxNjoiY2xlYW5pbmdfc2VydmljZSI7czoxNzoiUmVpbmlndW5nc3NlcnZpY2UiO3M6MjA6InBsZWFzZV9zZWxlY3RfbWV0aG9kIjtzOjI5OiJCaXR0ZSt3JUMzJUE0aGxlbitTaWUrTWV0aG9kZSI7czo4OiJ6aXBfY29kZSI7czoxMjoiUG9zdGxlaXR6YWhsIjtzOjQ6ImNpdHkiO3M6NToiU3RhZHQiO3M6NToic3RhdGUiO3M6NzoiWnVzdGFuZCI7czoyMjoic3BlY2lhbF9yZXF1ZXN0c19ub3RlcyI7czozMzoiU29uZGVydyVDMyVCQ25zY2hlKyUyOEhpbndlaXNlJTI5IjtzOjI4OiJkb195b3VfaGF2ZV9hX3ZhY2N1bV9jbGVhbmVyIjtzOjI4OiJIYXN0K2R1K2VpbmVuK1N0YXVic2F1Z2VyJTNGIjtzOjI3OiJhc3NpZ25fYXBwb2ludG1lbnRfdG9fc3RhZmYiO3M6Mjg6IlRlcm1pbitkZW0rUGVyc29uYWwrenV3ZWlzZW4iO3M6MTM6ImRlbGV0ZV9tZW1iZXIiO3M6MjQ6Ik1pdGdsaWVkK2wlQzMlQjZzY2hlbiUzRiI7czozOiJ5ZXMiO3M6MzoiK0phIjtzOjI6Im5vIjtzOjU6IitOZWluIjtzOjI0OiJwcmVmZXJyZWRfcGF5bWVudF9tZXRob2QiO3M6MjY6IkJldm9yenVndGUrWmFobHVuZ3NtZXRob2RlIjtzOjMyOiJwbGVhc2Vfc2VsZWN0X29uZV9wYXltZW50X21ldGhvZCI7czo0MzoiK0JpdHRlK3clQzMlQTRobGVuK1NpZStlaW5lK1phaGx1bmdzYXJ0K2F1cyI7czoxNToicGFydGlhbF9kZXBvc2l0IjtzOjExOiJUZWlsa2F1dGlvbiI7czoxNjoicmVtYWluaW5nX2Ftb3VudCI7czoxMDoiUmVzdGJldHJhZyI7czo0NjoicGxlYXNlX3JlYWRfb3VyX3Rlcm1zX2FuZF9jb25kaXRpb25zX2NhcmVmdWxseSI7czo0ODoiQml0dGUrbGVzZW4rU2llK3Vuc2VyZStBR0Irc29yZ2YlQzMlQTRsdGlnK2R1cmNoIjtzOjE5OiJkb195b3VfaGF2ZV9wYXJraW5nIjtzOjI4OiJIYWJlbitTaWUrUGFya3BsJUMzJUE0dHplJTNGIjtzOjE4OiJob3dfd2lsbF93ZV9nZXRfaW4iO3M6Mjg6IldpZSt3ZXJkZW4rd2lyK3JlaW5rb21tZW4lM0YiO3M6MTc6Imlfd2lsbF9iZV9hdF9ob21lIjtzOjI0OiIrSWNoK3dlcmRlK3p1K0hhdXNlK3NlaW4iO3M6MTQ6InBsZWFzZV9jYWxsX21lIjtzOjE4OiIrQml0dGUrcnVmK21pY2grYW4iO3M6NTc6InJlY3VycmluZ19kaXNjb3VudHNfYXBwbHlfZnJvbV90aGVfc2Vjb25kX2NsZWFuaW5nX29ud2FyZCI7czo1NToiV2llZGVya2VocmVuZGUrUmFiYXR0ZStnZWx0ZW4rYWIrZGVyK3p3ZWl0ZW4rUmVpbmlndW5nLiI7czo0NzoicGxlYXNlX3Byb3ZpZGVfeW91cl9hZGRyZXNzX2FuZF9jb250YWN0X2RldGFpbHMiO3M6NDg6IkJpdHRlK2dlYmVuK1NpZStJaHJlK0FkcmVzc2UrdW5kK0tvbnRha3RkYXRlbithbiI7czoyMDoieW91X2FyZV9sb2dnZWRfaW5fYXMiO3M6MjI6IkR1K2Jpc3QrZWluZ2Vsb2dndCthbHMiO3M6Mjc6InRoZV9rZXlfaXNfd2l0aF90aGVfZG9vcm1hbiI7czozODoiRGVyK1NjaGwlQzMlQkNzc2VsK2lzdCttaXQrZGVtK1BvcnRpZXIiO3M6NToib3RoZXIiO3M6NjoiQW5kZXJlIjtzOjE2OiJoYXZlX2FfcHJvbW9jb2RlIjtzOjMwOiIrSGFiZW4rU2llK2VpbmVuK1Byb21vLUNvZGUlM0YiO3M6NToiYXBwbHkiO3M6MTM6IlNpY2grYmV3ZXJiZW4iO3M6MTc6ImFwcGxpZWRfcHJvbW9jb2RlIjtzOjIxOiJBbmdld2FuZHRlcitQcm9tb2NvZGUiO3M6MTY6ImNvbXBsZXRlX2Jvb2tpbmciO3M6MTc6IktvbXBsZXR0ZStCdWNodW5nIjtzOjE5OiJjYW5jZWxsYXRpb25fcG9saWN5IjtzOjIzOiJTdG9ybmllcnVuZ3NiZWRpbmd1bmdlbiI7czoyNjoiY2FuY2VsbGF0aW9uX3BvbGljeV9oZWFkZXIiO3M6MzA6IlN0b3JuaWVydW5nc3JpY2h0bGluaWVuLUhlYWRlciI7czoyODoiY2FuY2VsbGF0aW9uX3BvbGljeV90ZXh0YXJlYSI7czoxODoiV2lkZXJydWZzYmVsZWhydW5nIjtzOjM1OiJmcmVlX2NhbmNlbGxhdGlvbl9iZWZvcmVfcmVkZW1wdGlvbiI7czo0NToiS29zdGVubG9zZStTdG9ybmllcnVuZyt2b3IrZGVyK0VpbmwlQzMlQjZzdW5nIjtzOjk6InNob3dfbW9yZSI7czo5OiJaZWlnK21laHIiO3M6MjE6InBsZWFzZV9zZWxlY3Rfc2VydmljZSI7czoyOToiQml0dGUrdyVDMyVBNGhsZW4rU2llK1NlcnZpY2UiO3M6Mzc6ImNob29zZV95b3VyX3NlcnZpY2VfYW5kX3Byb3BlcnR5X3NpemUiO3M6NjU6IlclQzMlQTRobGVuK1NpZStJaHJlK1NlcnZpY2UtK3VuZCtHcnVuZHN0JUMzJUJDY2tzZ3IlQzMlQjYlQzMlOUZlIjtzOjE5OiJjaG9vc2VfeW91cl9zZXJ2aWNlIjtzOjI5OiJXJUMzJUE0aGxlbitTaWUrSWhyZW4rU2VydmljZSI7czo2ODoicGxlYXNlX2NvbmZpZ3VyZV9maXJzdF9jbGVhbmluZ19zZXJ2aWNlc19hbmRfc2V0dGluZ3NfaW5fYWRtaW5fcGFuZWwiO3M6ODY6IitCaXR0ZStrb25maWd1cmllcmVuK1NpZStkaWUrZXJzdGVuK1JlaW5pZ3VuZ3NkaWVuc3RlK3VuZCtFaW5zdGVsbHVuZ2VuK2ltK0FkbWluLVBhbmVsIjtzOjI4OiJpX2hhdmVfcmVhZF9hbmRfYWNjZXB0ZWRfdGhlIjtzOjMyOiIrSWNoK2hhYmUrZ2VsZXNlbit1bmQrYWt6ZXB0aWVydCI7czoxOToidGVybXNfYW5kX2NvbmRpdGlvbiI7czoyODoiVGVybXMrJTI2K2FtcCUzQitCZWRpbmd1bmdlbiI7czozOiJhbmQiO3M6MzoidW5kIjtzOjE0OiJ1cGRhdGVkX2xhYmVscyI7czoyMzoiQWt0dWFsaXNpZXJ0ZStFdGlrZXR0ZW4iO3M6MTQ6InByaXZhY3lfcG9saWN5IjtzOjI0OiJEYXRlbnNjaHV0ei1CZXN0aW1tdW5nZW4iO3M6NzM6InBsZWFzZV9maWxsX2FsbF90aGVfY29tcGFueV9pbmZvcm1hdGlvbnNfYW5kX2FkZF9zb21lX3NlcnZpY2VzX2FuZF9hZGRvbnMiO3M6NTU6IkVyZm9yZGVybGljaGUrS29uZmlndXJhdGlvbmVuK3NpbmQrbmljaHQrYWJnZXNjaGxvc3Nlbi4iO3M6MTU6ImJvb2tpbmdfc3VtbWFyeSI7czoyMjoiQnVjaHVuZ3MlQzMlQkNiZXJzaWNodCI7czoxMDoieW91cl9lbWFpbCI7czoxMjoiRGVpbmUrRS1NYWlsIjtzOjIwOiJlbnRlcl9lbWFpbF90b19sb2dpbiI7czoyODoiR2ViZW4rU2llK0UtTWFpbC1BZHJlc3NlK2VpbiI7czoxMzoieW91cl9wYXNzd29yZCI7czoxMjoiSWhyK1Bhc3N3b3J0IjtzOjE5OiJlbnRlcl95b3VyX3Bhc3N3b3JkIjtzOjI3OiIrR2ViZW4rU2llK0locitQYXNzd29ydCtlaW4iO3M6MTU6ImZvcmdldF9wYXNzd29yZCI7czoyMjoiK1Bhc3N3b3J0K3Zlcmdlc3NlbiUzRiI7czoxNDoicmVzZXRfcGFzc3dvcmQiO3M6MjY6IlBhc3N3b3J0K3p1ciVDMyVCQ2Nrc2V0emVuIjtzOjcyOiJlbnRlcl95b3VyX2VtYWlsX2FuZF93ZV9zZW5kX3lvdV9pbnN0cnVjdGlvbnNfb25fcmVzZXR0aW5nX3lvdXJfcGFzc3dvcmQiO3M6MTA1OiJHZWJlbitTaWUrSWhyZStFLU1haWwtQWRyZXNzZStlaW4rdW5kK3dpcitzZW5kZW4rSWhuZW4rQW53ZWlzdW5nZW4renVtK1p1ciVDMyVCQ2Nrc2V0emVuK0locmVzK1Bhc3N3b3J0cy4iO3M6MTY6InJlZ2lzdGVyZWRfZW1haWwiO3M6MTg6IlJlZ2lzdHJpZXJ0ZStFbWFpbCI7czo5OiJzZW5kX21haWwiO3M6MTM6IkUtTWFpbCtzZW5kZW4iO3M6MTM6ImJhY2tfdG9fbG9naW4iO3M6MjU6Ilp1ciVDMyVCQ2NrK3p1citBbm1lbGR1bmciO3M6NDoieW91ciI7czo0OiJJaHJlIjtzOjE2OiJ5b3VyX2NsZWFuX2l0ZW1zIjtzOjMxOiJEZWluZStzYXViZXJlbitHZWdlbnN0JUMzJUE0bmRlIjtzOjE4OiJ5b3VyX2NhcnRfaXNfZW1wdHkiO3M6MjI6IklocitXYXJlbmtvcmIraXN0K2xlZXIiO3M6MTI6InN1Yl90b3RhbHRheCI7czoxMzoiK1N1YitUb3RhbFRheCI7czo5OiJzdWJfdG90YWwiO3M6MTA6IlVudGVyc3VtbWUiO3M6MjY6Im5vX2RhdGFfYXZhaWxhYmxlX2luX3RhYmxlIjtzOjQyOiIrS2VpbmUrRGF0ZW4raW4rZGVyK1RhYmVsbGUrdmVyZiVDMyVCQ2diYXIiO3M6NToidG90YWwiO3M6NjoiR2VzYW10IjtzOjI6Im9yIjtzOjQ6Ik9kZXIiO3M6MTg6InNlbGVjdF9hZGRvbl9pbWFnZSI7czozNDoiVyVDMyVBNGhsZW4rU2llK2VpbitadXNhdHpiaWxkK2F1cyI7czoxMzoiaW5zaWRlX2ZyaWRnZSI7czoyMjoiSW5uZW4rSyVDMyVCQ2hsc2NocmFuayI7czoxMToiaW5zaWRlX292ZW4iO3M6MTE6IitJbm5lbitPZmVuIjtzOjE0OiJpbnNpZGVfd2luZG93cyI7czoxMDoiSW4rV2luZG93cyI7czoxNToiY2FycGV0X2NsZWFuaW5nIjtzOjE2OiJUZXBwaWNocmVpbmlndW5nIjtzOjE0OiJncmVlbl9jbGVhbmluZyI7czoyMDoiR3IlQzMlQkNuZStSZWluaWd1bmciO3M6OToicGV0c19jYXJlIjtzOjE2OiJIYXVzdGllcmUrUGZsZWdlIjtzOjE0OiJ0aWxlc19jbGVhbmluZyI7czoxNzoiRmxpZXNlbitSZWluaWd1bmciO3M6MTM6IndhbGxfY2xlYW5pbmciO3M6MTM6IldhbmRyZWluaWd1bmciO3M6NzoibGF1bmRyeSI7czoxMToiVyVDMyVBNHNjaGUiO3M6MTc6ImJhc2VtZW50X2NsZWFuaW5nIjtzOjE1OiJLZWxsZXJyZWluaWd1bmciO3M6MTE6ImJhc2ljX3ByaWNlIjtzOjEwOiJHcnVuZHByZWlzIjtzOjc6Im1heF9xdHkiO3M6MTA6Ik1heC4rTWVuZ2UiO3M6MTI6Im11bHRpcGxlX3F0eSI7czoxNToiTWVocmZhY2hlK01lbmdlIjtzOjEwOiJiYXNlX3ByaWNlIjtzOjEwOiJHcnVuZHByZWlzIjtzOjEyOiJ1bml0X3ByaWNpbmciO3M6MTU6IlN0JUMzJUJDY2twcmVpcyI7czoxNjoibWV0aG9kX2lzX2Jvb2tlZCI7czoxOToiTWV0aG9kZStpc3QrZ2VidWNodCI7czoyNjoic2VydmljZV9hZGRvbnNfcHJpY2VfcnVsZXMiO3M6MzY6IlByZWlzcmVnZWxuK2YlQzMlQkNyK1NlcnZpY2UtQWRkLW9ucyI7czozMjoic2VydmljZV91bml0X2Zyb250X2Ryb3Bkb3duX3ZpZXciO3M6Mzk6IlZvcmRlcmFuc2ljaHQrZGVyK1NlcnZpY2UrVW5pdCtEcm9wRG93biI7czoyOToic2VydmljZV91bml0X2Zyb250X2Jsb2NrX3ZpZXciO3M6NDQ6IlZvcmRlcnNlaXRlK2RlcitXYXJ0dW5nc2VpbmhlaXQrQmxvY2thbnNpY2h0IjtzOjQxOiJzZXJ2aWNlX3VuaXRfZnJvbnRfaW5jcmVhc2VfZGVjcmVhc2VfdmlldyI7czo2MzoiU2VydmljZStVbml0K0Zyb250K0Fuc2ljaHQrdmVyZ3IlQzMlQjYlQzMlOUZlcm4rJTJGK3ZlcmtsZWluZXJuIjtzOjEyOiJhcmVfeW91X3N1cmUiO3M6MTQ6IkJpc3QrZHUrc2ljaGVyIjtzOjI0OiJzZXJ2aWNlX3VuaXRfcHJpY2VfcnVsZXMiO3M6MjA6IlNlcnZpY2UtUHJlaXMtUmVnZWxuIjtzOjU6ImNsb3NlIjtzOjE0OiJTY2hsaWUlQzMlOUZlbiI7czo2OiJjbG9zZWQiO3M6MTE6Ikdlc2NobG9zc2VuIjtzOjE0OiJzZXJ2aWNlX2FkZG9ucyI7czoyMToiU2VydmljZS1FcndlaXRlcnVuZ2VuIjtzOjE0OiJzZXJ2aWNlX2VuYWJsZSI7czoxODoiU2VydmljZStha3RpdmllcmVuIjtzOjE1OiJzZXJ2aWNlX2Rpc2FibGUiO3M6MTk6IkRpZW5zdCtkZWFrdGl2aWVyZW4iO3M6MTM6Im1ldGhvZF9lbmFibGUiO3M6MTg6Ik1ldGhvZGUrYWt0aXZpZXJlbiI7czoxNjoib2ZmX3RpbWVfZGVsZXRlZCI7czoyMToiQXVzemVpdCtnZWwlQzMlQjZzY2h0IjtzOjI3OiJlcnJvcl9pbl9kZWxldGVfb2Zfb2ZmX3RpbWUiO3M6MzY6IkZlaGxlcitiZWltK0wlQzMlQjZzY2hlbitkZXIrQXVzemVpdCI7czoxNDoibWV0aG9kX2Rpc2FibGUiO3M6MjA6Ik1ldGhvZGUrRGVha3RpdmllcmVuIjtzOjE0OiJleHRyYV9zZXJ2aWNlcyI7czoyMjoiRXh0cmErRGllbnN0bGVpc3R1bmdlbiI7czo1OToiZm9yX2luaXRpYWxfY2xlYW5pbmdfb25seV9jb250YWN0X3VzX3RvX2FwcGx5X3RvX3JlY3VycmluZ3MiO3M6OTM6IitOdXIrenVyK2FuZiVDMyVBNG5nbGljaGVuK1JlaW5pZ3VuZy4rS29udGFrdGllcmVuK1NpZSt1bnMlMkMrdW0rZGllK1Jla3Vyc2lvbit6dStiZWFudHJhZ2VuLiI7czo5OiJudW1iZXJfb2YiO3M6MTA6IkFuemFobCt2b24iO3M6Mjg6ImV4dHJhX3NlcnZpY2VzX25vdF9hdmFpbGFibGUiO3M6NDU6Ilp1cyVDMyVBNHR6bGljaGUrRGllbnN0ZStuaWNodCt2ZXJmJUMzJUJDZ2JhciI7czo5OiJhdmFpbGFibGUiO3M6MTQ6IlZlcmYlQzMlQkNnYmFyIjtzOjg6InNlbGVjdGVkIjtzOjE2OiIrQXVzZ2V3JUMzJUE0aGx0IjtzOjEzOiJub3RfYXZhaWxhYmxlIjtzOjIwOiJOaWNodCt2ZXJmJUMzJUJDZ2JhciI7czo0OiJub25lIjtzOjc6IitLZWluZXIiO3M6NTQ6Im5vbmVfb2ZfdGltZV9zbG90X2F2YWlsYWJsZV9wbGVhc2VfY2hlY2tfYW5vdGhlcl9kYXRlcyI7czo4MDoiS2VpbitaZWl0ZmVuc3Rlcit2ZXJmJUMzJUJDZ2JhcitCaXR0ZSslQzMlQkNiZXJwciVDMyVCQ2ZlbitTaWUrZWluK2FuZGVyZXMrRGF0dW0iO3M6NDY6ImF2YWlsYWJpbGl0eV9pc19ub3RfY29uZmlndXJlZF9mcm9tX2FkbWluX3NpZGUiO3M6NjE6IlZlcmYlQzMlQkNnYmFya2VpdCtpc3QrbmljaHQrdm9uK2RlcitBZG1pbi1TZWl0ZStrb25maWd1cmllcnQiO3M6MTg6Imhvd19tYW55X2ludGVuc2l2ZSI7czoxODoiV2llK3ZpZWxlK0ludGVuc2l2IjtzOjEyOiJub19pbnRlbnNpdmUiO3M6MTM6IktlaW4rSW50ZW5zaXYiO3M6MTk6ImZyZXF1ZW50bHlfZGlzY291bnQiO3M6MTg6IkglQzMlQTR1ZmlnK1JhYmF0dCI7czoxNToiY291cG9uX2Rpc2NvdW50IjtzOjE3OiIrR3V0c2NoZWluK1JhYmF0dCI7czo4OiJob3dfbWFueSI7czo5OiJXaWUrdmllbGUiO3M6MjM6ImVudGVyX3lvdXJfb3RoZXJfb3B0aW9uIjtzOjMyOiJHZWJlbitTaWUrSWhyZSthbmRlcmUrT3B0aW9uK2VpbiI7czo3OiJsb2dfb3V0IjtzOjk6IkF1c2xvZ2dlbiI7czoyMDoieW91cl9hZGRlZF9vZmZfdGltZXMiO3M6MjE6IklocmUrYWRkaWVydGVuK1plaXRlbiI7czo2OiJsb2dfaW4iO3M6OToiQW5tZWxkdW5nIjtzOjEwOiJjdXN0b21fY3NzIjtzOjIyOiJCZW51dHplcmRlZmluaWVydGUrQ1NTIjtzOjc6InN1Y2Nlc3MiO3M6NjoiRXJmb2xnIjtzOjc6ImZhaWx1cmUiO3M6NjoiRmVobGVyIjtzOjMwOiJ5b3VfY2FuX29ubHlfdXNlX3ZhbGlkX3ppcGNvZGUiO3M6NjA6IlNpZStrJUMzJUI2bm5lbitudXIrZWluZStnJUMzJUJDbHRpZ2UrUG9zdGxlaXR6YWhsK3ZlcndlbmRlbiI7czo3OiJtaW51dGVzIjtzOjk6IlByb3Rva29sbCI7czo1OiJob3VycyI7czo0OiIrU3RkIjtzOjQ6ImRheXMiO3M6NToiK1RhZ2UiO3M6NjoibW9udGhzIjtzOjY6Ik1vbmF0ZSI7czo0OiJ5ZWFyIjtzOjU6IitKYWhyIjtzOjE0OiJkZWZhdWx0X3VybF9pcyI7czoxNjoiU3RhbmRhcmQtVVJMK2lzdCI7czoxMjoiY2FyZF9wYXltZW50IjtzOjEzOiJLYXJ0ZW56YWhsdW5nIjtzOjEyOiJwYXlfYXRfdmVudWUiO3M6Mjk6IkFtK1ZlcmFuc3RhbHR1bmdzb3J0K2JlemFobGVuIjtzOjEyOiJjYXJkX2RldGFpbHMiO3M6MTM6IkthcnRlbmRldGFpbHMiO3M6MTE6ImNhcmRfbnVtYmVyIjtzOjEyOiJLYXJ0ZW5udW1tZXIiO3M6MTk6ImludmFsaWRfY2FyZF9udW1iZXIiO3M6MjY6IlVuZyVDMyVCQ2x0aWdlK0thcnRlbm51bW1lIjtzOjY6ImV4cGlyeSI7czo3OiIrQWJsYXVmIjtzOjE0OiJidXR0b25fcHJldmlldyI7czoyNjoiU2NoYWx0ZmwlQzMlQTRjaGUrVm9yc2NoYXUiO3M6ODoidGhhbmt5b3UiO3M6MTE6IlZpZWxlbitEYW5rIjtzOjMyOiJ0aGFua3lvdV9mb3JfYm9va2luZ19hcHBvaW50bWVudCI7czozOToiK1ZpZWxlbitEYW5rJTIxK2YlQzMlQkNyK0J1Y2h1bmdzdGVybWluIjtzOjU3OiJ5b3Vfd2lsbF9iZV9ub3RpZmllZF9ieV9lbWFpbF93aXRoX2RldGFpbHNfb2ZfYXBwb2ludG1lbnQiO3M6NjA6IlNpZSt3ZXJkZW4rcGVyK0UtTWFpbCttaXQrRGV0YWlscytkZXMrVGVybWlucytiZW5hY2hyaWNodGlndCI7czoyMjoicGxlYXNlX2VudGVyX2ZpcnN0bmFtZSI7czoyNzoiQml0dGUrZ2ViZW4rU2llK1Zvcm5hbWUrZWluIjtzOjIxOiJwbGVhc2VfZW50ZXJfbGFzdG5hbWUiO3M6MzM6IkJpdHRlK2dlYmVuK1NpZStkZW4rTmFjaG5hbWVuK2VpbiI7czoyMToicmVtb3ZlX2FwcGxpZWRfY291cG9uIjtzOjQyOiIrRW50ZmVybmVuK1NpZStkZW4rYXVmZ2VicmFjaHRlbitHdXRzY2hlaW4iO3M6MjU6ImVnXzc5OV9lX2RyYWdyYW1fc3VpdGVfNWEiO3M6MjY6InpCLis3OTkrRStEUkFHUkFNK1NVSVRFKzVBIjtzOjg6ImVnXzE0MTE0IjtzOjEwOiJ6LkIuKzE0MTE0IjtzOjk6ImVnX3R1Y3NvbiI7czoxMToiei5CLitUVUNTT04iO3M6NToiZWdfYXoiO3M6ODoiK3pCLitEQVMiO3M6Nzoid2FybmluZyI7czo3OiJXYXJudW5nIjtzOjk6InRyeV9sYXRlciI7czoyMzoiVmVyc3VjaGUrZXMrc3AlQzMlQTR0ZXIiO3M6MTE6ImNob29zZV95b3VyIjtzOjE3OiJXJUMzJUE0aGxlK2RlaW5lbiI7czoxNzoiY29uZmlndXJlX25vd19uZXciO3M6MTk6IkpldHp0K2tvbmZpZ3VyaWVyZW4iO3M6NzoiamFudWFyeSI7czo2OiJKQU5VQVIiO3M6ODoiZmVicnVhcnkiO3M6NzoiRkVCUlVBUiI7czo1OiJtYXJjaCI7czoxMDoiK00lQzMlODRSWiI7czo1OiJhcHJpbCI7czo2OiIrQVBSSUwiO3M6MzoibWF5IjtzOjQ6IktBTk4iO3M6NDoianVuZSI7czo1OiIrSlVOSSI7czo0OiJqdWx5IjtzOjQ6IkpVTEkiO3M6NjoiYXVndXN0IjtzOjc6IitBVUdVU1QiO3M6OToic2VwdGVtYmVyIjtzOjk6IlNFUFRFTUJFUiI7czo3OiJvY3RvYmVyIjtzOjc6Ik9LVE9CRVIiO3M6ODoibm92ZW1iZXIiO3M6ODoiTk9WRU1CRVIiO3M6ODoiZGVjZW1iZXIiO3M6ODoiREVaRU1CRVIiO3M6MzoiamFuIjtzOjM6IkpBTiI7czozOiJmZWIiO3M6MzoiRkVCIjtzOjM6Im1hciI7czoxNjoiQkVTQ0glQzMlODRESUdFTiI7czozOiJhcHIiO3M6MzoiQVBSIjtzOjM6Imp1biI7czozOiJKVU4iO3M6MzoianVsIjtzOjM6IkpVTCI7czozOiJhdWciO3M6MzoiQVVHIjtzOjM6InNlcCI7czozOiJTRVAiO3M6Mzoib2N0IjtzOjM6Ik9LVCI7czozOiJub3YiO3M6MzoiTk9WIjtzOjM6ImRlYyI7czozOiJERUMiO3M6MTE6InBheV9sb2NhbGx5IjtzOjE2OiJWb3IrT3J0K2JlemFobGVuIjtzOjIyOiJwbGVhc2Vfc2VsZWN0X3Byb3ZpZGVyIjtzOjM4OiJCaXR0ZSt3JUMzJUE0aGxlbitTaWUrZGVuK0FuYmlldGVyK2F1cyI7fQ==', 'de_DE', 'YTo2NzA6e3M6NDoiZXdheSI7czo0OiJFd2F5IjtzOjEyOiJoYWxmX3NlY3Rpb24iO3M6MTY6IkhhbGJlcitBYnNjaG5pdHQiO3M6MTI6Im9wdGlvbl90aXRsZSI7czoxMjoiT3B0aW9uK1RpdGVsIjtzOjExOiJtZXJjaGFudF9JRCI7czoxNToiSCVDMyVBNG5kbGVyLUlEIjtzOjEyOiJIb3dfaXRfd29ya3MiO3M6MjI6IldpZStlcytmdW5rdGlvbmllcnQlM0YiO3M6NjA6IllvdXJfY3VycmVuY3lfc2hvdWxkX2JlX0FVRF90b19lbmFibGVfcGF5d2F5X3BheW1lbnRfZ2F0ZXdheSI7czo5NjoiSWhyZStXJUMzJUE0aHJ1bmcrc29sbHRlK0F1c3RyYWxpZW4rRG9sbGFyK3NlaW4lMkMrdW0rUGF5d2F5K1BheW1lbnQrR2F0ZXdheSt6dStlcm0lQzMlQjZnbGljaGVuIjtzOjEwOiJzZWN1cmVfa2V5IjtzOjI0OiIrU2ljaGVyZXIrU2NobCVDMyVCQ3NzZWwiO3M6NjoicGF5d2F5IjtzOjY6IlBheXdheSI7czo3ODoiWW91cl9Hb29nbGVfY2FsZW5kYXJfaWRfd2hlcmVfeW91X25lZWRfdG9fZ2V0X2FsZXJ0c19pdHNfbm9ybWFseV95b3VyX0dtYWlsX0lEIjtzOjE0NzoiSWhyZStHb29nbGUrS2FsZW5kZXItSUQlMkMrYmVpK2RlcitTaWUrQmVuYWNocmljaHRpZ3VuZ2VuK2VyaGFsdGVuK20lQzMlQkNzc2VuJTJDK2lzdCtub3JtYWxlcndlaXNlK0locmUrR29vZ2xlK01haWwtSUQuK3ouQi4ram9obmRvZSU0MGJlaXNwaWVsLmRlIjtzOjYwOiJZb3VfY2FuX2dldF95b3VyX2NsaWVudF9JRF9mcm9tX3lvdXJfR29vZ2xlX0NhbGVuZGFyX0NvbnNvbGUiO3M6Nzg6IitTaWUrayVDMyVCNm5uZW4rSWhyZStDbGllbnQtSUQrJUMzJUJDYmVyK0locmUrR29vZ2xlK0thbGVuZGVyLUtvbnNvbGUrYWJydWZlbiI7czo2NDoiWW91X2Nhbl9nZXRfeW91cl9jbGllbnRfc2VjcmV0X2Zyb21feW91cl9Hb29nbGVfQ2FsZW5kYXJfQ29uc29sZSI7czo3NToiU2llK2slQzMlQjZubmVuK0locmVuK0NsaWVudCtpbitJaHJlcitHb29nbGUrS2FsZW5kZXItS29uc29sZStnZWhlaW0raGFsdGVuIjtzOjM4OiJpdHNfeW91cl9DbGVhbnRvX2Jvb2tpbmdfZm9ybV9wYWdlX3VybCI7czo0NzoiK2VzK2lzdCtJaHJlK0NsZWFudG8rQnVjaHVuZ3Nmb3JtdWxhcitTZWl0ZStVUkwiO3M6NDE6Ikl0c195b3VyX0NsZWFudG9fR29vZ2xlX1NldHRpbmdzX3BhZ2VfdXJsIjtzOjUwOiJFcytpc3QrSWhyZStDbGVhbnRvK0dvb2dsZStFaW5zdGVsbHVuZ2VuK1NlaXRlK1VSTCI7czoxODoiQWRkX01hbnVhbF9ib29raW5nIjtzOjMyOiJNYW51ZWxsZStCdWNodW5nK2hpbnp1ZiVDMyVCQ2dlbiI7czoyNDoiR29vZ2xlX0NhbGVuZGVyX1NldHRpbmdzIjtzOjI4OiJHb29nbGUrS2FsZW5kZXJlaW5zdGVsbHVuZ2VuIjtzOjM1OiJBZGRfQXBwb2ludG1lbnRzX1RvX0dvb2dsZV9DYWxlbmRlciI7czo0MjoiVGVybWluZSt6dStHb29nbGUrS2FsZW5kZXIraGluenVmJUMzJUJDZ2VuIjtzOjE4OiJHb29nbGVfQ2FsZW5kZXJfSWQiO3M6MTg6Ikdvb2dsZStLYWxlbmRlci1JRCI7czoyNToiR29vZ2xlX0NhbGVuZGVyX0NsaWVudF9JZCI7czoyNjoiK0dvb2dsZStLYWxlbmRlci1DbGllbnQtSUQiO3M6Mjk6Ikdvb2dsZV9DYWxlbmRlcl9DbGllbnRfU2VjcmV0IjtzOjMyOiJHb29nbGUrS2FsZW5kZXItQ2xpZW50LUdlaGVpbW5pcyI7czoyODoiR29vZ2xlX0NhbGVuZGVyX0Zyb250ZW5kX1VSTCI7czoyOToiR29vZ2xlK0thbGVuZGVyLUZyb250LUVuZC1VUkwiO3M6MjU6Ikdvb2dsZV9DYWxlbmRlcl9BZG1pbl9VUkwiO3M6MzM6Ikdvb2dsZStLYWxlbmRlci1BZG1pbmlzdHJhdG9yLVVSTCI7czoyOToiR29vZ2xlX0NhbGVuZGVyX0NvbmZpZ3VyYXRpb24iO3M6Mjg6Ikdvb2dsZStLYWxlbmRlcmtvbmZpZ3VyYXRpb24iO3M6MTI6IlR3b19XYXlfU3luYyI7czoyNjoiWndlaS1XZWdlLVN5bmNocm9uaXNpZXJ1bmciO3M6MTQ6IlZlcmlmeV9BY2NvdW50IjtzOjI2OiJLb250byslQzMlQkNiZXJwciVDMyVCQ2ZlbiI7czoxNToiU2VsZWN0X0NhbGVuZGFyIjtzOjI0OiJXJUMzJUE0aGxlbitTaWUrS2FsZW5kZXIiO3M6MTA6IkRpc2Nvbm5lY3QiO3M6NzoiVHJlbm5lbiI7czoxODoiQ2FsZW5kYXJfRmlzcnRfRGF5IjtzOjIwOiIrS2FsZW5kZXIrZXJzdGVyK1RhZyI7czoyMToiQ2FsZW5kYXJfRGVmYXVsdF9WaWV3IjtzOjI0OiJLYWxlbmRlcitTdGFuZGFyZGFuc2ljaHQiO3M6MTg6IlNob3dfY29tcGFueV90aXRsZSI7czoyMDoiRmlybWVudGl0ZWwrYW56ZWlnZW4iO3M6MjU6ImZyb250X2xhbmd1YWdlX2ZsYWdzX2xpc3QiO3M6Mjc6IkZyb250K1NwcmFjaGVuK0ZsYWdnZStMaXN0ZSI7czoyMToiR29vZ2xlX0FuYWx5dGljc19Db2RlIjtzOjIxOiJHb29nbGUrQW5hbHl0aWNzLUNvZGUiO3M6MTM6IlBhZ2VfTWV0YV9UYWciO3M6MTg6IlNlaXRlKyUyRitNZXRhLVRhZyI7czoxMjoiU0VPX1NldHRpbmdzIjtzOjE3OiJTRU8rRWluc3RlbGx1bmdlbiI7czoxNjoiTWV0YV9EZXNjcmlwdGlvbiI7czoxNzoiTWV0YStCZXNjaHJlaWJ1bmciO3M6MzoiU0VPIjtzOjM6IlNFTyI7czoxMjoib2dfdGFnX2ltYWdlIjtzOjEzOiJ1bmQrbmltbStCaWxkIjtzOjEwOiJvZ190YWdfdXJsIjtzOjExOiJ1bmQrVGFnLVVSTCI7czoxMToib2dfdGFnX3R5cGUiO3M6MTA6InVuZCtUYWd0eXAiO3M6MTI6Im9nX3RhZ190aXRsZSI7czoxMzoidW5kK1RhZy1UaXRlbCI7czo4OiJRdWFudGl0eSI7czo1OiJNZW5nZSI7czoxMjoiU2VuZF9JbnZvaWNlIjtzOjE1OiJSZWNobnVuZytzZW5kZW4iO3M6MTA6IlJlY3VycmVuY2UiO3M6MTI6IldpZWRlcmhvbHVuZyI7czoxODoiUmVjdXJyZW5jZV9ib29raW5nIjtzOjIwOiJXaWVkZXJob2x1bmcrQnVjaHVuZyI7czoxMToiUmVzZXRfQ29sb3IiO3M6MjM6IkZhcmJlK3p1ciVDMyVCQ2Nrc2V0emVuIjtzOjY6IkxvYWRlciI7czo1OiJMYWRlciI7czoxMDoiQ1NTX0xvYWRlciI7czo5OiJDU1MtTGFkZXIiO3M6MTA6IkdJRl9Mb2FkZXIiO3M6OToiR0lGLUxhZGVyIjtzOjE0OiJEZWZhdWx0X0xvYWRlciI7czoxMzoiU3RhbmRhcmRsYWRlciI7czo1OiJmb3JfYSI7czoxMzoiK0YlQzMlQkNyK2VpbiI7czoxNzoic2hvd19jb21wYW55X2xvZ28iO3M6MjA6IitGaXJtZW5sb2dvK2FuemVpZ2VuIjtzOjI6Im9uIjtzOjM6ImF1ZiI7czoxMzoidXNlcl96aXBfY29kZSI7czoxMjoiUG9zdGxlaXR6YWhsIjtzOjE4OiJkZWxldGVfdGhpc19tZXRob2QiO3M6MzM6IkwlQzMlQjZzY2hlbitTaWUrZGllc2UrTWV0aG9kZSUzRiI7czoxMzoiYXV0aG9yaXplX25ldCI7czoxNjoiQXV0b3Jpc2llcmVuLk5ldCI7czoxMzoic3RhZmZfZGV0YWlscyI7czoxODoiTWl0YXJiZWl0ZXJkZXRhaWxzIjtzOjE1OiJjbGllbnRfcGF5bWVudHMiO3M6MTY6IitLdW5kZW56YWhsdW5nZW4iO3M6MTQ6InN0YWZmX3BheW1lbnRzIjtzOjE4OiIrUGVyc29uYWx6YWhsdW5nZW4iO3M6MjI6InN0YWZmX3BheW1lbnRzX2RldGFpbHMiO3M6MjU6IlBlcnNvbmFsemFobHVuZ2VuK0RldGFpbHMiO3M6MTI6ImFkdmFuY2VfcGFpZCI7czoxMzoiVm9yYXVzemFobHVuZyI7czoyNjoiY2hhbmdlX2NhbGN1bGF0aW9uX3BvbGljeXkiO3M6NDE6IiVDMyU4NG5kZXJuK1NpZStkaWUrQmVyZWNobnVuZ3NyaWNodGxpbmllIjtzOjE0OiJmcm9udGVuZF9mb250cyI7czoyMjoiRnJvbnQtRW5kLVNjaHJpZnRhcnRlbiI7czoxMzoiZmF2aWNvbl9pbWFnZSI7czoxMzoiK0Zhdmljb24rQmlsZCI7czoyMDoic3RhZmZfZW1haWxfdGVtcGxhdGUiO3M6MjY6Ik1pdGFyYmVpdGVyK0UtTWFpbC1Wb3JsYWdlIjtzOjQ3OiJzdGFmZl9kZXRhaWxzX2FkZF9uZXdfYW5kX21hbmFnZV9zdGFmZl9wYXltZW50cyI7czo4NjoiUGVyc29uYWxkZXRhaWxzJTJDK25ldWUrTWl0YXJiZWl0ZXIraGluenVmJUMzJUJDZ2VuK3VuZCtNaXRhcmJlaXRlcnphaGx1bmdlbit2ZXJ3YWx0ZW4iO3M6OToiYWRkX3N0YWZmIjtzOjI0OiJQZXJzb25hbCtoaW56dWYlQzMlQkNnZW4iO3M6Mjc6InN0YWZmX2Jvb2tpbmdzX2FuZF9wYXltZW50cyI7czozNToiTWl0YXJiZWl0ZXIrQnVjaHVuZ2VuK3VuZCtaYWhsdW5nZW4iO3M6MzM6InN0YWZmX2Jvb2tpbmdfZGV0YWlsc19hbmRfcGF5bWVudCI7czozOToiTWl0YXJiZWl0ZXIrQnVjaHVuZ3NkZXRhaWxzK3VuZCtaYWhsdW5nIjtzOjMwOiJzZWxlY3Rfb3B0aW9uX3RvX3Nob3dfYm9va2luZ3MiO3M6NTM6IlclQzMlQTRobGVuK1NpZStkaWUrT3B0aW9uJTJDK3VtK0J1Y2h1bmdlbithbnp1emVpZ2VuIjtzOjE0OiJzZWxlY3Rfc2VydmljZSI7czoyMzoiVyVDMyVBNGhsZW4rU2llK1NlcnZpY2UiO3M6MTA6InN0YWZmX25hbWUiO3M6MTM6IlBlcnNvbmFsK05hbWUiO3M6MTM6InN0YWZmX3BheW1lbnQiO3M6MTU6IlBlcnNvbmFsemFobHVuZyI7czoyODoiYWRkX3BheW1lbnRfdG9fc3RhZmZfYWNjb3VudCI7czo0OToiRiVDMyVCQ2dlbitTaWUrZGVtK01pdGFyYmVpdGVya29udG8rWmFobHVuZytoaW56dSI7czoxNDoiYW1vdW50X3BheWFibGUiO3M6MTk6IitCZXphaGxiYXJlcitCZXRyYWciO3M6MTI6InNhdmVfY2hhbmdlcyI7czoyNjoiKyVDMyU4NG5kZXJ1bmdlbitzcGVpY2hlcm4iO3M6MTg6ImZyb250X2Vycm9yX2xhYmVscyI7czoyMToiRnJvbnQrRXJyb3IrRXRpa2V0dGVuIjtzOjY6InN0cmlwZSI7czo5OiIrU3RyZWlmZW4iO3M6MTQ6ImNoZWNrb3V0X3RpdGxlIjtzOjk6IjJDaGVja291dCI7czoxNzoibmV4bW9fc21zX2dhdGV3YXkiO3M6MTc6Ik5leG1vK1NNUytHYXRld2F5IjtzOjE3OiJuZXhtb19zbXNfc2V0dGluZyI7czoyMToiTmV4bW8rU01TK0VpbnN0ZWxsdW5nIjtzOjEzOiJuZXhtb19hcGlfa2V5IjtzOjI1OiIrTmV4bW8tQVBJLVNjaGwlQzMlQkNzc2VsIjtzOjE2OiJuZXhtb19hcGlfc2VjcmV0IjtzOjE5OiJOZXhtby1BUEktR2VoZWltbmlzIjtzOjEwOiJuZXhtb19mcm9tIjtzOjk6Ik5leG1vK3ZvbiI7czoxMjoibmV4bW9fc3RhdHVzIjtzOjEyOiJOZXhtbytTdGF0dXMiO3M6MzE6Im5leG1vX3NlbmRfc21zX3RvX2NsaWVudF9zdGF0dXMiO3M6Mzc6Ik5leG1vK3NlbmRldCtTTVMrYW4rZGVuK0NsaWVudC1TdGF0dXMiO3M6MzA6Im5leG1vX3NlbmRfc21zX3RvX2FkbWluX3N0YXR1cyI7czozNDoiK05leG1vK1NlbmRlbitTbXMrWnVtK0FkbWluK1N0YXR1cyI7czoyNDoibmV4bW9fYWRtaW5fcGhvbmVfbnVtYmVyIjtzOjI1OiJOZXhtbytBZG1pbitUZWxlZm9ubnVtbWVyIjtzOjk6InNhdmVfMTJfNSI7czoxNjoiMTIlMkM1JTI1K3NwYXJlbiI7czoxNToiZnJvbnRfdG9vbF90aXBzIjtzOjIyOiJWT1JERVJFK1dFUktaRVVHLVRJUFBTIjtzOjIxOiJmcm9udF90b29sX3RpcHNfbG93ZXIiO3M6Mjc6IlRpcHBzK3p1bSt2b3JkZXJlbitXZXJremV1ZyI7czoyMDoidG9vbF90aXBfbXlfYm9va2luZ3MiO3M6MTU6Ik1laW5lK0J1Y2h1bmdlbiI7czoyMDoidG9vbF90aXBfcG9zdGFsX2NvZGUiO3M6MTI6IlBvc3RsZWl0emFobCI7czoxNzoidG9vbF90aXBfc2VydmljZXMiO3M6MTY6IkRpZW5zdGxlaXN0dW5nZW4iO3M6MjI6InRvb2xfdGlwX2V4dHJhX3NlcnZpY2UiO3M6MTM6IkV4dHJhK3NlcnZpY2UiO3M6Mjg6InRvb2xfdGlwX2ZyZXF1ZW50bHlfZGlzY291bnQiO3M6MTg6IkglQzMlQTR1ZmlnK1JhYmF0dCI7czozOToidG9vbF90aXBfd2hlbl93b3VsZF95b3VfbGlrZV91c190b19jb21lIjtzOjQzOiJXYW5uK20lQzMlQjZjaHRlbitTaWUlMkMrZGFzcyt3aXIra29tbWVuJTNGIjtzOjMwOiJ0b29sX3RpcF95b3VyX3BlcnNvbmFsX2RldGFpbHMiO3M6MzE6IkRlaW5lK1BlcnMlQzMlQjZubGljaGVuK0RldGFpbHMiO3M6MjU6InRvb2xfdGlwX2hhdmVfYV9wcm9tb2NvZGUiO3M6Mjc6IitIYWJlbitTaWUrZWluZW4rUHJvbW8tQ29kZSI7czozMzoidG9vbF90aXBfcHJlZmVycmVkX3BheW1lbnRfbWV0aG9kIjtzOjI2OiJCZXZvcnp1Z3RlK1phaGx1bmdzbWV0aG9kZSI7czoxMDoibG9naW5fcGFnZSI7czoxMDoiTG9naW5zZWl0ZSI7czoxMDoiZnJvbnRfcGFnZSI7czoxMDoiVGl0ZWxzZWl0ZSI7czoxNDoiYmVmb3JlX2VfZ18xMDAiO3M6MjY6IlZvcmhlcislMjh6LitCLisxMDArJTI0JTI5IjtzOjEzOiJhZnRlcl9lX2dfMTAwIjtzOjI3OiJOYWNoaGVyKyUyOHouK0IuKzEwMCslMjQlMjkiO3M6NzoidGF4X3ZhdCI7czoyNToiU3RldWVyKyUyRitNZWhyd2VydHN0ZXVlciI7czo5OiJ3cm9uZ191cmwiO3M6MTE6IkZhbHNjaGUrVVJMIjtzOjExOiJjaG9vc2VfZmlsZSI7czoxNzoiRGF0ZWkrdyVDMyVBNGhsZW4iO3M6MTU6ImZyb250ZW5kX2xhYmVscyI7czoxNzoiRGF0ZWkrdyVDMyVBNGhsZW4iO3M6MTI6ImFkbWluX2xhYmVscyI7czoxMjoiQWRtaW4tTGFiZWxzIjtzOjE1OiJkcm9wZG93bl9kZXNpZ24iO3M6MTU6IkRyb3BEb3duLURlc2lnbiI7czoyMzoiYmxvY2tzX2FzX2J1dHRvbl9kZXNpZ24iO3M6Mjk6IkJsJUMzJUI2Y2tlK2FscytCdXR0b24rRGVzaWduIjtzOjE4OiJxdHlfY29udHJvbF9kZXNpZ24iO3M6MjA6Ik1lbmdlK0tvbnRyb2xsZGVzaWduIjtzOjk6ImRyb3Bkb3ducyI7czo5OiJEcm9wRG93bnMiO3M6MTY6ImJpZ19pbWFnZXNfcmFkaW8iO3M6MjM6IkdybyVDMyU5RmUrQmlsZGVyK1JhZGlvIjtzOjY6ImVycm9ycyI7czo2OiJGZWhsZXIiO3M6MTI6ImV4dHJhX2xhYmVscyI7czoyNjoiWnVzJUMzJUE0dHpsaWNoZStFdGlrZXR0ZW4iO3M6MTI6ImFwaV9wYXNzd29yZCI7czoxMjoiQVBJLVBhc3N3b3J0IjtzOjEyOiJhcGlfdXNlcm5hbWUiO3M6MTY6IkFQSS1CZW51dHplcm5hbWUiO3M6MTA6ImFwcGVhcmFuY2UiO3M6ODoiQVVTU0VIRU4iO3M6NjoiYWN0aW9uIjtzOjY6IkFrdGlvbiI7czo3OiJhY3Rpb25zIjtzOjg6IkFrdGlvbmVuIjtzOjk6ImFkZF9icmVhayI7czoyMToiUGF1c2UraGluenVmJUMzJUJDZ2VuIjtzOjEwOiJhZGRfYnJlYWtzIjtzOjI3OiJGJUMzJUJDZ2VuK1NpZStQYXVzZW4raGluenUiO3M6MjA6ImFkZF9jbGVhbmluZ19zZXJ2aWNlIjtzOjMzOiJSZWluaWd1bmdzc2VydmljZStoaW56dWYlQzMlQkNnZW4iO3M6MTA6ImFkZF9tZXRob2QiO3M6MjQ6IitNZXRob2RlK2hpbnp1ZiVDMyVCQ2dlbiI7czo3OiJhZGRfbmV3IjtzOjIwOiJOZXVlK2hpbnp1ZiVDMyVCQ2dlbiI7czoxNToiYWRkX3NhbXBsZV9kYXRhIjtzOjMzOiJIaW56dWYlQzMlQkNnZW4rdm9uK0JlaXNwaWVsZGF0ZW4iO3M6ODoiYWRkX3VuaXQiO3M6MjQ6IitFaW5oZWl0K2hpbnp1ZiVDMyVCQ2dlbiI7czoxODoiYWRkX3lvdXJfb2ZmX3RpbWVzIjtzOjM1OiJGJUMzJUJDZ2VuK1NpZStJaHJlK0F1c3plaXRlbitoaW56dSI7czoxNjoiYWRkX25ld19vZmZfdGltZSI7czoyODoiTmV1ZStBdXN6ZWl0K2hpbnp1ZiVDMyVCQ2dlbiI7czo3OiJhZGRfb25zIjtzOjc6IkFkZC1vbnMiO3M6MTU6ImFkZG9uc19ib29raW5ncyI7czoxNjoiQWRkT25zK0J1Y2h1bmdlbiI7czoyNDoiYWRkb25fc2VydmljZV9mcm9udF92aWV3IjtzOjI3OiJBZGRvbi1TZXJ2aWNlK1ZvcmRlcmFuc2ljaHQiO3M6NjoiYWRkb25zIjtzOjY6IkFkZG9ucyI7czoxODoic2VydmljZV9jb21taXNzaW9uIjtzOjE5OiIrU2VydmljZS1Lb21taXNzaW9uIjtzOjE2OiJjb21taXNzaW9uX3RvdGFsIjtzOjIwOiJLb21taXNzaW9uK2luc2dlc2FtdCI7czo3OiJhZGRyZXNzIjtzOjc6IkFkcmVzc2UiO3M6MjQ6Im5ld19hcHBvaW50bWVudF9hc3NpZ25lZCI7czoyMzoiTmV1ZXIrVGVybWluK3p1Z2V3aWVzZW4iO3M6MjU6ImFkbWluX2VtYWlsX25vdGlmaWNhdGlvbnMiO3M6MzI6IitBZG1pbitFLU1haWwtQmVuYWNocmljaHRpZ3VuZ2VuIjtzOjIwOiJhbGxfcGF5bWVudF9nYXRld2F5cyI7czoyMToiQWxsZStaYWhsdW5nc2dhdGV3YXlzIjtzOjEyOiJhbGxfc2VydmljZXMiO3M6MjE6IkFsbGUrRGllbnN0bGVpc3R1bmdlbiI7czo0MDoiYWxsb3dfbXVsdGlwbGVfYm9va2luZ19mb3Jfc2FtZV90aW1lc2xvdCI7czo1MjoiTWVocmZhY2hidWNodW5nK2YlQzMlQkNyK2RlbnNlbGJlbitUaW1lc2xvdCt6dWxhc3NlbiI7czo2OiJhbW91bnQiO3M6NToiTWVuZ2UiO3M6ODoiYXBwX2RhdGUiO3M6MTA6IkFwcC4rRGF0dW0iO3M6MTk6ImFwcGVhcmFuY2Vfc2V0dGluZ3MiO3M6MjI6IkF1c3NlaGVuK0VpbnN0ZWxsdW5nZW4iO3M6MjE6ImFwcG9pbnRtZW50X2NvbXBsZXRlZCI7czoyMDoiVGVybWluK2FiZ2VzY2hsb3NzZW4iO3M6MTk6ImFwcG9pbnRtZW50X2RldGFpbHMiO3M6MTM6IlRlcm1pbmRldGFpbHMiO3M6Mjk6ImFwcG9pbnRtZW50X21hcmtlZF9hc19ub19zaG93IjtzOjI3OiJUZXJtaW4rYWxzK05vK1Nob3crbWFya2llcnQiO3M6MTU6Im1hcmtfYXNfbm9fc2hvdyI7czoyODoiQWxzK25pY2h0K2FuemVpZ2VuK21hcmtpZXJlbiI7czoyNzoiYXBwb2ludG1lbnRfcmVtaW5kZXJfYnVmZmVyIjtzOjI0OiJUZXJtaW4rRXJpbm5lcnVuZ3NwdWZmZXIiO3M6MjQ6ImFwcG9pbnRtZW50X2F1dG9fY29uZmlybSI7czozNDoiVGVybWluK2F1dG9tYXRpc2NoK2Jlc3QlQzMlQTR0aWdlbiI7czoxMjoiYXBwb2ludG1lbnRzIjtzOjc6IlRlcm1pbmUiO3M6MjM6ImFkbWluX2FyZWFfY29sb3Jfc2NoZW1lIjtzOjI0OiJBZG1pbi1CZXJlaWNoK0ZhcmJzY2hlbWEiO3M6MTc6InRoYW5reW91X3BhZ2VfdXJsIjtzOjE2OiJEYW5rZStTZWl0ZW4tVVJMIjtzOjExOiJhZGRvbl90aXRsZSI7czoxMjoiK0FkZG9uLVRpdGVsIjtzOjExOiJhdmFpbGFiaWx0eSI7czoxODoiVmVyZiVDMyVCQ2diYXJrZWl0IjtzOjE2OiJiYWNrZ3JvdW5kX2NvbG9yIjtzOjE2OiJIaW50ZXJncnVuZGZhcmJlIjtzOjI4OiJiZWhhdmlvdXJfb25fY2xpY2tfb2ZfYnV0dG9uIjtzOjM0OiJWZXJoYWx0ZW4rYmVpK0tsaWNrK2F1ZitkZW4rQnV0dG9uIjtzOjg6ImJvb2tfbm93IjtzOjE3OiIrYnVjaGVuK1NpZStqZXR6dCI7czoyMToiYm9va2luZ19kYXRlX2FuZF90aW1lIjtzOjIzOiJCdWNodW5nc2RhdHVtK3VuZCstemVpdCI7czoxNToiYm9va2luZ19kZXRhaWxzIjtzOjE1OiJCdWNodW5nc2RldGFpbHMiO3M6MTk6ImJvb2tpbmdfaW5mb3JtYXRpb24iO3M6MTk6IkJ1Y2h1bmdzaW5mb3JtYXRpb24iO3M6MTg6ImJvb2tpbmdfc2VydmVfZGF0ZSI7czoxMzoiQnVjaHVuZ3NkYXR1bSI7czoxNDoiYm9va2luZ19zdGF0dXMiO3M6MTQ6IkJ1Y2h1bmdzc3RhdHVzIjtzOjIxOiJib29raW5nX25vdGlmaWNhdGlvbnMiO3M6MjY6IkJ1Y2h1bmdzYmVuYWNocmljaHRpZ3VuZ2VuIjtzOjg6ImJvb2tpbmdzIjtzOjk6IkJ1Y2h1bmdlbiI7czoxNToiYnV0dG9uX3Bvc2l0aW9uIjtzOjE0OiJUYXN0ZW5wb3NpdGlvbiI7czoxMToiYnV0dG9uX3RleHQiO3M6MjI6IlNjaGFsdGZsJUMzJUE0Y2hlbnRleHQiO3M6NzoiY29tcGFueSI7czoxMToiVU5URVJORUhNRU4iO3M6MTc6ImNhbm5vdF9jYW5jZWxfbm93IjtzOjI2OiJLYW5uK2pldHp0K25pY2h0K2FiYnJlY2hlbiI7czoyMToiY2Fubm90X3Jlc2NoZWR1bGVfbm93IjtzOjM2OiIrS2FubitqZXR6dCtuaWNodCtuZXUrZ2VwbGFudCt3ZXJkZW4iO3M6NjoiY2FuY2VsIjtzOjEwOiJTdG9ybmllcmVuIjtzOjI0OiJjYW5jZWxsYXRpb25fYnVmZmVyX3RpbWUiO3M6MjM6IitTdG9ybmllcnVuZ3NwdWZmZXJ6ZWl0IjtzOjE5OiJjYW5jZWxsZWRfYnlfY2xpZW50IjtzOjIwOiJWb20rS3VuZGVuK3N0b3JuaWVydCI7czoyOToiY2FuY2VsbGVkX2J5X3NlcnZpY2VfcHJvdmlkZXIiO3M6Mjc6IlZvbStEaWVuc3RsZWlzdGVyK3N0b3JuaWVydCI7czoxNToiY2hhbmdlX3Bhc3N3b3JkIjtzOjIxOiIrUGFzc3dvcnQrJUMzJUE0bmRlcm4iO3M6MTY6ImNsZWFuaW5nX3NlcnZpY2UiO3M6MTc6IlJlaW5pZ3VuZ3NzZXJ2aWNlIjtzOjY6ImNsaWVudCI7czo3OiIrS2xpZW50IjtzOjI2OiJjbGllbnRfZW1haWxfbm90aWZpY2F0aW9ucyI7czozMzoiK0NsaWVudC1FLU1haWwtQmVuYWNocmljaHRpZ3VuZ2VuIjtzOjExOiJjbGllbnRfbmFtZSI7czoxMToiK0t1bmRlbm5hbWUiO3M6MTI6ImNvbG9yX3NjaGVtZSI7czoxMDoiRmFyYnNjaGVtYSI7czo5OiJjb2xvcl90YWciO3M6MTQ6IkZhcmJtYXJraWVydW5nIjtzOjE1OiJjb21wYW55X2FkZHJlc3MiO3M6NzoiQWRyZXNzZSI7czoxMzoiY29tcGFueV9lbWFpbCI7czo1OiJFbWFpbCI7czoxMjoiY29tcGFueV9sb2dvIjtzOjEwOiJGaXJtZW5sb2dvIjtzOjEyOiJjb21wYW55X25hbWUiO3M6MTg6Ikdlc2NoJUMzJUE0ZnRzbmFtZSI7czoxNjoiY29tcGFueV9zZXR0aW5ncyI7czoyNzoiQnVzaW5lc3MrSW5mbytFaW5zdGVsbHVuZ2VuIjtzOjExOiJjb21wYW55bmFtZSI7czoxNDoiTmFtZStkZXIrRmlybWEiO3M6MjE6ImNvbXBhbnlfaW5mb19zZXR0aW5ncyI7czozMToiVW50ZXJuZWhtZW5zaW5mb3MrRWluc3RlbGx1bmdlbiI7czo5OiJjb21wbGV0ZWQiO3M6MTM6IkFiZ2VzY2hsb3NzZW4iO3M6NzoiY29uZmlybSI7czoxNToiQmVzdCVDMyVBNHRpZ2VuIjtzOjk6ImNvbmZpcm1lZCI7czoxNDoiQmVzdCVDMyVBNHRpZ3QiO3M6MTQ6ImNvbnRhY3Rfc3RhdHVzIjtzOjE0OiIrS29udGFrdHN0YXR1cyI7czo3OiJjb3VudHJ5IjtzOjQ6IkxhbmQiO3M6MTg6ImNvdW50cnlfY29kZV9waG9uZSI7czoyOToiTCVDMyVBNG5kZXJjb2RlKyUyOFRlbGVmb24lMjkiO3M6NjoiY291cG9uIjtzOjY6IkNvdXBvbiI7czoxMToiY291cG9uX2NvZGUiO3M6MTM6Ikd1dHNjaGVpbmNvZGUiO3M6MTI6ImNvdXBvbl9saW1pdCI7czoxNDoiR3V0c2NoZWlubGltaXQiO3M6MTE6ImNvdXBvbl90eXBlIjtzOjE0OiIrR3V0c2NoZWluLVR5cCI7czoxMToiY291cG9uX3VzZWQiO3M6MTk6Ikd1dHNjaGVpbit2ZXJ3ZW5kZXQiO3M6MTI6ImNvdXBvbl92YWx1ZSI7czoxMzoiR3V0c2NoZWlud2VydCI7czoyMDoiY3JlYXRlX2FkZG9uX3NlcnZpY2UiO3M6MzM6IkVyc3RlbGxlbitTaWUrZWluZW4rQWRkb24tU2VydmljZSI7czoxMzoiY3JvcF9hbmRfc2F2ZSI7czoyNToiWnVzY2huZWlkZW4rdW5kK3NwZWljaGVybiI7czo4OiJjdXJyZW5jeSI7czoxMjoiVyVDMyVBNGhydW5nIjtzOjI0OiJjdXJyZW5jeV9zeW1ib2xfcG9zaXRpb24iO3M6Mjc6IlclQzMlQTRocnVuZ3NzeW1ib2xwb3NpdGlvbiI7czo4OiJjdXN0b21lciI7czo2OiIrS3VuZGUiO3M6MjA6ImN1c3RvbWVyX2luZm9ybWF0aW9uIjtzOjE3OiJLdW5kZW5pbmZvcm1hdGlvbiI7czo5OiJjdXN0b21lcnMiO3M6NjoiS3VuZGVuIjtzOjEzOiJkYXRlX2FuZF90aW1lIjtzOjEwOiJUZXJtaW56ZWl0IjtzOjIzOiJkYXRlX3BpY2tlcl9kYXRlX2Zvcm1hdCI7czoyNDoiRGF0ZS1QaWNrZXIrRGF0dW1zZm9ybWF0IjtzOjI1OiJkZWZhdWx0X2Rlc2lnbl9mb3JfYWRkb25zIjtzOjMwOiJTdGFuZGFyZGRlc2lnbitmJUMzJUJDcitBZGRvbnMiO3M6NDY6ImRlZmF1bHRfZGVzaWduX2Zvcl9tZXRob2RzX3dpdGhfbXVsdGlwbGVfdW5pdHMiO3M6NTY6IlN0YW5kYXJkZW50d3VyZitmJUMzJUJDcitNZXRob2RlbittaXQrbWVocmVyZW4rRWluaGVpdGVuIjtzOjI3OiJkZWZhdWx0X2Rlc2lnbl9mb3Jfc2VydmljZXMiO3M6MzI6IlN0YW5kYXJkZW50d3VyZitmJUMzJUJDcitEaWVuc3RlIjtzOjE1OiJkZWZhdWx0X3NldHRpbmciO3M6MTk6IlN0YW5kYXJkZWluc3RlbGx1bmciO3M6NjoiZGVsZXRlIjtzOjEyOiJMJUMzJUI2c2NoZW4iO3M6MTE6ImRlc2NyaXB0aW9uIjtzOjEyOiJCZXNjaHJlaWJ1bmciO3M6ODoiZGlzY291bnQiO3M6NjoiUmFiYXR0IjtzOjE2OiJkb3dubG9hZF9pbnZvaWNlIjtzOjE3OiJEb3dubG9hZCtSZWNobnVuZyI7czoxODoiZW1haWxfbm90aWZpY2F0aW9uIjtzOjIyOiJFTUFJTCtCRU5BQ0hSSUNIVElHVU5HIjtzOjU6ImVtYWlsIjtzOjU6IkVtYWlsIjtzOjE0OiJlbWFpbF9zZXR0aW5ncyI7czoyMDoiK0VtYWlsK0VpbnN0ZWxsdW5nZW4iO3M6MTA6ImVtYmVkX2NvZGUiO3M6MTQ6IkNvZGUrZWluYmV0dGVuIjtzOjc3OiJlbnRlcl95b3VyX2VtYWlsX2FuZF93ZV93aWxsX3NlbmRfeW91X2luc3RydWN0aW9uc19vbl9yZXNldHRpbmdfeW91cl9wYXNzd29yZCI7czoxMDY6IitHZWJlbitTaWUrSWhyZStFLU1haWwtQWRyZXNzZStlaW4rdW5kK3dpcitzZW5kZW4rSWhuZW4rQW53ZWlzdW5nZW4renVtK1p1ciVDMyVCQ2Nrc2V0emVuK0locmVzK1Bhc3N3b3J0cy4iO3M6MTE6ImV4cGlyeV9kYXRlIjtzOjEzOiJWZXJmYWxsc2RhdHVtIjtzOjY6ImV4cG9ydCI7czo2OiJFeHBvcnQiO3M6MTk6ImV4cG9ydF95b3VyX2RldGFpbHMiO3M6Mjc6IitFeHBvcnRpZXJlbitTaWUrSWhyZStEYXRlbiI7czozMjoiZnJlcXVlbnRseV9kaXNjb3VudF9zZXR0aW5nX3RhYnMiO3M6MjM6IkglQzMlODRVRklHK0clQzMlOUNMVElHIjtzOjI2OiJmcmVxdWVudGx5X2Rpc2NvdW50X2hlYWRlciI7czoxODoiSCVDMyVBNHVmaWcrUmFiYXR0IjtzOjE3OiJmaWVsZF9pc19yZXF1aXJlZCI7czoyMToiRmVsZCtpc3QrZXJmb3JkZXJsaWNoIjtzOjk6ImZpbGVfc2l6ZSI7czoyMDoiRGF0ZWlnciVDMyVCNiVDMyU5RmUiO3M6ODoiZmxhdF9mZWUiO3M6MTk6IlBhdXNjaGFsZ2ViJUMzJUJDaHIiO3M6NDoiZmxhdCI7czo0OiJFYmVuIjtzOjEzOiJmcmVxX2Rpc2NvdW50IjtzOjEyOiIrRnJlcS1SYWJhdHQiO3M6MjU6ImZyZXF1ZW50bHlfZGlzY291bnRfbGFiZWwiO3M6MjQ6IkglQzMlQTR1ZmlnK1JhYmF0dC1MYWJlbCI7czoyNDoiZnJlcXVlbnRseV9kaXNjb3VudF90eXBlIjtzOjIxOiJIJUMzJUE0dWZpZytSYWJhdHRhcnQiO3M6MjU6ImZyZXF1ZW50bHlfZGlzY291bnRfdmFsdWUiO3M6MjI6IkglQzMlQTR1ZmlnK1JhYmF0dHdlcnQiO3M6MjI6ImZyb250X3NlcnZpY2VfYm94X3ZpZXciO3M6Mjk6IlZvcmRlcmFuc2ljaHQrZGVyK1NlcnZpY2UrQm94IjtzOjI3OiJmcm9udF9zZXJ2aWNlX2Ryb3Bkb3duX3ZpZXciO3M6MzE6IitGcm9udCtTZXJ2aWNlK0Ryb3Bkb3duLUFuc2ljaHQiO3M6MTg6ImZyb250X3ZpZXdfb3B0aW9ucyI7czoyMToiRnJvbnRhbnNpY2h0K09wdGlvbmVuIjtzOjk6ImZ1bGxfbmFtZSI7czoyMzoiVm9sbHN0JUMzJUE0bmRpZ2VyK05hbWUiO3M6NzoiZ2VuZXJhbCI7czoxMToiQUxMR0VNRUlORVMiO3M6MTY6ImdlbmVyYWxfc2V0dGluZ3MiO3M6MjQ6IkFsbGdlbWVpbmUrRWluc3RlbGx1bmdlbiI7czo1MzoiZ2V0X2VtYmVkX2NvZGVfdG9fc2hvd19ib29raW5nX3dpZGdldF9vbl95b3VyX3dlYnNpdGUiO3M6ODk6IkhvbGVuK1NpZStzaWNoK2RlbitFaW5iZXR0dW5nc2NvZGUlMkMrdW0rZGFzK0J1Y2h1bmdzLVdpZGdldCthdWYrSWhyZXIrV2Vic2l0ZSthbnp1emVpZ2VuIjtzOjIwOiJnZXRfdGhlX2VtYmVkZWRfY29kZSI7czozMDoiRXJoYWx0ZStkZW4rZWluZ2ViZXR0ZXRlbitDb2RlIjtzOjE1OiJndWVzdF9jdXN0b21lcnMiO3M6MTE6Ikdhc3QrS3VuZGVuIjtzOjE5OiJndWVzdF91c2VyX2NoZWNrb3V0IjtzOjIyOiJHYXN0K0JlbnV0emVyK0NoZWNrb3V0IjtzOjM2OiJoaWRlX2ZhZGVkX2FscmVhZHlfYm9va2VkX3RpbWVfc2xvdHMiO3M6NDY6IlZlcmJsYXNzZW4rU2llK2JlcmVpdHMrYXVzZ2VidWNodGUrWmVpdGZlbnN0ZXIiO3M6ODoiaG9zdG5hbWUiO3M6ODoiSG9zdG5hbWUiO3M6NjoibGFiZWxzIjtzOjk6IkVUSUtFVFRFTiI7czo3OiJsZWdlbmRzIjtzOjg6IkxlZ2VuZGVuIjtzOjU6ImxvZ2luIjtzOjk6IkFubWVsZHVuZyI7czoyODoibWF4aW11bV9hZHZhbmNlX2Jvb2tpbmdfdGltZSI7czoyNDoiTWF4aW1hbGUrVm9ydmVya2F1ZnN6ZWl0IjtzOjY6Im1ldGhvZCI7czo3OiJNZXRob2RlIjtzOjExOiJtZXRob2RfbmFtZSI7czoxMjoiTWV0aG9kZW5uYW1lIjtzOjEyOiJtZXRob2RfdGl0bGUiO3M6MTM6Ik1ldGhvZGVudGl0ZWwiO3M6MjA6Im1ldGhvZF91bml0X3F1YW50aXR5IjtzOjIyOiIrTWV0aG9kZStFaW5oZWl0K01lbmdlIjtzOjI1OiJtZXRob2RfdW5pdF9xdWFudGl0eV9yYXRlIjtzOjI3OiIrTWV0aG9kZStFaW5oZWl0K01lbmdlK1JhdGUiO3M6MTc6Im1ldGhvZF91bml0X3RpdGxlIjtzOjI2OiIrVGl0ZWwrZGVyK01ldGhvZGVuZWluaGVpdCI7czoyMzoibWV0aG9kX3VuaXRzX2Zyb250X3ZpZXciO3M6MzI6IitNZXRob2RlK0VpbmhlaXRlbitWb3JkZXJhbnNpY2h0IjtzOjc6Im1ldGhvZHMiO3M6OToiK01ldGhvZGVuIjtzOjE1OiJtZXRob2RzX2Jvb2tpbmciO3M6MTY6Ik1ldGhvZGVuK0J1Y2h1bmciO3M6MTY6Im1ldGhvZHNfYm9va2luZ3MiO3M6MTc6Ik1ldGhvZGVuYnVjaHVuZ2VuIjtzOjI4OiJtaW5pbXVtX2FkdmFuY2VfYm9va2luZ190aW1lIjtzOjIyOiJNaW5kZXN0dm9ydmVya2F1ZnN6ZWl0IjtzOjQ6Im1vcmUiO3M6NToiK01laHIiO3M6MTI6Im1vcmVfZGV0YWlscyI7czoxMjoiTWVocitEZXRhaWxzIjtzOjE1OiJteV9hcHBvaW50bWVudHMiO3M6MTM6Ik1laW5lK1Rlcm1pbmUiO3M6NDoibmFtZSI7czo0OiJOYW1lIjtzOjk6Im5ldF90b3RhbCI7czoxMjoiK05ldHRvK1N1bW1lIjtzOjEyOiJuZXdfcGFzc3dvcmQiO3M6MTU6IitOZXVlcytLZW5ud29ydCI7czo1OiJub3RlcyI7czoxMToiQW5tZXJrdW5nZW4iO3M6ODoib2ZmX2RheXMiO3M6MTE6IitGcmVpZStUYWdlIjtzOjg6Im9mZl90aW1lIjtzOjk6IitGcmVpemVpdCI7czoxMjoib2xkX3Bhc3N3b3JkIjtzOjE0OiJBbHRlcytQYXNzd29ydCI7czoyNzoib25saW5lX2Jvb2tpbmdfYnV0dG9uX3N0eWxlIjtzOjI2OiJPbmxpbmUtQnVjaHVuZytCdXR0b24rU3RpbCI7czoyNToib3Blbl93aWRnZXRfaW5fYV9uZXdfcGFnZSI7czozOToiV2lkZ2V0K2luK2VpbmVyK25ldWVuK1NlaXRlKyVDMyVCNmZmbmVuIjtzOjU6Im9yZGVyIjtzOjc6IkF1ZnRyYWciO3M6MTA6Im9yZGVyX2RhdGUiO3M6MTM6IkF1ZnRyYWdzZGF0dW0iO3M6MTA6Im9yZGVyX3RpbWUiO3M6MTY6IkJlc3RlbGx6ZWl0cHVua3QiO3M6MTY6InBheW1lbnRzX3NldHRpbmciO3M6NzoiWkFITFVORyI7czo5OiJwcm9tb2NvZGUiO3M6MTM6IkdVVFNDSEVJTkNPREUiO3M6MTY6InByb21vY29kZV9oZWFkZXIiO3M6MTM6Ikd1dHNjaGVpbmNvZGUiO3M6MTk6InBhZGRpbmdfdGltZV9iZWZvcmUiO3M6MjI6IlBvbHN0ZXJ1bmdzemVpdCt2b3JoZXIiO3M6NzoicGFya2luZyI7czo2OiJQYXJrZW4iO3M6MTQ6InBhcnRpYWxfYW1vdW50IjtzOjEwOiJUZWlsYmV0cmFnIjtzOjE1OiJwYXJ0aWFsX2RlcG9zaXQiO3M6MTI6IitUZWlsa2F1dGlvbiI7czoyMjoicGFydGlhbF9kZXBvc2l0X2Ftb3VudCI7czoxMDoiVGVpbGJldHJhZyI7czoyMzoicGFydGlhbF9kZXBvc2l0X21lc3NhZ2UiO3M6MjU6IitUZWlsZWluemFobHVuZ3NuYWNocmljaHQiO3M6ODoicGFzc3dvcmQiO3M6ODoiUGFzc3dvcnQiO3M6NzoicGF5bWVudCI7czo3OiJaYWhsdW5nIjtzOjEyOiJwYXltZW50X2RhdGUiO3M6MTM6IlphaGx1bmdzZGF0dW0iO3M6MTY6InBheW1lbnRfZ2F0ZXdheXMiO3M6MTY6IlphaGx1bmdzZ2F0ZXdheXMiO3M6MTQ6InBheW1lbnRfbWV0aG9kIjtzOjE1OiJCZXphaGx2ZXJmYWhyZW4iO3M6ODoicGF5bWVudHMiO3M6OToiWmFobHVuZ2VuIjtzOjI0OiJwYXltZW50c19oaXN0b3J5X2RldGFpbHMiO3M6Mjg6IkRldGFpbHMrenVyK1phaGx1bmdzaGlzdG9yaWUiO3M6MjM6InBheXBhbF9leHByZXNzX2NoZWNrb3V0IjtzOjI0OiIrUGF5UGFsK0V4cHJlc3MrQ2hlY2tvdXQiO3M6MjA6InBheXBhbF9ndWVzdF9wYXltZW50IjtzOjI0OiJQYXlwYWwrRyVDMyVBNHN0ZXphaGx1bmciO3M6NzoicGVuZGluZyI7czoxMDoiK3N0ZWh0K2F1cyI7czoxMDoicGVyY2VudGFnZSI7czoxMToiUHJvemVudHNhdHoiO3M6MjA6InBlcnNvbmFsX2luZm9ybWF0aW9uIjtzOjI0OiJQZXJzJUMzJUI2bmxpY2hlK0FuZ2FiZW4iO3M6NToicGhvbmUiO3M6NzoiVGVsZWZvbiI7czo0ODoicGxlYXNlX2NvcHlfYWJvdmVfY29kZV9hbmRfcGFzdGVfaW5feW91cl93ZWJzaXRlIjtzOjczOiIrS29waWVyZW4rU2llK2RlbitvYmlnZW4rQ29kZSt1bmQrZiVDMyVCQ2dlbitTaWUraWhuK2luK0locmUrV2Vic2l0ZStlaW4uIjtzOjI5OiJwbGVhc2VfZW5hYmxlX3BheW1lbnRfZ2F0ZXdheSI7czo0MDoiQml0dGUrYWt0aXZpZXJlbitTaWUrZGFzK1phaGx1bmdzZ2F0ZXdheSI7czoyMzoicGxlYXNlX3NldF9iZWxvd192YWx1ZXMiO3M6NDA6IkJpdHRlK2xlZ2VuK1NpZStkaWUrZm9sZ2VuZGVuK1dlcnRlK2Zlc3QiO3M6NDoicG9ydCI7czo1OiJIYWZlbiI7czoxMjoicG9zdGFsX2NvZGVzIjtzOjE0OiJQb3N0bGVpdHphaGxlbiI7czo1OiJwcmljZSI7czo1OiJQcmVpcyI7czoyNDoicHJpY2VfY2FsY3VsYXRpb25fbWV0aG9kIjtzOjIzOiJQcmVpc2JlcmVjaG51bmdzbWV0aG9kZSI7czoyNzoicHJpY2VfZm9ybWF0X2RlY2ltYWxfcGxhY2VzIjtzOjExOiJQcmVpc2Zvcm1hdCI7czo3OiJwcmljaW5nIjtzOjE1OiJQcmVpc2dlc3RhbHR1bmciO3M6MTM6InByaW1hcnlfY29sb3IiO3M6MTY6IlByaW0lQzMlQTRyZmFyYmUiO3M6MTk6InByaXZhY3lfcG9saWN5X2xpbmsiO3M6MTc6IitEYXRlbnNjaHV0ei1MaW5rIjtzOjc6InByb2ZpbGUiO3M6NjoiUHJvZmlsIjtzOjEwOiJwcm9tb2NvZGVzIjtzOjEwOiJQcm9tb2NvZGVzIjtzOjE1OiJwcm9tb2NvZGVzX2xpc3QiO3M6MTY6IlByb21vY29kZXMrTGlzdGUiO3M6MjA6InJlZ2lzdGVyZWRfY3VzdG9tZXJzIjtzOjE5OiJSZWdpc3RyaWVydGUrS3VuZGVuIjtzOjI5OiJyZWdpc3RlcmVkX2N1c3RvbWVyc19ib29raW5ncyI7czoyOToiUmVnaXN0cmllcnRlK0t1bmRlbitCdWNodW5nZW4iO3M6NjoicmVqZWN0IjtzOjg6IkFibGVobmVuIjtzOjg6InJlamVjdGVkIjtzOjk6IkFiZ2VsZWhudCI7czoxMToicmVtZW1iZXJfbWUiO3M6MjE6IkVyaW5uZXJlK2RpY2grYW4rbWljaCI7czoxODoicmVtb3ZlX3NhbXBsZV9kYXRhIjtzOjI4OiIrRW50ZmVybmVuK1NpZStCZWlzcGllbGRhdGVuIjtzOjEwOiJyZXNjaGVkdWxlIjtzOjEwOiJOZXUrcGxhbmVuIjtzOjU6InJlc2V0IjtzOjE3OiJadXIlQzMlQkNja3NldHplbiI7czoxNDoicmVzZXRfcGFzc3dvcmQiO3M6Mjc6IitQYXNzd29ydCt6dXIlQzMlQkNja3NldHplbiI7czoyMToicmVzaGVkdWxlX2J1ZmZlcl90aW1lIjtzOjIxOiJSZXNoZWR1bGUrQnVmZmVyK1RpbWUiO3M6MTk6InJldHlwZV9uZXdfcGFzc3dvcmQiO3M6MzE6IkdlYmVuK1NpZStkYXMrbmV1ZStQYXNzd29ydCtlaW4iO3M6MjI6InJpZ2h0X3NpZGVfZGVzY3JpcHRpb24iO3M6NDA6IkJ1Y2h1bmdzc2VpdGUrcmVjaHRzc2VpdGlnZStCZXNjaHJlaWJ1bmciO3M6NDoic2F2ZSI7czo2OiJzcGFyZW4iO3M6MTc6InNhdmVfYXZhaWxhYmlsaXR5IjtzOjI5OiIrVmVyZiVDMyVCQ2diYXJrZWl0K3NwZWljaGVybiI7czoxMjoic2F2ZV9zZXR0aW5nIjtzOjE5OiJFaW5zdGVsbHVuZytzaWNoZXJuIjtzOjE5OiJzYXZlX2xhYmVsc19zZXR0aW5nIjtzOjMyOiJFdGlrZXR0ZW5laW5zdGVsbHVuZ2VuK3NwZWljaGVybiI7czo4OiJzY2hlZHVsZSI7czo4OiJaZWl0cGxhbiI7czoxMzoic2NoZWR1bGVfdHlwZSI7czoxMjoiWmVpdHBsYW4tVHlwIjtzOjE1OiJzZWNvbmRhcnlfY29sb3IiO3M6MjA6IlNla3VuZCVDMyVBNHJlK0ZhcmJlIjtzOjI2OiJzZWxlY3RfbGFuZ3VhZ2VfZm9yX3VwZGF0ZSI7czo1MToiVyVDMyVBNGhsZW4rU2llK1NwcmFjaGUrZiVDMyVCQ3IrZGllK0FrdHVhbGlzaWVydW5nIjtzOjMxOiJzZWxlY3RfbGFuZ3VhZ2VfdG9fY2hhbmdlX2xhYmVsIjtzOjYwOiJXJUMzJUE0aGxlbitTaWUrZGllK1NwcmFjaGUlMkMrdW0rZGFzK0V0aWtldHQrenUrJUMzJUE0bmRlcm4iO3M6MjY6InNlbGVjdF9sYW5ndWFnZV90b19kaXNwbGF5IjtzOjc6IlNwcmFjaGUiO3M6MzM6ImRpc3BsYXlfc3ViX2hlYWRlcnNfYmVsb3dfaGVhZGVycyI7czo0MToiVW50ZXIlQzMlQkNiZXJzY2hyaWZ0ZW4rYXVmK0J1Y2h1bmdzc2VpdGUiO3M6MzY6InNlbGVjdF9wYXltZW50X29wdGlvbl9leHBvcnRfZGV0YWlscyI7czo1OToiVyVDMyVBNGhsZW4rU2llK0V4cG9ydGRldGFpbHMrZiVDMyVCQ3IrWmFobHVuZ3NvcHRpb25lbithdXMiO3M6OToic2VuZF9tYWlsIjtzOjE0OiIrRS1NYWlsK3NlbmRlbiI7czo0MDoic2VuZGVyX2VtYWlsX2FkZHJlc3NfY2xlYW50b19hZG1pbl9lbWFpbCI7czoxNToiQWJzZW5kZXIrRS1NYWlsIjtzOjExOiJzZW5kZXJfbmFtZSI7czo4OiJBYnNlbmRlciI7czo3OiJzZXJ2aWNlIjtzOjk6IkJlZGllbnVuZyI7czozMjoic2VydmljZV9hZGRfb25zX2Zyb250X2Jsb2NrX3ZpZXciO3M6MzM6IlNlcnZpY2UtQWRkLW9ucytGcm9udGJsb2NrYW5zaWNodCI7czo0NDoic2VydmljZV9hZGRfb25zX2Zyb250X2luY3JlYXNlX2RlY3JlYXNlX3ZpZXciO3M6NjY6IlNlcnZpY2UrQWRkLW9ucytGcm9udCtBbnNpY2h0K3ZlcmdyJUMzJUI2JUMzJTlGZXJuKyUyRit2ZXJrbGVpbmVybiI7czoxOToic2VydmljZV9kZXNjcmlwdGlvbiI7czoyMToiTGVpc3R1bmdzYmVzY2hyZWlidW5nIjtzOjE4OiJzZXJ2aWNlX2Zyb250X3ZpZXciO3M6MjI6IitTZXJ2aWNlK1ZvcmRlcmFuc2ljaHQiO3M6MTM6InNlcnZpY2VfaW1hZ2UiO3M6MTI6IlNlcnZpY2UrQmlsZCI7czoxNToic2VydmljZV9tZXRob2RzIjtzOjE1OiJTZXJ2aWNlbWV0aG9kZW4iO3M6MjY6InNlcnZpY2VfcGFkZGluZ190aW1lX2FmdGVyIjtzOjI5OiJTZXJ2aWNlLUF1ZmYlQzMlQkNsbHplaXQrbmFjaCI7czoxODoicGFkZGluZ190aW1lX2FmdGVyIjtzOjE2OiJQb2xzdGVyemVpdCtuYWNoIjtzOjI3OiJzZXJ2aWNlX3BhZGRpbmdfdGltZV9iZWZvcmUiO3M6MzE6IlNlcnZpY2UtUG9sc3RlcnVuZ3MtWmVpdCt2b3JoZXIiO3M6MTY6InNlcnZpY2VfcXVhbnRpdHkiO3M6MTM6IlNlcnZpY2UrTWVuZ2UiO3M6MTI6InNlcnZpY2VfcmF0ZSI7czoxMjoiU2VydmljZS1SYXRlIjtzOjEzOiJzZXJ2aWNlX3RpdGxlIjtzOjEzOiJTZXJ2aWNlLVRpdGVsIjtzOjE4OiJzZXJ2aWNlYWRkb25zX25hbWUiO3M6MTk6IitTZXJ2aWNlQWRkT25zK05hbWUiO3M6ODoic2VydmljZXMiO3M6MTY6IkRpZW5zdGxlaXN0dW5nZW4iO3M6MjA6InNlcnZpY2VzX2luZm9ybWF0aW9uIjtzOjMzOiJJbmZvcm1hdGlvbmVuK3p1K0RpZW5zdGxlaXN0dW5nZW4iO3M6MjU6InNldF9lbWFpbF9yZW1pbmRlcl9idWZmZXIiO3M6NDM6IkxlZ2VuK1NpZStkZW4rRS1NYWlsLUVyaW5uZXJ1bmdzcHVmZmVyK2Zlc3QiO3M6MTI6InNldF9sYW5ndWFnZSI7czoxODoiU3ByYWNoZStlaW5zdGVsbGVuIjtzOjg6InNldHRpbmdzIjtzOjE3OiJkaWUrRWluc3RlbGx1bmdlbiI7czoxNzoic2hvd19hbGxfYm9va2luZ3MiO3M6MjM6IkFsbGUrQnVjaHVuZ2VuK2FuemVpZ2VuIjtzOjM3OiJzaG93X2J1dHRvbl9vbl9naXZlbl9lbWJlZGVkX3Bvc2l0aW9uIjtzOjc1OiJaZWlnZW4rU2llK2RpZStTY2hhbHRmbCVDMyVBNGNoZSthdWYrZGVyK2FuZ2VnZWJlbmVuK2VpbmdlYmV0dGV0ZW4rUG9zaXRpb24iO3M6MzA6InNob3dfY291cG9uc19pbnB1dF9vbl9jaGVja291dCI7czo0MDoiR3V0c2NoZWluZWluZ2FiZW4rYmVpbStDaGVja291dCthbnplaWdlbiI7czoyMjoic2hvd19vbl9hX2J1dHRvbl9jbGljayI7czozNDoiWmVpZ2VuK1NpZSthdWYrZWluZW4rS25vcGYra2xpY2tlbiI7czoxNzoic2hvd19vbl9wYWdlX2xvYWQiO3M6MzA6IitCZWltK0xhZGVuK2RlcitTZWl0ZSthbnplaWdlbiI7czo5OiJzaWduYXR1cmUiO3M6MTI6IlVudGVyc2NocmlmdCI7czoyOToic29ycnlfd3JvbmdfZW1haWxfb3JfcGFzc3dvcmQiO3M6Mzc6IlNvcnJ5JTJDK2ZhbHNjaGUrRS1NYWlsK29kZXIrUGFzc3dvcnQiO3M6MTA6InN0YXJ0X2RhdGUiO3M6MTI6IkFuZmFuZ3NkYXR1bSI7czo2OiJzdGF0dXMiO3M6NjoiU3RhdHVzIjtzOjY6InN1Ym1pdCI7czoxMDoiZWlucmVpY2hlbiI7czoyNDoic3RhZmZfZW1haWxfbm90aWZpY2F0aW9uIjtzOjM1OiJNaXRhcmJlaXRlcitFLU1haWwtQmVuYWNocmljaHRpZ3VuZyI7czozOiJ0YXgiO3M6NDoiTXdTdCI7czo5OiJ0ZXN0X21vZGUiO3M6OToiVGVzdG1vZHVzIjtzOjEwOiJ0ZXh0X2NvbG9yIjtzOjk6IlRleHRmYXJiZSI7czoxNjoidGV4dF9jb2xvcl9vbl9iZyI7czoxNjoiVGV4dGZhcmJlK2F1ZitiZyI7czoyNDoidGVybXNfYW5kX2NvbmRpdGlvbl9saW5rIjtzOjI0OiJOdXR6dW5nc2JlZGluZ3VuZ2VuK0xpbmsiO3M6MTY6InRoaXNfd2Vla19icmVha3MiO3M6MTg6IkRpZXNlK1dvY2hlK2JyaWNodCI7czoyNToidGhpc193ZWVrX3RpbWVfc2NoZWR1bGluZyI7czoyMzoiRGllc2UrV29jaGVuemVpdHBsYW51bmciO3M6MTE6InRpbWVfZm9ybWF0IjtzOjEwOiJaZWl0Zm9ybWF0IjtzOjEzOiJ0aW1lX2ludGVydmFsIjtzOjEzOiJaZWl0aW50ZXJ2YWxsIjtzOjg6InRpbWV6b25lIjtzOjg6IlplaXR6b25lIjtzOjU6InVuaXRzIjtzOjk6IkVpbmhlaXRlbiI7czo5OiJ1bml0X25hbWUiO3M6MTM6IkVpbmhlaXRlbm5hbWUiO3M6MTY6InVuaXRzX29mX21ldGhvZHMiO3M6MjI6IkVpbmhlaXRlbit2b24rTWV0aG9kZW4iO3M6NjoidXBkYXRlIjtzOjEzOiJBa3R1YWxpc2llcmVuIjtzOjE4OiJ1cGRhdGVfYXBwb2ludG1lbnQiO3M6MjA6IlRlcm1pbitha3R1YWxpc2llcmVuIjtzOjE2OiJ1cGRhdGVfcHJvbW9jb2RlIjtzOjIzOiJQcm9tb2NvZGUrYWt0dWFsaXNpZXJlbiI7czo4OiJ1c2VybmFtZSI7czoxMDoiTnV0emVybmFtZSI7czoxNDoidmFjY3VtX2NsZWFuZXIiO3M6MTE6IlN0YXVic2F1Z2VyIjtzOjEzOiJ2aWV3X3Nsb3RzX2J5IjtzOjIyOiJTbG90cythbnplaWdlbituYWNoJTNGIjtzOjQ6IndlZWsiO3M6NToiV29jaGUiO3M6MTE6IndlZWtfYnJlYWtzIjtzOjEyOiJXb2NoZW5wYXVzZW4iO3M6MjA6IndlZWtfdGltZV9zY2hlZHVsaW5nIjtzOjE3OiJXb2NoZW56ZWl0cGxhbnVuZyI7czoyMDoid2lkZ2V0X2xvYWRpbmdfc3R5bGUiO3M6MTQ6IldpZGdldCtMYWRlYXJ0IjtzOjM6InppcCI7czoxMjoiUG9zdGxlaXR6YWhsIjtzOjY6ImxvZ291dCI7czo5OiJBdXNsb2dnZW4iO3M6MjoidG8iO3M6MjoienUiO3M6MTc6ImFkZF9uZXdfcHJvbW9jb2RlIjtzOjMxOiJOZXVlbitQcm9tb2NvZGUraGluenVmJUMzJUJDZ2VuIjtzOjY6ImNyZWF0ZSI7czo5OiJFcnN0ZWxsZW4iO3M6ODoiZW5kX2RhdGUiO3M6OToiRW5kdGVybWluIjtzOjg6ImVuZF90aW1lIjtzOjc6IkVuZHplaXQiO3M6MTU6ImxhYmVsc19zZXR0aW5ncyI7czoyMjoiRXRpa2V0dGVuZWluc3RlbGx1bmdlbiI7czo1OiJsaW1pdCI7czo2OiJHcmVuemUiO3M6OToibWF4X2xpbWl0IjtzOjE3OiJIJUMzJUI2Y2hzdGdyZW56ZSI7czoxMDoic3RhcnRfdGltZSI7czo5OiJTdGFydHplaXQiO3M6NToidmFsdWUiO3M6NDoiV2VydCI7czo2OiJhY3RpdmUiO3M6NToiQWt0aXYiO3M6MjU6ImFwcG9pbnRtZW50X3JlamVjdF9yZWFzb24iO3M6MjI6IlRlcm1pbitBYmxlaG51bmcrR3J1bmQiO3M6Njoic2VhcmNoIjtzOjU6IlN1Y2hlIjtzOjI0OiJjdXN0b21fdGhhbmt5b3VfcGFnZV91cmwiO3M6MzQ6IkJlbnV0emVyZGVmaW5pZXJ0ZStEYW5rZStTZWl0ZStVcmwiO3M6MTQ6InByaWNlX3Blcl91bml0IjtzOjE3OiJQcmVpcytwcm8rRWluaGVpdCI7czoxOToiY29uZmlybV9hcHBvaW50bWVudCI7czozMDoiQmVzdCVDMyVBNHRpZ2VuK1NpZStkZW4rVGVybWluIjtzOjEzOiJyZWplY3RfcmVhc29uIjtzOjE1OiJBYmxlaG51bmdzZ3J1bmQiO3M6MjM6ImRlbGV0ZV90aGlzX2FwcG9pbnRtZW50IjtzOjMwOiJMJUMzJUI2c2NoZW4rU2llK2RpZXNlbitUZXJtaW4iO3M6MTk6ImNsb3NlX25vdGlmaWNhdGlvbnMiO3M6MzM6IkJlbmFjaHJpY2h0aWd1bmdlbitzY2hsaWUlQzMlOUZlbiI7czoyMToiYm9va2luZ19jYW5jZWxfcmVhc29uIjtzOjI0OiJCdWNodW5nK0dydW5kK3N0b3JuaWVyZW4iO3M6MTk6InNlcnZpY2VfY29sb3JfYmFkZ2UiO3M6MjQ6IkJ1Y2h1bmcrR3J1bmQrc3Rvcm5pZXJlbiI7czozMjoibWFuYWdlX3ByaWNlX2NhbGN1bGF0aW9uX21ldGhvZHMiO3M6MzI6Ik1hbmFnZStwcmljZStjYWxjdWxhdGlvbittZXRob2RzIjtzOjI5OiJtYW5hZ2VfYWRkb25zX29mX3RoaXNfc2VydmljZSI7czozNzoiVmVyd2FsdGVuK1NpZStBZGQtT25zK2RpZXNlcytEaWVuc3RlcyI7czoxNzoic2VydmljZV9pc19ib29rZWQiO3M6MjM6IkRlcitTZXJ2aWNlK2lzdCtnZWJ1Y2h0IjtzOjE5OiJkZWxldGVfdGhpc19zZXJ2aWNlIjtzOjMwOiJMJUMzJUI2c2NoZW4rU2llK2RpZXNlbitEaWVuc3QiO3M6MTQ6ImRlbGV0ZV9zZXJ2aWNlIjtzOjE5OiJEaWVuc3QrbCVDMyVCNnNjaGVuIjtzOjEyOiJyZW1vdmVfaW1hZ2UiO3M6MTM6IkVudGZlcm5lK0JpbGQiO3M6MjA6InJlbW92ZV9zZXJ2aWNlX2ltYWdlIjtzOjI5OiJFbnRmZXJuZW4rU2llK2RhcytTZXJ2aWNlYmlsZCI7czo0MDoiY29tcGFueV9uYW1lX2lzX3VzZWRfZm9yX2ludm9pY2VfcHVycG9zZSI7czo0OToiRGVyK0Zpcm1lbm5hbWUrd2lyZCt6dStSZWNobnVuZ3N6d2Vja2VuK3ZlcndlbmRldCI7czoxOToicmVtb3ZlX2NvbXBhbnlfbG9nbyI7czoyODoiRW50ZmVybmVuK1NpZStkYXMrRmlybWVubG9nbyI7czo4MDoidGltZV9pbnRlcnZhbF9pc19oZWxwZnVsX3RvX3Nob3dfdGltZV9kaWZmZXJlbmNlX2JldHdlZW5fYXZhaWxhYmlsaXR5X3RpbWVfc2xvdHMiO3M6MTEzOiJEYXMrWmVpdGludGVydmFsbCtpc3QraGlsZnJlaWNoJTJDK3VtK2RlbitaZWl0dW50ZXJzY2hpZWQrendpc2NoZW4rZGVuK1ZlcmYlQzMlQkNnYmFya2VpdHN6ZWl0ZmVuc3Rlcm4rYW56dXplaWdlbiI7czoxMzE6Im1pbmltdW1fYWR2YW5jZV9ib29raW5nX3RpbWVfcmVzdHJpY3RfY2xpZW50X3RvX2Jvb2tfbGFzdF9taW51dGVfYm9va2luZ19zb190aGF0X3lvdV9zaG91bGRfaGF2ZV9zdWZmaWNpZW50X3RpbWVfYmVmb3JlX2FwcG9pbnRtZW50IjtzOjE0ODoiTWluZGVzdHZvcmxhdWZ6ZWl0K2Jlc2NociVDMyVBNG5rdCtkZW4rS3VuZGVuK2F1ZitkaWUrQnVjaHVuZyt2b24rTGFzdC1NaW51dGUtQnVjaHVuZ2VuJTJDK3NvK2Rhc3MrU2llK2F1c3JlaWNoZW5kK1plaXQrdm9yK2RlbStUZXJtaW4raGFiZW4rc29sbHRlbiI7czo5NDoiY2FuY2VsbGF0aW9uX2J1ZmZlcl9oZWxwc19zZXJ2aWNlX3Byb3ZpZGVyc190b19hdm9pZF9sYXN0X21pbnV0ZV9jYW5jZWxsYXRpb25fYnlfdGhlaXJfY2xpZW50cyI7czoxMDQ6IkRlcitTdG9ybmllcnVuZ3NwdWZmZXIraGlsZnQrRGllbnN0YW5iaWV0ZXJuJTJDK0xhc3QtTWludXRlLVN0b3JuaWVydW5nZW4rZHVyY2graWhyZStLdW5kZW4renUrdmVybWVpZGVuIjtzOjEyODoicGFydGlhbF9wYXltZW50X29wdGlvbl93aWxsX2hlbHBfeW91X3RvX2NoYXJnZV9wYXJ0aWFsX3BheW1lbnRfb2ZfdG90YWxfYW1vdW50X2Zyb21fY2xpZW50X2FuZF9yZW1haW5pbmdfeW91X2Nhbl9jb2xsZWN0X2xvY2FsbHkiO3M6MTM0OiJEaWUrVGVpbHphaGx1bmdzb3B0aW9uK2hpbGZ0K0lobmVuJTJDK2RpZStUZWlsemFobHVuZytkZXMrR2VzYW10YmV0cmFncyt2b20rS3VuZGVuK3p1K2JlcmVjaG5lbiUyQytkaWUrU2llK3ZvcitPcnQrc2FtbWVsbitrJUMzJUI2bm5lbiI7czoxNDI6ImFsbG93X211bHRpcGxlX2FwcG9pbnRtZW50X2Jvb2tpbmdfYXRfc2FtZV90aW1lX3Nsb3Rfd2lsbF9hbGxvd195b3VfdG9fc2hvd19hdmFpbGFiaWxpdHlfdGltZV9zbG90X2V2ZW5feW91X2hhdmVfYm9va2luZ19hbHJlYWR5X2Zvcl90aGF0X3RpbWUiO3M6MTg5OiJFcmxhdWJlbitTaWUrbWVocmVyZStUZXJtaW5idWNodW5nZW4rYXVmK2RlbXNlbGJlbitaZWl0ZmVuc3RlciUyQytzbytrJUMzJUI2bm5lbitTaWUrZGFzK1ZlcmYlQzMlQkNnYmFya2VpdHN6ZWl0ZmVuc3RlcithbnplaWdlbiUyQytzZWxic3Qrd2VubitTaWUrYmVyZWl0cytmJUMzJUJDcitkaWVzZStaZWl0K2dlYnVjaHQraGFiZW4iO3M6ODM6IndpdGhfRW5hYmxlX29mX3RoaXNfZmVhdHVyZV9BcHBvaW50bWVudF9yZXF1ZXN0X2Zyb21fY2xpZW50c193aWxsX2JlX2F1dG9fY29uZmlybWVkIjtzOjkxOiJNaXQrQWt0aXZpZXJlbitkaWVzZXIrRnVua3Rpb24rd2lyZCtkaWUrVGVybWluYW5mcmFnZSt2b24rS3VuZGVuK2F1dG9tYXRpc2NoK2Jlc3QlQzMlQTR0aWd0IjtzOjQwOiJ3cml0ZV9odG1sX2NvZGVfZm9yX3RoZV9yaWdodF9zaWRlX3BhbmVsIjtzOjU0OiJTY2hyZWliZW4rU2llK0hUTUwtQ29kZStmJUMzJUJDcitkYXMrcmVjaHRlK1NlaXRlbmZlbGQiO3M6NDg6ImRvX3lvdV93YW50X3RvX3Nob3dfc3ViaGVhZGVyc19iZWxvd190aGVfaGVhZGVycyI7czo4NToiTSVDMyVCNmNodGVuK1NpZStVbnRlciVDMyVCQ2JlcnNjaHJpZnRlbit1bnRlcmhhbGIrZGVyKyVDMyU5Q2JlcnNjaHJpZnRlbithbnplaWdlbiUzRiI7czo0NzoieW91X2Nhbl9zaG93X2hpZGVfY291cG9uX2lucHV0X29uX2NoZWNrb3V0X2Zvcm0iO3M6ODU6Ik0lQzMlQjZjaHRlbitTaWUrVW50ZXIlQzMlQkNiZXJzY2hyaWZ0ZW4rdW50ZXJoYWxiK2RlcislQzMlOUNiZXJzY2hyaWZ0ZW4rYW56ZWlnZW4lM0YiO3M6ODI6IndpdGhfdGhpc19mZWF0dXJlX3lvdV9jYW5fYWxsb3dfYV92aXNpdG9yX3RvX2Jvb2tfYXBwb2ludG1lbnRfd2l0aG91dF9yZWdpc3RyYXRpb24iO3M6MTA0OiJNaXQrZGllc2VyK0Z1bmt0aW9uK2slQzMlQjZubmVuK1NpZStlaW5lbStCZXN1Y2hlcitlcmxhdWJlbiUyQytlaW5lbitUZXJtaW4rb2huZStSZWdpc3RyaWVydW5nK3p1K2J1Y2hlbiI7czo2ODoicGF5cGFsX2FwaV91c2VybmFtZV9jYW5fZ2V0X2Vhc2lseV9mcm9tX2RldmVsb3Blcl9wYXlwYWxfY29tX2FjY291bnQiO3M6NzU6IlBheXBhbCtBUEkrQmVudXR6ZXJuYW1lK2thbm4rbGVpY2h0K3ZvbitkZXZlbG9wZXIucGF5cGFsLmNvbStLb250bytlcmhhbHRlbiI7czo2ODoicGF5cGFsX2FwaV9wYXNzd29yZF9jYW5fZ2V0X2Vhc2lseV9mcm9tX2RldmVsb3Blcl9wYXlwYWxfY29tX2FjY291bnQiO3M6NzM6IlBheXBhbCtBUEkrUGFzc3dvcnQra2FubitsZWljaHQrdm9uK2RldmVsb3Blci5wYXlwYWwuY29tK2FjY291bnQrYmVrb21tZW4iO3M6Njk6InBheXBhbF9hcGlfc2lnbmF0dXJlX2Nhbl9nZXRfZWFzaWx5X2Zyb21fZGV2ZWxvcGVyX3BheXBhbF9jb21fYWNjb3VudCI7czo4NDoiRGllK1BheXBhbC1BUEktU2lnbmF0dXIra2FubitlaW5mYWNoK3ZvbStkZXZlbG9wZXIucGF5cGFsLmNvbS1Lb250bythYmdlcnVmZW4rd2VyZGVuIjtzOjYyOiJsZXRfdXNlcl9wYXlfdGhyb3VnaF9jcmVkaXRfY2FyZF93aXRob3V0X2hhdmluZ19wYXlwYWxfYWNjb3VudCI7czo3NjoiTGFzc2VuK1NpZStkZW4rQmVudXR6ZXIrbWl0K0tyZWRpdGthcnRlK3phaGxlbiUyQytvaG5lK1BheXBhbC1Lb250byt6dStoYWJlbiI7czo1OToieW91X2Nhbl9lbmFibGVfcGF5cGFsX3Rlc3RfbW9kZV9mb3Jfc2FuZGJveF9hY2NvdW50X3Rlc3RpbmciO3M6ODY6IlNpZStrJUMzJUI2bm5lbitkZW4rUGF5cGFsLVRlc3Rtb2R1cytmJUMzJUJDcitkYXMrVGVzdGVuK3ZvbitTYW5kYm94LUtvbnRlbitha3RpdmllcmVuIjtzOjY2OiJ5b3VfY2FuX2VuYWJsZV9hdXRob3JpemVfbmV0X3Rlc3RfbW9kZV9mb3Jfc2FuZGJveF9hY2NvdW50X3Rlc3RpbmciO3M6ODY6IlNpZStrJUMzJUI2bm5lbitkZW4rUGF5cGFsLVRlc3Rtb2R1cytmJUMzJUJDcitkYXMrVGVzdGVuK3ZvbitTYW5kYm94LUtvbnRlbitha3RpdmllcmVuIjtzOjE2OiJlZGl0X2NvdXBvbl9jb2RlIjtzOjI0OiJHdXRzY2hlaW5jb2RlK2JlYXJiZWl0ZW4iO3M6MTY6ImRlbGV0ZV9wcm9tb2NvZGUiO3M6MjU6IlByb21vY29kZStsJUMzJUI2c2NoZW4lM0YiO3M6MzY6ImNvdXBvbl9jb2RlX3dpbGxfd29ya19mb3Jfc3VjaF9saW1pdCI7czo2MzoiRGVyK0d1dHNjaGVpbmNvZGUrd2lyZCtmJUMzJUJDcitlaW4rc29sY2hlcytMaW1pdCtmdW5rdGlvbmllcmVuIjtzOjM1OiJjb3Vwb25fY29kZV93aWxsX3dvcmtfZm9yX3N1Y2hfZGF0ZSI7czo1NzoiRGVyK0d1dHNjaGVpbmNvZGUrZnVua3Rpb25pZXJ0K2YlQzMlQkNyK2Vpbitzb2xjaGVzK0RhdHVtIjtzOjE2MDoiY291cG9uX3ZhbHVlX3dvdWxkX2JlX2NvbnNpZGVyX2FzX3BlcmNlbnRhZ2VfaW5fcGVyY2VudGFnZV9tb2RlX2FuZF9pbl9mbGF0X21vZGVfaXRfd2lsbF9iZV9jb25zaWRlcl9hc19hbW91bnRfbm9fbmVlZF90b19hZGRfcGVyY2VudGFnZV9zaWduX2l0X3dpbGxfYXV0b19hZGRlZCI7czoyMTI6IkRlcitDb3Vwb253ZXJ0K3dpcmQrYWxzK3Byb3plbnR1YWxlcitXZXJ0K2ltK1Byb3plbnRzYXR6K2JldHJhY2h0ZXQrdW5kK2ltK2ZsYWNoZW4rTW9kdXMrd2lyZCtlcithbHMrQmV0cmFnK2JldHJhY2h0ZXQuK0VzK211c3Mra2VpbitQcm96ZW50emVpY2hlbitoaW56dWdlZiVDMyVCQ2d0K3dlcmRlbiUyQytlcyt3aXJkK2F1dG9tYXRpc2NoK2hpbnp1Z2VmJUMzJUJDZ3QuIjtzOjE0OiJ1bml0X2lzX2Jvb2tlZCI7czoyNDoiRGllK0VpbmhlaXQrd2lyZCtnZWJ1Y2h0IjtzOjI0OiJkZWxldGVfdGhpc19zZXJ2aWNlX3VuaXQiO3M6NDA6IkwlQzMlQjZzY2hlbitTaWUrZGllc2UrU2VydmljZWVpbmhlaXQlM0YiO3M6MTk6ImRlbGV0ZV9zZXJ2aWNlX3VuaXQiO3M6Mjc6IlNlcnZpY2VlaW5oZWl0K2wlQzMlQjZzY2hlbiI7czoxNzoibWFuYWdlX3VuaXRfcHJpY2UiO3M6MTc6Ik1hbmFnZStVbml0K1ByaWNlIjtzOjE5OiJleHRyYV9zZXJ2aWNlX3RpdGxlIjtzOjIzOiJFaW5oZWl0c3ByZWlzK3ZlcndhbHRlbiI7czoxNToiYWRkb25faXNfYm9va2VkIjtzOjE4OiJBZGRvbit3aXJkK2dlYnVjaHQiO3M6MjU6ImRlbGV0ZV90aGlzX2FkZG9uX3NlcnZpY2UiO3M6MzY6IkRpZXNlbitBZGRvbi1TZXJ2aWNlK2wlQzMlQjZzY2hlbiUzRiI7czoyMzoiY2hvb3NlX3lvdXJfYWRkb25faW1hZ2UiO3M6MjY6IlclQzMlQTRobGUrZGVpbitBZGRvbi1CaWxkIjtzOjExOiJhZGRvbl9pbWFnZSI7czoxMDoiWnVzYXR6YmlsZCI7czoxOToiYWRtaW5pc3RyYXRvcl9lbWFpbCI7czoyMDoiQWRtaW5pc3RyYXRvcitFLU1haWwiO3M6MjE6ImFkbWluX3Byb2ZpbGVfYWRkcmVzcyI7czo3OiJBZHJlc3NlIjtzOjIwOiJkZWZhdWx0X2NvdW50cnlfY29kZSI7czoxMzoiTGFuZGVzdm9yd2FobCI7czoxOToiY2FuY2VsbGF0aW9uX3BvbGljeSI7czoyMzoiU3Rvcm5pZXJ1bmdzYmVkaW5ndW5nZW4iO3M6MTQ6InRyYW5zYWN0aW9uX2lkIjtzOjE1OiJUcmFuc2FrdGlvbnMtSUQiO3M6MTI6InNtc19yZW1pbmRlciI7czoxNDoiU01TK0VyaW5uZXJ1bmciO3M6MTc6InNhdmVfc21zX3NldHRpbmdzIjtzOjI3OiJTTVMtRWluc3RlbGx1bmdlbitzcGVpY2hlcm4iO3M6MTE6InNtc19zZXJ2aWNlIjtzOjExOiJTTVMrU2VydmljZSI7czo3MToiaXRfd2lsbF9zZW5kX3Ntc190b19zZXJ2aWNlX3Byb3ZpZGVyX2FuZF9jbGllbnRfZm9yX2FwcG9pbnRtZW50X2Jvb2tpbmciO3M6NjI6IkVzK3NlbmRldCtTTVMrYW4rU2VydmljZStQcm92aWRlcit1bmQrS3VuZGVuK3p1citUZXJtaW5idWNodW5nIjtzOjIzOiJ0d2lsaW9fYWNjb3VudF9zZXR0aW5ncyI7czoyNToiVHdpbGlvK0tvbnRvZWluc3RlbGx1bmdlbiI7czoyMjoicGxpdm9fYWNjb3VudF9zZXR0aW5ncyI7czoyNDoiUGxpdm8rS29udG9laW5zdGVsbHVuZ2VuIjtzOjExOiJhY2NvdW50X3NpZCI7czo5OiJLb250bytTSUQiO3M6MTA6ImF1dGhfdG9rZW4iO3M6MTA6IkF1dGgrVG9rZW4iO3M6MjA6InR3aWxpb19zZW5kZXJfbnVtYmVyIjtzOjIwOiJUd2lsaW8rU2VuZGVyK051bWJlciI7czoxOToicGxpdm9fc2VuZGVyX251bWJlciI7czoyMToiUGxpdm8rQWJzZW5kZXIrTnVtbWVyIjtzOjE5OiJ0d2lsaW9fc21zX3NldHRpbmdzIjtzOjI0OiJUd2lsaW8rU01TK0VpbnN0ZWxsdW5nZW4iO3M6MTg6InBsaXZvX3Ntc19zZXR0aW5ncyI7czoyMzoiUGxpdm8rU01TK0VpbnN0ZWxsdW5nZW4iO3M6MTg6InR3aWxpb19zbXNfZ2F0ZXdheSI7czoxODoiVHdpbGlvK1NNUytHYXRld2F5IjtzOjE3OiJwbGl2b19zbXNfZ2F0ZXdheSI7czoxNzoiUGxpdm8rU01TK0dhdGV3YXkiO3M6MTg6InNlbmRfc21zX3RvX2NsaWVudCI7czoyODoiU2VuZGVuK1NpZStTTVMrYW4rZGVuK0NsaWVudCI7czoxNzoic2VuZF9zbXNfdG9fYWRtaW4iO3M6MzU6IlNlbmRlbitTaWUrU01TK2FuK2RlbitBZG1pbmlzdHJhdG9yIjtzOjE4OiJhZG1pbl9waG9uZV9udW1iZXIiO3M6MTk6IkFkbWluLVRlbGVmb25udW1tZXIiO3M6NDE6ImF2YWlsYWJsZV9mcm9tX3dpdGhpbl95b3VyX3R3aWxpb19hY2NvdW50IjtzOjM3OiJWZXJmJUMzJUJDZ2JhcitpbitJaHJlbStUd2lsaW8tS29udG8uIjtzOjU4OiJtdXN0X2JlX2FfdmFsaWRfbnVtYmVyX2Fzc29jaWF0ZWRfd2l0aF95b3VyX3R3aWxpb19hY2NvdW50IjtzOjg0OiJNdXNzK2VpbmUrZyVDMyVCQ2x0aWdlK051bW1lcitzZWluJTJDK2RpZSttaXQrSWhyZW0rVHdpbGlvLUtvbnRvK3ZlcmtuJUMzJUJDcGZ0K2lzdC4iO3M6NjU6ImVuYWJsZV9vcl9kaXNhYmxlX3NlbmRfc21zX3RvX2NsaWVudF9mb3JfYXBwb2ludG1lbnRfYm9va2luZ19pbmZvIjtzOjk0OiJBa3RpdmllcmVuK29kZXIrRGVha3RpdmllcmVuJTJDK1NNUythbitkZW4rQ2xpZW50K3NlbmRlbitmJUMzJUJDcitUZXJtaW5idWNodW5nc2luZm9ybWF0aW9uZW4uIjtzOjY0OiJlbmFibGVfb3JfZGlzYWJsZV9zZW5kX3Ntc190b19hZG1pbl9mb3JfYXBwb2ludG1lbnRfYm9va2luZ19pbmZvIjtzOjg5OiJBa3RpdmllcmVuK29kZXIrRGVha3RpdmllcmVuJTJDK1NNUythbitBZG1pbitzZW5kZW4rZiVDMyVCQ3IrVGVybWluYnVjaHVuZ3NpbmZvcm1hdGlvbmVuLiI7czoyMDoidXBkYXRlZF9zbXNfc2V0dGluZ3MiO3M6MzA6IlNNUy1FaW5zdGVsbHVuZ2VuK2FrdHVhbGlzaWVydCI7czo1MToicGFya2luZ19hdmFpbGFiaWxpdHlfZnJvbnRlbmRfb3B0aW9uX2Rpc3BsYXlfc3RhdHVzIjtzOjY6IlBhcmtlbiI7czo0NToidmFjY3VtX2NsZWFuZXJfZnJvbnRlbmRfb3B0aW9uX2Rpc3BsYXlfc3RhdHVzIjtzOjE1OiJWYWNjdW1lK0NsZWFuZXIiO3M6Mzoib19uIjtzOjM6IkF1ZiI7czozOiJvZmYiO3M6MzoiYXVzIjtzOjY6ImVuYWJsZSI7czoxMDoiQWt0aXZpZXJlbiI7czo3OiJkaXNhYmxlIjtzOjEyOiJEZWFrdGl2aWVyZW4iO3M6NzoibW9udGhseSI7czo5OiJNb25hdGxpY2giO3M6Njoid2Vla2x5IjtzOjE2OiJXJUMzJUI2Y2hlbnRsaWNoIjtzOjE0OiJlbWFpbF90ZW1wbGF0ZSI7czoxNDoiRS1NQUlMLVZPUkxBR0UiO3M6MTY6InNtc19ub3RpZmljYXRpb24iO3M6MjA6IlNNUytCZW5hY2hyaWNodGlndW5nIjtzOjEyOiJzbXNfdGVtcGxhdGUiO3M6MTM6IlNNUytTQ0hBQkxPTkUiO3M6MjM6ImVtYWlsX3RlbXBsYXRlX3NldHRpbmdzIjtzOjIzOiJFbWFpbCtUZW1wbGF0ZStTZXR0aW5ncyI7czoyMjoiY2xpZW50X2VtYWlsX3RlbXBsYXRlcyI7czo1NjoiRS1NYWlsLVZvcmxhZ2VuZWluc3RlbGx1bmdlbkUtTWFpbC1Wb3JsYWdlbmVpbnN0ZWxsdW5nZW4iO3M6MjA6ImNsaWVudF9zbXNfdGVtcGxhdGVzIjtzOjE4OiJDbGllbnQtU01TLVZvcmxhZ2UiO3M6MjA6ImFkbWluX2VtYWlsX3RlbXBsYXRlIjtzOjM5OiJFLU1haWwtVm9ybGFnZStmJUMzJUJDcitBZG1pbmlzdHJhdG9yZW4iO3M6MTg6ImFkbWluX3Ntc190ZW1wbGF0ZSI7czoxNzoiQWRtaW4rU01TK1ZvcmxhZ2UiO3M6NDoidGFncyI7czoxMDoiU3RpY2h3b3J0ZSI7czoxMjoiYm9va2luZ19kYXRlIjtzOjEzOiJCdWNodW5nc2RhdHVtIjtzOjEyOiJzZXJ2aWNlX25hbWUiO3M6MTA6IkRpZW5zdG5hbWUiO3M6MTM6ImJ1c2luZXNzX2xvZ28iO3M6MTM6ImJ1c2luZXNzX2xvZ28iO3M6MTc6ImJ1c2luZXNzX2xvZ29fYWx0IjtzOjEyOiJidXNpbmVzc19hbHQiO3M6MTA6ImFkbWluX25hbWUiO3M6MTU6IlZlcndhbHR1bmdzbmFtZSI7czoxMDoibWV0aG9kbmFtZSI7czoxMToibWV0aG9kX25hbWUiO3M6OToiZmlyc3RuYW1lIjtzOjc6IlZvcm5hbWUiO3M6ODoibGFzdG5hbWUiO3M6MjQ6IkZhbWlsaWVubmFtZSUyQytOYWNobmFtZSI7czoxMjoiY2xpZW50X2VtYWlsIjtzOjEyOiJjbGllbnRfZW1haWwiO3M6MjE6InZhY2N1bV9jbGVhbmVyX3N0YXR1cyI7czoyMToidmFrdXVtX2NsZWFuZXJfc3RhdHVzIjtzOjE0OiJwYXJraW5nX3N0YXR1cyI7czoxNjoiUGFya3BsYXR6X1N0YXR1cyI7czoxNToiYXBwX3JlbWFpbl90aW1lIjtzOjE1OiJhcHBfcmVtYWluX3RpbWUiO3M6MTM6InJlamVjdF9zdGF0dXMiO3M6MTU6ImFibGVobmVuX3N0YXR1cyI7czoxMzoic2F2ZV90ZW1wbGF0ZSI7czoxNzoiVm9ybGFnZStzcGVpY2hlcm4iO3M6MTY6ImRlZmF1bHRfdGVtcGxhdGUiO3M6MTU6IlN0YW5kYXJkdm9ybGFnZSI7czoyMToic21zX3RlbXBsYXRlX3NldHRpbmdzIjtzOjI1OiJTTVMtVm9ybGFnZW5laW5zdGVsbHVuZ2VuIjtzOjEwOiJzZWNyZXRfa2V5IjtzOjIzOiJHZWhlaW1lcitTY2hsJUMzJUJDc3NlbCI7czoxNToicHVibGlzaGFibGVfa2V5IjtzOjM4OiJWZXIlQzMlQjZmZmVudGxpY2hiYXJlcitTY2hsJUMzJUJDc3NlbCI7czoxMjoicGF5bWVudF9mb3JtIjtzOjE2OiJaYWhsdW5nc2Zvcm11bGFyIjtzOjEyOiJhcGlfbG9naW5faWQiO3M6MTQ6IkFQSS1Bbm1lbGRlLUlEIjtzOjE1OiJ0cmFuc2FjdGlvbl9rZXkiO3M6MjY6IlRyYW5zYWt0aW9uc3NjaGwlQzMlQkNzc2VsIjtzOjEyOiJzYW5kYm94X21vZGUiO3M6MTM6IlNhbmRib3gtTW9kdXMiO3M6NDA6ImF2YWlsYWJsZV9mcm9tX3dpdGhpbl95b3VyX3BsaXZvX2FjY291bnQiO3M6Mzc6IkVyaCVDMyVBNGx0bGljaCtpbitJaHJlbStQbGl2by1Lb250by4iO3M6NTc6Im11c3RfYmVfYV92YWxpZF9udW1iZXJfYXNzb2NpYXRlZF93aXRoX3lvdXJfcGxpdm9fYWNjb3VudCI7czo4MzoiTXVzcytlaW5lK2clQzMlQkNsdGlnZStOdW1tZXIrc2VpbiUyQytkaWUrbWl0K0locmVtK1BsaXZvLUtvbnRvK3ZlcmtuJUMzJUJDcGZ0K2lzdC4iO3M6OToid2hhdHNfbmV3IjtzOjIxOiJXYXMrZ2lidCUyN3MrTmV1ZXMlM0YiO3M6MTM6ImNvbXBhbnlfcGhvbmUiO3M6NzoiVGVsZWZvbiI7czoxMzoiY29tcGFueV9fbmFtZSI7czoxNDoiTmFtZStkZXIrRmlybWEiO3M6MTI6ImJvb2tpbmdfdGltZSI7czoxMjoiQnVjaHVuZ3N6ZWl0IjtzOjE0OiJjb21wYW55X19lbWFpbCI7czoxMzoiRmlybWVuLUUtTWFpbCI7czoxNjoiY29tcGFueV9fYWRkcmVzcyI7czoxNToiRmlybWVuYW5zY2hyaWZ0IjtzOjEyOiJjb21wYW55X196aXAiO3M6OToiRmlybWVuemlwIjtzOjE0OiJjb21wYW55X19waG9uZSI7czoxMzoiRmlybWVudGVsZWZvbiI7czoxNDoiY29tcGFueV9fc3RhdGUiO3M6MTI6IkZpcm1lbnN0YXR1cyI7czoxNjoiY29tcGFueV9fY291bnRyeSI7czoxMDoiRmlybWVubGFuZCI7czoxMzoiY29tcGFueV9fY2l0eSI7czoxMToiRmlybWVuX0NpdHkiO3M6MTA6InBhZ2VfdGl0bGUiO3M6MTE6IlNlaXRlbnRpdGVsIjtzOjExOiJjbGllbnRfX3ppcCI7czoxMDoiQ2xpZW50X1ppcCI7czoxMzoiY2xpZW50X19zdGF0ZSI7czoxMjoiS3VuZGVuc3RhdHVzIjtzOjEyOiJjbGllbnRfX2NpdHkiO3M6MTE6ImNsaWVudF9jaXR5IjtzOjE1OiJjbGllbnRfX2FkZHJlc3MiO3M6MTM6IkNsaWVudGFkcmVzc2UiO3M6MTM6ImNsaWVudF9fcGhvbmUiO3M6MTI6ImNsaWVudF9waG9uZSI7czo0MDoiY29tcGFueV9sb2dvX2lzX3VzZWRfZm9yX2ludm9pY2VfcHVycG9zZSI7czo1MzoiRmlybWVubG9nbyt3aXJkK2luK0UtTWFpbCt1bmQrQnVjaHVuZ3NzZWl0ZSt2ZXJ3ZW5kZXQiO3M6MTE6InByaXZhdGVfa2V5IjtzOjIxOiJQcml2YXQrU2NobCVDMyVCQ3NzZWwiO3M6OToic2VsbGVyX2lkIjtzOjE3OiJWZXJrJUMzJUE0dWZlci1JRCI7czoxNToicG9zdGFsX2NvZGVzX2VkIjtzOjIxMToiU2llK2slQzMlQjZubmVuK2RpZStGdW5rdGlvbitmJUMzJUJDcitQb3N0bGVpdHphaGxlbitvZGVyK1Bvc3RsZWl0emFobGVuK2dlbSVDMyVBNCVDMyU5RitJaHJlbitMJUMzJUE0bmRlcmFuZm9yZGVydW5nZW4rYWt0aXZpZXJlbitvZGVyK2RlYWt0aXZpZXJlbiUyQytkYStlaW5pZ2UrTCVDMyVBNG5kZXIrd2llK2RpZStWQUUra2VpbmUrUG9zdGxlaXR6YWhsK2hhYmVuLiI7czoxNzoicG9zdGFsX2NvZGVzX2luZm8iO3M6NDUwOiJTaWUrayVDMyVCNm5uZW4rZGllK1Bvc3RsZWl0emFobGVuK2F1Zit6d2VpK0FydGVuK2FuZ2ViZW4lM0ErJTIzKzEuK1NpZStrJUMzJUI2bm5lbit2b2xsc3QlQzMlQTRuZGlnZStQTForZiVDMyVCQ3IrJUMzJTlDYmVyZWluc3RpbW11bmcrd2llK0sxQTIzMiUyQytMMkEzMzQlMkMrQzNBNEM0K2VydyVDMyVBNGhuZW4uK1NpZStrJUMzJUI2bm5lbit0ZWlsd2Vpc2UrUG9zdGxlaXR6YWhsZW4rZiVDMyVCQ3IrV2lsZGNhcmQtTWF0Y2gtRWludHIlQzMlQTRnZSt2ZXJ3ZW5kZW4lMkMrei4rSzFBJTJDK0wyQSUyQytDMyUyQytTeXN0ZW0rd2lyZCtkaWVzZStBbmZhbmdzYnVjaHN0YWJlbitkZXIrUG9zdGxlaXR6YWhsK2F1ZitkZXIrVm9yZGVyc2VpdGUrZW50c3ByZWNoZW4rdW5kK2VzK3dpcmQrdmVybWVpZGVuJTJDK2Rhc3MrU2llK3NvK3ZpZWxlK1Bvc3RsZWl0emFobGVuK3NjaHJlaWJlbi4iO3M6NToiZmlyc3QiO3M6NjoiWnVlcnN0IjtzOjY6InNlY29uZCI7czo2OiJad2VpdGUiO3M6NToidGhpcmQiO3M6NjoiRHJpdHRlIjtzOjY6ImZvdXJ0aCI7czo2OiJWaWVydGUiO3M6NToiZmlmdGgiO3M6MTE6IkYlQzMlQkNuZnRlIjtzOjEwOiJmaXJzdF93ZWVrIjtzOjExOiJFcnN0ZStXb2NoZSI7czoxMToic2Vjb25kX3dlZWsiO3M6MTI6Ilp3ZWl0ZStXb2NoZSI7czoxMDoidGhpcmRfd2VlayI7czoxMjoiRHJpdHRlK1dvY2hlIjtzOjExOiJmb3VydGhfd2VlayI7czoxMjoiVmllcnRlK1dvY2hlIjtzOjEwOiJmaWZ0aF93ZWVrIjtzOjE3OiJGJUMzJUJDbmZ0ZStXb2NoZSI7czo5OiJ0aGlzX3dlZWsiO3M6MTE6IkRpZXNlK1dvY2hlIjtzOjY6Im1vbmRheSI7czo2OiJNb250YWciO3M6NzoidHVlc2RheSI7czo4OiJEaWVuc3RhZyI7czo5OiJ3ZWRuZXNkYXkiO3M6ODoiTWl0dHdvY2giO3M6ODoidGh1cnNkYXkiO3M6MTA6IkRvbm5lcnN0YWciO3M6NjoiZnJpZGF5IjtzOjc6IkZyZWl0YWciO3M6ODoic2F0dXJkYXkiO3M6ODoiU2F0dXJkYXkiO3M6Njoic3VuZGF5IjtzOjc6IlNvbm50YWciO3M6MTk6ImFwcG9pbnRtZW50X3JlcXVlc3QiO3M6MTM6IlRlcm1pbmFuZnJhZ2UiO3M6MjA6ImFwcG9pbnRtZW50X2FwcHJvdmVkIjtzOjE2OiJUZXJtaW4rZ2VuZWhtaWd0IjtzOjIwOiJhcHBvaW50bWVudF9yZWplY3RlZCI7czoxNjoiVGVybWluK2FiZ2VsZWhudCI7czoyODoiYXBwb2ludG1lbnRfY2FuY2VsbGVkX2J5X3lvdSI7czoyNjoiVGVybWluK3ZvbitJaG5lbitzdG9ybmllcnQiO3M6MzA6ImFwcG9pbnRtZW50X3Jlc2NoZWR1bGVkX2J5X3lvdSI7czoyODoiVGVybWluK3ZvbitJaG5lbituZXUrZ2VwbGFudCI7czoyNzoiY2xpZW50X2FwcG9pbnRtZW50X3JlbWluZGVyIjtzOjI0OiJLdW5kZW4rVGVybWluK0VyaW5uZXJ1bmciO3M6NDE6Im5ld19hcHBvaW50bWVudF9yZXF1ZXN0X3JlcXVpcmVzX2FwcHJvdmFsIjtzOjQwOiJOZXVlK1Rlcm1pbmFuZnJhZ2UrZXJmb3JkZXJ0K0dlbmVobWlndW5nIjtzOjMzOiJhcHBvaW50bWVudF9jYW5jZWxsZWRfYnlfY3VzdG9tZXIiO3M6Mjc6IlRlcm1pbit2b20rS3VuZGVuK3N0b3JuaWVydCI7czozNToiYXBwb2ludG1lbnRfcmVzY2hlZHVsZWRfYnlfY3VzdG9tZXIiO3M6MzM6IlRlcm1pbit3aXJkK3ZvbStLdW5kZW4rdmVyc2Nob2JlbiI7czoyNjoiYWRtaW5fYXBwb2ludG1lbnRfcmVtaW5kZXIiO3M6MjM6IkFkbWluK1Rlcm1pbitFcmlubmVydW5nIjtzOjI3OiJvZmZfZGF5c19hZGRlZF9zdWNjZXNzZnVsbHkiO3M6Mzc6Ik9mZitUYWdlK2VyZm9sZ3JlaWNoK2hpbnp1Z2VmJUMzJUJDZ3QiO3M6Mjk6Im9mZl9kYXlzX2RlbGV0ZWRfc3VjY2Vzc2Z1bGx5IjtzOjQxOiJBdXMtVGFnZSt3dXJkZW4rZXJmb2xncmVpY2grZ2VsJUMzJUI2c2NodCI7czoxOToic29ycnlfbm90X2F2YWlsYWJsZSI7czozNToiRW50c2NodWxkaWd1bmcrTmljaHQrdmVyZiVDMyVCQ2diYXIiO3M6Nzoic3VjY2VzcyI7czo2OiJFcmZvbGciO3M6NjoiZmFpbGVkIjtzOjExOiJHZXNjaGVpdGVydCI7czo0OiJvbmNlIjtzOjY6IkVpbm1hbCI7czoxMDoiQmlfTW9udGhseSI7czoxMzoiWndlaW1vbmF0bGljaCI7czoxMToiRm9ydG5pZ2h0bHkiO3M6MTM6IlZpZXJ6ZWhuK1RhZ2UiO3M6MTU6IlJlY3VycmVuY2VfVHlwZSI7czoxNjoiV2llZGVyaG9sdW5nc3R5cCI7czo5OiJiaV93ZWVrbHkiO3M6MjA6Ilp3ZWl3JUMzJUI2Y2hlbnRsaWNoIjtzOjU6IkRhaWx5IjtzOjEyOiJUJUMzJUE0Z2xpY2giO3M6MjQ6Imd1ZXN0X2N1c3RvbWVyc19ib29raW5ncyI7czoyNjoiRyVDMyVBNHN0ZWt1bmRlbitCdWNodW5nZW4iO3M6MzA6ImV4aXN0aW5nX2FuZF9uZXdfdXNlcl9jaGVja291dCI7czozNzoiVm9yaGFuZGVuZXIrJTI2K25ldWVyK051dHplci1DaGVja291dCI7czo3NToiaXRfd2lsbF9hbGxvd19vcHRpb25fZm9yX3VzZXJfdG9fZ2V0X2Jvb2tpbmdfd2l0aF9uZXdfdXNlcl9vcl9leGlzdGluZ191c2VyIjtzOjM3OiJWb3JoYW5kZW5lcislMjYrbmV1ZXIrTnV0emVyLUNoZWNrb3V0IjtzOjM6IjBfMSI7czoyOiIwMSI7czozOiIxXzEiO3M6MzoiMS4xIjtzOjM6IjFfMiI7czozOiIxLjIiO3M6MzoiMF8yIjtzOjI6IjAyIjtzOjQ6ImZyZWUiO3M6NDoiRnJlaSI7czozMDoic2hvd19jb21wYW55X2FkZHJlc3NfaW5faGVhZGVyIjtzOjM5OiJGaXJtZW5hZHJlc3NlK2luK2RlcitLb3BmemVpbGUrYW56ZWlnZW4iO3M6MTM6ImNhbGVuZGFyX3dlZWsiO3M6NToiV29jaGUiO3M6MTQ6ImNhbGVuZGFyX21vbnRoIjtzOjU6Ik1vbmF0IjtzOjEyOiJjYWxlbmRhcl9kYXkiO3M6MzoiVGFnIjtzOjE0OiJjYWxlbmRhcl90b2RheSI7czo1OiJIZXV0ZSI7czoxNToicmVzdG9yZV9kZWZhdWx0IjtzOjI1OiJTdGFuZGFyZCt3aWVkZXJoZXJzdGVsbGVuIjtzOjE1OiJzY3JvbGxhYmxlX2NhcnQiO3M6MjU6IlN0YW5kYXJkK3dpZWRlcmhlcnN0ZWxsZW4iO3M6MTI6Im1lcmNoYW50X2tleSI7czoyNjoiSCVDMyVBNG5kbGVyc2NobCVDMyVCQ3NzZWwiO3M6ODoic2FsdF9rZXkiO3M6MTk6IlNhbHorU2NobCVDMyVCQ3NzZWwiO3M6MjE6InRleHRsb2NhbF9zbXNfZ2F0ZXdheSI7czoyMToiVGV4dGxvY2FsK1NNUy1HYXRld2F5IjtzOjIyOiJ0ZXh0bG9jYWxfc21zX3NldHRpbmdzIjtzOjI3OiJUZXh0bG9jYWwrU01TLUVpbnN0ZWxsdW5nZW4iO3M6MjY6InRleHRsb2NhbF9hY2NvdW50X3NldHRpbmdzIjtzOjI4OiJUZXh0bG9jYWwrS29udG9laW5zdGVsbHVuZ2VuIjtzOjE2OiJhY2NvdW50X3VzZXJuYW1lIjtzOjEyOiJCZW51dHplcm5hbWUiO3M6MTU6ImFjY291bnRfaGFzaF9pZCI7czoxMzoiS29udG8tSGFzaC1JRCI7czozODoiZW1haWxfaWRfcmVnaXN0ZXJlZF93aXRoX3lvdV90ZXh0bG9jYWwiO3M6NTk6IkdlYmVuK1NpZStJaHJlK21pdCt0ZXh0bG9jYWwrcmVnaXN0cmllcnRlK0UtTWFpbC1BZHJlc3NlK2FuIjtzOjI5OiJoYXNoX2lkX3Byb3ZpZGVkX2J5X3RleHRsb2NhbCI7czozNjoiSGFzaC1JRCt2b24rdGV4dGxvY2FsK2JlcmVpdGdlc3RlbGx0IjtzOjEzOiJiYW5rX3RyYW5zZmVyIjtzOjIwOiJCYW5rJUMzJUJDYmVyd2Vpc3VuZyI7czo5OiJiYW5rX25hbWUiO3M6OToiQmFuaytOYW1lIjtzOjEyOiJhY2NvdW50X25hbWUiO3M6MTY6IktvbnRvYmV6ZWljaG51bmciO3M6MTQ6ImFjY291bnRfbnVtYmVyIjtzOjEzOiJBY2NvdW50bnVtbWVyIjtzOjExOiJicmFuY2hfY29kZSI7czoxMjoiQnJhbmNoZW5jb2RlIjtzOjk6Imlmc2NfY29kZSI7czo5OiJJRlNDLUNvZGUiO3M6MTY6ImJhbmtfZGVzY3JpcHRpb24iO3M6MTY6IkJhbmtiZXNjaHJlaWJ1bmciO3M6MTU6InlvdXJfY2FydF9pdGVtcyI7czoyNjoiSWhyZStFaW5rYXVmc3dhZ2VuK0FydGlrZWwiO3M6MjM6InNob3dfaG93X3dpbGxfd2VfZ2V0X2luIjtzOjI3OiJTaG93K1dpZStrb21tZW4rd2lyK3JlaW4lM0YiO3M6MTY6InNob3dfZGVzY3JpcHRpb24iO3M6MjE6IkJlc2NocmVpYnVuZythbnplaWdlbiI7czoxMjoiYmFua19kZXRhaWxzIjtzOjk6IkJhbmtkYXRlbiI7czoyMToib2tfcmVtb3ZlX3NhbXBsZV9kYXRhIjtzOjI6Ik9rIjtzOjE2OiJib29rX2FwcG9pbnRtZW50IjtzOjIzOiJFaW5lbitUZXJtaW4rdmVyYWJyZWRlbiI7czoyNjoicmVtb3ZlX3NhbXBsZV9kYXRhX21lc3NhZ2UiO3M6MjIxOiJTaWUrdmVyc3VjaGVuJTJDK0JlaXNwaWVsZGF0ZW4renUrZW50ZmVybmVuLitXZW5uK1NpZStCZWlzcGllbGRhdGVuK2VudGZlcm5lbiUyQyt3aXJkK0locmUrQnVjaHVuZyUyQytkaWUrc2ljaCthdWYrQmVpc3BpZWxkaWVuc3RlK2JlemllaHQlMkMrZW5kZyVDMyVCQ2x0aWcrZ2VsJUMzJUI2c2NodC4rVW0rZm9ydHp1ZmFocmVuJTJDK2tsaWNrZW4rU2llK2JpdHRlK2F1ZislMjdPSyUyNyI7czozOToicmVjb21tZW5kZWRfaW1hZ2VfdHlwZV9qcGdfanBlZ19wbmdfZ2lmIjtzOjUxOiIlMjhFbXBmb2hsZW5lcitCaWxkdHlwK2pwZyUyQytqcGVnJTJDK3BuZyUyQytnaWYlMjkiO3M6MTM6ImF1dGhldGljYXRpb24iO3M6MTc6IkF1dGhlbnRpZml6aWVydW5nIjtzOjE1OiJlbmNyeXB0aW9uX3R5cGUiO3M6MjQ6IlZlcnNjaGwlQzMlQkNzc2VsdW5nc3R5cCI7czo1OiJwbGFpbiI7czo3OiJFaW5mYWNoIjtzOjQ6InRydWUiO3M6NDoiV2FociI7czo1OiJmYWxzZSI7czo2OiJGYWxzY2giO3M6MjU6ImNoYW5nZV9jYWxjdWxhdGlvbl9wb2xpY3kiO3M6MjI6IkJlcmVjaG51bmcrJUMzJUE0bmRlcm4iO3M6ODoibXVsdGlwbHkiO3M6MTQ6Ik11bHRpcGxpemllcmVuIjtzOjU6ImVxdWFsIjtzOjY6IkdsZWljaCI7czo3OiJ3YXJuaW5nIjtzOjEwOiJXYXJudW5nJTIxIjtzOjEwOiJmaWVsZF9uYW1lIjtzOjg6IkZlbGRuYW1lIjtzOjE0OiJlbmFibGVfZGlzYWJsZSI7czoyMzoiQWt0aXZpZXJlbitkZWFrdGl2aWVyZW4iO3M6ODoicmVxdWlyZWQiO3M6MTI6IkVyZm9yZGVybGljaCI7czoxMDoibWluX2xlbmd0aCI7czoxOToiTWluaW1hbGUrTCVDMyVBNG5nZSI7czoxMDoibWF4X2xlbmd0aCI7czoxOToiTWF4aW1hbGUrTCVDMyVBNG5nZSI7czoyNzoiYXBwb2ludG1lbnRfZGV0YWlsc19zZWN0aW9uIjtzOjI0OiJUZXJtaW4rRGV0YWlscytBYnNjaG5pdHQiO3M6MTkyOiJpZl95b3VfYXJlX2hhdmluZ19ib29raW5nX3N5c3RlbV93aGljaF9uZWVkX3RoZV9ib29raW5nX2FkZHJlc3NfdGhlbl9wbGVhc2VfbWFrZV90aGlzX2ZpZWxkX2VuYWJsZV9vcl9lbHNlX2l0X3dpbGxfbm90X2FibGVfdG9fdGFrZV90aGVfYm9va2luZ19hZGRyZXNzX2FuZF9kaXNwbGF5X2JsYW5rX2FkZHJlc3NfaW5fdGhlX2Jvb2tpbmciO3M6MjIzOiJXZW5uK1NpZStlaW4rQnVjaHVuZ3NzeXN0ZW0raGFiZW4lMkMrZGFzK2RpZStCdWNodW5nc2FkcmVzc2UrYmVuJUMzJUI2dGlndCUyQytkYW5uK21hY2hlbitTaWUrYml0dGUrZGllc2VzK0ZlbGQrZnJlaSUyQytzb25zdCtrYW5uK2VzK2RpZStCdWNodW5nc2FkcmVzc2UrbmljaHQrJUMzJUJDYmVybmVobWVuK3VuZCtrZWluZStsZWVyZStBZHJlc3NlK2luK2RlcitCdWNodW5nK2FuemVpZ2VuIjtzOjIzOiJmcm9udF9sYW5ndWFnZV9kcm9wZG93biI7czoyMzoiRnJvbnQrTGFuZ3VhZ2UrRHJvcGRvd24iO3M6NzoiZW5hYmxlZCI7czo5OiJha3RpdmllcnQiO3M6MTU6InZhY2N1bWVfY2xlYW5lciI7czoxMToiU3RhdWJzYXVnZXIiO3M6MTM6InN0YWZmX21lbWJlcnMiO3M6MTE6Ik1pdGFyYmVpdGVyIjtzOjIwOiJhZGRfbmV3X3N0YWZmX21lbWJlciI7czozMzoiTmV1ZW4rTWl0YXJiZWl0ZXIraGluenVmJUMzJUJDZ2VuIjtzOjQ6InJvbGUiO3M6NToiUm9sbGUiO3M6NToic3RhZmYiO3M6MTE6Ik1pdGFyYmVpdGVyIjtzOjU6ImFkbWluIjtzOjEzOiJBZG1pbmlzdHJhdG9yIjtzOjE1OiJzZXJ2aWNlX2RldGFpbHMiO3M6MTQ6IlNlcnZpY2VkZXRhaWxzIjtzOjE1OiJ0ZWNobmljYWxfYWRtaW4iO3M6MjU6IlRlY2huaXNjaGVyK0FkbWluaXN0cmF0b3IiO3M6MTQ6ImVuYWJsZV9ib29raW5nIjtzOjE4OiJCdWNodW5nK2FrdGl2aWVyZW4iO3M6MTU6ImZsYXRfY29tbWlzc2lvbiI7czoxODoiQnVjaHVuZytha3RpdmllcmVuIjtzOjQxOiJtYW5hZ2VhYmxlX2Zvcm1fZmllbGRzX2Zyb250X2Jvb2tpbmdfZm9ybSI7czo1MDoiTWFuYWdlYWJsZStGb3JtK0ZlbGRlcitmJUMzJUJDcitGcm9udCtCb29raW5nK0Zvcm0iO3M6MjI6Im1hbmFnZWFibGVfZm9ybV9maWVsZHMiO3M6MjY6IlZlcndhbHRiYXJlK0Zvcm11bGFyZmVsZGVyIjtzOjM6InNtcyI7czozOiJTTVMiO3M6MzoiY3JtIjtzOjM6IkNSTSI7czo3OiJtZXNzYWdlIjtzOjk6IkJvdHNjaGFmdCI7czoxMjoic2VuZF9tZXNzYWdlIjtzOjE2OiJOYWNocmljaHQrc2VuZGVuIjtzOjEyOiJhbGxfbWVzc2FnZXMiO3M6MTY6IkFsbGUrTmFjaHJpY2h0ZW4iO3M6Nzoic3ViamVjdCI7czoxMDoiR2VnZW5zdGFuZCI7czoxNDoiYWRkX2F0dGFjaG1lbnQiO3M6MjI6IkFuaGFuZytoaW56dWYlQzMlQkNnZW4iO3M6NDoic2VuZCI7czo2OiJTZW5kZW4iO3M6NToiY2xvc2UiO3M6MTQ6IlNjaGxpZSVDMyU5RmVuIjtzOjIxOiJkZWxldGVfdGhpc19jdXN0b21lcj8iO3M6MjM6IkRlbGV0ZStUaGlzK0N1c3RvbWVyJTNGIjtzOjM6InllcyI7czoyOiJKYSI7czoxNjoiYWRkX25ld19jdXN0b21lciI7czoyODoiTmV1ZW4rS3VuZGVuK2hpbnp1ZiVDMyVCQ2dlbiI7czoxMDoiYXR0YWNobWVudCI7czoxMToiQmVmZXN0aWd1bmciO3M6NDoiZGF0ZSI7czo1OiJEYXR1bSI7czoxNDoic2VlX2F0dGFjaG1lbnQiO3M6MTI6IlNpZWhlK0FuaGFuZyI7czoxMzoibm9fYXR0YWNobWVudCI7czoxNzoiS2VpbmUrQmVmZXN0aWd1bmciO3M6MTY6ImN0X3NwZWNpYWxfb2ZmZXIiO3M6MTM6IlNvbmRlcmFuZ2Vib3QiO3M6MjE6ImN0X3NwZWNpYWxfb2ZmZXJfdGV4dCI7czoxODoiU29uZGVyYW5nZWJvdCtUZXh0Ijt9', 'YToxOTE6e3M6MjQ6InBsZWFzZV9lbnRlcl9tZXJjaGFudF9JRCI7czo0MDoiK0JpdHRlK2dlYmVuK1NpZStkaWUrSCVDMyVBNG5kbGVyLUlEK2VpbiI7czoyMzoicGxlYXNlX2VudGVyX3NlY3VyZV9rZXkiO3M6NDk6IkJpdHRlK2dlYmVuK1NpZStkZW4rU2ljaGVyaGVpdHNzY2hsJUMzJUJDc3NlbCtlaW4iO3M6Mzg6InBsZWFzZV9lbnRlcl9nb29nbGVfY2FsZW5kZXJfYWRtaW5fdXJsIjtzOjQ1OiJCaXR0ZStnZWJlbitTaWUrR29vZ2xlK0thbGVuZGVyK0FkbWluK1VSTCtlaW4iO3M6NDE6InBsZWFzZV9lbnRlcl9nb29nbGVfY2FsZW5kZXJfZnJvbnRlbmRfdXJsIjtzOjQ4OiJCaXR0ZStnZWJlbitTaWUrR29vZ2xlK0thbGVuZGVyK0Zyb250ZW5kK1VSTCtlaW4iO3M6NDI6InBsZWFzZV9lbnRlcl9nb29nbGVfY2FsZW5kZXJfY2xpZW50X3NlY3JldCI7czo1MzoiQml0dGUrZ2ViZW4rU2llK2RlbitHb29nbGUrS2FsZW5kZXIrQ2xpZW50K0NsaWVudCtlaW4iO3M6Mzg6InBsZWFzZV9lbnRlcl9nb29nbGVfY2FsZW5kZXJfY2xpZW50X0lEIjtzOjQ5OiJCaXR0ZStnZWJlbitTaWUrZGllK0dvb2dsZStLYWxlbmRlci1DbGllbnQtSUQrZWluIjtzOjMxOiJwbGVhc2VfZW50ZXJfZ29vZ2xlX2NhbGVuZGVyX0lEIjtzOjQyOiJCaXR0ZStnZWJlbitTaWUrZGllK0dvb2dsZStLYWxlbmRlci1JRCtlaW4iO3M6Mjg6InlvdV9jYW5ub3RfYm9va19vbl9wYXN0X2RhdGUiO3M6NDk6IlNpZStrJUMzJUI2bm5lbituaWNodCthbSt2ZXJnYW5nZW5lbitEYXR1bStidWNoZW4iO3M6MTg6IkludmFsaWRfSW1hZ2VfVHlwZSI7czoyMzoiVW5nJUMzJUJDbHRpZ2VyK0JpbGR0eXAiO3M6MzM6InNlb19zZXR0aW5nc191cGRhdGVkX3N1Y2Nlc3NmdWxseSI7czo0OToiU0VPLUVpbnN0ZWxsdW5nZW4rd3VyZGVuK2VyZm9sZ3JlaWNoK2FrdHVhbGlzaWVydCI7czoyOToiY3VzdG9tZXJfZGVsZXRlZF9zdWNjZXNzZnVsbHkiO3M6NDE6IkRlcitLdW5kZSt3dXJkZStlcmZvbGdyZWljaCtnZWwlQzMlQjZzY2h0IjtzOjMyOiJwbGVhc2VfZW50ZXJfYmVsb3dfMzZfY2hhcmFjdGVycyI7czozNjoiQml0dGUrZ2ViZW4rU2llK3VudGVyKzM2K1plaWNoZW4rZWluIjtzOjM4OiJhcmVfeW91X3N1cmVfeW91X3dhbnRfdG9fZGVsZXRlX2NsaWVudCI7czo2MzoiU2luZCtTaWUrc2ljaGVyJTJDK2Rhc3MrU2llK2wlQzMlQjZzY2hlbittJUMzJUI2Y2h0ZW4rS2xpZW50JTNGIjtzOjMwOiJwbGVhc2Vfc2VsZWN0X2F0bGVhc3Rfb25lX3VuaXQiO3M6NDk6IkJpdHRlK3clQzMlQTRobGVuK1NpZSttaW5kZXN0ZW5zK2VpbmUrRWluaGVpdCthdXMiO3M6NDM6ImF0bGVhc3Rfb25lX3BheW1lbnRfbWV0aG9kX3Nob3VsZF9iZV9lbmFibGUiO3M6NTM6Ik1pbmRlc3RlbnMrZWluZStaYWhsdW5nc21ldGhvZGUrc29sbHRlK2FrdGl2aWVydCtzZWluIjtzOjI3OiJhcHBvaW50bWVudF9ib29raW5nX2NvbmZpcm0iO3M6Mjk6IlRlcm1pbmJ1Y2h1bmcrYmVzdCVDMyVBNHRpZ2VuIjtzOjI4OiJhcHBvaW50bWVudF9ib29raW5nX3JlamVjdGVkIjtzOjIzOiJUZXJtaW5idWNodW5nK2FiZ2VsZWhudCI7czoxNDoiYm9va2luZ19jYW5jZWwiO3M6MTk6IkJ1Y2h1bmcrYWJnZWJyb2NoZW4iO3M6Mjk6ImFwcG9pbnRtZW50X21hcmtlZF9hc19ub19zaG93IjtzOjM1OiJUZXJtaW4rYWxzK05pY2h0ZXJzY2hlaW5lbittYXJraWVydCI7czozNjoiYXBwb2ludG1lbnRfcmVzY2hlZHVsZXNfc3VjY2Vzc2Z1bGx5IjtzOjM4OiJUZXJtaW4rd2lyZCtlcmZvbGdyZWljaCtuZXUrdGVybWluaWVydCI7czoxNToiYm9va2luZ19kZWxldGVkIjtzOjIxOiJCdWNodW5nK2dlbCVDMyVCNnNjaHQiO3M6NDg6ImJyZWFrX2VuZF90aW1lX3Nob3VsZF9iZV9ncmVhdGVyX3RoYW5fc3RhcnRfdGltZSI7czo1NzoiQnJlYWsrRW5kK1RpbWUrc29sbHRlK2dyJUMzJUI2JUMzJTlGZXIrYWxzK1N0YXJ0emVpdCtzZWluIjtzOjE2OiJjYW5jZWxfYnlfY2xpZW50IjtzOjIwOiJBYmJyZWNoZW4rdm9tK0t1bmRlbiI7czoyOToiY2FuY2VsbGVkX2J5X3NlcnZpY2VfcHJvdmlkZXIiO3M6Mjc6IlZvbStEaWVuc3RsZWlzdGVyK3N0b3JuaWVydCI7czoyMzoiZGVzaWduX3NldF9zdWNjZXNzZnVsbHkiO3M6MzA6IkRlc2lnbitlcmZvbGdyZWljaCtlaW5nZXN0ZWxsdCI7czoyMjoiZW5kX2JyZWFrX3RpbWVfdXBkYXRlZCI7czozMjoiRW5kZStkZXIrUGF1c2VuemVpdCtha3R1YWxpc2llcnQiO3M6MjA6ImVudGVyX2FscGhhYmV0c19vbmx5IjtzOjIxOiJHaWIrbnVyK0FscGhhYmV0ZStlaW4iO3M6MjA6ImVudGVyX29ubHlfYWxwaGFiZXRzIjtzOjI3OiJHZWJlbitTaWUrbnVyK0FscGhhYmV0ZStlaW4iO3M6Mjg6ImVudGVyX29ubHlfYWxwaGFiZXRzX251bWJlcnMiO3M6MzI6IkdpYitudXIrQWxwaGFiZXRlKyUyRitaYWhsZW4rZWluIjtzOjE3OiJlbnRlcl9vbmx5X2RpZ2l0cyI7czoyNToiR2ViZW4rU2llK251citaaWZmZXJuK2VpbiI7czoxNToiZW50ZXJfdmFsaWRfdXJsIjtzOjM1OiJHZWJlbitTaWUrZWluZStnJUMzJUJDbHRpZ2UrVVJMK2VpbiI7czoxODoiZW50ZXJfb25seV9udW1lcmljIjtzOjI0OiJHZWJlbitTaWUrbnVyK1phaGxlbitlaW4iO3M6MjU6ImVudGVyX3Byb3Blcl9jb3VudHJ5X2NvZGUiO3M6NDM6IkdlYmVuK1NpZStkZW4rcmljaHRpZ2VuK0wlQzMlQTRuZGVyY29kZStlaW4iO3M6MzQ6ImZyZXF1ZW50bHlfZGlzY291bnRfc3RhdHVzX3VwZGF0ZWQiO3M6Mzc6IkglQzMlQTR1ZmlnK1JhYmF0dHN0YXR1cytha3R1YWxpc2llcnQiO3M6Mjc6ImZyZXF1ZW50bHlfZGlzY291bnRfdXBkYXRlZCI7czozMToiSCVDMyVBNHVmaWcrUmFiYXR0K2FrdHVhbGlzaWVydCI7czoyMToibWFuYWdlX2FkZG9uc19zZXJ2aWNlIjtzOjI4OiJWZXJ3YWx0ZW4rU2llK0FkZG9ucy1TZXJ2aWNlIjtzOjI5OiJtYXhpbXVtX2ZpbGVfdXBsb2FkX3NpemVfMl9tYiI7czo2NDoiTWF4aW1hbGUrR3IlQzMlQjYlQzMlOUZlK2YlQzMlQkNyK2RhcytIb2NobGFkZW4rdm9uK0RhdGVpZW4rMitNQiI7czoyNzoibWV0aG9kX2RlbGV0ZWRfc3VjY2Vzc2Z1bGx5IjtzOjM5OiJNZXRob2RlK3d1cmRlK2VyZm9sZ3JlaWNoK2dlbCVDMyVCNnNjaHQiO3M6Mjg6Im1ldGhvZF9pbnNlcnRlZF9zdWNjZXNzZnVsbHkiO3M6NDA6Ik1ldGhvZGUrd3VyZGUrZXJmb2xncmVpY2grZWluZ2VmJUMzJUJDZ3QiO3M6Mjk6Im1pbmltdW1fZmlsZV91cGxvYWRfc2l6ZV8xX2tiIjtzOjM2OiJEYXRlaWdyJUMzJUI2JUMzJTlGZSttaW5kZXN0ZW5zKzErS0IiO3M6Mjc6Im9mZl90aW1lX2FkZGVkX3N1Y2Nlc3NmdWxseSI7czo0MjoiQXVzemVpdCt3dXJkZStlcmZvbGdyZWljaCtoaW56dWdlZiVDMyVCQ2d0IjtzOjM2OiJvbmx5X2pwZWdfcG5nX2FuZF9naWZfaW1hZ2VzX2FsbG93ZWQiO3M6NDA6Ik51citKUEVHLSUyQytQTkctK3VuZCtHSUYtQmlsZGVyK2VybGF1YnQiO3M6Mzc6Im9ubHlfanBlZ19wbmdfZ2lmX3ppcF9hbmRfcGRmX2FsbG93ZWQiO3M6NDU6Ik51citqcGVnJTJDK3BuZyUyQytnaWYlMkMremlwK3VuZCtwZGYrZXJsYXVidCI7czo0MjoicGxlYXNlX3dhaXRfd2hpbGVfd2Vfc2VuZF9hbGxfeW91cl9tZXNzYWdlIjtzOjY1OiJCaXR0ZSt3YXJ0ZW4rU2llJTJDK3clQzMlQTRocmVuZCt3aXIrYWxsZStJaHJlK05hY2hyaWNodGVuK3NlbmRlbiI7czoyOToicGxlYXNlX2VuYWJsZV9lbWFpbF90b19jbGllbnQiO3M6NDk6IkJpdHRlK2FrdGl2aWVyZW4rU2llK0UtTWFpbHMrZiVDMyVCQ3IrZGVuK0NsaWVudC4iO3M6MjU6InBsZWFzZV9lbmFibGVfc21zX2dhdGV3YXkiO3M6NDk6IkJpdHRlK2FrdGl2aWVyZW4rU2llK0UtTWFpbHMrZiVDMyVCQ3IrZGVuK0NsaWVudC4iO3M6MzM6InBsZWFzZV9lbmFibGVfY2xpZW50X25vdGlmaWNhdGlvbiI7czo0ODoiQml0dGUrYWt0aXZpZXJlbitTaWUrZGllK0t1bmRlbmJlbmFjaHJpY2h0aWd1bmcuIjtzOjMzOiJwYXNzd29yZF9tdXN0X2JlXzhfY2hhcmFjdGVyX2xvbmciO3M6Mzc6IkRhcytQYXNzd29ydCttdXNzKzgrWmVpY2hlbitsYW5nK3NlaW4iO3M6NDk6InBhc3N3b3JkX3Nob3VsZF9ub3RfZXhpc3RfbW9yZV90aGVuXzIwX2NoYXJhY3RlcnMiO3M6NTc6IkRhcytQYXNzd29ydCtzb2xsdGUrbmljaHQrbCVDMyVBNG5nZXIrYWxzKzIwK1plaWNoZW4rc2VpbiI7czozMzoicGxlYXNlX2Fzc2lnbl9iYXNlX3ByaWNlX2Zvcl91bml0IjtzOjU0OiJCaXR0ZStnZWJlbitTaWUrZGVuK0Jhc2lzcHJlaXMrZiVDMyVCQ3IrZGllK0VpbmhlaXQrYW4iO3M6MTk6InBsZWFzZV9hc3NpZ25fcHJpY2UiO3M6MzA6IkJpdHRlK2xlZ2VuK1NpZStkZW4rUHJlaXMrZmVzdCI7czoxNzoicGxlYXNlX2Fzc2lnbl9xdHkiO3M6MzA6IkJpdHRlK2xlZ2VuK1NpZStkZW4rUHJlaXMrZmVzdCI7czoyNToicGxlYXNlX2VudGVyX2FwaV9wYXNzd29yZCI7czozNjoiQml0dGUrZ2ViZW4rU2llK2RhcytBUEktUGFzc3dvcnQrZWluIjtzOjI1OiJwbGVhc2VfZW50ZXJfYXBpX3VzZXJuYW1lIjtzOjQxOiJCaXR0ZStnZWJlbitTaWUrZGVuK0FQSS1CZW51dHplcm5hbWVuK2VpbiI7czoyMzoicGxlYXNlX2VudGVyX2NvbG9yX2NvZGUiO3M6MzI6IkJpdHRlK2dlYmVuK1NpZStkZW4rRmFyYmNvZGUrZWluIjtzOjIwOiJwbGVhc2VfZW50ZXJfY291bnRyeSI7czoyODoiQml0dGUrZ2ViZW4rU2llK2RhcytMYW5kK2VpbiI7czoyNToicGxlYXNlX2VudGVyX2NvdXBvbl9saW1pdCI7czozODoiQml0dGUrZ2ViZW4rU2llK2RhcytHdXRzY2hlaW5saW1pdCtlaW4iO3M6MjU6InBsZWFzZV9lbnRlcl9jb3Vwb25fdmFsdWUiO3M6Mzc6IkJpdHRlK2dlYmVuK1NpZStkZW4rR3V0c2NoZWlud2VydCtlaW4iO3M6MjQ6InBsZWFzZV9lbnRlcl9jb3Vwb25fY29kZSI7czozNzoiQml0dGUrZ2ViZW4rU2llK2RlbitHdXRzY2hlaW5jb2RlK2VpbiI7czoxODoicGxlYXNlX2VudGVyX2VtYWlsIjtzOjMwOiJCaXR0ZStnZWJlbitTaWUrZWluZStFbWFpbCtlaW4iO3M6MjE6InBsZWFzZV9lbnRlcl9mdWxsbmFtZSI7czoyODoiQml0dGUrZ2ViZW4rU2llK0Z1bGxuYW1lK2VpbiI7czoyMToicGxlYXNlX2VudGVyX21heGxpbWl0IjtzOjI4OiJCaXR0ZStnZWJlbitTaWUrbWF4TGltaXQrZWluIjtzOjI1OiJwbGVhc2VfZW50ZXJfbWV0aG9kX3RpdGxlIjtzOjI1OiJQbGVhc2UrZW50ZXIrbWV0aG9kK3RpdGxlIjtzOjE3OiJwbGVhc2VfZW50ZXJfbmFtZSI7czoyOToiQml0dGUrZ2ViZW4rU2llK2RlbitOYW1lbitlaW4iO3M6MjU6InBsZWFzZV9lbnRlcl9vbmx5X251bWVyaWMiO3M6MzA6IkJpdHRlK2dlYmVuK1NpZStudXIrWmFobGVuK2VpbiI7czozMDoicGxlYXNlX2VudGVyX3Byb3Blcl9iYXNlX3ByaWNlIjtzOjQ0OiJCaXR0ZStnZWJlbitTaWUrZGVuK2tvcnJla3RlbitHcnVuZHByZWlzK2VpbiI7czoyNDoicGxlYXNlX2VudGVyX3Byb3Blcl9uYW1lIjtzOjM5OiJCaXR0ZStnZWJlbitTaWUrZGVuK3JpY2h0aWdlbitOYW1lbitlaW4iO3M6MjU6InBsZWFzZV9lbnRlcl9wcm9wZXJfdGl0bGUiO3M6Mzk6IkJpdHRlK2dlYmVuK1NpZStkZW4rcmljaHRpZ2VuK1RpdGVsK2VpbiI7czoyODoicGxlYXNlX2VudGVyX3B1Ymxpc2hhYmxlX2tleSI7czo3NToiK0JpdHRlK2dlYmVuK1NpZStkZW4rUHVibGlzaGFibGUrS2V5K2Vpbi4rR2ViZW4rU2llK2RlbitQdWJsaXNoYWJsZStLZXkrZWluIjtzOjIzOiJwbGVhc2VfZW50ZXJfc2VjcmV0X2tleSI7czo0NzoiQml0dGUrZ2ViZW4rU2llK2RlbitnZWhlaW1lbitTY2hsJUMzJUJDc3NlbCtlaW4iO3M6MjY6InBsZWFzZV9lbnRlcl9zZXJ2aWNlX3RpdGxlIjtzOjM3OiJCaXR0ZStnZWJlbitTaWUrZGVuK1NlcnZpY2UtVGl0ZWwrZWluIjtzOjIyOiJwbGVhc2VfZW50ZXJfc2lnbmF0dXJlIjtzOjI3OiJCaXR0ZStVbnRlcnNjaHJpZnQrZWluZ2ViZW4iO3M6MjE6InBsZWFzZV9lbnRlcl9zb21lX3F0eSI7czozMDoiQml0dGUrZ2ViZW4rU2llK2VpbmUrTWVuZ2UrZWluIjtzOjE4OiJwbGVhc2VfZW50ZXJfdGl0bGUiO3M6Mjk6IkJpdHRlK2dlYmVuK1NpZStkZW4rVGl0ZWwrZWluIjtzOjIzOiJwbGVhc2VfZW50ZXJfdW5pdF90aXRsZSI7czo0MToiQml0dGUrZ2ViZW4rU2llK2RlbitUaXRlbCtkZXIrRWluaGVpdCtlaW4iO3M6MzE6InBsZWFzZV9lbnRlcl92YWxpZF9jb3VudHJ5X2NvZGUiO3M6NTM6IkJpdHRlK2dlYmVuK1NpZStkZW4rZyVDMyVCQ2x0aWdlbitMJUMzJUE0bmRlcmNvZGUrZWluIjtzOjMyOiJwbGVhc2VfZW50ZXJfdmFsaWRfc2VydmljZV90aXRsZSI7czo1MzoiQml0dGUrZ2ViZW4rU2llK2VpbmVuK2clQzMlQkNsdGlnZW4rU2VydmljZS1UaXRlbCtlaW4iO3M6MjQ6InBsZWFzZV9lbnRlcl92YWxpZF9wcmljZSI7czo0MzoiQml0dGUrZ2ViZW4rU2llK2RlbitnJUMzJUJDbHRpZ2VuK1ByZWlzK2VpbiI7czoyMDoicGxlYXNlX2VudGVyX3ppcGNvZGUiO3M6Mjc6IkJpdHRlK1Bvc3RsZWl0emFobCtlaW5nZWJlbiI7czoxODoicGxlYXNlX2VudGVyX3N0YXRlIjtzOjMwOiJCaXR0ZStnZWJlbitTaWUrZGVuK1N0YXR1cytlaW4iO3M6MzA6InBsZWFzZV9yZXR5cGVfY29ycmVjdF9wYXNzd29yZCI7czo0MToiQml0dGUrZ2ViZW4rU2llK2RhcytyaWNodGlnZStQYXNzd29ydCtlaW4iO3M6MzE6InBsZWFzZV9zZWxlY3RfcG9ycGVyX3RpbWVfc2xvdHMiO3M6NDA6IkJpdHRlK3clQzMlQTRobGVuK1NpZStwb3JwZXIrWmVpdGZlbnN0ZXIiO3M6NDg6InBsZWFzZV9zZWxlY3RfdGltZV9iZXR3ZWVuX2RheV9hdmFpbGFiaWxpdHlfdGltZSI7czo2OToiQml0dGUrdyVDMyVBNGhsZW4rU2llK2RpZStaZWl0K3p3aXNjaGVuK2RlcitWZXJmJUMzJUJDZ2JhcmtlaXQrYW0rVGFnIjtzOjMxOiJwbGVhc2VfdmFsaWRfdmFsdWVfZm9yX2Rpc2NvdW50IjtzOjQwOiJCaXR0ZStnJUMzJUJDbHRpZ2VuK1dlcnQrZiVDMyVCQ3IrUmFiYXR0IjtzOjI5OiJwbGVhc2VfZW50ZXJfY29uZmlybV9wYXNzd29yZCI7czozODoiQml0dGUrYmVzdCVDMyVBNHRpZ2VuK1NpZStkYXMrUGFzc3dvcnQiO3M6MjU6InBsZWFzZV9lbnRlcl9uZXdfcGFzc3dvcmQiO3M6Mjk6IkJpdHRlK25ldWVzK1Bhc3N3b3J0K2VpbmdlYmVuIjtzOjI1OiJwbGVhc2VfZW50ZXJfb2xkX3Bhc3N3b3JkIjtzOjI5OiJCaXR0ZSthbHRlcytQYXNzd29ydCtlaW5nZWJlbiI7czoyNToicGxlYXNlX2VudGVyX3ZhbGlkX251bWJlciI7czo0NDoiQml0dGUrZ2ViZW4rU2llK2VpbmUrZyVDMyVCQ2x0aWdlK051bW1lcitlaW4iO3M6NDM6InBsZWFzZV9lbnRlcl92YWxpZF9udW1iZXJfd2l0aF9jb3VudHJ5X2NvZGUiO3M6NjQ6IkJpdHRlK2dlYmVuK1NpZStlaW5lK2clQzMlQkNsdGlnZStOdW1tZXIrbWl0K0wlQzMlQTRuZGVyY29kZStlaW4iO3M6NDY6InBsZWFzZV9zZWxlY3RfZW5kX3RpbWVfZ3JlYXRlcl90aGFuX3N0YXJ0X3RpbWUiO3M6Njg6IkJpdHRlK3clQzMlQTRobGVuK1NpZStkaWUrRW5kemVpdCtnciVDMyVCNiVDMyU5RmVyK2FscytkaWUrU3RhcnR6ZWl0IjtzOjQzOiJwbGVhc2Vfc2VsZWN0X2VuZF90aW1lX2xlc3NfdGhhbl9zdGFydF90aW1lIjtzOjU5OiJCaXR0ZSt3JUMzJUE0aGxlbitTaWUrZGllK0VuZHplaXQrd2VuaWdlcithbHMrZGllK1N0YXJ0emVpdCI7czo0OToicGxlYXNlX3NlbGVjdF9hX2Nyb3BfcmVnaW9uX2FuZF90aGVuX3ByZXNzX3VwbG9hZCI7czo3ODoiQml0dGUrdyVDMyVBNGhsZW4rU2llK2VpbmUrQW5iYXVyZWdpb24rdW5kK2RyJUMzJUJDY2tlbitTaWUrZGFubithdWYrSG9jaGxhZGVuIjtzOjU2OiJwbGVhc2Vfc2VsZWN0X2FfdmFsaWRfaW1hZ2VfZmlsZV9qcGdfYW5kX3BuZ19hcmVfYWxsb3dlZCI7czo3NDoiQml0dGUrdyVDMyVBNGhsZW4rU2llK2VpbmUrZyVDMyVCQ2x0aWdlK0JpbGRkYXRlaStqcGcrdW5kK3BuZytzaW5kK2VybGF1YnQiO3M6Mjg6InByb2ZpbGVfdXBkYXRlZF9zdWNjZXNzZnVsbHkiO3M6MzE6IlByb2ZpbCtlcmZvbGdyZWljaCtha3R1YWxpc2llcnQiO3M6MTY6InF0eV9ydWxlX2RlbGV0ZWQiO3M6MjU6Ik1lbmdlbnJlZ2VsK2dlbCVDMyVCNnNjaHQiO3M6Mjc6InJlY29yZF9kZWxldGVkX3N1Y2Nlc3NmdWxseSI7czo0MToiRGF0ZW5zYXR6K3d1cmRlK2VyZm9sZ3JlaWNoK2dlbCVDMyVCNnNjaHQiO3M6Mjc6InJlY29yZF91cGRhdGVkX3N1Y2Nlc3NmdWxseSI7czozNDoiRGF0ZW5zYXR6K2VyZm9sZ3JlaWNoK2FrdHVhbGlzaWVydCI7czoxMToicmVzY2hlZHVsZWQiO3M6MTI6IlVtZGlzcG9uaWVydCI7czoyNzoic2NoZWR1bGVfdXBkYXRlZF90b19tb250aGx5IjtzOjM1OiJaZWl0cGxhbithdWYrTW9uYXRsaWNoK2FrdHVhbGlzaWVydCI7czoyNjoic2NoZWR1bGVfdXBkYXRlZF90b193ZWVrbHkiO3M6NDI6IlplaXRwbGFuK2F1ZitXJUMzJUI2Y2hlbnRsaWNoK2FrdHVhbGlzaWVydCI7czoyNjoic29ycnlfbWV0aG9kX2FscmVhZHlfZXhpc3QiO3M6MzE6IlNvcnJ5LU1ldGhvZGUrZXhpc3RpZXJ0K2JlcmVpdHMiO3M6MjE6InNvcnJ5X25vX25vdGlmaWNhdGlvbiI7czo1NjoiRW50c2NodWxkaWd1bmclMkMrU2llK2hhYmVuK2tlaW5lbitiZXZvcnN0ZWhlbmRlbitUZXJtaW4iO3M6Mjk6InNvcnJ5X3Byb21vY29kZV9hbHJlYWR5X2V4aXN0IjtzOjMzOiJTb3JyeStQcm9tb2NvZGUrZXhpc3RpZXJ0K2JlcmVpdHMiO3M6MjQ6InNvcnJ5X3VuaXRfYWxyZWFkeV9leGlzdCI7czozMToiU29ycnktRWluaGVpdCtleGlzdGllcnQrYmVyZWl0cyI7czoyNjoic29ycnlfd2VfYXJlX25vdF9hdmFpbGFibGUiO3M6NDc6IkVudHNjaHVsZGlndW5nJTJDK3dpcitzaW5kK25pY2h0K3ZlcmYlQzMlQkNnYmFyIjtzOjI0OiJzdGFydF9icmVha190aW1lX3VwZGF0ZWQiO3M6MjM6IlN0YXJ0cGF1c2UrYWt0dWFsaXNpZXJ0IjtzOjE0OiJzdGF0dXNfdXBkYXRlZCI7czoxOToiU3RhdHVzK2FrdHVhbGlzaWVydCI7czozMToidGltZV9zbG90c191cGRhdGVkX3N1Y2Nlc3NmdWxseSI7czo0MzoiWmVpdGZlbnN0ZXIrd3VyZGVuK2VyZm9sZ3JlaWNoK2FrdHVhbGlzaWVydCI7czoyNjoidW5pdF9pbnNlcnRlZF9zdWNjZXNzZnVsbHkiO3M6NDM6IkdlciVDMyVBNHQrd3VyZGUrZXJmb2xncmVpY2grZWluZ2VmJUMzJUJDZ3QiO3M6MjA6InVuaXRzX3N0YXR1c191cGRhdGVkIjtzOjI4OiJFaW5oZWl0ZW5zdGF0dXMrYWt0dWFsaXNpZXJ0IjtzOjI3OiJ1cGRhdGVkX2FwcGVhcmFuY2Vfc2V0dGluZ3MiO3M6Mjg6IkVpbmhlaXRlbnN0YXR1cytha3R1YWxpc2llcnQiO3M6MjM6InVwZGF0ZWRfY29tcGFueV9kZXRhaWxzIjtzOjI3OiJBa3R1YWxpc2llcnRlK0Zpcm1lbmRldGFpbHMiO3M6MjI6InVwZGF0ZWRfZW1haWxfc2V0dGluZ3MiO3M6MzQ6IkFrdHVhbGlzaWVydGUrRS1NYWlsLUVpbnN0ZWxsdW5nZW4iO3M6MjQ6InVwZGF0ZWRfZ2VuZXJhbF9zZXR0aW5ncyI7czozNzoiQWxsZ2VtZWluZStFaW5zdGVsbHVuZ2VuK2FrdHVhbGlzaWVydCI7czoyNToidXBkYXRlZF9wYXltZW50c19zZXR0aW5ncyI7czozNDoiWmFobHVuZ3NlaW5zdGVsbHVuZ2VuK2FrdHVhbGlzaWVydCI7czoyNzoieW91cl9vbGRfcGFzc3dvcmRfaW5jb3JyZWN0IjtzOjIxOiJBbHRlcytQYXNzd29ydCtmYWxzY2giO3M6Mjg6InBsZWFzZV9lbnRlcl9taW5pbXVtXzVfY2hhcnMiO3M6NDA6IkJpdHRlK2dlYmVuK1NpZSttaW5kZXN0ZW5zKzUrWmVpY2hlbitlaW4iO3M6Mjk6InBsZWFzZV9lbnRlcl9tYXhpbXVtXzEwX2NoYXJzIjtzOjM4OiJCaXR0ZStnZWJlbitTaWUrbWF4aW1hbCsxMCtaZWljaGVuK2VpbiI7czoyNDoicGxlYXNlX2VudGVyX3Bvc3RhbF9jb2RlIjtzOjM2OiJCaXR0ZStnZWJlbitTaWUrZGllK1Bvc3RsZWl0emFobCtlaW4iO3M6MjM6InBsZWFzZV9zZWxlY3RfYV9zZXJ2aWNlIjtzOjM1OiJCaXR0ZSt3JUMzJUE0aGxlbitTaWUrZWluZW4rU2VydmljZSI7czozMDoicGxlYXNlX3NlbGVjdF91bml0c19hbmRfYWRkb25zIjtzOjQyOiJCaXR0ZSt3JUMzJUE0aGxlbitTaWUrRWluaGVpdGVuK3VuZCtBZGRvbnMiO3M6Mjk6InBsZWFzZV9zZWxlY3RfdW5pdHNfb3JfYWRkb25zIjtzOjQzOiJCaXR0ZSt3JUMzJUE0aGxlbitTaWUrRWluaGVpdGVuK29kZXIrQWRkb25zIjtzOjMyOiJwbGVhc2VfbG9naW5fdG9fY29tcGxldGVfYm9va2luZyI7czo2MjoiQml0dGUrbG9nZ2VuK1NpZStzaWNoK2VpbiUyQyt1bStkaWUrQnVjaHVuZythYnp1c2NobGllJUMzJTlGZW4iO3M6MzA6InBsZWFzZV9zZWxlY3RfYXBwb2ludG1lbnRfZGF0ZSI7czo0MToiQml0dGUrdyVDMyVBNGhsZW4rU2llK2RhcytUZXJtaW5kYXR1bSthdXMiO3M6MzQ6InBsZWFzZV9hY2NlcHRfdGVybXNfYW5kX2NvbmRpdGlvbnMiO3M6NjM6IkJpdHRlK2FremVwdGllcmVuK1NpZStkaWUrQWxsZ2VtZWluZW4rR2VzY2glQzMlQTRmdHNiZWRpbmd1bmdlbiI7czozNToiaW5jb3JyZWN0X2VtYWlsX2FkZHJlc3Nfb3JfcGFzc3dvcmQiO3M6MzY6IkZhbHNjaGUrRS1NYWlsLUFkcmVzc2Urb2RlcitQYXNzd29ydCI7czozMjoicGxlYXNlX2VudGVyX3ZhbGlkX2VtYWlsX2FkZHJlc3MiO3M6NTA6IkJpdHRlK2dlYmVuK1NpZStlaW5lK2clQzMlQkNsdGlnZStFbWFpbCtBZHJlc3NlK2FuIjtzOjI2OiJwbGVhc2VfZW50ZXJfZW1haWxfYWRkcmVzcyI7czozODoiQml0dGUrZ2ViZW4rU2llK2RpZStFLU1haWwrQWRyZXNzZStlaW4iO3M6MjE6InBsZWFzZV9lbnRlcl9wYXNzd29yZCI7czozODoiQml0dGUrZ2ViZW4rU2llK2RpZStFLU1haWwrQWRyZXNzZStlaW4iO3M6MzM6InBsZWFzZV9lbnRlcl9taW5pbXVtXzhfY2hhcmFjdGVycyI7czo0MDoiQml0dGUrZ2ViZW4rU2llK21pbmRlc3RlbnMrOCtaZWljaGVuK2VpbiI7czozNDoicGxlYXNlX2VudGVyX21heGltdW1fMTVfY2hhcmFjdGVycyI7czozODoiQml0dGUrZ2ViZW4rU2llK21heGltYWwrMTUrWmVpY2hlbitlaW4iO3M6MjM6InBsZWFzZV9lbnRlcl9maXJzdF9uYW1lIjtzOjMyOiJCaXR0ZStnZWJlbitTaWUrZGVuK1Zvcm5hbWVuK2VpbiI7czoyNzoicGxlYXNlX2VudGVyX29ubHlfYWxwaGFiZXRzIjtzOjMzOiJCaXR0ZStnZWJlbitTaWUrbnVyK0FscGhhYmV0ZStlaW4iO3M6MzM6InBsZWFzZV9lbnRlcl9taW5pbXVtXzJfY2hhcmFjdGVycyI7czo0MDoiQml0dGUrZ2ViZW4rU2llK21pbmRlc3RlbnMrMitaZWljaGVuK2VpbiI7czoyMjoicGxlYXNlX2VudGVyX2xhc3RfbmFtZSI7czozMzoiQml0dGUrZ2ViZW4rU2llK2RlbitOYWNobmFtZW4rZWluIjtzOjIwOiJlbWFpbF9hbHJlYWR5X2V4aXN0cyI7czoyNDoiRS1NYWlsK2V4aXN0aWVydCtiZXJlaXRzIjtzOjI1OiJwbGVhc2VfZW50ZXJfcGhvbmVfbnVtYmVyIjtzOjM3OiJCaXR0ZStnZWJlbitTaWUrZGllK1RlbGVmb25udW1tZXIrZWluIjtzOjI2OiJwbGVhc2VfZW50ZXJfb25seV9udW1lcmljcyI7czozMToiQml0dGUrZ2ViZW4rU2llK251citaaWZmZXJuK2VpbiI7czozMDoicGxlYXNlX2VudGVyX21pbmltdW1fMTBfZGlnaXRzIjtzOjQxOiJCaXR0ZStnZWJlbitTaWUrbWluZGVzdGVucysxMCtaaWZmZXJuK2VpbiI7czozMDoicGxlYXNlX2VudGVyX21heGltdW1fMTRfZGlnaXRzIjtzOjMwOiJQbGVhc2UrZW50ZXIrbWF4aW11bSsxNCtkaWdpdHMiO3M6MjA6InBsZWFzZV9lbnRlcl9hZGRyZXNzIjtzOjMxOiJCaXR0ZStnZWJlbitTaWUrZGllK0FkcmVzc2UrZWluIjtzOjM0OiJwbGVhc2VfZW50ZXJfbWluaW11bV8yMF9jaGFyYWN0ZXJzIjtzOjQxOiJCaXR0ZStnZWJlbitTaWUrbWluZGVzdGVucysyMCtaZWljaGVuK2VpbiI7czoyMToicGxlYXNlX2VudGVyX3ppcF9jb2RlIjtzOjM2OiJCaXR0ZStnZWJlbitTaWUrZGllK1Bvc3RsZWl0emFobCtlaW4iO3M6Mjg6InBsZWFzZV9lbnRlcl9wcm9wZXJfemlwX2NvZGUiO3M6NDU6IkJpdHRlK2dlYmVuK1NpZStkaWUrcmljaHRpZ2UrUG9zdGxlaXR6YWhsK2VpbiI7czoyOToicGxlYXNlX2VudGVyX21pbmltdW1fNV9kaWdpdHMiO3M6NDA6IkJpdHRlK2dlYmVuK1NpZSttaW5kZXN0ZW5zKzUrWmlmZmVybitlaW4iO3M6Mjk6InBsZWFzZV9lbnRlcl9tYXhpbXVtXzdfZGlnaXRzIjtzOjM3OiJCaXR0ZStnZWJlbitTaWUrbWF4aW1hbCs3K1ppZmZlcm4rZWluIjtzOjE3OiJwbGVhc2VfZW50ZXJfY2l0eSI7czoyOToiQml0dGUrZ2ViZW4rU2llK2RpZStTdGFkdCtlaW4iO3M6MjQ6InBsZWFzZV9lbnRlcl9wcm9wZXJfY2l0eSI7czozODoiQml0dGUrZ2ViZW4rU2llK2RpZStyaWNodGlnZStTdGFkdCtlaW4iO3M6MzQ6InBsZWFzZV9lbnRlcl9tYXhpbXVtXzQ4X2NoYXJhY3RlcnMiO3M6Mzg6IkJpdHRlK2dlYmVuK1NpZStkaWUrcmljaHRpZ2UrU3RhZHQrZWluIjtzOjI1OiJwbGVhc2VfZW50ZXJfcHJvcGVyX3N0YXRlIjtzOjQwOiJCaXR0ZStnZWJlbitTaWUrZGVuK3JpY2h0aWdlbitTdGF0dXMrZWluIjtzOjI3OiJwbGVhc2VfZW50ZXJfY29udGFjdF9zdGF0dXMiO3M6Mzc6IkJpdHRlK2dlYmVuK1NpZStkZW4rS29udGFrdHN0YXR1cytlaW4iO3M6MzU6InBsZWFzZV9lbnRlcl9tYXhpbXVtXzEwMF9jaGFyYWN0ZXJzIjtzOjM5OiJCaXR0ZStnZWJlbitTaWUrbWF4aW1hbCsxMDArWmVpY2hlbitlaW4iO3M6NDc6InlvdXJfY2FydF9pc19lbXB0eV9wbGVhc2VfYWRkX2NsZWFuaW5nX3NlcnZpY2VzIjtzOjYzOiJJaHIrV2FyZW5rb3JiK2lzdCtsZWVyLitCaXR0ZStSZWluaWd1bmdzc2VydmljZStoaW56dWYlQzMlQkNnZW4iO3M6MTQ6ImNvdXBvbl9leHBpcmVkIjtzOjIwOiJHdXRzY2hlaW4rYWJnZWxhdWZlbiI7czoxNDoiaW52YWxpZF9jb3Vwb24iO3M6MjU6IlVuZyVDMyVCQ2x0aWdlcitHdXRzY2hlaW4iO3M6NDI6Im91cl9zZXJ2aWNlX25vdF9hdmFpbGFibGVfYXRfeW91cl9sb2NhdGlvbiI7czo1NjoiVW5zZXIrU2VydmljZStpc3QrYW4rSWhyZW0rU3RhbmRvcnQrbmljaHQrdmVyZiVDMyVCQ2diYXIiO3M6MzE6InBsZWFzZV9lbnRlcl9wcm9wZXJfcG9zdGFsX2NvZGUiO3M6NDU6IkJpdHRlK2dlYmVuK1NpZStkaWUrcmljaHRpZ2UrUG9zdGxlaXR6YWhsK2VpbiI7czozODoiaW52YWxpZF9lbWFpbF9pZF9wbGVhc2VfcmVnaXN0ZXJfZmlyc3QiO3M6NTA6IlVuZyVDMyVCQ2x0aWdlK0UtTWFpbC1JRCtiaXR0ZSt6dWVyc3QrcmVnaXN0cmllcmVuIjtzOjU5OiJ5b3VyX3Bhc3N3b3JkX3NlbmRfc3VjY2Vzc2Z1bGx5X2F0X3lvdXJfcmVnaXN0ZXJlZF9lbWFpbF9pZCI7czo2ODoiSWhyK1Bhc3N3b3J0K3dpcmQrZXJmb2xncmVpY2grYW4rSWhyZStyZWdpc3RyaWVydGUrRW1haWwtSUQrZ2VzZW5kZXQiO3M6NDU6InlvdXJfcGFzc3dvcmRfcmVzZXRfc3VjY2Vzc2Z1bGx5X3BsZWFzZV9sb2dpbiI7czo3MjoiSWhyK1Bhc3N3b3J0K2VyZm9sZ3JlaWNoK3p1ciVDMyVCQ2NrZ2VzZXR6dCUyQytiaXR0ZStsb2dnZW4rU2llK3NpY2grZWluIjtzOjQ1OiJuZXdfcGFzc3dvcmRfYW5kX3JldHlwZV9uZXdfcGFzc3dvcmRfbWlzbWF0Y2giO3M6NTY6Ik5ldWVzK1Bhc3N3b3J0K3VuZCtlcm5ldXRlcytFaW5nZWJlbitkZXMrbmV1ZW4rUGFzc3dvcnRzIjtzOjM6Im5ldyI7czozOiJOZXUiO3M6MzI6InlvdXJfcmVzZXRfcGFzc3dvcmRfbGlua19leHBpcmVkIjtzOjU5OiJJaHIrTGluayt6dW0rWnVyJUMzJUJDY2tzZXR6ZW4rZGVzK1Bhc3N3b3J0cytpc3QrYWJnZWxhdWZlbiI7czozMDoiZnJvbnRfZGlzcGxheV9sYW5ndWFnZV9jaGFuZ2VkIjtzOjM1OiJGcm9udC1EaXNwbGF5LVNwcmFjaGUrZ2UlQzMlQTRuZGVydCI7czo0ODoidXBkYXRlZF9mcm9udF9kaXNwbGF5X2xhbmd1YWdlX2FuZF91cGRhdGVfbGFiZWxzIjtzOjU2OiJBa3R1YWxpc2llcnRlK0Zyb250LURpc3BsYXktU3ByYWNoZSt1bmQrVXBkYXRlLUV0aWtldHRlbiI7czozMzoicGxlYXNlX2VudGVyX29ubHlfN19jaGFyc19tYXhpbXVtIjtzOjM3OiJCaXR0ZStnZWJlbitTaWUrbWF4aW1hbCs3K1plaWNoZW4rZWluIjtzOjI5OiJwbGVhc2VfZW50ZXJfbWF4aW11bV8yMF9jaGFycyI7czozODoiQml0dGUrZ2ViZW4rU2llK21heGltYWwrMjArWmVpY2hlbitlaW4iO3M6Mjg6InJlY29yZF9pbnNlcnRlZF9zdWNjZXNzZnVsbHkiO3M6MzY6IkRhdGVuc2F0eitlcmZvbGdyZWljaCtlaW5nZWYlQzMlQkNndCI7czoyNDoicGxlYXNlX2VudGVyX2FjY291bnRfc2lkIjtzOjMwOiJCaXR0ZStnZWJlbitTaWUrQWNjb3V0K1NJRCtlaW4iO3M6MjM6InBsZWFzZV9lbnRlcl9hdXRoX3Rva2VuIjtzOjMwOiJCaXR0ZStnZWJlbitTaWUrQXV0aCtUb2tlbitlaW4iO3M6MjY6InBsZWFzZV9lbnRlcl9zZW5kZXJfbnVtYmVyIjtzOjM2OiJCaXR0ZStnZWJlbitTaWUrZGllK1NlbmRlcm51bW1lcitlaW4iO3M6MjU6InBsZWFzZV9lbnRlcl9hZG1pbl9udW1iZXIiO3M6MzY6IkJpdHRlK2dlYmVuK1NpZStkaWUrQWRtaW4tTnVtbWVyK2VpbiI7czoyNzoic29ycnlfc2VydmljZV9hbHJlYWR5X2V4aXN0IjtzOjM1OiJTb3JyeS1TZXJ2aWNlK2lzdCtiZXJlaXRzK3ZvcmhhbmRlbiI7czoyNToicGxlYXNlX2VudGVyX2FwaV9sb2dpbl9pZCI7czozNjoiQml0dGUrZ2ViZW4rU2llK2RpZStBUEktTG9naW4tSUQrZWluIjtzOjI4OiJwbGVhc2VfZW50ZXJfdHJhbnNhY3Rpb25fa2V5IjtzOjQxOiJCaXR0ZStUcmFuc2FrdGlvbnNzY2hsJUMzJUJDc3NlbCtlaW5nZWJlbiI7czoyNDoicGxlYXNlX2VudGVyX3Ntc19tZXNzYWdlIjtzOjM4OiJCaXR0ZStnZWJlbitTaWUrZWluZStTTVMtTmFjaHJpY2h0K2VpbiI7czoyNjoicGxlYXNlX2VudGVyX2VtYWlsX21lc3NhZ2UiO3M6NDE6IkJpdHRlK2dlYmVuK1NpZStlaW5lK0UtTWFpbC1OYWNocmljaHQrZWluIjtzOjI0OiJwbGVhc2VfZW50ZXJfcHJpdmF0ZV9rZXkiO3M6MjQ6IlBsZWFzZStFbnRlcitQcml2YXRlK0tleSI7czoyMjoicGxlYXNlX2VudGVyX3NlbGxlcl9pZCI7czo0MToiQml0dGUrZ2ViZW4rU2llK2RpZStWZXJrJUMzJUE0dWZlci1JRCtlaW4iO3M6Mzc6InBsZWFzZV9lbnRlcl92YWxpZF92YWx1ZV9mb3JfZGlzY291bnQiO3M6NjQ6IkJpdHRlK2dlYmVuK1NpZStlaW5lbitnJUMzJUJDbHRpZ2VuK1dlcnQrZiVDMyVCQ3IrZGVuK1JhYmF0dCtlaW4iO3M6MzU6InBhc3N3b3JkX211c3RfYmVfb25seV8xMF9jaGFyYWN0ZXJzIjtzOjQ1OiJEYXMrUGFzc3dvcnQrZGFyZitudXIrYXVzKzEwK1plaWNoZW4rYmVzdGVoZW4iO3M6MzU6InBhc3N3b3JkX2F0X2xlYXN0X2hhdmVfOF9jaGFyYWN0ZXJzIjtzOjI5OiJQYXNzd29ydCtNaW5kZXN0ZW5zKzgrWmVpY2hlbiI7czozMjoicGxlYXNlX2VudGVyX3JldHlwZV9uZXdfcGFzc3dvcmQiO3M6Mzc6IkJpdHRlK2dlYmVuK1NpZStkYXMrbmV1ZStQYXNzd29ydCtlaW4iO3M6NDg6InlvdXJfcGFzc3dvcmRfc2VuZF9zdWNjZXNzZnVsbHlfYXRfeW91cl9lbWFpbF9pZCI7czo1NjoiSWhyK1Bhc3N3b3J0K3dpcmQrZXJmb2xncmVpY2grYW4rSWhyZStFLU1haWwtSUQrZ2VzZW5kZXQiO3M6MjU6InBsZWFzZV9zZWxlY3RfZXhwaXJ5X2RhdGUiO3M6Mzc6IkJpdHRlK3clQzMlQTRobGVuK1NpZStkYXMrQWJsYXVmZGF0dW0iO3M6MjU6InBsZWFzZV9lbnRlcl9tZXJjaGFudF9rZXkiO3M6NTA6IkJpdHRlK2dlYmVuK1NpZStkZW4rSCVDMyVBNG5kbGVyc2NobCVDMyVCQ3NzZWwrZWluIjtzOjIxOiJwbGVhc2VfZW50ZXJfc2FsdF9rZXkiO3M6Mjg6IkJpdHRlK2dlYmVuK1NpZStTYWx0K0tleStlaW4iO3M6Mjk6InBsZWFzZV9lbnRlcl9hY2NvdW50X3VzZXJuYW1lIjtzOjQ4OiJCaXR0ZStnZWJlbitTaWUrZGVuK0JlbnV0emVybmFtZW4rZGVzK0tvbnRvcytlaW4iO3M6Mjg6InBsZWFzZV9lbnRlcl9hY2NvdW50X2hhc2hfaWQiO3M6MzY6IkJpdHRlK2dlYmVuK1NpZStkaWUrS29udG9oYXNoLUlEK2VpbiI7czoxNDoiaW52YWxpZF92YWx1ZXMiO3M6MjA6IlVuZyVDMyVCQ2x0aWdlK1dlcnRlIjtzOjQxOiJwbGVhc2Vfc2VsZWN0X2F0bGVhc3Rfb25lX2NoZWNrb3V0X21ldGhvZCI7czo1ODoiQml0dGUrdyVDMyVBNGhsZW4rU2llK21pbmRlc3RlbnMrZWluZStDaGVja291dC1NZXRob2RlK2F1cyI7fQ==', 'YTo4OntzOjI4OiJwbGVhc2VfZW50ZXJfbWluaW11bV8zX2NoYXJzIjtzOjQwOiJCaXR0ZStnZWJlbitTaWUrbWluZGVzdGVucyszK1plaWNoZW4rZWluIjtzOjc6Imludm9pY2UiO3M6ODoiUkVDSE5VTkciO3M6MTA6Imludm9pY2VfdG8iO3M6MTE6IlJFQ0hOVU5HK0FOIjtzOjEyOiJpbnZvaWNlX2RhdGUiO3M6MTQ6IlJlY2hudW5nc2RhdHVtIjtzOjQ6ImNhc2giO3M6NToiS0FTU0UiO3M6MTI6InNlcnZpY2VfbmFtZSI7czoxMDoiRGllbnN0bmFtZSI7czozOiJxdHkiO3M6NToiTWVuZ2UiO3M6OToiYm9va2VkX29uIjtzOjEwOiJHZWJ1Y2h0K2FtIjt9', 'YToyODp7czo5OiJtaW5fZmZfcHMiO3M6NDA6IkJpdHRlK2dlYmVuK1NpZSttaW5kZXN0ZW5zKzgrWmVpY2hlbitlaW4iO3M6OToibWF4X2ZmX3BzIjtzOjM4OiJCaXR0ZStnZWJlbitTaWUrbWF4aW1hbCsxMCtaZWljaGVuK2VpbiI7czo5OiJyZXFfZmZfZm4iO3M6MzI6IkJpdHRlK2dlYmVuK1NpZStkZW4rVm9ybmFtZW4rZWluIjtzOjk6Im1pbl9mZl9mbiI7czozMjoiQml0dGUrZ2ViZW4rU2llK2RlbitWb3JuYW1lbitlaW4iO3M6OToibWF4X2ZmX2ZuIjtzOjM4OiJCaXR0ZStnZWJlbitTaWUrbWF4aW1hbCsxNStaZWljaGVuK2VpbiI7czo5OiJyZXFfZmZfbG4iO3M6MzM6IkJpdHRlK2dlYmVuK1NpZStkZW4rTmFjaG5hbWVuK2VpbiI7czo5OiJtaW5fZmZfbG4iO3M6NDA6IkJpdHRlK2dlYmVuK1NpZSttaW5kZXN0ZW5zKzMrWmVpY2hlbitlaW4iO3M6OToibWF4X2ZmX2xuIjtzOjM4OiJCaXR0ZStnZWJlbitTaWUrbWF4aW1hbCsxNStaZWljaGVuK2VpbiI7czo5OiJyZXFfZmZfcGgiO3M6Mzc6IkJpdHRlK2dlYmVuK1NpZStkaWUrVGVsZWZvbm51bW1lcitlaW4iO3M6OToibWluX2ZmX3BoIjtzOjQwOiJCaXR0ZStnZWJlbitTaWUrbWluZGVzdGVucys5K1plaWNoZW4rZWluIjtzOjk6Im1heF9mZl9waCI7czozODoiQml0dGUrZ2ViZW4rU2llK21heGltYWwrMTUrWmVpY2hlbitlaW4iO3M6OToicmVxX2ZmX3NhIjtzOjMxOiJCaXR0ZStnZWJlbitTaWUrZGllK0FkcmVzc2UrZWluIjtzOjk6Im1pbl9mZl9zYSI7czo0MToiQml0dGUrZ2ViZW4rU2llK21pbmRlc3RlbnMrMTArWmVpY2hlbitlaW4iO3M6OToibWF4X2ZmX3NhIjtzOjM4OiJCaXR0ZStnZWJlbitTaWUrbWF4aW1hbCs0MCtaZWljaGVuK2VpbiI7czo5OiJyZXFfZmZfenAiO3M6MzY6IkJpdHRlK1Bvc3RsZWl0emFobCtlaW5nZWJlblBsZWFzZStlbiI7czo5OiJtaW5fZmZfenAiO3M6NDA6IkJpdHRlK2dlYmVuK1NpZSttaW5kZXN0ZW5zKzMrWmVpY2hlbitlaW4iO3M6OToibWF4X2ZmX3pwIjtzOjM3OiJCaXR0ZStnZWJlbitTaWUrbWF4aW1hbCs3K1plaWNoZW4rZWluIjtzOjk6InJlcV9mZl9jdCI7czoyOToiQml0dGUrZ2ViZW4rU2llK2RpZStTdGFkdCtlaW4iO3M6OToibWluX2ZmX2N0IjtzOjQwOiJCaXR0ZStnZWJlbitTaWUrbWluZGVzdGVucyszK1plaWNoZW4rZWluIjtzOjk6Im1heF9mZl9jdCI7czozODoiQml0dGUrZ2ViZW4rU2llK21heGltYWwrMTUrWmVpY2hlbitlaW4iO3M6OToicmVxX2ZmX3N0IjtzOjMwOiJCaXR0ZStnZWJlbitTaWUrZGVuK1N0YXR1cytlaW4iO3M6OToibWluX2ZmX3N0IjtzOjQwOiJCaXR0ZStnZWJlbitTaWUrbWluZGVzdGVucyszK1plaWNoZW4rZWluIjtzOjk6Im1heF9mZl9zdCI7czozODoiQml0dGUrZ2ViZW4rU2llK21heGltYWwrMTUrWmVpY2hlbitlaW4iO3M6MTA6InJlcV9mZl9zcm4iO3M6Mjc6IkJpdHRlK2dlYmVuK1NpZStOb3RpemVuK2VpbiI7czoxMDoibWluX2ZmX3NybiI7czo0MToiQml0dGUrZ2ViZW4rU2llK21pbmRlc3RlbnMrMTArWmVpY2hlbitlaW4iO3M6MTA6Im1heF9mZl9zcm4iO3M6Mzg6IkJpdHRlK2dlYmVuK1NpZSttYXhpbWFsKzcwK1plaWNoZW4rZWluIjtzOjM1OiJUcmFuc2FjdGlvbl9mYWlsZWRfcGxlYXNlX3RyeV9hZ2FpbiI7czo1NzoiVHJhbnNha3Rpb24rZmVobGdlc2NobGFnZW4uK0JpdHRlK3ZlcnN1Y2hlbitTaWUrZXMrZXJuZXV0IjtzOjMwOiJQbGVhc2VfRW50ZXJfdmFsaWRfY2FyZF9kZXRhaWwiO3M6NTA6IkJpdHRlK2dlYmVuK1NpZStlaW4rZyVDMyVCQ2x0aWdlcytLYXJ0ZW5kZXRhaWwrZWluIjt9');");
mysqli_query($this->conn, "INSERT INTO `ct_languages` (`id`, `label_data`, `language`, `admin_labels`, `error_labels`, `extra_labels`, `front_error_labels`) VALUES
mysqli_query($this->conn, "INSERT INTO `ct_languages` (`id`, `label_data`, `language`, `admin_labels`, `error_labels`, `extra_labels`, `front_error_labels`) VALUES
mysqli_query($this->conn, "INSERT INTO `ct_languages` (`id`, `label_data`, `language`, `admin_labels`, `error_labels`, `extra_labels`, `front_error_labels`) VALUES
mysqli_query($this->conn, "INSERT INTO `ct_languages` (`id`, `label_data`, `language`, `admin_labels`, `error_labels`, `extra_labels`, `front_error_labels`) VALUES
mysqli_query($this->conn, "INSERT INTO `ct_languages` (`id`, `label_data`, `language`, `admin_labels`, `error_labels`, `extra_labels`, `front_error_labels`) VALUES
	}	
	
}
?>