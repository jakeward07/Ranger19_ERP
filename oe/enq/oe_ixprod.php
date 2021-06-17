<?php 
$prog = "oe_ixprod";
$mod = "oe";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>Invoice Enquiry x Product - RANGER 5</title>
    </head>
<body>
<h1>Invoice Enquiry x Product</h1>
    <div class="center">
    <p1>Product Code: </p1><input onkeyup="javascript: if (this.value.length > 5) {
        getInv()}" id="input" autocomplete="off" autofocus required list="cumf">
        <datalist id="cumf">
        <?php
            $sql = "SELECT * FROM immf";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    ?>
            <option value="<?php echo $row["im_sku"];?>"><?php echo $row["im_desc"];?>
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
        xmlhttp.open("GET","/oe/ajax/oe_ixprod.php?q="+o.value,true);
        xmlhttp.send();
         
    }
}
    </script>
    
    </body>
</html>
