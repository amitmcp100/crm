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
                    <h3 class="content-header-title"></h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="retailers.php">Home</a>
                                </li>
                                <li class="breadcrumb-item active">use available points
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- <div class="content-header-right col-md-6 col-12">
                    <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                        <a href="add-customer.php" class="btn btn-info  box-shadow-2 px-2" ><i class="ft-plus icon-left"></i> Add Customer</a>
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
                <section id="configuration">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title"></h4>
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
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                       <form class="form form-horizontal" action="available_points_code.php" method="post" name="available_points" >
                                        
                                         <div class="form-body">
                                        <h4 class="form-section"><i class="la la-upload"></i> Available Points Setting</h4>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered zero-configuration">
                                                <thead>
                                                    <tr>
                                                        <th>Total Available Points</th>
                                                        <th>Points  want to Used</th>
                                                        <th>Points value</th>
                                                        <th>Action</th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $canid=$_GET['id'];
                                                    $usid=$_SESSION["user_id"];
                                                    $sql01 = "SELECT *  FROM `tbl_loyality` WHERE `c_id` = '$canid' and `store_id` = '$store_id'";
                                                    $stmt = $DB->prepare($sql01);
                                                    $stmt->execute();
                                                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                                    while ($row01 = $stmt->fetch()){
                                                    $available_points=$row01['available_points'];
                                                    
                                                     //echo "fdf".$id;
                                                    ?>
                                                     
                                                     <tr>
                                                        <td>
                                                            <input type="hidden" name="userid" value="<?php echo $userid;?>">
                                                            <input type="hidden" name="canid" value="<?php echo  $canid;?>">
                                                            <input type="hidden" name="available_points" value="<?php echo $available_points;?>">
                                                        </td>
                                                     </tr>
                                                    <tr>

                                                        <td><?php echo $available_points;?></td>
                                                        <td>
                                                        <input class="form-control border-input editor" type="text" id="usedpoints"  name="usedpoints">
                                                        </td>
                                                        <td>
                                                        <input class="form-control border-input editor" type="text" id="pointsvalue" name="usedpointsvalue">
                                                        </td>
                                                        <td><button type="submit"  id="submitpoints" class="btn btn-primary" name="submit" value="Submit">
                                                        <i class="la la-check-square-o"></i> Submit</button>
                                                       
                                                        </td>
                                                        
                                                    </tr>
                                                    <?php } ?>

                                                </tbody>
                                                <tfoot>
                                                     <tr>
                                                         <th>Total Available Points</th>
                                                         <th>Points want to Used</th>
                                                         <th>Points value</th>
                                                         <th>Action</th>
                                                        
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </form>

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

<script type="text/javascript">

			$(document).ready(function(){

				$("input").change(function(){
                    var noofpoints = $("#usedpoints").val();
                    //alert(noofpoints);
					$.ajax({
						url: "ajaxPage.php",
						type: "POST",
						data: {"points":noofpoints},
                        dataType:"JSON",
						success:function(totalvalue){

                            $('#pointsvalue').val(totalvalue);
                            //alert('hello successfully fetch the data');
						}
					})
				});
			});
            
</script>