<?php 
$prog = "oe_inv";
$mod = "oe";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>Invoice Enquiry - RANGER 5</title>
    </head>
<body>
<h1>Invoice Enquiry</h1>
    <div class="center">
    <p1>Invoice Number: </p1><input onkeyup="javascript: if (this.value.length==6) {
        getInv()}" id="input" type="tel" maxlength="6" autocomplete="off" autofocus required>
    
    </div> 
    <span id="display"></span>
    <script>
     function getInv() {
          var o = document.getElementById("input");
          var x = document.getElementById("display");
          
    if (o.value == "") {

   
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
        xmlhttp.open("GET","/oe/ajax/oe_inv.php?q="+o.value,true);
        xmlhttp.send();
         
    }
}
    </script>
    
    </body>
</html>
