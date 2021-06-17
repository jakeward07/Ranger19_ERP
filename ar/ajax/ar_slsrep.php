<p1>Sales Rep: </p1><select name="cu_slsrep" required>
    <option></option>
<?php
$q = $_GET['q'];
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}

mysqli_select_db($conn,"cumf");

$sql="SELECT * FROM srmf WHERE sr_site = '$q'"; 

$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)) {

if ($result->num_rows > 0) {
    ?>
    <option value="<?php echo $row["sr_salesid"];?>"><?php echo $row["sr_salesid"], ' - ', $row["sr_name"];?></option>

<?php
    
}}?>
</select><br>