<?php 
$prog = "oe_oxcust";
$mod = "oe";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>Open Order Enquiry - RANGER 5</title>
    </head>
<body>
<h1>Open Order vs Customer Enquiry</h1>
    <div class="center">
    <p1>Customer Number: </p1><input onkeyup="javascript: if (this.value.length >= 6) {
        getOrd()}" id="input" type="tel" maxlength="6" autocomplete="off" list="cumf" autofocus required>
    <datalist id="cumf">
        <?php
        $sql = "SELECT * FROM cumf";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) { ?>
        <option value="<?php echo $row["cu_id"];?>"><?php echo $row["cu_name"];?></option>
        <?php }
        } ?>
        
        
        </datalist>
    </div> 
    <span id="display"></span>
    <script>
     function getOrd() {
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
        xmlhttp.open("GET","/oe/ajax/oe_oxcust.php?q="+o.value,true);
        xmlhttp.send();
         
    }
}
    </script>
    
    </body>
</html>
