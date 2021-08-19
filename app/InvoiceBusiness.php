<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceBusiness extends Model{

    protected $table = 'bala_invoice_business';
    public $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
                    'business_id', 
                            'identificacion',
                            'dv',
                            'registromercantil',
                            'direccion', 'telefono',
                            'tipo_documentacion',
                            'departamento',
                            'municipio',
                            'organizacion',
                            'regimen',
                            'token_api',
                            'status_api'
                        ];
}