<?php
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
#$q = $_GET["q"];
$q = 300001;
//Fetch last sales order # and add 1 (x+1)
$sql = "SELECT * FROM orhd WHERE oh_site = $site_cd ORDER BY oh_order DESC LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
       //Define Variable
        $s_ord = $row["oh_order"]+1;
    }}

$sql = "SELECT * FROM esln WHERE el_quote = $q AND el_site = $site_cd";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
while($row = mysqli_fetch_assoc($result)) {
    $total = count($row["el_sku"]);
    $sku_arr = $row["el_sku"];
    $qty_arr = $row["el_qty"];
    $id_arr = $row["el_id"];
    for($i = 0; $i < $total; $i++) {
        $sku = $sku_arr[$i];
        $qty = $qty_arr[$i];
        foreach ($sku_arr as $sku2) {
        $sql = "SELECT * FROM imwh WHERE wh_site = $site_cd AND im_id = (SELECT im_id FROM immf WHERE im_sku = '$sku2')";
        $result = $conn->query($sql);
    echo "dsds";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $qqty = $row["wh_stk"]-$row["wh_alloc"];
            
        if ($qty > $qqty) {
            $sql = "INSERT INTO orln (ln_sku, ln_desc, ln_per, ln_oqty, ln_alloc, ln_bor, ln_netprice, ln_marg, ln_stampuser) (SELECT el_sku, el_desc, el_per, el_qty, el_qty, 0, el_price, el_marg, '$usernm' FROM esln WHERE el_quote = $q AND el_site = $site_cd)";
        }
        else {
           $sql = "INSERT INTO orln (ln_sku, ln_desc, ln_per, ln_oqty, ln_alloc, ln_bor, ln_netprice, ln_marg, ln_stampuser) (SELECT el_sku, el_desc, el_per, el_qty, $qqty, el_qty-$qqty, el_price, el_marg, '$usernm' FROM esln WHERE el_quote = $q AND el_site = $site_cd)"; 
        }
       echo $sku2;
    }
    
}}}}} ?>