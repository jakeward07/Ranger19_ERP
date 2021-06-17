<?php
$q = $_GET['q'];
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}

mysqli_select_db($conn,"cumf");

$sql="SELECT * FROM cumf WHERE cu_id = '$q'"; 

$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)) {

if ($result->num_rows > 0) {
    $held = $row["cu_hldsts"];
?>
<input name="oh_cust" hidden value="<?php echo $row["cu_id"]?>">

<input id="holdS" value="<?php echo $held;?>" hidden>
<span><p1>Customer: </p1><input disabled value="<?php echo $row["cu_name"];?>"></span><br>
<p1>Credit Limit: </p1><input value="<?php echo $row["cu_limit"];?>" name="cu_limit" required step="0.1" type="number"><br>
<p1>Credit Status: </p1><select name="cu_hldsts">
<option value="1" <?php if ($row["cu_hldsts"] ==1) {echo "selected";}?>>No Status</option>
<option value="4" <?php if ($row["cu_hldsts"] ==4) {echo "selected";}?>>Hard Hold</option>
<option value="3" <?php if ($row["cu_hldsts"] ==3) {echo "selected";}?>>Exceeded Terms</option>
<option value="2" <?php if ($row["cu_hldsts"] ==2) {echo "selected";}?>>Exceeded Limit</option>

</select>
<?php }}?>
