<?php 
$prog = "oe_lines";
$mod = "oe";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/dep/oe/oe_stdc.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>Sales Order Entry - RANGER 5</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    

    </head>
<body>
<h1>Sales Order Entry</h1>
    
     <?php
    //Define Variables
    $o = 200006;
    //Verify Order exists and is marked as Open or Part
    $sql = "SELECT * FROM orhd WHERE oh_order = $o AND oh_site = $site_cd AND oh_status = 'Open' OR 'Part'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $ohUser = $row["oh_user"];
            $ohJob = $row["oh_cujb"];
            $ohCust = $row["oh_cust"];
            $ohName = $row["oh_cuname"];
            $ohPo = $row["oh_cupo"];
            if (empty($_GET["update"])) {
                ?>
    <!-- On new line entry -->
    <div class="bodystrip">
    <a href="oe_lines.php?o=<?php echo $o?>"><button type="button">&larr; Previous Line</button></a>
    <a href="oe_lines.php?o=<?php echo $o?>"><button type="button">&rarr; Next Line</button></a>
    <a href="oe_inv.php?o=<?php echo $o?>"><button type="button">Invoice Order</button></a>
    <a href="javascript:void()"><button type="button" onclick="document.getElementById('oNotes').style.display = 'block'; return false;" title="These notes will appear on back order reports">Add Order Notes</button></a>
    <button type="button" onclick="document.getElementById('cNotes').style.display = 'block'; return false;" title="These notes will appear on Customer documents">Add Instructions</button></a>
        
        
    </div>
    <form id="lnForm" action="" method="post">
    <! Loader div !>
          <div class="loading" id="loading" hidden><div class="loader"></div>
    <h4 style="text-align:center">Adding Line... Updating Inventory...</h4>
              
    </div>
    
            <!Order Header details>
    <div class="header" style="width: 100%;">
  
    <div class="left">
        <input id="orderNum" value="<?php echo $o?>" hidden>
        <p1>Customer: </p1><input disabled value="<?php echo $row["oh_cust"], ' - ', $row["oh_cuname"];?>"><br>
        <input id="cu_cust" value="<?php echo $row["oh_cust"];?>" hidden>
        <p1>Purchase Order: </p1><input disabled value="<?php echo $row["oh_cupo"];?>"><br>
        <br><br>
        <p1>Product Code: </p1><input onchange="this.disabled = true; this.required = false; displayQty(); fetchDesc(); fetchStk()" onkeyup="fetchDesc()" id="im_sku" name="im_sku" required list="immf" autocomplete="off" autofocus>
        <datalist id="immf">
        <?php
            //Fetch Product Codes from IMMF table
            $sql = "SELECT * FROM immf f INNER JOIN imwh w ON w.im_id = f.im_id AND w.wh_site = $site_cd ORDER BY f.im_sku";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $avail = $row["wh_stk"]-$row["wh_alloc"];
                    echo "<option value='$row[im_sku]'>$row[im_desc] | Available: $avail</option>";
                    
                }
            }?>
        
        </datalist><br>
        <! Fetch Description via ajax !>
        <span id="descSpan"></span>
        <! Span for quantity details !>
        <span id="qtySpan" hidden>
        <p1>Required Date: </p1><input id="ln_reqdate" required type="date" value="<?php echo date("Y-m-d");?>"><br>
        <p1>Order Quantity: </p1> <input max="100000" onkeyup="setAlloc();fetchPrice();popFields(); calcNet()" onblur="popFields()" id="orderQty" name="ln_oqty" type="number" step="0.0001" autocomplete="off" required><br>
        <p1>Allocate: </p1> <input onkeyup="allocOverride(); <?php if ($allowOverride ==0) {echo "if (this.value > document.getElementById('wh_avail').value) {alert('You cannot allocate an amount greater then what is available.'); this.value = 0; this.select();}";} ?>" onfocus="" id="allocQty" name="ln_alloc" type="number" step="0.0001" autocomplete="off" required><br>
        <p1>Backorder: </p1> <input id="boQty" name="ln_bor" type="number" step="0.0001" autocomplete="off" disabled><br>
        <p1>Price: </p1><input onkeyup="calcNet()" onfocus="fetchLast()" type="number" step="0.0001" id="netPrice" name="ln_price" required autocomplete="off"><br>
        <p1>Discount: </p1><input onkeyup="calcNet(); javascript: if (this.value > 100) {alert('Discount cannot be greater then 100%'); this.value = '';}" onblur="if (this.value =='') {this.value = '0';}" type="number" step="0.0001" id="disCount" name="ln_disc" required value="0" autocomplete="off"><br>
        <p1>Net Price: </p1><input disabled id="netNetPrice"><br>
        <p1>Margin: </p1><input id="margin" disabled><br>
        <p1>Flag: </p1><input id="flagDisplay" disabled>
            
        </span>
        
        </div>
            <! Note Divs !>
            <! Order Notes !>
            <span id="oNotes" hidden><div class="blackout"><div style="width:600px;height:300px;top:0;bottom:0;" class="searchBox">
                <h1>Order Notes</h1>
                <button onclick="document.getElementById('oNotes').style.display = 'none'; return false;" type="button" class="exit">X</button> 
                <textarea name="ln_onotes" id="oNotesInp" maxlength="1000" placeholder="These notes will not appear on customer documents...."></textarea>
                </div></div></span>
            <span id="cNotes" hidden><div class="blackout"><div style="width:600px;height:300px;top:0;bottom:0;" class="searchBox">
                <! Customer Notes !>
                <h1>Customer Notes</h1>
                <button onclick="document.getElementById('cNotes').style.display = 'none'; return false;" type="button" class="exit">X</button> 
                <textarea name="ln_cnotes" id="cNotesInp" maxlength="1000" placeholder="These notes will appear on customer documents...."></textarea>
                </div></div></span>
        
        <div class="right">
         <p1>Job Reference: </p1><input disabled value="<?php echo $ohJob;?>"><br>
         <p1>User: </p1><input disabled value="<?php echo $ohUser;?>"><br>

        <span id="stock">
            </span> <button type="submit" class="submit" id="insert">Add Line &rarr;</button>
        </div>
        <span id="popPricing" hidden></span>
          

        <span style="position:absolute;bottom:-50px;left:0;right:0;width:100%" id="lastPrice"></span>
    </div>
     
    </form> 
         <?php } 
            // if update is set to true 
            if (!empty($_GET["update"])) {
                if ($_GET["update"] =='true') {
                  //Create array
                    $sql = "SELECT * FROM orln WHERE ln_order = $o AND ln_site = $site_cd";
                   $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) { 
                  $id[] = $row["ln_id"];
                    $sku[] = $row["ln_sku"];
                }}
                    $count = count($sku)-1;
                    $count2 = count($sku);
                   if (empty($_GET["seq"])) {
                       $x = 0;
                   }
                    else {
                        $x = $_GET["seq"];
                    }   ?>
        <div class="bodystrip">
    <?php if ($x ==0) {} else {?><a href="oe_lines.php?update=true&o=<?php echo $o?>&seq=<?php echo $x-1;?>"><button type="button">&larr; Previous Line</button></a> <?php }?>
   <?php if ($x ==$count) {} else {?> <a href="oe_lines.php?update=true&o=<?php echo $o?>&seq=<?php echo $x+1;?>"><button type="button">&rarr; Next Line</button></a>
    <a href="oe_inv.php?o=<?php echo $o?>"><button type="button">Invoice Order</button></a><?php } ?>
    <a href="javascript:void()"><button type="button" onclick="document.getElementById('oNotes').style.display = 'block'; return false;" title="These notes will appear on back order reports">Add Order Notes</button></a>
    <button type="button" onclick="document.getElementById('cNotes').style.display = 'block'; return false;" title="These notes will appear on Customer documents">Add Instructions</button></a>
        
        
    </div>
    <form id="lnForm" action="" method="post">
    <! Loader div !>
          <div class="loading" id="loading" hidden><div class="loader"></div>
    <h4 style="text-align:center">Adding Line... Updating Inventory...</h4>
              
    </div>
    
            <!Order Header details>
    <div class="header" style="width: 100%;">
  
    <div class="left">
        <input id="orderNum" value="<?php echo $o?>" hidden>
        <p1>Customer: </p1><input disabled value="<?php echo $ohCust, ' - ', $ohName;?>"><br>
        <input id="cu_cust" value="<?php echo $ohCust;?>" hidden>
        <p1>Purchase Order: </p1><input disabled value="<?php echo $ohPo;?>"><br>
        <br><br>
        <?php 
                  
                    $sql = "SELECT * FROM orln WHERE ln_id = $id[$x] AND ln_order = $o AND ln_site = $site_cd";
                      $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) { 
                    //Define variables
                    $ln_sku = $row["ln_sku"];
                    $ln_desc = $row["ln_desc"];
                    $ln_reqdate = $row["ln_reqdate"];
                    $ln_oqty = $row["ln_oqty"];
                    $ln_alloc = $row["ln_alloc"];
                    $ln_bor = $row["ln_bor"];
                    $ln_listprice = $row["ln_listprice"];
                    $ln_disc = $row["ln_disc"];
                    $ln_netprice = $row["ln_netprice"];
                    $ln_marg = $row["ln_marg"];
                   $lnId = $row["ln_id"];
                    $ln_onote = $row["ln_onotes"];
                    $ln_cnote = $row["ln_cnotes"];
                  
                    
                    ?>
        <p1>Product Code: </p1><input onkeyup="fetchDesc()" id="im_sku" name="im_sku" disabled value="<?php echo $ln_sku?>" autocomplete="off">
        <br>
        <p1>Description: </p1><input value="<?php echo $ln_desc?>" disabled><br>
        
        <p1>Required Date: </p1><input id="ln_reqdate" required type="date" value="<?php echo $ln_reqdate?>"><br>
        <p1>Order Quantity: </p1> <input max="100000" onkeyup="setAlloc();fetchPrice();popFields(); calcNet()" onblur="popFields()" id="orderQty" autofocus onfocus="this.select()" value="<?php echo $ln_oqty?>" name="ln_oqty" type="number" step="0.0001" autocomplete="off" required><br>
        <p1>Allocate: </p1> <input value="<?php echo $ln_alloc?>" onkeyup="allocOverride(); <?php if ($allowOverride ==0) {echo "if (this.value > document.getElementById('wh_avail').value) {alert('You cannot allocate an amount greater then what is available.'); this.value = 0; this.select();}";} ?>" onfocus="" id="allocQty" name="ln_alloc" type="number" step="0.0001" autocomplete="off" required><br>
        <p1>Backorder: </p1> <input value="<?php echo $ln_bor?>" id="boQty" name="ln_bor" type="number" step="0.0001" autocomplete="off" disabled><br>
        <p1>Price: </p1><input value="<?php echo $ln_listprice?>" onkeyup="calcNet()" onfocus="fetchLast()" type="number" step="0.0001" id="netPrice" name="ln_price" required autocomplete="off"><br>
        <p1>Discount: </p1><input value="<?php echo $ln_disc?>" onkeyup="calcNet(); javascript: if (this.value > 100) {alert('Discount cannot be greater then 100%'); this.value = '';}" onblur="if (this.value =='') {this.value = '0';}" type="number" step="0.0001" id="disCount" name="ln_disc" required value="0" autocomplete="off"><br>
        <p1>Net Price: </p1><input value="<?php echo $ln_netprice?>" disabled id="netNetPrice"><br>
        <p1>Margin: </p1><input value="<?php echo $ln_marg?>" id="margin" disabled><br>
        <p1>Flag: </p1><input id="flagDisplay" disabled>
            
        
        
        </div>
            <! Note Divs !>
            <! Order Notes !>
            <span id="oNotes" hidden><div class="blackout"><div style="width:600px;height:300px;top:0;bottom:0;" class="searchBox">
                <h1>Order Notes</h1>
                <button onclick="document.getElementById('oNotes').style.display = 'none'; return false;" type="button" class="exit">X</button> 
                <textarea name="ln_onotes" id="oNotesInp" maxlength="1000" placeholder="These notes will not appear on customer documents...."><?php echo $ln_onote;?></textarea>
                </div></div></span>
            <span id="cNotes" hidden><div class="blackout"><div style="width:600px;height:300px;top:0;bottom:0;" class="searchBox">
                <! Customer Notes !>
                <h1>Customer Notes</h1>
                <button onclick="document.getElementById('cNotes').style.display = 'none'; return false;" type="button" class="exit">X</button> 
                <textarea name="ln_cnotes" id="cNotesInp" maxlength="1000" placeholder="These notes will appear on customer documents...."><?php echo $ln_cnote;?></textarea>
                </div></div></span>
        
        <div class="right">
         <p1>Job Reference: </p1><input disabled value="<?php echo $ohJob;?>"><br>
         <p1>User: </p1><input disabled value="<?php echo $ohUser;?>"><br>
<h3 style="text-align:right">Stock Info</h3>
        <span id="stock">
            <?php 
                    
$sql="SELECT * FROM imwh WHERE wh_site = $site_cd AND im_id = (SELECT im_id FROM immf WHERE im_sku = '$sku[$x]')"; 
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
  

?>
<p1>On Hand: </p1><input value="<?php echo $row["wh_stk"];?>" disabled><br>
<p1>Available: </p1><input id="wh_avail" value="<?php echo number_format($row["wh_stk"]-$row["wh_alloc"],2,'.', '');?>" disabled><br>
<p1>Allocated: </p1><input id="wh_alloc" value="<?php echo $row["wh_alloc"];?>" disabled><br>
<p1>On Backorder: </p1><input value="<?php echo $row["wh_bor"];?>" disabled><br>
<p1>On Order: </p1><input value="<?php echo $row["wh_onor"];?>" disabled><br>
<?php if (!empty($row["wh_loc"])) {?><p1>Bin Location: </p1><input value="<?php echo $row["wh_loc"];?>" disabled><br><?php } ?>
<?php

                         }} 
    ?>
