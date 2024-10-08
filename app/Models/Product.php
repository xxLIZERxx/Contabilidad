<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category_id', 'price', 'description'];

    // Relación con la categoría
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

        // Relación con InvoiceDetail
        public function invoiceDetails()
        {
            return $this->hasMany(InvoiceDetail::class);
        }
}
