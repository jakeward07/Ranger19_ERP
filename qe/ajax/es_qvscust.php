<table class="table">
<tr class="tr">
    <th class="th">Quotation Number</th>
    <th class="th">Customer</th>
    <th class="th">Title</th>
    <th class="th">User</th>
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

$sql="SELECT * FROM eshd h INNER JOIN cumf c ON c.cu_id = h.es_cust WHERE c.cu_id = $q ORDER BY h.es_quote DESC"; 

$result = mysqli_query($conn,$sql);
    if ($result->num_rows > 0) {
while($row = mysqli_fetch_array($result)) {
$da = strtotime($row["es_timestamp"]);
$date = date('d/m/Y g:ia', $da);

?>
   <tr class="tr">
    <td class="td"><?php echo $row["es_quote"],'-',$row["es_site"];?></td>
    <td class="td"><?php echo $row["es_cust"], ' - ', $row["cu_name"];?></td>
    <td class="td"><?php echo $row["es_title"];?></td>
    <td class="td"><?php echo $row["es_user"];?></td>
    <td class="td"><?php echo $date;?></td>
       <td class="td"><a href="/qe/enq/qe_qedet.php?i=<?php echo $row["qe_quote"];?>">View Quote</a></td>
    
    </tr>
    
    <?php  }} else {
        echo "<h1>No quotation exists with $q</h1>";
    }
    ?>