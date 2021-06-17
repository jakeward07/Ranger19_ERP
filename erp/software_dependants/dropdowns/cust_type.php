<?php 
$host = "localhost";
$user = "root";
$pass = "";
$db = "erp";
$connd = mysqli_connect($host,$user,$pass,$db);
 


$rep = "SELECT * FROM cutp";
$result = $connd->query($rep);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        ?>
<option
        <?php if ($row["tp_id"] ==$custtype) {echo "selected";}?>
        value="<?php echo $row["tp_id"];?>"><?php echo $row["tp_name"];?></option>
<?php
    }
}
mysqli_close($connd);
?>