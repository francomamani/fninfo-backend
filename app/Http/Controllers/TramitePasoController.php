<?php

namespace App\Http\Controllers;

use App\Tramite;
use Illuminate\Http\Request;

class TramitePasoController extends Controller
{
    public function index($id) {
        $pasos = Tramite::find($id)->pasos()->orderBy('posicion')->get();
        return response()->json($pasos, 200);
    }
}
