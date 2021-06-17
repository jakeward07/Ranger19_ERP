<?php 
$prog = "sf_ucbra";
$mod = "sf";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>Cobra Maintenance - RANGER 5</title>
    </head>
<body>
<h1>Cobra Maintenance</h1>   <?php if (empty($_GET["user"])) { ?> 
     <div class="searchBox" style="width:600px">
    <h1>User</h1>
         <div class="center">
          
             <form action="" method="get">
         <p1>Username: </p1><input name="user" autocomplete="off" autofocus required type="text" list="usmf">
             <datalist id="usmf">
             <?php
                 $sql = "SELECT * FROM usmf";
                 $result = $conn->query($sql);
                 if ($result->num_rows > 0) {
                     while($row = $result->fetch_assoc()) {
                         ?>
                 <option value="<?php echo $row["us_user"];?>"><?php echo $row["us_name"];?></option>
                 <?php
                     } 
                 } ?>
             
             </datalist><br>
             <button type="submit" class="submit">Find User</button> </form>
        
         </div>
    </div>
     <?php }
             if (!empty($_GET["user"])) {
                 ?>
    <h1><?php echo $_GET["user"];?></h1><div class="bodystrip"><a href="sf_ucbra.php"><button>Back to Search</button></a> <button onclick="newCbra()" type="button">New Cobra</button></div>
    <?php if (!empty($_GET["success"])) {
                     echo "<div class='success'>Cobra successfully deleted.</div>";
                 } ?>
    <table class="table">
    <tr class="tr">
        <th class="th">Site Code</th>
        <th class="th">Site Name</th>
        <th class="th">Site Manager</th>
        <th class="th">Action</th>
        </tr>
        <?php
                 $sql = "SELECT * FROM cbra c INNER JOIN stmf s ON s.st_code = c.cb_site INNER JOIN usmf u ON u.us_user = s.st_manager WHERE c.cb_user = '$_GET[user]'";
                 $result = $conn->query($sql);
                 if ($result->num_rows > 0) {
                     while($row = $result->fetch_assoc()) {
                         ?>
<tr class="tr">
        <td class="td"><?php echo $row["st_code"];?></td>
        <td class="td"><?php echo $row["st_name"];?></td>
        <td class="td"><?php echo $row["us_name"];?></td>
    <td class="td"><a href="sf_ucbra.php?del=true&site=<?php echo $row["cb_id"];?>&user=<?php echo $_GET["user"];?>">Delete</a></td>
        </tr>
        
        <?php
                     }
                 } else {
                     echo "<h1>No Cobra's set up for this user</h1>";
                 } ?>
    </table>
    <?php if (!empty($_GET["del"])) {
                     $sql = "DELETE FROM cbra WHERE cb_id = '$_GET[site]'";
                     $conn->query($sql);
                     echo "<script>location.replace('sf_ucbra.php?user=$_GET[user]&success=true');</script>";
                 } ?>
    
             <?php
             }
             ?><div class="blackout" hidden id="newCob">
    <div class="searchBox" id="newCbra" style="width:600px; position:absolute;left:0;right:0;top:0;bottom:0;height:200px">
    <button class="exit" onclick="newCbra()">X</button>
        <h1>New Cobra Setup</h1>
        <div class="center"> <form action="" method="post">
            <input name="newCbra" hidden value="new">
        <p1>Site: </p1><select name="site" required>
            <option></option>
            <?php
            $sql = "SELECT * FROM stmf ORDER BY st_code";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row=$result->fetch_assoc()) {
                    ?>
            <option value="<?php echo $row["st_code"];?>"><?php echo $row["st_code"], ' - ', $row["st_name"];?></option>
            <?php
                }
            } ?>
            
            </select><br>
            <button type="submit" class="submit">Create Cobra</button></form>
        </div>
        <?php if (!empty($_POST["newCbra"])) {
    $sql2 = "SELECT * FROM cbra WHERE cb_site = '$_POST[site]' AND cb_user = '$_GET[user]'";
    $result = $conn->query($sql2);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<script>
            alert('The user already has this site assigned');
            location.replace('sf_ucbra.php?user=$_GET[user]');
            </script>
            ";
        }
    } else {
    $sql = "INSERT INTO cbra (cb_user, cb_site, cb_stampuser) VALUES ('$_GET[user]','$_POST[site]','$usernm')";
    $conn->query($sql);
    echo $conn->error;
    echo "<script>location.replace('sf_ucbra.php?user=$_GET[user]');</script>";
    
    

 }}?>
    </div>
    </div>
    </body>
    <script>
    function newCbra() {
        var x = document.getElementById("newCob");
        if (x.style.display ==="block") {
            x.style.display = "none";
        } 
        else {
            x.style.display = "block";
        }
    }
    
    </script>
</html>
