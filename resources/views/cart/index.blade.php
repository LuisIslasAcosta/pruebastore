@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Carrito de Compras</h1>

    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if ($cart && $cart->items->isNotEmpty())
        <table class="table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total = 0; // Inicializa el total
                    $itemsCount = 0; // Contador de productos
                @endphp
                @foreach ($cart->items as $item)
                    <tr>
                        <td>{{ $item->product->nombre }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>${{ $item->price }}</td>
                        <td>${{ $item->price * $item->quantity }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @php
                        $total += $item->price * $item->quantity; // Suma el subtotal al total
                        $itemsCount += $item->quantity; // Suma la cantidad de productos
                    @endphp
                @endforeach
            </tbody>
        </table>
        <h3>Total: ${{ $total }}</h3> <!-- Muestra el total -->
        
        <!-- Aquí se incluirá la gráfica -->
        <div>
            <canvas id="cartChart" width="200" height="200"></canvas> <!-- Tamaño ajustado -->
        </div>

        <form action="{{ route('removeAll') }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-primary">Comprar</button>
            <a href="{{ route('productos.privada') }}" class="btn btn-primary btn-back">Volver a la lista</a>

        </form>

    @else
        <p>No hay productos en tu carrito.</p>
        <a href="{{ route('productos.privada') }}" class="btn btn-primary btn-back">Volver a la lista</a>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Asegúrate de que $itemsCount esté correctamente inicializada en PHP
    var itemsCount = {{ $itemsCount ?? 0 }};  // Si $itemsCount no está definido, se usa 0 como valor predeterminado

    var ctx = document.getElementById('cartChart').getContext('2d');
    var cartChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Productos en Carrito', 'Espacio Vacío'],
            datasets: [{
                label: 'Carrito de Compras',
                data: [itemsCount, 100 - itemsCount], // Muestra la cantidad de productos y el espacio vacío
                backgroundColor: ['#36A2EB', '#FF6384'],
                borderColor: ['#36A2EB', '#FF6384'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false, // Añadido para controlar el tamaño
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            if (tooltipItem.label === 'Productos en Carrito') {
                                return 'Productos en Carrito: ' + tooltipItem.raw;
                            } else {
                                return 'Espacio Vacío: ' + tooltipItem.raw + '%';
                            }
                        }
                    }
                }
            },
            aspectRatio: 1, // Relación de aspecto 1:1
            layout: {
                padding: 20 // Espacio alrededor de la gráfica
            }
        }
    });
</script>
@endsection
