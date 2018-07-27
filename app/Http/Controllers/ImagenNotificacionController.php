<?php

namespace App\Http\Controllers;

use App\ImagenNotificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImagenNotificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(ImagenNotificacion::get(), 200);
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
            $imagen_notificacion = new ImagenNotificacion();
            $imagen_notificacion->imagen = $path_imagen;
            $imagen_notificacion->notificacion_id = $request->input('notificacion_id');
            $imagen_notificacion->descripcion = $request->input('descripcion');
            $imagen_notificacion->save();
            return response()->json([
                'creado' => $imagen_notificacion,
                'mensaje' => 'Imagen de notificacion creada exitosamente'
            ], 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ImagenNotificacion  $imagenNotificacion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(ImagenNotificacion::find($id), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ImagenNotificacion  $imagenNotificacion
     * @return \Illuminate\Http\Response
     */
    public function edit(ImagenNotificacion $imagenNotificacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ImagenNotificacion  $imagenNotificacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $imagen_notificacion = ImagenNotificacion::find($id);
        $imagen_notificacion->update($request->all());
        return response()->json([
            'actualizado' => $imagen_notificacion,
            'mensaje' => 'La imagen de la notificacion fue actualizada exitosamente'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ImagenNotificacion  $imagenNotificacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $imagen_notificacion = ImagenNotificacion::find($id);
        Storage::delete($imagen_notificacion->imagen);
        $imagen_notificacion->delete();
        return response()->json([
            'eliminado' => true,
            'mensaje' => 'La imagen fue eliminada exitosamente'
        ], 200);
    }
    public function getImagen($id) {
        $imagen_notificacion = ImagenNotificacion::find($id);
        return response()->file(storage_path('app/' . $imagen_notificacion->imagen));
    }

}
