<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Utils\Util;
use DB;

class Mascota extends Model{

    protected $table = 'mascota';
    protected $fillable = ['cliente_id', 'nombre','especie','raza','edad','color','sexo',
                            'tratamiento',
                            'nombre_tratamiento',
                            'alergico',
                            'ojos' ,
                            'oidos',
                            'piel',
                            'pulgas_garrapatas',
                            'agresivo',
                            'sociable',
                            'nombre_collar',
                            'desparasitado' ,];
    

}