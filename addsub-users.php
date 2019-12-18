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
                    <h3 class="content-header-title">Add Sub-User</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="retailers.php">Home</a>
                                </li>
                                
                                <li class="breadcrumb-item active"><a href="#">Add Sub-User</a>
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

                </div><?php } ?>   
                
                </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <?php
                /* Attempt MySQL server connection. Assuming you are running MySQL
                server with default setting (user 'root' with no password) */
                //include("configinc2.php");

                // Check connection
                if($link === false){
                die("ERROR: Could not connect. " . mysqli_connect_error());
                }
                $usid=$_SESSION["user_id"];
                $sql011 = "SELECT *  FROM `system_users` WHERE `u_userid` = '$usid'";
                $stmt = $DB->prepare($sql011);
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                while ($row011 = $stmt->fetch()) {                
                $userid=$row011['reguser_id'];
                }
                
                // Attempt select query execution
                $sql = "SELECT *  FROM `tbl_user_data` WHERE `userid` = '$userid' AND  `store_id` = '$store_id'";
                 $stmt = $DB->prepare($sql);
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                while ($row = $stmt->fetch()) {   
                $last_name=$row['last_name'];
                $business_name=$row['business_name'];
                
                $website=$row['website'];
                
                 }
                
               // mysqli_free_result($result);
                //include("configinc2.php");
                // Close connection
              //  mysqli_close($link);
                ?>
                <section id="horizontal-form-layouts">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="horz-layout-colored-controls">Add Sub-User</h4>
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
                                    
                                        <form class="form form-horizontal" action="addsubuser_code.php" method="post">
                                        <input type="hidden" name="userid" value="<?php echo $userid;?>">
                                         <input type="hidden" name="store_id" value="<?php echo $store_id;?>">
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="la la-eye"></i> About Sub-User</h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput1">First Name</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input type="text" id="userinput1" class="form-control border-primary" placeholder="First Name" name="firstname"  required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput2">Last Name</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input type="text" id="userinput2" class="form-control border-primary" placeholder="Last Name" name="lastname"  >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput3">Username</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input type="text" id="userinput2" class="form-control border-primary" placeholder="Username" name="username"  required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput4">New Password </label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input type="password" id="userinput4" class="form-control border-primary" placeholder="New Password" name="pwd1">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput4">Business Name</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input type="hidden" id="userinput4" class="form-control border-primary" placeholder="Business Name" name="buss_name"  value="<?php if(!empty($business_name)){echo $business_name; }?>">
                                                                <?php echo $business_name;?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput4">Address</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input type="text" id="userinput4" class="form-control border-primary" placeholder="Address" name="address">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput4">City </label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input type="text" id="userinput4" class="form-control border-primary" placeholder="City" name="city" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput4">State </label>
                                                            <div class="col-md-9 mx-auto">
                           <select class="form-control  border-primary" required="true" id="state" name="state"><option value="">Select State</option>
                            <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                            <option value="Andhra Pradesh"  >Andhra Pradesh</option>
                            <option value="Arunachal Pradesh"  >Arunachal Pradesh</option>
                            <option value="Assam" >Assam</option>
                            <option value="Bihar" >Bihar</option>
                            <option value="Chandigarh" >Chandigarh</option>
                            <option value="Dadra and Nagar Haveli" >Dadra and Nagar Haveli</option>
                            <option value="Daman and Diu">Daman and Diu</option>
                            <option value="Delhi">Delhi</option>
                            <option value="Goa" >Goa</option>
                            <option value="Gujarat" >Gujarat</option>
                            <option value="Haryana" >Haryana</option>
                            <option value="Himachal Pradesh" >Himachal Pradesh</option>
                            <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                            <option value="Karnataka">Karnataka</option>
                            <option value="Kerala" >Kerala</option>
                            <option value="Lakshadweep Islands" >Lakshadweep Islands</option>
                            <option value="Madhya Pradesh" >Madhya Pradesh</option>
                            <option value="Maharashtra" >Maharashtra</option>
                            <option value="Manipur" >Manipur</option>
                            <option value="Meghalaya" >Meghalaya</option>
                            <option value="Mizoram" >Mizoram</option>
                            <option value="Nagaland">Nagaland</option>
                            <option value="Orissa" >Orissa</option>
                            <option value="Puducherry" >Puducherry</option>
                            <option value="Punjab" >Punjab</option>
                            <option value="Rajasthan">Rajasthan</option>
                            <option value="Sikkim" >Sikkim</option>
                            <option value="Tamil Nadu" >Tamil Nadu</option>
                            <option value="Tripura" >Tripura</option>
                            <option value="Uttar Pradesh" >Uttar Pradesh</option>
                            <option value="West Bengal" >West Bengal</option>
                            <option value="Telangana" >Telangana</option>
                            </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput4">User Group </label>
                                                            <div class="col-md-9 mx-auto">
                                                               
                                                                <select class="form-control  border-primary" required="true" name="user_group">
                                                                <option value="">Select Category</option>
                                                                                                            
                                                                <option value="Restaurant" >Restaurant</option>
                                                                                                            
                                                                <option value="Apparel/Retail" >Apparel/Retail</option>
                                                                                                            
                                                                <option value="Jewellery" >Jewellery</option>
                                                                                                            
                                                                <option value="Salon/Spa" >Salon/Spa</option>
                                                                                                            
                                                                <option value="Gym/Yoga" >Gym/Yoga</option>
                                                                                                            
                                                                <option value="Other shops">Other shops</option>
                                                                                                            
                                                                <option value="Demo" >Demo</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <h4 class="form-section"><i class="ft-mail"></i> Contact Info &amp; Bio</h4>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput5">Email</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input class="form-control border-primary" type="email" placeholder="email" id="userinput5" name="email" required>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput6">Website</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input class="form-control border-primary" type="url" placeholder="http://" id="userinput6" name="website" >
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control">Contact Number</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input class="form-control border-primary" type="tel" placeholder="Contact Number" id="userinput7" name="contact" maxlength="10" minlength="10" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput8">Bio</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <textarea id="userinput8" rows="6" class="form-control border-primary" name="bio" placeholder="Bio"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput4">User Roles </label>
                                                            <div class="col-md-9 mx-auto">
                                                               
                                                                <select class="form-control  border-primary" required="true" name="roles">
                                            <option value="">Select Roles</option>
                                                                                        
                                             <?php 
                                                            $sql12 = "SELECT *  FROM `tbl_user_roles` WHERE `store_id` = '$store_id'";
                                                            $stmt = $DB->prepare($sql12);
                                                            $stmt->execute();
                                                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                                            while ($row12 = $stmt->fetch()) { 
                                                            
                                                            $rolename=$row12['role_name'];
                                                            $roleid=$row12['id'];
                                                            ?>
                                                            <option value="<?php echo $roleid;?>"><?php echo $rolename;?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                                                        
                                            
                                            </select>
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
<script type="text/javascript">
  function checkForm(form)
  {
    

    if(form.pwd1.value != "" && form.pwd1.value == form.pwd2.value) {
      if(form.pwd1.value.length < 6) {
        alert("Error: Password must contain at least six characters!");
        form.pwd1.focus();
        return false;
      }
      if(form.pwd1.value == form.username.value) {
        alert("Error: Password must be different from Username!");
        form.pwd1.focus();
        return false;
      }
      re = /[0-9]/;
      if(!re.test(form.pwd1.value)) {
        alert("Error: password must contain at least one number (0-9)!");
        form.pwd1.focus();
        return false;
      }
      re = /[a-z]/;
      if(!re.test(form.pwd1.value)) {
        alert("Error: password must contain at least one lowercase letter (a-z)!");
        form.pwd1.focus();
        return false;
      }
      re = /[A-Z]/;
      if(!re.test(form.pwd1.value)) {
        alert("Error: password must contain at least one uppercase letter (A-Z)!");
        form.pwd1.focus();
        return false;
      }
    } else {
      alert("Error: Please check that you've entered and confirmed your password!");
      form.pwd1.focus();
      return false;
    }

    alert("You entered a valid password: " + form.pwd1.value);
    return true;
  }

</script>
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