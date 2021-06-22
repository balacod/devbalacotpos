@extends('layouts.app')
@section('title', __('contact.view_contact'))

@section('content')

<!-- Main content -->
<section class="content no-print">
    <div class="row no-print">
        <div class="col-md-4">
            @if(!empty($view_type) &&  $view_type == 'vet')
                <h3 style="display: inline-block;">Lista de Mascotas</h3> 
                <button style="display: inline-block; margin-bottom: 15px;margin-left: 44px;" onclick="addMascota()" data-backdrop="static"  data-keyboard="false" data-toggle="modal" data-target="#add-mascota" class="btn btn-primary" type="button"> <li class="fas fa-plus-circle fa-lg"></li> Mascota</button>
            @else
                <h3>@lang('contact.view_contact')</h3>
            @endif
        </div>
        <div class="col-md-4 col-xs-12 mt-15 pull-right">
            {!! Form::select('contact_id', $contact_dropdown, $contact->id , ['class' => 'form-control select2', 'id' => 'contact_id']); !!}
        </div>
    </div>
    <div class="hide print_table_part">
        <style type="text/css">
            .info_col {
                width: 25%;
                float: left;
                padding-left: 10px;
                padding-right: 10px;
            }
        </style>
        <div style="width: 100%;">
            <div class="info_col">
                @include('contact.contact_basic_info')
            </div>
            <div class="info_col">
                @include('contact.contact_more_info')
            </div>
            @if( $contact->type != 'customer')
                <div class="info_col">
                    @include('contact.contact_tax_info')
                </div>
            @endif
            <div class="info_col">
                @include('contact.contact_payment_info')
            </div>
        </div>
    </div>
    <input type="hidden" id="sell_list_filter_customer_id" value="{{$contact->id}}">
    <input type="hidden" id="purchase_list_filter_supplier_id" value="{{$contact->id}}">
    <br>
    @if(!empty($view_type) &&  $view_type == 'vet')

       <table class="table table-striped" id="tabla-mascotas">
           <thead>
               <tr>
                   <th>Mascota</th>
                   <th>Especie</th>
                   <th>Raza</th>
                   <th>Color</th>
                   <th>Sexo</th>
                   <th>Tratamiento</th>
                   <th>Nombre <br> Tratamiento</th>
                   <th>Agresivo</th>
                   <th>Sociable</th>
                   <th>Acciones</th>
               </tr>
           </thead>
           <tbody>
           </tbody>
       </table>
    @else
        <div class="row">
            <div class="col-md-12">
                <div class="box box-solid">
                    <div class="box-body">
                        @include('contact.partials.contact_info_tab')
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs nav-justified">
                        <li class="
                                @if(!empty($view_type) &&  $view_type == 'ledger')
                                    active
                                @else
                                    ''
                                @endif">
                            <a href="#ledger_tab" data-toggle="tab" aria-expanded="true"><i class="fas fa-scroll" aria-hidden="true"></i> @lang('lang_v1.ledger')</a>
                        </li>
                        @if(in_array($contact->type, ['both', 'supplier']))
                            <li class="
                                @if(!empty($view_type) &&  $view_type == 'purchase')
                                    active
                                @else
                                    ''
                                @endif">
                                <a href="#purchases_tab" data-toggle="tab" aria-expanded="true"><i class="fas fa-arrow-circle-down" aria-hidden="true"></i> @lang( 'purchase.purchases')</a>
                            </li>
                            <li class="
                                @if(!empty($view_type) &&  $view_type == 'stock_report')
                                    active
                                @else
                                    ''
                                @endif">
                                <a href="#stock_report_tab" data-toggle="tab" aria-expanded="true"><i class="fas fa-hourglass-half" aria-hidden="true"></i> @lang( 'report.stock_report')</a>
                            </li>
                        @endif
                        @if(in_array($contact->type, ['both', 'customer']))
                            <li class="
                                @if(!empty($view_type) &&  $view_type == 'sales')
                                    active
                                @else
                                    ''
                                @endif">
                                <a href="#sales_tab" data-toggle="tab" aria-expanded="true"><i class="fas fa-arrow-circle-up" aria-hidden="true"></i> @lang( 'sale.sells')</a>
                            </li>
                            @if(in_array('subscription', $enabled_modules))
                                <li class="
                                    @if(!empty($view_type) &&  $view_type == 'subscriptions')
                                        active
                                    @else
                                        ''
                                    @endif">
                                    <a href="#subscriptions_tab" data-toggle="tab" aria-expanded="true"><i class="fas fa-recycle" aria-hidden="true"></i> @lang( 'lang_v1.subscriptions')</a>
                                </li>
                            @endif
                        @endif
                        <li class="
                                @if(!empty($view_type) &&  $view_type == 'documents_and_notes')
                                    active
                                @else
                                    ''
                                @endif
                                ">
                            <a href="#documents_and_notes_tab" data-toggle="tab" aria-expanded="true"><i class="fas fa-paperclip" aria-hidden="true"></i> @lang('lang_v1.documents_and_notes')</a>
                        </li>
                        <li class="
                                @if(!empty($view_type) &&  $view_type == 'payments')
                                    active
                                @else
                                    ''
                                @endif">
                            <a href="#payments_tab" data-toggle="tab" aria-expanded="true"><i class="fas fa-money-bill-alt" aria-hidden="true"></i> @lang('sale.payments')</a>
                        </li>

                        @if( in_array($contact->type, ['customer', 'both']) && session('business.enable_rp'))
                            <li class="
                                @if(!empty($view_type) &&  $view_type == 'reward_point')
                                    active
                                @else
                                    ''
                                @endif">
                                <a href="#reward_point_tab" data-toggle="tab" aria-expanded="true"><i class="fas fa-gift" aria-hidden="true"></i> {{ session('business.rp_name') ?? __( 'lang_v1.reward_points')}}</a>
                            </li>
                        @endif

                        <li class="
                            @if(!empty($view_type) &&  $view_type == 'activities')
                                active
                            @else
                                ''
                            @endif">
                            <a href="#activities_tab" data-toggle="tab" aria-expanded="true"><i class="fas fa-pen-square" aria-hidden="true"></i> @lang('lang_v1.activities')</a>
                            </li>

                        @if(!empty($contact_view_tabs))
                            @foreach($contact_view_tabs as $key => $tabs)
                                @foreach ($tabs as $index => $value)
                                    @if(!empty($value['tab_menu_path']))
                                        @php
                                            $tab_data = !empty($value['tab_data']) ? $value['tab_data'] : [];
                                        @endphp
                                        @include($value['tab_menu_path'], $tab_data)
                                    @endif
                                @endforeach
                            @endforeach
                        @endif

                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane
                                    @if(!empty($view_type) &&  $view_type == 'ledger')
                                        active
                                    @else
                                        ''
                                    @endif"
                                id="ledger_tab">
                            @include('contact.partials.ledger_tab')
                        </div>
                        @if(in_array($contact->type, ['both', 'supplier']))
                            <div class="tab-pane
                                @if(!empty($view_type) &&  $view_type == 'purchase')
                                    active
                                @else
                                    ''
                                @endif"
                            id="purchases_tab">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            {!! Form::label('purchase_list_filter_date_range', __('report.date_range') . ':') !!}
                                            {!! Form::text('purchase_list_filter_date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']); !!}
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        @include('purchase.partials.purchase_table')
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane 
                                @if(!empty($view_type) &&  $view_type == 'stock_report')
                                    active
                                @else
                                    ''
                                @endif" id="stock_report_tab">
                                @include('contact.partials.stock_report_tab')
                            </div>
                        @endif
                        @if(in_array($contact->type, ['both', 'customer']))
                            <div class="tab-pane 
                                @if(!empty($view_type) &&  $view_type == 'sales')
                                    active
                                @else
                                    ''
                                @endif"
                            id="sales_tab">
                                <div class="row">
                                    <div class="col-md-12">
                                        @component('components.widget')
                                            @include('sell.partials.sell_list_filters', ['only' => ['sell_list_filter_payment_status', 'sell_list_filter_date_range', 'only_subscriptions']])
                                        @endcomponent
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        @include('sale_pos.partials.sales_table')
                                    </div>
                                </div>
                            </div>
                            @if(in_array('subscription', $enabled_modules))
                                @include('contact.partials.subscriptions')
                            @endif
                        @endif
                        <div class="tab-pane
                                @if(!empty($view_type) &&  $view_type == 'documents_and_notes')
                                    active
                                @else
                                    ''
                                @endif"
                            id="documents_and_notes_tab">
                            @include('contact.partials.documents_and_notes_tab')
                        </div>
                        <div class="tab-pane 
                            @if(!empty($view_type) &&  $view_type == 'payments')
                                active
                            @else
                                ''
                            @endif" id="payments_tab">
                            <div id="contact_payments_div" style="height: 500px;overflow-y: scroll;"></div>
                        </div>
                        @if( in_array($contact->type, ['customer', 'both']) && session('business.enable_rp'))
                            <div class="tab-pane
                                @if(!empty($view_type) &&  $view_type == 'reward_point')
                                    active
                                @else
                                    ''
                                @endif"
                            id="reward_point_tab">
                            <br>
                                <div class="row">
                                @if($reward_enabled)
                                    <div class="col-md-3">
                                        <div class="info-box bg-yellow">
                                            <span class="info-box-icon"><i class="fa fa-gift"></i></span>

                                            <div class="info-box-content">
                                              <span class="info-box-text">{{session('business.rp_name')}}</span>
                                              <span class="info-box-number">{{$contact->total_rp ?? 0}}</span>
                                            </div>
                                            <!-- /.info-box-content -->
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped" 
                                        id="rp_log_table" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>@lang('messages.date')</th>
                                                    <th>@lang('sale.invoice_no')</th>
                                                    <th>@lang('lang_v1.earned')</th>
                                                    <th>@lang('lang_v1.redeemed')</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            </div>
                        @endif

                        <div class="tab-pane"
                            id="activities_tab">
                            @include('activity_log.activities')
                        </div>

                        @if(!empty($contact_view_tabs))
                            @foreach($contact_view_tabs as $key => $tabs)
                                @foreach ($tabs as $index => $value)
                                    @if(!empty($value['tab_content_path']))
                                        @php
                                            $tab_data = !empty($value['tab_data']) ? $value['tab_data'] : [];
                                        @endphp
                                        @include($value['tab_content_path'], $tab_data)
                                    @endif
                                @endforeach
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
</section>

