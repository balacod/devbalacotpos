@extends('layouts.app')
@section('title', __('home.home'))

@section('content')


<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Configuración Aparcadero</h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">       
        <div class="col-sm-12">
       		
        	<div class="col-xs-12 pos-tab-container">
           
	            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 pos-tab-menu">
	                <div class="list-group">
	                    <a href="#" class="list-group-item text-center active">Ajuste de Tarifa</a>
	                    <a href="#" class="list-group-item text-center">Zonas</a>
	                    <a href="#" class="list-group-item text-center">Vehiculo</a>
	                    <a href="#" class="list-group-item text-center">Estancia</a>
	                </div>
	            </div>

	            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 pos-tab">
	            	
	            	@include('parking.partials.tarifas')

        			<div class="pos-tab-content">
    					<div class="row">    
        					<h3>Ajuste de Zonas</h3>
        				</div>
        			</div>
        			<div class="pos-tab-content">
    					<div class="row">    
        					<h3>Ajuste de Vehiculo</h3>
        				</div>
        			</div>
        			<div class="pos-tab-content">
    					<div class="row">    
        					<h3>Ajuste Estadia</h3>
        				</div>
        			</div>

	            </div>
        	</div>    
        </div>   
    </div>
    <br>
</section>
@stop
@section('javascript')
<script type="text/javascript">
	$( document ).ready(function() {
		getTableTarifas();

	});
	function getTableTarifas(){
		$.ajax({
            method: 'get',
            // data: data,
            url: "{{ action('ParkController@listaTarifa') }}",
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
	}
</script>
@endsection