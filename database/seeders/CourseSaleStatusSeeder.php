<?php

namespace Database\Seeders;

use App\Models\CourseSaleStatus;
use Illuminate\Database\Seeder;

class CourseSaleStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CourseSaleStatus::insertOrIgnore([
            ['name' => 'Pendiente', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Rechazado', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Completado', 'created_at' => now(), 'updated_at' => now()],
            ]);
    }
}
