<?php 
$prog = "po_rcpt";
$mod = "po";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>PO Receipting - RANGER 5</title>
    </head>
<body>
<h1>Receipt a Purchase Order</h1>
    <form action="" method="post">
     <div class="left">
         <p1>PO Number: </p1><input name="po_num" id="po" required autofocus type="tel" onkeyup="getSupp()" onkeydown="getSupp()" autocomplete="off" maxlength="6"><br>
    <span id="supp"> </span>
    
    </div><div class="right">
     <p1>Reference: </p1><input id="ref" autocomplete="off" onkeyup="showSub()" name="po_ref" required><br>
    <span id="submit" hidden><button type="submit" class="submit">Receipt Lines</button></span>
        </div> </form>
    <?php if (!empty($_POST)) {
    $sql = "UPDATE pohd SET ph_ref = '$_POST[po_ref]' WHERE ph_order = '$_POST[po_num]' AND ph_site = $site_cd";
    $conn->query($sql);
    echo "<script>location.replace('po_rcpt_b.php?o=$_POST[po_num]&r=$_POST[po_ref]&s=5');</script>";
}
    ?>
    <script>
     function getSupp() {
           
          var x = document.getElementById("po");
         
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
          document.getElementById("supp").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","/po/ajax/po_rcpt1.php?q="+x.value,true);
        xmlhttp.send();
         chkStat();
    }
}
        function chkStat() {
            var x = document.getElementById("status");
            if (x.value == "Rejected") {
                alert('This order has been rejected. Please see your manager.');
                location.replace('po_rcpt.php');
            }
            else if (x.value == "OPEN") {
                alert('This order has not been sent.');
                location.replace('po_rcpt.php');
            }
            else if (x.value =="Pending") {
                alert('This order is still Pending. Please consult your manager.');
                location.replace('po_rcpt.php');
            }
          else if (x.value == "Complete") {
              alert("This order has been receipted in full.");
              location.replace("po_rcpt.php");
          }
            else if (x.value =='Cancelled') {
                alert("This order has been cancelled.");
                location.replace("po_rcpt.php");
            }
        }
        
        function showSub() {
        var x = document.getElementById("submit");
        var y = document.getElementById("ref");
        if (y.value !=="") {
            x.style.display = "block";
        }
            else {
                x.style.display = "none";
            }
        }
    
    </script>
    
    </body>
</html>
