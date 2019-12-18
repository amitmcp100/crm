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

<?php
include('sidebar.php');
?> 
    <!-- END: Main Menu-->
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row mb-1">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">Sales Report</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="retailers.php">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Sales Report
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>

                

                <div class="content-header-right col-md-6 col-12">
                    <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                        <a href="add-customer.php" class="btn btn-info  box-shadow-2 px-2" ><i class="ft-plus icon-left"></i> Add Customer</a>
                    </div>
                </div>

            </div>
           

            <form class="form form-horizontal"method="post" action="">
                <div class="row">
                         <div class="col-md-3">
                            <div class="form-group row">
                                <label class="col-md-3 label-control" for="userinput4">From Date </label>
                                <div class="col-md-9 mx-auto">
                                    <input type="date" id="dob" class="form-control" name="fromDate" data-toggle="tooltip" data-trigger="hover" required="required" data-placement="top" data-title="Date Fixed" data-original-title="" title="" aria-describedby="tooltip193832">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group row">
                                <label class="col-md-3 label-control" for="userinput4">To Date </label>
                                <div class="col-md-9 mx-auto">
                                    <input type="date" id="dob" class="form-control" name="endDate" data-toggle="tooltip" data-trigger="hover" required="required" data-placement="top" data-title="Date Fixed" data-original-title="" title="" aria-describedby="tooltip193832">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group row">
                                <label class="col-md-3 label-control" for="userinput4">Employee </label>
                                <div class="col-md-9 mx-auto">
                                <select class="form-control  border-primary" id="employee"  name="employee"  required="required">
                                                            <option value="">Select Employee</option>
                                                            <?php
                                                            $sql39 = "SELECT *  FROM `tbl_employee` where `store_id` = '$store_id'";
                                                            $stmt = $DB->prepare($sql39);
                                                            $stmt->execute();
                                                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                                            if ($stmt == true) {
                                                            while ($row39 = $stmt->fetch()) {
                                                            $name = $row39['name']; ?>
                                                            <option value="<?php echo $name; ?>"><?php echo $name; ?></option>
                                                            <?php
                                                                 }
                                                                 }
                                                             ?>
                                                            </select>
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

            

            <div class="content-body">
                <!-- Zero configuration table -->
                <section id="configuration">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Sales Report</h4>
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
                                       
                                        <div class="table-responsive">
                                            <p class="card-text">Export Customer Data in Any Format</p>
                                        <div style="overflow-x:auto;">
                                        <table class="table table-striped table-bordered file-export">
                                                <thead>
                                                    <tr>
                                                        
                                                        <th>Customer Name</th>
                                                        <th>Employee Name</th>
                                                        <th>Service</th> 
                                                         <th>Product</th> 
                                                        <th>Amount</th>
                                                        <th>Mode of Payment</th>
                                                        <th>Date Of Transaction</th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                            /* Attempt MySQL server connection. Assuming you are running MySQL
                                            server with default setting (user 'root' with no password) */

                                            // Check connection
                                            
                                            $fromDate = $_POST['fromDate'];
                                            $endDate = $_POST['endDate'];
                                            $employee = $_POST['employee'];
                                            if(isset($_POST['sale_search']) AND ($fromDate AND $endDate!=''))  {
                                           
                                            //echo "hello";                                           
                                            
                                            $userid=$_SESSION["user_id"];
                                                                              
                                            $sql17 = "SELECT * FROM `tbl_sales_report` WHERE sales_date BETWEEN '".$fromDate."' AND '".$endDate."' AND employee='$employee' AND `store_id` = '$store_id'";
                                            //$sql17 = "SELECT * from `tbl_sales_report` ORDER BY `sales_date` DESC";
                                           //echo $sql17;
                                            $stmt = $DB->prepare($sql17);
                                            $stmt->execute();
                                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                            while ($row17 = $stmt->fetch()) {
                                            
                                            $id=$row17['id'];
                                            //echo "fdf".$id;
                                            $name=$row17['name'];
                                            ?>
                                            <tr>

                                                <td><?php echo $row17['name'];?></td>
                                                <td><?php echo $row17['employee'];?></td>
                                                <td><?php echo $row17['services'];?></td>  
                                                 <td><?php echo $row17['product'];?></td> 
                                                <td><?php echo $row17['amount'];?></td>
                                                <td><?php echo $row17['payment_mode'];?></td>
                                                <td><?php echo $row17['sales_date'];?></td>
                                                
                                            </tr>

                                                <?php 
                                            }
                                                $stmt->closeCursor();
                                                $DB = null;
                                            }else{
                                                              
                                                                $sql19 = "SELECT * FROM `tbl_sales_report` where  `store_id` = '$store_id' ORDER BY sales_date DESC";
                                                                //echo $sql19;
                                                                $stmt = $DB->prepare($sql19);
                                                                $stmt->execute();
                                                                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                                               
                                                                while ($row19 = $stmt->fetch()) {
                                                                ?>
                                                                <tr>
                                                                    
                                                                    <td><?php
                                                                    echo $row19['name'];?></td>
                                                                    <td><?php
                                                                    echo $row19['employee'];?></td>
                                                                    <td><?php
                                                                    echo $row19['services'];?></td>
                                                                    <td><?php
                                                                    echo $row19['product'];?></td>
                                                                    <td><?php
                                                                    echo $row19['amount'];?></td>
                                                                    <td><?php 
                                                                    echo $row19['payment_mode'];?></td>
                                                                    <td><?php
                                                                    echo $row19['sales_date'];?></td>

                                                                </tr>

                                                                <?php
                                                                }
                                                                
                                                                }

                                                                ?>
                                                                 </tbody>
                                                                            <tfoot>
                                                                                    <tr>
                                                                                    <th>Customer Name</th>
                                                                                    <th>Employee Name</th>
                                                                                    <th>Service</th>
                                                                                    <th>Product</th>  
                                                                                    <th>Amount</th>
                                                                                    <th>Mode of Payment</th>
                                                                                    <th>Date Of Transaction</th>
                                                                                </tr>
                                                                            </tfoot>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                <!--/ Zero configuration table -->
               
                <!--/ Default ordering table -->
                <!-- Multi-column ordering table -->
                 <!--/ Language - Comma decimal place table -->

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
    <script src="app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
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