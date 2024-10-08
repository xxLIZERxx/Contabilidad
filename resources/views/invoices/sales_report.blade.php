@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Reporte de Ventas</h1>

    {{-- Formulario de filtros --}}
    <form action="{{ route('sales.report') }}" method="get">
        {{-- Filtro por fecha --}}
        <div class="form-group">
            <label for="start_date">Fecha de inicio</label>
            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
        </div>

        <div class="form-group">
            <label for="end_date">Fecha de fin</label>
            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
        </div>

        {{-- Filtro por cliente --}}
        <div class="form-group">
            <label for="client_id">Cliente</label>
            <select name="client_id" id="client_id" class="form-control">
                <option value="">Seleccione un cliente</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ request('client_id') == $client->id ? 'selected' : '' }}>
                        {{ $client->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Filtrar</button>

        {{-- Botón para imprimir el reporte en PDF --}}
        <a href="{{ route('sales.report.pdf', request()->all()) }}" class="btn btn-danger mt-3 ml-2">Imprimir Reporte</a>
    </form>

    <hr>

    {{-- Resultados del reporte --}}
    @if($invoices->isEmpty())
        <p>No se encontraron resultados para los filtros seleccionados.</p>
    @else
        <h3>Total de Ventas: Q{{ number_format($totalSales, 2) }}</h3>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Número de Factura</th>
                    <th>Cliente</th>
                    <th>Total</th>
                    <th>Fecha</th>
                    <th>Detalles</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoices as $invoice)
                    <tr>
                        <td>{{ $invoice->invoice_number }}</td>
                        <td>{{ $invoice->client->name }}</td>
                        <td>Q{{ number_format($invoice->total, 2) }}</td>
                        <td>{{ $invoice->created_at->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-info btn-sm">Ver Detalles</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
