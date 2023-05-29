<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;

class RolesUsuariosSeeder extends Seeder
{
    public function run()
    {
        Usuario::create([
            'username' => 'tester',
            'password' => Hash::make('PASSWORD'),
            'last_login' => '2020-09-01 16:16:16',
            'is_active' => true,
            'role' => 'manager',
        ]);

        Usuario::create([
            'username' => 'otro_usuario',
            'password' => Hash::make('PASSWORD'),
            'last_login' => '2020-09-01 16:16:16',
            'is_active' => true,
            'role' => 'agent',
        ]);
    }
}
