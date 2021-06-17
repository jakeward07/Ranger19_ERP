<div class="right">
<?php
$q = $_GET['q'];
$date = date('Y-m-d');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');

if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}

mysqli_select_db($conn,"cumf");

$sql="SELECT * FROM pohd h INNER JOIN sumf s ON s.su_code = h.ph_supp WHERE h.ph_order = $q AND h.ph_site = $site_cd"; 

$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)) {

if ($result->num_rows > 0) {
$cont = $row["sd_code"];


?>
<p1>Supplier: </p1><input disabled value="<?php echo $row["ph_supp"], ' - ', $row["su_name"];?>"><br>
<p1>User: </p1><input disabled value="<?php echo $row["ph_user"];?>"><br>
    <input id="status" value="<?php echo $row["hd_stat"];?>" hidden>
  
    <button type="submit" class="submit">Modify Lines</button>
<?php }}?>
</div>