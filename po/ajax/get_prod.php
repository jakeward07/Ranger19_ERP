<?php
$q = $_GET['q'];

include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');

if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}

mysqli_select_db($conn,"cumf");

$sql="SELECT * FROM immf i INNER JOIN pofr p ON i.im_id = p.fr_imid WHERE i.im_sku = '$q' LIMIT 1"; 

$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)) {

if ($result->num_rows > 0) {
$desc = $row["im_desc"];
$qty = $row["fr_qty"];
$priceper = $row["im_per"];
$uom = $row["im_uom"];

?>
<p1>Description: </p1><input id="im_desc" value="<?php echo $desc;?>" disabled><br>
<p1>Per: </p1><input id="im_per" disabled value="<?php echo $priceper, ' ', $uom;?>"><br>
<input name="ln_per" readonly value="<?php echo $priceper?>" hidden>
<input name="ln_uom" readonly value="<?php echo $uom;?>" hidden>

<?php }}?>
