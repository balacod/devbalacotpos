<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConfiguracionTiempo extends Model
{
    //

    protected $fillable = [
        'nombre',
        'precio',
        'tiempo'
    ];
}
