<?php
//Include  files
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
require($_SERVER['DOCUMENT_ROOT'].'/doc_gen/fpdf/fpdf.php');
//Get branch details
$sql = "SELECT * FROM stmf s INNER JOIN bdmf b ON b.bd_id = s.st_brand WHERE s.st_code = $site_cd";
$result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {
     $sitenm = $row["st_name"];
        $logoPath = $row["bd_logo"];
        $addr = $row["st_addr"];
        $sub = $row["st_sub"];
        $pc = $row["st_pstcd"];
        $state = $row["st_state"];
        $phone = $row["st_phone"];
        $abn = $row["bd_abn"];
    }
$q = 300003;
$sql = "SELECT * FROM eshd WHERE es_quote = $q AND es_site = $site_cd";
$result = $conn->query($sql);
    while($row = $result->fetch_assoc()) { 
    $quote = $row["es_quote"];
    $qsite = $row["es_site"];
    $cust = $row["es_cust"];
    $cuname = $row["es_cuname"];
    $cuaddr = $row["es_addr"];
    $cusub = $row["es_sub"];
    $custate = $row["es_state"];
    $cupc = $row["es_pc"];
    $qtype = $row["es_type"];
    $quser = $row["es_user"];
        $d2 = strtotime($row["es_expdate"]);
    $edate = date("d/m/Y", $d2);
    $d1 = strtotime($row["es_timestamp"]);
    $cdate = date("d/m/Y", $d1);
    }
$sql = "SELECT * FROM esln WHERE el_quote = $q AND el_site = $site_cd";
$result = $conn->query($sql);
    while($row = $result->fetch_assoc()) { 
  $sku[] = $row["el_sku"];
$desc[] = $row["el_desc"];
$qty[] = $row["el_qty"];
$netprice[] = $row["el_netprice"]/$row["el_per"];
$per[] = $row["el_per"];
$uom[] = $row["el_uom"];
    }

class PDF extends FPDF
{
    
// Page header
function Header()
{
    $path = $_SERVER['DOCUMENT_ROOT'].$GLOBALS['logoPath'];
    // Logo
    $this->Image($path,10,6,50);
    $this->SetFont('Arial','B',14);
    $this->Cell(0,30,$GLOBALS['sitenm']); 
     $this->Ln(0);
     $this->SetFont('Arial','B',10);
    $this->Cell(0,40,$GLOBALS['addr']); 
    $this->Ln(5);
    $this->Cell(0,40,"$GLOBALS[sub] $GLOBALS[state] $GLOBALS[pc]"); 
    $this->Ln(5);
    $this->Cell(0,40,"ABN: $GLOBALS[abn]"); 
    // Title
    $this->SetFont('Arial','B',20);
    $this->Cell(0,-10,"Quotation $GLOBALS[quote]-$GLOBALS[qsite]",'C',0,'R');
    $this->Ln(5);
    $this->SetFont('Arial','B',10);
    $this->SetX("120");
    $this->MultiCell(0,7," Customer: $GLOBALS[cust]\r\n $GLOBALS[cuname]\r\n $GLOBALS[cuaddr], $GLOBALS[cusub] $GLOBALS[custate] $GLOBALS[cupc]",1, "L");
    $this->SetY("50");
     $this->SetFont('Arial','',10);
    $this->Cell(0,10,"Quote Type: $GLOBALS[qtype]     Sales Person: $GLOBALS[quser]     Date Created: $GLOBALS[cdate]     Expiry Date: $GLOBALS[edate]", 1, 0, "C");
    // Line break
    $this->Ln(20);
    //Quotation Lines
     $this->SetFont('Arial','B',10);
    $this->Cell(0,10,"Product Code         Description          QTY          Unit Price          Per          UOM          Extended Value", 1, 0, "C");
    $this->Ln(10);
    for($i = 0; $i < 5; $i ++) {
    $sku = $GLOBALS[sku][$i];
    $desc = $GLOBALS[desc][$i];
    $qty = $GLOBALS[qty][$i];
    $price = $GLOBALS[netprice][$i];
    $per = $GLOBALS[per][$i];
    $uom = $GLOBALS[uom][$i];
 $this->Cell(0,10,"$sku $desc $qty $price $per $uom                     ", 1, 0, "R");
        $this->Ln(10);
}}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'R');
    
}
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
#for($i=1;$i<=40;$i++)
 #   $pdf->Cell(0,10,'Printing line number '.$i,0,1);
$pdf->Output();
    
?>