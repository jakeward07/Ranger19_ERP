<p1>Contract: </p1>
<select name="ph_contract">
<option></option>
<?php
$q = $_GET['q'];
$date = date('Y-m-d');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');

if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}

mysqli_select_db($conn,"cumf");

$sql="SELECT * FROM sdhd d LEFT JOIN posr r ON r.sr_supp = $q AND r.sr_site = $site_cd WHERE d.sd_supp = $q AND d.sd_startdate <= '$date' AND d.sd_expdate >= '$date' AND d.sd_site = $site_cd GROUP BY d.sd_name"; 

$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)) {

if ($result->num_rows > 0) {
$cont = $row["sr_cont"];


?>
    <option <?php if ($cont ==$row["sd_code"]) {echo "selected";}?> value="<?php echo $cont;?>"><?php echo $row["sd_name"];?></option>
<?php }}?>
</select>