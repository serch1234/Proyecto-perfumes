<?php
require_once "../config/conexion.php"; 


$total_usuarios = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT COUNT(*) as total FROM usuarios"))['total'];
$total_productos = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT COUNT(*) as total FROM productos"))['total'];
$total_categorias = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT COUNT(*) as total FROM categorias"))['total'];


$query = mysqli_query($conexion, "SELECT c.categoria, COUNT(p.id) as total FROM categorias c LEFT JOIN productos p ON c.id = p.id_categoria GROUP BY c.id");
$categorias = [];
$totales = [];
while ($row = mysqli_fetch_assoc($query)) {
    $categorias[] = $row['categoria'];
    $totales[] = $row['total'];
}

include("includes/header.php"); 
?>

<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Estadísticas y Gráficas</h1>
    </div>

    
    <div class="row">
        <div class="col-md-4">
            <div class="card text-blak bg-primary mb-3">
                <div class="card-header">Total Usuarios</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $total_usuarios; ?></h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-blak bg-success mb-3">
                <div class="card-header">Total Productos</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $total_productos; ?></h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-blak bg-danger mb-3">
                <div class="card-header">Total Categorías</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $total_categorias; ?></h5>
                </div>
            </div>
        </div>
    </div>


    <canvas id="productosPorCategoria"></canvas>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('productosPorCategoria').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($categorias); ?>,
                datasets: [{
                    label: 'Cantidad de Productos',
                    data: <?php echo json_encode($totales); ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</div>

<?php include("includes/footer.php"); ?>