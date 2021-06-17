<?php 
$prog = "ar_maint";
$mod = "ar";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>AR Maintenance - RANGER 5</title>
    </head>
<body>
    <h1>Debtor Maintenance</h1>
<?php  if(empty($_GET)) {
    $other = "New Debtor";
    $othLink = "ar_maint.php?action=new";
    $hrefbut = "Open Debtor File";
    $hrefloc = "ar_maint.php";
    include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/search_box/ar_search.php'); }?>
     <?php if (!empty($_GET["debtor"])) {
    ?>
      <div class="bodystrip">
   <a href="ar_maint.php"><button>Find Another Customer</button></a>    <button onclick="othDet()">Other Details</button>
    </div>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
   $cust = $_GET["debtor"];
   
     $sql = "SELECT * FROM cumf c LEFT JOIN srmf s ON c.cu_slsrep = s.sr_salesid INNER JOIN stmf st ON st.st_code = c.cu_site INNER JOIN cutp ON c.cu_type = cutp.tp_id
    INNER JOIN cupr pr ON pr.pr_id = c.cu_sptp INNER JOIN culd ld ON c.cu_ledger = ld.ld_id INNER JOIN cutr tr ON c.cu_terms = tr.tr_id WHERE c.cu_id = '$cust'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
             $salesrep = $row["cu_slsrep"];
    $branch = $row["cu_site"];
            $createtime = $row["cu_timestamp"];
            $time1 = strtotime($createtime);
            $mainttime = $row["cu_mainttime"];
            $time2 = strtotime($mainttime);
            $state1 = $row["cu_state1"];
            $stateb = $row["cu_state2"];
            $ma = $row["cu_addr2"];
            $ms = $row["cu_sub2"];
            $mp = $row["cu_pc2"];
            $p1 = $row["cu_phone1"];
            $p2 = $row["cu_phone2"];
            $abn = $row["cu_abn"];
            $acn = $row["cu_acn"];
            
            ?>
   
    <div class="left">
    <p1>Account: </p1> <input autocomplete="off"  type="text"  autocomplete="off"  name="cu_id" value="<?php echo $row["cu_id"];?>"><br>
    <p1>Account Name: </p1> <input autocomplete="off"  type="text" autocomplete="off"  name="cu_name" value="<?php echo $row["cu_name"];?>"><br>
    <p1>Alias: </p1> <input autocomplete="off"  type="text" autocomplete="off"  name="cu_alias" value="<?php echo $row["cu_alias"];?>"><br><br>
    <p1>Address: </p1> <input autocomplete="off"  type="text" autocomplete="off"  name="cu_addr1" value="<?php echo $row["cu_addr1"];?>"><br>
    <p1>Suburb: </p1> <input autocomplete="off"  type="text" autocomplete="off"  name="cu_sub1" value="<?php echo $row["cu_sub1"];?>"><br>
    <p1>Postcode: </p1> <input autocomplete="off"  type="number" autocomplete="off"  name="cu_pc1" value="<?php echo $row["cu_pc1"];?>"><br>
  <p1>State: </p1><select name="cu_state1">
   
        <?php include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/dropdowns/states_onupd.php');?>
        
        </select><br><br>
        <p1><b>Mailing Address: </b></p1> <input autocomplete="off"  type="text" autocomplete="off"  name="cu_addr2" value="<?php echo $ma;?>"><br>
        <p1><b>Mailing Suburb: </b></p1> <input autocomplete="off"  type="text" autocomplete="off"  name="cu_sub2" value="<?php echo $ms;?>"><br>
        <p1><b>Mailing Postcode: </b></p1> <input autocomplete="off"  type="number" autocomplete="off"  name="cu_pc2" value="<?php echo $mp;?>"><br>
        <p1><b>Mailing State: </b> <select name="cu_state2">
   
        <?php include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/dropdowns/states_onupd2.php');?>
        
        </select>
    </div>
    <div class="right">
        <p1>Phone 1: </p1> <input autocomplete="off"  type="text" autocomplete="off"  name="cu_phone1" value="<?php echo $p1;?>"><br>
        <p1>Phone 2: </p1> <input autocomplete="off"  type="text" autocomplete="off"  name="cu_phone2" value="<?php echo $p2;?>"><br><br>
        <p1>ABN: </p1> <input autocomplete="off"  type="text" autocomplete="off"  name="cu_abn" value="<?php echo $abn;?>"><br>
        <p1>ACN: </p1> <input autocomplete="off"  type="text" autocomplete="off"  name="cu_acn" value="<?php echo $acn;?>"><br>
        <p1>Sales Rep: </p1> <select name="cu_slsrep">
        <?php  include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/dropdowns/sales_reps.php');?>
        
        </select><br>
        <p1>Domicilled Branch: </p1> 
        <select name="st_code">
        <?php  include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/dropdowns/sites.php');?>
        
        </select>
        <?php }}   include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
   $cust = $_GET["debtor"];
   
     $sql = "SELECT * FROM cumf c LEFT JOIN srmf s ON c.cu_slsrep = s.sr_salesid INNER JOIN stmf st ON st.st_code = c.cu_site INNER JOIN cutp ON c.cu_type = cutp.tp_id
    INNER JOIN cupr pr ON pr.pr_id = c.cu_sptp INNER JOIN culd ld ON c.cu_ledger = ld.ld_id INNER JOIN cutr tr ON c.cu_terms = tr.tr_id WHERE c.cu_id = '$cust'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
             $salesrep = $row["cu_slsrep"];
    $branch = $row["cu_site"];
            $createtime = $row["cu_timestamp"];
            $time1 = strtotime($createtime);
            $mainttime = $row["cu_mainttime"];
            $time2 = strtotime($mainttime);
            $terms = $row["cu_terms"];
            $custtype = $row["cu_type"];
            $priceType = $row["cu_sptp"];
            $margin = $row["cu_fallback"];
            $po = $row["cu_po"];
            $jb = $row["cu_jb"];
            $ledger = $row["cu_ledger"];
            ?> 
        <br>
        <p1>BPAY Reference: </p1> <input autocomplete="off"  disabled type="text" autocomplete="off"  name="cu_bpay" value="<?php echo $row["cu_bpay"];?>"><br><br>
        <p1>Create Date: </p1><input autocomplete="off"  disabled value="<?php echo date("d/m/Y g:ia", $time1)  ?>"> <br>
        <p1>Create User: </p1><input autocomplete="off"  disabled value="<?php echo $row["cu_stampuser"]?>"> <br>
        <p1>Maintenance Date: </p1><input autocomplete="off"  disabled value="<?php if ($time2 !==$time1) { echo date("d/m/Y g:ia", $time2) ;} ?>"> <br>
        <p1>Maintenance User: </p1><input autocomplete="off"  disabled value="<?php echo $row["cu_maintuser"] ?>"> <br>
    
    </div>
    <div class="searchBox" id="otherDetails" style="display:none">
      <button type="button" class="exit" onclick="othDet()">X</button>
    <h1>Other Details</h1>
    <div class="left">
        <p1>Customer Type: </p1> <select name="cu_type">
         <?php  include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/dropdowns/cust_type.php');?>
            
        
        </select><br>
        <p1>Pricing Type: </p1><select name="cu_sptp">
         <?php  include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/dropdowns/cust_price.php');?>
            
        </select><br>
        <p1>Fallback Margin %: </p1> <input autocomplete="off"  type="number" name="cu_fallback"  value="<?php echo $margin;?>"><br>
        
        
        </div>
        <div class="right">
            <p1>Mandatory PO: </p1><select name="cu_po"  required>
            <option></option>
            <option value="0" <?php if ($po ==0) {echo "selected";}?>>No</option>
            <option value="1" <?php if ($po ==1) {echo "selected";}?>>Yes</option>
            </select><br>
               <p1>Mandatory Job: </p1><select name="cu_job"  required>
            <option></option>
            <option value="0" <?php if ($jb ==0) {echo "selected";}?>>No</option>
            <option value="1" <?php if ($jb ==1) {echo "selected";}?>>Yes</option>
            </select><br><br>
         <p1>Terms: </p1> <select name="cu_terms">
             <?php  include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/dropdowns/terms.php');?>
            
            </select><br>
         <p1>Ledger: </p1> <select name="cu_ledger">
             <?php  include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/dropdowns/ledger.php');?>
            
            </select> <br>
        
        
        </div>
    
    </div>
      
    
    
    
    
    
    
    
    
    
    
    
    
    
  <?php   
}}} elseif ($_GET["action"] =='new') {
    ?>
    
         <div class="bodystrip">
   <a href="ar_deb.php"><button>Find Another Customer</button></a>    <button onclick="othDet()">Other Details</button>
    </div>
    <div class="left">
    <p1>Account Number: </p1> <input <?php if ($allowOverride ==0) {echo "disabled";}?> id="cu_cust" autocomplete="off" value="<?php
        $sql = "SELECT cu_id FROM cumf ORDER BY cu_id DESC LIMIT 1";
        $result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo $row["cu_id"]+1;
    }
}
        ?>" type="text" autocomplete="off" required name="cu_id" value="<?php echo $row["cu_id"];?>"><br>
    <p1>Account Name: </p1> <input onkeyup="bpay()" autocomplete="off" autofocus type="text" autocomplete="off"  name="cu_name" required><br>
    <p1>Alias: </p1> <input autocomplete="off"  type="text" autocomplete="off"  name="cu_alias" required><br><br>
    <p1>Address: </p1> <input id="addr1" autocomplete="off"  type="text" autocomplete="off"  name="cu_addr1" required><br>
    <p1>Suburb: </p1> <input id="sub1" autocomplete="off"  type="text" autocomplete="off"  name="cu_sub1"required><br>
    <p1>Postcode: </p1> <input id="pc1" autocomplete="off"  type="number" autocomplete="off"  name="cu_pc1" required><br>
    <p1>State: </p1> <input id="state1" autocomplete="off"  type="text" autocomplete="off"  name="cu_state1" required><br><p1>Same Address?: </p1><input id="sameAddr" value="1" onclick="sameAddr()" type="checkbox"><br>
        <p1><b>Mailing Address: </b></p1> <input id="addr2" autocomplete="off"  type="text" autocomplete="off"  name="cu_addr2" required><br>
        <p1><b>Mailing Suburb: </b></p1> <input id="sub2" autocomplete="off"  type="text" autocomplete="off"  name="cu_sub2" required><br>
        <p1><b>Mailing Postcode: </b></p1> <input id="pc2" autocomplete="off"  type="number" autocomplete="off"  name="cu_pc2" required><br>
        <p1><b>Mailing State: </b></p1> <input id="state2" autocomplete="off"  type="text" autocomplete="off"  name="cu_state2" required><br>
    </div>
    <div class="right">
        <p1>Phone 1: </p1> <input autocomplete="off"  type="text" autocomplete="off"  name="cu_phone1" required><br>
        <p1>Phone 2: </p1> <input autocomplete="off"  type="text" autocomplete="off"  name="cu_phone2"  ><br><br>
        <p1>ABN: </p1> <input autocomplete="off"  type="text" autocomplete="off"  name="cu_abn" required><br>
        <p1>ACN: </p1> <input autocomplete="off"  type="text" autocomplete="off"  name="cu_acn" required><br>
        <p1>Sales Rep: </p1> <input list="srmf" name="cu_slsrep" required>
        <datalist id="srmf">
        <?php $sql = "SELECT * FROM srmf";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            ?>
            <option value="<?php echo $row["sr_salesid"]?>"><?php echo $row["sr_name"];?></option>
        <?php
        }
    } ?>
        
                </datalist><br>
        <p1>Domicilled Branch: </p1> <input list="stmf" required name="cu_site" autocomplete="off">
        <datalist id="stmf">
        <?php
    $sql = "SELECT * FROM stmf";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            ?>
            <option value="<?php echo $row["st_code"];?>"><?php echo $row["st_name"];?></option>    
            <?php
        }
    } ?>
        
        
        </datalist><br>
        <p1>BPAY Reference: </p1> <input autocomplete="off"  type="text" autocomplete="off"  name="cu_bpay" disabled id="bpay"><br><br>
    
    </div>
    <div class="searchBox" id="otherDetails" style="display:none">
      <button type="button" class="exit" onclick="othDet()">X</button>
    <h1>Other Details</h1>
    <div class="left">
        <p1>Customer Type: </p1> <input autocomplete="off"  type="text" name="cu_type"  required><br>
        <p1>Pricing Type: </p1> <input autocomplete="off"  type="text" name="pr_name"  required><br>
        <p1>Fallback Margin %: </p1> <input autocomplete="off"  type="number" name="cu_fallback"  required><br>
        
        
        </div>
        <div class="right">
            <p1>Mandatory PO: </p1><select name="cu_po"  required>
            <option></option>
            <option value="0" >No</option>
            <option value="1" >Yes</option>
            </select><br>
               <p1>Mandatory Job: </p1><select name="cu_job"  required>
            <option></option>
            <option value="0" >No</option>
            <option value="1" >Yes</option>
            </select><br><br>
         <p1>Terms: </p1> <input autocomplete="off"  type="text" name="cu_terms"  required><br>
         <p1>Ledger: </p1> <input autocomplete="off"  type="text" name="cu_ledger"  required><br>
        
        
        </div>
    
    </div>
    
    <?php
}
    ?>
        <script>
    function othDet() {
        var x = document.getElementById("otherDetails");
        if (x.style.display ==="none") {
            x.style.display = "Block";
        }
        else {
            x.style.display ="none";
        }}
    
            
            function state() {
                var y = document.getElementById("st1hid");
                var z = document.getElementById("st1");
  if (y.style.display ==="none") {
      y.style.display = "block";
      z.style.display ="none";
  }
                else {
                    y.style.display = "none";
                    z.style.display = "block";
                
                }
            }
    function sameAddr() {
        var a = document.getElementById("addr1");
        var b = document.getElementById("sub1");
        var c = document.getElementById("pc1");
        var d = document.getElementById("state1");
        var w = document.getElementById("addr2");
        var x = document.getElementById("sub2");
        var y = document.getElementById("pc2");
        var z = document.getElementById("state2");
        var e = document.getElementById("sameAddr");
        if (e.value ==1) {
            w.value = a.value;
            x.value = b.value;
            y.value = c.value;
            z.value = d.value;
        } else {
            w.value = "b";
            x.value = "";
            y.value = "";
            z.value = "";
        }
    }
            
         window.onload = function bpay() {
                var x = document.getElementById("bpay");
                var y = document.getElementById("cu_cust");
                x.value = y.value;
            }
            
    </script>
    </body>
</html>
