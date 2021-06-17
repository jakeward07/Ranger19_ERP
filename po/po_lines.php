<?php 
$order = $_GET["o"];
$prog = "po_lines";
$mod = "po";
$d = new DateTime('+1 day');
$date = $d->format('Y-m-d');
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
$getPo = "SELECT * FROM pohd WHERE ph_order = '$order' AND ph_site = '$site_cd' LIMIT 1";
$result = $conn->query($getPo);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
     $s = $row["ph_supp"];
        $c = $row["ph_contract"];

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>Purchase Order Creation - RANGER 5</title>
    </head>
    
<body onload="getProd()">
<h1>Purchase Order Creation</h1>
    <div class="bodystrip">
    <button type="button" onclick="showPo()">Show Lines</button>
        <a href="po_del.php?o=<?php echo $_GET["o"];?>&s=<?php echo $s;?>"><button>Transmit Order</button></a>
        <a href="po_lines.php?o=<?php echo $_GET["o"];?>&act=delete"><button>Cancel Purchase Order</button></a>
    
    </div>
    <form action="" method="post">
     <div class="left">
     <input hidden readonly name="ln_seq" required type="number" step="1"
                                   value="<?php
     $sql = "SELECT ln_seq FROM poln WHERE ln_order = $order AND ln_wh = $site_cd ORDER BY ln_id DESC LIMIT 1";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo $row["ln_seq"]+5;
            }}
        else {
            echo 5;
        }
        
        
        
        
        ?>" id="ln_seq">
    <p1>Product Code: </p1><input autofocus onblur="setDesc()" onchange="getProd(); getPrice(); getStock(); getBreaks()" required name="ln_sku" list="product" autocomplete="off" id="im_sku">
         <datalist id="product">
         <?php 
          
             $sql = "SELECT * FROM pofr p INNER JOIN immf i ON i.im_id = p.fr_imid WHERE p.fr_supp = $s";
             $result = $conn->query($sql);
             if ($result->num_rows > 0) {
                 while ($row = $result->fetch_assoc()) {
                     ?>
             <option value="<?php echo $row["im_sku"];?>"><?php echo $row["im_desc"];?></option>
             <?php
                 }
             }
         ?>
                   
         </datalist><br>
          <span id="prodAttach">
             </span>
         <p1>Quantity: </p1><input onkeyup="calcTot(); getPrice(); showSub(); gstVal()" type="number" id="qty" onfocus="this.select();" name="ln_qty" required ><br>

      
         <span id="pricing"></span>
         <p1>Required Date: </p1> <input name="ln_reqdate" type="date" required autocomplete="off" value="<?php echo $date?>"><br>
  <p1>GST: </p1><input id="gstvalue" name="ln_gst" readonly>
         <br><br>
         <span id="submit" hidden> <button type="submit" class="submit">Add Line</button></span>
   
        <span id="pbreaks"></span>
        </div>
        <div class="right">
        <p1>Line Total: </p1> <input id="totalex" disabled><br>
        <p1>Inc. GST: </p1> <input id="gst" disabled><br>
        <p1>Order Total Ex: </p1><input disabled value="<?php
            $sql = "SELECT ph_totalex AS total FROM pohd WHERE ph_order = $_GET[o] AND ph_site = $site_cd";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if (!empty($row["total"])) {
                    echo '$',number_format($row["total"],2);
                }
                    else {
                        echo "$0.00";
                    }
            }}
            
            ?>"><br>
        <span id="stk"></span>
        
        </div>
        
        
        <div class="hidden" hidden>
        <input id="contract" name="contract" value="<?php echo $c;?>">
            <input name="ln_order" value="<?php echo $order;?>">
            <input name="ln_desc" id="imDesc">
        </div>
        
    </form>
    <div id="fullPO" hidden>
    <?php include('ajax/show_lines.php');?>
    
    </div>
    <?php if (!empty($_POST)) {
    $sql = "INSERT INTO poln (ln_sku, ln_desc, ln_order, ln_wh, ln_qty, ln_price, ln_gst, ln_stampuser, ln_seq, ln_reqdate, ln_uom, ln_per)
    VALUES ('$_POST[ln_sku]','$_POST[ln_desc]','$_POST[ln_order]','$site_cd','$_POST[ln_qty]','$_POST[ln_price]','$_POST[ln_gst]','$usernm','$_POST[ln_seq]','$_POST[ln_reqdate]','$_POST[ln_uom]','$_POST[ln_per]')";
    $result = $conn->query($sql);
    $sql2 = "UPDATE imwh SET wh_onor = wh_onor+$_POST[ln_qty] WHERE wh_site = $site_cd AND im_id = (SELECT im_id FROM immf WHERE im_sku = '$_POST[ln_sku]')";
    $conn->query($sql2);
                $a1 = $_POST["ln_qty"];
                $a2 = $_POST["ln_price"];
                $a3 = $_POST["ln_per"];
    $sql3 = "UPDATE pohd SET ph_totalex = ph_totalex+(($a1*$a2)/$a3) WHERE ph_order = $o AND ph_site = $site_cd";
                $conn->query($sql3);
   $o = $_GET["o"];
    $c = $_GET["c"];
    $s = $_GET["s"];
    echo "<script>location.replace('po_lines.php?o=$o')</script>";
}
        if (!empty($_GET)) {
            if ($_GET["act"] =="delete") {
            $sql = "UPDATE imwh SET wh_onor = wh_onor-(SELECT ln_qty FROM poln WHERE ln_order = $o AND ln_wh = $site_cd) WHERE im_id  (SELECT im_id FROM immf WHERE im_sku = (SELECT ln_sku FROM poln WHERE ln_order = $o AND ln_wh = $site_cd)) AND wh_site = $site_cd";
                $conn->query($sql);
                $sql = "DELETE FROM pohd WHERE ph_order = $o AND ph_site = $site_cd";
            $conn->query($sql);
            $sql = "DELETE FROM poln WHERE ln_order = $o AND ln_wh = $site_cd";
            $conn->query($sql);
           echo $conn->error;
        }}
        
    ?>
    
    <script>
    function getProd() {
           
          var x = document.getElementById("im_sku");
         
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
          document.getElementById("prodAttach").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","/po/ajax/get_prod.php?q="+x.value,true);
        xmlhttp.send();
         
    }
}
       
        
        function getPrice() {
           
          var x = document.getElementById("im_sku");
         var b = document.getElementById("contract");
            var pv = document.getElementById("qty");
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
          document.getElementById("pricing").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","/po/ajax/get_price.php?q="+b.value+"&p="+x.value+"&qu="+pv.value, true);
        xmlhttp.send();
         
    }
}
        
        function calcTot() {
            var a = document.getElementById("totalex");
            var b = document.getElementById("gst");
            var x = parseFloat(document.getElementById("price").value);
            var y = parseFloat(document.getElementById("qty").value);
            var z = parseFloat(document.getElementById("im_per").value);
            var d = x*y/z;
            a.value = d.toFixed(2);
            var c = a.value*1.1;
            b.value = c.toFixed(2);
        }
        
        function getStock() {
           
          var x = document.getElementById("im_sku");
         var b = document.getElementById("stk");
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
       function getBreaks() {
           
          var x = document.getElementById("im_sku");
         var b = document.getElementById("pbreaks");
           var c = document.getElementById("contract");
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
        xmlhttp.open("GET","/po/ajax/get_pbreaks.php?p="+x.value+"&q="+c.value,true);
        xmlhttp.send();
         
    }
}
        function gstVal() {
    var x = document.getElementById("gstvalue");
    var z = document.getElementById("qty");
    var y = document.getElementById("price");
    var a = parseFloat(z.value);
    var b = parseFloat(y.value);
            var c = parseFloat(document.getElementById("im_per").value);
var a1 = a*b;
var a2 = a1*1.1;
var a3 = a2-a1;
var a4 = a3.toFixed(2);
x.value = a4/c;
}
        
        function showSub() {
            var x = document.getElementById("submit");
            var y = document.getElementById("qty");
            if (y.value !=="") {
                x.style.display = "block";
            }
            else {
                x.style.display = "none";
            }
        }
        
        function setDesc() {
            var x = document.getElementById("im_desc");
            var y = document.getElementById("imDesc");
            y.value = x.value;
        }
        
        function showPo() {
            var x = document.getElementById("fullPO");
          if (x.style.display ==="block") {
              x.style.display = "none";
          }
            else {
                x.style.display = "block";
            }
        }
        
        
 
    </script>
    <?php }} ?>
    </body>
</html>
