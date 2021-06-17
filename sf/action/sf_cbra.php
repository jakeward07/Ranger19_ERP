<?php 
$prog = "sf_cbra";
$mod = "sf";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>Branch Swap - RANGER 5</title>
    </head>
<body>
<h1>Branch Swap</h1>
     <div class="center">
    <form action="" method="post">
         <p1>Username: </p1><input disabled value="<?php echo $usernm?>"><br>
        <p1>Site: </p1><select name="site" required autofocus onchange="this.form.submit()">
        <?php 
    $sql = "SELECT * FROM cbra c INNER JOIN stmf s ON s.st_code = c.cb_site WHERE c.cb_user = '$usernm'";
                                   $result = $conn->query($sql);
                                   if ($result->num_rows > 0) {
                                       while($row = $result->fetch_assoc()) {
                                           ?>
        <option <?php if ($row["cb_site"] ==$site_cd) {echo "selected";}?> value="<?php echo $row["cb_site"];?>"><?php echo $row["st_name"];?></option>
        <?php
                                       }
                                   }
    
    ?>
        
        
        </select>
         <br>

         </form>
    
    </div>
    <?php if (!empty($_POST)) {
    $site = $conn -> real_escape_string($_POST["site"]);
    $sql = "UPDATE usmf SET us_site = '$site' WHERE us_user = '$usernm'";
    $conn->query($sql);
    echo "<script>
    alert('Site swapped successfully');
    location.replace('sf_cbra.php');</script>";
} ?>
    
    </body>
</html>
