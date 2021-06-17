<?php 
$prog = "sf_myprofile";
$mod = "sf";
$pname = "My Profile";
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
    <div class="bodystrip">
    <a href="/sf/maint/sf_changepassword.php"><button>Change Password &rarr;</button></a>
    </div>
    <div class="left">
    <p1>Username: </p1><input value="<?php echo $usernm;?>" disabled><br>
    <p1>Name: </p1><input value="<?php echo $name;?>" disabled><br>
    <p1>Default Site: </p1><input value="<?php echo $site_cd;?>" disabled><br>
    
    </div> 
    <div class="right">
    <p1>PO Limit: </p1><input value="$<?php echo number_format($po, 2)?>" disabled><br>
    <p1>Stock Adjust: </p1><input value="<?php if ($stkadj ==1) {echo "Yes";} else {echo "No";}?>" disabled><br>
    <p1>Email Address: </p1><input value="<?php echo $email?>" disabled><br>
    
    </div>
    
    
    </body>
</html>
