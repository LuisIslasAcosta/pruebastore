<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráficos de Productos</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <div class="container mt-5">
    <div class="mt-3">
        <a href="{{ route('productos.privada') }}" class="btn btn-info">Ir a la lista de productos</a>
        </div>
        <h2>Gráficos de Productos</h2>
        
        <!-- Gráfico para Stock -->
        <canvas id="chartStock"></canvas>
        
        <!-- Gráfico para Precio -->
        <canvas id="chartPrice"></canvas>
    </div>

    <script>
        // Datos de ejemplo desde Blade
        const productos = @json($productos);

        const labels = productos.map(p => p.nombre);
        const dataStock = productos.map(p => p.stock);
        const dataPrice = productos.map(p => p.precio);

        // Gráfico para Stock
        const ctxStock = document.getElementById('chartStock').getContext('2d');
        new Chart(ctxStock, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Stock',
                    data: dataStock,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Gráfico para Precio
        const ctxPrice = document.getElementById('chartPrice').getContext('2d');
        new Chart(ctxPrice, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Precio',
                    data: dataPrice,
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
