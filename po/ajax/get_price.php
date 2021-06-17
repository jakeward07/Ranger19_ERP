<?php
$q = $_GET['q'];
$p = $_GET['p'];
$qu = $_GET['qu'];

include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');

if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}

mysqli_select_db($conn,"cumf");

$sql="SELECT * FROM sdln WHERE sl_sku = '$p' AND sl_code = '$q' AND (sl_bval = '$qu' OR sl_bval < '$qu') ORDER BY sl_bval DESC LIMIT 1"; 

$result = mysqli_query($conn,$sql);
if ($result->num_rows > 0) {
while($row = mysqli_fetch_array($result)) {


?>
<p1>Price: </p1><input name="ln_price" onkeyup="calcTot(); gstVal()" type="number" step="0.0001" id="price" title="Special Discount applied from Contact <?php echo $row["sl_code"];?>" style="outline:solid;outline-color:limegreen;" value="<?php echo $row["sl_price"];?>"><br>

<?php }}
else {
    $sql = "SELECT * FROM immf WHERE im_sku = '$p'";
    $result=$conn->query($sql);
    if ($result->num_rows > 0) {
        while($row=$result->fetch_assoc()) {
            ?>
<p1>Price: </p1><input name="ln_price" id="price" onkeyup="calcTot(); gstVal()" title="No special pricing exists for this product or quantity. Refer to the right table for pricebreaks." style="outline:solid;outline-color:blue;" value="<?php echo $row["im_stdc"];?>"><br>
<?php
}}}
?>
