<?php
require_once ("config.php");
if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
// not logged in send to login page
redirect("index.php");
} //!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == ""
// set page title
$title    = "Dashboard";
$store_id = $_SESSION['store_id'];

include 'header.php';
?>
<!-- END: Header-->
<link rel="stylesheet" type="text/css" href="app-assets/css/plugins/forms/wizard.css">
<link rel="stylesheet" type="text/css" href="app-assets/vendors/css/forms/icheck/icheck.css">
<link rel="stylesheet" type="text/css" href="app-assets/css/plugins/forms/checkboxes-radios.css">
<!-- BEGIN: Main Menu-->
 <link rel="stylesheet" href="chosen/prism.css">
 <link rel="stylesheet" href="chosen/chosen.css">
<?php
include ('sidebar.php');
?> 
<!-- END: Main Menu-->
<!-- BEGIN: Content-->
<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row mb-1">
      <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title">Add Appoinment
        </h3>
        <div class="row breadcrumbs-top">
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="retailers.php">Home
                </a>
              </li>
              <li class="breadcrumb-item active">Add Appoinment
              </li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <!-- Form wizard with number tabs section start -->
      <section id="number-tabs">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Add Appoinment
                </h4>
                <a class="heading-elements-toggle">
                  <i class="la la-ellipsis-h font-medium-3">
                  </i>
                </a>
                <div class="heading-elements">
                  <ul class="list-inline mb-0">
                    <li>
                      <a data-action="collapse">
                        <i class="ft-minus">
                        </i>
                      </a>
                    </li>
                    <li>
                      <a data-action="reload">
                        <i class="ft-rotate-cw">
                        </i>
                      </a>
                    </li>
                    <li>
                      <a data-action="expand">
                        <i class="ft-maximize">
                        </i>
                      </a>
                    </li>
                    <li>
                      <a data-action="close">
                        <i class="ft-x">
                        </i>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="card-content collapse show">
                <div class="card-body">
                  <form action="appoinment-code.php" id="formId" method="post" class="steps-validation wizard-circle">
                    <!-- Step 1 -->
                    <h6>Step 1
                    </h6>
                    <fieldset>
                      <div class="row form-group" style="padding:10px 0px 100px 0px;">
                        <div class="col-md-12">
                          <h4 class="card-title">Select Services
                          </h4>
                        </div>
                        <input type="hidden"  id="store_id"  value="<?php echo $store_id; ?>">
                        <select data-placeholder="Select Services" name="services[]" multiple class="chosen-select" tabindex="8" required>
                        <?php
                        //include("configinc2.php");
                        $sql1 = "SELECT *  FROM `tbl_services`  where `store_id` = '$store_id' ";
                        //echo $sql1;
                        $stmt = $DB->prepare($sql1);
                        $stmt->execute();
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        if ($stmt == true) {
                        while ($row1 = $stmt->fetch()) {
                        $id = $row1['id'];
                        $service = $row1['service_name'];
                        $serviceqty = preg_replace('/\s*/', '', $service);
                        $serviceqty = strtolower($serviceqty);
                        ?>
                        <option value="<?php echo $service; ?>"><?php echo $service; ?></option>                        
                        <?php
                        } //$row1 = $stmt->fetch()
                        } //$stmt == true
                        ?>
                        </select>
					            	<!--End Choosend Code-->
                      </div>
                    </fieldset>
                    <!-- Step 2 -->
                    <h6>Step 2
                    </h6>
                    <fieldset>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="eventLocation1">Select Employee :
                            </label>
                            <select class="custom-select form-control" id="employeedata" name="employee">
                            <option value="">Select Employee
                            </option>
                            <?php
                            //include("configinc2.php");
                            $sql2 = "SELECT *  FROM `tbl_employee`  where `store_id` = '$store_id'";
                            //echo $sql1;
                            $stmt = $DB->prepare($sql2);
                            $stmt->execute();
                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                            while ($row2 = $stmt->fetch()) {
                            $id = $row2['id'];
                            ?>
                            <option value="<?php echo $id; ?>"><?php echo $row2['name']; ?> </option>
                            <?php
                            } 
                            ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="emailAddress2">Select Date :
                            </label>
                            <input type="date" class="form-control" id="emailAddress2" onchange="mainInfo(this.value); ">
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="timeslot">
                          </div>
                        </div>
                        </fieldset>
                      <!-- Step 3 -->
                      <h6>Step 3
                      </h6>
                      <fieldset>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="eventName1">Customer Name :
                              </label>
                              <input type="text" name="cname" class="form-control" id="eventName1">
                            </div>
                          </div>
                          <div class="col-md-6">            
                            <div class="form-group">
                              <label for="eventName1">Customer Mobile *:
                              </label>
                              <input type="text" name="cmobile" class="form-control required" id="eventName1">
                            </div>
                          </div>
                          <div class="col-md-6">            
                            <div class="form-group">
                              <label for="eventName1">Customer Email :
                              </label>
                              <input type="text" name="cemail" class="form-control" id="eventName1">
                            </div>
                          </div>
                          <div class="col-md-6">            
                            <div class="form-group">
                              <label for="eventName1">Customer Address :
                              </label>
                              <input type="text" name="caddress" class="form-control" id="eventName1">
                            </div>
                          </div>
                        </div>
                      </fieldset>
                      <!-- Step 4 -->
                      </form>
                    </div>
                </div>
              </div>
            </div>
          </div>
          </section>
        <!-- Form wizard with number tabs section end -->
        <!-- Form wizard with icon tabs section end -->
        <!-- Form wizard with vertical tabs section end -->
        </div>
    </div>
  </div>
  <!-- END: Content-->
  <div class="sidenav-overlay">
  </div>
  <div class="drag-target">
  </div>
  <script>
    function mainInfo(id) {
      var emp= $( "#employeedata" ).val();
      var store_id= $( "#store_id" ).val();
      ///console.log(store_id);
      $.ajax({
        type: "POST",
        url: "fetchappoinment.php",
        data: "date="+id+"&emp="+emp+"&store_id="+store_id,
        //dataType:"JSON",
        success: function(data) {
          $( ".timeslot" ).html(data);
        }
      }
            );
    };
  </script>
  <!-- BEGIN: Footer-->
  <footer class="footer footer-static footer-light navbar-border navbar-shadow">
    <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
      <span class="float-md-left d-block d-md-inline-block">Copyright &copy; 2019 
        <a class="text-bold-800 grey darken-2" href="" target="_blank">Loire Technologies
        </a>
      </span>
    </p>
  </footer>
  <!-- END: Footer-->
  <script src="app-assets/vendors/js/vendors.min.js">
  </script>
  <!-- BEGIN Vendor JS-->
  <script src="app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js">
  </script>
  <script src="app-assets/vendors/js/forms/icheck/icheck.min.js">
  </script>
  <!-- BEGIN: Page Vendor JS-->
  <script src="app-assets/vendors/js/extensions/jquery.steps.min.js">
  </script>
  <script src="app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js">
  </script>
  <script src="app-assets/vendors/js/pickers/daterange/daterangepicker.js">
  </script>
  <script src="app-assets/vendors/js/forms/validation/jquery.validate.min.js">
  </script>
  <!-- END: Page Vendor JS-->
  <!-- BEGIN: Theme JS-->
  <script src="app-assets/js/core/app-menu.js">
  </script>
  <script src="app-assets/js/core/app.js">
  </script>
  <!-- END: Theme JS-->
  <script src="app-assets/js/scripts/pages/ecommerce-cart.js">
  </script>
  <!-- BEGIN: Page JS-->
  <script src="app-assets/js/scripts/forms/wizard-steps.js">
  </script>
  <script src="app-assets/js/scripts/forms/checkbox-radio.js">
  </script>
  <!-- END: Page JS-->
   <script src="chosen/jquery-3.2.1.min.js" type="text/javascript"></script>
  <script src="chosen/chosen.jquery.js" type="text/javascript"></script>
  <script src="chosen/prism.js" type="text/javascript" charset="utf-8"></script>
  <script src="chosen/init.js" type="text/javascript" charset="utf-8"></script>

  </body>
<!-- END: Body-->
</html>
