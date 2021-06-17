         function displayQty() {
             var sku = document.getElementById("im_sku");
             var x = document.getElementById("orderQty");
             var y = document.getElementById("qtySpan");
             if (sku.value !=="") {
                 y.style.display = "block";
                 x.focus();
             }
             else {
                 y.style.display = "none";
             }
        
         }
