<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'products_id',  // El campo en tu base de datos se llama `products_id`
        'description',
        'quantity',
        'unit_price',
        'subtotal'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'products_id');
    }
}
