<?php 
$prog = "sf_sites";
$mod = "sf";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>Sites Maintenance - RANGER 5</title>
    </head>
<body>
<h1>Sites Maintenance</h1>
      <?php if (!empty($_GET)) {
    if ($_GET["success"] ==1) {
        echo "<div class='success'>Site successfully created</div>";
    } else if ($_GET["success"] ==2) {
        echo "<div class='fail'>A site already exists with that $_GET[e]</div>";
    }
}?><br>
    <div class="bodystrip"><button onclick="newSite()">New Site Setup</button>
    <a href="sf_sites.php?a=print"><button>Download Report</button></a>
    </div>
  
    <span id="newsite" hidden>
    <div class="blackout">
    <div class="searchBox" style="width:600px; height:450px; position:absolute; left:0;right:0;top:0;bottom:0">
        <h1>New Site Setup</h1>
        <div class="center">
            <button onclick="newSite()" class="exit">X</button>
            <form action="" method="post">
        <p1>Site Code: </p1><input type="tel" id="code" maxlength="5" autocomplete="off" autofocus required name="st_code"><br>
        <p1>Site Name: </p1><input type="text" autocomplete="off" required name="st_name"><br>
        <p1>Phone: </p1><input type="tel" autocomplete="off" required name="st_phone"><br>
        <p1>Address: </p1><input type="text" autocomplete="off" required name="st_addr"><br>
        <p1>Suburb: </p1><input type="text" autocomplete="off" required name="st_sub"><br>
        <p1>State: </p1><input type="text" placeholder="Type abbreviation. Eg NSW, QLD, VIC ect" autocomplete="off" required name="st_state" maxlength="5"><br>
        <p1>Postcode: </p1><input type="tel" autocomplete="off" required name="st_pstcd" maxlength="5"><br>
        <p1>Manager: </p1><input type="text" name="st_manager" required autocomplete="off" list="usmf">
            <datalist id="usmf">
            <?php 
                $sql = "SELECT * FROM usmf WHERE us_sec = 'STM' OR us_sec = 'ADM'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        ?>
                <option value="<?php echo $row["us_user"];?>"><?php echo $row["us_name"];?></option>
                <?php
                    }
                }
             ?>
            </datalist>
            <br>
            <button class="submit" type="submit">Create Site</button>
            </form>
        </div>
        </div>
        <?php if (!empty($_POST)) {
    //VERIFY SITE CODE DOES NOT ALREADY EXIST
    $sqlv = "SELECT * FROM stmf WHERE st_code = '$_POST[st_code]'";
    $result = $conn->query($sqlv);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<script>location.replace('sf_sites.php?success=2&e=Site Code');</script>";
        }
    } else {
    //INSERT INTO stmf
    $sql = "INSERT INTO stmf (st_code, st_name, st_addr, st_sub, st_pstcd, st_state, st_phone, st_manager, st_stampuser) VALUES ('$_POST[st_code]','$_POST[st_name]','$_POST[st_addr]','$_POST[st_sub]','$_POST[st_pstcd]','$_POST[st_state]','$_POST[st_phone]','$_POST[st_manager]','$usernm')";
    $conn->query($sql);
    //CREATE imwh RECORD
    $sql2 = "INSERT INTO imwh (im_id, wh_site) (SELECT im_id, '$_POST[st_code]' FROM immf)";
    $conn->query($sql2);
    //ADD BLANK INVOICE/SALESORDER/PO HEADER RECORD
    $sql3 = "INSERT INTO pohd (ph_order, ph_site) VALUES ('100000','$_POST[st_code]')";
    $conn->query($sql3);
    $sql4 = "INSERT INTO orhd (oh_order, oh_site) VALUES ('200000','$_POST[st_code]')";
    $conn->query($sql4);
    $sql5 = "INSERT INTO invh (vh_inv, vh_site) VALUES ('100000','$_POST[st_code]')";
    $conn->query($sql5);
   echo "<script>location.replace('sf_sites.php?success=1');</script>"; 
}} ?>
        </div></span>
     <table class="table">
    <tr class="tr">
         <th class="th">Site Code</th>
         <th class="th">Site Name</th>
         <th class="th">Site Address</th>
         <th class="th">Site Suburb</th>
         <th class="th">Site Postcode</th>
         <th class="th">Site Manager</th>
         <th class="th">Action</th>
         
         </tr>
         <?php
         $sql = "SELECT * FROM stmf ORDER BY st_code";
         $result = $conn->query($sql);
         if ($result->num_rows > 0) {
             while($row = $result->fetch_assoc()) {
                 ?>
         <tr class="tr">
         <td class="td"><?php echo $row["st_code"];?></td>
         <td class="td"><?php echo $row["st_name"];?></td>
         <td class="td"><?php echo $row["st_addr"];?></td>
         <td class="td"><?php echo $row["st_sub"];?></td>
         <td class="td"><?php echo $row["st_pstcd"];?></td>
         <td class="td"><?php echo $row["st_manager"];?></td>
         <td class="td"><a href="sf_sites.php?s=<?php echo $row["st_code"];?>&a=delete">Edit</a> | <a href="sf_sites.php?s=<?php echo $row["st_code"];?>&a=delete">Delete</a></td>
         </tr>
         <?php
             }
         } ?>
         
    </table>
    <script>
    function newSite() {
        var x = document.getElementById("newsite");
        var y = document.getElementById("code");
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
