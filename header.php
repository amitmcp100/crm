<?php
                /* Attempt MySQL server connection. Assuming you are running MySQL
                server with default setting (user 'root' with no password) */
                include("config.php");

                // Check connection
                $store_id = $_SESSION['store_id'];
                $userid=$_SESSION["user_id"];
                // $sql01 = "SELECT *  FROM `system_users` WHERE `u_userid` = '$userid'";
                // $stmt = $DB->prepare($sql01);
                // $stmt->execute();
                // $stmt->setFetchMode(PDO::FETCH_ASSOC);
                
                // while ($row01 = $stmt->fetch()) {  
                
                //     $reg_id=$row01['reguser_id'];
                //     }
                // // Attempt select query execution
                $sql = "SELECT *  FROM `tbl_user_data` WHERE `id` = '$userid'";
                $stmt = $DB->prepare($sql);
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                while ($row = $stmt->fetch()) {  
                
                $logo=$row['logo'];
                $username=$row['username'];
                $first_name=$row['first_name'];
                $last_name=$row['last_name'];
                $business_name=$row['business_name'];
                $address=$row['address'];
                $city=$row['city'];
                $state=$row['state'];
                $usergroup=$row['usergroup'];
                $email=$row['email'];
                $website=$row['website'];
                $contact=$row['contact'];
                $bio=$row['bio'];
                 }
                
                //mysqli_free_result($result);
                
                // Close connection
                //mysqli_close($link);
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
    <title>CRM Dashboard</title>
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

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu" data-col="2-columns">

    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-light bg-info navbar-shadow">
        <div class="navbar-wrapper">
            <div class="navbar-header">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
                    <li class="nav-item"><a class="navbar-brand" href="retailers.php">
                  <?php if(!empty($logo)){?>
                   <img class="brand-logo" alt="modern admin logo" src="users_img/<?=$logo?>">
                   <?php } else { ?>
                    <img class="brand-logo" alt="modern admin logo" src="users_img/profile_sample.png">
                    <?php } ?>    
                            <h3 class="brand-text"><?=$business_name?></h3>
                        </a></li>
                    <li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a></li>
                </ul>
            </div>
            <div class="navbar-container content" style="background-color:#333;">
                <div class="collapse navbar-collapse" id="navbar-mobile">
                    <ul class="nav navbar-nav mr-auto float-left">
                        <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu"></i></a></li>
                        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand" href="#"><i class="ficon ft-maximize"></i></a></li>
                       
                        <li class="nav-item nav-search"><a class="nav-link nav-link-search" href="#"><i class="ficon ft-search"></i></a>
                            <div class="search-input">
                                <input class="input" type="text" placeholder="Explore Modern...">
                            </div>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav float-right">
                       <!--  <li class="dropdown dropdown-language nav-item"><a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flag-icon flag-icon-gb"></i><span class="selected-language"></span></a>
                            <div class="dropdown-menu" aria-labelledby="dropdown-flag"><a class="dropdown-item" href="#"><i class="flag-icon flag-icon-gb"></i> English</a><a class="dropdown-item" href="#"><i class="flag-icon flag-icon-fr"></i> French</a><a class="dropdown-item" href="#"><i class="flag-icon flag-icon-cn"></i> Chinese</a><a class="dropdown-item" href="#"><i class="flag-icon flag-icon-de"></i> German</a></div>
                        </li> -->
                        <?php
                        //include("configinc2.php"); 
                        $cu_date=date("m-d");
						//Birthday
						$sqlbirthday = "SELECT count(id) as bid FROM `tbl_customer_data` WHERE `dob` LIKE '%$cu_date%'";
                        $stmt = $DB->prepare($sqlbirthday);
                        $stmt->execute();
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        
                        while ($bith = $stmt->fetch()) {  
						
						$birthday=$bith['bid'];
						}
						

						//anniversary
						$sqlann = "SELECT count(id) as aid FROM `tbl_customer_data` WHERE `anniversary` LIKE '%$cu_date%'";
                        $stmt = $DB->prepare($sqlann);
                        $stmt->execute();
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                       
                        while ($ann = $stmt->fetch()) {  
						
						$anniversary=$ann['aid'];
						}
						
                        ?>
                        <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon ft-bell"></i><span class="badge badge-pill badge-danger badge-up badge-glow"><?php echo $birthday+$anniversary; ?></span></a>
                            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right" style="height: 250px;overflow-x: scroll;">
                                <li class="dropdown-menu-header">
                                    <h6 class="dropdown-header m-0"><span class="grey darken-2">Notifications</span></h6><span class="notification-tag badge badge-danger float-right m-0"><?php echo $birthday+$anniversary; ?> New</span>
                                </li>
                                <?php 
								$sqlbirthday1 = "SELECT *  FROM `tbl_customer_data` WHERE  `dob` LIKE '%$cu_date%'";
                                $stmt = $DB->prepare($sqlbirthday1);
                                $stmt->execute();
                                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                               
                                while ($birth1 = $stmt->fetch()) { 
								$c_name=$bith1['name'];
								$c_mobile=$bith1['mobile'];
								?>
                                <li class="scrollable-container media-list w-100"><a href="javascript:void(0)">
                                        <div class="media">
                                            <div class="media-left align-self-center"><i class="ft-plus-square icon-bg-circle bg-yellow"></i></div>
                                            <div class="media-body">
                                                <h6 class="media-heading yellow darken-3">Bithday Notification</h6>
                                                <p class="notification-text font-small-3 text-muted"><strong><?php echo $c_name."</strong> have today birthday";?></p><small>
                                                    <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00"><?php echo "Customer Mobile : ".$c_mobile;?></time></small>
                                            </div>
                                        </div>
                                   
                                    </a></li>
                                <?php } ?>
                                 <?php 
								$sqlann1 = "SELECT * FROM `tbl_customer_data` WHERE `anniversary` LIKE '%$cu_date%'";
                                $stmt = $DB->prepare($sqlann1);
                                $stmt->execute();
                                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                               
                                while ($ann1 = $stmt->fetch()) { 
						
								$c_name1=$ann1['name'];
								$c_mobile1=$ann1['mobile'];
								?>
                                <li class="scrollable-container media-list w-100"><a href="javascript:void(0)">
                                        <div class="media">
                                            <div class="media-left align-self-center"><i class="ft-plus-square icon-bg-circle bg-red"></i></div>
                                            <div class="media-body">
                                                <h6 class="media-heading red darken-3">Anniversary Notification</h6>
                                                <p class="notification-text font-small-3 text-muted"><strong><?php echo $c_name1."</strong> have today Anniversary";?></p><small>
                                                    <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00"><?php echo "Customer Mobile : ".$c_mobile1;?></time></small>
                                            </div>
                                        </div>
                                   
                                    </a></li>
                                <?php } ?>

                               
                            </ul>
                        </li>
                        <?php
                        $sqlfee = "SELECT count(id) as fid FROM `tbl_feedback` WHERE `read` = 'no'";
                        $stmt = $DB->prepare($sqlfee);
                        $stmt->execute();
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                       
                        while ($feed = $stmt->fetch()) { 
						
						$feedcount=$feed['fid'];
						//echo "Feedback".$sqlfee;
						}
						
                        ?>
                        <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon ft-mail"> </i><span class="badge badge-pill badge-danger badge-up badge-glow"><?php echo $feedcount;?></span></a>
                            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right" style="height: 250px;overflow-x: scroll;">
                                <li class="dropdown-menu-header">
                                    <h6 class="dropdown-header m-0"><span class="grey darken-2">Messages</span></h6><span class="notification-tag badge badge-warning float-right m-0"><?php echo $feedcount;?> Feedback</span>
                                </li>
                               <?php
                        $sqlfee1 = "SELECT *  FROM `tbl_feedback` WHERE `read` = 'no'";
                        $stmt = $DB->prepare($sqlfee1);
                        $stmt->execute();
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                       
                        while ($feed1 = $stmt->fetch()) { 
						
						$f_name=$feed1['name'];
						$f_mobile=$feed1['mobile'];
						$f_date=$feed1['date'];
						
                        ?>
                                <li class="scrollable-container media-list w-100"><a href="javascript:void(0)">
                                        <div class="media">
                                            <div class="media-left"><span class="avatar avatar-sm avatar-online rounded-circle"><img src="users_img/profile_sample.png" alt="avatar"><i></i></span></div>
                                            <div class="media-body">
                                                <h6 class="media-heading"><?php echo $f_name;?></h6>
                                                <p class="notification-text font-small-3 text-muted">GiveSubmit Feedback</p><small>
                                                    <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Date : <?php echo $f_date;?></time></small>
                                            </div>
                                        </div>
                                    </a></li><?php } ?>
                                <li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center" href="feedback.php">Read all messages</a></li>
                            </ul>
                        </li>
                        <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown"><span class="mr-1 user-name text-bold-700"><?php echo $first_name." ".$last_name; ?></span><span class="avatar avatar-online">
                        <?php if(!empty($logo)){?>
                         <img src="users_img/<?php echo $logo; ?>"  alt="avatar">
<?php } else{?>             <img src="users_img/profile_sample.png"  alt="avatar"><?php }?>                         <i></i></span></a>
                            <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="profile.php"><i class="ft-user"></i> Edit Profile</a>
                                <div class="dropdown-divider"></div><a class="dropdown-item" href="logout.php"><i class="ft-power"></i> Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>