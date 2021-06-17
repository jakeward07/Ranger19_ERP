<?php 
$prog = "oe_ordpay";
$mod = "oe";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>Order Payment - RANGER 5</title>
    </head>
<body><?php
    $ord = $_GET["o"];
    $sql = "SELECT * FROM invh h INNER JOIN cumf c ON c.cu_id = h.vh_cust WHERE h.vh_order = $ord AND h.vh_site = $site_cd";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            ?>
        
<h1>Order Payment</h1>
     <div class="left">
    <p1>Customer: </p1><input disabled value="<?php echo $row["vh_cust"],' - ',$row["cu_name"];?>">
    
    </div>
    <div class="right">
    <p1>Amount Owing: </p1><input value="<?php echo number_format($row["vh_amtinc"],2);?>" id="amtOwing" disabled>
    
    
    </div>
    <div class="center" style="width:100%;margin-top:100px; margin-left:auto;margin-right:auto;display:table; text-align:center">
    <p1>Payment Type</p1><br> <select autofocus required name="type">
        <option></option>
        <option value="cash">Cash</option>
        <option value="eft">Eftpos</option>
        <option value="mast">Mastercard</option>
        <option value="amex">Amex</option>
        <option value="visa">Visa</option>
        <option value="bank">Bank Transfer</option>
        
        </select><br>
        <p1>Amount $</p1>
        <br>
        <input required id="amount" type="number">
    
    </div>
    <?php }}?>
    </body>
    <script>
    function payType() {
        var x = document.getElementById("type");
        var y = document.getElementById("amount"); //User input
        var z = document.getElementById("amtOwing"); //Disabled input
        if (x.value =="cash") {
            z.val
        }
    }
    </script>
</html>
