<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    protected $fillable = ['name', 'rate'];

    // Relaciones
    public function invoices() {
        return $this->belongsToMany(Invoice::class, 'invoice_taxes')->withPivot('tax_amount');
    }
}