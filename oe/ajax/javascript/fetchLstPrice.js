     function fetchLast() {
          var x = document.getElementById("lastPrice");
                var sku = document.getElementById("im_sku");
         var cust = document.getElementById("cu_cust");
    if (sku.value == "") {

   
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
        xmlhttp.open("GET","/oe/ajax/sale/oe_lstPrice.php?p="+sku.value+"&c="+cust.value,true);
        xmlhttp.send();
         
    }
}