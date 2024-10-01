<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['invoice_number', 'client_id', 'provider_id', 'user_id', 'total', 'tax', 'invoice_type', 'status'];
    
    // Relaciones
    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function details() {
        return $this->hasMany(InvoiceDetail::class);
    }

    public function taxes() {
        return $this->belongsToMany(Tax::class, 'invoice_taxes')->withPivot('tax_amount');
    }
} 