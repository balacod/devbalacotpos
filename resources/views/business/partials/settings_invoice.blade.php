<div class="pos-tab-content">
    <div class="row">    
        <h3>Datos Facturador</h3>
        <input type="hidden" name="invoice_id" id="invoice_id" value="{{$invoiceBusiness->id}}">
        <div class="col-sm-4">
            <div class="form-group">
                <label>Identificación (NIT)</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fas fa-address-book"></i>
                    </span>
                    {!! Form::number('identificacion',$invoiceBusiness->identificacion, ['class' => 'form-control ','placeholder' => __('business.identificacion'),'id' => 'identificacion','maxlength'=>'8'] ); !!}
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>DV</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fas fa-clipboard-list"></i>
                    </span>
                    {!! Form::number('dv', $invoiceBusiness->dv, ['class' => 'form-control ','placeholder' => __('business.dv'),'id'=>'dv','maxlength'=>'1'] ); !!}
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>Registro Mercantil</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fas fa-clipboard-list"></i>
                    </span>
                    {!! Form::text('registro_mercantil', $invoiceBusiness->registromercantil, ['class' => 'form-control ','id'=>'registro_mercantil','placeholder' => 'Registro Mercantil'] ); !!}
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>Direccion</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fas fa-address-card"></i>
                    </span>
                    {!! Form::text('direccion', $invoiceBusiness->direccion, ['class' => 'form-control','id'=>'direccion','placeholder' => 'Direccion'] ); !!}
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>Telefono</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fas fas fa-phone"></i>
                    </span>
                    {!! Form::text('telefono', $invoiceBusiness->telefono,['class' => 'form-control','id'=>'telefono','placeholder' => 'Telefono'] ); !!}
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>Tipo Documentacion</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fas fa-file-alt"></i>
                    </span>
                    {!! Form::select('tipo_documento',array_pluck($documenteType,'name','id'),$invoiceBusiness->tipo_documentacion, ['id'=>'tipo_documento','class' => 'form-control ','placeholder' => 'Seleccione tipo'] ); !!}
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>Departamento</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fas fa-file-alt"></i>
                    </span>
                    {!! Form::select('departamento',
                        array_pluck($department,'name','id'),
                        $invoiceBusiness->departamento,
                        ['id'=>'departamento','class' => 'form-control ','onchange' => 'selectDepto(this.value)' ] ); !!}
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group" id="municipioSelect">
                <label>Municipio</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fas fa-file-alt"></i>
                    </span>
                    {!! Form::select('municipio',array_pluck($municipalities,'name','id'),$invoiceBusiness->municipio, ['id'=>'municipio','class' => 'form-control ','placeholder' => 'Seleccione municipio'] ); !!}
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>Organizacion</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fas fa-file-alt"></i>
                    </span>
                    {!! Form::select('organizacion',array_pluck($typeOrganization,'name','id'),$invoiceBusiness->organizacion, ['class' => 'form-control','id'=>'organizacion','placeholder' => 'Seleccione organizacion'] ); !!}
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>Regimen</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fas fa-file-alt"></i>
                    </span>
                    {!! Form::select('regimen',array_pluck($typeRegime,'name','id'),$invoiceBusiness->regimen, ['id'=>'regimen','class' => 'form-control ','placeholder' => 'Seleccione regimen'] ); !!}
                </div>
            </div>
        </div>        
        <div class="clearfix"></div>
        <div class="col-xs-12 test_company_btn @if($invoiceBusiness->status_api) hide @endif">
            <button type="button" class="btn btn-primary pull-right" id="test_company_btn">Enviar Configuración Empresa</button>
        </div>
    </div>
</div>

@section('javascript')
<script type="text/javascript">

     $('#test_company_btn').click( function() {
        var data = { 
            invoice_id: $('#invoice_id').val(),
            regimen: $('#regimen').val(),
            organizacion: $("#organizacion").val(),
            municipio: $("#municipio").val(),
            departamento: $("#departamento").val(),
            tipo_documento: $("#tipo_documento").val(),
            telefono: $("#telefono").val(),
            direccion: $("#direccion").val(),
            registro_mercantil: $("#registro_mercantil").val(),
            dv: $("#dv").val(),
            identificacion: $("#identificacion").val(),
        };
    
        $.ajax({
            method: 'post',
            data: data,
            url: "{{ action('BusinessController@saveCompanyInvoice') }}",
            dataType: 'json',
            success: function(result) {
                if (result.success == true) {
                    swal({
                        text: result.msg,
                        icon: 'success'
                    });
                } else {
                    swal({
                        text: result.msg,
                        icon: 'error'
                    });
                }
            },
        });
    });

</script>
@endsection