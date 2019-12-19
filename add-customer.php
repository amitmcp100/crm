<?php
require_once ("config.php");
if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
    // not logged in send to login page
    redirect("index.php");
}

$userid   = $_SESSION["user_id"];
$store_id = $_SESSION['store_id'];

// set page title
$title = "Dashboard";
// if the rights are not set then add them in the current session
// if (!isset($_SESSION["access"])) {
//     try {
//         $sql = "SELECT mod_modulegroupcode, mod_modulegroupname FROM module " . " WHERE 1 GROUP BY `mod_modulegroupcode` " . " ORDER BY `mod_modulegrouporder` ASC, `mod_moduleorder` ASC  ";
//         $stmt = $DB->prepare($sql);
//         $stmt->execute();
//         $commonModules = $stmt->fetchAll();
//         $sql = "SELECT mod_modulegroupcode, mod_modulegroupname, mod_modulepagename,  mod_modulecode, mod_modulename FROM module " . " WHERE 1 " . " ORDER BY `mod_modulegrouporder` ASC, `mod_moduleorder` ASC  ";
//         $stmt = $DB->prepare($sql);
//         $stmt->execute();
//         $allModules = $stmt->fetchAll();
//         $sql = "SELECT rr_modulecode, rr_create,  rr_edit, rr_delete, rr_view FROM role_rights " . " WHERE  rr_rolecode = :rc " . " ORDER BY `rr_modulecode` ASC  ";
//         $stmt = $DB->prepare($sql);
//         $stmt->bindValue(":rc", $_SESSION["rolecode"]);
//         $stmt->execute();
//         $userRights = $stmt->fetchAll();
//         $_SESSION["access"] = set_rights($allModules, $userRights, $commonModules);
//     }
//     catch(Exception $ex) {
//         echo $ex->getMessage();
//     }
// }
include 'header.php';
?>
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->

<?php include ('sidebar.php'); ?>    
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
                                
                                <li class="breadcrumb-item active"><a href="#">Add Customer</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                
                
            </div>
            <div class="row ">
                    <?php if ($_GET['data'] == 'update') { ?> 
                    <div class="alert btn-success mb-2" role="alert">
                    <strong>Success !</strong> Update..!

                    </div>
                    <?php
                    } 
                    ?>
                    <?php if ($_GET['data'] == 'error') { ?>
                    <div class="alert alert-warning mb-2" role="alert">
                    <strong>Warning!</strong> Please Try Again !.
                        
                    </div>
                    <?php
                    }
                    ?>   
                
                </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <?php
/* Attempt MySQL server connection. Assuming you are running MySQL
 server with default setting (user 'root' with no password) */
//include("configinc2.php");

// $sql01 = "SELECT *  FROM `system_users` WHERE `u_userid` = '$usid'";
// $stmt = $DB->prepare($sql01);
// $stmt->execute();
// $stmt->setFetchMode(PDO::FETCH_ASSOC);
// if ($stmt == true) {
//     while ($row01 = $stmt->fetch()) {
//         $userid = $row01['reguser_id'];
//     }
// }
// // Attempt select query execution
// $sql = "SELECT *  FROM `tbl_user_group` WHERE `child_id` = '$userid'";
// // echo "ttttt".$sql;
// $stmt = $DB->prepare($sql);
// $stmt->execute();
// $stmt->setFetchMode(PDO::FETCH_ASSOC);
// if ($stmt == true) {
//     while ($row = $stmt->fetch()) {
//         $store_id = $row['store_id'];
//     }
// }
// Close connection
// Close connection

