<?php
require_once("config.php");
if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
    // not logged in send to login page
    redirect("index.php");
}

// set page title
$store_id = $_SESSION['store_id'];
$title = "Dashboard";
$today_date = date('Y-m-d');
// if the rights are not set then add them in the current session

include 'header.php';
?>
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->

<?php
include('sidebar.php');
?> 
    <!-- END: Main Menu-->
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row mb-1">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">Employee Report</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="retailers.php">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Employee Report
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>

            </div>
           

            <form class="form form-horizontal"method="post" action="">
                <div class="row">
                         <div class="col-md-5">
                            <div class="form-group row">
                                <label class="col-md-3 label-control" for="userinput4">From Date </label>
                                <div class="col-md-9 mx-auto">
                                    <input type="date" id="dob" class="form-control" name="fromDate" data-toggle="tooltip" data-trigger="hover" required="required" data-placement="top" data-title="Date Fixed" data-original-title="" title="" aria-describedby="tooltip193832">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="form-group row">
                                <label class="col-md-3 label-control" for="userinput4">To Date </label>
                                <div class="col-md-9 mx-auto">
                                    <input type="date" id="dob" class="form-control" name="endDate" data-toggle="tooltip" data-trigger="hover" required="required" data-placement="top" data-title="Date Fixed" data-original-title="" title="" aria-describedby="tooltip193832">
                                </div>
                            </div>
                        </div>

                       
                         <div>
                            <input type="submit" class="btn btn-success" name="sale_search" value="search"></i> </button>
                         </div>
                </div>
            </form>

                <div class="row "> 
                <?php
                if ($_GET['data'] == 'update') {
                ?> 
                <div class="alert btn-success mb-2" role="alert">
                <strong>Success !</strong> Update..!

                </div>
                <?php
                }
                ?>
                <?php
                if ($_GET['data'] == 'error') {
                ?>
                <div class="alert alert-warning mb-2" role="alert">
                <strong>Warning!</strong> Please Try Again !.

                </div><?php
                }
                ?>   
                
                </div>
                <style>
                         .scrollable{
                             height:400px;
                             min-width:800px;
                             overflow:scroll;
                         }
                         .scrollable1{
                             height:100px;
                             min-width:800px;
                             overflow:scroll;
                         }


                    </style>
            

            <div class="content-body">
                <!-- Zero configuration table -->
                <section id="configuration">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                   
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
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                       
                                    <div class="scrollable text-center">

 
                                    <div style="width:3000px;"> 

                                    <?php
                                            $servername = "localhost";
                                            $username = "root";
                                            $password = "";
                                            $dbname = "loiretec_crmas";

                                            // Create connection
                                            $conn = new mysqli($servername, $username, $password, $dbname);
                                            // Check connection
                                            if ($conn->connect_error) {
                                                die("Connection failed: " . $conn->connect_error);
                                            }

                                            if(isset($_POST['sale_search'])) {


                                                $fromDate = $_POST['fromDate'];
                                                $endDate = $_POST['endDate'];    


                                            $sql =  "SELECT `name`  FROM `tbl_employee` WHERE `store_id` = '$store_id'";
                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                                // output data of each row
                                                while($row = $result->fetch_assoc()) { ?>
                                            <table class="table table-striped table-bordered file-export" style="width: 200px;float:left;">  <tr>
                                                        <th colspan="2"><?php echo $row['name'];?></th>
                                                    </tr>
                                                    <tr><td>Price</td><td>Service</td></tr>

                                                 <?php   $name=$row['name']; 
                                            $sql1 =  "SELECT `amount`,`services`  FROM `tbl_sales_report` WHERE employee='$name' AND sales_date between '".$fromDate."' and '".$endDate."' AND  `store_id` = '$store_id'";
                                            $result1 = $conn->query($sql1);

                                            if ($result1->num_rows > 0) {
                                                // output data of each row
                                                while($row1 = $result1->fetch_assoc()) { ?>

                                                    <tr><td><?php echo $row1['amount'];?></td><td><?php echo $row1['services'];?></td></tr>
                                                    
                                                    
                                              <?php  } }else{?>
                                                <tr><td>-</td><td>-</td></tr>
                                              <?php }
                                            } 
                                        ?> </table>
                                        <?php } ?>
                                           
                                                              
                                                                 </div>
                                                                </div>
                                                                <h3 class="content-header-title">Total Amount</h3>
                                                                <div class="card-body card-dashboard">

                                                                <div class="scrollable1 text-center">
 <div style="width:3000px;"> 

