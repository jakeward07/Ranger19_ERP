function showSubmit() {
    var cs = document.getElementById("cuid");
    var po = document.getElementById("cu_po");
    var jb = document.getElementById("cu_jb");
    var us = document.getElementById("oeUser");
    var sb = document.getElementById("submitSpan");
    if (po.required == true || jb.required == true) {
        if (po.value == "" || jb.value ="") {
            sb.style.display = "block";
        } 
    }
    
}