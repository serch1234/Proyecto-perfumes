<?php

$host = "localhost";
$user = "root";
$clave = "";
$conexion = mysqli_connect($host, $user, $clave);

if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
}

$datab = "card";
$db = mysqli_select_db($conexion, $datab);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $nombre = $_POST["nombre"];
    $clave = $_POST["clave"];
    
    $instruccion_SQL = "INSERT INTO usuarios (usuario, nombre, clave) VALUES ('$usuario','$nombre','$clave')";
    $resultado = mysqli_query($conexion, $instruccion_SQL);
}

$consulta = "SELECT * FROM usuarios";
$result = mysqli_query($conexion, $consulta);
mysqli_close($conexion);

?>

<html lang="es">
<head>
 
  <title>Registrodb</title>
  <link rel="stylesheet" href="./style3.css">

  <link rel="icon" type="image/x-icon" href="./assets/favicon.ico" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@1,300;1,400&display=swap" rel="stylesheet">
<link href="assets/css/styles.css" rel="stylesheet" />
<link href="assets/css/estilos.css" rel="stylesheet" />
<link rel="stylesheet" href="estilos2.css">
<link rel="stylesheet" href="./css/main.css">
<link rel="stylesheet" href="./css/footer.css">
<link rel="stylesheet" href="./css/hero.css">
<link rel="stylesheet" href="./css/navbar.css">

</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light" id="sesiontools">
    <a class="navbar-brand" href="index.php">
        <img src="./images/iconperfu.jpg" width="50" height="50" class="d-inline-block align-top" alt="perfumelogo">
        The Aroma Serg
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="./index.php">Inicio <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="./contact.html" onclick="showLoading('./contact.html')">Contacto</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Productos
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="./pages/products.html">hombres</a>
                    <a class="dropdown-item" href="./pages/products.html">mujeres</a>
                </div>
            </li>
            <li class="nav-item active">
        <a class="nav-link" href="./about.html">Nosotros</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="modificacionesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Accesibilidad
                </a>
                <div class="dropdown-menu" aria-labelledby="modificacionesDropdown">
                    <a class="dropdown-item" href="#" id="increase-font">Aumentar Tamaño de Letra</a>
                    <a class="dropdown-item" href="#" id="decrease-font">Disminuir Tamaño de Letra</a>
                    <a class="dropdown-item" href="#" id="toggle-contrast">Alternar Contraste</a>
                    <a class="dropdown-item" href="#" id="toggle-brightness">Ajustar Brillo</a> <!-- Nueva opción -->
                </div>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <ul class="nav-item active dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i id="icono" class="bi bi-person-circle"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="./admin/index.php">Inicia sesión</a>
                    <a class="dropdown-item" href="formBD.html">Registro</a>
                </div>
            </ul>
            <a href="#" class="nav-link" id="btnCarrito" onclick="showCart()">
    <i class="fas fa-shopping-cart"></i>
    <span class="badge bg-success" id="carrito">0</span>
</a>
        </form>
    </div>
</nav><!-- navbar responsiva -->

<div class="container d-flex justify-content-center">
    <div class="col-md-6 registration-box">
        <h1>Registro</h1>
        <form id="miFormulario" onsubmit="alert('Registro exitoso');" method="post" action="#">
            <div class="form-group">
                <label for="usuario">Usuario:</label>
                <input type="text" class="form-control" id="usuario" name="usuario" required>
            </div>
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" pattern="[A-Za-z\s]+" required>
            </div>
            <div class="form-group">
                <label for="clave">Password:</label>
                <input type="password" class="form-control" id="clave" name="clave" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Guardar</button>
        </form>
    </div>
</div>
<script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script src="//code.tidio.co/39joioxi3k5pf80kkre4jx93t3ubu7gu.js" async></script>


 </body>
</html>
