<?php 
$prog = "oe_ixcust";
$mod = "oe";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>Invoice Enquiry x Customer - RANGER 5</title>
    </head>
<body>
<h1>Invoice Enquiry x Customer</h1>
    <div class="center">
    <p1>Customer Number: </p1><input onkeyup="javascript: if (this.value.length==6) {
        getInv()}" id="input" type="tel" maxlength="9" autocomplete="off" autofocus required list="cumf">
        <datalist id="cumf">
        <?php
            $sql = "SELECT * FROM cumf";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    ?>
            <option value="<?php echo $row["cu_id"];?>"><?php echo $row["cu_name"];?>
            <?php
                }
             } ?>
        </datalist>
    
    </div> 
    <span id="display"></span>
    <script>
     function getInv() {
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
        xmlhttp.open("GET","/oe/ajax/oe_ixcust.php?q="+o.value,true);
        xmlhttp.send();
         
    }
}
    </script>
    
    </body>
</html>
