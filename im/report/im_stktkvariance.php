<!DOCTYPE HTML>
<html>
<head>
    <title>Stocktake Variance Report</title>
    <link rel="stylesheet" type="text/css" href="/erp/styling/reporting.css">
    </head>
<body>

<?php
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
$id = $conn->real_escape_string($_POST["st_code"]);

//Ensure result actually exists
$sql = "SELECT * FROM sthd WHERE st_code = $id AND st_status = 'Active' AND st_site = $site_cd LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        //Get branch details
        $sql = "SELECT * FROM stmf WHERE st_code = $site_cd LIMIT 1";
        $result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
       ?>
<table>
    <thead>
    <tr>
        <th><h4>Ranger5 ERP</h4></th>
        <th><h2>Stocktake Variance Report</h2></th>
        <th><h4><?php echo $row["st_name"];?></h4></th>
       
        </tr>
    <tr>
    <td><h4><?php echo date("l d/m/Y G:i:s");?></h4></td>
     <td><h4>Stocktake ID: <?php echo $id;?></h4></td>
    <td><h4><?php echo $usernm;?></h4></td>
    </tr>
    <tr>
        <td style="border-bottom:dashed;"></td>
        <td style="border-bottom:dashed;"></td>
        <td style="border-bottom:dashed;"></td>
    
    </tr>
    </thead>
     </table>
    <table class="linesTable">
<thead>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
 <tr>
     <th>Product Code</th>
     <th>Description</th>
     <th>Physical Count</th>
     <th>System QOH</th>
     <th>Variance</th>
     <th>Variance $</th>
     <th>Recount</th>
     
     </tr>
        </thead>
<tbody>
<?php
        $sql = "SELECT * FROM stln WHERE ln_stkid = $id AND ln_site = $site_cd AND NOT ln_stkct = 0";
        $result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
    $qty = $row["ln_stkct"]-$row["ln_stkoh"];
    $varA = $row["ln_avgcst"]*$qty;
    $varS = $row["ln_stdcst"]*$qty;
        
    ?>
    <tr class="lines">
    <td><?php echo $row["ln_sku"];?></td>
    <td><?php echo $row["ln_desc"];?></td>
    <td><?php echo number_format($row["ln_stkct"],2,".", "");?></td>
    <td><?php echo number_format($row["ln_stkoh"],2,".", "");?></td>
    <td><?php
                                          if ($row["ln_stkoh"] < $row["ln_stkct"]) {
                                              echo "+", number_format($qty,2,".", "");
                                          }
                                          else {
                                              echo number_format($qty,2,".", "");
                                          }?></td>
        <td>$<?php if ($row["ln_avgcst"] >0) {
                                            
                                              echo number_format($varA,2);
                                          } else {echo number_format($varS,2);}  ?></td>
        <td style="border-bottom:solid"></td>
    
    </tr>
     <?php 
          
        
    }} else {echo "<script>alert('No counts exist! Please enter counts');location.replace('/im/report/im_variance.php');</script>";}
      
    ?> 

    </tbody></table> 
    <table>
        <tfooter>
       <?php $sql = "SELECT sum(ln_stkoh-ln_stkct) AS sum1, sum((ln_stkoh-ln_stkct)*ln_avgcst) AS sum2 FROM stln WHERE ln_stkid = $id AND ln_site = $site_cd LIMIT 1";
        $result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) { ?>
     <tr>
           <th></th>
           <th></th>
           <th></th>
           <th>Total Variance: <?php echo number_format($row["sum1"], 2);?></th>
           <th>Total Variance : $<?php echo number_format($row["sum2"], 2);?></th>
            </tr>
    </tfooter></html>
<?php
    }}}}
        ?>











<?php 
      
    }
} else {
    echo "<script>alert('There has been an error!'); location.replace('/im/report/im_variance.php');</script>";
}?>
    
      </body></html>