<p1>Line Total Ex GST: </p1><input id="lineEx" disabled><br>
<p1>Line Total Inc GST: </p1><input id="lineInc" disabled><br> 
<input id="lineId" value="<?php echo $lnId;?>" hidden>
<input id="postType" value="update" hidden>
            </span> <button type="submit" class="submit" id="insert">Update Line &rarr;</button>
        </div>
        <span id="popPricing" hidden></span>
          

        <span style="position:absolute;bottom:-50px;left:0;right:0;width:100%" id="lastPrice"></span>
    </div>
     
    </form> 
    <?php
                }}else {echo "<script>alert('That line sequence does not exist! Returning you to Line 1');location.replace('oe_lines.php?update=true&o=$o&seq=0');</script>";}}
            }
        }
    } else {
        echo "<script>alert('Order does not exist!'); location.replace('oe_header.php');</script>";
    }
    ?>
       
    </body>
    
    <script src="/oe/ajax/javascript/fetch_desc.js"></script>
    <script src="/oe/ajax/javascript/display_qty.js"></script>
    <script src="/oe/ajax/javascript/display_stk.js"></script>
    <script src="/oe/ajax/javascript/setAlloca.js"></script>
       <script src="/oe/ajax/javascript/populateFields.js"></script>
    <script src="/oe/ajax/javascript/fetchPricing.js"></script>
    <script src="/oe/ajax/javascript/populateFields.js"></script>
    <script src="/oe/ajax/javascript/fetchLstPrice.js"></script>
    <script>
     $(document).ready(function(){
              $(document).ajaxStart(function() {
                  document.getElementById("loading").style.display = "block";
               
                });
            $("#lnForm").submit(function(){
                var sku=$("#im_sku").val();
                var desc = $("#im_desc").val();
                var per = $("#per").val();
                var oqty = $("#orderQty").val();
                var alloc = $("#allocQty").val();
                var bor = $("#boQty").val();
                var list = $("#netPrice").val();
                var disc = $("#disCount").val();
                var net = $("#netNetPrice").val();
                var marg = $("#margin").val();
                var order = $("#orderNum").val();
                var cnotes = $("#cNotesInp").val();
                var onotes = $("#oNotesInp").val();
                var reqDate = $("#ln_reqdate").val();
                var cost = $("#margCs").val();
                var uom = $("#im_uom").val();
                var type = $("#postType").val();
                var lnid = $("#lineId").val();
                $.ajax({
                    url:'/oe/ajax/javascript/jquery/insert_line.php',
                    method:'POST',
                    data:{
                    a:sku, b:desc, c:per, d:oqty, e:alloc, f:bor, g:list, h:disc, i:net, j:marg, k:order, l:cnotes, m:onotes, n:reqDate, acost:cost, auom:uom, o:type, p:lnid
                    },
                   success:function(data){
                       $(document).ajaxStop(function() {
              document.getElementById("loading").style.display = "none";
                           if (document.getElementById("lineId").value =="") {
                          location.replace("oe_lines.php?o=<?php echo $o;?>");
                           }
                           else {
                               location.replace("oe_lines.php?update=true&o=<?php echo $o?>&seq=<?php echo $x;?>");
                           }
                         
                });
                   }
                   
                }); 
                
              
            });  
        });
    </script>
    

    
</html>

