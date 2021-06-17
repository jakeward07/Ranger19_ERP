<?php 
$prog = "ar_maint";
$mod = "ar";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/dep/ar/ar_stdc.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>AR Maintenance - RANGER 5</title>
    </head>
<body>
<h1>Accounts Recievable Maintenance</h1>
    <span id="strip"><div class="bodystrip"><a href="ar_maint.php?new=true"><button>New Customer</button></a></div></span>
<?php if (empty($_GET["new"])) {?><div class="center">
    <p1>Customer: </p1><input onkeyup="fetchCust(); strip()" id="input" list="cumf" autocomplete="off" autofocus placeholder="Enter Customer Name or Number">
    <datalist id="cumf">
    <?php 
        $sql = "SELECT * FROM cumf ORDER BY cu_id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<option value='$row[cu_id]'>Name: $row[cu_name] | Alias: $row[cu_alias]</option>";
            }
        } ?>
    
    </datalist>
    
    </div> <?php } ?>
    <span id="main"></span>
    <span id="pricing"></span>
    <?php if (!empty($_GET)) {
    if (empty($_GET["stage"])) {
        
    
    ?>
    <form action="" method="post">
<div class="left">
    
    <p1>Customer Number: </p1><input onkeyup='document.getElementById("billto").value = this.value;' name="cu_id" type="number" maxlength="6" onkeyup="javascript: if (this.value.length > 6) {alert('This must be no longer then 6 characters!'); this.value = '';}" <?php if ($allowOverride ==0) {echo "disabled";}?> value="<?php 
        $sql = "SELECT cu_id FROM cumf ORDER BY cu_id DESC LIMIT 1";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $custNum = $row["cu_id"]+1;
                echo $row["cu_id"]+1;
            }
        }?>" ><br>
<p1>Customer Name: </p1><input name="cu_name" value="<?php echo $row["cu_name"];?>" required type="text" autocomplete="off"><br>
<p1>Alias: </p1><input name="cu_alias" value="<?php echo $alias?>" required type="text" autocomplete="off"><br>
<p1>Address 1: </p1><input id="addr1" name="cu_addr1" value="<?php echo $addr1;?>" required type="text" autocomplete="off"><br>
<p1>Suburb: </p1><input id="sub1" name="cu_sub1" value="<?php echo $sub1;?>" required type="text" autocomplete="off"><br>
<p1>Postcode: </p1><input id="pc1" name="cu_pc1" value="<?php echo $postcode1;?>" required type="tel" maxlength="4" autocomplete="off"><br>
<p1>State: </p1><select name="cu_state1" required>
    <option></option>
    <?php 
    $sql = "SELECT * FROM stat";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {?>
        <option value="<?php echo $row["stt_abrv"];?>"><?php echo $row["stt_name"];?></option>
            <?php
        }
    }?>
    
    </select><br>
    <p1>Address 2: </p1><input id="addr2" name="cu_addr2" value="<?php echo $addr2;?>" required type="text" autocomplete="off"><br>
<p1>Suburb: </p1><input id="sub2" name="cu_sub2" value="<?php echo $sub2;?>" required type="text" autocomplete="off"><br>
<p1>Postcode: </p2><input id="pc2" name="cu_pc2" value="<?php echo $postcode2;?>" required type="tel" maxlength="4" autocomplete="off"><br>
<p1>State: </p1><select name="cu_state2" required>
    <option></option>
    <?php 
    $sql = "SELECT * FROM stat";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) { ?>
        <option value="<?php echo $row["stt_abrv"];?>"><?php echo $row["stt_name"];?></option>
            <?php
        }
    }?>
    
    </select><br>

</div>
<div class="right">
 <p1>Phone 1: </p1><input name="cu_phone1" value="<?php echo $phone1;?>" type="text" autocomplete="off"><br>
 <p1>Phone 2: </p1><input name="cu_phone2" value="<?php echo $phone2;?>" type="text" autocomplete="off"><br>
