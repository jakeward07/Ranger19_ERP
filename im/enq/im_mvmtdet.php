<?php 
$prog = "im_mvmtdet";
$mod = "im";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>Detailed Movement Enquiry - RANGER 5</title>
    </head>
<body>
    <?php 
    $id = $_GET["mid"];
    $sql = "SELECT * FROM immv WHERE mv_id = $id AND mv_site = $site_cd";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $d1 = strtotime($row["mv_timestamp"]);
             $date = date("d/m/Y g:ia", $d1);
            ?>
      
<h1>Detailed Movement Enquiry</h1>
     <div class="left">
    <p1>Product: </p1><input disabled value="<?php echo $row["mv_sku"];?>"><br>
    <p1>Receipted: </p1><input disabled value="<?php echo $date;?>"><br>
    <p1>User: </p1><input disabled value="<?php echo $usernm;?>"><br>
    <p1>Movement Type: </p1><input disabled value="<?php echo $row["mv_type"];?>"><br>
    <p1>Quantity : </p1><input disabled value="<?php echo $row["mv_qty"];?>"><br>
    <p1>Prior Quantity : </p1><input disabled value="<?php echo $row["mv_bal"];?>"><br>
    
    
    </div>
    
    
    
    <?php }}?>
    </body>
</html>
