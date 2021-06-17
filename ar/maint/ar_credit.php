<?php 
$prog = "ar_credit";
$mod = "ar";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>Credit Control - RANGER 5</title>
    </head>
<body>
<h1>Credit Control</h1>
     <div class="center">
         <form action="" method="post">
    <p1>Customer: </p1><input onchange="getCust()" name="cu_cust" list="cumf" id="custVal" required autocomplete="off" required>
         <datalist id="cumf">
             <?php 
             $sql = "SELECT * FROM cumf";
             $result = $conn->query($sql);
             if ($result->num_rows > 0) {
                 while ($row = $result->fetch_assoc()) {
           ?>
             <option onclick="getCust()" value="<?php echo $row["cu_id"];?>"><?php echo $row["cu_name"];?></option>
         <?php }}?>
         
         </datalist><br>
    <p1 id="custDet"></p1>
    <span id="submitBut" hidden><button type="submit" class="submit">Update Credit Status</button></span>
         </form>
             </div>
    <?php 
    if (!empty($_POST)) {
        
       $sql = "UPDATE cumf SET cu_limit = '$_POST[cu_limit]', cu_hldsts = '$_POST[cu_hldsts]' WHERE cu_id = '$_POST[cu_cust]'";
      $conn->query($sql); 
    }
    ?>
    <script>
    
     function getCust() {
          var c = document.getElementById("custVal");
          var x = document.getElementById("submitBut");
          
    if (c.value == "") {
 x.style.display = "none";
        document.getElementById("custDet").innerHTML = "";
        return;
    } else {
              x.style.display = "block";
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("custDet").innerHTML = this.responseText;
            
            }
        };
        xmlhttp.open("GET","/ar/ajax/get_cust.php?q="+c.value,true);
        xmlhttp.send();
         
    }
}
    </script>
    </body>
</html>
