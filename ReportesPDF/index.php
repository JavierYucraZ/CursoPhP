<?php  

require('fpdf/fpdf.php');

class PDF extends FPDF
{
	function Header()
	{
		$this -> SetFont('Arial', 'BIU', 16);
		$this -> Cell(65);
		$this -> Cell(60, 10, 'Reporte de Productos', 0, 0, 'C');

		$this -> Ln(20);
		$this -> Cell(110, 10, utf8_decode('Nombre'),1,0,'C');
		$this -> Cell(40, 10, utf8_decode('Precio'),1,0,'C');
		$this -> Cell(40, 10, utf8_decode('Stock'),1, 1, 'C');
	}

	function Footer(){
		/*Posicion a 1.5cm del piso*/
		$this -> SetY(-15);
		$this -> SetFont('Arial', 'I', 8);
		$this -> Cell(0, 10, 'Pagina'.$this->PageNo().'/{nb}',0,0,'C');
	}
}

$conexion = mysqli_connect("localhost", "root", "", "productos");
if (!$conexion) {
	echo "No se pudo conectar a la base de datos";
	die();
}

$consulta = "SELECT * FROM `productos` WHERE 1";
$resultado = mysqli_query($conexion, $consulta);
$tabla = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

$pdf = new PDF();
/*Asignamos la paginacion al documento*/
$pdf -> AliasNbPages();
$pdf -> AddPage();

$pdf -> SetFont('Times', '', 16);

foreach ($tabla as $fila) {
	$pdf -> Cell(110, 10, utf8_decode($fila['productos_nombre']),1,0,'C');
	$pdf -> Cell(40, 10, utf8_decode($fila['productos_precio']),1,0,'C');
	$pdf -> Cell(40, 10, utf8_decode($fila['productos_stock']),1, 1, 'C');
}

$pdf -> OutPut();


?>