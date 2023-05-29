<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use App\Models\Candidato;
use App\Models\Usuario;

class CandidatoTest extends TestCase
{
    use RefreshDatabase;

    public function testCrearCandidatoExitoso()
    {
        $usuario = Usuario::factory()->create([
            'role' => 'manager',
        ]);

        $this->actingAs($usuario);

        $response = $this->postJson('/api/lead', [
            'name' => 'Mi candidato',
            'source' => 'Fotocasa',
            'owner' => 2,
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'meta' => [
                    'success',
                    'errors',
                ],
                'data' => [
                    'id',
                    'name',
                    'source',
                    'owner',
                    'created_by',
                    'created_at',
                    'updated_at',
                ],
            ])
            ->assertJson([
                'meta' => [
                    'success' => true,
                    'errors' => [],
                ],
            ]);
    }

    public function testCrearCandidatoSinPermiso()
    {
        $usuario = Usuario::factory()->create([
            'role' => 'agent',
        ]);

        $this->actingAs($usuario);

        $response = $this->postJson('/api/lead', [
            'name' => 'Mi candidato',
            'source' => 'Fotocasa',
            'owner' => 2,
        ]);

        $response->assertStatus(401)
            ->assertJsonStructure([
                'meta' => [
                    'success',
                    'errors',
                ],
            ])
            ->assertJson([
                'meta' => [
                    'success' => false,
                ],
            ]);
    }

    public function testObtenerCandidatoExistente()
    {
        $candidato = Candidato::factory()->create();

        $response = $this->getJson('/api/lead/' . $candidato->id);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'meta' => [
                    'success',
                    'errors',
                ],
                'data' => [
                    'id',
                    'name',
                    'source',
                    'owner',
                    'created_by',
                    'created_at',
                    'updated_at',
                ],
            ])
            ->assertJson([
                'meta' => [
                    'success' => true,
                    'errors' => [],
                ],
            ]);
    }

    // Agrega más pruebas unitarias según tus necesidades

}
