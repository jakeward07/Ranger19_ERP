<?php 
$prog = "po_pena";
$mod = "po";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>PO Pending Approval - RANGER 5</title>
    </head>
<body>
<h1>Purchase Orders Pending Approval</h1>
     <table class="table">
    <tr class="tr">
         <th class="th">PO Number</th>
         <th class="th">Supplier</th>
         <th class="th">User</th>
         <th class="th">Action</th>
         </tr>
         <?php 
         $sql = "SELECT * FROM pohd h INNER JOIN sumf s ON s.su_code = h.ph_supp WHERE h.hd_stat = 'Pending' AND h.ph_site = $site_cd";
         $result = $conn->query($sql);
         if ($result->num_rows > 0) {
             while($row = $result->fetch_assoc()) {
                 ?>
         <tr class="tr">
         <td class="td"><?php echo $row["ph_order"], '-', $row["ph_site"];?></td>
         <td class="td"><?php echo $row["ph_supp"], ' - ', $row["su_name"];?></td>
         <td class="td"><?php echo $row["ph_user"];?></td>
             <td class="td"><a href="po_pena.php?o=<?php echo $row["ph_order"];?>&s=1">Approve</a> | <a href="po_pena.php?o=<?php echo $row["ph_order"];?>&s=2">Reject</a> | <a href="/po/enq/po_enq.php?po=<?php echo $row["ph_order"];?>">View PO</a> </td>
         
         </tr>
         
         
         <?php
             }
            
         } else {
                 echo "<h1>No Orders pending approval</h1>";
             }
         if (!empty($_GET)) {
             if ($_GET["s"] ==1) {
                 $sql = "UPDATE pohd SET hd_stat = 'Approved' WHERE ph_order = '$_GET[o]' AND ph_site = $site_cd";
             }
             elseif ($_GET["s"] ==2) {
                  $sql = "UPDATE pohd SET hd_stat = 'Rejected' WHERE ph_order = '$_GET[o]' AND ph_site = $site_cd";
             }
             $conn->query($sql);
             echo "<script>location.replace('po_pena.php');</script>";
         }
         
         
         ?>
         
    
    </body>
</html>
