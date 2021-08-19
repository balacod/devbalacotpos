<div class="pos-tab-content active">
	<div class="row">    
		<h3>Ajuste de Tarifa</h3>
		<form autocomplete="off" id="formTarifa">
			<div class="col-sm-4">
	            <div class="form-group">
	                <label>Tipo Vehiculo</label>
	                <div class="input-group">
	                    <span class="input-group-addon"><i class="fas fa-address-book"></i></span>
	                    <select class="form-control" name="tipo_vehiculo">
	                    	<option>Camioneta</option>
	                    	<option>Moto</option>
	                    	<option>Carro</option>
	                    </select>
	                </div>
	            </div>
	        </div>
	        <div class="col-sm-4">
	            <div class="form-group">
	                <label>Tipo Estancia</label>
	                <div class="input-group">
	                    <span class="input-group-addon"><i class="fas fa-address-book"></i></span>
	                    <select class="form-control" name="tipo_estancia">
	                    	<option>Noche</option>
	                    	<option>Dia</option>
	                    </select>
	                </div>
	            </div>
	        </div>
	        <div class="col-sm-4">
	            <div class="form-group">
	                <label>Valor por hora</label>
	                <div class="input-group">
	                    <span class="input-group-addon"><i class="fas fa-money-bill"></i></span>
	                    <input type="number" name="valorHora" id="valorHora" class="form-control">
	                </div>
	            </div>
	        </div>
	        <div class="col-sm-4">
	            <div class="form-group">
	                <label>Tiempo maxímo de Franccion</label>
	                <div class="input-group">
	                    <span class="input-group-addon"><i class="fas fa-money-bill"></i></span>
	                    <input type="number" name="timeValorFranccion" id="timeValorFranccion" class="form-control">
	                </div>
	            </div>
	        </div>
	        
	        <div class="col-sm-4">
	            <div class="form-group">
	                <label>Valor por Franccion</label>
	                <div class="input-group">
	                    <span class="input-group-addon"><i class="fas fa-money-bill"></i></span>
	                    <input type="number" name="valorFranccion" id="valorFranccion" class="form-control">
	                </div>
	            </div>
	        </div>

	        <div class="clearfix"></div>
	        <div class="col-xs-12 test_company_btn">
	            <button type="button" class="btn btn-primary pull-right" id="test_company_btn">Guardar Tarifa</button>
	        </div>
        </form>
	</div>

	<div class="row">
		<h3>Lista de Tarifa</h3>

		<div class="table-responsive">
            <table class="table table-bordered table-striped" id="table_tarifas">
                <thead>
                    <tr>
                        <th>Tipo Vehiculo</th>
                        <th>Tipo Estancia</th>
                        <th>Valor por hora</th>
                        <th>Valor Fracción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                	
                </tbody>
            </table>
        </div>

	</div>

</div>

@section('javascript')
    <script type="text/javascript">

    	





    </script>
@endsection