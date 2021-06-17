<?php 
$prog = "oe_header";
$mod = "oe";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>Order Entry - RANGER 5</title>
    </head>
<body>
<h1>Sales Order Entry</h1>
    <?php
    $o = $_GET["o"];
    $view = $_GET["view"];
    if (empty($view)) { ?>
    <div class="bodystrip">
        <?php $sql = "SELECT oh_order FROM orhd WHERE oh_site = $site_cd ORDER BY oh_order DESC LIMIT 1";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
            $orderId = $row["oh_order"];
        } ?>
    <button onclick="findOrd()">Find Order</button>
        <a href="oe_header.php?view=true&o=<?php if (empty($o)) {echo $orderId;} else {echo $orderId-1;}?>"><button>&larr; Previous Order</button></a>
    </div>
     <form action="" method="post">
    <div class="left">
<p1>Customer: </p1><input name="oh_cust" onblur="if (this.value.length >= 6) {this.readOnly = true;}" onkeyup="fetchCustomerReq()" id="cuid" list="cumf" required autocomplete="off" autofocus>
        <datalist id="cumf">
        <?php
            $sql = "SELECT * FROM cumf WHERE cu_status = 1";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    ?>
            <option value="<?php echo $row["cu_id"];?>"><?php echo $row["cu_name"], ' | ', $row["cu_alias"];?></option>
            <?php
                }
            } ?>
        </datalist><br>
         <span id="custReq"></span>
         
         </div>
         <div class="right">
         <p1>Sales Order: </p1><input value="<?php
             $sql = "SELECT oh_order FROM orhd WHERE oh_site = $site_cd ORDER BY oh_order DESC LIMIT 1";
             $result = $conn->query($sql);
             if ($result->num_rows > 0) {
                 while($row = $result->fetch_assoc()) {
                     echo $row["oh_order"]+1;
                 }
             }
         ?>" disabled><br>
            <p1>User: </p1><select name="oh_user" required>
             <option></option>
             <?php
             $sql = "SELECT * FROM usmf WHERE us_site = $site_cd";
             $result = $conn->query($sql);
             if ($result->num_rows > 0) {
                 while($row = $result->fetch_assoc()) {
                     ?>
             <option value="<?php echo $row["us_user"];?>"><?php echo $row["us_name"];?></option>
             <?php }}?>
             </select><br>
            <button type="submit" class="submit">Create Order Header &rarr;</button>
         </div>
        
    
    </form><?php
        if (!empty($_POST)) {
        //Sanitize POST data
        $oh_cust = $conn -> real_escape_string($_POST["oh_cust"]);
        $oh_cuname = $conn -> real_escape_string($_POST["oh_cuname"]);
        $oh_cupo = $conn -> real_escape_string($_POST["oh_cupo"]);
        $oh_cujb = $conn -> real_escape_string($_POST["oh_cujb"]);
        $oh_user = $conn -> real_escape_string($_POST["oh_user"]);
       //Fetch last order number for order header creation
        $sql = "SELECT oh_order FROM orhd WHERE oh_site = $site_cd ORDER BY oh_order DESC LIMIT 1";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                //Define variable
                $orderNum = $row["oh_order"]+1;
                //Create orhd record
                $sql = "INSERT INTO orhd (oh_order, oh_site, oh_cust, oh_cuname, oh_user, oh_cupo, oh_cujb, oh_status, oh_stampuser) VALUES ('$orderNum','$site_cd','$oh_cust','$oh_cuname','$oh_user','$oh_cupo','$oh_cujb','Open','$usernm')";
                if ($conn->query($sql) === TRUE) {
                    //Insert transaction successful. Redirect to oe_lines program.
                    echo "<script>location.replace('oe_lines.php?o=$orderNum');</script>";
                } else {
                    //Insert transaction unsuccessful. Outline errors.
                    echo "<div class='blackout' id='transError'><div class='fail'><h2>Error</h2><button onclick='document.getElementById(\"transError\").style.display = \"none\";'>X</button>There has been an error!<br> Please contact your system administrator with the following details.<br>Error Type: Transaction error.<br>Error Code: orhd.001<br>More Details: $conn->error                   
                    </div></div>";
                    
                }
            }
        } else {
            //Error with selection order number.
          echo "<div class='blackout' id='transError'><div style='height:85px' class='fail'><h2>Error</h2><button onclick='document.getElementById(\"transError\").style.display = \"none\";'>X</button>There was an error fetching order number. Please refer this to SnakeBite Software. <br> Error Code: orhd.002                  
                    </div></div>";
        }
        
    }?>
    <?php } else if ($view =='true') { 
         $sql = "SELECT oh_order FROM orhd WHERE oh_site = $site_cd ORDER BY oh_order DESC LIMIT 1";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
            $orderId = $row["oh_order"];
        } 
    $sql = "SELECT * FROM orhd WHERE oh_order = $o AND oh_site = $site_cd";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
    ?>
    <div class="bodystrip">
       <?php if ($o > 200000) {?><a href="oe_header.php?view=true&o=<?php if (empty($o)) {echo $orderId;} else {echo $o-1;}?>"><button>&larr; Previous Order</button></a><?php }?>
        <?php if ($o !==$orderId) { ?><a href="oe_header.php?view=true&o=<?php if (empty($o)) {echo $orderId;} else {echo $o+1;}?>"><button>Next Order &rarr;</button></a><?php } ?>
    <button onclick="findOrd()">Find Order</button>
   <?php if ($row["oh_status"] =='Invoiced') {} else {?> <button onclick="updateHeader()">Update Order Header</button><?php }?>
    </div>
     <form action="" method="post">
         
    <div class="left">
