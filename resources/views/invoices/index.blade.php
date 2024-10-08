@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Facturas</h1>
    <a href="{{ route('invoices.create') }}" class="btn btn-primary">Crear Factura</a>

    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>Número de Factura</th>
                <th>Cliente</th>
                <th>Total</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->invoice_number }}</td>
                    <td>{{ $invoice->client->name }}</td>
                    <td>{{ $invoice->total }}</td>
                    <td>{{ ucfirst($invoice->status) }}</td>
                    <td>
                        <!-- Botones de acción para ver y editar -->
                        <a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-info">Ver</a>
                        <a href="{{ route('invoices.edit', $invoice->id) }}" class="btn btn-warning">Editar</a>
                        <a href="{{ route('invoices.pdf', $invoice->id) }}" class="btn btn-warning">Descargar PDF</a>


                        <!-- Si deseas agregar la opción de eliminar una factura -->
                        <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta factura?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No se han encontrado facturas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
