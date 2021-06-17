<?php 
$prog = "ap_maint";
$mod = "ap";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>AP Maintenance - RANGER 5</title>
    </head>
<body>
<h1>Accounts Payable Maintenance</h1>
     <?php if (empty($_GET)) {?>
    <div class="searchBox" style="width:600px">
        <h2>Supplier Search</h2>
    <form action="" method="get">
        <div class="center">
        <p1>Supplier Code: </p1><input onchange="this.form.submit()" name="s" autofocus autocomplete="off" list="sumf" required>
            <datalist id="sumf">
            <?php
                              $sql = "SELECT * FROM sumf";
                              $result = $conn->query($sql);
                              if ($result->num_rows > 0) {
                                  while($row = $result->fetch_assoc()) {
                                      ?>
                <option value="<?php echo $row["su_code"];?>"><?php echo $row["su_name"];?></option>
                <?php
                                  }
                              }
            ?>
            </datalist>
        <br>
            <button type="submit" class="submit">Search &rarr;</button>
            <br><a href="ap_maint.php?s=new"><button type="button" class="submit">New Supplier &rarr;</button></a>
        </div>
        
        </form>
    </div>
    
    <?php } if (!empty($_GET)) { 
    $s = $_GET["s"];
     $sql = "SELECT * FROM sumf s WHERE s.su_code = $s";
                              $result = $conn->query($sql);
                              if ($result->num_rows > 0) {
                                  while($row = $result->fetch_assoc()) {
                                      $state1 = $row["su_state1"];
                                      $state2 = $row["su_state2"];
                                      $addr2 = $row["su_addr2"];
                                      $sub2 = $row["su_sub2"];
                                      $pc2 = $row["su_pc2"];
                                      $abn = $row["su_abn"];
                                      $acn = $row["su_acn"];
                                      $terms = $row["su_termscd"];
                                      $apemail = $row["su_apemail"];
                                      $trans = $row["su_trans"];
                                      $fax = $row["su_fax"];
                                      $phone = $row["su_phone"];
                                      $status = $row["su_status"];
                                      ?>
    <form action="" method="post">
    <?php if (!empty($_GET["success"])) {
                                          echo "<div class='success'>Record updated successfully.</div>";
                                      } ?>
    <div class="left">
    <p1>Supplier Name: </p1><input name="su_name" required autocomplete="off" value="<?php echo $row["su_name"];?>"><br>
    <p1>Supplier Alias: </p1><input name="su_alias" required autocomplete="off" value="<?php echo $row["su_alias"];?>"><br>
    <p1>Address 1: </p1><input name="su_addr1" required autocomplete="off" value="<?php echo $row["su_addr1"];?>"><br>
    <p1>Suburb 1: </p1><input name="su_sub1" required autocomplete="off" value="<?php echo $row["su_sub1"];?>"><br>
    <p1>Postcode 1: </p1><input name="su_pc1" required autocomplete="off" value="<?php echo $row["su_pc1"];?>" type="tel" maxlength="4"><br>
    <p1>State 1: </p1><select name="su_state1">
      <?php
                                       $sql = "SELECT * FROM stat";
                              $result = $conn->query($sql);
                              if ($result->num_rows > 0) {
                                  while($row = $result->fetch_assoc()) {
?>
        <option <?php if ($row["stt_abrv"] ==$state1) {echo "selected";}?> value="<?php echo $row["stt_abrv"];?>"><?php echo $row["stt_name"];?></option>
        <?php
                                  }}?>
        
        </select>
        <br><br>
        
          <p2>Address 2: </p1><input name="su_addr2" required autocomplete="off" value="<?php echo $addr2;?>"><br>
    <p1>Suburb 2: </p1><input name="su_sub2" required autocomplete="off" value="<?php echo $sub2;?>"><br>
    <p1>Postcode 2: </p1><input name="su_pc2" required autocomplete="off" value="<?php echo $pc2;?>" type="tel" maxlength="4"><br>
    <p1>State 2: </p1><select name="su_state2">
      <?php
                                       $sql = "SELECT * FROM stat";
                              $result = $conn->query($sql);
                              if ($result->num_rows > 0) {
                                  while($row = $result->fetch_assoc()) {
?>
        <option <?php if ($row["stt_abrv"] ==$state2) {echo "selected";}?> value="<?php echo $row["stt_abrv"];?>"><?php echo $row["stt_name"];?></option>
        <?php
                                  }}?>
        
        </select>
    
    </div>
    <div class="right">
    <p1>ABN: </p1><input name="su_abn" required autocomplete="off" value="<?php echo $abn;?>"><br>
    <p1>ACN: </p1><input name="su_acn" required autocomplete="off" value="<?php echo $acn;?>"><br>
    <p1>Phone: </p1><input name="su_phone" type="tel" required autocomplete="off" value="<?php echo $phone;?>"><br>
    <p1>Fax: </p1><input name="su_fax" type="tel" autocomplete="off" value="<?php echo $fax;?>"><br>
    <p1>Payment Terms: </p1><select name="su_terms">
 <?php
$sql = "SELECT * FROM cutr";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        ?>
        <option <?php if ($row["tr_id"] ==$terms) {echo "selected";}?> value="<?php echo $row["tr_id"];?>"><?php echo $row["tr_name"];?></option>     
        <?php
    }
} ?>
        
        </select>
    <br>
        <span title="Emailed and E-fax settings can be configured by each site in po_supreq"><p1>Order Transmission: </p1><select onchange="javascript: if (this.value =='edi') {alert('To set up EDI settings, please goto ei_table (ei101).');}" name="su_trans">
        <option <?php if ($trans == "print") {echo "selected";}?> value="print">Print Orders</option>
        <option <?php if ($trans == "EDI") {echo "selected";}?>  value="edi">EDI</option>
        <option <?php if ($trans == "email") {echo "selected";}?>  value="email">Email</option>
        <option <?php if ($trans == "efax") {echo "selected";}?>  value="efax">E-fax</option>
        
            </select></span>
            <br>
        <p1>AP Email: </p1><input autocomplete="off" required name="su_apemail" type="email" value="<?php echo $apemail;?>"><br>
         <p1>Supplier Active: </p1><select name="su_status">
          <option value="1" <?php if ($status ==1) {echo "selected";}?>>Yes</option>
        <option value="2" <?php if ($status ==2) {echo "selected";}?>>No</option>
        </select>
        <h4>Modes of Transmission</h4>
        <p1>Select Modes for PO Transmission</p1><br>
        <?php 
$sql = "SELECT * FROM potr WHERE tr_supp = $s";
$result = $conn->query($sql);
                                      if ($result->num_rows > 0){
                                          while($row = $result->fetch_assoc()) {
$tredi = $row["tr_edi"];
$tremail = $row["tr_email"];
$trefax = $row["tr_efax"];

                                                                                
                                              ?>
       <label for="ediT">EDI: </label><input <?php if ($tredi ==1) {echo "checked";}?> id="ediT" type="checkbox" name="tr_edi" value="1"><br>
       <label for="emailT">Email: </label><input <?php if ($tremail ==1) {echo "checked";}?> id="emailT" type="checkbox" name="tr_email" value="1"><br>
       <label for="efaxT">E-Fax: </label><input <?php if ($trefax ==1) {echo "checked";}?> id="efaxT" type="checkbox" name="tr_efax" value="1"><br>
     
        <?php }}?>
        <br>
        <button type="submit" class="submit">Update Masterfile</button>
        
        </div></form>
   
    <?php }} elseif ($_GET["s"]=="new") { 
    ?> <form action="" method="post">
    <div class="left">
   
    <p1>Supplier Name: </p1><input type="text" name="su_name" required autocomplete="off" autofocus><br>
    <p1>Supplier Alias: </p1><input type="text" name="su_alias" required autocomplete="off"><br>
    <p1>Address 1: </p1><input id="addr1" type="text" name="su_addr1" required autocomplete="off"><br>
    <p1>Suburb 1: </p1><input id="sub1" type="text" name="su_sub1" required autocomplete="off"><br>
    <p1>Postcode 1: </p1><input id="pc1" type="tel" maxlength="4" name="su_pc1" required autocomplete="off"><br>
   <p1>State 1: </p1><select id="state1" required name="su_state1"><option></option>
      <?php
                                       $sql = "SELECT * FROM stat";
                              $result = $conn->query($sql);
                              if ($result->num_rows > 0) {
                                  while($row = $result->fetch_assoc()) {
?>
        <option value="<?php echo $row["stt_abrv"];?>"><?php echo $row["stt_name"];?></option>
        <?php
                                  }}?>
        
        </select>
        <br>
        <label for="same">Same Address? :</label><input value="1" onchange="sameAddr()" id="same" type="checkbox"><br>
          <p1>Address 2: </p1><input id="addr2" type="text" name="su_addr2" required autocomplete="off"><br>
    <p1>Suburb 2: </p1><input id="sub2" type="text" name="su_sub2" required autocomplete="off"><br>
    <p1>Postcode 2: </p1><input id="pc2" type="tel" maxlength="4" name="su_pc2" required autocomplete="off"><br>
   <p1>State 2: </p1><select id="state2" required name="su_state2">
        <option></option>
      <?php
                                       $sql = "SELECT * FROM stat";
                              $result = $conn->query($sql);
                              if ($result->num_rows > 0) {
                                  while($row = $result->fetch_assoc()) {
?>
        <option value="<?php echo $row["stt_abrv"];?>"><?php echo $row["stt_name"];?></option>
        <?php
                                  }}?>
        
        </select>
    </div>
    <div class="right">
    <p1>ABN: </p1><input id="abn" type="tel" maxlength="14" name="su_abn" autocomplete="off" required><br>
    <p1>ACN: </p1><input id="acn" type="tel" maxlength="11" name="su_acn" autocomplete="off" required><br>
         <p1>Phone: </p1><input name="su_phone" type="tel" required autocomplete="off"><br>
    <p1>Fax: </p1><input name="su_fax" type="tel" autocomplete="off"><br>
     <p1>Payment Terms: </p1><select required name="su_terms">
        <option></option>
 <?php
$sql = "SELECT * FROM cutr";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        ?>
        <option value="<?php echo $row["tr_id"];?>"><?php echo $row["tr_name"];?></option>     
        <?php
    }
} ?>
        
        </select>
    <br>
        <span title="Emailed and E-fax settings can be configured by each site in po_supreq"><p1>Order Transmission: </p1><select required onchange="javascript: if (this.value =='edi') {alert('To set up EDI settings, please goto ei_table (ei101).');}" name="su_trans">
        <option></option>
            <option value="print">Print Orders</option>
        <option value="edi">EDI</option>
        <option value="email">Email</option>
        <option value="efax">E-fax</option>
        
            </select></span>
            <br>
        <p1>AP Email: </p1><input autocomplete="off" required name="su_apemail" type="email"><br>
        <h4>Modes of Transmission</h4>
        <p1>Select Modes for PO Transmission</p1><br>
       <label for="ediT">EDI: </label><input id="ediT" type="checkbox" name="tr_edi" value="1"><br>
       <label for="emailT">Email: </label><input id="emailT" type="checkbox" name="tr_email" value="1"><br>
       <label for="efaxT">E-Fax: </label><input id="efaxT" type="checkbox" name="tr_efax" value="1"><br>
    
        <br>
        <button type="submit" class="submit">Create Supplier</button>
        
    
    </div>
    
    </form>
    
    <?php
    
}} ?>
     <?php if (!empty($_POST)) {
//Sanitise Data
    $pname = $conn -> real_escape_string($_POST["su_name"]);
    $palias = $conn -> real_escape_string($_POST["su_alias"]);
    $paddr1 = $conn -> real_escape_string($_POST["su_addr1"]);
    $psub1 = $conn -> real_escape_string($_POST["su_sub1"]);
    $ppc1 = $conn -> real_escape_string($_POST["su_pc1"]);
    $pstate1 = $conn -> real_escape_string($_POST["su_state1"]);
    $paddr2 = $conn -> real_escape_string($_POST["su_addr2"]);
    $psub2 = $conn -> real_escape_string($_POST["su_sub2"]);
    $ppc2 = $conn -> real_escape_string($_POST["su_pc2"]);
    $pstate2 = $conn -> real_escape_string($_POST["su_state2"]);
    $pabn = $conn -> real_escape_string($_POST["su_abn"]);
    $pacn = $conn -> real_escape_string($_POST["su_acn"]);
    $pterms = $conn -> real_escape_string($_POST["su_terms"]);
    $ptrans = $conn -> real_escape_string($_POST["su_trans"]);
    $papemail = $conn -> real_escape_string($_POST["su_apemail"]);
    $pedi = $conn -> real_escape_string($_POST["tr_edi"]);
    $pemail = $conn -> real_escape_string($_POST["tr_email"]);
    $pefax = $conn -> real_escape_string($_POST["tr_efax"]);
    $pphone = $conn -> real_escape_string($_POST["su_phone"]);
    $pfax = $conn -> real_escape_string($_POST["su_fax"]);
    $pstatus = $conn -> real_escape_string($_POST["su_status"]);

//Verfiy if record update or new record
if ($_GET["s"] =="new") {
    //New record
    //Create sumf record
    $sql = "INSERT INTO sumf (su_name, su_alias, su_trans, su_addr1, su_sub1, su_pc1, su_state1, su_addr2, su_sub2, su_pc2, su_state2, su_apemail, su_termscd, su_abn, su_acn, su_phone, su_fax, su_stampuser) VALUES ('$pname','$palias','$ptrans','$paddr1','$psub1','$ppc1','$pstate1','$paddr2','$psub2','$ppc2','$pstate2','$papemail','$pterms','$pabn','$pacn','$pphone','$pfax','$usernm')";
    $conn->query($sql);
    //Create potr record
    $sql2 = "SELECT su_code FROM sumf WHERE su_stampuser = '$usernm' ORDER BY su_code DESC LIMIT 1";
    $result = $conn->query($sql2);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $supplier_code = $row["su_code"];
            $sql = "INSERT INTO potr (tr_supp, tr_edi, tr_email, tr_efax) VALUES ('$supplier_code','$pedi','$pemail','$pefax')";
            $conn->query($sql);
            $sql2 = "INSERT INTO impc (pc_code, pc_name, pc_vendor, pc_stampuser) VALUES ('XXX9999','Universal Price Class','$supplier_code','$usernm')";
            $conn->query($sql2);
        }
    } 
}
else {
    //Update sumf table
    $sql = "UPDATE sumf SET su_name = '$pname', su_alias = '$palias', su_addr1 = '$paddr1', su_sub1 = '$psub1', su_pc1 = '$ppc1', su_state1 = '$pstate1', su_addr2 = '$paddr2', su_sub2 = '$psub2', su_pc2 = '$ppc2', su_state2 = '$pstate2', su_abn = '$pabn', su_acn = '$pacn', su_termscd = '$pterms', su_trans = '$ptrans', su_apemail = '$papemail', su_status = '$pstatus', su_phone = '$pphone', su_fax = '$pfax' WHERE su_code = $s";
    $conn->query($sql);
    echo $conn->error;
 $sql2 = "UPDATE potr SET tr_edi = '$pedi', tr_email = '$pemail', tr_efax = '$pefax' WHERE tr_supp = $s";
    $conn->query($sql2);
     echo "<script>location.replace('ap_maint.php?s=$s&success=true');</script>";
}
echo $conn->error;
                                        
                                          
                                      }
                                      ?>
    <script>
    function sameAddr() {
        var a1 = document.getElementById("addr1");
        var s1 = document.getElementById("sub1");
        var st1 = document.getElementById("state1");
        var pc1 = document.getElementById("pc1");
        var a2 = document.getElementById("addr2");
        var s2 = document.getElementById("sub2");
        var st2 = document.getElementById("state2");
        var pc2 = document.getElementById("pc2"); 
        var x = document.getElementById("same");
        if (x.checked) {
          a2.value = a1.value;
            s2.value = s1.value;
            st2.value = st1.value;
            pc2.value = pc1.value;
        }
        else {
            a2.value = "";
            s2.value = "";
            st2.value = "";
            pc2.value = "";
        }
        
    }
        addEventListener("keyup", spaceAbn);
        function spaceAbn() {
            var x = document.getElementById("abn");
            if (x.value !=="") {
                if (x.value.length ==2) {
                    x.value = x.value+" ";
                }
                if (x.value.length ==6) {
                    x.value = x.value+" ";
                }
                if (x.value.length ==10) {
                    x.value = x.value+" ";
                   
                }
                
            }
        }
        addEventListener("keyup", spaceAcn);
        function spaceAcn() {
            var x = document.getElementById("acn");
            if (x.value !=="") {
                if (x.value.length ==3) {
                    x.value = x.value+" ";
                }
                if (x.value.length ==7) {
                    x.value = x.value+" ";
                }
            }
        }
    
    </script>
    </body>
</html>
