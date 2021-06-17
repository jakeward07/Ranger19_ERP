  function popFields() {
             var flag = document.getElementById("priceFlag");
    var x = document.getElementById("netPrice");
    var y = document.getElementById("disCount");
    var a = document.getElementById("gPrice");
    var b = document.getElementById("gDisc");
    var f1 = document.getElementById("flagM");

   
        x.value = a.value;
        y.value = b.value;
        flag.value = '1231231221';

       
    
}

function calcNet() {
     var x = document.getElementById("netPrice");
    var y = document.getElementById("disCount");
    var z = document.getElementById("netNetPrice");
     var f1 = document.getElementById("flagM");
         var f2 = document.getElementById("priceFlag");
    var calc = ((100-y.value)*x.value)/100;
    z.value = calc.toFixed(2);
    calcMargin();
    calcLineTotal();
    f2.value = f1.value;
}

function calcMargin() {
      var z = document.getElementById("netNetPrice");
    var x = document.getElementById("margin");
    var y = parseFloat(document.getElementById("margCs").value);
    var w = document.getElementById("per");
    var a = ((z.value-y)/z.value)*100;
    x.value = a.toFixed(2)+"%";
    if (a <= 0) {
        x.style.border = "solid";
      x.style.borderColor = "red";
    } else {
        x.style.border = "solid";
        x.style.borderColor = "limegreen";
    }
}

function calcLineTotal() {
    var x = document.getElementById("lineEx");
    var y = document.getElementById("lineInc");
    var a = document.getElementById("per");
    var b = document.getElementById("netNetPrice");
    var c = document.getElementById("orderQty");
    var tot1 = b.value*c.value/a.value;
    var tot2 = (b.value*c.value/a.value)*1.1;
    x.value = "$"+tot1.toFixed(2);
    y.value = "$"+tot2.toFixed(2);
}
