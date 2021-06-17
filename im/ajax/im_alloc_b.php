<table width="100%" style="text-align:center">
    <tr class="tr">
   <th class="th">Sales Order</th>
   <th class="th">Customer</th>
   <th class="th">Order Qty</th>
   <th class="th">Allocated Qty</th>
   <th class="th">Backorder Qty</th>
   
    </tr>
    
<?php
$q = $_GET['q'];
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');

if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}

mysqli_select_db($conn,"cumf");

$sql="SELECT * FROM imwh w INNER JOIN orln l ON l.ln_sku = '$q' INNER JOIN orhd h ON h.oh_order = l.ln_order INNER JOIN cumf c ON c.cu_id = h.oh_cust WHERE l.ln_site = $site_cd GROUP BY h.oh_order"; 

$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)) {

if ($result->num_rows > 0) {
echo $conn->error;
     
    ?>
    
<tr class="tr">
    <td class="td"><?php echo $row["oh_order"];?></td>
    <td class="td"><?php echo $row["oh_cust"], ' - ', $row["cu_name"];?></td>
    <td class="td"><?php echo $row["ln_order"];?></td>
    <td class="td"><?php echo $row["ln_alloc"];?></td>
    <td class="td"><?php echo $row["ln_bor"];?></td>
   
    </tr>
<?php }}?>
</table>