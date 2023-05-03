<?php
include('../model/conexion.php');
require('../fpdf/fpdf.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$aportacion = $_GET['id'];
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',14,'UTF-8');
$pdf->SetFillColor(255,255,255);
$pdf->Rect(0,0,210,297,'F');
$pdf->Cell(0,5,utf8_decode('FUNDACIÓN PINITA MÁS QUE SONRISAS'),0,1,'C');
$pdf->Cell(0,6,utf8_decode('Comprobante de aportación'),0,1,'C');
$pdf->Image('../images/logotipo-pinita.png', 10, 10, 30, 20);


$consulta = $bd->query("SELECT * FROM reg_apoyos WHERE id_apoyo = $aportacion;");
$aportaciones = $consulta->fetchAll(PDO::FETCH_OBJ);
foreach ($aportaciones as $dato){
$benefact = $dato->id_usuario;
$pdf->Ln(10);
$pdf->SetFont('Arial','B',10,'UTF-8');
$pdf->Cell(35,20,utf8_decode('Aportación:'),0,0,'L');
$pdf->SetFont('Arial','',10,'UTF-8');
$pdf->Cell(30,20,utf8_decode(''.$aportacion),0,0,'L');
$pdf->SetFont('Arial','B',10,'UTF-8');
$pdf->Cell(70,20,utf8_decode('Fecha:'),0,0,'R');
$pdf->SetFont('Arial','',10,'UTF-8');
$pdf->Cell(30,20,utf8_decode(''.$dato->fecha),0,0,'R');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',10,'UTF-8');
$pdf->Cell(35,20,utf8_decode('Benefactor:'),0,0,'L');
$pdf->SetFont('Arial','',10,'UTF-8');
$pdf->Cell(30,20,utf8_decode(''.$dato->id_usuario),0,0,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',10,'UTF-8');
$pdf->Cell(35,20,utf8_decode('Nombre:'),0,0,'L');
$query = $bd->query("SELECT nombre FROM usuarios WHERE usuario = '$benefact';");
$benefactor = $query->fetchAll(PDO::FETCH_OBJ);

foreach ($benefactor as $datob){
$pdf->SetFont('Arial','',10,'UTF-8');
$pdf->Cell(30,20,utf8_decode(''.$datob->nombre),0,0,'L');
}

$pdf->Ln(5);
$pdf->SetFont('Arial','B',10,'UTF-8');
$pdf->Cell(35,20,utf8_decode('Tipo de apoyo:'),0,0,'L');
$pdf->SetFont('Arial','',10,'UTF-8');
$pdf->Cell(30,20,utf8_decode(''.$dato->tipo_apoyo),0,0,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',10,'UTF-8');
$pdf->Cell(35,20,utf8_decode('Detalles:'),0,0,'L');
$pdf->SetFont('Arial','',10,'UTF-8');
$pdf->Cell(100,20,utf8_decode(''.$dato->detalles),0,0,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',10,'UTF-8');
$pdf->Cell(35,20,utf8_decode('Programa destino:'),0,0,'L');
$pdf->SetFont('Arial','',10,'UTF-8');
$pdf->Cell(30,20,utf8_decode(''.$dato->id_programa),0,0,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',10,'UTF-8');
$pdf->Cell(35,20,utf8_decode('Cantidad:'),0,0,'L');
$pdf->SetFont('Arial','',10,'UTF-8');
$pdf->Cell(30,20,utf8_decode('$'.$dato->cantidad.'.00'),0,0,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',10,'UTF-8');
$pdf->Cell(35,20,utf8_decode('Moneda:'),0,0,'L');
$pdf->SetFont('Arial','',10,'UTF-8');
$pdf->Cell(30,20,utf8_decode(''.$dato->divisa),0,0,'L');
$pdf->Ln(30);
$pdf->Cell(0,20,utf8_decode('Sello y Firma'),0,0,'C');
$pdf->Ln(30);
$pdf->Line(10, $pdf->GetY(), $pdf->GetPageWidth()-10, $pdf->GetY());
$pdf->Cell(0,20,utf8_decode('Nuestra fundación agradece tu generosa aportación. ¡Muchas gracias!'),0,0,'C');
$pdf->Ln(4);
$pdf->SetFont('Arial','',8,'UTF-8');
$pdf->Cell(0,20,utf8_decode('www.fundacionpinita.org'),0,0,'C');
$pdf->Ln(4);
$pdf->Cell(0,20,utf8_decode('email: contacto@fundacionpinita.org'),0,0,'C');





}
// $aportaciones = $consulta->fetchAll(PDO::FETCH_OBJ);
// foreach ($aportaciones as $dato){}
$pdf->Output('aportacion.pdf','I');

?>