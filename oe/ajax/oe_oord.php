<table class="table">
<tr class="tr">
    <th class="th">Order Number</th>
    <th class="th">Customer</th>
    <th class="th">PO</th>
    <th class="th">Job</th>
    <th class="th">Date</th>
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

$sql="SELECT * FROM orhd o INNER JOIN cumf c ON c.cu_id = o.oh_cust WHERE o.oh_order = $q AND o.oh_site = $site_cd AND o.oh_status = 'Open'"; 

$result = mysqli_query($conn,$sql);
    if ($result->num_rows > 0) {
while($row = mysqli_fetch_array($result)) {
$da = strtotime($row["oh_timestamp"]);
$date = date('d/m/Y g:ia', $da);

?>
   <tr class="tr">
    <td class="td"><?php echo $row["oh_order"],'-',$row["oh_site"];?></td>
    <td class="td"><?php echo $row["oh_cust"], ' - ', $row["cu_name"];?></td>
    <td class="td"><?php echo $row["oh_cupo"];?></td>
    <td class="td"><?php echo $row["oh_cujb"];?></td>
    <td class="td"><?php echo $date;?></td>
       <td class="td"><a href="/oe/enq/oe_orddet.php?o=<?php echo $row["oh_order"];?>">View Order</a></td>
    
    </tr>
    
    <?php  }} else {
        echo "<h1>No Order exists with $q</h1>";
    }
    ?>