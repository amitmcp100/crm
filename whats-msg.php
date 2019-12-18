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
<style>
.hide {
  display: none;
}
</style>

    <!-- BEGIN: Main Menu-->

<?php include('sidebar.php');?> 
    <!-- END: Main Menu-->
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row mb-1">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">Whatsapp Msg</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="retailers.php">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Whatsapp Msg
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
                                             
                                        </div><p>Note** - Bulk Whatsapp Message will take some time it depend on total customer</p>
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
                                        <form class="form form-horizontal" action="whatsapp_code.php" method="post" name="uploadCSV" enctype="multipart/form-data">
                                    <div class="form-body">
                                    <h4 class="form-section"><i class="la la-upload"></i> Send Whatsapp Msg Individual</h4>
                                    </div>
									<?php
                                    //include("configinc2.php");
									// Check connection
									
									$usid=$_SESSION["user_id"];
									// Attempt select query execution
                                   
                                    $sql01 = "SELECT *  FROM `system_users` WHERE `u_userid` = '$usid'";
                                    $stmt = $DB->prepare($sql01);
                                    $stmt->execute();
                                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                    while ($row01 = $stmt->fetch()) { 
                                    $userid=$row01['reguser_id'];
                                    }
                                    

									$sql = "SELECT *  FROM `tbl_user_group` WHERE `child_id` = '$userid'";
									//echo $sql;
                                    $stmt = $DB->prepare($sql);
                                    $stmt->execute();
                                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                    while ($row = $stmt->fetch()) { 
									$store_id=$row['store_id'];
									}
									
                                    
									?>
									<div class="col-md-6">
									    <div class="form-group row">
									        <label class="col-md-3 label-control" for="userinput1">Bulk/Manual</label>
									        <div class="col-md-9 mx-auto">
									       <input type="hidden" name="id" value="<?php echo $id; ?>">
									           <input type="hidden" name="store" value="<?php echo $store_id; ?>">
									           <input type="hidden" name="user" value="<?php echo $userid; ?>">
									           
									           <input type="radio" name="tab1" value="manual" onclick="show4();" />
                                                Manual
                                                <input type="radio" name="tab1" value="all" onclick="show5();" />
                                                Bulk ALL
									           
									           
									        <div id="labelError"></div>
									        </div>
									    </div>
									</div>

									<div class="col-md-6 hide" id="div0">
									    <div class="form-group row">
									        <label class="col-md-3 label-control" for="userinput1">Numbers</label>
									        <div class="col-md-9 mx-auto">
									       
									           
									            <input type="text" class="form-control border-primary" placeholder="9199XXXXXX58,9170XXXX30" name="c_mobile" value="" >
                                                <label><small>Please include country code before number, do not put starting 0 or +.</small></label>
									           
									           
									        <div id="labelError"></div>
									        </div>
									    </div>
									</div>
									<div class="col-md-6">
									<div class="form-group row">
									    <label class="col-md-3 label-control" for="userinput4">Select Type </label>
									    <div class="col-md-9 mx-auto" >
									   <input type="radio" name="tab" value="text" onclick="show1();" />
                                        Text
                                        <input type="radio" name="tab" value="image" onclick="show2();" />
                                        Image
                                        <input type="radio" name="tab" value="pdf" onclick="show3();" />
                                        PDF
							    </div>
									</div>
									</div>
									<div class="col-md-6 hide" id="div1">
									<div class="form-group row">
									    <label class="col-md-3 label-control" for="userinput4">Message </label>
									    <div class="col-md-9 mx-auto">
									    <textarea name="sms_text" class="form-control textarea-maxlength" id="maxlength-textarea" placeholder="Enter Message.." rows="5" ></textarea>
									    </div>
									</div>
									</div>
									<div class="col-md-6 hide" id="div3">
									  <div class="form-group row">
                                                <label class="col-md-3 label-control" for="userinput1">Upload Pdf</label>
                                                <div class="col-md-9 mx-auto">
                                                  <input type="file" name="file" />
                                                  
                                                   <div style="margin-top:10px;"></div>
                                                </div>
                                           
									</div>
									</div>

									<div class="col-md-6 hide" id="div2">
									<div class="form-group row">
									   <div class="form-group row">
                                                <label class="col-md-3 label-control" for="userinput1">Upload Image</label>
                                                <div class="col-md-9 mx-auto">
                                                   <input type="file" name="image">
                                                  
                                                   <div style="margin-top:10px;"></div>
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
function show1(){
	document.getElementById('div1').style.display = 'block';
	document.getElementById('div2').style.display = 'none';
  document.getElementById('div3').style.display ='none';
}
function show2(){
  document.getElementById('div1').style.display = 'none';
   document.getElementById('div2').style.display ='block';
    document.getElementById('div3').style.display ='none';
}
function show3(){
  document.getElementById('div3').style.display = 'block';
   document.getElementById('div1').style.display ='none';
    document.getElementById('div2').style.display ='none';
}

function show4(){
  document.getElementById('div0').style.display = 'block';
  
}

function show5(){
  document.getElementById('div0').style.display = 'none';
  
}

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

