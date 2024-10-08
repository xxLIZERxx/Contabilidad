<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura PDF</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Factura #{{ $invoice->invoice_number }}</h1>

    <p><strong>Cliente:</strong> {{ $invoice->client->name }}</p>
    <p><strong>Proveedor:</strong> {{ $invoice->provider->name }}</p>
    <p><strong>Total:</strong> Q{{ number_format($invoice->total, 2) }}</p>
    <p><strong>Estado:</strong> {{ ucfirst($invoice->status) }}</p>
    <p><strong>Método de Pago:</strong> {{ ucfirst($invoice->payment_method) }}</p>

    <h3>Detalles de la Factura</h3>
    <table>
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
                    <td>Q{{ number_format($detail->unit_price, 2) }}</td>
                    <td>Q{{ number_format($detail->subtotal, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
