<?php
//define('FPDF_FONTPATH','/font');
include('../model/conexion.php');
require('../fpdf/fpdf.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$pdf = new FPDF();
$pdf->AddPage('L');
$pdf->SetFont('Arial','B',14,'UTF-8');
$pdf->SetFillColor(255,255,255);
$pdf->Rect(0,0,210,297,'F');
$pdf->Cell(0,5,utf8_decode('FUNDACIÓN PINITA MÁS QUE SONRISAS'),0,1,'C');
$pdf->Cell(0,6,utf8_decode('Reporte de Ingreso de aportaciones'),0,1,'C');
$pdf->Image('../images/logotipo-pinita.png', 10, 10, 30, 20);
$consulta = $bd->query("SELECT id_apoyo,fecha,id_usuario,tipo_apoyo,detalles,cantidad,divisa FROM reg_apoyos;");
$aportaciones = $consulta->fetchAll(PDO::FETCH_OBJ);
$pdf->Ln(15);
$pdf->SetFont('Arial','B',10,'UTF-8');
$pdf->Cell(30,10,utf8_decode('APORTACION'),1,0,'L',true);
$pdf->Cell(30,10,utf8_decode('FECHA'),1,0,'L');
$pdf->Cell(30,10,utf8_decode('BENEFACTOR'),1,0,'L');
$pdf->Cell(30,10,utf8_decode('TIPO'),1,0,'L');
$pdf->Cell(80,10,utf8_decode('DETALLES'),1,0,'L');
$pdf->Cell(30,10,utf8_decode('CANTIDAD'),1,0,'L');
$pdf->Cell(30,10,utf8_decode('MONEDA'),1,0,'L');
$pdf->Ln(10);

foreach ($aportaciones as $dato){
    $aportacion = $dato->id_apoyo;
    $fecha = $dato->fecha;
    $benefactor = $dato->id_usuario;
    $tipo = $dato->tipo_apoyo;
    $detalles = $dato->detalles;
    $cantidad = $dato->cantidad;
    $moneda = $dato->divisa;

    $pdf->Ln(5);
    $pdf->SetFont('Arial','',8,'UTF-8');
    $pdf->Cell(30,10,utf8_decode(''.$aportacion),0,0,'L');
    $pdf->Cell(30,10,utf8_decode(''.$fecha),0,0,'L');
    $pdf->Cell(30,10,utf8_decode(''.$benefactor),0,0,'L');
    $pdf->Cell(30,10,utf8_decode(''.$tipo),0,0,'L');
    $pdf->Cell(80,10,utf8_decode(''.$detalles),0,0,'L');
    $pdf->Cell(30,10,utf8_decode(''.$cantidad),0,0,'L');
    $pdf->Cell(30,10,utf8_decode(''.$moneda),0,0,'L');



    


}
$pdf->Output('aportaciones.pdf','I');

?>