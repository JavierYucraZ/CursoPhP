<?php 

$conexion = mysqli_connect("localhost", "root", "", "clontube");
if (!$conexion) {
	echo "Problema al conectar con la base de datos";
	die();
}

function obtener_video(){
	$conexion = $GLOBALS['conexion'];
	$resultado = mysqli_query($conexion, "SELECT * FROM `usuarios_y_videos` WHERE 1");
	$video = mysqli_fetch_all($resultado, MYSQLI_ASSOC);	
	return $video;
}

function grabar_video($archivo){
	$conexion = $GLOBALS['conexion'];

	$msj = "";
	$directorio = "video/";
	/* nombre_de_imagen = BIcletA.png 
	imagenes/nombre_de_imagen */
	$nombre_video = $directorio.basename($archivo["nombre_archivo"]["name"]);
	$cargaOK = 1;
	$tipo_de_archivo = strtolower(pathinfo($nombre_video, PATHINFO_EXTENSION));

	if (file_exists($nombre_video)) {
		$msj .= "El archivo ya existe <br>";
		$cargaOK = 0;
	}


	if ($archivo["nombre_archivo"]["size"] > 50000000) {
		$msj .= "Video demasiado grande <br>";
		$cargaOK = 0;
	}

	if ($tipo_de_archivo != "mp4") {
		$msj .= "Tipo de archivo no permitido <br>";
		$cargaOK = 0;
	}

	if ($cargaOK == 0) {
		$msj .= "El video no se pudo publicar <br>";
	}else{
		if (move_uploaded_file($archivo["nombre_archivo"]["tmp_name"], $nombre_video)) {
			$msj .= 
			"La imagen ".basename($archivo["nombre_archivo"]["name"])." ha sido subida";
			mysqli_query($conexion, "INSERT INTO `videos` (`videos_url`, `videos_usuarios_ID`) VALUES ('".$nombre_video."', '".$_SESSION['usuarios_ID']."')");
		}else{
			$msj .= "Hubo un error al momento escribir en disco <br>";
		}
	}

	return $msj;

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

/*
upload_max_filesize = 50M
post_max_size = 50M
*/

?>