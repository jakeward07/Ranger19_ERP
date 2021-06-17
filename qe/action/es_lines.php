<?php 
$prog = "es_lines";
$mod = "es";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>Quote Entry Header - RANGER 5</title>
    </head>
<body>
<h1>Quote Entry Lines</h1>
    <div class="bodystrip">
        <a href="/doc_gen/qe/quo_doc.php?q=<?php echo $_GET["q"];?>"><button>Print Quote</button></a>
        <a href="es_order.php?q=<?php echo $_GET["q"];?>"><button>Convert to Sales Order</button></a>
    </div>
    <?php
    $q = $_GET["q"];
    $sql = "SELECT * FROM eshd h LEFT JOIN esln l ON l.el_quote = h.es_quote AND l.el_site = $site_cd WHERE h.es_quote = $q AND h.es_site = $site_cd ORDER BY l.el_seq DESC LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
              $customer = $row["es_cust"];
            $seq = $row["el_seq"];
            $seq2 = $seq+5;
            ?>
     <div class="center">
         <form action="" method="post" id="myForm">
    <p1>Product Code: </p1><input onchange="showEs(); getPricing();" onblur="disableProd();  populateFlds(); isPerm()" onkeyup="getDesc()" type="text" id="prod" list="immf" required autocomplete="off" autofocus>
         <datalist id="immf">
         <?php 
             $sql = "SELECT * FROM immf";
             $result = $conn->query($sql);
             if ($result->num_rows > 0) {
                 while($row = $result->fetch_assoc()) {
                   
                     ?>
             <option value="<?php echo $row["im_sku"];?>"><?php echo $row["im_desc"];?></option>
             <?php
                 }
             } ?>
         </datalist>
    </div>
    <span id="esDet" hidden>
    <div class="left"><input hidden name="el_seq" value="<?php
            if (empty($seq)) {
                echo "5";
            }
            else {
                echo $seq2;
            }
            ?>">
<p1>Description: </p1><input onkeyup="addHash()" id="desc" onfocus="isPerm()" name="el_desc" required autocomplete="off"><br>
<p1>GP $: </p1><input disabled id="gpd"><br>
<p1>GP %: </p1><input disabled id="gpp"><br>
<p1>Total Ex: </p1><input disabled id="totex"><br>
<p1>Total Inc: </p1><input disabled id="totinc"><br>
<textarea name="el_cnotes" style="resize:none" placeholder="Line Notes... These will appear on the customers quote..."></textarea>
</div>
    <div class="right">
    <p1>Quantity: </p1><input type="number" onblur="getPricing(); popPrice();calcMarg(); calcTot();" onkeyup="getPricing(); popPrice(); calcMarg(); calcTot(); populateFlds()" name="el_qty" required id="qty" autocomplete="off"><br>
<p1>Unit of Measurement: </p1> <select name="el_uom" id="uom" required>
        <?php 
        $sql = "SELECT * FROM iuom";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                ?> 
        <option value="<?php echo $row["uom_shrt"];?>"><?php echo $row["uom_long"];?></option>
        <?php }}?>
        </select><br>
<p1>Per: </p1><input type="number" name="el_per" id="per" onblur="calcMarg(); calcTot(); populateFlds()" onkeyup="calcMarg(); calcTot(); populateFlds()" required><br>
        <p1>Cost: </p1><input value="0" type="number" step="0.0001" onblur="calcMarg(); calcTot(); populateFlds()" onkeyup="calcMarg(); calcTot(); populateFlds()" name="el_cost" required id="cost" autocomplete="off"><br>
<p1>Sell Price: </p1><input value="0" onblur="calcMarg(); calcTot(); populateFlds()" onkeyup="calcMarg(); calcTot(); populateFlds()" type="number" step="0.0001" name="el_price" required id="price" autocomplete="off"><br>
<p1>Discount: </p1><input type="number" onblur="calcMarg(); calcTot(); populateFlds()" step="0.0001" onkeyup="calcMarg(); calcTot(); populateFlds()" name="el_disc" value="0" id="discountV" autocomplete="off"><br>
    <textarea name="el_onotes" style="resize:none" placeholder="Order Notes... These will not appear on the customers quote..."></textarea><br>
