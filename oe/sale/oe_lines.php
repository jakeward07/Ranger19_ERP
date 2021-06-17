<?php 
$prog = "oe_header";
$mod = "oe";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
$cust = $_GET["c"];
$ord = $_GET["o"];
?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>Order Header - RANGER 5</title>
    </head>
<body><h1>Sales Order Entry</h1>
    <div class="bodystrip"><a href="oe_del.php?o=<?php echo $ord?>&c=<?php echo $cust?>"><button>Invoice Order</button></a><button>Show Lines</button><button onclick="notePad()">Notepad</button><button>Addons</button><button>Quit Order</button>
   
    </div>
        
    <div class="sale">
        <?php 
        $orhd = "SELECT * FROM orhd h INNER JOIN usmf u ON h.oh_user = u.us_user INNER JOIN cumf c ON c.cu_id = h.oh_cust WHERE h.oh_order = $ord AND h.oh_site = $site_cd AND h.oh_status = 'Open' OR h.oh_status = 'Part'";
        $result = $conn->query($orhd);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $db_date = $row["oh_timestamp"];
                $cdate = strtotime($db_date);
                $c_date = date("d/m/Y g:ia", $cdate);
                $c_user = $row["oh_user"];
                $db_date2 = $row["oh_maintime"];
                $mdate = strtotime($db_date2);
                $m_date = date("d/m/Y g:ia", $mdate);
                $m_user = $row["oh_maintuser"];
         ?>
    <div class="left">
  <p1>Sales Rep: </p1> <input autocomplete="off" disabled value="<?php echo $row["us_name"];?>"><br>
  <p1>Customer: </p1> <input autocomplete="off" disabled value="<?php echo $row["cu_id"], ' - ', $row["cu_name"];?>"><br>

 
        
