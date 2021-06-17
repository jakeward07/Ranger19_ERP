<?php 
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/dep/checkSec.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/dep/sf/gnmf.php');
if (!isset($_SESSION['loggedin'])) {
	header('Location: /login.php');
	exit();
}

include('top_bar.php');

?>
<!DOCTYPE HTML>
<html>
  <head>
    
    </head>
    <meta name="viewport" content="width=device-width, initial-scale=0.7">
    <link rel="stylesheet" type="text/css" href="/erp/styling/sidenav.css">
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
<div class="menuBar">
    <div class="userInfo">
    <shape>    <h3><?php echo $name[0];?></h3>
        </shape>
        <h4><?php echo $name;?></h4>
      <a href="/sf/enq/sf_myprofile.php"><p>My Profile &rarr;</p></a>
      <a href="/erp/software_dependants/dep/logout.php"><p>Logout &rarr;</p></a>
    </div><br>
   <div class="bar_menu"><a href="/erp/home.php">
      <div class="menButton <?php if ($mod =="hm") {echo "selected";}?>">
  <img src="/erp/resources/icons/im.png">
    <p1>Home</p1>
       </div></a>
   <a href="/oe/oe_home.php">   <div class="menButton <?php if ($mod =="oe") {echo "selected";}?>">
  <img src="/erp/resources//icons/oe.png">
    <p1>Sales Processing</p1>
          </div></a> 
       
         <a href="/qe/qe_home.php">   <div class="menButton <?php if ($mod =="es") {echo "selected";}?>">
  <img src="/erp/resources//icons/es.png">
    <p1>Quotation Entry</p1>
          </div></a> 
       
       
       
       
       
      <a href="/ap/ap_enq.php">   <div class="menButton <?php if ($mod =="ap") {echo "selected";}?>">
  <img src="/erp/resources//icons/ap.png">
    <p1>Accounts Payable</p1>
          </div></a> 
         <a href="/gl/gl_accenq.php">   <div class="menButton <?php if ($mod =="gl") {echo "selected";}?>">
  <img src="/erp/resources//icons/gl.png">
    <p1>General Ledger</p1>
          </div></a>
       <a href="/ar/ar_home.php">   <div class="menButton <?php if ($mod =="ar") {echo "selected";}?>" >
  <img src="/erp/resources//icons/ar.png">
    <p1>Accounts Receivable</p1>
          </div></a> 
       <a href="/im/im_home.php">   <div class="menButton <?php if ($mod =="im") {echo "selected";}?>">
  <img src="/erp/resources//icons/im.png">
    <p1>Inventory</p1>
          </div></a>
       <a href="/po/po_home.php">   <div class="menButton <?php if ($mod =="po") {echo "selected";}?>">
  <img src="/erp/resources//icons/po.png">
    <p1>Purchasing</p1>
          </div></a>
          <a href="/sp/sp_home.php">   <div class="menButton <?php if ($mod =="sp") {echo "selected";}?>">
  <img src="/erp/resources/icons/sp.png">
    <p1>Special Pricing</p1>
          </div></a>
         <a href="/an/an_home.php">   <div class="menButton <?php if ($mod =="an") {echo "selected";}?>">
  <img src="/erp/resources/icons/an.png">
    <p1>Analytics</p1>
          </div></a>
       
    <a href="/sf/sf_home.php"><div class="menButton <?php if ($mod =="sf") {echo "selected";} ?>" <?php if ($sec !=='ADM') {echo "style='display:none'";}?></div>
  <img src="/erp/resources//icons/sf.png">
    <p1>Admin</p1>
        </div></a>
    
    <div onclick="openProgSearch()" class="menButton" </div>
  <img src="/erp/resources//icons/search.png">
    <p1>Program Search</p1>
        </div>
     
      <a href="/an/an_home.php">   <div class="menButton <?php if ($mod =="help") {echo "selected";}?>">
  <img src="/erp/resources/icons/help.png">
    <p1>Support</p1>
          </div></a>
     
      <a href="/an/an_home.php">   <div class="menButton <?php if ($mod =="sb") {echo "selected";}?>">
  <img src="/erp/resources/icons/snakebite.png">
    <p1>SnakeBite Software</p1>
          </div></a>
       
    </div>   
   
   
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