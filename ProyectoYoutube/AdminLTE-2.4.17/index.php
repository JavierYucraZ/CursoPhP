<?php
session_start();  

$_SESSION['autorizado'] = false;

$localhost = "localhost";
$usuario = "root";
$pass = "";
$DB = "clontube";

$mensaje = "";
$email = "";
$password = "";

if (isset($_POST['email']) && isset($_POST['password'])) {
  
  if ($_POST['email'] == "") {
    $mensaje .= "Debe ingresar su email <br>";  
  }elseif ($_POST['password'] == "") {
    $mensaje .= "Debe ingresar su clave <br>";
  }else{

    $email = strip_tags($_POST['email']);
    $password = strip_tags($_POST['password']);
    $password = sha1($password);
    $password = md5($password);

    /*$pass1 = substr($password, 0,10);*/
    $conexion = mysqli_connect($localhost, $usuario, $pass, $DB);
    if (!$conexion) {
      echo "Error de conexion con la base de datos";
      die();
    }

    /*Verificando si el usuario existe y su contraseña es correcta*/
    $comparacion_consulta = 
    "SELECT * FROM `usuarios` WHERE `usuarios_email` = '".$email."' AND `usuarios_password` = '".$password."' ";

    $traduccion_comparacion_consulta = 
    mysqli_query($conexion, $comparacion_consulta);

    $usuarios_asociativo = mysqli_fetch_all($traduccion_comparacion_consulta, MYSQLI_ASSOC);

    /*  
    echo "<pre>";
    print_r($usuarios_asociativo);
    die();
    */

    $conteo_usuarios = count($usuarios_asociativo);
    

    if ($conteo_usuarios == 1) {
      
      /*Atrapando informacion del usuario*/
      $_SESSION['usuarios_ID'] = $usuarios_asociativo[0]['usuarios_ID'];
      $_SESSION['usuarios_email'] = $usuarios_asociativo[0]['usuarios_email'];
      $_SESSION['usuarios_ultimo'] = $usuarios_asociativo[0]['usuarios_ultimo_login'];
      $hoy = date("Y-m-d H:i:s");

      $actualizar_ultimo_login = 
      "UPDATE `usuarios` SET `usuarios_ultimo_login` = '".$hoy."' WHERE `usuarios_email` = '".$email."' ";

      $traduccion_actualizar = mysqli_query($conexion, $actualizar_ultimo_login);
      $mensaje = "Datos validos..";
      $_SESSION['autorizado'] = true;
      echo "<meta http-equiv='Refresh' content='2;url=principal.php'>";
    }else{
      $mensaje = "Credenciales invalidas";
      $_SESSION['autrizado'] = false;
    }
  }

}


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>clonTUBE | Inicio de Sesion</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <b>clon</b>TUBE
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Inicia sesion aqui!</p>

    <form action="index.php" method="post">
      <div class="form-group has-feedback">
        <input name="email" type="email" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input name="password" type="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>

            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Iniciar</button>
        </div>
        <!-- /.col -->
      </div>
      <div style="color: red;">
        <?php echo $mensaje; ?>
      </div>
    </form>

    <a href="#">Olvide mi contrase&ntilde;a</a><br>
    <a href="register.php" class="text-center">Registrar nueva cuenta</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
