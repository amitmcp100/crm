<?php
require_once("config.php");

if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] != "") {
    // if logged in send to dashboard page
    redirect("retailers.php");
}
$title = "Register";
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
    <meta name="author" content= "PIXINVENT">
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
<style type="text/css">
    /* Response */
.response{
    padding: 6px;
    display: none;
}

.not-exists{
    color: red; 
}

.exists{
    color: green;
}
</style>

       <img src="login_bg.jpg" style="width: 90%;">
        </div>
        <div class="col-md-4" style="margin-left:-28px;">
        <div>
                            <div class="">
                                <div class="card-header border-0">
                                    <div class="card-title text-center" >
                                       <h1><b>Loire Technologies</b></h1>
                                    </div>
                                   
                                </div>
                                <!-- Warning message  -->
                                    <?php if ($ERROR_MSG <> "") { ?>
                                    <div class="alert alert-warning mb-2" role="alert">
                                    <strong>Success!</strong> <?php echo $ERROR_MSG ?>
                                    </div>
                                    <?php }  ?>
                            
               
                                <div class="card-content">
                                    
                                   
                                    <div class="card-body">
                                        <form class="form-horizontal" method="post" action="register_code.php" novalidate>
                                         <input type="hidden" name="mode" value="login" >
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type="text" class="form-control" id="username" placeholder="Your Username" name="username" value="" required>
                                                <div class="form-control-position">
                                                    <i class="ft-user"></i>
                                                </div>
                                                 <div id="uname_response" class="response"></div>
                                            </fieldset>

                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type="text" class="form-control" id="name" placeholder="Enter your Name" name="name" required="">
                                                <div class="form-control-position">
                                                    <i class="ft-user"></i>
                                                </div>
                                            </fieldset>
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type="text" class="form-control" id="email" placeholder="Enter your eMail ID" name="email" required="">
                                                <div class="form-control-position">
                                                    <i class="ft-mail"></i>
                                                </div>
                                            </fieldset>

                                             <fieldset class="form-group position-relative has-icon-left">
                                                <input type="text" class="form-control" id="mobile" placeholder="Enter your Nobile No" name="mobile" required="">
                                                <div class="form-control-position">
                                                    <i class="ft-phone"></i>
                                                </div>
                                            </fieldset>

                                            <fieldset class="form-group position-relative has-icon-left">
                                            <input type="password" class="form-control" id="user-password" placeholder="Provide Password" name="user_password" required="">
                                                <div class="form-control-position">
                                                    <i class="la la-key"></i>
                                                </div>
                                            </fieldset>

                                            <div class="form-group row">
                                            <div class="col-sm-6 col-12 float-sm-left text-center text-sm-left"><a href="register.php" class="card-link">Forgot Password?</a></div>
                                                <div class="col-sm-6 col-12 float-sm-left text-center text-sm-right"><a href="index.php" class="card-link">Login</a></div>
                                            </div>
                                            <button disabled id="submit" type="submit" class="btn btn-outline-info btn-block" name="submit" value="Submit"><i class="ft-unlock"></i>Register</button>
                                        </form>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                         </div>
        <!--End Login Form-->
       
   </div>
   </div>
 <script src="app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

  
</body>
<!-- END: Body-->
</html>

<script type="text/javascript">
    $(document).ready(function(){
       $("#uname_response").hide();
        $("#username").keyup(function(){
           //a alert('helll');
            var uname = $("#username").val().trim();
            if(uname != ''){
                $("#uname_response").show();

                $.ajax({
                    url: 'uname_check.php',
                    type: 'post',
                    data: {uname:uname},
                    success: function(response){
                      ///console.log(response);

                        if(response > 0) {
                              
                            $("#uname_response").html("<span class='not-exists'>* Username Already in use.</span>");
                            $("#submit").prop('disabled' ,  true);
                        } else {
                            $("#uname_response").html("<span class='exists'>Available</span>");
                            $("#submit").prop('disabled', false);
                        }
                    }
                });

            } else {
               $("#uname_response").hide();
            }
        });
    });

</script>