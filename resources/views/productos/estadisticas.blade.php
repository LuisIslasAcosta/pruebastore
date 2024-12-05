<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadísticas de Productos</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h1>Estadísticas de Productos</h1>

        <!-- Gráfico de productos por proveedor (Pastel) -->
        <div class="row">
            <div class="col-md-6">
                <h3>Productos por Proveedor</h3>
                <canvas id="productosPieChart" width="200" height="200"></canvas> <!-- Tamaño más pequeño -->
            </div>

            <!-- Gráfico de productos por categoría (Barras) -->
            <div class="col-md-6">
                <h3>Productos por Categoría</h3>
                <canvas id="productosBarChart" width="400" height="200"></canvas>
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-info">Volver al Panel de Administración</a>
            <a href="{{ route('admin.productos.index') }}" class="btn btn-info">Ir a la lista de productos</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-tp6V/NxLhkWuRUtjwDUrm/jP0DgBdD2LFhbVQJHGDAHEjdNr1l/SNl9fT7KPv/8B" crossorigin="anonymous"></script>

    <!-- Script para crear ambos gráficos -->
    <script>
        // Obtener el contexto para los gráficos
        var ctxPie = document.getElementById('productosPieChart').getContext('2d');
        var ctxBar = document.getElementById('productosBarChart').getContext('2d');

        // Gráfico de Pastel (Pie chart) - Productos por Proveedor
        var productosPieChart = new Chart(ctxPie, {
            type: 'pie', // Tipo de gráfico (pastel)
            data: {
                labels: @json($proveedores_nombres), // Las etiquetas son los nombres de los proveedores
                datasets: [{
                    label: 'Productos por Proveedor',
                    data: @json($productos_por_proveedor), // Los datos de los productos por proveedor
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)', // Color para cada segmento
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true, // Hace que el gráfico se adapte al tamaño de la pantalla
                plugins: {
                    legend: {
                        position: 'top', // Posición de la leyenda
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                // Modificar el texto del tooltip
                                return tooltipItem.label + ': ' + tooltipItem.raw + ' productos';
                            }
                        }
                    }
                }
            }
        });

        // Gráfico de Barras (Bar chart) - Productos por Categoría
        var productosBarChart = new Chart(ctxBar, {
            type: 'bar', // Tipo de gráfico (barras)
            data: {
                labels: @json($categorias_nombres), // Las etiquetas son los nombres de las categorías
                datasets: [{
                    label: 'Productos por Categoría',
                    data: @json($productos_por_categoria), // Los datos de los productos por categoría
                    backgroundColor: 'rgba(54, 162, 235, 0.2)', // Color de las barras
                    borderColor: 'rgba(54, 162, 235, 1)', // Color del borde de las barras
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true, // Hace que el gráfico se adapte al tamaño de la pantalla
                scales: {
                    y: {
                        beginAtZero: true // Comienza el eje Y desde cero
                    }
                }
            }
        });
    </script>
</body>
</html>