?>
                <section id="horizontal-form-layouts">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="horz-layout-colored-controls">Customer Management</h4>
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

                                   
                                        <form class="form form-horizontal" action="addcustomer_code.php" method="post">
                                        <input type="hidden" name="userid" value="<?php echo $userid; ?>">
                                        <input type="hidden" name="store_id" value="<?php echo $store_id; ?>">
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="la la-eye"></i> Add Customer</h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput1" >Mobile No.</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input type="text" id="userinput1" class="form-control border-primary" placeholder="Mobile Number" name="mobile"  onchange="mainInfo(this.value); " minlength='10' maxlength='10' required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput4">Loyality Points </label>
                                                            <div class="col-md-9 mx-auto">
                                                            <input type="text" class="form-control border-primary" placeholder="Loyality Points" name="loyalitypoints" id="loyalitypoints" >
                                                          
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                        <button type="submit" class="btn btn-primary" name="submit" value="Submit">
                                                            <a href="loyalityview.php"><i></i> Use Points</a>
                                                        </button>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput2">Name</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input type="text" id="name" class="form-control border-primary" placeholder="Name" name="name"  >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput3">Email</label>
                                                            <div class="col-md-9 mx-auto">
                                                                 <input type="email" id="email" class="form-control border-primary" placeholder="Email" name="email"  >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput4">Address</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input type="text" id="address" class="form-control border-primary" placeholder="Address" name="address"  >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput4">Anniversary Date</label>
                                                            <div class="col-md-9 mx-auto">
                                                               <input type="date"  class="form-control" name="anniversary" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Date Opened" data-original-title="" id="anniversary" title="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput4">Date Of Birth </label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input type="date" id="dob" class="form-control" name="dob" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Date Fixed" data-original-title="" title="" aria-describedby="tooltip193832">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput8">Mode</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <div class="input-group">
                                                                    <div class="d-inline-block custom-control custom-radio mr-1">
                                                                    <input type="radio" name="emode" class="custom-control-input" value="product" id="product">
                                                                    <label class="custom-control-label" for="product" >Product</label>
                                                                    </div>
                                                                    <div class="d-inline-block custom-control custom-radio">
                                                                    <input type="radio" name="emode" value="service"  class="custom-control-input" id="service" >
                                                                    <label class="custom-control-label" for="service">Service</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput8">Payment Mode</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <div class="input-group">
                                                                    <div class="d-inline-block custom-control custom-radio mr-1">
                                                                    <input type="radio" name="mode" class="custom-control-input" value="cash" id="cash" checked>
                                                                    <label class="custom-control-label" for="cash" >Cash</label>
                                                                    </div>
                                                                    <div class="d-inline-block custom-control custom-radio mr-1">
                                                                    <input type="radio" name="mode" value="wallet"  class="custom-control-input" id="wallet" >
                                                                    <label class="custom-control-label" for="wallet">Wallet</label>
                                                                    </div>
                                                                    <div class="d-inline-block custom-control custom-radio mr-1">
                                                                    <input type="radio" name="mode" class="custom-control-input" value="card" id="card" >
                                                                    <label class="custom-control-label" for="card" >Card</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput4">Select Employee </label>
                                                            <div class="col-md-9 mx-auto">
                                                            <select class="form-control  border-primary" id="employee"  name="employee">
                                                            <option value="">Select Employee</option>
                                                                <?php
                                                                $sql19 = "SELECT *  FROM `tbl_employee`  WHERE  store_id='$store_id'";
                                                                $stmt = $DB->prepare($sql19);
                                                                $stmt->execute();
                                                                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                                                if ($stmt == true) {
                                                                while ($row19 = $stmt->fetch()) {
                                                                $name = $row19['name']; 
                                                                $e_id = $row19['id'];?>
                                                                <option value="<?php echo $name; ?>"><?php echo $name; ?></option>
                                                                <?php
                                                                }
                                                                }
                                                                ?>
                                                            </select>
                                                               
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                     <div class="col-md-6">
                                                        <div class="form-group row " id="services1">
                                                            <label class="col-md-3 label-control" for="userinput4">Services </label>
                                                            <div class="col-md-9 mx-auto">
                                                            <select class=form-control id="multi-select-demo" name="service">
                                                             <option value="">Select Services</option>  
                                                            <?php
                                                            //include("configinc2.php");
                                                            $sql1 = "SELECT *  FROM `tbl_services`  WHERE  store_id='$store_id' ";
                                                            //echo $sql1;
                                                            $stmt = $DB->prepare($sql1);
                                                            $stmt->execute();
                                                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                                            if ($stmt == true) {
                                                            while ($row1 = $stmt->fetch()) {
                                                            $service = $row1['service_name'];
                                                            $s_id = $row1['id'];
                                                            ?>

                                                            <option value="<?php echo $service; ?>"><?php echo $service; ?></option>
                                                            <?php
                                                            }}
                                                            ?>
                                                            </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row " id="product1">
                                                            <label class="col-md-3 label-control" for="userinput4">Products </label>
                                                            <div class="col-md-9 mx-auto">
                                                            <select class=form-control id="multi-select-demo" name="product">
                                                             <option value="">Select Products</option>  
                                                            <?php
                                                            //include("configinc2.php");
                                                            $sql99 = "SELECT *  FROM `tbl_product`  WHERE  store_id='$store_id' ";
                                                            //echo $sql1;
                                                            $stmt = $DB->prepare($sql99);
                                                            $stmt->execute();
                                                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                                            if ($stmt == true) {
                                                            while ($row99 = $stmt->fetch()) {
                                                            $product = $row99['product_name'];
                                                            $s_id = $row1['id'];
                                                            ?>

                                                            <option value="<?php echo $product; ?>"><?php echo $product; ?></option>
                                                            <?php
                                                            }}
                                                            ?>
                                                            </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row" id="amount1">
                                                            <label class="col-md-3 label-control" for="userinput4">Amount </label>
                                                            <div class="col-md-9 mx-auto">
                                                            <input class="form-control border-primary" type="text" placeholder="Amount" id="amount" name="amount" >
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput4">Customer Group </label>
                                                            <div class="col-md-9 mx-auto">
                                                            <select class="form-control  border-primary" id="c_group"  name="c_group">
                                                            <option value="">Select Category</option>
                                                            <?php
