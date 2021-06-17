<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "erp";
$connc = mysqli_connect($host,$user,$pass,$db);
 


$termq = "SELECT * FROM cutr";
$result = $connc->query($termq);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        ?>
<option
        <?php if ($row["tr_id"] ==$terms) {echo "selected";}?>
        value="<?php echo $row["tr_id"];?>"><?php echo $row["tr_name"];?></option>
<?php
    }
}
mysqli_close($connc);
?>