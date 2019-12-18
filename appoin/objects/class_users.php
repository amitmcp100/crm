<?php   

class cleanto_users{
	public $user_id;
	public $existing_username;
	public $existing_password;
	public $username;
	public $user_email;
	public $user_pwd;
	public $first_name;
	public $last_name;
	public $phone;
	public $zip;
	public $address;
	public $city;
	public $state;
	public $notes;
	public $vc_status;
	public $p_status;
	public $contact_status;
	public $status;
	public $usertype;
	public $user_status;									 
	public $stripe_id="";									 
	public $conn;
	public $table_name="ct_users";
	public $table_name1 = "ct_order_client_info";
	public $table_name_admin = "ct_admin_info";
	public $table_otp = "ct_otp";
	public $email = "";
	public $otp = "";
	public $offset;
	public $limit;													
	
	/* Function for add users */
	public function add_user(){
		$dftdt=date('Y-m-d H:m:s');
		$query="insert into `".$this->table_name."` (`id`,`user_email`,`user_pwd`,`first_name`,`last_name`,`phone`,`zip`,`address`,`city`,`state`,`notes`,`vc_status`,`p_status`,`contact_status`,`status`,`usertype`,`cus_dt`,`stripe_id`) values(NULL,'".$this->user_email."','".$this->user_pwd."','".$this->first_name."','".$this->last_name."','".$this->phone."','".$this->zip."','".$this->address."','".$this->city."','".$this->state."','".$this->notes."','".$this->vc_status."','".$this->p_status."','".$this->contact_status."','".$this->status."','".$this->usertype."','".$dftdt."','".$this->stripe_id."')";
		$result=mysqli_query($this->conn,$query);	
		$value=mysqli_insert_id($this->conn);
		return $value;
	}
	/* Function for add register customer */
	public function add_customer_register(){
		$query="insert into `".$this->table_name."` (`id`,`user_email`,`user_pwd`,`first_name`,`last_name`,`phone`,`zip`,`address`,`city`,`state`,`notes`,`vc_status`,`p_status`,`contact_status`,`status`,`usertype`,`stripe_id`) values(NULL,'".$this->user_email."','".$this->user_pwd."','".$this->first_name."','".$this->last_name."','".$this->phone."','".$this->zip."','".$this->address."','".$this->city."','".$this->state."','".$this->notes."','N','N','','E','".$this->usertype."','".$this->stripe_id."')";
		$result=mysqli_query($this->conn,$query);	
		return $result;
	}

	/* Function for update users  */
	public function update_user(){	
	$query="update `".$this->table_name."` set `user_email`='".$this->user_email."',`user_pwd`='".$this->user_pwd."',`first_name`='".$this->first_name."',`last_name`='".$this->last_name."',`phone`='".$this->phone."',`zip`='".$this->zip."',`address`='".$this->address."',`city`='".$this->city."',`state`='".$this->state."',`notes`='".$this->notes."',`vc_status`='".$this->vc_status."',`p_status`='".$this->p_status."',`contact_status`='".$this->contact_status."' ,`status`='".$this->status."', `usertype`='".$this->usertype."' where `id`='".$this->user_id."'";
	$result=mysqli_query($this->conn,$query);
	return $result;
	}

	
	public function readone(){
		$query="select * from `".$this->table_name."` where `id`='".$this->user_id."'";
		$result=mysqli_query($this->conn,$query);
		$value=mysqli_fetch_array($result);
		return $value;
	}

    /* read one data of the guest client by his order_id  */
    public function readoneguest($order){
        $query="select * from `".$this->table_name1."` where `order_id`='".$order."'";
        $result=mysqli_query($this->conn,$query);
        $value=mysqli_fetch_row($result);
        return $value;
    }


    /* Function for login users */
	public function check_login(){
		$query="select * from `".$this->table_name."` where `user_email`='".$this->existing_username."' and `user_pwd`='".$this->existing_password."' and `status`='E'";
		$result=mysqli_query($this->conn,$query);
		$res=mysqli_fetch_row($result);
		return $res;
	}

