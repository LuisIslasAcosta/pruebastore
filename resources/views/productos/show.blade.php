<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Producto</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body {
            background-color: #252728;
            color: #fff;
            overflow-x: hidden;
        }

        .navbar {
            background-color: rgba(0, 0, 0, 0.7);
            position: fixed;
            width: 100%;
            z-index: 3;
            top: 0;
            left: 0;
            padding: 15px 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .content {
            margin-top: 120px;
        }

        .product-img {
            max-height: 400px;
            object-fit: contain;
        }

        .card {
            border: none;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .price-stock {
            color: #f4f6f9;
        }

        .product-description {
            margin-top: 20px;
        }

        .btn-back {
            margin-top: 20px;
        }

        .btn-primary, .btn-warning, .btn-danger {
            margin: 5px;
        }

        #chartContainer {
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <h1>Detalles del Producto</h1>
        <div class="logout-btn">
            <a href="{{ route('logout') }}">
                <button type="button" class="btn btn-outline-primary">Cerrar Sesión</button>
            </a>
        </div>
    </nav>

    <div class="content container-fluid">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('img/' . $producto->foto) }}" alt="{{ $producto->nombre }}" class="product-img img-fluid">
            </div>
            <div class="col-md-6">
                <h2>{{ $producto->nombre }}</h2>
                <div class="price-stock">
                    <p><strong>Precio:</strong> {{ $producto->precio }} $</p>
                    <p><strong>Stock disponible:</strong> {{ $producto->stock }}</p>
                </div>
                <p class="product-description">{{ $producto->descripcion }}</p>
                <form action="{{ route('cart.add', $producto->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Añadir al carrito</button>
                </form>
                <a href="{{ route('productos.privada') }}" class="btn btn-primary btn-back">Volver a la lista</a>
            </div>
        </div>

        <div id="chartContainer" class="mt-5">
            <h3>Distribución del Producto</h3>
            <canvas id="productChart" style="max-width: 300px; max-height: 300px; margin: auto;"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const data = {
            labels: ['Precio', 'Stock'],
            datasets: [{
                label: 'Distribución del Producto',
                data: [{{ $producto->precio }}, {{ $producto->stock }}],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.7)', // Color para "Precio"
                    'rgba(255, 99, 132, 0.7)'  // Color para "Stock"
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        };

        const config = {
            type: 'pie',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return `${tooltipItem.label}: ${tooltipItem.raw}`;
                            }
                        }
                    }
                }
            },
        };

        const ctx = document.getElementById('productChart').getContext('2d');
        new Chart(ctx, config);
    </script>
</body>
</html>
