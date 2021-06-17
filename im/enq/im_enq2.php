<?php 
$prog = "im_enq";
$mod = "im";
$pname = "Inventory Enquiry";
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
     <?php if (empty($_GET)) {
    ?><div class="blackout" style="z-index: -1"></div>
    <div class="searchBox" style="width: 600px;">
        <div class="center">
            <h1><?php echo $pname;?></h1>
    <form action="" method="get">
        <p1>Product Code: </p1><input
        
        
        </form>
        </div>
    
    </div>
    
<?php } ?>
    
    
    </body>
</html>
