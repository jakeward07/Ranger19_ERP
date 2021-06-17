<?php
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
$q = $_GET["q"];
$date = date("Y-m-d");
//Fetch last sales order # and add 1 (x+1)
$sql = "SELECT * FROM orhd WHERE oh_site = $site_cd ORDER BY oh_order DESC LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
       //Define Variable
        $s_ord = $row["oh_order"]+1;
    }}
//Create order header
$sql = "INSERT INTO orhd (oh_order, oh_site, oh_cust, oh_cuname, oh_user, oh_status, oh_stampuser) (SELECT '$s_ord','$site_cd', es_cust, es_cuname, es_user, 'Open', '$usernm' FROM eshd WHERE es_quote = $q AND es_site = $site_cd)";
$conn->query($sql);
//Get total for the below "for" statement
$sql = "SELECT count(el_sku) AS count FROM esln WHERE el_quote = $q AND el_site = $site_cd";
   $result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $total = $row["count"];  
    }}
//Set Lines Arrays
$line = "SELECT * FROM esln WHERE el_quote = $q AND el_site = $site_cd";
$result = $conn->query($line);
while($row = mysqli_fetch_array($result)) {
    $sku_arr[] = $row["el_sku"];
    $qty_arr[] = $row["el_qty"];
}
for ($x = 0; $x < $total; $x++) {
    $qty = $qty_arr[$x];
    $sku = $sku_arr[$x];
    $sql = "SELECT * FROM imwh WHERE wh_site = $site_cd AND im_id = (SELECT im_id FROM immf WHERE im_sku = '$sku')";
    $result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $stkAvail = $row["wh_stk"]-$row["wh_alloc"];
        if ($stkAvail > $qty) {
            //Full stock available
           $sql = "INSERT INTO orln (ln_reqdate, ln_order, ln_site, ln_sku, ln_desc, ln_per, ln_oqty, ln_alloc, ln_bor, ln_listprice, ln_disc, ln_netprice, ln_val, ln_marg, ln_onotes, ln_cnotes, ln_stampuser) (SELECT '$date', '$s_ord','$site_cd', el_sku, el_desc, el_per, el_qty, el_qty, 0, el_price, el_disc, el_netprice, el_netprice*el_qty, el_marg, el_onote, el_cnote, '$usernm' FROM esln WHERE el_quote = $q AND el_site = $site_cd AND el_sku = '$sku')";
            $conn->query($sql);
            //Update imwh
            $sql = "UPDATE imwh SET wh_alloc = wh_alloc+$qty WHERE wh_site = $site_cd AND im_id = (SELECT im_id FROM immf WHERE im_sku = '$sku')";
            $conn->query($sql);
        }
        else {
            //Stock levels are below qty required
            $sql = "INSERT INTO orln (ln_reqdate, ln_order, ln_site, ln_sku, ln_desc, ln_per, ln_oqty, ln_alloc, ln_bor, ln_listprice, ln_disc, ln_netprice, ln_val, ln_marg, ln_onotes, ln_cnotes, ln_stampuser) (SELECT '$date', '$s_ord','$site_cd', el_sku, el_desc, el_per, el_qty, $stkAvail, el_qty-$stkAvail, el_price, el_disc, el_netprice, el_netprice*el_qty, el_marg, el_onote, el_cnote, '$usernm' FROM esln WHERE el_quote = $q AND el_site = $site_cd AND el_sku = '$sku')";
            $conn->query($sql);
            //Update imwh 
            $sql = "UPDATE imwh SET wh_alloc = wh_alloc+$stkAvail, wh_bor = wh_bor+($qty-$stkAvail) WHERE wh_site = $site_cd AND im_id = (SELECT im_id FROM immf WHERE im_sku = '$sku')";
            $conn->query($sql);
            //Create BOR record
            $sql = "INSERT INTO borp (bo_order, bo_sku, bo_qty, bo_bor, bo_state, bo_user) (SELECT $s_ord, '$sku', '$qty', '$qty-$stkAvail', 1, es_user FROM eshd WHERE es_quote = $q AND es_site = $site_cd LIMIT 1)";
            $conn->query($sql);
            echo $conn->error;
        }
    }}
    echo "<script>location.replace('/oe/action/oe_lines.php?update=true&o=$s_ord&seq=0');</script>";
    

   
}


?>