<?php

namespace App\Http\Controllers;

use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Slider::get(), 200);
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
        if ($request->hasFile('imagen')){
            $path_imagen = $request->file('imagen')->store('imagenes');
            $slider = new Slider();
            $slider->imagen = $path_imagen;
            $slider->descripcion = $request->input('descripcion');
            $slider->save();
            return response()->json([
                'creado' => $slider,
                'mensaje' => 'El registro fue guardado exitosamente'
            ], 201);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Slider::find($id), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return response()->json([
            'actualizado' => Slider::find($id)->update($request->all()),
            'mensaje' => 'El slider fue actualizado exitosamente'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::find($id);
        Storage::delete($slider->imagen);
        $slider->delete();
        return response()->json([
            'eliminado' => true,
            'La imagen del slider con id ' . $id . ' fue eliminado exitosamente'
        ], 200);
    }

    public function getImagen($id){
        $slider = Slider::find($id);
        return response()->file(storage_path('app/' . $slider->imagen));
    }

}
