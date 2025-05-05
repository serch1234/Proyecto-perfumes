<?php
require_once "../config/conexion.php";

if (isset($_POST)) {
    if (!empty($_POST)) {
        
        if (isset($_POST['action']) && $_POST['action'] == 'update') {
            
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $usuario = $_POST['usuario'];
            $clave = $_POST['clave'];
            $query = mysqli_query($conexion, "UPDATE usuarios SET usuario='$usuario', nombre='$nombre', clave='$clave' WHERE id='$id'");
        } else {
            
            $nombre = $_POST['nombre'];
            $usuario = $_POST['usuario'];
            $clave = $_POST['clave'];
            $query = mysqli_query($conexion, "INSERT INTO usuarios(usuario, nombre, clave) VALUES ('$usuario', '$nombre', '$clave')");
        }

        if ($query) {
            header('Location: usuarios.php');
        }
    }
}

include("includes/header.php");
?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Usuarios</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" id="abrirUsuario"><i class="fas fa-plus fa-sm text-white-50"></i> Nuevo</a>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-hover table-bordered" style="width: 100%;">
                <thead class="thead-dark">
                    <tr>
                        <th>Id</th>
                        <th>Usuario</th>
                        <th>Nombre</th>
                        <th>Clave</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = mysqli_query($conexion, "SELECT * FROM usuarios ORDER BY id ASC");
                    while ($data = mysqli_fetch_assoc($query)) { ?>
                        <tr>
                            <td><?php echo $data['id']; ?></td>
                            <td><?php echo $data['usuario']; ?></td>
                            <td><?php echo $data['nombre']; ?></td>
                            <td><?php echo $data['clave']; ?></td>
                            <td>
                                <form method="post" action="eliminar.php?accion=pre&id=<?php echo $data['id']; ?>" class="d-inline eliminar">
                                    <button class="btn btn-danger" type="submit">Eliminar</button>
                                </form>
                                <button class="btn btn-warning modificar" data-id="<?php echo $data['id']; ?>" data-usuario="<?php echo $data['usuario']; ?>" data-nombre="<?php echo $data['nombre']; ?>" data-clave="<?php echo $data['clave']; ?>" data-toggle="modal" data-target="#usuarios">Modificar</button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal para agregar y editar usuarios -->
<div id="usuarios" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title" id="title">Nuevo Usuario</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" autocomplete="off">
                    <input type="hidden" name="id" id="userId" value="">
                    <input type="hidden" name="action" id="action" value="insert">
                    <div class="form-group">
                        <label for="usuario">Usuario</label>
                        <input id="usuario" class="form-control" type="text" name="usuario" placeholder="Usuario" required>
                        <label for="nombre">Nombre</label>
                        <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre" required>
                        <label for="clave">Clave</label>
                        <input id="clave" class="form-control" type="text" name="clave" placeholder="Clave" required>
                    </div>
                    <button class="btn btn-primary" type="submit">Registrar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    
    document.querySelectorAll('.modificar').forEach(button => {
        button.addEventListener('click', function() {
            document.getElementById('userId').value = this.getAttribute('data-id');
            document.getElementById('usuario').value = this.getAttribute('data-usuario');
            document.getElementById('nombre').value = this.getAttribute('data-nombre');
            document.getElementById('clave').value = this.getAttribute('data-clave');
            document.getElementById('action').value = 'update';
            document.getElementById('title').innerText = 'Modificar Usuario';
        });
    });
</script>

<?php include("includes/footer.php"); ?>