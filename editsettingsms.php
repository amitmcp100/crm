<?php
require_once("config.php");
if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
    // not logged in send to login page
    redirect("index.php");
}

// set page title
$title = "Dashboard";
$store_id = $_SESSION['store_id'];
// if the rights are not set then add them in the current session

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
                    <h3 class="content-header-title">SMS Template</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="retailers.php">Home</a>
                                </li>
                                <li class="breadcrumb-item active">SMS Template
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- <div class="content-header-right col-md-6 col-12">
                    <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                        <a href="Customer.csv" class="btn btn-info  box-shadow-2 px-2" ><i class="ft-plus icon-left"></i> Demo CSV File</a>
                       
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
                <!-- Zero configuration table -->
               <section id="file-export">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                
                                <div class="card-content collapse show">
                                    <div class="card-body ">
                                        <form class="form form-horizontal" action="editsms_code.php" method="post" name="uploadCSV" >
                                    <div class="form-body">
                                    <h4 class="form-section"><i class="la la-upload"></i> Send SMS</h4>
                                    </div>
									<?php 
                                   //include("configinc2.php");
									// Check connection
									
									$userid=$_SESSION["user_id"];
									// Attempt select query execution
							
									

									$id=$_GET['id'];
									$sql1 = "SELECT *  FROM `smstemplates` WHERE `id` = '$id' and `store_id` = '$store_id'";
									//echo $sql;
                                    $stmt = $DB->prepare($sql1);
                                    $stmt->execute();
                                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                    while ($row1 = $stmt->fetch()) {
									
									$message_type=$row1['message_type'];
									$message=$row1['message'];
									//$c_mobile=$row1['mobile'];
									}
									

									$sql2 = "SELECT *  FROM `smstemplates` WHERE `message_type` = '$message_type' and `store_id` = '$store_id'";
									//echo $sql;
                                    $stmt = $DB->prepare($sql2);
                                    $stmt->execute();
                                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                    while ($row2 = $stmt->fetch()) {									
									$message_f=$row2['message'];
									//$c_mobile=$row1['mobile'];
									}
									
									

									?>
									<div class="col-md-6">
									    <div class="form-group row">
									        <label class="col-md-3 label-control" for="userinput1">Message Type</label>
									        <div class="col-md-9 mx-auto">
									        <?php echo $message_type;?>
									           <input type="hidden" name="id" value="<?php echo $id; ?>">
									           <input type="hidden" name="store" value="<?php echo $store_id; ?>">
									           <input type="hidden" name="user" value="<?php echo $userid; ?>">
									          
									           
									           
									        <div id="labelError"></div>
									        </div>
									    </div>
									</div>
									<div class="col-md-6">
									<div class="form-group row">
									    <label class="col-md-3 label-control" for="userinput4">Set Message </label>
									    <div class="col-md-9 mx-auto">
									    <textarea name="sms_text" class="form-control textarea-maxlength" id="maxlength-textarea" placeholder="Enter upto 160 characters.." maxlength="159" rows="5" required=""><?php echo $message_f;?></textarea>
									    <p><?php echo $message;?></p>
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
                    </div>
                </section>
                <!--/ Zero configuration table -->
               
                <!--/ Default ordering table -->
                <!-- Multi-column ordering table -->
                                <!--/ Language - Comma decimal place table -->

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

<script type="text/javascript">
	$(document).ready(
	function() {
		$("#frmCSVImport").on(
		"submit",
		function() {

			$("#response").attr("class", "");
			$("#response").html("");
			var fileType = ".csv";
			var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+("
					+ fileType + ")$");
			if (!regex.test($("#file").val().toLowerCase())) {
				$("#response").addClass("error");
				$("#response").addClass("display-block");
				$("#response").html(
						"Invalid File. Upload : <b>" + fileType
								+ "</b> Files.");
				return false;
			}
			return true;
		});
	});
</script>

    <!-- BEGIN: Vendor JS-->
    <script src="app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js"></script>
    <script src="app-assets/vendors/js/tables/buttons.flash.min.js"></script>
    <script src="app-assets/vendors/js/tables/jszip.min.js"></script>
    <script src="app-assets/vendors/js/tables/pdfmake.min.js"></script>
    <script src="app-assets/vendors/js/tables/vfs_fonts.js"></script>
    <script src="app-assets/vendors/js/tables/buttons.html5.min.js"></script>
    <script src="app-assets/vendors/js/tables/buttons.print.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="app-assets/js/core/app-menu.js"></script>
    <script src="app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="app-assets/js/scripts/tables/datatables/datatable-advanced.js"></script>
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>

