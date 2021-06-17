<?php 
//Config
$prog = "es_home";
$mod = "es";
$pageNm = "Estimating";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
   
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title><?php echo $pageNm;?> Module - RANGER 5</title>
    
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>
<body>
    <h1><?php echo $pageNm;?> Module</h1>
    <div class="homeMenu">
    
        <!-- Enquiry Tab !-->
   <div class="homeMod" id="enqTab">
            <h4><u>E</u>nquiries</h4>
       <div class="homeLinks">
           <?php 
           $sql = "SELECT * FROM menu WHERE mn_mod = '$mod' AND mn_menu = 'enq'";
           $result = $conn->query($sql);
           if ($result->num_rows > 0) {
               while($row = $result->fetch_assoc()) {
                   ?>

       <a target="<?php if ($link =='0') {echo "_blank";} else {echo "_self";}?>" href="<?php echo $row["mn_path"];?>">
           <button <?php if ($row["mn_perm"] =='*') {} else if ($row["mn_perm"] ==$sec) {} else {echo "hidden";} ?> ><?php echo $row["mn_button"];?></button>
           </a>
          
           
           <?php }}?>
       </div>
        
        </div>
        
        <!-- Action Tab !-->
 <div class="homeMod" id="actTab">
            <h4><u>A</u>ction</h4>
       <div class="homeLinks">
           <?php 
           $sql = "SELECT * FROM menu WHERE mn_mod = '$mod' AND mn_menu = 'act'";
           $result = $conn->query($sql);
           if ($result->num_rows > 0) {
               while($row = $result->fetch_assoc()) {
                   ?>

       <a target="<?php if ($link =='0') {echo "_blank";} else {echo "_self";}?>" href="<?php echo $row["mn_path"];?>">
           <button <?php if ($row["mn_perm"] =='*') {} else if ($row["mn_perm"] ==$sec) {} else {echo "hidden";} ?> ><?php echo $row["mn_button"];?></button>
           </a>
          
           
           <?php }}?>
       </div>
        
        </div>
        
               <!-- Maintenance Tab !-->
 <div class="homeMod" id="maintTab">
            <h4><u>M</u>aintenance</h4>
       <div class="homeLinks">
           <?php 
           $sql = "SELECT * FROM menu WHERE mn_mod = '$mod' AND mn_menu = 'maint'";
           $result = $conn->query($sql);
           if ($result->num_rows > 0) {
               while($row = $result->fetch_assoc()) {
                   ?>

       <a target="<?php if ($link =='0') {echo "_blank";} else {echo "_self";}?>" href="<?php echo $row["mn_path"];?>">
           <button <?php if ($row["mn_perm"] =='*') {} else if ($row["mn_perm"] ==$sec) {} else {echo "hidden";} ?> ><?php echo $row["mn_button"];?></button>
           </a>
          
           
           <?php }}?>
       </div>
        
        </div>
        
           <!-- Report Tab !-->
 <div class="homeMod" id="repTab">
            <h4><u>R</u>eporting</h4>
       <div class="homeLinks">
           <?php 
           $sql = "SELECT * FROM menu WHERE mn_mod = '$mod' AND mn_menu = 'rep'";
           $result = $conn->query($sql);
           if ($result->num_rows > 0) {
               while($row = $result->fetch_assoc()) {
                   ?>

       <a target="<?php if ($link =='0') {echo "_blank";} else {echo "_self";}?>" href="<?php echo $row["mn_path"];?>">
           <button <?php if ($row["mn_perm"] =='*') {} else if ($row["mn_perm"] ==$sec) {} else {echo "hidden";} ?> ><?php echo $row["mn_button"];?></button>
           </a>
          
           
           <?php }}?>
       </div>
        
        </div>
        
           <!-- Import Tab !-->
 <div class="homeMod" id="impTab">
            <h4><u>I</u>mport</h4>
       <div class="homeLinks">
           <?php 
           $sql = "SELECT * FROM menu WHERE mn_mod = '$mod' AND mn_menu = 'imp'";
           $result = $conn->query($sql);
           if ($result->num_rows > 0) {
               while($row = $result->fetch_assoc()) {
                   ?>

       <a target="<?php if ($link =='0') {echo "_blank";} else {echo "_self";}?>" href="<?php echo $row["mn_path"];?>">
           <button <?php if ($row["mn_perm"] =='*') {} else if ($row["mn_perm"] ==$sec) {} else {echo "hidden";} ?> ><?php echo $row["mn_button"];?></button>
           </a>
          
           
           <?php }}?>
       </div>
        
        </div>
        
           <!-- Export Tab !-->
 <div class="homeMod" id="expTab">
            <h4>E<u>x</u>port</h4>
       <div class="homeLinks">
           <?php 
           $sql = "SELECT * FROM menu WHERE mn_mod = '$mod' AND mn_menu = 'exp'";
           $result = $conn->query($sql);
           if ($result->num_rows > 0) {
               while($row = $result->fetch_assoc()) {
                   ?>

       <a target="<?php if ($link =='0') {echo "_blank";} else {echo "_self";}?>" href="<?php echo $row["mn_path"];?>">
           <button <?php if ($row["mn_perm"] =='*') {} else if ($row["mn_perm"] ==$sec) {} else {echo "hidden";} ?> ><?php echo $row["mn_button"];?></button>
           </a>
          
           
           <?php }}?>
       </div>
        
        </div>
        
        
    </div>
    
     
    
    
    </body>
</html>

<script>
    //For Enquiry Tab
$(document).ready(function(){
  $('#enqTab').click(function(){
if ($(this).children().is(':hidden')) {
   $(this).children().slideDown();
} else {
   $(this).children("div").slideUp();
}
  });
});
    
        //For Action Tab
$(document).ready(function(){
  $('#actTab').click(function(){
if ($(this).children().is(':hidden')) {
   $(this).children().slideDown();
} else {
   $(this).children("div").slideUp();
}
  });
});
    
           //For Maintenance Tab
$(document).ready(function(){
  $('#maintTab').click(function(){
if ($(this).children().is(':hidden')) {
   $(this).children().slideDown();
} else {
   $(this).children("div").slideUp();
}
  });
});
         //For Reporting Tab
$(document).ready(function(){
  $('#repTab').click(function(){
if ($(this).children().is(':hidden')) {
   $(this).children().slideDown();
} else {
   $(this).children("div").slideUp();
}
  });
});
    
         //For Import Tab
$(document).ready(function(){
  $('#impTab').click(function(){
if ($(this).children().is(':hidden')) {
   $(this).children().slideDown();
} else {
   $(this).children("div").slideUp();
}
  });
});
    
         //For Export Tab
$(document).ready(function(){
  $('#expTab').click(function(){
if ($(this).children().is(':hidden')) {
   $(this).children().slideDown();
} else {
   $(this).children("div").slideUp();
}
  });
});
    
  
</script>