<p1>ABN: </p1><input maxlength="14" id="abn" name="cu_abn" value="<?php echo $abn;?>" autocomplete="off" type="text"><br>
<p1>ACN: </p1><input maxlength="11" id="acn" name="cu_acn" value="<?php echo $acn;?>" autocomplete="off" type="text"><br>
<p1>Bill to: </p1><input maxlength="6" id="billto" name="cu_billto" value="<?php echo $custNum;?>" autocomplete="off" type="text"><br>
 <button type="submit" class="submit">Create Customer</button>
    
        </div></form>
    <?php
        if (!empty($_POST)) {
        //Sanitise Data
     $pcu_id = $conn -> real_escape_string($_POST["cu_id"]);   
     $pname = $conn -> real_escape_string($_POST["cu_name"]);   
     $palias = $conn -> real_escape_string($_POST["cu_alias"]);   
     $paddr1 = $conn -> real_escape_string($_POST["cu_addr1"]);   
     $psub1 = $conn -> real_escape_string($_POST["cu_sub1"]);   
     $ppc1 = $conn -> real_escape_string($_POST["cu_pc1"]);   
     $pstatee1 = $conn -> real_escape_string($_POST["cu_state1"]); 
    $paddr2 = $conn -> real_escape_string($_POST["cu_addr2"]);   
     $psub2 = $conn -> real_escape_string($_POST["cu_sub2"]);   
     $ppc2 = $conn -> real_escape_string($_POST["cu_pc2"]);   
     $pstatee2 = $conn -> real_escape_string($_POST["cu_state2"]);
     $pphone1 = $conn -> real_escape_string($_POST["cu_phone1"]);
     $pphone2 = $conn -> real_escape_string($_POST["cu_phone2"]);
     $pabn = $conn -> real_escape_string($_POST["cu_abn"]);
     $pacn = $conn -> real_escape_string($_POST["cu_acn"]);
     $pbillto = $conn -> real_escape_string($_POST["cu_billto"]);
    
        
       
    /* Insert record for stage 1.
   Does arsc allow for cu_id override?*/
        if ($allowOverride ==1) {
            //It does allow, allow record to be inserted
             $sql = "INSERT INTO cumf (cu_id, cu_billto, cu_name, cu_alias, cu_addr1, cu_sub1, cu_pc1, cu_state1, cu_addr2, cu_sub2, cu_pc2, cu_state2, cu_phone1, cu_phone2, cu_abn, cu_acn, cu_stampuser) VALUES ('$pcu_id','$pbillto','$pname','$palias','$paddr1','$psub1','$ppc1','$pstatee1','$paddr2','$psub2','$ppc2','$pstatee2','$pphone1','$pphone2','$pabn','$pacn','$usernm')";
                    $conn->query($sql);
             echo $conn->error;
           echo "<script>location.replace('ar_maint.php?new=true&stage=2&cust=$pcu_id');</script>";
        }
        else {
            $sql = "SELECT cu_id FROM cumf ORDER BY cu_id DESC LIMIT 1";
            $result = $conn->query($sql);
            if ($result->num_rows >0) {
                while ($row = $result->fetch_assoc()) {
                    $cu_cust = $row["cu_id"]+1;
                    //Insert record 
                    $sql = "INSERT INTO cumf (cu_id, cu_name, cu_alias, cu_addr1, cu_sub1, cu_pc1, cu_state1, cu_addr2, cu_sub2, cu_pc2, cu_state2, cu_phone1, cu_phone2, cu_abn, cu_acn, cu_stampuser) VALUES ('$cu_cust','$pname','$palias','$paddr1','$psub1','$ppc1','$pstatee1','$paddr2','$psub2','$ppc2','$pstatee2','$pphone1','$pphone2','$pabn','$pacn','$usernm')";
                    $conn->query($sql);
                    echo $conn->error;
                echo "<script>location.replace('ar_maint.php?new=true&stage=2&cust=$cu_cust');</script>";
                }
            }
        } 
    
    }} else {
        $c = $_GET["cust"];
        $sql = "SELECT cu_name FROM cumf WHERE cu_id = $c";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
        
    ?><form action="" method="post">
    <div class="left">
<p1>Customer Name: </p1><input name="cu_name" value="<?php echo $row["cu_name"];?>" disabled type="text" autocomplete="off"><br>
<p1>Account Type: </p1><select name="cu_type" required>
    <option></option>
   <?php
    $sql = "SELECT * FROM cutp";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
        ?>
    <option value="<?php echo $row["tp_id"];?>" <?php if ($row["tp_id"] ==$cu_type) {echo "selected";}?>><?php echo $row["tp_name"];?></option>
    <?php
        }
    }
    ?>
    </select><br>
    <h4>Fallback Options</h4>
    <p1>Fallback Type: </p1><select required name="cu_fbtype">
    <option></option>
    <option value="Margin" <?php if ($fbt =="Margin") {echo "selected";}?>>Margin</option>
    <option value="Discount" <?php if ($fbt =="Discount") {echo "selected";}?>>Discount</option>
    </select><br>
    <p1>Fallback Value: </p1><input type="number" name="cu_fallback" step="0.01" value="<?php echo $fbm;?>" required>

