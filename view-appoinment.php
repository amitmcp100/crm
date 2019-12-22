<?php
require_once("config.php");
if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
    // not logged in send to login page
    redirect("index.php");
}

// set page title
$title     = "Dashboard";

$store_id  = $_SESSION['store_id'];

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
                    <h3 class="content-header-title">View Appoinment</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                               
                                <li class="breadcrumb-item active">View Appoinment
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
                    </div>
                    <?php } ?>                   
                </div>
            <div class="content-body">
                <!-- Zero configuration table -->
                <section id="configuration">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Appoinment Management</h4>
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
                                                        <th>Action</th>
                                                        <th>Cust. Name</th>
                                                        <th>Cust. Mobile</th>
                                                        <th>Cust. Email</th>  
                                                        <th>Cust. Address</th>
                                                        <th>Appoinment Date</th>
                                                        <th>Appoinment Time</th>
                                                        <th>Employee</th>
                                                        <th>Services</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                <?php 

                                                $sql3 = "SELECT tbl_appoinment.id,tbl_appoinment.services,tbl_appoinment.c_name,tbl_appoinment.c_mobile,tbl_appoinment.c_email,tbl_appoinment.c_address
                                                ,tbl_appoinment.date,tbl_appoinment.time_slot,tbl_employee.name FROM tbl_appoinment INNER JOIN tbl_employee ON 
                                                tbl_appoinment.emp_id=tbl_employee.id where tbl_appoinment.store_id = '$store_id'";

                                                $stmt = $DB->prepare($sql3);
                                                $stmt->execute();
                                                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                                while ($row3 = $stmt->fetch()) { ?>
                                                 <tr>
                                                        <td> <a href="deleteappintment.php?id=<?php echo $row3['id'];?>" onclick="return confirm('Are you sure you want to delete this Appintment?');" class="btn btn-warning  box-shadow-2 mr-1 mb-1" data-toggle="tooltip" title="DELETE APPOINMENT"><i class="ft-delete"></i></a></td>
                                                        <td><?php echo $row3['c_name'];?></td>
                                                        <td><?php echo $row3['c_mobile'];?></td>
                                                        <td><?php echo $row3['c_email'];?></td>
                                                        <td><?php echo $row3['c_address'];?></td>
                                                        <td><?php echo $row3['date'];?></td>
                                                        <td><?php echo $row3['time_slot'];?></td>
                                                        <td><?php echo $row3['name'];?></td>
                                                        <td><?php $servics= $row3['services'];  $ser_un=unserialize($servics);
                                                        foreach ($ser_un as $ser){
                                                        	//echo $ser;
                                                        	echo str_replace("|"," Qty:",$ser);

                                                        	echo "</br>";
                                                        }
                                                        ?></td>
                                                       
                                                       
                                                        
                                                    </tr>
                                            
                                                    <?php  } ?>
													
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Action</th>
                                                        <th>Cust. Name</th>
                                                        <th>Cust. Mobile</th>
                                                        <th>Cust. Email</th>  
                                                        <th>Cust. Address</th>
                                                        <th>Appoinment Date</th>
                                                        <th>Appoinment Time</th>
                                                        <th>Employee</th>
                                                        <th>Services</th>
                                                       
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