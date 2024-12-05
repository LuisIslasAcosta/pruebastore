<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            display: flex;
            height: 100vh;
        }

        /* Barra lateral */
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

        .content-wrapper {
            margin-left: 250px;
            padding: 40px;
            flex: 1;
            background-color: #f4f6f9;
            color: #000;
        }

        .btn-primary, .btn-success {
            box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.2);
        }

        .btn-primary:hover, .btn-success:hover {
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
        }

        .table th, .table td {
            vertical-align: middle;
        }

        /* Estilos para la paginación */
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
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h1>Productos</h1>
        <div class="mb-3">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">Ir al Panel de Administración</a>
        </div>

        <!-- Formulario de filtros -->
        <form method="GET" action="{{ route('admin.productos.index') }}" class="mb-3">
            <div class="mb-2">
                <input type="text" name="nombre" class="form-control" placeholder="Buscar por nombre" value="{{ request('nombre') }}">
            </div>
            <div class="mb-2">
                <select name="categoria" class="form-control">
                    <option value="">Seleccionar categoría</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}" {{ request('categoria') == $categoria->id ? 'selected' : '' }}>{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-2">
                <input type="number" name="precio_min" class="form-control" placeholder="Precio mínimo" value="{{ request('precio_min') }}">
            </div>
            <div class="mb-2">
                <input type="number" name="precio_max" class="form-control" placeholder="Precio máximo" value="{{ request('precio_max') }}">
            </div>
            <button type="submit" class="btn btn-primary mt-2">Filtrar</button>
            <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary mt-2 ms-2">Limpiar Filtros</a>
        </form>

        <a href="{{ route('admin.productos.create') }}" class="btn btn-success mt-3">Agregar Producto</a>
        <a href="{{ route('productos.export', request()->query()) }}" class="btn btn-success mt-2">Descargar Excel</a>
    </div>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <h1>Lista de Productos</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Categoría</th>
                    <th>Proveedor</th>
                    <th>Foto</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productos as $producto)
                    <tr>
                        <td>{{ $producto->id }}</td>
                        <td>{{ $producto->nombre }}</td>
                        <td>{{ $producto->descripcion }}</td>
                        <td>{{ $producto->precio }}</td>
                        <td>{{ $producto->stock }}</td>
                        <td>{{ $producto->categoria->nombre ?? 'Sin categoría' }}</td>
                        <td>{{ $producto->proveedor->nombre ?? 'Sin proveedor' }}</td>
                        <td>
                            @if($producto->foto)
                                <img src="{{ asset('img/' . $producto->foto) }}" alt="Foto" style="width:80px; height:80px;">
                            @else
                                <span>No disponible</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.productos.edit', $producto->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('admin.productos.destroy', $producto->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?');">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-tp6V/NxLhkWuRUtjwDUrm/jP0DgBdD2LFhbVQJHGDAHEjdNr1l/SNl9fT7KPv/8B" crossorigin="anonymous"></script>
</body>
</html>
