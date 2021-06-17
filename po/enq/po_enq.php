<?php 
$prog = "po_enq";
$mod = "po";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>PO Enquiry - RANGER 5</title>
    </head>
<body>
<h1>Purchase Order Enquiry</h1>
  <div class="bodystrip"><button type="button" onclick="enableField()">Change PO</button></div>
      
  <div class="center">
<p1>PO Number: </p1> <input onblur="disableField()" id="po" onkeyup="getPo()" name="po" required type="tel" autocomplete="off" <?php if (!empty($_GET)) {
    echo "value='$_GET[o]'";
} ?>
                            
                            autofocus maxlength="6" placeholder="Eg; 100123"><br>
    </div>
    <span id="false">
        <div class="left">
        <p1>Supplier: </p1><input disabled><br>
        <p1>Contract: </p1><input disabled><br>
</div>
        <div class="right">
        <p1>User: </p1><input disabled><br>
        <p1>Created Date: </p1><input  disabled><br>
        <p1>Status: </p1><input disabled>
        </div>
    </span>
  

    <span id="poDet"></span> 
    <span id="poLines"></span>
    <script>
    
<?php if (!empty($_GET)) {echo "window.onload = ";} ?>    function getPo() {
          var x = document.getElementById("po");
          var y = document.getElementById("poDet");
        var z = document.getElementById("false");
        
    if (x.value == "") {
z.style.display = "block";
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
               if (x.value.length == 6) {
                    z.style.display = "none";
               }
            else if (x.value.length < 6 || x.value.length == 0) {
                y.innerHTML = " ";
                z.style.display = "block";
               
            }
                
            }
        };
        xmlhttp.open("GET","/po/ajax/get_poenq.php?q="+x.value,true);
        xmlhttp.send();
        getLines();
         
    }
}
        <?php if (!empty($_GET)) {echo "window.onload = ";} ?>    function getLines() {
          var x = document.getElementById("po");
          var y = document.getElementById("poLines");
        var z = document.getElementById("false");
        
    if (x.value == "") {
z.style.display = "block";
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
        xmlhttp.open("GET","/po/ajax/po_enql.php?q="+x.value,true);
        xmlhttp.send();
         
    }
}
        
        function disableField() {
            document.getElementById("po").disabled = true;
            document.getElementById("po").required = false;
            
        }
        
         function enableField() {
            document.getElementById("po").disabled = false;
             document.getElementById("po").value = "";
             document.getElementById("po").focus();
             document.getElementById("po").required = true;
            
        }
    
    
    </script>
    
  
     
    
    
    </body>
</html>