	/* Function for login users */
	public function check_login_user(){
		$query="SELECT * FROM `".$this->table_name."` WHERE `user_email`='".$this->existing_username."' AND `status`='E'";
		$result=mysqli_query($this->conn,$query);
		$res=mysqli_fetch_row($result);
		return $res;
	}

    /* Function for Display Customer In export page */

    public function display_customer(){
        $query="select * from `".$this->table_name."` where `usertype` like '%client%'";
        $result=mysqli_query($this->conn,$query);
        return $result;
    }

   

    
    /*  display all customers in customers page in admin pane  */
    public function readall(){
        $query  = "select * from `".$this->table_name."`";
        $result=mysqli_query($this->conn,$query);
        return $result;
    }
	/* display customer register email check */
	public function check_customer_email_existing(){
		$query="select * from `".$this->table_name_admin."` where `email`='".$this->user_email."'";
        $result=mysqli_query($this->conn,$query);
		$value = mysqli_fetch_array($result);
		if(mysqli_num_rows($result)>0){
        return $value[0];
		}else{
		$query2="select * from `".$this->table_name."` where `user_email`='".$this->user_email."'";
		$result_user=mysqli_query($this->conn,$query2);
		$value1 = mysqli_fetch_array($result_user);
		return $value1[0];
		}
	}
    /* display total bookings of the users */
    public function get_users_totalbookings($userid){
        $query  = "select `order_id` from `ct_bookings` where `client_id` ='".$userid."' GROUP BY `order_id`";
        $result=mysqli_query($this->conn,$query);
        $val=mysqli_num_rows($result);
        return $val;
    }

    /* get service name by client_id */
    public function get_user_bookings()
    {
        $query = "select `ct_bookings`.*,`ct_services`.`title` as `sname`,`ct_payments`.`payment_method` as `c_payment_method`,`ct_services_method`.`method_title` as `c_method_name`
from `ct_bookings`,`ct_services`,`ct_payments`,`ct_services_method`
where `ct_bookings`.`client_id`='".$this->user_id."'
and `ct_bookings`.`service_id` = `ct_services`.`id`
and `ct_bookings`.`method_id` = `ct_services_method`.`id`
and `ct_bookings`.`order_id` = `ct_payments`.`order_id`
GROUP BY `ct_bookings`.`id`, `ct_bookings`.`order_id`, `ct_bookings`.`client_id`, `ct_bookings`.`order_date`, `ct_bookings`.`booking_date_time`, `ct_bookings`.`service_id`, `ct_bookings`.`method_id`, `ct_bookings`.`method_unit_id`, `ct_bookings`.`method_unit_qty`, `ct_bookings`.`method_unit_qty_rate`, `ct_bookings`.`booking_status`, `ct_bookings`.`reject_reason`, `ct_bookings`.`reminder_status`, `ct_bookings`.`lastmodify`, `ct_bookings`.`read_status`, `ct_bookings`.`staff_ids`, `ct_bookings`.`gc_event_id`, `ct_bookings`.`gc_staff_event_id`, `ct_services`.`title`, `ct_payments`.`payment_method`, `ct_services_method`.`method_title` ORDER BY `ct_bookings`.`order_id`";
        $result=mysqli_query($this->conn,$query);
        return $result;
    }

    /* new method for customers page to display customer booking */
    public function get_user_bookingss()
    {
		$query = "select `b`.`booking_status`, `b`.`booking_date_time`, `p`.`order_id`,`s`.`title` as `sname`,`p`.`payment_method` as `c_payment_method`,`p`.`net_amount` as `pna`
from `ct_bookings` as `b`, `ct_services` as `s`, `ct_payments` as `p`,`ct_services_method` as `sm`
where `b`.`client_id`='".$this->user_id."'
and `b`.`service_id` = `s`.`id`
and `b`.`order_id` = `p`.`order_id`
GROUP BY `b`.`booking_status`, `b`.`booking_date_time`, `p`.`order_id`,`s`.`title`,`p`.`payment_method`,`p`.`net_amount` ORDER BY `b`.`order_id`";
        $result=mysqli_query($this->conn,$query);
        return $result;
    }

