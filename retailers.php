<?php
require_once("config.php");
if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
    // not logged in send to login page
    redirect("index.php");
}

// set page title
$title = "Dashboard";

// if the rights are not set then add them in the current session
// if (!isset($_SESSION["access"])) {

//     try {

//         $sql = "SELECT mod_modulegroupcode, mod_modulegroupname FROM module "
//                 . " WHERE 1 GROUP BY `mod_modulegroupcode` "
//                 . " ORDER BY `mod_modulegrouporder` ASC, `mod_moduleorder` ASC  ";


//         $stmt = $DB->prepare($sql);
//         $stmt->execute();
//         $commonModules = $stmt->fetchAll();

//         $sql = "SELECT mod_modulegroupcode, mod_modulegroupname, mod_modulepagename,  mod_modulecode, mod_modulename FROM module "
//                 . " WHERE 1 "
//                 . " ORDER BY `mod_modulegrouporder` ASC, `mod_moduleorder` ASC  ";

//         $stmt = $DB->prepare($sql);
//         $stmt->execute();
//         $allModules = $stmt->fetchAll();

//         $sql = "SELECT rr_modulecode, rr_create,  rr_edit, rr_delete, rr_view FROM role_rights "
//                 . " WHERE  rr_rolecode = :rc "
//                 . " ORDER BY `rr_modulecode` ASC  ";

//         $stmt = $DB->prepare($sql);
//         $stmt->bindValue(":rc", $_SESSION["rolecode"]);
        
        
//         $stmt->execute();
//         $userRights = $stmt->fetchAll();

//         $_SESSION["access"] = set_rights($allModules, $userRights, $commonModules);

//     } catch (Exception $ex) {

//         echo $ex->getMessage();
//     }
// }




include 'header.php';
?>
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->

<?php include('sidebar.php');?>    
    <!-- END: Main Menu-->
    <!-- BEGIN: Content-->
<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
// include("configinc2.php");

// Check connection

$userid=$_SESSION["user_id"];
// Attempt select query execution
// $sql01 = "SELECT *  FROM `system_users` WHERE `u_userid` = '$userid'";
// $stmt = $DB->prepare($sql01);
// $stmt->execute();
// $stmt->setFetchMode(PDO::FETCH_ASSOC);
// while ($row01 = $stmt->fetch()) { 
// //echo $sql;
// $uid=$row01['reguser_id'];
// }


// $sql = "SELECT *  FROM `tbl_user_group` WHERE `child_id` = '$uid'";
// $stmt = $DB->prepare($sql);
// $stmt->execute();
// $stmt->setFetchMode(PDO::FETCH_ASSOC);
// while ($row = $stmt->fetch()) { 
// //echo $sql;
// $store_id=$row['store_id'];
// }

$store_id =  $_SESSION['store_id'];
$sql1 = "SELECT *  FROM `tbl_customer_data` WHERE `store_id` = '$store_id'";
//echo $sql1;
$stmt = $DB->prepare($sql1);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$result = array();
while ($row1 = $stmt->fetch()) { 
$cid[]=$row1['id'];
}

$sql2 = "SELECT *  FROM `tbl_campaign` WHERE `store_id` = '$store_id'";
//echo $sql;
$stmt = $DB->prepare($sql2);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$result = array();
while ($row2 = $stmt->fetch()) { 

$caid[]=$row2['id'];
}
 


$sql3 = "SELECT *  FROM `creditsms` WHERE `store_id` = '$store_id'";
//echo $sql;
$stmt = $DB->prepare($sql3);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$result = array();
while ($row3 = $stmt->fetch()) { 
$available_sms=$row3['available_sms'];
}

$sql3 = "SELECT *  FROM `tbl_store` WHERE `store_id` = '$store_id'";
//echo $sql;
$stmt = $DB->prepare($sql3);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$result = array();
while ($row3 = $stmt->fetch()) { 
$store_created_date =$row3['create_date'];
}

$oneYearOn = date('Y-m-d',strtotime(date("Y-m-d", strtotime($store_created_date)) . " + 365 day"));

