<?php
require_once("config.php");

if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] != "") {
    // if logged in send to dashboard page
    redirect("retailers.php");
}

$title = "Forgot Password";
$mode = $_REQUEST["mode"];
if ($mode == "forgot") {
    $mobileno = trim($_POST['mobileno']);
    if ($mobileno == "" ) {
        $_SESSION["errorType"] = "danger";
        $_SESSION["errorMsg"] = "Enter manadatory fields"; 
    } else {
       // $sql = "SELECT * FROM `tbl_user_data` WHERE `username` = :uname AND  `password` = :upass ";
        $sql = "SELECT * FROM `tbl_user_data` WHERE `contact` = :contact";

        try {
            $stmt = $DB->prepare($sql);

            // bind the values
            $stmt->bindValue(":contact", $mobileno);
           // $stmt->bindValue(":upass", $pass);
            // execute Query
            $stmt->execute();
            $results = $stmt->fetchAll();

            if (count($results) > 0) {
                $store_id   = $results[0]['store_id'];
                $username   = $results[0]["username"];
                $mobileno   = $results[0]["contact"];
                $first_name = $results[0]['first_name'];
                $password = $results[0]['password'];
                /// Get SMS dtails 
                $sql1 = "SELECT *  FROM `creditsms` WHERE `store_id` = '$store_id'";
                $stmt = $DB->prepare($sql1);
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                while ($row1 = $stmt->fetch()) {
                $available_sms=$row1['available_sms'];
                $used_sms=$row1['used_sms'];
                }

                $sql2 = "SELECT *  FROM `tbl_user_group` WHERE `store_id` = '$store_id' and  `parent_id` ='0'";
                //echo $sql2;
                $stmt = $DB->prepare($sql2);
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                while ($row2 = $stmt->fetch()) {
                $sender_id=$row2['sender_id'];
                }
                // If sms available in acoount.
                if($available_sms>'1'){
                  $sms_text = "Dear ".$first_name." Here are you login details:".PHP_EOL;
                  $sms_text .= "Login ID: ".$username.PHP_EOL;
                  $sms_text .= "Password: ".$password;
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                    CURLOPT_URL => "http://msg160.com/sendsms/send1_post",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"userid\"\r\n\r\nyogesh\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"pass\"\r\n\r\n12345678\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"sender\"\r\n\r\n".$sender_id."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"mobile\"\r\n\r\n".$mobileno."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"message\"\r\n\r\n".$sms_text."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"route\"\r\n\r\n5\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
                    CURLOPT_HTTPHEADER => array(
                    "cache-control: no-cache",
                    "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
                    "postman-token: 2e642de6-bd3c-1d3f-b5ce-3acd25867c5b"
                    ),
                    ));

                    $response = curl_exec($curl);
                    // echo "sss".$sender_id;echo "</br>";
                    // echo $sender_id;echo "</br>";
                    // echo $response;
                    // exit;
                } else {
                 $_SESSION["errorType"] = "danger";
                $_SESSION["errorMsg"] = "SMS not available.";
                redirect("forgot_password.php");
                exit;
                } 
               if($response=='sms sent successfully'){
                $update_sms=$available_sms-1;
                $u_sms=$used_sms+1;
                $query="UPDATE `creditsms` SET `used_sms` = '$u_sms',`available_sms` = '$update_sms' WHERE `store_id` = '$store_id'";
                $stmt = $DB->prepare($query);
                $stmt->execute();


                $query011="INSERT INTO `sms_report` (`id`,`store_id`,`message`,`mobile`,`from_date`, `to_date`, `state`,`operator`, `status`, `send`,`update_on`) VALUES (NULL,'$store_id','$sms_text','$mobile','$create_date','$create_date', '1','operator','active','yes','on')";
                $stmt = $DB->prepare($query011);
                $stmt->execute();
                $_SESSION["errorType"] = "success"; 
                $_SESSION["errorMsg"] = "Password has been sent to your mobile number.";
                
                } else {
                $_SESSION["errorType"] = "danger"; 
                $_SESSION["errorMsg"] = "oops something went wrong try again later.";
                }
                // $_SESSION["user_id"] = $results[0]["id"];
                // $_SESSION["rolecode"] = $results[0]["roles_name"];
                // $_SESSION["username"] = $results[0]["username"];
                // $_SESSION["store_id"] = $results[0]["store_id"];

                redirect("index.php");
                exit;
            } else {
                $_SESSION["errorType"] = "danger";
                $_SESSION["errorMsg"] = "Mobile number does not exist.";
            }
        } catch (Exception $ex) {

            $_SESSION["errorType"] = "danger";
            $_SESSION["errorMsg"] = $ex->getMessage();
        }
    }
    redirect("forgot_password.php");
}

