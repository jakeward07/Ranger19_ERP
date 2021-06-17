<?php 
$prog = "im_alloc";
$mod = "im";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>Allocated Products - RANGER 5</title>
    </head>
<body>
<h1>Allocated Products</h1>
     <div class="center">
    <p1>Product Code: </p1><input id="sku"
                                  <?php if (!empty($_GET)) {echo "value='$_GET[sku]'";}?>
                                  
                                  onkeyup="getAlloc()" required type="text" autofocus autocomplete="off">
  </div>
    <span id="alloc"></span>
    <script>
      function getAlloc() {
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
                document.getElementById("alloc").innerHTML = this.responseText;
                
            }
        };
        xmlhttp.open("GET","/im/ajax/im_alloc_b.php?q="+x.value,true);
        xmlhttp.send();
         
    }
    }
        <?php if (!empty($_GET)) { ?>
       window.onload = function getAlloc() {
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
                document.getElementById("alloc").innerHTML = this.responseText;
                
            }
        };
        xmlhttp.open("GET","/im/ajax/im_alloc_b.php?q="+x.value,true);
        xmlhttp.send();
        x.disabled = true;
        x.required = false;
         
    }
    } <?php } ?>
        
        
        
    
    </script>
    
    </body>
</html>
