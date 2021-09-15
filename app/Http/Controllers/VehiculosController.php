<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehiculoFormRequest;
use App\Vehiculo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;

class VehiculosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        extract($request->only(['q']));
        

        $vehiculos = Vehiculo::query();

        if(isset($q)){
            $vehiculos->where('nombre','like',"%{$q}%");
        }
        

        return DataTables::eloquent($vehiculos)
        ->make(true);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VehiculoFormRequest $request)
    {
        try{
            Vehiculo::create($request->all());

            return Response::json([
                'success' => true,
                'msg' => 'Se agregó correctamente'
            ]);
        }catch(Exception $e){
            return Response::json([
                'success' => false,
                'msg' => 'Lo sentimos ha ocurrido un error'
            ]);
        }
        //
        
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(VehiculoFormRequest $request, Vehiculo $vehiculo)
    {
        //
        
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VehiculoFormRequest $request, Vehiculo $vehiculo)
    {
        //
        try{
            $vehiculo->update($request->all());
            return Response::json([
                'success' => true,
                'msg' => 'Se editó correctamente'
            ]);

        }catch(Exception $e){
            return Response::json([
                'success' => false,
                'msg' => 'Lo sentimos ha ocurrido un error'
            ]);

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehiculo $vehiculo)
    {
        //
        try{
            $vehiculo->delete();

            return Response::json([
                'success' => true,
                'msg' => 'Vehículo eliminado con éxito'
            ]);

        }catch(Exception $e){
            return Response::json([
                'success' => false,
                'msg' => 'Lo sentimos ha ocurrido un error'
            ]);

        }
    }
}
