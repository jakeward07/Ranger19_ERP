<?php 
$prog = "ar_deb";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>Debtor Enquiry - RANGER 5</title>
    </head>
<body>
<h1>Debtor Enquiry</h1>
  <?php if (empty($_GET)) {
    $hrefloc="ar_deb.php";
    $hrefbut="View Customer";
    include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/search_box/ar_search.php'); }?>   
    <?php if (!empty($_GET)) { 
    $cust = $_GET["debtor"];
    include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
    $sql = "SELECT * FROM cumf c LEFT JOIN srmf s ON c.cu_slsrep = s.sr_salesid INNER JOIN stmf st ON st.st_code = c.cu_site INNER JOIN cutp ON c.cu_type = cutp.tp_id
    INNER JOIN cupr pr ON pr.pr_id = c.cu_sptp INNER JOIN culd ld ON c.cu_ledger = ld.ld_id INNER JOIN cutr tr ON c.cu_terms = tr.tr_id WHERE c.cu_id = '$cust'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
        $create = $row["cu_timestamp"];
        $maint = $row["cu_mainttime"];
        $time1 = strtotime($create);
        $time2 = strtotime($maint);
  
    
    ?>
    <div class="bodystrip">
   <a href="ar_deb.php"><button>Find Another Customer</button></a>    <button onclick="othDet()">Other Details</button>
    </div>
    <div class="left">
    <p1>Account: </p1> <input type="text" autocomplete="off" disabled name="cu_id" value="<?php echo $row["cu_id"];?>"><br>
    <p1>Account Name: </p1> <input type="text" autocomplete="off" disabled name="cu_name" value="<?php echo $row["cu_name"];?>"><br>
    <p1>Alias: </p1> <input type="text" autocomplete="off" disabled name="cu_alias" value="<?php echo $row["cu_alias"];?>"><br><br>
    <p1>Address: </p1> <input type="text" autocomplete="off" disabled name="cu_addr1" value="<?php echo $row["cu_addr1"];?>"><br>
    <p1>Suburb: </p1> <input type="text" autocomplete="off" disabled name="cu_sub1" value="<?php echo $row["cu_sub1"];?>"><br>
    <p1>Postcode: </p1> <input type="number" autocomplete="off" disabled name="cu_pc1" value="<?php echo $row["cu_pc1"];?>"><br>
    <p1>State: </p1> <input type="text" autocomplete="off" disabled name="cu_state1" value="<?php echo $row["cu_state1"];?>"><br><br>
        <p1><b>Mailing Address: </b></p1> <input type="text" autocomplete="off" disabled name="cu_addr2" value="<?php echo $row["cu_addr2"];?>"><br>
        <p1><b>Mailing Suburb: </b></p1> <input type="text" autocomplete="off" disabled name="cu_sub2" value="<?php echo $row["cu_sub2"];?>"><br>
        <p1><b>Mailing Postcode: </b></p1> <input type="number" autocomplete="off" disabled name="cu_pc2" value="<?php echo $row["cu_pc2"];?>"><br>
        <p1><b>Mailing State: </b></p1> <input type="text" autocomplete="off" disabled name="cu_state2" value="<?php echo $row["cu_state2"];?>"><br>
    </div>
    <div class="right">
        <p1>Phone 1: </p1> <input type="text" autocomplete="off" disabled name="cu_phone1" value="<?php echo $row["cu_phone1"];?>"><br>
        <p1>Phone 2: </p1> <input type="text" autocomplete="off" disabled name="cu_phone2" value="<?php echo $row["cu_phone2"];?>"><br><br>
        <p1>ABN: </p1> <input type="text" autocomplete="off" disabled name="cu_abn" value="<?php echo $row["cu_abn"];?>"><br>
        <p1>ACN: </p1> <input type="text" autocomplete="off" disabled name="cu_acn" value="<?php echo $row["cu_acn"];?>"><br>
        <p1>Sales Rep: </p1> <input type="text" autocomplete="off" disabled name="sr_name" value="<?php echo $row["sr_name"] , ' (', $row["cu_slsrep"],')';?>"><br>
        <p1>Domicilled Branch: </p1> <input type="text" autocomplete="off" disabled name="st_name" value="<?php echo $row["st_name"];?>"><br>
        <p1>BPAY Reference: </p1> <input type="text" autocomplete="off" disabled name="cu_bpay" value="<?php echo $row["cu_bpay"];?>"><br><br>
        <p1>Create Date: </p1><input disabled value="<?php echo date("d/m/Y g:ia", $time1)  ?>"> <br>
        <p1>Create User: </p1><input disabled value="<?php echo $row["cu_stampuser"]?>"> <br>
        <p1>Maintenance Date: </p1><input disabled value="<?php if ($time2 !==$time1) { echo date("d/m/Y g:ia", $time2) ;} ?>"> <br>
        <p1>Maintenance User: </p1><input disabled value="<?php echo $row["cu_maintuser"] ?>"> <br>
    
    </div>
    <div class="searchBox" id="otherDetails" style="display:none">
      <button type="button" class="exit" onclick="othDet()">X</button>
    <h1>Other Details</h1>
    <div class="left">
        <p1>Customer Type: </p1> <input type="text" name="cu_type" disabled value="<?php echo $row["tp_name"];?>"><br>
        <p1>Pricing Type: </p1> <input type="text" name="pr_name" disabled value="<?php echo $row["pr_name"];?>"><br>
        <p1>Fallback Margin %: </p1> <input type="number" name="cu_fallback" disabled value="<?php echo $row["cu_fallback"];?>"><br>
        
        
        </div>
        <div class="right">
            <p1>Mandatory PO: </p1><select name="cu_po" disabled required>
            <option></option>
            <option value="0" <?php if ($row["cu_po"] ==0) {echo "selected";}?>>No</option>
            <option value="1" <?php if ($row["cu_po"] ==1) {echo "selected";}?>>Yes</option>
            </select><br>
               <p1>Mandatory Job: </p1><select name="cu_job" disabled required>
            <option></option>
            <option value="0" <?php if ($row["cu_jb"] ==0) {echo "selected";}?>>No</option>
            <option value="1" <?php if ($row["cu_jb"] ==1) {echo "selected";}?>>Yes</option>
            </select><br><br>
         <p1>Terms: </p1> <input type="text" name="cu_terms" disabled value="<?php echo $row["tr_name"];?>"><br>
         <p1>Ledger: </p1> <input type="text" name="cu_ledger" disabled value="<?php echo $row["ld_name"];?>" title="<?php echo $row["ld_desc"];?>"><br>
        
        
        </div>
    
    </div>
  <?php
   }}}?>
    <script>
    function othDet() {
        var x = document.getElementById("otherDetails");
        if (x.style.display ==="none") {
            x.style.display = "Block";
        }
        else {
            x.style.display ="none";
        }
    }
    
    
    </script>
    
    </body>
</html>
