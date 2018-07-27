<?php

namespace App\Http\Controllers;

use App\Ubicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UbicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Ubicacion::with('categoriaUbicacion')->orderBy('nombre')->get(), 200);
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
        if ($request->hasFile('imagen')) {
            $path_imagen = $request->file('imagen')->store('imagenes');
            $ubicacion = new Ubicacion();
            $ubicacion->categoria_ubicacion_id = $request->input('categoria_ubicacion_id');
            $ubicacion->nombre = $request->input('nombre');
            $ubicacion->descripcion = $request->input('descripcion');
            $ubicacion->lat = $request->input('lat');
            $ubicacion->lng = $request->input('lng');
            $ubicacion->planta = $request->input('planta');
            $ubicacion->imagen = $path_imagen;
            $ubicacion->save();
            return response()->json([
                'creado' => $ubicacion,
                'mensaje' => 'La ubicacion ' . $ubicacion->nombre . ' fue creada exitosamente'
            ], 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ubicacion  $ubicacion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Ubicacion::with('categoriaUbicacion')->find($id), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ubicacion  $ubicacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Ubicacion $ubicacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ubicacion  $ubicacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return response()->json([
            'actualizado' => Ubicacion::find($id)->update($request->all()),
            'mensaje' => 'La ubicacion '. $request->input('nombre') . ' fue actualizada exitosamente'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ubicacion  $ubicacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ubicacion = Ubicacion::find($id);
        Storage::delete($ubicacion->imagen);
        $ubicacion->delete();
        return response()->json([
            'eliminado' => true,
            'mensaje' => 'La ubicacion ' . $ubicacion->nombre . ' fue eliminada exitosamente'
        ], 200);
    }

    public function getImagen($id) {
        $ubicacion = Ubicacion::find($id);
        return response()->file(storage_path('app/' . $ubicacion->imagen));
    }

    public function getImagenes($id) {
        $imagenes = Ubicacion::find($id)->imagenes()->get(['id', 'descripcion', 'ubicacion_id']);
        return response()->json($imagenes, 200);
    }
}