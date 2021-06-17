<?php
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
$sql = "SELECT * FROM gnmf WHERE gn_id = 1 LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        //Define variables
        $gn_name = $row["gn_name"];
        $gn_defstate = $row["gn_defstate"];
        $gn_tax = $row["gn_tax"];
        $gn_taxval = $row["gn_taxval"];
    }
} else {
    echo "<script>alert('There has been an error. A record is missing from the General Masterfile table. Please contact SnakeBite Software for assistance.'); location.replace('/login.php');</script>";
}
?>