<?php

namespace App\Http\Controllers;

use App\Tramite;
use App\Ubicacion;
use Illuminate\Http\Request;

class TramiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Tramite::orderByDesc('created_at')->get(), 200);
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
        Tramite::create($request->all());
        return response()->json([
            'creado' => ,
            'mensaje' => 'El tramite ' . $request->input('titulo')
                        . ' se registro exitosamente'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tramite  $tramite
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Tramite::find($id), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tramite  $tramite
     * @return \Illuminate\Http\Response
     */
    public function edit(Tramite $tramite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tramite  $tramite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tramite = Tramite::find($id);
        $tramite->update($request->all());
        return response()->json([
            'actualizado' => $tramite,
            'mensaje' => 'El tramite ' . $request->input('titulo') . ' fue actualizado exitosamente.'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tramite  $tramite
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tramite = Tramite::find($id);
        $tramite->delete();
        return response()->json([
            'eliminado' => true,
            'mensaje' => 'El tramite ' . $tramite->titulo . ' fue eliminado exitosamente'
        ], 200);
    }

    public function hasManyTramiteUbicacion ($tramite_id) {
        $ubicaciones = [];
        $pasos = Tramite::find($tramite_id)->pasos()->get()->toArray();
        foreach ($pasos as $paso) {
            if($paso['ubicacion_id']) {
                $ubicacion = Ubicacion::find($paso['ubicacion_id']);
                array_push($ubicaciones, $ubicacion);
            }
        }
    }
}
