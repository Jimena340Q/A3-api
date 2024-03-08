<?php

namespace Database\Seeders;

use App\Models\EnvironmentType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EnvironmentTypeSeeder extends Seeder
{
    public function run(): void
    {
        EnvironmentType::insert([

            ['description' => 'Aula'],
            ['description' => 'Taller'],
            ['description' => 'LAboratorio'],
            ['description' => 'Aula Virtual'],
            ['description' => 'Auditorio'],
            ['description' => 'Biblioteca'],
            ['description' => 'Campo Deportivo'],
            
        ]);
    }
}
