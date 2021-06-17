<?php 
$prog = "sf_menu";
$mod = "sf";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>Menu Maintenance - RANGER 5</title>
    </head>
<body>
<h1>Menu Maintenance</h1>
    <div class="center">
    <form action="" method="post">
        <p1>Menu Module: </p1><select autofocus name="mn_mod" required>
        <option></option>
        <option value="ar">Accounts Receivable</option>
        <option value="ap">Accounts Payable</option>
        <option value="gl">General Ledger</option>
        <option value="im">Inventory Management</option>
        <option value="oe">Order Entry</option>
        <option value="sp">Special Pricing</option>
        <option value="es">Quotation Entry</option>
        <option value="po">Purchase Order</option>
        <option value="sf">Security File</option>
        <option value="an">Analytics</option>
        
        </select><br>
        <p1>Security: </p1><select name="mn_perm" required>
        <option></option>
        <option value="*">All Users</option>
        <?php 
        $sql = "SELECT * FROM priv";
        $result=$conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                ?>
        <option value="<?php echo $row["p_name"];?>"><?php echo $row["p_desc"];?></option>
        <?php
            }
        } ?>
        </select><br>
        <p1>Menu: </p1><select name="mn_menu" required>
        <option></option>
        <option value="enq">Enquiries</option>
        <option value="act">Actions</option>
        <option value="maint">Maintenance</option>
        <option value="rep">Reports</option>
        <option value="imp">Import</option>
        <option value="exp">Export</option>
        
        </select><br>
        <p1>Button Text: </p1><input name="mn_button" required autocomplete="off" type="text" maxlength="30"><br>
        <p1>Program Path: </p1><input name="mn_path" required autocomplete="off"><br>
        <button type="submit" class="submit">Create Button</button>
        
        </form>
    <?php if (!empty($_POST)) {
    $sql = "INSERT INTO menu (mn_mod, mn_perm, mn_menu, mn_button, mn_path) VALUES ('$_POST[mn_mod]','$_POST[mn_perm]','$_POST[mn_menu]','$_POST[mn_button]','$_POST[mn_path]')";
    $conn->query($sql);
    
}
    ?>
    </div>
     
    
    
    </body>
</html>
