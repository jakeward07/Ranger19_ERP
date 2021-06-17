<table class="table">
<tr class="tr">
    <th class="th">Product Code</th>
    <th class="th">Description</th>
    <th class="th">Quantity</th>
    <th class="th">Price exc. GST</th>
    <th class="th">Flag</th>
    <th class="th">Return Stock</th>
    </tr>

<?php
$q = $_GET['q']; //invoice
$c = $_GET['c']; //customer
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');

if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}

mysqli_select_db($conn,"cumf");
$sql = "SELECT * FROM invh h INNER JOIN invl l ON l.vl_inv = h.vh_inv AND l.vl_site = $site_cd WHERE h.vh_inv = $q AND h.vh_site = $site_cd AND h.vh_cust = $c";
$result = mysqli_query($conn,$sql);
    if ($result->num_rows > 0) {
while($row = mysqli_fetch_array($result)) {
    $vh_user = $row["vh_user"];
?>
  <tr class="tr" onclick="thisCheck()">
    <td class="td"><?php echo $row["vl_sku"];?></td>
    <td class="td"><?php echo $row["vl_desc"];?></td>
    <td class="td"><?php echo $row["vl_qty"];?></td>
    <td class="td">$<?php echo $row["vl_price"];?></td>
    <td class="td"><input name="flagSku[]" type="checkbox"></td>
    <td class="td"><input name="flagSku[]" type="checkbox"></td>
    </tr>
    
    <?php  }} else {
        echo "<h1>Invoice '$q' either doesn't belong to customer '$c' or does not yet exist.</h1>";
    }
    ?>

