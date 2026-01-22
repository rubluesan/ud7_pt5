<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    //
    public function nombreApellidos() {
        return $this->nombre." ".$this->apellidos;
    }

    protected function casts(){
        return [
            'fechaN' => 'datetime:Y-m-d',
        ];
    }
}
