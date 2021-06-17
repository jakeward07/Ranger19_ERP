<?php 
$prog = "im_binl";
$mod = "im";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>Bin Location Maintenance - RANGER 5</title>
    </head>
<body>
<h1>Bin Location Maintenance</h1>
     <table class="table">
    <tr class="tr">
        <th class="th">Location</th>
        <th class="th">Name</th>
        <th class="th">Created</th>
        <th class="th">Action</th>
         </tr>
         <?php 
         $sql = "SELECT * FROM imlc WHERE lc_site = $site_cd ORDER BY lc_loc";
         $result = $conn->query($sql);
         if ($result->num_rows > 0) {
             while($row = $result->fetch_assoc()) {
                 $d = strtotime($row["lc_timestamp"]);
                 $date = date("d/m/Y", $d);
                 ?>
         <tr class="tr">
         <td class="td"><?php echo $row["lc_loc"];?></td>
         <td class="td"><?php echo $row["lc_name"];?></td>
         <td class="td"><?php echo $date;?></td>
         <td class="td"><u id="modify">Modify</u> |  <u id="delete">Delete</u></td>
         </tr>
   
         <?php
             }
         }
         else {
             ?>
    
        <tr class="tr">
    <td colspan="4" class="td"><b>No bin locations exist for this site.</b></td>
    </tr>
    
         <?php
         }
    ?>
    </table>
    
    
    </body>
</html>
