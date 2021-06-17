<?php
//File holding OE standard definitions
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
$sql = "SELECT * FROM oesc WHERE sc_id = 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $allowOverride = $row["sc_allowstkoverride"];
    
     
    }
}
?>