<?php 
$prog = "oe_stdc";
$mod = "oe";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/dep/oe/oe_stdc.php');
?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>Order Entry Standard Codes - RANGER 5</title>
    </head>
<body>
    <h1>Order Entry Standard Codes</h1>
    <?php if (!empty($_GET["success"])) {
    if ($_GET["success"] =="true") {
        echo "<div class='success'>Settings Saved...</div>";
    }
} ?>
    <form action="" method="post">
<div class="left">
   <span title="Allows the allocated field to override available stock"><p1>Allow Stock Override: </p1><select onchange="this.form.submit()" name="oe_allowstk">
    <option value="0" <?php if ($allowOverride ==0) {echo "selected";}?>>No</option>
    <option value="1" <?php if ($allowOverride ==1) {echo "selected";}?>>Yes</option>
    </select>
    </span>
    
    </div>
     
    </form>
    <?php if (!empty($_POST)) {
   //Sanitize
    $override = $conn -> real_escape_string($_POST["oe_allowstk"]);
    //Execute query
    $sql = "UPDATE oesc SET sc_allowstkoverride = '$override' WHERE sc_id = 1";
    $conn->query($sql);
    //Refresh Page
    echo "<script>location.replace('oe_stdc.php?success=true');</script>";
    
    
}?>
    </body>
</html>
