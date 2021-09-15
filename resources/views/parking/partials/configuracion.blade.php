<div class="pos-tab-content active">
	<div class="row text-center">    
		<h3>Configuración</h3>
		<form method="POST" action="{{ route('parking.configuraciones.store') }}" autocomplete="off" id="form-configuracion" >
            <div class="col-md-12">
                <div class="row" style="display: flex;justify-content:center">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Nombre de la configuración</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-calendar"></i></span>
                                <input id="nombre-configuracion" name="nombre" type="text" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Precio</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-clock"></i></span>
                                <input id="configuracion-precio" name="precio" type="text" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Cantidad de minutos</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-clock"></i></span>
                                <input id="cantidad-minutos" name="tiempo" type="text" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			
	       

	        {{-- <div class="clearfix"></div> --}}
	        <div class="col-xs-12 test_company_btn" style="display: flex;justify-content:center">
                <button style="display: none;margin-right:1rem" id="btn-cancelar-configuracion" type="button" class="btn btn-danger pull-right" >
                    Cancelar
                </button>
	            <button id="btn-guardar-configuracion" type="button" class="btn btn-primary pull-right" id="test_company_btn">
                    Guardar Configuracion
                </button>
	        </div>
        </form>
	</div>

	<div class="row">
		<h3>Lista de configuraciones</h3>

        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="table-configuraciones" style="width: 100%">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Estado</th>
                            <th>Minutos</th>
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

