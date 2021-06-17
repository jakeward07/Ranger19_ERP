<?php 
$prog = "sf_dbtrunc";
$mod = "sf";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>Truncate - RANGER 5</title>
    </head>
<body>
<h1>Database Truncate</h1>
     
    <div class="center"><p1>Hitting the below button will truncate POHD, POLN, ORHD, ORLN, PODP, OEDP and set IMWH = 0.</p1><br>
    <a href="db_trunc.php?success=1"><button class="submit">Truncate</button></a>
    
    
    </div>
    <?php if (!empty($_GET["success"])) {
   $sql = "TRUNCATE poln";
    $conn->query($sql);
     $sql = "TRUNCATE pohd";
    $conn->query($sql);
     $sql = "TRUNCATE podp";
    $conn->query($sql);
     $sql = "TRUNCATE oedp";
    $conn->query($sql);
     $sql = "TRUNCATE orhd";
    $conn->query($sql);
     $sql = "TRUNCATE orln";
    $conn->query($sql);
     $sql = "TRUNCATE immv";
    $conn->query($sql);
      $sql = "TRUNCATE invh";
    $conn->query($sql);
      $sql = "TRUNCATE invl";
    $conn->query($sql);
       $sql = "TRUNCATE imwh";
    $conn->query($sql);
      $sql = "TRUNCATE eshd";
    $conn->query($sql);
      $sql = "TRUNCATE esln";
    $conn->query($sql);
    
    $sql = "INSERT INTO imwh (im_id, wh_site) (SELECT i.im_id, s.st_code FROM immf i JOIN stmf s)";
    $conn->query($sql);
    $sql = "INSERT INTO orhd (oh_order, oh_site, oh_status) (SELECT '200000', st_code, 'Invoiced' FROM stmf)";
    $conn->query($sql);
    $sql = "INSERT INTO pohd (ph_order, ph_site) (SELECT '100000', st_code FROM stmf)";
    $conn->query($sql);
     $sql = "INSERT INTO invh (vh_inv, vh_site) (SELECT '100000', st_code FROM stmf)";
    $conn->query($sql);
    $sql = "INSERT INTO eshd (es_quote, es_site) (SELECT '300000', st_code FROM stmf)";
    $conn->query($sql);
     $sql = "TRUNCATE arbl";
    $conn->query($sql);
    echo $conn->error;
}?>
    
    </body>
</html>
