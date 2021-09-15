<?php

namespace App\Http\Controllers;

use App\Http\Requests\TarifasRequest;
use App\Tarifa;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;

class TarifasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tarifas = Tarifa::with(['vehiculo','zona','estancia','configuracion']);
        return DataTables::eloquent($tarifas)
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
    public function store(TarifasRequest $request)
    {
        //
        try{

            Tarifa::create($request->all());
            return Response::json([
                'success' => true,
                'msg' => 'Se ha agreadó con éxito'
            ]);
            

        }catch(Exception $e){
            return Response::json([
                'success' => false,
                'msg' => 'Lo sentimos ha ocurrido un error'
            ]);

        }
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
    public function edit($id)
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
    public function update(TarifasRequest $request, Tarifa $tarifa)
    {
        //

        try{

            $tarifa->update($request->all());
            return Response::json([
                'success' => true,
                'msg' => 'Se ha editado con éxito'
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
    public function destroy(Tarifa $tarifa)
    {
        //
        try{

            $tarifa->delete();
            return Response::json([
                'success' => true,
                'msg' => 'Se ha eliminado con éxito'
            ]);
            

        }catch(Exception $e){
            return Response::json([
                'success' => false,
                'msg' => 'Lo sentimos ha ocurrido un error'
            ]);

        }
    }
}
