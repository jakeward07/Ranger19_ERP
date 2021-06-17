<?php
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
//Sanitise all data
$sku = $conn -> real_escape_string($_POST["a"]);
$desc = $conn -> real_escape_string($_POST["b"]);
$per = $conn -> real_escape_string($_POST["c"]);
$oqty = $conn -> real_escape_string($_POST["d"]);
$alloc = $conn -> real_escape_string($_POST["e"]);
$bor = $conn -> real_escape_string($_POST["f"]);
$list = $conn -> real_escape_string($_POST["g"]);
$disc = $conn -> real_escape_string($_POST["h"]);
$net = $conn -> real_escape_string($_POST["i"]);
$marg = $conn -> real_escape_string($_POST["j"]);
$order = $conn -> real_escape_string($_POST["k"]);
$cnotes = $conn -> real_escape_string($_POST["l"]);
$onotes = $conn -> real_escape_string($_POST["m"]);
$reqDate = $conn -> real_escape_string($_POST["n"]);
$cost = $conn -> real_escape_string($_POST["acost"]);
$uom = $conn -> real_escape_string($_POST["auom"]);
$type = $conn -> real_escape_string($_POST["o"]);
$id = $conn -> real_escape_string($_POST["p"]);

if (empty($type)) {
        //Execute orln insert query
        $sql = "INSERT INTO orln (ln_reqdate, ln_order, ln_site, ln_sku, ln_desc, ln_per, ln_oqty, ln_alloc, ln_bor, ln_listprice, ln_disc, ln_netprice, ln_marg, ln_cost, ln_onotes, ln_cnotes, ln_val, ln_stampuser, ln_uom) VALUES ('$reqDate','$order','$site_cd','$sku','$desc','$per','$oqty','$alloc','$bor','$list','$disc','$net','$marg','$cost','$onotes','$cnotes','$net*$oqty','$usernm','$uom')";
       $conn->query($sql);
        echo $conn->error;

//UPDATE imwh TABLE
$sql = "UPDATE imwh SET wh_alloc = wh_alloc+$alloc, wh_bor = wh_bor+$bor WHERE wh_site = $site_cd AND im_id = (SELECT im_id FROM immf WHERE im_sku = '$sku')";
$conn->query($sql);
}
else {
  
    //Update orln
    $sql = "UPDATE orln SET ln_reqdate = '$reqDate', ln_oqty = $oqty, ln_alloc = $alloc, ln_bor = $bor, ln_listprice = '$list', ln_disc = '$disc', ln_netprice = '$net', ln_marg = '$marg', ln_cost = '$cost', ln_onotes = '$onotes', ln_cnotes = '$cnotes', ln_val = '$net*$oqty', ln_maintuser = '$usernm' WHERE ln_order = '$order' AND ln_site = $site_cd AND ln_id = $id";
    $conn->query($sql);
    
    
    
}

