<?php 
$host = "localhost";
$user = "root";
$pass = "";
$db = "erp";
$conne = mysqli_connect($host,$user,$pass,$db);
 


$rep = "SELECT * FROM cupr";
$result = $conne->query($rep);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        ?>
<option
        <?php if ($row["pr_id"] ==$priceType) {echo "selected";}?>
        value="<?php echo $row["pr_id"];?>"><?php echo $row["pr_name"];?></option>
<?php
    }
}
mysqli_close($conne);
?>