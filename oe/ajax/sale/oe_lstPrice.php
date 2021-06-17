<?php
$c = $_GET["c"];
$p = $_GET["p"];
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');

if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}

mysqli_select_db($conn,"immf");

$sql="SELECT * FROM invh h INNER JOIN invl l ON l.vl_inv = h.vh_inv INNER JOIN orln o ON o.ln_order = l.vl_order WHERE h.vh_cust = $c AND h.vh_site = $site_cd AND l.vl_sku = '$p' ORDER BY h.vh_inv DESC LIMIT 1"; 

$result = mysqli_query($conn,$sql);
if ($result->num_rows > 0) {
while($row = mysqli_fetch_array($result)) {   
    $d = strtotime($row["vl_timestamp"]);
    $d1 = date("d/m/Y", $d);
?>
<div class="success" style="position:fixed; top:5px; left:0; right:0;z-index:5;margin-left:auto;margin-right:auto;display:inline-block;width:40%;text-align:center">List Price: $<?php echo number_format($row["ln_listprice"], 2);?> Discount: <?php echo number_format($row["ln_disc"],2);?>% Net Price: $<?php echo number_format($row["ln_netprice"],2);?> Date: <?php echo $d1;?> Qty: <?php echo number_format($row["vl_qty"],2);?></div>

<?php }}

?>