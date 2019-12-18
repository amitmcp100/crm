<?php
                /* Attempt MySQL server connection. Assuming you are running MySQL
                server with default setting (user 'root' with no password) */
                include("config.php");

                // Check connection
                
                $userid=$_SESSION["user_id"];
                $sql01 = "SELECT *  FROM `system_users` WHERE `u_userid` = '1'";
                $stmt = $DB->prepare($sql01);
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                while ($row01 = $stmt->fetch()) {
                    $reg_id=$row01['reguser_id'];
                    }
                // Attempt select query execution
                $sql = "SELECT *  FROM `tbl_user_data` WHERE `id` = '$reg_id'";
                $stmt = $DB->prepare($sql);
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                while ($row = $stmt->fetch()) {
                
               
                $business_name=$row['business_name'];
                
                 }
                
                //mysqli_free_result($result);
                
                // Close connection
                //mysqli_close($link);
                ?><!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
    <meta name="keywords" content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
    <meta name="author" content="PIXINVENT">
    <title><?php echo $business_name; ?> - Feedback</title>
    <link rel="apple-touch-icon" href="app-assets/images/ico/apple-icon-120.png">
    <link rel="icon" href="https://www.loiretechnologies.com/wp-content/uploads/2019/05/logo-fav.png" sizes="32x32" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/weather-icons/climacons.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/fonts/meteocons/style.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/charts/morris.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/charts/chartist.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/charts/chartist-plugin-tooltip.css">
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
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/cryptocoins/cryptocoins.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- END: Custom CSS-->
<script>
    function closeWindow() {
        window.open('','_parent','');
        window.close();
    }
</script> 
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu" data-col="2-columns">

    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-light bg-info navbar-shadow">
        <div class="navbar-wrapper">
            
            <div class="container">
                <div class="collapse navbar-collapse" id="navbar-mobile">
                    
                    <ul class="nav navbar-nav float-right">
                       <!--  <li class="dropdown dropdown-language nav-item"><a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flag-icon flag-icon-gb"></i><span class="selected-language"></span></a>
                            <div class="dropdown-menu" aria-labelledby="dropdown-flag"><a class="dropdown-item" href="#"><i class="flag-icon flag-icon-gb"></i> English</a><a class="dropdown-item" href="#"><i class="flag-icon flag-icon-fr"></i> French</a><a class="dropdown-item" href="#"><i class="flag-icon flag-icon-cn"></i> Chinese</a><a class="dropdown-item" href="#"><i class="flag-icon flag-icon-de"></i> German</a></div>
                        </li> -->
                       
                        <li class="dropdown dropdown-user nav-item">
                        
                        <span class="avatar avatar-online">
                                                  
                         </span>
                        
                           <span class="mr-1 user-name text-bold-700" style="
    font-size: 30px;
    color: #fff;
"><?php echo  $business_name;?></span>    
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- BEGIN: Main Menu-->

<?php //include('sidebar.php');?>    
    <!-- END: Main Menu-->
    <!-- BEGIN: Content-->
   <div class="container">
        <div class="content-wrapper">
            <div class="content-header row mb-1">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    
                    
                </div>
                
                
            </div>
            <div class="row ">
                  
                <?php if($_GET['data']=='update'){?> 
                     <div class="alert btn-success mb-2" role="alert">
                                            <strong>Thanks For Your Feedback !</strong> 
                                             
                                        </div>

                    <?php } ?>
                   
                
                </div>
                 <?php if($_GET['data']!='update'){?> 
            <div class="content-body">
                
                <section id="horizontal-form-layouts">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="horz-layout-colored-controls">Give your feedback</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collpase show">
                                    <div class="card-body">
                                    
                                        <form class="form form-horizontal" action="feedback_save.php" method="post">
                                        
                                       
                                            <div class="form-body">
                                               
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput1" >Mobile No.</label>
                                                            <div class="col-md-9 mx-auto">
                                                              
                                                              <input type="text" id="userinput1" class="form-control border-primary" placeholder="Mobile Number" name="mobile"  required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput2">Name</label>
                                                            <div class="col-md-9 mx-auto">
                                                                
                                                                 <input type="text" id="name" class="form-control border-primary" placeholder="Name" name="name" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput4">Ratings</label>
                                                            
                                                            <div class="col-md-9 mx-auto">
                                                                <div class="input-group">
                                                                <div class="d-inline-block custom-control custom-radio mr-1">
                                                                <input type="radio" name="mode" class="custom-control-input" value="Excellent" id="purchase" checked>
                                                                <label class="custom-control-label" for="purchase" >Excellent</label>
                                                                </div>
                                                                <div class="d-inline-block custom-control custom-radio  mr-1">
                                                                <input type="radio" name="mode" value="Good"  class="custom-control-input" id="Good" >
                                                                <label class="custom-control-label" for="Good">Good</label>
                                                                </div>
                                                                <div class="d-inline-block custom-control custom-radio  mr-1">
                                                                <input type="radio" name="mode" value="Average"  class="custom-control-input" id="Average" >
                                                                <label class="custom-control-label" for="Average">Average</label>
                                                                </div>
                                                                <div class="d-inline-block custom-control custom-radio">
                                                                <input type="radio" name="mode" value="Poor"  class="custom-control-input" id="Poor" >
                                                                <label class="custom-control-label" for="Poor">Poor</label>
                                                                </div>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        
                                                    </div>
                                                   
                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput8">Feedback</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <textarea id="comment" rows="6" class="form-control border-primary" name="comment" placeholder="Feedback"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                     
                                                </div>
                                                 <div class="form-actions text-right">
                                                <button type="button" class="btn btn-warning mr-1">
                                                    <i class="ft-x"></i> Cancel
                                                </button>
                                                <button type="submit" class="btn btn-primary" name="submit" value="Submit">
                                                    <i class="la la-check-square-o"></i> Save
                                                </button>
                                            </div>
                                               
                                        </form>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                   
                </section>
                <!-- // Basic form layout section end -->
            </div><?php } ?>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    
    <!-- END: Footer-->

 
    <!-- BEGIN: Vendor JS-->
    <script src="app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="app-assets/vendors/js/charts/chart.min.js"></script>
    <script src="app-assets/vendors/js/charts/echarts/echarts.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="app-assets/js/core/app-menu.js"></script>
    <script src="app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="app-assets/js/scripts/pages/dashboard-crypto.js"></script>
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>
