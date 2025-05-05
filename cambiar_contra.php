<?php
session_start(); 
require_once "config/conexion_clientes.php"; 

if (!isset($_SESSION['active'])) {
    header("Location: sesion_clientes.php"); 
    exit();
}

if (!isset($_SESSION['usuario'])) {
    die("Error: No se ha definido el usuario en la sesión.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_SESSION['usuario']; 
    $newPassword = $_POST['new_password']; 

    if ($conexion) {
        $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $updateStmt = $conexion->prepare("UPDATE usuarios SET clave = ? WHERE usuario = ?");
        $updateStmt->bind_param("ss", $hashedNewPassword, $usuario);
        if ($updateStmt->execute()) {
            echo "Contraseña cambiada con éxito.";
        } else {
            echo "Error al cambiar la contraseña.";
        }
    } else {
        die("Error: Conexión a la base de datos no establecida.");
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 400px;
            margin-top: 50px;
        }
        .form-control {
            margin-bottom: 15px;
        }
        .btn-primary {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="h4 text-center">Cambiar Contraseña</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="new_password">Nueva Contraseña:</label>
                <input type="password" id="new_password" name="new_password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Cambiar Contraseña</button>
        </form>
        <a href="index.php" class="btn btn-secondary mt-3">Regresar al Inicio</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>