    public function get_addon_name($order_id)
    {
        $query = "select `ct_booking_addons`.*,`ct_services_addon`.`addon_service_name`
from `ct_booking_addons`,`ct_services_addon`
where
`ct_booking_addons`.`order_id` = '".$order_id."'
and `ct_booking_addons`.`addons_service_id` = `ct_services_addon`.`id`";
                $result=mysqli_query($this->conn,$query);
                return $result;
    }


    /* get all guest users list */
    public function read_all_guestuser(){
        $query = "select `ct_bookings`.`order_id`,`ct_order_client_info`.*
from `ct_bookings`,`ct_order_client_info`
where
`ct_bookings`.`client_id` = 0
and
`ct_bookings`.`order_id` =`ct_order_client_info`.`order_id`
GROUP BY `ct_bookings`.`order_id`, `ct_order_client_info`.`id`, `ct_order_client_info`.`order_id`, `ct_order_client_info`.`client_name`, `ct_order_client_info`.`client_email`, `ct_order_client_info`.`client_phone`, `ct_order_client_info`.`client_personal_info`  ORDER by `ct_bookings`.`order_id`";
        $result=mysqli_query($this->conn,$query);
        return $result;
    }



    /* to get the guest users bookings */
    public function get_bookings_guest($orderid,$email){
        $query = "select `ct_bookings`.*,`ct_services`.`title` as `sname`, `ct_payments`.`payment_method` as `c_payment_method`,`ct_services_method`.`method_title` as `c_method_name`
from `ct_order_client_info`,`ct_bookings`,`ct_services`,`ct_payments`,`ct_services_method`
where `ct_bookings`.`order_id`= '".$orderid."'
and `ct_order_client_info`.`client_email` = '".$email."'
and `ct_bookings`.`service_id` = `ct_services`.`id`
and `ct_bookings`.`method_id` = `ct_services_method`.`id`
and `ct_bookings`.`order_id` = `ct_payments`.`order_id`
and `ct_bookings`.`order_id` = `ct_order_client_info`.`order_id`
GROUP BY `ct_bookings`.`id`, `ct_bookings`.`order_id`, `ct_bookings`.`client_id`, `ct_bookings`.`order_date`, `ct_bookings`.`booking_date_time`, `ct_bookings`.`service_id`, `ct_bookings`.`method_id`, `ct_bookings`.`method_unit_id`, `ct_bookings`.`method_unit_qty`, `ct_bookings`.`method_unit_qty_rate`, `ct_bookings`.`booking_status`, `ct_bookings`.`reject_reason`, `ct_bookings`.`reminder_status`, `ct_bookings`.`lastmodify`, `ct_bookings`.`read_status`, `ct_bookings`.`staff_ids`, `ct_bookings`.`gc_event_id`, `ct_bookings`.`gc_staff_event_id`, `ct_services`.`title`, `ct_payments`.`payment_method`, `ct_services_method`.`method_title` ORDER BY `ct_bookings`.`order_id`";
        $result=mysqli_query($this->conn,$query);
        return $result;
    }


