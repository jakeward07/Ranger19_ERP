<?php 
$prog = "sf_user";
$mod = "sf";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>User Maintenance - RANGER 5</title>
    </head>
<body>
<h1>User Maintenance</h1>
    <?php if (empty($_GET)) { ?>

     <div class="searchBox" style='width:600px;'>
    <h1>User Search Prompt</h1>
         <?php if (empty($_POST)) { ?>
         <div class="center">
             <form action="" method="post">
            
         <p1>Username: </p1> <input autofocus name="usernm" autocomplete="off"><br>
         <p1>Name: </p1> <input name="name" autocomplete="off"><br>
                 
         <p1>Security: </p1>     <select name="sec">
             <option></option>
                 <?php 
                 $sql = "SELECT * FROM priv ORDER BY p_name";
                 $result = $conn->query($sql);
                 if($result->num_rows > 0) {
                     while($row = $result->fetch_assoc()) {
                         ?>
             <option value="<?php echo $row["p_name"];?>"><?php echo $row["p_name"], ' - ', $row["p_desc"];?></option>
             <?php }}?>
             </select><br>
         <p1>Site: </p1> 
             <select name="site">
             <option></option>
                 <?php 
                 $sql = "SELECT * FROM stmf";
                 $result = $conn->query($sql);
                 if($result->num_rows > 0) {
                     while($row = $result->fetch_assoc()) {
                         ?>
                 <option value="<?php echo $row["st_code"];?>"><?php echo $row["st_code"], ' - ', $row["st_name"];?></option>  
                 <?php
                     }
                 }
                 ?>
             
             </select><br>
              <a href="sf_user.php?action=new"><button type="button" class="submit">New User</button></a>   <button type="submit" class="submit">Find User</button>
             </form>
             <?php } if (!empty($_POST)) { ?>
             <table style="width:600px; text-align:center">
             <tr>
                 <th>Username</th>
                 <th>Name</th>
                 <th>Site</th>
                 <th>Security</th>
                 <th>Action</th>
                 </tr>
               
                 <?php 
    $ConditionArray = array();
    $users = $_POST["usernm"];
    $names = $_POST["name"];
    $secs = $_POST["sec"];
    $sites = $_POST["site"];
    if ($users != '') $ConditionArray[] = "us_user = '$users'";
    if ($names != '') $ConditionArray[] = "us_name LIKE '$names%'";
    if ($secs != '') $ConditionArray[] = "us_sec = '$secs'";
    if ($sites != '') $ConditionArray[] = "us_site = '$sites'";


if (count($ConditionArray) > 0)
{
    $sql = "
    SELECT *
    FROM usmf
    WHERE ".implode(' AND ', $ConditionArray);
}

$result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row=$result->fetch_assoc()) {
            if ($result->num_rows ==1) {
                echo "<script>location.replace('sf_user.php?view=$row[us_user]');</script>";
            }
         
      
    ?><tr>
                     <td><?php echo $row["us_user"];?></td>
                     <td><?php echo $row["us_name"];?></td>
                     <td><?php echo $row["us_site"];?></td>
                     <td><?php echo $row["us_sec"];?></td>
                 <td><a href="sf_user.php?view=<?php echo $row["us_user"];?>">View User</a></td>
                 </tr>
                 <?php  }
      
            
    }?>
             </table>
         </div>
    </div>
    <?php }}?>
    <?php if (!empty($_GET["view"])) {
    $u = $_GET["view"];
    $sql = "SELECT * FROM usmf WHERE us_user = '$u'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $s = $row["us_sec"];
            $stk = $row["us_stkadj"];
            $st = $row["us_site"];
            $pol = $row["us_polmt"];
            $email = $row["us_email"];
            ?>
    <div class="center">
        <?php if (!empty($_GET["result"])) { ?>
        <div class="success">User Updated Successfully.</div>
        <?php } ?>
        <form action="" method="post">
            <input name="type" value="update" hidden>
    <p1>Username: </p1> <input value="<?php echo $row["us_user"];?>" disabled><br>
    <p1>Name: </p1> <input name="us_name" required value="<?php echo $row["us_name"];?>" autocomplete="off"><br>
            <p1>Email: </p1><input name="us_email" autocomplete="off" value="<?php echo $email;?>" required type="email"><br>
    <p1>Site: </p1> <select name="us_site">
         <?php
            $sql = "SELECT * FROM stmf ORDER BY st_code";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    ?>
            <option <?php if ($row["st_code"] ==$st) {echo "selected";}?> value="<?php echo $row["st_code"];?>"><?php echo $row["st_name"], ' (', $row["st_code"], ')';?></option>
            <?php
                }
            }?>
            
            </select>
            <br><br>
         <p1>Stock Adjustments: </p1> <select name="us_stkadj">
        <option <?php if ($stk ==0) {echo "selected";} ?> value="0">No</option>
        <option <?php if ($stk ==1) {echo "selected";} ?> value="1">Yes</option>
        </select><br>
            <p1>PO Limit: </p1><input name="us_polmt" <?php if ($sec =="ADM") {echo "max='10000'";}?> value="<?php echo $pol;?>" required type="number" step="0.01" autocomplete="off"><br>
        <p1>Security: </p1><select required name="us_sec">
        <?php 
            if ($sec !=="ADM") {
                $sql = "SELECT * FROM priv WHERE p_vis = 1";
            }
            else {
            $sql = "SELECT * FROM priv";
            }
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    ?>
        <option <?php if ($s ==$row["p_name"]) {echo "selected";}?> value="<?php echo $row["p_name"];?>"><?php echo $row["p_name"], ' - ', $row["p_desc"];?></option>
        <?php
                }
            }
        
        ?>
        </select>
    <br>
      <p1>Password: </p1><input onmouseout="chgAttrib2()" onmouseover="chgAttrib()" type="password" id="pw1" name="us_password" onkeyup="pwChg()"><br>
      <p1>Password Again: </p1><input onkeyup="doesMatch()" type="password" disabled id="pw2"><br>
      <p1 id="pwM"></p1>
    <br>
        <span id="submit"><button type="submit" class="submit">Update User</button></span>
        </form>
            </div>
    
    <?php
            if (!empty($_POST)) {
                if ($_POST["type"] =="update") {
                if (empty($_POST["us_password"])) {
                $sql = "UPDATE usmf SET us_name = '$_POST[us_name]', us_email = '$_POST[us_email]', us_stkadj = '$_POST[us_stkadj]', us_sec = '$_POST[us_sec]', us_site = '$_POST[us_site]', us_polmt = '$_POST[us_polmt]' WHERE us_user = '$_GET[view]'";
              $conn->query($sql);
            }
            else {
                $pw = $_POST["us_password"];
                $passw = password_hash($pw, PASSWORD_DEFAULT);
                
 $sql = "UPDATE usmf SET us_name = '$_POST[us_name]', us_stkadj = '$_POST[us_stkadj]', us_sec = '$_POST[us_sec]', us_password = '$passw', us_site = '$_POST[us_site]', us_polmt = '$_POST[us_polmt]' WHERE us_user = '$_GET[view]'";
            $conn->query($sql);    
            }
      
            echo "<script>location.replace('sf_user.php?view=$_GET[view]&result=1');</script>";
        }

            }
    }}
    
    ?>
    
    
    <?php }
    if ($_GET["action"] =="new") {
        ?>
    <div class="center">
      <form action="" method="post">
          <input name="type" value="new" hidden>
    <p1>Username: </p1> <input name="us_user" required autocomplete="off" autofocus><br>
    <p1>Name: </p1> <input name="us_name" required autocomplete="off"><br>
    <p1>Email: </p1><input name="us_email" required autocomplete="off" type="email"><br>
    <p1>Links: </p1><select name="us_link">
          <option value="0">Open in new tab</option>
          <option value="1" selected>Replace page</option>
          
          </select><br>
    <p1>Site: </p1> <select name="us_site">
         <?php
            $sql = "SELECT * FROM stmf ORDER BY st_code";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    ?>
            <option value="<?php echo $row["st_code"];?>"><?php echo $row["st_name"], ' (', $row["st_code"], ')';?></option>
            <?php
                }
            }?>
            
            </select>
            <br><br>
         <p1>Stock Adjustments: </p1> <select name="us_stkadj">
        <option value="0">No</option>
        <option value="1">Yes</option>
        </select><br>
            <p1>PO Limit: </p1><input name="us_polmt" <?php if ($sec !=="ADM") {echo "max='10000'";}?> required type="number" step="0.01" autocomplete="off"><br>
        <p1>Security: </p1><select required name="us_sec">
        <?php 
            if ($sec !=="ADM") {
                $sql = "SELECT * FROM priv WHERE p_vis = 1";
            }
            else {
            $sql = "SELECT * FROM priv";
            }
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    ?>
        <option value="<?php echo $row["p_name"];?>"><?php echo $row["p_name"], ' - ', $row["p_desc"];?></option>
        <?php
                }
            }
        
        ?>
        </select>
    <br>
      <p1>Password: </p1><input required onmouseout="chgAttrib2()" onmouseover="chgAttrib()" type="password" id="pw1" name="us_password" onkeyup="pwChg()"><br>
      <p1>Password Again: </p1><input required onkeyup="doesMatch()" type="password" disabled id="pw2"><br>
      <p1 id="pwM"></p1>
    <br>
        <span id="submit"><button type="submit" class="submit">Update User</button></span>
        </form>
            </div>
    
    </div>
    
    
    <?php if (!empty($_POST)) {
 $pw = $_POST["us_password"];
    $passw = password_hash($pw, PASSWORD_DEFAULT);
    $sql = "INSERT INTO usmf (us_user, us_name, us_stkadj, us_sec, us_password, us_site, us_polmt, us_email, us_link, us_stampuser) VALUES ('$_POST[us_user]','$_POST[us_name]','$_POST[us_stkadj]','$_POST[us_sec]','$passw','$_POST[us_site]','$_POST[us_polmt]','$_POST[us_email]','$_POST[us_link]','$usernm')";
                $conn->query($sql);
            
        }
    }
    ?>
<script>
    
    function pwChg() {
        var x = document.getElementById("pw1");
        var y = document.getElementById("pw2");
        var z = document.getElementById("pwM");
        var s = document.getElementById("submit");
        if (x.value !=="") {
            y.disabled = false;
            y.required = true;
            s.style.display = "none";
          }
        else {
            y.disabled = true;
            y.required = false;
            z.style.display = "none";
            s.style.display = "block";
        }
    }
    
    function doesMatch() {
           var x = document.getElementById("pw1");
        var y = document.getElementById("pw2");
        var z = document.getElementById("pwM");
          var s = document.getElementById("submit");
        if (x.value ==y.value) {
            z.innerHTML = "Passwords Match";
            s.style.display = "block";
        }
        else {
            z.innerHTML = "Password does not match";
            s.style.display = "none";
        }
    }
    
    function chgAttrib() {
           var x = document.getElementById("pw1");
        var y = document.getElementById("pw2");
    if (x.type =="password") {
        x.type = "text";
    }
   
        }
    
       
    function chgAttrib2() {
           var x = document.getElementById("pw1");
        var y = document.getElementById("pw2");
    if (x.type =="text") {
        x.type = "password";
    }
   
        }
    
    
    </script>
  
    </body>
</html>
