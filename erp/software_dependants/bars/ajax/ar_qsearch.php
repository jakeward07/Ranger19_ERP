<?php

$date = date('Y-m-d');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');

if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}
$q = $conn -> real_escape_string($_GET["q"]);
mysqli_select_db($conn,"cumf");

$sql2="SELECT * FROM cumf c INNER JOIN stmf s ON s.st_code = c.cu_site WHERE c.cu_id = (SELECT cu_id FROM cumf WHERE cu_name LIKE '$q%' OR cu_alias LIKE '$q%') OR c.cu_id = '$q' LIMIT 1"; 

$result = mysqli_query($conn,$sql2);
if ($result->num_rows > 0) {
while($row = mysqli_fetch_array($result)) {

?>
<h2 style="color:white;text-align:center"><?php echo $row["im_sku"];?></h2>
<div class="left" style="margin: 0">
<p1>Customer Account: </p1><input disabled value="<?php echo $row["cu_id"], ' - ', $row["cu_name"];?>"><br>
<p1>Address: </p1><input disabled value="<?php echo $row["cu_addr1"];?>"><br>
<p1>Suburb: </p1><input disabled value="<?php echo $row["cu_sub1"];?>"><br>
<p1>State: </p1><input disabled value="<?php echo $row["cu_state1"];?>"><br>
<p1>Postcode: </p1><input disabled value="<?php echo $row["cu_pc1"];?>"><br>

    
</div>
<div class="right">
    <p1>Domicilled Site: </p1><input disabled value="<?php echo $row["cu_site"],' - ', $row["st_name"];?>"><br>
<p1>Phone 1: </p1><input disabled value="<?php echo $row["cu_phone1"];?>"><br>
<p1>Phone 2: </p1><input disabled value="<?php if(!empty($row["cu_phone2"])) { echo $row["cu_phone2"];} else {echo "Not Recorded";}?>"><br>
<p1>Credit Limit: </p1><input disabled value="$<?php echo $row["cu_limit"];?>"><br>
<p1>Current Balance: </p1><input disabled value="<?php echo $row["cu_limit"];?>"><br>
<br><br>
    <a href="/ar/enq/ar_deb.php?debtor=<?php echo $row["cu_id"];?>"><button type="button" class="submit" style="color:white;">View Detailed Enquiry &rarr;</button>
</div>

<?php echo $conn->error; }} else {
    echo "<h1>No results returned for '$q'</h1>";
}


?>
