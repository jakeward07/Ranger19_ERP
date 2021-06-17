<?php
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
$q = $conn->real_escape_string($_GET["q"]);

$sql = "SELECT * FROM imwh WHERE wh_site = $site_cd AND im_id = (SELECT im_id FROM immf WHERE im_sku = '$q')";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        ?>
<p1>Bin Location: </p1><input required autocomplete="off" name="wh_loc" maxlength="4" type="text" value="<?php echo $row["wh_loc"];?>" list="imlc">
<datalist id="imlc">
<?php 
        $sql = "SELECT * FROM imlc WHERE lc_site = $site_cd ORDER BY lc_loc";
        $result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        ?>
    <option value="<?php echo $row["lc_loc"];?>"><?php echo $row["lc_name"];?></option>
    <?php }}?>
</datalist>
<br>
<button type="submit" class="submit">Bin Locate Product &rarr;</button>
<?php
    }
} 