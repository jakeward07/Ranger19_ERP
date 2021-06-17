

<style>
#customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 355px;
    float: right
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}
    #customers tr {
        background-color: white;
    }
#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: darkorange;
  color: white;
}
</style>
<table id="customers">
    <tr>
    <th>Quantity</th>
    <th>Price</th>
    </tr>
<?php
$q = $_GET['q'];
$p = $_GET['p'];

include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');

if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}

mysqli_select_db($conn,"cumf");

$sql="SELECT * FROM sdln WHERE sl_sku = '$p' AND sl_code = '$q' AND sl_site = $site_cd ORDER BY sl_bval"; 

$result = mysqli_query($conn,$sql);
if ($result->num_rows > 0) {
while($row = mysqli_fetch_array($result)) {
?>
    <tr>
    <td><?php echo $row["sl_bval"];?></td>
    <td>$<?php echo $row["sl_price"];?></td>
    
    </tr>
    
    <?php

?>
<?php }}
else {
    $sql = "SELECT * FROM immf WHERE im_sku = '$p'";
    $result=$conn->query($sql);
    if ($result->num_rows > 0) {
        while($row=$result->fetch_assoc()) {
            ?>
<tr>
    <td>No Price Breaks exist in this contract. Standard cost displayed.</td>
    <td>$<?php echo $row["im_stdc"];?></td>
    </tr>
<?php
}}}
?>

