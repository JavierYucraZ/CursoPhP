<?php  

require('fpdf/fpdf.php');
/*Creamos una instancia de la clase FPDF*/
$pdf = new FPDF();
/*Crear una pagina del documento en pdf*/
$pdf->AddPage();
/*Asignamos el tipo de fuente, estilo y tamaño*/
$pdf->SetFont('Arial', 'B', 16);
/*Asignamos formato, ancho, altura, texto*/
$pdf->Cell(40,10, utf8_decode('¡Hola mundo!'));
/*Mostramos el documento*/
$pdf->OutPut();

?>