$sql1 = "SELECT *  FROM `tbl_customer_group` WHERE `store_id` = '$store_id'";
$stmt = $DB->prepare($sql1);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
if ($stmt == true) {
while ($row1 = $stmt->fetch()) {
$name = $row1['name']; ?>
                                                            <option value="<?php echo $name; ?>"><?php echo $name; ?></option>
                                                            <?php
    }
}
?>
                                                            </select>
                                                               
                                                            </div>
                                                        </div>
                                                    </div>

                                                     <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput4">Customer Source </label>
                                                            <div class="col-md-9 mx-auto">
                                                            <select class="form-control  border-primary" id="c_source"  name="c_source">
                                                            <option value="">Select Source</option>
                                                            <?php
$sql1 = "SELECT *  FROM `tbl_customer_source` WHERE `store_id` = '$store_id'";
$stmt = $DB->prepare($sql1);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
if ($stmt == true) {
while ($row1 = $stmt->fetch()) {
$name = $row1['name']; ?>
                                                            <option value="<?php echo $name; ?>"><?php echo $name; ?></option>
                                                            <?php
    }
}
?>
                                                            </select>
                                                               
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput8">Reminder</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <div class="input-group">
                                                                <div class="d-inline-block custom-control custom-radio mr-1">
                                                                <input type="radio" name="reminder" class="custom-control-input" value="yes" id="yes">
                                                                <label class="custom-control-label" for="yes" >Yes</label>
                                                                </div>
                                                                <div class="d-inline-block custom-control custom-radio">
                                                                <input type="radio" name="reminder" value="no"  class="custom-control-input" id="no">
                                                                <label class="custom-control-label" for="no">No</label>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput8">Send SMS</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <div class="input-group">
                                                                <div class="d-inline-block custom-control custom-radio mr-1">
                                                                <input type="radio" name="sms" class="custom-control-input" value="yes" id="yes1">
                                                                <label class="custom-control-label" for="yes1" >Yes</label>
                                                                </div>
                                                                <div class="d-inline-block custom-control custom-radio">
                                                                <input type="radio" name="sms" value="no"  class="custom-control-input" id="no1" checked>
                                                                <label class="custom-control-label" for="no1">No</label>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                   
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput8">Comment</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <textarea id="comment" rows="6" class="form-control border-primary" name="comment" placeholder="Comment"></textarea>
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
    


    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light navbar-border navbar-shadow">
        <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block">Copyright &copy; 2019 <a class="text-bold-800 grey darken-2" href="" target="_blank">Loire Technologies</a></span></p>
    </footer>
    <!-- END: Footer-->
   
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



 function mainInfo(id) {

    $.ajax({
        type: "POST",
        url: "fetchcustomer.php",
        data: "mobile="+id,
        dataType:"JSON",

        success: function(data) {
           /* if(data){
               
            }*/
          if (!$.trim(data)){   
               $('#name').val('');
               $("#loyalitypoints").val('');
               $('#email').val('');
               $('#address').val('');
               $('#anniversary').val('');
               $('#dob').val('');
               $('#customer_group').val('');
               $('#comment').val('');
               $('#reminder').val('');
               $("#c_group").val('');
                      
             //  $("input[name='reminder']:checked").val("Yes");
               $("input[name=reminder][value="+''+"]").attr('checked', 'checked');
}
else{   
               $('#name').val(data.name);
               $('#loyalitypoints').val(data.loyalitypoints);
               $('#email').val(data.email);
               $('#address').val(data.address);
               $('#anniversary').val(data.anniversary);
               $('#dob').val(data.dob);
               $('#employee').val(data.employee);
               $('#customer_group').val(data.customer_group);
               $('#comment').val(data.comment);
               $('#reminder').val(data.reminder);
               $("#c_group").val(data.customer_group).change();
                //  $("input[name='reminder']:checked").val("Yes");
               $("input[name=reminder][value=" + data.reminder + "]").attr('checked', 'checked');
}
                //alert(data.name);
        }
    });
};
 $(document).ready(function(){
   
 // show the table as soon as the DOM is ready
 $("#product").click(function() {
 $("#services1").hide();
 $("#product1").show();
});
 $("#service").click(function() {
 $("#product1").hide();
 $("#services1").show();
}); 

});

 </script>