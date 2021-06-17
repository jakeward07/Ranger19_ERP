<?php 
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
if ($stkadj !==1) {
    echo "<script>location.replace('/erp/system_dependants/errors/access.php')</script>";
}
$prog = "im_avgadj";
$mod = "im";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>Average Cost Adjustment - RANGER 5</title>
    </head>
<body>
<h1>Average Cost Adjustment</h1>
     <div class="center">
         <form action="" method="post">
             
        
           
    <p1>Product Code: </p1>
         <input name="im_sku" onchange="showAdjust()" list="code" required autofocus  autocomplete="off">
         <datalist id="code">
         
         <?php
         $sql = "SELECT * FROM immf";
             $result = $conn->query($sql);
             if ($result->num_rows > 0) {
                 while ($row = $result->fetch_assoc()) {
                     ?>
             <option onclick="showAdjust()" value="<?php echo $row["im_sku"];?>"><?php echo $row["im_desc"];?></option>
             <?php
                 }
             }
         ?>
         </datalist><br>
         <span hidden id="adjust"><p1>New Average Cost: </p1><input id="adjust" name="im_avg" type="number" step="0.0001" required autocomplete="off"><br>
         
         
         
         <br><button type="submit" class="submit">Commit Adjustment</button>
         </span>
         </form>
    </div>
    <script>
    function showAdjust() {
        var x = document.getElementById("adjust");
        if (x.style.display ==="block") {
            x.style.display = "none";
        }
        else {
            x.style.display = "block";
        }
    }
    
    </script>
    <?php if (!empty($_POST)) {
    $adjust = $_POST["im_avg"];
    $sku = $_POST["im_sku"];
   $sql2 = "INSERT INTO immv (mv_sku, mv_type, mv_user, mv_qty, mv_avg, mv_site, mv_bal)
  (SELECT '$sku','Avg Cost Adjustment','$usernm', wh_stk,'$adjust','$site_cd', wh_stk FROM imwh WHERE wh_site = $site_cd AND im_id = (SELECT im_id FROM immf WHERE im_sku = '$sku'))";
    $sql = "UPDATE imwh SET wh_avgcst = '$adjust' WHERE wh_site = '$site_cd' AND im_id = (SELECT im_id FROM immf WHERE im_sku = '$sku')";
 $conn->query($sql2);
    $conn->query($sql);
    
echo $conn->error;
}
    ?>
    </body>
</html>
