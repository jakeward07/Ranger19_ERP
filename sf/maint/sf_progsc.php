<?php 
$prog = "sf_progsc";
$mod = "sf";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>Program Shortcuts - RANGER 5</title>
    </head>
<body>
<h1>Program Shortcuts</h1>
    <?php if (!empty($_GET)) {
    if ($_GET["success"] ==1) {
        echo "<div class='success'>Program Shortcut Added.</div>";
    }
    else {
        echo "<div class='fail'>Program Shortcut already exists.</div>";
    }
}?>
    <div class="center">
    <form action="" method="post">
        
        <p1>Program Shortcut: </p1> <input id="sc" name="pr_sc" required autocomplete="off" autofocus><br>
        <p1>Program Path: </p1> <input id="pt" name="pr_pt" required autocomplete="off" autofocus><br>
        <button type="submit" class="submit">Add Shortcut</button>
        
        
        </form>
    <?php if (!empty($_POST)) {
    $sql2 = "SELECT * FROM prsc WHERE sc_code = '$_POST[pr_sc]'";
    $result = $conn->query($sql2);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<script>location.replace('sf_progsc.php?success=2');</script>";
        }
    } else {
    $sql = "INSERT INTO prsc (sc_code, sc_path) VALUES ('$_POST[pr_sc]','$_POST[pr_pt]')";
    $conn->query($sql);
    echo "<script>location.replace('sf_progsc.php?success=1');</script>";
    
    
}} echo $conn->error;
    ?>
    </div>
    
    
    </body>
</html>