    /* whole new methods for get guest bookings */
    public function get_bookings_guests($orderid,$email){		

        $query = "select `b`.`booking_status`, `b`.`booking_date_time`, `p`.`order_id`,`s`.`title` as `sname`,`p`.`payment_method` as `c_payment_method`,`p`.`net_amount` as `pna`
from `ct_order_client_info` as `oc`,`ct_bookings` as `b`,`ct_services` as `s`, `ct_payments` as `p`
where `oc`.`order_id`= '".$orderid."'
and `oc`.`client_email` = '".$email."'
and `b`.`service_id` = `s`.`id`
and `b`.`order_id` = `p`.`order_id`
and `b`.`order_id` = `oc`.`order_id`
GROUP BY `p`.`order_id`, `b`.`booking_status`, `b`.`booking_date_time`, `s`.`title`,`p`.`payment_method` ,`p`.`net_amount` ORDER BY `b`.`order_id`";
        $result=mysqli_query($this->conn,$query);
        return $result;
    }

    /* get all units */
    public function get_all_bookingsbyorderid($order_id)
    {
        $query = "select * from `ct_bookings` where `order_id` = '".$order_id."'";
        $result=mysqli_query($this->conn,$query);
        return $result;
    }
    public function get_name_unitbyid($unitid){
        $query = "select `units_title` from `ct_service_methods_units` where `id` = '".$unitid."'";
        $result=mysqli_query($this->conn,$query);
        $val=mysqli_fetch_row($result);
        return $val[0];
    }

    public function delete_bookings_guestcustomers($orderid){
        /* bookings */
        $query1 = "delete from `ct_bookings` where `order_id`='".$orderid."'";
        $result=mysqli_query($this->conn,$query1);

        /* booking_addons */
        $query2 = "delete from `ct_booking_addons` where `order_id`='".$orderid."'";
        $result=mysqli_query($this->conn,$query2);

        /* payments */
        $query3 = "delete from `ct_payments` where `order_id`='".$orderid."'";
        $result=mysqli_query($this->conn,$query3);

        /* order_client_info */
        $query4 = "delete from  `".$this->table_name1."` where `order_id`='".$orderid."'";
        $result=mysqli_query($this->conn,$query4);
    }


	
	
	public function check_email(){
	$query="select * from `".$this->table_name_admin."` where `email`='".$this->user_email."'";
        $result_admin=mysqli_query($this->conn,$query);
        if(mysqli_num_rows($result_admin) > 0){
            return $result_admin;
        }
        else
        {
            $query="select * from `".$this->table_name."` where `user_email`='".$this->user_email."'";
            $result_user=mysqli_query($this->conn,$query);
            return $result_user;
        }
	}
	
	public function forget_password(){
		$query = "SELECT `id` as `user_id` FROM  `".$this->table_name."` where `user_email`='".$this->user_email."'";
		$result=mysqli_query($this->conn,$query);
		$res = mysqli_fetch_row($result);
		return $res;
	}
	
