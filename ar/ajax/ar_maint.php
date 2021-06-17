<?php
$q = $_GET['q'];
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}

mysqli_select_db($conn,"cumf");

$sql="SELECT * FROM cumf WHERE cu_id = '$q'"; 

$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)) {

if ($result->num_rows > 0) {
   $alias = $row["cu_alias"];
    $addr1 = $row["cu_addr1"];
    $sub1 = $row["cu_sub1"];
    $postcode1 = $row["cu_pc1"];
    $state1 = $row["cu_state1"];
     $addr2 = $row["cu_addr2"];
    $sub2 = $row["cu_sub2"];
    $postcode2 = $row["cu_pc2"];
    $state2 = $row["cu_state2"];
    $phone1 = $row["cu_phone1"];
    $phone2 = $row["cu_phone2"];
    $bpay = $row["cu_bpay"];
    $createuser = $row["cu_stampuser"];
    $maintuser = $row["cu_maintuser"];
    $d1 = strtotime($row["cu_timestamp"]);
$date = date('d/m/Y g:ia', $d1);
    $d2 = strtotime($row["cu_mainttime"]);
$date2 = date('d/m/Y g:ia', $d2);
    $abn = $row["cu_abn"];
    $acn = $row["cu_acn"];
?><br>
<div class="bodystrip">
<button onclick="fetchCust()">Main Profile</button>
<button onclick="fetchOe()">Order Entry Options</button>

</div>

<div class="left">
<p1>Customer Name: </p1><input name="cu_name" value="<?php echo $row["cu_name"];?>" required type="text" autocomplete="off"><br>
<p1>Alias: </p1><input name="cu_alias" value="<?php echo $alias?>" required type="text" autocomplete="off"><br>
<p1>Address 1: </p1><input id="addr1" name="cu_addr1" value="<?php echo $addr1;?>" required type="text" autocomplete="off"><br>
<p1>Suburb: </p1><input id="sub1" name="cu_sub1" value="<?php echo $sub1;?>" required type="text" autocomplete="off"><br>
<p1>Postcode: </p1><input id="pc1" name="cu_pc1" value="<?php echo $postcode1;?>" required type="tel" maxlength="4" autocomplete="off"><br>
<p1>State: </p1><select name="cu_state1">
    <?php 
    $sql = "SELECT * FROM stat";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {?>
        <option value="<?php $row["stt_abrv"];?>" <?php if ($row["stt_abrv"] ==$state1) {echo "selected";}?>><?php echo $row["stt_name"];?></option>
            <?php
        }
    }?>
    
    </select><br>
    <p1>Address 2: </p1><input id="addr2" name="cu_addr2" value="<?php echo $addr2;?>" required type="text" autocomplete="off"><br>
<p1>Suburb: </p1><input id="sub2" name="cu_sub2" value="<?php echo $sub2;?>" required type="text" autocomplete="off"><br>
<p1>Postcode: </p2><input id="pc2" name="cu_pc2" value="<?php echo $postcode2;?>" required type="tel" maxlength="4" autocomplete="off"><br>
<p1>State: </p1><select name="cu_state2">
    <?php 
    $sql = "SELECT * FROM stat";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) { ?>
        <option value="<?php $row["stt_abrv"];?>" <?php if ($row["stt_abrv"] ==$state2) {echo "selected";}?>><?php echo $row["stt_name"];?></option>
            <?php
        }
    }?>
    
    </select><br>

</div>
<div class="right">
 <p1>Phone 1: </p1><input name="cu_phone1" value="<?php echo $phone1;?>" type="text" autocomplete="off"><br>
 <p1>Phone 2: </p1><input name="cu_phone2" value="<?php echo $phone2;?>" type="text" autocomplete="off"><br>
<p1>ABN: </p1><input maxlength="14" id="abn" name="cu_abn" value="<?php echo $abn;?>" autocomplete="off" type="text"><br>
<p1>ACN: </p1><input maxlength="11" id="acn" name="cu_acn" value="<?php echo $acn;?>" autocomplete="off" type="text"><br>
 <p1>BPAY Reference: </p1><input value="<?php echo $bpay;?>" type="text" disabled autocomplete="off"><br>
<p1>Create User: </p1><input value="<?php echo $createuser?>" disabled><br>
<p1>Create Date: </p1><input value="<?php echo $date?>" disabled><br>
<?php if (!empty($maintuser)) {
        ?>
   <p1>Maintenance User: </p1><input value="<?php echo $maintuser?>" disabled><br>
<p1>Maintenance Date: </p1><input value="<?php echo $date2?>" disabled><br> 
    <?php
    } ?>
</div>


<?php }}?>
