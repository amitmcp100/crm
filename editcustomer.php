<?php
require_once("config.php");
if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
    // not logged in send to login page
    redirect("index.php");
}
$store_id = $_SESSION["store_id"];
// set page title
$title = "Dashboard";

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
                    <h3 class="content-header-title">Add Customer</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="retailers.php">Home</a>
                                </li>
                                
                                <li class="breadcrumb-item active"><a href="#">Add Customer</a>
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
                <!-- Basic form layout section start -->
                <?php
                /* Attempt MySQL server connection. Assuming you are running MySQL
                server with default setting (user 'root' with no password) */

                 //include("configinc2.php");

                // Check connection
                
                $usid=$_SESSION["user_id"];
                
                $id=$_GET['id'];
                //mysqli_free_result($result);
                
                // Close connection
                $sql11 = "SELECT *  FROM `tbl_customer_data` WHERE `store_id` = '$store_id'  and `id` = '$id'";
                //echo $sql11;
                $stmt = $DB->prepare($sql11);
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                while ($row11 = $stmt->fetch()) {
                
                $name=$row11['name'];
                $mobile=$row11['mobile'];
                $email=$row11['email'];
                $anniversary=$row11['anniversary'];
                $dob=$row11['dob'];
                $amount=$row11['amount'];
                $customer_group=$row11['customer_group'];
                $comment=$row11['comment'];
                $reminder=$row11['reminder'];
                $address=$row11['address'];
                
                 }
                
                //mysqli_free_result($result11);
                
                // Close connection
               // mysqli_close($link);
               



               
                // Close connection
               
                ?>
                <section id="horizontal-form-layouts">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="horz-layout-colored-controls">Customer Management</h4>
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
                                    
                                        <form class="form form-horizontal" action="editcustomer_code.php" method="post">
                                        <input type="hidden" name="userid" value="<?php echo $_SESSION["user_id"];?>">
                                        <input type="hidden" name="store_id" value="<?php echo $store_id;?>">
                                         <input type="hidden" name="id" value="<?php echo $id;?>">
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="la la-eye"></i> Add Customer</h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput1">Mobile No.</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input type="text" id="userinput1" class="form-control border-primary" placeholder="Mobile Number" name="mobile" value="<?php echo $mobile; ?>"  >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput2">Name</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input type="text" id="userinput2" class="form-control border-primary" placeholder="Name" name="name" value="<?php echo $name; ?>" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput3">Email</label>
                                                            <div class="col-md-9 mx-auto">
                                                                 <input type="email" id="userinput2" class="form-control border-primary" placeholder="Email" name="email"  value="<?php echo $email; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput4">Address</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input type="text" id="userinput4" class="form-control border-primary" placeholder="Address" name="address"  value="<?php echo $address; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput4">Anniversary Date</label>
                                                            <div class="col-md-9 mx-auto">
                                                               <input type="date" id="issueinput3" class="form-control" name="anniversary" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Date Opened" data-original-title="" title="" value="<?php echo $anniversary; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput4">Date Of Birth </label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input type="date" id="issueinput4" class="form-control" name="dob" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Date Fixed" data-original-title="" title="" aria-describedby="tooltip193832" value="<?php echo $dob; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6" style="display:none;">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput4">Total Amount </label>
                                                            <div class="col-md-9 mx-auto">
                                                            <input class="form-control border-primary" type="text" placeholder="Amount" id="userinput6" name="amount" value="<?php echo $amount; ?>" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput4">Customer Group </label>
                                                            <div class="col-md-9 mx-auto">
															<select class="form-control  border-primary" required="true" name="c_group">
															<option value="">Select Category</option>
                                                            <?php 
                                                            $sql1 = "SELECT *  FROM `tbl_customer_group` WHERE `store_id` = '$store_id'";
                                                            $stmt = $DB->prepare($sql1);
                                                            $stmt->execute();
                                                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                                            while ($row1 = $stmt->fetch()) {
                                                            
                                                            $name=$row1['name'];?>
                                                            <option value="<?php echo $name;?>" <?php if($customer_group==$name){echo "selected";}?>><?php echo $name;?></option>
                                                            <?php
                                                            }
                                                            ?>
															</select>
                                                               
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput8">Comment</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <textarea id="userinput8" rows="6" class="form-control border-primary" name="comment" placeholder="Comment"><?php echo $comment;?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                     <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput8">Reminder</label>
                                                            <div class="col-md-9 mx-auto">
																<div class="input-group">
																<div class="d-inline-block custom-control custom-radio mr-1">
																<input type="radio" name="reminder" class="custom-control-input"  value="yes" id="yes" <?php if($reminder=='yes'){echo "checked";}?>>
																<label class="custom-control-label" for="yes" >Yes</label>
																</div>
																<div class="d-inline-block custom-control custom-radio">
																<input type="radio" name="reminder" value="no" <?php if($reminder=='no'){echo "checked";}?> class="custom-control-input" id="no">
																<label class="custom-control-label" for="no" >No</label>
																</div>
																</div>
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