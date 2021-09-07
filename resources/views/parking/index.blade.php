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
        					@include('parking.partials.zonas')
        				</div>
        			</div>
        			<div class="pos-tab-content">
    					<div class="row">    
        					@include('parking.partials.vehiculos')
        				</div>
        			</div>
        			<div class="pos-tab-content">
    					<div class="row">    
        					@include('parking.partials.estancias')
        				</div>
        			</div>

	            </div>
        	</div>    
        </div>   
    </div>
    <br>
</section>
@endsection
@section('javascript')
<script type="text/javascript">

	let editVehiculo = false;
	let editEstancia = false;
	let editZona = false;
	let editTarifa = false;
	let vehiculoId;
	let estanciaId;
	let zonaId;
	let tarifaId;


	$( document ).ready(function() {
		
		//vehiculos
		let tableVehiculos = $('#table-vehiculos').DataTable({
			processing: true,
			serverSide: true,
			searching: false,
			ordering: false,
			searching: false,
			pageLength: 10,
			ajax:{
				url: "{{ route('parking.vehiculos.index') }}",
				
			},
			columns: [
				{data: 'nombre'},
				{
					data: 'status',
					render:function(data, type, row){
						if(Boolean(row.status)) return `
							<div class="alert alert-success text-center" style="padding:0">Activo</div>
						`
						return  `
							<div class="alert alert-danger text-center" style="padding:0">Desactivado</div>
						`
					}
				},
				{
					data:'action',
					render:function(data, type, row){
						return ` 
						<div style="display:flex;justify-content:space-evenly">
							<button name="edit" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>Editar</button>
							<button name="delete" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i>Borrar</button>
						</div>`;
					}
				}
			]
		});

		$('#btn-cancelar-vehiculo').on('click',function(){
			$(this).hide();
			editVehiculo = false;
			vehiculoId = null;
			$('#vehiculo-nombre').val(null);
		});

		$('#table-vehiculos tbody').on( 'click', 'tr td button[name=edit]', function () {
			editVehiculo = true;
			$('#btn-cancelar-vehiculo').show();
			let vehiculo = tableVehiculos.row( this.parentNode.parentNode ).data();
			vehiculoId = vehiculo.id;
			$('#vehiculo-nombre').val(vehiculo.nombre);
			$('#vehiculo-nombre').focus();
		});

		$('#table-vehiculos tbody').on( 'click', 'tr td button[name=delete]', async function () {
			let confirm = await swal({
              title: 'Estás seguro ?',
              icon: "warning",
              buttons: true,
              dangerMode: true,
            });


			if(!confirm)  return;


			let vehiculo = tableVehiculos.row( this.parentNode.parentNode ).data();
			$.ajax({
				method: "DELETE",
				url:`/parking/vehiculos/${vehiculo.id}/delete`,
				success:function(response){
					if(response.success){
						toastr.success(response.msg);
						
						tableVehiculos.ajax.reload();
					} 
					else toastr.error(response.msg)
				},
				error:function(error){
					toastr.error('Lo sentimos ha ocurrido un error');
				}

			});
		});

		//Estancias 
		let tableEstancias = $('#table-estancias').DataTable({
			processing: true,
			serverSide: true,
			searching: false,
			ordering: false,
			searching: false,
			pageLength: 10,
			ajax:{
				url: "{{ route('parking.estancias.index') }}",
				
			},
			columns: [
				{data: 'nombre'},
				{
					data: 'status',
					render:function(data, type, row){
						if(Boolean(row.status)) return `
							<div class="alert alert-success text-center" style="padding:0">Activo</div>
						`
						return  `
							<div class="alert alert-danger text-center" style="padding:0">Desactivado</div>
						`
					}
				},
				{
					data:'action',
					render:function(data, type, row){
						return ` 
						<div style="display:flex;justify-content:space-evenly">
							<button name="edit" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>Editar</button>
							<button name="delete" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i>Borrar</button>
						</div>`;
					}
				}
			]
		});

		$('#table-estancias tbody').on( 'click', 'tr td button[name=edit]', function () {
			editEstancia = true;
			$('#btn-cancelar-estancia').show();
			let estancia = tableEstancias.row( this.parentNode.parentNode ).data();
			estanciaId = estancia.id;
			$('#estancia-nombre').val(estancia.nombre);
			$('#estancia-nombre').focus();
		});
		$('#table-estancias tbody').on( 'click', 'tr td button[name=delete]', async function () {
			let confirm = await swal({
              title: 'Estás seguro ?',
              icon: "warning",
              buttons: true,
              dangerMode: true,
            });


			if(!confirm)  return;


			let estancia = tableEstancias.row( this.parentNode.parentNode ).data();
			$.ajax({
				method: "DELETE",
				url:`/parking/estancias/${estancia.id}/delete`,
				success:function(response){
					if(response.success){
						toastr.success(response.msg);
						
						tableEstancias.ajax.reload();
					} 
					else toastr.error(response.msg)
				},
				error:function(error){
					toastr.error('Lo sentimos ha ocurrido un error');
				}

			});
		});

		//Zonas
		let tableZonas = $('#table-zonas').DataTable({
			processing: true,
			serverSide: true,
			searching: false,
			ordering: false,
			searching: false,
			pageLength: 10,
			ajax:{
				url: "{{ route('parking.zonas.index') }}",
				
			},
			columns: [
				{data: 'nombre'},
				{
					data: 'status',
					render:function(data, type, row){
						if(Boolean(row.status)) return `
							<div class="alert alert-success text-center" style="padding:0">Activo</div>
						`
						return  `
							<div class="alert alert-danger text-center" style="padding:0">Desactivado</div>
						`
					}
				},
				{
					data:'action',
					render:function(data, type, row){
						return ` 
						<div style="display:flex;justify-content:space-evenly">
							<button name="edit" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>Editar</button>
							<button name="delete" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i>Borrar</button>
						</div>`;
					}
				}
			]
		});

		$('#table-zonas tbody').on( 'click', 'tr td button[name=edit]', function () {
			editZona = true;
			$('#btn-cancelar-zona').show();
			let zona = tableZonas.row( this.parentNode.parentNode ).data();
			zonaId = zona.id;
			$('#zona-nombre').val(zona.nombre);
			$('#zona-nombre').focus();
		});
		$('#table-zonas tbody').on( 'click', 'tr td button[name=delete]', async function () {
			let confirm = await swal({
              title: 'Estás seguro ?',
              icon: "warning",
              buttons: true,
              dangerMode: true,
            });


			if(!confirm)  return;


			let zona = tableZonas.row( this.parentNode.parentNode ).data();
			$.ajax({
				method: "DELETE",
				url:`/parking/zonas/${zona.id}/delete`,
				success:function(response){
					if(response.success){
						toastr.success(response.msg);
						
						tableZonas.ajax.reload();
					} 
					else toastr.error(response.msg)
				},
				error:function(error){
					toastr.error('Lo sentimos ha ocurrido un error');
				}

			});
		});


		//tarifas
		let selectVehiculo = $('#tipo_vehiculo').select2({
			language: 'es',
			ajax: {
				url: "{{ route('parking.vehiculos.index') }}",
				dataType: 'json',
				processResults:function(data){

					$.each(data.data, function(i, d) {
						data.data[i].id = d.id;
						data.data[i].text = d.nombre;
					});
					return {
						results: data.data
					};
				},
			},
			escapeMarkup: function(markup) {
	            return markup;
	        },
			// dropdownParent: $('#parent')
		});

		let selectEstancia = $('#tipo_estancia').select2({
			language: 'es',
			ajax: {
				url: "{{ route('parking.estancias.index') }}",
				dataType: 'json',
				processResults:function(data){

					$.each(data.data, function(i, d) {
						data.data[i].id = d.id;
						data.data[i].text = d.nombre;
					});
					return {
						results: data.data
					};
				},
			},
			escapeMarkup: function(markup) {
	            return markup;
	        },
			// dropdownParent: $('#parent')
		});

		let selectZona = $('#zona').select2({
			language: 'es',
			ajax: {
				url: "{{ route('parking.zonas.index') }}",
				dataType: 'json',
				processResults:function(data){

					$.each(data.data, function(i, d) {
						data.data[i].id = d.id;
						data.data[i].text = d.nombre;
					});
					return {
						results: data.data
					};
				},
			},
			escapeMarkup: function(markup) {
	            return markup;
	        },
			// dropdownParent: $('#parent')
		});

		let tableTarifas = $('#table-tarifas').DataTable({
			processing: true,
			serverSide: true,
			searching: false,
			ordering: false,
			searching: false,
			pageLength: 10,
			ajax:{
				url: "{{ route('parking.tarifas.index') }}",
				
			},
			columns: [
				{
					data: 'vehiculo',
					render:function(data,type,row){
						return row.vehiculo.nombre
					}
				},
				{
					data: 'estancia',
					render:function(data,type,row){
						return row.estancia.nombre
					}
				},
				{
					data: 'zona',
					render:function(data,type,row){
						return row.zona.nombre
					}
				},
				{
					data: 'precio_hora',
					
				},
				{
					data: 'tiempo_gracias',
					
				},
				{
					data:'action',
					render:function(data, type, row){
						return ` 
						<div style="display:flex;justify-content:space-evenly">
							<button name="edit" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>Editar</button>
							<button name="delete" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i>Borrar</button>
						</div>`;
					}
				}
			]
		});

		$('#table-tarifas tbody').on( 'click', 'tr td button[name=edit]', function () {
			console.log('entra');
			editTarifa = true;
			$('#btn-cancelar-tarifa').show();
			let tarifa = tableTarifas.row( this.parentNode.parentNode ).data();
			tarifaId = tarifa.id;

			let option = new Option(tarifa.vehiculo.nombre, tarifa.vehiculo.id, true, true);
    		selectVehiculo.append(option).trigger('change');
			selectVehiculo.trigger({
				type: 'select2:select',
				params:{
					data:tarifa.vehiculo
				}
			});


			option = new Option(tarifa.estancia.nombre, tarifa.estancia.id, true, true);
			selectEstancia.append(option).trigger('change');
			selectEstancia.trigger({
				type: 'select2:select',
				params:{
					data:tarifa.tarifa
				}
			});
			
			
			option = new Option(tarifa.zona.nombre, tarifa.zona.id, true, true);
			selectZona.append(option).trigger('change');
			selectZona.trigger({
				type: 'select2:select',
				params:{
					data:tarifa.zona
				}
			});
			$('#valorHora').val(tarifa.precio_hora);
			$('#timeValorFranccion').val(tarifa.tiempo_gracias);

			
		});
		$('#table-tarifas tbody').on( 'click', 'tr td button[name=delete]', async function () {
			let confirm = await swal({
              title: 'Estás seguro ?',
              icon: "warning",
              buttons: true,
              dangerMode: true,
            });


			if(!confirm)  return;


			let tarifa = tableTarifas.row( this.parentNode.parentNode ).data();
			$.ajax({
				method: "DELETE",
				url:`/parking/tarifas/${tarifa.id}/delete`,
				success:function(response){
					if(response.success){
						toastr.success(response.msg);
						
						tableTarifas.ajax.reload();
					} 
					else toastr.error(response.msg)
				},
				error:function(error){
					toastr.error('Lo sentimos ha ocurrido un error');
				}

			});
		});
	
		
		//boton agregar vehiculo
		$('#btn-guardar-vehiculo').on('click',function(){
			let form = $('#form-vehiculo');
			form.validate({
				rules:{
					nombre: {
						required:true
					}
				},
				messages:{
					nombre: {
						required: 'El nombre del vehículo es requerido',
					},
				},
				submitHandler:function(form){
					let data = $(form).serialize();
					$.ajax({
						method: !editVehiculo ? "POST" :"PUT",
						url: !editVehiculo ? $(form).attr("action") : `/parking/vehiculos/${vehiculoId}/update` ,
						dataType: "json",
						data: data,
						success:function(response){
							if(response.success){
								toastr.success(response.msg);
								$('#btn-cancelar-vehiculo').hide();
								$('#vehiculo-nombre').val(null);
								vehiculoId = null;
								editVehiculo = false;
								tableVehiculos.ajax.reload();
							} 
							else toastr.error(response.msg)

							
							
						},
						error:function(error){
							toastr.error('Lo sentimos ha ocurrido un error');
						}
					});
				}
			}); 

			form.submit();

		});

		//boton para guardar estancia
		$('#btn-guardar-estancia').on('click',function(){
			let form = $('#form-estancia');
			form.validate({
				rules:{
					nombre: {
						required:true
					}
				},
				messages:{
					nombre: {
						required: 'La estancia es requerido',
					},
				},
				submitHandler:function(form){
					let data = $(form).serialize();
					$.ajax({
						method: !editEstancia ? "POST" :"PUT",
						url: !editEstancia ? $(form).attr("action") : `/parking/estancias/${estanciaId}/update` ,
						dataType: "json",
						data: data,
						success:function(response){
							if(response.success){
								toastr.success(response.msg);
								$('#btn-cancelar-estancia').hide();
								$('#estancia-nombre').val(null);
								estanciaId = null;
								editEstancia = false;
								tableEstancias.ajax.reload();
							} 
							else toastr.error(response.msg)

							
							
						},
						error:function(error){
							toastr.error('Lo sentimos ha ocurrido un error');
						}
					});
				}
			}); 

			form.submit();

		});

		//boton para guardar zonas
		$('#btn-guardar-zona').on('click',function(){
			let form = $('#form-zonas');
			form.validate({
				rules:{
					nombre: {
						required:true
					}
				},
				messages:{
					nombre: {
						required: 'La zona es requerido',
					},
				},
				submitHandler:function(form){
					let data = $(form).serialize();
					$.ajax({
						method: !editZona ? "POST" :"PUT",
						url: !editZona ? $(form).attr("action") : `/parking/zonas/${zonaId}/update` ,
						dataType: "json",
						data: data,
						success:function(response){
							if(response.success){
								toastr.success(response.msg);
								$('#btn-cancelar-zona').hide();
								$('#zona-nombre').val(null);
								zonaId = null;
								editZona = false;
								tableZonas.ajax.reload();
							} 
							else toastr.error(response.msg)

							
							
						},
						error:function(error){
							toastr.error('Lo sentimos ha ocurrido un error');
						}
					});
				}
			}); 

			form.submit();

		});

		//boton para guardar tarifas
		$('#btn-guardar-tarifa').on('click',function(){
			let form = $('#form-tarifa');
			form.validate({
				rules:{
					vehiculo_id: {
						required:true
					},
					zona_id: {
						required:true
					},
					estancia_id: {
						required:true
					},
					precio_hora: {
						required:true
					},
					tiempo_gracias: {
						required:true
					}
				},
				messages:{
					vehiculo_id: {
						required: 'El vehículo es requerido'
					},
					zona_id: {
						required:'La zona es requerido'
					},
					estancia_id: {
						required:'La estancia es requerido'
					},
					precio_hora: {
						required:'El precio por hora es requerido'
					},
					tiempo_gracias: {
						required:'El tiempo de gracia es requerido'
					}
				},
				submitHandler:function(form){
					let data = $(form).serialize();
					console.log(data);
					$.ajax({
						method: !editTarifa ? "POST" :"PUT",
						url: !editTarifa ? $(form).attr("action") : `/parking/tarifas/${tarifaId}/update` ,
						dataType: "json",
						data: data,
						success:function(response){
							if(response.success){
								toastr.success(response.msg);
								$('#btn-cancelar-tarifa').hide();

								selectVehiculo.val(null).trigger('change');
								selectEstancia.val(null).trigger('change');
								selectZona.val(null).trigger('change');
								$('#valorHora').val(null);
								$('#timeValorFranccion').val(null);
								
								tarifaId = null;
								editTarifa = false;
								tableTarifas.ajax.reload();
							} 
							else toastr.error(response.msg)

							
							
						},
						error:function(error){
							toastr.error('Lo sentimos ha ocurrido un error');
						}
					});
				}
			}); 

			form.submit();

		});


		

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