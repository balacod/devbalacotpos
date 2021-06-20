<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Utils\Util;
use DB;

class Consulta extends Model{

    protected $table = 'mascota_consulta';
    public $timestamps = false;

}