<?php
$q = $_GET['q'];

include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');

if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}

mysqli_select_db($conn,"cumf");
if ((($sec =="ADM") or ($sec =="AR") or ($sec =="ARS"))) {
    $sql="SELECT * FROM arbl b INNER JOIN stmf s ON b.bl_site = s.st_code INNER JOIN cumf c ON c.cu_id = b.bl_cust WHERE b.bl_cust = $q ORDER BY b.bl_inv DESC LIMIT 1"; 
} else {
$sql="SELECT * FROM arbl b INNER JOIN stmf s ON b.bl_site = s.st_code WHERE b.bl_cust = $q AND b.bl_site = $site_cd ORDER BY b.bl_inv DESC LIMIT 1"; 
}
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)) {

if ($result->num_rows > 0) {
$cuLimit = $row["cu_limit"];
?>
<div class="left">
<p1>Customer: </p1><input onchange="showBut()" id="cust" disabled value="<?php echo $row["cu_name"];?>"><br>
<p1>Credit Limit: </p1><input id="limit" disabled value="$<?php echo number_format($row["cu_limit"],2);?>"><br>
<p1>Available Credit: </p1><input value="<?php $sql="SELECT sum(bl_amt) AS balance FROM arbl WHERE bl_cust = $q AND bl_status = 'Owing'"; 

$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)) {

if ($result->num_rows > 0) {
echo "$",number_format($cuLimit-$row["balance"],2);
                           }} ?>" disabled id="avail"><br>
<p1>Current Balance: </p1><input id="balance" disabled value="$<?php echo number_format(159923,2);?>"><br>
<br>
 

</div>
<div class="right">
<p1>Last Payment: </p1><input disabled value="2020-10-15" type="date"><br>
<p1>Current Balance: </p1><input id="bal" disabled value="<?php $sql="SELECT sum(bl_amt) AS balance FROM arbl WHERE bl_cust = $q AND bl_status = 'Owing'"; 

$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)) {

if ($result->num_rows > 0) {
echo "$",number_format($row["balance"],2);
                           }} ?>"><br>
    <p1>Total Sales: </p1><input disabled value="<?php $sql="SELECT sum(vh_amtinc) AS sales FROM invh WHERE vh_cust = $q"; 

$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)) {

if ($result->num_rows > 0) {
echo "$",number_format($row["sales"],2);
                           }} ?>">

</div><?php }}?> 
<table style="width:100%;float:left">
<tr class="tr">
    <th class="th">Document Number</th>
    <th class="th">Apply to</th>
    <th class="th">Type</th>
    <th class="th">Document Type</th>
    <th class="th">PO Number</th>
    <th class="th">Document Value</th>
    <th class="th">Balance Due</th>
    
    </tr>


</table>


