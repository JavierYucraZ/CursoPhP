<?php  

$destino = 'xavwlr@gmail.com';
$nombre = $_POST['nombre'];
$asunto = $_POST['asunto'];
$email = $_POST['email'];
$mensaje = $_POST['mensaje'];

$header = "Correo enviado por PHP";
$mensajeCompleto = $mensaje."\n Atentamente : ".$nombre;

mail($destino, $asunto, $mensajeCompleto, $header);
echo "<script>alert('Correo enviado exitosamente')</script>";
echo "<script>setTimeout(\"location.href='index.html'\")</script>";

?>