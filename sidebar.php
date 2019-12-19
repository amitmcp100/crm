<?php 
$cur_page=basename($_SERVER['PHP_SELF']);
$userid=$_SESSION["user_id"];
//echo $userid;
include("config.php");
// $sql01 = "SELECT *  FROM `system_users` WHERE `u_userid` = '$userid'";
// $stmt = $DB->prepare($sql01);
// $stmt->execute();
// $stmt->setFetchMode(PDO::FETCH_ASSOC);
// while ($row01 = $stmt->fetch()) { 
// $uid=$row01['reguser_id'];
// }

$store_id = $_SESSION['store_id']; 

$sql02 = "SELECT *  FROM `tbl_user_data` WHERE `id` = '$userid' and `store_id` = '$store_id'";
$stmt = $DB->prepare($sql02);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
while ($row02 = $stmt->fetch()) { 
$rolename=$row02['roles_name'];
}

if($rolename!='superadmin'){
    $sql03 = "SELECT *  FROM `tbl_user_roles` WHERE `id` = '$rolename' and  `store_id` = '$store_id'";
    $stmt = $DB->prepare($sql03);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    while ($row03 = $stmt->fetch()) { 
        $customer=$row03['customer'];
        $add_customer=$row03['add_customer'];
        $add_campaign=$row03['add_campaign'];
        $all_campaign=$row03['all_campaign'];
        $all_sub_user=$row03['all_sub_user'];
        $birthday=$row03['birthday'];
        $anniversary=$row03['anniversary'];
        $feedback=$row03['feedback'];
        $loyality=$row03['loyality'];
        $lost_business=$row03['lost_business'];
        $packages=$row03['packages'];
       
    }
    

}

$cu_date=date("m-d");
//Birthday
$sqlbirthday = "SELECT count(id) as bid FROM `tbl_customer_data` WHERE `dob` LIKE '%$cu_date%' and `store_id` = '$store_id'";
$stmt = $DB->prepare($sqlbirthday);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
while ($birth = $stmt->fetch()) { 
$birthday=$bith['bid'];
}


//anniversary
$sqlann = "SELECT count(id) as aid FROM `tbl_customer_data` WHERE `anniversary` LIKE '%$cu_date%' and `store_id`='$store_id'";
$stmt = $DB->prepare($sqlann);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
while ($ann = $stmt->fetch()) { 
$anniversary=$ann['aid'];
}


