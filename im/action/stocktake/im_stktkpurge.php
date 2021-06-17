<?php 
$prog = "im_stktkpurge";
$mod = "im";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>Purge a Stocktake - RANGER 5</title>
    </head>
<body>
<h1>Stocktake Purge</h1>
     <div class="center">
         <form onsubmit="confirmPurge()" action="" id="form" method="post">
    <p1>Stocktake ID: </p1><input name="id" id="id" required autocomplete="off" autofocus><br>
    <button type="submit" class="submit">Purge Stocktake</button>   
         </form>
    </div>
    <?php if (!empty($_POST)) {
    $purgeId = $conn -> real_escape_string($_POST["id"]);
    //Ensure stocktake ID exists
    $sql = "SELECT * FROM sthd WHERE st_code = $purgeId AND st_site = $site_cd AND NOT st_status = 'Purged'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            //Record exists
            $sql = "UPDATE sthd SET st_status = 'Purged' WHERE st_code = $purgeId AND st_site = $site_cd";
            $conn->query($sql);
            $sql2 = "DELETE FROM stln WHERE ln_stkid = $purgeId AND ln_site = $site_cd";
            $conn->query($sql2);
            echo "<script>alert('Stocktake ID: $purgeId has been purged successfully.');</script>";
        }
    }
    else {
        echo "<script>alert('Stocktake ID: $purgeId does not exist!');</script>";
    }
}?>
    <script>
    function confirmPurge(){
        var x = document.getElementById("form");
        var id = document.getElementById("id");
        var c = confirm("Are you sure you want to purge stocktake ID: "+id.value+"?");
        if (c ==true) {
            x.submit();
        } else {
            id.value = "";
            id.focus();
            
        }
    }
        
    
    </script>
    
    </body>
</html>
