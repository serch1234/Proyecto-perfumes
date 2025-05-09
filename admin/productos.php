<?php
require_once "../config/conexion.php";

if (isset($_POST)) {
    if (!empty($_POST)) {
        
        if (isset($_POST['action']) && $_POST['action'] == 'update') {
            
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $cantidad = $_POST['cantidad'];
            $descripcion = $_POST['descripcion'];
            $p_normal = $_POST['p_normal'];
            $p_rebajado = $_POST['p_rebajado'];
            $categoria = $_POST['categoria'];

            
            if ($_FILES['foto']['name']) {
                $img = $_FILES['foto'];
                $name = $img['name'];
                $tmpname = $img['tmp_name'];
                $fecha = date("YmdHis");
                $foto = $fecha . ".jpg";
                $destino = "../assets/img/" . $foto;

        
                move_uploaded_file($tmpname, $destino);
                $query = mysqli_query($conexion, "UPDATE productos SET nombre='$nombre', descripcion='$descripcion', precio_normal='$p_normal', precio_rebajado='$p_rebajado', cantidad='$cantidad', imagen='$foto', id_categoria='$categoria' WHERE id='$id'");
            } else {
                $query = mysqli_query($conexion, "UPDATE productos SET nombre='$nombre', descripcion='$descripcion', precio_normal='$p_normal', precio_rebajado='$p_rebajado', cantidad='$cantidad', id_categoria='$categoria' WHERE id='$id'");
            }
        } else {
            
            $nombre = $_POST['nombre'];
            $cantidad = $_POST['cantidad'];
            $descripcion = $_POST['descripcion'];
            $p_normal = $_POST['p_normal'];
            $p_rebajado = $_POST['p_rebajado'];
            $categoria = $_POST['categoria'];
            $img = $_FILES['foto'];
            $name = $img['name'];
            $tmpname = $img['tmp_name'];
            $fecha = date("YmdHis");
            $foto = $fecha . ".jpg";
            $destino = "../assets/img/" . $foto;

            $query = mysqli_query($conexion, "INSERT INTO productos(nombre, descripcion, precio_normal, precio_rebajado, cantidad, imagen, id_categoria) VALUES ('$nombre', '$descripcion', '$p_normal', '$p_rebajado', $cantidad, '$foto', $categoria)");
            if ($query) {
                move_uploaded_file($tmpname, $destino);
                header('Location: productos.php');
            }
        }

        if ($query) {
            header('Location: productos.php');
        }
    }
}

include("includes/header.php"); ?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Productos</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" id="abrirProducto"><i class="fas fa-plus fa-sm text-white-50"></i> Nuevo</a>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-hover table-bordered" style="width: 100%;">
                <thead class="thead-dark">
                    <tr>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio Normal</th>
                        <th>Precio Rebajado</th>
                        <th>Cantidad</th>
                        <th>Categoria</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = mysqli_query($conexion, "SELECT p.*, c.id AS id_cat, c.categoria FROM productos p INNER JOIN categorias c ON c.id = p.id_categoria ORDER BY p.id DESC");
                    while ($data = mysqli_fetch_assoc($query)) { ?>
                        <tr>
                            <td><img class="img-thumbnail" src="../assets/img/<?php echo $data['imagen']; ?>" width="50"></td>
                            <td><?php echo $data['nombre']; ?></td>
                            <td><?php echo $data['descripcion']; ?></td>
                            <td><?php echo $data['precio_normal']; ?></td>
                            <td><?php echo $data['precio_rebajado']; ?></td>
                            <td><?php echo $data['cantidad']; ?></td>
                            <td><?php echo $data['categoria']; ?></td>
                            <td>
                                <form method="post" action="eliminar.php?accion=pro&id=<?php echo $data['id']; ?>" class="d-inline eliminar">
                                    <button class="btn btn-danger" type="submit">Eliminar</button>
                                </form>
                                <button class="btn btn-warning modificar" data-id="<?php echo $data['id']; ?>" data-nombre="<?php echo $data['nombre']; ?>" data-cantidad="<?php echo $data['cantidad']; ?>" data-descripcion="<?php echo $data['descripcion']; ?>" data-p_normal="<?php echo $data['precio_normal']; ?>" data-p_rebajado="<?php echo $data['precio_rebajado']; ?>" data-categoria="<?php echo $data['id_cat']; ?>" data-imagen="<?php echo $data['imagen']; ?>" data-toggle="modal" data-target="#productos">Modificar</button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal para agregar y editar productos -->
<div id="productos" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title" id="title">Nuevo Producto</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <input type="hidden" name="id" id="productId" value="">
                    <input type="hidden" name="action" id="action" value="insert">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cantidad">Cantidad</label>
                                <input id="cantidad" class="form-control" type="text" name="cantidad" placeholder="Cantidad" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="descripcion">Descripción</label>
                                <textarea id="descripcion" class="form-control" name="descripcion" placeholder="Descripción" rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="p_normal">Precio Normal</label>
                                <input id="p_normal" class="form-control" type="text" name="p_normal" placeholder="Precio Normal">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="p_rebajado">Precio Rebajado</label>
                                <input id="p_rebajado" class="form-control" type="text" name="p_rebajado" placeholder="Precio Rebajado">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="categoria">Categoria</label>
                                <select id="categoria" class="form-control" name="categoria" required>
                                    <?php
                                    $categorias = mysqli_query($conexion, "SELECT * FROM categorias");
                                    foreach ($categorias as $cat) { ?>
                                        <option value="<?php echo $cat['id']; ?>"><?php echo $cat['categoria']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="imagen">Foto</label>
                                <input type="file" class="form-control" name="foto">
                            </div>
                        </div>
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
            document.getElementById('productId').value = this.getAttribute('data-id');
            document.getElementById('nombre').value = this.getAttribute('data-nombre');
            document.getElementById('cantidad').value = this.getAttribute('data-cantidad');
            document.getElementById('descripcion').value = this.getAttribute('data-descripcion');
            document.getElementById('p_normal').value = this.getAttribute('data-p_normal');
            document.getElementById('p_rebajado').value = this.getAttribute('data-p_rebajado');
            document.getElementById('categoria').value = this.getAttribute('data-categoria');
            document.getElementById('action').value = 'update';
            document.getElementById('title').innerText = 'Modificar Producto';
        });
    });
</script>

<?php include("includes/footer.php"); ?>