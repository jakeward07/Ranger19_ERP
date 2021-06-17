    <?php 
$q = $_GET["q"];
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
    $sql = "SELECT * FROM pohd h INNER JOIN sumf s ON s.su_code = h.ph_supp WHERE h.ph_order = '$q' AND h.ph_site = $site_cd";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            ?>
 <div class="left">
        <p1>Supplier: </p1><input value="<?php echo $row["ph_supp"], ' - ', $row["su_name"];?>" disabled><br>
        <p1>Contract: </p1><input value="<?php echo $row["ph_contract"];?>" disabled><br>
</div>
        <div class="right">
        <p1>User: </p1><input value="<?php echo $row["ph_user"];?>" disabled><br>
        <p1>Created Date: </p1><input value="<?php echo $row["ph_timestamp"];?>" disabled><br>
        <p1>Status: </p1><input value="<?php echo $row["hd_stat"];?>" disabled>
        </div>

    <?php    
        }
       
    
    
}  else {
            echo "<h1>The Purchase Order does not exist.</h1>";
        } ?>