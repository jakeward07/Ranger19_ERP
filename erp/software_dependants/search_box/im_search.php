<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    </head>
<body> 
 <div class="searchBox" style="width:600px; height:300px">
    <h1>Inventory Enquiry</h1><?php error_reporting(0); if (!empty($_POST)) {
    ?><a href="<?php echo $hrefloc?>"><button>Back</button></a>
     <?php } ?>

    <?php if (empty($_POST)) { ?>
    <form action="" method="post">
        <div class="center">
     <p1>Product Code: </p1> <input autofocus type="text" name="prod" autocomplete="off"><br>
     <p1>Supplier: </p1> <input type="number" name="su_code" autocomplete="off"><br>
     <p1>Sales Class: </p1> <input type="text" name="im_slscls" autocomplete="off"><br>
     <p1>Inventory Class: </p1> <input type="text" name="im_invcls" autocomplete="off"><br>
  
       <button type="submit" class="submit">Search</button>
        </div>
     <?php } ?>
     </form>
     <?php if (!empty($_POST)) { ?>
     <table>
     <tr>
         <th>Product Code</th>
         <th>Description</th>
         <th>Supplier</th>
         <th>Action</th>
         
         </tr>
         <?php include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
$prod = $_POST["prod"];
$supp = $_POST["su_code"];
$salecls = $_POST["im_slscls"];
$invcls = $_POST["im_invcls"];

$ConditionArray = array();
if ($prod != '') $ConditionArray[] = "im_sku LIKE '$prod%'";
if ($supp != '') $ConditionArray[] = "im_supp = '$supp'";
if ($salecls != '') $ConditionArray[] = "im_scls = '$salecls'";
if ($invcls != '') $ConditionArray[] = "im_icls = '$invcls'";


if (count($ConditionArray) > 0)
{
    $sql = "
    SELECT *
    FROM immf
    WHERE ".implode(' AND ', $ConditionArray)."ORDER BY im_sku";
}


$result=$conn->query($sql);
if ($result->num_rows ===1) {
    while($row = $result->fetch_assoc()) {
    $pro = $row["im_sku"];
    echo "<script>location.replace('im_enq.php?product=$pro')</script>";
}}
elseif ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        
    
                               ?>
         <tr>
         <td><?php echo $row["im_sku"];?></td>
         <td><?php echo $row["im_desc"];?></td>
         <td><?php echo $row["im_supp"];?></td>
             <td><a href="<?php echo $hrefloc;?>?product=<?php echo $row["im_sku"];?>"><?php echo $hrefbut;?></a></td>
         
         </tr>
     <?php }} else {
         echo "<h2>No records match your criteria</h2>";
}?>
     </table>
     
     <?php } ?>
     
    
    </div>   
 
    
    
    
    
    
    </body>
</html>