<?php 
 $sql =  "SELECT `name`  FROM `tbl_employee` WHERE `store_id` = '$store_id'";
 $result = $conn->query($sql);

 if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) { 

        $name=$row['name'];$sql4 =  "SELECT SUM(`amount`) as totalamount  FROM `tbl_sales_report` WHERE employee='$name' AND `sales_date` between '".$fromDate."' and '".$endDate."'"; 
      $result4 = $conn->query($sql4);
      if ($result4->num_rows > 0) {
        // output data of each row
        while($row4 = $result4->fetch_assoc()) { 
?>

<table class="table table-striped table-bordered file-export" style="width: 200px;float:left;">  <tbody><tr>
<th colspan="2"><?php if(!empty( $row4['totalamount'])){ echo $row4['totalamount'];} else{echo "-";}?></th>





</tbody></table>    
        <?php } } } } } else {



$sql =  "SELECT `name`  FROM `tbl_employee` WHERE `store_id` = '$store_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) { ?>
<table class="table table-striped table-bordered file-export" style="width: 200px;float:left;">  <tr>
            <th colspan="2"><?php echo $row['name'];?></th>
        </tr>
        <tr><td>Price</td><td>Service</td></tr>

     <?php   $name=$row['name']; $sql1 =  "SELECT `amount`,`services`  FROM `tbl_sales_report` WHERE `employee`='$name' AND `store_id`='$store_id' AND `sales_date`='$today_date'";
$result1 = $conn->query($sql1);

if ($result1->num_rows > 0) {
    // output data of each row
    while($row1 = $result1->fetch_assoc()) { ?>

        <tr><td><?php echo $row1['amount'];?></td><td><?php echo $row1['services'];?></td></tr>
        
        
  <?php  } }else{?>
                                                <tr><td>-</td><td>-</td></tr>
                                              <?php }
} 
?> </table><?php } ?>

                  
                     </div>                      </div> </div>
                    </div>
<h3 class="content-header-title">Total Amount</h3>
                    <div class="card-body card-dashboard">

<div class="scrollable1 text-center">
 <div style="width:3000px;"> 

<?php 
$sql =  "SELECT `name`  FROM `tbl_employee` WHERE `store_id` = '$store_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

while($row = $result->fetch_assoc()) { 

$name=$row['name'];$sql4 =  "SELECT SUM(`amount`) as totalamount  FROM `tbl_sales_report` WHERE `employee`='$name' AND `store_id` = '$store_id' AND `sales_date`='$today_date'"; 
$result4 = $conn->query($sql4);
if ($result4->num_rows > 0) {
// output data of each row
while($row4 = $result4->fetch_assoc()) { 
?>

<table class="table table-striped table-bordered file-export" style="width: 200px;float:left;">  <tbody><tr>
<th colspan="2"><?php if(!empty( $row4['totalamount'])){ echo $row4['totalamount'];} else{echo "-";}?></th>





</tbody></table>    
<?php } }


} } } ?>












</div></div>
</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light navbar-border navbar-shadow">
          <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block">Copyright &copy; 2019 <a class="text-bold-800 grey darken-2" href="" target="_blank">Loire Technologies</a></span></p>
    </footer>
    <!-- END: Footer-->


   <script src="app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    
    <script src="app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js"></script>
    <script src="app-assets/vendors/js/tables/buttons.flash.min.js"></script>
    <script src="app-assets/vendors/js/tables/jszip.min.js"></script>
    <script src="app-assets/vendors/js/tables/pdfmake.min.js"></script>
    <script src="app-assets/vendors/js/tables/vfs_fonts.js"></script>
    <script src="app-assets/vendors/js/tables/buttons.html5.min.js"></script>
    <script src="app-assets/vendors/js/tables/buttons.print.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="app-assets/js/core/app-menu.js"></script>
    <script src="app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="app-assets/js/scripts/tables/datatables/datatable-advanced.js"></script>
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>