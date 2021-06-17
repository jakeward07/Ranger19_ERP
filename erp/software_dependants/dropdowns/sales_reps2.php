<?php 
$host = "localhost";
$user = "root";
$pass = "";
$db = "erp";
$conna = mysqli_connect($host,$user,$pass,$db);
 


$rep = "SELECT * FROM usmf WHERE us_site = '$site_cd' ORDER BY us_name";
$result = $conna->query($rep);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        ?>
<option
        value="<?php echo $row["us_user"];?>"><?php echo $row["us_name"];?></option>
<?php
    }
}
mysqli_close($conna);
?>