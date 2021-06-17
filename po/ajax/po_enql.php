<table class="table">
<tr class="tr">
    <th class="th">Product Code</th>
    <th class="th">Description</th>
    <th class="th">Quantity</th>
    <th class="th">Price Ex GST</th>
    <th class="th">Total Ex GST</th>
    
    </tr>
    <?php
$q = $_GET['q'];
$date = date('Y-m-d');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');

if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}

mysqli_select_db($conn,"cumf");

$sql="SELECT * FROM poln WHERE ln_order = $q AND ln_wh = $site_cd"; 

$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)) {

if ($result->num_rows > 0) { ?>
    <tr class="tr">
    <td class="td"><?php echo $row["ln_sku"];?></td>
    <td class="td"><?php echo $row["ln_desc"];?></td>
    <td class="td"><?php echo $row["ln_qty"];?></td>
    <td class="td">$<?php echo number_format($row["ln_price"],2);?></td>
    <td class="td">$<?php echo number_format($row["ln_price"]*$row["ln_qty"],2);?></td>
    
    </tr>
    
    
    <?php }}?>

</table>
<table class="table" style="width: 30%; float: right">
<tr class="tr">
    <th class="th">Total Value Ex GST</th>
    <th class="th">Total Value Inc GST</th>
    </tr>
    <?php
    mysqli_select_db($conn,"cumf");

$sql="SELECT sum(ln_price*ln_qty) AS total FROM poln WHERE ln_order = $q AND ln_wh = $site_cd LIMIT 1"; 

$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)) {

if ($result->num_rows > 0) { ?>
    <tr class="tr">
        <td class="td">$<?php echo number_format($row["total"],2)?></td>
        <td class="td">$<?php echo number_format($row["total"]*1.1,2)?></td>
    
    </tr>
<?php }}?>
</table>