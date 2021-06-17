<?php
$q = $_GET['q'];
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}

mysqli_select_db($conn,"cumf");

$sql="SELECT * FROM cumf c INNER JOIN hlst h ON c.cu_hldsts = h.hl_id LEFT JOIN gnmf g ON gn_id = 1 WHERE c.cu_id = '$q'"; 

$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)) {

if ($result->num_rows > 0) {
    $held = $row["cu_hldsts"];
?>
<input name="oh_cust" hidden type="text" value="<?php echo $row["cu_id"]?>">
<input id="hldact" hidden type="text" value="<?php echo $row["hl_action"];?>">
<input id="hldtxt" hidden type="text" value="<?php echo $row["hl_desc"];?>">
<input id="pswd" hidden type="text" value="<?php echo $row["oe_pswd"];?>">
<input id="holdS" value="<?php echo $held;?>" hidden>
<span><p1>Customer: </p1><input disabled value="<?php echo $row["cu_name"];?>"></span><br>
<span><p1>PO: </p1><input autofocus id="cupo" autocomplete="off" name="oh_cupo" <?php if ($row["cu_po"] ==1) {echo "required";}?> ></span><br>
<span><p1>Job Ref: </p1><input id="cujb" autocomplete="off" name="oh_cujb" <?php if ($row["cu_jb"] ==1) {echo "required";}?> ></span><br>
<?php }}?>
