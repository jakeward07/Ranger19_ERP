<?php include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
$i = $_GET['i'];
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Invoice</title>
    <link rel="stylesheet" type="text/css" href="/erp/styling/invoice.css">
    </head>
<body>
    <table>
    <thead>
    <?php $sql = "SELECT * FROM stmf s INNER JOIN bdmf b ON b.bd_id = s.st_brand WHERE s.st_code = $site_cd ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
      ?>
        <thead>
        <tr>
            <th><img src="<?php echo $row["bd_logo"];?>" class="logo"></th>
            <th><h3><?php echo $row["st_name"];?></h3><br>
            <h4>ABN: <?php echo $row["bd_abn"];?></h4><br>
            <h4>ACN: <?php echo $row["bd_acn"];?></h4>
            </th>
            <th><h3>Phone: <?php echo $row["st_phone"];?></h3><br><?php echo $row["st_addr"], ', ', $row["st_sub"], ', ', $row["st_pstcd"], ' ', $row["st_state"];?></th>
            </tr>
            
           <tr>
            <th></th>
            <th><h1>INVOICE <?php echo $i,'-',$site_cd?></h1></th>
            <th></th>
            </tr>
            </table>
        <table class="details">
            <?php $sql = "SELECT * FROM invh WHERE vh_inv = $i AND vh_site = $site_cd LIMIT 1";
                $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $d1 = strtotime($row["vh_timestamp"]);
                $date = date("d/m/Y g:ia", $d1);
      ?>
            <tr>
            <th>Sales Order: <?php echo $row["vh_order"],'-',$row["vh_site"];?></th>
            <th>Sales Person: <?php echo $row["vh_user"];?></th>
            <th>Purchase Order: <?php if (!empty($row["vh_po"])) {echo $row["vh_po"];} else {echo "Not Supplied";}?></th>
            <th>Job Reference: <?php if (!empty($row["vh_job"])) {echo $row["vh_job"];} else {echo "Not Supplied";}?></th>
            <th>Invoice Date: <?php echo $date;?></th>
            
            </tr>
            <?php }}?>
        </table>
        </thead>
        <tbody>
        <table class="linesTable" style="margin-top:20px">
            <tr>
            <th>Product Code</th>
            <th>Description</th>
            <th>Quantity</th>
            <th>Per</th>
            <th>Net Price</th>
            <th>Extended Value</th>
            
            </tr>
            
            <?php 
                $sql = "SELECT * FROM invl l INNER JOIN orln o ON o.ln_order = l.vl_order AND o.ln_site = $site_cd WHERE l.vl_inv = $i AND l.vl_site = $site_cd GROUP BY l.vl_sku";
               $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                ?>
            <tr>
            <td><?php echo $row["vl_sku"];?></td>
            <td><?php echo $row["vl_desc"];?></td>
            <td><?php echo $row["vl_qty"];?></td>
            <td><?php echo $row["ln_per"];?></td>
            <td>$<?php echo $row["vl_price"];?></td>
            <td>$<?php echo number_format(($row["vl_price"]*$row["vl_qty"])/$row["ln_per"],4, ".", "");?></td>
            </tr>
            <?php
            }}?>
            </table>
        
        
        
        
        </tbody>
        
<div class="wrapper">
        <tfoot>
        <table class="total">
          <?php 
                $sql = "SELECT * FROM invh WHERE vh_inv = $i AND vh_site = $site_cd";
                  $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                ?>
            <tr>
            <th>Total excl GST: </th>
            <th>$<?php echo number_format($row["vh_amtex"],2);?></th>
            </tr>
            <th>GST: </th>
            <th>$<?php echo number_format($row["vh_amtinc"]-$row["vh_amtex"],2);?></th>
            </tr>
            <th>Total incl GST: </th>
            <th>$<?php echo number_format($row["vh_amtinc"],2);?></th>
            </tr>
          
            <?php }}?>
            
            
            </table>
        
        </tfoot>
    </div>        
        <?php
            }
        }
    ?>
   
    
        
    </body>
    
    
</html>