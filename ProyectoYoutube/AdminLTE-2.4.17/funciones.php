<?php 

$conexion = mysqli_connect("localhost", "root", "", "clontube");
if (!$conexion) {
	echo "Problema al conectar con la base de datos";
	die();
}

function grabar_imagen($archivo){
	$conexion = $GLOBALS['conexion'];

	$msj = "";
	$directorio = "imagenes/";
	/* nombre_de_imagen = BIcletA.png 
	imagenes/nombre_de_imagen */
	$nombre_imagen = $directorio.basename($archivo["nombre_archivo"]["name"]);
	$cargaOK = 1;
	$tipo_de_archivo = strtolower(pathinfo($nombre_imagen, PATHINFO_EXTENSION));

	if (file_exists($nombre_imagen)) {
		$msj .= "El archivo ya existe <br>";
		$cargaOK = 0;
	}

	if ($archivo["nombre_archivo"]["size"] > 5000000) {
		$msj .= "Imagen demasiado grande <br>";
		$cargaOK = 0;
	}

	if ($tipo_de_archivo != "jpg" && $tipo_de_archivo != "jpeg" && $tipo_de_archivo != "gif" && $tipo_de_archivo != "png") {
		$msj .= "Tipo de archivo no permitido <br>";
		$cargaOK = 0;
	}

	if ($cargaOK == 0) {
		$msj .= "La imagen no se pudo subir <br>";
	}else{
		if (move_uploaded_file($archivo["nombre_archivo"]["tmp_name"], $nombre_imagen)) {
			$msj .= 
			"La imagen ".basename($archivo["nombre_archivo"]["name"])." ha sido subida";
			mysqli_query($conexion, "UPDATE `usuarios` SET `usuarios_imagen` = '".$nombre_imagen."' WHERE `usuarios_id` = '".$_SESSION['usuarios_ID']."' ");
		}else{
			$msj .= "Hubo un error al momento escribir en disco <br>";
		}
	}

	return $msj;
}

function obtener_imagen_usuario(){
	$conexion = $GLOBALS['conexion'];
	$resultado = mysqli_query($conexion, "SELECT `usuarios_imagen` FROM `usuarios` WHERE `usuarios_ID` = '".$_SESSION['usuarios_ID']."' ");
	$fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
	$ruta = $fila['usuarios_imagen'];
	return $ruta;
}

?>