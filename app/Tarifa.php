<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarifa extends Model
{
    //

    protected $fillable = [
        'vehiculo_id',
        'zona_id',
        'estancia_id',
        'precio_hora',
        'tiempo_gracias'
    ];


    public function vehiculo(){
        return $this->belongsTo(Vehiculo::class,'vehiculo_id');
    }

    public function zona(){
        return $this->belongsTo(Zona::class,'zona_id');
    }

    public function estancia(){
        return $this->belongsTo(Estancia::class,'estancia_id');
    }
}
