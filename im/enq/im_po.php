<?php 
$prog = "im_po";
$mod = "im";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>PO x Product - RANGER 5</title>
    </head>
<body>
    <h1>Outstanding PO vs Product</h1>
<div class="center">
    <p1>Product Code: </p1><input id="sku"
                                  <?php if (!empty($_GET)) {echo "value=$_GET[sku]";}?>
                                  required onkeyup="getPo()">
    
    </div>
     <span id="show"></span>
   
     <script>
         
   <?php if (!empty($_GET)) {echo "window.onload =";} ?>  function getPo() {
              var x = document.getElementById("sku");
          
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
                document.getElementById("show").innerHTML = this.responseText;
                
            }
        };
        xmlhttp.open("GET","/im/ajax/im_po.php?q="+x.value,true);
        xmlhttp.send();
         
    }
    }
    
    </script>
    
    </body>
</html>
