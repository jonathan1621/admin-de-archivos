<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{

    public function run()
    {
        Role::create(['name' => 'Administrador']);
        Role::create(['name' => 'Policía']);
        Role::create(['name' => 'Bomberos de la Ciudad']);
        Role::create(['name' => 'Defensa Civil']);

        $admin = User::find(1);
        $admin->assignRole('Administrador');

        $policia = User::find(2);
        $policia->assignRole('Policia de la Ciudad');

        $bombero = User::find(3);
        $bombero->assignRole('Bomberos de la Ciudad');

        $defensa = User::find(4);
        $defensa->assignRole('Defensa Civil');

    }
}
