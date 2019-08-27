<?php  

echo "<h1>Hola Mundo</h1>";

//tipo string
$nombre = "Javier";
echo $nombre;

$numero = 70190260;
echo $numero;

echo "<br>";


//tipo numero, concatenacion
$numero1 = "5";
$numero2 = 5;
echo $numero1.$numero2;

echo "<br>";
//Tipo booleano
$booleanV = true;
$booleanF = false;
echo $booleanV;
echo $booleanF;


echo "<br>";
//Tipo Float
$numero3 = 6.96;
echo "Cambio de Dolar a Bs = ".$numero3;

echo "<br>";
var_dump($numero3);

echo "<br>";
//Arrays         0			1		2
$datos = array("html","javaScript","PHP");
echo $datos[1];

foreach ($datos as $key => $value) {
	echo "<br>";
	echo $value;
}
echo "<br>";

foreach ($datos as $key => $value) {
	echo "<br>";
	echo $datos[$key];
}

echo "<br>";

//Arrays relaciones
$informacion = array(
	'nombre' => "Javier",
	'direccion' => "Cota Cota",
	'telefono' => 70190260);

echo "<br>";
echo $informacion['direccion'];

echo "<br>";
echo "<pre>";
print_r($informacion);
echo "</pre>";

echo "<br>";


//Array Multidensional
$alumnos[0] = array(
	'nombre' => "alumno1",
	'materias' => array("html", "javascript", "php", "bootstrap"));
$alumnos[1] = array(
	'nombre' => "alumno2",
	'materias' => array("Wordpress", "Joomla"));

echo "<br>";
echo "<pre>";
print_r($alumnos);
echo "</pre>";


echo "<br>";
$alumnos['alumno1'] = array(
	'materias' => array("html", "javascript", "php", "bootstrap"));
$alumnos['alumno2'] = array(
	'materias' => array("Wordpress", "Joomla"));

echo "<pre>";
print_r($alumnos);
echo "</pre>";

?>