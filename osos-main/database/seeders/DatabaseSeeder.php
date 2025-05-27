<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear usuario administrador
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@lososos.com',
            'password' => bcrypt('12345678'),
            'role' => 'admin'
        ]);

        // Crear usuario empleado
        User::factory()->create([
            'name' => 'Empleado',
            'email' => 'empleado@lososos.com',
            'password' => bcrypt('12345678'),
            'role' => 'empleado'
        ]);

        // Crear usuario cliente
        User::factory()->create([
            'name' => 'Cliente',
            'email' => 'cliente@lososos.com',
            'password' => bcrypt('12345678'),
            'role' => 'cliente'
        ]);
    }
}
