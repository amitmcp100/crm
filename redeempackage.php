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
                                <li class="breadcrumb-item active"><a href="#">Redeem Package</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                    <h3 class="content-header-title mb-0">Redeem Package</h3>
                </div>
                <!-- <div class="content-header-right col-md-6 col-12">
                    <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                        <button class="btn btn-info round dropdown-toggle dropdown-menu-right box-shadow-2 px-2" id="btnGroupDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ft-settings icon-left"></i> Settings</button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1"><a class="dropdown-item" href="card-bootstrap.html">Cards</a><a class="dropdown-item" href="component-buttons-extended.html">Buttons</a></div>
                    </div>
                </div> -->
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
            <?php
                /* Attempt MySQL server connection. Assuming you are running MySQL
                server with default setting (user 'root' with no password) */

                  //include("configinc2.php");

                // Check connection
                
                $usid=$_SESSION["user_id"];
                $sql011 = "SELECT *  FROM `system_users` WHERE `u_userid` = '$usid'";
                $stmt = $DB->prepare($sql011);
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                while ($row011 = $stmt->fetch()) { 
                $userid=$row011['reguser_id'];
                }
                
                // Attempt select query execution

                $sql = "SELECT *  FROM `tbl_user_group` WHERE `child_id` = '$userid'";
                $stmt = $DB->prepare($sql);
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                while ($row = $stmt->fetch()) { 
                $store_id=$row['store_id'];
                
                 }
                
                //mysqli_free_result($result);
                
                
                // Close connection
				
                



               
                // Close connection
               
                ?>
                
                <!-- Form repeater section start -->
                <section id="form-repeater">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="repeat-form">Redeem Package</h4>
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
                                 
                                  <input type="hidden" name="userid" value="<?php echo $userid;?>">
                                 <input type="hidden" name="store_id" value="<?php echo $store_id;?>">
                                <div class="card-content collapse show">
                                    <div class="card-body">
									<?php
									$mobile=$_GET['mobile'];
									$sql01 = "SELECT *  FROM `tbl_sellpackage` WHERE `store_id` = '$store_id' and `mobile` = '$mobile'";
									//echo $sql01;
                                    $stmt = $DB->prepare($sql01);
                                    $stmt->execute();
                                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                    while ($row01 = $stmt->fetch()) { 
									
									$sell_id=$row01['id'];
									$c_name=$row01['name'];
									$email=$row01['email'];
									$mobile=$row01['mobile'];
									$create_date=$row01['create_date'];
									$package_id=$row01['package_id'];
									
									?>
									<div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="userinput1" >Name</label>
                                                <div class="col-md-9 mx-auto">
                                                   <?php echo $c_name;?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="userinput2">Email</label>
                                                <div class="col-md-9 mx-auto">
                                                   <?php echo $email;?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="userinput1" >Mobile</label>
                                                <div class="col-md-9 mx-auto">
                                                   <?php echo $mobile;?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="userinput2">Purchase Date</label>
                                                <div class="col-md-9 mx-auto">
                                                   <?php echo $create_date;?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
									<?php
									$sql02 = "SELECT *  FROM `tbl_package` WHERE `store` = '$store_id' and `id` = '$package_id'";
                                    $stmt = $DB->prepare($sql02);
                                    $stmt->execute();
                                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                    $result = array();
                                    while ($row02 = $stmt->fetch()) { 
									$package_name=$row02['package_name'];
									$package_price=$row02['package_price'];
									$package_expiry=$row02['package_expiry'];
									$package_days=$row02['package_days'];
									$services=$row02['services'];?>
									<div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="userinput1" >Package Name</label>
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
                                                    <?php echo $package_expiry." ".$package_days;?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <!-- <label class="col-md-3 label-control" for="userinput2">Days</label>
                                                <div class="col-md-9 mx-auto">
                                                   <?php //echo $package_days;?>
                                                </div> -->
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
														
                                                        <div class="form-group mb-1 col-sm-12 col-md-3">
                                                            <label for="email-addr"><strong>Service</strong></label>
                                                            <br>
                                                            <?php echo $datarow['services']; ?>
                                                        </div>
                                                        <div class="form-group mb-1 col-sm-12 col-md-3">
                                                            <label for="pass"><strong>Quantity</strong></label>
                                                            <br>
                                                           <?php echo $datarow['package_qty'];?>
                                                        </div>
                                                        <div class="form-group mb-1 col-sm-12 col-md-3">
                                                            <label for="pass"><strong>Redeem Qty</strong></label>
                                                            <br>
                                                            <?php 
                                                            $serv=$datarow['services'];
															$sql03 = "SELECT SUM(redeem_qty) AS qty  FROM `tbl_redeem_package` WHERE `store_id` = '$store_id' and `mobile` = '$mobile' and `package` = '$serv'";
															//echo $sql03;
                                                            $stmt = $DB->prepare($sql03);
                                                            $stmt->execute();
                                                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                                            $result = array();
                                                            while ($row03 = $stmt->fetch()) { 
															$qty=$row03['qty'];
															}
															if($qty>0){
																$r_qty=$qty;
															}
															else{
																$r_qty="0";
															}
															
                                                            ?>
                                                            <?php echo $r_qty;?>
                                                          
                                                        </div>
                                                        <?php 
                                                        $packqty=$datarow['package_qty'];
                                                        $ab_qty=$packqty-$r_qty;
                                                        if($ab_qty >0){?>
                                                        <div class="form-group mb-1 col-sm-12 col-md-3">
                                                            <label for="pass"><strong>Redeem</strong></label>
                                                            <br>
														<a href="redeem_now.php?service=<?php echo $datarow['services']; ?>&mobile=<?php echo $mobile; ?>&sellid=<?php echo $sell_id;?>&store=<?php echo $store_id; ?>&pack=<?php echo $package_id; ?>&userid=<?php echo $userid; ?>" onclick="return confirm('Are you sure you want to REDEEM this package?');" class="btn btn-primary" >
														 Redeem 
														</a>
                                                        </div>
                                                        <?php }?>
                                                        
                                                       
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            
                                            <?php } ?>
                                        
									<?php }

									?>
                                    <?php }
									?>
                                     </div>
                                    </div>
                                    
                                </div>

                                
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