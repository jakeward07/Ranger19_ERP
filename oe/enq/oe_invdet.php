<?php 
$prog = "oe_invdet";
$mod = "oe";
    $inv = $_GET["i"];
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>Detailed Invoice Enquiry - RANGER 5</title>
    </head>
<body>
<h1>Detailed Invoice Enquiry</h1>
    <div class="bodystrip">
        <a href="oe_inv.php"><button>Find Another Invoice</button></a>
    <button onclick="showLines()">Invoice Lines</button>
    <button onclick="delDet()">Delivery Details</button>
    <a href="/doc_gen/oe/inv_doc.php?i=<?php echo $inv;?>"><button>Reprint Invoice</button></a>
    </div>
     <div class="left">
    <?php if (!empty($_GET["i"])) {
if ((($sec =='ADM') or ($sec =='AR') or ($sec =='ARS'))) {
    $brn = $_GET["s"];
     $sql = "SELECT * FROM invh h INNER JOIN cumf c ON c.cu_id = h.vh_cust INNER JOIN orhd o ON o.oh_order = h.vh_order AND o.oh_site = $brn INNER JOIN oedp p ON p.dp_inv = h.vh_inv AND p.dp_wh = $brn WHERE h.vh_inv = $inv AND h.vh_site = $brn";
} else {
    $sql = "SELECT * FROM invh h INNER JOIN cumf c ON c.cu_id = h.vh_cust INNER JOIN orhd o ON o.oh_order = h.vh_order AND o.oh_site = $site_cd INNER JOIN oedp p ON p.dp_inv = h.vh_inv AND p.dp_wh = $site_cd  WHERE h.vh_inv = $inv AND h.vh_site = $site_cd";
}
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $d1 = strtotime($row["vh_timestamp"]);
            $date = date("d/m/Y g:ia", $d1);
            $d2 = strtotime($row["oh_timestamp"]);
            $date2 = date("d/m/Y g:ia", $d2);
            ?>
    
<p1>Invoice Number: </p1><input disabled value="<?php echo $row["vh_inv"],'-',$row["vh_site"];?>"><br>
   <p1>Customer:</p1> <input disabled value="<?php echo $row["cu_id"],' - ',$row["cu_name"];?>"><br>
   <p1>Sale User:</p1> <input disabled value="<?php echo $row["vh_user"];?>"><br>
   <p1>Purchase Order:</p1> <input disabled value="<?php echo $row["vh_po"];?>"><br>
   <p1>Job Reference:</p1> <input disabled value="<?php echo $row["vh_job"];?>"><br>

    </div>
    <div class="right">
    <p1>Sales Order: </p1><input value="<?php echo $row["vh_order"],'-',$row["vh_site"];?>" disabled><br>
    <p1>Amount Ex GST: </p1><input value="$<?php echo number_format($row["vh_amtex"],2);?>" disabled><br>
    <p1>Amount Inc GST: </p1><input value="$<?php echo number_format($row["vh_amtinc"],2);?>" disabled><br>
    <p1>Invoice Date: </p1><input value="<?php echo $date;?>" disabled><br>
    <p1>Order Date: </p1><input value="<?php echo $date2;?>" disabled><br>
    
    </div>
    <span id="delDets" hidden>
    <div class="blackout" style="z-index:1">
    <div class="searchBox" style="width:800px;position:absolute;left:0;right:0;top:0;bottom:0; height:400px"><button class="exit" onclick="delDet()">X</button>
    <h1>Delivery Details</h1>
        <div class="center">
        <p1>Deliver To: </p1><input disabled value="<?php echo $row["dp_to"];?>"><br>
        <p1>Delivery Address: </p1><input disabled value="<?php echo $row["dp_addr"];?>"><br>
        <p1>Delivery Suburb: </p1><input disabled value="<?php echo $row["dp_sub"];?>"><br>
        <p1>Delivery Postcode: </p1><input disabled value="<?php echo $row["dp_pc"];?>"><br>
        <p1>Delivery State: </p1><input disabled value="<?php echo $row["dp_state"];?>"><br><textarea style="resize:none" disabled><?php echo $row["dp_specins"];?></textarea>
        
        </div>
        </div></div></span>
     <?php  }} ?>
    <span id="products" hidden>
    <div style="float:left;width:100%; margin-top:20px">
    <table class="table">
        <tr class="tr">
        <td class="td">Product Code</td>
        <td class="td">Description</td>
        <td class="td">Order Quantity</td>
        <td class="td">Shipped</td>
        <td class="td">Backorder</td>
        <td class="td">Price Ex</td>
        <td class="td">Total</td>
        <td class="td">Status</td>
        
        </tr>
        <?php 
    $sql = "SELECT * FROM invl WHERE vl_inv = $inv AND vl_site = $site_cd";
       $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            ?>
        <tr class="tr">
            <td class="td"><a href="/im/enq/im_enq.php?product=<?php echo $row["vl_sku"];?>"><?php echo $row["vl_sku"];?></a></td>
        <td class="td"><?php echo $row["vl_desc"];?></td>
        <td class="td"><?php echo $row["vl_oqty"];?></td>
        <td class="td"><?php echo $row["vl_qty"];?></td>
        <td class="td"><?php echo $row["vl_bor"];?></td>
        <td class="td"><?php echo $row["vl_price"];?></td>
        <td class="td">$<?php echo number_format($row["vl_price"]*$row["vl_qty"], 2);?></td>
        <td class="td"><?php if (($row["vl_bor"] > 0) AND ($row["vl_qty"] > 0)) {echo "Partially Shipped";} elseif (($row["vl_bor"] > 0) AND ($row["vl_qty"] ==0)) {echo "On Backorder";} else {echo "Invoiced";}?></td>
        </tr>
        <?php }}?>
        </table>
    
        </div></span>
    <?php  } ?>
    <script>
    function showLines() {
        var x = document.getElementById("products");
        if (x.style.display ==="block") {
            x.style.display = "none";
        }
        else {
            x.style.display = "block";        }
    }
        function delDet() {
                var x = document.getElementById("delDets");
        if (x.style.display ==="block") {
            x.style.display = "none";
        }
        else {
            x.style.display = "block";        }
    }
    </script>
    </body>
</html>
