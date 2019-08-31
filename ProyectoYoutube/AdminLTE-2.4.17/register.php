<?php

$localhost = "localhost";
$usuario = "root";
$pass = "";
$DB = "clontube";  

$mensaje = "";

$email = "";
$password = "";
$password2 = "";

if (isset($_POST['email'])
    && isset($_POST['password'])
    && isset($_POST['password2'])
    && isset($_POST['acepta'])) {
  
  if ($_POST['email'] == "") {
    $mensaje .= "Debe ingresar su correo electronico <br>";
  }

  if ($_POST['password'] == "") {
    $mensaje .= "Debe ingresar su clave <br>";
  }

  if ($_POST['password2'] == "") {
    $mensaje .= "Debe repetir su clave <br>";
  }

  $email = strip_tags($_POST['email']);
  $password = strip_tags($_POST['password']);
  $password2 = strip_tags($_POST['password2']);

  if ($password != $password2) {
    $mensaje .= "Las claves no coinciden <br>";
  }elseif (strlen($password) <= 8) {
    $mensaje .= "La clave debe ser mayor a 8 caracteres";
  }else{
    
    /*conexion a la base de datos*/
    $conexion = mysqli_connect($localhost, $usuario, $pass, $DB);
    if (!$conexion) {
      echo "Hubo un problema al conectar la base de datos";
      die();
    }
    /********************************/

    $ip = $_SERVER['REMOTE_ADDR'];

    /*Consulta de email unico*/
    $validacion_email_consulta = "SELECT * FROM `usuarios` WHERE `usuarios_email` = '".$email."' ";
    $traduccion_consulta = mysqli_query($conexion, $validacion_email_consulta);
    $usuarios_asociativo = mysqli_fetch_all($traduccion_consulta, MYSQLI_ASSOC);
    /**************************/

    /*
    echo "<pre>";
    print_r($usuarios_asociativo);}
    die();
    */
    
    /*Un email sera unico si el conteo de los registros con dicho email es 0*/
    $conteo_usuarios_email = count($usuarios_asociativo);
    if ($conteo_usuarios_email == 0) {
      /*Codificacion de password en sha1 y md5*/
      $password = sha1($password);
      $password = md5($password);
      /***************************************/

      /*Consulta para ingresar toda la informacion de nuestro formulario*/
      $ingreso_datos_consulta = "INSERT INTO `usuarios` (`usuarios_email`, `usuarios_password`, `usuarios_ip`) VALUES ('".$email."','".$password."','".$ip."')";
      mysqli_query($conexion, $ingreso_datos_consulta);
      $mensaje = "Datos ingresado satisfactoriamente";
      /******************************************************************/
    }else{
      $mensaje = "El email ya esta en uso";
    }
  }    
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Registration Page</title>
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
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="index2.html"><b>clon</b>TUBE</a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Registrar nuevo usuario</p>

    <form action="register.php" method="post">
      <div class="form-group has-feedback">
        <input name="email" type="email" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input name="password" type="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input name="password2" type="password" class="form-control" placeholder="Retype password">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="acepta" required> He leido y acepto los <a href="#">terminos</a>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Registro</button>
        </div>
        <!-- /.col -->
      </div>
      <div style="color: red;">
        <?php echo $mensaje; ?>
      </div>
    </form>


    <a href="login.php" class="text-center">Ya tengo una cuenta..</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

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
