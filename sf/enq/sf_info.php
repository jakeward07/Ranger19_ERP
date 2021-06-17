<?php 
$prog = "sf_info";
$mod = "sf";
$pname = "Ranger5 Information";
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
     <div class="searchBox" style="width:600px">
   
         <img src="/erp/resources/images/snakebite_logo_nobg.png" style="width:50%;margin-left:auto;margin-right:auto;display:block">
         <br><div class="center">
        <p1>Software Version: </p1> <input disabled value="1.0"><br>
        <p1>ERP Package: </p1> <input disabled value="Premium - All Modules"><br>
        <p1>Licensed to: </p1> <input disabled value="<?php echo $gn_name?>"><br>
        <p1>Tax Setting: </p1> <input disabled value="<?php echo $gn_tax?>"><br>
        <br>
         <h3>Additional Tools</h3><br>
         <a href="R5-FileCount.ps1" download><button class="submit">Server File Count</button></a>
         </div>
    </div>
    
    
    </body>
</html>
