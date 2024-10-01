<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'product_service_id',
        'description',
        'quantity',
        'unit_price',
        'total',
    ];

    // Relación con la factura (un detalle pertenece a una factura)
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    // Relación opcional con un producto o servicio (si se facturan productos o servicios específicos)
    public function productService()
    {
        return $this->belongsTo(ProductService::class);
    }
}