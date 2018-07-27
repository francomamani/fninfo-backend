<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\CategoriaUbicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Categoria::with('notificaciones')->orderBy('categorias.nombre')->get(), 200);
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
            $categoria = new Categoria();
            $categoria->nombre = $request->input('nombre');
            $categoria->descripcion = $request->input('descripcion');
            $categoria->icono = $path_icono;
            $categoria->color = $request->input('color');
            $categoria->save();
            return response()->json([
                'creado' => $categoria,
                'mensaje' => 'La categoria '. $request->input('nombre') . ' fue creada exitosamente'
            ], 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Categoria::find($id), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categoria  $categoria
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
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return response()->json([
            'actualizado' => Categoria::find($id)->update($request->all()),
            'mensaje' => 'La categoria ' . $request->input('nombre') . ' fue actualizado exitosamente'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria = Categoria::find($id);
        Storage::delete($categoria->icono);
        $categoria->delete();
        return response()->json([
            'eliminado' => true,
            'mensaje' => 'La categoria ' . $categoria->nombre . ' fue eliminada exitosamente'
        ]);
    }

    public function menu(){
        return response()->json([
            "categorias" => Categoria::orderBy('nombre')->get(),
            "categoria_ubicaciones" =>CategoriaUbicacion::orderBy('nombre')->get()
        ],200);
    }

    public function getIcono($id){
        $categoria = Categoria::find($id);
        return response()->file(storage_path('app/' . $categoria->icono));
    }

}
