<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkLog extends Model
{
    protected $fillable = ['contract_id', 'user_id', 'worked_hours', 'work_date', 'description'];

    // Relaciones
    public function contract() {
        return $this->belongsTo(Contract::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}