<?php
require_once("config.php");
if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
    // not logged in send to login page
    redirect("index.php");
}

// set page title
$title = "Dashboard";
$store_id  =  $_SESSION["store_id"];
$usid      =  $_SESSION["user_id"];

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
                    <h3 class="content-header-title">Reminder Setting</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="retailers.php">Home</a>
                                </li>
                                 <li class="breadcrumb-item active"><a href="#">Reminder Setting</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                
                
            </div>
            <div class="row ">
                    <?php if ($_GET['data'] == 'update') { ?> 
                    <div class="alert btn-success mb-2" role="alert">
                    <strong>Reminder Update</strong> Sucessfully...! 

                    </div>
                    <?php
                    } ?>
                    <?php if ($_GET['data'] == 'error') { ?>
                    <div class="alert alert-warning mb-2" role="alert">
                    <strong>Warning!</strong> Please Try Again !.

                    </div>
                    <?php
                    }
                    ?>   

            </div> 
               
                
            </div>
            <div class="content-body">

                <?php
                    $sql02 = "SELECT *  FROM `tbl_reminder` where `store_id` = '$store_id'";

                    $stmt = $DB->prepare($sql02);
                    $stmt->execute();
                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        
                    if($stmt == true){

                    while ($row02 = $stmt->fetch()) {
                    $reminder = $row02['reminder'];
                    $duration =$row02['duration'];
                    $id = $row02['id'];
                    //echo$row02['duration'];
                    }
                }
                
               ?>
               

            <?php
            /*Attempt MySQL server connection. Assuming you are running MySQL
             server with default setting (user 'root' with no password) */
            //include("configinc2.php");  
           
            ?>
                <section id="horizontal-form-layouts">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="horz-layout-colored-controls">Reminder Setting</h4>
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
                                    <form class="form form-horizontal" name="uploadimage"  action="reminder_setting_code.php" enctype="multipart/form-data" method="post">
                                    <input type="hidden" name="userid" value="<?php echo $userid; ?>">
                                    <input type="hidden" name="store_id" value="<?php echo $store_id; ?>">
                                    <input type="hidden" name="id" value="<?php echo $id;?>">
                                    <div class="form-body">
                                    <h4 class="form-section"><i class="la la-eye"></i> Setting Details</h4>
                                        <div class="row">
                                          
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="userinput1">Enter Number</label>
                                                <div class="col-md-9 mx-auto">
                                                    <input type="number" id="userinput1" class="form-control border-primary" placeholder="" name="reminder"  required="" value="<?php echo $reminder ?>">
                                                    <input type="hidden" name="store" value="<?php
                                                    echo $store_id;
                                                    ?>">
                                                    <input type="hidden" name="user" value="<?php
                                                    echo $userid;
                                                    ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="userinput1">Duration</label>
                                             <div class="col-md-9 mx-auto">
                                                     <select class="form-control  border-primary" id="duration"  name="duration">
                                                        <option selected="selected" value="">Select Time Duration</option>
                                                         
                                                             <option value="days" <?php if($duration == 'days') echo 'selected'; ?>>Days</option>
                                                             <option value="months"<?php if($duration == 'months') echo 'selected'; ?>>Months</option>
                                                             <option value="years"<?php  if($duration == 'years') echo 'selected'; ?>>Years</option>
                                                     </select>
                                                 </div>
                                            </div>
                                        </div>                                        
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                              <div style="margin-top:10px;margin-left: 20px;"><button type="submit" class="btn btn-primary" name="submit" value="Submit">
                                                    <i class="la la-check-square-o"></i> Save
                                                </button></div>
                                              
                                            </div>
                                        </div>

                                        </div>
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