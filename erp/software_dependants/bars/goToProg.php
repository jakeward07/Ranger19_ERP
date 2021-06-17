
<link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
<style>
    .blackout #progid {
        background: none;
        border: none;
        border-bottom: solid;
        border-color: white;
        width: 70%;
        margin-left: auto;
        margin-right: auto;
        position: fixed;
        top: 100px;
        bottom: 0;
        left: 0;
        right: 0;
        font-size: 25px;
        text-align: center;
        color: white;
        z-index: 500;
        overflow: auto; 
    }
    
    .blackout input:focus {
        outline: none;
    }
    
    .progInp { 
      background-color: rgb(98,98,98);
      
    }

</style> 
<div class="blackout" style="z-index: 10; width:100%; color:white; top: 0; background: rgba(0,0,0,0.87)">
    <h1>Program Selection</h1>
    <button class="qexit" onclick="document.getElementById('send2prog').style.display = 'none'" style="position: fixed; right: 10px; top: -30px">X</button>
    <div class="progInp">
<input id="progid" type="text" autocomplete="off" autofocus onkeyup="fetchProg()" placeholder="program code...">
    </div>
 
</div>
    <span id="progdisplay" style="position: absolute; z-index: 12; left: -200px; right: 0; top: 100px; color:white; margin-left: auto; margin-right: auto; display: block" ></span>
 <script>
     function fetchProg() {
          var o = document.getElementById("progid");
          var x = document.getElementById("progdisplay");
          
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
        xmlhttp.open("GET","/erp/software_dependants/bars/ajax/goToProg.php?q="+o.value,true);
        xmlhttp.send();
         
    }
}
    </script>