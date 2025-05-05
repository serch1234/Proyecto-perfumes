<?php 
session_start(); 
require_once "config/conexion.php";
require_once "config/config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Carrito de Compras</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" /> 
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="assets/css/styles.css" rel="stylesheet" />
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
    <!-- Navigation-->
     
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
                        <a class="dropdown-item" href="#" id="toggle-brightness">Ajustar Brillo</a> <!-- Nueva opción -->
                    </div>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <ul class="nav-item active dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i id="icono" class="bi bi-person-circle"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="./admin/index.php">Inicia sesión</a>
                        <a class="dropdown-item" href="formBD.html">Registro</a>
                    </div>
                </ul>
                <a href="#" class="nav-link" id="btnCarrito" onclick="showCart()">
        <i class="fas fa-shopping-cart"></i>
        <span class="badge bg-success" id="carrito">0</span>
    </a>
            </form>
        </div>
    </nav><!-- navbar responsiva -->

    <!-- Header-->
    <header">
    <img  width="1520" height="280"  src="./images/carritoper.jpg">
        
            </div>
        </div>
    </header>
    <section class="py-5">
        <div class="container px-4 px-lg-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Producto</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>
                            <tbody id="tblCarrito">

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-5 ms-auto">
                    <h4>Total a Pagar: $ <span id="total_pagar">0.00</span></h4>
                    <div class="d-grid gap-2">
                        <div id="paypal-button-container"></div>
                        <button class="btn btn-warning" type="button" id="btnVaciar">Vaciar Carrito</button>
                        <button class="btn btn-success" type="button" id="btnComprar" onclick="irAComprar()">Ir a Comprar</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Todos los derechos reservados &copy; equipo Pweb 2024</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="https://www.paypal.com/sdk/js?client-id=<?php echo CLIENT_ID; ?>&locale=<?php echo LOCALE; ?>"></script>
    <script src="assets/js/scripts.js"></script>
    <script>
      mostrarCarrito();

function mostrarCarrito() {
if (localStorage.getItem("productos") != null) {
let array = JSON.parse(localStorage.getItem('productos'));
if (array.length > 0) {
    $.ajax({
        url: 'ajax.php',
        type: 'POST',
        async: true,
        data: {
            action: 'buscar',
            data: array
        },
        success: function(response) {
            console.log(response);
            const res = JSON.parse(response);
            let html = '';
            res.datos.forEach(element => {
                html += `
                    <tr>
                        <td>${element.id}</td>
                        <td>${element.nombre}</td>
                        <td>${element.precio}</td>
                        <td>1</td>
                        <td>${element.precio}</td>
                        <td><button class="btn btn-danger btn-sm" onclick="eliminarProducto(${element.id})">Eliminar</button></td>
                    </tr>
                `;
            });
            $('#tblCarrito').html(html);
            $('#total_pagar').text(res.total);
            paypal.Buttons({
                style: {
                    color: 'blue',
                    shape: 'pill',
                    label: 'pay'
                },
                createOrder: function(data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: res.total
                            }
                        }]
                    });
                },
                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(details) {
                        alert('Transacción completada por ' + details.payer.name.given_name);
                    });
                }
            }).render('#paypal-button-container');
        },
        error: function(error) {
            console.log(error);
        }
    });
}
}
}

function updateCartCount() {
    let productos = JSON.parse(localStorage.getItem("productos"));
    let count = productos ? productos.length : 0; // Cuenta el número de productos
    $('#carrito').text(count); // Actualiza el badge del carrito
}
function irAComprar() {
    // Verificar si el usuario ha iniciado sesión
    const isLoggedIn = <?php echo json_encode(!empty($_SESSION['active'])); ?>;

    if (!isLoggedIn) {
        alert('Debes iniciar sesión primero para proceder a la compra.');
        return; // Salir de la función si no está conectado
    }

    let productos = localStorage.getItem("productos");
    let total = $('#total_pagar').text(); 
    if (productos) {
        window.location.href = 'pagar.php?productos=' + encodeURIComponent(productos) + '&total=' + encodeURIComponent(total);
    } else {
        alert("No hay productos en el carrito.");
    }
}

function eliminarProducto(productId) {
    let productos = JSON.parse(localStorage.getItem("productos"));
    productos = productos.filter(product => product.id !== productId);
    localStorage.setItem("productos", JSON.stringify(productos));
    mostrarCarrito(); 
}

    </script>
</body>

</html>