<?php
$q = $_GET['q'];

include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');

if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}

mysqli_select_db($conn,"cumf");

$sql="SELECT * FROM prsc WHERE sc_prog LIKE '$q%' OR sc_code LIKE '$q%' LIMIT 1"; 

$result = mysqli_query($conn,$sql);
if ($result->num_rows > 0) {
while($row = mysqli_fetch_array($result)) {
?>
<div class="left"><input name="sc_id" value="<?php echo $row["sc_id"];?>" hidden>
<p1>Program Name: </p1><input value="<?php echo $row["sc_name"];?>" name="sc_name" required autocomplete="off"><br>
<p1>Shortcut: </p1><input value="<?php echo $row["sc_code"];?>" name="sc_code" required autocomplete="off"><br>
<p1>Visible: </p1><select name="sc_visible">
    <option value="0" <?php if ($row["sc_visible"] ==0) {echo "selected";}?>>No</option>
    <option value="1" <?php if ($row["sc_visible"] ==1) {echo "selected";}?>>Yes</option>
    </select>

</div>

<div class="right">
<p1>Program: </p1><input value="<?php echo $row["sc_prog"];?>" name="sc_prog" required autocomplete="off"><br>
<p1>Path: </p1><input value="<?php echo $row["sc_path"];?>" name="sc_path" required autocomplete="off"><br>
    <p1>Groups Permitted: </p1><input value="<?php echo $row["sc_group"];?>" name="sc_group" required autocomplete="off"><br>
    <p1>Users Permitted: </p1><input value="<?php echo $row["sc_users"];?>" name="sc_users" required autocomplete="off"><br>
    <button class="submit" type="submit">Update Record</button>
</div>
<?php }} else{
echo "<h1>No results for '$q'.</h1>";
}
?>
