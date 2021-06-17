<table width="100%" style="text-align:center">
    <tr class="tr">
   <th class="th">Purchase Order</th>
   <th class="th">Supplier</th>
   <th class="th">Order Qty</th>
   <th class="th">Order Placed</th>
   
    </tr>
    
<?php
$q = $_GET['q'];
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');

if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}

mysqli_select_db($conn,"cumf");

$sql="SELECT * FROM pohd h INNER JOIN poln l ON l.ln_order = h.ph_order INNER JOIN sumf s ON s.su_code = h.ph_supp WHERE l.ln_sku = '$q' AND h.ph_site = $site_cd AND h.hd_stat = 'ORDERED' GROUP by h.ph_order"; 

$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)) {

if ($result->num_rows > 0) {
echo $conn->error;
     
    ?>
    
<tr class="tr">
    <td class="td"><?php echo $row["ph_order"],'-',$row["ph_site"];?></td>
    <td class="td"><?php echo $row["ph_supp"], ' - ', $row["su_name"];?></td>
    <td class="td"><?php echo $row["ln_qty"];?></td>
    <td class="td"><?php echo $row["ph_timestamp"];?></td>
   
    </tr>
<?php }}?>
</table>