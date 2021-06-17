<?php 
$prog = "sp_price";
$mod = "sp";
$pname = "Price Enquiry";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title><?php echo $pname;?> - RANGER 5</title>
    </head>
<body>
<h1><?php echo $pname;?></h1>
   <div class="center">
       <p1>Product: </p1><input id="sku" onkeyup="showCust()" autocomplete="off" autofocus required list="immf">
    <datalist id="immf">
    <?php
        $sql = "SELECT * FROM immf";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
            ?>
        <option value="<?php echo $row["im_sku"];?>"><?php echo $row["im_desc"];?></option>
        <?php } ?>
    </datalist><br>
       <span id="custSpan" hidden>
       <p1>Customer: </p1><input id="cust" list="cumf" required autocomplete="off">
           <datalist id="cumf">
           <?php
                 $sql = "SELECT * FROM cumf WHERE cu_status = 1";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
            ?>
               <option value="<?php echo $row["cu_id"];?>"><?php echo $row["cu_name"];?></option>
               <?php } ?>
           
           </datalist><br>
           <p1>Quantity: </p1><input onkeyup="getPrice()" onkeydown="getPrice()" onfocus="getPrice()" value="1" id="qty" step="0.0001" type="number" required onfocus="this.select()">
       </span><br>
       <span id="hidden" hidden></span>
       <span id="showValues" hidden>
           <p1>Price: </p1><input disabled id="price"><br>
           <p1>Discount: </p1><input disabled id="disc"><br>
           <p1>Flag: </p1><input disabled id="flag"><br>
           <p1>Net Value EA: </p1><input disabled id="netea"><br>
           <p1>Net Value: </p1><input disabled id="net"><br>
           <p1>Value inc. GST (<?php echo $gn_tax;?>): </p1><input disabled id="tax"><br>
       </span>
    </div>
    
    </body>
    <script>
    var sku = document.getElementById("sku");
    var cust = document.getElementById("cust");
    var qty = document.getElementById("qty");
        function showCust() {
            if (sku.value !=="") {
                document.getElementById("custSpan").style.display = "block";
            }
            else {
                document.getElementById("custSpan").style.display = "none";
            }
        }
        
      
     function getPrice() {
          
          var x = document.getElementById("hidden");
             var sku = document.getElementById("sku");
    var cust = document.getElementById("cust");
    var qty = document.getElementById("qty");
    if (cust.value == "") {

   
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
                x.innerHTML = this.responseText;
            
            }
        };
        xmlhttp.open("GET","/sp/ajax/sp_getPrice.php?q="+cust.value+"&p="+sku.value+"&c="+qty.value,true);
        xmlhttp.send();
         storeValues();
    }
}
   
    function storeValues() {
        var x = document.getElementById("flagM");
        var y = document.getElementById("gPrice");
        var z = document.getElementById("gDisc");
        var a = document.getElementById("flag");
        var b = document.getElementById("price");
        var c = document.getElementById("disc");
        var span = document.getElementById("showValues");
        var net = document.getElementById("net");
        var netea = document.getElementById("netea");
        var qty = document.getElementById("qty");
        var tax = document.getElementById("tax");
        span.style.display = "block";
        a.value = x.value;
        b.value = "$"+y.value;
        if (z) {
        c.value = z.value;
        }
        else {
            c.value = '0';
        }
        var calc = ((100-c.value)/100)*y.value;
        net.value = "$"+(calc*qty.value).toFixed(2);
        tax.value = "$"+((calc*qty.value)*<?php echo $gn_taxval;?>).toFixed(2);
       netea.value = "$"+calc.toFixed(2);
    }
    </script>
    
</html>