<?php 
$prog = "po_del";
$mod = "po";
$s = $_GET["s"];
$o = $_GET["o"];
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>Purchase Order Delivery Point - RANGER 5</title>
    </head>
<body>
<h1>Purchase Order Delivery Point</h1>
<form action="" method="post">
          <div class="center">
                 <?php 
    $sql = "SELECT * FROM stmf WHERE st_code = $site_cd";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $state = $row["st_state"];
            ?>
    <p1>Deliver To: </p1><input name="dp_delto" required type="text" value="<?php echo $row["st_name"], " (WH$row[st_code])";?>"><br>
    <p1>Address: </p1><input name="dp_addr" required type="text" value="<?php echo $row["st_addr"]?>"><br>
    <p1>Suburb: </p1><input name="dp_sub" required type="text" value="<?php echo $row["st_sub"]?>"><br>
    <p1>Postcode: </p1><input name="dp_pc" required type="tel" maxlength="4" value="<?php echo $row["st_pstcd"]?>"><br>
    <p1>State: </p1><select required name="dp_state">
     <?php
                $sql = "SELECT * FROM stat";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            ?>
        <option <?php if ($row["stt_abrv"] ==$state) {echo "selected";}?> value="<?php echo $row["stt_abrv"];?>"><?php echo $row["stt_name"];?>
        <?php }}?>
        
        
        </select><br>
              <p1>Mode of Transmission: </p1> <select id="trans" onchange="showEmail()" name="po_tr" required>
                <option></option>    <?php 
    $sql = "SELECT * FROM potr t INNER JOIN sumf s ON s.su_code = t.tr_supp LEFT JOIN posr r ON r.sr_supp = s.su_code AND r.sr_site = $site_cd WHERE t.tr_supp = $s LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $state = $row["st_state"];
            ?>
          <option <?php if ($row["tr_edi"] ==0) {echo "hidden";} if($row["sr_prtr"] =="edi") {echo "selected";} ?>  value="EDI">EDI (Electronic Data Interchange)</option>    
          <option <?php if ($row["tr_email"] ==0) {echo "hidden";} if($row["sr_prtr"] =='email') {echo "selected";}?> value="email">Email</option>    
          <option <?php if ($row["tr_efax"] ==0) {echo "hidden";} if($row["sr_prtr"] =='efax') {echo "selected";}?> value="efax">E-fax</option>    
            
              
              <?php }}?>
              
              
              </select>
              <br>
           <span id="email" hidden><p1>Email Address: </p1> <input id="emailVal" disabled type="email" required value="
<?php 
              $sql = "SELECT * FROM posr WHERE sr_supp = $s AND sr_site = $site_cd";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          echo $row["sr_email"];  
        }}
        
               ?>">
               <br></span>
    <button type="submit" class="submit">Transmit</button>
    
    
    </div>  </form>
      <?php }}?>
    <?php
    if (empty($_POST)) {
    $s = $_GET["s"];
    $o = $_GET["o"];
    //GET SUM OF ORDER
    $sql1 = "SELECT ph_totalex AS total FROM pohd WHERE ph_order = $o AND ph_site = $site_cd";
    $result = $conn->query($sql1);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $t = $row["total"];
            if ($t > $po) {
                echo "<script>alert('The total value of this order is greater then your PO limit of $$po. If you hit Transmit, the order will be set to pending approval and your manager will be notified');</script>";
            }
        }
    }
 //VERIFY IF ORDER GREATER THEN MOV
    $sql1 = "SELECT * FROM posr WHERE sr_supp = $s";
    $result1 = $conn->query($sql1);
    if ($result1->num_rows > 0) {
        while($row1 = $result1->fetch_assoc()) {
            
            if ($t < $row1["sr_mov"]) {
             echo "<script>var x = confirm('Your order is under the minumum order value of $$row1[sr_mov]');
             if (x !==true) {alert('Going back to order');}</script>";  
            }
        }
    }
    }
    
    
    
    ?>

        <?php
        if (!empty($_POST)) {
      $sql = "INSERT INTO podp (dp_order, dp_site, dp_delto, dp_addr, dp_sub, dp_postcode, dp_state, dp_stampuser)
      VALUES ('$o','$site_cd','$_POST[dp_delto]','$_POST[dp_addr]','$_POST[dp_sub]','$_POST[dp_pc]','$_POST[dp_state]','$usernm')";
        $conn->query($sql);
             $sql1 = "SELECT sum(ln_qty*ln_price)/ln_per AS total FROM poln WHERE ln_order = $o AND ln_wh = $site_cd";
    $result = $conn->query($sql1);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $t = $row["total"];
            if ($t > $po) {
            $sql2 = "UPDATE pohd SET hd_stat = 'Pending', ph_trans = '$_POST[po_tr]' WHERE ph_order = '$o' AND ph_site = '$site_cd'";
                 echo "<script>alert('Order pending approval from your manager.'); location.replace('po_header.php');</script>";
        
        
        } else {
                $sql2 = "UPDATE pohd SET hd_stat = 'Ordered', ph_trans = '$_POST[po_tr]' WHERE ph_order = '$o' AND ph_site = '$site_cd'";
        echo "<script>alert('Order sent to supplier'); location.replace('po_header.php');</script>";        
            }
                 $conn->query($sql2);
        

        }}}
        ?>
            <script>
    function showEmail() {
        var x = document.getElementById("trans");
        var z = document.getElementById("email");
        var y = document.getElementById("emailVal");
       if (x.value ==="email") {
           z.style.display = "block";
           y.disabled = false;
       }
        else {
            z.style.display = "none";
            y.disabled = true;
        }
    }
    
    
    </script>
    </body>
</html>
