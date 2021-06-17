<?php 
$prog = "im_stktstat";
$mod = "im";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>Stocktake Status - RANGER 5</title>
    </head>
<body>
<h1>Stocktake Statuses</h1>
    <div class="center"><form action="" method="post"><p1>Show: </p1><select onchange="this.form.submit()" name="show">
         <option <?php if (!empty($_POST)) {if ($_POST["show"] =="All") {echo "selected";}} ?> value="All">All</option>
        <option <?php if (!empty($_POST)) {if ($_POST["show"] =="Active") {echo "selected";}} ?> value="Active">Active</option>
        <option <?php if (!empty($_POST)) {if ($_POST["show"] =="Open") {echo "selected";}} ?> value="Open">Open</option>
        <option <?php if (!empty($_POST)) {if ($_POST["show"] =="Posted") {echo "selected";}} ?> value="Posted">Posted</option>
        <option <?php if (!empty($_POST)) {if ($_POST["show"] =="Purged") {echo "selected";}} ?> value="Purged">Purged</option>
        
        </select></form></div>
     <table class="table" id="table">
    <tr class="tr">
         <th class="th">Stocktake ID</th>
         <th class="th">Date Started</th>
         <th class="th">Status</th>
         <th class="th">Type</th>
         <th class="th">User</th>
         </tr>
    <?php
    if (!empty($_POST)) {
        $p = $_POST["show"];
        if ($p !=="All") {
      $sql = "SELECT * FROM sthd WHERE st_status = '$p' AND st_site = $site_cd ORDER BY st_code DESC";    
        } else {
              $sql = "SELECT * FROM sthd WHERE st_site = $site_cd ORDER BY st_code DESC";
        }
    } else {
          $sql = "SELECT * FROM sthd WHERE st_site = $site_cd ORDER BY st_code DESC";
    }
         $result = $conn->query($sql);
         if ($result->num_rows > 0) {
             while($row = $result->fetch_assoc()) {
         $d = strtotime($row["st_timestamp"]);
        $date = date("d/m/Y - g:ia", $d);
         ?>
         <tr class="tr">
         <td class="td"><?php echo $row["st_code"];?></td>
         <td class="td"><?php echo $date;?></td>
         <td class="td"><?php echo $row["st_status"];?></td>
         <td class="td"><?php if ($row["st_cyclicflag"] ==1) {echo "Cyclic Stocktake";} elseif ($row["st_cyclicflag"] ==2) {echo "Full Stocktake";}?></td>
         <td class="td"><?php echo $row["st_stampuser"];?></td>
         
         </tr>
         
         <?php }
         } else {
             echo "<script>document.getElementById('table').style.display = 'none';</script>";
             echo "<h1>No results match your query.</h1>";
         }
         ?>
         
    </table>
    
    
    </body>
</html>
