<?php
session_start();
require_once "config/conexion_clientes.php"; 
require 'vendor/autoload.php'; 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function generarContrasena($longitud = 10) {
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $contrasena = '';
    for ($i = 0; $i < $longitud; $i++) {
        $contrasena .= $caracteres[rand(0, strlen($caracteres) - 1)];
    }
    return $contrasena;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
     // Verificar CAPTCHA
     $recaptcha_secret = "6Lcw_Z4qAAAAAAtkCyTBkN2SzUnsrLBXpNYvzjgj";  //6Lcw_Z4qAAAAAAtkCyTBkN2SzUnsrLBXpNYvzjgj
     $response = $_POST['g-recaptcha-response'];
     $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$recaptcha_secret}&response={$response}");
     $captcha_success = json_decode($verify);
     if (!$captcha_success->success) {
         echo "<script>alert('Por favor complete el captcha');</script>";
         return;
     }

    $usuario = $_POST["usuario"];
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $clave = generarContrasena(); 
    $hashed_password = password_hash($clave, PASSWORD_DEFAULT); 
    $verification_code = md5(uniqid("tu_cadena_aleatoria", true));

   
    $checkUserSQL = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
    $checkResult = mysqli_query($conexion, $checkUserSQL);
    if (mysqli_num_rows($checkResult) > 0) {
        echo "<script>alert('El nombre de usuario ya está en uso. Por favor, elige otro.');</script>";
    } else {
        
        $instruccion_SQL = "INSERT INTO usuarios (usuario, nombre, email, clave, verification_code, is_verified) VALUES ('$usuario', '$nombre', '$email', '$hashed_password', '$verification_code', 0)";
        $resultado = mysqli_query($conexion, $instruccion_SQL);
        if ($resultado) {
           
            $mail = new PHPMailer(true);
            try {
               
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; 
                $mail->SMTPAuth = true;
                $mail->Username = 'gamersergio35@gmail.com'; 
                $mail->Password = 'dbio ggjy jwcy uhlf';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                
                $mail->setFrom('gamersergio35@gmail.com', 'Sergio');
                $mail->addAddress($email); 

                
                $mail->isHTML(true);
                $mail->Subject = 'Verificación de Correo Electrónico';
                $mail->Body = "Tu contraseña es: " . $clave . "<br>Haz clic en el siguiente enlace para verificar tu correo:<br><a href='http://localhost/modi/verify.php?code=$verification_code'>Verificar</a>";
                $mail->send();
                echo 'El correo ha sido enviado';
            } catch (Exception $e) {
                echo "El correo no pudo ser enviado. Error: {$mail->ErrorInfo}";
            }
        } else {
            echo "<script>alert('Error en el registro');</script>";
        }
    }
}
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
  <script src="https://www.google.com/recaptcha/api.js"></script>
  
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
    <input type="text" class="form-control" id="usuario" name="usuario" pattern="[A-Za-z]+" title="Solo se permiten letras." required>
</div>
<div class="form-group">
    <label for="nombre">Nombre:</label>
    <input type="text" class="form-control" id="nombre" name="nombre" pattern="[A-Za-z\s]+" title="Solo se permiten letras y espacios." required>
</div>
              <div class="form-group">
                  <label for="email">Correo Electrónico:</label>
                  <input type="email" class="form-control" id="email" name="email" required>
              </div>
              <div class="form-group">
    <label for="clave">Contraseña:</label>
    <input type="text" class="form-control" id="clave" name="clave" value="<?php echo generarContrasena(); ?>" readonly>
</div>
<div class="form-group">
    
    <div class="g-recaptcha" data-sitekey="6Lcw_Z4qAAAAAH30S4PfUmLK2nhMfzOPlUp5OxoR"></div>  <!--6Lcw_Z4qAAAAAH30S4PfUmLK2nhMfzOPlUp5OxoR -->
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
</body>
</html>