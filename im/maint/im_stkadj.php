<?php 
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
if ($stkadj !==1) {
    echo "<script>location.replace('/erp/system_dependants/errors/access.php')</script>";
}
$prog = "im_stkadj";
$mod = "im";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>Stock Adjustment - RANGER 5</title>
    </head>
<body>
<h1>Stock Adjustment</h1>
     <div class="center">
         <form action="" method="post">
             
        
           
    <p1>Product Code: </p1>
         <input name="im_sku" onchange="showAdjust()" list="code" required autofocus autocomplete="off">
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
         <span hidden id="adjust"><p1>Adjustment: </p1><input id="adjust" name="im_adjust" type="number" step="0.1" required autocomplete="off"><br>
             <input type="radio" value="1" id="1" name="type"><label for="1">+ Increase</label>
             <input type="radio" value="2" id="2" name="type"><label for="2">- Decrease</label>
            <br>
             <p1>Reason: </p1><input required name="reason" list="reason">
             <datalist id="reason">
               
             <?php 
                 $sql="SELECT * FROM sacd";
                 $result = $conn->query($sql);
                 if ($result->num_rows > 0) {
                     while ($row = $result->fetch_assoc()) {
                         ?>
                 <option value="<?php echo $row["sa_id"];?>"><?php echo $row["sa_name"], ' - ', $row["sa_desc"];?></option>
                 <?php
                     }
                 }
                 
                 ?>
             
             </datalist>
         
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
 
    $adjust = $_POST["im_adjust"];
    $sku = $_POST["im_sku"];
    $adj = $_POST["type"];
    if ($adj ==1) {
        $sql = "UPDATE imwh SET wh_stk = wh_stk+$adjust WHERE im_id = (SELECT im_id FROM immf WHERE im_sku = '$sku') AND wh_site = $site_cd";
        $sql2 = "INSERT INTO immv (mv_sku, mv_type, mv_user, mv_qty, mv_site, mv_bal) 
        (SELECT '$sku','Stock Adjust IN','$usernm','$adjust','$site_cd', wh_stk FROM imwh WHERE wh_site = $site_cd AND im_id = (SELECT im_id FROM immf WHERE im_sku = '$sku'))";
            $conn->query($sql);
    $conn->query($sql2);
    }
    elseif ($adj ==2) {
              $sql = "UPDATE imwh SET wh_stk = wh_stk-$adjust WHERE im_id = (SELECT im_id FROM immf WHERE im_sku = '$sku') AND wh_site = $site_cd";
            $sql2 = "INSERT INTO immv (mv_sku, mv_type, mv_user, mv_qty, mv_site, mv_bal) 
        (SELECT '$sku','Stock Adjust OUT','$usernm','-$adjust','$site_cd', wh_stk FROM imwh WHERE wh_site = $site_cd AND im_id = (SELECT im_id FROM immf WHERE im_sku = '$sku'))";
            $conn->query($sql);
    $conn->query($sql2);
    }
else {
    echo $conn->error;
}

}
    ?>
    </body>
</html>
