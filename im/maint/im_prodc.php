<?php 
$prog = "im_prodc";
$mod = "im";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>Product Creation - RANGER 5</title>
    </head>
<body>
    <?php
    $sql = "SELECT * FROM imsc LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $trdP = $row["sc_trd"];
            $retP = $row["sc_ret"];
        }
    }?>
<h1>Product Creation</h1>
    <?php 
    if (!empty($_GET)) {
    if ($_GET["success"] ==1) {
    ?>
    <div class="success" style="color:black;text-align:center">Product created successfully.<br><a style="color:black;text-decoration:underline" href="/im/enq/im_enq.php?product=<?php echo $_GET["sku"];?>">View Product</a></div>
    <?php
}} ?>
    <form action="" method="post">
    <div class="left">
        <p1>Product Code: </p1><input type="text" autofocus name="im_sku" required autocomplete="off" id="im_sku"><br>
        <p1>Description: </p1><input type="text" name="im_desc" required autocomplete="off" id="im_desc"><br>
        <p1>Brand: </p1><input type="text" name="im_brand" autocomplete="off" id="im_brand"><br>
        <p1>Range: </p1><input type="text" name="im_range" autocomplete="off" id="im_range"><br>
        <p1>Preferred Supplier: </p1><input type="text" onkeyup="getscls()" name="im_supp" required autocomplete="off" id="im_supp" list="prefsup">
        <datalist id="prefsup">
        <?php 
            $sql = "SELECT * FROM sumf";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    
                    ?> 
            <option value="<?php echo $row["su_code"];?>"><?php echo $row["su_name"], ' | Alias: ', $row["su_alias"];?></option>
            <?php
                }
            }
        ?>
        
        
        </datalist>
        <br>
       <span id="priceclass"></span>
          <p1>Inventory Class: </p1><input type="text" name="im_icls" required autocomplete="off" id="im_icls" list="ic">
        <datalist id="ic">
        <?php 
            $sql = "SELECT * FROM imic";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    
                    ?> 
            <option value="<?php echo $row["ic_code"];?>"><?php echo $row["ic_name"];?></option>
            <?php
                }
            }
        ?>
        
        
        </datalist><br>
      
        
        </div>
    
    <div class="right">
         <p1>Cost Factor: </p1><input type="number" step="0.0001" name="im_cosf" id="im_cosf" autocomplete="off"><br>
        <p1>Standard Cost: </p1><input onkeyup="autoFillTR()" type="number" step="0.0001" name="im_stdc" id="im_stdc" autocomplete="off" required><br>
        <p1>Trade Price: </p1><input type="number" step="0.0001" name="im_trd" id="im_trd" autocomplete="off" required><br>
        <p1>Retail Price: </p1><input type="number" step="0.0001" name="im_ret" id="im_ret" autocomplete="off" required><br>
        <p1>Unit of Measure: </p1><select name="im_uom" required>
        <option></option>
        <?php 
        $sql = "SELECT * FROM iuom";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                ?>
        <option value="<?php echo $row["uom_shrt"];?>"><?php echo $row["uom_long"] , ' (', $row["uom_shrt"], ')';?></option>
        <?php
            }
        } ?>
        
        </select><br>
        <p1>Per: </p1><input name="im_per" type="number" value="1" required autocomplete="off">
        
        
        <br>
        <p1>Barcode: </p1><input type="number" step="0.0001" name="im_barcode" id="im_barcode" autocomplete="off" ><br>
        <p1>Stock Controlled: </p1><select name="im_stkctrl" required>
        <option></option>
        <option value="1">Yes</option>
        <option value="0">No</option>
        </select><br>
        <p1>Alternative 1: </p1><input type="text" name="im_alt1" id="im_alt1" autocomplete="off"><br>
        <p1>Alternative 2: </p1><input type="text" name="im_alt2" id="im_alt2" autocomplete="off"><br>
        <button type="submit" class="submit">Create Product</button>
        
        
        
        
        
        </div>
    
    </form> 
    <?php 
    if (!empty($_POST)) {
        $sql = "SELECT * FROM immf WHERE im_sku = '$_POST[im_sku]'";
        $res = $conn->query($sql);
        if ($res->num_rows > 0) {
            while($r = $res->fetch_assoc()) {
            
            echo "<script>alert('This Product already exists. Query not executed.')</script>";
        }
        }
        else {
            
            $sql = "INSERT INTO immf (im_sku, im_desc, im_brand, im_range, im_supp, im_icls, im_scls, im_stdc, 
            im_ret, im_trd, im_cosf, im_uom, im_per, im_barcode, im_alt1, im_alt2, im_stkctrl, im_stampuser) VALUES ('$_POST[im_sku]','$_POST[im_desc]','$_POST[im_brand]','$_POST[im_range]','$_POST[im_supp]','$_POST[im_icls]','$_POST[im_scls]','$_POST[im_stdc]','$_POST[im_ret]','$_POST[im_trd]','$_POST[im_cosf]','$_POST[im_uom]','$_POST[im_per]', '$_POST[im_barcode]','$_POST[im_alt1]','$_POST[im_alt2]','$_POST[im_stkctrl]','$usernm')";
            $conn->query($sql);
            $sql2 = "SELECT im_id FROM immf WHERE im_sku = '$_POST[im_sku]'";
            $result = $conn->query($sql2);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $id = $row["im_id"];
                    $sql3 = "INSERT INTO imwh (im_id, wh_site, wh_stampuser) (SELECT '$id', st_code, '$usernm' FROM stmf)";
                    $conn->query($sql3); echo $conn->error;
                    $sql4 = "INSERT INTO pofr (fr_imid, fr_supp, fr_qty) VALUES ('$id','$_POST[im_supp]','1')";
                    $conn->query($sql4);
                    echo "<script>location.replace('im_prodc.php?success=1&sku=$_POST[im_sku]');</script>";
                }
            }
            
        }
    }
    
    
    
    
    ?>
    
    
    
    
    
    
    <script>
    function getscls() {
          var x = document.getElementById("im_supp");
          var y = document.getElementById("priceclass");
          
    if (x.value == "") {

        return;
    } else {
            
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               y.innerHTML = this.responseText;
            
            }
        };
        xmlhttp.open("GET","/im/ajax/get_scls.php?q="+x.value,true);
        xmlhttp.send();
         
    }
}
        
        function autoFillTR() {
            var x = document.getElementById("im_stdc");
            var y = document.getElementById("im_trd");
            var z = document.getElementById("im_ret");
            var a = <?php echo $retP?>;
            var b = <?php echo $trdP?>;
            var c = x.value/(100-b)*100;
            var d = x.value/(100-a)*100;
            y.value = c.toFixed(2);
            z.value = d.toFixed(2);
        }
    
    </script>
    
    </body>
</html>
