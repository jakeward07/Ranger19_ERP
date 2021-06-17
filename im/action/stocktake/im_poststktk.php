<?php 
$prog = "im_poststktk";
$mod = "im";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>Post Stocktake Counts - RANGER 5</title>
    </head>
<body>
<h1>Post Stocktake Counts</h1>
     <div class="center">
    <form action="" method="post">
         <p1>Stocktake ID: </p1><input value="<?php $sql = "SELECT st_code FROM sthd WHERE st_site = $site_cd ORDER BY st_code DESC LIMIT 1";
$result = $conn->query($sql);
                                       if ($result->num_rows > 0) {
                                           while($row = $result->fetch_assoc()) {
                                               echo $row["st_code"];
                                           }
                                       }?>" name="st_code" autocomplete="off" id="st_code" autofocus type="number"><br>
        <button type="submit" class="submit">Post Stocktake &rarr;</button>
         </form>
    
    </div>
    </body>
    <?php if (!empty($_POST)) {
   $id = $_POST["st_code"];
    $sql = "SELECT count(ln_id) as count FROM stln WHERE ln_stkid = $id AND ln_site = $site_cd";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
        $count = $row["count"];
            
        }}
      $sql = "SELECT * FROM stln WHERE ln_stkid = $id AND ln_site = $site_cd";     
            $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $sku_arr = array($row["ln_sku"]);
            $stk_arr = array($row["ln_stkct"]);
          foreach($sku_arr as $sku) {
            foreach ($stk_arr as $stk) {
                $sql = "INSERT INTO immv (mv_sku, mv_type, mv_user, mv_qty, mv_bal, mv_avg, mv_site) (SELECT '$sku','Stocktake','$usernm','$stk', wh_stk, wh_avgcst, '$site_cd' FROM imwh WHERE im_id = (SELECT im_id FROM immf WHERE im_sku = '$sku') AND wh_site = $site_cd)";
                $conn->query($sql);
                $sql = "UPDATE imwh SET wh_stk = $stk WHERE wh_site = $site_cd AND im_id = (SELECT im_id FROM immf WHERE im_sku = '$sku')";
                $conn->query($sql);
                
                echo $conn->error;
            }
          }
            
            
        
        }
              
    }
    
    
}?>
    <script>
    window.onload = function selectInput() {
        var x = document.getElementById("st_code");
        if (x.value !=="") {
            x.select();
        }
    }
    </script>
    
    </body>
</html>
