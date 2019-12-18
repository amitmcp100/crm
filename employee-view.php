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
            <h3 class="content-header-title">Customer Management</h3>
            <div class="row breadcrumbs-top">
               <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="retailers.php">Home</a>
                     </li>
                     <li class="breadcrumb-item active">Customer View
                     </li>
                  </ol>
               </div>
            </div>
         </div>
      </div>

      <form class="form form-horizontal"method="post" action="">
                <div class="row">
                         <div class="col-md-4">
                            <div class="form-group row">
                                <label class="col-md-3 label-control" for="userinput4">From Date </label>
                                <div class="col-md-9 mx-auto">
                                    <input type="date" id="dob" class="form-control" name="fromDate" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Date Fixed" data-original-title="" title="" aria-describedby="tooltip193832">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group row">
                                <label class="col-md-3 label-control" for="userinput4">To Date </label>
                                <div class="col-md-9 mx-auto">
                                    <input type="date" id="dob" class="form-control" name="endDate" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Date Fixed" data-original-title="" title="" aria-describedby="tooltip193832">
                                </div>
                            </div>
                        </div>

                         <div>
                            <input type="submit" class="btn btn-success" name="emp_search" value="search"></i> </button>
                         </div>
                </div>
            </form>
           

      <div class="row ">
         <?php if($_GET['data']=='update'){?> 
         <div class="alert btn-success mb-2" role="alert">
            <strong>Success !</strong> Update..!
         </div>
         <?php } ?>
         <?php if ($_GET['data']=='error') { ?>
         <div class="alert alert-warning mb-2" role="alert">
            <strong>Warning!</strong> Please Try Again !.
         </div>
         <?php } ?>   
      </div>
      <div class="content-body">
         <!-- Zero configuration table -->
         <section id="configuration">
            <div class="row">
               <div class="col-12">
                  <div class="card">
                     <div class="card-header">
                        <h4 class="card-title">Customer Management</h4>
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
                           <div class="table-responsive">
                              <table class="table table-striped table-bordered zero-configuration">
                                 <thead>
                                    <tr>
                                      
                                       <th>Name</th>
                                       <th>Designation</th>
                                       <th>Date</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php                                               
                                       /* Attempt MySQL server connection. Assuming you are running MySQL
                                       server with default setting (user 'root' with no password) */
                                    
                                                /* filter  customer records from date to date     */
                                                //include('configinc2.php');
                                               

                                                 // Date filter
                                                   if(isset($_POST['emp_search'])) {
                                                  //echo "hello";
                                                   $fromDate = $_POST['fromDate'];
                                                   $endDate = $_POST['endDate'];
                                                     
                                                   $userid=$_SESSION["user_id"];
                                                   $sql01 = "SELECT *  FROM `system_users` WHERE `u_userid` = '$userid'";
                                                    $stmt = $DB->prepare($sql01);
                                                    $stmt->execute();
                                                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                                    while ($row01 = $stmt->fetch()) {
                                                    
                                                    $uid=$row01['reguser_id'];
                                                    }
                                                    
                                                    // Attempt select query execution
                                                    $sql = "SELECT *  FROM `tbl_user_group` WHERE `child_id` = '$uid'";
                                                    //echo $sql;
                                                    $stmt = $DB->prepare($sql);
                                                    $stmt->execute();
                                                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                                    while ($row = $stmt->fetch()) {
                                                    
                                                    $store_id=$row['store_id'];
                                                    }
                                                    
                                                    $sql1 = "SELECT *  FROM `tbl_employee` WHERE  e_date between '".$fromDate."' and '".$endDate."'";
                                                    
                                                    $stmt = $DB->prepare($sql1);
                                                    $stmt->execute();
                                                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                                    while ($row1 = $stmt->fetch()) {
                                                    
                                                    $id=$row1['id'];
                                                    //echo "fdf".$id;
                                                    $name=$row1['name'];
                                                    ?>
                                                     <tr>
                                                     
                                                        <td><?php echo $row1['name'];?></td>
                                                        <td><?php echo $row1['designation'];?></td>
                                                        <td><?php echo $row1['e_date'];?></td>
                                                       
                                                        <td><a href="editcustomer.php?id=<?php echo $id;?>" class="btn btn-success box-shadow-2 mr-1 mb-1" data-toggle="tooltip" title="EDIT" ><i class="ft-edit"></i></a>
                                                        <a href="customer-sms.php?id=<?php echo $id;?>" class="btn btn-success  box-shadow-2 mr-1 mb-1" data-toggle="tooltip" title="SEND SMS MANUAL"><i class="ft-message-circle"></i></a>
                                                        <a href="customer-transaction.php?id=<?php echo $id;?>&name=<?php echo $name;?>" class="btn btn-success  box-shadow-2 mr-1 mb-1" data-toggle="tooltip" title="TRANSACTION">&#8377;</a>
                                                        <a href="deletecustomer.php?id=<?php echo $id;?>" onclick="return confirm('Are you sure you want to delete this customer?');" class="btn btn-warning  box-shadow-2 mr-1 mb-1" data-toggle="tooltip" title="DELETE CUSTOMER"><i class="ft-delete"></i></a>

                                                        </td>
                                                        
                                                    </tr>

                                                        <?php 
                                                    }
                                                         $stmt->closeCursor();
                                                         $DB = null;
                                                    }else{

                                                $userid=$_SESSION["user_id"];
                                                $sql01 = "SELECT *  FROM `system_users` WHERE `u_userid` = '$userid'";
                                                $stmt = $DB->prepare($sql01);
                                                $stmt->execute();
                                                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                                while ($row01 = $stmt->fetch()) {  
                                                   
                                                $uid=$row01['reguser_id'];
                                                }
                                                   // Attempt select query execution
                                                   $sql = "SELECT *  FROM `tbl_user_group` WHERE `child_id` = '$uid'";
                                                   //echo $sql;
                                                
                                                $stmt = $DB->prepare($sql);
                                                $stmt->execute();
                                                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                                while ($row = $stmt->fetch()) {  
                                                   
                                                $store_id=$row['store_id'];
                                                }

                                       
                                                $sql1 = "SELECT *  FROM `tbl_employee`";
                                                   //echo $sql1;
                                                   
                                                   $stmt = $DB->prepare($sql1);
                                                   $stmt->execute();
                                                   $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                                   while ($row1 = $stmt->fetch()) {  
                                                   
                                                   $store_id=$row1['id'];
                                                   $name=$row1['name'];
                                                  
                                                   ?>

                                             <tr>
                                                
                                                <td><?php echo $row1['name'];?></td>
                                                <td><?php echo $row1['designation'];?></td>
                                                <td><?php echo $row1['e_date'];?></td>
                                                <td>
                                                   <a href="editemployee.php?id=<?php echo $store_id;?>" class="btn btn-success box-shadow-2 mr-1 mb-1" data-toggle="tooltip" title="EDIT" ><i class="ft-edit"></i></a>
                                                   <a href="deleteemployee.php?id=<?php echo $store_id;?>" data-toggle="tooltip" title="DELETE EMPLOYEE" onclick="return confirm('Are you sure you want to delete this employee?');" class="btn btn-warning  box-shadow-2 mr-1 mb-1"><i class="ft-delete"></i></a>
                                                </td>
                                             </tr>
                                             <?php } }
                                               
                                                ?>
                                          </tbody>
                                       <tfoot>
                                          <tr>
                                            
                                             <th>Name</th>
                                             <th>Designation</th>
                                             <th>Date</th>
                                             <th>Action</th>
                                    </tr>
                                 </tfoot>
                              </table>
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
<script>
   $(document).ready(function(){
     $('[data-toggle="tooltip"]').tooltip();   
   });
</script>
<!-- BEGIN: Footer-->
<footer class="footer footer-static footer-light navbar-border navbar-shadow">
   <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block">Copyright &copy; 2019 <a class="text-bold-800 grey darken-2" href="" target="_blank">Loire Technologies</a></span></p>
</footer>
<!-- END: Footer-->
<!-- BEGIN: Vendor JS-->
<script src="app-assets/vendors/js/vendors.min.js"></script>
<!-- BEGIN Vendor JS-->
<!-- BEGIN: Page Vendor JS-->
<script src="app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<script src="app-assets/js/core/app-menu.js"></script>
<script src="app-assets/js/core/app.js"></script>
<!-- END: Theme JS-->
<!-- BEGIN: Page JS-->
<script src="app-assets/js/scripts/tables/datatables/datatable-basic.js"></script>
<!-- END: Page JS-->
</body>
<!-- END: Body-->
</html>