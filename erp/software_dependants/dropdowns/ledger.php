<?php 
$host = "localhost";
$user = "root";
$pass = "";
$db = "erp";
$connf = mysqli_connect($host,$user,$pass,$db);
 


$rep = "SELECT * FROM culd";
$result = $connf->query($rep);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        ?>
<option
        <?php if ($row["ld_id"] ==$ledger) {echo "selected";}?>
        value="<?php echo $row["ld_id"];?>"><?php echo $row["ld_name"];?></option>
<?php
    }
}
mysqli_close($connf);
?>