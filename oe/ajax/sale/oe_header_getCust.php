<?php

include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
$q = $conn->real_escape_string($_GET['q']);
if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}

mysqli_select_db($conn,"immf");

$sql="SELECT * FROM cumf WHERE cu_id = $q AND cu_status = 1"; 

$result = mysqli_query($conn,$sql);
if ($result->num_rows > 0) {
while($row = mysqli_fetch_array($result)) {

?><span>
<p1>Customer Name: </p1><input id="name" value="<?php echo $row["cu_name"];?>" name="oh_cuname" required type="text" autocomplete="off"><br>
<p1>Purchase Order: </p1><input <?php if ($row['cu_po'] ==1) {echo "required";}?> type="text" autocomplete="off" id="cu_po" name="oh_cupo"><br>
<p1>Job Reference: </p1><input <?php if ($row['cu_jb'] ==1) {echo "required";}?> type="text" autocomplete="off" id="cu_jb" name="oh_cujb"><br>
</span>
<?php
}} else {
echo "<h3>No Customers exist with '$q'</h3>"; }?>