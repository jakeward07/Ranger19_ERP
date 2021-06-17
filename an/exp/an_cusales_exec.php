<?php 
$prog = "an_cusales_exec";
$mod = "an";
$pname = "Customer Sales Export";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title><?php echo $pname;?> - RANGER 5</title>
    </head>
<body>
<h1><?php echo $pname;?></h1>
     <div class="center">
         <form action="/an/exp/spool/an_cusales_exec.php" method="post">
    <p1>Select a Customer: </p1><input onkeyup="showDate()" name="cust" list="cumf" id="cust" placeholder="Enter Customer for Sales Export" required autocomplete="off" autofocus>
         <datalist id="cumf">
         <?php 
             $sql = "SELECT * FROM cumf";
             $result = $conn->query($sql);
             if ($result->num_rows > 0) {
                 while($row = $result->fetch_assoc()) {
                     ?>
             <option value="<?php echo $row["cu_id"];?>"><?php echo $row["cu_name"];?></option>
             <?php
                 } 
             } ?>
         </datalist><br>
         <span id="dateHidden" hidden>
         <p1>Date From: </p1><input type="date" value="<?php echo date("Y-m-d");?>" required name="d1"><br> 
         <p1>Date To: </p1><input type="date" value="<?php echo date("Y-m-d");?>" required name="d2"><br> 
        <p1>Site: </p1><select name="site">
             <option value="all">All Sites</option>
             <?php 
             $sql = "SELECT * FROM stmf";
             $result = $conn->query($sql);
             if ($result->num_rows > 0) {
                 while($row = $result->fetch_assoc()) {
                     ?>
             <option value="<?php echo $row["st_code"];?>"><?php echo $row["st_code"], ' - ', $row["st_name"];?></option>
             <?php }}?>
             </select><br>
             <button type="submit" class="submit">Generate CSV &rarr;</button>
         </span>
         </form>
    </div>
   
    <script>
    function showDate() {
        var x = document.getElementById("cust");
        var y = document.getElementById("dateHidden");
        if (x.value !=="") {
            y.style.display = "block";
        } 
        else {
            y.style.display = "none";
        }
    }
    </script>
    </body>
</html>
