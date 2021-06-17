<?php 
$prog = "po_supreq";
$mod = "po";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>PO Supplier Maintenance - RANGER 5</title>
    </head>
<body>
    <h1>PO Supplier Maintenance</h1>
<?php if (empty($_GET)) { 
    ?>
    <div class="searchBox" style="width:600px">
    <h1>Find Supplier</h1>
        <div class="center">
            <form action="" method="get">
    <p1>Supplier: </p1><input name="supp" list="sumf" required autocomplete="off" autofocus>
            <datalist id="sumf">
            <?php 
    $sql = "SELECT * FROM sumf";
    $result=$conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            ?>
                <option value="<?php echo $row["su_code"];?>"><?php echo $row["su_name"];?></option>
                <?php
                
        }
    } ?>
            </datalist>
            <br>
            <button class="submit" type="submit">Open Record</button>
            </form></div>
    </div>
    <?php
} else {
     ?>
    <div class="center">
    <form action="" method="post">
        <?php
    $s = $_GET["supp"];
    $sql = "SELECT * FROM sumf s LEFT JOIN posr p ON p.sr_supp = s.su_code AND p.sr_site = $site_cd WHERE s.su_code = $s LIMIT 1";
   
  $result=$conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
         $cont = $row["sr_cont"];
        $t = $row["sr_prtr"];
        ?>
        <?php if (!empty($_GET["m"])) {
             echo "<div class='success'>Record updated successfully.</div>";
         }?>
        <p1>Supplier: </p1><input disabled value="<?php echo $row["su_name"];?>"><br>
        <p1>Email: </p1><input type="email" autocomplete="off" name="sr_email" value="<?php echo $row["sr_email"];?>"><br>
        <p1>E-fax: </p1><input type="tel" autocomplete="off" name="sr_efax" value="<?php echo $row["sr_efax"];?>"><br>
        <p1>Minimum Order Value: </p1><input type="number" step="0.01" name="sr_mov" value="<?php echo $row["sr_mov"];?>"><br>
           <p1>Preferred Transmission: </p1><select name="sr_prtr">
        <?php
$sql = "SELECT * FROM potr WHERE tr_supp = $s";
          $result=$conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) { ?>
        <?php if ($row["tr_edi"] =="1") {?> <option <?php if ($t =="edi") {echo "selected";}?> value="edi">EDI</option><?php }?> 
        <?php if ($row["tr_email"] =="1") {?> <option <?php if ($t =="email") {echo "selected";}?>  value="email">Email</option><?php }?> 
        <?php if ($row["tr_efax"] =="1") {?> <option <?php if ($t =="efax") {echo "selected";}?>  value="efax">E-Fax</option><?php }?> 
        <?php }}?>
        </select><br>
        <p1>Set Default Contract: </p1><select name="sr_cont">
        <option>No Default Contract</option>   
        <?php 
$date = date("Y-m-d");
$sql = "SELECT * FROM sdhd WHERE sd_supp = $s AND sd_startdate > $date AND sd_expdate > $date AND sd_site = $site_cd";
               $result=$conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) { ?>
        <option <?php if ($row["sd_code"] ==$cont) {echo "selected";}?> value="<?php echo $row["sd_code"];?>"><?php echo $row["sd_name"];?></option>
        <?php }}?>
        
        </select>
        <br>
        <button type="submit" class="submit">Update</button>
        <?php }}?>
        
        
        
        </form>
    <?php if (!empty($_POST)) {
        $email = $conn -> real_escape_string($_POST["sr_email"]);
        $fax = $conn -> real_escape_string($_POST["sr_efax"]);
        $transm = $conn -> real_escape_string($_POST["sr_prtr"]);
        $contract = $conn -> real_escape_string($_POST["sr_cont"]);
        $mov = $conn -> real_escape_string($_POST["sr_mov"]);
        $sql = "SELECT * FROM posr WHERE sr_supp = $s AND sr_site = $site_cd";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
        $sql = "UPDATE posr SET sr_email = '$email', sr_efax = '$fax', sr_prtr = '$transm', sr_cont = '$contract', sr_mov = '$mov' WHERE sr_supp = '$s' AND sr_site = $site_cd";
        $conn->query($sql);
                
      echo "<script>location.replace('po_supreq.php?supp=$s&m=1');</script>";
    }} else {
        $sql = "INSERT INTO posr (sr_supp, sr_email, sr_efax, sr_prtr, sr_cont, sr_mov, sr_site) VALUES ('$s','$email','$fax','$transm','$contract','$mov','$site_cd')";
                $conn->query($sql);
            
      echo "<script>location.replace('po_supreq.php?supp=$s&m=1');</script>";
           
            }}  ?>
    </div>
    
    <?php } ?>
    
    </body>
</html>
