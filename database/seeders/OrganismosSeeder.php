<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Organismo;

class OrganismosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $organismos = [
            ['id' => 1, 'nombre' => 'Administrador'],
            ['id' => 2, 'nombre' => 'Policia de la Ciudad'],
            ['id' => 3, 'nombre' => 'Bomberos de la Ciudad'],
            ['id' => 4, 'nombre' => 'Defensa Civil']
        ];

        foreach ($organismos as $organismo) {
            Organismo::updateOrCreate(['id' => $organismo['id']], $organismo);
        }
    }
}
