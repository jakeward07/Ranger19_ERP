<table class="table">
<tr class="tr">
    <th class="th">Sales Value</th>
    <th class="th">Cost Value</th>
    <th class="th">Margin</th>
    </tr>


<?php
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
$q = $conn->real_escape_string($_GET["q"]);
$d1 = $conn->real_escape_string($_GET["d1"]);
$d2 = $conn->real_escape_string($_GET["d2"]);
//Perform Query

$sql = "SELECT avg(vl_marg) as avg, sum(vl_cost) as cost, sum(vl_lnval) as val FROM invl WHERE CAST(vl_timestamp AS date) BETWEEN '$d1' AND '$d2' AND vl_site = $site_cd";
$result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) { ?>
    <tr class="tr">
      <td class="td">$<?php echo number_format($row["val"],2);?></td>
    <td class="td">$<?php echo number_format($row["cost"],2);?></td>
    <td class="td"><?php echo number_format($row["avg"],2);?>%</td>
    
    </tr>
    <?php
            
        }
    }
    else {
        ?>
    <tr class="tr">
        <td class="td" colspan="3"><b>An Error Occured</b></td>
    </tr>
    <?php
    }

?>
