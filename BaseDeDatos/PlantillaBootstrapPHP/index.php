<?php  

$localhost = "localhost";
$usuario = "root";
$password = "";
$DB = "imc";

/*mysql => para version 4.3 */
$conexion = mysqli_connect($localhost, $usuario, $password, $DB);

if (!$conexion) {
  echo "Ocurrio un problema al conectar con la base de datos";
  die();
}

$IMC = null;
$peso = null;
$altura = null;

if (isset($_POST['peso'])
  && isset($_POST['altura'])
  && is_numeric($_POST['peso'])
  && is_numeric($_POST['altura'])) {

  $peso = $_POST['peso'];
  $altura = $_POST['altura'];
  $IMC = $peso/pow($altura, 2);
}

$consulta = "
INSERT INTO `informacion` (`info_Peso`, `info_Altura`, `info_IMC`) 
VALUES ('".$peso."', '".$altura."', '".$IMC."')";
mysqli_query($conexion, $consulta);


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

/*Estadisticas*/
$consulta_estadisticas = "SELECT AVG(`info_IMC`) AS 'imc_promedio', AVG(`info_Peso`) AS 'peso_promedio', AVG(`info_Altura`) AS 'altura_promedio', MAX(`info_Peso`) AS 'peso_maximo', COUNT(*) AS 'cantidad_usuarios' FROM `informacion` WHERE 1";
$consulta = mysqli_query($conexion, $consulta_estadisticas);
$fila = mysqli_fetch_array($consulta, MYSQLI_ASSOC);


/*
echo "<pre>";
print_r($fila);
die();
*/

$peso_promedio = round($fila['peso_promedio'],2);
$altura_promedio = round($fila['altura_promedio'],2);
$imc_promedio = round($fila['imc_promedio'],2);
$peso_maximo = $fila['peso_maximo'];
$cantidad_usuarios = $fila['cantidad_usuarios'];

/*Consulta para toda la tabla*/
$consulta_global = "SELECT * FROM `informacion`";
$consulta = mysqli_query($conexion, $consulta_global);
$tabla = mysqli_fetch_all($consulta, MYSQLI_ASSOC);

/*
mysql = -4.3
mysqli = +4.4
*/

mysqli_close($conexion);

?>



<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Scrolling Nav - Start Bootstrap Template</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/scrolling-nav.css" rel="stylesheet">

  <link rel="stylesheet" href="css/misEstilos.css">

</head>

<body id="page-top">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">
        Indice de Masa Corporal
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#about">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#services">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#contact">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <header class="bg-primary text-white">
    <div class="container text-center titulo">
      <h1>Indice de Masa Corporal</h1>
      <p class="lead">A landing page template freshly redesigned for Bootstrap 4</p>
    </div>
  </header>

  <section id="about">
    <div class="container">
      <div class="row">
        <div class="col-lg-10 mx-auto">
          <h2>¿Qué es el indice de masa Corporal?</h2>
          <p class="lead">
            El índice de masa corporal (IMC) es un método utilizado para estimar la cantidad de grasa corporal que tiene una persona, y determinar por tanto si el peso está dentro del rango normal, o por el contrario, se tiene sobrepeso o delgadez. Para ello, se pone en relación la estatura y el peso actual del individuo. Esta fórmula matemática fue ideada por el estadístico belga Adolphe Quetelet, por lo que también se conoce como índice de Quetelet o Body Mass Index (BMI).</p>
          <p class="lead">
            Actualmente, esta fórmula está cayendo en desuso porque se está viendo que el IMC no hace diferencia entre la grasa corporal y la muscular, lo que hace que no sea muy exacto. “Un deportista o un culturista van a tener siempre un sobrepeso si tenemos en cuenta su peso respecto a la altura, pero no tienen los problemas de salud que tiene una persona obesa. Esta última tiene problemas debido a la cantidad de grasa que tienen, no por el peso”, explica Carmen Escalada, nutricionista del Instituto Médico Europeo de la Obesidad (IMEO). La cantidad de grasa marca mejor nuestro estado de salud.
          </p>
        </div>
          <img src="imagenes/IMC.jpg" alt="">
      </div>
    </div>
  </section>

  <section id="services" class="bg-light">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <h2>Calcula tu IMC</h2>
            <form action="index.php" method="POST">
              <div class="form-group">
                <label for="peso" class="lead">Ingrese su peso</label>
                <input type="number" step="0.01" name="peso" placeholder="Ingrese su peso en Kg" required class="form-control"> 
              </div>
              <div class="form-group">
                <label for="altura" class="lead">Ingrese su altura</label>
                <input type="number" step="0.01" name="altura" placeholder="Ingrese su altura en metros" required class="form-control">  
              </div>
              <input class="btn btn-success" type="submit" value="Calcular">
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


        </div>
      </div>
    </div>
  </section>

  <section id="contact">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <h2>Estadisticas</h2>
          <ul class="lead">
            <li>Peso Promedio : <?php echo $peso_promedio; ?></li>
            <li>Altura Promedio : <?php echo $altura_promedio; ?></li>
            <li>IMC Promedio : <?php echo $imc_promedio; ?></li>
            <li>Peso Maximo : <?php echo $peso_maximo; ?></li>
            <li>Cantidad de usuarios : <?php echo $cantidad_usuarios; ?></li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <section id="contact">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <h2>Datos Globales</h2>
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Fecha De Registro</th>
                <th scope="col">Peso</th>
                <th scope="col">Altura</th>
                <th scope="col">I.M.C.</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($tabla as $fila) {?>
              <tr>
                <th scope="row"><?php echo $fila['info_ID']; ?></th>
                <td><?php echo $fila['info_Fecha']; ?></td>
                <td><?php echo $fila['info_Peso']; ?></td>
                <td><?php echo $fila['info_Altura']; ?></td>
                <td><?php echo $fila['info_IMC']; ?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">
      Copyright &copy; Your Website 2019</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom JavaScript for this theme -->
  <script src="js/scrolling-nav.js"></script>

</body>

</html>