	public function update_password(){
		$query = "update `".$this->table_name."`  set `user_pwd`='".md5($this->user_pwd)."'  where `id`='".$this->user_id."'";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
	
    public function get_client_info($orderid){
        $query = "SELECT * FROM  `".$this->table_name1."` where `order_id`='".$orderid."'";
        $result=mysqli_query($this->conn,$query);
        $res = mysqli_fetch_row($result);
        return $res;
    }
	
	public function delete_bookings_registeredcustomers($usersid){
        /* bookings */
        $query1 = "select * from `ct_bookings` where `client_id`='".$usersid."'";
        $result1=mysqli_query($this->conn,$query1);
		
		while( $arr = mysqli_fetch_array ( $result1 ) ){
			/* booking_addons */
			$query2 = "delete from `ct_booking_addons` where `order_id`='".$arr['order_id']."'";
			$result2=mysqli_query($this->conn,$query2);

			/* payments */
			$query3 = "delete from `ct_payments` where `order_id`='".$arr['order_id']."'";
			$result3=mysqli_query($this->conn,$query3);

			/* order_client_info */
			$query4 = "delete from  `".$this->table_name1."` where `order_id`='".$arr['order_id']."'";
			$result4=mysqli_query($this->conn,$query4);
		}
        
		$query5 = "delete from `ct_bookings` where `client_id`='".$usersid."'";
        $result5=mysqli_query($this->conn,$query5);
		
		$query6 = "delete from `ct_users` where `id`='".$usersid."'";
        $result6=mysqli_query($this->conn,$query6);
    }
	
	public function check_login_process(){
		$query="SELECT * FROM `".$this->table_name."` WHERE `user_email`='".$this->existing_username."' AND `user_pwd`='".$this->existing_password."' AND `status`='E'";
		$result=mysqli_query($this->conn,$query);
		if(mysqli_num_rows($result) > 0){
			return $result;
			die;
		}
		$query="SELECT * FROM `".$this->table_name_admin."` WHERE `email`='".$this->existing_username."' AND `password`='".$this->existing_password."'";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
	/* API Functions */
	public function get_payment_order_record(){
        $query="SELECT `cb`.`order_id`,`cb`.`order_date`,`cb`.`booking_date_time`,`cb`.`order_id`,`cs`.`title` as `service_name`,`cp`.`order_id`,`cp`.`payment_method`,`cp`.`transaction_id`,`cp`.`net_amount`,`cp`.`payment_status`,`cp`.`payment_method`,`cp`.`payment_date` FROM `ct_bookings`as `cb`,`ct_services` as `cs`,`ct_payments` as `cp` WHERE `cb`.`client_id` = '".$this->user_id."' AND `cb`.`service_id` = `cs`.`id` AND `cb`.`order_id` = `cp`.`order_id` limit ".$this->limit." offset ".$this->offset;
        $result = mysqli_query($this->conn,$query);
        return $result;
    }
	public function get_staff_payment_order_record(){
        $query="SELECT `cb`.`order_id`,`cb`.`order_date`,`cb`.`booking_date_time`,`cb`.`order_id`,`cs`.`title` as `service_name`,`cp`.`order_id`,`cp`.`payment_method`,`cp`.`transaction_id`,`cp`.`payment_status`,`cp`.`payment_method`,`cp`.`payment_date` FROM `ct_bookings`as `cb`,`ct_services` as `cs`,`ct_payments` as `cp` WHERE `cb`.`staff_ids` = '".$this->user_id."' AND `cb`.`service_id` = `cs`.`id` AND `cb`.`order_id` = `cp`.`order_id`";
        $result = mysqli_query($this->conn,$query);
        return $result;
    }
	public function get_data(){
        $query="select * from new_table";
        $result = mysqli_query($this->conn,$query);
        return $result;
    }																					
	/* API OTP Functions */
	public function readall_opt(){
		$query  = "select * from `".$this->table_otp."` where `email`='".$this->email."' ORDER BY id desc limit 1";
        $result=mysqli_query($this->conn,$query);
		$value1 = mysqli_fetch_array($result);
        return $value1[2];
	
	}
	public function opt_update_status(){
		$query="update `".$this->table_otp."` set `status`='V' where `email`='".$this->email."' and `otp`='".$this->otp."'";
        $result=mysqli_query($this->conn,$query);
        return $result[2];	
	}
	public function forgot_update_password(){
		$query="update `".$this->table_name_admin."` set `password`='".$this->user_pwd."' where `email`='".$this->user_email."'";
		$result=mysqli_query($this->conn,$query);		
		$query1="update `".$this->table_name."` set `user_pwd`='".$this->user_pwd."' where `user_email`='".$this->user_email."'";
		$result=mysqli_query($this->conn,$query1);
		return $result;	
	}
	public function send_otp_using_mail(){
		$query="insert into `".$this->table_otp."` (`id`,`email`,`otp`,`status`) values(NULL,'".$this->user_email."','".$this->user_otp."','NV')";
		$result=mysqli_query($this->conn,$query);	
		return $result;
	}
	public function update_user_stripe_id(){
		$query="update `".$this->table_name."` set `stripe_id`='".$this->stripe_id."' where `id`='".$this->user_id."'";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
}
?>