<form action="" method="post">
<br><br>
    <p1>Product: </p1><input autocomplete="off" name="ln_sku" autofocus onblur=" grabPrice(); grabStock()" onchange="grabProd(); disableProd() " id="prodVal" list="prodList">
  <datalist id="prodList">
      <?php 
      $sql = "SELECT * FROM immf i LEFT JOIN imwh wh ON wh.im_id = i.im_id WHERE wh.wh_site = $site_cd";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
      ?>
      <option id="prodVal" value="<?php echo $row["im_sku"];?>"><?php echo $row["im_desc"], ' | In Stock: ', $row["wh_stk"]-$row["wh_alloc"]; if (!empty($row["wh_loc"])) {echo ' | Location: ', $row["wh_loc"];} ?></option>

      
      <?php }}?>
  </datalist><br>
      <span id="prod">
    </span>
    <span hidden id="prodAttach">
    <p1>Order Quantity: </p1><input autocomplete="off" type="number" onkeyup="calcTotal(); stkAlloc(); if (this.value ==0) {alert('Value cannot be zero');}" onkeydown="javascript: return event.keyCode == 69 ? false : true" required id="im_qty" name="ln_oqty" autocomplete="off"><br>
    <p1>Allocate Qty: </p1><input autocomplete="off" type="number" step="0.1" onblur="boChng()" onkeyup="allocChg(); boChng()" onkeydown="javascript: return event.keyCode == 69 ? false : true; boChng()" required id="im_alloc" name="ln_alloc" autocomplete="off"><br>
   <input autocomplete="off" id="allocH" hidden>
        
        <p1>Backorder Qty: </p1><input autocomplete="off" readonly type="number" onkeydown="javascript: return event.keyCode == 69 ? false : true" required id="im_bo" name="ln_bor" autocomplete="off"><br>
        <span id="backordertype" hidden><label for="boT">Backorder Report</label><input autocomplete="off" disabled type="radio" name="bot" id="boT" value="0"> <label for="boT2">Purchase</label><input autocomplete="off" type="radio" name="bot" disabled id="boT2" value="1"></span><br>
        <p1>Line Price: </p1><input autocomplete="off" step="0.0001" type="number" onkeyup="calcTotal()" onkeydown="javascript: return event.keyCode == 69 ? false : true" required id="im_price" name="ln_price" autocomplete="off"><br>
     <span onclick="hideMargin()" id="hideMarg">   <p1>GP $: </p1><input autocomplete="off" disabled id="gpd"><br>
         <p1>GP %: </p1><input autocomplete="off" value="" disabled id="gpp"><br></span>
    </span><span id="suggestOpen" onclick="hideMargin()" hidden>Show Margin</span>
    <span hidden><input autocomplete="off" name="ln_marg" id="marginIn">
    <input autocomplete="off" name="ln_order" value="<?php echo $_GET["o"];?>">
    </span>
    
    </div>
    <div class="right">
        <p1>Create Date: </p1><input autocomplete="off" disabled value="<?php echo $c_date;?>"><br>
        <p1>Create User: </p1><input autocomplete="off" disabled value="<?php echo $c_user;?>"><br>
      <br><br>
        <span id="totalSpan" hidden><p1>Total: </p1><input autocomplete="off" disabled id="totalp"><br>
      <p1>Total Inc: </p1><input autocomplete="off" disabled id="totalgst"></span>
               <span id="stock" hidden>
        <h4>Stock</h4>

        
        </span>
 <button type="submit" class="submit">Add Line</button>
    </div>
    <div class="searchBox" hidden style="width:600px; overflow-x:hidden" id="notepad">
                <button onclick="notePad()" class="exit">X</button><br><br>
            <textarea name="ln_note" style="resize:none; width:600px; margin-left: -3px; height:200px"></textarea>
            
            </div>
    </form>
   <?php if (!empty($_POST)) {
          $o = $_GET["o"];
          $c = $_GET["c"];
          //Get Sequence
          $sql = "SELECT ln_seq FROM orln WHERE ln_order = $o AND ln_site = $site_cd";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                  $seq = $row["ln_seq"]+1;
                   $sql = "INSERT INTO orln (ln_seq, ln_order, ln_site, ln_sku, ln_oqty, ln_alloc, ln_bor, ln_netprice, ln_marg,
    ln_stampuser, ln_desc) VALUES ('$seq','$_POST[ln_order]','$site_cd','$_POST[ln_sku]','$_POST[ln_oqty]','$_POST[ln_alloc]','$_POST[ln_bor]','$_POST[ln_price]','$_POST[ln_marg]','$usernm','$_POST[ln_desc]')";
    $conn->query($sql);
              }
          } else {
    $sql = "INSERT INTO orln (ln_order, ln_site, ln_sku, ln_oqty, ln_alloc, ln_bor, ln_netprice, ln_marg,
    ln_stampuser, ln_desc) VALUES ('$_POST[ln_order]','$site_cd','$_POST[ln_sku]','$_POST[ln_oqty]','$_POST[ln_alloc]','$_POST[ln_bor]','$_POST[ln_price]','$_POST[ln_marg]','$usernm','$_POST[ln_desc]')";
    $conn->query($sql);
    $sql2 = "UPDATE imwh SET wh_alloc = wh_alloc+'$_POST[ln_alloc]', wh_bor = wh_bor+'$_POST[ln_bor]' WHERE wh_site = '$site_cd' AND im_id = (SELECT im_id FROM immf WHERE im_sku = '$_POST[ln_sku]')";
    $conn->query($sql2);
}}
    ?>    
        </div>
            

 <script>
     function notePad() {
         var x = document.getElementById("notepad");
         if (x.style.display ==="block") {
             x.style.display = "none";
         }
         else {
             x.style.display = "block";
         }
     }
     function stkAlloc() {
         var a = parseInt(document.getElementById("wh_avail").value);
         var b = parseInt(document.getElementById("im_qty").value);
         var c = parseInt(document.getElementById("im_alloc").value);
         var d = parseInt(document.getElementById("im_bo").value);
         var w = document.getElementById("wh_avail");
         var x = document.getElementById("im_qty");
         var y = document.getElementById("im_alloc");
         var z = document.getElementById("im_bo");
         var h = document.getElementById("allocH");
         var bor = document.getElementById("backordertype");
         if (b < a) {
            y.value = x.value;
             z.value = 0;
             h.value = x.value;
              bor.style.display = "none";
             document.getElementById("boT").disabled = true;
             document.getElementById("boT2").disabled = true;
         }
         else if (b > a) {
            z.value = x.value-w.value;
             y.value = x.value-z.value;
             h.value = x.value-z.value;
             bor.style.display = "block";
             document.getElementById("boT").disabled = false;
             document.getElementById("boT2").disabled = false;
         }
          else {
              y.value = b;
          }
         
       
               
     }
     
     function allocChg() {
          var a = parseInt(document.getElementById("wh_avail").value);
         var b = parseInt(document.getElementById("im_qty").value);
         var c = parseInt(document.getElementById("im_alloc").value);
         var d = parseInt(document.getElementById("im_bo").value);
         var e = parseInt(document.getElementById("allocH").value);
         var w = document.getElementById("wh_avail");
         var x = document.getElementById("im_qty");
         var y = document.getElementById("im_alloc");
         var z = document.getElementById("im_bo");
         var h = document.getElementById("allocH");
           var bor = document.getElementById("backordertype");
         
  if (c > a) {
            alert("You cannot allocate a quantity that is not in stock");
            y.value = h.value;
            
        }
         else if (c > b) {
                  alert("You cannot allocate a quantity that is greater then the order quantity!")
         y.value = h.value;       
         }
         else if (c !==e) {
            z.value = b-c;
             
     
         }
     }
         
         
         function boChng() {
                var a = parseInt(document.getElementById("wh_avail").value);
         var b = parseInt(document.getElementById("im_qty").value);
         var c = parseInt(document.getElementById("im_alloc").value);
         var d = parseInt(document.getElementById("im_bo").value);
         var e = parseInt(document.getElementById("allocH").value);
         var w = document.getElementById("wh_avail");
         var x = document.getElementById("im_qty");
         var y = document.getElementById("im_alloc");
         var z = document.getElementById("im_bo");
         var h = document.getElementById("allocH");
           var bor = document.getElementById("backordertype");
             if (y.value !==h.value) {
                     z.value = b-c;
                 bor.style.display = "block";
                   document.getElementById("boT").disabled = false;
             document.getElementById("boT2").disabled = false;
                 
             }
             else if (d !==0) {
                   bor.style.display = "block";
             document.getElementById("boT").disabled = false;
             document.getElementById("boT2").disabled = false;
             }
             else {
                     z.value = b-c;
                
             }
         }
       
         
     
    function grabProd() {
          var x = document.getElementById("prodVal");
          
    if (x.value == "") {

        document.getElementById("prod").innerHTML = "";
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
                document.getElementById("prod").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","get_prod.php?q="+x.value,true);
        xmlhttp.send();
       
    }
}
     function disableProd() {
         var x = document.getElementById("prodVal");
         var y = document.getElementById("prodAttach");
         var z = document.getElementById("totalSpan");
         var s = document.getElementById("stock");
         x.readOnly = true;
         y.style.display = "block";
         z.style.display = "block";
         s.style.display = "block";
         document.getElementById("im_qty").focus()
         
     }
     
         function grabPrice() {
          var x = document.getElementById("prodVal");
          
    if (x.value == "") {

        document.getElementById("im_price").value = "";
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
                document.getElementById("im_price").value = parseFloat(this.responseText);
            }
        };
        xmlhttp.open("GET","get_price.php?s="+x.value+"&c=<?php echo $cust;?>",true);
        xmlhttp.send();
         
    }
             
}
            function grabStock() {
          var x = document.getElementById("prodVal");
          
    if (x.value == "") {

        document.getElementById("stock").innerHTML = "";
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
                document.getElementById("stock").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","get_stock.php?q="+x.value,true);
        xmlhttp.send();
         
    }
} 
     
     function calcTotal() {
         var x = document.getElementById("totalp");
        var y = document.getElementById("im_price");
         var z = document.getElementById("im_qty");
         var g = document.getElementById("totalgst");
      var w = document.getElementById("per");
        var total = (y.value*z.value)/w.value;
        var totalg = total*1.1;
         x.value = "$"+total.toFixed(2);
         g.value = "$"+totalg.toFixed(2);
         calcMargin();
     }
     
     function calcMargin() {
          var y = document.getElementById("im_price");
         var md = document.getElementById("gpd");
         var mp = document.getElementById("gpp");
         var cs = document.getElementById("margCs").value;
         var hm = document.getElementById("marginIn");
         var per = document.getElementById("per");
        var margd = y.value-cs;
         md.value = "$"+margd.toFixed(2);
         var margp = (y.value-cs);
         var margp2 = ((margp/y.value)*100);
         mp.value = margp2.toFixed(2)+"%";
         hm.value = mp.value;
     }
     function hideMargin() {
         var x = document.getElementById("hideMarg");
         var y = document.getElementById("suggestOpen");
         
         if (x.style.display ==="none") {
             x.style.display = "block";
             y.style.display = "none";
         }
         else {
             x.style.display = "none"
             y.style.display = "block";
         }
     }
    </script>
   <?php }}?>
    
    </body>
</html>
