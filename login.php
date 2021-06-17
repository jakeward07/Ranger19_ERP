<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" href="/erp/styling/login.css">
    <title>Ranger 5 ERP Login</title>
    <link rel="icon" href="/erp/resources/icons/ranger%20logo.png">
    </head>
    <style>
        body {
            background-image: url(/erp/uploads/login/eraring.jpg);
           background-size: 100%;
            
            
        }
    </style>
<body onload="startTime()"><br>
    <span id="clock"></span>
    <div class="form">
        <img src="/erp/resources/icons/ranger%20logo.png" class="logo">
        <h1>Login to Ranger 5 ERP</h1>
    <form action="/erp/software_dependants/dep/authenticate.php" method="post">
        
        <input onkeyup="showSub()" class="user" name="us_usernm" required type="text" placeholder="Username" autocomplete="off" autofocus id="usernm">
        <input onkeyup="showSub()" class="pswd" name="us_password" required type="password" placeholder="Password" autocomplete="off" id="passwd">
        <span hidden id="submit"><button class="button" type="submit">Login</button>
        </span>
        </form>
    <h4 id="footer">&copy; SnakeBite Software 2020 - <?php echo date('Y');?></h4>
    </div>
    
    
    <script>
    function showSub() {
        var x = document.getElementById("usernm");
        var y = document.getElementById("passwd");
        var z = document.getElementById("submit");
        if (x.value !=="" && y.value !=="") {
            z.style.display = "block";
        }
        else {
            z.style.display = "none";
        }
    }
        function startTime() {
  var today = new Date();
  var h = today.getHours();
  var m = today.getMinutes();
  var s = today.getSeconds();

  m = checkTime(m);
  s = checkTime(s);
  document.getElementById('clock').innerHTML =
  h + ":" + m + ":" + s;
  var t = setTimeout(startTime, 500);
}
function checkTime(i) {
  if (i < 10) {i = "0" + i
              };  // add zero in front of numbers < 10
  return i;
    
}
    
    
    </script>
    
    
    
    </body>
</html>