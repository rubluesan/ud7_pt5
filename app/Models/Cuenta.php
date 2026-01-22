<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    // Relationship: Una Cuenta pertenece a un Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
