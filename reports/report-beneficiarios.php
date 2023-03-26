<?php
define('FPDF_FONTPATH','../fpdf/fpdf.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
require('../fpdf/fpdf.php');
$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'¡Reporte de Beneficiarios!');
$pdf->Output();
?>