<?php 
$prog = "sp_header";
$mod = "sp";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>SP Header - RANGER 5</title>
    </head>
<body>
<h1>Special Pricing Header Details</h1>
    <h3>Supplier Cost Contracts</h3>
    <?php 
    if (!empty($_GET)) {
        if ($_GET["msg"] ==1) {
            echo "<div class='success'>Contract Created</div><br>";
        }
    }?> 
     <div class="bodystrip">
    <button onclick="newCont()">New Contract</button>
    <button>Import Files</button>
    <button>Pricing Analysis</button>
    </div>
    <span id="newCont" hidden>
    <div class="blackout" style="z-index: 1">
        <div class="searchBox" style="width:600px; position:absolute; left:0; right:0; top: 0; bottom:0; height: 350px">
        <h1>New Cost Contract</h1>
            <button type="button" onclick="newCont()" class="exit">X</button>
        <form action="" class="center" method="post">
        <p1>Contract Name: </p1><input id="name" autofocus autocomplete="off" name="sd_name" required><br>
            <input name="sd_code2" value="<?php
            $sql7 = "SELECT sd_code FROM sdhd WHERE sd_site = $site_cd ORDER BY sd_code DESC LIMIT 1";
            $result = $conn->query($sql7);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo $row["sd_code"]+1;
}}
                else {echo 1;}?>" hidden id="hiddencode">
        <p1>Contract Code: </p1><input id="code" disabled value="<?php
            $sql8 = "SELECT sd_code FROM sdhd WHERE sd_site = $site_cd ORDER BY sd_code DESC LIMIT 1";
            $result = $conn->query($sql8);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo $site_cd,'-',$row["sd_code"]+1;
                }}
                else {
                    echo $site_cd,'-',1;
            }?>" autocomplete="off" autofocus required><br>
            <p1>Supplier: </p1><input autocomplete="off" name="sd_supp" required  list="supp">
            <datalist id="supp">
            <?php 
                $sql = "SELECT * FROM sumf WHERE su_status = 1";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        ?>
                <option value="<?php echo $row["su_code"];?>"><?php echo $row["su_name"];?></option>
                <?php
                    }
                } ?>
            
            </datalist>
            <br>
            <p1>Start Date: </p1><input type="date" value="<?php echo date('Y-m-d');?>" autocomplete="off" name="sd_sdate" required><br>
            <p1>Expire Date: </p1><input type="date" autocomplete="off" name="sd_edate" required><br>
        <button type="submit" class="submit">Create Contract</button>
        </form>
            <?php if (!empty($_POST)) {
    $sql = "INSERT INTO sdhd (sd_supp, sd_name, sd_code, sd_startdate, sd_expdate, sd_site, sd_stampuser) VALUES ('$_POST[sd_supp]','$_POST[sd_name]','$_POST[sd_code2]','$_POST[sd_sdate]','$_POST[sd_edate]','$site_cd','$usernm')";
    $conn->query($sql);
    echo "<script>location.replace('sp_header.php?msg=1');</script>";
    echo $conn->error;
 ?> <?php
}?>
        </div></div>
   <
    </span> <?php if (!empty($_POST)) {
  echo var_dump($_POST);
} ?>
    <table class="table">
    <tr class="tr">
        <th class="th">Profile Name</th>
        <th class="th">Supplier</th>
        <th class="th">Start Date</th>
        <th class="th">Expiry Date</th>
        <th class="th">Action</th>
        
        </tr>
    <?php 
        $sql = "SELECT * FROM sdhd s INNER JOIN sumf su ON s.sd_supp = su.su_code WHERE s.sd_site = $site_cd";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                
                ?>
        <tr class="tr">
        <td class="td"><?php echo $row["sd_code"], ' - ', $row["sd_name"];?></td>
        <td class="td"><?php echo $row["sd_supp"], ' - ', $row["su_name"];?></td>
        <td class="td"><input name="sd_startdate" style="width:150px" type="date" value="<?php echo $row["sd_startdate"];?>"></td>
        <td class="td"><input name="sd_expdate" type="date" style="width:150px" value="<?php echo $row["sd_expdate"];?>"></td>
            <td class="td"><a href="sp_lines.php?s=<?php echo $row["sd_code"];?>">Go to lines</a></td>
        
        </tr>
        <?php
            }
        }?>
    
    </table>
    <script>
    function newCont() {
        var x = document.getElementById("newCont");
        var y = document.getElementById("name");
        if (x.style.display ==="block") {
            x.style.display = "none";
        }
        else {
            x.style.display = "block";
            y.focus();
        }
    }
    
    </script>
    
    </body>
</html>
