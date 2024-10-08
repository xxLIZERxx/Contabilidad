{{-- resources/views/invoices/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Factura</h1>

    <form action="{{ route('invoices.update', $invoice->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Número de Factura (Automático, solo muestra el valor generado) --}}
        <div class="form-group">
            <label for="invoice_number">Número de Factura</label>
            <input type="text" class="form-control" id="invoice_number" name="invoice_number" value="{{ $invoice->invoice_number }}" readonly>
        </div>

        {{-- Cliente --}}
        <div class="form-group">
            <label for="client_id">Cliente</label>
            <select class="form-control" id="client_id" name="client_id" required>
                <option value="">Seleccione un cliente</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ $invoice->client_id == $client->id ? 'selected' : '' }}>
                        {{ $client->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Proveedor --}}
        <div class="form-group">
            <label for="provider_id">Proveedor</label>
            <select class="form-control" id="provider_id" name="provider_id" required>
                <option value="">Seleccione un proveedor</option>
                @foreach($providers as $provider)
                    <option value="{{ $provider->id }}" {{ $invoice->provider_id == $provider->id ? 'selected' : '' }}>
                        {{ $provider->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Tipo de Factura --}}
        <div class="form-group">
            <label for="invoice_type">Tipo de Factura</label>
            <select class="form-control" id="invoice_type" name="invoice_type" required>
                <option value="A" {{ $invoice->invoice_type == 'A' ? 'selected' : '' }}>Pagada</option>
                <option value="C" {{ $invoice->invoice_type == 'C' ? 'selected' : '' }}>Por Cobrar</option>
                <option value="D" {{ $invoice->invoice_type == 'D' ? 'selected' : '' }}>Depósito</option>
            </select>
        </div>

        {{-- Estado --}}
        <div class="form-group">
            <label for="status">Estado</label>
            <select class="form-control" id="status" name="status" required>
                <option value="PAGADA" {{ $invoice->status == 'PAGADA' ? 'selected' : '' }}>Pagada</option>
                <option value="POR COBRAR" {{ $invoice->status == 'POR COBRAR' ? 'selected' : '' }}>Por Cobrar</option>
                <option value="DEPOSITO" {{ $invoice->status == 'DEPOSITO' ? 'selected' : '' }}>Depósito</option>
            </select>
        </div>

        {{-- Detalles de la Factura --}}
        <h3>Detalles de la Factura</h3>
        @foreach($invoice->details as $index => $detail)
        <div class="form-group">
            <label for="product_service_id_{{ $index }}">Producto o Servicio</label>
            <select class="form-control" id="product_service_id_{{ $index }}" name="details[{{ $index }}][product_service_id]" required>
                <option value="">Seleccione un producto/servicio</option>
                @foreach($productsServices as $productService)
                    <option value="{{ $productService->id }}" {{ $detail->product_service_id == $productService->id ? 'selected' : '' }}>
                        {{ $productService->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Cantidad --}}
        <div class="form-group">
            <label for="quantity_{{ $index }}">Cantidad</label>
            <input type="number" class="form-control" id="quantity_{{ $index }}" name="details[{{ $index }}][quantity]" step="1" value="{{ $detail->quantity }}" required>
        </div>

        {{-- Precio Unitario --}}
        <div class="form-group">
            <label for="unit_price_{{ $index }}">Precio Unitario</label>
            <input type="number" class="form-control" id="unit_price_{{ $index }}" name="details[{{ $index }}][unit_price]" step="0.01" value="{{ $detail->unit_price }}" required>
        </div>
        @endforeach

        {{-- Subtotal y Total --}}
        <div class="form-group">
            <label for="subtotal">Subtotal</label>
            <input type="number" class="form-control" id="subtotal" name="subtotal" step="0.01" value="{{ $invoice->subtotal }}" readonly>
        </div>

        <div class="form-group">
            <label for="total">Total (Incluye IVA 12%)</label>
            <input type="number" class="form-control" id="total" name="total" step="0.01" value="{{ $invoice->total }}" readonly>
        </div>

        <button type="submit" class="btn btn-success mt-3">Actualizar Factura</button>
    </form>
</div>

<script>
    // Calcula automáticamente el subtotal y el total cuando cambian la cantidad o el precio unitario
    document.querySelectorAll('input[id^="quantity_"], input[id^="unit_price_"]').forEach(input => {
        input.addEventListener('input', function() {
            let subtotal = 0;
            document.querySelectorAll('input[id^="quantity_"]').forEach((quantityInput, index) => {
                const quantity = parseFloat(quantityInput.value) || 0;
                const price = parseFloat(document.querySelector(`#unit_price_${index}`).value) || 0;
                subtotal += quantity * price;
            });

            const iva = subtotal * 0.12;
            const total = subtotal + iva;

            document.getElementById('subtotal').value = subtotal.toFixed(2);
            document.getElementById('total').value = total.toFixed(2);
        });
    });
</script>
@endsection
