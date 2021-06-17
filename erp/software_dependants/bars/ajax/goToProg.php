<style>
    .option {
        margin-left: auto;
        margin-right: auto;
        display: block;
        width: 40%;
        text-align: center;
  background-color: rgb(98,98,98);
        color: white;
        text-decoration: none;
        font-family: sans-serif;
        padding: 5px;
        margin-top: 10px;
    transition: .4s;
      
        
    }
    .option:hover {
        background-color: rgb(130,130,130);
        color: white;
    }
    
    
   
</style><div class="programs"><div class="showOptions">
<?php

$date = date('Y-m-d');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');

if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}
$q = $conn -> real_escape_string($_GET["q"]);
mysqli_select_db($conn,"cumf");

$sql="SELECT * FROM prsc WHERE sc_visible = 1 AND (sc_code LIKE '$q%' OR sc_name LIKE '%$q%')"; 

$result = mysqli_query($conn,$sql);
if ($result->num_rows > 0) {
while($row = mysqli_fetch_array($result)) {

?><a style="text-decoration:none" href="<?php echo $row["sc_path"];?>">
<div class="option"><br>
    <img src="/erp/resources/icons/<?php if (strrpos($row["sc_prog"], "im") !== FALSE) {
    echo "im.png";
 } else if (strrpos($row["sc_prog"], "oe") !== FALSE) {echo "oe.png";} else if (strrpos($row["sc_prog"], "po") !== FALSE) {echo "po.png";} else if (strrpos($row["sc_prog"], "gl") !== FALSE) {echo "gl.png";} else if (strrpos($row["sc_prog"], "ar") !== FALSE) {echo "ar.png";} else if (strrpos($row["sc_prog"], "ap") !== FALSE) {echo "ap.png";} else if (strrpos($row["sc_prog"], "sf") !== FALSE) {echo "sf.png";} elseif (strrpos($row["sc_prog"], "es") !== FALSE) {echo "es.png";} elseif (strrpos($row["sc_prog"], "sp") !== FALSE) {echo "sp.png";} elseif (strrpos($row["sc_prog"], "an") !== FALSE) {echo "an.png";} ?>">
<h2><?php echo $row["sc_name"];?></h2>
    <h4><?php echo $row["sc_code"],' - ', $row["sc_prog"];?></h4>


    </div></a>
    <?php }} else {
    echo "<h1>No results found for '$q'</h1>"; }?></div></div>