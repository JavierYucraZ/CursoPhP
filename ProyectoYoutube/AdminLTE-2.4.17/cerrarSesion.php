<?php
session_start();

unset($_SESSION['autorizado']);
unset($_SESSION['usuarios_ID']);
unset($_SESSION['usuarios_email']);
unset($_SESSION['usuarios_ultimo']);

session_destroy();
echo "<meta http-equiv='Refresh' content='3;url=index.php'>";

?>

<!DOCTYPE html>
<html>
<head>
	<title>Hasta luego...</title>
</head>
<body>
<h1>..Vuelve cuando puedas..</h1>
</body>
</html>
