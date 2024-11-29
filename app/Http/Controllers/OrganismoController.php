<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Organismo;
use Illuminate\Http\Request;

class OrganismoController extends Controller
{
    public function index()
    {
        // Obtener todos los organismos
        $organismos = Organismo::all();

        // Pasar los datos a la vista
        return view('organismos.index', compact('organismos'));
    }

    public function select($role)
{
    if (!in_array($role, ['Administrador', 'Policia de la Ciudad', 'Bomberos de la Ciudad', 'Defensa Civil'])) {
        abort(404, 'Rol no encontrado.');
    }

    session(['role' => $role]);

    return redirect()->route('archivos.index');
}
}
