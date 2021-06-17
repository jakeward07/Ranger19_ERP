<?php
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
    $cust = $conn -> real_escape_string($_POST["cust"]);
    $d1 = $conn -> real_escape_string($_POST["d1"]);
    $d2 = $conn -> real_escape_string($_POST["d2"]);
    $site = $conn -> real_escape_string($_POST["site"]);
$date = date("d-m-Y");
header("Content-Transfer-Encoding: UTF-8");
header('Content-Type: text/csv; charset=utf-8');
header("Content-Disposition: attachment; filename=SalesFor$cust-$date.csv");
    //Verify customer is not some garbage
    $sql = "SELECT * FROM cumf WHERE cu_id = $cust";
$result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            //Customer exists. Get Invoices from range
            if ($site =='all') {
            $sql = "SELECT vh_cust AS Customer, vh_inv AS Invoice, vh_site AS Branch, vh_po AS 'Customer PO', vh_job AS 'Customer Job', cast(vh_timestamp AS date) AS 'Invoice Date', vh_amtex AS 'Amount exc. GST', vh_amtinc AS 'Amount inc. GST' FROM invh WHERE vh_cust = $cust AND cast(vh_timestamp AS DATE) BETWEEN '$d1' AND '$d2'";
            }
            else {
               $sql = "SELECT vh_cust AS Customer, vh_inv AS Invoice, vh_site AS Branch, vh_po AS 'Customer PO', vh_job AS 'Customer Job', cast(vh_timestamp AS date) AS 'Invoice Date', vh_amtex AS 'Amount exc. GST', vh_amtinc AS 'Amount inc. GST' FROM invh WHERE vh_cust = $cust AND cast(vh_timestamp AS DATE) BETWEEN '$d1' AND '$d2' AND vh_site = $site";   
            }
             $result2 = $conn->query($sql);
    $fp = fopen('php://output', 'w');
$placed_header = false;
while($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
    
    // add header to table
    if(!$placed_header) {
        fputcsv($fp, array_keys($row));
        $placed_header = true;
    }

    // place row of data 
    fputcsv($fp, array_values($row));
}
            

fclose($fp);
        }
    }
             
                 

    
?>