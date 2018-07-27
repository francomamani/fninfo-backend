<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $rules = [
            'nombres' => 'required',
            'apellidos' => 'required',
            'cuenta' => 'required|unique:users',
            'carnet' => 'required',
            'password' => 'required|min:8',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            if (strlen($request->input('password')) >= 8) {
                $quantity = User::onlyTrashed()
                    ->where('cuenta', $request->input('cuenta'))
                    ->count();
                if ($quantity > 0) {
                    $user = User::onlyTrashed()
                        ->where('cuenta', $request->input('cuenta'))
                        ->firstOrFail();
                    if ($user->trashed()) {
                        $user->restore();
                        $user->nombres = $request->input('nombres');
                        $user->apellidos = $request->input('apellidos');
                        $user->cuenta = $request->input('cuenta');
                        $user->carnet = $request->input('carnet');
                        $user->password = Hash::make($request->input('password'));
                        $user->save();
                        return response()->json([
                            'creado' => $user,
                            'mensaje' => 'Activación de usuario exitosa.'], 201);
                    }
                }
            }

            return response()->json(['creado' => false, 'mensaje' => 'Esta cuenta ya esta activa, intente otra']);
        } else {
            $data = [
                'nombres' => $request->input('nombres'),
                'apellidos' => $request->input('apellidos'),
                'carnet' => $request->input('carnet'),
                'cuenta' => $request->input('cuenta'),
                'password' => Hash::make($request->input('password'))];

            return response()->json([
                'creado' => User::create($data),
                'mensaje' => 'Usuario registrado exitosamente'], 201);
        }
    }

    public function login()
    {
        $credentials = request()->only('cuenta', 'password');
        $rules = [
            'cuenta' => 'required',
            'password' => 'required|min:8',
        ];
        $validator = Validator::make($credentials, $rules);
        if ($validator->fails()) {
            return response()->json([
                'autenticado' => false,
                'mensaje' => $validator->messages()
            ], 500);
        }
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'autenticado' => false,
                    'mensaje' => 'Las credenciales son incorrectas'
                ], 401);
            }
        } catch (JWTException $e) {
            return response()->json([
                'autenticado' => false,
                'mensaje' => 'Error durante la autenticacion, por favor intente nuevamente'],
                500);
        }
        return response()->json([
            'autenticado' => true,
            'token' => $token,
            'user' => JWTAuth::user(),
            'mensaje' => 'Usuario autenticado exitosamente'
        ], 200);
    }
    /**
     * Log out
     * Invalidate the token, so user cannot use it anymore
     * They have to relogin to get a new token
     *
     * @param Request $request
     */
    /* 8000?token=askjdflkasdf;jasd*/

    public function logout()
    {
        /*
            $this->validate($request, ['token' => 'required']);
            JWTAuth::setToken($request->input('token'));
        */
/*        $header = explode(' ', request()->header('Authorization'));
        try {
            JWTAuth::parseToken();
            $token = JWTAuth::getToken();
            auth()->logout();
        } catch (JWTException $e) {
            abort("token malformado");
        } catch (TokenExpiredException $e) {
            JWTAuth::refresh($token);
            auth()->logout();
        }*/
        return response()->json([
            'deslogueo' => true,
            'mensaje' => 'Sesion cerrada exitosamente'
        ], 200);

    }

    public function changePassword($id)
    {
        $user = User::find($id);
        if (Hash::check(request()->input('current_password'), $user->password)) {
            if (request()->input('new_password') == request()->input('new_password_repeated')) {
                $user->password = Hash::make(request()->input('new_password'));
                $user->save();
                return response()->json(['mensaje' => 'Password actualizado exitosamente'], 200);
            }
        }
        return response()->json(['mensaje' => 'Las credenciales no coinciden'], 200);
    }

    public function resetPassword($id) {
        $user = User::find($id);
        $user->password = Hash::make($user->carnet);
        $user->save();
        return response()->json([
            'mensaje' => 'El password de la cuenta ' . $user->cuenta . ' fue restablecida'
        ], 200);
    }
}