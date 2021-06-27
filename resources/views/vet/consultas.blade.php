@extends('layouts.app')
@section('title', __('contact.view_contact'))

@section('content')


<section class="content">
    <div class="col-lg-12">
        <div class="row">
           <!--  <div class="col-lg-3 col-md-3">
                <div class="caixa-text">
                    <div class="img-top">
                        <p class="text-center base-ic"><i class="fas fa-cat fa-3x ic-top"></i></p>
                    </div>
                    <h3 class="text-center title-cixa">{{$mascota->nombre}}</h3>
            		<input type="hidden" name="idMacota" value="{{$mascota->id}}">
                    <br>
                </div>
            </div> -->
           
            <div class="col-lg-12 col-md-12" style="background-color: #ffff;">
                <div class="caixa-text text-center">
                	<input type="hidden" name="idmascota" id="idmascota" value="{{$mascota->id}}">
                	<h3 class="text-center title-cixa" style="display: inline-block;">Historia | {{$mascota->nombre}}</h3>
                	<button type="button"  class="btn btn-success btn-sm" id="btn-hoja-pdf">Hoja de Vida</button>
                    <ul class="nav nav-tabs">
					  <li class="active"><a data-toggle="tab" href="#historia">En Consulta</a></li>
					  <li><a data-toggle="tab" href="#consultar">Consultar</a></li>
					  <li><a data-toggle="tab" href="#linea">Linea de vida</a></li>
					</ul>

					<div class="tab-content">
					  <div id="historia" class="tab-pane fade in active">
					  	<br>
					    <table class="table table-striped" id="tabla-consultas">
				           <thead>
				               <tr>
				                   <th>Hora</th>
				                   <th>Fecha</th>
				                   <th>Titulo</th>
				                   <th>Peso</th>
				                   <th>Observaciones</th>
				                   <th>Acciones</th>
				               </tr>
				           </thead>
				           <tbody>
				           </tbody>
				        </table>
					  </div>
					  <div id="consultar" class="tab-pane fade">
					    <h4>Ingrese datos de consulta</h4>
					    <form id="formConsulta" name="formConsulta" method="post" enctype="multipart/form-data">
            				<input type="hidden" name="mascota_id" id="mascota_id" value="{{$mascota->id}}">
            				<input type="hidden" name="cliente_id" id="cliente_id" value="{{$mascota->cliente_id}}">
            				<div class="row">

            					<div class="col-xs-6 col-lg-2 col-md-2">
			                        <label>Hora</label>
            						<input type="time" name="hora" id="hora" class="form-control"> 
            					</div>
			                    <div class="col-xs-6 col-lg-3 col-md-3">
			                        <label>Fecha</label>
			                        <input type="date" name="fecha_consulta" id="fecha_consulta" class="form-control">
			                    </div>
			                    <div class="col-xs-6 col-lg-5 col-md-5">
			                        <label>Titulo</label>
			                        <input type="text" name="titulo_consulta" id="titulo_consulta" class="form-control">
			                    </div>
			                    <div class="col-xs-6 col-lg-2 col-md-2">
			                        <label>Peso</label>
			                        <input type="text" name="peso_consulta" id="peso_consulta" class="form-control">
			                    </div>
			                </div>
			                <div class="row">
			                	<div class="col-xs-6 col-lg-6 col-md-6">
			                        <label for="observaciones" style="display: flow-root;">Observaciones</label>
              						<textarea rows="5" cols="50" name="observaciones" id="observaciones"></textarea>
			                    </div>
			                	<div class="col-xs-4 col-lg-6 col-md-4">
			                        <label>Adjuntar archivo</label>
			                        <input type="file" name="file" id="file" class="form-control" accept="image/jpeg,image/gif,image/png,application/pdf">
			                         <small><p class="help-block">@lang('purchase.max_file_size', ['size' => (config('constants.document_size_limit') / 1000000)]) <br> @lang('lang_v1.aspect_ratio_should_be_1_1')</p></small>
			                    </div>
			                </div>
			                <div class="row">
			                	<div class="col-12 pull-right">
			                		<button class="btn btn-danger btn-sm">Cancelar</button>
			                		<button class="btn btn-success btn-sm" type="button" onclick="guardaconsulta()">Guardar</button>
			                	</div>
			                </div>
                        </form>
					  </div>					
					  <div id="linea" class="tab-pane fade">
					    <h4>Linea de vida</h4>
					    	<br>
						    <table class="table table-striped" id="tabla-linea">
					           <thead>
					               <tr>
                                       <th>hora</th>
					                   <th>Fecha</th>
					                   <th>Titulo</th>
					                   <th>Peso</th>
					                   <th>Acciones</th>
					               </tr>
					           </thead>
					           <tbody>
					           </tbody>
					        </table>
					  </div>					
					</div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="alta-mascota"  role="dialog" >
    <div class="modal-dialog  modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" onclick="cancelarAlta()" data-dismiss="modal">&times;</button>
                <h5 class="modal-title" id="titleModal"></h5>
            </div>
            <form id="formAlta" method="post">
            	<input type="hidden" name="idConsulta" id="consulta_id">
            <div class="modal-body" style="background: #ffffff;height: 320px !important;">

                <div class="row" >
                    <div class="col-xs-6 col-md-6">
                        <label>Hora</label>
            			<input type="time" name="hora_alta" id="hora_alta" class="form-control"> 
                    </div>
                    <div class="col-xs-6 col-md-6">
                        <label>Fecha</label>
                        <input type="date" name="fecha_alta" id="fecha_alta" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-md-12">
                        <label class="text-center" style="display: table;">Observaciones de alta</label>
              			<textarea rows="5" cols="82" name="observaciones_alta" id="observaciones_alta"></textarea>
                    </div>                
                </div>            
                <br>
                <div class="row" >
                    <div class="col-xs-6 col-md-4">
                    </div>
                    <div class="col-xs-6 col-md-4 pull-rightt">
                        <button class="btn btn-primary" type="button" onclick="saveAltaMascota()">Alta</button>
                        <button class="btn btn-danger" type="button" onclick="cancelarAlta()">Cancelar</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

