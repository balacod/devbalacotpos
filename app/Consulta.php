<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Utils\Util;
use DB;

class Consulta extends Model{

    protected $table = 'mascota_consulta';
    public $timestamps = false;
     protected $fillable = ['cliente_id', 'mascota_id','fecha_consulta','peso_mascota','titulo_consulta','observaciones','archivo_adjunto',
                            'status_consulta','observaciones_salida','fecha_salida','hora_entrada','hora_salida'];

}