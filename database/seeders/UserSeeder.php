<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * USAR PARA CREAR UN ADMIN DIRECTAMENTE Y CON CONTRASEÑA HASHEADA
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Eduardo Romero Vasquez',
                'dni' => '72919436',
                'fechaNacimiento' => '2002-12-13',
                'email' => 'eromerov@unitru.edu.pe',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'estadoCuenta' => 'verificado',
                'idRol' => 1, // Rol de administrador
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
