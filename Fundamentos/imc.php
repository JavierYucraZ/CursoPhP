<?php  

$IMC = 0;

if (isset($_POST['peso'])
	&& isset($_POST['altura'])
	&& is_numeric($_POST['peso'])
	&& is_numeric($_POST['altura'])) {

$peso = $_POST['peso'];
$altura = $_POST['altura'];
$IMC = $peso/pow($altura, 2);

}else{
	echo "Ingrese datos validos";
}

$color = "";
$resultado = "";
if ($IMC<15) {
	$resultado = "Delgadez muy severa";
	$color = "red";
}elseif ($IMC>15 && $IMC<15.9) {
	$resultado = "Delgadez severa";
	$color = "orange";
}elseif ($IMC>16 && $IMC<18.4) {
	$resultado = "Delgadez";
	$color = "yellow";
}elseif ($IMC>18.5 && $IMC<24.9) {
	$resultado = "Peso saludable";
	$color = "green";
}elseif ($IMC>25 && $IMC<29.9) {
	$resultado = "Sobrepeso";
	$color = "yellow";
}elseif ($IMC>30 && $IMC<34.9) {
	$resultado = "Obesidad Moderada";
	$color = "orange";
}elseif ($IMC>35 && $IMC<39.9) {
	$resultado = "Obesidad severa";
	$color = "red";
}elseif ($IMC>40) {
	$resultado = "Obesidad morbida";
	$color = "darkred";
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Indice de Masa corporal</title>
</head>
<body>

	<h2>Calcula tu IMC</h2>
	<form action="imc.php" method="POST">
		<label for="peso">Ingrese su peso</label>
		<br>
		<input type="number" step="0.01" name="peso" placeholder="Ingrese su peso en Kg" required>
		<br>
		<label for="altura">Ingrese su altura</label>
		<br>
		<input type="number" step="0.01" name="altura" placeholder="Ingrese su altura en metros" required>
		<br>
		<input type="submit" value="Calcular">
	</form>

	<?php  
		if (isset($IMC)) {
	?>
	
	<?php  echo "Tu I.M.C es : ".round($IMC,2);?>

	<br><br>
	<div style="
	background: <?php echo $color ?>;
	color: white;
	text-align: center;">
		Resultado : <?php echo $resultado; ?>
	</div>

	<?php } ?>

</body>
</html>