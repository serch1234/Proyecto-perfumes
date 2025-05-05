<?php
session_start();
require_once "config/conexion.php";

$data = json_decode(file_get_contents('php://input'), true);
$producto_id = $data['producto_id'];
$user_id = $_SESSION['user_id'];

$query = mysqli_query($conexion, "DELETE FROM productos_favoritos 
    WHERE user_id = '$user_id' AND producto_id = '$producto_id'");

echo json_encode(['success' => $query ? true : false]);
?>


