<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function testGenerarTokenExitoso()
    {
        $usuario = Usuario::factory()->create([
            'username' => 'tester',
            'password' => Hash::make('PASSWORD'),
        ]);

        $response = $this->postJson('/api/auth', [
            'username' => 'tester',
            'password' => 'PASSWORD',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'meta' => [
                    'success',
                    'errors',
                ],
                'data' => [
                    'token',
                    'minutos_para_expirar',
                ],
            ])
            ->assertJson([
                'meta' => [
                    'success' => true,
                    'errors' => [],
                ],
            ]);
    }

    public function testGenerarTokenFallido()
    {
        Usuario::factory()->create([
            'username' => 'tester',
            'password' => Hash::make('PASSWORD'),
        ]);

        $response = $this->postJson('/api/auth', [
            'username' => 'tester',
            'password' => 'ContraseñaIncorrecta',
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

    // Agrega más pruebas unitarias según tus necesidades

}
