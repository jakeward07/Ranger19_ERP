<?php 
$prog = "oe_orddet";
$mod = "oe";
    $ord = $_GET["o"];
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>Detailed Order Enquiry - RANGER 5</title>
    </head>
<body>
<h1>Detailed Order Enquiry</h1>
    <div class="bodystrip">
        <a href="oe_oord.php"><button>Find Another Order</button></a>
    <button onclick="showLines()">Order Lines</button>
    <a href="/doc_gen/oe/inv_doc.php?i=<?php echo $inv;?>"><button>Reprint Invoice</button></a>
    </div>
     <div class="left">
    <p1>Order Number: </p1><input <?php if (!empty($_GET)) {
    echo "disabled value='$_GET[o]-$site_cd'"; }?>
} id="input" autocomplete="off" autofocus>
    <?php if (!empty($_GET["o"])) {

    $sql = "SELECT * FROM orhd h INNER JOIN cumf c ON c.cu_id = h.oh_cust WHERE h.oh_order = $ord AND h.oh_site = $site_cd";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $d1 = strtotime($row["oh_timestamp"]);
            $date = date("d/m/Y g:ia", $d1);
         
            ?>
    <br>
   <p1>Customer:</p1> <input disabled value="<?php echo $row["cu_id"],' - ',$row["cu_name"];?>"><br>
   <p1>Sale User:</p1> <input disabled value="<?php echo $row["oh_user"];?>"><br>
   <p1>Purchase Order:</p1> <input disabled value="<?php echo $row["oh_po"];?>"><br>
   <p1>Job Reference:</p1> <input disabled value="<?php echo $row["oh_job"];?>"><br>

    </div>
    <div class="right">
    <p1>Amount Ex GST: </p1><input value="$<?php echo number_format($row["oh_amtex"],2);?>" disabled><br>
    <p1>Amount Inc GST: </p1><input value="$<?php echo number_format($row["oh_amtinc"],2);?>" disabled><br>
    <p1>Order Date: </p1><input value="<?php echo $date;?>" disabled><br>
    
    </div>
  </span>
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
        
        </tr>
        <?php 
    $sql = "SELECT * FROM orln WHERE ln_order = $ord AND ln_site = $site_cd";
       $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            ?>
        <tr class="tr">
            <td class="td"><a href="/im/enq/im_enq.php?product=<?php echo $row["vl_sku"];?>"><?php echo $row["ln_sku"];?></a></td>
        <td class="td"><?php echo $row["ln_desc"];?></td>
        <td class="td"><?php echo $row["ln_oqty"];?></td>
        <td class="td"><?php echo $row["ln_qty"];?></td>
        <td class="td"><?php echo $row["ln_bor"];?></td>
        <td class="td">$<?php echo $row["ln_netprice"];?></td>
        <td class="td">$<?php echo number_format($row["ln_price"]*$row["ln_qty"], 2);?></td>
        
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
