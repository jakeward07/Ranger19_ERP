<?php 
$prog = "oe_header";
$mod = "oe";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>Order Header - RANGER 5</title>
    </head>
<body><h1>Sales Order Entry</h1>
    <div class="bodystrip">
    <button onclick="findOrd()">Find Order</button>
    </div>
<form action="" method="post">
   <div class="left">
    <p1>Sales Rep: </p1><select autofocus id="hd_rep" onchange="showCust()" required>
       <option></option>
       <?php include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/dropdowns/sales_reps2.php');?>
      
       </select>     <input id="oh_userinput" name="oh_user" hidden><br>
    <span hidden id="hd_cust"><p1>Customer: </p1>
          <input onblur="disableCust(); isHeld();" list="cust" id="custVal" onchange="getCust()" on name="oh_cust" required>
  <datalist id="cust">
      <?php include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
      $sql = "SELECT * FROM cumf";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
      ?>
      <option onclick="getCust()" id="custVal" value="<?php echo $row["cu_id"];?>"><?php echo "Account: ", $row["cu_name"], ' - Alias: ', $row["cu_alias"]; ;?></option>
      
      <?php }}?>
  </datalist><br>
       </span>
       <span id="custDet">
       </span>
    </div><?php include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
    $sql = "SELECT oh_order FROM orhd WHERE oh_site = '$site_cd' ORDER BY oh_order DESC LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
       ?>
    <div class="right">
    <p1>Sales Order: </p1><input disabled value="<?php echo $row["oh_order"]+1;?>"><br>
    <input name="hd_order" hidden value="<?php echo $row["oh_order"]+1;?>"><?php }}?>
    <p1>Date: </p1><input disabled value="<?php echo date("d/m/Y");?>"><br>
    <p1>Site: </p1><select onchange="javascript:document.getElementById('site').value = document.getElementById('site_sel').value;" id="site_sel" <?php if ($sec !=="ADM") {echo "disabled";}?> name="site">
        <?php include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/dropdowns/sites.php');?>
        </select>
    <input id="site" name="oh_site" value="<?php echo $site_cd;?>" hidden><br>
    <br>
        <span id="but" hidden>  <button type="submit" id="button" class="submit">Create Order</button></span></div>

    </form>
    <div class="searchBox" id="orderFind" hidden style="width:400px">
        <button onclick="findOrd()" class="exit">X</button>
    <h2>Find Order</h2>
        <div class="center">
        <form action="" method="post">
            <p1>Sales Order: </p1><input id="sorder" name="order" autocomplete="off" type="tel" maxlength="6"><br>
            <button type="submit" class="submit">Find Order</button>
            
            </form>
        
        </div>
    </div>
         <?php
    if (!empty($_POST)) { 
    if (!empty($_POST["order"])) {
        //VERIFY ORDER EXISTS
        $order = $_POST["order"];
          $sql = "SELECT * FROM orhd WHERE oh_order = '$order' AND oh_site = $site_cd";
        $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if ($row["oh_status"] =="Invoiced") {
                echo "<script>alert('Order has been invoiced in full.')</script>";
            } else {
            $cust = $row["oh_cust"];
            echo "<script>location.replace('oe_lines.php?o=$order&c=$cust');</script>";
        }}} else {
        echo "<script>alert('Order does not exist');</script>";
    }
    }
    else {
    include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
        $sql = "INSERT INTO orhd (oh_order, oh_site, oh_cust, oh_user, oh_cupo, oh_cujb, oh_stampuser)
        VALUES ('$_POST[hd_order]','$_POST[oh_site]','$_POST[oh_cust]','$_POST[oh_user]','$_POST[oh_cupo]','$_POST[oh_cujb]','$usernm')";
  $conn->query($sql);
        echo "<script>location.replace('oe_lines.php?o=$_POST[hd_order]');</script>";
    }}
    
    
    
    ?>
    
    </body>
</html>

  <script>
      function findOrd() {
          var y = document.getElementById("orderFind");
          var x = document.getElementById("sorder");
          if (y.style.display ==="block") {
              y.style.display = "none";
          }
          else {
              y.style.display = "block";
              x.focus();
          }
      }
    function showCust() {
        var a = document.getElementById("hd_cust");
        var b = document.getElementById("hd_rep");
        var d = document.getElementById("oh_userinput");
         var c = document.getElementById("custVal");
        if (b.value !=="") {
      a.style.display = "block";
         d.value = b.value; 
 
        }
      else {
          a.style.display = "none";
          
      }
    }
      function getCust() {
          var c = document.getElementById("custVal");
          var h = document.getElementById("holdS");
          var j = document.getElementById("hldact");
          var k = document.getElementById("hldtxt");
          
    if (c.value == "") {

        document.getElementById("custDet").innerHTML = "";
        return;
    } else {
                document.getElementById("hd_rep").disabled = true;
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("custDet").innerHTML = this.responseText;
           
            }
            
        };
        xmlhttp.open("GET","get_cust.php?q="+c.value,true);
        xmlhttp.send();
       
        
    }
}
      
      function isHeld() {
          var c = document.getElementById("custVal");
          var h = document.getElementById("holdS");
          var j = document.getElementById("hldact");
          var k = document.getElementById("hldtxt");
          var p = document.getElementById("pswd");
          if (j.value !=="") {
             if (j.value =='msg') {
                 alert(k.value);
             }
              else if (j.value =='msg + no_use') {
                  alert(k.value);
                  location.replace("oe_header.php");
              }
              else if (j.value =='msg + password') {
                  var x = prompt("Enter password to access account");
                  if (x !==p.value) {
                      alert("Password is wrong");
                        location.replace("oe_header.php");
                      
                  }
              }
          }
      }
      
      function disableCust() {
     var b = document.getElementById("but");
          var c = document.getElementById("hd_cust");
        c.style.display = "none";
          b.style.display = "block";
      }
      
 
  
    </script>  
