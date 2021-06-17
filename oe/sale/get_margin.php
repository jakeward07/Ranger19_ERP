<?php
$q = $_GET['q'];
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');

if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}

mysqli_select_db($conn,"immf");

$sql="SELECT * FROM imwh w INNER JOIN immf f ON f.im_id = w.im_id WHERE w.im_id = (SELECT im_id FROM immf WHERE im_sku = '$q') AND wh_site = $site_cd"; 

$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)) {

if ($result->num_rows > 0) {

if ($row["wh_avgcst"] !=='0') {
   echo "<input id='margCs' value='$row[wh_avgcst]'>";
}
                            else {
                              echo "<input id='margCs' value='$row[wh_stdcst]'>";
                            }
                           

}}
?>