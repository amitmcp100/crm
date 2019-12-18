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
                    <h3 class="content-header-title">Add Roles</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="retailers.php">Home</a>
                                </li>
                                
                                <li class="breadcrumb-item active"><a href="#">Add Roles</a>
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
               
                ?>
				<?php 
            //include("configinc2.php");

				// Check connection
				
				$userid=$_SESSION["user_id"];
			
				
				$id=$_GET['id'];
				$sql11 = "SELECT *  FROM `tbl_user_roles` WHERE `id` = '$id' AND `store_id` = '$store_id'";
				//echo $sql;
                $stmt = $DB->prepare($sql11);
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                while ($row11 = $stmt->fetch()) {
				
				$role_name=$row11['role_name'];
				$customer=$row11['customer'];
				$add_customer=$row11['add_customer'];
				$add_campaign=$row11['add_campaign'];
				$all_campaign=$row11['all_campaign'];
				$all_sub_user=$row11['all_sub_user'];
				$birthday=$row11['birthday'];
				$anniversary=$row11['anniversary'];
				$feedback=$row11['feedback'];
				$loyality=$row11['loyality'];
				$lost_business=$row11['lost_business'];
				$packages=$row11['packages'];

				}
				

				?>
                <section id="horizontal-form-layouts bootstrap-checkbox"  class="bootstrap-checkbox" id="">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="horz-layout-colored-controls">Roles Management</h4>
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
                                    
                                        <form class="form form-horizontal" action="editroles_code.php" method="post">
                                        <input type="hidden" name="userid" value="<?php echo $_SESSION["user_id"];?>">
                                        <input type="hidden" name="store_id" value="<?php echo $store_id;?>">
                                         <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="la la-eye"></i> Add Roles</h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput1" >Role Name</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input type="text" id="userinput1" class="form-control border-primary" placeholder="Role Name" name="role_name" value="<?php echo $role_name;?>" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput2"></label>
                                                            <div class="col-md-9 mx-auto">
																
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                             <label class="col-md-3 label-control" for="userinput2">Customer</label>
                                                            <div class="float-left">
																<input type="checkbox" name="customer" class="switch hidden" id="switch2" data-reverse="" <?php if($customer=='on'){echo "checked";}?>>
																</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                             <label class="col-md-3 label-control" for="userinput2">Add-Customer</label>
                                                            <div class="float-left">
																<input type="checkbox" name="add_customer" class="switch hidden" id="switch2" data-reverse="" <?php if($add_customer=='on'){echo "checked";}?> >
																</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                             <label class="col-md-3 label-control" for="userinput2">Add Campaign</label>
                                                            <div class="float-left">
																<input type="checkbox" name="add_campaign" class="switch hidden" id="switch2" data-reverse="" <?php if($add_campaign=='on'){echo "checked";}?>>
																</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                             <label class="col-md-3 label-control" for="userinput2">All Campaign</label>
                                                            <div class="float-left">
																<input type="checkbox" name="all_campaign" class="switch hidden" id="switch2" data-reverse="" <?php if($all_campaign=='on'){echo "checked";}?>>
																</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                             <label class="col-md-3 label-control" for="userinput2">All Sub-users</label>
                                                            <div class="float-left">
																<input type="checkbox" name="sub_users" class="switch hidden" id="switch2" data-reverse="" <?php if($all_sub_user=='on'){echo "checked";}?>>
																</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                             <label class="col-md-3 label-control" for="userinput2">Birthdate</label>
                                                            <div class="float-left">
																<input type="checkbox" name="birthday" class="switch hidden" id="switch2" data-reverse="" <?php if($birthday=='on'){echo "checked";}?>>
																</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                             <label class="col-md-3 label-control" for="userinput2">Anniversary Date</label>
                                                            <div class="float-left">
																<input type="checkbox" name="anniversary" class="switch hidden" id="switch2" data-reverse="" <?php if($anniversary=='on'){echo "checked";}?>>
																</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                             <label class="col-md-3 label-control" for="userinput2">Feedback</label>
                                                            <div class="float-left">
																<input type="checkbox" name="feedback" class="switch hidden" id="switch2" data-reverse="" <?php if($feedback=='on'){echo "checked";}?>>
																</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                             <label class="col-md-3 label-control" for="userinput2">Loyalty</label>
                                                            <div class="float-left">
																<input type="checkbox" name="loyality" class="switch hidden" id="switch2" data-reverse="" <?php if($loyality=='on'){echo "checked";}?>>
																</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                             <label class="col-md-3 label-control" for="userinput2">Regain lost business</label>
                                                            <div class="float-left">
																<input type="checkbox" name="lost_business" class="switch hidden" id="switch2" data-reverse="" <?php if($lost_business=='on'){echo "checked";}?>>
																</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                             <label class="col-md-3 label-control" for="userinput2">Packages</label>
                                                            <div class="float-left">
																<input type="checkbox" name="package" class="switch hidden" id="switch2" data-reverse="" <?php if($packages=='on'){echo "checked";}?>>
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
    <script src="app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js"></script>
    <script src="app-assets/vendors/js/forms/toggle/switchery.min.js"></script>
    <script src="app-assets/vendors/js/forms/toggle/bootstrap-checkbox.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="app-assets/js/core/app-menu.js"></script>
    <script src="app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="app-assets/js/scripts/forms/switch.js"></script>
     <link rel="stylesheet" type="text/css" href="app-assets/css/plugins/forms/switch.css">
</body>
<!-- END: Body-->

</html>