<span id="flag"><h3 id="msg"></h3></span> 
         </span>  <input id="perm" value="Perm" hidden>
    <span id="hiddenVal1" hidden>
  
    </span>
         <span id="hiddenPost" hidden>
         <input id="sku" name="el_sku">
             <input id="gp" name="el_marg">
             <input id="totalex" name="totex">
             <input id="totalinc" name="es_totinc">
         </span>
         <span id="hiddenVal2" hidden ></span>
         <button type="submit" id="subBut" onblur="calcMarg(); calcTot(); populateFlds()" onkeyup="calcMarg(); calcTot(); populateFlds()" class="submit">Next Line &rarr;</button>
    </div>
   
        
    </div> 
    </form>
    </body>
    <?php if (!empty($_POST)) {
$sku = $conn -> real_escape_string($_POST["el_sku"]);
$desc = $conn -> real_escape_string($_POST["el_desc"]);
$qty = $conn -> real_escape_string($_POST["el_qty"]);
$uom = $conn -> real_escape_string($_POST["el_uom"]);
$per = $conn -> real_escape_string($_POST["el_per"]);
$cost = $conn -> real_escape_string($_POST["el_cost"]);
$sell = $conn -> real_escape_string($_POST["el_price"]);
$disc = $conn -> real_escape_string($_POST["el_disc"]);
$cnote = $conn -> real_escape_string($_POST["el_cnotes"]);
$onote = $conn -> real_escape_string($_POST["el_onotes"]);
$marg = $conn -> real_escape_string($_POST["el_marg"]);
$tot = $conn -> real_escape_string($_POST["totex"]);
$toti = $conn -> real_escape_string($_POST["totinc"]);
$sequence = $conn -> real_escape_string($_POST["el_seq"]);
$netprice = ((((100-$disc)/100)*$sell)/$per);
            $quote = $_GET["q"];
            $sql = "INSERT INTO esln (el_seq, el_quote, el_site, el_sku, el_desc, el_qty, el_uom, el_per, el_price, el_disc, el_netprice, el_marg, el_prcex, el_cost, el_cnote, el_onote, el_stampuser) VALUES ('$sequence','$quote','$site_cd','$sku','$desc','$qty','$uom','$per','$sell','$disc','$netprice','$marg','$tot','$cost','$cnote','$onote','$usernm')";
            $conn->query($sql);
            echo $conn->error;
           #echo "<script>location.replace('es_lines.php?q=$q&c=$customer');</script>";
        }
            ?>
    <script>
        function populateFlds() {
              var a = document.getElementById("descVal");
              var b = document.getElementById("desc");
              var c = document.getElementById("costVal");
              var d = document.getElementById("cost");
            var e = document.getElementById("uomVal");
            var f = document.getElementById("perVal");
            var g = document.getElementById("uom");
            var h = document.getElementById("per");
                 d.value = c.value;
                b.value = a.value;
            g.value = e.value;
            h.value = f.value;
            
            var aa = document.getElementById("gpp");
            var ab = document.getElementById("gp");
            var ba = document.getElementById("prod");
            var bb = document.getElementById("sku");
            var ca = document.getElementById("totex");
            var cb = document.getElementById("totalex");
            var da = document.getElementById("totinc");
            var db = document.getElementById("totalinc");
           ab.value = aa.value;
            bb.value = ba.value;
            cb.value = ca.value;
            db.value = da.value;
        }
