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

        $sql = "SELECT mod_modulegroupcode, mod_modulegroupname FROM module "
                . " WHERE 1 GROUP BY `mod_modulegroupcode` "
                . " ORDER BY `mod_modulegrouporder` ASC, `mod_moduleorder` ASC  ";


        $stmt = $DB->prepare($sql);
        $stmt->execute();
        $commonModules = $stmt->fetchAll();

        $sql = "SELECT mod_modulegroupcode, mod_modulegroupname, mod_modulepagename,  mod_modulecode, mod_modulename FROM module "
                . " WHERE 1 "
                . " ORDER BY `mod_modulegrouporder` ASC, `mod_moduleorder` ASC  ";

        $stmt = $DB->prepare($sql);
        $stmt->execute();
        $allModules = $stmt->fetchAll();

        $sql = "SELECT rr_modulecode, rr_create,  rr_edit, rr_delete, rr_view FROM role_rights "
                . " WHERE  rr_rolecode = :rc "
                . " ORDER BY `rr_modulecode` ASC  ";

        $stmt = $DB->prepare($sql);
        $stmt->bindValue(":rc", $_SESSION["rolecode"]);
        
        
        $stmt->execute();
        $userRights = $stmt->fetchAll();

        $_SESSION["access"] = set_rights($allModules, $userRights, $commonModules);

    } catch (Exception $ex) {

        echo $ex->getMessage();
    }
}




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
                
                $userid=$_SESSION["user_id"];
                // Attempt select query execution

                $sql = "SELECT *  FROM `tbl_user_group` WHERE `child_id` = '$userid'";
                $stmt = $DB->prepare($sql);
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                while ($row = $stmt->fetch()) {
                $store_id=$row['store_id'];
                
                 }
                
                //mysqli_free_result($result);
                
                $id=$_GET['id'];
                // Close connection
				$sql01 = "SELECT *  FROM `tbl_package` WHERE `store` = '$store_id' and `id` = '$id'";
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
                
                 // Close connection
               
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
                                        <input type="hidden" name="store_id" value="<?php echo $store_id;?>">
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="userinput1" >Enter Package Name</label>
                                                <div class="col-md-9 mx-auto">
                                                    <input type="text" id="userinput1" class="form-control border-primary" placeholder="Enter Package Name" name="package_name"  value="<?php echo $package_name;?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="userinput2">Package Price</label>
                                                <div class="col-md-9 mx-auto">
                                                    <input type="text" id="name" class="form-control border-primary" placeholder="Enter Package Price" name="package_price" value="<?php echo $package_price;?>" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="userinput1" >Enter Expiry of package</label>
                                                <div class="col-md-9 mx-auto">
                                                    <input type="text" id="userinput1" class="form-control border-primary" placeholder="Enter Expiry of package" name="package_expiry" value="<?php echo $package_expiry;?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="userinput2">Days</label>
                                                <div class="col-md-9 mx-auto">
                                                   <select class="form-control" id="profession" name="package_days">
                                                                <option value="Days" <?php if($package_days=='Days'){echo "selected";}?>>Days</option>
                                                                <option value="Months" <?php if($package_days=='Months'){echo "selected";}?>>Months</option>
                                                                <option value="Expiry" <?php if($package_days=='Expiry'){echo "selected";}?>>Expiry</option>
                                                                
                                                            </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                              
                                        
                                        <div class="repeater-default">
                                            <div data-repeater-list="car">
                                                <div data-repeater-item>
                                                    <div class="form row">
														<?php $data_val=unserialize($services);
														//   echo "<pre>";print_r($data_val);
														foreach($data_val as $datarow){
														//echo $datarow['services']." ".$datarow['package_qty'];
														//echo "</br>";

														// }
														$data_services=$datarow['services'];
														?>
                                                        <div class="form-group mb-1 col-sm-12 col-md-4">
                                                            <label for="email-addr">Service</label>
                                                            <br>
                                                            <select class="form-control border-input editor" name="services[]" required="true">
                                           					 <option value="">Select...</option>   
                                           					  <?php 
                                                            $sql1 = "SELECT *  FROM `tbl_services` WHERE `store` = '$store_id'";
                                                            $stmt = $DB->prepare($sql1);
                                                            $stmt->execute();
                                                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                                            while ($row1 = $stmt->fetch()) {
                                                            
                                                            $name=$row1['service_name'];?>
                                                            <option value="<?php echo $name;?>" <?php if($data_services==$name){echo "selected";}?>><?php echo $name;?></option>
                                                            <?php
                                                            }
                                                            ?>
															                           
                                       						 </select>
                                                        </div>
                                                        <div class="form-group mb-1 col-sm-12 col-md-4">
                                                            <label for="pass">Quantity</label>
                                                            <br>
                                                            <input type="text" class="form-control" name="package_qty[]" id="pass" placeholder="Quantity" value="<?php echo $datarow['package_qty'];?>">
                                                        </div>
                                                        <div class="form-group col-sm-12 col-md-2 text-center mt-2">
                                                            <button type="button" class="btn btn-danger" data-repeater-delete> <i class="ft-x"></i>
                                                                Delete</button>
                                                        </div>
                                                        <?php } ?>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            
                                            <div class="form-group overflow-hidden">
                                                <div class="col-12">
                                                    <button data-repeater-create class="btn btn-primary">
                                                        <i class="ft-plus"></i> Add more service
                                                    </button>
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
    <script src="../../../app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="../../../app-assets/vendors/js/ui/jquery.sticky.js"></script>
    <script src="../../../app-assets/vendors/js/forms/repeater/jquery.repeater.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/forms/form-repeater.js"></script>
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>