</div>
<div class="right">
<p1>Credit Limit: </p1><input type="number" value="<?php echo $limit;?>" required name="cu_limit" step="0.01"><br>
<p1>Pricing Type: </p1><select name="cu_sptp" required>
    <option></option>
    <?php 
    $sql = "SELECT * FROM cupr";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            ?>
    <option value="<?php echo $row["pr_id"];?>" <?php if ($row["pr_id"]==$pricing) {echo "selected";}?>><?php echo $row["pr_name"];?></option> 
    <?php
        }
    } 
    ?>
    
    </select><br>
    <p1>Require a PO: </p1><select required name="cu_po">
    <option></option>
    <option value="0">No</option>
    <option value="1">Yes</option>
    
    </select><br>
    <p1>Require Job Ref: </p1><select required name="cu_jb">
    <option></option>
    <option value="0">No</option>
    <option value="1">Yes</option>
    
    </select><br>
    <p1>Domicilled Site: </p1><input id="cu_site" onkeyup="fetchSr()" name="cu_site" required list="stmf">
    <datalist id="stmf">
    <?php 
                $sql = "SELECT * FROM stmf";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        ?>
        <option value="<?php echo $row["st_code"];?>"><?php echo $row["st_name"];?></option>
        <?php
                    }
                }?>
    </datalist><br>
    <span id="salesRep"></span>

    <p1>Trading Terms: </p1><select name="cu_terms" required>
    <option></option>
    <?php $sql = "SELECT * FROM cutr";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        ?>
    <option value="<?php echo $row["tr_id"];?>"><?php echo $row["tr_name"];?></option>
    <?php
                    }
                } ?>
    </select><br>
      <p1>Ledger: </p1><select name="cu_ledger" required>
    <option></option>
    <?php $sql = "SELECT * FROM culd";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        ?>
    <option title="<?php echo $row["ld_desc"];?>" value="<?php echo $row["ld_id"];?>"><?php echo $row["ld_name"];?></option>
    <?php
                    }
                } ?>
    </select><br>
    <button type="submit" class="submit">Create Customer</button>
 </div>
    </form>
    <?php
        
    }}
    if (!empty($_POST)) {
        //Sanitise Data
        $c = $conn -> real_escape_string($_GET["cust"]);
        $pactype = $conn -> real_escape_string($_POST["cu_type"]);
        $pfbt = $conn -> real_escape_string($_POST["cu_fbtype"]);
        $pfbv = $conn -> real_escape_string($_POST["cu_fallback"]);
        $plimit = $conn -> real_escape_string($_POST["cu_limit"]);
        $psptp = $conn -> real_escape_string($_POST["cu_sptp"]);
        $ppo = $conn -> real_escape_string($_POST["cu_po"]);
        $pjb = $conn -> real_escape_string($_POST["cu_jb"]);
        $psite = $conn -> real_escape_string($_POST["cu_site"]);
        $pslsrep = $conn -> real_escape_string($_POST["cu_slsrep"]);
        $pledger = $conn -> real_escape_string($_POST["cu_ledger"]);
        $pterms = $conn -> real_escape_string($_POST["cu_terms"]);
        //Update record
        $sql = "UPDATE cumf SET cu_type = '$pactype', cu_fbtype = '$pfbt', cu_fallback = '$pfbv', cu_limit = '$plimit', cu_sptp = '$psptp', cu_po = '$ppo', cu_jb = '$pjb', cu_site = '$psite', cu_slsrep = '$pslsrep', cu_hldsts = '1', cu_ledger = '$pledger', cu_terms = '$pterms' WHERE cu_id = $c";
        $conn->query($sql);
        
    }
    } ?>


    
    <?php
} ?>
    </body>
     <script>
         
     function fetchCust() {
          var o = document.getElementById("input");
          var x = document.getElementById("main");
        var y = document.getElementById("pricing");
          
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
               y.innerHTML = "";
                x.innerHTML = this.responseText;
            
            }
        };
        xmlhttp.open("GET","/ar/ajax/ar_maint.php?q="+o.value,true);
        xmlhttp.send();
         
    }
}
             function fetchOe() {
          var o = document.getElementById("input");
          var x = document.getElementById("pricing");
            var y = document.getElementById("main");
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
                y.innerHTML = "";
                x.innerHTML = this.responseText;
            
            }
        };
        xmlhttp.open("GET","/ar/ajax/ar_maintPric.php?q="+o.value,true);
        xmlhttp.send();
         
    }
}
         
              function fetchSr() {
          var o = document.getElementById("cu_site");
          var x = document.getElementById("salesRep");
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
        xmlhttp.open("GET","/ar/ajax/ar_slsrep.php?q="+o.value,true);
        xmlhttp.send();
         
    }
}
         
         addEventListener("keyup", spaceAbn);
        function spaceAbn() {
            var x = document.getElementById("abn");
            if (x.value !=="") {
                if (x.value.length ==2) {
                    x.value = x.value+" ";
                }
                if (x.value.length ==6) {
                    x.value = x.value+" ";
                }
                if (x.value.length ==10) {
                    x.value = x.value+" ";
                   
                }
                
            }
        }
        addEventListener("keyup", spaceAcn);
        function spaceAcn() {
            var x = document.getElementById("acn");
            if (x.value !=="") {
                if (x.value.length ==3) {
                    x.value = x.value+" ";
                }
                if (x.value.length ==7) {
                    x.value = x.value+" ";
                }
            }
        }
         
         function strip() {
             var x = document.getElementById("input");
             var y = document.getElementById("strip");
             if (x.value =="") {
                 y.style.display = "block";
             }
             else {
                 y.style.display = "none";
             }
         }
    </script>
</html>
