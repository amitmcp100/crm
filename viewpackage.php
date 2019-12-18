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
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="retailers.php">Home</a>
                                </li>
                                <li class="breadcrumb-item active"><a href="#">Add Package</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                    <h3 class="content-header-title mb-0">Add Package</h3>
                </div>
                <!-- <div class="content-header-right col-md-6 col-12">
                    <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                        <button class="btn btn-info round dropdown-toggle dropdown-menu-right box-shadow-2 px-2" id="btnGroupDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ft-settings icon-left"></i> Settings</button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1"><a class="dropdown-item" href="card-bootstrap.html">Cards</a><a class="dropdown-item" href="component-buttons-extended.html">Buttons</a></div>
                    </div>
                </div> -->
            </div>
            <div class="content-body">
            <?php
                /* Attempt MySQL server connection. Assuming you are running MySQL
                server with default setting (user 'root' with no password) */
                 //include("configinc2.php");

                // Check connection
                
                $usid=$_SESSION["user_id"];
                //mysqli_free_result($result); 
                $id=$_GET['id'];
                // Close connection
				$sql01 = "SELECT *  FROM `tbl_package` WHERE  `id` = '$id' AND `store_id` ='$store_id'";
                $stmt = $DB->prepare($sql01);
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                while ($row01 = $stmt->fetch()) { 
					$package_name=$row01['package_name'];
					$package_price=$row01['package_price'];
					$package_expiry=$row01['package_expiry'];
					$package_days=$row01['package_days'];
					$services=$row01['services'];

				}
                
                ?>
                
                <!-- Form repeater section start -->
                <section id="form-repeater">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="repeat-form">Add Package</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                  <form class="form form-horizontal" action="addpackage_code.php" method="post">
                                  <input type="hidden" name="userid" value="<?php echo $_SESSION["user_id"];?>">
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="userinput1" >Enter Package Name</label>
                                                <div class="col-md-9 mx-auto">
                                                   <?php echo $package_name;?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="userinput2">Package Price</label>
                                                <div class="col-md-9 mx-auto">
                                                   <?php echo $package_price;?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="userinput1" >Enter Expiry of package</label>
                                                <div class="col-md-9 mx-auto">
                                                    <?php echo $package_expiry;?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="userinput2">Days</label>
                                                <div class="col-md-9 mx-auto">
                                                   <?php echo $package_days;?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                              
                                        <?php $data_val=unserialize($services);
														//   echo "<pre>";print_r($data_val);
														foreach($data_val as $datarow){
														//echo $datarow['services']." ".$datarow['package_qty'];
														//echo "</br>";

														// }
														$data_services=$datarow['services'];
														?>
                                        <div class="repeater-default">
                                            <div data-repeater-list="car">
                                                <div data-repeater-item>
                                                    <div class="form row">
														
                                                        <div class="form-group mb-1 col-sm-12 col-md-4">
                                                            <label for="email-addr">Service</label>
                                                            <br>
                                                            <?php echo $datarow['services'] ?>
                                                        </div>
                                                        <div class="form-group mb-1 col-sm-12 col-md-4">
                                                            <label for="pass">Quantity</label>
                                                            <br>
                                                           <?php echo $datarow['package_qty'];?>
                                                        </div>
                                                        
                                                       
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            
                                            <?php } ?>
                                        </div>
                                    </div>
                                    
                                </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Form repeater section end -->

                <!-- Form control repeater section start -->
                  
                <!-- // Form control repeater section end -->
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
    <script src="app-assets/vendors/js/ui/jquery.sticky.js"></script>
    <script src="app-assets/vendors/js/forms/repeater/jquery.repeater.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="app-assets/js/core/app-menu.js"></script>
    <script src="app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="app-assets/js/scripts/forms/form-repeater.js"></script>
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>