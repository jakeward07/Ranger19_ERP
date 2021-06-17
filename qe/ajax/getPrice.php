<?php
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php'); 
$q = $_GET["q"];
$p = $conn -> real_escape_string($_GET["p"]);
$c = $_GET["c"];
//Set date
$date = date("Y-m-d");
//GET SOME DETAILS ABOUT CUSTOMER 
$sql = "SELECT * FROM cumf WHERE cu_id = $q";
$result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $type = 2;
                    $fbv = $row["cu_fallback"];
                    $fbt = $row["cu_fbtype"];
                    
//CHECK PROMOTION FIRST
$sql = "SELECT * FROM prhd h INNER JOIN prcs c ON c.cs_code = h.pr_code INNER JOIN prln l ON l.pl_code = h.pr_code WHERE c.cs_cust = $q AND l.pl_sku = '$p' AND h.pr_startdate >= $date AND pr_expdate >= $date AND h.pr_site = $site_cd LIMIT 1";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
?> <input id="flagM" value="Promotional Price Selected">
<input name="price" id="gPrice"  autocomplete="off" required value="<?php echo $row["pl_price"];?>">
<?php
                }} else {
                //CHECK CONTRACTS
                $sql = "SELECT * FROM cthd h INNER JOIN ctln l ON l.cl_code = h.ct_contract INNER JOIN immf i ON i.im_sku = '$p' INNER JOIN imwh w ON w.im_id = i.im_id AND w.wh_site = $site_cd WHERE h.ct_cust = $q AND l.cl_sku = '$p' AND h.ct_startdate >= $date AND h.ct_expdate >= $date AND l.cl_bval <= $c AND w.wh_site = $site_cd LIMIT 1";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) { 
                  ?>    <input id="flagM" value="Contract Pricing Selected"><?php
                    //Verify if NETT 
                    if ($row["cl_type"] =="Nett") {
                        ?>
<input name="price" id="gPrice"  autocomplete="off" required value="<?php echo $row["cl_pval"];?>">

<?php } else if ($row["cl_type"] =="Discount") {
                        if ($type ==1) { ?>
<input name="price" id="gPrice"  autocomplete="off" required value="<?php echo $row["im_trd"];?>"><br>
<input name="disc" id="gDisc" autocomplete="off" required value="<?php echo $row["cl_pval"];?>">

<?php } else if ($type ==2) { ?>
<input name="price" id="gPrice"  autocomplete="off" required value="<?php echo $row["im_ret"];?>"><br>
<input name="disc" id="gDisc" autocomplete="off" required value="<?php echo $row["cl_pval"];?>"><?php        
                        }}
                    
                    else if($row["cl_type"] =="Margin") {
                        
                        if ($row["wh_avgcst"] !=='0.0000') { ?>
<input name="price" id="gPrice"  autocomplete="off" required value="<?php echo number_format( $row["wh_avgcst"]/((100-$row["cl_pval"])/100),4);?>">
<?php } else {?>
<input name="price" id="gPrice"  autocomplete="off" required value="<?php echo number_format( $row["im_stdc"]/((100-$row["cl_pval"])/100),4);?>">
<?php                        }}}} else {
                    
                    //Finally CHECK Standard Pricing
                    $sql = "SELECT * FROM sphd h INNER JOIN spcs c ON c.sc_code = h.hd_code INNER JOIN spln l ON l.sl_code = h.hd_code INNER JOIN immf i ON i.im_sku = '$p' INNER JOIN imwh w ON w.im_id = i.im_id AND w.wh_site = $site_cd WHERE c.sc_cust = $q AND l.sl_sku = '$p' AND l.sl_bval <= $c AND h.hd_startdate >= $date AND h.hd_expdate >= $date ORDER BY l.sl_bval DESC LIMIT 1";
                     $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) { 
                    ?>    <input id="flagM" value="Standard Pricing Selected"><?php
                    if ($row["sl_ptype"] =="Nett") {
                        ?>
<input name="price" id="gPrice"  autocomplete="off" required value="<?php echo $row["sl_pval"];?>">
<?php
                    }   elseif ($row["sl_ptype"] =="Discount") {
                        if ($type ==1) { ?>
<input name="price" id="gPrice"  autocomplete="off" required value="<?php echo $row["im_trd"];?>"><br>
<input name="disc" id="gDisc" autocomplete="off" required value="<?php echo number_format($row["sl_pval"],2);?>">
<?php  } 
                        else {?>
<input name="price" id="gPrice"  autocomplete="off" required value="<?php echo $row["im_ret"];?>"><br>
<input name="disc" id="gDisc" autocomplete="off" required value="<?php echo number_format($row["sl_pval"],2);?>">
<?php
                        }
                    }
                    elseif ($row["sl_ptype"] =="Margin") {
                        
                        if ($row["wh_avgcst"] !=='0.0000') { ?>
<input name="price" id="gPrice"  autocomplete="off" required value="<?php echo number_format( $row["wh_avgcst"]/((100-$row["sl_pval"])/100),4);?>">
<?php } else {?>
<input name="price" id="gPrice"  autocomplete="off" required value="<?php echo number_format( $row["im_stdc"]/((100-$row["sl_pval"])/100),4);?>">
<?php                        }
                    }
                    
?>


<?php
                    
                    
                    
?>

<?php
            }} else {
                 $sql = "SELECT * FROM immf i INNER JOIN imwh w ON w.im_id = i.im_id WHERE i.im_sku = '$p' AND w.wh_site = $site_cd";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        ?>
  
<?php
                  if ($fbt =="Discount") {
                      if ($type ==1) {
                          ?>
<input name="price" id="gPrice"  autocomplete="off" required value="<?php echo $row["im_trd"];?>"><br>
<input name="disc" id="gDisc" autocomplete="off" required value="<?php echo number_format($fbv,2);?>">

<?php
                      } else {
                          ?>
<input name="price" id="gPrice"  autocomplete="off" required value="<?php echo $row["im_ret"];?>"><br>
<input name="disc" id="gDisc" autocomplete="off" required value="<?php echo number_format($fbv,2);?>">
<?php
                      }
                  }
                       elseif ($fbt =="Margin") {
                                    if ($row["wh_avgcst"] !=='0.0000') { ?>
<input name="price" id="gPrice"  autocomplete="off" required value="<?php echo number_format( $row["wh_avgcst"]/((100-$fbv)/100),4);?>">
<?php } else {?>
<input name="price" id="gPrice"  autocomplete="off" required value="<?php echo number_format( $row["im_stdc"]/((100-$fbv)/100),4);?>">  <input id="flagM" value="Customer Fallback Settings Applied.">
<?php                        }
                           
                        }
                    }
                 }
                
                
            
            }}}}} else {                   ?>
<input name="price" id="gPrice"  autocomplete="off" required value="0"><br>
<input name="disc" id="gDisc" autocomplete="off" required value="0">
<?php }
?>
