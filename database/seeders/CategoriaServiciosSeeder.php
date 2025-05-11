<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaServiciosSeeder extends Seeder
{
    public function run()
    {
        $categorias = [
            ['nombre' => 'Exámenes de Sangre'],
            ['nombre' => 'Exámenes de Orina'],
            ['nombre' => 'Exámenes de Heces'],
            ['nombre' => 'Exámenes de Coagulación'],
            ['nombre' => 'Examenes de Microbiología e Inmunología'],
            ['nombre' => 'Examenes de Hematología'],
            ['nombre' => 'Examenes de ETS'],
        ];

        DB::table('categorias_servicios')->insert($categorias);
    }
}