?>  
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row mb-1">
            </div>
            <div class="content-body">
                <!-- eCommerce statistic -->
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h3 class="info"><?php if(!empty($cid)) echo count($cid); else echo '0'; ?></h3>
                                            <h6>TOTAL CUSTOMER</h6>
                                        </div>
                                        <div>
                                            <i class="icon-basket-loaded info font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 100%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h3 class="warning"><?php   if(!empty($caid)) echo  count($caid); else echo '0';?></h3>
                                            <h6>TOTAL CAMPAIGN</h6>
                                        </div>
                                        <div>
                                            <i class="icon-pie-chart warning font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-warning" role="progressbar" style="width: 100%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h3 class="success"><?php if($available_sms) echo $available_sms; else echo '0'; ?></h3>
                                            <h6>SMS CREDIT</h6>
                                        </div>
                                        <div>
                                            <i class="icon-user-follow success font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 100%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h3 class="danger"><?=$oneYearOn ?></h3>
                                            <h6>SUBSCRIPTION EXPIRY</h6>
                                        </div>
                                        <div>
                                            <i class="icon-heart danger font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 100%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h3 class="info"> <?php
                        //  include("configinc2.php"); 
                        $sql0 = "SELECT count(id) as platinum FROM`tbl_customer_data` WHERE `customer_group` = 'Platinum' and `store_id` = '$store_id'";
                        $stmt = $DB->prepare($sql0);
                        $stmt->execute();
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        $result = array();
                        while ($c_data0 = $stmt->fetch()) { 
						
						echo $c_data0['platinum'];
						}
						?></h3>
                                            <h6 style="BORDER: 1PX #1E9FF2 SOLID;PADDING: 5PX;FONT-WEIGHT: 600;COLOR: #1E9FF2;">PLATINUM CUSTOMERS</h6>
                                        </div>
                                        <div>
                                            <i class="icon-basket-loaded info font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 100%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h3 class="warning"> <?php
                        
                        $sql1 = "SELECT count(id) as gold FROM`tbl_customer_data` WHERE `customer_group` = 'Gold' and `store_id` = '$store_id'";
                        $stmt = $DB->prepare($sql1);
                        $stmt->execute();
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        $result = array();
                        while ($c_data1 = $stmt->fetch()) { 
						echo $c_data1['gold'];
						}
						?></h3>
                                            <h6 style="BORDER: 1PX #FF9149 SOLID;PADDING: 5PX;FONT-WEIGHT: 600;COLOR: #FF9149;">GOLD CUSTOMERS</h6>
                                        </div>
                                        <div>
                                            <i class="icon-pie-chart warning font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-warning" role="progressbar" style="width: 100%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h3 class="success"><?php
                        
                        $sql2 = "SELECT count(id) as silver FROM`tbl_customer_data` WHERE `customer_group` = 'Silver' and `store_id` = '$store_id'";
                        $stmt = $DB->prepare($sql2);
                        $stmt->execute();
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        $result = array();
                        while ($c_data2 = $stmt->fetch()) { 
						echo $c_data2['silver'];
						}
						?></h3>
                                            <h6 style="BORDER: 1PX #28D094 SOLID;PADDING: 5PX;FONT-WEIGHT: 600;COLOR: #28D094;">SILVER CUSTOMERS</h6>
                                        </div>
                                        <div>
                                            <i class="icon-user-follow success font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 100%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h3 class="danger"><?php
                        
                        $sql3 = "SELECT count(id) as bronze FROM`tbl_customer_data` WHERE `customer_group` = 'Bronze'  and `store_id` = '$store_id'";
                        $stmt = $DB->prepare($sql3);
                        $stmt->execute();
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        $result = array();
                        while ($c_data3 = $stmt->fetch()) { 
						echo $c_data3['bronze'];
						}
						?></h3>
                                            <h6 style="BORDER: 1PX #FF4961 SOLID;PADDING: 5PX;FONT-WEIGHT: 600;COLOR: #FF4961;">BRONZE CUSTOMERS</h6>
                                        </div>
                                        <div>
                                            <i class="icon-heart danger font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 100%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-12">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                <h3 style="text-align:center;"><strong>SALES REPORT</strong></h3>
                                <div class="col-xl-6 col-lg-6 col-12" style="float:left;">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <?php 
