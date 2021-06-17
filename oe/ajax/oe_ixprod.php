<table class="table">
<tr class="tr">
    <th class="th">Invoice Number</th>
    <th class="th">Branch</th>
    <th class="th">Customer</th>
    <th class="th">PO</th>
    <th class="th">Job</th>
    <th class="th">Date</th>
    <th class="th">Amount</th>
    <th class="th">Action</th>
    </tr>
<?php
$q = $_GET['q'];
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');

if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}

mysqli_select_db($conn,"cumf");

$sql="SELECT * FROM invh h INNER JOIN cumf c ON c.cu_id = h.vh_cust INNER JOIN stmf s ON s.st_code = h.vh_site INNER JOIN invl l ON l.vl_inv = h.vh_inv WHERE l.vl_sku = '$q' AND h.vh_site = $site_cd"; 

$result = mysqli_query($conn,$sql);
    if ($result->num_rows > 0) {
while($row = mysqli_fetch_array($result)) {
$da = strtotime($row["vh_timestamp"]);
$date = date('d/m/Y g:ia', $da);

?>
   <tr class="tr">
    <td class="td"><?php echo $row["vh_inv"],'-',$row["vh_site"];?></td>
    <td class="td"><?php echo $row["vh_site"], ' - ', $row["st_name"];?></td>
    <td class="td"><?php echo $row["vh_cust"], ' - ', $row["cu_name"];?></td>
    <td class="td"><?php echo $row["vh_po"];?></td>
    <td class="td"><?php echo $row["vh_job"];?></td>
    <td class="td"><?php echo $date;?></td>
    <td class="td">$<?php echo $row["vh_amtinc"];?></td>
       <td class="td"><a href="/oe/enq/oe_invdet.php?i=<?php echo $row["vh_inv"];?>">View Invoice</a></td>
    
    </tr>
    
    <?php  }} else {
        echo "<h1>No Invoice exists with $q</h1>";
    }
    ?>