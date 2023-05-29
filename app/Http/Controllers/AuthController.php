<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\Usuario;

class AuthController extends Controller
{
    public function generarToken(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'meta' => [
                    'success' => false,
                    'errors' => ['Credenciales inválidas.'],
                ],
            ], 401);
        }

        $usuario = Auth::user();
        $token = $usuario->createToken('Token de acceso')->plainTextToken;
        $expiracion = Carbon::now()->addMinutes(1440);

        return response()->json([
            'meta' => [
                'success' => true,
                'errors' => [],
            ],
            'data' => [
                'token' => $token,
                'minutos_para_expirar' => $expiracion->diffInMinutes(Carbon::now()),
            ],
        ]);
    }
}
