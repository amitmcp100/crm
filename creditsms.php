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
   <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row mb-1">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">SMS Credit</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="retailers.php">Home</a>
                                </li>
                                
                                <li class="breadcrumb-item active"><a href="#">SMS Credit</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                
                
            </div>
            <div class="row ">
                  
            <?php if($_GET['data']=='update'){?> 
            <div class="alert btn-success mb-2" role="alert">
            <strong>Success !</strong> Update..!
                
            </div>
            <?php } ?>
            <?php if ($_GET['data']=='error') { ?>
            <div class="alert alert-warning mb-2" role="alert">
            <strong>Warning!</strong> Please Try Again !.
                
            </div><?php } ?>   
                
                </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <?php
                /* Attempt MySQL server connection. Assuming you are running MySQL
                server with default setting (user 'root' with no password) */

                //include("configinc2.php");
                // Check connection
                
                $userid=$_SESSION["user_id"];
                // Attempt select query execution
                //mysqli_free_result($result);
                // Close connection
                $sql11 = "SELECT *  FROM `creditsms` WHERE `store_id` = '$store_id'";
                $stmt = $DB->prepare($sql11);
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                while ($row11 = $stmt->fetch()) {
                $total_sms_purchased=$row11['total_sms_purchased'];
                $available_sms=$row11['available_sms'];
                $used_sms=$row11['used_sms'];
               
                }
                // Close connection
                ?>
                <section id="horizontal-form-layouts">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="horz-layout-colored-controls">SMS Credit</h4>
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
                                    
                                        <form class="form form-horizontal" action="addcustomer_code.php" method="post">
                                        <input type="hidden" name="userid" value="<?php echo $_SESSION["user_id"];?>">
                                        <input type="hidden" name="store_id" value="<?php echo $store_id;?>">
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="la la-eye"></i> SMS Management</h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput1">Total SMS Purchased</label>
                                                            <div class="col-md-9 mx-auto">
                                                               <?php echo $total_sms_purchased;?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput2">Available SMS</label>
                                                            <div class="col-md-9 mx-auto">
                                                                 <?php echo $available_sms;?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput3">Used SMS</label>
                                                            <div class="col-md-9 mx-auto">
                                                                 <?php echo $used_sms;?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput4">SMS Amount (Buy)</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input type="text" id="userinput4" class="form-control border-primary" placeholder="SMS Amount (Buy)" name="amount"  >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                           
                                                            <div class="col-md-9 mx-auto">
                                                               <p>Buy SMS Credit :- 0.2124 ₹ per/sms</p>
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