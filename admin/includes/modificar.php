<?php
require_once "../config/conexion.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($conexion, "SELECT * FROM usuarios WHERE id='$id'");
    $data = mysqli_fetch_assoc($query);
}

if (isset($_POST['update'])) {
    $nombre = $_POST['nombre'];
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];

   
    $update_query = mysqli_query($conexion, "UPDATE usuarios SET usuario='$usuario', nombre='$nombre', clave='$clave' WHERE id='$id'");
    if ($update_query) {
        header('Location: usuarios.php'); 
    }
}
?>

<?php include("includes/header.php"); ?>
<div class="container">
    <h2>Modificar Usuario</h2>
    <form action="" method="POST" autocomplete="off">
        <div class="form-group">
            <label for="usuario">Usuario</label>
            <input id="usuario" class="form-control" type="text" name="usuario" value="<?php echo $data['usuario']; ?>" required>
            <label for="nombre">Nombre</label>
            <input id="nombre" class="form-control" type="text" name="nombre" value="<?php echo $data['nombre']; ?>" required>
            <label for="clave">Clave</label>
            <input id="clave" class="form-control" type="text" name="clave" value="<?php echo $data['clave']; ?>" required>
        </div>
        <button class="btn btn-primary" type="submit" name="update">Actualizar</button>
    </form>
</div>
<?php include("includes/footer.php"); ?>