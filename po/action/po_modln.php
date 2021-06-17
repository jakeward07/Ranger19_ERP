<?php 
$prog = "po_modln";
$mod = "po";
$pname = "PO Line Modification";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
 $po = $_GET["o"];
$x = $_GET["x"];
//Get count
$sql = "SELECT count(ln_id) AS count FROM poln WHERE ln_order = $po AND ln_wh = $site_cd";
 $result = $conn->query($sql);
          if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) { 
            $count = $row["count"]-1;
            $count2 = $row["count"];
           
        }}?>

<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title><?php echo $pname;?> - RANGER 5</title>
    </head>
<body>
<h1><?php echo $pname;?></h1>
    <div class="bodystrip">
       <?php if ($x ==0) {} else {?> <a href="po_modln.php?o=<?php echo $po;?>&x=<?php echo $x-1;?>"><button>&larr; Previous Line</button></a><?php }?>
        <?php if ($x ==$count) {} else { ?><a href="po_modln.php?o=<?php echo $po;?>&x=<?php echo $x+1?>"><button>Next Line &rarr;</button></a><?php } ?>
        <button onclick="confirmCancel()">Cancel Order</button>
    
    </div>
      <form action="" method="post">
   <?php
          
        $sql = "SELECT * FROM poln WHERE ln_order = $po AND ln_wh = $site_cd"; 
    $result = $conn->query($sql);
          if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) { 
            $id[] = $row["ln_id"];
            $sku[] = $row["ln_sku"];
            
        }}
        
     $sql = "SELECT * FROM poln WHERE ln_id = '$id[$x]' AND ln_order = $po AND ln_wh = $site_cd LIMIT 1"; 
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {   
            ?>
    <div class="left">
    <p1>Product Code: </p1><input id="sku" disabled value="<?php echo $row["ln_sku"];?>"><br>
    <p1>Description: </p1><input disabled value="<?php echo $row["ln_desc"];?>"><br> 
    <p1>Quantity: </p1><input onkeyup="calcTot()" autofocus id="qty" onfocus="this.select()" type="number" name="ln_qty" value="<?php echo number_format($row["ln_qty"],4, ".", "");?>" autocomplete="off"><br>
    <input type="number" name="ln_origqty" value="<?php echo number_format($row["ln_qty"],4);?>" autocomplete="off" hidden>
    <p1>Price: </p1><input onkeyup="calcTot()" name="ln_price" type="number" id="price" step="0.0001" value="<?php echo $row["ln_price"];?>" autocomplete="off"><br>
    <p1>Required Date: </p1><input name="ln_reqdate" type="date" step="0.0001" value="<?php echo $row["ln_reqdate"];?>" autocomplete="off">
      <br><br>
        <p1>Total Ex GST: </p1><input id="totalex" disabled><br>
        <p1>Total Inc GST: </p1><input id="gst" disabled><br>
    </div>
    <div class="right">
    
        
        <span id="display"></span>
    <button type="submit" class="submit">Update Line</button>
    </div>
    </form>
    <?php
            if (!empty($_POST)) {
                $sequence = $conn -> real_escape_string($_GET["seq"]);
                $quantity = $conn -> real_escape_string($_POST["ln_qty"]);
                $price = $conn -> real_escape_string($_POST["ln_price"]);
                $reqdate = $conn -> real_escape_string($_POST["ln_reqdate"]);
                $order = $conn -> real_escape_string($_GET["o"]);
                $orig = $conn -> real_escape_string($_POST["ln_origqty"]);
                $sql = "UPDATE poln SET ln_price = '$price', ln_qty = '$quantity', ln_reqdate = '$reqdate' WHERE ln_order = $order AND ln_wh = $site_cd AND ln_id = $id[$x]";
                $conn->query($sql);
                $sql2 = "UPDATE pohd SET ph_maintuser = '$usernm' WHERE ph_order = $po AND ph_site = $site_cd";
                $conn->query($sql2);
                $newqty = $orig-$quantity;
                $newqty2 = $quantity-$orig;
                if ($quantity > $orig) {
                    $sql = "UPDATE imwh SET wh_onor = wh_onor+$newqty2 WHERE wh_site = $site_cd AND im_id = (SELECT im_id FROM immf WHERE im_sku = (SELECT ln_sku FROM poln WHERE ln_id = $id[$x]))";
                    $conn->query($sql);
                } else {
                      $sql = "UPDATE imwh SET wh_onor = wh_onor-$newqty WHERE wh_site = $site_cd AND im_id = (SELECT im_id FROM immf WHERE im_sku = (SELECT ln_sku FROM poln WHERE ln_id = $id[$x]))";
                    $conn->query($sql);
                }
                echo "<script>location.replace('po_modln.php?o=$po&x=$x&success=true');</script>";
            }}}
            if (!empty($_GET["cancel"])) {
             ;
                    //Create array for all lines
                    $sql = "SELECT * FROM poln WHERE ln_order = $po AND ln_wh = $site_cd";
                     $result = $conn->query($sql);
          if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) { 
         $sku[] = $row["ln_sku"];  
        $qty[] = $row["ln_qty"];
        }}
                   for ($i = 0; $i < $count2; $i++) {
                       $sql = "UPDATE imwh SET wh_onor = wh_onor-$qty[$i] WHERE wh_site = $site_cd AND im_id = (SELECT im_id FROM immf WHERE im_sku = '$sku[$i]')";
                       $conn->query($sql);
                   }
                 $sql = "UPDATE poln SET ln_finflag = 'yes', ln_maintuser = '$usernm' WHERE ln_order = $po AND ln_wh = $site_cd";
                       $conn->query($sql);
                       $sql = "UPDATE pohd SET hd_stat = 'Cancelled', ph_maintuser = '$usernm' WHERE ph_order = $po AND ph_site = $site_cd";
                       $conn->query($sql);
                echo "<script>alert('Order Cancelled.');location.replace('po_modhd.php');</script>";
                
            }
    ?>
    <script>
        function confirmCancel() {
            var x = confirm("Are you sure you want to cancel this PO? This action cannot be reversed.");
            if (x ===true) {
                location.replace('po_modln.php?o=<?php echo $po?>&cancel=true');
            }
        }
     window.onload = getStock(); calcTot();
        function getStock() {
           
          var x = document.getElementById("sku");
         var b = document.getElementById("display");
    if (x.value == "") {

       
        return;
    } else {
            
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
          b.innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","/oe/sale/get_stock.php?q="+x.value,true);
        xmlhttp.send();
         
    }
}
 function calcTot() {
            var a = document.getElementById("totalex");
            var b = document.getElementById("gst");
            var x = parseFloat(document.getElementById("price").value);
            var y = parseFloat(document.getElementById("qty").value);
            var d = x*y;
            a.value = d.toFixed(2);
            var c = a.value*1.1;
            b.value = c.toFixed(2);
        }
        
       
     
     
    </script>
    
    
    
    
    
    
   
    
    
    </body>
</html>