<p1>Customer: </p1><input name="oh_cust" value="<?php echo $row["oh_cust"];;?>" disabled id="cuid"><br>
        <p1>Customer Name: </p1><input id="oh_cuname" name="oh_cuname" value="<?php echo $row["oh_cuname"];?>" disabled autocomplete="off"><br>
        <p1>Purchase Order: </p1><input id="oh_cupo" name="oh_cupo" value="<?php echo $row["oh_cupo"];?>" autocomplete="off" disabled><br>
        <p1>Job Reference: </p1><input id="oh_cujb" name="oh_cujb" value="<?php echo $row["oh_cujb"];?>" autocomplete="off" disabled><br>
         
         
         </div>
         <div class="right">
         <p1>Sales Order: </p1><input value="<?php echo $row["oh_order"];?>" disabled><br>
         <p1>Status: </p1><input value="<?php echo $row["oh_status"];?>" disabled><br>
            <p1>User: </p1><input disabled value="<?php echo $row["oh_user"];?>">
            <br>
             <span id="onUpdate" hidden><button type="submit" class="submit">Update Order Header &rarr;</button></span>
           <?php if ($row["oh_status"] =='Invoiced') {} else {?>  <span id="noUpdate"><a href="oe_lines.php?update=true&o=<?php echo $o;?>&seq=0"><button type="button" class="submit">Goto Lines &rarr;</button></a></span><?php } ?>
         </div>
        <?php if (!empty($_POST)) {
        //Sanitize POST data
       $oh_order = $conn -> real_escape_string($o);
        $oh_cupo = $conn -> real_escape_string($_POST["oh_cupo"]);
        $oh_cujb = $conn -> real_escape_string($_POST["oh_cujb"]);
        $oh_cuname = $conn -> real_escape_string($_POST["oh_cuname"]);
        //Execute query
        $sql = "UPDATE orhd SET oh_cuname = '$oh_cuname', oh_cupo = '$oh_cupo', oh_cujb = '$oh_cujb', oh_maintuser = '$usernm' WHERE oh_order = $oh_order AND oh_site = $site_cd";
        $conn->query($sql);
        echo "<script>location.replace('oe_header.php?view=true&o=$oh_order');</script>";
    } ?>
    
    </form>
    <?php }}}else {echo "<script>alert('Order doesn't exist!'); location.replace('oe_header.php?view=true&o=$orderId');</script>"; } ?>
        <script src="/oe/ajax/javascript/fetchCust.js"></script>
    <script>
    function findOrd() {
        var x = prompt('Enter Sales Order Number');
        if (x !=="") {
            if (x.length ==6) {
            location.replace('oe_header.php?view=true&o='+x);
            }
            else {
                alert("There order number must be 6 characters");
            }
        }
    }
        function updateHeader() {
            var a = document.getElementById("oh_cuname");
            var b = document.getElementById("oh_cupo");
            var c = document.getElementById("oh_cujb");
            var d = document.getElementById("onUpdate");
            var e = document.getElementById("noUpdate");
            a.disabled = false;
            b.disabled = false;
            c.disabled = false;
            a.focus();
            a.select();
            d.style.display = "block";
            e.style.display = "none";
        }
    </script>
     </body>
    <?php 
     ?>

</html>
