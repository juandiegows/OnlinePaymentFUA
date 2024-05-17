<?php

namespace Database\Seeders;

use App\Actions\Role\RoleConstante;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insertOrIgnore([
            [
                'role_id' => RoleConstante::Admin,
                'name' => 'Sebastián Bautista',
                'email' => 'sbautista15@estudiantes.areandina.edu.co',
                'balance' => 0.00,
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => RoleConstante::Admin,
                'name' => 'María Labarca',
                'email' => 'mlabarca@estudiantes.areandina.edu.co',
                'balance' => 0.00,
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => RoleConstante::Admin,
                'name' => 'Juan Mejía',
                'email' => 'jmejia580@estudiantes.areandina.edu.co',
                'balance' => 0.00,
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
