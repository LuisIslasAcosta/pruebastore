<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Productos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .logout-btn {
            position: absolute;
            top: 10px;
            left: 10px;
            z-index: 1000;
        }
        .card-img-top {
            height: 150px;
            object-fit: cover;
        }
    </style>
</head>
<body>
<div class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
            <a class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
            <h1>Productos</h1>
            </a>
            <div class="col-md-3 text-end">
                <a href="{{route('logout')}}"><button type="button" class="btn btn-outline-primary me-2">Salir</button></a>
            </div>
        </header>
    </div>
    <article class="container">
        <h2>Area de Productos</h2>
    </article>
        <form action="" method="GET" class="form-inline mb-4">
            <input type="text" name="search" class="form-control mr-2" placeholder="Buscar producto" required>
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>

        <h2 class="mt-5">Productos en existencia</h2>
        <div class="row">
            @foreach($productos as $producto)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('img/' . $producto->foto) }}" class="card-img-top" alt="{{ $producto->nombre }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $producto->nombre }}</h5>
                            <div class="d-flex justify-content-between">
                                <span>Precio: {{ $producto->precio }} $</span>
                                <span>Stock: {{ $producto->stock }}</span>
                            </div>
                            <div class="mt-2">
                                <a href="{{ route('productos.show', $producto->id) }}" class="btn btn-warning">Detalles del Producto</a>
                                <form action="" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <div class="mt-2">
                                    <a href="{{ route('productos.show', $producto->id) }}" class="btn btn-warning">Detalles del Producto</a>
                                    <form action="{{ route('cart.add', $producto->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Añadir al Carrito</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>