<?php
$q = $_GET['q'];
$date = new DateTime(date('Y-m-d'));
$interval = new DateInterval('P30D');
$date->add($interval);
$expdate = $date->format("Y-m-d");
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php'); 
            $sql = "SELECT * FROM cumf WHERE cu_id = $q";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $state = $row["cu_state1"];
                    
                    ?> 
         <div class="left">
<p1>Customer: </p1><input name="es_cuname" required autocomplete="off" value="<?php echo $row["cu_name"];?>"><br>
             <input name="es_cust" id="es_cust" hidden>
<p1>Address: </p1><input name="es_addr" required autocomplete="off" value="<?php echo $row["cu_addr1"];?>"><br>
<p1>Suburb: </p1><input name="es_sub" required autocomplete="off" value="<?php echo $row["cu_sub1"];?>"><br>
<p1>Postcode: </p1><input name="es_pc" type="tel" maxlength="4" required autocomplete="off" value="<?php echo $row["cu_pc1"];?>"><br>
<p1>State: </p1><select name="es_state" required>
             <?php  $sql = "SELECT * FROM stat";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    ?>
             <option <?php if ($state ==$row["stt_abrv"]) {echo "selected";}?> value="<?php echo $row["stt_abrv"];?>"><?php echo $row["stt_name"];?></option>
             <?php }}?>
             </select>
</div>
        <div class="right">
<p1>Quotation Type: </p1><select name="es_type" required>
            <option></option>
            <?php  $sql = "SELECT * FROM estp";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    ?>
            <option value="<?php echo $row["et_name"]?>"><?php echo $row["et_name"], ' - ', $row["et_desc"];?></option>
            <?php }}?>
            
            </select><br>
            <p1>Quote Title: </p1><input type="text" name="es_title" autocomplete="off"><br>
            <p1>Expiry Date: </p1><input required name="es_expdate" type="date"
value="<?php echo $expdate?>"><br>
    <p1>User: </p1><select name="es_user" required>
            <option></option>
            <?php  $sql = "SELECT * FROM usmf WHERE us_site = $site_cd";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    ?>
            <option value="<?php echo $row["us_user"];?>"><?php echo $row["us_name"];?></option>
            <?php }}?>
            </select>
<br>
            <button type="submit" class="submit">Go to Lines &rarr;</button>
</div>   
                  
             
             <?php
                }
            }
        ?>
         
        
        <br>
