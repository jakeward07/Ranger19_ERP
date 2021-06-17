<?php 
$prog = "po_enq-supp";
$mod = "po";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>PO Enquiry via Supplier - RANGER 5</title>
    </head>
<body>
<h1>PO Enquiry via Supplier</h1>
     <div class="center">
         <form action="" method="post">
    <p1>Supplier: </p1><input id="supp" value="<?php if (!empty($_POST)) {echo $_POST["supplier"];}?>" list="supplie" required name="supplier" autocomplete="off" autofocus>
         <datalist id="supplie">
         <?php
             $sql = "SELECT * FROM sumf";
             $result = $conn->query($sql);
             if ($result->num_rows > 0) {
                 while ($row = $result->fetch_assoc()) {
                     ?>
             <option value="<?php echo $row["su_code"];?>"><?php echo $row["su_name"];?></option>  
             <?php
                 }
             }
         ?>
         
         </datalist><br>
         <p1>Open Orders Only?: </p1><select name="open" required>
         <option></option>
         <option <?php if (!empty($_POST)) {if ($_POST["open"] =="yes") {echo "selected";}}?> value="yes">Yes</option>
         <option <?php if (!empty($_POST)) {if ($_POST["open"] =="no") {echo "selected";}}?>  value="no">No</option>
         
         </select><br>
         <p1>User: </p1><select name="user" required>
         <option value="All">All Users</option>
         <?php 
         $sql = "SELECT * FROM usmf WHERE us_site = $site_cd";
         $result = $conn->query($sql);
         if ($result->num_rows > 0) {
             while($row = $result->fetch_assoc()) {
                 ?>
         <option <?php if (!empty($_POST["user"])) {if ($_POST["user"] ==$row["us_user"]) {echo "selected";}} ?> value="<?php echo $row["us_user"];?>"><?php echo $row["us_name"];?></option>
         <?php
             } 
         } ?>
         
         </select><br>
         <button type="submit" class="submit">Search</button>
         </form>
    
    </div>
    <div class="center" style="width:100%">
   <?php if (!empty($_POST)) {
    ?>
        <table style="width:100%; text-align:center; margin:0">
            <tr>
            <th>Order Number</th>
            <th>Supplier</th>
            <th>User</th>
            <th>Status</th>
            <th>Action</th>
            </tr>
        <?php
    $s = $_POST["supplier"];
    $o = $_POST["open"];
    $u = $_POST["user"];
    $ConditionArray = array();
    if ($s!= '') $ConditionArray[] = "h.ph_supp = $s";
    if ($u!=='All') $ConditionArray[] = "h.ph_user = '$u'";
    if ($o=='Yes') $ConditionArray[] = "h.hd_stat = 'Open'";
    elseif ($o =='No') $ConditionArray[] = "h.hd_stat = *";
    
    if (count($ConditionArray) > 0)
{
    $sql = "
    SELECT *
    FROM pohd h INNER JOIN sumf s ON s.su_code = h.ph_supp 
    WHERE h.ph_site = 228 AND ".implode(' AND ', $ConditionArray)." ORDER BY h.ph_order DESC";
}
$result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                
                ?>
        <tr>
            <td><?php echo $row["ph_order"],'-',$row["ph_site"];?></td>
            <td><?php echo $row["su_name"];?></td>
            <td><?php echo $row["ph_user"];?></td>
            <td><?php echo $row["hd_stat"];?></td>
            <td><a href="/po/enq/po_enq.php?o=<?php echo $row["ph_order"];?>">PO Enquiry</a></td>
            
            </tr>
        
        <?php
            }}
    echo $conn->error;
    
} ?>
    
    
    </div>
    
    
    </body>
</html>
