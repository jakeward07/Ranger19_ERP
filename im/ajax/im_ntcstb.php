<table width="100%" style="text-align:center">
    <tr class="tr">
   <th class="th">Warehouse</th>
   <th class="th">Warehouse Name</th>
   <th class="th">Phone</th>
   <th class="th">Average Cost</th>
   <th class="th" title="Excludes any stock allocated to orders.">On Hand</th>
    
    
    </tr>
    
<?php
$q = $_GET['q'];
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');

if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}

mysqli_select_db($conn,"cumf");

$sql="SELECT * FROM immf i INNER JOIN imwh w ON i.im_id = w.im_id INNER JOIN stmf s ON s.st_code = w.wh_site WHERE w.im_id = (SELECT im_id FROM immf WHERE im_sku = '$q') AND NOT w.wh_stk = 0 ORDER BY w.wh_site"; 

$result = mysqli_query($conn,$sql);
if ($result->num_rows > 0) {
while($row = mysqli_fetch_array($result)) {

$d = $row["im_desc"];
?>
    
<tr class="tr">
   <td class="td"><?php echo $row["wh_site"];?></td>
   <td class="td"><?php echo $row["st_name"];?></td>
   <td class="td"><?php echo $row["st_phone"];?></td>
   <td class="td">$<?php echo $row["wh_avgcst"];?></td>
   <td class="td"><?php echo $row["wh_stk"];?></td>
    </tr>
<?php }} else { ?>
    <tr class="tr">
    <th class="th" colspan="5">No stock available</th>
    </tr>
    <?php } ?>
</table>