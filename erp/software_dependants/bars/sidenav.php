<?php 
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/dep/checkSec.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/dep/sf/gnmf.php');
if (!isset($_SESSION['loggedin'])) {
	header('Location: /login.php');
	exit();
}

include('top_bar.php');
$sql = "SELECT * FROM stmf s INNER JOIN bdmf b ON s.st_brand = b.bd_id WHERE s.st_code = $site_cd LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $logoPath = $row["bd_logo"];
    }
}
?>
<!DOCTYPE HTML>
<html>
  <head>
    
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    </head>
    <meta name="viewport" content="width=device-width, initial-scale=0.7">
    <link rel="stylesheet" type="text/css" href="/erp/styling/sidenav2.css">
    <style>
        
    <?php if (!empty($bgimg)) { ?>
        body {
           
            background-image: url(/erp/uploads/us_bg/<?php echo $bgimg?>);
            background-attachment: fixed;
            background-size: cover;
        }
       
        
        <?php }?>
         .bkout {
            position: fixed;
            background: <?php echo $bgcol;?>;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: -1;
            width: 100%;
        }
    </style>
   
 <body>
     <div class="bkout"></div> 
<div class="sideNav">
    <div class="userDetails">
     <span class="circle" style="<?php if (isset($logoPath)) {echo "background-image: url($logoPath)";}?>">
    </span>
     <h4><?php echo $name;?></h4>
        <a href="#"><p>My Profile &rarr;</p></a>
        <a href="/erp/software_dependants/dep/logout.php" class="logout"><p>Logout &rarr;</p></a>
    </div>
    <a href="/erp/home.php">
    <div class="module <?php if (strrpos($_SERVER['REQUEST_URI'], '/home.php')) {echo "active";} ?>">
   <span class="material-icons">home</span><h4>Home &rarr;</h4>
    </div>
    </a>
    
      <a href="/oe/oe_home.php">
    <div class="module <?php if (strrpos($_SERVER['REQUEST_URI'], '/oe')) {echo "active";} ?>">
        <span class="material-icons">point_of_sale</span> <h4>Sales Entry &rarr;</h4>
    </div>
    </a>
    
      <a href="/im/im_home.php">
    <div class="module <?php if (strrpos($_SERVER['REQUEST_URI'], '/im')) {echo "active";} ?>">
    <span class="material-icons">content_paste</span><h4>Warehouse &rarr;</h4>
    </div>
    </a>
    
        <a href="/ar/ar_home.php">
    <div class="module <?php if (strrpos($_SERVER['REQUEST_URI'], '/ar')) {echo "active";} ?>">
   <span class="material-icons">payment</span> <h4>Recievables &rarr;</h4>
    </div>
    </a>
    
      <a href="/ap/ap_home.php">
    <div class="module <?php if (strrpos($_SERVER['REQUEST_URI'], '/ap')) {echo "active";} ?>">
 <span class="material-icons">account_balance</span> <h4>Payables &rarr;</h4>
    </div>
    </a>
    
       <a href="/po/po_home.php">
    <div class="module <?php if (strrpos($_SERVER['REQUEST_URI'], '/po')) {echo "active";} ?>">
 <span class="material-icons">shopping_cart</span> <h4>Procurement &rarr;</h4>
    </div>
    </a>
    
       <a href="/sp/sp_home.php">
    <div class="module <?php if (strrpos($_SERVER['REQUEST_URI'], '/sp')) {echo "active";} ?>">
 <span class="material-icons">local_offer</span> <h4>Pricing &rarr;</h4>
    </div>
    </a>
    
       <a href="/an/an_home.php">
    <div class="module <?php if (strrpos($_SERVER['REQUEST_URI'], '/an')) {echo "active";} ?>">
 <span class="material-icons">pie_chart</span> <h4>Analytics &rarr;</h4>
    </div>
    </a>
     
      <a href="/sf/sf_home.php">
    <div class="module <?php if (strrpos($_SERVER['REQUEST_URI'], '/sf')) {echo "active";} ?>">
 <span class="material-icons">security</span> <h4>Security &rarr;</h4>
    </div>
    </a>
    
    <div class="module" id="programSearch" onclick="openProgSearch()">
 <span class="material-icons">search</span> <h4>Program Search &rarr;</h4>
    </div>
    
    <p id="footer">&copy; <?php echo date("Y");?> SnakeBite Software</p>
     </div>
      <script>
        function openProgSearch() {
              var x = document.getElementById("send2prog");
            if (document.getElementById("quickAr").style.display ==="block") {
                document.getElementById("quickAr").style.display = "none";
                  x.style.display = "block";
                 document.getElementById("progid").focus()
                 document.getElementById("progid").select();
            }
            else if (document.getElementById("quickIm").style.display ==="block") {
                document.getElementById("quickIm").style.display = "none";
                  x.style.display = "block";
                 document.getElementById("progid").focus()
                 document.getElementById("progid").select(); }
            else {
            x.style.display = "block";
            document.getElementById("progid").focus();
            if (document.getElementById("progid").value !=="") {
                document.getElementById("progid").select();
            }}
        
        }
    function blkout() {
       
              document.getElementById("prog").scrollIntoView();
      document.getElementById("blackout").style.display = "block";
        }
       
        function exitBlk() {
            document.getElementById("blackout").style.display = "none";
        }
 addEventListener("keyup", function(event) {
        var x = document.getElementById("quickIm");
        if (event.keyCode ===120) {
              if (document.getElementById("quickAr").style.display ==="block") {
                document.getElementById("quickAr").style.display = "none";
                    x.style.display = "block";
                   document.getElementById("iminput").focus();
                   document.getElementById("iminput").select();
            } else if (document.getElementById("send2prog").style.display ==="block") {
                document.getElementById("send2prog").style.display = "none";
                    x.style.display = "block";
                   document.getElementById("iminput").focus();
                   document.getElementById("iminput").select();
            } else {
            x.style.display = "block";
            document.getElementById("iminput").focus();
            if (document.getElementById("iminput").value !=="") {
                 document.getElementById("iminput").select();
                
            }}
        }
     else if (event.keyCode ===27) {
                x.style.display = "none";
            }
    });
        
         addEventListener("keyup", function(event) {
        var x = document.getElementById("quickAr");
        if (event.keyCode ===119) {
           
            if (document.getElementById("quickIm").style.display ==="block") {
                document.getElementById("quickIm").style.display = "none";
                  x.style.display = "block";
                 document.getElementById("arinput").focus()
                 document.getElementById("arinput").select();
            } else if (document.getElementById("send2prog").style.display ==="block") {
                document.getElementById("send2prog").style.display = "none";
                  x.style.display = "block";
                 document.getElementById("arinput").focus()
                 document.getElementById("arinput").select();
            } else {
            x.style.display = "block";
            document.getElementById("arinput").focus();
            if (document.getElementById("arinput").value !=="") {
                document.getElementById("arinput").select();
            }}
        }
     else if (event.keyCode ===27) {
                x.style.display = "none";
            }
    });
         addEventListener("keyup", function(event) {
        var x = document.getElementById("send2prog");
        if (event.keyCode ===118) {
            if (document.getElementById("quickAr").style.display ==="block") {
                document.getElementById("quickAr").style.display = "none";
                  x.style.display = "block";
                 document.getElementById("progid").focus()
                 document.getElementById("progid").select();
            }
            else if (document.getElementById("quickIm").style.display ==="block") {
                document.getElementById("quickIm").style.display = "none";
                  x.style.display = "block";
                 document.getElementById("progid").focus()
                 document.getElementById("progid").select(); }
            else {
            x.style.display = "block";
            document.getElementById("progid").focus();
            if (document.getElementById("progid").value !=="") {
                document.getElementById("progid").select();
            }}
        }
     else if (event.keyCode ===27) {
                x.style.display = "none";
            }
    });
        
    
    </script>
       
    <span id="quickIm" hidden>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/im_qsearch.php');?>
    
    </span>
    <span id="quickAr" hidden>  <?php include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/ar_qsearch.php');?></span>
      <span id="send2prog" hidden>  <?php include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/goToProg.php');?></span>
   
  </body>
</html>