<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    /**
     * Los atributos que son asignables.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'nit',
        'address',
        'phone',
        'email',
    ];

    // Relaciones
    public function invoices() {
        return $this->hasMany(Invoice::class);
    }

    public function contracts() {
        return $this->hasMany(Contract::class);
    }
}
