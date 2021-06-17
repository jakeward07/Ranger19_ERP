function fetchPrice() {
          var o = document.getElementById("im_sku");
          var x = document.getElementById("popPricing");
    var c = document.getElementById("cu_cust");
    var q = document.getElementById("orderQty");
          
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
        xmlhttp.open("GET","/oe/ajax/sale/oe_lines_getPrice.php?p="+o.value+"&q="+c.value+"&c="+q.value,true);
        xmlhttp.send();
         
    }
}