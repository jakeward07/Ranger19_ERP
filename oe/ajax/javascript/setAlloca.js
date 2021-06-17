function setAlloc() {
     var x = document.getElementById("orderQty");
    var y = document.getElementById("allocQty");
    var z = document.getElementById("boQty");
    var a = parseFloat(document.getElementById("wh_avail").value);
 if (x.value !=="") {
    if (x.value <= a) {
        y.value = x.value;
        z.value = 0;
    } 
     else if (a < 0) {
         y.value = 0;
         z.value = x.value;
     }
    else if (x.value >= a) {
        y.value = a;
        z.value = x.value-y.value;
    }

    
}}

function allocOverride() {
     var x = parseFloat(document.getElementById("orderQty").value);
    var y = document.getElementById("allocQty");
    var z = document.getElementById("boQty");
    var a = parseFloat(document.getElementById("wh_avail").value);
    if (y.value > x) {
        alert('Please allocate a qty equal or less then the order quantity.');
        y.value = "";
        
    }
    else if (y.value <= x) {
        z.value = x-y.value;
    }
}
