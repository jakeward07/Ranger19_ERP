<?php 
$prog = "sf_changepassword";
$mod = "sf";
$pname = "Change your Password";
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
         <span id="fail" hidden><div class="success" style="background-color:red; border-color:darkred">Password's do not match</div></span>
         <span id="success" hidden><div class="success">Password's match!</div></span>
    <form action="" method="post">
         <p1>New Password: </p1><input name="pw1" type="password" id="pw1" required autocomplete="off" autofocus><br>
         <p1>Confirm New Password: </p1><input name="pw2" onkeyup="verify()" type="password" id="pw2" required><br>
         <br>
        <span id="showSub" hidden><button type="submit" class="submit">Reset Password &rarr;</button></span>
         
         </form>
    </div>
    <script>
        function verify() {
    var x = document.getElementById("fail");
    var y = document.getElementById("success");
    var z = document.getElementById("showSub");
    var p1 = document.getElementById("pw1");
    var p2 = document.getElementById("pw2");
        if (p2.value !=="") {
            if (p2.value ==p1.value) {
                y.style.display = "block";
                x.style.display = "none";
                z.style.display = "block";
            }
            else {
                x.style.display = "block";
                y.style.display = "none";
                z.style.display = "none";
            }
        }
            else {
                y.style.display = "none";
                x.style.display = "none";
                z.style.display = "none";
            }
        }
    </script>
    <?php 
    if (!empty($_POST)) {
        //sanitise
        $pw1 = $conn -> real_escape_string($_POST["pw1"]);
        $pw2 = $conn -> real_escape_string($_POST["pw2"]);
        $pw = password_hash($pw1, PASSWORD_DEFAULT);
        if ($pw1 == $pw2) {
            $sql = "UPDATE usmf SET us_password = '$pw' WHERE us_user = '$usernm'";
            $conn->query($sql);
            echo "<script>alert('Password updated successfully.');location.replace('sf_changepassword.php');</script>";
        }
    }?>
    
    </body>
</html>
