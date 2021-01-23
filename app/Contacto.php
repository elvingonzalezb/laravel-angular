<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model {
    protected $fillable = [
        'user_id',
        'nombre',
        'apellido',
        'telefono',
        'email',
        'direccion',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

}
