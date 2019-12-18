<?php
require_once("config.php");
if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
    // not logged in send to login page
    redirect("index.php");
}

// set page title
$title = "Dashboard";

$store_id =  $_SESSION['store_id'];

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
                                
                                <li class="breadcrumb-item active"><a href="#">Edit employee</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                
                
            </div>
            
            <?php
 
                        $usid=$_SESSION["user_id"];
                        $employee_id= $_GET['id'];

                        $sql1 = "SELECT `name`,`designation`  FROM `tbl_employee` WHERE `id` = '$employee_id' and `store_id` = '$store_id'";
                        $stmt = $DB->prepare($sql1);
                        $stmt->execute();
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        while ($row1 = $stmt->fetch()) {
    
                        $name=$row1['name'];
                        $designation=$row1['designation'];
                        }
                    
                        ?>

                <div class="content-body">
               
                <section id="horizontal-form-layouts">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="horz-layout-colored-controls">Add Employee</h4>
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
                                    
                                     <form class="form form-horizontal" name="uploadimage"  action="add-employeecode.php" enctype="multipart/form-data" method="post">
                                    <div class="form-body">
                                    <input type="hidden" name="employee_id" value=<?php echo$employee_id;?>>
                                    <h4 class="form-section"><i class="la la-eye"></i> Employee Details</h4>
                                        <div class="row">
                                          
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="userinput1">Employee Name</label>
                                                <div class="col-md-9 mx-auto">
                                                    <input type="text" id="userinput1" class="form-control border-primary" placeholder="Employee Name" value="<?php echo $name;?>" name="name"  required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="userinput1">Employee Designation</label>
                                                <div class="col-md-9 mx-auto">
                                                    <input type="text" id="userinput1" class="form-control border-primary" placeholder="Designation" name="des" value="<?php echo  $designation;?>">
                                                </div>
                                            </div>
                                        </div>

                                    <?php

                                    $sql21 = "SELECT `time_slot`  FROM `tbl_timeslot` WHERE `emp_id` = '$employee_id' and `store_id` = '$store_id'";
                                    $stmt = $DB->prepare($sql21);
                                    $stmt->execute();
                                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                    while ($row21 = $stmt->fetch()) {

                                    $timeslot[]=$row21['time_slot'];
                            
                                    }
                                  

                                    ?>
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="userinput1" style="text-align:left !important;">Working Time</label>
                                                <div class="col-md-12 mx-auto">
                                                   <div class="timeslot"><fieldset class="checkbox" style="width:105px; float:left; padding:5px;"><label style="padding:5px;border:1px #333 solid;">
                                                   <input type="checkbox" name="timeslot[]" value="09:00 AM" <?php if(@in_array("09:00 AM",$timeslot)){?> checked="checked"<?php }?>>09:00 AM</label></fieldset><fieldset class="checkbox" style="width:105px; float:left; padding:5px;"><label style="padding:5px;border:1px #333 solid;">
                                                   <input type="checkbox" name="timeslot[]" value="09:30 AM"<?php if(@in_array("09:30 AM",$timeslot)){?> checked="checked"<?php }?>>09:30 AM</label></fieldset><fieldset class="checkbox" style="width:105px; float:left; padding:5px;"><label style="padding:5px;border:1px #333 solid;">
                                                   <input type="checkbox" name="timeslot[]" value="10:00 AM" <?php if(@in_array("10:00 AM",$timeslot)){?> checked="checked"<?php }?>>10:00 AM</label></fieldset><fieldset class="checkbox" style="width:105px; float:left; padding:5px;"><label style="padding:5px;border:1px #333 solid;">
                                                   <input type="checkbox" name="timeslot[]" value="10:30 AM" <?php if(@in_array("10:30 AM",$timeslot)){?> checked="checked"<?php }?>>10:30 AM</label></fieldset><fieldset class="checkbox" style="width:105px; float:left; padding:5px;"><label style="padding:5px;border:1px #333 solid;">
                                                   <input type="checkbox" name="timeslot[]" value="11:00 AM" <?php if(@in_array("11:00 AM",$timeslot)){?> checked="checked"<?php }?>>11:00 AM</label></fieldset><fieldset class="checkbox" style="width:105px; float:left; padding:5px;"><label style="padding:5px;border:1px #333 solid;">
                                                   <input type="checkbox" name="timeslot[]" value="11:30 AM" <?php if(@in_array("11:30 AM",$timeslot)){?> checked="checked"<?php }?>>11:30 AM</label></fieldset><fieldset class="checkbox" style="width:105px; float:left; padding:5px;"><label style="padding:5px;border:1px #333 solid;">
                                                   <input type="checkbox" name="timeslot[]" value="12:00 PM" <?php if(@in_array("12:00 PM",$timeslot)){?> checked="checked"<?php }?>>12:00 PM</label></fieldset><fieldset class="checkbox" style="width:105px; float:left; padding:5px;"><label style="padding:5px;border:1px #333 solid;">
                                                   <input type="checkbox" name="timeslot[]" value="12:30 PM" <?php if(@in_array("12:30 PM",$timeslot)){?> checked="checked"<?php }?>>12:30 PM</label></fieldset><fieldset class="checkbox" style="width:105px; float:left; padding:5px;"><label style="padding:5px;border:1px #333 solid;">
                                                   <input type="checkbox" name="timeslot[]" value="01:00 PM" <?php if(@in_array("01:00 PM",$timeslot)){?> checked="checked"<?php }?>>01:00 PM</label></fieldset><fieldset class="checkbox" style="width:105px; float:left; padding:5px;"><label style="padding:5px;border:1px #333 solid;">
                                                   <input type="checkbox" name="timeslot[]" value="01:30 PM" <?php if(@in_array("01:30 PM",$timeslot)){?> checked="checked"<?php }?>>01:30 PM</label></fieldset><fieldset class="checkbox" style="width:105px; float:left; padding:5px;"><label style="padding:5px;border:1px #333 solid;">
                                                   <input type="checkbox" name="timeslot[]" value="02:00 PM" <?php if(@in_array("02:00 PM",$timeslot)){?> checked="checked"<?php }?>>02:00 PM</label></fieldset><fieldset class="checkbox" style="width:105px; float:left; padding:5px;"><label style="padding:5px;border:1px #333 solid;">
                                                   <input type="checkbox" name="timeslot[]" value="02:30 PM" <?php if(@in_array("02:30 PM",$timeslot)){?> checked="checked"<?php }?>>02:30 PM</label></fieldset><fieldset class="checkbox" style="width:105px; float:left; padding:5px;"><label style="padding:5px;border:1px #333 solid;">
                                                   <input type="checkbox" name="timeslot[]" value="03:00 PM" <?php if(@in_array("03:00 PM",$timeslot)){?> checked="checked"<?php }?>>03:00 PM</label></fieldset><fieldset class="checkbox" style="width:105px; float:left; padding:5px;"><label style="padding:5px;border:1px #333 solid;">
                                                   <input type="checkbox" name="timeslot[]" value="03:30 PM" <?php if(@in_array("03:30 PM",$timeslot)){?> checked="checked"<?php }?>>03:30 PM</label></fieldset><fieldset class="checkbox" style="width:105px; float:left; padding:5px;"><label style="padding:5px;border:1px #333 solid;">
                                                   <input type="checkbox" name="timeslot[]" value="04:00 PM" <?php if(@in_array("04:00 PM",$timeslot)){?> checked="checked"<?php }?>>04:00 PM</label></fieldset><fieldset class="checkbox" style="width:105px; float:left; padding:5px;"><label style="padding:5px;border:1px #333 solid;">
                                                   <input type="checkbox" name="timeslot[]" value="04:30 PM" <?php if(@in_array("04:30 PM",$timeslot)){?> checked="checked"<?php }?>>04:30 PM</label></fieldset><fieldset class="checkbox" style="width:105px; float:left; padding:5px;"><label style="padding:5px;border:1px #333 solid;">
                                                   <input type="checkbox" name="timeslot[]" value="05:00 PM" <?php if(@in_array("05:00 PM",$timeslot)){?> checked="checked"<?php }?>>05:00 PM</label></fieldset><fieldset class="checkbox" style="width:105px; float:left; padding:5px;"><label style="padding:5px;border:1px #333 solid;">
                                                   <input type="checkbox" name="timeslot[]" value="05:30 PM" <?php if(@in_array("05:30 PM",$timeslot)){?> checked="checked"<?php }?>>05:30 PM</label></fieldset><fieldset class="checkbox" style="width:105px; float:left; padding:5px;"><label style="padding:5px;border:1px #333 solid;">
                                                   <input type="checkbox" name="timeslot[]" value="06:00 PM" <?php if(@in_array("06:00 PM",$timeslot)){?> checked="checked"<?php }?>>06:00 PM</label></fieldset><fieldset class="checkbox" style="width:105px; float:left; padding:5px;"><label style="padding:5px;border:1px #333 solid;">
                                                   <input type="checkbox" name="timeslot[]" value="06:30 PM" <?php if(@in_array("06:30 PM",$timeslot)){?> checked="checked"<?php }?>>06:30 PM</label></fieldset><fieldset class="checkbox" style="width:105px; float:left; padding:5px;"><label style="padding:5px;border:1px #333 solid;">
                                                   <input type="checkbox" name="timeslot[]" value="07:00 PM" <?php if(@in_array("07:00 PM",$timeslot)){?> checked="checked"<?php }?>>07:00 PM</label></fieldset><fieldset class="checkbox" style="width:105px; float:left; padding:5px;"><label style="padding:5px;border:1px #333 solid;">
                                                   <input type="checkbox" name="timeslot[]" value="07:30 PM" <?php if(@in_array("07:30 PM ",$timeslot)){?> checked="checked"<?php }?>>07:30 PM</label></fieldset><fieldset class="checkbox" style="width:105px; float:left; padding:5px;"><label style="padding:5px;border:1px #333 solid;">
                                                   <input type="checkbox" name="timeslot[]" value="08:00 PM" <?php if(@in_array("08:00 PM",$timeslot)){?> checked="checked"<?php }?>>08:00 PM</label></fieldset><fieldset class="checkbox" style="width:105px; float:left; padding:5px;"><label style="padding:5px;border:1px #333 solid;">
                                                   <input type="checkbox" name="timeslot[]" value="08:30 PM" <?php if(@in_array("08:30 PM",$timeslot)){?> checked="checked"<?php }?>>08:30 PM</label></fieldset><fieldset class="checkbox" style="width:105px; float:left; padding:5px;"><label style="padding:5px;border:1px #333 solid;">
                                                   <input type="checkbox" name="timeslot[]" value="09:00 PM" <?php if(@in_array("09:00 PM",$timeslot)){?> checked="checked"<?php }?>>09:00 PM</label></fieldset></div>
                                                </div>
                                            </div>
                                        </div>
                                   
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                               
                                                <div class="col-md-9 mx-auto">
                                                   
                                                   <input type="hidden" name="userid" value="<?php echo $_SESSION["user_id"]; ?>">
                                                   <div style="margin-top:10px;"><button type="submit" class="btn btn-primary" name="submit" value="Submit">
                                                    <i class="la la-check-square-o"></i> Save
                                                </button></div>
                                                </div>
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