
<link rel="stylesheet" type="text/css" href="/erp/styling/main.css">
<style>
    .blackout #iminput {
        background: none;
        border: none;
        border-bottom: solid;
        border-color: white;
        width: 70%;
        margin-left: auto;
        margin-right: auto;
        position: absolute;
        top: 100px;
        bottom: 0;
        left: 0;
        right: 0;
        font-size: 25px;
        text-align: center;
        color: white;
    }
    
    .blackout input:focus {
        outline: none;
    }

</style> 
<div class="blackout" style="z-index: 10; width:100%; color:white; top: 0; background: rgba(0,0,0,0.87)">
    <h1>Quick Product Search</h1>
    <button class="qexit" onclick="document.getElementById('quickIm').style.display = 'none'" style="position: fixed; right: 10px; top: -30px">X</button>
<input id="iminput" type="text" autocomplete="off" autofocus onkeyup="fetchProd()" placeholder="product code...">

 
</div>
    <span id="imdisplay" style="position: absolute; z-index: 12; left: -200px; right: 0; top: 100px; color:white; margin-left: auto; margin-right: auto; display: block" ></span>
 <script>
     function fetchProd() {
          var o = document.getElementById("iminput");
          var x = document.getElementById("imdisplay");
          
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
        xmlhttp.open("GET","/erp/software_dependants/bars/ajax/im_qsearch.php?q="+o.value,true);
        xmlhttp.send();
         
    }
}
    </script>