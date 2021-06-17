<?php 
$prog = "po_masspo";
$mod = "po";
$pname = "Mass Purchasing";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title><?php echo $pname;?> - RANGER 5</title>
    </head>
<body>
<h1><?php echo $pname;?></h1>
     <div class="center">
         <form action="" id="massPoForm" method="post">
    <p1>Supplier: </p1><input placeholder="Enter Supplier ID" list="sumf" required autocomplete="off" autofocus name="su_code">
         <datalist id="sumf">
         <?php 
             $sql = "SELECT * FROM sumf WHERE su_status = 1";
             $result = $conn->query($sql);
             if ($result->num_rows > 0){ 
             while($row = $result->fetch_assoc()) {
                 ?>
             <option value="<?php echo $row["su_code"];?>"><?php echo $row["su_name"];?></option>
             <?php 
             }
             } ?>
         
         </datalist><br>
         <p1>Quantity: </p1><input placeholder="Each product will be ordered at this quantity" type="number" name="qty" required autocomplete="off"><br>
         <button type="submit" class="submit">Generate PO &rarr;</button>
         </form>
    </div>
    <?php 
    if (!empty($_POST)) {
        //Get order number
        $supp = $conn -> real_escape_string($_POST["su_code"]);
        $qty = $conn -> real_escape_string($_POST["qty"]);
        $date = date("Y-m-d");
        //Get last order number and add 1
        $sql = "SELECT ph_order FROM pohd WHERE ph_site = $site_cd ORDER BY ph_order DESC LIMIT 1";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $order = $row["ph_order"]+1;
                //Insert into pohd
                $sql = "INSERT INTO pohd (ph_order, ph_supp, hd_stat, ph_user, ph_site, ph_stampuser) VALUES ('$order','$supp','Pending','$usernm','$site_cd','$usernm')";
                $conn->query($sql);
                //Insert into poln
                $sql = "INSERT INTO poln (ln_sku, ln_desc, ln_order, ln_wh, ln_qty, ln_price, ln_per, ln_uom, ln_reqdate, ln_stampuser) (SELECT im_sku, im_desc, '$order', '$site_cd','$qty', im_stdc, im_per, im_uom, '$date', '$usernm' FROM immf WHERE im_supp = '$supp')";
                $conn->query($sql);
                //Update imwh
                $sql = "SELECT im_id FROM immf WHERE im_supp = $supp";
                $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $im = $row["im_id"];
                $sql = "UPDATE imwh SET wh_onor = wh_onor+$qty WHERE wh_site = $site_cd AND im_id = $im";
                $conn->query($sql);
            }}
                echo "<script>alert('Your PO Number is $order');</script>";
            }
        }
    }
    
    ?>
    <script>
    function check() {
        var x = confirm("Are you sure you want to order?");
        var y = document.getElementById("massPoForm");
        if (x === true) {
            y.form.submit();
        } else {
            location.replace('po_masspo.php');
        }
    }
    </script>
    
    </body>
</html>
