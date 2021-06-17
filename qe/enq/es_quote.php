<?php 
$prog = "es_quote";
$mod = "es";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>Quotation Search - RANGER 5</title>
    </head>
<body>
    <br><br><br><br><br>

   <div style="width: 600px;" class="searchBox">
       <h1>Quotation Search</h1>
    <form action="" method="post">
       <div class="center">
        <p1>Quotation Number: </p1><input type="number" autocomplete="off" autofocus name="quote"><br>
        <p1>Customer Number: </p1><input type="number" autocomplete="off" name="cust" list="cumf">
           <datalist id="cumf">
           <?php $sql = "SELECT cu_id, cu_name FROM cumf";
               $result = $conn->query($sql);
               if ($result->num_rows > 0) {
                   while($row = $result->fetch_assoc()) {
                       ?>
               <option value="<?php echo $row["cu_id"];?>"><?php echo $row["cu_name"];?></option>  
               <?php
                   }
               }
           ?>
           </datalist>
           <br>
        <p1>Title: </p1><input type="text" autocomplete="off" name="title"><br>
        <p1>Product Code: </p1><input type="text" autocomplete="off" name="sku" list="immf">
             <datalist id="immf">
           <?php $sql = "SELECT im_sku, im_desc FROM immf";
               $result = $conn->query($sql);
               if ($result->num_rows > 0) {
                   while($row = $result->fetch_assoc()) {
                       ?>
               <option value="<?php echo $row["im_sku"];?>"><?php echo $row["im_desc"];?></option>  
               <?php
                   }
               }
           ?>
           </datalist><br>
        <p1>User: </p1><input type="text" autocomplete="off" list="usmf" name="user"><br>
          <datalist id="usmf">
           <?php $sql = "SELECT us_user, us_name FROM usmf WHERE us_site = $site_cd";
               $result = $conn->query($sql);
               if ($result->num_rows > 0) {
                   while($row = $result->fetch_assoc()) {
                       ?>
               <option value="<?php echo $row["us_user"];?>"><?php echo $row["us_name"];?></option>  
               <?php
                   }
               }
           ?>
           </datalist>
        
           <button type="submit" class="submit">Search</button>
        </div>
       
       
       </form>
    
    
    </div>
    
    </body>
</html>
