<?php

$date = date('Y-m-d');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');

if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}
$q = $conn -> real_escape_string($_GET["q"]);
mysqli_select_db($conn,"cumf");

$sql="SELECT * FROM immf f INNER JOIN sumf s ON s.su_code = f.im_supp INNER JOIN imwh w ON w.im_id = f.im_id AND w.wh_site = $site_cd WHERE f.im_sku LIKE '$q%' LIMIT 1"; 

$result = mysqli_query($conn,$sql);
if ($result->num_rows > 0) {
while($row = mysqli_fetch_array($result)) {

?>
<h2 style="color:white;text-align:center"><?php echo $row["im_sku"];?></h2>
<div class="left" style="margin: 0">
<p1>Product Code: </p1><input value="<?php echo $row["im_sku"];?>" disabled><br>
<p1>Description: </p1><input value="<?php echo $row["im_desc"];?>" disabled><br>
<p1>Preferred Supplier: </p1><input value="<?php echo $row["im_supp"], ' - ', $row["su_name"];?>" disabled><br>
<p1>Bin Location: </p1><input value="<?php if (!empty($row["wh_loc"])) {echo $row["wh_loc"];} else {echo "Not Located";}?>" disabled>
    
    
</div>
<div class="right">
<p1>On Hand: </p1><input disabled value="<?php echo $row["wh_stk"];?>"><br>
<p1>Available: </p1><input disabled value="<?php echo number_format($row["wh_stk"]-$row["wh_alloc"], 2);?>"><br>
<p1>Allocated: </p1><input disabled value="<?php echo $row["wh_alloc"];?>"><br>
<p1>On Backorder: </p1><input disabled value="<?php echo $row["wh_bor"];?>"><br>
<p1>On Order: </p1><input disabled value="<?php echo $row["wh_onor"];?>"><br>
<br><br>
    <a href="/im/enq/im_enq.php?product=<?php echo $row["im_sku"];?>"><button type="button" class="submit" style="color:white;">View Detailed Enquiry &rarr;</button>
</div>

<?php }} else {
    echo "<h1>No results returned for '$q'</h1>";
}


?>
