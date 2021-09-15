<?php

namespace App\Http\Controllers;

use App\Estancia;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;

class EstanciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $estancias = Estancia::query();
        

        return DataTables::eloquent($estancias)
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
    public function store(Request $request)
    {
        //
        try{
            Estancia::create($request->all());

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
    public function update(Request $request, Estancia $estancia)
    {
        //
        try{
            $estancia->update($request->all());
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
    public function destroy(Estancia $estancia)
    {
        //
        try{
            $estancia->delete();

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
