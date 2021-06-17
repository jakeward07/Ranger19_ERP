<?php
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
$i = $_GET["i"];
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Invoice Generate</title>
    <link rel="icon" href="/erp/resources/icons/ranger%20logo.png">
    </head>
    <style>
    .table {
    width: 100%;
    text-align: center;
    margin-bottom: 100px;
}

.th, .td {

  padding: 8px;
    border-collapse: collapse;
    
}
        

.tr:nth-child(even) {background-color: #e1e1e1;}
body{
  -webkit-print-color-adjust:exact;
}
.tr:hover {cursor: pointer;
}

.table a {
    color: black;
    text-decoration: underline;
}
    
    </style>
    <body>
        <style>
            body {
                font-family: sans-serif;
            }
            .logo {
               width: 200px;
                height: 100px;
                float: left;
                margin: auto;
            }
            .logo img {
                max-width: 180px;
                max-height: 180px;
              margin-top: 25px
               
              
            }
            .header {
                float: left;
            }
            
            h1 {
                font-size: 20px
            }
            h3 {
                font-size: 15px;
            }
            .inv {
                float: right;
                margin-left: 80px;
                margin-top: -10px;
            }
            
            .space {
                padding-left: 50px;
            }
            
            @page { margin: 12px; }
            .total {
                margin-bottom: 20px;
                margin-right: 20px;
                border: solid;
                padding: 20px;
                border-radius: 10px;
                
            }
            @media print {
  @page { margin: 0; }
  body { margin: 1cm; }
}
        </style>
        <?php
                           $sql = "SELECT * FROM bdmf b INNER JOIN stmf s ON s.st_brand = b.bd_id WHERE s.st_code = $site_cd";
$result = $conn->query($sql);
                           if ($result->num_rows > 0) {
                               while($row = $result->fetch_assoc()) { ?>
        <div class="logo">
    <img src="<?php echo $row["bd_logo"];?>"></div>
        <div class="header">
        
            <h1><?php echo $row["st_name"];?></h1>
            <h3>P: <?php echo $row["st_phone"];?></h3>
            <h3>A: <?php echo $row["st_addr"], ', ', $row["st_sub"], ' ', $row["st_state"], ' ', $row["st_pstcd"];?></h3>
            <h4>ABN: <?php echo $row["bd_abn"];?> ACN: <?php echo $row["bd_acn"];?></h4>
            <?php
                }
            } ?>
        
        </div>
        <div class="inv">
            <?php 
          
            $sql = "SELECT * FROM invh v INNER JOIN cumf c ON c.cu_id = v.vh_cust INNER JOIN orhd o ON o.oh_order = v.vh_order AND o.oh_site = $site_cd WHERE v.vh_inv = $i AND v.vh_site = $site_cd";
            $result = $conn->query($sql);
                           if ($result->num_rows > 0) {
                               $d1 = strtotime($row["vh_timestamp"]);
                               $date = date("d/m/Y $d1");
                               $d2 = strtotime($row["oh_timestamp"]);
                               $date2 = date("d/m/Y $d2");
                               while($row = $result->fetch_assoc()) { ?>
        <h1 style="font-size:30px;text-align:center"><b>INVOICE</b></h1>
        <h2 style="margin-top:-10px;text-align:center"><?php echo $row["vh_inv"],'-',$row["vh_site"];?><br><?php echo $date;?></h2>
          
        </div><br>
        <div class="invDet" style="border:solid; border-radius:10px;float:left; width:100%;border-width: 2px; text-align:center; padding-top: 5px; padding-bottom: 5px">
        <b>Customer: </b> <?php echo $row["vh_cust"], ' - ', $row["cu_name"];?> <span class="space"></span>
            <b>PO Number: </b> <?php echo $row["vh_po"];?><span class="space"></span> 
            <b>Job Reference: </b> <?php echo $row["vh_job"];?>
            <span class="space"></span>
            <b>User: </b> <?php echo $row["vh_user"];?>
            <span class="space"></span><br>
            <b>Sales Order: </b> <?php echo $row["oh_order"],'-',$row["oh_site"];?> 
            <span class="space"></span>
            <b>Order Date: </b><?php echo $date2?>
            <b></b>
        </div>
        <?php }}?>
        <div class="lines">
            <table class="table" style="width: 100%; text-align:center">
            <tr class="tr">
                <th class="th">Product Code</th>
                <th class="th">Product Description</th>
                <th class="th">Order Qty</th>
                <th class="th">Shipped</th>
                <th class="th">Backorder</th>
                <th class="th">Price</th>
                <th class="th">GST</th>
                <th class="th">Line Value Ex. GST</th>
                </tr>
            
       
        <?php
            $sql = "SELECT * FROM invl l WHERE l.vl_inv = $i AND l.vl_site = $site_cd";
             $result = $conn->query($sql);
                           if ($result->num_rows > 0) {
                               while($row = $result->fetch_assoc()) { ?>
            <tr class="tr">
            <td class="td"><?php echo $row["vl_sku"];?></td>
            <td class="td"><?php echo $row["vl_desc"];?></td>
            <td class="td"><?php echo number_format($row["vl_oqty"],2);?></td>
            <td class="td"><?php echo number_format($row["vl_qty"],2);?></td>
            <td class="td"><?php echo number_format($row["vl_bor"],2);?></td>
            <td class="td">$<?php echo number_format($row["vl_price"],4);?></td>
            <td class="td">$<?php echo number_format(($row["vl_price"]*0.1),4);?></td>
            <td class="td">$<?php echo number_format($row["vl_price"]*$row["vl_qty"],2);?></td>
            
            </tr>
            <?php }}?>     </table>
            <div class="total" style="float:right;">
         <?php
                $sql = "SELECT * FROM invh WHERE vh_inv = $i";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        ?>
               <b>Total ex GST: </b> $<?php echo number_format($row["vh_amtex"],2);?><br>
               <b>Tax: </b> $<?php echo number_format($row["vh_amtex"]*0.1,2);?><br>
               <b>Grand Total: </b> $<?php echo number_format($row["vh_amtinc"],2);?>
                <?php }}?>
            </div>
        </div>
    </body>
</html>