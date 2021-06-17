<?php 
$prog = "po_header";
$mod = "po";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
if ($po == "0.00") {
    echo "<script>location.replace('/erp/error_pages/access_error.php')</script>";
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>Purchase Order Creation - RANGER 5</title>
    </head>
<body>
<h1>Purchase Order Creation</h1>
<form action="" method="post">
    <div class="left">
    <p1>Supplier: </p1> <input onblur="doValidate()" name="ph_supp" onchange="showUser(); getContract()" autofocus required id="po_supp" list="supplier" autocomplete="off"><br>
    <datalist id="supplier">
        <?php 
        $sql = "SELECT * FROM sumf WHERE su_status = 1 ORDER BY su_code";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
        <option value="<?php echo $row["su_code"];?>">Name: <?php echo $row["su_name"];?> | Alias: <?php echo $row["su_alias"];?></option>
        
        <?php
            }
        }
        ?>
        
        
        </datalist>
       <span hidden id="po_user"> 
           <p1 id="contract"></p1><br>
           <p1>User: </p1> <select required name="ph_user" onchange="showSubmit()">
        
       <option></option>
        <?php 
            $sql = "SELECT * FROM usmf WHERE us_site = $site_cd";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
            <option id="suppVal" value="<?php echo $row["us_user"];?>"><?php echo $row["us_name"];?></option>
            <?php
                }
            }
        
        ?>
        </select>
        </span>

    
    </div>
    <span id="right" hidden>
    <div class="right">
    <p1>Order Number: </p1><input id="order" value="
<?php 
        $sql = "SELECT ph_order FROM pohd WHERE ph_site = $site_cd ORDER BY ph_order DESC LIMIT 1";
        $res = $conn->query($sql);
        if ($res->num_rows > 0){
            while ($r = $res->fetch_assoc()) {
echo $r["ph_order"]+1;
            }
        }
        ?>" disabled>
    <br>
        <p1>Warehouse: </p1><select id="site" onchange="javascript= document.getElementById('hidSite').value = this.value; getOrderNum()" disabled name="ph_site">
        <?php 
        $sql = "SELECT * FROM stmf";
        $res = $conn->query($sql);
        if ($res->num_rows > 0) {
            while($r = $res->fetch_assoc()) {
                ?>
        <option <?php if ($r["st_code"] ==$site_cd) {echo "selected";}?> value="<?php echo $r["st_code"];?>"><?php echo $r["st_name"];?></option>   
        <?php
            }
        }
        ?>
        
        </select><br>
        <span hidden id="submit"> <button type="submit" class="submit">Create PO</button></span>
    </div>
    </span>
       <span id="hiddenDetails" hidden>
        <input name="ph_order" id="hidOrder">
        <input name="ph_site" id="hidSite">
        </span> 
    
    </form>     
    <?php 
    if (!empty($_POST)) {
    $sql = "INSERT INTO pohd (ph_order, ph_supp, ph_user, ph_site, ph_stampuser, ph_contract) values 
    ('$_POST[ph_order]','$_POST[ph_supp]','$_POST[ph_user]','$_POST[ph_site]','$usernm', '$_POST[ph_contract]')";
  $conn->query($sql);
        $ord = $_POST["ph_order"];
        $con = $_POST["ph_contract"];
        $sup = $_POST["ph_supp"];
        echo "<script>location.replace('po_lines.php?o=$ord');</script>";
    }
    ?>
<script>
    function showUser() {
        var x = document.getElementById("po_user");
        var y = document.getElementById("po_supp");
        var z = document.getElementById("right");
        if (y.value !=="") {
            x.style.display = "block";
            x.focus();
            z.style.display = "block";
        }
        else {
           x.style.display = "none"; 
            z.style.block = "none";
        }
    }
    
    function verifySupp(idDataList, inputValue) {
  var option = document.querySelector("#" + idDataList + " option[value='" + inputValue + "']");
  if (option != null) {
    return option.value.length > 0;
  }
  return false;
}

function doValidate() {
         var x = document.getElementById("po_user");
     var y = document.getElementById("po_supp");
      var z = document.getElementById("right");
  if (verifySupp('supplier', document.getElementById('po_supp').value)) {
  
  } else {
    alert("Invalid Supplier");
      x.style.display = "none";
      y.value = "";
      z.style.display = "none";
    
  }
}
    
    function showSubmit() {
        var x = document.getElementById("submit");
        var y = document.getElementById("po_user");
        var b = document.getElementById("hidOrder");
        var a = document.getElementById("order");
        var t = document.getElementById("site");
        var s = document.getElementById("hidSite");
        if (y.value !=="") {
            x.style.display = "block";
            b.value = a.value;
            s.value = t.value;
            
        }
        else {
            x.style.display = "none";
        }
    }
    
      function getOrderNum() {
          var o = document.getElementById("order");
          var x = document.getElementById("hidSite");
          
    if (o.value == "") {

        document.getElementById("order").value = "";
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
                document.getElementById("order").value = this.responseText;
            
            }
        };
        xmlhttp.open("GET","/po/ajax/get_ordnum.php?q="+x.value,true);
        xmlhttp.send();
         
    }
}
    function getContract() {
          var x = document.getElementById("po_supp");
          
    if (x.value == "") {

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
                document.getElementById("contract").innerHTML = this.responseText;
            
            }
        };
        xmlhttp.open("GET","/po/ajax/get_contract.php?q="+x.value,true);
        xmlhttp.send();
         
    }
}
    

    
    </script>
    
    </body>
</html>
