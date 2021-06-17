<?php 
$prog = "im_mvmt";
$mod = "im";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>Product Movements - RANGER 5</title>
    </head>
<body>
<h1>Product Movements</h1>
    <div class="center">
    <p1>Product Code: </p1><input id="im_sku" value="<?php
        if (!empty($_GET)) {
            echo $_GET["sku"];
        }
        ?>" onkeyup="getMvmt()" required autocomplete="off" autofocus>
    </div> 
       <span id="showMv"></span>
        <script>
    function getMvmt() {
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
                document.getElementById("showMv").innerHTML = this.responseText;
                 document.getElementById("desc").value = "Sd";
            }
        };
        xmlhttp.open("GET","/im/ajax/im_mvmtb.php?q="+x.value,true);
        xmlhttp.send();
         
    }
    }
        <?php if (!empty($_GET)) { ?>
        
        window.onload = function getMvmt() {
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
                document.getElementById("showMv").innerHTML = this.responseText;
               
            }
        };
        xmlhttp.open("GET","/im/ajax/im_mvmtb.php?q="+x.value,true);
        xmlhttp.send();
         
    }
        }
        <?php } ?>
    
    </script>
    
    </body>
</html>
