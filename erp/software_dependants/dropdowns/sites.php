<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "erp";
$connb = mysqli_connect($host,$user,$pass,$db);
 


$site = "SELECT * FROM stmf";
$result = $connb->query($site);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        ?>
<option
        <?php if (isset($branch)) { if ($row["st_code"] ==$branch) {echo "selected";}}
        if (isset($prog)) { if ($prog=="oe_header") {if ($sec !=='ADM') {echo "disabled";}} if ($row["st_code"] ==$site_cd){echo "selected";}}
        ?>
        value="<?php echo $row["st_code"];?>"><?php echo $row["st_name"];?></option>
<?php
    }
}
mysqli_close($connb);
?>