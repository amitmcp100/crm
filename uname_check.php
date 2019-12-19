<?php
include("config.php");
/* Get username */
$uname = strtolower($_POST['uname']);
$sql = "SELECT  count(*) as cntUser   FROM `tbl_user_data` WHERE `username` = '$uname'";
$stmt = $DB->prepare($sql);
$stmt->execute();
$rows =$stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows = $stmt->fetch();
echo $rows['cntUser'];

?>