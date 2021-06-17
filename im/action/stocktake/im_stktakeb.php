<?php
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
$id = $_GET["id"];
//Lets select data from header
$sql = "SELECT * FROM sthd WHERE st_code = $id AND st_site = $site_cd";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $sp = $row["st_prodfrom"];
        $fp = $row["st_prodto"];
        $sl = $row["st_locfrom"];
        $fl = $row["st_locto"];
        $zero = $row["st_inczero"];
        $type = $row["st_cyclicflag"];
        if ($type ==1) {
          //Determined to be a cyclic
            if ((!empty($sp)) and (!empty($fp))) {
              if ($zero =="yes") {
                  $stln = "INSERT INTO stln (ln_stkid, ln_site, ln_sku, ln_stkoh, ln_avgcst, ln_stdcst, ln_stampuser) (SELECT '$id','$site_cd', i.im_sku, w.wh_stk, w.wh_avgcst, i.im_stdc, '$usernm' FROM immf i INNER JOIN imwh w ON w.im_id = i.im_id WHERE w.wh_site = $site_cd AND i.im_sku BETWEEN '$sp' AND '$fp')";
                  
                
              } else {
                  $stln = "INSERT INTO stln (ln_stkid, ln_site, ln_sku, ln_stkoh, ln_avgcst, ln_stdcst, ln_stampuser) (SELECT '$id','$site_cd', i.im_sku, w.wh_stk, w.wh_avgcst, i.im_stdc, '$usernm' FROM immf i INNER JOIN imwh w ON w.im_id = i.im_id WHERE w.wh_stk > 0 AND w.wh_site = $site_cd AND i.im_sku BETWEEN '$sp' AND '$fp')";
              }
            }
            elseif ((!empty($sl)) and (!empty($fl))) {
                if ($zero =="yes") {
                  $stln = "INSERT INTO stln (ln_stkid, ln_site, ln_sku, ln_stkoh, ln_avgcst, ln_stdcst, ln_stampuser) (SELECT '$id','$site_cd', i.im_sku, w.wh_stk, w.wh_avgcst, i.im_stdc, '$usernm' FROM immf i INNER JOIN imwh w ON w.im_id = i.im_id WHERE w.wh_site = $site_cd AND w.wh_loc BETWEEN '$sl' AND '$fl')";
                }
                else {
                         $stln = "INSERT INTO stln (ln_stkid, ln_site, ln_sku, ln_stkoh, ln_avgcst, ln_stdcst, ln_stampuser) (SELECT '$id','$site_cd', i.im_sku, w.wh_stk, w.wh_avgcst, i.im_stdc, '$usernm' FROM immf i INNER JOIN imwh w ON w.im_id = i.im_id WHERE w.wh_stk > 0 AND w.wh_site = $site_cd AND w.wh_loc BETWEEN '$sl' AND '$fl')";
                }
            }
        }
        else if ($type ==2) {
        //Determined to be a full stocktake
            if ($zero =="yes") {
                $stln = "INSERT INTO stln (ln_stkid, ln_site, ln_sku, ln_stkoh, ln_avgcst, ln_stdcst, ln_stampuser) (SELECT '$id','$site_cd', i.im_sku, w.wh_stk, w.wh_avgcst, i.im_stdc, '$usernm' FROM immf i INNER JOIN imwh w ON w.im_id = i.im_id WHERE w.wh_site = $site_cd)";
            }
            else {
                  $stln = "INSERT INTO stln (ln_stkid, ln_site, ln_sku, ln_stkoh, ln_avgcst, ln_stdcst, ln_stampuser) (SELECT '$id','$site_cd', i.im_sku, w.wh_stk, w.wh_avgcst, i.im_stdc, '$usernm' FROM immf i INNER JOIN imwh w ON w.im_id = i.im_id WHERE w.wh_stk > 0 AND w.wh_site = $site_cd)";
            }
        }
        $conn->query($stln);
        echo $conn->error;
    }
}