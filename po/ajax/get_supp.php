<table style="width:100%; text-align:center">
    <tr class="tr">
    <th class="th">Supplier Code</th>
    <th class="th">Supplier Name</th>
    
    </tr>
<?php
$q = $_GET['q'];

include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');

if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}

mysqli_select_db($conn,"cumf");

$sql="SELECT * FROM pofr p INNER JOIN sumf s ON p.fr_supp = s.su_code WHERE p.fr_imid = (SELECT im_id FROM immf WHERE im_sku = '$q') ORDER BY s.su_name"; 

$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)) {

if ($result->num_rows > 0) {
?>
<tr class="tr">
    <td class="td"><?php echo $row["fr_supp"];?></td>
    <td class="td"><?php echo $row["su_name"];?></td>
    <td class="td"><a href="/ap/enq/ap_enq.php?q=<?php echo $row["su_code"];?>">View AP File</a></td>
    
    </tr>
<?php }}?>
</table>