<div class="modal fade" id="add-mascota"  role="dialog" >
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" onclick="closemodal()" data-dismiss="modal">&times;</button>
                <h5 class="modal-title" id="titleModal"></h5>
            </div>
            <form id="formMascota" method="post">
            <input type="hidden" name="idcliente" value="{{$contact->id}}">
            <input type="hidden" name="idmas" id="idmas">
            <div class="modal-body" style="background: #ffffff;height: 320px !important;">

                <div class="row" >
                    <div class="col-xs-6 col-md-4">
                        <label>Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" >
                    </div>
                    <div class="col-xs-6 col-md-3">
                        <label>Especie</label>
                        <input type="text" name="especie" id="especie" class="form-control">
                    </div>
                    <div class="col-xs-6 col-md-3">
                        <label>Raza</label>
                        <input type="text" name="raza" id="raza" class="form-control">
                    </div>
                    <div class="col-xs-6 col-md-2">
                        <label>Edad</label>
                        <input type="number" name="edad" id="edad" class="form-control">
                    </div>                    
                </div>

                <div class="row" >
                    <div class="col-xs-6 col-md-2">
                        <label>color</label>
                        <input type="text" name="color" id="color" class="form-control">
                    </div>
                    <div class="col-xs-6 col-md-3">
                        <label>sexo</label>
                        <select class="form-control" id="sexo" name="sexo">
                            <option selected="selected" hidden disabled >selecione sexo</option>
                            <option value="M">Macho</option>
                            <option value="H">Hembra</option>
                        </select>
                    </div>                
                    <div class="col-xs-6 col-md-2 checkbox">
                        <label class="checkbox-inline tratamiento"><input type="checkbox" name="tratamiento" id="tratamiento" name="tratamiento">tratamiento</label>
                    </div>
                    <div class="col-xs-6 col-md-5" id="divTratamiento">
                        <label>Nombre tratamiento</label>
                        <input type="text" name="nombre_tratamiento" id="nombre_tratamiento" class="form-control">
                    </div>
                
                </div>
                <div class="row" >
                    <div class="col-xs-6 col-md-3">
                        <label>Alergico a</label>
                        <input type="text" name="alergico" id="alergico" class="form-control">
                    </div>
                    <div class="col-xs-6 col-md-3">
                        <label>Ojos</label>
                        <input type="text" name="ojos" id="ojos" class="form-control">
                    </div>
                    <div class="col-xs-6 col-md-3">
                        <label>Oidos</label>
                        <input type="text" name="oidos" id="oidos" class="form-control">
                    </div>
                    <div class="col-xs-6 col-md-3">
                        <label>Piel</label>
                        <input type="text" name="piel" id="piel" class="form-control">
                    </div>                    
                </div>
                <div class="row" >
                    <div class="col-xs-6 col-md-4">
                        <label>Pulgas y/o Garrapatas</label>
                        <input type="text" name="pulgas_garrapatas" id="pulgas_garrapatas" class="form-control">
                    </div>
                    <div class="col-xs-6 col-md-4">
                        <label>Nombre collar</label>
                        <input type="text" name="collar_nombre" id="collar_nombre" class="form-control">
                    </div>
                    <div class="col-xs-6 col-md-4 checkbox">
                        <label class="checkbox-inline"><input type="checkbox" id="desparacitado" name="desparacitado" name="desparacitado" >Desparacitado</label>
                        <label class="checkbox-inline"><input type="checkbox" id="agresivo" name="agresivo" name="agresivo" >Agresivo</label>
                        <label style="left: 50px;" class="checkbox-inline"><input id="sociable" type="checkbox" name="sociable" name="sociable" >Sociable</label>
                    </div>
                </div>
            
                <br>
                <div class="row" >
                    <div class="col-xs-6 col-md-8">
                    </div>
                    <div class="col-xs-6 col-md-4 pull-rightt">
                        <button class="btn btn-primary" type="button" onclick="guardaMascota()">Guardar</button>
                        <button class="btn btn-danger" type="button" onclick="cancelarAltaMascota()">Cancelar</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- /.content -->
