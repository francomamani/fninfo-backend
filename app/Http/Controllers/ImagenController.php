<?php

namespace App\Http\Controllers;

use App\Imagen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImagenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Imagen::get(), 200);
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
            $imagen = new Imagen();
            $imagen->ubicacion_id = $request->input('ubicacion_id');
            $imagen->imagen = $path_imagen;
            $imagen->descripcion = $request->input('descripcion');
            $imagen->save();
            return response()->json([
                'creado' => $imagen,
                'mensaje' => 'La imagen fue registrada exitosamente'
            ], 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Imagen  $imagen
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Imagen::find($id), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Imagen  $imagen
     * @return \Illuminate\Http\Response
     */
    public function edit(Imagen $imagen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Imagen  $imagen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $imagen = Imagen::find($id);
        $imagen->update($request->all());
        return response()->json([
            'actualizado' => $imagen,
            'mensaje' => 'La imagen ha sido actualizada exitosamente'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Imagen  $imagen
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $imagen = Imagen::find($id);
        Storage::delete($imagen->imagen);
        $imagen->delete();
        return response()->json([
            'eliminado' => true,
            'mensaje' => 'La imagen ha sido eliminada exitosamente'
        ], 200);
    }
    public function getImagen($id) {
        $imagen = Imagen::find($id);
        return response()->file(storage_path('app/' . $imagen->imagen));
    }
}
