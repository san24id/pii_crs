<?php
class PDF extends FPDF
{

// Colored table
function FancyTable($header,$data)
{
    $this->Cell(30,10,'List Of All Risk',1,0,'L');
    $this->Ln(20);
    // Colors, line width and bold font
    $this->SetFillColor(255,0,0);
    $this->SetTextColor(255);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('','B');
    // Header
    $w = array(20, 20, 20, 20, 20, 20, 20, 20, 20, 20, 20, 20 ,20, 20);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],3,$header[$i],1,0,'C',true);
    $this->Ln();
    // Color and font restoration
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
    // Data
    $fill = false;
    foreach($data as $row)
    {
        $this->Cell($w[0],3,$row->cat_name,'LR',0,'L',$fill);
        // $this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
        // $this->Cell($w[2],6,number_format($row[2]),'LR',0,'R',$fill);
        // $this->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
        // $this->Ln();
        $fill = !$fill;
    }
    // Closing line
    $this->Cell(array_sum($w),0,'','T');
}
}

$pdf = new PDF();
// Column headings
$header = array('No', '2nd Sub Category', 'Risk Event', 'Risk Description','Risk Owner','Cause','Impact','Existing Control','Control Owner','Control Evaluation','Impact Level','Likelihood Level','Risk Level');
// Data loading
$pdf->SetFont('Arial','',6);
$pdf->AddPage();
$pdf->FancyTable($header,$data);
$pdf->Output();
?>