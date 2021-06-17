<?php

$s = $_GET['s'];
$c = $_GET['c'];

$site_cd = 228;
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');

if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}

mysqli_select_db($conn,"spmf");

$spmf = "SELECT * FROM spmf WHERE sp_cust = '$c' AND sp_code = '$s'";
$result = $conn->query($spmf);
if ($result->num_rows > 0) {
    while($row=$result->fetch_assoc()) {
        //Record found. Checking if type equals Product or Class
$g_spmf = "SELECT * FROM spmf s INNER JOIN cumf c ON c.cu_id = '$c' INNER JOIN immf p ON p.im_sku = '$s' LEFT JOIN imwh wh ON wh.wh_id = p.im_id AND wh.wh_site = '$site_cd' WHERE s.sp_cust = '$c' AND s.sp_code = '$s' AND s.sp_type = 'Product'";
$result = $conn->query($g_spmf);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
            
                
                //If price type is set to Discount.
                if ($row["sp_ptyp"] =="Discount") {
                    $disc = ($row["sp_pval"]/100)*$row["im_trd"];
                    echo $disc; 
                }
                //If price type is set to Margin.
                elseif ($row["sp_ptyp"] =="Margin") {
                 if (!empty($row["wh_avgcst"])) {
             $avg = $row["wh_avgcst"]/(100-$row["sp_pval"])*100;
                     echo round($avg,4); 
                     
                  
                 }
                    else {
                        $stdc = $row["im_stdc"]/(100-$row["sp_pval"])*100;
                        echo round($stdc,4);
                        
                    }
                }
                //If price type is set to Net.
                if ($row["sp_ptyp"] =="Net") {
                    $net = $row["sp_pval"];
                    echo $net;
                 
                }
            }
        }}
 $g_spmfc = "SELECT * FROM spmf s INNER JOIN cumf c ON c.cu_id = '$c' INNER JOIN immf p ON s.sp_code = p.im_scls WHERE p.im_sku = '$s' AND s.sp_type = 'Class'";
$result = $conn->query($g_spmfc);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
   if ($row["sp_ptyp"] =="Discount") {
       if ($row["cu_sptp"] ==1) {
      $disc2 = ($row["sp_pval"]/100)*$row["im_trd"]; 
       echo $disc2;
       }
       else {
           $disc2 = ($row["sp_pval"]/100)*$row["im_ret"]; 
           echo $disc2;
       }
   }
                elseif ($row["sp_ptyp"] =="Margin") {
    $marg = $row["im_stdc"]/(100-$row["sp_pval"])*100;
                    echo $marg;
                }
    }
}}
    
else {
   $stdp = "SELECT * FROM cumf c JOIN immf p WHERE c.cu_id = '$c' AND p.im_sku = '$s'";
$result = $conn->query($stdp);
    if ($result->num_rows > 0){
        while($row = $result->fetch_assoc()) {
           //If customer is set to 1 (Trade).
            if ($row["cu_sptp"] ==1) {
                $trade = $row["im_trd"];
                echo $trade;
             
            }
            else {
                $ret = $row["im_ret"];
                echo $ret;
         
            }
        }
    }
}


?>
