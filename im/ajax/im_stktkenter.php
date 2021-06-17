
<table class="table">
<tr class="tr">
    <th class="th">Product Code</th>
    <th class="th">Description</th>
    <th class="th">Your Count</th>
    
    </tr>


<?php
$q = $_GET['q'];

include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php'); 

            $sql = "SELECT * FROM sthd h INNER JOIN stln l ON l.ln_stkid = h.st_code AND l.ln_site = $site_cd WHERE h.st_code = $q";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    
                    
                    ?> 
        <tr class="tr">
    <td class="td"><?php echo $row["ln_sku"];?></td>
    <td class="td"><?php echo $row["ln_desc"];?></td>
    <td class="td"><input name="sku[]" value="<?php echo $row["ln_sku"]?>" hidden><input name="count[]" type="number" step="0.001" required></td>
    </tr>
            <?php
                }
            }
        ?>
    </table>

   

