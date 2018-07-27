<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\JWTAuth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(User::orderBy('cuenta')->get(), 200);
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
        $data = [
            'cuenta' => $request->input('cuenta'),
            'nombres' => $request->input('nombres'),
            'apellidos' => $request->input('apellidos'),
            'password' => Hash::make($request->input('password'))
        ];
        return response()->json([
            'creado' => User::create($data),
            'mensaje' => 'El usuario con cuenta ' . $request->input('cuenta') . ' fue creado exitosamente'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(User::find($id), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->cuenta = $request->input('cuenta');
        $user->nombres = $request->input('nombres');
        $user->apellidos = $request->input('apellidos');
        $user->save();

        return response()->json([
            'actualizado' => $user,
            'mensaje' => 'El usuario con cuenta ' . $request->input('cuenta') . ' fue actualizado exitosamente'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return response()->json([
            'eliminado' => true,
            'mensaje' => 'Usuario eliminado con id: ' . $id
        ], 200);
    }
}
