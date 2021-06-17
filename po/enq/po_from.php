<?php 
$prog = "po_from";
$mod = "po";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>Purchase From Enquiry - RANGER 5</title>
    </head>
<body>
<h1>Product x Supplier Enquiry</h1>
     <div class="center">
         
         <p1>Product Code: </p1><input type="text" onkeyup="getSupp()" name="im_sku" id="im_sku" required autofocus autocomplete="off"><br>
          </div>
  <span id="enq"></span>
    
    </body>
    <script>
    
    function getSupp() {
          var x = document.getElementById("im_sku");
          var y = document.getElementById("enq");
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
              y.innerHTML = this.responseText;
            
            }
        };
        xmlhttp.open("GET","/po/ajax/get_supp.php?q="+x.value,true);
        xmlhttp.send();
         
    }
}
    
    
    </script>
</html>
