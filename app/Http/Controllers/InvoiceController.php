<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Client;
use App\Models\Provider;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class InvoiceController extends Controller
{
    public function create()
    {
        $clients = Client::all();
        $providers = Provider::all();
        $products = Product::all();

        return view('invoices.create', compact('clients', 'providers', 'products'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
       // dd('Conexión a la base de datos exitosa'); 
        // Validar los datos enviados desde el formulario
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'provider_id' => 'required|exists:providers,id',
            'invoice_type' => 'required|in:pagada,por cobrar',
            'status' => 'required|in:emitida,anulada,pagada',
            'payment_method' => 'required|in:efectivo,tarjeta,deposito',
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.unit_price' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            // Calcular el total
            $total = 0;
            foreach ($request->products as $productData) {
                $total += $productData['unit_price'] * $productData['quantity'];
            }

            //dd($total);

            // Crear la factura
            $invoice = Invoice::create([
                'client_id' => $request->client_id,
                'provider_id' => $request->provider_id,
                'user_id' => Auth::id(),
                'invoice_number' => 'A-' . strtoupper(uniqid()), // Generar número único
                'total' => $total,
                'invoice_type' => $request->invoice_type,
                'status' => $request->status ?? 'emitida',  // Por defecto 'emitida'
                'payment_method' => $request->payment_method,
            ]);

            //dd($invoice);

            // Guardar los detalles de la factura
            foreach ($request->products as $productData) {
                InvoiceDetail::create([
                    'invoice_id' => $invoice->id,
                    'products_id' => $productData['product_id'],  // La base de datos usa `products_id`
                    'quantity' => $productData['quantity'],
                    'unit_price' => $productData['unit_price'],
                    'subtotal' => $productData['unit_price'] * $productData['quantity'],
                    'description' => $productData['description'] ?? 'Sin descripción',
                ]);
            }

            DB::commit();

            return redirect()->route('invoices.index')->with('success', 'Factura creada exitosamente.');

        } catch (\Throwable $e) {
            // Rollback y captura del error
            DB::rollBack();
            // Mostrar error en pantalla para depuración
            dd('Error: ' . $e->getMessage()); 
        }
    }

    // Método para mostrar todas las facturas
    public function index()
    {
        $invoices = Invoice::with('client', 'provider', 'details')->get();
        return view('invoices.index', compact('invoices'));
    }

    // Método para mostrar una factura en detalle
    public function show($id)
    {
        // Busca la factura por su ID
        $invoice = Invoice::with('client', 'provider', 'details.product')->findOrFail($id);

        // Retorna la vista de detalles de la factura
        return view('invoices.show', compact('invoice'));
    }

    public function edit($id)
    {
        // Buscar la factura por su ID
        $invoice = Invoice::with('details')->findOrFail($id);

        // Obtener los clientes, proveedores y productos para rellenar el formulario de edición
        $clients = Client::all();
        $providers = Provider::all();
        $products = Product::all();

        // Retornar la vista de edición con los datos necesarios
        return view('invoices.edit', compact('invoice', 'clients', 'providers', 'products'));
    }

    public function update(Request $request, $id)
    {
        // Validar los datos enviados desde el formulario
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'provider_id' => 'required|exists:providers,id',
            'invoice_type' => 'required|in:pagada,por cobrar',
            'status' => 'required|in:emitida,anulada,pagada',
            'payment_method' => 'required|in:efectivo,tarjeta,deposito',
            'details' => 'required|array',
            'details.*.product_service_id' => 'required|exists:products,id',
            'details.*.quantity' => 'required|integer|min:1',
            'details.*.unit_price' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {
            // Encontrar la factura existente
            $invoice = Invoice::findOrFail($id);

            // Actualizar la información básica de la factura
            $invoice->update([
                'client_id' => $request->client_id,
                'provider_id' => $request->provider_id,
                'invoice_type' => $request->invoice_type,
                'status' => $request->status,
                'payment_method' => $request->payment_method,
            ]);

            // Borrar los detalles existentes
            $invoice->details()->delete();

            // Crear los nuevos detalles de la factura
            foreach ($request->details as $detail) {
                InvoiceDetail::create([
                    'invoice_id' => $invoice->id,
                    'products_id' => $detail['product_service_id'],
                    'quantity' => $detail['quantity'],
                    'unit_price' => $detail['unit_price'],
                    'subtotal' => $detail['unit_price'] * $detail['quantity'],
                ]);
            }

            DB::commit();

            return redirect()->route('invoices.index')->with('success', 'Factura actualizada correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al actualizar la factura: ' . $e->getMessage());
        }


    }

    public function destroy($id)
    {
        try {
            // Buscar la factura por su ID
            $invoice = Invoice::findOrFail($id);
            
            // Eliminar los detalles de la factura primero (si hay relación de cascada en la base de datos, este paso no es necesario)
            $invoice->details()->delete();

            // Eliminar la factura
            $invoice->delete();

            // Redireccionar a la lista de facturas con un mensaje de éxito
            return redirect()->route('invoices.index')->with('success', 'Factura eliminada correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('invoices.index')->with('error', 'Error al eliminar la factura: ' . $e->getMessage());
        }
    }


    public function downloadPDF($id)
    {
        // Cargar la factura con sus relaciones
        $invoice = Invoice::with('client', 'provider', 'details.product')->findOrFail($id);

        // Renderizar la vista en PDF
        $pdf = PDF::loadView('invoices.pdf', compact('invoice'));

        // Descargar el PDF
        return $pdf->download('Factura_' . $invoice->invoice_number . '.pdf');
    }

    public function salesReport(Request $request)
    {
        // Obtener todos los clientes
        $clients = Client::all();
    
        // Verificar si el usuario filtró por fecha o cliente
        $query = Invoice::with('client', 'details.product');
    
        // Filtrar por fecha si se proporcionan las fechas
        if ($request->filled('start_date') && $request->has('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }
    
        // Filtrar por cliente si se proporciona el cliente
        if ($request->filled('client_id')) {
            $query->where('client_id', $request->client_id);
        }
    
        // Obtener todas las facturas filtradas
        $invoices = $query->get();
    
        // Calcular el total de ventas
        $totalSales = $invoices->sum('total');
    
        // Pasar las variables a la vista
        return view('invoices.sales_report', compact('invoices', 'totalSales', 'clients'));
    }
    

    public function salesReportPDF(Request $request)
    {
        // Reutilizar la lógica del método salesReport para obtener los datos filtrados
        $query = Invoice::with('client', 'details.product');

        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        if ($request->has('client_id')) {
            $query->where('client_id', $request->client_id);
        }

        $invoices = $query->get();
        $totalSales = $invoices->sum('total');

        // Renderizar la vista en PDF
        $pdf = PDF::loadView('invoices.sales_report_pdf', compact('invoices', 'totalSales'));

        // Descargar el archivo PDF
        return $pdf->download('reporte_ventas.pdf');
    }



}
