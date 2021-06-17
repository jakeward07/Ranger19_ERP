<option></option>
<?php 
$host = "localhost";
$user = "root";
$pass = "";
$db = "erp";
$conni = mysqli_connect($host,$user,$pass,$db);
 


$state2 = "SELECT * FROM stat";
$result = $conni->query($state2);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      
        ?>

<option <?php if ($row["stt_abrv"] ==$state1) {echo "selected";}?> value="<?php echo $row["stt_abrv"];?>"><?php echo $row["stt_abrv"], ' - ', $row["stt_name"];?></option>
<?php
    }
}
mysqli_close($conni);
?>