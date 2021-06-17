<!DOCTYPE HTML> 
<html><meta name="viewport" content="width=device-width, initial-scale=1.0">
   
  <link rel="icon" href="/erp/resources/icons/ranger%20logo.png">
      <link rel="stylesheet" type="text/css" href="/erp/styling/topbar.css">
<body onload="startTime()">
    
   <div class="top_bar">
   <div id="time" class="user"></div>
    </div>
    
 
    
    </body>
    <script>
    function userDrop() {
  var x = document.getElementById("dropdown");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}
    
    </script>
    <script>
function startTime() {
  var today = new Date();
  var time = 'Time: ';
  var y = today.getFullYear();
  var mt = today.getMonth();
  var d = today.getDate();
  var h = today.getHours();
  var m = today.getMinutes();
  var s = today.getSeconds();
  var ampm = h >= 12 ? 'pm' : 'am';
  m = checkTime(m);
  s = checkTime(s);
  document.getElementById('time').innerHTML =
d + "/" + mt + "/" + y + " " + h + ":" + m + ":" + s + ampm;
  var t = setTimeout(startTime, 500);
}
function checkTime(i) {
  if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
  return i;
}
</script>
</html>