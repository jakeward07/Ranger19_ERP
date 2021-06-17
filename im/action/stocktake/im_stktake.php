<?php 
$prog = "im_stktake";
$mod = "im";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>Initiate Stocktake - RANGER 5</title>
    </head>
<body>
<h1>Initiate Stocktake</h1>
    <form action="" id="stForm" method="post">
    <div class="center">
    <p1>Cyclical or Full?: </p1><select autofocus id="cyclicalFlag" onchange="isFull()" name="st_cyclic" required>
        <option></option>
        <option value="1">Cyclical</option>
        <option value="2">Full Stocktake</option>
        </select><br>
        <p1>Starting Product: </p1><input id="sp" onkeyup="validateForm()" name="ln_prodfrom" autocomplete="off"><br>
        <p1>Ending Product: </p1><input id="fp" onkeyup="validateForm()"  name="ln_prodto" autocomplete="off"><br>
          <p1>Starting Location: </p1><input id="sl" onkeyup="validateForm()"  name="ln_locfrom" autocomplete="off"><br>
         <p1>Ending Location: </p1><input id="fl" onkeyup="validateForm()"  name="ln_locto" autocomplete="off"><br>
         <p1>Include Zero Stock?: </p1><select id="zero" name="ln_zerostk" required>
         <option></option>
         <option value="yes">Yes</option>
         <option value="no">No</option>
         </select><br>
        <button class="submit" type="submit">Create Stockcard &rarr;</button>
        </div>
  
    </form>
    <?php 
    if (!empty($_POST)) {
        //Sanitize Data
        $cFlag = $conn -> real_escape_string($_POST["st_cyclic"]);
        $sProd = $conn -> real_escape_string($_POST["ln_prodfrom"]);
        $tProd = $conn -> real_escape_string($_POST["ln_prodto"]);
        $sLoc = $conn -> real_escape_string($_POST["ln_locfrom"]);
        $tLoc = $conn -> real_escape_string($_POST["ln_locto"]);
        $zStk = $conn -> real_escape_string($_POST["ln_zerostk"]);
        //Get Stocktake ID
        $sql = "SELECT st_code FROM sthd WHERE st_site = $site_cd ORDER BY st_code DESC LIMIT 1";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                //Define variable
                $stID = $row["st_code"]+1;
               $sql2 = "INSERT INTO sthd (st_code, st_site, st_cyclicflag, st_prodfrom, st_prodto, st_locfrom, st_locto, st_inczero, st_stampuser) VALUES ('$stID','$site_cd','$cFlag','$sProd','$tProd','$sLoc','$tLoc','$zStk','$usernm')";
                $conn->query($sql2);
      //Insert into stln
       
        if ($cFlag ==1) {
          //Determined to be a cyclic
            if ((!empty($tProd)) and (!empty($sProd))) {
              if ($zStk =="yes") {
                  $stln = "INSERT INTO stln (ln_stkid, ln_site, ln_sku, ln_desc, ln_stkoh, ln_avgcst, ln_stdcst, ln_stampuser) (SELECT '$stID','$site_cd', i.im_sku, i.im_desc, w.wh_stk, w.wh_avgcst, i.im_stdc, '$usernm' FROM immf i INNER JOIN imwh w ON w.im_id = i.im_id WHERE w.wh_site = $site_cd AND i.im_sku >= '$sProd' AND i.im_sku <='$tProd')";
                  
                
              } else {
                  $stln = "INSERT INTO stln (ln_stkid, ln_site, ln_sku, ln_desc, ln_stkoh, ln_avgcst, ln_stdcst, ln_stampuser) (SELECT '$stID','$site_cd', i.im_sku, i.im_desc, w.wh_stk, w.wh_avgcst, i.im_stdc, '$usernm' FROM immf i INNER JOIN imwh w ON w.im_id = i.im_id WHERE w.wh_stk > 0 AND w.wh_site = $site_cd AND i.im_sku >= '$sp' AND i.im_sku <= '$fp')";
              }
            }
            elseif ((!empty($sLoc)) and (!empty($tLoc))) {
                if ($zStk =="yes") {
                  $stln = "INSERT INTO stln (ln_stkid, ln_site, ln_sku, ln_desc, ln_stkoh, ln_avgcst, ln_stdcst, ln_stampuser) (SELECT '$stID','$site_cd', i.im_sku, i.im_desc, w.wh_stk, w.wh_avgcst, i.im_stdc, '$usernm' FROM immf i INNER JOIN imwh w ON w.im_id = i.im_id WHERE w.wh_site = $site_cd AND w.wh_loc >= '$sLoc' AND w.wh_loc <= '$tLoc')";
                }
                else {
                         $stln = "INSERT INTO stln (ln_stkid, ln_site, ln_sku, ln_desc, ln_stkoh, ln_avgcst, ln_stdcst, ln_stampuser) (SELECT '$stID','$site_cd', i.im_sku, i.im_desc, w.wh_stk, w.wh_avgcst, i.im_stdc, '$usernm' FROM immf i INNER JOIN imwh w ON w.im_id = i.im_id WHERE w.wh_stk > 0 AND w.wh_site = $site_cd AND w.wh_loc >= '$sl' AND w.wh_loc <= '$fl')";
                }
            }
        }
        else if ($cFlag ==2) {
        //Determined to be a full stocktake
            if ($zStk =="yes") {
                $stln = "INSERT INTO stln (ln_stkid, ln_site, ln_sku, ln_desc, ln_stkoh, ln_avgcst, ln_stdcst, ln_stampuser) (SELECT '$stID','$site_cd', i.im_sku, i.im_desc, w.wh_stk, w.wh_avgcst, i.im_stdc, '$usernm' FROM immf i INNER JOIN imwh w ON w.im_id = i.im_id WHERE w.wh_site = $site_cd)";
            }
            else {
                  $stln = "INSERT INTO stln (ln_stkid, ln_site, ln_sku, ln_desc, ln_stkoh, ln_avgcst, ln_stdcst, ln_stampuser) (SELECT '$stID','$site_cd', i.im_sku, i.im_desc, w.wh_stk, w.wh_avgcst, i.im_stdc, '$usernm' FROM immf i INNER JOIN imwh w ON w.im_id = i.im_id WHERE w.wh_stk > 0 AND w.wh_site = $site_cd)";
            }
        }
        $conn->query($stln);
        echo $conn->error;
              
    }
}
          
            
        
    } ?>
    </body>
</html>
<script>
    var x = document.getElementById("cyclicalFlag");
     var sp = document.getElementById("sp");
    var fp = document.getElementById("fp");
    var sl = document.getElementById("sl");
    var fl = document.getElementById("fl");
   
    function isFull() {
if (x.value ==2) {
    sp.value = "All";
    fp.value = "All";
    sl.value = "All";
    fl.value = "All";
    sp.readOnly = true;
    fp.readOnly = true;
    sl.readOnly = true;
    fl.readOnly = true;
    
} else {
    sp.value = "";
    fp.value = "";
    sl.value = "";
    fl.value = "";
    sp.readOnly = false;
    fp.readOnly = false;
    sl.readOnly = false;
    fl.readOnly = false;
    sp.focus();
}
    }
function validateForm() {
    if (sp.value !=="" || fp.value !=="") {
        fp.required = true;
        sp.required = true;
    }
    else {
        fp.required = false;
        sp.required = false;
    }
    if (sl.value !=="" || fl.value !=="") {
        sl.required = true;
        fl.required = true;
    } else {
        sl.required = false;
        fl.required = false;
    }
}

</script>
