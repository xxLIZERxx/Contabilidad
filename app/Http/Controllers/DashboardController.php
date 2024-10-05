<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\Contract;
use App\Models\Provider;
use App\Models\Product;

class DashboardController extends Controller
{
    /**
     * Muestra el dashboard principal.
     */
    public function index()
    {
        // Obtener estadísticas básicas para el dashboard
        $totalUsers = User::count(); // Total de usuarios
        $totalClients = Client::count(); // Total de clientes
        $totalProviders = Provider::count(); // Total de proveedores
        $totalProducts = Product::count(); // Total de productos
        $totalInvoices = Invoice::count(); // Total de facturas
        $totalContracts = Contract::count(); // Total de contratos

        // Pasar las estadísticas a la vista
        return view('dashboard.index', [
            'totalUsers' => $totalUsers,
            'totalClients' => $totalClients,
            'totalProviders' => $totalProviders,
            'totalProducts' => $totalProducts,
            'totalInvoices' => $totalInvoices,
            'totalContracts' => $totalContracts,
        ]);
    }
}
