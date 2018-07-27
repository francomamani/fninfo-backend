<?php

namespace App\Http\Controllers;

use App\Paso;
use App\Tramite;
use Illuminate\Http\Request;

class PasoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Paso::orderBy('posicion')->get(), 200);
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
        $paso = new Paso();
        $paso->tramite_id = $request->input('tramite_id');
        $paso->posicion = $request->input('posicion');
        $paso->titulo = $request->input('titulo');
        $paso->descripcion = $request->input('descripcion');
        $paso->titulo = $request->input('titulo');
        $paso->ubicacion_id = $request->input('ubicacion_id');
        if ($request->hasFile('documento')){
            $paso->documento = $request->file('documento')->store('documentos');
        } else {
            $paso->documento = $request->input('documento');
        }

        if ($request->hasFile('imagen')) {
            $paso->imagen = $request->file('imagen')->store('imagen');
        } else {
            $paso->imagen = $request->input('imagen');
        }
        $paso->save();
        $tramite = Tramite::find($request->input('tramite_id'));
        return response()->json([
            'creado' => $paso,
            'mensaje' => 'El paso ' . $paso->posicion . ' fue registrado exitosamente al tramite ' . $tramite->titulo
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Paso  $paso
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Paso::find($id), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Paso  $paso
     * @return \Illuminate\Http\Response
     */
    public function edit(Paso $paso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $paso = Paso::find($id);
        $paso->fill($request->all());
        /*if ($request->hasFile('documento')){
            $paso->documento = $request->file('documento')->store('documentos');
        }

        if ($request->hasFile('imagen')) {
            $paso->imagen = $request->file('imagen')->store('imagen');
        }*/
        $paso->save();
        return response()->json([
            'actualizado' => $paso,
            'mensaje' => 'El paso ' . $paso->posicion . ' fue actualizado exitosamente'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Paso  $paso
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paso = Paso::find($id);
        $paso->delete();
        return response()->json([
            'eliminado' => true,
            'mensaje' => 'El paso fue eliminado exitosamente'
        ], 200);
    }

    public function getDocumento($id) {
        $paso = Paso::find($id);
        return response()->file(storage_path('app/' . $paso->documento));
    }
    public function getImagen($id) {
        $paso = Paso::find($id);
        return response()->file(storage_path('app/' . $paso->imagen));
    }
}
