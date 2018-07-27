<?php

namespace App\Http\Controllers;

use App\Emergente;
use Illuminate\Http\Request;

class EmergenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Emergente::orderByDesc('updated_at')->get(), 200);
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
        return response()->json([
            'creado' => Emergente::create($request->all()),
            'mensaje' => 'La notificacion emergente fue registrada exitosamente en bitacora'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Emergente  $emergente
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Emergente::find($id), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Emergente  $emergente
     * @return \Illuminate\Http\Response
     */
    public function edit(Emergente $emergente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Emergente  $emergente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $emergente = Emergente::find($id);
        $emergente->update($request->all());

        return response()->json([
            'actualizado' =>$emergente,
            'mensaje' => 'Notificacion emergente fue actualizado exitosamente 
                          en la base de datos local'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Emergente  $emergente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $emergente = Emergente::find($id);
        $emergente->delete();
        return response()->json([
            'mensaje' => 'La notificacion emergente fue eliminada exitosamente'
        ], 200);
    }
}
