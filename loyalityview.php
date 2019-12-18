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
                    <h3 class="content-header-title">Loyality Management</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="retailers.php">Home</a>
                                </li>
                                <li class="breadcrumb-item active">All Loyality
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- <div class="content-header-right col-md-6 col-12">
                    <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                        <a href="add-customer.php" class="btn btn-info  box-shadow-2 px-2" ><i class="ft-plus icon-left"></i> Add Customer</a>
                    </div>
                </div> -->
            </div>
                   <div class="row "> 
                    <?php if($_GET['data']=='update'){?> 
                    <div class="alert btn-success mb-2" role="alert">
                    <strong>Success !</strong> Update..!

                    </div>
                    <?php } ?>
                    <?php if ($_GET['data']=='error') { ?>
                    <div class="alert alert-warning mb-2" role="alert">
                    <strong>Warning!</strong> You are not able to use your points Now !.

                    </div><?php } ?>   
                
                </div>
            <div class="content-body">
                <!-- Zero configuration table -->
                <section id="configuration">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Loyality Management</h4>
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
                                            <table class="table table-striped table-bordered zero-configuration">
                                                <thead>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Amount</th>
                                                        <th>Available Points</th>
                                                        <th>Used  Points</th>
                                                        <th>Action</th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    /* Attempt MySQL server connection. Assuming you are running MySQL
                                                    server with default setting (user 'root' with no password) */
                                                    //include("configinc2.php");
                                                    // Check connection
                                                    
                                                    $usid=$_SESSION["user_id"];
                                                    $sql1 = "SELECT tbl_customer_data.name,tbl_customer_data.email,tbl_customer_data.id,tbl_customer_purchase.amount,tbl_loyality.available_points,tbl_loyality.used_points FROM ((tbl_customer_data INNER JOIN tbl_customer_purchase ON tbl_customer_data.id = tbl_customer_purchase.c_id) INNER JOIN tbl_loyality ON tbl_customer_purchase.c_id=tbl_loyality.c_id)";

                                                    //echo $sql1;
                                                    $stmt = $DB->prepare($sql1);
                                                    $stmt->execute();
                                                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                                    while ($row1 = $stmt->fetch()) {  

                                                    $id=$row1['id']; 
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $row1['id'];?></td>
                                                        <td><?php echo $row1['name'];?></td>
                                                        <td><?php echo $row1['email'];?></td>
                                                        <td><?php echo $row1['amount'];?></td>
                                                        <td><?php echo $row1['available_points'];?></td>
                                                        <td><?php echo $row1['used_points'];?></td>
                                                        
                                                        <td><!--<a href="editcustomer.php?id=<?php //echo $id;?>" data-toggle="tooltip" title="EDIT" class="btn btn-success  box-shadow-2 mr-1 mb-1"><i class="ft-edit"></i></a>-->

                                                        <a href="use_available_point.php?id=<?php echo $id;?>" class="btn btn-success  box-shadow-2 mr-1 mb-1" data-toggle="tooltip" title="use Points">use points</a>
                                                        </td>
                                                        
                                                    </tr>
                                                    <?php  }
                                                    
                                                    ?>
                                                  </tbody>
                                                  <tfoot>
                                                     <tr>
                                                        <th>Id</th>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Amount</th>
                                                        <th>Available Points</th>
                                                        <th>Used Points</th>
                                                        <th>Action</th>
                                                        
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
    <script>
    $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
    });
    </script>
    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light navbar-border navbar-shadow">
          <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block">Copyright &copy; 2019 <a class="text-bold-800 grey darken-2" href="" target="_blank">Loire Technologies</a></span></p>
    </footer>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="app-assets/js/core/app-menu.js"></script>
    <script src="app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="app-assets/js/scripts/tables/datatables/datatable-basic.js"></script>
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>