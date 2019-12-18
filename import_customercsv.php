<?php
// Database configuration
include("config.php");
//$db = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

// Check connection


if(isset($_POST['import'])){
 
    // Allowed mime types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    // Validate whether selected file is a CSV file
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
        
        // If the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            //echo $_FILES['file']['tmp_name'];
            // Skip the first line
            fgetcsv($csvFile);
            
            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
                $mobile   = $line[1];
                $name  = $line[0];
                $email  = $line[5];
                $anniversary = $line[4];
                $dob = $line[3];
				$amount = $line[6];
				$customer_group = $line[7];
				$comment = $line[8];
				$reminder = $line[9];
				$address = $line[2];

                
                $store_id=$_POST['store'];
                $userid=$_POST['userid'];

                $date = str_replace('/', '-', $anniversary );
                $ann = date("Y-m-d", strtotime($date));
                $date2 = str_replace('/', '-', $dob );
                $dob2 = date("Y-m-d", strtotime($date2));

               //  echo  "aaa".date_format($anniversary,"Y-m-d");
                 
                 $query="INSERT INTO `tbl_customer_data` (`id`, `store_id`, `mobile`, `name`, `email`, `anniversary`, `dob`, `amount`, `customer_group`, `comment`, `reminder`,  `userid`, `address`) VALUES (NULL,'$store_id', '" . $line[1] . "', '" . $line[0] . "', '" . $line[5] . "', '" . $line[4] . "', '" . $line[3] . "', '" . $line[6] . "', '" . $line[7] . "', '" . $line[8] . "', '" . $line[9] . "',  '$userid', '" . $line[2] . "')";
                 $stmt = $DB->prepare($query);
                 $stmt->execute();
                // Check whether member already exists in the database with the same email
              /*  $prevQuery = "SELECT id FROM members WHERE email = '".$line[1]."'";
                $prevResult = $db->query($prevQuery);*/

              

               /* echo "INSERT INTO `tbl_customer_data` (`id`, `mobile`, `name`, `email`, `anniversary`, `dob`, `amount`, `customer_group`, `comment`, `reminder`, `store`, `userid`, `address`) VALUES (NULL, '" . $line[1] . "', '" . $line[0] . "', '" . $line[5] . "', '" .$ann. "', '" .$dob2. "', '" . $line[6] . "', '" . $line[7] . "', '" . $line[8] . "', '" . $line[9] . "', '$store_id', '$userid', '" . $line[2] . "')";
                echo "</br>";*/
                if($prevResult->num_rows > 0){
                    // Update member data in the database
                  /*  $db->query("UPDATE members SET name = '".$name."', phone = '".$phone."', status = '".$status."', modified = NOW() WHERE email = '".$email."'");*/
                }else{
                    // Insert member data in the database
                  /*  $db->query("INSERT INTO members (name, email, phone, created, modified, status) VALUES ('".$name."', '".$email."', '".$phone."', NOW(), NOW(), '".$status."')");*/
                }
            }
            
            // Close opened CSV file
            fclose($csvFile);
            
            $qstring = '?data=update';
        }else{
            $qstring = '?data=error';
        }
    }else{
        $qstring = '?status=invalid_file';
    }
}

// Redirect to the listing page
header("Location: import-customer.php".$qstring);
exit;?>