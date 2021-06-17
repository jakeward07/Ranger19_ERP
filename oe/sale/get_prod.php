<?php
$q = $_GET['q'];
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');

if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}

mysqli_select_db($conn,"immf");

$sql="SELECT * FROM immf i INNER JOIN imwh wh ON wh.im_id = i.im_id WHERE i.im_sku = '$q' AND wh.wh_site = $site_cd LIMIT 1"; 

$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)) {

if ($result->num_rows > 0) {
?><span>
    <p1>Description: </p1><input value="<?php echo $row["im_desc"];?>" disabled>
    <input hidden id="per" value="<?php echo $row["im_per"];?>">
    <span hidden><input value="<?php echo $row["im_desc"];?>" name="ln_desc"></span>
<p1  id="getCost" hidden>
    <?php if ($row["wh_avgcst"] > 0) {
  echo "<input id='margCs' value='$row[wh_avgcst]'>";
} else {
     echo "<input id='margCs' value='$row[im_stdc]'>";
}?></p1>
</span>
<?php
}}?>