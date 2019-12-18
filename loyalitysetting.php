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
                    <h3 class="content-header-title">Loyality Settings</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="retailers.php">Home</a>
                                </li>
                                
                                <li class="breadcrumb-item active"><a href="#">Loyality Settings</a>
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
            <strong>Warning!</strong> Please Try Again!.

            </div><?php } ?>   
                
                </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <?php
                /* Attempt MySQL server connection. Assuming you are running MySQL
                server with default setting (user 'root' with no password) */
                 //include("configinc2.php");

                // Check connection
                
               $usid=$_SESSION["user_id"];
            
                
               // mysqli_free_result($result);
                
                // Close connection
                


				$sql2 = "SELECT *  FROM `loyality_setting` WHERE `store_id` = '$store_id'";
                $stmt = $DB->prepare($sql2);
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                
                while ($row2 = $stmt->fetch()) {  
				
				$id=$row2['id'];
				$status=$row2['status'];
				$loyality_expiry=$row2['loyality_expiry'];
				$min_points=$row2['min_points'];
				$max_points=$row2['max_points'];
				$rupee_value=$row2['rupee_value'];
				$loyality_point_earn=$row2['loyality_point_earn'];
				$t_sale=$row2['t_sale'];
                $loyality_points=$row2['loyality_points'];
				}
				
                ?>
                <section id="horizontal-form-layouts">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="horz-layout-colored-controls">Loyality Management</h4>
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
                                    
                                        <form class="form form-horizontal" action="loyalitysetting_code.php" method="post">
                                        <input type="hidden" name="userid" value="<?php echo $userid;?>">
                                        <input type="hidden" name="store_id" value="<?php echo $store_id;?>">
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="la la-eye"></i> Loyality Settings</h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput1">Status</label>
                                                            <div class="col-md-9 mx-auto">
                                                               
																<div class="input-group">
																<div class="d-inline-block custom-control custom-radio mr-1">
																<input type="radio" name="status" class="custom-control-input" value="yes" id="yes" <?php if($status=='yes'){echo "checked";} ?>>
																<label class="custom-control-label" for="yes" >On</label>
																</div>
																<div class="d-inline-block custom-control custom-radio">
																<input type="radio" name="status" value="no"  class="custom-control-input" id="no" <?php if($status=='no'){echo "checked";} ?>>
																<label class="custom-control-label" for="no">Off</label>
																</div>
																</div>
                                                            
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput2">Loyalty point expiry(days)</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input type="text" id="userinput2" class="form-control border-primary" placeholder="Loyalty point expiry(days)" name="loyality_expiry" value="<?php echo $loyality_expiry;?>" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput3">Minimum Points to redeem</label>
                                                            <div class="col-md-9 mx-auto">
                                                                 <input type="text" id="userinput2" class="form-control border-primary" placeholder="Minimum Points to redeem" name="min_points" value="<?php echo $min_points;?>" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput4">Maximum Points to redeem</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input type="text" id="userinput4" class="form-control border-primary" placeholder="Maximum Points to redeem" name="max_points" value="<?php echo $max_points;?>" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                  
                                                </div>
                                                  <div class="form-body">
                                                <h4 class="form-section"><i class="la la-eye"></i> Loyalty Points Redeem Settings</h4></div>
                                                    <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput3">Value of 1 Rupee</label>
                                                            <div class="col-md-9 mx-auto">
                                                                 <input type="text" id="userinput2" class="form-control border-primary" placeholder="Value of 1 Rupee" name="rupee_value" value="<?php echo $rupee_value;?>" >

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput4">Loyalty Points</label>
                                                            <div class="col-md-9 mx-auto">
                                                               <input type="text" id="userinput2" class="form-control border-primary" placeholder="loyality_points" name="loyality_points" value="<?php echo  $loyality_points;?>" >   
                                                            </div>
                                                        </div>
                                                    </div> </div>
                                                      <div class="form-body">
                                                <h4 class="form-section"><i class="la la-eye"></i> Loyalty Points Earn Settings</h4></div>
                                                    <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput3">Loyalty Point Earned</label>
                                                            <div class="col-md-9 mx-auto">
                                                                 <input type="text" id="userinput2" class="form-control border-primary" placeholder="Loyalty Point Earned " name="loyality_point_earn" value="<?php echo $loyality_point_earn;?>" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput4">Of Total Sale</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <select class="form-control  border-primary" required="true" name="t_sale">
															<option value="">Select </option>
                                                            
                                                            <option value="Percent" <?php if($t_sale=='Percent'){echo "selected";}?>>Percent</option>
                                                            <option value="Fixed" <?php if($t_sale=='Fixed'){echo "selected";}?>>Fixed</option>
                                                            
															</select>
                                                            </div>
                                                        </div>
                                                    </div> </div>
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