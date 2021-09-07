<div class="pos-tab-content active">
	<div class="row">    
		<h3>Ajuste de Tarifa</h3>
		<form method="POST" action="{{ route('parking.tarifas.store') }}" autocomplete="off" id="form-tarifa">
			<div class="col-sm-4">
	            <div id="parent" class="form-group">
	                <label>Tipo Vehiculo</label>
	                <div class="input-group">
	                    <span class="input-group-addon"><i class="fas fa-car"></i></span>
	                    <select class="form-control" id="tipo_vehiculo" name="vehiculo_id">
	                    	{{-- <option>Camioneta</option>
	                    	<option>Moto</option>
	                    	<option>Carro</option> --}}
	                    </select>
	                </div>
	            </div>
	        </div>
	        <div class="col-sm-4">
	            <div class="form-group">
	                <label>Tipo Estancia</label>
	                <div class="input-group">
	                    <span class="input-group-addon"><i class="fas fa-address-book"></i></span>
	                    <select class="form-control" name="estancia_id" id="tipo_estancia">
	                    	
	                    </select>
	                </div>
	            </div>
	        </div>
			<div class="col-sm-4">
	            <div class="form-group">
	                <label>Zona</label>
	                <div class="input-group">
	                    <span class="input-group-addon"><i class="fas fa-map"></i></span>
	                    <select class="form-control" name="zona_id" id="zona">
	                    	
	                    </select>
	                </div>
	            </div>
	        </div>
	        <div class="col-sm-4">
	            <div class="form-group">
	                <label>Valor por hora</label>
	                <div class="input-group">
	                    <span class="input-group-addon"><i class="fas fa-money-bill"></i></span>
	                    <input type="number" name="precio_hora" id="valorHora" class="form-control">
	                </div>
	            </div>
	        </div>
	        <div class="col-sm-4">
	            <div class="form-group">
	                <label>Tiempo maxímo de Franccion</label>
	                <div class="input-group">
	                    <span class="input-group-addon"><i class="fas fa-clock"></i></span>
	                    <input type="time" name="tiempo_gracias" id="timeValorFranccion" class="form-control">
	                </div>
	            </div>
	        </div>
	        
	        {{-- <div class="col-sm-4">
	            <div class="form-group">
	                <label>Valor por Franccion</label>
	                <div class="input-group">
	                    <span class="input-group-addon"><i class="fas fa-money-bill"></i></span>
	                    <input type="number" name="valorFranccion" id="valorFranccion" class="form-control">
	                </div>
	            </div>
	        </div> --}}

	        <div class="clearfix"></div>
	        <div class="col-xs-12 test_company_btn" style="display: flex;justify-content:center">
				<button style="display: none;margin-right:1rem" id="btn-cancelar-tarifa" type="button" class="btn btn-danger pull-right" >
                    Cancelar
                </button>
	            <button type="button" class="btn btn-primary pull-right" id="btn-guardar-tarifa">Guardar Tarifa</button>
	        </div>
        </form>
	</div>

	<div class="row">
		<h3>Lista de Tarifa</h3>

		<div class="table-responsive">
            <table class="table table-bordered table-striped" id="table-tarifas">
                <thead>
                    <tr>
                        <th>Tipo Vehiculo</th>
                        <th>Tipo Estancia</th>
						<th>Zona</th>
                        <th>Valor por hora</th>
						<th>Tiempo Fraccón</th>
                        {{-- <th>Valor Fracción</th> --}}
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                	
                </tbody>
            </table>
        </div>

	</div>

</div>

