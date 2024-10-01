<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = ['client_id', 'user_id', 'service_description', 'contract_date', 'contract_end_date', 'amount', 'status'];
    
    // Relaciones
    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function workLogs() {
        return $this->hasMany(WorkLog::class);
    }
}
