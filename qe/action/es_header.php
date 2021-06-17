<?php 
$prog = "es_header";
$mod = "es";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>Quote Entry Header - RANGER 5</title>
    </head>
<body>
<h1>Quote Entry Header</h1>
    <form action="" method="post">
     <div class="center">
    <p1>Customer: </p1><input onblur="disableCust()" id="cust_id" onkeyup="header()" name="es_cust" list="cumf" autocomplete="off" autofocus>
         <datalist id="cumf">
         <?php
             $sql = "SELECT * FROM cumf";
             $result = $conn->query($sql);
             if ($result->num_rows > 0) {
                 while($row = $result->fetch_assoc()) {
                     ?>
             <option onclick="header()" value="<?php echo $row["cu_id"];?>"><?php echo $row["cu_name"];?></option>
             <?php
                 }
             }
         ?>
         </datalist>
  </div>
        <span id="display"></span>  </form>
    <?php if (!empty($_POST)) {
  $sql = "SELECT es_quote FROM eshd WHERE es_site = $site_cd ORDER BY es_quote DESC LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $quote = $row["es_quote"]+1;
            $cust = $conn -> real_escape_string($_POST["es_cust"]);
            $name = $conn -> real_escape_string($_POST["es_cuname"]);
            $ad = $conn -> real_escape_string($_POST["es_addr"]);
            $sub = $conn -> real_escape_string($_POST["es_sub"]);
            $pc = $conn -> real_escape_string($_POST["es_pc"]);
            $st = $conn -> real_escape_string($_POST["es_state"]);
            $tit = $conn -> real_escape_string($_POST["es_title"]);
            $type = $conn -> real_escape_string($_POST["es_type"]);
            $exp = $conn -> real_escape_string($_POST["es_expdate"]);
            $us = $conn -> real_escape_string($_POST["es_user"]);
            $sql2 = "INSERT INTO eshd (es_quote, es_site, es_cust, es_cuname, es_addr, es_sub, es_pc, es_state, es_title, es_type, es_expdate, es_user, es_stampuser) VALUES ('$quote','$site_cd','$cust','$name', '$ad','$sub','$pc','$st','$tit','$type','$exp','$us','$usernm')";
            $conn->query($sql2);
          echo "<script>location.replace('es_lines.php?q=$quote&c=$cust');</script>";
        }
    }
} ?>
    <script>
   function header() {
              var x = document.getElementById("cust_id");
          
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
                document.getElementById("display").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","/qe/ajax/es_header.php?q="+x.value,true);
        xmlhttp.send();
         
    }
    }
        
        function disableCust() {
            if (document.getElementById("cust_id").value !=="") {
            document.getElementById("cust_id").disabled = true;
            document.getElementById("es_cust").value = document.getElementById("cust_id").value;
        }
            else {
              document.getElementById("cust_id").disabled = false;   
            }}
     
    </script>
    
    </body>
</html>
