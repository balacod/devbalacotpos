@extends('layouts.app')
@section('title', __('contact.view_contact'))

@section('content')


<section class="content no-print">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <div class="caixa-text">
                    <div class="img-top">
                        <p class="text-center base-ic"><i class="fas fa-home fa-3x ic-top"></i></p>
                    </div>
                    <h3 class="text-center title-cixa">{{$mascota->nombre}}</h3>
            		<input type="hidden" name="idMacota" value="{{$mascota->id}}">

                    <p class="text-caixa">mas informacion del pacinete</p>
                    <br>
                    <a href="#" class="adosaibamais">Editar</a>
                </div>
            </div>
           
            <div class="col-lg-9 col-md-9">
                <div class="caixa-text">
                	<h3 class="text-center title-cixa">Historia | {{$mascota->nombre}}</h3>
                    <ul class="nav nav-tabs">
					  <li class="active"><a data-toggle="tab" href="#historia">Historial</a></li>
					  <li><a data-toggle="tab" href="#consultar">Consultar</a></li>
					  <li><a data-toggle="tab" href="#linea">Linea de Vida</a></li>
					</ul>

					<div class="tab-content">
					  <div id="historia" class="tab-pane fade in active">
					    <h3>Historia</h3>
					    <table class="table table-striped" id="tabla-consultas">
				           <thead>
				               <tr>
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
					    <form id="formConsulta" method="post">
            				<input type="hidden" name="mascota_id" value="{{$mascota->id}}">
            				<input type="hidden" name="cliente_id" value="{{$mascota->cliente_id}}">
            				<div class="row">
			                    <div class="col-xs-6 col-md-3">
			                        <label>Fecha</label>
			                        <input type="date" name="fecha_consulta" id="fecha_consulta" class="form-control">
			                    </div>
			                    <div class="col-xs-6 col-md-7">
			                        <label>Titulo</label>
			                        <input type="text" name="titulo_consulta" id="titulo_consulta" class="form-control">
			                    </div>
			                    <div class="col-xs-6 col-md-2">
			                        <label>Peso</label>
			                        <input type="text" name="peso_consulta" id="peso_consulta" class="form-control">
			                    </div>
			                </div>
			                <div class="row">
			                	<div class="col-xs-6 col-md-6">
			                        <label>Observaciones</label>
              						<textarea rows="6" cols="50" name="observaciones" wrap="hard" ></textarea>
			                    </div>
			                	<div class="col-xs-6 col-md-4">
			                        <label>Adjuntar archivo</label>
			                        <input type="file" name="peso_mascota" id="peso_mascota" class="form-control">
			                    </div>
			                </div>
			                <div class="row">
			                	<div class="col-12 pull-right">
			                		<button class="btn btn-danger btn-sm">Cancelar</button>
			                		<button class="btn btn-success btn-sm" type="button" onclick="guardaconsulta()">Guardar</button>
			                	</div>
			                </div>
					  </div>
					  <div id="linea" class="tab-pane fade">
					    <h3>Linea de vida</h3>
					    <p>Consultas detalladas</p>
					  </div>
					</div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop
@section('javascript')
<script type="text/javascript">
$(document).ready( function(){
	tablaMascotas();
});

function tablaMascotas(){
    let tablaconsulta = $('#tabla-consultas').DataTable();   
    let id = '{{$mascota->id}}';
    // $("#idMacota").val();
    console.log(id);
    $.ajax({
        type: 'get',
        url: '/vet/lista-consulta',
        dataType: 'json',
        data: {id:id},
        success: function(data){
            
            data.datos.forEach(function (consulta){
                tablaconsulta.row.add( [
                    consulta.fecha_consulta,
                    consulta.titulo_consulta,
                    consulta.peso_mascota,
                    consulta.observaciones,
                    '<button type="button" onclick="editarMascota('+consulta.id+')" class="d-inline m-1 btn btn-danger btn-sm"><span class="glyphicon glyphicon-pencil"></span></button>'
                ]).draw(); 
            });
            
        },
    });
}
function guardaconsulta(){

    let datos = $("#formConsulta").serialize();
     $.ajax({
        type: 'post',
        url: '/vet/consulta',
        dataType: 'json',
        data: datos,
        success: function(result){
            if(result.flag){
                alert('Consulta Registrada');
                $('#formConsulta')[0].reset();
            }else{
                alert('No se registro la consulta, intente de nuevo.');
            }
        },
    });
}
function editarMascota(id){

}

</script>

@endsection