<div class="modal fade payment_modal" tabindex="-1" role="dialog" 
        aria-labelledby="gridSystemModalLabel">
</div>
<div class="modal fade edit_payment_modal" tabindex="-1" role="dialog" 
    aria-labelledby="gridSystemModalLabel">
</div>

<div class="modal fade pay_contact_due_modal" tabindex="-1" role="dialog" 
        aria-labelledby="gridSystemModalLabel"></div>

<style type="text/css">
    .pull-rightt {
    float: right!important;
    right: -80px !important;
}
</style>
@stop
@section('javascript')
<script type="text/javascript">
$(document).ready( function(){
    $('#nombre').keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });  
    $('#especie').keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });  
    $('#raza').keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });  
    $('#color').keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });  
    $('#nombre_tratamiento').keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });
    $('#alergico ').keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });
    $('#ojos').keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });
    $('#piel').keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });
    $('#oidos').keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });
    $('#pulgas_garrapatas').keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });
    $('#collar_nombre').keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });

    $('#divTratamiento').hide();

    $('#ledger_date_range').daterangepicker(
        dateRangeSettings,
        function (start, end) {
            $('#ledger_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
        }
    );
    $('#ledger_date_range').change( function(){
        get_contact_ledger();
    });
    get_contact_ledger();

    rp_log_table = $('#rp_log_table').DataTable({
        processing: true,
        serverSide: true,
        aaSorting: [[0, 'desc']],
        ajax: '/sells?customer_id={{ $contact->id }}&rewards_only=true',
        columns: [
            { data: 'transaction_date', name: 'transactions.transaction_date'  },
            { data: 'invoice_no', name: 'transactions.invoice_no'},
            { data: 'rp_earned', name: 'transactions.rp_earned'},
            { data: 'rp_redeemed', name: 'transactions.rp_redeemed'},
        ]
    });

    supplier_stock_report_table = $('#supplier_stock_report_table').DataTable({
        processing: true,
        serverSide: true,
        'ajax': {
            url: "{{action('ContactController@getSupplierStockReport', [$contact->id])}}",
            data: function (d) {
                d.location_id = $('#sr_location_id').val();
            }
        },
        columns: [
            { data: 'product_name', name: 'p.name'  },
            { data: 'sub_sku', name: 'v.sub_sku'  },
            { data: 'purchase_quantity', name: 'purchase_quantity', searchable: false},
            { data: 'total_quantity_sold', name: 'total_quantity_sold', searchable: false},
            { data: 'total_quantity_returned', name: 'total_quantity_returned', searchable: false},
            { data: 'current_stock', name: 'current_stock', searchable: false},
            { data: 'stock_price', name: 'stock_price', searchable: false}
        ],
        fnDrawCallback: function(oSettings) {
            __currency_convert_recursively($('#supplier_stock_report_table'));
        },
    });

    $('#sr_location_id').change( function() {
        supplier_stock_report_table.ajax.reload();
    });

    $('#contact_id').change( function() {
        if ($(this).val()) {
            window.location = "{{url('/contacts')}}/" + $(this).val();
        }
    });

    $('a[href="#sales_tab"]').on('shown.bs.tab', function (e) {
        sell_table.ajax.reload();
    });

    $('.tratamiento').bind('change', function() {
        ischecket();
    });
   tablaMascotas();
});
function addMascota(){
    $("#titleModal").text('Agregar Mascota');
}
function tablaMascotas(){

    let tablamascota = $('#tabla-mascotas').DataTable();   

    let id = $("#sell_list_filter_customer_id").val();
    $.ajax({
        type: 'get',
        url: '/vet/list',
        dataType: 'json',
        data: {id:id},
        success: function(data){
        $('#tabla-mascotas').DataTable().clear().draw();
            
            data.datos.forEach(function (mascota){
                tablamascota.row.add( [
                    mascota.nombre,
                    mascota.especie,
                    mascota.raza,
                    mascota.color,
                    (mascota.sexo == "M") ? 'Macho' : 'Hembra',
                    (mascota.tratamiento == 1) ? 'Si' : 'No', 
                    mascota.nombre_tratamiento,
                    (mascota.agresivo == 1) ? 'Si' : 'No', 
                    (mascota.sociable == 1) ? 'Si' : 'No', 
                    '<button type="button" onclick="editarMascota('+mascota.id+')" data-backdrop="static"  data-keyboard="false" data-toggle="modal" data-target="#add-mascota" class="d-inline m-1 btn btn-danger btn-sm"><span class="glyphicon glyphicon-pencil"></span></button>'+
                    '<button type="button" onclick="consutas('+mascota.id+')" class="d-inline m-1 btn btn-primary btn-sm" title="consultas"> <span class="fa fa-heartbeat"></span></button>'+
                    '<button type="button" class="d-inline m-1 btn btn-success btn-sm" title="hoja de vida"><span class="fa fa-bars"></span></button>'

                ]).draw(); 
            });
            
        },
    });
}

