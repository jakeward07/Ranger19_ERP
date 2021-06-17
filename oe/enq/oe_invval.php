<?php 
$prog = "oe_invval";
$mod = "oe";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>Invoice Value - RANGER 5</title>
    </head>
<body>
<h1>Invoice Value Enquiry</h1>
     <div class="center">
    <p1>Date From: </p1> <input type="date" id="date1" required value="<?php echo date("Y-m-d");?>"><br>
    <p1>Date To: </p1> <input type="date" id="date2" required value="<?php echo date("Y-m-d");?>"><br>
         <button type="button" class="submit" onclick="fetchFigures()">Fetch Figures &rarr;</button>
    
    </div>
    <span id="display"></span>
     <script>
         window.onload = fetchFigures();
 function fetchFigures() {
          var o = document.getElementById("date1");
          var p = document.getElementById("date2");
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
        xmlhttp.open("GET","/oe/ajax/oe_invval.php?d1="+o.value+"&d2="+p.value,true);
        xmlhttp.send();
         
    }
}
    </script>
    </body>
</html>
