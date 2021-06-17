<?php
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
$id = 18;?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Stockcard Print - Ranger5</title>
    </head>
<style>
    body {
        font-family: sans-serif;
        
    }
@media print 
{
    @page {
      size: landscape; /* DIN A4 standard, Europe */
      margin:0;
    }
    html, body {
        width: 210mm;
        /* height: 297mm; */
        height: 282mm;
        font-size: 11px;
        background: #FFF;
        overflow:visible;
    }
    body {
        padding-top:15mm;
    }
}
    table {
        width: 100%;
        text-align: center;
    }
    h1, h3 {
        text-align: center;
    }
    .top h4 {
        position: fixed;
        top: 0;
        right: 20px;
    }
    
    .top h5 {
        position: fixed;
        top: 20px;
        right: 20px;
    }
    
    .top {
        width: 100%;
    }
    
    </style>
    <?php $sql = "SELECT * FROM stmf WHERE st_code = $site_cd";
    $result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
?><div class="top">
    <h1>Stockcard Print</h1>
    <h3>Stocktake ID: <?php echo $id?></h3>
   <h4 class="brand"><?php echo $row["st_name"];?></h4>
    <h5>Date: <?php echo date("d/m/Y");?></h5>
    
    </div>
    <?php }}?>
<table>
    <tr>
    <th>Product Code</th>
    <th>Product Description</th>
    <th>Standard Cost</th>
    <th>Your Count</th>
    </tr>
    
   
<?php
$sql = "SELECT * FROM stln WHERE ln_stkid = $id AND ln_site = $site_cd";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
?>
    <tr style="height:40px">
    <td><?php echo $row["ln_sku"];?></td>
    <td><?php echo $row["ln_desc"];?></td>
    <td><?php echo $row["ln_stdcst"];?></td>
    <td>_____________</td>
    </tr>
    <?php

    }
}
    
    ?>
    </html>
    </html>