input.addEventListener("keyup", function(event) {
  // Number 13 is the "Enter" key on the keyboard
  if (event.keyCode === 13) {
    // Cancel the default action, if needed
    event.preventDefault();
    // Trigger the button element with a click
      populateFlds();
      popPrice();
    document.getElementById("myForm").submit();


      
  }
});
        function calcTot() {
            var x = document.getElementById("price").value;
            var y = document.getElementById("per").value;
            var z = document.getElementById("qty").value;
            var d = document.getElementById("discountV").value;
            var a = document.getElementById("totex");
            var b = document.getElementById("totinc");
            var t3 = (100-d)/100;
            var t1 = ((x/y)*z)*t3;
            var t2 = (((x/y)*z)*1.1)*t3;
            if (t1 > -9999999) {
            a.value = t1.toFixed(2);
            b.value = t2.toFixed(2);
                calcMarg();
              var aa = document.getElementById("gpp");
            var ab = document.getElementById("gp");
            var ba = document.getElementById("prod");
            var bb = document.getElementById("sku");
            var ca = document.getElementById("totex");
            var cb = document.getElementById("totalex");
            var da = document.getElementById("totinc");
            var db = document.getElementById("totalinc");
           ab.value = aa.value;
            bb.value = ba.value;
            cb.value = ca.value;
            db.value = da.value;
         }
        }
        function isPerm() {
            var x = document.getElementById("desc");
           var y = document.getElementById("perm");
            var z = document.getElementById("prod");
            var s = document.getElementById("sku");
            
            if (x.value =="") {
              var p = confirm("This is not part of the Inventory File. Continue?");  
                x.value = "# ";
                if (p == false) {
                    location.replace("es_lines.php");
                }
                else {
                    x.value = "# ";
                    y.value = "temp";
                    z.value = "#"+z.value;
                    s.value = z.value;
                }
            }
            populateFlds();
        }
        
        function addHash() {
            var z = document.getElementById("prod");
            var x = document.getElementById("desc");
            var y = document.getElementById("perm");
            if (y.value == "temp") {
               if (x.value.charAt(0) !=="#") {
                   x.value = "# ";
                   
               }
            }
            populateFlds();
        }
        
        function calcMarg() {
            
            var x = document.getElementById("cost").value;
            var y = document.getElementById("price").value;
            var a = document.getElementById("gpp");
            var b = document.getElementById("gpd");
            var d = document.getElementById("discountV").value;
            var t3 = (100-d)/100;
            var marg = (y-x)*t3;
            var marp = (((y-x)*t3)/y*100);
           
            if (marg > -999) {
            b.value = marg.toFixed(2);

            a.value = marp.toFixed(2);
                
        }}
    function showEs() {
        var x = document.getElementById("esDet");
        var y = document.getElementById("prod");
        if (y.value !=="") {
            x.style.display = "block";
        }
        else {
            x.style.display = "none";
        }
    }
      function disableProd() {
          var x = document.getElementById("prod");
          if (x.value !=="") {
              x.disabled = true;
              x.required = false;
          }
          else {
              x.disabled = false;
              x.required = true;
          }
          
      }
           function getDesc() {
              var x = document.getElementById("prod");
          
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
                document.getElementById("hiddenVal1").innerHTML = this.responseText;
        
            }
        };
        xmlhttp.open("GET","/qe/ajax/es_linesprod.php?q="+x.value,true);
        xmlhttp.send();
         
    }
    }
         function getPricing() {
              var x = document.getElementById("prod");
             var c = document.getElementById("qty");
          
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
                document.getElementById("hiddenVal2").innerHTML = this.responseText;
        
            }
        };
        xmlhttp.open("GET","/qe/ajax/getPrice.php?p="+x.value+"&q=149679&c="+c.value,true);
        xmlhttp.send();
        popPrice();
         
    }
    }
        
         
        function popPrice() {
           
              var za = document.getElementById("price");
            var zb = document.getElementById("gPrice");
            var zc = document.getElementById("discountV");
            var zd = document.getElementById("gDisc");
            za.value = zb.value;
            zc.value = zd.value;
            
          var x = document.getElementById("flag");
            var y = document.getElementById("msg");
            var z = document.getElementById("flagM");
            x.style.display = "block";
            y.value = z.value;
           
        }
       
    </script>
    <?php }}?>
</html>