function guardaMascota(){

    let datos = $("#formMascota").serialize();
     $.ajax({
        type: 'post',
        url: '/vet/store',
        dataType: 'json',
        data: datos,
        success: function(result){
            if(result.flag){
                alert('Mascota Registrada');
                $('#add-mascota').modal('toggle');
                $('#formMascota')[0].reset();
                tablaMascotas();
            }else{
                alert('No se registro la mascota, intente de nuevo');
            }
        },
    });
}

function editarMascota(idMascota){

    $("#titleModal").text('Editar Mascota');
    // $('#add-mascota').modal('show');

     $.ajax({
        type: 'get',
        url: '/vet/show',
        dataType: 'json',
        data: {id:idMascota},
        success: function(result){
            console.log(result);
            if(result.flag){

                $("#idmas").val(result.mascota.id);
                console.log($("#idmas").val());
                $("#nombre").val(result.mascota.nombre);
                $("#especie").val(result.mascota.especie);
                $("#raza").val(result.mascota.raza);
                $("#edad").val(result.mascota.edad);
                $("#color").val(result.mascota.color);
                if(result.mascota.tratamiento == 1){
                    console.log("si hay tratamiento");
                    document.getElementById("tratamiento").checked = true;
                    // $("#tratamiento").prop('checked', true); 
                    $("#nombre_tratamiento").val(result.mascota.nombre_tratamiento);
                    $('#divTratamiento').show(); 
                }else{
                    document.getElementById("tratamiento").checked = false;
                    // $("#tratamiento").prop('checked', false); 
                    $("#nombre_tratamiento").val('');
                    $('#divTratamiento').hide(); 
                }
                if(result.mascota.sexo == "M"){
                    $("#sexo option[value='M']").attr("selected", true);
                }else if(result.mascota.sexo == "H"){
                    $("#sexo option[value='H']").attr("selected", true);
                }
                $("#alergico").val(result.mascota.alergico);
                $("#ojos").val(result.mascota.ojos);
                $("#oidos").val(result.mascota.oidos);
                $("#piel").val(result.mascota.piel);
                $("#piel").val(result.mascota.piel);
                $("#pulgas_garrapatas").val(result.mascota.pulgas_garrapatas);
                $("#collar_nombre").val(result.mascota.nombre_collar);
                $("#collar_nombre").val(result.mascota.nombre_collar);
                if(result.mascota.desparasitado == 1){
                    document.getElementById("desparacitado").checked = true;
                }
                if(result.mascota.agresivo == 1){
                    document.getElementById("agresivo").checked = true;
                }
                if(result.mascota.sociable == 1){
                    document.getElementById("sociable").checked = true;
                }

            }else{
                
            }
        },
    });

}
function cancelarAltaMascota(){
    $('#add-mascota').modal('toggle');
    $('#formMascota')[0].reset();
}
function consutas(idmascota){

    window.location.href = "/vet/consultas/"+idmascota;
    
}
function closemodal(){
    $('#formMascota')[0].reset();
}
function ischecket(){
    $('.tratamiento').find(':checkbox').each(function(){
        if($(this).is(':checked')) {
            $('#divTratamiento').show();
        }else{
            $('#divTratamiento').hide();
        }
    }); 
}

