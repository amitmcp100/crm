<?php
require_once("config.php");
if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
    // not logged in send to login page
    redirect("index.php");
}
// set page title
$title = "Dashboard";
$store_id = $_SESSION['store_id'];
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

 //include("configinc2.php");

// Check connection
$today_date = date('Y-m-d');
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


$sql1 = "SELECT *  FROM `tbl_customer_data` WHERE `store_id` = '$store_id'";
//echo $sql01;
$stmt = $DB->prepare($sql1);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$result = array();
while ($row1 = $stmt->fetch()) { 
$cid[]=$row1['id'];
}

$sql32 = "SELECT `id`  FROM `tbl_employee` WHERE `store_id` = '$store_id'";
//echo $sql31;
$stmt = $DB->prepare($sql32);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$result = array();
while ($row32 = $stmt->fetch()) { 
    $total_employee[]= $row32['id'];

}

$sql51 = "SELECT `amount`  FROM `tbl_sales_report` WHERE `store_id` = '$store_id'";
//echo $sql31;
$stmt = $DB->prepare($sql51);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$result = array();
while ($row51 = $stmt->fetch()) { 
    $total_price= $row51['amount'];
    @$total_amount += $total_price;

}

$sql31 = "SELECT `amount`  FROM `tbl_sales_report` WHERE sales_date='$today_date' and  `store_id` = '$store_id'";
//echo $sql31;
$stmt = $DB->prepare($sql31);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$result = array();
while ($row31 = $stmt->fetch()) { 
    $price= $row31['amount'];
    $total += $price;

}
?>  


    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row mb-1">
            </div>
            <div class="content-body">
                <!-- eCommerce statistic -->
                <div class="row">

                    <div  class="col-xl-6 col-lg-6 col-12">
                        <div style="background:#FFA76D;"class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h3 class="info"><?php if($total==''){
                                                echo"0";}else{ echo ($total);}?>
                                            </h3>
                                            <h6>TODAY EARNING</h6>
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
                    <div class="col-xl-6 col-lg-6 col-12">
                        <div style="background:#FFA76D;"class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h3 class="info"><?php echo ($total_amount);?></h3>
                                            <h6>TOTAL EARNING</h6>
                                        </div>
                                        <div>
                                            <i class="icon-basket-loaded info font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 100%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <?php 

                    $sql37 = "SELECT `name`  FROM `tbl_employee` WHERE `store_id` = '$store_id'";
                    //echo $sql31;
                    $employee_name = [];
                    $stmt = $DB->prepare($sql37);
                    $stmt->execute();
                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    $result = array();
                    while ($row37 = $stmt->fetch()) { 
                        $employee_name= $row37['name'];

                    }
                    foreach($employee_name as $emp)
                    {
                    $sql41 = "SELECT SUM(amount) as totalamount,employee  FROM `tbl_sales_report` WHERE `employee`='$emp' AND `sales_date`='$today_date' AND  `store_id` = '$store_id'";
                    
                    //echo $sql41;
                    $stmt = $DB->prepare($sql41);
                    $stmt->execute();
                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    $result = array();
                    while ($row41 = $stmt->fetch()) { 
                        $employee_name= $row41['employee'];
                        $emp_income= $row41['totalamount'];
                       
                    ?> 
                    <?php 
                    if(($employee_name)==''){ 
                        
 
                    }else{ ?>
                     <div class="col-xl-3 col-lg-6 col-12">
                        <div style="background:#4EDDAA;"class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h2 class="info"><?php echo ($emp_income);?></h2>
                                            <h3 class="info"><?php echo ($employee_name);?></h3>
                                            <h6></h6>
                                        </div>
                                        <div>
                                            <i class="icon-basket-loaded info font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-warning" role="progressbar" style="width: 100%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                <?php
                     }
                 }
                }
            ?>
           
                 
                  <?php

                    $sql57 = "SELECT `service_name`  FROM `tbl_services` where  `store_id` = '$store_id'";
                    //echo $sql57;
                    $stmt = $DB->prepare($sql57);
                    $stmt->execute();
                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    $result = array();
                    while ($row57 = $stmt->fetch()) { 
                        $service_name[]= $row57['service_name'];

                    }
                    if($service_name =='')
                    {

                    }else{
                    foreach($service_name as $ser)
                    {

                    $sql55 = "SELECT COUNT(`services`) as total_services,`services`  FROM `tbl_sales_report` WHERE services='$ser' AND sales_date='$today_date' AND  `store_id` = '$store_id'";
                    //echo $sql31;
                    $stmt = $DB->prepare($sql55);
                    $stmt->execute();
                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    $result = array();
                    while ($row55 = $stmt->fetch()) { 
                        $services= $row55['services']; 
                        $total_service= $row55['total_services'];   
                                                
                    ?>
                    <?php
                     if(($services)==''){ 
                        
                    }else{ ?>           
                 

                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h2 class="info"><?php echo ($services);?></h2>
                                            
                                            <h3 class="info"><?php echo ($total_service);?></h3>
                                        </div>
                                        <div>
                                            <i class="icon-basket-loaded info font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-warning" role="progressbar" style="width: 100%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                 <?php } } } }?>
                    <style>
                         .scrollable{
                             height:400px;
                             overflow:scroll;
                         }


                    </style>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                            <form class="form form-horizontal"method="post" action="">
                                <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="userinput4">From Date </label>
                                                <div class="col-md-9 mx-auto">
                                                    <input type="date" id="dob" class="form-control" name="fromDate" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Date Fixed" data-original-title="" title="" aria-describedby="tooltip193832" required="required">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-5">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="userinput4">To Date </label>
                                                <div class="col-md-9 mx-auto">
                                                    <input type="date" id="dob" class="form-control" name="endDate" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Date Fixed" data-original-title="" title="" aria-describedby="tooltip193832" required="required">
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <input type="submit" class="btn btn-success" name="cust_search" value="search"></i> </button>
                                        </div>
                                </div>
                            </form>
                               <div class="scrollable">
                                     <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <td>No</td>
                                                <td>Product Name</td>
                                                <td>Product Price</td>
                                                <td>Employee Name</td>
                                                <td>Sales Date</td>
                                            </tr>
                                        <thead> 
                                        <tbody>
                                        <?php
													/* Attempt MySQL server connection. Assuming you are running MySQL
													server with default setting (user 'root' with no password) */

													//include("configinc2.php");
													// Check connection
                                                    if(isset($_POST['cust_search'])) {


                                                    $fromDate = $_POST['fromDate'];
                                                    $endDate = $_POST['endDate'];    
													$userid=$_SESSION["user_id"];
													// Attempt select query execution
                                                    $sql57 = "SELECT `product_name`  FROM `tbl_product` where  `store_id` = '$store_id'";
                                                    //echo $sql31;
                                                    $stmt = $DB->prepare($sql57);
                                                    $stmt->execute();
                                                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                                    $result = array();
                                                    while ($row57 = $stmt->fetch()) { 
                                                        $product_name[]= $row57['product_name'];
                                
                                                    }
                                                    foreach($product_name as $pro)
                                                    {
												    
												     //$pro = mysqli_real_escape_string($pro);
													$sql91 = "SELECT *  FROM `tbl_sales_report`  WHERE `product`= '".$pro."' AND sales_date between '".$fromDate."' and '".$endDate."' and `store_id` = '$store_id'";
													//echo $sql91;die;
                                                    $stmt = $DB->prepare($sql91);
                                                    $stmt->execute();
                                                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                                    while ($row91 = $stmt->fetch()) {
                                                        $total_sale= $row91['amount'];
                                                        $total2 += $total_sale;
													    $id=$row91['id'];
													    //echo "fdf".$id;
													?>
                                                    <tr>
                                                        <td><?php echo $row91['id'];?></td>
                                                        <td><?php echo $row91['product'];?></td>
                                                        <td><?php echo $row91['amount'];?></td>
                                                        <td><?php echo $row91['employee'];?></td>
                                                        <td><?php echo $row91['sales_date'];?></td>
                                                        
                                                        
                                                    </tr>
                                                    <?php }
                                                        } 
                                                     } 
                                                    else{
                                                        $userid=$_SESSION["user_id"];
													// Attempt select query execution
                                                    $sql57 = "SELECT `product_name`  FROM `tbl_product` where `store_id` = '$store_id'";
                                                    //echo $sql31;
                                                    $stmt = $DB->prepare($sql57);
                                                    $stmt->execute();
                                                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                                    $result = array();
                                                    while ($row57 = $stmt->fetch()) { 
                                                        $product_name[]= $row57['product_name'];
                                
                                                    }
                                                    if($product_name =='')
                                                    {

                                                    }else{
                                                    foreach($product_name as $pro)
                                                    {
												    
                                                   // $pro = mysqli_real_escape_string($pro);
													$sql91 = "SELECT *  FROM `tbl_sales_report`  WHERE `product`='".$pro."' AND sales_date='$today_date' AND  `store_id` = '$store_id'";
													//echo $sql1;
                                                    $stmt = $DB->prepare($sql91);
                                                    $stmt->execute();
                                                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                                    while ($row91 = $stmt->fetch()) {
                                                        $total_sale= $row91['amount'];
                                                        $total2 += $total_sale;
													    $id=$row91['id'];
													//echo "fdf".$id;
													?>
                                                    <tr>
                                                        <td><?php echo $row91['id'];?></td>
                                                        <td><?php echo $row91['product'];?></td>
                                                        <td><?php echo $row91['amount'];?></td>
                                                        <td><?php echo $row91['employee'];?></td>
                                                        <td><?php echo $row91['sales_date'];?></td>
                                                        
                                                        
                                                    </tr>
                                                    <?php
                                                      }
                                                     }   
                                                    }
                                                }
                                                    
													?>
                                        <tbody> 
                                        <tfoot>
                                                    <tr>
                                                    <th>No</th>
                                                    <th>Product Name</th>
                                                    <th>Product Price</th>
                                                    <th>Employee Name</th>
                                                    <th>Sales Date</th>
                                                   
                                                    </tr>
                                                   
                                                    <tr>
                                                        <th><h2>Total Sale-<?php if($total2!=''){ echo $total2;}else{echo '0';}?></h2></th>
                                                    </tr>
                                                   
                                                </tfoot>
                                    </table>

                                </div>
                            </div>
                        </div>
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