<?php  
session_start(); 
require_once "config/conexion.php";  


$timeout_duration = 900; 


if (isset($_SESSION['LAST_ACTIVITY'])) {
    
    if (time() - $_SESSION['LAST_ACTIVITY'] > $timeout_duration) {
       
        session_unset(); 
        session_destroy(); 
        header("Location: sesion_clientes.php"); 
        exit();
    }
}


$_SESSION['LAST_ACTIVITY'] = time(); 
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
                <li class="nav-item">
                <a class="nav-link" href="./productos.php">Productos</a>
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
<!-- Control deslizante de brillo --> 
<div class="brightness-box" id="brightnessBox" style="display: none;"> 
    <i class="fa-solid fa-moon"></i> 
    <input type="range" id="range" min="10" max="100" value="100"> 
    <i class="fa-regular fa-sun"></i> 
</div> 
            </ul> 
            <form class="form-inline my-2 my-lg-0"> 
            <ul class="nav-item active dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i id="icono" class="bi bi-person-circle"></i>
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
        <?php if (!empty($_SESSION['active'])) { ?>
            <a class="dropdown-item" href="cambiar_contra.php">Cambiar Contraseña</a>
            <a class="dropdown-item" href="cerrar.php">Cerrar sesión</a>
        <?php } else { ?>
            <a class="dropdown-item" href="sesion_clientes.php">Inicia sesión</a>
            <a class="dropdown-item" href="formu_clientes.php">Registro</a>
           
        <?php } ?>
    </div>
</ul>
                <a href="#" class="nav-link" id="btnCarrito" onclick="showCart()"> 
        <i class="fas fa-shopping-cart"></i> 
        <span class="badge bg-success" id="carrito">0</span> 
    </a> 
            </form> 
        </div> 
    </nav><!-- navbar responsiva --> 
    <div class="hero-image"> 
        <div class="hero-text"> 
            <h1 style="font-family: 'Outfit', sans-serif;">The Aroma Serg</h1> 
            <p>Fragancias que te hacen diferente</p> 
            <?php 
            if (!empty($_SESSION['active'])) { 
                echo "<h2>Bienvenido, " . htmlspecialchars($_SESSION['nombre']) . "!</h2>"; 
            } else { 
                echo "<h2>Por favor, inicie sesión.</h2>"; 
            } 
            ?> 
        </div> 
    </div> <!-- Hero  --> 
<input type="checkbox" id="btn-menu"> 
<div class="container-menu"> 
	<div class="cont-menu"> 
    <div class="collapse navbar-collapse" id="navbarNav"> 
                    <ul class="navbar-nav"> 
		<nav> 
        <?php 
                        $query = mysqli_query($conexion, "SELECT * FROM categorias"); 
                        while ($data = mysqli_fetch_assoc($query)) { ?> 
                            <a href="#" class="nav-link" category="<?php echo $data['categoria']; ?>"><?php echo $data['categoria']; ?></a> 
                        <?php } ?> 
                        <a href="#" class="nav-link" category="all">Ver Todo</a> 
		</nav> 
		<label for="btn-menu">✖️</label> 
	</div> 
