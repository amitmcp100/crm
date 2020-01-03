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
                    <h3 class="content-header-title">Profile Management</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="retailers.php">Home</a>
                                </li>
                                
                                <li class="breadcrumb-item active"><a href="#">Update Profile</a>
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
                
                $userid=$_SESSION["user_id"];
                // Attempt select query execution
                $sql = "SELECT *  FROM `tbl_user_data` WHERE `userid` = '$userid'  AND `store_id` ='$store_id'";
                $stmt = $DB->prepare($sql);
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                
                while ($row = $stmt->fetch()) {  
                //$logo=$row['logo'];
                $username=$row['username'];
                $first_name=$row['first_name'];
                $last_name=$row['last_name'];
                $business_name=$row['business_name'];
                $address=$row['address'];
                $city=$row['city'];
                $state=$row['state'];
                $usergroup=$row['usergroup'];
                $email=$row['email'];
                $website=$row['website'];
                $contact=$row['contact'];
                $bio=$row['bio'];
                 }

               
                // Close connection
                //mysqli_close($link);
                ?>
                <section id="horizontal-form-layouts">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="horz-layout-colored-controls">User Profile</h4>
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
                                    
                                     <form class="form form-horizontal" name="uploadimage"  action="upload_logo.php" enctype="multipart/form-data" method="post">
                                    <div class="form-body">
                                    <h4 class="form-section"><i class="la la-eye"></i> Business Logo</h4>
                                        <div class="row">
                                          
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="userinput1">Business User</label>
                                                <div class="col-md-9 mx-auto">
                                                   <h2><?php echo $username; ?></h2> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                
                                                <div class="col-md-9 mx-auto">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                         
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="userinput1">Business Logo</label>
                                                <div class="col-md-9 mx-auto">
                                                <?php if(!empty($logo)){?>
                                                     <img src="users_img/<?php echo $logo; ?>" width="150">
                                                <?php } else{?>
                                                    <img src="users_img/profile_sample.png" width="150">
                                                <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="userinput1">Upload Logo</label>
                                                <div class="col-md-9 mx-auto">
                                                   <input type="file" name="image">
                                                   <input type="hidden" name="userid" value="<?php echo $_SESSION["user_id"];?>">
                                                   <div style="margin-top:10px;"><button type="submit" class="btn btn-primary" name="submit" value="Submit">
                                                    <i class="la la-check-square-o"></i> Upload
                                                </button></div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                     </div>
                                     </form>
                                        <form class="form form-horizontal" action="profile_user.php" method="post">
                                        <input type="hidden" name="userid" value="<?php echo $_SESSION["user_id"];?>">
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="la la-eye"></i> About User</h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput1">First Name</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input type="text" id="userinput1" class="form-control border-primary" placeholder="First Name" name="firstname" value="<?php if(!empty($first_name)){echo $first_name; }?>" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput2">Last Name</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input type="text" id="userinput2" class="form-control border-primary" placeholder="Last Name" name="lastname" value="<?php if(!empty($last_name)){echo $last_name; }?>" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput3">Username</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <?php echo $username;?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput4">Business Name</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input type="text" id="userinput4" class="form-control border-primary" placeholder="Business Name" name="buss_name"  value="<?php if(!empty($business_name)){echo $business_name; }?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput4">Address</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input type="text" id="userinput4" class="form-control border-primary" placeholder="Address" name="address" value="<?php if(!empty($address)){echo $address; }?>" rquired>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput4">City </label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input type="text" id="userinput4" class="form-control border-primary" placeholder="City" name="city" value="<?php if(!empty($city)){echo $city; }?>"  required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput4">State </label>
                                                            <div class="col-md-9 mx-auto">
                           <select class="form-control  border-primary" required="true" id="state" name="state"><option value="">Select State</option>
                             <option value="Andaman and Nicobar Islands" <?php if($state=='Andaman and Nicobar Islands'){echo "selected";}?> >Andaman and Nicobar Islands</option>
                            <option value="Andhra Pradesh" <?php if($state=='Andhra Pradesh'){echo "selected";}?> >Andhra Pradesh</option>
                            <option value="Arunachal Pradesh" <?php if($state=='Arunachal Pradesh'){echo "selected";}?> >Arunachal Pradesh</option>
                            <option value="Assam" <?php if($state=='Assam'){echo "selected";}?> >Assam</option>
                            <option value="Bihar" <?php if($state=='Bihar'){echo "selected";}?>>Bihar</option>
                            <option value="Chandigarh" <?php if($state=='Chandigarh'){echo "selected";}?>>Chandigarh</option>
                            <option value="Dadra and Nagar Haveli" <?php if($state=='Dadra and Nagar Haveli'){echo "selected";}?>>Dadra and Nagar Haveli</option>
                            <option value="Daman and Diu" <?php if($state=='Daman and Diu'){echo "selected";}?>>Daman and Diu</option>
                            <option value="Delhi" <?php if($state=='Delhi'){echo "selected";}?>>Delhi</option>
                            <option value="Goa" <?php if($state=='Goa'){echo "selected";}?>>Goa</option>
                            <option value="Gujarat" <?php if($state=='Gujarat'){echo "selected";}?>>Gujarat</option>
                            <option value="Haryana" <?php if($state=='Haryana'){echo "selected";}?>>Haryana</option>
                            <option value="Himachal Pradesh" <?php if($state=='Himachal Pradesh'){echo "selected";}?>>Himachal Pradesh</option>
                            <option value="Jammu and Kashmir" <?php if($state=='Jammu and Kashmir'){echo "selected";}?>>Jammu and Kashmir</option>
                            <option value="Karnataka" <?php if($state=='Karnataka'){echo "selected";}?>>Karnataka</option>
                            <option value="Kerala" <?php if($state=='Kerala'){echo "selected";}?>>Kerala</option>
                            <option value="Lakshadweep Islands" <?php if($state=='Lakshadweep Islands'){echo "selected";}?>>Lakshadweep Islands</option>
                            <option value="Madhya Pradesh" <?php if($state=='Madhya Pradesh'){echo "selected";}?>>Madhya Pradesh</option>
                            <option value="Maharashtra" <?php if($state=='Maharashtra'){echo "selected";}?>>Maharashtra</option>
                            <option value="Manipur" <?php if($state=='Manipur'){echo "selected";}?>>Manipur</option>
                            <option value="Meghalaya" <?php if($state=='Meghalaya'){echo "selected";}?>>Meghalaya</option>
                            <option value="Mizoram" <?php if($state=='Mizoram'){echo "selected";}?>>Mizoram</option>
                            <option value="Nagaland" <?php if($state=='Nagaland'){echo "selected";}?>>Nagaland</option>
                            <option value="Orissa" <?php if($state=='Orissa'){echo "selected";}?>>Orissa</option>
                            <option value="Puducherry" <?php if($state=='Puducherry'){echo "selected";}?>>Puducherry</option>
                            <option value="Punjab" <?php if($state=='Punjab'){echo "selected";}?>>Punjab</option>
                            <option value="Rajasthan" <?php if($state=='Rajasthan'){echo "selected";}?>>Rajasthan</option>
                            <option value="Sikkim" <?php if($state=='Sikkim'){echo "selected";}?>>Sikkim</option>
                            <option value="Tamil Nadu" <?php if($state=='Tamil Nadu'){echo "selected";}?>>Tamil Nadu</option>
                            <option value="Tripura" <?php if($state=='Tripura'){echo "selected";}?>>Tripura</option>
                            <option value="Uttar Pradesh" <?php if($state=='Uttar Pradesh'){echo "selected";}?>>Uttar Pradesh</option>
                            <option value="West Bengal" <?php if($state=='West Bengal'){echo "selected";}?>>West Bengal</option>
                            <option value="Telangana" <?php if($state=='Telangana'){echo "selected";}?>>Telangana</option>
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
                                                                                        
                                            <option value="Restaurant" <?php if($usergroup=='Restaurant'){echo "selected";}?>>Restaurant</option>
                                                                                        
                                            <option value="Apparel/Retail" <?php if($usergroup=='Apparel/Retail'){echo "selected";}?>>Apparel/Retail</option>
                                                                                        
                                            <option value="Jewellery" <?php if($usergroup=='Jewellery'){echo "selected";}?>>Jewellery</option>
                                                                                        
                                            <option value="Salon/Spa" <?php if($usergroup=='Salon/Spa'){echo "selected";}?>>Salon/Spa</option>
                                                                                        
                                            <option value="Gym/Yoga" <?php if($usergroup=='Gym/Yoga'){echo "selected";}?>>Gym/Yoga</option>
                                                                                        
                                            <option value="Other shops" <?php if($usergroup=='Other shops'){echo "selected";}?>>Other shops</option>
                                                                                        
                                            <option value="Demo" <?php if($usergroup=='Demo'){echo "selected";}?>>Demo</option>
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
                                                                <input class="form-control border-primary" type="email" placeholder="email" id="userinput5" name="email" value="<?php if(!empty($email)){echo $email; }?>" required>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput6">Website</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input class="form-control border-primary" type="url" placeholder="http://" id="userinput6" name="website" value="<?php if(!empty($website)){echo $website; }?>">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control">Contact Number</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input class="form-control border-primary" type="tel" placeholder="Contact Number" id="userinput7" name="contact" value="<?php if(!empty($contact)){echo $contact; }?>" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput8">Bio</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <textarea id="userinput8" rows="6" class="form-control border-primary" name="bio" placeholder="Bio"><?php if(!empty($bio)){echo $bio; }?></textarea>
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
                                        <form class="form form-horizontal" method="post"  onsubmit="return checkForm(this);" action="change_password_code.php">
                                         <input type="hidden" name="userid" value="<?php echo $_SESSION["user_id"];?>">
                                         <h4 class="form-section"><i class="ft-user"></i> Change Password</h4>

                                                <div class="row">
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
                                                            <label class="col-md-3 label-control" for="userinput4">Confirm Password </label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input type="password" id="userinput4" class="form-control border-primary" placeholder="Confirm Password" name="pwd2">
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>

                                            <div class="form-actions text-right">
                                                <button type="button" class="btn btn-warning mr-1">
                                                    <i class="ft-x"></i> Cancel
                                                </button>
                                                <button type="submit" class="btn btn-primary"  name="submit" value="Submit">
                                                    <i class="la la-check-square-o"></i> Update
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