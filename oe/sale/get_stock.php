<?php
$q = $_GET['q'];
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');

if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}

mysqli_select_db($conn,"immf");

$sql="SELECT * FROM imwh WHERE wh_site = $site_cd AND im_id = (SELECT im_id FROM immf WHERE im_sku = '$q')"; 

$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)) {

if ($result->num_rows > 0) {
?>
<p1>On Hand: </p1><input value="<?php echo $row["wh_stk"];?>" disabled><br>
<p1>Available: </p1><input id="wh_avail" value="<?php echo $row["wh_stk"]-$row["wh_alloc"];?>" disabled><br>
<p1>Allocated: </p1><input id="wh_alloc" value="<?php echo $row["wh_alloc"];?>" disabled><br>
<p1>On Backorder: </p1><input value="<?php echo $row["wh_bor"];?>" disabled><br>
<p1>On Order: </p1><input value="<?php echo $row["wh_onor"];?>" disabled><br>
<?php if (!empty($row["wh_loc"])) {?><p1>Bin Location: </p1><input value="<?php echo $row["wh_loc"];?>" disabled><br><?php } ?>
<?php

                         }} 
    ?>
