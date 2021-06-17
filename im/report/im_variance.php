<?php 
$prog = "im_variance";
$mod = "im";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>Stocktake Variance Report - RANGER 5</title>
    </head>
<body>
<h1>Stocktake Variance Report</h1>
     <div class="center">
    <form action="/im/report/im_stktkvariance.php" method="post">
         <p1>Stocktake ID: </p1><input name="st_code" value="<?php 
             $sql = "SELECT st_code FROM sthd WHERE st_site = $site_cd AND st_status = 'Active' ORDER BY st_code DESC LIMIT 1";
             $result = $conn->query($sql);
             if ($result->num_rows > 0) {
             while($row = $result->fetch_assoc()) {
             echo $row["st_code"]; }}?>" id="code" required type="number" autocomplete="off" autofocus><br>
         <p1>Order By: </p1><input name="orderBy" required type="number" autocomplete="off"><br>
         
         <button type="submit" class="submit">Generate Report &rarr;</button><br><br>
         <span hidden id="flag"><p1>Flag: </p1><input value="Most recent stocktake selected." disabled></span>
         </form>
    
    </div>
    <script>
    window.onload = function selectCode() {
        var x = document.getElementById("code");
        var y = document.getElementById("flag");
        if (x.value !=="") {
           y.style.display = "block";
            x.select();
        }
        else {
            y.style.display = "none";
        }
    }
    </script>
    
    </body>
</html>
