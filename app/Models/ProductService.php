<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductService extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'type', // puede ser 'producto' o 'servicio'
    ];

    // Relación con los detalles de la factura (un producto/servicio puede estar en varios detalles)
    public function invoiceDetails()
    {
        return $this->hasMany(InvoiceDetail::class);
    }
}