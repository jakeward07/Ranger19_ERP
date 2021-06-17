
<?php 
$host = "localhost";
$user = "root";
$pass = "";
$db = "erp";
$connh = mysqli_connect($host,$user,$pass,$db);
 


$state = "SELECT * FROM stat s LEFT JOIN gnmf g ON s.stt_id = g.gn_defstat";
$result = $connh->query($state);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        ?>
<option <?php if ($row["stt_id"] ==$row["gn_defstat"]) {echo "selected";}
                                                      ?> value="<?php echo $row["stt_abrv"];?>"><?php echo $row["stt_abrv"], ' - ', $row["stt_name"];?></option>
<?php
    }
}
mysqli_close($connh);
?>