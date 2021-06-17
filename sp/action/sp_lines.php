<?php 
$prog = "sp_lines";
$mod = "sp";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>SP Lines - RANGER 5</title>
    </head>
<body>
<h1>Special Contract Lines</h1>
     <div class="bodystrip">
         <a href="sp_header.php"><button>Back to Contract Headers</button></a>
         <button onclick="newLine()">Add Line</button>
         <button>Import Lines</button>
         <button>Import Template (Download)</button>
         
    </div>
    <span id="newLine" hidden>
    <div class="blackout" style="z-index:1">
        <div class="searchBox" style="position:absolute; width:600px; height:300px; left:0; right:0; bottom:0; top:0">
            <h1>New Lines</h1>
            <div class="center">
                <button onclick="forceShut()" class="exit">X</button>
                <?php if (!empty($_GET)) {
    if ($_GET["msg"] ==1) {
        echo "<div class='fail'>Product already exists at that price break.</div>";
    }
    elseif ($_GET["msg"] ==2) {
        echo "<div class='success' style='color:black'>Product added successfully.</div>";
    }
}?>
                <form action="" method="post">
            <p1>Product Code: </p1>
        <input name="sl_sku" type="text" list="immf" id="sku" autocomplete="off" autofocus required>
                <datalist id="immf">
                <?php 
                    $s = $_GET["s"];
                    $sql = "SELECT * FROM immf f INNER JOIN pofr r ON r.fr_imid = f.im_id INNER JOIN sdhd d ON d.sd_supp = r.fr_supp WHERE d.sd_code = $s AND d.sd_site = $site_cd";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo $conn->error;
                            ?>
                    <option value="<?php echo $row["im_sku"];?>"><?php echo $row["im_desc"];?></option>
                    <?php
                        }
                    } ?>        
                </datalist>
                <br>
                <p1>Net Price: </p1><input step="0.0001" type="number" name="sl_price" required autocomplete="off"><br>
                <p1>Price Break: </p1><input type="number" name="sl_bval" required autocomplete="off"><br>
                <button class="submit" type="submit">Add to Contract</button>
                <?php if (!empty($_POST)) {
    $sql = "SELECT * FROM sdln WHERE sl_code = $s AND sl_site = $site_cd AND sl_sku = '$_POST[sl_sku]' AND sl_bval = '$_POST[sl_bval]'";
    $result = $conn->query($sql); 
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<script>location.replace('sp_lines.php?s=$s&db=1&msg=1');</script>";
        }
    }
    else {
        $sql2 = "INSERT INTO sdln (sl_sku, sl_code, sl_site, sl_price, sl_bval) VALUES ('$_POST[sl_sku]','$s','$site_cd','$_POST[sl_price]','$_POST[sl_bval]')";
        $conn->query($sql2);
          echo "<script>location.replace('sp_lines.php?s=$s&db=1&msg=2');</script>";
    }
}?> </form>
            </div>
             </div>
        
        </div>
    </span>
    <table class="table">
    <tr class="tr">
        <th class="th">Product Code</th>
        <th class="th">Description</th>
        <th class="th">Qty Break</th>
        <th class="th">Price Break $</th>
        <th class="th">New Price $</th>
        <th class="th">Actions</th>
        </tr>
    <?php
        $s = $_GET["s"];
        $sql = "SELECT * FROM sdln s INNER JOIN immf i ON i.im_sku = s.sl_sku INNER JOIN sdhd h ON h.sd_code = s.sl_code WHERE s.sl_code = '$s' AND h.sd_site = $site_cd AND s.sl_site = $site_cd";
        $res = $conn->query($sql);
        if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                ?>
        <tr class="tr">
        <td class="td"><?php echo $row["im_sku"];?></td>
        <td class="td"><?php echo $row["im_desc"];?></td>
            <td class="td"><?php echo $row["sl_bval"];?></td>
            <td class="td"><?php echo $row["sl_price"];?></td>
            <td class="td"><input name="sl_price" type="number" step="0.0001" style="width:60px"></td>
            <td class="td"><a href="sp_lines.php?a=1?id=<?php echo $row["sl_id"];?>">Update</a> | <a href="sp_lines.php?a=2&id=<?php echo $row["sl_id"];?>">Delete</a></td>
        </tr>
        
        <?php
            } 
        } ?>
   
    
    </div>
    </table>
   <script>
  <?php if (!empty($_GET)) {if ($_GET["db"] ==1) {echo "window.onload = ";}} ?> function newLine() {
        var x = document.getElementById("newLine");
      var y = document.getElementById("sku");
        if (x.style.display ==="block") {
            x.style.display = "none";
        }
        else {
            x.style.display = "block";
            y.focus();
            
        }
    }
       function forceShut() {
            var x = document.getElementById("newLine");
     x.style.display = "none";
           
    }  
       
    </script>
    
    </body>
</html>
