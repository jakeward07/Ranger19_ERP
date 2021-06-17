<table width="100%" style="text-align:center">
    <tr class="tr">
   <th class="th">Date</th>
   <th class="th">Movement Type</th>
   <th class="th">User</th>
   <th class="th">Quantity</th>
   <th class="th">Balance</th>
   <th class="th">Action</th>
    
  </tr>
    
<?php
$q = $_GET['q'];

include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');

if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}

mysqli_select_db($conn,"cumf");

$sql="SELECT * FROM immv WHERE mv_sku = '$q' AND mv_site = $site_cd ORDER BY mv_timestamp DESC"; 

$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)) {

if ($result->num_rows > 0) {
   $timeStamp = $row['mv_timestamp'];
$timeStamp = date( "d/m/Y g:i:sa", strtotime($timeStamp));
?>
    
<tr class="tr">
   <td class="td"><?php echo $timeStamp;?></td>
   <td class="td"><?php echo $row["mv_type"];?></td>
   <td class="td"><?php echo $row["mv_user"];?></td>
   <td class="td"><?php echo $row["mv_qty"];?></td>
   <td class="td"><?php echo $row["mv_bal"];?></td>
    <td class="td"><a href="im_mvmtdet.php?mid=<?php echo $row["mv_id"];?>">More Detail</a></td>
    </tr>
<?php }}?>
</table>