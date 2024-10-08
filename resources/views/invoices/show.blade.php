@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Factura #{{ $invoice->invoice_number }}</h1>

    <p><strong>Cliente:</strong> {{ $invoice->client->name }}</p>
    <p><strong>Proveedor:</strong> {{ $invoice->provider->name }}</p>
    <p><strong>Total:</strong> {{ $invoice->total }}</p>
    <p><strong>Estado:</strong> {{ $invoice->status }}</p>
    <p><strong>Método de Pago:</strong> {{ ucfirst($invoice->payment_method) }}</p>

    <h3>Detalles de la Factura:</h3>
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
            @foreach($invoice->details as $detail)
                <tr>
                    <td>{{ $detail->product->name }}</td>
                    <td>{{ $detail->quantity }}</td>
                    <td>{{ number_format($detail->unit_price, 2) }}</td>
                    <td>{{ number_format($detail->subtotal, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
