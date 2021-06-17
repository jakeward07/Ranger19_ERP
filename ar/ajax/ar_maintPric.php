<?php
$q = $_GET['q'];
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}

mysqli_select_db($conn,"cumf");

$sql="SELECT * FROM cumf c INNER JOIN cutp t ON t.tp_id = c.cu_type WHERE c.cu_id = '$q'"; 

$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)) {

if ($result->num_rows > 0) {
  $cutype = $row["cu_type"];
    $cu_terms = $row["cu_terms"];
    $fbm = $row["cu_fallback"];
    $fbt = $row["cu_fbtype"];
    $limit = $row["cu_limit"];
    $pricing = $row["cu_sptp"];
    $salesrep = $row["cu_slsrep"];
    $po = $row["cu_po"];
    $job = $row["cu_jb"];
    $cu_type = $row["cu_type"];
?><br>
<div class="bodystrip">
<button onclick="fetchCust()">Main Profile</button>
<button onclick="fetchOe()">Order Entry Options</button>
</div>
<div class="left">
<p1>Customer Name: </p1><input name="cu_name" value="<?php echo $row["cu_name"];?>" disabled type="text" autocomplete="off"><br>
<p1>Account Type: </p1><select name="cu_type" required>
    <option></option>
   <?php
    $sql = "SELECT * FROM cutp";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
        ?>
    <option value="<?php echo $row["tp_id"];?>" <?php if ($row["tp_id"] ==$cu_type) {echo "selected";}?>><?php echo $row["tp_name"];?></option>
    <?php
        }
    }
    ?>
    </select><br>
    <h4>Fallback Options</h4>
    <p1>Fallback Type: </p1><select name="cu_fbtype">
    <option></option>
    <option value="Margin" <?php if ($fbt =="Margin") {echo "selected";}?>>Margin</option>
    <option value="Discount" <?php if ($fbt =="Discount") {echo "selected";}?>>Discount</option>
    </select><br>
    <p1>Fallback Value: </p1><input type="number" step="0.01" value="<?php echo $fbm;?>" required>

</div>
<div class="right">
<p1>Credit Limit: </p1><input type="number" value="<?php echo $limit;?>" required name="cu_limit" step="0.01"><br>
<p1>Pricing Type: </p1><select name="cu_sptp" required>
    <option></option>
    <?php 
    $sql = "SELECT * FROM cupr";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            ?>
    <option value="<?php echo $row["pr_id"];?>" <?php if ($row["pr_id"]==$pricing) {echo "selected";}?>><?php echo $row["pr_name"];?></option> 
    <?php
        }
    } 
    ?>
    
    </select><br>
    <p1>Require a PO: </p1><select name="cu_po">
    <option value="0" <?php if ($po==0) {echo "selected";}?>>No</option>
    <option value="1" <?php if ($po==1) {echo "selected";}?>>Yes</option>
    
    </select><br>
    <p1>Require Job Ref: </p1><select name="cu_jb">
    <option value="0" <?php if ($job==0) {echo "selected";}?>>No</option>
    <option value="1" <?php if ($job==1) {echo "selected";}?>>Yes</option>
    
    </select>

</div>


<?php }}?>
