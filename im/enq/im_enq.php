<?php 
$prog = "im_enq";
$mod = "im";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>Product Enquiry - RANGER 5</title>
    </head>
<body>
<h1>Product Enquiry</h1>
  <?php if (empty($_GET)) {
    $hrefloc="im_enq.php";
    $hrefbut="View Product";
    include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/search_box/im_search.php'); }?>   
    <?php if (!empty($_GET)) { 
   $prod = $_GET["product"];
    include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
    $sql = "SELECT * FROM immf i INNER JOIN sumf s ON i.im_supp = s.su_code INNER JOIN imwh wh ON wh.im_id = i.im_id AND wh.wh_site = '$site_cd' WHERE i.im_sku = '$prod'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
        $create = $row["im_timestamp"];
        $maint = $row["im_mainttime"];
        $whchg = $row["wh_maintime"];
        $time1 = strtotime($create);
        $time2 = strtotime($maint);
        $time3 = strtotime($whchg);
  
    
    ?>
    <div class="bodystrip">
   <a href="im_enq.php"><button>Find Another Product</button></a>    <button onclick="othDet()">Other Details</button>
        <a href="im_nstk.php?sku=<?php echo $row["im_sku"];?>"><button>National Stock Check</button></a>
        <a href="im_mvmt.php?sku=<?php echo $row["im_sku"];?>"><button>Movements</button></a>
        <a href="im_alloc.php?sku=<?php echo $row["im_sku"];?>"><button>Allocated</button></a>
        <a href="im_po.php?sku=<?php echo $row["im_sku"];?>"><button>Outstanding PO</button></a>
    </div>
 <div class="left">
    <p1>Product Code: </p1><input list="immf" disabled id="sku" name="im_sku" autocomplete="off" value="<?php echo $row["im_sku"];?>"><br>
    
     <span id="hideMe">
    <p1>Description: </p1><input disabled name="im_desc" autocomplete="off" value="<?php echo $row["im_desc"];?>"><br>
    <p1>Brand: </p1><input disabled name="im_brand" autocomplete="off" value="<?php echo $row["im_brand"];?>"><br>
    <p1>Range: </p1><input disabled name="im_range" autocomplete="off" value="<?php echo $row["im_range"];?>"><br><br>
         <p1>Preferred Supplier: </p1><a href="/ap/enq/ap_enq.php?q=<?php echo $row["im_supp"];?>"><input disabled name="im_supp" autocomplete="off" value="<?php echo $row["su_code"], ' - ', $row["su_name"];?>"></a><br>
    <p1>Sales Class: </p1><input disabled name="im_scls" autocomplete="off" value="<?php echo $row["im_icls"];?>"><br>
    <p1>Inventory Class: </p1><input disabled name="im_icls" autocomplete="off" value="<?php echo $row["im_scls"];?>"><br><br>
    <p1>Create User: </p1><input disabled name="im_stampuser" autocomplete="off" value="<?php echo $row["im_stampuser"];?>"><br>
    <p1>Create Date: </p1><input disabled name="im_timestamp" autocomplete="off" value="<?php echo date("d/m/Y g:i:sa", $time1);?>"><br>
  
     </span>
    </div>
    <span id="hideMe2">
    <div class="right">
    <p1>On Hand: </p1><input disabled name="wh_stk" value="<?php echo $row["wh_stk"];?>"><br>
    <p1>Available: </p1><input disabled name="avail" value="<?php echo number_format($row["wh_stk"]-$row["wh_alloc"],2, ".", "");?>"><br>
    <p1>Allocated: </p1><input disabled name="alloc" value="<?php echo $row["wh_alloc"];?>"><br>
    <p1>On Backorder: </p1><input disabled name="wh_bor" value="<?php echo $row["wh_bor"];?>"><br>
    <p1>On Order: </p1><input disabled name="wh_onor" value="<?php echo $row["wh_onor"];?>"><br>
    <p1>Bin Location: </p1><input disabled value="<?php if (!empty($row["wh_loc"])) {echo $row["wh_loc"];} else {echo "Not Located";};?>"><br>    
    <p1>UOM: </p1><input disabled value="<?php echo $row["im_uom"];?>"><br>    
    <p1>Per: </p1><input disabled value="<?php echo number_format($row["im_per"],2);?>"><br>    
        <br>
    <p1>Alernate Product 1: </p1><input disabled value="<?php echo $row["im_alt1"];?>"><br>
    <p1>Alernate Product 2: </p1><input disabled value="<?php echo $row["im_alt2"];?>"><br>
    
    
        </div></span>
    <div id="otherDetails" class="searchBox" hidden>
    <h1>Other Details</h1>
    <button type="button" class="exit" onclick="othDet()">X</button>
   <div class="left">
        <p1>Trade Price: </p1> <input disabled name="im_trd" value="$<?php echo $row["im_trd"];?>"><br>
        <p1>Retail Price: </p1> <input disabled name="im_ret" value="$<?php echo $row["im_ret"];?>"><br>
        
        
        </div>
        <div class="right">
        <p1>Standard Cost: </p1><input disabled name="im_std" value="$<?php echo $row["im_stdc"];?>"><br>
        <p1>Average Cost: </p1><input disabled name="im_avg" value="<?php if (!empty($row["wh_avgcst"])) {echo '$',$row["wh_avgcst"];} else {echo "No Average Cost Recorded.";} ?>"><br>
            <span class="hoverBox" onclick="cosfa()"><p1>Cost Factor: </p1><input disabled name="im_cosf" value="<?php echo $row["im_cosf"];?>"><br></span>
            <span id="cosf" hidden> <p1>Cost Factor %: </p1><input disabled name="im_cosf" value="<?php echo 100-$row["im_cosf"];?>%"><br></span>
        
        
        </div>
        
    </div>
    <?php }}}
   ?>
    
    <script>
    function othDet() {
        var x = document.getElementById("otherDetails");
        if (x.style.display ==="block") {
            x.style.display = "none";
        }
        else {
            x.style.display ="block";
        }
    }
        
            function cosfa() {
        var y = document.getElementById("cosf");
        if (y.style.display ==="block") {
            y.style.display = "none";
        }
        else {
            y.style.display ="block";
        }
    }
       
      
    
    
    </script>
    
    </body>
</html>
