<?php
session_start();
require_once "config/conexion.php"; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $producto_id = $_POST['producto_id'];
    $user_id = $_SESSION['user_id']; 
    $calificacion = $_POST['calificacion'];
    $comentario = $_POST['comentario'];

   
    $query = mysqli_query($conexion, "INSERT INTO reseñas (producto_id, user_id, calificacion, comentario) VALUES ('$producto_id', '$user_id', '$calificacion', '$comentario')");
    
    if ($query) {
       
        header('Location: productos.php'); 
        exit();
    } else {
        
        echo "Error al agregar la reseña.";
    }
}
?>