<?php 
$host = "localhost";
$user = "root";
$pass = "";
$db = "erp";
$conna = mysqli_connect($host,$user,$pass,$db);
 


$rep = "SELECT * FROM srmf";
$result = $conna->query($rep);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        ?>
<option
        <?php if (isset($salesrep)) { if ($row["sr_salesid"] ==$salesrep) {echo "selected";}}?>
        value="<?php echo $row["sr_salesid"];?>"><?php echo $row["sr_salesid"],' - ', $row["sr_name"];?></option>
<?php
    }
}
mysqli_close($conna);
?>