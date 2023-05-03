<?php
//define('FPDF_FONTPATH','/font');
include('../model/conexion.php');
require('../fpdf/fpdf.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',14,'UTF-8');
$pdf->SetFillColor(255,255,255);
$pdf->Rect(0,0,210,297,'F');
$pdf->Cell(0,5,utf8_decode('FUNDACIÓN PINITA MÁS QUE SONRISAS'),0,1,'C');
$pdf->Cell(0,6,utf8_decode('Reporte de Beneficiarios'),0,1,'C');
$pdf->Image('../images/logotipo-pinita.png', 10, 10, 30, 20);
$consulta = $bd->query("SELECT nombre,telefono,domicilio FROM usuarios WHERE perfil = 'beneficiario';");
$aportaciones = $consulta->fetchAll(PDO::FETCH_OBJ);
$pdf->Ln(15);
$pdf->SetFont('Arial','B',10,'UTF-8');
$pdf->Cell(60,10,utf8_decode('NOMBRE'),1,0,'L',true);
$pdf->Cell(60,10,utf8_decode('TELEFONO'),1,0,'L');
$pdf->Cell(80,10,utf8_decode('DOMICILIO'),1,0,'L');
$pdf->Ln(10);

foreach ($aportaciones as $dato){
    $benefactor = $dato->nombre;
    $telefono = $dato->telefono;
    $domicilio = $dato->domicilio;
    $pdf->Ln(5);
    $pdf->SetFont('Arial','',8,'UTF-8');
    $pdf->Cell(60,10,utf8_decode(''.$benefactor),0,0,'L');
    $pdf->Cell(60,10,utf8_decode(''.$telefono),0,0,'L');
    $pdf->Cell(80,10,utf8_decode(''.$domicilio),0,0,'L');


    


}
$pdf->Output('beneficiarios.pdf','I');

?>