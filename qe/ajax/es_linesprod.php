<?php
$q = $_GET['q'];

include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php'); 
            $sql = "SELECT * FROM immf i LEFT JOIN imwh w ON w.im_id = i.im_id AND w.wh_site = $site_cd WHERE i.im_sku = '$q'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
               ?>
<span hidden>
<input id="descVal" value="<?php echo $row["im_desc"];?>">
<input id="costVal" value="<?php 
                    if ($row["wh_avgcst"] ==0) {
                        echo $row["im_stdc"];
                    } else {
                        echo $row["wh_avgcst"];
                    }
                    ;?>">
<input id="uomVal" value="<?php echo $row["im_uom"];?>">
    <input id="perVal" value="<?php echo $row["im_per"];?>">
</span>
<?php
                }}
?>