?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
    <meta name="keywords" content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
    <meta name="author" content="PIXINVENT">
    <title><?=$title?></title>
    <link rel="apple-touch-icon" href="app-assets/images/ico/apple-icon-120.png">
    <link rel="icon" href="https://www.loiretechnologies.com/wp-content/uploads/2019/05/logo-fav.png" sizes="32x32" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/forms/icheck/icheck.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/forms/icheck/custom.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/components.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/pages/login-register.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body style="background:linear-gradient(to bottom, #000 0%,#333 100%)">
    <!-- BEGIN: Content-->
    <div class="container container-bg" style="margin-top:1em;">
   <div class="row" style="box-shadow: 3px 3px 3px 3px #333;;
  margin-top:3em;
  background:#fff;">
        
        
        <!--Login Form-->

        <div class="col-md-8" style="margin-top: 0em;
    flex-direction: column;
    right: 0;left:0;
    color: #fff;
    line-height: 2;
    background-size: cover;
    font-weight: unset;
    text-shadow: 1px 1px 5px #19718a;padding-left:0px !important;">
       <img src="login_bg.jpg" style="width: 90%;">
        </div>
        <div class="col-md-4" style="margin-left:-28px;">
        <div>
                            <div class="">
                                <div class="card-header border-0">
                                    <div class="card-title text-center">
                                        <!--<img src="images/akshay-salon.jpg" alt="branding logo">-->
                                        <h1><b>Loire Technologies</b></h1>
                                    </div>
                                   
                                </div>
                                        <!--  for warnings messages -->
                                        <?php if ($ERROR_MSG <> "" && $ERROR_TYPE == 'danger') { ?>
                                        <div class="alert alert-warning mb-2" role="alert">
                                        <strong>Warning!</strong> <?php echo $ERROR_MSG ?>.
                                        </div><?php } ?>
                                        <!-- for success messages -->
                                        <?php if ($ERROR_MSG <> "" && $ERROR_TYPE == 'success') { ?>
                                        <div class="alert alert-success mb-2" role="alert">
                                        <strong>Warning!</strong> <?php echo $ERROR_MSG ?>.
                                        </div><?php } ?>

                                <div class="card-content">
                                     
                                   
                                    <div class="card-body">
                                        <form class="form-horizontal" method="post" action="" novalidate>
                                         <input type="hidden" name="mode" value="forgot" >
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type="text" class="form-control" id="mobileno" placeholder="Enter your mobile number" name="mobileno" required="">
                                                <div class="form-control-position">
                                                    <i class="ft-user"></i>
                                                </div>
                                            </fieldset>
                                            
                                            <div class="form-group row">
                                            <div class="col-sm-6 col-12 float-sm-left text-center text-sm-left"><a href="register.php" class="card-link">Register New</a></div>
                                                <div class="col-sm-6 col-12 float-sm-left text-center text-sm-right"><a href="index.php" class="card-link">Login</a></div>
                                            </div>
                                            <button type="submit" class="btn btn-outline-info btn-block"><i class="ft-unlock"></i> Reset Password</button>
                                        </form>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                         </div>
        <!--End Login Form-->
       
   </div>
   </div>
</body>
<!-- END: Body-->

</html>