</div> 
                    </ul> 
                </div> 
            </div> 
        </nav> 
       </div> 
    <section class="py-5"> 
    <div class="container px-4 px-lg-5"> 
    <div class="row gx-4 gx-lg-5 row-cols-1 row-cols-md-2 row-cols-lg-3 justify-content-center"> 
                <?php 
                $query = mysqli_query($conexion, "SELECT p.*, c.id AS id_cat, c.categoria FROM productos p INNER JOIN categorias c ON c.id = p.id_categoria"); 
                $result = mysqli_num_rows($query); 
                if ($result > 0) { 
                    while ($data = mysqli_fetch_assoc($query)) { ?> 
                        <div class="col mb-5 productos" category="<?php echo $data['categoria']; ?>"> 
                            <div class="card h-100"> 
                              <!--  <div class="badge bg-danger text-white position-absolute" style="top: 0.5rem; right: 0.5rem"> 
                                    <?php echo ($data['precio_normal'] > $data['precio_rebajado']) ? 'Oferta' : ''; ?> 
                                    </div> --> 
                                <!-- Product image--> 
                                <img class="card-img-top" src="assets/img/<?php echo $data['imagen']; ?>" alt="..." /> 
                                <!-- Product details--> 
                                <div class="card-body p-4"> 
                                    <div class="text-center"> 
                                        <!-- Product name--> 
                                        <h5 class="fw-bolder"><?php echo $data['nombre'] ?></h5> 
                                        <p><?php echo $data['descripcion']; ?></p> 
                                        <!-- Product reviews--> 
                                        <div class="d-flex justify-content-center small text-warning mb-2"> 
                                            <div class="bi-star-fill"></div> 
                                            <div class="bi-star-fill"></div> 
                                            <div class="bi-star-fill"></div> 
                                            <div class="bi-star-fill"></div> 
                                            <div class="bi-star-fill"></div> 
                                        </div> 
                                        <!-- Product price--> 
                                        <span class="text-muted text-decoration-line-through"> 
                                            <?php echo ($data['precio_normal'] > $data['precio_rebajado']) ? '$'.$data['precio_normal'] : "" ?> 
                                        </span><br> 
                                        <?php echo "$" .$data['precio_rebajado'] ?> 
                                    </div> 
                                </div> 
                                <!-- Product actions--> 
                                <!-- Product actions-->
<div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
    <div class="text-center">
    <a class="btn btn-outline-dark mt-auto agregar" data-id="<?php echo $data['id']; ?>" data-nombre="<?php echo $data['nombre']; ?>" data-precio="<?php echo $data['precio_rebajado']; ?>" href="#" onclick="agregarAlCarrito(this)">Comprar</a>
    <button class="btn btn-outline-warning mt-auto agregar-favorito" data-id="<?php echo $data['id']; ?>" onclick="agregarAFavoritos(this)">⭐ Favorito</button>
    </div>
</div>
                            </div> 
                        </div> 
                <?php  } 
                } ?> 
            </div> 
        </div> 
    </section> 
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
                      <a href="https://www.facebook.com/sergioeljeje" class="bi bi-facebook"></i></a> 
                      <a  href="https://www.instagram.com/_sergioperez__/" class="bi bi-instagram"></i></a> 
                    </div> 
                </div> 
                <div class="box__copyright"> 
                    <hr> 
                    <p>Todos los Derechos Reservados  2024 <b>The Aroma Serg</b></p> 
                </div> 
            </div> 
    </footer> 
    <!-- Botón de Preguntas Frecuentes --> 
    <button id="faqButton" class="btn btn-info"> 
        AYUDA..? 
    </button> 
    <!-- Modal de Preguntas Frecuentes --> 
    <div class="modal fade" id="faqModal" tabindex="-1" role="dialog" aria-labelledby="faqModalLabel" aria-hidden="true"> 
        <div class="modal-dialog" role="document"> 
            <div class="modal-content"> 
                <div class="modal-header"> 
                    <h5 class="modal-title" id="faqModalLabel">Preguntas Frecuentes</h5> 
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
                        <span aria-hidden="true">×</span> 
                    </button> 
                </div> 
                <div class="modal-body"> 
                    <h6>1. ¿Qué tipos de perfumes ofrecen?</h6> 
                    <p>Ofrecemos perfumes para hombres, mujeres y niños, todos personalizados a tu gusto.</p> 
                    <h6>2. ¿Son los perfumes de larga duración?</h6> 
                    <p>Sí, utilizamos ingredientes de alta calidad para garantizar la durabilidad de nuestras fragancias.</p> 
                    <h6>3. ¿Puedo personalizar mi perfume?</h6> 
                    <p>¡Por supuesto! Puedes elegir los ingredientes y el diseño de tu botella.</p> 
                    <h6>4. ¿Hacen envíos a todo el país?</h6> 
                    <p>Sí, realizamos envíos a todo el país. Consulta nuestras tarifas de envío.</p> 
                    <h6>5. ¿Qué ingredientes utilizan en sus perfumes?</h6> 
                    <p>Utilizamos ingredientes naturales y de alta calidad para crear fragancias únicas.</p> 
                    <h6>6. ¿Cómo puedo cuidar mi perfume para que dure más?</h6> 
                    <p>Se recomienda almacenar el perfume en un lugar fresco y seco, lejos de la luz directa.</p> 
                </div> 
                <div class="modal-footer"> 
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button> 
                </div> 
            </div> 
        </div> 
    </div> 
