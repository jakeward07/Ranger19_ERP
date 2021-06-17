<table width="100%" style="text-align:center">
    <tr>
    <th>Product Code</th>
    <th>Description</th>
    <th>Trade Price</th>
    <th>Retail Price</th>
    <th>Available</th>
    <th>Action</th>
    
    
    </tr>
    
<?php
$q = $_GET['q'];
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');

if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}

mysqli_select_db($conn,"cumf");

$sql="SELECT * FROM immf i LEFT JOIN imwh h ON i.im_id = h.im_id AND h.wh_site = '$site_cd' WHERE i.im_scls = '$q' ORDER BY i.im_sku"; 

$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)) {

if ($result->num_rows > 0) {
  
?>
<tr>
    <td><?php echo $row["im_sku"];?></td>
    <td><?php echo $row["im_desc"];?></td>
    <td>$<?php echo $row["im_trd"];?></td>
    <td>$<?php echo $row["im_ret"];?></td>
    <td><?php echo $row["wh_stk"]-$row["wh_alloc"];?></td>
    <td><a href="/im/enq/im_enq.php?product=<?php echo $row["im_sku"];?>">Product Enquiry &rarr;</a></td>
    
    </tr>
<?php }}?>
</table>