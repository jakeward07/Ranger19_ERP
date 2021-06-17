<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    </head>
<body>
 <div class="searchBox" style="width:600px">
    <h1>Debtor Enquiry</h1><?php error_reporting(0); if (!empty($_POST)) {
    ?><a href="<?php echo $hrefloc?>"><button>Back</button></a>
     <?php } ?>

    <?php if (empty($_POST)) { ?>
    <form action="" method="post">
        <div class="center">
     <p1>Account Number: </p1> <input type="number" name="cu_id" autocomplete="off"><br>
     <p1>Alias: </p1> <input type="text" name="cu_alias" autocomplete="off"><br>
     <p1>Account Name: </p1> <input type="text" name="cu_name" autocomplete="off"><br>
     <p1>Domicilled Branch: </p1> <input type="number" name="cu_site" autocomplete="off"><br>
     <p1>Postcode: </p1> <input type="number" name="cu_pc1" autocomplete="off"><br>
     <p1>ABN: </p1> <input name="cu_abn" autocomplete="off"><br>
     <p1>ACN: </p1> <input name="cu_acn" autocomplete="off"><br>
       <button type="submit" class="submit">Search</button>
            <?php  if (isset($other)) { ?>
            <a href="<?php echo $othLink;?>"><button style="margin-left:10px" class="submit" type="button"><?php echo $other;?></button></a>
            <?php } ?>
        </div>
     <?php } ?>
     </form>
     <?php if (!empty($_POST)) { ?>
     <table>
     <tr>
         <th>ID</th>
         <th>Name</th>
         <th>Branch</th>
         <th>Action</th>
         
         </tr>
         <?php include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
$cust = $_POST["cu_id"];
$site = $_POST["cu_site"];
$name = $_POST["cu_name"];
$alias = $_POST["cu_alias"];
$abn = $_POST["cu_abn"];
$acn = $_POST["cu_acn"];
$postcode = $_POST["cu_pc1"];
$ConditionArray = array();
if ($cust != '') $ConditionArray[] = "cu_id = $cust";
if ($site != '') $ConditionArray[] = "cu_site = $site";
if ($name != '') $ConditionArray[] = "cu_name LIKE '$name%'";
if ($alias != '') $ConditionArray[] = "cu_alias LIKE '$alias%'";
if ($abn != '') $ConditionArray[] = "cu_abn = '$abn'";
if ($acn != '') $ConditionArray[] = "cu_acn = '$acn'";
if ($postcode != '') $ConditionArray[] = "cu_pc1 = $postcode";


if (count($ConditionArray) > 0)
{
    $sql = "
    SELECT *
    FROM cumf
    WHERE ".implode(' AND ', $ConditionArray);
}


$result=$conn->query($sql);
if ($result->num_rows ===1) {
    while($row = $result->fetch_assoc()) {
   $cuid = $row["cu_id"];
    echo "<script>location.replace('$hrefloc?debtor=$cuid')</script>";
}}
elseif ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        
    
                               ?>
         <tr>
         <td><?php echo $row["cu_id"];?></td>
         <td><?php echo $row["cu_name"];?></td>
         <td><?php echo $row["cu_site"];?></td>
             <td><a href="<?php echo $hrefloc;?>?cust=<?php echo $row["cu_id"];?>"><?php echo $hrefbut;?></a></td>
         
         </tr>
     <?php }} else {
         echo "<h2>No records match your criteria</h2>";
}?>
     </table>
     
     <?php } ?>
     
    
    </div>   
    
    
    
    
    
    
    </body>
</html>