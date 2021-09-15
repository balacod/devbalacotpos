<div class="pos-tab-content active">
	<div class="row text-center">    
		<h3>Estancias</h3>
		<form method="POST" action="{{ route('parking.zonas.store') }}" autocomplete="off" id="form-zonas" >
            <div class="col-md-12">
                <div class="row" style="display: flex;justify-content:center">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Zona</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-calendar"></i></span>
                                <input id="zona-nombre" name="nombre" type="text" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			
	       

	        {{-- <div class="clearfix"></div> --}}
	        <div class="col-xs-12 test_company_btn" style="display: flex;justify-content:center">
                <button style="display: none;margin-right:1rem" id="btn-cancelar-zona" type="button" class="btn btn-danger pull-right" >
                    Cancelar
                </button>
	            <button id="btn-guardar-zona" type="button" class="btn btn-primary pull-right" id="test_company_btn">
                    Guardar Zona
                </button>
	        </div>
        </form>
	</div>

	<div class="row">
		<h3>Lista de Zonas</h3>

        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="table-zonas" style="width: 100%">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Estado</th>
                            <th></th>
                            
                        </tr>
                    </thead>
                    {{-- <tbody>
                        
                    </tbody> --}}
                </table>
            </div>

        </div>

		

	</div>

</div>