//include("configinc2.php"); 
$sqlpaid = "SELECT count(id) as bid FROM `tbl_customer_purchase` WHERE `amount` !='' and `store_id` = '$store_id'";
$stmt = $DB->prepare($sqlpaid);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
while ($paid = $stmt->fetch()) { 
$p_customer=$paid['bid'];
}
?>

<?php 

$sqlpaid1 = "SELECT count(id) as bid FROM `tbl_customer_purchase` WHERE `amount` ='' and `store_id` = '$store_id'";
$stmt = $DB->prepare($sqlpaid1);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
while ($paid1 = $stmt->fetch()) { 

$p_customer1=$paid1['bid'];
}
?>
                                <div id="piechart" style="margin-top:-30px;"></div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
  var data = google.visualization.arrayToDataTable([
  ['Task', 'Hours per Day'],
  ['Paid Customer', <?php echo $p_customer ?>],
  ['Enquiry', <?php echo $p_customer1 ?>],
  
]);

  // Optional; add a title and set the width and height of the chart
  var options = {'title':'', 'width':500, 'height':400};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}
</script>
                                </div>
                            </div>
                        </div>
                    </div>








                               
                             
 <div class="col-xl-6 col-lg-6 col-12" style="float:left;margin-top:40px;">
 <div><h3><strong style="color:blue;">TOTAL PAID CUSTOMER : <?php echo $p_customer; ?></strong></h3></div><div><h3><strong style="color:red;">TOTAL ENQUIRY CUSTOMER : <?php echo $p_customer1; ?></strong></h3></div>

 </div></div>
                             </div>
                        </div>
                     </div>
                </div>
                
                <!--/ eCommerce statistic -->

                <!-- Products sell and New Orders -->
                <!-- <div class="row match-height">
                    <div class="col-xl-8 col-12" id="ecommerceChartView">
                        <div class="card card-shadow">
                            <div class="card-header card-header-transparent py-20">
                                <div class="btn-group dropdown">
                                    <a href="#" class="text-body dropdown-toggle blue-grey-700" data-toggle="dropdown">PRODUCTS SALES</a>
                                    <div class="dropdown-menu animate" role="menu">
                                        <a class="dropdown-item" href="#" role="menuitem">Sales</a>
                                        <a class="dropdown-item" href="#" role="menuitem">Total sales</a>
                                        <a class="dropdown-item" href="#" role="menuitem">profit</a>
                                    </div>
                                </div>
                                <ul class="nav nav-pills nav-pills-rounded chart-action float-right btn-group" role="group">
                                    <li class="nav-item"><a class="active nav-link" data-toggle="tab" href="#scoreLineToDay">Day</a></li>
                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#scoreLineToWeek">Week</a></li>
                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#scoreLineToMonth">Month</a></li>
                                </ul>
                            </div>
                            <div class="widget-content tab-content bg-white p-20">
                                <div class="ct-chart tab-pane active scoreLineShadow" id="scoreLineToDay"></div>
                                <div class="ct-chart tab-pane scoreLineShadow" id="scoreLineToWeek"></div>
                                <div class="ct-chart tab-pane scoreLineShadow" id="scoreLineToMonth"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">New Orders</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content">
                                <div id="new-orders" class="media-list position-relative">
                                    <div class="table-responsive">
                                        <table id="new-orders-table" class="table table-hover table-xl mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="border-top-0">Product</th>
                                                    <th class="border-top-0">Customers</th>
                                                    <th class="border-top-0">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-truncate">iPhone X</td>
                                                    <td class="text-truncate p-1">
                                                        <ul class="list-unstyled users-list m-0">
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="John Doe" class="avatar avatar-sm pull-up">
                                                                <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-19.png" alt="Avatar">
                                                            </li>
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Katherine Nichols" class="avatar avatar-sm pull-up">
                                                                <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-18.png" alt="Avatar">
                                                            </li>
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Joseph Weaver" class="avatar avatar-sm pull-up">
                                                                <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-17.png" alt="Avatar">
                                                            </li>
                                                            <li class="avatar avatar-sm">
                                                                <span class="badge badge-info">+4 more</span>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                    <td class="text-truncate">$8999</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-truncate">Pixel 2</td>
                                                    <td class="text-truncate p-1">
                                                        <ul class="list-unstyled users-list m-0">
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Alice Scott" class="avatar avatar-sm pull-up">
                                                                <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-16.png" alt="Avatar">
                                                            </li>
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Charles Miller" class="avatar avatar-sm pull-up">
                                                                <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-15.png" alt="Avatar">
                                                            </li>
                                                        </ul>
                                                    </td>
                                                    <td class="text-truncate">$5550</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-truncate">OnePlus</td>
                                                    <td class="text-truncate p-1">
                                                        <ul class="list-unstyled users-list m-0">
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Christine Ramos" class="avatar avatar-sm pull-up">
                                                                <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-11.png" alt="Avatar">
                                                            </li>
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Thomas Brewer" class="avatar avatar-sm pull-up">
                                                                <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-10.png" alt="Avatar">
                                                            </li>
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Alice Chapman" class="avatar avatar-sm pull-up">
                                                                <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-9.png" alt="Avatar">
                                                            </li>
                                                            <li class="avatar avatar-sm">
                                                                <span class="badge badge-info">+3 more</span>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                    <td class="text-truncate">$9000</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-truncate">Galaxy</td>
                                                    <td class="text-truncate p-1">
                                                        <ul class="list-unstyled users-list m-0">
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Ryan Schneider" class="avatar avatar-sm pull-up">
                                                                <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-14.png" alt="Avatar">
                                                            </li>
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Tiffany Oliver" class="avatar avatar-sm pull-up">
                                                                <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-13.png" alt="Avatar">
                                                            </li>
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Joan Reid" class="avatar avatar-sm pull-up">
                                                                <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-12.png" alt="Avatar">
                                                            </li>
                                                        </ul>
                                                    </td>
                                                    <td class="text-truncate">$7500</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-truncate">Moto Z2</td>
                                                    <td class="text-truncate p-1">
                                                        <ul class="list-unstyled users-list m-0">
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Kimberly Simmons" class="avatar avatar-sm pull-up">
                                                                <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-8.png" alt="Avatar">
                                                            </li>
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Willie Torres" class="avatar avatar-sm pull-up">
                                                                <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-7.png" alt="Avatar">
                                                            </li>
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Rebecca Jones" class="avatar avatar-sm pull-up">
                                                                <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-6.png" alt="Avatar">
                                                            </li>
                                                            <li class="avatar avatar-sm">
                                                                <span class="badge badge-info">+1 more</span>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                    <td class="text-truncate">$8500</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                 --><!--/ Products sell and New Orders -->
