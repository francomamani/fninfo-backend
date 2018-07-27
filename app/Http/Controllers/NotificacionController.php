<?php

namespace App\Http\Controllers;

use App\Notificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NotificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Notificacion::orderBy('prioridad', 'desc')->with('categoria')->get(), 200);
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
            $notificacion = new Notificacion();
            $notificacion->user_id = $request->input('user_id');
            $notificacion->categoria_id = $request->input('categoria_id');
            $notificacion->ubicacion_id = $request->input('ubicacion_id');
            $notificacion->titulo = $request->input('titulo');
            $notificacion->contenido = $request->input('contenido');
            $notificacion->fecha_inicio = $request->input('fecha_inicio');
            $notificacion->fecha_fin = $request->input('fecha_fin');
            $notificacion->web = $request->input('web');
            $notificacion->prioridad = $request->input('prioridad');
            $notificacion->imagen = $path_imagen;
            $notificacion->save();
            return response()->json([
                'creado' => $notificacion,
                'mensaje' => 'La notificacion '. $notificacion->titulo . ' fue creada exitosamente'
            ], 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Notificacion  $notificacion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Notificacion::find($id), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Notificacion  $notificacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Notificacion $notificacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Notificacion  $notificacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return response()->json([
            'actualizado' => Notificacion::find($id)->update($request->all()),
            'mensaje' => 'La notificacion ' . $request->input('titulo') . ' fue actualizada exitosamente'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Notificacion  $notificacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notificacion = Notificacion::find($id);
        Storage::delete($notificacion->imagen);
        $notificacion->delete();
        return response()->json([
            'eliminado' => true,
            'mensaje' => 'Notificacion eliminada con id: ' . $notificacion->id
        ], 200);
    }

    public function getImagen($id) {
        $notificacion = Notificacion::find($id);
        return response()->file(storage_path('app/' . $notificacion->imagen));
    }

    public function getImagenNotificaciones($id) {
        $imagen_notificaciones = Notificacion::find($id)->imagenNotificaciones()->get(['id', 'descripcion', 'notificacion_id', 'imagen']);
        return response()->json($imagen_notificaciones, 200);
    }
}
