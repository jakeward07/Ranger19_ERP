<?php 
$prog = "oe_credit";
$mod = "oe";
$pname = "Credit Note Entry";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title><?php echo $pname;?> - RANGER 5</title>
    </head>
<body>
<h1><?php echo $pname;?></h1>
<div class="center">
    <p1>Customer: </p1><input onkeyup="showInv()" autocomplete="off" autofocus id="cu_cust" list="cumf" required>
    <datalist id="cumf">
    <?php 
        $sql = "SELECT * FROM cumf";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                ?>
        <option value="<?php echo $row["cu_id"];?>"><?php echo $row["cu_name"];?></option>
        <?php }}?>
    
    </datalist><br>
    <span id="invoice" hidden>
    <p1>Invoice Number: </p1><input id="vh_inv" onkeyup="fetchInv()" type="tel" maxlength="6" autocomplete="off" required name="ch_inv"><br>
      
    </span>

    
    </div>
        <span style="width:100%; float:right;margin-top:50px" id="display"></span>
    
    </body>
    <script>
    //Show invoice span
        function showInv() {
            var x = document.getElementById("cu_cust");
            var y = document.getElementById("invoice");
            if (x.value.length > 5) {
                y.style.display = "block";
            }
            else {
                y.style.display = "none";
            }
        }
        //Fetch invoice data
     function fetchInv() {
          var o = document.getElementById("vh_inv");
         var p = document.getElementById("cu_cust");
          var x = document.getElementById("display");
          if (o.value.length ==6) {
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
        xmlhttp.open("GET","/oe/ajax/oe_credit1.php?q="+o.value+"&c="+p.value,true);
        xmlhttp.send();
         
    }
}}
      
       
    </script>
</html>
