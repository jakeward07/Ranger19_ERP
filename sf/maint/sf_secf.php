<?php 
$prog = "sf_secf";
$mod = "sf";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>Security Maintenance - RANGER 5</title>
    </head>
<body>
<h1>Security Maintenance</h1>
    <div class="bodystrip">
    <?php if (empty($_GET)) {?><a href="sf_secf.php?action=new"><button>New Program</button></a><?php } else {?><a href="sf_secf.php"><button>&larr; Go Back</button></a><?php } ?>
    </div>
    <?php if (empty($_GET["action"])) { ?>
    <form action="" method="post">
   <div class="center">
    <p1>Enter a Program Code: </p1><input autofocus placeholder="Eg: oe_header, im_enq..." id="input" onkeyup="fetchSecf()" autocomplete="off" type="text">
    
    </div>  
    <span id="display"></span>
     
     
    </form>
        <script>
     function fetchSecf() {
          var o = document.getElementById("input");
          var x = document.getElementById("display");
          
    if (o.value == "") {

   
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
                x.innerHTML = this.responseText;
            
            }
        };
        xmlhttp.open("GET","/sf/ajax/sf_secf.php?q="+o.value,true);
        xmlhttp.send();
         
    }
}
    </script> <?php } else { ?>
    <form action="" method="post">
    <div class="center">
        <p1>Program Name: </p1><input placeholder="This is the value defined against the $prog variable" required name="sc_prog" autocomplete="off" autofocus>
        </div>
        <div class="left">
        <p1>Program Name: </p1><input name="sc_name" required autocomplete="off"><br>
<p1>Shortcut: </p1><input name="sc_code" required autocomplete="off"><br>
<p1>Visible: </p1><select name="sc_visible">
    <option value="0">No</option>
    <option selected value="1">Yes</option>
    </select>      
    </div>
    <div class="right">
<p1>Path: </p1><input name="sc_path" required autocomplete="off"><br>
    <p1>Groups Permitted: </p1><input name="sc_group" required autocomplete="off"><br>
    <p1>Users Permitted: </p1><input name="sc_users" required autocomplete="off"><br>
    <button class="submit" type="submit">Create Record</button>
</div>
    
    
    
    
    
    </form>
    <?php }?>
    <?php if (!empty($_POST)) {
    //Define variables for sanitisation
    $program = $conn->real_escape_string($_POST["sc_prog"]);
    $name = $conn->real_escape_string($_POST["sc_name"]);
    $code = $conn->real_escape_string($_POST["sc_code"]);
    $vis = $conn->real_escape_string($_POST["sc_visible"]);
    $path = $conn->real_escape_string($_POST["sc_path"]);
    $group = $conn->real_escape_string($_POST["sc_group"]);
    $users = $conn->real_escape_string($_POST["sc_users"]);
    $pid = $_POST["sc_id"];
    if (!empty($_GET)) {
        $sql = "INSERT INTO prsc (sc_code, sc_name, sc_prog, sc_path, sc_users, sc_group, sc_visible) VALUES ('$code','$name','$program','$path','$users','$group','$vis')";
        $conn->query($sql);
        echo "<script>location.replace('sf_secf.php?action=new&m=1');</script>";
    }
    else {
        $sql = "UPDATE prsc SET sc_code = '$code', sc_name = '$name', sc_path = '$path', sc_users = '$users', sc_group = '$group', sc_visible = '$vis', sc_prog = '$program' WHERE sc_id = '$pid'";
        $conn->query($sql);
        
    }
} ?>
    </body>
</html>