$("input.transaction_types, input#show_payments").on('ifChanged', function (e) {
    get_contact_ledger();
});

$(document).one('shown.bs.tab', 'a[href="#payments_tab"]', function(){
    get_contact_payments();
})

$(document).on('click', '#contact_payments_pagination a', function(e){
    e.preventDefault();
    get_contact_payments($(this).attr('href'));
})

function get_contact_payments(url = null) {
    if (!url) {
        url = "{{action('ContactController@getContactPayments', [$contact->id])}}";
    }
    $.ajax({
        url: url,
        dataType: 'html',
        success: function(result) {
            $('#contact_payments_div').fadeOut(400, function(){
                $('#contact_payments_div')
                .html(result).fadeIn(400);
            });
        },
    });
}

function get_contact_ledger() {

    var start_date = '';
    var end_date = '';
    var transaction_types = $('input.transaction_types:checked').map(function(i, e) {return e.value}).toArray();
    var show_payments = $('input#show_payments').is(':checked');

    if($('#ledger_date_range').val()) {
        start_date = $('#ledger_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
        end_date = $('#ledger_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
    }
    $.ajax({
        url: '/contacts/ledger?contact_id={{$contact->id}}&start_date=' + start_date + '&transaction_types=' + transaction_types + '&show_payments=' + show_payments + '&end_date=' + end_date,
        dataType: 'html',
        success: function(result) {
            $('#contact_ledger_div')
                .html(result);
            __currency_convert_recursively($('#contact_ledger_div'));

            $('#ledger_table').DataTable({
                searching: false,
                ordering:false,
                paging:false,
                dom: 't'
            });
        },
    });
}

$(document).on('click', '#send_ledger', function() {
    var start_date = $('#ledger_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
    var end_date = $('#ledger_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');

    var url = "{{action('NotificationController@getTemplate', [$contact->id, 'send_ledger'])}}" + '?start_date=' + start_date + '&end_date=' + end_date;

    $.ajax({
        url: url,
        dataType: 'html',
        success: function(result) {
            $('.view_modal')
                .html(result)
                .modal('show');
        },
    });
})

$(document).on('click', '#print_ledger_pdf', function() {
    var start_date = $('#ledger_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
    var end_date = $('#ledger_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');

    var url = $(this).data('href') + '&start_date=' + start_date + '&end_date=' + end_date;
    window.open(url);
});

</script>
@include('sale_pos.partials.sale_table_javascript')
<script src="{{ asset('js/payment.js?v=' . $asset_v) }}"></script>
@if(in_array($contact->type, ['both', 'supplier']))
    <script src="{{ asset('js/purchase.js?v=' . $asset_v) }}"></script>
@endif

<!-- document & note.js -->
@include('documents_and_notes.document_and_note_js')
@if(!empty($contact_view_tabs))
    @foreach($contact_view_tabs as $key => $tabs)
        @foreach ($tabs as $index => $value)
            @if(!empty($value['module_js_path']))
                @include($value['module_js_path'])
            @endif
        @endforeach
    @endforeach
@endif

<script type="text/javascript">
    $(document).ready( function(){
        $('#purchase_list_filter_date_range').daterangepicker(
            dateRangeSettings,
            function (start, end) {
                $('#purchase_list_filter_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
               purchase_table.ajax.reload();
            }
        );
        $('#purchase_list_filter_date_range').on('cancel.daterangepicker', function(ev, picker) {
            $('#purchase_list_filter_date_range').val('');
            purchase_table.ajax.reload();
        });
    });
</script>
@include('sale_pos.partials.subscriptions_table_javascript', ['contact_id' => $contact->id])
@endsection
