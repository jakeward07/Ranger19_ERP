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
if ($result->num_rows > 0) {
while($row = mysqli_fetch_array($result)) {

?><span>
    <p1>Description: </p1><input value="<?php echo $row["im_desc"];?>" id="im_desc" disabled>
    <span hidden>
  
    <input id="per" disabled value="<?php echo $row["im_per"];?>">
    <input id="im_uom" disabled value="<?php echo $row["im_uom"];?>">
        
        <input value="<?php echo $row["im_desc"];?>" disabled name="ln_desc">
    </span>

    <?php if ($row["wh_avgcst"] > 0) {
  echo "<input value='$row[wh_avgcst]' id='margCs' hidden>";
} else {
     echo "<input value='$row[im_stdc]' id='margCs' hidden>";
}?>
</span>
<?php
}}?>