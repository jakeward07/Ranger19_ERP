 $(document).ready(function(){
              $(document).ajaxStart(function() {
                    document.getElementById("loading").style.display = "block";
                });
            $("#insert").click(function(){
                var sku = $("#im_sku").val();
                var desc = $("#im_desc").val();
                var per = $("#per").val();
                var oqty = $("#orderQty").val();
                var alloc = $("#allocQty").val();
                var bor = $("#boQty").val();
                var list = $("#netPrice").val();
                var disc = $("#disCount").val();
                var net = $("#netNetPrice").val();
                var marg = $("#margin").val();
                var order = $("#orderNum").val();
                var cnotes = $("#cNotesInp").val();
                var onotes = $("#oNotesInp").val();
                var reqDate = $("#ln_reqdate").val();
                $.ajax({
                    url:'/oe/ajax/javascript/jquery/insert_line.php',
                    method:'POST',
                    data:{
                    a:sku, b:desc, c:per, d:oqty, e:alloc, f:bor, g:list, h:disc, i:net, j:marg, k:order, l:cnotes, m:onotes, n:reqDate
                    },
                   success:function(data){
                       alert("sdsd");
                       $(document).ajaxStop(function() {
              
                    document.getElementById("loading").style.display = "none";
                });
                   }
                   
                }); 
                
              
            });  
        });