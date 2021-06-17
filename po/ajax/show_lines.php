<div class="searchBox" style="width:800px;text-align:center">    <button style="float:right" onclick="showPo()">X</button>
    <h1>Purchase Order Lines</h1>

<table>
    <tr>
    <th>Product Code</th>
    <th>Description</th>
    <th>Price</th>
    <th>Quantity</th>
    <th>Total</th>
    </tr>
<?php
$o = $_GET["o"];
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');

if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}

mysqli_select_db($conn,"cumf");

$sql="SELECT * FROM poln WHERE ln_order = $o AND ln_wh = $site_cd"; 

$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)) {

if ($result->num_rows > 0) {
 
?>
<tr>
    <td><?php echo $row["ln_sku"];?></td>
    <td><?php echo $row["ln_desc"];?></td>
    <td>$<?php echo $row["ln_price"];?></td>
    <td><?php echo $row["ln_qty"];?></td>
    <td>$<?php echo $row["ln_qty"]*$row["ln_price"];?></td>
       </tr>
<?php }}?>
