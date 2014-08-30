<?php 
$pdf = new Vendor\FPDF\FPDF('P', 'mm', 'A4');
$pdf->SetTitle('Arial', true);
$pdf->SetFont('Arial', 'B', 12);
$pdf->AddPage();
$pdf->Cell(80, 10, utf8_decode('Domínio'));
$pdf->Cell(80, 10, utf8_decode('Situação'));
$pdf->Ln();
$pdf->SetFont('Arial', '', 10);
foreach($domains as $domain){
    $last_payment = empty($domain->last_payment) ? $domain->cdate : $domain->last_payment; 
    $pdf->Cell(80, 10, $domain->domain);
     if(!$domain->free){ 
        if(date('Y-m', strtotime('+31 days', strtotime($last_payment))) == date('Y-m')){ 
           $text = "Pago até " . date('m/Y', strtotime($last_payment));        
        }elseif(date('Y-m', strtotime('+31 days', strtotime($last_payment))) < date('Y-m')){ 
           $text = "Em aberto desde " . date('m/Y', strtotime($last_payment));                                    
        }else{ 
           $text = "Pago até " . date('m/Y', strtotime($last_payment));
        } 
     }else{ 
        $text = 'Dominio gratis (sem cobrança)';
     }
     $text = utf8_decode($text);
    $pdf->Cell(80, 10, $text);
    $pdf->Ln();
}
$pdf->Output();
?>