if($rolename=='superadmin'){

?>
<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class=" nav-item"><a href="retailers.php"><img src="icon/home.png"> <span class="menu-title" data-i18n="nav.dash.main">Dashboard</span></a>
                    
                </li>
                <!--**********************************  services  *********************************** -->
                <li class=" nav-item"><a href="#"><img src="icon/services.png"> <span class="menu-title" data-i18n="nav.templates.main">Services</span></a>
                    <ul class="menu-content">
                        <li class="<?php if($cur_page=='add-services.php'){echo "active";}?>"><a class="menu-item " href="add-services.php"><img src="icon/servicesadd.png"> <span data-i18n="nav.templates.vert.main">Add Services</span></a>
                        </li>
                        <li  class="<?php if($cur_page=='all-services.php'){echo "active";}?>"><a class="menu-item" href="all-services.php"><img src="icon/servicesall.png"> <span data-i18n="nav.templates.vert.main">All Services</span></a>
                        </li> 
                                                                
                    </ul>
                </li>
                <!--********************************************* Packages *******************************  -->
                <li class=" nav-item"><a href="#"><img src="icon/packages.png"> <span class="menu-title" data-i18n="nav.templates.main">Packages</span></a>
                    <ul class="menu-content">
                        <li  class="<?php if($cur_page=='addpackage.php'){echo "active";}?>"><a class="menu-item" href="addpackage.php"> <span data-i18n="nav.templates.vert.main">Add Packages</span></a>
                        </li>
                        <li  class="<?php if($cur_page=='all-packages.php'){echo "active";}?>"><a class="menu-item" href="all-packages.php"> <span data-i18n="nav.templates.vert.main">All Packages</span></a>
                        </li>
                         <li  class="<?php if($cur_page=='sellpackages.php'){echo "active";}?>"><a class="menu-item" href="sellpackages.php"> <span data-i18n="nav.templates.vert.main">Sell Packages</span></a>
                        </li> 
                        <li  class="<?php if($cur_page=='redeempack.php'){echo "active";}?>"><a class="menu-item" href="redeempack.php"> <span data-i18n="nav.templates.vert.main">Redeem Packages</span></a>
                        </li> 
                          <li  class="<?php if($cur_page=='packagereport.php'){echo "active";}?>"><a class="menu-item" href="packagereport.php"> <span data-i18n="nav.templates.vert.main">Packages Report</span></a>
                        </li> 
                         <!-- <li><a class="menu-item" href="#"> <span data-i18n="nav.templates.vert.main">Service Report</span></a>
                        </li> -->
                         <!-- <li><a class="menu-item" href="#"> <span data-i18n="nav.templates.vert.main">Package Setting</span></a>
                        </li>  -->
                                                                
                    </ul>
                </li>
                <!---********************************Product  ***********************************************-->

                <li style="background-color:black" class=" nav-item"><a href="#"><img src="icon/services.png"> <span class="menu-title" data-i18n="nav.templates.main">Product</span></a>
                    <ul class="menu-content">
                        <li style="background-color:black" class="<?php if($cur_page=='add-product.php'){echo "active";}?>"><a class="menu-item " href="add-product.php"><img src="icon/servicesadd.png"> <span data-i18n="nav.templates.vert.main">Add Product</span></a>
                        </li>
                        <li style="background-color:black" class="<?php if($cur_page=='view-product.php'){echo "active";}?>"><a class="menu-item" href="view-product.php"><img src="icon/servicesall.png"> <span data-i18n="nav.templates.vert.main">View Product</span></a>
                        </li> 
                                                                
                    </ul>
                </li>

                <li class=" nav-item"><a href="#"><img src="icon/customers.png"> <span class="menu-title" data-i18n="nav.templates.main">Customers</span></a>
                    <ul class="menu-content">
                        <li class="<?php if($cur_page=='customer-view.php'){echo "active";}?>"><a class="menu-item" href="customer-view.php"><img src="icon/customers.png"> <span data-i18n="nav.templates.vert.main">All Customers</span></a>
                        </li>
                        <li class="<?php if($cur_page=='import-customer.php'){echo "active";}?>"><a class="menu-item" href="import-customer.php"><img src="icon/importcoustomer.png"> <span data-i18n="nav.templates.vert.main">Import Customer</span></a>
                        </li>
                        <li class="<?php if($cur_page=='export-customer.php'){echo "active";}?>"><a class="menu-item" href="export-customer.php"><img src="icon/exportcoustomer.png"> <span data-i18n="nav.templates.vert.main">Export Customer</span></a>
                        </li>
                        <li class="<?php if($cur_page=='customer-group.php'){echo "active";}?>"><a class="menu-item" href="customer-group.php"><img src="icon/groupcoustomer.png"> <span data-i18n="nav.templates.vert.main">Customer Groups</span></a>
                        </li>
                        <li class="<?php if($cur_page=='customer-reminder.php'){echo "active";}?>"><a class="menu-item" href="customer-reminder.php"><img src="icon/loyaltysetting.png"> <span data-i18n="nav.templates.vert.main">Customers Reminder</span></a>
                        </li>
                        <li class="<?php if($cur_page=='reminder-setting.php'){echo "active";}?>"><a class="menu-item" href="reminder-setting.php"><img src="icon/loyaltysetting.png"><span data-i18n="nav.templates.vert.main"> Reminder Setting</span></a>
                        </li>
                        
                    </ul>
                </li>

                 <li class=" nav-item"><a href="#"><i class="la la-edit"></i> <span class="menu-title" data-i18n="nav.templates.main">Appoinment</span></a>
                    <ul class="menu-content">
                        <li class="<?php if($cur_page=='add-appoinment.php'){echo "active";}?>"><a class="menu-item" href="add-appoinment.php"><i class="fa fa-calendar"></i> <span data-i18n="nav.templates.vert.main">Add Appoinment</span></a>
                        </li>
                        <li  class="<?php if($cur_page=='view-appoinment.php'){echo "active";}?>"><a class="menu-item" href="view-appoinment.php"><i class="fa fa-calendar"></i> <span data-i18n="nav.templates.vert.main">View Appoinment</span></a>
                        </li>
                          <li class="<?php if($cur_page=='add-employee.php'){echo "active";}?>"><a class="menu-item" href="add-employee.php"><i class="fa fa-calendar"></i> <span data-i18n="nav.templates.vert.main">Add Employee</span></a>
                        </li>
                        <li class="<?php if($cur_page=='employee-view.php'){echo "active";}?>"><a class="menu-item" href="employee-view.php"><i class="fa fa-calendar"></i> <span data-i18n="nav.templates.vert.main">View Employee</span></a>
                        </li>
                                            

                        
                    </ul>
                </li>


                <li class="nav-item <?php if($cur_page=='add-customer.php'){echo "active";}?>"><a href="add-customer.php"><img src="icon/addcoustomer.png"> <span class="menu-title" data-i18n="nav.dash.main">Add Customer</span></a>
                    
                </li>
                <li class="nav-item"><a href="#"><img src="icon/campaign.png"> <span class="menu-title" data-i18n="nav.templates.main">Campaign</span></a>
                    <ul class="menu-content">
                        <li class="<?php if($cur_page=='addcampaign.php'){echo "active";}?>"><a class="menu-item" href="addcampaign.php"><img src="icon/addcampaign.png"> <span data-i18n="nav.templates.vert.main">Add Campaign</span></a>
                        </li>
                        <li class="<?php if($cur_page=='all-campaign.php'){echo "active";}?>"><a class="menu-item" href="all-campaign.php"><img src="icon/ALLcampaign.png"> <span data-i18n="nav.templates.vert.main">All Campaign</span></a>
                        </li>                                       
                    </ul>
                </li>

                
                <li class=" nav-item"><a href="#"><img src="icon/loyaltypoint.png"> <span class="menu-title" data-i18n="nav.templates.main">Loyality Points</span></a>
                    <ul class="menu-content">
                        
                        <li class="<?php if($cur_page=='loyalityview.php'){echo "active";}?>"><a class="menu-item" href="loyalityview.php"><img src="icon/loyaltypoint.png"> <span data-i18n="nav.templates.vert.main">View Loyality Points</span></a>
                        </li> 
                         <li class="<?php if($cur_page=='1'){echo "active";}?>"><a class="menu-item" href="loyalitysetting.php"><img src="icon/loyaltysetting.png"> <span data-i18n="nav.templates.vert.main">Loyality Settings</span></a>
                        </li>                                       
                    </ul>
                </li>

                <li class=" nav-item <?php if($cur_page=='1'){echo "active";}?>"><a href="birthdate.php"><img src="icon/birthday.png"> <span class="menu-title" data-i18n="nav.dash.main">Birthday</span></a>     <span class="badge badge-pill badge-danger badge-up badge-glow"><?php echo $birthday;?></span>  
                </li>
                <li class=" nav-item <?php if($cur_page=='1'){echo "active";}?>"><a href="annivery-date.php"><img src="icon/Anniversary.png"> <span class="menu-title" data-i18n="nav.dash.main">Anniversary</span></a>   <span class="badge badge-pill badge-danger badge-up badge-glow"><?php echo $anniversary; ?></span>      
                </li>

                <li class=" nav-item <?php if($cur_page=='1'){echo "active";}?>"><a href="sales-report.php"><img src="icon/servicesall.png"> <span class="menu-title" data-i18n="nav.dash.main">Sales Report</span></a> 
                <ul class="menu-content">
                        <li class="<?php if($cur_page=='todayearning.php'){echo "active";}?>"><a class="menu-item" href="todayearning.php"><img src="icon/loyalty.png"> <span data-i18n="nav.templates.vert.main">Today Earning</span></a>
                        </li>
                        <li class="<?php if($cur_page=='sales-report.php'){echo "active";}?>"><a class="menu-item" href="sales-report.php"><img src="icon/loyaltypoint.png"> <span data-i18n="nav.templates.vert.main">Complete Report</span></a>
                        </li>     
 <li class="<?php if($cur_page=='employee-report.php'){echo "active";}?>"><a href="employee-report.php"><img src="icon/servicesall.png"> <span class="menu-title" data-i18n="nav.dash.main">Employee Report</span></a> 
                </li>                                
                    </ul>

                </li>

                <!--<li class="nav-item"><a href="whats-msg.php"><img src="icon/whatsapp-icon.png"> <span class="menu-title" data-i18n="nav.dash.main">WhatsApp Msg</span></a>        
                </li> -->
               <!--  <li class=" nav-item"><a href="festivals.php"><img src="icon/loyaltysetting.png"> <span class="menu-title" data-i18n="nav.dash.main">Festivals</span></a>       
                </li> -->

                 <li class=" nav-item <?php if($cur_page=='1'){echo "active";}?>"><a href="regainlostbusiness.php"><img src="icon/lostbusiness.png"> <span class="menu-title" data-i18n="nav.dash.main">Regain Lost Business</span></a> 
                   
                </li>
                 <li class=" nav-item <?php if($cur_page=='regain_setting.php'){echo "active";}?>"><a href="regain_setting.php"><img src="icon/lostbusiness.png"> <span class="menu-title" data-i18n="nav.dash.main">Regain Lost Setting</span></a>       
                </li>
                <li class=" nav-item <?php if($cur_page=='feedback.php'){echo "active";}?>"><a href="feedback.php"><img src="icon/feedback.png"> <span class="menu-title" data-i18n="nav.dash.main">Feedback</span></a>       
                </li>
   <li class=" nav-item <?php if($cur_page=='creditreport.php'){echo "active";}?>"><a href="creditreport.php"><img src="icon/smscredit.png"> <span class="menu-title" data-i18n="nav.dash.main">Sms Reports</span></a>  
   
<li class=" nav-item <?php if($cur_page=='creditsms.php'){echo "active";}?>"><a href="creditsms.php"><img src="icon/smscredit.png"> <span class="menu-title" data-i18n="nav.dash.main">Sms Credit</span></a>       
                </li>
                 

                 


                <li class=" nav-item"><a href="#"><img src="icon/settings.png"> <span class="menu-title" data-i18n="nav.templates.main">Settings</span></a>
                    <ul class="menu-content">
                        <li  class="<?php if($cur_page=='profile.php'){echo "active";}?>"><a class="menu-item" href="profile.php"><span data-i18n="nav.templates.vert.main">Profile</span></a>
                        </li>
                        <li  class="<?php if($cur_page=='sub-users.php'){echo "active";}?>"><a class="menu-item" href="sub-users.php"> <span data-i18n="nav.templates.vert.main">Sub User</span></a>
                        </li> 
                         <li  class="<?php if($cur_page=='allroles.php'){echo "active";}?>"><a class="menu-item" href="allroles.php"> <span data-i18n="nav.templates.vert.main">Roles</span></a>
                        </li> 
                         <li  class="<?php if($cur_page=='retailer-transaction.php'){echo "active";}?>"><a class="menu-item" href="retailer-transaction.php"> <span data-i18n="nav.templates.vert.main">Transaction</span></a>
                        </li> 
                        <!--<li><a class="menu-item" href="#"> <span data-i18n="nav.templates.vert.main">Lead Integration</span></a>
                        </li>  -->
                        <li class="<?php if($cur_page=='allsupport.php'){echo "active";}?>"><a class="menu-item" href="allsupport.php"> <span data-i18n="nav.templates.vert.main">Support</span></a>
                        </li> 
                      <!--   <li><a class="menu-item" href="#"> <span data-i18n="nav.templates.vert.main">SMS History</span></a>
                        </li>  -->
                          <li class="<?php if($cur_page=='feedbacksetting.php'){echo "active";}?>"><a class="menu-item" href="feedbacksetting.php"> <span data-i18n="nav.templates.vert.main">Feedback Setting</span></a>
                        </li>
                         <li class="<?php if($cur_page=='settingsms.php'){echo "active";}?>"><a class="menu-item" href="settingsms.php"> <span data-i18n="nav.templates.vert.main">SMS Setting</span></a>
                        </li> 
                                                                
                    </ul>
                </li>
               
            </ul>
        </div>
    </div>
<?php } else{ ?>

<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class=" nav-item"><a href="retailers.php"><img src="icon/home.png"> <span class="menu-title" data-i18n="nav.dash.main">Dashboard</span></a>
                    
                </li>
                <?php if($customer=='on'){?>
                <li class=" nav-item"><a href="#"><img src="icon/customers.png"> <span class="menu-title" data-i18n="nav.templates.main">Customers</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="customer-view.php"><img src="icon/customers.png"> <span data-i18n="nav.templates.vert.main">Customers</span></a>
                        </li>
                        <li><a class="menu-item" href="import-customer.php"><img src="icon/importcoustomer.png"> <span data-i18n="nav.templates.vert.main">Import Customer</span></a>
                        </li>
                        <li><a class="menu-item" href="export-customer.php"><img src="icon/exportcoustomer.png"> <span data-i18n="nav.templates.vert.main">Export Customer</span></a>
                        </li>
                        <li><a class="menu-item" href="customer-group.php"><img src="icon/groupcoustomer.png"> <span data-i18n="nav.templates.vert.main">Customer Groups</span></a>
                        </li>
                        

                         
                    </ul>
                </li>
                <?php } ?>
                <?php if($add_customer=='on'){?>
                <li class=" nav-item"><a href="add-customer.php"><img src="icon/addcoustomer.png"> <span class="menu-title" data-i18n="nav.dash.main">Add Customer</span></a>
                    
                </li><?php } ?>
               
                <li class=" nav-item"><a href="#"><img src="icon/campaign.png"> <span class="menu-title" data-i18n="nav.templates.main">Campaign</span></a>
                    <ul class="menu-content">
                     <?php if($add_campaign=='on'){?>
                        <li><a class="menu-item" href="addcampaign.php"><img src="icon/addcampaign.png"> <span data-i18n="nav.templates.vert.main">Add Campaign</span></a>
                        </li>
                         <?php } ?>
                         <?php if($all_campaign=='on'){ ?>
                        <li><a class="menu-item" href="all-campaign.php"><img src="icon/ALLcampaign.png"> <span data-i18n="nav.templates.vert.main">All Campaign</span></a>
                        </li><?php } ?>                                       
                    </ul>
                </li>

               
               <?php if($loyality=='on'){?>
                <li class=" nav-item"><a href="#"><img src="icon/loyaltypoint.png"> <span class="menu-title" data-i18n="nav.templates.main">Loyality Points</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="loyality.php"><img src="icon/loyalty.png"> <span data-i18n="nav.templates.vert.main">Loyality</span></a>
                        </li>
                        <li><a class="menu-item" href="loyalityview.php"><img src="icon/loyaltypoint.png"> <span data-i18n="nav.templates.vert.main">View Loyality Points</span></a>
                        </li> 
                         <li><a class="menu-item" href="loyalitysetting.php"><img src="icon/loyaltysetting.png"> <span data-i18n="nav.templates.vert.main">Loyality Settings</span></a>
                        </li>                                       
                    </ul>
                </li>
                <?php } ?>
                 <?php if($birthday=='on'){?>
                <li class=" nav-item"><a href="birthdate.php"><img src="icon/birthday.png"> <span class="menu-title" data-i18n="nav.dash.main">Birthday</span></a>       
                </li><?php } ?><?php if($anniversary=='on'){?>
                <li class=" nav-item"><a href="annivery-date.php"><img src="icon/Anniversary.png"> <span class="menu-title" data-i18n="nav.dash.main">Anniversary</span></a>       
                </li><?php } ?>
               <!--  <li class=" nav-item"><a href="festivals.php"><img src="icon/loyaltysetting.png"> <span class="menu-title" data-i18n="nav.dash.main">Festivals</span></a>       
                </li> -->
                <?php if($lost_business=='on'){?>
                 <li class=" nav-item"><a href="regainlostbusiness.php"><img src="icon/lostbusiness.png"> <span class="menu-title" data-i18n="nav.dash.main">Regain Lost Business</span></a>       
                </li>
                <?php }?>
                <?php if($feedback=='on'){?>
                <li class=" nav-item"><a href="feedback.php"><img src="icon/feedback.png"> <span class="menu-title" data-i18n="nav.dash.main">Feedback</span></a>       
                </li><?php }?>

                
                 <?php if($packages=='on'){?>
                 <li class=" nav-item"><a href="#"><img src="icon/packages.png"> <span class="menu-title" data-i18n="nav.templates.main">Packages</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="addpackage.php"> <span data-i18n="nav.templates.vert.main">Add Packages</span></a>
                        </li>
                        <li><a class="menu-item" href="all-packages.php"> <span data-i18n="nav.templates.vert.main">All Packages</span></a>
                        </li>
                         <li><a class="menu-item" href="sellpackages.php"> <span data-i18n="nav.templates.vert.main">Sell Packages</span></a>
                        </li> 
                        <li><a class="menu-item" href="redeempack.php"> <span data-i18n="nav.templates.vert.main">Redeem Packages</span></a>
                        </li> 
                          <li><a class="menu-item" href="packagereport.php"> <span data-i18n="nav.templates.vert.main">Packages Report</span></a>
                        </li> 
                         <!-- <li><a class="menu-item" href="#"> <span data-i18n="nav.templates.vert.main">Service Report</span></a>
                        </li> -->
                         <!-- <li><a class="menu-item" href="#"> <span data-i18n="nav.templates.vert.main">Package Setting</span></a>
                        </li>  -->
                                                                
                    </ul>
                </li>

                <?php } ?>
                <?php if($all_sub_user=='on'){?>
                <li class=" nav-item"><a href="#"><img src="icon/settings.png"> <span class="menu-title" data-i18n="nav.templates.main">Settings</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="profile.php"><span data-i18n="nav.templates.vert.main">Profile</span></a>
                        </li>
                        <li><a class="menu-item" href="sub-users.php"> <span data-i18n="nav.templates.vert.main">Sub User</span></a>
                        </li> 
                         <li><a class="menu-item" href="allroles.php"> <span data-i18n="nav.templates.vert.main">Roles</span></a>
                        </li> 
                         <li><a class="menu-item" href="retailer-transaction.php"> <span data-i18n="nav.templates.vert.main">Transaction</span></a>
                        </li> 
                        <!--  <li><a class="menu-item" href="#"> <span data-i18n="nav.templates.vert.main">Lead Integration</span></a>
                        </li>  -->
                        <li><a class="menu-item" href="allsupport.php"> <span data-i18n="nav.templates.vert.main">Support</span></a>
                        </li> 
                      <!--   <li><a class="menu-item" href="#"> <span data-i18n="nav.templates.vert.main">SMS History</span></a>
                        </li>  -->
                          <li><a class="menu-item" href="feedbacksetting.php"> <span data-i18n="nav.templates.vert.main">Feedback Setting</span></a>
                        </li>
                         <li><a class="menu-item" href="settingsms.php"> <span data-i18n="nav.templates.vert.main">SMS Setting</span></a>
                        </li> 
                                                                
                    </ul>
                </li><?php } ?>

               
            </ul>
        </div>
    </div>
<?php }?>