<style type="text/css">
    .pull-rightt {
    float: right!important;
    right: -22px !important;
}
</style>

@stop
@section('javascript')
<script type="text/javascript">
$(document).ready( function(){
	tablaMascotas();
	tablaMascotasLinea();
	$('#btn-hoja-pdf').on("click",imprimirHojaVidapdf);

});
function imprimirHojaVidapdf(){
	let id = $("#idmascota").val();
	window.open('/vet/hojavida/'+id, '_blank');
}
function tablaMascotas(){
    let tablaconsulta = $('#tabla-consultas').DataTable();   
    let id = '{{$mascota->id}}';
    console.log(id);
    $.ajax({
        type: 'get',
        url: '/vet/lista-consulta',
        dataType: 'json',
        data: {id:id},
        success: function(data){
        	$('#tabla-consultas').DataTable().clear().draw();
            
            data.datos.forEach(function (consulta){
                tablaconsulta.row.add( [
                    consulta.hora_entrada,
                    consulta.fecha_consulta,
                    consulta.titulo_consulta,
                    consulta.peso_mascota + " KG",
                    consulta.observaciones,
                    '<button type="button" onclick="altaMascota('+consulta.id+')" data-backdrop="static"  data-keyboard="false" data-toggle="modal" data-target="#alta-mascota" class="d-inline m-1 btn btn-danger btn-sm"><span class="glyphicon glyphicon-pencil"></span></button>'
                ]).draw(); 
            });
            
        },
    });
}

function tablaMascotasLinea(){
    let tablalinea = $('#tabla-linea').DataTable();   
    let id = '{{$mascota->id}}';
    console.log(id);
    $.ajax({
        type: 'get',
        url: '/vet/lista-linea',
        dataType: 'json',
        data: {id:id},
        success: function(data){
        	$('#tabla-linea').DataTable().clear().draw();
            
            data.datos.forEach(function (consulta){
                tablalinea.row.add( [
                    consulta.hora_salida,
                    consulta.fecha_salida,
                    consulta.titulo_consulta,
                    consulta.peso_mascota + " KG",
                    '<button type="button" onclick="imprimirHojaConsultapdf('+consulta.id+')" class="d-inline m-1 btn btn-default btn-sm"><span class="glyphicon glyphicon-print"></span></button>'
                ]).draw(); 
            });
            
        },
    });
}

function imprimirHojaConsultapdf(id){
	window.open('/vet/hojaconsulta/'+id, '_blank');
}
function guardaconsulta(){

    // let datos = $("#formConsulta").serialize();
    // var formElement = document.getElementById("formConsulta");
    var paqueteDeDatos = new FormData(document.forms.namedItem("formConsulta"));
    paqueteDeDatos.append('archivo', $('#file')[0].files[0]);
	paqueteDeDatos.append('mascota_id', $('#mascota_id').val());
	paqueteDeDatos.append('hora', $('#hora').val());
	paqueteDeDatos.append('cliente_id', $('#cliente_id').val());
	paqueteDeDatos.append('fecha_consulta', $('#fecha_consulta').val());
	paqueteDeDatos.append('titulo_consulta', $('#titulo_consulta').val());
	paqueteDeDatos.append('peso_mascota', $('#peso_mascota').val());
	paqueteDeDatos.append('observaciones', $('#observaciones').val());

    $.ajax({
        url: '/vet/consulta',
        type: 'post',
        data: paqueteDeDatos,
        processData: false,
        contentType: false,
        success: function(result){
            if(result.flag){
            	tablaMascotas();
                alert('Consulta Registrada');
                $('#formConsulta')[0].reset();

            }else{
                alert('No se registro la consulta, intente de nuevo.');
            }
        },
    });
}
function cancelarAlta(){
    $('#formAlta')[0].reset();
    $('#formAlta').trigger("reset");
    $('#alta-mascota').modal('toggle');
}
function altaMascota(id){

	$("#consulta_id").val(id);
    console.log($("#consulta_id").val());

    $("#titleModal").text('Alta de Mascota');

}

function saveAltaMascota(){

    let datos = $("#formAlta").serialize();
    console.log(datos);
    console.log("ta rartoi");
	$.ajax({
        type: 'post',
        url: '/vet/alta',
        dataType: 'json',
        data: datos,
        success: function(result){
            if(result.flag){
            	tablaMascotas();
                alert('Alta Registrada');
                $('#formAlta')[0].reset();
                $('#alta-mascota').modal('toggle');

            }else{
                alert('No se registro la alta, intente de nuevo.');
            }
        },
    });
}

</script>

@endsection