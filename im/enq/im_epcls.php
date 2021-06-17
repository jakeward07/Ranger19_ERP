<?php 
$prog = "im_epcls";
$mod = "im";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>Price Class Enquiry - RANGER 5</title>
    </head>
<body><h1>Products vs Price Class Enquiry</h1>
<form action="" method="post">
    <div class="center">
        
    <p1>Price Class: </p1><input onchange="grabClass()" required id="im_pcls" name="im_class" list="pClass" required type="text" autocomplete="off">
        <datalist id="pClass">
        <?php 
            $sql = "SELECT * FROM impc ORDER BY pc_code";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()){
                    ?>
            <option value="<?php echo $row["pc_code"];?>"><?php echo $row["pc_name"];?>  |  Supplier: <?php echo $row["pc_vendor"];?></option>
            <?php
                }
            }
        ?>
        
        </datalist>
    <br>
        
    </div><br><br>
    <p1 id="showTbl"></p1>
    
    </form>
     
   <script>
                function grabClass() {
          var x = document.getElementById("im_pcls");
          
    if (x.value == "") {

        document.getElementById("showTbl").innerHTML = "";
        return;
    } else {
          
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("showTbl").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","/im/ajax/im_epcls.php?q="+x.value,true);
        xmlhttp.send();
         
    }
}
    
    </script> 
    
    </body>
</html>
