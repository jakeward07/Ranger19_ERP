<?php 
$prog = "ap_enq";
$mod = "ap";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>AP Enquiry - RANGER 5</title>
    </head>
<body>
<h1>Accounts Payable General Enquiry</h1>
     <?php if (empty($_GET)) { ?>
<div class="searchBox" style="width:600px">
    <h3>Search Dialogue</h3>
        <?php if (empty($_POST)) {
    ?>
        <form action="" method="post">
            <div class="center">
    <p1>Supplier Code: </p1><input type="number" autocomplete="off" name="su_code" autofocus><br>
    <p1>Supplier Name: </p1><input type="text" autocomplete="off" name="su_name" autofocus><br>
    <p1>Supplier Alias: </p1><input type="text" autocomplete="off" name="su_alias" autofocus><br>
    <p1>Supplier ABN: </p1><input type="text" autocomplete="off" name="su_abn" autofocus><br>
    <button type="submit" class="submit">Search</button>
            </div>
        </form>

      <?php } if (!empty($_POST)) { ?>
    <a href="ap_enq.php"><button type="button">Back</button></a>
    <table style="width:100%; text-align:center">
        <tr>
        <th>Supplier Code</th>
        <th>Supplier Name</th>
        <th>Action</th>
        
        </tr>
      <?php 
    $ConditionArray = array();
  $sc = $_POST["su_code"];
$sn = $_POST["su_name"];
$sa = $_POST["su_alias"];
$sab = $_POST["su_abn"];
    if ($sc != '') $ConditionArray[] = "su_code = '$sc'";
    if ($sn != '') $ConditionArray[] = "su_name LIKE '%$sn%'";
    if ($sa != '') $ConditionArray[] = "su_alias LIKE '%$sa%'";
    if ($sab != '') $ConditionArray[] = "su_abn LIKE '%$sab%'";


if (count($ConditionArray) > 0)
{
    $sql = "
    SELECT *
    FROM sumf
    WHERE ".implode(' AND ', $ConditionArray);
}

$result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row=$result->fetch_assoc()) {
                                   
                                   ?>
        <tr>
        <td><?php echo $row["su_code"];?></td>
        <td><?php echo $row["su_name"];?></td>
            <td><a href="ap_enq.php?q=<?php echo $row["su_code"];?>">View</a></td>
        
        </tr>
        <?php }}?>
        </table>
    
    
    <?php } ?>
    
      
    </div>
    <?php } if (!empty($_GET)) { 
    $q = $_GET["q"];
    $sql = "SELECT * FROM sumf WHERE su_code = '$q' LIMIT 2";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            ?>
    
    <div class="left">
    <p1>Supplier Code: </p1><input disabled name="su_code" autocomplete="off" id="su_code" value="<?php echo $row["su_code"];?>"><br>
    <p1>Supplier Name: </p1><input disabled name="su_name" autocomplete="off" id="su_name" value="<?php echo $row["su_name"];?>"><br>
    <p1>Supplier Alias: </p1><input disabled name="su_alias" autocomplete="off" id="su_alias" value="<?php echo $row["su_alias"];?>"><br><br>
    <p1>Address 1: </p1><input disabled name="su_addr1" autocomplete="off" id="su_addr1" value="<?php echo $row["su_addr1"];?>"><br>
    <p1>Suburb: </p1><input disabled name="su_sub1" autocomplete="off" id="su_sub1" value="<?php echo $row["su_sub1"];?>"><br>
    <p1>State: </p1><input disabled name="su_state1" autocomplete="off" id="su_state1" value="<?php echo $row["su_state1"];?>"><br>
    <p1>Postcode: </p1><input disabled name="su_pc1" autocomplete="off" id="su_pc1" value="<?php echo $row["su_pc1"];?>"><br>
<p1>Address 2: </p1><input disabled name="su_addr2" autocomplete="off" id="su_addr2" value="<?php echo $row["su_addr2"];?>"><br>
    <p1>Suburb: </p1><input disabled name="su_sub2" autocomplete="off" id="su_sub2" value="<?php echo $row["su_sub2"];?>"><br>
    <p1>State: </p1><input disabled name="su_state2" autocomplete="off" id="su_state2" value="<?php echo $row["su_state2"];?>"><br>
    <p1>Postcode: </p1><input disabled name="su_pc2" autocomplete="off" id="su_pc2" value="<?php echo $row["su_pc2"];?>"><br>
    
    
    
    
    </div>
    
 <div class="right">
    <p1>ABN: </p1><input disabled name="su_abn" autocomplete="off" id="su_abn" value="<?php echo $row["su_abn"];?>"><br>
    <p1>ACN: </p1><input disabled name="su_acn" autocomplete="off" id="su_acn" value="<?php echo $row["su_acn"];?>"><br><br>
    <p1>Default Contract: </p1><input disabled name="su_contract" autocomplete="off" id="su_contract" value="<?php echo $row["su_contract"];?>"><br>
    <p1>Terms Code: </p1><input disabled name="su_termscd" autocomplete="off" id="su_termscd" value="<?php echo $row["su_termscd"];?>"><br>
    
    
    
    
    
    
    </div>   
    
    
    
    
    
    
    
    
    
    <?php
            
        }
    }
    
    ?>
    
    
    
    
    
    
    
    
    
    
    
    
    <?php } ?>
    
    
  
    
    
    </body>
</html>
