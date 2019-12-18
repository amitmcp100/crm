<?php
require_once("config.php");
if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
    // not logged in send to login page
    redirect("index.php");
}

// set page title
$title = "Dashboard";

// if the rights are not set then add them in the current session
if (!isset($_SESSION["access"])) {
    
    try {
        
        $sql = "SELECT mod_modulegroupcode, mod_modulegroupname FROM module " . " WHERE 1 GROUP BY `mod_modulegroupcode` " . " ORDER BY `mod_modulegrouporder` ASC, `mod_moduleorder` ASC  ";
        
        
        $stmt = $DB->prepare($sql);
        $stmt->execute();
        $commonModules = $stmt->fetchAll();
        
        $sql = "SELECT mod_modulegroupcode, mod_modulegroupname, mod_modulepagename,  mod_modulecode, mod_modulename FROM module " . " WHERE 1 " . " ORDER BY `mod_modulegrouporder` ASC, `mod_moduleorder` ASC  ";
        
        $stmt = $DB->prepare($sql);
        $stmt->execute();
        $allModules = $stmt->fetchAll();
        
        $sql = "SELECT rr_modulecode, rr_create,  rr_edit, rr_delete, rr_view FROM role_rights " . " WHERE  rr_rolecode = :rc " . " ORDER BY `rr_modulecode` ASC  ";
        
        $stmt = $DB->prepare($sql);
        $stmt->bindValue(":rc", $_SESSION["rolecode"]);
        
        
        $stmt->execute();
        $userRights = $stmt->fetchAll();
        
        $_SESSION["access"] = set_rights($allModules, $userRights, $commonModules);
        
    }
    catch (Exception $ex) {
        
        echo $ex->getMessage();
    }
}




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
                                                        
                                                        <th>Employee</th>
                                                        <th>Service</th>
                                                        <th>Mobile</th>   
                                                        <th>Amount</th>
                                                        <th>Mode</th>
                                                        <th>Date Of Transaction</th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                            /* Attempt MySQL server connection. Assuming you are running MySQL
                                            server with default setting (user 'root' with no password) */

                                            // Check connection
                                            if(isset($_POST['todaysales'])){

                                            $fromDate = date("Y-m-d");
                                            $endDate = date('Y-m-d');

                                            


                                            $sql41 = "SELECT * FROM `tbl_sales_report`  WHERE sales_date BETWEEN '".$fromDate."' AND '".$endDate."'";
                                            //$sql17 = "SELECT * from `tbl_sales_report`";
                                           // echo $sql41;
                                            $stmt = $DB->prepare($sql41);
                                            $stmt->execute();
                                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                            while ($row41 = $stmt->fetch()) {
                                            
                                            $id=$row41['id'];
                                            //echo "fdf".$id;
                                            $name=$row41['name'];
                                          
                                            ?>
                                            <tr>
                                               
                                                <td><?php echo $row41['employee'];?></td>
                                                <td><?php echo $row41['services'];?></td>
                                                <td><?php echo $row41['mobile'];?></td>
                                                <td><?php echo $row41['amount'];?></td>
                                                <td><?php
                                                    echo $row41['mode'];
                                                ?></td>
                                                <td>
                                                    <?php echo $row41['sales_date'];?>
                                                </td>
                                                
                                            </tr>
                                                <?php } }?>

                                                           </tbody>
                                                                            <tfoot>
                                                                                <tr>
                                                                                   
                                                                                   
                                                                                    <th>Employee</th>
                                                                                    <th> Services</th>   
                                                                                    <th>Mobile</th>
                                                                                    <th>Amount</th>
                                                                                    <th>Mode</th>
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