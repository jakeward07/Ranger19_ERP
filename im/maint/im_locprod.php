<?php 
$prog = "im_locprod";
$mod = "im";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>Product Location Maintenance - RANGER 5</title>
    </head>
<body>
<h1>Product Location Maintenance</h1>
     <div class="center">
         <?php if (!empty($_GET)) {
    if ($_GET["success"] =='true') { ?>
         <div class="success">Bin Location Updated</div>
         <?php 
         } else {
        ?>
         <div class="fail">There was an error.</div>
         <?php
    }
}?>
         
         <form action="" method="post">
    <p1>Product Code: </p1><input required onkeyup="getLoc()" name="im_sku" type="text" list="immf" autocomplete="off" autofocus id="input">
         <datalist id="immf">
         <?php $sql = "SELECT * FROM immf";
             $result = $conn->query($sql);
             if ($result->num_rows > 0) {
                 while($row = $result->fetch_assoc()) {
                     ?>
             <option value="<?php echo $row["im_sku"];?>"><?php echo $row["im_desc"];?></option>
             <?php
                 }
             }?>
         
         </datalist>
         <br>
         
         <span id="display"></span>
         </form>
    </div>
         <?php if (!empty($_POST)) {
    //Sanitise
    $sku = $conn->real_escape_string($_POST["im_sku"]);
    $loc = $conn->real_escape_String($_POST["wh_loc"]);
    $sql = "UPDATE imwh SET wh_loc = '$loc' WHERE wh_site = $site_cd AND im_id = (SELECT im_id FROM immf WHERE im_sku = '$sku')";
    $conn->query($sql);
   
    echo "<script>location.replace('im_locprod.php?success=true');</script>";
}
    
    ?>
     <script>
     function getLoc() {
          var o = document.getElementById("input");
          var x = document.getElementById("display");
          
    if (o.value == "") {

   
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
                x.innerHTML = this.responseText;
            
            }
        };
        xmlhttp.open("GET","/im/ajax/im_locprod.php?q="+o.value,true);
        xmlhttp.send();
         
    }
}
    </script>
    
    </body>
</html>
