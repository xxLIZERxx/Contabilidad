@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Factura</h1>

    <form action="{{ route('invoices.store') }}" method="post">
        @csrf

            @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    

        {{-- Cliente --}}
        <div class="form-group">
            <label for="client_id">Cliente</label>
            <select class="form-control" id="client_id" name="client_id" required>
                <option value="">Seleccione un cliente</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Proveedor --}}
        <div class="form-group">
            <label for="provider_id">Proveedor</label>
            <select class="form-control" id="provider_id" name="provider_id" required>
                <option value="">Seleccione un proveedor</option>
                @foreach($providers as $provider)
                    <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Tipo de Factura --}}
        <div class="form-group">
            <label for="invoice_type">Tipo de Factura</label>
            <select class="form-control" id="invoice_type" name="invoice_type" required>
                <option value="">Seleccione el tipo de factura</option>
                <option value="pagada">Pagada</option>
                <option value="por cobrar">Por Cobrar</option>
            </select>
        </div>

        {{-- Tipo de Pago --}}
        <div class="form-group">
            <label for="payment_method">Tipo de Pago</label>
            <select class="form-control" id="payment_method" name="payment_method" required>
                <option value="efectivo">Efectivo</option>
                <option value="tarjeta">Tarjeta</option>
                <option value="deposito">Depósito</option>
            </select>
        </div>

        <div class="form-group">
            <label for="status">Estado</label>
            <select class="form-control" id="status" name="status" required>
                <option value="emitida">Emitida</option>
                <option value="anulada">Anulada</option>
                <option value="pagada">Pagada</option>
            </select>
        </div>
        


        {{-- Detalles de la Factura --}}
        <h3>Detalles de la Factura</h3>
        <div id="invoice-details">
            <div class="form-group">
                <label for="product_id">Producto</label>
                <select class="form-control" id="product_id">
                    <option value="">Seleccione un producto</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="quantity">Cantidad</label>
                <input type="number" class="form-control" id="quantity" min="1">
            </div>
            <button type="button" id="add-product" class="btn btn-primary mt-3">Añadir Producto</button>
        </div>

        {{-- Resumen de la Factura --}}
        <h3>Resumen de la Factura</h3>
        <table class="table table-bordered mt-3" id="invoice-summary">
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
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3"><strong>Subtotal</strong></td>
                    <td colspan="2" id="invoice-subtotal">0.00</td>
                </tr>
                <tr>
                    <td colspan="3"><strong>Total</strong></td>
                    <td colspan="2" id="invoice-total">0.00</td>
                </tr>
            </tfoot>
        </table>

        <button type="submit" class="btn btn-success mt-3">Crear Factura</button>
    </form>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const productSelect = document.getElementById('product_id');
        const quantityInput = document.getElementById('quantity');
        const addButton = document.getElementById('add-product');
        const summaryTable = document.getElementById('invoice-summary').querySelector('tbody');
        const subtotalDisplay = document.getElementById('invoice-subtotal');
        const totalDisplay = document.getElementById('invoice-total');
        
        let subtotal = 0;
        let invoiceItems = [];

        // Actualizar los totales
        function updateTotals() {
            subtotal = invoiceItems.reduce((acc, item) => acc + item.subtotal, 0);
            totalDisplay.innerText = subtotal.toFixed(2);
        }

        // Añadir productos a la tabla
        addButton.addEventListener('click', function () {
            const productId = productSelect.value;
            const selectedOption = productSelect.options[productSelect.selectedIndex];
            const productName = selectedOption.text;
            const unitPrice = parseFloat(selectedOption.getAttribute('data-price')) || 0;
            const quantity = parseInt(quantityInput.value) || 0;
            const productSubtotal = unitPrice * quantity;

            if (productId && quantity > 0) {
                const item = {
                    productId,
                    productName,
                    unitPrice,
                    quantity,
                    subtotal: productSubtotal,
                };
                invoiceItems.push(item);

                const newRow = document.createElement('tr');
                newRow.innerHTML = `
                    <td>${item.productName}</td>
                    <td>${item.quantity}</td>
                    <td>${item.unitPrice.toFixed(2)}</td>
                    <td>${item.subtotal.toFixed(2)}</td>
                    <td><button type="button" class="btn btn-danger remove-item">Eliminar</button></td>
                    <input type="hidden" name="products[${invoiceItems.length - 1}][product_id]" value="${item.productId}">
                    <input type="hidden" name="products[${invoiceItems.length - 1}][quantity]" value="${item.quantity}">
                    <input type="hidden" name="products[${invoiceItems.length - 1}][unit_price]" value="${item.unitPrice.toFixed(2)}">
                `;
                summaryTable.appendChild(newRow);

                updateTotals();

                // Limpiar los campos después de añadir
                productSelect.value = '';
                quantityInput.value = '';

                // Funcionalidad para eliminar productos
                newRow.querySelector('.remove-item').addEventListener('click', function () {
                    summaryTable.removeChild(newRow);
                    invoiceItems = invoiceItems.filter(i => i !== item);
                    updateTotals();
                });
            }
        });
    });
</script>
@endsection
