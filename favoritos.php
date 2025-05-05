<?php
session_start();
require_once "config/conexion.php"; 


if (empty($_SESSION['active'])) {
    header('Location: sesion_clientes.php'); 
    exit();
}


$user_id = $_SESSION['user_id']; 


$query = mysqli_query($conexion, "SELECT p.id, p.nombre, p.imagen, p.precio_rebajado FROM productos_favoritos pf INNER JOIN productos p ON pf.producto_id = p.id WHERE pf.user_id = '$user_id'");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>The Aroma Serg</title> 
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
                    <a class="dropdown-item" href="#" id="toggle-brightness">Ajustar Brillo</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="favoritos.php">
                    <i class="fas fa-heart"></i> Favoritos
                </a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <ul class="nav-item active dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i id="icono" class="bi bi-person-circle"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="sesion_clientes.php">Inicia sesión</a>
                    <a class="dropdown-item" href="formu_clientes.php">Registro</a>
                </div>
            </ul>
            <a href="#" class="nav-link" id="btnCarrito" onclick="showCart()">
                <i class="fas fa-shopping-cart"></i>
                <span class="badge bg-success" id="carrito">0</span>
            </a>
        </form>
    </div>
</nav>
    
    <div class="container">
        <h1>Productos Favoritos</h1>
        <div class="row">
            <?php
            if (mysqli_num_rows($query) > 0) {
                while ($data = mysqli_fetch_assoc($query)) { ?>
                  <div class="col-md-4">
    <div class="card">
        <img class="card-img-top" src="assets/img/<?php echo $data['imagen']; ?>" alt="<?php echo $data['nombre']; ?>">
        <div class="card-body">
            <h5 class="card-title"><?php echo $data['nombre']; ?></h5>
            <p class="card-text">$<?php echo $data['precio_rebajado']; ?></p>
            <div class="btn-group">
                <button class="btn btn-danger" onclick="eliminarFavorito(<?php echo $data['id']; ?>)">
                    <i class="fas fa-trash"></i> Eliminar
                </button>
                <button class="btn btn-success" onclick="agregarAlCarrito(<?php echo $data['id']; ?>, '<?php echo $data['nombre']; ?>', <?php echo $data['precio_rebajado']; ?>)">
                    <i class="fas fa-shopping-cart"></i> Agregar al carrito
                </button>
            </div>
        </div>
    </div>
</div>
                <?php }
            } else {
                echo "<p>No tienes productos favoritos.</p>";
            }
            ?>
        </div>
    </div>
    
    <footer>
        <div class="container_footer"> 
            <div class="box__footer"> 
                <div class="logo"> 
                    <img src="images/iconperfu.jpg" alt="perfume"> 
                </div> 
                <div class="terms"></div> 
            </div> 
            <div class="box__footer"> 
                <h2><a href="about.html" style="text-decoration: none;"> Nosotros</a></h2> 
            </div> 
            <div class="box__footer"> 
                <h2><a href="productos.html" style="text-decoration: none;"> Productos</a></h2> 
            </div> 
            <div class="box__footer"> 
                <h2>Redes Sociales</h2> 
                <div class="redes"> 
                    <a href="https://www.facebook.com/sergioeljeje" class="bi bi-facebook"></a> 
                    <a href="https://www.instagram.com/_sergioperez__/" class="bi bi-instagram"></a> 
                </div> 
            </div> 
            <div class="box__copyright"> 
                <hr> 
                <p>Todos los Derechos Reservados  2024 <b>The Aroma Serg</b></p> 
            </div> 
        </div> 
    </footer>
    <script>
        function eliminarFavorito(productoId) {
    if (confirm('¿Estás seguro de eliminar este producto de favoritos?')) {
        fetch('eliminar_favorito.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ producto_id: productoId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        });
    }
}

function agregarAlCarrito(id, nombre, precio) {
    let producto = {
        id: id,
        nombre: nombre,
        precio: precio
    };
    let productos = JSON.parse(localStorage.getItem('productos')) || [];
    const existe = productos.some(p => p.id === producto.id);
    if (!existe) {
        productos.push(producto);
        localStorage.setItem('productos', JSON.stringify(productos));
        alert('Producto agregado al carrito');
        updateCartCount(); 
    } else {
        alert('Este producto ya está en tu carrito.');
    }
}

function updateCartCount() {
    let productos = JSON.parse(localStorage.getItem("productos"));
    let count = productos ? productos.length : 0; 
    document.getElementById('carrito').innerText = count; 
}
    </script>
    
</body>
</html>