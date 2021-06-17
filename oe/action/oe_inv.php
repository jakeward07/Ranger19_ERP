<?php 
$prog = "oe_invO";
$mod = "oe";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>Sale Delivery Point - RANGER 5</title>
    </head>
<body><style>
.loader {
    margin-top: 5px;
  border: 6px solid #f3f3f3;
  border-radius: 50%;
  border-top: 6px solid #3498db;
  width: 20px;
  height: 20px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
    margin-left: auto;
    margin-right: auto;
    
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
    <h1>Invoice Delivery Details</h1>
  <span id="invBar" hidden> <div class="success" style="position:absolute;left:0;right:0;margin-left:auto;margin-right:auto;display:block; width:200px;text-align:center">
    Creating Invoice. Please Wait <div class="loader"></div>
    
      </div></span>
    <form action="" id="oedp" method="post">
    <?php
        $o = $conn -> real_escape_string($_GET["o"]);
        $sql = "SELECT * FROM orhd WHERE oh_order = $o AND oh_site = $site_cd";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $c = $row["oh_cust"];
    $sql = "SELECT * FROM cumf c WHERE c.cu_id = $c";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $billto = $row["cu_billto"];
            ?>
<div class="left">
    <p1>Charge to: </p1><input name="dp_to" disabled id="dp_to"  value="<?php echo $row["cu_name"];?>"><br>
    <input name="dp_addr1" id="dp_addr" disabled  value="<?php echo $row["cu_addr1"];?>"><br>
    <input name="dp_sub1" id="dp_sub" disabled  value="<?php echo $row["cu_sub1"];?>"><br>
    <input name="dp_pc1" id="dp_pc" disabled  value="<?php echo $row["cu_pc1"];?>"><br>
    <input name="dp_state1" id="dp_state" disabled  value="<?php echo $row["cu_state1"];?>"><br>
    <br>
    <p1>Deliver Via: </p1><select autofocus id="type" name="d_type" required>
    <option></option>
    <option value="ct">Counter Sale</option>
    <option value="de">Delivery by this stores transport</option>
    <option value="dc">Delivery by External Courier</option>
    <option value="pu">Customer to pick up from this store</option>
    <option value="cs">Customer to pick up from the supplier</option>
    
    
    
    </select><br>
    <textarea name="oh_notes" style="resize:none" placeholder="Special Instructions..."></textarea>
    </div>
     <div class="right">
    <p1>Deliver to: </p1><input name="dp_to" id="dp_to2" required value="<?php echo $row["cu_name"];?>"><br>
    <input name="dp_addr" id="dp_addr2" required value="<?php echo $row["cu_addr2"];?>"><br>
    <input name="dp_sub" id="dp_sub2" required value="<?php echo $row["cu_sub2"];?>"><br>
    <input name="dp_pc" id="dp_pc2" required value="<?php echo $row["cu_pc2"];?>"><br>
    <input name="dp_state" id="dp_state2" required value="<?php echo $row["cu_state2"];?>"><br>
         <?php 
               $sql2 = "SELECT sum(ln_alloc*ln_netprice) as inv, sum(ln_alloc) AS qty FROM orln l WHERE l.ln_order = $o AND l.ln_site = $site_cd";
    $result = $conn->query($sql2);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            ?>
    <p1>Order Amount ex GST: </p1><input value="<?php echo number_format($row["inv"],2);?>" disabled><br>
         <span hidden>
         <input name="ordex" value="<?php echo $row["inv"];?>">
         <input name="ordinc" value="<?php echo $row["inv"]*1.1;?>">
         </span>
    <p1>Order Amount inc GST: </p1><input value="<?php echo number_format($row["inv"]*1.1,2);?>" disabled><br>
    <p1>Quantity of goods: </p1><input value="<?php echo $row["qty"];?>" disabled><br>
    <p1>Bill-to Account: </p1><input value="<?php echo $billto;?>" disabled><br>
    <button class="submit" id="sub" type="button" onclick="inv()">Invoice Order</button>
    
    </div>
    </form>
    <?php }}}}}} else {echo "<script>alert('Order does not exist!');location.replace('oe_header.php');</script>";}?>
    <?php if (!empty($_POST)) {
    if ($_POST["ordex"] > 0) {

    //Select order lines
    $sql2 = "SELECT * FROM orln WHERE ln_order = '$_GET[o]' AND ln_site = $site_cd";
    $result = $conn->query($sql2);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            //UPDATE STOCK INFORMATION
            $sql3 = "UPDATE imwh SET wh_stk = wh_stk-$row[ln_alloc], wh_alloc = wh_alloc-$row[ln_alloc] WHERE wh_site = '$site_cd' AND im_id = (SELECT im_id FROM immf WHERE im_sku = '$row[ln_sku]')";
            $conn->query($sql3);
            //LOG MOVEMENT
            $sql4 = "INSERT INTO immv (mv_sku, mv_type, mv_qty, mv_bal, mv_avg, mv_site, mv_user) (SELECT '$row[ln_sku]','Invoice','$row[ln_alloc]', wh_stk, wh_avgcst, $site_cd, '$usernm 'FROM imwh WHERE im_id = (SELECT im_id FROM immf WHERE im_sku = '$row[ln_sku]') AND wh_site = $site_cd)";
            $conn->query($sql4);
            //SELECT INVOICE NUMBER
            $sql6 = "SELECT vh_inv FROM invh WHERE vh_site = '$site_cd' ORDER BY vh_id DESC LIMIT 1";
              $result = $conn->query($sql6);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $inv = $row["vh_inv"]+1;
            //INSERT INTO INVH
        $sql5 = "INSERT INTO invh (vh_inv, vh_order, vh_site, vh_user, vh_cust, vh_amtex, vh_amtinc, vh_stampuser, vh_po, vh_job) (SELECT $inv, h.oh_order, h.oh_site, h.oh_user, h.oh_cust, '$_POST[ordex]', '$_POST[ordinc]', '$usernm', h.oh_cupo, h.oh_cujb FROM orhd h WHERE h.oh_site = '$site_cd' AND h.oh_order = '$_GET[o]')";
            $conn->query($sql5);
            //INSERT INTO INVL
            $sql7 = "INSERT INTO invl (vl_inv, vl_order, vl_site, vl_sku, vl_desc, vl_price, vl_incgst, vl_qty, vl_stampuser, vl_oqty, vl_bor, vl_cost, vl_marg, vl_lnval, vl_per, vl_uom) (SELECT '$inv', '$_GET[o]','$site_cd', ln_sku, ln_desc, ln_netprice, ln_netprice*1.1, ln_alloc, '$usernm', ln_oqty, ln_bor, ln_cost, ln_marg, ln_netprice*ln_alloc/ln_per, ln_per, ln_uom FROM orln WHERE ln_order = '$_GET[o]' AND ln_site = '$site_cd')";
            $conn->query($sql7);
            //Insert into ARBL
            $period = date('m-Y');
            $sql9 = "INSERT INTO arbl (bl_cust, bl_inv, bl_site, bl_amt, bl_period, bl_stampuser) (SELECT c.cu_billto, '$inv', '$site_cd', v.vh_amtinc, '$period', '$usernm' FROM invh v INNER JOIN cumf c ON c.cu_id = v.vh_cust WHERE v.vh_inv = '$inv' AND v.vh_site = $site_cd)";
            $conn->query($sql9);
                //Insert into oedp
    $sql = "INSERT INTO oedp (dp_cust, dp_to, dp_addr, dp_sub, dp_state, dp_pc, dp_order, dp_wh, dp_specins, dp_deltp, dp_stampuser, dp_inv) VALUES ('$_GET[c]','$_POST[dp_to]','$_POST[dp_addr]','$_POST[dp_sub]','$_POST[dp_state]','$_POST[dp_pc]','$_GET[o]','$site_cd','$_POST[oh_notes]','$_POST[d_type]','$usernm','$inv')";
    $conn->query($sql);
                      echo $conn->error;
   echo "<script>location.replace('/doc_gen/oe/inv_doc.php?i=$inv');</script>";
        }}}}}
        else {
            echo "<script>alert('No lines to invoice. Sales Order Created');</script>";
              echo "<script>location.replace('oe_header.php');</script>";
        }
  
} ?>

    <script>
    function inv() {

        var a = document.getElementById("dp_to2").value;
        var b = document.getElementById("dp_addr2").value;
        var c = document.getElementById("dp_sub2").value;
        var d = document.getElementById("dp_pc2").value;
        var e = document.getElementById("dp_state2").value;
        var f = document.getElementById("type").value;
        if (a && b && c && d && e && f !=="") {
       
     setTimeout(function(){ document.getElementById("oedp").submit(); 

                          }, 2000);
         document.getElementById("invBar").style.display = "block"; 
    }
    else {
        alert("Fill in required fields");
    }
    }
    
        addEventListener("keyup", function(event) {
  // Number 13 is the "Enter" key on the keyboard
  if (event.ctrlKey && event.keyCode === 13) {
    // Cancel the default action, if needed
    event.preventDefault();
    // Trigger the button element with a click
document.getElementById("sub").click();
  }
});
    </script>
    </body>
</html>
