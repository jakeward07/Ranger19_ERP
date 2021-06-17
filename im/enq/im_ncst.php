<?php 
$prog = "im_ncst";
$mod = "im";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>National Cost Enquiry - RANGER 5</title>
    </head>
<body >
<h1>National Cost Enquiry</h1>
    <div class="center">
    <p1>Product Code: </p1><input
                                  <?php if (!empty($_GET["sku"])) {echo "value='$_GET[sku]'";}?>
                                  
                                  autocomplete="off" onkeyup="getNstk()" id="im_sku" autofocus required type="text">
  
    </div> 
    <span id="showStk"></span> 
    
    </body>
    <script>
    function getNstk() {
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
                document.getElementById("showStk").innerHTML = this.responseText;
                 document.getElementById("desc").value = "Sd";
            }
        };
        xmlhttp.open("GET","/im/ajax/im_ntcstb.php?q="+x.value,true);
        xmlhttp.send();
         
    }
    }
        <?php if (!empty($_GET)) { ?>
        
        window.onload = function getNstk() {
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
                document.getElementById("showStk").innerHTML = this.responseText;
               
            }
        };
        xmlhttp.open("GET","/im/ajax/im_ntcstb.php?q="+x.value,true);
        xmlhttp.send();
         
    }
        }
        <?php } ?>
    
    </script>
</html>
