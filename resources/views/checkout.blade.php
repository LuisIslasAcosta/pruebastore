@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Resumen de Pedido</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total = 0; // Inicializa el total
            @endphp
            @foreach (session('cart.items') as $item)
                <tr>
                    <td>{{ $item['nombre'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>${{ $item['price'] }}</td>
                    <td>${{ $item['price'] * $item['quantity'] }}</td>
                </tr>
                @php
                    $total += $item['price'] * $item['quantity'];
                @endphp
            @endforeach
        </tbody>
    </table>
    <h3>Total: ${{ $total }}</h3>
    
    <!-- Botón de Confirmación de Pedido -->
    <form action="{{ route('cart.checkout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Confirmar Pedido</button>
    </form>
</div>
@endsection
