<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Candidato;
use App\Models\Usuario;

class CandidatoController extends Controller
{
    public function crearCandidato(Request $request)
    {
        $usuario = auth()->user();

        if ($usuario->role === 'agent') {
            return response()->json([
                'meta' => [
                    'success' => false,
                    'errors' => ['No tienes permiso para crear candidatos.'],
                ],
            ], 401);
        }

        $candidato = Candidato::create([
            'name' => $request->input('name'),
            'source' => $request->input('source'),
            'owner' => $request->input('owner'),
            'created_by' => $usuario->id,
        ]);

        return response()->json([
            'meta' => [
                'success' => true,
                'errors' => [],
            ],
            'data' => $candidato,
        ], 201);
    }

    public function obtenerCandidato($id)
    {
        $candidato = Cache::remember("candidato_$id", 60, function () use ($id) {
            return Candidato::find($id);
        });

        if (!$candidato) {
            return response()->json([
                'meta' => [
                    'success' => false,
                    'errors' => ['No se encontró el candidato.'],
                ],
            ], 404);
        }

        return response()->json([
            'meta' => [
                'success' => true,
                'errors' => [],
            ],
            'data' => $candidato,
        ]);
    }

    public function obtenerTodosLosCandidatos()
    {
        $usuario = auth()->user();

        if ($usuario->role === 'manager') {
            $candidatos = Cache::remember('todos_los_candidatos', 60, function () {
                return Candidato::all();
            });
        } else {
            $candidatos = Cache::remember("candidatos_agente_$usuario->id", 60, function () use ($usuario) {
                return Candidato::where('owner', $usuario->id)->get();
            });
        }

        return response()->json([
            'meta' => [
                'success' => true,
                'errors' => [],
            ],
            'data' => $candidatos,
        ]);
    }
}
