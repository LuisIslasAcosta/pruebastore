<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistema de Gestión de Ventas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f4f6f9;
            height: 100vh;
            display: flex;
            color: #f8f9fa;
        }

        /* Sidebar */
        .sidebar {
            background-color: #343a40;
            color: #fff;
            width: 250px;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            padding: 20px;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar h1 {
            font-size: 24px;
            margin-bottom: 40px;
        }

        .sidebar .nav-link {
            color: #ccc;
            font-size: 18px;
            padding: 10px 15px;
            margin-bottom: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .sidebar .nav-link:hover {
            background-color: #007bff;
            color: #fff;
        }

        /* Content Wrapper */
        .content-wrapper {
            margin-left: 250px;
            padding: 40px;
            flex: 1;
            background-color: #343a40;
            color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            min-height: 100vh;
        }

        .navbar {
            background-color: #007bff;
            padding: 10px 20px;
            color: #fff;
            margin-left: 250px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .navbar h1 {
            font-size: 24px;
            margin: 0;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .row {
            margin-top: 20px;
        }

        .col-md-3,
        .col-md-9 {
            padding: 20px;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        .btn-lg {
            font-size: 16px;
            padding: 12px 20px;
            border-radius: 5px;
        }

        .list-group-item-action {
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .list-group-item-action:hover {
            background-color: #28a745;
            color: #fff;
        }

        .footer {
            text-align: center;
            padding: 10px;
            background-color: #343a40;
            color: #fff;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        /* Estilos adicionales para el jumbotron */
        .jumbotron {
            background: linear-gradient(135deg, #1f3a6d, #4e79bb);
            border-radius: 8px;
            padding: 40px;
            color: white;
        }

        .jumbotron .display-4 {
            font-size: 2.5rem;
            font-weight: bold;
        }

        .jumbotron .lead {
            font-size: 1.25rem;
        }

        .btn-primary, .btn-success {
            box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.2);
        }

        .btn-primary:hover, .btn-success:hover {
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
        }

        .content-wrapper h2, .content-wrapper p {
            color: #f8f9fa;
        }

    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h1>Dashboard SLM</h1>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.privada') }}" target="_blank">Vista de Usuario</a>
            </li>
            <lib>
            <a href="{{ route('logout') }}" class="nav-link">Cerrar Sesión</a>
            </lib>

        </ul>
    </div>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <!-- Jumbotron Section -->
        <div class="jumbotron">
            <h2 class="display-4">Bienvenido al Dashboard</h2>
            <p class="lead">Panel de Control</p>
            <hr class="my-4">
            <p>Desde aquí puedes gestionar todos los productos y realizar otras acciones administrativas de manera rápida y sencilla.</p>
        </div>

        <!-- Action Buttons -->
        <div class="row">
            <div class="col-md-6 mb-4">
                <a href="{{ route('admin.productos.index') }}" class="btn btn-lg btn-block btn-primary shadow-lg">Ver Todos los Productos</a>
            </div>


            <div class="col-md-6 mb-4">
                <a href="{{ route('admin.productos.create') }}" class="btn btn-lg btn-block btn-success shadow-lg">Crear Nuevo Producto</a>
            </div>

            <div class="col-md-6 mb-4">
                <a href="{{ route('admin.productos.estadisticas') }}" class="btn btn-lg btn-block btn-primary shadow-lg">Ver Estadísticas de Productos</a>
            </div>

            <div class="col-md-6 mb-4">
                <a href="{{ route('social-media') }}" class="btn btn-lg btn-block btn-success shadow-lg">Redes Sociales de los creadores</a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; 2024 Sistema de Gestión de Ventas - Todos los derechos reservados</p>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
