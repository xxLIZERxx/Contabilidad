<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['name', 'nit', 'address', 'phone', 'email'];
    
    // Relaciones
    public function invoices() {
        return $this->hasMany(Invoice::class);
    }

    public function contracts() {
        return $this->hasMany(Contract::class);
    }
}