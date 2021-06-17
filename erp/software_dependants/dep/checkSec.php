<?php
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
$sql = "SELECT * FROM prsc WHERE sc_prog = '$prog'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        //Define variables
        $g = $row["sc_group"];
        $u = $row["sc_users"];
        //Check if group user is assigned to is permitted
        if (strpos($g, $sec) !==false) {
          //Allow
        }
        //Check if user is permitted
        elseif (strpos($u, $usernm) !==false) {
            //Allow 
        }
        //Verify if program is blocked
        elseif (strpos($g, '!') !==false) {
               echo "<script>location.replace('/erp/software_dependants/dep/access_error.php');</script>";
        }
        elseif (strpos($u, '!') !==false) {
               echo "<script>location.replace('/erp/software_dependants/dep/access_error.php');</script>";
        }
        
        
    }
}  else {
            echo "<script>alert('This program is not set up in the security masterfile.');</script>";
        }