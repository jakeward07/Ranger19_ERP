<?php 
$prog = "po_rcpt_b";
$mod = "po";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>PO Receipting - RANGER 5</title>
    </head>
<body>
<h1>Receipt a Purchase Order</h1>
     <div class="left">
         <p1>PO Number: </p1><input name="po_num" id="po" type="tel" disabled value="<?php echo $_GET["o"];?>" autocomplete="off" maxlength="6"><br>
    </div><div class="right">
     <p1>Reference: </p1><input id="ref" autocomplete="off" disabled value="<?php echo $_GET["r"];?>" name="po_ref"><br>
  </div>
     <form action="" method="post">
<table class="table">
    <tr class="tr">
    <th class="th">Product Code</th>
    <th class="th">Description</th>
    <th class="th">Qty Received</th>
    <th class="th">Qty Rejected</th>
    <th class="th">Finalise</th>
    
    
    </tr>
   
    <?php 
   $ord = 100002;
   
    $sql = "SELECT * FROM poln WHERE ln_order = $ord AND ln_wh = $site_cd";
    $res = $conn->query($sql);
    if ($res->num_rows > 0) {
        while($row = $res->fetch_assoc()) {
            ?>
    <tr class="tr">
    <td class="td"><?php echo $row["ln_sku"];?><input hidden name="ln_sku[]" value="<?php echo $row["ln_sku"];?>"></td>
    <td class="td"><?php echo $row["ln_desc"];?></td>
    <td class="td"><input style="width:150px" type="number" onfocus="this.select()" name="qtyrc[]" autofocus value="<?php echo $row["ln_qty"];?>"></td>
    <td class="td"><input style="width:150px" name="qtyrj[]" type="number" value="0"></td>
        <td class="td"><select style="width:150px"  name="fin[]">
            <option value="yes">Yes</option>
            <option value="no">No</option>
            
            </select></td>
    
        </tr>
    <?php }}
    else {
        echo "<script>alert('All lines have been receipted');location.replace('po_rcpt.php');</script>";
    
    }?>
    
         </table>
         <span class="right"><button type="submit" class="submit">Receipt Lines &rarr;</button></span></form>
    <?php if (!empty($_POST)) {
  $total = count($_POST["qtyrc"]);
    $qtyrc_arr = $_POST["qtyrc"];
    $qtyrj_arr = $_POST["qtyrj"];
    $fin_arr = $_POST["fin"];
    $sku_arr = $_POST["ln_sku"];
    for ($i = 0; $i < $total; $i++) {
        $qtyrc = $qtyrc_arr[$i];
        $qtyrj = $qtyrj_arr[$i];
        $fin = $fin_arr[$i];
        $sku = $sku_arr[$i];
        //Update POLN
        $sql = "UPDATE poln SET ln_rcqty = '$qtyrc', ln_rjqty = '$qtyrj', ln_finflag = '$fin' WHERE ln_sku = '$sku' AND ln_order = '$ord' AND ln_wh = $site_cd";
        $conn->query($sql);
        //Create record in IMMV
        $sql2 = "INSERT INTO immv (mv_sku, mv_type, mv_user, mv_qty, mv_bal, mv_avg, mv_site) (SELECT '$sku','PO-Receipt','$usernm','$qtyrc', w.wh_stk, l.ln_price, $site_cd FROM imwh w INNER JOIN poln l ON l.ln_sku = '$sku' AND l.ln_order = $ord AND l.ln_wh = $site_cd WHERE w.im_id = (SELECT im_id FROM immf WHERE im_sku = '$sku') AND w.wh_site = $site_cd LIMIT 1)";
        $conn->query($sql2);
        //Update IMWH Stock
        $sql3 = "UPDATE imwh SET wh_stk = wh_stk+$qtyrc, wh_onor = wh_onor-$qtyrc WHERE im_id = (SELECT im_id FROM immf WHERE im_sku = '$sku') AND wh_site = $site_cd";
    $conn->query($sql3);
        //UPDATE IMWH Average Cost
          $sql4 = "UPDATE imwh SET wh_avgcst = (SELECT (avg(m.mv_avg)*(i.im_cosf/100)) FROM immv m INNER JOIN immf i ON i.im_sku = m.mv_sku WHERE m.mv_sku = '$sku' AND m.mv_site = $site_cd) WHERE im_id = (SELECT im_id FROM immf WHERE im_sku = '$sku') AND wh_site = $site_cd";
        $conn->query($sql4);
        
    }
  
    $ref = $_GET["r"];
   

        
#echo "<script>location.replace('po_rcpt_b.php?o=$ord&r=$ref&s=$seq2');</script>";
   
}?>
    </body>
</html>
