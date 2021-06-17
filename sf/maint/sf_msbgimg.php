<?php 
$prog = "sf_msbgimg";
$mod = "sf";
include($_SERVER['DOCUMENT_ROOT'].'/erp/software_dependants/bars/sidenav.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

?>
<!DOCTYPE HTML>
<html>
<head>
    <script src="/erp/software_dependants/dep/sf/jscolor.js"></script>
    <script>
    jscolor.presets.default = {
    height: 181,              // make the picker box a little bigger
    position: 'left',        // position the picker to the right of the target
    previewPosition: 'left', // display color preview on the right side
    previewSize: 40,          // make color preview bigger
  
};
    </script>
    <link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
    <title>Mass Change Background Image - RANGER 5</title>
    </head>
<body>
   
    <div class="searchBox" style="width:600px; height:400px;margin-top:100px">
<div class="center">
    <form action="" method="post" enctype="multipart/form-data">
    <h1>Mass Change Background Image</h1>
    <p1>Background Image: </p1><input type="file" id="image" name="uploadedFile" style="background:none"><br>
    <p1>Overlay Color: </p1><input name="color" value="<?php echo $bgcol?>" required id="overlay" data-jscolor="{required:true, format:'rgba'}"><br>  
    <button type="submit" name="submit" class="submit">Save Settings &rarr;</button>
       
           <?php if (!empty($bgimg)) {?> <br><br><a href="sf_msbgimg.php?delete=true"><button type="button" class="submit">Delete Background Image &rarr;</button>   </a><?php }?>
    
    </form>
        </div>
    
    </div>
    <?php if (!empty($_POST)) {
    if(!empty($_FILES['uploadedFile']['name'][0])) {
    $random = rand(1, 1000000000000000);
   
// get details of the uploaded file
$fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
$fileName = $_FILES['uploadedFile']['name'];
$fileSize = $_FILES['uploadedFile']['size'];
$fileType = $_FILES['uploadedFile']['type'];
$fileNameCmps = explode(".", $fileName);
$fileExtension = strtolower(end($fileNameCmps));
$newFileName = md5(time() . $fileName) . '.' . $fileExtension;
$allowedfileExtensions = array('png', 'jpg', 'jpeg');
if (in_array($fileExtension, $allowedfileExtensions)) {
// directory in which the uploaded file will be moved
$uploadFileDir = $_SERVER['DOCUMENT_ROOT'].'/erp/uploads/us_bg/';
$dest_path = $uploadFileDir . $newFileName;
    
if(move_uploaded_file($fileTmpPath, $dest_path))
{
    $sql = "SELECT us_bgimg FROM usmf";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $img = $row["us_bgimg"];
            unlink("$uploadFileDir$img");
        }
    }
  $sql = "UPDATE usmf SET us_bgimg = '$newFileName', us_bgcol = '$_POST[color]'";
    $conn->query($sql);
    echo $conn->error;
}
}}
else {
    $sql = "UPDATE usmf SET us_bgcol = '$_POST[color]'";
    $conn->query($sql);
}
    echo "<script>location.replace('sf_msbgimg.php');</script>";
}
                                       if (!empty($_GET)) {
                                       if ($_GET["delete"] =='true') {
$url = $_SERVER['DOCUMENT_ROOT']."/erp/uploads/us_bg/$bgimg";
                                           echo "<script>alert('$url');</script>";
            unlink("$url");
            $sql = "UPDATE usmf SET us_bgimg = NULL";
            $conn->query($sql);
               echo "<script>location.replace('sf_msbgimg.php');</script>";
        }
                                       }
 ?>   
    
    </body>
</html>
