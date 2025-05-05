<?php
$host = "localhost";
$user = "root";
$clave = "";
$bd = "clientes";
$conexion = mysqli_connect($host, $user, $clave, $bd);
if (mysqli_connect_errno()) {
    echo "No se pudo conectar a la base de datos";
    exit();
}
mysqli_set_charset($conexion, "utf8");
?>