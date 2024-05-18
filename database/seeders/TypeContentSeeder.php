<?php

namespace Database\Seeders;

use App\Models\TypeContent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TypeContent::insertOrIgnore([
            [
                "name" => "Video",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                "name" => "Lectura Pagina web",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                "name" => "Documento",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                "name" => "Audio",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                "name" => "Imagen",
                'created_at' => now(),
                'updated_at' => now()
            ],
            
        ]);
    }
}
