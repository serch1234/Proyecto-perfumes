<?php
require_once "config/conexion_clientes.php"; 

$verification_successful = false; 

if (isset($_GET['code'])) {
    $verification_code = $_GET['code'];
    
    $query = mysqli_query($conexion, "SELECT * FROM usuarios WHERE verification_code = '$verification_code'");
    
    if (mysqli_num_rows($query) > 0) {
       
        mysqli_query($conexion, "UPDATE usuarios SET is_verified = 1 WHERE verification_code = '$verification_code'");
        $verification_successful = true; 
    } else {
        echo "Código de verificación inválido.";
    }
} else {
    echo "No se proporcionó ningún código de verificación.";
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Verificación de Cuenta</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Verificación de Cuenta</h1>
        <div class="text-center">
            <?php if ($verification_successful): ?>
                <div class="alert alert-success" role="alert">
                    Tu cuenta ha sido verificada correctamente. Ahora puedes iniciar sesión.
                </div>
                <a href="sesion_clientes.php" class="btn btn-primary">Iniciar Sesión</a>
            <?php else: ?>
                <div class="alert alert-danger" role="alert">
                    La verificación ha fallado. Por favor, intenta nuevamente.
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>