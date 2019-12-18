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
                    <h3 class="content-header-title">Add Campaign</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="retailers.php">Home</a>
                                </li>
                                
                                <li class="breadcrumb-item active"><a href="#">Add Campaign</a>
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
                
               $usid=$_SESSION["user_id"];
            
                //mysqli_free_result($result);
                //}
                // Close connection
                



               
                // Close connection
               
                ?>
                <section id="horizontal-form-layouts">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="horz-layout-colored-controls">Campaign Management</h4>
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
                                    <?php 
                                    //include("configinc2.php");

									// Check connection
									$userid=$_SESSION["user_id"];
									$id=$_GET['id'];
									$sql11 = "SELECT *  FROM `tbl_campaign` WHERE `id` = '$id' and `store_id` = '$store_id'";
									//echo $sql;
                                    $stmt = $DB->prepare($sql11);
                                    $stmt->execute();
                                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                    while ($row11 = $stmt->fetch()) {
									
									$campaign_category=$row11['campaign_category'];
									$campaign_name=$row11['campaign_name'];
									$campaign_sms=$row11['campaign_sms'];
									$customer_category=$row11['customer_category'];
									$customer_group=$row11['customer_group'];
									$campaign_before=$row11['campaign_before'];
									$date_time=$row11['date_time'];
									$create_date=$row11['create_date'];
									$status=$row11['status'];

									}
									


									?>
                                        <form class="form form-horizontal" action="editcampaign_code.php" method="post">
                                        <input type="hidden" name="userid" value="<?php echo $_SESSION["user_id"];?>">
                                         <input type="hidden" name="id" value="<?php echo $id;?>">
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="la la-eye"></i> Add Campaign</h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput2">Campaigns Category</label>
                                                            <div class="col-md-9 mx-auto">
															<select class="form-control border-input editor" id="get_camp_cat" name="campaigns_category" required="true">

															<option value="">Select</option>
															<option value="birthday" <?php if($campaign_category=='birthday'){echo "selected";}?> >Birthday</option>
															<option value="Anniversary" <?php if($campaign_category=='Anniversary'){echo "selected";}?>>Anniversary</option>
															<option value="loyalty" <?php if($campaign_category=='loyalty'){echo "selected";}?>> Loyalty </option>
															<option value="regain_lost_business" <?php if($campaign_category=='regain_lost_business'){echo "selected";}?>> Regain lost business </option>
															<option value="custom" <?php if($campaign_category=='custom'){echo "selected";}?>> Custom </option>
															</select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                       <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput3">Campaign Name</label>
                                                            <div class="col-md-9 mx-auto">
                                                                 <input type="text" id="userinput2" class="form-control border-primary" placeholder="Campaign Name" name="campaign_name" value="<?php echo $campaign_name; ?>" required >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                         <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput4">Customer Group </label>
                                                            <div class="col-md-9 mx-auto">
															<select class="form-control  border-primary" name="c_group">
															<option value="">Select Category</option>
                                                            <?php 
                                                            $sql1 = "SELECT *  FROM `tbl_customer_group` WHERE `store_id` = '$store_id'";
                                                            $stmt = $DB->prepare($sql1);
                                                            $stmt->execute();
                                                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                                            while ($row1 = $stmt->fetch()) {
                                                            
                                                            $name=$row1['name'];?>
                                                            <option value="<?php echo $name;?>" <?php if($customer_group==$name){echo "selected";}?> ><?php echo $name;?></option>
                                                            <?php
                                                            }
                                                            ?>
															</select>
                                                               
                                                            </div> </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput4">Customer Category</label>
                                                            <div class="col-md-9 mx-auto">
															<select name="category" class="form-control ">
															<option value="customer" <?php if($customer_category=='customer'){echo "selected";}?> >All</option>
															<option value="enquiry"  <?php if($customer_category=='enquiry'){echo "selected";}?>>enquiry</option>
															</select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                    	<div class="form-group row">
                                                        <label class="col-md-3 label-control" for="userinput4" >Send  before</label>
                                                         <div class="col-md-9 mx-auto">
														<select class="form-control" name="beforedays" required="true" id="basicSelect">
														<option>Select Option</option>
														<option value="1" <?php if($campaign_before=='1'){echo "selected";}?>>1 Day</option>
														<option value="2" <?php if($campaign_before=='2'){echo "selected";}?>>2 Days</option>
														<option value="3" <?php if($campaign_before=='3'){echo "selected";}?>>3 Days</option>
														<option value="4" <?php if($campaign_before=='4'){echo "selected";}?>>4 Days</option>
														<option value="5" <?php if($campaign_before=='5'){echo "selected";}?>>5 Days</option>
														<option value="6" <?php if($campaign_before=='6'){echo "selected";}?>>6 Days</option>
														<option value="7" <?php if($campaign_before=='7'){echo "selected";}?>>7 Days</option>
														<option value="8" <?php if($campaign_before=='8'){echo "selected";}?>>8 Days</option>
														<option value="9" <?php if($campaign_before=='9'){echo "selected";}?>>9 Days</option>
														</select></div>
                                                    </div> </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput4">Campaign SMS Time
                                                       </label>
                                                            <div class="col-md-9 mx-auto">
                                                                
						                                        <input type="datetime-local" class="form-control" id="dateTime1" name="datetime" value="<?php echo  date('Y-m-d\Th:i', strtotime($date_time));?>">
						                                       
						                                        </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput4">Campaign SMS </label>
                                                            <div class="col-md-9 mx-auto">
                                                            <textarea name="sms_text" class="form-control textarea-maxlength" id="maxlength-textarea" placeholder="Enter upto 160 characters.." maxlength="160" rows="5" required><?php echo $campaign_sms;?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput4">Status </label>
                                                            <div class="col-md-9 mx-auto">
                                                            <select class="form-control  border-primary" name="status">
                                                            <option value="enabled" <?php if($status=='enabled'){echo "selected";}?>>Enabled</option>
                                                            <option value="disabled" <?php if($status=='disabled'){echo "selected";}?>>Disabled</option>
                                                            </select>
                                                               
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