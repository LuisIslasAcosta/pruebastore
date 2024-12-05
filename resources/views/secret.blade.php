<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Productos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Agregar Font Awesome -->

    <style>
        body {
            background-color: #252728;
            color: #fff;
            overflow-x: hidden; /* Previene el desbordamiento horizontal */
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

        .logout-btn {
            margin-left: auto;
            margin-right: 20px;
        }

        .card-img-top {
            height: 150px;
            object-fit: cover;
        }

        .card {
            border: none;
            height: 100%;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
        }

        h2 {
            font-size: 1.5rem;
        }

        .form-control {
            background-color: #333;
            color: #fff;
            border: 1px solid #555;
        }

        .form-control::placeholder {
            color: #ccc;
        }

        .btn-primary, .btn-warning, .btn-danger {
            margin: 5px;
        }

        .price-stock {
            color: #000;
        }

        .card-title {
            color: #000;
        }

        /* Barra lateral */
        .sidebar {
            background-color: #333;
            padding: 20px;
            position: fixed;
            top: 120px;
            left: -250px; /* La barra comienza oculta, fuera de la pantalla */
            width: 250px;
            height: 100%;
            overflow-y: auto;
            z-index: 2;
            transition: left 0.3s ease; /* Transición suave */
        }

        .sidebar h3 {
            color: #fff;
        }

        .sidebar .form-group {
            margin-bottom: 15px;
        }

        .sidebar .form-control {
            margin-bottom: 10px;
        }

        /* Contenedor de productos */
        .products-container {
            padding: 20px;
            transition: margin-left 0.3s ease;
        }

        .pagination {
            justify-content: center;
            margin-top: 20px;
        }

        .pagination .page-item {
            margin: 0 5px;
        }

        .pagination .page-link {
            border-radius: 50%;
            background-color: #f4f6f9;
            color: #007bff;
        }

        .pagination .page-link:hover {
            background-color: #007bff;
            color: #fff;
        }

        .pagination .page-item.active .page-link {
            background-color: #007bff;
            color: #fff;
        }

        .pagination .page-item.disabled .page-link {
            color: #ccc;
        }

        /* Si la barra lateral está visible */
        .sidebar.open {
            left: 0; /* Muestra la barra lateral */
        }

        /* Si la barra lateral está abierta, los productos deben moverse a la derecha */
        .products-container.shifted {
            margin-left: 270px; /* Espacio para la barra lateral */
        }

        /* Estilos para el botón de hamburguesa */
        #toggleSidebar {
            font-size: 24px; /* Tamaño del ícono */
            color: #fff; /* Color blanco */
            background-color: transparent; /* Fondo transparente */
            border: none; /* Sin borde */
            padding: 10px;
            transition: color 0.3s ease; /* Transición suave de color */
            position: absolute;
            left: 15px; /* Posiciona el ícono a la izquierda */
            top: 50%; /* Centrado verticalmente */
            transform: translateY(-50%); /* Centrado vertical */
        }

        #toggleSidebar:hover {
            color: #007bff; /* Color al pasar el mouse */
        }

        /* Ajustar margen al título para separarlo del ícono */
        .navbar h1 {
            margin-left: 80px; /* Espacio para que no choque con el ícono */
        }

        /* En dispositivos móviles, puedes mejorar el tamaño de la barra lateral y el ícono */
        @media (max-width: 768px) {
            #toggleSidebar {
                font-size: 30px; /* Aumentar el tamaño en pantallas pequeñas */
            }
            .navbar h1 {
                margin-left: 60px; /* Aumentar espacio en móviles */
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <button id="toggleSidebar" class="btn btn-light">
            <i class="fas fa-bars"></i> <!-- Icono de barras -->
        </button>
        <h1>Productos</h1>
        <div class="logout-btn">
            <a href="{{ route('logout') }}"><button type="button" class="btn btn-outline-primary">Cerrar Sesión</button></a>
        </div>
    </nav>

    <div class="content container-fluid">
        <!-- Barra lateral con filtros -->
        <div class="sidebar" id="sidebar">
            <h3>Filtros</h3>
            <form method="GET" action="{{ route('productos.privada') }}">
                <div class="form-group">
                    <input type="text" class="form-control" name="nombre" placeholder="Buscar por nombre" value="{{ request('nombre') }}">
                </div>
                <div class="form-group">
                    <select class="form-control" name="categoria">
                        <option value="">Seleccionar categoría</option>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ request('categoria') == $categoria->id ? 'selected' : '' }}>{{ $categoria->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" name="precio_min" placeholder="Precio mínimo" value="{{ request('precio_min') }}">
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" name="precio_max" placeholder="Precio máximo" value="{{ request('precio_max') }}">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Buscar</button>
                <a href="{{ route('productos.privada') }}" class="btn btn-secondary btn-block mt-2">Limpiar Filtros</a>
            </form>
            <hr>

<h3>Gráficos</h3>
<a href="{{ route('productos.graficos') }}" class="btn btn-info btn-block">
    <i class="fas fa-chart-bar"></i> Ver Gráficos
</a>
        </div>

        <!-- Contenedor de productos -->
        <div class="products-container" id="productsContainer">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <h2 class="mt-5">Productos en existencia</h2>
            <div class="row">
                @foreach($productos as $producto)
                    <div class="col-md-3 mb-4">
                        <div class="card">
                            <img src="{{ asset('img/' . $producto->foto) }}" class="card-img-top" alt="{{ $producto->nombre }}">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $producto->nombre }}</h5>
                                <div class="d-flex justify-content-between price-stock">
                                    <span>Precio: {{ $producto->precio }} $</span>
                                    <span>Stock: {{ $producto->stock }}</span>
                                </div>
                                <div class="mt-auto">
                                    <a href="{{ route('productos.show', $producto->id) }}" class="btn btn-warning btn-sm">Detalles del Producto</a>
                                    <form action="{{ route('cart.add', $producto->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">Añadir al carrito</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Paginación -->
            <div class="d-flex justify-content-center mt-3">
                <ul class="pagination">
                    <li class="page-item {{ $productos->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $productos->previousPageUrl() }}" aria-label="Previous">
                            &laquo; Anterior
                        </a>
                    </li>

                    @for ($i = 1; $i <= $productos->lastPage(); $i++)
                        <li class="page-item {{ $productos->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $productos->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    <li class="page-item {{ $productos->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $productos->nextPageUrl() }}" aria-label="Next">
                            Siguiente &raquo;
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Alternar la visibilidad de la barra lateral
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            var sidebar = document.getElementById('sidebar');
            var productsContainer = document.getElementById('productsContainer');
            sidebar.classList.toggle('open'); // Mostrar u ocultar la barra lateral
            productsContainer.classList.toggle('shifted'); // Ajustar el contenedor de productos
        });
    </script>
</body>
</html>
