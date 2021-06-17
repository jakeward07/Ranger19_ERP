<tr><?php
$q = $_GET['q'];
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}

mysqli_select_db($conn,"cumf");

$sql="SELECT * FROM cumf WHERE cu_id = '$q' OR cu_alias LIKE '$q%'"; 

$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)) {

if ($result->num_rows > 0) {

?> 

<a href="javascript:void()" onclick="takeCust(this.id)" id="custSugVal" style="color:black"><?php echo $row["cu_name"];?></a><br>
<?php
                           }}?></tr>