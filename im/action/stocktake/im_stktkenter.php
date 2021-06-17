<?php 
$prog = "im_stktkenter";
$mod = "im";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>Stocktake Counts Entry - RANGER 5</title>
    </head>
<body>
<h1>Stocktake Counts Entry</h1>
    <form action="" method="post">
     <div class="center">
    <p1>Stocktake ID: </p1><input id="stocktakeID" name="st_code" type="number" autocomplete="off" autofocus required><br>
    <p1>Hash: </p1><input id="hash" name="st_hash" onkeyup="getStockCount()" type="number" autocomplete="off" required><br>
    </div>
    <span id="display"></span>
        <span id="submitBut" hidden><button style="float:right;" type="submit" class="submit">Submit Counts &rarr;</button></span>
    </form>
    <script>
     function getStockCount() {
          var o = document.getElementById("stocktakeID");
          var x = document.getElementById("display");
          
    if (o.value == "") {

   
        return;
    } else {
            document.getElementById("submitBut").style.display = "block";
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
        xmlhttp.open("GET","/im/ajax/im_stktkenter.php?q="+o.value,true);
        xmlhttp.send();
         
    }
}
        
    </script>
    </body><?php if (!empty($_POST)) {
    //Define Variables
    $total = count($_POST['count']);
    $count_arr = $_POST["count"];
    $sku_arr = $_POST["sku"];
    for($i = 0; $i < $total; $i++) {
        $count = $count_arr[$i];
        $sku = $sku_arr[$i];
        $sql = "UPDATE stln SET ln_stkct = '$count' WHERE ln_sku = '$sku' AND ln_stkid = '$_POST[st_code]' AND ln_site = '$site_cd'";
        $conn->query($sql);
        echo $conn->error;
       
    }
    }
 ?>


    </html>