<?php

namespace App\Http\Controllers;

use App\CategoriaUbicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoriaUbicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return response()->json(CategoriaUbicacion::orderBy('nombre')->get(), 201);
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
        if ($request->hasFile('icono')){
            $path_icono = $request->file('icono')->store('iconos');
            $categoria_ubicacion = new CategoriaUbicacion();
            $categoria_ubicacion->nombre = $request->input('nombre');
            $categoria_ubicacion->descripcion = $request->input('descripcion');
            $categoria_ubicacion->icono = $path_icono;
            $categoria_ubicacion->color = $request->input('color');
            $categoria_ubicacion->save();
            return response()->json([
                'creado' => $categoria_ubicacion,
                'mensaje' => 'La categoria de ubicacion fue creado exitosamente'
            ], 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CategoriaUbicacion  $categoriaUbicacion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(CategoriaUbicacion::find($id), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CategoriaUbicacion  $categoriaUbicacion
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoriaUbicacion $categoriaUbicacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CategoriaUbicacion  $categoriaUbicacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return response()->json([
            'actualizado' => CategoriaUbicacion::find($id)->update($request->all()),
            'mensaje' => 'La categoria '. $request->input('nombre') . ' fue actualizado exitosamente'],
            200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CategoriaUbicacion  $categoriaUbicacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria_ubicacion = CategoriaUbicacion::find($id);
//        Storage::delete($categoria_ubicacion->icono);
        $categoria_ubicacion->delete();
        return response()->json([
            'eliminado' => true,
            'mensaje' => 'Categoria de ubicacion eliminada con id: ' . $id
        ], 200);
    }

    public function getIcono($id){
        $categoriaUbicacion = CategoriaUbicacion::find($id);
        return response()->file(storage_path('app/' . $categoriaUbicacion->icono));
    }

    public function hasManyUbicaciones($id){
        $ubicaciones = CategoriaUbicacion::find($id)->ubicaciones()->with('categoriaUbicacion')->orderBy('nombre', 'asc')->get();
        return response()->json($ubicaciones, 200);
    }

}
