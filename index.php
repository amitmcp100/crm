<?php
require_once("config.php");

if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] != "") {
    // if logged in send to dashboard page
    redirect("retailers.php");
}

$title = "Login";
$mode = $_REQUEST["mode"];
if ($mode == "login") {
    $username = trim($_POST['username']);
    $pass = trim($_POST['user_password']);

    if ($username == "" || $pass == "") {

        $_SESSION["errorType"] = "danger";
        $_SESSION["errorMsg"] = "Enter manadatory fields"; 
    } else {
        $sql = "SELECT * FROM `tbl_user_data` WHERE `username` = :uname AND  `password` = :upass ";

        try {
            $stmt = $DB->prepare($sql);

            // bind the values
            $stmt->bindValue(":uname", $username);
            $stmt->bindValue(":upass", $pass);

            // execute Query
            $stmt->execute();
            $results = $stmt->fetchAll();

            if (count($results) > 0) {
                $_SESSION["errorType"] = "success";
                $_SESSION["errorMsg"] = "You have successfully logged in.";

                $_SESSION["user_id"] = $results[0]["id"];
                $_SESSION["rolecode"] = $results[0]["roles_name"];
                $_SESSION["username"] = $results[0]["username"];
                $_SESSION["store_id"] = $results[0]["store_id"];

                redirect("retailers.php");
                exit;
            } else {
                $_SESSION["errorType"] = "info";
                $_SESSION["errorMsg"] = "username or password does not exist.";
            }
        } catch (Exception $ex) {

            $_SESSION["errorType"] = "danger";
            $_SESSION["errorMsg"] = $ex->getMessage();
        }
    }
    redirect("index.php");
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
    <title>Login with Background Image - Modern Admin - Clean Bootstrap 4 Dashboard HTML Template + Bitcoin Dashboard</title>
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
                                         <input type="hidden" name="mode" value="login" >
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type="text" class="form-control" id="user-name" placeholder="Your Username" name="username" required="">
                                                <div class="form-control-position">
                                                    <i class="ft-user"></i>
                                                </div>
                                            </fieldset>
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type="password" class="form-control" id="user-password" placeholder="Enter Password" name="user_password" required="">
                                                <div class="form-control-position">
                                                    <i class="la la-key"></i>
                                                </div>
                                            </fieldset>
                                            <div class="form-group row">
                                            <div class="col-sm-6 col-12 float-sm-left text-center text-sm-left"><a href="register.php" class="card-link">Register New</a></div>
                                                <div class="col-sm-6 col-12 float-sm-left text-center text-sm-right"><a href="#" class="card-link">Forgot Password?</a></div>
                                            </div>
                                            <button type="submit" class="btn btn-outline-info btn-block"><i class="ft-unlock"></i> Login</button>
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