<div class="brightness-box" id="brightnessBox" style="display: none;"> 
    <i class="fa-solid fa-moon"></i> 
    <input type="range" id="range" min="10" max="100" value="100"> 
    <i class="fa-regular fa-sun"></i> 
</div> 

<!--<script>
window.addEventListener('beforeunload', function (event) {
    navigator.sendBeacon('logout.php'); // Llamar a tu script de cierre de sesión
});
</script>-->
<script>
        function agregarAFavoritos(element) {
    const isLoggedIn = <?php echo json_encode(!empty($_SESSION['active'])); ?>;
    if (!isLoggedIn) {
        alert('Debes iniciar sesión primero para agregar productos a favoritos.');
        return; 
    }
    
    const productId = element.getAttribute('data-id');
    
    
    fetch('agregar_favorito.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ producto_id: productId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Producto agregado a favoritos');
        } else {
            alert('Error al agregar a favoritos');
        }
    });
}


function agregarAlCarrito(element) {
   
    const isLoggedIn = <?php echo json_encode(!empty($_SESSION['active'])); ?>;
    
    if (!isLoggedIn) {
        alert('Debes iniciar sesión primero para agregar productos a tu carrito.');
        return; 
    }
    
   
    const productId = element.getAttribute('data-id');
    const productName = element.getAttribute('data-nombre');
    const productPrice = element.getAttribute('data-precio');

    const producto = {
        id: productId,
        nombre: productName,
        precio: productPrice
    };

    let productos = JSON.parse(localStorage.getItem('productos')) || [];
    
    
    const existe = productos.some(p => p.id === producto.id);
    if (!existe) {
        productos.push(producto);
        localStorage.setItem('productos', JSON.stringify(productos));
        document.getElementById('carrito').innerText = productos.length; 
        alert('Producto agregado al carrito: ' + productName);
    } else {
        alert('Este producto ya está en tu carrito.');
    }
}


</script>

<script  type = "module"  src = "https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js" > </script> 
<script  nomodule  src = "https://unpkg .com/ionicons@7.1.0/dist/ionicons/ionicons.js" > </script>
<script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
        <script src="assets/js/scripts.js"></script> 
        <script src="assets/js/accesibilidad.js"></script> 
        <script type="text/javascript"> 
    (function(d, t) { 
        var v = d.createElement(t), s = d.getElementsByTagName(t)[0]; 
        v.onload = function() { 
            window.voiceflow.chat.load({ 
            verify: { projectID: '6719d5a8878266edb962e58f' }, 
            url:  'https://general-runtime.voiceflow.com', 
            versionID: 'production' 
            }); 
        } 
        v.src = "https://cdn.voiceflow.com/widget/bundle.mjs"; v.type = "text/javascript"; s.parentNode.insertBefore(v, s); 
    })(document, 'script'); 
    </script>

    
	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Carousel -->
	<script src="js/owl.carousel.min.js"></script>
	<!-- countTo -->
	<script src="js/jquery.countTo.js"></script>
	<!-- Flexslider -->
	<script src="js/jquery.flexslider-min.js"></script>
	
	<!-- Main -->
	<script src="js/main.js"></script>
  
   
</body> 
</html> 

   