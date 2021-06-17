<?php 
$prog = "po_from";
$mod = "po";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>Purchase From Maintenance - RANGER 5</title>
    </head>
<body>
<h1>Purchase From Maintenance</h1>
     <?php if (empty($_GET["p"])) { ?>
    <div class="searchBox" style="width:600px">
    <h1>Product Code</h1>
        <form action="" method="get">
        <div class="center">
            <p1>Product Code: </p1> <input required name="p" autocomplete="off" list="immf" autofocus>
           <datalist id="immf">
            <?php
                                   $sql = "SELECT * FROM immf ORDER BY im_sku";
                                   $result = $conn->query($sql);
                                   if ($result->num_rows > 0) {
                                       while($row = $result->fetch_assoc()) {
                                           echo "<option value='$row[im_sku]'>$row[im_desc]</option>";
                                       }
                                   }
                                   ?>
            
            </datalist>
            <br>
            <button type="submit" class="submit">Search &rarr;</button>
            </div>
        
        </form>
    </div>
    
    <?php } elseif (!empty($_GET["p"])) { 
    //DEFINE Variables
    $p = $_GET["p"];
    //Source data from immf table
    $sql = "SELECT * FROM immf f INNER JOIN sumf s ON s.su_code = f.im_supp WHERE f.im_sku = '$p' LIMIT 1";
    $result = $conn->query($sql);
      if ($result->num_rows > 0) {
 while($row = $result->fetch_assoc()) {
     $id = $row["im_id"];
    ?>
    <div class="left">
    <p1>Product Code: </p1><input disabled value="<?php echo $row["im_sku"];?>"><br>
    <p1>Description: </p1><input disabled value="<?php echo $row["im_desc"];?>"><br>
    </div>
    <div class="right">
    <p1>Preferred Supplier: </p1><input disabled value="<?php echo $row["im_supp"], ' - ', $row["su_name"];?>">
        
    </div>
    
    <?php }} ?>
    <table class="table" style="margin-top:20px;width:100%;float:right; margin-bottom:0">
        <tr style="background-color:rgb(190,190,190)">
      <form action="" method="post">  <th class="th" style="text-align:left">Add New Supplier: <input style="margin:0" onchange="this.form.submit()" list="sumf" name="fr_supp">
            <datalist id="sumf">
            <?php 
    $sql = "SELECT * FROM sumf WHERE su_status = 1 ORDER BY su_name";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<option value='$row[su_code]'>$row[su_name]</option>";
        }
    }
            ?>
          </datalist></th>
            </form>
        </tr>
    
    </table>
<table class="table" style="width:100%; float:right">
    <tr class="tr">
    <th class="th">Supplier</th>
    <th class="th">Action</th>
    </tr>
    <?php 
    $sql = "SELECT * FROM pofr f INNER JOIN sumf s ON s.su_code = f.fr_supp WHERE f.fr_imid = $id ORDER BY s.su_name";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            ?>
    <tr class="tr">
    <td class="td"><?php echo $row["fr_supp"], ' - ', $row["su_name"];?></td>
    <td class="td"><a href="po_from.php?pid=<?php echo $id?>&s=<?php echo $row["fr_supp"];?>&a=delete&return=<?php echo $p;?>">Delete</a></td>
    </tr>
    <?php
        }
    } else { 
        echo "<tr class='tr'><th class='th'>No Supplier!</th>";
        echo "<th class='th'>Add one!</th></tr>";
    }
    ?>
    </table>


<?php } ?>
    <?php if (!empty($_POST)) {
    //Sanitise
    $supplier = $conn -> real_escape_string($_POST["fr_supp"]);
    $prod_id = $conn ->real_escape_string($id);
    //Verify supplier actually exists
    $sql = "SELECT su_code FROM sumf WHERE su_code = $supplier";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            //Is supplier inactive?
            if ($row["su_status"] ==1) {
                echo "<script>alert('Supplier has been set to inactive.');</script>";
            } else {
            //Ensure record does not already exist
            $sql = "SELECT * FROM pofr WHERE fr_imid = $prod_id AND fr_supp = $supplier";
                $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            //Record exists
            echo "<script>alert('This record already exists. Query terminated.');</script>";
        }}
        else {
            $sql = "INSERT INTO pofr (fr_imid, fr_supp) VALUES ('$prod_id','$supplier')";
      $conn->query($sql);
            echo "<script>location.replace('po_from.php?p=$p&success=true')</script>";
        }}
    }}
    else {echo "<script>alert('Supplier not valid!');</script>";}
} elseif (!empty($_GET["a"])) {
    if ($_GET["a"] =="delete") {
        $s = $conn -> real_escape_string($_GET["s"]);
        $pid = $conn->real_escape_string($_GET["pid"]);
        $sql = "DELETE FROM pofr WHERE fr_imid = $pid AND fr_supp = $s";
        $conn->query($sql);
        $prod = $_GET["return"];
        echo "<script>location.replace('po_from.php?p=$prod&delete=true');</script>";
        echo $conn->error;
    }}

    ?>
    </body>
</html>
