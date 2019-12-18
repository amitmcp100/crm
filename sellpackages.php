<?php
require_once("config.php");
if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
    // not logged in send to login page
    redirect("index.php");
}

// set page title
$title    = "Dashboard";

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
                                <li class="breadcrumb-item active"><a href="#">Sell Package</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                    <h3 class="content-header-title mb-0">Sell Package</h3>
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
                
           ?>
                
                <!-- Form repeater section start -->
                <section id="form-repeater">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="repeat-form">Sell Package</h4>
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
                                      <form class="form form-horizontal" action="sellpackage_code.php" method="post">
                                      <input type="hidden" name="userid" value="<?php echo $userid;?>">
                                    <div class="card-content collapse show">
                                    <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="userinput1" >Select package</label>
                                                <div class="col-md-9 mx-auto">
                                                    <select class="form-control"  name="package_select" onchange="mainInfo(this.value); ">
                                                            <option >Select...</option>
                                                            <?php 
                                                            $sql1 = "SELECT *  FROM `tbl_package` WHERE `store_id` = '$store_id'";
                                                            $stmt = $DB->prepare($sql1);
                                                            $stmt->execute();
                                                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                                            while ($row1 = $stmt->fetch()) { 
                                                            
                                                            $name=$row1['package_name'];
                                                            $pid=$row1['id'];
                                                            ?>
                                                            <option value="<?php echo $pid;?>"><?php echo $name;?></option>
                                                            <?php
                                                            }
                                                            ?>
															</select>
                                                                                                                             
                                                    </div>
                                                </div>
                                            </div>
                                    <div class="col-md-6">
                                    <div class="form-group row">
                                       
                                    </div>
                                    </div>
                                    </div>
                                     
									<div id="display">
									<div class="row" id="heading" style="display:none;"><div class="col-sm-3"><strong>Package Price</strong></div><div class="col-sm-3"><strong>Package Expiry</strong></div><div class="col-sm-3"><strong>Service</strong></div><div class="col-sm-3"><strong>Quantity</strong></div></div><br>	
											
									<div class="row" id="records"><div class="col-sm-3" id="pack_price"></div><div class="col-sm-3" id="pack_exp"></div><div class="col-sm-3" id="pack_service"></div><div class="col-sm-3" id="pack_qty"></div></div>			
									<div class="row" id="no_records"><div class="col-sm-4">Plese select Package..</div></div>
									</div>
                                    </div>
                                              
                                        </br></br>
                                        <div class="">
                                            <div data-repeater-list="car">
                                                <div data-repeater-item>
                                                    <div class="form row">

                                                        <div class="form-group mb-1 col-sm-12 col-md-3">
                                                            <label for="email-addr">Name</label>
                                                            <br>
                                                             <input type="text" class="form-control" name="package_name" id="pass" placeholder="Name">
                                                        </div>

                                                        <div class="form-group mb-1 col-sm-12 col-md-3">
                                                            <label for="pass">Email</label>
                                                            <br>
                                                            <input type="email" class="form-control" name="package_email" id="pass" placeholder="Email">
                                                        </div>

                                                        <div class="form-group mb-1 col-sm-12 col-md-3">
                                                            <label for="pass">Mobile</label>
                                                            <br>
                                                            <input type="text" class="form-control" name="package_mobile" id="pass" placeholder="Mobile">
                                                        </div>
                                                      <!--   <div class="form-group col-sm-12 col-md-2 text-center mt-2">
                                                            <button type="button" class="btn btn-danger" data-repeater-delete> <i class="ft-x"></i>
                                                                Delete</button>
                                                        </div> -->
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <!-- <div class="form-group overflow-hidden">
                                                <div class="col-12">
                                                    <button data-repeater-create class="btn btn-primary">
                                                        <i class="ft-plus"></i> Add more customer
                                                    </button>
                                                </div>
                                            </div> -->
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
    <script>
		
		// code to get all records from table via select box
		function mainInfo(id) {
		
		var dataString = 'id='+ id;
		$.ajax({
		type: "POST",
		url: 'getpackage.php',
		dataType: "json",
		data: dataString,
		cache: false,
		success: function(data) {
		if(data) {
		$("#heading").show();
		$("#no_records").hide();
		$("#pack_price").text(data.package_price);
		$("#pack_exp").text(data.package_expiry);
		$("#pack_service").text(data.services);
		$("#pack_qty").text(data.qty);
		$("#records").show();
		} else {
		$("#heading").hide();
		$("#records").hide();
		$("#no_records").show();
		}
		}
		});
		};
    </script>

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