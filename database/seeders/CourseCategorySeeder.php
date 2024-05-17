<?php

namespace Database\Seeders;

use App\Models\CourseCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CourseCategory::insertOrIgnore([
            ['name' => 'Desarrollo Web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ciencia de Datos', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Inteligencia Artificial', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Marketing Digital', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Diseño Gráfico', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Finanzas Personales', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Fotografía', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Idiomas', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cocina', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Desarrollo de Videojuegos', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Salud y Bienestar', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
