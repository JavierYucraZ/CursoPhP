<?php  

$envioPost = $_POST;

$num1 = $_POST['num1'];
$num2 = $_POST['num2'];

$resultado = $num1 + $num2;

echo $resultado;

echo "<pre>";
print_r($envioPost);
echo "</pre>";

?>