<?php 
$prog = "im_pcls";
$mod = "im";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>Price Class Maintenance - RANGER 5</title>
    </head>
<body>
<h1>Price Class Maintenance</h1>
    <?php if (empty($_GET)) { ?>
    <div class="searchBox" style="width:800px;">
        
    <h3>Search</h3>
        <?php if (empty($_POST)) { ?>
        <div class="center">
            <form action="" method="post">
        <p1>Price Class Code: </p1><input type="text" required autocomplete="off" autofocus name="class"><br>
        <button type="submit" class="submit">Search</button><a href="im_pcls.php?c=newPriceClass"><button type="button" class="submit">New Class</button></a>
            </form>
        
        </div>
      <?php } if (!empty($_POST)) { ?>
        <table>
        <tr>
            <th>Price Class</th>
            <th>Name</th>
            <th>Supplier</th>
            <th>Action</th>
            </tr>
        <?php 
$q = $_POST["class"];
$sql = "SELECT * FROM impc i INNER JOIN sumf s ON s.su_code = i.pc_vendor WHERE i.pc_code LIKE '$q%'";
$result = $conn->query($sql);
  
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
          if ($result->num_rows ==1) {
        echo "<script>location.replace('im_pcls.php?c=$row[pc_code]');</script>";
    }
        ?>
            <tr>
            <td><?php echo $row["pc_code"];?></td>
            <td><?php echo $row["pc_name"];?></td>
            <td><?php echo $row["su_code"], ' ', $row["su_name"];?></td>
                <td><a href="im_pcls.php?c=<?php echo $row["pc_code"];?>">View</a></td>
            </tr>
            
            <?php
    }
}
                                   ?>
        </table>
        
        
        <?php } ?>
    </div>
    <?php } if (!empty($_GET)) {
    if ($_GET["c"] !=="") {
    $c = $_GET["c"];
$sql = "SELECT * FROM impc i INNER JOIN sumf s ON s.su_code = i.pc_vendor WHERE i.pc_code = '$c'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
    ?>
    
    
    <div class="center">
        <form action="" method="post">
    <p1>Price Class Code: </p1> <input name="pc_code" disabled autocomplete="off" value="<?php echo $row["pc_code"];?>"><br>
    <p1>Name/Description: </p1> <input name="pc_name" autocomplete="off" required value="<?php echo $row["pc_name"];?>"><br>
    <p1>Supplier: </p1> <input name="pc_vendor" autocomplete="off" required list="suppliers" value="<?php echo $row["pc_vendor"];?>"><br>
    <datalist id="suppliers">
        <?php 
        $sql = "SELECT * FROM sumf";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                
                ?>
        <option value="<?php echo $row["su_code"];?>"><?php echo $row["su_name"];?></option>
        
        <?php }
        }}
        ?>
        </datalist><br>
            <button type="submit" class="submit">Update</button>
        </form>
        <?php 
        if (!empty($_POST)) {
            $b = $conn -> real_escape_string($_POST["pc_name"]);
            $c = $conn -> real_escape_string($_POST["pc_vendor"]);
            $sql = "UPDATE impc SET pc_name = '$b', pc_vendor = '$c' WHERE pc_code = '$_GET[c]'";
            $conn->query($sql);
            echo "<script>alert('Price Class Updated'); location.replace('im_pcls.php');</script>";
        }}
        else if ($_GET["c"] =="newPriceClass") {
            ?>
          <div class="center">
        <form action="" method="post">
    <p1>Price Class Code: </p1> <input name="pc_code" required autocomplete="off"><br>
    <p1>Name/Description: </p1> <input name="pc_name" autocomplete="off" required><br>
    <p1>Supplier: </p1> <input name="pc_vendor" autocomplete="off" required list="suppliers"><br>
    <datalist id="suppliers">
        <?php 
        $sql = "SELECT * FROM sumf";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                
                ?>
        <option value="<?php echo $row["su_code"];?>"><?php echo $row["su_name"];?></option>
        
        <?php }
        }
        ?>
        </datalist><br>
            <button type="submit" class="submit">Create</button>
        </form>
        <?php if (!empty($_POST)) {
            $a = $conn->real_escape_string($_POST["pc_code"]);
            $b = $conn->real_escape_string($_POST["pc_name"]);
            $c = $conn->real_escape_string($_POST["pc_vendor"]);
            $sql = "INSERT INTO impc (pc_code, pc_name, pc_vendor, pc_stampuser) VALUES ('$a','$b','$c','$usernm')";
            $conn->query($sql);
                 echo "<script>alert('Price Class Created'); location.replace('im_pcls.php');</script>";
      
            ?>
        
        <?php
        }
        ?>
    </div>
    
    
    <?php 
    
    
}}} ?>
    
    
   
    
    
    </body>
</html>
