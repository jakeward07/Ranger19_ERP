<?php 
$prog = "home";
$mod = "hm";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>Home - RANGER 5</title>
    </head>
<body>
<h1>Home</h1>
    <div class="left"></div>
     <div class="right" style="width:30%">
    <h1>Blog Entries</h1>
    <?php 
         $sql = "SELECT * FROM blog ORDER BY bg_id DESC LIMIT 2";
         $result = $conn->query($sql);
         if ($result->num_rows > 0) {
             while($row = $result->fetch_assoc()) {
                 ?><a style="color:black" href="blog.php?entry=<?php echo $row["bg_id"];?>"><div class="blogCard">
         <h2><?php echo $row["bg_title"];?></h2>
         <h4><?php echo $row["bg_user"];?></h4>
         <p style="text-align:left"><?php 
             $content = $row["bg_content"];
                 if (strlen($content) > 100) {
                    //Limit count
                     $stringCut = substr($content, 0, 100);
                     $endPoint = strrpos($stringCut, ' ');
                     $content = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                     $content .= ".......<a href='blog.php?entry=$row[bg_id]' style='color:blue'>Read More</a>";
                 }
                 echo $content;
             ?></p>
         </div></a>
         
         <?php
                
             }
         }
         else {
             echo "<h3>No blogs Entries<h3>";
         }
         ?><a href="blog.php" style="color:black"><h5>All Blog Entries &rarr;</h5></a>
    </div>
   
    </body>
</html>
