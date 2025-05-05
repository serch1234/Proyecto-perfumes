<?php
session_start();
require_once "config/conexion.php"; 

$data = json_decode(file_get_contents('php://input'), true);
$producto_id = $data['producto_id'];
$user_id = $_SESSION['user_id']; 


$queryCheck = mysqli_query($conexion, "SELECT * FROM productos_favoritos WHERE user_id = '$user_id' AND producto_id = '$producto_id'");
if (mysqli_num_rows($queryCheck) > 0) {
    echo json_encode(['success' => false, 'message' => 'Este producto ya está en tus favoritos.']);
    exit();
}


$query = mysqli_query($conexion, "INSERT INTO productos_favoritos (user_id, producto_id) VALUES ('$user_id', '$producto_id')");

if ($query) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>