<script type="text/javascript">
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	theme: "light1", // "light2", "dark1", "dark2"
	animationEnabled: false, // change to true		
	title:{
		text: ""
	},
	data: [
	{
		// Change type to "bar", "area", "spline", "pie",etc.
		type: "column",
		dataPoints: [
			{ label: "May",  y: 10000  },
			{ label: "June", y: 21000  },
			{ label: "July", y: 19000  },
			{ label: "Aug",  y: 18000  },
		
		]
	}
	]
});
chart.render();

}
</script>
                <!-- Recent Transactions -->
                <div class="row" style="display:none;">
                    <div id="recent-transactions" class="col-12">
                        <div class="card">
                           <h3 style="text-align:center;"><strong>LAST 4 MONTH SALES</strong></h3>
                        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
						<script src="https://canvasjs.com/assets/script/canvasjs.min.js"> </script>
                          </div>
                          </div>
                </div>
                <!--/ Recent Transactions -->

                <!--Recent Orders & Monthly Sales -->
                <!--/ Basic Horizontal Timeline -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light navbar-border navbar-shadow">
        <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block">Copyright &copy; 2019 <a class="text-bold-800 grey darken-2" href="https://themeforest.net/user/pixinvent/portfolio?ref=pixinvent" target="_blank">LoireTechnologies</a></span></p>
    </footer>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="app-assets/vendors/js/charts/chartist.min.js"></script>
    <script src="app-assets/vendors/js/charts/chartist-plugin-tooltip.min.js"></script>
    <script src="app-assets/vendors/js/charts/raphael-min.js"></script>
    <script src="app-assets/vendors/js/charts/morris.min.js"></script>
    <script src="app-assets/vendors/js/timeline/horizontal-timeline.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="app-assets/js/core/app-menu.js"></script>
    <script src="app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="app-assets/js/scripts/pages/dashboard-ecommerce.js"></script>
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>