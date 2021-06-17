<?php
$q = $_GET['q'];

include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php'); ?>

   <p1>Price Class: </p1><input type="text" name="im_scls" required autocomplete="off" id="im_scls" list="pc">
        <datalist id="pc">
        <?php 
            $sql = "SELECT * FROM impc WHERE pc_vendor = $q";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    
                    ?> 
            <option value="<?php echo $row["pc_code"];?>"><?php echo $row["pc_name"];?></option>
            <?php
                }
            }
        ?>
        
        
        </datalist><br>
