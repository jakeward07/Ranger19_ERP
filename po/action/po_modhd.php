<?php 
$prog = "po_modhd";
$mod = "po";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
if ($po == "0.00") {
    echo "<script>location.replace('/erp/error_pages/access_error.php')</script>";
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>Purchase Order Modification - RANGER 5</title>
    </head>
<body>
<h1>Purchase Order Modification</h1>
<form action="po_modln.php" method="get">

    <div class="left">  <input name="x" value="0" hidden>
    <p1>Order Number: </p1><input id="input" onblur="checkStat()" onkeyup="fetchPo()" name="o" required autocomplete="off" type="tel" maxlength="6" autofocus>
    </div>
    <span id="display"></span></form>
<script>
  
    function fetchPo() {
          var x = document.getElementById("input");
        
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
                document.getElementById("display").innerHTML = this.responseText;
            
            }
        };
        xmlhttp.open("GET","/po/ajax/po_modhd.php?q="+x.value,true);
        xmlhttp.send();
       
    }
}
    
    function checkStat() {
        var x = document.getElementById("status");
        if (x.value =="Complete") {
            alert("This PO has been marked as Complete. Modification not allowed.");
            location.replace('po_modhd.php');
        }
    }
    

    
    </script>
    
    </body>
</html>
