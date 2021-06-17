<?php 
$prog = "ar_bal";
$mod = "ar";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>AR Balance Enquiry - RANGER 5</title>
    </head>
<body>
<h1>AR Balance Enquiry</h1>
    <div class="bodystrip">
        <span hidden id="statBut"><a id="stat"><button>Customer Balance Breakdown</button></a></span>
    
    </div>
     <div class="center">
    <p1>Customer Number: </p1><input id="input" onchange="fetchBal(); " onkeyup="fetchBal(); showBut(); calcAvail()" required autocomplete="off" autofocus list="cumf">
         <datalist id="cumf">
         <?php 
             $sql = "SELECT * FROM cumf";
             $result = $conn->query($sql);
             if ($result->num_rows > 0) {
                 while($row = $result->fetch_assoc()) {
                     ?>
             <option onclick="fetchBal()" value="<?php echo $row["cu_id"];?>"><?php echo $row["cu_name"];?></option>
             <?php
                 }
              }
         ?>
         </datalist>    </div>
    <span id="display"></span>

    
 <script>
     function fetchBal() {
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
        xmlhttp.open("GET","/ar/ajax/ar_bal.php?q="+o.value,true);
        xmlhttp.send();
         
    }
}
     
     function showBut() {
         var x = document.getElementById("input");
         var y = document.getElementById("statBut");
         var z = document.getElementById("cust");
         var c = document.getElementById("stat");
         if (!isNaN(x.value)) {
         if (x.value.length > 5) {
             y.style.display = "block";
             c.href = "ar_stat.php?c="+x.value;
         }}
         else {
             y.style.display = "none";
         }
     }
     
  



    </script>    
    </body>
</html>
